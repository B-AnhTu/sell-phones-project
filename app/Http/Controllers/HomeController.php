<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Phone;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
}
