<?php

namespace App\Http\Controllers;

use App\Forex;
use Illuminate\Http\Request;

class ForexController extends Controller
{
    
    public function index()
    {
        return view('forex.login');
    }

    public function login(Request $request)
    {
        if(empty($request->email) || empty($request->password)){
            return "Email and Password is required";        
        }
        else{
            return redirect('/dashboard');
        }
    }

    public function logout()
    {
        return view('forex.login');
    }

    public function dashboard()
    {
        return view('forex.dashboard'); 
    }

    public function create()
    {
        return view('forex.form_create');
    }

    public function store(Request $request)
    {
        Forex::create($request->all());
        
        return "Successfully added";
    }

    public function list()
    {
        $forex = $this->userList();
        return view('forex.user_list',compact('forex'));    
    }

    public function userList()
    {
        return Forex::all();
    }

    public function show(Forex $forex)
    {
        //
    }

    public function edit(Forex $forex)
    {
        //
    }

    public function update(Request $request, Forex $forex)
    {
        //
    }

    public function destroy(Forex $forex)
    {
        //
    }
}
