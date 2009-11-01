<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: stok View
	+ Description	: For record view
	+ Filename 		: v_stok.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 14/Jul/2009 15:33:36
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<style type="text/css">
        p { width:650px; }
		.search-item {
			font:normal 11px tahoma, arial, helvetica, sans-serif;
			padding:3px 10px 3px 10px;
			border:1px solid #fff;
			border-bottom:1px solid #eeeeee;
			white-space:normal;
			color:#555;
		}
		.search-item h3 {
			display:block;
			font:inherit;
			font-weight:bold;
			color:#222;
		}
		
		.search-item h3 span {
			float: right;
			font-weight:normal;
			margin:0 0 5px 5px;
			width:100px;
			display:block;
			clear:none;
		}
    </style>
<script>
/* declare function */		
var stok_DataStore;
var stok_ColumnModel;
var stokListEditorGrid;
var stok_createForm;
var stok_createWindow;
var stok_searchForm;
var stok_searchWindow;
var stok_SelectedRow;
var stok_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var stok_idField;
var stok_produkField;
var stok_gudangField;
var stok_jumlahField;
var stok_date_updateField;
var stok_idSearchField;
var stok_produkSearchField;
var stok_gudangSearchField;
var stok_jumlahSearchField;
var stok_date_updateSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function stok_update(oGrid_event){
	var stok_id_update_pk="";
	var stok_produk_update=null;
	var stok_gudang_update=null;
	var stok_jumlah_update=null;
	var stok_date_update_update_date="";

	stok_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.stok_produk!== null){stok_produk_update = oGrid_event.record.data.stok_produk;}
	if(oGrid_event.record.data.stok_gudang!== null){stok_gudang_update = oGrid_event.record.data.stok_gudang;}
	if(oGrid_event.record.data.stok_jumlah!== null){stok_jumlah_update = oGrid_event.record.data.stok_jumlah;}
	 if(oGrid_event.record.data.stok_date_update!== ""){stok_date_update_update_date = oGrid_event.record.data.stok_date_update.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_stok&m=get_action',
			params: {
				task: "UPDATE",
				stok_id	: get_pk_id(),				stok_produk	:stok_produk_update,		
				stok_gudang	:stok_gudang_update,		
				stok_jumlah	:stok_jumlah_update,		
				stok_date_update	: stok_date_update_update_date			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						stok_DataStore.commitChanges();
						stok_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the stok.',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
						});
						break;
				}
			},
			failure: function(response){
				var result=response.responseText;
				Ext.MessageBox.show({
							   title: 'Error',
							   msg: 'Could not connect to the database. retry later.',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'database',
							   icon: Ext.MessageBox.ERROR
				});	
			}									    
		});   
	}
  	/* End of Function */
  
  	/* Function for add data, open window create form */
	function stok_create(){
		if(is_stok_form_valid()){
		
		var stok_id_create_pk=null;
		var stok_produk_create=null;
		var stok_gudang_create=null;
		var stok_jumlah_create=null;
		var stok_date_update_create_date="";

		stok_id_create_pk=get_pk_id();
		if(stok_produkField.getValue()!== null){stok_produk_create = stok_produkField.getValue();}
		if(stok_gudangField.getValue()!== null){stok_gudang_create = stok_gudangField.getValue();}
		if(stok_jumlahField.getValue()!== null){stok_jumlah_create = stok_jumlahField.getValue();}
		if(stok_date_updateField.getValue()!== ""){stok_date_update_create_date = stok_date_updateField.getValue().format('Y-m-d');}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_stok&m=get_action',
				params: {
					task: post2db,
					stok_id	: stok_id_create_pk,	
					stok_produk	: stok_produk_create,	
					stok_gudang	: stok_gudang_create,	
					stok_jumlah	: stok_jumlah_create,	
					stok_date_update	: stok_date_update_create_date				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Stok was '+msg+' successfully.');
							stok_DataStore.reload();
							stok_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Stok.',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
							});
						break;
					}        
				},
				failure: function(response){
					var result=response.responseText;
					Ext.MessageBox.show({
								   title: 'Error',
								   msg: 'Could not connect to the database. retry later.',
								   buttons: Ext.MessageBox.OK,
								   animEl: 'database',
								   icon: Ext.MessageBox.ERROR
					});	
				}                      
			});
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Your Form is not valid!.',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
 	/* End of Function */
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='UPDATE')
			return stokListEditorGrid.getSelectionModel().getSelected().get('stok_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function stok_reset_form(){
		stok_produkField.reset();
		stok_gudangField.reset();
		stok_jumlahField.reset();
		stok_date_updateField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function stok_set_form(){
		stok_produkField.setValue(stokListEditorGrid.getSelectionModel().getSelected().get('stok_produk'));
		stok_gudangField.setValue(stokListEditorGrid.getSelectionModel().getSelected().get('stok_gudang'));
		stok_jumlahField.setValue(stokListEditorGrid.getSelectionModel().getSelected().get('stok_jumlah'));
		stok_date_updateField.setValue(stokListEditorGrid.getSelectionModel().getSelected().get('stok_date_update'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_stok_form_valid(){
		return (true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!stok_createWindow.isVisible()){
			stok_reset_form();
			post2db='CREATE';
			msg='created';
			stok_createWindow.show();
		} else {
			stok_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function stok_confirm_delete(){
		// only one stok is selected here
		if(stokListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', stok_delete);
		} else if(stokListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', stok_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'You can\'t really delete something you haven\'t selected?',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
	/* Function for Update Confirm */
	function stok_confirm_update(){
		/* only one record is selected here */
		if(stokListEditorGrid.selModel.getCount() == 1) {
			stok_set_form();
			post2db='UPDATE';
			msg='updated';
			stok_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'You can\'t really update something you haven\'t selected?',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function stok_delete(btn){
		if(btn=='yes'){
			var selections = stokListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< stokListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.stok_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_stok&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							stok_DataStore.reload();
							break;
						default:
							Ext.MessageBox.show({
								title: 'Warning',
								msg: 'Could not delete the entire selection',
								buttons: Ext.MessageBox.OK,
								animEl: 'save',
								icon: Ext.MessageBox.WARNING
							});
							break;
					}
				},
				failure: function(response){
					var result=response.responseText;
					Ext.MessageBox.show({
					   title: 'Error',
					   msg: 'Could not connect to the database. retry later.',
					   buttons: Ext.MessageBox.OK,
					   animEl: 'database',
					   icon: Ext.MessageBox.ERROR
					});	
				}
			});
		}  
	}
  	/* End of Function */
  
	/* Function for Retrieve DataStore */
	stok_DataStore = new Ext.data.Store({
		id: 'stok_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_stok&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'stok_id'
		},[
		/* dataIndex => insert intostok_ColumnModel, Mapping => for initiate table column */ 
			{name: 'stok_id', type: 'int', mapping: 'stok_id'},
			{name: 'stok_produk', type: 'int', mapping: 'stok_produk'},
			{name: 'stok_gudang', type: 'int', mapping: 'stok_gudang'},
			{name: 'stok_jumlah', type: 'float', mapping: 'stok_jumlah'},
			{name: 'stok_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'stok_date_update'}
		]),
		sortInfo:{field: 'stok_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	stok_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'stok_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Stok Produk',
			dataIndex: 'stok_produk',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'Stok Gudang',
			dataIndex: 'stok_gudang',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'Stok Jumlah',
			dataIndex: 'stok_jumlah',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 12,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'Stok Date Update',
			dataIndex: 'stok_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}]
	);
	stok_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	stokListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'stokListEditorGrid',
		el: 'fp_stok',
		title: 'List Of Stok',
		autoHeight: true,
		store: stok_DataStore, // DataStore
		cm: stok_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: stok_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: display_form_window
		}, '-',{
			text: 'Edit',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: stok_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: stok_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: stok_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: stok_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: stok_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: stok_print  
		}
		]
	});
	stokListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	stok_ContextMenu = new Ext.menu.Menu({
		id: 'stok_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: stok_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: stok_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: stok_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: stok_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onstok_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		stok_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		stok_SelectedRow=rowIndex;
		stok_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function stok_editContextMenu(){
      stokListEditorGrid.startEditing(stok_SelectedRow,1);
  	}
	/* End of Function */
  	
	stokListEditorGrid.addListener('rowcontextmenu', onstok_ListEditGridContextMenu);
	stok_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	stokListEditorGrid.on('afteredit', stok_update); // inLine Editing Record
	
	/* Identify  stok_produk Field */
	stok_produkField= new Ext.form.NumberField({
		id: 'stok_produkField',
		fieldLabel: 'Stok Produk',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  stok_gudang Field */
	stok_gudangField= new Ext.form.NumberField({
		id: 'stok_gudangField',
		fieldLabel: 'Stok Gudang',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  stok_jumlah Field */
	stok_jumlahField= new Ext.form.NumberField({
		id: 'stok_jumlahField',
		fieldLabel: 'Stok Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  stok_date_update Field */
	stok_date_updateField= new Ext.form.DateField({
		id: 'stok_date_updateField',
		fieldLabel: 'Stok Date Update',
		format : 'Y-m-d',
	});
  	
	/* Function for retrieve create Window Panel*/ 
	stok_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 300,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [stok_produkField, stok_gudangField, stok_jumlahField, stok_date_updateField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: stok_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					stok_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	stok_createWindow= new Ext.Window({
		id: 'stok_createWindow',
		title: post2db+'Stok',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_stok_create',
		items: stok_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function stok_list_search(){
		// render according to a SQL date format.
		var stok_id_search=null;
		var stok_produk_search=null;
		var stok_gudang_search=null;
		var stok_jumlah_search=null;
		var stok_date_update_search_date="";

		if(stok_idSearchField.getValue()!==null){stok_id_search=stok_idSearchField.getValue();}
		if(stok_produkSearchField.getValue()!==null){stok_produk_search=stok_produkSearchField.getValue();}
		if(stok_gudangSearchField.getValue()!==null){stok_gudang_search=stok_gudangSearchField.getValue();}
		if(stok_jumlahSearchField.getValue()!==null){stok_jumlah_search=stok_jumlahSearchField.getValue();}
		if(stok_date_updateSearchField.getValue()!==""){stok_date_update_search_date=stok_date_updateSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		stok_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			stok_id	:	stok_id_search, 
			stok_produk	:	stok_produk_search, 
			stok_gudang	:	stok_gudang_search, 
			stok_jumlah	:	stok_jumlah_search, 
			stok_date_update	:	stok_date_update_search_date 
};
		// Cause the datastore to do another query : 
		stok_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function stok_reset_search(){
		// reset the store parameters
		stok_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		stok_DataStore.reload({params: {start: 0, limit: pageS}});
		stok_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  stok_id Search Field */
	stok_idSearchField= new Ext.form.NumberField({
		id: 'stok_idSearchField',
		fieldLabel: 'Stok Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  stok_produk Search Field */
	stok_produkSearchField= new Ext.form.NumberField({
		id: 'stok_produkSearchField',
		fieldLabel: 'Stok Produk',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  stok_gudang Search Field */
	stok_gudangSearchField= new Ext.form.NumberField({
		id: 'stok_gudangSearchField',
		fieldLabel: 'Stok Gudang',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  stok_jumlah Search Field */
	stok_jumlahSearchField= new Ext.form.NumberField({
		id: 'stok_jumlahSearchField',
		fieldLabel: 'Stok Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  stok_date_update Search Field */
	stok_date_updateSearchField= new Ext.form.DateField({
		id: 'stok_date_updateSearchField',
		fieldLabel: 'Stok Date Update',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	stok_searchForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 300,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [stok_produkSearchField, stok_gudangSearchField, stok_jumlahSearchField, stok_date_updateSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: stok_list_search
			},{
				text: 'Close',
				handler: function(){
					stok_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	stok_searchWindow = new Ext.Window({
		title: 'stok Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_stok_search',
		items: stok_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!stok_searchWindow.isVisible()){
			stok_searchWindow.show();
		} else {
			stok_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function stok_print(){
		var searchquery = "";
		var stok_produk_print=null;
		var stok_gudang_print=null;
		var stok_jumlah_print=null;
		var stok_date_update_print_date="";
		var win;              
		// check if we do have some search data...
		if(stok_DataStore.baseParams.query!==null){searchquery = stok_DataStore.baseParams.query;}
		if(stok_DataStore.baseParams.stok_produk!==null){stok_produk_print = stok_DataStore.baseParams.stok_produk;}
		if(stok_DataStore.baseParams.stok_gudang!==null){stok_gudang_print = stok_DataStore.baseParams.stok_gudang;}
		if(stok_DataStore.baseParams.stok_jumlah!==null){stok_jumlah_print = stok_DataStore.baseParams.stok_jumlah;}
		if(stok_DataStore.baseParams.stok_date_update!==""){stok_date_update_print_date = stok_DataStore.baseParams.stok_date_update;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_stok&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			stok_produk : stok_produk_print,
			stok_gudang : stok_gudang_print,
			stok_jumlah : stok_jumlah_print,
		  	stok_date_update : stok_date_update_print_date, 
		  	currentlisting: stok_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./stoklist.html','stoklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
				win.print();
				break;
		  	default:
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Unable to print the grid!',
					buttons: Ext.MessageBox.OK,
					animEl: 'save',
					icon: Ext.MessageBox.WARNING
				});
				break;
		  	}  
		},
		failure: function(response){
		  	var result=response.responseText;
			Ext.MessageBox.show({
			   title: 'Error',
			   msg: 'Could not connect to the database. retry later.',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});		
		} 	                     
		});
	}
	/* Enf Function */
	
	/* Function for print Export to Excel Grid */
	function stok_export_excel(){
		var searchquery = "";
		var stok_produk_2excel=null;
		var stok_gudang_2excel=null;
		var stok_jumlah_2excel=null;
		var stok_date_update_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(stok_DataStore.baseParams.query!==null){searchquery = stok_DataStore.baseParams.query;}
		if(stok_DataStore.baseParams.stok_produk!==null){stok_produk_2excel = stok_DataStore.baseParams.stok_produk;}
		if(stok_DataStore.baseParams.stok_gudang!==null){stok_gudang_2excel = stok_DataStore.baseParams.stok_gudang;}
		if(stok_DataStore.baseParams.stok_jumlah!==null){stok_jumlah_2excel = stok_DataStore.baseParams.stok_jumlah;}
		if(stok_DataStore.baseParams.stok_date_update!==""){stok_date_update_2excel_date = stok_DataStore.baseParams.stok_date_update;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_stok&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			stok_produk : stok_produk_2excel,
			stok_gudang : stok_gudang_2excel,
			stok_jumlah : stok_jumlah_2excel,
		  	stok_date_update : stok_date_update_2excel_date, 
		  	currentlisting: stok_DataStore.baseParams.task // this tells us if we are searching or not
		},
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.location=('./export2excel.php');
				break;
		  	default:
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Unable to convert excel the grid!',
					buttons: Ext.MessageBox.OK,
					animEl: 'save',
					icon: Ext.MessageBox.WARNING
				});
				break;
		  	}  
		},
		failure: function(response){
		  	var result=response.responseText;
			Ext.MessageBox.show({
			   title: 'Error',
			   msg: 'Could not connect to the database. retry later.',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});    
		} 	                     
		});
	}
	/*End of Function */
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_stok"></div>
		<div id="elwindow_stok_create"></div>
        <div id="elwindow_stok_search"></div>
    </div>
</div>
</body>