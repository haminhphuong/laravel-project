<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\VnAddress;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\OrderAddress;
use Illuminate\Support\Facades\Validator;
class CheckoutController extends Controller
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
        $vn_address = new VnAddress();
        $provinces = $vn_address->getProvinces();
        $districts = [];
        return view('frontend.checkout.index',compact('cartItems','subtotal','provinces', 'districts'));
    }

    public function getDistrictsByProvince($province_id)
    {
        $vn_address = new VnAddress();
        return response()->json(['districts'=>$vn_address->getDistricts($province_id)]);
    }

    public function getWardsByDistrict($district_id)
    {
        $vn_address = new VnAddress();
        return response()->json(['wards'=>$vn_address->getWards($district_id)]);
    }

    public function placeOrder(Request $request)
    {
        $validator = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'city_address' => 'required|string|max:255',
            'district_address' => 'required|string|max:255',
            'ward_address' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $cartItems = $user ? $user->cart : [];

        // Kiểm tra giỏ hàng có sản phẩm hay không
        if (count($cartItems) == 0) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->total_price;
        }
        // Tạo đối tượng Order và lưu vào CSDL
        $order = new Order();
        $order->user_id = $user->id;
        $order->total_price = $subtotal;
        $order->status = 'pending'; // Trạng thái đơn hàng mới tạo
        $order->payment_method = $request->input('payment_method');
        $order->save();

        // Tạo đối tượng OrderAddress và lưu vào CSDL
        $fullName = $request->input('first_name') . $request->input('last_name');
        $address = new OrderAddress();
        $address->order_id = $order->id;
        $address->full_name = $fullName;
        $address->phone = $request->input('phone');
        $address->email = $request->input('email');
        $address->address = $request->input('address');
        $address->city = $request->input('city_address');
        $address->district = $request->input('district_address');
        $address->ward = $request->input('ward_address');
        $address->note = $request->input('note');
        $address->save();

        // Tạo đối tượng OrderItem cho mỗi sản phẩm trong giỏ hàng và lưu vào CSDL
        foreach ($cartItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->price = $item->product->price;
            $orderItem->save();
        }

        // Xóa giỏ hàng
        $user->cart()->delete();

        // Redirect đến trang xác nhận đơn hàng
        return redirect()->route('order.confirm', ['id' => $order->id]);
    }

    public function confirmOrder($id){
        // Lấy thông tin của order theo id
        $order = Order::findOrFail($id);

        // Lấy thông tin của order items và order address
        $orderItems = $order->items;
        $orderAddress = $order->address;

        return view('frontend.checkout.confirmation', compact('order','orderItems','orderAddress'));
    }
}
