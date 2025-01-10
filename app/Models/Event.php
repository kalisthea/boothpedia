<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Events\ModelsPruned;
use Illuminate\Support\Str;  

class Event extends Model
{
    use HasFactory;

    // Eloquent -> foreign key connection

    // public function user()
    // {
    //     return $this->hasManys(User::class, 'id', 'tenant_id');
    // }

    // Relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation with booth
    public function categories()  
    {  
        return $this->hasMany(Category::class);  
    }

    //Relation with invoice
    public function invoices(){
        return $this->hasMany(Invoice::class);  
    }

    public function ratings()  
    {  
        return $this->hasMany(Rating::class, 'event_id');  
    }


    use HasFactory;  

    protected $table = 'events';  

    protected $fillable = [  
        'name',  
        'description',  
        'start_date',  
        'end_date',  
        'location',  
        'banner_photo',
        'layout_photo',
        'venue',
        'category',
        'proposal_doc'
    ];

}
