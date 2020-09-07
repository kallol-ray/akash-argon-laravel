@extends('layouts.app',['title' => 'Product List View'])
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
	    	<h2 class="text-center">Product Lists</h2>
	    	<table border="1px" class="pdt_list_tbl">
					<tr>
						<th>SN</th>
						<th>Title</th>
						<th>Details</th>
						<th>Model</th>
						<th>Brand</th>
						<th>Image</th>
						<th>Entry Date</th>
						<th>Entry/Update By</th>
						<th width="70px">Edit</th>
						<th width="80px">Delete</th>
					</tr>
					@foreach ($product_info as $product)
					  <tr data-id="{{ $product->product_info_id }}">
							<td scope="row" class="tbl_sl">{{ $loop->iteration }}</td>
							<td class="tbl_title">{{ $product->title }}</td>
							<td class="tbl_desc">{{ $product->description }}</td>
							<td class="tbl_model">{{ $product->model }}</td>
							<td class="tbl_brand">{{ $product->brand }}</td>
							<td class="tbl_image">
								<img src="/ourwork/img/product_image/{{ $product->image }}" class="pdt_lists_img" img-name="{{ $product->image }}" alt="Not Found" />
							</td>
							<td class="tbl_entry_date">{{ date("d/m/Y", strtotime(str_replace('-', '/',  $product->info_entry_date))) }}</td>
							<td class="tbl_entry_by">
								{{ $product->entry_by }}
								<hr class="tbl_hr">
								@if($product->updated_by == "")
									Not Updated
								@else
									{{ $product->updated_by }}
								@endif								
							</td>
							<td>
								<a class="btn btn-outline-success" href="/product/update/{{ $product->product_info_id }}">Edit</a>
							</td>
							<td>
								{!! Form::open(['url' => 'product/entry/delete', 'method' => 'post']) !!}
									<input type="hidden" name="image_del_path" value="ourwork/img/product_image/{{ $product->image }}">
									<input type="hidden" name="product_del_id" value="{{ $product->product_info_id }}">
									<button type="submit" name="deleteBtn" value="Delete" class="btn btn-outline-danger">Delete</button>
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
				</table>
	    </div>
	  </div>
	</div>
@endsection