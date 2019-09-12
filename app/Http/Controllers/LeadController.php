<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Signature;
use App\Client;
use App\ForexLog;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;

class LeadController extends Controller
{

    public function list(){
        $leads = $this->leadList();
        return view('leads.lead_list',compact('leads'));
    }
    public function leadList(){
        $list = Lead::where('forex_id',Session::get('id'))->get();
        return $list;
    }

    public function create(){
        return view('leads.form_create');
    }

    public function store(Request $request){

        $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Add new lead",
            'description'=>"Lead Name: ".$request->company_name
        );
        ForexLog::create($log);

        $lead = new Lead();
        $lead->forex_id = Session::get('id');
        $lead->company_name = $request->company_name;
        $lead->phone_number = $request->phone_number;
        $lead->telephone_number = $request->telephone_number;
        $lead->website = $request->website;
        $lead->contact_person = $request->contact_person;
        $lead->email = $request->email;
        $lead->status = $request->status;
        $lead->save();
        return "Successfully added";

    }

    public function appointment(){
        $leads = $this->leadListStatus('Appointment');
        return view('leads.lead_list',compact('leads'));
    }
    public function leadListStatus($status){
        return Lead::where('call_status','=',$status)->get();
    }

    public function callSummary(Request $request){
        $company_name = "";
        $query = Lead::where('id',$request->id)->get('company_name');
        foreach($query as $q){
            $company_name = $q->company_name;
        }
        $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Initiate Call",
            'description'=>"Lead Name: ".$company_name. " | Outcome: ".$request->call_status
        );

        ForexLog::create($log);

        $call = Lead::find($request->id);
        $call->status = $request->status;
        $call->call_status = $request->call_status;
        if($request->call_status == "Appointment"){
            $call->for_appointment = true;
        }
        $call->appointment_date = $request->appointment_date;
        $call->appointment_person = $request->appointment_person;
        $call->appointment_address = $request->appointment_address;
        $call->appointment_remarks =$request->appointment_remarks;
        $call->save();

        return redirect('lead/list');
    }

    public function onboardLead(){
        return view('leads.form_onboard');
    }

    public function signature(){
        return view('leads.signature');
    }

    public function saveSignature(Request $request){
        $signature = $request->signature;
        $fileName = str_replace(' ',"",$request->signatory_name).".txt";
        Storage::disk('local')->put($fileName, $signature);

        $sign = new signature();
        $sign->forex_id = Session::get('id');
        $sign->owner = $request->signatory_name;
        $sign->signature = $fileName;
        $sign->save();
        $data = array(
            'msg'=>"Signature Saved",
            'signature' =>$signature
        );
        return  $data;

    }

    public function updateLeadAsClient(Request $requset){

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

    public function forApproval(){
        $data = array(
            'list'=>Client::where("status","!=","Approved")->get()
        ); 
        return view('leads.onboard_list',$data);
    }

    public function signatureWindow($signee){

        Session::put('signee','trader'.$signee);
        return view('leads.signature_window');
    }

}
