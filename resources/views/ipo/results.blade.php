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
                                <div class="center form-group" >    
                        <select class="form-control" id="year" onchange="window.location.href='?year='+this.value">
                            <option>Select a Year</option>
                            {!!yearsAsOption()!!}
                         </select>
                        </div>
            @if(count($ipos) == 0)
            Currently there is no IPO. Please check again later.
            @endif
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
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach($ipo->attachments as $attachment)
                                    <li><a href="{{$attachment->path?asset($attachment->path):'javascript:'}}">{{$attachment->title}}</a></li>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                   </ul>
                                   @if(!$i)
                                   No data found
                                   @endif
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
