<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total_price', 'status','payment_method','is_shipped','is_invoiced'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')->withPivot('quantity', 'price');
    }

    public function address()
    {
        return $this->hasOne(OrderAddress::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function updateStatus()
    {
        if ($this->is_shipped && $this->is_invoiced) {
            $this->status = 'compiled';
        }
        else if (!$this->is_shipped && !$this->is_invoiced) {
            return $this->save();
        }
        else {
            $this->status = 'processing';
        }
        return $this->save();
    }
}

