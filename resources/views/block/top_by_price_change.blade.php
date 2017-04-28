<div class="scroller" style="height:250px" data-rail-visible="1" data-always-visible="1"
     data-rail-color="yellow" data-handle-color="#a1b2bd">
    <div class="table-scrollable table-scrollable-borderless" id="gain_by_percentage">
        <!--<table class="table table-hover table-light">-->

        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Code
                </th>
                <th class="numeric">
                    Price
                </th>
                <th class="numeric">
                    Volume
                </th>
                <th class="numeric">
                    Ltp
                </th>
                <th class="numeric">
                    Change
                </th>

            </tr>
            </thead>
            <tbody>


            @foreach($viewData['topList'] as $instrumentId=>$instrument)
                <tr>
                    <td>


                        <div class="btn-group">
                            <a class="#" href="javascript:;" data-placement="right" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">  {{$viewData['instrumentList'][$instrumentId]->instrument_code}}
                            </a>
                            <ul class="dropdown-menu">

                                <li>
                                    <a href="javascript:;" target="_blank">TA Chart</a>
                                </li>
                                <li>
                                    <a href="javascript:;" target="_blank">Minute Chart</a>
                                </li>
                                <li>
                                    <a href="javascript:;" target="_blank">Company Details</a>
                                </li>
                            </ul>
                        </div>


                    </td>

                    <td>
                                @if($instrument->price_change<0)
                                    <span class="{{$viewData['inlinesparkline']}}"  sparklineColor ="red">{{$viewData['minuteDataOfTopList'][$instrumentId]->implode('close_price', ', ')}}</span>
                                @else
                                    <span class="{{$viewData['inlinesparkline']}}"  sparklineColor ="green">{{$viewData['minuteDataOfTopList'][$instrumentId]->implode('close_price', ', ')}}</span>
                                @endif
                    </td>

                    <td>

                                @if($instrument->price_change<0)
                                    <span class="{{$viewData['inlinesparkline']}}" sparkType="bar" sparkbarcolor ="red">{{$viewData['minuteDataOfTopList'][$instrumentId]->slice(0,14)->implode('total_volume_difference', ', ')}}</span>
                                @else
                                    <span class="{{$viewData['inlinesparkline']}}" sparkType="bar" sparkbarcolor ="green">{{$viewData['minuteDataOfTopList'][$instrumentId]->slice(0,14)->implode('total_volume_difference', ', ')}}</span>
                                @endif
                    </td>


                    <td class="success">
                        {{$instrument['close_price']}}
                    </td>
                    <td class="numeric">
                        {{$instrument['price_change']}}({{$instrument['price_change_per']}}%)
                    </td>


                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="scroller-footer">

</div>


@push('scripts')
<script src="{{ asset('metronic_custom/jquery.sparkline.min.js') }}"></script>
<script>
 $('.{{$viewData['inlinesparkline']}}').sparkline('html', {
            enableTagOptions: true,
            disableHiddenCheck: true,

            height: '20px'
            //width: '100px'
        });
</script>
@endpush