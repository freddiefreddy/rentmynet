<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWifiInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifi_infos', function (Blueprint $table) {
            $table->Increments('Wi_id');
            $table->integer('vuid')->unsigned();
            $table->foreign('vuid')->references('id')->on('system_users')->onDelete('cascade');
            $table->string('SSID');
            $table->string('BSSID');
            $table->string('password');
            $table->decimal('link_speed', 30,2);
            $table->decimal('up_speed', 30,2);
            $table->decimal('down_speed', 30,2);
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
        Schema::dropIfExists('wifi_infos');
    }
}
