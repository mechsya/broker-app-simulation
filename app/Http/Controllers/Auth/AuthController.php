<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetEmail;
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

        $user = User::firstOrCreate(['email' => $request->email, 'username' => $request->username], $request->all());

        if ($request->invitedBy != "") {
            Refferal::create([
                'inviting' => $request->inviting,
                'invited' => $user->id
            ]);
        }

        if ($user->wasRecentlyCreated) {
            Profile::create(['user_id' => $user->id]);
            return back()->with('success', 'Pendaftaran berhasil');
        } else {
            return back()->with('error', 'Pengguna sudah ada');
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
                return back()->with('error', 'Kredensial tidak valid');
            }
        } else {
            return back()->with('error', 'Pengguna tidak terdaftar');
        }
    }

    public function forget(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->username == $request->username) {
            Mail::to($user->email)->send(new ForgetEmail($user->name, $user->email));
            return back()->with('success', 'Kami telah mengirimkan email konfirmasi ke kotak masuk Anda, silakan lihat dan reset kata sandi Anda');
        } else {
            return back()->with('error', 'Pengguna tidak ditemukan');
        }
    }

    public function reset(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        $password = $request->all();

        if ($password['newPassword'] == $password['confirmPassword']) {
            if (Hash::check($password['currentPassword'], $user->password)) {
                $user->password = Hash::make($password['newPassword']);
                $user->save();
                return redirect()->to(route('auth.signin'))->with('success', 'Kata sandi berhasil diubah');
            } else {
                return back()->with('error', 'Kata sandi saat ini salah');
            }
        } else {
            return back()->with('error', 'Konfirmasi kata sandi tidak cocok');
        }
    }
}
