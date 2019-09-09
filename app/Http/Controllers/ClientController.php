<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function list(){
        $data = array(
            'list'=>Client::whereStatus("Approved")->get()
        ); 
        return view('client.client_list',$data);
    }
    
    public function create(){
        
    }

    public function onboard(){
        $data = array(
            'onboard'=>Client::whereStatus('New')->get()
        );
        return view('client.onboard_list',$data);
    }

    public function profile($id){
        $data = array(
            'data'=>Client::whereId($id)->get()
        );
        return view('client.profile',$data);
    }
    public function store(Request $request){
        
        $client = new Client();
        $client->cis_form = $request->cis_form;
        $client->forex_id = $request->forex_id;
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->middle_name = $request->middle_name;
        $client->purpose_of_txn = $request->purpose_of_txn;
        $client->occupation = $request->occupation;
        $client->issued_id_number = $request->issued_id_number;
        $client->present_address = $request->present_address;
        $client->permanent_address = $request->permanent_address;
        $client->civil_status = $request->civil_status;
        $client->nationality = $request->nationality;
        $client->birthdate = $request->birthdate;
        $client->birthplace = $request->birthplace;
        $client->fund_source = $request->fund_source;
        $client->bank_name = $request->bank_name;
        $client->bank_account_number = $request->bank_account_number;
        $client->contact_number = $request->contact_number;
        $client->email_address = $request->email_address;
        $client->auth_1_trader_name = $request->auth_1_trader_name;
        $client->auth_1_trader_position = $request->auth_1_trader_position;
        $client->auth_1_trader_nationality = $request->auth_1_trader_nationality;
        $client->auth_1_trader_contact_number = $request->auth_1_trader_contact_number;
        $client->auth_1_trader_signature = "";//$request->auth_1_trader_signature;
        $client->auth_2_trader_name = $request->auth_2_trader_name;
        $client->auth_2_trader_position = $request->auth_2_trader_position;
        $client->auth_2_trader_nationality = $request->auth_2_trader_nationality;
        $client->auth_2_trader_contact_number = $request->auth_2_trader_contact_number;
        $client->auth_2_trader_signature = "";//$request->auth_2_trader_signature;
        $client->doc_gov_id = "";//$request->doc_gov_id;
        $client->doc_company_id = "";//$request->doc_company_id;
        $client->doc_billing_address = "";//$request->doc_billing_address;
        $client->cis_form_signature = "";//$request->cis_form_signature;
        $client->cis_form_signatory = "";//$request->cis_form_signatory;
        $client->cis_form_date_signed = now();
        $client->status = "New";
        $client->total_transactions = "0";

        $client->save();

        return $request->all();

    }

    public function update(Request $request){

        $id = $request->client_id;
        $update_data = array(
            'status'=>$request->status,
            'compliance'=>$request->compliance,
            'compliance_reason'=>$request->reason
        );
        tap(Client::whereId($id))->update($update_data);
 
        return response()->json(['msg'=>"saved"]);


    }


}
