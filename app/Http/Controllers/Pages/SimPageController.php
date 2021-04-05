<?php


namespace App\Http\Controllers\Pages;


use App\Actions\Sim\SimOrderAction;
use App\Actions\User\UserAction;
use App\Actions\User\UserAddressAction;
use App\DTO\Sim\CreateSimOrderData;
use App\DTO\User\CreateUserAddressData;
use App\DTO\User\CreateUserData;
use App\Gateways\Sim\SimGateway;
use App\Gateways\User\UserGateway;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sim\OrderESimRequest;
use App\Http\Requests\Sim\OrderPhysicalSimRequest;
use App\Models\Sim\SimOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SimPageController extends Controller
{
    public function orderPhysicalSim()
    {
        $user = Auth::user();

        if ($user) {
            $user->load('address');
        }

        return view('checkouts.physical-sim', [
            'user' => $user,
        ]);
    }

    public function orderESim()
    {
        $user = Auth::user();

        if ($user) {
            $user->load('address');
        }

        return view('checkouts.e-sim', [
            'user' => $user,
        ]);
    }

    public function checkoutPhysicalSim(OrderPhysicalSimRequest $request)
    {
        $user = User::where('email', $request->get('email_address'))->first();

        if (!$user) {
            $userData = new CreateUserData([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email_address'),
                'password' => (new UserGateway)->getRandomPassword(),
                'role' => User::USER_ROLE_USER,
                'send_to_email' => true,
            ]);

            $user = (new UserAction)->create($userData);
        }

        if (!$user->address) {
            $userAddressData = new CreateUserAddressData([
                'user_id' => $user->id,
                'street' => $request->get('street_address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip_code' => $request->get('zip_code'),
            ]);

            (new UserAddressAction)->create($userAddressData);
        }

        $payment = $user->charge(
            $request->get('amount') * 100,
            $request->get('payment_method_id'),
        );

        $payment = $payment->asStripePaymentIntent();

        if ($payment->status === 'succeeded') {
            $simOrderData = new CreateSimOrderData([
                'user_id' => $user->id,
                'sim_type' => SimOrder::SIM_TYPE_PHYSICAL,
                'status' => SimOrder::STATUS_NEW
            ]);

            (new SimOrderAction)->create($simOrderData);
        }

        return $payment;
    }

    public function checkoutESim(OrderESimRequest $request)
    {
        $user = User::where('email', $request->get('email_address'))->first();

        if (!$user) {
            $userData = new CreateUserData([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email_address'),
                'password' => (new UserGateway)->getRandomPassword(),
                'role' => User::USER_ROLE_USER,
                'send_to_email' => true,
            ]);

            $user = (new UserAction)->create($userData);
        }

        if (!$user->address) {
            $userAddressData = new CreateUserAddressData([
                'user_id' => $user->id,
                'street' => $request->get('street_address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip_code' => $request->get('zip_code'),
            ]);

            (new UserAddressAction)->create($userAddressData);
        }

        $esim = (new SimGateway)->getNewESim();

        if ($esim) {

            $payment = $user->charge(
                $request->get('amount') * 100,
                $request->get('payment_method_id'),
            );

            $payment = $payment->asStripePaymentIntent();

            if ($payment->status === 'succeeded') {
                $esim = (new SimGateway)->getNewESim();

                $simOrderData = new CreateSimOrderData([
                    'user_id' => $user->id,
                    'sim_id' => $esim->id,
                    'sim_type' => SimOrder::SIM_TYPE_E_SIM,
                    'status' => SimOrder::STATUS_NEW
                ]);

                (new SimOrderAction)->create($simOrderData);
            }
        }

        return $esim;
    }
}
