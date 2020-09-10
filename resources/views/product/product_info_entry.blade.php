@extends('layouts.app',['title' => 'Product Entry'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'product/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6 pL0">
              <div class="form-group">
                <label for="info_entry_date">Date</label>
                <input type="text" class="form-control" id="info_entry_date" name="info_entry_date" placeholder="dd/mm/yyyy">
              </div>
              <div class="form-group">
                <label for="title">Product Name</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Product name">
              </div>
              <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Model">
              </div>
              <div class="form-group">
                <label for="brand">Brand</label>
                <select class="form-control" id="brand" name="brand">
                  <option value="">Select one..</option>
                  
                  @foreach ($brand_info as $brand)
                    <option value="{{ $brand->brand_name }}">{{ $brand->brand_name }}</option>
                  @endforeach    
                  <!-- <option value="TP-Link">TP-Link</option>
                  <option value="Tenda">Tenda</option>
                  <option value="D-Link">D-Link</option>
                  <option value="Mikrotik">Mikrotik</option>
                  <option value="Xiaomi">Xiaomi</option>
                  <option value="Netgear">Netgear</option>
                  <option value="Huawei">Huawei</option>
                  <option value="Asus">Asus</option>
                  <option value="Linksys">Linksys</option>
                  <option value="Belkin">Belkin</option>
                  <option value="Cisco">Cisco</option>
                  <option value="TRENDnet">TRENDnet</option>
                  <option value="Others">Others</option> -->
                </select>
              </div>              
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="2" name="description" placeholder="Product description"></textarea>
              </div>
              <div class="form-group">
                <label for="imageToUpload">Image</label>
                <input type="file" class="form-control" name="imageToUpload" id="imageToUpload">
                <img src="#" id="uploadImagePreview">
              </div>
            </div>
            <!-- <div class="col-md-4">
              <div class="col-md-12" style="height: calc(100% - 1.5rem);">
                <div style="border: 1px solid red; height: 100%; border-radius: 5px; background-color: lightblue;">
                  <h3 class="text-center">Total Entry Product</h3>
                </div>
              </div>
            </div> -->
            <div class="col-md-12">
              <div class="form-group subres">                
                <input type="submit" name="save" class="btn btn-outline-primary" id="saveBtn" value="Save"/>
                <input type="button" class="btn btn-outline-danger" id="reset_product_entry" value="Reset"/>
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
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush