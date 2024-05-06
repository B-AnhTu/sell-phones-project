<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Phone;
use App\Models\Manufacturer;

class DashBoardController extends Controller
{
    public function index(){
        $products = Phone::count();
        $categories = Category::count();
        $manufacturers = Manufacturer::count();
        return view('admin.dashboard', compact('products', 'categories','manufacturers'));
    }
}
