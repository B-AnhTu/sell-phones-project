<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PremiumController extends Controller
{
    //
    public function index()
    {
        // Lấy danh sách các hội viên premium từ cơ sở dữ liệu
        $premiumMembers = Prenium::all();
        
        // Trả về view hiển thị danh sách các hội viên premium
        return view('admin.premium.index', ['premiumMembers' => $premiumMembers]);
    }

    public function create()
    {
        // Trả về view để tạo mới hội viên premium
        return view('premium.create');
    }

    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:preniums|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'hobbies' => 'required|string|max:255',
        ]);

        // Tạo một hội viên premium mới
        Prenium::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'favorite' => $request->hobbies,
        ]);

        // Chuyển hướng về trang danh sách hội viên premium với thông báo thành công
        return redirect()->route('premium.index')->with('success', 'Đã tạo mới hội viên premium thành công!');
    }
}
