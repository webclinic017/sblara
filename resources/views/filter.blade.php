@extends('layouts.metronic.default')
<!-- BEGIN GLOBAL MANDATORY STYLES -->

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-social-dribbble font-purple-soft"></i>
          <span class="caption-subject font-purple-soft bold uppercase">Default Tabs</span>
        </div>
        <div class="actions">
          <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
            <i class="icon-cloud-upload"></i>
          </a>
          <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
            <i class="icon-wrench"></i>
          </a>
          <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
            <i class="icon-trash"></i>
          </a>
        </div>
      </div>

      <div class="portlet-body">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab_teh" data-toggle="tab" aria-expanded="true"> TECHNICAL SCANNERS </a>
          </li>
          <li class="">
            <a href="#tab_fund" data-toggle="tab" aria-expanded="false"> FUNDAMENTAL SCANNERS </a>
          </li>
          <!--<li class="">
            <a href="#tab_all" data-toggle="tab" aria-expanded="false"> ALL SCANNERS </a>
          </li>
        -->
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade active in" id="tab_teh">
            <div class="row">

              <form action="/filter" id='filter' method="post">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token()}}">

              @include('includes.metronic.technical')
              </form>
            </div>
          </div>

          <div class="tab-pane fade" id="tab_fund">
            <div class="row">
              @include('includes.metronic.fundamental')
            </div>
          </div>
          <div class="tab-pane fade" id="tab_all">
            <div class="row">
              @include('includes.metronic.technical')
              @include('includes.metronic.fundamental')
            </div>
          </div>
        </div>
        <div class="row row-period">
          <div class="col-md-3 col-md-offset-3">
            <div class="form-group">
                <div class="input-group select2-bootstrap-prepend">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" data-select2-open="multi-prepend"> PERIOD </button>
                    </span>
                    <select id="multi-prepend" class="bs-select form-control ">
                      <option value="1D">1 D</option>
                      <option value="1h">1 H</option>
                      <option value="4d">4 D</option>
                      <option value="w">W</option>
                    </select>
                </div>
            </div>




          </div>
          <div class="col-md-2">
            <a href="javascript:;" id="save_filter" class="btn btn-md blue">
              <span class="md-click-circle md-click-animate" style="height: 114px; width: 114px; top: -37px; left: 49px;"></span>
              <i class="fa fa-floppy-o"></i>
              Save scanner
            </a>
          </div>
          <div class="col-md-2">
            <span class="btn btn-md blue fileinput-button">
                <i class="fa fa-upload"></i>
                <span>Load scanner</span>
                <input type="file" id='load_filter' name="files[]" multiple="">
              </span>

          </div>

        </div>

        <!-- ROW input/button del with  -->
        <div class="row" id="alerts">

        </div>
        <div class="row" id="input-button">

        </div>
        <div class="row">
          @include('includes.metronic.table')
        </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')

  <script>
  $('.bs-select').selectpicker({
  dropupAuto: false,
  size: 10
  });


  </script>
@endpush