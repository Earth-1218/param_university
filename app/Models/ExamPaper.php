<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPaper extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'exam_id',
        'paper',
        'paper_set',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
