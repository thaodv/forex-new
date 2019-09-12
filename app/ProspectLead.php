<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProspectLead extends Model
{
    protected $fillable = [
            'forex_id',
            'client_name',
            'location',
            'industry',
            'contact_person',
            'contact_number',
            'position',
            'email',
            'source_lead',
            'appointment_date',
            'outcome_of_call',
            'followup_activity'
    ];

    
}
