@extends('admin.dashboard')

@section('listprd')
<div class="d-flex">
    <a class="btn btn-success" href="{{route('product.create')}}">Create</a>
</div>
<table class="table">
    <tr>
        <th>ID</th>
        <th>IMAGE</th>
        <th>NAME</th>
        <th>PRICE</th>
        <th>STOCK</th>
        <th>DESCRIPTION</th>
        <th>FEATURE</th>
    </tr>
    @foreach ($products as $no => $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>
            <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px;">
        </td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->description }}</td>
        <td>
            <a class="btn btn-warning" href="{{route('product.edit', $product->id)}}">Edit</a>
            <form action="{{route('product.delete', $product->id)}}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<script>
document.querySelectorAll('.btn-danger').forEach(button => {
    button.addEventListener('click', function(event) {
        if (!confirm("Bạn chắc chắc muốn xóa sản phẩm này không")) {
            event.preventDefault();
        }
    });
});
</script>
@endsection
