<?php


namespace App\Http\Middleware;


use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CanSeeDashboard
{
    public function handle(Request $request, Closure $next)
    {
        // If is admin
        if (\Auth::user()->role === User::USER_ROLE_ADMIN) {
            return $next($request);
        }

        // If is dealer
        if (\Auth::user()->role === User::USER_ROLE_DEALER) {
            return $next($request);
        }

        return redirect('/');
    }
}
