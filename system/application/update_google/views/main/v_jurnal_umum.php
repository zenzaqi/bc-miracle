<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_umum View
	+ Description	: For record view
	+ Filename 		: v_jurnal_umum.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:25:17
	
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
var jurnal_umum_DataStore;
var jurnal_umum_ColumnModel;
var jurnal_umumListEditorGrid;
var jurnal_umum_createForm;
var jurnal_umum_createWindow;
var jurnal_umum_searchForm;
var jurnal_umum_searchWindow;
var jurnal_umum_SelectedRow;
var jurnal_umum_ContextMenu;
//for detail data
var jurnal_umum_detail_DataStor;
var jurnal_umum_detailListEditorGrid;
var jurnal_umum_detail_ColumnModel;
var jurnal_umum_detail_proxy;
var jurnal_umum_detail_writer;
var jurnal_umum_detail_reader;
var editor_jurnal_umum_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var jumum_idField;
var jumum_tanggalField;
var jumum_penggunaField;
var jumum_keteranganField;
var jumum_postingField;
var jumum_tglpostingField;
var jumum_idSearchField;
var jumum_tanggalSearchField;
var jumum_penggunaSearchField;
var jumum_keteranganSearchField;
var jumum_postingSearchField;
var jumum_tglpostingSearchField;

var dt=new Date();

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jurnal_umum_update(oGrid_event){
		var jumum_id_update_pk="";
		var jumum_tanggal_update_date="";
		var jumum_pengguna_update=null;
		var jumum_keterangan_update=null;
		var jumum_posting_update=null;
		var jumum_tglposting_update_date="";

		jumum_id_update_pk = oGrid_event.record.data.jumum_id;
	 	if(oGrid_event.record.data.jumum_tanggal!== ""){jumum_tanggal_update_date =oGrid_event.record.data.jumum_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jumum_pengguna!== null){jumum_pengguna_update = oGrid_event.record.data.jumum_pengguna;}
		if(oGrid_event.record.data.jumum_keterangan!== null){jumum_keterangan_update = oGrid_event.record.data.jumum_keterangan;}
		if(oGrid_event.record.data.jumum_posting!== null){jumum_posting_update = oGrid_event.record.data.jumum_posting;}
	 	if(oGrid_event.record.data.jumum_tglposting!== ""){jumum_tglposting_update_date =oGrid_event.record.data.jumum_tglposting.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_umum&m=get_action',
			params: {
				task: "UPDATE",
				jumum_id	: jumum_id_update_pk, 
				jumum_tanggal	: jumum_tanggal_update_date, 
				jumum_pengguna	:jumum_pengguna_update,  
				jumum_keterangan	:jumum_keterangan_update,  
				jumum_posting	:jumum_posting_update,  
				jumum_tglposting	: jumum_tglposting_update_date, 
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jurnal_umum_DataStore.commitChanges();
						jurnal_umum_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the jurnal_umum.',
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
	function jurnal_umum_create(){
		if(jumum_dtotal_kreditField.getValue()==jumum_dtotal_debetField.getValue()){
			if(is_jurnal_umum_form_valid()){	
			var jumum_id_create=null; 
			var jumum_tanggal_create_date=""; 
			var jumum_pengguna_create=null; 
			var jumum_keterangan_create=null; 
			var jumum_posting_create=null; 
			var jumum_tglposting_create_date=""; 
	
			if(jumum_idField.getValue()!== null){jumum_id_create_pk = jumum_idField.getValue();} 
			if(jumum_tanggalField.getValue()!== ""){jumum_tanggal_create_date = jumum_tanggalField.getValue().format('Y-m-d');} 
			if(jumum_penggunaField.getValue()!== null){jumum_pengguna_create = jumum_penggunaField.getValue();} 
			if(jumum_keteranganField.getValue()!== null){jumum_keterangan_create = jumum_keteranganField.getValue();} 
			if(jumum_postingField.getValue()!== null){jumum_posting_create = jumum_postingField.getValue();} 
			if(jumum_tglpostingField.getValue()!== ""){jumum_tglposting_create_date = jumum_tglpostingField.getValue().format('Y-m-d');} 
	
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_umum&m=get_action',
				params: {
					task: post2db,
					jumum_id	: jumum_id_create_pk, 
					jumum_tanggal	: jumum_tanggal_create_date, 
					jumum_pengguna	: jumum_pengguna_create, 
					jumum_keterangan	: jumum_keterangan_create, 
					jumum_posting	: jumum_posting_create, 
					jumum_tglposting	: jumum_tglposting_create_date, 
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							jurnal_umum_detail_purge()
							jurnal_umum_detail_insert();
							Ext.MessageBox.alert(post2db+' OK','The Jurnal_umum was '+msg+' successfully.');
							jurnal_umum_DataStore.reload();
							jurnal_umum_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Jurnal_umum.',
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
		} else{
			Ext.MessageBox.show({
			   title: 'Warning',
			   minWidth: 315,
			   msg: 'Total Kredit harus = Total Debet.',
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
			return jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jumum_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jurnal_umum_reset_form(){
		jumum_idField.reset();
		jumum_idField.setValue(null);
		jumum_tanggalField.reset();
		jumum_tanggalField.setValue(null);
		jumum_penggunaField.reset();
		jumum_penggunaField.setValue(null);
		jumum_keteranganField.reset();
		jumum_keteranganField.setValue(null);
		jumum_postingField.reset();
		jumum_postingField.setValue(null);
		jumum_tglpostingField.reset();
		jumum_tglpostingField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jurnal_umum_set_form(){
		jumum_idField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jumum_id'));
		jumum_tanggalField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jumum_tanggal'));
		jumum_penggunaField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jumum_pengguna'));
		jumum_keteranganField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jumum_keterangan'));
		jumum_postingField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jumum_posting'));
		jumum_tglpostingField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jumum_tglposting'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jurnal_umum_form_valid(){
		return (jumum_idField.isValid() && jumum_tanggalField.isValid() && jumum_penggunaField.isValid() && true &&  true &&  jumum_tglpostingField.isValid() && true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jurnal_umum_createWindow.isVisible()){
			jurnal_umum_reset_form();
			post2db='CREATE';
			msg='created';
			jumum_tanggalField.setValue(dt);
			jurnal_umum_createWindow.show();
		} else {
			jurnal_umum_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jurnal_umum_confirm_delete(){
		// only one jurnal_umum is selected here
		if(jurnal_umumListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_umum_delete);
		} else if(jurnal_umumListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_umum_delete);
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
	function jurnal_umum_confirm_update(){
		/* only one record is selected here */
		if(jurnal_umumListEditorGrid.selModel.getCount() == 1) {
			jurnal_umum_set_form();
			post2db='UPDATE';
			jurnal_umum_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			jurnal_umum_createWindow.show();
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
	function jurnal_umum_delete(btn){
		if(btn=='yes'){
			var selections = jurnal_umumListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jurnal_umumListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jumum_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jurnal_umum&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jurnal_umum_DataStore.reload();
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
	jurnal_umum_DataStore = new Ext.data.Store({
		id: 'jurnal_umum_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_umum&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jumum_id'
		},[
		/* dataIndex => insert intojurnal_umum_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jumum_id', type: 'int', mapping: 'jumum_id'}, 
			{name: 'jumum_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jumum_tanggal'}, 
			{name: 'jumum_pengguna', type: 'string', mapping: 'jumum_pengguna'}, 
			{name: 'jumum_keterangan', type: 'string', mapping: 'jumum_keterangan'}, 
			{name: 'jumum_posting', type: 'string', mapping: 'jumum_posting'}, 
			{name: 'jumum_tglposting', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jumum_tglposting'}, 
			{name: 'jumum_creator', type: 'string', mapping: 'jumum_creator'}, 
			{name: 'jumum_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'jumum_date_create'}, 
			{name: 'jumum_update', type: 'string', mapping: 'jumum_update'}, 
			{name: 'jumum_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'jumum_date_update'}, 
			{name: 'jumum_revised', type: 'int', mapping: 'jumum_revised'} 
		]),
		sortInfo:{field: 'jumum_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	jurnal_umum_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jumum_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Tanggal',
			dataIndex: 'jumum_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Pengguna',
			dataIndex: 'jumum_pengguna',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 100
          	})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'jumum_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Posting',
			dataIndex: 'jumum_posting',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['jumum_posting_value', 'jumum_posting_display'],
					data: [['T','T'],['Y','Y']]
					}),
				mode: 'local',
               	displayField: 'jumum_posting_display',
               	valueField: 'jumum_posting_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Tglposting',
			dataIndex: 'jumum_tglposting',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Creator',
			dataIndex: 'jumum_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jumum_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jumum_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jumum_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jumum_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	jurnal_umum_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	jurnal_umumListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_umumListEditorGrid',
		el: 'fp_jurnal_umum',
		title: 'List Of Jurnal_umum',
		autoHeight: true,
		store: jurnal_umum_DataStore, // DataStore
		cm: jurnal_umum_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_umum_DataStore,
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
			handler: jurnal_umum_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jurnal_umum_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jurnal_umum_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jurnal_umum_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_umum_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_umum_print  
		}
		]
	});
	jurnal_umumListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jurnal_umum_ContextMenu = new Ext.menu.Menu({
		id: 'jurnal_umum_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jurnal_umum_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jurnal_umum_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_umum_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_umum_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjurnal_umum_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jurnal_umum_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jurnal_umum_SelectedRow=rowIndex;
		jurnal_umum_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jurnal_umum_editContextMenu(){
		jurnal_umumListEditorGrid.startEditing(jurnal_umum_SelectedRow,1);
  	}
	/* End of Function */
  	
	jurnal_umumListEditorGrid.addListener('rowcontextmenu', onjurnal_umum_ListEditGridContextMenu);
	jurnal_umum_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	jurnal_umumListEditorGrid.on('afteredit', jurnal_umum_update); // inLine Editing Record
	
	/* Identify  jumum_id Field */
	jumum_idField= new Ext.form.NumberField({
		id: 'jumum_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jumum_tanggal Field */
	jumum_tanggalField= new Ext.form.DateField({
		id: 'jumum_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		allowBlank: false,
		disabled: true
	});
	/* Identify  jumum_pengguna Field */
	jumum_penggunaField= new Ext.form.TextField({
		id: 'jumum_penggunaField',
		fieldLabel: 'Pengguna',
		maxLength: 100,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  jumum_keterangan Field */
	jumum_keteranganField= new Ext.form.TextArea({
		id: 'jumum_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  jumum_posting Field */
	jumum_postingField= new Ext.form.ComboBox({
		id: 'jumum_postingField',
		fieldLabel: 'Posting',
		store:new Ext.data.SimpleStore({
			fields:['jumum_posting_value', 'jumum_posting_display'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jumum_posting_display',
		valueField: 'jumum_posting_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jumum_tglposting Field */
	jumum_tglpostingField= new Ext.form.DateField({
		id: 'jumum_tglpostingField',
		fieldLabel: 'Tglposting',
		format : 'Y-m-d',
		allowBlank: false,
	});
  	
	jumum_dtotal_kreditField= new Ext.form.NumberField({
		id: 'jumum_dtotal_kreditField',
		fieldLabel: 'Detail Total Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	jumum_dtotal_debetField= new Ext.form.NumberField({
		id: 'jumum_dtotal_debetField',
		fieldLabel: 'Detail Total Debit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	/*Fieldset Master*/
	jurnal_umum_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jumum_tanggalField, jumum_penggunaField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jumum_keteranganField, jumum_idField] 
			}
			]
	
	});
	
	jurnal_umum_dtotal_nilaiGroup = new Ext.form.FieldSet({
		title: '-',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jumum_dtotal_debetField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jumum_dtotal_kreditField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var jurnal_umum_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'djumum_id', type: 'int', mapping: 'djumum_id'}, 
			{name: 'djumum_master', type: 'int', mapping: 'djumum_master'}, 
			{name: 'djumum_akun', type: 'int', mapping: 'djumum_akun'}, 
			{name: 'djumum_keterangan', type: 'string', mapping: 'djumum_keterangan'}, 
			{name: 'djumum_debet', type: 'float', mapping: 'djumum_debet'}, 
			{name: 'djumum_kredit', type: 'float', mapping: 'djumum_kredit'} 
	]);
	//eof
	
	//function for json writer of detail
	var jurnal_umum_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	jurnal_umum_detail_DataStore = new Ext.data.Store({
		id: 'jurnal_umum_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_umum&m=detail_jurnal_umum_detail_list', 
			method: 'POST'
		}),
		reader: jurnal_umum_detail_reader,
		baseParams:{master_id: jumum_idField.getValue()},
		sortInfo:{field: 'djumum_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_jurnal_umum_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	/* GET detail akun */
	cbo_djumum_akunDataStore = new Ext.data.Store({
		id: 'cbo_djumum_akunDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_umum&m=get_akun_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: 10}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jumum_akun_value', type: 'int', mapping: 'akun_id'},
			{name: 'jumum_akun_nama', type: 'string', mapping: 'akun_nama'},
			{name: 'jumum_akun_kode', type: 'string', mapping: 'akun_kode'}
		]),
		sortInfo:{field: 'jumum_akun_nama', direction: "ASC"}
	});
	/* END akun datasource */
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_djumum_akun=new Ext.form.ComboBox({
			store: cbo_djumum_akunDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'jumum_akun_nama',
			valueField: 'jumum_akun_value',
			triggerAction: 'all',
			lazyRender:true

	});
	
	//declaration of detail coloumn model
	jurnal_umum_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Akun',
			dataIndex: 'djumum_akun',
			width: 150,
			sortable: true,
			editor: combo_djumum_akun,
			renderer: Ext.util.Format.comboRenderer(combo_djumum_akun)
		},
		{
			header: 'Keterangan',
			dataIndex: 'djumum_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Debet',
			dataIndex: 'djumum_debet',
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
			header: 'Kredit',
			dataIndex: 'djumum_kredit',
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
		}]
	);
	jurnal_umum_detail_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	jurnal_umum_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_umum_detailListEditorGrid',
		el: 'fp_jurnal_umum_detail',
		title: 'Detail jurnal_umum_detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: jurnal_umum_detail_DataStore, // DataStore
		colModel: jurnal_umum_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_jurnal_umum_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_umum_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: jurnal_umum_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: jurnal_umum_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function jurnal_umum_detail_add(){
		var edit_jurnal_umum_detail= new jurnal_umum_detailListEditorGrid.store.recordType({
			djumum_id	:'',		
			djumum_master	:'',		
			djumum_akun	:'',		
			djumum_keterangan	:'',		
			djumum_debet	:'',		
			djumum_kredit	:''		
		});
		editor_jurnal_umum_detail.stopEditing();
		jurnal_umum_detail_DataStore.insert(0, edit_jurnal_umum_detail);
		jurnal_umum_detailListEditorGrid.getView().refresh();
		jurnal_umum_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_jurnal_umum_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_jurnal_umum_detail(){
		jurnal_umum_detail_DataStore.commitChanges();
		jurnal_umum_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function jurnal_umum_detail_insert(){
		for(i=0;i<jurnal_umum_detail_DataStore.getCount();i++){
			jurnal_umum_detail_record=jurnal_umum_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_umum&m=detail_jurnal_umum_detail_insert',
				params:{
				djumum_id	: jurnal_umum_detail_record.data.djumum_id, 
				djumum_master	: eval(jumum_idField.getValue()), 
				djumum_akun	: jurnal_umum_detail_record.data.djumum_akun, 
				djumum_keterangan	: jurnal_umum_detail_record.data.djumum_keterangan, 
				djumum_debet	: jurnal_umum_detail_record.data.djumum_debet, 
				djumum_kredit	: jurnal_umum_detail_record.data.djumum_kredit 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function jurnal_umum_detail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_umum&m=detail_jurnal_umum_detail_purge',
			params:{ master_id: eval(jumum_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function jurnal_umum_detail_confirm_delete(){
		// only one record is selected here
		if(jurnal_umum_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_umum_detail_delete);
		} else if(jurnal_umum_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_umum_detail_delete);
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
	function jurnal_umum_detail_delete(btn){
		if(btn=='yes'){
			var s = jurnal_umum_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				jurnal_umum_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	jurnal_umum_detail_DataStore.on('update', refresh_jurnal_umum_detail);
	
	/* Function for retrieve create Window Panel*/ 
	jurnal_umum_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [jurnal_umum_masterGroup,jurnal_umum_detailListEditorGrid,jurnal_umum_dtotal_nilaiGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: jurnal_umum_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					jurnal_umum_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jurnal_umum_createWindow= new Ext.Window({
		id: 'jurnal_umum_createWindow',
		title: post2db+'Jurnal_umum',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jurnal_umum_create',
		items: jurnal_umum_createForm
	});
	/* End Window */
	
	function detail_jumum_dtotaldk(){
		var total_kredit=0;
		var total_debet=0;
		for(i=0;i<jurnal_umum_detail_DataStore.getCount();i++){
			detail_jumum_record=jurnal_umum_detail_DataStore.getAt(i);
			total_kredit=total_kredit+detail_jumum_record.data.djumum_kredit;
			total_debet=total_debet+detail_jumum_record.data.djumum_debet;
		}
		jumum_dtotal_kreditField.setValue(total_kredit);
		jumum_dtotal_debetField.setValue(total_debet);
	}
	
	jurnal_umum_detail_DataStore.on('update',detail_jumum_dtotaldk);
	jurnal_umum_detail_DataStore.on('load',detail_jumum_dtotaldk);
	
	/* Function for action list search */
	function jurnal_umum_list_search(){
		// render according to a SQL date format.
		var jumum_id_search=null;
		var jumum_tanggal_search_date="";
		var jumum_pengguna_search=null;
		var jumum_keterangan_search=null;
		var jumum_posting_search=null;
		var jumum_tglposting_search_date="";

		if(jumum_idSearchField.getValue()!==null){jumum_id_search=jumum_idSearchField.getValue();}
		if(jumum_tanggalSearchField.getValue()!==""){jumum_tanggal_search_date=jumum_tanggalSearchField.getValue().format('Y-m-d');}
		if(jumum_penggunaSearchField.getValue()!==null){jumum_pengguna_search=jumum_penggunaSearchField.getValue();}
		if(jumum_keteranganSearchField.getValue()!==null){jumum_keterangan_search=jumum_keteranganSearchField.getValue();}
		if(jumum_postingSearchField.getValue()!==null){jumum_posting_search=jumum_postingSearchField.getValue();}
		if(jumum_tglpostingSearchField.getValue()!==""){jumum_tglposting_search_date=jumum_tglpostingSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		jurnal_umum_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jumum_id	:	jumum_id_search, 
			jumum_tanggal	:	jumum_tanggal_search_date, 
			jumum_pengguna	:	jumum_pengguna_search, 
			jumum_keterangan	:	jumum_keterangan_search, 
			jumum_posting	:	jumum_posting_search, 
			jumum_tglposting	:	jumum_tglposting_search_date, 
		};
		// Cause the datastore to do another query : 
		jurnal_umum_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jurnal_umum_reset_search(){
		// reset the store parameters
		jurnal_umum_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jurnal_umum_DataStore.reload({params: {start: 0, limit: pageS}});
		jurnal_umum_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  jumum_id Search Field */
	jumum_idSearchField= new Ext.form.NumberField({
		id: 'jumum_idSearchField',
		fieldLabel: 'Jumum Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jumum_tanggal Search Field */
	jumum_tanggalSearchField= new Ext.form.DateField({
		id: 'jumum_tanggalSearchField',
		fieldLabel: 'Jumum Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jumum_pengguna Search Field */
	jumum_penggunaSearchField= new Ext.form.TextField({
		id: 'jumum_penggunaSearchField',
		fieldLabel: 'Jumum Pengguna',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  jumum_keterangan Search Field */
	jumum_keteranganSearchField= new Ext.form.TextField({
		id: 'jumum_keteranganSearchField',
		fieldLabel: 'Jumum Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  jumum_posting Search Field */
	jumum_postingSearchField= new Ext.form.ComboBox({
		id: 'jumum_postingSearchField',
		fieldLabel: 'Jumum Posting',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jumum_posting'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jumum_posting',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jumum_tglposting Search Field */
	jumum_tglpostingSearchField= new Ext.form.DateField({
		id: 'jumum_tglpostingSearchField',
		fieldLabel: 'Jumum Tglposting',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	jurnal_umum_searchForm = new Ext.FormPanel({
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
				items: [jumum_idSearchField, jumum_tanggalSearchField, jumum_penggunaSearchField, jumum_keteranganSearchField, jumum_postingSearchField, jumum_tglpostingSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jurnal_umum_list_search
			},{
				text: 'Close',
				handler: function(){
					jurnal_umum_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	jurnal_umum_searchWindow = new Ext.Window({
		title: 'jurnal_umum Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jurnal_umum_search',
		items: jurnal_umum_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jurnal_umum_searchWindow.isVisible()){
			jurnal_umum_searchWindow.show();
		} else {
			jurnal_umum_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jurnal_umum_print(){
		var searchquery = "";
		var jumum_id_print=null;
		var jumum_tanggal_print_date="";
		var jumum_pengguna_print=null;
		var jumum_keterangan_print=null;
		var jumum_posting_print=null;
		var jumum_tglposting_print_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_umum_DataStore.baseParams.query!==null){searchquery = jurnal_umum_DataStore.baseParams.query;}
		if(jurnal_umum_DataStore.baseParams.jumum_id!==null){jumum_id_print = jurnal_umum_DataStore.baseParams.jumum_id;}
		if(jurnal_umum_DataStore.baseParams.jumum_tanggal!==""){jumum_tanggal_print_date = jurnal_umum_DataStore.baseParams.jumum_tanggal;}
		if(jurnal_umum_DataStore.baseParams.jumum_pengguna!==null){jumum_pengguna_print = jurnal_umum_DataStore.baseParams.jumum_pengguna;}
		if(jurnal_umum_DataStore.baseParams.jumum_keterangan!==null){jumum_keterangan_print = jurnal_umum_DataStore.baseParams.jumum_keterangan;}
		if(jurnal_umum_DataStore.baseParams.jumum_posting!==null){jumum_posting_print = jurnal_umum_DataStore.baseParams.jumum_posting;}
		if(jurnal_umum_DataStore.baseParams.jumum_tglposting!==""){jumum_tglposting_print_date = jurnal_umum_DataStore.baseParams.jumum_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_umum&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jumum_id : jumum_id_print,
		  	jumum_tanggal : jumum_tanggal_print_date, 
			jumum_pengguna : jumum_pengguna_print,
			jumum_keterangan : jumum_keterangan_print,
			jumum_posting : jumum_posting_print,
		  	jumum_tglposting : jumum_tglposting_print_date, 
		  	currentlisting: jurnal_umum_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./jurnal_umumlist.html','jurnal_umumlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jurnal_umum_export_excel(){
		var searchquery = "";
		var jumum_id_2excel=null;
		var jumum_tanggal_2excel_date="";
		var jumum_pengguna_2excel=null;
		var jumum_keterangan_2excel=null;
		var jumum_posting_2excel=null;
		var jumum_tglposting_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_umum_DataStore.baseParams.query!==null){searchquery = jurnal_umum_DataStore.baseParams.query;}
		if(jurnal_umum_DataStore.baseParams.jumum_id!==null){jumum_id_2excel = jurnal_umum_DataStore.baseParams.jumum_id;}
		if(jurnal_umum_DataStore.baseParams.jumum_tanggal!==""){jumum_tanggal_2excel_date = jurnal_umum_DataStore.baseParams.jumum_tanggal;}
		if(jurnal_umum_DataStore.baseParams.jumum_pengguna!==null){jumum_pengguna_2excel = jurnal_umum_DataStore.baseParams.jumum_pengguna;}
		if(jurnal_umum_DataStore.baseParams.jumum_keterangan!==null){jumum_keterangan_2excel = jurnal_umum_DataStore.baseParams.jumum_keterangan;}
		if(jurnal_umum_DataStore.baseParams.jumum_posting!==null){jumum_posting_2excel = jurnal_umum_DataStore.baseParams.jumum_posting;}
		if(jurnal_umum_DataStore.baseParams.jumum_tglposting!==""){jumum_tglposting_2excel_date = jurnal_umum_DataStore.baseParams.jumum_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_umum&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jumum_id : jumum_id_2excel,
		  	jumum_tanggal : jumum_tanggal_2excel_date, 
			jumum_pengguna : jumum_pengguna_2excel,
			jumum_keterangan : jumum_keterangan_2excel,
			jumum_posting : jumum_posting_2excel,
		  	jumum_tglposting : jumum_tglposting_2excel_date, 
		  	currentlisting: jurnal_umum_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_jurnal_umum"></div>
         <div id="fp_jurnal_umum_detail"></div>
		<div id="elwindow_jurnal_umum_create"></div>
        <div id="elwindow_jurnal_umum_search"></div>
    </div>
</div>
</body>