<div id="MACD">
    <div class="alert alert-warningdf alert-dismissable" data-func="MACD">
        <div class="row">
        <div class="col-md-12">

                <form class="form-inline" role="form">

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="5" id="form_control_1">
                           <option value="MACD">MACD</option>
                           <option value="SIGNAL">Signal Line</option>
                           <option value="DIVERGENCE">Divergence</option>
                       </select>

                    </div>

                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="1" placeholder="Slow" type="number" value="26" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="2" placeholder="Fast" type="number" value="12" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="3" placeholder="Signal" type="number" value="9" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="4" id="form_control_1">
                           <option value="CLOSE">Close</option>
                           <option value="OPEN">Open</option>
                           <option value="HIGH">High</option>
                           <option value="LOW">Low</option>
                           <option value="VOLUME">Volume</option>
                       </select>

                    </div>

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="6" id="form_control_1">
                           <option value="D">EOD (Adj)</option>
                           <option value="ND">EOD (Un adj)</option>
                           <option value="W">Weekly (Adj)</option>
                           <option value="M">Monthly (Adj)</option>
                           <option value="5M">5 Minutes</option>
                           <option value="15M">15 Minutes</option>
                           <option value="30M">30 Minutes</option>
                           <option value="1H">1 Hour</option>
                       </select>

                    </div>
                </form>
        </div>
    </div>
    </div>	
</div>