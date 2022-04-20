<?php
use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Http\Controllers\Apn\ApnController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Countries\CountriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dealer\DealerController;
use App\Http\Controllers\InternetPackage\InternetPackageController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Pages\AddSimPageController;
use App\Http\Controllers\Pages\CartPageController;
use App\Http\Controllers\Pages\CheckoutPageController;
use App\Http\Controllers\Pages\FaqPageController;
use App\Http\Controllers\Pages\HomePageController;
use App\Http\Controllers\Pages\HowToPageController;
use App\Http\Controllers\Pages\MobileAppsPageController;
use App\Http\Controllers\Pages\PackagesPageController;
use App\Http\Controllers\Pages\ProfilePageController;
use App\Http\Controllers\Pages\SimPageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PagesController\ApnPageController;
use App\Http\Controllers\Purchases\PurchasesInternetPackagesController;
use App\Http\Controllers\Region\RegionController;
use App\Http\Controllers\Settings\SettingsController;
use App\Http\Controllers\Sim\SimController;
use App\Http\Controllers\Sim\SimOrderController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserController;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

//Route::get('/test', function() {
//    return config('services.sim_api.payorder');
//});
//
//
//Route::get('/test-mailgun', function() {
//    $userData = new CreateUserData([
//        'first_name' => 'First Name',
//        'last_name' => 'Last Name',
//        'email' => 'Email',
//        'password' => (new UserGateway)->getRandomPassword(),
//        'role' => User::USER_ROLE_USER,
//        'send_to_email' => true,
//    ]);
//
//    Mail::to('amanzhol.fvfy@gmail.com')->send(new UserCreatedMail($userData));
//});

//Route::get('/dataBundles/test', function () {
//    return (new InternetPackageGateway)->getSimApiPackages();
//});

//Route::get('/getCarrier/test', function () {
//    $client = new \GuzzleHttp\Client();
//
//    $endpoint = config('services.sim_api.get_access_token');
//    $response = $client->request('GET', $endpoint);
//
//    $statusCode = $response->getStatusCode();
//    $body = $response->getBody();
//
//    $content = null;
//    if ($statusCode === 200) {
//        $content = json_decode($body->getContents(), true);
//
//        $endpoint = config('services.sim_api.get_carrier');
//        $requestBody = [
//            'language' => 3,
//            'accessToken' => $content['accessToken'],
//        ];
//
//        try {
//            $response = $client->request('POST', $endpoint, ['form_params' => $requestBody]);
//        } catch (ClientException $e) {
//            dump(Message::toString($e->getRequest()));
//            dd(Message::toString($e->getResponse()));
//        }
//
//        $statusCode = $response->getStatusCode();
//        $body = $response->getBody();
//        $content = json_decode($body->getContents(), true);
//    }
//
//    return [
//        '$statusCode' => $statusCode,
//        '$content' => $content,
//    ];
//});

//Route::get('/test-api-payorder/{iccID}/{packageID}', function ($iccID, $packageID) {
//    $client = new \GuzzleHttp\Client();
//    $endpoint = env('SIM_API_APP_GET_ACCESS_TOKEN_ENDPOINT');
//    $response = $client->request('GET', $endpoint);
//    $statusCode = $response->getStatusCode();
//    $body = $response->getBody();
//    $content = json_decode($body->getContents(), true);
//    $endpoint = config('services.sim_api.payorder');
//    $unique_id = time() . mt_rand() . '-test';
//    $requestBody = [
//        'appKey' => env('SIM_API_APP_KEY'),
//        'accessToken' => $content['accessToken'],
//        'iccid' => $iccID,
//        'packageId' => $packageID,
//        'currency' => 'USD',
//        'ourOrderId' => $unique_id,
//    ];
//
//    try {
//        $response = $client->request('POST', $endpoint, ['form_params' => $requestBody]);
//    }
//    catch (ClientException $e) {
//        return [
//            'error getRequest' => Message::toString($e->getRequest()),
//            'error getResponse' => Message::toString($e->getResponse())
//        ];
//    }
//
//    $statusCode = $response->getStatusCode();
//    $body = $response->getBody();
//    $content = json_decode($body->getContents(), true);
//
//    return [
//        'statusCode' => $statusCode,
//        'body' => $body,
//        'content' => $content,
//    ];
//});

Route::get('/', [HomePageController::class, 'index']);

Route::get('/packages', [PackagesPageController::class, 'index']);
Route::get('/packages/getAllPackages', [PackagesPageController::class, 'getAllPackages']);
Route::post('/packages/checkout', [PackagesPageController::class, 'checkout']);

Route::get('/add-sim', [AddSimPageController::class, 'index']);
Route::post('/add-sim', [AddSimPageController::class, 'addSim']);

Route::get('/e-sim/order', [SimPageController::class, 'orderESim']);
Route::post('/e-sim/checkout', [SimPageController::class, 'checkoutESim']);

Route::get('/physical-sim/order', [SimPageController::class, 'orderPhysicalSim']);
Route::post('/physical-sim/checkout', [SimPageController::class, 'checkoutPhysicalSim']);

Route::get('/how-to', [HowToPageController::class, 'index']);
Route::get('/how-to-add-e-sim', [HowToPageController::class, 'howToAddESim']);

Route::get('/faq', [FaqPageController::class, 'index']);

Route::get('/apn', [ApnPageController::class, 'index']);

Route::get('/app', [MobileAppsPageController::class, 'index']);

Route::get('/checkout', [PagesController::class, 'checkout']);
Route::get('/checkout/e-sim', [PagesController::class, 'checkoutESim']);

Route::get('/checkout/result', [PagesController::class, 'checkoutResult']);

Route::get('/settings', [SettingsController::class, 'index']);


Route::middleware(['auth'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/cart', [CartPageController::class, 'index']);

    Route::get('/user-cart', [UserCartController::class, 'index']);
    Route::get('/user-cart/counts', [UserCartController::class, 'userCartCounts']);

    Route::delete('/user-cart/{user_cart_id}/delete', [UserCartController::class, 'delete']);

    Route::get('/order/{order_id}/checkout', [CheckoutPageController::class, 'checkoutOrder']);

    Route::post('/order/purchase', [CheckoutPageController::class, 'purchase']);
    Route::post('/order/store', [OrderController::class, 'store']);

    Route::get('/profile', [ProfilePageController::class, 'index']);

    Route::post('/packages/add-to-cart', [PackagesPageController::class, 'addToCart']);
});


Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard

    // Users

    // Dealers
    Route::get('/dealers', [DealerController::class, 'index']);
    Route::get('/dealers/all', [DealerController::class, 'all']);
    Route::get('/dealers/{dealer_id}/physical-sims', [DealerController::class, 'getPhysicalSims']);
    Route::get('/dealers/{dealer_id}/physical-sim-orders', [DealerController::class, 'getPhysicalSimOrders']);

    Route::post('/dealers/store', [DealerController::class, 'store']);
    Route::post('/dealers/{dealer_id}/update', [DealerController::class, 'update']);
    Route::post('/dealers/address/create', [DealerController::class, 'storeAddress']);
    Route::post('/dealers/set-physical-sims', [DealerController::class, 'setPhysicalSims']);

    // Internet Packages
    Route::get('/internet-packages', [InternetPackageController::class, 'index']);
    Route::get('/internet-packages-from-api', [InternetPackageController::class, 'getInternetPackagesFromApi']);
    Route::get('/internet-packages-from-file', [InternetPackageController::class, 'getInternetPackagesFromFile']);
//    Route::get('/internet-packages/get-available-packages', [InternetPackageController::class, 'getAvailablePackages']);
    Route::post('/internet-packages/upload_packages', [InternetPackageController::class, 'uploadPackages']);

    // Sims
    Route::get('/sims/physical/available', [SimController::class, 'getAvailablePhysicalSims']);
    Route::get('/sims/e-sims', [SimController::class, 'getESims']);
    Route::post('/sims/upload-file', [SimController::class, 'uploadSimsFromFile']);

    Route::get('/sim-orders', [SimOrderController::class, 'index']);
    Route::get('/sim-orders/{sim_order_id}/show', [SimOrderController::class, 'showPhysicalSim']);
    Route::post('/sim-orders/{sim_order_id}/add-physical-sim', [SimOrderController::class, 'addPhysicalSim']);
    Route::put('/sim-orders/{sim_order_id}/finish', [SimOrderController::class, 'finish']);

    // Purchases
    Route::get('/purchases/internet-packages', [PurchasesInternetPackagesController::class, 'index']);
    Route::get('/purchases/internet-packages-from-web', [PurchasesInternetPackagesController::class, 'purchasesFromWeb']);
    Route::get('/purchases/internet-packages-from-dashboard', [PurchasesInternetPackagesController::class, 'purchasesFromDashboard']);
    Route::get('/purchases/internet-packages/{id}/show', [PurchasesInternetPackagesController::class, 'show']);
    Route::get('/purchases/internet-packages/download-excel', [PurchasesInternetPackagesController::class, 'downloadExcel']);

    // Pages APNs
    Route::get('/pages/apns', [ApnController::class, 'index']);
    Route::get('/pages/apns/{apn_id}/show', [ApnController::class, 'show']);
    Route::get('/pages/apns/{apn_id}/edit', [ApnController::class, 'edit']);
    Route::post('/pages/apns/store', [ApnController::class, 'store']);
    Route::post('/pages/apns/{apn_id}/update', [ApnController::class, 'update']);

    // Regions
    Route::get('/regions', [RegionController::class, 'index']);
    Route::get('/regions/all', [RegionController::class, 'all']);
    Route::get('/regions/{region_id}/show', [RegionController::class, 'show']);
    Route::get('/regions/{region_id}/edit', [RegionController::class, 'edit']);
    Route::post('/regions/store', [RegionController::class, 'store']);
    Route::post('/regions/{region_id}/update', [RegionController::class, 'update']);

    // Countries
    Route::get('/countries', [CountriesController::class, 'index']);
    Route::get('/countries/all', [CountriesController::class, 'all']);
    Route::get('/countries/{country_id}/show', [CountriesController::class, 'show']);
    Route::get('/countries/{country_id}/edit', [CountriesController::class, 'edit']);
    Route::post('/countries/store', [CountriesController::class, 'store']);
    Route::post('/countries/{country_id}/update', [CountriesController::class, 'update']);

    // Settings
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::get('/settings/prices', [SettingsController::class, 'pricesSettings']);

    Route::post('/settings/update', [SettingsController::class, 'update']);
    Route::post('/settings/prices/store', [SettingsController::class, 'pricesSettingsStore']);
});


Route::middleware(['auth', 'can_see.dashboard'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/dashboard/load-data', [DashboardController::class, 'loadData']);
    Route::get('/dashboard/internet-packages-card/load-data', [DashboardController::class, 'internetPackagesCardLoadData']);

    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/widget-load-data', [UserController::class, 'widgetLoadData']);
    Route::get('/users/{user_id}/show', [UserController::class, 'show']);
    Route::get('/users/{user_id}/edit', [UserController::class, 'edit']);
    Route::get('/users/{user_id}/orders', [UserController::class, 'orders']);
    Route::get('/users/{user_id}/sims', [UserController::class, 'getSims']);
    Route::get('/users/{user_id}/internet-packages', [UserController::class, 'getInternetPackages']);
    Route::post('/users/create', [UserController::class, 'store']);
    Route::post('/users/{user_id}/update', [UserController::class, 'update']);
    Route::delete('/users/{user_id}/delete', [UserController::class, 'delete']);

    // Dealers
    Route::get('/dealers/{dealer_id}/cart/internet-packages', [DealerController::class, 'cartInternetPackages']);

    // Internet Packages
    Route::get('/internet-packages/orders', [InternetPackageController::class, 'orders']);
    Route::get('/internet-packages/get-available-packages', [InternetPackageController::class, 'getAvailablePackages']);
    Route::get('/internet-packages/widget/load-data', [InternetPackageController::class, 'getWidgetData']);
    Route::post('/internet-packages/activate-packages', [InternetPackageController::class, 'activatePackages']);
    Route::post('/internet-packages/checkout-packages', [InternetPackageController::class, 'checkoutPackages']);
    Route::post('/internet-packages/purchase-packages', [InternetPackageController::class, 'purchasePackages']);

    // Sims
    Route::get('/sims/get-available-sims', [SimController::class, 'getAvailableSims']);
    Route::get('/sims/physical', [SimController::class, 'getPhysicalSims']);
    Route::get('/sims/e-sims', [SimController::class, 'getESims']);
});
