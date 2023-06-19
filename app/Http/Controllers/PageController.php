<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductInfo;

class PageController extends Controller
{

    public function home()
    {
        // Lấy thông tin 8 product mới nhất
        $latestProducts = Product::orderBy('products.created_at', 'desc')->limit(8)->get();
        $commingProducts = ProductInfo::where('coming_soon', true)->with('product')->get();

        // Trả về view cho trang chủ
        return view('frontend.home', compact('latestProducts','commingProducts'));
    }
}
