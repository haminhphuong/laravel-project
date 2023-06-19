<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $numProducts = Product::count();
        $numCategories = Category::count();
        $numUsers = User::count();
        $numOrders = Order::count();
        return view('admin.dashboard')->with(compact('numProducts', 'numCategories', 'numUsers', 'numOrders'));;
    }
}
