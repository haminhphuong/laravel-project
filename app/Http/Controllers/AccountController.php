<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\VnAddress;
class AccountController extends Controller
{
    public function index()
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();
        $vn_address = new VnAddress();
        $provinces = $vn_address->getProvinces();
        $city = $user->city;
        $district = $user->district;
        $ward = $user->ward;
        return view('frontend.account.index', compact('user','provinces','city','district','ward'));
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
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'ward' => 'nullable|string|max:255',
        ]);
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }
        $user->save();
        // Cập nhật thông tin người dùng
        $user->update($validatedData);

        return redirect()->route('account')->with('success', 'Thông tin tài khoản đã được cập nhật thành công!');
    }
}

