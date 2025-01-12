<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'course_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = ['course_name'];
    
    public function subjects()
    {
        return $this->belongsTo(Course::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getCourseNameAttribute()
    {
        return $this->course ? $this->course->name : '';
    }
}
