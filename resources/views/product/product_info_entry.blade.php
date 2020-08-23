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
                <label for="brand">Brand</label>
                <select class="form-control" id="brand" name="brand">
                  <option value="">Select one..</option>
                  <option value="TP-Link">TP-Link</option>
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
                  <option value="Others">Others</option>
                </select>
              </div>
              <div class="form-group">
                <label for="imageToUpload">Image</label>
                <input type="file" class="form-control" name="imageToUpload" id="imageToUpload">
                <img src="#" id="uploadImagePreview">
                <!-- <input type="hidden" name="before_img_name" id="before_img_name" value=""> -->
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="title">Product Name</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Product name">
              </div>
              <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" placeholder="Model">
              </div>              
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="5" name="description" placeholder="Product description"></textarea>
              </div>
              <div class="form-group">
                <label for="entry_by">Entry By</label>
                <input type="text" class="form-control" id="entry_by" name="entry_by" placeholder="Entry By">
              </div>
            </div>
            <div class="col-md-12">              
              <div class="form-group subres">
                <!-- <input type="hidden" name="update_id" id="update_id" value="">-->
                <input type="submit" name="save_update" class="btn btn-outline-primary" id="saveBtn" value="Save"/>
                <input type="button" class="btn btn-outline-danger" id="reset_cancel" value="Reset"/>
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