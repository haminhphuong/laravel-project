<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::all();
        if ($request->ajax()) {
            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    $button = '<a href="'.route('admin.orders.view', $order->id).'" class="btn btn-info btn-sm">View</a>';
                    $button .= '<a href="'.route('admin.products.edit', $order->id).'" class="btn btn-warning btn-sm">Edit</a>';
                    $button .= '<form action="'.route('admin.orders.destroy', $order->id).'" method="POST" style="display: inline-block;">';
                    $button .= csrf_field();
                    $button .= method_field('DELETE');
                    $button .= '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                    $button .= '</form>';

                    return $button;
                })
                ->editColumn('email', function ($order) {
                    return $order->user->email;
                })
                ->editColumn('payment_method', function ($order) {
                    return $order->payment_method == 'cash_on_delivery' ? 'Cash On Delivery' : 'Paypal';
                })
                ->make(true);
        }
        return view('admin.orders.index', compact('orders'));
    }

    public function viewOrder($orderId){
        $order = Order::findOrFail($orderId);
        return view('admin.orders.view', compact('order'));
    }

    public function cancelOrder($orderId)
    {
        $order = Order::findOrFail($orderId);

        // Kiểm tra xem đơn hàng có thể hủy hay không
        if ($order->status !== 'completed') {
            // Thực hiện các thao tác để hủy đơn hàng
            $order->status = 'cancelled';
            $order->save();

            // Gửi thông báo hoặc thực hiện các tác vụ khác

            return redirect()->back()->with('success', 'Order has been cancelled.');
        }

        return redirect()->back()->with('error', 'Unable to cancel the order.');
    }

    public function destroy($orderId)
    {
        // Lấy thông tin đơn hàng từ database
        $order = Order::findOrFail($orderId);

        // Xóa các bản ghi liên quan trong bảng order_address
        $order->address()->delete();

        // Xóa các bản ghi liên quan trong bảng order_items
        $order->items()->delete();

        // Xóa các bản ghi liên quan trong bảng payments
        $order->payments()->delete();

        // Xóa đơn hàng
        $order->delete();

        // Chuyển hướng về trang danh sách đơn hàng
        return redirect()->route('admin.orders.index')->with('success', 'Order has been deleted successfully.');
    }

    public function ship(Order $order)
    {
        // Cập nhật trạng thái is_shipped trong đơn hàng
        $order->is_shipped = true;
        $order->save();
        // Cập nhật trạng thái đơn hàng
        $order->updateStatus();

        // Chuyển hướng về trang chi tiết đơn hàng
        return redirect()->back()->with('success', 'Order has been shipped successfully.');
    }

    public function invoice(Order $order)
    {
        // Cập nhật trạng thái is_invoiced trong đơn hàng
        $order->is_invoiced = true;
        $order->save();
        // Cập nhật trạng thái đơn hàng
        $order->updateStatus();

        // Chuyển hướng về trang chi tiết đơn hàng
        return redirect()->back()->with('success', 'Order has been invoiced successfully.');
    }
}
