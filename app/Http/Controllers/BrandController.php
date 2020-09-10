<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;//it write kallol
use Redirect;//it write kallol
use DB;//it write kallol

class BrandController extends Controller
{
	public function __construct()
  {
      $this->middleware('auth');
  }
  public function brand_entry_form() {
  	$brand_info = DB::table('brand')
  							->orderBy('brand_id', 'desc')
                ->get();
  	return view('supply.brand')
  					->with("brand_info", $brand_info);
  }
  public function brand_save(Request $req) {
  	$data = array();
  	$data['brand_name'] = $req->brand_name;
  	$data['entry_by'] = Auth::user()->email;
  	$data['created_at'] = date('Y-m-d H:i:s');
  	DB::table('brand')
  							->insert($data);
  	$brand_info = DB::table('brand')
  							->orderBy('brand_id', 'desc')
                ->get();
  	return view('supply.brand')
  					->with("brand_info", $brand_info);
  }
}
