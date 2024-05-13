<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //Kiểm tra nếu người dùng chưa đăng nhập thì chuyển hướng đến trang đăng nhập
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Hiển thị thông tin người dùng
    public function showProfile()
    {
        $user = Auth::user();
        $profile = $user->profile;
        return view('profile.viewprofile', compact('profile'));
    }

    // Hiển thị form thêm mới profile
    public function createProfile()
    {
        return view('profile.createprofile');
    }

    // Lưu thông tin profile mới
    public function storeProfile(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'image' => 'nullable|image'
        ]);
    
        $profile = new Profile($request->all());
        $profile->user_id = Auth::id(); // Lấy ID người dùng hiện tại
        $profile->save();
    
        return redirect()->route('profile.show')->with('success', 'Profile created successfully.');
    }

    // Hiển thị form chỉnh sửa profile
    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->profile; // Giả sử đã có mối quan hệ `profile` trong model `User`
        return view('profile.editprofile', compact('profile'));
    }

    // Cập nhật thông tin profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'address' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'image' => 'nullable|image'
        ]);
    
        $user = Auth::user();
        $profile = $user->profile;
        $profile->update($request->all());
    
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

    // Xóa profile
    public function deleteProfile()
    {
        $user = Auth::user();
        $profile = $user->profile;
        if ($profile) {
            $profile->delete();
        }

        return redirect('phone.index')->with('success', 'Profile deleted successfully.');
    }
}   
