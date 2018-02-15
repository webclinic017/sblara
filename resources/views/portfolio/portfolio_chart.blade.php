
@foreach($portfolio_holdings as $transaction)
<div class="row">
        <div class="col-md-6">

                            <div class="btn-group btn-group btn-group-justified">
                                <a target="_blank" href="{{'/ta-chart?instrumentCode='.$transaction->instrument_code}}" class="btn red"> TA Chart  </a>
                                <a target="_blank" href="{{'/company-details/'.$transaction->instrument_id}}" class="btn blue"> Company Details </a>
                                <a target="_blank" href="{{'/fundamental-details/'.$transaction->instrument_id}}" class="btn green"> Fundamental Details </a>

                            </div>



                    <div class="portlet light bordered">
                                      <div class="portlet-title tabbable-line">
                                            <div class="caption">
                                                <i class="icon-graph font-yellow-casablanca"></i>
                                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                                    Minute Chart </span>

                                              </div>
                                                <div class="tools">
                                                    <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.minute_chart:instrument_id={{$transaction->instrument_id}}" class="reload"></a>

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
        <div class="col-md-6">
        <div class="btn-group btn-group btn-group-justified">
            <a target="_blank" href="{{'/news/search?keyword=&instrument_id='.$transaction->instrument_id.'&from_date=&to_date='}}" class="btn red">{{$transaction->instrument_code}} News</a>
            <a target="_blank" href="{{'/minute-chart/'.$transaction->instrument_id}}" class="btn blue"> Minute Chart </a>
            <a target="_blank" href="{{'/advance-ta-chart?instrumentCode='.$transaction->instrument_code}}" class="btn green"> Advance TA Chart </a>

        </div>

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sector chart </span>
                        <span class="caption-helper">Watch every minute's sector movement</span>
                    </div>
                    <div class="tools">
                                                <a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:instrument_id={{$transaction->instrument_id}}" class="reload"></a>

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
</div>
        @endforeach




<script>
$('.reload').click();

</script>
