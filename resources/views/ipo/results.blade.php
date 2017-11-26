@extends('layouts.metronic.default')
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
              IPO Results
           </div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="panel-group accordion" id="ipo-accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1" aria-expanded="false"> <span><h3>Company Name</h3></span> <br>
                                <span>Subscription Open: <b>September 5, 2017</b> </span>
                                <span>Subscription Close: <b>September 5, 2017</b> </span>
                             </a>
                        </h4>
                    </div>
                    <div id="collapse_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                            <div class="col-md-4">
                                <table>
                                    <tr>
                                        <td>Proposed Share :    </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Face Value:    </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Offered Value:   </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Market Lot :  </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>EPS :  </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-8">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum expedita a aut sequi beatae, minima ducimus magnam culpa! Placeat minima quos cupiditate illo minus debitis ullam animi nesciunt nostrum earum.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum expedita a aut sequi beatae, minima ducimus magnam culpa! Placeat minima quos cupiditate illo minus debitis ullam animi nesciunt nostrum earum.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum expedita a aut sequi beatae, minima ducimus magnam culpa! Placeat minima quos cupiditate illo minus debitis ullam animi nesciunt nostrum earum.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
