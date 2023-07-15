<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\VnAddress;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $users = User::all();
        if ($request->ajax()) {
            return DataTables::of($users)->addColumn('action', function ($user) {
                $button = '<a href="'.route('admin.customers.edit', $user->id).'" class="btn btn-warning btn-sm m-1">Edit</a>';
                $button .= '<form action="'.route('admin.customers.destroy', $user->id).'" method="POST" style="display: inline-block;">';
                $button .= csrf_field();
                $button .= method_field('DELETE');
                $button .= '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                $button .= '</form>';

                return $button;
            })
            ->editColumn('avatar', function ($user) {
                $img = '';
                $src = $user->avatar;
                if ($src){
                    $img = '<img src="'.asset('storage/' . $src).'" alt="'.$user->name.'" width="64" height="64"/>';
                }
                else{
                    $img = '<img src="'.asset("img/placeholder.png").'" alt="'.$user->name.'" width="64" height="64"/>';
                }
                return $img;
            })
            ->rawColumns(['action','avatar'])
            ->make(true);
        }
        return view('admin.customers.index', compact('users'));
    }

    public function show($id)
    {
        $customer = User::findOrFail($id);

        return view('admin.customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $vn_address = new VnAddress();
        $provinces = $vn_address->getProvinces();
        $city = $user->city;
        $district = $user->district;
        $ward = $user->ward;
        return view('admin.customers.edit', compact('user','provinces','city','district','ward'));
    }

    public function update(Request $request,$id)
    {
        $user = User::find($id);
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

        return redirect()->route('admin.customers.index')->with('success', 'Thông tin tài khoản đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Xóa khách hàng thành công!');
    }
}
