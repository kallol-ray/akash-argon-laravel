@extends('layouts.app',['title' => 'Product Purchase Order'])
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
	    	<h2 class="text-center">Product Purchase Order</h2>
	    	
	    	
	    	<table border="1px" class="pdt_list_tbl">
					<tr>
						<th>PO Number</th>
						<th>Supplier Name</th>
						<th>Supplier Cost</th>
						<th>Company Cost</th>
						<th>Product Cost</th>
						<th>Vat</th>
						<th>Total</th>
						<th>Is Stored</th>
						<th width="182px">Action</th>
						<!-- <th width="80px">Delete</th> -->
					</tr>
					@foreach ($purchase_order_info as $purchase)
					  <tr data-id="{{ $purchase->po_info_id  }}">
							<!-- <td scope="row" class="tbl_sl">{{ $loop->iteration }}</td> -->
							<!-- <td class="tbl_date">{{ date("d/m/Y", strtotime(str_replace('-', '/',  $purchase->purchased_date))) }}</td> -->
							<td class="tbl_date">{{ $purchase->auto_invoice_no }}</td>
							<td class="tbl_supplier" date="{{ $purchase->supplier_id }}">{{ $spplierArr[$purchase->supplier_id] }}</td>
							<td class="tbl_qty">{{ $purchase->supplier_adnl_cost }}</td>
							<td class="tbl_qty">{{ $purchase->buyer_adnl_cost }}</td>
							<td class="tbl_total_bill">{{ $purchase->sub_total }}</td>
							<td class="tbl_vat">{{ $purchase->vat_amount }}</td>
							<td class="tbl_discount">{{ $purchase->grand_total }}</td>
							<td class="tbl_brand" data="{{ $purchase->is_stored }}">
								@if ($purchase->is_stored == 0)
									No
								@else
								  Yes
								@endif
							</td>
							<td>
								<button class="btn-outline-primary" onclick="order_details('{{ $purchase->auto_invoice_no }}', '{{ $purchase->po_info_id }}')">Details</button>
								@if ($purchase->is_stored == 0)
									<a class="btn-outline-success" href="/product/purchase_order/update/{{ $purchase->po_info_id  }}">Edit</a>
									<br>
									<a class="btn-outline-success" href="/product/purchase_order/stop_entry/{{ $purchase->po_info_id  }}">Start Stock Entry</a>
								@endif							
							</td>
						</tr>
					@endforeach
				</table>
	    </div>
	  </div>
	  @include('layouts.footers.auth')
	</div>
@endsection