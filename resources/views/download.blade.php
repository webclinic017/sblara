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

<div class="row" >
    <div class="col-md-12">
<div class="portlet light form-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-green"></i>
            <span class="caption-subject font-green sbold uppercase">Download all together</span>
        </div>
        <div class="actions">

        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form  class="form-horizontal form-bordered" method="post">
            {{csrf_field()}}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Last 2 years EOD data</label>
                    <div class="col-md-9">
                        <button  type="submit" name="nonadjusted"  class="btn green">
                            <i class="fa fa-download"></i> Download</button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Last 2 years eod data (adjusted) 
                       </label>
                    <div class="col-md-9">
                        <button type="submit" name="adjusted" class="btn green">
                            <i class="fa fa-download"></i> Download</button>                   
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">

                    </div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>
 </div>
    </div>
</div>
<div class="row" >
    <div class="col-md-12">
<div class="portlet light form-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-green"></i>
            <span class="caption-subject font-green sbold uppercase">Download all together by date</span>
        </div>
        <div class="actions">

        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form  class="form-horizontal form-bordered" method="post">
            {{csrf_field()}}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Date: </label>
                    <div class="col-md-9">

                                                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-end-date="+0d">
                                                                    <input name="allTogetherByDate" type="text" value="{{date('Y-m-d')}}" class="form-control" readonly>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn default" type="button">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </button>
                                                                    </span>
                                                                </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">
                       </label>
                    <div class="col-md-9">
                        <button type="submit" name="adjusted" class="btn green">
                            <i class="fa fa-download"></i> Download</button>                   
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">

                    </div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>
 </div>
    </div>
</div>
<div class="row" >
    <div class="col-md-12">
<div class="portlet light form-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-green"></i>
            <span class="caption-subject font-green sbold uppercase">Download filtered data</span>
        </div>
        <div class="actions">

        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form  class="form-horizontal form-bordered" method="post">
            {{csrf_field()}}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Date Range</label>
                    <div class="col-md-9">
                        <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                            <input type="text" class="form-control" name="from" required="true">
                            <span class="input-group-addon"> to </span>
                            <input type="text" class="form-control" name="to" required="true"> </div>
                        <!-- /input-group -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Select instruments (Max:5)</label>
                    <div class="col-md-9">
                        <select required="true" class=" form-control se-select2 input-fixed input-large" multiple="multiple" name="instruments[]">
                                    @foreach(\App\Instrument::orderBy('instrument_code', 'asc')->get() as $instrument)
                                        <option value="{{$instrument->id}}">{{$instrument->instrument_code}}</option>
                                    @endforeach
                        </select>                        
                    </div>
                </div>
            <div class="form-group">
                    <label class="col-md-3 control-label">Check if you need adjusted data</label>
                    <div class="mt-checkbox-list col-md-9">
                        <label class="mt-checkbox mt-checkbox-outline"> Adjusted
                            <input type="checkbox" value="1" name="adjusted_filtered">
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="filtered" class="btn green">
                            <i class="fa fa-download"></i> Download</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
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
        $('#seDateRange').daterangepicker({
            autoUpdateInput: false,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        alwaysShowCalendars:true,
        });
    });
</script>
@endpush



