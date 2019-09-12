<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquiditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('forex_id')->nullable(true);
            $table->string('beginning_balance')->nullable(true);
            $table->string('updated_balance')->nullable(true);
            $table->string('ending_balance')->nullable(true);
            $table->string('weighted_average')->nullable(true);
            $table->string('gain')->nullable(true);
            $table->string('average_margin')->nullable(true);
            $table->string('peso_amount')->nullable(true);
            $table->string('dollar_amount')->nullable(true);
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
        Schema::dropIfExists('liquidities');
    }
}
