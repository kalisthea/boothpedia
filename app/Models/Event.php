<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Events\ModelsPruned;

class Event extends Model
{
    use HasFactory;

    // Eloquent -> foreign key connection

    // public function user()
    // {
    //     return $this->hasManys(User::class, 'id', 'tenant_id');
    // }

    public function eo()
    {
        return $this->hasOne(Eventorganizer::class, 'id', 'eo_id');
    }

    // Functions buat save input create event
    use HasFactory;  

    // Tentukan kolom yang bisa diisi secara massal  
    protected $table = 'events'; // Menyatakan nama tabel  

    protected $fillable = [  
        'name',  
        'description',  
        'start_date',  
        'end_date',  
        'location',  
        'banner_photo',
        'layout_photo',
        'venue'
    ];

}
