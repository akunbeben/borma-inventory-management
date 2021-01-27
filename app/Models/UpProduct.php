<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpProduct extends Model
{
    use HasFactory;

    protected $table = 'up_product';

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
