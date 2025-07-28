<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Profit;
use App\Models\Refferal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil investasi yang sedang dijalani oleh pengguna
        $packageActive = Investment::with('package')
            ->where('user_id', Cookie::get('id'))
            ->where('status', 'active')->first();

        $totalProfit = Profit::where('user_id', Cookie::get('id'))->sum('amount');

        $totalRefferal = count(Refferal::where('inviting', Cookie::get('id'))->get());

        return view('user.home', [
            'page' => 'home',
            'packageActive' => $packageActive,
            'profits' => $totalProfit,
            'totalRefferal' => $totalRefferal
        ]);
    }
}
