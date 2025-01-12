<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'enrollment_no',
        'course_id',
        'name',
        'father_name',
        'mother_name',
        'aadhaar_no',
        'mobile_no',
        'email',
        'gender',
        'dob',
        'about',
        'merital_status',
        'joining_date',
        'departure_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function attendance()
    {
        return $this->hasMany(StudentAttendance::class, 'student_id', 'id');
    }

    public function getJoiningDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    public function getDepartureDateAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }
}
