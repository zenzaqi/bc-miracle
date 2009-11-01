<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: permissions View
	+ Description	: For record view
	+ Filename 		: v_permissions.php
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
var permissions_DataStore;
var permissions_ColumnModel;
var permissionsListEditorGrid;
var permissions_createForm;
var permissions_createWindow;
var permissions_searchForm;
var permissions_searchWindow;
var permissions_SelectedRow;
var permissions_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var perm_groupField;
var perm_menuField;
var perm_privField;
var perm_groupSearchField;
var perm_menuSearchField;
var perm_privSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function permissions_update(oGrid_event){
	var perm_group_update_pk="";
	var perm_menu_update_pk="";
	var perm_priv_update=null;

	perm_group_update_pk = get_pk_id();
	perm_menu_update_pk = get_pk_id();
	if(oGrid_event.record.data.perm_priv!== null){perm_priv_update = oGrid_event.record.data.perm_priv;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_permissions&m=get_action',
			params: {
				task: "UPDATE",
				perm_group	: get_pk_id(),				perm_menu	: get_pk_id(),				perm_priv	:perm_priv_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						permissions_DataStore.commitChanges();
						permissions_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the permissions.',
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
	function permissions_create(){
		if(is_permissions_form_valid()){
		
		var perm_group_create=null;
		var perm_menu_create=null;
		var perm_priv_create=null;

		if(perm_groupField.getValue()!== null){perm_group_create = perm_groupField.getValue();}
		if(perm_menuField.getValue()!== null){perm_menu_create = perm_menuField.getValue();}
		if(perm_privField.getValue()!== null){perm_priv_create = perm_privField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_permissions&m=get_action',
				params: {
					task: post2db,
					perm_group	: perm_group_create_pk,	
					perm_menu	: perm_menu_create_pk,	
					perm_priv	: perm_priv_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Permissions was '+msg+' successfully.');
							permissions_DataStore.reload();
							permissions_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Permissions.',
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
			return permissionsListEditorGrid.getSelectionModel().getSelected().get('perm_group,perm_menu');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function permissions_reset_form(){
		perm_privField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function permissions_set_form(){
		perm_groupField.setValue(permissionsListEditorGrid.getSelectionModel().getSelected().get('perm_group'));
		perm_menuField.setValue(permissionsListEditorGrid.getSelectionModel().getSelected().get('perm_menu'));
		perm_privField.setValue(permissionsListEditorGrid.getSelectionModel().getSelected().get('perm_priv'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_permissions_form_valid(){
		return (perm_groupField.isValid() && perm_menuField.isValid() && perm_privField.isValid() );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!permissions_createWindow.isVisible()){
			permissions_reset_form();
			post2db='CREATE';
			msg='created';
			permissions_createWindow.show();
		} else {
			permissions_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function permissions_confirm_delete(){
		// only one permissions is selected here
		if(permissionsListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', permissions_delete);
		} else if(permissionsListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', permissions_delete);
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
	function permissions_confirm_update(){
		/* only one record is selected here */
		if(permissionsListEditorGrid.selModel.getCount() == 1) {
			permissions_set_form();
			post2db='UPDATE';
			msg='updated';
			permissions_createWindow.show();
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
	function permissions_delete(btn){
		if(btn=='yes'){
			var selections = permissionsListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< permissionsListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.perm_group,perm_menu);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_permissions&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							permissions_DataStore.reload();
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
	permissions_DataStore = new Ext.data.Store({
		id: 'permissions_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_permissions&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'perm_group,perm_menu'
		},[
		/* dataIndex => insert intopermissions_ColumnModel, Mapping => for initiate table column */ 
			{name: 'perm_group', type: 'int', mapping: 'perm_group'},
			{name: 'perm_menu', type: 'int', mapping: 'perm_menu'},
			{name: 'perm_priv', type: 'string', mapping: 'perm_priv'}
		]),
		sortInfo:{field: 'perm_group,perm_menu', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	permissions_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'perm_group,perm_menu',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Perm Priv',
			dataIndex: 'perm_priv',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 5
          	})
		}]
	);
	permissions_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	permissionsListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'permissionsListEditorGrid',
		el: 'fp_permissions',
		title: 'List Of Permissions',
		autoHeight: true,
		store: permissions_DataStore, // DataStore
		cm: permissions_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: permissions_DataStore,
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
			handler: permissions_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: permissions_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: permissions_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: permissions_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: permissions_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: permissions_print  
		}
		]
	});
	permissionsListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	permissions_ContextMenu = new Ext.menu.Menu({
		id: 'permissions_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: permissions_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: permissions_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: permissions_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: permissions_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onpermissions_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		permissions_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		permissions_SelectedRow=rowIndex;
		permissions_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function permissions_editContextMenu(){
      permissionsListEditorGrid.startEditing(permissions_SelectedRow,1);
  	}
	/* End of Function */
  	
	permissionsListEditorGrid.addListener('rowcontextmenu', onpermissions_ListEditGridContextMenu);
	permissions_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	permissionsListEditorGrid.on('afteredit', permissions_update); // inLine Editing Record
	
	/* Identify  perm_group Field */
	perm_groupField= new Ext.form.NumberField({
		id: 'perm_groupField',
		fieldLabel: 'Perm Group',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  perm_menu Field */
	perm_menuField= new Ext.form.NumberField({
		id: 'perm_menuField',
		fieldLabel: 'Perm Menu',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  perm_priv Field */
	perm_privField= new Ext.form.TextField({
		id: 'perm_privField',
		fieldLabel: 'Perm Priv',
		maxLength: 5,
		allowBlank: false,
		anchor: '95%'
	});
  	
	/* Function for retrieve create Window Panel*/ 
	permissions_createForm = new Ext.FormPanel({
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
				items: [perm_groupFieldperm_menuField, perm_privField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: permissions_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					permissions_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	permissions_createWindow= new Ext.Window({
		id: 'permissions_createWindow',
		title: post2db+'Permissions',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_permissions_create',
		items: permissions_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function permissions_list_search(){
		// render according to a SQL date format.
		var perm_group_search=null;
		var perm_menu_search=null;
		var perm_priv_search=null;

		if(perm_groupSearchField.getValue()!==null){perm_group_search=perm_groupSearchField.getValue();}
		if(perm_menuSearchField.getValue()!==null){perm_menu_search=perm_menuSearchField.getValue();}
		if(perm_privSearchField.getValue()!==null){perm_priv_search=perm_privSearchField.getValue();}
		// change the store parameters
		permissions_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			perm_group	:	perm_group_search, 
			perm_menu	:	perm_menu_search, 
			perm_priv	:	perm_priv_search 
};
		// Cause the datastore to do another query : 
		permissions_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function permissions_reset_search(){
		// reset the store parameters
		permissions_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		permissions_DataStore.reload({params: {start: 0, limit: pageS}});
		permissions_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  perm_group Search Field */
	perm_groupSearchField= new Ext.form.NumberField({
		id: 'perm_groupSearchField',
		fieldLabel: 'Perm Group',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  perm_menu Search Field */
	perm_menuSearchField= new Ext.form.NumberField({
		id: 'perm_menuSearchField',
		fieldLabel: 'Perm Menu',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  perm_priv Search Field */
	perm_privSearchField= new Ext.form.TextField({
		id: 'perm_privSearchField',
		fieldLabel: 'Perm Priv',
		maxLength: 5,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	permissions_searchForm = new Ext.FormPanel({
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
				items: [perm_groupSearchFieldperm_menuSearchField, perm_privSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: permissions_list_search
			},{
				text: 'Close',
				handler: function(){
					permissions_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	permissions_searchWindow = new Ext.Window({
		title: 'permissions Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_permissions_search',
		items: permissions_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!permissions_searchWindow.isVisible()){
			permissions_searchWindow.show();
		} else {
			permissions_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function permissions_print(){
		var searchquery = "";
		var perm_group_print=null;
		var perm_menu_print=null;
		var perm_priv_print=null;
		var win;              
		// check if we do have some search data...
		if(permissions_DataStore.baseParams.query!==null){searchquery = permissions_DataStore.baseParams.query;}
		if(permissions_DataStore.baseParams.perm_group!==null){perm_group_print = permissions_DataStore.baseParams.perm_group;}
		if(permissions_DataStore.baseParams.perm_menu!==null){perm_menu_print = permissions_DataStore.baseParams.perm_menu;}
		if(permissions_DataStore.baseParams.perm_priv!==null){perm_priv_print = permissions_DataStore.baseParams.perm_priv;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_permissions&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			perm_group : perm_group_print,
			perm_menu : perm_menu_print,
			perm_priv : perm_priv_print,
		  	currentlisting: permissions_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./permissionslist.html','permissionslist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function permissions_export_excel(){
		var searchquery = "";
		var perm_group_2excel=null;
		var perm_menu_2excel=null;
		var perm_priv_2excel=null;
		var win;              
		// check if we do have some search data...
		if(permissions_DataStore.baseParams.query!==null){searchquery = permissions_DataStore.baseParams.query;}
		if(permissions_DataStore.baseParams.perm_group!==null){perm_group_2excel = permissions_DataStore.baseParams.perm_group;}
		if(permissions_DataStore.baseParams.perm_menu!==null){perm_menu_2excel = permissions_DataStore.baseParams.perm_menu;}
		if(permissions_DataStore.baseParams.perm_priv!==null){perm_priv_2excel = permissions_DataStore.baseParams.perm_priv;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_permissions&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			perm_group : perm_group_2excel,
			perm_menu : perm_menu_2excel,
			perm_priv : perm_priv_2excel,
		  	currentlisting: permissions_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_permissions"></div>
		<div id="elwindow_permissions_create"></div>
        <div id="elwindow_permissions_search"></div>
    </div>
</div>
</body>