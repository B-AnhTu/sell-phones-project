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

        return view('home', compact('phones'));
    }
    public function searchAdmin(Request $request)
    {
        $searchTerm = $request->input('search');
        $phones = Phone::where('phone_name', 'like', '%' . $searchTerm . '%')
            ->orWhere('description', 'like', '%' . $searchTerm . '%')
            ->paginate(10);

        return view('admin.phone.list', compact('phones'));
    }
    /**
     * Chi tiết sản phẩm
     * 
     */
    public function show($id)
    {
        $phone = Phone::with('category', 'manufacturer')->findOrFail($id);
        return view('home', compact('phone'));
    }
    /**
     * Hiển thị sản phẩm theo tên.
     */

    public function showByName($name)
    {
        $phone = DB::table('phones')::where('phone_name', $name)->get();
        return view('home', compact('phone'));
    }

    /**
     * Hiển thị sản phẩm theo danh mục.
     */
    public function showByCategory($id)
    {
        // Tìm danh mục hoặc trả về lỗi nếu không tìm thấy
        $category = Category::findOrFail($id);

        // Truy vấn các sản phẩm thuộc danh mục và áp dụng phân trang
        $phones = $category->phones()->paginate(4);

        // Truyền dữ liệu vào view
        return view('home', compact('category', 'phones'));
    }

    /**
     * Hiển thị sản phẩm theo hãng.
     */
    public function showByManufacturer($manufacturerId)
    {
        // Tìm hãng hoặc trả về lỗi nếu không tìm thấy
        $manufacturer = Manufacturer::findOrFail($manufacturerId);

        // Truy vấn các sản phẩm thuộc danh mục và áp dụng phân trang
        $phones = $manufacturer->phones()->paginate(4);

        // Truyền dữ liệu vào view
        return view('home', compact('manufacturer', 'phones'));
    }

    // Admin

    /**
     * Hiển thị form thêm sản phẩm.
     */
    public function createPhone()
    {

        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        return view('admin.phone.create', ['categories' => $categories, 'manufacturers' => $manufacturers]);
    }

    /**
     * Lưu sản phẩm mới vào cơ sở dữ liệu.
     */
    public function postCreatePhone(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'phone_name' => 'required|unique:phones,phone_name|max:100',
            'phone_image' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'description' => 'required|max:1000',
            'price' => 'required|numeric',
            'quantities' => 'required|numeric',
            'status' => 'nullable|numeric|default:1',
            'purchases' => 'nullable|numeric|default:0',
            'manu_id' => 'required|numeric|exists:manufacturers,manu_id',
            'category_id' => 'required|numeric|exists:categories,category_id',
        ]);

        $data = $request->all(); // Lấy tất cả dữ liệu đầu vào

        // Xử l tải lên hình ảnh
        if ($request->hasFile('phone_image')) {
            $imageName = time().'.'.$request->phone_image->extension();
            $request->phone_image->move(public_path('images'), $imageName);
            $data['phone_image'] = $imageName;
        }

        // Tạo sản phẩm mới
        $phone = Phone::create([
            'phone_name' => $data['phone_name'],
            'phone_image' => $data['phone_image'],
            'description' => $data['description'],
            'price' => $data['price'],
            'quantities' => $data['quantities'],
            'purchases' => 0,
            'status' => 1,
            'manu_id' => $data['manu_id'],
            'category_id' => $data['category_id'],
        ]);

        return redirect()->route('phones.adminIndex')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    /**
     * Hiển thị form sửa sản phẩm.
     */
    public function updatePhone(Request $request)
    {
        //Tìm id của phone cần sửa
        $phone_id = $request->get('phone_id');
        $phone = Phone::find($phone_id);

        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        //Chuyển đến trang cập nhật
        return view('admin.phone.update', ['phone' => $phone, 'categories' => $categories, 'manufacturers' => $manufacturers]);
    }
    /**
     * Cập nhật thông tin sản phẩm vào cơ sở dữ liệu.
     */
    public function postUpdatePhone(Request $request)
    {
        // Xác thực dữ liệu
        $validated = $request->validate([
            'phone_id' => 'required|numeric|exists:phones,phone_id',
            'phone_name' => 'required|unique:phones,phone_name,' . $request->phone_id . ',phone_id|max:100',
            'phone_image' => 'nullable|image|mimes:jpeg,png,svg|max:2048',
            'description' => 'required|max:1000',
            'price' => 'required|numeric',
            'quantities' => 'required|numeric',
            'manu_id' => 'required|numeric|exists:manufacturers,manu_id',
            'category_id' => 'required|numeric|exists:categories,category_id',
        ]);

        // Cập nhật dữ liệu sản phẩm
        $phone = Phone::findOrFail($validated['phone_id']);
        $phone->phone_name = $validated['phone_name'];
        $phone->description = $validated['description'];
        $phone->price = $validated['price'];
        $phone->quantities = $validated['quantities'];
        $phone->manu_id = $validated['manu_id'];
        $phone->category_id = $validated['category_id'];
        if ($request->hasFile('phone_image')) {
            $imageName = time() . '.' . $request->phone_image->extension();
            $request->phone_image->move(public_path('images'), $imageName);
            $phone->phone_image = $imageName;
        }
        $phone->save();

        return redirect()->route('phones.adminIndex')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }
    /**
     * Hiển thị danh sách sản phẩm admin.
     */
    public function adminIndex()
    {
        // Truy vấn lấy tất cả điện thoại, có thể thêm phân trang nếu cần
        $phones = Phone::orderBy('phone_id', 'asc')->paginate(10);

        // Trả về view quản lí điện thoại cho admin
        return view('admin.phone.list', compact('phones'));
    }

    /**
     * Xóa sản phẩm khỏi cơ sở dữ liệu.
     */
    public function deletePhone(Request $request)
    {
        $phone_id = $request->get('phone_id');

        // Kiểm tra xem điện thoại có tồn tại không
        $phone = Phone::find($phone_id);
        if (!$phone) {
            return redirect()->route('phones.adminIndex')->with('error', 'Sản phẩm không tồn tại.');
        }

        // Thực hiện xóa điện thoại
        try {
            $phone->delete();
            return redirect()->route('phones.adminIndex')->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $e) {
            // Xử lý lỗi khi xóa không thành công
            return redirect()->route('phones.adminIndex')->with('error', 'Xóa sản phẩm không thành công.');
        }
    }
    // Sắp xếp sản phẩm theo tên
    public function sortByPhoneName()
    {
        $phones = Phone::orderBy('phone_name')->paginate(5);
        return view('admin.phone.list', compact('phones'));
    }

    // Sắp xếp sản phẩm theo ngày mua
    public function sortByPurchaseDate()
    {
        $phones = Phone::orderBy('purchases', 'asc')->paginate(5);
        return view('admin.phone.list', compact('phones'));
    }

    // Sắp xếp sản phẩm theo số lượng
    public function sortByQuantity()
    {
        $phones = Phone::orderBy('quantities', 'asc')->paginate(5);
        return view('admin.phone.list', compact('phones'));
    }

    // Sắp xếp sản phẩm theo giá tiền
    public function sortByPrice()
    {
        $phones = Phone::orderBy('price', 'asc')->paginate(5);
        return view('admin.phone.list', compact('phones'));
    }
}
