<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'file_type',
        'file_data',
        'qr_code_svg',
        'user_id',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
