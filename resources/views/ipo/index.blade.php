@extends('layouts.metronic.default')
@section('content')

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject bold uppercase"> Manage IPO</span>
            <h3 class="text-center text-success">{{ Session::get('message') }}</h3>
        </div>
    </div>
    <div class="portlet-body">
        {{-- form --}}
        <div id="editing" class="hidden">
            {!! Form::open(['url' => '/admin/ipos', 'method'=>'POST']) !!}
            <!--<form role="form" class="ajax">-->
            <div class="col-md-12" >
                <div class="form-actions pull-right" >
                    <button type="button" class="btn default cancel-edit">Cancel</button>
                    <button type="submit" class="btn green">Submit</button>
                </div>
            </div>
            <div class="row">
                <br><br><br>
            </div>
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-paperclip"></i>Attachments</div>
                        <div class="tools">
                            <a href="javascript:;" class="expand"> </a>
                        </div>
                    </div>
                    <div class="portlet-body portlet-collapsed">
                        <div class="row">
                            <div class="col-md-12">      
                                <button type="button" class="btn green pull-right">Add More <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4">      
                                    <div class="form-group">
                                        <label class="control-label">File Name</label>
                                        <div class="input-icon right">
                                            <input type="text" name="title" class="form-control"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">      
                                    <div class="form-group">
                                        <label class="control-label">Add Attachment</label>
                                        <div class="input-icon right">
                                            {!!imageUploader('attachment[]')!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-body">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Year</label>
                        <div class="input-group date date-picker" data-date="" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                            <input type="text" name="year" class="form-control" readonly>
                            <span class="input-group-btn">
                                <button class="btn default" type="button">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">IPO Name</label>
                        <div class="input-icon right">
                            <input type="text" name="ipo_name" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Short Name</label>
                        <div class="input-icon right">
                            <input type="text" name="short_name" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Subscription Open</label>
                        <div class="input-icon right">
                            <input type="text" name="subscription_open" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Subscription Close</label>
                        <div class="input-icon right">
                            <input type="text" name="subscription_close" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Nature of Business</label>
                        <div class="input-icon right">
                            <input type="text" name="nature_of_business" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Major Product</label>
                        <div class="input-icon right">
                            <input type="text" name="major_product" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Use of IPO Proceeds</label>
                        <div class="input-icon right">
                            <input type="text" name="use_of_ipo_proceeds" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Issue Manager</label>
                        <div class="input-icon right">
                            <input type="text" name="issue_manager" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Proposed Share</label>
                        <div class="input-icon right">
                            <input type="text" name="proposed_share" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Share Price</label>
                        <div class="input-icon right">
                            <input type="text" name="share_price" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Premium Per Share</label>
                        <div class="input-icon right">
                            <input type="text" name="premium_per_share" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Lot</label>
                        <div class="input-icon right">
                            <input type="text" name="lot" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">EPS</label>
                        <div class="input-icon right">
                            <input type="text" name="eps" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Revaluation Reserve</label>
                        <div class="input-icon right">
                            <input type="text" name="revaluation_reserve" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Without Revaluation Reserve</label>
                        <div class="input-icon right">
                            <input type="text" name="w_revaluation_reserve" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Logo</label>
                        {!!imageUploader('logo')!!}
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Bank List</label>
                        <div class="input-icon right">
                            {!!fileUploader('bank_list')!!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">NRB Form</label>
                        <div class="input-icon right">
                            <input type="text" name="nrb_form" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Bank Code</label>
                        <div class="input-icon right">
                            {!!fileUploader('bank_code')!!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Result General</label>
                        <div class="input-icon right">
                            <input type="text" name="result_general" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Result NRB</label>
                        <div class="input-icon right">
                            <input type="text" name="result_nrb" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Result Mutual Fund</label>
                        <div class="input-icon right">
                            <input type="text" name="result_mutual_fund" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Result Affected Users</label>
                        <div class="input-icon right">
                            <input type="text" name="result_affected_users" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Distribution Locations</label>
                        <div class="input-icon right">
                            <input type="text" name="distribution_locations" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Web Address</label>
                        <div class="input-icon right">
                            <input type="text" name="webaddress" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Address-1</label>
                        <div class="input-icon right">
                            <input type="text" name="address1" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Address-2</label>
                        <div class="input-icon right">
                            <input type="text" name="address2" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Address-3</label>
                        <div class="input-icon right">
                            <input type="text" name="address3" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Form Address To</label>
                        <div class="input-icon right">
                            <input type="text" name="form_address_to" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Amount in Words</label>
                        <div class="input-icon right">
                            <input type="text" name="amount_in_words" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Result Published</label>
                        <div class="input-icon right">
                            <input type="text" name="result_published" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-4">      
                    <div class="form-group">
                        <label class="control-label">Alert Marker</label>
                        <div class="input-icon right">
                            <input type="text" name="alert_marker" class="form-control"> 
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
            <!--</form>-->
            {!! Form::close() !!}
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
            url: window.location.pathname,
            data: function (d) {

            }
        },
        columns: [
            {data: 'short_name', name: 'short_name'},
            {data: 'ipo_name', name: 'ipo_name'},
            {data: 'subscription_open', name: 'subscription_open'},
            {data: 'subscription_close', name: 'subscription_close'},
            {data: 'issue_manager', name: 'issue_manager'},
        ],
        "columnDefs": [
            {
                "targets": 5,
                "data": null,
                "render": function (data, type, row) {
                    return `
                                <i onclick="editIpo(` + row.id + `)" class="fa fa-edit btn btn-success btn-xs"></i>
                                <i onclick="deleteIpo(` + row.id + `)" class="fa fa-trash  btn red-mint btn-xs"></i>
                                `;
                }
            },
        ],
    });
</script>
@endsection