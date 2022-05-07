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
            $table->bigInteger('wallet_payer_id')->unsigned();
            $table->bigInteger('wallet_payee_id')->unsigned();
            $table->bigInteger('transaction_category_id')->default(1)->unsigned();
            $table->float('amount', 10, 2);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('wallet_payer_id')->references('id')->on('wallets');
            $table->foreign('wallet_payee_id')->references('id')->on('wallets');
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
