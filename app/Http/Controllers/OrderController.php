<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use Session;    
use App\Forex;
use App\Client;
use App\Liquidity;
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

        Order::create($request->all());
        return redirect('/trader/orders');
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
        return view('orders.list',$data);
        
    }

    public function traderOrderCreate(){
        $data = array(
            'list'=>Client::whereStatus("Approved")
                ->whereTraderId(Session::get('id'))
                ->get()
                
        ); 
        $last_balance_id = Liquidity::whereId(Session::get('liquidity_id'))->get('beginning_balance'); 
        echo $last_balance_id;
        //return view('orders.create',$data);
    }
}
