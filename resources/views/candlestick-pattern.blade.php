@section('meta-title','Candlestick Pattern Of Dhaka Stock Exchange')
@section('meta-description', 'Price action and candlesticks are a powerful trading concept and even research has confirmed that some candlestick patterns have a high predictive value and can produce positive returns')

@extends('layouts.metronic.default')
@section('page_heading')
Candlestick Pattern
@endsection

@section('content')
{{--@include('block.company_list')--}}
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Candlestick Pattern </span>
                        <span class="caption-helper">List of share those match pattern</span>
                    </div>
                    <div class="tools">
                            <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
<p>Price action and candlesticks are a powerful trading concept and even research has confirmed that some candlestick patterns have a high predictive value and can produce positive returns
Candlesticks patterns are based on candlestick charts and are recurring chart patterns that consist of only a few candlestick, usually in the region of one to four candlesticks. Because candlesticks give an indication of strength and weakness of the current price movement, the candlestick patterns tend provide clearer indications of the probability of a possible trend reversals than any of the other chart types
</p>
<p>We are providing some list of important pattern in multiple time frame. You can create thousands of pattern from our <a href="{{url('/screeners')}}">screener</a> - Its easy</p>

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>


    </div>
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Daily Time frame </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="tools">
                            <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-element-list">
                                <div class="mt-list-head list-simple ext-1 font-white bg-green-sharp">
                                    <div class="list-head-title-container">
                                        <div class="list-date">Daily Candle</div>
                                        <h3 class="list-title">Candle Pattern</h3>
                                    </div>
                                </div>
                                <div class="mt-list-container list-simple ext-1">
                                    <ul>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/doji')}}">Doji</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/dragonfly-doji')}}">Doji Star</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/dragonfly-doji')}}">Dragonfly Doji</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/gravestone-doji')}}">Gravestone Doji</a>
                                                </h3>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="mt-element-list">
                                <div class="mt-list-head list-simple ext-1 font-white bg-blue-sharp">
                                    <div class="list-head-title-container">
                                        <div class="list-date">Daily Candle</div>
                                        <h3 class="list-title">Candle Pattern</h3>
                                    </div>
                                </div>
                                <div class="mt-list-container list-simple ext-1">
                                    <ul>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/harami-pattern')}}">Harami Pattern</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/harami-cross-pattern')}}">Harami Cross Pattern</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/hikkake-pattern')}}">Hikkake Pattern</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/inverted-hammer')}}">Inverted Hammer</a>
                                                </h3>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="mt-element-list">
                                <div class="mt-list-head list-simple ext-1 font-white bg-green-sharp">
                                    <div class="list-head-title-container">
                                        <div class="list-date">Daily Candle</div>
                                        <h3 class="list-title">Candle Pattern</h3>
                                    </div>
                                </div>
                                <div class="mt-list-container list-simple ext-1">
                                    <ul>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/engulfing-pattern')}}">Engulfing Pattern</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/updown-side-white')}}">Up/Down side white</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/hammer')}}">Hammer</a>
                                                </h3>
                                            </div>
                                        </li>
                                        <li class="mt-list-item done">
                                            <div class="list-icon-container">
                                                <i class="icon-graph"></i>
                                            </div>
                                            <div class="list-datetime"> D </div>
                                            <div class="list-item-content">
                                                <h3 class="uppercase">
                                                    <a target="_blank" href="{{url('/screeners/hanging-man')}}">Hanging Man</a>
                                                </h3>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>


    </div>

    <div class="row">
                        <div class="col-md-12">
                        <div class="note note-success">
                            <h4 class="block">Create/Research strategy based on candlestick pattern</h4>
                            <p> You can check whether a share has created a doji both in weekly and daily (even in 1 hour candle). You may wish to see if this doji is supported by volume. Any strategy can possible to scan in our advance <a href="{{url('/screeners')}}">screener</a>.   </p>
                        </div>
                        </div>
                        </div>


@endsection



