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
  							->select('customer_id','customer_name','phone')
                ->orderBy('customer_id', 'desc')
                ->get();
  	return view('sale.sale_order')
  			->with('customer_info', $customer_info);
  }
	public function order_view(){
		// echo "In view";
    $sale_info = DB::table('sale_info')
                ->select('sale_info_id','auto_sale_invoice','customer_id', 'sub_total_bill', 'saled_date', 'is_delivered')
                ->where('is_delivered', '0')
                ->orderBy('sale_info_id', 'desc')
                ->get();
    
    $customer_info_id = array();
    foreach($sale_info as $info) {
      array_push($customer_info_id, $info->customer_id);
    }
    $customer_info = DB::table('customer')
                ->select('customer_id','customer_name','company_name')
                ->whereIn('customer_id', $customer_info_id)
                ->get();

    $customer_info_arr = array();
    foreach($customer_info as $cinfo) {
      // $newarr = array();
      // $newarr['customer_name'] = $cinfo->customer_name;
      // $newarr['company_name'] = $cinfo->company_name;
      // $customer_info_arr[$cinfo->customer_id] = $newarr;
      $customer_info_arr[$cinfo->customer_id] = $cinfo->customer_name;
    }
    // echo "<pre>";
    // var_dump($customer_info_arr);
    // echo "</pre>";

    return view('sale.sale_order_list')
        ->with('sale_info', $sale_info)
        ->with('customer_info_arr', $customer_info_arr);
	}
	public function order_save(Request $req){
    $saleInfo = array();
    $saleItem = array();
    $auto_sale_invoice = DB::table('sale_info')
                 ->max('auto_sale_invoice');
    // echo "<pre>";
    // var_dump($auto_sale_invoice);
    // echo "</pre>";
    if($auto_sale_invoice == NULL) {
      $new_invoice_no = "SOI-100001";
    } else {
      $new_invoice_no = "SOI-". (preg_replace('/[^0-9]/', '', $auto_sale_invoice) + 1);
    }
    $customer_id = $req->customer_id;
    $sub_total = $req->sub_total;
    $vat_percent = $req->vat_percent;
    $vat_amount = $req->vat_amount;
    $discount = $req->discount;

    $paid_or_due = $req->paid_or_due;
    $paid_amount = $req->paid_amount;
    $due_amount = $req->due_amount;
    $is_delivered = "0";

    $saled_date = date('Y-m-d H:i:s');
    $entry_by = Auth::user()->email;
    $created_at = date('Y-m-d H:i:s');

    $saleInfo['customer_id'] = $customer_id;
    $saleInfo['auto_sale_invoice'] = $new_invoice_no;
    $saleInfo['sub_total_bill'] = $sub_total;
    $saleInfo['vat_percent'] = $vat_percent;
    $saleInfo['vat_amount'] = $vat_amount;
    $saleInfo['discount'] = $discount;

    $saleInfo['paid_or_due'] = $paid_or_due;
    $saleInfo['paid_amount'] = $paid_amount;
    $saleInfo['due_amount'] = $due_amount;
    $saleInfo['is_delivered'] = $is_delivered;
    $saleInfo['saled_date'] = $saled_date;
    $saleInfo['entry_by'] = $entry_by;
    $saleInfo['created_at'] = $created_at;

    DB::table('sale_info')
              ->insert($saleInfo);

    $product_id_arr = $req->product_id;
    $inventory_id = $req->inventory_id;
    // $product_name = $req->product_name;
    $quantity = $req->quantity;
    $unit_price = $req->unit_price;
    $total_price = $req->total_price;

        
    // echo "<pre>";
    // var_dump($saleItem);
    // echo "</pre>";

    $sale_info = DB::table('sale_info')
            ->select('sale_info_id')
            ->where('auto_sale_invoice', $new_invoice_no)          
            ->get();
    $sale_info_id = "";
    foreach($sale_info as $sale) {
      $sale_info_id = $sale->sale_info_id;
    }
    

    foreach($product_id_arr as $key => $value) {
      $saleItem = array();
      $saleItem['sale_info_id'] = $sale_info_id;      
      $saleItem['product_info_id'] = $value;
      $saleItem['sale_price'] = $total_price[$key];
      $saleItem['inventory_id'] = $inventory_id[$key];
      $saleItem['qty'] = $quantity[$key];
      $saleItem['created_at'] = date('Y-m-d H:i:s');
      // echo "<pre>";
      // var_dump($key."=".$value);
      // var_dump($item);
      // echo "</pre>";
      DB::table('sale_item')
              ->insert($saleItem);
    }

    Session::put('sucMsg', 'A Sale Order Saved Successfully!');
    return Redirect::to('/order_place/view');
	}
  public function get_sale_product_info(Request $req) {
    $barcode = $req->barcodeSale;
    $scaned_product_id = "";
    $sale_info = array();
    // echo $barcode;
    // $total_and_entry = array();
    // $total_and_entry['total_qty'] = $total_qty[0]->total_qty;
    // $total_and_entry['total_entry'] = $total_entry[0]->entry;
    $inventory = DB::table('inventory')
                ->select('inventory_id','product_info_id')
                ->where('barcode', $barcode)
                ->where('qty','>', '0')
                ->get();
    $scaned_product_id = $inventory[0]->product_info_id;
    $inventory_id = $inventory[0]->inventory_id;
    $isProductAvailable = false;
    if(count($inventory) == 1) {
      $isProductAvailable = true;
      // echo $isProductAvailable;
    }
    if($isProductAvailable) {
      $sale_price = DB::table('product_purchase_history')
                ->select('sale_price')
                ->where('barcode', $barcode)
                ->where('product_info_id', $scaned_product_id)
                // ->where('quantity', '1')
                ->get();
      $sale_info['sale_price'] = $sale_price[0]->sale_price;
      // var_dump($sale_price);

      $product_info = DB::table('product_info')
                ->select('title', 'model', 'brand', 'image')
                ->where('product_info_id', $scaned_product_id)
                ->get();
      $sale_info['product_id'] = $scaned_product_id;
      $sale_info['title'] = $product_info[0]->title;
      $sale_info['model'] = $product_info[0]->model;
      $sale_info['brand'] = $product_info[0]->brand;
      $sale_info['image'] = $product_info[0]->image;
      $sale_info['inventory_id'] = $inventory_id;
      $sale_info['status'] = 200;
    } else {
      $sale_info['status'] = 404;
    }
    return response()->json($sale_info);
  }


  public function sale_order_details(Request $req) {
    $data = array();
    $info = array();
    $cInfo = array();
    $saleItem = array();
    $needSaleItemProductInfo = array();
    $existProductInfo = array();
    $auto_sale_invoice  = $req->auto_sale_invoice;
    $sale_info_id  = $req->sale_id;

    $sale_info = DB::table('sale_info')
                ->select()
                ->where('sale_info_id', $sale_info_id)
                ->where('auto_sale_invoice', $auto_sale_invoice)
                ->get();

      
    $info['sub_total_bill'] = $sale_info[0]->sub_total_bill;
    $info['auto_sale_invoice'] = $sale_info[0]->auto_sale_invoice;
    $info['discount'] = $sale_info[0]->discount;
    $info['vat_amount'] = $sale_info[0]->vat_amount;
    $info['paid_amount'] = $sale_info[0]->paid_amount;
    $info['due_amount'] = $sale_info[0]->due_amount;
    $info['saled_date'] = date("d/m/Y", strtotime(str_replace('/', '-', $sale_info[0]->saled_date)));
    if($sale_info[0]->is_delivered == 0) {
      $info['is_delivered'] = "Not Delivered";
    } else {
      $info['is_delivered'] = "Delivered";
    }

    $customer = DB::table('customer')
                  ->select()
                  ->where('customer_id', $sale_info[0]->customer_id)
                  ->get();
    $cInfo['customer_name'] = $customer[0]->customer_name;
    $cInfo['company_name'] = $customer[0]->company_name;
    $cInfo['phone'] = $customer[0]->phone;

    
    $sale_item = DB::table('sale_item')
                  ->select()
                  ->where('sale_info_id', $sale_info[0]->sale_info_id)
                  ->get();
    

    foreach($sale_item as $item) {
      $newItem = array();
      $newItem['product_info_id'] = $item->product_info_id;
      $newItem['sale_price'] = $item->sale_price;
      $newItem['qty'] = $item->qty;
      $saleItem[$item->product_info_id] = $newItem;
      // array_push($saleItem, $newItem);
      array_push($needSaleItemProductInfo, $item->product_info_id);
    }
    $product_info = DB::table('product_info')
                  ->select()
                  ->whereIn('product_info_id', $needSaleItemProductInfo)
                  ->get();

    foreach($product_info as $p_info) {
      $pItem = array();
      $pItem['product_info_id'] = $p_info->product_info_id;
      $pItem['title'] = $p_info->title;
      $pItem['description'] = $p_info->description;
      $pItem['model'] = $p_info->model;
      $pItem['brand'] = $p_info->brand;
      $pItem['image'] = $p_info->image;
      $existProductInfo[$p_info->product_info_id] = $pItem;
      // array_push($existProductInfo, $pItem);
    }
    // echo "<pre>";
    // var_dump($product_info);
    // echo "</pre>";
    // ===========================================
    $data['sale_info'] = $info;
    $data['customer'] = $cInfo;
    $data['saleItem'] = $saleItem;
    $data['product_info'] = $existProductInfo;
    $data['status'] = true;
    return response()->json($data);
  }
}
