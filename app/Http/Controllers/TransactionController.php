<?php

namespace App\Http\Controllers;
use App\Client;
use App\Transaction;
use App\ForexLog;
use App\Forex;  
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
        $buyWar = 0;
        $sellWar = 0;
        $fixPosition = 0;
        $avgMargin = 0;
        $totalPesoSold = Transaction::sum('peso_sold');
        $totalDollarBought = Transaction::sum('dollar_bought');
        $totalPesoBought = Transaction::sum('peso_bought');
        $totalDollarSold = Transaction::sum('dollar_sold');
 

        if($totalPesoBought != 0 && $totalDollarSold !=0){
            $sellWar = $totalPesoBought / $totalDollarSold;
        }      
        
        
        if($totalDollarBought !=0 && $totalPesoSold !=0){
            $buyWar = $totalPesoSold / $totalDollarBought;
        }

        if($buyWar !=0 && $sellWar !=0){
        $avgMargin = $sellWar - $buyWar;
        }
        $fixPosition = $totalDollarBought - $totalDollarSold;
        $data = array(
                'list'=>Client::all(),
                'buy_war'=>number_format($buyWar,4),
                'sell_war'=>number_format($sellWar,4),
                'dollar_bought'=>number_format($totalDollarBought,2),
                'peso_sold'=>number_format($totalPesoSold,2),
                'peso_bought'=>number_format($totalPesoBought,2),
                'dollar_sold'=>number_format($totalDollarSold,2),
                'fx_position'=>number_format($fixPosition,2),
                'avg_mrgn'=> number_format($avgMargin,3)
        ); 
        return view('trader.blotter',$data);
    }

    public function saveTransaction(Request $request){


        $buyWar = 0;
        $sellWar = 0;
        $dollarBought = 0;
        $pesoBought = 0;
        $dollarSold = 0;
        $pesoSold = 0;
        $totalPesoBought = Transaction::sum('peso_bought');
        $totalDollarSold = Transaction::sum('dollar_sold');
        $totalPesoSold = Transaction::sum('peso_sold');
        $totalDollarBought = Transaction::sum('dollar_bought');

        if($request->sold_currency=="USD"){
            $txnType = "Sell";
            $pesoBought = $request->bought_amount;
            $dollarSold = $request->sold_amount;

             if($totalPesoBought == 0 && $totalDollarSold ==0){
                $sellWar = $pesoBought / $dollarSold;
            }else{
                $sellWar = $totalPesoBought / $totalDollarSold;
            }            
        }else{
            $txnType = "Buy";
            $dollarBought = $request->bought_amount;
            $pesoSold = $request->sold_amount;

            if($totalDollarBought == 0 && $totalPesoSold ==0){
                $buyWar = $pesoSold / $dollarBought;
            }else{
                $buyWar = $totalPesoSold / $totalDollarBought;
            }
        }

        $fixPosition = $totalDollarBought - $totalDollarSold;
        $data = array(
            'forex_id' => $request->forex_id,
            'trader_id'=> Session::get('id'),
            'client_id'=> $request->client_id,
            'txn_type'=> $txnType,
            'buy_war'=> $buyWar,
            'dollar_bought'=> $dollarBought,
            'peso_sold'=> $pesoSold,
            'sell_war'=> $sellWar,
            'peso_bought'=> $pesoBought,
            'dollar_sold'=> $dollarSold,
            'fx_position'=> $fixPosition, 
            'tom_dollar_bought'=> "",
            'tom_next_dollar_bought'=> "",
            'liq_pos_today'=> $request->forex_id,
            'var_dollar'=> $request->forex_id,
            'var_peso'=> $request->forex_id,
            'tom_dollar_sold'=> "",
            'tom_next_dollar_sold'=> "",
            'rate'=> $request->rate,
            'their_bank'=> $request->their_bank,
            'our_bank'=> $request->our_bank,
            'instructions'=> $request->other_instructions,
            'confirmed_by'=> "",
            'status'=>"Confirmation",
            'details'=> "",
        );

         Transaction::create($data);
         $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Done Deal",
            'description'=>"Client Name: ".$request->client_id.' | Trader ID: '.Session::get('id').' | '.$txnType
        );

        ForexLog::create($log);
         
         return redirect('/trader/blotter');
    }

    public function tradeSummary(){
        $buyWar = 0;
        $sellWar = 0;
        $totalPesoSold = Transaction::sum('peso_sold');
        $totalDollarBought = Transaction::sum('dollar_bought');
        $totalPesoBought = Transaction::sum('peso_bought');
        $totalDollarSold = Transaction::sum('dollar_sold');
        if($totalPesoBought != 0 && $totalDollarSold !=0){
            $sellWar = $totalPesoBought / $totalDollarSold;
        }      
        
        
        if($totalDollarBought !=0 && $totalPesoSold !=0){
            $buyWar = $totalPesoSold / $totalDollarBought;
        }

         $data=array(
             'buy' =>Transaction::whereTxnType('Buy')->get(),
             'sell'=>Transaction::whereTxnType('Sell')->get(),
             'totalDollarSold'=>$totalDollarSold,
             'totalPesoBought'=>$totalPesoBought,
             'totalDollarBought'=>$totalDollarBought,
             'totalPesoSold'=>$totalPesoSold,
             'buyWar'=>$buyWar,
             'sellWar'=>$sellWar
         );
         return view('trader.summary',$data);
    }

    public function confirmTransaction($trade_id){
        $trade = Transaction::whereId($trade_id)->get();
        foreach($trade as $t){
            $client_id = $t->client_id;
            $trader_id = $t->trader_id;
        }
        $client = Client::whereId($client_id)->get();
        $query = Forex::whereId($trader_id)->get();
        foreach($query as $q){
            $trader = $q->first_name." ".$q->last_name;
        }

        $data['trade']= $trade;
        $data['client']= $client;
        $data['trader']= $trader;
        return view('trader.confirm_txn',$data);
    }

    public function approveTransaction($trade_id){

        $update_data = array(
            'status'=>"Approved",
            'confirmed_by'=>Session::get('id')
        );
        Transaction::whereId($trade_id)->update($update_data);

        $client_id = Transaction::whereId($trade_id)->get('client_id');
        foreach($client_id as $clientId){
            $client_id = $clientId->client_id;
        }
        $log = array(
            'forex_id'=>Session::get('id'),
            'activity'=>"Approve Deal",
            'description'=>"Client Name: ".$client_id.' | Trader ID: '.Session::get('id').' | '
        );

        ForexLog::create($log);

       
       $trade = Transaction::whereId($trade_id)->get();
       foreach($trade as $t){
           $trader_id = $t->trader_id;
       }
       $client = Client::whereId($client_id)->get();
       $query = Forex::whereId($trader_id)->get();
       foreach($query as $q){
           $trader = $q->first_name." ".$q->last_name;
       }

       $data['trade']= $trade;
       $data['client']= $client;
       $data['trader']= $trader;
        return view('trader.txnconfirmed',$data);
      
       


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
