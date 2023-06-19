<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ProductController extends Controller
{

    public function show($id)
    {
        $product = Product::find($id);
        $user = Auth::user();
        $reviews = Review::where('product_id', $id)->get();
        $reviewsCount = $product->reviews()->count();
        $averageRating = round($product->reviews()->avg('rating'), 1);
        // Tính tổng số review cho mỗi sao
        $totalReviews = [
            1 => $reviews->where('rating', 1)->count(),
            2 => $reviews->where('rating', 2)->count(),
            3 => $reviews->where('rating', 3)->count(),
            4 => $reviews->where('rating', 4)->count(),
            5 => $reviews->where('rating', 5)->count(),
        ];
        return view('frontend.products.show', compact('product','user','reviews','reviewsCount','averageRating','totalReviews'));
    }
}
