<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'student_id',
        'book_id',
        'issue_date',
        'due_date',
        'return_date',
        'fine',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
