<?php


namespace App\Http\Middleware;


use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class IsDealerUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::user()->role === User::USER_ROLE_DEALER) {
            return $next($request);
        }

        return redirect('/');
    }
}
