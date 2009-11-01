<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms_code View
	+ Description	: For record view
	+ Filename 		: v_sms_code.php
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
var sms_code_DataStore;
var sms_code_ColumnModel;
var sms_codeListEditorGrid;
var sms_code_createForm;
var sms_code_createWindow;
var sms_code_searchForm;
var sms_code_searchWindow;
var sms_code_SelectedRow;
var sms_code_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var code_idField;
var code_nameField;
var code_queryField;
var code_idSearchField;
var code_nameSearchField;
var code_querySearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function sms_code_update(oGrid_event){
	var code_id_update_pk="";
	var code_name_update=null;
	var code_query_update=null;

	code_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.code_name!== null){code_name_update = oGrid_event.record.data.code_name;}
	if(oGrid_event.record.data.code_query!== null){code_query_update = oGrid_event.record.data.code_query;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_sms_code&m=get_action',
			params: {
				task: "UPDATE",
				code_id	: get_pk_id(),				code_name	:code_name_update,		
				code_query	:code_query_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						sms_code_DataStore.commitChanges();
						sms_code_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the sms_code.',
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
	function sms_code_create(){
		if(is_sms_code_form_valid()){
		
		var code_id_create_pk=null;
		var code_name_create=null;
		var code_query_create=null;

		code_id_create_pk=get_pk_id();
		if(code_nameField.getValue()!== null){code_name_create = code_nameField.getValue();}
		if(code_queryField.getValue()!== null){code_query_create = code_queryField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_sms_code&m=get_action',
				params: {
					task: post2db,
					code_id	: code_id_create_pk,	
					code_name	: code_name_create,	
					code_query	: code_query_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Sms_code was '+msg+' successfully.');
							sms_code_DataStore.reload();
							sms_code_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Sms_code.',
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
			return sms_codeListEditorGrid.getSelectionModel().getSelected().get('code_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function sms_code_reset_form(){
		code_nameField.reset();
		code_queryField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function sms_code_set_form(){
		code_nameField.setValue(sms_codeListEditorGrid.getSelectionModel().getSelected().get('code_name'));
		code_queryField.setValue(sms_codeListEditorGrid.getSelectionModel().getSelected().get('code_query'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_sms_code_form_valid(){
		return (true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!sms_code_createWindow.isVisible()){
			sms_code_reset_form();
			post2db='CREATE';
			msg='created';
			sms_code_createWindow.show();
		} else {
			sms_code_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function sms_code_confirm_delete(){
		// only one sms_code is selected here
		if(sms_codeListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', sms_code_delete);
		} else if(sms_codeListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', sms_code_delete);
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
	function sms_code_confirm_update(){
		/* only one record is selected here */
		if(sms_codeListEditorGrid.selModel.getCount() == 1) {
			sms_code_set_form();
			post2db='UPDATE';
			msg='updated';
			sms_code_createWindow.show();
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
	function sms_code_delete(btn){
		if(btn=='yes'){
			var selections = sms_codeListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< sms_codeListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.code_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_sms_code&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							sms_code_DataStore.reload();
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
	sms_code_DataStore = new Ext.data.Store({
		id: 'sms_code_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_sms_code&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'code_id'
		},[
		/* dataIndex => insert intosms_code_ColumnModel, Mapping => for initiate table column */ 
			{name: 'code_id', type: 'int', mapping: 'code_id'},
			{name: 'code_name', type: 'string', mapping: 'code_name'},
			{name: 'code_query', type: 'string', mapping: 'code_query'}
		]),
		sortInfo:{field: 'code_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	sms_code_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'code_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Code Name',
			dataIndex: 'code_name',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 150
          	})
		},
		{
			header: 'Code Query',
			dataIndex: 'code_query',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		}]
	);
	sms_code_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	sms_codeListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'sms_codeListEditorGrid',
		el: 'fp_sms_code',
		title: 'List Of Sms_code',
		autoHeight: true,
		store: sms_code_DataStore, // DataStore
		cm: sms_code_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: sms_code_DataStore,
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
			handler: sms_code_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: sms_code_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: sms_code_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: sms_code_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: sms_code_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: sms_code_print  
		}
		]
	});
	sms_codeListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	sms_code_ContextMenu = new Ext.menu.Menu({
		id: 'sms_code_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: sms_code_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: sms_code_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: sms_code_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: sms_code_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onsms_code_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		sms_code_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		sms_code_SelectedRow=rowIndex;
		sms_code_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function sms_code_editContextMenu(){
      sms_codeListEditorGrid.startEditing(sms_code_SelectedRow,1);
  	}
	/* End of Function */
  	
	sms_codeListEditorGrid.addListener('rowcontextmenu', onsms_code_ListEditGridContextMenu);
	sms_code_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	sms_codeListEditorGrid.on('afteredit', sms_code_update); // inLine Editing Record
	
	/* Identify  code_name Field */
	code_nameField= new Ext.form.TextField({
		id: 'code_nameField',
		fieldLabel: 'Code Name',
		maxLength: 150,
		anchor: '95%'
	});
	/* Identify  code_query Field */
	code_queryField= new Ext.form.TextField({
		id: 'code_queryField',
		fieldLabel: 'Code Query',
		maxLength: 500,
		anchor: '95%'
	});
  	
	/* Function for retrieve create Window Panel*/ 
	sms_code_createForm = new Ext.FormPanel({
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
				items: [code_nameField, code_queryField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: sms_code_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					sms_code_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	sms_code_createWindow= new Ext.Window({
		id: 'sms_code_createWindow',
		title: post2db+'Sms_code',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_sms_code_create',
		items: sms_code_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function sms_code_list_search(){
		// render according to a SQL date format.
		var code_id_search=null;
		var code_name_search=null;
		var code_query_search=null;

		if(code_idSearchField.getValue()!==null){code_id_search=code_idSearchField.getValue();}
		if(code_nameSearchField.getValue()!==null){code_name_search=code_nameSearchField.getValue();}
		if(code_querySearchField.getValue()!==null){code_query_search=code_querySearchField.getValue();}
		// change the store parameters
		sms_code_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			code_id	:	code_id_search, 
			code_name	:	code_name_search, 
			code_query	:	code_query_search 
};
		// Cause the datastore to do another query : 
		sms_code_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function sms_code_reset_search(){
		// reset the store parameters
		sms_code_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		sms_code_DataStore.reload({params: {start: 0, limit: pageS}});
		sms_code_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  code_id Search Field */
	code_idSearchField= new Ext.form.NumberField({
		id: 'code_idSearchField',
		fieldLabel: 'Code Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  code_name Search Field */
	code_nameSearchField= new Ext.form.TextField({
		id: 'code_nameSearchField',
		fieldLabel: 'Code Name',
		maxLength: 150,
		anchor: '95%'
	
	});
	/* Identify  code_query Search Field */
	code_querySearchField= new Ext.form.TextField({
		id: 'code_querySearchField',
		fieldLabel: 'Code Query',
		maxLength: 500,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	sms_code_searchForm = new Ext.FormPanel({
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
				items: [code_nameSearchField, code_querySearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: sms_code_list_search
			},{
				text: 'Close',
				handler: function(){
					sms_code_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	sms_code_searchWindow = new Ext.Window({
		title: 'sms_code Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_sms_code_search',
		items: sms_code_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!sms_code_searchWindow.isVisible()){
			sms_code_searchWindow.show();
		} else {
			sms_code_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function sms_code_print(){
		var searchquery = "";
		var code_name_print=null;
		var code_query_print=null;
		var win;              
		// check if we do have some search data...
		if(sms_code_DataStore.baseParams.query!==null){searchquery = sms_code_DataStore.baseParams.query;}
		if(sms_code_DataStore.baseParams.code_name!==null){code_name_print = sms_code_DataStore.baseParams.code_name;}
		if(sms_code_DataStore.baseParams.code_query!==null){code_query_print = sms_code_DataStore.baseParams.code_query;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_sms_code&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			code_name : code_name_print,
			code_query : code_query_print,
		  	currentlisting: sms_code_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./sms_codelist.html','sms_codelist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function sms_code_export_excel(){
		var searchquery = "";
		var code_name_2excel=null;
		var code_query_2excel=null;
		var win;              
		// check if we do have some search data...
		if(sms_code_DataStore.baseParams.query!==null){searchquery = sms_code_DataStore.baseParams.query;}
		if(sms_code_DataStore.baseParams.code_name!==null){code_name_2excel = sms_code_DataStore.baseParams.code_name;}
		if(sms_code_DataStore.baseParams.code_query!==null){code_query_2excel = sms_code_DataStore.baseParams.code_query;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_sms_code&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			code_name : code_name_2excel,
			code_query : code_query_2excel,
		  	currentlisting: sms_code_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_sms_code"></div>
		<div id="elwindow_sms_code_create"></div>
        <div id="elwindow_sms_code_search"></div>
    </div>
</div>
</body>