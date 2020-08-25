@extends('layouts.app',['title' => 'Product Purchase Entry'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'product/purchase_order/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-6 pL0">
              <div class="form-group">
                <label for="purchased_date">Date</label>
                <input type="text" class="form-control" id="purchased_date" name="purchased_date" placeholder="dd/mm/yyyy">
              </div>
              <div class="form-group">
                <label for="supplier_id">Supplier Name</label>
                <select class="form-control" id="supplier_id" name="supplier_id">
                  <option value="">Select one..</option>
                  @foreach($supplier_info as $supplier)                  
                    <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="product_info_id">Product Name</label>
                <select class="form-control" id="product_info_id" name="product_info_id">
                  <option value="">Select one..</option>
                  @foreach($product_info as $product)                  
                    <option value="{{ $product->product_info_id }}">{{ $product->title }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="purchase_invoice_no">Purchase Invoice Number</label>
                <input type="text" class="form-control" id="purchase_invoice_no" name="purchase_invoice_no" placeholder="Purchase Invoice Number">
              </div>
              <div class="form-group">
                <label for="product_qty">Product Quantity</label>
                <input type="number" class="form-control" id="product_qty" name="product_qty" placeholder="Product Quantity">
              </div>              
              <div class="form-group">
                <label for="comments">Comments</label>
                <textarea class="form-control" id="comments" rows="5" name="comments" placeholder="Comments"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="total_bill">Total Bill</label>
                <input type="text" class="form-control" id="total_bill" name="total_bill" placeholder="Total Bill">
              </div>
              <div class="form-group">
                <label for="vat">Vat Amount</label>
                <input type="text" class="form-control" id="vat" name="vat" placeholder="Vat Amount">
              </div>
              <div class="form-group">
                <label for="discount">Discount Amount</label>
                <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount Amount">
              </div>
              <div class="form-group">
                <label for="paid_or_due">Payment Type</label>
                <select class="form-control" id="paid_or_due" name="paid_or_due">
                  <option value="">Select one..</option>
                  <option value="0">Partial Payment</option>
                  <option value="1">Full Due</option>
                  <option value="2">Full Paid</option>
                </select>
              </div>
              <div class="form-group">
                <label for="paid_amount">Paid Amount</label>
                <input type="text" class="form-control" id="paid_amount" name="paid_amount" placeholder="Paid Amount">
              </div>
              <div class="form-group">
                <label for="due_amount">Due Amount</label>
                <input type="text" class="form-control" id="due_amount" name="due_amount" placeholder="Due Amount">
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
                <input type="button" class="btn btn-outline-danger" id="reset_cancel_purchase" value="Reset"/>
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