<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('forex_id');
            $table->string('trader_id');
            $table->string('client_id');
            $table->string('bought_currency');
            $table->string('bought_amount');
            $table->string('sold_currency');
            $table->string('sold_amount');
            $table->string('rate'); 
            $table->string('total_amount')->nullable(true);
            $table->string('their_bank')->nullable(true);
            $table->string('our_bank')->nullable(true);
            $table->string('other_instructions')->nullable(true);
            $table->string('dealer')->nullable(true);
            $table->string('counter_party')->nullable(true);
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
        Schema::dropIfExists('orders');
    }

   
}
