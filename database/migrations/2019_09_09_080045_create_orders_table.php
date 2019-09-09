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
            $table->string('client_id');
            $table->string('from_currency');
            $table->string('from_amount');
            $table->string('to_currency');
            $table->string('to_amount');
            $table->string('exchange_value');
            $table->string('fee');
            $table->string('total_amount');
            $table->string('status');
            $table->string('details');
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
