<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_penyesuaian_stok View
	+ Description	: For record view
	+ Filename 		: v_master_penyesuaian_stok.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 14/Jul/2009 15:33:36
	
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
var master_penyesuaian_stok_DataStore;
var master_penyesuaian_stok_ColumnModel;
var master_penyesuaian_stokListEditorGrid;
var master_penyesuaian_stok_createForm;
var master_penyesuaian_stok_createWindow;
var master_penyesuaian_stok_searchForm;
var master_penyesuaian_stok_searchWindow;
var master_penyesuaian_stok_SelectedRow;
var master_penyesuaian_stok_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var koreksi_idField;
var koreksi_gudangField;
var koreksi_tanggalField;
var koreksi_keteranganField;
var koreksi_creatorField;
var koreksi_date_createField;
var koreksi_updateField;
var koreksi_date_updateField;
var koreksi_revisedField;
var koreksi_idSearchField;
var koreksi_gudangSearchField;
var koreksi_tanggalSearchField;
var koreksi_keteranganSearchField;
var koreksi_creatorSearchField;
var koreksi_date_createSearchField;
var koreksi_updateSearchField;
var koreksi_date_updateSearchField;
var koreksi_revisedSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_penyesuaian_stok_update(oGrid_event){
	var koreksi_id_update_pk="";
	var koreksi_gudang_update=null;
	var koreksi_tanggal_update_date="";
	var koreksi_keterangan_update=null;
	var koreksi_creator_update=null;
	var koreksi_date_create_update_date="";
	var koreksi_update_update=null;
	var koreksi_date_update_update_date="";
	var koreksi_revised_update=null;

	koreksi_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.koreksi_gudang!== null){koreksi_gudang_update = oGrid_event.record.data.koreksi_gudang;}
	 if(oGrid_event.record.data.koreksi_tanggal!== ""){koreksi_tanggal_update_date = oGrid_event.record.data.koreksi_tanggal.format('Y-m-d');}
	if(oGrid_event.record.data.koreksi_keterangan!== null){koreksi_keterangan_update = oGrid_event.record.data.koreksi_keterangan;}
	if(oGrid_event.record.data.koreksi_creator!== null){koreksi_creator_update = oGrid_event.record.data.koreksi_creator;}
	 if(oGrid_event.record.data.koreksi_date_create!== ""){koreksi_date_create_update_date = oGrid_event.record.data.koreksi_date_create.format('Y-m-d');}
	if(oGrid_event.record.data.koreksi_update!== null){koreksi_update_update = oGrid_event.record.data.koreksi_update;}
	 if(oGrid_event.record.data.koreksi_date_update!== ""){koreksi_date_update_update_date = oGrid_event.record.data.koreksi_date_update.format('Y-m-d');}
	if(oGrid_event.record.data.koreksi_revised!== null){koreksi_revised_update = oGrid_event.record.data.koreksi_revised;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_penyesuaian_stok&m=get_action',
			params: {
				task: "UPDATE",
				koreksi_id	: get_pk_id(),				koreksi_gudang	:koreksi_gudang_update,		
				koreksi_tanggal	: koreksi_tanggal_update_date,				koreksi_keterangan	:koreksi_keterangan_update,		
				koreksi_creator	:koreksi_creator_update,		
				koreksi_date_create	: koreksi_date_create_update_date,				koreksi_update	:koreksi_update_update,		
				koreksi_date_update	: koreksi_date_update_update_date,				koreksi_revised	:koreksi_revised_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_penyesuaian_stok_DataStore.commitChanges();
						master_penyesuaian_stok_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the master_penyesuaian_stok.',
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
	function master_penyesuaian_stok_create(){
		if(is_master_penyesuaian_stok_form_valid()){
		
		var koreksi_id_create=null;
		var koreksi_gudang_create=null;
		var koreksi_tanggal_create_date="";
		var koreksi_keterangan_create=null;
		var koreksi_creator_create=null;
		var koreksi_date_create_create_date="";
		var koreksi_update_create=null;
		var koreksi_date_update_create_date="";
		var koreksi_revised_create=null;

		if(koreksi_idField.getValue()!== null){koreksi_id_create = koreksi_idField.getValue();}
		if(koreksi_gudangField.getValue()!== null){koreksi_gudang_create = koreksi_gudangField.getValue();}
		if(koreksi_tanggalField.getValue()!== ""){koreksi_tanggal_create_date = koreksi_tanggalField.getValue().format('Y-m-d');}
		if(koreksi_keteranganField.getValue()!== null){koreksi_keterangan_create = koreksi_keteranganField.getValue();}
		if(koreksi_creatorField.getValue()!== null){koreksi_creator_create = koreksi_creatorField.getValue();}
		if(koreksi_date_createField.getValue()!== ""){koreksi_date_create_create_date = koreksi_date_createField.getValue().format('Y-m-d');}
		if(koreksi_updateField.getValue()!== null){koreksi_update_create = koreksi_updateField.getValue();}
		if(koreksi_date_updateField.getValue()!== ""){koreksi_date_update_create_date = koreksi_date_updateField.getValue().format('Y-m-d');}
		if(koreksi_revisedField.getValue()!== null){koreksi_revised_create = koreksi_revisedField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_penyesuaian_stok&m=get_action',
				params: {
					task: post2db,
					koreksi_id	: koreksi_id_create_pk,	
					koreksi_gudang	: koreksi_gudang_create,	
					koreksi_tanggal	: koreksi_tanggal_create_date,					koreksi_keterangan	: koreksi_keterangan_create,	
					koreksi_creator	: koreksi_creator_create,	
					koreksi_date_create	: koreksi_date_create_create_date,					koreksi_update	: koreksi_update_create,	
					koreksi_date_update	: koreksi_date_update_create_date,					koreksi_revised	: koreksi_revised_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Master_penyesuaian_stok was '+msg+' successfully.');
							master_penyesuaian_stok_DataStore.reload();
							master_penyesuaian_stok_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Master_penyesuaian_stok.',
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
			return master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_penyesuaian_stok_reset_form(){
		koreksi_gudangField.reset();
		koreksi_tanggalField.reset();
		koreksi_keteranganField.reset();
		koreksi_creatorField.reset();
		koreksi_date_createField.reset();
		koreksi_updateField.reset();
		koreksi_date_updateField.reset();
		koreksi_revisedField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_penyesuaian_stok_set_form(){
		koreksi_idField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_id'));
		koreksi_gudangField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_gudang'));
		koreksi_tanggalField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_tanggal'));
		koreksi_keteranganField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_keterangan'));
		koreksi_creatorField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_creator'));
		koreksi_date_createField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_date_create'));
		koreksi_updateField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_update'));
		koreksi_date_updateField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_date_update'));
		koreksi_revisedField.setValue(master_penyesuaian_stokListEditorGrid.getSelectionModel().getSelected().get('koreksi_revised'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_penyesuaian_stok_form_valid(){
		return (koreksi_idField.isValid() && true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_penyesuaian_stok_createWindow.isVisible()){
			master_penyesuaian_stok_reset_form();
			post2db='CREATE';
			msg='created';
			master_penyesuaian_stok_createWindow.show();
		} else {
			master_penyesuaian_stok_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_penyesuaian_stok_confirm_delete(){
		// only one master_penyesuaian_stok is selected here
		if(master_penyesuaian_stokListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_penyesuaian_stok_delete);
		} else if(master_penyesuaian_stokListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_penyesuaian_stok_delete);
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
	function master_penyesuaian_stok_confirm_update(){
		/* only one record is selected here */
		if(master_penyesuaian_stokListEditorGrid.selModel.getCount() == 1) {
			master_penyesuaian_stok_set_form();
			post2db='UPDATE';
			msg='updated';
			master_penyesuaian_stok_createWindow.show();
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
	function master_penyesuaian_stok_delete(btn){
		if(btn=='yes'){
			var selections = master_penyesuaian_stokListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_penyesuaian_stokListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.koreksi_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_penyesuaian_stok&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_penyesuaian_stok_DataStore.reload();
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
	master_penyesuaian_stok_DataStore = new Ext.data.Store({
		id: 'master_penyesuaian_stok_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_penyesuaian_stok&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'koreksi_id'
		},[
		/* dataIndex => insert intomaster_penyesuaian_stok_ColumnModel, Mapping => for initiate table column */ 
			{name: 'koreksi_id', type: 'int', mapping: 'koreksi_id'},
			{name: 'koreksi_gudang', type: 'int', mapping: 'koreksi_gudang'},
			{name: 'koreksi_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'koreksi_tanggal'},
			{name: 'koreksi_keterangan', type: 'string', mapping: 'koreksi_keterangan'},
			{name: 'koreksi_creator', type: 'string', mapping: 'koreksi_creator'},
			{name: 'koreksi_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'koreksi_date_create'},
			{name: 'koreksi_update', type: 'string', mapping: 'koreksi_update'},
			{name: 'koreksi_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'koreksi_date_update'},
			{name: 'koreksi_revised', type: 'int', mapping: 'koreksi_revised'}
		]),
		sortInfo:{field: 'koreksi_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	master_penyesuaian_stok_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'koreksi_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Koreksi Gudang',
			dataIndex: 'koreksi_gudang',
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
			header: 'Koreksi Tanggal',
			dataIndex: 'koreksi_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Koreksi Keterangan',
			dataIndex: 'koreksi_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		},
		{
			header: 'Koreksi Creator',
			dataIndex: 'koreksi_creator',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Koreksi Date Create',
			dataIndex: 'koreksi_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Koreksi Update',
			dataIndex: 'koreksi_update',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Koreksi Date Update',
			dataIndex: 'koreksi_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Koreksi Revised',
			dataIndex: 'koreksi_revised',
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
	master_penyesuaian_stok_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_penyesuaian_stokListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'master_penyesuaian_stokListEditorGrid',
		el: 'fp_master_penyesuaian_stok',
		title: 'List Of Master_penyesuaian_stok',
		autoHeight: true,
		store: master_penyesuaian_stok_DataStore, // DataStore
		cm: master_penyesuaian_stok_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_penyesuaian_stok_DataStore,
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
			handler: master_penyesuaian_stok_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_penyesuaian_stok_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_penyesuaian_stok_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_penyesuaian_stok_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_penyesuaian_stok_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_penyesuaian_stok_print  
		}
		]
	});
	master_penyesuaian_stokListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_penyesuaian_stok_ContextMenu = new Ext.menu.Menu({
		id: 'master_penyesuaian_stok_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_penyesuaian_stok_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_penyesuaian_stok_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_penyesuaian_stok_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_penyesuaian_stok_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_penyesuaian_stok_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_penyesuaian_stok_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_penyesuaian_stok_SelectedRow=rowIndex;
		master_penyesuaian_stok_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_penyesuaian_stok_editContextMenu(){
      master_penyesuaian_stokListEditorGrid.startEditing(master_penyesuaian_stok_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_penyesuaian_stokListEditorGrid.addListener('rowcontextmenu', onmaster_penyesuaian_stok_ListEditGridContextMenu);
	master_penyesuaian_stok_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_penyesuaian_stokListEditorGrid.on('afteredit', master_penyesuaian_stok_update); // inLine Editing Record
	
	/* Identify  koreksi_id Field */
	koreksi_idField= new Ext.form.NumberField({
		id: 'koreksi_idField',
		fieldLabel: 'Koreksi Id',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  koreksi_gudang Field */
	koreksi_gudangField= new Ext.form.NumberField({
		id: 'koreksi_gudangField',
		fieldLabel: 'Koreksi Gudang',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  koreksi_tanggal Field */
	koreksi_tanggalField= new Ext.form.DateField({
		id: 'koreksi_tanggalField',
		fieldLabel: 'Koreksi Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  koreksi_keterangan Field */
	koreksi_keteranganField= new Ext.form.TextField({
		id: 'koreksi_keteranganField',
		fieldLabel: 'Koreksi Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  koreksi_creator Field */
	koreksi_creatorField= new Ext.form.TextField({
		id: 'koreksi_creatorField',
		fieldLabel: 'Koreksi Creator',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  koreksi_date_create Field */
	koreksi_date_createField= new Ext.form.DateField({
		id: 'koreksi_date_createField',
		fieldLabel: 'Koreksi Date Create',
		format : 'Y-m-d',
	});
	/* Identify  koreksi_update Field */
	koreksi_updateField= new Ext.form.TextField({
		id: 'koreksi_updateField',
		fieldLabel: 'Koreksi Update',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  koreksi_date_update Field */
	koreksi_date_updateField= new Ext.form.DateField({
		id: 'koreksi_date_updateField',
		fieldLabel: 'Koreksi Date Update',
		format : 'Y-m-d',
	});
	/* Identify  koreksi_revised Field */
	koreksi_revisedField= new Ext.form.NumberField({
		id: 'koreksi_revisedField',
		fieldLabel: 'Koreksi Revised',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	master_penyesuaian_stok_createForm = new Ext.FormPanel({
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
				items: [koreksi_idFieldkoreksi_gudangField, koreksi_tanggalField, koreksi_keteranganField, koreksi_creatorField, koreksi_date_createField, koreksi_updateField, koreksi_date_updateField, koreksi_revisedField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_penyesuaian_stok_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_penyesuaian_stok_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_penyesuaian_stok_createWindow= new Ext.Window({
		id: 'master_penyesuaian_stok_createWindow',
		title: post2db+'Master_penyesuaian_stok',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_penyesuaian_stok_create',
		items: master_penyesuaian_stok_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function master_penyesuaian_stok_list_search(){
		// render according to a SQL date format.
		var koreksi_id_search=null;
		var koreksi_gudang_search=null;
		var koreksi_tanggal_search_date="";
		var koreksi_keterangan_search=null;
		var koreksi_creator_search=null;
		var koreksi_date_create_search_date="";
		var koreksi_update_search=null;
		var koreksi_date_update_search_date="";
		var koreksi_revised_search=null;

		if(koreksi_idSearchField.getValue()!==null){koreksi_id_search=koreksi_idSearchField.getValue();}
		if(koreksi_gudangSearchField.getValue()!==null){koreksi_gudang_search=koreksi_gudangSearchField.getValue();}
		if(koreksi_tanggalSearchField.getValue()!==""){koreksi_tanggal_search_date=koreksi_tanggalSearchField.getValue().format('Y-m-d');}
		if(koreksi_keteranganSearchField.getValue()!==null){koreksi_keterangan_search=koreksi_keteranganSearchField.getValue();}
		if(koreksi_creatorSearchField.getValue()!==null){koreksi_creator_search=koreksi_creatorSearchField.getValue();}
		if(koreksi_date_createSearchField.getValue()!==""){koreksi_date_create_search_date=koreksi_date_createSearchField.getValue().format('Y-m-d');}
		if(koreksi_updateSearchField.getValue()!==null){koreksi_update_search=koreksi_updateSearchField.getValue();}
		if(koreksi_date_updateSearchField.getValue()!==""){koreksi_date_update_search_date=koreksi_date_updateSearchField.getValue().format('Y-m-d');}
		if(koreksi_revisedSearchField.getValue()!==null){koreksi_revised_search=koreksi_revisedSearchField.getValue();}
		// change the store parameters
		master_penyesuaian_stok_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			koreksi_id	:	koreksi_id_search, 
			koreksi_gudang	:	koreksi_gudang_search, 
			koreksi_tanggal	:	koreksi_tanggal_search_date, 
			koreksi_keterangan	:	koreksi_keterangan_search, 
			koreksi_creator	:	koreksi_creator_search, 
			koreksi_date_create	:	koreksi_date_create_search_date, 
			koreksi_update	:	koreksi_update_search, 
			koreksi_date_update	:	koreksi_date_update_search_date, 
			koreksi_revised	:	koreksi_revised_search 
};
		// Cause the datastore to do another query : 
		master_penyesuaian_stok_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_penyesuaian_stok_reset_search(){
		// reset the store parameters
		master_penyesuaian_stok_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_penyesuaian_stok_DataStore.reload({params: {start: 0, limit: pageS}});
		master_penyesuaian_stok_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  koreksi_id Search Field */
	koreksi_idSearchField= new Ext.form.NumberField({
		id: 'koreksi_idSearchField',
		fieldLabel: 'Koreksi Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  koreksi_gudang Search Field */
	koreksi_gudangSearchField= new Ext.form.NumberField({
		id: 'koreksi_gudangSearchField',
		fieldLabel: 'Koreksi Gudang',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  koreksi_tanggal Search Field */
	koreksi_tanggalSearchField= new Ext.form.DateField({
		id: 'koreksi_tanggalSearchField',
		fieldLabel: 'Koreksi Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  koreksi_keterangan Search Field */
	koreksi_keteranganSearchField= new Ext.form.TextField({
		id: 'koreksi_keteranganSearchField',
		fieldLabel: 'Koreksi Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  koreksi_creator Search Field */
	koreksi_creatorSearchField= new Ext.form.TextField({
		id: 'koreksi_creatorSearchField',
		fieldLabel: 'Koreksi Creator',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  koreksi_date_create Search Field */
	koreksi_date_createSearchField= new Ext.form.DateField({
		id: 'koreksi_date_createSearchField',
		fieldLabel: 'Koreksi Date Create',
		format : 'Y-m-d',
	
	});
	/* Identify  koreksi_update Search Field */
	koreksi_updateSearchField= new Ext.form.TextField({
		id: 'koreksi_updateSearchField',
		fieldLabel: 'Koreksi Update',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  koreksi_date_update Search Field */
	koreksi_date_updateSearchField= new Ext.form.DateField({
		id: 'koreksi_date_updateSearchField',
		fieldLabel: 'Koreksi Date Update',
		format : 'Y-m-d',
	
	});
	/* Identify  koreksi_revised Search Field */
	koreksi_revisedSearchField= new Ext.form.NumberField({
		id: 'koreksi_revisedSearchField',
		fieldLabel: 'Koreksi Revised',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	master_penyesuaian_stok_searchForm = new Ext.FormPanel({
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
				items: [koreksi_idSearchFieldkoreksi_gudangSearchField, koreksi_tanggalSearchField, koreksi_keteranganSearchField, koreksi_creatorSearchField, koreksi_date_createSearchField, koreksi_updateSearchField, koreksi_date_updateSearchField, koreksi_revisedSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_penyesuaian_stok_list_search
			},{
				text: 'Close',
				handler: function(){
					master_penyesuaian_stok_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_penyesuaian_stok_searchWindow = new Ext.Window({
		title: 'master_penyesuaian_stok Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_penyesuaian_stok_search',
		items: master_penyesuaian_stok_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_penyesuaian_stok_searchWindow.isVisible()){
			master_penyesuaian_stok_searchWindow.show();
		} else {
			master_penyesuaian_stok_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_penyesuaian_stok_print(){
		var searchquery = "";
		var koreksi_id_print=null;
		var koreksi_gudang_print=null;
		var koreksi_tanggal_print_date="";
		var koreksi_keterangan_print=null;
		var koreksi_creator_print=null;
		var koreksi_date_create_print_date="";
		var koreksi_update_print=null;
		var koreksi_date_update_print_date="";
		var koreksi_revised_print=null;
		var win;              
		// check if we do have some search data...
		if(master_penyesuaian_stok_DataStore.baseParams.query!==null){searchquery = master_penyesuaian_stok_DataStore.baseParams.query;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_id!==null){koreksi_id_print = master_penyesuaian_stok_DataStore.baseParams.koreksi_id;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_gudang!==null){koreksi_gudang_print = master_penyesuaian_stok_DataStore.baseParams.koreksi_gudang;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_tanggal!==""){koreksi_tanggal_print_date = master_penyesuaian_stok_DataStore.baseParams.koreksi_tanggal;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_keterangan!==null){koreksi_keterangan_print = master_penyesuaian_stok_DataStore.baseParams.koreksi_keterangan;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_creator!==null){koreksi_creator_print = master_penyesuaian_stok_DataStore.baseParams.koreksi_creator;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_date_create!==""){koreksi_date_create_print_date = master_penyesuaian_stok_DataStore.baseParams.koreksi_date_create;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_update!==null){koreksi_update_print = master_penyesuaian_stok_DataStore.baseParams.koreksi_update;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_date_update!==""){koreksi_date_update_print_date = master_penyesuaian_stok_DataStore.baseParams.koreksi_date_update;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_revised!==null){koreksi_revised_print = master_penyesuaian_stok_DataStore.baseParams.koreksi_revised;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_penyesuaian_stok&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			koreksi_id : koreksi_id_print,
			koreksi_gudang : koreksi_gudang_print,
		  	koreksi_tanggal : koreksi_tanggal_print_date, 
			koreksi_keterangan : koreksi_keterangan_print,
			koreksi_creator : koreksi_creator_print,
		  	koreksi_date_create : koreksi_date_create_print_date, 
			koreksi_update : koreksi_update_print,
		  	koreksi_date_update : koreksi_date_update_print_date, 
			koreksi_revised : koreksi_revised_print,
		  	currentlisting: master_penyesuaian_stok_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_penyesuaian_stoklist.html','master_penyesuaian_stoklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_penyesuaian_stok_export_excel(){
		var searchquery = "";
		var koreksi_id_2excel=null;
		var koreksi_gudang_2excel=null;
		var koreksi_tanggal_2excel_date="";
		var koreksi_keterangan_2excel=null;
		var koreksi_creator_2excel=null;
		var koreksi_date_create_2excel_date="";
		var koreksi_update_2excel=null;
		var koreksi_date_update_2excel_date="";
		var koreksi_revised_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_penyesuaian_stok_DataStore.baseParams.query!==null){searchquery = master_penyesuaian_stok_DataStore.baseParams.query;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_id!==null){koreksi_id_2excel = master_penyesuaian_stok_DataStore.baseParams.koreksi_id;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_gudang!==null){koreksi_gudang_2excel = master_penyesuaian_stok_DataStore.baseParams.koreksi_gudang;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_tanggal!==""){koreksi_tanggal_2excel_date = master_penyesuaian_stok_DataStore.baseParams.koreksi_tanggal;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_keterangan!==null){koreksi_keterangan_2excel = master_penyesuaian_stok_DataStore.baseParams.koreksi_keterangan;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_creator!==null){koreksi_creator_2excel = master_penyesuaian_stok_DataStore.baseParams.koreksi_creator;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_date_create!==""){koreksi_date_create_2excel_date = master_penyesuaian_stok_DataStore.baseParams.koreksi_date_create;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_update!==null){koreksi_update_2excel = master_penyesuaian_stok_DataStore.baseParams.koreksi_update;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_date_update!==""){koreksi_date_update_2excel_date = master_penyesuaian_stok_DataStore.baseParams.koreksi_date_update;}
		if(master_penyesuaian_stok_DataStore.baseParams.koreksi_revised!==null){koreksi_revised_2excel = master_penyesuaian_stok_DataStore.baseParams.koreksi_revised;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_penyesuaian_stok&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			koreksi_id : koreksi_id_2excel,
			koreksi_gudang : koreksi_gudang_2excel,
		  	koreksi_tanggal : koreksi_tanggal_2excel_date, 
			koreksi_keterangan : koreksi_keterangan_2excel,
			koreksi_creator : koreksi_creator_2excel,
		  	koreksi_date_create : koreksi_date_create_2excel_date, 
			koreksi_update : koreksi_update_2excel,
		  	koreksi_date_update : koreksi_date_update_2excel_date, 
			koreksi_revised : koreksi_revised_2excel,
		  	currentlisting: master_penyesuaian_stok_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_penyesuaian_stok"></div>
		<div id="elwindow_master_penyesuaian_stok_create"></div>
        <div id="elwindow_master_penyesuaian_stok_search"></div>
    </div>
</div>
</body>