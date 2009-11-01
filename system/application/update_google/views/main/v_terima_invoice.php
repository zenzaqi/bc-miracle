<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: terima_invoice View
	+ Description	: For record view
	+ Filename 		: v_terima_invoice.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:49:52
	
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
var terima_invoice_DataStore;
var terima_invoice_ColumnModel;
var terima_invoiceListEditorGrid;
var terima_invoice_createForm;
var terima_invoice_createWindow;
var terima_invoice_searchForm;
var terima_invoice_searchWindow;
var terima_invoice_SelectedRow;
var terima_invoice_ContextMenu;
//for detail data
var _DataStor;
var ListEditorGrid;
var _ColumnModel;
var _proxy;
var _writer;
var _reader;
var editor_;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var invoice_idField;
var invoice_noField;
var invoice_supplierField;
var invoice_noorderField;
var invoice_suratjalanField;
var invoice_tanggalField;
var invoice_nilaiField;
var invoice_jatuhtempoField;
var invoice_penagihField;
var invoice_idSearchField;
var invoice_noSearchField;
var invoice_supplierSearchField;
var invoice_noorderSearchField;
var invoice_suratjalanSearchField;
var invoice_penagihSearchField;
var invoice_tanggalSearchField;
var invoice_nilaiSearchField;
var invoice_jatuhtempoSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function terima_invoice_update(oGrid_event){
		var invoice_id_update_pk="";
		var invoice_no_update=null;
		var invoice_supplier_update=null;
		var invoice_noorder_update=null;
		var invoice_suratjalan_update="";
		var invoice_tanggal_update_date="";
		var invoice_nilai_update=null;
		var invoice_jatuhtempo_update_date="";
		var invoice_penagih_update="";

		invoice_id_update_pk = oGrid_event.record.data.invoice_id;
		if(oGrid_event.record.data.invoice_no!== null){invoice_no_update = oGrid_event.record.data.invoice_no;}
		if(oGrid_event.record.data.invoice_supplier!== null){invoice_supplier_update = oGrid_event.record.data.invoice_supplier;}
		if(oGrid_event.record.data.invoice_noorder!== null){invoice_noorder_update = oGrid_event.record.data.invoice_noorder;}
		if(oGrid_event.record.data.invoice_suratjalan!== ""){invoice_suratjalan_update = oGrid_event.record.data.invoice_suratjalan;}
	 	if(oGrid_event.record.data.invoice_tanggal!== ""){invoice_tanggal_update_date =oGrid_event.record.data.invoice_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.invoice_nilai!== null){invoice_nilai_update = oGrid_event.record.data.invoice_nilai;}
	 	if(oGrid_event.record.data.invoice_jatuhtempo!== ""){invoice_jatuhtempo_update_date =oGrid_event.record.data.invoice_jatuhtempo.format('Y-m-d');}
		if(oGrid_event.record.data.invoice_penagih!== ""){invoice_penagih_update = oGrid_event.record.data.invoice_penagih;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_terima_invoice&m=get_action',
			params: {
				task: "UPDATE",
				invoice_id	: invoice_id_update_pk, 
				invoice_no	:invoice_no_update,  
				invoice_supplier	:invoice_supplier_update,  
				invoice_noorder	:invoice_noorder_update,  
				invoice_suratjalan	:invoice_suratjalan_update,  
				invoice_tanggal	: invoice_tanggal_update_date, 
				invoice_nilai	:invoice_nilai_update,  
				invoice_jatuhtempo	: invoice_jatuhtempo_update_date, 
				invoice_penagih	:invoice_penagih_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						terima_invoice_DataStore.commitChanges();
						terima_invoice_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the terima_invoice.',
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
	function terima_invoice_create(){
	
		if(is_terima_invoice_form_valid()){	
		var invoice_id_create_pk=null; 
		var invoice_no_create=null; 
		var invoice_supplier_create=null; 
		var invoice_noorder_create=null; 
		var invoice_suratjalan_create=""; 
		var invoice_tanggal_create_date=""; 
		var invoice_nilai_create=null; 
		var invoice_jatuhtempo_create_date=""; 
		var invoice_penagih_create=""; 

		if(invoice_idField.getValue()!== null){invoice_id_create = invoice_idField.getValue();}else{invoice_id_create_pk=get_pk_id();} 
		if(invoice_noField.getValue()!== null){invoice_no_create = invoice_noField.getValue();} 
		if(invoice_supplierField.getValue()!== null){invoice_supplier_create = invoice_supplierField.getValue();} 
		if(invoice_noorderField.getValue()!== null){invoice_noorder_create = invoice_noorderField.getValue();} 
		if(invoice_suratjalanField.getValue()!== ""){invoice_suratjalan_create = invoice_suratjalanField.getValue();} 
		if(invoice_tanggalField.getValue()!== ""){invoice_tanggal_create_date = invoice_tanggalField.getValue().format('Y-m-d');} 
		if(invoice_nilaiField.getValue()!== null){invoice_nilai_create = invoice_nilaiField.getValue();} 
		if(invoice_jatuhtempoField.getValue()!== ""){invoice_jatuhtempo_create_date = invoice_jatuhtempoField.getValue().format('Y-m-d');} 
		if(invoice_penagihField.getValue()!== ""){invoice_penagih_create = invoice_penagihField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_terima_invoice&m=get_action',
			params: {
				task: post2db,
				invoice_id	: invoice_id_create_pk, 
				invoice_no	: invoice_no_create, 
				invoice_supplier	: invoice_supplier_create, 
				invoice_noorder	: invoice_noorder_create, 
				invoice_suratjalan	: invoice_suratjalan_create, 
				invoice_tanggal	: invoice_tanggal_create_date, 
				invoice_nilai	: invoice_nilai_create, 
				invoice_jatuhtempo	: invoice_jatuhtempo_create_date, 
				invoice_penagih	: invoice_penagih_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						Ext.MessageBox.alert(post2db+' OK','The Terima_invoice was '+msg+' successfully.');
						terima_invoice_DataStore.reload();
						terima_invoice_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Terima_invoice.',
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
			return terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function terima_invoice_reset_form(){
		invoice_idField.reset();
		invoice_idField.setValue(null);
		invoice_noField.reset();
		invoice_noField.setValue(null);
		invoice_supplierField.reset();
		invoice_supplierField.setValue(null);
		invoice_noorderField.reset();
		invoice_noorderField.setValue(null);
		invoice_suratjalanField.reset();
		invoice_suratjalanField.setValue(null);
		invoice_tanggalField.reset();
		invoice_tanggalField.setValue(null);
		invoice_nilaiField.reset();
		invoice_nilaiField.setValue(null);
		invoice_jatuhtempoField.reset();
		invoice_jatuhtempoField.setValue(null);
		invoice_penagihField.reset();
		invoice_penagihField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function terima_invoice_set_form(){
		invoice_idField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_id'));
		invoice_noField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_no'));
		invoice_supplierField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_supplier'));
		invoice_noorderField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_noorder'));
		invoice_suratjalanField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_suratjalan'));
		invoice_tanggalField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_tanggal'));
		invoice_nilaiField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_nilai'));
		invoice_jatuhtempoField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_jatuhtempo'));
		invoice_penagihField.setValue(terima_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_penagih'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_terima_invoice_form_valid(){
		return (true &&  true &&  invoice_supplierField.isValid() && invoice_noorderField.isValid() && true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!terima_invoice_createWindow.isVisible()){
			terima_invoice_reset_form();
			post2db='CREATE';
			msg='created';
			terima_invoice_createWindow.show();
		} else {
			terima_invoice_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function terima_invoice_confirm_delete(){
		// only one terima_invoice is selected here
		if(terima_invoiceListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', terima_invoice_delete);
		} else if(terima_invoiceListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', terima_invoice_delete);
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
	function terima_invoice_confirm_update(){
		/* only one record is selected here */
		if(terima_invoiceListEditorGrid.selModel.getCount() == 1) {
			terima_invoice_set_form();
			post2db='UPDATE';
			msg='updated';
			terima_invoice_createWindow.show();
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
	function terima_invoice_delete(btn){
		if(btn=='yes'){
			var selections = terima_invoiceListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< terima_invoiceListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.invoice_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_terima_invoice&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							terima_invoice_DataStore.reload();
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
	terima_invoice_DataStore = new Ext.data.Store({
		id: 'terima_invoice_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_terima_invoice&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'invoice_id'
		},[
		/* dataIndex => insert intoterima_invoice_ColumnModel, Mapping => for initiate table column */ 
			{name: 'invoice_id', type: 'int', mapping: 'invoice_id'}, 
			{name: 'invoice_no', type: 'string', mapping: 'invoice_no'}, 
			{name: 'invoice_supplier', type: 'string', mapping: 'supplier_nama'}, 
			{name: 'invoice_noorder', type: 'int', mapping: 'invoice_noorder'}, 
			{name: 'invoice_suratjalan', type: 'string', mapping: 'invoice_suratjalan'},
			{name: 'invoice_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'invoice_tanggal'}, 
			{name: 'invoice_nilai', type: 'float', mapping: 'invoice_nilai'}, 
			{name: 'invoice_jatuhtempo', type: 'date', dateFormat: 'Y-m-d', mapping: 'invoice_jatuhtempo'}, 
			{name: 'invoice_penagih', type: 'string', mapping: 'invoice_penagih'},
			{name: 'invoice_creator', type: 'string', mapping: 'invoice_creator'}, 
			{name: 'invoice_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'invoice_date_create'}, 
			{name: 'invoice_update', type: 'string', mapping: 'invoice_update'}, 
			{name: 'invoice_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'invoice_date_update'}, 
			{name: 'invoice_revised', type: 'int', mapping: 'invoice_revised'} 
		]),
		sortInfo:{field: 'invoice_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Supplier DataStore */
	cbo_invoice_supplier_DataSore = new Ext.data.Store({
		id: 'cbo_invoice_supplier_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_terima_invoice&m=get_supplier_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'supplier_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'invoice_supplier_value', type: 'int', mapping: 'supplier_id'},
			{name: 'invoice_supplier_nama', type: 'string', mapping: 'supplier_nama'},
			{name: 'invoice_supplier_alamat', type: 'string',  mapping: 'supplier_alamat'},
			{name: 'invoice_supplier_kota', type: 'string', mapping: 'supplier_kota'},
			{name: 'invoice_supplier_notelp', type: 'string', mapping: 'supplier_notelp'}
		]),
		sortInfo:{field: 'invoice_supplier_nama', direction: "ASC"}
	});
	
	// Custom rendering Template
    var invoice_supplier_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{invoice_supplier_nama}</b><br /></span>',
            'Alamat: {invoice_supplier_alamat}, {invoice_supplier_kota}<br>Telp. {invoice_supplier_notelp}',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	terima_invoice_ColumnModel = new Ext.grid.ColumnModel(
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
			header: 'No.Penerimaan',
			dataIndex: 'invoice_no',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: 'Supplier',
			dataIndex: 'invoice_supplier',
			width: 200,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_invoice_supplier_DataSore,
				mode: 'remote',
               	displayField: 'invoice_supplier_nama',
               	valueField: 'invoice_supplier_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'No.Order',
			dataIndex: 'invoice_noorder',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'No.Surat Jalan',
			dataIndex: 'invoice_suratjalan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'invoice_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Nilai',
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
		}, 
		{
			header: 'Jatuh Tempo',
			dataIndex: 'invoice_jatuhtempo',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Nama Penagih',
			dataIndex: 'invoice_penagih',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'invoice_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'invoice_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'invoice_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'invoice_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'invoice_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	terima_invoice_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	terima_invoiceListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'terima_invoiceListEditorGrid',
		el: 'fp_terima_invoice',
		title: 'List Of Terima_invoice',
		autoHeight: true,
		store: terima_invoice_DataStore, // DataStore
		cm: terima_invoice_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: terima_invoice_DataStore,
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
			handler: terima_invoice_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: terima_invoice_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: terima_invoice_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: terima_invoice_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: terima_invoice_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: terima_invoice_print  
		}
		]
	});
	terima_invoiceListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	terima_invoice_ContextMenu = new Ext.menu.Menu({
		id: 'terima_invoice_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: terima_invoice_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: terima_invoice_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: terima_invoice_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: terima_invoice_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onterima_invoice_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		terima_invoice_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		terima_invoice_SelectedRow=rowIndex;
		terima_invoice_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function terima_invoice_editContextMenu(){
		terima_invoiceListEditorGrid.startEditing(terima_invoice_SelectedRow,1);
  	}
	/* End of Function */
  	
	terima_invoiceListEditorGrid.addListener('rowcontextmenu', onterima_invoice_ListEditGridContextMenu);
	terima_invoice_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	terima_invoiceListEditorGrid.on('afteredit', terima_invoice_update); // inLine Editing Record
	
	/* Identify  invoice_id Field */
	invoice_idField= new Ext.form.NumberField({
		id: 'invoice_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  invoice_no Field */
	invoice_noField= new Ext.form.TextField({
		id: 'invoice_noField',
		fieldLabel: 'No.Penerimaan',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  invoice_supplier Field */
	invoice_supplierField= new Ext.form.ComboBox({
		id: 'invoice_supplierField',
		fieldLabel: 'Supplier',
		store: cbo_invoice_supplier_DataSore,
		displayField:'invoice_supplier_nama',
		mode : 'remote',
		valueField: 'invoice_supplier_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: invoice_supplier_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  invoice_noorder Field */
	invoice_noorderField= new Ext.form.NumberField({
		id: 'invoice_noorderField',
		fieldLabel: 'No.Order',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  invoice_suratjalan Field */
	invoice_suratjalanField= new Ext.form.TextField({
		id: 'invoice_suratjalanField',
		fieldLabel: 'No.Surat Jalan',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  invoice_tanggal Field */
	invoice_tanggalField= new Ext.form.DateField({
		id: 'invoice_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  invoice_nilai Field */
	invoice_nilaiField= new Ext.form.NumberField({
		id: 'invoice_nilaiField',
		fieldLabel: 'Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  invoice_jatuhtempo Field */
	invoice_jatuhtempoField= new Ext.form.DateField({
		id: 'invoice_jatuhtempoField',
		fieldLabel: 'Jatuh Tempo',
		format : 'Y-m-d',
	});
	/* Identify  invoice_penagih Field */
	invoice_penagihField= new Ext.form.TextField({
		id: 'invoice_penagihField',
		fieldLabel: 'Nama Penagih',
		maxLength: 50,
		anchor: '95%'
	});

	
	/* Function for retrieve create Window Panel*/ 
	terima_invoice_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 300,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [invoice_idField, invoice_noField, invoice_supplierField, invoice_noorderField, invoice_suratjalanField, invoice_tanggalField, invoice_nilaiField, invoice_jatuhtempoField, invoice_penagihField] 
			}
			],
		buttons: [{
				text: 'Save and Close',
				handler: terima_invoice_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					terima_invoice_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	terima_invoice_createWindow= new Ext.Window({
		id: 'terima_invoice_createWindow',
		title: post2db+'Terima_invoice',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_terima_invoice_create',
		items: terima_invoice_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function terima_invoice_list_search(){
		// render according to a SQL date format.
		var invoice_id_search=null;
		var invoice_no_search=null;
		var invoice_supplier_search=null;
		var invoice_noorder_search=null;
		var invoice_suratjalan_search="";
		var invoice_tanggal_search_date="";
		var invoice_nilai_search=null;
		var invoice_jatuhtempo_search_date="";
		var invoice_penagih_search="";

		if(invoice_idSearchField.getValue()!==null){invoice_id_search=invoice_idSearchField.getValue();}
		if(invoice_noSearchField.getValue()!==null){invoice_no_search=invoice_noSearchField.getValue();}
		if(invoice_supplierSearchField.getValue()!==null){invoice_supplier_search=invoice_supplierSearchField.getValue();}
		if(invoice_noorderSearchField.getValue()!==null){invoice_noorder_search=invoice_noorderSearchField.getValue();}
		if(invoice_suratjalanSearchField.getValue()!==""){invoice_suratjalan_search=invoice_suratjalanSearchField.getValue();}
		if(invoice_tanggalSearchField.getValue()!==""){invoice_tanggal_search_date=invoice_tanggalSearchField.getValue().format('Y-m-d');}
		if(invoice_nilaiSearchField.getValue()!==null){invoice_nilai_search=invoice_nilaiSearchField.getValue();}
		if(invoice_jatuhtempoSearchField.getValue()!==""){invoice_jatuhtempo_search_date=invoice_jatuhtempoSearchField.getValue().format('Y-m-d');}
		if(invoice_penagihSearchField.getValue()!==""){invoice_penagih_search=invoice_penagihSearchField.getValue();}
		// change the store parameters
		terima_invoice_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			invoice_id	:	invoice_id_search, 
			invoice_no	:	invoice_no_search, 
			invoice_supplier	:	invoice_supplier_search, 
			invoice_noorder	:	invoice_noorder_search, 
			invoice_suratjalan	:	invoice_suratjalan_search, 
			invoice_tanggal	:	invoice_tanggal_search_date, 
			invoice_nilai	:	invoice_nilai_search, 
			invoice_jatuhtempo	:	invoice_jatuhtempo_search_date, 
			invoice_penagih	:	invoice_penagih_search
		};
		// Cause the datastore to do another query : 
		terima_invoice_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function terima_invoice_reset_search(){
		// reset the store parameters
		terima_invoice_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		terima_invoice_DataStore.reload({params: {start: 0, limit: pageS}});
		terima_invoice_searchWindow.close();
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
		fieldLabel: 'No.Penerimaan',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  invoice_supplier Search Field */
	invoice_supplierSearchField= new Ext.form.NumberField({
		id: 'invoice_supplierSearchField',
		fieldLabel: 'Supplier',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  invoice_noorder Search Field */
	invoice_noorderSearchField= new Ext.form.NumberField({
		id: 'invoice_noorderSearchField',
		fieldLabel: 'No.Order',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  invoice_suratjalan Search Field */
	invoice_suratjalanSearchField= new Ext.form.TextField({
		id: 'invoice_suratjalanSearchField',
		fieldLabel: 'No.Surat Jalan',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  invoice_tanggal Search Field */
	invoice_tanggalSearchField= new Ext.form.DateField({
		id: 'invoice_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  invoice_nilai Search Field */
	invoice_nilaiSearchField= new Ext.form.NumberField({
		id: 'invoice_nilaiSearchField',
		fieldLabel: 'Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  invoice_jatuhtempo Search Field */
	invoice_jatuhtempoSearchField= new Ext.form.DateField({
		id: 'invoice_jatuhtempoSearchField',
		fieldLabel: 'Jatuhtempo',
		format : 'Y-m-d',
	
	});
	/* Identify  invoice_penagih Search Field */
	invoice_penagihSearchField= new Ext.form.TextField({
		id: 'invoice_penagihSearchField',
		fieldLabel: 'Nama Penagih',
		maxLength: 50,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	terima_invoice_searchForm = new Ext.FormPanel({
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
				items: [invoice_noSearchField, invoice_supplierSearchField, invoice_noorderSearchField, invoice_suratjalanSearchField, invoice_tanggalSearchField, invoice_nilaiSearchField, invoice_jatuhtempoSearchField, invoice_penagihSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: terima_invoice_list_search
			},{
				text: 'Close',
				handler: function(){
					terima_invoice_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	terima_invoice_searchWindow = new Ext.Window({
		title: 'terima_invoice Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_terima_invoice_search',
		items: terima_invoice_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!terima_invoice_searchWindow.isVisible()){
			terima_invoice_searchWindow.show();
		} else {
			terima_invoice_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function terima_invoice_print(){
		var searchquery = "";
		var invoice_no_print=null;
		var invoice_supplier_print=null;
		var invoice_noorder_print=null;
		var invoice_suratjalan_print="";
		var invoice_tanggal_print_date="";
		var invoice_nilai_print=null;
		var invoice_jatuhtempo_print_date="";
		var invoice_penagih_print="";
		var win;              
		// check if we do have some search data...
		if(terima_invoice_DataStore.baseParams.query!==null){searchquery = terima_invoice_DataStore.baseParams.query;}
		if(terima_invoice_DataStore.baseParams.invoice_no!==null){invoice_no_print = terima_invoice_DataStore.baseParams.invoice_no;}
		if(terima_invoice_DataStore.baseParams.invoice_supplier!==null){invoice_supplier_print = terima_invoice_DataStore.baseParams.invoice_supplier;}
		if(terima_invoice_DataStore.baseParams.invoice_noorder!==null){invoice_noorder_print = terima_invoice_DataStore.baseParams.invoice_noorder;}
		if(terima_invoice_DataStore.baseParams.invoice_suratjalan!==""){invoice_suratjalan_print = terima_invoice_DataStore.baseParams.invoice_suratjalan;}
		if(terima_invoice_DataStore.baseParams.invoice_tanggal!==""){invoice_tanggal_print_date = terima_invoice_DataStore.baseParams.invoice_tanggal;}
		if(terima_invoice_DataStore.baseParams.invoice_nilai!==null){invoice_nilai_print = terima_invoice_DataStore.baseParams.invoice_nilai;}
		if(terima_invoice_DataStore.baseParams.invoice_jatuhtempo!==""){invoice_jatuhtempo_print_date = terima_invoice_DataStore.baseParams.invoice_jatuhtempo;}
		if(terima_invoice_DataStore.baseParams.invoice_penagih!==""){invoice_penagih_print = terima_invoice_DataStore.baseParams.invoice_penagih;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_terima_invoice&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			invoice_no : invoice_no_print,
			invoice_supplier : invoice_supplier_print,
			invoice_noorder : invoice_noorder_print,
			invoice_suratjalan : invoice_suratjalan_print,
		  	invoice_tanggal : invoice_tanggal_print_date, 
			invoice_nilai : invoice_nilai_print,
		  	invoice_jatuhtempo : invoice_jatuhtempo_print_date, 
			invoice_penagih : invoice_penagih_print,
		  	currentlisting: terima_invoice_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./terima_invoicelist.html','terima_invoicelist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function terima_invoice_export_excel(){
		var searchquery = "";
		var invoice_no_2excel=null;
		var invoice_supplier_2excel=null;
		var invoice_noorder_2excel=null;
		var invoice_suratjalan_2excel="";
		var invoice_tanggal_2excel_date="";
		var invoice_nilai_2excel=null;
		var invoice_jatuhtempo_2excel_date="";
		var invoice_penagih_2excel="";
		var win;              
		// check if we do have some search data...
		if(terima_invoice_DataStore.baseParams.query!==null){searchquery = terima_invoice_DataStore.baseParams.query;}
		if(terima_invoice_DataStore.baseParams.invoice_no!==null){invoice_no_2excel = terima_invoice_DataStore.baseParams.invoice_no;}
		if(terima_invoice_DataStore.baseParams.invoice_supplier!==null){invoice_supplier_2excel = terima_invoice_DataStore.baseParams.invoice_supplier;}
		if(terima_invoice_DataStore.baseParams.invoice_noorder!==null){invoice_noorder_2excel = terima_invoice_DataStore.baseParams.invoice_noorder;}
		if(terima_invoice_DataStore.baseParams.invoice_suratjalan!==""){invoice_suratjalan_2excel = terima_invoice_DataStore.baseParams.invoice_suratjalan;}
		if(terima_invoice_DataStore.baseParams.invoice_tanggal!==""){invoice_tanggal_2excel_date = terima_invoice_DataStore.baseParams.invoice_tanggal;}
		if(terima_invoice_DataStore.baseParams.invoice_nilai!==null){invoice_nilai_2excel = terima_invoice_DataStore.baseParams.invoice_nilai;}
		if(terima_invoice_DataStore.baseParams.invoice_jatuhtempo!==""){invoice_jatuhtempo_2excel_date = terima_invoice_DataStore.baseParams.invoice_jatuhtempo;}
		if(terima_invoice_DataStore.baseParams.invoice_penagih!==""){invoice_penagih_2excel = terima_invoice_DataStore.baseParams.invoice_penagih;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_terima_invoice&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			invoice_no : invoice_no_2excel,
			invoice_supplier : invoice_supplier_2excel,
			invoice_noorder : invoice_noorder_2excel,
			invoice_suratjalan : invoice_suratjalan_2excel,
		  	invoice_tanggal : invoice_tanggal_2excel_date, 
			invoice_nilai : invoice_nilai_2excel,
		  	invoice_jatuhtempo : invoice_jatuhtempo_2excel_date, 
			invoice_penagih : invoice_penagih_2excel,
		  	currentlisting: terima_invoice_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_terima_invoice"></div>
		<div id="elwindow_terima_invoice_create"></div>
        <div id="elwindow_terima_invoice_search"></div>
    </div>
</div>
</body>