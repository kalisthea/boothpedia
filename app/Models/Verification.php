<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Verification extends Model
{
    use HasFactory;  

    protected $fillable = [   
        'id_num',
        'id_name',
        'id_address',
        'id_photo'  
    ];

    // Relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
