@extends('layouts.app',['title' => 'Brand Entry'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        
          <div class="row">
            <div class="col-md-6 pL0">
              {!! Form::open(['url' => 'brand/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
              <div class="form-group">
                <label for="brand_name">Brand Name</label>
                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name">
              </div>
              <div class="form-group subres">
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtnCustomer" value="Save"/>
                <!-- <input type="button" class="btn btn-outline-danger" id="reset_cancel_customer" value="Reset"/> -->
              </div>              
              {!! Form::close() !!}
            </div>
            <div class="col-md-6">
              <h2 class="brand-head">Brand List</h2>
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
