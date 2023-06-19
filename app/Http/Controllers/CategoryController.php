<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    const numPaginate = 12;
    public function showProducts(Request $request, $slug)
    {
        $numShow = $request->get('numShow') ?: self::numPaginate;
        $params = $request->all();
        $sortBy = $request->input('sort_by', 'a-z');
        $filters = Product::filters;
        if(isset($params['sort_by'])){
            unset($params['sort_by']);
        }
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products();

        if ($sortBy === 'a-z') {
            $products->orderBy('name', 'asc');
        } elseif ($sortBy === 'z-a') {
            $products->orderBy('name', 'desc');
        } elseif ($sortBy === 'high-low') {
            $products->orderBy('price', 'desc');
        } elseif ($sortBy === 'low-high') {
            $products->orderBy('price', 'asc');
        }
        foreach ($params as $key => $param){
            if(in_array($key,$filters)){
                $products = $products->whereHas('info', function ($query) use ($key, $param) {
                    $query->where($key, $param);
                });
            }
        }
        $products = $products->paginate($numShow);
        $totalPages = $products->lastPage();
        $currentPage = $products->currentPage();
        $linkPage = route('category.products', ['slug' => $category->slug]).'?page=';

        $sizes = $products->pluck('info.size')->unique();
        $brands = $products->pluck('info.brand')->unique();

        $colors = $products->pluck('info.color')->unique();
        $deals = $products->pluck('info.deals_of_the_week')->unique();
        $comingSoon = $products->pluck('info.coming_soon')->unique();

        // Sử dụng map() của Laravel Collection
        $constantBrands = Product::brands;
        $constantColors = Product::colors;
        $mappedBrands = $brands->mapWithKeys(function ($item) use ($constantBrands) {
            if ($item !== null) {
                return [$item => $constantBrands[$item]];
            }
            return [];
        });

        $mappedColors = $colors->mapWithKeys(function ($item) use ($constantColors) {
            if ($item !== null) {
                return [$item => $constantColors[$item]];
            }
            return [];
        });

        return view('frontend.category.products',
            compact(
                'category',
                'products',
                'totalPages',
                'currentPage',
                'linkPage',
                'numShow',
                'sortBy',
                'sizes',
                'mappedColors',
                'mappedBrands',
                'deals',
                'comingSoon'));
    }

}
