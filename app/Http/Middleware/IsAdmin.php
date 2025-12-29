<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = User::find(Session::get('user_id'));

        if (!$user || $user->role !== 'admin') {
            return redirect()->route('user_show');
        }

        return $next($request);
    }
}
