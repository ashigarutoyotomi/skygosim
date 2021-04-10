<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sims', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('msisdn')->nullable();
            $table->string('imsi');
            $table->string('iccid');
            $table->string('pin_2');
            $table->string('puk_1');
            $table->integer('sim_type');
            $table->string('download_url')->nullable();
            $table->integer('sim_status');

            $table->foreign('dealer_id')
                ->on('users')
                ->references('id');

            $table->foreign('user_id')
                ->on('users')
                ->references('id');

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
        Schema::dropIfExists('sims');
    }
}
