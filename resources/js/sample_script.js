// $.ajaxSetup({
// 	headers: {
// 		'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
// 	}
// });
// $.ajax({
// 	url: "/single-product-info",
// 	type: "POST",
// 	cache: false,
// 	data: {product_info_id : product_info_id},
// 	// dataType: "html"
// 	success: function(data, textStatus, xhr){
// 		console.log(data[0].title);
// 		let html = '<tr>' +
//                 '<td data-product-info-id="'+data[0].product_info_id+'" align="center"><img src="/ourwork/img/product_image/'+data[0].image+'" class="order_product_img"></td>'+
//                 '<td>'+data[0].title+'</td>'+
//                 '<td>'+data[0].model+'</td>'+
//                 '<td>'+
//                 	'<input type="hidden" name="product_info_id[]" value="'+data[0].product_info_id+'">'+
//                 	'<input type="text" name="quantity[]" class="order_input inp_quantity allowNumbersOnly">'+
//                 '</td>'+
//                 '<td><input type="text" name="unit_price[]" class="order_input inp_unit_price allowNumbersOnly"></td>'+
//                 '<td><input type="text" name="additional_price[]" class="order_input inp_additional_price allowNumbersOnly"></td>'+
//                 '<td><input type="text" name="sale_price[]" class="order_input inp_sale_price allowNumbersOnly"></td>'+
//                 '<td><input type="text" name="total_price[]" class="order_input inp_total_price allowNumbersOnly"></td>'+
//                 '<td align="center"><img src="/ourwork/img/icon/delete-icon.png" class="delet-icon" onclick="remove_list(this, event)"></td>'+
//               '</tr>';
// 		if(xhr.status) {
// 			console.log("aa");
// 			$("#order_entry_item tbody").append(html);
// 		}
// 	},
// 	error: function (jqXHR, exception) {
// 		var msg = '';
// 		if (jqXHR.status === 0) {
// 		    msg = 'Not connect.\n Verify Network.';
// 		} else if (jqXHR.status == 404) {
// 		    msg = 'Requested page not found. [404]';
// 		} else if (jqXHR.status == 500) {
// 		    msg = 'Internal Server Error [500].';
// 		} else if (exception === 'parsererror') {
// 		    msg = 'Requested JSON parse failed.';
// 		} else if (exception === 'timeout') {
// 		    msg = 'Time out error.';
// 		} else if (exception === 'abort') {
// 		    msg = 'Ajax request aborted.';
// 		} else {
// 		    msg = 'Uncaught Error.\n' + jqXHR.responseText;
// 		}
// 		console.log(msg);
// 	},
// });