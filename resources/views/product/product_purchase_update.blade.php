@extends('layouts.app',['title' => 'Product Purchase Order Update'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'product/purchase_order/update', 'method' => 'post', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6 pL0">
              <div class="form-group">
                <label for="purchased_date_update">Date</label>
                <input type="text" class="form-control" id="purchased_date_update" name="purchased_date" placeholder="dd/mm/yyyy" value='{{ date("d/m/Y", strtotime(str_replace("-", "/",  $purchase->purchased_date))) }}'>
              </div>
              <div class="form-group">
                <label for="supplier_id">Supplier Name</label>
                <select class="form-control" id="supplier_id" name="supplier_id">
                  <option value="">Select one..</option>
                  @foreach($supplier_info as $supplier)                  
                    <option value="{{ $supplier->supplier_id }}"
                      @if($supplier->supplier_id == $purchase->supplier_id)
                        selected
                      @endif
                    >{{ $supplier->supplier_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="product_info_id">Product Name</label>
                <select class="form-control" id="product_info_id" name="product_info_id">
                  <option value="">Select one..</option>
                  @foreach($product_info as $product)                  
                    <option value="{{ $product->product_info_id }}"
                      @if($product->product_info_id == $purchase->product_info_id)
                        selected
                      @endif
                    >{{ $product->title }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="purchase_invoice_no">Purchase Invoice Number</label>
                <input type="text" class="form-control" id="purchase_invoice_no" name="purchase_invoice_no" placeholder="Purchase Invoice Number" value="{{ $purchase->purchase_invoice_no }}">
              </div>
              <div class="form-group">
                <label for="product_qty">Product Quantity</label>
                <input type="number" class="form-control" id="product_qty" name="product_qty" placeholder="Product Quantity" value="{{ $purchase->product_qty }}">
              </div>              
              <div class="form-group">
                <label for="comments">Comments</label>
                <textarea class="form-control" id="comments" rows="5" name="comments" placeholder="Comments">{{ $purchase->comments }}</textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="total_bill">Total Bill</label>
                <input type="text" class="form-control" id="total_bill" name="total_bill" placeholder="Total Bill" value="{{ $purchase->total_bill }}">
              </div>
              <div class="form-group">
                <label for="vat">Vat Amount</label>
                <input type="text" class="form-control" id="vat" name="vat" placeholder="Vat Amount" value="{{ $purchase->vat }}">
              </div>
              <div class="form-group">
                <label for="discount">Discount Amount</label>
                <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount Amount" value="{{ $purchase->discount }}">
              </div>
              <div class="form-group">
                <label for="paid_or_due">Payment Type</label>
                <select class="form-control" id="paid_or_due" name="paid_or_due">
                  <option value="">Select one..</option>
                  <option value="0" @if($purchase->paid_or_due  == '0') selected @endif>Partial Payment</option>
                  <option value="1" @if($purchase->paid_or_due  == '1') selected @endif>Full Due</option>
                  <option value="2" @if($purchase->paid_or_due  == '2') selected @endif>Full Paid</option>
                </select>
              </div>
              <div class="form-group">
                <label for="paid_amount">Paid Amount</label>
                <input type="text" class="form-control" id="paid_amount" name="paid_amount" placeholder="Paid Amount" value="{{ $purchase->paid_amount }}">
              </div>
              <div class="form-group">
                <label for="due_amount">Due Amount</label>
                <input type="text" class="form-control" id="due_amount" name="due_amount" placeholder="Due Amount" value="{{ $purchase->due_amount }}">
              </div>
              <div class="form-group">
                <label for="entry_by">Entry By</label>
                <input type="text" class="form-control" id="entry_by" name="entry_by" placeholder="Entry By" value="{{ $purchase->entry_by }}">
              </div>
            </div>
            <div class="col-md-12">              
              <div class="form-group subres">
                 <input type="hidden" name="po_info_id" id="po_info_id" value="{{ $purchase->po_info_id }}">
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtn" value="Update"/>
                <a href="/product/purchase_order/view" class="btn btn-outline-danger" id="reset_cancel_purchase">Cancel</a>
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