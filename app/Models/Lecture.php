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
        'duration',
        'comments',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = ['faculty_name','course_name','subject_name','lesson_name'];

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function getFacultyNameAttribute(){
        return $this->faculty->name ?? null;
    }

    public function getCourseNameAttribute(){
        return $this->course->name ?? null;
    }

    public function getSubjectNameAttribute(){
        return $this->subject->name ?? null;
    }

    public function getLessonNameAttribute(){
        return $this->lesson->name ?? null;
    }
}
