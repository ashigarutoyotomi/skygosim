<?php

use App\Models\Settings;
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
        Settings::insert([
            'id' => Settings::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE,
            'section' => Settings::SECTION_INTERNET_PACKAGES,
            'title' => 'Internet package price percentage',
            'type' => Settings::TYPE_NUMBER,
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
        Settings::find(Settings::ID_INTERNET_PACKAGE_PRICE_PERCENTAGE)->delete();
    }
}
