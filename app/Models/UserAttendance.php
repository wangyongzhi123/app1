<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAttendance extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'staff_id','month','o_id_attendance_organ','job_type','o_id_attendance_group','day_data','is_valid','created_time',
        'modified_time','o_id'
    ];

    protected $table = 'user_attendance';
}
