@extends('layouts.metronic.default')
@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject bold uppercase"> Manage IPO</span>
        </div>
    </div>
    <div class="portlet-body">
                {{-- form --}}
        <div id="editing" class="hidden">
        <form role="form" class="ajax">
            <div class="col-md-12" >
               <div class="form-actions pull-right" >
                    <button type="button" class="btn default cancel-edit">Cancel</button>
                    <button type="submit" class="btn green">Submit</button>
                </div>
            </div>
            <hr>
            <div class="form-body">
                <div class="col-md-4">
                    
                    <div class="form-group">
                        <label class="control-label">Year</label>
                        <div class="input-icon right">
                            <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                            <input type="text" class="form-control"> 
                        </div>
                    </div>

                </div>
                
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <div class="input-icon right">
                            <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                            <input type="text" class="form-control"> 
                        </div>
                    </div>
                </div>

                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Ticker</label>
                        <div class="input-icon right">
                            <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                            <input type="text" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                    <label class="control-label">Opening Date</label>
                        <div class="input-icon right">
                            <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                            <input type="text" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                    <label class="control-label">Closing Date</label>
                        <div class="input-icon right">
                            <i class="fa fa-info-circle tooltips" data-original-title="Email address" data-container="body"></i>
                            <input type="text" class="form-control"> 
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12" style="display: inline-block;">
               <div class="form-actions pull-right" >
                    <button type="button" class="btn default cancel-edit">Cancel</button>
                    <button type="submit" class="btn green">Submit</button>
                </div>
            </div>
        </form>
        </div>
        {{-- form --}}
        <div id="showing">
        <div class="table-toolbar">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group pull-right">
                        <button id="addNew" class="btn sbold green "> Add New
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="datatable">
                    <thead>
                        <th>Ticker</th>
                        <th width="25%">Company</th>
                        <th>Subscription Start</th>
                        <th>Subscription End</th>
                        <th>Issue Manager</th>
                        <th>Edit/Delete</th>
                    </thead>
            </table>
        </div>

    </div>
</div>

@endsection
@section('js')
<script>
    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
                ajax: {
                  url:window.location.pathname,
                  data: function (d) {

                  }
                },
        columns: [
            { data: 'short_name', name: 'short_name' },
            { data: 'ipo_name', name: 'ipo_name' },
            { data: 'subscription_open', name: 'subscription_open' },
            { data: 'subscription_close', name: 'subscription_close' },
            { data: 'issue_manager', name: 'issue_manager' },
        ],
             "columnDefs": [
                {
                    "targets": 5,
                    "data": null,
                    "render":function (data, type, row) {
                        return `
                                <i onclick="editIpo(`+row.id+`)" class="fa fa-edit btn btn-success btn-xs"></i>
                                <i onclick="deleteIpo(`+row.id+`)" class="fa fa-trash  btn red-mint btn-xs"></i>
                                `;
                    }
                },
                 ],
    });
</script>
@endsection