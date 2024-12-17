<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [  
        'sender_id',  
        'receiver_id', 
        'updated_at',
        'created_at',
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'sender_id');

        return $this->morphTo([
            User::class, 'sender_id',
            Eventorganizer::class, 'sender_id',
        ]);
    }   

    public function eo()
    {
        return $this->belongsTo(EventOrganizer::class, 'receiver_id');

        return $this->morphTo([
            User::class, 'receiver_id',
            Eventorganizer::class, 'receiver_id',
        ]);
       
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
