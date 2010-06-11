<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_umum View
	+ Description	: For record view
	+ Filename 		: v_jurnal_umum.php
 	+ creator  		: 
 	+ Created on 01/Apr/2010 12:13:56
	
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
var jurnal_umum_DataStore;
var jurnal_umum_ColumnModel;
var jurnal_umumListEditorGrid;
var jurnal_umum_saveForm;
var jurnal_umum_saveWindow;
var jurnal_umum_searchForm;
var jurnal_umum_searchWindow;
var jurnal_umum_SelectedRow;
var jurnal_umum_ContextMenu;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var today=new Date().format('Y-m-d');

/* declare variable here for Field*/
var jurnal_idField;
var jurnal_tanggalField;
var jurnal_akunField;
var jurnal_keteranganField;
var jurnal_norefField;
var jurnal_debetField;
var jurnal_kreditField;
var jurnal_unitField;
var jurnal_postField;
var jurnal_date_postField;
var jurnal_idSearchField;
var jurnal_tanggalSearchField;
var jurnal_akunSearchField;
var jurnal_keteranganSearchField;
var jurnal_norefSearchField;
var jurnal_debetSearchField;
var jurnal_kreditSearchField;
var jurnal_unitSearchField;
var jurnal_postSearchField;
var jurnal_date_postSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jurnal_umum_inline_update(oGrid_event){
		var jurnal_id_update_pk="";
		var jurnal_tanggal_update_date="";
		var jurnal_keterangan_update=null;
		var jurnal_noref_update=null;
		var jurnal_unit_update=null;


		jurnal_id_update_pk = oGrid_event.record.data.jurnal_id;
	 	if(oGrid_event.record.data.jurnal_tanggal!== ""){jurnal_tanggal_update_date =oGrid_event.record.data.jurnal_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jurnal_keterangan!== null){jurnal_keterangan_update = oGrid_event.record.data.jurnal_keterangan;}
		if(oGrid_event.record.data.jurnal_noref!== null){jurnal_noref_update = oGrid_event.record.data.jurnal_noref;}
		if(oGrid_event.record.data.jurnal_unit!== null){jurnal_unit_update = oGrid_event.record.data.jurnal_unit;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_umum&m=get_action',
			params: {
				jurnal_id			: jurnal_id_update_pk, 
				jurnal_tanggal		: jurnal_tanggal_update_date, 
				jurnal_keterangan	: jurnal_keterangan_update,
				jurnal_noref		: jurnal_noref_update,
				jurnal_unit			: jurnal_unit_update,
				task				: "UPDATE"
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				if(result!==0){
						jurnal_umum_DataStore.load();
					}else{
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data Jurnal Umum tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
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
	function jurnal_umum_save(){
	
		if(is_jurnal_umum_form_valid()){	
			var jurnal_id_field_pk=null; 
			var jurnal_tanggal_field_date=""; 
			var jurnal_keterangan_field=null; 
			var jurnal_noref_field=null; 
			var jurnal_unit_field=null; 

			jurnal_id_field_pk=get_pk_id();
			if(jurnal_tanggalField.getValue()!== ""){jurnal_tanggal_field_date = jurnal_tanggalField.getValue().format('Y-m-d');} 
			if(jurnal_keteranganField.getValue()!== null){jurnal_keterangan_field = jurnal_keteranganField.getValue();} 
			if(jurnal_norefField.getValue()!== null){jurnal_noref_field = jurnal_norefField.getValue();} 
			if(jurnal_unitField.getValue()!== null){jurnal_unit_field = jurnal_unitField.getValue();} 

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_umum&m=get_action',
				params: {
					jurnal_id			: jurnal_id_field_pk, 
					jurnal_tanggal		: jurnal_tanggal_field_date, 
					jurnal_keterangan	: jurnal_keterangan_field, 
					jurnal_noref		: jurnal_noref_field, 
					jurnal_unit			: jurnal_unit_field, 
					task				: post2db
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					if(result!==0){
							detail_jurnal_purge(result)
							jurnal_umum_DataStore.load();
							Ext.MessageBox.alert(post2db+' OK','Data Jurnal Umum berhasil disimpan');
							jurnal_umum_saveWindow.hide();
						}else{
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'Data Jurnal Umum tidak bisa disimpan',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
							});
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
			return jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jurnal_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jurnal_umum_reset_form(){
		jurnal_tanggalField.reset();
		jurnal_tanggalField.setValue(null);
		jurnal_keteranganField.reset();
		jurnal_keteranganField.setValue(null);
		jurnal_norefField.reset();
		jurnal_norefField.setValue(null);
		cbo_akunDataStore.setBaseParam('task','all');
		cbo_akunDataStore.setBaseParam('master_id', get_pk_id());
		cbo_akunDataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_jurnal_DataStore.setBaseParam('master_id',get_pk_id());
					detail_jurnal_DataStore.load();
				}
			}
		});
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jurnal_umum_set_form(){
		jurnal_tanggalField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jurnal_tanggal'));
		jurnal_keteranganField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jurnal_keterangan'));
		jurnal_norefField.setValue(jurnal_umumListEditorGrid.getSelectionModel().getSelected().get('jurnal_noref'));
		
		cbo_akunDataStore.setBaseParam('task','detail');
		cbo_akunDataStore.setBaseParam('master_id', get_pk_id());
		cbo_akunDataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_jurnal_DataStore.setBaseParam('master_id',get_pk_id());
					detail_jurnal_DataStore.load();
				}
			}
		});
		
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jurnal_umum_form_valid(){
		return (jurnal_tanggalField.isValid() && (jurnal_totaldebetField.getValue()==jurnal_totalkreditField.getValue()));
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jurnal_umum_saveWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			jurnal_umum_reset_form();
			jurnal_umum_saveWindow.show();
		} else {
			jurnal_umum_saveWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jurnal_umum_confirm_delete(){
		// only one jurnal_umum is selected here
		if(jurnal_umumListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_umum_delete);
		} else if(jurnal_umumListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_umum_delete);
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
	function jurnal_umum_confirm_update(){
		/* only one record is selected here */
		if(jurnal_umumListEditorGrid.selModel.getCount() == 1) {
			post2db='UPDATE';
			msg='updated';
			jurnal_umum_set_form();
			jurnal_umum_saveWindow.show();
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
	function jurnal_umum_delete(btn){
		if(btn=='yes'){
			var selections = jurnal_umumListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jurnal_umumListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jurnal_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jurnal_umum&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jurnal_umum_DataStore.reload();
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
	jurnal_umum_DataStore = new Ext.data.GroupingStore({
		id: 'jurnal_umum_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_umum&m=get_action', 
			method: 'POST'
		}),
		groupField:'jurnal_tanggal',
		baseParams:{task: "LIST", start: 0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jurnal_detalid'
		},[
			{name: 'jurnal_id', type: 'int', mapping: 'jurnal_id'},
			{name: 'jurnal_detailid', type: 'int', mapping: 'djurnal_id'}, 
			{name: 'jurnal_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jurnal_tanggal'}, 
			{name: 'jurnal_akun', type: 'string', mapping: 'akun_kode'}, 
			{name: 'jurnal_akun_nama', type: 'string', mapping: 'akun_nama'}, 
			{name: 'jurnal_keterangan', type: 'string', mapping: 'djurnal_detail'}, 
			{name: 'jurnal_noref', type: 'string', mapping: 'jurnal_noref'}, 
			{name: 'jurnal_debet', type: 'float', mapping: 'djurnal_debet'}, 
			{name: 'jurnal_kredit', type: 'float', mapping: 'djurnal_kredit'}, 
			{name: 'jurnal_saldo', type: 'float'}, 
			{name: 'jurnal_unit', type: 'int', mapping: 'jurnal_unit'}, 
			{name: 'jurnal_author', type: 'string', mapping: 'jurnal_author'}, 
			{name: 'jurnal_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jurnal_date_create'}, 
			{name: 'jurnal_update', type: 'string', mapping: 'jurnal_update'}, 
			{name: 'jurnal_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jurnal_date_update'}, 
			{name: 'jurnal_post', type: 'string', mapping: 'jurnal_post'}, 
			{name: 'jurnal_date_post', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jurnal_date_post'}, 
			{name: 'jurnal_revised', type: 'int', mapping: 'jurnal_revised'} 
		]),
		sortInfo:{field: 'jurnal_detailid', direction: "DESC"}

	});
	/* End of Function */
    
	Ext.ux.grid.GroupSummary.Calculations['totalSaldo'] = function(v, record, field){
        return v + (record.data.jurnal_debet-record.data.jurnal_kredit);
    };
	
  	/* Function for Identify of Window Column Model */
	jurnal_umum_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jurnal_detailid',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			
			hidden: false
		},
		{
			header: 'Tanggal',
			dataIndex: 'jurnal_tanggal',
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'No. Akun',
			dataIndex: 'jurnal_akun',
			width: 100,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			}),
			summaryType: 'count',
				hideable: false,
				summaryRenderer: function(v, params, data){
					return ((v === 0 || v > 1) ? '(' + v +' data transaksi)' : '(1 data transaksi)');
			},
		}, 
		{
			header: 'Nama Akun',
			dataIndex: 'jurnal_akun_nama',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextArea({
				maxLength: 250			
			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'jurnal_keterangan',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50			
			})
		}, 
		{
			header: 'Nilai Debet (Rp)',
			dataIndex: 'jurnal_debet',
			width: 100,
			align: 'right',
			summaryType: 'sum',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Nilai Kredit (Rp)',
			dataIndex: 'jurnal_kredit',
			width: 100,
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			summaryType: 'sum',
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Unit',
			dataIndex: 'jurnal_unit',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Author',
			dataIndex: 'jurnal_author',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Create on',
			dataIndex: 'jurnal_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'jurnal_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'jurnal_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Posting',
			dataIndex: 'jurnal_post',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Posted on',
			dataIndex: 'jurnal_date_post',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Revised',
			dataIndex: 'jurnal_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}	]);
	
	jurnal_umum_ColumnModel.defaultSortable= true;
	/* End of Function */
    var summary = new Ext.ux.grid.GroupSummary();

	/* Declare DataStore and  show datagrid list */
	jurnal_umumListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_umumListEditorGrid',
		el: 'fp_jurnal_umum',
		title: 'Daftar Jurnal Umum',
		autoHeight: true,
		store: jurnal_umum_DataStore, // DataStore
		cm: jurnal_umum_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1024,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_umum_DataStore,
			displayInfo: true
		}),
		view: new Ext.grid.GroupingView({
            forceFit: true,
            showGroupName: false,
            enableNoGroups: false,
			enableGroupingMenu: false,
            hideGroupedColumn: true
        }),
		plugins: summary,
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
			handler: jurnal_umum_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jurnal_umum_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jurnal_umum_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jurnal_umum_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_umum_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_umum_print  
		}
		]
	});
	jurnal_umumListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jurnal_umum_ContextMenu = new Ext.menu.Menu({
		id: 'jurnal_umum_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jurnal_umum_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jurnal_umum_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_umum_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_umum_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjurnal_umum_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jurnal_umum_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jurnal_umum_SelectedRow=rowIndex;
		jurnal_umum_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jurnal_umum_editContextMenu(){
		//jurnal_umumListEditorGrid.startEditing(jurnal_umum_SelectedRow,1);
		jurnal_umum_confirm_update();
  	}
	/* End of Function */
  	
	jurnal_umumListEditorGrid.addListener('rowcontextmenu', onjurnal_umum_ListEditGridContextMenu);
	jurnal_umum_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore

	
	/* Identify  jurnal_tanggal Field */
	jurnal_tanggalField= new Ext.form.DateField({
		id: 'jurnal_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		value: today,
		allowBlank: false
	});
	
	jurnal_noField=new Ext.form.TextField({
		id: 'jurnal_noField',
		fieldLabel: 'No Jurnal',
		anchor: '95%',
		readOnly: true
	});
	
	/* Identify  jurnal_akun Field */
	jurnal_akunField= new Ext.form.NumberField({
		id: 'jurnal_akunField',
		fieldLabel: 'Akun',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jurnal_keterangan Field */
	jurnal_keteranganField= new Ext.form.TextArea({
		id: 'jurnal_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  jurnal_noref Field */
	jurnal_norefField= new Ext.form.TextField({
		id: 'jurnal_norefField',
		fieldLabel: 'No Ref',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jurnal_debet Field */
	jurnal_debetField= new Ext.form.NumberField({
		id: 'jurnal_debetField',
		fieldLabel: 'Nilai Debet',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		enableKeyEvents: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jurnal_kredit Field */
	jurnal_kreditField= new Ext.form.NumberField({
		id: 'jurnal_kreditField',
		fieldLabel: 'Nilai Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		enableKeyEvents: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jurnal_totaldebetField= new Ext.form.NumberField({
		id: 'jurnal_totaldebetField',
		fieldLabel: 'Total Debet',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		width: 150,
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	/* Identify  jurnal_kredit Field */
	jurnal_totalkreditField= new Ext.form.NumberField({
		id: 'jurnal_totalkreditField',
		fieldLabel: 'Total Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		width: 150,
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	balance_Group = new Ext.form.FieldSet({
		title: 'Balance',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		labelSeparator : ':',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [jurnal_totaldebetField] 
			},{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [jurnal_totalkreditField] 
			}
			]
	
	});
	
	master_Group = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		labelSeparator : ':',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [jurnal_tanggalField, jurnal_noField] 
			},{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [jurnal_keteranganField] 
			}
			]
	
	});
	
	/* Identify  jurnal_unit Field */
	jurnal_unitField= new Ext.form.NumberField({
		id: 'jurnal_unitField',
		fieldLabel: 'Unit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jurnal_post Field */
	jurnal_postField= new Ext.form.ComboBox({
		id: 'jurnal_postField',
		fieldLabel: 'Post',
		store:new Ext.data.SimpleStore({
			fields:['jurnal_post_value', 'jurnal_post_display'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jurnal_post_display',
		valueField: 'jurnal_post_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jurnal_date_post Field */
	jurnal_date_postField= new Ext.form.DateField({
		id: 'jurnal_date_postField',
		fieldLabel: 'Jurnal Date Post',
		format : 'Y-m-d',
	});

	
	//DETAIL DECLARATION
	var jurnal_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'djurnal_id'
	},[
	   	{name: 'djurnal_id', type: 'int', mapping: 'djurnal_id'},
		{name: 'djurnal_akun', type: 'int', mapping: 'djurnal_akun'},
		{name: 'djurnal_kode', type: 'string', mapping: 'akun_kode'}, 
		{name: 'djurnal_detail', type: 'string', mapping: 'djurnal_detail'},
		{name: 'djurnal_debet', type: 'float', mapping: 'djurnal_debet'}, 
		{name: 'djurnal_kredit', type: 'float', mapping: 'djurnal_kredit'}			
	]);
	//eof
	
	//function for json writer of detail
	var detail_jurnal_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	
	detail_jurnal_DataStore = new Ext.data.Store({
		id: 'detail_jurnal_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_umum&m=get_detail_jurnal_list', 
			method: 'POST'
		}),
		reader: jurnal_detail_reader,
		baseParams:{start:0, limit:pageS, task: 'detail', master_id: 0},
		sortInfo:{field: 'djurnal_akun', direction: 'DESC'}
	});
	/* End of Function */
	
	
	//function for editor of detail
	var editor_detail_jurnal= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	
	cbo_akunDataStore = new Ext.data.Store({
		id: 'cbo_akunDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_umum&m=get_akun_list', 
			method: 'POST'
		}),
		baseParams:{start:0,limit:pageS,task:'detail'},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
			{name: 'akun_id', type: 'int', mapping: 'akun_id'},
			{name: 'akun_kode', type: 'string', mapping: 'akun_kode'},
			{name: 'akun_nama', type: 'string', mapping: 'akun_nama'}
		]),
		sortInfo:{field: 'akun_kode', direction: "ASC"}
	});
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var akun_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>[{akun_kode}] - {akun_nama}</b></span>',
        '</div></tpl>'
    );
	
	var combo_akun=new Ext.form.ComboBox({
			store: cbo_akunDataStore,
			mode: 'remote',
			typeAhead: false,
			displayField: 'akun_nama',
			valueField: 'akun_id',
			triggerAction: 'all',
			lazyRender: false,
			pageSize: pageS,
			enableKeyEvents: true,
			tpl: akun_tpl,
			itemSelector: 'div.search-item',
			listClass: 'x-combo-list-small',
			anchor: '95%'
	});
	
	detail_jurnal_ColumnModel = new Ext.grid.ColumnModel(
		[
		 {
			header: '<div align="center">' + 'Nama Akun' + '</div>',
			dataIndex: 'djurnal_akun',
			width: 200,	//250,
			sortable: true,
			editor: combo_akun,
			renderer: Ext.util.Format.comboRenderer(combo_akun)
		},
		{
			header: '<div align="center">' + 'Kode Akun' + '</div>',
			dataIndex: 'djurnal_kode',
			width: 80,
			editor: jurnal_akunField,
			readOnly: true
		},{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'djurnal_detail',
			width: 200,
			editor: new Ext.form.TextField({})
		},
		{
			header: '<div align="center">' + 'Debet' + '</div>',
			align: 'right',
			dataIndex: 'djurnal_debet',
			width: 60,	//100,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: jurnal_debetField
		},
		{
			header: '<div align="center">' + 'Kredit' + '</div>',
			align: 'right',
			dataIndex: 'djurnal_kredit',
			width: 60,	//100,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: jurnal_kreditField
			
		}
		]
	);
	detail_jurnal_ColumnModel.defaultSortable= true;
	
	
	
	
	
	//declaration of detail list editor grid
	detail_jurnalListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_jurnalListEditorGrid',
		el: 'fp_detail_jurnal',
		title: 'Detail Jurnal',
		height: 250,
		width: 790,	//690,
		autoScroll: true,
		store: detail_jurnal_DataStore, // DataStore
		colModel: detail_jurnal_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_jurnal],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_jurnal_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_jurnal_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_jurnal_confirm_delete
		}
		]
	});
	//eof
	
	//function of detail add
	function detail_jurnal_add(){
		var edit_detail_jurnal= new detail_jurnalListEditorGrid.store.recordType({
			djurnal_akun			:null,		
			djurnal_detail		:null,		
			djurnal_debet		:0,		
			djurnal_kredit		:0	
		});
		editor_detail_jurnal.stopEditing();
		detail_jurnal_DataStore.insert(0, edit_detail_jurnal);
		detail_jurnalListEditorGrid.getView().refresh();
		detail_jurnalListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_jurnal.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_jurnal(){
		detail_jurnal_DataStore.commitChanges();
		detail_jurnalListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_jurnal_insert(pkid){
		for(i=0;i<detail_jurnal_DataStore.getCount();i++){
			detail_jurnal_record=detail_jurnal_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_umum&m=detail_jurnal_insert',
				params:{
				jurnal_master	: pkid, 
				jurnal_akun		: detail_jurnal_record.data.djurnal_akun, 
				jurnal_detail	: detail_jurnal_record.data.djurnal_detail, 
				jurnal_debet	: detail_jurnal_record.data.djurnal_debet, 
				jurnal_kredit	: detail_jurnal_record.data.djurnal_kredit
				
				}
			});
		}
		jurnal_umum_DataStore.reload();		
	}
	//eof
	
	//function for purge detail
	function detail_jurnal_purge(pkid){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_umum&m=detail_jurnal_purge',
			params:{ jurnal_master: pkid },
			success:function(response){
				detail_jurnal_insert(pkid);
			}
		});
		jurnal_umum_DataStore.reload();
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_jurnal_confirm_delete(){
		// only one record is selected here
		if(detail_jurnalListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_jurnal_delete);
		} else if(detail_jurnalListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_jurnal_delete);
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
	function detail_jurnal_delete(btn){
		if(btn=='yes'){
			var s = detail_jurnalListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_jurnal_DataStore.remove(r);
			}
		} 
		detail_jurnal_DataStore.commitChanges();
	}
	//eof
	
	/* Function for retrieve create Window Panel*/ 
	jurnal_umum_saveForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 800,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [master_Group, detail_jurnalListEditorGrid, balance_Group ] 
			}
			],
		buttons: [{
				text: 'Save and Close',
				handler: jurnal_umum_save
			}
			,{
				text: 'Cancel',
				handler: function(){
					jurnal_umum_saveWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jurnal_umum_saveWindow= new Ext.Window({
		id: 'jurnal_umum_saveWindow',
		title: post2db+'Jurnal Umum',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jurnal_umum_save',
		items: jurnal_umum_saveForm
	});
	/* End Window */
	
	/* Function for action list search */
	function jurnal_umum_list_search(){
		// render according to a SQL date format.
		var jurnal_id_search=null;
		var jurnal_tanggal_search_date="";
		var jurnal_akun_search=null;
		var jurnal_keterangan_search=null;
		var jurnal_noref_search=null;
		var jurnal_debet_search=null;
		var jurnal_kredit_search=null;
		var jurnal_unit_search=null;
		var jurnal_post_search=null;
		var jurnal_date_post_search_date="";

		if(jurnal_idSearchField.getValue()!==null){jurnal_id_search=jurnal_idSearchField.getValue();}
		if(jurnal_tanggalSearchField.getValue()!==""){jurnal_tanggal_search_date=jurnal_tanggalSearchField.getValue().format('Y-m-d');}
		if(jurnal_akunSearchField.getValue()!==null){jurnal_akun_search=jurnal_akunSearchField.getValue();}
		if(jurnal_keteranganSearchField.getValue()!==null){jurnal_keterangan_search=jurnal_keteranganSearchField.getValue();}
		if(jurnal_norefSearchField.getValue()!==null){jurnal_noref_search=jurnal_norefSearchField.getValue();}
		if(jurnal_debetSearchField.getValue()!==null){jurnal_debet_search=jurnal_debetSearchField.getValue();}
		if(jurnal_kreditSearchField.getValue()!==null){jurnal_kredit_search=jurnal_kreditSearchField.getValue();}
		if(jurnal_unitSearchField.getValue()!==null){jurnal_unit_search=jurnal_unitSearchField.getValue();}
		if(jurnal_postSearchField.getValue()!==null){jurnal_post_search=jurnal_postSearchField.getValue();}
		if(jurnal_date_postSearchField.getValue()!==""){jurnal_date_post_search_date=jurnal_date_postSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		jurnal_umum_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jurnal_id	:	jurnal_id_search, 
			jurnal_tanggal	:	jurnal_tanggal_search_date, 
			jurnal_akun	:	jurnal_akun_search, 
			jurnal_keterangan	:	jurnal_keterangan_search, 
			jurnal_noref	:	jurnal_noref_search, 
			jurnal_debet	:	jurnal_debet_search, 
			jurnal_kredit	:	jurnal_kredit_search, 
			jurnal_unit	:	jurnal_unit_search, 
			jurnal_post	:	jurnal_post_search, 
			jurnal_date_post	:	jurnal_date_post_search_date, 
		};
		// Cause the datastore to do another query : 
		jurnal_umum_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jurnal_umum_reset_search(){
		// reset the store parameters
		jurnal_umum_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jurnal_umum_DataStore.reload({params: {start: 0, limit: pageS}});
		jurnal_umum_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  jurnal_id Search Field */
	jurnal_idSearchField= new Ext.form.NumberField({
		id: 'jurnal_idSearchField',
		fieldLabel: 'Jurnal Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jurnal_tanggal Search Field */
	jurnal_tanggalSearchField= new Ext.form.DateField({
		id: 'jurnal_tanggalSearchField',
		fieldLabel: 'Jurnal Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jurnal_akun Search Field */
	jurnal_akunSearchField= new Ext.form.NumberField({
		id: 'jurnal_akunSearchField',
		fieldLabel: 'Jurnal Akun',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jurnal_keterangan Search Field */
	jurnal_keteranganSearchField= new Ext.form.TextField({
		id: 'jurnal_keteranganSearchField',
		fieldLabel: 'Jurnal Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  jurnal_noref Search Field */
	jurnal_norefSearchField= new Ext.form.TextField({
		id: 'jurnal_norefSearchField',
		fieldLabel: 'Jurnal Noref',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  jurnal_debet Search Field */
	jurnal_debetSearchField= new Ext.form.NumberField({
		id: 'jurnal_debetSearchField',
		fieldLabel: 'Jurnal Debet',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jurnal_kredit Search Field */
	jurnal_kreditSearchField= new Ext.form.NumberField({
		id: 'jurnal_kreditSearchField',
		fieldLabel: 'Jurnal Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jurnal_unit Search Field */
	jurnal_unitSearchField= new Ext.form.NumberField({
		id: 'jurnal_unitSearchField',
		fieldLabel: 'Jurnal Unit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jurnal_post Search Field */
	jurnal_postSearchField= new Ext.form.ComboBox({
		id: 'jurnal_postSearchField',
		fieldLabel: 'Jurnal Post',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jurnal_post'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jurnal_post',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jurnal_date_post Search Field */
	jurnal_date_postSearchField= new Ext.form.DateField({
		id: 'jurnal_date_postSearchField',
		fieldLabel: 'Jurnal Date Post',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	jurnal_umum_searchForm = new Ext.FormPanel({
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
				items: [jurnal_tanggalSearchField, jurnal_akunSearchField, jurnal_keteranganSearchField, jurnal_norefSearchField, jurnal_debetSearchField, jurnal_kreditSearchField, jurnal_unitSearchField, ] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jurnal_umum_list_search
			},{
				text: 'Close',
				handler: function(){
					jurnal_umum_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	

	/* Function for retrieve search Window Form, used for andvaced search */
	jurnal_umum_searchWindow = new Ext.Window({
		title: 'jurnal_umum Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jurnal_umum_search',
		items: jurnal_umum_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jurnal_umum_searchWindow.isVisible()){
			jurnal_umum_searchWindow.show();
		} else {
			jurnal_umum_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jurnal_umum_print(){
		var searchquery = "";
		var jurnal_tanggal_print_date="";
		var jurnal_akun_print=null;
		var jurnal_keterangan_print=null;
		var jurnal_noref_print=null;
		var jurnal_debet_print=null;
		var jurnal_kredit_print=null;
		var jurnal_unit_print=null;
		var jurnal_post_print=null;
		var jurnal_date_post_print_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_umum_DataStore.baseParams.query!==null){searchquery = jurnal_umum_DataStore.baseParams.query;}
		if(jurnal_umum_DataStore.baseParams.jurnal_tanggal!==""){jurnal_tanggal_print_date = jurnal_umum_DataStore.baseParams.jurnal_tanggal;}
		if(jurnal_umum_DataStore.baseParams.jurnal_akun!==null){jurnal_akun_print = jurnal_umum_DataStore.baseParams.jurnal_akun;}
		if(jurnal_umum_DataStore.baseParams.jurnal_keterangan!==null){jurnal_keterangan_print = jurnal_umum_DataStore.baseParams.jurnal_keterangan;}
		if(jurnal_umum_DataStore.baseParams.jurnal_noref!==null){jurnal_noref_print = jurnal_umum_DataStore.baseParams.jurnal_noref;}
		if(jurnal_umum_DataStore.baseParams.jurnal_debet!==null){jurnal_debet_print = jurnal_umum_DataStore.baseParams.jurnal_debet;}
		if(jurnal_umum_DataStore.baseParams.jurnal_kredit!==null){jurnal_kredit_print = jurnal_umum_DataStore.baseParams.jurnal_kredit;}
		if(jurnal_umum_DataStore.baseParams.jurnal_unit!==null){jurnal_unit_print = jurnal_umum_DataStore.baseParams.jurnal_unit;}
		if(jurnal_umum_DataStore.baseParams.jurnal_post!==null){jurnal_post_print = jurnal_umum_DataStore.baseParams.jurnal_post;}
		if(jurnal_umum_DataStore.baseParams.jurnal_date_post!==""){jurnal_date_post_print_date = jurnal_umum_DataStore.baseParams.jurnal_date_post;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_umum&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	jurnal_tanggal : jurnal_tanggal_print_date, 
			jurnal_akun : jurnal_akun_print,
			jurnal_keterangan : jurnal_keterangan_print,
			jurnal_noref : jurnal_noref_print,
			jurnal_debet : jurnal_debet_print,
			jurnal_kredit : jurnal_kredit_print,
			jurnal_unit : jurnal_unit_print,
			jurnal_post : jurnal_post_print,
		  	jurnal_date_post : jurnal_date_post_print_date, 
		  	currentlisting: jurnal_umum_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/jurnal_umum_printlist.html','jurnal_umumlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jurnal_umum_export_excel(){
		var searchquery = "";
		var jurnal_tanggal_2excel_date="";
		var jurnal_akun_2excel=null;
		var jurnal_keterangan_2excel=null;
		var jurnal_noref_2excel=null;
		var jurnal_debet_2excel=null;
		var jurnal_kredit_2excel=null;
		var jurnal_unit_2excel=null;
		var jurnal_post_2excel=null;
		var jurnal_date_post_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_umum_DataStore.baseParams.query!==null){searchquery = jurnal_umum_DataStore.baseParams.query;}
		if(jurnal_umum_DataStore.baseParams.jurnal_tanggal!==""){jurnal_tanggal_2excel_date = jurnal_umum_DataStore.baseParams.jurnal_tanggal;}
		if(jurnal_umum_DataStore.baseParams.jurnal_akun!==null){jurnal_akun_2excel = jurnal_umum_DataStore.baseParams.jurnal_akun;}
		if(jurnal_umum_DataStore.baseParams.jurnal_keterangan!==null){jurnal_keterangan_2excel = jurnal_umum_DataStore.baseParams.jurnal_keterangan;}
		if(jurnal_umum_DataStore.baseParams.jurnal_noref!==null){jurnal_noref_2excel = jurnal_umum_DataStore.baseParams.jurnal_noref;}
		if(jurnal_umum_DataStore.baseParams.jurnal_debet!==null){jurnal_debet_2excel = jurnal_umum_DataStore.baseParams.jurnal_debet;}
		if(jurnal_umum_DataStore.baseParams.jurnal_kredit!==null){jurnal_kredit_2excel = jurnal_umum_DataStore.baseParams.jurnal_kredit;}
		if(jurnal_umum_DataStore.baseParams.jurnal_unit!==null){jurnal_unit_2excel = jurnal_umum_DataStore.baseParams.jurnal_unit;}
		if(jurnal_umum_DataStore.baseParams.jurnal_post!==null){jurnal_post_2excel = jurnal_umum_DataStore.baseParams.jurnal_post;}
		if(jurnal_umum_DataStore.baseParams.jurnal_date_post!==""){jurnal_date_post_2excel_date = jurnal_umum_DataStore.baseParams.jurnal_date_post;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_umum&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	jurnal_tanggal : jurnal_tanggal_2excel_date, 
			jurnal_akun : jurnal_akun_2excel,
			jurnal_keterangan : jurnal_keterangan_2excel,
			jurnal_noref : jurnal_noref_2excel,
			jurnal_debet : jurnal_debet_2excel,
			jurnal_kredit : jurnal_kredit_2excel,
			jurnal_unit : jurnal_unit_2excel,
			jurnal_post : jurnal_post_2excel,
		  	jurnal_date_post : jurnal_date_post_2excel_date, 
		  	currentlisting: jurnal_umum_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	function set_balance(){
		var total_debet=0;
		var total_kredit=0;
		for(i=0;i<detail_jurnal_DataStore.getCount();i++){
			var data_balance=detail_jurnal_DataStore.getAt(i);
			total_debet=total_debet+data_balance.data.djurnal_debet;
			total_kredit=total_kredit+data_balance.data.djurnal_kredit;
			
		}
		jurnal_totaldebetField.setValue(total_debet);
		jurnal_totalkreditField.setValue(total_kredit);
	}
	
	//EVENTS
	detail_jurnal_DataStore.on('update',function(){
		//refresh_detail_jurnal();
		detail_jurnal_DataStore.commitChanges();
		set_balance();
	});
	
	jurnal_umumListEditorGrid.on('afteredit', jurnal_umum_inline_update); // inLine Editing Record
	
	
	jurnal_debetField.on('keyup',function(){
		set_balance();
	});
	
	jurnal_kreditField.on('keyup',function(){
		set_balance();
	});
	
	combo_akun.on('select',function(){
		j=cbo_akunDataStore.findExact('akun_id',combo_akun.getValue(),0);
		if(j>-1){
			var data_akun=cbo_akunDataStore.getAt(j);
			jurnal_akunField.setValue(data_akun.data.akun_kode);
		}
	});
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_jurnal_umum"></div>
        <div id="fp_detail_jurnal"></div>
		<div id="elwindow_jurnal_umum_save"></div>
        <div id="elwindow_jurnal_umum_search"></div>
    </div>
</div>
</body>
</html>