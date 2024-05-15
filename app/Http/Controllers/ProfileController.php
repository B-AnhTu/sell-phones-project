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
        $user = Auth::user();
        if ($user->role_id == 0) {
            return view('profile.createprofile', compact('user'));
        } else {
            return view('admin.profile.createprofile', compact('user'));
        }
    }

    // Lưu thông tin profile mới
    public function postCreateProfile(Request $request)
    {
        $request->validate([
            'user_fullname' => 'required|string|max:255', // Validation cho tên người dùng
            'address' => 'nullable', // Địa chỉ có thể không được cung cấp
            'phone_number' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'nullable|date', // Ngày sinh có thể không được cung cấp và phải là định dạng ngày tháng hợp lệ nếu có
            'image' => 'nullable|image'
        ]);

        $user = Auth::user();
        $user->user_fullname = $request->user_fullname; // Cập nhật tên người dùng
        $user->save();

        $profile = new Profile($request->except(['user_fullname']));
        $profile->user_id = $user->id;
        if ($request->date_of_birth) {
            $profile->date_of_birth = Carbon::createFromFormat('Y-m-d', $request->date_of_birth)->toDateString();
        }

        $profile->phone_number = $request->phone_number;
        $profile->gender = $request->gender;
        $profile->address = $request->address;
        // Xử l tải lên hình ảnh
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $profile->image = $imageName;
        }
        $profile->save();

        if ($user->role_id == 0) {
            return redirect()->route('profile.show')->with('success', 'Profile created successfully.');
        } else {
            return redirect()->route('admin.profile')->with('success', 'Profile created successfully.');
        }
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
            return view('profile.editprofile', compact('profile', 'user'));
        } else {
            return view('admin.profile.editprofile', compact('profile', 'user'));
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
        $user->user_fullname = $request->user_fullname;
        $user->save();
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]); // Tạo mới nếu không tồn tại


        $profile->fill($request->only(['address', 'phone_number', 'gender', 'date_of_birth']));
        if (!$profile->exists) {
            $profile->user()->associate($user); // Liên kết profile với người dùng nếu là profile mới
        }
        
        // Xử l tải lên hình ảnh
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $profile->image = $imageName;
        }
        $profile->save();
        if ($user->role_id == 0) {
            return view('profile.viewprofile', compact('profile', 'user'));
        } else {
            return view('admin.profile.viewprofile', compact('profile', 'user'));
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
        } else {
            return redirect()->route('admin.profile')->with('success', 'Profile deleted successfully.');
        }
    }
}
