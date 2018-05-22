@section('meta-title','Share Market Analysis Portal For Dhaka Stock Exchange (DSE)')
@section('meta-description', "First and oldest financial portal based on share markets of Bangladesh. Pioneer in technical analysis of Bangladesh. Our mission is simple - to make you a better investor so that you can invest conveniently at Dhaka stock exchange. Our Stock Bangladesh tool lets you create the web's best looking financial charts for technical analysis. Our Scan Engine shows you the Bangladesh share market's best investing opportunities")

@extends('layouts.metronic.default')

@section('page_heading')
{{-- DSE: {{$trade_date_Info->trade_date->format('l, M d, Y')}} --}}
@endsection

@section('content')
@php 
$table = new \App\Classes\Table;
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
    <select name="" id="">
        <option value="">Table Layout</option>
    </select>

    <select name="" id="">
        <option value="">Watchlists</option>
    </select>


    <button>Load</button>
    <button>Save</button>
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#columnModal">Columns</a>
</div>


<!-- Modal -->
<div id="columnModal" class="modal fade" role="dialog">
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
<form method="post">
               <div class="form-group">
                   <div class="input-group">
                    <div class="icheck-inline">
                        @foreach($table->allColumns() as $column)
                        <label>
                            <input type="checkbox" name="{{$column['field']}}" value="1" class="icheck"> {{$column['title']}} </label>
                        
                        @endforeach

                    </div>
                </div>
            </div> 
</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection

@push('scripts')
<script src="/vendor/bootstrap-table/bootstrap-table.js"></script>

<script src="/vendor/tableExport.jquery.plugin-master/libs/FileSaver/FileSaver.min.js"></script>
<script src="/vendor/tableExport.jquery.plugin-master/libs/js-xlsx/xlsx.core.min.js"></script>
<script src="/vendor/tableExport.jquery.plugin-master/tableExport.min.js"></script>

<script src="/vendor/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
<script src="/vendor/bootstrap-table/extensions/select2-filter/bootstrap-table-select2-filter.js"></script>
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
        filter: true,
        customSearch: function customSearch(text) {
            console.log(this.options.columns[0][0])

        },
        url: '/tabledata/json',
        showColumns: true,
        @php $table = new App\Classes\Table(); @endphp
         columns: {!! json_encode($table->setColumns()->getColumns()) !!},
        pagination: true,
        minimumCountColumns: 2,

        // detailView: true,
        // fixedColumns: true,
        onAll: function (name) {

        },
    onClickRow: function(e, a, b){
        if(a.next().hasClass('detail-view')){
            $('#table').bootstrapTable('collapseAllRows');
            return ;
        } 
            $('#table').bootstrapTable('collapseAllRows');
            $('#table').bootstrapTable('expandRow', a.data('index'));
    },
    detailFormatter: function (index, row, element) {
        return "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis ab pariatur aliquam, explicabo nostrum eos! Rerum a expedita nostrum in omnis totam tempore repudiandae nesciunt doloribus. Asperiores illo voluptatum nam."
    }
});






})



//custom head
var text = "<input type='text'/>";
var multiple = "<select><option>A</option><option>B</option></select>";
var compare = "<select ><option>=</option><option><</option><option>></option><option>>=</option><option><=</option></select><input type='text'/>";
$('table .fht-cell').html(multiple);











    // $(function() {

    //   var options = {
    //     url: "../json/data1.json",
    //     columns: [{
    //         field: "id",
    //         title: "ID",
    //         filter: {
    //           type: "input"
    //         }
    //       },
    //       {
    //         field: "name",
    //         title: "Item Name",
    //         filter: {
    //           type: "select",
    //           data: []
    //         }
    //       },
    //       {
    //         field: "price",
    //         title: "Item Price",
    //         filter: {
    //           type: "select",
    //           data: ["", "$1", "$2", "$3"]
    //         }
    //       },
    //       {
    //         field: "amount",
    //         title: "Amount",
    //         width: 200,
    //         filter: {
    //           template: getNumberFilterTemplate("amount"),
    //           setFilterValue: function($filter, field, value) {
    //             if (value) {
    //               $filter.find('input').val(value.value);
    //             }
    //           }
    //         }
    //       }
    //     ],
    //     filter: true,
    //     filterTemplate: {
    //       input: function(bootstrapTable, column, isVisible) {
    //         return '<input type="text" class="form-control input-sm" data-filter-field="' + column.field + '" style="width: 100%; visibility:' + isVisible + '">';
    //       }
    //     }
    //   };
    //   var $table = $("#table").bootstrapTable(options);
    //   $table.bootstrapTable("setSelect2Data", "name", ["", "item 1", "item 2", "item 3"]);
    // });









</script>
@endpush
@push('css')
<link rel="stylesheet" href="/vendor/bootstrap-table/bootstrap-table.css">
<link rel="stylesheet" href="https://rawgit.com/wenzhixin/bootstrap-table-fixed-columns/master/bootstrap-table-fixed-columns.css">
<link rel="stylesheet" href="/css/table.css">
@endpush


