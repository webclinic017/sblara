<style>
.popover{
    max-width:600px;
    height:350px;

}
</style>

<div class="scroller" style="height:350px" data-rail-visible="1" data-always-visible="1"
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
                    LTP
                </th>
                <th class="numeric">
                    Change
                </th>
                <th class="numeric">
                    Value(mn)
                </th>
                <th class="numeric">
                    Trades
                </th>


            </tr>
            </thead>
            <tbody>


            @foreach($top_list as $instrument)
                <tr>
                    <td>


                        @include('html.tooltip_chart',array('instrumentId'=>$instrument->instrument_id,'instrument_code'=>$instrument->instrument_code))


                    </td>

                    <td>
                             {{cpOrLtp($instrument)}}
                    </td>
                    <td class="{{fontCss($instrument->pchange_per)}}">
                        {{round($instrument->pchange_per,2)}}%
                    </td>
                    <td >
                        {{round($instrument->total_value,2)}}
                    </td>

                    <td class="success">
                        {{$instrument->total_trades}}
                    </td>


                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
</div>