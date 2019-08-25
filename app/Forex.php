<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forex extends Model
{
    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'department',
        'user_type',
        'email',
        'password',
        'is_logged_in'
    ];
}
