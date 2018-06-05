@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')
<style>
    form{
        border:1px solid #e1e1e1;
        padding: 5px;
        background: #f1f1f1;
        border-radius: 2px;
    }
</style>
    <div class="page-content container-fluid">

        <div class="col-md-12">
            <h4>Search</h4>
            <form  style="display: inline-block;width: 100%">
                <div class="row">
                    
                <div class="form-group col-md-3">
                    <label for="type">News Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="*">All</option>
                        <option value="Q1">Q1</option>
                        <option value="Q2">Q2</option>
                        <option value="Q3">Q3</option>
                        <option value="DIVIDEND">Dividend</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="instrument">Instrument</label>
                    <select name="instrument" id="instrument" class="form-control">
                        <option value="*">All</option>
                        @foreach(\App\Instrument::whereNotIn('sector_list_id', [24,22,23])->orderBy('instrument_code', 'asc')->get() as $instrument)
                        <option value="{{$instrument->instrument_code}}">{{$instrument->instrument_code}}</option>
                        @endforeach

                    </select>

                </div>
    
    @php 
    $startDate = request()->start?:date('Y-m-d');
    $endDate =  request()->end?:date('Y-m-d');
    @endphp
                    
                <div class="form-group col-md-3">
                    <label for="type">Start Date</label>
                    <input type="date" id="start" name="start" class="form-control" value="{{$startDate}}">
                </div>
                    
                <div class="form-group col-md-3">
                    <label for="type">End Date</label>
                    <input type="date" id="start" name="end" class="form-control"  value="{{$endDate}}">
                </div>

                </div>
                <input type="submit" value="Search" class="btn btn-success pull-right">
            </form>
        </div>

        <div class="col-md-12">

            {{-- <a href="?update=sb" onclick="return confirm('Are you sure?')" class="btn btn-warning disable" disabled >Auto Update SB Data</a> --}}
        </div>
          {{-- content start  --}}
          {{-- 
    	 	// 18 director
    	 	// 21 foreign
    	 	// 19 govt
    	 	// 20 institute
    	 	// 22 public
           --}}
            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>INSTRUMENT</th>
                    <th>POST DATE</th>
                    <th>NEWS BODY</th>
                    <th>VALUES</th>

                </thead>
                	<tbody>
                        @php $i = 1; @endphp
                        @foreach($news as $n)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$n->prefix}}</td>
                            <td>{{$n->post_date->format('d M y')}}</td>
                            @if($n->type == "Q3")
                            <td width="500px">{!!str_replace([$n->eps['q3_eps_cont_op'], $n->eps['q3_nine_months_eps'], $n->eps['q3_nine_months_nocf_per_share'], $n->eps['q3_nine_months_net_asset_val_per_share']], ["<span style='background:yellow'>".$n->eps['q3_eps_cont_op']."</span>", "<span style='background:yellow'>".$n->eps['q3_nine_months_eps']."</span>", "<span style='background:yellow'>".$n->eps['q3_nine_months_nocf_per_share']."</span>", "<span style='background:yellow'>".$n->eps['q3_nine_months_net_asset_val_per_share']."</span>"], $n->details)!!}</td>
                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">q3_eps_cont_op</label>
                                        <input type="text" class="form-control" name="227"  value="{{$n->eps['q3_eps_cont_op']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q3_nine_months_eps</label>
                                        <input type="text" class="form-control" name="308" value="{{$n->eps['q3_nine_months_eps']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q3_nine_months_nocf_per_share</label>
                                        <input type="text" class="form-control" name="319"  value="{{$n->eps['q3_nine_months_nocf_per_share']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q3_nine_months_net_asset_val_per_share</label>
                                        <input type="text" class="form-control" name="314"  value="{{$n->eps['q3_nine_months_net_asset_val_per_share']}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success form-control" style="margin-top:25px">Update</button>
                                    </div>
                                    
                                    </div>
                                </form>

                            </td>
                            @elseif($n->type == "Q2")
                            <td width="500px">{!!str_replace([$n->eps['q2_eps_cont_op'], $n->eps['half_year_eps_cont_op'], $n->eps['half_year_nocf_per_share'], $n->eps['half_year_net_asset_val_per_share']], ["<span style='background:yellow'>".$n->eps['q2_eps_cont_op']."</span>", "<span style='background:yellow'>".$n->eps['half_year_eps_cont_op']."</span>", "<span style='background:yellow'>".$n->eps['half_year_nocf_per_share']."</span>", "<span style='background:yellow'>".$n->eps['half_year_net_asset_val_per_share']."</span>"], $n->details)!!}</td>
                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">q2_eps_cont_op</label>
                                        <input type="text" class="form-control" name="226" value="{{$n->eps['q2_eps_cont_op']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">half_year_eps_cont_op</label>
                                        <input type="text" class="form-control" name="434"  value="{{$n->eps['half_year_eps_cont_op']}}">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="">half_year_nocf_per_share</label>
                                        <input type="text" class="form-control" name="320"  value="{{$n->eps['half_year_nocf_per_share']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">half_year_net_asset_val_per_share</label>
                                        <input type="text" class="form-control" name="313"  value="{{$n->eps['half_year_net_asset_val_per_share']}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success form-control" style="margin-top:25px">Update</button>
                                    </div>
                                    
                                    </div>
                                </form>

                            </td>
                            @elseif($n->type == "Q1")


                            <td width="500px">{!!str_replace([$n->eps['q1_eps_cont_op'], $n->eps['q1_nocf_per_share'], $n->eps['q1_net_asset_val_per_share']], ["<span style='background:yellow'>".$n->eps['q1_eps_cont_op']."</span>", "<span style='background:yellow'>".$n->eps['q1_nocf_per_share']."</span>", "<span style='background:yellow'>".$n->eps['q1_net_asset_val_per_share']."</span>"], $n->details)!!}</td>
                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">q1_eps_cont_op</label>
                                        <input type="text" class="form-control" name="225"  value="{{$n->eps['q1_eps_cont_op']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q1_nocf_per_share</label>
                                        <input type="text" class="form-control" name="315" value="{{$n->eps['q1_nocf_per_share']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q1_net_asset_val_per_share</label>
                                        <input type="text" class="form-control" name="310"  value="{{$n->eps['q1_net_asset_val_per_share']}}">
                                    </div>

                          
                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success form-control" style="margin-top:25px">Update</button>
                                    </div>
                                    
                                    </div>
                                </form>

                            </td>

                            @elseif($n->type == "DIVIDEND")
{{--              return $data =  ['earning_per_share' => $eps, 'net_asset_val_per_share' => $nav,  'nocf_per_share' => $noc, 'meta_date' => $date, 'cashdiv' => $cash, 'stockdiv' => $stock]; --}}
                            <td width="500px">
                                {{-- {{dump($n->eps['stockdiv'])}} --}}
                                {!!str_replace([$n->eps['earning_per_share'], $n->eps['net_asset_val_per_share'], $n->eps['nocf_per_share'],  $n->eps['cashdiv']."%",  $n->eps['stockdiv']."%" ], ["<span style='background:yellow'>".$n->eps['earning_per_share']."</span>", "<span style='background:yellow'>".$n->eps['net_asset_val_per_share']."</span>", "<span style='background:yellow'>".$n->eps['nocf_per_share']."</span>", "<span style='background:yellow'>".$n->eps['cashdiv']."%</span>", "<span style='background:yellow'>".$n->eps['stockdiv']."%</span>"], $n->fulldetails)!!}</td>
                                
                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">earning_per_share</label>
                                        <input type="text" class="form-control" name="201"  value="{{$n->eps['earning_per_share']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">net_asset_val_per_share</label>
                                        <input type="text" class="form-control" name="205" value="{{$n->eps['net_asset_val_per_share']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">nocf_per_share</label>
                                        <input type="text" class="form-control" name="318"  value="{{$n->eps['nocf_per_share']}}">
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">stock_dividend</label>
                                        <input type="text" class="form-control" name="211"  value="{{$n->eps['stockdiv']}}">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">cash_dividend</label>
                                        <input type="text" class="form-control" name="245"  value="{{$n->eps['cashdiv']}}">
                                    </div>

                          

                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success form-control" style="margin-top:25px">Update</button>
                                    </div>
                                    
                                    </div>
                                </form>

                            </td>

                            @else
                                <td >{{$n->details}}</td>
                                <td style="color:red">Can't Recognized</td>
                            @endif
                        </tr>
                        @endforeach
                
                	</tbody>
            </table>
            @php 
                if(request()->has('type')){
                    $news->appends(['type' => request()->type]);
                }
                if(request()->has('instrument')){
                    $news->appends(['instrument' => request()->instrument]);
                }
                if(request()->has('start')){
                    $news->appends(['start' => request()->start]);
                }
                if(request()->has('end')){
                    $news->appends(['end' => request()->end]);
                }
             @endphp
            {{ $news->links() }}

                    @if(request()->has('instrument'))
                    <script>
                        document.getElementById('instrument').value = "{{request()->instrument}}"
                    </script>
                    @endif
                    @if(request()->has('type'))
                    <script>
                        document.getElementById('type').value = "{{request()->type}}"
                    </script>
                    @endif            
          {{-- content end  --}}
    </div><!-- .page-content container-fluid -->
@stop
