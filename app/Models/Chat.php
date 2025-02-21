<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;


    protected $table = 'chats';  

    protected $fillable = [  
        'tenant_id',  
        'eo_id', 
        'updated_at',
        'created_at',
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }   

    public function eo()
    {
        return $this->belongsTo(User::class, 'eo_id');
    }   

    public function messages()  
    {  
        return $this->hasMany(Message::class);  
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
