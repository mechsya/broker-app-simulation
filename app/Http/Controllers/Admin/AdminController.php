<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function addAccountBank(Request $request)
    {
        $filename = '';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '-bank-' . $request->bank . '.' . $file->extension();
            $file->storeAs('public/bank', $filename);
        }

        $user = User::find(Cookie::get('id'));

        Bank::create([...$request->all(), 'role' => $user->role, 'user_id' => $user->id, 'image' => $filename]);

        return back()->with('success', 'Bank account created successfully');
    }

    public function deleteAccountBank($id)
    {
        Bank::where('id', $id)->delete();
        return back()->with('success', 'Bank account deleted successfully');
    }
}
