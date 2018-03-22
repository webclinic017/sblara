@include('screener.forms.value')
@include('screener.forms.pricepercent')

@include('screener.forms.sma')
@include('screener.forms.ema')
@include('screener.forms.wma')
@include('screener.forms.dema')
@include('screener.forms.kama')
@include('screener.forms.midpoint')
@include('screener.forms.tema')
@include('screener.forms.trima')
@include('screener.forms.mama')
@include('screener.forms.t3')
@include('screener.forms.httrendline')
{{-- technical --}}
@include('screener.forms.rsi')
@include('screener.forms.macd')
@include('screener.forms.stochrsi')
@include('screener.forms.trix')
@include('screener.forms.ad')
@include('screener.forms.adx')
@include('screener.forms.atr')
@include('screener.forms.aroon')
@include('screener.forms.aroonosc')
@include('screener.forms.cci')
@include('screener.forms.stochf')
@include('screener.forms.mom')
@include('screener.forms.mfi')
@include('screener.forms.obv')
@include('screener.forms.roc')
@include('screener.forms.ultosc')
@include('screener.forms.willr')
@include('screener.forms.candlepattern')
@include('screener.forms.change')

{{-- non listed --}}
@include('screener.forms.valuepercent')
@include('screener.forms.candlepatternlist')
{{-- non listed --}}


{{-- filter row --}}

<div id="filter-row">
    <div class="row filter-row">

      <a class="remove-row"><i class="fa fa-close"></i></a>


<!-- Modal -->
<div class="time-modal modal fade " role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content modal-sm">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Before/Within (n) Candles ago</h4>
      </div>
      <div class="modal-body">

  <div class="form-group form-md-line-input"  >
                <label for="" class="label-control">Before/Within</label>
   <select class="form-control targetType" >
       <option value="BEFORE"> Before </option>
       <option value="WITHIN"> Within </option>
   </select>
  </div>  
          
            <div class="form-group form-md-line-input">
                <label for="" class="label-control">Candles</label>
              <input class="form-control targetN"  type="text" value="0"  > 
              <div class="form-control-focus"> </div> 
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Set</button>
      </div>
    </div>

  </div>
</div>
    	<a class="set-time"><i class="fa fa-clock-o"></i></a>
        <div class="col-md-5 filter-left">
          
        </div>
        <div class="col-md-2 filter-operent text-center">

                        <div  class="alert alert-warningdf alert-dismissable" data-func="SMA">
                            <div class="row">
                            <div class="col-md-12 ">

                                    <form class="form-inline" role="form">


                                          <div class="form-group form-md-line-input">
                                           <select class="form-control operator" id="form_control_1">
                                               <option value=">"> Above </option>
                                               <option value="="> Equal </option>
                                               <option value="<"> Below </option>
                                               <option value="IS"> is </option>
                                               <option value="!="> is not </option>
                                               <option value=">="> Above or equal </option>
                                               <option value="<="> Below or equal </option>
                                               <option value="X>"> Crossed From Below </option>  {{-- when crossed select it should take input of n days ago --}}
                                               <option value="X<"> Crossed From Above </option>  {{-- when crossed select it should take input of n days ago --}}
                                               {{-- <option value="<>"> Between </option> 2 input should be taken ( from -> to ) --}}

                                           </select>
                                          </div>


                                    </form>

                            </div>
                        </div>

                        </div>
                                           <small class="ncandle"  style="color:green; margin-top: -15px; display: none;  "> <span class="type-text">Before</span> <strong><span class="n-text">0</span></strong> candle <span class="n-s" style="display: none;">s</span> </small>
        </div>
        <div class="col-md-5 filter-right">

        </div>
    </div>	
</div>


{{-- nav --}}
<div id="filter-right-nav">
          <a href="javascript:" class="refresh change-criteria">
          <i class="fa fa-refresh"></i> </a>

          <a href="javascript:" class="back">
          <i class="fa fa-exchange"></i> </a>	
</div>
{{-- nav --}}

{{-- time setup --}}

{{-- default right html --}}
<div id="default-right-content">
                        <div class="alert alert-warningdf alert-dismissable" data-func="SMA">
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
{{-- default right html --}}
<script>
  $('body').on('mouseenter', '[data-param]', function () {
    var title = $(this).attr('placeholder')
    $(this).tooltip({
        title: title
    });
});
</script>