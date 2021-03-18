<?php


namespace App\Imports;


use App\Models\InternetPackage;
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

        foreach ($data as $item) {
            $internetPackage = InternetPackage::firstOrCreate($item);
        }
    }
}
