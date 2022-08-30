@extends('layout.base')

@section('page_content')
<div class="container my-4">
  <div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Create Category</h1>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('category.create.action') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="category_name" class="form-label">Category Name</label>
          <input type="text" class="form-control" id="category_name" name="category_name"
            placeholder="enter category name...">
          @error('category_name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
          <label for="asset" class="form-label">Upload Image</label>
          <input class="form-control" type="file" id="asset" name="asset">
          @error('asset')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection