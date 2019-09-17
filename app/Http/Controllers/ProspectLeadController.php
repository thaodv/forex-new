<?php

namespace App\Http\Controllers;

use App\ForexLog;
use App\ProspectLead;
use App\Call;
use Illuminate\Http\Request; 
use Session;
class ProspectLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['prospects'] = ProspectLead::whereForexId(Session::get('id'))->get();
        return view('prospect.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('prospect.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Add New Prospect Lead",
            'description'=>"Prospect Name: ".$request->client_name
        );
        ForexLog::create($log);
        ProspectLead::create($request->all());
        return redirect('prospect/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProspectLead  $prospectLead
     * @return \Illuminate\Http\Response
     */
    public function show(ProspectLead $prospectLead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProspectLead  $prospectLead
     * @return \Illuminate\Http\Response
     */
    public function edit(ProspectLead $prospectLead)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProspectLead  $prospectLead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->prospect_id;
        $update_data = array(
            
            'client_name'=>$request->update_client_name,
            'industry'=>$request->update_industry,
            'location'=>$request->update_location,
            'contact_person'=>$request->update_contact_person,
            'contact_number'=>$request->update_contact_number,
            'email'=>$request->update_email,
            'position'=>$request->update_position,
            'source_lead'=>$request->update_source_lead
        );

        ProspectLead::whereId($id)->update($update_data);        

        return redirect('/prospect/list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProspectLead  $prospectLead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ProspectLead::destroy($request->prospect_id); 
        return true;
    }

    public function onBoardProspect($prospect_id){
        Session::put('onboard_prospect',$prospect_id);
        return $prospect_id;
    }

    public function callsummary(Request $request){

        
        
        $call = new Call();
        $call->forex_id = Session::get('id');
        $call->prospect_id = $request->id;
        $call->call_outcome = $request->outcome_of_call.". ".$request->outcome_call;
        $call->other_details = $request->appointment_date;
        $call->save();
        $call_id = $call->id;

        
        $call = ProspectLead::find($request->id);
        $call->id = $request->id;
        $call->appointment_date = $request->appointment_date;
        $call->status = "Called: ".$request->outcome_of_call;
        $call->outcome_of_call = $call_id;
        $call->save();

        $log = array(
                    'forex_id'=>Session::get('id'),
                    'activity'=>"Initiate Call to Prospect Lead",
                    'description'=>"Prospect Name: ".$request->client_name
                );
        ForexLog::create($log);

        return redirect('prospect/list');

    }

    public function onboard(){
        return view('prospect.onboard');
        
    }

    public function callOutCome(Request $request){
        $call_id = $request->call_id;

        return $data['data']=Call::findOrFail($call_id)->first();

    }

}
