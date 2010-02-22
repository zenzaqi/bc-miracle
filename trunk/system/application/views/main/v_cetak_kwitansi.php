<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: cetak_kwitansi View
	+ Description	: For record view
	+ Filename 		: v_cetak_kwitansi.php
 	+ Author  		: masongbee
 	+ Created on 26/Jan/2010 12:21:55
	
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
var cetak_kwitansi_DataStore;
var cetak_kwitansi_ColumnModel;
var cetak_kwitansiListEditorGrid;
var cetak_kwitansi_createForm;
var cetak_kwitansi_createWindow;
var cetak_kwitansi_searchForm;
var cetak_kwitansi_searchWindow;
var cetak_kwitansi_SelectedRow;
var cetak_kwitansi_ContextMenu;
//for detail data
var jual_kwitansi_DataStor;
var jual_kwitansiListEditorGrid;
var jual_kwitansi_ColumnModel;
var jual_kwitansi_proxy;
var jual_kwitansi_writer;
var jual_kwitansi_reader;
var editor_jual_kwitansi;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var kwitansi_idField;
var kwitansi_noField;
var kwitansi_custField;
var kwitansi_refField;
var kwitansi_nilaiField;
var kwitansi_keteranganField;
var kwitansi_statusField;
var kwitansi_idSearchField;
var kwitansi_noSearchField;
var kwitansi_custSearchField;
var kwitansi_refSearchField;
var kwitansi_nilaiSearchField;
var kwitansi_keteranganSearchField;
var kwitansi_statusSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
	
	Ext.util.Format.comboRenderer = function(combo){
  		//jproduk_bankDataStore.load();
  	    return function(value){
  	        var record = combo.findRecord(combo.valueField, value);
  	        return record ? record.get(combo.displayField) : combo.valueNotFoundText;
  	    }
  	}
  
  	/* Function for Saving inLine Editing */
	function cetak_kwitansi_update(oGrid_event){
		var kwitansi_id_update_pk="";
		var kwitansi_no_update=null;
		var kwitansi_cust_update=null;
		var kwitansi_ref_update=null;
		var kwitansi_nilai_update=null;
		var kwitansi_keterangan_update=null;
		var kwitansi_status_update=null;

		kwitansi_id_update_pk = oGrid_event.record.data.kwitansi_id;
		if(oGrid_event.record.data.kwitansi_no!== null){kwitansi_no_update = oGrid_event.record.data.kwitansi_no;}
		if(oGrid_event.record.data.kwitansi_cust!== null){kwitansi_cust_update = oGrid_event.record.data.kwitansi_cust;}
		if(oGrid_event.record.data.kwitansi_ref!== null){kwitansi_ref_update = oGrid_event.record.data.kwitansi_ref;}
		if(oGrid_event.record.data.kwitansi_nilai!== null){kwitansi_nilai_update = oGrid_event.record.data.kwitansi_nilai;}
		if(oGrid_event.record.data.kwitansi_keterangan!== null){kwitansi_keterangan_update = oGrid_event.record.data.kwitansi_keterangan;}
		if(oGrid_event.record.data.kwitansi_status!== null){kwitansi_status_update = oGrid_event.record.data.kwitansi_status;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_cetak_kwitansi&m=get_action',
			params: {
				task: "UPDATE",
				kwitansi_id	: kwitansi_id_update_pk, 
				kwitansi_no	:kwitansi_no_update,  
				kwitansi_cust	:kwitansi_cust_update,  
				kwitansi_ref	:kwitansi_ref_update,  
				kwitansi_nilai	:kwitansi_nilai_update,  
				kwitansi_keterangan	:kwitansi_keterangan_update,  
				kwitansi_status	:kwitansi_status_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						cetak_kwitansi_DataStore.commitChanges();
						cetak_kwitansi_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the cetak_kwitansi.',
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
	function cetak_kwitansi_create(){
	
		if(is_cetak_kwitansi_form_valid()){	
		var kwitansi_id_create_pk=null; 
		var kwitansi_no_create=null; 
		var kwitansi_cust_create=null; 
		var kwitansi_ref_create=null; 
		var kwitansi_nilai_create=null; 
		var kwitansi_keterangan_create=null; 
		var kwitansi_status_create=null; 

		if(kwitansi_idField.getValue()!== null){kwitansi_id_create = kwitansi_idField.getValue();}else{kwitansi_id_create_pk=get_pk_id();} 
		if(kwitansi_noField.getValue()!== null){kwitansi_no_create = kwitansi_noField.getValue();} 
		if(kwitansi_custField.getValue()!== null){kwitansi_cust_create = kwitansi_custField.getValue();} 
		if(kwitansi_refField.getValue()!== null){kwitansi_ref_create = kwitansi_refField.getValue();} 
		if(kwitansi_nilaiField.getValue()!== null){kwitansi_nilai_create = kwitansi_nilaiField.getValue();} 
		if(kwitansi_keteranganField.getValue()!== null){kwitansi_keterangan_create = kwitansi_keteranganField.getValue();} 
		if(kwitansi_statusField.getValue()!== null){kwitansi_status_create = kwitansi_statusField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_cetak_kwitansi&m=get_action',
			params: {
				task: post2db,
				kwitansi_id	: kwitansi_id_create_pk, 
				kwitansi_no	: kwitansi_no_create, 
				kwitansi_cust	: kwitansi_cust_create, 
				kwitansi_ref	: kwitansi_ref_create, 
				kwitansi_nilai	: kwitansi_nilai_create, 
				kwitansi_keterangan	: kwitansi_keterangan_create, 
				kwitansi_status	: kwitansi_status_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jual_kwitansi_purge()
						jual_kwitansi_insert();
						Ext.MessageBox.alert(post2db+' OK','The Cetak_kwitansi was '+msg+' successfully.');
						cetak_kwitansi_DataStore.reload();
						cetak_kwitansi_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Cetak_kwitansi.',
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
			return cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function cetak_kwitansi_reset_form(){
		kwitansi_idField.reset();
		kwitansi_idField.setValue(null);
		kwitansi_noField.reset();
		kwitansi_noField.setValue(null);
		kwitansi_custField.reset();
		kwitansi_custField.setValue(null);
		kwitansi_refField.reset();
		kwitansi_refField.setValue(null);
		kwitansi_nilaiField.reset();
		kwitansi_nilaiField.setValue(null);
		kwitansi_keteranganField.reset();
		kwitansi_keteranganField.setValue(null);
		kwitansi_statusField.reset();
		kwitansi_statusField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function cetak_kwitansi_set_form(){
		kwitansi_idField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_id'));
		kwitansi_noField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_no'));
		kwitansi_custField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('cust_nama'));
		kwitansi_refField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_ref'));
		kwitansi_nilaiField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_nilai'));
		kwitansi_keteranganField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_keterangan'));
		kwitansi_statusField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_status'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_cetak_kwitansi_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		cbo_custDataStore.load();
		if(!cetak_kwitansi_createWindow.isVisible()){
			cetak_kwitansi_reset_form();
			post2db='CREATE';
			msg='created';
			cetak_kwitansi_createWindow.show();
		} else {
			cetak_kwitansi_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function cetak_kwitansi_confirm_delete(){
		// only one cetak_kwitansi is selected here
		if(cetak_kwitansiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', cetak_kwitansi_delete);
		} else if(cetak_kwitansiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', cetak_kwitansi_delete);
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
	function cetak_kwitansi_confirm_update(){
		/* only one record is selected here */
		if(cetak_kwitansiListEditorGrid.selModel.getCount() == 1) {
			cetak_kwitansi_set_form();
			post2db='UPDATE';
			jual_kwitansi_DataStore.setBaseParam('master_id',eval(get_pk_id()));
			jual_kwitansi_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			cetak_kwitansi_createWindow.show();
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
	function cetak_kwitansi_delete(btn){
		if(btn=='yes'){
			var selections = cetak_kwitansiListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< cetak_kwitansiListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.kwitansi_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_cetak_kwitansi&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							cetak_kwitansi_DataStore.reload();
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
	cetak_kwitansi_DataStore = new Ext.data.Store({
		id: 'cetak_kwitansi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_cetak_kwitansi&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kwitansi_id'
		},[
		/* dataIndex => insert intocetak_kwitansi_ColumnModel, Mapping => for initiate table column */ 
			{name: 'kwitansi_id', type: 'int', mapping: 'kwitansi_id'}, 
			{name: 'kwitansi_no', type: 'string', mapping: 'kwitansi_no'}, 
			{name: 'kwitansi_cust', type: 'int', mapping: 'kwitansi_cust'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'kwitansi_ref', type: 'int', mapping: 'kwitansi_ref'}, 
			{name: 'kwitansi_nilai', type: 'float', mapping: 'kwitansi_nilai'}, 
			{name: 'kwitansi_keterangan', type: 'string', mapping: 'kwitansi_keterangan'}, 
			{name: 'kwitansi_status', type: 'string', mapping: 'kwitansi_status'}, 
			{name: 'kwitansi_creator', type: 'string', mapping: 'kwitansi_creator'}, 
			{name: 'kwitansi_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kwitansi_date_create'}, 
			{name: 'kwitansi_update', type: 'string', mapping: 'kwitansi_update'}, 
			{name: 'kwitansi_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kwitansi_date_update'}, 
			{name: 'kwitansi_revised', type: 'int', mapping: 'kwitansi_revised'} 
		]),
		sortInfo:{field: 'kwitansi_id', direction: "DESC"}
	});
	/* End of Function */
	
	cbo_custDataStore = new Ext.data.Store({
		id: 'cbo_custDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_cetak_kwitansi&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: 10 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'cust_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'cust_id', type: 'int', mapping: 'cust_id'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'cust_no', direction: "ASC"}
	});
	var customer_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	cetak_kwitansi_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'kwitansi_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: 'No. Kuitansi',
			dataIndex: 'kwitansi_no',
			width: 85,	//150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 20
          	})
		}, 
		{
			header: 'Customer',
			dataIndex: 'cust_nama',
			width: 210,
			sortable: true
		}, 
		{
			header: 'Ref',
			dataIndex: 'kwitansi_ref',
			width: 150,
			sortable: true,
			hidden: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Nilai',
			dataIndex: 'kwitansi_nilai',
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
			header: 'Keterangan',
			dataIndex: 'kwitansi_keterangan',
			width: 250,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		}, 
		{
			header: 'Status',
			dataIndex: 'kwitansi_status',
			width: 60,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['kwitansi_status_value', 'kwitansi_status_display'],
					data: [['aktif','aktif'],['hapus','hapus'],['habis','habis']]
					}),
				mode: 'local',
               	displayField: 'kwitansi_status_display',
               	valueField: 'kwitansi_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Creator',
			dataIndex: 'kwitansi_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'kwitansi_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'kwitansi_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'kwitansi_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'kwitansi_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	cetak_kwitansi_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	cetak_kwitansiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'cetak_kwitansiListEditorGrid',
		el: 'fp_cetak_kwitansi',
		title: 'Daftar Cetak Kuitansi',
		autoHeight: true,
		store: cetak_kwitansi_DataStore, // DataStore
		cm: cetak_kwitansi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: cetak_kwitansi_DataStore,
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
			handler: cetak_kwitansi_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: cetak_kwitansi_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: cetak_kwitansi_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: cetak_kwitansi_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: cetak_kwitansi_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: cetak_kwitansi_print  
		}
		]
	});
	cetak_kwitansiListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	cetak_kwitansi_ContextMenu = new Ext.menu.Menu({
		id: 'cetak_kwitansi_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: cetak_kwitansi_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: cetak_kwitansi_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: cetak_kwitansi_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: cetak_kwitansi_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function oncetak_kwitansi_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		cetak_kwitansi_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		cetak_kwitansi_SelectedRow=rowIndex;
		cetak_kwitansi_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function cetak_kwitansi_editContextMenu(){
		cetak_kwitansiListEditorGrid.startEditing(cetak_kwitansi_SelectedRow,1);
  	}
	/* End of Function */
  	
	cetak_kwitansiListEditorGrid.addListener('rowcontextmenu', oncetak_kwitansi_ListEditGridContextMenu);
	cetak_kwitansi_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	cetak_kwitansiListEditorGrid.on('afteredit', cetak_kwitansi_update); // inLine Editing Record
	
	/* Identify  kwitansi_id Field */
	kwitansi_idField= new Ext.form.NumberField({
		id: 'kwitansi_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  kwitansi_no Field */
	kwitansi_noField= new Ext.form.TextField({
		id: 'kwitansi_noField',
		fieldLabel: 'No.Kuitansi',
		maxLength: 20,
		readOnly:true,
		anchor: '95%'
	});
	/* Identify  kwitansi_cust Field */
	kwitansi_custField= new Ext.form.ComboBox({
		id: 'kwitansi_custField',
		fieldLabel: 'Customer',
		store: cbo_custDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  kwitansi_ref Field */
	kwitansi_refField= new Ext.form.NumberField({
		id: 'kwitansi_refField',
		fieldLabel: 'Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  kwitansi_nilai Field */
	kwitansi_nilaiField= new Ext.form.NumberField({
		id: 'kwitansi_nilaiField',
		fieldLabel: 'Nilai (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  kwitansi_keterangan Field */
	kwitansi_keteranganField= new Ext.form.TextArea({
		id: 'kwitansi_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  kwitansi_status Field */
	kwitansi_statusField= new Ext.form.ComboBox({
		id: 'kwitansi_statusField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['kwitansi_status_value', 'kwitansi_status_display'],
			data:[['aktif','aktif'],['hapus','hapus'],['habis','habis']]
		}),
		mode: 'local',
		displayField: 'kwitansi_status_display',
		valueField: 'kwitansi_status_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
  	/*Fieldset Master*/
	cetak_kwitansi_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [kwitansi_noField, kwitansi_custField, kwitansi_nilaiField, kwitansi_idField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [kwitansi_keteranganField, kwitansi_statusField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var jual_kwitansi_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jkwitansi_id', type: 'int', mapping: 'jkwitansi_id'}, 
			{name: 'jkwitansi_master', type: 'int', mapping: 'jkwitansi_master'}, 
			{name: 'jkwitansi_no', type: 'string', mapping: 'jkwitansi_no'}, 
			{name: 'jkwitansi_nilai', type: 'float', mapping: 'jkwitansi_nilai'}, 
			{name: 'jkwitansi_ref', type: 'string', mapping: 'jkwitansi_ref'}, 
			{name: 'jkwitansi_creator', type: 'string', mapping: 'jkwitansi_creator'}, 
			{name: 'jkwitansi_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'jkwitansi_date_create'}, 
			{name: 'jkwitansi_update', type: 'string', mapping: 'jkwitansi_update'}, 
			{name: 'jkwitansi_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'jkwitansi_date_update'}, 
			{name: 'jkwitansi_revised', type: 'int', mapping: 'jkwitansi_revised'} 
	]);
	//eof
	
	//function for json writer of detail
	var jual_kwitansi_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	jual_kwitansi_DataStore = new Ext.data.Store({
		id: 'jual_kwitansi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_cetak_kwitansi&m=detail_jual_kwitansi_list', 
			method: 'POST'
		}),
		reader: jual_kwitansi_reader,
		baseParams:{master_id: kwitansi_idField.getValue()},
		sortInfo:{field: 'jkwitansi_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_jual_kwitansi= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	jual_kwitansi_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Referensi',
			dataIndex: 'jkwitansi_ref',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Nilai',
			dataIndex: 'jkwitansi_nilai',
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
			header: 'Jkwitansi Creator',
			dataIndex: 'jkwitansi_creator',
			width: 150,
			sortable: true,
			hidden:true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Jkwitansi Date Create',
			dataIndex: 'jkwitansi_date_create',
			width: 150,
			sortable: true,
			hidden:true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jkwitansi Update',
			dataIndex: 'jkwitansi_update',
			width: 150,
			sortable: true,
			hidden:true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Jkwitansi Date Update',
			dataIndex: 'jkwitansi_date_update',
			width: 150,
			sortable: true,
			hidden:true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Jkwitansi Revised',
			dataIndex: 'jkwitansi_revised',
			width: 150,
			sortable: true,
			hidden:true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	jual_kwitansi_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	jual_kwitansiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jual_kwitansiListEditorGrid',
		el: 'fp_jual_kwitansi',
		title: 'Detail Penggunaan Kuitansi',
		height: 250,
		width: 690,
		autoScroll: true,
		store: jual_kwitansi_DataStore, // DataStore
		colModel: jual_kwitansi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_jual_kwitansi],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jual_kwitansi_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			disabled: true,
			handler: jual_kwitansi_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: jual_kwitansi_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function jual_kwitansi_add(){
		var edit_jual_kwitansi= new jual_kwitansiListEditorGrid.store.recordType({
			jkwitansi_id	:'',		
			jkwitansi_master	:'',		
			jkwitansi_no	:'',		
			jkwitansi_nilai	:'',		
			jkwitansi_ref	:'',		
			jkwitansi_creator	:'',		
			jkwitansi_date_create	:'',		
			jkwitansi_update	:'',		
			jkwitansi_date_update	:'',		
			jkwitansi_revised	:''		
		});
		editor_jual_kwitansi.stopEditing();
		jual_kwitansi_DataStore.insert(0, edit_jual_kwitansi);
		jual_kwitansiListEditorGrid.getView().refresh();
		jual_kwitansiListEditorGrid.getSelectionModel().selectRow(0);
		editor_jual_kwitansi.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_jual_kwitansi(){
		jual_kwitansi_DataStore.commitChanges();
		jual_kwitansiListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function jual_kwitansi_insert(){
		for(i=0;i<jual_kwitansi_DataStore.getCount();i++){
			jual_kwitansi_record=jual_kwitansi_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_cetak_kwitansi&m=detail_jual_kwitansi_insert',
				params:{
				jkwitansi_id	: jual_kwitansi_record.data.jkwitansi_id, 
				jkwitansi_master	: jual_kwitansi_record.data.jkwitansi_master, 
				jkwitansi_no	: eval(kwitansi_idField.getValue()), 
				jkwitansi_nilai	: jual_kwitansi_record.data.jkwitansi_nilai, 
				jkwitansi_ref	: jual_kwitansi_record.data.jkwitansi_ref, 
				jkwitansi_creator	: jual_kwitansi_record.data.jkwitansi_creator, 
				jkwitansi_date_create	: jual_kwitansi_record.data.jkwitansi_date_create.format('Y-m-d'),
				jkwitansi_update	: jual_kwitansi_record.data.jkwitansi_update, 
				jkwitansi_date_update	: jual_kwitansi_record.data.jkwitansi_date_update.format('Y-m-d'),
				jkwitansi_revised	: jual_kwitansi_record.data.jkwitansi_revised 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function jual_kwitansi_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_cetak_kwitansi&m=detail_jual_kwitansi_purge',
			params:{ master_id: eval(kwitansi_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function jual_kwitansi_confirm_delete(){
		// only one record is selected here
		if(jual_kwitansiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jual_kwitansi_delete);
		} else if(jual_kwitansiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jual_kwitansi_delete);
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
	function jual_kwitansi_delete(btn){
		if(btn=='yes'){
			var s = jual_kwitansiListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				jual_kwitansi_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	jual_kwitansi_DataStore.on('update', refresh_jual_kwitansi);
	
	/* Function for retrieve create Window Panel*/ 
	cetak_kwitansi_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [cetak_kwitansi_masterGroup,jual_kwitansiListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: cetak_kwitansi_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					cetak_kwitansi_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	cetak_kwitansi_createWindow= new Ext.Window({
		id: 'cetak_kwitansi_createWindow',
		title: post2db+'Cetak_kwitansi',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_cetak_kwitansi_create',
		items: cetak_kwitansi_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function cetak_kwitansi_list_search(){
		// render according to a SQL date format.
		var kwitansi_id_search=null;
		var kwitansi_no_search=null;
		var kwitansi_cust_search=null;
		var kwitansi_ref_search=null;
		var kwitansi_nilai_search=null;
		var kwitansi_keterangan_search=null;
		var kwitansi_status_search=null;

		if(kwitansi_idSearchField.getValue()!==null){kwitansi_id_search=kwitansi_idSearchField.getValue();}
		if(kwitansi_noSearchField.getValue()!==null){kwitansi_no_search=kwitansi_noSearchField.getValue();}
		if(kwitansi_custSearchField.getValue()!==null){kwitansi_cust_search=kwitansi_custSearchField.getValue();}
		if(kwitansi_refSearchField.getValue()!==null){kwitansi_ref_search=kwitansi_refSearchField.getValue();}
		if(kwitansi_nilaiSearchField.getValue()!==null){kwitansi_nilai_search=kwitansi_nilaiSearchField.getValue();}
		if(kwitansi_keteranganSearchField.getValue()!==null){kwitansi_keterangan_search=kwitansi_keteranganSearchField.getValue();}
		if(kwitansi_statusSearchField.getValue()!==null){kwitansi_status_search=kwitansi_statusSearchField.getValue();}
		// change the store parameters
		cetak_kwitansi_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			kwitansi_id	:	kwitansi_id_search, 
			kwitansi_no	:	kwitansi_no_search, 
			kwitansi_cust	:	kwitansi_cust_search, 
			kwitansi_ref	:	kwitansi_ref_search, 
			kwitansi_nilai	:	kwitansi_nilai_search, 
			kwitansi_keterangan	:	kwitansi_keterangan_search, 
			kwitansi_status	:	kwitansi_status_search, 
		};
		// Cause the datastore to do another query : 
		cetak_kwitansi_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function cetak_kwitansi_reset_search(){
		// reset the store parameters
		cetak_kwitansi_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		cetak_kwitansi_DataStore.reload({params: {start: 0, limit: pageS}});
		cetak_kwitansi_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  kwitansi_id Search Field */
	kwitansi_idSearchField= new Ext.form.NumberField({
		id: 'kwitansi_idSearchField',
		fieldLabel: 'Kwitansi Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  kwitansi_no Search Field */
	kwitansi_noSearchField= new Ext.form.TextField({
		id: 'kwitansi_noSearchField',
		fieldLabel: 'Kwitansi No',
		maxLength: 20,
		anchor: '95%'
	
	});
	/* Identify  kwitansi_cust Search Field */
	kwitansi_custSearchField= new Ext.form.NumberField({
		id: 'kwitansi_custSearchField',
		fieldLabel: 'Kwitansi Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  kwitansi_ref Search Field */
	kwitansi_refSearchField= new Ext.form.NumberField({
		id: 'kwitansi_refSearchField',
		fieldLabel: 'Kwitansi Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  kwitansi_nilai Search Field */
	kwitansi_nilaiSearchField= new Ext.form.NumberField({
		id: 'kwitansi_nilaiSearchField',
		fieldLabel: 'Kwitansi Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  kwitansi_keterangan Search Field */
	kwitansi_keteranganSearchField= new Ext.form.TextField({
		id: 'kwitansi_keteranganSearchField',
		fieldLabel: 'Kwitansi Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  kwitansi_status Search Field */
	kwitansi_statusSearchField= new Ext.form.ComboBox({
		id: 'kwitansi_statusSearchField',
		fieldLabel: 'Kwitansi Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'kwitansi_status'],
			data:[['aktif','aktif'],['hapus','hapus'],['habis','habis']]
		}),
		mode: 'local',
		displayField: 'kwitansi_status',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	cetak_kwitansi_searchForm = new Ext.FormPanel({
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
				items: [kwitansi_noSearchField, kwitansi_custSearchField, kwitansi_refSearchField, kwitansi_nilaiSearchField, kwitansi_keteranganSearchField, kwitansi_statusSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: cetak_kwitansi_list_search
			},{
				text: 'Close',
				handler: function(){
					cetak_kwitansi_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	cetak_kwitansi_searchWindow = new Ext.Window({
		title: 'cetak_kwitansi Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_cetak_kwitansi_search',
		items: cetak_kwitansi_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!cetak_kwitansi_searchWindow.isVisible()){
			cetak_kwitansi_searchWindow.show();
		} else {
			cetak_kwitansi_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function cetak_kwitansi_print(){
		var searchquery = "";
		var kwitansi_no_print=null;
		var kwitansi_cust_print=null;
		var kwitansi_ref_print=null;
		var kwitansi_nilai_print=null;
		var kwitansi_keterangan_print=null;
		var kwitansi_status_print=null;
		var win;              
		// check if we do have some search data...
		if(cetak_kwitansi_DataStore.baseParams.query!==null){searchquery = cetak_kwitansi_DataStore.baseParams.query;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_no!==null){kwitansi_no_print = cetak_kwitansi_DataStore.baseParams.kwitansi_no;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_cust!==null){kwitansi_cust_print = cetak_kwitansi_DataStore.baseParams.kwitansi_cust;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_ref!==null){kwitansi_ref_print = cetak_kwitansi_DataStore.baseParams.kwitansi_ref;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_nilai!==null){kwitansi_nilai_print = cetak_kwitansi_DataStore.baseParams.kwitansi_nilai;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_keterangan!==null){kwitansi_keterangan_print = cetak_kwitansi_DataStore.baseParams.kwitansi_keterangan;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_status!==null){kwitansi_status_print = cetak_kwitansi_DataStore.baseParams.kwitansi_status;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_cetak_kwitansi&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			kwitansi_no : kwitansi_no_print,
			kwitansi_cust : kwitansi_cust_print,
			kwitansi_ref : kwitansi_ref_print,
			kwitansi_nilai : kwitansi_nilai_print,
			kwitansi_keterangan : kwitansi_keterangan_print,
			kwitansi_status : kwitansi_status_print,
		  	currentlisting: cetak_kwitansi_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./cetak_kwitansilist.html','cetak_kwitansilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function cetak_kwitansi_export_excel(){
		var searchquery = "";
		var kwitansi_no_2excel=null;
		var kwitansi_cust_2excel=null;
		var kwitansi_ref_2excel=null;
		var kwitansi_nilai_2excel=null;
		var kwitansi_keterangan_2excel=null;
		var kwitansi_status_2excel=null;
		var win;              
		// check if we do have some search data...
		if(cetak_kwitansi_DataStore.baseParams.query!==null){searchquery = cetak_kwitansi_DataStore.baseParams.query;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_no!==null){kwitansi_no_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_no;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_cust!==null){kwitansi_cust_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_cust;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_ref!==null){kwitansi_ref_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_ref;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_nilai!==null){kwitansi_nilai_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_nilai;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_keterangan!==null){kwitansi_keterangan_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_keterangan;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_status!==null){kwitansi_status_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_status;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_cetak_kwitansi&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			kwitansi_no : kwitansi_no_2excel,
			kwitansi_cust : kwitansi_cust_2excel,
			kwitansi_ref : kwitansi_ref_2excel,
			kwitansi_nilai : kwitansi_nilai_2excel,
			kwitansi_keterangan : kwitansi_keterangan_2excel,
			kwitansi_status : kwitansi_status_2excel,
		  	currentlisting: cetak_kwitansi_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_cetak_kwitansi"></div>
         <div id="fp_jual_kwitansi"></div>
		<div id="elwindow_cetak_kwitansi_create"></div>
        <div id="elwindow_cetak_kwitansi_search"></div>
    </div>
</div>
</body>