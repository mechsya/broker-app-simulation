<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Profit;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile')->orderBy('id', 'DESC')->get();
        return view('admin.users.users', ['page' => 'dashboard.users', 'users' => $users]);
    }

    public function updateData(Request $request, $id)
    {
        $user = $request->input('user');
        $profile = $request->input('profile');

        User::updateOrCreate(['id' => $id], $user);
        Profile::updateOrCreate(['user_id' => $id], $profile);

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->password = Hash::make(request('password'));
        $user->save();

        return back()->with('success', 'Password berhasil diganti');
    }

    public function edit($id)
    {
        return view('admin.users.view-user', ['page' => 'dashboard.users', 'usera' => User::with('profile')->find($id)]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->status = $request->status;
        $user->save();

        return back()->with('success', 'Berhasil');
    }

    public function requestUser()
    {
        $users = User::with('profile')->where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('admin.users.request-verification', ['page' => 'dashboard.users', 'usera' => $users]);
    }

    public function putBalance(Request $request, $id)
    {
        $profile = Profile::where('user_id', $id)->first();
        $profile->balance = $profile->balance + $request->balance;
        $profile->save();
        return back()->with('success', 'Saldo berhasil ditambahkan');
    }

    public function addProfit($id)
    {
        try {
            $profit = Profit::create([
                'user_id' => $id,
                'amount' => request('amount'),
            ]);

            if (!$profit) return back()->with('error', 'Tidak bisa menambahkan profit');

            $profile = Profile::where('user_id', $id)->first();
            $profile->balance = $profile->balance + $profit->amount;
            $profile->save();

            return back()->with('success', 'Profit berhasil ditambahkan');
        } catch (Exception $e) {
            return back()->with('error', 'Tidak bisa menambahkan profit ' . $e->getMessage());
        }
    }
}
