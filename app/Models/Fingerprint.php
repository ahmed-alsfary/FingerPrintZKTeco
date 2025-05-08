<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fingerprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'fingerprint_data',
        'fingerprint_number',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
