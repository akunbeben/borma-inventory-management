<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guard = 'administrator-web';

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

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
