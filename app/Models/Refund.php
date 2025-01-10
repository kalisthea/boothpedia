<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    
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
        'account_name',
        'status'
    ]; 

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function eo()
    {
        return $this->belongsTo(User::class, 'eo_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
