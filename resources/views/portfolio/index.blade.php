@extends('layouts.metronic.default')
@section('content')
<link href="/css/portfolio.css" rel="stylesheet">
{{--<div class="portlet light bordered ">
    <div class="portlet-title">
        <div class="caption font-green">
            <!--<i class="icon-pin font-green"></i>-->
            <span class="caption-subject bold uppercase">Your Portfolios</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row portfolioItems">
            @foreach($portfolios as $portfolio)
            <div class="col-md-4">
                <a href="/portfolio/{{$portfolio->id}}">
                    <button class="btn btn-primary btn-lg">{{$portfolio->portfolio_name}}</button>
                </a>
            </div>
            @endforeach
            <div class="col-md-4">
                <a href="/portfolio/create">
                    <button class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Create Portfolio</button>
                </a>
            </div>
        </div>
    </div>
</div>--}}

<div class="row portfolioItems">
@foreach($portfolios as $portfolio)

<div class="col-md-4">
@include('portfolio.portfolio_card', array('portfolio' => $portfolio))
</div>

 @endforeach
</div>
@endsection
@section('js')
<script>
    $(".portfolio-menu").addClass('open');
</script>
<script>
    $(".deleteTransaction").click(function () {

var id = $(this).attr('itemId');
        $('#bs_confirm_'+id).on('confirmed.bs.confirmation', function () {
                    $.ajax({
                        url: '/portfolio/' + id,
                        type: 'delete',
                        data: {_token: $("[name=_token]").val()},
                        success: function () {
                        toastr.success('Your portfolio has been deleted successfully', 'Portfolio Delete');
                          $('#portlet_'+id).remove();
                        }
                    })
        });



        return false;
    })


$(".email-switch").bootstrapSwitch({
  onSwitchChange: function(e, state) {
    var id = $(this).attr('itemId');


                        $.ajax({
                              url: '/portfolio-setting',  /* if we use url()  it does not work*/
                              type: 'POST',
                              async: false,
                              // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                              data: {
                                portfolio_id : id,
                                setting_name : 'email_alert',
                                setting_value : state,
                                _token:     '{{ csrf_token() }}'
                              },
                              success: function (msg) {
                                                      toastr.success(msg, 'Portfolio Settings');

                                                      }
                            })


  }
});




</script>
@endsection

@push('css')
<link href="{{ URL::asset('metronic/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
@endpush


