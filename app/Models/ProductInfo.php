<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory;
    protected $table = 'product_infos';

    protected $fillable = [
        'product_id', 'specifications', 'features','size','brand','color','deals_of_the_week','coming_soon'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
