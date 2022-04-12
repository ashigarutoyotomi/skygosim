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
    }
}
