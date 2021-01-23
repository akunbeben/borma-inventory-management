<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInBody extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'stock_in_body';

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'header_id',
        'product_id',
        'quantity',
        'expired_date',
        'date_stock_in',
        'information'
    ];

    protected $casts = [
        'id' => 'string',
        'header_id' => 'string',
        'product_id' => 'string',
        'expired_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function header()
    {
        return $this->belongsTo(StockInHeader::class, 'header_id');
    }
}
