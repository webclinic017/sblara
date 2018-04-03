
var token = $('meta[name="csrf-token"]').attr('content');
var url = window.location;
var loadingDiv = '\n            <div style="text-align: center; width: 100%; margin-top: 10px;">\n                   <img src="/img/se_loading.gif" width="70" class="" alt="" />\n               </div>\n';
var loadingHtml = '\n\t<img src="/img/se_loading.gif" class=\'loading\' alt="" />\n';
function getValue(name) {
  return $('input[name="' + name + '"]').val();
}
function depthLoading() {
  return '\n<table style="font-family:Arial, Helvetica, sans-serif; font-size: 13px;" width="100%" border="0" cellspacing="0" cellpadding="0">\n  <tbody><tr>\n    <td><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">\n      <tbody><tr>\n        <td width="15%" valign="top">&nbsp;</td>\n        <td width="75%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">\n          <tbody><tr>\n            <td width="100%" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#E8FFFB">\n                <tbody><tr bgcolor="#339966">\n                  <td height="34%" colspan="2"><div align="center"><strong><font color="#FFFFFF">Buy</font></strong></div></td>\n                </tr>\n                <tr>\n                  <td width="50%" bgcolor="#D2F0E1"><div align="center">Buy Price </div></td>\n                  <td height="34%" bgcolor="#D2F0E1"><div align="center">Buy Volume </div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                                <tr>\n                  <td colspan="2" ><div class="animated-background" style="margin:2px; min-height:15px"></div></td>\n                  </tr>\n                              \n                            </tbody></table></td>\n\n          </tr>\n        </tbody></table></td>\n        <td width="15%" valign="top">&nbsp;</td>\n      </tr>\n      <tr>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n      </tr>\n      <tr>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n      </tr>\n      <tr>\n        <td valign="top">&nbsp;</td>\n        <td valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFF7EA">\n          <tbody><tr bgcolor="#339966">\n            <td colspan="4"><font color="#FFFFFF"><strong>Price Statistics </strong></font> </td>\n          </tr>\n\n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n          <tr>\n            <td colspan="4" >\n\t\t\t\t<div class="animated-background" style="margin:2px; min-height:15px"></div>\n            </td>\n          </tr>\n       \n        </tbody></table></td>\n        <td valign="top">&nbsp;</td>\n      </tr>\n      <tr>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n        <td valign="top">&nbsp;</td>\n      </tr>\n\n    </tbody></table></td>\n  </tr>\n</tbody></table>\t\t\n\t';
}
function startLoading(e) {
  e.after(loadingHtml);
}
function endLoading() {
  $('.loading').remove();
}

/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 57);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }


function startEditing() {
  $('#editing').removeClass('hidden');
  $('#showing').addClass('hidden');
}
function endEditing() {
  $('#editing').addClass('hidden');
  $('#showing').removeClass('hidden');
}


var Form = function () {
  function Form(data) {
    _classCallCheck(this, Form);

    this.method = "POST";
    this.data = data;
    return this;
  }

  _createClass(Form, [{
    key: 'submit',
    value: function submit(success, fail) {
      var data = new FormData(this.data);
      $.ajax({
        url: window.location.pathname,
        type: this.method,
        data: data,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: success,
        error: fail,
        cache: false,
        contentType: false,
        processData: false
      });
    }
  }, {
    key: 'reset',
    value: function reset() {
      this.data.reset();
      return this;
    }
  }]);

  return Form;
}();

function deleteRequest(url) {
  swal({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then(function (result) {
    if (result.value) {
      $.post(url, { _token: token, _method: 'delete' }, function () {
        swal('Deleted!', 'Your file has been deleted.', 'success');
      });
    }
  });
}
function editIpo(id) {
  $.get('/admin/ipos/' + id, function (data) {
    $.each(data, function (k, v) {
      $('input[name="' + k + '"]').val(v);
      startEditing();
    });
    // var html = `
    //               <div class="col-md-3">
    //                   <h6>File name</h6>
    //                   <img src="/img/chart_logo.gif" >
    //               </div>
    // `;
    $('.edit-attachments').html(html);
  });
}
function deleteIpo(id) {
  deleteRequest('/admin/ipos/' + id);
}
$(document).ready(function () {
  $('#addNew').click(function () {
    $('form.ajax')[0].reset();
    startEditing();
  });
  $('.cancel-edit').click(function () {
    $('#editing').addClass('hidden');
    $('#showing').removeClass('hidden');
  });

  $('body').on('submit', 'form.ajax', function (e) {
    e.preventDefault();
    var form = new Form(this);
    form.submit(function () {
      form.reset();
      $('#datatable').DataTable().ajax.reload();
    }, function (error) {
      formAlert(error);
    });

    return false;
  });

  $('.add-more-attachment').click(function () {
    var html = $('.addable-attachments .defautl-field').html();
    $('.additional-fields').append(html);
  });
  /*file uploader*/
  $('.file-uploader').filemanager($(this).data('type'));
  /*file uploader*/

  $('body').on('click', '.confirmBuy', function () {
    $('#buyModal form').submit();
  });
  $('body').on('click', '[data-target="#sellModal"]', function () {
    $('.company-info').html('');
    $('.basic-single-select2').val($(this).data('ins_id'));
    $('.basic-single-select2').each(function () {

      if ($(this).data('type') == 'sell') {
        $(this).trigger('change');
      }
    });
  });
  $('body').on('click', '.btn[data-target="#buyModal"]', function () {
    $('.company-info').html('');
    $('.basic-single-select2').val('');
    $('.basic-single-select2').each(function () {

      if ($(this).data('type') == 'buy') {
        $(this).trigger('change');
      }
    });
  });
  $('body').on('click', '.confirmSell', function () {
    $('#sellModal form').submit();
  });
  /* search  */
  $(document).mouseup(function (e) {
    var container = $(".se-search");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('.search-result').hide();
    } else {
      $('.search-result').show();
    }
  });
  $('#top-search').keyup(function (e) {
    if (e.keyCode == 27) {

      $('.search-result').css('visibility', 'hidden');
      $(this).val('');
      return;
    }
    //$('.company-search').html('<tr><td colspan="5" ><div class="animated-background"></div><div class="animated-background"></div><div class="animated-background"></div><div class="animated-background"></div></td></tr>');
    $('.company-search').html('');
    var str = $(this).val();
    if (str.length < 2) {
      $('.search-result').css('visibility', 'hidden');
      return;
    }
    $.get('/search/company/' + str, function (result) {

      var html = "";
      $.each(result, function (k, v) {
        v.data_banks_intraday = v;
        if (v.data_banks_intraday == null) {
          yclose = 0;
          ltp = 0;
          high = 0;
          low = 0;
          volume = 0;
          earning_per_share = 0;
          pe = 0;
          net_asset_val_per_share = 0;
          share_percentage_public = 0;
          share_percentage_institute = 0;
          eps_text = '';
        } else {

          ltp = v.data_banks_intraday.close_price;
          yclose = v.data_banks_intraday.yday_close_price;
          high = v.data_banks_intraday.high_price;
          low = v.data_banks_intraday.low_price;
          volume = v.data_banks_intraday.total_volume;
          earning_per_share = v.data_banks_intraday.earning_per_share;
          pe = (ltp / v.data_banks_intraday.annualized_eps).toFixed(2);
          net_asset_val_per_share = v.data_banks_intraday.net_asset_val_per_share;
          share_percentage_public = v.data_banks_intraday.share_percentage_public;
          share_percentage_institute = v.data_banks_intraday.share_percentage_institute;
          eps_text = v.data_banks_intraday.annualized_eps_text;
        }
        var change = ((ltp - yclose) / yclose * 100).toFixed(2);
        var cls = '';
        var list_class = '';
        var portlet_icon = '';
        if (isNaN(change)) {
          change = 0;
        }
        if (change == 0) {
          cls = 'text-warning';
          list_class = 'grey-salsa';
          portlet_icon = 'fa fa-arrows-v';
        } else if (change > 0) {
          cls = 'text-success';
          list_class = 'green-jungle';
          portlet_icon = 'fa fa-level-up';
        } else {
          cls = 'text-danger';
          list_class = 'red-flamingo';
          portlet_icon = 'fa fa-level-down';
        }

        if (high - yclose == 0) {
          hcls = 'text-warning';
        } else if (high - yclose > 0) {
          hcls = 'text-success';
        } else {
          hcls = 'text-danger';
        }
        if (low - yclose == 0) {
          lcls = 'text-warning';
        } else if (low - yclose > 0) {
          lcls = 'text-success';
        } else {
          lcls = 'text-danger';
        }

        html += '<div class="portlet box ' + list_class + ' ">\
                    <div class="portlet-title">\
                        <div class="caption hidden-xs"><i class="' + portlet_icon + '"></i> ' + v.instrument_code + ' - ' + v.category + ' - ' + v.sector + ' | ' + change + '% (' + v.last_traded + ')</div>\
                        <div class="caption hidden-lg hidden-md hidden-sm"><i class="' + portlet_icon + '"></i> ' + v.instrument_code + ' | ' + change + '%</div>\
                        <div class="tools">\
                            <a href="javascript:;" class="expand" data-original-title="" title=""> </a>\
                        </div>\
                    </div>\
                    <div class="portlet-body" style="display: none;">\
                        <div class="row">\
                            <div class="table-scrollable table-scrollable-borderless">\
                            <table class="table table-condensed table-hover table-light">\
                                <tbody>\
                                <thead>\
                                    <tr>\
                                        <th class="caption hidden-lg hidden-md hidden-sm">Sector</th>\
                                        <th class="caption hidden-lg hidden-md hidden-sm">Cat</th>\
                                        <th>LTP</th>\
                                        <th>High</th>\
                                        <th>Low</th>\
                                        <th>Volume</th>\
                                        <th>YCP</th>\
                                        <th>EPS(' + eps_text + ')</th>\
                                        <th>P/E(D/A)</th>\
                                        <th>NAV </th>\
                                        <th>Public%</th>\
                                        <th>Inst%</th>\
                                        <th class="caption hidden-lg hidden-md hidden-sm">Upd</th>\
                                    </tr>\
                                </thead>\
                                    <tr>\
                                        <td class="caption hidden-lg hidden-md hidden-sm">' + v.sector + '</td>\
                                        <td class="caption hidden-lg hidden-md hidden-sm">' + v.category + '</td>\
                                        <td>' + ltp + '</td>\
                                        <td>' + high + '</td>\
                                        <td>' + low + '</td>\
                                        <td>' + volume + '</td>\
                                        <td>' + yclose + '</td>\
                                        <td style = "text-align:center;vertical-align:middle">' + earning_per_share + '</td>\
                                        <td>' + pe + '</td>\
                                        <td>' + net_asset_val_per_share + '</td>\
                                        <td>' + share_percentage_public + '%</td>\
                                        <td>' + share_percentage_institute + '%</td>\
                                        <td class="caption hidden-lg hidden-md hidden-sm">' + v.last_traded + '</td>\
                                    </tr>\
                                </tbody>\
                            </table>\
                        </div>\
                        <div class="row">\
                        <div class="col-lg-2"><div class="btn-group btn-group btn-group-justified"><a target="_blank" href="/ta-chart?instrumentCode=' + v.instrument_code + '" class="btn btn-xs default"> TA </a></div> </div> \
                        <div class="col-lg-2"><div class="btn-group btn-group btn-group-justified"><a target="_blank" href="/advance-ta-chart?instrumentCode=' + v.instrument_code + '" class="btn btn-xs default"> Adv TA </a></div></div> \
                        <div class="col-lg-2"><div class="btn-group btn-group btn-group-justified"><a target="_blank" href="/company-details/' + v.instrument_id + '" class="btn btn-xs default "> Comp. Details </a></div></div> \
                        <div class="col-lg-2"><div class="btn-group btn-group btn-group-justified"><a target="_blank" href="/fundamental-details/' + v.instrument_id + '" class="btn btn-xs default "> FA Details </a></div></div> \
                        <div class="col-lg-2"><div class="btn-group btn-group btn-group-justified"><a target="_blank" href="/minute-chart/' + v.instrument_id + '" class="btn btn-xs default "> Min Chart </a></div></div> \
                        <div class="col-lg-2"><div class="btn-group btn-group btn-group-justified"><a target="_blank" href="/news/search?keyword=&instrument_id=' + v.instrument_id + '&from_date=&to_date=" class="btn btn-xs default "> News </a></div></div> \
                        </div>\
                        </div>\
                    </div>\
                 </div>';

        /*html += `
                    <tr>
                        <td >
                        <a class="popover-ta-chart" data-trigger="hover" data-toggle="popover" title="`+v.instrument_code+`- TA Chart" data-content="<img src='/tooltip_chart/`+v.id+`' />"   target="_blank"  href="/company-details/`+v.id+`">`+ v.instrument_code+`</a>
                         <a   target="_blank"  href="/news-chart/`+v.id+`" title="News Chart"><i class="fa fa-bullhorn"></i></a>
                         <a  target="_blank"  href="/advance-ta-chart?instrumentCode=`+v.instrument_code+`" title="Advanced Chart"><i class="fa fa-line-chart"></i></a>
                         <a  target="_blank"  href="/ta-chart?instrumentCode=`+v.instrument_code+`" title="TA Chart"><i class="fa fa-bar-chart"></i></a>
                         <a target="_blank" href="/minute-chart/`+v.id+`" title="Minute Chart"><i class="fa fa-area-chart"></i></a>
                         </td>
                        <td class="`+cls+`">`+ ltp+`</td>
                        <td class="`+hcls+`">`+ high +`</td>
                        <td class="`+lcls+`">`+ low +`</td>
                        <td class="`+cls+`">`+change+`</td>
                    </tr>
        `;*/
      });
      $('.company-search').html(html);

      /*enable popover for ajaxed content*/
      $('[data-toggle="popover"]').popover({
        html: true,
        placement: 'bottom',
        delay: { "show": 500, "hide": 100 }
      });
      /*enable popover for ajaxed content*/
    });
    $('.search-result').css('visibility', 'visible');
  });

  /* search  */

  /*pop over ta chart*/

  /*pop over ta chart*/

  /*menu fix*/
  $('.more-dropdown-sub.closed').removeClass('open');
  $('.active').parent('.active').addClass('open');
  /*menu fix*/
  $('.select2-multiple').select2({
    maximumSelectionLength: 5,
    placeholder: "Please Select"
  });

  $('.date-picker').datepicker();
  $('.select2').select2();

  //ta-chart tabs
  $('.ta-chart-tabs [data-toggle="tab"]').on('click', function (e) {
    var url = $(this).data('url');
    instrument = $('#shareList').val();
    if (instrument == '') {
      instrument = 12;
    }
    if (url == '#') {
      return;
    }
    $("div[id^='ta_chart_']").remove();

    url = url + instrument;
    var target = $(this).attr('href');
    $(target).html(loadingDiv);
    $.get(url, function (html) {
      $(target).html(html);
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  $.feedback({
    ajaxURL: '/feedback',
    html2canvasURL: '/vendor/feedback/html2canvas.js'
  });
}, false);

Highcharts.setOptions({
  credits: {
    enabled: false
  }
});

/*global ui*/
// cdir js
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
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

function loadChartSettings() {
  data = getCookie('sbtachartsettings');
  if (data == '') {
    data = "{}";
  }
  var data = JSON.parse(data);
  $.each(data, function (k, v) {
    $('#' + k).val(v);
    $('#' + k).trigger('change');
  });
}

function storeChartSettings() {
  var fields = {};
  //#adj, #configure, #charttype, #overlay, #Indicators, #mov1, #mov2, #touchspin_demo1, #touchspin_demo2, #dashboard-report-range

  fields['adj'] = $('#adj').val();
  fields['interval'] = $('#interval').val();
  fields['configure'] = $('#configure').val();
  fields['charttype'] = $('#charttype').val();
  fields['overlay'] = $('#overlay').val();
  fields['Indicator1'] = $('#Indicator1').val();
  fields['Indicator2'] = $('#Indicator2').val();
  fields['Indicator3'] = $('#Indicator3').val();
  fields['Indicator4'] = $('#Indicator4').val();
  fields['ChartSize'] = $('#ChartSize').val();
  fields['mov1'] = $('#mov1').val();
  fields['mov2'] = $('#mov2').val();
  fields['touchspin_demo1'] = $('#touchspin_demo1').val();
  fields['touchspin_demo2'] = $('#touchspin_demo2').val();
  fields['chartRange'] = $('#chartRange').val();
  fields = JSON.stringify(fields);
  //check if loged in
  // if(loggedIn)
  // {
  //     $.post('/user/meta/store', {_token:token, "ta-chart-settings":fields});
  //     return;
  // }
  var d = new Date();
  var exdays = 365;
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie = "sbtachartsettings" + "=" + fields + ";" + expires + ";path=/";
}

function loadChart() {
  $("div[id^='ta_chart_']").remove();
  $('.chartcontent').html(loadingDiv);
  if ($('.toggle-button').attr('data-state') != 'open') {
    return;
  }
  storeChartSettings();
  var content = $('.chartcontent');
  var loading = $('.chart-loading');

  var chartRange = $('#chartRange').val();
  //var chartRange='2012-10-25|2013-04-25';


  // var comparewith=$('#comparewith').val();
  var comparewith = 'null';
  if ($('#shareList').val() == "") {
    sharelist = "DSEX";
  } else {
    sharelist = $('#shareList').val();
  }

  var Volume = 0;
  var ParabolicSAR = 0;
  var LogScale = 0;
  var PercentageScale = 0;

  $.each($('#configure').val(), function (k, v) {
    if (v == "VOLBAR") {
      Volume = 1;
    }
    if (v == "PSAR") {
      ParabolicSAR = 1;
    }
    if (v == "LOG") {
      LogScale = 1;
    }
    if (v == "PSCALE") {
      PercentageScale = 1;
    }
  });

  url = "/ta-chart-img?Adjusted=" + $('#adj').val() + "&TickerSymbol=" + sharelist + "&CompareWith=&TimeRange=" + chartRange + "&ChartSize=" + $('#ChartSize').val() + "&Volume=" + Volume + "&ParabolicSAR=" + ParabolicSAR + "&LogScale=" + LogScale + "&PercentageScale=" + PercentageScale + "&ChartType=" + $('#charttype').val() + "&Band=" + $('#overlay').val() + "&avgType1=" + $('#mov1').val() + "&movAvg1=" + $('#touchspin_demo1').val() + "&avgType2=" + $('#mov2').val() + "&movAvg2=" + $('#touchspin_demo2').val() + "&Indicator1=" + $('#Indicator1').val() + "&Indicator2=" + $('#Indicator2').val() + "&Indicator3=" + $('#Indicator3').val() + "&Indicator4=" + $('#Indicator4').val() + "&interval=" + $('#interval').val() + "&deviceWidth=" + $(".tab-content").width();

  var companyDetailsUrl = 'http://www.new.stockbangladesh.com/TechnicalAnalysis/company_details/' + sharelist;
  var marketDepthUrl = 'http://www.new.stockbangladesh.com/TechnicalAnalysis/market_depth/' + sharelist;

  $('#portlet_tab2_company').attr("data-url", companyDetailsUrl);
  $('#portlet_tab1_market_depth').attr("data-url", marketDepthUrl);

  $.get(url, function (data) {
    //  App.unblockUI('#testdiv');
    content.html(data);
  });
}

$("#touchspin_demo1").TouchSpin({
  buttondown_class: 'btn blue',
  buttonup_class: 'btn blue',
  min: 1,
  max: 300,
  stepinterval: 1,
  maxboostedstep: 10000000

});

$("#touchspin_demo2").TouchSpin({
  buttondown_class: 'btn blue',
  buttonup_class: 'btn blue',
  min: 1,
  max: 300,
  stepinterval: 1,
  maxboostedstep: 10000000

});

function loadFundamental(e) {
  $("div[id^='ta_chart_']").remove();
  url = e.data('url');

  instrument = $('#shareList').val();

  url = url + instrument;
  var target = e.attr('href');
  $(target).html(loadingDiv);
  $.get(url, function (html) {
    $(target).html(html);
  });
}

$(document).ready(function () {

  loadChartSettings();
  $('#shareList').on('changed.bs.select', function (e) {
    if ($(this).val() == null) {
      return;
    }
    if ($('.toggle-button').data('state') != 'open') {
      $('.toggle-button').attr('data-state', 'open');
      $('.global-panel').show();
      window.dispatchEvent(new Event('resize'));
      $('.toggle-button').html("<i class='fa fa-close'></i> Close");
    }
    var e = $('.ta-chart-tabs li[class="active"] a');
    var url = e.data('url');

    if (url == '#') {

      loadChart();
    } else {
      loadFundamental(e);
    }
  });

  $('.ta-chart-tabs li[class="active"] a[data-url="#"]').click(function () {
    var target = $(this).attr('href');
    $('.chartcontent').html(loadingDiv);
    loadChart();
  });

  $('.toggle-button').click(function () {
    if ($('.toggle-button').attr('data-state') == 'open') {
      $("div[id^='ta_chart_']").remove();
      $('.global-panel').hide();
      $(this).html("<i class='fa fa-line-chart'></i> Chart");
      $(this).attr('data-state', 'close');

      $('#shareList').val('');
      $('#shareList').selectpicker('refresh');
    } else {
      $('#shareList').selectpicker('toggle');
    }
  });
  // tab rearrange
  window.onresize = function (e) {

    // set the modal up
    if ($(document).width() < 992) {

      // remove (modal fade) class from parent div
      // remove modal-cotent class
      // remove modal-dialog modal-full class
      // remove modal-body class
      // hide modal-header
      // hide modal-footer

      // reverse this 

      $('#modalFade').addClass('modal fade');
      $('#modalContent').addClass('modal-content');
      $('#modalDialogModalFull').addClass('modal-dialog modal-full');
      $('#modalBody').addClass('modal-body');
      $('.modal-header').show();
    }
  };
  // set the modal up
  $('.indicator4').selectpicker({
    dropupAuto: false,
    actionsBox: true,
    noneSelectedText: 'More Indicators'
  });
  //nex previous by key press;
  $('.global-ui .next').click(function () {
    $('#shareList').val($('#shareList option:selected').next().val());
    $('#shareList').trigger('change');
  });
  $('.global-ui .prev').click(function () {
    $('#shareList').val($('#shareList option:selected').prev().val());
    $('#shareList').trigger('change');
  });
  $('.loadChart').click(function ( ) {
      loadChart();
  });
  $('.global-ui').on('keyup', function (e) {
    if (e.target.type == 'text') {
      return;
    }
    if ($('.toggle-button').attr('data-state') != 'open') {
      return;
    }
    if (e.key == 'ArrowRight') {
      $('.global-ui .next').trigger('click');
    }
    if (e.key == 'ArrowLeft') {
      $('.global-ui .prev').trigger('click');
    }
  });
});
/*global ui*/

/***/ }),

/***/ 57:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });