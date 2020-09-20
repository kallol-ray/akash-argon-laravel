@extends('layouts.app',['title' => 'Sale Order View'])
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
			<div class="col-md-12 sale-search">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group m0">
		          <label for="">Sale Invoice (SOI)</label>
		          <input type="text" class="form-control" id="search_sale_invoice" name="search_sale_invoice" placeholder="SOI-00000">
		        </div>
		  		</div>
		  		<div class="col-md-6">
		  			<div class="form-group m0">
		          <label for="sale_order_status">Status</label>
		          <select class="form-control" id="sale_order_status" name="sale_order_status">
		            <option value="">Select one...</option>
		            <option value="0">Processing</option>
		            <option value="1">Complete</option>
		          </select>
		        </div>
		  		</div>
					
				</div>
			</div>
		</div>
	  <div class="row">
	    <!-- <h2 class="text-center">Sale Order View</h2> -->
	    <div class="col-md-12 sale-order-tbl">	    		    	
	    	<table border="1px" class="pdt_list_tbl">
					<tr>
						<!-- <th>SN</th> -->
						<th width="100px">Invoice</th>
						<th>Customer Name</th>
						<!-- <th>Company</th> -->
						<th>Total</th>
						<th>Sale Date</th>
						<th width="433px">Action</th>
					</tr>
					@foreach ($sale_info as $sale)
					  <tr data-id="{{ $sale->sale_info_id }}">
							<!-- <td scope="row" class="tbl_sl">{{ $loop->iteration }}</td> -->
							<td class="">{{ $sale->auto_sale_invoice }}</td>
							<td class="">
									{{ $customer_info_arr[$sale->customer_id] }}								
							</td>
							<!-- <td class="">{{ $sale->customer_id }}</td>							 -->
							<td class="">{{ $sale->sub_total_bill }}</td>
							<td class="">{{ date("d/m/Y", strtotime(str_replace('-', '/',  $sale->saled_date))) }}</td>
							<!-- <td>
								<a class="btn btn-outline-success" href="/customer/update/{{ $sale->customer_id }}">Edit</a>
							</td> -->
							<td>
								<button class="btn btn-outline-info btn-sm" onclick="print_invoice('{{ $sale->sale_info_id }}','{{ $sale->auto_sale_invoice }}')">Print Invoice</button>

								<button class="btn btn-outline-success btn-sm" onclick="complete_order('{{ $sale->sale_info_id }}','{{ $sale->auto_sale_invoice }}')">Make Complete</button>

								<button class="btn btn-outline-primary btn-sm" onclick="sale_order_details('{{ $sale->sale_info_id }}','{{ $sale->auto_sale_invoice }}')">Details</button>

								<button class="btn btn-outline-default btn-sm" onclick="update_sale_order('{{ $sale->sale_info_id }}','{{ $sale->auto_sale_invoice }}')">Edit</button>

								<button class="btn btn-outline-danger btn-sm" onclick="cancel_sale_order('{{ $sale->sale_info_id }}','{{ $sale->auto_sale_invoice }}')">Cancel</button>

								{!! Form::open(['url' => 'customer/delete', 'method' => 'post']) !!}									
									<!-- <input type="hidden" name="customer_id" value="{{ $sale->customer_id }}">
									<button type="submit" name="deleteBtn" value="Delete" class="btn btn-outline-danger">Delete</button> -->
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</table>
	    </div>
	  </div>
	  @include('layouts.footers.auth') 
	</div>
	
@endsection