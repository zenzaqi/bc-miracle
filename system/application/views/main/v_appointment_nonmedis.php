<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: appointment View
	+ Description	: For record view
	+ Filename 		: v_appointment.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 12:41:17
	
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
var appointment_nonmedisDataStore;
var appointment_nonmedisColumnModel;
var appointment_nonmedisListEditorGrid;
var appointment_nonmedis_createForm;
var appointment_nonmedis_createWindow;
var appointment_nonmedis_searchForm;
var appointment_nonmedis_searchWindow;
var appointment_nonmedis_SelectedRow;
var appointment_nonmedisContextMenu;
//for detail data
var appointment_nonmedis_detailDataStore;
var appointment_nonmedis_detailListEditorGrid;
var appointment_nonmedis_detailColumnModel;
var appointment_nonmedis_detail_proxy;
var appointment_nonmedis_detail_writer;
var appointment_nonmedis_detail_reader;
var editor_appointment_nonmedis_detail;

var appointment_nonmedis_detailOnMasterListGrid;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var app_nonmedis_idField;
var app_nonmedis_customerField;
var app_nonmedis_tanggalField;
var app_nonmedis_caraField;
var app_nonmedis_keteranganField;
var app_nonmedis_idSearchField;
var app_nonmedis_customerSearchField;
var app_nonmedis_tanggalSearchField;
var app_nonmedis_caraSearchField;
var app_nonmedis_keteranganSearchField;

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
			url: 'index.php?c=c_appointment_nonmedis&m=get_action',
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
						appointment_nonmedisDataStore.commitChanges();
						appointment_nonmedisDataStore.reload();
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

		if(app_nonmedis_idField.getValue()!== null){app_id_create_pk = app_nonmedis_idField.getValue();}else{app_id_create_pk=get_pk_id();} 
		if(app_nonmedis_customerField.getValue()!== null){app_customer_create = app_nonmedis_customerField.getValue();} 
		if(app_nonmedis_tanggalField.getValue()!== ""){app_tanggal_create_date = app_nonmedis_tanggalField.getValue().format('Y-m-d');} 
		if(app_nonmedis_caraField.getValue()!== null){app_cara_create = app_nonmedis_caraField.getValue();} 
		if(app_nonmedis_keteranganField.getValue()!== null){app_keterangan_create = app_nonmedis_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_appointment_nonmedis&m=get_action',
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
						appointment_nonmedisDataStore.reload();
						appointment_nonmedis_createWindow.hide();
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
			return appointment_nonmedisListEditorGrid.getSelectionModel().getSelected().get('app_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function appointment_reset_form(){
		app_nonmedis_idField.reset();
		app_nonmedis_idField.setValue(null);
		app_nonmedis_customerField.reset();
		app_nonmedis_customerField.setValue(null);
		app_nonmedis_tanggalField.reset();
		app_nonmedis_tanggalField.setValue(null);
		app_nonmedis_caraField.reset();
		app_nonmedis_caraField.setValue(null);
		app_nonmedis_keteranganField.reset();
		app_nonmedis_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function appointment_set_form(){
		app_nonmedis_idField.setValue(appointment_nonmedisListEditorGrid.getSelectionModel().getSelected().get('app_id'));
		app_nonmedis_customerField.setValue(appointment_nonmedisListEditorGrid.getSelectionModel().getSelected().get('app_customer'));
		app_nonmedis_tanggalField.setValue(appointment_nonmedisListEditorGrid.getSelectionModel().getSelected().get('app_tanggal'));
		app_nonmedis_caraField.setValue(appointment_nonmedisListEditorGrid.getSelectionModel().getSelected().get('app_cara'));
		app_nonmedis_keteranganField.setValue(appointment_nonmedisListEditorGrid.getSelectionModel().getSelected().get('app_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_appointment_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!appointment_nonmedis_createWindow.isVisible()){
			appointment_reset_form();
			post2db='CREATE';
			msg='created';
			appointment_nonmedis_createWindow.show();
		} else {
			appointment_nonmedis_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function appointment_confirm_delete(){
		// only one appointment is selected here
		if(appointment_nonmedisListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', appointment_delete);
		} else if(appointment_nonmedisListEditorGrid.selModel.getCount() > 1){
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
		if(appointment_nonmedisListEditorGrid.selModel.getCount() == 1) {
			appointment_set_form();
			post2db='UPDATE';
			appointment_nonmedis_detailDataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			appointment_nonmedis_createWindow.show();
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
			var selections = appointment_nonmedisListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< appointment_nonmedisListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.app_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_appointment_nonmedis&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							appointment_nonmedisDataStore.reload();
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
	appointment_nonmedisDataStore = new Ext.data.Store({
		id: 'appointment_nonmedisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment_nonmedis&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'app_id'
		},[
		/* dataIndex => insert intoappointment_nonmedisColumnModel, Mapping => for initiate table column */ 
			{name: 'app_id', type: 'int', mapping: 'app_id'}, 
			{name: 'app_customer', type: 'string', mapping: 'cust_nama'}, 
			{name: 'app_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'app_tanggal'}, 
			{name: 'app_cara', type: 'string', mapping: 'app_cara'}, 
			{name: 'app_keterangan', type: 'string', mapping: 'app_keterangan'}, 
			{name: 'app_creator', type: 'string', mapping: 'app_creator'}, 
			{name: 'app_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'app_date_create'}, 
			{name: 'app_update', type: 'string', mapping: 'app_update'}, 
			{name: 'app_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'app_date_update'}, 
			{name: 'app_revised', type: 'int', mapping: 'app_revised'} 
		]),
		sortInfo:{field: 'app_id', direction: "DESC"}
	});
	/* End of Function */
	
	//ComboBox ambil data Customer
	cbo_app_cutomerDataStore = new Ext.data.Store({
		id: 'cbo_app_cutomerDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment_nonmedis&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: 10 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'cust_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'cust_id', type: 'int', mapping: 'cust_id'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'cust_no', direction: "ASC"}
	});
	//Template yang akan tampil di ComboBox
	var customer_app_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	appointment_nonmedisColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'app_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Customer',
			dataIndex: 'app_customer',
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
			dataIndex: 'app_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Cara',
			dataIndex: 'app_cara',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['app_cara_value', 'app_cara_display'],
					data: [['Datang','Datang'],['Telp','Telp'],['SMS','SMS']]
					}),
				mode: 'local',
               	displayField: 'app_cara_display',
               	valueField: 'app_cara_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'app_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'app_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'app_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'app_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'app_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'app_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	appointment_nonmedisColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	appointment_nonmedisListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'appointment_nonmedisListEditorGrid',
		el: 'fp_appointment_nonmedis',
		title: 'List Of Appointment',
		autoHeight: true,
		store: appointment_nonmedisDataStore, // DataStore
		cm: appointment_nonmedisColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: appointment_nonmedisDataStore,
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
			store: appointment_nonmedisDataStore,
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
	appointment_nonmedisListEditorGrid.render();
	/* End of DataStore */
	
	/* jika GridMASTER di click maka akan keluar detailnya di bawah GridMASTER */
	appointment_nonmedisListEditorGrid.on('rowclick', function (appointment_nonmedisListEditorGrid, rowIndex, eventObj){
		var grid_master = appointment_nonmedisListEditorGrid.getSelectionModel().getSelected();
		appointment_nonmedis_detailDataStore.load({params : {master_id : grid_master.get("app_id"), start:0, limit:pageS}});
	});
     
	/* Create Context Menu */
	appointment_nonmedisContextMenu = new Ext.menu.Menu({
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
		appointment_nonmedisContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		appointment_nonmedis_SelectedRow=rowIndex;
		appointment_nonmedisContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function appointment_editContextMenu(){
		appointment_nonmedisListEditorGrid.startEditing(appointment_nonmedis_SelectedRow,1);
  	}
	/* End of Function */
  	
	appointment_nonmedisListEditorGrid.addListener('rowcontextmenu', onappointment_ListEditGridContextMenu);
	appointment_nonmedisDataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	appointment_nonmedisListEditorGrid.on('afteredit', appointment_update); // inLine Editing Record
	
	/* Identify  app_id Field */
	app_nonmedis_idField= new Ext.form.NumberField({
		id: 'app_nonmedis_idField',
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
	app_nonmedis_customerField= new Ext.form.ComboBox({
		id: 'app_nonmedis_customerField',
		fieldLabel: 'Customer',
		store: cbo_app_cutomerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_app_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  app_tanggal Field */
	app_nonmedis_tanggalField= new Ext.form.DateField({
		id: 'app_nonmedis_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  app_cara Field */
	app_nonmedis_caraField= new Ext.form.ComboBox({
		id: 'app_nonmedis_caraField',
		fieldLabel: 'Cara',
		store:new Ext.data.SimpleStore({
			fields:['app_cara_value', 'app_cara_display'],
			data:[['Datang','Datang'],['Telp','Telp'],['SMS','SMS']]
		}),
		mode: 'local',
		displayField: 'app_cara_display',
		valueField: 'app_cara_value',
		width: 94,
		triggerAction: 'all'	
	});
	/* Identify  app_keterangan Field */
	app_nonmedis_keteranganField= new Ext.form.TextArea({
		id: 'app_nonmedis_keteranganField',
		fieldLabel: 'Keterangan',
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
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [app_nonmedis_customerField, app_nonmedis_tanggalField, app_nonmedis_caraField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [app_nonmedis_keteranganField, app_nonmedis_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var appointment_nonmedis_detail_reader=new Ext.data.JsonReader({
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
	var appointment_nonmedis_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	appointment_nonmedis_detailDataStore = new Ext.data.Store({
		id: 'appointment_nonmedis_detailDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment_nonmedis&m=detail_appointment_detail_list', 
			method: 'POST'
		}),
		reader: appointment_nonmedis_detail_reader,
		baseParams:{master_id: app_nonmedis_idField.getValue()},
		sortInfo:{field: 'dapp_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_appointment_nonmedis_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	cbo_dapp_dokterDataStore = new Ext.data.Store({
		id: 'cbo_dapp_dokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment_nonmedis&m=get_dokter_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'dokter_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'dokter_value', type: 'int', mapping: 'karyawan_id'}
		]),
		sortInfo:{field: 'dokter_display', direction: "ASC"}
	});
	
	cbo_dapp_terapisDataStore = new Ext.data.Store({
		id: 'cbo_dapp_terapisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment_nonmedis&m=get_terapis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'terapis_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'terapis_value', type: 'int', mapping: 'karyawan_id'}
		]),
		sortInfo:{field: 'terapis_display', direction: "ASC"}
	});
	
	cbo_dapp_rawatDataStore = new Ext.data.Store({
		id: 'cbo_dapp_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment_nonmedis&m=get_rawat_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'dapp_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'dapp_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'dapp_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'dapp_rawat_group', type: 'string', mapping: 'group_nama'},
			{name: 'dapp_rawat_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'dapp_rawat_du', type: 'float', mapping: 'rawat_du'},
			{name: 'dapp_rawat_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'dapp_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'dapp_rawat_display', direction: "ASC"}
	});
	var rawat_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dapp_rawat_kode}</b>| {dapp_rawat_display}<br/>Group: {dapp_rawat_group}<br/>',
			'Kategori: {dapp_rawat_kategori}</span>',
		'</div></tpl>'
    );
	
	Ext.util.Format.comboRenderer = function(combo){
		cbo_dapp_rawatDataStore.load();
		cbo_dapp_dokterDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_dapp_rawat=new Ext.form.ComboBox({
			store: cbo_dapp_rawatDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dapp_rawat_display',
			valueField: 'dapp_rawat_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:10,
			hideTrigger:false,
			tpl: rawat_jual_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var combo_dapp_dokter=new Ext.form.ComboBox({
			store: cbo_dapp_dokterDataStore,
			mode: 'remote',
			displayField: 'dokter_display',
			valueField: 'dokter_value',
			loadingText: 'Searching...',
			triggerAction: 'all',
			anchor: '95%'

	});
	
	var combo_dapp_terapis=new Ext.form.ComboBox({
			store: cbo_dapp_terapisDataStore,
			mode: 'remote',
			displayField: 'terapis_display',
			valueField: 'terapis_value',
			loadingText: 'Searching...',
			triggerAction: 'all',
			anchor: '95%'

	});
	
	//declaration of detail coloumn model
	appointment_nonmedis_detailColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Perawatan',
			dataIndex: 'dapp_perawatan',
			width: 170,
			sortable: true,
			editor: combo_dapp_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_rawat)
		},
		{
			header: 'Tgl Reservasi',
			dataIndex: 'dapp_tglreservasi',
			width: 130,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jam Reservasi',
			dataIndex: 'dapp_jamreservasi',
			width: 150,
			sortable: true,
			editor: new Ext.form.TimeField({
				format: 'H:i:s',
				minValue: '9:00',
				maxValue: '21:00',
				increment: 10,
				width: 94
			})
		},
		{
			header: 'Dokter',
			dataIndex: 'dapp_petugas',
			width: 150,
			sortable: true,
			hidden: true,
			editor: combo_dapp_dokter,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_dokter)
		},
		{
			header: 'Dokter/Therapist',
			dataIndex: 'dapp_petugas2',
			width: 150,
			sortable: true,
			editor: combo_dapp_terapis,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_terapis)
		},
		{
			header: 'Status',
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
			header: 'Tgl Datang',
			dataIndex: 'dapp_tgldatang',
			width: 150,
			sortable: true,
			hidden: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jam Datang',
			dataIndex: 'dapp_jamdatang',
			width: 150,
			sortable: true,
			hidden: true,
			editor: new Ext.form.TextField({
				maxLength: 8
          	})
		}]
	);
	appointment_nonmedis_detailColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	appointment_nonmedis_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'appointment_nonmedis_detailListEditorGrid',
		el: 'fp_appointment_nonmedis_detail',
		title: 'Detail appointment_detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: appointment_nonmedis_detailDataStore, // DataStore
		colModel: appointment_nonmedis_detailColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_appointment_nonmedis_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: appointment_nonmedis_detailDataStore,
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
	
	//DETAIL_LIST on MASTER_LIST
	appointment_nonmedis_detailOnMasterListGrid= new Ext.grid.GridPanel({
		id: 'appointment_nonmedis_detailOnMasterListGrid',
		renderTo: 'appointment_nonmedis_detail_onMasterList',
		title: 'Detail Appointment Medis',
		autoHeight: true,
		store: appointment_nonmedis_detailDataStore,
		cm: appointment_nonmedis_detailColumnModel,
		frame: true,
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: {
			forceFit:true
		},
		style: 'margin-top: 10px',
		width: 700
	});
	
	
	//function of detail add
	function appointment_detail_add(){
		var edit_appointment_detail= new appointment_nonmedis_detailListEditorGrid.store.recordType({
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
		editor_appointment_nonmedis_detail.stopEditing();
		appointment_nonmedis_detailDataStore.insert(0, edit_appointment_detail);
		appointment_nonmedis_detailListEditorGrid.getView().refresh();
		appointment_nonmedis_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_appointment_nonmedis_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_appointment_detail(){
		appointment_nonmedis_detailDataStore.commitChanges();
		appointment_nonmedis_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function appointment_detail_insert(){
		for(i=0;i<appointment_nonmedis_detailDataStore.getCount();i++){
			appointment_detail_record=appointment_nonmedis_detailDataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_appointment_nonmedis&m=detail_appointment_detail_insert',
				params:{
				dapp_id	: appointment_detail_record.data.dapp_id, 
				dapp_master	: eval(app_nonmedis_idField.getValue()), 
				dapp_perawatan	: appointment_detail_record.data.dapp_perawatan, 
				dapp_tglreservasi	: appointment_detail_record.data.dapp_tglreservasi.format('Y-m-d'),
				dapp_jamreservasi	: appointment_detail_record.data.dapp_jamreservasi, 
				dapp_petugas	: appointment_detail_record.data.dapp_petugas, 
				dapp_petugas2	: appointment_detail_record.data.dapp_petugas2, 
				dapp_status	: appointment_detail_record.data.dapp_status, 
				dapp_tgldatang	: '2009-10-29',
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
			url: 'index.php?c=c_appointment_nonmedis&m=detail_appointment_detail_purge',
			params:{ master_id: eval(app_nonmedis_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function appointment_detail_confirm_delete(){
		// only one record is selected here
		if(appointment_nonmedis_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', appointment_detail_delete);
		} else if(appointment_nonmedis_detailListEditorGrid.selModel.getCount() > 1){
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
			var s = appointment_nonmedis_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				appointment_nonmedis_detailDataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	appointment_nonmedis_detailDataStore.on('update', refresh_appointment_detail);
	
	/* Function for retrieve create Window Panel*/ 
	appointment_nonmedis_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [appointment_masterGroup,appointment_nonmedis_detailListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: appointment_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					appointment_nonmedis_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	appointment_nonmedis_createWindow= new Ext.Window({
		id: 'appointment_nonmedis_createWindow',
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
		renderTo: 'elwindow_appointment_nonmedis_create',
		items: appointment_nonmedis_createForm
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

		if(app_nonmedis_idSearchField.getValue()!==null){app_id_search=app_nonmedis_idSearchField.getValue();}
		if(app_nonmedis_customerSearchField.getValue()!==null){app_customer_search=app_nonmedis_customerSearchField.getValue();}
		if(app_nonmedis_tanggalSearchField.getValue()!==""){app_tanggal_search_date=app_nonmedis_tanggalSearchField.getValue().format('Y-m-d');}
		if(app_nonmedis_caraSearchField.getValue()!==null){app_cara_search=app_nonmedis_caraSearchField.getValue();}
		if(app_nonmedis_keteranganSearchField.getValue()!==null){app_keterangan_search=app_nonmedis_keteranganSearchField.getValue();}
		// change the store parameters
		appointment_nonmedisDataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			app_id	:	app_id_search, 
			app_customer	:	app_customer_search, 
			app_tanggal	:	app_tanggal_search_date, 
			app_cara	:	app_cara_search, 
			app_keterangan	:	app_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		appointment_nonmedisDataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function appointment_reset_search(){
		// reset the store parameters
		appointment_nonmedisDataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		appointment_nonmedisDataStore.reload({params: {start: 0, limit: pageS}});
		appointment_nonmedis_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  app_id Search Field */
	app_nonmedis_idSearchField= new Ext.form.NumberField({
		id: 'app_nonmedis_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  app_customer Search Field */
	app_nonmedis_customerSearchField= new Ext.form.NumberField({
		id: 'app_nonmedis_customerSearchField',
		fieldLabel: 'Customer',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  app_tanggal Search Field */
	app_nonmedis_tanggalSearchField= new Ext.form.DateField({
		id: 'app_nonmedis_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  app_cara Search Field */
	app_nonmedis_caraSearchField= new Ext.form.ComboBox({
		id: 'app_nonmedis_caraSearchField',
		fieldLabel: 'Cara',
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
	app_nonmedis_keteranganSearchField= new Ext.form.TextField({
		id: 'app_nonmedis_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	appointment_nonmedis_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
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
				items: [app_nonmedis_customerSearchField, app_nonmedis_tanggalSearchField, app_nonmedis_caraSearchField, app_nonmedis_keteranganSearchField] 
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
					appointment_nonmedis_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	appointment_nonmedis_searchWindow = new Ext.Window({
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
		renderTo: 'elwindow_appointment_nonmedis_search',
		items: appointment_nonmedis_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!appointment_nonmedis_searchWindow.isVisible()){
			appointment_nonmedis_searchWindow.show();
		} else {
			appointment_nonmedis_searchWindow.toFront();
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
		if(appointment_nonmedisDataStore.baseParams.query!==null){searchquery = appointment_nonmedisDataStore.baseParams.query;}
		if(appointment_nonmedisDataStore.baseParams.app_customer!==null){app_customer_print = appointment_nonmedisDataStore.baseParams.app_customer;}
		if(appointment_nonmedisDataStore.baseParams.app_tanggal!==""){app_tanggal_print_date = appointment_nonmedisDataStore.baseParams.app_tanggal;}
		if(appointment_nonmedisDataStore.baseParams.app_cara!==null){app_cara_print = appointment_nonmedisDataStore.baseParams.app_cara;}
		if(appointment_nonmedisDataStore.baseParams.app_keterangan!==null){app_keterangan_print = appointment_nonmedisDataStore.baseParams.app_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_appointment_nonmedis&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			app_customer : app_customer_print,
		  	app_tanggal : app_tanggal_print_date, 
			app_cara : app_cara_print,
			app_keterangan : app_keterangan_print,
		  	currentlisting: appointment_nonmedisDataStore.baseParams.task // this tells us if we are searching or not
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
		if(appointment_nonmedisDataStore.baseParams.query!==null){searchquery = appointment_nonmedisDataStore.baseParams.query;}
		if(appointment_nonmedisDataStore.baseParams.app_customer!==null){app_customer_2excel = appointment_nonmedisDataStore.baseParams.app_customer;}
		if(appointment_nonmedisDataStore.baseParams.app_tanggal!==""){app_tanggal_2excel_date = appointment_nonmedisDataStore.baseParams.app_tanggal;}
		if(appointment_nonmedisDataStore.baseParams.app_cara!==null){app_cara_2excel = appointment_nonmedisDataStore.baseParams.app_cara;}
		if(appointment_nonmedisDataStore.baseParams.app_keterangan!==null){app_keterangan_2excel = appointment_nonmedisDataStore.baseParams.app_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_appointment_nonmedis&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			app_customer : app_customer_2excel,
		  	app_tanggal : app_tanggal_2excel_date, 
			app_cara : app_cara_2excel,
			app_keterangan : app_keterangan_2excel,
		  	currentlisting: appointment_nonmedisDataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_appointment_nonmedis"></div>
         <div id="fp_appointment_nonmedis_detail"></div>
		<div id="elwindow_appointment_nonmedis_create"></div>
        <div id="elwindow_appointment_nonmedis_search"></div>
        <div id="appointment_nonmedis_detail_onMasterList"></div>
    </div>
</div>
</body>