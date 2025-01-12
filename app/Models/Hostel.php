<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'location',
        'capacity',
        'occupied',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
