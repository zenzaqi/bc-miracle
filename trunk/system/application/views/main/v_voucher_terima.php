<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: voucher_terima View
	+ Description	: For record view
	+ Filename 		: v_voucher_terima.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:52
	
*/
?>
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
var voucher_terima_DataStore;
var voucher_terima_ColumnModel;
var voucher_terimaListEditorGrid;
var voucher_terima_createForm;
var voucher_terima_createWindow;
var voucher_terima_searchForm;
var voucher_terima_searchWindow;
var voucher_terima_SelectedRow;
var voucher_terima_ContextMenu;
//for detail data
var _DataStor;
var ListEditorGrid;
var _ColumnModel;
var _proxy;
var _writer;
var _reader;
var editor_;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var tvoucher_idField;
var tvoucher_custField;
var tvoucher_voucherField;
var tvoucher_idSearchField;
var tvoucher_custSearchField;
var tvoucher_voucherSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function voucher_terima_update(oGrid_event){
		var tvoucher_id_update_pk="";
		var tvoucher_cust_update=null;
		var tvoucher_voucher_update=null;

		tvoucher_id_update_pk = oGrid_event.record.data.tvoucher_id;
		if(oGrid_event.record.data.tvoucher_cust!== null){tvoucher_cust_update = oGrid_event.record.data.tvoucher_cust;}
		if(oGrid_event.record.data.tvoucher_voucher!== null){tvoucher_voucher_update = oGrid_event.record.data.tvoucher_voucher;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_voucher_terima&m=get_action',
			params: {
				task: "UPDATE",
				tvoucher_id	: tvoucher_id_update_pk, 
				tvoucher_cust	:tvoucher_cust_update,  
				tvoucher_voucher	:tvoucher_voucher_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						voucher_terima_DataStore.commitChanges();
						voucher_terima_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the voucher_terima.',
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
	function voucher_terima_create(){
	
		if(is_voucher_terima_form_valid()){	
		var tvoucher_id_create_pk=null; 
		var tvoucher_cust_create=null; 
		var tvoucher_voucher_create=null; 

		if(tvoucher_idField.getValue()!== null){tvoucher_id_create = tvoucher_idField.getValue();}else{tvoucher_id_create_pk=get_pk_id();} 
		if(tvoucher_custField.getValue()!== null){tvoucher_cust_create = tvoucher_custField.getValue();} 
		if(tvoucher_voucherField.getValue()!== null){tvoucher_voucher_create = tvoucher_voucherField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_voucher_terima&m=get_action',
			params: {
				task: post2db,
				tvoucher_id	: tvoucher_id_create_pk, 
				tvoucher_cust	: tvoucher_cust_create, 
				tvoucher_voucher	: tvoucher_voucher_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						Ext.MessageBox.alert(post2db+' OK','The Voucher_terima was '+msg+' successfully.');
						voucher_terima_DataStore.reload();
						voucher_terima_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Voucher_terima.',
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
			return voucher_terimaListEditorGrid.getSelectionModel().getSelected().get('tvoucher_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function voucher_terima_reset_form(){
		tvoucher_idField.reset();
		tvoucher_idField.setValue(null);
		tvoucher_custField.reset();
		tvoucher_custField.setValue(null);
		tvoucher_voucherField.reset();
		tvoucher_voucherField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function voucher_terima_set_form(){
		tvoucher_idField.setValue(voucher_terimaListEditorGrid.getSelectionModel().getSelected().get('tvoucher_id'));
		tvoucher_custField.setValue(voucher_terimaListEditorGrid.getSelectionModel().getSelected().get('tvoucher_cust'));
		tvoucher_voucherField.setValue(voucher_terimaListEditorGrid.getSelectionModel().getSelected().get('tvoucher_voucher'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_voucher_terima_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!voucher_terima_createWindow.isVisible()){
			voucher_terima_reset_form();
			post2db='CREATE';
			msg='created';
			voucher_terima_createWindow.show();
		} else {
			voucher_terima_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function voucher_terima_confirm_delete(){
		// only one voucher_terima is selected here
		if(voucher_terimaListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', voucher_terima_delete);
		} else if(voucher_terimaListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', voucher_terima_delete);
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
	function voucher_terima_confirm_update(){
		/* only one record is selected here */
		if(voucher_terimaListEditorGrid.selModel.getCount() == 1) {
			voucher_terima_set_form();
			post2db='UPDATE';
			msg='updated';
			voucher_terima_createWindow.show();
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
	function voucher_terima_delete(btn){
		if(btn=='yes'){
			var selections = voucher_terimaListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< voucher_terimaListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.tvoucher_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_voucher_terima&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							voucher_terima_DataStore.reload();
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
	voucher_terima_DataStore = new Ext.data.Store({
		id: 'voucher_terima_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_voucher_terima&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'tvoucher_id'
		},[
		/* dataIndex => insert intovoucher_terima_ColumnModel, Mapping => for initiate table column */ 
			{name: 'tvoucher_id', type: 'int', mapping: 'tvoucher_id'}, 
			{name: 'tvoucher_cust', type: 'int', mapping: 'tvoucher_cust'}, 
			{name: 'tvoucher_voucher', type: 'int', mapping: 'tvoucher_voucher'}, 
			{name: 'tvoucher_creator', type: 'string', mapping: 'tvoucher_creator'}, 
			{name: 'tvoucher_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'tvoucher_date_create'}, 
			{name: 'tvoucher_update', type: 'string', mapping: 'tvoucher_update'}, 
			{name: 'tvoucher_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'tvoucher_date_update'}, 
			{name: 'tvoucher_revised', type: 'int', mapping: 'tvoucher_revised'} 
		]),
		sortInfo:{field: 'tvoucher_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	voucher_terima_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'tvoucher_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Tvoucher Cust',
			dataIndex: 'tvoucher_cust',
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
			header: 'Tvoucher Voucher',
			dataIndex: 'tvoucher_voucher',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 50,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Tvoucher Creator',
			dataIndex: 'tvoucher_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Tvoucher Date Create',
			dataIndex: 'tvoucher_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Tvoucher Update',
			dataIndex: 'tvoucher_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Tvoucher Date Update',
			dataIndex: 'tvoucher_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Tvoucher Revised',
			dataIndex: 'tvoucher_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	voucher_terima_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	voucher_terimaListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'voucher_terimaListEditorGrid',
		el: 'fp_voucher_terima',
		title: 'List Of Voucher_terima',
		autoHeight: true,
		store: voucher_terima_DataStore, // DataStore
		cm: voucher_terima_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: voucher_terima_DataStore,
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
			handler: voucher_terima_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: voucher_terima_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: voucher_terima_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: voucher_terima_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: voucher_terima_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: voucher_terima_print  
		}
		]
	});
	voucher_terimaListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	voucher_terima_ContextMenu = new Ext.menu.Menu({
		id: 'voucher_terima_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: voucher_terima_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: voucher_terima_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: voucher_terima_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: voucher_terima_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onvoucher_terima_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		voucher_terima_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		voucher_terima_SelectedRow=rowIndex;
		voucher_terima_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function voucher_terima_editContextMenu(){
		voucher_terimaListEditorGrid.startEditing(voucher_terima_SelectedRow,1);
  	}
	/* End of Function */
  	
	voucher_terimaListEditorGrid.addListener('rowcontextmenu', onvoucher_terima_ListEditGridContextMenu);
	voucher_terima_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	voucher_terimaListEditorGrid.on('afteredit', voucher_terima_update); // inLine Editing Record
	
	/* Identify  tvoucher_id Field */
	tvoucher_idField= new Ext.form.NumberField({
		id: 'tvoucher_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  tvoucher_cust Field */
	tvoucher_custField= new Ext.form.NumberField({
		id: 'tvoucher_custField',
		fieldLabel: 'Tvoucher Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  tvoucher_voucher Field */
	tvoucher_voucherField= new Ext.form.NumberField({
		id: 'tvoucher_voucherField',
		fieldLabel: 'Tvoucher Voucher',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	
	/* Function for retrieve create Window Panel*/ 
	voucher_terima_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 300,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [tvoucher_idField, tvoucher_custField, tvoucher_voucherField] 
			}
			],
		buttons: [{
				text: 'Save and Close',
				handler: voucher_terima_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					voucher_terima_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	voucher_terima_createWindow= new Ext.Window({
		id: 'voucher_terima_createWindow',
		title: post2db+'Voucher_terima',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_voucher_terima_create',
		items: voucher_terima_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function voucher_terima_list_search(){
		// render according to a SQL date format.
		var tvoucher_id_search=null;
		var tvoucher_cust_search=null;
		var tvoucher_voucher_search=null;

		if(tvoucher_idSearchField.getValue()!==null){tvoucher_id_search=tvoucher_idSearchField.getValue();}
		if(tvoucher_custSearchField.getValue()!==null){tvoucher_cust_search=tvoucher_custSearchField.getValue();}
		if(tvoucher_voucherSearchField.getValue()!==null){tvoucher_voucher_search=tvoucher_voucherSearchField.getValue();}
		// change the store parameters
		voucher_terima_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			tvoucher_id	:	tvoucher_id_search, 
			tvoucher_cust	:	tvoucher_cust_search, 
			tvoucher_voucher	:	tvoucher_voucher_search, 
		};
		// Cause the datastore to do another query : 
		voucher_terima_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function voucher_terima_reset_search(){
		// reset the store parameters
		voucher_terima_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		voucher_terima_DataStore.reload({params: {start: 0, limit: pageS}});
		voucher_terima_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  tvoucher_id Search Field */
	tvoucher_idSearchField= new Ext.form.NumberField({
		id: 'tvoucher_idSearchField',
		fieldLabel: 'Tvoucher Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  tvoucher_cust Search Field */
	tvoucher_custSearchField= new Ext.form.NumberField({
		id: 'tvoucher_custSearchField',
		fieldLabel: 'Tvoucher Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  tvoucher_voucher Search Field */
	tvoucher_voucherSearchField= new Ext.form.NumberField({
		id: 'tvoucher_voucherSearchField',
		fieldLabel: 'Tvoucher Voucher',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	voucher_terima_searchForm = new Ext.FormPanel({
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
				items: [tvoucher_custSearchField, tvoucher_voucherSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: voucher_terima_list_search
			},{
				text: 'Close',
				handler: function(){
					voucher_terima_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	voucher_terima_searchWindow = new Ext.Window({
		title: 'voucher_terima Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_voucher_terima_search',
		items: voucher_terima_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!voucher_terima_searchWindow.isVisible()){
			voucher_terima_searchWindow.show();
		} else {
			voucher_terima_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function voucher_terima_print(){
		var searchquery = "";
		var tvoucher_cust_print=null;
		var tvoucher_voucher_print=null;
		var win;              
		// check if we do have some search data...
		if(voucher_terima_DataStore.baseParams.query!==null){searchquery = voucher_terima_DataStore.baseParams.query;}
		if(voucher_terima_DataStore.baseParams.tvoucher_cust!==null){tvoucher_cust_print = voucher_terima_DataStore.baseParams.tvoucher_cust;}
		if(voucher_terima_DataStore.baseParams.tvoucher_voucher!==null){tvoucher_voucher_print = voucher_terima_DataStore.baseParams.tvoucher_voucher;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_voucher_terima&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			tvoucher_cust : tvoucher_cust_print,
			tvoucher_voucher : tvoucher_voucher_print,
		  	currentlisting: voucher_terima_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./voucher_terimalist.html','voucher_terimalist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function voucher_terima_export_excel(){
		var searchquery = "";
		var tvoucher_cust_2excel=null;
		var tvoucher_voucher_2excel=null;
		var win;              
		// check if we do have some search data...
		if(voucher_terima_DataStore.baseParams.query!==null){searchquery = voucher_terima_DataStore.baseParams.query;}
		if(voucher_terima_DataStore.baseParams.tvoucher_cust!==null){tvoucher_cust_2excel = voucher_terima_DataStore.baseParams.tvoucher_cust;}
		if(voucher_terima_DataStore.baseParams.tvoucher_voucher!==null){tvoucher_voucher_2excel = voucher_terima_DataStore.baseParams.tvoucher_voucher;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_voucher_terima&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			tvoucher_cust : tvoucher_cust_2excel,
			tvoucher_voucher : tvoucher_voucher_2excel,
		  	currentlisting: voucher_terima_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_voucher_terima"></div>
		<div id="elwindow_voucher_terima_create"></div>
        <div id="elwindow_voucher_terima_search"></div>
    </div>
</div>
</body>