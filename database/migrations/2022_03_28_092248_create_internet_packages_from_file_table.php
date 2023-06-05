<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternetPackagesFromFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internet_packages_from_file', function (Blueprint $table) {
            $table->id();

            $table->float('price_usd');
            $table->integer('price_cny');
            $table->integer('price_hkd');
            $table->text('area_chn')->nullable();
            $table->text('area_eng')->nullable();
            $table->text('destination_chn')->nullable();
            $table->text('destination_eng')->nullable();
            $table->integer('days');
            $table->text('data_chn')->nullable();
            $table->text('data_eng')->nullable();
            $table->text('package_name_chn')->nullable();
            $table->text('package_name_eng')->nullable();
            $table->string('package_id');
            $table->integer('validity_period');
            $table->integer('price_yen');
            $table->string('admin_package_id');
            $table->string('on_sale_channel_type');

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
        Schema::dropIfExists('internet_packages_from_file');
    }
}
