<?php


namespace App\Domains\InternetPackages\Imports;


use App\Domains\InternetPackages\Models\InternetPackageFromFile;
use App\Domains\Settings\Gateways\SettingGateway;
use App\Domains\Settings\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class InternetPackagesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rowTitles = $rows[0];
        $data = [];

        foreach ($rows as $key => $row) {
            if ($key > 0) {
                $rowData = [];

                foreach ($row as $columnKey => $column) {
                    $rowData[$rowTitles[$columnKey]] = $column;
                }

                $data[] = $rowData;
            }
        }

        if (count($data)) {
            $activeInternetPackages = InternetPackageFromFile::all();

            foreach ($data as $item) {
//                $price = $item['price_usd'];
//                $percentage = (new SettingGateway)->getSettingValueById(Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE);
//                $percentPrice = ((int)$price * (int)$percentage) / 100;
//                $item['gtt_price_usd'] = $price + $percentPrice;

                $oldInternetPackage = $activeInternetPackages->first(function ($activeInternetPackage) use ($item) {
                    return $activeInternetPackage->package_id === $item['package_id'];
                });

                if ($oldInternetPackage) {
                    $oldInternetPackage->price_usd = $item['price_usd'];
                    $oldInternetPackage->price_cny = $item['price_cny'];
                    $oldInternetPackage->price_hkd = $item['price_hkd'];
                    $oldInternetPackage->area_chn = $item['area_chn'];
                    $oldInternetPackage->area_eng = $item['area_eng'];
                    $oldInternetPackage->destination_chn = $item['destination_chn'];
                    $oldInternetPackage->destination_eng = $item['destination_eng'];
                    $oldInternetPackage->days = $item['days'];
                    $oldInternetPackage->data_chn = $item['data_chn'];
                    $oldInternetPackage->data_eng = $item['data_eng'];
                    $oldInternetPackage->package_name_chn = $item['package_name_chn'];
                    $oldInternetPackage->package_name_eng = $item['package_name_eng'];
                    $oldInternetPackage->validity_period = $item['validity_period'];
                    $oldInternetPackage->price_yen = $item['price_yen'];
                    $oldInternetPackage->admin_package_id = $item['admin_package_id'];
                    $oldInternetPackage->on_sale_channel_type = $item['on_sale_channel_type'];

                    $oldInternetPackage->save();

                    continue;
                }

                InternetPackageFromFile::create($item);
            }
        }
    }
}
