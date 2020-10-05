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
        {!! Form::open(['url' => 'order_place/update', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
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
                    <option value="{{ $customer->customer_id }}"
                      @if($customer->customer_id == $saleInfo['customer_id'] )
                        selected
                      @endif
                    >{{ $customer->customer_name }} ({{ $customer->phone }})</option>                    
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <!-- <button type="button" class="btn btn-outline-primary" id="add_customer_sale" disabled>Add Customer</button> -->
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
                @foreach($saleItems as $item)
                  <tr class="saleItemRow" data-code="{{ $item['barcode'] }}">
                    <td class="text-center slnoSaleItem">{{ $loop->iteration }}</td>
                    <td class="name">
                      <input type="hidden" name="product_id[]" value="{{ $item['product_info_id'] }}" class="product_id" required="" readonly="" />
                      <input type="hidden" name="inventory_id[]" value="{{ $item['inventory_id'] }}" class="inventory_id" required="" readonly="" />
                      <input type="hidden" name="barcode[]" value="{{ $item['barcode'] }}" class="barcode" required="" readonly="" />
                      <input type="text" name="product_name[]" placeholder="Product Name" class="order_input productName" value="{{ $item['product_name'] }}" required readonly />
                    </td>
                    <td class="text-center img">
                      <img src="/ourwork/img/product_image/{{ $item['image'] }}" class="order_product_img" alt="Image" />
                    </td>
                    <td class="model text-center">
                      {{ $item['model'] }}
                    </td>
                    <td class="brand text-center">
                      {{ $item['brand'] }}
                    </td>
                    <td class="quantity">
                      <input type="text" name="quantity[]" id="qty_1" value="{{ $item['qty'] }}" placeholder="Quantity" class="order_input product_qty" required="" max="1" />
                    </td>
                    <td class="price">
                      <input type="text" name="unit_price[]" id="sale_unit_price_1" placeholder="Unit Price" class="order_input unit_price" value="{{ $item['unit_price'] }}" unit-price="{{ $item['unit_price'] }}" onblur="unit_price_validation(this)" required="" />
                    </td>
                    <td class="last_price">
                      <input type="text" name="total_price[]" id="total_price_1" placeholder="Total Price" class="order_input total_price" value="{{ $item['sale_price'] }}" required="" readonly="" />
                    </td>
                    <td class="text-center remove">
                      <img src="/ourwork/img/icon/delete-icon.png" class="delet-icon" onclick="remove_order_list(this, '{{ $item['barcode'] }}')" />
                    </td>
                  </tr>
                @endforeach
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
                      <option value="0"
                        @if($saleInfo["paid_or_due"] == 0)
                        selected 
                        @endif
                      >Partial Payment</option>
                      <option value="1"
                        @if($saleInfo["paid_or_due"] == 1)
                        selected 
                        @endif
                      >Full Due</option>
                      <option value="2"
                        @if($saleInfo["paid_or_due"] == 2)
                        selected 
                        @endif
                      >Full Paid</option>
                    </select>
                  </div>
                </div>
                <div class="" style="width: 40%; float: left;">
                  <div class="form-group">
                    <label for="paid_amount_sale">Paid Amount</label>
                    <input type="text" name="paid_amount" placeholder="Paid Amount" value="{{ $saleInfo['paid_amount'] }}" id="paid_amount_sale" class="form-control">
                  </div>
                </div>
                <div class="" style="width: 40%; float: left; margin-left: 20%;">
                  <div class="form-group">
                    <label for="due_amount">Due Amount</label>
                    <input type="text" name="due_amount" id="due_amount" placeholder="Due Amount" value="{{ $saleInfo['due_amount'] }}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="po_summary">
                <div class="k-control">
                  <div class="k-label">Sub Total:</div>
                  <input type="text" class="k-field allowNumbersOnly" name="sub_total" id="sub_total" value="{{ $saleInfo['sub_total_bill'] }}" placeholder="Sub Total" required readonly>
                </div>
                <div class="k-control">
                  <div class="k-label">Discount:</div>
                  <input class="k-field" required name="discount" id="discount" value="{{ $saleInfo['discount'] }}" placeholder="Discount Amount" onblur="saleDiscountCalc(this)">
                </div>                
                <div class="k-control">
                  <div class="k-label">Grand Total:</div>
                  <input class="k-field" required name="grand_total" id="grand_total" value="{{ $saleInfo['after_discount'] }}" placeholder="Grand Total" required readonly>
                </div>
                <div class="k-control">
                  <div class="k-label">VAT:</div>
                  <div class="k-field-vat"><input type="text" name="vat_percent" id="vat_percent" class="order_input_vat allowNumbersOnly" value="{{ $saleInfo['vat_percent'] }}" onblur="calcSaleTotal()" placeholder="Vat Percent" required>&nbsp;%</div>
                </div>
                <div class="k-control">
                  <div class="k-label">VAT Amount:</div>
                  <input type="text" class="k-field allowNumbersOnly" id="vat_amount" name="vat_amount" value="{{ $saleInfo['vat_amount'] }}" placeholder="Vat Amount" required readonly>
                </div>                
                <div class="k-control">
                  <div class="k-label">Customer Paid:</div>
                  <input class="k-field" required name="customer_paid" id="customer_paid" value="{{ $saleInfo['customer_paid'] }}" placeholder="Customer Paid" required readonly>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group subres">                
                <input type="hidden" name="sale_info_id" value="{{ $saleInfo['sale_info_id'] }}"/>
                <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtn" value="update"/>
                <a href="/order_place/view" class="btn btn-outline-danger" id="reset_cancel_sale" >Cancel</a>
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
