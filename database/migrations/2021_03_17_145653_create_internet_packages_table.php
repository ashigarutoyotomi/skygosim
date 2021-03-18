<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternetPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internet_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_id');
            $table->string('gtt_price_usd')->nullable();
            $table->float('price_usd');
            $table->float('price_cny');
            $table->float('price_hkd');
            $table->float('price_yen');
            $table->text('area_eng');
            $table->text('destination_eng');
            $table->string('data_eng');
            $table->text('package_name_eng');
            $table->integer('days');
            $table->integer('validity_period');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internet_packages');
    }
}
