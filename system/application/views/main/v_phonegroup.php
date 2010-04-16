<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: phonegroup View
	+ Description	: For record view
	+ Filename 		: v_phonegroup.php
 	+ creator  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
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
var phonegroup_DataStore;
var phonegroup_ColumnModel;
var phonegroupListEditorGrid;
var phonegroup_saveForm;
var phonegroup_saveWindow;
var phonegroup_searchForm;
var phonegroup_searchWindow;
var phonegroup_SelectedRow;
var phonegroup_ContextMenu;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var phonegroup_idField;
var phonegroup_namaField;
var phonegroup_detailField;
var phonegroup_idSearchField;
var phonegroup_namaSearchField;
var phonegroup_detailSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  	Ext.form.Field.prototype.msgTarget = 'side';
	 
  	/* Function for Saving inLine Editing */
	function phonegroup_inline_update(oGrid_event){
		var phonegroup_id_update_pk="";
		var phonegroup_nama_update=null;
		var phonegroup_detail_update=null;

		phonegroup_id_update_pk = oGrid_event.record.data.phonegroup_id;
		if(oGrid_event.record.data.phonegroup_nama!== null){phonegroup_nama_update = oGrid_event.record.data.phonegroup_nama;}
		if(oGrid_event.record.data.phonegroup_detail!== null){phonegroup_detail_update = oGrid_event.record.data.phonegroup_detail;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_phonegroup&m=get_action',
			params: {
				phonegroup_id	: phonegroup_id_update_pk, 
				phonegroup_nama	:phonegroup_nama_update,
				phonegroup_detail	:phonegroup_detail_update,
				task: "UPDATE"
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						phonegroup_DataStore.commitChanges();
						phonegroup_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the Phonegroup.',
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
  
  	/* Function for add and edit data form, open window form */
	function phonegroup_save(){
	
		if(is_phonegroup_form_valid()){	
			var phonegroup_id_field_pk=null; 
			var phonegroup_nama_field=null; 
			var phonegroup_detail_field=null; 

			phonegroup_id_field_pk=get_pk_id();
			if(phonegroup_namaField.getValue()!== null){phonegroup_nama_field = phonegroup_namaField.getValue();} 
			if(phonegroup_detailField.getValue()!== null){phonegroup_detail_field = phonegroup_detailField.getValue();} 

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_phonegroup&m=get_action',
				params: {
					phonegroup_id	: phonegroup_id_field_pk, 
					phonegroup_nama	: phonegroup_nama_field, 
					phonegroup_detail	: phonegroup_detail_field,
					phonegroup_data : phonegroup_saveForm.getForm().findField('itemselector').getValue(),
					task: post2db
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Phonegroup was '+post2db+' successfully.');
							phonegroup_DataStore.reload();
							phonegroup_saveWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Phonegroup.',
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
			return phonegroupListEditorGrid.getSelectionModel().getSelected().get('phonegroup_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function phonegroup_reset_form(){
		phonegroup_namaField.reset();
		phonegroup_namaField.setValue(null);
		phonegroup_detailField.reset();
		phonegroup_detailField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function phonegroup_set_form(){
		phonegroup_namaField.setValue(phonegroupListEditorGrid.getSelectionModel().getSelected().get('phonegroup_nama'));
		phonegroup_detailField.setValue(phonegroupListEditorGrid.getSelectionModel().getSelected().get('phonegroup_detail'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_phonegroup_form_valid(){
		return (phonegroup_namaField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!phonegroup_saveWindow.isVisible()){
			phonegroup_reset_form();
			post2db='CREATE';
			msg='created';
			phonegroup_saveWindow.show();
		} else {
			phonegroup_saveWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function phonegroup_confirm_delete(){
		// only one phonegroup is selected here
		if(phonegroupListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', phonegroup_delete);
		} else if(phonegroupListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', phonegroup_delete);
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
	function phonegroup_confirm_update(){
		/* only one record is selected here */
		if(phonegroupListEditorGrid.selModel.getCount() == 1) {
			phonegroup_set_form();
			post2db='UPDATE';
			msg='updated';
			phonegroup_saveWindow.show();
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
	function phonegroup_delete(btn){
		if(btn=='yes'){
			var selections = phonegroupListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< phonegroupListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.phonegroup_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_phonegroup&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							phonegroup_DataStore.reload();
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
	phonegroup_DataStore = new Ext.data.Store({
		id: 'phonegroup_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_phonegroup&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'phonegroup_id'
		},[
		/* dataIndex => insert intophonegroup_ColumnModel, Mapping => for initiate table column */ 
			{name: 'phonegroup_id', type: 'int', mapping: 'phonegroup_id'}, 
			{name: 'phonegroup_nama', type: 'string', mapping: 'phonegroup_nama'}, 
			{name: 'phonegroup_detail', type: 'string', mapping: 'phonegroup_detail'}, 
			{name: 'phonegroup_creator', type: 'string', mapping: 'phonegroup_creator'}, 
			{name: 'phonegroup_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'phonegroup_date_create'}, 
			{name: 'phonegroup_update', type: 'string', mapping: 'phonegroup_update'}, 
			{name: 'phonegroup_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'phonegroup_date_update'}, 
			{name: 'phonegroup_revised', type: 'int', mapping: 'phonegroup_revised'} 
		]),
		sortInfo:{field: 'phonegroup_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	phonegroup_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'phonegroup_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Nama Group',
			dataIndex: 'phonegroup_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'phonegroup_detail',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'phonegroup_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Create on',
			dataIndex: 'phonegroup_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'phonegroup_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'phonegroup_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Revised',
			dataIndex: 'phonegroup_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}	]);
	
	phonegroup_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	phonegroupListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'phonegroupListEditorGrid',
		el: 'fp_phonegroup',
		title: 'List Of Phonegroup',
		autoHeight: true,
		store: phonegroup_DataStore, // DataStore
		cm: phonegroup_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: phonegroup_DataStore,
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
			handler: phonegroup_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: phonegroup_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: phonegroup_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: phonegroup_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: phonegroup_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: phonegroup_print  
		}
		]
	});
	phonegroupListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	phonegroup_ContextMenu = new Ext.menu.Menu({
		id: 'phonegroup_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: phonegroup_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: phonegroup_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: phonegroup_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: phonegroup_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onphonegroup_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		phonegroup_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		phonegroup_SelectedRow=rowIndex;
		phonegroup_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function phonegroup_editContextMenu(){
		//phonegroupListEditorGrid.startEditing(phonegroup_SelectedRow,1);
		phonegroup_confirm_update();
  	}
	/* End of Function */
  	
	phonegroupListEditorGrid.addListener('rowcontextmenu', onphonegroup_ListEditGridContextMenu);
	phonegroup_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	phonegroupListEditorGrid.on('afteredit', phonegroup_inline_update); // inLine Editing Record
	
	/* Function for Retrieve DataStore */
	phonegrouped_DataStore = new Ext.data.Store({
		id: 'phonegrouped_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_phonegroup&m=get_phonegrouped', 
			method: 'POST'
		}),
		baseParams:{start:0, limit: 15 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'phonenumber_number'
		},[
		/* dataIndex => insert intophonegroup_ColumnModel, Mapping => for initiate table column */ 
			{name: 'phonenumber_number', type: 'string', mapping: 'cust_hp'}, 
			{name: 'phonenumber_nama', type: 'string', mapping: 'cust_nama'}
		]),
		sortInfo:{field: 'phonenumber_nama', direction: "ASC"}
	});
	
	
	
	/* Function for Retrieve DataStore */
	phonenumber_DataStore = new Ext.data.Store({
		id: 'phonenumer_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_phonegroup&m=get_available', 
			method: 'POST'
		}),
		baseParams:{id: get_pk_id(),start:0, limit: 15 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'phonenumber_number'
		},[
		/* dataIndex => insert intophonegroup_ColumnModel, Mapping => for initiate table column */ 
			{name: 'phonenumber_nama', type: 'string', mapping: 'cust_nama'}, 
			{name: 'phonenumber_number', type: 'string', mapping: 'cust_hp'},
			{name: 'phonenumber_no', type: 'string', mapping: 'cust_no'}
		]),
		sortInfo:{field: 'phonenumber_nama', direction: "ASC"}
	});
	
	var cust_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{phonenumber_nama} ({phonenumber_no})</b><br /></span>',
            'No HP: {phonenumber_member}',
        '</div></tpl>'
    );
		
	/* Identify  phonegroup_nama Field */
	phonegroup_namaField= new Ext.form.TextField({
		id: 'phonegroup_namaField',
		fieldLabel: 'Nama Group',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  phonegroup_detail Field */
	phonegroup_detailField= new Ext.form.TextArea({
		id: 'phonegroup_detailField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});

	
	
	/* Function for retrieve create Window Panel*/ 
	phonegroup_saveForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 650,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [phonegroup_namaField, phonegroup_detailField] 
			},{
				labelAlign: 'top',
				bodyStyle:'padding:5px',
				layout: 'form',
				items:[
					{
						xtype: 'itemselector',
						name: 'itemselector',
						fieldLabel: 'Member',
						imagePath: './assets/images/',
						multiselects: [{
							width: 300,
							height: 200,
							store: phonenumber_DataStore,
							displayField: 'phonenumber_nama',
							valueField: 'phonenumber_number',
							tpl: cust_tpl,
							tbar: new Ext.PagingToolbar({
								pageSize: 15,
								store: phonenumber_DataStore,
								displayInfo: false
							})
						},{
							width: 300,
							height: 200,
							store: phonegrouped_DataStore,
							displayField: 'phonenumber_nama',
							valueField: 'phonenumber_number',
							tbar:[new Ext.PagingToolbar({
								pageSize: 15,
								store: phonegrouped_DataStore,
								displayInfo: false,
								listeners:{
									render:function(){
										phonegrouped_DataStore.setBaseParam({id:get_pk_id()});
									}
								}
								}),{
								text: 'Clear',
								xtype: 'button',
								handler:function(){
									phonegroup_saveForm.getForm().findField('itemselector').reset();
								}
								}]
						}]
					}
					]
			}
			],
		buttons: [{
				text: 'Save and Close',
				handler: phonegroup_save
			}
			,{
				text: 'Cancel',
				handler: function(){
					phonegroup_saveWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	phonegroup_saveWindow= new Ext.Window({
		id: 'phonegroup_saveWindow',
		title: post2db+'Phonegroup',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_phonegroup_save',
		items: phonegroup_saveForm
	});
	/* End Window */
	
	/* Function for action list search */
	function phonegroup_list_search(){
		// render according to a SQL date format.
		var phonegroup_id_search=null;
		var phonegroup_nama_search=null;
		var phonegroup_detail_search=null;

		if(phonegroup_idSearchField.getValue()!==null){phonegroup_id_search=phonegroup_idSearchField.getValue();}
		if(phonegroup_namaSearchField.getValue()!==null){phonegroup_nama_search=phonegroup_namaSearchField.getValue();}
		if(phonegroup_detailSearchField.getValue()!==null){phonegroup_detail_search=phonegroup_detailSearchField.getValue();}
		// change the store parameters
		phonegroup_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			phonegroup_id	:	phonegroup_id_search, 
			phonegroup_nama	:	phonegroup_nama_search, 
			phonegroup_detail	:	phonegroup_detail_search, 
		};
		// Cause the datastore to do another query : 
		phonegroup_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function phonegroup_reset_search(){
		// reset the store parameters
		phonegroup_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		phonegroup_DataStore.reload({params: {start: 0, limit: pageS}});
		phonegroup_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  phonegroup_id Search Field */
	phonegroup_idSearchField= new Ext.form.NumberField({
		id: 'phonegroup_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  phonegroup_nama Search Field */
	phonegroup_namaSearchField= new Ext.form.TextField({
		id: 'phonegroup_namaSearchField',
		fieldLabel: 'Nama Group',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  phonegroup_detail Search Field */
	phonegroup_detailSearchField= new Ext.form.TextArea({
		id: 'phonegroup_detailSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	phonegroup_searchForm = new Ext.FormPanel({
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
				items: [phonegroup_namaSearchField, phonegroup_detailSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: phonegroup_list_search
			},{
				text: 'Close',
				handler: function(){
					phonegroup_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	phonegroup_searchWindow = new Ext.Window({
		title: 'Phonegroup Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_phonegroup_search',
		items: phonegroup_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!phonegroup_searchWindow.isVisible()){
			phonegroup_searchWindow.show();
		} else {
			phonegroup_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function phonegroup_print(){
		var searchquery = "";
		var phonegroup_nama_print=null;
		var phonegroup_detail_print=null;
		var win;              
		// check if we do have some search data...
		if(phonegroup_DataStore.baseParams.query!==null){searchquery = phonegroup_DataStore.baseParams.query;}
		if(phonegroup_DataStore.baseParams.phonegroup_nama!==null){phonegroup_nama_print = phonegroup_DataStore.baseParams.phonegroup_nama;}
		if(phonegroup_DataStore.baseParams.phonegroup_detail!==null){phonegroup_detail_print = phonegroup_DataStore.baseParams.phonegroup_detail;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_phonegroup&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			phonegroup_nama : phonegroup_nama_print,
			phonegroup_detail : phonegroup_detail_print,
		  	currentlisting: phonegroup_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/phonegroup_printlist.html','phonegrouplist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function phonegroup_export_excel(){
		var searchquery = "";
		var phonegroup_nama_2excel=null;
		var phonegroup_detail_2excel=null;
		var win;              
		// check if we do have some search data...
		if(phonegroup_DataStore.baseParams.query!==null){searchquery = phonegroup_DataStore.baseParams.query;}
		if(phonegroup_DataStore.baseParams.phonegroup_nama!==null){phonegroup_nama_2excel = phonegroup_DataStore.baseParams.phonegroup_nama;}
		if(phonegroup_DataStore.baseParams.phonegroup_detail!==null){phonegroup_detail_2excel = phonegroup_DataStore.baseParams.phonegroup_detail;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_phonegroup&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			phonegroup_nama : phonegroup_nama_2excel,
			phonegroup_detail : phonegroup_detail_2excel,
		  	currentlisting: phonegroup_DataStore.baseParams.task // this tells us if we are searching or not
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
	phonegroup_saveWindow.on("show",function(){
			phonegrouped_DataStore.setBaseParam('id',get_pk_id());
			phonenumber_DataStore.setBaseParam('id',get_pk_id());
			phonenumber_DataStore.load();
			phonegrouped_DataStore.load();
	});
	
		
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_phonegroup"></div>
		<div id="elwindow_phonegroup_save"></div>
        <div id="elwindow_phonegroup_search"></div>
    </div>
</div>
</body>