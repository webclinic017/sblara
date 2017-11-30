@extends('layouts.metronic.default')
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
              IPO Results
           </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            @foreach( $ipos as $ipo )
            <div class="panel-group accordion" id="ipo-accordion_{{$ipo->id}}">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_{{$ipo->id}}" aria-expanded="false"> <span><h3>{{$ipo->ipo_name}}</h3></span> <br>
                                <span>SUBSCRIPTION PERIOD: SUNDAY, SEP 24, 2017 -- TUESDAY, OCT 03, 2017</span>
                             </a>
                        </h4>
                    </div>
                    <div id="collapse_{{$ipo->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <ul>
                                    <li><a href="{{$ipo->bank_code?asset($ipo->bank_code):'javascript:'}}">Bank / Branch Code</a></li>
                                    <li><a href="{{$ipo->result_general?asset($ipo->result_general):'javascript:'}}">General Public [Other than NRB]</a></li>
                                    <li><a href="{{$ipo->result_nrb?asset($ipo->result_nrb):'javascript:'}}">Non - Resident Bangladeshi (NRB)</a></li>
                                    <li><a href="{{$ipo->result_mutual_fund?asset($ipo->result_mutual_fund):'javascript:'}}">Mutual Fund</a></li>
                                    <li><a href="{{$ipo->bank_code?asset($ipo->bank_code):'javascript:'}}">Affected Small Investor</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</div>
@endsection
