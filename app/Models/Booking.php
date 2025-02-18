<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'studio_id',
        'booking_code',
        'status',
        'add_recording',
        'music_equipment',
        'total_price'
    ];

    protected $casts = [
        'music_equipment' => 'array',
        'add_recording' => 'boolean',
        'total_price' => 'integer', // Pastikan ini integer
    ];

    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Pastikan total_price tidak berubah jadi 0 saat diambil
     */
    public function getTotalPriceAttribute($value)
    {
        return $value !== null ? (int) $value : 0;
    }

    /**
     * Relasi ke User (Customer)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Studio
     */
    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
