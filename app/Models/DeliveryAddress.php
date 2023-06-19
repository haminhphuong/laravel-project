<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $table = 'delivery_addresses';
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'address',
        'province',
        'district',
        'ward',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
