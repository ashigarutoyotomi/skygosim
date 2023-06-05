<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sim_order_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sim_order_id');
            $table->text('street');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');

            $table->foreign('sim_order_id')
                ->on('sim_orders')
                ->references('id')
                ->onDelete('cascade');

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
        Schema::dropIfExists('sim_order_addresses');
    }
}
