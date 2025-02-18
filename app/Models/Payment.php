<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'transaction_id',
        'status',
        'amount'
    ];

    // Status Pembayaran
    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_FAILED = 'failed';
    public const STATUS_CANCELED = 'canceled';

    // Relasi ke User (Pembayar)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Booking (Pembayaran untuk Booking mana)
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Scope untuk hanya pembayaran yang sukses
    public function scopePaid($query)
    {
        return $query->where('status', self::STATUS_PAID);
    }

    // Mutator untuk memastikan status selalu huruf kecil
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value);
    }

    // Accessor untuk format rupiah pada amount
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }
}
