<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWifiHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifi_histories', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('wi_id')->unsigned();
            $table->foreign('wi_id')->references('Wi_id')->on('wifi_infos');
            $table->integer('uid')->unsigned();
            $table->foreign('uid')->references('id')->on('system_users');
            $table->integer('time_used');
            $table->decimal('mb_used', 30,2);
            $table->decimal('rent', 30,2);
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
        Schema::dropIfExists('wifi_histories');
    }
}
