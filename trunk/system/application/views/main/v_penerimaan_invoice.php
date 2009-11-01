<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: penerimaan_invoice View
	+ Description	: For record view
	+ Filename 		: v_penerimaan_invoice.php
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
var penerimaan_invoice_DataStore;
var penerimaan_invoice_ColumnModel;
var penerimaan_invoiceListEditorGrid;
var penerimaan_invoice_createForm;
var penerimaan_invoice_createWindow;
var penerimaan_invoice_searchForm;
var penerimaan_invoice_searchWindow;
var penerimaan_invoice_SelectedRow;
var penerimaan_invoice_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var invoice_idField;
var invoice_noField;
var invoice_supplierField;
var invoice_noorderField;
var invoice_tanggalField;
var invoice_nilaiField;
var invoice_idSearchField;
var invoice_noSearchField;
var invoice_supplierSearchField;
var invoice_noorderSearchField;
var invoice_tanggalSearchField;
var invoice_nilaiSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function penerimaan_invoice_update(oGrid_event){
	var invoice_id_update_pk="";
	var invoice_no_update=null;
	var invoice_supplier_update=null;
	var invoice_noorder_update=null;
	var invoice_tanggal_update_date="";
	var invoice_nilai_update=null;

	invoice_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.invoice_no!== null){invoice_no_update = oGrid_event.record.data.invoice_no;}
	if(oGrid_event.record.data.invoice_supplier!== null){invoice_supplier_update = oGrid_event.record.data.invoice_supplier;}
	if(oGrid_event.record.data.invoice_noorder!== null){invoice_noorder_update = oGrid_event.record.data.invoice_noorder;}
	 if(oGrid_event.record.data.invoice_tanggal!== ""){invoice_tanggal_update_date = oGrid_event.record.data.invoice_tanggal.format('Y-m-d');}
	if(oGrid_event.record.data.invoice_nilai!== null){invoice_nilai_update = oGrid_event.record.data.invoice_nilai;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_penerimaan_invoice&m=get_action',
			params: {
				task: "UPDATE",
				invoice_id	: get_pk_id(),				invoice_no	:invoice_no_update,		
				invoice_supplier	:invoice_supplier_update,		
				invoice_noorder	:invoice_noorder_update,		
				invoice_tanggal	: invoice_tanggal_update_date,				invoice_nilai	:invoice_nilai_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						penerimaan_invoice_DataStore.commitChanges();
						penerimaan_invoice_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the penerimaan_invoice.',
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
	function penerimaan_invoice_create(){
		if(is_penerimaan_invoice_form_valid()){
		
		var invoice_id_create_pk=null;
		var invoice_no_create=null;
		var invoice_supplier_create=null;
		var invoice_noorder_create=null;
		var invoice_tanggal_create_date="";
		var invoice_nilai_create=null;

		invoice_id_create_pk=get_pk_id();
		if(invoice_noField.getValue()!== null){invoice_no_create = invoice_noField.getValue();}
		if(invoice_supplierField.getValue()!== null){invoice_supplier_create = invoice_supplierField.getValue();}
		if(invoice_noorderField.getValue()!== null){invoice_noorder_create = invoice_noorderField.getValue();}
		if(invoice_tanggalField.getValue()!== ""){invoice_tanggal_create_date = invoice_tanggalField.getValue().format('Y-m-d');}
		if(invoice_nilaiField.getValue()!== null){invoice_nilai_create = invoice_nilaiField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_penerimaan_invoice&m=get_action',
				params: {
					task: post2db,
					invoice_id	: invoice_id_create_pk,	
					invoice_no	: invoice_no_create,	
					invoice_supplier	: invoice_supplier_create,	
					invoice_noorder	: invoice_noorder_create,	
					invoice_tanggal	: invoice_tanggal_create_date,					invoice_nilai	: invoice_nilai_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Penerimaan_invoice was '+msg+' successfully.');
							penerimaan_invoice_DataStore.reload();
							penerimaan_invoice_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Penerimaan_invoice.',
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
			return penerimaan_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function penerimaan_invoice_reset_form(){
		invoice_noField.reset();
		invoice_supplierField.reset();
		invoice_noorderField.reset();
		invoice_tanggalField.reset();
		invoice_nilaiField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function penerimaan_invoice_set_form(){
		invoice_noField.setValue(penerimaan_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_no'));
		invoice_supplierField.setValue(penerimaan_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_supplier'));
		invoice_noorderField.setValue(penerimaan_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_noorder'));
		invoice_tanggalField.setValue(penerimaan_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_tanggal'));
		invoice_nilaiField.setValue(penerimaan_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_nilai'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_penerimaan_invoice_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!penerimaan_invoice_createWindow.isVisible()){
			penerimaan_invoice_reset_form();
			post2db='CREATE';
			msg='created';
			penerimaan_invoice_createWindow.show();
		} else {
			penerimaan_invoice_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function penerimaan_invoice_confirm_delete(){
		// only one penerimaan_invoice is selected here
		if(penerimaan_invoiceListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', penerimaan_invoice_delete);
		} else if(penerimaan_invoiceListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', penerimaan_invoice_delete);
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
	function penerimaan_invoice_confirm_update(){
		/* only one record is selected here */
		if(penerimaan_invoiceListEditorGrid.selModel.getCount() == 1) {
			penerimaan_invoice_set_form();
			post2db='UPDATE';
			msg='updated';
			penerimaan_invoice_createWindow.show();
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
	function penerimaan_invoice_delete(btn){
		if(btn=='yes'){
			var selections = penerimaan_invoiceListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< penerimaan_invoiceListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.invoice_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_penerimaan_invoice&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							penerimaan_invoice_DataStore.reload();
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
	penerimaan_invoice_DataStore = new Ext.data.Store({
		id: 'penerimaan_invoice_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_penerimaan_invoice&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'invoice_id'
		},[
		/* dataIndex => insert intopenerimaan_invoice_ColumnModel, Mapping => for initiate table column */ 
			{name: 'invoice_id', type: 'int', mapping: 'invoice_id'},
			{name: 'invoice_no', type: 'string', mapping: 'invoice_no'},
			{name: 'invoice_supplier', type: 'int', mapping: 'invoice_supplier'},
			{name: 'invoice_noorder', type: 'string', mapping: 'invoice_noorder'},
			{name: 'invoice_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'invoice_tanggal'},
			{name: 'invoice_nilai', type: 'float', mapping: 'invoice_nilai'}
		]),
		sortInfo:{field: 'invoice_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	penerimaan_invoice_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'invoice_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Invoice No',
			dataIndex: 'invoice_no',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Invoice Supplier',
			dataIndex: 'invoice_supplier',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'Invoice Noorder',
			dataIndex: 'invoice_noorder',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Invoice Tanggal',
			dataIndex: 'invoice_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Invoice Nilai',
			dataIndex: 'invoice_nilai',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	penerimaan_invoice_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	penerimaan_invoiceListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'penerimaan_invoiceListEditorGrid',
		el: 'fp_penerimaan_invoice',
		title: 'List Of Penerimaan_invoice',
		autoHeight: true,
		store: penerimaan_invoice_DataStore, // DataStore
		cm: penerimaan_invoice_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: penerimaan_invoice_DataStore,
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
			handler: penerimaan_invoice_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: penerimaan_invoice_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: penerimaan_invoice_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: penerimaan_invoice_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: penerimaan_invoice_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: penerimaan_invoice_print  
		}
		]
	});
	penerimaan_invoiceListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	penerimaan_invoice_ContextMenu = new Ext.menu.Menu({
		id: 'penerimaan_invoice_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: penerimaan_invoice_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: penerimaan_invoice_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: penerimaan_invoice_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: penerimaan_invoice_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onpenerimaan_invoice_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		penerimaan_invoice_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		penerimaan_invoice_SelectedRow=rowIndex;
		penerimaan_invoice_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function penerimaan_invoice_editContextMenu(){
      penerimaan_invoiceListEditorGrid.startEditing(penerimaan_invoice_SelectedRow,1);
  	}
	/* End of Function */
  	
	penerimaan_invoiceListEditorGrid.addListener('rowcontextmenu', onpenerimaan_invoice_ListEditGridContextMenu);
	penerimaan_invoice_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	penerimaan_invoiceListEditorGrid.on('afteredit', penerimaan_invoice_update); // inLine Editing Record
	
	/* Identify  invoice_no Field */
	invoice_noField= new Ext.form.TextField({
		id: 'invoice_noField',
		fieldLabel: 'Invoice No',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  invoice_supplier Field */
	invoice_supplierField= new Ext.form.NumberField({
		id: 'invoice_supplierField',
		fieldLabel: 'Invoice Supplier',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  invoice_noorder Field */
	invoice_noorderField= new Ext.form.TextField({
		id: 'invoice_noorderField',
		fieldLabel: 'Invoice Noorder',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  invoice_tanggal Field */
	invoice_tanggalField= new Ext.form.DateField({
		id: 'invoice_tanggalField',
		fieldLabel: 'Invoice Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  invoice_nilai Field */
	invoice_nilaiField= new Ext.form.NumberField({
		id: 'invoice_nilaiField',
		fieldLabel: 'Invoice Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	penerimaan_invoice_createForm = new Ext.FormPanel({
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
				items: [invoice_noField, invoice_supplierField, invoice_noorderField, invoice_tanggalField, invoice_nilaiField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: penerimaan_invoice_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					penerimaan_invoice_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	penerimaan_invoice_createWindow= new Ext.Window({
		id: 'penerimaan_invoice_createWindow',
		title: post2db+'Penerimaan_invoice',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_penerimaan_invoice_create',
		items: penerimaan_invoice_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function penerimaan_invoice_list_search(){
		// render according to a SQL date format.
		var invoice_id_search=null;
		var invoice_no_search=null;
		var invoice_supplier_search=null;
		var invoice_noorder_search=null;
		var invoice_tanggal_search_date="";
		var invoice_nilai_search=null;

		if(invoice_idSearchField.getValue()!==null){invoice_id_search=invoice_idSearchField.getValue();}
		if(invoice_noSearchField.getValue()!==null){invoice_no_search=invoice_noSearchField.getValue();}
		if(invoice_supplierSearchField.getValue()!==null){invoice_supplier_search=invoice_supplierSearchField.getValue();}
		if(invoice_noorderSearchField.getValue()!==null){invoice_noorder_search=invoice_noorderSearchField.getValue();}
		if(invoice_tanggalSearchField.getValue()!==""){invoice_tanggal_search_date=invoice_tanggalSearchField.getValue().format('Y-m-d');}
		if(invoice_nilaiSearchField.getValue()!==null){invoice_nilai_search=invoice_nilaiSearchField.getValue();}
		// change the store parameters
		penerimaan_invoice_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			invoice_id	:	invoice_id_search, 
			invoice_no	:	invoice_no_search, 
			invoice_supplier	:	invoice_supplier_search, 
			invoice_noorder	:	invoice_noorder_search, 
			invoice_tanggal	:	invoice_tanggal_search_date, 
			invoice_nilai	:	invoice_nilai_search 
};
		// Cause the datastore to do another query : 
		penerimaan_invoice_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function penerimaan_invoice_reset_search(){
		// reset the store parameters
		penerimaan_invoice_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		penerimaan_invoice_DataStore.reload({params: {start: 0, limit: pageS}});
		penerimaan_invoice_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  invoice_id Search Field */
	invoice_idSearchField= new Ext.form.NumberField({
		id: 'invoice_idSearchField',
		fieldLabel: 'Invoice Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  invoice_no Search Field */
	invoice_noSearchField= new Ext.form.TextField({
		id: 'invoice_noSearchField',
		fieldLabel: 'Invoice No',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  invoice_supplier Search Field */
	invoice_supplierSearchField= new Ext.form.NumberField({
		id: 'invoice_supplierSearchField',
		fieldLabel: 'Invoice Supplier',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  invoice_noorder Search Field */
	invoice_noorderSearchField= new Ext.form.TextField({
		id: 'invoice_noorderSearchField',
		fieldLabel: 'Invoice Noorder',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  invoice_tanggal Search Field */
	invoice_tanggalSearchField= new Ext.form.DateField({
		id: 'invoice_tanggalSearchField',
		fieldLabel: 'Invoice Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  invoice_nilai Search Field */
	invoice_nilaiSearchField= new Ext.form.NumberField({
		id: 'invoice_nilaiSearchField',
		fieldLabel: 'Invoice Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	penerimaan_invoice_searchForm = new Ext.FormPanel({
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
				items: [invoice_noSearchField, invoice_supplierSearchField, invoice_noorderSearchField, invoice_tanggalSearchField, invoice_nilaiSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: penerimaan_invoice_list_search
			},{
				text: 'Close',
				handler: function(){
					penerimaan_invoice_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	penerimaan_invoice_searchWindow = new Ext.Window({
		title: 'penerimaan_invoice Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_penerimaan_invoice_search',
		items: penerimaan_invoice_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!penerimaan_invoice_searchWindow.isVisible()){
			penerimaan_invoice_searchWindow.show();
		} else {
			penerimaan_invoice_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function penerimaan_invoice_print(){
		var searchquery = "";
		var invoice_no_print=null;
		var invoice_supplier_print=null;
		var invoice_noorder_print=null;
		var invoice_tanggal_print_date="";
		var invoice_nilai_print=null;
		var win;              
		// check if we do have some search data...
		if(penerimaan_invoice_DataStore.baseParams.query!==null){searchquery = penerimaan_invoice_DataStore.baseParams.query;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_no!==null){invoice_no_print = penerimaan_invoice_DataStore.baseParams.invoice_no;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_supplier!==null){invoice_supplier_print = penerimaan_invoice_DataStore.baseParams.invoice_supplier;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_noorder!==null){invoice_noorder_print = penerimaan_invoice_DataStore.baseParams.invoice_noorder;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_tanggal!==""){invoice_tanggal_print_date = penerimaan_invoice_DataStore.baseParams.invoice_tanggal;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_nilai!==null){invoice_nilai_print = penerimaan_invoice_DataStore.baseParams.invoice_nilai;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_penerimaan_invoice&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			invoice_no : invoice_no_print,
			invoice_supplier : invoice_supplier_print,
			invoice_noorder : invoice_noorder_print,
		  	invoice_tanggal : invoice_tanggal_print_date, 
			invoice_nilai : invoice_nilai_print,
		  	currentlisting: penerimaan_invoice_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./penerimaan_invoicelist.html','penerimaan_invoicelist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function penerimaan_invoice_export_excel(){
		var searchquery = "";
		var invoice_no_2excel=null;
		var invoice_supplier_2excel=null;
		var invoice_noorder_2excel=null;
		var invoice_tanggal_2excel_date="";
		var invoice_nilai_2excel=null;
		var win;              
		// check if we do have some search data...
		if(penerimaan_invoice_DataStore.baseParams.query!==null){searchquery = penerimaan_invoice_DataStore.baseParams.query;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_no!==null){invoice_no_2excel = penerimaan_invoice_DataStore.baseParams.invoice_no;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_supplier!==null){invoice_supplier_2excel = penerimaan_invoice_DataStore.baseParams.invoice_supplier;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_noorder!==null){invoice_noorder_2excel = penerimaan_invoice_DataStore.baseParams.invoice_noorder;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_tanggal!==""){invoice_tanggal_2excel_date = penerimaan_invoice_DataStore.baseParams.invoice_tanggal;}
		if(penerimaan_invoice_DataStore.baseParams.invoice_nilai!==null){invoice_nilai_2excel = penerimaan_invoice_DataStore.baseParams.invoice_nilai;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_penerimaan_invoice&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			invoice_no : invoice_no_2excel,
			invoice_supplier : invoice_supplier_2excel,
			invoice_noorder : invoice_noorder_2excel,
		  	invoice_tanggal : invoice_tanggal_2excel_date, 
			invoice_nilai : invoice_nilai_2excel,
		  	currentlisting: penerimaan_invoice_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_penerimaan_invoice"></div>
		<div id="elwindow_penerimaan_invoice_create"></div>
        <div id="elwindow_penerimaan_invoice_search"></div>
    </div>
</div>
</body>