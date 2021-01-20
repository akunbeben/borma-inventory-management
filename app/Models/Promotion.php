<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'product_id',
        'information',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'id' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
