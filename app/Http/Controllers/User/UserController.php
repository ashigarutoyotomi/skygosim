<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\InternetPackage;
use App\Models\Sim\SimOrder;
use App\Models\User;
use App\Models\User\UserSim;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me()
    {
        $user = Auth::user();

        $user->load([
            'sims.sim'
        ]);

        return $user;
    }

    public function index()
    {
        $users = User::where('role', '!=', User::USER_ROLE_DEALER)
            ->orderBy('first_name')->paginate(20);

        return $users;
    }

    public function show($user_id)
    {
        return User::with([
            'address',
            'sims.sim'
        ])
            ->find($user_id);
    }

    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => (int)$request->get('role')
        ]);

        return $user;
    }

    public function edit($user_id)
    {
        return User::find($user_id);
    }

    public function update($user_id, UpdateUserRequest $request)
    {
        $user = User::find($user_id);

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');

        if ($request->get('password')) {
            if ($request->get('password') !== $request->get('confirm_password')) {
                abort(422, 'The confirm password and password must match.');
            } else {
                $user->password = bcrypt($request->get('password'));
            }
        }

        $user->role = $request->get('role');
        $user->save();

        return $user;
    }

    public function delete($user_id)
    {
        $user = User::find($user_id);
        $user->delete();

        return $user;
    }

    public function orders($user_id)
    {
        return SimOrder::with('user', 'sim')
            ->where('user_id', $user_id)->paginate(20);
    }

    public function getSims($user_id)
    {
        $userSims = UserSim::with('sim')
            ->where('user_id', $user_id)
            ->paginate(20);

        return $userSims;
    }

    public function getInternetPackages($user_id)
    {
        $internetPackages = InternetPackage::select('internet_packages.*')
            ->leftJoin('user_internet_packages as uip', 'uip.internet_package_id', 'internet_packages.id')
            ->where('uip.user_id', $user_id)
            ->paginate(20);

        return $internetPackages;
    }
}
