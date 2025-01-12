<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'faculty_id',
        'course_id',
        'subject_id',
        'lesson_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
