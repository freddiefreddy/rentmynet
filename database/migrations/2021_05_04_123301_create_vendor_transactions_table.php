<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_transactions', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('uid')->unsigned();
            $table->foreign('uid')->references('id')->on('system_users');
            $table->string('account_no');
            $table->decimal('amount', 30,2);
            $table->string('status');
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
        Schema::dropIfExists('vendor_transactions');
    }
}
