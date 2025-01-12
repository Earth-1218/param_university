<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'category',
        'remarks',
        'date',
        'payment_instrument',
        'payment_through',
        'payment_ref_no',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
