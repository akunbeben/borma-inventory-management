<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
      'id',
      'supplier_code',
      'supplier_name',
      'supplier_address',
      'supplier_telephone',
      'created_by',
    ];

    protected static function boot() 
    {
      parent::boot();

      static::deleting(function($supplier) {
        foreach($supplier->products()->get() as $product) {
          $product->delete();
        }
      });

      static::restoring(function($supplier) {
        foreach($supplier->products()->get() as $product) {
          $product->withTrashed->restore();
        }
      });
    }

    protected $casts = [
      'id' => 'string'
    ];

    public function products()
    {
      return $this->hasMany(Product::class, 'product_supplier', 'id');
    }

    public function newProduct()
    {
      return $this->hasMany(NewProduct::class);
    }
}
