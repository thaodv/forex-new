<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
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
        'biz_legal_name',
        'biz_trade_name',
        'biz_tel_number',
        'biz_fax_number',
        'biz_email',
        'biz_website',
        'nature_of_biz',
        'biz_tin',
        'biz_bank_name',
        'biz_bank_account_no',
        'biz_bsp_license_no',
        'biz_bsp_issuance',
        'biz_primary_contact_person',
        'biz_contact_id',
        'biz_sec',
        'biz_dti_number',
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
        'compliance',
        'compliance_reason',
        'total_transactions',
    ];

    public function trader(){
        return $this->hasOne('App\Forex');
    }
}
