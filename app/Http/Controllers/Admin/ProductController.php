<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['category'])->get();
        if ($request->ajax()) {
            return DataTables::of($products)->addColumn('action', function ($product) {
                $button = '<a href="'.route('admin.products.show', $product->id).'" class="btn btn-info btn-sm">View</a>';
                $button .= '<a href="'.route('admin.products.edit', $product->id).'" class="btn btn-warning btn-sm m-1">Edit</a>';
                $button .= '<form action="'.route('admin.products.destroy', $product->id).'" method="POST" style="display: inline-block;">';
                $button .= csrf_field();
                $button .= method_field('DELETE');
                $button .= '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                $button .= '</form>';

                return $button;
            })
            ->editColumn('image', function ($product) {
                $img = '';
                $src = $product->images->first() ? $product->images->first()->image : '';
                if ($src && $product->images->count() > 0){
                    $img .= '<img src="'.asset("img/product/$src").'" alt="'.$product->name.'" width="64" height="64">';
                }
                else{
                    $img .= '<img src="'.asset("img/placeholder.png").'" alt="'.$product->name.'" width="64" height="64">';
                }
                return $img;
            })
            ->editColumn('category', function ($product) {
                return $product->category->name;
            })
            ->rawColumns(['action','image'])
            ->make(true);
        }
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $sizes = Product::sizes;
        $brands = Product::brands;
        $colors = Product::colors;
        return view('admin.products.create', compact('categories','sizes','brands','colors'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'specifications' => 'required|string',
            'features' => 'required|string',
            'image' => 'nullable|image',
        ]);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->special_price = $request->special_price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->is_featured = $request->is_featured ?? 0;
        $product->save();

        if ($request->specifications || $request->features || $request->size || $request->color || $request->brand || $request->deals_of_the_week || $request->coming_soon) {
            $product->info()->create([
                'specifications' => $request->specifications,
                'features' => $request->features,
                'size' => $request->size,
                'color' => $request->color,
                'brand' => $request->brand,
                'deals_of_the_week' => $request->deals_of_the_week ?? 0,
                'coming_soon' => $request->coming_soon ?? 0,
            ]);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '.' . $image->getClientOriginalName();
                $destinationPath = public_path('/img/product');
                $image->move($destinationPath, $filename);
                $product->images()->create([
                    'image' => $filename,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Created successfully.');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'info', 'images'])->findOrFail($id);
        $sizes = Product::sizes;
        $brands = Product::brands;
        $colors = Product::colors;
        return view('admin.products.show', compact('product','sizes','brands','colors'));
    }

    public function edit($id)
    {
        $product = Product::with(['category', 'info', 'images'])->findOrFail($id);
        $categories = Category::pluck('name', 'id');
        $sizes = Product::sizes;
        $brands = Product::brands;
        $colors = Product::colors;
        return view('admin.products.edit', compact('product', 'categories','sizes','brands','colors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'specifications' => 'nullable|string',
            'features' => 'nullable|string',
            'image' => 'nullable|image',
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->special_price = $request->special_price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->is_featured = $request->is_featured ?? false;
        $product->save();

        if ($request->specifications || $request->features || $request->size || $request->color || $request->brand || $request->deals_of_the_week || $request->coming_soon) {
            if ($product->info) {
                $product->info()->update([
                    'specifications' => $request->specifications,
                    'features' => $request->features,
                    'size' => $request->size,
                    'color' => $request->color,
                    'brand' => $request->brand,
                    'deals_of_the_week' => $request->deals_of_the_week ?? 0,
                    'coming_soon' => $request->coming_soon ?? 0,
                ]);
            } else {
                $product->info()->create([
                    'specifications' => $request->specifications,
                    'features' => $request->features,
                    'size' => $request->size,
                    'color' => $request->color,
                    'brand' => $request->brand,
                    'deals_of_the_week' => $request->deals_of_the_week ?? 0,
                    'coming_soon' => $request->coming_soon ?? 0,
                ]);
            }

        } else {
            if ($product->info) {
                $product->info->delete();
            }
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '.' . $image->getClientOriginalName();

                $destinationPath = public_path('/img/product');
                $image->move($destinationPath, $filename);
                $product->images()->create([
                    'image' => $filename,
                ]);
            }
        }
        return redirect()->route('admin.products.index')->with('success', 'Updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Deleted successfully.');
    }

    public function removeImage($id)
    {
        $image = ProductImage::findOrFail($id);
        $imagePath = public_path("/img/product/") .$image->image;

        if (file_exists($imagePath)) {
            unlink($imagePath);
            $image->delete();
            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image.'
            ]);
        }
    }
}
