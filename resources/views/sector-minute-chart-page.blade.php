@section('meta-title','Sector Minute Chart : Check Which Sector Performing Today at DSE')
@section('meta-description', 'Sector minute chart is a very important tools for DSE. You should identify the sector first before taking your investment decision.')
@extends('layouts.metronic.default')
@section('page_heading')
Sector Movement: Each Minute of All Sector
@endsection

@section('content')


<div class="row">

        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Bank </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=1" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Cement </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=2" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Ceramics Sector </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=3" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>

    </div>

<div class="row">
   <div class="portlet light bordered">
       <div class="portlet-body">
          @include('ads.google_responsive')
       </div>
   </div>
</div>

<div class="row">

        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Engineering </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=6" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Financial Institutions </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=7" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Food & Allied </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=8" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>

    </div>

<div class="row">
   <div class="portlet light bordered">
       <div class="portlet-body">
          @include('ads.google_responsive')
       </div>
   </div>
</div>

<div class="row">

        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Fuel & Power </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=9" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Insurance </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=10" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								IT Sector</span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=11" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>

    </div>
<div class="row">

        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Miscellaneous </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=13" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Mutual Funds </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=14" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Paper & Printing</span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=15" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>

    </div>
<div class="row">

        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Pharmaceuticals & Chemicals </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=16" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Services & Real Estate </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=17" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Tannery Industries</span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=18" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>

    </div>
<div class="row">

        <div class="col-md-4">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Telecommunication </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=19" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Textile </span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=20" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

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
								Travel & Leisure</span>

                    </div>
                    <div class="tools">
<a href="#" data-load="true" data-url-custom="{{ url('/ajax/load_block/') }}/block_name=block.sector_minute_chart:sector_list_id=21" class="reload"></a>

                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>

                    </div>

                </div>
                <div class="portlet-body">

                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>

    </div>




@endsection
