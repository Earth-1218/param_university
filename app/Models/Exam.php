<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'course_id',
        'subject_id',
        'start',
        'end',
        'duration',
        'total_marks',
        'passing_marks',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
