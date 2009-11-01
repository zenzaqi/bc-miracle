<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_tukar_voucher View
	+ Description	: For record view
	+ Filename 		: v_master_tukar_voucher.php
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
var master_tukar_voucher_DataStore;
var master_tukar_voucher_ColumnModel;
var master_tukar_voucherListEditorGrid;
var master_tukar_voucher_createForm;
var master_tukar_voucher_createWindow;
var master_tukar_voucher_searchForm;
var master_tukar_voucher_searchWindow;
var master_tukar_voucher_SelectedRow;
var master_tukar_voucher_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var avoucher_idField;
var avoucher_custField;
var avoucher_tanggalField;
var avoucher_kasirField;
var avoucher_novoucherField;
var avoucher_idSearchField;
var avoucher_custSearchField;
var avoucher_tanggalSearchField;
var avoucher_kasirSearchField;
var avoucher_novoucherSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_tukar_voucher_update(oGrid_event){
	var avoucher_id_update_pk="";
	var avoucher_cust_update=null;
	var avoucher_tanggal_update_date="";
	var avoucher_kasir_update=null;
	var avoucher_novoucher_update=null;

	avoucher_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.avoucher_cust!== null){avoucher_cust_update = oGrid_event.record.data.avoucher_cust;}
	 if(oGrid_event.record.data.avoucher_tanggal!== ""){avoucher_tanggal_update_date = oGrid_event.record.data.avoucher_tanggal.format('Y-m-d');}
	if(oGrid_event.record.data.avoucher_kasir!== null){avoucher_kasir_update = oGrid_event.record.data.avoucher_kasir;}
	if(oGrid_event.record.data.avoucher_novoucher!== null){avoucher_novoucher_update = oGrid_event.record.data.avoucher_novoucher;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_tukar_voucher&m=get_action',
			params: {
				task: "UPDATE",
				avoucher_id	: get_pk_id(),				avoucher_cust	:avoucher_cust_update,		
				avoucher_tanggal	: avoucher_tanggal_update_date,				avoucher_kasir	:avoucher_kasir_update,		
				avoucher_novoucher	:avoucher_novoucher_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_tukar_voucher_DataStore.commitChanges();
						master_tukar_voucher_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the master_tukar_voucher.',
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
	function master_tukar_voucher_create(){
		if(is_master_tukar_voucher_form_valid()){
		
		var avoucher_id_create_pk=null;
		var avoucher_cust_create=null;
		var avoucher_tanggal_create_date="";
		var avoucher_kasir_create=null;
		var avoucher_novoucher_create=null;

		avoucher_id_create_pk=get_pk_id();
		if(avoucher_custField.getValue()!== null){avoucher_cust_create = avoucher_custField.getValue();}
		if(avoucher_tanggalField.getValue()!== ""){avoucher_tanggal_create_date = avoucher_tanggalField.getValue().format('Y-m-d');}
		if(avoucher_kasirField.getValue()!== null){avoucher_kasir_create = avoucher_kasirField.getValue();}
		if(avoucher_novoucherField.getValue()!== null){avoucher_novoucher_create = avoucher_novoucherField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_tukar_voucher&m=get_action',
				params: {
					task: post2db,
					avoucher_id	: avoucher_id_create_pk,	
					avoucher_cust	: avoucher_cust_create,	
					avoucher_tanggal	: avoucher_tanggal_create_date,					avoucher_kasir	: avoucher_kasir_create,	
					avoucher_novoucher	: avoucher_novoucher_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Master_tukar_voucher was '+msg+' successfully.');
							master_tukar_voucher_DataStore.reload();
							master_tukar_voucher_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Master_tukar_voucher.',
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
			return master_tukar_voucherListEditorGrid.getSelectionModel().getSelected().get('avoucher_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_tukar_voucher_reset_form(){
		avoucher_custField.reset();
		avoucher_tanggalField.reset();
		avoucher_kasirField.reset();
		avoucher_novoucherField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_tukar_voucher_set_form(){
		avoucher_custField.setValue(master_tukar_voucherListEditorGrid.getSelectionModel().getSelected().get('avoucher_cust'));
		avoucher_tanggalField.setValue(master_tukar_voucherListEditorGrid.getSelectionModel().getSelected().get('avoucher_tanggal'));
		avoucher_kasirField.setValue(master_tukar_voucherListEditorGrid.getSelectionModel().getSelected().get('avoucher_kasir'));
		avoucher_novoucherField.setValue(master_tukar_voucherListEditorGrid.getSelectionModel().getSelected().get('avoucher_novoucher'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_tukar_voucher_form_valid(){
		return (true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_tukar_voucher_createWindow.isVisible()){
			master_tukar_voucher_reset_form();
			post2db='CREATE';
			msg='created';
			master_tukar_voucher_createWindow.show();
		} else {
			master_tukar_voucher_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_tukar_voucher_confirm_delete(){
		// only one master_tukar_voucher is selected here
		if(master_tukar_voucherListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_tukar_voucher_delete);
		} else if(master_tukar_voucherListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_tukar_voucher_delete);
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
	function master_tukar_voucher_confirm_update(){
		/* only one record is selected here */
		if(master_tukar_voucherListEditorGrid.selModel.getCount() == 1) {
			master_tukar_voucher_set_form();
			post2db='UPDATE';
			msg='updated';
			master_tukar_voucher_createWindow.show();
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
	function master_tukar_voucher_delete(btn){
		if(btn=='yes'){
			var selections = master_tukar_voucherListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_tukar_voucherListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.avoucher_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_tukar_voucher&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_tukar_voucher_DataStore.reload();
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
	master_tukar_voucher_DataStore = new Ext.data.Store({
		id: 'master_tukar_voucher_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_tukar_voucher&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'avoucher_id'
		},[
		/* dataIndex => insert intomaster_tukar_voucher_ColumnModel, Mapping => for initiate table column */ 
			{name: 'avoucher_id', type: 'int', mapping: 'avoucher_id'},
			{name: 'avoucher_cust', type: 'int', mapping: 'avoucher_cust'},
			{name: 'avoucher_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'avoucher_tanggal'},
			{name: 'avoucher_kasir', type: 'int', mapping: 'avoucher_kasir'},
			{name: 'avoucher_novoucher', type: 'string', mapping: 'avoucher_novoucher'}
		]),
		sortInfo:{field: 'avoucher_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	master_tukar_voucher_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'avoucher_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Avoucher Cust',
			dataIndex: 'avoucher_cust',
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
			header: 'Avoucher Tanggal',
			dataIndex: 'avoucher_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Avoucher Kasir',
			dataIndex: 'avoucher_kasir',
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
			header: 'Avoucher Novoucher',
			dataIndex: 'avoucher_novoucher',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}]
	);
	master_tukar_voucher_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_tukar_voucherListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'master_tukar_voucherListEditorGrid',
		el: 'fp_master_tukar_voucher',
		title: 'List Of Master_tukar_voucher',
		autoHeight: true,
		store: master_tukar_voucher_DataStore, // DataStore
		cm: master_tukar_voucher_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_tukar_voucher_DataStore,
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
			handler: master_tukar_voucher_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_tukar_voucher_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_tukar_voucher_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_tukar_voucher_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_tukar_voucher_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_tukar_voucher_print  
		}
		]
	});
	master_tukar_voucherListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_tukar_voucher_ContextMenu = new Ext.menu.Menu({
		id: 'master_tukar_voucher_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_tukar_voucher_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_tukar_voucher_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_tukar_voucher_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_tukar_voucher_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_tukar_voucher_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_tukar_voucher_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_tukar_voucher_SelectedRow=rowIndex;
		master_tukar_voucher_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_tukar_voucher_editContextMenu(){
      master_tukar_voucherListEditorGrid.startEditing(master_tukar_voucher_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_tukar_voucherListEditorGrid.addListener('rowcontextmenu', onmaster_tukar_voucher_ListEditGridContextMenu);
	master_tukar_voucher_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_tukar_voucherListEditorGrid.on('afteredit', master_tukar_voucher_update); // inLine Editing Record
	
	/* Identify  avoucher_cust Field */
	avoucher_custField= new Ext.form.NumberField({
		id: 'avoucher_custField',
		fieldLabel: 'Avoucher Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  avoucher_tanggal Field */
	avoucher_tanggalField= new Ext.form.DateField({
		id: 'avoucher_tanggalField',
		fieldLabel: 'Avoucher Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  avoucher_kasir Field */
	avoucher_kasirField= new Ext.form.NumberField({
		id: 'avoucher_kasirField',
		fieldLabel: 'Avoucher Kasir',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  avoucher_novoucher Field */
	avoucher_novoucherField= new Ext.form.TextField({
		id: 'avoucher_novoucherField',
		fieldLabel: 'Avoucher Novoucher',
		maxLength: 50,
		anchor: '95%'
	});
  	
	/* Function for retrieve create Window Panel*/ 
	master_tukar_voucher_createForm = new Ext.FormPanel({
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
				items: [avoucher_custField, avoucher_tanggalField, avoucher_kasirField, avoucher_novoucherField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_tukar_voucher_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_tukar_voucher_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_tukar_voucher_createWindow= new Ext.Window({
		id: 'master_tukar_voucher_createWindow',
		title: post2db+'Master_tukar_voucher',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_tukar_voucher_create',
		items: master_tukar_voucher_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function master_tukar_voucher_list_search(){
		// render according to a SQL date format.
		var avoucher_id_search=null;
		var avoucher_cust_search=null;
		var avoucher_tanggal_search_date="";
		var avoucher_kasir_search=null;
		var avoucher_novoucher_search=null;

		if(avoucher_idSearchField.getValue()!==null){avoucher_id_search=avoucher_idSearchField.getValue();}
		if(avoucher_custSearchField.getValue()!==null){avoucher_cust_search=avoucher_custSearchField.getValue();}
		if(avoucher_tanggalSearchField.getValue()!==""){avoucher_tanggal_search_date=avoucher_tanggalSearchField.getValue().format('Y-m-d');}
		if(avoucher_kasirSearchField.getValue()!==null){avoucher_kasir_search=avoucher_kasirSearchField.getValue();}
		if(avoucher_novoucherSearchField.getValue()!==null){avoucher_novoucher_search=avoucher_novoucherSearchField.getValue();}
		// change the store parameters
		master_tukar_voucher_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			avoucher_id	:	avoucher_id_search, 
			avoucher_cust	:	avoucher_cust_search, 
			avoucher_tanggal	:	avoucher_tanggal_search_date, 
			avoucher_kasir	:	avoucher_kasir_search, 
			avoucher_novoucher	:	avoucher_novoucher_search 
};
		// Cause the datastore to do another query : 
		master_tukar_voucher_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_tukar_voucher_reset_search(){
		// reset the store parameters
		master_tukar_voucher_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_tukar_voucher_DataStore.reload({params: {start: 0, limit: pageS}});
		master_tukar_voucher_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  avoucher_id Search Field */
	avoucher_idSearchField= new Ext.form.NumberField({
		id: 'avoucher_idSearchField',
		fieldLabel: 'Avoucher Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  avoucher_cust Search Field */
	avoucher_custSearchField= new Ext.form.NumberField({
		id: 'avoucher_custSearchField',
		fieldLabel: 'Avoucher Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  avoucher_tanggal Search Field */
	avoucher_tanggalSearchField= new Ext.form.DateField({
		id: 'avoucher_tanggalSearchField',
		fieldLabel: 'Avoucher Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  avoucher_kasir Search Field */
	avoucher_kasirSearchField= new Ext.form.NumberField({
		id: 'avoucher_kasirSearchField',
		fieldLabel: 'Avoucher Kasir',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  avoucher_novoucher Search Field */
	avoucher_novoucherSearchField= new Ext.form.TextField({
		id: 'avoucher_novoucherSearchField',
		fieldLabel: 'Avoucher Novoucher',
		maxLength: 50,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_tukar_voucher_searchForm = new Ext.FormPanel({
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
				items: [avoucher_custSearchField, avoucher_tanggalSearchField, avoucher_kasirSearchField, avoucher_novoucherSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_tukar_voucher_list_search
			},{
				text: 'Close',
				handler: function(){
					master_tukar_voucher_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_tukar_voucher_searchWindow = new Ext.Window({
		title: 'master_tukar_voucher Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_tukar_voucher_search',
		items: master_tukar_voucher_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_tukar_voucher_searchWindow.isVisible()){
			master_tukar_voucher_searchWindow.show();
		} else {
			master_tukar_voucher_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_tukar_voucher_print(){
		var searchquery = "";
		var avoucher_cust_print=null;
		var avoucher_tanggal_print_date="";
		var avoucher_kasir_print=null;
		var avoucher_novoucher_print=null;
		var win;              
		// check if we do have some search data...
		if(master_tukar_voucher_DataStore.baseParams.query!==null){searchquery = master_tukar_voucher_DataStore.baseParams.query;}
		if(master_tukar_voucher_DataStore.baseParams.avoucher_cust!==null){avoucher_cust_print = master_tukar_voucher_DataStore.baseParams.avoucher_cust;}
		if(master_tukar_voucher_DataStore.baseParams.avoucher_tanggal!==""){avoucher_tanggal_print_date = master_tukar_voucher_DataStore.baseParams.avoucher_tanggal;}
		if(master_tukar_voucher_DataStore.baseParams.avoucher_kasir!==null){avoucher_kasir_print = master_tukar_voucher_DataStore.baseParams.avoucher_kasir;}
		if(master_tukar_voucher_DataStore.baseParams.avoucher_novoucher!==null){avoucher_novoucher_print = master_tukar_voucher_DataStore.baseParams.avoucher_novoucher;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_tukar_voucher&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			avoucher_cust : avoucher_cust_print,
		  	avoucher_tanggal : avoucher_tanggal_print_date, 
			avoucher_kasir : avoucher_kasir_print,
			avoucher_novoucher : avoucher_novoucher_print,
		  	currentlisting: master_tukar_voucher_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_tukar_voucherlist.html','master_tukar_voucherlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_tukar_voucher_export_excel(){
		var searchquery = "";
		var avoucher_cust_2excel=null;
		var avoucher_tanggal_2excel_date="";
		var avoucher_kasir_2excel=null;
		var avoucher_novoucher_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_tukar_voucher_DataStore.baseParams.query!==null){searchquery = master_tukar_voucher_DataStore.baseParams.query;}
		if(master_tukar_voucher_DataStore.baseParams.avoucher_cust!==null){avoucher_cust_2excel = master_tukar_voucher_DataStore.baseParams.avoucher_cust;}
		if(master_tukar_voucher_DataStore.baseParams.avoucher_tanggal!==""){avoucher_tanggal_2excel_date = master_tukar_voucher_DataStore.baseParams.avoucher_tanggal;}
		if(master_tukar_voucher_DataStore.baseParams.avoucher_kasir!==null){avoucher_kasir_2excel = master_tukar_voucher_DataStore.baseParams.avoucher_kasir;}
		if(master_tukar_voucher_DataStore.baseParams.avoucher_novoucher!==null){avoucher_novoucher_2excel = master_tukar_voucher_DataStore.baseParams.avoucher_novoucher;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_tukar_voucher&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			avoucher_cust : avoucher_cust_2excel,
		  	avoucher_tanggal : avoucher_tanggal_2excel_date, 
			avoucher_kasir : avoucher_kasir_2excel,
			avoucher_novoucher : avoucher_novoucher_2excel,
		  	currentlisting: master_tukar_voucher_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_tukar_voucher"></div>
		<div id="elwindow_master_tukar_voucher_create"></div>
        <div id="elwindow_master_tukar_voucher_search"></div>
    </div>
</div>
</body>