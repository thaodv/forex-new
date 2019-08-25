<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable =  [
        'company_name',
        'phone_number',
        'telephone_number',
        'website',
        'email',
        'contact_person',
        'status'
    ];
}
            
