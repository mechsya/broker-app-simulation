<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Tools\Export;
use App\Http\Controllers\User\FundController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InvestmentController;
use App\Http\Controllers\User\KncController;
use App\Http\Controllers\User\NetworkController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\SecurityController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\TestimonialController;
use App\Http\Controllers\User\TradeController;
use App\Http\Controllers\User\WalletController;
use App\Http\Middleware\CheckSession;
use App\Mail\WithdrawMail;
use App\Models\Bank;
use App\Models\File;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Referral route
Route::get('referral', function () {
    return redirect()->route('auth.signup', ['reff' => request('reff')]);
})->name('referral');

// Authentication routes
Route::prefix('auth')->group(function () {
    Route::prefix('signin')->controller(AuthController::class)->group(function () {
        Route::view('', 'auth.signin')->name('auth.signin');
        Route::post('', 'signin')->name('auth.signin.post');
    });

    Route::prefix('forget')->controller(AuthController::class)->group(function () {
        Route::view('', 'auth.forget')->name('auth.forget');
        Route::post('', 'forget')->name('auth.forget.post');
    });

    Route::view('reset', 'auth.reset')->name('auth.reset');
    Route::put('reset', [AuthController::class, 'reset'])->name('auth.reset.update');

    Route::prefix('signup')->controller(AuthController::class)->group(function () {
        Route::get('', function () {
            $user = User::where('username', request('reff'))->first();
            $sponsor = $user ? "{$user->name} ({$user->username})" : "";
            return view('auth.signup', ['sponsor' => $sponsor, 'inviting' => $user->id ?? null]);
        })->name('auth.signup');

        Route::post('', 'signup')->name('auth.signup.post');
    });

    Route::get('logout', function (Request $request) {
        $request->session()->flush();
        return redirect()->route('auth.signin')->withCookie(Cookie::forget('id'));
    })->name('auth.logout');
});

// Routes requiring session middleware
Route::middleware(CheckSession::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Settings routes
    Route::prefix('setting')->controller(SettingController::class)->group(function () {
        Route::get('profile', 'profile')->name('setting.profile');
        Route::put('profile/update', 'profileUpdate')->name('setting.profile.update');
        Route::put('profile/update/password', 'profileUpdatePassword')->name('setting.profile.update.password');

        Route::get('image', 'image')->name('setting.image');
        Route::put('image/update', 'imageUpdate')->name('setting.image.update');

        Route::view('bank', 'admin.admin.add-account-bank', [
            'page' => 'admin',
            'banks' => Bank::where('user_id', Cookie::get('id'))
                ->where('role', 'user')->get()
        ])->name('setting.bank');
    });

    // Security routes
    Route::prefix('security')->controller(SecurityController::class)->group(function () {
        Route::get('', 'index')->name('security.index');
        Route::put('update', 'update')->name('security.update');
    });

    // KNC routes
    Route::prefix('knc')->controller(KncController::class)->group(function () {
        Route::get('', 'index')->name('knc.index');
        Route::put('update', 'update')->name('knc.update');
    });

    // Investment routes
    Route::prefix('investment')->controller(InvestmentController::class)->group(function () {
        Route::get('', 'index')->name('investment.index');
        Route::get('paid', 'paid')->name('investment.paid');
        Route::post('paid', 'paidPost')->name('investment.paid.post');
        Route::get('invoice/{code}', 'invoice')->name('investment.invoice');
        Route::get('confirmation/{id}', 'confirmation')->name('investment.confirmation');
        Route::put('confirmation/{id}', 'confirmationPut')->name('investment.confirmation.put');
    });

    // Trade routes
    Route::prefix('trade')->controller(TradeController::class)->group(function () {
        Route::get('', 'index')->name('trade.index');
        Route::post('', 'store')->name('trade.store');
        Route::get('history', 'history')->name('trade.history');
        Route::get('profits', 'profits')->name('trade.profits');
    });

    // Fund routes
    Route::prefix('fund')->controller(FundController::class)->group(function () {
        Route::get('bonus', 'bonus')->name('fund.bonus');
        Route::get('profits', 'profits')->name('fund.profits');
    });

    // Wallet routes
    Route::prefix('wallet')->controller(WalletController::class)->group(function () {
        Route::get('balance', 'balance')->name('wallet.balance');
        Route::get('add-balance', 'addBalance')->name('wallet.add-balance');
        Route::post('add-balance/store', 'addBalanceStore')->name('wallet.add-balance.store');
        Route::get('invoice/{id}', 'invoice')->name('wallet.invoice');
        Route::get('confirmation/{id}', 'confirmation')->name('wallet.confirmation');
        Route::put('confirmation/{id}', 'confirmationPut')->name('wallet.confirmation.put');
        Route::get('transfer', 'transfer')->name('wallet.transfer');
        Route::post('transfer', 'transferStore')->name('wallet.transfer.store');
        Route::get('withdraw', 'withdraw')->name('wallet.withdraw');
        Route::post('withdraw', 'withdrawStore')->name('wallet.withdraw.store');
    });

    // Network routes
    Route::prefix('network')->controller(NetworkController::class)->group(function () {
        Route::get('referrals', 'refferals')->name('network.referrals');
        Route::get('generation', 'generation')->name('network.generation');
    });

    // Register route
    Route::prefix('register')->controller(RegisterController::class)->group(function () {
        Route::get('', 'index')->name('register.index');
    });

    // Static pages
    Route::view('faq', 'user.faq', ['page' => 'faq'])->name('faq');
    Route::view('news', 'user.news', ['page' => 'news', 'news' => News::all()])->name('news');
    Route::view('download', 'user.download', ['page' => 'download', 'files' => File::all()])->name('download');

    // Testimonial routes
    Route::prefix('testimonial')->controller(TestimonialController::class)->group(function () {
        Route::get('', 'index')->name('testimonial.index');
        Route::get('add', 'addTestimonial')->name('testimonial.add');
        Route::post('add', 'testimoniPost')->name('testimonial.store');
        Route::get('edit/{id}', 'editTestimonial')->name('testimonial.edit');
        Route::put('edit/{id}', 'updateTestimonial')->name('testimonial.update');
    });
});

Route::post('export', [Export::class, 'export']);

Route::get('send-email', function () {
    Mail::raw('Ini email test', function ($message) {
        $message->to('alinia.meysa@gmail.com')
            ->subject('Test Email');
    });
});

Route::get('link-storage', function () {
    $target = storage_path('/app/public/');
    $symlink = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($target, $symlink);
});

Route::get('clear-cache', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
});

Route::get('send-email', function () {});

require __DIR__ . "/admin.php";
