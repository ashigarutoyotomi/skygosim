<?php


namespace App\Exports;


use App\Models\Sim\Sim;
use App\Models\User\UserInternetPackage;
use Maatwebsite\Excel\Concerns\FromCollection;

class PurchasesInternetPackagesExport implements FromCollection
{

    public function collection()
    {
        $packages = UserInternetPackage::with([
            'user',
            'sim.dealer',
            'internet_package'
        ])->get();

        $fileData = collect();
        $fileData->push([
            'Dealer first name',
            'Dealer last name',
            'Dealer email',
            'Sim ICCID',
            'Sim type',
            'Package ID',
            'Package area',
            'Package price USD',
            'Customer first name',
            'Customer last name',
            'Customer email',
            'Bought price USD',
        ]);

        foreach ($packages as $key => $package) {
            $data = [];

            $data[] = $package->sim->dealer ? $package->sim->dealer->first_name : 'Empty';
            $data[] = $package->sim->dealer ? $package->sim->dealer->last_name : 'Empty';
            $data[] = $package->sim->dealer ? $package->sim->dealer->email : 'Empty';

            $data[] = $package->sim->iccid;

            switch ($package->sim->sim_type) {
                case Sim::SIM_TYPE_PHYSICAL:
                    $data[] = 'Physical';
                    break;
                case Sim::SIM_TYPE_E_SIM:
                    $data[] = 'E-SIM';
                    break;
                default:
                    $data[] = 'Other';
            }

            $data[] = $package->internet_package->package_id;
            $data[] = $package->internet_package->area_eng;
            $data[] = $package->internet_package->price_usd;

            $data[] = $package->user->first_name;
            $data[] = $package->user->last_name;
            $data[] = $package->user->email;

            $data[] = $package->bought_price;

            $fileData->push($data);
        }

        return $fileData;
    }
}
