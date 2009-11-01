<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jual_bank View
	+ Description	: For record view
	+ Filename 		: v_jual_bank.php
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
var jual_bank_DataStore;
var jual_bank_ColumnModel;
var jual_bankListEditorGrid;
var jual_bank_createForm;
var jual_bank_createWindow;
var jual_bank_searchForm;
var jual_bank_searchWindow;
var jual_bank_SelectedRow;
var jual_bank_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var jbank_nobuktiField;
var jbank_tanggalField;
var jbank_bankField;
var jbank_noField;
var jbank_nilaiField;
var jbank_transField;
var jbank_creatorField;
var jbank_date_createField;
var jbank_updateField;
var jbank_date_updateField;
var jbank_revisedField;
var jbank_nobuktiSearchField;
var jbank_tanggalSearchField;
var jbank_bankSearchField;
var jbank_noSearchField;
var jbank_nilaiSearchField;
var jbank_transSearchField;
var jbank_creatorSearchField;
var jbank_date_createSearchField;
var jbank_updateSearchField;
var jbank_date_updateSearchField;
var jbank_revisedSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jual_bank_update(oGrid_event){
	var jbank_nobukti_update_pk="";
	var jbank_tanggal_update_date="";
	var jbank_bank_update=null;
	var jbank_no_update=null;
	var jbank_nilai_update=null;
	var jbank_trans_update=null;
	var jbank_creator_update=null;
	var jbank_date_create_update_date="";
	var jbank_update_update=null;
	var jbank_date_update_update_date="";
	var jbank_revised_update=null;

	jbank_nobukti_update_pk = get_pk_id();
	 if(oGrid_event.record.data.jbank_tanggal!== ""){jbank_tanggal_update_date = oGrid_event.record.data.jbank_tanggal.format('Y-m-d');}
	if(oGrid_event.record.data.jbank_bank!== null){jbank_bank_update = oGrid_event.record.data.jbank_bank;}
	if(oGrid_event.record.data.jbank_no!== null){jbank_no_update = oGrid_event.record.data.jbank_no;}
	if(oGrid_event.record.data.jbank_nilai!== null){jbank_nilai_update = oGrid_event.record.data.jbank_nilai;}
	if(oGrid_event.record.data.jbank_trans!== null){jbank_trans_update = oGrid_event.record.data.jbank_trans;}
	if(oGrid_event.record.data.jbank_creator!== null){jbank_creator_update = oGrid_event.record.data.jbank_creator;}
	 if(oGrid_event.record.data.jbank_date_create!== ""){jbank_date_create_update_date = oGrid_event.record.data.jbank_date_create.format('Y-m-d');}
	if(oGrid_event.record.data.jbank_update!== null){jbank_update_update = oGrid_event.record.data.jbank_update;}
	 if(oGrid_event.record.data.jbank_date_update!== ""){jbank_date_update_update_date = oGrid_event.record.data.jbank_date_update.format('Y-m-d');}
	if(oGrid_event.record.data.jbank_revised!== null){jbank_revised_update = oGrid_event.record.data.jbank_revised;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jual_bank&m=get_action',
			params: {
				task: "UPDATE",
				jbank_nobukti	: get_pk_id(),				jbank_tanggal	: jbank_tanggal_update_date,				jbank_bank	:jbank_bank_update,		
				jbank_no	:jbank_no_update,		
				jbank_nilai	:jbank_nilai_update,		
				jbank_trans	:jbank_trans_update,		
				jbank_creator	:jbank_creator_update,		
				jbank_date_create	: jbank_date_create_update_date,				jbank_update	:jbank_update_update,		
				jbank_date_update	: jbank_date_update_update_date,				jbank_revised	:jbank_revised_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jual_bank_DataStore.commitChanges();
						jual_bank_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the jual_bank.',
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
	function jual_bank_create(){
		if(is_jual_bank_form_valid()){
		
		var jbank_nobukti_create=null;
		var jbank_tanggal_create_date="";
		var jbank_bank_create=null;
		var jbank_no_create=null;
		var jbank_nilai_create=null;
		var jbank_trans_create=null;
		var jbank_creator_create=null;
		var jbank_date_create_create_date="";
		var jbank_update_create=null;
		var jbank_date_update_create_date="";
		var jbank_revised_create=null;

		if(jbank_nobuktiField.getValue()!== null){jbank_nobukti_create = jbank_nobuktiField.getValue();}
		if(jbank_tanggalField.getValue()!== ""){jbank_tanggal_create_date = jbank_tanggalField.getValue().format('Y-m-d');}
		if(jbank_bankField.getValue()!== null){jbank_bank_create = jbank_bankField.getValue();}
		if(jbank_noField.getValue()!== null){jbank_no_create = jbank_noField.getValue();}
		if(jbank_nilaiField.getValue()!== null){jbank_nilai_create = jbank_nilaiField.getValue();}
		if(jbank_transField.getValue()!== null){jbank_trans_create = jbank_transField.getValue();}
		if(jbank_creatorField.getValue()!== null){jbank_creator_create = jbank_creatorField.getValue();}
		if(jbank_date_createField.getValue()!== ""){jbank_date_create_create_date = jbank_date_createField.getValue().format('Y-m-d');}
		if(jbank_updateField.getValue()!== null){jbank_update_create = jbank_updateField.getValue();}
		if(jbank_date_updateField.getValue()!== ""){jbank_date_update_create_date = jbank_date_updateField.getValue().format('Y-m-d');}
		if(jbank_revisedField.getValue()!== null){jbank_revised_create = jbank_revisedField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jual_bank&m=get_action',
				params: {
					task: post2db,
					jbank_nobukti	: jbank_nobukti_create_pk,	
					jbank_tanggal	: jbank_tanggal_create_date,					jbank_bank	: jbank_bank_create,	
					jbank_no	: jbank_no_create,	
					jbank_nilai	: jbank_nilai_create,	
					jbank_trans	: jbank_trans_create,	
					jbank_creator	: jbank_creator_create,	
					jbank_date_create	: jbank_date_create_create_date,					jbank_update	: jbank_update_create,	
					jbank_date_update	: jbank_date_update_create_date,					jbank_revised	: jbank_revised_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Jual_bank was '+msg+' successfully.');
							jual_bank_DataStore.reload();
							jual_bank_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Jual_bank.',
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
			return jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_nobukti');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jual_bank_reset_form(){
		jbank_tanggalField.reset();
		jbank_bankField.reset();
		jbank_noField.reset();
		jbank_nilaiField.reset();
		jbank_transField.reset();
		jbank_creatorField.reset();
		jbank_date_createField.reset();
		jbank_updateField.reset();
		jbank_date_updateField.reset();
		jbank_revisedField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jual_bank_set_form(){
		jbank_nobuktiField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_nobukti'));
		jbank_tanggalField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_tanggal'));
		jbank_bankField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_bank'));
		jbank_noField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_no'));
		jbank_nilaiField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_nilai'));
		jbank_transField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_trans'));
		jbank_creatorField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_creator'));
		jbank_date_createField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_date_create'));
		jbank_updateField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_update'));
		jbank_date_updateField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_date_update'));
		jbank_revisedField.setValue(jual_bankListEditorGrid.getSelectionModel().getSelected().get('jbank_revised'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jual_bank_form_valid(){
		return (jbank_nobuktiField.isValid() && true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jual_bank_createWindow.isVisible()){
			jual_bank_reset_form();
			post2db='CREATE';
			msg='created';
			jual_bank_createWindow.show();
		} else {
			jual_bank_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jual_bank_confirm_delete(){
		// only one jual_bank is selected here
		if(jual_bankListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jual_bank_delete);
		} else if(jual_bankListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jual_bank_delete);
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
	function jual_bank_confirm_update(){
		/* only one record is selected here */
		if(jual_bankListEditorGrid.selModel.getCount() == 1) {
			jual_bank_set_form();
			post2db='UPDATE';
			msg='updated';
			jual_bank_createWindow.show();
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
	function jual_bank_delete(btn){
		if(btn=='yes'){
			var selections = jual_bankListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jual_bankListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jbank_nobukti);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jual_bank&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jual_bank_DataStore.reload();
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
	jual_bank_DataStore = new Ext.data.Store({
		id: 'jual_bank_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jual_bank&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jbank_nobukti'
		},[
		/* dataIndex => insert intojual_bank_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jbank_nobukti', type: 'string', mapping: 'jbank_nobukti'},
			{name: 'jbank_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jbank_tanggal'},
			{name: 'jbank_bank', type: 'string', mapping: 'jbank_bank'},
			{name: 'jbank_no', type: 'string', mapping: 'jbank_no'},
			{name: 'jbank_nilai', type: 'float', mapping: 'jbank_nilai'},
			{name: 'jbank_trans', type: 'string', mapping: 'jbank_trans'},
			{name: 'jbank_creator', type: 'string', mapping: 'jbank_creator'},
			{name: 'jbank_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jbank_date_create'},
			{name: 'jbank_update', type: 'string', mapping: 'jbank_update'},
			{name: 'jbank_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jbank_date_update'},
			{name: 'jbank_revised', type: 'int', mapping: 'jbank_revised'}
		]),
		sortInfo:{field: 'jbank_nobukti', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	jual_bank_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jbank_nobukti',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Jbank Tanggal',
			dataIndex: 'jbank_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jbank Bank',
			dataIndex: 'jbank_bank',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		},
		{
			header: 'Jbank No',
			dataIndex: 'jbank_no',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		},
		{
			header: 'Jbank Nilai',
			dataIndex: 'jbank_nilai',
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
			header: 'Jbank Trans',
			dataIndex: 'jbank_trans',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['jbank_trans_value', 'jbank_trans_display'],
					data: [['produk','produk'],['perawatan','perawatan'],['paket','paket']]
					}),
				mode: 'local',
               	displayField: 'jbank_trans_display',
               	valueField: 'jbank_trans_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Jbank Creator',
			dataIndex: 'jbank_creator',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Jbank Date Create',
			dataIndex: 'jbank_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jbank Update',
			dataIndex: 'jbank_update',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Jbank Date Update',
			dataIndex: 'jbank_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jbank Revised',
			dataIndex: 'jbank_revised',
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
	jual_bank_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	jual_bankListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jual_bankListEditorGrid',
		el: 'fp_jual_bank',
		title: 'List Of Jual_bank',
		autoHeight: true,
		store: jual_bank_DataStore, // DataStore
		cm: jual_bank_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jual_bank_DataStore,
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
			handler: jual_bank_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jual_bank_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jual_bank_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jual_bank_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jual_bank_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jual_bank_print  
		}
		]
	});
	jual_bankListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jual_bank_ContextMenu = new Ext.menu.Menu({
		id: 'jual_bank_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jual_bank_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jual_bank_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jual_bank_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jual_bank_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjual_bank_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jual_bank_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jual_bank_SelectedRow=rowIndex;
		jual_bank_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jual_bank_editContextMenu(){
      jual_bankListEditorGrid.startEditing(jual_bank_SelectedRow,1);
  	}
	/* End of Function */
  	
	jual_bankListEditorGrid.addListener('rowcontextmenu', onjual_bank_ListEditGridContextMenu);
	jual_bank_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	jual_bankListEditorGrid.on('afteredit', jual_bank_update); // inLine Editing Record
	
	/* Identify  jbank_nobukti Field */
	jbank_nobuktiField= new Ext.form.TextField({
		id: 'jbank_nobuktiField',
		fieldLabel: 'Jbank Nobukti',
		maxLength: 30,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  jbank_tanggal Field */
	jbank_tanggalField= new Ext.form.DateField({
		id: 'jbank_tanggalField',
		fieldLabel: 'Jbank Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  jbank_bank Field */
	jbank_bankField= new Ext.form.TextField({
		id: 'jbank_bankField',
		fieldLabel: 'Jbank Bank',
		maxLength: 100,
		anchor: '95%'
	});
	/* Identify  jbank_no Field */
	jbank_noField= new Ext.form.TextField({
		id: 'jbank_noField',
		fieldLabel: 'Jbank No',
		maxLength: 100,
		anchor: '95%'
	});
	/* Identify  jbank_nilai Field */
	jbank_nilaiField= new Ext.form.NumberField({
		id: 'jbank_nilaiField',
		fieldLabel: 'Jbank Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jbank_trans Field */
	jbank_transField= new Ext.form.ComboBox({
		id: 'jbank_transField',
		fieldLabel: 'Jbank Trans',
		store:new Ext.data.SimpleStore({
			fields:['jbank_trans_value', 'jbank_trans_display'],
			data:[['produk','produk'],['perawatan','perawatan'],['paket','paket']]
		}),
		mode: 'local',
		displayField: 'jbank_trans_display',
		valueField: 'jbank_trans_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jbank_creator Field */
	jbank_creatorField= new Ext.form.TextField({
		id: 'jbank_creatorField',
		fieldLabel: 'Jbank Creator',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jbank_date_create Field */
	jbank_date_createField= new Ext.form.DateField({
		id: 'jbank_date_createField',
		fieldLabel: 'Jbank Date Create',
		format : 'Y-m-d',
	});
	/* Identify  jbank_update Field */
	jbank_updateField= new Ext.form.TextField({
		id: 'jbank_updateField',
		fieldLabel: 'Jbank Update',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jbank_date_update Field */
	jbank_date_updateField= new Ext.form.DateField({
		id: 'jbank_date_updateField',
		fieldLabel: 'Jbank Date Update',
		format : 'Y-m-d',
	});
	/* Identify  jbank_revised Field */
	jbank_revisedField= new Ext.form.NumberField({
		id: 'jbank_revisedField',
		fieldLabel: 'Jbank Revised',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	jual_bank_createForm = new Ext.FormPanel({
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
				items: [jbank_nobuktiFieldjbank_tanggalField, jbank_bankField, jbank_noField, jbank_nilaiField, jbank_transField, jbank_creatorField, jbank_date_createField, jbank_updateField, jbank_date_updateField, jbank_revisedField] 
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
				handler: jual_bank_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					jual_bank_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jual_bank_createWindow= new Ext.Window({
		id: 'jual_bank_createWindow',
		title: post2db+'Jual_bank',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jual_bank_create',
		items: jual_bank_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function jual_bank_list_search(){
		// render according to a SQL date format.
		var jbank_nobukti_search=null;
		var jbank_tanggal_search_date="";
		var jbank_bank_search=null;
		var jbank_no_search=null;
		var jbank_nilai_search=null;
		var jbank_trans_search=null;
		var jbank_creator_search=null;
		var jbank_date_create_search_date="";
		var jbank_update_search=null;
		var jbank_date_update_search_date="";
		var jbank_revised_search=null;

		if(jbank_nobuktiSearchField.getValue()!==null){jbank_nobukti_search=jbank_nobuktiSearchField.getValue();}
		if(jbank_tanggalSearchField.getValue()!==""){jbank_tanggal_search_date=jbank_tanggalSearchField.getValue().format('Y-m-d');}
		if(jbank_bankSearchField.getValue()!==null){jbank_bank_search=jbank_bankSearchField.getValue();}
		if(jbank_noSearchField.getValue()!==null){jbank_no_search=jbank_noSearchField.getValue();}
		if(jbank_nilaiSearchField.getValue()!==null){jbank_nilai_search=jbank_nilaiSearchField.getValue();}
		if(jbank_transSearchField.getValue()!==null){jbank_trans_search=jbank_transSearchField.getValue();}
		if(jbank_creatorSearchField.getValue()!==null){jbank_creator_search=jbank_creatorSearchField.getValue();}
		if(jbank_date_createSearchField.getValue()!==""){jbank_date_create_search_date=jbank_date_createSearchField.getValue().format('Y-m-d');}
		if(jbank_updateSearchField.getValue()!==null){jbank_update_search=jbank_updateSearchField.getValue();}
		if(jbank_date_updateSearchField.getValue()!==""){jbank_date_update_search_date=jbank_date_updateSearchField.getValue().format('Y-m-d');}
		if(jbank_revisedSearchField.getValue()!==null){jbank_revised_search=jbank_revisedSearchField.getValue();}
		// change the store parameters
		jual_bank_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jbank_nobukti	:	jbank_nobukti_search, 
			jbank_tanggal	:	jbank_tanggal_search_date, 
			jbank_bank	:	jbank_bank_search, 
			jbank_no	:	jbank_no_search, 
			jbank_nilai	:	jbank_nilai_search, 
			jbank_trans	:	jbank_trans_search, 
			jbank_creator	:	jbank_creator_search, 
			jbank_date_create	:	jbank_date_create_search_date, 
			jbank_update	:	jbank_update_search, 
			jbank_date_update	:	jbank_date_update_search_date, 
			jbank_revised	:	jbank_revised_search 
};
		// Cause the datastore to do another query : 
		jual_bank_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jual_bank_reset_search(){
		// reset the store parameters
		jual_bank_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jual_bank_DataStore.reload({params: {start: 0, limit: pageS}});
		jual_bank_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  jbank_nobukti Search Field */
	jbank_nobuktiSearchField= new Ext.form.TextField({
		id: 'jbank_nobuktiSearchField',
		fieldLabel: 'Jbank Nobukti',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  jbank_tanggal Search Field */
	jbank_tanggalSearchField= new Ext.form.DateField({
		id: 'jbank_tanggalSearchField',
		fieldLabel: 'Jbank Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jbank_bank Search Field */
	jbank_bankSearchField= new Ext.form.TextField({
		id: 'jbank_bankSearchField',
		fieldLabel: 'Jbank Bank',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  jbank_no Search Field */
	jbank_noSearchField= new Ext.form.TextField({
		id: 'jbank_noSearchField',
		fieldLabel: 'Jbank No',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  jbank_nilai Search Field */
	jbank_nilaiSearchField= new Ext.form.NumberField({
		id: 'jbank_nilaiSearchField',
		fieldLabel: 'Jbank Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jbank_trans Search Field */
	jbank_transSearchField= new Ext.form.ComboBox({
		id: 'jbank_transSearchField',
		fieldLabel: 'Jbank Trans',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jbank_trans'],
			data:[['produk','produk'],['perawatan','perawatan'],['paket','paket']]
		}),
		mode: 'local',
		displayField: 'jbank_trans',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jbank_creator Search Field */
	jbank_creatorSearchField= new Ext.form.TextField({
		id: 'jbank_creatorSearchField',
		fieldLabel: 'Jbank Creator',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  jbank_date_create Search Field */
	jbank_date_createSearchField= new Ext.form.DateField({
		id: 'jbank_date_createSearchField',
		fieldLabel: 'Jbank Date Create',
		format : 'Y-m-d',
	
	});
	/* Identify  jbank_update Search Field */
	jbank_updateSearchField= new Ext.form.TextField({
		id: 'jbank_updateSearchField',
		fieldLabel: 'Jbank Update',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  jbank_date_update Search Field */
	jbank_date_updateSearchField= new Ext.form.DateField({
		id: 'jbank_date_updateSearchField',
		fieldLabel: 'Jbank Date Update',
		format : 'Y-m-d',
	
	});
	/* Identify  jbank_revised Search Field */
	jbank_revisedSearchField= new Ext.form.NumberField({
		id: 'jbank_revisedSearchField',
		fieldLabel: 'Jbank Revised',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	jual_bank_searchForm = new Ext.FormPanel({
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
				items: [jbank_nobuktiSearchFieldjbank_tanggalSearchField, jbank_bankSearchField, jbank_noSearchField, jbank_nilaiSearchField, jbank_transSearchField, jbank_creatorSearchField, jbank_date_createSearchField, jbank_updateSearchField, jbank_date_updateSearchField, jbank_revisedSearchField] 
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
				handler: jual_bank_list_search
			},{
				text: 'Close',
				handler: function(){
					jual_bank_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	jual_bank_searchWindow = new Ext.Window({
		title: 'jual_bank Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jual_bank_search',
		items: jual_bank_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jual_bank_searchWindow.isVisible()){
			jual_bank_searchWindow.show();
		} else {
			jual_bank_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jual_bank_print(){
		var searchquery = "";
		var jbank_nobukti_print=null;
		var jbank_tanggal_print_date="";
		var jbank_bank_print=null;
		var jbank_no_print=null;
		var jbank_nilai_print=null;
		var jbank_trans_print=null;
		var jbank_creator_print=null;
		var jbank_date_create_print_date="";
		var jbank_update_print=null;
		var jbank_date_update_print_date="";
		var jbank_revised_print=null;
		var win;              
		// check if we do have some search data...
		if(jual_bank_DataStore.baseParams.query!==null){searchquery = jual_bank_DataStore.baseParams.query;}
		if(jual_bank_DataStore.baseParams.jbank_nobukti!==null){jbank_nobukti_print = jual_bank_DataStore.baseParams.jbank_nobukti;}
		if(jual_bank_DataStore.baseParams.jbank_tanggal!==""){jbank_tanggal_print_date = jual_bank_DataStore.baseParams.jbank_tanggal;}
		if(jual_bank_DataStore.baseParams.jbank_bank!==null){jbank_bank_print = jual_bank_DataStore.baseParams.jbank_bank;}
		if(jual_bank_DataStore.baseParams.jbank_no!==null){jbank_no_print = jual_bank_DataStore.baseParams.jbank_no;}
		if(jual_bank_DataStore.baseParams.jbank_nilai!==null){jbank_nilai_print = jual_bank_DataStore.baseParams.jbank_nilai;}
		if(jual_bank_DataStore.baseParams.jbank_trans!==null){jbank_trans_print = jual_bank_DataStore.baseParams.jbank_trans;}
		if(jual_bank_DataStore.baseParams.jbank_creator!==null){jbank_creator_print = jual_bank_DataStore.baseParams.jbank_creator;}
		if(jual_bank_DataStore.baseParams.jbank_date_create!==""){jbank_date_create_print_date = jual_bank_DataStore.baseParams.jbank_date_create;}
		if(jual_bank_DataStore.baseParams.jbank_update!==null){jbank_update_print = jual_bank_DataStore.baseParams.jbank_update;}
		if(jual_bank_DataStore.baseParams.jbank_date_update!==""){jbank_date_update_print_date = jual_bank_DataStore.baseParams.jbank_date_update;}
		if(jual_bank_DataStore.baseParams.jbank_revised!==null){jbank_revised_print = jual_bank_DataStore.baseParams.jbank_revised;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jual_bank&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jbank_nobukti : jbank_nobukti_print,
		  	jbank_tanggal : jbank_tanggal_print_date, 
			jbank_bank : jbank_bank_print,
			jbank_no : jbank_no_print,
			jbank_nilai : jbank_nilai_print,
			jbank_trans : jbank_trans_print,
			jbank_creator : jbank_creator_print,
		  	jbank_date_create : jbank_date_create_print_date, 
			jbank_update : jbank_update_print,
		  	jbank_date_update : jbank_date_update_print_date, 
			jbank_revised : jbank_revised_print,
		  	currentlisting: jual_bank_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./jual_banklist.html','jual_banklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jual_bank_export_excel(){
		var searchquery = "";
		var jbank_nobukti_2excel=null;
		var jbank_tanggal_2excel_date="";
		var jbank_bank_2excel=null;
		var jbank_no_2excel=null;
		var jbank_nilai_2excel=null;
		var jbank_trans_2excel=null;
		var jbank_creator_2excel=null;
		var jbank_date_create_2excel_date="";
		var jbank_update_2excel=null;
		var jbank_date_update_2excel_date="";
		var jbank_revised_2excel=null;
		var win;              
		// check if we do have some search data...
		if(jual_bank_DataStore.baseParams.query!==null){searchquery = jual_bank_DataStore.baseParams.query;}
		if(jual_bank_DataStore.baseParams.jbank_nobukti!==null){jbank_nobukti_2excel = jual_bank_DataStore.baseParams.jbank_nobukti;}
		if(jual_bank_DataStore.baseParams.jbank_tanggal!==""){jbank_tanggal_2excel_date = jual_bank_DataStore.baseParams.jbank_tanggal;}
		if(jual_bank_DataStore.baseParams.jbank_bank!==null){jbank_bank_2excel = jual_bank_DataStore.baseParams.jbank_bank;}
		if(jual_bank_DataStore.baseParams.jbank_no!==null){jbank_no_2excel = jual_bank_DataStore.baseParams.jbank_no;}
		if(jual_bank_DataStore.baseParams.jbank_nilai!==null){jbank_nilai_2excel = jual_bank_DataStore.baseParams.jbank_nilai;}
		if(jual_bank_DataStore.baseParams.jbank_trans!==null){jbank_trans_2excel = jual_bank_DataStore.baseParams.jbank_trans;}
		if(jual_bank_DataStore.baseParams.jbank_creator!==null){jbank_creator_2excel = jual_bank_DataStore.baseParams.jbank_creator;}
		if(jual_bank_DataStore.baseParams.jbank_date_create!==""){jbank_date_create_2excel_date = jual_bank_DataStore.baseParams.jbank_date_create;}
		if(jual_bank_DataStore.baseParams.jbank_update!==null){jbank_update_2excel = jual_bank_DataStore.baseParams.jbank_update;}
		if(jual_bank_DataStore.baseParams.jbank_date_update!==""){jbank_date_update_2excel_date = jual_bank_DataStore.baseParams.jbank_date_update;}
		if(jual_bank_DataStore.baseParams.jbank_revised!==null){jbank_revised_2excel = jual_bank_DataStore.baseParams.jbank_revised;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jual_bank&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jbank_nobukti : jbank_nobukti_2excel,
		  	jbank_tanggal : jbank_tanggal_2excel_date, 
			jbank_bank : jbank_bank_2excel,
			jbank_no : jbank_no_2excel,
			jbank_nilai : jbank_nilai_2excel,
			jbank_trans : jbank_trans_2excel,
			jbank_creator : jbank_creator_2excel,
		  	jbank_date_create : jbank_date_create_2excel_date, 
			jbank_update : jbank_update_2excel,
		  	jbank_date_update : jbank_date_update_2excel_date, 
			jbank_revised : jbank_revised_2excel,
		  	currentlisting: jual_bank_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_jual_bank"></div>
		<div id="elwindow_jual_bank_create"></div>
        <div id="elwindow_jual_bank_search"></div>
    </div>
</div>
</body>