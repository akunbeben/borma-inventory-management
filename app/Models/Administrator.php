<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'administrator-web';

    protected $fillable = [
        'id',
        'name',
        'npk',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'id' => 'string'
    ];
}
