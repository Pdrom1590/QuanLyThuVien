@extends('admin.dashboard')
@section('createprd')
<h3>PRODUCT DETAIL</h3>
<form action="{{route('product.submit')}}" method="POST">
    @csrf
    <label for="">ID</label>
    <input type="text" name="id" id="id" class="form-control mb-2"  required>
    <label for="">Image</label>
    <input type="file" name="image" id="image" class="form-control mb-2" required>
    <label for="">Name</label>
    <input type="text" name="name" id="name" class="form-control mb-2" required>
    <label for="">Price</label>
    <input type="number" min='0' name="price" id="price" class="form-control mb-2" required>
    <label for="">Stock</label>
    <input type="number" min='1' value="1" name="stock" id="stock" class="form-control mb-2" required>
    <label for="">Description</label>
    <input type="text" min='1' name="description" id="description" class="form-control mb-2" required>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
