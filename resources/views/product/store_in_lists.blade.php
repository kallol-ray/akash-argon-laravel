@extends('layouts.app',['title' => 'Product Purchase and Stock List'])
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
	<div class="container-fluid product-view">
	  <div class="row">
	    <div class="col-md-12 product-in">	    	
	    	<h2 class="text-center" style="margin-bottom: 40px;">Purchase and Stock History</h2>
	    	<div class="row" style="height: 185px;">
	    		<div class="col-md-3">
		    		<div class="form-group">
		    			<label for="auto_history_invoice_stock">Invoice No</label>
				      <select id="auto_history_invoice_stock" class="form-control" autocomplete="off">
				        <option value="">Select one...</option>
				        @foreach ($pp_invoice as $invoive)
									<option value="{{ $invoive->auto_invoice_no }}">{{ $invoive->auto_invoice_no }} ({{ date("d/m/Y", strtotime(str_replace('-', '/',  $invoive->buy_date)))}})</option>
								@endforeach
				      </select>
		    		</div>
		    		<div id="total_qty_no">Total Quantity: xxx</div>
			    </div>
			    <div class="col-md-9" style="padding-right: 30px;">
			    	<div class="row" style="border: 2px solid gray; border-radius: 3px;padding: 8px 0px;background-color: #e8e8e8;" id="poi-info">
			    		<div class="col-md-3">Purchase Invoice</div>
			    		<div class="col-md-4">xxx</div>
			    		<div class="col-md-3">Subtotal Cost</div>
			    		<div class="col-md-2">0.00</div>

			    		<div class="col-md-3">Buyer Add. Cost</div>
			    		<div class="col-md-4">0.00</div>
			    		<div class="col-md-3">Vat Amount (x%)</div>
			    		<div class="col-md-2">0.00</div>

			    		<div class="col-md-3">Supplier Add. Cost</div>
			    		<div class="col-md-4">0.00</div>
			    		<div class="col-md-3">Grand Total</div>
			    		<div class="col-md-2">0.00</div>

			    		<div class="col-md-3">Payment Status</div>
			    		<div class="col-md-4">xxx</div>
			    		<div class="col-md-3">Due Amount</div>
			    		<div class="col-md-2">0.00</div>

			    		<div class="col-md-3">Supplier</div>
			    		<div class="col-md-4">xxx</div>
			    		<div class="col-md-3">Paid Amount</div>
			    		<div class="col-md-2">0.00</div>

			    		<div class="col-md-3">Buy Date</div>
			    		<div class="col-md-4">xx/xx/xxxx</div>
			    		<div class="col-md-3">Is Stored</div>
			    		<div class="col-md-2">xxx</div>
			    	</div>
			    </div>
	    	</div>
	    	<table id="stock_history_tbl" border="1px" class="pdt_list_tbl">
	    		<thead>
						<tr>
							<th>SN</th>
							<th>Product</th>
							<th width="60px">Image</th>
							<th>Brand</th>
							<th>Model</th>
							<th width="50px">Qty</th>
							<th><abbr title="Unit Price">UP</abbr></th>
							<th><abbr title="Additional Price">AP</abbr></th>
							<th><abbr title="Sale Price">SP</abbr></th>
							<th><abbr title="Total Price of this Item">TPI</abbr></th>
							<th width="69px">Action</th>
						</tr>
	    		</thead>
	    		<tbody>
						
					</tbody>
				</table>
	    </div>
	  </div>
	  @include('layouts.footers.auth')
	</div>
@endsection