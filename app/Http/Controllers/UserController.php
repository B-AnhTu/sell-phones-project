<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * CRUD User controller
 */
class UserController extends Controller
{
    /**
     * Login page
     */
    public function login()
    {
        //Đường dẫn đến trang login
        return view('auth.login');
    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        //Kiểm tra các trường có được nhập đầy đủ không
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //Lấy dữ liệu của trường email, password duy nhất
        $credentials = $request->only('email', 'password');
        // Kiểm tra phiên đăng nhập có hợp lệ không, nếu thành công chuyển đường dẫn sang trang list
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')
                ->withSuccess('Signed in');
        }
        //Nếu đăng nhập thất bại thì hiển thị lỗi
        return redirect("login")->withSuccess('Login details are not valid');
    }
    /**
     * Registration page
     */
    public function createUser()
    {
        //Đường dẫn đến trang tạo người dùng
        return view('auth.registration');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        // Kiểm tra validation cho các trường dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
        ]);

        // Xử lý tải lên hình ảnh
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        } else {
            $validatedData['image'] = null; // Đảm bảo rằng trường image không bị lỗi khi không có file được tải lên
        }

        // Tạo người dùng mới
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'image' => $validatedData['image'],
        ]);

        // Trở lại trang login và hiển thị thông báo người dùng đăng ký thành công
        return redirect("login")->with('success', 'User registered successfully!');
    }

    /**
     * View user detail page
     */
    public function readUser(Request $request) {
        //Lấy id của người dùng cần đọc và tìm đúng id đó
        $user_id = $request->get('id');
        $user = User::find($user_id);
        //Đường dẫn đến trang view với biến truyền đi là user
        return view('admin.user.read', ['user' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request) {
        $user_id = $request->get('id');
    $user = User::find($user_id);
    // Nếu tìm được user thì trở về trang danh sách và thông báo xóa user thành công
    if ($user) {
        $user->delete();
        return redirect()->route('user.list')->withSuccess('User deleted successfully');
    } 
    // Nếu không tìm được user thì trở về trang danh sách và thông báo lỗi
    else {
        return redirect()->route('user.list')->withError('User not found');
    }
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        //Tìm id của user cần sửa
        $user_id = $request->get('id');
        $user = User::find($user_id);
        //Chuyển đến trang cập nhật
        return view('admin.user.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        //Lấy tất cả thông tin trong database
        $input = $request->all();
        //Kiểm tra các trường dữ liệu hợp lệ
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,id,'.$input['id'],
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:15',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Adjust validation rules for image
        ]);
        // Tải hình ảnh lên
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }

        // Cập nhật dữ liệu người dùng
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        if ($request->hasFile('image')) {
            $user->image = $imageName;
        }
        $user->save();


        // $user = User::find($input['id']);
        // $user->name = $input['name'];
        // $user->email = $input['email'];
        // $user->password = $input['password'];
        // $user->save();

        return redirect()->route('user.list')->withSuccess('You have signed-in');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        //Kiểm tra người dùng đã đăng nhập chưa, nếu chưa thì chuyển người dùng đến trang login để đăng nhập
        
        if(Auth::check()){
            $users = User::paginate(10); // Phân trang, mỗi trang có 3 mục
            return view('admin.user.list', ['users' => $users]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    // public function searchUser(Request $request)
    // {
    //     $keyword = $request->keyword;
    //     $users = User::where('name', 'LIKE', '%' . $keyword . '%')->paginate(3);
    //     return view('shop/shop', compact('users'));
    // }
    public function searchUserAdmin(Request $request)
    {
        $keyword = $request->input('keyword');
        $users = User::where('user_fullname', 'LIKE', '%' . $keyword . '%')->paginate(4);
        return view('admin.user.list', compact('users'));
    }
    /**
     * Sort users
     */
    public function sortUser($direction)
    {
        $users = User::orderBy('user_fullname', $direction)->paginate(10);
        return view('admin.user.list', compact('users'));
    }

    /**
     * Sign out
     */
    public function signOut() {
        //Đăng xuất khỏi phiên đăng nhập hiện tại
        Session::flush();
        Auth::logout();
        //Quay lại trang login
        return Redirect('login');
    }
}