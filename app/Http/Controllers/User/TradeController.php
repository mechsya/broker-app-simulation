<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tools\Code;
use App\Http\Controllers\Tools\Current;
use App\Http\Controllers\Tools\Notification;
use App\Models\Profile;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class TradeController extends Controller
{
    public function index()
    {
        return view('user.trade.trading', [
            'page' => 'trade',
            'tradings' => Trade::where('user_id', Cookie::get('id'))->get()
        ]);
    }

    public function store(Request $request)
    {
        $id = Cookie::get('id');
        $user = User::with('profile')->find($id);
        $balance = $user->profile[0]->balance;

        // Check if the user's balance is sufficient
        if ($balance == 0 || $balance < $request->amount) {
            // If not, send an error message
            return back()->with('error', 'Your balance is insufficient');
        }

        // Update user balance
        $profile = Profile::find($user->profile[0]->id);
        $profile->balance = $balance - $request->amount;
        $profile->save();

        // If the update is successful
        if ($profile) {
            // Save trade information
            $trade = Trade::create([
                'user_id' => $id,
                'code' => Code::generate(),
                'type' => $request->type,
                'open' => Current::price($request->market),
                'package' => $this->convertSecondToString($request->timeFrame),
                'market' => $request->market,
                'amount' => $request->amount,
                'expiresAt' => now()->addSeconds(intval($request->timeFrame))
            ]);

            // Save notification log
            Notification::create("New Stake $trade->code", "You placed a $request->type at $trade->created_at");

            return back()->with('success', $request->type . ' Successful');
        } else {
            return back()->with('error', $request->type . ' Failed');
        }
    }

    public function history()
    {
        return view('user.trade.history', [
            'page' => 'trade',
            'tradings' => Trade::where('user_id', Cookie::get('id'))->get()
        ]);
    }

    public function profits()
    {
        $totalProfit = Trade::where('user_id', Cookie::get('id'))->sum('profit');

        return view('user.trade.profits', [
            'page' => 'trade',
            'totalProfit' => $totalProfit,
            'tradings' => Trade::where('user_id', Cookie::get('id'))->where('status', 'win')->get()
        ]);
    }

    public function convertSecondToString($second)
    {
        $timeFrame = $second / 60;
        return ($timeFrame < 1) ? "30 Seconds" : $timeFrame . " Minutes";
    }
}
