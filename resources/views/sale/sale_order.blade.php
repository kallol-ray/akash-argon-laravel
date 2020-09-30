@extends('layouts.app',['title' => 'Order Entry Form'])
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
      <div class="col-md-12 sale_order_form">
        {!! Form::open(['url' => 'order_place/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
          <div class="row">
            <div class="col-md-12 topBar"></div>
            <div class="col-md-8">
              <!-- <div class="form-group">
                <label for="purchased_date">Date</label>
                <input type="text" class="form-control" id="purchased_date" name="purchased_date" placeholder="dd/mm/yyyy">
              </div> -->
              <div class="form-group">
                <label for="supplier_id">Customer Name</label>
                <select class="form-control" id="customer_id" name="customer_id">
                  <option value="">Select one..</option>
                  @foreach($customer_info as $customer)
                    <option value="{{ $customer->customer_id }}">{{ $customer->customer_name }} ({{ $customer->phone }})</option>                    
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-outline-primary" id="add_customer_sale">Add Customer</button>
            </div>
            <div class="col-md-4">
            </div>
            <table class="order_entry_tbl" id="sale_entry_item">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="32%">Product Name</th>
                  <th width="8%">Image</th>
                  <th width="10%">Model</th>
                  <th width="10%">Brand</th>
                  <th width="5%">Qty</th>
                  <th width="12.5%">Unit Price</th>
                  <th width="12.5%">Total Price</th>
                  <th width="5%"></th>
                </tr>
              </thead>
              <tbody>
                <!-- Dynamic Items Placed Here -->
              </tbody>
            </table>
            <div class="col-md-12" style="margin-top: 10px;">
              <button id="add_row_sell_item" type="button" class="btn btn-outline-default btn-sm" onclick="sale_row_add()">Add Row</button>
            </div>            
            <div class="col-md-12" style="margin-top: 40px;">
              <div class="payment-part">
                <div class="">
                  <div class="form-group">
                    <label for="paid_or_due_sale">Payment Status</label>
                    <select name="paid_or_due" id="paid_or_due_sale" class="form-control">
                      <option value="">Select one...</option>
                      <option value="0">Partial Payment</option>
                      <option value="1">Full Due</option>
                      <option value="2">Full Paid</option>
                    </select>
                  </div>
                </div>
                <div class="" style="width: 40%; float: left;">
                  <div class="form-group">
                    <label for="paid_amount_sale">Paid Amount</label>
                    <input type="text" name="paid_amount" placeholder="Paid Amount" value="0" id="paid_amount_sale" class="form-control">
                  </div>
                </div>
                <div class="" style="width: 40%; float: left; margin-left: 20%;">
                  <div class="form-group">
                    <label for="due_amount">Due Amount</label>
                    <input type="text" name="due_amount" id="due_amount" placeholder="Due Amount" value="0" class="form-control">
                  </div>
                </div>
              </div>
              <div class="po_summary">
                <div class="k-control">
                  <div class="k-label">Sub Total:</div>
                  <input type="text" class="k-field allowNumbersOnly" name="sub_total" id="sub_total" value="0.00" placeholder="Sub Total" required readonly>
                </div>
                <div class="k-control">
                  <div class="k-label">VAT:</div>
                  <div class="k-field-vat"><input type="text" name="vat_percent" id="vat_percent" class="order_input_vat allowNumbersOnly" value="5" onblur="calcSaleTotal()" placeholder="Vat Percent" required>&nbsp;%</div>
                </div>
                <div class="k-control">
                  <div class="k-label">VAT Amount:</div>
                  <input type="text" class="k-field allowNumbersOnly" id="vat_amount" name="vat_amount" value="0.00" placeholder="Vat Amount" required readonly>
                </div>
                <div class="k-control">
                  <div class="k-label">Grand Total:</div>
                  <input class="k-field" required name="grand_total" id="grand_total" value="0.00" placeholder="Grand Total" required readonly>
                </div>
                <div class="k-control">
                  <div class="k-label">Discount:</div>
                  <input class="k-field" required name="discount" id="discount" value="0.00" placeholder="Discount Amount" onblur="saleDiscountCalc(this)">
                </div>
                <div class="k-control">
                  <div class="k-label">Customer Paid:</div>
                  <input class="k-field" required name="customer_paid" id="customer_paid" value="0.00" placeholder="Customer Paid" required readonly>
                </div>

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group subres">
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtn" value="Save"/>
                <input type="button" class="btn btn-outline-danger" id="reset_cancel_sale" value="Reset"/>
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
