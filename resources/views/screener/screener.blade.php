@extends('layouts.metronic.default')
@php
$screenerImageUrl = "";
$title = "Build new screener";
$description = "Build your own screener with our powerful filters";
$slug = "new";

if($screener){
  $title = $screener->title;
  $description = $screener->description;
  $slug = $screener->slug;
}

@endphp
@section('title', $title)
@section('meta-title', "Advance screeners of DSE- 
".$title)
@section('meta-description', $description)

@section('og:image', $screenerImageUrl)
@section('og:url', url('/screener/'.$slug))

@section('og:title', $title)
@section('og:description', $description)

@section('content')
<div style="display: none;">
@include('screener.filters')
</div>
<style>
  .filter-row{
    /*background-color: #fafafa;*/
    padding: 5px 0 !important;
    margin-bottom: 5px;
    position: relative;
  }
  .filter-row .fa-close{
    position: absolute;
    right: 20px;
    z-index: 999;
    top: 40%;
  }
  .filter-row .set-time{
    position: absolute;
    right: 40px;
    z-index: 999;
    top: 39%;
  }
  .filter-row .alert{
    background-color: #fff;
    margin-bottom: 0;
  }
  .filter-right .back{
    position: absolute;
    right: 25px;
    top:3px;
  }
  .filter-right .refresh{
    position: absolute;
    right: 55px;
    top:3px;
  }
</style>


<!-- Modal -->
<div id="saveScreenerModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Save screener</h4>
      </div>
      <div class="modal-body">
        <form action="/screeners/new" method="POST">
          <input type="hidden" id="query" name="query">
          {{csrf_field()}}
            <div class="form-group form-md-line-input">
                <label for="" class="label-control">Screener Name</label>
                <input class="form-control"  type="text" value="" placeholder="Enter name here" name="title" required="">
                <div class="form-control-focus"> </div> 
            </div>

            <div class="form-group form-md-line-input">
                <label for="" class="label-control">Description</label>
                <textarea placeholder="Enter descripton here" class="form-control" name="description"></textarea>
                <div class="form-control-focus"> </div> 
            </div>

            <div class="button-group form-md-line-input">
              <input class="btn btn-success" value="Submit" type="submit">
            </div>

          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!---Modal -->
<div id="criteriaModal"  class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Filters</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <h5><strong>Value</strong></h5>
              <ul style="display: inline-block;">
                <li><a data-value = "VALUE">Value</a></li>
                <li><a data-value = "PRICEPERCENT">Percentage</a></li>
                <li><a data-value = "CANDLEPATTERN" data-rel="CANDLEPATTERNLIST" data-operator="IS">Candle Pattern</a></li>
              </ul>
          </div>

            <div class=" col-md-4 col-sm-6">
              <h5><strong>Moving Average</strong></h5>
              <ul >
                <li><a data-value = "SMA" data-rel="PRICEPERCENT">SMA</a></li>
                <li><a data-value = "EMA" data-rel="SMA" data-operator="X>">EMA</a></li>
                <li><a data-value = "WMA">WMA</a></li>
                <li><a data-value = "DEMA">DEMA</a></li>
                <li><a data-value = "KAMA">KAMA</a></li>
                <li><a data-value = "MAMA">MAMA</a></li>
                <li><a data-value = "T3">T3</a></li>
                <li><a data-value = "MIDPOINT">MIDPOINT</a></li>
                <li><a data-value = "TEMA">TEMA</a></li>
                <li><a data-value = "TRIMA">TRIMA</a></li>
                <li><a data-value = "HTTRENDLINE">Hilbert Transform</a></li>
              </ul>            
            </div>

            <div class=" col-md-4 col-sm-6">
              <h5><strong>Technical Indicators</strong></h5>
              <ul >
                <li><a data-value = "RSI" data-rel="VALUE" data-operator="<">RSI</a></li>
                <li><a data-value = "MACD" data-rel="MACD" data-operator="X>">MACD</a></li>
                <li><a data-value = "STOCHRSI">Stochastic RSI</a></li>
                <li><a data-value = "TRIX">TRIX</a></li>
                <li><a data-value = "AD">A/D</a></li>
                <li><a data-value = "AROON">Aroon</a></li>
                <li><a data-value = "AROONOSC">Aroon Oscillator</a></li>
                <li><a data-value = "ADX">ADX</a></li>
                <li><a data-value = "ATR">ATR</a></li>
                <li><a data-value = "CCI">CCI</a></li>
                <li><a data-value = "STOCHF">Stochastic Fast</a></li>
                <li><a data-value = "MOM">Momentum</a></li>
                <li><a data-value = "MFI">MFI</a></li>
                <li><a data-value = "OBV">On Balance Volume</a></li>
                <li><a data-value = "ROC">Rate Of Change</a></li>
                <li><a data-value = "ULTOSC">Ultimate Oscillator</a></li>
                <li><a data-value = "WILLR">Williams' %R</a></li>
              </ul>            
            </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--- / Modal -->

<div class="row">
  <div class="alert alert-info col-md-12 text-center">
    This is beta version of our screener and its developement is still ongoing. If you have any suggestion or see any bug please let us know at <strong>info@stockbangladesh.com</strong>

   Or leave <strong>comment</strong> below. 
  </div>

  <div class="col-md-12 text-right margin-bottom-10">

  <a href="/screeners/new" class="btn blue"><i class="fa fa-plus"></i> New Screener</a>
  <a href="/screeners" class="btn btn-success"><i class="fa fa-list"></i> All Screeners</a>
  </div>
</div>
<!-- BEGIN Portlet PORTLET-->
<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-search"></i> @if($screener) {{$screener->title}} @else New Screener  @endif</div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
           
        </div>
    </div>
    <div class="portlet-body" style="display: block; background-color: #f1f1f1">
<div class="filters">


</div>

<div class="row">
    <div class="col-md-12 text-center">
      <button class="btn blue add-filter"><i class="fa fa-plus"></i>  Add another filter</button>
    </div>
</div>

<div class="row margin-top-10 margin-bottom-10">
    <div class="col-md-12 text-center">
@if($screener && !Auth::guest() && $screener->user_id == Auth::user()->id)
<form action="/screeners/new" method="post" class="updateScreener">
  {{csrf_field()}}
  <input type="hidden" name="id" value="{{$screener->id}}">
  <input type="hidden" name="query" class="query">
</form>
      <button class="btn green update" onclick="updateQuery()"><i class="fa fa-save"></i>  Update</button> OR 
@endif
      <button class="btn green save" onclick="saveQuery()"><i class="fa fa-save"></i>  Save</button> OR 
      <button class="btn red" type="button" onclick="runQuery()"> Run <i class="fa fa-arrow-right"></i> </button> 
    </div>
</div>
  

    </div>
</div>
<!-- END Portlet PORTLET-->
                                                


<div class="row">
  <div class="col-md-12 result" style="background-color: #fff">
    
  </div>
</div>

  {{--  --}}
<script>
function store(key, value) {
  var cname = key, cvalue = value, exdays = 200;
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";  
}

function get(key) {    
  var cname = key;
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function updateQuery() {
  var q = generateQuery();  
  $('.query').val(q);
  $('.updateScreener').submit();
}

function saveQuery() {
  var q = generateQuery();
  store('screeners_query', q);
  $('#saveScreenerModal #query').val(q);
  if(loggedIn)
  {
    $("#saveScreenerModal").modal();
  }else{
     $('#saveScreenerModal form').submit();
  }
}

function runQuery() {
  var syntax = generateQuery();
  store('screeners_query', syntax);
     $.get('/screeners/result?q='+ encodeURI(btoa(syntax)), function (data) {
        $('.result').html(data);
      }).error(function () {
        $('.result').html("<div style='padding:10px; color:red'>Internal error. Please make sure that you have submitted correct combanations of filter.</div>");
      });  
}

function getConditions(re, s) {
    var m;
    var result = [];
    do {
        m = re.exec(s);
        if (m) {
          //recursion
          result.push(m[1]);
          //recursion
        }
    } while (m);
    return result;
}

function preg_match_all(re, s) {
    var m;
    var result = [];
    do {
        m = re.exec(s);
        if (m) {
          //recursion
          result.push(m);
          //recursion
        }
    } while (m);
    return result;
}

function generateHtml(query) { 
  // result = regex.exec(query);
  console.log(query);
  $('.filters').html("");
  $.each(getConditions(/\[(.*?)\]/g, query), function (k, v) {
    rowid = k;
    var matches = preg_match_all(/(.*[^IS|NOT|<|>|=|<=|>=|X>|X<])(IS|NOT|<|>|=|<=|>=|X>|X<)([^IS|NOT|<|>|=|<=|>=|X>|X<].*)/g, v);
    var v1 = matches[0][1];
    var op = matches[0][2];
    var v2 = matches[0][3];
    var v2matched = preg_match_all(/(.*) (WITHIN|BEFORE) ([0-9].+)/g, v2);
      var  targetType ;
      var  targetN ;          
    if(v2matched.length != 0)
    {
      v2 = v2matched[0][1];
        targetType = v2matched[0][2];
        targetN = v2matched[0][3];      
    }

    var row = $('#filter-row');
    //left side
    var lmatches = preg_match_all(/([A-Z0-9]+)\s*?\(([A-Z0-9,. ]+)\)/g, v1);
    if(lmatches.length == 0)
    {
      // not func
      $('.filter-left', row).html($('#'+v1.trim()).html()); 
    }else{
      $('.filter-left', row).html($('#'+lmatches[0][1]).html()); //generated html will replace here
    }

    var rmatches = preg_match_all(/([A-Z0-9]+)\s*?\(([A-Z0-9,. ]+)\)/g, v2);
    if(rmatches.length == 0)
    {
      // not function
      if(preg_match_all(/([A-Z]+)/g, v2).length != 0)
      {
        var rematches = preg_match_all(/([A-Z]+)/g, v2);
        var col = rematches[0][1];
      }
    if(preg_match_all(/\/100/g, v2).length !=0)
    {
      // col += "%";
      val = preg_match_all(/([1-9].)?\/100/g, v2)[0][1];
    $('.filter-right', row).html($('#default-right-content').html()); //generated html will replace here
    }else if(preg_match_all(/[A-Z]/g, v2).length == 0)
    {
      val = v2;
    $('.filter-right', row).html($('#filter-right-nav').html()+$('#VALUE').html()); //generated html will replace here

    }
    // aditional constant or value condition/statements here
    }else{
      //function
     $('.filter-right', row).html($('#filter-right-nav').html()+$('#'+rmatches[0][1]).html()); 
    }

    $('.filter-row', row).attr('data-row-id', rowid); 
    $('.filters').append(row.html());

    // set left params values
    var param;
    if(lmatches.length != 0)
    {

    $.each(lmatches[0][2].split(', '), function (k, v) {
      param  = k+1;
      $('.filters [data-row-id='+rowid+'] .filter-left [data-param='+ param +']').val(v);
    })
    
    } 
    // set right params values
    console.log(rmatches);
    if(rmatches.length != 0)
    {
      $.each(rmatches[0][2].split(', '), function (k, v) {
        param  = k+1;
        $('.filters [data-row-id='+rowid+'] .filter-right [data-param='+ param +']').val(v);
      })
    }else{
      // parse calculation or value
      if(preg_match_all(/([1-9].)?\/100/g, v2).length == 0)
      {
        $('.filters [data-row-id='+rowid+'] .filter-right .value').val(val);

      }else{

        
        $('.filters [data-row-id='+rowid+'] .filter-right .value').val(val);
        $('.filters [data-row-id='+rowid+'] .filter-right .compare').val(col);
      }
    }

    //set operator
        $('.filters [data-row-id='+rowid+'] .operator').val(op);

      //set time target
      if(v2matched.length != 0)
      {
        $('.filters [data-row-id='+rowid+'] .targetType').val(targetType);
        $('.filters [data-row-id='+rowid+'] .targetN').val(targetN);
        
      }
  });
}


///
    function generateQuery() {
              var params = [];
        var syntax = "";
      $('.filters .filter-row').each(function (k, element) {
        var v = element;
        syntax += "[ ";
        if($(this).find('.filter-left .alert-warningdf').data('func'))
        {
          syntax += $(this).find('.filter-left .alert-warningdf').data('func') + "(";

        $(this).find(".filter-left [data-param]").each(function (k, v) {
          if($(this).val() == "D")
          {
            return;
          }
          params[$(this).attr('data-param')] = $(this).val();

        });
        $.each(params, function (k, v) {
          if(k == 0){return;}
          if(k != 1)
          {
            syntax += ", ";
          }
          syntax += v;          
        })
        //load all params
        syntax +=  ")";

        }else{
          if($(this).find('.value').attr('data-rel') == "percent")
          {
            var keyword = $(this).find('.compare').val();
            var operator = $(this).find('.operator').val();
            switch(operator){
              case ">":
              operator = "+";
              break;
              case "<":
              operator = "-";
              break;
              case "X<":
              operator = "+";
              break;
              case "X>":
              operator = "-";
              break;

              default:
              operator = "+";
              break;
            }
           var val = $(this).find('.value').val();
            val = keyword + " "+operator+" ("+ keyword+  " * (" +val+ "/100" +"))" ;
             syntax += val;
          }else{
          syntax += $(this).find('.filter-left .alert-warningdf').data('value');
            
          }          
        }

        //load operator
        syntax +=  " ";
        syntax +=  $(this).find('.operator').val();
        syntax +=  " ";
        //load operator
        
        //load right side
        if($(this).find(".filter-right [data-param]").length == 0)
        {
          var val = $(this).find('.value').val();

          if($(this).find('.value').attr('data-rel') == "percent")
          {
            var keyword = $(this).find('.compare').val();
            var operator = $(this).find('.operator').val();
            switch(operator){
              case ">":
              operator = "+";
              break;
              case "<":
              operator = "-";
              break;
              case "X<":
              operator = "+";
              break;
              case "X>":
              operator = "-";
              break;

              default:
              operator = "+";
              break;
            }

            val = keyword + " "+operator+" ("+ keyword+  " * (" +val+ "/100" +"))" ;
          }
              syntax +=  val;
        }else{

               syntax += $(this).find('.filter-right .alert-warningdf').data('func') + "(";

        $(this).find(".filter-right [data-param]").each(function (k, v) {
          if($(this).val() == "D")
          {
            return;
          }
          params[$(this).attr('data-param')] = $(this).val();
        });
        $.each(params, function (k, v) {
          if(k == 0){return;}
          if(k != 1)
          {
            syntax += ", ";
          }
          syntax += v;          
        })

            syntax +=  ")";
        }
        //check if time target is given
        var targetType = $(this).find('.targetType').val();
        var targetN = $(this).find('.targetN').val();
        if(targetN != 0)
        {
          syntax += " "+targetType+" "+targetN;
        }
        syntax += " ] ";
      });
      return syntax;
    }

    // Add filter
  $('.add-filter').click(function () {
    $('#criteriaModal').attr('data-action', 'add-filter');  
    $('#criteriaModal').modal();  
  });

  $('.filters').on('click', '.filter-row .set-time', function () {
      $(this).prev().modal();
  });

    // change criteria
  $('.filters').on('click', '.change-criteria', function () {
    $('#criteriaModal').attr('data-action', 'change-criteria');  
    $('.change-criteria').removeClass('changing');
    $(this).addClass('changing');
    $('#criteriaModal').modal();  
  });

    // remove row
  $('.filters').on('click', '.remove-row', function () {
    $(this).closest('.filter-row').remove();
  });

    // back to default
  $('.filters').on('click', '.back', function () {
    $(this).closest('.filter-right').html($('#default-right-content').html());
  });

  $('#criteriaModal .modal-body a').click(function () {
    if($('#criteriaModal').attr('data-action') == "change-criteria")
    {
      // change right criteria 
      $('#criteriaModal').modal('hide'); 
      var html = $("#"+$(this).data('value')).html();
      $('.changing').closest('.filter-right').html($('#filter-right-nav').html() + html);
    }else{
      // add filter row
      $('#criteriaModal').modal('hide'); 
        //prepare html
        $('#filter-row .filter-left').html($("#"+$(this).data('value')).html());
        //generate right form based on pre relation
        if($(this).data('rel')){
          // generate relational fields
         $('#filter-row .filter-right').html($('#filter-right-nav').html() + $("#"+$(this).data('rel')).html());
         if($(this).data('operator'))
         {
            $('#filter-row .operator option[value="'+$(this).data('operator')+'"]').attr("selected", true);
         }
          // $('#filter-row .filter-right').html($("#default-right-content").html()); //
        }else{
          //load default fields
          $('#filter-row .filter-right').html($("#default-right-content").html());
          
        }
        var  row = $('#filter-row').html();
        $('.filters').append(row);
    }

  });
    // change criteria
    $(document).ready(function () {
      @if($screener)
      generateHtml("{!!$screener->query!!}");
      runQuery();
      @else
        @if(url('/login') == request()->server('HTTP_REFERER'))
          generateHtml(get('screeners_query'));
          saveQuery();
        @endif
      @endif

$('.filters').on('change', '.targetType, .targetN', function () {
     $(this).parents('.filter-row').find('.ncandle').css('display', 'block');
     if($(this).hasClass('targetN'))
     {
      $(this).parents('.filter-row').find('.ncandle .n-text').html($(this).val());;

     }else{
      $(this).parents('.filter-row').find('.ncandle .type-text').html($(this).val());;
     }
      if($(this).parents('.filter-row').find('.ncandle .n-text').html() == '0'){$(this).parents('.filter-row').find('.ncandle').css('display', 'none');}

});


    });


  </script>


@include('html.fb_comment', ['url' => url('/')])
@endsection
