@section('meta-title','Watch Matrix | A Sophisticated Way of DSE Share Price Monitoring')
@section('meta-description', 'From Our multiple share price list, watch matrix is one of the best latest price monitoring tools of DSE.')
@extends('layouts.metronic.default')

@section('page_heading')
Watch Matrix
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-graph font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase">
								Watch Matrix </span>
                        <span class="caption-helper">Auto update also available</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse">
                        </a>

                        </a>
                        <a href="" class="remove">
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div id="gridpanel"></div>
                </div>
            </div>
            <!-- END Portlet PORTLET-->
        </div>
    </div>



@endsection

@push('css')
<link href="{{ URL::asset('metronic_custom/extjs/resources/ext-theme-gray/ext-theme-gray-all.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic_custom/extjs/src/ux/grid/css/GridFilters.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('metronic_custom/extjs/src/ux/grid/css/RangeMenu.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ URL::asset('metronic_custom/extjs/ext-all.php') }}" type="text/javascript"></script>

<script type="text/javascript">

Ext.require(['Ext.grid.*', 'Ext.data.*']);
Ext.define('DataObject', {
    extend: 'Ext.data.Model',
    idProperty: 'id',
    fields: [{name: 'id', type: 'int'}, {name: 'code', type: 'string'}, {
        name: 'sector',
        type: 'string'
    }, {name: 'category', type: 'string'}, {name: 'market_lot', type: 'int'}, {
        name: 'face_value',
        type: 'int'
    }, {name: 'nav', type: 'float'}, {name: 'lastprice', type: 'float'}, {name: 'open', type: 'float'}, {
        name: 'high',
        type: 'float'
    }, {name: 'low', type: 'float'}, {name: 'pchange', type: 'float'}, {name: 'change', type: 'float'}, {
        name: 'pe',
        type: 'float'
    }, {name: 'eps', type: 'float'}, {name: 'volume', type: 'int'}, {name: 'value', type: 'float'}, {
        name: 'trade',
        type: 'float'
    }, {name: 'ycp', type: 'float'}]
});
Ext.onReady(function () {
    var url = {local: 'grid-filter.json', remote: '/ajax/watch_matrix'};

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

    var mainGridStore = Ext.create('Ext.data.Store', {
        model: 'DataObject',
        proxy: {type: 'ajax', url: url.remote, reader: {type: 'json', root: 'maingrid'}},
        groupField: 'sector',
        autoLoad: true,
        listeners: {
            load: function (store, records, successful) {
                firstGridStore.loadRawData(store.proxy.reader.jsonData);
                secondGridStore.loadRawData(store.proxy.reader.jsonData);
                thirdGridStore.loadRawData(store.proxy.reader.jsonData);
            }
        }
    });
    var groupingFeature = Ext.create('Ext.grid.feature.Grouping', {groupHeaderTpl: '{name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'});
    var mainGrid = Ext.create('Ext.grid.Panel', {
        multiSelect: true,
        alias: 'widget.mainGrid',
        viewConfig: {
            plugins: {ptype: 'gridviewdragdrop', dragGroup: 'mainGridDDGroup', dropGroup: 'firstGridDDGroup'},
            listeners: {
                drop: function (node, data, dropRec, dropPosition) {
                    var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                }
            }
        },
        store: mainGridStore,
        features: [groupingFeature],
        columns: [{header: 'id', readOnly: true, dataIndex: 'id', width: 70, hidden: true}, {
            text: 'Scrips',
            flex: 1,
            tdCls: 'task',
            sortable: true,
            dataIndex: 'code',
            hideable: false,
            summaryType: 'count',
            width: 100,
            items: {
                xtype: 'textfield', flex: 1, margin: 2, enableKeyEvents: true, listeners: {
                    keyup: function () {
                        var store = this.up('tablepanel').store;
                        store.clearFilter();
                        if (this.value) {
                            store.filter({property: 'code', value: this.value, anyMatch: true, caseSensitive: false});
                        }
                    }, buffer: 500
                }
            }
        }, {header: 'Sector', dataIndex: 'sector', width: 200, hidden: true}, {
            header: 'Category',
            readOnly: true,
            dataIndex: 'category',
            width: 50,
            hidden: true
        }, {header: 'LastPrice', dataIndex: 'lastprice', width: 60, readOnly: true}, {
            header: 'Open',
            dataIndex: 'open',
            width: 60,
            readOnly: true
        }, {header: 'high', dataIndex: 'high', width: 60, readOnly: true}, {
            header: 'low',
            dataIndex: 'low',
            width: 60,
            readOnly: true
        }, {header: 'ycp', dataIndex: 'ycp', width: 60, readOnly: true, hidden: false}, {
            header: 'Change',
            renderer: colorChange,
            dataIndex: 'change',
            width: 60,
            readOnly: true
        }, {
            header: 'Change%',
            renderer: pctChange,
            dataIndex: 'pchange',
            width: 70,
            readOnly: true
        }, {header: '(D&A) P/E', dataIndex: 'pe', width: 60, readOnly: true}, {
            header: '(D&A) EPS',
            dataIndex: 'eps',
            width: 60,
            readOnly: true
        }, {header: 'volume', dataIndex: 'volume', width: 70, readOnly: true}, {
            header: 'Value(mn)',
            dataIndex: 'value',
            width: 70,
            readOnly: true
        }, {header: 'trade', dataIndex: 'trade', width: 70, readOnly: true}, {
            header: 'Market lot',
            dataIndex: 'market_lot',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: 'Face value', dataIndex: 'face_value', width: 60, readOnly: true, hidden: true}, {
            header: 'NAV',
            dataIndex: 'nav',
            width: 60,
            readOnly: true
        }],
        stripeRows: true,
        title: 'Main Grid',
        margins: '0 2 0 0'
    });
    var firstGridStore = Ext.create('Ext.data.Store', {
        model: 'DataObject',
        proxy: {
            type: 'memory',
            reader: {
                type: 'json',
                root: 'firstgrid',
                fields: ['id', 'code', 'sector', 'category', 'market_lot', 'face_value', 'nav', 'lastprice', 'open', 'high', 'low', 'pchange', 'change', 'pe', 'eps', 'volume', 'value', 'trade', 'ycp']
            }
        }
    });
    var firstGrid = Ext.create('Ext.grid.Panel', {
        viewConfig: {
            plugins: {
                ptype: 'gridviewdragdrop',
                dragGroup: 'firstGridDDGroup',
                dropGroup: 'mainGridDDGroup'
            },
            listeners: {
                drop: function (node, data, dropRec, dropPosition) {
                    var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                }
            },
            emptyText: "Drag a scrip from Main Grid and drop here to watch. You can configure the column and hide unnecessary column or rearrange the column position too",
            deferEmptyText: false
        },
        store: firstGridStore,
        closable: true,
        columns: [{header: 'id', readOnly: true, dataIndex: 'id', width: 70, hidden: true}, {
            header: 'Scrips',
            dataIndex: 'code',
            width: 80
        }, {header: 'Sector', dataIndex: 'sector', width: 200, hidden: true}, {
            header: 'Category',
            readOnly: true,
            dataIndex: 'category',
            width: 50,
            hidden: true
        }, {header: 'LastPrice', dataIndex: 'lastprice', width: 60, readOnly: true}, {
            header: 'Change',
            renderer: colorChange,
            dataIndex: 'change',
            width: 60,
            readOnly: true
        }, {header: 'Change%', renderer: pctChange, dataIndex: 'pchange', width: 70, readOnly: true}, {
            header: 'volume',
            dataIndex: 'volume',
            width: 70,
            readOnly: true
        }, {header: 'Open', dataIndex: 'open', width: 60, readOnly: true}, {
            header: 'high',
            dataIndex: 'high',
            width: 60,
            readOnly: true
        }, {header: 'low', dataIndex: 'low', width: 60, readOnly: true}, {
            header: 'ycp',
            dataIndex: 'ycp',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: '(D&A) P/E', dataIndex: 'pe', width: 60, readOnly: true, hidden: true}, {
            header: '(D&A) EPS',
            dataIndex: 'eps',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: 'Value(mn)', dataIndex: 'value', width: 70, readOnly: true}, {
            header: 'trade',
            dataIndex: 'trade',
            width: 70,
            readOnly: true,
            hidden: true
        }, {
            header: 'Market lot',
            dataIndex: 'market_lot',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: 'Face value', dataIndex: 'face_value', width: 60, readOnly: true, hidden: true}, {
            header: 'NAV',
            dataIndex: 'nav',
            width: 60,
            readOnly: true,
            hidden: true
        }],
        stripeRows: true,
        title: 'First Watch List',
        margins: '0 0 0 3'
    });
    var secondGridStore = Ext.create('Ext.data.Store', {
        model: 'DataObject',
        proxy: {
            type: 'memory',
            reader: {
                type: 'json',
                root: 'secondgrid',
                fields: ['id', 'code', 'sector', 'category', 'market_lot', 'face_value', 'nav', 'lastprice', 'open', 'high', 'low', 'pchange', 'change', 'pe', 'eps', 'volume', 'value', 'trade', 'ycp']
            }
        }
    });
    var secondGrid = Ext.create('Ext.grid.Panel', {
        viewConfig: {
            plugins: {
                ptype: 'gridviewdragdrop',
                dragGroup: 'secondGridDDGroup',
                dropGroup: 'mainGridDDGroup'
            },
            listeners: {
                drop: function (node, data, dropRec, dropPosition) {
                    var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                }
            },
            emptyText: "নিচের টেবিল থেকে শেয়ার টেনে এনে বক্সগুলোতে ফেলুন। একসাথে একাধিক টেনে আনতে পারবেন। সেক্ষেত্রে Ctrl  চেপে ধরুন",
            deferEmptyText: false
        },
        store: secondGridStore,
        closable: true,
        columns: [{header: 'id', readOnly: true, dataIndex: 'id', width: 70, hidden: true}, {
            header: 'Scrips',
            dataIndex: 'code',
            width: 80
        }, {header: 'Sector', dataIndex: 'sector', width: 200, hidden: true}, {
            header: 'Category',
            readOnly: true,
            dataIndex: 'category',
            width: 50,
            hidden: true
        }, {header: 'LastPrice', dataIndex: 'lastprice', width: 60, readOnly: true}, {
            header: 'Change',
            renderer: colorChange,
            dataIndex: 'change',
            width: 60,
            readOnly: true
        }, {header: 'Change%', renderer: pctChange, dataIndex: 'pchange', width: 70, readOnly: true}, {
            header: 'volume',
            dataIndex: 'volume',
            width: 70,
            readOnly: true
        }, {header: 'Open', dataIndex: 'open', width: 60, readOnly: true}, {
            header: 'high',
            dataIndex: 'high',
            width: 60,
            readOnly: true
        }, {header: 'low', dataIndex: 'low', width: 60, readOnly: true}, {
            header: 'ycp',
            dataIndex: 'ycp',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: '(D&A) P/E', dataIndex: 'pe', width: 60, readOnly: true, hidden: true}, {
            header: '(D&A) EPS',
            dataIndex: 'eps',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: 'Value(mn)', dataIndex: 'value', width: 70, readOnly: true}, {
            header: 'trade',
            dataIndex: 'trade',
            width: 70,
            readOnly: true,
            hidden: true
        }, {
            header: 'Market lot',
            dataIndex: 'market_lot',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: 'Face value', dataIndex: 'face_value', width: 60, readOnly: true, hidden: true}, {
            header: 'NAV',
            dataIndex: 'nav',
            width: 60,
            readOnly: true,
            hidden: true
        }],
        stripeRows: true,
        title: 'Second Watch List',
        margins: '0 0 0 3'
    });
    var thirdGridStore = Ext.create('Ext.data.Store', {
        model: 'DataObject',
        proxy: {
            type: 'memory',
            reader: {
                type: 'json',
                root: 'thirdgrid',
                fields: ['id', 'code', 'sector', 'category', 'market_lot', 'face_value', 'nav', 'lastprice', 'open', 'high', 'low', 'pchange', 'change', 'pe', 'eps', 'volume', 'value', 'trade', 'ycp']
            }
        }
    });
    var thirdGrid = Ext.create('Ext.grid.Panel', {
        viewConfig: {
            plugins: {
                ptype: 'gridviewdragdrop',
                dragGroup: 'thirdGridStore',
                dropGroup: 'mainGridDDGroup'
            },
            listeners: {
                drop: function (node, data, dropRec, dropPosition) {
                    var dropOn = dropRec ? ' ' + dropPosition + ' ' + dropRec.get('name') : ' on empty view';
                }
            },
            emptyText: "উপরের কলামগুলোর অবস্থান পরিবর্তন করা যায়। যেকোন একটি কলাম চেপে ধরে টেনে আনুন আপনার পছন্দমত অবস্থানে।",
            deferEmptyText: false
        },
        closable: true,
        store: thirdGridStore,
        columns: [{header: 'id', readOnly: true, dataIndex: 'id', width: 70, hidden: true}, {
            header: 'Scrips',
            dataIndex: 'code',
            width: 80
        }, {header: 'Sector', dataIndex: 'sector', width: 200, hidden: true}, {
            header: 'Category',
            readOnly: true,
            dataIndex: 'category',
            width: 50,
            hidden: true
        }, {header: 'LastPrice', dataIndex: 'lastprice', width: 60, readOnly: true}, {
            header: 'Change',
            renderer: pctChange,
            dataIndex: 'change',
            width: 60,
            readOnly: true
        }, {header: 'Change%', renderer: pctChange, dataIndex: 'pchange', width: 70, readOnly: true}, {
            header: 'volume',
            dataIndex: 'volume',
            width: 70,
            readOnly: true
        }, {header: 'Open', dataIndex: 'open', width: 60, readOnly: true}, {
            header: 'high',
            dataIndex: 'high',
            width: 60,
            readOnly: true
        }, {header: 'low', dataIndex: 'low', width: 60, readOnly: true}, {
            header: 'ycp',
            dataIndex: 'ycp',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: '(D&A) P/E', dataIndex: 'pe', width: 60, readOnly: true, hidden: true}, {
            header: '(D&A) EPS',
            dataIndex: 'eps',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: 'Value(mn)', dataIndex: 'value', width: 70, readOnly: true}, {
            header: 'trade',
            dataIndex: 'trade',
            width: 70,
            readOnly: true,
            hidden: true
        }, {
            header: 'Market lot',
            dataIndex: 'market_lot',
            width: 60,
            readOnly: true,
            hidden: true
        }, {header: 'Face value', dataIndex: 'face_value', width: 60, readOnly: true, hidden: true}, {
            header: 'NAV',
            dataIndex: 'nav',
            width: 60,
            readOnly: true,
            hidden: true
        }],
        stripeRows: true,
        title: 'Third Watch List',
        margins: '0 0 0 3'
    });
    var displayPanel = Ext.create('Ext.panel.Panel', {
      /*  width: 975,*/
        height: 750,
        layout: 'border',
        items: [{
            region: 'south',
            xtype: 'panel',
            layout: {type: 'hbox', align: 'stretch', padding: 5},
            defaults: {flex: 1},
            height: 450,
            margins: '0 5 5 5',
            items: [mainGrid]
        }, {
            region: 'center',
            xtype: 'panel',
            layout: {type: 'hbox', align: 'stretch', padding: 5},
            defaults: {flex: 1},
            margins: '5 5 0 0',
            items: [firstGrid, secondGrid, thirdGrid],
            dockedItems: {
                xtype: 'toolbar', dock: 'bottom', items: ['->', {
                    text: 'Auto Refresh', handler: function () {
                        var task = {
                            run: function () {
                                var sendDataArray2 = [];
                                firstGridStore.each(function (record) {
                                    var recordArray2 = [record.get("code")];
                                    sendDataArray2.push(recordArray2);
                                });
                                var sendDataArray3 = [];
                                secondGridStore.each(function (record) {
                                    var recordArray3 = [record.get("code")];
                                    sendDataArray3.push(recordArray3);
                                });
                                var sendDataArray4 = [];
                                thirdGridStore.each(function (record) {
                                    var recordArray4 = [record.get("code")];
                                    sendDataArray4.push(recordArray4);
                                });
                                firstGridStore.removeAll();
                                secondGridStore.removeAll();
                                thirdGridStore.removeAll();
                                mainGridStore.proxy.extraParams = {
                                    "firstgrid": Ext.encode(sendDataArray2),
                                    "secondgrid": Ext.encode(sendDataArray3),
                                    "thirdgrid": Ext.encode(sendDataArray4)
                                };
                                mainGridStore.load();
                                var currentDate = new Date();
                                mainGrid.setTitle(currentDate);
                            }, interval: 60000
                        };
                        var runner = new Ext.util.TaskRunner();
                        runner.start(task);
                    }
                }, {
                    text: 'Reset All Watch List', handler: function () {
                        firstGridStore.removeAll();
                        secondGridStore.removeAll();
                        thirdGridStore.removeAll();
                    }
                }, {
                    text: 'Refresh All', handler: function () {
                        var sendDataArray2 = [];
                        firstGridStore.each(function (record) {
                            var recordArray2 = [record.get("code")];
                            sendDataArray2.push(recordArray2);
                        });
                        var sendDataArray3 = [];
                        secondGridStore.each(function (record) {
                            var recordArray3 = [record.get("code")];
                            sendDataArray3.push(recordArray3);
                        });
                        var sendDataArray4 = [];
                        thirdGridStore.each(function (record) {
                            var recordArray4 = [record.get("code")];
                            sendDataArray4.push(recordArray4);
                        });
                        mainGridStore.proxy.extraParams = {
                            "firstgrid": Ext.encode(sendDataArray2),
                            "secondgrid": Ext.encode(sendDataArray3),
                            "thirdgrid": Ext.encode(sendDataArray4)
                        };
                        mainGridStore.load();
                        var currentDate = new Date();
                        mainGrid.setTitle(currentDate);
                    }
                }]
            }
        }],
        renderTo: "gridpanel"
    });
});


Ext.example = function(){
    var msgCt;

    function createBox(t, s){
       // return ['<div class="msg">',
       //         '<div class="x-box-tl"><div class="x-box-tr"><div class="x-box-tc"></div></div></div>',
       //         '<div class="x-box-ml"><div class="x-box-mr"><div class="x-box-mc"><h3>', t, '</h3>', s, '</div></div></div>',
       //         '<div class="x-box-bl"><div class="x-box-br"><div class="x-box-bc"></div></div></div>',
       //         '</div>'].join('');
       return '<div class="msg"><h3>' + t + '</h3><p>' + s + '</p></div>';
    }
    return {
        msg : function(title, format){
            if(!msgCt){
                msgCt = Ext.DomHelper.insertFirst(document.body, {id:'msg-div'}, true);
            }
            var s = Ext.String.format.apply(String, Array.prototype.slice.call(arguments, 1));
            var m = Ext.DomHelper.append(msgCt, createBox(title, s), true);
            m.hide();
            m.slideIn('t').ghost("t", { delay: 1000, remove: true});
        },

        init : function(){
//            var t = Ext.get('exttheme');
//            if(!t){ // run locally?
//                return;
//            }
//            var theme = Cookies.get('exttheme') || 'aero';
//            if(theme){
//                t.dom.value = theme;
//                Ext.getBody().addClass('x-'+theme);
//            }
//            t.on('change', function(){
//                Cookies.set('exttheme', t.getValue());
//                setTimeout(function(){
//                    window.location.reload();
//                }, 250);
//            });
//
//            var lb = Ext.get('lib-bar');
//            if(lb){
//                lb.show();
//            }
        }
    };
}();

Ext.example.shortBogusMarkup = '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed metus nibh, '+
    'sodales a, porta at, vulputate eget, dui. Pellentesque ut nisl. Maecenas tortor turpis, interdum non, sodales '+
    'non, iaculis ac, lacus. Vestibulum auctor, tortor quis iaculis malesuada, libero lectus bibendum purus, sit amet '+
    'tincidunt quam turpis vel lacus. In pellentesque nisl non sem. Suspendisse nunc sem, pretium eget, cursus a, fringilla.</p>';

Ext.example.bogusMarkup = '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed metus nibh, sodales a, '+
    'porta at, vulputate eget, dui. Pellentesque ut nisl. Maecenas tortor turpis, interdum non, sodales non, iaculis ac, '+
    'lacus. Vestibulum auctor, tortor quis iaculis malesuada, libero lectus bibendum purus, sit amet tincidunt quam turpis '+
    'vel lacus. In pellentesque nisl non sem. Suspendisse nunc sem, pretium eget, cursus a, fringilla vel, urna.<br/><br/>'+
    'Aliquam commodo ullamcorper erat. Nullam vel justo in neque porttitor laoreet. Aenean lacus dui, consequat eu, adipiscing '+
    'eget, nonummy non, nisi. Morbi nunc est, dignissim non, ornare sed, luctus eu, massa. Vivamus eget quam. Vivamus tincidunt '+
    'diam nec urna. Curabitur velit. Lorem ipsum dolor sit amet.</p>';

//Ext.onReady(Ext.example.init, Ext.example);


// old school cookie functions
var Cookies = {};
Cookies.set = function(name, value){
     var argv = arguments;
     var argc = arguments.length;
     var expires = (argc > 2) ? argv[2] : null;
     var path = (argc > 3) ? argv[3] : '/';
     var domain = (argc > 4) ? argv[4] : null;
     var secure = (argc > 5) ? argv[5] : false;
     document.cookie = name + "=" + escape (value) +
       ((expires === null) ? "" : ("; expires=" + expires.toGMTString())) +
       ((path === null) ? "" : ("; path=" + path)) +
       ((domain === null) ? "" : ("; domain=" + domain)) +
       ((secure === true) ? "; secure" : "");
};

Cookies.get = function(name){
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    var j = 0;
    while(i < clen){
        j = i + alen;
        if (document.cookie.substring(i, j) == arg)
            return Cookies.getCookieVal(j);
        i = document.cookie.indexOf(" ", i) + 1;
        if(i === 0)
            break;
    }
    return null;
};

Cookies.clear = function(name) {
  if(Cookies.get(name)){
    document.cookie = name + "=" +
    "; expires=Thu, 01-Jan-70 00:00:01 GMT";
  }
};

Cookies.getCookieVal = function(offset){
   var endstr = document.cookie.indexOf(";", offset);
   if(endstr === -1){
       endstr = document.cookie.length;
   }
   return unescape(document.cookie.substring(offset, endstr));
};




</script>




@endpush