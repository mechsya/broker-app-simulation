<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Profit;
use App\Models\Trade;
use Illuminate\Support\Facades\Cookie;

class FundController extends Controller
{
    public function bonus()
    {
        return view('user.fund.bonus', ['page' => 'fund']);
    }

    public function profits()
    {
        $profits = Profit::where('user_id', Cookie::get('id'))
            ->get();

        $totalProfit = Profit::where('user_id', Cookie::get('id'))->sum('amount');

        return view('user.fund.profits', [
            'page' => 'fund',
            'profits' => $profits,
            'totalProfit' => $totalProfit
        ]);
    }
}
