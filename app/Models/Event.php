<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'start',
        'end',
        'organizer',
        'location',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
