<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('forex_id');
            $table->string('company_name');
            $table->string('phone_number')->nullable(true);
            $table->string('telephone_number')->nullable(true);
            $table->string('website')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('contact_person')->nullable(true);
            $table->string('status');
            $table->string('call_status')->nullable(true);
            $table->boolean('for_appointment')->default(false);
            $table->string('appointment_date')->nullable(true);
            $table->string('appointment_person')->nullable(true);
            $table->string('appointment_address')->nullable(true);
            $table->string('appointment_remarks')->nullable(true);
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
        Schema::dropIfExists('Lead');
    }
}
