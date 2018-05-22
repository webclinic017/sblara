@section('meta-title','Latest Price List of Dhaka Stock Exchange')
@section('meta-description', 'A goto page for DSE listed companies. You can see latest price in a simple table with updated every minute')

@extends('layouts.metronic.default')
@section('page_heading')
Latest Share Price of Dhaka Stock Exchange
@endsection

@section('content')
@php 
$table = new \App\Classes\Table;
if($tableLayout){
    $columns = json_decode($tableLayout->config)->columns;
    $cols = collect($columns)->keyBy('field');
}else{
    $columns = [];
}
@endphp
<div class="portlet light bordered" id="portlet_92372">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-th-large font-green-jungle"></i>
                                <span class="caption-subject bold font-green-jungle uppercase">
                                Share list </span>
                        <span class="caption-helper"></span>
                    </div>
                    <div class="actions">

                     </div>

                </div>
                <div class="portlet-body">

                    <div class="table-wrapper">
                    <table id="table" data-toolbar="#toolbar" data-search="true" class="table table-advance table-hover"></table>

                    </div>
                </div>
            </div>

<div id="toolbar">

    <a href="#" class="btn btn-primary" style="margin-left: 10px" data-toggle="modal" data-target="#columnModal">Add/Remove Columns</a>
</div>


<!-- Modal -->
<div id="columnModal" class="modal fade" role="dialog">
<form method="post" action="/latest-share-price/update-column">
    {{csrf_field()}}
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Columns</h4>
      </div>
      <div class="modal-body">
<style>
.icheck-inline>label {
padding: 10px;
float: left !important;
margin:0;
</style>
               <div class="form-group">
                   <div class="input-group">
                    <div class="icheck-inline">
                        @foreach($table->allColumns() as $column)
                        <label>
                            <input type="checkbox" @if(isset($cols[$column['field']]) || !$tableLayout && isset($column['required'])) checked @endif  name="{{$column['field']}}" value="{{$column['title']}}" class="icheck"> {{$column['title']}} </label>
                        
                        @endforeach

                    </div>
                </div>
            </div> 


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" >Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</form>
</div>

@endsection

@push('scripts')
<script src="/vendor/bootstrap-table/bootstrap-table.js"></script>

<script src="/vendor/tableExport.jquery.plugin-master/libs/FileSaver/FileSaver.min.js"></script>
<script src="/vendor/tableExport.jquery.plugin-master/libs/js-xlsx/xlsx.core.min.js"></script>
<script src="/vendor/tableExport.jquery.plugin-master/tableExport.min.js"></script>

<script src="/vendor/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
<script src="/vendor/bootstrap-table/extensions/select2-filter/bootstrap-table-select2-filter.js"></script>
<script src="/vendor/bootstrap-table/extensions/group-by-v2/bootstrap-table-group-by.js"></script>
<script src="https://rawgit.com/wenzhixin/bootstrap-table-fixed-columns/master/bootstrap-table-fixed-columns.js"></script>

<script>
$(document).ready(function () {
            var search = function(value) {
              bootstrapTable.searchText = undefined;
              clearTimeout(bootstrapTable.timeoutId);
              bootstrapTable.timeoutId = setTimeout(function() {
                console.log(fieldId, value);
                bootstrapTable.onColumnSearch(fieldId, value);
              }, bootstrapTable.options.searchTimeOut);
            }

          function getNumberFilterTemplate(fieldId) {
        var numberFilterClass = 'numberFilter-' + fieldId,
          template = function(bootstrapTable, col, isVisible) {
            var search = function(event, value) {
              bootstrapTable.searchText = undefined;
              clearTimeout(bootstrapTable.timeoutId);
              bootstrapTable.timeoutId = setTimeout(function() {
                console.log(fieldId, value);
                bootstrapTable.onColumnSearch(fieldId, value);
              }, bootstrapTable.options.searchTimeOut);
            };
            var $el = $('<div class="input-group input-group-sm ' + numberFilterClass + '" style="width: 100%; visibility:' + isVisible + '">' +
                '<span class="input-group-addon">&gt;</span>' +
                '<input type="number" class="form-control">' +
                '</div>'),
              $input = $el.find('input');
            $input.off('keyup').on('keyup', function(event) {
              search(event, $(this).val());
            });
            $input.off('mouseup').on('mouseup', function(event) {
              var $input = $(this),
                oldValue = $input.val();
              if (oldValue === "") {
                return;
              }
              setTimeout(function() {
                var newValue = $input.val();
                if (newValue === "") {
                  search(event, newValue);
                }
              }, 1);
            });
            return $el;
          };
        return template;
      }




    $('#table').bootstrapTable({
        detailView: true,
        idField: 'id',
        url: '/tabledata/{{$tableLayout?$tableLayout->id:"0"}}/json',
        @php $table = new App\Classes\Table(); @endphp
         columns: {!! json_encode($table->setLayout($tableLayout)->getColumns()) !!},
        pagination: true,
        toolbarAlign:'right',
        // detailView: true,
        // fixedColumns: true,
        onAll: function (name) {
        },
    onClickRow: function(e, a, b){
        // console.log($("#hoverCard").length);
        if($("#hoverCard").length > 0 ){
            return
        }
        if(a.next().hasClass('detail-view')){
            $('#table').bootstrapTable('collapseAllRows');
            return ;
        } 
            $('#table').bootstrapTable('collapseAllRows');
            $('#table').bootstrapTable('expandRow', a.data('index'));
    },
    onExpandRow: function (index, row, details) {
        var id = row.id;
        $.get("/latest-share-price/"+id+"/details", function (data) {
            $(".detail-view td").html(data);
            $(".detail-view td .wrapper").css("width", $('.fixed-table-toolbar').width());
            $(".detail-view td").css("background", "#f3f4f6");
            $(".detail-view td").css("padding", "0");
        })
    },

    detailFormatter: function (index, row, element) {
        return loadingDiv;
    }
});






})



//custom head
var text = "<input type='text'/>";
var multiple = "<select><option>A</option><option>B</option></select>";
var compare = "<select ><option>=</option><option><</option><option>></option><option>>=</option><option><=</option></select><input type='text'/>";


</script>
@endpush
@push('css')
<link rel="stylesheet" href="/vendor/bootstrap-table/bootstrap-table.css">
<link rel="stylesheet" href="https://rawgit.com/wenzhixin/bootstrap-table-fixed-columns/master/bootstrap-table-fixed-columns.css">
<link rel="stylesheet" href="/css/table.css">
@endpush


