<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
  public function order_entry(){
  	echo "In entry";
  }
	public function order_view(){
		echo "In view";
	}
}
