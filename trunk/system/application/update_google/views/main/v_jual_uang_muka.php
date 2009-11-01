<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jual_uang_muka View
	+ Description	: For record view
	+ Filename 		: v_jual_uang_muka.php
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
var jual_uang_muka_DataStore;
var jual_uang_muka_ColumnModel;
var jual_uang_mukaListEditorGrid;
var jual_uang_muka_createForm;
var jual_uang_muka_createWindow;
var jual_uang_muka_searchForm;
var jual_uang_muka_searchWindow;
var jual_uang_muka_SelectedRow;
var jual_uang_muka_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var dp_nobuktiField;
var dp_tanggalField;
var dp_nilaiField;
var dp_transField;
var dp_nobuktiSearchField;
var dp_tanggalSearchField;
var dp_nilaiSearchField;
var dp_transSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jual_uang_muka_update(oGrid_event){
	var dp_nobukti_update_pk="";
	var dp_tanggal_update_date="";
	var dp_nilai_update=null;
	var dp_trans_update=null;

	dp_nobukti_update_pk = get_pk_id();
	 if(oGrid_event.record.data.dp_tanggal!== ""){dp_tanggal_update_date = oGrid_event.record.data.dp_tanggal.format('Y-m-d');}
	if(oGrid_event.record.data.dp_nilai!== null){dp_nilai_update = oGrid_event.record.data.dp_nilai;}
	if(oGrid_event.record.data.dp_trans!== null){dp_trans_update = oGrid_event.record.data.dp_trans;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jual_uang_muka&m=get_action',
			params: {
				task: "UPDATE",
				dp_nobukti	: get_pk_id(),				dp_tanggal	: dp_tanggal_update_date,				dp_nilai	:dp_nilai_update,		
				dp_trans	:dp_trans_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jual_uang_muka_DataStore.commitChanges();
						jual_uang_muka_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the jual_uang_muka.',
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
	function jual_uang_muka_create(){
		if(is_jual_uang_muka_form_valid()){
		
		var dp_nobukti_create=null;
		var dp_tanggal_create_date="";
		var dp_nilai_create=null;
		var dp_trans_create=null;

		if(dp_nobuktiField.getValue()!== null){dp_nobukti_create = dp_nobuktiField.getValue();}
		if(dp_tanggalField.getValue()!== ""){dp_tanggal_create_date = dp_tanggalField.getValue().format('Y-m-d');}
		if(dp_nilaiField.getValue()!== null){dp_nilai_create = dp_nilaiField.getValue();}
		if(dp_transField.getValue()!== null){dp_trans_create = dp_transField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jual_uang_muka&m=get_action',
				params: {
					task: post2db,
					dp_nobukti	: dp_nobukti_create_pk,	
					dp_tanggal	: dp_tanggal_create_date,					dp_nilai	: dp_nilai_create,	
					dp_trans	: dp_trans_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Jual_uang_muka was '+msg+' successfully.');
							jual_uang_muka_DataStore.reload();
							jual_uang_muka_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Jual_uang_muka.',
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
			return jual_uang_mukaListEditorGrid.getSelectionModel().getSelected().get('dp_nobukti');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jual_uang_muka_reset_form(){
		dp_tanggalField.reset();
		dp_nilaiField.reset();
		dp_transField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jual_uang_muka_set_form(){
		dp_nobuktiField.setValue(jual_uang_mukaListEditorGrid.getSelectionModel().getSelected().get('dp_nobukti'));
		dp_tanggalField.setValue(jual_uang_mukaListEditorGrid.getSelectionModel().getSelected().get('dp_tanggal'));
		dp_nilaiField.setValue(jual_uang_mukaListEditorGrid.getSelectionModel().getSelected().get('dp_nilai'));
		dp_transField.setValue(jual_uang_mukaListEditorGrid.getSelectionModel().getSelected().get('dp_trans'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jual_uang_muka_form_valid(){
		return (dp_nobuktiField.isValid() && dp_tanggalField.isValid() && true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jual_uang_muka_createWindow.isVisible()){
			jual_uang_muka_reset_form();
			post2db='CREATE';
			msg='created';
			jual_uang_muka_createWindow.show();
		} else {
			jual_uang_muka_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jual_uang_muka_confirm_delete(){
		// only one jual_uang_muka is selected here
		if(jual_uang_mukaListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jual_uang_muka_delete);
		} else if(jual_uang_mukaListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jual_uang_muka_delete);
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
	function jual_uang_muka_confirm_update(){
		/* only one record is selected here */
		if(jual_uang_mukaListEditorGrid.selModel.getCount() == 1) {
			jual_uang_muka_set_form();
			post2db='UPDATE';
			msg='updated';
			jual_uang_muka_createWindow.show();
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
	function jual_uang_muka_delete(btn){
		if(btn=='yes'){
			var selections = jual_uang_mukaListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jual_uang_mukaListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.dp_nobukti);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jual_uang_muka&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jual_uang_muka_DataStore.reload();
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
	jual_uang_muka_DataStore = new Ext.data.Store({
		id: 'jual_uang_muka_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jual_uang_muka&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'dp_nobukti'
		},[
		/* dataIndex => insert intojual_uang_muka_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dp_nobukti', type: 'string', mapping: 'dp_nobukti'},
			{name: 'dp_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'dp_tanggal'},
			{name: 'dp_nilai', type: 'float', mapping: 'dp_nilai'},
			{name: 'dp_trans', type: 'string', mapping: 'dp_trans'}
		]),
		sortInfo:{field: 'dp_nobukti', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	jual_uang_muka_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'dp_nobukti',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Dp Tanggal',
			dataIndex: 'dp_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		},
		{
			header: 'Dp Nilai',
			dataIndex: 'dp_nilai',
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
			header: 'Dp Trans',
			dataIndex: 'dp_trans',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dp_trans_value', 'dp_trans_display'],
					data: [['produk','produk'],['perawatan','perawatan'],['paket','paket']]
					}),
				mode: 'local',
               	displayField: 'dp_trans_display',
               	valueField: 'dp_trans_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}]
	);
	jual_uang_muka_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	jual_uang_mukaListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jual_uang_mukaListEditorGrid',
		el: 'fp_jual_uang_muka',
		title: 'List Of Jual_uang_muka',
		autoHeight: true,
		store: jual_uang_muka_DataStore, // DataStore
		cm: jual_uang_muka_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jual_uang_muka_DataStore,
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
			handler: jual_uang_muka_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jual_uang_muka_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jual_uang_muka_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jual_uang_muka_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jual_uang_muka_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jual_uang_muka_print  
		}
		]
	});
	jual_uang_mukaListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jual_uang_muka_ContextMenu = new Ext.menu.Menu({
		id: 'jual_uang_muka_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jual_uang_muka_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jual_uang_muka_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jual_uang_muka_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jual_uang_muka_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjual_uang_muka_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jual_uang_muka_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jual_uang_muka_SelectedRow=rowIndex;
		jual_uang_muka_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jual_uang_muka_editContextMenu(){
      jual_uang_mukaListEditorGrid.startEditing(jual_uang_muka_SelectedRow,1);
  	}
	/* End of Function */
  	
	jual_uang_mukaListEditorGrid.addListener('rowcontextmenu', onjual_uang_muka_ListEditGridContextMenu);
	jual_uang_muka_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	jual_uang_mukaListEditorGrid.on('afteredit', jual_uang_muka_update); // inLine Editing Record
	
	/* Identify  dp_nobukti Field */
	dp_nobuktiField= new Ext.form.TextField({
		id: 'dp_nobuktiField',
		fieldLabel: 'Dp Nobukti',
		maxLength: 30,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  dp_tanggal Field */
	dp_tanggalField= new Ext.form.DateField({
		id: 'dp_tanggalField',
		fieldLabel: 'Dp Tanggal',
		format : 'Y-m-d',
		allowBlank: false,
	});
	/* Identify  dp_nilai Field */
	dp_nilaiField= new Ext.form.NumberField({
		id: 'dp_nilaiField',
		fieldLabel: 'Dp Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  dp_trans Field */
	dp_transField= new Ext.form.ComboBox({
		id: 'dp_transField',
		fieldLabel: 'Dp Trans',
		store:new Ext.data.SimpleStore({
			fields:['dp_trans_value', 'dp_trans_display'],
			data:[['produk','produk'],['perawatan','perawatan'],['paket','paket']]
		}),
		mode: 'local',
		displayField: 'dp_trans_display',
		valueField: 'dp_trans_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
  	
	/* Function for retrieve create Window Panel*/ 
	jual_uang_muka_createForm = new Ext.FormPanel({
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
				items: [dp_nobuktiFielddp_tanggalField, dp_nilaiField, dp_transField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: jual_uang_muka_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					jual_uang_muka_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jual_uang_muka_createWindow= new Ext.Window({
		id: 'jual_uang_muka_createWindow',
		title: post2db+'Jual_uang_muka',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jual_uang_muka_create',
		items: jual_uang_muka_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function jual_uang_muka_list_search(){
		// render according to a SQL date format.
		var dp_nobukti_search=null;
		var dp_tanggal_search_date="";
		var dp_nilai_search=null;
		var dp_trans_search=null;

		if(dp_nobuktiSearchField.getValue()!==null){dp_nobukti_search=dp_nobuktiSearchField.getValue();}
		if(dp_tanggalSearchField.getValue()!==""){dp_tanggal_search_date=dp_tanggalSearchField.getValue().format('Y-m-d');}
		if(dp_nilaiSearchField.getValue()!==null){dp_nilai_search=dp_nilaiSearchField.getValue();}
		if(dp_transSearchField.getValue()!==null){dp_trans_search=dp_transSearchField.getValue();}
		// change the store parameters
		jual_uang_muka_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			dp_nobukti	:	dp_nobukti_search, 
			dp_tanggal	:	dp_tanggal_search_date, 
			dp_nilai	:	dp_nilai_search, 
			dp_trans	:	dp_trans_search 
};
		// Cause the datastore to do another query : 
		jual_uang_muka_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jual_uang_muka_reset_search(){
		// reset the store parameters
		jual_uang_muka_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jual_uang_muka_DataStore.reload({params: {start: 0, limit: pageS}});
		jual_uang_muka_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  dp_nobukti Search Field */
	dp_nobuktiSearchField= new Ext.form.TextField({
		id: 'dp_nobuktiSearchField',
		fieldLabel: 'Dp Nobukti',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  dp_tanggal Search Field */
	dp_tanggalSearchField= new Ext.form.DateField({
		id: 'dp_tanggalSearchField',
		fieldLabel: 'Dp Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  dp_nilai Search Field */
	dp_nilaiSearchField= new Ext.form.NumberField({
		id: 'dp_nilaiSearchField',
		fieldLabel: 'Dp Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  dp_trans Search Field */
	dp_transSearchField= new Ext.form.ComboBox({
		id: 'dp_transSearchField',
		fieldLabel: 'Dp Trans',
		store:new Ext.data.SimpleStore({
			fields:['value', 'dp_trans'],
			data:[['produk','produk'],['perawatan','perawatan'],['paket','paket']]
		}),
		mode: 'local',
		displayField: 'dp_trans',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	jual_uang_muka_searchForm = new Ext.FormPanel({
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
				items: [dp_nobuktiSearchFielddp_tanggalSearchField, dp_nilaiSearchField, dp_transSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jual_uang_muka_list_search
			},{
				text: 'Close',
				handler: function(){
					jual_uang_muka_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	jual_uang_muka_searchWindow = new Ext.Window({
		title: 'jual_uang_muka Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jual_uang_muka_search',
		items: jual_uang_muka_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jual_uang_muka_searchWindow.isVisible()){
			jual_uang_muka_searchWindow.show();
		} else {
			jual_uang_muka_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jual_uang_muka_print(){
		var searchquery = "";
		var dp_nobukti_print=null;
		var dp_tanggal_print_date="";
		var dp_nilai_print=null;
		var dp_trans_print=null;
		var win;              
		// check if we do have some search data...
		if(jual_uang_muka_DataStore.baseParams.query!==null){searchquery = jual_uang_muka_DataStore.baseParams.query;}
		if(jual_uang_muka_DataStore.baseParams.dp_nobukti!==null){dp_nobukti_print = jual_uang_muka_DataStore.baseParams.dp_nobukti;}
		if(jual_uang_muka_DataStore.baseParams.dp_tanggal!==""){dp_tanggal_print_date = jual_uang_muka_DataStore.baseParams.dp_tanggal;}
		if(jual_uang_muka_DataStore.baseParams.dp_nilai!==null){dp_nilai_print = jual_uang_muka_DataStore.baseParams.dp_nilai;}
		if(jual_uang_muka_DataStore.baseParams.dp_trans!==null){dp_trans_print = jual_uang_muka_DataStore.baseParams.dp_trans;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jual_uang_muka&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			dp_nobukti : dp_nobukti_print,
		  	dp_tanggal : dp_tanggal_print_date, 
			dp_nilai : dp_nilai_print,
			dp_trans : dp_trans_print,
		  	currentlisting: jual_uang_muka_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./jual_uang_mukalist.html','jual_uang_mukalist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jual_uang_muka_export_excel(){
		var searchquery = "";
		var dp_nobukti_2excel=null;
		var dp_tanggal_2excel_date="";
		var dp_nilai_2excel=null;
		var dp_trans_2excel=null;
		var win;              
		// check if we do have some search data...
		if(jual_uang_muka_DataStore.baseParams.query!==null){searchquery = jual_uang_muka_DataStore.baseParams.query;}
		if(jual_uang_muka_DataStore.baseParams.dp_nobukti!==null){dp_nobukti_2excel = jual_uang_muka_DataStore.baseParams.dp_nobukti;}
		if(jual_uang_muka_DataStore.baseParams.dp_tanggal!==""){dp_tanggal_2excel_date = jual_uang_muka_DataStore.baseParams.dp_tanggal;}
		if(jual_uang_muka_DataStore.baseParams.dp_nilai!==null){dp_nilai_2excel = jual_uang_muka_DataStore.baseParams.dp_nilai;}
		if(jual_uang_muka_DataStore.baseParams.dp_trans!==null){dp_trans_2excel = jual_uang_muka_DataStore.baseParams.dp_trans;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jual_uang_muka&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			dp_nobukti : dp_nobukti_2excel,
		  	dp_tanggal : dp_tanggal_2excel_date, 
			dp_nilai : dp_nilai_2excel,
			dp_trans : dp_trans_2excel,
		  	currentlisting: jual_uang_muka_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_jual_uang_muka"></div>
		<div id="elwindow_jual_uang_muka_create"></div>
        <div id="elwindow_jual_uang_muka_search"></div>
    </div>
</div>
</body>