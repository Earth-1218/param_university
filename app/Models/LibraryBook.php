<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'author',
        'isbn',
        'quantity',
        'available',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
