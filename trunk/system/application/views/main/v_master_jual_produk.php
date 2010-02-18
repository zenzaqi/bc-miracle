<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_produk View
	+ Description	: For record view
	+ Filename 		: v_master_jual_produk.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:59:01
	
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
var master_jual_produk_DataStore;
var kwitansi_jual_produk_DataStore;
var card_jual_produk_DataStore;
var cek_jual_produk_DataStore;
var transfer_jual_produk_DataStore;
//
var master_jual_produk_ColumnModel;
var master_jual_produkListEditorGrid;
var master_jual_produk_createForm;
var master_jual_produk_createWindow;
var master_jual_produk_searchForm;
var master_jual_produk_searchWindow;
var master_jual_produk_SelectedRow;
var master_jual_produk_ContextMenu;
//for detail data
var detail_jual_produk_DataStore;
var detail_jual_produkListEditorGrid;
var detail_jual_produk_ColumnModel;
var detail_jual_produk_proxy;
var detail_jual_produk_writer;
var detail_jual_produk_reader;
var editor_detail_jual_produk;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var jproduk_idField;
var jproduk_nobuktiField;
var jproduk_custField;
var jproduk_tanggalField;
var jproduk_diskonField;
var jproduk_bayarField;
var jproduk_caraField;
var jproduk_cara2Field;
var jproduk_cara3Field;
var jproduk_keteranganField;
//tunai
var jproduk_tunai_nilaiField;
//tunai-2
var jproduk_tunai_nilai2Field;
//tunai-3
var jproduk_tunai_nilai3Field;
//voucher
var jproduk_voucher_noField;
var jproduk_voucher_cashbackField;
//voucher-2
var jproduk_voucher_no2Field;
var jproduk_voucher_cashback2Field;
//voucher-3
var jproduk_voucher_no3Field;
var jproduk_voucher_cashback3Field;

var jproduk_cashbackField;
var is_member=false;
//kwitansi
var jproduk_kwitansi_namaField;
var jproduk_kwitansi_nilaiField;
var jproduk_kwitansi_noField;
//kwitansi-2
var jproduk_kwitansi_nama2Field;
var jproduk_kwitansi_nilai2Field;
var jproduk_kwitansi_no2Field;
//kwitansi-3
var jproduk_kwitansi_nama3Field;
var jproduk_kwitansi_nilai3Field;
var jproduk_kwitansi_no3Field;

//card
var jproduk_card_namaField;
var jproduk_card_edcField;
var jproduk_card_noField;
var jproduk_card_nilaiField;
//card-2
var jproduk_card_nama2Field;
var jproduk_card_edc2Field;
var jproduk_card_no2Field;
var jproduk_card_nilai2Field;
//card-3
var jproduk_card_nama3Field;
var jproduk_card_edc3Field;
var jproduk_card_no3Field;
var jproduk_card_nilai3Field;

//cek
var jproduk_cek_namaField;
var jproduk_cek_noField;
var jproduk_cek_validField;
var jproduk_cek_bankField;
var jproduk_cek_nilaiField;
//cek-2
var jproduk_cek_nama2Field;
var jproduk_cek_no2Field;
var jproduk_cek_valid2Field;
var jproduk_cek_bank2Field;
var jproduk_cek_nilai2Field;
//cek-3
var jproduk_cek_nama3Field;
var jproduk_cek_no3Field;
var jproduk_cek_valid3Field;
var jproduk_cek_bank3Field;
var jproduk_cek_nilai3Field;

//transfer
var jproduk_transfer_bankField;
var jproduk_transfer_namaField;
var jproduk_transfer_nilaiField;
//transfer-2
var jproduk_transfer_bank2Field;
var jproduk_transfer_nama2Field;
var jproduk_transfer_nilai2Field;
//transfer-3
var jproduk_transfer_bank3Field;
var jproduk_transfer_nama3Field;
var jproduk_transfer_nilai3Field;

var jproduk_idSearchField;
var jproduk_nobuktiSearchField;
var jproduk_custSearchField;
var jproduk_tanggalSearchField;
var jproduk_diskonSearchField;
var jproduk_caraSearchField;
var jproduk_keteranganSearchField;
var dt= new Date();

var printed=0;
var looping=0;
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
	function master_jual_produk_update(oGrid_event){
		var jproduk_id_update_pk="";
		var jproduk_nobukti_update=null;
		var jproduk_cust_update=null;
		var jproduk_tanggal_update_date="";
		var jproduk_diskon_update=null;
		var jproduk_cara_update=null;
		var jproduk_keterangan_update=null;

		jproduk_id_update_pk = oGrid_event.record.data.jproduk_id;
		if(oGrid_event.record.data.jproduk_nobukti!== null){jproduk_nobukti_update = oGrid_event.record.data.jproduk_nobukti;}
		if(oGrid_event.record.data.jproduk_cust!== null){jproduk_cust_update = oGrid_event.record.data.jproduk_cust;}
	 	if(oGrid_event.record.data.jproduk_tanggal!== ""){jproduk_tanggal_update_date =oGrid_event.record.data.jproduk_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jproduk_diskon!== null){jproduk_diskon_update = oGrid_event.record.data.jproduk_diskon;}
		if(oGrid_event.record.data.jproduk_cara!== null){jproduk_cara_update = oGrid_event.record.data.jproduk_cara;}
		if(oGrid_event.record.data.jproduk_keterangan!== null){jproduk_keterangan_update = oGrid_event.record.data.jproduk_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jual_produk&m=get_action',
			params: {
				task: "UPDATE",
				jproduk_id	: jproduk_id_update_pk, 
				jproduk_nobukti	:jproduk_nobukti_update,  
				jproduk_cust	:jproduk_cust_update,  
				jproduk_tanggal	: jproduk_tanggal_update_date, 
				jproduk_diskon	:jproduk_diskon_update,  
				jproduk_cara	:jproduk_cara_update,  
				jproduk_keterangan	:jproduk_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_jual_produk_DataStore.commitChanges();
						master_jual_produk_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data master_jual_produk tidak bisa disimpan',
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
	function master_jual_produk_create(){
		var dproduk_produk_id="";
		for(i=0; i<detail_jual_produk_DataStore.getCount(); i++){
			detail_jual_produk_record=detail_jual_produk_DataStore.getAt(i);
			if(/^\d+$/.test(detail_jual_produk_record.data.dproduk_produk)){
				dproduk_produk_id="ada";
			}
		}
	
		if(is_master_jual_produk_form_valid() && dproduk_produk_id=="ada" && (/^\d+$/.test(jproduk_custField.getValue()) || get_pk_id())){	
		var jproduk_id_create_pk=null; 
		var jproduk_nobukti_create=null; 
		var jproduk_cust_create=null; 
		var jproduk_tanggal_create_date=""; 
		var jproduk_diskon_create=null; 
		var jproduk_cara_create=null; 
		var jproduk_cara2_create=null; 
		var jproduk_cara3_create=null; 
		var jproduk_keterangan_create=null; 
		//tunai
		var jproduk_tunai_nilai_create=null;
		//tunai-2
		var jproduk_tunai_nilai2_create=null;
		//tunai-3
		var jproduk_tunai_nilai3_create=null;
		//voucher
		var jproduk_voucher_no_create="";
		var jproduk_voucher_cashback_create=null;
		//voucher-2
		var jproduk_voucher_no2_create="";
		var jproduk_voucher_cashback2_create=null;
		//voucher-3
		var jproduk_voucher_no3_create="";
		var jproduk_voucher_cashback3_create=null;
		
		var jproduk_cashback_create=null;
		//bayar
		var jproduk_subtotal_create=null;
		var jproduk_bayar_create=null;
		var jproduk_hutang_create=null;
		//kwitansi
		var jproduk_kwitansi_nama_create="";
		var jproduk_kwitansi_nomor_create="";
		var jproduk_kwitansi_nilai_create=null;
		//kwitansi-2
		var jproduk_kwitansi_nama2_create="";
		var jproduk_kwitansi_nomor2_create="";
		var jproduk_kwitansi_nilai2_create=null;
		//kwitansi-3
		var jproduk_kwitansi_nama3_create="";
		var jproduk_kwitansi_nomor3_create="";
		var jproduk_kwitansi_nilai3_create=null;
		//card
		var jproduk_card_nama_create="";
		var jproduk_card_edc_create="";
		var jproduk_card_no_create="";
		var jproduk_card_nilai_create=null;
		//card-2
		var jproduk_card_nama2_create="";
		var jproduk_card_edc2_create="";
		var jproduk_card_no2_create="";
		var jproduk_card_nilai2_create=null;
		//card-3
		var jproduk_card_nama3_create="";
		var jproduk_card_edc3_create="";
		var jproduk_card_no3_create="";
		var jproduk_card_nilai3_create=null;
		//cek
		var jproduk_cek_nama_create=null;
		var jproduk_cek_nomor_create="";
		var jproduk_cek_valid_create="";
		var jproduk_cek_bank_create="";
		var jproduk_cek_nilai_create=null;
		//cek-2
		var jproduk_cek_nama2_create=null;
		var jproduk_cek_nomor2_create="";
		var jproduk_cek_valid2_create="";
		var jproduk_cek_bank2_create="";
		var jproduk_cek_nilai2_create=null;
		//cek-3
		var jproduk_cek_nama3_create=null;
		var jproduk_cek_nomor3_create="";
		var jproduk_cek_valid3_create="";
		var jproduk_cek_bank3_create="";
		var jproduk_cek_nilai3_create=null;
		//transfer
		var jproduk_transfer_bank_create="";
		var jproduk_transfer_nama_create=null;
		var jproduk_transfer_nilai_create=null;
		//transfer-2
		var jproduk_transfer_bank2_create="";
		var jproduk_transfer_nama2_create=null;
		var jproduk_transfer_nilai2_create=null;
		//transfer-3
		var jproduk_transfer_bank3_create="";
		var jproduk_transfer_nama3_create=null;
		var jproduk_transfer_nilai3_create=null;

		if(jproduk_idField.getValue()!== null){jproduk_id_create_pk = jproduk_idField.getValue();}else{jproduk_id_create_pk=get_pk_id();} 
		if(jproduk_nobuktiField.getValue()!== null){jproduk_nobukti_create = jproduk_nobuktiField.getValue();} 
		if(jproduk_custField.getValue()!== null){jproduk_cust_create = jproduk_custField.getValue();} 
		if(jproduk_tanggalField.getValue()!== ""){jproduk_tanggal_create_date = jproduk_tanggalField.getValue().format('Y-m-d');} 
		if(jproduk_diskonField.getValue()!== null){jproduk_diskon_create = jproduk_diskonField.getValue();} 
		if(jproduk_caraField.getValue()!== null){jproduk_cara_create = jproduk_caraField.getValue();} 
		if(jproduk_cara2Field.getValue()!== null){jproduk_cara2_create = jproduk_cara2Field.getValue();} 
		if(jproduk_cara3Field.getValue()!== null){jproduk_cara3_create = jproduk_cara3Field.getValue();} 
		if(jproduk_keteranganField.getValue()!== null){jproduk_keterangan_create = jproduk_keteranganField.getValue();} 
		//tunai
		if(jproduk_tunai_nilaiField.getValue()!== null){jproduk_tunai_nilai_create = jproduk_tunai_nilaiField.getValue();}
		//tunai-2
		if(jproduk_tunai_nilai2Field.getValue()!== null){jproduk_tunai_nilai2_create = jproduk_tunai_nilai2Field.getValue();}
		//tunai-3
		if(jproduk_tunai_nilai3Field.getValue()!== null){jproduk_tunai_nilai3_create = jproduk_tunai_nilai3Field.getValue();}
		//voucher
		if(jproduk_voucher_noField.getValue()!== ""){jproduk_voucher_no_create = jproduk_voucher_noField.getValue();}
		if(jproduk_voucher_cashbackField.getValue()!== null){jproduk_voucher_cashback_create = jproduk_voucher_cashbackField.getValue();} 
		//voucher-2
		if(jproduk_voucher_no2Field.getValue()!== ""){jproduk_voucher_no2_create = jproduk_voucher_no2Field.getValue();} 
		if(jproduk_voucher_cashback2Field.getValue()!== null){jproduk_voucher_cashback2_create = jproduk_voucher_cashback2Field.getValue();} 
		//voucher-3
		if(jproduk_voucher_no3Field.getValue()!== ""){jproduk_voucher_no3_create = jproduk_voucher_no3Field.getValue();} 
		if(jproduk_voucher_cashback3Field.getValue()!== null){jproduk_voucher_cashback3_create = jproduk_voucher_cashback3Field.getValue();} 
		
		if(jproduk_cashbackField.getValue()!== null){jproduk_cashback_create = jproduk_cashbackField.getValue();} 
		//bayar
		if(jproduk_bayarField.getValue()!== null){jproduk_bayar_create = jproduk_bayarField.getValue();}
		if(jproduk_subTotalField.getValue()!== null){jproduk_subtotal_create = jproduk_subTotalField.getValue();} 
		if(jproduk_hutangField.getValue()!== null){jproduk_hutang_create = jproduk_hutangField.getValue();} 
		//kwitansi value
		if(jproduk_kwitansi_noField.getValue()!== ""){jproduk_kwitansi_nomor_create = jproduk_kwitansi_noField.getValue();} 
		if(jproduk_kwitansi_namaField.getValue()!== ""){jproduk_kwitansi_nama_create = jproduk_kwitansi_namaField.getValue();} 
		if(jproduk_kwitansi_nilaiField.getValue()!== null){jproduk_kwitansi_nilai_create = jproduk_kwitansi_nilaiField.getValue();} 
		//kwitansi-2 value
		if(jproduk_kwitansi_no2Field.getValue()!== ""){jproduk_kwitansi_nomor2_create = jproduk_kwitansi_no2Field.getValue();} 
		if(jproduk_kwitansi_nama2Field.getValue()!== ""){jproduk_kwitansi_nama2_create = jproduk_kwitansi_nama2Field.getValue();} 
		if(jproduk_kwitansi_nilai2Field.getValue()!== null){jproduk_kwitansi_nilai2_create = jproduk_kwitansi_nilai2Field.getValue();} 
		//kwitansi-3 value
		if(jproduk_kwitansi_no3Field.getValue()!== ""){jproduk_kwitansi_nomor3_create = jproduk_kwitansi_no3Field.getValue();} 
		if(jproduk_kwitansi_nama3Field.getValue()!== ""){jproduk_kwitansi_nama3_create = jproduk_kwitansi_nama3Field.getValue();} 
		if(jproduk_kwitansi_nilai3Field.getValue()!== null){jproduk_kwitansi_nilai3_create = jproduk_kwitansi_nilai3Field.getValue();} 
		//card value
		if(jproduk_card_namaField.getValue()!== ""){jproduk_card_nama_create = jproduk_card_namaField.getValue();} 
		if(jproduk_card_edcField.getValue()!==""){jproduk_card_edc_create = jproduk_card_edcField.getValue();} 
		if(jproduk_card_noField.getValue()!==""){jproduk_card_no_create = jproduk_card_noField.getValue();}
		if(jproduk_card_nilaiField.getValue()!==null){jproduk_card_nilai_create = jproduk_card_nilaiField.getValue();} 
		//card-2 value
		if(jproduk_card_nama2Field.getValue()!== ""){jproduk_card_nama2_create = jproduk_card_nama2Field.getValue();} 
		if(jproduk_card_edc2Field.getValue()!==""){jproduk_card_edc2_create = jproduk_card_edc2Field.getValue();} 
		if(jproduk_card_no2Field.getValue()!==""){jproduk_card_no2_create = jproduk_card_no2Field.getValue();}
		if(jproduk_card_nilai2Field.getValue()!==null){jproduk_card_nilai2_create = jproduk_card_nilai2Field.getValue();} 
		//card-3 value
		if(jproduk_card_nama3Field.getValue()!== ""){jproduk_card_nama3_create = jproduk_card_nama3Field.getValue();} 
		if(jproduk_card_edc3Field.getValue()!==""){jproduk_card_edc3_create = jproduk_card_edc3Field.getValue();} 
		if(jproduk_card_no3Field.getValue()!==""){jproduk_card_no3_create = jproduk_card_no3Field.getValue();}
		if(jproduk_card_nilai3Field.getValue()!==null){jproduk_card_nilai3_create = jproduk_card_nilai3Field.getValue();} 
		//cek value
		if(jproduk_cek_namaField.getValue()!== null){jproduk_cek_nama_create = jproduk_cek_namaField.getValue();} 
		if(jproduk_cek_noField.getValue()!== ""){jproduk_cek_nomor_create = jproduk_cek_noField.getValue();} 
		if(jproduk_cek_validField.getValue()!== ""){jproduk_cek_valid_create = jproduk_cek_validField.getValue().format('Y-m-d');} 
		if(jproduk_cek_bankField.getValue()!== ""){jproduk_cek_bank_create = jproduk_cek_bankField.getValue();} 
		if(jproduk_cek_nilaiField.getValue()!== null){jproduk_cek_nilai_create = jproduk_cek_nilaiField.getValue();} 
		//cek-2 value
		if(jproduk_cek_nama2Field.getValue()!== null){jproduk_cek_nama2_create = jproduk_cek_nama2Field.getValue();} 
		if(jproduk_cek_no2Field.getValue()!== ""){jproduk_cek_nomor2_create = jproduk_cek_no2Field.getValue();} 
		if(jproduk_cek_valid2Field.getValue()!== ""){jproduk_cek_valid2_create = jproduk_cek_valid2Field.getValue().format('Y-m-d');} 
		if(jproduk_cek_bank2Field.getValue()!== ""){jproduk_cek_bank2_create = jproduk_cek_bank2Field.getValue();} 
		if(jproduk_cek_nilai2Field.getValue()!== null){jproduk_cek_nilai2_create = jproduk_cek_nilai2Field.getValue();} 
		//cek-3 value
		if(jproduk_cek_nama3Field.getValue()!== null){jproduk_cek_nama3_create = jproduk_cek_nama3Field.getValue();} 
		if(jproduk_cek_no3Field.getValue()!== ""){jproduk_cek_nomor3_create = jproduk_cek_no3Field.getValue();} 
		if(jproduk_cek_valid3Field.getValue()!== ""){jproduk_cek_valid3_create = jproduk_cek_valid3Field.getValue().format('Y-m-d');} 
		if(jproduk_cek_bank3Field.getValue()!== ""){jproduk_cek_bank3_create = jproduk_cek_bank3Field.getValue();} 
		if(jproduk_cek_nilai3Field.getValue()!== null){jproduk_cek_nilai3_create = jproduk_cek_nilai3Field.getValue();} 
		//transfer value
		if(jproduk_transfer_bankField.getValue()!== ""){jproduk_transfer_bank_create = jproduk_transfer_bankField.getValue();} 
		if(jproduk_transfer_namaField.getValue()!== null){jproduk_transfer_nama_create = jproduk_transfer_namaField.getValue();}
		if(jproduk_transfer_nilaiField.getValue()!== null){jproduk_transfer_nilai_create = jproduk_transfer_nilaiField.getValue();} 
		//transfer-2 value
		if(jproduk_transfer_bank2Field.getValue()!== ""){jproduk_transfer_bank2_create = jproduk_transfer_bank2Field.getValue();} 
		if(jproduk_transfer_nama2Field.getValue()!== null){jproduk_transfer_nama2_create = jproduk_transfer_nama2Field.getValue();}
		if(jproduk_transfer_nilai2Field.getValue()!== null){jproduk_transfer_nilai2_create = jproduk_transfer_nilai2Field.getValue();} 
		//transfer-3 value
		if(jproduk_transfer_bank3Field.getValue()!== ""){jproduk_transfer_bank3_create = jproduk_transfer_bank3Field.getValue();} 
		if(jproduk_transfer_nama3Field.getValue()!== null){jproduk_transfer_nama3_create = jproduk_transfer_nama3Field.getValue();}
		if(jproduk_transfer_nilai3Field.getValue()!== null){jproduk_transfer_nilai3_create = jproduk_transfer_nilai3Field.getValue();} 
		
		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jual_produk&m=get_action',
			params: {
				task: post2db,
				jproduk_id			: 	jproduk_id_create_pk, 
				jproduk_nobukti		: 	jproduk_nobukti_create, 
				jproduk_cust		: 	jproduk_cust_create, 
				jproduk_tanggal		: 	jproduk_tanggal_create_date, 
				jproduk_diskon		: 	jproduk_diskon_create, 
				jproduk_cara		: 	jproduk_cara_create, 
				jproduk_cara2		: 	jproduk_cara2_create, 
				jproduk_cara3		: 	jproduk_cara3_create, 
				jproduk_keterangan	: 	jproduk_keterangan_create, 
				jproduk_cashback	: 	jproduk_cashback_create,
				//tunai
				jproduk_tunai_nilai	:	jproduk_tunai_nilai_create,
				//tunai-2
				jproduk_tunai_nilai2	:	jproduk_tunai_nilai2_create,
				//tunai-3
				jproduk_tunai_nilai3	:	jproduk_tunai_nilai3_create,
				//voucher
				jproduk_voucher_no	:	jproduk_voucher_no_create,
				jproduk_voucher_cashback	:	jproduk_voucher_cashback_create,
				//voucher-2
				jproduk_voucher_no2	:	jproduk_voucher_no2_create,
				jproduk_voucher_cashback2	:	jproduk_voucher_cashback2_create,
				//voucher-3
				jproduk_voucher_no3	:	jproduk_voucher_no3_create,
				jproduk_voucher_cashback3	:	jproduk_voucher_cashback3_create,
				
				//bayar
				jproduk_bayar			: 	jproduk_bayar_create,
				jproduk_subtotal			: 	jproduk_subtotal_create,
				jproduk_hutang		: 	jproduk_hutang_create,
				//kwitansi posting
				jproduk_kwitansi_no		:	jproduk_kwitansi_nomor_create,
				jproduk_kwitansi_nama		:	jproduk_kwitansi_nama_create,
				jproduk_kwitansi_nilai		:	jproduk_kwitansi_nilai_create,
				//kwitansi-2 posting
				jproduk_kwitansi_no2		:	jproduk_kwitansi_nomor2_create,
				jproduk_kwitansi_nama2		:	jproduk_kwitansi_nama2_create,
				jproduk_kwitansi_nilai2		:	jproduk_kwitansi_nilai2_create,
				//kwitansi-3 posting
				jproduk_kwitansi_no3		:	jproduk_kwitansi_nomor3_create,
				jproduk_kwitansi_nama3		:	jproduk_kwitansi_nama3_create,
				jproduk_kwitansi_nilai3		:	jproduk_kwitansi_nilai3_create,
				//card posting
				jproduk_card_nama	: 	jproduk_card_nama_create,
				jproduk_card_edc	:	jproduk_card_edc_create,
				jproduk_card_no		:	jproduk_card_no_create,
				jproduk_card_nilai	:	jproduk_card_nilai_create,
				//card-2 posting
				jproduk_card_nama2	: 	jproduk_card_nama2_create,
				jproduk_card_edc2	:	jproduk_card_edc2_create,
				jproduk_card_no2	:	jproduk_card_no2_create,
				jproduk_card_nilai2	:	jproduk_card_nilai2_create,
				//card-3 posting
				jproduk_card_nama3	: 	jproduk_card_nama3_create,
				jproduk_card_edc3	:	jproduk_card_edc3_create,
				jproduk_card_no3	:	jproduk_card_no3_create,
				jproduk_card_nilai3	:	jproduk_card_nilai3_create,
				//cek posting
				jproduk_cek_nama	: 	jproduk_cek_nama_create,
				jproduk_cek_no		:	jproduk_cek_nomor_create,
				jproduk_cek_valid	: 	jproduk_cek_valid_create,
				jproduk_cek_bank	:	jproduk_cek_bank_create,
				jproduk_cek_nilai	:	jproduk_cek_nilai_create,
				//cek-2 posting
				jproduk_cek_nama2	: 	jproduk_cek_nama2_create,
				jproduk_cek_no2		:	jproduk_cek_nomor2_create,
				jproduk_cek_valid2	: 	jproduk_cek_valid2_create,
				jproduk_cek_bank2	:	jproduk_cek_bank2_create,
				jproduk_cek_nilai2	:	jproduk_cek_nilai2_create,
				//cek-3 posting
				jproduk_cek_nama3	: 	jproduk_cek_nama3_create,
				jproduk_cek_no3		:	jproduk_cek_nomor3_create,
				jproduk_cek_valid3	: 	jproduk_cek_valid3_create,
				jproduk_cek_bank3	:	jproduk_cek_bank3_create,
				jproduk_cek_nilai3	:	jproduk_cek_nilai3_create,
				//transfer posting
				jproduk_transfer_bank	:	jproduk_transfer_bank_create,
				jproduk_transfer_nama	:	jproduk_transfer_nama_create,
				jproduk_transfer_nilai	:	jproduk_transfer_nilai_create,
				//transfer-2 posting
				jproduk_transfer_bank2	:	jproduk_transfer_bank2_create,
				jproduk_transfer_nama2	:	jproduk_transfer_nama2_create,
				jproduk_transfer_nilai2	:	jproduk_transfer_nilai2_create,
				//transfer-3 posting
				jproduk_transfer_bank3	:	jproduk_transfer_bank3_create,
				jproduk_transfer_nama3	:	jproduk_transfer_nama3_create,
				jproduk_transfer_nilai3	:	jproduk_transfer_nilai3_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_jual_produk_purge();
						//detail_jual_produk_insert();
						//Ext.MessageBox.alert(post2db+' OK','The Master_jual_produk was '+msg+' successfully.');
						Ext.MessageBox.alert(post2db+' OK','Data penjualan produk berhasil disimpan');
						//master_jual_produk_DataStore.reload();
						detail_jual_produk_DataStore.load({params: {master_id:0}});
						master_jual_produk_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   //msg: 'We could\'t not '+msg+' the Master_jual_produk.',
						   msg: 'Data penjualan produk tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
				}
				if(printed==1)
					master_jual_produk_print();
				master_jual_produk_reset_allForm();
				master_cara_bayarTabPanel.setActiveTab(0);
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
			if(dproduk_produk_id!="ada"){
				Ext.MessageBox.show({
					title: 'Warning',
					//msg: 'Detail Penjualan Produk <br>harus Ada!.',
					msg: 'Detail penjualan produk tidak boleh kosong',
					buttons: Ext.MessageBox.OK,
					minWidth: 250,
					animEl: 'save',
					icon: Ext.MessageBox.WARNING
				});
			}else {
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Form anda belum lengkap',
					buttons: Ext.MessageBox.OK,
					animEl: 'save',
					icon: Ext.MessageBox.WARNING
				});
			}
		}
	}
 	/* End of Function */
	
	function save_andPrint(){
		printed=1;
		master_jual_produk_create();
	}
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='UPDATE')
			return master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	// Reset kwitansi option
	function kwitansi_jual_produk_reset_form(){
		jproduk_kwitansi_namaField.reset();
		jproduk_kwitansi_nilaiField.reset();
		jproduk_kwitansi_noField.reset();
		jproduk_kwitansi_namaField.setValue("");
		jproduk_kwitansi_nilai2Field.setValue(null);
		jproduk_kwitansi_no2Field.setValue("");
	}
	// Reset kwitansi-2 option
	function kwitansi2_jual_produk_reset_form(){
		jproduk_kwitansi_nama2Field.reset();
		jproduk_kwitansi_nilai2Field.reset();
		jproduk_kwitansi_no2Field.reset();
		jproduk_kwitansi_nama2Field.setValue("");
		jproduk_kwitansi_nilai2Field.setValue(null);
		jproduk_kwitansi_no2Field.setValue("");
	}
	// Reset kwitansi-3 option
	function kwitansi3_jual_produk_reset_form(){
		jproduk_kwitansi_nama3Field.reset();
		jproduk_kwitansi_nilai3Field.reset();
		jproduk_kwitansi_no3Field.reset();
		jproduk_kwitansi_nama3Field.setValue("");
		jproduk_kwitansi_nilai3Field.setValue(null);
		jproduk_kwitansi_no3Field.setValue("");
	}
	
	// Reset card option
	function card_jual_produk_reset_form(){
		jproduk_card_namaField.reset();
		jproduk_card_edcField.reset();
		jproduk_card_noField.reset();
		jproduk_card_nilaiField.reset();
		jproduk_card_namaField.setValue("");
		jproduk_card_edcField.setValue("");
		jproduk_card_noField.setValue("");
		jproduk_card_nilai2Field.setValue(null);
	}
	// Reset card-2 option
	function card2_jual_produk_reset_form(){
		jproduk_card_nama2Field.reset();
		jproduk_card_edc2Field.reset();
		jproduk_card_no2Field.reset();
		jproduk_card_nilai2Field.reset();
		jproduk_card_nama2Field.setValue("");
		jproduk_card_edc2Field.setValue("");
		jproduk_card_no2Field.setValue("");
		jproduk_card_nilai2Field.setValue(null);
	}
	// Reset card-3 option
	function card3_jual_produk_reset_form(){
		jproduk_card_nama3Field.reset();
		jproduk_card_edc3Field.reset();
		jproduk_card_no3Field.reset();
		jproduk_card_nilai3Field.reset();
		jproduk_card_nama3Field.setValue("");
		jproduk_card_edc3Field.setValue("");
		jproduk_card_no3Field.setValue("");
		jproduk_card_nilai3Field.setValue(null);
	}
	
	// Reset cek option
	function cek_jual_produk_reset_form(){
		jproduk_cek_namaField.reset();
		jproduk_cek_noField.reset();
		jproduk_cek_validField.reset();
		jproduk_cek_bankField.reset();
		jproduk_cek_nilaiField.reset();
		jproduk_cek_namaField.setValue(null);
		jproduk_cek_noField.setValue("");
		jproduk_cek_validField.setValue("");
		jproduk_cek_bankField.setValue("");
		jproduk_cek_nilaiField.setValue(null);
	}
	// Reset cek-2 option
	function cek2_jual_produk_reset_form(){
		jproduk_cek_nama2Field.reset();
		jproduk_cek_no2Field.reset();
		jproduk_cek_valid2Field.reset();
		jproduk_cek_bank2Field.reset();
		jproduk_cek_nilai2Field.reset();
		jproduk_cek_nama2Field.setValue(null);
		jproduk_cek_no2Field.setValue("");
		jproduk_cek_valid2Field.setValue("");
		jproduk_cek_bank2Field.setValue("");
		jproduk_cek_nilai2Field.setValue(null);
	}
	// Reset cek-3 option
	function cek3_jual_produk_reset_form(){
		jproduk_cek_nama3Field.reset();
		jproduk_cek_no3Field.reset();
		jproduk_cek_valid3Field.reset();
		jproduk_cek_bank3Field.reset();
		jproduk_cek_nilai3Field.reset();
		jproduk_cek_nama3Field.setValue(null);
		jproduk_cek_no3Field.setValue("");
		jproduk_cek_valid3Field.setValue("");
		jproduk_cek_bank3Field.setValue("");
		jproduk_cek_nilai3Field.setValue(null);
	}
	
	// Reset transfer option
	function transfer_jual_produk_reset_form(){
		jproduk_transfer_bankField.reset();
		jproduk_transfer_namaField.reset();
		jproduk_transfer_nilaiField.reset();
		jproduk_transfer_bankField.setValue("");
		jproduk_transfer_namaField.setValue(null);
		jproduk_transfer_nilaiField.setValue(null);
	}
	// Reset transfer-2 option
	function transfer2_jual_produk_reset_form(){
		jproduk_transfer_bank2Field.reset();
		jproduk_transfer_nama2Field.reset();
		jproduk_transfer_nilai2Field.reset();
		jproduk_transfer_bank2Field.setValue("");
		jproduk_transfer_nama2Field.setValue(null);
		jproduk_transfer_nilai2Field.setValue(null);
	}
	// Reset transfer-3 option
	function transfer3_jual_produk_reset_form(){
		jproduk_transfer_bank3Field.reset();
		jproduk_transfer_nama3Field.reset();
		jproduk_transfer_nilai3Field.reset();
		jproduk_transfer_bank3Field.setValue("");
		jproduk_transfer_nama3Field.setValue(null);
		jproduk_transfer_nilai3Field.setValue(null);
	}

	// Reset tunai option
	function tunai_jual_produk_reset_form(){
		jproduk_tunai_nilaiField.reset();
		jproduk_tunai_nilaiField.setValue(null);
	}
	// Reset tunai-2 option
	function tunai2_jual_produk_reset_form(){
		jproduk_tunai_nilai2Field.reset();
		jproduk_tunai_nilai2Field.setValue(null);
	}
	// Reset tunai-3 option
	function tunai3_jual_produk_reset_form(){
		jproduk_tunai_nilai3Field.reset();
		jproduk_tunai_nilai3Field.setValue(null);
	}

	//Reset voucher option
	function voucher_jual_produk_reset_form(){
		jproduk_voucher_noField.reset();
		jproduk_voucher_cashbackField.reset();
		jproduk_voucher_noField.setValue("");
		jproduk_voucher_cashbackField.setValue(null);
	}
	//Reset voucher-2 option
	function voucher2_jual_produk_reset_form(){
		jproduk_voucher_no2Field.reset();
		jproduk_voucher_cashback2Field.reset();
		jproduk_voucher_no2Field.setValue("");
		jproduk_voucher_cashback2Field.setValue(null);
	}
	//Reset voucher-3 option
	function voucher3_jual_produk_reset_form(){
		jproduk_voucher_no3Field.reset();
		jproduk_voucher_cashback3Field.reset();
		jproduk_voucher_no3Field.setValue("");
		jproduk_voucher_cashback3Field.setValue(null);
	}
	
	/* Reset form before loading */
	function master_jual_produk_reset_form(){
		jproduk_idField.reset();
		jproduk_idField.setValue(null);
		jproduk_nobuktiField.reset();
		jproduk_nobuktiField.setValue(null);
		jproduk_custField.reset();
		jproduk_custField.setValue(null);
		jproduk_tanggalField.setValue(dt.format('Y-m-d'));
		jproduk_diskonField.reset();
		jproduk_diskonField.setValue(null);
		jproduk_caraField.reset();
		jproduk_caraField.setValue(null);
		jproduk_cara2Field.reset();
		jproduk_cara2Field.setValue(null);
		jproduk_cara3Field.reset();
		jproduk_cara3Field.setValue(null);
		jproduk_cashbackField.reset();
		jproduk_cashbackField.setValue(null);
		
		jproduk_keteranganField.reset();
		jproduk_keteranganField.setValue(null);

		jproduk_subTotalField.reset();
		jproduk_subTotalField.setValue(null);

		jproduk_totalField.reset();
		jproduk_totalField.setValue(null);

		jproduk_hutangField.reset();
		jproduk_hutangField.setValue(null);

		jproduk_jumlahField.reset();
		jproduk_jumlahField.setValue(null);

		tunai_jual_produk_reset_form();
		tunai2_jual_produk_reset_form();
		tunai3_jual_produk_reset_form();

		kwitansi_jual_produk_reset_form();
		kwitansi2_jual_produk_reset_form();
		kwitansi3_jual_produk_reset_form();

		card_jual_produk_reset_form();
		card2_jual_produk_reset_form();
		card3_jual_produk_reset_form();

		cek_jual_produk_reset_form();
		cek2_jual_produk_reset_form();
		cek3_jual_produk_reset_form();

		transfer_jual_produk_reset_form();
		transfer2_jual_produk_reset_form();
		transfer3_jual_produk_reset_form();

		voucher_jual_produk_reset_form();
		voucher2_jual_produk_reset_form();
		voucher3_jual_produk_reset_form();

		update_group_carabayar_jual_produk();
		update_group_carabayar2_jual_produk();
		update_group_carabayar3_jual_produk();
		//load_total_produk_bayar();

		jproduk_bayarField.reset();
		jproduk_bayarField.setValue(null);
	}
 	/* End of Function */
	
	function master_jual_produk_reset_allForm(){
		master_jual_produk_reset_form();
		
	}
    
	/* setValue to EDIT */
	function master_jual_produk_set_form(){
		master_jual_produk_reset_form();
		jproduk_idField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_id'));
		jproduk_nobuktiField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_nobukti'));
		jproduk_custField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_cust'));
		jproduk_tanggalField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_tanggal'));
		jproduk_diskonField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_diskon'));
		jproduk_cashbackField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_cashback'));
		jproduk_caraField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_cara'));
		jproduk_cara2Field.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_cara2'));
		jproduk_cara3Field.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_cara3'));
		jproduk_bayarField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_bayar'));

		jproduk_keteranganField.setValue(master_jual_produkListEditorGrid.getSelectionModel().getSelected().get('jproduk_keterangan'));
		load_membership();
		update_group_carabayar_jual_produk();
		update_group_carabayar2_jual_produk();
		update_group_carabayar3_jual_produk();
		
		switch(jproduk_caraField.getValue()){
			case 'kwitansi':
				kwitansi_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_produk_DataStore.getCount()){
								jproduk_kwitansi_record=kwitansi_jual_produk_DataStore.getAt(0).data;
								jproduk_kwitansi_noField.setValue(jproduk_kwitansi_record.jkwitansi_no);
								jproduk_kwitansi_namaField.setValue(jproduk_kwitansi_record.jkwitansi_nama);
								jproduk_kwitansi_nilaiField.setValue(jproduk_kwitansi_record.jkwitansi_nilai);
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							if(card_jual_produk_DataStore.getCount()){
								jproduk_card_record=card_jual_produk_DataStore.getAt(0).data;
								jproduk_card_namaField.setValue(jproduk_card_record.jcard_nama);
								jproduk_card_edcField.setValue(jproduk_card_record.jcard_edc);
								jproduk_card_noField.setValue(jproduk_card_record.jcard_no);
								jproduk_card_nilaiField.setValue(jproduk_card_record.jcard_nilai);
							}
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_produk_DataStore.getCount()){
									jproduk_cek_record=cek_jual_produk_DataStore.getAt(0).data;
									jproduk_cek_namaField.setValue(jproduk_cek_record.jcek_nama);
									jproduk_cek_noField.setValue(jproduk_cek_record.jcek_no);
									jproduk_cek_validField.setValue(jproduk_cek_record.jcek_valid);
									jproduk_cek_bankField.setValue(jproduk_cek_record.jcek_bank);
									jproduk_cek_nilaiField.setValue(jproduk_cek_record.jcek_nilai);
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jual_produk_DataStore.load({
						params : { no_faktur: jproduk_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(transfer_jual_produk_DataStore.getCount()){
										jproduk_transfer_record=transfer_jual_produk_DataStore.getAt(0);
										jproduk_transfer_bankField.setValue(jproduk_transfer_record.data.jtransfer_bank);
										jproduk_transfer_namaField.setValue(jproduk_transfer_record.data.jtransfer_nama);
										jproduk_transfer_nilaiField.setValue(jproduk_transfer_record.data.jtransfer_nilai);
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_produk_DataStore.load({
						params : { no_faktur: jproduk_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_produk_DataStore.getCount()){
										jproduk_tunai_record=tunai_jual_produk_DataStore.getAt(0);
										jproduk_tunai_nilaiField.setValue(jproduk_tunai_record.data.jtunai_nilai);
									}
							}
					 	}
				  });
				break;
		}

		switch(jproduk_cara2Field.getValue()){
			case 'kwitansi':
				kwitansi_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_produk_DataStore.getCount()){
								jproduk_kwitansi_record=kwitansi_jual_produk_DataStore.getAt(0).data;
								jproduk_kwitansi_no2Field.setValue(jproduk_kwitansi_record.jkwitansi_no);
								jproduk_kwitansi_nama2Field.setValue(jproduk_kwitansi_record.jkwitansi_nama);
								jproduk_kwitansi_nilai2Field.setValue(jproduk_kwitansi_record.jkwitansi_nilai);
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							 if(card_jual_produk_DataStore.getCount()){
								 jproduk_card_record=card_jual_produk_DataStore.getAt(0).data;
								 jproduk_card_nama2Field.setValue(jproduk_card_record.jcard_nama);
								 jproduk_card_edc2Field.setValue(jproduk_card_record.jcard_edc);
								 jproduk_card_no2Field.setValue(jproduk_card_record.jcard_no);
								 jproduk_card_nilai2Field.setValue(jproduk_card_record.jcard_nilai);
							 }
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_produk_DataStore.getCount()){
									jproduk_cek_record=cek_jual_produk_DataStore.getAt(0).data;
									jproduk_cek_nama2Field.setValue(jproduk_cek_record.jcek_nama);
									jproduk_cek_no2Field.setValue(jproduk_cek_record.jcek_no);
									jproduk_cek_valid2Field.setValue(jproduk_cek_record.jcek_valid);
									jproduk_cek_bank2Field.setValue(jproduk_cek_record.jcek_bank);
									jproduk_cek_nilai2Field.setValue(jproduk_cek_record.jcek_nilai);
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jual_produk_DataStore.load({
						params : { no_faktur: jproduk_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
								jproduk_transfer_record=transfer_jual_produk_DataStore.getAt(0);
									if(transfer_jual_produk_DataStore.getCount()){
										jproduk_transfer_record=transfer_jual_produk_DataStore.getAt(0);
										jproduk_transfer_bank2Field.setValue(jproduk_transfer_record.data.jtransfer_bank);
										jproduk_transfer_nama2Field.setValue(jproduk_transfer_record.data.jtransfer_nama);
										jproduk_transfer_nilai2Field.setValue(jproduk_transfer_record.data.jtransfer_nilai);
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_produk_DataStore.load({
						params : { no_faktur: jproduk_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_produk_DataStore.getCount()){
										jproduk_tunai_record=tunai_jual_produk_DataStore.getAt(0);
										jproduk_tunai_nilaiField.setValue(jproduk_tunai_record.data.jtunai_nilai);
									}
							}
					 	}
				  });
				break;
		}

		switch(jproduk_cara3Field.getValue()){
			case 'kwitansi':
				kwitansi_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_produk_DataStore.getCount()){
								jproduk_kwitansi_record=kwitansi_jual_produk_DataStore.getAt(0).data;
								jproduk_kwitansi_no3Field.setValue(jproduk_kwitansi_record.jkwitansi_no);
								jproduk_kwitansi_nama3Field.setValue(jproduk_kwitansi_record.jkwitansi_nama);
								jproduk_kwitansi_nilai3Field.setValue(jproduk_kwitansi_record.jkwitansi_nilai);
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							 if(card_jual_produk_DataStore.getCount()){
								 jproduk_card_record=card_jual_produk_DataStore.getAt(0).data;
								 jproduk_card_nama3Field.setValue(jproduk_card_record.jcard_nama);
								 jproduk_card_edc3Field.setValue(jproduk_card_record.jcard_edc);
								 jproduk_card_no3Field.setValue(jproduk_card_record.jcard_no);
								 jproduk_card_nilai3Field.setValue(jproduk_card_record.jcard_nilai);
							 }
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_produk_DataStore.load({
					params : { no_faktur: jproduk_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_produk_DataStore.getCount()){
									jproduk_cek_record=cek_jual_produk_DataStore.getAt(0).data;
									jproduk_cek_nama3Field.setValue(jproduk_cek_record.jcek_nama);
									jproduk_cek_no3Field.setValue(jproduk_cek_record.jcek_no);
									jproduk_cek_valid3Field.setValue(jproduk_cek_record.jcek_valid);
									jproduk_cek_bank3Field.setValue(jproduk_cek_record.jcek_bank);
									jproduk_cek_nilai3Field.setValue(jproduk_cek_record.jcek_nilai);
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jual_produk_DataStore.load({
						params : { no_faktur: jproduk_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
								jproduk_transfer_record=transfer_jual_produk_DataStore.getAt(0);
									if(transfer_jual_produk_DataStore.getCount()){
										jproduk_transfer_record=transfer_jual_produk_DataStore.getAt(0);
										jproduk_transfer_bank3Field.setValue(jproduk_transfer_record.data.jtransfer_bank);
										jproduk_transfer_nama3Field.setValue(jproduk_transfer_record.data.jtransfer_nama);
										jproduk_transfer_nilai3Field.setValue(jproduk_transfer_record.data.jtransfer_nilai);
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_produk_DataStore.load({
						params : { no_faktur: jproduk_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_produk_DataStore.getCount()){
										jproduk_tunai_record=tunai_jual_produk_DataStore.getAt(0);
										jproduk_tunai_nilaiField.setValue(jproduk_tunai_record.data.jtunai_nilai);
									}
							}
					 	}
				  });
				break;
		}
		
		//detail_jual_produk_DataStore.load({params:{master_id: jproduk_idField.getValue()}});
	}
	/* End setValue to EDIT*/
  
    function load_membership(){
		if(jproduk_custField.getValue()!=''){
			memberDataStore.load({
					params : { member_cust: jproduk_custField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) {
							if(memberDataStore.getCount()){
								jproduk_member_record=memberDataStore.getAt(0).data;
								jproduk_cust_nomemberField.setValue(jproduk_member_record.member_no);
							}
						}
					}
			}); 
		}
	}
	/* Function for Check if the form is valid */
	function is_master_jual_produk_form_valid(){
		return (true);
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_jual_produk_createWindow.isVisible()){
			master_jual_produk_reset_form();
			detail_jual_produk_DataStore.load({params: {master_id:0}});
			post2db='CREATE';
			msg='created';
			master_cara_bayarTabPanel.setActiveTab(0);
			master_jual_produk_createWindow.show();
		} else {
			master_jual_produk_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_jual_produk_confirm_delete(){
		// only one master_jual_produk is selected here
		if(master_jual_produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_jual_produk_delete);
		} else if(master_jual_produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_jual_produk_delete);
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
	function master_jual_produk_confirm_update(){
		/* only one record is selected here */
		if(master_jual_produkListEditorGrid.selModel.getCount() == 1) {
			//master_jual_produk_set_form();
			master_cara_bayarTabPanel.setActiveTab(0);
			post2db='UPDATE';
			detail_jual_produk_DataStore.load({
				params : {master_id : eval(get_pk_id()), start:0, limit:pageS},
				callback: function(opts, success, response){
					if(success){
						var subtotal_field=0;
						var dproduk_jumlah_field=0;
						var total_field=0;
						var hutang_field=0;
						var diskon_field=0;
						var cashback_field=0;
						master_jual_produk_set_form();
						for(i=0;i<detail_jual_produk_DataStore.getCount();i++){
							subtotal_field+=detail_jual_produk_DataStore.getAt(i).data.dproduk_subtotal_net;
							dproduk_jumlah_field+=detail_jual_produk_DataStore.getAt(i).data.dproduk_jumlah;
							jproduk_subTotalField.setValue(subtotal_field);
							jproduk_jumlahField.setValue(dproduk_jumlah_field);
							if(jproduk_diskonField.getValue()!==""){
								diskon_field=jproduk_diskonField.getValue();
							}
							if(jproduk_cashbackField.getValue()!==""){
								cashback_field=jproduk_cashbackField.getValue();
							}
							total_field=subtotal_field*(100-diskon_field)/100-cashback_field;
							jproduk_totalField.setValue(total_field);
							jproduk_bayarField.setValue(detail_jual_produk_DataStore.getAt(i).data.jproduk_bayar);
							hutang_field=total_field-detail_jual_produk_DataStore.getAt(i).data.jproduk_bayar;
							jproduk_hutangField.setValue(hutang_field);
						}
					}
				}
			});
			msg='updated';
			master_jual_produk_createWindow.hide();
			//master_jual_produk_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih data yang akan diedit',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function master_jual_produk_delete(btn){
		if(btn=='yes'){
			var selections = master_jual_produkListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_jual_produkListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jproduk_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_jual_produk&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_jual_produk_DataStore.reload();
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
	master_jual_produk_DataStore = new Ext.data.Store({
		id: 'master_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jproduk_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jproduk_id', type: 'int', mapping: 'jproduk_id'}, 
			{name: 'jproduk_nobukti', type: 'string', mapping: 'jproduk_nobukti'}, 
			{name: 'jproduk_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'jproduk_cust_id', type: 'int', mapping: 'jproduk_cust'}, 
			{name: 'jproduk_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jproduk_tanggal'}, 
			{name: 'jproduk_diskon', type: 'int', mapping: 'jproduk_diskon'}, 
			{name: 'jproduk_cashback', type: 'float', mapping: 'jproduk_cashback'},
			{name: 'jproduk_cara', type: 'string', mapping: 'jproduk_cara'}, 
			{name: 'jproduk_cara2', type: 'string', mapping: 'jproduk_cara2'}, 
			{name: 'jproduk_cara3', type: 'string', mapping: 'jproduk_cara3'}, 
			{name: 'jproduk_bayar', type: 'float', mapping: 'jproduk_bayar'}, 
			{name: 'jproduk_keterangan', type: 'string', mapping: 'jproduk_keterangan'}, 
			{name: 'jproduk_creator', type: 'string', mapping: 'jproduk_creator'}, 
			{name: 'jproduk_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jproduk_date_create'}, 
			{name: 'jproduk_update', type: 'string', mapping: 'jproduk_update'}, 
			{name: 'jproduk_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jproduk_date_update'}, 
			{name: 'jproduk_revised', type: 'int', mapping: 'jproduk_revised'} 
		]),
		sortInfo:{field: 'jproduk_id', direction: "DESC"}
	});
	/* End of Function */
	
	cbo_voucher_jual_produkDataStore = new Ext.data.Store({
		id: 'cbo_voucher_jual_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_voucher_list', 
			method: 'POST'
		}),baseParams: {start:0, limit: 10},
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'voucher_nomor'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
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
	
	
	/* Function for Retrieve DataStore */
	cbo_cust_jual_produk_DataStore = new Ext.data.Store({
		id: 'cbo_cust_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_customer_list', 
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
	
	/* Function for Retrieve Combo Kwitansi DataStore */
	cbo_kwitansi_jual_produk_DataStore = new Ext.data.Store({
		id: 'cbo_kwitansi_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_kwitansi_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kwitansi_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'ckwitansi_id', type: 'int', mapping: 'kwitansi_id'},
			{name: 'ckwitansi_no', type: 'string', mapping: 'kwitansi_no'},
			{name: 'ckwitansi_cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'ckwitansi_cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'ckwitansi_cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'ckwitansi_cust_notelp', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'ckwitansi_no', direction: "ASC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Kwitansi DataStore */
	kwitansi_jual_produk_DataStore = new Ext.data.Store({
		id: 'kwitansi_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_kwitansi_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jkwitansi_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jkwitansi_id', type: 'int', mapping: 'jkwitansi_id'},
			{name: 'jkwitansi_no', type: 'string', mapping: 'jkwitansi_no'},
			{name: 'jkwitansi_nilai', type: 'float', mapping: 'jkwitansi_nilai'}
		]),
		sortInfo:{field: 'jkwitansi_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Kwitansi DataStore */
	card_jual_produk_DataStore = new Ext.data.Store({
		id: 'card_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_card_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcard_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jcard_id', type: 'int', mapping: 'jcard_id'}, 
			{name: 'jcard_no', type: 'string', mapping: 'jcard_no'},
			{name: 'jcard_nama', type: 'string', mapping: 'jcard_nama'},
			{name: 'jcard_edc', type: 'string', mapping: 'jcard_edc'},
			{name: 'jcard_nilai', type: 'float', mapping: 'jcard_nilai'}
		]),
		sortInfo:{field: 'jcard_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Kwitansi DataStore */
	cek_jual_produk_DataStore = new Ext.data.Store({
		id: 'cek_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_cek_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcek_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jcek_id', type: 'int', mapping: 'jcek_id'}, 
			{name: 'jcek_nama', type: 'string', mapping: 'jcek_nama'},
			{name: 'jcek_no', type: 'string', mapping: 'jcek_no'},
			{name: 'jcek_valid', type: 'string', mapping: 'jcek_valid'}, 
			{name: 'jcek_bank', type: 'string', mapping: 'jcek_bank'},
			{name: 'jcek_nilai', type: 'double', mapping: 'jcek_nilai'}
		]),
		sortInfo:{field: 'jcek_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Transfer DataStore */
	transfer_jual_produk_DataStore = new Ext.data.Store({
		id: 'transfer_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_transfer_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jtransfer_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jtransfer_id', type: 'int', mapping: 'jtransfer_id'}, 
			{name: 'jtransfer_bank', type: 'int', mapping: 'jtransfer_bank'},
			{name: 'jtransfer_nama', type: 'string', mapping: 'jtransfer_nama'},
			{name: 'jtransfer_nilai', type: 'float', mapping: 'jtransfer_nilai'}
		]),
		sortInfo:{field: 'jtransfer_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Tunai DataStore */
	tunai_jual_produk_DataStore = new Ext.data.Store({
		id: 'tunai_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_tunai_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jtunai_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jtunai_id', type: 'int', mapping: 'jtunai_id'}, 
			{name: 'jtunai_nilai', type: 'float', mapping: 'jtunai_nilai'}
		]),
		sortInfo:{field: 'jtunai_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* GET Bank-List.Store */
	jproduk_bankDataStore = new Ext.data.Store({
		id:'jproduk_bankDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_bank_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'mbank_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jproduk_bank_value', type: 'int', mapping: 'mbank_id'}, 
			{name: 'jproduk_bank_display', type: 'string', mapping: 'mbank_nama'}
		]),
		sortInfo:{field: 'jproduk_bank_display', direction: "DESC"}
		});
	/* END GET Bank-List.Store */
	
  	/* Function for Identify of Window Column Model */
	master_jual_produk_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jproduk_id',
			width: 5,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'No. Faktur',
			dataIndex: 'jproduk_nobukti',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}, 
		{
			header: 'Customer',
			dataIndex: 'jproduk_cust',
			width: 185,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'jproduk_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		}, 
		{
			header: 'Jumlah Bayar',
			dataIndex: 'jproduk_bayar',
			width: 150,
			sortable: true,
			readOnly: true,
			renderer: function(val){
				return '<span> Rp. '+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			
		},
		{
			header: 'Keterangan',
			dataIndex: 'jproduk_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'jproduk_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jproduk_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jproduk_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jproduk_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jproduk_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_jual_produk_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_jual_produkListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_jual_produkListEditorGrid',
		el: 'fp_master_jual_produk',
		title: 'Daftar Master_jual_produk',
		autoHeight: true,
		store: master_jual_produk_DataStore, // DataStore
		cm: master_jual_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_jual_produk_DataStore,
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
			handler: master_jual_produk_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_jual_produk_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_jual_produk_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_jual_produk_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_jual_produk_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_jual_produk_print  
		}
		]
	});
	//master_jual_produkListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_jual_produk_ContextMenu = new Ext.menu.Menu({
		id: 'master_jual_produk_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_jual_produk_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_jual_produk_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_jual_produk_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_jual_produk_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_jual_produk_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_jual_produk_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_jual_produk_SelectedRow=rowIndex;
		master_jual_produk_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_jual_produk_editContextMenu(){
		master_jual_produkListEditorGrid.startEditing(master_jual_produk_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_jual_produkListEditorGrid.addListener('rowcontextmenu', onmaster_jual_produk_ListEditGridContextMenu);
	//master_jual_produk_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_jual_produkListEditorGrid.on('afteredit', master_jual_produk_update); // inLine Editing Record
	
	// Custom rendering Template
    var customer_jual_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	var voucher_jual_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{voucher_nomor}</b>| {voucher_nama}<br/></span>',
			'Jenis: {voucher_jenis}&nbsp;&nbsp;&nbsp;[Nilai: {voucher_cashback}]',
		'</div></tpl>'
    );
	
	
	var kwitansi_jual_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{ckwitansi_no}</b> <br/>',
			'a/n {ckwitansi_cust_nama} [ {ckwitansi_cust_no} ]<br/>',
			'Alamat: {ckwitansi_cust_alamat}, notelp: {ckwitansi_cust_notelp} </span>',
		'</div></tpl>'
    );
	
	var produk_jual_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{dproduk_produk_kode}| <b>{dproduk_produk_display}</b>',
		'</div></tpl>'
    );
	/*var produk_jual_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dproduk_produk_kode}</b>| {dproduk_produk_display}<br/>Group: {dproduk_produk_group}<br/>',
			'Kategori: {dproduk_produk_kategori}</span>',
		'</div></tpl>'
    );*/
		
	/* Identify  jproduk_id Field */
	jproduk_idField= new Ext.form.NumberField({
		id: 'jproduk_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jproduk_nobukti Field */
	jproduk_nobuktiField= new Ext.form.TextField({
		id: 'jproduk_nobuktiField',
		fieldLabel: 'No. Faktur',
		readOnly:true,
		maxLength: 30,
		//anchor: '95%'
	});
	/* Identify  jproduk_cust Field */
	jproduk_custField= new Ext.form.ComboBox({
		id: 'jproduk_custField',
		fieldLabel: 'Customer',
		store: cbo_cust_jual_produk_DataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jproduk_cust_nomemberField= new Ext.form.TextField({
		id: 'jproduk_cust_nomemberField',
		fieldLabel: 'No. Member',
		readOnly: true
	});
	
	/* Identify  jproduk_tanggal Field */
	jproduk_tanggalField= new Ext.form.DateField({
		id: 'jproduk_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	});
	/* Identify  jproduk_diskon Field */
	jproduk_diskonField= new Ext.form.NumberField({
		id: 'jproduk_diskonField',
		fieldLabel: 'Diskon (%)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		allowDecimals: false,
		enableKeyEvents: true,
		width: 100,
		maxLength: 2,
		maskRe: /([0-9]+)$/
	});
	
	jproduk_cashbackField= new Ext.form.NumberField({
		id: 'jproduk_cashbackField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		enableKeyEvents: true,
		allowDecimals: false,
		width: 100,
		maskRe: /([0-9]+)$/
	});
	
	/* Identify  jproduk_cara Field */
	jproduk_caraField= new Ext.form.ComboBox({
		id: 'jproduk_caraField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_cara_value', 'jproduk_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jproduk_cara_display',
		valueField: 'jproduk_cara_value',
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jproduk_cara2 Field */
	jproduk_cara2Field= new Ext.form.ComboBox({
		id: 'jproduk_cara2Field',
		fieldLabel: 'Cara Bayar 2',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_cara_value', 'jproduk_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jproduk_cara_display',
		valueField: 'jproduk_cara_value',
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jproduk_cara3 Field */
	jproduk_cara3Field= new Ext.form.ComboBox({
		id: 'jproduk_cara3Field',
		fieldLabel: 'Cara Bayar 3',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_cara_value', 'jproduk_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jproduk_cara_display',
		valueField: 'jproduk_cara_value',
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jproduk_keterangan Field */
	jproduk_keteranganField= new Ext.form.TextArea({
		id: 'jproduk_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	// START Field Voucher
	jproduk_voucher_noField= new Ext.form.ComboBox({
		id: 'jproduk_voucher_noField',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jual_produkDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jproduk_voucher_noField.on('select', function(){
		j=cbo_voucher_jual_produkDataStore.find('voucher_nomor',jproduk_kwitansi_noField.getValue());
		if(j>-1){
			jproduk_kwitansi_namaField.setValue(cbo_kwitansi_jual_produk_DataStore.getAt(j).data.ckwitansi_cust_nama);
		}
	});
	
	jproduk_voucher_cashbackField= new Ext.form.NumberField({
		id: 'jproduk_voucher_cashbackField',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_produk_voucherGroup= new Ext.form.FieldSet({
		title: 'Voucher',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_voucher_noField,jproduk_voucher_cashbackField] 
			}
		]
	
	});
	// END Field Voucher
	// START Field Voucher-2
	jproduk_voucher_no2Field= new Ext.form.ComboBox({
		id: 'jproduk_voucher_no2Field',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jual_produkDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jproduk_voucher_cashback2Field= new Ext.form.NumberField({
		id: 'jproduk_voucher_cashback2Field',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_produk_voucher2Group= new Ext.form.FieldSet({
		title: 'Voucher',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_voucher_no2Field,jproduk_voucher_cashback2Field] 
			}
		]
	
	});
	// END Field Voucher-2
	// START Field Voucher-3
	jproduk_voucher_no3Field= new Ext.form.ComboBox({
		id: 'jproduk_voucher_no3Field',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jual_produkDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jproduk_voucher_cashback3Field= new Ext.form.NumberField({
		id: 'jproduk_voucher_cashback3Field',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_produk_voucher3Group= new Ext.form.FieldSet({
		title: 'Voucher',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_voucher_no3Field,jproduk_voucher_cashback3Field] 
			}
		]
	
	});
	// END Field Voucher-3
	
	// START Field Card
	jproduk_card_namaField= new Ext.form.ComboBox({
		id: 'jproduk_card_namaField',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_card_value', 'jproduk_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jproduk_card_display',
		valueField: 'jproduk_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jproduk_card_edcField= new Ext.form.ComboBox({
		id: 'jproduk_card_edcField',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_card_edc_value', 'jproduk_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jproduk_card_edc_display',
		valueField: 'jproduk_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jproduk_card_noField= new Ext.form.TextField({
		id: 'jproduk_card_noField',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jproduk_card_nilaiField= new Ext.form.NumberField({
		id: 'jproduk_card_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_produk_cardGroup= new Ext.form.FieldSet({
		title: 'Credit Card',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_card_namaField,jproduk_card_edcField,jproduk_card_noField,jproduk_card_nilaiField] 
			}
		]
	
	});
	// END Field Card
	// START Field Card-2
	jproduk_card_nama2Field= new Ext.form.ComboBox({
		id: 'jproduk_card_nama2Field',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_card_value', 'jproduk_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jproduk_card_display',
		valueField: 'jproduk_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jproduk_card_edc2Field= new Ext.form.ComboBox({
		id: 'jproduk_card_edc2Field',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_card_edc_value', 'jproduk_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jproduk_card_edc_display',
		valueField: 'jproduk_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jproduk_card_no2Field= new Ext.form.TextField({
		id: 'jproduk_card_no2Field',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jproduk_card_nilai2Field= new Ext.form.NumberField({
		id: 'jproduk_card_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_produk_card2Group= new Ext.form.FieldSet({
		title: 'Credit Card',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_card_nama2Field,jproduk_card_edc2Field,jproduk_card_no2Field,jproduk_card_nilai2Field] 
			}
		]
	
	});
	// END Field Card-2
	// START Field Card-3
	jproduk_card_nama3Field= new Ext.form.ComboBox({
		id: 'jproduk_card_nama3Field',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_card_value', 'jproduk_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jproduk_card_display',
		valueField: 'jproduk_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jproduk_card_edc3Field= new Ext.form.ComboBox({
		id: 'jproduk_card_edc3Field',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jproduk_card_edc_value', 'jproduk_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jproduk_card_edc_display',
		valueField: 'jproduk_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jproduk_card_no3Field= new Ext.form.TextField({
		id: 'jproduk_card_no3Field',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jproduk_card_nilai3Field= new Ext.form.NumberField({
		id: 'jproduk_card_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_produk_card3Group= new Ext.form.FieldSet({
		title: 'Credit Card',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_card_nama3Field,jproduk_card_edc3Field,jproduk_card_no3Field,jproduk_card_nilai3Field] 
			}
		]
	
	});
	// END Field Card-3
	
	// StART Field Cek
	jproduk_cek_namaField= new Ext.form.TextField({
		id: 'jproduk_cek_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jproduk_cek_noField= new Ext.form.TextField({
		id: 'jproduk_cek_noField',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jproduk_cek_validField= new Ext.form.DateField({
		id: 'jproduk_cek_validField',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jproduk_cek_bankField= new Ext.form.ComboBox({
		id: 'jproduk_cek_bankField',
		fieldLabel: 'Bank',
		store: jproduk_bankDataStore,
		mode: 'remote',
		displayField: 'jproduk_bank_display',
		valueField: 'jproduk_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jproduk_cek_bankField)
	});
	
	jproduk_cek_nilaiField= new Ext.form.NumberField({
		id: 'jproduk_cek_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_produk_cekGroup = new Ext.form.FieldSet({
		title: 'Check/Giro',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_cek_namaField,jproduk_cek_noField,jproduk_cek_validField,jproduk_cek_bankField,jproduk_cek_nilaiField] 
			}
		]
	
	});
	// END Field Cek
	// StART Field Cek-2
	jproduk_cek_nama2Field= new Ext.form.TextField({
		id: 'jproduk_cek_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jproduk_cek_no2Field= new Ext.form.TextField({
		id: 'jproduk_cek_no2Field',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jproduk_cek_valid2Field= new Ext.form.DateField({
		id: 'jproduk_cek_valid2Field',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jproduk_cek_bank2Field= new Ext.form.ComboBox({
		id: 'jproduk_cek_bank2Field',
		fieldLabel: 'Bank',
		store: jproduk_bankDataStore,
		mode: 'remote',
		displayField: 'jproduk_bank_display',
		valueField: 'jproduk_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jproduk_cek_bankField)
	});
	
	jproduk_cek_nilai2Field= new Ext.form.NumberField({
		id: 'jproduk_cek_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_produk_cek2Group = new Ext.form.FieldSet({
		title: 'Check/Giro',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_cek_nama2Field,jproduk_cek_no2Field,jproduk_cek_valid2Field,jproduk_cek_bank2Field,jproduk_cek_nilai2Field] 
			}
		]
	
	});
	// END Field Cek-2
	// StART Field Cek-3
	jproduk_cek_nama3Field= new Ext.form.TextField({
		id: 'jproduk_cek_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jproduk_cek_no3Field= new Ext.form.TextField({
		id: 'jproduk_cek_no3Field',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jproduk_cek_valid3Field= new Ext.form.DateField({
		id: 'jproduk_cek_valid3Field',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jproduk_cek_bank3Field= new Ext.form.ComboBox({
		id: 'jproduk_cek_bank3Field',
		fieldLabel: 'Bank',
		store: jproduk_bankDataStore,
		mode: 'remote',
		displayField: 'jproduk_bank_display',
		valueField: 'jproduk_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jproduk_cek_bankField)
	});
	
	jproduk_cek_nilai3Field= new Ext.form.NumberField({
		id: 'jproduk_cek_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_produk_cek3Group = new Ext.form.FieldSet({
		title: 'Check/Giro',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_cek_nama3Field,jproduk_cek_no3Field,jproduk_cek_valid3Field,jproduk_cek_bank3Field,jproduk_cek_nilai3Field] 
			}
		]
	
	});
	// END Field Cek-3
	
	// START Field Transfer
	jproduk_transfer_bankField= new Ext.form.ComboBox({
		id: 'jproduk_transfer_bankField',
		fieldLabel: 'Bank',
		store: jproduk_bankDataStore,
		mode: 'remote',
		displayField: 'jproduk_bank_display',
		valueField: 'jproduk_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jproduk_transfer_bankField)
	});

	jproduk_transfer_namaField= new Ext.form.TextField({
		id: 'jproduk_transfer_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jproduk_transfer_nilaiField= new Ext.form.NumberField({
		id: 'jproduk_transfer_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_produk_transferGroup= new Ext.form.FieldSet({
		title: 'Transfer',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_transfer_bankField,jproduk_transfer_namaField,jproduk_transfer_nilaiField] 
			}
		]
	
	});
	// END Field Transfer
	// START Field Transfer-2
	jproduk_transfer_bank2Field= new Ext.form.ComboBox({
		id: 'jproduk_transfer_bank2Field',
		fieldLabel: 'Bank',
		store: jproduk_bankDataStore,
		mode: 'remote',
		displayField: 'jproduk_bank_display',
		valueField: 'jproduk_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jproduk_transfer_nama2Field= new Ext.form.TextField({
		id: 'jproduk_transfer_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jproduk_transfer_nilai2Field= new Ext.form.NumberField({
		id: 'jproduk_transfer_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_produk_transfer2Group= new Ext.form.FieldSet({
		title: 'Transfer',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_transfer_bank2Field,jproduk_transfer_nama2Field,jproduk_transfer_nilai2Field] 
			}
		]
	
	});
	// END Field Transfer-2
	// START Field Transfer-3
	jproduk_transfer_bank3Field= new Ext.form.ComboBox({
		id: 'jproduk_transfer_bank3Field',
		fieldLabel: 'Bank',
		store: jproduk_bankDataStore,
		mode: 'remote',
		displayField: 'jproduk_bank_display',
		valueField: 'jproduk_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jproduk_transfer_nama3Field= new Ext.form.TextField({
		id: 'jproduk_transfer_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jproduk_transfer_nilai3Field= new Ext.form.NumberField({
		id: 'jproduk_transfer_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_produk_transfer3Group= new Ext.form.FieldSet({
		title: 'Transfer',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_transfer_bank3Field,jproduk_transfer_nama3Field,jproduk_transfer_nilai3Field] 
			}
		]
	
	});
	// END Field Transfer-3
	
	//START Field Tunai-1
	jproduk_tunai_nilaiField= new Ext.form.NumberField({
		id: 'jproduk_tunai_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_produk_tunaiGroup = new Ext.form.FieldSet({
		title: 'Tunai',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_tunai_nilaiField] 
			}
		]
	
	});
	// END Tunai-1
	
	//START Field Tunai-2
	jproduk_tunai_nilai2Field= new Ext.form.NumberField({
		id: 'jproduk_tunai_nilai2Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_produk_tunai2Group = new Ext.form.FieldSet({
		title: 'Tunai',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_tunai_nilai2Field] 
			}
		]
	
	});
	// END Tunai-2
	
	//START Field Tunai-3
	jproduk_tunai_nilai3Field= new Ext.form.NumberField({
		id: 'jproduk_tunai_nilai3Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_produk_tunai3Group = new Ext.form.FieldSet({
		title: 'Tunai',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_tunai_nilai3Field] 
			}
		]
	
	});
	// END Tunai-3
	
	//START Field Kwitansi-1
	jproduk_kwitansi_namaField= new Ext.form.TextField({
		id: 'jproduk_kwitansi_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jproduk_kwitansi_nilaiField= new Ext.form.NumberField({
		id: 'jproduk_kwitansi_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jproduk_kwitansi_noField= new Ext.form.ComboBox({
		id: 'jproduk_kwitansi_noField',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_produk_DataStore,
		mode: 'local',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jproduk_kwitansi_noField.on("select",function(){
			j=cbo_kwitansi_jual_produk_DataStore.find('ckwitansi_id',jproduk_kwitansi_noField.getValue());
			if(j>-1){
				jproduk_kwitansi_namaField.setValue(cbo_kwitansi_jual_produk_DataStore.getAt(j).data.ckwitansi_cust_nama);
			}
		});
	// END Kwitansi-1
	
	//START Field Kwitansi-2
	jproduk_kwitansi_nama2Field= new Ext.form.TextField({
		id: 'jproduk_kwitansi_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jproduk_kwitansi_nilai2Field= new Ext.form.NumberField({
		id: 'jproduk_kwitansi_nilai2Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jproduk_kwitansi_no2Field= new Ext.form.ComboBox({
		id: 'jproduk_kwitansi_no2Field',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_produk_DataStore,
		mode: 'local',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jproduk_kwitansi_no2Field.on("select",function(){
			j=cbo_kwitansi_jual_produk_DataStore.find('ckwitansi_id',jproduk_kwitansi_no2Field.getValue());
			if(j>-1){
				jproduk_kwitansi_nama2Field.setValue(cbo_kwitansi_jual_produk_DataStore.getAt(j).data.ckwitansi_cust_nama);
			}
		});
	// END Kwitansi-2
	
	//START Field Kwitansi-3
	jproduk_kwitansi_nama3Field= new Ext.form.TextField({
		id: 'jproduk_kwitansi_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jproduk_kwitansi_nilai3Field= new Ext.form.NumberField({
		id: 'jproduk_kwitansi_nilai3Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jproduk_kwitansi_no3Field= new Ext.form.ComboBox({
		id: 'jproduk_kwitansi_no3Field',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_produk_DataStore,
		mode: 'local',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_produk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jproduk_kwitansi_no3Field.on("select",function(){
			j=cbo_kwitansi_jual_produk_DataStore.find('ckwitansi_id',jproduk_kwitansi_no3Field.getValue());
			if(j>-1){
				jproduk_kwitansi_nama3Field.setValue(cbo_kwitansi_jual_produk_DataStore.getAt(j).data.ckwitansi_cust_nama);
			}
		});
	// END Kwitansi-3
	
	master_jual_produk_kwitansiGroup = new Ext.form.FieldSet({
		title: 'Kwitansi',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_kwitansi_noField,jproduk_kwitansi_namaField,jproduk_kwitansi_nilaiField] 
			}
		]
	
	});
	
	master_jual_produk_kwitansi2Group = new Ext.form.FieldSet({
		title: 'Kwitansi',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_kwitansi_no2Field,jproduk_kwitansi_nama2Field,jproduk_kwitansi_nilai2Field] 
			}
		]
	
	});
	
	master_jual_produk_kwitansi3Group = new Ext.form.FieldSet({
		title: 'Kwitansi',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jproduk_kwitansi_no3Field,jproduk_kwitansi_nama3Field,jproduk_kwitansi_nilai3Field] 
			}
		]
	
	});
	
	//* Bayar
	jproduk_jumlahField= new Ext.form.NumberField({
		id: 'jproduk_jumlahField',
		fieldLabel: 'Jumlah Item',
		allowBlank: true,
		readOnly: true,
		allowDecimals: false,
		width: 40,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jproduk_subTotalField= new Ext.form.NumberField({
		id: 'jproduk_subTotalField',
		fieldLabel: 'Sub Total (Rp)',
		readOnly: true,
		allowDecimals: false,
		allowBlank: true,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});

	jproduk_totalField= new Ext.form.NumberField({
		id: 'jproduk_totalField',
		fieldLabel: '<span style="font-weight:bold">Total (Rp)</span>',
		readOnly: true,
		allowDecimals: false,
		allowBlank: true,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jproduk_bayarField= new Ext.form.NumberField({
		id: 'jproduk_bayarField',
		fieldLabel: 'Total Bayar (Rp)',
		readOnly: true,
		enableKeyEvents: true,
		allowBlank: true,
		allowDecimals: false,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jproduk_hutangField= new Ext.form.NumberField({
		id: 'jproduk_hutangField',
		fieldLabel: 'Hutang (Rp)',
		readOnly: true,
		allowBlank: true,
		allowDecimals: false,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	
	master_cara_bayarTabPanel = new Ext.TabPanel({
		plain:true,
		activeTab: 0,
		//autoHeigth: true,
		frame: true,
		height: 232,
		width: 500,
		defaults:{bodyStyle:'padding:10px'},
		items:[{
                title:'Cara Bayar 1',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jproduk_caraField,master_jual_produk_tunaiGroup,master_jual_produk_cardGroup,master_jual_produk_cekGroup,master_jual_produk_kwitansiGroup,master_jual_produk_transferGroup,master_jual_produk_voucherGroup]
            },{
                title:'Cara Bayar 2',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jproduk_cara2Field, master_jual_produk_tunai2Group, master_jual_produk_kwitansi2Group ,master_jual_produk_card2Group, master_jual_produk_cek2Group, master_jual_produk_transfer2Group, master_jual_produk_voucher2Group]
            },{
                title:'Cara Bayar 3',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jproduk_cara3Field, master_jual_produk_tunai3Group, master_jual_produk_kwitansi3Group, master_jual_produk_card3Group, master_jual_produk_cek3Group, master_jual_produk_transfer3Group, master_jual_produk_voucher3Group]
            }]
	});
	
	master_jual_produk_bayarGroup = new Ext.form.FieldSet({
		title: '-',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		frame: true,
		items:[
			   {
				columnWidth:0.7,
				layout: 'form',
				border:false,
				items: [master_cara_bayarTabPanel] 
			}
			,{
				columnWidth:0.3,
				labelWidth: 140,
				layout: 'form',
    			labelPad: 0,
				baseCls: 'x-plain',
				border:false,
				labelAlign: 'left',
				items: [jproduk_jumlahField, jproduk_subTotalField, jproduk_diskonField, jproduk_cashbackField, {xtype: 'spacer',height:10},jproduk_totalField, jproduk_bayarField,jproduk_hutangField] 
			}
			]
	
	});
	
	/*Fieldset Master*/
	master_jual_produk_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jproduk_nobuktiField, jproduk_custField, jproduk_cust_nomemberField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jproduk_tanggalField, jproduk_keteranganField] 
			}
			]
	
	});
	
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_jual_produk_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intopeprodukan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dproduk_id', type: 'int', mapping: 'dproduk_id'}, 
			{name: 'dproduk_master', type: 'int', mapping: 'dproduk_master'}, 
			{name: 'dproduk_produk', type: 'int', mapping: 'dproduk_produk'}, 
			{name: 'dproduk_satuan', type: 'int', mapping: 'dproduk_satuan'}, 
			{name: 'dproduk_jumlah', type: 'int', mapping: 'dproduk_jumlah'}, 
			{name: 'dproduk_harga', type: 'float', mapping: 'dproduk_harga'}, 
			{name: 'dproduk_diskon', type: 'int', mapping: 'dproduk_diskon'},
			{name: 'dproduk_sales', type: 'string', mapping: 'dproduk_sales'},
			{name: 'dproduk_diskon_jenis', type: 'string', mapping: 'dproduk_diskon_jenis'},
			{name: 'dproduk_subtotal', type: 'float', mapping: 'dproduk_subtotal'},
			{name: 'dproduk_subtotal_net', type: 'int', mapping: 'dproduk_subtotal_net'},
			{name: 'konversi_nilai_temp', type: 'float', mapping: 'konversi_nilai_temp'},
			{name: 'jproduk_bayar', type: 'float', mapping: 'jproduk_bayar'},
			{name: 'jproduk_diskon', type: 'int', mapping: 'jproduk_diskon'},
			{name: 'jproduk_cashback', type: 'float', mapping: 'jproduk_cashback'}
	]);
	//eof
	
	
	//function for json writer of detail
	var detail_jual_produk_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_jual_produk_DataStore = new Ext.data.Store({
		id: 'detail_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=detail_detail_jual_produk_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: pageS},
		reader: detail_jual_produk_reader,
		sortInfo:{field: 'dproduk_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_jual_produk= new Ext.ux.grid.RowEditor({
        saveText: 'Update'/*,
        listeners: {
        	berforeedit: function(){
			detail_jual_produk_DataStore.on('cellclick',function(grid, rowIndex, columnIndex, e){
				Ext.Msg.alert('Status', 'Changes saved successfully.');
			});
			}
		}*//*,
		listeners: {
			afteredit: function(){
				detail_jual_produk_DataStore.commitChanges();
			}
		}*/
    });
	//eof
	
	cbo_dproduk_produkDataStore = new Ext.data.Store({
		id: 'cbo_dproduk_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_produk_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'dproduk_produk_value', type: 'int', mapping: 'produk_id'},
			{name: 'dproduk_produk_harga', type: 'float', mapping: 'produk_harga'},
			{name: 'dproduk_produk_kode', type: 'string', mapping: 'produk_kode'},
			{name: 'dproduk_produk_satuan', type: 'string', mapping: 'satuan_kode'},
			{name: 'dproduk_produk_group', type: 'string', mapping: 'group_nama'},
			{name: 'dproduk_produk_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'dproduk_produk_du', type: 'float', mapping: 'produk_du'},
			{name: 'dproduk_produk_dm', type: 'float', mapping: 'produk_dm'},
			{name: 'dproduk_produk_display', type: 'string', mapping: 'produk_nama'}
		]),
		sortInfo:{field: 'dproduk_produk_display', direction: "ASC"}
	});
	
	cbo_dproduk_satuanDataStore = new Ext.data.Store({
		id: 'cbo_dproduk_satuanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_satuan_bydjproduk_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
			{name: 'djproduk_satuan_value', type: 'int', mapping: 'satuan_id'},
			{name: 'djproduk_satuan_nama', type: 'string', mapping: 'satuan_nama'},
			{name: 'djproduk_satuan_nilai', type: 'float', mapping: 'konversi_nilai'},
			{name: 'djproduk_satuan_display', type: 'string', mapping: 'satuan_kode'},
			{name: 'djproduk_satuan_default', type: 'string', mapping: 'konversi_default'},
			{name: 'djproduk_satuan_harga', type: 'float', mapping: 'produk_harga'}
		]),
		sortInfo:{field: 'djproduk_satuan_nilai', direction: "DESC"}
	});
	
	
	memberDataStore = new Ext.data.Store({
		id: 'memberDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_member_by_cust', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'member_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'member_id', type: 'int', mapping: 'member_id'},
			{name: 'member_no', type: 'string', mapping: 'member_no'},
			{name: 'member_point' , type: 'int', mapping: 'member_point'},
			{name: 'member_jenis' , type: 'string', mapping: 'member_jenis'},
			{name: 'member_aktif' , type: 'string', mapping: 'member_aktif'}
			
		]),
		sortInfo:{field: 'member_id', direction: "ASC"}
	});
	
	
		
	Ext.util.Format.comboRenderer = function(combo){
		//cbo_dproduk_produkDataStore.load({params: {limit:0}});
		//cbo_dproduk_satuanDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_jual_produk=new Ext.form.ComboBox({
			store: cbo_dproduk_produkDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dproduk_produk_display',
			valueField: 'dproduk_produk_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: produk_jual_produk_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var combo_satuan_produk=new Ext.form.ComboBox({
		store: cbo_dproduk_satuanDataStore,
		mode:'local',
		typeAhead: true,
		displayField: 'djproduk_satuan_display',
		valueField: 'djproduk_satuan_value',
		triggerAction: 'all',
		anchor: '95%'
	});
	
	dproduk_idField=new Ext.form.NumberField();
	djproduk_satuan_nilaiField=new Ext.form.NumberField();
	
	combo_jual_produk.on('select',function(){
		var t=detail_jual_produkListEditorGrid.getStore().getCount();
		for(i=0;i<detail_jual_produk_DataStore.getCount();i++){	
			detail_jual_produk_record=detail_jual_produk_DataStore.getAt(i);
			var c_dtStore=0;
			var j=cbo_dproduk_produkDataStore.find('dproduk_produk_value',combo_jual_produk.getValue());
			if(cbo_dproduk_produkDataStore.getCount()){
				dproduk_idField.setValue(cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_value);
				cbo_dproduk_satuanDataStore.load({params: {djproduk_id:dproduk_idField.getValue()}});
			}
			detail_jual_produk_DataStore.getAt(0).data.dproduk_jumlah=2;
		}
	});

	temp_konv_nilai=new Ext.form.NumberField();

	combo_satuan_produk.on('select', function(){
		var j=cbo_dproduk_satuanDataStore.find('djproduk_satuan_value',combo_satuan_produk.getValue());
		var jt=cbo_dproduk_satuanDataStore.find('djproduk_satuan_default','true');
		var nilai_terpilih=0;
		var nilai_default=0;
		if(cbo_dproduk_satuanDataStore.getCount()>=0){
			if(cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_default=="true"){
				//Harga_Produk=harga yg tercantum di Master Produk tanpa proses bagi/kali
				djproduk_satuan_nilaiField.setValue(1);
				detail_jual_produk_DataStore.getAt(0).data.konversi_nilai_temp=1;
				temp_konv_nilai.setValue(1);
			}else if(cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_default=="false"){
				//ambil satuan_nilai dr satuan_id yg terpilih, ambil satuan_nilai dr satuan_default=true
				//jika [satuan_nilai dr satuan_default=true] === 1 => Harga_Produk=[satuan_nilai dr satuan_id yg terpilih]*data.djproduk_satuan_harga
				//jika [satuan_nilai dr satuan_default=true] !== 1 AND [satuan_nilai dr satuan_default=true] < [satuan_nilai dr satuan_id yg terpilih] => Harga_Produk=([satuan_nilai dr satuan_id yg terpilih]/[satuan_nilai dr satuan_default=true])*data.djproduk_satuan_harga 
				//jika [satuan_nilai dr satuan_default=true] !== 1 AND [satuan_nilai dr satuan_default=true] > [satuan_nilai dr satuan_id yg terpilih] => Harga_Produk=data.djproduk_satuan_harga/[satuan_nilai dr satuan_default=true]
				nilai_terpilih=cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_nilai;
				nilai_default=cbo_dproduk_satuanDataStore.getAt(jt).data.djproduk_satuan_nilai;
				if(nilai_default===1){
					djproduk_satuan_nilaiField.setValue(cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_nilai);
					detail_jual_produk_DataStore.getAt(0).data.konversi_nilai_temp=cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_nilai;
					temp_konv_nilai.setValue(cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_nilai);
				}else if(nilai_default!==1 && nilai_default<nilai_terpilih){
					djproduk_satuan_nilaiField.setValue(nilai_terpilih/nilai_default);
					detail_jual_produk_DataStore.getAt(0).data.konversi_nilai_temp=nilai_terpilih/nilai_default;
					temp_konv_nilai.setValue(nilai_terpilih/nilai_default);
				}else if(nilai_default!==1 && nilai_default>nilai_terpilih){
					djproduk_satuan_nilaiField.setValue(1/nilai_default);
					detail_jual_produk_DataStore.getAt(0).data.konversi_nilai_temp=1/nilai_default;
					temp_konv_nilai.setValue(1/nilai_default);
				}
			}
			
		}
		/*for(i=0;i<cbo_dproduk_satuanDataStore.getCount();i++){
			if(cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_default=="true"){
				//Harga_Produk=harga yg tercantum di Master Produk tanpa proses bagi/kali
				djproduk_satuan_nilaiField.setValue(1);
			}else if(cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_default=="false"){
				//ambil satuan_nilai dr satuan_id yg terpilih, ambil satuan_nilai dr satuan_default=true
				//jika [satuan_nilai dr satuan_default=true] === 1 => Harga_Produk=[satuan_nilai dr satuan_id yg terpilih]*data.djproduk_satuan_harga
				//jika [satuan_nilai dr satuan_default=true] !== 1 AND [satuan_nilai dr satuan_default=true] < [satuan_nilai dr satuan_id yg terpilih] => Harga_Produk=([satuan_nilai dr satuan_id yg terpilih]/[satuan_nilai dr satuan_default=true])*data.djproduk_satuan_harga 
				//jika [satuan_nilai dr satuan_default=true] !== 1 AND [satuan_nilai dr satuan_default=true] > [satuan_nilai dr satuan_id yg terpilih] => Harga_Produk=data.djproduk_satuan_harga/[satuan_nilai dr satuan_default=true]
				nilai_terpilih=cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_nilai;
				nilai_default=cbo_dproduk_satuanDataStore.getAt(jt).data.djproduk_satuan_nilai;
				if(nilai_default===1){
					djproduk_satuan_nilaiField.setValue(cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_nilai);
				}else if(nilai_default!==1 && nilai_default<nilai_terpilih){
					djproduk_satuan_nilaiField.setValue(nilai_terpilih/nilai_default);
				}else if(nilai_default!==1 && nilai_default>nilai_terpilih){
					djproduk_satuan_nilaiField.setValue(1/nilai_default);
				}
			}
			//djproduk_satuan_nilaiField.setValue(cbo_dproduk_satuanDataStore.getAt(j).data.djproduk_satuan_nilai);
		}*/
	});
		

	//declaration of detail coloumn model
	detail_jual_produk_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			align : 'Left',
			header: '<div align="center">' + 'Produk' + '</div>',
			dataIndex: 'dproduk_produk',
			width: 300, //250
			sortable: true,
			allowBlank: false,
			editor: combo_jual_produk,
			renderer: Ext.util.Format.comboRenderer(combo_jual_produk)
		},
		{
			align :'Left',
			header: '<div align="center">' + 'Satuan' + '</div>',
			dataIndex: 'dproduk_satuan',
			width: 60, //80,
			sortable: true,
			editor: combo_satuan_produk,
			renderer: Ext.util.Format.comboRenderer(combo_satuan_produk)
/*
			renderer: function(v, params, record){
				j=cbo_dproduk_produkDataStore.find('dproduk_produk_value',record.data.dproduk_produk);
				if(j>-1){
					return cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_satuan;
				}
			}			
*/
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'dproduk_jumlah',
			width: 60, //80,
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
		{
			align : 'Right',
			header: '<div align="center">' + 'Harga (Rp)' + '</div>',
			dataIndex: 'dproduk_harga',
			width: 100, //150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		}
		,{
			align : 'Right',
			header: '<div align="center">' + 'Sub Total (Rp)' + '</div>',
			dataIndex: 'dproduk_subtotal',
			width: 100, //150,
			sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
				return Ext.util.Format.number(record.data.konversi_nilai_temp*record.data.dproduk_harga* record.data.dproduk_jumlah,'0,000');
			}//,
			/*renderer: function(v, params, record){
					var konversi_store = new Ext.data.Store({
						proxy: new Ext.data.HttpProxy({
							url: 'index.php?c=c_master_jual_produk&m=get_konversi_list',
							method: 'POST'
							}),
						reader: new Ext.data.JsonReader({
							root: 'results',
							totalProperty: 'total',
							id: 'voucher_nomor'
							},[
								{name: 'konversi_produk', type: 'int', mapping: 'konversi_produk'},
								{name: 'konversi_satuan', type: 'int', mapping: 'konversi_satuan'},
							   	{name: 'konversi_nilai', type: 'float', mapping: 'konversi_nilai'},
							   	{name: 'konversi_default', type: 'string', mapping: 'konversi_default'}
							])
						});
					konversi_store.load({
						params: {dproduk_produk_id:record.data.dproduk_produk},
						callback: function(opts, success, response){
							if(success){
								var df=konversi_store.find('konversi_default','true');
								var konversi_df=konversi_store.getAt(df).data.konversi_nilai;
								var j=konversi_store.find('konversi_satuan',record.data.dproduk_satuan);
								if(konversi_store.getAt(j).data.konversi_default==='true'){
									record.data.konversi_nilai=1;
								}else if(konversi_store.getAt(j).data.konversi_default!=='true' && konversi_df<konversi_store.getAt(j).data.konversi_nilai){
									record.data.konversi_nilai=konversi_store.getAt(j).data.konversi_nilai/konversi_df;
								}else if(konversi_store.getAt(j).data.konversi_default!=='true' && konversi_df>konversi_store.getAt(j).data.konversi_nilai){
									record.data.konversi_nilai=1/konversi_df;
								}
								var nilai_subtotal=record.data.konversi_nilai*record.data.dproduk_harga* record.data.dproduk_jumlah;
								//return Ext.util.Format.number(record.data.konversi_nilai*record.data.dproduk_harga* record.data.dproduk_jumlah,'0,000');
							}
							djproduk_satuan_nilaiField.setValue(record.data.konversi_nilai);
							return Ext.util.Format.number(djproduk_satuan_nilaiField.getValue(),'0,000');
						}
					});
					
					//return Ext.util.Format.number(record.data.konversi_nilai*record.data.dproduk_harga* record.data.dproduk_jumlah,'0,000');
            }*/
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Diskon (%)' + '</div>',
			dataIndex: 'dproduk_diskon',
			width: 80, //90,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 2,
				maskRe: /([0-9]+)$/
			})
		},{
			align : 'Left',
			header: '<div align="center">' + 'Jenis Diskon' + '</div>',
			dataIndex: 'dproduk_diskon_jenis',
			width: 80, //100,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store:new Ext.data.SimpleStore({
					fields:['diskon_jenis_value'],
					data:[['DU'],['DM'],['Promo'],['Reward'],['Ultah'],['Kolega']]
				}),
				mode: 'local',
				displayField: 'diskon_jenis_value',
				valueField: 'diskon_jenis_value',
				allowBlank: true,
				anchor: '50%',
				triggerAction: 'all',
				lazyRenderer: true
			})
		},{
			align :'Right',
			header: '<div align="center">' + 'Sub Tot Net (Rp)' + '</div>',
			dataIndex: 'dproduk_subtotal_net',
			width: 100, //150,
			sortable: true,
			reaOnly: true,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.dproduk_subtotal*(100-record.data.dproduk_diskon)/100,'0,000');
            }
		},/*{
			header: 'Sales',
			dataIndex: 'dproduk_sales',
			width: 40, //150,
			sortable: true,
			reaOnly: true
		},{
			align : 'Right',
			header: '<div align="center">' + 'Konversi Nilai' + '</div>',
			dataIndex: 'konversi_nilai_temp',
			hidden: false,
			allowDecimals: true,
			width: 80, //100
			sortable: true
		}*/
		]
	);
	detail_jual_produk_ColumnModel.defaultSortable= true;
	//eof
	
	function get_harga_produk(id_produk){
		var harga_produk=0;
		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jual_produk&m=get_harga_produk',
			params:{ produk_id	: id_produk },
			success: function(response){							
				var result=response.responseText;
				harga_produk=result;
			}
		});
		return harga_produk;
	}
	
	
	//declaration of detail list editor grid
	detail_jual_produkListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_jual_produkListEditorGrid',
		el: 'fp_detail_jual_produk',
		title: 'Detail Penjualan Produk',
		height: 250,
		width: 938,
		autoScroll: true,
		store: detail_jual_produk_DataStore, // DataStore
		colModel: detail_jual_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_jual_produk],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_jual_produk_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_jual_produk_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_jual_produk_confirm_delete
		}
		]
	});
	//eof
	
	//function of detail add
	function detail_jual_produk_add(){
		var edit_detail_jual_produk= new detail_jual_produkListEditorGrid.store.recordType({
			dproduk_id	:'',		
			dproduk_master	:'',		
			dproduk_produk	:null,		
			dproduk_satuan	:null,		
			dproduk_jumlah	:null,		
			dproduk_harga	:null,
			dproduk_diskon_jenis: null,
			dproduk_diskon	:null,
			dproduk_sales	:null
		});
		editor_detail_jual_produk.stopEditing();
		detail_jual_produk_DataStore.insert(0, edit_detail_jual_produk);
		detail_jual_produkListEditorGrid.getView().refresh();
		detail_jual_produkListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_jual_produk.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_jual_produk(){
		detail_jual_produk_DataStore.commitChanges();
		detail_jual_produkListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_jual_produk_insert(){
		for(i=0;i<detail_jual_produk_DataStore.getCount();i++){
			detail_jual_produk_record=detail_jual_produk_DataStore.getAt(i);
			if(detail_jual_produk_record.data.dproduk_produk!==null&&detail_jual_produk_record.data.dproduk_produk.dproduk_produk!==""){
				Ext.Ajax.request({
					waitMsg: 'Mohon tunggu...',
					url: 'index.php?c=c_master_jual_produk&m=detail_detail_jual_produk_insert',
					params:{
						dproduk_id	: detail_jual_produk_record.data.dproduk_id, 
						dproduk_master	: eval(jproduk_idField.getValue()), 
						dproduk_produk	: detail_jual_produk_record.data.dproduk_produk,
						dproduk_satuan	: detail_jual_produk_record.data.dproduk_satuan,
						dproduk_jumlah	: detail_jual_produk_record.data.dproduk_jumlah, 
						dproduk_harga	: detail_jual_produk_record.data.dproduk_harga, 
						dproduk_subtotal_net	: detail_jual_produk_record.data.dproduk_subtotal_net,
						dproduk_diskon	: detail_jual_produk_record.data.dproduk_diskon,
						dproduk_diskon_jenis	: detail_jual_produk_record.data.dproduk_diskon_jenis,
						dproduk_sales			: detail_jual_produk_record.data.dproduk_sales,
						konversi_nilai_temp	: detail_jual_produk_record.data.konversi_nilai_temp
					},
					timeout: 60000,
					success: function(response){							
						var result=eval(response.responseText);
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
	}
	//eof
	
	//function for purge detail
	function detail_jual_produk_purge(){
		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jual_produk&m=detail_detail_jual_produk_purge',
			params:{ master_id: eval(jproduk_idField.getValue()) },
			callback: function(opts, success, response){
				if(success){
					detail_jual_produk_insert();
				}
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_jual_produk_confirm_delete(){
		// only one record is selected here
		if(detail_jual_produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_jual_produk_delete);
		} else if(detail_jual_produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_jual_produk_delete);
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
	function detail_jual_produk_delete(btn){
		if(btn=='yes'){
			var s = detail_jual_produkListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_jual_produk_DataStore.remove(r);
			}
		} 
		detail_jual_produk_DataStore.commitChanges();
	}
	//eof
	
	
	function update_group_carabayar_jual_produk(){
		var value=jproduk_caraField.getValue();
		master_jual_produk_tunaiGroup.setVisible(false);
		master_jual_produk_cardGroup.setVisible(false);
		master_jual_produk_cekGroup.setVisible(false);
		master_jual_produk_transferGroup.setVisible(false);
		master_jual_produk_kwitansiGroup.setVisible(false);
		master_jual_produk_voucherGroup.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jproduk_tunai_nilaiField.reset();
		jproduk_card_nilaiField.reset();
		jproduk_cek_nilaiField.reset();
		jproduk_transfer_nilaiField.reset();
		jproduk_kwitansi_nilaiField.reset();
		jproduk_voucher_cashbackField.reset();
		//load_total_produk_bayar();
		
		if(value=='card'){
			master_jual_produk_cardGroup.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_produk_cekGroup.setVisible(true);
		}else if(value=='transfer'){
			master_jual_produk_transferGroup.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_produk_kwitansiGroup.setVisible(true);
		}else if(value=='voucher'){
			master_jual_produk_voucherGroup.setVisible(true);
		}else if(value=='tunai'){
			master_jual_produk_tunaiGroup.setVisible(true);
		}
	}
	
	function update_group_carabayar2_jual_produk(){
		var value=jproduk_cara2Field.getValue();
		master_jual_produk_tunai2Group.setVisible(false);
		master_jual_produk_card2Group.setVisible(false);
		master_jual_produk_cek2Group.setVisible(false);
		master_jual_produk_transfer2Group.setVisible(false);
		master_jual_produk_kwitansi2Group.setVisible(false);
		master_jual_produk_voucher2Group.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jproduk_tunai_nilai2Field.reset();
		jproduk_card_nilai2Field.reset();
		jproduk_cek_nilai2Field.reset();
		jproduk_transfer_nilai2Field.reset();
		jproduk_kwitansi_nilai2Field.reset();
		jproduk_voucher_cashback2Field.reset();
		//load_total_produk_bayar();
		
		if(value=='card'){
			master_jual_produk_card2Group.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_produk_cek2Group.setVisible(true);
		}else if(value=='transfer'){
			master_jual_produk_transfer2Group.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_produk_kwitansi2Group.setVisible(true);
		}else if(value=='voucher'){
			master_jual_produk_voucher2Group.setVisible(true);
		}else if(value=='tunai'){
			master_jual_produk_tunai2Group.setVisible(true);
		}
	}
	
	function update_group_carabayar3_jual_produk(){
		var value=jproduk_cara3Field.getValue();
		master_jual_produk_tunai3Group.setVisible(false);
		master_jual_produk_card3Group.setVisible(false);
		master_jual_produk_cek3Group.setVisible(false);
		master_jual_produk_transfer3Group.setVisible(false);
		master_jual_produk_kwitansi3Group.setVisible(false);
		master_jual_produk_voucher3Group.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jproduk_tunai_nilai3Field.reset();
		jproduk_card_nilai3Field.reset();
		jproduk_cek_nilai3Field.reset();
		jproduk_transfer_nilai3Field.reset();
		jproduk_kwitansi_nilai3Field.reset();
		jproduk_voucher_cashback3Field.reset();
		//load_total_produk_bayar();
		
		if(value=='card'){
			master_jual_produk_card3Group.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_produk_cek3Group.setVisible(true);
		}else if(value=='transfer'){
			master_jual_produk_transfer3Group.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_produk_kwitansi3Group.setVisible(true);
		}else if(value=='voucher'){
			master_jual_produk_voucher3Group.setVisible(true);
		}else if(value=='tunai'){
			master_jual_produk_tunai3Group.setVisible(true);
		}
	}
	
	
	/*function load_detail_jual_produk(){
		var detail_jual_produk_record;
		for(i=0;i<detail_jual_produk_DataStore.getCount();i++){
			detail_jual_produk_record=detail_jual_produk_DataStore.getAt(i);
			var j=cbo_dproduk_produkDataStore.find('dproduk_produk_value',detail_jual_produk_record.data.dproduk_produk);
			if(j>0){
				detail_jual_produk_record.data.dproduk_harga=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_harga;
				//detail_jual_produk_record.data.dproduk_satuan=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_satuan;
				if(detail_jual_produk_record.data.dproduk_diskon==""){
					if(jproduk_cust_nomemberField.getValue()!=""){
						if(cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_dm!==0){
							detail_jual_produk_record.data.dproduk_diskon=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_dm;
							detail_jual_produk_record.data.dproduk_diskon_jenis='DM';
						}
					}else{
						if(cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_du!==0){
							detail_jual_produk_record.data.dproduk_diskon=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_du;
							detail_jual_produk_record.data.dproduk_diskon_jenis='DU';
						}
					}
				}
			}
		}
	}*/
	var konversi_store = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_produk&m=get_konversi_list',
			method: 'POST'
			}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'voucher_nomor'
			},[
				{name: 'konversi_produk', type: 'int', mapping: 'konversi_produk'},
				{name: 'konversi_satuan', type: 'int', mapping: 'konversi_satuan'},
			   	{name: 'konversi_nilai', type: 'float', mapping: 'konversi_nilai'},
			   	{name: 'konversi_default', type: 'string', mapping: 'konversi_default'}
			])
		});
	
	function load_total_produk_bayar(){
		var jumlah_item=0;
		var subtotal_harga=0;
		var total_harga=0;
		var total_hutang=0;
		var total_bayar=0;
		var subtotal_harga_field=0;

		var transfer_nilai=0;
		var transfer_nilai2=0;
		var transfer_nilai3=0;
		var kwitansi_nilai=0;
		var kwitansi_nilai2=0;
		var kwitansi_nilai3=0;
		var card_nilai=0;
		var card_nilai2=0;
		var card_nilai3=0;
		var cek_nilai=0;
		var cek_nilai2=0;
		var cek_nilai3=0;
		var voucher_nilai=0;
		var voucher_nilai2=0;
		var voucher_nilai3=0;

		var subtotal_net_harga=0;

		var detail_jual_produk_record;
		if(detail_jual_produk_DataStore.getCount()>0){
			detail_jual_produk_record=detail_jual_produk_DataStore.getAt(0);
			detail_jual_produk_record.data.konversi_nilai_temp=temp_konv_nilai.getValue();
			var j=cbo_dproduk_produkDataStore.find('dproduk_produk_value',detail_jual_produk_record.data.dproduk_produk);
			//var ds=cbo_dproduk_satuanDataStore.find('djproduk_satuan_value',detail_jual_produk_record.data.dproduk_satuan);
			if(j>=0){
				detail_jual_produk_record.data.dproduk_harga=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_harga;
				subtotal_harga=eval(detail_jual_produk_record.data.konversi_nilai_temp*detail_jual_produk_record.data.dproduk_jumlah*detail_jual_produk_record.data.dproduk_harga);
				//detail_jual_produk_record.data.dproduk_satuan=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_satuan;
				if(detail_jual_produk_record.data.dproduk_diskon==""){
					if(jproduk_cust_nomemberField.getValue()!=""){
						if(cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_dm!==0){
							detail_jual_produk_record.data.dproduk_diskon=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_dm;
							detail_jual_produk_record.data.dproduk_diskon_jenis='DM';
						}
					}else{
						if(cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_du!==0){
							detail_jual_produk_record.data.dproduk_diskon=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_du;
							detail_jual_produk_record.data.dproduk_diskon_jenis='DU';
						}
					}
				}
			}
			/*if(ds>=0){
				detail_jual_produk_record.data.konversi_nilai=cbo_dproduk_satuanDataStore.getAt(ds).data.djproduk_satuan_nilai;
			}*/
			
			
			//jumlah_item=jumlah_item+eval(detail_jual_produk_record.data.dproduk_jumlah);
			//subtotal_harga=subtotal_harga+eval(djproduk_satuan_nilaiField.getValue()*detail_jual_produk_record.data.dproduk_jumlah*detail_jual_produk_record.data.dproduk_harga*(100-detail_jual_produk_record.data.dproduk_diskon)/100);
			
			//subtotal_harga=eval(djproduk_satuan_nilaiField.getValue()*detail_jual_produk_record.data.dproduk_jumlah*detail_jual_produk_record.data.dproduk_harga);
			//subtotal_harga=eval(detail_jual_produk_record.data.konversi_nilai*detail_jual_produk_record.data.dproduk_jumlah*detail_jual_produk_record.data.dproduk_harga);
			//subtotal_harga_net=subtotal_harga*((100-detail_jual_produk_record.data.dproduk_diskon)/100);
			detail_jual_produk_record.data.dproduk_subtotal=subtotal_harga;
			detail_jual_produk_record.data.dproduk_subtotal_net=subtotal_harga*((100-detail_jual_produk_record.data.dproduk_diskon)/100);
			//subtotal_net_harga=subtotal_harga*((100-detail_jual_produk_record.data.dproduk_diskon)/100);
			//subtotal_harga_field+=subtotal_net_harga;
		}
		/*for(i=0;i<detail_jual_produk_DataStore.getCount();i++){
			detail_jual_produk_record=detail_jual_produk_DataStore.getAt(i);
			//detail_jual_produk_DataStore.getAt(0).data.konversi_nilai_temp=3.5;
			var j=cbo_dproduk_produkDataStore.find('dproduk_produk_value',detail_jual_produk_record.data.dproduk_produk);
			var ds=cbo_dproduk_satuanDataStore.find('djproduk_satuan_value',detail_jual_produk_record.data.dproduk_satuan);
			if(j>=0){
				detail_jual_produk_record.data.dproduk_harga=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_harga;
				subtotal_harga=eval(detail_jual_produk_record.data.konversi_nilai_temp*detail_jual_produk_record.data.dproduk_jumlah*detail_jual_produk_record.data.dproduk_harga);
				//detail_jual_produk_record.data.dproduk_satuan=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_satuan;
				if(detail_jual_produk_record.data.dproduk_diskon==""){
					if(jproduk_cust_nomemberField.getValue()!=""){
						if(cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_dm!==0){
							detail_jual_produk_record.data.dproduk_diskon=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_dm;
							detail_jual_produk_record.data.dproduk_diskon_jenis='DM';
						}
					}else{
						if(cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_du!==0){
							detail_jual_produk_record.data.dproduk_diskon=cbo_dproduk_produkDataStore.getAt(j).data.dproduk_produk_du;
							detail_jual_produk_record.data.dproduk_diskon_jenis='DU';
						}
					}
				}
			}
			if(ds>=0){
				detail_jual_produk_record.data.konversi_nilai=cbo_dproduk_satuanDataStore.getAt(ds).data.djproduk_satuan_nilai;
			}
			
			
			jumlah_item=jumlah_item+eval(detail_jual_produk_record.data.dproduk_jumlah);
			//subtotal_harga=subtotal_harga+eval(djproduk_satuan_nilaiField.getValue()*detail_jual_produk_record.data.dproduk_jumlah*detail_jual_produk_record.data.dproduk_harga*(100-detail_jual_produk_record.data.dproduk_diskon)/100);
			
			//subtotal_harga=eval(djproduk_satuan_nilaiField.getValue()*detail_jual_produk_record.data.dproduk_jumlah*detail_jual_produk_record.data.dproduk_harga);
			//subtotal_harga=eval(detail_jual_produk_record.data.konversi_nilai*detail_jual_produk_record.data.dproduk_jumlah*detail_jual_produk_record.data.dproduk_harga);
			//subtotal_harga_net=subtotal_harga*((100-detail_jual_produk_record.data.dproduk_diskon)/100);
			detail_jual_produk_record.data.dproduk_subtotal=subtotal_harga;
			subtotal_net_harga=subtotal_harga*((100-detail_jual_produk_record.data.dproduk_diskon)/100);
			subtotal_harga_field+=subtotal_net_harga;
			
		}*/
		//(record.data.dproduk_subtotal* record.data.dproduk_jumlah*(100-record.data.dproduk_diskon)/100,'0,000')
		for(i=0;i<detail_jual_produk_DataStore.getCount();i++){
			jumlah_item=jumlah_item+eval(detail_jual_produk_DataStore.getAt(i).data.dproduk_jumlah);
			subtotal_harga_field+=detail_jual_produk_DataStore.getAt(i).data.dproduk_subtotal_net;
		}
		
		jproduk_jumlahField.setValue(jumlah_item);
		//jproduk_subTotalField.setValue(subtotal_harga*(100-detail_jual_produk_record.data.dproduk_diskon)/100);
		jproduk_subTotalField.setValue(subtotal_harga_field);
		total_harga=subtotal_harga_field*(100-jproduk_diskonField.getValue())/100 - jproduk_cashbackField.getValue();
		total_harga=(total_harga>0?Math.round(total_harga):0);
		//jproduk_subTotalField.setValue(total_harga);
		jproduk_totalField.setValue(total_harga);

		

		transfer_nilai=jproduk_transfer_nilaiField.getValue();
		if(/^\d+$/.test(transfer_nilai))
			transfer_nilai=jproduk_transfer_nilaiField.getValue();
		else
			transfer_nilai=0;
		
		transfer_nilai2=jproduk_transfer_nilai2Field.getValue();
		if(/^\d+$/.test(transfer_nilai2))
			transfer_nilai2=jproduk_transfer_nilai2Field.getValue();
		else
			transfer_nilai2=0;
		
		transfer_nilai3=jproduk_transfer_nilai3Field.getValue();
		if(/^\d+$/.test(transfer_nilai3))
			transfer_nilai3=jproduk_transfer_nilai3Field.getValue();
		else
			transfer_nilai3=0;
		
		kwitansi_nilai=jproduk_kwitansi_nilaiField.getValue();
		if(/^\d+$/.test(kwitansi_nilai))
			kwitansi_nilai=jproduk_kwitansi_nilaiField.getValue();
		else
			kwitansi_nilai=0;
		
		kwitansi_nilai2=jproduk_kwitansi_nilai2Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai2))
			kwitansi_nilai2=jproduk_kwitansi_nilai2Field.getValue();
		else
			kwitansi_nilai2=0;
		
		kwitansi_nilai3=jproduk_kwitansi_nilai3Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai3))
			kwitansi_nilai3=jproduk_kwitansi_nilai3Field.getValue();
		else
			kwitansi_nilai3=0;
		
		card_nilai=jproduk_card_nilaiField.getValue();
		if(/^\d+$/.test(card_nilai))
			card_nilai=jproduk_card_nilaiField.getValue();
		else
			card_nilai=0;
		
		card_nilai2=jproduk_card_nilai2Field.getValue();
		if(/^\d+$/.test(card_nilai2))
			card_nilai2=jproduk_card_nilai2Field.getValue();
		else
			card_nilai2=0;
		
		card_nilai3=jproduk_card_nilai3Field.getValue();
		if(/^\d+$/.test(card_nilai3))
			card_nilai3=jproduk_card_nilai3Field.getValue();
		else
			card_nilai3=0;
		
		cek_nilai=jproduk_cek_nilaiField.getValue();
		if(/^\d+$/.test(cek_nilai))
			cek_nilai=jproduk_cek_nilaiField.getValue();
		else
			cek_nilai=0;
		
		cek_nilai2=jproduk_cek_nilai2Field.getValue();
		if(/^\d+$/.test(cek_nilai2))
			cek_nilai2=jproduk_cek_nilai2Field.getValue();
		else
			cek_nilai2=0;
		
		cek_nilai3=jproduk_cek_nilai3Field.getValue();
		if(/^\d+$/.test(cek_nilai3))
			cek_nilai3=jproduk_cek_nilai3Field.getValue();
		else
			cek_nilai3=0;
		
		voucher_nilai=jproduk_voucher_cashbackField.getValue();
		if(/^\d+$/.test(voucher_nilai))
			voucher_nilai=jproduk_voucher_cashbackField.getValue();
		else
			voucher_nilai=0;
		
		voucher_nilai2=jproduk_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai2))
			voucher_nilai2=jproduk_voucher_cashback3Field.getValue();
		else
			voucher_nilai2=0;
		
		voucher_nilai3=jproduk_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai3))
			voucher_nilai3=jproduk_voucher_cashback3Field.getValue();
		else
			voucher_nilai3=0;

		tunai_nilai=jproduk_tunai_nilaiField.getValue();
		if(/^\d+$/.test(tunai_nilai))
			tunai_nilai=jproduk_tunai_nilaiField.getValue();
		else
			tunai_nilai=0;

		tunai_nilai2=jproduk_tunai_nilai2Field.getValue();
		if(/^\d+$/.test(tunai_nilai2))
			tunai_nilai2=jproduk_tunai_nilai2Field.getValue();
		else
			tunai_nilai2=0;

		tunai_nilai3=jproduk_tunai_nilai3Field.getValue();
		if(/^\d+$/.test(tunai_nilai3))
			tunai_nilai3=jproduk_tunai_nilai3Field.getValue();
		else
			tunai_nilai3=0;


		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		total_bayar=(total_bayar>0?Math.round(total_bayar):0);
		jproduk_bayarField.setValue(total_bayar);

		//total_hutang=total_harga-jproduk_bayarField.getValue()-jproduk_transfer_nilaiField.getValue()-jproduk_transfer_nilai2Field.getValue()-jproduk_transfer_nilai3Field.getValue()-jproduk_kwitansi_nilaiField.getValue()-jproduk_kwitansi_nilai2Field.getValue()-jproduk_kwitansi_nilai3Field.getValue()-jproduk_card_nilaiField.getValue()-jproduk_card_nilai2Field.getValue()-jproduk_card_nilai3Field.getValue()-jproduk_cek_nilaiField.getValue()-jproduk_cek_nilai2Field.getValue()-jproduk_cek_nilai3Field.getValue()-jproduk_voucher_cashbackField.getValue()-jproduk_voucher_cashback2Field.getValue()-jproduk_voucher_cashback3Field.getValue();
		total_hutang=total_harga-total_bayar;
		total_hutang=(total_hutang>0?Math.round(total_hutang):0);
		jproduk_hutangField.setValue(total_hutang);
	}

	function load_total_bayar_updating(){
		var update_total_field=0;
		var update_hutang_field=0;
		var jproduk_bayar_temp=jproduk_bayarField.getValue();
		var total_bayar=0;

		var transfer_nilai=0;
		var transfer_nilai2=0;
		var transfer_nilai3=0;
		var kwitansi_nilai=0;
		var kwitansi_nilai2=0;
		var kwitansi_nilai3=0;
		var card_nilai=0;
		var card_nilai2=0;
		var card_nilai3=0;
		var cek_nilai=0;
		var cek_nilai2=0;
		var cek_nilai3=0;
		var voucher_nilai=0;
		var voucher_nilai2=0;
		var voucher_nilai3=0;
		
		transfer_nilai=jproduk_transfer_nilaiField.getValue();
		if(/^\d+$/.test(transfer_nilai))
			transfer_nilai=jproduk_transfer_nilaiField.getValue();
		else
			transfer_nilai=0;

		transfer_nilai2=jproduk_transfer_nilai2Field.getValue();
		if(/^\d+$/.test(transfer_nilai2))
			transfer_nilai2=jproduk_transfer_nilai2Field.getValue();
		else
			transfer_nilai2=0;
		
		transfer_nilai3=jproduk_transfer_nilai3Field.getValue();
		if(/^\d+$/.test(transfer_nilai3))
			transfer_nilai3=jproduk_transfer_nilai3Field.getValue();
		else
			transfer_nilai3=0;
		
		kwitansi_nilai=jproduk_kwitansi_nilaiField.getValue();
		if(/^\d+$/.test(kwitansi_nilai))
			kwitansi_nilai=jproduk_kwitansi_nilaiField.getValue();
		else
			kwitansi_nilai=0;
		
		kwitansi_nilai2=jproduk_kwitansi_nilai2Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai2))
			kwitansi_nilai2=jproduk_kwitansi_nilai2Field.getValue();
		else
			kwitansi_nilai2=0;
		
		kwitansi_nilai3=jproduk_kwitansi_nilai3Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai3))
			kwitansi_nilai3=jproduk_kwitansi_nilai3Field.getValue();
		else
			kwitansi_nilai3=0;
		
		card_nilai=jproduk_card_nilaiField.getValue();
		if(/^\d+$/.test(card_nilai))
			card_nilai=jproduk_card_nilaiField.getValue();
		else
			card_nilai=0;
		
		card_nilai2=jproduk_card_nilai2Field.getValue();
		if(/^\d+$/.test(card_nilai2))
			card_nilai2=jproduk_card_nilai2Field.getValue();
		else
			card_nilai2=0;
		
		card_nilai3=jproduk_card_nilai3Field.getValue();
		if(/^\d+$/.test(card_nilai3))
			card_nilai3=jproduk_card_nilai3Field.getValue();
		else
			card_nilai3=0;
		
		cek_nilai=jproduk_cek_nilaiField.getValue();
		if(/^\d+$/.test(cek_nilai))
			cek_nilai=jproduk_cek_nilaiField.getValue();
		else
			cek_nilai=0;
		
		cek_nilai2=jproduk_cek_nilai2Field.getValue();
		if(/^\d+$/.test(cek_nilai2))
			cek_nilai2=jproduk_cek_nilai2Field.getValue();
		else
			cek_nilai2=0;
		
		cek_nilai3=jproduk_cek_nilai3Field.getValue();
		if(/^\d+$/.test(cek_nilai3))
			cek_nilai3=jproduk_cek_nilai3Field.getValue();
		else
			cek_nilai3=0;
		
		voucher_nilai=jproduk_voucher_cashbackField.getValue();
		if(/^\d+$/.test(voucher_nilai))
			voucher_nilai=jproduk_voucher_cashbackField.getValue();
		else
			voucher_nilai=0;
		
		voucher_nilai2=jproduk_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai2))
			voucher_nilai2=jproduk_voucher_cashback3Field.getValue();
		else
			voucher_nilai2=0;
		
		voucher_nilai3=jproduk_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai3))
			voucher_nilai3=jproduk_voucher_cashback3Field.getValue();
		else
			voucher_nilai3=0;

		tunai_nilai=jproduk_tunai_nilaiField.getValue();
		if(/^\d+$/.test(tunai_nilai))
			tunai_nilai=jproduk_tunai_nilaiField.getValue();
		else
			tunai_nilai=0;

		tunai_nilai2=jproduk_tunai_nilai2Field.getValue();
		if(/^\d+$/.test(tunai_nilai2))
			tunai_nilai2=jproduk_tunai_nilai2Field.getValue();
		else
			tunai_nilai2=0;

		tunai_nilai3=jproduk_tunai_nilai3Field.getValue();
		if(/^\d+$/.test(tunai_nilai3))
			tunai_nilai3=jproduk_tunai_nilai3Field.getValue();
		else
			tunai_nilai3=0;

		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		
		update_total_field=jproduk_subTotalField.getValue()*((100-jproduk_diskonField.getValue())/100)-jproduk_cashbackField.getValue();
		jproduk_totalField.setValue(update_total_field);

		jproduk_bayarField.setValue(total_bayar);
		
		update_hutang_field=update_total_field-total_bayar;
		jproduk_hutangField.setValue(update_hutang_field);

		jproduk_diskonField.setValue(jproduk_diskonField.getValue());
		jproduk_cashbackField.setValue(jproduk_cashbackField.getValue());


/*
		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		total_bayar=(total_bayar>0?Math.round(total_bayar):0);
		jproduk_bayarField.setValue(total_bayar);

		//total_hutang=total_harga-jproduk_bayarField.getValue()-jproduk_transfer_nilaiField.getValue()-jproduk_transfer_nilai2Field.getValue()-jproduk_transfer_nilai3Field.getValue()-jproduk_kwitansi_nilaiField.getValue()-jproduk_kwitansi_nilai2Field.getValue()-jproduk_kwitansi_nilai3Field.getValue()-jproduk_card_nilaiField.getValue()-jproduk_card_nilai2Field.getValue()-jproduk_card_nilai3Field.getValue()-jproduk_cek_nilaiField.getValue()-jproduk_cek_nilai2Field.getValue()-jproduk_cek_nilai3Field.getValue()-jproduk_voucher_cashbackField.getValue()-jproduk_voucher_cashback2Field.getValue()-jproduk_voucher_cashback3Field.getValue();
		total_hutang=total_harga-total_bayar;
		total_hutang=(total_hutang>0?Math.round(total_hutang):0);
		jproduk_hutangField.setValue(total_hutang);
*/
		
	}
	
	function load_all_jual_produk(){
		load_total_produk_bayar();
	}
	//event on update of detail data store
	detail_jual_produk_DataStore.on("update",load_all_jual_produk);
	//detail_jual_produk_DataStore.on("load",load_total_produk_bayar);
	jproduk_bayarField.on("keyup",load_total_produk_bayar);
	jproduk_diskonField.on("keyup",load_total_produk_bayar);
	jproduk_cashbackField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	//kwitansi
	jproduk_kwitansi_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_kwitansi_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_kwitansi_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	//card
	jproduk_card_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_card_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_card_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	//cek/giro
	jproduk_cek_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_cek_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_cek_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	//transfer
	jproduk_transfer_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_transfer_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_transfer_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	//voucher
	jproduk_voucher_cashbackField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_voucher_cashback2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_voucher_cashback3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	//tunai
	jproduk_tunai_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_tunai_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jproduk_tunai_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	
	jproduk_caraField.on("select",update_group_carabayar_jual_produk);
	jproduk_cara2Field.on("select",update_group_carabayar2_jual_produk);
	jproduk_cara3Field.on("select",update_group_carabayar3_jual_produk);
	jproduk_custField.on("select",function(){
		load_membership();
		j=memberDataStore.find('member_cust',jproduk_custField.getValue());
		if(j>-1)
			jproduk_cust_nomemberField.setValue(memberDataStore.getAt(j).member_no);
		else
			jproduk_cust_nomemberField.setValue("");

		cbo_cust=cbo_cust_jual_produk_DataStore.find('cust_id',jproduk_custField.getValue());
		if(cbo_cust>-1){
			cbo_kwitansi_jual_produk_DataStore.load({params: {kwitansi_cust: cbo_cust_jual_produk_DataStore.getAt(cbo_cust).data.cust_id}});
			jproduk_cek_namaField.setValue(cbo_cust_jual_produk_DataStore.getAt(cbo_cust).data.cust_nama);
			jproduk_cek_nama2Field.setValue(cbo_cust_jual_produk_DataStore.getAt(cbo_cust).data.cust_nama);
			jproduk_cek_nama3Field.setValue(cbo_cust_jual_produk_DataStore.getAt(cbo_cust).data.cust_nama);

			jproduk_transfer_namaField.setValue(cbo_cust_jual_produk_DataStore.getAt(cbo_cust).data.cust_nama);
			jproduk_transfer_nama2Field.setValue(cbo_cust_jual_produk_DataStore.getAt(cbo_cust).data.cust_nama);
			jproduk_transfer_nama3Field.setValue(cbo_cust_jual_produk_DataStore.getAt(cbo_cust).data.cust_nama);
		}
	});
	
	function show_windowGrid(){
		//cbo_dproduk_satuanDataStore.load();
		master_jual_produk_DataStore.load({
			params: {start: 0, limit: pageS},
			callback: function(opts, success, response){
				if(success){
					master_jual_produk_createWindow.show();
				}
			}
		});	// load DataStore
	}
	
	/* Function for retrieve create Window Panel*/ 
	master_jual_produk_createForm = new Ext.FormPanel({
		title: 'Penjualan Produk',
		labelAlign: 'left',
		el: 'form_produk_addEdit',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 950,
		frame: true,
		layout: 'fit',
		items: [master_jual_produk_masterGroup,detail_jual_produkListEditorGrid,master_jual_produk_bayarGroup]
		,
		buttons: [
			{
				text: '<span style="font-weight:bold">Show List</span>',
				handler: show_windowGrid
			},
			{
				xtype:'spacer',
				width: 560
			},
			{
				text: 'Save and Print',
				handler: save_andPrint
			},
			{
				text: 'Save',
				handler: master_jual_produk_create
			},
			{
				text: 'Cancel',
				handler: function(){
					master_jual_produk_reset_form();
					detail_jual_produk_DataStore.load({params: {master_id:0}});
					master_cara_bayarTabPanel.setActiveTab(0);
					post2db="CREATE";
				}
			}
		]
	});
	/* End  of Function*/
	
	
	/* Function for retrieve create Window Form */
	master_jual_produk_createWindow= new Ext.Window({
		id: 'master_jual_produk_createWindow',
		//title: post2db+'Master_jual_produk',
		title: 'Daftar Penjualan Produk',
		closable:true,
		closeAction: 'hide',
		//autoWidth: true,
		width:810,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_jual_produk_create',
		items: master_jual_produkListEditorGrid
	});
	/* End Window */
	
	/* Function for action list search */
	function master_jual_produk_list_search(){
		// render according to a SQL date format.
		var jproduk_id_search=null;
		var jproduk_nobukti_search=null;
		var jproduk_cust_search=null;
		var jproduk_tanggal_search_date="";
		var jproduk_diskon_search=null;
		var jproduk_cara_search=null;
		var jproduk_keterangan_search=null;

		if(jproduk_idSearchField.getValue()!==null){jproduk_id_search=jproduk_idSearchField.getValue();}
		if(jproduk_nobuktiSearchField.getValue()!==null){jproduk_nobukti_search=jproduk_nobuktiSearchField.getValue();}
		if(jproduk_custSearchField.getValue()!==null){jproduk_cust_search=jproduk_custSearchField.getValue();}
		if(jproduk_tanggalSearchField.getValue()!==""){jproduk_tanggal_search_date=jproduk_tanggalSearchField.getValue().format('Y-m-d');}
		if(jproduk_diskonSearchField.getValue()!==null){jproduk_diskon_search=jproduk_diskonSearchField.getValue();}
		if(jproduk_caraSearchField.getValue()!==null){jproduk_cara_search=jproduk_caraSearchField.getValue();}
		if(jproduk_keteranganSearchField.getValue()!==null){jproduk_keterangan_search=jproduk_keteranganSearchField.getValue();}
		// change the store parameters
		master_jual_produk_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jproduk_id	:	jproduk_id_search, 
			jproduk_nobukti	:	jproduk_nobukti_search, 
			jproduk_cust	:	jproduk_cust_search, 
			jproduk_tanggal	:	jproduk_tanggal_search_date, 
			jproduk_diskon	:	jproduk_diskon_search, 
			jproduk_cara	:	jproduk_cara_search, 
			jproduk_keterangan	:	jproduk_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		master_jual_produk_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_jual_produk_reset_search(){
		// reset the store parameters
		master_jual_produk_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_jual_produk_DataStore.reload({params: {start: 0, limit: pageS}});
		master_jual_produk_searchWindow.close();
	};
	/* End of Fuction */

	function master_jual_produk_reset_SearchForm(){
		jproduk_nobuktiSearchField.reset();
		jproduk_custSearchField.reset();
		jproduk_tanggalSearchField.reset();
		jproduk_diskonSearchField.reset();
		jproduk_caraSearchField.reset();
		jproduk_keteranganSearchField.reset();
	}
	
	/* Field for search */
	/* Identify  jproduk_id Search Field */
	jproduk_idSearchField= new Ext.form.NumberField({
		id: 'jproduk_idSearchField',
		fieldLabel: 'Jproduk Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jproduk_nobukti Search Field */
	jproduk_nobuktiSearchField= new Ext.form.TextField({
		id: 'jproduk_nobuktiSearchField',
		fieldLabel: 'No. Faktur',
		maxLength: 30,
	//	anchor: '95%'
	
	});
	/* Identify  jproduk_cust Search Field */
	jproduk_custSearchField= new Ext.form.TextField({
		id: 'jproduk_custSearchField',
		fieldLabel: 'Customer',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  jproduk_tanggal Search Field */
	jproduk_tanggalSearchField= new Ext.form.DateField({
		id: 'jproduk_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y',
	
	});
	/* Identify  jproduk_diskon Search Field */
	jproduk_diskonSearchField= new Ext.form.NumberField({
		id: 'jproduk_diskonSearchField',
		fieldLabel: 'Diskon',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jproduk_cara Search Field */
	jproduk_caraSearchField= new Ext.form.ComboBox({
		id: 'jproduk_caraSearchField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jproduk_cara'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jproduk_cara',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jproduk_keterangan Search Field */
	jproduk_keteranganSearchField= new Ext.form.TextArea({
		id: 'jproduk_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_jual_produk_searchForm = new Ext.FormPanel({
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
				items: [jproduk_nobuktiSearchField, jproduk_custSearchField, jproduk_tanggalSearchField, jproduk_diskonSearchField, jproduk_caraSearchField, jproduk_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_jual_produk_list_search
			},{
				text: 'Close',
				handler: function(){
					master_jual_produk_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_jual_produk_searchWindow = new Ext.Window({
		title: 'master_jual_produk Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_jual_produk_search',
		items: master_jual_produk_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_jual_produk_searchWindow.isVisible()){
			master_jual_produk_reset_SearchForm();
			master_jual_produk_searchWindow.show();
		} else {
			master_jual_produk_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_jual_produk_print(){
		var searchquery = "";
		var jproduk_nobukti_print=null;
		var jproduk_cust_print=null;
		var jproduk_tanggal_print_date="";
		var jproduk_diskon_print=null;
		var jproduk_cara_print=null;
		var jproduk_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_produk_DataStore.baseParams.query!==null){searchquery = master_jual_produk_DataStore.baseParams.query;}
		if(master_jual_produk_DataStore.baseParams.jproduk_nobukti!==null){jproduk_nobukti_print = master_jual_produk_DataStore.baseParams.jproduk_nobukti;}
		if(master_jual_produk_DataStore.baseParams.jproduk_cust!==null){jproduk_cust_print = master_jual_produk_DataStore.baseParams.jproduk_cust;}
		if(master_jual_produk_DataStore.baseParams.jproduk_tanggal!==""){jproduk_tanggal_print_date = master_jual_produk_DataStore.baseParams.jproduk_tanggal;}
		if(master_jual_produk_DataStore.baseParams.jproduk_diskon!==null){jproduk_diskon_print = master_jual_produk_DataStore.baseParams.jproduk_diskon;}
		if(master_jual_produk_DataStore.baseParams.jproduk_cara!==null){jproduk_cara_print = master_jual_produk_DataStore.baseParams.jproduk_cara;}
		if(master_jual_produk_DataStore.baseParams.jproduk_keterangan!==null){jproduk_keterangan_print = master_jual_produk_DataStore.baseParams.jproduk_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_master_jual_produk&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jproduk_nobukti : jproduk_nobukti_print,
			jproduk_cust : jproduk_cust_print,
		  	jproduk_tanggal : jproduk_tanggal_print_date, 
			jproduk_diskon : jproduk_diskon_print,
			jproduk_cara : jproduk_cara_print,
			jproduk_keterangan : jproduk_keterangan_print,
		  	currentlisting: master_jual_produk_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_jual_produklist.html','master_jual_produklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_jual_produk_export_excel(){
		var searchquery = "";
		var jproduk_nobukti_2excel=null;
		var jproduk_cust_2excel=null;
		var jproduk_tanggal_2excel_date="";
		var jproduk_diskon_2excel=null;
		var jproduk_cara_2excel=null;
		var jproduk_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_produk_DataStore.baseParams.query!==null){searchquery = master_jual_produk_DataStore.baseParams.query;}
		if(master_jual_produk_DataStore.baseParams.jproduk_nobukti!==null){jproduk_nobukti_2excel = master_jual_produk_DataStore.baseParams.jproduk_nobukti;}
		if(master_jual_produk_DataStore.baseParams.jproduk_cust!==null){jproduk_cust_2excel = master_jual_produk_DataStore.baseParams.jproduk_cust;}
		if(master_jual_produk_DataStore.baseParams.jproduk_tanggal!==""){jproduk_tanggal_2excel_date = master_jual_produk_DataStore.baseParams.jproduk_tanggal;}
		if(master_jual_produk_DataStore.baseParams.jproduk_diskon!==null){jproduk_diskon_2excel = master_jual_produk_DataStore.baseParams.jproduk_diskon;}
		if(master_jual_produk_DataStore.baseParams.jproduk_cara!==null){jproduk_cara_2excel = master_jual_produk_DataStore.baseParams.jproduk_cara;}
		if(master_jual_produk_DataStore.baseParams.jproduk_keterangan!==null){jproduk_keterangan_2excel = master_jual_produk_DataStore.baseParams.jproduk_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_master_jual_produk&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jproduk_nobukti : jproduk_nobukti_2excel,
			jproduk_cust : jproduk_cust_2excel,
		  	jproduk_tanggal : jproduk_tanggal_2excel_date, 
			jproduk_diskon : jproduk_diskon_2excel,
			jproduk_cara : jproduk_cara_2excel,
			jproduk_keterangan : jproduk_keterangan_2excel,
		  	currentlisting: master_jual_produk_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	function pertamax(){
		post2db="CREATE";
		jproduk_tanggalField.setValue(dt.format('Y-m-d'));
		master_jual_produk_createForm.render();
		jproduk_caraField.setValue('card');
		master_jual_produk_cardGroup.setVisible(true);
	}
	pertamax();
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_jual_produk"></div>
         <div id="fp_detail_jual_produk"></div>
		<div id="elwindow_master_jual_produk_create"></div>
        <div id="elwindow_master_jual_produk_search"></div>
        <div id="form_produk_addEdit"></div>
    </div>
</div>
</body>