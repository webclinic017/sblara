@foreach($data['transactions'] as $transaction)
<div class="row">

        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								News chart </span>
                        <span class="caption-helper">Watch every minute's price movement</span>
                    </div>
                    <div class="tools">

                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
@include('block.minute_chart', array('instrument_id' => $transaction->instrument_id))
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sector detail chart </span>
                        <span class="caption-helper">Eagle view of the sector</span>
                    </div>
                    <div class="tools">

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
@include('block.share_holdings_chart', array('instrument_id' => $transaction->instrument_id,'render_to' => 'share-holdings-'.$transaction->instrument_id))
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Sector detail chart </span>
                        <span class="caption-helper">Eagle view of the sector</span>
                    </div>
                    <div class="tools">

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
@include('block.share_holdings_chart', array('instrument_id' => $transaction->instrument_id,'render_to' => 'share-holdings-'.$transaction->instrument_id))
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>

@endforeach
