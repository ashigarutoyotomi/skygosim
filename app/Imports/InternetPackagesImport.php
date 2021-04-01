<?php


namespace App\Imports;


use App\Gateways\SettingsGateway;
use App\Models\InternetPackage;
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
            $activeInternetPackages = InternetPackage::whereNull('expired_at')->get();

            foreach ($data as $item) {
                InternetPackage::create($item);
            }

            if ($activeInternetPackages->count()) {
                foreach ($activeInternetPackages as $activeInternetPackage) {
                    $activeInternetPackage->expired_at = Carbon::now();
                    $activeInternetPackage->save();
                }
            }
        }
    }
}
