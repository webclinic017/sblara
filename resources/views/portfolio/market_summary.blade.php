
@foreach($portfolio_holdings as $transaction)
<div class="row">
        <div class="col-md-6">

                    {{--@include('block.minute_chart', array('instrument_id' => $transaction->instrument_id))--}}


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

  <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                   @include('ads.google_responsive')
                </div>
            </div>
        </div>
    </div>


        @endforeach




<script>
$('.reload').click();

</script>
