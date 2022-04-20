<?php


namespace App\Http\Controllers\Purchases;


use App\Domains\User\Models\UserInternetPackage;
use App\Exports\PurchasesInternetPackagesExport;
use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
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

        $filters = json_decode($request->get('filters'), true);

        if ($filters) {
            if (array_key_exists('date_from', $filters) && $filters['date_from']) {
                $date = Carbon::parse($filters['date_from'])->toDateTimeString();
                $packagesQuery->where('created_at', '>=', $date);
            }

            if (array_key_exists('date_to', $filters) && $filters['date_to']) {
                $date = Carbon::parse($filters['date_to'])
                    ->toDateTimeString();
                $packagesQuery->where('created_at', '<=', $date);
            }

            if (array_key_exists('dealer_id', $filters) && $filters['dealer_id']) {
                $packagesQuery->whereHas('sim.dealer', function ($query) use ($filters) {
                    $query->where('id', $filters['dealer_id']);
                });
            }
        }

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

    public function purchasesFromWeb(Request $request)
    {
        $packagesQuery = UserInternetPackage::with([
            'user',
            'sim.dealer',
            'internet_package_from_file'
        ]);

        $packagesQuery->where('activated_from_type', UserInternetPackage::ACTIVATED_FROM_TYPE_WEB);

        $filters = json_decode($request->get('filters'), true);

        if ($filters) {
            if (array_key_exists('date_from', $filters) && $filters['date_from']) {
                $date = Carbon::parse($filters['date_from'])->toDateTimeString();
                $packagesQuery->where('created_at', '>=', $date);
            }

            if (array_key_exists('date_to', $filters) && $filters['date_to']) {
                $date = Carbon::parse($filters['date_to'])
                    ->toDateTimeString();
                $packagesQuery->where('created_at', '<=', $date);
            }

            if (array_key_exists('dealer_id', $filters) && $filters['dealer_id']) {
                $packagesQuery->whereHas('sim.dealer', function ($query) use ($filters) {
                    $query->where('id', $filters['dealer_id']);
                });
            }
        }

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

                    $query->orWhereHas('internet_package_from_file', function ($query) use ($like) {
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

    public function purchasesFromDashboard(Request $request)
    {
        $packagesQuery = UserInternetPackage::with([
            'user',
            'sim.dealer',
            'internet_package_from_file'
        ]);

        $packagesQuery->where('activated_from_type', UserInternetPackage::ACTIVATED_FROM_TYPE_DASHBOARD);

        $filters = json_decode($request->get('filters'), true);

        if ($filters) {
            if (array_key_exists('date_from', $filters) && $filters['date_from']) {
                $date = Carbon::parse($filters['date_from'])->toDateTimeString();
                $packagesQuery->where('created_at', '>=', $date);
            }

            if (array_key_exists('date_to', $filters) && $filters['date_to']) {
                $date = Carbon::parse($filters['date_to'])
                    ->toDateTimeString();
                $packagesQuery->where('created_at', '<=', $date);
            }

            if (array_key_exists('dealer_id', $filters) && $filters['dealer_id']) {
                $packagesQuery->whereHas('sim.dealer', function ($query) use ($filters) {
                    $query->where('id', $filters['dealer_id']);
                });
            }
        }

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

                    $query->orWhereHas('internet_package_from_file', function ($query) use ($like) {
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
            'internet_package_from_file'
        ])
            ->find($id);
    }

    public function downloadExcel()
    {
        return Excel::download(new PurchasesInternetPackagesExport, 'report.xlsx');
    }
}
