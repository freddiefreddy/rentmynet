<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedeemCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redeem_cards', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('code');
            $table->integer('pid')->unsigned();
            $table->foreign('pid')->references('pid')->on('package_details');
            $table->string('used');
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
        Schema::dropIfExists('redeem_cards');
    }
}
