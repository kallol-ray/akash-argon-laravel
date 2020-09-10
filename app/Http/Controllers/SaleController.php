<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;//it write kallol
use Redirect;//it write kallol
use DB;//it write kallol

class SaleController extends Controller
{
	public function __construct()
  {
    $this->middleware('auth');
  }
  public function order_entry(){
  	$customer_info = DB::table('customer')
  							->select('customer_name','phone')
                ->orderBy('customer_id', 'desc')
                ->get();
  	return view('sale.sale_order')
  			->with('customer_info', $customer_info);
  }
	public function order_view(){
		echo "In view";
	}
	public function order_save(){
		echo "In save";
	}
}
