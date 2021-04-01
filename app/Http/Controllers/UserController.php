<?php


namespace App\Http\Controllers;


use App\Http\Requests\Users\CreateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('first_name')->paginate(20);

        return $users;
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('first_name')),
            'role' => (int)$request->get('role')
        ]);

        return $user;
    }
}
