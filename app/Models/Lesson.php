<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'subject_id',
        'name',
        'headline',
        'description',
        'notes',
        'downloadable_pdf',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
