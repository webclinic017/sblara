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

Ext.define('DataObject', {
    extend: 'Ext.data.Model',
    idProperty: 'id',
    fields: [
        {name: 'id', type: 'int'},
        {name: 'code', type: 'string'},
        {name: 'sector', type: 'string'},
        {name: 'category', type: 'string'},
        {name: 'market_lot', type: 'int'},
        {name: 'face_value', type: 'int'},
        {name: 'nav', type: 'float'},
        {name: 'lastprice', type: 'float'},
        {name: 'open', type: 'float'},
        {name: 'high', type: 'float'},
        {name: 'low', type: 'float'},
        {name: 'pchange', type: 'float'},
        {name: 'change', type: 'float'},
        {name: 'pe', type: 'float'},
        {name: 'eps', type: 'float'},
        {name: 'volume', type: 'int'},
        {name: 'value', type: 'float'},
        {name: 'trade', type: 'float'},
        {name: 'ycp', type: 'float'}
    ]
});

/*Ext.define('DataObject', {
 extend: 'Ext.data.Model',
 fields: ['id', 'code', 'sector', 'category', 'market_lot', 'face_value', 'nav', 'lastprice', 'open', 'high', 'low', 'pchange', 'change', 'pe', 'eps', 'volume'
 , 'value', 'trade', 'ycp']

 });*/
Ext.onReady(function(){
    //initAjaxSim();

    var store = Ext.create('Ext.data.Store', {
        model: 'DataObject',
        autoLoad: true,
        /*
         remoteSort: true,
         remoteGroup: true,*/
        proxy: {
            type: 'ajax',
            url: '/grids/watch',//(local ? url.local : url.remote),
            reader: {
                type: 'json',
                root: 'maingrid'

            }
        },
        sorters: {property: 'sector', direction: 'ASC'},
        groupField: 'sector',
        pageSize: 350

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
    var phoneSlider = Ext.create('Ext.slider.Multi', {
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
    filterData(phoneSlider);
    var groupingFeature = Ext.create('Ext.grid.feature.Grouping', {
        groupHeaderTpl: '{name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'
    });


    var grid = Ext.create('Ext.grid.Panel', {
        width: 975,
        height: 600,
        title: 'Data Matrix',
        renderTo: "gridpanel",
        id:'datamatrix',
        tbar  : [
            'Filter on change %:',
            ' ',
            phoneSlider
        ],
        store: store,
        viewConfig: {
            stripeRows: false
        },
        features: [groupingFeature,{
            ftype: 'filters',
            local: true
        }],
        columns: [
            {

                header: 'id',

                readOnly: true,

                dataIndex: 'id',

                width: 70,

                hidden: true

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

                width: 100,
                items    : {
                    xtype: 'textfield',
                    flex : 1,
                    margin: 2,
                    enableKeyEvents: true,
                    listeners: {
                        keyup: function() {
                            var store = this.up('tablepanel').store;
                            store.clearFilter();
                            if (this.value) {
                                store.filter({
                                    property     : 'code',
                                    value         : this.value,
                                    anyMatch      : true,
                                    caseSensitive : false
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

                header: 'Category',

                readOnly: true,

                dataIndex: 'category',

                width: 50,

                hidden: true,
                filter: {

                }

            },

            {

                header: 'LastPrice',

                dataIndex: 'lastprice',

                width: 60,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'Open',

                dataIndex: 'open',

                width: 60,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'high',

                dataIndex: 'high',

                width: 60,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'low',

                dataIndex: 'low',

                width: 60,

                readOnly: true,
                filter: {

                }

            },
            {

                header: 'ycp',

                dataIndex: 'ycp',

                width: 60,

                readOnly: true,

                hidden: false,
                filter: {

                }

            },
            {

                header: 'Change',

                renderer: colorChange,

                dataIndex: 'change',

                width: 60,

                readOnly: true,
                filter: {

                }

            },
            {

                header: 'Change%',

                renderer: pctChange,

                dataIndex: 'pchange',

                width: 70,

                readOnly: true,
                filter: {

                }

            },

            {

                header: '(D&A) P/E',

                dataIndex: 'pe',

                width: 60,

                readOnly: true,
                filter: {

                }

            },

            {

                header: '(D&A) EPS',

                dataIndex: 'eps',

                width: 60,

                readOnly: true,
                filter: {

                }

            },

            //{

//        header: 'Annualized P/E',

//        dataIndex: 'pe',

//        width: 150,

//        readOnly: true

//      },

            {

                header: 'volume',

                dataIndex: 'volume',

                width: 70,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'Value(mn)',

                dataIndex: 'value',

                width: 70,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'trade',

                dataIndex: 'trade',

                width: 70,

                readOnly: true,
                filter: {

                }

            },
            {

                header: 'Market lot',

                dataIndex: 'market_lot',

                width: 60,

                readOnly: true,

                hidden: true,
                filter: {

                }

            },
            {

                header: 'Face value',

                dataIndex: 'face_value',

                width: 60,

                readOnly: true,

                hidden: true,
                filter: {

                }

            },
            {

                header: 'NAV',

                dataIndex: 'nav',

                width: 60,

                readOnly: true,
                filter: {

                }

            }

        ],
        dockedItems: [Ext.create('Ext.toolbar.Paging', {
            dock: 'bottom',
            store: store
        })]
    });
});
