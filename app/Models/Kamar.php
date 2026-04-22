<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    protected $fillable = [
        'room_number',
        'price_per_month',
        'status',
        'description'
    ];

    // Satu kamar bisa memiliki sejarah banyak penghuni (tapi biasanya 1 yang aktif)
    public function penghuni(): HasMany
    {
        return $this->hasMany(Penghuni::class);
    }
}
