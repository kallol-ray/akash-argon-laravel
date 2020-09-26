@extends('layouts.app',['title' => 'Supplier Update'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12 supply-entry-form">
        {!! Form::open(['url' => 'supplier/update', 'method' => 'post', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="supplier_entry_date_update">Date</label>
                <input type="text" class="form-control" id="supplier_entry_date_update" name="supplier_entry_date" placeholder="dd/mm/yyyy" value="{{ date('d/m/Y', strtotime(str_replace('/', '-', $supplier_info[0]->supplier_entry_date)))}}">
              </div>
              <div class="form-group">
                <label for="supplier_name">Supplier Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Supplier Name" value="{{ $supplier_info[0]->supplier_name }}">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="{{ $supplier_info[0]->phone }}">
              </div>              
            </div>
            <div class="col-md-6">              
              <div class="form-group">
                <label for="comments">Comments</label>
                <textarea class="form-control" id="comments" rows="3" name="comments" placeholder="Supplier comments">
                  {{ $supplier_info[0]->comments }}
                </textarea>
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" rows="3" name="address" placeholder="Supplier address">
                  {{ $supplier_info[0]->address }}
                </textarea>
              </div>
            </div>
            <div class="col-md-12">              
              <div class="form-group subres">
                <input type="hidden" name="supplier_id" value="{{ $supplier_info[0]->supplier_id }}"/>
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtn" value="Update"/>
                <a href="/supplier/view" class="btn btn-outline-danger" id="reset_cancel_supplier">Cancel</a>
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