<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Book; // Sử dụng mô hình Book
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị giỏ hàng của người dùng
    public function show()
    {
        $carts = Cart::where('user_id', Auth::id())
            ->with('book') // Tải sách liên quan
            ->get();

        return view('client.cart', compact('carts'));
    }

    // Thêm sách vào giỏ hàng
    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id', // Đảm bảo rằng book_id được cung cấp và hợp lệ
        ]);

        $book = Book::find($request->book_id);

        // Kiểm tra số lượng trong kho
        if ($book->stock < 1) {
            return redirect()->back()->withErrors(['book_unavailable' => 'Sách này đã hết hàng hoặc không còn đủ số lượng.']);
        }

        // Kiểm tra xem sách đã tồn tại trong giỏ hàng chưa
        $cart = Cart::where('user_id', Auth::id())
                    ->where('book_id', $book->id)
                    ->first();

        if ($cart) {
            // Nếu sách đã có trong giỏ hàng, không cho phép thêm nữa
            return redirect()->back()->withErrors(['book_exists' => 'Bạn đã thêm sách này vào giỏ hàng.']);
        }

        // Nếu không có, thêm vào giỏ hàng
        Cart::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,  // Đảm bảo book_id được thêm vào
            'quantity' => 1,  // Giả sử mặc định là 1 sản phẩm
        ]);

        return redirect()->route('cart.show')->with('success', 'Sách đã được thêm vào giỏ hàng.');
    }

    // Cập nhật số lượng sách trong giỏ hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.show')->with('success', 'Giỏ hàng đã được cập nhật thành công.');
    }

    // Xóa sách khỏi giỏ hàng
    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.show')->with('success', 'Sách đã được xóa khỏi giỏ hàng thành công.');
    }
}