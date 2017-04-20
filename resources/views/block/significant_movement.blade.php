<div class="portlet light">
<div class="portlet-body">


    <div class="scroller" style="height:300px" data-rail-visible="1" data-always-visible="1"
         data-rail-color="yellow" data-handle-color="#a1b2bd">
        <div class="mt-element-list">
            <div class="mt-list-head list-simple ext-1 font-white bg-green-sharp">
                <div class="list-head-title-container">
                    <div class="list-date">16-04-2017</div>
                    <h3 class="list-title">Significant value at 1:30 PM</h3>
                </div>
            </div>
            <div class="mt-list-container list-simple ext-1">
                <ul>

                        @foreach($viewData['totalValueList'] as $instrumentId=>$instrument)

                        <li class="mt-list-item done">
                            <div class="list-icon-container">
                                @if($instrument->price_change<0)
                                    <span class="inlinesparkline"  sparklineColor ="red">{{$viewData['totalValueData'][$instrumentId]->implode('close_price', ', ')}}</span>
                                @else
                                    <span class="inlinesparkline"  sparklineColor ="green">{{$viewData['totalValueData'][$instrumentId]->implode('close_price', ', ')}}</span>
                                @endif
                            </div>
                            <div class="list-datetime-c">

                                @if($instrument->price_change<0)
                                    <span class="inlinesparkline" sparkType="bar" sparklineColor ="red">{{$viewData['totalValueData'][$instrumentId]->implode('total_value_difference', ', ')}}</span>
                                @else
                                    <span class="inlinesparkline" sparkType="bar" sparklineColor ="green">{{$viewData['totalValueData'][$instrumentId]->implode('total_value_difference', ', ')}}</span>

                                @endif

                            </div>
                            <div class="list-item-content">
                                <h3 class="uppercase">
                                    <a href="javascript:;">{{$viewData['instrumentList'][$instrumentId]->instrument_code}}</a>   ( 44444 Tk.)
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
 $('.inlinesparkline').sparkline('html', {
            enableTagOptions: true,
            disableHiddenCheck: true,

            height: '20px'
            //width: '100px'
        });
</script>
@endpush