<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [   
        'account_num',
        'account_name',
        'bank_name' 
    ];

    // Relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
