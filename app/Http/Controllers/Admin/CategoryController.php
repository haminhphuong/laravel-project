<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\Datatables\Datatables;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->ajax()) {
            return DataTables::of($categories)->addColumn('action', function ($category) {
                $button = '<a href="'.route('admin.categories.edit', $category->id).'" class="btn btn-primary btn-sm">Edit</a>';
                $button .= '<form action="'.route('admin.categories.destroy', $category->id).'" method="POST" style="display: inline-block;">';
                $button .= csrf_field();
                $button .= method_field('DELETE');
                $button .= '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                $button .= '</form>';

                return $button;
            })
            ->rawColumns(['action','image'])
            ->make(true);
        }
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories',
        ]);

        Category::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:categories,slug,'.$category->id,
        ]);

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
