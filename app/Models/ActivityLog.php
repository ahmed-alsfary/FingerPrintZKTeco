<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'activity',
        'details',
        'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
