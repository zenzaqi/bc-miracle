<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: promo View
	+ Description	: For record view
	+ Filename 		: v_promo.php
 	+ Author  		: 
 	+ Created on 27/Aug/2009 08:57:17
	
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
var promo_DataStore;
var promo_ColumnModel;
var promoListEditorGrid;
var promo_createForm;
var promo_createWindow;
var promo_searchForm;
var promo_searchWindow;
var promo_SelectedRow;
var promo_ContextMenu;
//for detail data
var promo_berlaku_DataStor;
var promo_berlakuListEditorGrid;
var promo_berlaku_ColumnModel;
var promo_berlaku_proxy;
var promo_berlaku_writer;
var promo_berlaku_reader;
var editor_promo_berlaku;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var promo_idField;
var promo_acaraField;
var promo_tempatField;
var promo_tglmulaiField;
var promo_tglselesaiField;
var promo_cashbackField;
var promo_mincashField;
var promo_diskonField;
var promo_allprodukField;
var promo_allrawatField;
var promo_idSearchField;
var promo_acaraSearchField;
var promo_tempatSearchField;
var promo_tglmulaiSearchField;
var promo_tglselesaiSearchField;
var promo_cashbackSearchField;
var promo_mincashSearchField;
var promo_diskonSearchField;
var promo_allprodukSearchField;
var promo_allrawatSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function promo_update(oGrid_event){
		var promo_id_update_pk="";
		var promo_acara_update=null;
		var promo_tempat_update=null;
		var promo_tglmulai_update_date="";
		var promo_tglselesai_update_date="";
		var promo_cashback_update=null;
		var promo_mincash_update=null;
		var promo_diskon_update=null;
		var promo_allproduk_update=null;
		var promo_allrawat_update=null;

		promo_id_update_pk = oGrid_event.record.data.promo_id;
		if(oGrid_event.record.data.promo_acara!== null){promo_acara_update = oGrid_event.record.data.promo_acara;}
		if(oGrid_event.record.data.promo_tempat!== null){promo_tempat_update = oGrid_event.record.data.promo_tempat;}
	 	if(oGrid_event.record.data.promo_tglmulai!== ""){promo_tglmulai_update_date =oGrid_event.record.data.promo_tglmulai.format('Y-m-d');}
	 	if(oGrid_event.record.data.promo_tglselesai!== ""){promo_tglselesai_update_date =oGrid_event.record.data.promo_tglselesai.format('Y-m-d');}
		if(oGrid_event.record.data.promo_cashback!== null){promo_cashback_update = oGrid_event.record.data.promo_cashback;}
		if(oGrid_event.record.data.promo_mincash!== null){promo_mincash_update = oGrid_event.record.data.promo_mincash;}
		if(oGrid_event.record.data.promo_diskon!== null){promo_diskon_update = oGrid_event.record.data.promo_diskon;}
		if(oGrid_event.record.data.promo_allproduk!== null){promo_allproduk_update = oGrid_event.record.data.promo_allproduk;}
		if(oGrid_event.record.data.promo_allrawat!== null){promo_allrawat_update = oGrid_event.record.data.promo_allrawat;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_promo&m=get_action',
			params: {
				task: "UPDATE",
				promo_id	: promo_id_update_pk, 
				promo_acara	:promo_acara_update,  
				promo_tempat	:promo_tempat_update,  
				promo_tglmulai	: promo_tglmulai_update_date, 
				promo_tglselesai	: promo_tglselesai_update_date, 
				promo_cashback	:promo_cashback_update,  
				promo_mincash	:promo_mincash_update,  
				promo_diskon	:promo_diskon_update,  
				promo_allproduk	:promo_allproduk_update,  
				promo_allrawat	:promo_allrawat_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						promo_DataStore.commitChanges();
						promo_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the promo.',
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
	function promo_create(){
	
		if(is_promo_form_valid()){	
		var promo_id_create=null; 
		var promo_acara_create=null; 
		var promo_tempat_create=null; 
		var promo_tglmulai_create_date=""; 
		var promo_tglselesai_create_date=""; 
		var promo_cashback_create=null; 
		var promo_mincash_create=null; 
		var promo_diskon_create=null; 
		var promo_allproduk_create=null; 
		var promo_allrawat_create=null; 

		if(promo_idField.getValue()!== null){promo_id_create_pk = promo_idField.getValue();} 
		if(promo_acaraField.getValue()!== null){promo_acara_create = promo_acaraField.getValue();} 
		if(promo_tempatField.getValue()!== null){promo_tempat_create = promo_tempatField.getValue();} 
		if(promo_tglmulaiField.getValue()!== ""){promo_tglmulai_create_date = promo_tglmulaiField.getValue().format('Y-m-d');} 
		if(promo_tglselesaiField.getValue()!== ""){promo_tglselesai_create_date = promo_tglselesaiField.getValue().format('Y-m-d');} 
		if(promo_cashbackField.getValue()!== null){promo_cashback_create = promo_cashbackField.getValue();} 
		if(promo_mincashField.getValue()!== null){promo_mincash_create = promo_mincashField.getValue();} 
		if(promo_diskonField.getValue()!== null){promo_diskon_create = promo_diskonField.getValue();} 
		if(promo_allprodukField.getValue()!== null){promo_allproduk_create = promo_allprodukField.getValue();} 
		if(promo_allrawatField.getValue()!== null){promo_allrawat_create = promo_allrawatField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_promo&m=get_action',
			params: {
				task: post2db,
				promo_id	: promo_id_create_pk, 
				promo_acara	: promo_acara_create, 
				promo_tempat	: promo_tempat_create, 
				promo_tglmulai	: promo_tglmulai_create_date, 
				promo_tglselesai	: promo_tglselesai_create_date, 
				promo_cashback	: promo_cashback_create, 
				promo_mincash	: promo_mincash_create, 
				promo_diskon	: promo_diskon_create, 
				promo_allproduk	: promo_allproduk_create, 
				promo_allrawat	: promo_allrawat_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						promo_berlaku_purge()
						promo_berlaku_insert();
						Ext.MessageBox.alert(post2db+' OK','The Promo was '+msg+' successfully.');
						promo_DataStore.reload();
						promo_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Promo.',
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
			return promoListEditorGrid.getSelectionModel().getSelected().get('promo_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function promo_reset_form(){
		promo_idField.reset();
		promo_idField.setValue(null);
		promo_acaraField.reset();
		promo_acaraField.setValue(null);
		promo_tempatField.reset();
		promo_tempatField.setValue(null);
		promo_tglmulaiField.reset();
		promo_tglmulaiField.setValue(null);
		promo_tglselesaiField.reset();
		promo_tglselesaiField.setValue(null);
		promo_cashbackField.reset();
		promo_cashbackField.setValue(null);
		promo_mincashField.reset();
		promo_mincashField.setValue(null);
		promo_diskonField.reset();
		promo_diskonField.setValue(null);
		promo_allprodukField.reset();
		promo_allprodukField.setValue(null);
		promo_allrawatField.reset();
		promo_allrawatField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function promo_set_form(){
		promo_idField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_id'));
		promo_acaraField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_acara'));
		promo_tempatField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_tempat'));
		promo_tglmulaiField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_tglmulai'));
		promo_tglselesaiField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_tglselesai'));
		promo_cashbackField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_cashback'));
		promo_mincashField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_mincash'));
		promo_diskonField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_diskon'));
		promo_allprodukField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_allproduk'));
		promo_allrawatField.setValue(promoListEditorGrid.getSelectionModel().getSelected().get('promo_allrawat'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_promo_form_valid(){
		return (true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!promo_createWindow.isVisible()){
			promo_reset_form();
			post2db='CREATE';
			msg='created';
			promo_createWindow.show();
		} else {
			promo_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function promo_confirm_delete(){
		// only one promo is selected here
		if(promoListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', promo_delete);
		} else if(promoListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', promo_delete);
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
	function promo_confirm_update(){
		/* only one record is selected here */
		if(promoListEditorGrid.selModel.getCount() == 1) {
			promo_set_form();
			post2db='UPDATE';
			promo_berlaku_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			promo_createWindow.show();
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
	function promo_delete(btn){
		if(btn=='yes'){
			var selections = promoListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< promoListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.promo_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_promo&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							promo_DataStore.reload();
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
	promo_DataStore = new Ext.data.Store({
		id: 'promo_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_promo&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'promo_id'
		},[
		/* dataIndex => insert intopromo_ColumnModel, Mapping => for initiate table column */ 
			{name: 'promo_id', type: 'int', mapping: 'promo_id'}, 
			{name: 'promo_acara', type: 'string', mapping: 'promo_acara'}, 
			{name: 'promo_tempat', type: 'string', mapping: 'promo_tempat'}, 
			{name: 'promo_tglmulai', type: 'date', dateFormat: 'Y-m-d', mapping: 'promo_tglmulai'}, 
			{name: 'promo_tglselesai', type: 'date', dateFormat: 'Y-m-d', mapping: 'promo_tglselesai'}, 
			{name: 'promo_cashback', type: 'float', mapping: 'promo_cashback'}, 
			{name: 'promo_mincash', type: 'float', mapping: 'promo_mincash'}, 
			{name: 'promo_diskon', type: 'float', mapping: 'promo_diskon'}, 
			{name: 'promo_allproduk', type: 'string', mapping: 'promo_allproduk'}, 
			{name: 'promo_allrawat', type: 'string', mapping: 'promo_allrawat'}, 
			{name: 'promo_creator', type: 'string', mapping: 'promo_creator'}, 
			{name: 'promo_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'promo_date_create'}, 
			{name: 'promo_update', type: 'string', mapping: 'promo_update'}, 
			{name: 'promo_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'promo_date_update'}, 
			{name: 'promo_revised', type: 'int', mapping: 'promo_revised'} 
		]),
		sortInfo:{field: 'promo_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	promo_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'promo_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Acara',
			dataIndex: 'promo_acara',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Tempat',
			dataIndex: 'promo_tempat',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Tgl Mulai',
			dataIndex: 'promo_tglmulai',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Tgl Selesai',
			dataIndex: 'promo_tglselesai',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Creator',
			dataIndex: 'promo_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Create on',
			dataIndex: 'promo_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'promo_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'promo_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'promo_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	promo_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	promoListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'promoListEditorGrid',
		el: 'fp_promo',
		title: 'List Of Promo',
		autoHeight: true,
		store: promo_DataStore, // DataStore
		cm: promo_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: promo_DataStore,
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
			handler: promo_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: promo_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: promo_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: promo_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: promo_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: promo_print  
		}
		]
	});
	promoListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	promo_ContextMenu = new Ext.menu.Menu({
		id: 'promo_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: promo_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: promo_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: promo_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: promo_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onpromo_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		promo_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		promo_SelectedRow=rowIndex;
		promo_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function promo_editContextMenu(){
		promoListEditorGrid.startEditing(promo_SelectedRow,1);
  	}
	/* End of Function */
  	
	promoListEditorGrid.addListener('rowcontextmenu', onpromo_ListEditGridContextMenu);
	promo_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	promoListEditorGrid.on('afteredit', promo_update); // inLine Editing Record
	
	/* Identify  promo_id Field */
	promo_idField= new Ext.form.NumberField({
		id: 'promo_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  promo_acara Field */
	promo_acaraField= new Ext.form.TextField({
		id: 'promo_acaraField',
		fieldLabel: 'Acara',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  promo_tempat Field */
	promo_tempatField= new Ext.form.TextField({
		id: 'promo_tempatField',
		fieldLabel: 'Tempat',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  promo_tglmulai Field */
	promo_tglmulaiField= new Ext.form.DateField({
		id: 'promo_tglmulaiField',
		fieldLabel: 'Tgl Mulai',
		format : 'Y-m-d',
	});
	/* Identify  promo_tglselesai Field */
	promo_tglselesaiField= new Ext.form.DateField({
		id: 'promo_tglselesaiField',
		fieldLabel: 'Tgl Selesai',
		format : 'Y-m-d',
	});
	/* Identify  promo_cashback Field */
	promo_cashbackField= new Ext.form.NumberField({
		id: 'promo_cashbackField',
		fieldLabel: 'Cashback (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '50%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  promo_mincash Field */
	promo_mincashField= new Ext.form.NumberField({
		id: 'promo_mincashField',
		fieldLabel: 'Minimal Transaksi (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '50%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  promo_diskon Field */
	promo_diskonField= new Ext.form.NumberField({
		id: 'promo_diskonField',
		fieldLabel: 'Diskon (%)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '50%',
		maxLength: 2,
		maskRe: /([0-9]+)$/
	});
	/* Identify  promo_allproduk Field */
	promo_allprodukField= new Ext.form.ComboBox({
		id: 'promo_allprodukField',
		fieldLabel: 'Berlaku untuk semua produk ?',
		store:new Ext.data.SimpleStore({
			fields:['promo_allproduk_value', 'promo_allproduk_display'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'promo_allproduk_display',
		valueField: 'promo_allproduk_value',
		anchor: '30%',
		triggerAction: 'all'	
	});
	/* Identify  promo_allrawat Field */
	promo_allrawatField= new Ext.form.ComboBox({
		id: 'promo_allrawatField',
		fieldLabel: 'Berlaku untuk semua perawatan',
		store:new Ext.data.SimpleStore({
			fields:['promo_allrawat_value', 'promo_allrawat_display'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'promo_allrawat_display',
		valueField: 'promo_allrawat_value',
		anchor: '30%',
		triggerAction: 'all'	
	});
  	/*Fieldset Master*/
	promo_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [promo_acaraField, promo_tempatField, promo_tglmulaiField, promo_tglselesaiField, promo_idField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [promo_cashbackField, promo_mincashField, promo_diskonField, promo_allprodukField, promo_allrawatField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var promo_berlaku_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'bpromo_id', type: 'int', mapping: 'bpromo_id'}, 
			{name: 'bpromo_master', type: 'int', mapping: 'bpromo_master'}, 
			{name: 'bpromo_produk', type: 'string', mapping: 'bpromo_produk'} 
	]);
	//eof
	
	//function for json writer of detail
	var promo_berlaku_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	promo_berlaku_DataStore = new Ext.data.Store({
		id: 'promo_berlaku_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_promo&m=detail_promo_berlaku_list', 
			method: 'POST'
		}),
		reader: promo_berlaku_reader,
		baseParams:{master_id: promo_idField.getValue()},
		sortInfo:{field: 'bpromo_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_promo_berlaku= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	cbo_promo_produkDataStore = new Ext.data.Store({
		id: 'cbo_promo_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_promo&m=get_produk_rawat_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'produk_rawat_kode', type: 'string', mapping: 'produk_rawat_kode'},
			{name: 'produk_rawat_nama', type: 'string', mapping: 'produk_rawat_nama'},
			{name: 'produk_rawat_jenis', type: 'string', mapping: 'produk_rawat_jenis'}
		]),
		sortInfo:{field: 'produk_rawat_nama', direction: "ASC"}
	});
	
	
	Ext.util.Format.comboRenderer = function(combo){
		cbo_voucher_produkDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_promo_produk_rawat=new Ext.form.ComboBox({
			store: cbo_voucher_produkDataStore,
			id: 'bpromo_produk',
			mode: 'remote',
			typeAhead: true,
			displayField: 'produk_rawat_nama',
			valueField: 'produk_rawat_kode',
			triggerAction: 'all',
			lazyRender:true

	});
	
	
	//declaration of detail coloumn model
	promo_berlaku_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Produk/Perawatan',
			dataIndex: 'bpromo_produk',
			width: 150,
			sortable: true,
			editor: combo_promo_produk_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_promo_produk_rawat)
		}]
	);
	promo_berlaku_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	promo_berlakuListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'promo_berlakuListEditorGrid',
		el: 'fp_promo_berlaku',
		title: 'Detail berlaku pada Produk/Perawatan',
		height: 250,
		width: 690,
		autoScroll: true,
		store: promo_berlaku_DataStore, // DataStore
		colModel: promo_berlaku_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_promo_berlaku],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: promo_berlaku_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: promo_berlaku_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: promo_berlaku_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function promo_berlaku_add(){
		var edit_promo_berlaku= new promo_berlakuListEditorGrid.store.recordType({
			bpromo_id	:'',		
			bpromo_master	:'',		
			bpromo_produk	:''		
		});
		editor_promo_berlaku.stopEditing();
		promo_berlaku_DataStore.insert(0, edit_promo_berlaku);
		promo_berlakuListEditorGrid.getView().refresh();
		promo_berlakuListEditorGrid.getSelectionModel().selectRow(0);
		editor_promo_berlaku.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_promo_berlaku(){
		promo_berlaku_DataStore.commitChanges();
		promo_berlakuListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function promo_berlaku_insert(){
		for(i=0;i<promo_berlaku_DataStore.getCount();i++){
			promo_berlaku_record=promo_berlaku_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_promo&m=detail_promo_berlaku_insert',
				params:{
				bpromo_id	: promo_berlaku_record.data.bpromo_id, 
				bpromo_master	: eval(promo_idField.getValue()), 
				bpromo_produk	: promo_berlaku_record.data.bpromo_produk 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function promo_berlaku_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_promo&m=detail_promo_berlaku_purge',
			params:{ master_id: eval(promo_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function promo_berlaku_confirm_delete(){
		// only one record is selected here
		if(promo_berlakuListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', promo_berlaku_delete);
		} else if(promo_berlakuListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', promo_berlaku_delete);
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
	//eof
	
	//function for Delete of detail
	function promo_berlaku_delete(btn){
		if(btn=='yes'){
			var s = promo_berlakuListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				promo_berlaku_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	promo_berlaku_DataStore.on('update', refresh_promo_berlaku);
	
	/* Function for retrieve create Window Panel*/ 
	promo_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [promo_masterGroup,promo_berlakuListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: promo_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					promo_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	promo_createWindow= new Ext.Window({
		id: 'promo_createWindow',
		title: post2db+'Promo',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_promo_create',
		items: promo_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function promo_list_search(){
		// render according to a SQL date format.
		var promo_id_search=null;
		var promo_acara_search=null;
		var promo_tempat_search=null;
		var promo_tglmulai_search_date="";
		var promo_tglselesai_search_date="";
		var promo_cashback_search=null;
		var promo_mincash_search=null;
		var promo_diskon_search=null;
		var promo_allproduk_search=null;
		var promo_allrawat_search=null;

		if(promo_idSearchField.getValue()!==null){promo_id_search=promo_idSearchField.getValue();}
		if(promo_acaraSearchField.getValue()!==null){promo_acara_search=promo_acaraSearchField.getValue();}
		if(promo_tempatSearchField.getValue()!==null){promo_tempat_search=promo_tempatSearchField.getValue();}
		if(promo_tglmulaiSearchField.getValue()!==""){promo_tglmulai_search_date=promo_tglmulaiSearchField.getValue().format('Y-m-d');}
		if(promo_tglselesaiSearchField.getValue()!==""){promo_tglselesai_search_date=promo_tglselesaiSearchField.getValue().format('Y-m-d');}
		if(promo_cashbackSearchField.getValue()!==null){promo_cashback_search=promo_cashbackSearchField.getValue();}
		if(promo_mincashSearchField.getValue()!==null){promo_mincash_search=promo_mincashSearchField.getValue();}
		if(promo_diskonSearchField.getValue()!==null){promo_diskon_search=promo_diskonSearchField.getValue();}
		if(promo_allprodukSearchField.getValue()!==null){promo_allproduk_search=promo_allprodukSearchField.getValue();}
		if(promo_allrawatSearchField.getValue()!==null){promo_allrawat_search=promo_allrawatSearchField.getValue();}
		// change the store parameters
		promo_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			promo_id	:	promo_id_search, 
			promo_acara	:	promo_acara_search, 
			promo_tempat	:	promo_tempat_search, 
			promo_tglmulai	:	promo_tglmulai_search_date, 
			promo_tglselesai	:	promo_tglselesai_search_date, 
			promo_cashback	:	promo_cashback_search, 
			promo_mincash	:	promo_mincash_search, 
			promo_diskon	:	promo_diskon_search, 
			promo_allproduk	:	promo_allproduk_search, 
			promo_allrawat	:	promo_allrawat_search, 
		};
		// Cause the datastore to do another query : 
		promo_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function promo_reset_search(){
		// reset the store parameters
		promo_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		promo_DataStore.reload({params: {start: 0, limit: pageS}});
		promo_searchWindow.close();
	};
	/* End of Fuction */

	function promo_reset_SearchForm(){
		promo_acaraSearchField.reset();
		promo_tempatSearchField.reset();
		promo_tglmulaiSearchField.reset();
		promo_tglselesaiSearchField.reset();
		promo_cashbackSearchField.reset();
		promo_mincashSearchField.reset();
		promo_diskonSearchField.reset();
		promo_allprodukSearchField.reset();
		promo_allrawatSearchField.reset();
	}

	
	/* Field for search */
	/* Identify  promo_id Search Field */
	promo_idSearchField= new Ext.form.NumberField({
		id: 'promo_idSearchField',
		fieldLabel: 'Promo Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  promo_acara Search Field */
	promo_acaraSearchField= new Ext.form.TextField({
		id: 'promo_acaraSearchField',
		fieldLabel: 'Promo Acara',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  promo_tempat Search Field */
	promo_tempatSearchField= new Ext.form.TextField({
		id: 'promo_tempatSearchField',
		fieldLabel: 'Promo Tempat',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  promo_tglmulai Search Field */
	promo_tglmulaiSearchField= new Ext.form.DateField({
		id: 'promo_tglmulaiSearchField',
		fieldLabel: 'Promo Tglmulai',
		format : 'Y-m-d',
	
	});
	/* Identify  promo_tglselesai Search Field */
	promo_tglselesaiSearchField= new Ext.form.DateField({
		id: 'promo_tglselesaiSearchField',
		fieldLabel: 'Promo Tglselesai',
		format : 'Y-m-d',
	
	});
	/* Identify  promo_cashback Search Field */
	promo_cashbackSearchField= new Ext.form.NumberField({
		id: 'promo_cashbackSearchField',
		fieldLabel: 'Promo Cashback',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  promo_mincash Search Field */
	promo_mincashSearchField= new Ext.form.NumberField({
		id: 'promo_mincashSearchField',
		fieldLabel: 'Promo Mincash',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  promo_diskon Search Field */
	promo_diskonSearchField= new Ext.form.NumberField({
		id: 'promo_diskonSearchField',
		fieldLabel: 'Promo Diskon',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  promo_allproduk Search Field */
	promo_allprodukSearchField= new Ext.form.ComboBox({
		id: 'promo_allprodukSearchField',
		fieldLabel: 'Promo Allproduk',
		store:new Ext.data.SimpleStore({
			fields:['value', 'promo_allproduk'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'promo_allproduk',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  promo_allrawat Search Field */
	promo_allrawatSearchField= new Ext.form.ComboBox({
		id: 'promo_allrawatSearchField',
		fieldLabel: 'Promo Allrawat',
		store:new Ext.data.SimpleStore({
			fields:['value', 'promo_allrawat'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'promo_allrawat',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	promo_searchForm = new Ext.FormPanel({
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
				items: [promo_idSearchField, promo_acaraSearchField, promo_tempatSearchField, promo_tglmulaiSearchField, promo_tglselesaiSearchField, promo_cashbackSearchField, promo_mincashSearchField, promo_diskonSearchField, promo_allprodukSearchField, promo_allrawatSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: promo_list_search
			},{
				text: 'Close',
				handler: function(){
					promo_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	promo_searchWindow = new Ext.Window({
		title: 'promo Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_promo_search',
		items: promo_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!promo_searchWindow.isVisible()){
			promo_reset_SearchForm();
			promo_searchWindow.show();
		} else {
			promo_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function promo_print(){
		var searchquery = "";
		var promo_id_print=null;
		var promo_acara_print=null;
		var promo_tempat_print=null;
		var promo_tglmulai_print_date="";
		var promo_tglselesai_print_date="";
		var promo_cashback_print=null;
		var promo_mincash_print=null;
		var promo_diskon_print=null;
		var promo_allproduk_print=null;
		var promo_allrawat_print=null;
		var win;              
		// check if we do have some search data...
		if(promo_DataStore.baseParams.query!==null){searchquery = promo_DataStore.baseParams.query;}
		if(promo_DataStore.baseParams.promo_id!==null){promo_id_print = promo_DataStore.baseParams.promo_id;}
		if(promo_DataStore.baseParams.promo_acara!==null){promo_acara_print = promo_DataStore.baseParams.promo_acara;}
		if(promo_DataStore.baseParams.promo_tempat!==null){promo_tempat_print = promo_DataStore.baseParams.promo_tempat;}
		if(promo_DataStore.baseParams.promo_tglmulai!==""){promo_tglmulai_print_date = promo_DataStore.baseParams.promo_tglmulai;}
		if(promo_DataStore.baseParams.promo_tglselesai!==""){promo_tglselesai_print_date = promo_DataStore.baseParams.promo_tglselesai;}
		if(promo_DataStore.baseParams.promo_cashback!==null){promo_cashback_print = promo_DataStore.baseParams.promo_cashback;}
		if(promo_DataStore.baseParams.promo_mincash!==null){promo_mincash_print = promo_DataStore.baseParams.promo_mincash;}
		if(promo_DataStore.baseParams.promo_diskon!==null){promo_diskon_print = promo_DataStore.baseParams.promo_diskon;}
		if(promo_DataStore.baseParams.promo_allproduk!==null){promo_allproduk_print = promo_DataStore.baseParams.promo_allproduk;}
		if(promo_DataStore.baseParams.promo_allrawat!==null){promo_allrawat_print = promo_DataStore.baseParams.promo_allrawat;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_promo&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			promo_id : promo_id_print,
			promo_acara : promo_acara_print,
			promo_tempat : promo_tempat_print,
		  	promo_tglmulai : promo_tglmulai_print_date, 
		  	promo_tglselesai : promo_tglselesai_print_date, 
			promo_cashback : promo_cashback_print,
			promo_mincash : promo_mincash_print,
			promo_diskon : promo_diskon_print,
			promo_allproduk : promo_allproduk_print,
			promo_allrawat : promo_allrawat_print,
		  	currentlisting: promo_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./promolist.html','promolist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function promo_export_excel(){
		var searchquery = "";
		var promo_id_2excel=null;
		var promo_acara_2excel=null;
		var promo_tempat_2excel=null;
		var promo_tglmulai_2excel_date="";
		var promo_tglselesai_2excel_date="";
		var promo_cashback_2excel=null;
		var promo_mincash_2excel=null;
		var promo_diskon_2excel=null;
		var promo_allproduk_2excel=null;
		var promo_allrawat_2excel=null;
		var win;              
		// check if we do have some search data...
		if(promo_DataStore.baseParams.query!==null){searchquery = promo_DataStore.baseParams.query;}
		if(promo_DataStore.baseParams.promo_id!==null){promo_id_2excel = promo_DataStore.baseParams.promo_id;}
		if(promo_DataStore.baseParams.promo_acara!==null){promo_acara_2excel = promo_DataStore.baseParams.promo_acara;}
		if(promo_DataStore.baseParams.promo_tempat!==null){promo_tempat_2excel = promo_DataStore.baseParams.promo_tempat;}
		if(promo_DataStore.baseParams.promo_tglmulai!==""){promo_tglmulai_2excel_date = promo_DataStore.baseParams.promo_tglmulai;}
		if(promo_DataStore.baseParams.promo_tglselesai!==""){promo_tglselesai_2excel_date = promo_DataStore.baseParams.promo_tglselesai;}
		if(promo_DataStore.baseParams.promo_cashback!==null){promo_cashback_2excel = promo_DataStore.baseParams.promo_cashback;}
		if(promo_DataStore.baseParams.promo_mincash!==null){promo_mincash_2excel = promo_DataStore.baseParams.promo_mincash;}
		if(promo_DataStore.baseParams.promo_diskon!==null){promo_diskon_2excel = promo_DataStore.baseParams.promo_diskon;}
		if(promo_DataStore.baseParams.promo_allproduk!==null){promo_allproduk_2excel = promo_DataStore.baseParams.promo_allproduk;}
		if(promo_DataStore.baseParams.promo_allrawat!==null){promo_allrawat_2excel = promo_DataStore.baseParams.promo_allrawat;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_promo&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			promo_id : promo_id_2excel,
			promo_acara : promo_acara_2excel,
			promo_tempat : promo_tempat_2excel,
		  	promo_tglmulai : promo_tglmulai_2excel_date, 
		  	promo_tglselesai : promo_tglselesai_2excel_date, 
			promo_cashback : promo_cashback_2excel,
			promo_mincash : promo_mincash_2excel,
			promo_diskon : promo_diskon_2excel,
			promo_allproduk : promo_allproduk_2excel,
			promo_allrawat : promo_allrawat_2excel,
		  	currentlisting: promo_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_promo"></div>
         <div id="fp_promo_berlaku"></div>
		<div id="elwindow_promo_create"></div>
        <div id="elwindow_promo_search"></div>
    </div>
</div>
</body>