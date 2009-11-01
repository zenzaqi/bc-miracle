<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: konsultansi View
	+ Description	: For record view
	+ Filename 		: v_konsultansi.php
 	+ Author  		: 
 	+ Created on 06/Oct/2009 08:41:02
	
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
var konsultansi_DataStore;
var konsultansi_ColumnModel;
var konsultansiListEditorGrid;
var konsultansi_createForm;
var konsultansi_createWindow;
var konsultansi_searchForm;
var konsultansi_searchWindow;
var konsultansi_SelectedRow;
var konsultansi_ContextMenu;
//for detail data
var konsul_diagnosa_DataStor;
var konsul_diagnosaListEditorGrid;
var konsul_diagnosa_ColumnModel;
var konsul_diagnosa_proxy;
var konsul_diagnosa_writer;
var konsul_diagnosa_reader;
var editor_konsul_diagnosa;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var konsul_idField;
var konsul_custField;
var konsul_dokterField;
var konsul_tanggalField;
var konsul_keteranganField;
var konsul_idSearchField;
var konsul_custSearchField;
var konsul_dokterSearchField;
var konsul_tanggalSearchField;
var konsul_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function konsultansi_update(oGrid_event){
		var konsul_id_update_pk="";
		var konsul_cust_update=null;
		var konsul_dokter_update=null;
		var konsul_tanggal_update_date="";
		var konsul_keterangan_update=null;

		konsul_id_update_pk = oGrid_event.record.data.konsul_id;
		if(oGrid_event.record.data.konsul_cust!== null){konsul_cust_update = oGrid_event.record.data.konsul_cust;}
		if(oGrid_event.record.data.konsul_dokter!== null){konsul_dokter_update = oGrid_event.record.data.konsul_dokter;}
	 	if(oGrid_event.record.data.konsul_tanggal!== ""){konsul_tanggal_update_date =oGrid_event.record.data.konsul_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.konsul_keterangan!== null){konsul_keterangan_update = oGrid_event.record.data.konsul_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_konsultansi&m=get_action',
			params: {
				task: "UPDATE",
				konsul_id	: konsul_id_update_pk, 
				konsul_cust	:konsul_cust_update,  
				konsul_dokter	:konsul_dokter_update,  
				konsul_tanggal	: konsul_tanggal_update_date, 
				konsul_keterangan	:konsul_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						konsultansi_DataStore.commitChanges();
						konsultansi_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the konsultansi.',
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
	function konsultansi_create(){
	
		if(is_konsultansi_form_valid()){	
		var konsul_id_create_pk=null; 
		var konsul_cust_create=null; 
		var konsul_dokter_create=null; 
		var konsul_tanggal_create_date=""; 
		var konsul_keterangan_create=null; 

		if(konsul_idField.getValue()!== null){konsul_id_create_pk = konsul_idField.getValue();}else{konsul_id_create_pk=get_pk_id();} 
		if(konsul_custField.getValue()!== null){konsul_cust_create = konsul_custField.getValue();} 
		if(konsul_dokterField.getValue()!== null){konsul_dokter_create = konsul_dokterField.getValue();} 
		if(konsul_tanggalField.getValue()!== ""){konsul_tanggal_create_date = konsul_tanggalField.getValue().format('Y-m-d');} 
		if(konsul_keteranganField.getValue()!== null){konsul_keterangan_create = konsul_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_konsultansi&m=get_action',
			params: {
				task: post2db,
				konsul_id	: konsul_id_create_pk, 
				konsul_cust	: konsul_cust_create, 
				konsul_dokter	: konsul_dokter_create, 
				konsul_tanggal	: konsul_tanggal_create_date, 
				konsul_keterangan	: konsul_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						konsul_diagnosa_purge()
						konsul_diagnosa_insert();
						Ext.MessageBox.alert(post2db+' OK','The Konsultansi was '+msg+' successfully.');
						konsultansi_DataStore.reload();
						konsultansi_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Konsultansi.',
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
			return konsultansiListEditorGrid.getSelectionModel().getSelected().get('konsul_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function konsultansi_reset_form(){
		konsul_idField.reset();
		konsul_idField.setValue(null);
		konsul_custField.reset();
		konsul_custField.setValue(null);
		konsul_dokterField.reset();
		konsul_dokterField.setValue(null);
		konsul_tanggalField.reset();
		konsul_tanggalField.setValue(null);
		konsul_keteranganField.reset();
		konsul_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function konsultansi_set_form(){
		konsul_idField.setValue(konsultansiListEditorGrid.getSelectionModel().getSelected().get('konsul_id'));
		konsul_custField.setValue(konsultansiListEditorGrid.getSelectionModel().getSelected().get('konsul_cust'));
		konsul_dokterField.setValue(konsultansiListEditorGrid.getSelectionModel().getSelected().get('konsul_dokter'));
		konsul_tanggalField.setValue(konsultansiListEditorGrid.getSelectionModel().getSelected().get('konsul_tanggal'));
		konsul_keteranganField.setValue(konsultansiListEditorGrid.getSelectionModel().getSelected().get('konsul_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_konsultansi_form_valid(){
		return (true );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!konsultansi_createWindow.isVisible()){
			konsultansi_reset_form();
			post2db='CREATE';
			msg='created';
			konsultansi_createWindow.show();
		} else {
			konsultansi_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function konsultansi_confirm_delete(){
		// only one konsultansi is selected here
		if(konsultansiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', konsultansi_delete);
		} else if(konsultansiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', konsultansi_delete);
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
	function konsultansi_confirm_update(){
		/* only one record is selected here */
		if(konsultansiListEditorGrid.selModel.getCount() == 1) {
			konsultansi_set_form();
			post2db='UPDATE';
			konsul_diagnosa_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			konsultansi_createWindow.show();
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
	function konsultansi_delete(btn){
		if(btn=='yes'){
			var selections = konsultansiListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< konsultansiListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.konsul_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_konsultansi&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							konsultansi_DataStore.reload();
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
	konsultansi_DataStore = new Ext.data.Store({
		id: 'konsultansi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_konsultansi&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'konsul_id'
		},[
		/* dataIndex => insert intokonsultansi_ColumnModel, Mapping => for initiate table column */ 
			{name: 'konsul_id', type: 'int', mapping: 'konsul_id'}, 
			{name: 'konsul_cust', type: 'int', mapping: 'konsul_cust'}, 
			{name: 'konsul_dokter', type: 'int', mapping: 'konsul_dokter'}, 
			{name: 'konsul_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'konsul_tanggal'}, 
			{name: 'konsul_keterangan', type: 'string', mapping: 'konsul_keterangan'}, 
			{name: 'konsul_creator', type: 'string', mapping: 'konsul_creator'}, 
			{name: 'konsul_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'konsul_date_create'}, 
			{name: 'konsul_update', type: 'string', mapping: 'konsul_update'}, 
			{name: 'konsul_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'konsul_date_update'}, 
			{name: 'konsul_revised', type: 'int', mapping: 'konsul_revised'} 
		]),
		sortInfo:{field: 'konsul_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	konsultansi_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'konsul_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Customer',
			dataIndex: 'konsul_cust',
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
			header: 'Dokter',
			dataIndex: 'konsul_dokter',
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
			header: 'Tanggal',
			dataIndex: 'konsul_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'konsul_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextArea({
				maxLength: 500
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'konsul_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Create on',
			dataIndex: 'konsul_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'konsul_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'konsul_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'konsul_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	konsultansi_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	konsultansiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'konsultansiListEditorGrid',
		el: 'fp_konsultansi',
		title: 'List Of Konsultansi',
		autoHeight: true,
		store: konsultansi_DataStore, // DataStore
		cm: konsultansi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: konsultansi_DataStore,
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
			handler: konsultansi_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: konsultansi_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: konsultansi_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: konsultansi_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: konsultansi_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: konsultansi_print  
		}
		]
	});
	konsultansiListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	konsultansi_ContextMenu = new Ext.menu.Menu({
		id: 'konsultansi_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: konsultansi_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: konsultansi_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: konsultansi_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: konsultansi_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onkonsultansi_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		konsultansi_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		konsultansi_SelectedRow=rowIndex;
		konsultansi_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function konsultansi_editContextMenu(){
		konsultansiListEditorGrid.startEditing(konsultansi_SelectedRow,1);
  	}
	/* End of Function */
  	
	konsultansiListEditorGrid.addListener('rowcontextmenu', onkonsultansi_ListEditGridContextMenu);
	konsultansi_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	konsultansiListEditorGrid.on('afteredit', konsultansi_update); // inLine Editing Record
	
	/* Identify  konsul_id Field */
	konsul_idField= new Ext.form.NumberField({
		id: 'konsul_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  konsul_cust Field */
	konsul_custField= new Ext.form.NumberField({
		id: 'konsul_custField',
		fieldLabel: 'Customer',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  konsul_dokter Field */
	konsul_dokterField= new Ext.form.NumberField({
		id: 'konsul_dokterField',
		fieldLabel: 'Dokter',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  konsul_tanggal Field */
	konsul_tanggalField= new Ext.form.DateField({
		id: 'konsul_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		readOnly: true
	});
	/* Identify  konsul_keterangan Field */
	konsul_keteranganField= new Ext.form.TextArea({
		id: 'konsul_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	konsultansi_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [konsul_custField, konsul_dokterField,konsul_tanggalField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [konsul_keteranganField, konsul_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var konsul_diagnosa_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'kdiagnosa_id', type: 'int', mapping: 'kdiagnosa_id'}, 
			{name: 'kdiagnosa_master', type: 'int', mapping: 'kdiagnosa_master'}, 
			{name: 'kdiagnosa_nama', type: 'int', mapping: 'kdiagnosa_nama'}, 
			{name: 'kdiganosa_keterangan', type: 'string', mapping: 'kdiganosa_keterangan'} 
	]);
	//eof
	
	//function for json writer of detail
	var konsul_diagnosa_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	konsul_diagnosa_DataStore = new Ext.data.Store({
		id: 'konsul_diagnosa_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_konsultansi&m=detail_konsul_diagnosa_list', 
			method: 'POST'
		}),
		reader: konsul_diagnosa_reader,
		baseParams:{master_id: konsul_idField.getValue()},
		sortInfo:{field: 'kdiagnosa_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_konsul_diagnosa= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	konsul_diagnosa_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Kdiagnosa Nama',
			dataIndex: 'kdiagnosa_nama',
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
			header: 'Kdiganosa Keterangan',
			dataIndex: 'kdiganosa_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}]
	);
	konsul_diagnosa_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	konsul_diagnosaListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'konsul_diagnosaListEditorGrid',
		el: 'fp_konsul_diagnosa',
		title: 'Detail konsul_diagnosa',
		height: 250,
		width: 690,
		autoScroll: true,
		store: konsul_diagnosa_DataStore, // DataStore
		colModel: konsul_diagnosa_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_konsul_diagnosa],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: konsul_diagnosa_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: konsul_diagnosa_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: konsul_diagnosa_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function konsul_diagnosa_add(){
		var edit_konsul_diagnosa= new konsul_diagnosaListEditorGrid.store.recordType({
			kdiagnosa_id	:'',		
			kdiagnosa_master	:'',		
			kdiagnosa_nama	:'',		
			kdiganosa_keterangan	:''		
		});
		editor_konsul_diagnosa.stopEditing();
		konsul_diagnosa_DataStore.insert(0, edit_konsul_diagnosa);
		konsul_diagnosaListEditorGrid.getView().refresh();
		konsul_diagnosaListEditorGrid.getSelectionModel().selectRow(0);
		editor_konsul_diagnosa.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_konsul_diagnosa(){
		konsul_diagnosa_DataStore.commitChanges();
		konsul_diagnosaListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function konsul_diagnosa_insert(){
		for(i=0;i<konsul_diagnosa_DataStore.getCount();i++){
			konsul_diagnosa_record=konsul_diagnosa_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_konsultansi&m=detail_konsul_diagnosa_insert',
				params:{
				kdiagnosa_id	: konsul_diagnosa_record.data.kdiagnosa_id, 
				kdiagnosa_master	: eval(konsul_idField.getValue()), 
				kdiagnosa_nama	: konsul_diagnosa_record.data.kdiagnosa_nama, 
				kdiganosa_keterangan	: konsul_diagnosa_record.data.kdiganosa_keterangan 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function konsul_diagnosa_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_konsultansi&m=detail_konsul_diagnosa_purge',
			params:{ master_id: eval(konsul_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function konsul_diagnosa_confirm_delete(){
		// only one record is selected here
		if(konsul_diagnosaListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', konsul_diagnosa_delete);
		} else if(konsul_diagnosaListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', konsul_diagnosa_delete);
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
	//eof
	
	//function for Delete of detail
	function konsul_diagnosa_delete(btn){
		if(btn=='yes'){
			var s = konsul_diagnosaListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				konsul_diagnosa_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	konsul_diagnosa_DataStore.on('update', refresh_konsul_diagnosa);
	
	/* Function for retrieve create Window Panel*/ 
	konsultansi_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [konsultansi_masterGroup,konsul_diagnosaListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: konsultansi_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					konsultansi_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	konsultansi_createWindow= new Ext.Window({
		id: 'konsultansi_createWindow',
		title: post2db+'Konsultansi',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_konsultansi_create',
		items: konsultansi_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function konsultansi_list_search(){
		// render according to a SQL date format.
		var konsul_id_search=null;
		var konsul_cust_search=null;
		var konsul_dokter_search=null;
		var konsul_tanggal_search_date="";
		var konsul_keterangan_search=null;

		if(konsul_idSearchField.getValue()!==null){konsul_id_search=konsul_idSearchField.getValue();}
		if(konsul_custSearchField.getValue()!==null){konsul_cust_search=konsul_custSearchField.getValue();}
		if(konsul_dokterSearchField.getValue()!==null){konsul_dokter_search=konsul_dokterSearchField.getValue();}
		if(konsul_tanggalSearchField.getValue()!==""){konsul_tanggal_search_date=konsul_tanggalSearchField.getValue().format('Y-m-d');}
		if(konsul_keteranganSearchField.getValue()!==null){konsul_keterangan_search=konsul_keteranganSearchField.getValue();}
		// change the store parameters
		konsultansi_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			konsul_id	:	konsul_id_search, 
			konsul_cust	:	konsul_cust_search, 
			konsul_dokter	:	konsul_dokter_search, 
			konsul_tanggal	:	konsul_tanggal_search_date, 
			konsul_keterangan	:	konsul_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		konsultansi_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function konsultansi_reset_search(){
		// reset the store parameters
		konsultansi_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		konsultansi_DataStore.reload({params: {start: 0, limit: pageS}});
		konsultansi_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  konsul_id Search Field */
	konsul_idSearchField= new Ext.form.NumberField({
		id: 'konsul_idSearchField',
		fieldLabel: 'Konsul Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  konsul_cust Search Field */
	konsul_custSearchField= new Ext.form.NumberField({
		id: 'konsul_custSearchField',
		fieldLabel: 'Konsul Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  konsul_dokter Search Field */
	konsul_dokterSearchField= new Ext.form.NumberField({
		id: 'konsul_dokterSearchField',
		fieldLabel: 'Konsul Dokter',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  konsul_tanggal Search Field */
	konsul_tanggalSearchField= new Ext.form.DateField({
		id: 'konsul_tanggalSearchField',
		fieldLabel: 'Konsul Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  konsul_keterangan Search Field */
	konsul_keteranganSearchField= new Ext.form.TextField({
		id: 'konsul_keteranganSearchField',
		fieldLabel: 'Konsul Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	konsultansi_searchForm = new Ext.FormPanel({
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
				items: [konsul_custSearchField, konsul_dokterSearchField, konsul_tanggalSearchField, konsul_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: konsultansi_list_search
			},{
				text: 'Close',
				handler: function(){
					konsultansi_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	konsultansi_searchWindow = new Ext.Window({
		title: 'konsultansi Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_konsultansi_search',
		items: konsultansi_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!konsultansi_searchWindow.isVisible()){
			konsultansi_searchWindow.show();
		} else {
			konsultansi_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function konsultansi_print(){
		var searchquery = "";
		var konsul_cust_print=null;
		var konsul_dokter_print=null;
		var konsul_tanggal_print_date="";
		var konsul_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(konsultansi_DataStore.baseParams.query!==null){searchquery = konsultansi_DataStore.baseParams.query;}
		if(konsultansi_DataStore.baseParams.konsul_cust!==null){konsul_cust_print = konsultansi_DataStore.baseParams.konsul_cust;}
		if(konsultansi_DataStore.baseParams.konsul_dokter!==null){konsul_dokter_print = konsultansi_DataStore.baseParams.konsul_dokter;}
		if(konsultansi_DataStore.baseParams.konsul_tanggal!==""){konsul_tanggal_print_date = konsultansi_DataStore.baseParams.konsul_tanggal;}
		if(konsultansi_DataStore.baseParams.konsul_keterangan!==null){konsul_keterangan_print = konsultansi_DataStore.baseParams.konsul_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_konsultansi&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			konsul_cust : konsul_cust_print,
			konsul_dokter : konsul_dokter_print,
		  	konsul_tanggal : konsul_tanggal_print_date, 
			konsul_keterangan : konsul_keterangan_print,
		  	currentlisting: konsultansi_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./konsultansilist.html','konsultansilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function konsultansi_export_excel(){
		var searchquery = "";
		var konsul_cust_2excel=null;
		var konsul_dokter_2excel=null;
		var konsul_tanggal_2excel_date="";
		var konsul_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(konsultansi_DataStore.baseParams.query!==null){searchquery = konsultansi_DataStore.baseParams.query;}
		if(konsultansi_DataStore.baseParams.konsul_cust!==null){konsul_cust_2excel = konsultansi_DataStore.baseParams.konsul_cust;}
		if(konsultansi_DataStore.baseParams.konsul_dokter!==null){konsul_dokter_2excel = konsultansi_DataStore.baseParams.konsul_dokter;}
		if(konsultansi_DataStore.baseParams.konsul_tanggal!==""){konsul_tanggal_2excel_date = konsultansi_DataStore.baseParams.konsul_tanggal;}
		if(konsultansi_DataStore.baseParams.konsul_keterangan!==null){konsul_keterangan_2excel = konsultansi_DataStore.baseParams.konsul_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_konsultansi&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			konsul_cust : konsul_cust_2excel,
			konsul_dokter : konsul_dokter_2excel,
		  	konsul_tanggal : konsul_tanggal_2excel_date, 
			konsul_keterangan : konsul_keterangan_2excel,
		  	currentlisting: konsultansi_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_konsultansi"></div>
         <div id="fp_konsul_diagnosa"></div>
		<div id="elwindow_konsultansi_create"></div>
        <div id="elwindow_konsultansi_search"></div>
    </div>
</div>
</body>