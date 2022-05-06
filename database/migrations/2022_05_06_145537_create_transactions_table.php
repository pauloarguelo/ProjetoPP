<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payer')->unsigned();
            $table->bigInteger('payee')->unsigned();
            $table->bigInteger('transaction_category_id')->unsigned();
            $table->float('value', 10, 2);
            $table->timestamps();

            $table->foreign('payer')->references('id')->on('users');
            $table->foreign('payee')->references('id')->on('users');
            $table->foreign('transaction_category_id')->references('id')->on('transaction_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
