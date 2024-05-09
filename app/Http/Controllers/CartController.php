<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng của người dùng hiện tại.
     */
    public function index()
    {
        $user_id = Auth::id(); // Lấy ID của người dùng hiện tại
        $carts = Cart::with('cartDetails')->where('user_id', $user_id)->get();

        return view('carts.index', compact('carts'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function add(Request $request)
    {
        $request->validate([
            'phone_id' => 'required|exists:phones,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()],
            ['total_price' => 0] // Giá trị khởi tạo
        );

        $cartDetail = new CartDetail([
            'cart_id' => $cart->id,
            'phone_id' => $request->phone_id,
            'quantities' => $request->quantity,
            'total_price' => 0 // Sẽ được cập nhật sau
        ]);

        // Giả sử có một phương thức để lấy giá của phone
        $price = Phone::find($request->phone_id)->price;
        $cartDetail->total_price = $price * $request->quantity;
        $cartDetail->save();

        // Cập nhật tổng giá trị giỏ hàng
        $cart->total_price += $cartDetail->total_price;
        $cart->save();

        return redirect()->route('carts.index')->with('success', 'Product added to cart successfully!');
    }

    /**
     * Cập nhật sản phẩm trong giỏ hàng.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartDetail = CartDetail::findOrFail($id);
        $oldTotal = $cartDetail->total_price;
        $newTotal = $cartDetail->phone->price * $request->quantity;

        $cartDetail->quantities = $request->quantity;
        $cartDetail->total_price = $newTotal;
        $cartDetail->save();

        // Cập nhật tổng giá trị giỏ hàng
        $cart = $cartDetail->cart;
        $cart->total_price = $cart->total_price - $oldTotal + $newTotal;
        $cart->save();

        return redirect()->route('carts.index')->with('success', 'Cart updated successfully!');
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     */
    public function remove($id)
    {
        $cartDetail = CartDetail::findOrFail($id);
        $cart = $cartDetail->cart;
        $cart->total_price -= $cartDetail->total_price;
        $cart->save();

        $cartDetail->delete();

        return redirect()->route('carts.index')->with('success', 'Product removed from cart successfully!');
    }

    /**
     * Tìm kiếm sản phẩm trong giỏ hàng.
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)
                     ->whereHas('cartDetails', function ($query) use ($keyword) {
                         $query->where('name', 'like', '%' . $keyword . '%');
                     })
                     ->get();

        return view('carts.search', compact('carts'));
    }
}