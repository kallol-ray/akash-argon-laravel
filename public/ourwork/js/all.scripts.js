

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
$("#reset_cancel").click(function(){	
	set_entry_date();
	$("#update_id").val("");
	$("#title").val("");
	$("#description").val("");
	$("#imageToUpload").val("");
	$("#model").val("");
	$("#brand").val("");
	$("#before_img_name").val("");
	$("#uploadImagePreview").attr("src","");
	$("#entry_by").val("");
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


$( document ).ready(function() {
    if($(".msgAlert .alert").is(":visible")) {
			setTimeout(function(){
				$(".msgAlert .alert").fadeOut("slow");
			}, 4000);
		}

});


