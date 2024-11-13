<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    protected $fillable = [
        'name',
        'employee_id',
        'position',
        'branch',
        'application_date',
        'leave_type',
        'start_date',
        'end_date',
        'total_days',
        'contact_address',
        'reason',
    ];
    
}
