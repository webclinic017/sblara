@extends('layouts.metronic.default')
@section('content')
{-{--@include('block.newspaper_news')
@include('block.contest')

{!! Form::open(['url' => '/test/ak', 'method'=>'GET', 'class' => '']) !!}
<div class="row">
    <div class="col-md-6">
        <div class="input-icon right">
            <i class="icon-magnifier"></i>
            <input type="text" name="keyword" value="{{old('keyword')}}" class="form-control" placeholder="Keywords"> 
            <button type="submit" class="btn green">Search</button>
        </div>
        @if(count($result)!=0)
        <div class="portlet box yellow">
            <div class="portlet-body">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs ">
                        <li class="active">
                            <a href="#tab_15_1" data-toggle="tab"> Company </a>
                        </li>
                        <li>
                            <a href="#tab_15_2" data-toggle="tab"> News </a>
                        </li>
                        <li>
                            <a href="#tab_15_3" data-toggle="tab"> Newspaper News </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="padding:0">
                        <div class="tab-pane active" id="tab_15_1">
                            <div class="search-page search-content-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="search-container">
                                            <ul style="padding: 0px">
                                                <li class="search-item clearfix">
                                                    <div class="search-content">
                                                        <div class="row">
                                                            <div class="col-sm-4 col-xs-12">
                                                                <h2 class="search-title">
                                                                    <a href="javascript:;">ABBANK</a>
                                                                </h2>
                                                                <p class="search-desc">
                                                                    <a href="javascript:;">Minute Chart</a> |
                                                                    <a href="javascript:;">TA Chart </a> |
                                                                    <a href="javascript:;">TA Chart</a> |
                                                                    <a href="javascript:;">Advance TA Chart</a>
                                                                    <span class="font-grey-salt"></span>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">LTP</p>
                                                                    <p class="search-counter-label uppercase">362</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">HIGH</p>
                                                                    <p class="search-counter-label uppercase">79</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">LOW</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">YCP</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-8" style="margin-top: 10px;">
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">%Change    </p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">TRADE</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">VALUE</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">VOLUME</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </li>                                      
                                                <li class="search-item clearfix">
                                                    <div class="search-content">
                                                        <div class="row">
                                                            <div class="col-sm-4 col-xs-12">
                                                                <h2 class="search-title">
                                                                    <a href="javascript:;">ABBANK</a>
                                                                </h2>
                                                                <p class="search-desc">
                                                                    <a href="javascript:;">Minute Chart</a> | 
                                                                    <a href="javascript:;">TA Chart </a> |
                                                                    <a href="javascript:;">TA Chart</a> |
                                                                    <a href="javascript:;">Advance TA Chart</a>
                                                                    <span class="font-grey-salt"></span>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">LTP</p>
                                                                    <p class="search-counter-label uppercase">362</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">HIGH</p>
                                                                    <p class="search-counter-label uppercase">79</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">LOW</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">YCP</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4"></div>
                                                            <div class="col-md-8" style="margin-top: 10px;">
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">%Change    </p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">TRADE</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">VALUE</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                                <div class="col-sm-3 col-xs-4">
                                                                    <p class="text-center">VOLUME</p>
                                                                    <p class="search-counter-label uppercase">8</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </li>                                      
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_15_2">
                            <div class="search-page search-content-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="search-container">
                                            <ul class="search-container">
                                                @foreach($result as $results)
                                                <li class="search-item clearfix">
                                                    <div class="search-content text-left">
                                                        <div class="row">
                                                            <div class="pull-left">
                                                                <h2 class="search-title">
                                                                    <a href="javascript:;">{{$results->prefix}}</a>
                                                                </h2>
                                                            </div>
                                                            <div class="pull-right">
                                                                <h4>{{date('d-m-Y', strtotime($results->post_date))}}</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <p class="search-desc">{!!str_replace(old('keyword'),"<span style='background-color: yellow'>".old('keyword')."</span>",$results->details)!!}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="tab-pane" id="tab_15_3">
                            <div class="search-page search-content-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="search-container">
                                            <ul class="search-container">
                                                <li class="search-item clearfix">
                                                    <div class="search-content text-left">
                                                        <div class="row">
                                                            <div class="pull-left">
                                                                <h2 class="search-title">
                                                                    <a href="javascript:;">নভেম্বরেও বাড়ল রেমিট্যান্স</a>
                                                                </h2>
                                                            </div>
                                                            <div class="pull-right">
                                                                <h4>13-12-2017</h4>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <p class="search-desc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec efficitur pellentesque auctor. Morbi lobortis, leo in tristique scelerisque, mauris quam volutpat nunc </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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