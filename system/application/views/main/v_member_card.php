<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: member_card View
	+ Description	: For record view
	+ Filename 		: v_member_card.php
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
var member_card_DataStore;
var member_card_ColumnModel;
var member_cardListEditorGrid;
var member_card_createForm;
var member_card_createWindow;
var member_card_searchForm;
var member_card_searchWindow;
var member_card_SelectedRow;
var member_card_ContextMenu;
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
	function member_card_update(oGrid_event){
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
			url: 'index.php?c=c_member_card&m=get_action',
			params: {
				task: "UPDATE",
				card_id	: get_pk_id(),				
				card_no	:card_no_update,		
				card_nama	:card_nama_update,		
				card_alamat	:card_alamat_update,		
				card_nomember	:card_nomember_update,		
				card_pointsaldo	:card_pointsaldo_update		
				
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						member_card_DataStore.commitChanges();
						member_card_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the member_card.',
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
	function member_card_create(){
		if(is_member_card_form_valid()){
		
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
				url: 'index.php?c=c_member_card&m=get_action',
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
							Ext.MessageBox.alert(post2db+' OK','The Member_card was '+msg+' successfully.');
							member_card_DataStore.reload();
							member_card_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Member_card.',
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
			return member_cardListEditorGrid.getSelectionModel().getSelected().get('card_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function member_card_reset_form(){
		card_noField.reset();
		card_namaField.reset();
		card_alamatField.reset();
		card_nomemberField.reset();
		card_pointsaldoField.reset();
		card_creatorField.reset();
		card_date_createField.reset();
		card_updateField.reset();
		card_date_updateField.reset();
		card_revisedField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function member_card_set_form(){
		card_noField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_no'));
		card_namaField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_nama'));
		card_alamatField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_alamat'));
		card_nomemberField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_nomember'));
		card_pointsaldoField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_pointsaldo'));
		card_creatorField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_creator'));
		card_date_createField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_date_create'));
		card_updateField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_update'));
		card_date_updateField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_date_update'));
		card_revisedField.setValue(member_cardListEditorGrid.getSelectionModel().getSelected().get('card_revised'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_member_card_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!member_card_createWindow.isVisible()){
			member_card_reset_form();
			post2db='CREATE';
			msg='created';
			member_card_createWindow.show();
		} else {
			member_card_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function member_card_confirm_delete(){
		// only one member_card is selected here
		if(member_cardListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', member_card_delete);
		} else if(member_cardListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', member_card_delete);
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
	function member_card_confirm_update(){
		/* only one record is selected here */
		if(member_cardListEditorGrid.selModel.getCount() == 1) {
			member_card_set_form();
			post2db='UPDATE';
			msg='updated';
			member_card_createWindow.show();
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
	function member_card_delete(btn){
		if(btn=='yes'){
			var selections = member_cardListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< member_cardListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.card_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_member_card&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							member_card_DataStore.reload();
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
	member_card_DataStore = new Ext.data.Store({
		id: 'member_card_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_member_card&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'card_id'
		},[
		/* dataIndex => insert intomember_card_ColumnModel, Mapping => for initiate table column */ 
			{name: 'card_id', type: 'int', mapping: 'card_id'},
			{name: 'card_no', type: 'string', mapping: 'card_no'},
			{name: 'card_nama', type: 'string', mapping: 'card_nama'},
			{name: 'card_alamat', type: 'string', mapping: 'card_alamat'},
			{name: 'card_nomember', type: 'string', mapping: 'card_nomember'},
			{name: 'card_pointsaldo', type: 'int', mapping: 'card_pointsaldo'},
			{name: 'card_creator', type: 'string', mapping: 'card_creator'},
			{name: 'card_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'card_date_create'},
			{name: 'card_update', type: 'string', mapping: 'card_update'},
			{name: 'card_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'card_date_update'},
			{name: 'card_revised', type: 'int', mapping: 'card_revised'}
		]),
		sortInfo:{field: 'card_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	member_card_ColumnModel = new Ext.grid.ColumnModel(
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
		},
		{
			header: 'Card Creator',
			dataIndex: 'card_creator',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Card Date Create',
			dataIndex: 'card_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Card Update',
			dataIndex: 'card_update',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Card Date Update',
			dataIndex: 'card_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Card Revised',
			dataIndex: 'card_revised',
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
	member_card_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	member_cardListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'member_cardListEditorGrid',
		el: 'fp_member_card',
		title: 'List Of Member_card',
		autoHeight: true,
		store: member_card_DataStore, // DataStore
		cm: member_card_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: member_card_DataStore,
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
			handler: member_card_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: member_card_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: member_card_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: member_card_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: member_card_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: member_card_print  
		}
		]
	});
	member_cardListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	member_card_ContextMenu = new Ext.menu.Menu({
		id: 'member_card_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: member_card_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: member_card_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: member_card_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: member_card_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmember_card_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		member_card_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		member_card_SelectedRow=rowIndex;
		member_card_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function member_card_editContextMenu(){
      member_cardListEditorGrid.startEditing(member_card_SelectedRow,1);
  	}
	/* End of Function */
  	
	member_cardListEditorGrid.addListener('rowcontextmenu', onmember_card_ListEditGridContextMenu);
	member_card_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	member_cardListEditorGrid.on('afteredit', member_card_update); // inLine Editing Record
	
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
	/* Identify  card_creator Field */
	card_creatorField= new Ext.form.TextField({
		id: 'card_creatorField',
		fieldLabel: 'Card Creator',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  card_date_create Field */
	card_date_createField= new Ext.form.DateField({
		id: 'card_date_createField',
		fieldLabel: 'Card Date Create',
		format : 'Y-m-d',
	});
	/* Identify  card_update Field */
	card_updateField= new Ext.form.TextField({
		id: 'card_updateField',
		fieldLabel: 'Card Update',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  card_date_update Field */
	card_date_updateField= new Ext.form.DateField({
		id: 'card_date_updateField',
		fieldLabel: 'Card Date Update',
		format : 'Y-m-d',
	});
	/* Identify  card_revised Field */
	card_revisedField= new Ext.form.NumberField({
		id: 'card_revisedField',
		fieldLabel: 'Card Revised',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	member_card_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 600,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [card_noField, card_namaField, card_alamatField, card_nomemberField, card_pointsaldoField, card_creatorField, card_date_createField, card_updateField, card_date_updateField, card_revisedField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: member_card_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					member_card_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	member_card_createWindow= new Ext.Window({
		id: 'member_card_createWindow',
		title: post2db+'Member_card',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_member_card_create',
		items: member_card_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function member_card_list_search(){
		// render according to a SQL date format.
		var card_id_search=null;
		var card_no_search=null;
		var card_nama_search=null;
		var card_alamat_search=null;
		var card_nomember_search=null;
		var card_pointsaldo_search=null;
		var card_creator_search=null;
		var card_date_create_search_date="";
		var card_update_search=null;
		var card_date_update_search_date="";
		var card_revised_search=null;

		if(card_idSearchField.getValue()!==null){card_id_search=card_idSearchField.getValue();}
		if(card_noSearchField.getValue()!==null){card_no_search=card_noSearchField.getValue();}
		if(card_namaSearchField.getValue()!==null){card_nama_search=card_namaSearchField.getValue();}
		if(card_alamatSearchField.getValue()!==null){card_alamat_search=card_alamatSearchField.getValue();}
		if(card_nomemberSearchField.getValue()!==null){card_nomember_search=card_nomemberSearchField.getValue();}
		if(card_pointsaldoSearchField.getValue()!==null){card_pointsaldo_search=card_pointsaldoSearchField.getValue();}
		if(card_creatorSearchField.getValue()!==null){card_creator_search=card_creatorSearchField.getValue();}
		if(card_date_createSearchField.getValue()!==""){card_date_create_search_date=card_date_createSearchField.getValue().format('Y-m-d');}
		if(card_updateSearchField.getValue()!==null){card_update_search=card_updateSearchField.getValue();}
		if(card_date_updateSearchField.getValue()!==""){card_date_update_search_date=card_date_updateSearchField.getValue().format('Y-m-d');}
		if(card_revisedSearchField.getValue()!==null){card_revised_search=card_revisedSearchField.getValue();}
		// change the store parameters
		member_card_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			card_id	:	card_id_search, 
			card_no	:	card_no_search, 
			card_nama	:	card_nama_search, 
			card_alamat	:	card_alamat_search, 
			card_nomember	:	card_nomember_search, 
			card_pointsaldo	:	card_pointsaldo_search, 
			card_creator	:	card_creator_search, 
			card_date_create	:	card_date_create_search_date, 
			card_update	:	card_update_search, 
			card_date_update	:	card_date_update_search_date, 
			card_revised	:	card_revised_search 
};
		// Cause the datastore to do another query : 
		member_card_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function member_card_reset_search(){
		// reset the store parameters
		member_card_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		member_card_DataStore.reload({params: {start: 0, limit: pageS}});
		member_card_searchWindow.close();
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
	/* Identify  card_creator Search Field */
	card_creatorSearchField= new Ext.form.TextField({
		id: 'card_creatorSearchField',
		fieldLabel: 'Card Creator',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  card_date_create Search Field */
	card_date_createSearchField= new Ext.form.DateField({
		id: 'card_date_createSearchField',
		fieldLabel: 'Card Date Create',
		format : 'Y-m-d',
	
	});
	/* Identify  card_update Search Field */
	card_updateSearchField= new Ext.form.TextField({
		id: 'card_updateSearchField',
		fieldLabel: 'Card Update',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  card_date_update Search Field */
	card_date_updateSearchField= new Ext.form.DateField({
		id: 'card_date_updateSearchField',
		fieldLabel: 'Card Date Update',
		format : 'Y-m-d',
	
	});
	/* Identify  card_revised Search Field */
	card_revisedSearchField= new Ext.form.NumberField({
		id: 'card_revisedSearchField',
		fieldLabel: 'Card Revised',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	member_card_searchForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 600,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [card_noSearchField, card_namaSearchField, card_alamatSearchField, card_nomemberSearchField, card_pointsaldoSearchField, card_creatorSearchField, card_date_createSearchField, card_updateSearchField, card_date_updateSearchField, card_revisedSearchField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: member_card_list_search
			},{
				text: 'Close',
				handler: function(){
					member_card_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	member_card_searchWindow = new Ext.Window({
		title: 'member_card Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_member_card_search',
		items: member_card_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!member_card_searchWindow.isVisible()){
			member_card_searchWindow.show();
		} else {
			member_card_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function member_card_print(){
		var searchquery = "";
		var card_no_print=null;
		var card_nama_print=null;
		var card_alamat_print=null;
		var card_nomember_print=null;
		var card_pointsaldo_print=null;
		var card_creator_print=null;
		var card_date_create_print_date="";
		var card_update_print=null;
		var card_date_update_print_date="";
		var card_revised_print=null;
		var win;              
		// check if we do have some search data...
		if(member_card_DataStore.baseParams.query!==null){searchquery = member_card_DataStore.baseParams.query;}
		if(member_card_DataStore.baseParams.card_no!==null){card_no_print = member_card_DataStore.baseParams.card_no;}
		if(member_card_DataStore.baseParams.card_nama!==null){card_nama_print = member_card_DataStore.baseParams.card_nama;}
		if(member_card_DataStore.baseParams.card_alamat!==null){card_alamat_print = member_card_DataStore.baseParams.card_alamat;}
		if(member_card_DataStore.baseParams.card_nomember!==null){card_nomember_print = member_card_DataStore.baseParams.card_nomember;}
		if(member_card_DataStore.baseParams.card_pointsaldo!==null){card_pointsaldo_print = member_card_DataStore.baseParams.card_pointsaldo;}
		if(member_card_DataStore.baseParams.card_creator!==null){card_creator_print = member_card_DataStore.baseParams.card_creator;}
		if(member_card_DataStore.baseParams.card_date_create!==""){card_date_create_print_date = member_card_DataStore.baseParams.card_date_create;}
		if(member_card_DataStore.baseParams.card_update!==null){card_update_print = member_card_DataStore.baseParams.card_update;}
		if(member_card_DataStore.baseParams.card_date_update!==""){card_date_update_print_date = member_card_DataStore.baseParams.card_date_update;}
		if(member_card_DataStore.baseParams.card_revised!==null){card_revised_print = member_card_DataStore.baseParams.card_revised;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_member_card&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			card_no : card_no_print,
			card_nama : card_nama_print,
			card_alamat : card_alamat_print,
			card_nomember : card_nomember_print,
			card_pointsaldo : card_pointsaldo_print,
			card_creator : card_creator_print,
		  	card_date_create : card_date_create_print_date, 
			card_update : card_update_print,
		  	card_date_update : card_date_update_print_date, 
			card_revised : card_revised_print,
		  	currentlisting: member_card_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./member_cardlist.html','member_cardlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function member_card_export_excel(){
		var searchquery = "";
		var card_no_2excel=null;
		var card_nama_2excel=null;
		var card_alamat_2excel=null;
		var card_nomember_2excel=null;
		var card_pointsaldo_2excel=null;
		var card_creator_2excel=null;
		var card_date_create_2excel_date="";
		var card_update_2excel=null;
		var card_date_update_2excel_date="";
		var card_revised_2excel=null;
		var win;              
		// check if we do have some search data...
		if(member_card_DataStore.baseParams.query!==null){searchquery = member_card_DataStore.baseParams.query;}
		if(member_card_DataStore.baseParams.card_no!==null){card_no_2excel = member_card_DataStore.baseParams.card_no;}
		if(member_card_DataStore.baseParams.card_nama!==null){card_nama_2excel = member_card_DataStore.baseParams.card_nama;}
		if(member_card_DataStore.baseParams.card_alamat!==null){card_alamat_2excel = member_card_DataStore.baseParams.card_alamat;}
		if(member_card_DataStore.baseParams.card_nomember!==null){card_nomember_2excel = member_card_DataStore.baseParams.card_nomember;}
		if(member_card_DataStore.baseParams.card_pointsaldo!==null){card_pointsaldo_2excel = member_card_DataStore.baseParams.card_pointsaldo;}
		if(member_card_DataStore.baseParams.card_creator!==null){card_creator_2excel = member_card_DataStore.baseParams.card_creator;}
		if(member_card_DataStore.baseParams.card_date_create!==""){card_date_create_2excel_date = member_card_DataStore.baseParams.card_date_create;}
		if(member_card_DataStore.baseParams.card_update!==null){card_update_2excel = member_card_DataStore.baseParams.card_update;}
		if(member_card_DataStore.baseParams.card_date_update!==""){card_date_update_2excel_date = member_card_DataStore.baseParams.card_date_update;}
		if(member_card_DataStore.baseParams.card_revised!==null){card_revised_2excel = member_card_DataStore.baseParams.card_revised;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_member_card&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			card_no : card_no_2excel,
			card_nama : card_nama_2excel,
			card_alamat : card_alamat_2excel,
			card_nomember : card_nomember_2excel,
			card_pointsaldo : card_pointsaldo_2excel,
			card_creator : card_creator_2excel,
		  	card_date_create : card_date_create_2excel_date, 
			card_update : card_update_2excel,
		  	card_date_update : card_date_update_2excel_date, 
			card_revised : card_revised_2excel,
		  	currentlisting: member_card_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_member_card"></div>
		<div id="elwindow_member_card_create"></div>
        <div id="elwindow_member_card_search"></div>
    </div>
</div>
</body>