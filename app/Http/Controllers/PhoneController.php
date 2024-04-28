<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Database\Database;
use App\Models\Phone;
use App\Models\Category;
use App\Models\Manufacturer;

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
        $phones = Phone::with('category', 'manufacturer')->paginate(4);
        return view('phones.index', compact('phones'));
    }

    /**
     * Tìm kiếm sản phẩm.
     *
     * 
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $phone = Phone::where('phone_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('description', 'like', '%' . $searchTerm . '%')
                        ->with('category', 'manufacturer')
                        ->paginate(4);

        return view('phones.search', compact('phone'));
    }
    /**
     * Hiển thị sản phẩm theo tên.
     */
    public function showByName($name)
    {
        $phone = Phone::where('name', $name)->first();
        return view('phones.show', compact('phone'));
    }

    /**
     * Hiển thị sản phẩm theo danh mục.
     */
    public function showByCategory($categoryId)
    {
        $phones = Phone::where('category_id', $categoryId)->get();
        return view('phones.index', compact('phones'));
    }

    /**
     * Hiển thị sản phẩm theo hãng.
     */
    public function showByManufacturer($manufacturerId)
    {
        $phones = Phone::where('manufacturer_id', $manufacturerId)->get();
        return view('phones.index', compact('phones'));
    }

    /**
     * Hiển thị form thêm sản phẩm.
     */
    public function createProduct()
    {
        return view('phones.create');
    }

    /**
     * Lưu sản phẩm mới vào cơ sở dữ liệu.
     */
    public function postCreateProduct(Request $request)
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

        return redirect()->route('phones.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    }

    /**
     * Hiển thị form sửa sản phẩm.
     */
    public function edit($id)
    {
        $phone = Phone::findOrFail($id);
        return view('phones.edit', compact('phone'));
    }

    /**
     * Form update phone page.
     */
    public function updatePhone(Request $request)
    {
        //Tìm id của user cần sửa
        $phone_id = $request->get('id');
        $phone = Phone::find($phone_id);
        //Chuyển đến trang cập nhật
        return view('crud_phone.update', ['phone' => $phone]);
    }
    /**
     * Cập nhật thông tin sản phẩm vào cơ sở dữ liệu.
     */
    public function postUpdatePhone(Request $request)
    {
        //Lấy tất cả thông tin trong database
        $input = $request->all();
        // Xác thực dữ liệu
        $validated = $request->validate([
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
        // Tải hình ảnh lên
        if ($request->hasFile('phone_image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }

        // Cập nhật dữ liệu sản phẩm
        $phone = Phone::find($request->id);
        $phone->name = $request->name;
        $phone->email = $request->email;
        $phone->phone = $request->phone;
        $phone->password = bcrypt($request->password);
        if ($request->hasFile('phone_image')) {
            $phone->image = $imageName;
        }
        $phone->save();


        // $user = User::find($input['id']);
        // $user->name = $input['name'];
        // $user->email = $input['email'];
        // $user->password = $input['password'];
        // $user->save();

        return redirect("list")->withSuccess('You have signed-in');

        // Cập nhật sản phẩm
        $phone = Phone::findOrFail($id);
        $phone->update($validated);

        return redirect()->route('phones.index')->with('success', 'Thông tin sản phẩm đã được cập nhật thành công.');
    }

    /**
     * Xóa sản phẩm khỏi cơ sở dữ liệu.
     */
    public function deletePhone(Request $request)
    {
        $phone_id = $request->get('id');
        $phone = Phone::destroy($phone_id);

        return redirect()->route('phones.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }

    /**
     * Tìm kiếm sản phẩm theo tên.
     */
    // public function search(Request $request)
    // {
    //     $keyword = $request->input('keyword');
    //     $phones = Phone::where('name', 'like', '%' . $keyword . '%')->get();
    //     return view('phones.index', compact('phones'));
    // }
}
