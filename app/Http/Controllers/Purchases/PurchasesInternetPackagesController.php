<?php


namespace App\Http\Controllers\Purchases;


use App\Exports\PurchasesInternetPackagesExport;
use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\User\UserInternetPackage;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PurchasesInternetPackagesController extends Controller
{
    public function index(Request $request)
    {
        $packagesQuery = UserInternetPackage::with([
            'user',
            'sim.dealer',
            'internet_package'
        ]);

        $keywords = $request->get('keywords');

        if ($keywords) {
            $keywordParts = preg_split('/ /', $keywords, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($keywordParts as $index => $possiblePart) {
                $like = "%" . StringHelper::escapeLike($possiblePart) . "%";
                $whereClause = $index == 0 ? 'where' : 'orWhere';

                $packagesQuery->where(function($query) use ($like) {
                    $query->orWhereHas('sim.dealer', function ($query) use ($like) {
                        $query->where('first_name', 'like', $like)
                            ->orWhere('last_name', 'like', $like);
                    });

                    $query->orWhereHas('internet_package', function ($query) use ($like) {
                        $query->where('package_id', 'like', $like);
                    });

                    $query->orWhereHas('sim', function ($query) use ($like) {
                        $query->where('iccid', 'like', $like);
                    });

                    $query->orWhere('bought_price', 'like', $like);
                });
            }
        }

        return $packagesQuery
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    public function show($id)
    {
        return UserInternetPackage::with([
            'user',
            'sim.dealer',
            'internet_package'
        ])
            ->find($id);
    }

    public function downloadExcel()
    {
        return Excel::download(new PurchasesInternetPackagesExport, 'report.xlsx');
    }
}
