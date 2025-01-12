<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFees extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'student_id',
        'fees',
        'remarks',
        'payment_instrument',
        'payment_through',
        'payment_ref_no',
        'due_date',
        'received_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
