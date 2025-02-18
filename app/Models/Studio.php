<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'description',
        'price_per_hour'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
