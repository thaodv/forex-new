<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidity extends Model
{
    protected $fillable = [
        'forex_id',
        'beginning_balance',
        'updated_balance',
        'ending_balance',
        'weighted_average',
        'gain',
        'average_margin',
        'peso_amount',
        'dollar_amount'
    ];
}
