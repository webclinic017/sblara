<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="{{$epsData['annualized_eps']}}">{{$epsData['annualized_eps']}}</span>
                        <small class="font-green-sharp"></small>
                    </h3>
                    <small>ANNUALIZED EPS</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                </div>
                <div class="status">
                    <div class="status-title">based on {{$epsData['text']}}</div>
                    <div class="status-number"><span>{{$epsData['meta_date']->format('d-m-Y')}}</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="{{$fundaData['net_asset_val_per_share']->first()->meta_value}}">{{$fundaData['net_asset_val_per_share']->first()->meta_value}}</span>
                        <small class="font-green-sharp"></small>
                    </h3>
                    <small>net asset val</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                </div>
                <div class="status">
                    <div class="status-title"> Last updated </div>
                    <div class="status-number"><span>{{$fundaData['net_asset_val_per_share']->first()->meta_date->format('d-m-Y')}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="{{$fundaData['paid_up_capital']->first()->meta_value}}">{{$fundaData['paid_up_capital']->first()->meta_value}}</span>
                        <small class="font-green-sharp"></small>
                    </h3>
                    <small>Paid up capital</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                </div>
                <div class="status">
                    <div class="status-title"> Last updated </div>
                    <div class="status-number"><span>{{$fundaData['paid_up_capital']->first()->meta_date->format('d-m-Y')}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span >{{$fundaData['last_agm_held']->first()->meta_value->format('d-m-Y')}}</span>
                        <small class="font-green-sharp"></small>
                    </h3>
                    <small>Last agm held</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                </div>
                <div class="status">
                    <div class="status-title"></div>
                    <div class="status-number"><span>{{$fundaData['last_agm_held']->first()->meta_value->diffForHumans()}}</span></div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')

@endpush