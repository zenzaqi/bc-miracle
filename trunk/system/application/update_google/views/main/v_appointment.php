<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: appointment View
	+ Description	: For record view
	+ Filename 		: v_appointment.php
 	+ Author  		: masongbee
 	+ Created on 29/Oct/2009 13:33:53
	
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
var appointment_DataStore;
var appointment_ColumnModel;
var appointmentListEditorGrid;
var appointment_createForm;
var appointment_createWindow;
var appointment_searchForm;
var appointment_searchWindow;
var appointment_SelectedRow;
var appointment_ContextMenu;
//for detail data
var appointment_detail_DataStor;
var appointment_detailListEditorGrid;
var appointment_detail_ColumnModel;
var appointment_detail_proxy;
var appointment_detail_writer;
var appointment_detail_reader;
var editor_appointment_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var app_idField;
var app_customerField;
var app_tanggalField;
var app_caraField;
var app_keteranganField;
var app_idSearchField;
var app_customerSearchField;
var app_tanggalSearchField;
var app_caraSearchField;
var app_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function appointment_update(oGrid_event){
		var app_id_update_pk="";
		var app_customer_update=null;
		var app_tanggal_update_date="";
		var app_cara_update=null;
		var app_keterangan_update=null;

		app_id_update_pk = oGrid_event.record.data.app_id;
		if(oGrid_event.record.data.app_customer!== null){app_customer_update = oGrid_event.record.data.app_customer;}
	 	if(oGrid_event.record.data.app_tanggal!== ""){app_tanggal_update_date =oGrid_event.record.data.app_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.app_cara!== null){app_cara_update = oGrid_event.record.data.app_cara;}
		if(oGrid_event.record.data.app_keterangan!== null){app_keterangan_update = oGrid_event.record.data.app_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_appointment&m=get_action',
			params: {
				task: "UPDATE",
				app_id	: app_id_update_pk, 
				app_customer	:app_customer_update,  
				app_tanggal	: app_tanggal_update_date, 
				app_cara	:app_cara_update,  
				app_keterangan	:app_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						appointment_DataStore.commitChanges();
						appointment_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the appointment.',
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
	function appointment_create(){
	
		if(is_appointment_form_valid()){	
		var app_id_create_pk=null; 
		var app_customer_create=null; 
		var app_tanggal_create_date=""; 
		var app_cara_create=null; 
		var app_keterangan_create=null; 

		if(app_idField.getValue()!== null){app_id_create = app_idField.getValue();}else{app_id_create_pk=get_pk_id();} 
		if(app_customerField.getValue()!== null){app_customer_create = app_customerField.getValue();} 
		if(app_tanggalField.getValue()!== ""){app_tanggal_create_date = app_tanggalField.getValue().format('Y-m-d');} 
		if(app_caraField.getValue()!== null){app_cara_create = app_caraField.getValue();} 
		if(app_keteranganField.getValue()!== null){app_keterangan_create = app_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_appointment&m=get_action',
			params: {
				task: post2db,
				app_id	: app_id_create_pk, 
				app_customer	: app_customer_create, 
				app_tanggal	: app_tanggal_create_date, 
				app_cara	: app_cara_create, 
				app_keterangan	: app_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						appointment_detail_purge()
						appointment_detail_insert();
						Ext.MessageBox.alert(post2db+' OK','The Appointment was '+msg+' successfully.');
						appointment_DataStore.reload();
						appointment_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Appointment.',
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
			return appointmentListEditorGrid.getSelectionModel().getSelected().get('app_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function appointment_reset_form(){
		app_idField.reset();
		app_idField.setValue(null);
		app_customerField.reset();
		app_customerField.setValue(null);
		app_tanggalField.reset();
		app_tanggalField.setValue(null);
		app_caraField.reset();
		app_caraField.setValue(null);
		app_keteranganField.reset();
		app_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function appointment_set_form(){
		app_idField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_id'));
		app_customerField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_customer'));
		app_tanggalField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_tanggal'));
		app_caraField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_cara'));
		app_keteranganField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_appointment_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!appointment_createWindow.isVisible()){
			appointment_reset_form();
			post2db='CREATE';
			msg='created';
			appointment_createWindow.show();
		} else {
			appointment_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function appointment_confirm_delete(){
		// only one appointment is selected here
		if(appointmentListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', appointment_delete);
		} else if(appointmentListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', appointment_delete);
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
	function appointment_confirm_update(){
		/* only one record is selected here */
		if(appointmentListEditorGrid.selModel.getCount() == 1) {
			appointment_set_form();
			post2db='UPDATE';
			appointment_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			appointment_createWindow.show();
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
	function appointment_delete(btn){
		if(btn=='yes'){
			var selections = appointmentListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< appointmentListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.app_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_appointment&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							appointment_DataStore.reload();
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
	appointment_DataStore = new Ext.data.Store({
		id: 'appointment_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'//,
			//id: 'app_id'
		},[
		/* dataIndex => insert intoappointment_ColumnModel, Mapping => for initiate table column */ 
			{name: 'app_id', type: 'int', mapping: 'app_id'}, 
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'}, 
			{name: 'rawat_nama', type: 'string', mapping: 'rawat_nama'}, 
			{name: 'dapp_jamreservasi', type: 'string', mapping: 'dapp_jamreservasi'}, 
			{name: 'karyawan_nama', type: 'string', mapping: 'karyawan_nama'}, 
			{name: 'kategori_nama', type: 'string', mapping: 'kategori_nama'}, 
			{name: 'dapp_status', type: 'string', mapping: 'dapp_status'}, 
			{name: 'app_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'app_tanggal'}, 
			//{name: 'app_cara', type: 'string', mapping: 'app_cara'}, 
			//{name: 'app_keterangan', type: 'string', mapping: 'app_keterangan'}, 
			{name: 'app_creator', type: 'string', mapping: 'app_creator'}, 
			{name: 'app_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'app_date_create'}, 
			{name: 'app_update', type: 'string', mapping: 'app_update'}, 
			{name: 'app_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'app_date_update'}, 
			{name: 'app_revised', type: 'int', mapping: 'app_revised'} 
		]),
		sortInfo:{field: 'dapp_jamreservasi', direction: "ASC"}

	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	appointment_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Jam Reservasi',
			dataIndex: 'dapp_jamreservasi',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Perawatan',
			dataIndex: 'rawat_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Customer',
			dataIndex: 'cust_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Dokter/Therapist',
			dataIndex: 'karyawan_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Perawatan',
			dataIndex: 'rawat_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Kategori',
			dataIndex: 'kategori_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Status',
			dataIndex: 'dapp_status',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'app_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'App Creator',
			dataIndex: 'app_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'App Date Create',
			dataIndex: 'app_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'App Update',
			dataIndex: 'app_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'App Date Update',
			dataIndex: 'app_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'App Revised',
			dataIndex: 'app_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	appointment_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	appointmentListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'appointmentListEditorGrid',
		el: 'fp_appointment',
		title: 'List Of Appointment',
		autoHeight: true,
		store: appointment_DataStore, // DataStore
		cm: appointment_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: appointment_DataStore,
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
			handler: appointment_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: appointment_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: appointment_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: appointment_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: appointment_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: appointment_print  
		}
		]
	});
	appointmentListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	appointment_ContextMenu = new Ext.menu.Menu({
		id: 'appointment_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: appointment_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: appointment_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: appointment_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: appointment_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onappointment_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		appointment_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		appointment_SelectedRow=rowIndex;
		appointment_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function appointment_editContextMenu(){
		appointmentListEditorGrid.startEditing(appointment_SelectedRow,1);
  	}
	/* End of Function */
  	
	appointmentListEditorGrid.addListener('rowcontextmenu', onappointment_ListEditGridContextMenu);
	appointment_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	appointmentListEditorGrid.on('afteredit', appointment_update); // inLine Editing Record
	
	/* Identify  app_id Field */
	app_idField= new Ext.form.NumberField({
		id: 'app_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  app_customer Field */
	app_customerField= new Ext.form.NumberField({
		id: 'app_customerField',
		fieldLabel: 'App Customer',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  app_tanggal Field */
	app_tanggalField= new Ext.form.DateField({
		id: 'app_tanggalField',
		fieldLabel: 'App Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  app_cara Field */
	app_caraField= new Ext.form.ComboBox({
		id: 'app_caraField',
		fieldLabel: 'App Cara',
		store:new Ext.data.SimpleStore({
			fields:['app_cara_value', 'app_cara_display'],
			data:[['Datang','Datang'],['Telp','Telp'],['SMS','SMS']]
		}),
		mode: 'local',
		displayField: 'app_cara_display',
		valueField: 'app_cara_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  app_keterangan Field */
	app_keteranganField= new Ext.form.TextField({
		id: 'app_keteranganField',
		fieldLabel: 'App Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	appointment_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [app_idField, app_customerField, app_tanggalField, app_caraField, app_keteranganField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var appointment_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dapp_id', type: 'int', mapping: 'dapp_id'}, 
			{name: 'dapp_master', type: 'int', mapping: 'dapp_master'}, 
			{name: 'dapp_perawatan', type: 'int', mapping: 'dapp_perawatan'}, 
			{name: 'dapp_tglreservasi', type: 'date', dateFormat: 'Y-m-d', mapping: 'dapp_tglreservasi'}, 
			{name: 'dapp_jamreservasi', type: 'string', mapping: 'dapp_jamreservasi'}, 
			{name: 'dapp_petugas', type: 'int', mapping: 'dapp_petugas'}, 
			{name: 'dapp_petugas2', type: 'int', mapping: 'dapp_petugas2'}, 
			{name: 'dapp_status', type: 'string', mapping: 'dapp_status'}, 
			{name: 'dapp_tgldatang', type: 'date', dateFormat: 'Y-m-d', mapping: 'dapp_tgldatang'}, 
			{name: 'dapp_jamdatang', type: 'string', mapping: 'dapp_jamdatang'} 
	]);
	//eof
	
	//function for json writer of detail
	var appointment_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	appointment_detail_DataStore = new Ext.data.Store({
		id: 'appointment_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=detail_appointment_detail_list', 
			method: 'POST'
		}),
		reader: appointment_detail_reader,
		baseParams:{master_id: app_idField.getValue()},
		sortInfo:{field: 'dapp_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_appointment_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	appointment_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Dapp Perawatan',
			dataIndex: 'dapp_perawatan',
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
			header: 'Dapp Tglreservasi',
			dataIndex: 'dapp_tglreservasi',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Dapp Jamreservasi',
			dataIndex: 'dapp_jamreservasi',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 8
          	})
		},
		{
			header: 'Dapp Petugas',
			dataIndex: 'dapp_petugas',
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
			header: 'Dapp Petugas2',
			dataIndex: 'dapp_petugas2',
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
			header: 'Dapp Status',
			dataIndex: 'dapp_status',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dapp_status_value', 'dapp_status_display'],
					data: [['reservasi','reservasi'],['datang','datang'],['selesai','selesai'],['batal','batal']]
					}),
				mode: 'local',
               	displayField: 'dapp_status_display',
               	valueField: 'dapp_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Dapp Tgldatang',
			dataIndex: 'dapp_tgldatang',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Dapp Jamdatang',
			dataIndex: 'dapp_jamdatang',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 8
          	})
		}]
	);
	appointment_detail_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	appointment_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'appointment_detailListEditorGrid',
		el: 'fp_appointment_detail',
		title: 'Detail appointment_detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: appointment_detail_DataStore, // DataStore
		colModel: appointment_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_appointment_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: appointment_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: appointment_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: appointment_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function appointment_detail_add(){
		var edit_appointment_detail= new appointment_detailListEditorGrid.store.recordType({
			dapp_id	:'',		
			dapp_master	:'',		
			dapp_perawatan	:'',		
			dapp_tglreservasi	:'',		
			dapp_jamreservasi	:'',		
			dapp_petugas	:'',		
			dapp_petugas2	:'',		
			dapp_status	:'',		
			dapp_tgldatang	:'',		
			dapp_jamdatang	:''		
		});
		editor_appointment_detail.stopEditing();
		appointment_detail_DataStore.insert(0, edit_appointment_detail);
		appointment_detailListEditorGrid.getView().refresh();
		appointment_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_appointment_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_appointment_detail(){
		appointment_detail_DataStore.commitChanges();
		appointment_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function appointment_detail_insert(){
		for(i=0;i<appointment_detail_DataStore.getCount();i++){
			appointment_detail_record=appointment_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_appointment&m=detail_appointment_detail_insert',
				params:{
				dapp_id	: appointment_detail_record.data.dapp_id, 
				dapp_master	: eval(app_idField.getValue()), 
				dapp_perawatan	: appointment_detail_record.data.dapp_perawatan, 
				dapp_tglreservasi	: appointment_detail_record.data.dapp_tglreservasi.format('Y-m-d'),
				dapp_jamreservasi	: appointment_detail_record.data.dapp_jamreservasi, 
				dapp_petugas	: appointment_detail_record.data.dapp_petugas, 
				dapp_petugas2	: appointment_detail_record.data.dapp_petugas2, 
				dapp_status	: appointment_detail_record.data.dapp_status, 
				dapp_tgldatang	: appointment_detail_record.data.dapp_tgldatang.format('Y-m-d'),
				dapp_jamdatang	: appointment_detail_record.data.dapp_jamdatang 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function appointment_detail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_appointment&m=detail_appointment_detail_purge',
			params:{ master_id: eval(app_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function appointment_detail_confirm_delete(){
		// only one record is selected here
		if(appointment_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', appointment_detail_delete);
		} else if(appointment_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', appointment_detail_delete);
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
	function appointment_detail_delete(btn){
		if(btn=='yes'){
			var s = appointment_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				appointment_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	appointment_detail_DataStore.on('update', refresh_appointment_detail);
	
	/* Function for retrieve create Window Panel*/ 
	appointment_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [appointment_masterGroup,appointment_detailListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: appointment_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					appointment_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	appointment_createWindow= new Ext.Window({
		id: 'appointment_createWindow',
		title: post2db+'Appointment',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_appointment_create',
		items: appointment_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function appointment_list_search(){
		// render according to a SQL date format.
		var app_id_search=null;
		var app_customer_search=null;
		var app_tanggal_search_date="";
		var app_cara_search=null;
		var app_keterangan_search=null;

		if(app_idSearchField.getValue()!==null){app_id_search=app_idSearchField.getValue();}
		if(app_customerSearchField.getValue()!==null){app_customer_search=app_customerSearchField.getValue();}
		if(app_tanggalSearchField.getValue()!==""){app_tanggal_search_date=app_tanggalSearchField.getValue().format('Y-m-d');}
		if(app_caraSearchField.getValue()!==null){app_cara_search=app_caraSearchField.getValue();}
		if(app_keteranganSearchField.getValue()!==null){app_keterangan_search=app_keteranganSearchField.getValue();}
		// change the store parameters
		appointment_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			app_id	:	app_id_search, 
			app_customer	:	app_customer_search, 
			app_tanggal	:	app_tanggal_search_date, 
			app_cara	:	app_cara_search, 
			app_keterangan	:	app_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		appointment_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function appointment_reset_search(){
		// reset the store parameters
		appointment_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		appointment_DataStore.reload({params: {start: 0, limit: pageS}});
		appointment_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  app_id Search Field */
	app_idSearchField= new Ext.form.NumberField({
		id: 'app_idSearchField',
		fieldLabel: 'App Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  app_customer Search Field */
	app_customerSearchField= new Ext.form.NumberField({
		id: 'app_customerSearchField',
		fieldLabel: 'App Customer',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  app_tanggal Search Field */
	app_tanggalSearchField= new Ext.form.DateField({
		id: 'app_tanggalSearchField',
		fieldLabel: 'App Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  app_cara Search Field */
	app_caraSearchField= new Ext.form.ComboBox({
		id: 'app_caraSearchField',
		fieldLabel: 'App Cara',
		store:new Ext.data.SimpleStore({
			fields:['value', 'app_cara'],
			data:[['Datang','Datang'],['Telp','Telp'],['SMS','SMS']]
		}),
		mode: 'local',
		displayField: 'app_cara',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  app_keterangan Search Field */
	app_keteranganSearchField= new Ext.form.TextField({
		id: 'app_keteranganSearchField',
		fieldLabel: 'App Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	appointment_searchForm = new Ext.FormPanel({
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
				items: [app_customerSearchField, app_tanggalSearchField, app_caraSearchField, app_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: appointment_list_search
			},{
				text: 'Close',
				handler: function(){
					appointment_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	appointment_searchWindow = new Ext.Window({
		title: 'appointment Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_appointment_search',
		items: appointment_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!appointment_searchWindow.isVisible()){
			appointment_searchWindow.show();
		} else {
			appointment_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function appointment_print(){
		var searchquery = "";
		var app_customer_print=null;
		var app_tanggal_print_date="";
		var app_cara_print=null;
		var app_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(appointment_DataStore.baseParams.query!==null){searchquery = appointment_DataStore.baseParams.query;}
		if(appointment_DataStore.baseParams.app_customer!==null){app_customer_print = appointment_DataStore.baseParams.app_customer;}
		if(appointment_DataStore.baseParams.app_tanggal!==""){app_tanggal_print_date = appointment_DataStore.baseParams.app_tanggal;}
		if(appointment_DataStore.baseParams.app_cara!==null){app_cara_print = appointment_DataStore.baseParams.app_cara;}
		if(appointment_DataStore.baseParams.app_keterangan!==null){app_keterangan_print = appointment_DataStore.baseParams.app_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_appointment&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			app_customer : app_customer_print,
		  	app_tanggal : app_tanggal_print_date, 
			app_cara : app_cara_print,
			app_keterangan : app_keterangan_print,
		  	currentlisting: appointment_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./appointmentlist.html','appointmentlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function appointment_export_excel(){
		var searchquery = "";
		var app_customer_2excel=null;
		var app_tanggal_2excel_date="";
		var app_cara_2excel=null;
		var app_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(appointment_DataStore.baseParams.query!==null){searchquery = appointment_DataStore.baseParams.query;}
		if(appointment_DataStore.baseParams.app_customer!==null){app_customer_2excel = appointment_DataStore.baseParams.app_customer;}
		if(appointment_DataStore.baseParams.app_tanggal!==""){app_tanggal_2excel_date = appointment_DataStore.baseParams.app_tanggal;}
		if(appointment_DataStore.baseParams.app_cara!==null){app_cara_2excel = appointment_DataStore.baseParams.app_cara;}
		if(appointment_DataStore.baseParams.app_keterangan!==null){app_keterangan_2excel = appointment_DataStore.baseParams.app_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_appointment&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			app_customer : app_customer_2excel,
		  	app_tanggal : app_tanggal_2excel_date, 
			app_cara : app_cara_2excel,
			app_keterangan : app_keterangan_2excel,
		  	currentlisting: appointment_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_appointment"></div>
         <div id="fp_appointment_detail"></div>
		<div id="elwindow_appointment_create"></div>
        <div id="elwindow_appointment_search"></div>
    </div>
</div>
</body>