<div id="MIN">
    <div class="alert alert-warningdf alert-dismissable" data-func="MIN" >
        <div class="row">
        <div class="col-md-12">

         <label class="col-md-3 control-label" for="form_control_1">MIN </label>

                <form class="form-inline" role="form">

                    <div class="form-group form-md-line-input">
                        <input class="form-control setest" data-param="1" placeholder="Candle" type="text" min="2" value="2" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="2" id="form_control_1">
                           <option value="CLOSE">Close</option>
                           <option value="OPEN">Open</option>
                           <option value="HIGH">High</option>
                           <option value="LOW">Low</option>
                           <option value="VOLUME">Volume</option>
                       </select>

                    </div>

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="3" id="form_control_1">
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