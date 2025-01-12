<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'tenure',
        'semester',
        'fees',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class,'id','course_id');
    }
}
