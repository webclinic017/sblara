<div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="{{$viewData['dsexData']->capital_value}}">0</span>
                                            <small class="font-green-sharp"></small>
                                        </h3>
                                        <small id="update">DSEXSSS {{$viewData['dsexData']->deviation}}</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-bar-chart-o" id="ajax"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">{{$viewData['dsexData']->percentage_deviation}}% progress</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> change </div>
                                        <div class="status-number"> {{$viewData['dsexData']->percentage_deviation}}% </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="{{$viewData['tradeData']->TRD_TOTAL_VALUE}}">0</span>
                                        </h3>
                                        <small>Total Trade (MN)</small>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-money"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: {{$viewData['perOfPrevDayTrade']}}%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">{{$viewData['perOfPrevDayTrade']}}</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> % of Yesterday </div>
                                        <div class="status-number"> {{$viewData['perOfPrevDayTrade']}} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup" data-value="{{$viewData['upDownData']['up']->count()}}"></span>
                                        </h3>
                                        <small>Up</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-like"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only">45% grow</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> Prev day </div>
                                        <div class="status-number"> {{$viewData['upDownData']['up_prev']->count()}} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 bordered">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="{{$viewData['upDownData']['down']->count()}}"></span>
                                        </h3>
                                        <small>Down</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-dislike"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                                            <span class="sr-only">56% change</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> Prev day </div>
                                        <div class="status-number"> {{$viewData['upDownData']['down']->count()}} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


@push('scripts')

<script>
                 // alert("here from composer of market_index");

                  $('#ajax').click(function(){

                          $.ajax({

                              type: "GET",
                              url: '/ajax',
                              success: function (data) {
                               // alert (data)
                                 $("#update").html(data);
                              },
                              error: function (data) {
                                  console.log('Error:', data);
                              }
                          });
                      });
        </script>
@endpush