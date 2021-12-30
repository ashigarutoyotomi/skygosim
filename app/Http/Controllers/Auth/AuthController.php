<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Get auth user data
     */
    public function me()
    {
        $user = Auth::user();

        if (!$user && !$user->id) {
            return null;
        }

        $userQuery = User::query()
            ->with([
                'sims.sim'
            ]);

        if ($user->role === User::USER_ROLE_ADMIN) {
            return $userQuery->find($user->id);
        }

        if ($user->role === User::USER_ROLE_DEALER) {
            return $userQuery->find($user->id);
        }

        return $userQuery->find($user->id);
    }
}
