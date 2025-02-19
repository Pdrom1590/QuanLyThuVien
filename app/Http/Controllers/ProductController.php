<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function showListProduct(Request $request)
    {
        $products = Product::all();
        return view('admin.products.list',compact('products'));
    }

    // Các phương thức khác (submit, edit, update, delete, showListBook) không thay đổi
   public function submit(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
    ],[
        'name.required' => 'Tên sản phẩm là bắt buộc.',
        'image.required' => 'Hình ảnh là bắt buộc.',
        'image.image' => 'File tải lên phải là hình ảnh.',
        'image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
        'image.max' => 'Kích thước hình ảnh không được vượt quá 10MB.',
        // Các thông báo lỗi khác...
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->description = $request->description;

    // Xử lý hình ảnh
    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $product->image = '/storage/' . $path; // Lưu đường dẫn hình ảnh vào cơ sở dữ liệu
    }

    $product->save();

    return redirect()->route('products.list')->with('success', 'Product created successfully.');
}
    public function edit($id){
        $product = Product::find($id);
        return view('admin.products.edit',compact('product'));
    }
    public function update(Request $request, $id){
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
    ]);

    $product = Product::find($id);
    $product->name = $request->name;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->description = $request->description;
    // Xử lý hình ảnh
    if ($request->hasFile('image')) {
        // Xóa hình ảnh cũ nếu cần
        // if ($product->image) {
        //     $oldImagePath = public_path($product->image);
        //     if (file_exists($oldImagePath)) {
        //         unlink($oldImagePath);
        //     }
        // }
        $path = $request->file('image')->store('products', 'public'); // Lưu hình ảnh mới
        dd($path);
               $product->image = '/storage/' . $path; // Cập nhật đường dẫn hình ảnh mới vào cơ sở dữ liệu
    }
    $product->save();

    return redirect()->route('products.list')->with('success', 'Product updated successfully.');
}
    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.list');
    }
    public function showListBook(request $request){
        $query = $request->input('query');
        $category = $request->input('category');
        $products = Product::query();
        if ($query) {
            $products->where('name', 'LIKE', '%' . $query . '%');
        }
        if ($category) {
            $products->where('category', $category);
        }
        $products = $products->paginate(8); // Phân trang 8 sản phẩm mỗi trang
        return view('client.listbook', compact('products'));
    }
public function show($id)
{
    // Tìm sản phẩm theo ID, nếu không tìm thấy sẽ đưa ra lỗi 404
    $product = Product::findOrFail($id);
    // Trả về view chi tiết sản phẩm cùng với thông tin của sản phẩm đó
    return view('client.detail', compact('product'));
}
}
