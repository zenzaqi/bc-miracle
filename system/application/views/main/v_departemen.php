<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: departemen View
	+ Description	: For record view
	+ Filename 		: v_departemen.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 06/Aug/2009 15:46:36
	
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
var departemen_DataStore;
var departemen_ColumnModel;
var departemenListEditorGrid;
var departemen_createForm;
var departemen_createWindow;
var departemen_searchForm;
var departemen_searchWindow;
var departemen_SelectedRow;
var departemen_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var departemen_idField;
var departemen_namaField;
var departemen_keteranganField;
var departemen_aktifField;

var departemen_idSearchField;
var departemen_namaSearchField;
var departemen_keteranganSearchField;
var departemen_aktifSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function departemen_update(oGrid_event){
	var departemen_id_update_pk="";
	var departemen_nama_update=null;
	var departemen_keterangan_update=null;
	var departemen_aktif_update=null;

	departemen_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.departemen_nama!== null){departemen_nama_update = oGrid_event.record.data.departemen_nama;}
	if(oGrid_event.record.data.departemen_keterangan!== null){departemen_keterangan_update = oGrid_event.record.data.departemen_keterangan;}
	if(oGrid_event.record.data.departemen_aktif!== null){departemen_aktif_update = oGrid_event.record.data.departemen_aktif;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_departemen&m=get_action',
			params: {
				task: "UPDATE",
				departemen_id	: get_pk_id(),				
				departemen_nama	:departemen_nama_update,		
				departemen_keterangan	:departemen_keterangan_update,		
				departemen_aktif	:departemen_aktif_update,		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						departemen_DataStore.commitChanges();
						departemen_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the departemen.',
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
	function departemen_create(){
		if(is_departemen_form_valid()){
		
		var departemen_id_create_pk=null;
		var departemen_nama_create=null;
		var departemen_keterangan_create=null;
		var departemen_aktif_create=null;

		departemen_id_create_pk=get_pk_id();
		if(departemen_namaField.getValue()!== null){departemen_nama_create = departemen_namaField.getValue();}
		if(departemen_keteranganField.getValue()!== null){departemen_keterangan_create = departemen_keteranganField.getValue();}
		if(departemen_aktifField.getValue()!== null){departemen_aktif_create = departemen_aktifField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_departemen&m=get_action',
				params: {
					task: post2db,
					departemen_id	: departemen_id_create_pk,	
					departemen_nama	: departemen_nama_create,	
					departemen_keterangan	: departemen_keterangan_create,	
					departemen_aktif	: departemen_aktif_create,	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Departemen was '+msg+' successfully.');
							departemen_DataStore.reload();
							departemen_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Departemen.',
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
			return departemenListEditorGrid.getSelectionModel().getSelected().get('departemen_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function departemen_reset_form(){
		departemen_namaField.reset();
		departemen_namaField.setValue(null);
		departemen_keteranganField.reset();
		departemen_keteranganField.setValue(null);
		departemen_aktifField.reset();
		departemen_aktifField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function departemen_set_form(){
		departemen_namaField.setValue(departemenListEditorGrid.getSelectionModel().getSelected().get('departemen_nama'));
		departemen_keteranganField.setValue(departemenListEditorGrid.getSelectionModel().getSelected().get('departemen_keterangan'));
		departemen_aktifField.setValue(departemenListEditorGrid.getSelectionModel().getSelected().get('departemen_aktif'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_departemen_form_valid(){
		return (departemen_namaField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!departemen_createWindow.isVisible()){
			departemen_reset_form();
			post2db='CREATE';
			msg='created';
			departemen_createWindow.show();
		} else {
			departemen_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function departemen_confirm_delete(){
		// only one departemen is selected here
		if(departemenListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', departemen_delete);
		} else if(departemenListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', departemen_delete);
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
	function departemen_confirm_update(){
		/* only one record is selected here */
		if(departemenListEditorGrid.selModel.getCount() == 1) {
			departemen_set_form();
			post2db='UPDATE';
			msg='updated';
			departemen_createWindow.show();
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
	function departemen_delete(btn){
		if(btn=='yes'){
			var selections = departemenListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< departemenListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.departemen_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_departemen&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							departemen_DataStore.reload();
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
	departemen_DataStore = new Ext.data.Store({
		id: 'departemen_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_departemen&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'departemen_id'
		},[
		/* dataIndex => insert intodepartemen_ColumnModel, Mapping => for initiate table column */ 
			{name: 'departemen_id', type: 'int', mapping: 'departemen_id'},
			{name: 'departemen_nama', type: 'string', mapping: 'departemen_nama'},
			{name: 'departemen_keterangan', type: 'string', mapping: 'departemen_keterangan'},
			{name: 'departemen_aktif', type: 'string', mapping: 'departemen_aktif'},
			{name: 'departemen_creator', type: 'string', mapping: 'departemen_creator'},
			{name: 'departemen_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'departemen_date_create'},
			{name: 'departemen_update', type: 'string', mapping: 'departemen_update'},
			{name: 'departemen_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'departemen_date_update'},
			{name: 'departemen_revised', type: 'int', mapping: 'departemen_revised'}
		]),
		sortInfo:{field: 'departemen_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	departemen_ColumnModel = new Ext.grid.ColumnModel(
		[/*{
			header: '#',
			readOnly: true,
			dataIndex: 'departemen_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},*/
		{
			/*index=1*/
			header: 'Nama',
			dataIndex: 'departemen_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 250
          	})
		},
		{
			/*index=2*/
			header: 'Keterangan',
			dataIndex: 'departemen_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 255
          	})
		},
		{
			/*index=3*/
			header: 'Status',
			dataIndex: 'departemen_aktif',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['departemen_aktif_value', 'departemen_aktif_display'],
					data: [['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
					}),
				mode: 'local',
               	displayField: 'departemen_aktif_display',
               	valueField: 'departemen_aktif_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			/*index=4*/
			header: 'Creator',
			dataIndex: 'departemen_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		},
		{
			/*index=5*/
			header: 'Create on',
			dataIndex: 'departemen_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true,
			readOnly: true
		},
		{
			/*index=6*/
			header: 'Last Update by',
			dataIndex: 'departemen_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		},
		{
			/*index=7*/
			header: 'Last Update on',
			dataIndex: 'departemen_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true,
			readOnly: true
		},
		{
			/*index=8*/
			header: 'Revised',
			dataIndex: 'departemen_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}]
	);
	departemen_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	departemenListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'departemenListEditorGrid',
		el: 'fp_departemen',
		title: 'List Of Departemen',
		autoHeight: true,
		store: departemen_DataStore, // DataStore
		cm: departemen_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: departemen_DataStore,
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
			handler: departemen_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled:true,
			handler: departemen_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: departemen_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: departemen_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: departemen_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: departemen_print  
		}
		]
	});
	departemenListEditorGrid.render();
	/* End of DataStore */
	
	/*departemenListEditorGrid.getColumnModel().setHidden(4, true);
	departemenListEditorGrid.getColumnModel().setHidden(5, true);
	departemenListEditorGrid.getColumnModel().setHidden(6, true);
	departemenListEditorGrid.getColumnModel().setHidden(7, true);
	departemenListEditorGrid.getColumnModel().setHidden(8, true);*/
     
	/* Create Context Menu */
	departemen_ContextMenu = new Ext.menu.Menu({
		id: 'departemen_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: departemen_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: departemen_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: departemen_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: departemen_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function ondepartemen_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		departemen_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		departemen_SelectedRow=rowIndex;
		departemen_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function departemen_editContextMenu(){
      departemenListEditorGrid.startEditing(departemen_SelectedRow,1);
  	}
	/* End of Function */
  	
	departemenListEditorGrid.addListener('rowcontextmenu', ondepartemen_ListEditGridContextMenu);
	departemen_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	departemenListEditorGrid.on('afteredit', departemen_update); // inLine Editing Record
	
	/* Identify  departemen_nama Field */
	departemen_namaField= new Ext.form.TextField({
		id: 'departemen_namaField',
		fieldLabel: 'Nama <span style="color: #ec0000">*</span>',
		maxLength: 250,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  departemen_keterangan Field */
	departemen_keteranganField= new Ext.form.TextArea({
		id: 'departemen_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 255,
		anchor: '95%'
	});
	/* Identify  departemen_aktif Field */
	departemen_aktifField= new Ext.form.ComboBox({
		id: 'departemen_aktifField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['departemen_aktif_value', 'departemen_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		editable:false,
		emptyText: 'Aktif',
		displayField: 'departemen_aktif_display',
		valueField: 'departemen_aktif_value',
		width: 80,
		triggerAction: 'all'	
	});
  	
	/* Function for retrieve create Window Panel*/ 
	departemen_createForm = new Ext.FormPanel({
		labelAlign: 'left',
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
				items: [departemen_namaField, departemen_keteranganField, departemen_aktifField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: departemen_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					departemen_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	departemen_createWindow= new Ext.Window({
		id: 'departemen_createWindow',
		title: post2db+'Departemen',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_departemen_create',
		items: departemen_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function departemen_list_search(){
		// render according to a SQL date format.
		var departemen_id_search=null;
		var departemen_nama_search=null;
		var departemen_keterangan_search=null;
		var departemen_aktif_search=null;

		if(departemen_idSearchField.getValue()!==null){departemen_id_search=departemen_idSearchField.getValue();}
		if(departemen_namaSearchField.getValue()!==null){departemen_nama_search=departemen_namaSearchField.getValue();}
		if(departemen_keteranganSearchField.getValue()!==null){departemen_keterangan_search=departemen_keteranganSearchField.getValue();}
		if(departemen_aktifSearchField.getValue()!==null){departemen_aktif_search=departemen_aktifSearchField.getValue();}
		// change the store parameters
		departemen_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			departemen_id	:	departemen_id_search, 
			departemen_nama	:	departemen_nama_search, 
			departemen_keterangan	:	departemen_keterangan_search, 
			departemen_aktif	:	departemen_aktif_search, 
		};
		// Cause the datastore to do another query : 
		departemen_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function departemen_reset_search(){
		// reset the store parameters
		departemen_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		departemen_DataStore.reload({params: {start: 0, limit: pageS}});
		departemen_searchWindow.close();
	};
	/* End of Fuction */
	
	function departemen_reset_SearchForm(){
		departemen_namaSearchField.reset();
		departemen_namaSearchField.setValue(null);
		departemen_keteranganSearchField.reset();
		departemen_keteranganSearchField.setValue(null);
		departemen_aktifSearchField.reset();
		departemen_aktifSearchField.setValue(null);
	}
	
	/* Field for search */
	/* Identify  departemen_id Search Field */
	departemen_idSearchField= new Ext.form.NumberField({
		id: 'departemen_idSearchField',
		fieldLabel: 'Departemen Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  departemen_nama Search Field */
	departemen_namaSearchField= new Ext.form.TextField({
		id: 'departemen_namaSearchField',
		fieldLabel: 'Nama Departemen',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  departemen_keterangan Search Field */
	departemen_keteranganSearchField= new Ext.form.TextField({
		id: 'departemen_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 255,
		anchor: '95%'
	
	});
	/* Identify  departemen_aktif Search Field */
	departemen_aktifSearchField= new Ext.form.ComboBox({
		id: 'departemen_aktifSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'departemen_aktif'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		displayField: 'departemen_aktif',
		valueField: 'value',
		width: 80,
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	departemen_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
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
				items: [departemen_namaSearchField, departemen_keteranganSearchField, departemen_aktifSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: departemen_list_search
			},{
				text: 'Close',
				handler: function(){
					departemen_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	departemen_searchWindow = new Ext.Window({
		title: 'departemen Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_departemen_search',
		items: departemen_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!departemen_searchWindow.isVisible()){
			departemen_reset_SearchForm();
			departemen_searchWindow.show();
		} else {
			departemen_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function departemen_print(){
		var searchquery = "";
		var departemen_nama_print=null;
		var departemen_keterangan_print=null;
		var departemen_aktif_print=null;
		var win;              
		// check if we do have some search data...
		if(departemen_DataStore.baseParams.query!==null){searchquery = departemen_DataStore.baseParams.query;}
		if(departemen_DataStore.baseParams.departemen_nama!==null){departemen_nama_print = departemen_DataStore.baseParams.departemen_nama;}
		if(departemen_DataStore.baseParams.departemen_keterangan!==null){departemen_keterangan_print = departemen_DataStore.baseParams.departemen_keterangan;}
		if(departemen_DataStore.baseParams.departemen_aktif!==null){departemen_aktif_print = departemen_DataStore.baseParams.departemen_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_departemen&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			departemen_nama : departemen_nama_print,
			departemen_keterangan : departemen_keterangan_print,
			departemen_aktif : departemen_aktif_print,
		  	currentlisting: departemen_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./departemenlist.html','departemenlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function departemen_export_excel(){
		var searchquery = "";
		var departemen_nama_2excel=null;
		var departemen_keterangan_2excel=null;
		var departemen_aktif_2excel=null;
		var win;              
		// check if we do have some search data...
		if(departemen_DataStore.baseParams.query!==null){searchquery = departemen_DataStore.baseParams.query;}
		if(departemen_DataStore.baseParams.departemen_nama!==null){departemen_nama_2excel = departemen_DataStore.baseParams.departemen_nama;}
		if(departemen_DataStore.baseParams.departemen_keterangan!==null){departemen_keterangan_2excel = departemen_DataStore.baseParams.departemen_keterangan;}
		if(departemen_DataStore.baseParams.departemen_aktif!==null){departemen_aktif_2excel = departemen_DataStore.baseParams.departemen_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_departemen&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			departemen_nama : departemen_nama_2excel,
			departemen_keterangan : departemen_keterangan_2excel,
			departemen_aktif : departemen_aktif_2excel,
		  	currentlisting: departemen_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_departemen"></div>
		<div id="elwindow_departemen_create"></div>
        <div id="elwindow_departemen_search"></div>
    </div>
</div>
</body>