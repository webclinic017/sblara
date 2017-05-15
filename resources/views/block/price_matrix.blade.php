<div id="price_gridpanel"></div>



@push('css')
<link href="{{ URL::asset('metronic_custom/extjs/resources/ext-theme-gray/ext-theme-gray-all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic_custom/extjs/src/ux/grid/css/GridFilters.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic_custom/extjs/src/ux/grid/css/RangeMenu.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ URL::asset('metronic_custom/extjs/stockscreener/all-classes.php') }}" type="text/javascript"></script>

<script type="text/javascript">


Ext.Loader.setConfig({enabled: true});
Ext.require(["Ext.grid.*", "Ext.data.*", "Ext.slider.Multi", "Ext.toolbar.Spacer", "Ext.ux.grid.FiltersFeature"]);
(Ext.cmd.derive("DataObject", Ext.data.Model, {idProperty: "id", fields: [
    {name: 'code', type: 'string'},
    {name: 'sector', type: 'string'},
    {name: 'lastprice', type: 'float'},
    {name: 'oneDay', type: 'float'},
    {name: 'twoDay', type: 'float'},
    {name: 'threeDay', type: 'float'},
    {name: 'oneWeek', type: 'float'},
    {name: 'twoWeek', type: 'float'},
    {name: 'threeWeek', type: 'float'},
    {name: 'oneMonth', type: 'float'}

]}, 0, 0, 0, 0, 0, 0, [0, "DataObject"], 0));

Ext.onReady(function () {
    var b = Ext.create("Ext.data.Store", {model: "DataObject", autoLoad: true, proxy: {type: "ajax", url: "{{ url('/ajax/price_matrix_data/') }}", reader: {type: "json", root: "pricedata"}}, sorters: {property: "sector", direction: "ASC"}, groupField: "sector", pageSize: 350});

    function i(j) {
        if (j > 0) {
            return'<span style="color:green;">' + j + "</span>"
        } else {
            if (j < 0) {
                return'<span style="color:red;">' + j + "</span>"
            }
        }
        return j
    }


    var g = Ext.create("Ext.grid.feature.Grouping", {groupHeaderTpl: '{name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'});
    var d = Ext.create("Ext.grid.Panel", {height: 600, title: "Price Change Matrix", renderTo: "price_gridpanel", id: "pricematrix", store: b, viewConfig: {stripeRows: false}, features: [g, {ftype: "filters", local: true}], columns: [
        {header: "id", readOnly: true, dataIndex: "id", width: 70, hidden: true},
        {text: "Scrips", flex: 1, tdCls: "task", sortable: true, dataIndex: "code", hideable: false, summaryType: "count", width: 50, items: {xtype: "textfield", flex: 1, margin: 2, enableKeyEvents: true, listeners: {keyup: function () {
            var j = this.up("tablepanel").store;
            j.clearFilter();
            if (this.value) {
                j.filter({property: "code", value: this.value, anyMatch: true, caseSensitive: false})
            }
        }, buffer: 500}}},

        {header: "Last Price",  renderer: i, dataIndex: "lastprice",width: 50,readOnly: true,  filter: {}},
        {header: "One day change(%)", renderer: i, dataIndex: "oneDay", width: 60, readOnly: true, filter: {}},
        {header: "Two day change(%)", renderer: i, dataIndex: "twoDay", width: 60, readOnly: true, filter: {}},
        {header: "Three day change(%)", renderer: i, dataIndex: "threeDay", width: 60, readOnly: true, filter: {}},
        {header: "One week change(%)", renderer: i, dataIndex: "oneWeek", width: 60, readOnly: true, filter: {}},
        {header: "Two week change(%)", renderer: i, dataIndex: "twoWeek", width: 60, readOnly: true, filter: {}},
        {header: "Three week change(%)", renderer: i, dataIndex: "threeWeek", width: 60, readOnly: true, filter: {}},
        {header: "One Month change(%)", renderer: i,  dataIndex: "oneMonth", width: 70, readOnly: true, filter: {}}

    ], dockedItems: [Ext.create("Ext.toolbar.Paging", {dock: "bottom", store: b})]})
});


</script>
@endpush