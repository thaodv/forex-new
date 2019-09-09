<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('forex_id');
            $table->string('first_name')->nullable(true);
            $table->string('middle_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('cis_form')->nullable(true);
            $table->string('purpose_of_txn')->nullable(true);
            $table->string('occupation')->nullable(true);
            $table->string('issued_id_number')->nullable(true);
            $table->string('present_address')->nullable(true);
            $table->string('permanent_address')->nullable(true);
            $table->string('civil_status')->nullable(true);
            $table->string('nationality')->nullable(true);
            $table->string('birthdate')->nullable(true);
            $table->string('birthplace')->nullable(true);
            $table->string('fund_source')->nullable(true);
            $table->string('bank_name')->nullable(true);
            $table->string('bank_account_number')->nullable(true);
            $table->string('contact_number')->nullable(true);
            $table->string('email_address')->nullable(true);
            $table->string('auth_1_trader_name')->nullable(true);
            $table->string('auth_1_trader_position')->nullable(true);
            $table->string('auth_1_trader_nationality')->nullable(true);
            $table->string('auth_1_trader_contact_number')->nullable(true);
            $table->string('auth_1_trader_signature')->nullable(true);
            $table->string('auth_2_trader_name')->nullable(true);
            $table->string('auth_2_trader_position')->nullable(true);
            $table->string('auth_2_trader_nationality')->nullable(true);
            $table->string('auth_2_trader_contact_number')->nullable(true);
            $table->string('auth_2_trader_signature')->nullable(true);
            $table->string('doc_gov_id')->nullable(true);
            $table->string('doc_company_id')->nullable(true);
            $table->string('doc_billing_address')->nullable(true);
            $table->string('cis_form_signature')->nullable(true);
            $table->string('cis_form_signatory')->nullable(true);
            $table->string('cis_form_date_signed')->nullable(true);
            $table->string('status')->nullable(true);
            $table->string('compliance')->nullable(true);
            $table->string('compliance_reason')->nullable(true);
            $table->string('total_transactions')->nullable(true);
            $table->string('phone_number')->nullable(true);
            $table->string('telephone_number')->nullable(true);
            $table->string('email')->nullable(true);
            $table->string('company_name')->nullable(true);
            $table->string('website')->nullable(true);
            $table->string('contact_person')->nullable(true);
            
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
        Schema::dropIfExists('Client');
    }
}
