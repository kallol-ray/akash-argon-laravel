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
	    	<h2 class="text-center">Product Purchase History List</h2>
	    	<table border="1px" class="pdt_list_tbl">
					<tr>
						<th>SN</th>
						<th>Buy Date</th>
						<th>Stored</th>
						<th>Product</th>
						<th>Invoice No</th>
						<th>Barcode</th>
						<th>Buy Price</th>						
						<th>Entry By</th>
						<!-- <th width="70px">Edit</th>
						<th width="80px">Delete</th> -->
					</tr>
					@foreach ($pp_history as $single_product)
					  <tr data-id="{{ $single_product->pp_history_id  }}">
							<td scope="row" class="tbl_sl">{{ $loop->iteration }}</td>
							<td class="tbl_date">{{ date("d/m/Y", strtotime(str_replace('-', '/',  $single_product->buy_date))) }}</td>
							<td class="tbl_brand" data="{{ $single_product->is_stored }}">
								@if ($single_product->is_stored == 0)
									No
								@else
								  Yes
								@endif
							</td>

							<td class="tbl_supplier" date="{{ $single_product->product_info_id }}">{{ $productArr[$single_product->product_info_id] }}</td>							
							
							<td class="tbl_qty">{{ $single_product->barcode }}</td>
							<td class="tbl_total_bill">{{ $single_product->buy_price }}</td>
							<td class="tbl_entry_by">{{ $single_product->entry_by }}</td>							
						</tr>
					@endforeach
				</table>
	    </div>
	  </div>
	</div>
@endsection