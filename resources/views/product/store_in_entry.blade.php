@extends('layouts.app',['title' => 'Stock Entry'])
@section('content')

  <div class="msgAlert"></div>
  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
          {!! Form::open(['url' => 'product/store_in/entry', 'method' => 'post',  'class'=> 'form-horizontal', 'autocomplete' => 'off', 'onsubmit' => 'return barcode_entry_validation()']) !!}
              <div class="row boderset">
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
                      <label for="product_info_id_frm_stock">Product Name</label>
                      <!-- <input type="hidden" class="form-control" id="product_info_id_frm_stock" name="product_info_id_frm_stock" value="" autocomplete="off">
                      <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" autocomplete="off">
                      <p class="validationErr">
                        @error('product_info_id_frm_stock')
                          {{ $message }}
                        @enderror
                      </p> -->
                      <select class="form-control" id="product_info_id_frm_stock" name="product_info_id_frm_stock">
                        <option value="">Select one..</option>
                        <!-- @foreach($product_info as $product)                  
                          <option value="{{ $product->product_info_id }}">{{ $product->title }}</option>
                        @endforeach -->
                      </select>
                      <label class="validationErr" id="productNotFoundErr"></label>
                    </div>             
                  </div>
                  <div class="col-md-6">
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
                  </div>
                  <div class="col-md-12">              
                    <div class="form-group stockreset">
                      <!-- <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtn" value="Save" style="display: inline-block;" /> -->
                      <input type="button" class="btn btn-outline-danger" id="reset_cancel_store" value="Reset"/>
                    </div>              
                  </div>
              </div>            
          {!! Form::close() !!}
        <p class="text-success" style="width: 50%; float: left;">
          Current item entry <span id="current_item_entry">0</span> of <span id="total_current_item_no">0</span>
        </p>
        <p class="text-success text-right" style="width: 50%; float: left;">
          Total product entry <span id="entry_no_now">0</span> of <span id="total_product_no">0</span>
        </p>
      </div>
    </div>
    @include('layouts.footers.auth')
  </div>
@endsection

@push('js')
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush