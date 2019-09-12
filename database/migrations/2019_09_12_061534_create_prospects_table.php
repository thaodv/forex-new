<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospect_leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('forex_id')->nullable(true);
            $table->string('client_name')->nullable(true);
            $table->string('location')->nullable(true);
            $table->string('industry')->nullable(true);
            $table->string('contact_person')->nullable(true);
            $table->string('contact_number')->nullable(true);
            $table->string('position')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('source_lead')->nullable(true);
            $table->string('appointment_date')->nullable(true);
            $table->string('outcome_of_call')->nullable(true);
            $table->string('followup_activity')->nullable(true);
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
        Schema::dropIfExists('prospects');
    }
}
