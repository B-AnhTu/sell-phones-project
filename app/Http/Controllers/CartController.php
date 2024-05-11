<?php

namespace App\Http\Controllers;

use App\Models\Phone;
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
        $cart = session()->get('cart');
        //return view('cart', compact('cart'));
        //$carts = Cart::with('cartDetails')->where('user_id', $user_id)->get();

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

        $phone = Phone::findOrFail($request->phone_id);
        $cart = session()->get('cart', []);

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$phone->id])) {
            $cart[$phone->id]['quantity'] += $request->quantity;
        } else {
            $cart[$phone->id] = [
                "name" => $phone->name,
                "quantity" => $request->quantity,
                "price" => $phone->price,
                "total_price" => $phone->price * $request->quantity
            ];
        }

        session()->put('cart', $cart);
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