<?php

use App\Domains\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class AddPackagePricePercentageToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $setting = Setting::find(Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE);

        if ($setting) {
            $setting->delete();
        }

        Setting::insert([
            'id' => Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE,
            'section' => Setting::SECTION_PRICES,
            'title' => 'Internet packages price percentage',
            'type' => Setting::TYPE_NUMBER,
            'value' => '20',
        ]);

        Setting::insert([
            'id' => Setting::ID_PHYSICAL_SIM_ORDER_PRICE,
            'section' => Setting::SECTION_PRICES,
            'title' => 'Physical sim order price',
            'type' => Setting::TYPE_NUMBER,
            'value' => '2',
        ]);

        Setting::insert([
            'id' => Setting::ID_PHYSICAL_SIM_SHIPPING_PRICE,
            'section' => Setting::SECTION_PRICES,
            'title' => 'Physical sim shipping price',
            'type' => Setting::TYPE_NUMBER,
            'value' => '5',
        ]);

        Setting::insert([
            'id' => Setting::ID_E_SIM_ORDER_PRICE,
            'section' => Setting::SECTION_PRICES,
            'title' => 'E-SIM order price',
            'type' => Setting::TYPE_NUMBER,
            'value' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $setting = Setting::find(Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE);

        if ($setting) {
            $setting->delete();
        }

        $setting = Setting::find(Setting::ID_PHYSICAL_SIM_ORDER_PRICE);

        if ($setting) {
            $setting->delete();
        }

        $setting = Setting::find(Setting::ID_PHYSICAL_SIM_SHIPPING_PRICE);

        if ($setting) {
            $setting->delete();
        }

        $setting = Setting::find(Setting::ID_E_SIM_ORDER_PRICE);

        if ($setting) {
            $setting->delete();
        }

        Setting::insert([
            'id' => Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE,
            'section' => Setting::SECTION_PRICES,
            'title' => 'Internet package price percentage',
            'type' => Setting::TYPE_NUMBER,
            'value' => '20',
        ]);
    }
}
