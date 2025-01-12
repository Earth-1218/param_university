<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ManagementTeam extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $fillable = [
        'id',
        'name',
        'mobile_no',
        'email',
        'gender',
        'dob',
        'about',
        'department',
        'joining_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
