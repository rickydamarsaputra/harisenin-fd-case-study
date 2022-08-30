@extends('layout.base')

@section('page_content')
<div class="container my-4">
  <div class="d-flex justify-content-between mb-4">
    <h1 class="h3">Update Product</h1>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('product.update.action', $product->product_slug) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="product_name" class="form-label">Product Name</label>
          <input type="text" class="form-control" id="product_name" name="product_name"
            value="{{ $product->product_name }}" placeholder="enter product name..." required>
          @error('product_name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}"
            placeholder="enter product price..." required>
          @error('price')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"
            placeholder="enter product description..." required>{{ $product->description }}</textarea>
          @error('description')<small class="text-danger">{{ $message }}</small>@enderror
        </div>
        <label for="asset" class="form-label">Upload Image</label>
        <div class="asset-container">
          <div class="mb-3 row d-flex justify-content-between align-items-end asset-wrapper" data-img-count="0">
            <div class="col-lg-6">
              <input class="form-control" type="file" id="asset-0" name="assets[]" multiple>
            </div>
            <div class="col-lg-1">
              <button type="button" class="btn btn-danger btn-delete-img" data-img-count="0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                  viewBox="0 0 16 16">
                  <path
                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd"
                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </button>
            </div>
          </div>
        </div>
        <div>
          @foreach ($product->product_assets as $product_asset)
          <div class="mb-3 row d-flex justify-content-between align-items-end asset-wrapper">
            <div class="col-lg-6">
              <img src="{{ $product_asset->asset->path }}" alt="{{ $product_asset->asset->name }}" class="img-thumbnail"
                width="250">
            </div>
            <div class="col-lg-1">
              <a href="{{ route('product.asset.delete', $product_asset->id) }}" class="btn btn-danger btn-delete-img">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                  viewBox="0 0 16 16">
                  <path
                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd"
                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </a>
            </div>
          </div>
          @endforeach
        </div>
        @error('assets')<small class="text-danger">{{ $message }}</small>@enderror
        <button type="submit" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-info text-white btn-add-img">
          Add Image
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image"
            viewBox="0 0 16 16">
            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
            <path
              d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
          </svg>
        </button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  let counter = 0;

  $('.btn-add-img').on('click', function(){
    counter ++;
    const assetElement = `
      <div class="mb-3 row d-flex justify-content-between align-items-end asset-wrapper" data-img-count="${counter}">
        <div class="col-lg-6">
          <input class="form-control" type="file" id="asset-${counter}" name="assets[]" multiple>
        </div>
        <div class="col-lg-1">
          <button type="button" class="btn btn-danger btn-delete-img" data-img-count="${counter}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
              viewBox="0 0 16 16">
              <path
                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
              <path fill-rule="evenodd"
                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
            </svg>
          </button>
        </div>
      </div>
    `;

    $('.asset-container').append(assetElement);

    $('.btn-delete-img').on('click', function(){
      const currentCount = $(this).attr('data-img-count');
      
      $(`.asset-wrapper[data-img-count='${currentCount}']`).remove();
    });
  });
</script>
@endpush