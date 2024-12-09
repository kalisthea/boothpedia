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

    public function user()
    {
        return $this->hasManys(User::class, 'id', 'tenant_id');
    }

    public function eo()
    {
        return $this->hasOne(Eventorganizer::class, 'id', 'eo_id');
    }

    // Functions buat save input create event

}
