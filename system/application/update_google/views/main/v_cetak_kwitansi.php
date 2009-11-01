<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: cetak_kwitansi View
	+ Description	: For record view
	+ Filename 		: v_cetak_kwitansi.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:03:04
	
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
var kwitansi_idField;
var kwitansi_noField;
var kwitansi_custField;
var kwitansi_refField;
var kwitansi_nilaiField;
var kwitansi_keteranganField;
var kwitansi_idSearchField;
var kwitansi_noSearchField;
var kwitansi_custSearchField;
var kwitansi_refSearchField;
var kwitansi_nilaiSearchField;
var kwitansi_keteranganSearchField;

	/*Cetak */
function cetak_kwitansi_print_paper(){
	Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_cetak_kwitansi&m=print_paper',
		params: { kwitansi_id : kwitansi_idField.getValue()	}, 
		success: function(response){              
			var result=eval(response.responseText);
			switch(result){
			case 1:
				win = window.open('./kwitansi_paper.html','Cetak Kwitansi','height=400,width=1000,resizable=1,scrollbars=0, menubar=0');
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
	
function is_cetak_kwitansi_form_valid(){
		return ( kwitansi_custField.isValid() && kwitansi_nilaiField.isValid());
}
	
function cetak_kwitansi_create(opsi){
	
		if(is_cetak_kwitansi_form_valid()){	
		var kwitansi_id_create_pk=null; 
		var kwitansi_no_create=null; 
		var kwitansi_cust_create=null; 
		var kwitansi_ref_create=null; 
		var kwitansi_nilai_create=null; 
		var kwitansi_keterangan_create=null; 

		if(kwitansi_idField.getValue()!== null){kwitansi_id_create_pk = kwitansi_idField.getValue();}else{kwitansi_id_create_pk=get_pk_id();} 
		if(kwitansi_noField.getValue()!== null){kwitansi_no_create = kwitansi_noField.getValue();} 
		if(kwitansi_custField.getValue()!== null){kwitansi_cust_create = kwitansi_custField.getValue();} 
		if(kwitansi_refField.getValue()!== null){kwitansi_ref_create = kwitansi_refField.getValue();} 
		if(kwitansi_nilaiField.getValue()!== null){kwitansi_nilai_create = kwitansi_nilaiField.getValue();} 
		if(kwitansi_keteranganField.getValue()!== null){kwitansi_keterangan_create = kwitansi_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_cetak_kwitansi&m=get_action',
			params: {
				task: post2db,
				opt: opsi,
				kwitansi_id	: kwitansi_id_create_pk, 
				kwitansi_no	: kwitansi_no_create, 
				kwitansi_cust	: kwitansi_cust_create, 
				kwitansi_ref	: kwitansi_ref_create, 
				kwitansi_nilai	: kwitansi_nilai_create, 
				kwitansi_keterangan	: kwitansi_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						Ext.MessageBox.alert(post2db+' OK','The Cetak_kwitansi was '+msg+' successfully.');
						cetak_kwitansi_DataStore.reload();
						cetak_kwitansi_createWindow.hide();
						break;
					case 0:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Cetak_kwitansi.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
					default:
						kwitansi_idField.setValue(result);
						cetak_kwitansi_print_paper();
						cetak_kwitansi_DataStore.reload();
						cetak_kwitansi_createWindow.hide();
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
	
/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function cetak_kwitansi_update(oGrid_event){
		var kwitansi_id_update_pk="";
		var kwitansi_no_update=null;
		var kwitansi_cust_update=null;
		var kwitansi_ref_update=null;
		var kwitansi_nilai_update=null;
		var kwitansi_keterangan_update=null;

		kwitansi_id_update_pk = oGrid_event.record.data.kwitansi_id;
		if(oGrid_event.record.data.kwitansi_no!== null){kwitansi_no_update = oGrid_event.record.data.kwitansi_no;}
		if(oGrid_event.record.data.kwitansi_cust!== null){kwitansi_cust_update = oGrid_event.record.data.kwitansi_cust;}
		if(oGrid_event.record.data.kwitansi_ref!== null){kwitansi_ref_update = oGrid_event.record.data.kwitansi_ref;}
		if(oGrid_event.record.data.kwitansi_nilai!== null){kwitansi_nilai_update = oGrid_event.record.data.kwitansi_nilai;}
		if(oGrid_event.record.data.kwitansi_keterangan!== null){kwitansi_keterangan_update = oGrid_event.record.data.kwitansi_keterangan;}

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
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function cetak_kwitansi_set_form(){
		kwitansi_idField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_id'));
		kwitansi_noField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_no'));
		kwitansi_custField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_cust'));
		kwitansi_refField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_ref'));
		kwitansi_nilaiField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_nilai'));
		kwitansi_keteranganField.setValue(cetak_kwitansiListEditorGrid.getSelectionModel().getSelected().get('kwitansi_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
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
			{name: 'kwitansi_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'kwitansi_ref', type: 'int', mapping: 'kwitansi_ref'}, 
			{name: 'kwitansi_nilai', type: 'float', mapping: 'kwitansi_nilai'}, 
			{name: 'kwitansi_keterangan', type: 'string', mapping: 'kwitansi_keterangan'}, 
			{name: 'kwitansi_creator', type: 'string', mapping: 'kwitansi_creator'}, 
			{name: 'kwitansi_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kwitansi_date_create'}, 
			{name: 'kwitansi_update', type: 'string', mapping: 'kwitansi_update'}, 
			{name: 'kwitansi_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kwitansi_date_update'}, 
			{name: 'kwitansi_revised', type: 'int', mapping: 'kwitansi_revised'} 
		]),
		sortInfo:{field: 'kwitansi_id', direction: "DESC"}
	});
	/* End of Function */
    
	/* Function for Retrieve DataStore */
	cbo_cust_kwitansi_DataStore = new Ext.data.Store({
		id: 'cbo_cust_kwitansi_DataStore',
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
	
	cbo_ref_kwitansi_DataStore = new Ext.data.Store({
		id: 'cbo_ref_kwitansi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_cetak_kwitansi&m=get_trans_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: 10 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'no_bukti'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'no_bukti', type: 'string', mapping: 'no_bukti'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'total_nilai', type: 'int',  mapping: 'total_nilai'},
			{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'no_bukti', direction: "ASC"}
	});
	
	var ref_kwitansi_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>No Faktur : {no_bukti}, Total Nilai : {total_nilai}</b><br />',
            'Nama : {cust_nama}<br/>',
			'Alamat: {cust_alamat}&nbsp;[Telp. {cust_telprumah}]</span>',
        '</div></tpl>'
    );
	
	var customer_kwitansi_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;[Telp. {cust_telprumah}]',
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
			hidden: false
		},
		{
			header: 'No Kwitansi',
			dataIndex: 'kwitansi_no',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Customer',
			dataIndex: 'kwitansi_cust',
			width: 250,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Ref Transaksi',
			dataIndex: 'kwitansi_ref',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Nilai',
			dataIndex: 'kwitansi_nilai',
			width: 150,
			sortable: true,
			renderer: function(val){
				return '<span> Rp. '+Ext.util.Format.number(val,'0,000')+'</span>';
			},
			readOnly: true
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
	cetak_kwitansiListEditorGrid =  new Ext.grid.GridPanel({
		id: 'cetak_kwitansiListEditorGrid',
		el: 'fp_cetak_kwitansi',
		title: 'List Of Cetak_kwitansi',
		autoHeight: true,
		store: cetak_kwitansi_DataStore, // DataStore
		cm: cetak_kwitansi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
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
		fieldLabel: 'No Kwitansi',
		maxLength: 20,
		readOnly: true,
		emptyText: '(auto)',
		anchor: '95%'
	});
	/* Identify  kwitansi_cust Field */
	kwitansi_custField= new Ext.form.ComboBox({
		id: 'kwitansi_custField',
		fieldLabel: 'Customer <span style="color: #ec0000">*</span>',
		store: cbo_cust_kwitansi_DataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
		allowBlank: false,
        tpl: customer_kwitansi_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  kwitansi_ref Field */
	kwitansi_refField= new Ext.form.ComboBox({
		id: 'kwitansi_refField',
		fieldLabel: 'Ref Transaksi ',
		store: cbo_ref_kwitansi_DataStore,
		mode: 'remote',
		displayField:'no_bukti',
		valueField: 'no_bukti',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: ref_kwitansi_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  kwitansi_nilai Field */
	kwitansi_nilaiField= new Ext.form.NumberField({
		id: 'kwitansi_nilaiField',
		fieldLabel: 'Nilai <span style="color: #ec0000">*</span>',
		allowNegatife : false,
		allowBlank: false,
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

	
	/* Function for retrieve create Window Panel*/ 
	cetak_kwitansi_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 600,
		layout: 'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [kwitansi_noField, kwitansi_custField, kwitansi_refField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [kwitansi_nilaiField, kwitansi_keteranganField,kwitansi_idField] 
			}
			],
		buttons: [
			{
				text: 'Print',
				handler: function() { cetak_kwitansi_create("cetak"); }
			},
			{
				text: 'Save and Close',
				handler: function() { cetak_kwitansi_create("simpan"); }
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

		if(kwitansi_idSearchField.getValue()!==null){kwitansi_id_search=kwitansi_idSearchField.getValue();}
		if(kwitansi_noSearchField.getValue()!==null){kwitansi_no_search=kwitansi_noSearchField.getValue();}
		if(kwitansi_custSearchField.getValue()!==null){kwitansi_cust_search=kwitansi_custSearchField.getValue();}
		if(kwitansi_refSearchField.getValue()!==null){kwitansi_ref_search=kwitansi_refSearchField.getValue();}
		if(kwitansi_nilaiSearchField.getValue()!==null){kwitansi_nilai_search=kwitansi_nilaiSearchField.getValue();}
		if(kwitansi_keteranganSearchField.getValue()!==null){kwitansi_keterangan_search=kwitansi_keteranganSearchField.getValue();}
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
				items: [kwitansi_noSearchField, kwitansi_custSearchField, kwitansi_refSearchField, kwitansi_nilaiSearchField, kwitansi_keteranganSearchField] 
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
		var win;              
		// check if we do have some search data...
		if(cetak_kwitansi_DataStore.baseParams.query!==null){searchquery = cetak_kwitansi_DataStore.baseParams.query;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_no!==null){kwitansi_no_print = cetak_kwitansi_DataStore.baseParams.kwitansi_no;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_cust!==null){kwitansi_cust_print = cetak_kwitansi_DataStore.baseParams.kwitansi_cust;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_ref!==null){kwitansi_ref_print = cetak_kwitansi_DataStore.baseParams.kwitansi_ref;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_nilai!==null){kwitansi_nilai_print = cetak_kwitansi_DataStore.baseParams.kwitansi_nilai;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_keterangan!==null){kwitansi_keterangan_print = cetak_kwitansi_DataStore.baseParams.kwitansi_keterangan;}

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
		var win;              
		// check if we do have some search data...
		if(cetak_kwitansi_DataStore.baseParams.query!==null){searchquery = cetak_kwitansi_DataStore.baseParams.query;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_no!==null){kwitansi_no_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_no;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_cust!==null){kwitansi_cust_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_cust;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_ref!==null){kwitansi_ref_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_ref;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_nilai!==null){kwitansi_nilai_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_nilai;}
		if(cetak_kwitansi_DataStore.baseParams.kwitansi_keterangan!==null){kwitansi_keterangan_2excel = cetak_kwitansi_DataStore.baseParams.kwitansi_keterangan;}

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
		<div id="elwindow_cetak_kwitansi_create"></div>
        <div id="elwindow_cetak_kwitansi_search"></div>
    </div>
</div>
</body>