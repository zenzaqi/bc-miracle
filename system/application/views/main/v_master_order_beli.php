<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_order_beli View
	+ Description	: For record view
	+ Filename 		: v_master_order_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:43:12
	
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
var master_order_beli_DataStore;
var master_order_beli_ColumnModel;
var master_order_beliListEditorGrid;
var master_order_beli_createForm;
var master_order_beli_createWindow;
var master_order_beli_searchForm;
var master_order_beli_searchWindow;
var master_order_beli_SelectedRow;
var master_order_beli_ContextMenu;
//for detail data
var detail_order_beli_DataStore;
var detail_order_beliListEditorGrid;
var detail_order_beli_ColumnModel;
var detail_order_beli_proxy;
var detail_order_beli_writer;
var detail_order_beli_reader;
var editor_detail_order_beli;
var today=new Date().format('Y-m-d');
var firstday=(new Date().format('Y-m'))+'-01';
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var acc_group=<?=$_SESSION[SESSION_GROUPID];?>;
var stat='ADD';
/* declare variable here for Field*/
var order_idField;
var order_noField;
var order_supplierField;
var order_tanggalField;
var order_carabayarField;
var order_diskonField;
var order_biayaField;
var order_bayarField;
var order_keteranganField;
var order_idSearchField;
var order_noSearchField;
var order_supplierSearchField;
var order_tanggalSearchField;
var order_tanggal_akhirSearchField;
var order_carabayarSearchField;
//var order_diskonSearchField;
//var order_biayaSearchField;
//var order_bayarSearchField;
var order_keteranganSearchField;
var order_statusSearchField;
var order_status_accSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	
  	/* Function for Saving inLine Editing */
	function master_order_beli_update(oGrid_event){
		var order_id_update_pk="";
		var order_no_update=null;
		var order_supplier_update=null;
		var order_tanggal_update_date="";
		var order_carabayar_update=null;
		var order_diskon_update=null;
		var order_biaya_update=null;
		var order_bayar_update=null;
		var order_keterangan_update=null;
		var order_status_update=null;
		var order_cashback_update=null;
		var order_status_acc_update=null;
		
		order_id_update_pk = oGrid_event.record.data.order_id;
		if(oGrid_event.record.data.order_no!== null){order_no_update = oGrid_event.record.data.order_no;}
		if(oGrid_event.record.data.order_supplier!== null){order_supplier_update = oGrid_event.record.data.order_supplier;}
	 	if(oGrid_event.record.data.order_tanggal!== ""){order_tanggal_update_date =oGrid_event.record.data.order_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.order_carabayar!== null){order_carabayar_update = oGrid_event.record.data.order_carabayar;}
		if(oGrid_event.record.data.order_diskon!== null){order_diskon_update = oGrid_event.record.data.order_diskon;}
		if(oGrid_event.record.data.order_cashback!== null){order_cashback_update = oGrid_event.record.data.order_cashback;}
		if(oGrid_event.record.data.order_biaya!== null){order_biaya_update = oGrid_event.record.data.order_biaya;}
		if(oGrid_event.record.data.order_bayar!== null){order_bayar_update = oGrid_event.record.data.order_bayar;}
		if(oGrid_event.record.data.order_keterangan!== null){order_keterangan_update = oGrid_event.record.data.order_keterangan;}
		if(oGrid_event.record.data.order_status!== null){order_status_update = oGrid_event.record.data.order_status;}
		if(oGrid_event.record.data.order_status_acc!== null){order_status_acc_update = oGrid_event.record.data.order_status_acc;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_order_beli&m=get_action',
			params: {
				task: "UPDATE",
				order_id		: order_id_update_pk, 
				order_no		: order_no_update,  
				order_supplier	: order_supplier_update,  
				order_tanggal	: order_tanggal_update_date, 
				order_carabayar	: order_carabayar_update,  
				order_diskon	: order_diskon_update,  
				order_biaya	  	: order_biaya_update,  
				order_bayar		: order_bayar_update,  
				order_keterangan: order_keterangan_update,
				order_status	: order_status_update,
				order_cashback	: order_cashback_update,
				order_status_acc: order_status_acc_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				if(result!==0){
						Ext.MessageBox.alert(post2db+' OK','Data Order Pembelian berhasil disimpan');
						master_order_beli_createWindow.hide();
				}else{
						Ext.MessageBox.show({
						   title: 'Warning',
						   //msg: 'We could\'t not '+msg+' the Master_order_beli.',
						   msg: 'Data Order Pembelian tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
				} 
				master_order_beli_DataStore.reload();
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
	function master_order_beli_create(opsi){
	
		if(is_master_order_beli_form_valid()){	
		var order_id_create_pk=null; 
		var order_no_create=null; 
		var order_supplier_create=null; 
		var order_tanggal_create_date=""; 
		var order_carabayar_create=null; 
		var order_diskon_create=null;
		var order_cashback_create=null;
		var order_biaya_create=null; 
		var order_bayar_create=null; 
		var order_keterangan_create=null; 
		var order_status_create=null; 
		var order_status_acc_create=null;

		if(order_idField.getValue()!== null){order_id_create_pk = order_idField.getValue();}else{order_id_create_pk=get_pk_id();} 
		if(order_noField.getValue()!== null){order_no_create = order_noField.getValue();} 
		if(order_supplierField.getValue()!== null){order_supplier_create = order_supplierField.getValue();} 
		if(order_tanggalField.getValue()!== ""){order_tanggal_create_date = order_tanggalField.getValue().format('Y-m-d');} 
		if(order_carabayarField.getValue()!== null){order_carabayar_create = order_carabayarField.getValue();} 
		if(order_diskonField.getValue()!== null){order_diskon_create = order_diskonField.getValue();} 
		if(order_cashbackField.getValue()!== null){order_cashback_create = order_cashbackField.getValue();} 
		if(order_biayaField.getValue()!== null){order_biaya_create = order_biayaField.getValue();} 
		if(order_bayarField.getValue()!== null){order_bayar_create = order_bayarField.getValue();} 
		if(order_keteranganField.getValue()!== null){order_keterangan_create = order_keteranganField.getValue();} 
		if(order_statusField.getValue()!== null){order_status_create = order_statusField.getValue();} 
		if(order_status_accField.getValue()!== null){order_status_acc_create = order_status_accField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_order_beli&m=get_action',
			params: {
				task				: post2db,
				order_id			: order_id_create_pk, 
				order_no			: order_no_create, 
				order_supplier		: order_supplier_create, 
				order_tanggal		: order_tanggal_create_date, 
				order_carabayar		: order_carabayar_create, 
				order_diskon		: order_diskon_create, 
				order_cashback		: order_cashback_create, 
				order_biaya			: order_biaya_create, 
				order_bayar			: order_bayar_create, 
				order_keterangan	: order_keterangan_create,
				order_status		: order_status_create,
				order_status_acc	: order_status_acc_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				if(result!==0){
						
						Ext.MessageBox.alert(post2db+' OK','Data Order Pembelian berhasil disimpan');
						order_idField.setValue(result);
						detail_order_beli_purge(result, opsi)
						master_order_beli_createWindow.hide();
				}else{
						Ext.MessageBox.show({
						   title: 'Warning',
						   //msg: 'We could\'t not '+msg+' the Master_order_beli.',
						   msg: 'Data Order Pembelian tidak bisa disimpan',
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
			return master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_id');
		else if(post2db=='CREATE')
			return order_idField.getValue();
		else 
			return -1;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_order_beli_reset_form(){
		order_idField.reset();
		order_idField.setValue(null);
		order_noField.reset();
		order_noField.setValue(null);
		order_supplierField.reset();
		order_supplierField.setValue(null);
		order_tanggalField.setValue(today);
		order_carabayarField.reset();
		order_carabayarField.setValue('Kredit');
		order_diskonField.reset();
		order_diskonField.setValue('0');
		order_cashbackField.reset();
		order_cashbackField.setValue('0');
		order_biayaField.reset();
		order_biayaField.setValue('0');
		order_bayarField.reset();
		order_bayarField.setValue('0');
		order_keteranganField.reset();
		order_keteranganField.setValue(null);
		order_statusField.reset();
		order_statusField.setValue('Terbuka');
		order_status_accField.reset();
		order_status_accField.setValue('Terbuka');
		/*cbo_order_satuanDataStore.load();
		cbo_order_produk_DataStore.load();*/
		detail_order_beli_DataStore.load({params: {master_id:-1}});
		
		/*cbo_order_satuanDataStore.setBaseParam('task','detail');
		cbo_order_satuanDataStore.setBaseParam('master_id',get_pk_id());
		cbo_order_satuanDataStore.load();
		
		cbo_order_produk_DataStore.setBaseParam('master_id',get_pk_id());
		cbo_order_produk_DataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_order_beli_DataStore.setBaseParam('master_id',get_pk_id());
					detail_order_beli_DataStore.load();
				}
			}
		});*/
		check_acc();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_order_beli_set_form(){
		order_idField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_id'));
		order_noField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_no'));
		order_supplierField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_supplier'));
		order_tanggalField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_tanggal'));
		order_carabayarField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_carabayar'));
		order_diskonField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_diskon'));
		order_cashbackField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_cashback'));
		
		order_biayaField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_biaya'));
		order_bayarField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_bayar'));
		order_keteranganField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_keterangan'));
		order_statusField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_status'));
		order_status_accField.setValue(master_order_beliListEditorGrid.getSelectionModel().getSelected().get('order_status_acc'));
		
		cbo_order_satuanDataStore.setBaseParam('task','detail');
		cbo_order_satuanDataStore.setBaseParam('master_id',get_pk_id());
		cbo_order_satuanDataStore.load();
		
		cbo_order_produk_DataStore.setBaseParam('master_id',get_pk_id());
		cbo_order_produk_DataStore.setBaseParam('task','detail');
		cbo_order_produk_DataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_order_beli_DataStore.setBaseParam('master_id',get_pk_id());
					detail_order_beli_DataStore.load();
				}
			}
		});
		
		check_acc();
		
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_order_beli_form_valid(){
		return (order_supplierField.isValid() && order_carabayarField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_order_beli_createWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			master_order_beli_reset_form();
			master_order_beli_createWindow.show();
		} else {
			master_order_beli_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_order_beli_confirm_delete(){
		// only one master_order_beli is selected here
		if(master_order_beliListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_order_beli_delete);
		} else if(master_order_beliListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_order_beli_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				//msg: 'You can\'t really delete something you haven\'t selected?',
				msg: 'Anda belum memilih data yang akan dihapus',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	function check_acc(){
		if(acc_group!==9){
			order_harga_satuanField.setDisabled(true);
			order_diskon_satuanField.setDisabled(true);
		}else{
			order_harga_satuanField.setDisabled(false);
			order_diskon_satuanField.setDisabled(false);
		}
	}
	/* Function for Update Confirm */
	function master_order_beli_confirm_update(){
		/* only one record is selected here */
		if(master_order_beliListEditorGrid.selModel.getCount() == 1) {
			post2db='UPDATE';
			msg='updated';
			master_order_beli_set_form();
			master_order_beli_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				//msg: 'You can\'t really update something you haven\'t selected?',
				msg: 'Anda belum memilih data yang akan diubah',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function master_order_beli_delete(btn){
		if(btn=='yes'){
			var selections = master_order_beliListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_order_beliListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.order_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu',
				url: 'index.php?c=c_master_order_beli&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_order_beli_DataStore.reload();
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
	master_order_beli_DataStore = new Ext.data.Store({
		id: 'master_order_beli_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_order_beli&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'order_id'
		},[
		/* dataIndex => insert intomaster_order_beli_ColumnModel, Mapping => for initiate table column */ 
			{name: 'order_id', type: 'int', mapping: 'order_id'}, 
			{name: 'order_no', type: 'string', mapping: 'no_bukti'}, 
			{name: 'order_supplier', type: 'string', mapping: 'supplier_nama'}, 
			{name: 'order_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'tanggal'}, 
			{name: 'order_carabayar', type: 'string', mapping: 'order_carabayar'}, 
			{name: 'order_diskon', type: 'float', mapping: 'order_diskon'},
			{name: 'order_cashback', type: 'float', mapping: 'order_cashback'},
			{name: 'order_biaya', type: 'float', mapping: 'order_biaya'}, 
			{name: 'order_jumlah', type: 'float', mapping: 'jumlah_barang'}, 
			{name: 'order_total', type: 'float', mapping: 'total_nilai'}, 
			{name: 'order_bayar', type: 'float', mapping: 'order_bayar'}, 
			{name: 'order_keterangan', type: 'string', mapping: 'order_keterangan'}, 
			{name: 'order_status', type: 'string', mapping: 'order_status'}, 
			{name: 'order_status_acc', type: 'string', mapping: 'order_status_acc'},
			{name: 'order_creator', type: 'string', mapping: 'order_creator'}, 
			{name: 'order_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'order_date_create'}, 
			{name: 'order_update', type: 'string', mapping: 'order_update'}, 
			{name: 'order_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'order_date_update'}, 
			{name: 'order_revised', type: 'int', mapping: 'order_revised'} 
		]),
		sortInfo:{field: 'order_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Supplier DataStore */
	var cbo_order_produk_DataStore = new Ext.data.Store({
		id: 'cbo_order_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_order_beli&m=get_produk_list', 
			method: 'POST'
		}),
		baseParams:{task: "detail",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'order_produk_value'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'order_produk_value', type: 'int', mapping: 'produk_id'},
			{name: 'order_produk_nama', type: 'string', mapping: 'produk_nama'},
			{name: 'order_produk_kode', type: 'string', mapping: 'produk_kode'},
			{name: 'order_produk_kategori', type: 'string', mapping: 'kategori_nama'}
		]),
		sortInfo:{field: 'order_produk_nama', direction: "ASC"}
	});
	
	/* Function for Retrieve Supplier DataStore */
	cbo_order_supplier_DataSore = new Ext.data.Store({
		id: 'cbo_order_supplier_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_order_beli&m=get_supplier_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit:10}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'order_supplier_value'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'order_supplier_value', type: 'int', mapping: 'supplier_id'},
			{name: 'order_supplier_nama', type: 'string', mapping: 'supplier_nama'},
			{name: 'order_supplier_alamat', type: 'string',  mapping: 'supplier_alamat'},
			{name: 'order_supplier_kota', type: 'string', mapping: 'supplier_kota'},
			{name: 'order_supplier_notelp', type: 'string', mapping: 'supplier_notelp'}
		]),
		sortInfo:{field: 'order_supplier_nama', direction: "ASC"}
	});
	
	// Custom rendering Template
    var order_supplier_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{order_supplier_nama}</b><br /></span>',
//            'Alamat: {order_supplier_alamat}, {order_supplier_kota}<br>Telp. {order_supplier_notelp}',
            '{order_supplier_alamat}, {order_supplier_kota}',
        '</div></tpl>'
    );
	
    
	var order_produk_detail_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{order_produk_nama} ({order_produk_kode})</b><br /></span>',
            'Kategori: {order_produk_kategori}',
        '</div></tpl>'
    );
	
  	/* Function for Identify of Window Column Model */
	master_order_beli_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'order_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'order_tanggal',
			width: 70,	//150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		},
		{
			//header: '<div align="center">' + 'No Order' + '</div>',
			header: '<div align="center">' + 'No OP' + '</div>',
			dataIndex: 'order_no',
			width: 80,	//150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: '<div align="center">' + 'Supplier' + '</div>',
			dataIndex: 'order_supplier',
			width: 200,	//150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Jml Item' + '</div>',
			align: 'right',
			dataIndex: 'order_jumlah',
			width: 60,	//150,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},
		<? if(($_SESSION[SESSION_GROUPID]==9) || ($_SESSION[SESSION_GROUPID]==1)){ ?>
		{
			header: '<div align="center">' + 'Sub Total (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'order_total',
			width: 100,	//150,
			sortable: true,
			readOnly: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{
			header: '<div align="center">' + 'Diskon (%)' + '</div>',
			align: 'right',
			dataIndex: 'order_diskon',
			width: 60,	//150,
			sortable: true,
			renderer: function(val){
				return '<span>'+val+'</span>';
			},
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Diskon (Rp)' + '</div>',
			align: 'right',
			width: 100,	//150,
			dataIndex: 'order_cashback',
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Biaya (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'order_biaya',
			width: 100,	//150,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			},
			readOnly: true
		},
		{
			header: '<div align="center">' + 'Total Nilai (Rp)' + '</div>',
			align: 'right',
			width: 100,	//150,
			//sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
					order_total_nilai=Ext.util.Format.number((record.data.order_total-(record.data.order_diskon*record.data.order_total/100)+record.data.order_biaya-record.data.order_cashback),"0,000");
                    return '<span>' + order_total_nilai+ '</span>';
            }
		},
		<? } ?>
		
		{
			header: '<div align="center">' + 'Cara Bayar' + '</div>',
			dataIndex: 'order_carabayar',
			width: 80,	//150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['order_carabayar_value', 'order_carabayar_display'],
					data: [['Tunai','Tunai'],['Kredit','Kredit'],['Konsinyasi','Konsinyasi']]
					}),
				mode: 'local',
               	displayField: 'order_carabayar_display',
               	valueField: 'order_carabayar_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'order_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: '<div align="center">' + 'Stat Dok' + '</div>',
			dataIndex: 'order_status',
			width: 60
		}, 
		
		{
			header: '<div align="center">' + 'Stat Acc' + '</div>',
			dataIndex: 'order_status_acc',
			width: 60
		}, 
		{
			header: 'Creator',
			dataIndex: 'order_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Create on',
			dataIndex: 'order_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'order_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'order_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Revised',
			dataIndex: 'order_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}	]);
	
	//master_order_beli_ColumnModel.defaultSortable= true;
	/* End of Function */
    var master_order_paging_toolbar=new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_order_beli_DataStore,
			displayInfo: true
		});
	/* Declare DataStore and  show datagrid list */
	master_order_beliListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'master_order_beliListEditorGrid',
		el: 'fp_master_order_beli',
		title: 'Daftar Order Pembelian',
		autoHeight: true,
		store: master_order_beli_DataStore, // DataStore
		cm: master_order_beli_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,	//900,
		bbar: master_order_paging_toolbar,
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
			handler: master_order_beli_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: master_order_beli_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Adv Search',
			tooltip: 'Pencarian detail',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_order_beli_DataStore,
			params: {start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						master_order_beli_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By (aktif only)'});
				Ext.get(this.id).set({qtip:'- No OP<br>- Supplier<br>- Cara bayar'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_order_beli_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_order_beli_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_order_beli_print  
		}
		]
	});
	master_order_beliListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_order_beli_ContextMenu = new Ext.menu.Menu({
		id: 'master_order_beli_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_order_beli_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: master_order_beli_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_order_beli_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_order_beli_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_order_beli_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_order_beli_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_order_beli_SelectedRow=rowIndex;
		master_order_beli_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_order_beli_editContextMenu(){
		master_order_beliListEditorGrid.startEditing(master_order_beli_SelectedRow,1);
  	}
	/* End of Function */

	
	/* Identify  order_id Field */
	order_idField= new Ext.form.NumberField({
		id: 'order_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	/* Identify  order_no Field */
	order_noField= new Ext.form.TextField({
		id: 'order_noField',
		//fieldLabel: 'No Order',
		fieldLabel: 'No OP',
		emptyText: '(Auto)',
		readOnly: true,
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  order_supplier Field */
	order_supplierField= new Ext.form.ComboBox({
		id: 'order_supplierField',
		fieldLabel: 'Supplier <span style="color: #ec0000">*</span>',
		store: cbo_order_supplier_DataSore,
		displayField:'order_supplier_nama',
		mode : 'remote',
		valueField: 'order_supplier_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
		allowBlank: false,
        tpl: order_supplier_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	var dt = new Date();
	/* Identify  order_tanggal Field */
	order_tanggalField= new Ext.form.DateField({
		id: 'order_tanggalField',
		name: 'order_tanggalField',
		fieldLabel: 'Tanggal',
		//emptyText : dt.format('d-m-Y'),
		format : 'd-m-Y'
	});
	/* Identify  order_carabayar Field */
	order_carabayarField= new Ext.form.ComboBox({
		id: 'order_carabayarField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['order_carabayar_value', 'order_carabayar_display'],
			data:[['Tunai','Tunai'],['Kredit','Kredit'],['Konsinyasi','Konsinyasi']]
		}),
		mode: 'local',
		displayField: 'order_carabayar_display',
		valueField: 'order_carabayar_value',
		anchor: '80%',
		allowBlank: false,
		triggerAction: 'all'	
	});
	order_statusField= new Ext.form.ComboBox({
		id: 'order_statusField',
		fieldLabel: 'Status Dok',
		store:new Ext.data.SimpleStore({
			fields:['order_status_value', 'order_status_display'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup'],['Batal', 'Batal']]
		}),
		mode: 'local',
		displayField: 'order_status_display',
		valueField: 'order_status_value',
		anchor: '60%',
		allowBlank: false,
		triggerAction: 'all'	
	});
	
	order_status_accField= new Ext.form.ComboBox({
		id: 'order_status_accField',
		fieldLabel: 'Status Acc',
		store:new Ext.data.SimpleStore({
			fields:['order_status_acc_value', 'order_status_acc_display'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup']]
		}),
		mode: 'local',
		displayField: 'order_status_acc_display',
		valueField: 'order_status_acc_value',
		anchor: '60%',
		allowBlank: false,
		triggerAction: 'all'	
	});
	
	
	/* Identify  order_diskon Field */
	order_diskonField= new Ext.form.NumberField({
		id: 'order_diskonField',
		fieldLabel: 'Diskon (%)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: true,
		anchor: '50%',
		maxLength: 2,
		maskRe: /([0-9]+)$/
	});
	
	order_cashbackField= new Ext.form.NumberField({
		id: 'order_cashbackField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		anchor: '50%',
		maxLength: 10,
		maskRe: /([0-9]+)$/
	});
	
	/* Identify  order_biaya Field */
	order_biayaField= new Ext.form.NumberField({
		id: 'order_biayaField',
		fieldLabel: 'Biaya (Rp)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	/* START Field master_order_beli_bayarGroup */
	order_subtotalField= new Ext.form.NumberField({
		id: 'order_subtotalField',
		fieldLabel: 'Sub Total (Rp)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	/* Identify  order_bayar Field */
	order_totalField= new Ext.ux.form.CFTextField({
		id: 'order_totalField',
		fieldLabel: '<span><b>Total (Rp)</b></span>',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%'
	});
	
	/* Identify  order_bayar Field */
	order_jumlahField= new Ext.form.NumberField({
		id: 'order_jumlahField',
		fieldLabel: 'Total Item',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	order_bayarField= new Ext.form.NumberField({
		id: 'order_bayarField',
		fieldLabel: 'Uang Muka (Rp)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: true,
		anchor: '95%',
		maxLength: 12,
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	order_totalbayarField= new Ext.ux.form.CFTextField({
		id: 'order_totalbayarField',
		fieldLabel: 'Total Bayar (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%'
	});
	/* END Field master_order_beli_bayarGroup */
	
	/* Identify  order_keterangan Field */
	order_keteranganField= new Ext.form.TextArea({
		id: 'order_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	
	master_order_beli_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [order_noField, order_supplierField, order_tanggalField, order_carabayarField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [order_keteranganField, order_statusField, order_status_accField, order_idField] 
			}
			]
	
	});
	//master_order_beli_FootGroup
	master_order_beli_bayarGroup = new Ext.form.FieldSet({
		title: '-',
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
				items: [order_jumlahField, order_totalField] 
			},{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [order_diskonField, order_cashbackField, order_biayaField,order_bayarField, order_totalbayarField] 
			}
			]
	
	});
	
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_order_beli_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'dorder_id'
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dorder_id', type: 'int', mapping: 'dorder_id'}, 
			{name: 'dorder_master', type: 'int', mapping: 'dorder_master'}, 
			{name: 'dorder_produk', type: 'int', mapping: 'dorder_produk'},
			{name: 'produk_nama', type: 'string', mapping: 'produk_nama'},
			{name: 'dorder_terima', type: 'float', mapping: 'jumlah_terima'}, 
			{name: 'dorder_satuan', type: 'int', mapping: 'dorder_satuan'}, 
			{name: 'dorder_jumlah', type: 'int', mapping: 'jumlah_barang'}, 
			{name: 'dorder_harga', type: 'float', mapping: 'harga_satuan'}, 
			{name: 'dorder_diskon', type: 'float', mapping: 'diskon'} ,
			{name: 'dorder_subtotal', type: 'float', mapping: 'dorder_subtotal'} 
			
	]);
	//eof
	
	//function for json writer of detail
	var detail_order_beli_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_order_beli_DataStore = new Ext.data.Store({
		id: 'detail_order_beli_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_order_beli&m=detail_detail_order_beli_list', 
			method: 'POST'
		}),
		reader: detail_order_beli_reader,
		baseParams:{start:0, limit:pageS, task: 'detail'},
		sortInfo:{field: 'dorder_id', direction: 'DESC'}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_order_beli= new Ext.ux.grid.RowEditor({
        saveText: 'Update'/*,
		listeners: function(){
			stat='ADD';
			console.log(stat);
		}*/
    });
	//eof
	
	cbo_order_satuanDataStore = new Ext.data.Store({
		id: 'cbo_order_satuanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_order_beli&m=get_satuan_list', 
			method: 'POST'
		}),
		baseParams:{start:0,limit:pageS,task:'detail'},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'order_satuan_value'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'order_satuan_value', type: 'int', mapping: 'satuan_id'},
			{name: 'order_satuan_kode', type: 'string', mapping: 'satuan_kode'},
			{name: 'order_satuan_display', type: 'string', mapping: 'satuan_nama'}
		]),
		sortInfo:{field: 'order_satuan_display', direction: "ASC"}
	});
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_order_produk=new Ext.form.ComboBox({
			store: cbo_order_produk_DataStore,
			mode: 'remote',
			typeAhead: false,
			displayField: 'order_produk_nama',
			valueField: 'order_produk_value',
			triggerAction: 'all',
			lazyRender: false,
			pageSize: pageS,
			enableKeyEvents: true,
			tpl: order_produk_detail_tpl,
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			listClass: 'x-combo-list-small',
			anchor: '95%'
	});
	
	var combo_order_satuan=new Ext.form.ComboBox({
			store: cbo_order_satuanDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'order_satuan_display',
			valueField: 'order_satuan_value',
			triggerAction: 'all',
			lazyRender:true,

	});
	
	var order_harga_satuanField=new Ext.form.NumberField({
		allowDecimals: true,
		allowNegative: false,
		blankText: '0',
		maxLength: 22,
		maskRe: /([0-9]+)$/
	});
	
	var order_diskon_satuanField=new Ext.form.NumberField({
		allowDecimals: true,
		allowNegative: false,
		blankText: '0',
		maxLength: 22,
		maskRe: /([0-9]+)$/
	});
	
	
	
	//declaration of detail coloumn model
	detail_order_beli_ColumnModel = new Ext.grid.ColumnModel(
		[
		 {
			header: '<div align="center">' + 'Produk' + '</div>',
			dataIndex: 'dorder_produk',
			width: 260,	//250,
			sortable: true,
			editor: combo_order_produk,
			renderer: Ext.util.Format.comboRenderer(combo_order_produk)
		},
		{
			header: '<div align="center">' + 'Satuan' + '</div>',
			dataIndex: 'dorder_satuan',
			width: 80,	//150,
			editor: combo_order_satuan,
			renderer: Ext.util.Format.comboRenderer(combo_order_satuan)
		},
		{
			header: '<div align="center">' + 'Jumlah' + '</div>',
			align: 'right',
			dataIndex: 'dorder_jumlah',
			width: 60,	//100,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		<? if(($_SESSION[SESSION_GROUPID]==9 || ($_SESSION[SESSION_GROUPID]==1))){ ?>
		{
			header: '<div align="center">' + 'Harga (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'dorder_harga',
			width: 100,	//150,
			sortable: true,
			editor:  order_harga_satuanField,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			
		},
		{
			header: '<div align="center">' + 'Diskon (%)' + '</div>',
			align: 'right',
			dataIndex: 'dorder_diskon',
			width: 60,	//100,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			sortable: true,
			editor: order_diskon_satuanField,
		},
		{
			header: '<div align="center">' + 'Sub Total (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'dorder_subtotal',
			width: 100,	//150,
			sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
					subtotal=Ext.util.Format.number((record.data.dorder_harga * record.data.dorder_jumlah*(100-record.data.dorder_diskon)/100),"0,000");
                    return '<span>' + subtotal+ '</span>';
            }
		},
		<? } ?>
		{
			header: '<div align="center">Jml Terima</div>',
			align: 'right',
			dataIndex: 'dorder_terima',
			width: 60,
			sortable: true,
			readOnly: true
		},
		]
	);
	detail_order_beli_ColumnModel.defaultSortable= true;
	//eof
	var detail_order_bAdd=new Ext.Button({
		text: 'Add',
		tooltip: 'Add new detail record',
		iconCls:'icon-adds',    				// this is defined in our styles.css
		handler: detail_order_beli_add
	});
	//declaration of detail list editor grid
	detail_order_beliListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_order_beliListEditorGrid',
		el: 'fp_detail_order_beli',
		title: 'Detail Item',
		height: 250,
		width: 920,	//690,
		autoScroll: true,
		store: detail_order_beli_DataStore, // DataStore
		colModel: detail_order_beli_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_order_beli],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		/*bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_order_beli_DataStore,
			displayInfo: true
		}),*/
		/* Add Control on ToolBar */
		tbar: [detail_order_bAdd
		, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_order_beli_confirm_delete
		}
		]
	});
	//eof
	
	//function of detail add
	function detail_order_beli_add(){
		var edit_detail_order_beli= new detail_order_beliListEditorGrid.store.recordType({
			dorder_id		:'',		
			dorder_master	:'',		
			dorder_produk	:null,		
			dorder_satuan	:null,		
			dorder_jumlah	:0,		
			dorder_harga	:0,		
			dorder_diskon	:0		
		});
		editor_detail_order_beli.stopEditing();
		detail_order_beli_DataStore.insert(0, edit_detail_order_beli);
		//detail_order_beliListEditorGrid.getView().refresh();
		detail_order_beliListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_order_beli.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_order_beli(){
		detail_order_beli_DataStore.commitChanges();
		detail_order_beliListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_order_beli_insert(pkid,opsi){
        var dorder_id = [];
        var dorder_produk = [];
        var dorder_satuan = [];
        var dorder_jumlah = [];
        var dorder_harga = [];
        var dorder_diskon = [];
        
        var dcount = detail_order_beli_DataStore.getCount() - 1;
        
        if(detail_order_beli_DataStore.getCount()>0){
            for(i=0; i<detail_order_beli_DataStore.getCount();i++){
                if((/^\d+$/.test(detail_order_beli_DataStore.getAt(i).data.dorder_produk))
				   && detail_order_beli_DataStore.getAt(i).data.dorder_produk!==undefined
				   && detail_order_beli_DataStore.getAt(i).data.dorder_produk!==''
				   && detail_order_beli_DataStore.getAt(i).data.dorder_produk!==0){
                    
                    if(detail_order_beli_DataStore.getAt(i).data.dorder_id==undefined){
						dorder_id.push('');
					}else{
						dorder_id.push(detail_order_beli_DataStore.getAt(i).data.dorder_id);
					}
                    
					dorder_produk.push(detail_order_beli_DataStore.getAt(i).data.dorder_produk);
                    
                    if(detail_order_beli_DataStore.getAt(i).data.dorder_satuan==undefined){
						dorder_satuan.push('');
					}else{
						dorder_satuan.push(detail_order_beli_DataStore.getAt(i).data.dorder_satuan);
					}
                    
                    if(detail_order_beli_DataStore.getAt(i).data.dorder_jumlah==undefined){
						dorder_jumlah.push('');
					}else{
						dorder_jumlah.push(detail_order_beli_DataStore.getAt(i).data.dorder_jumlah);
					}
                    
                    if(detail_order_beli_DataStore.getAt(i).data.dorder_harga==undefined){
						dorder_harga.push('');
					}else{
						dorder_harga.push(detail_order_beli_DataStore.getAt(i).data.dorder_harga);
					}
                    
                    if(detail_order_beli_DataStore.getAt(i).data.dorder_diskon==undefined){
						dorder_diskon.push('');
					}else{
						dorder_diskon.push(detail_order_beli_DataStore.getAt(i).data.dorder_diskon);
					}
                    
                }
                
                if(i==dcount){
                    var encoded_array_dorder_id = Ext.encode(dorder_id);
                    var encoded_array_dorder_produk = Ext.encode(dorder_produk);
                    var encoded_array_dorder_satuan = Ext.encode(dorder_satuan);
                    var encoded_array_dorder_jumlah = Ext.encode(dorder_jumlah);
                    var encoded_array_dorder_harga = Ext.encode(dorder_harga);
                    var encoded_array_dorder_diskon = Ext.encode(dorder_diskon);
                    
                    Ext.Ajax.request({
                        waitMsg: 'Mohon tunggu...',
                        url: 'index.php?c=c_master_order_beli&m=detail_detail_order_beli_insert',
                        params:{
                            dorder_id		: encoded_array_dorder_id,
                            dorder_master	: pkid, 
                            dorder_produk	: encoded_array_dorder_produk,
                            dorder_satuan	: encoded_array_dorder_satuan,
                            dorder_jumlah	: encoded_array_dorder_jumlah,
                            dorder_harga	: encoded_array_dorder_harga,
                            dorder_diskon	: encoded_array_dorder_diskon
                        },
                        success:function(response){
                            var result=eval(response.responseText);
                            
                            if(result==1 && opsi=='print'){
                                master_order_beli_cetak_faktur();
                            }else{
                                //affected_rows tidak terjadi
                            }
                            master_order_beli_DataStore.reload();
                        },
                        failure: function(response){
							Ext.MessageBox.hide();
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
        }
        
		/*for(i=0;i<detail_order_beli_DataStore.getCount();i++){
			detail_order_beli_record=detail_order_beli_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_order_beli&m=detail_detail_order_beli_insert',
				params:{
				dorder_id		: detail_order_beli_record.data.dorder_id, 
				dorder_master	: pkid, 
				dorder_produk	: detail_order_beli_record.data.dorder_produk, 
				dorder_satuan	: detail_order_beli_record.data.dorder_satuan, 
				dorder_jumlah	: detail_order_beli_record.data.dorder_jumlah, 
				dorder_harga	: detail_order_beli_record.data.dorder_harga, 
				dorder_diskon	: detail_order_beli_record.data.dorder_diskon 
				},
                success:function(response){
                    if(opsi=='print'){
                        master_order_beli_cetak_faktur();
                    }
                    master_order_beli_DataStore.reload(); //by masongbee
                }
			});
		}
		master_order_beli_DataStore.reload();		*/ //by masongbee
	}
	//eof
	
	
	//function for purge detail
	function detail_order_beli_purge(pkid,opsi){
		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_order_beli&m=detail_detail_order_beli_purge',
			params:{ master_id: pkid },
			success:function(response){
				detail_order_beli_insert(pkid,opsi); //by masongbee
				/*if(opsi=='print'){
					master_order_beli_cetak_faktur();
				}
				master_order_beli_DataStore.reload();*/ //by masongbee
			}
		});
		
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_order_beli_confirm_delete(){
		// only one record is selected here
		if(detail_order_beliListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_order_beli_delete);
		} else if(detail_order_beliListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_order_beli_delete);
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
	function detail_order_beli_delete(btn){
		if(btn=='yes'){
			var s = detail_order_beliListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_order_beli_DataStore.remove(r);
			}
		} 
		detail_order_beli_DataStore.commitChanges();
	}
	//eof
	
	/* Function for retrieve create Window Panel*/ 
	master_order_beli_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,
		monitorValid: true,
		items: [master_order_beli_masterGroup,detail_order_beliListEditorGrid,master_order_beli_bayarGroup],
		buttons: [{
				text: 'Save and Print',
				handler: function() { master_order_beli_create('print'); }
			},{
				text: 'Save',
				handler: function() { master_order_beli_create(''); }
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_order_beli_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	
	/* Function for retrieve create Window Form */
	master_order_beli_createWindow= new Ext.Window({
		id: 'master_order_beli_createWindow',
		title: post2db+'Order Pembelian',
		closable:true,
		closeAction: 'hide',
		width: 940,
		//autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_order_beli_create',
		items: master_order_beli_createForm
	});
	/* End Window */
	function detail_order_beli_total(){
		var jumlah_item=0;
		var total_harga=0;
		for(i=0;i<detail_order_beli_DataStore.getCount();i++){
			detail_order_beli_record=detail_order_beli_DataStore.getAt(i);
			jumlah_item=jumlah_item+detail_order_beli_record.data.dorder_jumlah;
			total_harga=total_harga+(detail_order_beli_record.data.dorder_jumlah*detail_order_beli_record.data.dorder_harga*(100-detail_order_beli_record.data.dorder_diskon)/100);
		}
		order_jumlahField.setValue(jumlah_item);
		order_totalField.setValue(total_harga);
		order_totalbayarField.setValue(total_harga-order_bayarField.getValue());
	}
	
	/* Function for action list search */
	function master_order_beli_list_search(){
		// render according to a SQL date format.
		var order_id_search=null;
		var order_no_search=null;
		var order_supplier_search=null;
		var order_tanggal_search_date="";
		var order_tanggal_akhir_search_date="";
		var order_carabayar_search=null;
//		var order_diskon_search=null;
//		var order_biaya_search=null;
//		var order_bayar_search=null;
		var order_keterangan_search=null;
		var order_status_search=null;
		var order_status_acc_search=null;

		if(order_idSearchField.getValue()!==null){order_id_search=order_idSearchField.getValue();}
		if(order_noSearchField.getValue()!==null){order_no_search=order_noSearchField.getValue();}
		if(order_supplierSearchField.getValue()!==null){order_supplier_search=order_supplierSearchField.getValue();}
		if(order_tanggalSearchField.getValue()!==""){order_tanggal_search_date=order_tanggalSearchField.getValue().format('Y-m-d');}
		if(order_tanggal_akhirSearchField.getValue()!==""){order_tanggal_akhir_search_date=order_tanggal_akhirSearchField.getValue().format('Y-m-d');}
		if(order_carabayarSearchField.getValue()!==null){order_carabayar_search=order_carabayarSearchField.getValue();}
//		if(order_diskonSearchField.getValue()!==null){order_diskon_search=order_diskonSearchField.getValue();}
//		if(order_biayaSearchField.getValue()!==null){order_biaya_search=order_biayaSearchField.getValue();}
//		if(order_bayarSearchField.getValue()!==null){order_bayar_search=order_bayarSearchField.getValue();}
		if(order_keteranganSearchField.getValue()!==null){order_keterangan_search=order_keteranganSearchField.getValue();}
		if(order_statusSearchField.getValue()!==null){order_status_search=order_statusSearchField.getValue();}
		if(order_status_accSearchField.getValue()!==null){order_status_acc_search=order_status_accSearchField.getValue();}
		
		// change the store parameters
		master_order_beli_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			order_id			:	order_id_search, 
			order_no			:	order_no_search, 
			order_supplier		:	order_supplier_search, 
			order_tanggal		:	order_tanggal_search_date, 
			order_tanggal_akhir	:	order_tanggal_akhir_search_date, 
			order_carabayar		:	order_carabayar_search, 
//			order_diskon	:	order_diskon_search, 
//			order_biaya	:	order_biaya_search, 
//			order_bayar	:	order_bayar_search, 
			order_keterangan	:	order_keterangan_search,
			order_status		:	order_status_search,
			order_status_acc	:	order_status_acc_search
		};
		// Cause the datastore to do another query : 
		master_order_beli_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_order_beli_reset_search(){
		// reset the store parameters
		master_order_beli_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_order_beli_DataStore.reload({params: {start: 0, limit: pageS}});
		master_order_beli_searchWindow.close();
	};
	/* End of Fuction */
	
	function master_order_beli_cetak_faktur(){
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_order_beli&m=print_faktur',
		params: {
			faktur	: order_idField.getValue()
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/master_order_faktur.html','master_order_faktur','height=800,width=670,resizable=1,scrollbars=1, menubar=1');
				//win.print();
				//win.close();
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
	
	
	function master_order_beli_reset_SearchForm(){
		order_noSearchField.reset();
		order_supplierSearchField.reset();
		order_tanggalSearchField.reset();
		//order_tanggalSearchField.setValue(firstday);
		order_tanggal_akhirSearchField.reset();
		//order_tanggal_akhirSearchField.setValue(today);
		order_carabayarSearchField.reset();
//		order_diskonSearchField.reset();
//		order_cashbackSearchField.reset();
//		order_biayaSearchField.reset();
//		order_bayarSearchField.reset();
		order_keteranganSearchField.reset();
		order_statusSearchField.reset();
		order_status_accSearchField.reset();
		
	}
	
	
	/* Field for search */
	/* Identify  order_id Search Field */
	order_idSearchField= new Ext.form.NumberField({
		id: 'order_idSearchField',
		fieldLabel: 'Id Order',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  order_no Search Field */
	order_noSearchField= new Ext.form.TextField({
		id: 'order_noSearchField',
		//fieldLabel: 'No Order',
		fieldLabel: 'No OP',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  order_supplier Search Field */
	order_supplierSearchField= new Ext.form.ComboBox({
		id: 'order_supplierSearchField',
		fieldLabel: 'Supplier',
		store: cbo_order_supplier_DataSore,
		displayField:'order_supplier_nama',
		mode : 'remote',
		valueField: 'order_supplier_value',
        typeAhead: false,
        //loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
		allowBlank: true,
        tpl: order_supplier_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	
	});
	/* Identify  order_tanggal Search Field */
	order_tanggalSearchField= new Ext.form.DateField({
		id: 'order_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
//		value: firstday
	
	});

	order_tanggal_akhirSearchField= new Ext.form.DateField({
		id: 'order_tanggal_akhirSearchField',
		fieldLabel: 's/d',
		format : 'd-m-Y'
//		value: today	
	});
	
	order_label_tanggal_labelField=new Ext.form.Label({html: 'Tanggal :' });
	
	order_label_tanggalField= new Ext.form.Label({ html: ' &nbsp; s/d  &nbsp;' });
	
	order_tanggalSearchFieldSet=new Ext.form.FieldSet({
		id:'order_tanggalSearchFieldSet',
		title: 'Opsi Tanggal',
		layout: 'column',
		boduStyle: 'padding: 5px;',
		frame: false,
		items:[order_tanggalSearchField, order_label_tanggalField, order_tanggal_akhirSearchField]
	});

	/* Identify  order_carabayar Search Field */
	order_carabayarSearchField= new Ext.form.ComboBox({
		id: 'order_carabayarSearchField',
		fieldLabel: 'Cara Pembayaran',
		store:new Ext.data.SimpleStore({
			fields:['value', 'order_carabayar'],
			data:[['Tunai','Tunai'],['Kredit','Kredit'],['Konsinyasi','Konsinyasi']]
		}),
		mode: 'local',
		displayField: 'order_carabayar',
		valueField: 'value',
		anchor: '41%',
		triggerAction: 'all'	 
	
	});
/*
	order_diskonSearchField= new Ext.form.NumberField({
		id: 'order_diskonSearchField',
		fieldLabel: 'Diskon (%)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '50%',
		maxLength: 2,
		maskRe: /([0-9]+)$/
	
	});
	
	order_cashbackSearchField= new Ext.form.NumberField({
		id: 'order_cashbackSearchField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});

	order_biayaSearchField= new Ext.form.NumberField({
		id: 'order_biayaSearchField',
		fieldLabel: 'Biaya',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});

	order_bayarSearchField= new Ext.form.NumberField({
		id: 'order_bayarSearchField',
		fieldLabel: 'Bayar',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
*/	

	/* Identify  order_keterangan Search Field */
	order_keteranganSearchField= new Ext.form.TextField({
		id: 'order_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	
	order_statusSearchField= new Ext.form.ComboBox({
		id: 'order_statusSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'order_status'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup'],['Batal','Batal']]
		}),
		mode: 'local',
		displayField: 'order_status',
		valueField: 'value',
		anchor: '41%',
		triggerAction: 'all'	 
	});
	
	order_status_accSearchField= new Ext.form.ComboBox({
		id: 'order_status_accSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'order_status_acc'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup']]
		}),
		mode: 'local',
		displayField: 'order_status_acc',
		valueField: 'value',
		anchor: '41%',
		triggerAction: 'all'	 
	});

    
	/* Function for retrieve search Form Panel */
	master_order_beli_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 500,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [
					order_noSearchField, 
					order_supplierSearchField, 	
					order_tanggalSearchFieldSet,					
/*					{
						layout:'column',
						border:false,
						items:[
						{
							columnWidth:0.45,
							layout: 'form',
							border:false,
							defaultType: 'datefield',
							items: [						
								order_tanggalSearchField
							]
						},
						{
							columnWidth:0.30,
							layout: 'form',
							border:false,
							labelWidth:30,
							defaultType: 'datefield',
							items: [						
								order_tanggal_akhirSearchField
							]
						}						
				        ]
					},	
*/
					order_carabayarSearchField, 
					//order_diskonSearchField,
					//order_cashbackSearchField,  
					//order_biayaSearchField, 
					order_keteranganSearchField,
					order_statusSearchField,
					order_status_accSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_order_beli_list_search
			},{
				text: 'Close',
				handler: function(){
					master_order_beli_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_order_beli_searchWindow = new Ext.Window({
		title: 'Percarian Order Pembelian',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_order_beli_search',
		items: master_order_beli_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_order_beli_searchWindow.isVisible()){
			master_order_beli_reset_SearchForm();
			master_order_beli_searchWindow.show();
		} else {
			master_order_beli_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_order_beli_print(){
		var searchquery = "";
		var order_no_print=null;
		var order_supplier_print=null;
		var order_tanggal_print_date="";
		var order_carabayar_print=null;
		var order_diskon_print=null;
		var order_cashback_print=null;
		var order_biaya_print=null;
		var order_bayar_print=null;
		var order_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_order_beli_DataStore.baseParams.query!==null){searchquery = master_order_beli_DataStore.baseParams.query;}
		if(master_order_beli_DataStore.baseParams.order_no!==null){order_no_print = master_order_beli_DataStore.baseParams.order_no;}
		if(master_order_beli_DataStore.baseParams.order_supplier!==null){order_supplier_print = master_order_beli_DataStore.baseParams.order_supplier;}
		if(master_order_beli_DataStore.baseParams.order_tanggal!==""){order_tanggal_print_date = master_order_beli_DataStore.baseParams.order_tanggal;}
		if(master_order_beli_DataStore.baseParams.order_carabayar!==null){order_carabayar_print = master_order_beli_DataStore.baseParams.order_carabayar;}
		if(master_order_beli_DataStore.baseParams.order_diskon!==null){order_diskon_print = master_order_beli_DataStore.baseParams.order_diskon;}
		if(master_order_beli_DataStore.baseParams.order_cashback!==null){order_cashback_print = master_order_beli_DataStore.baseParams.order_cashback;}
		if(master_order_beli_DataStore.baseParams.order_biaya!==null){order_biaya_print = master_order_beli_DataStore.baseParams.order_biaya;}
		if(master_order_beli_DataStore.baseParams.order_bayar!==null){order_bayar_print = master_order_beli_DataStore.baseParams.order_bayar;}
		if(master_order_beli_DataStore.baseParams.order_keterangan!==null){order_keterangan_print = master_order_beli_DataStore.baseParams.order_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_order_beli&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			order_no 			: order_no_print,
			order_supplier 		: order_supplier_print,
		  	order_tanggal 		: order_tanggal_print_date, 
			order_carabayar 	: order_carabayar_print,
			order_diskon 		: order_diskon_print,
			order_cashback 		: order_cashback_print,
			order_biaya 		: order_biaya_print,
			order_bayar 		: order_bayar_print,
			order_keterangan 	: order_keterangan_print,
		  	currentlisting		: master_order_beli_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_order_belilist.html','master_order_belilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_order_beli_export_excel(){
		var searchquery = "";
		var order_no_2excel=null;
		var order_supplier_2excel=null;
		var order_tanggal_2excel_date="";
		var order_carabayar_2excel=null;
		var order_diskon_2excel=null;
		var order_cashback_2excel=null;
		var order_biaya_2excel=null;
		var order_bayar_2excel=null;
		var order_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_order_beli_DataStore.baseParams.query!==null){searchquery = master_order_beli_DataStore.baseParams.query;}
		if(master_order_beli_DataStore.baseParams.order_no!==null){order_no_2excel = master_order_beli_DataStore.baseParams.order_no;}
		if(master_order_beli_DataStore.baseParams.order_supplier!==null){order_supplier_2excel = master_order_beli_DataStore.baseParams.order_supplier;}
		if(master_order_beli_DataStore.baseParams.order_tanggal!==""){order_tanggal_2excel_date = master_order_beli_DataStore.baseParams.order_tanggal;}
		if(master_order_beli_DataStore.baseParams.order_carabayar!==null){order_carabayar_2excel = master_order_beli_DataStore.baseParams.order_carabayar;}
		if(master_order_beli_DataStore.baseParams.order_diskon!==null){order_diskon_2excel = master_order_beli_DataStore.baseParams.order_diskon;}
		if(master_order_beli_DataStore.baseParams.order_cashback!==null){order_cashback_2excel = master_order_beli_DataStore.baseParams.order_cashback;}
		if(master_order_beli_DataStore.baseParams.order_biaya!==null){order_biaya_2excel = master_order_beli_DataStore.baseParams.order_biaya;}
		if(master_order_beli_DataStore.baseParams.order_bayar!==null){order_bayar_2excel = master_order_beli_DataStore.baseParams.order_bayar;}
		if(master_order_beli_DataStore.baseParams.order_keterangan!==null){order_keterangan_2excel = master_order_beli_DataStore.baseParams.order_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_order_beli&m=get_action',
		params: {
			task				: "EXCEL",
		  	query				: searchquery,                    		
			order_no 			: order_no_2excel,
			order_supplier 		: order_supplier_2excel,
		  	order_tanggal 		: order_tanggal_2excel_date, 
			order_carabayar 	: order_carabayar_2excel,
			order_diskon 		: order_diskon_2excel,
			order_cashback		: order_cashback_2excel,
			order_biaya 		: order_biaya_2excel,
			order_bayar 		: order_bayar_2excel,
			order_keterangan 	: order_keterangan_2excel,
		  	currentlisting		: master_order_beli_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	//EVENTS
	master_order_beli_DataStore.load({params:{start:0, limit: pageS}});
	detail_order_beli_DataStore.on("load",detail_order_beli_total);
	order_bayarField.on("keypress",detail_order_beli_total);
	order_bayarField.on("keydown",detail_order_beli_total);
	order_bayarField.on("keyup",detail_order_beli_total);	
	master_order_beliListEditorGrid.addListener('rowcontextmenu', onmaster_order_beli_ListEditGridContextMenu);
	//master_order_beli_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_order_beliListEditorGrid.on('afteredit', master_order_beli_update); // inLine Editing Record
	
	combo_order_produk.on("focus",function(){
		cbo_order_produk_DataStore.setBaseParam('task','list');
		var selectedquery=detail_order_beliListEditorGrid.getSelectionModel().getSelected().get('produk_nama');
		cbo_order_produk_DataStore.setBaseParam('query',selectedquery);
		
		//cbo_order_produk_DataStore.load();
	});
	
	combo_order_satuan.on("focus",function(){
		cbo_order_satuanDataStore.setBaseParam('task','produk');
		cbo_order_satuanDataStore.setBaseParam('selected_id',combo_order_produk.getValue());
		cbo_order_satuanDataStore.load();
	});
	
	combo_order_produk.on("select",function(){
		cbo_order_satuanDataStore.setBaseParam('task','produk');
		cbo_order_satuanDataStore.setBaseParam('selected_id',combo_order_produk.getValue());
		cbo_order_satuanDataStore.load();
	});
	
	
	detail_order_beli_DataStore.on("update",function(){
		var	query_selected="";
		var satuan_selected="";
		detail_order_beli_DataStore.commitChanges();
		detail_order_beli_total();
		cbo_order_produk_DataStore.lastQuery=null;
		for(i=0;i<detail_order_beli_DataStore.getCount();i++){
			detail_order_beli_record=detail_order_beli_DataStore.getAt(i);
			query_selected=query_selected+detail_order_beli_record.data.dorder_produk+",";
		}
		cbo_order_produk_DataStore.setBaseParam('task','selected');
		cbo_order_produk_DataStore.setBaseParam('master_id',get_pk_id());
		cbo_order_produk_DataStore.setBaseParam('selected_id',query_selected);
		cbo_order_produk_DataStore.load();
		
		for(i=0;i<detail_order_beli_DataStore.getCount();i++){
			detail_order_beli_record=detail_order_beli_DataStore.getAt(i);
			satuan_selected=satuan_selected+detail_order_beli_record.data.dorder_satuan+",";
		}
		cbo_order_satuanDataStore.setBaseParam('task','selected');
		cbo_order_satuanDataStore.setBaseParam('selected_id',satuan_selected);
		cbo_order_satuanDataStore.load();
		stat='EDIT';
	});
	
	detail_order_beli_DataStore.on("load", function(){
		if(detail_order_beli_DataStore.getCount()==pageS && detail_order_beli_DataStore.getTotalCount()>pageS){
			detail_order_bAdd.disabled=true;
		}else{
			detail_order_bAdd.disabled=false;
		}
		
			
	});
	
	/*master_order_paging_toolbar.on("change", function(){	
			console.log('aktive page :');
	});*/
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_order_beli"></div>
         <div id="fp_detail_order_beli"></div>
		<div id="elwindow_master_order_beli_create"></div>
        <div id="elwindow_master_order_beli_search"></div>
    </div>
</div>
</body>