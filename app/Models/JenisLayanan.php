<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
    ];

    /**
     * Get the booking details for the jenis layanan.
     */
    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }

    /**
     * Get the bookings that have this jenis layanan.
     */
    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_details', 'jenis_layanan_id', 'booking_id');
    }
}