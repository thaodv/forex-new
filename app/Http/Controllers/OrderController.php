<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use Session;    
use App\Forex;
use App\Client;
use App\Liquidity;
use App\ForexLog;
use App\Blotter;
class OrderController extends Controller
{
    //
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
            'activity'=>"Booking Order",
            'description'=>"Client Name: ".$request->client_id.' | FAO ID: '.$request->forex_id
        );

        ForexLog::create($log);

        $bought_currency = $request->bought_currency;
        $buy_war = "0.00";
        $sell_war = "0.00";
        $blot = new Blotter();
        //BUY Dollar
        if($bought_currency == "USD"){

            $dollar_bought = $request->bought_amount;
            $peso_sold =$request->sold_amount;
            $buy_war = $peso_sold / $dollar_bought;
            $blot->buy_war = $buy_war;
            $blot->dollar_bought = $dollar_bought;
            $blot->peso_sold = $peso_sold;
        }
        //SELL Dollar
        else{

            $peso_bought = $request->bought_amount;
            $dollar_sold = $request->sold_amount;
            $sell_war = $peso_bought / $dollar_sold;
            $blot->dollar_sold = $dollar_sold;
            $blot->peso_bought = $peso_bought;
            $blot->sell_war = $sell_war;
        }
           
            $blot->trader_id = Session::get('id');
            $blotter_id = Session::get('blotter_id');
            
            if($blotter_id != null){
                $blot->id = Session::get('blotter_id');
                $blot->update();
            }else{
                $blot->save();
                Session::put('blotter_id',$blot->id);
            }
            

        Order::create($request->all());

        $liquidity_details = Liquidity::findOrFail('1')->get();
        foreach($liquidity_details as $liqDetails){
            $current_dollar_amount = $liqDetails->dollar_amount;
            $current_peso_amount = $liqDetails->peso_amount;
        }
        $new_dollar_amount = $current_dollar_amount;
        $new_peso_amount = $current_peso_amount;
        if($request->bought_currency=="USD"){
            $new_dollar_amount = $request->bought_amount;
            $new_dollar_amount = $current_dollar_amount + $new_dollar_amount;
        }else{
            $new_peso_amount = $request->bought_amount;
            $new_peso_amount = $current_peso_amount + $new_peso_amount;
        }
        Session::put('beginning_balance',$request->beginning_balance);

        $update_data = array(
            'dollar_amount'=>$new_dollar_amount,
            'peso_amount'=>$new_peso_amount,
            'updated_balance'=>$request->beginning_balance
        );
        Liquidity::whereId('1')->update($update_data);
        
      //  return redirect('/trader/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function traderOrderList(){
        $trader_id = Session::get('id');
        $data['orders']=Order::whereTraderId($trader_id)->get();
        if(Session::get("blotter_id")==null){
            $data['blotter']=null;
        }else{
            $data['blotter']=Blotter::findOrFail(Session::get('blotter_id'))->get();
        }
        return view('orders.list',$data);        
    }

    public function traderOrderCreate(){
        $data = array(
            'list'=>Client::whereStatus("Approved")
                ->whereTraderId(Session::get('id'))
                ->get()
        ); 
        $last_balance_id = Liquidity::whereId(Session::get('liquidity_id'))->get('beginning_balance'); 
         return view('orders.create',$data);
    }
}
