<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'document_number',
        'document_type_id',
        'start_date',
        'end_date',
        'created_by',
    ];

    protected $casts = [
        'id' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function document_type()
    {
        return $this->belongsTo(ReportType::class, 'document_type_id');
    }

    // public function stock()
    // {
    //     return $this->hasMany()
    // }
}
