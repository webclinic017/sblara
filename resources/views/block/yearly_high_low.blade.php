
<div class="row">
    <div class="col-sm-6 col-md-6">
        <a href="javascript:;" class="thumbnail">
            <img src="{{'/price-scale-chart/'.$yearly_high_low_data['yearly_high'].'/'.$yearly_high_low_data['yearly_low'].'/'.$today['c'].'/'.$instrument_code}}" alt="52 week high" style="height: 100%; width: 100%; display: block;"> </a>
    </div>

    <div class="col-sm-6 col-md-6">
        <a href="javascript:;" class="thumbnail">
            <img src="{{'/price-scale-chart/'.$yearly_high_low_data_adjusted['yearly_high'].'/'.$yearly_high_low_data_adjusted['yearly_low'].'/'.$today['c'].'/'.$instrument_code.'-ADJUSTED'}}" alt="52 week high" style="height: 100%; width: 100%; display: block;"> </a>
    </div>


</div>
<div class="row widget-row">
    <div class="col-md-6">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">52 Week High</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-green icon-bulb"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">{{$yearly_high_low_data['yearly_high_at']}}</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$yearly_high_low_data['yearly_high']}}">{{$yearly_high_low_data['yearly_high']}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>
    <div class="col-md-6">
        <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">52 Week Low</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-red icon-layers"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">{{$yearly_high_low_data['yearly_low_at']}}</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$yearly_high_low_data['yearly_low']}}">{{$yearly_high_low_data['yearly_low']}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
    </div>

</div>

<div class="row widget-row">
     <div class="col-md-6">
                                            <!-- BEGIN WIDGET THUMB -->
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <h4 class="widget-thumb-heading">52 Week High (Adjusted)</h4>
            <div class="widget-thumb-wrap">
                <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                <div class="widget-thumb-body">
                    <span class="widget-thumb-subtitle">{{$yearly_high_low_data_adjusted['yearly_high_at']}}</span>
                    <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$yearly_high_low_data_adjusted['yearly_high']}}">{{$yearly_high_low_data_adjusted['yearly_high']}}</span>
                </div>
            </div>
        </div>
        <!-- END WIDGET THUMB -->
        </div>
        <div class="col-md-6">
            <!-- BEGIN WIDGET THUMB -->
            <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
                <h4 class="widget-thumb-heading">52 Week Low (Adjusted)</h4>
                <div class="widget-thumb-wrap">
                    <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                    <div class="widget-thumb-body">
                        <span class="widget-thumb-subtitle">{{$yearly_high_low_data_adjusted['yearly_low_at']}}</span>
                        <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$yearly_high_low_data_adjusted['yearly_low']}}">{{$yearly_high_low_data_adjusted['yearly_low']}}</span>
                    </div>
                </div>
            </div>
            <!-- END WIDGET THUMB -->
        </div>

</div>
