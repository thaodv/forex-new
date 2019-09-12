<?php

namespace App\Http\Controllers;

use App\ForexLog;
use App\ProspectLead;
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
    public function update(Request $request, ProspectLead $prospectLead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProspectLead  $prospectLead
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProspectLead $prospectLead)
    {
        //
    }

    public function callsummary(Request $request){

        $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Initiate Call to Prospect Lead",
            'description'=>"Prospect Name: ".$request->client_name
        );
        ForexLog::create($log);
        
        $call = ProspectLead::find($request->id);
        $call->id = $request->id;
        $call->appointment_date = $request->appointment_date;
        $call->outcome_of_call = $request->outcome_of_call;
        $call->save();

        return redirect('prospect/list');

    }

    public function onboard(){
        return view('prospect.onboard');
    }

}
