<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: anamnesa_penyakit View
	+ Description	: For record view
	+ Filename 		: v_anamnesa_penyakit.php
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
var anamnesa_penyakit_DataStore;
var anamnesa_penyakit_ColumnModel;
var anamnesa_penyakitListEditorGrid;
var anamnesa_penyakit_createForm;
var anamnesa_penyakit_createWindow;
var anamnesa_penyakit_searchForm;
var anamnesa_penyakit_searchWindow;
var anamnesa_penyakit_SelectedRow;
var anamnesa_penyakit_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var anam_custField;
var anam_tanggalField;
var anam_penyakitField;
var anam_keteranganField;
var anam_custSearchField;
var anam_tanggalSearchField;
var anam_penyakitSearchField;
var anam_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function anamnesa_penyakit_update(oGrid_event){
	var anam_cust_update_pk="";
	var anam_tanggal_update_pk="";
	var anam_penyakit_update_pk="";
	var anam_keterangan_update=null;

	anam_cust_update_pk = get_pk_id();
	anam_tanggal_update_pk = get_pk_id();
	anam_penyakit_update_pk = get_pk_id();
	if(oGrid_event.record.data.anam_keterangan!== null){anam_keterangan_update = oGrid_event.record.data.anam_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_anamnesa_penyakit&m=get_action',
			params: {
				task: "UPDATE",
				anam_cust	: get_pk_id(),				anam_tanggal	: get_pk_id(),				anam_penyakit	: get_pk_id(),				anam_keterangan	:anam_keterangan_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						anamnesa_penyakit_DataStore.commitChanges();
						anamnesa_penyakit_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the anamnesa_penyakit.',
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
	function anamnesa_penyakit_create(){
		if(is_anamnesa_penyakit_form_valid()){
		
		var anam_cust_create=null;
		var anam_tanggal_create_date="";
		var anam_penyakit_create=null;
		var anam_keterangan_create=null;

		if(anam_custField.getValue()!== null){anam_cust_create = anam_custField.getValue();}
		if(anam_tanggalField.getValue()!== ""){anam_tanggal_create_date = anam_tanggalField.getValue().format('Y-m-d');}
		if(anam_penyakitField.getValue()!== null){anam_penyakit_create = anam_penyakitField.getValue();}
		if(anam_keteranganField.getValue()!== null){anam_keterangan_create = anam_keteranganField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_anamnesa_penyakit&m=get_action',
				params: {
					task: post2db,
					anam_cust	: anam_cust_create_pk,	
					anam_tanggal	: anam_tanggal_create_pk,	
					anam_penyakit	: anam_penyakit_create_pk,	
					anam_keterangan	: anam_keterangan_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Anamnesa_penyakit was '+msg+' successfully.');
							anamnesa_penyakit_DataStore.reload();
							anamnesa_penyakit_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Anamnesa_penyakit.',
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
			return anamnesa_penyakitListEditorGrid.getSelectionModel().getSelected().get('anam_cust,anam_tanggal,anam_penyakit');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function anamnesa_penyakit_reset_form(){
		anam_keteranganField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function anamnesa_penyakit_set_form(){
		anam_custField.setValue(anamnesa_penyakitListEditorGrid.getSelectionModel().getSelected().get('anam_cust'));
		anam_tanggalField.setValue(anamnesa_penyakitListEditorGrid.getSelectionModel().getSelected().get('anam_tanggal'));
		anam_penyakitField.setValue(anamnesa_penyakitListEditorGrid.getSelectionModel().getSelected().get('anam_penyakit'));
		anam_keteranganField.setValue(anamnesa_penyakitListEditorGrid.getSelectionModel().getSelected().get('anam_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_anamnesa_penyakit_form_valid(){
		return (anam_custField.isValid() && anam_tanggalField.isValid() && anam_penyakitField.isValid() && true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!anamnesa_penyakit_createWindow.isVisible()){
			anamnesa_penyakit_reset_form();
			post2db='CREATE';
			msg='created';
			anamnesa_penyakit_createWindow.show();
		} else {
			anamnesa_penyakit_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function anamnesa_penyakit_confirm_delete(){
		// only one anamnesa_penyakit is selected here
		if(anamnesa_penyakitListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', anamnesa_penyakit_delete);
		} else if(anamnesa_penyakitListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', anamnesa_penyakit_delete);
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
	function anamnesa_penyakit_confirm_update(){
		/* only one record is selected here */
		if(anamnesa_penyakitListEditorGrid.selModel.getCount() == 1) {
			anamnesa_penyakit_set_form();
			post2db='UPDATE';
			msg='updated';
			anamnesa_penyakit_createWindow.show();
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
	function anamnesa_penyakit_delete(btn){
		if(btn=='yes'){
			var selections = anamnesa_penyakitListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< anamnesa_penyakitListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.anam_cust,anam_tanggal,anam_penyakit);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_anamnesa_penyakit&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							anamnesa_penyakit_DataStore.reload();
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
	anamnesa_penyakit_DataStore = new Ext.data.Store({
		id: 'anamnesa_penyakit_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_anamnesa_penyakit&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'anam_cust,anam_tanggal,anam_penyakit'
		},[
		/* dataIndex => insert intoanamnesa_penyakit_ColumnModel, Mapping => for initiate table column */ 
			{name: 'anam_cust', type: 'int', mapping: 'anam_cust'},
			{name: 'anam_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'anam_tanggal'},
			{name: 'anam_penyakit', type: 'string', mapping: 'anam_penyakit'},
			{name: 'anam_keterangan', type: 'string', mapping: 'anam_keterangan'}
		]),
		sortInfo:{field: 'anam_cust,anam_tanggal,anam_penyakit', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	anamnesa_penyakit_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'anam_cust,anam_tanggal,anam_penyakit',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Anam Keterangan',
			dataIndex: 'anam_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		}]
	);
	anamnesa_penyakit_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	anamnesa_penyakitListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'anamnesa_penyakitListEditorGrid',
		el: 'fp_anamnesa_penyakit',
		title: 'List Of Anamnesa_penyakit',
		autoHeight: true,
		store: anamnesa_penyakit_DataStore, // DataStore
		cm: anamnesa_penyakit_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: anamnesa_penyakit_DataStore,
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
			handler: anamnesa_penyakit_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: anamnesa_penyakit_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: anamnesa_penyakit_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: anamnesa_penyakit_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: anamnesa_penyakit_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: anamnesa_penyakit_print  
		}
		]
	});
	anamnesa_penyakitListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	anamnesa_penyakit_ContextMenu = new Ext.menu.Menu({
		id: 'anamnesa_penyakit_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: anamnesa_penyakit_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: anamnesa_penyakit_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: anamnesa_penyakit_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: anamnesa_penyakit_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onanamnesa_penyakit_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		anamnesa_penyakit_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		anamnesa_penyakit_SelectedRow=rowIndex;
		anamnesa_penyakit_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function anamnesa_penyakit_editContextMenu(){
      anamnesa_penyakitListEditorGrid.startEditing(anamnesa_penyakit_SelectedRow,1);
  	}
	/* End of Function */
  	
	anamnesa_penyakitListEditorGrid.addListener('rowcontextmenu', onanamnesa_penyakit_ListEditGridContextMenu);
	anamnesa_penyakit_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	anamnesa_penyakitListEditorGrid.on('afteredit', anamnesa_penyakit_update); // inLine Editing Record
	
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
	/* Identify  anam_penyakit Field */
	anam_penyakitField= new Ext.form.TextField({
		id: 'anam_penyakitField',
		fieldLabel: 'Anam Penyakit',
		maxLength: 100,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  anam_keterangan Field */
	anam_keteranganField= new Ext.form.TextField({
		id: 'anam_keteranganField',
		fieldLabel: 'Anam Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
  	
	/* Function for retrieve create Window Panel*/ 
	anamnesa_penyakit_createForm = new Ext.FormPanel({
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
				items: [anam_custFieldanam_tanggalField, anam_penyakitField, anam_keteranganField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: anamnesa_penyakit_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					anamnesa_penyakit_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	anamnesa_penyakit_createWindow= new Ext.Window({
		id: 'anamnesa_penyakit_createWindow',
		title: post2db+'Anamnesa_penyakit',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_anamnesa_penyakit_create',
		items: anamnesa_penyakit_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function anamnesa_penyakit_list_search(){
		// render according to a SQL date format.
		var anam_cust_search=null;
		var anam_tanggal_search_date="";
		var anam_penyakit_search=null;
		var anam_keterangan_search=null;

		if(anam_custSearchField.getValue()!==null){anam_cust_search=anam_custSearchField.getValue();}
		if(anam_tanggalSearchField.getValue()!==""){anam_tanggal_search_date=anam_tanggalSearchField.getValue().format('Y-m-d');}
		if(anam_penyakitSearchField.getValue()!==null){anam_penyakit_search=anam_penyakitSearchField.getValue();}
		if(anam_keteranganSearchField.getValue()!==null){anam_keterangan_search=anam_keteranganSearchField.getValue();}
		// change the store parameters
		anamnesa_penyakit_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			anam_cust	:	anam_cust_search, 
			anam_tanggal	:	anam_tanggal_search_date, 
			anam_penyakit	:	anam_penyakit_search, 
			anam_keterangan	:	anam_keterangan_search 
};
		// Cause the datastore to do another query : 
		anamnesa_penyakit_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function anamnesa_penyakit_reset_search(){
		// reset the store parameters
		anamnesa_penyakit_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		anamnesa_penyakit_DataStore.reload({params: {start: 0, limit: pageS}});
		anamnesa_penyakit_searchWindow.close();
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
	/* Identify  anam_penyakit Search Field */
	anam_penyakitSearchField= new Ext.form.TextField({
		id: 'anam_penyakitSearchField',
		fieldLabel: 'Anam Penyakit',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  anam_keterangan Search Field */
	anam_keteranganSearchField= new Ext.form.TextField({
		id: 'anam_keteranganSearchField',
		fieldLabel: 'Anam Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	anamnesa_penyakit_searchForm = new Ext.FormPanel({
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
				items: [anam_custSearchFieldanam_tanggalSearchField, anam_penyakitSearchField, anam_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: anamnesa_penyakit_list_search
			},{
				text: 'Close',
				handler: function(){
					anamnesa_penyakit_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	anamnesa_penyakit_searchWindow = new Ext.Window({
		title: 'anamnesa_penyakit Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_anamnesa_penyakit_search',
		items: anamnesa_penyakit_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!anamnesa_penyakit_searchWindow.isVisible()){
			anamnesa_penyakit_searchWindow.show();
		} else {
			anamnesa_penyakit_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function anamnesa_penyakit_print(){
		var searchquery = "";
		var anam_cust_print=null;
		var anam_tanggal_print_date="";
		var anam_penyakit_print=null;
		var anam_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(anamnesa_penyakit_DataStore.baseParams.query!==null){searchquery = anamnesa_penyakit_DataStore.baseParams.query;}
		if(anamnesa_penyakit_DataStore.baseParams.anam_cust!==null){anam_cust_print = anamnesa_penyakit_DataStore.baseParams.anam_cust;}
		if(anamnesa_penyakit_DataStore.baseParams.anam_tanggal!==""){anam_tanggal_print_date = anamnesa_penyakit_DataStore.baseParams.anam_tanggal;}
		if(anamnesa_penyakit_DataStore.baseParams.anam_penyakit!==null){anam_penyakit_print = anamnesa_penyakit_DataStore.baseParams.anam_penyakit;}
		if(anamnesa_penyakit_DataStore.baseParams.anam_keterangan!==null){anam_keterangan_print = anamnesa_penyakit_DataStore.baseParams.anam_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_anamnesa_penyakit&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			anam_cust : anam_cust_print,
		  	anam_tanggal : anam_tanggal_print_date, 
			anam_penyakit : anam_penyakit_print,
			anam_keterangan : anam_keterangan_print,
		  	currentlisting: anamnesa_penyakit_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./anamnesa_penyakitlist.html','anamnesa_penyakitlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function anamnesa_penyakit_export_excel(){
		var searchquery = "";
		var anam_cust_2excel=null;
		var anam_tanggal_2excel_date="";
		var anam_penyakit_2excel=null;
		var anam_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(anamnesa_penyakit_DataStore.baseParams.query!==null){searchquery = anamnesa_penyakit_DataStore.baseParams.query;}
		if(anamnesa_penyakit_DataStore.baseParams.anam_cust!==null){anam_cust_2excel = anamnesa_penyakit_DataStore.baseParams.anam_cust;}
		if(anamnesa_penyakit_DataStore.baseParams.anam_tanggal!==""){anam_tanggal_2excel_date = anamnesa_penyakit_DataStore.baseParams.anam_tanggal;}
		if(anamnesa_penyakit_DataStore.baseParams.anam_penyakit!==null){anam_penyakit_2excel = anamnesa_penyakit_DataStore.baseParams.anam_penyakit;}
		if(anamnesa_penyakit_DataStore.baseParams.anam_keterangan!==null){anam_keterangan_2excel = anamnesa_penyakit_DataStore.baseParams.anam_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_anamnesa_penyakit&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			anam_cust : anam_cust_2excel,
		  	anam_tanggal : anam_tanggal_2excel_date, 
			anam_penyakit : anam_penyakit_2excel,
			anam_keterangan : anam_keterangan_2excel,
		  	currentlisting: anamnesa_penyakit_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_anamnesa_penyakit"></div>
		<div id="elwindow_anamnesa_penyakit_create"></div>
        <div id="elwindow_anamnesa_penyakit_search"></div>
    </div>
</div>
</body>