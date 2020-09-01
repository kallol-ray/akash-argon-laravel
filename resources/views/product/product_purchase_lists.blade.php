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
	    <div class="col-md-12">	    	
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
							<td class="tbl_discount">{{ $purchase->grand_total }}</td><!-- 
							<td class="tbl_paid_or_due" data="{{ $purchase->paid_or_due }}">
								@if ($purchase->paid_or_due == 0)
									Partial Paid
								@elseif($purchase->paid_or_due == 1)
									Full Due
								@else
								  Full Paid
								@endif
							</td> -->
							<!-- <td class="tbl_brand">{{ $purchase->paid_amount }}</td>
							<td class="tbl_brand">{{ $purchase->due_amount }}</td> -->
							<!-- <td class="tbl_brand" data="{{ $purchase->is_stored }}">
								@if ($purchase->is_stored == 0)
									No
								@else
								  Yes
								@endif
							</td>
							<td class="tbl_entry_by">{{ $purchase->entry_by }}</td> -->
							<td>
								<button class="btn btn-outline-primary">Details</button>
								<a class="btn btn-outline-success" href="/product/purchase_order/update/{{ $purchase->po_info_id  }}">Edit</a>
							</td>
							<!-- <td> -->
								<!-- {!! Form::open(['url' => 'product/purchase_order/delete', 'method' => 'post']) !!}
									<input type="hidden" name="po_info_id" value="{{ $purchase->po_info_id  }}">
									<button type="submit" name="deleteBtn" value="Delete" class="btn btn-outline-danger">Delete</button> -->
								<!-- {!! Form::close() !!} -->
							<!-- </td> -->
						</tr>
					@endforeach
				</table>
	    </div>
	  </div>
	</div>
@endsection