<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{

    public function list(){
        $leads = $this->leadList();
        return view('leads.lead_list',compact('leads'));
    }
    public function leadList(){
        return Lead::all();
    }

    public function create(){
        return view('leads.form_create');
    }

    public function store(Request $request){

        Lead::create($request->all());
        return "Successfully added";

    }
}
