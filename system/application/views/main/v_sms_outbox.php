<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms_outbox View
	+ Description	: For record view
	+ Filename 		: v_sms_outbox.php
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
var sms_outbox_DataStore;
var sms_outbox_ColumnModel;
var sms_outboxListEditorGrid;
var sms_outbox_createForm;
var sms_outbox_createWindow;
var sms_outbox_searchForm;
var sms_outbox_searchWindow;
var sms_outbox_SelectedRow;
var sms_outbox_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var osms_idField;
var osms_destField;
var osms_tanggalField;
var osms_isiField;
var osms_statusField;
var osms_kategoriField;
var osms_readyField;
var osms_idSearchField;
var osms_destSearchField;
var osms_tanggalSearchField;
var osms_isiSearchField;
var osms_statusSearchField;
var osms_kategoriSearchField;
var osms_readySearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function sms_outbox_update(oGrid_event){
	var osms_id_update_pk="";
	var osms_dest_update=null;
	var osms_tanggal_update_date="";
	var osms_isi_update=null;
	var osms_status_update=null;
	var osms_kategori_update=null;
	var osms_ready_update=null;

	osms_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.osms_dest!== null){osms_dest_update = oGrid_event.record.data.osms_dest;}
	 if(oGrid_event.record.data.osms_tanggal!== ""){osms_tanggal_update_date = oGrid_event.record.data.osms_tanggal.format('Y-m-d');}
	if(oGrid_event.record.data.osms_isi!== null){osms_isi_update = oGrid_event.record.data.osms_isi;}
	if(oGrid_event.record.data.osms_status!== null){osms_status_update = oGrid_event.record.data.osms_status;}
	if(oGrid_event.record.data.osms_kategori!== null){osms_kategori_update = oGrid_event.record.data.osms_kategori;}
	if(oGrid_event.record.data.osms_ready!== null){osms_ready_update = oGrid_event.record.data.osms_ready;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_sms_outbox&m=get_action',
			params: {
				task: "UPDATE",
				osms_id	: get_pk_id(),				osms_dest	:osms_dest_update,		
				osms_tanggal	: osms_tanggal_update_date,				osms_isi	:osms_isi_update,		
				osms_status	:osms_status_update,		
				osms_kategori	:osms_kategori_update,		
				osms_ready	:osms_ready_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						sms_outbox_DataStore.commitChanges();
						sms_outbox_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the sms_outbox.',
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
	function sms_outbox_create(){
		if(is_sms_outbox_form_valid()){
		
		var osms_id_create_pk=null;
		var osms_dest_create=null;
		var osms_tanggal_create_date="";
		var osms_isi_create=null;
		var osms_status_create=null;
		var osms_kategori_create=null;
		var osms_ready_create=null;

		osms_id_create_pk=get_pk_id();
		if(osms_destField.getValue()!== null){osms_dest_create = osms_destField.getValue();}
		if(osms_tanggalField.getValue()!== ""){osms_tanggal_create_date = osms_tanggalField.getValue().format('Y-m-d');}
		if(osms_isiField.getValue()!== null){osms_isi_create = osms_isiField.getValue();}
		if(osms_statusField.getValue()!== null){osms_status_create = osms_statusField.getValue();}
		if(osms_kategoriField.getValue()!== null){osms_kategori_create = osms_kategoriField.getValue();}
		if(osms_readyField.getValue()!== null){osms_ready_create = osms_readyField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_sms_outbox&m=get_action',
				params: {
					task: post2db,
					osms_id	: osms_id_create_pk,	
					osms_dest	: osms_dest_create,	
					osms_tanggal	: osms_tanggal_create_date,					osms_isi	: osms_isi_create,	
					osms_status	: osms_status_create,	
					osms_kategori	: osms_kategori_create,	
					osms_ready	: osms_ready_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Sms_outbox was '+msg+' successfully.');
							sms_outbox_DataStore.reload();
							sms_outbox_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Sms_outbox.',
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
			return sms_outboxListEditorGrid.getSelectionModel().getSelected().get('osms_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function sms_outbox_reset_form(){
		osms_destField.reset();
		osms_tanggalField.reset();
		osms_isiField.reset();
		osms_statusField.reset();
		osms_kategoriField.reset();
		osms_readyField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function sms_outbox_set_form(){
		osms_destField.setValue(sms_outboxListEditorGrid.getSelectionModel().getSelected().get('osms_dest'));
		osms_tanggalField.setValue(sms_outboxListEditorGrid.getSelectionModel().getSelected().get('osms_tanggal'));
		osms_isiField.setValue(sms_outboxListEditorGrid.getSelectionModel().getSelected().get('osms_isi'));
		osms_statusField.setValue(sms_outboxListEditorGrid.getSelectionModel().getSelected().get('osms_status'));
		osms_kategoriField.setValue(sms_outboxListEditorGrid.getSelectionModel().getSelected().get('osms_kategori'));
		osms_readyField.setValue(sms_outboxListEditorGrid.getSelectionModel().getSelected().get('osms_ready'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_sms_outbox_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!sms_outbox_createWindow.isVisible()){
			sms_outbox_reset_form();
			post2db='CREATE';
			msg='created';
			sms_outbox_createWindow.show();
		} else {
			sms_outbox_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function sms_outbox_confirm_delete(){
		// only one sms_outbox is selected here
		if(sms_outboxListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', sms_outbox_delete);
		} else if(sms_outboxListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', sms_outbox_delete);
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
	function sms_outbox_confirm_update(){
		/* only one record is selected here */
		if(sms_outboxListEditorGrid.selModel.getCount() == 1) {
			sms_outbox_set_form();
			post2db='UPDATE';
			msg='updated';
			sms_outbox_createWindow.show();
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
	function sms_outbox_delete(btn){
		if(btn=='yes'){
			var selections = sms_outboxListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< sms_outboxListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.osms_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_sms_outbox&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							sms_outbox_DataStore.reload();
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
	sms_outbox_DataStore = new Ext.data.Store({
		id: 'sms_outbox_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_sms_outbox&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'osms_id'
		},[
		/* dataIndex => insert intosms_outbox_ColumnModel, Mapping => for initiate table column */ 
			{name: 'osms_id', type: 'float', mapping: 'osms_id'},
			{name: 'osms_dest', type: 'string', mapping: 'osms_dest'},
			{name: 'osms_tanggal', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'osms_tanggal'},
			{name: 'osms_isi', type: 'string', mapping: 'osms_isi'},
			{name: 'osms_status', type: 'string', mapping: 'osms_status'},
			{name: 'osms_kategori', type: 'string', mapping: 'osms_kategori'},
			{name: 'osms_ready', type: 'string', mapping: 'osms_ready'}
		]),
		sortInfo:{field: 'osms_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	sms_outbox_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'osms_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Osms Dest',
			dataIndex: 'osms_dest',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 25
          	})
		},
		{
			header: 'Osms Tanggal',
			dataIndex: 'osms_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Osms Isi',
			dataIndex: 'osms_isi',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		},
		{
			header: 'Osms Status',
			dataIndex: 'osms_status',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['osms_status_value', 'osms_status_display'],
					data: [['sent','sent'],['unsent','unsent']]
					}),
				mode: 'local',
               	displayField: 'osms_status_display',
               	valueField: 'osms_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Osms Kategori',
			dataIndex: 'osms_kategori',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['osms_kategori_value', 'osms_kategori_display'],
					data: [['group','group'],['single','single'],['multiple','multiple']]
					}),
				mode: 'local',
               	displayField: 'osms_kategori_display',
               	valueField: 'osms_kategori_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Osms Ready',
			dataIndex: 'osms_ready',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['osms_ready_value', 'osms_ready_display'],
					data: [['ready','ready'],['scheduled','scheduled']]
					}),
				mode: 'local',
               	displayField: 'osms_ready_display',
               	valueField: 'osms_ready_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}]
	);
	sms_outbox_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	sms_outboxListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'sms_outboxListEditorGrid',
		el: 'fp_sms_outbox',
		title: 'List Of Sms_outbox',
		autoHeight: true,
		store: sms_outbox_DataStore, // DataStore
		cm: sms_outbox_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: sms_outbox_DataStore,
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
			handler: sms_outbox_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: sms_outbox_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: sms_outbox_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: sms_outbox_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: sms_outbox_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: sms_outbox_print  
		}
		]
	});
	sms_outboxListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	sms_outbox_ContextMenu = new Ext.menu.Menu({
		id: 'sms_outbox_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: sms_outbox_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: sms_outbox_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: sms_outbox_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: sms_outbox_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onsms_outbox_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		sms_outbox_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		sms_outbox_SelectedRow=rowIndex;
		sms_outbox_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function sms_outbox_editContextMenu(){
      sms_outboxListEditorGrid.startEditing(sms_outbox_SelectedRow,1);
  	}
	/* End of Function */
  	
	sms_outboxListEditorGrid.addListener('rowcontextmenu', onsms_outbox_ListEditGridContextMenu);
	sms_outbox_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	sms_outboxListEditorGrid.on('afteredit', sms_outbox_update); // inLine Editing Record
	
	/* Identify  osms_dest Field */
	osms_destField= new Ext.form.TextField({
		id: 'osms_destField',
		fieldLabel: 'Osms Dest',
		maxLength: 25,
		anchor: '95%'
	});
	/* Identify  osms_tanggal Field */
	osms_tanggalField= new Ext.form.DateField({
		id: 'osms_tanggalField',
		fieldLabel: 'Osms Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  osms_isi Field */
	osms_isiField= new Ext.form.TextField({
		id: 'osms_isiField',
		fieldLabel: 'Osms Isi',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  osms_status Field */
	osms_statusField= new Ext.form.ComboBox({
		id: 'osms_statusField',
		fieldLabel: 'Osms Status',
		store:new Ext.data.SimpleStore({
			fields:['osms_status_value', 'osms_status_display'],
			data:[['sent','sent'],['unsent','unsent']]
		}),
		mode: 'local',
		displayField: 'osms_status_display',
		valueField: 'osms_status_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  osms_kategori Field */
	osms_kategoriField= new Ext.form.ComboBox({
		id: 'osms_kategoriField',
		fieldLabel: 'Osms Kategori',
		store:new Ext.data.SimpleStore({
			fields:['osms_kategori_value', 'osms_kategori_display'],
			data:[['group','group'],['single','single'],['multiple','multiple']]
		}),
		mode: 'local',
		displayField: 'osms_kategori_display',
		valueField: 'osms_kategori_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  osms_ready Field */
	osms_readyField= new Ext.form.ComboBox({
		id: 'osms_readyField',
		fieldLabel: 'Osms Ready',
		store:new Ext.data.SimpleStore({
			fields:['osms_ready_value', 'osms_ready_display'],
			data:[['ready','ready'],['scheduled','scheduled']]
		}),
		mode: 'local',
		displayField: 'osms_ready_display',
		valueField: 'osms_ready_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
  	
	/* Function for retrieve create Window Panel*/ 
	sms_outbox_createForm = new Ext.FormPanel({
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
				items: [osms_destField, osms_tanggalField, osms_isiField, osms_statusField, osms_kategoriField, osms_readyField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: sms_outbox_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					sms_outbox_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	sms_outbox_createWindow= new Ext.Window({
		id: 'sms_outbox_createWindow',
		title: post2db+'Sms_outbox',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_sms_outbox_create',
		items: sms_outbox_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function sms_outbox_list_search(){
		// render according to a SQL date format.
		var osms_id_search=null;
		var osms_dest_search=null;
		var osms_tanggal_search_date="";
		var osms_isi_search=null;
		var osms_status_search=null;
		var osms_kategori_search=null;
		var osms_ready_search=null;

		if(osms_idSearchField.getValue()!==null){osms_id_search=osms_idSearchField.getValue();}
		if(osms_destSearchField.getValue()!==null){osms_dest_search=osms_destSearchField.getValue();}
		if(osms_tanggalSearchField.getValue()!==""){osms_tanggal_search_date=osms_tanggalSearchField.getValue().format('Y-m-d');}
		if(osms_isiSearchField.getValue()!==null){osms_isi_search=osms_isiSearchField.getValue();}
		if(osms_statusSearchField.getValue()!==null){osms_status_search=osms_statusSearchField.getValue();}
		if(osms_kategoriSearchField.getValue()!==null){osms_kategori_search=osms_kategoriSearchField.getValue();}
		if(osms_readySearchField.getValue()!==null){osms_ready_search=osms_readySearchField.getValue();}
		// change the store parameters
		sms_outbox_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			osms_id	:	osms_id_search, 
			osms_dest	:	osms_dest_search, 
			osms_tanggal	:	osms_tanggal_search_date, 
			osms_isi	:	osms_isi_search, 
			osms_status	:	osms_status_search, 
			osms_kategori	:	osms_kategori_search, 
			osms_ready	:	osms_ready_search 
};
		// Cause the datastore to do another query : 
		sms_outbox_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function sms_outbox_reset_search(){
		// reset the store parameters
		sms_outbox_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		sms_outbox_DataStore.reload({params: {start: 0, limit: pageS}});
		sms_outbox_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  osms_id Search Field */
	osms_idSearchField= new Ext.form.NumberField({
		id: 'osms_idSearchField',
		fieldLabel: 'Osms Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  osms_dest Search Field */
	osms_destSearchField= new Ext.form.TextField({
		id: 'osms_destSearchField',
		fieldLabel: 'Osms Dest',
		maxLength: 25,
		anchor: '95%'
	
	});
	/* Identify  osms_tanggal Search Field */
	osms_tanggalSearchField= new Ext.form.DateField({
		id: 'osms_tanggalSearchField',
		fieldLabel: 'Osms Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  osms_isi Search Field */
	osms_isiSearchField= new Ext.form.TextField({
		id: 'osms_isiSearchField',
		fieldLabel: 'Osms Isi',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  osms_status Search Field */
	osms_statusSearchField= new Ext.form.ComboBox({
		id: 'osms_statusSearchField',
		fieldLabel: 'Osms Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'osms_status'],
			data:[['sent','sent'],['unsent','unsent']]
		}),
		mode: 'local',
		displayField: 'osms_status',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  osms_kategori Search Field */
	osms_kategoriSearchField= new Ext.form.ComboBox({
		id: 'osms_kategoriSearchField',
		fieldLabel: 'Osms Kategori',
		store:new Ext.data.SimpleStore({
			fields:['value', 'osms_kategori'],
			data:[['group','group'],['single','single'],['multiple','multiple']]
		}),
		mode: 'local',
		displayField: 'osms_kategori',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  osms_ready Search Field */
	osms_readySearchField= new Ext.form.ComboBox({
		id: 'osms_readySearchField',
		fieldLabel: 'Osms Ready',
		store:new Ext.data.SimpleStore({
			fields:['value', 'osms_ready'],
			data:[['ready','ready'],['scheduled','scheduled']]
		}),
		mode: 'local',
		displayField: 'osms_ready',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	sms_outbox_searchForm = new Ext.FormPanel({
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
				items: [osms_destSearchField, osms_tanggalSearchField, osms_isiSearchField, osms_statusSearchField, osms_kategoriSearchField, osms_readySearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: sms_outbox_list_search
			},{
				text: 'Close',
				handler: function(){
					sms_outbox_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	sms_outbox_searchWindow = new Ext.Window({
		title: 'sms_outbox Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_sms_outbox_search',
		items: sms_outbox_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!sms_outbox_searchWindow.isVisible()){
			sms_outbox_searchWindow.show();
		} else {
			sms_outbox_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function sms_outbox_print(){
		var searchquery = "";
		var osms_dest_print=null;
		var osms_tanggal_print_date="";
		var osms_isi_print=null;
		var osms_status_print=null;
		var osms_kategori_print=null;
		var osms_ready_print=null;
		var win;              
		// check if we do have some search data...
		if(sms_outbox_DataStore.baseParams.query!==null){searchquery = sms_outbox_DataStore.baseParams.query;}
		if(sms_outbox_DataStore.baseParams.osms_dest!==null){osms_dest_print = sms_outbox_DataStore.baseParams.osms_dest;}
		if(sms_outbox_DataStore.baseParams.osms_tanggal!==""){osms_tanggal_print_date = sms_outbox_DataStore.baseParams.osms_tanggal;}
		if(sms_outbox_DataStore.baseParams.osms_isi!==null){osms_isi_print = sms_outbox_DataStore.baseParams.osms_isi;}
		if(sms_outbox_DataStore.baseParams.osms_status!==null){osms_status_print = sms_outbox_DataStore.baseParams.osms_status;}
		if(sms_outbox_DataStore.baseParams.osms_kategori!==null){osms_kategori_print = sms_outbox_DataStore.baseParams.osms_kategori;}
		if(sms_outbox_DataStore.baseParams.osms_ready!==null){osms_ready_print = sms_outbox_DataStore.baseParams.osms_ready;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_sms_outbox&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			osms_dest : osms_dest_print,
		  	osms_tanggal : osms_tanggal_print_date, 
			osms_isi : osms_isi_print,
			osms_status : osms_status_print,
			osms_kategori : osms_kategori_print,
			osms_ready : osms_ready_print,
		  	currentlisting: sms_outbox_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./sms_outboxlist.html','sms_outboxlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function sms_outbox_export_excel(){
		var searchquery = "";
		var osms_dest_2excel=null;
		var osms_tanggal_2excel_date="";
		var osms_isi_2excel=null;
		var osms_status_2excel=null;
		var osms_kategori_2excel=null;
		var osms_ready_2excel=null;
		var win;              
		// check if we do have some search data...
		if(sms_outbox_DataStore.baseParams.query!==null){searchquery = sms_outbox_DataStore.baseParams.query;}
		if(sms_outbox_DataStore.baseParams.osms_dest!==null){osms_dest_2excel = sms_outbox_DataStore.baseParams.osms_dest;}
		if(sms_outbox_DataStore.baseParams.osms_tanggal!==""){osms_tanggal_2excel_date = sms_outbox_DataStore.baseParams.osms_tanggal;}
		if(sms_outbox_DataStore.baseParams.osms_isi!==null){osms_isi_2excel = sms_outbox_DataStore.baseParams.osms_isi;}
		if(sms_outbox_DataStore.baseParams.osms_status!==null){osms_status_2excel = sms_outbox_DataStore.baseParams.osms_status;}
		if(sms_outbox_DataStore.baseParams.osms_kategori!==null){osms_kategori_2excel = sms_outbox_DataStore.baseParams.osms_kategori;}
		if(sms_outbox_DataStore.baseParams.osms_ready!==null){osms_ready_2excel = sms_outbox_DataStore.baseParams.osms_ready;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_sms_outbox&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			osms_dest : osms_dest_2excel,
		  	osms_tanggal : osms_tanggal_2excel_date, 
			osms_isi : osms_isi_2excel,
			osms_status : osms_status_2excel,
			osms_kategori : osms_kategori_2excel,
			osms_ready : osms_ready_2excel,
		  	currentlisting: sms_outbox_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_sms_outbox"></div>
		<div id="elwindow_sms_outbox_create"></div>
        <div id="elwindow_sms_outbox_search"></div>
    </div>
</div>
</body>