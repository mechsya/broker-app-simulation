<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cookieUser = Cookie::get('id');

        if (!$cookieUser) {
            return redirect()->route('auth.signin');
        }

        $user = User::find($cookieUser);

        if (!$user) {
            return redirect()->route('auth.signin')->withCookie(Cookie::forget('id'));
        }

        if ($user->role == 'admin') {
            return redirect()->route('dashboard.home');
        }

        return $next($request);
    }
}
