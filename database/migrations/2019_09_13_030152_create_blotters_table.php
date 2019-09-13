<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlottersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blotters', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('trader_id')->nullable(true); 
            $table->string('buy_war')->nullable(true);
            $table->string('dollar_bought')->nullable(true);
            $table->string('peso_sold')->nullable(true);
            $table->string('peso_bought')->nullable(true);
            $table->string('dollar_sold')->nullable(true);
            $table->string('sell_war')->nullable(true);
            $table->string('fx_position')->nullable(true);
            $table->string('tom_dollar_bought')->nullable(true);
            $table->string('tom_next_dollar_bought')->nullable(true);
            $table->string('liquidity_position_today')->nullable(true);
            $table->string('value_at_risk_dollar')->nullable(true);
            $table->string('value_at_rist_peso')->nullable(true);
            $table->string('tom_dollar_sold')->nullable(true);
            $table->string('tom_next_dollar_sold')->nullable(true); 
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
        Schema::dropIfExists('blotters');
    }
}
