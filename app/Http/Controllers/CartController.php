<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng của người dùng
public function show()
{
    $carts = Cart::where('user_id', Auth::id())
        ->with('product') // Tải sản phẩm liên quan
        ->get();
    // Tải danh sách tất cả sản phẩm (có thể cần thêm hạn chế nếu cần)
    $products = Product::all();
    return view('client.cart', compact('carts', 'products'));
}
    // Thêm sản phẩm vào giỏ hàng
  public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $product = Product::find($request->product_id);

    // Kiểm tra số lượng trong kho
    if ($product->stock < 1) {
        return redirect()->back()->withErrors(['product_unavailable' => 'Sản phẩm này đã hết hàng hoặc không còn đủ số lượng.']);
    }

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

    if ($cart) {
        // Nếu sản phẩm đã có trong giỏ hàng, không cho phép thêm nữa
        return redirect()->back()->withErrors(['product_exists' => 'Bạn đã thêm sản phẩm này vào giỏ hàng.']);
    }

    // Nếu không có, thêm vào giỏ hàng
    Cart::create([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'quantity' => 1,  // Chỉ mượn một quyển sách
    ]);

    return redirect()->route('cart.show')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
}
    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.show')->with('success', 'Cart updated successfully.');
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.show')->with('success', 'Product removed from cart successfully.');
    }
}
