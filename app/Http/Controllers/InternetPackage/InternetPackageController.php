<?php


namespace App\Http\Controllers\InternetPackage;


use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Domains\InternetPackages\Imports\InternetPackagesImport;
use App\Domains\InternetPackages\Models\InternetPackage;
use App\Domains\Sim\Models\Sim;
use App\Domains\User\Actions\UserCartAction;
use App\Domains\User\DTO\UserCartDTO\CreateUserCartData;
use App\Domains\User\Models\UserCart;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternetPackage\UploadInternetPackagesFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function activatePackages(Request $request)
    {
        $items = $request->all();
        $endpoint = "https://simapi.udbac.com/sim/v1/api/payorder";
        $client = new \GuzzleHttp\Client();
        $user = Auth::user();

        foreach ($items as $item) {
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
        }

        return true;
    }
}
