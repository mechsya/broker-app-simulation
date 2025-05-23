<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Profile;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function requestBalance()
    {
        // Fetch pending balances with related user profile
        $balances = Balance::with('user')
            ->where('status', 'pending')
            ->get();

        return view('admin.balance.request-balance', [
            'page' => 'balance',
            'balances' => $balances
        ]);
    }

    public function approveBalance($id, $userID)
    {
        $balance = Balance::find($id);

        if (!$balance || $balance->isPaid == 0) {
            return back()->with('error', "User hasn’t paid yet or balance not found");
        }

        $balance->update(['status' => 'success']);

        $profile = Profile::where('user_id', $userID)->first();
        if ($profile) {
            $profile->increment('balance', $balance->amount);
        }

        return back()->with('success', "Balance approval successful for code $balance->code");
    }

    public function requestWithdraw()
    {
        // Fetch pending withdrawals, ordered by ID in descending order
        $withdraws = Withdraw::with(['user', 'bank'])
            ->where('status', 'pending')
            ->latest('id')
            ->get();

        return view('admin.balance.request-withdraw', [
            'page' => 'balance',
            'withdraws' => $withdraws
        ]);
    }

    public function updateWithdrawal(Request $request, $id)
    {
        $withdraw = Withdraw::find($id);

        if (!$withdraw) {
            return back()->with('error', 'Withdrawal request not found');
        }

        $profile = Profile::where('user_id', $withdraw->user_id)->first();

        if ($request->method === 'reject') {
            if ($profile) {
                $profile->increment('balance', $withdraw->amount);
            }
        }

        $withdraw->update(['status' => $request->method, 'reason_reject' => $request->reason_reject]);

        return back()->with('success', ucfirst($request->method) . ' success');
    }
}
