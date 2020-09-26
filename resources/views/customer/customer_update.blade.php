@extends('layouts.app',['title' => 'Customer Update'])
@section('content')
  
  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12 customer-entry-from">
        {!! Form::open(['url' => 'customer/update', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" class="form-control allowNumbersOnly" id="customer_name" name="customer_name" placeholder="Customer Name" value="{{ $customer_info[0]->customer_name }}">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control allowNumbersOnly" id="phone" name="phone" placeholder="Phone No" value="{{ $customer_info[0]->phone }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" class="form-control allowNumbersOnly" id="company_name" name="company_name" placeholder="Compnay Name" value="{{ $customer_info[0]->company_name }}">
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control allowNumbersOnly" id="address" name="address" placeholder="Address" value="{{ $customer_info[0]->address }}">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group subres">
                 <input type="hidden" name="update_id" id="update_id" value="{{ $customer_info[0]->customer_id }}">
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtnCustomer" value="Update"/>

                <a href="/customer/view" class="btn btn-outline-danger" id="reset_cancel_customer">Cancel</a>
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
