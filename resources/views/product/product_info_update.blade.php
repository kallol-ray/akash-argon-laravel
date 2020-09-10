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
                  <!-- <option value="TP-Link" @if($product_info_single->brand =='TP-Link') selected @endif>TP-Link</option>
                  <option value="Tenda" @if($product_info_single->brand =='Tenda') selected @endif>Tenda</option>
                  <option value="D-Link" @if($product_info_single->brand =='D-Link') selected @endif>D-Link</option>
                  <option value="Mikrotik" @if($product_info_single->brand =='Mikrotik') selected @endif>Mikrotik</option>
                  <option value="Xiaomi" @if($product_info_single->brand =='Xiaomi') selected @endif>Xiaomi</option>
                  <option value="Netgear" @if($product_info_single->brand =='Netgear') selected @endif>Netgear</option>
                  <option value="Huawei" @if($product_info_single->brand =='Huawei') selected @endif>Huawei</option>
                  <option value="Asus" @if($product_info_single->brand =='Asus') selected @endif>Asus</option>
                  <option value="Linksys" @if($product_info_single->brand =='Linksys') selected @endif>Linksys</option>
                  <option value="Belkin" @if($product_info_single->brand =='Belkin') selected @endif>Belkin</option>
                  <option value="Cisco" @if($product_info_single->brand =='Cisco') selected @endif>Cisco</option>
                  <option value="TRENDnet" @if($product_info_single->brand =='TRENDnet') selected @endif>TRENDnet</option>
                  <option value="Others" @if($product_info_single->brand =='Others') selected @endif>Others</option> -->
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