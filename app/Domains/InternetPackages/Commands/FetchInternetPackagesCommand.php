<?php

namespace App\Domains\InternetPackages\Commands;

use App\Domains\InternetPackages\Actions\InternetPackageAction;
use App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO\CreateInternetPackageFromApiData;
use App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO\UpdateInternetPackageFromApiData;
use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use App\Domains\InternetPackages\Models\InternetPackage;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchInternetPackagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'internet_packages:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $internetPackagesGateway = new InternetPackageGateway;
        $newInternetPackages = $internetPackagesGateway->getSimApiPackages();
        $oldInternetPackages = $internetPackagesGateway->getPackagesFromApi();

        foreach ($newInternetPackages as $newInternetPackage) {
            try {
                $oldInternetPackage = $oldInternetPackages->firstWhere('package_id', $newInternetPackage['id']);

                $newInternetPackageData = [
                    'package_id' => $newInternetPackage['id'],
                    'name' => $newInternetPackage['name'],
                    'desc' => $newInternetPackage['desc'],
                    'cardPools' => $newInternetPackage['cardPools'],
                    'status' => $newInternetPackage['status'],
                    'type' => $newInternetPackage['type'],
                    'periodType' => $newInternetPackage['periodType'],
                    'period' => $newInternetPackage['period'],
                    'imgurl' => $newInternetPackage['imgurl'],
                    'priceInfo' => $newInternetPackage['priceInfo'],
                    'refuelingPackage' => $newInternetPackage['refuelingPackage'],
                    'createTime' => $newInternetPackage['createTime'],
                    'expireTime' => $newInternetPackage['expireTime'],
                    'lastModifyTime' => $newInternetPackage['lastModifyTime'],
                    'originalPriceInfo' => $newInternetPackage['originalPriceInfo'],
                    'ext' => $newInternetPackage['ext'],
                ];

                if ($oldInternetPackage) {
                    $newInternetPackageData['id'] = $oldInternetPackage->id;
                    $data = new UpdateInternetPackageFromApiData($newInternetPackageData);

                    (new InternetPackageAction)->updatePackageFromApi($data);

                    continue;
                }

                $data = new CreateInternetPackageFromApiData($newInternetPackageData);

                (new InternetPackageAction)->createPackageFromApi($data);
            } catch (\Exception $exception) {
                Log::channel('internet-package')->info($exception->getMessage());
            }
        }
    }
}
