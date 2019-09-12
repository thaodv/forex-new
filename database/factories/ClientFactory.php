<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;
 

$factory->define(Client::class, function (Faker $faker) {
    return [
        "cis_form" => "Ind",
        "forex_id" => 1,
        "first_name" => $faker->name,
        "last_name" => $faker->name,
        "middle_name" => $faker->name,
        "purpose_of_txn" => "Buy Dollar",
        "occupation" => "CEO",
        "issued_id_number" => $faker->phoneNumber ,
        "present_address" => $faker->address,
        "permanent_address" => $faker->address,
        "civil_status" => "Single",
        "nationality" => "Filipino",
        "birthdate" => $faker->dateTime,
        "birthplace" => "Manila",
        "fund_source" => "Revenue",
        "bank_name" => "BDO",
        "bank_account_number" => $faker->phoneNumber ,
        "contact_number" => $faker->phoneNumber ,
        "email_address" => $faker->unique()->safeEmail,
        "auth_1_trader_name" => $faker->name,
        "auth_1_trader_position" => "CEO",
        "auth_1_trader_nationality" => "Filipino",
        "auth_1_trader_contact_number" => $faker->phoneNumber ,
        "auth_1_trader_signature" => "",//$faker->auth_1_trader_signature,
        "auth_2_trader_name" => $faker->name,
        "auth_2_trader_position" => "AVP",
        "auth_2_trader_nationality" => "American",
        "auth_2_trader_contact_number" => $faker->phoneNumber ,
        "auth_2_trader_signature" => "",//$faker->auth_2_trader_signature,
        "doc_gov_id" => "",//$faker->doc_gov_id,
        "doc_company_id" => "",//$faker->doc_company_id,
        "doc_billing_address" => "",//$faker->doc_billing_address,
        "cis_form_signature" => "",//$faker->cis_form_signature,
        "cis_form_signatory" => "",//$faker->cis_form_signatory,
        "cis_form_date_signed" => now(),
        "status" => "Approved",
        "total_transactions" => "0",
    ];
});
