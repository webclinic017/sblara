/*global Ext:false */
/*

 This file is part of Ext JS 4

 Copyright (c) 2011 Sencha Inc

 Contact:  http://www.sencha.com/contact

 GNU General Public License Usage
 This file may be used under the terms of the GNU General Public License version 3.0 as published by the Free Software Foundation and appearing in the file LICENSE included in the packaging of this file.  Please review the following information to ensure the GNU General Public License version 3.0 requirements will be met: http://www.gnu.org/copyleft/gpl.html.

 If you are unsure which license is appropriate for your use, please contact the sales department at http://www.sencha.com/contact.

 */
Ext.Loader.setConfig({ enabled: true });
//Ext.Loader.setPath('Ext.ux', 'ux');

Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.slider.Multi',
    'Ext.toolbar.Spacer',
    'Ext.ux.grid.FiltersFeature'
    //'Ext.ux.ajax.SimManager'
]);

/*
 Ext.define('Task', {
 extend: 'Ext.data.Model',
 idProperty: 'taskId',
 fields: [
 {name: 'projectId', type: 'int'},
 {name: 'project', type: 'string'},
 {name: 'taskId', type: 'int'},
 {name: 'description', type: 'string'},
 {name: 'estimate', type: 'float'},
 {name: 'rate', type: 'float'},
 {name: 'cost', type: 'float'},
 {name: 'due', type: 'date', dateFormat:'m/d/Y'}
 ]
 });
 */

Ext.define('DataObjectPrice', {
    extend: 'Ext.data.Model',
    fields: [
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
    ]
});

/*Ext.define('DataObject', {
 extend: 'Ext.data.Model',
 fields: ['id', 'code', 'sector', 'category', 'market_lot', 'face_value', 'nav', 'lastprice', 'open', 'high', 'low', 'pchange', 'change', 'pe', 'eps', 'volume'
 , 'value', 'trade', 'ycp']

 });*/
Ext.onReady(function () {
    //initAjaxSim();

    var pricestore = Ext.create('Ext.data.Store', {
        model: 'DataObjectPrice',
        autoLoad: true,
        /*
         remoteSort: true,
         remoteGroup: true,*/
        proxy: {
            type: 'ajax',
            url: '/grids/price_matrix_data',//(local ? url.local : url.remote),
            reader: {
                type: 'json',
                root: 'pricedata'

            }
        },
        sorters: {property: 'code', direction: 'ASC'},
        groupField: 'sector',
        pageSize: 400

    });

    function pctChange(val) {

        if (val > 0) {

            return '<span style="color:green;">' + val + '%</span>';

        } else if (val < 0) {

            return '<span style="color:red;">' + val + '%</span>';

        }

        return val;

    }

    function colorChange(val) {

        if (val > 0) {

            return '<span style="color:green;">' + val + '</span>';

        } else if (val < 0) {

            return '<span style="color:red;">' + val + '</span>';

        }

        return val;

    }

    /*var phoneSlider = Ext.create('Ext.slider.Multi', {
     hideLabel: true,
     width    : 300,
     minValue : -11,
     maxValue : 11,
     values   : [-10, 10],

     listeners: {
     change: {
     buffer: 70,
     fn    : filterData
     }
     }
     });

     var phoneSlider2 = Ext.create('Ext.slider.Multi', {
     hideLabel: true,
     width    : 300,
     minValue : -11,
     maxValue : 11,
     values   : [-10, 10],

     listeners: {
     change: {
     buffer: 70,
     fn    : filterData
     }
     }
     });


     function filterData(slider) {
     var values  = slider.getValues();

     var test = [];

     //TODO: the suspend/resume hack can be removed once Filtering has been updated
     store.suspendEvents();
     store.clearFilter();
     store.resumeEvents();
     store.filter([{
     fn: function(record) {
     return record.get('pchange') >= values[0] && record.get('pchange') <= values[1];
     }
     }]);

     store.sort('name', 'ASC');
     }
     filterData(phoneSlider);*/
    var groupingFeature = Ext.create('Ext.grid.feature.Grouping', {
        groupHeaderTpl: '{name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'
    });


    var pricegrid = Ext.create('Ext.grid.Panel', {
        requires: [
            'Ext.grid.RowNumberer'
        ],
        width: 975,
        height: 600,
        title: 'Price Change Matrix',
        renderTo: "gridpanel",
        id: 'pricematrix',
        /* tbar  : [
         'Filter on change %:',
         ' ',
         phoneSlider
         ],*/
        store: pricestore,
        viewConfig: {
            stripeRows: false
        },
        features: [groupingFeature, {
            ftype: 'filters',
            local: true
        }],
        columns: [
            {
                xtype: 'rownumberer'
            },
            {
                text: 'Scrips',
                flex: 1,
                tdCls: 'task',
                sortable: true,
                dataIndex: 'code',
                hideable: false,
                summaryType: 'count',

                // header: 'Scrips',

                // dataIndex: 'code',

                width: 120,
                items: {
                    xtype: 'textfield',
                    flex: 1,
                    margin: 2,
                    enableKeyEvents: true,
                    listeners: {
                        keyup: function () {
                            var store = this.up('tablepanel').store;
                            store.clearFilter();
                            if (this.value) {
                                store.filter({
                                    property: 'code',
                                    value: this.value,
                                    anyMatch: true,
                                    caseSensitive: false
                                });
                            }
                        },
                        buffer: 500
                    }
                }

            },
            {

                header: 'Sector',

                dataIndex: 'sector',

                width: 200,

                hidden: true,
                filter: {

                }

            },
            {

                header: 'Last Price',

                dataIndex: 'lastprice',

                width: 150,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'One Day Change(%)',
                renderer: pctChange,

                dataIndex: 'oneDay',

                width: 150,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'Two Days Change(%)',
                renderer: pctChange,

                dataIndex: 'twoDay',

                width: 150,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'Three Days Change(%)',
                renderer: pctChange,

                dataIndex: 'threeDay',

                width: 150,

                readOnly: true,
                filter: {

                }

            },
            {

                header: 'One Week Change(%)',
                renderer: pctChange,

                dataIndex: 'oneWeek',

                width: 150,

                readOnly: true,

                hidden: false,
                filter: {

                }

            },
            {

                header: 'Two Weeks Change(%)',

                renderer: pctChange,

                dataIndex: 'twoWeek',

                width: 150,

                readOnly: true,
                filter: {

                }

            },
            {

                header: 'Three Weeks Change(%)',

                renderer: pctChange,

                dataIndex: 'threeWeek',

                width: 150,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'One Month Change(%)',
                renderer: pctChange,

                dataIndex: 'oneMonth',

                width: 150,

                readOnly: true,
                filter: {

                }

            }

        ],
        dockedItems: [Ext.create('Ext.toolbar.Paging', {
            dock: 'bottom',
            store: pricestore
        })]
    });
});
