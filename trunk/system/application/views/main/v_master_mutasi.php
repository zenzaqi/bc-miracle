<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_mutasi View
	+ Description	: For record view
	+ Filename 		: v_master_mutasi.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:45:23
	
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
var master_mutasi_DataStore;
var master_mutasi_ColumnModel;
var master_mutasiListEditorGrid;
var master_mutasi_createForm;
var master_mutasi_createWindow;
var master_mutasi_searchForm;
var master_mutasi_searchWindow;
var master_mutasi_SelectedRow;
var master_mutasi_ContextMenu;
//for detail data
var detail_mutasi_DataStor;
var detail_mutasiListEditorGrid;
var detail_mutasi_ColumnModel;
var detail_mutasi_proxy;
var detail_mutasi_writer;
var detail_mutasi_reader;
var editor_detail_mutasi;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var mutasi_idField;
var mutasi_asalField;
var mutasi_tujuanField;
var mutasi_tanggalField;
var mutasi_keteranganField;
var mutasi_idSearchField;
var mutasi_asalSearchField;
var mutasi_tujuanSearchField;
var mutasi_tanggalSearchField;
var mutasi_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_mutasi_update(oGrid_event){
		var mutasi_id_update_pk="";
		var mutasi_asal_update=null;
		var mutasi_tujuan_update=null;
		var mutasi_tanggal_update_date="";
		var mutasi_keterangan_update=null;

		mutasi_id_update_pk = oGrid_event.record.data.mutasi_id;
		if(oGrid_event.record.data.mutasi_asal!== null){mutasi_asal_update = oGrid_event.record.data.mutasi_asal;}
		if(oGrid_event.record.data.mutasi_tujuan!== null){mutasi_tujuan_update = oGrid_event.record.data.mutasi_tujuan;}
	 	if(oGrid_event.record.data.mutasi_tanggal!== ""){mutasi_tanggal_update_date =oGrid_event.record.data.mutasi_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.mutasi_keterangan!== null){mutasi_keterangan_update = oGrid_event.record.data.mutasi_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_mutasi&m=get_action',
			params: {
				task: "UPDATE",
				mutasi_id	: mutasi_id_update_pk, 
				mutasi_asal	:mutasi_asal_update,  
				mutasi_tujuan	:mutasi_tujuan_update,  
				mutasi_tanggal	: mutasi_tanggal_update_date, 
				mutasi_keterangan	:mutasi_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_mutasi_DataStore.commitChanges();
						master_mutasi_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the master_mutasi.',
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
	function master_mutasi_create(){
	
		if(is_master_mutasi_form_valid()){	
		var mutasi_id_create_pk=null; 
		var mutasi_asal_create=null; 
		var mutasi_tujuan_create=null; 
		var mutasi_tanggal_create_date=""; 
		var mutasi_keterangan_create=null; 

		if(mutasi_idField.getValue()!== null){mutasi_id_create = mutasi_idField.getValue();}else{mutasi_id_create_pk=get_pk_id();} 
		if(mutasi_asalField.getValue()!== null){mutasi_asal_create = mutasi_asalField.getValue();} 
		if(mutasi_tujuanField.getValue()!== null){mutasi_tujuan_create = mutasi_tujuanField.getValue();} 
		if(mutasi_tanggalField.getValue()!== ""){mutasi_tanggal_create_date = mutasi_tanggalField.getValue().format('Y-m-d');} 
		if(mutasi_keteranganField.getValue()!== null){mutasi_keterangan_create = mutasi_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_mutasi&m=get_action',
			params: {
				task: post2db,
				mutasi_id	: mutasi_id_create_pk, 
				mutasi_asal	: mutasi_asal_create, 
				mutasi_tujuan	: mutasi_tujuan_create, 
				mutasi_tanggal	: mutasi_tanggal_create_date, 
				mutasi_keterangan	: mutasi_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_mutasi_purge()
						detail_mutasi_insert();
						Ext.MessageBox.alert(post2db+' OK','The Master_mutasi was '+msg+' successfully.');
						master_mutasi_DataStore.reload();
						master_mutasi_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_mutasi.',
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
			return master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_mutasi_reset_form(){
		mutasi_idField.reset();
		mutasi_idField.setValue(null);
		mutasi_asalField.reset();
		mutasi_asalField.setValue(null);
		mutasi_tujuanField.reset();
		mutasi_tujuanField.setValue(null);
		mutasi_tanggalField.reset();
		mutasi_tanggalField.setValue(null);
		mutasi_keteranganField.reset();
		mutasi_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_mutasi_set_form(){
		mutasi_idField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_id'));
		mutasi_asalField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_asal'));
		mutasi_tujuanField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_tujuan'));
		mutasi_tanggalField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_tanggal'));
		mutasi_keteranganField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_mutasi_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_mutasi_createWindow.isVisible()){
			master_mutasi_reset_form();
			post2db='CREATE';
			msg='created';
			master_mutasi_createWindow.show();
		} else {
			master_mutasi_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_mutasi_confirm_delete(){
		// only one master_mutasi is selected here
		if(master_mutasiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_mutasi_delete);
		} else if(master_mutasiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_mutasi_delete);
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
	function master_mutasi_confirm_update(){
		/* only one record is selected here */
		if(master_mutasiListEditorGrid.selModel.getCount() == 1) {
			master_mutasi_set_form();
			post2db='UPDATE';
			detail_mutasi_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			master_mutasi_createWindow.show();
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
	function master_mutasi_delete(btn){
		if(btn=='yes'){
			var selections = master_mutasiListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_mutasiListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.mutasi_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_mutasi&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_mutasi_DataStore.reload();
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
	master_mutasi_DataStore = new Ext.data.Store({
		id: 'master_mutasi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'mutasi_id'
		},[
		/* dataIndex => insert intomaster_mutasi_ColumnModel, Mapping => for initiate table column */ 
			{name: 'mutasi_id', type: 'int', mapping: 'mutasi_id'}, 
			{name: 'mutasi_asal', type: 'string', mapping: 'gudang_nama_asal'}, 
			{name: 'mutasi_tujuan', type: 'string', mapping: 'gudang_nama_tujuan'}, 
			{name: 'mutasi_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'mutasi_tanggal'}, 
			{name: 'mutasi_keterangan', type: 'string', mapping: 'mutasi_keterangan'}, 
			{name: 'mutasi_creator', type: 'string', mapping: 'mutasi_creator'}, 
			{name: 'mutasi_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'mutasi_date_create'}, 
			{name: 'mutasi_update', type: 'string', mapping: 'mutasi_update'}, 
			{name: 'mutasi_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'mutasi_date_update'}, 
			{name: 'mutasi_revised', type: 'int', mapping: 'mutasi_revised'} 
		]),
		sortInfo:{field: 'mutasi_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Supplier DataStore */
	cbo_mutasi_gudang_DataSore = new Ext.data.Store({
		id: 'cbo_mutasi_gudang_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_gudang_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'gudang_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'mutasi_gudang_value', type: 'int', mapping: 'gudang_id'},
			{name: 'mutasi_gudang_nama', type: 'string', mapping: 'gudang_nama'}
		]),
		sortInfo:{field: 'mutasi_gudang_nama', direction: "ASC"}
	});
    
  	/* Function for Identify of Window Column Model */
	master_mutasi_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'mutasi_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Asal',
			dataIndex: 'mutasi_asal',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_mutasi_gudang_DataSore,
				mode: 'remote',
               	displayField: 'mutasi_gudang_nama',
               	valueField: 'mutasi_gudang_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Tujuan',
			dataIndex: 'mutasi_tujuan',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_mutasi_gudang_DataSore,
				mode: 'local',
               	displayField: 'mutasi_gudang_nama',
               	valueField: 'mutasi_gudang_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'mutasi_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'mutasi_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'mutasi_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'mutasi_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'mutasi_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'mutasi_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'mutasi_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_mutasi_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_mutasiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'master_mutasiListEditorGrid',
		el: 'fp_master_mutasi',
		title: 'List Of Master_mutasi',
		autoHeight: true,
		store: master_mutasi_DataStore, // DataStore
		cm: master_mutasi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_mutasi_DataStore,
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
			handler: master_mutasi_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_mutasi_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_mutasi_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_mutasi_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_mutasi_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_mutasi_print  
		}
		]
	});
	master_mutasiListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_mutasi_ContextMenu = new Ext.menu.Menu({
		id: 'master_mutasi_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_mutasi_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_mutasi_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_mutasi_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_mutasi_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_mutasi_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_mutasi_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_mutasi_SelectedRow=rowIndex;
		master_mutasi_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_mutasi_editContextMenu(){
		master_mutasiListEditorGrid.startEditing(master_mutasi_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_mutasiListEditorGrid.addListener('rowcontextmenu', onmaster_mutasi_ListEditGridContextMenu);
	master_mutasi_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_mutasiListEditorGrid.on('afteredit', master_mutasi_update); // inLine Editing Record
	
	/* Identify  mutasi_id Field */
	mutasi_idField= new Ext.form.NumberField({
		id: 'mutasi_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  mutasi_asal Field */
	mutasi_asalField= new Ext.form.ComboBox({
		id: 'mutasi_asalField',
		fieldLabel: 'Asal',
		store: cbo_mutasi_gudang_DataSore,
		displayField:'mutasi_gudang_nama',
		mode : 'remote',
		valueField: 'mutasi_gudang_value',
        typeAhead: false,
        hideTrigger:false,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  mutasi_tujuan Field */
	mutasi_tujuanField= new Ext.form.ComboBox({
		id: 'mutasi_tujuanField',
		fieldLabel: 'Tujuan',
		store: cbo_mutasi_gudang_DataSore,
		displayField:'mutasi_gudang_nama',
		mode : 'remote',
		valueField: 'mutasi_gudang_value',
        typeAhead: false,
        hideTrigger:false,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  mutasi_tanggal Field */
	mutasi_tanggalField= new Ext.form.DateField({
		id: 'mutasi_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  mutasi_keterangan Field */
	mutasi_keteranganField= new Ext.form.TextArea({
		id: 'mutasi_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	
	/* Identify  order_bayar Field */
	mutasi_totaljumlahField= new Ext.form.NumberField({
		id: 'mutasi_totaljumlahField',
		fieldLabel: 'Jumlah Total Produk',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	/*Fieldset Master*/
	master_mutasi_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [mutasi_asalField, mutasi_tujuanField, mutasi_idField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [mutasi_tanggalField, mutasi_keteranganField] 
			}
			]
	
	});
	
	//master_mutasi_FootGroup
	master_mutasi_footGroup = new Ext.form.FieldSet({
		title: '-',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		labelSeparator : ':',
		anchor: '60%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				labelAlign: 'top',
				border:false,
				items: [mutasi_totaljumlahField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_mutasi_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dmutasi_id', type: 'int', mapping: 'dmutasi_id'}, 
			{name: 'dmutasi_master', type: 'int', mapping: 'dmutasi_master'}, 
			{name: 'dmutasi_produk', type: 'int', mapping: 'dmutasi_produk'}, 
			{name: 'dmutasi_satuan', type: 'int', mapping: 'dmutasi_satuan'}, 
			{name: 'dmutasi_jumlah', type: 'int', mapping: 'dmutasi_jumlah'} 
	]);
	//eof
	
	//function for json writer of detail
	var detail_mutasi_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_mutasi_DataStore = new Ext.data.Store({
		id: 'detail_mutasi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=detail_detail_mutasi_list', 
			method: 'POST'
		}),
		reader: detail_mutasi_reader,
		baseParams:{master_id: mutasi_idField.getValue()},
		sortInfo:{field: 'dmutasi_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_mutasi= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	Ext.util.Format.comboRenderer = function(combo){
		cbo_dmutasi_produkDataStore.load();
		cbo_dmutasi_satuanDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	cbo_dmutasi_produkDataStore = new Ext.data.Store({
		id: 'cbo_dmutasi_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_produk_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'dmutasi_produk_value', type: 'int', mapping: 'produk_id'},
			{name: 'dmutasi_produk_display', type: 'string', mapping: 'produk_nama'}
		]),
		sortInfo:{field: 'dmutasi_produk_value', direction: "ASC"}
	});
	
	cbo_dmutasi_satuanDataStore = new Ext.data.Store({
		id: 'cbo_dmutasi_satuanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_satuan_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'dmutasi_satuan_value', type: 'int', mapping: 'satuan_id'},
			{name: 'dmutasi_satuan_display', type: 'string', mapping: 'satuan_nama'}
		]),
		sortInfo:{field: 'dmutasi_satuan_value', direction: "ASC"}
	});
	
	var combo_mutasi_produk=new Ext.form.ComboBox({
			store: cbo_dmutasi_produkDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dmutasi_produk_display',
			valueField: 'dmutasi_produk_value',
			triggerAction: 'all',
			lazyRender:true,

	});
	
	var combo_mutasi_satuan=new Ext.form.ComboBox({
			store: cbo_dmutasi_satuanDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dmutasi_satuan_display',
			valueField: 'dmutasi_satuan_value',
			triggerAction: 'all',
			lazyRender:true,

	});
	
	//declaration of detail coloumn model
	detail_mutasi_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Nama Produk',
			dataIndex: 'dmutasi_produk',
			width: 150,
			sortable: true,
			editor: combo_mutasi_produk,
			renderer: Ext.util.Format.comboRenderer(combo_mutasi_produk)
		},
		{
			header: 'Satuan',
			dataIndex: 'dmutasi_satuan',
			width: 150,
			sortable: true,
			editor: combo_mutasi_satuan,
			renderer: Ext.util.Format.comboRenderer(combo_mutasi_satuan)
		},
		{
			header: 'Jumlah',
			dataIndex: 'dmutasi_jumlah',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	detail_mutasi_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	detail_mutasiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_mutasiListEditorGrid',
		el: 'fp_detail_mutasi',
		title: 'Detail detail_mutasi',
		height: 250,
		width: 690,
		autoScroll: true,
		store: detail_mutasi_DataStore, // DataStore
		colModel: detail_mutasi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_mutasi],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_mutasi_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_mutasi_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_mutasi_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function detail_mutasi_add(){
		var edit_detail_mutasi= new detail_mutasiListEditorGrid.store.recordType({
			dmutasi_id	:'',		
			dmutasi_master	:'',		
			dmutasi_produk	:'',		
			dmutasi_satuan	:'',		
			dmutasi_jumlah	:''		
		});
		editor_detail_mutasi.stopEditing();
		detail_mutasi_DataStore.insert(0, edit_detail_mutasi);
		detail_mutasiListEditorGrid.getView().refresh();
		detail_mutasiListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_mutasi.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_mutasi(){
		detail_mutasi_DataStore.commitChanges();
		detail_mutasiListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_mutasi_insert(){
		for(i=0;i<detail_mutasi_DataStore.getCount();i++){
			detail_mutasi_record=detail_mutasi_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_mutasi&m=detail_detail_mutasi_insert',
				params:{
				dmutasi_id	: detail_mutasi_record.data.dmutasi_id, 
				dmutasi_master	: eval(mutasi_idField.getValue()), 
				dmutasi_produk	: detail_mutasi_record.data.dmutasi_produk, 
				dmutasi_satuan	: detail_mutasi_record.data.dmutasi_satuan, 
				dmutasi_jumlah	: detail_mutasi_record.data.dmutasi_jumlah 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function detail_mutasi_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_mutasi&m=detail_detail_mutasi_purge',
			params:{ master_id: eval(mutasi_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_mutasi_confirm_delete(){
		// only one record is selected here
		if(detail_mutasiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_mutasi_delete);
		} else if(detail_mutasiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_mutasi_delete);
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
	function detail_mutasi_delete(btn){
		if(btn=='yes'){
			var s = detail_mutasiListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_mutasi_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	detail_mutasi_DataStore.on('update', refresh_detail_mutasi);
	
	/* Function for retrieve create Window Panel*/ 
	master_mutasi_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [master_mutasi_masterGroup,detail_mutasiListEditorGrid,master_mutasi_footGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_mutasi_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_mutasi_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_mutasi_createWindow= new Ext.Window({
		id: 'master_mutasi_createWindow',
		title: post2db+'Master_mutasi',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_mutasi_create',
		items: master_mutasi_createForm
	});
	/* End Window */
	
	function detail_mutasi_total(){
		var jumlah_item=0;
		for(i=0;i<detail_mutasi_DataStore.getCount();i++){
			detail_mutasi_record=detail_mutasi_DataStore.getAt(i);
			jumlah_item=jumlah_item+detail_mutasi_record.data.dmutasi_jumlah;
		}
		mutasi_totaljumlahField.setValue(jumlah_item);
	}
	
	detail_mutasi_DataStore.on("update",detail_mutasi_total);
	detail_mutasi_DataStore.on("load",detail_mutasi_total);
	
	/* Function for action list search */
	function master_mutasi_list_search(){
		// render according to a SQL date format.
		var mutasi_id_search=null;
		var mutasi_asal_search=null;
		var mutasi_tujuan_search=null;
		var mutasi_tanggal_search_date="";
		var mutasi_keterangan_search=null;

		if(mutasi_idSearchField.getValue()!==null){mutasi_id_search=mutasi_idSearchField.getValue();}
		if(mutasi_asalSearchField.getValue()!==null){mutasi_asal_search=mutasi_asalSearchField.getValue();}
		if(mutasi_tujuanSearchField.getValue()!==null){mutasi_tujuan_search=mutasi_tujuanSearchField.getValue();}
		if(mutasi_tanggalSearchField.getValue()!==""){mutasi_tanggal_search_date=mutasi_tanggalSearchField.getValue().format('Y-m-d');}
		if(mutasi_keteranganSearchField.getValue()!==null){mutasi_keterangan_search=mutasi_keteranganSearchField.getValue();}
		// change the store parameters
		master_mutasi_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			mutasi_id	:	mutasi_id_search, 
			mutasi_asal	:	mutasi_asal_search, 
			mutasi_tujuan	:	mutasi_tujuan_search, 
			mutasi_tanggal	:	mutasi_tanggal_search_date, 
			mutasi_keterangan	:	mutasi_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		master_mutasi_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_mutasi_reset_search(){
		// reset the store parameters
		master_mutasi_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_mutasi_DataStore.reload({params: {start: 0, limit: pageS}});
		master_mutasi_searchWindow.close();
	};
	/* End of Fuction */
	
	function master_mutasi_reset_SearchForm(){
		mutasi_asalSearchField.reset();
		mutasi_tujuanSearchField.reset();
		mutasi_tanggalSearchField.reset();
		mutasi_keteranganSearchField.reset();
	}
	
	
	/* Field for search */
	/* Identify  mutasi_id Search Field */
	mutasi_idSearchField= new Ext.form.NumberField({
		id: 'mutasi_idSearchField',
		fieldLabel: 'Mutasi Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  mutasi_asal Search Field */
	mutasi_asalSearchField= new Ext.form.NumberField({
		id: 'mutasi_asalSearchField',
		fieldLabel: 'Asal',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  mutasi_tujuan Search Field */
	mutasi_tujuanSearchField= new Ext.form.NumberField({
		id: 'mutasi_tujuanSearchField',
		fieldLabel: 'Tujuan',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  mutasi_tanggal Search Field */
	mutasi_tanggalSearchField= new Ext.form.DateField({
		id: 'mutasi_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  mutasi_keterangan Search Field */
	mutasi_keteranganSearchField= new Ext.form.TextArea({
		id: 'mutasi_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_mutasi_searchForm = new Ext.FormPanel({
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
				items: [mutasi_asalSearchField, mutasi_tujuanSearchField, mutasi_tanggalSearchField, mutasi_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_mutasi_list_search
			},{
				text: 'Close',
				handler: function(){
					master_mutasi_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_mutasi_searchWindow = new Ext.Window({
		title: 'master_mutasi Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_mutasi_search',
		items: master_mutasi_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_mutasi_searchWindow.isVisible()){
			master_mutasi_reset_SearchForm();
			master_mutasi_searchWindow.show();
		} else {
			master_mutasi_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_mutasi_print(){
		var searchquery = "";
		var mutasi_asal_print=null;
		var mutasi_tujuan_print=null;
		var mutasi_tanggal_print_date="";
		var mutasi_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_mutasi_DataStore.baseParams.query!==null){searchquery = master_mutasi_DataStore.baseParams.query;}
		if(master_mutasi_DataStore.baseParams.mutasi_asal!==null){mutasi_asal_print = master_mutasi_DataStore.baseParams.mutasi_asal;}
		if(master_mutasi_DataStore.baseParams.mutasi_tujuan!==null){mutasi_tujuan_print = master_mutasi_DataStore.baseParams.mutasi_tujuan;}
		if(master_mutasi_DataStore.baseParams.mutasi_tanggal!==""){mutasi_tanggal_print_date = master_mutasi_DataStore.baseParams.mutasi_tanggal;}
		if(master_mutasi_DataStore.baseParams.mutasi_keterangan!==null){mutasi_keterangan_print = master_mutasi_DataStore.baseParams.mutasi_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_mutasi&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			mutasi_asal : mutasi_asal_print,
			mutasi_tujuan : mutasi_tujuan_print,
		  	mutasi_tanggal : mutasi_tanggal_print_date, 
			mutasi_keterangan : mutasi_keterangan_print,
		  	currentlisting: master_mutasi_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_mutasilist.html','master_mutasilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_mutasi_export_excel(){
		var searchquery = "";
		var mutasi_asal_2excel=null;
		var mutasi_tujuan_2excel=null;
		var mutasi_tanggal_2excel_date="";
		var mutasi_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_mutasi_DataStore.baseParams.query!==null){searchquery = master_mutasi_DataStore.baseParams.query;}
		if(master_mutasi_DataStore.baseParams.mutasi_asal!==null){mutasi_asal_2excel = master_mutasi_DataStore.baseParams.mutasi_asal;}
		if(master_mutasi_DataStore.baseParams.mutasi_tujuan!==null){mutasi_tujuan_2excel = master_mutasi_DataStore.baseParams.mutasi_tujuan;}
		if(master_mutasi_DataStore.baseParams.mutasi_tanggal!==""){mutasi_tanggal_2excel_date = master_mutasi_DataStore.baseParams.mutasi_tanggal;}
		if(master_mutasi_DataStore.baseParams.mutasi_keterangan!==null){mutasi_keterangan_2excel = master_mutasi_DataStore.baseParams.mutasi_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_mutasi&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			mutasi_asal : mutasi_asal_2excel,
			mutasi_tujuan : mutasi_tujuan_2excel,
		  	mutasi_tanggal : mutasi_tanggal_2excel_date, 
			mutasi_keterangan : mutasi_keterangan_2excel,
		  	currentlisting: master_mutasi_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_mutasi"></div>
         <div id="fp_detail_mutasi"></div>
		<div id="elwindow_master_mutasi_create"></div>
        <div id="elwindow_master_mutasi_search"></div>
    </div>
</div>
</body>