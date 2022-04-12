<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

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
    
    /**
    * logout
    *method to delete record of current users
    *
    * @return message(json) or report of failure
    */
    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
            Auth::user()->tokens()->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

    /**
     * login
     *method to login, it protected with middleware of sanctum
     *accepts json data to identify the user(email and password)
     * @param  mixed $request
     * @returns a response with token and user data on success,
     * if fail, returns only a message of failure
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.'],
            ], 401);
        }

        $token = $user->createToken('access-token')->plainTextToken;

        // response
        return response([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
