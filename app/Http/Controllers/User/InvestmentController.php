<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tools\Code;
use App\Http\Controllers\Tools\Notification;
use App\Models\Bank;
use App\Models\Investment;
use App\Models\Package;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class InvestmentController extends Controller
{
    public function index()
    {
        $userId = Cookie::get('id');
        $packages = Package::all();
        $riwayatInvestasi = Investment::where('user_id', $userId)->get();

        return view('user.investment.index', [
            'page' => 'investment.index',
            'packages' => $packages,
            'histories' => $riwayatInvestasi
        ]);
    }

    public function paid(Request $request)
    {
        $userId = Cookie::get('id');
        $riwayatInvestasi = Investment::with('package')->where('user_id', $userId)->get();
        $user = User::with('profile')->find($userId);
        $package = Package::findOrFail($request->query('package'));

        if ($_GET['amount'] <= $package->min) {
            return back()->with('error', 'The amount you entered does not meet the minimum purchase requirement.');
        }

        if ($_GET['amount'] >= $package->max) {
            return back()->with('error', 'The amount you entered exceeds the maximum purchase limit.');
        }

        if ($user->status == 'noactived') {
            return back()->with('error', 'Please activate your account to make an investment.');
        }

        if ($riwayatInvestasi->contains(fn($history) => !$history->isPaid)) {
            return back()->with('error', 'You have an unpaid investment package.');
        }

        if ($riwayatInvestasi->contains(fn($history) => $history->status === 'active')) {
            return back()->with('error', 'You already have an active investment package.');
        }

        $package->amount = $request->query('amount');

        return view('user.investment.paid', [
            'page' => 'investment',
            'package' => $package,
            'histories' => $riwayatInvestasi
        ]);
    }

    public function paidPost(Request $request)
    {
        $userId = Cookie::get('id');

        $investment = Investment::create([
            'code' => Code::generate(),
            'user_id' => $userId,
            'package_id' => $request->input('package_id'),
            'amount' => $request->input('amount'),
        ]);

        $packageName = Package::findOrFail($investment->package_id)->name;

        Notification::create("Investment package $packageName added", "You have invested in the $packageName package.");

        return redirect()->route('investment.invoice', ['code' => $investment->code]);
    }

    public function invoice(string $code)
    {
        $userId = Cookie::get('id');
        $investment = Investment::where('user_id', $userId)->where('code', $code)->firstOrFail();
        $banks = Bank::where('role', 'admin')->get();

        return view('user.investment.invoice', [
            'page' => 'investment',
            'banks' => $banks,
            'investment' => $investment
        ]);
    }

    public function confirmation(int $id)
    {
        $userId = Cookie::get('id');
        $investment = Investment::where('user_id', $userId)->where('id', $id)->firstOrFail();
        $riwayatInvestasi = Investment::with('package')->where('user_id', $userId)->get();
        $banks = Bank::where('role', 'admin')->get();

        return view('user.investment.confirmation', [
            'page' => 'investment',
            'banks' => $banks,
            'histories' => $riwayatInvestasi,
            'investment' => $investment
        ]);
    }

    public function confirmationPut(Request $request, int $id)
    {
        $userId = Cookie::get('id');
        $profile = Profile::where('user_id', $userId)->firstOrFail();
        $investment = Investment::with('package')
            ->where('id', $id)
            ->firstOrFail();

        if ($request->paymentTo === "wallet") {
            if ($profile->balance <= $investment->amount) {
                return back()->with('error', 'Your balance is insufficient.');
            }

            $profile->balance -= $investment->amount;
            $profile->save();

            $investment->update([
                'note' => $request->note,
                'isPaid' => true,
                'proof' => "balance.jpg",
                'paymentTo' => 'Wallet Balance'
            ]);
        } else {
            if ($request->hasFile('proof')) {
                $file = $request->file('proof');
                $filename = "investment-payment-proof-" . time() . '.' . $file->extension();
                $file->storeAs('public/proof-payment/', $filename);

                $investment->update([
                    'note' => $request->note,
                    'proof' => $filename,
                    'isPaid' => true,
                    'paymentTo' => $request->paymentTo
                ]);
            } else {
                return back()->with('error', 'Please upload a payment proof.');
            }
        }

        return redirect()->route('investment.index')->with('success', 'Investment package added successfully.');
    }
}
