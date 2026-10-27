<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class ProfileController extends Controller
{
    // Hiển thị trang thông tin cá nhân
    public function show()
    {
        $user = Auth::user();
        $categories = Category::all();
        return view('show_profile', compact('user', 'categories'));
    }

    // Cập nhật thông tin cá nhân và mật khẩu (nếu có nhập)
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:6|confirmed', // Xử lý nếu user muốn đổi mật khẩu
        ], [
            'name.required' => 'Họ và tên không được để trống.',
            'password.min' => 'Mật khẩu mới phải ít nhất 6 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp.',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }
}