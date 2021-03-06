<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadactivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leadactivities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('forex_id');
            $table->string('lead_id');
            $table->string('activity');
            $table->string('description');
            $table->string('follow_up');
            $table->string('email');
            $table->string('contact_person');
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
        Schema::dropIfExists('LeadActivity');
    }
}
