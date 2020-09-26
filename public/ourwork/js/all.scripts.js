// purchase order entry
var scannedItem = [];
var i = 0;
var totalQty = 0;
var suplierCost = 0;
var companyCost = 0;
var additionalCost = 0;
var product_subtotal = 0;
// var productUnitQty = {};

//Sale entry
var scannedSaleBarcode = [];
//Alert Status
var isClickWork = false;




function set_entry_date() {
	$("#info_entry_date").datepicker({
		dateFormat: 'dd/mm/yy'
	}).datepicker("setDate", new Date());
	$("#info_entry_date_update").datepicker({
		dateFormat: 'dd/mm/yy'
	});
}
set_entry_date();

// function update_product(event) {
	// 	let data_id = $(event.target).closest("tr").attr("data-id");
	// 	let tbl_title = $(event.target).closest("tr").find("td.tbl_title").text();
	// 	let tbl_desc = $(event.target).closest("tr").find("td.tbl_desc").text();
	// 	let tbl_model = $(event.target).closest("tr").find("td.tbl_model").text();
	// 	let tbl_brand = $(event.target).closest("tr").find("td.tbl_brand").text();
	// 	let tbl_image_source = $(event.target).closest("tr").find("td.tbl_image img").attr("src");
	// 	let tbl_image_name = $(event.target).closest("tr").find("td.tbl_image img").attr("img-name");

	// 	let tbl_entry_date = $(event.target).closest("tr").find("td.tbl_entry_date").text();
	// 	let tbl_entry_by = $(event.target).closest("tr").find("td.tbl_entry_by").text();
	// 	console.log(tbl_image_name);
	// 	console.log(tbl_image_source);

	// 	$("#info_entry_date").val(tbl_entry_date);
	// 	$("#title").val(tbl_title);
	// 	$("#description").text(tbl_desc);
	// 	$("#model").val(tbl_model);
	// 	$("#brand").val(tbl_brand);
	// 	$("#before_img_name").val(tbl_image_name);
	// 	$("#uploadImagePreview").attr("src", tbl_image_source);

	// 	$("#entry_by").val(tbl_entry_by);
	// 	$("#update_id").val(data_id);
	// 	$("#saveBtn").val("Update");
	// 	$("#reset_cancel").val("Cancel");
// }
$("#reset_product_entry").click(function(){
	set_entry_date();
	// $("#update_id").val("");
	$("#title").val("");
	$("#description").val("");
	$("#imageToUpload").val("");
	$("#model").val("");
	$("#brand").val("");
	$("#uploadImagePreview").attr("src","");
});
function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#uploadImagePreview').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]); // convert to base64 string
	}
}

$("#imageToUpload").change(function() {
	readURL(this);
});

function msgAlertAutoHide() {
	if($(".msgAlert .alert").is(":visible")) {
      setTimeout(function(){
          $(".msgAlert .alert").fadeOut("slow");
      }, 2000);
  }
}
$( document ).ready(function() {
   msgAlertAutoHide(); 
});


function set_supply_entry_date() {
	$("#supplier_entry_date").datepicker({
		dateFormat: 'dd/mm/yy'
	}).datepicker("setDate", new Date());
	$("#supplier_entry_date_update").datepicker({
		dateFormat: 'dd/mm/yy'
	});
}
set_supply_entry_date();

$("#reset_cancel_supplier").click(function(){
	set_supply_entry_date();
	$("#supplier_name").val("");
	$("#phone").val("");
	$("#imageToUpload").val("");
	$("#address").val("");
	$("#comments").val("");
	$("#entry_by").val("");
});

function set_purchased_date() {
	$("#purchased_date").datepicker({
		dateFormat: 'dd/mm/yy'
	}).datepicker("setDate", new Date());
	$("#purchased_date_update").datepicker({
		dateFormat: 'dd/mm/yy'
	});
}
set_purchased_date();
$("#reset_cancel_purchase").click(function(){
	set_purchased_date();
	$("#supplier_id").val("");
	$("#product_info_id").val("");
	$("#buyer_addtional_costs").val("0");
	$("#supplier_additional_cost").val("0");
	$("#paid_or_due").val("");	
	$("#purchase_invoice_no").val("N/A");
	$("#paid_amount").val("0");
	$("#due_amount").val("0");

	$("#sub_total").val("0.00");
	$("#vat_amount").val("0.00");
	$("#suppliercost_final").text("0.00");
	$("#companycost_final").text("0.00");
	$("#grand_total").val("0.00");	
	$("#order_entry_item").find("tr.itemRow").remove();
	scannedItem = [];
});
$("#reset_cancel_store").click(function(){
	$("#po_auto_invoice").val("");	
	$("#invoiceNoErr").text("");
	$("#productNotFoundErr").text("");
	$("#barcode").val("");
	$("#current_item_entry").text("0");
	$("#total_current_item_no").text("0");
	$("#entry_no_now").text("0");
	$("#total_product_no").text("0");
	$('#product_info_id_frm_stock option').filter(function() {
	  return $.trim(this.value).length != 0;
	  // return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
	}).remove();
	$("#product_info_id_frm_stock").val("");
});

$(document).on("change", "#product_info_id", function() {
	let product_info_id = this.value;
	var i = $(".itemRow").length;
	let rows = $(".itemRow");
	$(rows).each(function(k,v) {
		//it works on update time
		let has_attr_update = $(this).attr('update');
    if (typeof has_attr_update !== typeof undefined && has_attr_update !== false) {
      let pid = $(v).attr('data-product-info-id');
      if($.inArray(pid, scannedItem) == -1) {
      	scannedItem.push($(v).attr('data-product-info-id'));
      }      
    }
  });
	// console.log(rows);
	if(product_info_id != '') {
		// console.log(scannedItem.indexOf(product_info_id));
		if(scannedItem.indexOf(product_info_id) == -1) {
			$("#product_list_err").text("");
			scannedItem.push(product_info_id);
	 		let title = $(this).find('option:selected').attr("title");
	 		let image = $(this).find('option:selected').attr("image");
	 		console.log("image", image);
			let html = '<tr class="itemRow" data-product-info-id="'+product_info_id+'">' +
	                  '<td align="center"><img src="/ourwork/img/product_image/'+image+'" class="order_product_img"></td>'+
	                  '<td>'+title+'</td>'+
	                  '<td>'+
	                  	'<input type="hidden" name="product_info_id[]" value="'+product_info_id+'">'+
	                  	'<input type="hidden" name="image[]" value="'+image+'">'+
	                        // pattern="[0-9]+([.,][0-9]+)?"
	                  	'<input type="text" name="quantity[]" id="qty_'+i+'" step="1" required placeholder="Quantity" class="order_input inp_quantity allowNumbersOnly" min="1">'+
	                  '</td>'+
	                  '<td><input type="text" name="unit_price[]" id="purchaseprice_'+i+'" onblur="setpurchasePrice('+i+',this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="1" required placeholder="Unit Price"  class="order_input inp_unit_price allowNumbersOnly"></td>'+
	                  '<td><input type="text" name="additional_price[]" id="withadditional_'+i+'" class="order_input inp_additional_price allowNumbersOnly" placeholder="Additional Price" required readonly></td>'+
	                  '<td><input type="text" name="sale_price[]" class="order_input inp_sale_price allowNumbersOnly" placeholder="Sale Price" required></td>'+
	                  '<td><input type="text" name="total_price[]" id="total_'+i+'" class="order_input inp_total_price allowNumbersOnly" placeholder="Total Price" required readonly></td>'+
	                  '<td align="center"><img src="/ourwork/img/icon/delete-icon.png" class="delet-icon" onclick="remove_list(this, event)"></td>'+
	                '</tr>';
	        $("#order_entry_item tbody").append(html);
	        $(this).val("");
		} else {
			$("#product_list_err").text("The item already added.");
		}		
	} else {
		$("#product_list_err").text("");
	}
});

// $('#order_entry_item tbody .inp_quantity').on('keyup change',function(e){
//     calculate();
// });

function calculate(){
    suplierCost = $("#buyer_addtional_costs").val();
    companyCost = $("#supplier_additional_cost").val();

    var totalCost = parseFloat(suplierCost)+parseFloat(companyCost)
    totalQty = 0;

    $('.inp_quantity').each(function(k,v) {
        if($(v).val() != ''){
            totalQty = totalQty+parseFloat($(v).val());
        }
    });

    if(totalQty>0){
        additionalCost = totalCost.toFixed(2)/totalQty;
    }else{
        additionalCost = totalCost;
    }
}

function setpurchasePrice(key, elem) {
    calculate();

    var purchaseprice = parseFloat($(elem).val()).toFixed(2);
    var qt = parseFloat($("#qty_"+key).val()).toFixed(2);

    if(purchaseprice != NaN && qt != NaN ){
        var pCostWithAddi = parseFloat(purchaseprice)+parseFloat(additionalCost);
    }else{
        var pCostWithAddi = parseFloat(additionalCost).toFixed(2);
    }

    var totalValue = parseFloat(purchaseprice)*parseFloat(qt);

    $("#withadditional_"+key).val(pCostWithAddi.toFixed(2));
    $("#total_"+key).val(totalValue.toFixed(2));
    calculateTotal();
}

function calculateTotal(){
  product_subtotal = 0;
  // console.log(suplierCost);
  // console.log(companyCost);
  if(suplierCost == '0' && companyCost == '0') {
  	// onupdate time it works
  	suplierCost = $("#buyer_addtional_costs").val();
  	companyCost = $("#supplier_additional_cost").val();
  }

  $('.inp_total_price').each(function(k,v) {
    if($(v).val() != ''){
      product_subtotal = product_subtotal+parseFloat($(v).val());
    }
  });

  $("#sub_total").val(parseFloat(product_subtotal).toFixed(2));
  $("#suppliercost_final").text(parseFloat(suplierCost).toFixed(2));
  // var companycost_final = parseFloat(transport_cost)+parseFloat(cnf_cost)+parseFloat(labour_cost);
  $("#companycost_final").text(parseFloat(companyCost).toFixed(2));
  var vat_percent = $("#vat_percent").val();
  // console.log("vat_percent", vat_percent);
  var vat_amount = parseFloat((product_subtotal * vat_percent)/100).toFixed(2);
  // console.log("vat_amount", vat_amount);
  $("#vat_amount").val(vat_amount);

  var grand_total = parseFloat(product_subtotal)+parseFloat(suplierCost)+parseFloat(companyCost)+parseFloat(vat_amount);
  $("#grand_total").val(parseFloat(grand_total).toFixed(2));
}

$(document).on('input', '.allowNumbersOnly', function(event) {
// $('.allowNumbersOnly').keyup(function(event) {
	// console.log($(event.target).val());
	// // ^[0-9]+\.[0-9][0-9]$
	// let checkDot = 0;
	console.log("kallol", event.which);
  // if (event.which == 46) {
  // 	// $(this).val().indexOf('.') != -1
  // 	if(checkDot ==0) {
  // 		checkDot++;
  // 	} else {
  // 		event.preventDefault();
  // 	}
  // }else {
  //   if(event.which < 48 || event.which > 57) {
  //   	event.preventDefault();
  //   }
  // }
});

function remove_list(elm, event) {
	let product_id = $(elm).closest('tr').attr("data-product-info-id");
	console.log(product_id);
	$("#product_list_err").text("");
	removeItemOnce(scannedItem, product_id);
	$(elm).closest('tr').remove();
	console.log(scannedItem);


	if($('#order_entry_item tbody').find("tr.itemRow").length > 0) {
		$('#order_entry_item tbody')
			.children('tr:first')
			.find("td")
			.find("[id^=purchaseprice]")
			.trigger("blur");
		// console.log(row);
	} else {
		$("#sub_total").val("0.00");
		$("#vat_percent").val("5");
		$("#vat_amount").val("0.00");
		$("#suppliercost_final").text(parseFloat($("#buyer_addtional_costs").val()).toFixed(2));
		$("#companycost_final").text(parseFloat($("#supplier_additional_cost").val()).toFixed(2));
		$("#grand_total").val("0.00");
	}
}

$(document).on("input", "#buyer_addtional_costs", function(){
	if($(this).val() == "") {
		$("#company_cost_view").html("0.00");
	} else {
		$("#company_cost_view").html(parseFloat($(this).val()).toFixed(2));
	}
});
$(document).on("input", "#supplier_additional_cost", function(){
	if($(this).val() == "") {
		$("#supplyer_cost_view").html("0.00");
	} else {
		$("#supplyer_cost_view").html(parseFloat($(this).val()).toFixed(2));
	}
});

function removeItemOnce(arr, value) {
  var index = arr.indexOf(value);
  if (index > -1) {
    arr.splice(index, 1);
  }
  return arr;
}
function close_po() {
	$("#purchase_order_details").hide();
}
function order_details(auto_invoice, data_id) {
	// console.log(auto_invoice, data_id);
	$.ajax({			
		url: "/product/purchase-order/details",
		type: "POST",
		// cache: false,
		data: {
			'_token': $("meta[name='csrf-token']").attr('content'),
			'auto_invoice': auto_invoice,
			'data_id': data_id
		},
		dataType: "json",
		// headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
		success: function(data, textStatus, xhr){				
			if(xhr.status) {
				console.log("data", data);
				// console.log("data.status", data.status);
				$("#purchase_order_details").find(".head-body").html("");
				$("#purchase_order_details").find(".head-details h2").html("Purchase Order Details");
				if(data.status) {
					let tableBody = '';
					let total_product_qty = 0;
					$.each(data.order_item, function(index, itemVal) {
					  // console.log(itemVal);
					  tableBody += '<tr>';
					  	tableBody += '<td><img src="/ourwork/img/product_image/'+itemVal.image+'" width="50px"></td>';
              tableBody += '<td>'+data.products_information[itemVal.product_info_id].title+'</td>';
              tableBody += '<td>'+itemVal.product_qty+'</td>';
              tableBody += '<td>'+itemVal.unit_price+'</td>';
              tableBody += '<td>'+itemVal.unit_adnl_price+'</td>';
              tableBody += '<td>'+itemVal.sale_price+'</td>';
              tableBody += '<td>'+itemVal.total_price+'</td>';
            tableBody += '</tr>';
            total_product_qty += parseInt(itemVal.product_qty);
					});
					var dateAr = data.order_info['0'].purchased_date.split('-');
					var purchased_date = dateAr[2] + '/' + dateAr[1] + '/' + dateAr[0];
					// var purchased_date = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0].slice(-2);

					let html = 
            '<div class="pofield_set">'+
              '<div class="bar"></div>'+
              '<div class="po-head">'+
                '<div class="po-labels">Supplier Name</div>'+
                '<div class="po-labels" id="po-supplier-name">'+data.supplier_info['0'].supplier_name+'</div>'+
                '<div class="po-labels">Supplier Cost</div>'+
                '<div class="po-labels" id="po-supplier-cost">'+data.order_info['0'].supplier_adnl_cost+'</div>'+

                '<div class="po-labels">Invoice Number</div>'+
                '<div class="po-labels" id="po-invoice-no">'+data.order_info['0'].auto_invoice_no+'</div>'+
                '<div class="po-labels">Buyer Cost</div>'+
                '<div class="po-labels" id="po-buyer-cost">'+data.order_info['0'].buyer_adnl_cost+'</div>'+

                
                '<div class="po-labels">Purchase Date</div>'+
                '<div class="po-labels" id="po-purchase-date">'+purchased_date+'</div>'+
                '<div class="po-labels">Product Cost</div>'+
                '<div class="po-labels" id="po-product-cost">'+data.order_info['0'].sub_total+'</div>'+
                '<div class="po-labels">Total Product Quantity</div>'+
                '<div class="po-labels" id="po-total-quantity">'+total_product_qty+'</div>'+
                '<div class="po-labels">Total Cost</div>'+
                '<div class="po-labels" id="po-total-cost">'+data.order_info['0'].grand_total+'</div>'+
              '</div>'+
              '<div class="po-table">'+
                '<table class="po-details-tbl">'+
                  '<thead>'+
                    '<tr>'+
                    	'<th>Image</th>'+
                      '<th>Product Title</th>'+
                      '<th>Quantity</th>'+
                      '<th>Unit Price</th>'+
                      '<th>With Additional Cost</th>'+
                      '<th>Sale Price</th>'+
                      '<th>Total</th>'+
                    '</tr>'+
                  '</thead>'+
                  '<tbody>'+
                  	tableBody +
                  '</tbody>'+
                '</table>'+
                '<div class="po-footer">'+
                  '<button type="button" class="btn btn-outline-danger po-close-btn" onclick="close_po()">Close</button>'+
                '</div>'+                        
              '</div>'+
            '</div>';
					$("#purchase_order_details").find(".head-body").append(html);
					$("#purchase_order_details").show();
				} else {
					console.log("Data Not Received Successfully Kallol.")
				}
			}
		},
		error: function (jqXHR, exception) {
			var msg = '';
			if (jqXHR.status === 0) {
			    msg = 'Not connect.\n Verify Network.';
			} else if (jqXHR.status == 404) {
			    msg = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
			    msg = 'Internal Server Error [500].';
			} else if (exception === 'parsererror') {
			    msg = 'Requested JSON parse failed.';
			} else if (exception === 'timeout') {
			    msg = 'Time out error.';
			} else if (exception === 'abort') {
			    msg = 'Ajax request aborted.';
			} else {
			    msg = 'Uncaught Error.\n' + jqXHR.responseText;
			}
			console.log("msg",msg);
		},
	});
}
$(document).on("change", "#po_auto_invoice", function() {	
	// console.log($(this).val());
	let auto_invoice = $(this).val();
	$("#productNotFoundErr").html("");	
	if(auto_invoice == "") {
		$('#product_info_id_frm_stock option').filter(function() {
		  return $.trim(this.value).length != 0;
		  // return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
		}).remove();
		$("#total_product_no").text("0");
		$("#entry_no_now").text("0");
		$("#current_item_entry").text("0");
		$("#total_current_item_no").text("0");
	} else {
		$("#invoiceNoErr").html("");
		$('#product_info_id_frm_stock option').filter(function() {
		  return $.trim(this.value).length != 0;
		  // return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
		}).remove();
		// $.ajaxSetup({
		// 	headers: {
		// 		'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
		// 	}
		// });
		// console.log("auto_invoice = ", auto_invoice);
		$.ajax({
			url: "/invoice-wise-product",
			type: "POST",
			cache: false,
			data: {
				'_token': $("meta[name='csrf-token']").attr('content'),
				auto_invoice : auto_invoice
			},
			// dataType: "html"
			success: function(data, textStatus, xhr){				
				if(xhr.status) {
					console.log("data", data);
					// console.log("length", data.length);
					if(data.product_option.length != 0) {
						$.each(data.product_option, function( k, v ) {
						  // console.log( "Key: " + k + ", Value: " + v );
							let option = '<option value="'+k+'">'+ v +'</option>';
							$("#product_info_id_frm_stock").append(option);
						});

						$("#total_product_no").text(data.count.total_qty);
						$("#entry_no_now").text(data.count.total_entry);						
					} else {
						$("#productNotFoundErr").html("No product found this voucher.");
					}					
				}
			},
			error: function (jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
				    msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
				    msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
				    msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
				    msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
				    msg = 'Time out error.';
				} else if (exception === 'abort') {
				    msg = 'Ajax request aborted.';
				} else {
				    msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				console.log(msg);
			},
		});
	}
});

function barcode_entry_product(from_where, event) {
	// console.log("from_where", from_where);
	var code = event.keyCode || event.which;
	if(from_where == "comment") {
		if(code == 13) {
			event.preventDefault();
			$("#barcode").val("").focus();
		}
	} else if(from_where == "barcode") {
		// console.log(event.which);		
		if(code == 13) {
			let po_auto_invoice = $("#po_auto_invoice").val();
			let product_info_id_frm_stock = $("#product_info_id_frm_stock").val();
			let comment = $("#comment").val();
			let barcode = $("#barcode").val();
			if($(event.target).val() != "" && po_auto_invoice != "" && product_info_id_frm_stock != "" && comment != "")
			{
				event.preventDefault();
				let entry_item = parseInt($("#current_item_entry").text());
				let total_item = parseInt($("#total_current_item_no").text());
				
				if(total_item > entry_item) {
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
						}
					});
					$.ajax({
						url: "/product/store_in/entry",
						type: "POST",
						cache: false,
						data: {
							// '_token': $("meta[name='csrf-token']").attr('content'),
							po_auto_invoice : po_auto_invoice,
							product_info_id : product_info_id_frm_stock,
							comment 				: comment,
							barcode 				: barcode
						},
						// dataType: "html"
						success: function(data, textStatus, xhr){				
							if(xhr.status) {
								// console.log("data", data);
								// console.log("data.status", data.status);
								$("#barcode").val("").focus();
								if(data.status) {
									$("#current_item_entry").text(parseInt($("#current_item_entry").text()) + 1);
									$("#entry_no_now").text(parseInt($("#entry_no_now").text()) + 1);
									let html = '<div class="alert alert-success alert-dismissible fade show" role="alert">'
						          + '<span class="alert-icon"><i class="ni ni-like-2"></i></span>'
						          + '<span class="alert-text"><strong>'+data.message+'</strong></span>'
						          + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
						              + '<span aria-hidden="true">&times;</span>'
						          + '</button>'
						      	+ '</div>';
						      $(".msgAlert").append(html);
								} else {
									let html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
						          + '<span class="alert-icon"><i class="ni ni-like-2"></i></span>'
						          + '<span class="alert-text"><strong>'+data.message+'</strong></span>'
						          + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
						              + '<span aria-hidden="true">&times;</span>'
						          + '</button>'
						      	+ '</div>';
						      $(".msgAlert").append(html);
								}
							}
						},
						error: function (jqXHR, exception) {
							var msg = '';
							if (jqXHR.status === 0) {
							    msg = 'Not connect.\n Verify Network.';
							} else if (jqXHR.status == 404) {
							    msg = 'Requested page not found. [404]';
							} else if (jqXHR.status == 500) {
							    msg = 'Internal Server Error [500].';
							} else if (exception === 'parsererror') {
							    msg = 'Requested JSON parse failed.';
							} else if (exception === 'timeout') {
							    msg = 'Time out error.';
							} else if (exception === 'abort') {
							    msg = 'Ajax request aborted.';
							} else {
							    msg = 'Uncaught Error.\n' + jqXHR.responseText;
							}
							console.log("msg",msg);
						},
					});
				} else if(total_item < entry_item) {
					console.log("Nothing to do.");
				} else if(total_item == entry_item){
					let html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
						          + '<span class="alert-icon"><i class="ni ni-like-2"></i></span>'
						          + '<span class="alert-text"><strong>'+'Item Entry Finished of Purchase Order.'+'</strong></span>'
						          + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
						              + '<span aria-hidden="true">&times;</span>'
						          + '</button>'
						      	+ '</div>';
						      $(".msgAlert").append(html);
				}
				msgAlertAutoHide();
				
			} else {
				event.preventDefault();
				if(po_auto_invoice == "") {
					$("#invoiceNoErr").text("Required!");
				} else {
					$("#invoiceNoErr").text("");
				}
				if(product_info_id_frm_stock == "") {
					$("#productNotFoundErr").text("Required!");
				} else {
					$("#productNotFoundErr").text("");
				}
			}
		}
	}
}

function barcode_entry_validation() {
	// console.log("Form Validation");
	let invoice_no = false;
	let product_name = false;
	let comment = false;
	let barcode = false;
	
	if($("#po_auto_invoice").val() != "") {
		invoice_no = true;
		$("#invoiceNoErr").html("");
	} else {
		$("#invoiceNoErr").html("Select Invoice No.");
	}
	if($("#product_info_id").val() != "") {
		product_name = true;
		$("#productNotFoundErr").html("");
	} else {
		$("#productNotFoundErr").html("Select Product Name.");
	}
	if($("#comment").val() != "") {
		comment = true;
		$("#commentErr").html("");
	} else {
		$("#commentErr").html("Input a Comment Like 'N/A'.");
	}
	if($("#barcode").val() != "") {
		barcode = true;
		$("#barcodeErr").html("");
	} else {
		$("#barcodeErr").html("Barcode Not Found.");
	}
	if(invoice_no && product_name && comment && barcode) {
		return true;
	} else {
		return false;
	}
}
$(document).on("change", "#product_info_id_frm_stock", function() {
	$("#productNotFoundErr").text("");
	let invoice = $("#po_auto_invoice").val();
	let product_id = $(this).val();
	// console.log(invoice, product_id);
	if(product_id == "") {
		$("#current_item_entry").text("0");
		$("#total_current_item_no").text("0");
	} else {
		// $.ajaxSetup({
		// 	headers: {
		// 		'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
		// 	}
		// });
		$.ajax({
			url: "/entry-count",
			type: "POST",
			cache: false,
			data: {
				'_token': $("meta[name='csrf-token']").attr('content'),
				invoice : invoice,
				product_id : product_id
			},
			// dataType: "html"
			success: function(data, textStatus, xhr){				
				if(xhr.status) {
					// console.log("data", data);
					// console.log("data.status", data.status);
					if(data.length != 0) {
						// console.log("xx", data.total_item);
						// console.log("xx", data.entry_item);
						$("#current_item_entry").text(data.entry_item);
						$("#total_current_item_no").text(data.total_item);
						$("#barcode").focus();
					} else {
						console.log("Item count unsuccessful");
					}		
				}
			},
			error: function (jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
				    msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
				    msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
				    msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
				    msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
				    msg = 'Time out error.';
				} else if (exception === 'abort') {
				    msg = 'Ajax request aborted.';
				} else {
				    msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				console.log("msg",msg);
			},
		});
	}
});
$(document).on("change", "#auto_history_invoice_stock", function() {
	let stock_invoice = $(this).val();
	if(stock_invoice == "") {
		$("#stock_history_tbl").find("tbody").find("tr").remove();
	} else {
		// $("#stock_history_tbl").find("tbody").find("tr").remove();
	}
});

$("#reset_cancel_customer").click(function() {
	$("#customer_name").val("");
	$("#company_name").val("");
	$("#phone").val("");
	$("#address").val("");
});

function remove_order_list(elm, scanCode) {
	$(elm).closest('tr').remove();
	let sl = 0;
	$('.saleItemRow').each(function(k,v) {
    $(v).find('td.slnoSaleItem').html(sl + 1);
    sl++;
  });
  if(scanCode != 'blank_row') {
  	removeItemOnce(scannedSaleBarcode, scanCode);
  }
  console.log("scanCode", scanCode);
  console.log(scannedSaleBarcode);
  calcSaleTotal();
  $("#paid_or_due_sale").val("").trigger("change");
}

function sale_row_add() {
	if($("#customer_id").val() == "") {
		alert("Please select a customer First.");
	} else {
		let i = $('.saleItemRow').length + 1;
		let html =	'<tr class="saleItemRow" data-code="">' +
	                '<td class="text-center slnoSaleItem">' + i + '</td>' +
	                '<td class="name">' +
	                  '<input type="hidden" name="product_id[]" value="" class="product_id" required>' +
	                  '<input type="hidden" name="inventory_id[]" value="" class="inventory_id" required>' +
	                  '<input type="hidden" name="barcode[]" value="" class="barcode" required>' +
	                  '<input type="text" name="product_name[]" placeholder="Product Name" class="order_input productName" required>' +
	                '</td>' +
	                '<td class="text-center img">' +
	                  '<img src="#" class="order_product_img" alt="Image">' +
	                '</td>' +
	                '<td class="model text-center">Model</td>' +
	                '<td class="brand text-center">Brand</td>' +
	                '<td class="quantity">' +
	                  '<input type="text" name="quantity[]" id="qty_' + i + '" value="1"  placeholder="Quantity" class="order_input product_qty" required>' +
	                '</td>' +
	                '<td class="price">' +
	                  '<input type="text" name="unit_price[]" id="sale_unit_price_' + i + '" placeholder="Unit Price" class="order_input unit_price" value="0" unit-price="0" onblur="unit_price_validation(this)" required>' +
	                '</td>' +
	                '<td class="last_price">' +
	                  '<input type="text" name="total_price[]" id="total_price_' + i + '" placeholder="Total Price" class="order_input total_price" value="0" required readonly>' +
	                '</td>' +
	                '<td class="text-center remove">' +
	                  '<img src="/ourwork/img/icon/delete-icon.png" class="delet-icon" onclick="remove_order_list(this, \'blank_row\')">' +
	                '</td>' +
	              '</tr>';
	  $("#sale_entry_item tbody").append(html);	  
	  $('#sale_entry_item tr:last-child').find(".productName").focus();
	}
}

$("#reset_cancel_sale").click(function (){
	$("#customer_id").val("");
	$("#sub_total").val("0.00");
	$("#vat_amount").val("0.00");
	$("#grand_total").val("0.00");
	$("#discount").val("0.00");
	$("#customer_paid").val("0.00");
	$("#sale_entry_item tbody").html("");
	scannedSaleBarcode = [];
});

$(function(){
    var currentPath = location.pathname;
    if(currentPath.indexOf('/home') > -1) {
    	$("#dashboradMnu").addClass("mnuActive");
    } else if(currentPath.indexOf('/profile') > -1) {    
    	activeMenuJquery(currentPath, '#userMnu');
    } else if(currentPath.indexOf('/product') > -1) {    
    	activeMenuJquery(currentPath, '#productInMnu');
    } else if(currentPath.indexOf('/order_place') > -1) {    
    	activeMenuJquery(currentPath, '#productOutMnu');
    } else if(currentPath.indexOf('/supplier') > -1) {    
    	activeMenuJquery(currentPath, '#supplierMnu');
    } else if(currentPath.indexOf('/customer') > -1) {    
    	activeMenuJquery(currentPath, '#customerMnu');
    }  else if(currentPath.indexOf('/brand') > -1) {    
    	activeMenuJquery(currentPath, '#supplierMnu');
    }
})
function activeMenuJquery(currentPath, menuId) {
	// console.log(menuId);
	$(menuId).find('a:first-child').trigger('click');
	$(menuId +' a').each(function(k,v) {
		// console.log(v);
		if($(v).attr('href').indexOf(currentPath) !== -1) {
			$(v).addClass("mnuActive");
		}
  });
}
function unit_price_validation(elm) {
	let mainPrice = $(elm).attr('unit-price');
	let inputPrice = $(elm).val();
	let qty = $(elm).closest('tr').find('td.quantity').find('.product_qty').val();
	if(inputPrice < mainPrice) {
		$(elm).val(mainPrice);
		alert("Price can not be less than " + mainPrice + ".");
	} else if(inputPrice > mainPrice){
		// if(inputPrice.indexOf(".") == -1) {
			$(elm).val(parseFloat(inputPrice).toFixed(2));
			$(elm).closest('tr').find('td.last_price').find('.total_price').val(parseFloat(inputPrice * qty).toFixed(2));
		// } else {
		// 	$(elm).closest('tr').find('td.last_price').find('.total_price').val(inputPrice);
		// }		
	}
}

$(document).on('keydown', '.productName', function(event) {
	if(event.which == 13) {
  	event.preventDefault();
  	event.stopImmediatePropagation();
  	// console.log($(event.target).val());
  	let barcodeSale = $(event.target).val();
		// http://localhost:8000/order_place/sale/8941193073216
		if(scannedSaleBarcode.indexOf(barcodeSale) == -1) {			
			$.ajax({			
				url: "/order_place/sale",
				type: "POST",
				// cache: false,
				data: {
					'_token': $("meta[name='csrf-token']").attr('content'),
					'barcodeSale' : barcodeSale
				},
				dataType: "json",
				// headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
				success: function(data, textStatus, xhr){				
					if(xhr.status) {
						// console.log("data", data);
						// console.log("data.status", data.status);
						if(data.status) {
							scannedSaleBarcode.push(barcodeSale);
							$(event.target).closest('tr').attr('data-code', barcodeSale);
							$(event.target).closest('tr').find('td.name').find('.productName').val(data.title).prop('readonly', true);
							$(event.target).closest('tr').find('td.name').find('.product_id').val(data.product_id).prop('readonly', true);
							$(event.target).closest('tr').find('td.name').find('.inventory_id').val(data.inventory_id).prop('readonly', true);
							$(event.target).closest('tr').find('td.img').find('img').attr('src', '/ourwork/img/product_image/'+data.image);
							$(event.target).closest('tr').find('td.model').html(data.model);
							$(event.target).closest('tr').find('td.brand').html(data.brand);
							$(event.target).closest('tr').find('td.price').find('.unit_price').val(data.sale_price);
							$(event.target).closest('tr').find('td.price').find('.unit_price').attr('unit-price', data.sale_price);
							$(event.target).closest('tr').find('td.last_price').find('.total_price').val(data.sale_price);
							$(event.target).closest('tr').find('td.remove').find('img').attr('onclick', 'remove_order_list(this, \''+barcodeSale+'\')');
							$(event.target).closest('tr').next('tr').find('td.name').find('.productName').focus();
							calcSaleTotal();
							// $("#paid_or_due_sale").val("2").trigger('change');
						} else {
							// let html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'
				   //        + '<span class="alert-icon"><i class="ni ni-like-2"></i></span>'
				   //        + '<span class="alert-text"><strong>'+data.message+'</strong></span>'
				   //        + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
				   //            + '<span aria-hidden="true">&times;</span>'
				   //        + '</button>'
				   //    	+ '</div>';
				   //    $(".msgAlert").append(html);
						}
					}
				},
				error: function (jqXHR, exception) {
					var msg = '';
					if (jqXHR.status === 0) {
					    msg = 'Not connect.\n Verify Network.';
					} else if (jqXHR.status == 404) {
					    msg = 'Requested page not found. [404]';
					} else if (jqXHR.status == 500) {
					    msg = 'Internal Server Error [500].';
					} else if (exception === 'parsererror') {
					    msg = 'Requested JSON parse failed.';
					} else if (exception === 'timeout') {
					    msg = 'Time out error.';
					} else if (exception === 'abort') {
					    msg = 'Ajax request aborted.';
					} else {
					    msg = 'Uncaught Error.\n' + jqXHR.responseText;
					}
					console.log("msg",msg);
				},
			});
		} else {
			console.log("The Product Already added. Increased quantity.");			
			// let barcode = $(event.target).closest('tr').attr('data-code');
			let tr = $(event.target).closest('tr').siblings();

			  $(tr).each(function(index, elm) {
			  	console.log(elm);
			  	if($(elm).attr('data-code') == barcodeSale) {
			  		let qty = parseInt($(elm).find('td.quantity').find('.product_qty').val()) + 1;
			  		let saleprice = parseInt($(elm).find('td.price').find('.unit_price').val());

			  		$(elm).find('td.quantity').find('.product_qty').val(qty);
			  		$(elm).find('td.last_price').find('.total_price').val(parseFloat(qty * saleprice).toFixed(2));
			  		// console.log(qty);
			  		calcSaleTotal();
			  		// ================================================
			  	}
			  });

			// console.log(barcode);
			$(event.target).val("");
		}
  }
});

function calcSaleTotal(){
	console.log("function calcSaleTotal()");
  let sale_subtotal = 0;
  $('.total_price').each(function(k, v) {
    if($(v).val() != ''){
      sale_subtotal = sale_subtotal+parseFloat($(v).val());
    }
  });
  let vat_percent = $("#vat_percent").val();
  let vat_amount = parseFloat((sale_subtotal * vat_percent)/100).toFixed(2);
  let grand_total = parseFloat(sale_subtotal)+parseFloat(vat_amount); 
  let discount = parseFloat($("#discount").val());
  console.log("vat_amount", vat_amount);
    
  $("#sub_total").val(parseFloat(sale_subtotal).toFixed(2));
  $("#vat_amount").val(vat_amount);    
  $("#grand_total").val(parseFloat(grand_total).toFixed(2));
  $("#customer_paid").val(parseFloat(grand_total - discount).toFixed(2));
}

function saleDiscountCalc(elm) {
	let discount = $(elm).val();
	let paid_amount = parseFloat($("#grand_total").val()) - discount;
	$(elm).val(parseFloat(discount).toFixed(2));
	$('#customer_paid').val(parseFloat(paid_amount).toFixed(2));
}
$(document).on("blur", "#paid_amount_sale", function(e) {
	// e.preventDefault();
	// e.stopImmediatePropagation();
	let status = $("#paid_or_due_sale").val();

	// console.log(status);
	if(status == '0') {
		//partial payment
		let paid_amount_sale = $(this).val();
		let customer_paid = $("#customer_paid").val();
		let due_amount_sale = customer_paid - paid_amount_sale;
		// if(paid_amount_sale > customer_paid) {
		// 	alert("Paid amount can't grater than "+customer_paid+" Tk.");			
		// 	$("#paid_amount_sale").val("0.00");
		// 	$("#paid_amount_sale").focus();
		// } else {
		// 	$("#due_amount").val(parseFloat(due_amount_sale).toFixed(2)).focus();
		// 	$("#paid_amount_sale").val(parseFloat(paid_amount_sale).toFixed(2));			
		// }
		$("#due_amount").val(parseFloat(due_amount_sale).toFixed(2)).focus();
		$("#paid_amount_sale").val(parseFloat(paid_amount_sale).toFixed(2));
	}
});

$(document).on("change", "#paid_or_due_sale", function(){
	let status = $(this).val();
	console.log(status);
	let paid_amount_sale = $(this).val();
	let customer_paid = $("#customer_paid").val();
	let due_amount_sale = customer_paid - paid_amount_sale;
	if(status == '0') {
		//partial payment
		$("#paid_amount_sale").val("0.00").focus();
		$("#due_amount").val("0.00");
	} else if(status == '1') {
		//fulldue
		$("#paid_amount_sale").val("0.00");
		$("#due_amount").val(parseFloat(customer_paid).toFixed(2));
	} else if(status == '2') {
		//fullpaid
		$("#paid_amount_sale").val(parseFloat(customer_paid).toFixed(2));
		$("#due_amount").val("0.00");
	} else {
		$("#paid_amount_sale").val("0.00");
		$("#due_amount").val("0.00");
	}
});

$('#brand').select2();
$('#auto_history_invoice_stock').select2();
$('#po_auto_invoice').select2();
$('#product_info_id_frm_stock').select2();
$('#supplier_id').select2();
$('#product_info_id').select2();
$('#customer_id').select2();

function sale_order_details(sale_id, soi) {
	// console.log(sale_id, soi);
	$.ajax({			
		url: "/order_place/details",
		type: "POST",
		// cache: false,
		data: {
			'_token': $("meta[name='csrf-token']").attr('content'),
			'auto_sale_invoice': soi,
			'sale_id': sale_id
		},
		dataType: "json",
		// headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
		success: function(data, textStatus, xhr){				
			if(xhr.status) {
				console.log("data", data);
				// console.log("data.status", data.status);
				$("#purchase_order_details").find(".head-body").html("");
				$("#purchase_order_details").find(".head-details h2").html("Sale Order Details");
				if(data.status) {
					let tableBody = '';
					let total_product_qty = 0;
					let dstatus = '';
					$.each(data.product_info, function(index, itemVal) {
					  // console.log(itemVal);
					  tableBody += '<tr>';
					  	tableBody += '<td><img src="/ourwork/img/product_image/'+itemVal.image+'" width="50px"></td>';
					  	tableBody += '<td>'+itemVal.title+'</td>';
              tableBody += '<td>'+itemVal.model+'</td>';
              tableBody += '<td>'+itemVal.brand+'</td>';
              tableBody += '<td>'+data.saleItem[itemVal.product_info_id].qty+'</td>';
              tableBody += '<td>'+data.saleItem[itemVal.product_info_id].sale_price+'</td>';
              tableBody += '<td>'+parseFloat(data.saleItem[itemVal.product_info_id].qty * data.saleItem[itemVal.product_info_id].sale_price).toFixed(2)+'</td>';
            tableBody += '</tr>';

            total_product_qty += parseInt(data.saleItem[itemVal.product_info_id].qty);
					});
					// var dateAr = data.order_info['0'].purchased_date.split('-');
					// var purchased_date = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0];
					// var purchased_date = dateAr[1] + '/' + dateAr[2] + '/' + dateAr[0].slice(-2);
					if(data.sale_info.is_delivered == 'Not Delivered') {
						dstatus = 'bg-status-danger';
					} else {
						dstatus = 'bg-status-success';
					}

					let html = 
            '<div class="pofield_set">'+
              '<div class="bar"></div>'+
              '<div class="po-head" style="height: 250px;">'+
                '<div class="po-labels">Customer Name</div>'+
                '<div class="po-labels" id="">'+data.customer.customer_name+'</div>'+
                '<div class="po-labels">Company/Office</div>'+
                '<div class="po-labels" id="">'+data.customer.company_name+'</div>'+

                '<div class="po-labels">Mobile</div>'+
                '<div class="po-labels" id="">'+data.customer.phone+'</div>'+
								'<div class="po-labels">Total Price</div>'+
                '<div class="po-labels" id="">'+data.sale_info.sub_total_bill+'</div>'+

                '<div class="po-labels">Invoice Number</div>'+
                '<div class="po-labels" id="">'+data.sale_info.auto_sale_invoice+'</div>'+
                '<div class="po-labels">Vat Amount</div>'+
                '<div class="po-labels" id="">'+data.sale_info.vat_amount+'</div>'+

                '<div class="po-labels">Total Product Quantity</div>'+
                '<div class="po-labels" id="">'+total_product_qty+'</div>'+
                '<div class="po-labels">Discount</div>'+
                '<div class="po-labels" id="">'+data.sale_info.discount+'</div>'+

                '<div class="po-labels">Sale Date</div>'+
                '<div class="po-labels" id="po-purchase-date">'+data.sale_info.saled_date+'</div>'+
                '<div class="po-labels">Due Amount</div>'+
                '<div class="po-labels" id="">'+data.sale_info.due_amount+'</div>'+

                '<div class="po-labels">Delivery Status</div>'+
                '<div class="po-labels" id=""><span class="'+dstatus+'">'+data.sale_info.is_delivered+'</span></div>'+ 
                '<div class="po-labels">Paid Amount</div>'+
                '<div class="po-labels" id="">'+data.sale_info.paid_amount+'</div>'+                
              '</div>'+
              '<div class="po-table">'+
                '<table class="po-details-tbl">'+
                  '<thead>'+
                    '<tr>'+
                    	'<th>Image</th>'+
                      '<th>Product Title</th>'+
                      '<th>Model</th>'+
                      '<th>Brand</th>'+
                      '<th>Quantity</th>'+
                      '<th>Unit Price</th>'+
                      '<th>Total Price</th>'+
                    '</tr>'+
                  '</thead>'+
                  '<tbody>'+
                  	tableBody +
                  '</tbody>'+
                '</table>'+
                '<div class="po-footer">'+
                  '<button type="button" class="btn btn-outline-danger po-close-btn" onclick="close_po()">Close</button>'+
                '</div>'+                        
              '</div>'+
            '</div>';
					$("#purchase_order_details").find(".head-body").append(html);
					$("#purchase_order_details").show();
				} else {
					console.log("Data Not Received Successfully Kallol.")
				}
			}
		},
		error: function (jqXHR, exception) {
			var msg = '';
			if (jqXHR.status === 0) {
			    msg = 'Not connect.\n Verify Network.';
			} else if (jqXHR.status == 404) {
			    msg = 'Requested page not found. [404]';
			} else if (jqXHR.status == 500) {
			    msg = 'Internal Server Error [500].';
			} else if (exception === 'parsererror') {
			    msg = 'Requested JSON parse failed.';
			} else if (exception === 'timeout') {
			    msg = 'Time out error.';
			} else if (exception === 'abort') {
			    msg = 'Ajax request aborted.';
			} else {
			    msg = 'Uncaught Error.\n' + jqXHR.responseText;
			}
			console.log("msg",msg);
		},
	});
}
// function showAlert(fromWhere, event, elm) {
// 	// $(event).stopPropagation();
// 	if(fromWhere == 'start_stock_entry') {
// 		// isClickWork = false;		
// 		if(isClickWork) {
// 			isClickWork = false;
// 			return true;
// 		} else {
// 			$("#yesNoAlert").fadeIn();
// 			$("#alertYes").attr('onclick', 'alertSuccess(\''+fromWhere+'\', event,'+$(elm)+')');
// 			return false;
// 		}		
// 	}
// }
// function alertSuccess(fromWhere, event, firstEventElm) {
// 	if(fromWhere == 'start_stock_entry') {
// 		isClickWork = true;
// 		if(isClickWork) {
// 			$("#yesNoAlert").fadeOut();
// 			// firstEventElm.trigger('click');
// 			isClickWork = false;
// 		}
// 	}
// }
function update_brand(e, brand_id) {
	$("#brand_name").val($(e.target).closest('tr').find('td').eq(1).text());
	$("#brand_id").val(brand_id);
	$("#saveBtnCustomer").val('Update');
	$("#reset_cancel_brand").val("Cancel");
	console.log($(e.target).closest('tr').find('td').eq(1).text());
}
$("#reset_cancel_brand").click(function () {
	$("#brand_name").val("");
	$("#brand_id").val("");
	$("#saveBtnCustomer").val('Save');
	$("#reset_cancel_brand").val("Reset");
});
$("#search_brand").keyup(function (e) {
	if (e.which == 13) {
		let searchtxt = $(this).val().toLowerCase();
		let rows = $(".brand_tbl tbody").find('tr');
		// console.log(rows);
		$(rows).each(function( index, element ) {
			let brandTxt = $(element).find('td').eq(1).text().toLowerCase();
			console.log(searchtxt, brandTxt);

			if(brandTxt.indexOf(searchtxt) != -1) {
				$(element).show();
			} else {
				$(element).hide();
			}
		});
	}
});

$("#add_customer_sale").click(function() {
	$("#purchase_order_details").find(".head-body").html("");
	$("#purchase_order_details").find(".head-details h2").html("Add a customer");
	let html = '<div class="pofield_set">' +
      '<div class="bar"></div>' +
      '<div class="addcustomer-con">' +
        '<div class="row">' +
          '<div class="col-md-12" style="padding: 20px 40px;">' +
            '<form action="/customer/entry" method="post" class="form-horizontal">' +
              '<input name="_token" type="hidden" value="'+$('meta[name="csrf-token"]').attr('content')+'">' +
              '<input type="hidden" name="fromWhere" value="sale">' +
              '<div class="row">' +
                '<div class="col-md-6">' +
                  '<div class="form-group">' +
                    '<label for="customer_name">Customer Name</label>' +
                    '<input type="text" class="form-control allowNumbersOnly" id="customer_name" name="customer_name" placeholder="Customer Name">' +
                  '</div>' +
                  '<div class="form-group">' +
                    '<label for="phone">Phone</label>' +
                    '<input type="text" class="form-control allowNumbersOnly" id="phone" name="phone" placeholder="Phone No">' +
                  '</div>' +
                '</div>' +
                '<div class="col-md-6">' +
                  '<div class="form-group">' +
                    '<label for="company_name">Company Name</label>' +
                    '<input type="text" class="form-control allowNumbersOnly" id="company_name" name="company_name" placeholder="Compnay Name">' +
                  '</div>' +
                  '<div class="form-group">' +
                    '<label for="address">Address</label>' +
                    '<input type="text" class="form-control allowNumbersOnly" id="address" name="address" placeholder="Address">' +
                  '</div>' +
                '</div>' +
                '<div class="col-md-12">' +
                  '<div class="form-group subres">' +
                  	'<input type="submit" name="saveBtn" class="btn btn-outline-primary" id="saveBtnCustomer" value="Save"/>' +
                    '<input type="button" class="btn btn-outline-danger" id="reset_cancel_customer" value="Reset"/>' +
                  '</div>' +
                '</div>' +
              '</div>' +
            '</form>' +
          '</div>' +
        '</div>' +             
      '</div>' +
    '</div>';
	$("#purchase_order_details").find(".head-body").append(html);
	// $("#customer_name").val("");
	// $("#company_name").val("");
	// $("#phone").val("");
	// $("#address").val("");
	$("#purchase_order_details").show();
});

// function calcPoTotal(){
// 	console.log("function calcSaleTotal()");
//   let sale_subtotal = 0;
//   $('.total_price').each(function(k, v) {
//     if($(v).val() != ''){
//       sale_subtotal = sale_subtotal+parseFloat($(v).val());
//     }
//   });
//   let vat_percent = $("#vat_percent").val();
//   let vat_amount = parseFloat((sale_subtotal * vat_percent)/100).toFixed(2);
//   let grand_total = parseFloat(sale_subtotal)+parseFloat(vat_amount); 
//   let discount = parseFloat($("#discount").val());
//   console.log("vat_amount", vat_amount);
    
//   $("#sub_total").val(parseFloat(sale_subtotal).toFixed(2));
//   $("#vat_amount").val(vat_amount);    
//   $("#grand_total").val(parseFloat(grand_total).toFixed(2));
//   $("#customer_paid").val(parseFloat(grand_total - discount).toFixed(2));
// }
