<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;//it write kallol
use Redirect;//it write kallol
use DB;//it write kallol


class ProductController extends Controller
{
   	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */

    public function product_info_entry()
    { 
      $brand_info = DB::table('brand')
                ->orderBy('brand_id', 'desc')
                ->get();
      return view('product.product_info_entry')
              ->with('brand_info', $brand_info);
    }
    public function product_save(Request $request)
    {
        $data = array();        
        // $orgDate = $request->info_entry_date;
        // $changeSeparator = str_replace('/', '-', $orgDate);  
        // $newDate = date("Y-m-d", strtotime($changeSeparator));
        // $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->info_entry_date)));

        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['model'] = $request->model;
        $data['brand'] = $request->brand;
        $data['info_entry_date'] = date("Y-m-d", strtotime(str_replace('/', '-', $request->info_entry_date)));   
        $data['entry_by'] = Auth::user()->email;
        $data['created_at'] = date('Y-m-d H:i:s');
        // echo "<pre>";
        // print_r($data);
        // var_dump($data);
        // echo "</pre>";
        
        //Start Image uploader
          if(!empty($_FILES['imageToUpload']['name'])) {
            $target_dir = "ourwork/img/product_image/";
            $image_base_name = basename($_FILES["imageToUpload"]["name"]);
            $image_new_name = $image_base_name;

            $target_file = $target_dir . $image_base_name;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            
            $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
            if($check !== false) {
              // echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              // echo "File is not an image.";
              $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
              // echo "Sorry, file already exists.";
              $uploadOk = 0;
            }
            // Check file size 500KB = 500000Byte
            //size return with byte
            if ($_FILES["imageToUpload"]["size"] > 500000) {
              // echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
              // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            } else {
              //if file extension is JPG, JPEG, PNG or GIF
              $ibn_without_ext = rtrim($image_new_name, ".".$imageFileType);
              //name length is greater than 80 char
              if(strlen($ibn_without_ext) > 80 ) {
                $ibn_eighty_char_name = substr($ibn_without_ext, 0, 80);
              } else {
                $ibn_eighty_char_name = $ibn_without_ext;
              }
              $ibn_eighty_char_name = str_replace("'","",$ibn_eighty_char_name);            //adding time stamp to name
              $ibn_eighty_char_name = $ibn_eighty_char_name . "@".time().".".$imageFileType;
              $data['image'] = $image_new_name = $ibn_eighty_char_name;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploadable.";
            // if everything is ok, try to upload file
            } else {
              // move_uploaded_file($_FILES["file"]["tmp_name"],"/new folder/" . $name_file.".".$ext);
              if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_dir . $image_new_name)) {
                echo "0=The image file \"". $image_base_name. "\" has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }

            // echo "<br>"."1=".$image_new_name . strlen($image_new_name). "<br>";
            // echo $ibn_without_ext ."|". strlen($ibn_without_ext) . "<br>";
            // echo $ibn_eighty_char_name . "<br>" . "<br>";
            // echo $target_dir . $ibn_eighty_char_name;
          } else {
            $data['image'] = "";
          }
            
        //End Image uploader

        DB::table('product_info')
                  ->insert($data);

        Session::put('sucMsg', 'New Product Information Saved Successfully!');

        return Redirect::to('/product/view');
    }

    public function product_delete(Request $request)
    {
      // if($request->deleteBtn == "Delete") {
        $product_del_id = $request->product_del_id;
        // $image_del_path = $request->image_del_path;
        $image_del_path = 'ourwork/img/product_image/'.$request->image_del_path;
        var_dump($image_del_path);
        if(file_exists($image_del_path)) {
          if(str_contains($image_del_path,".jpg") || str_contains($image_del_path,".jpeg") || str_contains($image_del_path,".png") || str_contains($image_del_path,".gif")) {
            unlink($image_del_path);
            echo 'File '.$image_del_path.' has been deleted';
          }
        } else {
          echo 'Could not delete '.$image_del_path.', file does not exist';
        }

        DB::table('product_info')
                ->where('product_info_id', $product_del_id)->delete();

        Session::put('sucMsg', 'A Product Information Deleted Successfully!');         
      // }
      return Redirect::to('/product/view');
    }

    public function product_view()
    {
      $product_info = DB::table('product_info')
                ->orderBy('product_info_id', 'desc')               
                ->get();
      return view('product.product_info_lists')->with('product_info', $product_info);
    }
    public function product_update_process(Request $request)
    {
      $product_info_id = $request->id;
      $product_info_single = DB::table('product_info')               
                  ->where('product_info_id', $product_info_id)->first();
      $brand_info = DB::table('brand')
                  ->orderBy('brand_id', 'desc')
                  ->get();
      // echo '<pre>';
      // var_dump($product_info_single);
      // var_dump($brand_info);
      // echo '</pre>';
      return view('product.product_info_update')
                  ->with("product_info_single", $product_info_single)
                  ->with("brand_info", $brand_info);
    }
    public function update_product(Request $request)
    {
      //update product
        $data = array();       
        $before_img_name = $request->before_img_name;
        $update_id = $request->update_id;
        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['model'] = $request->model;
        $data['brand'] = $request->brand;
        $data['info_entry_date'] = date("Y-m-d", strtotime(str_replace('/', '-', $request->info_entry_date)));;
        // $data['image'] = $request->image;        
        $data['updated_by'] = Auth::user()->email;
        $data['updated_at'] = date('Y-m-d H:i:s');
        // echo "<pre>";
        // print_r($data);
        // var_dump($data);
        // echo "</pre>";
          
          if(empty($_FILES['imageToUpload']['name'])) {
            //If image is not upload
            $data['image'] = $before_img_name;
          } else {
            $target_dir = "ourwork/img/product_image/";
            //delete before image
            if($before_img_name !="") {
              if(str_contains($before_img_name,".jpg") || str_contains($before_img_name,".jpeg") || str_contains($before_img_name,".png") || str_contains($before_img_name,".gif")) {
                if(file_exists($target_dir."/".$before_img_name)) {
                  unlink($target_dir."/".$before_img_name);
                  echo 'File '.$target_dir."/".$before_img_name.' has been deleted';
                } else {
                  echo 'Could not delete '.$target_dir."/".$before_img_name.', file does not exist';
                }
              }
            }
            
            $image_base_name = basename($_FILES["imageToUpload"]["name"]);
            $image_new_name = $image_base_name;

            $target_file = $target_dir . $image_base_name;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            
            $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
            if($check !== false) {
              // echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
            } else {
              // echo "File is not an image.";
              $uploadOk = 0;
            }
            // Check if file already exists
            if (file_exists($target_file)) {
              // echo "Sorry, file already exists.";
              $uploadOk = 0;
            }
            // Check file size 500KB
            if ($_FILES["imageToUpload"]["size"] > 500000) {
              // echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
              // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            } else {
              //if file extension is JPG, JPEG, PNG or GIF
              $ibn_without_ext = rtrim($image_new_name, ".".$imageFileType);
              //name length is greater than 80 char
              if(strlen($ibn_without_ext) > 80 ) {
                $ibn_eighty_char_name = substr($ibn_without_ext, 0, 80);
              } else {
                $ibn_eighty_char_name = $ibn_without_ext;
              }
              $ibn_eighty_char_name = str_replace("'","",$ibn_eighty_char_name);            //adding time stamp to name
              $ibn_eighty_char_name = $ibn_eighty_char_name . "@".time().".".$imageFileType;
              $data['image'] = $image_new_name = $ibn_eighty_char_name;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploadable.";
            // if everything is ok, try to upload file
            } else {
              // move_uploaded_file($_FILES["file"]["tmp_name"],"/new folder/" . $name_file.".".$ext);
              if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_dir . $image_new_name)) {
                echo "0=The image file \"". $image_base_name. "\" has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }
          }

          $row_affected = DB::table('product_info')
              ->where('product_info_id', $update_id)
              ->update($data);
          if($row_affected == 1) {
            Session::put('sucMsg', 'A Product Information Updated Successfully!');
            return Redirect::to('/product/view');
          } else {
            echo "The Product is not updated.";
          }
    }

    //start purchase order
      public function purchase_order_entry()
      {
        $supplier_info = DB::table('supplier')
                ->select('supplier_id', 'supplier_name')               
                ->get();
        $product_info = DB::table('product_info')
                ->select('product_info_id', 'title', 'image')               
                ->get();

        return view('product.product_purchase_entry')
                    ->with("supplier_info", $supplier_info)
                    ->with("product_info", $product_info);
      }
      public function purchase_order_save(Request $request)
      {
        $auto_invoice = DB::table('purchase_order_info')
          ->max('auto_invoice_no');
        // echo "<pre>";
        // var_dump($auto_invoice);
        // echo "</pre>";
        if($auto_invoice == NULL) {
          $new_invoice_no = "POI-10001";
        } else {
          $new_invoice_no = "POI-". (preg_replace('/[^0-9]/', '', $auto_invoice) + 1);
        }
        

        $data = array();
        $data['auto_invoice_no'] = $new_invoice_no;
        $data['is_stored'] = 0;
        $data['purchased_date'] = date("Y-m-d", strtotime(str_replace('/', '-', $request->purchased_date)));;
        $data['supplier_id'] = $request->supplier_id;
        // $data['product_info_id'] = $request->product_info_id;
        
        $data['buyer_adnl_cost'] = $request->buyer_addtional_costs;
        $data['supplier_adnl_cost'] = $request->supplier_additional_cost;
        $data['paid_or_due'] = $request->paid_or_due;

        $data['purchase_invoice_no'] = $request->purchase_invoice_no;
        $data['paid_amount'] = $request->paid_amount;
        $data['due_amount']  = $request->due_amount;
        $data['discount']  = 0;

        $data['sub_total']   = $request->sub_total;
        $data['vat_percent'] = $request->vat_percent;
        $data['vat_amount']  = $request->vat_amount;
        $data['grand_total'] = $request->grand_total;
        $data['entry_by']    = Auth::user()->email;      
        $data['created_at']  = date('Y-m-d H:i:s');

        // Array
        $product_info_id_arr  = $request->product_info_id;
        $image_arr            = $request->image;
        $quantity_arr         = $request->quantity;
        $unit_price_arr       = $request->unit_price;
        $additional_price_arr = $request->additional_price;
        $sale_price_arr       = $request->sale_price;
        $total_price_arr      = $request->total_price;

        // echo "<pre>";
        // // print_r(count($product_info_id_arr));
        // print_r($quantity_arr);
        // echo "</pre>";
        DB::table('purchase_order_info')
                  ->insert($data);

        $purchase_order_info = DB::table('purchase_order_info')
                ->select('po_info_id')
                ->where('auto_invoice_no', $new_invoice_no)          
                ->get();
        $po_info_id = "";
        foreach($purchase_order_info as $po_onfo) {
          $po_info_id = $po_onfo->po_info_id;
        }
        

        foreach($product_info_id_arr as $key => $value) {
          $item = array();
          $item['product_info_id'] = $value;

          $item['po_info_id'] = $po_info_id;

          $item['image'] = $image_arr[$key];
          $item['auto_invoice_no'] = $new_invoice_no;
          $item['product_qty'] = $quantity_arr[$key];
          $item['unit_price'] = $unit_price_arr[$key];
          $item['unit_adnl_price'] = $additional_price_arr[$key];
          $item['sale_price'] = $sale_price_arr[$key];
          $item['total_price'] = $total_price_arr[$key];
          $item['created_at'] = date('Y-m-d H:i:s');
          // echo "<pre>";
          // var_dump($key."=".$value);
          // var_dump($item);
          // echo "</pre>";
          DB::table('po_info_item')
                  ->insert($item);
        }

        Session::put('sucMsg', 'A Purchase Information Saved Successfully!');
        return Redirect::to('/product/purchase_order/view');
      }
      public function purchase_order_view()
      {
        $spplierArr = array();
        // $productArr = array();
        $purchase_order_info = DB::table('purchase_order_info')
                ->where('is_stored', '0')
                ->orderBy('po_info_id', 'desc')
                ->get();
        $supplier_info = DB::table('supplier')
                ->select('supplier_id', 'supplier_name')  
                ->get();
        // $product_info = DB::table('product_info')
        //         ->select('product_info_id', 'title')  
        //         ->get();
        
        foreach($supplier_info as $supplier) {
          $spplierArr[$supplier->supplier_id] = $supplier->supplier_name;
        }
        // foreach($product_info as $product) {
        //   $productArr[$product->product_info_id] = $product->title;
        // }
        // echo "<pre>";
        // var_dump($productArr);
        // echo $productArr['1'];

        return view('product.product_purchase_lists')
                    ->with("purchase_order_info", $purchase_order_info)
                    ->with("spplierArr", $spplierArr);
                    // ->with("productArr", $productArr);
      }
      public function purchase_order_delete(Request $request)
      {
        // $po_info_id = $request->po_info_id;
        // DB::table('purchase_order_info')
        //         ->where('po_info_id', $po_info_id)
        //         ->delete();
        // Session::put('sucMsg', 'A Purchase Order Info Deleted Successfully!');
        // return Redirect::to('/product/purchase_order/view');
      }
      public function purchase_order_update_process(Request $request) {
        $po_info_id = $request->po_info_id;
        $purchase_order_info_single = DB::table('purchase_order_info')
                  ->where('is_stored', '0')
                  ->where('po_info_id', $po_info_id)
                  ->get();
        if(count($purchase_order_info_single) == 1) {
          $productArr = array();
          // echo "<pre>";
            // var_dump($auto_invoice_no = $purchase_order_info_single[0]->auto_invoice_no);
            // var_dump($purchase_order_info_single);
          // echo "</pre>";
          $auto_invoice_no = $purchase_order_info_single[0]->auto_invoice_no;
          $po_info_item = DB::table('po_info_item')
                    ->where('auto_invoice_no', $auto_invoice_no)
                    ->get();
          $supplier_info = DB::table('supplier')
                    ->select('supplier_id', 'supplier_name')  
                    ->get();
          $product_info = DB::table('product_info')
                    ->select('product_info_id', 'title', 'image')
                    ->get();
          foreach($product_info as $product) {
            $productArr[$product->product_info_id] = $product->title;
          }
          return view('product.product_purchase_update')
                      ->with("purchase", $purchase_order_info_single)
                      ->with("supplier_info", $supplier_info)
                      ->with("product_info", $product_info)
                      ->with("po_info_item", $po_info_item)
                      ->with("productArr", $productArr);
        } else {
          return Redirect::to('/product/purchase_order/view');
        }        
      }
      public function update_purchase_order(Request $request) {
        $data = array();        
        $po_info_id = $request->po_info_id;
        $auto_invoice_no = $request->auto_invoice_no;

        // $orgDate = $request->info_entry_date;
        // $changeSeparator = str_replace('/', '-', $orgDate);  
        // $newDate = date("Y-m-d", strtotime($changeSeparator));
        $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->purchased_date)));

        // $data['is_stored'] = 0;
        $data['supplier_id'] = $request->supplier_id;
        // $data['product_info_id'] = $request->product_info_id;
        $data['purchase_invoice_no'] = $request->purchase_invoice_no;
        $data['buyer_adnl_cost'] = $request->buyer_addtional_costs;
        $data['supplier_adnl_cost'] = $request->supplier_additional_cost;
        $data['vat_percent'] = $request->vat_percent;
        $data['vat_amount'] = $request->vat_amount;
        $data['discount'] = $request->discount;
        $data['paid_or_due'] = $request->paid_or_due;
        $data['paid_amount'] = $request->paid_amount;
        $data['due_amount'] = $request->due_amount;
        $data['sub_total'] = $request->sub_total;
        $data['grand_total'] = $request->grand_total;
        $data['purchased_date'] = $newDate;
        $data['update_by'] = Auth::user()->email;
        $data['updated_at']  = date('Y-m-d H:i:s');
        DB::table('purchase_order_info')
                  ->where('po_info_id', $po_info_id)
                  ->where('is_stored', '0')
                  ->where('auto_invoice_no', $auto_invoice_no)
                  ->update($data);

        DB::table('po_info_item')
                  ->where('po_info_id', $po_info_id)
                  ->where('auto_invoice_no', $auto_invoice_no)
                  ->delete();

        $product_info_id_arr  = $request->product_info_id;
        $image_arr            = $request->image;
        $quantity_arr         = $request->quantity;
        $unit_price_arr       = $request->unit_price;
        $additional_price_arr = $request->additional_price;
        $sale_price_arr       = $request->sale_price;
        $total_price_arr      = $request->total_price;

        foreach($product_info_id_arr as $key => $value) {
          $item = array();
          $item['product_info_id'] = $value;

          $item['po_info_id'] = $po_info_id;

          $item['image'] = $image_arr[$key];
          $item['auto_invoice_no'] = $auto_invoice_no;
          $item['product_qty'] = $quantity_arr[$key];
          $item['unit_price'] = $unit_price_arr[$key];
          $item['unit_adnl_price'] = $additional_price_arr[$key];
          $item['sale_price'] = $sale_price_arr[$key];
          $item['total_price'] = $total_price_arr[$key];
          $item['created_at'] = date('Y-m-d H:i:s');
          // echo "<pre>";
          // var_dump($key."=".$value);
          // var_dump($item);
          // echo "</pre>";
          DB::table('po_info_item')
                  ->insert($item);
        }
        
        
        

        Session::put('sucMsg', 'A Purchase Information Updated Successfully!');
        return Redirect::to('/product/purchase_order/view');
      }
      public function po_stop_entry(Request $request) {
        $po_info_id = $request->po_info_id;
        $data = array();
        $data['is_stored'] = "1";
        DB::table('purchase_order_info')
                  ->where('po_info_id', $po_info_id)
                  ->update($data);

        Session::put('sucMsg', 'A Order Ready to Stock Entry Successfully!');
        return Redirect::to('/product/purchase_order/view');
      }
    //end purchase order

    //Start Store In
      public function store_in_entry() {
        $productArr = array();
        $purchase_order_info = DB::table('purchase_order_info')
                // ->select('po_info_id', 'product_info_id', 'purchase_invoice_no','product_qty','total_bill')
                ->select('po_info_id', 'auto_invoice_no', 'purchased_date')
                ->where('is_stored', '1')
                ->orderBy('po_info_id', 'desc')
                ->get();
        $product_info = DB::table('product_info')
                ->select('product_info_id', 'title')  
                ->get();
                
        foreach($product_info as $product) {
          $productArr[$product->product_info_id] = $product->title;
        }
        return view('product.store_in_entry')
                    ->with("purchase_order_info", $purchase_order_info)
                    ->with("product_info", $product_info);
      }
      public function store_in_entry_save(Request $request) {
        $dataPurchaseHistory = array();
        $dataInventory = array();

        $dataPurchaseHistory['is_stored'] = '0';
        $dataPurchaseHistory['po_info_id'] = "";
        $dataPurchaseHistory['auto_invoice_no'] = $request->po_auto_invoice;
        $dataPurchaseHistory['product_info_id'] = $request->product_info_id;
        $dataPurchaseHistory['barcode'] = $request->barcode;
        $dataPurchaseHistory['quantity'] = '1';
        $dataPurchaseHistory['buy_price'] = "";
        $dataPurchaseHistory['sale_price'] = "";
        $dataPurchaseHistory['buy_date'] = "";
        $dataPurchaseHistory['comment'] = $request->comment;
        $dataPurchaseHistory['entry_by'] = Auth::user()->email;
        $dataPurchaseHistory['created_at'] = date('Y-m-d H:i:s');

        $dataInventory['product_info_id'] = $request->product_info_id;
        $dataInventory['barcode'] = $request->barcode;
        $dataInventory['qty'] = "1";
        $dataInventory['entry_by'] = Auth::user()->email;
        $dataInventory['created_at'] = date('Y-m-d H:i:s');

        // echo "<pre>";
        // var_dump($dataPurchaseHistory);
        $barcodesFromDb = DB::table('product_purchase_history')
                ->select('barcode')
                ->orderBy('barcode', 'asc')
                ->get();
        $po_info_item = DB::table('po_info_item')
                ->select('po_info_item_id', 'product_info_id', 'po_info_id', 'auto_invoice_no', 'unit_price', 'sale_price')
                ->where('auto_invoice_no', $request->po_auto_invoice)
                ->where('product_info_id', $request->product_info_id)
                ->get();
        if(count($po_info_item) > 0) {
          foreach($po_info_item as $item) {
            $dataPurchaseHistory['po_info_id'] = $item->po_info_id;
            $dataPurchaseHistory['buy_price'] = $item->unit_price;
            $dataPurchaseHistory['sale_price'] = $item->sale_price;
          }
        }
        $purchase_order_info = DB::table('purchase_order_info')
                ->select('po_info_id', 'auto_invoice_no', 'purchased_date')
                ->where('po_info_id', $dataPurchaseHistory['po_info_id'])
                ->get();
        if(count($po_info_item) > 0) {
          foreach($purchase_order_info as $date) {
            $dataPurchaseHistory['buy_date'] = $date->purchased_date;
          }
        }

        // echo "<pre>";
        //   var_dump($dataPurchaseHistory);
        // echo "</pre>";
        

        $isBarcodeExist = false;
        if(count($barcodesFromDb) > 0) {
          foreach($barcodesFromDb as $barcode) {
            // echo $barcode->barcode;
            if($barcode->barcode == $dataPurchaseHistory['barcode']) {
              // echo $barcode->barcode;
              // echo "<br/>";
              $isBarcodeExist = true;
            }
          }
        }
        
        $returnArr = array();
        if(!$isBarcodeExist) {
          
          DB::table('product_purchase_history')
                    ->insert($dataPurchaseHistory);
          DB::table('inventory')
                    ->insert($dataInventory);

          // Session::put('sucMsg', 'A Product Stored Successfully!');
          // return Redirect::to('/product/store_in/view');
          
          $returnArr['status'] = true;
          $returnArr['message'] = "A product Saved Successfully.";
          // return "A product Saved Successfully.";
          return $returnArr;
        } else {
          $returnArr['status'] = false;
          $returnArr['message'] = "This Product is Already Added.<br/> Barcode = '".$dataInventory['barcode']."'.";
          return $returnArr;
          // return "This Product is Already Added, Barcode = '".$data['barcode']."'.";
        }
      }
      public function store_in_view() {
        // $pp_history = DB::table('product_purchase_history')
        //         ->orderBy('pp_history_id', 'desc')
        //         ->get();
        $pp_invoice = DB::table('product_purchase_history')
                      ->select('auto_invoice_no', 'buy_date')
                      ->orderBy('auto_invoice_no', 'desc')
                      ->distinct()
                      ->get(['auto_invoice_no']);

        // $productArr = array();
        // $product_info = DB::table('product_info')
        //         ->select('product_info_id', 'title')
        //         ->get();
                
        // foreach($product_info as $product) {
        //   $productArr[$product->product_info_id] = $product->title;
        // }
        return view('product.store_in_lists')
                  // ->with("pp_history", $pp_history)
                  // ->with("productArr", $productArr)
                  ->with("pp_invoice", $pp_invoice);
      }
    // End Store In



      public function get_single_product_info(Request $req) {
        $single_product_info = DB::table('product_info')
                ->where('product_info_id', $req->product_info_id)
                ->get();
                
        return $single_product_info;
      }
      public function get_invoice_wise_product(Request $req) {
        $auto_invoice = $req->auto_invoice;
        $total_and_entry = array();
        $optionArr = array();
        $data = array();
        $product_info_id = DB::table('po_info_item')
                ->select('product_info_id')
                ->where('auto_invoice_no', $auto_invoice)
                ->get();
        $product_info = DB::table('product_info')
                ->select('product_info_id', 'title')
                ->get();
        
        foreach($product_info_id as $id) {
          foreach($product_info as $product) {
            if($id->product_info_id == $product->product_info_id) {
              $optionArr[$product->product_info_id] = $product->title;
            }
          }
        }
        // var_dump($product_info_id);
        $total_qty_invoice = DB::table('po_info_item')
                ->select(DB::raw('SUM(product_qty) as total_qty'))
                ->groupBy('auto_invoice_no')
                ->where('auto_invoice_no', $auto_invoice)
                ->get();
        $total_entry_invoice = DB::table('product_purchase_history')
                ->select(DB::raw('SUM(quantity) as entry'))
                ->groupBy('auto_invoice_no')
                ->where('auto_invoice_no', $auto_invoice)
                ->get();

        if(count($total_qty_invoice) > 0) {
          $total_and_entry['total_qty'] = $total_qty_invoice[0]->total_qty;
        } else {
          $total_and_entry['total_qty'] = '0';          
        }
        if(count($total_entry_invoice) > 0) {
          $total_and_entry['total_entry'] = $total_entry_invoice[0]->entry;
        } else {
          $total_and_entry['total_entry'] = '0';
        }
        $data['product_option'] = $optionArr;
        $data['count'] = $total_and_entry;
        // $data['invoie'] = $total_entry_invoice;

        // echo count($total_qty_invoice);
        // echo '<br>';
        // echo count($total_entry_invoice);

        return response()->json($data);
      }
      // public function get_product_count(Request $req) {
      //   $auto_invoice = $req->auto_invoice;
      //   $total_qty = DB::table('po_info_item')
      //           ->select(DB::raw('SUM(product_qty) as total_qty'))
      //           ->groupBy('auto_invoice_no')
      //           ->where('auto_invoice_no', $auto_invoice)
      //           ->get();
      //   $total_entry = DB::table('product_purchase_history')
      //           ->select(DB::raw('SUM(quantity) as entry'))
      //           ->groupBy('auto_invoice_no')
      //           ->where('auto_invoice_no', $auto_invoice)
      //           ->get();
      //   $total_and_entry = array();
      //   $total_and_entry['total_qty'] = $total_qty[0]->total_qty;
      //   $total_and_entry['total_entry'] = $total_entry[0]->entry;

      //   // echo "<pre>";
      //   //   var_dump($total_qty[0]->total_qty);
      //   // echo "</pre>";
      //   // return response()->json(['success'=>'Got Simple Ajax Request.']);
      //   // return response()->json($total_qty);
      //   return $total_and_entry;
      // }
      public function get_entry_count(Request $req) {
        $auto_invoice = $req->invoice;
        $product_info_id = $req->product_id;
        $total_item = DB::table('po_info_item')
                ->select('product_qty')
                ->where('auto_invoice_no', $auto_invoice)
                ->where('product_info_id', $product_info_id)
                ->get();
        $entry_item = DB::table('product_purchase_history')
                ->select(DB::raw('SUM(quantity) as entry_item'))
                ->groupBy('auto_invoice_no')
                ->where('auto_invoice_no', $auto_invoice)
                ->where('product_info_id', $product_info_id)
                ->get();
        $total_and_item = array();
        $total_and_item['total_item'] = $total_item[0]->product_qty;
        if(count($entry_item) == 0) {
          $total_and_item['entry_item'] = "0";
        } else {
          $total_and_item['entry_item'] = $entry_item[0]->entry_item;
        }
        
        // echo "<pre>";        
        //   // var_dump($total_item[0]->product_qty);
        //   // var_dump($entry_item[0]->entry_item);
        //   var_dump($total_and_item);
        // echo "</pre>";
       
        return $total_and_item;
      }
      public function get_purchase_order_details(Request $req) {
        $auto_invoice = $req->auto_invoice;
        $data_id = $req->data_id;
        $data = array();
        $product_item_ids = array();
        $products_information = array();
        // $this_supplier_info = array();
        $order_info = DB::table('purchase_order_info')
                ->select()
                ->where('auto_invoice_no', $auto_invoice)
                ->where('po_info_id', $data_id)
                ->get();
        $supplier_info = DB::table('supplier')
                ->select()
                ->where('supplier_id', $order_info[0]->supplier_id)
                ->get();        
                

        $order_item = DB::table('po_info_item')
                ->select()
                ->where('auto_invoice_no', $auto_invoice)
                ->where('po_info_id', $data_id)
                ->get();
        foreach($order_item as $item) {          
          array_push($product_item_ids, $item->product_info_id);
        }

        $order_product_info = DB::table('product_info')
                ->select()
                ->whereIn('product_info_id', $product_item_ids)
                ->get();
        foreach($order_product_info as $product) {
          $allInfo = array();
          $allInfo['product_info_id'] = $product->product_info_id;
          $allInfo['title'] = $product->title;
          $allInfo['description'] = $product->description;
          $allInfo['model'] = $product->model;
          $allInfo['brand'] = $product->brand;
          $allInfo['info_entry_date'] = $product->info_entry_date;
          $allInfo['image'] = $product->image;
          $allInfo['entry_by'] = $product->entry_by;
          $allInfo['updated_by'] = $product->updated_by;
          $allInfo['created_at'] = $product->created_at;
          $allInfo['updated_at'] = $product->updated_at;
          $products_information[$product->product_info_id] = $allInfo;
        }
        
        $data['status'] = true;
        $data['order_info'] = $order_info;
        $data['order_item'] = $order_item;
        $data['products_information'] = $products_information;
        $data['supplier_info'] = $supplier_info;


        // $productArr = array();
        // $product_info = DB::table('product_info')
        //         // ->select('product_info_id', 'title')
        //         ->select()
        //         ->get();
        // foreach($product_info as $product) {
        //   $allInfo = array();
        //   $allInfo['title'] = $product->title;
        //   $allInfo['description'] = $product->description;
        //   $allInfo['model'] = $product->model;
        //   $allInfo['brand'] = $product->brand;
        //   $allInfo['info_entry_date'] = $product->info_entry_date;
        //   $allInfo['image'] = $product->image;
        //   $allInfo['entry_by'] = $product->entry_by;
        //   $allInfo['updated_by'] = $product->updated_by;
        //   $allInfo['created_at'] = $product->created_at;
        //   $allInfo['updated_at'] = $product->updated_at;

        //   $productArr[$product->product_info_id] = $allInfo;
        // }
        // $data['productArr'] = $productArr;

        return response()->json($data);
      }

      
      public function po_store_item_details(Request $req) {
        $auto_invoice_no = $req->auto_invoice_no;
        $data = array();
        $po_info = DB::table('purchase_order_info')
                      ->select()
                      ->where('auto_invoice_no', $auto_invoice_no)
                      ->get();
        
        if($po_info != NULL && count($po_info) > 0) {
          $data['po_invoice_items'] = array();

          $data['purchase_invoice'] = $po_info[0]->purchase_invoice_no;
          $data['buyer_adnl_cost'] = $po_info[0]->buyer_adnl_cost;
          $data['supplier_adnl_cost'] = $po_info[0]->supplier_adnl_cost;
          $data['supplier_adnl_cost'] = $po_info[0]->supplier_adnl_cost;
          // $data['is_stored'] = $po_info[0]->is_stored;
          // $data['payment_status'] = $po_info[0]->paid_or_due;
          if($po_info[0]->is_stored == 0) {
            $data['is_stored_text'] = "No";
          } elseif($po_info[0]->is_stored == 1) {
            $data['is_stored_text'] = "Yes";
          } else {
            $data['is_stored_text'] = "Invalid";
          }
          if($po_info[0]->paid_or_due == 0) {
            $data['payment_status_text'] = "Partial Payment";
          } elseif($po_info[0]->paid_or_due == 1) {
            $data['payment_status_text'] = "Full Due";
          } elseif($po_info[0]->paid_or_due == 2) {
            $data['payment_status_text'] = "Full Paid";
          } else {
            $data['payment_status_text'] = "Invalid Status";
          }
          
          $data['purchased_date'] = date("d/m/Y", strtotime(str_replace("/", "-", $po_info[0]->purchased_date)));
          $data['sub_total'] = $po_info[0]->sub_total;
          $data['vat_percent'] = $po_info[0]->vat_percent + 0;
          $data['vat_amount'] = $po_info[0]->vat_amount;
          $data['grand_total'] = $po_info[0]->grand_total;
          $data['due_amount'] = $po_info[0]->due_amount;
          $data['paid_amount'] = $po_info[0]->paid_amount;
          // $data['supplier_id'] = $po_info[0]->supplier_id;
          $supplier = DB::table('supplier')
                      ->select('supplier_name')
                      ->where('supplier_id', $po_info[0]->supplier_id)
                      ->get();
          if($supplier != NULL && count($supplier) == 1) {
            $data['supplier_name'] = $supplier[0]->supplier_name;
          }

          $po_info_item = DB::table('po_info_item')
                        ->select()
                        ->where('auto_invoice_no', $auto_invoice_no)
                        ->get();
          $i= 1;
          foreach ($po_info_item as $info) {
            $single_item = array();
            $single_item['serial'] = $i;
            $single_item['product_info_id'] = $info->product_info_id;
            $single_item['image'] = $info->image;
            $single_item['product_qty'] = $info->product_qty;
            $single_item['unit_price'] = $info->unit_price;
            $single_item['unit_adnl_price'] = $info->unit_adnl_price;
            $single_item['sale_price'] = $info->sale_price;
            $single_item['total_price'] = $info->total_price;
            $single_item['po_info_item_id'] = $info->po_info_item_id;
            $single_item['auto_invoice_no'] = $info->auto_invoice_no;

            $product_info = DB::table('product_info')
                        ->select()
                        ->where('product_info_id', $info->product_info_id)
                        ->get();
            foreach ($product_info as $pf) {
              $single_item['product_name'] = $pf->title;
              $single_item['model'] = $pf->model;
              $single_item['brand'] = $pf->brand;
            }
            $i++;
            array_push($data['po_invoice_items'], $single_item);
          }
          $data['status'] = true;
          return response()->json($data);
        } else {
          $data['status'] = false;
          return response()->json($data);
        }
      }
}


