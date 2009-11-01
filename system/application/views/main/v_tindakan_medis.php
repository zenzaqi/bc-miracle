<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan View
	+ Description	: For record view
	+ Filename 		: v_tindakan.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 14:21:34
	
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
var tindakan_medisDataStore;
var tindakan_medisColumnModel;
var tindakanListEditorGrid;
var tindakan_medis_screateForm;
var tindakan_medis_screateWindow;
var tindakan_medissearchForm;
var tindakan_medissearchWindow;
var tindakan_medisSelectedRow;
var tindakan_medisContextMenu;
//for detail data
var tindakan_medis_detail_DataStore;
var tindakan_medisdetailListEditorGrid;
var tindakan_medisdetail_ColumnModel;
var tindakan_medis_detail_proxy;
var tindakan_medis_detail_writer;
var tindakan_medis_detail_reader;
var editor_tindakan_medis_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var trawat_medis_idField;
var trawat_medis_custField;
var trawat_medis_keteranganField;
var trawat_medis_idSearchField;
var trawat_medis_custSearchField;
var trawat_medis_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function tindakan_medis_update(oGrid_event){
		var trawat_id_update_pk="";
		var trawat_cust_update=null;
		var trawat_keterangan_update=null;

		trawat_id_update_pk = oGrid_event.record.data.trawat_id;
		if(oGrid_event.record.data.trawat_cust!== null){trawat_cust_update = oGrid_event.record.data.trawat_cust;}
		if(oGrid_event.record.data.trawat_keterangan!== null){trawat_keterangan_update = oGrid_event.record.data.trawat_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_medis&m=get_action',
			params: {
				task: "UPDATE",
				trawat_id	: trawat_id_update_pk, 
				trawat_cust	:trawat_cust_update,  
				trawat_keterangan	:trawat_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						tindakan_medisDataStore.commitChanges();
						tindakan_medisDataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the tindakan.',
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
	function tindakan_medis_screate(){
	
		if(is_tindakan_medisform_valid()){	
		var trawat_id_create_pk=null; 
		var trawat_cust_create=null; 
		var trawat_keterangan_create=null; 

		if(trawat_medis_idField.getValue()!== null){trawat_id_create = trawat_medis_idField.getValue();}else{trawat_id_create_pk=get_pk_id();} 
		if(trawat_medis_custField.getValue()!== null){trawat_cust_create = trawat_medis_custField.getValue();} 
		if(trawat_medis_keteranganField.getValue()!== null){trawat_keterangan_create = trawat_medis_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_medis&m=get_action',
			params: {
				task: post2db,
				trawat_id	: trawat_id_create_pk, 
				trawat_cust	: trawat_cust_create, 
				trawat_keterangan	: trawat_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						tindakan_medisdetail_purge()
						tindakan_medisdetail_insert();
						Ext.MessageBox.alert(post2db+' OK','The Tindakan was '+msg+' successfully.');
						tindakan_medisDataStore.reload();
						tindakan_medis_screateWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Tindakan.',
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
			return tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function tindakan_medisreset_form(){
		trawat_medis_idField.reset();
		trawat_medis_idField.setValue(null);
		trawat_medis_custField.reset();
		trawat_medis_custField.setValue(null);
		trawat_medis_keteranganField.reset();
		trawat_medis_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function tindakan_medis_set_form(){
		trawat_medis_idField.setValue(tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_id'));
		trawat_medis_custField.setValue(tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_cust'));
		trawat_medis_keteranganField.setValue(tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_tindakan_medisform_valid(){
		return (true &&  trawat_medis_custField.isValid() && true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!tindakan_medis_screateWindow.isVisible()){
			tindakan_medisreset_form();
			post2db='CREATE';
			msg='created';
			tindakan_medis_screateWindow.show();
		} else {
			tindakan_medis_screateWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function tindakan_medisconfirm_delete(){
		// only one tindakan is selected here
		if(tindakanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_medisdelete);
		} else if(tindakanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_medisdelete);
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
	function tindakan_medisconfirm_update(){
		/* only one record is selected here */
		if(tindakanListEditorGrid.selModel.getCount() == 1) {
			tindakan_medis_set_form();
			console.log("customer = "+trawat_medis_custField.getValue());
			post2db='UPDATE';
			tindakan_medis_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			tindakan_medis_screateWindow.show();
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
	function tindakan_medisdelete(btn){
		if(btn=='yes'){
			var selections = tindakanListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< tindakanListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.trawat_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_tindakan_medis&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							tindakan_medisDataStore.reload();
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
	tindakan_medisDataStore = new Ext.data.Store({
		id: 'tindakan_medisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_medis&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'trawat_id'
		},[
		/* dataIndex => insert intotindakan_medisColumnModel, Mapping => for initiate table column */ 
			{name: 'trawat_id', type: 'int', mapping: 'trawat_id'}, 
			{name: 'trawat_cust', type: 'string', mapping: 'cust_nama'}, 
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
    
  	/* Function for Identify of Window Column Model */
	tindakan_medisColumnModel = new Ext.grid.ColumnModel(
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
			header: 'Date Create',
			dataIndex: 'trawat_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'trawat_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
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
	
	tindakan_medisColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	tindakanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'tindakanListEditorGrid',
		el: 'fp_tindakan',
		title: 'List Of Tindakan',
		autoHeight: true,
		store: tindakan_medisDataStore, // DataStore
		cm: tindakan_medisColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: tindakan_medisDataStore,
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
			handler: tindakan_medisconfirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: tindakan_medisconfirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: tindakan_medisDataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: tindakan_medisreset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tindakan_medisexport_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tindakan_medisprint  
		}
		]
	});
	tindakanListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	tindakan_medisContextMenu = new Ext.menu.Menu({
		id: 'tindakan_medisListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: tindakan_mediseditContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: tindakan_medisconfirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tindakan_medisprint 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tindakan_medisexport_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function ontindakan_medisListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		tindakan_medisContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		tindakan_medisSelectedRow=rowIndex;
		tindakan_medisContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function tindakan_mediseditContextMenu(){
		tindakanListEditorGrid.startEditing(tindakan_medisSelectedRow,1);
  	}
	/* End of Function */
  	
	tindakanListEditorGrid.addListener('rowcontextmenu', ontindakan_medisListEditGridContextMenu);
	tindakan_medisDataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	tindakanListEditorGrid.on('afteredit', tindakan_medis_update); // inLine Editing Record
	
	/* Identify  trawat_id Field */
	trawat_medis_idField= new Ext.form.NumberField({
		id: 'trawat_medis_idField',
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
	trawat_medis_custField= new Ext.form.TextField({
		id: 'trawat_medis_custField',
		fieldLabel: 'Customer',
		anchor: '95%',
		readOnly: true,
		maxLength: 100
	});
	/* Identify  trawat_keterangan Field */
	trawat_medis_keteranganField= new Ext.form.TextArea({
		id: 'trawat_medis_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	tindakan_medismasterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [trawat_medis_custField, trawat_medis_keteranganField, trawat_medis_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var tindakan_medis_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'}, 
			{name: 'dtrawat_master', type: 'int', mapping: 'dtrawat_master'}, 
			{name: 'dtrawat_perawatan', type: 'int', mapping: 'dtrawat_perawatan'}, 
			{name: 'dtrawat_petugas1', type: 'int', mapping: 'dtrawat_petugas1'}, 
			{name: 'dtrawat_petugas2', type: 'int', mapping: 'dtrawat_petugas2'}, 
			{name: 'dtrawat_jamreservasi', type: 'string', mapping: 'dtrawat_jamreservasi'}, 
			{name: 'dtrawat_kategori', type: 'string', mapping: 'dtrawat_kategori'}, 
			{name: 'dtrawat_status', type: 'string', mapping: 'dtrawat_status'} 
	]);
	//eof
	
	//function for json writer of detail
	var tindakan_medis_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	tindakan_medis_detail_DataStore = new Ext.data.Store({
		id: 'tindakan_medis_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_medis&m=detail_tindakan_detail_list', 
			method: 'POST'
		}),
		reader: tindakan_medis_detail_reader,
		baseParams:{master_id: trawat_medis_idField.getValue()},
		sortInfo:{field: 'dtrawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_tindakan_medis_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	cbo_dapp_dokterDataStore = new Ext.data.Store({
		id: 'cbo_dapp_dokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_medis&m=get_dokter_list', 
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
			url: 'index.php?c=c_tindakan_medis&m=get_terapis_list', 
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
	
	cbo_trawat_rawatDataStore = new Ext.data.Store({
		id: 'cbo_trawat_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_medis&m=get_rawat_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'trawat_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'trawat_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'trawat_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'trawat_rawat_group', type: 'string', mapping: 'group_nama'},
			{name: 'trawat_rawat_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'trawat_rawat_du', type: 'float', mapping: 'rawat_du'},
			{name: 'trawat_rawat_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'trawat_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'trawat_rawat_display', direction: "ASC"}
	});
	var cbo_trawat_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{trawat_rawat_kode}</b>| {trawat_rawat_display}<br/>Group: {trawat_rawat_group}<br/>',
			'Kategori: {trawat_rawat_kategori}</span>',
		'</div></tpl>'
    );
	
	Ext.util.Format.comboRenderer = function(combo){
		cbo_trawat_rawatDataStore.load();
		cbo_dapp_dokterDataStore.load();
		cbo_dapp_terapisDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_trawat_rawat=new Ext.form.ComboBox({
			store: cbo_trawat_rawatDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'trawat_rawat_display',
			valueField: 'trawat_rawat_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:10,
			hideTrigger:false,
			tpl: cbo_trawat_rawat_tpl,
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
	tindakan_medisdetail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Perawatan',
			dataIndex: 'dtrawat_perawatan',
			width: 150,
			sortable: true,
			editor: combo_trawat_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_trawat_rawat)
		},
		{
			header: 'Dokter',
			dataIndex: 'dtrawat_petugas1',
			width: 150,
			sortable: true,
			editor: combo_dapp_dokter,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_dokter)
		},
		{
			header: 'Dokter/Therapist',
			dataIndex: 'dtrawat_petugas2',
			width: 150,
			sortable: true,
			editor: combo_dapp_terapis,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_terapis)
		},
		{
			header: 'Jam Reservasi',
			dataIndex: 'dtrawat_jamreservasi',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 8
          	})
		},
		{
			header: 'Kategori',
			dataIndex: 'dtrawat_kategori',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dtrawat_kategori_value', 'dtrawat_kategori_display'],
					data: [['Medis','Medis'],['Non Medis','Non Medis']]
					}),
				mode: 'local',
               	displayField: 'dtrawat_kategori_display',
               	valueField: 'dtrawat_kategori_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Status',
			dataIndex: 'dtrawat_status',
			width: 150,
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
	tindakan_medisdetail_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	tindakan_medisdetailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'tindakan_medisdetailListEditorGrid',
		el: 'fp_tindakan_medisdetail',
		title: 'Detail tindakan_medisdetail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: tindakan_medis_detail_DataStore, // DataStore
		colModel: tindakan_medisdetail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_tindakan_medis_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: tindakan_medis_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: tindakan_medisdetail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: tindakan_medisdetail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function tindakan_medisdetail_add(){
		var edit_tindakan_medisdetail= new tindakan_medisdetailListEditorGrid.store.recordType({
			dtrawat_id	:'',		
			dtrawat_master	:'',		
			dtrawat_perawatan	:'',		
			dtrawat_petugas1	:'',		
			dtrawat_petugas2	:'',		
			dtrawat_jamreservasi	:'',		
			dtrawat_kategori	:'',		
			dtrawat_status	:''		
		});
		editor_tindakan_medis_detail.stopEditing();
		tindakan_medis_detail_DataStore.insert(0, edit_tindakan_medisdetail);
		tindakan_medisdetailListEditorGrid.getView().refresh();
		tindakan_medisdetailListEditorGrid.getSelectionModel().selectRow(0);
		editor_tindakan_medis_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_tindakan_medisdetail(){
		tindakan_medis_detail_DataStore.commitChanges();
		tindakan_medisdetailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function tindakan_medisdetail_insert(){
		for(i=0;i<tindakan_medis_detail_DataStore.getCount();i++){
			tindakan_medisdetail_record=tindakan_medis_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_tindakan_medis&m=detail_tindakan_medisdetail_insert',
				params:{
				dtrawat_id	: tindakan_medisdetail_record.data.dtrawat_id, 
				dtrawat_master	: eval(trawat_medis_idField.getValue()), 
				dtrawat_perawatan	: tindakan_medisdetail_record.data.dtrawat_perawatan, 
				dtrawat_petugas1	: tindakan_medisdetail_record.data.dtrawat_petugas1, 
				dtrawat_petugas2	: tindakan_medisdetail_record.data.dtrawat_petugas2, 
				dtrawat_jamreservasi	: tindakan_medisdetail_record.data.dtrawat_jamreservasi, 
				dtrawat_kategori	: tindakan_medisdetail_record.data.dtrawat_kategori, 
				dtrawat_status	: tindakan_medisdetail_record.data.dtrawat_status 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function tindakan_medisdetail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_medis&m=detail_tindakan_medisdetail_purge',
			params:{ master_id: eval(trawat_medis_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function tindakan_medisdetail_confirm_delete(){
		// only one record is selected here
		if(tindakan_medisdetailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_medisdetail_delete);
		} else if(tindakan_medisdetailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_medisdetail_delete);
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
	function tindakan_medisdetail_delete(btn){
		if(btn=='yes'){
			var s = tindakan_medisdetailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				tindakan_medis_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	tindakan_medis_detail_DataStore.on('update', refresh_tindakan_medisdetail);
	
	/* Function for retrieve create Window Panel*/ 
	tindakan_medis_screateForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [tindakan_medismasterGroup,tindakan_medisdetailListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: tindakan_medis_screate
			}
			,{
				text: 'Cancel',
				handler: function(){
					tindakan_medis_screateWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	tindakan_medis_screateWindow= new Ext.Window({
		id: 'tindakan_medis_screateWindow',
		title: post2db+'Tindakan',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_tindakan_medis_screate',
		items: tindakan_medis_screateForm
	});
	/* End Window */
	
	/* Function for action list search */
	function tindakan_medislist_search(){
		// render according to a SQL date format.
		var trawat_id_search=null;
		var trawat_cust_search=null;
		var trawat_keterangan_search=null;

		if(trawat_medis_idSearchField.getValue()!==null){trawat_id_search=trawat_medis_idSearchField.getValue();}
		if(trawat_medis_custSearchField.getValue()!==null){trawat_cust_search=trawat_medis_custSearchField.getValue();}
		if(trawat_medis_keteranganSearchField.getValue()!==null){trawat_keterangan_search=trawat_medis_keteranganSearchField.getValue();}
		// change the store parameters
		tindakan_medisDataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			trawat_id	:	trawat_id_search, 
			trawat_cust	:	trawat_cust_search, 
			trawat_keterangan	:	trawat_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		tindakan_medisDataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function tindakan_medisreset_search(){
		// reset the store parameters
		tindakan_medisDataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		tindakan_medisDataStore.reload({params: {start: 0, limit: pageS}});
		tindakan_medissearchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  trawat_id Search Field */
	trawat_medis_idSearchField= new Ext.form.NumberField({
		id: 'trawat_medis_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  trawat_cust Search Field */
	trawat_medis_custSearchField= new Ext.form.NumberField({
		id: 'trawat_medis_custSearchField',
		fieldLabel: 'Customer',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  trawat_keterangan Search Field */
	trawat_medis_keteranganSearchField= new Ext.form.TextArea({
		id: 'trawat_medis_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	tindakan_medissearchForm = new Ext.FormPanel({
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
				items: [trawat_medis_custSearchField, trawat_medis_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: tindakan_medislist_search
			},{
				text: 'Close',
				handler: function(){
					tindakan_medissearchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	tindakan_medissearchWindow = new Ext.Window({
		title: 'tindakan Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_tindakan_medissearch',
		items: tindakan_medissearchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!tindakan_medissearchWindow.isVisible()){
			tindakan_medissearchWindow.show();
		} else {
			tindakan_medissearchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function tindakan_medisprint(){
		var searchquery = "";
		var trawat_cust_print=null;
		var trawat_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(tindakan_medisDataStore.baseParams.query!==null){searchquery = tindakan_medisDataStore.baseParams.query;}
		if(tindakan_medisDataStore.baseParams.trawat_cust!==null){trawat_cust_print = tindakan_medisDataStore.baseParams.trawat_cust;}
		if(tindakan_medisDataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_print = tindakan_medisDataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_tindakan_medis&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_print,
			trawat_keterangan : trawat_keterangan_print,
		  	currentlisting: tindakan_medisDataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./tindakanlist.html','tindakanlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function tindakan_medisexport_excel(){
		var searchquery = "";
		var trawat_cust_2excel=null;
		var trawat_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(tindakan_medisDataStore.baseParams.query!==null){searchquery = tindakan_medisDataStore.baseParams.query;}
		if(tindakan_medisDataStore.baseParams.trawat_cust!==null){trawat_cust_2excel = tindakan_medisDataStore.baseParams.trawat_cust;}
		if(tindakan_medisDataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_2excel = tindakan_medisDataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_tindakan_medis&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_2excel,
			trawat_keterangan : trawat_keterangan_2excel,
		  	currentlisting: tindakan_medisDataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_tindakan"></div>
         <div id="fp_tindakan_medisdetail"></div>
		<div id="elwindow_tindakan_medis_screate"></div>
        <div id="elwindow_tindakan_medissearch"></div>
    </div>
</div>
</body>