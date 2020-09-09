@extends('layouts.app',['title' => 'Product Purchase History List'])
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
	    <div class="col-md-12">	    	
	    	<h2 class="text-center">Stock History List</h2>
	    	<div class="form-group col-md-4 paddingLR0">
		      <label for="auto_history_invoice_stock">Invoice No</label>
		      <select id="auto_history_invoice_stock" class="form-control">
		        <option value="">Select one...</option>
		        @foreach ($pp_invoice as $invoive)
							<option value="{{ $invoive->auto_invoice_no }}">{{ $invoive->auto_invoice_no }} ({{ date("d/m/Y", strtotime(str_replace('-', '/',  $invoive->buy_date)))}})</option>
						@endforeach
		      </select>
		    </div>
		    <div class="form-group col-md-4">
		    	
		    </div>
	    	<table id="stock_history_tbl" border="1px" class="pdt_list_tbl">
	    		<thead>
						<tr>
							<th>SN</th>
							<th>Buy Date</th>
							<th>Product</th>
							<th>Image</th>
							<th>Invoice No</th>
							<th>Barcode</th>
							<th>Buy Price</th>						
							<th>Sale Price</th>						
							<th>Entry By</th>
						</tr>
	    		</thead>
	    		<tbody>
						@foreach ($pp_history as $single_product)
							<tr data-id="{{ $single_product->pp_history_id }}">
								<td scope="row" class="tbl_sl">{{ $loop->iteration }}</td>
								<td>{{ date("d/m/Y", strtotime(str_replace('-', '/',  $single_product->buy_date))) }}</td>
								<td>{{ $productArr[$single_product->product_info_id] }}</td>
								<td></td>
								<td>{{ $single_product->auto_invoice_no }}</td>
								<td>{{ $single_product->barcode }}</td>
								<td>{{ $single_product->buy_price }}</td>
								<td>{{ $single_product->sale_price }}</td>
								<td>{{ $single_product->entry_by }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
	    </div>
	  </div>
	</div>
@endsection