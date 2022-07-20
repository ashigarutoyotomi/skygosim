<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeInternetPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('internet_packages');

        Schema::create('internet_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_id');
            $table->string('name_en');
            $table->string('name_cn')->nullable();
            $table->string('name_hk')->nullable();
            $table->text('desc_en');
            $table->text('desc_cn')->nullable();
            $table->text('desc_hk')->nullable();

            $table->json('card_pools')->nullable();

            $table->integer('status')->nullable();
            $table->integer('type')->nullable();
            $table->integer('period_type')->nullable();
            $table->integer('period')->nullable();

            $table->string('imgurl')->nullable();

            $table->string('price_usd');
            $table->string('price_cny')->nullable();
            $table->string('price_hkd')->nullable();

            $table->json('refueling_package')->nullable();

            $table->string('activation_mode')->nullable();

            $table->timestamps();
            $table->softDeletes();
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

        Schema::create('internet_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_id');
            $table->string('name_en');
            $table->string('name_cn')->nullable();
            $table->string('name_hk')->nullable();
            $table->text('desc_en');
            $table->text('desc_cn')->nullable();
            $table->text('desc_hk')->nullable();

            $table->json('card_pools')->nullable();

            $table->integer('status')->nullable();
            $table->integer('type')->nullable();
            $table->integer('period_type')->nullable();
            $table->integer('period')->nullable();

            $table->string('imgurl')->nullable();

            $table->string('price_usd');
            $table->string('price_cny')->nullable();
            $table->string('price_hkd')->nullable();

            $table->json('refueling_package')->nullable();

            $table->string('activation_mode')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
