<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
public function index()
{
    // Lấy danh sách đơn hàng của người dùng
    $orders = Order::with(['product', 'user'])->get(); // Lấy đơn hàng cùng với thông tin sản phẩm và người dùng

    return view('client.order', compact('orders'));
}

public function adminIndex()
{
    $orders = Order::with('product', 'user')->get(); // Lấy tất cả đơn hàng cùng với thông tin sản phẩm và người dùng
    return view('admin.products.order.index', compact('orders'));
}

    public function store(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'pickup_date' => 'required|date|after:today',
    ]);

    // Tìm sản phẩm theo ID
    $product = Product::findOrFail($request->product_id);

    // Tạo đơn hàng mới
    $order = Order::create([
        'product_id' => $request->product_id,
        'quantity' => 1, // Đặt số lượng là 1
        'pickup_date' => $request->pickup_date,
        'status' => 'pending',
        'due_date' => now()->addDays(30), // Thêm 30 ngày từ ngày hiện tại
    ]);

    // Giảm số lượng tồn kho của sản phẩm
    $product->decrement('stock', 1);

    return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được đặt thành công.');
}
    public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Cập nhật trạng thái
    $order->update(['status' => $request->status]);

    // Nếu trạng thái là "đang mượn", cập nhật thông tin người mượn và thời gian
    if ($request->status === 'borrowing') {
        $order->update([
            'borrowed_by' => Auth::id(), // ID của người mượn
            'borrowed_at' => now(), // Thời gian mượn
            'due_date' => now()->addDays(30), // Thời gian phải trả
        ]);
    }

    return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
}

public function destroy($id)
{
    // Tìm đơn hàng theo ID
    $order = Order::findOrFail($id);
    // Xóa đơn hàng
    $order->delete();
    return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa thành công.');
}

}