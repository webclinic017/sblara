Ext.define('Writer.Form', {
    extend: 'Ext.form.Panel',
    alias: 'widget.writerform',

    requires: ['Ext.form.field.Text'],

    initComponent: function() {
        this.addEvents('create');
        Ext.apply(this, {
            activeRecord: null,
            iconCls: 'icon-user',
            frame: true,
            title: 'Quaterly data -- All fields are required',
            defaultType: 'textfield',
            bodyPadding: 5,
            fieldDefaults: {
                anchor: '100%',
                labelAlign: 'right'
            },
            items: [{
                fieldLabel: 'Fin Year',
                name: 'fin_year',
                allowBlank: true
            }, {
                xtype: 'textareafield',
                fieldLabel: 'Q1 News',
                name: 'q1_news',
                allowBlank: true
            }, {
                xtype: 'textareafield',
                fieldLabel: 'Q2 News',
                name: 'q2_news',
                allowBlank: true
            }, {
                xtype: 'textareafield',
                name: 'q3_news',
                fieldLabel: 'Q3 News',
                anchor: '100%'
            }, {
                xtype: 'textareafield',
                name: 'q4_news',
                fieldLabel: 'Q4 News',
                anchor: '100%'
            }],
            //dockedItems: [{
            //    xtype: 'toolbar',
            //    dock: 'bottom',
            //    ui: 'footer',
            //    items: ['->',
            //    {
            //        iconCls: 'icon-save',
            //        itemId: 'save',
            //        text: 'Save',
            //        disabled: true,
            //        scope: this,
            //        handler: this.onSave
            //    }, {
            //        iconCls: 'icon-user-add',
            //        text: 'Create',
            //        scope: this,
            //        handler: this.onCreate
            //    }, {
            //        iconCls: 'icon-reset',
            //        text: 'Reset',
            //        scope: this,
            //        handler: this.onReset
            //    }]
            //}]
        });
        this.callParent();
    },

    setActiveRecord: function(record) {
        this.activeRecord = record;
        if (record) {
            //this.down('#save').enable();
            this.getForm().loadRecord(record);
        } else {
            //this.down('#save').disable();
            this.getForm().reset();
        }
    },

    onSave: function() {
        var active = this.activeRecord,
            form = this.getForm();

        if (!active) {
            return;
        }
        if (form.isValid()) {
            form.updateRecord(active);
            this.onReset();
        }
    },

    onCreate: function() {
        var form = this.getForm();

        if (form.isValid()) {
            this.fireEvent('create', this, form.getValues());
            form.reset();
        }

    },

    onReset: function() {
        this.setActiveRecord(null);
        this.getForm().reset();
    }
});


// JavaScript Document// vim: ts=4:sw=4:nu:fdc=4:nospell
/**
 * Search plugin for Ext.grid.GridPanel, Ext.grid.EditorGrid ver. 2.x or subclasses of them
 *
 * @author    Ing. Jozef Sakalos
 * @copyright (c) 2008, by Ing. Jozef Sakalos
 * @date      17. January 2008
 * @version   $Id: Ext.ux.grid.Search.js 220 2008-04-29 21:46:51Z jozo $
 *
 * @license Ext.ux.grid.Search is licensed under the terms of
 * the Open Source LGPL 3.0 license.  Commercial use is permitted to the extent
 * that the code/component(s) do NOT become part of another Open Source or Commercially
 * licensed development library or toolkit without explicit permission.
 * 
 * License details: http://www.gnu.org/licenses/lgpl.html
 */

/*
	Revised for Ext 4
	by Nathan LeBlanc
	on July 8, 2011
*/

Ext.define('Ext.ux.grid.feature.Searching', {
    extend: 'Ext.grid.feature.Feature',
    alias: 'feature.searching',

	/**
	 * cfg {Boolean} autoFocus true to try to focus the input field on each store load (defaults to undefined)
	 */

	/**
	 * @cfg {String} searchText Text to display on menu button
	 */
	searchText:'Search',

	/**
	 * @cfg {String} searchTipText Text to display as input tooltip. Set to '' for no tooltip
	 */ 
	searchTipText:'Type a text to search and press Enter',

	/**
	 * @cfg {String} selectAllText Text to display on menu item that selects all fields
	 */
	selectAllText:'Select All',

	/**
	 * @cfg {String} position Where to display the search controls. Valid values are top and bottom (defaults to bottom)
	 * Corresponding toolbar has to exist at least with mimimum configuration tbar:[] for position:top or bbar:[]
	 * for position bottom. Plugin does NOT create any toolbar.
	 */
	position:'top',

	/**
	 * @cfg {String} iconCls Icon class for menu button (defaults to icon-magnifier)
	 */
	iconCls:'icon-magnifier',

	/**
	 * @cfg {String/Array} checkIndexes Which indexes to check by default. Can be either 'all' for all indexes
	 * or array of dataIndex names, e.g. ['persFirstName', 'persLastName']
	 */
	checkIndexes:'all',

	/**
	 * @cfg {Array} disableIndexes Array of index names to disable (not show in the menu), e.g. ['persTitle', 'persTitle2']
	 */
	disableIndexes:[],

	/**
	 * @cfg {String} dateFormat how to format date values. If undefined (the default) 
	 * date is formatted as configured in colummn model
	 */
	dateFormat:undefined,

	/**
	 * @cfg {Boolean} showSelectAll Select All item is shown in menu if true (defaults to true)
	 */
	showSelectAll:true,

	/**
	 * @cfg {String} menuStyle Valid values are 'checkbox' and 'radio'. If menuStyle is radio
	 * then only one field can be searched at a time and selectAll is automatically switched off.
	 */
	menuStyle:'checkbox',

	/**
	 * @cfg {Number} minChars minimum characters to type before the request is made. If undefined (the default)
	 * the trigger field shows magnifier icon and you need to click it or press enter for search to start. If it
	 * is defined and greater than 0 then maginfier is not shown and search starts after minChars are typed.
	 */

	/**
	 * @cfg {String} minCharsTipText Tooltip to display if minChars is > 0
	 */
	minCharsTipText:'Type at least {0} characters',

	/**
	 * @cfg {String} mode Use 'remote' for remote stores or 'local' for local stores. If mode is local
	 * no data requests are sent to server the grid's store is filtered instead (defaults to 'remote')
	 */
	mode:'local',

	/**
	 * @cfg {Array} readonlyIndexes Array of index names to disable (show in menu disabled), e.g. ['persTitle', 'persTitle2']
	 */

	/**
	 * @cfg {Number} width Width of input field in pixels (defaults to 100)
	 */
	width:100,

	/**
	 * @cfg {Object} paramNames Params name map (defaults to {fields:'fields', query:'query'}
	 */
	paramNames: {
		 fields:'fields'
		,query:'query'
	},

	/**
	 * @cfg {String} shortcutKey Key to fucus the input field (defaults to r = Sea_r_ch). Empty string disables shortcut
	 */
	shortcutKey:'r',

	/**
	 * @cfg {String} shortcutModifier Modifier for shortcutKey. Valid values: alt, ctrl, shift (defaults to alt)
	 */
	shortcutModifier:'alt',

	/**
	 * @cfg {String} align 'left' or 'right' (defaults to 'left')
	 */

	/**
	 * @cfg {Number} minLength force user to type this many character before he can make a search
	 */

	/**
	 * @cfg {Ext.Panel/String} toolbarContainer Panel (or id of the panel) which contains toolbar we want to render
	 * search controls to (defaults to this.grid, the grid this plugin is plugged-in into)
	 */
			
	init: function(grid) {
    this.grid = grid;
    if(this.grid.rendered)
        this.onRender();
    else
        this.grid.on('render', this.onRender, this);
},
	onRender:function() {
				
		var panel = this.toolbarContainer || this.grid;
		var tb = 'bottom' === this.position ? panel.getDockedItems('toolbar[dock="bottom"]') : panel.getDockedItems('toolbar[dock="top"]');
		if(tb.length > 0)
			tb = tb[0]
		else {
			tb = Ext.create('Ext.toolbar.Toolbar', {dock: this.position});
			panel.addDocked(tb);
		}

		// add menu
		this.menu = Ext.create('Ext.menu.Menu');

		// handle position
		if('right' === this.align) {
			tb.add('->');
		}
		else {
			if(0 < tb.items.getCount()) {
				tb.add('-');
			}
		}

		// add menu button
		tb.add({
			 text:this.searchText
			,menu:this.menu
			,iconCls:this.iconCls
		});

		// add input field (TwinTriggerField in fact)
		this.field = Ext.create('Ext.form.TwinTriggerField', {
			width:this.width,
			qtip: 'ddd',
			selectOnFocus:undefined === this.selectOnFocus ? true : this.selectOnFocus,
			trigger1Cls:'x-form-clear-trigger',
			trigger2Cls:this.minChars ? 'x-hidden' : 'x-form-search-trigger',
			onTrigger1Click: Ext.bind(this.onTriggerClear, this),
			onTrigger2Click: this.minChars ? Ext.emptyFn : Ext.bind(this.onTriggerSearch, this),
			minLength:this.minLength
		});
		
		// install event handlers on input field
		this.field.on('render', function() {
			
			var qtip = this.minChars ? Ext.String.format(this.minCharsTipText, this.minChars) : this.searchTipText;
			Ext.QuickTips.register({
				target: this.field.inputEl,
				text: qtip
			});
			
			if(this.minChars) {
				this.field.el.on({scope:this, buffer:300, keyup:this.onKeyUp});
			}

			// install key map
			var map = new Ext.KeyMap(this.field.el, [{
				 key:Ext.EventObject.ENTER
				,scope:this
				,fn:this.onTriggerSearch
			},{
				 key:Ext.EventObject.ESC
				,scope:this
				,fn:this.onTriggerClear
			}]);
			map.stopEvent = true;
		}, this, {single:true});

		tb.add(this.field);

		// reconfigure
		this.reconfigure();

		// keyMap
		if(this.shortcutKey && this.shortcutModifier) {
			var shortcutEl = this.grid.getEl();
			var shortcutCfg = [{
				 key:this.shortcutKey
				,scope:this
				,stopEvent:true
				,fn:function() {
					this.field.focus();
				}
			}];
			shortcutCfg[0][this.shortcutModifier] = true;
			this.keymap = new Ext.KeyMap(shortcutEl, shortcutCfg);
		}

		if(true === this.autoFocus) {
			this.grid.store.on({scope:this, load:function(){this.field.focus();}});
		}
	} // eo function onRender
	// }}}
	// {{{
	/**
	 * field el keypup event handler. Triggers the search
	 * @private
	 */
	,onKeyUp:function() {
		var length = this.field.getValue().toString().length;
		if(0 === length || this.minChars <= length) {
			this.onTriggerSearch();
		}
	} // eo function onKeyUp
	// }}}
	// {{{
	/**
	 * private Clear Trigger click handler
	 */
	,onTriggerClear:function() {
		if(this.field.getValue()) {
			this.field.setValue('');
			this.field.focus();
			this.onTriggerSearch();
		}
	} // eo function onTriggerClear
	// }}}
	// {{{
	/**
	 * private Search Trigger click handler (executes the search, local or remote)
	 */
	,onTriggerSearch:function() {
		if(!this.field.isValid()) {
			return;
		}
		var val = this.field.getValue(),
			store = this.grid.store,
			proxy = store.getProxy();

		// grid's store filter
		if('local' === this.mode) {
			store.clearFilter();
			if(val) {
				store.filterBy(function(r) {
					var retval = false;
					this.menu.items.each(function(item) {
						if(!item.checked || retval) {
							return;
						}
						var rv = r.get(item.dataIndex);
						rv = rv instanceof Date ? Ext.Date.format(rv, this.dateFormat || r.fields.get(item.dataIndex).dateFormat) : rv;
						var re = new RegExp(val, 'gi');
						retval = re.test(rv);
					}, this);
					if(retval) {
						return true;
					}
					return retval;
				}, this);
			}
			else {
			}
		}
		// ask server to filter records
		// your proxy must be a Server proxy
		else if(proxy instanceof Ext.data.proxy.Server) {
			// clear start (necessary if we have paging)
			if(store.lastOptions && store.lastOptions.params) {
				store.lastOptions.params[store.paramNames.start] = 0;
			}

			// get fields to search array
			var fields = [];
			this.menu.items.each(function(item) {
				if(item.checked && item.dataIndex) {
					fields.push(item.dataIndex);
				}
			});

			// add fields and query to baseParams of store
			delete(proxy.extraParams[this.paramNames.fields]);
			delete(proxy.extraParams[this.paramNames.query]);
			if (store.lastOptions && store.lastOptions.params) {
				delete(proxy.lastOptions.params[this.paramNames.fields]);
				delete(proxy.lastOptions.params[this.paramNames.query]);
			}
			if(fields.length) {
				proxy.extraParams[this.paramNames.fields] = Ext.encode(fields);
				proxy.extraParams[this.paramNames.query] = val;
			}

			// reload store
			store.load();
		}

	} // eo function onTriggerSearch
	// }}}
	// {{{
	/**
	 * @param {Boolean} true to disable search (TwinTriggerField), false to enable
	 */
	,setDisabled:function() {
		this.field.setDisabled.apply(this.field, arguments);
	} // eo function setDisabled
	// }}}
	// {{{
	/**
	 * Enable search (TwinTriggerField)
	 */
	,enable:function() {
		this.setDisabled(false);
	} // eo function enable
	// }}}
	// {{{
	/**
	 * Enable search (TwinTriggerField)
	 */
	,disable:function() {
		this.setDisabled(true);
	} // eo function disable
	// }}}
	// {{{
	/**
	 * private (re)configures the plugin, creates menu items from column model
	 */
	,reconfigure:function() {

		// {{{
		// remove old items
		var menu = this.menu;
		menu.removeAll();

		// add Select All item plus separator
		if(this.showSelectAll && 'radio' !== this.menuStyle) {
			menu.add({
				xtype: 'menucheckitem',
				text:this.selectAllText,
				checked:!(this.checkIndexes instanceof Array),
				hideOnClick:false,
				handler:function(item) {
					var checked = item.checked;
					item.parentMenu.items.each(function(i) {
						if(item !== i && i.setChecked && !i.disabled) {
							i.setChecked(checked);
						}
					});
				}
			},'-');
		}

		// }}}
		// {{{
		// add new items
		var columns = this.grid.headerCt.items.items;
		var group = undefined;
		if('radio' === this.menuStyle) {
			group = 'g' + (new Date).getTime();	
		}
		
		Ext.each(columns, function(column) {
			var disable = false;
			if(column.text && column.dataIndex && column.dataIndex != '') {
				Ext.each(this.disableIndexes, function(item) {
					disable = disable ? disable : item === column.dataIndex;
				});
				if(!disable) {
					menu.add({
						xtype: 'menucheckitem',
						text: column.text,
						hideOnClick: false,
						group:group,
						checked: 'all' === this.checkIndexes,
						dataIndex: column.dataIndex,
					});
				}
			}
		}, this);
		// }}}
		// {{{
		// check items
		if(this.checkIndexes instanceof Array) {
			Ext.each(this.checkIndexes, function(di) {
				var item = menu.items.find(function(itm) {
					return itm.dataIndex === di;
				});
				if(item) {
					item.setChecked(true, true);
				}
			}, this);
		}
		// }}}
		// {{{
		// disable items
		if(this.readonlyIndexes instanceof Array) {
			Ext.each(this.readonlyIndexes, function(di) {
				var item = menu.items.find(function(itm) {
					return itm.dataIndex === di;
				});
				if(item) {
					item.disable();
				}
			}, this);
		}
		// }}}

	} // eo function reconfigure
	// }}}

}); // eo extend

// eof


var searching = {
   ftype: 'searching',
   minChars: 2,
   mode: 'local'
};



 var groupingFeature = Ext.create('Ext.grid.feature.Grouping',{
        groupHeaderTpl: '{name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})'
    });



Ext.define('Writer.Grid', {
    extend: 'Ext.grid.Panel',
    alias: 'widget.writergrid',

    requires: ['Ext.grid.plugin.CellEditing', 'Ext.form.field.Text', 'Ext.toolbar.TextItem'],

    initComponent: function() {

        this.editing = Ext.create('Ext.grid.plugin.CellEditing');

        Ext.apply(this, {
            iconCls: 'icon-grid',
            frame: true,
            plugins: [this.editing],
            dockedItems: [{
                xtype: 'toolbar',
                items: [{
                    iconCls: 'icon-add',
                    text: 'Add',
                    scope: this,
                    handler: this.onAddClick
                }, {
                    iconCls: 'icon-delete',
                    text: 'Delete',
                    disabled: true,
                    itemId: 'delete',
                    scope: this,
                    handler: this.onDeleteClick
                }]
            }, {
                weight: 2,
                xtype: 'toolbar',
                dock: 'bottom',
                items: [{
                    xtype: 'tbtext',
                    text: '<b>@cfg</b>'
                }, '|',
                /*{
                    text: 'autoSync',
                    enableToggle: true,
                    pressed: true,
                    tooltip: 'When enabled, Store will execute Ajax requests as soon as a Record becomes dirty.',
                    scope: this,
                    toggleHandler: function(btn, pressed) {
                        this.store.autoSync = pressed;
                    }
                },*/ {
                    text: 'batch',
                    enableToggle: true,
                    pressed: true,
                    tooltip: 'When enabled, Store will batch all records for each type of CRUD verb into a single Ajax request.',
                    scope: this,
                    toggleHandler: function(btn, pressed) {
                        this.store.getProxy().batchActions = pressed;
                    }
                }/*, {
                    text: 'writeAllFields',
                    enableToggle: true,
                    pressed: false,
                    tooltip: 'When enabled, Writer will write *all* fields to the server -- not just those that changed.',
                    scope: this,
                    toggleHandler: function(btn, pressed) {
                        this.store.getProxy().getWriter().writeAllFields = pressed;
                    }
                }*/]
            }, {
                weight: 1,
                xtype: 'toolbar',
                dock: 'bottom',
                ui: 'footer',
                items: ['->',
                {
                    iconCls: 'icon-save',
                    text: 'Sync',
                    scope: this,
                    handler: this.onSync
                }]
            }],
            columns: [{
                text: 'ID',
                width: 70,
                sortable: true,
                resizable: false,
                hidden: true,
                hideable: true,
                menuDisabled: true,
                dataIndex: 'id'
            }, {
                header: 'Code',
                width: 80,
                sortable: true,
                dataIndex: 'code',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Fin Year',
                width: 130,
                sortable: true,
                dataIndex: 'fin_year',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Net Profit Q1',
                width: 70,
                sortable: true,
                dataIndex: 'q1_netprofit',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'EPS Q1',
                width: 70,
                sortable: true,
                dataIndex: 'q1_eps',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Net Profit Q2',
                width: 70,
                sortable: true,
                dataIndex: 'q2_netprofit',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'EPS Q2',
                width: 70,
                sortable: true,
                dataIndex: 'q2_eps',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Net profit HY',
                width: 70,
                sortable: true,
                hidden: false,
                dataIndex: 'hy_netprofit',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'EPS HY',
                width: 70,
                sortable: true,
                hidden: false,
                dataIndex: 'hy_eps',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Net profit q3',
                width: 70,
                sortable: false,
                
                dataIndex: 'q3_netprofit',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'EPS q3',
                width: 70,
                sortable: true,
                dataIndex: 'q3_eps',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Net profit 9M',
                width: 70,
                sortable: true,
                hidden: false,
                dataIndex: '9m_netprofit',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'EPS 9M',
                width: 70,
                sortable: true,
                hidden: false,
                dataIndex: '9m_eps',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Net Profit q4',
                width: 70,
                sortable: true,
                dataIndex: 'q4_netprofit',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'EPS q4',
                width: 70,
                sortable: true,
                dataIndex: 'q4_eps',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Q1 News',
                width: 100,
                sortable: true,
                hidden: true,
                dataIndex: 'q1_news',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Q2 News',
                width: 100,
                sortable: true,
                hidden: true,
                dataIndex: 'q2_news',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Q3 News',
                width: 100,
                sortable: true,
                hidden: true,
                dataIndex: 'q3_news',
                field: {
                    type: 'textfield'
                }
            }, {
                header: 'Q4 News',
                width: 100,
                sortable: true,
                hidden: true,
                dataIndex: 'q4_news',
                field: {
                    type: 'textfield'
                }
            }],
            //features: [{ftype:'grouping'}],
            features: [groupingFeature,searching],
        });
        this.callParent();
        this.getSelectionModel().on('selectionchange', this.onSelectChange, this);
    },

    onSelectChange: function(selModel, selections) {
        this.down('#delete').setDisabled(selections.length === 0);
    },

    onSync: function() {
        this.store.sync();
    },

    onDeleteClick: function() {
        var selection = this.getView().getSelectionModel().getSelection()[0];
        if (selection) {
            this.store.remove(selection);
        }
    },

    onAddClick: function() {
        var rec = new Writer.Person({
            fin_year: '',
            q1_netprofit: '',
            q1_eps: '',
            q2_netprofit: ''
        }),
            edit = this.editing;

        edit.cancelEdit();
        this.store.insert(0, rec);
        edit.startEditByPosition({
            row: 0,
            column: 1
        });
    }
});

Ext.define('Writer.Person', {
    extend: 'Ext.data.Model',
    fields: [{
        name: 'id',
        type: 'int',
        useNull: true
    }, 'id', 'fin_year','code', 'q1_netprofit', 'q1_eps', 'q2_netprofit', 'q2_eps', 'hy_netprofit', 'hy_eps', 'q3_netprofit', 'q3_eps', '9m_netprofit', '9m_eps', 'q4_netprofit', 'q4_eps', 'q1_news', 'q2_news', 'q3_news', 'q4_news']
    
});

Ext.require(['Ext.data.*', 'Ext.tip.QuickTipManager', 'Ext.window.MessageBox']);

Ext.onReady(function() {
    Ext.tip.QuickTipManager.init();

    Ext.create('Ext.button.Button', {
        margin: '0 0 20 20',
        text: 'Reset sample database back to initial state',
        renderTo: 'binding-example',
        //renderTo: document.body,
        tooltip: 'The sample database is stored in the session, including any changes you make. Click this button to reset the sample database to the initial state',
        handler: function() {
            Ext.getBody().mask('Resetting...');
            Ext.Ajax.request({
                url: 'grids/',
                callback: function(options, success, response) {
                    Ext.getBody().unmask();

                    var didReset = true,
                        o;

                    if (success) {
                        try {
                            o = Ext.decode(response.responseText);
                            didReset = o.success === true;
                        } catch (e) {
                            didReset = false;
                        }
                    } else {
                        didReset = false;
                    }

                    if (didReset) {
                        store.load();
                        main.down('#form').setActiveRecord(null);
                        Ext.example.msg('Reset', 'Reset successful');
                    } else {
                        Ext.MessageBox.alert('Error', 'Unable to reset example database');
                    }

                }
            });
        }
    })

    var store = Ext.create('Ext.data.Store', {
        model: 'Writer.Person',
        groupField: 'fin_year',
        autoLoad: true,
        autoSync: false,
        proxy: {
            type: 'ajax',
            api: {
                read: '/grids/read',
                create: '/grids/create',
                update: '/grids/update',
                destroy: '/grids/del'
            },
            reader: {
                type: 'json',
                successProperty: 'success',
                root: 'data',
                messageProperty: 'message'
            },
            writer: {
                type: 'json',
                writeAllFields: false,
                root: 'data'
            },
            listeners: {
                exception: function(proxy, response, operation) {
                    Ext.MessageBox.show({
                        title: 'REMOTE EXCEPTION',
                        msg: operation.getError(),
                        icon: Ext.MessageBox.ERROR,
                        buttons: Ext.Msg.OK
                    });
                }
            }
        },
        listeners: {
            write: function(proxy, operation) {
                if (operation.action == 'destroy') {
                    main.child('#form').setActiveRecord(null);
                }
                //Ext.example.msg(operation.action, operation.resultSet.message);
            }
        }
    });

    var main = Ext.create('Ext.container.Container', {
        padding: '0 0 0 20',
        width: 970,
        height: Ext.themeName === 'neptune' ? 1200 : 1150,
        renderTo: 'binding-example',
        //renderTo: document.body,
        layout: {
            type: 'vbox',
            align: 'stretch'
        },
        items: [{
            itemId: 'form',
            xtype: 'writerform',
            manageHeight: false,
            margins: '0 0 10 0',
            listeners: {
                create: function(form, data) {
                    store.insert(0, data);
                }
            }
        }, {
            itemId: 'grid',
            xtype: 'writergrid',
            title: 'Quaterly data',
            flex: 1,
            store: store,
            listeners: {
                selectionchange: function(selModel, selected) {
                    main.child('#form').setActiveRecord(selected[0] || null);
                }
            }
        }]
    });
});