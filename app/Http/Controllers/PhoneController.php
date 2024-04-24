<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Database\Database;
use App\Models\Phone;
use App\Models\User;
use App\Models\Category;
use App\Models\Manufacturer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phones = Phone::all();
        $category = Category::all();
        $manufacturer = Manufacturer::all();
        return view('phone.index', compact('phones', 'category','manufacturer'));
    }
    public function searchProduct_Admin(Request $request)
    {
        $keyword = $request->keyword;
        $products = Phone::where('name', 'LIKE', '%' . $keyword . '%')->paginate(4);
        return view('admin.product.listproduct', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Xóa điện thoại
    */
    public function deleteProduct($id)
    {
        $deleteData = DB::table('products')->where('id', '=', $id)->delete();
        return redirect('listproduct');
    }
    /**
     * Update Product
     */
    public function updateProduct(Request $request){
        $updateData = DB::table('phones')->where('id', $request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'instock' => $request->instock,
            'sold' => $request->sold,
            'id_category' => $request->id_category,
        ]);
        //Thực hiện chuyển trang
        return redirect('listproduct');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
