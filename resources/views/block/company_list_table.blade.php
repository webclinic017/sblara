    <table id="myTable" class="table table-striped table-bordered table-advance table-hover dt-responsive">
        <thead>
            <tr>
                <th><i class="fa fa-briefcase"></i> Company </th>
                <th> Action </th>
                <th> Op </th>
                <th> Hi </th>
                <th> Lo </th>
                <th> Ltp </th>
                <th> CP </th>
                <th> YCP </th>
                <th> Chg </th>
                <th> Chg % </th>
                <th> Vol </th>
                <th> Trd </th>
                <th> Value </th>
                <th> Upd </th>

            </tr>
        </thead>
        <tbody>
        @foreach($all_data as $data)
            <tr>
            @if(($data->close_price-$data->yday_close_price)>0)

                <td class="highlight"><div class="success"></div> <a href="javascript:;">@include('html.tooltip_chart',array('instrumentId'=>$data->instrument_id,'instrument_code'=>$data->instrument_code))</a></td>
            @endif
            @if(($data->close_price-$data->yday_close_price)<0)
                <td class="highlight"><div class="danger"></div> <a href="javascript:;">@include('html.tooltip_chart',array('instrumentId'=>$data->instrument_id,'instrument_code'=>$data->instrument_code))</a></td>
            @endif
            @if(($data->close_price-$data->yday_close_price)==0)
                <td class="highlight"><div class="info"></div> <a href="javascript:;">@include('html.tooltip_chart',array('instrumentId'=>$data->instrument_id,'instrument_code'=>$data->instrument_code))</a></td>
            @endif
                <td> <div class="btn-group">
                     <button class="btn green btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Go To
                         <i class="fa fa-angle-down"></i>
                     </button>
                     <ul class="dropdown-menu" role="menu">
                         <li>
                             <a target="_blank" href="{{url('/ta-chart?instrumentCode='.$data->instrument_code)}}"> TA Chart </a>
                         </li>
                         <li>
                             <a target="_blank" href="{{url('/advance-ta-chart?instrumentCode='.$data->instrument_code)}}"> Advance TA Chart </a>
                         </li>
                                                  <li>
                                                      <a target="_blank" href="{{url('/minute-chart/'.$data->instrument_id)}}"> Minute Chart </a>
                                                  </li>

                                                  <li>
                                                      <a target="_blank" href="{{url('/news-chart/'.$data->instrument_id)}}"> News Chart </a>
                                                  </li>



                         <li>
                             <a target="_blank" href="{{url('/company-details/'.$data->instrument_id)}}"> Company Details </a>
                         </li>
                         <li>
                             <a target="_blank" href="{{url('/fundamental-details/'.$data->instrument_id)}}"> Fundamental Details </a>
                         </li>
                         <li>
                             <a target="_blank" href="{{url('/news/search?keyword=&instrument_id='.$data->instrument_id.'&from_date=&to_date=')}}"> News</a>
                         </li>
                         <li class="divider"> </li>
                         <li>
                             <a href="javascript:;"> Separated link </a>
                         </li>
                     </ul>
                 </div>
                 </td>
               <td> {{$data->open_price}} </td>

                <td> {{$data->high_price}} </td>
                <td> {{$data->low_price}} </td>
                <td> {{$data->pub_last_traded_price}} </td>
                <td> {{$data->close_price}} </td>
                <td> {{$data->yday_close_price}} </td>
                <td> {{round($data->close_price-$data->yday_close_price,2)}} </td>
                <td> {{round(($data->close_price-$data->yday_close_price)/$data->yday_close_price*100,2)}}% </td>
                <td> {{$data->total_volume}} </td>
                <td> {{$data->total_trades}} </td>
                <td> {{$data->total_value}} </td>
                <td> {{date('d-M, H:i',strtotime($data->lm_date_time))}} </td>
            </tr>
        @endforeach

        </tbody>
    </table>





<script>
    $(function () {
    $('#myTable').DataTable( {
            "paging":   false
        } );


    });



</script>



