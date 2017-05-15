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
    var b = Ext.create("Ext.data.Store", {model: "DataObject", autoLoad: true, proxy: {type: "ajax", url: "http://www.new.stockbangladesh.com/symbols/mutualFundMatrixData", reader: {type: "json", root: "mutualFundData"}}, sorters: {property: "sector", direction: "ASC"}, groupField: "sector", pageSize: 350});


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

/*
    var c = Ext.create("Ext.slider.Multi", {hideLabel: true, width: 300, minValue: -11, maxValue: 11, values: [-10, 10], listeners: {change: {buffer: 70, fn: h}}});
    var e = Ext.create("Ext.slider.Multi", {hideLabel: true, width: 300, minValue: -11, maxValue: 11, values: [-10, 10], listeners: {change: {buffer: 70, fn: h}}});

   function h(k) {
        var j = k.getValues();
        var l = [];
        b.suspendEvents();
        b.clearFilter();
        b.resumeEvents();
        b.filter([
            {fn: function (m) {
                return m.get("pchange") >= j[0] && m.get("pchange") <= j[1]
            }}
        ]);
        b.sort("name", "ASC")
    }

    h(c);*/

    var g = Ext.create("Ext.grid.feature.Grouping", {groupHeaderTpl: '{name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'});
    var d = Ext.create("Ext.grid.Panel", {height: 600, title: "mutual fund Matrix", renderTo: "gridpanel", id: "mutualmatrix", store: b, viewConfig: {stripeRows: false}, features: [g, {ftype: "filters", local: true}], columns: [
        {header: "id", readOnly: true, dataIndex: "id", width: 70, hidden: true},
        {text: "Mutual Funds", flex: 1, tdCls: "task", sortable: true, dataIndex: "code", hideable: false, summaryType: "count", width: 10, items: {xtype: "textfield", flex: 1, margin: 2, enableKeyEvents: true, listeners: {keyup: function () {
            var j = this.up("tablepanel").store;
            j.clearFilter();
            if (this.value) {
                j.filter({property: "code", value: this.value, anyMatch: true, caseSensitive: false})
            }
        }, buffer: 500}}},
        {header: "Listing Year",  renderer: i, dataIndex: "dse_listing_year",width: 50,readOnly: true,  filter: {}},
        {header: "Last Price",  renderer: i, dataIndex: "",width: 50,readOnly: true,  filter: {}},
        {header: "NAV(CP)", renderer: i, dataIndex: "cpb", width: 60, readOnly: true, filter: {}},
        {header: "LTP-Nav (CP)", renderer: i, dataIndex: "cpbdiff", width: 60, readOnly: true, filter: {}},
        {header: "LTP-Nav (CP)(%)", renderer: i, dataIndex: "cpbdiffper", width: 60, readOnly: true, filter: {}},
        {header: "NAV(MP)", renderer: i, dataIndex: "mpb", width: 60, readOnly: true, filter: {}},
        {header: "LTP-Nav (MP)", renderer: i, dataIndex: "mpbdiff", width: 60, readOnly: true, filter: {}},
        {header: "LTP-Nav (MP)(%)", renderer: i, dataIndex: "mpbdiffper", width: 60, readOnly: true, filter: {}},
        {header: "Reported On", renderer: i, dataIndex: "", width: 60, readOnly: true, filter: {}},
        {header: "Reserve", renderer: i, dataIndex: "", width: 60, readOnly: true, filter: {}},
        {header: "Total Fund", renderer: i, dataIndex: "", width: 60, readOnly: true, filter: {}},
        {header: "No Of Unit", renderer: i,  dataIndex: "", width: 70, readOnly: true, filter: {}}

    ], dockedItems: [Ext.create("Ext.toolbar.Paging", {dock: "bottom", store: b})]})
});