<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';

    protected $fillable = [
        'ma',
        'ten',
        'ma_tp',
        'thanh_pho',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'ma_tp', 'ma');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class, 'ma_qh', 'ma');
    }
}
