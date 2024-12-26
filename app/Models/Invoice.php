<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices'; 

    public function setUpdatedAt($value)
    {
    // Do nothing.
    }

    protected $fillable = [ 
        'tenant_id',
        'event_id',
        'booth_id',  
        'price',
        'total_price',
        'payment_method'
    ];  

    public function tenant()  
    {  
        return $this->belongsTo(User::class, 'tenant_id');  
    }  

    public function event()  
    {  
        return $this->belongsTo(Event::class, 'event_id');  
    }  

    public function booth()  
    {  
        return $this->belongsTo(Booth::class, 'booth_id');  
    }  
}
