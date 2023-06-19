<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        return view('frontend.account.index', compact('user'));
    }

    public function update(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        // Kiểm tra dữ liệu được gửi lên từ biểu mẫu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        // Cập nhật thông tin người dùng
        $user->update($validatedData);

        return redirect()->route('account')->with('success', 'Thông tin tài khoản đã được cập nhật thành công!');
    }
}

