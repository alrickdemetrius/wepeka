<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInfo extends Model
{
    use HasFactory;

    protected $table = "clientinfos";

    protected $fillable = [
        // isi sesuai migration
        // 'name',
        // 'email',
        // 'password',
        // 'role',
    ];
}
