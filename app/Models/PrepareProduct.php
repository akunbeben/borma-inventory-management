<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrepareProduct extends Model
{
    use HasFactory;

    protected $table = 'prepare_product';

    protected $fillable = [
        'product_id',
        'quantity',
        'information',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
