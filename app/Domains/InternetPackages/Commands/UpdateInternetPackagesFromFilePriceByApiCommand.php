<?php

namespace App\Domains\InternetPackages\Commands;

use App\Domains\InternetPackages\Actions\InternetPackageAction;
use App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO\CreateInternetPackageFromApiData;
use App\Domains\InternetPackages\DTO\InternetPackageFromApiDTO\UpdateInternetPackageFromApiData;
use App\Domains\InternetPackages\Gateways\InternetPackageGateway;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateInternetPackagesFromFilePriceByApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'internet_packages:update_prices_by_api';

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
        $oldInternetPackages = $internetPackagesGateway->getPackagesFromFile();

        foreach ($newInternetPackages as $newInternetPackage) {
//            foreach ($newInternetPackagesPart as $newInternetPackage) {
//                try {
                    $oldInternetPackage = $oldInternetPackages->firstWhere('package_id', $newInternetPackage['id']);

                    if ($oldInternetPackage) {
                        $priceKey = array_search('840', array_column($newInternetPackage['priceInfo'], 'currencyCode'));
                        $price = $newInternetPackage['priceInfo'][$priceKey]['price'] / 100;
                        $oldInternetPackage->price_usd = $price;
                        $oldInternetPackage->save();
                    }
//                } catch (\Exception $exception) {
//                    Log::channel('internet-package')->info($exception->getMessage());
//                }
//            }
        }
    }
}
