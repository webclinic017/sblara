@section('meta-title', 'Portfolio: Track your share performance ')

@extends('layouts.metronic.default')
@section('content')
@include('portfolio.portfolio_actions')
@section('page_heading')
{{$portfolio->portfolio_name}}
@endsection


@if (\Session::has('portfolio_error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('portfolio_error') !!}</li>
        </ul>
    </div>
@endif


<div class="portlet light bordered ">
    <div class="portlet-title">
         <div class="caption font-green">
                                  <span class="caption-subject bold uppercase">{{$portfolio->portfolio_name}}</span>
        </div>

    {{--
        <div class="caption font-green">
            <span class="caption-subject bold uppercase"> Portfolio Performances</span>
        </div>--}}
    </div>
    <div class="portlet-body formn flip-scroll">
<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                   @include('ads.google_responsive_portfolio')
                   {{--@include('ads.google_double_click')--}}
                </div>
            </div>
        </div>
    </div>
<div class="row portfolio-content-area">
         <table class="table table-striped table-bordered table-advance table-hover table-condensed flip-content">
            <thead class="flip-content">
                <tr class="hidden-xs hidden-sm">
                    <th colspan="2"></th>
                    <th colspan="3" class="text-center">Today</th>
                    <th colspan="3"></th>
                    <th colspan="4" class="text-center">Since Purchased</th>
                    <th colspan="2"></th>
                </tr>
                <tr>
                    <th>Company Code</th>
                    <th class="hidden-xs hidden-sm">Market</th>
                    <th>Last Trade Price</th>
                    <th>Change</th>
                    <th>Gain/Loss</th>
                    <th>Shares</th>
                    <th>Buy Price</th>
                    <th>Purchase Date</th>
                    <th>Buy Commission</th>
                    <th>Total Purchase</th>
                    <th>Gain/Loss</th>
                    <th>%Change</th>
                    <th>%Portfolio</th>
                    <th>Sell Value</th>
                </tr>
            </thead>
            <tbody>
                @include('portfolio.performance_item',['portfolio'=>$portfolio])
            </tbody>
        </table>
</div>



</div>
</div>

<div class="row margin-bottom-30">
<div class="col-md-12">

<div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-excel-o"></i>IMPORT FROM EXCEL/CSV</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>

                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                        <h4>Example of excel format of portfolio</h4>
                                        <div class="table-scrollable">
                                                                                    <table class="table table-striped table-hover">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>share</th>
                                                                                                <th> quantity </th>
                                                                                                <th> price </th>
                                                                                                <th> date </th>
                                                                                                <th> exchange </th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                             <tr>
                                                                                                    <td>ACI</td>
                                                                                                    <td>150</td>
                                                                                                    <td>430</td>
                                                                                                    <td>1/19/2018</td>
                                                                                                    <td>DSE</td>
                                                                                                 </tr>
                                                                                                 <tr>
                                                                                                    <td>DESCO</td>
                                                                                                    <td>150</td>
                                                                                                    <td>430</td>
                                                                                                    <td>3/27/2017</td>
                                                                                                    <td>DSE</td>
                                                                                                 </tr>
                                                                                                 <tr>
                                                                                                    <td>SPCL</td>
                                                                                                    <td>150</td>
                                                                                                    <td>430</td>
                                                                                                    <td>1/29/2018</td>
                                                                                                    <td>DSE</td>
                                                                                                 </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <span class="label label-info"> *Date must be mm/dd/yyyy format  </span>
                                                                                    <span class="label label-danger"> **Heading must be lowercase  </span>

                                                                                </div>
                                        </div>
                                        <div class="col-md-6">


<form action="/upload" method="post" enctype="multipart/form-data">

 {{ csrf_field() }}

<div class="form-group form-md-checkboxes">


                                                    <div class="form-group form-md-radios">

                                                            <div class="md-radio has-error">
                                                                <input id="empty_whole_portfolio" name="portfolio_action" value="empty_whole_portfolio"  class="md-radiobtn" type="radio">
                                                                <label for="empty_whole_portfolio">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Empty whole portfolio before importing</label>
                                                            </div>
                                                            <div class="md-radio has-warning">
                                                                <input id="keep_realized_gain_loss" name="portfolio_action" value="keep_realized_gain_loss" class="md-radiobtn"  type="radio">
                                                                <label for="keep_realized_gain_loss">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Remove existing share but keep realized gain loss </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                <input id="dont_remove_anything" name="portfolio_action" value="dont_remove_anything" class="md-radiobtn" checked="" type="radio">
                                                                <label for="dont_remove_anything">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Dont remove anything - just import </label>
                                                            </div>

                                                    </div>

                                                <div class="md-checkbox-inline">


                                                    <div class="md-checkbox">
                                                        <input id="adjust_with_cash" name="adjust_with_cash" class="md-check" checked=""  type="checkbox">
                                                        <label for="adjust_with_cash">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Adjust with cash </label>
                                                    </div>
                                                </div>
                                            </div>
<input name="portfolio_id" type="hidden" value="{{$portfolio->id}}"/>
<input name="user_id" type="hidden" value="{{$portfolio->user_id}}"/>
<input name="commission" type="hidden" value="{{$portfolio->broker_fee}}"/>
<input name="cash_amount" type="hidden" value="{{$portfolio->cash_amount}}"/>
<input type="file" name="import_file" multiple />
<br />
<input class="btn btn-block btn-outline green  uppercase" type="submit" value="Import Portfolio (xlsx,csv,xlt)" />
<a  href="{{url('/portfolio-export/'.$portfolio->id)}}" class="btn btn-block btn-outline green  uppercase"  title="" >Export Portfolio</a>

</form>




                                        </div>
                                    </div>

                                    </div>
                                </div>


</div>

</div>



@endsection
@section('js')

{{-- AJax request is sent from js/application.js--}}
<script>
    $(".portfolio-menu").addClass('open');
    $(".portfolioActions .performance").addClass('active');
    $(function () {


        $(".showTransactionChildren").click(function () {
            $(this).addClass('hidden');
            var tr = $(this).closest('tr');
            tr.nextUntil('.normalTransaction').removeClass('hidden');
            tr.find('.hideTransactionChildren').removeClass('hidden');
        })
        $(".hideTransactionChildren").click(function () {
            $(this).addClass('hidden');
            var tr = $(this).closest('tr');

            tr.nextUntil('.normalTransaction').addClass('hidden');
            tr.find('.showTransactionChildren').removeClass('hidden');
        })
    })

</script>
@endsection



@push('scripts')

<script src="{{ asset('metronic/assets/global/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"></script>
<script src="{{ asset('metronic/assets/global/plugins/moment.min.js') }}"></script>
<script src="{{ asset('metronic_custom/datetime-moment.js') }}"></script>


@endpush



@push('css')

<link href="{{ URL::asset('metronic/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endpush