<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $fillable = [ 
        'tenant_id',
        'eo_id',
        'event_id',  
        'invoice_id',
        'reason',
        'additional',
        'image',
        'bank',
        'bank_number',
        'account_name'
    ]; 
}
