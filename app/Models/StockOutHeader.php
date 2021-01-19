<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOutHeader extends Model
{
    use HasFactory;

    protected $table = 'stock_out_header';

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'stock_out_type_id',
        'order_id',
        'status_id'
    ];

    public function type()
    {
        return $this->belongsTo(StockOutType::class, 'stock_out_type_id');
    }

    public function status()
    {
        return $this->belongsTo(StockOutStatus::class, 'status_id');
    }

    public function body()
    {
        return $this->hasMany(StockOutBody::class, 'header_id');
    }
}
