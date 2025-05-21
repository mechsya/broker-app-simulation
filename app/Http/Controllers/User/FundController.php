<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Investment;
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
        $profitInvests = Investment::with('package')
            ->where('user_id', Cookie::get('id'))
            ->where('expiresAt', ">=", now())
            ->get();

        $totalProfit = Investment::where('user_id', Cookie::get('id'))->sum('profit');

        return view('user.fund.profits', [
            'page' => 'fund',
            'profitInvests' => $profitInvests,
            'totalProfit' => $totalProfit
        ]);
    }
}
