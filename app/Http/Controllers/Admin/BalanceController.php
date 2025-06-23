<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WithdrawMail;
use App\Models\Balance;
use App\Models\Profile;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $user = User::with('profile')->where('id', $withdraw->user_id)->first();

        if ($request->method === 'reject') {
            if ($user) {
                $user->profile->increment('balance', $withdraw->amount);

                $withdraw->update(['status' => 'reject', 'reason_reject' => $request->reason_reject]);

                Mail::to('alinia.meysa@gmail.com')->send(new WithdrawMail([
                    'subject' => 'Your Withdrawal Request Has Been Rejected',
                    'type' => 'reject',
                    'message' => $request->reason_reject,
                    'withdraw' => 0,
                    'name' => $user->name
                ]));

                return;
            }
        }

        $withdraw->update(['status' => 'success', 'reason_reject' => $request->reason_reject]);

        Mail::to('alinia.meysa@gmail.com')->send(new WithdrawMail([
            'subject' => 'Your Withdrawal Request Has Been Approve',
            'type' => 'success',
            'message' => $request->reason_reject,
            'withdraw' => $withdraw->amount,
            'name' => $user->name
        ]));

        return back()->with('success', ucfirst($request->method) . ' success');
    }
}
