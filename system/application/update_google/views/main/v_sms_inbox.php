<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms_inbox View
	+ Description	: For record view
	+ Filename 		: v_sms_inbox.php
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
var sms_inbox_DataStore;
var sms_inbox_ColumnModel;
var sms_inboxListEditorGrid;
var sms_inbox_createForm;
var sms_inbox_createWindow;
var sms_inbox_searchForm;
var sms_inbox_searchWindow;
var sms_inbox_SelectedRow;
var sms_inbox_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var isms_idField;
var isms_numberField;
var isms_tanggalField;
var isms_isiField;
var isms_statusField;
var isms_idSearchField;
var isms_numberSearchField;
var isms_tanggalSearchField;
var isms_isiSearchField;
var isms_statusSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function sms_inbox_update(oGrid_event){
	var isms_id_update_pk="";
	var isms_number_update=null;
	var isms_tanggal_update_date="";
	var isms_isi_update=null;
	var isms_status_update=null;

	isms_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.isms_number!== null){isms_number_update = oGrid_event.record.data.isms_number;}
	 if(oGrid_event.record.data.isms_tanggal!== ""){isms_tanggal_update_date = oGrid_event.record.data.isms_tanggal.format('Y-m-d');}
	if(oGrid_event.record.data.isms_isi!== null){isms_isi_update = oGrid_event.record.data.isms_isi;}
	if(oGrid_event.record.data.isms_status!== null){isms_status_update = oGrid_event.record.data.isms_status;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_sms_inbox&m=get_action',
			params: {
				task: "UPDATE",
				isms_id	: get_pk_id(),				isms_number	:isms_number_update,		
				isms_tanggal	: isms_tanggal_update_date,				isms_isi	:isms_isi_update,		
				isms_status	:isms_status_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						sms_inbox_DataStore.commitChanges();
						sms_inbox_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the sms_inbox.',
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
	function sms_inbox_create(){
		if(is_sms_inbox_form_valid()){
		
		var isms_id_create_pk=null;
		var isms_number_create=null;
		var isms_tanggal_create_date="";
		var isms_isi_create=null;
		var isms_status_create=null;

		isms_id_create_pk=get_pk_id();
		if(isms_numberField.getValue()!== null){isms_number_create = isms_numberField.getValue();}
		if(isms_tanggalField.getValue()!== ""){isms_tanggal_create_date = isms_tanggalField.getValue().format('Y-m-d');}
		if(isms_isiField.getValue()!== null){isms_isi_create = isms_isiField.getValue();}
		if(isms_statusField.getValue()!== null){isms_status_create = isms_statusField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_sms_inbox&m=get_action',
				params: {
					task: post2db,
					isms_id	: isms_id_create_pk,	
					isms_number	: isms_number_create,	
					isms_tanggal	: isms_tanggal_create_date,					isms_isi	: isms_isi_create,	
					isms_status	: isms_status_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Sms_inbox was '+msg+' successfully.');
							sms_inbox_DataStore.reload();
							sms_inbox_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Sms_inbox.',
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
			return sms_inboxListEditorGrid.getSelectionModel().getSelected().get('isms_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function sms_inbox_reset_form(){
		isms_numberField.reset();
		isms_tanggalField.reset();
		isms_isiField.reset();
		isms_statusField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function sms_inbox_set_form(){
		isms_numberField.setValue(sms_inboxListEditorGrid.getSelectionModel().getSelected().get('isms_number'));
		isms_tanggalField.setValue(sms_inboxListEditorGrid.getSelectionModel().getSelected().get('isms_tanggal'));
		isms_isiField.setValue(sms_inboxListEditorGrid.getSelectionModel().getSelected().get('isms_isi'));
		isms_statusField.setValue(sms_inboxListEditorGrid.getSelectionModel().getSelected().get('isms_status'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_sms_inbox_form_valid(){
		return (true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!sms_inbox_createWindow.isVisible()){
			sms_inbox_reset_form();
			post2db='CREATE';
			msg='created';
			sms_inbox_createWindow.show();
		} else {
			sms_inbox_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function sms_inbox_confirm_delete(){
		// only one sms_inbox is selected here
		if(sms_inboxListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', sms_inbox_delete);
		} else if(sms_inboxListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', sms_inbox_delete);
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
	function sms_inbox_confirm_update(){
		/* only one record is selected here */
		if(sms_inboxListEditorGrid.selModel.getCount() == 1) {
			sms_inbox_set_form();
			post2db='UPDATE';
			msg='updated';
			sms_inbox_createWindow.show();
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
	function sms_inbox_delete(btn){
		if(btn=='yes'){
			var selections = sms_inboxListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< sms_inboxListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.isms_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_sms_inbox&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							sms_inbox_DataStore.reload();
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
	sms_inbox_DataStore = new Ext.data.Store({
		id: 'sms_inbox_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_sms_inbox&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'isms_id'
		},[
		/* dataIndex => insert intosms_inbox_ColumnModel, Mapping => for initiate table column */ 
			{name: 'isms_id', type: 'float', mapping: 'isms_id'},
			{name: 'isms_number', type: 'string', mapping: 'isms_number'},
			{name: 'isms_tanggal', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'isms_tanggal'},
			{name: 'isms_isi', type: 'string', mapping: 'isms_isi'},
			{name: 'isms_status', type: 'string', mapping: 'isms_status'}
		]),
		sortInfo:{field: 'isms_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	sms_inbox_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'isms_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Isms Number',
			dataIndex: 'isms_number',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 25
          	})
		},
		{
			header: 'Isms Tanggal',
			dataIndex: 'isms_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Isms Isi',
			dataIndex: 'isms_isi',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		},
		{
			header: 'Isms Status',
			dataIndex: 'isms_status',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['isms_status_value', 'isms_status_display'],
					data: [['read','read'],['unread','unread']]
					}),
				mode: 'local',
               	displayField: 'isms_status_display',
               	valueField: 'isms_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}]
	);
	sms_inbox_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	sms_inboxListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'sms_inboxListEditorGrid',
		el: 'fp_sms_inbox',
		title: 'List Of Sms_inbox',
		autoHeight: true,
		store: sms_inbox_DataStore, // DataStore
		cm: sms_inbox_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: sms_inbox_DataStore,
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
			handler: sms_inbox_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: sms_inbox_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: sms_inbox_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: sms_inbox_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: sms_inbox_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: sms_inbox_print  
		}
		]
	});
	sms_inboxListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	sms_inbox_ContextMenu = new Ext.menu.Menu({
		id: 'sms_inbox_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: sms_inbox_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: sms_inbox_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: sms_inbox_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: sms_inbox_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onsms_inbox_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		sms_inbox_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		sms_inbox_SelectedRow=rowIndex;
		sms_inbox_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function sms_inbox_editContextMenu(){
      sms_inboxListEditorGrid.startEditing(sms_inbox_SelectedRow,1);
  	}
	/* End of Function */
  	
	sms_inboxListEditorGrid.addListener('rowcontextmenu', onsms_inbox_ListEditGridContextMenu);
	sms_inbox_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	sms_inboxListEditorGrid.on('afteredit', sms_inbox_update); // inLine Editing Record
	
	/* Identify  isms_number Field */
	isms_numberField= new Ext.form.TextField({
		id: 'isms_numberField',
		fieldLabel: 'Isms Number',
		maxLength: 25,
		anchor: '95%'
	});
	/* Identify  isms_tanggal Field */
	isms_tanggalField= new Ext.form.DateField({
		id: 'isms_tanggalField',
		fieldLabel: 'Isms Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  isms_isi Field */
	isms_isiField= new Ext.form.TextField({
		id: 'isms_isiField',
		fieldLabel: 'Isms Isi',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  isms_status Field */
	isms_statusField= new Ext.form.ComboBox({
		id: 'isms_statusField',
		fieldLabel: 'Isms Status',
		store:new Ext.data.SimpleStore({
			fields:['isms_status_value', 'isms_status_display'],
			data:[['read','read'],['unread','unread']]
		}),
		mode: 'local',
		displayField: 'isms_status_display',
		valueField: 'isms_status_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
  	
	/* Function for retrieve create Window Panel*/ 
	sms_inbox_createForm = new Ext.FormPanel({
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
				items: [isms_numberField, isms_tanggalField, isms_isiField, isms_statusField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: sms_inbox_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					sms_inbox_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	sms_inbox_createWindow= new Ext.Window({
		id: 'sms_inbox_createWindow',
		title: post2db+'Sms_inbox',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_sms_inbox_create',
		items: sms_inbox_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function sms_inbox_list_search(){
		// render according to a SQL date format.
		var isms_id_search=null;
		var isms_number_search=null;
		var isms_tanggal_search_date="";
		var isms_isi_search=null;
		var isms_status_search=null;

		if(isms_idSearchField.getValue()!==null){isms_id_search=isms_idSearchField.getValue();}
		if(isms_numberSearchField.getValue()!==null){isms_number_search=isms_numberSearchField.getValue();}
		if(isms_tanggalSearchField.getValue()!==""){isms_tanggal_search_date=isms_tanggalSearchField.getValue().format('Y-m-d');}
		if(isms_isiSearchField.getValue()!==null){isms_isi_search=isms_isiSearchField.getValue();}
		if(isms_statusSearchField.getValue()!==null){isms_status_search=isms_statusSearchField.getValue();}
		// change the store parameters
		sms_inbox_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			isms_id	:	isms_id_search, 
			isms_number	:	isms_number_search, 
			isms_tanggal	:	isms_tanggal_search_date, 
			isms_isi	:	isms_isi_search, 
			isms_status	:	isms_status_search 
};
		// Cause the datastore to do another query : 
		sms_inbox_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function sms_inbox_reset_search(){
		// reset the store parameters
		sms_inbox_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		sms_inbox_DataStore.reload({params: {start: 0, limit: pageS}});
		sms_inbox_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  isms_id Search Field */
	isms_idSearchField= new Ext.form.NumberField({
		id: 'isms_idSearchField',
		fieldLabel: 'Isms Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  isms_number Search Field */
	isms_numberSearchField= new Ext.form.TextField({
		id: 'isms_numberSearchField',
		fieldLabel: 'Isms Number',
		maxLength: 25,
		anchor: '95%'
	
	});
	/* Identify  isms_tanggal Search Field */
	isms_tanggalSearchField= new Ext.form.DateField({
		id: 'isms_tanggalSearchField',
		fieldLabel: 'Isms Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  isms_isi Search Field */
	isms_isiSearchField= new Ext.form.TextField({
		id: 'isms_isiSearchField',
		fieldLabel: 'Isms Isi',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  isms_status Search Field */
	isms_statusSearchField= new Ext.form.ComboBox({
		id: 'isms_statusSearchField',
		fieldLabel: 'Isms Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'isms_status'],
			data:[['read','read'],['unread','unread']]
		}),
		mode: 'local',
		displayField: 'isms_status',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	sms_inbox_searchForm = new Ext.FormPanel({
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
				items: [isms_numberSearchField, isms_tanggalSearchField, isms_isiSearchField, isms_statusSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: sms_inbox_list_search
			},{
				text: 'Close',
				handler: function(){
					sms_inbox_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	sms_inbox_searchWindow = new Ext.Window({
		title: 'sms_inbox Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_sms_inbox_search',
		items: sms_inbox_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!sms_inbox_searchWindow.isVisible()){
			sms_inbox_searchWindow.show();
		} else {
			sms_inbox_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function sms_inbox_print(){
		var searchquery = "";
		var isms_number_print=null;
		var isms_tanggal_print_date="";
		var isms_isi_print=null;
		var isms_status_print=null;
		var win;              
		// check if we do have some search data...
		if(sms_inbox_DataStore.baseParams.query!==null){searchquery = sms_inbox_DataStore.baseParams.query;}
		if(sms_inbox_DataStore.baseParams.isms_number!==null){isms_number_print = sms_inbox_DataStore.baseParams.isms_number;}
		if(sms_inbox_DataStore.baseParams.isms_tanggal!==""){isms_tanggal_print_date = sms_inbox_DataStore.baseParams.isms_tanggal;}
		if(sms_inbox_DataStore.baseParams.isms_isi!==null){isms_isi_print = sms_inbox_DataStore.baseParams.isms_isi;}
		if(sms_inbox_DataStore.baseParams.isms_status!==null){isms_status_print = sms_inbox_DataStore.baseParams.isms_status;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_sms_inbox&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			isms_number : isms_number_print,
		  	isms_tanggal : isms_tanggal_print_date, 
			isms_isi : isms_isi_print,
			isms_status : isms_status_print,
		  	currentlisting: sms_inbox_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./sms_inboxlist.html','sms_inboxlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function sms_inbox_export_excel(){
		var searchquery = "";
		var isms_number_2excel=null;
		var isms_tanggal_2excel_date="";
		var isms_isi_2excel=null;
		var isms_status_2excel=null;
		var win;              
		// check if we do have some search data...
		if(sms_inbox_DataStore.baseParams.query!==null){searchquery = sms_inbox_DataStore.baseParams.query;}
		if(sms_inbox_DataStore.baseParams.isms_number!==null){isms_number_2excel = sms_inbox_DataStore.baseParams.isms_number;}
		if(sms_inbox_DataStore.baseParams.isms_tanggal!==""){isms_tanggal_2excel_date = sms_inbox_DataStore.baseParams.isms_tanggal;}
		if(sms_inbox_DataStore.baseParams.isms_isi!==null){isms_isi_2excel = sms_inbox_DataStore.baseParams.isms_isi;}
		if(sms_inbox_DataStore.baseParams.isms_status!==null){isms_status_2excel = sms_inbox_DataStore.baseParams.isms_status;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_sms_inbox&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			isms_number : isms_number_2excel,
		  	isms_tanggal : isms_tanggal_2excel_date, 
			isms_isi : isms_isi_2excel,
			isms_status : isms_status_2excel,
		  	currentlisting: sms_inbox_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_sms_inbox"></div>
		<div id="elwindow_sms_inbox_create"></div>
        <div id="elwindow_sms_inbox_search"></div>
    </div>
</div>
</body>