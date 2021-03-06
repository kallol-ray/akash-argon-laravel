@extends('layouts.app',['title' => 'Product Purchase Order Update'])
@section('content')

  <div class="container-fluid product-entry">
    <div class="row">
      <div class="col-md-12">
        {!! Form::open(['url' => 'product/purchase_order/update', 'method' => 'post', 'class'=> 'form-horizontal', 'autocomplete' => 'off']) !!}
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="purchased_date_update">Date</label>
                <input type="text" class="form-control" id="purchased_date_update" name="purchased_date" placeholder="dd/mm/yyyy" value='{{ date("d/m/Y", strtotime(str_replace("-", "/",  $purchase[0]->purchased_date))) }}'>
              </div>
              <div class="form-group">
                <label for="supplier_id">Supplier Name</label>
                <select class="form-control" id="supplier_id" name="supplier_id">
                  <option value="">Select one..</option>
                  @foreach($supplier_info as $supplier)
                    <option value="{{ $supplier->supplier_id }}"
                      @if($supplier->supplier_id == $purchase[0]->supplier_id)
                        selected
                      @endif
                    >{{ $supplier->supplier_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="buyer_addtional_costs">Buyer Additional Costs</label>
                <input type="text" class="form-control allowNumbersOnly" id="buyer_addtional_costs" name="buyer_addtional_costs" placeholder="Buyer Additional Costs" value="{{ $purchase[0]->buyer_adnl_cost }}">
              </div>
              <div class="form-group">
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
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="supplier_additional_cost">Supplier Additional Costs</label>
                <input type="text" class="form-control allowNumbersOnly" id="supplier_additional_cost" name="supplier_additional_cost" placeholder="Supplier Additional Costs" value="{{ $purchase[0]->supplier_adnl_cost }}">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="purchase_invoice_no">Purchase Invoice Number</label>
                <input type="text" class="form-control" id="purchase_invoice_no" name="purchase_invoice_no" placeholder="Purchase Invoice Number" value="{{ $purchase[0]->purchase_invoice_no }}">
              </div>
            </div>
            <div class="col-md-12">
              <table class="order_entry_tbl" id="order_entry_item">
                <thead>
                  <tr>
                    <th width="50px">IMG</th>
                    <!-- <th width="200px">SKU</th> -->
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
                  @foreach($po_info_item as $items)
                    <tr class="itemRow" data-product-info-id="{{ $items->product_info_id }}" update="yes">
                      <td align="center"><img src="/ourwork/img/product_image/{{ $items->image }}" class="order_product_img"></td>
                      <td>{{ $productArr[$items->product_info_id] }}</td>
                      <td>
                        <input type="hidden" name="product_info_id[]" value="{{ $items->product_info_id }}">
                        <input type="hidden" name="image[]" value="{{ $items->image }}">

                        <!-- pattern="[0-9]+([.,][0-9]+)?" -->
                        <input type="text" name="quantity[]" id="qty_{{ $loop->iteration - 1 }}" step="1" required placeholder="Quantity" class="order_input inp_quantity allowNumbersOnly" min="1" value="{{ $items->product_qty }}">
                      </td>
                      <td><input type="text" name="unit_price[]" id="purchaseprice_{{ $loop->iteration - 1 }}" onblur="setpurchasePrice({{$loop->iteration - 1}}, this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="1" required placeholder="Unit Price" class="order_input inp_unit_price allowNumbersOnly" value="{{ $items->unit_price }}"></td>
                      <td><input type="text" name="additional_price[]" id="withadditional_{{ $loop->iteration - 1 }}" class="order_input inp_additional_price allowNumbersOnly" placeholder="Additional Price" value="{{ $items->unit_adnl_price }}" required readonly></td>
                      <td><input type="text" name="sale_price[]" class="order_input inp_sale_price allowNumbersOnly" placeholder="Sale Price" required value="{{ $items->sale_price }}"></td>
                      <td><input type="text" name="total_price[]" id="total_{{ $loop->iteration - 1 }}" class="order_input inp_total_price allowNumbersOnly" placeholder="Total Price" value="{{ $items->total_price }}" required readonly></td>
                      <td align="center"><img src="/ourwork/img/icon/delete-icon.png" class="delet-icon" onclick="remove_list(this, event)"></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="col-md-12" style="margin-top: 50px;">
              <div class="payment-part">
                <div class="">
                  <div class="form-group">
                    <label for="paid_or_due">Payment Type</label>
                    <select class="form-control" id="paid_or_due" name="paid_or_due">
                      <option value="">Select one..</option>
                      <option value="0"
                        @if($purchase[0]->paid_or_due == '0')
                          selected
                        @endif
                      >Partial Payment</option>
                      <option value="1"
                        @if($purchase[0]->paid_or_due == '1')
                          selected
                        @endif
                      >Full Due</option>
                      <option value="2"
                        @if($purchase[0]->paid_or_due == '2')
                          selected
                        @endif
                      >Full Paid</option>
                    </select>
                  </div>
                </div>
                <div class="" style="width: 40%; float: left;">
                  <div class="form-group">
                    <label for="paid_amount">Supplier Paid Amount</label>
                    <input type="text" class="form-control allowNumbersOnly" id="paid_amount" name="paid_amount" placeholder="Supplier Paid Amount" value="{{ $purchase[0]->paid_amount }}">
                  </div>
                </div>
                <div class="" style="width: 40%; float: left; margin-left: 20%;">
                  <div class="form-group">
                    <label for="paid_amount">Supplier Due Amount</label>
                    <input type="text" class="form-control allowNumbersOnly" id="due_amount" name="due_amount" placeholder="Supplier Due Amount" value="{{ $purchase[0]->due_amount }}">
                  </div>
                </div>
              </div>
              <div class="po_summary">
                <div class="k-control">
                  <div class="k-label">Product Value:</div>
                  <input type="text" class="k-field allowNumbersOnly" name="sub_total" id="sub_total" placeholder="Sub Total" value="{{ $purchase[0]->sub_total }}" required readonly>
                </div>
                <div class="k-control">
                  <div class="k-label">VAT:</div>
                  <div class="k-field-vat"><input type="text" name="vat_percent" id="vat_percent" class="order_input_vat allowNumbersOnly" placeholder="Vat Percent" value="{{ $purchase[0]->vat_percent }}" onblur="calculateTotal()" required>&nbsp;%</div>
                </div>
                <div class="k-control">
                  <div class="k-label">VAT Amount:</div>
                  <input type="text" class="k-field allowNumbersOnly" id="vat_amount" name="vat_amount" placeholder="Vat Amount" value="{{ $purchase[0]->vat_amount }}" required readonly>
                </div>
                <div class="k-control">
                  <div class="k-label">Supplier Cost:</div>
                  <div class="k-field" id="suppliercost_final">{{ $purchase[0]->supplier_adnl_cost }}</div>
                </div>
                <div class="k-control">
                  <div class="k-label">Company Cost:</div>
                  <div class="k-field" id="companycost_final">{{ $purchase[0]->buyer_adnl_cost }}</div>
                </div>
                <div class="k-control">
                  <div class="k-label">Grand Total:</div>
                  <input class="k-field" name="grand_total" id="grand_total"  placeholder="Grand Total" value="{{ $purchase[0]->grand_total }}" required readonly>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group subres">
                <input type="hidden" name="po_info_id" id="po_info_id" value="{{ $purchase[0]->po_info_id }}">
                <input type="hidden" name="auto_invoice_no" id="auto_invoice_no" value="{{ $purchase[0]->auto_invoice_no }}">
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