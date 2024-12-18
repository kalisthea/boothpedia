<?php

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class Booth extends Model  
{  
    use HasFactory;  

    protected $fillable = [   
        'booth_name',  
        'booth_price',  
        'booth_description'  
    ];  

    public function event()  
    {  
        return $this->belongsTo(Event::class, 'event_id');  
    }  

    public function category()  
    {  
        return $this->belongsTo(Category::class, 'category_id');  
    }  
}