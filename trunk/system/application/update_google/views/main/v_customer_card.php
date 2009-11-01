<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: customer_card View
	+ Description	: For record view
	+ Filename 		: v_customer_card.php
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
var customer_card_DataStore;
var customer_card_ColumnModel;
var customer_cardListEditorGrid;
var customer_card_createForm;
var customer_card_createWindow;
var customer_card_searchForm;
var customer_card_searchWindow;
var customer_card_SelectedRow;
var customer_card_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var card_idField;
var card_noField;
var card_namaField;
var card_alamatField;
var card_nomemberField;
var card_pointsaldoField;
var card_idSearchField;
var card_noSearchField;
var card_namaSearchField;
var card_alamatSearchField;
var card_nomemberSearchField;
var card_pointsaldoSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function customer_card_update(oGrid_event){
	var card_id_update_pk="";
	var card_no_update=null;
	var card_nama_update=null;
	var card_alamat_update=null;
	var card_nomember_update=null;
	var card_pointsaldo_update=null;

	card_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.card_no!== null){card_no_update = oGrid_event.record.data.card_no;}
	if(oGrid_event.record.data.card_nama!== null){card_nama_update = oGrid_event.record.data.card_nama;}
	if(oGrid_event.record.data.card_alamat!== null){card_alamat_update = oGrid_event.record.data.card_alamat;}
	if(oGrid_event.record.data.card_nomember!== null){card_nomember_update = oGrid_event.record.data.card_nomember;}
	if(oGrid_event.record.data.card_pointsaldo!== null){card_pointsaldo_update = oGrid_event.record.data.card_pointsaldo;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_customer_card&m=get_action',
			params: {
				task: "UPDATE",
				card_id	: get_pk_id(),				card_no	:card_no_update,		
				card_nama	:card_nama_update,		
				card_alamat	:card_alamat_update,		
				card_nomember	:card_nomember_update,		
				card_pointsaldo	:card_pointsaldo_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						customer_card_DataStore.commitChanges();
						customer_card_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the customer_card.',
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
	function customer_card_create(){
		if(is_customer_card_form_valid()){
		
		var card_id_create_pk=null;
		var card_no_create=null;
		var card_nama_create=null;
		var card_alamat_create=null;
		var card_nomember_create=null;
		var card_pointsaldo_create=null;

		card_id_create_pk=get_pk_id();
		if(card_noField.getValue()!== null){card_no_create = card_noField.getValue();}
		if(card_namaField.getValue()!== null){card_nama_create = card_namaField.getValue();}
		if(card_alamatField.getValue()!== null){card_alamat_create = card_alamatField.getValue();}
		if(card_nomemberField.getValue()!== null){card_nomember_create = card_nomemberField.getValue();}
		if(card_pointsaldoField.getValue()!== null){card_pointsaldo_create = card_pointsaldoField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_customer_card&m=get_action',
				params: {
					task: post2db,
					card_id	: card_id_create_pk,	
					card_no	: card_no_create,	
					card_nama	: card_nama_create,	
					card_alamat	: card_alamat_create,	
					card_nomember	: card_nomember_create,	
					card_pointsaldo	: card_pointsaldo_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Customer_card was '+msg+' successfully.');
							customer_card_DataStore.reload();
							customer_card_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Customer_card.',
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
			return customer_cardListEditorGrid.getSelectionModel().getSelected().get('card_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function customer_card_reset_form(){
		card_noField.reset();
		card_namaField.reset();
		card_alamatField.reset();
		card_nomemberField.reset();
		card_pointsaldoField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function customer_card_set_form(){
		card_noField.setValue(customer_cardListEditorGrid.getSelectionModel().getSelected().get('card_no'));
		card_namaField.setValue(customer_cardListEditorGrid.getSelectionModel().getSelected().get('card_nama'));
		card_alamatField.setValue(customer_cardListEditorGrid.getSelectionModel().getSelected().get('card_alamat'));
		card_nomemberField.setValue(customer_cardListEditorGrid.getSelectionModel().getSelected().get('card_nomember'));
		card_pointsaldoField.setValue(customer_cardListEditorGrid.getSelectionModel().getSelected().get('card_pointsaldo'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_customer_card_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!customer_card_createWindow.isVisible()){
			customer_card_reset_form();
			post2db='CREATE';
			msg='created';
			customer_card_createWindow.show();
		} else {
			customer_card_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function customer_card_confirm_delete(){
		// only one customer_card is selected here
		if(customer_cardListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', customer_card_delete);
		} else if(customer_cardListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', customer_card_delete);
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
	function customer_card_confirm_update(){
		/* only one record is selected here */
		if(customer_cardListEditorGrid.selModel.getCount() == 1) {
			customer_card_set_form();
			post2db='UPDATE';
			msg='updated';
			customer_card_createWindow.show();
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
	function customer_card_delete(btn){
		if(btn=='yes'){
			var selections = customer_cardListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< customer_cardListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.card_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_customer_card&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							customer_card_DataStore.reload();
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
	customer_card_DataStore = new Ext.data.Store({
		id: 'customer_card_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_customer_card&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'card_id'
		},[
		/* dataIndex => insert intocustomer_card_ColumnModel, Mapping => for initiate table column */ 
			{name: 'card_id', type: 'int', mapping: 'card_id'},
			{name: 'card_no', type: 'string', mapping: 'card_no'},
			{name: 'card_nama', type: 'string', mapping: 'card_nama'},
			{name: 'card_alamat', type: 'string', mapping: 'card_alamat'},
			{name: 'card_nomember', type: 'string', mapping: 'card_nomember'},
			{name: 'card_pointsaldo', type: 'int', mapping: 'card_pointsaldo'}
		]),
		sortInfo:{field: 'card_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	customer_card_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'card_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Card No',
			dataIndex: 'card_no',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Card Nama',
			dataIndex: 'card_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		},
		{
			header: 'Card Alamat',
			dataIndex: 'card_alamat',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		},
		{
			header: 'Card Nomember',
			dataIndex: 'card_nomember',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Card Pointsaldo',
			dataIndex: 'card_pointsaldo',
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
	customer_card_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	customer_cardListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'customer_cardListEditorGrid',
		el: 'fp_customer_card',
		title: 'List Of Customer_card',
		autoHeight: true,
		store: customer_card_DataStore, // DataStore
		cm: customer_card_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: customer_card_DataStore,
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
			handler: customer_card_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: customer_card_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: customer_card_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: customer_card_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: customer_card_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: customer_card_print  
		}
		]
	});
	customer_cardListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	customer_card_ContextMenu = new Ext.menu.Menu({
		id: 'customer_card_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: customer_card_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: customer_card_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: customer_card_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: customer_card_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function oncustomer_card_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		customer_card_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		customer_card_SelectedRow=rowIndex;
		customer_card_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function customer_card_editContextMenu(){
      customer_cardListEditorGrid.startEditing(customer_card_SelectedRow,1);
  	}
	/* End of Function */
  	
	customer_cardListEditorGrid.addListener('rowcontextmenu', oncustomer_card_ListEditGridContextMenu);
	customer_card_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	customer_cardListEditorGrid.on('afteredit', customer_card_update); // inLine Editing Record
	
	/* Identify  card_no Field */
	card_noField= new Ext.form.TextField({
		id: 'card_noField',
		fieldLabel: 'Card No',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  card_nama Field */
	card_namaField= new Ext.form.TextField({
		id: 'card_namaField',
		fieldLabel: 'Card Nama',
		maxLength: 100,
		anchor: '95%'
	});
	/* Identify  card_alamat Field */
	card_alamatField= new Ext.form.TextField({
		id: 'card_alamatField',
		fieldLabel: 'Card Alamat',
		maxLength: 100,
		anchor: '95%'
	});
	/* Identify  card_nomember Field */
	card_nomemberField= new Ext.form.TextField({
		id: 'card_nomemberField',
		fieldLabel: 'Card Nomember',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  card_pointsaldo Field */
	card_pointsaldoField= new Ext.form.NumberField({
		id: 'card_pointsaldoField',
		fieldLabel: 'Card Pointsaldo',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	customer_card_createForm = new Ext.FormPanel({
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
				items: [card_noField, card_namaField, card_alamatField, card_nomemberField, card_pointsaldoField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: customer_card_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					customer_card_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	customer_card_createWindow= new Ext.Window({
		id: 'customer_card_createWindow',
		title: post2db+'Customer_card',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_customer_card_create',
		items: customer_card_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function customer_card_list_search(){
		// render according to a SQL date format.
		var card_id_search=null;
		var card_no_search=null;
		var card_nama_search=null;
		var card_alamat_search=null;
		var card_nomember_search=null;
		var card_pointsaldo_search=null;

		if(card_idSearchField.getValue()!==null){card_id_search=card_idSearchField.getValue();}
		if(card_noSearchField.getValue()!==null){card_no_search=card_noSearchField.getValue();}
		if(card_namaSearchField.getValue()!==null){card_nama_search=card_namaSearchField.getValue();}
		if(card_alamatSearchField.getValue()!==null){card_alamat_search=card_alamatSearchField.getValue();}
		if(card_nomemberSearchField.getValue()!==null){card_nomember_search=card_nomemberSearchField.getValue();}
		if(card_pointsaldoSearchField.getValue()!==null){card_pointsaldo_search=card_pointsaldoSearchField.getValue();}
		// change the store parameters
		customer_card_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			card_id	:	card_id_search, 
			card_no	:	card_no_search, 
			card_nama	:	card_nama_search, 
			card_alamat	:	card_alamat_search, 
			card_nomember	:	card_nomember_search, 
			card_pointsaldo	:	card_pointsaldo_search 
};
		// Cause the datastore to do another query : 
		customer_card_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function customer_card_reset_search(){
		// reset the store parameters
		customer_card_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		customer_card_DataStore.reload({params: {start: 0, limit: pageS}});
		customer_card_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  card_id Search Field */
	card_idSearchField= new Ext.form.NumberField({
		id: 'card_idSearchField',
		fieldLabel: 'Card Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  card_no Search Field */
	card_noSearchField= new Ext.form.TextField({
		id: 'card_noSearchField',
		fieldLabel: 'Card No',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  card_nama Search Field */
	card_namaSearchField= new Ext.form.TextField({
		id: 'card_namaSearchField',
		fieldLabel: 'Card Nama',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  card_alamat Search Field */
	card_alamatSearchField= new Ext.form.TextField({
		id: 'card_alamatSearchField',
		fieldLabel: 'Card Alamat',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  card_nomember Search Field */
	card_nomemberSearchField= new Ext.form.TextField({
		id: 'card_nomemberSearchField',
		fieldLabel: 'Card Nomember',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  card_pointsaldo Search Field */
	card_pointsaldoSearchField= new Ext.form.NumberField({
		id: 'card_pointsaldoSearchField',
		fieldLabel: 'Card Pointsaldo',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	customer_card_searchForm = new Ext.FormPanel({
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
				items: [card_noSearchField, card_namaSearchField, card_alamatSearchField, card_nomemberSearchField, card_pointsaldoSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: customer_card_list_search
			},{
				text: 'Close',
				handler: function(){
					customer_card_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	customer_card_searchWindow = new Ext.Window({
		title: 'customer_card Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_customer_card_search',
		items: customer_card_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!customer_card_searchWindow.isVisible()){
			customer_card_searchWindow.show();
		} else {
			customer_card_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function customer_card_print(){
		var searchquery = "";
		var card_no_print=null;
		var card_nama_print=null;
		var card_alamat_print=null;
		var card_nomember_print=null;
		var card_pointsaldo_print=null;
		var win;              
		// check if we do have some search data...
		if(customer_card_DataStore.baseParams.query!==null){searchquery = customer_card_DataStore.baseParams.query;}
		if(customer_card_DataStore.baseParams.card_no!==null){card_no_print = customer_card_DataStore.baseParams.card_no;}
		if(customer_card_DataStore.baseParams.card_nama!==null){card_nama_print = customer_card_DataStore.baseParams.card_nama;}
		if(customer_card_DataStore.baseParams.card_alamat!==null){card_alamat_print = customer_card_DataStore.baseParams.card_alamat;}
		if(customer_card_DataStore.baseParams.card_nomember!==null){card_nomember_print = customer_card_DataStore.baseParams.card_nomember;}
		if(customer_card_DataStore.baseParams.card_pointsaldo!==null){card_pointsaldo_print = customer_card_DataStore.baseParams.card_pointsaldo;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_customer_card&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			card_no : card_no_print,
			card_nama : card_nama_print,
			card_alamat : card_alamat_print,
			card_nomember : card_nomember_print,
			card_pointsaldo : card_pointsaldo_print,
		  	currentlisting: customer_card_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./customer_cardlist.html','customer_cardlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function customer_card_export_excel(){
		var searchquery = "";
		var card_no_2excel=null;
		var card_nama_2excel=null;
		var card_alamat_2excel=null;
		var card_nomember_2excel=null;
		var card_pointsaldo_2excel=null;
		var win;              
		// check if we do have some search data...
		if(customer_card_DataStore.baseParams.query!==null){searchquery = customer_card_DataStore.baseParams.query;}
		if(customer_card_DataStore.baseParams.card_no!==null){card_no_2excel = customer_card_DataStore.baseParams.card_no;}
		if(customer_card_DataStore.baseParams.card_nama!==null){card_nama_2excel = customer_card_DataStore.baseParams.card_nama;}
		if(customer_card_DataStore.baseParams.card_alamat!==null){card_alamat_2excel = customer_card_DataStore.baseParams.card_alamat;}
		if(customer_card_DataStore.baseParams.card_nomember!==null){card_nomember_2excel = customer_card_DataStore.baseParams.card_nomember;}
		if(customer_card_DataStore.baseParams.card_pointsaldo!==null){card_pointsaldo_2excel = customer_card_DataStore.baseParams.card_pointsaldo;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_customer_card&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			card_no : card_no_2excel,
			card_nama : card_nama_2excel,
			card_alamat : card_alamat_2excel,
			card_nomember : card_nomember_2excel,
			card_pointsaldo : card_pointsaldo_2excel,
		  	currentlisting: customer_card_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_customer_card"></div>
		<div id="elwindow_customer_card_create"></div>
        <div id="elwindow_customer_card_search"></div>
    </div>
</div>
</body>