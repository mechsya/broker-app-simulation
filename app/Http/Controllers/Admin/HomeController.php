<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Testimoni;
use App\Models\Withdraw;

class HomeController extends Controller
{
    public function index()
    {
        $balances = Balance::with('user')
            ->where('status', 'pending')
            ->get();

        $withdraws = Withdraw::with('user')
            ->where('status', 'pending')
            ->latest('id')
            ->get();

        $pendingTestimonials = Testimoni::with('user')->where('status', 'pending')->get();

        return view('admin.index', [
            'page' => 'dashboard.home',
            'balances' => $balances,
            'withdraws' => $withdraws,
            'pendingTestimonials' => $pendingTestimonials
        ]);
    }
}
