<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_retur_jual_produk View
	+ Description	: For record view
	+ Filename 		: v_master_retur_jual_produk.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 14:53:25
	
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
var master_retur_jual_produk_DataStore;
var master_retur_jual_produk_ColumnModel;
var master_retur_jual_produkListEditorGrid;
var master_retur_jual_produk_createForm;
var master_retur_jual_produk_createWindow;
var master_retur_jual_produk_searchForm;
var master_retur_jual_produk_searchWindow;
var master_retur_jual_produk_SelectedRow;
var master_retur_jual_produk_ContextMenu;
//for detail data
var detail_retur_jual_produk_DataStor;
var detail_retur_jual_produkListEditorGrid;
var detail_retur_jual_produk_ColumnModel;
var detail_retur_jual_produk_proxy;
var detail_retur_jual_produk_writer;
var detail_retur_jual_produk_reader;
var editor_detail_retur_jual_produk;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var rproduk_idField;
var rproduk_nobuktiField;
var rproduk_nobuktijualField;
var rproduk_custField;
var rproduk_tanggalField;
var rproduk_keteranganField;
var rproduk_idSearchField;
var rproduk_nobuktiSearchField;
var rproduk_nobuktijualSearchField;
var rproduk_custSearchField;
var rproduk_tanggalSearchField;
var rproduk_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_retur_jual_produk_update(oGrid_event){
		var rproduk_id_update_pk="";
		var rproduk_nobukti_update=null;
		var rproduk_nobuktijual_update=null;
		var rproduk_cust_update=null;
		var rproduk_tanggal_update_date="";
		var rproduk_keterangan_update=null;

		rproduk_id_update_pk = oGrid_event.record.data.rproduk_id;
		if(oGrid_event.record.data.rproduk_nobukti!== null){rproduk_nobukti_update = oGrid_event.record.data.rproduk_nobukti;}
		if(oGrid_event.record.data.rproduk_nobuktijual!== null){rproduk_nobuktijual_update = oGrid_event.record.data.rproduk_nobuktijual;}
		if(oGrid_event.record.data.rproduk_cust!== null){rproduk_cust_update = oGrid_event.record.data.rproduk_cust;}
	 	if(oGrid_event.record.data.rproduk_tanggal!== ""){rproduk_tanggal_update_date =oGrid_event.record.data.rproduk_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.rproduk_keterangan!== null){rproduk_keterangan_update = oGrid_event.record.data.rproduk_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_retur_jual_produk&m=get_action',
			params: {
				task: "UPDATE",
				rproduk_id	: rproduk_id_update_pk, 
				rproduk_nobukti	:rproduk_nobukti_update,  
				rproduk_nobuktijual	:rproduk_nobuktijual_update,  
				rproduk_cust	:rproduk_cust_update,  
				rproduk_tanggal	: rproduk_tanggal_update_date, 
				rproduk_keterangan	:rproduk_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_retur_jual_produk_DataStore.commitChanges();
						master_retur_jual_produk_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the master_retur_jual_produk.',
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
	function master_retur_jual_produk_create(){
	
		if(is_master_retur_jual_produk_form_valid()){	
		var rproduk_id_create_pk=null; 
		var rproduk_nobukti_create=null; 
		var rproduk_nobuktijual_create=null; 
		var rproduk_cust_create=null; 
		var rproduk_tanggal_create_date=""; 
		var rproduk_keterangan_create=null; 

		if(rproduk_idField.getValue()!== null){rproduk_id_create_pk = rproduk_idField.getValue();}else{rproduk_id_create_pk=get_pk_id();} 
		if(rproduk_nobuktiField.getValue()!== null){rproduk_nobukti_create = rproduk_nobuktiField.getValue();} 
		if(rproduk_nobuktijualField.getValue()!== null){rproduk_nobuktijual_create = rproduk_nobuktijualField.getValue();} 
		if(rproduk_custField.getValue()!== null){rproduk_cust_create = rproduk_custidField.getValue();} 
		if(rproduk_tanggalField.getValue()!== ""){rproduk_tanggal_create_date = rproduk_tanggalField.getValue().format('Y-m-d');} 
		if(rproduk_keteranganField.getValue()!== null){rproduk_keterangan_create = rproduk_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_retur_jual_produk&m=get_action',
			params: {
				task: post2db,
				rproduk_id	: rproduk_id_create_pk, 
				rproduk_nobukti	: rproduk_nobukti_create, 
				rproduk_nobuktijual	: rproduk_nobuktijual_create, 
				rproduk_cust	: rproduk_cust_create, 
				rproduk_tanggal	: rproduk_tanggal_create_date, 
				rproduk_keterangan	: rproduk_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_retur_jual_produk_purge()
						detail_retur_jual_produk_insert();
						Ext.MessageBox.alert(post2db+' OK','The Master_retur_jual_produk was '+msg+' successfully.');
						master_retur_jual_produk_DataStore.reload();
						master_retur_jual_produk_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_retur_jual_produk.',
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
			return master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_retur_jual_produk_reset_form(){
		rproduk_idField.reset();
		rproduk_idField.setValue(null);
		rproduk_nobuktiField.reset();
		rproduk_nobuktiField.setValue(null);
		rproduk_nobuktijualField.reset();
		rproduk_nobuktijualField.setValue(null);
		rproduk_custField.reset();
		rproduk_custField.setValue(null);
		rproduk_tanggalField.reset();
		rproduk_tanggalField.setValue(null);
		rproduk_keteranganField.reset();
		rproduk_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_retur_jual_produk_set_form(){
		rproduk_idField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_id'));
		rproduk_nobuktiField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_nobukti'));
		rproduk_nobuktijualField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_nobuktijual'));
		rproduk_custField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_cust'));
		rproduk_custidField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_cust_id'));
		rproduk_tanggalField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_tanggal'));
		rproduk_keteranganField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_retur_jual_produk_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_retur_jual_produk_createWindow.isVisible()){
			master_retur_jual_produk_reset_form();
			post2db='CREATE';
			msg='created';
			master_retur_jual_produk_createWindow.show();
		} else {
			master_retur_jual_produk_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_retur_jual_produk_confirm_delete(){
		// only one master_retur_jual_produk is selected here
		if(master_retur_jual_produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_retur_jual_produk_delete);
		} else if(master_retur_jual_produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_retur_jual_produk_delete);
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
	function master_retur_jual_produk_confirm_update(){
		/* only one record is selected here */
		if(master_retur_jual_produkListEditorGrid.selModel.getCount() == 1) {
			master_retur_jual_produk_reset_form();
			master_retur_jual_produk_set_form();
			post2db='UPDATE';
			detail_retur_jual_produk_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			master_retur_jual_produk_createWindow.show();
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
	function master_retur_jual_produk_delete(btn){
		if(btn=='yes'){
			var selections = master_retur_jual_produkListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_retur_jual_produkListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.rproduk_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_retur_jual_produk&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_retur_jual_produk_DataStore.reload();
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
	master_retur_jual_produk_DataStore = new Ext.data.Store({
		id: 'master_retur_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rproduk_id'
		},[
		/* dataIndex => insert intomaster_retur_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rproduk_id', type: 'int', mapping: 'rproduk_id'}, 
			{name: 'rproduk_nobukti', type: 'string', mapping: 'rproduk_nobukti'}, 
			{name: 'rproduk_nobuktijual', type: 'string', mapping: 'jproduk_nobukti'}, 
			{name: 'rproduk_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'rproduk_cust_id', type: 'int', mapping: 'cust_id'}, 
			{name: 'rproduk_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'rproduk_tanggal'}, 
			{name: 'rproduk_keterangan', type: 'string', mapping: 'rproduk_keterangan'}, 
			{name: 'rproduk_creator', type: 'string', mapping: 'rproduk_creator'}, 
			{name: 'rproduk_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'rproduk_date_create'}, 
			{name: 'rproduk_update', type: 'string', mapping: 'rproduk_update'}, 
			{name: 'rproduk_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'rproduk_date_update'}, 
			{name: 'rproduk_revised', type: 'int', mapping: 'rproduk_revised'} 
		]),
		sortInfo:{field: 'rproduk_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve DataStore */
	cbo_retur_produk_DataSore = new Ext.data.Store({
		id: 'cbo_retur_produk_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=get_jual_produk_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jproduk_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'retur_produk_value', type: 'int', mapping: 'jproduk_id'},
			{name: 'retur_produk_display', type: 'string', mapping: 'jproduk_nobukti'},
			{name: 'retur_produk_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jproduk_tanggal'},
			{name: 'retur_produk_nama_customer', type: 'string', mapping: 'cust_nama'},
			{name: 'retur_produk_customer_id', type: 'string', mapping: 'cust_id'},
			{name: 'retur_produk_alamat', type: 'string', mapping: 'cust_alamat'}
		]),
		sortInfo:{field: 'retur_produk_display', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	master_retur_jual_produk_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'rproduk_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'No.Faktur',
			dataIndex: 'rproduk_nobukti',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		}, 
		{
			header: 'No.Faktur Jual',
			dataIndex: 'rproduk_nobuktijual',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		}, 
		{
			header: 'Customer',
			dataIndex: 'rproduk_cust',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'rproduk_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'rproduk_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextArea({
				maxLength: 250
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'rproduk_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'rproduk_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'rproduk_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'rproduk_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'rproduk_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_retur_jual_produk_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_retur_jual_produkListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_retur_jual_produkListEditorGrid',
		el: 'fp_master_retur_jual_produk',
		title: 'List Of Master_retur_jual_produk',
		autoHeight: true,
		store: master_retur_jual_produk_DataStore, // DataStore
		cm: master_retur_jual_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_retur_jual_produk_DataStore,
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
			handler: master_retur_jual_produk_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_retur_jual_produk_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_retur_jual_produk_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_retur_jual_produk_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_retur_jual_produk_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_retur_jual_produk_print  
		}
		]
	});
	master_retur_jual_produkListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_retur_jual_produk_ContextMenu = new Ext.menu.Menu({
		id: 'master_retur_jual_produk_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_retur_jual_produk_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_retur_jual_produk_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_retur_jual_produk_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_retur_jual_produk_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_retur_jual_produk_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_retur_jual_produk_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_retur_jual_produk_SelectedRow=rowIndex;
		master_retur_jual_produk_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_retur_jual_produk_editContextMenu(){
		master_retur_jual_produkListEditorGrid.startEditing(master_retur_jual_produk_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_retur_jual_produkListEditorGrid.addListener('rowcontextmenu', onmaster_retur_jual_produk_ListEditGridContextMenu);
	master_retur_jual_produk_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_retur_jual_produkListEditorGrid.on('afteredit', master_retur_jual_produk_update); // inLine Editing Record
	
	// Custom rendering Template
    var retur_jual_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{retur_produk_display}</b> | Tgl-Retur:{retur_produk_tanggal:date("M j, Y")}<br /></span>',
            'Customer: {retur_produk_nama_customer}&nbsp;&nbsp;&nbsp;[Alamat: {retur_produk_alamat}]',
        '</div></tpl>'
    );
	
	/* Identify  rproduk_id Field */
	rproduk_idField= new Ext.form.NumberField({
		id: 'rproduk_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		hideLabel: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  rproduk_nobukti Field */
	rproduk_nobuktiField= new Ext.form.TextField({
		id: 'rproduk_nobuktiField',
		fieldLabel: 'No.Faktur',
		maxLength: 100,
		anchor: '95%'
	});
	/* Identify  rproduk_nobuktijual Field */
	rproduk_nobuktijualField= new Ext.form.ComboBox({
		id: 'rproduk_nobuktijualField',
		fieldLabel: 'No.Faktur Jual',
		store: cbo_retur_produk_DataSore,
		mode: 'remote',
		displayField:'retur_produk_display',
		valueField: 'retur_produk_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: retur_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  rproduk_cust Field */
	rproduk_custField= new Ext.form.TextField({
		id: 'rproduk_custField',
		fieldLabel: 'Customer',
		maxLength: 100,
		anchor: '95%',
		readOnly: true
	});
	rproduk_custidField= new Ext.form.NumberField();
	/* Identify  rproduk_tanggal Field */
	rproduk_tanggalField= new Ext.form.DateField({
		id: 'rproduk_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  rproduk_keterangan Field */
	rproduk_keteranganField= new Ext.form.TextArea({
		id: 'rproduk_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	rproduk_nobuktijualField.on('select', function(){
		var j=cbo_retur_produk_DataSore.find('retur_produk_value',rproduk_nobuktijualField.getValue());
		if(cbo_retur_produk_DataSore.getCount()){
			rproduk_custField.setValue(cbo_retur_produk_DataSore.getAt(j).data.retur_produk_nama_customer);
			rproduk_custidField.setValue(cbo_retur_produk_DataSore.getAt(j).data.retur_produk_customer_id);
		}
	});
	
  	/*Fieldset Master*/
	master_retur_jual_produk_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rproduk_nobuktiField, rproduk_nobuktijualField, rproduk_custField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rproduk_tanggalField, rproduk_keteranganField, rproduk_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_retur_jual_produk_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'drproduk_id', type: 'int', mapping: 'drproduk_id'}, 
			{name: 'drproduk_master', type: 'int', mapping: 'drproduk_master'}, 
			{name: 'drproduk_produk', type: 'int', mapping: 'drproduk_produk'}, 
			{name: 'drproduk_satuan', type: 'int', mapping: 'drproduk_satuan'}, 
			{name: 'drproduk_jumlah', type: 'int', mapping: 'drproduk_jumlah'}, 
			{name: 'drproduk_harga', type: 'float', mapping: 'drproduk_harga'} 
	]);
	//eof
	
	//function for json writer of detail
	var detail_retur_jual_produk_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_retur_jual_produk_DataStore = new Ext.data.Store({
		id: 'detail_retur_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=detail_detail_retur_jual_produk_list', 
			method: 'POST'
		}),
		reader: detail_retur_jual_produk_reader,
		baseParams:{master_id: rproduk_idField.getValue()},
		sortInfo:{field: 'drproduk_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_retur_jual_produk= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	//declaration of detail coloumn model
	detail_retur_jual_produk_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Nama Produk',
			dataIndex: 'drproduk_produk',
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
			header: 'Satuan',
			dataIndex: 'drproduk_satuan',
			width: 150,
			sortable: true,
			readOnly: true
		},
		{
			header: 'Jumlah',
			dataIndex: 'drproduk_jumlah',
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
			header: 'Harga',
			dataIndex: 'drproduk_harga',
			width: 150,
			sortable: true,
			readOnly: true
		}]
	);
	detail_retur_jual_produk_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	detail_retur_jual_produkListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_retur_jual_produkListEditorGrid',
		el: 'fp_detail_retur_jual_produk',
		title: 'Detail detail_retur_jual_produk',
		height: 250,
		width: 690,
		autoScroll: true,
		store: detail_retur_jual_produk_DataStore, // DataStore
		colModel: detail_retur_jual_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_retur_jual_produk],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_retur_jual_produk_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_retur_jual_produk_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_retur_jual_produk_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function detail_retur_jual_produk_add(){
		var edit_detail_retur_jual_produk= new detail_retur_jual_produkListEditorGrid.store.recordType({
			drproduk_id	:'',		
			drproduk_master	:'',		
			drproduk_produk	:'',		
			drproduk_satuan	:'',		
			drproduk_jumlah	:'',		
			drproduk_harga	:''		
		});
		editor_detail_retur_jual_produk.stopEditing();
		detail_retur_jual_produk_DataStore.insert(0, edit_detail_retur_jual_produk);
		detail_retur_jual_produkListEditorGrid.getView().refresh();
		detail_retur_jual_produkListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_retur_jual_produk.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_retur_jual_produk(){
		detail_retur_jual_produk_DataStore.commitChanges();
		detail_retur_jual_produkListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_retur_jual_produk_insert(){
		for(i=0;i<detail_retur_jual_produk_DataStore.getCount();i++){
			detail_retur_jual_produk_record=detail_retur_jual_produk_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_retur_jual_produk&m=detail_detail_retur_jual_produk_insert',
				params:{
				drproduk_id	: detail_retur_jual_produk_record.data.drproduk_id, 
				drproduk_master	: eval(rproduk_idField.getValue()), 
				drproduk_produk	: detail_retur_jual_produk_record.data.drproduk_produk, 
				drproduk_satuan	: detail_retur_jual_produk_record.data.drproduk_satuan, 
				drproduk_jumlah	: detail_retur_jual_produk_record.data.drproduk_jumlah, 
				drproduk_harga	: detail_retur_jual_produk_record.data.drproduk_harga 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function detail_retur_jual_produk_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_retur_jual_produk&m=detail_detail_retur_jual_produk_purge',
			params:{ master_id: eval(rproduk_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_retur_jual_produk_confirm_delete(){
		// only one record is selected here
		if(detail_retur_jual_produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_retur_jual_produk_delete);
		} else if(detail_retur_jual_produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_retur_jual_produk_delete);
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
	function detail_retur_jual_produk_delete(btn){
		if(btn=='yes'){
			var s = detail_retur_jual_produkListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_retur_jual_produk_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	detail_retur_jual_produk_DataStore.on('update', refresh_detail_retur_jual_produk);
	
	/* Function for retrieve create Window Panel*/ 
	master_retur_jual_produk_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [master_retur_jual_produk_masterGroup,detail_retur_jual_produkListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_retur_jual_produk_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_retur_jual_produk_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_retur_jual_produk_createWindow= new Ext.Window({
		id: 'master_retur_jual_produk_createWindow',
		title: post2db+'Master_retur_jual_produk',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_retur_jual_produk_create',
		items: master_retur_jual_produk_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function master_retur_jual_produk_list_search(){
		// render according to a SQL date format.
		var rproduk_id_search=null;
		var rproduk_nobukti_search=null;
		var rproduk_nobuktijual_search=null;
		var rproduk_cust_search=null;
		var rproduk_tanggal_search_date="";
		var rproduk_keterangan_search=null;

		if(rproduk_idSearchField.getValue()!==null){rproduk_id_search=rproduk_idSearchField.getValue();}
		if(rproduk_nobuktiSearchField.getValue()!==null){rproduk_nobukti_search=rproduk_nobuktiSearchField.getValue();}
		if(rproduk_nobuktijualSearchField.getValue()!==null){rproduk_nobuktijual_search=rproduk_nobuktijualSearchField.getValue();}
		if(rproduk_custSearchField.getValue()!==null){rproduk_cust_search=rproduk_custSearchField.getValue();}
		if(rproduk_tanggalSearchField.getValue()!==""){rproduk_tanggal_search_date=rproduk_tanggalSearchField.getValue().format('Y-m-d');}
		if(rproduk_keteranganSearchField.getValue()!==null){rproduk_keterangan_search=rproduk_keteranganSearchField.getValue();}
		// change the store parameters
		master_retur_jual_produk_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			rproduk_id	:	rproduk_id_search, 
			rproduk_nobukti	:	rproduk_nobukti_search, 
			rproduk_nobuktijual	:	rproduk_nobuktijual_search, 
			rproduk_cust	:	rproduk_cust_search, 
			rproduk_tanggal	:	rproduk_tanggal_search_date, 
			rproduk_keterangan	:	rproduk_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		master_retur_jual_produk_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_retur_jual_produk_reset_search(){
		// reset the store parameters
		master_retur_jual_produk_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_retur_jual_produk_DataStore.reload({params: {start: 0, limit: pageS}});
		master_retur_jual_produk_searchWindow.close();
	};
	/* End of Fuction */
	
	function master_retur_jual_reset_SearchForm(){
		rproduk_nobuktiSearchField.reset();
		rproduk_nobuktijualSearchField.reset();
		rproduk_custSearchField.reset();
		rproduk_tanggalSearchField.reset();
		rproduk_keteranganSearchField.reset();
	}
	
	
	/* Field for search */
	/* Identify  rproduk_id Search Field */
	rproduk_idSearchField= new Ext.form.NumberField({
		id: 'rproduk_idSearchField',
		fieldLabel: 'Rproduk Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  rproduk_nobukti Search Field */
	rproduk_nobuktiSearchField= new Ext.form.TextField({
		id: 'rproduk_nobuktiSearchField',
		fieldLabel: 'No.Faktur',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  rproduk_nobuktijual Search Field */
	rproduk_nobuktijualSearchField= new Ext.form.TextField({
		id: 'rproduk_nobuktijualSearchField',
		fieldLabel: 'No.Faktur Jual',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  rproduk_cust Search Field */
	rproduk_custSearchField= new Ext.form.NumberField({
		id: 'rproduk_custSearchField',
		fieldLabel: 'Customer',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  rproduk_tanggal Search Field */
	rproduk_tanggalSearchField= new Ext.form.DateField({
		id: 'rproduk_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  rproduk_keterangan Search Field */
	rproduk_keteranganSearchField= new Ext.form.TextArea({
		id: 'rproduk_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_retur_jual_produk_searchForm = new Ext.FormPanel({
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
				items: [rproduk_nobuktiSearchField, rproduk_nobuktijualSearchField, rproduk_custSearchField, rproduk_tanggalSearchField, rproduk_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_retur_jual_produk_list_search
			},{
				text: 'Close',
				handler: function(){
					master_retur_jual_produk_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_retur_jual_produk_searchWindow = new Ext.Window({
		title: 'master_retur_jual_produk Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_retur_jual_produk_search',
		items: master_retur_jual_produk_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_retur_jual_produk_searchWindow.isVisible()){
			master_retur_jual_reset_SearchForm();
			master_retur_jual_produk_searchWindow.show();
		} else {
			master_retur_jual_produk_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_retur_jual_produk_print(){
		var searchquery = "";
		var rproduk_nobukti_print=null;
		var rproduk_nobuktijual_print=null;
		var rproduk_cust_print=null;
		var rproduk_tanggal_print_date="";
		var rproduk_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_retur_jual_produk_DataStore.baseParams.query!==null){searchquery = master_retur_jual_produk_DataStore.baseParams.query;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_nobukti!==null){rproduk_nobukti_print = master_retur_jual_produk_DataStore.baseParams.rproduk_nobukti;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_nobuktijual!==null){rproduk_nobuktijual_print = master_retur_jual_produk_DataStore.baseParams.rproduk_nobuktijual;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_cust!==null){rproduk_cust_print = master_retur_jual_produk_DataStore.baseParams.rproduk_cust;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_tanggal!==""){rproduk_tanggal_print_date = master_retur_jual_produk_DataStore.baseParams.rproduk_tanggal;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_keterangan!==null){rproduk_keterangan_print = master_retur_jual_produk_DataStore.baseParams.rproduk_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_retur_jual_produk&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			rproduk_nobukti : rproduk_nobukti_print,
			rproduk_nobuktijual : rproduk_nobuktijual_print,
			rproduk_cust : rproduk_cust_print,
		  	rproduk_tanggal : rproduk_tanggal_print_date, 
			rproduk_keterangan : rproduk_keterangan_print,
		  	currentlisting: master_retur_jual_produk_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_retur_jual_produklist.html','master_retur_jual_produklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_retur_jual_produk_export_excel(){
		var searchquery = "";
		var rproduk_nobukti_2excel=null;
		var rproduk_nobuktijual_2excel=null;
		var rproduk_cust_2excel=null;
		var rproduk_tanggal_2excel_date="";
		var rproduk_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_retur_jual_produk_DataStore.baseParams.query!==null){searchquery = master_retur_jual_produk_DataStore.baseParams.query;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_nobukti!==null){rproduk_nobukti_2excel = master_retur_jual_produk_DataStore.baseParams.rproduk_nobukti;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_nobuktijual!==null){rproduk_nobuktijual_2excel = master_retur_jual_produk_DataStore.baseParams.rproduk_nobuktijual;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_cust!==null){rproduk_cust_2excel = master_retur_jual_produk_DataStore.baseParams.rproduk_cust;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_tanggal!==""){rproduk_tanggal_2excel_date = master_retur_jual_produk_DataStore.baseParams.rproduk_tanggal;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_keterangan!==null){rproduk_keterangan_2excel = master_retur_jual_produk_DataStore.baseParams.rproduk_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_retur_jual_produk&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			rproduk_nobukti : rproduk_nobukti_2excel,
			rproduk_nobuktijual : rproduk_nobuktijual_2excel,
			rproduk_cust : rproduk_cust_2excel,
		  	rproduk_tanggal : rproduk_tanggal_2excel_date, 
			rproduk_keterangan : rproduk_keterangan_2excel,
		  	currentlisting: master_retur_jual_produk_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_retur_jual_produk"></div>
         <div id="fp_detail_retur_jual_produk"></div>
		<div id="elwindow_master_retur_jual_produk_create"></div>
        <div id="elwindow_master_retur_jual_produk_search"></div>
    </div>
</div>
</body>