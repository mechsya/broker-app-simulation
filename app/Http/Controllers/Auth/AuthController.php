<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetEmail;
use App\Mail\WithdrawMail;
use App\Models\Profile;
use App\Models\Refferal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);

        $user = User::firstOrCreate(
            ['email' => $request->email, 'username' => $request->username],
            $request->all()
        );

        if ($request->invitedBy != "") {
            Refferal::create([
                'inviting' => $request->inviting,
                'invited' => $user->id
            ]);
        }

        if ($user->wasRecentlyCreated) {
            Profile::create(['user_id' => $user->id]);

            Mail::to($user->email)->send(new WithdrawMail([
                'subject' => 'Welcome To ' . env("APP_NAME"),
                'type' => 'signup',
                'message' => "We have received your withdrawal request of AED " . number_format($request->amount, 2) . " Our team is currently processing your request.",
                'withdraw' => 0,
                'name' => $user->name
            ]));

            return back()->with('success', 'Registration successful');
        } else {
            return back()->with('error', 'User already exists');
        }
    }

    public function signin(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Session::put('id', $user->id);
                return redirect('/')->cookie(Cookie::make('id', $user->id, 1440));
            } else {
                return back()->with('error', 'Invalid credentials');
            }
        } else {
            return back()->with('error', 'User not registered');
        }
    }

    public function forget(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && $user->username == $request->username) {
            Mail::to($user->email)->send(new ForgetEmail($user->name, $user->email));
            return back()->with('success', 'We have sent a confirmation email to your inbox. Please check it and reset your password.');
        } else {
            return back()->with('error', 'User not found');
        }
    }

    public function reset(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $password = $request->all();

        if ($password['newPassword'] === $password['confirmPassword']) {
            if (Hash::check($password['currentPassword'], $user->password)) {
                $user->password = Hash::make($password['newPassword']);
                $user->save();
                return redirect()->to(route('auth.signin'))->with('success', 'Password changed successfully');
            } else {
                return back()->with('error', 'Current password is incorrect');
            }
        } else {
            return back()->with('error', 'Password confirmation does not match');
        }
    }
}
