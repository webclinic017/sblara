<div class="portlet light">
<div class="portlet-body">


    <div class="scroller" style="height:300px" data-rail-visible="1" data-always-visible="1"
         data-rail-color="yellow" data-handle-color="#a1b2bd">
        <div class="mt-element-list">
            <div class="mt-list-head list-simple ext-1 font-white bg-green-sharp">
                <div class="list-head-title-container">
                    <div class="list-date">{{$viewData['totalValueList']->first()->lm_date_time->format('d-m-Y')}}</div>
                    <h3 class="list-title">Significant value at {{$viewData['totalValueList']->first()->lm_date_time->format('h:i')}}</h3>
                </div>
            </div>
            <div class="mt-list-container list-simple ext-1">
                <ul>

                        @foreach($viewData['totalValueList'] as $instrumentId=>$instrument)

                        <li class="mt-list-item done">
                            <div class="list-icon-container">
                                @if($instrument->price_change<0)
                                    <span class="inlinesparkline_value"  sparklineColor ="red">{{$viewData['totalValueData'][$instrumentId]->implode('close_price', ', ')}}</span>
                                @else
                                    <span class="inlinesparkline_value"  sparklineColor ="green">{{$viewData['totalValueData'][$instrumentId]->implode('close_price', ', ')}}</span>
                                @endif
                            </div>
                            <div class="list-datetime-c">

                                @if($instrument->price_change<0)
                                    <span class="inlinesparkline_value" sparkType="bar" sparkbarcolor ="red">{{$viewData['totalValueData'][$instrumentId]->slice(0,14)->implode('total_value_difference', ', ')}}</span>
                                @else
                                    <span class="inlinesparkline_value" sparkType="bar" sparkbarcolor ="green">{{$viewData['totalValueData'][$instrumentId]->slice(0,14)->implode('total_value_difference', ', ')}}</span>

                                @endif

                            </div>
                            <div class="list-item-content">
                                <h3 class="uppercase">
                                    <a href="javascript:;">{{$viewData['instrumentList'][$instrumentId]->instrument_code}}</a> ({{$instrument['total_value_growth']*1000000}} Tk.)
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
 $('.inlinesparkline_value').sparkline('html', {
            enableTagOptions: true,
            disableHiddenCheck: true,

            height: '20px'
            //width: '100px'
        });
</script>
@endpush