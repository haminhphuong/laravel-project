<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'quantity',
        'is_featured',
    ];

    const sizes = ['28', '29', '30', '31','32','33','34','35','36','37','38','39','40','41','42'];
    const brands = ['Nike', 'Adidas', 'Puma', 'Reebok'];
    const colors = ['Red', 'Blue', 'Green', 'Yellow'];
    const filters = ['size', 'brand', 'color', 'deals_of_the_week','coming_soon'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function info()
    {
        return $this->hasOne(ProductInfo::class);
    }

    public function reviews()
    {
        return $this->hasOne(Review::class);
    }

}
