@extends('layouts.app',['title' => 'Customer List View'])
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
	    <div class="col-md-12 customer-entry-from">	    	
	    	<h2 class="text-center">Customer List View</h2>
	    	<table border="1px" class="pdt_list_tbl">
					<tr>
						<th>SN</th>
						<th>Customer Name</th>
						<th>Phone Number</th>
						<th>Company</th>
						<th>Address</th>
						<th>Entry Date</th>
						<th>Entry By</th>
						<th width="70px">Edit</th>
						<th width="80px">Delete</th>
					</tr>
					@foreach ($customer_info as $customer)
					  <tr data-id="{{ $customer->customer_id }}">
							<td scope="row" class="tbl_sl">{{ $loop->iteration }}</td>
							<td class="tbl_title">{{ $customer->customer_name }}</td>
							<td class="tbl_desc">{{ $customer->phone }}</td>
							<td class="tbl_title">{{ $customer->company_name }}</td>							
							<td class="tbl_model">{{ $customer->address }}</td>
							<td class="tbl_entry_date">{{ date("d/m/Y", strtotime(str_replace('-', '/',  $customer->created_at))) }}</td>
							<td class="tbl_entry_by">{{ $customer->entry_by }}</td>
							<td>
								<a class="btn btn-outline-success" href="/customer/update/{{ $customer->customer_id }}">Edit</a>
							</td>
							<td>
								{!! Form::open(['url' => 'customer/delete', 'method' => 'post']) !!}									
									<input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">
									<button type="submit" name="deleteBtn" value="Delete" class="btn btn-outline-danger">Delete</button>
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