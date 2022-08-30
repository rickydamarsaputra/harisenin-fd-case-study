@extends('layout.base')

@section('page_content')
<div class="container my-4">
  <div class="d-flex justify-content-between mb-4">
    <h1 class="h3">List Category</h1>
    <a href="{{ route('category.create.view') }}" class="btn btn-primary">Add Category</a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $category->category_name }}</td>
            <td>
              <img src="{{ $category->asset->path }}" alt="{{ $category->category_name }}" class="img-thumbnail"
                width="250">
            </td>
            <td>
              <a href="{{ route('category.delete', $category->category_slug) }}" class="btn btn-danger">Delete</a>
              <a href="{{ route('category.update.view', $category->category_slug) }}" class="btn btn-success">Update</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection