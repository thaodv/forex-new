<?php

namespace App\Http\Controllers;
use App\Client;
use App\Transaction;
use Illuminate\Http\Request;
use Session;
class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = array(
        //     'blotter' => $this->getBlotterSummary(),
        //     'transactions'=> $this->getTransactions()
        // );
        $data = array(
            'list'=>Client::whereStatus("Approved")
                ->whereTraderId(Session::get('id'))
                ->get()
        ); 
        return view('trader.blotter',$data);
    }

    public function saveTransaction(Request $request){


        $buy_war = '';
        $sell_war = '';
        $dollarBought = '';
        $pesoBought = '';
        $dollarSold = '';
        $pesoSold = '';
        if($request->sold_currency=="PHP"){
            $txn_type = "Sell";
            $pesoBought = $request->bought_amount;
            $dollarSold = $request->sold_amount;
            $sell_war = $request->pesoBought / $dollarSold;
        }else{
            $txn_type = "Buy";
            $dollarBought = $request->bought_amount;
            $pesoSold = $request->sold_amount;
            $buy_war = $pesoSold / $dollarBought;
            
        }

        if($request->txn_type == "Buy"){
                $buy_war = $request->peso_sold / $request->dollar_bought;
        }else{
                $sell_war = $request->dollar_sold / $request->peso_bought;
        }

        $data = array(
            'forex_id' => $request->forex_id,
            'trader_id'=> Session::get('id'),
            'client_id'=> $request->client_id,
            'txn_type'=> $request->txn_type,
            'buy_war'=> $buy_war,
            'dollar_bought'=> $dollarBought,
            'peso_sold'=> $pesoSold,
            'sell_war'=> $sell_war,
            'peso_bought'=> $pesoBought,
            'dollar_sold'=> $dollarSold,
            'fx_position'=> "",// substraction of total $ bought - total $ sold
            'tom_dollar_bought'=> $request->forex_id,
            'tom_next_dollar_bought'=> $request->forex_id,
            'liq_pos_today'=> $request->forex_id,
            'var_dollar'=> $request->forex_id,
            'var_peso'=> $request->forex_id,
            'tom_dollar_sold'=> $request->forex_id,
            'tom_next_dollar_sold'=> $request->forex_id,
            'rate'=> $request->forex_id,
            'their_bank'=> $request->forex_id,
            'our_bank'=> $request->forex_id,
            'instructions'=> $request->forex_id,
            'confirmed_by'=> $request->forex_id,
            'status'=> $request->forex_id,
            'details'=> $request->forex_id,
        );

        Transaction::create($data);
    }

    public function getBlotterSummary(){

        $dollarBought = "";
        $dollarSold = "";
        $pesoBought = "";
        $pesoSold = "";
        $buyWar = "";
        $sellWar = "";
        $fxPosition = "";
        $data = Transaction::whereCreatedAt('2019-09-13%')->get();
        foreach($data as $d){
            $dollarBought += $d->dollar_bought;
            $dollarSold += $d->dollar_sold;
            $pesoBought += $d->peso_bought;
            $pesoSold += $d->peso_sold;            
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
