<?php


namespace App\Http\Controllers\InternetPackage;


use App\Actions\User\UserAddressAction;
use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Domains\InternetPackages\Imports\InternetPackagesImport;
use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\Settings\Gateways\SettingGateway;
use App\Domains\Settings\Models\Setting;
use App\Domains\Sim\Models\Sim;
use App\Domains\User\Actions\UserCartAction;
use App\Domains\User\DTO\UserCartDTO\CreateUserCartData;
use App\Domains\User\Models\UserCart;
use App\DTO\User\CreateUserAddressData;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternetPackage\Purchase\PurchaseInternetPackagesRequest;
use App\Http\Requests\InternetPackage\UploadInternetPackagesFileRequest;
use App\Models\User;
use App\Models\User\UserInternetPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class InternetPackageController extends Controller
{
    public function index()
    {
        $internetPackagesGateway = new InternetPackageGateway;

        return $internetPackagesGateway
            ->toggleGTTPrice(true)
            ->getPaginatedInternetPackages();
    }

    public function uploadPackages(UploadInternetPackagesFileRequest $request)
    {
        Excel::import(new InternetPackagesImport, $request->file);

        return true;
    }

    public function getAvailablePackages(Request $request)
    {
        $keywords = $request->get('keywords');
        $filters = json_decode($request->get('filters'), true);

        $gateway = (new InternetPackageGateway())
            ->setFilters($filters)
            ->setKeywords($keywords)
            ->limit(10);

        return $gateway->getPackages();
    }

    public function getWidgetData()
    {
        $user = Auth::user();

        $inventoryCount = InternetPackage::whereNull('expired_at')->count();
        $purchased = collect([]);

        if ($user->role === User::USER_ROLE_ADMIN) {
            $purchased = UserCart::where([
                'item_type' => UserCart::ITEM_TYPE_INTERNET_PACKAGE,
                'status' => UserCart::CART_STATUS_FINISHED,
            ])->get();
        } else if ($user->role === User::USER_ROLE_DEALER) {
            $dealerUserIds = User::where('creator_id', $user->id)->pluck('id');

            $purchased = UserCart::where([
                'item_type' => UserCart::ITEM_TYPE_INTERNET_PACKAGE,
                'status' => UserCart::CART_STATUS_FINISHED,
            ])->where(function ($query) use ($user, $dealerUserIds) {
                $query->where('user_id', $user->id)
                    ->orWhereIn('user_id', $dealerUserIds);
            })->get();
        }

        $totalPurchasedPrice = 0;

        foreach ($purchased as $item) {
            $totalPurchasedPrice += $item->price;
        }

        return [
            'inventoryCount' => $inventoryCount,
            'purchased' => $purchased->count(),
            'totalPurchasedPrice' => $totalPurchasedPrice,
        ];
    }

    public function activatePackages(Request $request)
    {
        $items = $request->all();
        $endpoint = env('SIM_API_ACTIVATE_PACKAGE', '');
        $client = new \GuzzleHttp\Client();
        $user = Auth::user();

        foreach ($items as $item) {
            try {
                $sim = Sim::where([
                    'iccid' => $item['iccid'],
                ])->first();
                abort_unless($sim, 404, 'This iccid is not available.');

                $internetPackage = InternetPackage::where([
                    'package_id' => $item['packageId'],
                    'expired_at' => null,
                ])->first();
                abort_unless($internetPackage, 404, 'This package is not available.');

                $userCartData = new CreateUserCartData([
                    'user_id' => $user->id,
                    'item_type' => UserCart::ITEM_TYPE_INTERNET_PACKAGE,
                    'item_id' => $internetPackage->id,
                    'sim_id' => $sim->id,
                    'quantity' => 1,
                    'currency' => UserCart::CURRENCY_USD,
                    'price' => 0.0,
                    'status' => UserCart::CART_STATUS_NEW,
                ]);

                $userCart = (new UserCartAction)->create($userCartData);

                $response = $client->request('POST', $endpoint, ['query' => [
                    'iccid' => $item['iccid'],
                    'packageId' => $item['packageId'],
                    'currency' => 'USD',
                    'ourOrderID' => 'skygosimorderid' . $item['packageId'],
                ]]);

                $statusCode = $response->getStatusCode();
                $content = $response->getBody();

                $userCart->status = UserCart::CART_STATUS_FINISHED;
                $userCart->save();
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
            }
        }

        return true;
    }

    public function checkoutPackages(Request $request)
    {
        $items = $request->all();
        $user = Auth::user();
        $carts = [];

        foreach ($items as $item) {
            try {
                $sim = Sim::where([
                    'iccid' => $item['iccid'],
                ])->first();
                abort_unless($sim, 404, 'This iccid is not available.');

                $internetPackage = InternetPackage::where([
                    'package_id' => $item['packageId'],
                    'expired_at' => null,
                ])->first();
                abort_unless($internetPackage, 404, 'This package is not available.');

                $price = $internetPackage->price_usd;

                $userCartData = new CreateUserCartData([
                    'user_id' => $user->id,
                    'item_type' => UserCart::ITEM_TYPE_INTERNET_PACKAGE,
                    'item_id' => $internetPackage->id,
                    'sim_id' => $sim->id,
                    'quantity' => 1,
                    'currency' => UserCart::CURRENCY_USD,
                    'price' => $price,
                    'status' => UserCart::CART_STATUS_NEW,
                ]);

                $userCart = (new UserCartAction)->create($userCartData);

                if ($userCart) {
                    $carts[] = $userCart;
                }
            } catch (\Exception $exception) {
                Log::info($exception->getMessage());
            }
        }

        return $carts;
    }

    public function purchasePackages(PurchaseInternetPackagesRequest $request)
    {
        $user = Auth::user();
        $carts = $request->cart;

        $user->load([
            'address'
        ]);

        if ($user && !$user->address) {
            $userAddressData = new CreateUserAddressData([
                'user_id' => $user->id,
                'street' => $request->get('street_address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip_code' => $request->get('zip_code'),
            ]);

            (new UserAddressAction)->create($userAddressData);
        }

        try {
            $payment = $user->charge(
                $request->input('amount') * 100,
                $request->input('payment_method_id'),
            );

            $payment = $payment->asStripePaymentIntent();

            $endpoint = env('SIM_API_ACTIVATE_PACKAGE', '');
            $client = new \GuzzleHttp\Client();

            foreach ($carts as $cartItem) {
                $cart = UserCart::find($cartItem['id']);

                $package = InternetPackage::find($cart->item_id);
                $sim = Sim::find($cart->sim_id);

                if ($user && $package && $sim) {
                    $response = $client->request('POST', $endpoint, ['query' => [
                        'iccid' => $sim->iccid,
                        'packageId' => $package->package_id,
                        'currency' => 'USD',
                        'ourOrderID' => 'skygosimorderid' . $request->input('package_id'),
                    ]]);

                    $statusCode = $response->getStatusCode();
                    $content = $response->getBody();

                    UserInternetPackage::create([
                        'user_id' => $user->id,
                        'sim_id' => $sim->id,
                        'internet_package_id' => $package->id,
                        'bought_price' => $cart->price,
                    ]);

                    $cart->status = UserCart::CART_STATUS_FINISHED;
                    $cart->save();
                }
            }

            return [
                'payment' => $payment,
            ];
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function orders()
    {
        //
    }
}
