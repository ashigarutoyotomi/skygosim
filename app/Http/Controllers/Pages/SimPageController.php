<?php


namespace App\Http\Controllers\Pages;


use App\Actions\Sim\SimOrderAction;
use App\Actions\Sim\SimOrderAddressAction;
use App\Actions\User\UserAction;
use App\Actions\User\UserAddressAction;
use App\Domains\Settings\Gateways\SettingGateway;
use App\Domains\Settings\Models\Setting;
use App\DTO\Sim\CreateSimOrderAddressData;
use App\DTO\Sim\CreateSimOrderData;
use App\DTO\User\CreateUserAddressData;
use App\DTO\User\CreateUserData;
use App\Gateways\Sim\SimGateway;
use App\Gateways\User\UserGateway;
use App\Helpers\PushId;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sim\OrderESimRequest;
use App\Http\Requests\Sim\OrderPhysicalSimRequest;
use App\Mail\Sim\ESimOrderMail;
use App\Mail\Sim\PhysicalSimOrderMail;
use App\Models\Sim\SimOrder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SimPageController extends Controller
{
    public function orderPhysicalSim()
    {
        $user = Auth::user();
        $orderPrice = (new SettingGateway)->getSettingValueById(Setting::ID_PHYSICAL_SIM_ORDER_PRICE);
        $shippingPrice = (new SettingGateway)->getSettingValueById(Setting::ID_PHYSICAL_SIM_SHIPPING_PRICE);

        if ($user) {
            $user->load('address');
        }

        return view('checkouts.physical-sim', [
            'user' => $user,
            'orderPrice' => $orderPrice,
            'shippingPrice' => $shippingPrice,
        ]);
    }

    public function orderESim()
    {
        $user = Auth::user();
        $orderPrice = (new SettingGateway)->getSettingValueById(Setting::ID_E_SIM_ORDER_PRICE);

        if ($user) {
            $user->load('address');
        }

        return view('checkouts.e-sim', [
            'user' => $user,
            'orderPrice' => $orderPrice,
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
                'status' => SimOrder::STATUS_NEW,
                'key' => PushId::generate(),
            ]);

            $simOrder = (new SimOrderAction)->create($simOrderData);

            $simOrderAddressData = new CreateSimOrderAddressData([
                'sim_order_id' => $simOrder->id,
                'street' => $request->get('street_address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip_code' => $request->get('zip_code'),
            ]);

            (new SimOrderAddressAction)->create($simOrderAddressData);

            Mail::to($simOrder->user->email)->send(new PhysicalSimOrderMail($simOrder));
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
                    'status' => SimOrder::STATUS_NEW,
                    'key' => PushId::generate(),
                ]);

                $simOrder = (new SimOrderAction)->create($simOrderData);

                Mail::to($simOrder->user->email)->send(new ESimOrderMail($simOrder));
            }
        }

        return $esim;
    }
}
