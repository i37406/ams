<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'attendance',
        'leave_reason',
        'leave_apply_status',
        'leave_approved_status',
        'leave_disapprove_status',
        'seen_status',
        'attendance_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
