<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
{
    // Lấy danh sách sách mà người dùng đã mượn
    $orders = Order::with(['book'])->where('user_id', Auth::id())->paginate(10);

    // Kiểm tra sách gần đến ngày trả
    foreach ($orders as $order) {
        // Chỉ thông báo nếu sách đang mượn và gần đến hạn trả
        if ($order->due_date && now()->diffInDays($order->due_date) <= 3 && $order->status === Order::STATUS_BORROWED) {
            // Thông báo cho người dùng
            session()->flash('warning', 'Bạn có sách sắp đến hạn trả: ' . $order->book->name);
        }
    }

    return view('client.order', compact('orders'));
}

    public function adminIndex()
    {
        // Lấy tất cả đơn hàng cùng với thông tin sách
        $orders = Order::with(['book', 'user'])->paginate(10); // Thêm phân trang
        return view('admin.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'pickup_date' => 'required|date|after:today',
        ]);

        // Kiểm tra xem người dùng đã đặt quyển sách này chưa
        $existingOrder = Order::where('book_id', $request->book_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingOrder) {
            return redirect()->route('orders.index')->with('error', 'Bạn đã đặt quyển sách này rồi.');
        }

        // Kiểm tra số lượng đơn hàng hiện tại của người dùng
        $orderCount = Order::where('user_id', Auth::id())->count();

        if ($orderCount >= 10) {
            return redirect()->route('orders.index')->with('error', 'Bạn không thể đặt quá 10 quyển sách khác nhau một lần.');
        }

        // Tính toán ngày trả
        $returnDate = Carbon::parse($request->pickup_date)->addDays(30); // Ngày trả sẽ là 30 ngày từ ngày lấy sách

        // Tạo đơn hàng mới và liên kết với người dùng hiện tại
        $order = Order::create([
            'book_id' => $request->book_id,
            'quantity' => 1, // Đặt số lượng là 1
            'pickup_date' => $request->pickup_date,
            'status' => Order::STATUS_PENDING, // Trạng thái mặc định là Pending
            'due_date' => now()->addDays(30), // Thêm 30 ngày từ ngày hiện tại
            'return_date' => $returnDate, // Lưu ngày trả
            'user_id' => Auth::id(), // Liên kết đơn hàng với người dùng hiện tại
        ]);

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được đặt thành công.');
    }

    public function create($id)
    {
        // Lấy thông tin sách theo ID
        $book = Book::findOrFail($id);
        return view('client.ordercreate', compact('book')); // Trả về view cho form đặt hàng
    }

    public function updateStatus(Request $request, $id)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'status' => 'required|string|in:' . implode(',', [
            Order::STATUS_BORROWED,
            Order::STATUS_RETURNED,
            Order::STATUS_OVERDUE,
        ]),
    ]);

    // Tìm đơn hàng theo ID
    $order = Order::findOrFail($id);

    // Cập nhật trạng thái đơn hàng
    $order->update(['status' => $request->status]);

    return redirect()->route('staff.orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
}

    public function destroy($id)
    {
        // Tìm đơn hàng theo ID
        $order = Order::findOrFail($id);
        // Xóa đơn hàng
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được xóa thành công.');
    }

    public function showPaymentForm($id)
    {
        $order = Order::findOrFail($id);
        return view('client.payment', compact('order'));
    }

    public function processPayment(Request $request, $id)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'payment_method' => 'required|string',
        'card_number' => 'required|string',
        'expiry_date' => 'required|string|date_format:m/y',
        'cvv' => 'required|string',
    ]);

    $order = Order::findOrFail($id);
    $order->update(['status' => Order::STATUS_BORROWED]); // Cập nhật trạng thái đơn hàng

    // Thực hiện xử lý thanh toán ở đây (giả sử bạn có một phương thức thanh toán)

    return redirect()->route('orders.index')->with('success', 'Thanh toán thành công! Đơn hàng của bạn đang được xử lý.');
}

    public function staffIndex()
    {
        // Lấy danh sách đơn hàng cho staff
        $orders = Order::with('user', 'book')->paginate(10); // Lấy đơn hàng với thông tin người dùng và sách
        return view('staff.orders.index', compact('orders')); // Trả về view danh sách đơn hàng
    }

    public function confirmOrder($id)
{
    // Tìm đơn hàng theo ID
    $order = Order::findOrFail($id);

    // Cập nhật trạng thái đơn hàng thành 'borrowed'
    $order->update(['status' => Order::STATUS_BORROWED]);

    return redirect()->route('staff.orders.index')->with('success', 'Đơn hàng đã được xác nhận.');
}
}