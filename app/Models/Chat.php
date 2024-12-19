<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [  
        'tenant_id',  
        'eo_id', 
        'updated_at',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }   



    // public function sender()
    // {
    //     return $this->morphTo([
    //         User::class, 'sender_id',
    //         Eventorganizer::class, 'sender_id',
    //     ]);
    // }

    // public function receiver()
    // {
    //     return $this->morphTo([
    //         User::class, 'receiver_id',
    //         Eventorganizer::class, 'receiver_id',
    //     ]);
    // }

    // public function sender()
    // {
    //     return $this->morphTo();
    // }

    // public function receiver()
    // {
    //     return $this->morphTo();
    // }
}
