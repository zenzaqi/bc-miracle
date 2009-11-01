<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: satuan_konversi View
	+ Description	: For record view
	+ Filename 		: v_satuan_konversi.php
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
var satuan_konversi_DataStore;
var satuan_konversi_ColumnModel;
var satuan_konversiListEditorGrid;
var satuan_konversi_createForm;
var satuan_konversi_createWindow;
var satuan_konversi_searchForm;
var satuan_konversi_searchWindow;
var satuan_konversi_SelectedRow;
var satuan_konversi_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var konversi_satuanField;
var konversi_produkField;
var konversi_nilaiField;
var konversi_satuanSearchField;
var konversi_produkSearchField;
var konversi_nilaiSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function satuan_konversi_update(oGrid_event){
	var konversi_satuan_update_pk="";
	var konversi_produk_update_pk="";
	var konversi_nilai_update=null;

	konversi_satuan_update_pk = get_pk_id();
	konversi_produk_update_pk = get_pk_id();
	if(oGrid_event.record.data.konversi_nilai!== null){konversi_nilai_update = oGrid_event.record.data.konversi_nilai;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_satuan_konversi&m=get_action',
			params: {
				task: "UPDATE",
				konversi_satuan	: get_pk_id(),				konversi_produk	: get_pk_id(),				konversi_nilai	:konversi_nilai_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						satuan_konversi_DataStore.commitChanges();
						satuan_konversi_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the satuan_konversi.',
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
	function satuan_konversi_create(){
		if(is_satuan_konversi_form_valid()){
		
		var konversi_satuan_create=null;
		var konversi_produk_create=null;
		var konversi_nilai_create=null;

		if(konversi_satuanField.getValue()!== null){konversi_satuan_create = konversi_satuanField.getValue();}
		if(konversi_produkField.getValue()!== null){konversi_produk_create = konversi_produkField.getValue();}
		if(konversi_nilaiField.getValue()!== null){konversi_nilai_create = konversi_nilaiField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_satuan_konversi&m=get_action',
				params: {
					task: post2db,
					konversi_satuan	: konversi_satuan_create_pk,	
					konversi_produk	: konversi_produk_create_pk,	
					konversi_nilai	: konversi_nilai_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Satuan_konversi was '+msg+' successfully.');
							satuan_konversi_DataStore.reload();
							satuan_konversi_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Satuan_konversi.',
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
			return satuan_konversiListEditorGrid.getSelectionModel().getSelected().get('konversi_satuan,konversi_produk');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function satuan_konversi_reset_form(){
		konversi_nilaiField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function satuan_konversi_set_form(){
		konversi_satuanField.setValue(satuan_konversiListEditorGrid.getSelectionModel().getSelected().get('konversi_satuan'));
		konversi_produkField.setValue(satuan_konversiListEditorGrid.getSelectionModel().getSelected().get('konversi_produk'));
		konversi_nilaiField.setValue(satuan_konversiListEditorGrid.getSelectionModel().getSelected().get('konversi_nilai'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_satuan_konversi_form_valid(){
		return (konversi_satuanField.isValid() && konversi_produkField.isValid() && true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!satuan_konversi_createWindow.isVisible()){
			satuan_konversi_reset_form();
			post2db='CREATE';
			msg='created';
			satuan_konversi_createWindow.show();
		} else {
			satuan_konversi_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function satuan_konversi_confirm_delete(){
		// only one satuan_konversi is selected here
		if(satuan_konversiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', satuan_konversi_delete);
		} else if(satuan_konversiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', satuan_konversi_delete);
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
	function satuan_konversi_confirm_update(){
		/* only one record is selected here */
		if(satuan_konversiListEditorGrid.selModel.getCount() == 1) {
			satuan_konversi_set_form();
			post2db='UPDATE';
			msg='updated';
			satuan_konversi_createWindow.show();
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
	function satuan_konversi_delete(btn){
		if(btn=='yes'){
			var selections = satuan_konversiListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< satuan_konversiListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.konversi_satuan,konversi_produk);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_satuan_konversi&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							satuan_konversi_DataStore.reload();
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
	satuan_konversi_DataStore = new Ext.data.Store({
		id: 'satuan_konversi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_satuan_konversi&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'konversi_satuan,konversi_produk'
		},[
		/* dataIndex => insert intosatuan_konversi_ColumnModel, Mapping => for initiate table column */ 
			{name: 'konversi_satuan', type: 'int', mapping: 'konversi_satuan'},
			{name: 'konversi_produk', type: 'int', mapping: 'konversi_produk'},
			{name: 'konversi_nilai', type: 'float', mapping: 'konversi_nilai'}
		]),
		sortInfo:{field: 'konversi_satuan,konversi_produk', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	satuan_konversi_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'konversi_satuan,konversi_produk',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Konversi Nilai',
			dataIndex: 'konversi_nilai',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 12,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	satuan_konversi_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	satuan_konversiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'satuan_konversiListEditorGrid',
		el: 'fp_satuan_konversi',
		title: 'List Of Satuan_konversi',
		autoHeight: true,
		store: satuan_konversi_DataStore, // DataStore
		cm: satuan_konversi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: satuan_konversi_DataStore,
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
			handler: satuan_konversi_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: satuan_konversi_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: satuan_konversi_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: satuan_konversi_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: satuan_konversi_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: satuan_konversi_print  
		}
		]
	});
	satuan_konversiListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	satuan_konversi_ContextMenu = new Ext.menu.Menu({
		id: 'satuan_konversi_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: satuan_konversi_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: satuan_konversi_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: satuan_konversi_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: satuan_konversi_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onsatuan_konversi_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		satuan_konversi_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		satuan_konversi_SelectedRow=rowIndex;
		satuan_konversi_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function satuan_konversi_editContextMenu(){
      satuan_konversiListEditorGrid.startEditing(satuan_konversi_SelectedRow,1);
  	}
	/* End of Function */
  	
	satuan_konversiListEditorGrid.addListener('rowcontextmenu', onsatuan_konversi_ListEditGridContextMenu);
	satuan_konversi_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	satuan_konversiListEditorGrid.on('afteredit', satuan_konversi_update); // inLine Editing Record
	
	/* Identify  konversi_satuan Field */
	konversi_satuanField= new Ext.form.NumberField({
		id: 'konversi_satuanField',
		fieldLabel: 'Konversi Satuan',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  konversi_produk Field */
	konversi_produkField= new Ext.form.NumberField({
		id: 'konversi_produkField',
		fieldLabel: 'Konversi Produk',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  konversi_nilai Field */
	konversi_nilaiField= new Ext.form.NumberField({
		id: 'konversi_nilaiField',
		fieldLabel: 'Konversi Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	satuan_konversi_createForm = new Ext.FormPanel({
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
				items: [konversi_satuanFieldkonversi_produkField, konversi_nilaiField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: satuan_konversi_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					satuan_konversi_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	satuan_konversi_createWindow= new Ext.Window({
		id: 'satuan_konversi_createWindow',
		title: post2db+'Satuan_konversi',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_satuan_konversi_create',
		items: satuan_konversi_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function satuan_konversi_list_search(){
		// render according to a SQL date format.
		var konversi_satuan_search=null;
		var konversi_produk_search=null;
		var konversi_nilai_search=null;

		if(konversi_satuanSearchField.getValue()!==null){konversi_satuan_search=konversi_satuanSearchField.getValue();}
		if(konversi_produkSearchField.getValue()!==null){konversi_produk_search=konversi_produkSearchField.getValue();}
		if(konversi_nilaiSearchField.getValue()!==null){konversi_nilai_search=konversi_nilaiSearchField.getValue();}
		// change the store parameters
		satuan_konversi_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			konversi_satuan	:	konversi_satuan_search, 
			konversi_produk	:	konversi_produk_search, 
			konversi_nilai	:	konversi_nilai_search 
};
		// Cause the datastore to do another query : 
		satuan_konversi_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function satuan_konversi_reset_search(){
		// reset the store parameters
		satuan_konversi_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		satuan_konversi_DataStore.reload({params: {start: 0, limit: pageS}});
		satuan_konversi_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  konversi_satuan Search Field */
	konversi_satuanSearchField= new Ext.form.NumberField({
		id: 'konversi_satuanSearchField',
		fieldLabel: 'Konversi Satuan',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  konversi_produk Search Field */
	konversi_produkSearchField= new Ext.form.NumberField({
		id: 'konversi_produkSearchField',
		fieldLabel: 'Konversi Produk',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  konversi_nilai Search Field */
	konversi_nilaiSearchField= new Ext.form.NumberField({
		id: 'konversi_nilaiSearchField',
		fieldLabel: 'Konversi Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	satuan_konversi_searchForm = new Ext.FormPanel({
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
				items: [konversi_satuanSearchFieldkonversi_produkSearchField, konversi_nilaiSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: satuan_konversi_list_search
			},{
				text: 'Close',
				handler: function(){
					satuan_konversi_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	satuan_konversi_searchWindow = new Ext.Window({
		title: 'satuan_konversi Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_satuan_konversi_search',
		items: satuan_konversi_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!satuan_konversi_searchWindow.isVisible()){
			satuan_konversi_searchWindow.show();
		} else {
			satuan_konversi_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function satuan_konversi_print(){
		var searchquery = "";
		var konversi_satuan_print=null;
		var konversi_produk_print=null;
		var konversi_nilai_print=null;
		var win;              
		// check if we do have some search data...
		if(satuan_konversi_DataStore.baseParams.query!==null){searchquery = satuan_konversi_DataStore.baseParams.query;}
		if(satuan_konversi_DataStore.baseParams.konversi_satuan!==null){konversi_satuan_print = satuan_konversi_DataStore.baseParams.konversi_satuan;}
		if(satuan_konversi_DataStore.baseParams.konversi_produk!==null){konversi_produk_print = satuan_konversi_DataStore.baseParams.konversi_produk;}
		if(satuan_konversi_DataStore.baseParams.konversi_nilai!==null){konversi_nilai_print = satuan_konversi_DataStore.baseParams.konversi_nilai;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_satuan_konversi&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			konversi_satuan : konversi_satuan_print,
			konversi_produk : konversi_produk_print,
			konversi_nilai : konversi_nilai_print,
		  	currentlisting: satuan_konversi_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./satuan_konversilist.html','satuan_konversilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function satuan_konversi_export_excel(){
		var searchquery = "";
		var konversi_satuan_2excel=null;
		var konversi_produk_2excel=null;
		var konversi_nilai_2excel=null;
		var win;              
		// check if we do have some search data...
		if(satuan_konversi_DataStore.baseParams.query!==null){searchquery = satuan_konversi_DataStore.baseParams.query;}
		if(satuan_konversi_DataStore.baseParams.konversi_satuan!==null){konversi_satuan_2excel = satuan_konversi_DataStore.baseParams.konversi_satuan;}
		if(satuan_konversi_DataStore.baseParams.konversi_produk!==null){konversi_produk_2excel = satuan_konversi_DataStore.baseParams.konversi_produk;}
		if(satuan_konversi_DataStore.baseParams.konversi_nilai!==null){konversi_nilai_2excel = satuan_konversi_DataStore.baseParams.konversi_nilai;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_satuan_konversi&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			konversi_satuan : konversi_satuan_2excel,
			konversi_produk : konversi_produk_2excel,
			konversi_nilai : konversi_nilai_2excel,
		  	currentlisting: satuan_konversi_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_satuan_konversi"></div>
		<div id="elwindow_satuan_konversi_create"></div>
        <div id="elwindow_satuan_konversi_search"></div>
    </div>
</div>
</body>