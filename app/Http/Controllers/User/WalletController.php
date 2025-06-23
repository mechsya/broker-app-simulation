<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tools\Code;
use App\Http\Controllers\Tools\Notification;
use App\Mail\WithdrawMail;
use App\Models\Balance;
use App\Models\Bank;
use App\Models\Profile;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class WalletController extends Controller
{
    public function balance()
    {
        $balances = Balance::where('user_id', Cookie::get('id'))->get();
        return view('user.wallet.balance', ['page' => 'wallet', 'balances' => $balances]);
    }

    public function addBalance()
    {
        $histories = Balance::getByUser();
        return view('user.wallet.add-balance', ['page' => 'wallet', 'histories' => $histories]);
    }

    public function addBalanceStore(Request $request)
    {
        $balance = Balance::create([
            'user_id' => Cookie::get('id'),
            'code' => Code::generate(),
            'amount' => $request->amount,
        ]);

        return redirect()->route('wallet.invoice', ['id' => $balance]);
    }

    public function invoice($id)
    {
        $balance = Balance::where('user_id', Cookie::get('id'))
            ->where('id', $id)
            ->first();

        $banks = Bank::where('role', 'admin')->get();

        if (!$balance) {
            return back();
        }

        return view('user.wallet.invoice', [
            'page' => 'wallet',
            'balance' => $balance,
            'banks' => $banks
        ]);
    }

    public function confirmation($id)
    {
        $balance = Balance::find($id);
        $histories = Balance::where('user_id', Cookie::get('id'))->get();
        $banks = Bank::where('role', 'admin')->get();

        return view('user.wallet.confirmation', [
            'page' => 'wallet',
            'balance' => $balance,
            'histories' => $histories,
            'banks' => $banks
        ]);
    }

    public function confirmationPut(Request $request, $id)
    {
        $balance = Balance::where('user_id', Cookie::get('id'))->where('id', $id)->first();

        if (!$balance) {
            return back()->with('error', 'Payment failed');
        }

        if ($request->hasFile('proof')) {
            $file = $request->file('proof');
            $filename = "payment-proof-balance-" . time() . '.' . $file->extension();
            $file->storeAs('public/proof-balance/', $filename);

            $balance->note = $request->note;
            $balance->proof = $filename;
            $balance->isPaid = 1;
            $balance->paymentTo = $request->paymentTo;
            $balance->save();
        } else {
            return back()->with('error', 'Please upload payment proof');
        }
        return redirect(route('wallet.balance'))->with('success', 'Top-up successful');
    }

    public function transfer()
    {
        $histories = Transfer::with('recipiente')->where('sender', Cookie::get('id'))->get();
        return view('user.wallet.transfer', ['page' => 'wallet', 'histories' => $histories]);
    }

    public function transferStore(Request $request)
    {
        $user = User::with('profile')->where('id', Cookie::get('id'))->first();
        if ($user->profile->profile[0]->balance <= $request->amount) {
            return back()->with('error', 'Your balance is insufficient');
        }

        $checkUser = User::with('profile')->where('username', $request->recipient)->first();
        if (!$checkUser) {
            return back()->with('error', "User $request->recipient not found");
        }

        $transfer = Transfer::create([
            'sender' =>  $user->profile->id,
            'recipient' => $checkUser->id,
            'amount' => $request->amount,
            'note' => $request->note
        ]);

        if ($transfer) {
            Profile::where('user_id', $user->profile->id)->update([
                'balance' => $user->profile->profile[0]->balance - $transfer->amount
            ]);

            Profile::where('user_id', $checkUser->id)->update([
                'balance' => $checkUser->profile[0]->balance + $transfer->amount
            ]);

            Notification::create('Transfer Successful', "Your transfer of AED $request->amount to $checkUser->name was successful");

            return back()->with('success', 'Transfer successful');
        }

        return back()->with('error', 'Transfer failed');
    }

    public function withdraw()
    {
        $withdraws = Withdraw::where('user_id', Cookie::get('id'))->orderBy('id', 'DESC')->get();
        $banksUser = Bank::where('user_id', Cookie::get('id'))->get();

        return view('user.wallet.withdraw', ['page' => 'wallet', 'withdraws' => $withdraws, 'banksUser' => $banksUser]);
    }

    public function withdrawStore(Request $request)
    {
        try {
            $request['user_id'] = Cookie::get('id');

            $user = User::with('profile')->where('id', Cookie::get('id'))->first();

            if ($user->profile->balance <= $request->amount) {
                return back()->with('error', 'Insufficient balance');
            }

            $user->profile->balance = $user->profile->balance - $request->amount;
            $user->profile->save();

            Withdraw::create($request->all());
            Notification::create('Withdrawal in Process', "Your withdrawal request of AED $request->amount is being processed");

            Mail::to('alinia.meysa@gmail.com')->send(new WithdrawMail([
                'subject' => 'Withdrawal Request Received',
                'type' => 'request',
                'message' => "We have received your withdrawal request of AED " . number_format($request->amount, 2) . " Our team is currently processing your request.",
                'withdraw' => $request->amount,
                'name' => $user->name
            ]));

            return back()->with('success', "Withdrawal request submitted, please wait for admin confirmation");
        } catch (\Exception $e) {
            Log::error('Withdraw Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while processing your withdrawal request. Please try again.' . $e->getMessage());
        }
    }
}
