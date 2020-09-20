@extends('layouts.app',['title' => 'Product View'])
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
	    <div class="col-md-12 supply-entry-form">	    	
	    	<h2 class="text-center">Product Supplier List</h2>
	    	<table border="1px" class="pdt_list_tbl">
					<tr>
						<th>SN</th>
						<th>Supplier Name</th>
						<th>Phone No</th>
						<th>Address</th>						
						<th>Comments</th>
						<th>Entry Date</th>
						<th>Entry By</th>
						<th width="70px">Edit</th>
						<th width="80px">Delete</th>
					</tr>
					@foreach ($supplier_info as $supplier)
					  <tr data-id="{{ $supplier->supplier_id }}">
							<td scope="row" class="tbl_sl">{{ $loop->iteration }}</td>
							<td class="tbl_title">{{ $supplier->supplier_name }}</td>
							<td class="tbl_title">{{ $supplier->phone }}</td>
							<td class="tbl_desc">{{ $supplier->address }}</td>
							<td class="tbl_model">{{ $supplier->comments }}</td>
							<td class="tbl_entry_date">{{ date("d/m/Y", strtotime(str_replace('-', '/',  $supplier->supplier_entry_date))) }}</td>
							<td class="tbl_entry_by">{{ $supplier->entry_by }}</td>
							<td>
								<a class="btn btn-outline-success" href="/supplier/update/{{ $supplier->supplier_id }}">Edit</a>
							</td>
							<td>
								{!! Form::open(['url' => 'supplier/delete', 'method' => 'post']) !!}									
									<input type="hidden" name="product_del_id" value="{{ $supplier->supplier_id }}">
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