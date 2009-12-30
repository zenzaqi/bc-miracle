<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: perawatan_alat View
	+ Description	: For record view
	+ Filename 		: v_perawatan_alat.php
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
var perawatan_alat_DataStore;
var perawatan_alat_ColumnModel;
var perawatan_alatListEditorGrid;
var perawatan_alat_createForm;
var perawatan_alat_createWindow;
var perawatan_alat_searchForm;
var perawatan_alat_searchWindow;
var perawatan_alat_SelectedRow;
var perawatan_alat_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var aperawatan_noField;
var aperawatan_alatField;
var aperawatan_jumlahField;
var aperawatan_noSearchField;
var aperawatan_alatSearchField;
var aperawatan_jumlahSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function perawatan_alat_update(oGrid_event){
	var aperawatan_no_update_pk="";
	var aperawatan_alat_update_pk="";
	var aperawatan_jumlah_update=null;

	aperawatan_no_update_pk = get_pk_id();
	aperawatan_alat_update_pk = get_pk_id();
	if(oGrid_event.record.data.aperawatan_jumlah!== null){aperawatan_jumlah_update = oGrid_event.record.data.aperawatan_jumlah;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_perawatan_alat&m=get_action',
			params: {
				task: "UPDATE",
				aperawatan_no	: get_pk_id(),				aperawatan_alat	: get_pk_id(),				aperawatan_jumlah	:aperawatan_jumlah_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						perawatan_alat_DataStore.commitChanges();
						perawatan_alat_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the perawatan_alat.',
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
	function perawatan_alat_create(){
		if(is_perawatan_alat_form_valid()){
		
		var aperawatan_no_create=null;
		var aperawatan_alat_create=null;
		var aperawatan_jumlah_create=null;

		if(aperawatan_noField.getValue()!== null){aperawatan_no_create = aperawatan_noField.getValue();}
		if(aperawatan_alatField.getValue()!== null){aperawatan_alat_create = aperawatan_alatField.getValue();}
		if(aperawatan_jumlahField.getValue()!== null){aperawatan_jumlah_create = aperawatan_jumlahField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_perawatan_alat&m=get_action',
				params: {
					task: post2db,
					aperawatan_no	: aperawatan_no_create_pk,	
					aperawatan_alat	: aperawatan_alat_create_pk,	
					aperawatan_jumlah	: aperawatan_jumlah_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Perawatan_alat was '+msg+' successfully.');
							perawatan_alat_DataStore.reload();
							perawatan_alat_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Perawatan_alat.',
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
			return perawatan_alatListEditorGrid.getSelectionModel().getSelected().get('aperawatan_no,aperawatan_alat');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function perawatan_alat_reset_form(){
		aperawatan_jumlahField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function perawatan_alat_set_form(){
		aperawatan_noField.setValue(perawatan_alatListEditorGrid.getSelectionModel().getSelected().get('aperawatan_no'));
		aperawatan_alatField.setValue(perawatan_alatListEditorGrid.getSelectionModel().getSelected().get('aperawatan_alat'));
		aperawatan_jumlahField.setValue(perawatan_alatListEditorGrid.getSelectionModel().getSelected().get('aperawatan_jumlah'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_perawatan_alat_form_valid(){
		return (aperawatan_noField.isValid() && aperawatan_alatField.isValid() && true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!perawatan_alat_createWindow.isVisible()){
			perawatan_alat_reset_form();
			post2db='CREATE';
			msg='created';
			perawatan_alat_createWindow.show();
		} else {
			perawatan_alat_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function perawatan_alat_confirm_delete(){
		// only one perawatan_alat is selected here
		if(perawatan_alatListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', perawatan_alat_delete);
		} else if(perawatan_alatListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', perawatan_alat_delete);
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
	function perawatan_alat_confirm_update(){
		/* only one record is selected here */
		if(perawatan_alatListEditorGrid.selModel.getCount() == 1) {
			perawatan_alat_set_form();
			post2db='UPDATE';
			msg='updated';
			perawatan_alat_createWindow.show();
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
	function perawatan_alat_delete(btn){
		if(btn=='yes'){
			var selections = perawatan_alatListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< perawatan_alatListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.aperawatan_no,aperawatan_alat);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_perawatan_alat&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							perawatan_alat_DataStore.reload();
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
	perawatan_alat_DataStore = new Ext.data.Store({
		id: 'perawatan_alat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan_alat&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'aperawatan_no,aperawatan_alat'
		},[
		/* dataIndex => insert intoperawatan_alat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'aperawatan_no', type: 'int', mapping: 'aperawatan_no'},
			{name: 'aperawatan_alat', type: 'int', mapping: 'aperawatan_alat'},
			{name: 'aperawatan_jumlah', type: 'int', mapping: 'aperawatan_jumlah'}
		]),
		sortInfo:{field: 'aperawatan_no,aperawatan_alat', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	perawatan_alat_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'aperawatan_no,aperawatan_alat',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Aperawatan Jumlah',
			dataIndex: 'aperawatan_jumlah',
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
	perawatan_alat_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	perawatan_alatListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'perawatan_alatListEditorGrid',
		el: 'fp_perawatan_alat',
		title: 'List Of Perawatan_alat',
		autoHeight: true,
		store: perawatan_alat_DataStore, // DataStore
		cm: perawatan_alat_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: perawatan_alat_DataStore,
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
			handler: perawatan_alat_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: perawatan_alat_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: perawatan_alat_DataStore,
			baseParams: {task:'LIST',start: 0, limit: pageS},
			listeners:{
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- Nama'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: perawatan_alat_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: perawatan_alat_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: perawatan_alat_print  
		}
		]
	});
	perawatan_alatListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	perawatan_alat_ContextMenu = new Ext.menu.Menu({
		id: 'perawatan_alat_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: perawatan_alat_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: perawatan_alat_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: perawatan_alat_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: perawatan_alat_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onperawatan_alat_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		perawatan_alat_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		perawatan_alat_SelectedRow=rowIndex;
		perawatan_alat_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function perawatan_alat_editContextMenu(){
      perawatan_alatListEditorGrid.startEditing(perawatan_alat_SelectedRow,1);
  	}
	/* End of Function */
  	
	perawatan_alatListEditorGrid.addListener('rowcontextmenu', onperawatan_alat_ListEditGridContextMenu);
	perawatan_alat_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	perawatan_alatListEditorGrid.on('afteredit', perawatan_alat_update); // inLine Editing Record
	
	/* Identify  aperawatan_no Field */
	aperawatan_noField= new Ext.form.NumberField({
		id: 'aperawatan_noField',
		fieldLabel: 'Aperawatan No',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  aperawatan_alat Field */
	aperawatan_alatField= new Ext.form.NumberField({
		id: 'aperawatan_alatField',
		fieldLabel: 'Aperawatan Alat',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  aperawatan_jumlah Field */
	aperawatan_jumlahField= new Ext.form.NumberField({
		id: 'aperawatan_jumlahField',
		fieldLabel: 'Aperawatan Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	perawatan_alat_createForm = new Ext.FormPanel({
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
				items: [aperawatan_noFieldaperawatan_alatField, aperawatan_jumlahField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: perawatan_alat_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					perawatan_alat_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	perawatan_alat_createWindow= new Ext.Window({
		id: 'perawatan_alat_createWindow',
		title: post2db+'Perawatan_alat',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_perawatan_alat_create',
		items: perawatan_alat_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function perawatan_alat_list_search(){
		// render according to a SQL date format.
		var aperawatan_no_search=null;
		var aperawatan_alat_search=null;
		var aperawatan_jumlah_search=null;

		if(aperawatan_noSearchField.getValue()!==null){aperawatan_no_search=aperawatan_noSearchField.getValue();}
		if(aperawatan_alatSearchField.getValue()!==null){aperawatan_alat_search=aperawatan_alatSearchField.getValue();}
		if(aperawatan_jumlahSearchField.getValue()!==null){aperawatan_jumlah_search=aperawatan_jumlahSearchField.getValue();}
		// change the store parameters
		perawatan_alat_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			aperawatan_no	:	aperawatan_no_search, 
			aperawatan_alat	:	aperawatan_alat_search, 
			aperawatan_jumlah	:	aperawatan_jumlah_search 
};
		// Cause the datastore to do another query : 
		perawatan_alat_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function perawatan_alat_reset_search(){
		// reset the store parameters
		perawatan_alat_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		perawatan_alat_DataStore.reload({params: {start: 0, limit: pageS}});
		perawatan_alat_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  aperawatan_no Search Field */
	aperawatan_noSearchField= new Ext.form.NumberField({
		id: 'aperawatan_noSearchField',
		fieldLabel: 'Aperawatan No',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  aperawatan_alat Search Field */
	aperawatan_alatSearchField= new Ext.form.NumberField({
		id: 'aperawatan_alatSearchField',
		fieldLabel: 'Aperawatan Alat',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  aperawatan_jumlah Search Field */
	aperawatan_jumlahSearchField= new Ext.form.NumberField({
		id: 'aperawatan_jumlahSearchField',
		fieldLabel: 'Aperawatan Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	perawatan_alat_searchForm = new Ext.FormPanel({
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
				items: [aperawatan_noSearchFieldaperawatan_alatSearchField, aperawatan_jumlahSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: perawatan_alat_list_search
			},{
				text: 'Close',
				handler: function(){
					perawatan_alat_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	perawatan_alat_searchWindow = new Ext.Window({
		title: 'perawatan_alat Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_perawatan_alat_search',
		items: perawatan_alat_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!perawatan_alat_searchWindow.isVisible()){
			perawatan_alat_searchWindow.show();
		} else {
			perawatan_alat_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function perawatan_alat_print(){
		var searchquery = "";
		var aperawatan_no_print=null;
		var aperawatan_alat_print=null;
		var aperawatan_jumlah_print=null;
		var win;              
		// check if we do have some search data...
		if(perawatan_alat_DataStore.baseParams.query!==null){searchquery = perawatan_alat_DataStore.baseParams.query;}
		if(perawatan_alat_DataStore.baseParams.aperawatan_no!==null){aperawatan_no_print = perawatan_alat_DataStore.baseParams.aperawatan_no;}
		if(perawatan_alat_DataStore.baseParams.aperawatan_alat!==null){aperawatan_alat_print = perawatan_alat_DataStore.baseParams.aperawatan_alat;}
		if(perawatan_alat_DataStore.baseParams.aperawatan_jumlah!==null){aperawatan_jumlah_print = perawatan_alat_DataStore.baseParams.aperawatan_jumlah;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_perawatan_alat&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			aperawatan_no : aperawatan_no_print,
			aperawatan_alat : aperawatan_alat_print,
			aperawatan_jumlah : aperawatan_jumlah_print,
		  	currentlisting: perawatan_alat_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./perawatan_alatlist.html','perawatan_alatlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function perawatan_alat_export_excel(){
		var searchquery = "";
		var aperawatan_no_2excel=null;
		var aperawatan_alat_2excel=null;
		var aperawatan_jumlah_2excel=null;
		var win;              
		// check if we do have some search data...
		if(perawatan_alat_DataStore.baseParams.query!==null){searchquery = perawatan_alat_DataStore.baseParams.query;}
		if(perawatan_alat_DataStore.baseParams.aperawatan_no!==null){aperawatan_no_2excel = perawatan_alat_DataStore.baseParams.aperawatan_no;}
		if(perawatan_alat_DataStore.baseParams.aperawatan_alat!==null){aperawatan_alat_2excel = perawatan_alat_DataStore.baseParams.aperawatan_alat;}
		if(perawatan_alat_DataStore.baseParams.aperawatan_jumlah!==null){aperawatan_jumlah_2excel = perawatan_alat_DataStore.baseParams.aperawatan_jumlah;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_perawatan_alat&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			aperawatan_no : aperawatan_no_2excel,
			aperawatan_alat : aperawatan_alat_2excel,
			aperawatan_jumlah : aperawatan_jumlah_2excel,
		  	currentlisting: perawatan_alat_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_perawatan_alat"></div>
		<div id="elwindow_perawatan_alat_create"></div>
        <div id="elwindow_perawatan_alat_search"></div>
    </div>
</div>
</body>