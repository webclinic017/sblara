        <table class="table table-hover flip-content">
            <thead class="flip-content">
            <tr>
                <th>
                    Sector
                </th>
                <th class="numeric">
                    {{$prevDate}} (M)
                </th>
                <th class="numeric">
                    {{$todayDate}} (M)
                </th>
                <th class="numeric">
                    CHANGES
                </th>
                <th class="numeric">
                    CHANGES%
                </th>
                <th class="numeric">
                  CONTRI % ({{$prevDate}})
                </th>
                <th class="numeric">
                   CONTRI % ({{$todayDate}})
                </th>
                <th class="numeric">
                   CHANGES
                </th>

            </tr>
            </thead>
            <tbody>


            @foreach($return as $data)
               <tr>
                    <td>{{$data['sector']}}</td>
                    <td>{{$data['prev_day']}}</td>
                    <td>{{$data['today']}}</td>
                    <td>{{$data['changes']}}</td>
                    <td>{{$data['changes_per']}}%</td>
                    <td>{{$data['contribution_today']}}</td>
                    <td>{{$data['contribution_prev_day']}}</td>
                    <td>{{$data['contribution_change']}}%</td>
               </tr>

            @endforeach
                           <tr>
                                <td>Total</td>
                                <td>{{$marketTotalPrev}} (Million)</td>
                                <td>{{$marketTotalToday}} (Million)</td>
                                <td>{{$marketTotalChange}} (Million)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                           </tr>
                           <tr>
                                <td>Oddlot</td>
                                <td>0 (Million)</td>
                                <td>0 (Million)</td>
                                <td>0 (Million)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                           </tr>
                           <tr>
                                <td>Block</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                           </tr>
                           <tr>
                                <td>Grand Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                           </tr>

            </tbody>
        </table>