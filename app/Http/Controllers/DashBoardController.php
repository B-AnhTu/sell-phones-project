<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Phone;
use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index(){

        if (auth()->user()->user_type == 1) {
            // Nếu là admin
            return redirect()->route('admin.dashboard');
        } else {
            // Nếu là người dùng thường
            return redirect()->route('phone.index');
        }
       

       // Truy vấn dữ liệu từ các bảng khác
    //    $categories = Category::all();
    //    $manufacturers = Manufacturer::all();

    //    // Truyền dữ liệu vào view
    //    return view('header.dashboard', [
    //        'categories' => $categories,
    //        'manufacturers' => $manufacturers
    //    ]);
    }
    public function adminIndex(){
        $products = Phone::all();
        $users = User::all();
        $categories = Category::all();
        $manufacturers = Manufacturer::all();
        return view('admin.dashboard', compact('products', 'categories','manufacturers', 'users'));
    }
    public function profile(){
        return view('profile.viewprofile');
    }
    public function adminProfile(){
        return view('admin.profile.viewprofile');
    }
}
