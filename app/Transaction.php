<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=[
        'forex_id',
        'trader_id',
        'client_id',
        'txn_type',
        'buy_war',
        'dollar_bought',
        'peso_sold',
        'sell_war',
        'peso_bought',
        'dollar_sold',
        'fx_position',
        'tom_dollar_bought',
        'tom_next_dollar_bought',
        'liq_pos_today',
        'var_dollar',
        'var_peso',
        'tom_dollar_sold',
        'tom_next_dollar_sold',
        'rate',
        'their_bank',
        'our_bank',
        'instructions',
        'confirmed_by',
        'status',
        'details',
    ];
}
