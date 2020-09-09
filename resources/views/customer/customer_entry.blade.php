@extends('layouts.app',['title' => 'Customer Entry'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'customer/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6 pL0">
              <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control allowNumbersOnly" id="customer_name" name="customer_name" placeholder="Customer Name">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control allowNumbersOnly" id="phone" name="phone" placeholder="Phone No">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control allowNumbersOnly" id="company_name" name="company_name" placeholder="Compnay Name">
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control allowNumbersOnly" id="address" name="address" placeholder="Address">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group subres">
                <!-- <input type="hidden" name="update_id" id="update_id" value="">-->
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtnCustomer" value="Save"/>
                <input type="button" class="btn btn-outline-danger" id="reset_cancel_customer" value="Reset"/>
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
