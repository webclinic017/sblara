@extends('voyager::master')

@section('page_title', __('voyager.generic.media'))

@section('content')

<!-- Modal -->
<div id="historyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">History</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<style>
    form{
        border:1px solid #e1e1e1;
        padding: 5px;
        background: #f1f1f1;
        border-radius: 2px;
    }
    .oldData{
        /*background: #eee;*/
        width: 100%;
        text-align: center;
        padding: 5px;
    background: #f1f1f1;
        /*font-weight: bold;*/
        /*background: red;*/
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
                            <td width="500px">{!!str_replace([str_replace('-', '', $n->eps['q3_eps_cont_op']), str_replace('-', '', $n->eps['q3_nine_months_eps']), str_replace('-', '', $n->eps['q3_nine_months_nocf_per_share']), str_replace('-', '', $n->eps['q3_nine_months_net_asset_val_per_share'])], ["<span style='background:yellow'>".$n->eps['q3_eps_cont_op']."</span>", "<span style='background:yellow'>".$n->eps['q3_nine_months_eps']."</span>", "<span style='background:yellow'>".$n->eps['q3_nine_months_nocf_per_share']."</span>", "<span style='background:yellow'>".$n->eps['q3_nine_months_net_asset_val_per_share']."</span>"], $n->details)!!}</td>
                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">q3_eps_cont_op</label>
                                        <input type="text" class="form-control" name="227"  value="{{$n->eps['q3_eps_cont_op']}}">

                                        <label class="oldData" style="color:@if($n->eps['q3_eps_cont_op']== @$fdata[$n->instrument_id][227]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][227]['meta_value']}} <a class='history' > History</a></label> 
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q3_nine_months_eps</label>
                                        <input type="text" class="form-control" name="308" value="{{$n->eps['q3_nine_months_eps']}}">

                                        <label class="oldData" style="color:@if($n->eps['q3_nine_months_eps']== @$fdata[$n->instrument_id][308]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][308]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q3_nine_months_nocf_per_share</label>
                                        <input type="text" class="form-control" name="319"  value="{{$n->eps['q3_nine_months_nocf_per_share']}}">

                                        <label class="oldData" style="color:@if($n->eps['q3_nine_months_nocf_per_share']== @$fdata[$n->instrument_id][319]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][319]['meta_value']}} <a class='history' > History</a></label>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q3_nine_months_net_asset_val_per_share</label>
                                        <input type="text" class="form-control" name="314"  value="{{$n->eps['q3_nine_months_net_asset_val_per_share']}}">

                                        <label class="oldData" style="color:@if($n->eps['q3_nine_months_net_asset_val_per_share']== @$fdata[$n->instrument_id][314]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][314]['meta_value']}} <a class='history' > History</a></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">

                                        {{-- meta date compare --}}
                                          @php 
                                        
                                        if(isset($fdata[$n->instrument_id][227]['meta_date'])){
                                        $m_date = @$fdata[$n->instrument_id][227]['meta_date']->format('Y-m-d') ; 
                                        }else{
                                            $m_date = null;
                                        }
                                        @endphp
                                        <label class="oldData" style="color:@if($n->eps['meta_date']== $m_date) green @else red  @endif" >{{$m_date}} <a class='history' > History</a></label>
                                        {{-- meta date compare --}}

                                    </div>

                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success form-control" style="margin-top:25px">Update</button>
                                    </div>
                                    
                                    </div>
                                </form>

                            </td>
                            @elseif($n->type == "Q2")
                            <td width="500px">{!!str_replace([str_replace('-', '', $n->eps['q2_eps_cont_op']), str_replace('-', '', $n->eps['half_year_eps_cont_op']), str_replace('-', '', $n->eps['half_year_nocf_per_share']), str_replace('-', '', $n->eps['half_year_net_asset_val_per_share'])], ["<span style='background:yellow'>".$n->eps['q2_eps_cont_op']."</span>", "<span style='background:yellow'>".$n->eps['half_year_eps_cont_op']."</span>", "<span style='background:yellow'>".$n->eps['half_year_nocf_per_share']."</span>", "<span style='background:yellow'>".$n->eps['half_year_net_asset_val_per_share']."</span>"], $n->details)!!}</td>
                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">q2_eps_cont_op</label>
                                        <input type="text" class="form-control" name="226" value="{{$n->eps['q2_eps_cont_op']}}">

                                        <label class="oldData" style="color:@if($n->eps['q2_eps_cont_op']== @$fdata[$n->instrument_id][226]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][226]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">half_year_eps_cont_op</label>
                                        <input type="text" class="form-control" name="434"  value="{{$n->eps['half_year_eps_cont_op']}}">
                                        <label class="oldData" style="color:@if($n->eps['half_year_eps_cont_op']== @$fdata[$n->instrument_id][434]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][434]['meta_value']}} <a class='history' > History</a></label>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="">half_year_nocf_per_share</label>
                                        <input type="text" class="form-control" name="320"  value="{{$n->eps['half_year_nocf_per_share']}}">

                                        <label class="oldData" style="color:@if($n->eps['half_year_nocf_per_share']== @$fdata[$n->instrument_id][320]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][320]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">half_year_net_asset_val_per_share</label>
                                        <input type="text" class="form-control" name="313"  value="{{$n->eps['half_year_net_asset_val_per_share']}}"> 

                                        <label class="oldData" style="color:@if($n->eps['half_year_net_asset_val_per_share']== @$fdata[$n->instrument_id][313]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][313]['meta_value']}} <a class='history' > History</a></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">

                                        {{-- meta date compare --}}
                                          @php 
                                        
                                        if(isset($fdata[$n->instrument_id][226]['meta_date'])){
                                        $m_date = @$fdata[$n->instrument_id][226]['meta_date']->format('Y-m-d') ; 
                                        }else{
                                            $m_date = null;
                                        }
                                        @endphp

                                        <label class="oldData" style="color:@if($n->eps['meta_date'] == $m_date) green @else red  @endif" >{{$m_date}} <a class='history' > History</a></label>
                                        {{-- meta date compare --}}
                                    </div>

                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success form-control" style="margin-top:25px">Update</button>
                                    </div>
                                    
                                    </div>
                                </form>

                            </td>
                            @elseif($n->type == "Q1")


                            <td width="500px">{!!str_replace([str_replace('-', '', $n->eps['q1_eps_cont_op']), str_replace('-', '', $n->eps['q1_nocf_per_share']), str_replace('-', '', $n->eps['q1_net_asset_val_per_share'])], ["<span style='background:yellow'>".$n->eps['q1_eps_cont_op']."</span>", "<span style='background:yellow'>".$n->eps['q1_nocf_per_share']."</span>", "<span style='background:yellow'>".$n->eps['q1_net_asset_val_per_share']."</span>"], $n->details)!!}</td>
                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">q1_eps_cont_op</label>
                                        <input type="text" class="form-control" name="225"  value="{{$n->eps['q1_eps_cont_op']}}">
                                        <label class="oldData" style="color:@if($n->eps['q1_eps_cont_op']== @$fdata[$n->instrument_id][225]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][225]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q1_nocf_per_share</label>
                                        <input type="text" class="form-control" name="315" value="{{$n->eps['q1_nocf_per_share']}}">
                                        <label class="oldData" style="color:@if($n->eps['q1_nocf_per_share']== @$fdata[$n->instrument_id][315]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][315]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">q1_net_asset_val_per_share</label>
                                        <input type="text" class="form-control" name="310"  value="{{$n->eps['q1_net_asset_val_per_share']}}">
                                        <label class="oldData" style="color:@if($n->eps['q1_net_asset_val_per_share']== @$fdata[$n->instrument_id][310]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][310]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                          
                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>

                                            
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">
                                     
                                        @php 
                                        if(isset($fdata[$n->instrument_id][225]['meta_date'])){
                                        $m_date = @$fdata[$n->instrument_id][225]['meta_date']->format('Y-m-d') ; 
                                        }else{
                                            $m_date = null;
                                        }
                                        @endphp
                                        <label class="oldData" style="color:@if($n->eps['meta_date']== $m_date) green @else red  @endif" >{{$m_date}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success form-control" style="margin-top:25px">Update</button>
                                    </div>
                                    
                                    </div>
                                </form>

                            </td>
                            
                            @elseif($n->type == "mf")
                            {{-- mitual fund start --}}


                            <td width="500px">
                                {!!str_replace([$n->eps['mpb'], $n->eps['cpb']], ['<span style="background:yellow">'.$n->eps['mpb'].'</span>', '<span style="background:yellow">'.$n->eps['cpb'].'</span>', ], $n->details)!!}
                            </td>

                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">mpb</label>
                                        <input type="text" class="form-control" name="1486"  value="{{$n->eps['mpb']}}">
                                        <label class="oldData" style="color:@if($n->eps['mpb']== @$fdata[$n->instrument_id][1486]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][1486]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">cpb</label>
                                        <input type="text" class="form-control" name="1487" value="{{$n->eps['cpb']}}">
                                        <label class="oldData" style="color:@if($n->eps['cpb']== @$fdata[$n->instrument_id][1487]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][1487]['meta_value']}} <a class='history' > History</a></label>
                                    </div>


                          
                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>

                                            
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">
                                     
                                        @php 
                                        if(isset($fdata[$n->instrument_id][1487]['meta_date'])){
                                        $m_date = @$fdata[$n->instrument_id][1487]['meta_date']->format('Y-m-d') ; 
                                        }else{
                                            $m_date = null;
                                        }
                                        @endphp
                                        <label class="oldData" style="color:@if($n->eps['meta_date']== $m_date) green @else red  @endif" >{{$m_date}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <button class="btn btn-success form-control" style="margin-top:25px">Update</button>
                                    </div>
                                    
                                    </div>
                                </form>

                            </td>
                            

                            {{-- mitual fund end --}}
                            @elseif($n->type == "DIVIDEND")
{{--              return $data =  ['earning_per_share' => $eps, 'net_asset_val_per_share' => $nav,  'nocf_per_share' => $noc, 'meta_date' => $date, 'cashdiv' => $cash, 'stockdiv' => $stock]; --}}
                            <td width="500px">
                                {{-- {{dump($n->eps['stockdiv'])}} --}}
                                {!!str_replace([str_replace('-', '', $n->eps['earning_per_share']), str_replace('-', '', $n->eps['net_asset_val_per_share']), str_replace('-', '', $n->eps['nocf_per_share']),  $n->eps['cashdiv']."%",  $n->eps['stockdiv']."%", $n->eps['record_date'] ], ["<span style='background:yellow'>".$n->eps['earning_per_share']."</span>", "<span style='background:yellow'>".$n->eps['net_asset_val_per_share']."</span>", "<span style='background:yellow'>".$n->eps['nocf_per_share']."</span>", "<span style='background:yellow'>".$n->eps['cashdiv']."%</span>", "<span style='background:yellow'>".$n->eps['stockdiv']."%</span>",  "<span style='background:yellow'>".$n->eps['record_date']."</span>" ], $n->fulldetails)!!}</td>
                                
                            <td>
                                <form method="post" style="background:#{{$n->isUpdated?"00ff001f":"ff00001f"}}"><input type="hidden" name="news_id" value="{{$n->id}}" />
                                    {{csrf_field()}}
                                    <input type="hidden" name="instrument_id" value="{{$n->instrument_id}}">
                                    <div class="row">
                                        
                                    <div class="form-group col-md-6">
                                        <label for="">earning_per_share</label>
                                        <input type="text" class="form-control" name="201"  value="{{$n->eps['earning_per_share']}}">
                                        <label class="oldData" style="color:@if($n->eps['earning_per_share']== @$fdata[$n->instrument_id][201]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][201]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">net_asset_val_per_share</label>
                                        <input type="text" class="form-control" name="205" value="{{$n->eps['net_asset_val_per_share']}}">
                                        <label class="oldData" style="color:@if($n->eps['net_asset_val_per_share']== @$fdata[$n->instrument_id][205]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][250]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">nocf_per_share</label>
                                        <input type="text" class="form-control" name="318"  value="{{$n->eps['nocf_per_share']}}">
                                        <label class="oldData" style="color:@if($n->eps['nocf_per_share']== @$fdata[$n->instrument_id][318]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][318]['meta_value']}} <a class='history' > History</a></label>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="">meta_date</label>
                                        <input type="text" class="form-control" name="meta_date"  value="{{$n->eps['meta_date']}}">
                                        {{-- meta date compare --}}
                                          @php 
                                        
                                        if(isset($fdata[$n->instrument_id][201]['meta_date'])){
                                        $m_date = @$fdata[$n->instrument_id][201]['meta_date']->format('Y-m-d') ; 
                                        }else{
                                            $m_date = null;
                                        }
                                        @endphp
                                        <label class="oldData" style="color:@if($n->eps['meta_date']== $m_date) green @else red  @endif" >{{$m_date}} <a class='history' > History</a></label>
                                        {{-- meta date compare --}}
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">stock_dividend</label>
                                        <input type="text" class="form-control" name="211"  value="{{$n->eps['stockdiv']}}">
                                        <label class="oldData" style="color:@if($n->eps['stockdiv']== @$fdata[$n->instrument_id][211]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][211]['meta_value']}} <a class='history' > History</a></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="">cash_dividend</label>
                                        <input type="text" class="form-control" name="245"  value="{{$n->eps['cashdiv']}}">
                                        <label class="oldData" style="color:@if($n->eps['cashdiv']== @$fdata[$n->instrument_id][245]['meta_value']) green @else red  @endif" >{{@$fdata[$n->instrument_id][245]['meta_value']}} <a class='history' > History</a></label>
                                    </div>


                                    <div class="form-group col-md-6">
                                        @php $r = ""; @endphp
                                        @if($n->eps['record_date'])
                                        @php
                                        $r = explode('.', $n->eps['record_date']);
                                        if(strlen($r[2])<4){
                                            $r[2] = "20".$r[2];
                                        }
                                        $r = "$r[2]-$r[1]-$r[0]";
                                       // $r = \Carbon\Carbon::parse($n->eps['record_date'])->format('Y-m-d');
                                        @endphp
                                        @endif
                                        <label for="">record_date</label>
                                        <input type="text" class="form-control" name="record_date"  value="{{$r}}">

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
    @section('javascript')
    <script>
        $(document).ready(function () {
            $('.history').click(function () {
                var key = $(this).closest('label').siblings('label').html();
                var id =  $(this).parents('form').find('[name=instrument_id]').val();
                var date =  $(this).parents('form').find('[name=meta_date]').val();
                $('#historyModal').modal();
                $.get('/admin/news-parser?instrument_id='+id+'&meta_key='+key+'&meta_date='+date, function (html) {
                    $('#historyModal .modal-body').html(html)
                })
            })
        })
    </script>
    @endsection
@stop
