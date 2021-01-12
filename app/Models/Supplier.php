<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'supplier_code',
        'supplier_name',
        'supplier_address',
        'supplier_telephone',
        'created_by',
    ];

    protected $casts = [
        'id' => 'string'
    ];
}
