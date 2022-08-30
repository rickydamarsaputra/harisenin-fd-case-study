@extends('layout.base')

@section('page_content')
<div class="container my-4">
  <div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Update Category</h1>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('category.update.action', $category->category_slug) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="category_name" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="category_name" name="category_name"
            placeholder="enter category name..." value="{{ $category->category_name }}">
          @error('category_name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
          <label for="asset" class="form-label">Upload Image</label>
          <input class="form-control" type="file" id="asset" name="asset">
          @error('asset')<small class="text-danger">{{ $message }}</small>@enderror
          <img src="{{ $category->asset->path }}" alt="{{ $category->category_name }}" class="img-thumbnail mt-3"
            width="250">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
      </form>
    </div>
  </div>
</div>
@endsection