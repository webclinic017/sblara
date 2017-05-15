@extends('layouts.metronic.default')

@section('content')
<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />

<div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12" >
        <div class="col-lg-12 col-md-5 col-sm-6 col-xs-12" style="margin-bottom: 20px;">
            <div class="form-group">
                <label class="control-label col-md-4">Date Ranges</label>
                <div class="col-md-8">
                    <div class="input-group" id="defaultrange">
                        <input type="text" id = "defaultrangeVal" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn default date-range-toggle" type="button">
                                <i class="fa fa-calendar"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-5 col-sm-3 col-xs-12" style="margin-bottom: 20px;">
            <div class="form-group">
                <label class="control-label col-md-4">Adjusted?</label>
                <div class="col-md-8">
                    <select id = "adjust" class="bs-select form-control" >
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-5 col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="control-label col-md-4">Instrument IdS</label>
                <div class="col-md-8">
                    <select multiple="multiple" class="multi-select instrument_ids" id="my_multi_select2" name="my_multi_select2[]" height='300px' >
                        <?php echo $instrumentField ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <button class="btn btn-default" onclick = "preview();"><i class="fa fa-globe"></i>Preview</button></div>
                <div class="tools"> <!-- <button class="btn btn-default" onclick = "zipDownload();"></i>ZIP</button> --></div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    <?php echo $thead ?>
                    <tbody id = "mainData">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('metronic/assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/pages/scripts/components-multi-select.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('metronic/assets/global/plugins/datatables/datatables.all.min.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $('#defaultrangeVal').val(getFormatDate(new Date) + " - " + getFormatDate(new Date));
        }, 1000);
    });

    var getDate = function(date) {
        date = date.trim();
        date = date.replace(",", "");
        date = date.split(" ");
        var month = {
          "January" : 1, "February" : 2, "March" : 3,
          "April" : 4, "May" : 5, "June" : 6, "July" : 7,
          "August" : 8, "September" : 9, "October" : 10,
          "November" : 11, "December" : 12
        };
        return date[2] + "-" + month[date[0]] + "-" + date[1];
    };

    var getFormatDate = function(date) {
        var monthNames = [
          "January", "February", "March",
          "April", "May", "June", "July",
          "August", "September", "October",
          "November", "December"
        ];

        var day = date.getDate();
        var monthIndex = date.getMonth();
        var year = date.getFullYear();

        return monthNames[monthIndex] + ' ' + day + ', ' + year;
    }

    var preview = function(argument) {
        var dataRangeText = $('#defaultrangeVal').val();
        if (!dataRangeText) {
            alert("Please input Data Range");
            return;
        }
        var adjust = ($('#adjust').value == "YES") ? 1 : 0;
        var instruIDs = [];
        var selOpts = $('.instrument_ids')[0].selectedOptions;
        for ( index = 0; index  < selOpts.length; index ++ ) {
            instruIDs[index] = selOpts[index].value;
        }
        if (!instruIDs.length) {
            alert("Please select Instrument Id");
            return;
        }
        var dataRange = dataRangeText.split("-");
        if ( $.fn.dataTable.isDataTable( '#sample_2' ) ) {
            $("#sample_2").dataTable().fnDestroy();
        }
        dataRange[0] = getDate(dataRange[0]);
        dataRange[1] = getDate(dataRange[1]);
        $("#mainData").html("");
        $('#sample_2').DataTable( {
            dom: 'Bfrtip',
            "ajax": "/jsonData?adjust=" + adjust + "&instruIDs=" + instruIDs + "&dataRange=" + dataRange,
            buttons: [
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
        $('div.dt-buttons').append('<a class="dt-button buttons-html5 zip-button" tabindex="0"><span>ZIP</span></a>');
        $("div.dt-buttons").on("click",".zip-button", function(e) {
            e.preventDefault();
            e.stopPropagation();
            var dataRangeText = $('#defaultrangeVal').val();
            if (!dataRangeText) {
                alert("Please input Data Range");
                return;
            }
            var adjust = ($('#adjust').value == "YES") ? 1 : 0;
            var instruIDs = [];
            var selOpts = $('.instrument_ids')[0].selectedOptions;
            for ( index = 0; index  < selOpts.length; index ++ ) {
                instruIDs[index] = selOpts[index].value;
            }
            if (!instruIDs.length) {
                alert("Please select Instrument Id");
                return;
            }
            var dataRange = dataRangeText.split("-");
            if ( $.fn.dataTable.isDataTable( '#sample_2' ) ) {
                $("#sample_2").dataTable().fnDestroy();
            }
            dataRange[0] = getDate(dataRange[0]);
            dataRange[1] = getDate(dataRange[1]);

            window.open( "/downloadZip?adjust=" + adjust + "&instruIDs=" + instruIDs + "&dataRange=" + dataRange );
            preview();
        });
    }  
</script>
@endpush



