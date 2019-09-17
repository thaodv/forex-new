<?php

namespace App\Http\Controllers;

use App\Client;
use App\Forex;
use App\Signature;
use App\ForexLog;
use App\Lead;
use App\ProspectLead;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{

    public function list(){
        $data = array(
            'list'=>Client::whereStatus("Approved")
                ->whereForexId(Session::get('id'))
                ->get(),
            'trader'=>Forex::whereUserType('Trader')->get()
        ); 
        return view('client.client_list',$data);
    }

    
    public function faoClientList(Request $request){

        $query = Client::whereStatus("Approved")
        ->whereForexId(Session::get('id'))
        ->where('first_name','like',$request->name.'%')
        ->get(['first_name']);

        $clientNameList = [];
        foreach($query as $name){
            array_push($clientNameList,$name->first_name);
        }
        $data['list']=$clientNameList;
        return $data;

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
        $client->auth_1_trader_signature = $request->auth_1_trader_signature_id;
        $client->auth_2_trader_name = $request->auth_2_trader_name;
        $client->auth_2_trader_position = $request->auth_2_trader_position;
        $client->auth_2_trader_nationality = $request->auth_2_trader_nationality;
        $client->auth_2_trader_contact_number = $request->auth_2_trader_contact_number;
        $client->auth_2_trader_signature =$request->auth_2_trader_signature_id;
        $client->doc_gov_id = "";//$request->doc_gov_id;
        $client->doc_company_id = "";//$request->doc_company_id;
        $client->doc_billing_address = "";//$request->doc_billing_address;
        $client->cis_form_signature = $request->client_signature_id;
        $client->cis_form_signatory = $request->client_signatory;
        $client->cis_form_date_signed = now();
        $client->status = "New";
        $client->total_transactions = "0";
        $client->save();
        $client_name = $request->first_name.' '.$request->last_name;

        $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Onboarding Client",
            'description'=>"Lead Name: ".$client_name.' | Compliance ID: '.$request->forex_id
        );

        $call = ProspectLead::find($request->prospect_id);
        $call->id = $request->prospect_id;
        $call->status = "Client"; 
        $call->save();

        ForexLog::create($log);
        return redirect('/client/list');

    }

    public function update(Request $request){

        $id = $request->client_id;
        $update_data = array(
            'status'=>$request->status,
            'compliance'=>$request->compliance,
            'compliance_reason'=>$request->reason,
            'compliance_time'=>date('Y-m-d H:i:s')
        );
        tap(Client::whereId($id))->update($update_data);
 
        $company_name = "";
        $query = Lead::where('id',$id)->get('company_name');
        foreach($query as $q){
            $company_name = $q->company_name;
        }
        $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Compliance Feedback",
            'description'=>"Lead Name: ".$company_name.' | Compliance ID: '.$request->compliance.' | Decision of Compliance: '.$request->status
        );

        ForexLog::create($log);
        return response()->json(['msg'=>"saved"]);


    }

    public function clientName(Request $request){
        $name = $request->name;
        $forex_id = $request->id;

        $list = Client::whereForexId($forex_id)
                    ->where('first_name','like',$name.'%')
                    ->orWhere('last_name','like',$name.'%')
                    ->get();
        $data = array(
            'list'=>$list
        );
        return $data;
    }

    public function saveSignature(Request $request ){
        
        $signature = $request->signatureId;
        $fileName = $signature.".txt";
        Storage::disk('local')->put($fileName, $request->signature);
        
        $sign = new Signature();
        $sign->forex_id = Session::get('id');
        $sign->owner = $signature;
        $sign->signature = $fileName;
        $sign->save();

        $img = str_replace('data:image/png;base64,', '', $request->signature);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents(storage_path()."/app/".$signature.".png", $data);

        return response()->json(['signature'=>$signature]);

    }

    public function getSignature(Request $request ){
        
        $sigId = $request->signatureId;
        $fileName =  $request->signatureId.".txt";
        $signature = file_get_contents(storage_path()."/app/".$fileName);
        return response()->json(['signature'=>$signature]);

    }


    public function traderList(){
        $data = array(
            'list'=>Client::whereStatus("Approved")
                ->whereTraderId(Session::get('id'))
                ->get()
        ); 
        return view('trader.trader_list',$data);
    }

    public function getClientDetails(Request $request){
        $clientId = $request->client_id;
        $data = Client::whereId($client_id)->get(['first_name','last_name']);
        foreach($data as $d){
            $name = $d->first_name." ".$d->last_name;
        }
        return $name;
    }

    public function atp(){

        $data['client']= Client::whereForexId(Session::get('id'))->get();
        return view('client.form_atp',$data);

    }

    public function saveAtpForm(){

    }
}
