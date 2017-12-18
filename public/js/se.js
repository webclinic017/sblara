var token = $('meta[name="csrf-token"]').attr('content');
var url = window.location;
var loadingHtml = `
	<img src="/img/se_loading.gif" class='loading' alt="" />
`;
function getValue(name) {
	return $('input[name="'+name+'"]').val();
}
function startEditing() {
	$('#editing').removeClass('hidden');
	$('#showing').addClass('hidden');
}
function endEditing() {
	$('#editing').addClass('hidden');
	$('#showing').removeClass('hidden');
}
function startLoading(e) {
	e.after(loadingHtml);
}
function endLoading() {
	$('.loading').remove();
}
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
	$.get('/admin/ipos/'+id, function (data) {
		$.each(data, function (k, v) {
			$('input[name="'+k+'"]').val(v);
			startEditing();
		})
		// var html = `
  //               <div class="col-md-3">
  //                   <h6>File name</h6>
  //                   <img src="/img/chart_logo.gif" >
  //               </div>
		// `;
		$('.edit-attachments').html(html);

	});

}
function deleteIpo(id) {
	deleteRequest('/admin/ipos/'+id);
}
$(document).ready(function () {
$('#addNew').click(function () {
	$('form.ajax')[0].reset();
	startEditing();
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

$('.add-more-attachment').click(function () {
	var html = $('.addable-attachments .defautl-field').html();
	$('.additional-fields').append(html);
});
/*file uploader*/
 $('.file-uploader').filemanager($(this).data('type'));
/*file uploader*/

$('body').on('click',  '.confirmBuy', function () {
			$('#buyModal form').submit();
	});
$('body').on('click',  '.confirmSell', function () {
			$('#sellModal form').submit();
	});
	/* search  */
	$('#top-search').keyup(function () {

		$('.company-search').html('<li style="list-style-type:none"><div class="animated-background"></div></li>');
		var str = $(this).val();
		if(str.length < 2)
		{
			$('.search-result').css('visibility', 'hidden');
			return;			
		}
		$.get('/search/company/'+str, function (result) {
			
			var html = "";
			$.each(result, function (k, v) {
	
				if (v.data_banks_intraday == null){
					yclose = 0;
					ltp = 0; 
					high = 0;
					low = 0;
				}else{
					if (v.data_banks_intraday.pub_last_traded_price != 0)
					{
						ltp = v.data_banks_intraday.pub_last_traded_price;
					}else{
						ltp = v.data_banks_intraday.spot_last_traded_price;
					}
					yclose = v.data_banks_intraday.yday_close_price;
					high = v.data_banks_intraday.high_price;
					low = v.data_banks_intraday.low_price;
				}
				var change =  (((ltp - yclose) / yclose )*100).toFixed(2);
				if(change = "NAN")
				{
					change = 0;
				}
				html += `
                                        <li class="search-item clearfix">
                                            <div class="search-content">
                                                <div class="row">
                                                    <div class="col-sm-4 col-xs-12">
                                                        <h2 class="search-title">
                                                            <a href="/company-details/`+v.id+`">`+ v.instrument_code+`</a>
														</h2>
												
                                                    </div>
                                                    <div class="col-md-7">
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">LTP</p>
                                                            <p class="search-counter-label uppercase">`+ ltp+`</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">HIGH</p>
                                                            <p class="search-counter-label uppercase">`+ high +`</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">LOW</p>
                                                            <p class="search-counter-label uppercase">`+ low +`</p>
                                                        </div>
                                                        <div class="col-sm-3 col-xs-4">
                                                            <p class="text-center">%CHANGE    </p>
                                                            <p class="search-counter-label uppercase">`+change+`</p>
                                                        </div>
                                                    </div>

                                                </div> 
                                        </li>   					
				`;

			})
			$('.company-search').html(html);

		} );
		$('.search-result').css('visibility', 'visible');
	});
	   document.addEventListener('DOMContentLoaded',
      function () {
        $.feedback({
            ajaxURL: '/feedback',
            html2canvasURL: '/vendor/feedback/html2canvas.js',
        });
        }, false);
	/* search  */
});
