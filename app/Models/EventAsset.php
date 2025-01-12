<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAsset extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'event_id',
        'headline',
        'remarks',
        'image',
        'video',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
