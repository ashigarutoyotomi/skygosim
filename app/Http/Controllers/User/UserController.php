<?php


namespace App\Http\Controllers\User;


use App\Domains\User\Actions\UserAction;
use App\Domains\User\DTO\UserDTO\CreateUserData;
use App\Domains\User\Gateways\UserGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\InternetPackage;
use App\Models\Sim\SimOrder;
use App\Models\User;
use App\Models\User\UserSim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\DataTransferObject\DataTransferObjectError;

class UserController extends Controller
{
    public function me()
    {
        $user = Auth::user();

        if ($user->role === User::USER_ROLE_ADMIN) {
            return [
                'user' => $user,
            ];
        }

        if ($user->role === User::USER_ROLE_DEALER) {
            return [
                'user' => $user,
            ];
        }

        $user->load([
            'sims.sim'
        ]);

        return $user;
    }

    public function index()
    {
        $user = Auth::user();
        $gateway = new UserGateway;
        $users = [];

        if ($user->role === User::USER_ROLE_ADMIN) {
            return $gateway->paginate(20)
                ->getCustomers();
        }

        if ($user->role === User::USER_ROLE_DEALER) {
            return $gateway->paginate(20)
                ->getCustomersForDealer($user->id);
        }

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
        $userData = CreateUserData::fromRequest($request);

        return (new UserAction)->create($userData);
    }

    public function edit($user_id)
    {
        $user = Auth::user();

        if ($user->role === User::USER_ROLE_ADMIN) {
            return User::find($user_id);
        }

        if ($user->role === User::USER_ROLE_DEALER) {
            return User::where([
                'id' => $user_id,
                'creator_id' => $user->id,
            ])->first();
        }
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
