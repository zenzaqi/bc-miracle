<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jual_card View
	+ Description	: For record view
	+ Filename 		: v_jual_card.php
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
var jual_card_DataStore;
var jual_card_ColumnModel;
var jual_cardListEditorGrid;
var jual_card_createForm;
var jual_card_createWindow;
var jual_card_searchForm;
var jual_card_searchWindow;
var jual_card_SelectedRow;
var jual_card_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var jcard_nobuktiField;
var jcard_tanggalField;
var jcard_namaField;
var jcard_jenisField;
var jcard_noField;
var jcard_nilaiField;
var jcard_transField;
var jcard_creatorField;
var jcard_date_createField;
var jcard_updateField;
var jcard_date_updateField;
var jcard_revisedField;
var jcard_nobuktiSearchField;
var jcard_tanggalSearchField;
var jcard_namaSearchField;
var jcard_jenisSearchField;
var jcard_noSearchField;
var jcard_nilaiSearchField;
var jcard_transSearchField;
var jcard_creatorSearchField;
var jcard_date_createSearchField;
var jcard_updateSearchField;
var jcard_date_updateSearchField;
var jcard_revisedSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jual_card_update(oGrid_event){
	var jcard_nobukti_update_pk="";
	var jcard_tanggal_update_date="";
	var jcard_nama_update=null;
	var jcard_jenis_update=null;
	var jcard_no_update=null;
	var jcard_nilai_update=null;
	var jcard_trans_update=null;
	var jcard_creator_update=null;
	var jcard_date_create_update_date="";
	var jcard_update_update=null;
	var jcard_date_update_update_date="";
	var jcard_revised_update=null;

	jcard_nobukti_update_pk = get_pk_id();
	 if(oGrid_event.record.data.jcard_tanggal!== ""){jcard_tanggal_update_date = oGrid_event.record.data.jcard_tanggal.format('Y-m-d');}
	if(oGrid_event.record.data.jcard_nama!== null){jcard_nama_update = oGrid_event.record.data.jcard_nama;}
	if(oGrid_event.record.data.jcard_jenis!== null){jcard_jenis_update = oGrid_event.record.data.jcard_jenis;}
	if(oGrid_event.record.data.jcard_no!== null){jcard_no_update = oGrid_event.record.data.jcard_no;}
	if(oGrid_event.record.data.jcard_nilai!== null){jcard_nilai_update = oGrid_event.record.data.jcard_nilai;}
	if(oGrid_event.record.data.jcard_trans!== null){jcard_trans_update = oGrid_event.record.data.jcard_trans;}
	if(oGrid_event.record.data.jcard_creator!== null){jcard_creator_update = oGrid_event.record.data.jcard_creator;}
	 if(oGrid_event.record.data.jcard_date_create!== ""){jcard_date_create_update_date = oGrid_event.record.data.jcard_date_create.format('Y-m-d');}
	if(oGrid_event.record.data.jcard_update!== null){jcard_update_update = oGrid_event.record.data.jcard_update;}
	 if(oGrid_event.record.data.jcard_date_update!== ""){jcard_date_update_update_date = oGrid_event.record.data.jcard_date_update.format('Y-m-d');}
	if(oGrid_event.record.data.jcard_revised!== null){jcard_revised_update = oGrid_event.record.data.jcard_revised;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jual_card&m=get_action',
			params: {
				task: "UPDATE",
				jcard_nobukti	: get_pk_id(),				jcard_tanggal	: jcard_tanggal_update_date,				jcard_nama	:jcard_nama_update,		
				jcard_jenis	:jcard_jenis_update,		
				jcard_no	:jcard_no_update,		
				jcard_nilai	:jcard_nilai_update,		
				jcard_trans	:jcard_trans_update,		
				jcard_creator	:jcard_creator_update,		
				jcard_date_create	: jcard_date_create_update_date,				jcard_update	:jcard_update_update,		
				jcard_date_update	: jcard_date_update_update_date,				jcard_revised	:jcard_revised_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jual_card_DataStore.commitChanges();
						jual_card_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the jual_card.',
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
	function jual_card_create(){
		if(is_jual_card_form_valid()){
		
		var jcard_nobukti_create=null;
		var jcard_tanggal_create_date="";
		var jcard_nama_create=null;
		var jcard_jenis_create=null;
		var jcard_no_create=null;
		var jcard_nilai_create=null;
		var jcard_trans_create=null;
		var jcard_creator_create=null;
		var jcard_date_create_create_date="";
		var jcard_update_create=null;
		var jcard_date_update_create_date="";
		var jcard_revised_create=null;

		if(jcard_nobuktiField.getValue()!== null){jcard_nobukti_create = jcard_nobuktiField.getValue();}
		if(jcard_tanggalField.getValue()!== ""){jcard_tanggal_create_date = jcard_tanggalField.getValue().format('Y-m-d');}
		if(jcard_namaField.getValue()!== null){jcard_nama_create = jcard_namaField.getValue();}
		if(jcard_jenisField.getValue()!== null){jcard_jenis_create = jcard_jenisField.getValue();}
		if(jcard_noField.getValue()!== null){jcard_no_create = jcard_noField.getValue();}
		if(jcard_nilaiField.getValue()!== null){jcard_nilai_create = jcard_nilaiField.getValue();}
		if(jcard_transField.getValue()!== null){jcard_trans_create = jcard_transField.getValue();}
		if(jcard_creatorField.getValue()!== null){jcard_creator_create = jcard_creatorField.getValue();}
		if(jcard_date_createField.getValue()!== ""){jcard_date_create_create_date = jcard_date_createField.getValue().format('Y-m-d');}
		if(jcard_updateField.getValue()!== null){jcard_update_create = jcard_updateField.getValue();}
		if(jcard_date_updateField.getValue()!== ""){jcard_date_update_create_date = jcard_date_updateField.getValue().format('Y-m-d');}
		if(jcard_revisedField.getValue()!== null){jcard_revised_create = jcard_revisedField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jual_card&m=get_action',
				params: {
					task: post2db,
					jcard_nobukti	: jcard_nobukti_create_pk,	
					jcard_tanggal	: jcard_tanggal_create_date,					jcard_nama	: jcard_nama_create,	
					jcard_jenis	: jcard_jenis_create,	
					jcard_no	: jcard_no_create,	
					jcard_nilai	: jcard_nilai_create,	
					jcard_trans	: jcard_trans_create,	
					jcard_creator	: jcard_creator_create,	
					jcard_date_create	: jcard_date_create_create_date,					jcard_update	: jcard_update_create,	
					jcard_date_update	: jcard_date_update_create_date,					jcard_revised	: jcard_revised_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Jual_card was '+msg+' successfully.');
							jual_card_DataStore.reload();
							jual_card_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Jual_card.',
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
			return jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_nobukti');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jual_card_reset_form(){
		jcard_tanggalField.reset();
		jcard_namaField.reset();
		jcard_jenisField.reset();
		jcard_noField.reset();
		jcard_nilaiField.reset();
		jcard_transField.reset();
		jcard_creatorField.reset();
		jcard_date_createField.reset();
		jcard_updateField.reset();
		jcard_date_updateField.reset();
		jcard_revisedField.reset();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jual_card_set_form(){
		jcard_nobuktiField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_nobukti'));
		jcard_tanggalField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_tanggal'));
		jcard_namaField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_nama'));
		jcard_jenisField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_jenis'));
		jcard_noField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_no'));
		jcard_nilaiField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_nilai'));
		jcard_transField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_trans'));
		jcard_creatorField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_creator'));
		jcard_date_createField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_date_create'));
		jcard_updateField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_update'));
		jcard_date_updateField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_date_update'));
		jcard_revisedField.setValue(jual_cardListEditorGrid.getSelectionModel().getSelected().get('jcard_revised'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jual_card_form_valid(){
		return (jcard_nobuktiField.isValid() && true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jual_card_createWindow.isVisible()){
			jual_card_reset_form();
			post2db='CREATE';
			msg='created';
			jual_card_createWindow.show();
		} else {
			jual_card_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jual_card_confirm_delete(){
		// only one jual_card is selected here
		if(jual_cardListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jual_card_delete);
		} else if(jual_cardListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jual_card_delete);
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
	function jual_card_confirm_update(){
		/* only one record is selected here */
		if(jual_cardListEditorGrid.selModel.getCount() == 1) {
			jual_card_set_form();
			post2db='UPDATE';
			msg='updated';
			jual_card_createWindow.show();
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
	function jual_card_delete(btn){
		if(btn=='yes'){
			var selections = jual_cardListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jual_cardListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jcard_nobukti);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jual_card&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jual_card_DataStore.reload();
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
	jual_card_DataStore = new Ext.data.Store({
		id: 'jual_card_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jual_card&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcard_nobukti'
		},[
		/* dataIndex => insert intojual_card_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jcard_nobukti', type: 'string', mapping: 'jcard_nobukti'},
			{name: 'jcard_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jcard_tanggal'},
			{name: 'jcard_nama', type: 'string', mapping: 'jcard_nama'},
			{name: 'jcard_jenis', type: 'string', mapping: 'jcard_jenis'},
			{name: 'jcard_no', type: 'string', mapping: 'jcard_no'},
			{name: 'jcard_nilai', type: 'float', mapping: 'jcard_nilai'},
			{name: 'jcard_trans', type: 'string', mapping: 'jcard_trans'},
			{name: 'jcard_creator', type: 'string', mapping: 'jcard_creator'},
			{name: 'jcard_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jcard_date_create'},
			{name: 'jcard_update', type: 'string', mapping: 'jcard_update'},
			{name: 'jcard_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jcard_date_update'},
			{name: 'jcard_revised', type: 'int', mapping: 'jcard_revised'}
		]),
		sortInfo:{field: 'jcard_nobukti', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	jual_card_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jcard_nobukti',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Jcard Tanggal',
			dataIndex: 'jcard_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jcard Nama',
			dataIndex: 'jcard_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		},
		{
			header: 'Jcard Jenis',
			dataIndex: 'jcard_jenis',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Jcard No',
			dataIndex: 'jcard_no',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Jcard Nilai',
			dataIndex: 'jcard_nilai',
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
			header: 'Jcard Trans',
			dataIndex: 'jcard_trans',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['jcard_trans_value', 'jcard_trans_display'],
					data: [['produk','produk'],['perawatan','perawatan'],['paket','paket']]
					}),
				mode: 'local',
               	displayField: 'jcard_trans_display',
               	valueField: 'jcard_trans_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Jcard Creator',
			dataIndex: 'jcard_creator',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Jcard Date Create',
			dataIndex: 'jcard_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jcard Update',
			dataIndex: 'jcard_update',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Jcard Date Update',
			dataIndex: 'jcard_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jcard Revised',
			dataIndex: 'jcard_revised',
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
	jual_card_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	jual_cardListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jual_cardListEditorGrid',
		el: 'fp_jual_card',
		title: 'List Of Jual_card',
		autoHeight: true,
		store: jual_card_DataStore, // DataStore
		cm: jual_card_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jual_card_DataStore,
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
			handler: jual_card_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jual_card_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jual_card_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jual_card_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jual_card_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jual_card_print  
		}
		]
	});
	jual_cardListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jual_card_ContextMenu = new Ext.menu.Menu({
		id: 'jual_card_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jual_card_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jual_card_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jual_card_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jual_card_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjual_card_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jual_card_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jual_card_SelectedRow=rowIndex;
		jual_card_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jual_card_editContextMenu(){
      jual_cardListEditorGrid.startEditing(jual_card_SelectedRow,1);
  	}
	/* End of Function */
  	
	jual_cardListEditorGrid.addListener('rowcontextmenu', onjual_card_ListEditGridContextMenu);
	jual_card_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	jual_cardListEditorGrid.on('afteredit', jual_card_update); // inLine Editing Record
	
	/* Identify  jcard_nobukti Field */
	jcard_nobuktiField= new Ext.form.TextField({
		id: 'jcard_nobuktiField',
		fieldLabel: 'Jcard Nobukti',
		maxLength: 30,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  jcard_tanggal Field */
	jcard_tanggalField= new Ext.form.DateField({
		id: 'jcard_tanggalField',
		fieldLabel: 'Jcard Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  jcard_nama Field */
	jcard_namaField= new Ext.form.TextField({
		id: 'jcard_namaField',
		fieldLabel: 'Jcard Nama',
		maxLength: 100,
		anchor: '95%'
	});
	/* Identify  jcard_jenis Field */
	jcard_jenisField= new Ext.form.TextField({
		id: 'jcard_jenisField',
		fieldLabel: 'Jcard Jenis',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jcard_no Field */
	jcard_noField= new Ext.form.TextField({
		id: 'jcard_noField',
		fieldLabel: 'Jcard No',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jcard_nilai Field */
	jcard_nilaiField= new Ext.form.NumberField({
		id: 'jcard_nilaiField',
		fieldLabel: 'Jcard Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jcard_trans Field */
	jcard_transField= new Ext.form.ComboBox({
		id: 'jcard_transField',
		fieldLabel: 'Jcard Trans',
		store:new Ext.data.SimpleStore({
			fields:['jcard_trans_value', 'jcard_trans_display'],
			data:[['produk','produk'],['perawatan','perawatan'],['paket','paket']]
		}),
		mode: 'local',
		displayField: 'jcard_trans_display',
		valueField: 'jcard_trans_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jcard_creator Field */
	jcard_creatorField= new Ext.form.TextField({
		id: 'jcard_creatorField',
		fieldLabel: 'Jcard Creator',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jcard_date_create Field */
	jcard_date_createField= new Ext.form.DateField({
		id: 'jcard_date_createField',
		fieldLabel: 'Jcard Date Create',
		format : 'Y-m-d',
	});
	/* Identify  jcard_update Field */
	jcard_updateField= new Ext.form.TextField({
		id: 'jcard_updateField',
		fieldLabel: 'Jcard Update',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jcard_date_update Field */
	jcard_date_updateField= new Ext.form.DateField({
		id: 'jcard_date_updateField',
		fieldLabel: 'Jcard Date Update',
		format : 'Y-m-d',
	});
	/* Identify  jcard_revised Field */
	jcard_revisedField= new Ext.form.NumberField({
		id: 'jcard_revisedField',
		fieldLabel: 'Jcard Revised',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	
	/* Function for retrieve create Window Panel*/ 
	jual_card_createForm = new Ext.FormPanel({
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
				items: [jcard_nobuktiFieldjcard_tanggalField, jcard_namaField, jcard_jenisField, jcard_noField, jcard_nilaiField, jcard_transField, jcard_creatorField, jcard_date_createField, jcard_updateField, jcard_date_updateField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jcard_revisedField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: jual_card_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					jual_card_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jual_card_createWindow= new Ext.Window({
		id: 'jual_card_createWindow',
		title: post2db+'Jual_card',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jual_card_create',
		items: jual_card_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function jual_card_list_search(){
		// render according to a SQL date format.
		var jcard_nobukti_search=null;
		var jcard_tanggal_search_date="";
		var jcard_nama_search=null;
		var jcard_jenis_search=null;
		var jcard_no_search=null;
		var jcard_nilai_search=null;
		var jcard_trans_search=null;
		var jcard_creator_search=null;
		var jcard_date_create_search_date="";
		var jcard_update_search=null;
		var jcard_date_update_search_date="";
		var jcard_revised_search=null;

		if(jcard_nobuktiSearchField.getValue()!==null){jcard_nobukti_search=jcard_nobuktiSearchField.getValue();}
		if(jcard_tanggalSearchField.getValue()!==""){jcard_tanggal_search_date=jcard_tanggalSearchField.getValue().format('Y-m-d');}
		if(jcard_namaSearchField.getValue()!==null){jcard_nama_search=jcard_namaSearchField.getValue();}
		if(jcard_jenisSearchField.getValue()!==null){jcard_jenis_search=jcard_jenisSearchField.getValue();}
		if(jcard_noSearchField.getValue()!==null){jcard_no_search=jcard_noSearchField.getValue();}
		if(jcard_nilaiSearchField.getValue()!==null){jcard_nilai_search=jcard_nilaiSearchField.getValue();}
		if(jcard_transSearchField.getValue()!==null){jcard_trans_search=jcard_transSearchField.getValue();}
		if(jcard_creatorSearchField.getValue()!==null){jcard_creator_search=jcard_creatorSearchField.getValue();}
		if(jcard_date_createSearchField.getValue()!==""){jcard_date_create_search_date=jcard_date_createSearchField.getValue().format('Y-m-d');}
		if(jcard_updateSearchField.getValue()!==null){jcard_update_search=jcard_updateSearchField.getValue();}
		if(jcard_date_updateSearchField.getValue()!==""){jcard_date_update_search_date=jcard_date_updateSearchField.getValue().format('Y-m-d');}
		if(jcard_revisedSearchField.getValue()!==null){jcard_revised_search=jcard_revisedSearchField.getValue();}
		// change the store parameters
		jual_card_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jcard_nobukti	:	jcard_nobukti_search, 
			jcard_tanggal	:	jcard_tanggal_search_date, 
			jcard_nama	:	jcard_nama_search, 
			jcard_jenis	:	jcard_jenis_search, 
			jcard_no	:	jcard_no_search, 
			jcard_nilai	:	jcard_nilai_search, 
			jcard_trans	:	jcard_trans_search, 
			jcard_creator	:	jcard_creator_search, 
			jcard_date_create	:	jcard_date_create_search_date, 
			jcard_update	:	jcard_update_search, 
			jcard_date_update	:	jcard_date_update_search_date, 
			jcard_revised	:	jcard_revised_search 
};
		// Cause the datastore to do another query : 
		jual_card_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jual_card_reset_search(){
		// reset the store parameters
		jual_card_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jual_card_DataStore.reload({params: {start: 0, limit: pageS}});
		jual_card_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  jcard_nobukti Search Field */
	jcard_nobuktiSearchField= new Ext.form.TextField({
		id: 'jcard_nobuktiSearchField',
		fieldLabel: 'Jcard Nobukti',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  jcard_tanggal Search Field */
	jcard_tanggalSearchField= new Ext.form.DateField({
		id: 'jcard_tanggalSearchField',
		fieldLabel: 'Jcard Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jcard_nama Search Field */
	jcard_namaSearchField= new Ext.form.TextField({
		id: 'jcard_namaSearchField',
		fieldLabel: 'Jcard Nama',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  jcard_jenis Search Field */
	jcard_jenisSearchField= new Ext.form.TextField({
		id: 'jcard_jenisSearchField',
		fieldLabel: 'Jcard Jenis',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  jcard_no Search Field */
	jcard_noSearchField= new Ext.form.TextField({
		id: 'jcard_noSearchField',
		fieldLabel: 'Jcard No',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  jcard_nilai Search Field */
	jcard_nilaiSearchField= new Ext.form.NumberField({
		id: 'jcard_nilaiSearchField',
		fieldLabel: 'Jcard Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jcard_trans Search Field */
	jcard_transSearchField= new Ext.form.ComboBox({
		id: 'jcard_transSearchField',
		fieldLabel: 'Jcard Trans',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jcard_trans'],
			data:[['produk','produk'],['perawatan','perawatan'],['paket','paket']]
		}),
		mode: 'local',
		displayField: 'jcard_trans',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jcard_creator Search Field */
	jcard_creatorSearchField= new Ext.form.TextField({
		id: 'jcard_creatorSearchField',
		fieldLabel: 'Jcard Creator',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  jcard_date_create Search Field */
	jcard_date_createSearchField= new Ext.form.DateField({
		id: 'jcard_date_createSearchField',
		fieldLabel: 'Jcard Date Create',
		format : 'Y-m-d',
	
	});
	/* Identify  jcard_update Search Field */
	jcard_updateSearchField= new Ext.form.TextField({
		id: 'jcard_updateSearchField',
		fieldLabel: 'Jcard Update',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  jcard_date_update Search Field */
	jcard_date_updateSearchField= new Ext.form.DateField({
		id: 'jcard_date_updateSearchField',
		fieldLabel: 'Jcard Date Update',
		format : 'Y-m-d',
	
	});
	/* Identify  jcard_revised Search Field */
	jcard_revisedSearchField= new Ext.form.NumberField({
		id: 'jcard_revisedSearchField',
		fieldLabel: 'Jcard Revised',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
    
	/* Function for retrieve search Form Panel */
	jual_card_searchForm = new Ext.FormPanel({
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
				items: [jcard_nobuktiSearchFieldjcard_tanggalSearchField, jcard_namaSearchField, jcard_jenisSearchField, jcard_noSearchField, jcard_nilaiSearchField, jcard_transSearchField, jcard_creatorSearchField, jcard_date_createSearchField, jcard_updateSearchField, jcard_date_updateSearchField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jcard_revisedSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jual_card_list_search
			},{
				text: 'Close',
				handler: function(){
					jual_card_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	jual_card_searchWindow = new Ext.Window({
		title: 'jual_card Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jual_card_search',
		items: jual_card_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jual_card_searchWindow.isVisible()){
			jual_card_searchWindow.show();
		} else {
			jual_card_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jual_card_print(){
		var searchquery = "";
		var jcard_nobukti_print=null;
		var jcard_tanggal_print_date="";
		var jcard_nama_print=null;
		var jcard_jenis_print=null;
		var jcard_no_print=null;
		var jcard_nilai_print=null;
		var jcard_trans_print=null;
		var jcard_creator_print=null;
		var jcard_date_create_print_date="";
		var jcard_update_print=null;
		var jcard_date_update_print_date="";
		var jcard_revised_print=null;
		var win;              
		// check if we do have some search data...
		if(jual_card_DataStore.baseParams.query!==null){searchquery = jual_card_DataStore.baseParams.query;}
		if(jual_card_DataStore.baseParams.jcard_nobukti!==null){jcard_nobukti_print = jual_card_DataStore.baseParams.jcard_nobukti;}
		if(jual_card_DataStore.baseParams.jcard_tanggal!==""){jcard_tanggal_print_date = jual_card_DataStore.baseParams.jcard_tanggal;}
		if(jual_card_DataStore.baseParams.jcard_nama!==null){jcard_nama_print = jual_card_DataStore.baseParams.jcard_nama;}
		if(jual_card_DataStore.baseParams.jcard_jenis!==null){jcard_jenis_print = jual_card_DataStore.baseParams.jcard_jenis;}
		if(jual_card_DataStore.baseParams.jcard_no!==null){jcard_no_print = jual_card_DataStore.baseParams.jcard_no;}
		if(jual_card_DataStore.baseParams.jcard_nilai!==null){jcard_nilai_print = jual_card_DataStore.baseParams.jcard_nilai;}
		if(jual_card_DataStore.baseParams.jcard_trans!==null){jcard_trans_print = jual_card_DataStore.baseParams.jcard_trans;}
		if(jual_card_DataStore.baseParams.jcard_creator!==null){jcard_creator_print = jual_card_DataStore.baseParams.jcard_creator;}
		if(jual_card_DataStore.baseParams.jcard_date_create!==""){jcard_date_create_print_date = jual_card_DataStore.baseParams.jcard_date_create;}
		if(jual_card_DataStore.baseParams.jcard_update!==null){jcard_update_print = jual_card_DataStore.baseParams.jcard_update;}
		if(jual_card_DataStore.baseParams.jcard_date_update!==""){jcard_date_update_print_date = jual_card_DataStore.baseParams.jcard_date_update;}
		if(jual_card_DataStore.baseParams.jcard_revised!==null){jcard_revised_print = jual_card_DataStore.baseParams.jcard_revised;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jual_card&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jcard_nobukti : jcard_nobukti_print,
		  	jcard_tanggal : jcard_tanggal_print_date, 
			jcard_nama : jcard_nama_print,
			jcard_jenis : jcard_jenis_print,
			jcard_no : jcard_no_print,
			jcard_nilai : jcard_nilai_print,
			jcard_trans : jcard_trans_print,
			jcard_creator : jcard_creator_print,
		  	jcard_date_create : jcard_date_create_print_date, 
			jcard_update : jcard_update_print,
		  	jcard_date_update : jcard_date_update_print_date, 
			jcard_revised : jcard_revised_print,
		  	currentlisting: jual_card_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./jual_cardlist.html','jual_cardlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jual_card_export_excel(){
		var searchquery = "";
		var jcard_nobukti_2excel=null;
		var jcard_tanggal_2excel_date="";
		var jcard_nama_2excel=null;
		var jcard_jenis_2excel=null;
		var jcard_no_2excel=null;
		var jcard_nilai_2excel=null;
		var jcard_trans_2excel=null;
		var jcard_creator_2excel=null;
		var jcard_date_create_2excel_date="";
		var jcard_update_2excel=null;
		var jcard_date_update_2excel_date="";
		var jcard_revised_2excel=null;
		var win;              
		// check if we do have some search data...
		if(jual_card_DataStore.baseParams.query!==null){searchquery = jual_card_DataStore.baseParams.query;}
		if(jual_card_DataStore.baseParams.jcard_nobukti!==null){jcard_nobukti_2excel = jual_card_DataStore.baseParams.jcard_nobukti;}
		if(jual_card_DataStore.baseParams.jcard_tanggal!==""){jcard_tanggal_2excel_date = jual_card_DataStore.baseParams.jcard_tanggal;}
		if(jual_card_DataStore.baseParams.jcard_nama!==null){jcard_nama_2excel = jual_card_DataStore.baseParams.jcard_nama;}
		if(jual_card_DataStore.baseParams.jcard_jenis!==null){jcard_jenis_2excel = jual_card_DataStore.baseParams.jcard_jenis;}
		if(jual_card_DataStore.baseParams.jcard_no!==null){jcard_no_2excel = jual_card_DataStore.baseParams.jcard_no;}
		if(jual_card_DataStore.baseParams.jcard_nilai!==null){jcard_nilai_2excel = jual_card_DataStore.baseParams.jcard_nilai;}
		if(jual_card_DataStore.baseParams.jcard_trans!==null){jcard_trans_2excel = jual_card_DataStore.baseParams.jcard_trans;}
		if(jual_card_DataStore.baseParams.jcard_creator!==null){jcard_creator_2excel = jual_card_DataStore.baseParams.jcard_creator;}
		if(jual_card_DataStore.baseParams.jcard_date_create!==""){jcard_date_create_2excel_date = jual_card_DataStore.baseParams.jcard_date_create;}
		if(jual_card_DataStore.baseParams.jcard_update!==null){jcard_update_2excel = jual_card_DataStore.baseParams.jcard_update;}
		if(jual_card_DataStore.baseParams.jcard_date_update!==""){jcard_date_update_2excel_date = jual_card_DataStore.baseParams.jcard_date_update;}
		if(jual_card_DataStore.baseParams.jcard_revised!==null){jcard_revised_2excel = jual_card_DataStore.baseParams.jcard_revised;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jual_card&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jcard_nobukti : jcard_nobukti_2excel,
		  	jcard_tanggal : jcard_tanggal_2excel_date, 
			jcard_nama : jcard_nama_2excel,
			jcard_jenis : jcard_jenis_2excel,
			jcard_no : jcard_no_2excel,
			jcard_nilai : jcard_nilai_2excel,
			jcard_trans : jcard_trans_2excel,
			jcard_creator : jcard_creator_2excel,
		  	jcard_date_create : jcard_date_create_2excel_date, 
			jcard_update : jcard_update_2excel,
		  	jcard_date_update : jcard_date_update_2excel_date, 
			jcard_revised : jcard_revised_2excel,
		  	currentlisting: jual_card_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_jual_card"></div>
		<div id="elwindow_jual_card_create"></div>
        <div id="elwindow_jual_card_search"></div>
    </div>
</div>
</body>