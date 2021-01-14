<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'product_plu',
        'product_name',
        'product_initial_quantity',
        'product_expired_date',
        'product_supplier',
        'product_type',
    ];

    protected $casts = [
        'id' => 'string',
        'product_expired_date' => 'date',
        'product_supplier' => 'string'
    ];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'product_supplier');
    }
}
