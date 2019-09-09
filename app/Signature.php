<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    //
    protected $fillable = [
        'id',
        'forex_id',
        'signature',
        'owner'
    ];
}
