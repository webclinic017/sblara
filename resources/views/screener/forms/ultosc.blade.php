<div id="ULTOSC">
    <div class="alert alert-warningdf alert-dismissable" data-func="ULTOSC">
        <div class="row">
        <div class="col-md-12">

         <label class="col-md-2 control-label" for="form_control_1">ULTOSC </label>
                <form class="form-inline" role="form">
                
                <input type="hidden" data-param="1" value="HIGH">
                <input type="hidden" data-param="2" value="LOW">
                <input type="hidden" data-param="3" value="CLOSE">

                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="4" placeholder="Period 1" type="text" value="7" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="5" placeholder="Period 2" type="text" value="14" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="6" placeholder="Period 3" type="text" value="28" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>


                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="7" id="form_control_1">
                           <option value="D">EOD (Adj)</option>
                           <option value="ND">EOD (Un adj)</option>
                           <option value="1M">1 Minute</option>
                           <option value="5M">5 Minutes</option>
                           <option value="15M">15 Minutes</option>
                           <option value="30M">30 Minutes</option>
                           <option value="1H">1 Hours</option>
                       </select>

                    </div>
                </form>
        </div>
    </div>
    </div>	
</div>
