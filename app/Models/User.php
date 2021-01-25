<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guard = 'users-web';

    protected $fillable = [
        'id',
        'name',
        'npk',
        'password',
        'division_id',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    public function showPassword()
    {
        unset($this->hidden);
        return $this;
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function image()
    {
        return $this->hasOne(UserImage::class, 'user_id', 'id');
    }
}
