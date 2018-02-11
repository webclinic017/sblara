@section('meta-title','Dividend Yield And Payout Ratio of All Listed Company in DSE')
@section('meta-description', 'We have calculated dividend yield using last cash dividend provided by a company. For the payout ratio we have used last audited EPS')

@extends('layouts.metronic.default')
@section('page_heading')
Dividend Yield And Payout Ratio of DSE
@endsection

@section('content')
{{--@include('block.company_list')--}}
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Dividend Yield & Payout Ratio </span>
                        <span class="caption-helper">List</span>
                    </div>
                    <div class="tools">
                            <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
@include('block.dividend_yield_and_payout_ratio')

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>


    </div>


@endsection



