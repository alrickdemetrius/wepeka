<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'company_name', 'contact_name', 'email', 'phone', 'service_types', 'message', 'status'
    ];

    // Penting: Ubah JSON di DB menjadi Array di Laravel secara otomatis
    protected $casts = [
        'service_types' => 'array',
    ];
}
