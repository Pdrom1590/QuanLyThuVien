@extends('admin.dashboard')
@section('createprd')
<h3>PRODUCT DETAIL</h3>
<form action="{{route('product.update',$product->id)}}" method="POST">
    @csrf
    <label for="">ID</label>
    <input type="text" value="{{$product->id}}" name="id" id="id" class="form-control mb-2">
    <label for="">Image</label>
    <input type="file" name="image" value="{{$product->image}}"id="image" class="form-control mb-2">
    <label for="">Name</label>
    <input type="text" name="name" value="{{$product->name}}"id="name" class="form-control mb-2">
    <label for="">Price</label>
    <input type="number" min='0'value="{{$product->price}}" name="price" id="price" class="form-control mb-2">
    <label for="">Stock</label>
    <input type="number" min='1' value="{{$product->stock}}"value="1" name="stock" id="stock" class="form-control mb-2">
    <label for="">Description</label>
    <input type="text" min='1' value="{{$product->description}}" name="description" id="description" class="form-control mb-2">

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
