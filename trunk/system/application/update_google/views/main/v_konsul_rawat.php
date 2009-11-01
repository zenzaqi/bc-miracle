<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: konsul_rawat View
	+ Description	: For record view
	+ Filename 		: v_konsul_rawat.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 01:12:06
	
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
var konsul_rawat_DataStore;
var konsul_rawat_ColumnModel;
var konsul_rawatListEditorGrid;
var konsul_rawat_createForm;
var konsul_rawat_createWindow;
var konsul_rawat_searchForm;
var konsul_rawat_searchWindow;
var konsul_rawat_SelectedRow;
var konsul_rawat_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var krawat_konsulField;
var krawat_namaField;
var krawat_jumlahField;
var krawat_konsulSearchField;
var krawat_namaSearchField;
var krawat_jumlahSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function konsul_rawat_update(oGrid_event){
	var krawat_konsul_update_pk="";
	var krawat_nama_update_pk="";
	var krawat_jumlah_update=null;

	krawat_konsul_update_pk = get_pk_id();
	krawat_nama_update_pk = get_pk_id();
	if(oGrid_event.record.data.krawat_jumlah!== ""){krawat_jumlah_update = oGrid_event.record.data.krawat_jumlah;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_konsul_rawat&m=get_action',
			params: {
				task: "UPDATE",
				krawat_konsul	: get_pk_id(),				krawat_nama	: get_pk_id(),				krawat_jumlah	:krawat_jumlah_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						konsul_rawat_DataStore.commitChanges();
						konsul_rawat_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the konsul_rawat.',
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
	function konsul_rawat_create(){
		if(is_konsul_rawat_form_valid()){
		
		var krawat_konsul_create=null;
		var krawat_nama_create=null;
		var krawat_jumlah_create=null;

		if(krawat_konsulField.getValue()!== null){krawat_konsul_create = krawat_konsulField.getValue();}
		if(krawat_namaField.getValue()!== null){krawat_nama_create = krawat_namaField.getValue();}
		if(krawat_jumlahField.getValue()!== null){krawat_jumlah_create = krawat_jumlahField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_konsul_rawat&m=get_action',
				params: {
					task: post2db,
					krawat_konsul	: krawat_konsul_create_pk,	
					krawat_nama	: krawat_nama_create_pk,	
					krawat_jumlah	: krawat_jumlah_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Konsul_rawat was '+msg+' successfully.');
							konsul_rawat_DataStore.reload();
							konsul_rawat_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Konsul_rawat.',
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
			return konsul_rawatListEditorGrid.getSelectionModel().getSelected().get('krawat_konsul,krawat_nama');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function konsul_rawat_reset_form(){
		krawat_jumlahField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function konsul_rawat_set_form(){
		krawat_konsulField.setValue(konsul_rawatListEditorGrid.getSelectionModel().getSelected().get('krawat_konsul'));
		krawat_namaField.setValue(konsul_rawatListEditorGrid.getSelectionModel().getSelected().get('krawat_nama'));
		krawat_jumlahField.setValue(konsul_rawatListEditorGrid.getSelectionModel().getSelected().get('krawat_jumlah'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_konsul_rawat_form_valid(){
		return (krawat_konsulField.isValid() && krawat_namaField.isValid() && true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!konsul_rawat_createWindow.isVisible()){
			konsul_rawat_reset_form();
			post2db='CREATE';
			msg='created';
			konsul_rawat_createWindow.show();
		} else {
			konsul_rawat_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function konsul_rawat_confirm_delete(){
		// only one konsul_rawat is selected here
		if(konsul_rawatListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', konsul_rawat_delete);
		} else if(konsul_rawatListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', konsul_rawat_delete);
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
	function konsul_rawat_confirm_update(){
		/* only one record is selected here */
		if(konsul_rawatListEditorGrid.selModel.getCount() == 1) {
			konsul_rawat_set_form();
			post2db='UPDATE';
			msg='updated';
			konsul_rawat_createWindow.show();
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
	function konsul_rawat_delete(btn){
		if(btn=='yes'){
			var selections = konsul_rawatListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< konsul_rawatListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.krawat_konsul,krawat_nama);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_konsul_rawat&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							konsul_rawat_DataStore.reload();
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
	konsul_rawat_DataStore = new Ext.data.Store({
		id: 'konsul_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_konsul_rawat&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'krawat_konsul,krawat_nama'
		},[
		/* dataIndex => insert intokonsul_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'krawat_konsul', type: 'int', mapping: 'krawat_konsul'},
			{name: 'krawat_nama', type: 'int', mapping: 'krawat_nama'},
			{name: 'krawat_jumlah', type: 'int', mapping: 'krawat_jumlah'}
		]),
		sortInfo:{field: 'krawat_konsul,krawat_nama', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	konsul_rawat_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'krawat_konsul,krawat_nama',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Krawat Jumlah',
			dataIndex: 'krawat_jumlah',
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
	konsul_rawat_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	konsul_rawatListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'konsul_rawatListEditorGrid',
		el: 'fp_konsul_rawat',
		title: 'List Of Konsul_rawat',
		autoHeight: true,
		store: konsul_rawat_DataStore, // DataStore
		cm: konsul_rawat_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 600,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: konsul_rawat_DataStore,
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
			handler: konsul_rawat_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: konsul_rawat_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: konsul_rawat_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: konsul_rawat_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: konsul_rawat_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: konsul_rawat_print  
		}
		]
	});
	konsul_rawatListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	konsul_rawat_ContextMenu = new Ext.menu.Menu({
		id: 'konsul_rawat_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: konsul_rawat_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: konsul_rawat_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: konsul_rawat_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: konsul_rawat_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onkonsul_rawat_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		konsul_rawat_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		konsul_rawat_SelectedRow=rowIndex;
		konsul_rawat_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function konsul_rawat_editContextMenu(){
      konsul_rawatListEditorGrid.startEditing(konsul_rawat_SelectedRow,1);
  	}
	/* End of Function */
  	
	konsul_rawatListEditorGrid.addListener('rowcontextmenu', onkonsul_rawat_ListEditGridContextMenu);
	konsul_rawat_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	konsul_rawatListEditorGrid.on('afteredit', konsul_rawat_update); // inLine Editing Record
	
	/* Identify  krawat_konsul Field */
	krawat_konsulField= new Ext.form.NumberField({
		id: 'krawat_konsulField',
		fieldLabel: 'Krawat Konsul',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  krawat_nama Field */
	krawat_namaField= new Ext.form.NumberField({
		id: 'krawat_namaField',
		fieldLabel: 'Krawat Nama',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  krawat_jumlah Field */
	krawat_jumlahField= new Ext.form.NumberField({
		id: 'krawat_jumlahField',
		fieldLabel: 'Krawat Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	konsul_rawat_createForm = new Ext.FormPanel({
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
				items: [krawat_konsulFieldkrawat_namaField, krawat_jumlahField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: konsul_rawat_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					konsul_rawat_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	konsul_rawat_createWindow= new Ext.Window({
		id: 'konsul_rawat_createWindow',
		title: post2db+'Konsul_rawat',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_konsul_rawat_create',
		items: konsul_rawat_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function konsul_rawat_list_search(){
		// render according to a SQL date format.
		var krawat_konsul_search=null;
		var krawat_nama_search=null;
		var krawat_jumlah_search=null;

		if(krawat_konsulSearchField.getValue()!==null){krawat_konsul_search=krawat_konsulSearchField.getValue();}
		if(krawat_namaSearchField.getValue()!==null){krawat_nama_search=krawat_namaSearchField.getValue();}
		if(krawat_jumlahSearchField.getValue()!==null){krawat_jumlah_search=krawat_jumlahSearchField.getValue();}
		// change the store parameters
		konsul_rawat_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			krawat_konsul	:	krawat_konsul_search, 
			krawat_nama	:	krawat_nama_search, 
			krawat_jumlah	:	krawat_jumlah_search 
};
		// Cause the datastore to do another query : 
		konsul_rawat_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function konsul_rawat_reset_search(){
		// reset the store parameters
		konsul_rawat_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		konsul_rawat_DataStore.reload({params: {start: 0, limit: pageS}});
		konsul_rawat_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  krawat_konsul Search Field */
	krawat_konsulSearchField= new Ext.form.NumberField({
		id: 'krawat_konsulSearchField',
		fieldLabel: 'Krawat Konsul',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  krawat_nama Search Field */
	krawat_namaSearchField= new Ext.form.NumberField({
		id: 'krawat_namaSearchField',
		fieldLabel: 'Krawat Nama',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  krawat_jumlah Search Field */
	krawat_jumlahSearchField= new Ext.form.NumberField({
		id: 'krawat_jumlahSearchField',
		fieldLabel: 'Krawat Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	konsul_rawat_searchForm = new Ext.FormPanel({
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
				items: [krawat_konsulSearchFieldkrawat_namaSearchField, krawat_jumlahSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: konsul_rawat_list_search
			},{
				text: 'Close',
				handler: function(){
					konsul_rawat_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	konsul_rawat_searchWindow = new Ext.Window({
		title: 'konsul_rawat Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_konsul_rawat_search',
		items: konsul_rawat_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!konsul_rawat_searchWindow.isVisible()){
			konsul_rawat_searchWindow.show();
		} else {
			konsul_rawat_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function konsul_rawat_print(){
		var searchquery = "";
		var krawat_konsul_print=null;
		var krawat_nama_print=null;
		var krawat_jumlah_print=null;
		var win;              
		// check if we do have some search data...
		if(konsul_rawat_DataStore.baseParams.query!==null){searchquery = konsul_rawat_DataStore.baseParams.query;}
		if(konsul_rawat_DataStore.baseParams.krawat_konsul!==null){krawat_konsul_print = konsul_rawat_DataStore.baseParams.krawat_konsul;}
		if(konsul_rawat_DataStore.baseParams.krawat_nama!==null){krawat_nama_print = konsul_rawat_DataStore.baseParams.krawat_nama;}
		if(konsul_rawat_DataStore.baseParams.krawat_jumlah!==null){krawat_jumlah_print = konsul_rawat_DataStore.baseParams.krawat_jumlah;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_konsul_rawat&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			krawat_konsul : krawat_konsul_print,
			krawat_nama : krawat_nama_print,
			krawat_jumlah : krawat_jumlah_print,
		  	currentlisting: konsul_rawat_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./konsul_rawatlist.html','konsul_rawatlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function konsul_rawat_export_excel(){
		var searchquery = "";
		var krawat_konsul_2excel=null;
		var krawat_nama_2excel=null;
		var krawat_jumlah_2excel=null;
		var win;              
		// check if we do have some search data...
		if(konsul_rawat_DataStore.baseParams.query!==null){searchquery = konsul_rawat_DataStore.baseParams.query;}
		if(konsul_rawat_DataStore.baseParams.krawat_konsul!==null){krawat_konsul_2excel = konsul_rawat_DataStore.baseParams.krawat_konsul;}
		if(konsul_rawat_DataStore.baseParams.krawat_nama!==null){krawat_nama_2excel = konsul_rawat_DataStore.baseParams.krawat_nama;}
		if(konsul_rawat_DataStore.baseParams.krawat_jumlah!==null){krawat_jumlah_2excel = konsul_rawat_DataStore.baseParams.krawat_jumlah;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_konsul_rawat&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			krawat_konsul : krawat_konsul_2excel,
			krawat_nama : krawat_nama_2excel,
			krawat_jumlah : krawat_jumlah_2excel,
		  	currentlisting: konsul_rawat_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_konsul_rawat"></div>
		<div id="elwindow_konsul_rawat_create"></div>
        <div id="elwindow_konsul_rawat_search"></div>
    </div>
</div>
</body>