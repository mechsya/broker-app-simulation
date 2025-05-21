<?php

namespace App\Console\Commands;

use App\Http\Controllers\Tools\Notification;
use App\Models\Investment as ModelsInvestment;
use App\Models\Profile;
use Illuminate\Console\Command;

class Investment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:investment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'hit Investment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // ambil semua investment
        $investments = ModelsInvestment::with('package')->where('status', 'active')->get();

        foreach ($investments as $investment) {
            if ($investment->expiresAt <= now()) {
                // ambil persenan profit dari package
                $profit = $investment->package->profit;
                // kalkulasi persenan profit dari amount
                $profitAmount = ($profit / 100) * $investment->amount;
                // updat balance profile
                $profitAll = $investment->package->contract * $profitAmount;
                $profile = Profile::where('user_id', $investment->user_id)->first();
                // all
                $profile->balance = $profile->balance + $profitAll;
                $profile->save();

                $investment->proccess = 'success';
                $investment->profit = $investment->package->contract * $profitAmount;
                $investment->save();
            }
        }

        $this->info('Investment Hit Success');

        return 0;
    }
}
