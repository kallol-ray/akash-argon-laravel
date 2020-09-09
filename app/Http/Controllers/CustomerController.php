<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
  public function ready_entry()
  {
  	return view('customer.customer_entry');	
  }
  public function view_entry()
  {
    echo "in view.";		
  }
}
