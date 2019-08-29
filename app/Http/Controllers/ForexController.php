<?php

namespace App\Http\Controllers;

use App\Forex;
use Illuminate\Http\Request;
use Session;

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

            $checkIfExists = Forex::where('email',$request->email)->where('password',$request->password)->first();
            
            if(empty($checkIfExists)){
                return "Not a user";
            }else{

                $data = Forex::where('email',$request->email)->first();
                $id = $data->id;

                $update_data = array(
                    'is_logged_in'=>true
                );
                Forex::whereId($id)->update($update_data);

                Session::put('name',$data->first_name." ".$data->last_name);
                Session::put('user_type',$data->user_type);
                Session::put('id',$data->id);

                return redirect('/dashboard/');
            }

         }
    }

    public function logout()
    {
        $id = Session::get('id');
        $update_data = array(
            'is_logged_in'=>false
        );
        Forex::whereId($id)->update($update_data);
        Session::flush();
        return redirect('/');
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
