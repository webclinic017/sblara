<div id="AROON">
    <div class="alert alert-warningdf alert-dismissable" data-func="AROON">
        <div class="row">
        <div class="col-md-12">

                <form class="form-inline" role="form">

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="4" id="form_control_1">
                           <option value="UP">AROON UP</option>
                           <option value="DOWN">AROON DOWN</option>
                       </select>

                    </div>
                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="1" placeholder="Period" type="text" value="14" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>

                    <input type="hidden" data-param="2" value="HIGH">
                    <input type="hidden" data-param="3" value="LOW">

                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="5" id="form_control_1">
                           <option value="D">EOD (Adj)</option>
                           <option value="ND">EOD (Un adj)</option>
                           <option value="5M">5 Minutes</option>
                           <option value="15M">15 Minutes</option>
                           <option value="30M">30 Minutes</option>
                           <option value="1H">1 Hour</option>
                           <option value="W">Weekly (Adj)</option>
                           <option value="M">Monthly (Adj)</option>
                       </select>

                    </div>
                </form>
        </div>
    </div>
    </div>	
</div>
