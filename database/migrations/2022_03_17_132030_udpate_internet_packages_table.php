<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UdpateInternetPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('internet_packages');

        Schema::create('internet_packages', function (Blueprint $table) {
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

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('internet_packages');

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
            $table->timestampTz('expired_at')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }
}
