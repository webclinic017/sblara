<div id="PRICEPERCENT">
                         <div class="alert alert-warningdf alert-dismissable" >
                            <form action="" class="form-inline">
                                            <div style="/*background: rgba(0,0,75, .1);*/ display: inline-block;">
                                              
                                          <div class="form-group form-md-line-input">
                                           <select class="form-control compare" id="form_control_1">
                                               <option value="CLOSE">Close</option> {{-- valid when select close price,open price,high price and low price from previous menu--}}
                                               <option value="OPEN">Open</option> {{-- valid when select close price,open price,high price and low price from previous menu--}}
                                               <option value="HIGH">High</option> {{-- valid when select close price,open price,high price and low price from previous menu--}}
                                               <option value="LOW">Low</option> {{-- valid when select close price,open price,high price and low price from previous menu--}}
                                               <option value="VOLUME">Volume</option> {{--Valid when select volume from previous menu--}}
                                           </select>
                                          </div>
                              
                                        <div class="form-group form-md-line-input">
                                            <input class="form-control value" data-rel="percent" type="text" value="10" style="width: 40px" >% {{-- validation 2 to 100--}}
                                            <div class="form-control-focus"> </div> 
                                        </div>
                                            </div>

                                        <span style="margin-right:10px">OR</span>
                              
                                        <div class="form-group form-md-line-input">
                                          <button class="btn blue btn-sm change-criteria" type="button"><i class="fa fa-line-chart"></i> Change Criteria</button>
                                        </div>
                            </form>
                        </div>  
</div>
