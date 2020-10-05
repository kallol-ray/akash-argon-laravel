@extends('layouts.app',['title' => 'Brand Entry'])
@section('content')
  <div class="msgAlert">
    @if(Session::has('sucMsg'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>{{ Session::get('sucMsg') }}{{ Session::forget('sucMsg')}}</strong></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    @if(Session::has('errMsg'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>{{ Session::get('errMsg') }}{{ Session::forget('errMsg')}}</strong></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
  </div>
  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        
          <div class="row">
            <div class="col-md-5 pL0">
              {!! Form::open(['url' => 'brand/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal  supply-entry-form', 'autocomplete' => 'off']) !!}
              <div class="form-group">
                <label for="brand_name">Brand Name</label>
                <input type="hidden" id="brand_id" name="brand_id" value="">
                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name">
              </div>
              <div class="form-group subres">
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtnBrand" value="Save"/>
                <input type="button" class="btn btn-outline-danger" id="reset_cancel_brand" value="Reset"/>
              </div>              
              {!! Form::close() !!}
            </div>
            <div class="col-md-6 offset-md-1 supply-entry-form">
              <h2 class="brand-head">
                Brand List
                <input type="text" class="form-control" id="search_brand" autocomplete="off" placeholder="Search...">
              </h2>
              <table border="1px" class="brand_tbl">
                <thead>
                  <tr>
                    <th width="40px">SL</th>
                    <th>Brand Name</th>
                    <th width="100px">Action</th>
                  </tr>
                </thead>
                <tbody>                  
                  @foreach ($brand_info as $brand)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $brand->brand_name }}</td>
                      <td>
                        <button class="btn btn-outline-success btn-sm" onclick="update_brand(event, '{{ $brand->brand_id }}')">Edit</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- <div class="col-md-12">
              <div class="form-group subres">
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtnCustomer" value="Save"/>
                <input type="button" class="btn btn-outline-danger" id="reset_cancel_customer" value="Reset"/>
              </div>
            </div> -->
          </div>
      </div>
    </div>
    @include('layouts.footers.auth')
  </div>
@endsection

@push('js')
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
