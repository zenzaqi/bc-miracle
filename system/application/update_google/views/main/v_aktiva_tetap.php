<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: aktiva_tetap View
	+ Description	: For record view
	+ Filename 		: v_aktiva_tetap.php
 	+ Author  		: 
 	+ Created on 21/Aug/2009 06:45:57
	
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
var aktiva_tetap_DataStore;
var aktiva_tetap_ColumnModel;
var aktiva_tetapListEditorGrid;
var aktiva_tetap_createForm;
var aktiva_tetap_createWindow;
var aktiva_tetap_searchForm;
var aktiva_tetap_searchWindow;
var aktiva_tetap_SelectedRow;
var aktiva_tetap_ContextMenu;
//for detail data
var aktiva_tetap_depresiasi_DataStor;
var aktiva_tetap_depresiasiListEditorGrid;
var aktiva_tetap_depresiasi_ColumnModel;
var aktiva_tetap_depresiasi_proxy;
var aktiva_tetap_depresiasi_writer;
var aktiva_tetap_depresiasi_reader;
var editor_aktiva_tetap_depresiasi;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var aktiva_idField;
var aktiva_akunField;
var aktiva_namaField;
var aktiva_nilai_awalField;
var aktiva_nilai_sekarangField;
var aktiva_idSearchField;
var aktiva_akunSearchField;
var aktiva_namaSearchField;
var aktiva_nilai_awalSearchField;
var aktiva_nilai_sekarangSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function aktiva_tetap_update(oGrid_event){
		var aktiva_id_update_pk="";
		var aktiva_akun_update=null;
		var aktiva_nama_update=null;
		var aktiva_nilai_awal_update=null;
		var aktiva_nilai_sekarang_update=null;

		aktiva_id_update_pk = oGrid_event.record.data.aktiva_id;
		if(oGrid_event.record.data.aktiva_akun!== null){aktiva_akun_update = oGrid_event.record.data.aktiva_akun;}
		if(oGrid_event.record.data.aktiva_nama!== null){aktiva_nama_update = oGrid_event.record.data.aktiva_nama;}
		if(oGrid_event.record.data.aktiva_nilai_awal!== null){aktiva_nilai_awal_update = oGrid_event.record.data.aktiva_nilai_awal;}
		if(oGrid_event.record.data.aktiva_nilai_sekarang!== null){aktiva_nilai_sekarang_update = oGrid_event.record.data.aktiva_nilai_sekarang;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_aktiva_tetap&m=get_action',
			params: {
				task: "UPDATE",
				aktiva_id	: aktiva_id_update_pk, 
				aktiva_akun	:aktiva_akun_update,  
				aktiva_nama	:aktiva_nama_update,  
				aktiva_nilai_awal	:aktiva_nilai_awal_update,  
				aktiva_nilai_sekarang	:aktiva_nilai_sekarang_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						aktiva_tetap_DataStore.commitChanges();
						aktiva_tetap_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the aktiva_tetap.',
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
	function aktiva_tetap_create(){
	
		if(is_aktiva_tetap_form_valid()){	
		var aktiva_id_create_pk=null; 
		var aktiva_akun_create=null; 
		var aktiva_nama_create=null; 
		var aktiva_nilai_awal_create=null; 
		var aktiva_nilai_sekarang_create=null; 

		if(aktiva_idField.getValue()!== null){aktiva_id_create = aktiva_idField.getValue();}else{aktiva_id_create_pk=get_pk_id();} 
		if(aktiva_akunField.getValue()!== null){aktiva_akun_create = aktiva_akunField.getValue();} 
		if(aktiva_namaField.getValue()!== null){aktiva_nama_create = aktiva_namaField.getValue();} 
		if(aktiva_nilai_awalField.getValue()!== null){aktiva_nilai_awal_create = aktiva_nilai_awalField.getValue();} 
		if(aktiva_nilai_sekarangField.getValue()!== null){aktiva_nilai_sekarang_create = aktiva_nilai_sekarangField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_aktiva_tetap&m=get_action',
			params: {
				task: post2db,
				aktiva_id	: aktiva_id_create_pk, 
				aktiva_akun	: aktiva_akun_create, 
				aktiva_nama	: aktiva_nama_create, 
				aktiva_nilai_awal	: aktiva_nilai_awal_create, 
				aktiva_nilai_sekarang	: aktiva_nilai_sekarang_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						aktiva_tetap_depresiasi_purge()
						aktiva_tetap_depresiasi_insert();
						Ext.MessageBox.alert(post2db+' OK','The Aktiva_tetap was '+msg+' successfully.');
						aktiva_tetap_DataStore.reload();
						aktiva_tetap_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Aktiva_tetap.',
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
			return aktiva_tetapListEditorGrid.getSelectionModel().getSelected().get('aktiva_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function aktiva_tetap_reset_form(){
		aktiva_idField.reset();
		aktiva_idField.setValue(null);
		aktiva_akunField.reset();
		aktiva_akunField.setValue(null);
		aktiva_namaField.reset();
		aktiva_namaField.setValue(null);
		aktiva_nilai_awalField.reset();
		aktiva_nilai_awalField.setValue(null);
		aktiva_nilai_sekarangField.reset();
		aktiva_nilai_sekarangField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function aktiva_tetap_set_form(){
		aktiva_idField.setValue(aktiva_tetapListEditorGrid.getSelectionModel().getSelected().get('aktiva_id'));
		aktiva_akunField.setValue(aktiva_tetapListEditorGrid.getSelectionModel().getSelected().get('aktiva_akun'));
		aktiva_namaField.setValue(aktiva_tetapListEditorGrid.getSelectionModel().getSelected().get('aktiva_nama'));
		aktiva_nilai_awalField.setValue(aktiva_tetapListEditorGrid.getSelectionModel().getSelected().get('aktiva_nilai_awal'));
		aktiva_nilai_sekarangField.setValue(aktiva_tetapListEditorGrid.getSelectionModel().getSelected().get('aktiva_nilai_sekarang'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_aktiva_tetap_form_valid(){
		return (true &&  aktiva_akunField.isValid() && aktiva_namaField.isValid() && aktiva_nilai_awalField.isValid() && aktiva_nilai_sekarangField.isValid() && true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!aktiva_tetap_createWindow.isVisible()){
			aktiva_tetap_reset_form();
			post2db='CREATE';
			msg='created';
			aktiva_tetap_createWindow.show();
		} else {
			aktiva_tetap_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function aktiva_tetap_confirm_delete(){
		// only one aktiva_tetap is selected here
		if(aktiva_tetapListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', aktiva_tetap_delete);
		} else if(aktiva_tetapListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', aktiva_tetap_delete);
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
	function aktiva_tetap_confirm_update(){
		/* only one record is selected here */
		if(aktiva_tetapListEditorGrid.selModel.getCount() == 1) {
			aktiva_tetap_set_form();
			post2db='UPDATE';
			aktiva_tetap_depresiasi_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			aktiva_tetap_createWindow.show();
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
	function aktiva_tetap_delete(btn){
		if(btn=='yes'){
			var selections = aktiva_tetapListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< aktiva_tetapListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.aktiva_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_aktiva_tetap&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							aktiva_tetap_DataStore.reload();
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
	aktiva_tetap_DataStore = new Ext.data.Store({
		id: 'aktiva_tetap_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_aktiva_tetap&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'aktiva_id'
		},[
		/* dataIndex => insert intoaktiva_tetap_ColumnModel, Mapping => for initiate table column */ 
			{name: 'aktiva_id', type: 'int', mapping: 'aktiva_id'}, 
			{name: 'aktiva_akun', type: 'int', mapping: 'aktiva_akun'}, 
			{name: 'aktiva_nama', type: 'string', mapping: 'aktiva_nama'}, 
			{name: 'aktiva_nilai_awal', type: 'float', mapping: 'aktiva_nilai_awal'}, 
			{name: 'aktiva_nilai_sekarang', type: 'float', mapping: 'aktiva_nilai_sekarang'}, 
			{name: 'aktiva_creator', type: 'string', mapping: 'aktiva_creator'}, 
			{name: 'aktiva_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'aktiva_date_create'}, 
			{name: 'aktiva_update', type: 'string', mapping: 'aktiva_update'}, 
			{name: 'aktiva_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'aktiva_date_update'}, 
			{name: 'aktiva_revised', type: 'int', mapping: 'aktiva_revised'} 
		]),
		sortInfo:{field: 'aktiva_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	aktiva_tetap_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'aktiva_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Akun',
			dataIndex: 'aktiva_akun',
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
			header: 'Nama',
			dataIndex: 'aktiva_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 250
          	})
		}, 
		{
			header: 'Nilai Awal',
			dataIndex: 'aktiva_nilai_awal',
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
			header: 'Nilai Sekarang',
			dataIndex: 'aktiva_nilai_sekarang',
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
			header: 'Creator',
			dataIndex: 'aktiva_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'aktiva_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'aktiva_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'aktiva_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'aktiva_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	aktiva_tetap_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	aktiva_tetapListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'aktiva_tetapListEditorGrid',
		el: 'fp_aktiva_tetap',
		title: 'List Of Aktiva_tetap',
		autoHeight: true,
		store: aktiva_tetap_DataStore, // DataStore
		cm: aktiva_tetap_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: aktiva_tetap_DataStore,
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
			handler: aktiva_tetap_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: aktiva_tetap_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: aktiva_tetap_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: aktiva_tetap_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: aktiva_tetap_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: aktiva_tetap_print  
		}
		]
	});
	aktiva_tetapListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	aktiva_tetap_ContextMenu = new Ext.menu.Menu({
		id: 'aktiva_tetap_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: aktiva_tetap_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: aktiva_tetap_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: aktiva_tetap_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: aktiva_tetap_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onaktiva_tetap_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		aktiva_tetap_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		aktiva_tetap_SelectedRow=rowIndex;
		aktiva_tetap_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function aktiva_tetap_editContextMenu(){
		aktiva_tetapListEditorGrid.startEditing(aktiva_tetap_SelectedRow,1);
  	}
	/* End of Function */
  	
	aktiva_tetapListEditorGrid.addListener('rowcontextmenu', onaktiva_tetap_ListEditGridContextMenu);
	aktiva_tetap_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	aktiva_tetapListEditorGrid.on('afteredit', aktiva_tetap_update); // inLine Editing Record
	
	/* Identify  aktiva_id Field */
	aktiva_idField= new Ext.form.NumberField({
		id: 'aktiva_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  aktiva_akun Field */
	aktiva_akunField= new Ext.form.NumberField({
		id: 'aktiva_akunField',
		fieldLabel: 'Akun',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  aktiva_nama Field */
	aktiva_namaField= new Ext.form.TextField({
		id: 'aktiva_namaField',
		fieldLabel: 'Nama',
		maxLength: 250,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  aktiva_nilai_awal Field */
	aktiva_nilai_awalField= new Ext.form.NumberField({
		id: 'aktiva_nilai_awalField',
		fieldLabel: 'Nilai Awal',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  aktiva_nilai_sekarang Field */
	aktiva_nilai_sekarangField= new Ext.form.NumberField({
		id: 'aktiva_nilai_sekarangField',
		fieldLabel: 'Nilai Sekarang',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	/*Fieldset Master*/
	aktiva_tetap_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [aktiva_akunField, aktiva_namaField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [aktiva_nilai_awalField, aktiva_nilai_sekarangField,aktiva_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var aktiva_tetap_depresiasi_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'daktiva_id', type: 'int', mapping: 'daktiva_id'}, 
			{name: 'daktiva_master', type: 'int', mapping: 'daktiva_master'}, 
			{name: 'daktiva_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'daktiva_tanggal'}, 
			{name: 'daktiva_depresiasi', type: 'float', mapping: 'daktiva_depresiasi'}, 
			{name: 'daktiva_saldo', type: 'float', mapping: 'daktiva_saldo'} 
	]);
	//eof
	
	//function for json writer of detail
	var aktiva_tetap_depresiasi_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	aktiva_tetap_depresiasi_DataStore = new Ext.data.Store({
		id: 'aktiva_tetap_depresiasi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_aktiva_tetap&m=detail_aktiva_tetap_depresiasi_list', 
			method: 'POST'
		}),
		reader: aktiva_tetap_depresiasi_reader,
		baseParams:{master_id: aktiva_idField.getValue()},
		sortInfo:{field: 'daktiva_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_aktiva_tetap_depresiasi= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	aktiva_tetap_depresiasi_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Tanggal',
			dataIndex: 'daktiva_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		},
		{
			header: 'Depresiasi',
			dataIndex: 'daktiva_depresiasi',
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
			header: 'Saldo',
			dataIndex: 'daktiva_saldo',
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
	aktiva_tetap_depresiasi_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	aktiva_tetap_depresiasiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'aktiva_tetap_depresiasiListEditorGrid',
		el: 'fp_aktiva_tetap_depresiasi',
		title: 'Depresiasi Aktiva',
		height: 250,
		width: 690,
		autoScroll: true,
		store: aktiva_tetap_depresiasi_DataStore, // DataStore
		colModel: aktiva_tetap_depresiasi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_aktiva_tetap_depresiasi],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: aktiva_tetap_depresiasi_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: aktiva_tetap_depresiasi_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: aktiva_tetap_depresiasi_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function aktiva_tetap_depresiasi_add(){
		var edit_aktiva_tetap_depresiasi= new aktiva_tetap_depresiasiListEditorGrid.store.recordType({
			daktiva_id	:'',		
			daktiva_master	:'',		
			daktiva_tanggal	:'',		
			daktiva_depresiasi	:'',		
			daktiva_saldo	:''		
		});
		editor_aktiva_tetap_depresiasi.stopEditing();
		aktiva_tetap_depresiasi_DataStore.insert(0, edit_aktiva_tetap_depresiasi);
		aktiva_tetap_depresiasiListEditorGrid.getView().refresh();
		aktiva_tetap_depresiasiListEditorGrid.getSelectionModel().selectRow(0);
		editor_aktiva_tetap_depresiasi.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_aktiva_tetap_depresiasi(){
		aktiva_tetap_depresiasi_DataStore.commitChanges();
		aktiva_tetap_depresiasiListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function aktiva_tetap_depresiasi_insert(){
		for(i=0;i<aktiva_tetap_depresiasi_DataStore.getCount();i++){
			aktiva_tetap_depresiasi_record=aktiva_tetap_depresiasi_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_aktiva_tetap&m=detail_aktiva_tetap_depresiasi_insert',
				params:{
				daktiva_id	: aktiva_tetap_depresiasi_record.data.daktiva_id, 
				daktiva_master	: eval(aktiva_idField.getValue()), 
				daktiva_tanggal	: aktiva_tetap_depresiasi_record.data.daktiva_tanggal.format('Y-m-d'),
				daktiva_depresiasi	: aktiva_tetap_depresiasi_record.data.daktiva_depresiasi, 
				daktiva_saldo	: aktiva_tetap_depresiasi_record.data.daktiva_saldo 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function aktiva_tetap_depresiasi_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_aktiva_tetap&m=detail_aktiva_tetap_depresiasi_purge',
			params:{ master_id: eval(aktiva_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function aktiva_tetap_depresiasi_confirm_delete(){
		// only one record is selected here
		if(aktiva_tetap_depresiasiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', aktiva_tetap_depresiasi_delete);
		} else if(aktiva_tetap_depresiasiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', aktiva_tetap_depresiasi_delete);
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
	function aktiva_tetap_depresiasi_delete(btn){
		if(btn=='yes'){
			var s = aktiva_tetap_depresiasiListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				aktiva_tetap_depresiasi_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	aktiva_tetap_depresiasi_DataStore.on('update', refresh_aktiva_tetap_depresiasi);
	
	/* Function for retrieve create Window Panel*/ 
	aktiva_tetap_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [aktiva_tetap_masterGroup,aktiva_tetap_depresiasiListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: aktiva_tetap_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					aktiva_tetap_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	aktiva_tetap_createWindow= new Ext.Window({
		id: 'aktiva_tetap_createWindow',
		title: post2db+'Aktiva_tetap',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_aktiva_tetap_create',
		items: aktiva_tetap_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function aktiva_tetap_list_search(){
		// render according to a SQL date format.
		var aktiva_id_search=null;
		var aktiva_akun_search=null;
		var aktiva_nama_search=null;
		var aktiva_nilai_awal_search=null;
		var aktiva_nilai_sekarang_search=null;

		if(aktiva_idSearchField.getValue()!==null){aktiva_id_search=aktiva_idSearchField.getValue();}
		if(aktiva_akunSearchField.getValue()!==null){aktiva_akun_search=aktiva_akunSearchField.getValue();}
		if(aktiva_namaSearchField.getValue()!==null){aktiva_nama_search=aktiva_namaSearchField.getValue();}
		if(aktiva_nilai_awalSearchField.getValue()!==null){aktiva_nilai_awal_search=aktiva_nilai_awalSearchField.getValue();}
		if(aktiva_nilai_sekarangSearchField.getValue()!==null){aktiva_nilai_sekarang_search=aktiva_nilai_sekarangSearchField.getValue();}
		// change the store parameters
		aktiva_tetap_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			aktiva_id	:	aktiva_id_search, 
			aktiva_akun	:	aktiva_akun_search, 
			aktiva_nama	:	aktiva_nama_search, 
			aktiva_nilai_awal	:	aktiva_nilai_awal_search, 
			aktiva_nilai_sekarang	:	aktiva_nilai_sekarang_search, 
		};
		// Cause the datastore to do another query : 
		aktiva_tetap_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function aktiva_tetap_reset_search(){
		// reset the store parameters
		aktiva_tetap_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		aktiva_tetap_DataStore.reload({params: {start: 0, limit: pageS}});
		aktiva_tetap_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  aktiva_id Search Field */
	aktiva_idSearchField= new Ext.form.NumberField({
		id: 'aktiva_idSearchField',
		fieldLabel: 'Aktiva Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  aktiva_akun Search Field */
	aktiva_akunSearchField= new Ext.form.NumberField({
		id: 'aktiva_akunSearchField',
		fieldLabel: 'Aktiva Akun',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  aktiva_nama Search Field */
	aktiva_namaSearchField= new Ext.form.TextField({
		id: 'aktiva_namaSearchField',
		fieldLabel: 'Aktiva Nama',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  aktiva_nilai_awal Search Field */
	aktiva_nilai_awalSearchField= new Ext.form.NumberField({
		id: 'aktiva_nilai_awalSearchField',
		fieldLabel: 'Aktiva Nilai Awal',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  aktiva_nilai_sekarang Search Field */
	aktiva_nilai_sekarangSearchField= new Ext.form.NumberField({
		id: 'aktiva_nilai_sekarangSearchField',
		fieldLabel: 'Aktiva Nilai Sekarang',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	aktiva_tetap_searchForm = new Ext.FormPanel({
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
				items: [aktiva_akunSearchField, aktiva_namaSearchField, aktiva_nilai_awalSearchField, aktiva_nilai_sekarangSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: aktiva_tetap_list_search
			},{
				text: 'Close',
				handler: function(){
					aktiva_tetap_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	aktiva_tetap_searchWindow = new Ext.Window({
		title: 'aktiva_tetap Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_aktiva_tetap_search',
		items: aktiva_tetap_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!aktiva_tetap_searchWindow.isVisible()){
			aktiva_tetap_searchWindow.show();
		} else {
			aktiva_tetap_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function aktiva_tetap_print(){
		var searchquery = "";
		var aktiva_akun_print=null;
		var aktiva_nama_print=null;
		var aktiva_nilai_awal_print=null;
		var aktiva_nilai_sekarang_print=null;
		var win;              
		// check if we do have some search data...
		if(aktiva_tetap_DataStore.baseParams.query!==null){searchquery = aktiva_tetap_DataStore.baseParams.query;}
		if(aktiva_tetap_DataStore.baseParams.aktiva_akun!==null){aktiva_akun_print = aktiva_tetap_DataStore.baseParams.aktiva_akun;}
		if(aktiva_tetap_DataStore.baseParams.aktiva_nama!==null){aktiva_nama_print = aktiva_tetap_DataStore.baseParams.aktiva_nama;}
		if(aktiva_tetap_DataStore.baseParams.aktiva_nilai_awal!==null){aktiva_nilai_awal_print = aktiva_tetap_DataStore.baseParams.aktiva_nilai_awal;}
		if(aktiva_tetap_DataStore.baseParams.aktiva_nilai_sekarang!==null){aktiva_nilai_sekarang_print = aktiva_tetap_DataStore.baseParams.aktiva_nilai_sekarang;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_aktiva_tetap&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			aktiva_akun : aktiva_akun_print,
			aktiva_nama : aktiva_nama_print,
			aktiva_nilai_awal : aktiva_nilai_awal_print,
			aktiva_nilai_sekarang : aktiva_nilai_sekarang_print,
		  	currentlisting: aktiva_tetap_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./aktiva_tetaplist.html','aktiva_tetaplist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function aktiva_tetap_export_excel(){
		var searchquery = "";
		var aktiva_akun_2excel=null;
		var aktiva_nama_2excel=null;
		var aktiva_nilai_awal_2excel=null;
		var aktiva_nilai_sekarang_2excel=null;
		var win;              
		// check if we do have some search data...
		if(aktiva_tetap_DataStore.baseParams.query!==null){searchquery = aktiva_tetap_DataStore.baseParams.query;}
		if(aktiva_tetap_DataStore.baseParams.aktiva_akun!==null){aktiva_akun_2excel = aktiva_tetap_DataStore.baseParams.aktiva_akun;}
		if(aktiva_tetap_DataStore.baseParams.aktiva_nama!==null){aktiva_nama_2excel = aktiva_tetap_DataStore.baseParams.aktiva_nama;}
		if(aktiva_tetap_DataStore.baseParams.aktiva_nilai_awal!==null){aktiva_nilai_awal_2excel = aktiva_tetap_DataStore.baseParams.aktiva_nilai_awal;}
		if(aktiva_tetap_DataStore.baseParams.aktiva_nilai_sekarang!==null){aktiva_nilai_sekarang_2excel = aktiva_tetap_DataStore.baseParams.aktiva_nilai_sekarang;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_aktiva_tetap&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			aktiva_akun : aktiva_akun_2excel,
			aktiva_nama : aktiva_nama_2excel,
			aktiva_nilai_awal : aktiva_nilai_awal_2excel,
			aktiva_nilai_sekarang : aktiva_nilai_sekarang_2excel,
		  	currentlisting: aktiva_tetap_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_aktiva_tetap"></div>
         <div id="fp_aktiva_tetap_depresiasi"></div>
		<div id="elwindow_aktiva_tetap_create"></div>
        <div id="elwindow_aktiva_tetap_search"></div>
    </div>
</div>
</body>