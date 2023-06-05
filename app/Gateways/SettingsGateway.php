<?php


namespace App\Gateways;


use App\Models\Settings;

class SettingsGateway
{
    public function getInternetPackagesPricePercentage()
    {
        $setting = Settings::find(Settings::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE);

        return $setting->value;
    }
}
