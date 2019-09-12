<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
            'forex_id',
            'trader_id',
            'client_id',
            'bought_currency',
            'bought_amount',
            'sold_currency',
            'sold_amount',
            'rate', 
            'total_amount',
            'their_bank',
            'our_bank',
            'other_instructions',
            'dealer',
            'counter_party',
            'confirmed_by',
            'status',
            'details'
    ];
}
