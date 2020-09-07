@extends('layouts.app',['title' => 'Product Purchase History Entry'])
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
        {!! Form::open(['url' => 'product/store_in/entry', 'method' => 'post',  'class'=> 'form-horizontal', 'autocomplete' => 'off', 'onsubmit' => 'return barcode_entry_validation()']) !!}
          <div class="row">
            <div class="col-md-6"><!--  pL0 -->
              <div class="form-group">
                <label for="purchase_order_info_id">Purchase Order Invoice No (With Date)</label>
                <select class="form-control" id="po_auto_invoice" name="po_auto_invoice">
                  <option value="">Select one..</option>
                  @foreach($purchase_order_info as $purchase)                  
                    <option value="{{ $purchase->auto_invoice_no }}">{{ $purchase->auto_invoice_no }} ({{ date("d/m/Y", strtotime(str_replace("-", "/",  $purchase->purchased_date)))}})</option>
                  @endforeach
                  <!-- $purchase->po_info_id -->
                </select>
                <p class="validationErr">
                  @error('purchase_order_info_id')
                    {{ $message }}
                  @enderror
                </p>
                <label class="validationErr" id="invoiceNoErr"></label>
              </div>
              <div class="form-group">
                <!-- <label for="buy_date">Purchase Date</label> -->
                <input type="hidden" class="form-control" id="buy_date" name="buy_date" placeholder="dd/mm/yyyy" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="product_info_id">Product Name</label>
                <!-- <input type="hidden" class="form-control" id="product_info_id" name="product_info_id" value="" autocomplete="off">
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" autocomplete="off">
                <p class="validationErr">
                  @error('product_info_id')
                    {{ $message }}
                  @enderror
                </p> -->
                <select class="form-control" id="product_info_id" name="product_info_id">
                  <option value="">Select one..</option>
                  <!-- @foreach($product_info as $product)                  
                    <option value="{{ $product->product_info_id }}">{{ $product->title }}</option>
                  @endforeach -->
                </select>
                <label class="validationErr" id="productNotFoundErr"></label>
              </div>
              <!-- <div class="form-group">
                <label for="product_qty">Total Product Quantity of Order</label>
                <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="Total Product Quantity" autocomplete="off">
              </div>  -->             
            </div>
            <div class="col-md-6">
              <!-- <div class="form-group">
                <label for="buy_price">Unit Price</label>
                <input type="text" class="form-control" id="buy_price" name="buy_price" placeholder="Unite Price" autocomplete="off">
                <p class="validationErr">
                  @error('buy_price')
                    {{ $message }}
                  @enderror
                </p>
              </div> -->
              <div class="form-group">
                <label for="comment">Comment</label>
                <input type="text" class="form-control" id="comment" name="comment" placeholder="Comments" autocomplete="off" value="N/A" onkeydown="barcode_entry_product('comment', event)">
                <label class="validationErr" id="commentErr"></label>
              </div>
              <div class="form-group">
                <label for="barcode">Barcode</label>
                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" autocomplete="off" onkeydown="barcode_entry_product('barcode', event)">
                <label class="validationErr" id="barcodeErr"></label>
                <p class="validationErr">
                  @error('barcode')
                    {{ $message }}
                  @enderror
                </p>
              </div>              
              <!-- <div class="form-group">
                <label for="entry_by">Entry By</label>
                <input type="text" class="form-control" id="entry_by" name="entry_by" placeholder="Entry By">
              </div> -->
            </div>
            <div class="col-md-12">              
              <div class="form-group subres">
                <!-- <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtn" value="Save" style="display: inline-block;" /> -->
                <input type="button" class="btn btn-outline-danger" id="reset_cancel_store" value="Reset"/>
              </div>              
            </div>         
          </div>
        {!! Form::close() !!}

        <!-- <p class="text-success" style="font-weight: bold;">Total product entry <span id="entry_no_now">0</span> of <span id="total_product_no">0</span>.</p> -->
      </div>
    </div>
    @include('layouts.footers.auth')
  </div>
@endsection

@push('js')
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush