@extends('layouts.app',['title' => 'Product Purchase Entry'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'product/store_in/entry', 'method' => 'post',  'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6 pL0">              
              <div class="form-group">
                <label for="purchase_order_info_id">Purchase Order Invoice No (With Date)</label>
                <select class="form-control" id="purchase_order_info_id" name="purchase_order_info_id">
                  <option value="">Select one..</option>
                  @foreach($purchase_order_info as $purchase)                  
                    <option value="{{ $purchase->po_info_id }}">{{ $purchase->purchase_invoice_no }} ({{ date("d/m/Y", strtotime(str_replace("-", "/",  $purchase->purchased_date)))}})</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <!-- <label for="buy_date">Purchase Date</label> -->
                <input type="hidden" class="form-control" id="buy_date" name="buy_date" placeholder="dd/mm/yyyy">
              </div>
              <div class="form-group">
                <label for="product_info_id">Product Name</label>
                <input type="hidden" class="form-control" id="product_info_id" name="product_info_id" value="0" readonly>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name">
                <!-- <select class="form-control" id="product_info_id" name="product_info_id">
                  <option value="">Select one..</option>
                  @foreach($product_info as $product)                  
                    <option value="{{ $product->product_info_id }}">{{ $product->title }}</option>
                  @endforeach
                </select> -->
              </div>
              <div class="form-group">
                <label for="product_qty">Total Product Quantity</label>
                <input type="number" class="form-control" id="product_qty" name="product_qty" placeholder="Total Product Quantity">
              </div>
              <div class="form-group">
                <label for="buy_price">Unit Price</label>
                <input type="number" class="form-control" id="buy_price" name="buy_price" placeholder="Unite Price">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="comments">Comments</label>
                <textarea class="form-control" id="comments" rows="5" name="comments" placeholder="Comments"></textarea>
              </div>
              <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode">
              </div>              
              <div class="form-group">
                <label for="entry_by">Entry By</label>
                <input type="text" class="form-control" id="entry_by" name="entry_by" placeholder="Entry By">
              </div>
            </div>
            <div class="col-md-12">              
              <div class="form-group subres">
                <!-- <input type="hidden" name="update_id" id="update_id" value="">-->
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtn" value="Save"/>
                <input type="button" class="btn btn-outline-danger" id="reset_cancel_store" value="Reset"/>
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