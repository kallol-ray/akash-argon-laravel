@extends('layouts.app',['title' => 'Product Purchase Entry'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'product/purchase_order/entry', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'form-horizontal']) !!}
          <div class="row">
            <div class="col-md-4 pL0">
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
                <label for="product_info_id">Product List</label>
                <select class="form-control" id="product_info_id" name="product_info_id">
                  <option value="">Select one..</option>
                  @foreach($product_info as $product)
                    <option value="{{ $product->product_info_id }}" title="{{ $product->title }}" image="{{ $product->image }}">{{ $product->title }}</option>
                  @endforeach
                </select>
                <label id="product_list_err"></label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="buyer_addtional_costs">Buyer Additional Costs</label>
                <input type="text" class="form-control allowNumbersOnly" id="buyer_addtional_costs" name="buyer_addtional_costs" placeholder="Buyer Additional Costs" value="0">
              </div>
              <div class="form-group">
                <label for="supplier_additional_cost">Supplier Additional Costs</label>
                <input type="text" class="form-control allowNumbersOnly" id="supplier_additional_cost" name="supplier_additional_cost" placeholder="Supplier Additional Costs" value="0">
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
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="purchase_invoice_no">Purchase Invoice Number</label>
                <input type="text" class="form-control" id="purchase_invoice_no" name="purchase_invoice_no" placeholder="Purchase Invoice Number" value="N/A">
              </div>
              <div class="form-group">
                <label for="paid_amount">Supplier Paid Amount</label>
                <input type="text" class="form-control allowNumbersOnly" id="paid_amount" name="paid_amount" placeholder="Supplier Paid Amount" value="0">
              </div>
              <div class="form-group">
                <label for="paid_amount">Supplier Due Amount</label>
                <input type="text" class="form-control allowNumbersOnly" id="due_amount" name="due_amount" placeholder="Supplier Due Amount" value="0">
              </div>
            </div>
            <table class="order_entry_tbl" id="order_entry_item">
              <thead>
                <tr>
                  <th width="50px">IMG</th>
                  <th width="200px">SKU</th>
                  <th width="200px">Product Title</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Unit Price<br>(Additional)</th>
                  <th>Sale Price</th>
                  <th>Total Price</th>
                  <th width="70px">#</th>
                </tr>
              </thead>
              <tbody>
                <!-- Dynamic Items Placed Here -->
              </tbody>
            </table>
            <div class="col-md-12" style="margin-top: 50px;">
              <div class="po_summary">
                <div class="k-control">
                  <div class="k-label">Product Value:</div>
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
                  <div class="k-label">Supplier Cost:</div>
                  <div class="k-field" id="suppliercost_final">0.00</div>
                </div>
                <div class="k-control">
                  <div class="k-label">Company Cost:</div>
                  <div class="k-field" id="companycost_final">0.00</div>
                </div>
                <div class="k-control">
                  <div class="k-label">Grand Total:</div>
                  <input class="k-field" required name="grand_total" id="grand_total" value="0.00" placeholder="Grand Total">
                </div>
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
