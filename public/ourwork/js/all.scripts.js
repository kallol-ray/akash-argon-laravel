var scannedItem = [];
var i = 0;
var totalQty = 0;
var suplierCost = 0;
var companyCost = 0;
var additionalCost = 0;
var product_subtotal = 0;
// var cnf_cost = 0;
// var transport_cost = 0;
// var labour_cost = 0;
// var productUnit = {};
// var productUnitQty = {};
// var quantityScan = [];



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
      }, 4000);
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
	$("#purchase_invoice_no").val("");
	$("#product_qty").val("");
	$("#comments").val("");
	$("#total_bill").val("");
	$("#vat").val("");
	$("#discount").val("");
	$("#paid_or_due").val("");
	$("#paid_amount").val("");
	$("#due_amount").val("");
	$("#entry_by").val("");
});
$("#reset_cancel_store").click(function(){
	$("#po_auto_invoice").val("");
	$("#product_info_id").val("");
	$("#barcode").val("");
});

$(document).on("change", "#product_info_id", function() {
	let product_info_id = this.value;
	var i = $(".itemRow").length;
	if(product_info_id != '') {
		// console.log(scannedItem.indexOf(product_info_id));
		if(scannedItem.indexOf(product_info_id) == -1) {
			$("#product_list_err").text("");
			scannedItem.push(product_info_id);
	 		let title = $(this).find('option:selected').attr("title");
	 		let image = $(this).find('option:selected').attr("image");
			let html = '<tr class="itemRow" data-product-info-id="'+product_info_id+'">' +
	                  '<td align="center"><img src="/ourwork/img/product_image/'+image+'" class="order_product_img"></td>'+
	                  '<td>'+title+'</td>'+
	                  '<td>'+image+'</td>'+
	                  '<td>'+
	                  	'<input type="hidden" name="product_info_id[]" value="'+product_info_id+'">'+
	                  	'<input type="hidden" name="image[]" value="'+image+'">'+
	                        // pattern="[0-9]+([.,][0-9]+)?"
	                  	'<input type="text" name="quantity[]" id="qty_'+i+'" step="1" required placeholder="Quantity" class="order_input inp_quantity allowNumbersOnly" min="1">'+
	                  '</td>'+
	                  '<td><input type="text" name="unit_price[]" id="purchaseprice_'+i+'" onblur="setpurchasePrice('+i+',this)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" min="1" required placeholder="Unit Price"  class="order_input inp_unit_price allowNumbersOnly"></td>'+
	                  '<td><input type="text" name="additional_price[]" id="withadditional_'+i+'" class="order_input inp_additional_price allowNumbersOnly" placeholder="Additional Price" required></td>'+
	                  '<td><input type="text" name="sale_price[]" class="order_input inp_sale_price allowNumbersOnly" placeholder="Sale Price" required></td>'+
	                  '<td><input type="text" name="total_price[]" id="total_'+i+'" class="order_input inp_total_price allowNumbersOnly" placeholder="Total Price" required></td>'+
	                  '<td align="center"><img src="/ourwork/img/icon/delete-icon.png" class="delet-icon" onclick="remove_list(this, event)"></td>'+
	                '</tr>';
	        $("#order_entry_item tbody").append(html);
		} else {
			$("#product_list_err").text("The item already added.");
		}		
	} else {
		$("#product_list_err").text("");
	}
});

$('#order_entry_item tbody .inp_quantity').on('keyup change',function(e){
    calculate();
});

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

// $('.allowNumbersOnly').keyup(function(event) {
// 	let checkDot = 0;
// 	console.log(event.which);
//   if (event.which == 46) {
//   	// $(this).val().indexOf('.') != -1
//   	if(checkDot ==0) {
//   		checkDot++;
//   	} else {
//   		event.preventDefault();
//   	}
//   }else {
//     if(event.which < 48 || event.which > 57) {
//     	event.preventDefault();
//     }
//   }
// });

function remove_list(elm, event) {
	let product_id = $(elm).closest('tr').attr("data-product-info-id");
	$("#product_list_err").text("");
	removeItemOnce(scannedItem, product_id);
	$(elm).closest('tr').remove();
	// console.log($("#order_entry_item tbody").find("tr.itemRow").length);
	// console.log($(elm).closest('table'));
	if($('#order_entry_item tbody').find("tr.itemRow").length > 0) {
		$('#order_entry_item tbody')
			.children('tr:first')
			.find("td")
			.find("[id^=purchaseprice]")
			.trigger("blur");
		// console.log(row);
	}
	// console.log($(document).on("#purchaseprice_0").length);
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
function order_details(auto_invoice) {
	$("#purchase_order_details").show();
}
$(document).on("change", "#po_auto_invoice", function() {	
	// console.log($(this).val());
	let auto_invoice = $(this).val();
	$("#productNotFoundErr").html("");	
	if(auto_invoice == "") {
		$('#product_info_id option').filter(function() {
		  return $.trim(this.value).length != 0;
		  // return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
		}).remove();
	} else {
		$("#invoiceNoErr").html("");
		$('#product_info_id option').filter(function() {
		  return $.trim(this.value).length != 0;
		  // return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
		}).remove();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
			}
		});
		// console.log("auto_invoice = ", auto_invoice);
		$.ajax({
			url: "/invoice-wise-product",
			type: "POST",
			cache: false,
			data: {auto_invoice : auto_invoice},
			// dataType: "html"
			success: function(data, textStatus, xhr){				
				if(xhr.status) {
					// console.log("data", data);
					// console.log("length", data.length);
					if(data.length != 0) {
						$.each(data, function( k, v ) {
						  // console.log( "Key: " + k + ", Value: " + v );
							let option = '<option value="'+k+'">'+ v +'</option>';
							$("#product_info_id").append(option);
						});
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
		}
	} else if(from_where == "barcode") {
		// console.log(event.which);		
		if(code == 13) {
			if($(event.target).val() != "") {
				event.preventDefault();
				let po_auto_invoice = $("#po_auto_invoice").val();
				let product_info_id = $("#product_info_id").val();
				let comment = $("#comment").val();
				let barcode = $("#barcode").val();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
					}
				});
				// console.log("auto_invoice = ", auto_invoice);
				$.ajax({
					url: "/product/store_in/entry",
					type: "POST",
					cache: false,
					data: {
						po_auto_invoice : po_auto_invoice,
						product_info_id : product_info_id,
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
							
							msgAlertAutoHide();
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
				event.preventDefault();
			}
		}
	}
}

function barcode_entry_validation() {
	console.log("Form Validation");
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







