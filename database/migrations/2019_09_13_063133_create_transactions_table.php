<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('forex_id')->nullable(true);
            $table->string('trader_id')->nullable(true);
            $table->string('client_id')->nullable(true);
            $table->string('txn_type')->nullable(true);
            $table->string('buy_war')->nullable(true);
            $table->string('dollar_bought')->nullable(true);
            $table->string('peso_sold')->nullable(true);
            $table->string('sell_war')->nullable(true);
            $table->string('peso_bought')->nullable(true);
            $table->string('dollar_sold')->nullable(true);
            $table->string('fx_position')->nullable(true);
            $table->string('tom_dollar_bought')->nullable(true);
            $table->string('tom_next_dollar_bought')->nullable(true);
            $table->string('liq_pos_today')->nullable(true);
            $table->string('var_dollar')->nullable(true);
            $table->string('var_peso')->nullable(true);
            $table->string('tom_dollar_sold')->nullable(true);
            $table->string('tom_next_dollar_sold')->nullable(true);
            $table->string('rate')->nullable(true);
            $table->string('their_bank')->nullable(true);
            $table->string('our_bank')->nullable(true);
            $table->string('instructions')->nullable(true);
            $table->string('confirmed_by')->nullable(true);
            $table->string('status')->nullable(true);
            $table->string('details')->nullable(true);
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
        Schema::dropIfExists('transactions');
    }
}
