<?php
set_time_limit(0);
$data = file_get_contents("http://www.dsebd.org/latest_PE_all2_08.php");
$doc = new DOMDocument();
@$doc->loadHTML($data);
$xpath = new DOMXpath($doc);
$elements = $xpath->query("/html/body/div/table/tr");
    $i = 0;
    $data = [];
foreach ($elements as $key => $value) {
    $tds = $value->getElementsByTagName('td');
        $i++;
        if($i <= 1)
        {
            continue;
        }    
        $code = $tds->item(1)->nodeValue;
        (float) $ycp = $tds->item(3)->nodeValue;
        (float) $pe = $tds->item(4)->nodeValue;
        @$eps = $ycp / $pe;
        $eps = number_format($eps, 2);
        $data[$code] = ['ycp' => $ycp, 'pe' => $pe, 'eps' => $eps];
    }
$q = "
            SELECT instruments.instrument_code, fundamental.earning_per_share FROM instruments
            LEFT JOIN
            (select *,
                max(case when meta_key = 'earning_per_share' then  meta_value end) earning_per_share 
                from
                 (SELECT meta_key, meta_id, meta_value, instrument_id FROM `fundamentals`   
                left join metas on metas.id = fundamentals.meta_id where  meta_key = 'earning_per_share'
                and is_latest = '1' ) funda
                group by funda.instrument_id) fundamental
                  on instruments.id = fundamental.instrument_id
                  WHERE instruments.active = '1'    
                  order by instrument_code asc
";
$instruments = \DB::select(\DB::raw($q));
$i = 1;
?>



@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
    <div class="page-content container-fluid">
        <div class="col-md-12">

        </div>
          {{-- content start  --}}
            
            <table class="table table-striped">
                <thead>
                    <tr>    
                        <th rowspan="2">#</th>
                        <th rowspan="2">Instrument</th>
                        {{-- <th colspan="2">LTP</th> --}}
                        <th colspan="2">EPS</th>
                    </tr>
                    <tr>
     {{--                    <th>SB</th>
                        <th>DSE</th> --}}
                        <th>SB</th>
                        <th>DSE</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($instruments as $instrument)
                    @php
                        $color = "";
                    if($instrument->earning_per_share !=  @$data[$instrument->instrument_code]['eps'])
                    {
                        $color = "style='color:red'";
                    }
                    @endphp
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$instrument->instrument_code }}</td>
                  {{--       <td></td>
                        <td></td> --}}
                        <td {!!$color!!}>{{$instrument->earning_per_share }}</td>
                        <td {!!$color!!} >
                            {{ @$data[$instrument->instrument_code]['eps'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

          {{-- content end  --}}
    </div><!-- .page-content container-fluid -->
@stop
