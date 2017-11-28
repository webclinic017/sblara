var token = $('meta[name="csrf-token"]').attr('content');
function deleteRequest(url) {
	swal({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.value) {
	  	$.post(url, {_token:token, _method:'delete'}, function () {
		    swal(
		      'Deleted!',
		      'Your file has been deleted.',
		      'success'
		    )
	  	});
	  }
	})
}
function editIpo(id) {
	
}
function deleteIpo(id) {
	deleteRequest('/admin/ipos/'+id);
}
$(document).ready(function () {
$('#addNew').click(function () {
	$('#editing').removeClass('hidden');
	$('#showing').addClass('hidden');
})
$('.cancel-edit').click(function () {
	$('#editing').addClass('hidden');
	$('#showing').removeClass('hidden');
})

$('body').on('submit', 'form.ajax', function (e) {
	e.preventDefault();
});
	// $("#ipo-accordion").accordion("option", "active", 1);
});