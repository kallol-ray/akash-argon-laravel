<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;//it write kallol
use Redirect;//it write kallol
use DB;//it write kallol

class CustomerController extends Controller
{
	public function __construct()
  {
    $this->middleware('auth');
  }

  public function ready_entry()
  {
  	return view('customer.customer_entry');	
  }
  public function save_entry(Request $req)
  {
  	$data = array();
  	$customer_name	= $req->customer_name;
  	$company_name 	= $req->company_name;
  	$phone					= $req->phone;
  	$address				= $req->address;
  	if($company_name == null) {
  		$company_name = "N/A";
  	}
  	if($address == null) {
  		$address = "N/A";
  	}
  	$data['customer_name'] = $customer_name;
  	$data['company_name'] = $company_name;
  	$data['phone'] = $phone;
  	$data['address'] = $address;
  	$data['entry_by'] = Auth::user()->email;
  	$data['created_at'] = date('Y-m-d H:i:s');
  	// echo "<pre>";
  	// 	var_dump($data);
  	// echo "</pre>";

  	DB::table('customer')->insert($data);
    Session::put('sucMsg', 'New Customer Saved Successfully!');
    if(isset($req->fromWhere)) {
      return Redirect::to('/order_place/entry');
    } else {
      return Redirect::to('/customer/view');
    // return view('customer.customer_entry');
    }
    
  }
  public function view_entry()
  {
  	
  	$customer_info = DB::table('customer')
                ->orderBy('customer_id', 'desc')
                ->get();
    
    return view('customer.customer_lists')
    				->with('customer_info', $customer_info);
  }
  function customer_update_process(Request $req) {
    $customer_id = $req->customer_id;
    $customer_info = DB::table('customer')
                ->where('customer_id', $customer_id)
                ->get();
    
    return view('customer.customer_update')
            ->with('customer_info', $customer_info);
  }
  function customer_update(Request $req) {
    $customer_id = $req->update_id;
    $data = array();
    $customer_name = $req->customer_name;
    $phone = $req->phone;
    $company_name = $req->company_name;
    $address = $req->address;

    $data['customer_name'] = $customer_name;
    $data['phone'] = $phone;
    $data['company_name'] = $company_name;
    $data['address'] = $address;

    $customer_info = DB::table('customer')
                ->where('customer_id', $customer_id)
                ->update($data);
    
    Session::put('sucMsg', 'A Customer Updated Successfully!');
    return redirect('/customer/view');
  }
}
