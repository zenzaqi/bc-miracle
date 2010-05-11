<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tukar_point View
	+ Description	: For record view
	+ Filename 		: v_tukar_point.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:33
	
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
var tukar_point_DataStore;
var tukar_point_ColumnModel;
var tukar_pointListEditorGrid;
var tukar_point_createForm;
var tukar_point_createWindow;
var tukar_point_searchForm;
var tukar_point_searchWindow;
var tukar_point_SelectedRow;
var tukar_point_ContextMenu;
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
var epoint_idField;
var epoint_custField;
var epoint_jumlahField;
var epoint_voucherField;
var epoint_tanggalField;
var epoint_idSearchField;
var epoint_custSearchField;
var epoint_jumlahSearchField;
var epoint_voucherSearchField;
var epoint_tanggalSearchField;

var dt=new Date();

function tukar_point_cetak(kwitansi_ref){
	Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_tukar_point&m=print_paper',
		params: { kwitansi_ref : kwitansi_ref}, 
		success: function(response){              
			var result=eval(response.responseText);
			switch(result){
			case 1:
				win = window.open('./kwitansi_paper.html','Cetak Kwitansi Tukar Poin','height=480,width=1240,resizable=1,scrollbars=0, menubar=0');
				//win.print();
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

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function tukar_point_update(oGrid_event){
		var epoint_id_update_pk="";
		var epoint_cust_update=null;
		var epoint_jumlah_update=null;
		var epoint_voucher_update=null;
		var epoint_tanggal_update_date="";

		epoint_id_update_pk = oGrid_event.record.data.epoint_id;
		if(oGrid_event.record.data.epoint_cust!== null){epoint_cust_update = oGrid_event.record.data.epoint_cust;}
		if(oGrid_event.record.data.epoint_jumlah!== null){epoint_jumlah_update = oGrid_event.record.data.epoint_jumlah;}
		if(oGrid_event.record.data.epoint_voucher!== null){epoint_voucher_update = oGrid_event.record.data.epoint_voucher;}
	 	if(oGrid_event.record.data.epoint_tanggal!== ""){epoint_tanggal_update_date =oGrid_event.record.data.epoint_tanggal.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tukar_point&m=get_action',
			params: {
				task: "UPDATE",
				epoint_id	: epoint_id_update_pk, 
				epoint_cust	:epoint_cust_update,  
				epoint_jumlah	:epoint_jumlah_update,  
				epoint_voucher	:epoint_voucher_update,  
				epoint_tanggal	: epoint_tanggal_update_date, 
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						tukar_point_DataStore.commitChanges();
						tukar_point_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the tukar_point.',
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
	function tukar_point_create(){
	
		if(is_tukar_point_form_valid()){	
		var epoint_id_create_pk=null; 
		var epoint_cust_create=null; 
		var epoint_jumlah_create=null; 
		var epoint_voucher_create=null; 
		var epoint_tanggal_create_date=""; 

		if(epoint_idField.getValue()!== null){epoint_id_create = epoint_idField.getValue();}else{epoint_id_create_pk=get_pk_id();} 
		if(epoint_custField.getValue()!== null){epoint_cust_create = epoint_custField.getValue();} 
		if(epoint_jumlahField.getValue()!== null){epoint_jumlah_create = epoint_jumlahField.getValue();} 
		if(epoint_voucherField.getValue()!== null){epoint_voucher_create = epoint_voucherField.getValue();} 
		if(epoint_tanggalField.getValue()!== ""){epoint_tanggal_create_date = epoint_tanggalField.getValue().format('Y-m-d');} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tukar_point&m=get_action',
			params: {
				task: post2db,
				epoint_id	: epoint_id_create_pk, 
				epoint_cust	: epoint_cust_create, 
				epoint_jumlah	: epoint_jumlah_create, 
				epoint_voucher	: epoint_voucher_create, 
				epoint_tanggal	: epoint_tanggal_create_date, 
			}, 
			success: function(response){             
				var result=response.responseText;
				if(result=='0' || result=='1'){
					Ext.MessageBox.show({
					   title: 'Warning',
					   msg: 'Penukaran Poin tidak bisa disimpan',
					   buttons: Ext.MessageBox.OK,
					   animEl: 'save',
					   icon: Ext.MessageBox.WARNING
					});
				}else{
					tukar_point_cetak(result);
					tukar_point_DataStore.reload();
					tukar_point_createWindow.hide();
				}
				/*switch(result){
					case 1:
						Ext.MessageBox.alert(post2db+' OK','The Tukar_point was '+msg+' successfully.');
						tukar_point_DataStore.reload();
						tukar_point_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Tukar_point.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
				}        */
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
			return tukar_pointListEditorGrid.getSelectionModel().getSelected().get('epoint_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function tukar_point_reset_form(){
		epoint_idField.reset();
		epoint_idField.setValue(null);
		epoint_custField.reset();
		epoint_custField.setValue(null);
		epoint_jumlahField.reset();
		epoint_jumlahField.setValue(null);
		epoint_voucherField.reset();
		epoint_voucherField.setValue(null);
		epoint_tanggalField.reset();
		epoint_tanggalField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function tukar_point_set_form(){
		epoint_idField.setValue(tukar_pointListEditorGrid.getSelectionModel().getSelected().get('epoint_id'));
		epoint_custField.setValue(tukar_pointListEditorGrid.getSelectionModel().getSelected().get('epoint_cust'));
		epoint_jumlahField.setValue(tukar_pointListEditorGrid.getSelectionModel().getSelected().get('epoint_jumlah'));
		epoint_voucherField.setValue(tukar_pointListEditorGrid.getSelectionModel().getSelected().get('epoint_voucher'));
		epoint_tanggalField.setValue(tukar_pointListEditorGrid.getSelectionModel().getSelected().get('epoint_tanggal'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_tukar_point_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!tukar_point_createWindow.isVisible()){
			tukar_point_reset_form();
			post2db='CREATE';
			msg='created';
			epoint_tanggalField.setValue(dt);
			tukar_point_createWindow.show();
		} else {
			tukar_point_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function tukar_point_confirm_delete(){
		// only one tukar_point is selected here
		if(tukar_pointListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tukar_point_delete);
		} else if(tukar_pointListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tukar_point_delete);
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
	function tukar_point_confirm_update(){
		/* only one record is selected here */
		if(tukar_pointListEditorGrid.selModel.getCount() == 1) {
			tukar_point_set_form();
			post2db='UPDATE';
			msg='updated';
			tukar_point_createWindow.show();
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
	function tukar_point_delete(btn){
		if(btn=='yes'){
			var selections = tukar_pointListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< tukar_pointListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.epoint_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_tukar_point&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							tukar_point_DataStore.reload();
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
	tukar_point_DataStore = new Ext.data.Store({
		id: 'tukar_point_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tukar_point&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'epoint_id'
		},[
		/* dataIndex => insert intotukar_point_ColumnModel, Mapping => for initiate table column */ 
			{name: 'epoint_id', type: 'int', mapping: 'epoint_id'}, 
			{name: 'epoint_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'epoint_jumlah', type: 'int', mapping: 'epoint_jumlah'}, 
			{name: 'epoint_voucher', type: 'string', mapping: 'voucher_nama'}, 
			{name: 'epoint_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'epoint_tanggal'}, 
			{name: 'epoint_creator', type: 'string', mapping: 'epoint_creator'}, 
			{name: 'epoint_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'epoint_date_create'}, 
			{name: 'epoint_update', type: 'string', mapping: 'epoint_update'}, 
			{name: 'epoint_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'epoint_date_update'}, 
			{name: 'epoint_revised', type: 'int', mapping: 'epoint_revised'},
			{name: 'epoint_nobukti', type: 'string', mapping: 'kwitansi_no'} 
		]),
		sortInfo:{field: 'epoint_id', direction: "DESC"}
	});
	/* End of Function */
    
	/* Function for Retrieve DataStore */
	cbo_cust_point_DataStore = new Ext.data.Store({
		id: 'cbo_cust_point_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tukar_point&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: pageS }, // parameter yang di $_POST ke Controller
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
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'},
			{name: 'cust_point', type: 'int', mapping: 'cust_point'}
		]),
		sortInfo:{field: 'cust_no', direction: "ASC"}
	});
	
	cbo_voucher_pointDataStore = new Ext.data.Store({
		id: 'cbo_voucher_pointDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tukar_point&m=get_voucher_list', 
			method: 'POST'
		}),baseParams: {start:0, limit: 10},
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'voucher_nomor'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'voucher_id', type: 'int', mapping: 'kvoucher_id'},
			{name: 'voucher_nomor', type: 'string', mapping: 'kvoucher_nomor'},
			{name: 'voucher_jenis', type: 'string', mapping: 'voucher_jenis'},
			{name: 'voucher_nama', type: 'string', mapping: 'voucher_nama'}, 
			{name: 'voucher_point', type: 'int', mapping: 'voucher_point'}, 
			{name: 'voucher_kadaluarsa', type: 'date', dateFormat: 'Y-m-d', mapping: 'voucher_kadaluarsa'}, 
			{name: 'voucher_cashback', type: 'float', mapping: 'voucher_cashback'}, 
			{name: 'voucher_mincash', type: 'float', mapping: 'voucher_mincash'}, 
			{name: 'voucher_diskon', type: 'int', mapping: 'voucher_diskon'}, 
			{name: 'voucher_promo', type: 'int', mapping: 'voucher_promo'}, 
			{name: 'voucher_allproduk', type: 'string', mapping: 'voucher_allproduk'}, 
			{name: 'voucher_allrawat', type: 'string', mapping: 'voucher_allrawat'}
		]),
		sortInfo:{field: 'voucher_nomor', direction: "ASC"}
	});
	
	var voucher_point_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{voucher_nomor}</b>| {voucher_nama}<br/>Jenis: {voucher_jenis}</span>',
		'</div></tpl>'	
    );
	
	// Custom rendering Template
    var customer_point_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
  	/* Function for Identify of Window Column Model */
	tukar_point_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'epoint_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Customer',
			dataIndex: 'epoint_cust',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Jumlah Point',
			dataIndex: 'epoint_jumlah',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'No. Kuitansi',
			dataIndex: 'epoint_nobukti',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'epoint_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Creator',
			dataIndex: 'epoint_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'epoint_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'epoint_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'epoint_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'epoint_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	tukar_point_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	tukar_pointListEditorGrid =  new Ext.grid.GridPanel({
		id: 'tukar_pointListEditorGrid',
		el: 'fp_tukar_point',
		title: 'List Of Tukar Point',
		autoHeight: true,
		store: tukar_point_DataStore, // DataStore
		cm: tukar_point_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: tukar_point_DataStore,
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
			handler: tukar_point_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: tukar_point_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: tukar_point_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: tukar_point_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tukar_point_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tukar_point_print  
		}
		]
	});
	tukar_pointListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	tukar_point_ContextMenu = new Ext.menu.Menu({
		id: 'tukar_point_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: tukar_point_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: tukar_point_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tukar_point_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tukar_point_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function ontukar_point_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		tukar_point_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		tukar_point_SelectedRow=rowIndex;
		tukar_point_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function tukar_point_editContextMenu(){
		tukar_pointListEditorGrid.startEditing(tukar_point_SelectedRow,1);
  	}
	/* End of Function */
  	
	tukar_pointListEditorGrid.addListener('rowcontextmenu', ontukar_point_ListEditGridContextMenu);
	tukar_point_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	tukar_pointListEditorGrid.on('afteredit', tukar_point_update); // inLine Editing Record
	
	/* Identify  epoint_id Field */
	epoint_idField= new Ext.form.NumberField({
		id: 'epoint_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  epoint_cust Field */
	epoint_custField= new Ext.form.ComboBox({
		id: 'epoint_custField',
		fieldLabel: 'Customer',
		fieldLabel: 'Customer',
		store: cbo_cust_point_DataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:pageS,
        hideTrigger:false,
        tpl: customer_point_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  epoint_sisa Field */
	epoint_sisaField= new Ext.form.NumberField({
		id: 'epoint_sisaField',
		fieldLabel: 'Sisa Poin',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		readOnly: true,
		width: 76,
		maskRe: /([0-9]+)$/
	});
	/* Identify  epoint_jumlah Field */
	epoint_jumlahField= new Ext.form.NumberField({
		id: 'epoint_jumlahField',
		fieldLabel: 'Poin Diambil',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		width: 76,
		maskRe: /([0-9]+)$/
	});
	/* Identify  epoint_voucher Field */
	epoint_voucherField= new Ext.form.ComboBox({
		id: 'epoint_voucherField',
		fieldLabel: 'Voucher',
		store: cbo_voucher_pointDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_point_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  epoint_tanggal Field */
	epoint_tanggalField= new Ext.form.DateField({
		id: 'epoint_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d'
	});
	
	epoint_kwitansiField= new Ext.form.TextField();
	
	epoint_custField.on('select', function(){
		var j=cbo_cust_point_DataStore.find('cust_id',epoint_custField.getValue());
		if(cbo_cust_point_DataStore.getCount()){
			epoint_sisaField.setValue(cbo_cust_point_DataStore.getAt(j).data.cust_point);
		}
	});

	
	/* Function for retrieve create Window Panel*/ 
	tukar_point_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 400,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [epoint_tanggalField, epoint_custField, epoint_sisaField, epoint_jumlahField, epoint_idField] 
			}
			],
		buttons: [{
				text: 'Save and Close',
				handler: tukar_point_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					tukar_point_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	tukar_point_createWindow= new Ext.Window({
		id: 'tukar_point_createWindow',
		title: post2db+'Tukar_point',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_tukar_point_create',
		items: tukar_point_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function tukar_point_list_search(){
		// render according to a SQL date format.
		var epoint_id_search=null;
		var epoint_cust_search=null;
		var epoint_jumlah_search=null;
		var epoint_voucher_search=null;
		var epoint_tanggal_search_date="";

		if(epoint_idSearchField.getValue()!==null){epoint_id_search=epoint_idSearchField.getValue();}
		if(epoint_custSearchField.getValue()!==null){epoint_cust_search=epoint_custSearchField.getValue();}
		if(epoint_jumlahSearchField.getValue()!==null){epoint_jumlah_search=epoint_jumlahSearchField.getValue();}
		if(epoint_voucherSearchField.getValue()!==null){epoint_voucher_search=epoint_voucherSearchField.getValue();}
		if(epoint_tanggalSearchField.getValue()!==""){epoint_tanggal_search_date=epoint_tanggalSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		tukar_point_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			epoint_id	:	epoint_id_search, 
			epoint_cust	:	epoint_cust_search, 
			epoint_jumlah	:	epoint_jumlah_search, 
			epoint_voucher	:	epoint_voucher_search, 
			epoint_tanggal	:	epoint_tanggal_search_date, 
		};
		// Cause the datastore to do another query : 
		tukar_point_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function tukar_point_reset_search(){
		// reset the store parameters
		tukar_point_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		tukar_point_DataStore.reload({params: {start: 0, limit: pageS}});
		tukar_point_searchWindow.close();
	};
	/* End of Fuction */
	
	function tukar_point_reset_SearchForm(){
		epoint_custSearchField.reset();
		epoint_jumlahSearchField.reset();
		epoint_voucherSearchField.reset();
		epoint_tanggalSearchField.reset();
	}
	
	
	/* Field for search */
	/* Identify  epoint_id Search Field */
	epoint_idSearchField= new Ext.form.NumberField({
		id: 'epoint_idSearchField',
		fieldLabel: 'Epoint Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  epoint_cust Search Field */
	epoint_custSearchField= new Ext.form.NumberField({
		id: 'epoint_custSearchField',
		fieldLabel: 'Epoint Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  epoint_jumlah Search Field */
	epoint_jumlahSearchField= new Ext.form.NumberField({
		id: 'epoint_jumlahSearchField',
		fieldLabel: 'Epoint Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  epoint_voucher Search Field */
	epoint_voucherSearchField= new Ext.form.NumberField({
		id: 'epoint_voucherSearchField',
		fieldLabel: 'Epoint Voucher',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  epoint_tanggal Search Field */
	epoint_tanggalSearchField= new Ext.form.DateField({
		id: 'epoint_tanggalSearchField',
		fieldLabel: 'Epoint Tanggal',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	tukar_point_searchForm = new Ext.FormPanel({
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
				items: [epoint_custSearchField, epoint_jumlahSearchField, epoint_voucherSearchField, epoint_tanggalSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: tukar_point_list_search
			},{
				text: 'Close',
				handler: function(){
					tukar_point_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	tukar_point_searchWindow = new Ext.Window({
		title: 'tukar_point Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_tukar_point_search',
		items: tukar_point_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!tukar_point_searchWindow.isVisible()){
			tukar_point_reset_SearchForm();
			tukar_point_searchWindow.show();
		} else {
			tukar_point_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function tukar_point_print(){
		var searchquery = "";
		var epoint_cust_print=null;
		var epoint_jumlah_print=null;
		var epoint_voucher_print=null;
		var epoint_tanggal_print_date="";
		var win;              
		// check if we do have some search data...
		if(tukar_point_DataStore.baseParams.query!==null){searchquery = tukar_point_DataStore.baseParams.query;}
		if(tukar_point_DataStore.baseParams.epoint_cust!==null){epoint_cust_print = tukar_point_DataStore.baseParams.epoint_cust;}
		if(tukar_point_DataStore.baseParams.epoint_jumlah!==null){epoint_jumlah_print = tukar_point_DataStore.baseParams.epoint_jumlah;}
		if(tukar_point_DataStore.baseParams.epoint_voucher!==null){epoint_voucher_print = tukar_point_DataStore.baseParams.epoint_voucher;}
		if(tukar_point_DataStore.baseParams.epoint_tanggal!==""){epoint_tanggal_print_date = tukar_point_DataStore.baseParams.epoint_tanggal;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_tukar_point&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			epoint_cust : epoint_cust_print,
			epoint_jumlah : epoint_jumlah_print,
			epoint_voucher : epoint_voucher_print,
		  	epoint_tanggal : epoint_tanggal_print_date, 
		  	currentlisting: tukar_point_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./tukar_pointlist.html','tukar_pointlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function tukar_point_export_excel(){
		var searchquery = "";
		var epoint_cust_2excel=null;
		var epoint_jumlah_2excel=null;
		var epoint_voucher_2excel=null;
		var epoint_tanggal_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(tukar_point_DataStore.baseParams.query!==null){searchquery = tukar_point_DataStore.baseParams.query;}
		if(tukar_point_DataStore.baseParams.epoint_cust!==null){epoint_cust_2excel = tukar_point_DataStore.baseParams.epoint_cust;}
		if(tukar_point_DataStore.baseParams.epoint_jumlah!==null){epoint_jumlah_2excel = tukar_point_DataStore.baseParams.epoint_jumlah;}
		if(tukar_point_DataStore.baseParams.epoint_voucher!==null){epoint_voucher_2excel = tukar_point_DataStore.baseParams.epoint_voucher;}
		if(tukar_point_DataStore.baseParams.epoint_tanggal!==""){epoint_tanggal_2excel_date = tukar_point_DataStore.baseParams.epoint_tanggal;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_tukar_point&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			epoint_cust : epoint_cust_2excel,
			epoint_jumlah : epoint_jumlah_2excel,
			epoint_voucher : epoint_voucher_2excel,
		  	epoint_tanggal : epoint_tanggal_2excel_date, 
		  	currentlisting: tukar_point_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_tukar_point"></div>
		<div id="elwindow_tukar_point_create"></div>
        <div id="elwindow_tukar_point_search"></div>
    </div>
</div>
</body>