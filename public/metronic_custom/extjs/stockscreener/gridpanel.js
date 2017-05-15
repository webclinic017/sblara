Ext.Loader.setConfig({enabled: true});
Ext.require(["Ext.grid.*", "Ext.data.*", "Ext.slider.Multi", "Ext.toolbar.Spacer", "Ext.ux.grid.FiltersFeature"]);
(Ext.cmd.derive("DataObject", Ext.data.Model, {idProperty: "id", fields: [
    {name: "id", type: "int"},
    {name: "code", type: "string"},
    {name: "sector", type: "string"},
    {name: "category", type: "string"},
    {name: "market_lot", type: "int"},
    {name: "face_value", type: "int"},
    {name: "nav", type: "float"},
    {name: "lastprice", type: "float"},
    {name: "open", type: "float"},
    {name: "high", type: "float"},
    {name: "low", type: "float"},
    {name: "pchange", type: "float"},
    {name: "change", type: "float"},
    {name: "pe", type: "float"},
    {name: "eps", type: "float"},
    {name: "volume", type: "int"},
    {name: "value", type: "float"},
    {name: "trade", type: "float"},
    {name: "ycp", type: "float"}
]}, 0, 0, 0, 0, 0, 0, [0, "DataObject"], 0));

Ext.onReady(function () {
    var b = Ext.create("Ext.data.Store", {model: "DataObject", autoLoad: true, proxy: {type: "ajax", url: "http://www.new.stockbangladesh.com/instruments/get_data", reader: {type: "json", root: "maingrid"}}, sorters: {property: "sector", direction: "ASC"}, groupField: "sector", pageSize: 350});

    function a(j) {
        if (j > 0) {
            return'<span style="color:green;">' + j + "%</span>"
        } else {
            if (j < 0) {
                return'<span style="color:red;">' + j + "%</span>"
            }
        }
        return j
    }

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

    h(c);
    var g = Ext.create("Ext.grid.feature.Grouping", {groupHeaderTpl: '{name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'});
    var d = Ext.create("Ext.grid.Panel", {height: 600, title: "Data Matrix", renderTo: "gridpanel", id: "datamatrix", tbar: ["Filter on change %:", " ", c], store: b, viewConfig: {stripeRows: false}, features: [g, {ftype: "filters", local: true}], columns: [
        {header: "id", readOnly: true, dataIndex: "id", width: 70, hidden: true},
        {text: "Scrips", flex: 1, tdCls: "task", sortable: true, dataIndex: "code", hideable: false, summaryType: "count", width: 100, items: {xtype: "textfield", flex: 1, margin: 2, enableKeyEvents: true, listeners: {keyup: function () {
            var j = this.up("tablepanel").store;
            j.clearFilter();
            if (this.value) {
                j.filter({property: "code", value: this.value, anyMatch: true, caseSensitive: false})
            }
        }, buffer: 500}}},
        {header: "Sector", dataIndex: "sector", width: 200, hidden: true, filter: {}},
        {header: "Category", readOnly: true, dataIndex: "category", width: 50, hidden: true, filter: {}},
        {header: "LastPrice", dataIndex: "lastprice", width: 70, readOnly: true, filter: {}},
        {header: "Open", dataIndex: "open", width: 70, readOnly: true, filter: {}},
        {header: "high", dataIndex: "high", width: 70, readOnly: true, filter: {}},
        {header: "low", dataIndex: "low", width: 70, readOnly: true, filter: {}},
        {header: "ycp", dataIndex: "ycp", width: 70, readOnly: true, hidden: false, filter: {}},
        {header: "Change", renderer: i, dataIndex: "change", width: 70, readOnly: true, filter: {}},
        {header: "Change%", renderer: a, dataIndex: "pchange", width: 80, readOnly: true, filter: {}},
        {header: "(D&A) P/E", dataIndex: "pe", width: 70, readOnly: true, filter: {}},
        {header: "(D&A) EPS", dataIndex: "eps", width:70, readOnly: true, filter: {}},
        {header: "volume", dataIndex: "volume", width: 80, readOnly: true, filter: {}},
        {header: "Value(mn)", dataIndex: "value", width: 80, readOnly: true, filter: {}},
        {header: "trade", dataIndex: "trade", width: 80, readOnly: true, filter: {}},
        {header: "Market lot", dataIndex: "market_lot", width: 70, readOnly: true, hidden: true, filter: {}},
        {header: "Face value", dataIndex: "face_value", width: 70, readOnly: true, hidden: true, filter: {}},
        {header: "NAV", dataIndex: "nav", width: 70, readOnly: true, filter: {}}
    ], dockedItems: [Ext.create("Ext.toolbar.Paging", {dock: "bottom", store: b})]})
});