<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'faculty_id',
        'date',
        'status',
        'leave_reason',
        'created_at',
        'deleted_at'
    ];

    public function faculty(){
        return $this->belongsTo(Student::class);
    }
}
