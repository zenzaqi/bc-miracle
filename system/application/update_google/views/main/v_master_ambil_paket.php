<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_ambil_paket View
	+ Description	: For record view
	+ Filename 		: v_master_ambil_paket.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 19/Aug/2009 15:30:59
	
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
var master_ambil_paket_DataStore;
var master_ambil_paket_ColumnModel;
var master_ambil_paketListEditorGrid;
var master_ambil_paket_createForm;
var master_ambil_paket_createWindow;
var master_ambil_paket_searchForm;
var master_ambil_paket_searchWindow;
var master_ambil_paket_SelectedRow;
var master_ambil_paket_ContextMenu;
//for detail data
var detail_ambil_paket_DataStor;
var detail_ambil_paketListEditorGrid;
var detail_ambil_paket_ColumnModel;
var detail_ambil_paket_proxy;
var detail_ambil_paket_writer;
var detail_ambil_paket_reader;
var editor_detail_ambil_paket;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var apaket_idField;
var apaket_jualField;
var apaket_custField;
var apaket_tanggalField;
var apaket_idSearchField;
var apaket_jualSearchField;
var apaket_custSearchField;
var apaket_tanggalSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_ambil_paket_update(oGrid_event){
		var apaket_id_update_pk="";
		var apaket_jual_update=null;
		var apaket_cust_update=null;
		var apaket_tanggal_update_date="";

		apaket_id_update_pk = oGrid_event.record.data.apaket_id;
		if(oGrid_event.record.data.apaket_jual!== null){apaket_jual_update = oGrid_event.record.data.apaket_jual;}
		if(oGrid_event.record.data.apaket_cust!== null){apaket_cust_update = oGrid_event.record.data.apaket_cust;}
	 	if(oGrid_event.record.data.apaket_tanggal!== ""){apaket_tanggal_update_date =oGrid_event.record.data.apaket_tanggal.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_ambil_paket&m=get_action',
			params: {
				task: "UPDATE",
				apaket_id	: apaket_id_update_pk, 
				apaket_jual	:apaket_jual_update,  
				apaket_cust	:apaket_cust_update,  
				apaket_tanggal	: apaket_tanggal_update_date, 
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_ambil_paket_DataStore.commitChanges();
						master_ambil_paket_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the master_ambil_paket.',
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
	function master_ambil_paket_create(){
	
		if(is_master_ambil_paket_form_valid()){	
		var apaket_id_create_pk=null; 
		var apaket_jual_create=null; 
		var apaket_cust_create=null; 
		var apaket_tanggal_create_date=""; 

		if(apaket_idField.getValue()!== null){apaket_id_create = apaket_idField.getValue();}else{apaket_id_create_pk=get_pk_id();} 
		if(apaket_jualField.getValue()!== null){apaket_jual_create = apaket_jualField.getValue();} 
		if(apaket_custField.getValue()!== null){apaket_cust_create = apaket_custField.getValue();} 
		if(apaket_tanggalField.getValue()!== ""){apaket_tanggal_create_date = apaket_tanggalField.getValue().format('Y-m-d');} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_ambil_paket&m=get_action',
			params: {
				task: post2db,
				apaket_id	: apaket_id_create_pk, 
				apaket_jual	: apaket_jual_create, 
				apaket_cust	: apaket_cust_create, 
				apaket_tanggal	: apaket_tanggal_create_date, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_ambil_paket_purge()
						detail_ambil_paket_insert();
						Ext.MessageBox.alert(post2db+' OK','The Master_ambil_paket was '+msg+' successfully.');
						master_ambil_paket_DataStore.reload();
						master_ambil_paket_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_ambil_paket.',
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
			return master_ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_ambil_paket_reset_form(){
		apaket_idField.reset();
		apaket_idField.setValue(null);
		apaket_jualField.reset();
		apaket_jualField.setValue(null);
		apaket_custField.reset();
		apaket_custField.setValue(null);
		apaket_tanggalField.reset();
		apaket_tanggalField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_ambil_paket_set_form(){
		apaket_idField.setValue(master_ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_id'));
		apaket_jualField.setValue(master_ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_jual'));
		apaket_custField.setValue(master_ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_cust'));
		apaket_tanggalField.setValue(master_ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_tanggal'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_ambil_paket_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_ambil_paket_createWindow.isVisible()){
			master_ambil_paket_reset_form();
			post2db='CREATE';
			msg='created';
			master_ambil_paket_createWindow.show();
		} else {
			master_ambil_paket_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_ambil_paket_confirm_delete(){
		// only one master_ambil_paket is selected here
		if(master_ambil_paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_ambil_paket_delete);
		} else if(master_ambil_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_ambil_paket_delete);
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
	function master_ambil_paket_confirm_update(){
		/* only one record is selected here */
		if(master_ambil_paketListEditorGrid.selModel.getCount() == 1) {
			master_ambil_paket_set_form();
			post2db='UPDATE';
			detail_ambil_paket_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			master_ambil_paket_createWindow.show();
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
	function master_ambil_paket_delete(btn){
		if(btn=='yes'){
			var selections = master_ambil_paketListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_ambil_paketListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.apaket_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_ambil_paket&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_ambil_paket_DataStore.reload();
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
	master_ambil_paket_DataStore = new Ext.data.Store({
		id: 'master_ambil_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'apaket_id'
		},[
		/* dataIndex => insert intomaster_ambil_paket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'apaket_id', type: 'int', mapping: 'apaket_id'}, 
			{name: 'apaket_jual', type: 'int', mapping: 'apaket_jual'}, 
			{name: 'apaket_cust', type: 'int', mapping: 'apaket_cust'}, 
			{name: 'apaket_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'apaket_tanggal'}, 
			{name: 'apaket_creator', type: 'string', mapping: 'apaket_creator'}, 
			{name: 'apaket_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'apaket_date_create'}, 
			{name: 'apaket_update', type: 'string', mapping: 'apaket_update'}, 
			{name: 'apaket_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'apaket_date_update'}, 
			{name: 'apaket_revised', type: 'int', mapping: 'apaket_revised'} 
		]),
		sortInfo:{field: 'apaket_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	master_ambil_paket_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'apaket_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Apaket Jual',
			dataIndex: 'apaket_jual',
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
			header: 'Apaket Cust',
			dataIndex: 'apaket_cust',
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
			header: 'Apaket Tanggal',
			dataIndex: 'apaket_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Apaket Creator',
			dataIndex: 'apaket_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Apaket Date Create',
			dataIndex: 'apaket_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Apaket Update',
			dataIndex: 'apaket_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Apaket Date Update',
			dataIndex: 'apaket_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Apaket Revised',
			dataIndex: 'apaket_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_ambil_paket_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_ambil_paketListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_ambil_paketListEditorGrid',
		el: 'fp_master_ambil_paket',
		title: 'List Of Master_ambil_paket',
		autoHeight: true,
		store: master_ambil_paket_DataStore, // DataStore
		cm: master_ambil_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_ambil_paket_DataStore,
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
			handler: master_ambil_paket_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_ambil_paket_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_ambil_paket_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_ambil_paket_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_ambil_paket_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_ambil_paket_print  
		}
		]
	});
	master_ambil_paketListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_ambil_paket_ContextMenu = new Ext.menu.Menu({
		id: 'master_ambil_paket_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_ambil_paket_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_ambil_paket_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_ambil_paket_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_ambil_paket_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_ambil_paket_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_ambil_paket_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_ambil_paket_SelectedRow=rowIndex;
		master_ambil_paket_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_ambil_paket_editContextMenu(){
		master_ambil_paketListEditorGrid.startEditing(master_ambil_paket_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_ambil_paketListEditorGrid.addListener('rowcontextmenu', onmaster_ambil_paket_ListEditGridContextMenu);
	master_ambil_paket_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_ambil_paketListEditorGrid.on('afteredit', master_ambil_paket_update); // inLine Editing Record
	
	/* Identify  apaket_id Field */
	apaket_idField= new Ext.form.NumberField({
		id: 'apaket_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  apaket_jual Field */
	apaket_jualField= new Ext.form.NumberField({
		id: 'apaket_jualField',
		fieldLabel: 'Apaket Jual',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  apaket_cust Field */
	apaket_custField= new Ext.form.NumberField({
		id: 'apaket_custField',
		fieldLabel: 'Apaket Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  apaket_tanggal Field */
	apaket_tanggalField= new Ext.form.DateField({
		id: 'apaket_tanggalField',
		fieldLabel: 'Apaket Tanggal',
		format : 'Y-m-d',
	});
  	/*Fieldset Master*/
	master_ambil_paket_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '50%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [apaket_idField, apaket_jualField, apaket_custField, apaket_tanggalField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_ambil_paket_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dapaket_id', type: 'int', mapping: 'dapaket_id'}, 
			{name: 'dapaket_master', type: 'int', mapping: 'dapaket_master'}, 
			{name: 'dapaket_nama', type: 'int', mapping: 'dapaket_nama'}, 
			{name: 'dapaket_item', type: 'string', mapping: 'dapaket_item'}, 
			{name: 'dapaket_jenis', type: 'string', mapping: 'dapaket_jenis'}, 
			{name: 'dapaket_jumlah', type: 'int', mapping: 'dapaket_jumlah'}, 
			{name: 'dapaket_harga', type: 'float', mapping: 'dapaket_harga'} 
	]);
	//eof
	
	//function for json writer of detail
	var detail_ambil_paket_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_ambil_paket_DataStore = new Ext.data.Store({
		id: 'detail_ambil_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=detail_detail_ambil_paket_list', 
			method: 'POST'
		}),
		reader: detail_ambil_paket_reader,
		baseParams:{master_id: apaket_idField.getValue()},
		sortInfo:{field: 'dapaket_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_ambil_paket= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	detail_ambil_paket_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Dapaket Nama',
			dataIndex: 'dapaket_nama',
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
			header: 'Dapaket Item',
			dataIndex: 'dapaket_item',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 30
          	})
		},
		{
			header: 'Dapaket Jenis',
			dataIndex: 'dapaket_jenis',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dapaket_jenis_value', 'dapaket_jenis_display'],
					data: [['produk','produk'],['perawatan','perawatan']]
					}),
				mode: 'local',
               	displayField: 'dapaket_jenis_display',
               	valueField: 'dapaket_jenis_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Dapaket Jumlah',
			dataIndex: 'dapaket_jumlah',
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
			header: 'Dapaket Harga',
			dataIndex: 'dapaket_harga',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 12,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	detail_ambil_paket_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	detail_ambil_paketListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_ambil_paketListEditorGrid',
		el: 'fp_detail_ambil_paket',
		title: 'Detail detail_ambil_paket',
		height: 250,
		width: 690,
		autoScroll: true,
		store: detail_ambil_paket_DataStore, // DataStore
		colModel: detail_ambil_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_ambil_paket],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_ambil_paket_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_ambil_paket_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_ambil_paket_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function detail_ambil_paket_add(){
		var edit_detail_ambil_paket= new detail_ambil_paketListEditorGrid.store.recordType({
			dapaket_id	:'',		
			dapaket_master	:'',		
			dapaket_nama	:'',		
			dapaket_item	:'',		
			dapaket_jenis	:'',		
			dapaket_jumlah	:'',		
			dapaket_harga	:''		
		});
		editor_detail_ambil_paket.stopEditing();
		detail_ambil_paket_DataStore.insert(0, edit_detail_ambil_paket);
		detail_ambil_paketListEditorGrid.getView().refresh();
		detail_ambil_paketListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_ambil_paket.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_ambil_paket(){
		detail_ambil_paket_DataStore.commitChanges();
		detail_ambil_paketListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_ambil_paket_insert(){
		for(i=0;i<detail_ambil_paket_DataStore.getCount();i++){
			detail_ambil_paket_record=detail_ambil_paket_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_ambil_paket&m=detail_detail_ambil_paket_insert',
				params:{
				dapaket_id	: detail_ambil_paket_record.data.dapaket_id, 
				dapaket_master	: eval(apaket_idField.getValue()), 
				dapaket_nama	: detail_ambil_paket_record.data.dapaket_nama, 
				dapaket_item	: detail_ambil_paket_record.data.dapaket_item, 
				dapaket_jenis	: detail_ambil_paket_record.data.dapaket_jenis, 
				dapaket_jumlah	: detail_ambil_paket_record.data.dapaket_jumlah, 
				dapaket_harga	: detail_ambil_paket_record.data.dapaket_harga 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function detail_ambil_paket_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_ambil_paket&m=detail_detail_ambil_paket_purge',
			params:{ master_id: eval(apaket_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_ambil_paket_confirm_delete(){
		// only one record is selected here
		if(detail_ambil_paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_ambil_paket_delete);
		} else if(detail_ambil_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_ambil_paket_delete);
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
	function detail_ambil_paket_delete(btn){
		if(btn=='yes'){
			var s = detail_ambil_paketListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_ambil_paket_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	detail_ambil_paket_DataStore.on('update', refresh_detail_ambil_paket);
	
	/* Function for retrieve create Window Panel*/ 
	master_ambil_paket_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [master_ambil_paket_masterGroup,detail_ambil_paketListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_ambil_paket_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_ambil_paket_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_ambil_paket_createWindow= new Ext.Window({
		id: 'master_ambil_paket_createWindow',
		title: post2db+'Master_ambil_paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_ambil_paket_create',
		items: master_ambil_paket_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function master_ambil_paket_list_search(){
		// render according to a SQL date format.
		var apaket_id_search=null;
		var apaket_jual_search=null;
		var apaket_cust_search=null;
		var apaket_tanggal_search_date="";

		if(apaket_idSearchField.getValue()!==null){apaket_id_search=apaket_idSearchField.getValue();}
		if(apaket_jualSearchField.getValue()!==null){apaket_jual_search=apaket_jualSearchField.getValue();}
		if(apaket_custSearchField.getValue()!==null){apaket_cust_search=apaket_custSearchField.getValue();}
		if(apaket_tanggalSearchField.getValue()!==""){apaket_tanggal_search_date=apaket_tanggalSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		master_ambil_paket_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			apaket_id	:	apaket_id_search, 
			apaket_jual	:	apaket_jual_search, 
			apaket_cust	:	apaket_cust_search, 
			apaket_tanggal	:	apaket_tanggal_search_date, 
		};
		// Cause the datastore to do another query : 
		master_ambil_paket_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_ambil_paket_reset_search(){
		// reset the store parameters
		master_ambil_paket_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_ambil_paket_DataStore.reload({params: {start: 0, limit: pageS}});
		master_ambil_paket_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  apaket_id Search Field */
	apaket_idSearchField= new Ext.form.NumberField({
		id: 'apaket_idSearchField',
		fieldLabel: 'Apaket Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  apaket_jual Search Field */
	apaket_jualSearchField= new Ext.form.NumberField({
		id: 'apaket_jualSearchField',
		fieldLabel: 'Apaket Jual',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  apaket_cust Search Field */
	apaket_custSearchField= new Ext.form.NumberField({
		id: 'apaket_custSearchField',
		fieldLabel: 'Apaket Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  apaket_tanggal Search Field */
	apaket_tanggalSearchField= new Ext.form.DateField({
		id: 'apaket_tanggalSearchField',
		fieldLabel: 'Apaket Tanggal',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	master_ambil_paket_searchForm = new Ext.FormPanel({
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
				items: [apaket_jualSearchField, apaket_custSearchField, apaket_tanggalSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_ambil_paket_list_search
			},{
				text: 'Close',
				handler: function(){
					master_ambil_paket_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_ambil_paket_searchWindow = new Ext.Window({
		title: 'master_ambil_paket Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_ambil_paket_search',
		items: master_ambil_paket_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_ambil_paket_searchWindow.isVisible()){
			master_ambil_paket_searchWindow.show();
		} else {
			master_ambil_paket_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_ambil_paket_print(){
		var searchquery = "";
		var apaket_jual_print=null;
		var apaket_cust_print=null;
		var apaket_tanggal_print_date="";
		var win;              
		// check if we do have some search data...
		if(master_ambil_paket_DataStore.baseParams.query!==null){searchquery = master_ambil_paket_DataStore.baseParams.query;}
		if(master_ambil_paket_DataStore.baseParams.apaket_jual!==null){apaket_jual_print = master_ambil_paket_DataStore.baseParams.apaket_jual;}
		if(master_ambil_paket_DataStore.baseParams.apaket_cust!==null){apaket_cust_print = master_ambil_paket_DataStore.baseParams.apaket_cust;}
		if(master_ambil_paket_DataStore.baseParams.apaket_tanggal!==""){apaket_tanggal_print_date = master_ambil_paket_DataStore.baseParams.apaket_tanggal;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_ambil_paket&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			apaket_jual : apaket_jual_print,
			apaket_cust : apaket_cust_print,
		  	apaket_tanggal : apaket_tanggal_print_date, 
		  	currentlisting: master_ambil_paket_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_ambil_paketlist.html','master_ambil_paketlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_ambil_paket_export_excel(){
		var searchquery = "";
		var apaket_jual_2excel=null;
		var apaket_cust_2excel=null;
		var apaket_tanggal_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(master_ambil_paket_DataStore.baseParams.query!==null){searchquery = master_ambil_paket_DataStore.baseParams.query;}
		if(master_ambil_paket_DataStore.baseParams.apaket_jual!==null){apaket_jual_2excel = master_ambil_paket_DataStore.baseParams.apaket_jual;}
		if(master_ambil_paket_DataStore.baseParams.apaket_cust!==null){apaket_cust_2excel = master_ambil_paket_DataStore.baseParams.apaket_cust;}
		if(master_ambil_paket_DataStore.baseParams.apaket_tanggal!==""){apaket_tanggal_2excel_date = master_ambil_paket_DataStore.baseParams.apaket_tanggal;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_ambil_paket&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			apaket_jual : apaket_jual_2excel,
			apaket_cust : apaket_cust_2excel,
		  	apaket_tanggal : apaket_tanggal_2excel_date, 
		  	currentlisting: master_ambil_paket_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_ambil_paket"></div>
         <div id="fp_detail_ambil_paket"></div>
		<div id="elwindow_master_ambil_paket_create"></div>
        <div id="elwindow_master_ambil_paket_search"></div>
    </div>
</div>
</body>