<div class="portlet light">
<div class="portlet-body">


    <div class="scroller" style="height:300px" data-rail-visible="1" data-always-visible="1"
         data-rail-color="yellow" data-handle-color="#a1b2bd">
        <div class="mt-element-list">
            <div class="mt-list-head list-simple ext-1 font-white bg-green-sharp">
                <div class="list-head-title-container">
                    <div class="list-date">{{$viewData['totalTradeList']->first()->lm_date_time->format('d-m-Y')}}</div>
                    <h3 class="list-title">Significant trade at {{$viewData['totalTradeList']->first()->lm_date_time->format('h:i')}}</h3>
                </div>
            </div>
            <div class="mt-list-container list-simple ext-1">
                <ul>

                        @foreach($viewData['totalTradeList'] as $instrumentId=>$instrument)

                        <li class="mt-list-item done">
                            <div class="list-icon-container">
                                @if($instrument->price_change<0)
                                    <span class="inlinesparkline_trade"  sparklineColor ="red">{{$viewData['totalTradeData'][$instrumentId]->implode('close_price', ', ')}}</span>
                                @else
                                    <span class="inlinesparkline_trade"  sparklineColor ="green">{{$viewData['totalTradeData'][$instrumentId]->implode('close_price', ', ')}}</span>
                                @endif
                            </div>
                            <div class="list-datetime-c">

                                @if($instrument->price_change<0)
                                    <span class="inlinesparkline_trade" sparkType="bar" sparkbarcolor ="red">{{$viewData['totalTradeData'][$instrumentId]->slice(0,14)->implode('total_trades_difference', ', ')}}</span>
                                @else
                                    <span class="inlinesparkline_trade" sparkType="bar" sparkbarcolor ="green">{{$viewData['totalTradeData'][$instrumentId]->slice(0,14)->implode('total_trades_difference', ', ')}}</span>

                                @endif

                            </div>
                            <div class="list-item-content">
                                <h3 class="uppercase">
                                    <a href="javascript:;">{{$viewData['instrumentList'][$instrumentId]->instrument_code}}</a> ({{$instrument['total_trades_growth']}} trades)
                                </h3>
                            </div>

                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>


</div>
</div>


@push('scripts')
<script src="{{ asset('metronic_custom/jquery.sparkline.min.js') }}"></script>
<script>
 $('.inlinesparkline_trade').sparkline('html', {
            enableTagOptions: true,
            disableHiddenCheck: true,

            height: '20px'
            //width: '100px'
        });
</script>
@endpush