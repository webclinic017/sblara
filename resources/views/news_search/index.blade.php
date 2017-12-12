@extends('layouts.metronic.default')
@section('content')
{{--@include('block.newspaper_news');--}}

{!! Form::open(['url' => '/news/search', 'method'=>'GET', 'class' => '']) !!}
<div class="portlet light bordered" id="blockui_sample_1_portlet_body">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-search font-green-sharp"></i>
            <span class="caption-subject font-green-sharp sbold">News Search</span>
        </div>
    </div>
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-newspaper-o"></i>Can not Find News? Search News
            </div>
        </div>
        <div class="portlet-body flip-scroll">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Keyword</label>
                    <div class="input-icon right">
                        <i class="icon-magnifier"></i>
                        <input type="text" name="keyword" value="{{old('keyword')}}" class="form-control" placeholder="Keywords"> 
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="control-label">Select Company Name</label>
                    <select class="form-control" name="instrument_id" id="instrument_id">
                        <option value="">--Select--</option>
                        @foreach($instrument as $instruments)
                        <option value="{{$instruments->id}}">{{$instruments->instrument_code}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="clearx"></div>
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label">From(date)</label>
                    <div class="input-icon right">
                        <i class="icon-calendar"></i>
                        <input class="form-control date-picker" type="text" name="from_date" value="{{old('from_date')}}" data-date-format="yyyy-mm-dd" placeholder="From(date)" /> 
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="control-label">To(date)</label>
                    <div class="input-icon right">
                        <i class="icon-calendar"></i>
                        <input class="form-control date-picker" type="text" name="to_date" value="{{old('to_date')}}" data-date-format="yyyy-mm-dd" placeholder="To(date)" /> 
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="control-label"></label>
                    <button type="submit" class="btn green btn-block">Search</button>
                </div>
            </div>
        </div>
        @if(count($result)!=0)
        @foreach($result as $results)
        <div class="search-page search-content-1">
            <div class="row">
                <div class="col-md-12">
                    <div class="search-container bordered">
                        <ul>
                            <li>
                                <div class="search-content">
                                    <h2 class="search-title">
                                        <a href="javascript:;">{{$results->prefix}}</a>
                                        <label class="pull-right">{{date('d-m-Y', strtotime($results->post_date))}}</label>
                                    </h2>
                                    <p class="search-desc">{!!str_replace(old('keyword'),"<span style='background-color: yellow'>".old('keyword')."</span>",$results->details)!!}</p>
                                </div>
                            </li>
                            <hr>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
{!! Form::close() !!}

@endsection
@section('js')
<script>
    @if (old('instrument_id'))
            document.getElementById("instrument_id").value = "{{old('instrument_id')}}";
    @endif
</script>
@endsection