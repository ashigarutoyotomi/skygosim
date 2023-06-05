<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignFromUserInternetPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_internet_packages', function (Blueprint $table) {
            $table->dropForeign(['internet_package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_internet_packages', function (Blueprint $table) {
            $table->foreign('internet_package_id')
                ->on('internet_packages')
                ->references('id')
                ->onDelete('restrict');
        });
    }
}
