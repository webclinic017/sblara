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

Ext.define('DataObjectMutual', {
    extend: 'Ext.data.Model',
    fields: [
        {name: 'dse_code', type: 'string'},
        {name: 'dse_listing_year', type: 'string'},
        {name: 'lasttradeprice', type: 'float'},
        {name: 'mpb', type: 'float'},
        {name: 'cpb', type: 'float'},
        {name: 'cpbdiff', type: 'float'},
        {name: 'cpbdiffper', type: 'float'},
        {name: 'mpbdiff', type: 'float'},
        {name: 'mpbdiffper', type: 'float'},
        {name: 'sunday_date', type: 'string'},
        {name: 'market_lot', type: 'int'},
        {name: 'outstanding_capital', type: 'float'},
        {name: 'total_no_securities', type: 'int'},
        {name: 'share_percentage_director', type: 'float'},
        {name: 'share_percentage_govt', type: 'float'},
        {name: 'share_percentage_institute', type: 'float'},
        {name: 'share_percentage_foreign', type: 'float'},
        {name: 'share_percentage_public', type: 'float'},
        {name: 'reserve_and_surplus', type: 'float'}

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
        model: 'DataObjectMutual',
        autoLoad: true,
        /*
         remoteSort: true,
         remoteGroup: true,*/
        proxy: {
            type: 'ajax',
            url: '/grids/mutual_fund_matrix_data',//(local ? url.local : url.remote),
            reader: {
                type: 'json',
                root: 'pricedata'

            }
        },
        sorters: {property: 'dse_code', direction: 'ASC'},
        //groupField: 'dse_listing_year',
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
        title: 'Mutual Fund Matrix',
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
                text: 'Mutual Fund',
                flex: 1,
                tdCls: 'task',
                sortable: true,
                dataIndex: 'dse_code',
                hideable: false,
                // header: 'Scrips',

                // dataIndex: 'code',

                width: 70,
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
                                    property: 'dse_code',
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

                header: 'Listing Year',

                dataIndex: 'dse_listing_year',

                width: 60,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'LTP',
                dataIndex: 'lasttradeprice',
                width: 50,
                readOnly: true,
                filter: {

                }

            },


            {

                header: 'Nav (CP)',
                dataIndex: 'cpb',

                width: 60,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'Ltp-Nav(CP)',
                dataIndex: 'cpbdiff',
                renderer: colorChange,
                width: 70,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'Ltp-Nav(CP)(%)',
                dataIndex: 'cpbdiffper',
                renderer: pctChange,
                width: 70,

                readOnly: true,
                filter: {

                }

            },{

                header: 'Nav (MP)',

                dataIndex: 'mpb',

                width: 60,

                readOnly: true,
                filter: {

                }

            },
            {

                header: 'Ltp-Nav(MP)',
                dataIndex: 'mpbdiff',
                renderer: colorChange,
                width: 70,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'Ltp-Nav(MP)(%)',
                dataIndex: 'mpbdiffper',
                renderer: pctChange,
                width: 70,

                readOnly: true,
                filter: {

                }

            },
            {

                header: 'Reported On',
                dataIndex: 'sunday_date',

                width: 80,

                readOnly: true,

                hidden: false,
                filter: {

                }

            },

            {

                header: 'reserve',
                dataIndex: 'reserve_and_surplus',
                width: 60,
                readOnly: true,
                filter: {

                }

            },
            {

                header: 'Lot',

                dataIndex: 'market_lot',

                width: 60,

                readOnly: true,
                filter: {

                }

            },
            {

                header: 'Total Fund',

                dataIndex: 'outstanding_capital',

                width: 60,

                readOnly: true,
                filter: {

                }

            },

            {

                header: 'No of Unit',
                dataIndex: 'total_no_securities',
                width: 60,
                readOnly: true,
                filter: {

                }

            }
            ,

            {

                header: 'Dir(%)',
                dataIndex: 'share_percentage_director',
                width: 50,
                readOnly: true,
                hidden: true,
                filter: {

                }

            }
            ,

            {

                header: 'Govt(%)',
                dataIndex: 'share_percentage_govt',
                width: 50,
                readOnly: true,
                hidden: true,
                filter: {

                }

            }
            ,

            {

                header: 'Inst(%)',
                dataIndex: 'share_percentage_institute',
                width: 50,
                readOnly: true,
                hidden: true,
                filter: {

                }

            }
            ,

            {

                header: 'For(%)',
                dataIndex: 'share_percentage_foreign',
                width: 50,
                readOnly: true,
                hidden: true,
                filter: {

                }

            } ,

            {

                header: 'Pub(%)',
                dataIndex: 'share_percentage_public',
                width: 50,
                readOnly: true,
                hidden: true,
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
