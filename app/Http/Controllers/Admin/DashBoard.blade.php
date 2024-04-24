<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\User;
use App\Models\Phone;

class DashBoardController extends Controller
{
    public function index(){
        $product_count = Phone::count();
        $category_count = Category::count();
        $user_count = User::count();
       // $order_count = Order::count();
       // $customer_count = Customer::count();
       $product_views = Phone::orderBy('product_views', 'DESC')->take(5)->get();
        return view('admin.layout.index',['product_count'=>$product_count,'category_count'=>$category_count,'user_count'=>$user_count,'product_views'=>$product_views]);
    }
    
}