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
    public function booths()  
    {  
        return $this->hasMany(Booth::class, 'event_id');  
    }

    public function boothCategories()  
    {  
        return $this->hasManyThrough(Category::class, Booth::class, 'event_id', 'id', 'id', 'booth_category_id');  
    }

    use HasFactory;  

    // Tentukan kolom yang bisa diisi secara massal  
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
        'category'
    ];

}
