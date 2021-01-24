<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ReflectionFunctionAbstract;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'product_barcode',
        'product_plu',
        'product_name',
        'product_initial_quantity',
        'min',
        'max',
        'product_expired_date',
        'product_supplier',
        'product_type',
        'product_package',
    ];

    protected $casts = [
        'id' => 'string',
        'product_expired_date' => 'date',
        'product_supplier' => 'string'
    ];

    protected static function boot() 
    {
      parent::boot();

      static::deleting(function($products) {
        $products->inventory()->delete();
      });

      static::restoring(function($products) {
        $products->inventory()->withTrashed()->restore();
      });
    }

    public function type()
    {
      return $this->belongsTo(ProductType::class, 'product_type');
    }

    public function supplier()
    {
      return $this->belongsTo(Supplier::class, 'product_supplier');
    }

    public function inventory()
    {
      return $this->hasOne(Inventory::class, 'product_id');
    }

    public function stockInBody()
    {
      return $this->hasMany(StockInBody::class, 'product_id');
    }

    public function stockOutBody()
    {
      return $this->hasMany(StockOutBody::class, 'product_id');
    }
}
