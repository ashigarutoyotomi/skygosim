<?php


namespace App\Imports;


use App\Models\Sim\Sim;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SimImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rowTitles = [];
        $data = [];

        foreach ($rows[0] as $item) {
            switch ($item) {
                case 'MSISDN':
                    $rowTitles[] = 'msisdn';
                    break;
                case 'PIN2':
                    $rowTitles[] = 'pin_2';
                    break;
                case 'PUK1':
                    $rowTitles[] = 'puk_1';
                    break;
                case 'IMSI':
                    $rowTitles[] = 'imsi';
                    break;
                case 'ICCID':
                    $rowTitles[] = 'iccid';
                    break;
                case 'Download URL':
                    $rowTitles[] = 'download_url';
                    break;
            }
        }

        foreach ($rows as $key => $row) {
            if ($key > 0) {
                $rowData = [];

                foreach ($row as $columnKey => $column) {
                    if (array_key_exists($columnKey, $rowTitles)) {
                        $rowData[$rowTitles[$columnKey]] = $column;
                    }
                }

                $data[] = $rowData;
            }
        }

        foreach ($data as $item) {
            $item['sim_type'] = array_key_exists('download_url', $item) ? Sim::SIM_TYPE_E_SIM : Sim::SIM_TYPE_PHYSICAL;
            $item['sim_status'] = Sim::SIM_STATUS_NEW;

            Sim::firstOrCreate($item);
        }
    }
}
