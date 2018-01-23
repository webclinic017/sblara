var token = $('meta[name="csrf-token"]').attr('content');
var url = window.location;
var loadingHtml = `
	<img src="/img/se_loading.gif" class='loading' alt="" />
`;
function getValue(name) {
	return $('input[name="'+name+'"]').val();
}
function depthLoading() {
	return `
<table style="font-family:Arial, Helvetica, sans-serif; font-size: 13px;" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody><tr>
    <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tbody><tr>
        <td width="15%" valign="top">&nbsp;</td>
        <td width="75%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td width="100%" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#E8FFFB">
                <tbody><tr bgcolor="#339966">
                  <td height="34%" colspan="2"><div align="center"><strong><font color="#FFFFFF">Buy</font></strong></div></td>
                </tr>
                <tr>
                  <td width="50%" bgcolor="#D2F0E1"><div align="center">Buy Price </div></td>
                  <td height="34%" bgcolor="#D2F0E1"><div align="center">Buy Volume </div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                                <tr>
                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>
                  </tr>
                              
                            </tbody></table></td>

          </tr>
        </tbody></table></td>
        <td width="15%" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFF7EA">
          <tbody><tr bgcolor="#339966">
            <td colspan="4"><font color="#FFFFFF"><strong>Price Statistics </strong></font> </td>
          </tr>

          <tr>
            <td colspan="4" >
				<div class="animated-background" style="margin:2px; min-height:15px"></div>
            </td>
          </tr>
       
          <tr>
            <td colspan="4" >
				<div class="animated-background" style="margin:2px; min-height:15px"></div>
            </td>
          </tr>
       
          <tr>
            <td colspan="4" >
				<div class="animated-background" style="margin:2px; min-height:15px"></div>
            </td>
          </tr>
       
          <tr>
            <td colspan="4" >
				<div class="animated-background" style="margin:2px; min-height:15px"></div>
            </td>
          </tr>
       
          <tr>
            <td colspan="4" >
				<div class="animated-background" style="margin:2px; min-height:15px"></div>
            </td>
          </tr>
       
          <tr>
            <td colspan="4" >
				<div class="animated-background" style="margin:2px; min-height:15px"></div>
            </td>
          </tr>
       
        </tbody></table></td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>

    </tbody></table></td>
  </tr>
</tbody></table>		
	`;
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
$('body').on('click', '[data-target="#sellModal"]', function () {
	$('.company-info').html('');
	$('.basic-single-select2').val($(this).data('ins_id'));
	$('.basic-single-select2').each(function () {

		if($(this).data('type') == 'sell')
		{
			$(this).trigger('change');
		}
	});
});
$('body').on('click', '.btn[data-target="#buyModal"]', function () {
	$('.company-info').html('');
	$('.basic-single-select2').val('');
	$('.basic-single-select2').each(function () {

		if($(this).data('type') == 'buy')
		{
			$(this).trigger('change');
		}
	});	
});
$('body').on('click',  '.confirmSell', function () {
			$('#sellModal form').submit();
	});
	/* search  */
	$(document).mouseup(function(e) 
{
    var container = $(".se-search");

    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        $('.search-result').hide();
    }else{
        $('.search-result').show();
    }
});
	$('#top-search').keyup(function (e) {
	if (e.keyCode == 27) { 

			$('.search-result').css('visibility', 'hidden');
			$(this).val('');
			return;
    }
		$('.company-search').html('<tr><td colspan="5" ><div class="animated-background"></div><div class="animated-background"></div><div class="animated-background"></div><div class="animated-background"></div></td></tr>');
		var str = $(this).val();
		if(str.length < 2)
		{
			$('.search-result').css('visibility', 'hidden');
			return;			
		}
		$.get('/search/company/'+str, function (result) {
		
			var html = "";
			$.each(result, function (k, v) {
				v.data_banks_intraday = v;
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
				var cls = '';
				if(isNaN(change))
				{
					change = 0;
				}
				if(change == 0)
				{
					cls = 'text-warning';
				}
				else if (change > 0){
					cls = 'text-success';
				} else {
					cls = 'text-danger';
				}

				if((high - yclose) == 0)
				{
					hcls = 'text-warning';
				}
				else if ((high - yclose) > 0){
					hcls = 'text-success';
				} else {
					hcls = 'text-danger';
				}
				if((low - yclose) == 0)
				{
					lcls = 'text-warning';
				}
				else if ((low - yclose) > 0){
					lcls = 'text-success';
				} else {
					lcls = 'text-danger';
				}

				// if((yclose - high) < 0)
				html += `
                            <tr>
                                <td > 
                                <a class="popover-ta-chart" data-trigger="hover" data-toggle="popover" title="`+v.instrument_code+`- TA Chart" data-content="<img src='/tooltip_chart/`+v.id+`' />"   target="_blank"  href="/company-details/`+v.id+`">`+ v.instrument_code+`</a>
                                 <a   target="_blank"  href="/news-chart/`+v.id+`" title="News Chart"><i class="fa fa-bullhorn"></i></a>
                                 <a  target="_blank"  href="/advance-ta-chart?instrumentCode=`+v.instrument_code+`" title="Advanced Chart"><i class="fa fa-line-chart"></i></a>
                                 <a  target="_blank"  href="/ta-chart?instrumentCode=`+v.instrument_code+`" title="TA Chart"><i class="fa fa-bar-chart"></i></a>
                                 <a target="_blank" href="/minute-chart/`+v.id+`" title="Minute Chart"><i class="fa fa-area-chart"></i></a>
                                 </td>
                                <td class="`+cls+`">`+ ltp+`</td>
                                <td class="`+hcls+`">`+ high +`</td>
                                <td class="`+lcls+`">`+ low +`</td>
                                <td class="`+cls+`">`+change+`</td>
                            </tr>				
					
				`;

			})
			$('.company-search').html(html);

			/*enable popover for ajaxed content*/
			    $('[data-toggle="popover"]').popover({
			    	html: true,
			    	placement: 'bottom',
			    	delay: { "show": 500, "hide": 100 }
			    });  
			/*enable popover for ajaxed content*/
		} );
		$('.search-result').css('visibility', 'visible');
	});

	/* search  */

	/*pop over ta chart*/

	/*pop over ta chart*/

	/*menu fix*/
	$('.more-dropdown-sub.closed').removeClass('open');
	$('.active').parent('.active').addClass('open');
	/*menu fix*/
	$('.select2-multiple').select2({
		maximumSelectionLength: 5,
		 placeholder: "Please Select",
	});

	$('.date-picker').datepicker();
	$('.select2').select2();
});

document.addEventListener('DOMContentLoaded',
function () {
$.feedback({
    ajaxURL: '/feedback',
    html2canvasURL: '/vendor/feedback/html2canvas.js',
});
}, false);

Highcharts.setOptions({
	credits: {
		enabled:false
	}
});

