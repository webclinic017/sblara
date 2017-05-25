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

</script>
@endsection



