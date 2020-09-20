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
            <!-- <h2 class="text-center">Purchase Order Details</h2>
            <button type="button" class="close close-order-details" aria-label="Close" onclick="close_po()">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="pofield_set">
                <div class="bar"></div>
                <div class="po-head">
                    <div class="po-labels">Supplier Name</div>
                    <div class="po-labels" id="po-supplier-name">xxx</div>
                    <div class="po-labels">Supplier Cost</div>
                    <div class="po-labels" id="po-supplier-cost">25.00</div>

                    <div class="po-labels">Invoice Number</div>
                    <div class="po-labels" id="po-invoice-no">1445</div>
                    <div class="po-labels">Buyer Cost</div>
                    <div class="po-labels" id="po-buyer-cost">45</div>

                    
                    <div class="po-labels">Purchase Date</div>
                    <div class="po-labels" id="po-purchase-date">12/12/20</div>
                    <div class="po-labels">Product Cost</div>
                    <div class="po-labels" id="po-product-cost">4545</div>
                    <div class="po-labels">Total Product Quantity</div>
                    <div class="po-labels" id="po-total-quantity">454</div>
                    <div class="po-labels">Total Cost</div>
                    <div class="po-labels" id="po-total-cost">4545</div>
                </div>
                <div class="po-table">
                    <table class="po-details-tbl">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Quantity</th>
                                <th>Product Price</th>
                                <th>With Additional Cost</th>
                                <th>Sale Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Product Title</td>
                                <td>Quantity</td>
                                <td>Product Price</td>
                                <td>Witd Additional Cost</td>
                                <td>Sale Price</td>
                                <td>Total</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="po-footer">
                        <button type="button" class="btn btn-outline-danger po-close-btn" onclick="close_po()">Close</button>
                    </div>                        
                </div>
            </div> -->
          </div>
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