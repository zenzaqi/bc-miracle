<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_retur_jual_produk View
	+ Description	: For record view
	+ Filename 		: v_master_retur_jual_produk.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 14:53:25
	
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
var master_retur_jual_produk_DataStore;
var master_retur_jual_produk_ColumnModel;
var master_retur_jual_produkListEditorGrid;
var master_retur_jual_produk_createForm;
var master_retur_jual_produk_createWindow;
var master_retur_jual_produk_searchForm;
var master_retur_jual_produk_searchWindow;
var master_retur_jual_produk_SelectedRow;
var master_retur_jual_produk_ContextMenu;
//for detail data
var detail_retur_jual_produk_DataStor;
var detail_retur_jual_produkListEditorGrid;
var detail_retur_jual_produk_ColumnModel;
var detail_retur_jual_produk_proxy;
var detail_retur_jual_produk_writer;
var detail_retur_jual_produk_reader;
var editor_detail_retur_jual_produk;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var rproduk_idField;
var rproduk_nobuktiField;
var rproduk_nobuktijualField;
var rproduk_custField;
var rproduk_tanggalField;
var rproduk_keteranganField;
var rproduk_statusField;
var rproduk_idSearchField;
var rproduk_nobuktiSearchField;
var rproduk_nobuktijualSearchField;
var rproduk_custSearchField;
var rproduk_tanggalSearchField;
var rproduk_keteranganSearchField;
var rproduk_statusSearchField;

var dt= new Date();

function retur_jproduk_cetak(kwitansi_ref){
	Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_master_retur_jual_produk&m=print_paper',
		params: { kwitansi_ref : kwitansi_ref}, 
		success: function(response){              
			var result=eval(response.responseText);
			switch(result){
			case 1:
				win = window.open('./kwitansi_paper.html','Cetak Kwitansi Retur Produk','height=480,width=1240,resizable=1,scrollbars=0, menubar=0');
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
	
	Ext.util.Format.comboRenderer = function(combo){
  	    return function(value){
  	        var record = combo.findRecord(combo.valueField, value);
  	        return record ? record.get(combo.displayField) : combo.valueNotFoundText;
  	    }
  	}
  
  	/* Function for Saving inLine Editing */
	function master_retur_jual_produk_update(oGrid_event){
		var rproduk_id_update_pk="";
		var rproduk_nobukti_update=null;
		var rproduk_nobuktijual_update=null;
		var rproduk_cust_update=null;
		var rproduk_tanggal_update_date="";
		var rproduk_keterangan_update=null;

		rproduk_id_update_pk = oGrid_event.record.data.rproduk_id;
		if(oGrid_event.record.data.rproduk_nobukti!== null){rproduk_nobukti_update = oGrid_event.record.data.rproduk_nobukti;}
		if(oGrid_event.record.data.rproduk_nobuktijual!== null){rproduk_nobuktijual_update = oGrid_event.record.data.rproduk_nobuktijual;}
		if(oGrid_event.record.data.rproduk_cust!== null){rproduk_cust_update = oGrid_event.record.data.rproduk_cust;}
	 	if(oGrid_event.record.data.rproduk_tanggal!== ""){rproduk_tanggal_update_date =oGrid_event.record.data.rproduk_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.rproduk_keterangan!== null){rproduk_keterangan_update = oGrid_event.record.data.rproduk_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Mohon  Tunggu...',
			url: 'index.php?c=c_master_retur_jual_produk&m=get_action',
			params: {
				task: "UPDATE",
				rproduk_id	: rproduk_id_update_pk, 
				rproduk_nobukti	:rproduk_nobukti_update,  
				rproduk_nobuktijual	:rproduk_nobuktijual_update,  
				rproduk_cust	:rproduk_cust_update,  
				rproduk_tanggal	: rproduk_tanggal_update_date, 
				rproduk_keterangan	:rproduk_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_retur_jual_produk_DataStore.commitChanges();
						master_retur_jual_produk_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data retur penjualan produk tidak bisa disimpan',
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
	function master_retur_jual_produk_create(){
	
		if(is_master_retur_jual_produk_form_valid()){	
		var rproduk_id_create_pk=null; 
		var rproduk_nobukti_create=null; 
		var rproduk_nobuktijual_create=null; 
		var rproduk_cust_create=null; 
		var rproduk_tanggal_create_date=""; 
		var rproduk_keterangan_create=null;
		var rproduk_status_create=null;
		var rproduk_kwitansi_nilai_create=null; 
		var rproduk_kwitansi_keterangan_create=null; 

		if(rproduk_idField.getValue()!== null){rproduk_id_create_pk = rproduk_idField.getValue();}else{rproduk_id_create_pk=get_pk_id();} 
		if(rproduk_nobuktiField.getValue()!== null){rproduk_nobukti_create = rproduk_nobuktiField.getValue();} 
		if(rproduk_nobuktijualField.getValue()!== null){rproduk_nobuktijual_create = rproduk_nobuktijualField.getValue();} 
		if(rproduk_custField.getValue()!== null){rproduk_cust_create = rproduk_custidField.getValue();} 
		if(rproduk_tanggalField.getValue()!== ""){rproduk_tanggal_create_date = rproduk_tanggalField.getValue().format('Y-m-d');} 
		if(rproduk_keteranganField.getValue()!== null){rproduk_keterangan_create = rproduk_keteranganField.getValue();}
		if(rproduk_statusField.getValue()!== null){rproduk_status_create = rproduk_statusField.getValue();} 
		if(rproduk_kwitansi_nilaiField.getValue()!== null){rproduk_kwitansi_nilai_create = rproduk_kwitansi_nilaiField.getValue();} 
		if(rproduk_kwitansi_keteranganField.getValue()!== null){rproduk_kwitansi_keterangan_create = rproduk_kwitansi_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Mohon  Tunggu...',
			url: 'index.php?c=c_master_retur_jual_produk&m=get_action',
			params: {
				task: post2db,
				rproduk_id	: rproduk_id_create_pk, 
				rproduk_nobukti	: rproduk_nobukti_create, 
				rproduk_nobuktijual	: rproduk_nobuktijual_create, 
				rproduk_cust	: rproduk_cust_create, 
				rproduk_tanggal	: rproduk_tanggal_create_date, 
				rproduk_keterangan	: rproduk_keterangan_create,
				rproduk_status		: rproduk_status_create,
				rproduk_kwitansi_nilai	: rproduk_kwitansi_nilai_create, 
				rproduk_kwitansi_keterangan	: rproduk_kwitansi_keterangan_create
			}, 
			success: function(response){             
				//var result=eval(response.responseText);
				var result=response.responseText;
				if(result=='0' || result=='1'){
					Ext.MessageBox.show({
					   title: 'Warning',
					   msg: 'Data retur penjualan produk tidak bisa disimpan',
					   buttons: Ext.MessageBox.OK,
					   animEl: 'save',
					   icon: Ext.MessageBox.WARNING
					});
				}else{
					retur_jproduk_cetak(result);
					detail_retur_jual_produk_purge();
					detail_retur_jual_produk_insert();
					master_retur_jual_produk_DataStore.reload();
					master_retur_jual_produk_createWindow.hide();
				}
				/*switch(result){
					case 1:
						detail_retur_jual_produk_purge();
						detail_retur_jual_produk_insert();
						Ext.MessageBox.alert(post2db+' OK','Data retur penjualan produk berhasil disimpan');
						master_retur_jual_produk_DataStore.reload();
						master_retur_jual_produk_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data retur penjualan produk tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
				}*/
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
				msg: 'Form anda belum lengkap!',
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
			return master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_retur_jual_produk_reset_form(){
		rproduk_idField.reset();
		rproduk_idField.setValue(null);
		rproduk_nobuktiField.reset();
		rproduk_nobuktiField.setValue(null);
		rproduk_nobuktijualField.reset();
		rproduk_nobuktijualField.setValue(null);
		rproduk_custField.reset();
		rproduk_custField.setValue(null);
		rproduk_tanggalField.reset();
		rproduk_tanggalField.setValue(dt.format('Y-m-d'));
		rproduk_keteranganField.reset();
		rproduk_keteranganField.setValue(null);
		rproduk_statusField.reset();
		rproduk_statusField.setValue('Terbuka');
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_retur_jual_produk_set_form(){
		rproduk_idField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_id'));
		rproduk_nobuktiField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_nobukti'));
		rproduk_nobuktijualField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_nobuktijual'));
		rproduk_custField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_cust'));
		rproduk_custidField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_cust_id'));
		rproduk_tanggalField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_tanggal'));
		rproduk_keteranganField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_keterangan'));
		rproduk_statusField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_status'));
		rproduk_kwitansi_nilaiField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('kwitansi_nilai'));
		rproduk_kwitansi_keteranganField.setValue(master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('kwitansi_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_retur_jual_produk_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		detail_retur_jual_produk_DataStore.load({params : {master_id : 0, start:0, limit:pageS}});
		cbo_drproduk_satuanDataStore.load();
		if(!master_retur_jual_produk_createWindow.isVisible()){
			master_retur_jual_produk_reset_form();
			post2db='CREATE';
			msg='created';
			master_retur_jual_produk_createWindow.show();
		} else {
			master_retur_jual_produk_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_retur_jual_produk_confirm_delete(){
		// only one master_retur_jual_produk is selected here
		if(master_retur_jual_produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_retur_jual_produk_delete);
		} else if(master_retur_jual_produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_retur_jual_produk_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih data yang akan dihapus?',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
	/* Function for Update Confirm */
	function master_retur_jual_produk_confirm_update(){
		cbo_drproduk_produkDataStore.load({params : {query : master_retur_jual_produkListEditorGrid.getSelectionModel().getSelected().get('rproduk_nobuktijual')}});
		cbo_drproduk_satuanDataStore.load();
		/* only one record is selected here */
		if(master_retur_jual_produkListEditorGrid.selModel.getCount() == 1) {
			master_retur_jual_produk_reset_form();
			master_retur_jual_produk_set_form();
			post2db='UPDATE';
			detail_retur_jual_produk_DataStore.load({
				params : {master_id : eval(get_pk_id()), start:0, limit:pageS}
			});
			msg='updated';
			master_retur_jual_produk_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih data yang akan diedit?',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function master_retur_jual_produk_delete(btn){
		if(btn=='yes'){
			var selections = master_retur_jual_produkListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_retur_jual_produkListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.rproduk_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_retur_jual_produk&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_retur_jual_produk_DataStore.reload();
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
	master_retur_jual_produk_DataStore = new Ext.data.Store({
		id: 'master_retur_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rproduk_id'
		},[
		/* dataIndex => insert intomaster_retur_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rproduk_id', type: 'int', mapping: 'rproduk_id'}, 
			{name: 'rproduk_nobukti', type: 'string', mapping: 'rproduk_nobukti'}, 
			{name: 'rproduk_nobuktijual', type: 'string', mapping: 'jproduk_nobukti'}, 
			{name: 'rproduk_cust_no', type: 'string', mapping: 'cust_no'}, 
			{name: 'rproduk_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'rproduk_cust_id', type: 'int', mapping: 'cust_id'}, 
			{name: 'rproduk_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'rproduk_tanggal'}, 
			{name: 'rproduk_keterangan', type: 'string', mapping: 'rproduk_keterangan'}, 
			{name: 'rproduk_status', type: 'string', mapping: 'rproduk_status'}, 
			{name: 'rproduk_creator', type: 'string', mapping: 'rproduk_creator'}, 
			{name: 'rproduk_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'rproduk_date_create'}, 
			{name: 'rproduk_update', type: 'string', mapping: 'rproduk_update'}, 
			{name: 'rproduk_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'rproduk_date_update'}, 
			{name: 'rproduk_revised', type: 'int', mapping: 'rproduk_revised'},
			{name: 'kwitansi_id', type: 'int', mapping: 'kwitansi_id'},
			{name: 'kwitansi_nilai', type: 'float', mapping: 'kwitansi_nilai'},
			{name: 'kwitansi_keterangan', type: 'string', mapping: 'kwitansi_keterangan'} 
		]),
		sortInfo:{field: 'rproduk_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve DataStore */
	cbo_retur_produk_DataStore = new Ext.data.Store({
		id: 'cbo_retur_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=get_jual_produk_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jproduk_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'retur_produk_value', type: 'int', mapping: 'jproduk_id'},
			{name: 'retur_produk_display', type: 'string', mapping: 'jproduk_nobukti'},
			{name: 'retur_produk_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jproduk_tanggal'},
			{name: 'retur_produk_nama_customer', type: 'string', mapping: 'cust_nama'},
			{name: 'retur_produk_customer_id', type: 'string', mapping: 'cust_id'},
			{name: 'retur_produk_alamat', type: 'string', mapping: 'cust_alamat'}
		]),
		sortInfo:{field: 'retur_produk_display', direction: "ASC"}
	});
	/* End of Function */
    
	
	//ComboBox ambil data Customer
	cbo_rproduk_customerDataStore = new Ext.data.Store({
		id: 'cbo_rproduk_customerDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit:pageS }, // parameter yang di $_POST ke Controller
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
	//Template yang akan tampil di ComboBox
	var customer_rproduk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	
	
  	/* Function for Identify of Window Column Model */
	master_retur_jual_produk_ColumnModel = new Ext.grid.ColumnModel(
		[{
			align : 'Right',
			header: '<div align="center">' + '#' + '</div>',
			readOnly: true,
			dataIndex: 'rproduk_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'rproduk_tanggal',
			width: 70,	//150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		}, 
		{
			header: '<div align="center">' + 'No Faktur' + '</div>',
			dataIndex: 'rproduk_nobukti',
			width: 100, //150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		}, 
		{
			header: '<div align="center">' + 'No Faktur Jual' + '</div>' ,
			dataIndex: 'rproduk_nobuktijual',
			width: 100, //150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		}, 
		{
			header: '<div align="center">' + 'No Cust' + '</div>',
			dataIndex: 'rproduk_cust_no',
			width: 80,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Customer' + '</div>',
			dataIndex: 'rproduk_cust',
			width: 200, //150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Nilai Kuitansi (Rp)' + '</div>',
			dataIndex: 'kwitansi_nilai',
			align: 'right',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: function(val){
				return '<span> '+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'rproduk_keterangan',
			width: 200, //150,
			sortable: true,
			editor: new Ext.form.TextArea({
				maxLength: 250
          	})
		}, 
		
		{
			header: '<div align="center">' + 'Stat Dok' + '</div>',
			dataIndex: 'rproduk_status',
			width: 60
		}, 
		
		{
			header: 'Creator',
			dataIndex: 'rproduk_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'rproduk_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'rproduk_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'rproduk_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'rproduk_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_retur_jual_produk_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_retur_jual_produkListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_retur_jual_produkListEditorGrid',
		el: 'fp_master_retur_jual_produk',
		title: 'Daftar Retur Penjualan Produk',
		autoHeight: true,
		store: master_retur_jual_produk_DataStore, // DataStore
		cm: master_retur_jual_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,	//800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_retur_jual_produk_DataStore,
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
			handler: master_retur_jual_produk_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled : true,
			handler: master_retur_jual_produk_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Adv Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_retur_jual_produk_DataStore,
			params: {start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						master_retur_jual_produk_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By (aktif only)'});
				Ext.get(this.id).set({qtip:'- No Faktur<br>- No Faktur Jual<br>- No Cust<br>- Customer'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_retur_jual_produk_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_retur_jual_produk_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_retur_jual_produk_print  
		}
		]
	});
	master_retur_jual_produkListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_retur_jual_produk_ContextMenu = new Ext.menu.Menu({
		id: 'master_retur_jual_produk_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_retur_jual_produk_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled : true,
			handler: master_retur_jual_produk_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_retur_jual_produk_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_retur_jual_produk_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_retur_jual_produk_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_retur_jual_produk_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_retur_jual_produk_SelectedRow=rowIndex;
		master_retur_jual_produk_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_retur_jual_produk_editContextMenu(){
		master_retur_jual_produkListEditorGrid.startEditing(master_retur_jual_produk_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_retur_jual_produkListEditorGrid.addListener('rowcontextmenu', onmaster_retur_jual_produk_ListEditGridContextMenu);
	master_retur_jual_produk_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_retur_jual_produkListEditorGrid.on('afteredit', master_retur_jual_produk_update); // inLine Editing Record
	
	// Custom rendering Template
    var retur_jual_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{retur_produk_display}</b> | Tgl-Retur:{retur_produk_tanggal:date("M j, Y")}<br /></span>',
            'Customer: {retur_produk_nama_customer}&nbsp;&nbsp;&nbsp;[Alamat: {retur_produk_alamat}]',
        '</div></tpl>'
    );
	
	/* Identify  rproduk_id Field */
	rproduk_idField= new Ext.form.NumberField({
		id: 'rproduk_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		hideLabel: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  rproduk_nobukti Field */
	rproduk_nobuktiField= new Ext.form.TextField({
		id: 'rproduk_nobuktiField',
		fieldLabel: 'No Faktur',
		maxLength: 100,
		anchor: '95%'
	});
	/* Identify  rproduk_nobuktijual Field */
	rproduk_nobuktijualField= new Ext.form.ComboBox({
		id: 'rproduk_nobuktijualField',
		fieldLabel: 'No Faktur Jual',
		store: cbo_retur_produk_DataStore,
		mode: 'remote',
		displayField:'retur_produk_display',
		valueField: 'retur_produk_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: retur_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	/* Identify  rproduk_cust Field */
	rproduk_custField= new Ext.form.TextField({
		id: 'rproduk_custField',
		fieldLabel: 'Customer',
		maxLength: 100,
		emptyText: '(Auto)',
		readOnly : true,
		anchor: '95%'
	});
	
	
	rproduk_custidField= new Ext.form.NumberField();
	/* Identify  rproduk_tanggal Field */
	rproduk_tanggalField= new Ext.form.DateField({
		id: 'rproduk_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y',
	});
	/* Identify  rproduk_keterangan Field */
	rproduk_keteranganField= new Ext.form.TextArea({
		id: 'rproduk_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	/* Identify rproduk_status Field */
	rproduk_statusField= new Ext.form.ComboBox({
		id: 'rproduk_statusField',
		fieldLabel: 'Status Dok',
		store:new Ext.data.SimpleStore({
			fields:['rproduk_status_value', 'rproduk_status_display'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup'],['Batal', 'Batal']]
		}),
		mode: 'local',
		displayField: 'rproduk_status_display',
		valueField: 'rproduk_status_value',
		anchor: '80%',
		allowBlank: false,
		triggerAction: 'all'	
	});
	
	
	
	
	rproduk_kwitansi_nilaiField= new Ext.form.NumberField({
		id: 'rproduk_kwitansi_nilaiField',
		fieldLabel: 'Nilai Kuitansi (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	rproduk_kwitansi_keteranganField= new Ext.form.TextArea({
		id: 'rproduk_kwitansi_keteranganField',
		fieldLabel: 'Keterangan Kuitansi',
		maxLength: 250,
		anchor: '95%'
	});
	
	rproduk_nobuktijualField.on('select', function(){
		var j=cbo_retur_produk_DataStore.findExact('retur_produk_value',rproduk_nobuktijualField.getValue(),0);
		if(cbo_retur_produk_DataStore.getCount()){
			rproduk_custField.setValue(cbo_retur_produk_DataStore.getAt(j).data.retur_produk_nama_customer);
			rproduk_custidField.setValue(cbo_retur_produk_DataStore.getAt(j).data.retur_produk_customer_id);
			cbo_drproduk_produkDataStore.load({params: {query: rproduk_nobuktijualField.getValue()}});
		}
	});
	
  	/*Fieldset Master*/
	master_retur_jual_produk_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rproduk_nobuktiField, rproduk_nobuktijualField, rproduk_custField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rproduk_tanggalField, rproduk_keteranganField, rproduk_statusField, rproduk_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_retur_jual_produk_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'drproduk_id', type: 'int', mapping: 'drproduk_id'}, 
			{name: 'drproduk_master', type: 'int', mapping: 'drproduk_master'}, 
			{name: 'drproduk_produk', type: 'int', mapping: 'drproduk_produk'}, 
			{name: 'drproduk_satuan', type: 'int', mapping: 'drproduk_satuan'}, 
			//{name: 'drproduk_satuan', type: 'string', mapping: 'satuan_nama'}, 
			{name: 'drproduk_jumlah', type: 'int', mapping: 'drproduk_jumlah'}, 
			{name: 'drproduk_harga', type: 'float', mapping: 'drproduk_harga'} 
	]);
	//eof
	
	//function for json writer of detail
	var detail_retur_jual_produk_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_retur_jual_produk_DataStore = new Ext.data.Store({
		id: 'detail_retur_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=detail_detail_retur_jual_produk_list', 
			method: 'POST'
		}),
		reader: detail_retur_jual_produk_reader,
		baseParams:{master_id: rproduk_idField.getValue()},
		sortInfo:{field: 'drproduk_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_retur_jual_produk= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	cbo_drproduk_produkDataStore = new Ext.data.Store({
		id: 'cbo_drproduk_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=get_produk_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'drproduk_produk_value', type: 'int', mapping: 'produk_id'},
			{name: 'drproduk_produk_harga', type: 'float', mapping: 'retur_produk_harga'},
			//{name: 'drproduk_produk_satuan', type: 'string', mapping: 'satuan_kode'},
			{name: 'drproduk_produk_satuan', type: 'int', mapping: 'satuan_id'},
			{name: 'drproduk_produk_display', type: 'string', mapping: 'produk_nama'}
		]),
		sortInfo:{field: 'drproduk_produk_display', direction: "ASC"}
	});
	var produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{drproduk_produk_kode}| <b>{drproduk_produk_display}</b>',
		'</div></tpl>'
    );
	
	
	cbo_drproduk_satuanDataStore = new Ext.data.Store({
		id: 'cbo_drproduk_satuanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_produk&m=get_satuan_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
			{name: 'drproduk_satuan_value', type: 'int', mapping: 'satuan_id'},
			{name: 'drproduk_satuan_display', type: 'string', mapping: 'satuan_kode'}
		]),
		sortInfo:{field: 'drproduk_satuan_display', direction: "ASC"}
	});
	var combo_retur_produk=new Ext.form.ComboBox({
			store: cbo_drproduk_produkDataStore,
			mode: 'local',
			displayField: 'drproduk_produk_display',
			valueField: 'drproduk_produk_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: produk_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var combo_retur_satuan=new Ext.form.ComboBox({
			store: cbo_drproduk_satuanDataStore,
			mode: 'local',
			displayField: 'drproduk_satuan_display',
			valueField: 'drproduk_satuan_value',
			typeAhead: false,
			hideTrigger:false,
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var drproduk_jumlahField= new Ext.form.NumberField({
		allowDecimals: false,
		allowNegative: false,
		blankText: '0',
		maxLength: 3,
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	drproduk_jumlahField.on('keyup', function(){
		var sub_total = 0;
		sub_total = drproduk_jumlahField.getValue()*drproduk_hargaField.getValue();
		drproduk_subtotalField.setValue(sub_total);
	});
	
	var drproduk_hargaField= new Ext.form.NumberField({
		allowDecimals: false,
		allowNegative: false,
		blankText: '0',
		readOnly: true,
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	var drproduk_subtotalField= new Ext.form.NumberField({
		allowDecimals: false,
		allowNegative: false,
		blankText: '0',
		readOnly: true,
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	//declaration of detail coloumn model
	detail_retur_jual_produk_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Produk' + '</div>',
			dataIndex: 'drproduk_produk',
			width: 200,
			sortable: true,
			editor: combo_retur_produk,
			renderer: Ext.util.Format.comboRenderer(combo_retur_produk)
		},
		{
			header: '<div align="center">' + 'Satuan' + '</div>',
			dataIndex: 'drproduk_satuan',
			width: 80,
			sortable: true,
			readOnly: true,
			//editor: combo_retur_satuan,
			renderer: Ext.util.Format.comboRenderer(combo_retur_satuan)
		},
		{
			header: '<div align="center">' + 'Jumlah' + '</div>',
			align: 'right',
			dataIndex: 'drproduk_jumlah',
			width: 60,
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
			header: '<div align="center">' + 'Harga (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'drproduk_harga',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},
		{
			header: '<div align="center">' + 'Sub Total (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'drproduk_subtotal',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
				return Ext.util.Format.number(record.data.drproduk_jumlah*record.data.drproduk_harga,'0,000');
			}
		}]
	);
	detail_retur_jual_produk_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	detail_retur_jual_produkListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_retur_jual_produkListEditorGrid',
		el: 'fp_detail_retur_jual_produk',
		title: 'Detail detail_retur_jual_produk',
		height: 250,
		width: 690,
		autoScroll: true,
		store: detail_retur_jual_produk_DataStore, // DataStore
		colModel: detail_retur_jual_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_retur_jual_produk],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_retur_jual_produk_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_retur_jual_produk_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_retur_jual_produk_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function detail_retur_jual_produk_add(){
		var edit_detail_retur_jual_produk= new detail_retur_jual_produkListEditorGrid.store.recordType({
			drproduk_id	:'',		
			drproduk_master	:'',		
			drproduk_produk	:'',		
			drproduk_jumlah	:'',		
			drproduk_harga	:''		
		});
		editor_detail_retur_jual_produk.stopEditing();
		detail_retur_jual_produk_DataStore.insert(0, edit_detail_retur_jual_produk);
		detail_retur_jual_produkListEditorGrid.getView().refresh();
		detail_retur_jual_produkListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_retur_jual_produk.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_retur_jual_produk(){
		var sum_subtotal_detail=0;
		//detail_retur_jual_produk_DataStore.commitChanges();
		detail_retur_jual_produkListEditorGrid.getView().refresh();
		detail_retur_produk_record=detail_retur_jual_produk_DataStore.getAt(0);
		if(detail_retur_jual_produk_DataStore.getCount()>=0){
			var dproduk = cbo_drproduk_produkDataStore.findExact('drproduk_produk_value',detail_retur_produk_record.data.drproduk_produk,0);
			if(dproduk>=0){
				detail_retur_produk_record.data.drproduk_satuan=cbo_drproduk_produkDataStore.getAt(dproduk).data.drproduk_produk_satuan;
				detail_retur_produk_record.data.drproduk_harga=cbo_drproduk_produkDataStore.getAt(dproduk).data.drproduk_produk_harga;
				
				for(i=0;i<detail_retur_jual_produk_DataStore.getCount();i++){
					sum_subtotal_detail+=(detail_retur_jual_produk_DataStore.getAt(i).data.drproduk_jumlah*cbo_drproduk_produkDataStore.getAt(dproduk).data.drproduk_produk_harga);
					rproduk_kwitansi_nilaiField.setValue(sum_subtotal_detail);
				}
			}
		}
	}
	//eof
	
	//function for insert detail
	function detail_retur_jual_produk_insert(){
		for(i=0;i<detail_retur_jual_produk_DataStore.getCount();i++){
			detail_retur_jual_produk_record=detail_retur_jual_produk_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Mohon  Tunggu...',
				url: 'index.php?c=c_master_retur_jual_produk&m=detail_detail_retur_jual_produk_insert',
				params:{
				drproduk_id	: detail_retur_jual_produk_record.data.drproduk_id, 
				drproduk_master	: eval(rproduk_idField.getValue()), 
				drproduk_produk	: detail_retur_jual_produk_record.data.drproduk_produk, 
				drproduk_satuan	: detail_retur_jual_produk_record.data.drproduk_satuan, 
				drproduk_jumlah	: detail_retur_jual_produk_record.data.drproduk_jumlah, 
				drproduk_harga	: detail_retur_jual_produk_record.data.drproduk_harga 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function detail_retur_jual_produk_purge(){
		Ext.Ajax.request({
			waitMsg: 'Mohon  Tunggu...',
			url: 'index.php?c=c_master_retur_jual_produk&m=detail_detail_retur_jual_produk_purge',
			params:{ master_id: eval(rproduk_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_retur_jual_produk_confirm_delete(){
		// only one record is selected here
		if(detail_retur_jual_produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_retur_jual_produk_delete);
		} else if(detail_retur_jual_produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_retur_jual_produk_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih data yang akan dihapus?',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
	//eof
	
	//function for Delete of detail
	function detail_retur_jual_produk_delete(btn){
		if(btn=='yes'){
			var s = detail_retur_jual_produkListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_retur_jual_produk_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	detail_retur_jual_produk_DataStore.on('update', refresh_detail_retur_jual_produk);
	
	kwitansi_tercetakGroup = new Ext.form.FieldSet({
		title: 'Kuitansi Tercetak',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rproduk_kwitansi_nilaiField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rproduk_kwitansi_keteranganField] 
			}
			]
	
	});
	
	/* Function for retrieve create Window Panel*/ 
	master_retur_jual_produk_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [master_retur_jual_produk_masterGroup,detail_retur_jual_produkListEditorGrid, kwitansi_tercetakGroup]
		,
		buttons: [{
				//text: 'Cetak Kuitansi',
				text: 'Save and Close',
				handler: master_retur_jual_produk_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_retur_jual_produk_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_retur_jual_produk_createWindow= new Ext.Window({
		id: 'master_retur_jual_produk_createWindow',
		title: post2db+'Retur Penjualan Produk',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_retur_jual_produk_create',
		items: master_retur_jual_produk_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function master_retur_jual_produk_list_search(){
		// render according to a SQL date format.
		var rproduk_id_search=null;
		var rproduk_nobukti_search=null;
		var rproduk_nobuktijual_search=null;
		var rproduk_cust_search=null;
		var rproduk_tanggal_search_date="";
		var rproduk_keterangan_search=null;
		var rproduk_status_search=null;

		if(rproduk_idSearchField.getValue()!==null){rproduk_id_search=rproduk_idSearchField.getValue();}
		if(rproduk_nobuktiSearchField.getValue()!==null){rproduk_nobukti_search=rproduk_nobuktiSearchField.getValue();}
		if(rproduk_nobuktijualSearchField.getValue()!==null){rproduk_nobuktijual_search=rproduk_nobuktijualSearchField.getValue();}
		if(rproduk_custSearchField.getValue()!==null){rproduk_cust_search=rproduk_custSearchField.getValue();}
		if(rproduk_tanggalSearchField.getValue()!==""){rproduk_tanggal_search_date=rproduk_tanggalSearchField.getValue().format('Y-m-d');}
		if(rproduk_keteranganSearchField.getValue()!==null){rproduk_keterangan_search=rproduk_keteranganSearchField.getValue();}
		if(rproduk_statusSearchField.getValue()!==null){rproduk_status_search=rproduk_statusSearchField.getValue();}
		// change the store parameters
		master_retur_jual_produk_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			rproduk_id	:	rproduk_id_search, 
			rproduk_nobukti	:	rproduk_nobukti_search, 
			rproduk_nobuktijual	:	rproduk_nobuktijual_search, 
			rproduk_cust	:	rproduk_cust_search, 
			rproduk_tanggal	:	rproduk_tanggal_search_date, 
			rproduk_keterangan	:	rproduk_keterangan_search,
			rproduk_status		:	rproduk_status_search,
		};
		// Cause the datastore to do another query : 
		master_retur_jual_produk_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_retur_jual_produk_reset_search(){
		// reset the store parameters
		master_retur_jual_produk_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_retur_jual_produk_DataStore.reload({params: {start: 0, limit: pageS}});
		master_retur_jual_produk_searchWindow.close();
	};
	/* End of Fuction */
	
	function master_retur_jual_reset_SearchForm(){
		rproduk_nobuktiSearchField.reset();
		rproduk_nobuktijualSearchField.reset();
		rproduk_custSearchField.reset();
		rproduk_tanggalSearchField.reset();
		rproduk_keteranganSearchField.reset();
		rproduk_statusSearchField.reset();
	}
	
	
	/* Field for search */
	/* Identify  rproduk_id Search Field */
	rproduk_idSearchField= new Ext.form.NumberField({
		id: 'rproduk_idSearchField',
		fieldLabel: 'Rproduk Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  rproduk_nobukti Search Field */
	rproduk_nobuktiSearchField= new Ext.form.TextField({
		id: 'rproduk_nobuktiSearchField',
		fieldLabel: 'No Faktur',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  rproduk_nobuktijual Search Field */
	rproduk_nobuktijualSearchField= new Ext.form.TextField({
		id: 'rproduk_nobuktijualSearchField',
		fieldLabel: 'No Faktur Jual',
		maxLength: 100,
		anchor: '95%'
	
	});
	
	/* Identify  rproduk_cust Search Field */
	rproduk_custSearchField= new Ext.form.ComboBox({
		fieldLabel: 'Customer',
		store: cbo_rproduk_customerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_nama',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
		tpl: customer_rproduk_tpl,
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		disabled:false,
		anchor: '95%'
	});
	
	
	
	/* Identify  rproduk_tanggal Search Field */
	rproduk_tanggalSearchField= new Ext.form.DateField({
		id: 'rproduk_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y',
	
	});
	/* Identify  rproduk_keterangan Search Field */
	rproduk_keteranganSearchField= new Ext.form.TextArea({
		id: 'rproduk_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	rproduk_tanggal_akhirSearchField= new Ext.form.DateField({
		id: 'rproduk_tanggal_akhirSearchField',
		fieldLabel: 's/d',
		format : 'd-m-Y'
	});
	
	rproduk_label_tanggalField= new Ext.form.Label({ html: ' &nbsp; s/d  &nbsp;' });
    
	
	rproduk_tanggalSearchFieldSet=new Ext.form.FieldSet({
		id:'rproduk_tanggalSearchFieldSet',
		title: 'Opsi Tanggal',
		layout: 'column',
		boduStyle: 'padding: 5px;',
		frame: false,
		items:[rproduk_tanggalSearchField, rproduk_label_tanggalField, rproduk_tanggal_akhirSearchField]
	});
	
	
	rproduk_statusSearchField= new Ext.form.ComboBox({
		id: 'rproduk_statusSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'rproduk_status'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup'],['Batal','Batal']]
		}),
		mode: 'local',
		displayField: 'rproduk_status',
		valueField: 'value',
		anchor: '80%',
		triggerAction: 'all'	 
	
	});
	

	/* Function for retrieve search Form Panel */
	master_retur_jual_produk_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
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
				items: [rproduk_nobuktiSearchField, rproduk_nobuktijualSearchField, rproduk_custSearchField, rproduk_tanggalSearchFieldSet, rproduk_keteranganSearchField, rproduk_statusSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_retur_jual_produk_list_search
			},{
				text: 'Close',
				handler: function(){
					master_retur_jual_produk_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_retur_jual_produk_searchWindow = new Ext.Window({
		title: 'Pencarian Retur Penjualan Produk',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_retur_jual_produk_search',
		items: master_retur_jual_produk_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_retur_jual_produk_searchWindow.isVisible()){
			master_retur_jual_reset_SearchForm();
			master_retur_jual_produk_searchWindow.show();
		} else {
			master_retur_jual_produk_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_retur_jual_produk_print(){
		var searchquery = "";
		var rproduk_nobukti_print=null;
		var rproduk_nobuktijual_print=null;
		var rproduk_cust_print=null;
		var rproduk_tanggal_print_date="";
		var rproduk_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_retur_jual_produk_DataStore.baseParams.query!==null){searchquery = master_retur_jual_produk_DataStore.baseParams.query;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_nobukti!==null){rproduk_nobukti_print = master_retur_jual_produk_DataStore.baseParams.rproduk_nobukti;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_nobuktijual!==null){rproduk_nobuktijual_print = master_retur_jual_produk_DataStore.baseParams.rproduk_nobuktijual;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_cust!==null){rproduk_cust_print = master_retur_jual_produk_DataStore.baseParams.rproduk_cust;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_tanggal!==""){rproduk_tanggal_print_date = master_retur_jual_produk_DataStore.baseParams.rproduk_tanggal;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_keterangan!==null){rproduk_keterangan_print = master_retur_jual_produk_DataStore.baseParams.rproduk_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon  Tunggu...',
		url: 'index.php?c=c_master_retur_jual_produk&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			rproduk_nobukti : rproduk_nobukti_print,
			rproduk_nobuktijual : rproduk_nobuktijual_print,
			rproduk_cust : rproduk_cust_print,
		  	rproduk_tanggal : rproduk_tanggal_print_date, 
			rproduk_keterangan : rproduk_keterangan_print,
		  	currentlisting: master_retur_jual_produk_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_retur_jual_produklist.html','master_retur_jual_produklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_retur_jual_produk_export_excel(){
		var searchquery = "";
		var rproduk_nobukti_2excel=null;
		var rproduk_nobuktijual_2excel=null;
		var rproduk_cust_2excel=null;
		var rproduk_tanggal_2excel_date="";
		var rproduk_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_retur_jual_produk_DataStore.baseParams.query!==null){searchquery = master_retur_jual_produk_DataStore.baseParams.query;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_nobukti!==null){rproduk_nobukti_2excel = master_retur_jual_produk_DataStore.baseParams.rproduk_nobukti;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_nobuktijual!==null){rproduk_nobuktijual_2excel = master_retur_jual_produk_DataStore.baseParams.rproduk_nobuktijual;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_cust!==null){rproduk_cust_2excel = master_retur_jual_produk_DataStore.baseParams.rproduk_cust;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_tanggal!==""){rproduk_tanggal_2excel_date = master_retur_jual_produk_DataStore.baseParams.rproduk_tanggal;}
		if(master_retur_jual_produk_DataStore.baseParams.rproduk_keterangan!==null){rproduk_keterangan_2excel = master_retur_jual_produk_DataStore.baseParams.rproduk_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon  Tunggu...',
		url: 'index.php?c=c_master_retur_jual_produk&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			rproduk_nobukti : rproduk_nobukti_2excel,
			rproduk_nobuktijual : rproduk_nobuktijual_2excel,
			rproduk_cust : rproduk_cust_2excel,
		  	rproduk_tanggal : rproduk_tanggal_2excel_date, 
			rproduk_keterangan : rproduk_keterangan_2excel,
		  	currentlisting: master_retur_jual_produk_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_retur_jual_produk"></div>
         <div id="fp_detail_retur_jual_produk"></div>
		<div id="elwindow_master_retur_jual_produk_create"></div>
        <div id="elwindow_master_retur_jual_produk_search"></div>
    </div>
</div>
</body>