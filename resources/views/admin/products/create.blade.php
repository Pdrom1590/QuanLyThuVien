@extends('admin.dashboard')
@section('createprd')
<h3>PRODUCT DETAIL</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"> <!-- Thêm enctype -->
    @csrf

    <div class="form-group mb-2">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control" required>
    </div>

    <div class="form-group mb-2">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group mb-2">
        <label for="price">Price</label>
        <input type="number" min='0' name="price" id="price" class="form-control" required>
    </div>

    <div class="form-group mb-2">
        <label for="stock">Stock</label>
        <input type="number" min='1' value="1" name="stock" id="stock" class="form-control" required>
    </div>

    <div class="form-group mb-2">
        <label for="description">Description</label>
        <input type="text" min='1' name="description" id="description" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
