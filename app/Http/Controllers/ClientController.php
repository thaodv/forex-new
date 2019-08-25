<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function list(){
        return Client::all();
    }

    public function create(){
        
    }

    public function store(Request $request){


    }


}
