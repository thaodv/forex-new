<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
            'forex_id',
            'first_name',
            'last_name',
            'middle_name',
            'cis_form',
            'purpose_of_txn',
            'occupation',
            'issued_id_number',
            'present_address',
            'permanent_address',
            'civil_status',
            'nationality',
            'birthdate',
            'birthplace',
            'fund_source',
            'bank_name',
            'bank_account_number',
            'contact_number',
            'email_address',
            'auth_1_trader_name',
            'auth_1_trader_position',
            'auth_1_trader_nationality',
            'auth_1_trader_contact_number',
            'auth_1_trader_signature',
            'auth_2_trader_name',
            'auth_2_trader_position',
            'auth_2_trader_nationality',
            'auth_2_trader_contact_number',
            'auth_2_trader_signature',
            'doc_gov_id',
            'doc_company_id',
            'doc_billing_address',
            'cis_form_signature',
            'cis_form_signatory',
            'cis_form_date_signed',
            'status',
            'total_transactions',
            'phone_number',
            'telephone_number',
            'email',
            'company_name',
            'website',
            'contact_person'
    ];

    public function trader(){
        return $this->hasOne('App\Forex');
    }
}
