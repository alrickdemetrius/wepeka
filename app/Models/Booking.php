<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'contact_name',
        'email',
        'phone',
        'message',
        'status',
    ];

    /**
     * Get the booking details for the booking.
     */
    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }

    /**
     * Get the jenis layanans for the booking.
     */
    public function jenisLayanans()
    {
        return $this->belongsToMany(JenisLayanan::class, 'booking_details', 'booking_id', 'jenis_layanan_id');
    }
}