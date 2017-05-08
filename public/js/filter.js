$( document ).ready(function() {
  $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('input#_token').val() }
  });
    var table = $('#table_filter').DataTable();
    $('#switcher_debug').on('switchChange.bootstrapSwitch', function(event, state) {
      if(state){
        $('#bnt_debug').removeClass('disabled');
        $('#instrument').prop('disabled',false);

      }
      else{

        $('#bnt_debug').addClass('disabled');
        $('#instrument').prop('disabled', 'disabled');
      }
    });

    $('select.select-filter').change(function() {

      var id = $(this).attr('id');
      var text = $("#" + id + " option:selected" ).text();

      if($("#" + id + " option:selected" ).val() === "0"){
        remove(id);
          //$('#' + id).color = white;

        calculate();

      }
      else{
        //alert("not empty");
        $('#' + id).removeClass( "font-blue-steel" ).addClass( "font-blue-steel" )
        $('#' + id + "_").remove();
        $('#input-button').append(
          '<div id="' + id + "_" + '" class="col-md-2">' +
            '<div class="input-group">' +
              '<input type="text" class="form-control font-blue-steel input-filter" value="' + text + '">' +
              '<span class="input-group-btn">' +
                '<button class="btn green delete-filter input-filter" id="' + id + "__" + '" data-parent="' + id + '" type="button">X</button>' +
              '</span>' +
            '</div>' +
          '</div>'
        );


        //$('#' + id).color = blue;

        calculate();
      }
    });

    $('body').on("click", 'button.delete-filter', function(event){
      var id = $(this).attr('data-parent');

      remove(id);
    });



    function remove(id){
      $('#' + id + "_").remove();
      $('#' + id).removeClass( "font-blue-steel" );
      $('#' + id)[0].selectedIndex = 0;
    }

    function calculate(){
      table.clear().draw();
      if($('#bnt_debug').hasClass('disabled'))
      {
        var url = $('#filter').attr("action");
        var formData = $('#filter').serializeArray();
        $.post(url, formData).done(function (data) {
          //  alert(data);

            table.clear().draw();
            for(i = 0; i < data.length; i++){
/*
              $('#tbody_filter').append("<tr>"+
              '<td tabindex="0" class="sorting_1"> '+data[i].id+' </td>' +
              '<td>' +data[i].instrument_code+ '</td>' +
              '<td>  </td>' +
              '<td>  </td>' +
              '<td>  </td>'
              +"</tr>");
              */

              table.row.add([data[i].id,data[i].instrument_code,'','','']).draw().node();
            }
        });
      }
    }
  });
