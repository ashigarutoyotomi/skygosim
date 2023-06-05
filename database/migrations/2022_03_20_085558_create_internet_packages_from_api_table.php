<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternetPackagesFromApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internet_packages_from_api', function (Blueprint $table) {
            $table->id();
            $table->string('package_id');
            $table->json('name');
            $table->json('desc');
            $table->json('cardPools');
            $table->smallInteger('status');
            $table->smallInteger('type');
            $table->smallInteger('periodType');
            $table->smallInteger('period');
            $table->string('imgurl');
            $table->json('priceInfo');
            $table->json('refuelingPackage');
            $table->string('createTime');
            $table->string('expireTime');
            $table->string('lastModifyTime');
            $table->json('originalPriceInfo');
            $table->json('ext');
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
        Schema::dropIfExists('internet_packages_from_api');
    }
}
