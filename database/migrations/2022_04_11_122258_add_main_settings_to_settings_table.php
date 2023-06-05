<?php

use App\Domains\Settings\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMainSettingsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::insert([
            'id' => Setting::ID_DISABLE_INTERNET_PACKAGES_PURCHASING,
            'section' => Setting::SECTION_MAIN,
            'title' => 'Disable internet packages purchasing',
            'type' => Setting::TYPE_BOOLEAN,
            'value' => 0,
        ]);

        Setting::insert([
            'id' => Setting::ID_WHICH_INTERNET_PACKAGES_USE,
            'section' => Setting::SECTION_MAIN,
            'title' => 'Which internet packages use',
            'type' => Setting::TYPE_STRING,
            'value' => 'file',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $setting = Setting::find(Setting::ID_DISABLE_INTERNET_PACKAGES_PURCHASING);

        if ($setting) {
            $setting->delete();
        }

        $setting = Setting::find(Setting::ID_WHICH_INTERNET_PACKAGES_USE);

        if ($setting) {
            $setting->delete();
        }
    }
}
