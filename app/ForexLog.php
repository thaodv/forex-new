<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForexLog extends Model
{
    protected $fillable = [
        'forex_id',
        'activity',
        'description'        
    ];
}
