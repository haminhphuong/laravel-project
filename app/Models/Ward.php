<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'wards';

    protected $fillable = [
        'ma',
        'ten',
        'ma_qh',
        'quan_huyen',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'ma_qh', 'ma');
    }
}
