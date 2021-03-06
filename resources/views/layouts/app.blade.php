<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- <title>{{ config('app.name', 'xxx') }}a</title> -->
        <title>{{ $title ?? '' }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <link type="text/css" href="{{ asset('ourwork') }}/css/jquery-ui.css" rel="stylesheet">
        <link type="text/css" href="{{ asset('ourwork') }}/css/all.styles.css" rel="stylesheet">

    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>
        <div class="popupCon" id="purchase_order_details">
          <div class="order-details">
            <div class="head-details">
              <h2 class="text-center">NA/NA/NA/NA/NA/NA/NA/NA</h2>
              <button type="button" class="close close-order-details" aria-label="Close" onclick="close_po()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="head-body">
              <!-- Content Here -->
              <!-- <div class="pofield_set">
                <div class="bar"></div>
                <div class="addcustomer-con">
                  <div class="row">
                    <div class="col-md-12" style="padding: 20px 40px;">
                      <form action="/customer/entry" method="post" class="form-horizontal">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input type="text" name="fromWhere" value="sale">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="customer_name">Customer Name</label>
                              <input type="text" class="form-control allowNumbersOnly" id="customer_name" name="customer_name" placeholder="Customer Name">
                            </div>
                            <div class="form-group">
                              <label for="phone">Phone</label>
                              <input type="text" class="form-control allowNumbersOnly" id="phone" name="phone" placeholder="Phone No">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="company_name">Company Name</label>
                              <input type="text" class="form-control allowNumbersOnly" id="company_name" name="company_name" placeholder="Compnay Name">
                            </div>
                            <div class="form-group">
                              <label for="address">Address</label>
                              <input type="text" class="form-control allowNumbersOnly" id="address" name="address" placeholder="Address">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group subres">
                              <input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtnCustomer" value="Save"/>
                              <input type="button" class="btn btn-outline-danger" id="reset_cancel_customer" value="Reset"/>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>               
                </div>
              </div> -->
            </div>
            <!-- <div class="head-footer">                
              <div class="po-footer">
                <button type="button" class="btn btn-outline-danger po-close-btn" onclick="close_po()">Close</button>
              </div>
            </div> -->
          </div>
        </div>
        <div class="popupCon" id="yesNoAlert">
          <div class="allalertCon">
            <button type="button" class="close close-alert-top" aria-label="Close" onclick="$(this).closest('#yesNoAlert').fadeOut();">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="alertHead">
              ALERT !!!
            </div>
            <div class="alertBody">
              Are you sure?
            </div>
            <div class="alertFoot">
              <span id="alertYes">
                <button type="button" class="btn btn-outline-success">Yes</button>
              </span>              
              <button type="button" class="btn btn-outline-danger" onclick="$(this).closest('#yesNoAlert').fadeOut();">Cancel</button>
            </div>
          </div>
        </div>
        <div id="print_div">
          <!-- <div class="print-continer">
            <div class="print-top-head">
              <div class="print-invoice-no">Invoice: SOI-00001</div>
              <div class="print-date">July 18, 2020 05:03</div>
            </div>
            <div class="print-shop-name">Akash Router Shop</div>
            <div class="print-shop-address">450, East Rampura, Dhaka-1219, Mobile: 01727379068</div>
            <hr style="border-top: 3px solid rgba(0,0,0, .7); margin: 10px 0px 10px 0px;">
            <div class="print-info">
              <div class="print-customer-name"><span class="info-p">Customer Name: </span></div>
              <div class="print-customer-mobile"><span class="info-p">Mobile: </span></div>
            </div>
            <table class="print-invoice-tbl">
              <thead>
                <tr>
                  <th>Sl</th>
                  <th>Product Name</th>
                  <th>Model</th>
                  <th>Brand</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align: center;">1</td>
                  <td>Tp Link Router R8</td>
                  <td>M126575</td>
                  <td>TP Link</td>
                  <td>1</td>
                  <td>1450</td>                  
                  <td>1450</td>
                </tr>
                <tr>
                  <td style="text-align: center;">1</td>
                  <td>Tp Link Router R8</td>
                  <td>M126575</td>
                  <td>TP Link</td>
                  <td>1</td>
                  <td>1450</td>                  
                  <td>1450</td>
                </tr>
                <tr>
                  <td style="text-align: center;">1</td>
                  <td>Tp Link Router R8</td>
                  <td>M126575</td>
                  <td>TP Link</td>
                  <td>1</td>
                  <td>1450</td>                  
                  <td>1450</td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="footer-line">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td style="text-align: right;">Total Qty = </td>
                  <td>5</td>
                  <td></td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
            <div class="print-hisab-left-con">
              <div class="amount-inword">asdfasdf</div>
            </div>
            <div class="print-hisab-con">
              <div class="print-indivi">
                <div class="print-left">Total</div>
                <div class="print-right">500.00 Tk</div>
              </div>
              <div class="print-indivi">
                <div class="print-left">Discount</div>
                <div class="print-right">50.00 Tk</div>
              </div>
              <div class="print-indivi">
                <div class="print-left">Netsale</div>
                <div class="print-right">450.00 Tk</div>
              </div>
              <div class="print-indivi">
                <div class="print-left">Vat (5%)</div>
                <div class="print-right">22.50 Tk</div>
              </div>
              <div class="print-indivi">
                <div class="print-left">Grand Total</div>
                <div class="print-right">472.50 Tk</div>
              </div>
              <div class="print-indivi">
                <div class="print-left">Paid</div>
                <div class="print-right">400.00 Tk</div>
              </div>
              <div class="print-indivi">
                <div class="print-left">Due</div>
                <div class="print-right">72.50 Tk</div>
              </div>
            </div>
          </div> -->
        </div>
        
        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <!-- <script src="{{ asset('ourwork') }}/js/jquery-3.5.1.js"></script> -->
        <script src="{{ asset('ourwork') }}/js/jquery-ui.js"></script>
        <script src="{{ asset('ourwork') }}/js/all.scripts.js"></script>
        
        @stack('js')        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>