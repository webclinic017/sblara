<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
<ul class="feeds">
@foreach($hot_meter as $time=>$act)
    <li>
        <div class="col1">
            <div class="cont">
                <div class="cont-col1">
                    <div class="label label-sm {{$act['label_class']}}">
                        <i class="{{$act['icon_class']}}"></i>
                    </div>
                </div>
                <div class="cont-col2">
                    <div class="desc"> {{$act['message']}}
                       {{-- <span class="label label-sm {{$act['label_class']}} "> Analyze it
                            <i class="fa fa-share"></i>
                        </span>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col2">
            <div class="date"> {{$time}} </div>
        </div>
    </li>
    @endforeach

</ul>
</div>
<div class="scroller-footer">
<div class="btn-arrow-link pull-right">
    {{--<a href="javascript:;">See All Records</a>--}}
    Normal volume: {{$avg_vol_per_second_yesterday}} shares/minute
    <i class="icon-arrow-right"></i>
</div>
</div>
