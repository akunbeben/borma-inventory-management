<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $fillable = [
        'product_id',
        'actual_stock',
        'date_stock_in',
        'expired_date',
        'information'
    ];

    protected $casts = [
        'product_id' => 'string',
        'date_stock_in' => 'datetime',
        'expired_date' => 'datetime',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
