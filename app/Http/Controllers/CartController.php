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
        //Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        //Trả về view cart.index và truyền biến $cart vào view đó
        return view('cart.index', compact('cart'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function add(Request $request)
    {
        //Kiểm tra điều kiện của phone và số lượng sản phẩm
        $request->validate([
            'phone_id' => 'required|exists:phones,phone_id',
            'quantity' => 'required|integer|min:1'
        ]);
        //Tìm đúng id của phone đó
        $phone = Phone::findOrFail($request->phone_id);

        //Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
    
        //Kiểm tra nếu giỏ hàng đã có sản phẩm thuộc id đó rồi thì cập nhật số lượng và tổng tiền
        if (isset($cart[$phone->phone_id])) {
            $cart[$phone->phone_id]['quantity'] += $request->quantity;
            $cart[$phone->phone_id]['total_price'] = $cart[$phone->phone_id]['price'] * $cart[$phone->phone_id]['quantity'];
        }
        //Nếu chưa có sản phẩm thuộc id đó thì thêm vào giỏ hàng
        else {
            $cart[$phone->phone_id] = [
                "name" => $phone->phone_name,
                "image" => $phone->phone_image, 
                "quantity" => $request->quantity,
                "price" => $phone->price,
                "total_price" => $phone->price * $request->quantity
            ];
        }
        //Lưu giỏ hàng vào session
        session()->put('cart', $cart);
        
        //Chuyển hướng về trang chủ
        return redirect()->route('phone.index')->with('success', 'Product added to cart successfully!');
    }

    /**
     * Cập nhật số lượng của sản phẩm trong giỏ hàng.
     */
    public function update(Request $request, $id)
    {
        // Kiểm tra điều kiện của số lượng sản phẩm
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra nếu sản phẩm có tồn tại trong giỏ hàng
        if (isset($cart[$id])) {
            // Cập nhật số lượng sản phẩm và tổng tiền
            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['total_price'] = $cart[$id]['price'] * $request->quantity;
        }

        // Lưu giỏ hàng đã cập nhật vào session
        session()->put('cart', $cart);

        // Chuyển hướng về trang giỏ hàng với thông báo thành công
        return redirect()->route('carts.index')->with('success', 'Cart updated successfully!');
    }


    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     */
    public function remove(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu đầu vào (phone_id)
        $request->validate([
            'phone_id' => 'required|exists:phones,phone_id'
        ]);

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra nếu sản phẩm tồn tại trong giỏ hàng thì xóa nó
        if (isset($cart[$request->phone_id])) {
            unset($cart[$request->phone_id]);
        }

        // Lưu giỏ hàng đã cập nhật vào session
        session()->put('cart', $cart);

        $cart = session()->get('cart', []);
        
        // Chuyển hướng người dùng về trang chủ với thông báo thành công
        return redirect()->route('phone.index')->with('success', 'Product removed from cart successfully!');
    }


    /**
     * Tìm kiếm sản phẩm trong giỏ hàng.
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $cart = session()->get('cart', []);
        $filteredCart = array_filter($cart, function ($item) use ($keyword) {
            return false !== stripos($item['name'], $keyword);
        });

        return view('cart.search', compact('filteredCart'));
    }
}