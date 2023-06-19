<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'total_price','name','price','image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function addToCart($product_id, $quantity)
    {
        $cart = $this->where('user_id', auth()->user()->id)->where('product_id', $product_id)->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->total_price = $cart->product->price * $cart->quantity;
            $cart->save();
        } else {
            $product = Product::find($product_id);

            if ($product) {
                $cart = new Cart([
                    'user_id' => auth()->user()->id,
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'name'=>$product->name,
                    'price'=>$product->price,
                    'image'=>$product->images->first()->image,
                    'total_price' => $product->price * $quantity,
                ]);
                $cart->save();
            }
        }

        return $cart;
    }

}
