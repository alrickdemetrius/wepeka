<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'jenis_layanan_id',
    ];

    /**
     * Get the booking that owns the booking detail.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Get the jenis layanan that owns the booking detail.
     */
    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class);
    }
}