<?php

namespace App\Http\Controllers;

use App\Forex;
use App\Client;
use App\Lead;
use App\ForexLog;
use App\Liquidity;
use Illuminate\Http\Request;
use Session;
use App\Blotter;    

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
                $balance = Liquidity::findOrFail(1)->get('beginning_balance');
                foreach($balance as $b){
                    $balance = $b->beginning_balance;
                }
                $blotter_id = Blotter::max('id');
                if($blotter_id==null){
                    $blotter_id = 0;
                }
                Session::put('blotter_id',$blotter_id);
                

                Session::put('name',$data->first_name." ".$data->last_name);
                Session::put('user_type',$data->user_type);
                Session::put('id',$data->id);
                Session::put('beginning_balance',$balance);
            
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

    public function activityLogs(){
        $id = Session::get('id');
        $data['log'] = ForexLog::whereForexId($id)->get();
        return view('forex.log',$data);
    }

    public function assignTrader(){
        $data = array(
            'list'=>Client::whereStatus("Approved")->get(),
            'trader'=>Forex::where('user_type','=','Trader')->get()
            
        ); 
        return view('forex.assign_trader',$data);
    }

    public function saveTrader(Request $request){

        $client_id = $request->client_id;
        $trader_id = $request->trader_id;
        $update_data = array(
            'trader_id'=>$request->trader_id
        );
        tap(Client::whereId($client_id))->update($update_data);
 
        $client_name = "";
        $query = Client::where('id',$client_id)->get(['first_name','last_name']);

        foreach($query as $q){
            $client_name = $q->first_name." ".$q->last_name;
        }
        $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Trader Assignment",
            'description'=>"Client Name: ".$client_name.' | Trader ID: '.$request->trader_id
        );

        ForexLog::create($log);
        return response()->json(['msg'=>"saved"]);

     }

     public function traderName(Request $request){
         $trader_id = $request->trader_id;

         $query = Forex::whereId($trader_id)->get();
         foreach($query as $q){
             $trader['name'] = $q->first_name." ".$q->last_name;
         }
         return $trader;
     }

     public function setLiquidity(){
         return view('forex.liquidity');
     }
    
     public function saveLiquidity(Request $request){
        $id = Liquidity::create($request->all())->id;
        Session::put('liquidity_id',$id);
        return redirect('/trader/bookorder');
     }

}
