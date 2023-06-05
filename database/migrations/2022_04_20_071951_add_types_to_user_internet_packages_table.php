<?php

use App\Domains\User\Models\UserInternetPackage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypesToUserInternetPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_internet_packages', function (Blueprint $table) {
            $table->integer('internet_package_from_type')->default(UserInternetPackage::INTERNET_PACKAGE_FROM_TYPE_FILE);
            $table->integer('activated_from_type')->default(UserInternetPackage::ACTIVATED_FROM_TYPE_WEB);
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
            $table->dropColumn('internet_package_from_type');
            $table->dropColumn('activated_from_type');
        });
    }
}
