@extends('master')
@section('content')

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name">
    </div>
    <div class="form-group">
        <label for="product_price">Product Price</label>
        <input type="number" class="form-control" id="product_price" name="product_price">
    </div>

 <div class="form-group">
    <label for="product_name">Product Img</label>
    <input type="file" id="myFile" name="product_img">
</div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection