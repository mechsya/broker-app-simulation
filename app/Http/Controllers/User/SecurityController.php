<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use PragmaRX\Google2FAQRCode\Google2FA;

class SecurityController extends Controller
{
    /**
     * Display the 2FA setup page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = User::find(Cookie::get('id'));

        $googlefa = new Google2FA();

        $secretKey = $googlefa->generateSecretKey();

        $qrcode = $googlefa->getQRCodeInline(env('APP_NAME'), $user->email, $secretKey);

        return view('user.security', [
            'page' => 'security.index',
            'qrcode' => $qrcode,
            'secretkey' => $secretKey
        ]);
    }

    /**
     * Save the 2FA secret code to the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        User::where('id', Cookie::get('id'))->update(['twoFactorCode' => $request->twoFactorCode]);

        return back()->with('success', 'Two-Factor Authentication has been enabled.');
    }
}
