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
class CrudUserController extends Controller
{
    /**
     * Login page
     */
    public function login()
    {
        //Đường dẫn đến trang login
        return view('crud_user.login');
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
            return redirect()->intended('list')
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
        return view('crud_user.registration');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        
        
        //Kiểm tra validation cho các trường dữ liệu
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Kiểm tra xem 'phone' có được gửi từ form hay không
        if (!empty($data['phone'])) {
            // Nếu 'phone' không được gửi từ form, gán giá trị mặc định hoặc null cho 'phone'
            $data['phone'] = null;
        }


        // Xử lý tải lên hình ảnh
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        // Tạo người dùng mới
        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'image' => $data['image'],
        ]);
        //Trở lại trang login và hiển thị thông báo người dùng đăng ký thành công
        return redirect("login")->withSuccess('User registered successfully!');
    }

    /**
     * View user detail page
     */
    public function readUser(Request $request) {
        //Lấy id của người dùng cần đọc và tìm đúng id đó
        $user_id = $request->get('id');
        $user = User::find($user_id);
        //Đường dẫn đến trang view với biến truyền đi là messi
        return view('crud_user.read', ['messi' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request) {
        //Lấy id của người dùng cần xóa
        $user_id = $request->get('id');
        $user = User::destroy($user_id);
        //Trở lại trang danh sách
        return redirect("list")->withSuccess('You have signed-in');
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
        return view('crud_user.update', ['user' => $user]);
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

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        //Kiểm tra người dùng đã đăng nhập chưa, nếu chưa thì chuyển người dùng đến trang login để đăng nhập
        
        if(Auth::check()){
            $users = User::paginate(3); // Phân trang, mỗi trang có 3 mục
            return view('crud_user.list', ['users' => $users]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
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