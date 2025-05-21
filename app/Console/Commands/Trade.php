<?php

namespace App\Console\Commands;

use App\Http\Controllers\Tools\Current;
use App\Models\Profile;
use App\Models\Trade as ModelsTrade;
use Illuminate\Console\Command;

class Trade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:trade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hit Trading';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil semua trade yang statusnya pending
        $trades = ModelsTrade::where('status', 'pending')->get();

        foreach ($trades as $trade) {
            $stake = Current::price();
            $profileUser = Profile::where('user_id', $trade->user_id)->first();

            if ($profileUser && $trade->expiresAt <= now()) {
                if ($trade->type == 'buy') {
                    if ($trade->open >= $stake) {
                        $profileUser->balance += $trade->amount;
                        $profileUser->save();
                        $trade->profit = $trade->amount;
                        $trade->status = 'win';
                    } else {
                        $trade->status = 'lose';
                    }
                    $trade->save();
                } else {
                    if ($trade->open <= $stake) {
                        $profileUser->balance += $trade->amount;
                        $profileUser->save();
                        $trade->profit = $trade->amount;
                        $trade->status = 'win';
                    } else {
                        $trade->status = 'lose';
                    }
                    $trade->save();
                }
            }
        }

        $this->info("Trading process completed");
        return 0;
    }
}
