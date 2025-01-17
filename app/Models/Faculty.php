<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Faculty extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'id',
        'course_id',
        'subject_id',
        'name',
        'mobile_no',
        'email',
        'gender',
        'dob',
        'merital_status',
        'designation',
        'about',
        'joining_date',
        'departure_date',
        'experience',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends =  ['course_name', 'subject_name'];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function attendance(){
        return $this->hasMany(StudentAttendance::class, 'faculty_id', 'id');
    }

    public function getCourseNameAttribute(){        
        return $this->course ? $this->course->name : '';
    }

    public function getSubjectNameAttribute(){
        return $this->subject ? $this->subject->name : '';
    }
}
