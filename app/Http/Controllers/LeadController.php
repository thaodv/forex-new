<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;
use Session;

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
        $leads = $this->leadListStatus('appointment');
        return view('leads.lead_list',compact('leads'));
    }
    public function leadListStatus($status){
        return Lead::where('status','=',$status);
    }

}
