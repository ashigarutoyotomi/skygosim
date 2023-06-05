<?php


namespace App\Domains\Settings\Gateways;


use App\Domains\Settings\Models\Setting;

class SettingGateway
{
    public function getPricesSettings()
    {
        return Setting::where('section', Setting::SECTION_PRICES)->get();
    }

    public function getSettingValueById(int $id)
    {
        $setting = Setting::find($id);

        return $setting->value;
    }
}
