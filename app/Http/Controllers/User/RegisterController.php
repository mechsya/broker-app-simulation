<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('user.register', ['page' => 'register.index']);
    }
}
