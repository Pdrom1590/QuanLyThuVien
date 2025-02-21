<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách sách với các tùy chọn tìm kiếm và phân trang
        $query = Book::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $books = $query->paginate(10); // Phân trang 10 sách mỗi trang
        return view('staff.books.index', compact('books')); // Trả về view cho staff
    }

    public function showListBook(Request $request)
    {
        // Lấy danh sách sách với các tùy chọn tìm kiếm và phân trang
        $query = Book::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $books = $query->paginate(10); // Phân trang 10 sách mỗi trang
        return view('client.books.list', compact('books')); // Trả về view cho khách
    }

    public function show($id)
    {
        // Hiển thị chi tiết sách
        $book = Book::findOrFail($id);
        return view('client.books.show', compact('book'));
    }

    public function create()
    {
        // Hiển thị form thêm sách (cho cả admin và staff)
        return view('staff.books.create'); // Sử dụng view cho staff
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isbn' => 'required|string|max:13',
            'published_date' => 'nullable|date',
        ]);

        // Tạo sách mới
        $book = new Book();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->description = $request->description;
        $book->isbn = $request->isbn;
        $book->published_date = $request->published_date;

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $book->image = $imagePath;
        }

        $book->save();

        return redirect()->route('staff.books.index')->with('success', 'Sách đã được thêm thành công.'); // Chuyển hướng về danh sách sách của staff
    }
        public function staffbook()
    {
        // Lấy danh sách sách cho nhân viên
        $books = Book::paginate(10); // Hoặc bạn có thể thêm điều kiện lọc nếu cần

        return view('staff.books.index', compact('books')); // Trả về view với danh sách sách
    }

    public function edit($id)
    {
        // Hiển thị form sửa sách (cả admin và staff đều có thể sửa sách)
        $book = Book::findOrFail($id);
        return view('staff.books.edit', compact('book')); // Sử dụng view cho staff
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isbn' => 'required|string',
            'published_date' => 'nullable|date',
        ]);

        // Cập nhật sách
        $book = Book::findOrFail($id);
        $book->name = $request->name;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->description = $request->description;
        $book->isbn = $request->isbn;
        $book->published_date = $request->published_date;

        // Xử lý hình ảnh
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $book->image = $imagePath;
        }

        $book->save();

        return redirect()->route('staff.books.index')->with('success', 'Sách đã được cập nhật thành công.'); // Chuyển hướng về danh sách sách của staff
    }

    public function destroy($id)
    {
        // Xóa sách (cho cả admin và staff)
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('staff.books.index')->with('success', 'Sách đã được xóa thành công.'); // Chuyển hướng về danh sách sách của staff
    }

    public function showStatistics()
    {
        // Hiển thị thống kê sách (chỉ cho admin)
        $totalBooks = Book::count();
        $totalOrders = Order::count(); // Tổng số đơn hàng
        $featuredBooks = Book::orderBy('created_at', 'desc')->take(5)->get(); // Lấy 5 sách mới nhất

        return view('admin.statistics', compact('totalBooks', 'totalOrders', 'featuredBooks'));
    }
}