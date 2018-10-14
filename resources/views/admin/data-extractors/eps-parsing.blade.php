<?php
set_time_limit(0);
if(request()->has('reload'))
{
    \Cache::forget('dse_eps');
    header('Location: /admin/data-extractors/eps-parsing');
    die();
}
$data = \Cache::rememberForever('dse_eps', function ()
{
    $data = file_get_contents("http://www.dsebd.org/latest_PE_all2_08.php");
    return $data;
});
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
$meta_ids = \App\Meta::whereIn('meta_key', ['earning_per_share', 'q1_eps_cont_op', 'q3_nine_months_eps', 'half_year_eps_cont_op'])->pluck('id')->toArray();
$meta_ids = join(',', $meta_ids);

$q = "select instruments.instrument_code, 

round((fundamentals.meta_value * 12)/(CASE
WHEN metas.meta_key = 'earning_per_share' THEN 12
WHEN metas.meta_key = 'q1_eps_cont_op' THEN 3
WHEN metas.meta_key = 'half_year_eps_cont_op' THEN 6
WHEN metas.meta_key = 'q3_nine_months_eps' THEN 9
END), 2)

earning_per_share

from (SELECT f1.instrument_id, f1.meta_id, f1.meta_value, max(f1.meta_date) meta_date FROM fundamentals f1
   where meta_id in ($meta_ids) 
               and is_latest = 1
               group by instrument_id
   ) fn  
   left join instruments on instruments.id = fn.instrument_id
   left JOIN fundamentals on fn.instrument_id = fundamentals.instrument_id and fn.meta_date = fundamentals.meta_date AND fundamentals.is_latest = 1 and fundamentals.meta_id in ($meta_ids)
   left join metas on metas.id = fundamentals.meta_id
   where instruments.active = '1'
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
            <a  href="?reload=true" class="btn btn-success pull-right">Reload DSE data</a>
            <table class="table table-striped datatable">
                <thead>
                    <tr>    
                        <th rowspan="2">#</th>
                        <th rowspan="2">Instrument</th>
                        {{-- <th colspan="2">LTP</th> --}}
                        <th colspan="2">EPS</th>
                        <th rowspan="2">Difference</th>
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
                        $diff = '0';
                    if($instrument->earning_per_share !=  @$data[$instrument->instrument_code]['eps'])
                    {
                        $color = "style='color:red'";
                        $d = (double) @$data[$instrument->instrument_code]['eps'];
                        $e =  (double) $instrument->earning_per_share;
                        $diff = $e  -  $d;
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
                        <td {!! $color !!}>{{number_format($diff, 2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

          {{-- content end  --}}
    </div><!-- .page-content container-fluid -->
@stop
