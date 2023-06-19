<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInfo extends Model
{
    use HasFactory;

    protected $table = 'shipping_infos';
    protected $fillable = [
        'order_id',
        'full_name',
        'phone',
        'address'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
