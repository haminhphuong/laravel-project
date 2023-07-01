<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::all();

        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = User::findOrFail($id);

        return view('admin.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = User::findOrFail($id);

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        // Xử lý cập nhật thông tin khách hàng

        return redirect()->route('admin.customers.index')->with('success', 'Cập nhật thông tin khách hàng thành công!');
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);

        // Xử lý xóa khách hàng

        return redirect()->route('admin.customers.index')->with('success', 'Xóa khách hàng thành công!');
    }
}
