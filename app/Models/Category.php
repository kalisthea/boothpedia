<?php

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class Category extends Model  
{  
    use HasFactory;  

    protected $fillable = ['category_name'];  

    public function booths()  
    {  
        return $this->hasMany(Booth::class, 'booth_category_id');  
    }  

    public function event()  
    {  
        return $this->belongsTo(Event::class);  
    } 
}