<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Database\Database;
use App\Models\Phone;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class PhoneController extends Controller
{
    /**
     * Hiển thị danh sách 4 sản phẩm có phân trang.
     *
     * 
     */
    public function index()
    {
        // Truy vấn dữ liệu từ bảng phones
        $phones = Phone::orderBy('phone_id', 'desc')->paginate(4);
        // Truy vấn dữ liệu từ các bảng khác

        // Truyền dữ liệu vào view
        return view('home', [
            'phones' => $phones,
        ]);

    }

    /**
     * Tìm kiếm sản phẩm.
     *
     * 
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $phones = Phone::where('phone_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('description', 'like', '%' . $searchTerm . '%')
                        ->with('category', 'manufacturer')
                        ->paginate(4);

        return view('phones.search', compact('phones'));
    }
    /**
     * Chi tiết sản phẩm
     * 
     */
    public function show($id)
    {
        $phone = Phone::with('category', 'manufacturer')->findOrFail($id);
        return view('phones.show', compact('phone'));
    }
    /**
     * Hiển thị sản phẩm theo tên.
     */

    public function showByName($name)
    {
        $phone = DB::table('phones')::where('phone_name', $name)->get();
        return view('phones.show', compact('phone'));
    }

    /**
     * Hiển thị sản phẩm theo danh mục.
     */
    public function showByCategory($id)
    {
        $category = Category::with('phones')->findOrFail($id); // Eager load phones with the category
        $phones = $category->phones;

        return view('phones.index', compact('category', 'phones'));
    }

    /**
     * Hiển thị sản phẩm theo hãng.
     */
    public function showByManufacturer($manufacturerId)
    {
        $phones = Phone::where('manufacturer_id', $manufacturerId)->get();
        // Điều chỉnh trường status dựa trên giá trị của trường quantities
        foreach ($phones as $phone) {
            $phone->status = ($phone->quantities > 0) ? 1 : 0;
            $phone->save();
        }
        return view('phones.index', compact('phones'));
    }

    // Admin

    /**
     * Hiển thị form thêm sản phẩm.
     */
    public function createPhone()
    {
        $categories = DB::table('categories')->select('*')->get();
        $manufacturers = DB::table('manufacturers')->select('*')->get();
        $products = DB::table('products')->select('*')->get();
        return view('admin.phone.create', ['categories' => $categories, 'products' => $products, 'manufacturers' => $manufacturers]);
    }

    /**
     * Lưu sản phẩm mới vào cơ sở dữ liệu.
     */
    public function postCreatePhone(Request $request)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'phone_name' => 'required|unique:phones|max:100',
            'phone_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|max:100',
            'price' =>'required|numeric',
            'quantities' =>'required|numeric',
            'purchases' =>'required|numeric',
            'status' =>'required|numeric',
            'manufacturer_id' =>'required|numeric',
            'category_id' =>'required|numeric',
            
        ]);

        $data = $request->all();

        // Tạo sản phẩm mới
        $phone = Phone::create([
            'phone_name' => $data['phone_name'],
            'phone_image' => $data['phone_image'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantities' => $data['quantities'],
            'purchases' => $data['purchases'],
            'status' => $data['status'],
            'manufacturer_id' => $data['manufacturer_id'],
            'category_id' => $data['category_id'],
        ]);
        $phone->save();

        return redirect()->route('admin.phone.list')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    /**
     * Hiển thị form sửa sản phẩm.
     */
    public function updatePhone(Request $request)
    {
        //Tìm id của user cần sửa
        $phone_id = $request->get('id');
        $phone = Phone::find($phone_id);
        //Chuyển đến trang cập nhật
        return view('admin.phone.update', ['phone' => $phone]);
    }
    /**
     * Cập nhật thông tin sản phẩm vào cơ sở dữ liệu.
     */
    public function postUpdatePhone(Request $request)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'phone_name' => 'required|unique:phones,phone_name,' . $request->id . '|max:100',
            'phone_image' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'description' => 'required|max:100',
            'price' => 'required|numeric',
            'quantities' => 'required|numeric',
            'purchases' => 'required|numeric',
            'status' => 'required|numeric',
            'manufacturer_id' => 'required|numeric',
            'category_id' => 'required|numeric',
        ]);

        // Tải hình ảnh lên
        if ($request->hasFile('phone_image')) {
            $imageName = time() . '.' . $request->phone_image->extension();
            $request->phone_image->move(public_path('images'), $imageName);
        }

        // Cập nhật dữ liệu sản phẩm
        $phone = Phone::find($request->id);
        $phone->phone_name = $validated['phone_name'];
        $phone->description = $validated['description'];
        $phone->price = $validated['price'];
        $phone->quantities = $validated['quantities'];
        $phone->purchases = $validated['purchases'];
        $phone->status = $validated['status'];
        $phone->manufacturer_id = $validated['manufacturer_id'];
        $phone->category_id = $validated['category_id'];
        if ($request->hasFile('phone_image')) {
            $phone->phone_image = $imageName;
        }
        $phone->save();

        return redirect()->route('admin.phone.list')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }
    /**
     * Hiển thị danh sách sản phẩm admin.
     */
    public function adminIndex()
    {
        // Truy vấn lấy tất cả điện thoại, có thể thêm phân trang nếu cần
        $phones = Phone::orderBy('created_at', 'desc')->paginate(10);

        // Trả về view quản lí điện thoại cho admin
        return view('admin.phone.list', compact('phones'));
    }

    /**
     * Xóa sản phẩm khỏi cơ sở dữ liệu.
     */
    public function deletePhone(Request $request)
    {
        $phone_id = $request->get('id');
        
        // Kiểm tra xem điện thoại có tồn tại không
        $phone = Phone::find($phone_id);
        if (!$phone) {
            return redirect()->route('admin.phone.list')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Thực hiện xóa điện thoại
        try {
            $phone->delete();
            return redirect()->route('admin.phone.list')->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $e) {
            // Xử l lỗi khi xóa không thành công
            return redirect()->route('admin.phone.list')->with('error', 'Xóa sản phẩm không thành công.');
        }
    }
}
