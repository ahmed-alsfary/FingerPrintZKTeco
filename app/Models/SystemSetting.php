<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'fingerprint_ip',
        'fingerprint_port',
        'system_time',
        'timezone',
        'status',
    ];
}
