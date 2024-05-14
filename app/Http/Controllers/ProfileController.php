<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $profile = $user->profile()->with('user')->first() ?? new Profile(); // Sử dụng null coalescing operator để tránh lỗi nếu không có profile
        return view('profile.viewprofile', compact('user', 'profile'));
    }
    public function showAdminProfile()
    {
        $user = Auth::user();
        $profile = $user->profile()->with('user')->first() ?? new Profile(); // Sử dụng null coalescing operator để tránh lỗi nếu không có profile
        return view('admin.profile.viewprofile', compact('user', 'profile'));
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
        $profile->user_id = Auth::id(); // Đảm bảo liên kết profile với người dùng hiện tại
        $profile->date_of_birth = Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->toDateString(); // Chuyển đổi định dạng ngày tháng

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $profile->image = $imagePath;
        }

        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profile created successfully.');
    }

    // Hiển thị form chỉnh sửa profile
    public function editProfile()
    {
        $user = Auth::user();
        $profile = $user->profile; // Giả sử đã có mối quan hệ `profile` trong model `User`

        if (!$profile) {
            // Xử lý trường hợp không tìm thấy profile
            return redirect()->route('profile.create')->with('error', 'Profile not found.');
        }
        if ($user->role_id == 0) {
            return view('profile.editprofile', compact('profile','user'));
        }
        else{
            return view('admin.profile.editprofile', compact('profile','user'));
        }

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
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]); // Tạo mới nếu không tồn tại

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $profile->image = $imagePath;
        }

        $profile->fill($request->only(['address', 'phone_number', 'gender', 'date_of_birth']));
        if (!$profile->exists) {
            $profile->user()->associate($user); // Liên kết profile với người dùng nếu là profile mới
        }
        $profile->save();
        if ($user->role_id == 0) {
            return view('profile.viewprofile', compact('profile','user'));
        }
        else{
            return view('admin.profile.viewprofile', compact('profile','user'));
        }
    }

    // Xóa profile
    public function deleteProfile()
    {
        $user = Auth::user();
        $profile = $user->profile;
        if ($profile) {
            $profile->delete();
        }
        if ($user->role_id == 0) {
            return redirect()->route('profile.show')->with('success', 'Profile deleted successfully.');
        }
        else{
            return redirect()->route('admin.profile')->with('success', 'Profile deleted successfully.');
        }
    }
}
