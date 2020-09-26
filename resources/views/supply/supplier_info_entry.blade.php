@extends('layouts.app',['title' => 'Supplier Entry'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12 supply-entry-form">
        {!! Form::open(['url' => 'supplier/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="supplier_entry_date">Date</label>
                <input type="text" class="form-control" id="supplier_entry_date" name="supplier_entry_date" placeholder="dd/mm/yyyy">
              </div>
              <div class="form-group">
                <label for="supplier_name">Supplier Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Supplier Name">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="phone">
              </div>              
            </div>
            <div class="col-md-6">              
              <div class="form-group">
                <label for="comments">Comments</label>
                <textarea class="form-control" id="comments" rows="3" name="comments" placeholder="Supplier comments"></textarea>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" rows="3" name="address" placeholder="Supplier address"></textarea>
              </div>
            </div>
            <div class="col-md-12">              
              <div class="form-group subres">
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtn" value="Save"/>
                <input type="button" class="btn btn-outline-danger" id="reset_cancel_supplier" value="Reset"/>
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