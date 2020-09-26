@extends('layouts.app',['title' => 'Product Update'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'product/update', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6 pL0">
              <div class="form-group">
                <label for="info_entry_date">Date</label>
                <input type="text" class="form-control" id="info_entry_date_update" name="info_entry_date" placeholder="dd/mm/yyyy" value='{{ date("d/m/Y", strtotime(str_replace("-", "/",  $product_info_single->info_entry_date))) }}'>
              </div>
              <div class="form-group">
                <label for="title">Product Name</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Product name" value="{{ $product_info_single->title }}">
              </div>
              <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Model" value="{{ $product_info_single->model }}">
              </div>
              <div class="form-group">
                <label for="brand">Brand</label>
                <select class="form-control" id="brand" name="brand">
                  <option value="">Select one..</option>
                   @foreach ($brand_info as $brand)
                    <option value="{{ $brand->brand_name }}"  @if($product_info_single->brand == $brand->brand_name) selected @endif>{{ $brand->brand_name }}</option>
                  @endforeach
                </select>
              </div>              
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description" placeholder="Product description">{{ $product_info_single->description }}</textarea>
              </div>
              <div class="form-group">
                <label for="imageToUpload">Image</label>
                <input type="file" class="form-control" name="imageToUpload" id="imageToUpload">
                <img src="/ourwork/img/product_image/{{ $product_info_single->image }}" id="uploadImagePreview">
                <input type="hidden" name="before_img_name" id="before_img_name" value="{{ $product_info_single->image }}">
              </div>
            </div>
            <div class="col-md-12">              
              <div class="form-group subres">
                <input type="hidden" name="update_id" id="update_id" value="{{ $product_info_single->product_info_id }}">                
                <input type="submit" name="updateBtn" class="btn btn-outline-primary" id="updateBtn" value="Update"/>
                <a href="{{ route('product.view') }}" class="btn btn-outline-danger" id="update_cancel">Cancel</a>
              </div>              
            </div>         
          </div>
        {!! Form::close() !!}
      </div>
    </div>
    @include('layouts.footers.auth')
  </div>
@endsection

@push('js')
  <!-- <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script> -->
@endpush