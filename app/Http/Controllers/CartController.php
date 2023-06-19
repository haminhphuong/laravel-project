<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Lấy thông tin user đang đăng nhập
        $user = Auth::user();
        // Lấy thông tin giỏ hàng của user
        $cartItems = $user ? $user->cart : [];
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->total_price;
        }
        return view('frontend.cart.index', compact('cartItems','subtotal'));
    }

    public function addToCart(Request $request, $product_id)
    {
        die('sssssss');
        $quantity = $request->input('qty');
        $cart = new Cart();
        $cart->addToCart($product_id, $quantity);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
//    public function updateCart(Request $request)
//    {
//        // Lấy thông tin user đang đăng nhập
//        $user = Auth::user();
//        $cart = $user->cart;
//
//        // Lặp qua các sản phẩm trong giỏ hàng và cập nhật số lượng
//        foreach ($cart as $i => $item) {
//            $product_id = $item['product_id'];
//            $quantity = $request->input('qty_' . $product_id);
//
//            // Kiểm tra xem số lượng có lớn hơn 0 không
//            if ($quantity > 0) {
//                $cart[$i]['quantity'] = $quantity;
//
//                // Cập nhật giá và tổng giá của sản phẩm
//                $product = Product::find($product_id);
//                $cart[$i]['name'] = $product->name;
//                $cart[$i]['price'] = $product->price;
//                $cart[$i]['image'] = $product->image;
//                $cart[$i]['total_price'] = $product->price * $quantity;
//            } else {
//                // Nếu số lượng là 0, xóa sản phẩm khỏi giỏ hàng
//                unset($cart[$i]);
//            }
//        }
//
//        // Cập nhật giỏ hàng trong database
//        $user->cart = $cart;
//        $user->save();
//
//        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
//    }

    public function updateCart(Request $request) {
        $cartItems = $request->input('cartItems');
        $result = ['result'=>false];
        // Lặp qua từng sản phẩm trong giỏ hàng
        foreach ($cartItems as $item) {
            $cartItem = Cart::find($item['id']);
            if ($cartItem) {
                $cartItem->quantity = $item['quantity'];
                $cartItem->total_price = $cartItem->price * $item['quantity'];
                $cartItem->save();
                $result = ['result'=>true];
            }
        }
        return response()->json($result);
    }


}
