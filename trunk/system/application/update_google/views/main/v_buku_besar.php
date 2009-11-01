<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: buku_besar View
	+ Description	: For record view
	+ Filename 		: v_buku_besar.php
 	+ Author  		: 
 	+ Created on 21/Aug/2009 06:51:08
	
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
var buku_besar_DataStore;
var buku_besar_ColumnModel;
var buku_besarListEditorGrid;
var buku_besar_createForm;
var buku_besar_createWindow;
var buku_besar_searchForm;
var buku_besar_searchWindow;
var buku_besar_SelectedRow;
var buku_besar_ContextMenu;
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
var buku_idField;
var buku_tanggalField;
var buku_akunField;
var buku_debetField;
var buku_kreditField;
var buku_saldo_debetField;
var buku_saldo_kreditField;
var buku_idSearchField;
var buku_tanggalSearchField;
var buku_akunSearchField;
var buku_debetSearchField;
var buku_kreditSearchField;
var buku_saldo_debetSearchField;
var buku_saldo_kreditSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function buku_besar_update(oGrid_event){
		var buku_id_update_pk="";
		var buku_tanggal_update_date="";
		var buku_akun_update=null;
		var buku_debet_update=null;
		var buku_kredit_update=null;
		var buku_saldo_debet_update=null;
		var buku_saldo_kredit_update=null;

		buku_id_update_pk = oGrid_event.record.data.buku_id;
	 	if(oGrid_event.record.data.buku_tanggal!== ""){buku_tanggal_update_date =oGrid_event.record.data.buku_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.buku_akun!== null){buku_akun_update = oGrid_event.record.data.buku_akun;}
		if(oGrid_event.record.data.buku_debet!== null){buku_debet_update = oGrid_event.record.data.buku_debet;}
		if(oGrid_event.record.data.buku_kredit!== null){buku_kredit_update = oGrid_event.record.data.buku_kredit;}
		if(oGrid_event.record.data.buku_saldo_debet!== null){buku_saldo_debet_update = oGrid_event.record.data.buku_saldo_debet;}
		if(oGrid_event.record.data.buku_saldo_kredit!== null){buku_saldo_kredit_update = oGrid_event.record.data.buku_saldo_kredit;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_buku_besar&m=get_action',
			params: {
				task: "UPDATE",
				buku_id	: buku_id_update_pk, 
				buku_tanggal	: buku_tanggal_update_date, 
				buku_akun	:buku_akun_update,  
				buku_debet	:buku_debet_update,  
				buku_kredit	:buku_kredit_update,  
				buku_saldo_debet	:buku_saldo_debet_update,  
				buku_saldo_kredit	:buku_saldo_kredit_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						buku_besar_DataStore.commitChanges();
						buku_besar_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the buku_besar.',
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
	function buku_besar_create(){
	
		if(is_buku_besar_form_valid()){	
		var buku_id_create_pk=null; 
		var buku_tanggal_create_date=""; 
		var buku_akun_create=null; 
		var buku_debet_create=null; 
		var buku_kredit_create=null; 
		var buku_saldo_debet_create=null; 
		var buku_saldo_kredit_create=null; 

		if(buku_idField.getValue()!== null){buku_id_create = buku_idField.getValue();}else{buku_id_create_pk=get_pk_id();} 
		if(buku_tanggalField.getValue()!== ""){buku_tanggal_create_date = buku_tanggalField.getValue().format('Y-m-d');} 
		if(buku_akunField.getValue()!== null){buku_akun_create = buku_akunField.getValue();} 
		if(buku_debetField.getValue()!== null){buku_debet_create = buku_debetField.getValue();} 
		if(buku_kreditField.getValue()!== null){buku_kredit_create = buku_kreditField.getValue();} 
		if(buku_saldo_debetField.getValue()!== null){buku_saldo_debet_create = buku_saldo_debetField.getValue();} 
		if(buku_saldo_kreditField.getValue()!== null){buku_saldo_kredit_create = buku_saldo_kreditField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_buku_besar&m=get_action',
			params: {
				task: post2db,
				buku_id	: buku_id_create_pk, 
				buku_tanggal	: buku_tanggal_create_date, 
				buku_akun	: buku_akun_create, 
				buku_debet	: buku_debet_create, 
				buku_kredit	: buku_kredit_create, 
				buku_saldo_debet	: buku_saldo_debet_create, 
				buku_saldo_kredit	: buku_saldo_kredit_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						Ext.MessageBox.alert(post2db+' OK','The Buku_besar was '+msg+' successfully.');
						buku_besar_DataStore.reload();
						buku_besar_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Buku_besar.',
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
			return buku_besarListEditorGrid.getSelectionModel().getSelected().get('buku_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function buku_besar_reset_form(){
		buku_idField.reset();
		buku_idField.setValue(null);
		buku_tanggalField.reset();
		buku_tanggalField.setValue(null);
		buku_akunField.reset();
		buku_akunField.setValue(null);
		buku_debetField.reset();
		buku_debetField.setValue(null);
		buku_kreditField.reset();
		buku_kreditField.setValue(null);
		buku_saldo_debetField.reset();
		buku_saldo_debetField.setValue(null);
		buku_saldo_kreditField.reset();
		buku_saldo_kreditField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function buku_besar_set_form(){
		buku_idField.setValue(buku_besarListEditorGrid.getSelectionModel().getSelected().get('buku_id'));
		buku_tanggalField.setValue(buku_besarListEditorGrid.getSelectionModel().getSelected().get('buku_tanggal'));
		buku_akunField.setValue(buku_besarListEditorGrid.getSelectionModel().getSelected().get('buku_akun'));
		buku_debetField.setValue(buku_besarListEditorGrid.getSelectionModel().getSelected().get('buku_debet'));
		buku_kreditField.setValue(buku_besarListEditorGrid.getSelectionModel().getSelected().get('buku_kredit'));
		buku_saldo_debetField.setValue(buku_besarListEditorGrid.getSelectionModel().getSelected().get('buku_saldo_debet'));
		buku_saldo_kreditField.setValue(buku_besarListEditorGrid.getSelectionModel().getSelected().get('buku_saldo_kredit'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_buku_besar_form_valid(){
		return (true &&  buku_tanggalField.isValid() && buku_akunField.isValid() && buku_debetField.isValid() && buku_kreditField.isValid() && buku_saldo_debetField.isValid() && buku_saldo_kreditField.isValid() && true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!buku_besar_createWindow.isVisible()){
			buku_besar_reset_form();
			post2db='CREATE';
			msg='created';
			buku_besar_createWindow.show();
		} else {
			buku_besar_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function buku_besar_confirm_delete(){
		// only one buku_besar is selected here
		if(buku_besarListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', buku_besar_delete);
		} else if(buku_besarListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', buku_besar_delete);
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
	function buku_besar_confirm_update(){
		/* only one record is selected here */
		if(buku_besarListEditorGrid.selModel.getCount() == 1) {
			buku_besar_set_form();
			post2db='UPDATE';
			msg='updated';
			buku_besar_createWindow.show();
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
	function buku_besar_delete(btn){
		if(btn=='yes'){
			var selections = buku_besarListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< buku_besarListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.buku_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_buku_besar&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							buku_besar_DataStore.reload();
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
	buku_besar_DataStore = new Ext.data.Store({
		id: 'buku_besar_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_buku_besar&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'buku_id'
		},[
		/* dataIndex => insert intobuku_besar_ColumnModel, Mapping => for initiate table column */ 
			{name: 'buku_id', type: 'int', mapping: 'buku_id'}, 
			{name: 'buku_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'buku_tanggal'}, 
			{name: 'buku_akun', type: 'int', mapping: 'buku_akun'}, 
			{name: 'buku_debet', type: 'float', mapping: 'buku_debet'}, 
			{name: 'buku_kredit', type: 'float', mapping: 'buku_kredit'}, 
			{name: 'buku_saldo_debet', type: 'float', mapping: 'buku_saldo_debet'}, 
			{name: 'buku_saldo_kredit', type: 'float', mapping: 'buku_saldo_kredit'}, 
			{name: 'buku_creator', type: 'string', mapping: 'buku_creator'}, 
			{name: 'buku_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'buku_date_create'}, 
			{name: 'buku_update', type: 'string', mapping: 'buku_update'}, 
			{name: 'buku_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'buku_date_update'}, 
			{name: 'buku_revised', type: 'int', mapping: 'buku_revised'} 
		]),
		sortInfo:{field: 'buku_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	buku_besar_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'buku_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Buku Tanggal',
			dataIndex: 'buku_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Buku Akun',
			dataIndex: 'buku_akun',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Buku Debet',
			dataIndex: 'buku_debet',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Buku Kredit',
			dataIndex: 'buku_kredit',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Buku Saldo Debet',
			dataIndex: 'buku_saldo_debet',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Buku Saldo Kredit',
			dataIndex: 'buku_saldo_kredit',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Buku Creator',
			dataIndex: 'buku_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Buku Date Create',
			dataIndex: 'buku_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Buku Update',
			dataIndex: 'buku_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Buku Date Update',
			dataIndex: 'buku_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Buku Revised',
			dataIndex: 'buku_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	buku_besar_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	buku_besarListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'buku_besarListEditorGrid',
		el: 'fp_buku_besar',
		title: 'List Of Buku_besar',
		autoHeight: true,
		store: buku_besar_DataStore, // DataStore
		cm: buku_besar_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: buku_besar_DataStore,
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
			handler: buku_besar_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: buku_besar_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: buku_besar_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: buku_besar_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: buku_besar_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: buku_besar_print  
		}
		]
	});
	buku_besarListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	buku_besar_ContextMenu = new Ext.menu.Menu({
		id: 'buku_besar_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: buku_besar_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: buku_besar_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: buku_besar_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: buku_besar_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onbuku_besar_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		buku_besar_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		buku_besar_SelectedRow=rowIndex;
		buku_besar_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function buku_besar_editContextMenu(){
		buku_besarListEditorGrid.startEditing(buku_besar_SelectedRow,1);
  	}
	/* End of Function */
  	
	buku_besarListEditorGrid.addListener('rowcontextmenu', onbuku_besar_ListEditGridContextMenu);
	buku_besar_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	buku_besarListEditorGrid.on('afteredit', buku_besar_update); // inLine Editing Record
	
	/* Identify  buku_id Field */
	buku_idField= new Ext.form.NumberField({
		id: 'buku_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  buku_tanggal Field */
	buku_tanggalField= new Ext.form.DateField({
		id: 'buku_tanggalField',
		fieldLabel: 'Buku Tanggal',
		format : 'Y-m-d',
		allowBlank: false,
	});
	/* Identify  buku_akun Field */
	buku_akunField= new Ext.form.NumberField({
		id: 'buku_akunField',
		fieldLabel: 'Buku Akun',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  buku_debet Field */
	buku_debetField= new Ext.form.NumberField({
		id: 'buku_debetField',
		fieldLabel: 'Buku Debet',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  buku_kredit Field */
	buku_kreditField= new Ext.form.NumberField({
		id: 'buku_kreditField',
		fieldLabel: 'Buku Kredit',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  buku_saldo_debet Field */
	buku_saldo_debetField= new Ext.form.NumberField({
		id: 'buku_saldo_debetField',
		fieldLabel: 'Buku Saldo Debet',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  buku_saldo_kredit Field */
	buku_saldo_kreditField= new Ext.form.NumberField({
		id: 'buku_saldo_kreditField',
		fieldLabel: 'Buku Saldo Kredit',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	
	/* Function for retrieve create Window Panel*/ 
	buku_besar_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 300,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [buku_idField, buku_tanggalField, buku_akunField, buku_debetField, buku_kreditField, buku_saldo_debetField, buku_saldo_kreditField] 
			}
			],
		buttons: [{
				text: 'Save and Close',
				handler: buku_besar_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					buku_besar_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	buku_besar_createWindow= new Ext.Window({
		id: 'buku_besar_createWindow',
		title: post2db+'Buku_besar',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_buku_besar_create',
		items: buku_besar_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function buku_besar_list_search(){
		// render according to a SQL date format.
		var buku_id_search=null;
		var buku_tanggal_search_date="";
		var buku_akun_search=null;
		var buku_debet_search=null;
		var buku_kredit_search=null;
		var buku_saldo_debet_search=null;
		var buku_saldo_kredit_search=null;

		if(buku_idSearchField.getValue()!==null){buku_id_search=buku_idSearchField.getValue();}
		if(buku_tanggalSearchField.getValue()!==""){buku_tanggal_search_date=buku_tanggalSearchField.getValue().format('Y-m-d');}
		if(buku_akunSearchField.getValue()!==null){buku_akun_search=buku_akunSearchField.getValue();}
		if(buku_debetSearchField.getValue()!==null){buku_debet_search=buku_debetSearchField.getValue();}
		if(buku_kreditSearchField.getValue()!==null){buku_kredit_search=buku_kreditSearchField.getValue();}
		if(buku_saldo_debetSearchField.getValue()!==null){buku_saldo_debet_search=buku_saldo_debetSearchField.getValue();}
		if(buku_saldo_kreditSearchField.getValue()!==null){buku_saldo_kredit_search=buku_saldo_kreditSearchField.getValue();}
		// change the store parameters
		buku_besar_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			buku_id	:	buku_id_search, 
			buku_tanggal	:	buku_tanggal_search_date, 
			buku_akun	:	buku_akun_search, 
			buku_debet	:	buku_debet_search, 
			buku_kredit	:	buku_kredit_search, 
			buku_saldo_debet	:	buku_saldo_debet_search, 
			buku_saldo_kredit	:	buku_saldo_kredit_search, 
		};
		// Cause the datastore to do another query : 
		buku_besar_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function buku_besar_reset_search(){
		// reset the store parameters
		buku_besar_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		buku_besar_DataStore.reload({params: {start: 0, limit: pageS}});
		buku_besar_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  buku_id Search Field */
	buku_idSearchField= new Ext.form.NumberField({
		id: 'buku_idSearchField',
		fieldLabel: 'Buku Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  buku_tanggal Search Field */
	buku_tanggalSearchField= new Ext.form.DateField({
		id: 'buku_tanggalSearchField',
		fieldLabel: 'Buku Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  buku_akun Search Field */
	buku_akunSearchField= new Ext.form.NumberField({
		id: 'buku_akunSearchField',
		fieldLabel: 'Buku Akun',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  buku_debet Search Field */
	buku_debetSearchField= new Ext.form.NumberField({
		id: 'buku_debetSearchField',
		fieldLabel: 'Buku Debet',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  buku_kredit Search Field */
	buku_kreditSearchField= new Ext.form.NumberField({
		id: 'buku_kreditSearchField',
		fieldLabel: 'Buku Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  buku_saldo_debet Search Field */
	buku_saldo_debetSearchField= new Ext.form.NumberField({
		id: 'buku_saldo_debetSearchField',
		fieldLabel: 'Buku Saldo Debet',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  buku_saldo_kredit Search Field */
	buku_saldo_kreditSearchField= new Ext.form.NumberField({
		id: 'buku_saldo_kreditSearchField',
		fieldLabel: 'Buku Saldo Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	buku_besar_searchForm = new Ext.FormPanel({
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
				items: [buku_tanggalSearchField, buku_akunSearchField, buku_debetSearchField, buku_kreditSearchField, buku_saldo_debetSearchField, buku_saldo_kreditSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: buku_besar_list_search
			},{
				text: 'Close',
				handler: function(){
					buku_besar_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	buku_besar_searchWindow = new Ext.Window({
		title: 'buku_besar Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_buku_besar_search',
		items: buku_besar_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!buku_besar_searchWindow.isVisible()){
			buku_besar_searchWindow.show();
		} else {
			buku_besar_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function buku_besar_print(){
		var searchquery = "";
		var buku_tanggal_print_date="";
		var buku_akun_print=null;
		var buku_debet_print=null;
		var buku_kredit_print=null;
		var buku_saldo_debet_print=null;
		var buku_saldo_kredit_print=null;
		var win;              
		// check if we do have some search data...
		if(buku_besar_DataStore.baseParams.query!==null){searchquery = buku_besar_DataStore.baseParams.query;}
		if(buku_besar_DataStore.baseParams.buku_tanggal!==""){buku_tanggal_print_date = buku_besar_DataStore.baseParams.buku_tanggal;}
		if(buku_besar_DataStore.baseParams.buku_akun!==null){buku_akun_print = buku_besar_DataStore.baseParams.buku_akun;}
		if(buku_besar_DataStore.baseParams.buku_debet!==null){buku_debet_print = buku_besar_DataStore.baseParams.buku_debet;}
		if(buku_besar_DataStore.baseParams.buku_kredit!==null){buku_kredit_print = buku_besar_DataStore.baseParams.buku_kredit;}
		if(buku_besar_DataStore.baseParams.buku_saldo_debet!==null){buku_saldo_debet_print = buku_besar_DataStore.baseParams.buku_saldo_debet;}
		if(buku_besar_DataStore.baseParams.buku_saldo_kredit!==null){buku_saldo_kredit_print = buku_besar_DataStore.baseParams.buku_saldo_kredit;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_buku_besar&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	buku_tanggal : buku_tanggal_print_date, 
			buku_akun : buku_akun_print,
			buku_debet : buku_debet_print,
			buku_kredit : buku_kredit_print,
			buku_saldo_debet : buku_saldo_debet_print,
			buku_saldo_kredit : buku_saldo_kredit_print,
		  	currentlisting: buku_besar_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./buku_besarlist.html','buku_besarlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function buku_besar_export_excel(){
		var searchquery = "";
		var buku_tanggal_2excel_date="";
		var buku_akun_2excel=null;
		var buku_debet_2excel=null;
		var buku_kredit_2excel=null;
		var buku_saldo_debet_2excel=null;
		var buku_saldo_kredit_2excel=null;
		var win;              
		// check if we do have some search data...
		if(buku_besar_DataStore.baseParams.query!==null){searchquery = buku_besar_DataStore.baseParams.query;}
		if(buku_besar_DataStore.baseParams.buku_tanggal!==""){buku_tanggal_2excel_date = buku_besar_DataStore.baseParams.buku_tanggal;}
		if(buku_besar_DataStore.baseParams.buku_akun!==null){buku_akun_2excel = buku_besar_DataStore.baseParams.buku_akun;}
		if(buku_besar_DataStore.baseParams.buku_debet!==null){buku_debet_2excel = buku_besar_DataStore.baseParams.buku_debet;}
		if(buku_besar_DataStore.baseParams.buku_kredit!==null){buku_kredit_2excel = buku_besar_DataStore.baseParams.buku_kredit;}
		if(buku_besar_DataStore.baseParams.buku_saldo_debet!==null){buku_saldo_debet_2excel = buku_besar_DataStore.baseParams.buku_saldo_debet;}
		if(buku_besar_DataStore.baseParams.buku_saldo_kredit!==null){buku_saldo_kredit_2excel = buku_besar_DataStore.baseParams.buku_saldo_kredit;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_buku_besar&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	buku_tanggal : buku_tanggal_2excel_date, 
			buku_akun : buku_akun_2excel,
			buku_debet : buku_debet_2excel,
			buku_kredit : buku_kredit_2excel,
			buku_saldo_debet : buku_saldo_debet_2excel,
			buku_saldo_kredit : buku_saldo_kredit_2excel,
		  	currentlisting: buku_besar_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_buku_besar"></div>
		<div id="elwindow_buku_besar_create"></div>
        <div id="elwindow_buku_besar_search"></div>
    </div>
</div>
</body>