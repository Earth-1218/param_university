<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'student_id',
        'exam_id',
        'marks_obtained',
        'status',
        'remarks',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
