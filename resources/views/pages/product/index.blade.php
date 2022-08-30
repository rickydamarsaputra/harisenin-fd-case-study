@extends('layout.base')

@section('page_content')
<div class="container my-4">
  <div class="d-flex justify-content-between mb-4">
    <h1 class="h3">List Product</h1>
    <a href="{{ route('product.create.view') }}" class="btn btn-primary">Add Product</a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->price }}</td>
            <td>
              <a href="{{ route('product.delete', $product->product_slug) }}" class="btn btn-danger">Delete</a>
              <a href="{{ route('product.update.view', $product->product_slug) }}" class="btn btn-success">Update</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection