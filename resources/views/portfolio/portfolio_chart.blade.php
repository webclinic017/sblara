@foreach($portfolio_holdings as $transaction)
<div class="row">
        <div class="col-md-4">

                            <div class="btn-group btn-group btn-group-justified">
                                <a target="_blank" href="{{'/ta-chart?instrumentCode='.$transaction->instrument_code}}" class="btn red"> TA Chart  </a>
                                <a target="_blank" href="{{'/company-details/'.$transaction->instrument_id}}" class="btn blue"> Company Details </a>


                            </div>



                    <div class="portlet light bordered">
                                      <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-graph font-yellow-casablanca"></i>
                                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                                    Minute Chart </span>

                                              </div>
                                                <div class="tools">
                                                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.minute_chart:height=247:instrument_id={{$transaction->instrument_id}}" class="reload"></a>

                                                    <a href="" class="collapse">
                                                    </a>

                                                </a>
                                                <a href="" class="remove">
                                                </a>
                                            </div>
                                        </div>

                                    <div class="portlet-body">

                                    </div>

        </div>
        </div>
        <div class="col-md-4">
        <div class="btn-group btn-group btn-group-justified">
            <a target="_blank" href="{{'/fundamental-details/'.$transaction->instrument_id}}" class="btn green"> Fundamental Details </a>
            <a target="_blank" href="{{'/news/search?keyword=&instrument_id='.$transaction->instrument_id.'&from_date=&to_date='}}" class="btn red">{{$transaction->instrument_code}} News</a>

        </div>

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sector chart </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:height=247:instrument_id={{$transaction->instrument_id}}" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="btn-group btn-group btn-group-justified">

            <a target="_blank" href="{{'/minute-chart/'.$transaction->instrument_id}}" class="btn blue"> Minute Chart </a>
            <a target="_blank" href="{{'/advance-ta-chart?instrumentCode='.$transaction->instrument_code}}" class="btn green"> Advance TA Chart </a>

        </div>

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								{{$transaction->instrument_code}} Movement </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">


                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
                                                        <div class="mt-element-overlay">
                                                            <div class="row">

                                                                </div>
                                                                    <div class="mt-overlay-1 mt-scroll-down">
                                                                        <img src="{{url("/tooltip_chart")}}/{{$transaction->instrument_id}}">
                                                                        <div class="mt-overlay">
                                                                            <ul class="mt-info">
                                                                                <li>
                                                                                    <a target="_blank" class="btn default btn-outline" href="{{'/ta-chart?instrumentCode='.$transaction->instrument_code}}">
                                                                                        <i class="icon-magnifier"></i>
                                                                                    </a>
                                                                                </li>
                                                                                <li>
                                                                                    <a target="_blank" class="btn default btn-outline" href="{{'/advance-ta-chart?instrumentCode='.$transaction->instrument_code}}">
                                                                                        <i class="icon-link"></i>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
               {{-- <div class="portlet-body">
                <div class="row">
                <img class="thumbnail" src="https://dev.stockbangladesh.com/tooltip_chart/{{$transaction->instrument_id}}" />
                </div>

                </div>--}}
            </div>
        </div>
</div>
        @endforeach




<script>
$('.reload').click();

</script>
