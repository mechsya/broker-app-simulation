<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Refferal;
use Illuminate\Support\Facades\Cookie;

class NetworkController extends Controller
{
    public function refferals()
    {
        $refferals = Refferal::with('inviteds')->where('inviting', Cookie::get('id'))->get();
        return view('user.network.refferals', ['page' => 'network', 'refferals' => $refferals]);
    }

    public function generation()
    {
        return view('user.network.generation', ['page' => 'network']);
    }
}
