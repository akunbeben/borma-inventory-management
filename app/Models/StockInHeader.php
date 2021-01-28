<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInHeader extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $table = 'stock_in_header';

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'stock_in_type_id',
        'order_id',
        'status_id',
        'created_by',
    ];

    public function type()
    {
        return $this->belongsTo(StockInType::class, 'stock_in_type_id');
    }

    public function status()
    {
        return $this->belongsTo(StockInStatus::class, 'status_id');
    }

    public function body()
    {
        return $this->hasMany(StockInBody::class, 'header_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
