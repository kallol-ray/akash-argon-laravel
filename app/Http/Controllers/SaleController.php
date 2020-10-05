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
    $barcode = $req->barcode;
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
      $saleItem['barcode'] = $barcode[$key];
      $saleItem['sale_price'] = $total_price[$key];
      $saleItem['inventory_id'] = $inventory_id[$key];
      $saleItem['qty'] = $quantity[$key];
      $saleItem['created_at'] = date('Y-m-d H:i:s');
      // echo "<pre>";
      // var_dump($key."=".$value);
      // var_dump($item);
      // echo "</pre>";
      DB::beginTransaction();
      $isQuantityAvailable = DB::table('inventory')
            ->select('qty')
            ->where('barcode', $barcode[$key])      
            ->where('product_info_id', $value)
            ->sharedLock()
            ->get();
      
      if($isQuantityAvailable != NULL) {
        // echo "<pre>";
        // var_dump($isQuantityAvailable);
        // var_dump($isQuantityAvailable[0]->qty);
        // echo "</pre>";
        // echo "</br></br>";
        $presentQty = (int)$quantity[$key];
        $dbQty = $isQuantityAvailable[0]->qty;
        if( $dbQty >= $presentQty) {          
          // try {
            $upadteQtyValue = $dbQty - $presentQty;
            if($upadteQtyValue >= 0) {
              // $dataupdate = array();
              DB::table('inventory')
                  ->where('barcode', $barcode[$key])
                  ->where('inventory_id', $inventory_id[$key])
                  ->where('product_info_id', $value)
                  ->update(['qty' => $upadteQtyValue]); 

              // array_push($dataupdate, $upadteQtyValue, $barcode[$key], $inventory_id[$key], $value);

              // DB::select('update inventory set qty = qty - ? where barcode = ? and inventory_id = ? and product_info_id = ?', $dataupdate);

              DB::table('sale_item')
                  ->insert($saleItem);
              DB::commit();
              
            }              
              
          // } catch (Exception $e) {
          //     // return error messsage
          // }
        }
      }
    }
    Session::put('sucMsg', 'A Sale Order Saved Successfully!');
    return Redirect::to('/order_place/view');
	}
  public function sale_order_update_process(Request $req) {
    $sale_info_id = $req->sale_info_id;
    $auto_sale_invoice = $req->auto_sale_invoice;
    // var_dump($auto_sale_invoice);
    $saleInfo = array();
    $saleItems = array();
    $product_item_id = array();
    $product_info = array();


    $customer_info = DB::table('customer')
                ->select('customer_id','customer_name','phone')
                ->orderBy('customer_id', 'desc')
                ->get();

    $sale_info = DB::table('sale_info')
                ->select()
                ->where('sale_info_id', $sale_info_id)
                ->where('is_delivered', '0')
                ->get();
    $saleInfo['sale_info_id'] = $sale_info[0]->sale_info_id;
    $saleInfo['auto_sale_invoice'] = $sale_info[0]->auto_sale_invoice;

    $saleInfo['customer_id'] = $sale_info[0]->customer_id;
    $saleInfo['sub_total_bill'] = $sale_info[0]->sub_total_bill;
    $saleInfo['vat_percent'] = $sale_info[0]->vat_percent + 0;
    $saleInfo['vat_amount'] = $sale_info[0]->vat_amount;
    $saleInfo['discount'] = $sale_info[0]->discount;    
    $saleInfo['paid_or_due'] = $sale_info[0]->paid_or_due;
    $saleInfo['paid_amount'] = $sale_info[0]->paid_amount;
    $saleInfo['due_amount'] = $sale_info[0]->due_amount;
    $saleInfo['saled_date'] = $sale_info[0]->saled_date;

    $saleInfo['after_discount'] = number_format($saleInfo['sub_total_bill'] - $saleInfo['discount'], 2);
    $saleInfo['customer_paid'] = number_format($saleInfo['after_discount'] + $saleInfo['vat_amount'], 2);


    $sale_item = DB::table('sale_item')
                ->select()
                ->where('sale_info_id', $sale_info_id)
                ->get();
    
    foreach ($sale_item as $key => $item) {
      // $data = array();
      // $data['sale_item_id'] = $item->sale_item_id;
      // $data['product_info_id'] = $item->product_info_id;
      // $data['inventory_id'] = $item->inventory_id;
      // $data['barcode'] = $item->barcode;
      // $data['qty'] = $item->qty;
      // $data['sale_price'] = $item->sale_price;
      // $data['unit_price'] = $item->sale_price / $item->qty;
      // array_push($saleItems, $data);
      array_push($product_item_id, $item->product_info_id);
    }    
    $product_info = DB::table('product_info')
                ->select()
                ->whereIn('product_info_id', $product_item_id)
                ->get();
    // echo '<pre>';
    // var_dump($product_info);
    // echo '</pre>';
    foreach ($sale_item as $key => $item) {
      $data = array();
      $data['sale_item_id'] = $item->sale_item_id;
      $data['product_info_id'] = $item->product_info_id;
      $data['inventory_id'] = $item->inventory_id;
      $data['barcode'] = $item->barcode;
      $data['qty'] = $item->qty;
      $data['sale_price'] = $item->sale_price;
      $data['unit_price'] = number_format($item->sale_price / $item->qty, 2);
      foreach ($product_info as $key => $info) {
        if($info->product_info_id == $item->product_info_id) {
          // $data['product_info_id'] = $info->product_info_id;
          $data['product_name'] = $info->title;
          $data['model'] = $info->model;
          $data['brand'] = $info->brand;
          $data['image'] = $info->image;
        }
      }
      array_push($saleItems, $data);
      // $saleItems[$item->sale_item_id] = $data;
    }  
    
    // echo '<pre>';
    // var_dump($saleItems);
    // echo '</pre>';

    return view('sale/sale_order_update')
        ->with('customer_info', $customer_info)
        ->with('saleInfo', $saleInfo)
        ->with('saleItems', $saleItems)
        ->with('product_info', $product_info);
  }
  public function sale_order_update(Request $req) {  
    $sale_info_id = $req->sale_info_id;
    $data = array();
    $data['customer_id'] = $req->customer_id;
    $data['sub_total_bill'] = $req->sub_total;
    $data['vat_percent'] = $req->vat_percent;
    $data['vat_amount'] = $req->vat_amount;
    $data['discount'] = $req->discount;
    $data['paid_or_due'] = $req->paid_or_due;
    $data['paid_amount'] = $req->paid_amount;
    $data['due_amount'] = $req->due_amount;
    $data['update_by'] = Auth::user()->email;
    $data['updated_at'] = date('Y-m-d H:i:s');
    DB::table('sale_info')
              ->where('sale_info_id', $sale_info_id)            
              ->where('is_delivered', '0')
              ->update($data);
    
    //Restore item qty and delete
      $total_items = 0;
      $row_updated = 0;
      $sale_item = DB::table('sale_item')
                        ->select()
                        ->where('sale_info_id', $sale_info_id)
                        ->get();

      // echo '<pre>';
      // print_r($sale_item);
      // exit;
      
      foreach ($sale_item as $key => $item) {
        $inventory = DB::table('inventory')
                      ->select('inventory_id', 'product_info_id', 'qty')
                      ->where('inventory_id', $item->inventory_id)
                      ->where('product_info_id', $item->product_info_id)
                      ->get();

        // echo '<pre>';
        // print_r($inventory);
        // echo '</pre>';
        $updateQty = $inventory[0]->qty + $item->qty;
        // echo '$updateQty'.$updateQty;
        $affected = DB::table('inventory')
                ->where('inventory_id', $item->inventory_id)
                ->where('product_info_id', $item->product_info_id)
                ->update(['qty' => $updateQty]);
        $row_updated += $affected;
        $total_items++;
      }
      
      if($total_items == $row_updated) {
        DB::table('sale_item')
          ->where('sale_info_id', $sale_info_id)
          ->delete();
      }
    //Restore item qty and delete


    $product_info_id_arra = $req->product_id;
    $inventory_id = $req->inventory_id;
    $barcode = $req->barcode;
    $sale_price = $req->total_price;
    $quantity = $req->quantity;
    // echo "<pre>";
    // var_dump($product_info_id_arra);
    // var_dump($inventory_id);
    // var_dump($barcode);
    // var_dump($sale_price);
    // var_dump($quantity);
    // exit();
    foreach ($product_info_id_arra as $key => $product_id) {
      $dataItem = array();
      $dataItem['sale_info_id'] = $sale_info_id;
      $dataItem['product_info_id'] = $product_id;
      $dataItem['inventory_id'] = $inventory_id[$key];
      $dataItem['barcode'] = $barcode[$key];
      $dataItem['qty'] = $quantity[$key];
      $dataItem['sale_price'] = $sale_price[$key];
      $dataItem['created_at'] = date('Y-m-d H:i:s');
      

      DB::beginTransaction();
      $isQuantityAvailable = DB::table('inventory')
            ->select('qty')
            ->where('barcode', $barcode[$key])      
            ->where('product_info_id', $product_id)
            ->sharedLock()
            ->get();
      
      if($isQuantityAvailable != NULL) {
        // echo "<pre>";
        // var_dump($isQuantityAvailable);
        // var_dump($isQuantityAvailable[0]->qty);
        // echo "</pre>";
        // echo "</br></br>";
        $presentQty = (int)$quantity[$key];
        $dbQty = $isQuantityAvailable[0]->qty;
        // echo "<pre>";
        // var_dump($presentQty);
        // var_dump($dbQty);
        // echo "-----------";
        // echo "</pre>";
        if( $dbQty >= $presentQty) {          
          // try {
            $upadteQtyValue = $dbQty - $presentQty;
            if($upadteQtyValue >= 0) {
              $dataupdate = array();
              DB::table('inventory')
                  ->where('barcode', $barcode[$key])
                  ->where('inventory_id', $inventory_id[$key])
                  ->where('product_info_id', $product_id)
                  ->update(['qty' => $upadteQtyValue]);
              DB::table('sale_item')
                  ->insert($dataItem);
              DB::commit();
              
            }
          // } catch (Exception $e) {
          //   Session::put('errMsg', $e);
          //   return Redirect::to('/order_place/view');
          // }
        }
      }
    }
    // echo "<pre>";
    // var_dump($product_info_id);
    // exit();
    Session::put('sucMsg', 'A Sale Order Update Successfully!');
    return Redirect::to('/order_place/view');
  }
  

  public function complete_order(Request $req) {
    $sale_id = $req->sale_id;
    $order_invoice = $req->order_invoice;
    // var_dump($order_invoice);
    DB::table('sale_info')
              ->where('sale_info_id', $sale_id)
              ->where('auto_sale_invoice', $order_invoice)              
              ->where('is_delivered', '0')
              ->update(['is_delivered' => '1']);

    Session::put('sucMsg', 'A Sale Order Delivery Complete Successfully!');
    return Redirect::to('/order_place/view');
  }

  public function cancel_sale_order(Request $req) {
    $sale_info_id = $req->sale_info_id;
    $auto_sale_invoice = $req->auto_sale_invoice;

    
    $sale_item = DB::table('sale_item')
                      ->select('inventory_id', 'product_info_id', 'qty')
                      ->where('sale_info_id', $sale_info_id)
                      ->get();

    // echo '<pre>';
    // print_r($sale_item);
    // echo '</pre>';
    $total_items = 0;
    $row_updated = 0;
    foreach ($sale_item as $key => $item) {
      $inventory = DB::table('inventory')
                    ->select('inventory_id', 'product_info_id', 'qty')
                    ->where('inventory_id', $item->inventory_id)
                    ->where('product_info_id', $item->product_info_id)
                    ->get();

      // echo '<pre>';
      // print_r($inventory);
      // echo '</pre>';
      $updateQty = $inventory[0]->qty + $item->qty;
      // echo '$updateQty'.$updateQty;
      $affected = DB::table('inventory')
              ->where('inventory_id', $item->inventory_id)
              ->where('product_info_id', $item->product_info_id)
              ->update(['qty' => $updateQty]);
      $row_updated += $affected;
      $total_items++;
    }
    if($total_items == $row_updated) {
      DB::table('sale_item')
        ->where('sale_info_id', $sale_info_id)
        ->delete();

      DB::table('sale_info')
        ->where('sale_info_id', $sale_info_id)
        ->delete();
    }
      // echo '<pre>';
      // print_r($row_updated);
      // print_r($i);
      // echo '</pre>';
    // ================================
    Session::put('sucMsg', 'A Sale Order Cancel Successfully!');
    return Redirect::to('/order_place/view');
  }

  

  
  //ajax call
  public function get_sale_product_info(Request $req) {
    $barcode = $req->barcodeSale;
    $scaned_product_id = "";
    $sale_info = array();
    // echo $barcode;
    // $total_and_entry = array();
    // $total_and_entry['total_qty'] = $total_qty[0]->total_qty;
    // $total_and_entry['total_entry'] = $total_entry[0]->entry;
    $inventory = DB::table('inventory')
                ->select('inventory_id','product_info_id', 'qty')
                ->where('barcode', $barcode)
                ->where('qty','>', '0')
                ->get();
    $scaned_product_id = $inventory[0]->product_info_id;
    $inventory_id = $inventory[0]->inventory_id;
    $isProductAvailable = false;
    if(count($inventory) >= 1) {
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
      $sale_info['qty'] = $inventory[0]->qty;
      $sale_info['status'] = 200;
    } else {
      $sale_info['status'] = false;
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
    $info['grand_total_sale'] = number_format($sale_info[0]->sub_total_bill - $sale_info[0]->discount + $sale_info[0]->vat_amount, 2);
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

  public function search_invoice_sale(Request $req) {
    $auto_sale_invoice = $req->auto_sale_invoice;
    $data = array();
    $sale_info = DB::table('sale_info')
                  ->select()
                  ->where('auto_sale_invoice', $auto_sale_invoice)
                  ->get();
    // echo "<pre>";
    // var_dump($sale_info);
    // exit();
    
    if($sale_info != NULL && count($sale_info) > 0) {
      $data['status'] = true;
      foreach ($sale_info as $info) {
        $data['sale_info_id'] = $info->sale_info_id;
        $data['auto_sale_invoice'] = $info->auto_sale_invoice;
        $data['customer_id'] = $info->customer_id;
        $data['sub_total_bill'] = $info->sub_total_bill;
        $data['vat_percent'] = $info->vat_percent;
        $data['vat_amount'] = $info->vat_amount;
        $data['discount'] = $info->discount;

        $data['paid_or_due'] = $info->paid_or_due;
        $data['paid_amount'] = $info->paid_amount;
        $data['due_amount'] = $info->due_amount;
        $data['is_delivered'] = $info->is_delivered;
        $data['saled_date'] = date("d/m/Y", strtotime(str_replace('/', '-', $info->saled_date)));
        $data['entry_by'] = $info->entry_by;
        $data['update_by'] = $info->update_by;
        $data['created_at'] = $info->created_at;
        $data['updated_at'] = $info->updated_at;      
      }
      $customer = DB::table('customer')
                    ->select()
                    ->where('customer_id', $sale_info[0]->customer_id)
                    ->get();

      foreach ($customer as $c) {
        $data['customer_name'] = $c->customer_name;
      }
      return response()->json($data);
    } else {
      $data['status'] = false;
      return response()->json($data);
    }    
  }

  public function search_status_invoice_sale(Request $req) {
    $is_delivered = $req->is_delivered;
    $data = array();
    $sale_info = DB::table('sale_info')
                  ->select()
                  ->where('is_delivered', $is_delivered)
                  ->get();
    // echo "<pre>";
    // var_dump($sale_info);
    // exit();
    
    if($sale_info != NULL && count($sale_info) > 0) {      
      $data['invoice_items'] = array();
      foreach ($sale_info as $info) {

        $invoice_item['sale_info_id'] = $info->sale_info_id;
        $invoice_item['auto_sale_invoice'] = $info->auto_sale_invoice;
        $invoice_item['customer_id'] = $info->customer_id;
        $invoice_item['sub_total_bill'] = $info->sub_total_bill;
        $invoice_item['vat_percent'] = $info->vat_percent;
        $invoice_item['vat_amount'] = $info->vat_amount;
        $invoice_item['discount'] = $info->discount;

        $invoice_item['paid_or_due'] = $info->paid_or_due;
        $invoice_item['paid_amount'] = $info->paid_amount;
        $invoice_item['due_amount'] = $info->due_amount;
        $invoice_item['is_delivered'] = $info->is_delivered;
        $invoice_item['saled_date'] = date("d/m/Y", strtotime(str_replace('/', '-', $info->saled_date)));
        $invoice_item['entry_by'] = $info->entry_by;
        $invoice_item['update_by'] = $info->update_by;
        $invoice_item['created_at'] = $info->created_at;
        $invoice_item['updated_at'] = $info->updated_at;
        $customer = DB::table('customer')
                    ->select()
                    ->where('customer_id', $sale_info[0]->customer_id)
                    ->get();
        foreach ($customer as $c) {
          $invoice_item['customer_name'] = $c->customer_name;
        }
        array_push($data['invoice_items'], $invoice_item);
      }
      $data['status'] = true;
      return response()->json($data);
    } else {
      $data['status'] = false;
      return response()->json($data);
    }
  }

  public function get_print_invoice(Request $req) {
    $sale_info_id = $req->sale_info_id;
    $auto_sale_invoice = $req->auto_sale_invoice;
    $data = array();
    $item_data = array();
    $total_qty = 0;
    $item_products_id = array();

    $sale_info = DB::table('sale_info')
                  ->select()
                  ->where('sale_info_id', $sale_info_id)
                  ->where('auto_sale_invoice', $auto_sale_invoice)
                  ->get();
    $sale_item = DB::table('sale_item')
                  ->select()
                  ->where('sale_info_id', $sale_info_id)
                  ->get();
    foreach ($sale_item as $key => $value) {
      // echo 'value'. $value->product_info_id .'<br>';
      array_push($item_products_id,$value->product_info_id);
    }
    $product_info = DB::table('product_info')
                  ->select()
                  ->whereIn('product_info_id', $item_products_id)
                  ->get();    

    $customer_info = DB::table('customer')
                  ->select()
                  ->where('customer_id', $sale_info[0]->customer_id)
                  ->get();

    $data['auto_sale_invoice'] = $sale_info[0]->auto_sale_invoice;
    $data['sub_total_bill'] = $sale_info[0]->sub_total_bill;
    $data['vat_percent'] = $sale_info[0]->vat_percent;
    $data['vat_amount'] = $sale_info[0]->vat_amount;
    $data['discount'] = $sale_info[0]->discount;
    $data['paid_amount'] = $sale_info[0]->paid_amount;
    $data['due_amount'] = $sale_info[0]->due_amount;
    $data['saled_date'] = date("d/m/Y", strtotime(str_replace('/', '-', $sale_info[0]->saled_date)));

    $net_sale = $data['sub_total_bill'] - $data['discount'];
    $grand_total = $net_sale - $data['vat_amount'];

    $data['net_sale'] = number_format($net_sale, 2);
    $data['grand_total'] = number_format($grand_total, 2);

    $data['customer_name'] = $customer_info[0]->customer_name;
    $data['company_name'] = $customer_info[0]->company_name;
    $data['customer_phone'] = $customer_info[0]->phone;

    $i = 1;
    $all_item = array();
    foreach ($sale_item as $item) {
      $all_item['serial_no'] = $i;

      foreach ($product_info as $product) {
        if($item->product_info_id == $product->product_info_id) {
          $all_item['product_name'] = $product->title;
          $all_item['model'] = $product->model;
          $all_item['brand'] = $product->brand;
        }        
      }
      
      $all_item['qty'] = $item->qty;
      // $all_item['rate'] = $item->rate;
      $all_item['rate'] = ""; //Db te rate rakha hoinai
      $all_item['price'] = $item->sale_price;
      $total_qty += $item->qty;
      $i++;
      
      array_push($item_data, $all_item);
      $all_item = [];
    }
    $data['total_qty'] = $total_qty;
    $data['item_data'] = $item_data;


    // $data['total_qty'] = $total_qty;
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($product_info);
    // echo "</pre>";

    // echo "<pre>";
    // print_r($item_data);
    // echo "</pre>";
    $data['status'] = true;
    return response()->json($data);
  }
}
