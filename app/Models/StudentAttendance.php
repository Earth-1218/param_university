<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'student_id',
        'date',
        'status',
        'leave_reason',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
