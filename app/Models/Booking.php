<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

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
        'total_price',
        'snap_token'
    ];

    protected $casts = [
        'music_equipment' => 'array',
        'add_recording' => 'boolean',
        'total_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        // Set default booking_code
        static::creating(function ($booking) {
            if (!$booking->booking_code) {
                $booking->booking_code = Str::uuid();
            }
        });
    }

    public function getTotalPriceAttribute($value)
    {
        return $value !== null ? (float) $value : 0.00;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
