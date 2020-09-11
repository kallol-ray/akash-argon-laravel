@extends('layouts.app',['title' => 'Order Entry Form'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'order_place/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
          <div class="row">
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
                    <option value="{{ $customer->customer_name }}">{{ $customer->customer_name }} ({{ $customer->phone }})</option>                    
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <button type="button" class="btn btn-outline-primary" style="float: right; margin-top: 35px;">Add Customer</button>
            </div>
            <div class="col-md-4">
            </div>
            <table class="order_entry_tbl" id="sale_entry_item">
              <thead>
                <tr>
                  <th width="5%">#</th>
                  <th width="25%">Product</th>
                  <th width="5%">Image</th>
                  <th width="10%">Model</th>
                  <th width="10%">Brand</th>
                  <th width="15%">Quantity</th>
                  <th width="15%">Unit Price</th>
                  <th width="10%">Total Price</th>
                  <th width="5%"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center">1</td>
                  <td class="name">
                    <input type="hidden" name="product_id[]" value="" class="product_id">
                    <input type="text" name="product_name[]" placeholder="Product Name" class="order_input">
                  </td>
                  <td class="text-center img">
                    <!-- <img src="/ourwork/img/product_image/default@1598295452.jpg" class="order_product_img"> -->
                    <img src="#" class="order_product_img">
                  </td>
                  <td class="model">Model</td>
                  <td class="brand">Brand</td>
                  <td class="quantity">
                    <input type="text" name="quantity[]" placeholder="Quantity" class="order_input">
                  </td>
                  <td class="unit_price">
                    <input type="text" name="unit_price[]" placeholder="Unit Price" class="order_input">
                  </td>
                  <td class="total_price">
                    <input type="text" name="total_price[]" placeholder="Total Price" class="order_input">
                  </td>
                  <td class="text-center">
                    <img src="/ourwork/img/icon/delete-icon.png" class="delet-icon" onclick="remove_order_list(this, event)">
                  </td>
                </tr>
                <!-- Dynamic Items Placed Here -->
              </tbody>
            </table>
            <div class="col-md-12" style="margin-top: 10px;">
              <button type="button" class="btn btn-outline-default btn-sm" onclick="sale_row_add()">Add Row</button>
            </div>            
            <div class="col-md-12" style="margin-top: 40px;">
              <div class="po_summary">
                <div class="k-control">
                  <div class="k-label">Sub Total:</div>
                  <input type="text" class="k-field allowNumbersOnly" name="sub_total" id="sub_total" value="0.00" placeholder="Sub Total" required>
                </div>
                <div class="k-control">
                  <div class="k-label">VAT:</div>
                  <div class="k-field-vat"><input type="text" name="vat_percent" id="vat_percent" class="order_input_vat allowNumbersOnly" value="5" placeholder="Vat Percent" required>&nbsp;%</div>
                </div>
                <div class="k-control">
                  <div class="k-label">VAT Amount:</div>
                  <input type="text" class="k-field allowNumbersOnly" id="vat_amount" name="vat_amount" value="0.00" placeholder="Vat Amount" required>
                </div>
                <div class="k-control">
                  <div class="k-label">Grand Total:</div>
                  <input class="k-field" required name="grand_total" id="grand_total" value="0.00" placeholder="Grand Total">
                </div>
                <div class="k-control">
                  <div class="k-label">Customer Paid:</div>
                  <input class="k-field" required name="customer_paid" id="customer_paid" value="0.00" placeholder="Customer Paid">
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
