<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms_response View
	+ Description	: For record view
	+ Filename 		: v_sms_response.php
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
var sms_response_DataStore;
var sms_response_ColumnModel;
var sms_responseListEditorGrid;
var sms_response_createForm;
var sms_response_createWindow;
var sms_response_searchForm;
var sms_response_searchWindow;
var sms_response_SelectedRow;
var sms_response_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var response_idField;
var response_receiveField;
var response_proccessField;
var response_replyField;
var response_securityField;
var response_idSearchField;
var response_receiveSearchField;
var response_proccessSearchField;
var response_replySearchField;
var response_securitySearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function sms_response_update(oGrid_event){
	var response_id_update_pk="";
	var response_receive_update=null;
	var response_proccess_update=null;
	var response_reply_update=null;
	var response_security_update=null;

	response_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.response_receive!== null){response_receive_update = oGrid_event.record.data.response_receive;}
	if(oGrid_event.record.data.response_proccess!== null){response_proccess_update = oGrid_event.record.data.response_proccess;}
	if(oGrid_event.record.data.response_reply!== null){response_reply_update = oGrid_event.record.data.response_reply;}
	if(oGrid_event.record.data.response_security!== null){response_security_update = oGrid_event.record.data.response_security;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_sms_response&m=get_action',
			params: {
				task: "UPDATE",
				response_id	: get_pk_id(),				response_receive	:response_receive_update,		
				response_proccess	:response_proccess_update,		
				response_reply	:response_reply_update,		
				response_security	:response_security_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						sms_response_DataStore.commitChanges();
						sms_response_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the sms_response.',
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
	function sms_response_create(){
		if(is_sms_response_form_valid()){
		
		var response_id_create_pk=null;
		var response_receive_create=null;
		var response_proccess_create=null;
		var response_reply_create=null;
		var response_security_create=null;

		response_id_create_pk=get_pk_id();
		if(response_receiveField.getValue()!== null){response_receive_create = response_receiveField.getValue();}
		if(response_proccessField.getValue()!== null){response_proccess_create = response_proccessField.getValue();}
		if(response_replyField.getValue()!== null){response_reply_create = response_replyField.getValue();}
		if(response_securityField.getValue()!== null){response_security_create = response_securityField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_sms_response&m=get_action',
				params: {
					task: post2db,
					response_id	: response_id_create_pk,	
					response_receive	: response_receive_create,	
					response_proccess	: response_proccess_create,	
					response_reply	: response_reply_create,	
					response_security	: response_security_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Sms_response was '+msg+' successfully.');
							sms_response_DataStore.reload();
							sms_response_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Sms_response.',
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
			return sms_responseListEditorGrid.getSelectionModel().getSelected().get('response_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function sms_response_reset_form(){
		response_receiveField.reset();
		response_proccessField.reset();
		response_replyField.reset();
		response_securityField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function sms_response_set_form(){
		response_receiveField.setValue(sms_responseListEditorGrid.getSelectionModel().getSelected().get('response_receive'));
		response_proccessField.setValue(sms_responseListEditorGrid.getSelectionModel().getSelected().get('response_proccess'));
		response_replyField.setValue(sms_responseListEditorGrid.getSelectionModel().getSelected().get('response_reply'));
		response_securityField.setValue(sms_responseListEditorGrid.getSelectionModel().getSelected().get('response_security'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_sms_response_form_valid(){
		return (true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!sms_response_createWindow.isVisible()){
			sms_response_reset_form();
			post2db='CREATE';
			msg='created';
			sms_response_createWindow.show();
		} else {
			sms_response_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function sms_response_confirm_delete(){
		// only one sms_response is selected here
		if(sms_responseListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', sms_response_delete);
		} else if(sms_responseListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', sms_response_delete);
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
	function sms_response_confirm_update(){
		/* only one record is selected here */
		if(sms_responseListEditorGrid.selModel.getCount() == 1) {
			sms_response_set_form();
			post2db='UPDATE';
			msg='updated';
			sms_response_createWindow.show();
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
	function sms_response_delete(btn){
		if(btn=='yes'){
			var selections = sms_responseListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< sms_responseListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.response_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_sms_response&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							sms_response_DataStore.reload();
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
	sms_response_DataStore = new Ext.data.Store({
		id: 'sms_response_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_sms_response&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'response_id'
		},[
		/* dataIndex => insert intosms_response_ColumnModel, Mapping => for initiate table column */ 
			{name: 'response_id', type: 'int', mapping: 'response_id'},
			{name: 'response_receive', type: 'string', mapping: 'response_receive'},
			{name: 'response_proccess', type: 'string', mapping: 'response_proccess'},
			{name: 'response_reply', type: 'string', mapping: 'response_reply'},
			{name: 'response_security', type: 'string', mapping: 'response_security'}
		]),
		sortInfo:{field: 'response_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	sms_response_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'response_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Response Receive',
			dataIndex: 'response_receive',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		},
		{
			header: 'Response Proccess',
			dataIndex: 'response_proccess',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		},
		{
			header: 'Response Reply',
			dataIndex: 'response_reply',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		},
		{
			header: 'Response Security',
			dataIndex: 'response_security',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['response_security_value', 'response_security_display'],
					data: [['group','group'],['specific','specific'],['all','all']]
					}),
				mode: 'local',
               	displayField: 'response_security_display',
               	valueField: 'response_security_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}]
	);
	sms_response_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	sms_responseListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'sms_responseListEditorGrid',
		el: 'fp_sms_response',
		title: 'List Of Sms_response',
		autoHeight: true,
		store: sms_response_DataStore, // DataStore
		cm: sms_response_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: sms_response_DataStore,
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
			handler: sms_response_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: sms_response_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: sms_response_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: sms_response_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: sms_response_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: sms_response_print  
		}
		]
	});
	sms_responseListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	sms_response_ContextMenu = new Ext.menu.Menu({
		id: 'sms_response_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: sms_response_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: sms_response_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: sms_response_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: sms_response_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onsms_response_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		sms_response_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		sms_response_SelectedRow=rowIndex;
		sms_response_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function sms_response_editContextMenu(){
      sms_responseListEditorGrid.startEditing(sms_response_SelectedRow,1);
  	}
	/* End of Function */
  	
	sms_responseListEditorGrid.addListener('rowcontextmenu', onsms_response_ListEditGridContextMenu);
	sms_response_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	sms_responseListEditorGrid.on('afteredit', sms_response_update); // inLine Editing Record
	
	/* Identify  response_receive Field */
	response_receiveField= new Ext.form.TextField({
		id: 'response_receiveField',
		fieldLabel: 'Response Receive',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  response_proccess Field */
	response_proccessField= new Ext.form.TextField({
		id: 'response_proccessField',
		fieldLabel: 'Response Proccess',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  response_reply Field */
	response_replyField= new Ext.form.TextField({
		id: 'response_replyField',
		fieldLabel: 'Response Reply',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  response_security Field */
	response_securityField= new Ext.form.ComboBox({
		id: 'response_securityField',
		fieldLabel: 'Response Security',
		store:new Ext.data.SimpleStore({
			fields:['response_security_value', 'response_security_display'],
			data:[['group','group'],['specific','specific'],['all','all']]
		}),
		mode: 'local',
		displayField: 'response_security_display',
		valueField: 'response_security_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
  	
	/* Function for retrieve create Window Panel*/ 
	sms_response_createForm = new Ext.FormPanel({
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
				items: [response_receiveField, response_proccessField, response_replyField, response_securityField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: sms_response_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					sms_response_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	sms_response_createWindow= new Ext.Window({
		id: 'sms_response_createWindow',
		title: post2db+'Sms_response',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_sms_response_create',
		items: sms_response_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function sms_response_list_search(){
		// render according to a SQL date format.
		var response_id_search=null;
		var response_receive_search=null;
		var response_proccess_search=null;
		var response_reply_search=null;
		var response_security_search=null;

		if(response_idSearchField.getValue()!==null){response_id_search=response_idSearchField.getValue();}
		if(response_receiveSearchField.getValue()!==null){response_receive_search=response_receiveSearchField.getValue();}
		if(response_proccessSearchField.getValue()!==null){response_proccess_search=response_proccessSearchField.getValue();}
		if(response_replySearchField.getValue()!==null){response_reply_search=response_replySearchField.getValue();}
		if(response_securitySearchField.getValue()!==null){response_security_search=response_securitySearchField.getValue();}
		// change the store parameters
		sms_response_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			response_id	:	response_id_search, 
			response_receive	:	response_receive_search, 
			response_proccess	:	response_proccess_search, 
			response_reply	:	response_reply_search, 
			response_security	:	response_security_search 
};
		// Cause the datastore to do another query : 
		sms_response_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function sms_response_reset_search(){
		// reset the store parameters
		sms_response_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		sms_response_DataStore.reload({params: {start: 0, limit: pageS}});
		sms_response_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  response_id Search Field */
	response_idSearchField= new Ext.form.NumberField({
		id: 'response_idSearchField',
		fieldLabel: 'Response Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  response_receive Search Field */
	response_receiveSearchField= new Ext.form.TextField({
		id: 'response_receiveSearchField',
		fieldLabel: 'Response Receive',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  response_proccess Search Field */
	response_proccessSearchField= new Ext.form.TextField({
		id: 'response_proccessSearchField',
		fieldLabel: 'Response Proccess',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  response_reply Search Field */
	response_replySearchField= new Ext.form.TextField({
		id: 'response_replySearchField',
		fieldLabel: 'Response Reply',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  response_security Search Field */
	response_securitySearchField= new Ext.form.ComboBox({
		id: 'response_securitySearchField',
		fieldLabel: 'Response Security',
		store:new Ext.data.SimpleStore({
			fields:['value', 'response_security'],
			data:[['group','group'],['specific','specific'],['all','all']]
		}),
		mode: 'local',
		displayField: 'response_security',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	sms_response_searchForm = new Ext.FormPanel({
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
				items: [response_receiveSearchField, response_proccessSearchField, response_replySearchField, response_securitySearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: sms_response_list_search
			},{
				text: 'Close',
				handler: function(){
					sms_response_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	sms_response_searchWindow = new Ext.Window({
		title: 'sms_response Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_sms_response_search',
		items: sms_response_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!sms_response_searchWindow.isVisible()){
			sms_response_searchWindow.show();
		} else {
			sms_response_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function sms_response_print(){
		var searchquery = "";
		var response_receive_print=null;
		var response_proccess_print=null;
		var response_reply_print=null;
		var response_security_print=null;
		var win;              
		// check if we do have some search data...
		if(sms_response_DataStore.baseParams.query!==null){searchquery = sms_response_DataStore.baseParams.query;}
		if(sms_response_DataStore.baseParams.response_receive!==null){response_receive_print = sms_response_DataStore.baseParams.response_receive;}
		if(sms_response_DataStore.baseParams.response_proccess!==null){response_proccess_print = sms_response_DataStore.baseParams.response_proccess;}
		if(sms_response_DataStore.baseParams.response_reply!==null){response_reply_print = sms_response_DataStore.baseParams.response_reply;}
		if(sms_response_DataStore.baseParams.response_security!==null){response_security_print = sms_response_DataStore.baseParams.response_security;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_sms_response&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			response_receive : response_receive_print,
			response_proccess : response_proccess_print,
			response_reply : response_reply_print,
			response_security : response_security_print,
		  	currentlisting: sms_response_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./sms_responselist.html','sms_responselist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function sms_response_export_excel(){
		var searchquery = "";
		var response_receive_2excel=null;
		var response_proccess_2excel=null;
		var response_reply_2excel=null;
		var response_security_2excel=null;
		var win;              
		// check if we do have some search data...
		if(sms_response_DataStore.baseParams.query!==null){searchquery = sms_response_DataStore.baseParams.query;}
		if(sms_response_DataStore.baseParams.response_receive!==null){response_receive_2excel = sms_response_DataStore.baseParams.response_receive;}
		if(sms_response_DataStore.baseParams.response_proccess!==null){response_proccess_2excel = sms_response_DataStore.baseParams.response_proccess;}
		if(sms_response_DataStore.baseParams.response_reply!==null){response_reply_2excel = sms_response_DataStore.baseParams.response_reply;}
		if(sms_response_DataStore.baseParams.response_security!==null){response_security_2excel = sms_response_DataStore.baseParams.response_security;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_sms_response&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			response_receive : response_receive_2excel,
			response_proccess : response_proccess_2excel,
			response_reply : response_reply_2excel,
			response_security : response_security_2excel,
		  	currentlisting: sms_response_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_sms_response"></div>
		<div id="elwindow_sms_response_create"></div>
        <div id="elwindow_sms_response_search"></div>
    </div>
</div>
</body>