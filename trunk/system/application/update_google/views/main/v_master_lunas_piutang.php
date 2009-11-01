<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_lunas_piutang View
	+ Description	: For record view
	+ Filename 		: v_master_lunas_piutang.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:05
	
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
var master_lunas_piutang_DataStore;
var master_lunas_piutang_ColumnModel;
var master_lunas_piutangListEditorGrid;
var master_lunas_piutang_createForm;
var master_lunas_piutang_createWindow;
var master_lunas_piutang_searchForm;
var master_lunas_piutang_searchWindow;
var master_lunas_piutang_SelectedRow;
var master_lunas_piutang_ContextMenu;
//for detail data
var detail_lunas_piutang_DataStor;
var detail_lunas_piutangListEditorGrid;
var detail_lunas_piutang_ColumnModel;
var detail_lunas_piutang_proxy;
var detail_lunas_piutang_writer;
var detail_lunas_piutang_reader;
var editor_detail_lunas_piutang;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var lpiutang_idField;
var lpiutang_noField;
var lpiutang_custField;
var lpiutang_tanggalField;
var lpiutang_keteranganField;
var lpiutang_idSearchField;
var lpiutang_noSearchField;
var lpiutang_custSearchField;
var lpiutang_tanggalSearchField;
var lpiutang_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_lunas_piutang_update(oGrid_event){
		var lpiutang_id_update_pk="";
		var lpiutang_no_update=null;
		var lpiutang_cust_update=null;
		var lpiutang_tanggal_update_date="";
		var lpiutang_keterangan_update=null;

		lpiutang_id_update_pk = oGrid_event.record.data.lpiutang_id;
		if(oGrid_event.record.data.lpiutang_no!== null){lpiutang_no_update = oGrid_event.record.data.lpiutang_no;}
		if(oGrid_event.record.data.lpiutang_cust!== null){lpiutang_cust_update = oGrid_event.record.data.lpiutang_cust;}
	 	if(oGrid_event.record.data.lpiutang_tanggal!== ""){lpiutang_tanggal_update_date =oGrid_event.record.data.lpiutang_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.lpiutang_keterangan!== null){lpiutang_keterangan_update = oGrid_event.record.data.lpiutang_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_lunas_piutang&m=get_action',
			params: {
				task: "UPDATE",
				lpiutang_id	: lpiutang_id_update_pk, 
				lpiutang_no	:lpiutang_no_update,  
				lpiutang_cust	:lpiutang_cust_update,  
				lpiutang_tanggal	: lpiutang_tanggal_update_date, 
				lpiutang_keterangan	:lpiutang_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_lunas_piutang_DataStore.commitChanges();
						master_lunas_piutang_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the master_lunas_piutang.',
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
	function master_lunas_piutang_create(){
	
		if(is_master_lunas_piutang_form_valid()){	
		var lpiutang_id_create_pk=null; 
		var lpiutang_no_create=null; 
		var lpiutang_cust_create=null; 
		var lpiutang_tanggal_create_date=""; 
		var lpiutang_keterangan_create=null; 

		if(lpiutang_idField.getValue()!== null){lpiutang_id_create = lpiutang_idField.getValue();}else{lpiutang_id_create_pk=get_pk_id();} 
		if(lpiutang_noField.getValue()!== null){lpiutang_no_create = lpiutang_noField.getValue();} 
		if(lpiutang_custField.getValue()!== null){lpiutang_cust_create = lpiutang_custField.getValue();} 
		if(lpiutang_tanggalField.getValue()!== ""){lpiutang_tanggal_create_date = lpiutang_tanggalField.getValue().format('Y-m-d');} 
		if(lpiutang_keteranganField.getValue()!== null){lpiutang_keterangan_create = lpiutang_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_lunas_piutang&m=get_action',
			params: {
				task: post2db,
				lpiutang_id	: lpiutang_id_create_pk, 
				lpiutang_no	: lpiutang_no_create, 
				lpiutang_cust	: lpiutang_cust_create, 
				lpiutang_tanggal	: lpiutang_tanggal_create_date, 
				lpiutang_keterangan	: lpiutang_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_lunas_piutang_purge()
						detail_lunas_piutang_insert();
						Ext.MessageBox.alert(post2db+' OK','The Master_lunas_piutang was '+msg+' successfully.');
						master_lunas_piutang_DataStore.reload();
						master_lunas_piutang_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_lunas_piutang.',
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
			return master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_lunas_piutang_reset_form(){
		lpiutang_idField.reset();
		lpiutang_idField.setValue(null);
		lpiutang_noField.reset();
		lpiutang_noField.setValue(null);
		lpiutang_custField.reset();
		lpiutang_custField.setValue(null);
		lpiutang_tanggalField.reset();
		lpiutang_tanggalField.setValue(null);
		lpiutang_keteranganField.reset();
		lpiutang_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_lunas_piutang_set_form(){
		lpiutang_idField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_id'));
		lpiutang_noField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_no'));
		lpiutang_custField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_cust'));
		lpiutang_tanggalField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_tanggal'));
		lpiutang_keteranganField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_lunas_piutang_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_lunas_piutang_createWindow.isVisible()){
			master_lunas_piutang_reset_form();
			post2db='CREATE';
			msg='created';
			master_lunas_piutang_createWindow.show();
		} else {
			master_lunas_piutang_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_lunas_piutang_confirm_delete(){
		// only one master_lunas_piutang is selected here
		if(master_lunas_piutangListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_lunas_piutang_delete);
		} else if(master_lunas_piutangListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_lunas_piutang_delete);
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
	function master_lunas_piutang_confirm_update(){
		/* only one record is selected here */
		if(master_lunas_piutangListEditorGrid.selModel.getCount() == 1) {
			master_lunas_piutang_set_form();
			post2db='UPDATE';
			detail_lunas_piutang_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			master_lunas_piutang_createWindow.show();
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
	function master_lunas_piutang_delete(btn){
		if(btn=='yes'){
			var selections = master_lunas_piutangListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_lunas_piutangListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.lpiutang_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_lunas_piutang&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_lunas_piutang_DataStore.reload();
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
	master_lunas_piutang_DataStore = new Ext.data.Store({
		id: 'master_lunas_piutang_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_lunas_piutang&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'lpiutang_id'
		},[
		/* dataIndex => insert intomaster_lunas_piutang_ColumnModel, Mapping => for initiate table column */ 
			{name: 'lpiutang_id', type: 'int', mapping: 'lpiutang_id'}, 
			{name: 'lpiutang_no', type: 'string', mapping: 'lpiutang_no'}, 
			{name: 'lpiutang_cust', type: 'int', mapping: 'lpiutang_cust'}, 
			{name: 'lpiutang_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'lpiutang_tanggal'}, 
			{name: 'lpiutang_keterangan', type: 'string', mapping: 'lpiutang_keterangan'}, 
			{name: 'lpiutang_creator', type: 'string', mapping: 'lpiutang_creator'}, 
			{name: 'lpiutang_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'lpiutang_date_create'}, 
			{name: 'lpiutang_update', type: 'string', mapping: 'lpiutang_update'}, 
			{name: 'lpiutang_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'lpiutang_date_update'}, 
			{name: 'lpiutang_revised', type: 'int', mapping: 'lpiutang_revised'} 
		]),
		sortInfo:{field: 'lpiutang_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	master_lunas_piutang_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'lpiutang_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Lpiutang No',
			dataIndex: 'lpiutang_no',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: 'Lpiutang Cust',
			dataIndex: 'lpiutang_cust',
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
			header: 'Lpiutang Tanggal',
			dataIndex: 'lpiutang_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Lpiutang Keterangan',
			dataIndex: 'lpiutang_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 150
          	})
		}, 
		{
			header: 'Lpiutang Creator',
			dataIndex: 'lpiutang_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Lpiutang Date Create',
			dataIndex: 'lpiutang_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Lpiutang Update',
			dataIndex: 'lpiutang_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Lpiutang Date Update',
			dataIndex: 'lpiutang_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Lpiutang Revised',
			dataIndex: 'lpiutang_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_lunas_piutang_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_lunas_piutangListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_lunas_piutangListEditorGrid',
		el: 'fp_master_lunas_piutang',
		title: 'List Of Master_lunas_piutang',
		autoHeight: true,
		store: master_lunas_piutang_DataStore, // DataStore
		cm: master_lunas_piutang_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_lunas_piutang_DataStore,
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
			handler: master_lunas_piutang_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_lunas_piutang_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_lunas_piutang_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_lunas_piutang_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_lunas_piutang_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_lunas_piutang_print  
		}
		]
	});
	master_lunas_piutangListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_lunas_piutang_ContextMenu = new Ext.menu.Menu({
		id: 'master_lunas_piutang_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_lunas_piutang_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_lunas_piutang_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_lunas_piutang_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_lunas_piutang_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_lunas_piutang_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_lunas_piutang_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_lunas_piutang_SelectedRow=rowIndex;
		master_lunas_piutang_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_lunas_piutang_editContextMenu(){
		master_lunas_piutangListEditorGrid.startEditing(master_lunas_piutang_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_lunas_piutangListEditorGrid.addListener('rowcontextmenu', onmaster_lunas_piutang_ListEditGridContextMenu);
	master_lunas_piutang_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_lunas_piutangListEditorGrid.on('afteredit', master_lunas_piutang_update); // inLine Editing Record
	
	/* Identify  lpiutang_id Field */
	lpiutang_idField= new Ext.form.NumberField({
		id: 'lpiutang_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  lpiutang_no Field */
	lpiutang_noField= new Ext.form.TextField({
		id: 'lpiutang_noField',
		fieldLabel: 'Lpiutang No',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  lpiutang_cust Field */
	lpiutang_custField= new Ext.form.NumberField({
		id: 'lpiutang_custField',
		fieldLabel: 'Lpiutang Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  lpiutang_tanggal Field */
	lpiutang_tanggalField= new Ext.form.DateField({
		id: 'lpiutang_tanggalField',
		fieldLabel: 'Lpiutang Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  lpiutang_keterangan Field */
	lpiutang_keteranganField= new Ext.form.TextField({
		id: 'lpiutang_keteranganField',
		fieldLabel: 'Lpiutang Keterangan',
		maxLength: 150,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	master_lunas_piutang_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [lpiutang_idField, lpiutang_noField, lpiutang_custField, lpiutang_tanggalField, lpiutang_keteranganField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_lunas_piutang_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dpiutang_id', type: 'int', mapping: 'dpiutang_id'}, 
			{name: 'dpiutang_master', type: 'int', mapping: 'dpiutang_master'}, 
			{name: 'dpiutang_nohutang', type: 'int', mapping: 'dpiutang_nohutang'}, 
			{name: 'dpiutang_nilai', type: 'float', mapping: 'dpiutang_nilai'} 
	]);
	//eof
	
	//function for json writer of detail
	var detail_lunas_piutang_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_lunas_piutang_DataStore = new Ext.data.Store({
		id: 'detail_lunas_piutang_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_lunas_piutang&m=detail_detail_lunas_piutang_list', 
			method: 'POST'
		}),
		reader: detail_lunas_piutang_reader,
		baseParams:{master_id: lpiutang_idField.getValue()},
		sortInfo:{field: 'dpiutang_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_lunas_piutang= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	detail_lunas_piutang_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Dpiutang Nohutang',
			dataIndex: 'dpiutang_nohutang',
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
			header: 'Dpiutang Nilai',
			dataIndex: 'dpiutang_nilai',
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
	detail_lunas_piutang_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	detail_lunas_piutangListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_lunas_piutangListEditorGrid',
		el: 'fp_detail_lunas_piutang',
		title: 'Detail detail_lunas_piutang',
		height: 250,
		width: 690,
		autoScroll: true,
		store: detail_lunas_piutang_DataStore, // DataStore
		colModel: detail_lunas_piutang_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_lunas_piutang],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_lunas_piutang_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_lunas_piutang_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_lunas_piutang_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function detail_lunas_piutang_add(){
		var edit_detail_lunas_piutang= new detail_lunas_piutangListEditorGrid.store.recordType({
			dpiutang_id	:'',		
			dpiutang_master	:'',		
			dpiutang_nohutang	:'',		
			dpiutang_nilai	:''		
		});
		editor_detail_lunas_piutang.stopEditing();
		detail_lunas_piutang_DataStore.insert(0, edit_detail_lunas_piutang);
		detail_lunas_piutangListEditorGrid.getView().refresh();
		detail_lunas_piutangListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_lunas_piutang.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_lunas_piutang(){
		detail_lunas_piutang_DataStore.commitChanges();
		detail_lunas_piutangListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_lunas_piutang_insert(){
		for(i=0;i<detail_lunas_piutang_DataStore.getCount();i++){
			detail_lunas_piutang_record=detail_lunas_piutang_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_lunas_piutang&m=detail_detail_lunas_piutang_insert',
				params:{
				dpiutang_id	: detail_lunas_piutang_record.data.dpiutang_id, 
				dpiutang_master	: eval(lpiutang_idField.getValue()), 
				dpiutang_nohutang	: detail_lunas_piutang_record.data.dpiutang_nohutang, 
				dpiutang_nilai	: detail_lunas_piutang_record.data.dpiutang_nilai 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function detail_lunas_piutang_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_lunas_piutang&m=detail_detail_lunas_piutang_purge',
			params:{ master_id: eval(lpiutang_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_lunas_piutang_confirm_delete(){
		// only one record is selected here
		if(detail_lunas_piutangListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_lunas_piutang_delete);
		} else if(detail_lunas_piutangListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_lunas_piutang_delete);
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
	function detail_lunas_piutang_delete(btn){
		if(btn=='yes'){
			var s = detail_lunas_piutangListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_lunas_piutang_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	detail_lunas_piutang_DataStore.on('update', refresh_detail_lunas_piutang);
	
	/* Function for retrieve create Window Panel*/ 
	master_lunas_piutang_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [master_lunas_piutang_masterGroup,detail_lunas_piutangListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_lunas_piutang_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_lunas_piutang_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_lunas_piutang_createWindow= new Ext.Window({
		id: 'master_lunas_piutang_createWindow',
		title: post2db+'Master_lunas_piutang',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_lunas_piutang_create',
		items: master_lunas_piutang_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function master_lunas_piutang_list_search(){
		// render according to a SQL date format.
		var lpiutang_id_search=null;
		var lpiutang_no_search=null;
		var lpiutang_cust_search=null;
		var lpiutang_tanggal_search_date="";
		var lpiutang_keterangan_search=null;

		if(lpiutang_idSearchField.getValue()!==null){lpiutang_id_search=lpiutang_idSearchField.getValue();}
		if(lpiutang_noSearchField.getValue()!==null){lpiutang_no_search=lpiutang_noSearchField.getValue();}
		if(lpiutang_custSearchField.getValue()!==null){lpiutang_cust_search=lpiutang_custSearchField.getValue();}
		if(lpiutang_tanggalSearchField.getValue()!==""){lpiutang_tanggal_search_date=lpiutang_tanggalSearchField.getValue().format('Y-m-d');}
		if(lpiutang_keteranganSearchField.getValue()!==null){lpiutang_keterangan_search=lpiutang_keteranganSearchField.getValue();}
		// change the store parameters
		master_lunas_piutang_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			lpiutang_id	:	lpiutang_id_search, 
			lpiutang_no	:	lpiutang_no_search, 
			lpiutang_cust	:	lpiutang_cust_search, 
			lpiutang_tanggal	:	lpiutang_tanggal_search_date, 
			lpiutang_keterangan	:	lpiutang_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		master_lunas_piutang_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_lunas_piutang_reset_search(){
		// reset the store parameters
		master_lunas_piutang_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_lunas_piutang_DataStore.reload({params: {start: 0, limit: pageS}});
		master_lunas_piutang_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  lpiutang_id Search Field */
	lpiutang_idSearchField= new Ext.form.NumberField({
		id: 'lpiutang_idSearchField',
		fieldLabel: 'Lpiutang Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  lpiutang_no Search Field */
	lpiutang_noSearchField= new Ext.form.TextField({
		id: 'lpiutang_noSearchField',
		fieldLabel: 'Lpiutang No',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  lpiutang_cust Search Field */
	lpiutang_custSearchField= new Ext.form.NumberField({
		id: 'lpiutang_custSearchField',
		fieldLabel: 'Lpiutang Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  lpiutang_tanggal Search Field */
	lpiutang_tanggalSearchField= new Ext.form.DateField({
		id: 'lpiutang_tanggalSearchField',
		fieldLabel: 'Lpiutang Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  lpiutang_keterangan Search Field */
	lpiutang_keteranganSearchField= new Ext.form.TextField({
		id: 'lpiutang_keteranganSearchField',
		fieldLabel: 'Lpiutang Keterangan',
		maxLength: 150,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_lunas_piutang_searchForm = new Ext.FormPanel({
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
				items: [lpiutang_noSearchField, lpiutang_custSearchField, lpiutang_tanggalSearchField, lpiutang_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_lunas_piutang_list_search
			},{
				text: 'Close',
				handler: function(){
					master_lunas_piutang_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_lunas_piutang_searchWindow = new Ext.Window({
		title: 'master_lunas_piutang Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_lunas_piutang_search',
		items: master_lunas_piutang_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_lunas_piutang_searchWindow.isVisible()){
			master_lunas_piutang_searchWindow.show();
		} else {
			master_lunas_piutang_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_lunas_piutang_print(){
		var searchquery = "";
		var lpiutang_no_print=null;
		var lpiutang_cust_print=null;
		var lpiutang_tanggal_print_date="";
		var lpiutang_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_lunas_piutang_DataStore.baseParams.query!==null){searchquery = master_lunas_piutang_DataStore.baseParams.query;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_no!==null){lpiutang_no_print = master_lunas_piutang_DataStore.baseParams.lpiutang_no;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_cust!==null){lpiutang_cust_print = master_lunas_piutang_DataStore.baseParams.lpiutang_cust;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_tanggal!==""){lpiutang_tanggal_print_date = master_lunas_piutang_DataStore.baseParams.lpiutang_tanggal;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_keterangan!==null){lpiutang_keterangan_print = master_lunas_piutang_DataStore.baseParams.lpiutang_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_lunas_piutang&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			lpiutang_no : lpiutang_no_print,
			lpiutang_cust : lpiutang_cust_print,
		  	lpiutang_tanggal : lpiutang_tanggal_print_date, 
			lpiutang_keterangan : lpiutang_keterangan_print,
		  	currentlisting: master_lunas_piutang_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_lunas_piutanglist.html','master_lunas_piutanglist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_lunas_piutang_export_excel(){
		var searchquery = "";
		var lpiutang_no_2excel=null;
		var lpiutang_cust_2excel=null;
		var lpiutang_tanggal_2excel_date="";
		var lpiutang_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_lunas_piutang_DataStore.baseParams.query!==null){searchquery = master_lunas_piutang_DataStore.baseParams.query;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_no!==null){lpiutang_no_2excel = master_lunas_piutang_DataStore.baseParams.lpiutang_no;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_cust!==null){lpiutang_cust_2excel = master_lunas_piutang_DataStore.baseParams.lpiutang_cust;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_tanggal!==""){lpiutang_tanggal_2excel_date = master_lunas_piutang_DataStore.baseParams.lpiutang_tanggal;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_keterangan!==null){lpiutang_keterangan_2excel = master_lunas_piutang_DataStore.baseParams.lpiutang_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_lunas_piutang&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			lpiutang_no : lpiutang_no_2excel,
			lpiutang_cust : lpiutang_cust_2excel,
		  	lpiutang_tanggal : lpiutang_tanggal_2excel_date, 
			lpiutang_keterangan : lpiutang_keterangan_2excel,
		  	currentlisting: master_lunas_piutang_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_lunas_piutang"></div>
         <div id="fp_detail_lunas_piutang"></div>
		<div id="elwindow_master_lunas_piutang_create"></div>
        <div id="elwindow_master_lunas_piutang_search"></div>
    </div>
</div>
</body>