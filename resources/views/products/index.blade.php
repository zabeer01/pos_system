@extends('master')


@section('content')

<style>
    .product-image {
    max-width: 100px;
    max-height: 100px;
}
</style>

<div class="container">
  

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">product_name</th>
        <th scope="col">product_price</th>
        <th scope="col">product_img</th>
    
        <th scope="col">actions </th>
      
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr>
          <th scope="row">{{ $product->id }}</th>
          <td>{{ $product->product_name }}</td>
          <td>{{ $product->product_price }}</td>
          <td><img src="{{ $product->product_img }}" class="product-image" alt="Product Image"></td>
         
      </tr>
  @endforeach
  
    </tbody>
  </table>
</div> <br>
    
@endsection
