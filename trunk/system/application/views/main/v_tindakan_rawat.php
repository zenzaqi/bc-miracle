<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan_rawat View
	+ Description	: For record view
	+ Filename 		: v_tindakan_rawat.php
 	+ Author  		: 
 	+ Created on 02/Sep/2009 12:35:55
	
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
var tindakan_rawat_DataStore;
var tindakan_rawat_ColumnModel;
var tindakan_rawatListEditorGrid;
var tindakan_rawat_createForm;
var tindakan_rawat_createWindow;
var tindakan_rawat_searchForm;
var tindakan_rawat_searchWindow;
var tindakan_rawat_SelectedRow;
var tindakan_rawat_ContextMenu;
//for detail data
var tindakan_rawat_detail_DataStor;
var tindakan_rawat_detailListEditorGrid;
var tindakan_rawat_detail_ColumnModel;
var tindakan_rawat_detail_proxy;
var tindakan_rawat_detail_writer;
var tindakan_rawat_detail_reader;
var editor_tindakan_rawat_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var trawat_idField;
var trawat_custField;
var trawat_petugasField;
var trawat_petugas2Field;
var trawat_keteranganField;
var trawat_idSearchField;
var trawat_custSearchField;
var trawat_petugasSearchField;
var trawat_petugas2SearchField;
var trawat_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function tindakan_rawat_update(oGrid_event){
		var trawat_id_update_pk="";
		var trawat_cust_update=null;
		var trawat_petugas_update=null;
		var trawat_petugas2_update=null;
		var trawat_keterangan_update=null;

		trawat_id_update_pk = oGrid_event.record.data.trawat_id;
		if(oGrid_event.record.data.trawat_cust!== null){trawat_cust_update = oGrid_event.record.data.trawat_cust;}
		if(oGrid_event.record.data.trawat_petugas!== null){trawat_petugas_update = oGrid_event.record.data.trawat_petugas;}
		if(oGrid_event.record.data.trawat_petugas2!== null){trawat_petugas2_update = oGrid_event.record.data.trawat_petugas2;}
		if(oGrid_event.record.data.trawat_keterangan!== null){trawat_keterangan_update = oGrid_event.record.data.trawat_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_rawat&m=get_action',
			params: {
				task: "UPDATE",
				trawat_id	: trawat_id_update_pk, 
				trawat_cust	:trawat_cust_update,  
				trawat_petugas	:trawat_petugas_update,  
				trawat_petugas2	:trawat_petugas2_update,  
				trawat_keterangan	:trawat_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						tindakan_rawat_DataStore.commitChanges();
						tindakan_rawat_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the tindakan_rawat.',
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
	function tindakan_rawat_create(){
	
		if(is_tindakan_rawat_form_valid()){	
		var trawat_id_create_pk=null; 
		var trawat_cust_create=null; 
		var trawat_petugas_create=null; 
		var trawat_petugas2_create=null; 
		var trawat_keterangan_create=null; 

		if(trawat_idField.getValue()!== null){trawat_id_create = trawat_idField.getValue();}else{trawat_id_create_pk=get_pk_id();} 
		if(trawat_custField.getValue()!== null){trawat_cust_create = trawat_custField.getValue();} 
		if(trawat_petugasField.getValue()!== null){trawat_petugas_create = trawat_petugasField.getValue();} 
		if(trawat_petugas2Field.getValue()!== null){trawat_petugas2_create = trawat_petugas2Field.getValue();} 
		if(trawat_keteranganField.getValue()!== null){trawat_keterangan_create = trawat_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_rawat&m=get_action',
			params: {
				task: post2db,
				trawat_id	: trawat_id_create_pk, 
				trawat_cust	: trawat_cust_create, 
				trawat_petugas	: trawat_petugas_create, 
				trawat_petugas2	: trawat_petugas2_create, 
				trawat_keterangan	: trawat_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						tindakan_rawat_detail_purge()
						tindakan_rawat_detail_insert();
						Ext.MessageBox.alert(post2db+' OK','The Tindakan_rawat was '+msg+' successfully.');
						tindakan_rawat_DataStore.reload();
						tindakan_rawat_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Tindakan_rawat.',
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
			return tindakan_rawatListEditorGrid.getSelectionModel().getSelected().get('trawat_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function tindakan_rawat_reset_form(){
		trawat_idField.reset();
		trawat_idField.setValue(null);
		trawat_custField.reset();
		trawat_custField.setValue(null);
		trawat_petugasField.reset();
		trawat_petugasField.setValue(null);
		trawat_petugas2Field.reset();
		trawat_petugas2Field.setValue(null);
		trawat_keteranganField.reset();
		trawat_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function tindakan_rawat_set_form(){
		trawat_idField.setValue(tindakan_rawatListEditorGrid.getSelectionModel().getSelected().get('trawat_id'));
		trawat_custField.setValue(tindakan_rawatListEditorGrid.getSelectionModel().getSelected().get('trawat_cust'));
		trawat_petugasField.setValue(tindakan_rawatListEditorGrid.getSelectionModel().getSelected().get('trawat_petugas'));
		trawat_petugas2Field.setValue(tindakan_rawatListEditorGrid.getSelectionModel().getSelected().get('trawat_petugas2'));
		trawat_keteranganField.setValue(tindakan_rawatListEditorGrid.getSelectionModel().getSelected().get('trawat_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_tindakan_rawat_form_valid(){
		return (true &&  trawat_custField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!tindakan_rawat_createWindow.isVisible()){
			tindakan_rawat_reset_form();
			post2db='CREATE';
			msg='created';
			tindakan_rawat_createWindow.show();
		} else {
			tindakan_rawat_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function tindakan_rawat_confirm_delete(){
		// only one tindakan_rawat is selected here
		if(tindakan_rawatListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_rawat_delete);
		} else if(tindakan_rawatListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_rawat_delete);
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
	function tindakan_rawat_confirm_update(){
		/* only one record is selected here */
		if(tindakan_rawatListEditorGrid.selModel.getCount() == 1) {
			tindakan_rawat_set_form();
			post2db='UPDATE';
			tindakan_rawat_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			tindakan_rawat_createWindow.show();
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
	function tindakan_rawat_delete(btn){
		if(btn=='yes'){
			var selections = tindakan_rawatListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< tindakan_rawatListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.trawat_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_tindakan_rawat&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							tindakan_rawat_DataStore.reload();
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
	tindakan_rawat_DataStore = new Ext.data.Store({
		id: 'tindakan_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_rawat&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'trawat_id'
		},[
		/* dataIndex => insert intotindakan_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'trawat_id', type: 'int', mapping: 'trawat_id'}, 
			{name: 'trawat_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'trawat_petugas', type: 'string', mapping: 'petugas_nama1'}, 
			{name: 'trawat_petugas2', type: 'string', mapping: 'petugas_nama2'}, 
			{name: 'trawat_keterangan', type: 'string', mapping: 'trawat_keterangan'}, 
			{name: 'trawat_creator', type: 'string', mapping: 'trawat_creator'}, 
			{name: 'trawat_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'trawat_date_create'}, 
			{name: 'trawat_update', type: 'string', mapping: 'trawat_update'}, 
			{name: 'trawat_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'trawat_date_update'}, 
			{name: 'trawat_revised', type: 'int', mapping: 'trawat_revised'} 
		]),
		sortInfo:{field: 'trawat_id', direction: "DESC"}
	});
	/* End of Function */
    
	/* Function for Retrieve DataStore */
	cbo_cust_tindakan_DataStore = new Ext.data.Store({
		id: 'cbo_cust_tindakan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_rawat&m=get_customer_list', 
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
	
	var customer_tindakan_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	
	cbo_tindakan_petugasDataStore = new Ext.data.Store({
		id: 'cbo_tindakan_petugasDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_rawat&m=get_karyawan_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'tindakan_petugas_id', type: 'int', mapping: 'karyawan_id'},
			{name: 'tindakan_petugas_nama', type: 'string', mapping: 'karyawan_nama'},
			{name: 'tindakan_petugas_no', type: 'string', mapping: 'karyawan_no'},
			{name: 'tindakan_petugas_jabatan', type: 'string', mapping: 'jabatan_nama'}
		]),
		sortInfo:{field: 'tindakan_petugas_nama', direction: "ASC"}
	});
	
	var tindakan_petugas_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{tindakan_petugas_no}</b>| {tindakan_petugas_nama}<br/>Jabatan: {tindakan_petugas_jabatan}<br/></span>',
		'</div></tpl>'
    );
	
  	/* Function for Identify of Window Column Model */
	tindakan_rawat_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'trawat_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Customer',
			dataIndex: 'trawat_cust',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Petugas 1',
			dataIndex: 'trawat_petugas',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Petugas 2',
			dataIndex: 'trawat_petugas2',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'trawat_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'trawat_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Create on',
			dataIndex: 'trawat_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update By',
			dataIndex: 'trawat_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'trawat_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'trawat_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	tindakan_rawat_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	tindakan_rawatListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'tindakan_rawatListEditorGrid',
		el: 'fp_tindakan_rawat',
		title: 'List Of Tindakan Perawatan',
		autoHeight: true,
		store: tindakan_rawat_DataStore, // DataStore
		cm: tindakan_rawat_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: tindakan_rawat_DataStore,
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
			handler: tindakan_rawat_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: tindakan_rawat_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: tindakan_rawat_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: tindakan_rawat_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tindakan_rawat_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tindakan_rawat_print  
		}
		]
	});
	tindakan_rawatListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	tindakan_rawat_ContextMenu = new Ext.menu.Menu({
		id: 'tindakan_rawat_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: tindakan_rawat_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: tindakan_rawat_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tindakan_rawat_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tindakan_rawat_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function ontindakan_rawat_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		tindakan_rawat_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		tindakan_rawat_SelectedRow=rowIndex;
		tindakan_rawat_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function tindakan_rawat_editContextMenu(){
		tindakan_rawatListEditorGrid.startEditing(tindakan_rawat_SelectedRow,1);
  	}
	/* End of Function */
  	
	tindakan_rawatListEditorGrid.addListener('rowcontextmenu', ontindakan_rawat_ListEditGridContextMenu);
	tindakan_rawat_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	tindakan_rawatListEditorGrid.on('afteredit', tindakan_rawat_update); // inLine Editing Record
	
	/* Identify  trawat_id Field */
	trawat_idField= new Ext.form.NumberField({
		id: 'trawat_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  trawat_cust Field */
	trawat_custField= new Ext.form.ComboBox({
		id: 'trawat_custField',
		fieldLabel: 'Customer ',
		store: cbo_cust_tindakan_DataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_tindakan_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  trawat_petugas Field */
	trawat_petugasField= new Ext.form.ComboBox({
		id: 'trawat_petugasField',
		fieldLabel: 'Petugas 1',
		store: cbo_tindakan_petugasDataStore,
		mode: 'remote',
		typeAhead: true,
		displayField: 'tindakan_petugas_nama',
		valueField: 'tindakan_petugas_id',
		typeAhead: false,
		loadingText: 'Searching...',
		pageSize:10,
		hideTrigger:false,
		tpl: tindakan_petugas_tpl,
		//applyTo: 'search',
		itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  trawat_petugas2 Field */
	trawat_petugas2Field= new Ext.form.ComboBox({
		id: 'trawat_petugas2Field',
		fieldLabel: 'Petugas 2',
		store: cbo_tindakan_petugasDataStore,
		mode: 'remote',
		typeAhead: true,
		displayField: 'tindakan_petugas_nama',
		valueField: 'tindakan_petugas_id',
		typeAhead: false,
		loadingText: 'Searching...',
		pageSize:10,
		hideTrigger:false,
		tpl: tindakan_petugas_tpl,
		//applyTo: 'search',
		itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  trawat_keterangan Field */
	trawat_keteranganField= new Ext.form.TextArea({
		id: 'trawat_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	tindakan_rawat_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [trawat_custField, trawat_keteranganField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [ trawat_petugasField, trawat_petugas2Field, trawat_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var tindakan_rawat_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'}, 
			{name: 'dtrawat_master', type: 'int', mapping: 'dtrawat_master'}, 
			{name: 'dtrawat_perawatan', type: 'int', mapping: 'dtrawat_perawatan'}, 
			{name: 'dtrawat_status', type: 'string', mapping: 'dtrawat_status'} 
	]);
	//eof
	
	cbo_tindakan_rawatDataStore = new Ext.data.Store({
		id: 'cbo_tindakan_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_rawat&m=get_rawat_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'tindakan_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'tindakan_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'tindakan_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'tindakan_rawat_group', type: 'string', mapping: 'group_nama'},
			{name: 'tindakan_rawat_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'tindakan_rawat_du', type: 'float', mapping: 'rawat_du'},
			{name: 'tindakan_rawat_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'tindakan_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'tindakan_rawat_display', direction: "ASC"}
	});
	
	Ext.util.Format.comboRenderer = function(combo){
		cbo_tindakan_rawatDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var tindakan_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{tindakan_rawat_kode}</b>| {tindakan_rawat_display}<br/>Group: {tindakan_rawat_group}<br/>',
			'Kategori: {tindakan_rawat_kategori}</span>',
		'</div></tpl>'
    );
	
	var combo_tindakan_rawat=new Ext.form.ComboBox({
			store: cbo_tindakan_rawatDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'tindakan_rawat_display',
			valueField: 'tindakan_rawat_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:10,
			hideTrigger:false,
			tpl: tindakan_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	//function for json writer of detail
	var tindakan_rawat_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	tindakan_rawat_detail_DataStore = new Ext.data.Store({
		id: 'tindakan_rawat_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_rawat&m=detail_tindakan_rawat_detail_list', 
			method: 'POST'
		}),
		reader: tindakan_rawat_detail_reader,
		baseParams:{master_id: trawat_idField.getValue()},
		sortInfo:{field: 'dtrawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	
	//function for editor of detail
	var editor_tindakan_rawat_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	tindakan_rawat_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Perawatan',
			dataIndex: 'dtrawat_perawatan',
			width: 150,
			sortable: true,
			editor: combo_tindakan_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_tindakan_rawat)
		},
		{
			header: 'Status',
			dataIndex: 'dtrawat_status',
			width: 50,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dtrawat_status_value', 'dtrawat_status_display'],
					data: [['batal','batal'],['selesai','selesai'],['datang','datang']]
					}),
				mode: 'local',
               	displayField: 'dtrawat_status_display',
               	valueField: 'dtrawat_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}]
	);
	tindakan_rawat_detail_ColumnModel.defaultSortable= true;
	//eof
	
	//declaration of detail list editor grid
	tindakan_rawat_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'tindakan_rawat_detailListEditorGrid',
		el: 'fp_tindakan_rawat_detail',
		title: 'Detail Tindakan Perawatan',
		height: 250,
		width: 690,
		autoScroll: true,
		store: tindakan_rawat_detail_DataStore, // DataStore
		colModel: tindakan_rawat_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_tindakan_rawat_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: tindakan_rawat_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: tindakan_rawat_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: tindakan_rawat_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function tindakan_rawat_detail_add(){
		var edit_tindakan_rawat_detail= new tindakan_rawat_detailListEditorGrid.store.recordType({
			dtrawat_id	:'',		
			dtrawat_master	:'',		
			dtrawat_perawatan	:'',		
			dtrawat_status	:''		
		});
		editor_tindakan_rawat_detail.stopEditing();
		tindakan_rawat_detail_DataStore.insert(0, edit_tindakan_rawat_detail);
		tindakan_rawat_detailListEditorGrid.getView().refresh();
		tindakan_rawat_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_tindakan_rawat_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_tindakan_rawat_detail(){
		tindakan_rawat_detail_DataStore.commitChanges();
		tindakan_rawat_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function tindakan_rawat_detail_insert(){
		for(i=0;i<tindakan_rawat_detail_DataStore.getCount();i++){
			tindakan_rawat_detail_record=tindakan_rawat_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_tindakan_rawat&m=detail_tindakan_rawat_detail_insert',
				params:{
				dtrawat_id	: tindakan_rawat_detail_record.data.dtrawat_id, 
				dtrawat_master	: eval(trawat_idField.getValue()), 
				dtrawat_perawatan	: tindakan_rawat_detail_record.data.dtrawat_perawatan, 
				dtrawat_status	: tindakan_rawat_detail_record.data.dtrawat_status 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function tindakan_rawat_detail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_rawat&m=detail_tindakan_rawat_detail_purge',
			params:{ master_id: eval(trawat_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function tindakan_rawat_detail_confirm_delete(){
		// only one record is selected here
		if(tindakan_rawat_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_rawat_detail_delete);
		} else if(tindakan_rawat_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_rawat_detail_delete);
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
	function tindakan_rawat_detail_delete(btn){
		if(btn=='yes'){
			var s = tindakan_rawat_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				tindakan_rawat_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	tindakan_rawat_detail_DataStore.on('update', refresh_tindakan_rawat_detail);
	
	/* Function for retrieve create Window Panel*/ 
	tindakan_rawat_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [tindakan_rawat_masterGroup,tindakan_rawat_detailListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: tindakan_rawat_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					tindakan_rawat_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	tindakan_rawat_createWindow= new Ext.Window({
		id: 'tindakan_rawat_createWindow',
		title: post2db+'Tindakan_rawat',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_tindakan_rawat_create',
		items: tindakan_rawat_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function tindakan_rawat_list_search(){
		// render according to a SQL date format.
		var trawat_id_search=null;
		var trawat_cust_search=null;
		var trawat_petugas_search=null;
		var trawat_petugas2_search=null;
		var trawat_keterangan_search=null;

		if(trawat_idSearchField.getValue()!==null){trawat_id_search=trawat_idSearchField.getValue();}
		if(trawat_custSearchField.getValue()!==null){trawat_cust_search=trawat_custSearchField.getValue();}
		if(trawat_petugasSearchField.getValue()!==null){trawat_petugas_search=trawat_petugasSearchField.getValue();}
		if(trawat_petugas2SearchField.getValue()!==null){trawat_petugas2_search=trawat_petugas2SearchField.getValue();}
		if(trawat_keteranganSearchField.getValue()!==null){trawat_keterangan_search=trawat_keteranganSearchField.getValue();}
		// change the store parameters
		tindakan_rawat_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			trawat_id	:	trawat_id_search, 
			trawat_cust	:	trawat_cust_search, 
			trawat_petugas	:	trawat_petugas_search, 
			trawat_petugas2	:	trawat_petugas2_search, 
			trawat_keterangan	:	trawat_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		tindakan_rawat_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function tindakan_rawat_reset_search(){
		// reset the store parameters
		tindakan_rawat_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		tindakan_rawat_DataStore.reload({params: {start: 0, limit: pageS}});
		tindakan_rawat_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  trawat_id Search Field */
	trawat_idSearchField= new Ext.form.NumberField({
		id: 'trawat_idSearchField',
		fieldLabel: 'Trawat Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  trawat_cust Search Field */
	trawat_custSearchField= new Ext.form.NumberField({
		id: 'trawat_custSearchField',
		fieldLabel: 'Trawat Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  trawat_petugas Search Field */
	trawat_petugasSearchField= new Ext.form.NumberField({
		id: 'trawat_petugasSearchField',
		fieldLabel: 'Trawat Petugas',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  trawat_petugas2 Search Field */
	trawat_petugas2SearchField= new Ext.form.NumberField({
		id: 'trawat_petugas2SearchField',
		fieldLabel: 'Trawat Petugas2',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  trawat_keterangan Search Field */
	trawat_keteranganSearchField= new Ext.form.TextField({
		id: 'trawat_keteranganSearchField',
		fieldLabel: 'Trawat Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	tindakan_rawat_searchForm = new Ext.FormPanel({
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
				items: [trawat_custSearchField, trawat_petugasSearchField, trawat_petugas2SearchField, trawat_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: tindakan_rawat_list_search
			},{
				text: 'Close',
				handler: function(){
					tindakan_rawat_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	tindakan_rawat_searchWindow = new Ext.Window({
		title: 'tindakan_rawat Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_tindakan_rawat_search',
		items: tindakan_rawat_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!tindakan_rawat_searchWindow.isVisible()){
			tindakan_rawat_searchWindow.show();
		} else {
			tindakan_rawat_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function tindakan_rawat_print(){
		var searchquery = "";
		var trawat_cust_print=null;
		var trawat_petugas_print=null;
		var trawat_petugas2_print=null;
		var trawat_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(tindakan_rawat_DataStore.baseParams.query!==null){searchquery = tindakan_rawat_DataStore.baseParams.query;}
		if(tindakan_rawat_DataStore.baseParams.trawat_cust!==null){trawat_cust_print = tindakan_rawat_DataStore.baseParams.trawat_cust;}
		if(tindakan_rawat_DataStore.baseParams.trawat_petugas!==null){trawat_petugas_print = tindakan_rawat_DataStore.baseParams.trawat_petugas;}
		if(tindakan_rawat_DataStore.baseParams.trawat_petugas2!==null){trawat_petugas2_print = tindakan_rawat_DataStore.baseParams.trawat_petugas2;}
		if(tindakan_rawat_DataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_print = tindakan_rawat_DataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_tindakan_rawat&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_print,
			trawat_petugas : trawat_petugas_print,
			trawat_petugas2 : trawat_petugas2_print,
			trawat_keterangan : trawat_keterangan_print,
		  	currentlisting: tindakan_rawat_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./tindakan_rawatlist.html','tindakan_rawatlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function tindakan_rawat_export_excel(){
		var searchquery = "";
		var trawat_cust_2excel=null;
		var trawat_petugas_2excel=null;
		var trawat_petugas2_2excel=null;
		var trawat_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(tindakan_rawat_DataStore.baseParams.query!==null){searchquery = tindakan_rawat_DataStore.baseParams.query;}
		if(tindakan_rawat_DataStore.baseParams.trawat_cust!==null){trawat_cust_2excel = tindakan_rawat_DataStore.baseParams.trawat_cust;}
		if(tindakan_rawat_DataStore.baseParams.trawat_petugas!==null){trawat_petugas_2excel = tindakan_rawat_DataStore.baseParams.trawat_petugas;}
		if(tindakan_rawat_DataStore.baseParams.trawat_petugas2!==null){trawat_petugas2_2excel = tindakan_rawat_DataStore.baseParams.trawat_petugas2;}
		if(tindakan_rawat_DataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_2excel = tindakan_rawat_DataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_tindakan_rawat&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_2excel,
			trawat_petugas : trawat_petugas_2excel,
			trawat_petugas2 : trawat_petugas2_2excel,
			trawat_keterangan : trawat_keterangan_2excel,
		  	currentlisting: tindakan_rawat_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_tindakan_rawat"></div>
         <div id="fp_tindakan_rawat_detail"></div>
		<div id="elwindow_tindakan_rawat_create"></div>
        <div id="elwindow_tindakan_rawat_search"></div>
    </div>
</div>
</body>