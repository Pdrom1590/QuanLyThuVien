<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showListProduct(){
        $products = Product::get();
        return view('products.list',compact('products'));
    }
    public function submit(request $request){
        $product = new Product();
        $product->id = $request->id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->save();

        return redirect()->route('products.list');
    }
    public function edit($id){
        $product = Product::find($id);
        return view('products.edit',compact('product'));
    }
    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->image = $request->image;
        $product->save();

        return redirect()->route('products.list');
    }
    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.list');
    }
}