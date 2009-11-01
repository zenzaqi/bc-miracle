<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: anamnesa_problem View
	+ Description	: For record view
	+ Filename 		: v_anamnesa_problem.php
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
var anamnesa_problem_DataStore;
var anamnesa_problem_ColumnModel;
var anamnesa_problemListEditorGrid;
var anamnesa_problem_createForm;
var anamnesa_problem_createWindow;
var anamnesa_problem_searchForm;
var anamnesa_problem_searchWindow;
var anamnesa_problem_SelectedRow;
var anamnesa_problem_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var anam_custField;
var anam_tanggalField;
var anam_problemField;
var anam_lamaproblemField;
var anam_aksiproblemField;
var anam_aksiketField;
var anam_custSearchField;
var anam_tanggalSearchField;
var anam_problemSearchField;
var anam_lamaproblemSearchField;
var anam_aksiproblemSearchField;
var anam_aksiketSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function anamnesa_problem_update(oGrid_event){
	var anam_cust_update_pk="";
	var anam_tanggal_update_pk="";
	var anam_problem_update_pk="";
	var anam_lamaproblem_update=null;
	var anam_aksiproblem_update=null;
	var anam_aksiket_update=null;

	anam_cust_update_pk = get_pk_id();
	anam_tanggal_update_pk = get_pk_id();
	anam_problem_update_pk = get_pk_id();
	if(oGrid_event.record.data.anam_lamaproblem!== null){anam_lamaproblem_update = oGrid_event.record.data.anam_lamaproblem;}
	if(oGrid_event.record.data.anam_aksiproblem!== null){anam_aksiproblem_update = oGrid_event.record.data.anam_aksiproblem;}
	if(oGrid_event.record.data.anam_aksiket!== null){anam_aksiket_update = oGrid_event.record.data.anam_aksiket;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_anamnesa_problem&m=get_action',
			params: {
				task: "UPDATE",
				anam_cust	: get_pk_id(),				anam_tanggal	: get_pk_id(),				anam_problem	: get_pk_id(),				anam_lamaproblem	:anam_lamaproblem_update,		
				anam_aksiproblem	:anam_aksiproblem_update,		
				anam_aksiket	:anam_aksiket_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						anamnesa_problem_DataStore.commitChanges();
						anamnesa_problem_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the anamnesa_problem.',
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
	function anamnesa_problem_create(){
		if(is_anamnesa_problem_form_valid()){
		
		var anam_cust_create=null;
		var anam_tanggal_create_date="";
		var anam_problem_create=null;
		var anam_lamaproblem_create=null;
		var anam_aksiproblem_create=null;
		var anam_aksiket_create=null;

		if(anam_custField.getValue()!== null){anam_cust_create = anam_custField.getValue();}
		if(anam_tanggalField.getValue()!== ""){anam_tanggal_create_date = anam_tanggalField.getValue().format('Y-m-d');}
		if(anam_problemField.getValue()!== null){anam_problem_create = anam_problemField.getValue();}
		if(anam_lamaproblemField.getValue()!== null){anam_lamaproblem_create = anam_lamaproblemField.getValue();}
		if(anam_aksiproblemField.getValue()!== null){anam_aksiproblem_create = anam_aksiproblemField.getValue();}
		if(anam_aksiketField.getValue()!== null){anam_aksiket_create = anam_aksiketField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_anamnesa_problem&m=get_action',
				params: {
					task: post2db,
					anam_cust	: anam_cust_create_pk,	
					anam_tanggal	: anam_tanggal_create_pk,	
					anam_problem	: anam_problem_create_pk,	
					anam_lamaproblem	: anam_lamaproblem_create,	
					anam_aksiproblem	: anam_aksiproblem_create,	
					anam_aksiket	: anam_aksiket_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Anamnesa_problem was '+msg+' successfully.');
							anamnesa_problem_DataStore.reload();
							anamnesa_problem_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Anamnesa_problem.',
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
			return anamnesa_problemListEditorGrid.getSelectionModel().getSelected().get('anam_cust,anam_tanggal,anam_problem');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function anamnesa_problem_reset_form(){
		anam_lamaproblemField.reset();
		anam_aksiproblemField.reset();
		anam_aksiketField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function anamnesa_problem_set_form(){
		anam_custField.setValue(anamnesa_problemListEditorGrid.getSelectionModel().getSelected().get('anam_cust'));
		anam_tanggalField.setValue(anamnesa_problemListEditorGrid.getSelectionModel().getSelected().get('anam_tanggal'));
		anam_problemField.setValue(anamnesa_problemListEditorGrid.getSelectionModel().getSelected().get('anam_problem'));
		anam_lamaproblemField.setValue(anamnesa_problemListEditorGrid.getSelectionModel().getSelected().get('anam_lamaproblem'));
		anam_aksiproblemField.setValue(anamnesa_problemListEditorGrid.getSelectionModel().getSelected().get('anam_aksiproblem'));
		anam_aksiketField.setValue(anamnesa_problemListEditorGrid.getSelectionModel().getSelected().get('anam_aksiket'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_anamnesa_problem_form_valid(){
		return (anam_custField.isValid() && anam_tanggalField.isValid() && anam_problemField.isValid() && true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!anamnesa_problem_createWindow.isVisible()){
			anamnesa_problem_reset_form();
			post2db='CREATE';
			msg='created';
			anamnesa_problem_createWindow.show();
		} else {
			anamnesa_problem_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function anamnesa_problem_confirm_delete(){
		// only one anamnesa_problem is selected here
		if(anamnesa_problemListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', anamnesa_problem_delete);
		} else if(anamnesa_problemListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', anamnesa_problem_delete);
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
	function anamnesa_problem_confirm_update(){
		/* only one record is selected here */
		if(anamnesa_problemListEditorGrid.selModel.getCount() == 1) {
			anamnesa_problem_set_form();
			post2db='UPDATE';
			msg='updated';
			anamnesa_problem_createWindow.show();
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
	function anamnesa_problem_delete(btn){
		if(btn=='yes'){
			var selections = anamnesa_problemListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< anamnesa_problemListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.anam_cust,anam_tanggal,anam_problem);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_anamnesa_problem&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							anamnesa_problem_DataStore.reload();
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
	anamnesa_problem_DataStore = new Ext.data.Store({
		id: 'anamnesa_problem_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_anamnesa_problem&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'anam_cust,anam_tanggal,anam_problem'
		},[
		/* dataIndex => insert intoanamnesa_problem_ColumnModel, Mapping => for initiate table column */ 
			{name: 'anam_cust', type: 'int', mapping: 'anam_cust'},
			{name: 'anam_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'anam_tanggal'},
			{name: 'anam_problem', type: 'string', mapping: 'anam_problem'},
			{name: 'anam_lamaproblem', type: 'string', mapping: 'anam_lamaproblem'},
			{name: 'anam_aksiproblem', type: 'string', mapping: 'anam_aksiproblem'},
			{name: 'anam_aksiket', type: 'string', mapping: 'anam_aksiket'}
		]),
		sortInfo:{field: 'anam_cust,anam_tanggal,anam_problem', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	anamnesa_problem_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'anam_cust,anam_tanggal,anam_problem',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Anam Lamaproblem',
			dataIndex: 'anam_lamaproblem',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Anam Aksiproblem',
			dataIndex: 'anam_aksiproblem',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Anam Aksiket',
			dataIndex: 'anam_aksiket',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}]
	);
	anamnesa_problem_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	anamnesa_problemListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'anamnesa_problemListEditorGrid',
		el: 'fp_anamnesa_problem',
		title: 'List Of Anamnesa_problem',
		autoHeight: true,
		store: anamnesa_problem_DataStore, // DataStore
		cm: anamnesa_problem_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: anamnesa_problem_DataStore,
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
			handler: anamnesa_problem_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: anamnesa_problem_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: anamnesa_problem_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: anamnesa_problem_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: anamnesa_problem_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: anamnesa_problem_print  
		}
		]
	});
	anamnesa_problemListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	anamnesa_problem_ContextMenu = new Ext.menu.Menu({
		id: 'anamnesa_problem_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: anamnesa_problem_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: anamnesa_problem_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: anamnesa_problem_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: anamnesa_problem_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onanamnesa_problem_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		anamnesa_problem_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		anamnesa_problem_SelectedRow=rowIndex;
		anamnesa_problem_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function anamnesa_problem_editContextMenu(){
      anamnesa_problemListEditorGrid.startEditing(anamnesa_problem_SelectedRow,1);
  	}
	/* End of Function */
  	
	anamnesa_problemListEditorGrid.addListener('rowcontextmenu', onanamnesa_problem_ListEditGridContextMenu);
	anamnesa_problem_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	anamnesa_problemListEditorGrid.on('afteredit', anamnesa_problem_update); // inLine Editing Record
	
	/* Identify  anam_cust Field */
	anam_custField= new Ext.form.NumberField({
		id: 'anam_custField',
		fieldLabel: 'Anam Cust',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  anam_tanggal Field */
	anam_tanggalField= new Ext.form.DateField({
		id: 'anam_tanggalField',
		fieldLabel: 'Anam Tanggal',
		format : 'Y-m-d',
		allowBlank: false,
	});
	/* Identify  anam_problem Field */
	anam_problemField= new Ext.form.TextField({
		id: 'anam_problemField',
		fieldLabel: 'Anam Problem',
		maxLength: 500,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  anam_lamaproblem Field */
	anam_lamaproblemField= new Ext.form.TextField({
		id: 'anam_lamaproblemField',
		fieldLabel: 'Anam Lamaproblem',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  anam_aksiproblem Field */
	anam_aksiproblemField= new Ext.form.TextField({
		id: 'anam_aksiproblemField',
		fieldLabel: 'Anam Aksiproblem',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  anam_aksiket Field */
	anam_aksiketField= new Ext.form.TextField({
		id: 'anam_aksiketField',
		fieldLabel: 'Anam Aksiket',
		maxLength: 250,
		anchor: '95%'
	});
  	
	/* Function for retrieve create Window Panel*/ 
	anamnesa_problem_createForm = new Ext.FormPanel({
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
				items: [anam_custFieldanam_tanggalField, anam_problemField, anam_lamaproblemField, anam_aksiproblemField, anam_aksiketField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: anamnesa_problem_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					anamnesa_problem_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	anamnesa_problem_createWindow= new Ext.Window({
		id: 'anamnesa_problem_createWindow',
		title: post2db+'Anamnesa_problem',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_anamnesa_problem_create',
		items: anamnesa_problem_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function anamnesa_problem_list_search(){
		// render according to a SQL date format.
		var anam_cust_search=null;
		var anam_tanggal_search_date="";
		var anam_problem_search=null;
		var anam_lamaproblem_search=null;
		var anam_aksiproblem_search=null;
		var anam_aksiket_search=null;

		if(anam_custSearchField.getValue()!==null){anam_cust_search=anam_custSearchField.getValue();}
		if(anam_tanggalSearchField.getValue()!==""){anam_tanggal_search_date=anam_tanggalSearchField.getValue().format('Y-m-d');}
		if(anam_problemSearchField.getValue()!==null){anam_problem_search=anam_problemSearchField.getValue();}
		if(anam_lamaproblemSearchField.getValue()!==null){anam_lamaproblem_search=anam_lamaproblemSearchField.getValue();}
		if(anam_aksiproblemSearchField.getValue()!==null){anam_aksiproblem_search=anam_aksiproblemSearchField.getValue();}
		if(anam_aksiketSearchField.getValue()!==null){anam_aksiket_search=anam_aksiketSearchField.getValue();}
		// change the store parameters
		anamnesa_problem_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			anam_cust	:	anam_cust_search, 
			anam_tanggal	:	anam_tanggal_search_date, 
			anam_problem	:	anam_problem_search, 
			anam_lamaproblem	:	anam_lamaproblem_search, 
			anam_aksiproblem	:	anam_aksiproblem_search, 
			anam_aksiket	:	anam_aksiket_search 
};
		// Cause the datastore to do another query : 
		anamnesa_problem_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function anamnesa_problem_reset_search(){
		// reset the store parameters
		anamnesa_problem_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		anamnesa_problem_DataStore.reload({params: {start: 0, limit: pageS}});
		anamnesa_problem_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  anam_cust Search Field */
	anam_custSearchField= new Ext.form.NumberField({
		id: 'anam_custSearchField',
		fieldLabel: 'Anam Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  anam_tanggal Search Field */
	anam_tanggalSearchField= new Ext.form.DateField({
		id: 'anam_tanggalSearchField',
		fieldLabel: 'Anam Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  anam_problem Search Field */
	anam_problemSearchField= new Ext.form.TextField({
		id: 'anam_problemSearchField',
		fieldLabel: 'Anam Problem',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  anam_lamaproblem Search Field */
	anam_lamaproblemSearchField= new Ext.form.TextField({
		id: 'anam_lamaproblemSearchField',
		fieldLabel: 'Anam Lamaproblem',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  anam_aksiproblem Search Field */
	anam_aksiproblemSearchField= new Ext.form.TextField({
		id: 'anam_aksiproblemSearchField',
		fieldLabel: 'Anam Aksiproblem',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  anam_aksiket Search Field */
	anam_aksiketSearchField= new Ext.form.TextField({
		id: 'anam_aksiketSearchField',
		fieldLabel: 'Anam Aksiket',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	anamnesa_problem_searchForm = new Ext.FormPanel({
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
				items: [anam_custSearchFieldanam_tanggalSearchField, anam_problemSearchField, anam_lamaproblemSearchField, anam_aksiproblemSearchField, anam_aksiketSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: anamnesa_problem_list_search
			},{
				text: 'Close',
				handler: function(){
					anamnesa_problem_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	anamnesa_problem_searchWindow = new Ext.Window({
		title: 'anamnesa_problem Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_anamnesa_problem_search',
		items: anamnesa_problem_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!anamnesa_problem_searchWindow.isVisible()){
			anamnesa_problem_searchWindow.show();
		} else {
			anamnesa_problem_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function anamnesa_problem_print(){
		var searchquery = "";
		var anam_cust_print=null;
		var anam_tanggal_print_date="";
		var anam_problem_print=null;
		var anam_lamaproblem_print=null;
		var anam_aksiproblem_print=null;
		var anam_aksiket_print=null;
		var win;              
		// check if we do have some search data...
		if(anamnesa_problem_DataStore.baseParams.query!==null){searchquery = anamnesa_problem_DataStore.baseParams.query;}
		if(anamnesa_problem_DataStore.baseParams.anam_cust!==null){anam_cust_print = anamnesa_problem_DataStore.baseParams.anam_cust;}
		if(anamnesa_problem_DataStore.baseParams.anam_tanggal!==""){anam_tanggal_print_date = anamnesa_problem_DataStore.baseParams.anam_tanggal;}
		if(anamnesa_problem_DataStore.baseParams.anam_problem!==null){anam_problem_print = anamnesa_problem_DataStore.baseParams.anam_problem;}
		if(anamnesa_problem_DataStore.baseParams.anam_lamaproblem!==null){anam_lamaproblem_print = anamnesa_problem_DataStore.baseParams.anam_lamaproblem;}
		if(anamnesa_problem_DataStore.baseParams.anam_aksiproblem!==null){anam_aksiproblem_print = anamnesa_problem_DataStore.baseParams.anam_aksiproblem;}
		if(anamnesa_problem_DataStore.baseParams.anam_aksiket!==null){anam_aksiket_print = anamnesa_problem_DataStore.baseParams.anam_aksiket;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_anamnesa_problem&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			anam_cust : anam_cust_print,
		  	anam_tanggal : anam_tanggal_print_date, 
			anam_problem : anam_problem_print,
			anam_lamaproblem : anam_lamaproblem_print,
			anam_aksiproblem : anam_aksiproblem_print,
			anam_aksiket : anam_aksiket_print,
		  	currentlisting: anamnesa_problem_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./anamnesa_problemlist.html','anamnesa_problemlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function anamnesa_problem_export_excel(){
		var searchquery = "";
		var anam_cust_2excel=null;
		var anam_tanggal_2excel_date="";
		var anam_problem_2excel=null;
		var anam_lamaproblem_2excel=null;
		var anam_aksiproblem_2excel=null;
		var anam_aksiket_2excel=null;
		var win;              
		// check if we do have some search data...
		if(anamnesa_problem_DataStore.baseParams.query!==null){searchquery = anamnesa_problem_DataStore.baseParams.query;}
		if(anamnesa_problem_DataStore.baseParams.anam_cust!==null){anam_cust_2excel = anamnesa_problem_DataStore.baseParams.anam_cust;}
		if(anamnesa_problem_DataStore.baseParams.anam_tanggal!==""){anam_tanggal_2excel_date = anamnesa_problem_DataStore.baseParams.anam_tanggal;}
		if(anamnesa_problem_DataStore.baseParams.anam_problem!==null){anam_problem_2excel = anamnesa_problem_DataStore.baseParams.anam_problem;}
		if(anamnesa_problem_DataStore.baseParams.anam_lamaproblem!==null){anam_lamaproblem_2excel = anamnesa_problem_DataStore.baseParams.anam_lamaproblem;}
		if(anamnesa_problem_DataStore.baseParams.anam_aksiproblem!==null){anam_aksiproblem_2excel = anamnesa_problem_DataStore.baseParams.anam_aksiproblem;}
		if(anamnesa_problem_DataStore.baseParams.anam_aksiket!==null){anam_aksiket_2excel = anamnesa_problem_DataStore.baseParams.anam_aksiket;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_anamnesa_problem&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			anam_cust : anam_cust_2excel,
		  	anam_tanggal : anam_tanggal_2excel_date, 
			anam_problem : anam_problem_2excel,
			anam_lamaproblem : anam_lamaproblem_2excel,
			anam_aksiproblem : anam_aksiproblem_2excel,
			anam_aksiket : anam_aksiket_2excel,
		  	currentlisting: anamnesa_problem_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_anamnesa_problem"></div>
		<div id="elwindow_anamnesa_problem_create"></div>
        <div id="elwindow_anamnesa_problem_search"></div>
    </div>
</div>
</body>