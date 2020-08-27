<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
      return view('product.product_info_entry');
    }
    public function product_save(Request $request)
    {

        $data = array();
        $data['title'] = "";
        $data['description'] = "";
        $data['model'] = "";
        $data['brand'] = "";
        $data['info_entry_date'] = "";
        $data['entry_by'] = "";
        $data['created_at'] = "";

        $save_update_txt = $request->save_update;
        $before_img_name = $request->before_img_name;
        $update_id = $request->update_id;
        // $orgDate = $request->info_entry_date;
        // $changeSeparator = str_replace('/', '-', $orgDate);  
        // $newDate = date("Y-m-d", strtotime($changeSeparator));
        $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->info_entry_date)));

        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['model'] = $request->model;
        $data['brand'] = $request->brand;
        // $data['info_entry_date'] = $request->info_entry_date;
        $data['info_entry_date'] = $newDate;
        // $data['image'] = $request->image;        
        $data['entry_by'] = $request->entry_by;        
        
        // echo "<pre>";
        // print_r($data);
        // var_dump($data);
        // echo "</pre>";
        if($save_update_txt == "Save") {
          $data['created_at'] = date('Y-m-d H:i:s');
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
        }
        return Redirect::to('/product/view');
    }

    public function product_delete(Request $request)
    {
      if($request->deleteBtn == "Delete") {
        $product_del_id = $request->product_del_id;
        $image_del_path = $request->image_del_path;
        // var_dump($image_del_path);
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
      }
      return Redirect::to('/product/view');
    }

    public function product_view()
    {
      $product_info = DB::table('product_info')
                ->orderBy('product_info_id', 'desc')               
                ->get();
      return view('product.product_info_lists')->with('product_info', $product_info);
    }
    public function product_update_process(Request $request) {
      $product_info_id = $request->id;
      $product_info_single = DB::table('product_info')               
                ->where('product_info_id', $product_info_id)->first();
      return view('product.product_info_update')->with("product_info_single", $product_info_single);
    }
    public function update_product(Request $request) {
      //update product
        $data = array();
        $data['title'] = "";
        $data['description'] = "";
        $data['model'] = "";
        $data['brand'] = "";
        $data['info_entry_date'] = "";
        $data['entry_by'] = "";
        $before_img_name = $request->before_img_name;
        $update_id = $request->update_id;
        // $orgDate = $request->info_entry_date;
        // $changeSeparator = str_replace('/', '-', $orgDate);  
        // $newDate = date("Y-m-d", strtotime($changeSeparator));
        $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->info_entry_date)));

        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['model'] = $request->model;
        $data['brand'] = $request->brand;
        // $data['info_entry_date'] = $request->info_entry_date;
        $data['info_entry_date'] = $newDate;
        // $data['image'] = $request->image;
        
        $data['entry_by'] = $request->entry_by;        
        
        // echo "<pre>";
        // print_r($data);
        // var_dump($data);
        // echo "</pre>";
          $data['updated_at'] = date('Y-m-d H:i:s');
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
            echo "Product is not update.";
          }
    }

    //start purchase order
      public function purchase_order_entry(){
        $supplier_info = DB::table('supplier')
                ->select('supplier_id', 'supplier_name')               
                ->get();
        $product_info = DB::table('product_info')
                ->select('product_info_id', 'title')               
                ->get();
        return view('product.product_purchase_entry')
                    ->with("supplier_info", $supplier_info)
                    ->with("product_info", $product_info);
      }
      public function purchase_order_save(Request $request) {
        $data = array();
        $data['is_stored'] = 0;
        $data['supplier_id'] = "";
        $data['product_info_id'] = "";
        $data['purchase_invoice_no'] = "";
        $data['product_qty'] = "";
        $data['total_bill'] = "";
        $data['vat'] = "";
        $data['discount'] = "";
        $data['paid_or_due'] = "";
        $data['paid_amount'] = "";
        $data['due_amount'] = "";
        $data['purchased_date'] = "";
        $data['comments'] = "";
        $data['entry_by'] = "";

        // $orgDate = $request->info_entry_date;
        // $changeSeparator = str_replace('/', '-', $orgDate);  
        // $newDate = date("Y-m-d", strtotime($changeSeparator));
        $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->purchased_date)));

        $data['supplier_id'] = $request->supplier_id;
        $data['product_info_id'] = $request->product_info_id;
        $data['purchase_invoice_no'] = $request->purchase_invoice_no;
        $data['product_qty'] = $request->product_qty;
        $data['total_bill'] = $request->total_bill;
        $data['vat'] = $request->vat;
        $data['discount'] = $request->discount;
        $data['paid_or_due'] = $request->paid_or_due;
        $data['paid_amount'] = $request->paid_amount;
        $data['due_amount'] = $request->due_amount;
        // $data['purchased_date'] = $request->purchased_date;
        $data['purchased_date'] = $newDate;
        $data['comments'] = $request->comments;
        $data['entry_by'] = $request->entry_by;
        
        DB::table('purchase_order_info')
                  ->insert($data);

        Session::put('sucMsg', 'A Purchase Information Saved Successfully!');
        return Redirect::to('/product/purchase_order/view');
      }
      public function purchase_order_view(){
        $spplierArr = array();
        $productArr = array();
        $purchase_order_info = DB::table('purchase_order_info')
                ->orderBy('po_info_id', 'desc')
                ->get();
        $supplier_info = DB::table('supplier')
                ->select('supplier_id', 'supplier_name')  
                ->get();
        $product_info = DB::table('product_info')
                ->select('product_info_id', 'title')  
                ->get();
        
        foreach($supplier_info as $supplier) {
          $spplierArr[$supplier->supplier_id] = $supplier->supplier_name;
        }
        foreach($product_info as $product) {
          $productArr[$product->product_info_id] = $product->title;
        }
        // echo "<pre>";
        // var_dump($productArr);
        // echo $productArr['1'];

        return view('product.product_purchase_lists')
                    ->with("purchase_order_info", $purchase_order_info)
                    ->with("spplierArr", $spplierArr)
                    ->with("productArr", $productArr);
      }
      public function purchase_order_delete(Request $request) {
        $po_info_id = $request->po_info_id;
        DB::table('purchase_order_info')
                ->where('po_info_id', $po_info_id)
                ->delete();

        Session::put('sucMsg', 'A Purchase Order Info Deleted Successfully!');
        return Redirect::to('/product/purchase_order/view');
      }
      public function purchase_order_update_process(Request $request) {
        $po_info_id = $request->id;
        $purchase_order_info_single = DB::table('purchase_order_info')
                  ->where('po_info_id', $po_info_id)->first();
        $supplier_info = DB::table('supplier')
                ->select('supplier_id', 'supplier_name')  
                ->get();
        $product_info = DB::table('product_info')
                ->select('product_info_id', 'title')  
                ->get();

        return view('product.product_purchase_update')
                    ->with("purchase", $purchase_order_info_single)
                    ->with("supplier_info", $supplier_info)
                    ->with("product_info", $product_info);
      }
      public function update_purchase_order(Request $request) {
        $data = array();        
        $po_info_id = $request->po_info_id;

        // $data['is_stored'] = 0;
        $data['supplier_id'] = "";
        $data['product_info_id'] = "";
        $data['purchase_invoice_no'] = "";
        $data['product_qty'] = "";
        $data['total_bill'] = "";
        $data['vat'] = "";
        $data['discount'] = "";
        $data['paid_or_due'] = "";
        $data['paid_amount'] = "";
        $data['due_amount'] = "";
        $data['purchased_date'] = "";
        $data['comments'] = "";
        $data['entry_by'] = "";

        // $orgDate = $request->info_entry_date;
        // $changeSeparator = str_replace('/', '-', $orgDate);  
        // $newDate = date("Y-m-d", strtotime($changeSeparator));
        $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->purchased_date)));


        $data['supplier_id'] = $request->supplier_id;
        $data['product_info_id'] = $request->product_info_id;
        $data['purchase_invoice_no'] = $request->purchase_invoice_no;
        $data['product_qty'] = $request->product_qty;
        $data['total_bill'] = $request->total_bill;
        $data['vat'] = $request->vat;
        $data['discount'] = $request->discount;
        $data['paid_or_due'] = $request->paid_or_due;
        $data['paid_amount'] = $request->paid_amount;
        $data['due_amount'] = $request->due_amount;
        // $data['purchased_date'] = $request->purchased_date;
        $data['purchased_date'] = $newDate;
        $data['comments'] = $request->comments;
        $data['entry_by'] = $request->entry_by;
        
        DB::table('purchase_order_info')
                  ->where('po_info_id', $po_info_id)
                  ->update($data);

        Session::put('sucMsg', 'A Purchase Information Updated Successfully!');
        return Redirect::to('/product/purchase_order/view');
      }
    //end purchase order

    //Start Store In
      public function store_in_entry() {
        $productArr = array();
        $purchase_order_info = DB::table('purchase_order_info')
                // ->select('po_info_id', 'product_info_id', 'purchase_invoice_no','product_qty','total_bill')
                ->select('po_info_id', 'purchase_invoice_no', 'purchased_date')
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
        // echo "Hi";
        // $validatedData = $request->validate([
        //   'purchase_order_info_id' => 'required|numeric',
        //   // 'product_info_id' => 'required|numeric',
        //   'buy_price' => 'required|numeric',
        //   'comments' => 'min:0|max:200|string',
        //   'barcode' => 'min:5|max:100|string'
        // ]);
        // exit();
        $data = array();
        $data['is_stored'] = '0';
        $data['purchase_order_info_id'] = "";
        $data['product_info_id'] = "0";
        $data['barcode'] = "";
        $data['quantity'] = '1';
        $data['buy_price'] = "";
        $data['buy_date'] = "";
        $data['comment'] = "";
        $data['entry_by'] = "";
        $data['created_at'] = date('Y-m-d H:i:s');

        
        $newDate = date("Y-m-d", strtotime(str_replace('/', '-', $request->buy_date)));
        $purchase_order_info_id = $request->purchase_order_info_id;
        $product_info_id = $request->product_info_id;
        $barcode = $request->barcode;
        $buy_price = $request->buy_price;
        $buy_date = $request->buy_date;
        $comment = $request->comment;
        if($purchase_order_info_id != null) {
          $data['purchase_order_info_id'] = $purchase_order_info_id;
        }
        if($product_info_id != null) {
          $data['product_info_id'] = $product_info_id;
        }
        if($barcode != null) {
          $data['barcode'] = $barcode;
        }
        if($buy_price != null) {
          $data['buy_price'] = $buy_price;
        }
        if($buy_date != null) {
          $data['buy_date'] = $buy_date;
        }
        if($comment != null) {
          $data['comment'] = $comment;
        }
        echo "<pre>";
        var_dump($data);
        // $data['purchase_order_info_id'] = $request->purchase_order_info_id;
        // // $data['product_info_id'] = $request->product_info_id;
        // $data['barcode'] = $request->barcode;
        // $data['buy_price'] = $request->buy_price;
        
        // // $data['buy_date'] = $request->buy_date;
        // $data['buy_date'] = $newDate;
        // $data['comment'] = $request->comment;
        // // $data['entry_by'] = $request->entry_by;
        
        // DB::table('product_purchase_history')
        //           ->insert($data);

        // Session::put('sucMsg', 'A Product Stored Successfully!');
        // return Redirect::to('/product/store_in/view');
      }
      public function store_in_view() {
        $pp_history = DB::table('product_purchase_history')
                ->orderBy('pp_history_id', 'desc')
                ->get();
        $productArr = array();
        $product_info = DB::table('product_info')
                ->select('product_info_id', 'title')  
                ->get();
                
        foreach($product_info as $product) {
          $productArr[$product->product_info_id] = $product->title;
        }
        return view('product.store_in_lists')
                  ->with("pp_history", $pp_history)
                  ->with("productArr", $productArr);
      }
    // End Store In


}


