<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthCustom
{
    public function handle(Request $request, Closure $next)
    {
        // 1️⃣ Allow public pages
        if ($request->is('/', 'login', 'login-check', 'regi', 'regi-store')) {
            return $next($request);
        }

        // 2️⃣ Not logged in → login
        if (!Session::has('user_id')) {
            return redirect()->route('login');
        }

        // 3️⃣ Get logged-in user
        $user = User::find(Session::get('user_id'));

        if (!$user) {
            Session::forget('user_id');
            return redirect()->route('login');
        }

        // 4️⃣ ROLE BASED REDIRECT (🔥 LOOP SAFE 🔥)

        // If ADMIN
        if ($user->role === 'admin') {
            // already on admin page → allow
            if ($request->routeIs('show')) {
                return $next($request);
            }

            // trying to open user page → redirect once
            if ($request->routeIs('user_show')) {
                return redirect()->route('show');
            }
        }

        // If NORMAL USER
        if ($user->role === 'user') {
            // already on user page → allow
            if ($request->routeIs('user_show')) {
                return $next($request);
            }

            // trying to open admin page → redirect once
            if ($request->routeIs('show')) {
                return redirect()->route('user_show');
            }
        }

        return $next($request);
    }
}
