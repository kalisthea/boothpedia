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
        'quantity',
        'price',
        'total_price',
        'payment_method'
    ];  

    public function tenant()  
    {  
        return $this->belongsTo(User::class);  
    }  

    public function event()  
    {  
        return $this->belongsTo(Event::class);  
    }  

    public function booths()
    {
        return $this->belongsToMany(Booth::class, 'invoicebooths'); 
    }

    // public function booth()  
    // {  
    //     return $this->belongsTo(Booth::class);  
    // }  
}
