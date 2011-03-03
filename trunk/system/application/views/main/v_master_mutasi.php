<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_mutasi View
	+ Description	: For record view
	+ Filename 		: v_master_mutasi.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:45:23
	
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
var master_mutasi_DataStore;
var master_mutasi_ColumnModel;
var master_mutasiListEditorGrid;
var master_mutasi_createForm;
var master_mutasi_createWindow;
var master_mutasi_searchForm;
var master_mutasi_searchWindow;
var master_mutasi_SelectedRow;
var master_mutasi_ContextMenu;
//for detail data
var detail_mutasi_DataStore;
var detail_mutasiListEditorGrid;
var detail_mutasi_ColumnModel;
var detail_mutasi_proxy;
var detail_mutasi_writer;
var detail_mutasi_reader;
var editor_detail_mutasi;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var today=new Date().format('Y-m-d');
var cetak=0;

/* declare variable here for Field*/
var mutasi_idField;
var mutasi_noField;
var mutasi_asalField;
var mutasi_tujuanField;
var mutasi_tanggalField;
var mutasi_keteranganField;
var mutasi_idSearchField;
var mutasi_asalSearchField;
var mutasi_tujuanSearchField;
var mutasi_tanggalSearchField;
var mutasi_keteranganSearchField;
var mutasi_statusSearchField;

var mutasi_button_saveField;
var mutasi_button_saveprintField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
	/*Function for pengecekan _dokumen untuk save n print */		
	function pengecekan_dokumen(){
		var mutasi_tanggal_create_date = "";
		if(mutasi_tanggalField.getValue()!== ""){mutasi_tanggal_create_date = mutasi_tanggalField.getValue().format('Y-m-d');} 
		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_mutasi&m=get_action',
			params: {
				task: "CEK",
				tanggal_pengecekan	: mutasi_tanggal_create_date	
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
						case 1:
							cetak=1;
							master_mutasi_create('print');
						break;
						default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data Penerimaan Barang tidak bisa disimpan, karena telah melebihi batas hari yang diperbolehkan ',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING,
						  // master_mutasi_create('print')
						});
						//jproduk_btn_cancel();
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
	
	/*Function for pengecekan _dokumen untuk save*/
	function pengecekan_dokumen2(){
		var mutasi_tanggal_create_date = "";
		if(mutasi_tanggalField.getValue()!== ""){mutasi_tanggal_create_date = mutasi_tanggalField.getValue().format('Y-m-d');} 
		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_mutasi&m=get_action',
			params: {
				task: "CEK",
				tanggal_pengecekan	: mutasi_tanggal_create_date
		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
						case 1:
							master_mutasi_create();
						break;
						default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data Penerimaan Barang tidak bisa disimpan, karena telah melebihi batas hari yang diperbolehkan ',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING,
						  // master_mutasi_create('print')
						});
						//jproduk_btn_cancel();
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
  
   	/* Function for add data, open window create form */
	function master_mutasi_create(opsi){
	
		if(detail_mutasi_DataStore.getCount()<1){
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Data detail harus ada minimal 1 (satu)',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}else if(is_master_mutasi_form_valid()){	
		
		var mutasi_id_create_pk=null; 
		var mutasi_no_create=null;
		var mutasi_asal_create=null; 
		var mutasi_tujuan_create=null; 
		var mutasi_tanggal_create_date=""; 
		var mutasi_keterangan_create=null;
		var mutasi_status_create=null;

		mutasi_id_create_pk=get_pk_id();
		if(mutasi_asalField.getValue()!== null){mutasi_asal_create = mutasi_asalField.getValue();} 
		if(mutasi_noField.getValue()!== null){mutasi_no_create = mutasi_noField.getValue();} 
		if(mutasi_tujuanField.getValue()!== null){mutasi_tujuan_create = mutasi_tujuanField.getValue();} 
		if(mutasi_tanggalField.getValue()!== ""){mutasi_tanggal_create_date = mutasi_tanggalField.getValue().format('Y-m-d');} 
		if(mutasi_keteranganField.getValue()!== null){mutasi_keterangan_create = mutasi_keteranganField.getValue();} 
		if(mutasi_statusField.getValue()!== null){mutasi_status_create = mutasi_statusField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_mutasi&m=get_action',
			params: {
				task				: post2db,
				mutasi_id			: mutasi_id_create_pk, 
				mutasi_no			: mutasi_no_create,
				mutasi_asal			: mutasi_asal_create, 
				mutasi_tujuan		: mutasi_tujuan_create, 
				mutasi_tanggal		: mutasi_tanggal_create_date, 
				mutasi_keterangan	: mutasi_keterangan_create,
				mutasi_status		: mutasi_status_create,
				cetak				: cetak
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				if(result!==0){
						detail_mutasi_insert(result,opsi);
						Ext.MessageBox.alert(post2db+' OK','Data Mutasi Barang berhasil disimpan');
						master_mutasi_createWindow.hide();
				}else{
						Ext.MessageBox.show({
						   title: 'Warning',
						   //msg: 'We could\'t not '+msg+' the Master_order_beli.',
						   msg: 'Data Mutasi Barang tidak bisa disimpan',
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
					   msg: 'Tidak bisa terhubung dengan database server',
					   buttons: Ext.MessageBox.OK,
					   animEl: 'database',
					   icon: Ext.MessageBox.ERROR
				});	
			}                      
		});
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Form anda belum valid',
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
			return master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_id');
		else if(post2db=='CREATE')
			return mutasi_idField.getValue();
		else 
			return 0;
	}
	/* End of Function  */
	
	function get_asal_id(){
		if(isNaN(parseInt(mutasi_asalField.getValue())) || parseInt(mutasi_asalField.getValue())==0)
		{
			return master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_asal_id');
		}else{
			return mutasi_asalField.getValue();
		}
	}
	
	function get_tujuan_id(){
		if(isNaN(parseInt(mutasi_tujuanField.getValue())) || parseInt(mutasi_tujuanField.getValue())==0)
		{
			return master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_tujuan_id');
		}else{
			return mutasi_tujuanField.getValue();
		}
	}
	
	/* Reset form before loading */
	function master_mutasi_reset_form(){
		mutasi_idField.reset();
		mutasi_idField.setValue(null);
		mutasi_noField.reset();
		mutasi_noField.setValue('(Auto)');
		mutasi_asalField.reset();
		mutasi_asalField.setValue(null);
		mutasi_tujuanField.reset();
		mutasi_tujuanField.setValue(null);
		mutasi_tanggalField.reset();
		mutasi_tanggalField.setValue(today);
		mutasi_keteranganField.reset();
		mutasi_keteranganField.setValue(null);
		mutasi_statusField.reset();
		mutasi_statusField.setValue('Terbuka');
		
		cbo_mutasi_satuanDataStore.setBaseParam('task','detail');
		cbo_mutasi_satuanDataStore.setBaseParam('master_id',get_pk_id());
		cbo_mutasi_satuanDataStore.load();
		
		cbo_mutasi_produkDataStore.setBaseParam('master_id',get_pk_id());
		cbo_mutasi_produkDataStore.setBaseParam('task','detail');
		cbo_mutasi_produkDataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_mutasi_DataStore.setBaseParam('master_id',-1);
					detail_mutasi_DataStore.load();
				}
			}
		});
		master_mutasi_createForm.mmutasi_savePrint.enable();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_mutasi_set_form(){
		mutasi_idField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_id'));
		mutasi_noField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_no'));
		mutasi_asalField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_asal'));
		mutasi_tujuanField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_tujuan'));
		mutasi_tanggalField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_tanggal'));
		mutasi_keteranganField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_keterangan'));
		mutasi_statusField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_status'));
		
		//LOAD OF DETAIL
		cbo_mutasi_satuanDataStore.setBaseParam('task','detail');
		cbo_mutasi_satuanDataStore.setBaseParam('master_id',get_pk_id());
		cbo_mutasi_satuanDataStore.load();
		
		cbo_mutasi_produkDataStore.setBaseParam('master_id',get_pk_id());
		cbo_mutasi_produkDataStore.setBaseParam('task','detail');
		cbo_mutasi_produkDataStore.setBaseParam('gudang',master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_asal_id'));
		
		mutasi_button_saveField.setDisabled(true);
		mutasi_button_saveprintField.setDisabled(true);

		cbo_mutasi_produkDataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_mutasi_DataStore.setBaseParam('master_id',get_pk_id());
					detail_mutasi_DataStore.load({
						callback: function(r,opt,success){
							if(success==true){
								mutasi_button_saveField.setDisabled(false);
								mutasi_button_saveprintField.setDisabled(false);
							}
						}
					});
				}
			}
		});
		// END OF DETAIL
		
		
		if(post2db=="UPDATE" && master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_status')=="Terbuka"){
			mutasi_idField.setDisabled(false);
			mutasi_noField.setDisabled(false);
			mutasi_asalField.setDisabled(false);
			mutasi_tujuanField.setDisabled(false);
			mutasi_tanggalField.setDisabled(false);
			mutasi_keteranganField.setDisabled(false);
			mutasi_statusField.setDisabled(false);
			master_mutasi_createForm.mmutasi_savePrint.enable();
		}
		if(post2db=="UPDATE" && master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_status')=="Tertutup"){
			mutasi_idField.setDisabled(true);
			mutasi_noField.setDisabled(true);
			mutasi_asalField.setDisabled(true);
			mutasi_tujuanField.setDisabled(true);
			mutasi_tanggalField.setDisabled(true);
			mutasi_keteranganField.setDisabled(true);
			mutasi_statusField.setDisabled(false);
			if(cetak==1){
					//jproduk_cetak(jproduk_id_for_cetak);
				cetak=0;
			}
			
		}
		if(post2db=="UPDATE" && master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_status')=="Batal"){
			mutasi_idField.setDisabled(true);
			mutasi_noField.setDisabled(true);
			mutasi_asalField.setDisabled(true);
			mutasi_tujuanField.setDisabled(true);
			mutasi_tanggalField.setDisabled(true);
			mutasi_keteranganField.setDisabled(true);
			mutasi_statusField.setDisabled(true);
			master_mutasi_createForm.mmutasi_savePrint.disable();
		}
		
		
		mutasi_statusField.on("select",function(){
		var status_awal = master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_status');
		if(status_awal =='Terbuka' && mutasi_statusField.getValue()=='Tertutup')
		{
		Ext.MessageBox.show({
			msg: 'Dokumen tidak bisa ditutup. Gunakan Save & Print untuk menutup dokumen',
			buttons: Ext.MessageBox.OK,
			animEl: 'save',
			icon: Ext.MessageBox.WARNING
		   });
		mutasi_statusField.setValue('Terbuka');
		}
		
		else if(status_awal =='Tertutup' && mutasi_statusField.getValue()=='Terbuka')
		{
		Ext.MessageBox.show({
			msg: 'Status yang sudah Tertutup tidak dapat diganti Terbuka',
			buttons: Ext.MessageBox.OK,
			animEl: 'save',
			icon: Ext.MessageBox.WARNING
		   });
		mutasi_statusField.setValue('Tertutup');
		}
		
		else if(status_awal =='Batal' && mutasi_statusField.getValue()=='Terbuka')
		{
		Ext.MessageBox.show({
			msg: 'Status yang sudah Tertutup tidak dapat diganti Terbuka',
			buttons: Ext.MessageBox.OK,
			animEl: 'save',
			icon: Ext.MessageBox.WARNING
		   });
		mutasi_statusField.setValue('Tertutup');
		}
		
		else if(mutasi_statusField.getValue()=='Batal')
		{
		Ext.MessageBox.confirm('Confirmation','Anda yakin untuk membatalkan dokumen ini? Pembatalan dokumen tidak bisa dikembalikan lagi', mutasi_status_batal);
		}
        
       else if(status_awal =='Tertutup' && mutasi_statusField.getValue()=='Tertutup'){
            <?php if(eregi('U|C',$this->m_security->get_access_group_by_kode('MENU_TERIMA'))){ ?>
			master_mutasi_createForm.tbeli_savePrint.enable();
			<?php } ?>
        }
		
		});	
		
		
		
	}
	/* End setValue to EDIT*/
	
	function mutasi_status_batal(btn){
	if(btn=='yes')
	{
		mutasi_statusField.setValue('Batal');
		<?php if(eregi('U|C',$this->m_security->get_access_group_by_kode('MENU_MUTASI'))){ ?>
        master_mutasi_createForm.mmutasi_savePrint.disable();
		<?php } ?>
	}  
	else
		mutasi_statusField.setValue(master_mutasiListEditorGrid.getSelectionModel().getSelected().get('mutasi_status'));
	}
  
	/* Function for Check if the form is valid */
	function is_master_mutasi_form_valid(){
		return ( mutasi_asalField.isValid() && mutasi_tujuanField.isValid() && mutasi_asalField.getValue()!==mutasi_tujuanField.getValue() );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_mutasi_createWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			master_mutasi_reset_form();
			master_mutasi_createWindow.show();
		} else {
			master_mutasi_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_mutasi_confirm_delete(){
		// only one master_mutasi is selected here
		if(master_mutasiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_mutasi_delete);
		} else if(master_mutasiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_mutasi_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih data yang akan dihapus',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
	/* Function for Update Confirm */
	function master_mutasi_confirm_update(){
		/* only one record is selected here */
		if(master_mutasiListEditorGrid.selModel.getCount() == 1) {
			post2db='UPDATE';
			msg='updated';
			master_mutasi_set_form();
			master_mutasi_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih datang yang akan diubah',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function master_mutasi_delete(btn){
		if(btn=='yes'){
			var selections = master_mutasiListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_mutasiListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.mutasi_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_mutasi&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_mutasi_DataStore.reload();
							break;
						default:
							Ext.MessageBox.show({
								title: 'Warning',
								msg: 'Tidak bisa menghapus data yang diplih',
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
					   msg: 'Tidak bisa terhubung dengan database server',
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
	master_mutasi_DataStore = new Ext.data.Store({
		id: 'master_mutasi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start: 0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'mutasi_id'
		},[
			{name: 'mutasi_id', type: 'int', mapping: 'mutasi_id'}, 
			{name: 'mutasi_no', type: 'string', mapping: 'mutasi_no'}, 
			{name: 'mutasi_asal', type: 'string', mapping: 'gudang_asal_nama'}, 
			{name: 'mutasi_asal_id', type: 'int', mapping: 'mutasi_asal'}, 
			{name: 'mutasi_tujuan', type: 'string', mapping: 'gudang_tujuan_nama'},
			{name: 'mutasi_tujuan_id', type: 'string', mapping: 'mutasi_tujuan'},
			{name: 'mutasi_jumlah', type: 'float', mapping: 'jumlah_barang'}, 
			{name: 'mutasi_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'mutasi_tanggal'}, 
			{name: 'mutasi_keterangan', type: 'string', mapping: 'mutasi_keterangan'}, 
			{name: 'mutasi_status', type: 'string', mapping: 'mutasi_status'}, 
			{name: 'mutasi_creator', type: 'string', mapping: 'mutasi_creator'}, 
			{name: 'mutasi_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'mutasi_date_create'}, 
			{name: 'mutasi_update', type: 'string', mapping: 'mutasi_update'}, 
			{name: 'mutasi_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'mutasi_date_update'}, 
			{name: 'mutasi_revised', type: 'int', mapping: 'mutasi_revised'} 
		]),
		sortInfo:{field: 'mutasi_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Supplier DataStore */
	cbo_mutasi_gudang_DataSore = new Ext.data.Store({
		id: 'cbo_mutasi_gudang_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_gudang_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'gudang_id'
		},[
			{name: 'mutasi_gudang_value', type: 'int', mapping: 'gudang_id'},
			{name: 'mutasi_gudang_nama', type: 'string', mapping: 'gudang_nama'}
		]),
		sortInfo:{field: 'mutasi_gudang_nama', direction: "ASC"}
	});
    
  	/* Function for Identify of Window Column Model */
	master_mutasi_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'No MB' + '</div>',
			dataIndex: 'mutasi_no',
			width: 60,	//150,
			sortable: true,
			readOnly: true
		}, 
		
		{
			header: '<div align="center">Tanggal</div>',
			dataIndex: 'mutasi_tanggal',
			width: 60,	//150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			readOnly: true
		},
		{
			header: '<div align="center">Gudang Asal</div>',
			dataIndex: 'mutasi_asal',
			width: 120,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">Gudang Tujuan</div>',
			dataIndex: 'mutasi_tujuan',
			width: 120,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">Jml Barang</div>',
			dataIndex: 'mutasi_jumlah',
			width: 60,
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">Keterangan</div>',
			dataIndex: 'mutasi_keterangan',
			width: 200,	//150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Stat Dok' + '</div>',
			dataIndex: 'mutasi_status',
			width: 60,
			readOnly: true
		}, 
		{
			header: 'Creator',
			dataIndex: 'mutasi_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Create on',
			dataIndex: 'mutasi_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'mutasi_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'last Update on',
			dataIndex: 'mutasi_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Revised',
			dataIndex: 'mutasi_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}	]);
	
	master_mutasi_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_mutasiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'master_mutasiListEditorGrid',
		el: 'fp_master_mutasi',
		title: 'Daftar Mutasi Barang',
		autoHeight: true,
		store: master_mutasi_DataStore, // DataStore
		cm: master_mutasi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,	//700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_mutasi_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		<?php if(eregi('C',$this->m_security->get_access_group_by_kode('MENU_MUTASI'))){ ?>
		{
			text: 'Add',
			tooltip: 'Add new record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: display_form_window
		}, '-',
		<?php } ?>
		<?php if(eregi('U|R',$this->m_security->get_access_group_by_kode('MENU_MUTASI'))){ ?>
		{
			text: 'Edit',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: master_mutasi_confirm_update   // Confirm before updating
		}, '-',
		<?php } ?>
		<?php if(eregi('D',$this->m_security->get_access_group_by_kode('MENU_MUTASI'))){ ?>
		{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled : true,
			handler: master_mutasi_confirm_delete   // Confirm before deleting
		}, '-', 
		<?php } ?>
		{
			text: 'Adv Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_mutasi_DataStore,
			params: {start: 0, limit: pageS},
			listeners:{
/*				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						customer_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
*/				render: function(c){
				Ext.get(this.id).set({qtitle:'Simple search:'});
				Ext.get(this.id).set({qtip:'- No MB<br>- Gudang Asal<br>- Gudang Tujuan<br>- Keterangan'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_mutasi_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_mutasi_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_mutasi_print  
		}
		]
	});
	master_mutasiListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_mutasi_ContextMenu = new Ext.menu.Menu({
		id: 'master_mutasi_ListEditorGridContextMenu',
		items: [
		<?php if(eregi('U|R',$this->m_security->get_access_group_by_kode('MENU_MUTASI'))){ ?>
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_mutasi_confirm_update  
		},
		<?php } ?>
		<?php if(eregi('D',$this->m_security->get_access_group_by_kode('MENU_MUTASI'))){ ?>
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled : true,
			handler: master_mutasi_confirm_delete 
		},
		<?php } ?>
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_mutasi_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_mutasi_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_mutasi_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_mutasi_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_mutasi_SelectedRow=rowIndex;
		master_mutasi_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_mutasi_editContextMenu(){
		master_mutasi_confirm_update()
		//master_mutasiListEditorGrid.startEditing(master_mutasi_SelectedRow,1);
  	}
	/* End of Function */
  	
	
	/* Identify  mutasi_id Field */
	mutasi_idField= new Ext.form.NumberField({
		id: 'mutasi_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify mutasi_no Field*/
	mutasi_noField= new Ext.form.TextField({
		id: 'mutasi_noField',
		fieldLabel: 'No MB',
		emptyText: '(Auto)',
		readOnly: true,
		maxLength: 50,
		anchor: '95%'
	});
	
	/* Identify  mutasi_asal Field */
	mutasi_asalField= new Ext.form.ComboBox({
		id: 'mutasi_asalField',
		fieldLabel: 'Gudang Asal',
		store: cbo_mutasi_gudang_DataSore,
		mode : 'remote',
		forceSelection: true,
		displayField:'mutasi_gudang_nama',
		valueField: 'mutasi_gudang_value',
        typeAhead: false,
        hideTrigger:false,
		allowBlank: false,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  mutasi_tujuan Field */
	mutasi_tujuanField= new Ext.form.ComboBox({
		id: 'mutasi_tujuanField',
		fieldLabel: 'Gudang Tujuan',
		store: cbo_mutasi_gudang_DataSore,
		mode : 'remote',
		forceSelection: true,
		displayField:'mutasi_gudang_nama',
		valueField: 'mutasi_gudang_value',
        typeAhead: false,
        hideTrigger:false,
		allowBlank: false,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  mutasi_tanggal Field */
	mutasi_tanggalField= new Ext.form.DateField({
		id: 'mutasi_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	});
	/* Identify  mutasi_keterangan Field */
	mutasi_keteranganField= new Ext.form.TextArea({
		id: 'mutasi_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	
	/* Identify  order_bayar Field */
	mutasi_totaljumlahField= new Ext.form.TextField({
		id: 'mutasi_totaljumlahField',
		fieldLabel: 'Jumlah Total Barang',
		blankText: '0',
		valueRenderer: 'numberToCurrency',
		itemCls: 'rmoney',
		readOnly: true,
		anchor: '75%',
	});
	
	mutasi_button_saveField=new Ext.Button({
		text: 'Save and Close',
		handler: pengecekan_dokumen2
	});
	
	mutasi_button_saveprintField=new Ext.Button({
		text: 'Save and Print',
		ref: '../mmutasi_savePrint',
		handler: pengecekan_dokumen
	});


	mutasi_itemjumlahField= new Ext.form.TextField({
		id: 'mutasi_itemjumlahField',
		fieldLabel: 'Jumlah Jenis Barang',
		blankText: '0',
		valueRenderer: 'numberToCurrency',
		itemCls: 'rmoney',
		readOnly: true,
		anchor: '75%',
	});
	
	mutasi_statusField= new Ext.form.ComboBox({
		id: 'mutasi_statusField',
		fieldLabel: 'Status Dok',
		forceSelection: true,
		store:new Ext.data.SimpleStore({
			fields:['mutasi_status_value', 'mutasi_status_display'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup'],['Batal', 'Batal']]
		}),
		mode: 'local',
		displayField: 'mutasi_status_display',
		valueField: 'mutasi_status_value',
		anchor: '80%',
		allowBlank: false,
		triggerAction: 'all'	
	});
	
	
  	/*Fieldset Master*/
	master_mutasi_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [mutasi_noField, mutasi_asalField, mutasi_tujuanField, mutasi_idField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [mutasi_tanggalField, mutasi_keteranganField, mutasi_statusField] 
			}
			]
	
	});
	
	//master_mutasi_FootGroup
	master_mutasi_footGroup = new Ext.form.FieldSet({
		title: '-',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '100%',
		labelWidth: 150,
		items: [{
					layout: 'form',
					columnWidth: 0.5,
					border: false,
					items:[mutasi_totaljumlahField]
				},{ 
					layout: 'form',
					columnWidth: 0.5,
					border: false,
					items:[mutasi_itemjumlahField ]
				}] 
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_mutasi_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'dmutasi_id'
	},[
			{name: 'dmutasi_id', type: 'int', mapping: 'dmutasi_id'}, 
			{name: 'dmutasi_master', type: 'int', mapping: 'dmutasi_master'}, 
			{name: 'dmutasi_produk', type: 'int', mapping: 'dmutasi_produk'}, 
			{name: 'dmutasi_satuan', type: 'int', mapping: 'dmutasi_satuan'}, 
			{name: 'dmutasi_jumlah', type: 'int', mapping: 'dmutasi_jumlah'} 
	]);
	//eof
	
	//function for json writer of detail
	var detail_mutasi_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_mutasi_DataStore = new Ext.data.Store({
		id: 'detail_mutasi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=detail_detail_mutasi_list', 
			method: 'POST'
		}),
		reader: detail_mutasi_reader,
		baseParams:{master_id: 0, start: 0, limit: pageS},
		sortInfo:{field: 'dmutasi_produk', direction: "DESC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_mutasi= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	cbo_mutasi_produkDataStore = new Ext.data.Store({
		id: 'cbo_mutasi_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_produk_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: pageS, gudang: 0, task: 'list'},
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'mutasi_produk_id', type: 'int', mapping: 'produk_id'},
			{name: 'mutasi_produk_kode', type: 'string', mapping: 'produk_kode'},
			{name: 'mutasi_produk_nama', type: 'string', mapping: 'produk_nama'},
			{name: 'mutasi_satuan_nama', type: 'string', mapping: 'satuan_nama'},
			{name: 'mutasi_produk_stok', type: 'float', mapping: 'jumlah_stok'}
		]),
		sortInfo:{field: 'mutasi_produk_kode', direction: "ASC"}
	});
	
	cbo_mutasi_satuanDataStore = new Ext.data.Store({
		id: 'cbo_mutasi_satuanDataStore ',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_satuan_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
			{name: 'satuan_id', type: 'int', mapping: 'satuan_id'},
			{name: 'satuan_kode', type: 'string', mapping: 'satuan_kode'},
			{name: 'satuan_nama', type: 'string', mapping: 'satuan_nama'}
		]),
		sortInfo:{field: 'satuan_kode', direction: "ASC"}
	});
	
	var produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{mutasi_produk_nama} ({mutasi_produk_kode})</b><br /></span>',
            'stok: {mutasi_produk_stok} {mutasi_satuan_nama}',
        '</div></tpl>'
    );
	
	var combo_mutasi_produk=new Ext.form.ComboBox({
			store: cbo_mutasi_produkDataStore,
			mode: 'remote',
			displayField: 'mutasi_produk_nama',
			valueField: 'mutasi_produk_id',
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
	
	
	var combo_mutasi_satuan=new Ext.form.ComboBox({
			store: cbo_mutasi_satuanDataStore ,
			mode: 'remote',
			typeAhead: true,
			displayField: 'satuan_nama',
			valueField: 'satuan_id',
			triggerAction: 'all',
			lazyRender:true

	});
	
	//declaration of detail coloumn model
	detail_mutasi_ColumnModel = new Ext.grid.ColumnModel(
		[
		 {
			header: '<div align="center">ID</div>',
			dataIndex: 'dmutasi_id',
			width: 80,
			sortable: true,
			readOnly: true,
			hidden: true
		},
		{
			header: '<div align="center">Produk</div>',
			dataIndex: 'dmutasi_produk',
			width: 200,
			sortable: true,
			editor: combo_mutasi_produk,
			renderer: Ext.util.Format.comboRenderer(combo_mutasi_produk)
		},
		{
			header: '<div align="center">Satuan</div>',
			dataIndex: 'dmutasi_satuan',
			width: 80,
			sortable: true,
			editor: combo_mutasi_satuan,
			renderer: Ext.util.Format.comboRenderer(combo_mutasi_satuan)
		},
		{
			header: '<div align="center">Jumlah</div>',
			dataIndex: 'dmutasi_jumlah',
			width: 60,
			sortable: true,
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	detail_mutasi_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	detail_mutasiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_mutasiListEditorGrid',
		el: 'fp_detail_mutasi',
		title: 'Item Mutasi',
		height: 250,
		width: 800,	//690,
		autoScroll: true,
		store: detail_mutasi_DataStore, // DataStore
		colModel: detail_mutasi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_mutasi],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true}
		<?php if(eregi('U|C',$this->m_security->get_access_group_by_kode('MENU_MUTASI'))){ ?>
		,
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_mutasi_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_mutasi_confirm_delete
		}
		]
		<?php } ?>
	});
	//eof
	
	
	//function of detail add
	function detail_mutasi_add(){
		var edit_detail_mutasi= new detail_mutasiListEditorGrid.store.recordType({
			dmutasi_id		: 0,
			dmutasi_master	: null,		
			dmutasi_produk	: '',		
			dmutasi_satuan	: '',		
			dmutasi_jumlah	: 0		
		});
		editor_detail_mutasi.stopEditing();
		detail_mutasi_DataStore.insert(0, edit_detail_mutasi);
		//detail_mutasiListEditorGrid.getView().refresh();
		detail_mutasiListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_mutasi.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_mutasi(){
		detail_mutasi_DataStore.commitChanges();
		detail_mutasiListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_mutasi_insert(pkid, opsi){
		
		var dmutasi_id = [];
        var dmutasi_produk = [];
        var dmutasi_satuan = [];
        var dmutasi_jumlah = [];

		if(detail_mutasi_DataStore.getCount()>0){
			for(i=0; i<detail_mutasi_DataStore.getCount();i++){
				if((/^\d+$/.test(detail_mutasi_DataStore.getAt(i).data.dmutasi_produk))
				   && detail_mutasi_DataStore.getAt(i).data.dmutasi_produk!==undefined
				   && detail_mutasi_DataStore.getAt(i).data.dmutasi_produk!==''
				   && detail_mutasi_DataStore.getAt(i).data.dmutasi_produk!==0
				   && detail_mutasi_DataStore.getAt(i).data.dmutasi_satuan!==''
				   && detail_mutasi_DataStore.getAt(i).data.dmutasi_jumlah>0){
					
					dmutasi_id.push(detail_mutasi_DataStore.getAt(i).data.dmutasi_id);
					dmutasi_produk.push(detail_mutasi_DataStore.getAt(i).data.dmutasi_produk);
					dmutasi_satuan.push(detail_mutasi_DataStore.getAt(i).data.dmutasi_satuan);
					dmutasi_jumlah.push(detail_mutasi_DataStore.getAt(i).data.dmutasi_jumlah);
				}
			}
		}
		
		var encoded_array_dmutasi_id = Ext.encode(dmutasi_id);
		var encoded_array_dmutasi_produk = Ext.encode(dmutasi_produk);
		var encoded_array_dmutasi_satuan = Ext.encode(dmutasi_satuan);
		var encoded_array_dmutasi_jumlah = Ext.encode(dmutasi_jumlah);

		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_mutasi&m=detail_detail_mutasi_insert',
			params:{
			dmutasi_id		: encoded_array_dmutasi_id,
			dmutasi_master	: pkid, 
			dmutasi_produk	: encoded_array_dmutasi_produk, 
			dmutasi_satuan	: encoded_array_dmutasi_satuan, 
			dmutasi_jumlah	: encoded_array_dmutasi_jumlah
			},
			callback: function(opts, success, response){
				if(success){
						if(opsi=='print'){
							master_mutasi_print_faktur(pkid);
						}
						master_mutasi_DataStore.load();
				}
			}
		});

	}
	//eof
	
	//function for purge detail
	function detail_mutasi_purge(pkid){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_mutasi&m=detail_detail_mutasi_purge',
			params:{ master_id: pkid },
			success:function(response){
				detail_mutasi_insert(pkid);
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_mutasi_confirm_delete(){
		// only one record is selected here
		if(detail_mutasiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data berikut?', detail_mutasi_delete);
		} else if(detail_mutasiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data-data berikut?', detail_mutasi_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Tidak ada yang dipilih untuk dihapus',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
	//eof
	
	//function for Delete of detail
	function detail_mutasi_delete(btn){
		if(btn=='yes'){
			var s = detail_mutasiListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_mutasi_DataStore.remove(r);
				detail_mutasi_DataStore.commitChanges();
				detail_mutasi_total();
			}
		} 
		
	}
	//eof
	
	//event on update of detail data store
	//detail_mutasi_DataStore.on('update', refresh_detail_mutasi);
	
	/* Function for retrieve create Window Panel*/ 
	master_mutasi_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 800,	//700,        
		items: [master_mutasi_masterGroup,detail_mutasiListEditorGrid,master_mutasi_footGroup]
		,
		buttons: [
			<?php if(eregi('U|C',$this->m_security->get_access_group_by_kode('MENU_MUTASI'))){ ?>
			mutasi_button_saveprintField
			,
			mutasi_button_saveField
			,
			<?php } ?>
			{
				text: 'Cancel',
				handler: function(){
					master_mutasi_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_mutasi_createWindow= new Ext.Window({
		id: 'master_mutasi_createWindow',
		title: post2db+' Mutasi Barang',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_mutasi_create',
		items: master_mutasi_createForm
	});
	/* End Window */
	
	function detail_mutasi_total(){
		var jumlah_item=0;
		for(i=0;i<detail_mutasi_DataStore.getCount();i++){
			var detail_mutasi_record=detail_mutasi_DataStore.getAt(i);
			jumlah_item=jumlah_item+detail_mutasi_record.data.dmutasi_jumlah;
		}
		mutasi_totaljumlahField.setValue(CurrencyFormatted(jumlah_item));
		mutasi_itemjumlahField.setValue(CurrencyFormatted(detail_mutasi_DataStore.getCount()));
	}
	
		
	/* Function for action list search */
	function master_mutasi_list_search(){
		// render according to a SQL date format.
		var mutasi_id_search=null;
		var mutasi_no_search=null;
		var mutasi_asal_search=null;
		var mutasi_tujuan_search=null;
		var mutasi_tgl_awal_search_date="";
		var mutasi_tgl_akhir_search_date="";
		var mutasi_keterangan_search=null;
		var mutasi_status_search=null;

		if(mutasi_idSearchField.getValue()!==null){mutasi_id_search=mutasi_idSearchField.getValue();}
		if(mutasi_noSearchField.getValue()!==null){mutasi_no_search=mutasi_noSearchField.getValue();}
		if(mutasi_asalSearchField.getValue()!==null){mutasi_asal_search=mutasi_asalSearchField.getValue();}
		if(mutasi_tujuanSearchField.getValue()!==null){mutasi_tujuan_search=mutasi_tujuanSearchField.getValue();}
		if(mutasi_tanggalSearchField.getValue()!==""){mutasi_tgl_awal_search_date=mutasi_tanggalSearchField.getValue().format('Y-m-d');}
		if(mutasi_tanggal_akhirSearchField.getValue()!==""){mutasi_tgl_akhir_search_date=mutasi_tanggal_akhirSearchField.getValue().format('Y-m-d');}
		if(mutasi_keteranganSearchField.getValue()!==null){mutasi_keterangan_search=mutasi_keteranganSearchField.getValue();}
		if(mutasi_statusSearchField.getValue()!==null){mutasi_status_search=mutasi_statusSearchField.getValue();}
		// change the store parameters
		master_mutasi_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			mutasi_id			:	mutasi_id_search, 
			mutasi_no			:	mutasi_no_search,
			mutasi_asal			:	mutasi_asal_search, 
			mutasi_tujuan		:	mutasi_tujuan_search, 
			mutasi_tgl_awal		:	mutasi_tgl_awal_search_date, 
			mutasi_tgl_akhir	:	mutasi_tgl_akhir_search_date, 
			mutasi_keterangan	:	mutasi_keterangan_search,
			mutasi_status		:	mutasi_status_search
		};
		// Cause the datastore to do another query : 
		master_mutasi_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_mutasi_reset_search(){
		// reset the store parameters
		master_mutasi_DataStore.baseParams = { task: 'LIST', start: 0, limit: pageS };
		master_mutasi_DataStore.reload({params: {start: 0, limit: pageS}});
		master_mutasi_searchWindow.close();
	};
	/* End of Fuction */
	
	function master_mutasi_reset_SearchForm(){
		mutasi_noSearchField.reset();
		mutasi_asalSearchField.reset();
		mutasi_tujuanSearchField.reset();
		mutasi_tanggalSearchField.reset();
		mutasi_keteranganSearchField.reset();
		mutasi_statusSearchField.reset();
	}
	
	
	/* Field for search */
	/* Identify  mutasi_id Search Field */
	mutasi_idSearchField= new Ext.form.NumberField({
		id: 'mutasi_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  mutasi_no Search Field */
	mutasi_noSearchField= new Ext.form.TextField({
		id: 'mutasi_noSearchField',
		fieldLabel: 'No MB',
		maxLength: 50,
		anchor: '95%'
	
	});
	
	/* Identify  mutasi_asal Search Field */
	mutasi_asalSearchField= new Ext.form.ComboBox({
		id: 'mutasi_asalSearchField',
		fieldLabel: 'Gudang Asal',
		store: cbo_mutasi_gudang_DataSore,
		mode : 'remote',
		displayField:'mutasi_gudang_nama',
		valueField: 'mutasi_gudang_value',
        typeAhead: false,
        hideTrigger:false,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	
	});
	/* Identify  mutasi_tujuan Search Field */
	mutasi_tujuanSearchField= new Ext.form.ComboBox({
		id: 'mutasi_tujuanSearchField',
		fieldLabel: 'Gudang Tujuan',
		store: cbo_mutasi_gudang_DataSore,
		mode : 'remote',
		displayField:'mutasi_gudang_nama',
		valueField: 'mutasi_gudang_value',
        typeAhead: false,
        hideTrigger:false,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	
	});
	/* Identify  mutasi_tanggal Search Field */
	mutasi_tanggalSearchField= new Ext.form.DateField({
		id: 'mutasi_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	});
	/* Identify  mutasi_keterangan Search Field */
	mutasi_keteranganSearchField= new Ext.form.TextArea({
		id: 'mutasi_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	
	mutasi_label_tanggalField= new Ext.form.Label({ html: ' &nbsp; s/d  &nbsp;' });
    
	mutasi_tanggal_akhirSearchField= new Ext.form.DateField({
		id: 'mutasi_tanggal_akhirSearchField',
		fieldLabel: 's/d',
		format : 'd-m-Y'
	});

	mutasi_statusSearchField= new Ext.form.ComboBox({
		id: 'mutasi_statusSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'mutasi_status'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup'],['Batal','Batal']]
		}),
		mode: 'local',
		displayField: 'mutasi_status',
		valueField: 'value',
		anchor: '60%',
		triggerAction: 'all'	 
	});
    
	/* Function for retrieve search Form Panel */
	master_mutasi_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 400,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [mutasi_noSearchField,mutasi_asalSearchField, mutasi_tujuanSearchField,{
							layout: 'column',
							border : false,
							items:[
							{
								layout: 'form',
								columnWidth: 0.6,
								border: false,
								items:[mutasi_tanggalSearchField]
							},
							{
								layout: 'form',
								columnWidth: 0.4,
								border: false,
								labelWidth: 30,
								items:[mutasi_tanggal_akhirSearchField]
							}
							
							]
						}
						, mutasi_keteranganSearchField, mutasi_statusSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_mutasi_list_search
			},{
				text: 'Close',
				handler: function(){
					master_mutasi_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_mutasi_searchWindow = new Ext.Window({
		title: 'Pencarian Mutasi',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_mutasi_search',
		items: master_mutasi_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_mutasi_searchWindow.isVisible()){
			master_mutasi_reset_SearchForm();
			master_mutasi_searchWindow.show();
		} else {
			master_mutasi_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	function master_mutasi_print_faktur(pkid){
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_mutasi&m=print_faktur',
		params: {
			faktur	: pkid
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/mutasi_faktur.html','mutasi_faktur','height=800,width=670,resizable=1,scrollbars=1, menubar=1');
				break;
		  	default:
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Tidak bisa mencetak data!',
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
			   msg: 'Tidak bisa terhubung dengan database server',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});		
		} 	                     
		});
		
	}
	
	/* Function for print List Grid */
	function master_mutasi_print(){
		var searchquery = "";
		var mutasi_asal_print=null;
		var mutasi_no_print=null;
		var mutasi_tujuan_print=null;
		var mutasi_tgl_awal_print_date="";
		var mutasi_tgl_akhir_print_date="";
		var mutasi_keterangan_print=null;
		var mutasi_status=null;
		var win;              
		// check if we do have some search data...
		if(master_mutasi_DataStore.baseParams.query!==null){searchquery = master_mutasi_DataStore.baseParams.query;}
		if(master_mutasi_DataStore.baseParams.mutasi_no!==null){mutasi_no = master_mutasi_DataStore.baseParams.mutasi_no;}
		if(master_mutasi_DataStore.baseParams.mutasi_asal!==null){mutasi_asal_print = master_mutasi_DataStore.baseParams.mutasi_asal;}
		if(master_mutasi_DataStore.baseParams.mutasi_tujuan!==null){mutasi_tujuan_print = master_mutasi_DataStore.baseParams.mutasi_tujuan;}
		if(master_mutasi_DataStore.baseParams.mutasi_tgl_awal!==""){mutasi_tgl_awal_print_date = master_mutasi_DataStore.baseParams.mutasi_tgl_awal;}
		if(master_mutasi_DataStore.baseParams.mutasi_tgl_akhir!==""){mutasi_tgl_akhir_print_date = master_mutasi_DataStore.baseParams.mutasi_tgl_akhir;}
		if(master_mutasi_DataStore.baseParams.mutasi_keterangan!==null){mutasi_keterangan_print = master_mutasi_DataStore.baseParams.mutasi_keterangan;}
		if(master_mutasi_DataStore.baseParams.mutasi_status!==null){mutasi_status_print = master_mutasi_DataStore.baseParams.mutasi_status;}
		

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_mutasi&m=get_action',
		params: {
			task			: "PRINT",
		  	query			: searchquery,                    		
			mutasi_asal 	: mutasi_asal_print,
			mutasi_tujuan 	: mutasi_tujuan_print,
		  	mutasi_tgl_awal	: mutasi_tgl_awal_print_date, 
			mutasi_tgl_akhir: mutasi_tgl_akhir_print_date, 
			mutasi_no		: mutasi_no_print, 
			mutasi_status	: mutasi_status_print, 
			mutasi_keterangan : mutasi_keterangan_print,
		  	currentlisting: master_mutasi_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/print_mutasilist.html','master_mutasilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
				
				break;
		  	default:
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Tidak bisa mencetak data!',
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
			   msg: 'Tidak bisa terhubung dengan database server',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});		
		} 	                     
		});
	}
	/* Enf Function */
	
	/* Function for print Export to Excel Grid */
	function master_mutasi_export_excel(){
		var searchquery = "";
		var mutasi_asal_2excel=null;
		var mutasi_no_2excel=null;
		var mutasi_tujuan_2excel=null;
		var mutasi_tgl_awal_2excel_date="";
		var mutasi_tgl_akhir_2excel_date="";
		var mutasi_tgl_status_2excel=null;
		var mutasi_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_mutasi_DataStore.baseParams.query!==null){searchquery = master_mutasi_DataStore.baseParams.query;}
		if(master_mutasi_DataStore.baseParams.mutasi_no!==null){mutasi_asal_2excel = master_mutasi_DataStore.baseParams.mutasi_no;}
		if(master_mutasi_DataStore.baseParams.mutasi_asal!==null){mutasi_asal_2excel = master_mutasi_DataStore.baseParams.mutasi_asal;}
		if(master_mutasi_DataStore.baseParams.mutasi_tujuan!==null){mutasi_tujuan_2excel = master_mutasi_DataStore.baseParams.mutasi_tujuan;}
		if(master_mutasi_DataStore.baseParams.mutasi_tgl_awal!==""){mutasi_tgl_awal_2excel_date = master_mutasi_DataStore.baseParams.mutasi_tgl_awal;}
		if(master_mutasi_DataStore.baseParams.mutasi_tgl_akhir!==""){mutasi_tgl_akhir_2excel_date = master_mutasi_DataStore.baseParams.mutasi_tgl_akhir;}
		if(master_mutasi_DataStore.baseParams.mutasi_status!==null){mutasi_status_2excel = master_mutasi_DataStore.baseParams.mutasi_status;}
		if(master_mutasi_DataStore.baseParams.mutasi_keterangan!==null){mutasi_keterangan_2excel = master_mutasi_DataStore.baseParams.mutasi_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_mutasi&m=get_action',
		params: {
			task				: "EXCEL",
		  	query				: searchquery,
			mutasi_no	 		: mutasi_no_2excel,
			mutasi_asal 		: mutasi_asal_2excel,
			mutasi_tujuan 		: mutasi_tujuan_2excel,
		  	mutasi_tgl_awal		: mutasi_tgl_awal_2excel_date, 
			mutasi_tgl_akhir	: mutasi_tgl_akhir_2excel_date, 
			mutasi_status		: mutasi_status_2excel, 
			mutasi_keterangan 	: mutasi_keterangan_2excel,
		  	currentlisting		: master_mutasi_DataStore.baseParams.task // this tells us if we are searching or not
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
					msg: 'Tidak bisa meng-export data ke dalam format excel!',
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
			   msg: 'Tidak bisa terhubung dengan database server',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});    
		} 	                     
		});
	}
	/*End of Function */
	
	//EVENTS
	detail_mutasi_DataStore.on("update",detail_mutasi_total);
	detail_mutasi_DataStore.on("load",detail_mutasi_total);
	master_mutasiListEditorGrid.addListener('rowcontextmenu', onmaster_mutasi_ListEditGridContextMenu);
	master_mutasi_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	
	mutasi_asalField.on("select",function(){
		//cbo_mutasi_produkDataStore.setBaseParam('gudang', get_asal_id()); //by masongbee
		cbo_mutasi_produkDataStore.setBaseParam('gudang', mutasi_asalField.getValue()); //by masongbee
		cbo_mutasi_produkDataStore.setBaseParam('task','list');
		//cbo_mutasi_produkDataStore.reload();
	});
	
	combo_mutasi_produk.on("focus",function(){
		cbo_mutasi_produkDataStore.setBaseParam('task','list');
		var selectedquery=detail_mutasiListEditorGrid.getSelectionModel().getSelected().get('produk_nama');
		cbo_mutasi_produkDataStore.setBaseParam('query',selectedquery);
		
		//cbo_order_produk_DataStore.load();
	});
	
	combo_mutasi_satuan.on("focus",function(){
		cbo_mutasi_satuanDataStore.setBaseParam('task','produk');
		cbo_mutasi_satuanDataStore.setBaseParam('selected_id',combo_mutasi_produk.getValue());
		cbo_mutasi_satuanDataStore.load();
	});
	
	
	combo_mutasi_produk.on("select",function(){
		cbo_mutasi_satuanDataStore.setBaseParam('task','produk');
		cbo_mutasi_satuanDataStore.setBaseParam('selected_id',combo_mutasi_produk.getValue());
		cbo_mutasi_satuanDataStore.reload();
	});
	
	detail_mutasi_DataStore.on("update",function(){
		var	query_selected="";
		var satuan_selected="";
		detail_mutasi_DataStore.commitChanges();
		detail_mutasi_total();
		for(i=0;i<detail_mutasi_DataStore.getCount();i++){
			var detail_mutasi_record=detail_mutasi_DataStore.getAt(i);
			query_selected=query_selected+detail_mutasi_record.data.dmutasi_produk+",";
		}
		cbo_mutasi_produkDataStore.setBaseParam('task','selected');
		cbo_mutasi_produkDataStore.setBaseParam('selected_id',query_selected);
		cbo_mutasi_produkDataStore.load();
		
		for(i=0;i<detail_mutasi_DataStore.getCount();i++){
			var detail_mutasi_record=detail_mutasi_DataStore.getAt(i);
			satuan_selected=satuan_selected+detail_mutasi_record.data.dmutasi_satuan+",";
		}
		cbo_mutasi_satuanDataStore.setBaseParam('task','selected');
		cbo_mutasi_satuanDataStore.setBaseParam('selected_id',satuan_selected);
		cbo_mutasi_satuanDataStore.load();
		//detail_order_beliListEditorGrid.getView().refresh();
	});
	
	
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_mutasi"></div>
         <div id="fp_detail_mutasi"></div>
		<div id="elwindow_master_mutasi_create"></div>
        <div id="elwindow_master_mutasi_search"></div>
    </div>
</div>
</body>