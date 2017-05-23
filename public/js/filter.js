$( document ).ready(function() {
  $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('input#_token').val() }
  });

  var table = $('#table_filter').DataTable({
    "autoWidth": false
  });

  function load_filter(filter){
    $('#input-button').empty();
    $( "select.select-filter" ).each(function( index ) {
      $( this ).selectpicker('val', 0);
    });
    var arr = filter.split("\n");
    for(i = 0; i < arr.length; i++){
      var select = arr[i].split(":");
      if(select[0] !== '' && select[1] !== ''){
          $('#' + select[0]).selectpicker('val', select[1])
          var text = $("#" + select[0] + " option:selected" ).text();

          $('#' + select[0]).removeClass( "font-blue-steel" ).addClass( "font-blue-steel" );
          $('#' + select[0] + "_").remove();
          $('#input-button').append(
            '<div id="' + select[0] + "_" + '" class="col-md-2">' +
              '<div class="input-group">' +
                '<input type="text" class="form-control font-blue-steel input-filter" value="' + text + '">' +
                '<span class="input-group-btn">' +
                  '<button class="btn green delete-filter input-filter" id="' + select[0] + "__" + '" data-parent="' + select[0] + '" type="button">X</button>' +
                '</span>' +
              '</div>' +
            '</div>'
          );

          calculate();
      }
    }
  }

  function handleFileSelect(evt) {
      var files = evt.target.files; // FileList object
      // Loop through the FileList
      for (var i = 0, f; f = files[i]; i++) {

        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function(theFile) {
          return function(e) {
            // Print the contents of the file
            load_filter(e.target.result);
          };
        })(f);
        // Read in the file
        //reader.readAsDataText(f,UTF-8);
      //reader.readAsDataURL(f);
        reader.readAsText(f);
      }
    }
    if ( $( "#load_filter" ).length ) {
      document.getElementById('load_filter').addEventListener('change', handleFileSelect, false);
    }


    $('#save_filter').on('click', function() {
      var flag = false;
      $( "select.select-filter" ).each(function( index ) {
        if($(this).val() !== '0')
        {
          flag = true;
          //console.log($(this).val());
        }
      });
      if(flag){
        var url = $("#filter").attr( 'action' );
        $("#filter").attr('action', "/save_filter").submit();
        $("#filter").attr('action', url);
      }
      else{
        $("#alerts").append('<div id="alert" class="col-md-4 col-md-offset-4 alert alert-block alert-danger fade in">' +
            '<button type="button" class="close" data-dismiss="alert"></button>' +
            '<h4 class="alert-heading">Error!</h4>' +
            '<p> You didn\'t select filter(s)! </p>' +
            '</div>'
        );
      }
    });

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

        calculate();
      }
    });

    $('body').on("click", 'button.delete-filter', function(event){
      var id = $(this).attr('data-parent');

      remove(id);
      calculate();
    });



    function remove(id){
      $('#' + id + "_").remove();
      $('#' + id).removeClass( "font-blue-steel" );
      $('#' + id).selectpicker('val', 0)
    }

    function calculate(){
      table.clear().draw();
      {
        var url = $('#filter').attr("action");
        var formData = $('#filter').serializeArray();
        $.post(url, formData).done(function (data) {
            table.clear().draw();
            for(i = 0; i < data.length; i++){

              table.row.add([data[i].n, data[i].instrument_code, data[i].m, data[i].open,
                                        data[i].high, data[i].low, data[i].close, data[i].trade, data[i].volume,
                                        data[i].change.toFixed(2), data[i].change_p.toFixed(2)])
            }
            table.draw();
        });
      }
    }
  });
