<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Permintaan IT
	+ Description	: For record view
	+ Filename 		: v_permintaan_IT.php
 	+ Author  		: Isaac
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
var permintaan_DataStore;
var permintaan_ColumnModel;
var permintaanEditorGrid;
var permintaan_createForm;
var permintaan_createWindow;
var permintaan_searchForm;
var permintaan_searchWindow;
var gudang_SelectedRow;
var gudang_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var gudang_idField;
var permintaan_namaField;
var permintaan_clientField;
var user_loginField;
var nama_loginField;
var permintaan_cabang_idField;
var permintaan_mengetahui_idField;
var permintaan_mengetahui2_idField;
var permintaan_cabangField;
var permintaan_tanggalmasalahField;
var permintaan_tipeField;
var permintaan_judulField;
var permintaan_permintaanField;
var permintaan_prioritasField;
var permintaan_mengetahuiField;
var permintaan_mengetahui2Field;
var permintaan_mengetahuistatusField;
var permintaan_mengetahuiketeranganField;
var permintaan_mengetahuistatus2Field;
var permintaan_mengetahuiketerangan2Field;
var permintaan_penyelesaianField;
var permintaan_tanggalselesaiField;
var permintaan_statusField;

var gudang_idSearchField;
var permintaan_namaSearchField;
var tanggalmasalahSearchField;
var cabangSearchField;
var judulSearchField;
var prioritasSearchField;
var tipeSearchField;
var statusSearchField;
var tanggalselesaiSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function gudang_update(oGrid_event){
	var gudang_id_update_pk="";
	var gudang_nama_update=null;
	var gudang_lokasi_update=null;
	var gudang_keterangan_update=null;
	var gudang_aktif_update=null;


	gudang_id_update_pk = oGrid_event.record.data.gudang_id;
	if(oGrid_event.record.data.gudang_nama!== null){gudang_nama_update = oGrid_event.record.data.gudang_nama;}
	if(oGrid_event.record.data.gudang_lokasi!== null){gudang_lokasi_update = oGrid_event.record.data.gudang_lokasi;}
	if(oGrid_event.record.data.gudang_keterangan!== null){gudang_keterangan_update = oGrid_event.record.data.gudang_keterangan;}
	if(oGrid_event.record.data.gudang_aktif!== null){gudang_aktif_update = oGrid_event.record.data.gudang_aktif;}
	

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_gudang&m=get_action',
			params: {
				task: "UPDATE",
				gudang_id	: gudang_id_update_pk,				
				gudang_nama	:gudang_nama_update,		
				gudang_lokasi	:gudang_lokasi_update,		
				gudang_keterangan	:gudang_keterangan_update,		
				gudang_aktif	:gudang_aktif_update	
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						permintaan_DataStore.commitChanges();
						permintaan_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the gudang.',
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
	function permintaan_create(){
		if(is_permintaan_form_valid()){
		
		var permintaan_id_create_pk=null;
		var permintaan_nama_create=null;
		var permintaan_client_create=null;
		var permintaan_cabang_id_create=null;
		var permintaan_cabang_create=null;
		var permintaan_tanggalmasalah_create=null;
		var permintaan_tipe_create=null;
		var permintaan_judul_create=null;
		var permintaan_permintaan_create=null;
		var permintaan_prioritas_create=null;
		var permintaan_mengetahui_create=null;
		var permintaan_mengetahui2_create=null;
		var permintaan_mengetahuistatus_create=null;
		var permintaan_mengetahuiketerangan_create=null;
		var permintaan_mengetahuistatus2_create=null;
		var permintaan_mengetahuiketerangan2_create=null;
		var permintaan_penyelesaian_create=null;
		var permintaan_tanggalselesai_create=null;
		var permintaan_status_create=null;

		permintaan_id_create_pk=get_pk_id();
		if(permintaan_namaField.getValue()!== null){permintaan_nama_create = permintaan_namaField.getValue();}
		if(permintaan_clientField.getValue()!== null){permintaan_client_create = permintaan_clientField.getValue();}
		//if(permintaan_cabang_idField.getValue()!== null){permintaan_cabang_id_create = permintaan_cabang_idField.getValue();}
		if(permintaan_cabangField.getValue()!== null){permintaan_cabang_create = permintaan_cabangField.getValue();}
		if(permintaan_tanggalmasalahField.getValue()!== ""){permintaan_tanggalmasalah_create = permintaan_tanggalmasalahField.getValue().format('Y-m-d');}
		if(permintaan_tipeField.getValue()!== null){permintaan_tipe_create = permintaan_tipeField.getValue();}
		if(permintaan_judulField.getValue()!== null){permintaan_judul_create = permintaan_judulField.getValue();}
		if(permintaan_permintaanField.getValue()!== null){permintaan_permintaan_create = permintaan_permintaanField.getValue();}
		if(permintaan_prioritasField.getValue()!== null){permintaan_prioritas_create = permintaan_prioritasField.getValue();}
		if(permintaan_mengetahuiField.getValue()!== null){permintaan_mengetahui_create = permintaan_mengetahuiField.getValue();}
		if(permintaan_mengetahui2Field.getValue()!== null){permintaan_mengetahui2_create = permintaan_mengetahui2Field.getValue();}
		if(permintaan_mengetahuistatusField.getValue()!== null){permintaan_mengetahuistatus_create = permintaan_mengetahuistatusField.getValue();}
		if(permintaan_mengetahuiketeranganField.getValue()!== null){permintaan_mengetahuiketerangan_create = permintaan_mengetahuiketeranganField.getValue();}
		if(permintaan_mengetahuistatus2Field.getValue()!== null){permintaan_mengetahuistatus2_create = permintaan_mengetahuistatus2Field.getValue();}
		if(permintaan_mengetahuiketerangan2Field.getValue()!== null){permintaan_mengetahuiketerangan2_create = permintaan_mengetahuiketerangan2Field.getValue();}
		if(permintaan_penyelesaianField.getValue()!== null){permintaan_penyelesaian_create = permintaan_penyelesaianField.getValue();}
		if(permintaan_statusField.getValue()!== null){permintaan_status_create = permintaan_statusField.getValue();}
		if(permintaan_tanggalselesaiField.getValue()!== ""){permintaan_tanggalselesai_create = permintaan_tanggalselesaiField.getValue().format('Y-m-d');}
		
		Ext.MessageBox.show({
		   msg: 'Sedang menambahkan data, mohon tunggu...',
		   progressText: 'proses...',
		   width:350,
		   wait:true
		});
			Ext.Ajax.request({  
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_permintaan_it&m=get_action',
				params: {
					task: post2db,
					permintaan_id 					: permintaan_id_create_pk,
					permintaan_client				: permintaan_client_create,
					//permintaan_cabang_id			: permintaan_cabang_id_create,
					permintaan_nama 				: permintaan_nama_create,
					permintaan_cabang 				: permintaan_cabang_create,
					permintaan_tanggalmasalah 		: permintaan_tanggalmasalah_create,
					permintaan_tipe			 		: permintaan_tipe_create,
					permintaan_judul 				: permintaan_judul_create,
					permintaan_permintaan 			: permintaan_permintaan_create,
					permintaan_prioritas 			: permintaan_prioritas_create,
					permintaan_mengetahui 			: permintaan_mengetahui_create,
					permintaan_mengetahui2 			: permintaan_mengetahui2_create,
					permintaan_mengetahuistatus 	: permintaan_mengetahuistatus_create,
					permintaan_mengetahuiketerangan : permintaan_mengetahuiketerangan_create,
					permintaan_mengetahuistatus2 	: permintaan_mengetahuistatus2_create,
					permintaan_mengetahuiketerangan2: permintaan_mengetahuiketerangan2_create,
					permintaan_penyelesaian 		: permintaan_penyelesaian_create,
					permintaan_status 				: permintaan_status_create,
					permintaan_tanggalselesai 		: permintaan_tanggalselesai_create
					/*
					gudang_id	: permintaan_id_create_pk,	
					gudang_nama	: gudang_nama_create,	
					gudang_lokasi	: gudang_lokasi_create,	
					gudang_keterangan	: gudang_keterangan_create,	
					gudang_aktif	: gudang_aktif_create
					*/
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert('Info','Permintaan anda telah disimpan');
							cbo_cabang_DataStore.reload();
							permintaan_DataStore.reload();
							permintaan_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Gudang.',
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
				msg: 'Form anda belum lengkap',
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
			return permintaanEditorGrid.getSelectionModel().getSelected().get('permintaan_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function permintaan_reset_form(){
		permintaan_namaField.reset();
		permintaan_namaField.setValue(null);
		permintaan_clientField.reset();
		permintaan_clientField.setValue(null);
		permintaan_cabang_idField.reset();
		permintaan_cabang_idField.setValue(null);
		permintaan_cabangField.reset();
		permintaan_cabangField.setValue(null);
		permintaan_tanggalmasalahField.reset();
		permintaan_tanggalmasalahField.setValue(null);
		permintaan_tipeField.reset();
		permintaan_tipeField.setValue(null);
		permintaan_judulField.reset();
		permintaan_judulField.setValue(null);
		permintaan_permintaanField.reset();
		permintaan_permintaanField.setValue(null);		
		permintaan_prioritasField.reset();
		permintaan_prioritasField.setValue(null);
		permintaan_mengetahuiField.reset();
		permintaan_mengetahuiField.setValue(null);
		permintaan_mengetahuistatusField.reset();
		permintaan_mengetahuistatusField.setValue(null);
		permintaan_mengetahuiketeranganField.reset();
		permintaan_mengetahuiketeranganField.setValue(null);
		permintaan_mengetahuistatus2Field.reset();
		permintaan_mengetahuistatus2Field.setValue(null);
		permintaan_mengetahuiketerangan2Field.reset();
		permintaan_mengetahuiketerangan2Field.setValue(null);
		permintaan_mengetahui2Field.reset();
		permintaan_mengetahui2Field.setValue(null);
		permintaan_penyelesaianField.reset();
		permintaan_penyelesaianField.setValue(null);
		permintaan_tanggalselesaiField.reset();
		permintaan_tanggalselesaiField.setValue(null);
		permintaan_statusField.reset();
		permintaan_statusField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function permintaan_set_form(){
		permintaan_namaField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('nama'));
		permintaan_clientField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('client'));
		//permintaan_cabang_idField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('cabang_id'));
		permintaan_cabangField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('cabang'));
		permintaan_tanggalmasalahField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('tanggal_masalah'));
		permintaan_tipeField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('tipe'));
		permintaan_judulField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('judul'));
		permintaan_permintaanField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('masalah'));
		permintaan_prioritasField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('prioritas'));
		permintaan_mengetahuiField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('mengetahui_nama'));
		
		permintaan_mengetahui_idField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('mengetahui'));
		permintaan_mengetahui2_idField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('mengetahui2'));
		
		permintaan_mengetahuistatusField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('mengetahui_status'));
		permintaan_mengetahuiketeranganField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('mengetahui_keterangan'));
		permintaan_mengetahuistatus2Field.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('mengetahui_status2'));
		permintaan_mengetahuiketerangan2Field.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('mengetahui_keterangan2'));
		permintaan_mengetahui2Field.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('mengetahui_nama2'));
		permintaan_penyelesaianField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('penyelesaian'));
		permintaan_tanggalselesaiField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('tanggal_selesai'));
		permintaan_statusField.setValue(permintaanEditorGrid.getSelectionModel().getSelected().get('status'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_permintaan_form_valid(){
		return (permintaan_permintaanField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		permintaan_reset_form();
		cbo_cabang_DataStore.reload();
		permintaan_namaField.setValue(nama_loginField.getValue());
		permintaan_cabangField.setValue('Pilih Satu');
		permintaan_tipeField.setValue('Pilih Satu');
		permintaan_prioritasField.setValue('Normal');
		permintaan_mengetahuiField.setValue('Pilih Satu');
		permintaan_mengetahuistatusField.setValue('Pilih Satu');
		permintaan_mengetahuistatus2Field.setValue('Pilih Satu');
		permintaan_mengetahui2Field.setValue('Pilih Satu');
		// set disable status dan keterangan mengetahui
		permintaan_mengetahuistatusField.setDisabled(true);
		permintaan_mengetahuiketeranganField.setDisabled(true);
		permintaan_mengetahuistatus2Field.setDisabled(true);
		permintaan_mengetahuiketerangan2Field.setDisabled(true);
		
		permintaan_mengetahuiField.setDisabled(false);
		permintaan_mengetahui2Field.setDisabled(false);
		
		if(!permintaan_createWindow.isVisible()){
			//permintaan_reset_form();
			if (user_loginField.getValue() != 2 || user_loginField.getValue() != 11 || user_loginField.getValue() !=66 || user_loginField.getValue() !=79){
				permintaan_penyelesaianField.setDisabled(true);
				permintaan_tanggalselesaiField.setDisabled(true);
				permintaan_statusField.setDisabled(true);
				
			}else {
				permintaan_penyelesaianField.setDisabled(false);
				permintaan_tanggalselesaiField.setDisabled(false);
				permintaan_statusField.setDisabled(false);
			}
			post2db='CREATE';
			//msg='created';
			permintaan_createWindow.show();
		} else {
			permintaan_reset_form();
			permintaan_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function gudang_confirm_delete(){
		// only one gudang is selected here
		if(permintaanEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', gudang_delete);
		} else if(permintaanEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', gudang_delete);
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
	function permintaan_confirm_update(){
		/* only one record is selected here */
		//cbo_cabang_DataStore.reload();
		//({params : {permintaan_id : eval(get_pk_id()), start:0, limit:pageS}});
		if(permintaanEditorGrid.selModel.getCount() == 1) {
			permintaan_set_form();
			permintaan_mengetahuiField.setDisabled(true);
			permintaan_mengetahui2Field.setDisabled(true);
			permintaan_mengetahuistatusField.setDisabled(true);
			permintaan_mengetahuiketeranganField.setDisabled(true);
			permintaan_mengetahuistatus2Field.setDisabled(true);
			permintaan_mengetahuiketerangan2Field.setDisabled(true);
			if (user_loginField.getValue() == 2 || user_loginField.getValue() == 11 || user_loginField.getValue() ==66 || user_loginField.getValue() ==79){
				permintaan_penyelesaianField.setDisabled(false);
				permintaan_tanggalselesaiField.setDisabled(false);
				permintaan_statusField.setDisabled(false);
				
			}else {
				permintaan_penyelesaianField.setDisabled(true);
				permintaan_tanggalselesaiField.setDisabled(true);
				permintaan_statusField.setDisabled(true);
			}
			
			if (user_loginField.getValue() == permintaan_mengetahui_idField.getValue()){
				permintaan_mengetahuistatusField.setDisabled(false);
				permintaan_mengetahuiketeranganField.setDisabled(false);
			}
			if (user_loginField.getValue() == permintaan_mengetahui2_idField.getValue()){
				permintaan_mengetahuistatus2Field.setDisabled(false);
				permintaan_mengetahuiketerangan2Field.setDisabled(false);
			}
			
			post2db='UPDATE';
			msg='updated';
			permintaan_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'You can\'t really update something you haven\'t selected?',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
		//permintaan_reset_form();
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function gudang_delete(btn){
		if(btn=='yes'){
			var selections = permintaanEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< permintaanEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.gudang_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_gudang&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							permintaan_DataStore.reload();
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
	permintaan_DataStore = new Ext.data.Store({
		id: 'permintaan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_permintaan_it&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'permintaan_id'
		},[
		/* dataIndex => insert intopermintaan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'permintaan_id', type: 'int', mapping: 'permintaan_id'},
			{name: 'client', type: 'int', mapping: 'client'},
			{name: 'cabang_id', type: 'int', mapping: 'cabang_id'},
			{name: 'nama', type: 'string', mapping: 'nama'},
			{name: 'cabang', type: 'string', mapping: 'cabang'},
			{name: 'tanggal_masalah', type: 'date', mapping: 'tanggal_masalah'},
			{name: 'tipe', type: 'string', mapping: 'tipe'},
			{name: 'judul', type: 'string', mapping: 'judul'},
			{name: 'masalah', type: 'string', mapping: 'masalah'},
			{name: 'penyelesaian', type: 'string', mapping: 'penyelesaian'},
			{name: 'tanggal_selesai', type: 'string', mapping: 'tanggal_selesai'},
			{name: 'prioritas', type: 'string', mapping: 'prioritas'},
			{name: 'mengetahui', type: 'int', mapping: 'mengetahui'},
			{name: 'mengetahui_nama', type: 'string', mapping: 'mengetahui_nama'},
			{name: 'mengetahui2', type: 'int', mapping: 'mengetahui2'},
			{name: 'mengetahui_nama2', type: 'string', mapping: 'mengetahui_nama2'},
			{name: 'mengetahui_status', type: 'string', mapping: 'mengetahui_status'},
			{name: 'mengetahui_keterangan', type: 'string', mapping: 'mengetahui_keterangan'},
			{name: 'mengetahui_status2', type: 'string', mapping: 'mengetahui_status2'},
			{name: 'mengetahui_keterangan2', type: 'string', mapping: 'mengetahui_keterangan2'},
			{name: 'status', type: 'string', mapping: 'status'}
		]),
		sortInfo:{field: 'tanggal_masalah', direction: "DESC"}
	});
	/* End of Function */
    
	//datastore of cabang
	
	cbo_cabang_DataStore = new Ext.data.Store({
		id: 'cbo_cabang_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_permintaan_it&m=get_cabang_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			//id: 'cabang_id'
		},[
			{name: 'permintaan_cabang_value', type: 'int', mapping: 'cabang_id'},
			{name: 'permintaan_cabang_display', type: 'string', mapping: 'cabang_nama'}
		]),
		sortInfo:{field: 'permintaan_cabang_display', direction: "ASC"}
	});
	
	/* eof */
	
	//datastore of user login
	
	cbo_user_login_DataStore = new Ext.data.Store({
		id: 'cbo_user_login_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_permintaan_it&m=get_user_login', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			//id: 'cabang_id'
		},[
			{name: 'user_karyawan', type: 'int', mapping: 'user_karyawan'},
			{name: 'karyawan_nama', type: 'string', mapping: 'karyawan_nama'},
		]),
		sortInfo:{field: 'user_karyawan', direction: "ASC"}
	});
	
	/* eof */
	
	cbo_permintaan_karyawanDataStore = new Ext.data.Store({
		id: 'cbo_permintaan_karyawanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_permintaan_it&m=get_karyawan_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit:pageS }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'karyawan_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_id', type: 'int', mapping: 'karyawan_id'},
			{name: 'karyawan_no', type: 'string', mapping: 'karyawan_no'},
			{name: 'karyawan_nama', type: 'string', mapping: 'karyawan_nama'}
			//{name: 'cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			//{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			//{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'karyawan_no', direction: "ASC"}
	});
	//Template yang akan tampil di ComboBox
	var karyawan_permintaan_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{karyawan_no} | {karyawan_nama}</b></span>',
        '</div></tpl>'
    );
	
	
  	/* Function for Identify of Window Column Model */
	permintaan_ColumnModel = new Ext.grid.ColumnModel(
		[/*{
			header: '#',
			readOnly: true,
			dataIndex: 'gudang_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},*/
		{
			header: '<div align="center">' + 'Nama Peminta' + '</div>',
			dataIndex: 'nama',
			width: 180,
			sortable: true,
			readOnly: true
			/*
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
			*/
		},
		{
			header: '<div align="center">' + 'Cabang' + '</div>',
			dataIndex: 'cabang',
			width: 100,
			sortable: true,
			readOnly: true
			/*
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
			*/
		},
		{
			header: '<div align="center">' + 'Tgl Permintaan' + '</div>',
			dataIndex: 'tanggal_masalah',
			width: 80,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			/*
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
			*/
		},
		{
			header: '<div align="center">' + 'Tipe Permintaan' + '</div>',
			dataIndex: 'tipe',
			width: 150,
			sortable: true,
			readOnly: true,
			/*
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
			*/
		},
		{
			header: '<div align="center">' + 'Permintaan' + '</div>',
			dataIndex: 'masalah',
			width: 400,
			sortable: true,
			readOnly: true
			/*
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
			*/
		},
		{
			header: '<div align="center">' + 'Prioritas' + '</div>',
			dataIndex: 'prioritas',
			align: 'center',
			width: 80,
			sortable: true,
			readOnly: true
			/*
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
			*/
		},
		{
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'status',
			align: 'center',
			width: 120,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['permintaan_aktif_value', 'permintaan_aktif_display'],
					data: [['Ditolak','Ditolak'],['Proses Pengerjaan','Proses Pengerjaan'],['Closed','Closed'],['Open','Open']]
					}),
				mode: 'local',
               	displayField: 'permintaan_aktif_display',
               	valueField: 'permintaan_aktif_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Creator',
			dataIndex: 'gudang_creator',
			width: 150,
			sortable: true,
			hidden: true
		},
		{
			header: 'Create on',
			dataIndex: 'gudang_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true
		},
		{
			header: 'Last Update by',
			dataIndex: 'gudang_update',
			width: 150,
			sortable: true,
			hidden: true
		},
		{
			header: 'Last Update on',
			dataIndex: 'gudang_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true
		},
		{
			header: 'Revised',
			dataIndex: 'gudang_revised',
			width: 150,
			sortable: true,
			hidden: true
		}]
	);
	permintaan_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	permintaanEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'permintaanEditorGrid',
		el: 'fp_permintaan',
		title: 'Daftar Permintaan',
		autoHeight: true,
		store: permintaan_DataStore, // DataStore
		cm: permintaan_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		readonly: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: permintaan_DataStore,
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
			handler: permintaan_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled:true,
			handler: gudang_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: permintaan_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						permintaan_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- Nama Peminta<br>- Cabang<br>- Judul Subyek'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: gudang_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			disabled:true,
			handler: gudang_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			disabled:true,
			handler: gudang_print  
		}
		]
	});
	permintaanEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	gudang_ContextMenu = new Ext.menu.Menu({
		id: 'gudang_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: permintaan_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: gudang_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: gudang_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: gudang_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function ongudang_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		gudang_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		gudang_SelectedRow=rowIndex;
		gudang_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function gudang_editContextMenu(){
      permintaanEditorGrid.startEditing(gudang_SelectedRow,1);
  	}
	/* End of Function */
  	
	// load awal
	permintaanEditorGrid.addListener('rowcontextmenu', ongudang_ListEditGridContextMenu);
	permintaan_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	cbo_user_login_DataStore.reload();	// load DataStore
	permintaanEditorGrid.on('afteredit', gudang_update); // inLine Editing Record
	
	cbo_user_login_DataStore.load({
		 	params:{},
		 	callback: function(r,opt,success){
				if(success==true){
					//var j=cbo_user_login_DataStore.findExact('cust_id',history_transaksi_custField.getValue(),0);
					//if(j>-1){
						var cust_record=cbo_user_login_DataStore.getAt(0);
						nama_loginField.setValue(cust_record.data.karyawan_nama);
						user_loginField.setValue(cust_record.data.user_karyawan);
						//history_transaksi_customerField.setValue(cust_record.data.cust_nama);
						//history_transaksi_custnoField.setValue(cust_record.data.cust_no);
						//history_transaksi_custalamatField.setValue(cust_record.data.cust_alamat);
						//history_transaksi_custtelpField.setValue(cust_record.data.cust_telprumah);
					//}
				}
			}
		});
	
	user_loginField= new Ext.form.TextField({
		id: 'user_loginField',
		allowBlank: false,
	});
	nama_loginField= new Ext.form.TextField({
		id: 'nama_loginField',
		allowBlank: false,
	});
	permintaan_clientField= new Ext.form.TextField({
		id: 'permintaan_clientField',
		allowBlank: false,
	});
	permintaan_cabang_idField= new Ext.form.TextField({
		id: 'permintaan_cabang_idField',
		allowBlank: false,
	});
	permintaan_mengetahui_idField= new Ext.form.TextField({
		id: 'permintaan_mengetahui_idField',
		allowBlank: false,
	});
	permintaan_mengetahui2_idField= new Ext.form.TextField({
		id: 'permintaan_mengetahui2_idField',
		allowBlank: false,
	});
	permintaan_nama_labelField=new Ext.form.Label({ html: '<span style="font-size: 12px">Nama Peminta :</span>'});
	permintaan_namaField= new Ext.form.TextField({
		id: 'permintaan_namaField',
		fieldLabel : 'Nama Peminta',
		maxLength: 100,
		//hideLabel : true,
		width: 10,
		readOnly: true,
		allowBlank: false,
		emptyText: 'Auto',
		anchor: '95%'
	});
	permintaan_cabangField= new Ext.form.ComboBox({
		id: 'permintaan_cabangField',
		fieldLabel: 'Cabang',
		allowBlank: false,
		//anchor: '95%',
		emptyText: 'Pilih Satu',
		store: cbo_cabang_DataStore,
		mode: 'remote',
		editable: false,
		displayField: 'permintaan_cabang_display',
		valueField: 'permintaan_cabang_value',
		width: 200,
		triggerAction: 'all'
	});
	permintaan_tanggalmasalahField= new Ext.form.DateField({
		id: 'permintaan_tanggalmasalahField',
		fieldLabel: 'Tgl Permintaan',
		format : 'd-m-Y'
	});
	permintaan_tipeField= new Ext.form.ComboBox({
		id: 'permintaan_tipeField',
		fieldLabel: 'Tipe Permintaan',
		store:new Ext.data.SimpleStore({
			fields:['permintaan_tipe_value', 'permintaan_tipe_display'],
			data:[['Refill Tinta','Refill Tinta'],['Miracle Information System','Miracle Information System'],['Pengadaan (Hardware)','Pengadaan (Hardware)'],['Kerusakan','Kerusakan'],['Kunjungan','Kunjungan'],['Pengadaan (Software)','Pengadaan (Software)'],['Lain-lain','Lain-lain']]
		}),
		mode: 'local',
		allowBlank: false,
		editable:false,
		displayField: 'permintaan_tipe_display',
		valueField: 'permintaan_tipe_value',
		emptyText: 'Miracle Information System',
		width: 200,
		triggerAction: 'all'	
	});
	permintaan_judulField= new Ext.form.TextField({
		id: 'permintaan_judulField',
		fieldLabel: 'Judul Subyek',
		allowBlank: false,
		maxLength: 400,
		width: 300,
		anchor: '95%'
	});
	permintaan_permintaanField= new Ext.form.TextArea({
		id: 'permintaan_permintaanField',
		fieldLabel: 'Permintaan',
		allowBlank: false,
		maxLength: 1000,
		anchor: '95%'
	});
	permintaan_prioritasField= new Ext.form.ComboBox({
		id: 'permintaan_prioritasField',
		fieldLabel: 'Prioritas',
		store:new Ext.data.SimpleStore({
			fields:['permintaan_prioritas_value', 'permintaan_prioritas_display'],
			data:[['Low','Low'],['Normal','Normal'],['High','High']]
		}),
		mode: 'local',
		allowBlank: false,
		editable:false,
		displayField: 'permintaan_prioritas_display',
		valueField: 'permintaan_prioritas_value',
		emptyText: 'Low',
		width: 200,
		triggerAction: 'all',
		//anchor: '95%'
	});
	
	permintaan_mengetahuiField= new Ext.form.ComboBox({
		fieldLabel: 'Mengetahui',
		store: cbo_permintaan_karyawanDataStore,
		mode: 'remote',
		displayField:'karyawan_nama',
		valueField: 'karyawan_id',
        typeAhead: false,
        loadingText: 'Searching...',
		emptyText: 'Pilih Satu',
        pageSize:10,
		width: 350,
        hideTrigger:false,
        tpl: karyawan_permintaan_tpl,
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		disabled:false,
		anchor: '90%'
	});
	
	permintaan_mengetahui2Field= new Ext.form.ComboBox({
		fieldLabel: 'Mengetahui 2',
		store: cbo_permintaan_karyawanDataStore,
		mode: 'remote',
		displayField:'karyawan_nama',
		valueField: 'karyawan_id',
        typeAhead: false,
        loadingText: 'Searching...',
		emptyText: 'Pilih Satu',
        pageSize:10,
		width: 350,
        hideTrigger:false,
        tpl: karyawan_permintaan_tpl,
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		disabled:false,
		anchor: '90%'
	});
	
	permintaan_penyelesaianField= new Ext.form.TextArea({
		id: 'permintaan_penyelesaianField',
		fieldLabel: 'Penyelesaian',
		maxLength: 1000,
		anchor: '95%'
	});
	permintaan_tanggalselesaiField= new Ext.form.DateField({
		id: 'permintaan_tanggalselesaiField',
		fieldLabel: 'Tanggal Selesai',
		format : 'd-m-Y'
	});
	permintaan_statusField= new Ext.form.ComboBox({
		id: 'permintaan_statusField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['permintaan_status_value', 'permintaan_status_display'],
			data: [['Ditolak','Ditolak'],['Proses Pengerjaan','Proses Pengerjaan'],['Closed','Closed'],['Open','Open']]
		}),
		mode: 'local',
		editable:false,
		displayField: 'permintaan_status_display',
		valueField: 'permintaan_status_value',
		emptyText: 'Open',
		width: 200,
		triggerAction: 'all'	
	});
	permintaan_mengetahuistatusField= new Ext.form.ComboBox({
		id: 'permintaan_mengetahuistatusField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['permintaan_mengetahuistatus_value', 'permintaan_engetahuistatus_display'],
			data: [['Ditolak','Ditolak'],['Pending','Pending'],['Disetujui','Disetujui']]
		}),
		mode: 'local',
		editable:false,
		displayField: 'permintaan_engetahuistatus_display',
		valueField: 'permintaan_mengetahuistatus_value',
		emptyText: 'Open',
		width: 75,
		triggerAction: 'all'	
	});
	permintaan_mengetahuistatus2Field= new Ext.form.ComboBox({
		id: 'permintaan_mengetahuistatus2Field',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['permintaan_mengetahuistatus2_value', 'permintaan_engetahuistatus2_display'],
			data: [['Ditolak','Ditolak'],['Pending','Pending'],['Disetujui','Disetujui']]
		}),
		mode: 'local',
		editable:false,
		displayField: 'permintaan_engetahuistatus2_display',
		valueField: 'permintaan_mengetahuistatus2_value',
		emptyText: 'Open',
		width: 75,
		triggerAction: 'all'	
	});
	permintaan_mengetahuiketeranganField= new Ext.form.TextArea({
		id: 'permintaan_mengetahuiketeranganField',
		fieldLabel: 'Keterangan',
		allowBlank: true,
		maxLength: 1000,
		anchor: '95%'
	});
	permintaan_mengetahuiketerangan2Field= new Ext.form.TextArea({
		id: 'permintaan_mengetahuiketerangan2Field',
		fieldLabel: 'Keterangan',
		allowBlank: true,
		maxLength: 1000,
		anchor: '95%'
	});
	mengetahui_permintaanField=new Ext.form.FieldSet({
		id:'mengetahui_permintaanField',
		title: 'Mengetahui dan Persetujuan',
		layout: 'form',
		bodyStyle:'padding: 0px 0px 0',
		frame: false,
		bolder: false,
		anchor: '98%',
		items:[{
				layout: 'column',
				border: false,
				items:[{
					   		layout: 'form',
							border: false,
							labelWidth: 95,
							bodyStyle:'padding:3px',
							items:[permintaan_mengetahuiField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 50,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[permintaan_mengetahuistatusField]
					   }]
			},permintaan_mengetahuiketeranganField,{
				layout: 'column',
				border: false,
				items:[{
					   		layout: 'form',
							border: false,
							labelWidth: 95,
							bodyStyle:'padding:3px',
							items:[permintaan_mengetahui2Field]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 50,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[permintaan_mengetahuistatus2Field]
					   }]
			}, permintaan_mengetahuiketerangan2Field]
	});
	
	input_itField=new Ext.form.FieldSet({
		id:'input_itField',
		title: 'Diisi oleh IT Dept.',
		layout: 'form',
		boduStyle: 'padding: 5px;',
		frame: false,
		items:[permintaan_penyelesaianField, permintaan_tanggalselesaiField, permintaan_statusField]
	});
	
  	
	/* Function for retrieve create Window Panel*/ 
	permintaan_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 450,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [permintaan_namaField, permintaan_cabangField, permintaan_tanggalmasalahField,
				permintaan_tipeField, permintaan_permintaanField, permintaan_prioritasField, mengetahui_permintaanField, input_itField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: permintaan_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					permintaan_reset_form();
					permintaan_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	permintaan_createWindow= new Ext.Window({
		id: 'permintaan_createWindow',
		title: post2db+'Form Permintaan',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		//width: 1000,
		//height: ,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_permintaan_create',
		items: permintaan_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function permintaan_list_search(){
		// render according to a SQL date format.
		//var gudang_id_search=null;
		var permintaan_nama_search=null;
		var permintaan_tanggalmasalah_search="";
		var permintaan_cabang_search=null;
		var permintaan_judul_search=null;
		var permintaan_prioritas_search=null;
		var permintaan_tipe_search=null;
		var permintaan_tanggalselesai_search="";
		var permintaan_status_search=null;


		//if(gudang_idSearchField.getValue()!==null){gudang_id_search=gudang_idSearchField.getValue();}
		if(permintaan_namaSearchField.getValue()!==null){permintaan_nama_search=permintaan_namaSearchField.getValue();}
		if(tanggalmasalahSearchField.getValue()!==""){permintaan_tanggalmasalah_search=tanggalmasalahSearchField.getValue().format('Y-m-d');}
		if(cabangSearchField.getValue()!==null){permintaan_cabang_search=cabangSearchField.getValue();}
		if(judulSearchField.getValue()!==null){permintaan_judul_search=judulSearchField.getValue();}
		if(prioritasSearchField.getValue()!==null){permintaan_prioritas_search=prioritasSearchField.getValue();}
		if(tipeSearchField.getValue()!==null){permintaan_tipe_search=tipeSearchField.getValue();}
		if(tanggalselesaiSearchField.getValue()!==""){permintaan_tanggalselesai_search=tanggalselesaiSearchField.getValue().format('Y-m-d');}
		if(statusSearchField.getValue()!==null){permintaan_status_search=statusSearchField.getValue();}

		// change the store parameters
		permintaan_DataStore.baseParams = {
			task: 'SEARCH',
			start: 0,
			limit: pageS,
			//variable here
			//gudang_id	:	gudang_id_search, 
			permintaan_nama 			: permintaan_nama_search,
			permintaan_cabang 			: permintaan_cabang_search,
			permintaan_tanggalmasalah 	: permintaan_tanggalmasalah_search,
			permintaan_tipe			 	: permintaan_tipe_search,
			permintaan_judul 			: permintaan_judul_search,
			permintaan_prioritas 		: permintaan_prioritas_search,
			permintaan_status 			: permintaan_status_search,
			permintaan_tanggalselesai 	: permintaan_tanggalselesai_search
	};
		// Cause the datastore to do another query : 
		permintaan_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function gudang_reset_search(){
		// reset the store parameters
		permintaan_DataStore.baseParams = { task: 'LIST', start:0, limit:pageS };
		// Cause the datastore to do another query : 
		permintaan_DataStore.reload({params: {start: 0, limit: pageS}});
		permintaan_searchWindow.close();
	};
	/* End of Fuction */
	
	function permintaan_reset_SearchForm(){
		permintaan_namaSearchField.reset();
		tanggalmasalahSearchField.reset();
		cabangSearchField.reset();
		judulSearchField.reset();
		prioritasSearchField.reset();
		tipeSearchField.reset();
		tanggalselesaiSearchField.reset();
		statusSearchField.reset();
	}
	
	/* Field for search */
	/* Identify  gudang_id Search Field */
	gudang_idSearchField= new Ext.form.NumberField({
		id: 'gudang_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  gudang_nama Search Field */
	permintaan_namaSearchField= new Ext.form.TextField({
		id: 'permintaan_namaSearchField',
		fieldLabel: 'Nama Peminta',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  gudang_lokasi Search Field */
	cabangSearchField= new Ext.form.TextField({
		id: 'cabangSearchField',
		fieldLabel: 'Cabang',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  gudang_keterangan Search Field */
	judulSearchField= new Ext.form.TextField({
		id: 'judulSearchField',
		fieldLabel: 'Judul Subyek',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  gudang_aktif Search Field */
	prioritasSearchField= new Ext.form.ComboBox({
		id: 'prioritasSearchField',
		fieldLabel: 'Prioritas',
		store:new Ext.data.SimpleStore({
			fields:['prioritas_value_search', 'prioritas_display_search'],
			data:[['Low','Low'],['Normal','Normal'],['High','High']]
		}),
		mode: 'local',
		allowBlank: false,
		editable:false,
		displayField: 'prioritas_display_search',
		valueField: 'prioritas_value_search',
		//emptyText: 'Low',
		width: 100,
		triggerAction: 'all',
		anchor: '95%' 
	
	});
	tanggalmasalahSearchField= new Ext.form.DateField({
		id: 'tanggalmasalahSearchField',
		fieldLabel: 'Tgl Permintaan',
		format : 'd-m-Y',
	});
	tipeSearchField= new Ext.form.ComboBox({
		id: 'tipeSearchField',
		fieldLabel: 'Tipe Subyek',
		store:new Ext.data.SimpleStore({
			fields:['tipe_value_search', 'tipe_display_search'],
			data:[['Refill Tinta','Refill Tinta'],['Miracle Information System','Miracle Information System'],['Pengadaan (Hardware)','Pengadaan (Hardware)'],['Kerusakan','Kerusakan'],['Kunjungan','Kunjungan'],['Pengadaan (Software)','Pengadaan (Software)'],['Lain-lain','Lain-lain']]
		}),
		mode: 'local',
		allowBlank: false,
		editable:false,
		displayField: 'tipe_display_search',
		valueField: 'tipe_value_search',
		//emptyText: 'Miracle Information System',
		width: 250,
		triggerAction: 'all'	
	});
	statusSearchField= new Ext.form.ComboBox({
		id: 'statusSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['status_value_search', 'status_display_search'],
			data: [['Ditolak','Ditolak'],['Proses Pengerjaan','Proses Pengerjaan'],['Closed','Closed'],['Open','Open']]
		}),
		mode: 'local',
		editable:false,
		displayField: 'status_display_search',
		valueField: 'status_value_search',
		emptyText: 'Open',
		width: 120,
		triggerAction: 'all'	
	});
	
	tanggalselesaiSearchField= new Ext.form.DateField({
		id: 'tanggalselesaiSearchField',
		fieldLabel: 'Tanggal Selesai',
		format : 'd-m-Y',
	});
	    
	/* Function for retrieve search Form Panel */
	permintaan_searchForm = new Ext.FormPanel({
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
				items: [permintaan_namaSearchField, tanggalmasalahSearchField, tipeSearchField, cabangSearchField, prioritasSearchField, tanggalselesaiSearchField, statusSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: permintaan_list_search
			},{
				text: 'Close',
				handler: function(){
					permintaan_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	permintaan_searchWindow = new Ext.Window({
		title: 'Pencarian Permintaan IT',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_permintaan_search',
		items: permintaan_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!permintaan_searchWindow.isVisible()){
			permintaan_reset_SearchForm();
			permintaan_searchWindow.show();
		} else {
			permintaan_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function gudang_print(){
		var searchquery = "";
		var gudang_nama_print=null;
		var gudang_lokasi_print=null;
		var gudang_keterangan_print=null;
		var gudang_aktif_print=null;
		var win;              
		// check if we do have some search data...
		if(permintaan_DataStore.baseParams.query!==null){searchquery = permintaan_DataStore.baseParams.query;}
		if(permintaan_DataStore.baseParams.gudang_nama!==null){gudang_nama_print = permintaan_DataStore.baseParams.gudang_nama;}
		if(permintaan_DataStore.baseParams.gudang_lokasi!==null){gudang_lokasi_print = permintaan_DataStore.baseParams.gudang_lokasi;}
		if(permintaan_DataStore.baseParams.gudang_keterangan!==null){gudang_keterangan_print = permintaan_DataStore.baseParams.gudang_keterangan;}
		if(permintaan_DataStore.baseParams.gudang_aktif!==null){gudang_aktif_print = permintaan_DataStore.baseParams.gudang_aktif;}
		

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_gudang&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			gudang_nama : gudang_nama_print,
			gudang_lokasi : gudang_lokasi_print,
			gudang_keterangan : gudang_keterangan_print,
			gudang_aktif : gudang_aktif_print,
		  	currentlisting: permintaan_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./gudanglist.html','gudanglist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function gudang_export_excel(){
		var searchquery = "";
		var gudang_nama_2excel=null;
		var gudang_lokasi_2excel=null;
		var gudang_keterangan_2excel=null;
		var gudang_aktif_2excel=null;
		var win;              
		// check if we do have some search data...
		if(permintaan_DataStore.baseParams.query!==null){searchquery = permintaan_DataStore.baseParams.query;}
		if(permintaan_DataStore.baseParams.gudang_nama!==null){gudang_nama_2excel = permintaan_DataStore.baseParams.gudang_nama;}
		if(permintaan_DataStore.baseParams.gudang_lokasi!==null){gudang_lokasi_2excel = permintaan_DataStore.baseParams.gudang_lokasi;}
		if(permintaan_DataStore.baseParams.gudang_keterangan!==null){gudang_keterangan_2excel = permintaan_DataStore.baseParams.gudang_keterangan;}
		if(permintaan_DataStore.baseParams.gudang_aktif!==null){gudang_aktif_2excel = permintaan_DataStore.baseParams.gudang_aktif;}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_gudang&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			gudang_nama : gudang_nama_2excel,
			gudang_lokasi : gudang_lokasi_2excel,
			gudang_keterangan : gudang_keterangan_2excel,
			gudang_aktif : gudang_aktif_2excel,
		  	currentlisting: permintaan_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_permintaan"></div>
		<div id="elwindow_permintaan_create"></div>
        <div id="elwindow_permintaan_search"></div>
    </div>
</div>
</body>