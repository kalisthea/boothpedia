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

    public function category()  
    {  
        return $this->belongsTo(Category::class, 'booth_category_id');  
    }  

    public function isInCategory(int $categoryId)
    {
        return $this->booth_category_id === $categoryId;
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class); 
    }
}