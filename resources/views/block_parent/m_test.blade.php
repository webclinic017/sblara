<div class="row">
        <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								52 Week Stats</span>
                        <span class="caption-helper">Yearly high low</span>
                    </div>
                    <div class="tools">
                                                {{--<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.yearly_high_low:limit=30:instrument_id=13" class="reload"></a>--}}

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
                @include('block.yearly_high_low',['instrument_id'=>$instrument_id])
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
        <div class="col-md-6">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Trade Activities</span>
                        <span class="caption-helper">Insight of trades</span>
                    </div>
                    <div class="tools">
                                                {{--<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.trade_activity:limit=30:instrument_id=13" class="reload"></a>--}}

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">
                @include('block.trade_activity',['instrument_id'=>$instrument_id])
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>