var token = $('meta[name="csrf-token"]').attr('content');

class Form{
	constructor(data)
	{
		this.method = "POST";
		this.data = data;
		return this;
	}
	 submit(success, fail) {
		var data = new FormData(this.data);
	    $.ajax({
	        url: window.location.pathname,
	        type: this.method,
	        data: data,
	        headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
	        success: success,
	        error: fail,
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	}

	reset(){
		this.data.reset();
		return this;
	}
}

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
	$.get('/admin/ipos/'+id);
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
		var form = new Form(this);	
			form.submit(function () {
					form.reset();
					$('#datatable').DataTable().ajax.reload();
				}, function (error) {
					formAlert(error);
				});

	    return false;
});
/*file uploader*/
 $('.file-uploader').filemanager($(this).data('type'));
/*file uploader*/
	// $("#ipo-accordion").accordion("option", "active", 1);
});