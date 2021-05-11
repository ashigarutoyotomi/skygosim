<?php

use App\Domains\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInternetPackagesSettingToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::insert([
            'id' => Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE,
            'section' => Setting::SECTION_PRICES,
            'title' => 'Internet package price percentage',
            'type' => Setting::TYPE_NUMBER,
            'value' => '20',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Setting::find(Setting::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE)->delete();
    }
}
