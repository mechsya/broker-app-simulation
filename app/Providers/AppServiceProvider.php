<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('money', function ($amount) {
            return "<?php echo 'UEA ' . number_format($amount, 2, '.', ','); ?>";
        });

        View::share('user', User::with('profile')->find(Cookie::get('id')));

        View::share('notifications', Notification::where('user_id', Cookie::get('id'))->orderBy('id', 'DESC')->limit(5)->get());
    }
}
