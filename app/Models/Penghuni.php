<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penghuni extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'kost_code',
        'entry_date',
        'exit_date',
        'is_problematic',
        'problem_notes'
    ];

    // Relasi ke User (Akun Login)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kamar
    public function kamar(): BelongsTo
    {
        return $this->belongsTo(Kamar::class);
    }

    // Relasi ke Riwayat Pembayaran
    public function pembayaranan(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    // Relasi ke Pengaduan
    public function pengaduan(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
