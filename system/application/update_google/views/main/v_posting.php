<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: posting View
	+ Description	: For record view
	+ Filename 		: v_posting.php
 	+ Author  		: 
 	+ Created on 06/Oct/2009 08:24:57
	
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
var posting_DataStore;
var posting_ColumnModel;
var postingListEditorGrid;
var posting_createForm;
var posting_createWindow;
var posting_searchForm;
var posting_searchWindow;
var posting_SelectedRow;
var posting_ContextMenu;
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
var posting_idField;
var posting_tglmulaiField;
var posting_tglselesaiField;
var posting_idSearchField;
var posting_tglmulaiSearchField;
var posting_tglselesaiSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function posting_update(oGrid_event){
		var posting_id_update_pk="";
		var posting_tglmulai_update_date="";
		var posting_tglselesai_update_date="";

		posting_id_update_pk = oGrid_event.record.data.posting_id;
	 	if(oGrid_event.record.data.posting_tglmulai!== ""){posting_tglmulai_update_date =oGrid_event.record.data.posting_tglmulai.format('Y-m-d');}
	 	if(oGrid_event.record.data.posting_tglselesai!== ""){posting_tglselesai_update_date =oGrid_event.record.data.posting_tglselesai.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_posting&m=get_action',
			params: {
				task: "UPDATE",
				posting_id	: posting_id_update_pk, 
				posting_tglmulai	: posting_tglmulai_update_date, 
				posting_tglselesai	: posting_tglselesai_update_date, 
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						posting_DataStore.commitChanges();
						posting_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the posting.',
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
	function posting_create(){
	
		if(is_posting_form_valid()){	
		var posting_id_create_pk=null; 
		var posting_tglmulai_create_date=""; 
		var posting_tglselesai_create_date=""; 

		if(posting_idField.getValue()!== null){posting_id_create_pk = posting_idField.getValue();}else{posting_id_create_pk=get_pk_id();} 
		if(posting_tglmulaiField.getValue()!== ""){posting_tglmulai_create_date = posting_tglmulaiField.getValue().format('Y-m-d');} 
		if(posting_tglselesaiField.getValue()!== ""){posting_tglselesai_create_date = posting_tglselesaiField.getValue().format('Y-m-d');} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_posting&m=get_action',
			params: {
				task: post2db,
				posting_id	: posting_id_create_pk, 
				posting_tglmulai	: posting_tglmulai_create_date, 
				posting_tglselesai	: posting_tglselesai_create_date, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						Ext.MessageBox.alert(post2db+' OK','The Posting was '+msg+' successfully.');
						posting_DataStore.reload();
						posting_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Posting.',
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
			return postingListEditorGrid.getSelectionModel().getSelected().get('posting_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function posting_reset_form(){
		posting_idField.reset();
		posting_idField.setValue(null);
		posting_tglmulaiField.reset();
		posting_tglmulaiField.setValue(null);
		posting_tglselesaiField.reset();
		posting_tglselesaiField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function posting_set_form(){
		posting_idField.setValue(postingListEditorGrid.getSelectionModel().getSelected().get('posting_id'));
		posting_tglmulaiField.setValue(postingListEditorGrid.getSelectionModel().getSelected().get('posting_tglmulai'));
		posting_tglselesaiField.setValue(postingListEditorGrid.getSelectionModel().getSelected().get('posting_tglselesai'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_posting_form_valid(){
		return (true &&  posting_tglmulaiField.isValid() && posting_tglselesaiField.isValid() );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!posting_createWindow.isVisible()){
			posting_reset_form();
			post2db='CREATE';
			msg='created';
			posting_createWindow.show();
		} else {
			posting_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function posting_confirm_delete(){
		// only one posting is selected here
		if(postingListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', posting_delete);
		} else if(postingListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', posting_delete);
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
	function posting_confirm_update(){
		/* only one record is selected here */
		if(postingListEditorGrid.selModel.getCount() == 1) {
			posting_set_form();
			post2db='UPDATE';
			msg='updated';
			posting_createWindow.show();
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
	function posting_delete(btn){
		if(btn=='yes'){
			var selections = postingListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< postingListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.posting_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_posting&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							posting_DataStore.reload();
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
	posting_DataStore = new Ext.data.Store({
		id: 'posting_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_posting&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'posting_id'
		},[
		/* dataIndex => insert intoposting_ColumnModel, Mapping => for initiate table column */ 
			{name: 'posting_id', type: 'int', mapping: 'posting_id'}, 
			{name: 'posting_tglmulai', type: 'date', dateFormat: 'Y-m-d', mapping: 'posting_tglmulai'}, 
			{name: 'posting_tglselesai', type: 'date', dateFormat: 'Y-m-d', mapping: 'posting_tglselesai'}, 
			{name: 'posting_creator', type: 'string', mapping: 'posting_creator'}, 
			{name: 'posting_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'posting_date_create'}, 
			{name: 'posting_update', type: 'string', mapping: 'posting_update'}, 
			{name: 'posting_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'posting_date_update'}, 
			{name: 'posting_revised', type: 'int', mapping: 'posting_revised'} 
		]),
		sortInfo:{field: 'posting_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	posting_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'posting_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Tgl awal posting',
			dataIndex: 'posting_tglmulai',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Tgl akhir posting',
			dataIndex: 'posting_tglselesai',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Creator',
			dataIndex: 'posting_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Posting on',
			dataIndex: 'posting_date_create',
			width: 150,
			sortable: true,
			hidden: false,
			readOnly: true,
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'posting_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'posting_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'posting_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	posting_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	postingListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'postingListEditorGrid',
		el: 'fp_posting',
		title: 'List Of Posting',
		autoHeight: true,
		store: posting_DataStore, // DataStore
		cm: posting_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: posting_DataStore,
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
			handler: posting_confirm_update   // Confirm before updating
		}/*, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: posting_confirm_delete   // Confirm before deleting
		}*/, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: posting_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: posting_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: posting_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: posting_print  
		}
		]
	});
	postingListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	posting_ContextMenu = new Ext.menu.Menu({
		id: 'posting_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: posting_editContextMenu 
		},
		/*{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: posting_confirm_delete 
		},*/
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: posting_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: posting_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onposting_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		posting_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		posting_SelectedRow=rowIndex;
		posting_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function posting_editContextMenu(){
		postingListEditorGrid.startEditing(posting_SelectedRow,1);
  	}
	/* End of Function */
  	
	postingListEditorGrid.addListener('rowcontextmenu', onposting_ListEditGridContextMenu);
	posting_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	postingListEditorGrid.on('afteredit', posting_update); // inLine Editing Record
	
	/* Identify  posting_id Field */
	posting_idField= new Ext.form.NumberField({
		id: 'posting_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  posting_tglmulai Field */
	posting_tglmulaiField= new Ext.form.DateField({
		id: 'posting_tglmulaiField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		allowBlank: false,
	});
	/* Identify  posting_tglselesai Field */
	posting_tglselesaiField= new Ext.form.DateField({
		id: 'posting_tglselesaiField',
		fieldLabel: 's/d ',
		format : 'Y-m-d',
		allowBlank: false,
	});

	
	
	/* Function for retrieve create Window Panel*/ 
	posting_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		//bodyStyle:'padding:5px',
		autoHeight:true,
		width: 250,        
		items:[{
			   	layout:'column',
				border:false,
				items:[{
					columnWidth:0.5,
					layout: 'form',
					border:false,
					items: [posting_tglmulaiField] 
				},
				{
					columnWidth:0.5,
					layout: 'form',
					border:false,
					items: [posting_tglselesaiField, posting_idField] 
				}]
			   }
			],
		buttons: [{
				text: 'Save and Close',
				handler: posting_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					posting_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	posting_createWindow= new Ext.Window({
		id: 'posting_createWindow',
		title: post2db+'Posting',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_posting_create',
		items: posting_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function posting_list_search(){
		// render according to a SQL date format.
		var posting_id_search=null;
		var posting_tglmulai_search_date="";
		var posting_tglselesai_search_date="";

		if(posting_idSearchField.getValue()!==null){posting_id_search=posting_idSearchField.getValue();}
		if(posting_tglmulaiSearchField.getValue()!==""){posting_tglmulai_search_date=posting_tglmulaiSearchField.getValue().format('Y-m-d');}
		if(posting_tglselesaiSearchField.getValue()!==""){posting_tglselesai_search_date=posting_tglselesaiSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		posting_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			posting_id	:	posting_id_search, 
			posting_tglmulai	:	posting_tglmulai_search_date, 
			posting_tglselesai	:	posting_tglselesai_search_date, 
		};
		// Cause the datastore to do another query : 
		posting_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function posting_reset_search(){
		// reset the store parameters
		posting_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		posting_DataStore.reload({params: {start: 0, limit: pageS}});
		posting_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  posting_id Search Field */
	posting_idSearchField= new Ext.form.NumberField({
		id: 'posting_idSearchField',
		fieldLabel: 'Posting Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  posting_tglmulai Search Field */
	posting_tglmulaiSearchField= new Ext.form.DateField({
		id: 'posting_tglmulaiSearchField',
		fieldLabel: 'Posting Tglmulai',
		format : 'Y-m-d',
	
	});
	/* Identify  posting_tglselesai Search Field */
	posting_tglselesaiSearchField= new Ext.form.DateField({
		id: 'posting_tglselesaiSearchField',
		fieldLabel: 'Posting Tglselesai',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	posting_searchForm = new Ext.FormPanel({
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
				items: [posting_tglmulaiSearchField, posting_tglselesaiSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: posting_list_search
			},{
				text: 'Close',
				handler: function(){
					posting_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	posting_searchWindow = new Ext.Window({
		title: 'posting Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_posting_search',
		items: posting_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!posting_searchWindow.isVisible()){
			posting_searchWindow.show();
		} else {
			posting_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function posting_print(){
		var searchquery = "";
		var posting_tglmulai_print_date="";
		var posting_tglselesai_print_date="";
		var win;              
		// check if we do have some search data...
		if(posting_DataStore.baseParams.query!==null){searchquery = posting_DataStore.baseParams.query;}
		if(posting_DataStore.baseParams.posting_tglmulai!==""){posting_tglmulai_print_date = posting_DataStore.baseParams.posting_tglmulai;}
		if(posting_DataStore.baseParams.posting_tglselesai!==""){posting_tglselesai_print_date = posting_DataStore.baseParams.posting_tglselesai;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_posting&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	posting_tglmulai : posting_tglmulai_print_date, 
		  	posting_tglselesai : posting_tglselesai_print_date, 
		  	currentlisting: posting_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./postinglist.html','postinglist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function posting_export_excel(){
		var searchquery = "";
		var posting_tglmulai_2excel_date="";
		var posting_tglselesai_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(posting_DataStore.baseParams.query!==null){searchquery = posting_DataStore.baseParams.query;}
		if(posting_DataStore.baseParams.posting_tglmulai!==""){posting_tglmulai_2excel_date = posting_DataStore.baseParams.posting_tglmulai;}
		if(posting_DataStore.baseParams.posting_tglselesai!==""){posting_tglselesai_2excel_date = posting_DataStore.baseParams.posting_tglselesai;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_posting&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	posting_tglmulai : posting_tglmulai_2excel_date, 
		  	posting_tglselesai : posting_tglselesai_2excel_date, 
		  	currentlisting: posting_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_posting"></div>
		<div id="elwindow_posting_create"></div>
        <div id="elwindow_posting_search"></div>
    </div>
</div>
</body>