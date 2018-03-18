<div id="STOCHF">
    <div class="alert alert-warningdf alert-dismissable" data-func="STOCHF">
        <div class="row">
        <div class="col-md-12">

                <form class="form-inline" role="form">


                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="7"  id="form_control_1">
                           <option value="STOCHFD">STOCHF D</option>
                           <option value="STOCHFK">STOCHF K</option>
                       </select>

                    </div>
                  
                  <input type="hidden" data-param="1" value="HIGH">
                  <input type="hidden" data-param="2" value="LOW">
                  <input type="hidden" data-param="3" value="CLOSE">

                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="4" placeholder="FastK" type="number" value="3" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>

                    <div class="form-group form-md-line-input">
                        <input class="form-control " data-param="5" placeholder="FastD" type="number" value="3" style="width: 55px"> {{-- validation 2 to 100--}}
                        <div class="form-control-focus"> </div>
                    </div>


                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="6" id="form_control_1">
                          <option value="SMA">SMA</option>
                          <option value="EMA">EMA</option>
                          <option value="WMA">WMA</option>
                          <option value="DEMA">DEMA</option>
                          <option value="TEMA">TEMA</option>
                          <option value="TRIMA">TRIMA</option>
                          <option value="KAMA">KAMA</option>
                          <option value="MAMA">MAMA</option>
                          <option value="T3">T3</option>                           
                       </select>

                    </div>


                    <div class="form-group form-md-line-input">
                       <select class="form-control " data-param="8" id="form_control_1">
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