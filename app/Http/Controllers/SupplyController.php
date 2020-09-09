<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;//it write kallol
use Redirect;//it write kallol
use DB;//it write kallol

class SupplyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function supplier_info_entry()
  { 
    return view('supply.supplier_info_entry');
  }
  public function supplier_save(Request $request)
  { 
		$data = array();
    $data['supplier_name'] = "";
    $data['phone'] = "";
    $data['address'] = "";
    $data['comments'] = "";
    $data['supplier_entry_date'] = "";
    $data['entry_by'] = Auth::user()->email;;
    $data['created_at'] = "";

    
    // $orgDate = $request->supplier_entry_date;
    // $changeSeparator = str_replace('/', '-', $orgDate);  
    // $newDate = date("Y-m-d", strtotime($changeSeparator));
    $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->supplier_entry_date)));

    $data['supplier_name'] = $request->supplier_name;
    $data['phone'] = $request->phone;
    $data['address'] = $request->address;
    $data['comments'] = $request->comments;
    // $data['supplier_entry_date'] = $request->supplier_entry_date;
    $data['supplier_entry_date'] = $newDate;
    $data['created_at'] = date('Y-m-d H:i:s');

    DB::table('supplier')
                  ->insert($data);

    Session::put('sucMsg', 'New Supplier Information Saved Successfully!');
		return Redirect::to('/supplier/view');
  }
  public function supplier_view() {
  	$supplier_info = DB::table('supplier')
                ->orderBy('supplier_id', 'desc')               
                ->get();
      return view('supply.supplier_info_lists')->with('supplier_info', $supplier_info);
  }
}
