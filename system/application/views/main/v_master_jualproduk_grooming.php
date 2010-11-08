<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_produk View
	+ Description	: For record view
	+ Filename 		: v_master_jpgrooming_SelectedRow.php
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
var master_jpgrooming_DataStore;
var kwitansi_jpgrooming_DataStore;
var card_jpgrooming_DataStore;
var cek_jpgrooming_DataStore;
var transfer_jpgrooming_DataStore;
//
var master_jpgrooming_ColumnModel;
var master_jpgroomingListEditorGrid;
var master_jpgrooming_createForm;
var master_jpgrooming_createWindow;
var master_jpgrooming_searchForm;
var master_jpgrooming_searchWindow;
var master_jpgrooming_SelectedRow;
var master_jpgrooming_ContextMenu;
//for detail data
var detail_jpgrooming_DataStore;
var detail_jpgroomingListEditorGrid;
var detail_jpgrooming_ColumnModel;
var detail_jualproduk_grooming_proxy;
var detail_jualproduk_grooming_writer;
var detail_jualproduk_grooming_reader;
var editor_detail_jualproduk_grooming;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var jpgrooming_idField;
var jpgrooming_nobuktiField;
var jpgrooming_karyawanField;
var jpgrooming_tanggalField;
var jpgrooming_diskonField;
var jpgrooming_bayarField;
var jpgrooming_caraField;
var jpgrooming_cara2Field;
var jpgrooming_cara3Field;
var jpgrooming_keteranganField;
//tunai
var jpgrooming_tunai_nilaiField;
//tunai-2
var jpgrooming_tunai_nilai2Field;
//tunai-3
var jpgrooming_tunai_nilai3Field;
//voucher
var jpgrooming_voucher_noField;
var jpgrooming_voucher_cashbackField;
//voucher-2
var jpgrooming_voucher_no2Field;
var jpgrooming_voucher_cashback2Field;
//voucher-3
var jpgrooming_voucher_no3Field;
var jpgrooming_voucher_cashback3Field;

var jpgrooming_cashbackField;
var is_member=false;
//kwitansi
var jpgrooming_kwitansi_namaField;
var jpgrooming_kwitansi_nilaiField;
var jpgrooming_kwitansi_noField;
//kwitansi-2
var jpgrooming_kwitansi_nama2Field;
var jpgrooming_kwitansi_nilai2Field;
var jpgrooming_kwitansi_no2Field;
//kwitansi-3
var jpgrooming_kwitansi_nama3Field;
var jpgrooming_kwitansi_nilai3Field;
var jpgrooming_kwitansi_no3Field;

//card
var jpgrooming_card_namaField;
var jpgrooming_card_edcField;
var jpgrooming_card_noField;
var jpgrooming_card_nilaiField;
//card-2
var jpgrooming_card_nama2Field;
var jpgrooming_card_edc2Field;
var jpgrooming_card_no2Field;
var jpgrooming_card_nilai2Field;
//card-3
var jpgrooming_card_nama3Field;
var jpgrooming_card_edc3Field;
var jpgrooming_card_no3Field;
var jpgrooming_card_nilai3Field;

//cek
var jpgrooming_cek_namaField;
var jpgrooming_cek_noField;
var jpgrooming_cek_validField;
var jpgrooming_cek_bankField;
var jpgrooming_cek_nilaiField;
//cek-2
var jpgrooming_cek_nama2Field;
var jpgrooming_cek_no2Field;
var jpgrooming_cek_valid2Field;
var jpgrooming_cek_bank2Field;
var jpgrooming_cek_nilai2Field;
//cek-3
var jpgrooming_cek_nama3Field;
var jpgrooming_cek_no3Field;
var jpgrooming_cek_valid3Field;
var jpgrooming_cek_bank3Field;
var jpgrooming_cek_nilai3Field;

//transfer
var jpgrooming_transfer_bankField;
var jpgrooming_transfer_namaField;
var jpgrooming_transfer_nilaiField;
//transfer-2
var jpgrooming_transfer_bank2Field;
var jpgrooming_transfer_nama2Field;
var jpgrooming_transfer_nilai2Field;
//transfer-3
var jpgrooming_transfer_bank3Field;
var jpgrooming_transfer_nama3Field;
var jpgrooming_transfer_nilai3Field;

var jpgrooming_idSearchField;
var jpgrooming_nobuktiSearchField;
var jpgrooming_karyawanSearchField;
var jpgrooming_tanggalSearchField;
var jpgrooming_diskonSearchField;
var jpgrooming_caraSearchField;
var jpgrooming_keteranganSearchField;
var dt= new Date();

var printed=0;
var looping=0;
/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */

  	Ext.util.Format.comboRenderer = function(combo){
  		//jpgrooming_bankDataStore.load();
  	    return function(value){
  	        var record = combo.findRecord(combo.valueField, value);
  	        return record ? record.get(combo.displayField) : combo.valueNotFoundText;
  	    }
  	}
	
	var total_sub_temp=0;
  
  	/* Function for Saving inLine Editing */
	function master_jpgrooming_SelectedRow_update(oGrid_event){
		var jpgrooming_id_update_pk="";
		var jpgrooming_nobukti_update=null;
		var jpgrooming_karyawan_update=null;
		var jpgrooming_tanggal_update_date="";
		var jpgrooming_diskon_update=null;
		var jpgrooming_cara_update=null;
		var jpgrooming_keterangan_update=null;

		jpgrooming_id_update_pk = oGrid_event.record.data.jpgrooming_id;
		if(oGrid_event.record.data.jpgrooming_nobukti!== null){jpgrooming_nobukti_update = oGrid_event.record.data.jpgrooming_nobukti;}
		if(oGrid_event.record.data.jpgrooming_karyawan!== null){jpgrooming_karyawan_update = oGrid_event.record.data.jpgrooming_karyawan;}
	 	if(oGrid_event.record.data.jpgrooming_tanggal!== ""){jpgrooming_tanggal_update_date =oGrid_event.record.data.jpgrooming_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jpgrooming_diskon!== null){jpgrooming_diskon_update = oGrid_event.record.data.jpgrooming_diskon;}
		if(oGrid_event.record.data.jpgrooming_cara!== null){jpgrooming_cara_update = oGrid_event.record.data.jpgrooming_cara;}
		if(oGrid_event.record.data.jpgrooming_keterangan!== null){jpgrooming_keterangan_update = oGrid_event.record.data.jpgrooming_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_action',
			params: {
				task: "UPDATE",
				jpgrooming_id	: jpgrooming_id_update_pk, 
				jpgrooming_nobukti	:jpgrooming_nobukti_update,  
				jpgrooming_karyawan	:jpgrooming_karyawan_update,  
				jpgrooming_tanggal	: jpgrooming_tanggal_update_date, 
				jpgrooming_diskon	:jpgrooming_diskon_update,  
				jpgrooming_cara	:jpgrooming_cara_update,  
				jpgrooming_keterangan	:jpgrooming_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_jpgrooming_DataStore.commitChanges();
						master_jpgrooming_DataStore.reload();
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
				   msg: 'Tidak bisa terhubung dengan database server',
				   buttons: Ext.MessageBox.OK,
				   animEl: 'database',
				   icon: Ext.MessageBox.ERROR
				});	
			}									    
		});   
	}
  	/* End of Function */
  
  	/* Function for add data, open window create form */
	function master_jpgrooming_SelectedRow_create(){
		var dpgrooming_produk_id="";
		for(i=0; i<detail_jpgrooming_DataStore.getCount(); i++){
			detail_jual_produk_record=detail_jpgrooming_DataStore.getAt(i);
			if(/^\d+$/.test(detail_jual_produk_record.data.dpgrooming_produk)){
				dpgrooming_produk_id="ada";
			}
		}
	
		if(is_master_jual_produk_form_valid() && dpgrooming_produk_id=="ada" && (/^\d+$/.test(jpgrooming_karyawanField.getValue()) || get_pk_id())){	
		var jpgrooming_id_create_pk=null; 
		var jpgrooming_nobukti_create=null; 
		var jpgrooming_karyawan_create=null; 
		var jpgrooming_tanggal_create_date=""; 
		var jpgrooming_diskon_create=null; 
		var jpgrooming_cara_create=null; 
		var jpgrooming_cara2_create=null; 
		var jpgrooming_cara3_create=null; 
		var jpgrooming_keterangan_create=null; 
		//tunai
		var jpgrooming_tunai_nilai_create=null;
		//tunai-2
		var jpgrooming_tunai_nilai2_create=null;
		//tunai-3
		var jpgrooming_tunai_nilai3_create=null;
		//voucher
		var jpgrooming_voucher_no_create="";
		var jpgrooming_voucher_cashback_create=null;
		//voucher-2
		var jpgrooming_voucher_no2_create="";
		var jpgrooming_voucher_cashback2_create=null;
		//voucher-3
		var jpgrooming_voucher_no3_create="";
		var jpgrooming_voucher_cashback3_create=null;
		
		var jpgrooming_cashback_create=null;
		//bayar
		var jpgrooming_subtotal_create=null;
		var jpgrooming_total_create=null;
		var jpgrooming_bayar_create=null;
		var jpgrooming_hutang_create=null;
		//kwitansi
		var jpgrooming_kwitansi_nama_create="";
		var jpgrooming_kwitansi_nomor_create="";
		var jpgrooming_kwitansi_nilai_create=null;
		//kwitansi-2
		var jpgrooming_kwitansi_nama2_create="";
		var jpgrooming_kwitansi_nomor2_create="";
		var jpgrooming_kwitansi_nilai2_create=null;
		//kwitansi-3
		var jpgrooming_kwitansi_nama3_create="";
		var jpgrooming_kwitansi_nomor3_create="";
		var jpgrooming_kwitansi_nilai3_create=null;
		//card
		var jpgrooming_card_nama_create="";
		var jpgrooming_card_edc_create="";
		var jpgrooming_card_no_create="";
		var jpgrooming_card_nilai_create=null;
		//card-2
		var jpgrooming_card_nama2_create="";
		var jpgrooming_card_edc2_create="";
		var jpgrooming_card_no2_create="";
		var jpgrooming_card_nilai2_create=null;
		//card-3
		var jpgrooming_card_nama3_create="";
		var jpgrooming_card_edc3_create="";
		var jpgrooming_card_no3_create="";
		var jpgrooming_card_nilai3_create=null;
		//cek
		var jpgrooming_cek_nama_create=null;
		var jpgrooming_cek_nomor_create="";
		var jpgrooming_cek_valid_create="";
		var jpgrooming_cek_bank_create="";
		var jpgrooming_cek_nilai_create=null;
		//cek-2
		var jpgrooming_cek_nama2_create=null;
		var jpgrooming_cek_nomor2_create="";
		var jpgrooming_cek_valid2_create="";
		var jpgrooming_cek_bank2_create="";
		var jpgrooming_cek_nilai2_create=null;
		//cek-3
		var jpgrooming_cek_nama3_create=null;
		var jpgrooming_cek_nomor3_create="";
		var jpgrooming_cek_valid3_create="";
		var jpgrooming_cek_bank3_create="";
		var jpgrooming_cek_nilai3_create=null;
		//transfer
		var jpgrooming_transfer_bank_create="";
		var jpgrooming_transfer_nama_create=null;
		var jpgrooming_transfer_nilai_create=null;
		//transfer-2
		var jpgrooming_transfer_bank2_create="";
		var jpgrooming_transfer_nama2_create=null;
		var jpgrooming_transfer_nilai2_create=null;
		//transfer-3
		var jpgrooming_transfer_bank3_create="";
		var jpgrooming_transfer_nama3_create=null;
		var jpgrooming_transfer_nilai3_create=null;

		if(jpgrooming_idField.getValue()!== null){jpgrooming_id_create_pk = jpgrooming_idField.getValue();}else{jpgrooming_id_create_pk=get_pk_id();} 
		if(jpgrooming_nobuktiField.getValue()!== null){jpgrooming_nobukti_create = jpgrooming_nobuktiField.getValue();} 
		if(jpgrooming_karyawanField.getValue()!== null){jpgrooming_karyawan_create = jpgrooming_karyawanField.getValue();} 
		if(jpgrooming_tanggalField.getValue()!== ""){jpgrooming_tanggal_create_date = jpgrooming_tanggalField.getValue().format('Y-m-d');} 
		if(jpgrooming_diskonField.getValue()!== null){jpgrooming_diskon_create = jpgrooming_diskonField.getValue();} 
		if(jpgrooming_caraField.getValue()!== null){jpgrooming_cara_create = jpgrooming_caraField.getValue();} 
		if(jpgrooming_cara2Field.getValue()!== null){jpgrooming_cara2_create = jpgrooming_cara2Field.getValue();} 
		if(jpgrooming_cara3Field.getValue()!== null){jpgrooming_cara3_create = jpgrooming_cara3Field.getValue();} 
		if(jpgrooming_keteranganField.getValue()!== null){jpgrooming_keterangan_create = jpgrooming_keteranganField.getValue();} 
		//tunai
		if(jpgrooming_tunai_nilaiField.getValue()!== null){jpgrooming_tunai_nilai_create = jpgrooming_tunai_nilaiField.getValue();}
		//tunai-2
		if(jpgrooming_tunai_nilai2Field.getValue()!== null){jpgrooming_tunai_nilai2_create = jpgrooming_tunai_nilai2Field.getValue();}
		//tunai-3
		if(jpgrooming_tunai_nilai3Field.getValue()!== null){jpgrooming_tunai_nilai3_create = jpgrooming_tunai_nilai3Field.getValue();}
		//voucher
		if(jpgrooming_voucher_noField.getValue()!== ""){jpgrooming_voucher_no_create = jpgrooming_voucher_noField.getValue();}
		if(jpgrooming_voucher_cashbackField.getValue()!== null){jpgrooming_voucher_cashback_create = jpgrooming_voucher_cashbackField.getValue();} 
		//voucher-2
		if(jpgrooming_voucher_no2Field.getValue()!== ""){jpgrooming_voucher_no2_create = jpgrooming_voucher_no2Field.getValue();} 
		if(jpgrooming_voucher_cashback2Field.getValue()!== null){jpgrooming_voucher_cashback2_create = jpgrooming_voucher_cashback2Field.getValue();} 
		//voucher-3
		if(jpgrooming_voucher_no3Field.getValue()!== ""){jpgrooming_voucher_no3_create = jpgrooming_voucher_no3Field.getValue();} 
		if(jpgrooming_voucher_cashback3Field.getValue()!== null){jpgrooming_voucher_cashback3_create = jpgrooming_voucher_cashback3Field.getValue();} 
		
		if(jpgrooming_cashbackField.getValue()!== null){jpgrooming_cashback_create = jpgrooming_cashbackField.getValue();} 
		//bayar
		if(jpgrooming_bayarField.getValue()!== null){jpgrooming_bayar_create = jpgrooming_bayarField.getValue();}
		if(jpgrooming_subTotalField.getValue()!== null){jpgrooming_subtotal_create = jpgrooming_subTotalField.getValue();} 
		if(jpgrooming_totalField.getValue()!== null){jpgrooming_total_create = jpgrooming_totalField.getValue();} 
		if(jpgrooming_hutangField.getValue()!== null){jpgrooming_hutang_create = jpgrooming_hutangField.getValue();} 
		//kwitansi value
		if(jpgrooming_kwitansi_noField.getValue()!== ""){jpgrooming_kwitansi_nomor_create = jpgrooming_kwitansi_noField.getValue();} 
		if(jpgrooming_kwitansi_namaField.getValue()!== ""){jpgrooming_kwitansi_nama_create = jpgrooming_kwitansi_namaField.getValue();} 
		if(jpgrooming_kwitansi_nilaiField.getValue()!== null){jpgrooming_kwitansi_nilai_create = jpgrooming_kwitansi_nilaiField.getValue();} 
		//kwitansi-2 value
		if(jpgrooming_kwitansi_no2Field.getValue()!== ""){jpgrooming_kwitansi_nomor2_create = jpgrooming_kwitansi_no2Field.getValue();} 
		if(jpgrooming_kwitansi_nama2Field.getValue()!== ""){jpgrooming_kwitansi_nama2_create = jpgrooming_kwitansi_nama2Field.getValue();} 
		if(jpgrooming_kwitansi_nilai2Field.getValue()!== null){jpgrooming_kwitansi_nilai2_create = jpgrooming_kwitansi_nilai2Field.getValue();} 
		//kwitansi-3 value
		if(jpgrooming_kwitansi_no3Field.getValue()!== ""){jpgrooming_kwitansi_nomor3_create = jpgrooming_kwitansi_no3Field.getValue();} 
		if(jpgrooming_kwitansi_nama3Field.getValue()!== ""){jpgrooming_kwitansi_nama3_create = jpgrooming_kwitansi_nama3Field.getValue();} 
		if(jpgrooming_kwitansi_nilai3Field.getValue()!== null){jpgrooming_kwitansi_nilai3_create = jpgrooming_kwitansi_nilai3Field.getValue();} 
		//card value
		if(jpgrooming_card_namaField.getValue()!== ""){jpgrooming_card_nama_create = jpgrooming_card_namaField.getValue();} 
		if(jpgrooming_card_edcField.getValue()!==""){jpgrooming_card_edc_create = jpgrooming_card_edcField.getValue();} 
		if(jpgrooming_card_noField.getValue()!==""){jpgrooming_card_no_create = jpgrooming_card_noField.getValue();}
		if(jpgrooming_card_nilaiField.getValue()!==null){jpgrooming_card_nilai_create = jpgrooming_card_nilaiField.getValue();} 
		//card-2 value
		if(jpgrooming_card_nama2Field.getValue()!== ""){jpgrooming_card_nama2_create = jpgrooming_card_nama2Field.getValue();} 
		if(jpgrooming_card_edc2Field.getValue()!==""){jpgrooming_card_edc2_create = jpgrooming_card_edc2Field.getValue();} 
		if(jpgrooming_card_no2Field.getValue()!==""){jpgrooming_card_no2_create = jpgrooming_card_no2Field.getValue();}
		if(jpgrooming_card_nilai2Field.getValue()!==null){jpgrooming_card_nilai2_create = jpgrooming_card_nilai2Field.getValue();} 
		//card-3 value
		if(jpgrooming_card_nama3Field.getValue()!== ""){jpgrooming_card_nama3_create = jpgrooming_card_nama3Field.getValue();} 
		if(jpgrooming_card_edc3Field.getValue()!==""){jpgrooming_card_edc3_create = jpgrooming_card_edc3Field.getValue();} 
		if(jpgrooming_card_no3Field.getValue()!==""){jpgrooming_card_no3_create = jpgrooming_card_no3Field.getValue();}
		if(jpgrooming_card_nilai3Field.getValue()!==null){jpgrooming_card_nilai3_create = jpgrooming_card_nilai3Field.getValue();} 
		//cek value
		if(jpgrooming_cek_namaField.getValue()!== null){jpgrooming_cek_nama_create = jpgrooming_cek_namaField.getValue();} 
		if(jpgrooming_cek_noField.getValue()!== ""){jpgrooming_cek_nomor_create = jpgrooming_cek_noField.getValue();} 
		if(jpgrooming_cek_validField.getValue()!== ""){jpgrooming_cek_valid_create = jpgrooming_cek_validField.getValue().format('Y-m-d');} 
		if(jpgrooming_cek_bankField.getValue()!== ""){jpgrooming_cek_bank_create = jpgrooming_cek_bankField.getValue();} 
		if(jpgrooming_cek_nilaiField.getValue()!== null){jpgrooming_cek_nilai_create = jpgrooming_cek_nilaiField.getValue();} 
		//cek-2 value
		if(jpgrooming_cek_nama2Field.getValue()!== null){jpgrooming_cek_nama2_create = jpgrooming_cek_nama2Field.getValue();} 
		if(jpgrooming_cek_no2Field.getValue()!== ""){jpgrooming_cek_nomor2_create = jpgrooming_cek_no2Field.getValue();} 
		if(jpgrooming_cek_valid2Field.getValue()!== ""){jpgrooming_cek_valid2_create = jpgrooming_cek_valid2Field.getValue().format('Y-m-d');} 
		if(jpgrooming_cek_bank2Field.getValue()!== ""){jpgrooming_cek_bank2_create = jpgrooming_cek_bank2Field.getValue();} 
		if(jpgrooming_cek_nilai2Field.getValue()!== null){jpgrooming_cek_nilai2_create = jpgrooming_cek_nilai2Field.getValue();} 
		//cek-3 value
		if(jpgrooming_cek_nama3Field.getValue()!== null){jpgrooming_cek_nama3_create = jpgrooming_cek_nama3Field.getValue();} 
		if(jpgrooming_cek_no3Field.getValue()!== ""){jpgrooming_cek_nomor3_create = jpgrooming_cek_no3Field.getValue();} 
		if(jpgrooming_cek_valid3Field.getValue()!== ""){jpgrooming_cek_valid3_create = jpgrooming_cek_valid3Field.getValue().format('Y-m-d');} 
		if(jpgrooming_cek_bank3Field.getValue()!== ""){jpgrooming_cek_bank3_create = jpgrooming_cek_bank3Field.getValue();} 
		if(jpgrooming_cek_nilai3Field.getValue()!== null){jpgrooming_cek_nilai3_create = jpgrooming_cek_nilai3Field.getValue();} 
		//transfer value
		if(jpgrooming_transfer_bankField.getValue()!== ""){jpgrooming_transfer_bank_create = jpgrooming_transfer_bankField.getValue();} 
		if(jpgrooming_transfer_namaField.getValue()!== null){jpgrooming_transfer_nama_create = jpgrooming_transfer_namaField.getValue();}
		if(jpgrooming_transfer_nilaiField.getValue()!== null){jpgrooming_transfer_nilai_create = jpgrooming_transfer_nilaiField.getValue();} 
		//transfer-2 value
		if(jpgrooming_transfer_bank2Field.getValue()!== ""){jpgrooming_transfer_bank2_create = jpgrooming_transfer_bank2Field.getValue();} 
		if(jpgrooming_transfer_nama2Field.getValue()!== null){jpgrooming_transfer_nama2_create = jpgrooming_transfer_nama2Field.getValue();}
		if(jpgrooming_transfer_nilai2Field.getValue()!== null){jpgrooming_transfer_nilai2_create = jpgrooming_transfer_nilai2Field.getValue();} 
		//transfer-3 value
		if(jpgrooming_transfer_bank3Field.getValue()!== ""){jpgrooming_transfer_bank3_create = jpgrooming_transfer_bank3Field.getValue();} 
		if(jpgrooming_transfer_nama3Field.getValue()!== null){jpgrooming_transfer_nama3_create = jpgrooming_transfer_nama3Field.getValue();}
		if(jpgrooming_transfer_nilai3Field.getValue()!== null){jpgrooming_transfer_nilai3_create = jpgrooming_transfer_nilai3Field.getValue();} 
		
		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_action',
			params: {
				task: post2db,
				jpgrooming_id			: 	jpgrooming_id_create_pk, 
				jpgrooming_nobukti		: 	jpgrooming_nobukti_create, 
				jpgrooming_karyawan		: 	jpgrooming_karyawan_create, 
				jpgrooming_tanggal		: 	jpgrooming_tanggal_create_date, 
				jpgrooming_diskon		: 	jpgrooming_diskon_create, 
				jpgrooming_cara		: 	jpgrooming_cara_create, 
				jpgrooming_cara2		: 	jpgrooming_cara2_create, 
				jpgrooming_cara3		: 	jpgrooming_cara3_create, 
				jpgrooming_keterangan	: 	jpgrooming_keterangan_create, 
				jpgrooming_cashback	: 	jpgrooming_cashback_create,
				//tunai
				jpgrooming_tunai_nilai	:	jpgrooming_tunai_nilai_create,
				//tunai-2
				jpgrooming_tunai_nilai2	:	jpgrooming_tunai_nilai2_create,
				//tunai-3
				jpgrooming_tunai_nilai3	:	jpgrooming_tunai_nilai3_create,
				//voucher
				jpgrooming_voucher_no	:	jpgrooming_voucher_no_create,
				jpgrooming_voucher_cashback	:	jpgrooming_voucher_cashback_create,
				//voucher-2
				jpgrooming_voucher_no2	:	jpgrooming_voucher_no2_create,
				jpgrooming_voucher_cashback2	:	jpgrooming_voucher_cashback2_create,
				//voucher-3
				jpgrooming_voucher_no3	:	jpgrooming_voucher_no3_create,
				jpgrooming_voucher_cashback3	:	jpgrooming_voucher_cashback3_create,
				
				//bayar
				jpgrooming_bayar			: 	jpgrooming_bayar_create,
				jpgrooming_subtotal			: 	jpgrooming_subtotal_create,
				jpgrooming_total			: 	jpgrooming_total_create,
				jpgrooming_hutang		: 	jpgrooming_hutang_create,
				//kwitansi posting
				jpgrooming_kwitansi_no		:	jpgrooming_kwitansi_nomor_create,
				jpgrooming_kwitansi_nama		:	jpgrooming_kwitansi_nama_create,
				jpgrooming_kwitansi_nilai		:	jpgrooming_kwitansi_nilai_create,
				//kwitansi-2 posting
				jpgrooming_kwitansi_no2		:	jpgrooming_kwitansi_nomor2_create,
				jpgrooming_kwitansi_nama2		:	jpgrooming_kwitansi_nama2_create,
				jpgrooming_kwitansi_nilai2		:	jpgrooming_kwitansi_nilai2_create,
				//kwitansi-3 posting
				jpgrooming_kwitansi_no3		:	jpgrooming_kwitansi_nomor3_create,
				jpgrooming_kwitansi_nama3		:	jpgrooming_kwitansi_nama3_create,
				jpgrooming_kwitansi_nilai3		:	jpgrooming_kwitansi_nilai3_create,
				//card posting
				jpgrooming_card_nama	: 	jpgrooming_card_nama_create,
				jpgrooming_card_edc	:	jpgrooming_card_edc_create,
				jpgrooming_card_no		:	jpgrooming_card_no_create,
				jpgrooming_card_nilai	:	jpgrooming_card_nilai_create,
				//card-2 posting
				jpgrooming_card_nama2	: 	jpgrooming_card_nama2_create,
				jpgrooming_card_edc2	:	jpgrooming_card_edc2_create,
				jpgrooming_card_no2	:	jpgrooming_card_no2_create,
				jpgrooming_card_nilai2	:	jpgrooming_card_nilai2_create,
				//card-3 posting
				jpgrooming_card_nama3	: 	jpgrooming_card_nama3_create,
				jpgrooming_card_edc3	:	jpgrooming_card_edc3_create,
				jpgrooming_card_no3	:	jpgrooming_card_no3_create,
				jpgrooming_card_nilai3	:	jpgrooming_card_nilai3_create,
				//cek posting
				jpgrooming_cek_nama	: 	jpgrooming_cek_nama_create,
				jpgrooming_cek_no		:	jpgrooming_cek_nomor_create,
				jpgrooming_cek_valid	: 	jpgrooming_cek_valid_create,
				jpgrooming_cek_bank	:	jpgrooming_cek_bank_create,
				jpgrooming_cek_nilai	:	jpgrooming_cek_nilai_create,
				//cek-2 posting
				jpgrooming_cek_nama2	: 	jpgrooming_cek_nama2_create,
				jpgrooming_cek_no2		:	jpgrooming_cek_nomor2_create,
				jpgrooming_cek_valid2	: 	jpgrooming_cek_valid2_create,
				jpgrooming_cek_bank2	:	jpgrooming_cek_bank2_create,
				jpgrooming_cek_nilai2	:	jpgrooming_cek_nilai2_create,
				//cek-3 posting
				jpgrooming_cek_nama3	: 	jpgrooming_cek_nama3_create,
				jpgrooming_cek_no3		:	jpgrooming_cek_nomor3_create,
				jpgrooming_cek_valid3	: 	jpgrooming_cek_valid3_create,
				jpgrooming_cek_bank3	:	jpgrooming_cek_bank3_create,
				jpgrooming_cek_nilai3	:	jpgrooming_cek_nilai3_create,
				//transfer posting
				jpgrooming_transfer_bank	:	jpgrooming_transfer_bank_create,
				jpgrooming_transfer_nama	:	jpgrooming_transfer_nama_create,
				jpgrooming_transfer_nilai	:	jpgrooming_transfer_nilai_create,
				//transfer-2 posting
				jpgrooming_transfer_bank2	:	jpgrooming_transfer_bank2_create,
				jpgrooming_transfer_nama2	:	jpgrooming_transfer_nama2_create,
				jpgrooming_transfer_nilai2	:	jpgrooming_transfer_nilai2_create,
				//transfer-3 posting
				jpgrooming_transfer_bank3	:	jpgrooming_transfer_bank3_create,
				jpgrooming_transfer_nama3	:	jpgrooming_transfer_nama3_create,
				jpgrooming_transfer_nilai3	:	jpgrooming_transfer_nilai3_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_jpgrooming_purge();
						//detail_jpgrooming_insert();
						//Ext.MessageBox.alert(post2db+' OK','The Master_jual_produk was '+msg+' successfully.');
						Ext.MessageBox.alert(post2db+' OK','Data penjualan produk berhasil disimpan');
						//master_jpgrooming_DataStore.reload();
						detail_jpgrooming_DataStore.load({params: {master_id:0}});
						master_jpgrooming_createWindow.hide();
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
					master_jpgrooming_print();
				master_jual_produk_reset_allForm();
				master_jpgrooming_carabayar_TabPanel.setActiveTab(0);
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
			if(dpgrooming_produk_id!="ada"){
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
		master_jpgrooming_SelectedRow_create();
	}
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='UPDATE')
			return master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	// Reset kwitansi option
	function kwitansi_jualproduk_grooming_reset_form(){
		jpgrooming_kwitansi_namaField.reset();
		jpgrooming_kwitansi_nilaiField.reset();
		jpgrooming_kwitansi_nilai_cfField.reset();
		jpgrooming_kwitansi_noField.reset();
		jpgrooming_kwitansi_sisaField.reset();
		jpgrooming_kwitansi_namaField.setValue("");
		jpgrooming_kwitansi_nilaiField.setValue(null);
		jpgrooming_kwitansi_nilai_cfField.setValue(null);
		jpgrooming_kwitansi_noField.setValue("");
		jpgrooming_kwitansi_sisaField.setValue(null);
	}
	// Reset kwitansi-2 option
	function kwitansi2_jualproduk_grooming_reset_form(){
		jpgrooming_kwitansi_nama2Field.reset();
		jpgrooming_kwitansi_nilai2Field.reset();
		jpgrooming_kwitansi_nilai2_cfField.reset();
		jpgrooming_kwitansi_no2Field.reset();
		jpgrooming_kwitansi_sisa2Field.reset();
		jpgrooming_kwitansi_nama2Field.setValue("");
		jpgrooming_kwitansi_nilai2Field.setValue(null);
		jpgrooming_kwitansi_nilai2_cfField.setValue(null);
		jpgrooming_kwitansi_no2Field.setValue("");
		jpgrooming_kwitansi_sisa2Field.setValue(null);
	}
	// Reset kwitansi-3 option
	function kwitansi3_jualproduk_grooming_reset_form(){
		jpgrooming_kwitansi_nama3Field.reset();
		jpgrooming_kwitansi_nilai3Field.reset();
		jpgrooming_kwitansi_nilai3_cfField.reset();
		jpgrooming_kwitansi_no3Field.reset();
		jpgrooming_kwitansi_sisaField.reset();
		jpgrooming_kwitansi_nama3Field.setValue("");
		jpgrooming_kwitansi_nilai3Field.setValue(null);
		jpgrooming_kwitansi_nilai3_cfField.setValue(null);
		jpgrooming_kwitansi_no3Field.setValue("");
		jpgrooming_kwitansi_sisaField.setValue(null);
	}
	
	// Reset card option
	function card_jualproduk_grooming_reset_form(){
		jpgrooming_card_namaField.reset();
		jpgrooming_card_edcField.reset();
		jpgrooming_card_noField.reset();
		jpgrooming_card_nilaiField.reset();
		jpgrooming_card_nilai_cfField.reset();
		jpgrooming_card_namaField.setValue("");
		jpgrooming_card_edcField.setValue("");
		jpgrooming_card_noField.setValue("");
		jpgrooming_card_nilaiField.setValue(null);
		jpgrooming_card_nilai_cfField.setValue(null);
	}
	// Reset card-2 option
	function card2_jualproduk_grooming_reset_form(){
		jpgrooming_card_nama2Field.reset();
		jpgrooming_card_edc2Field.reset();
		jpgrooming_card_no2Field.reset();
		jpgrooming_card_nilai2Field.reset();
		jpgrooming_card_nilai2_cfField.reset();
		jpgrooming_card_nama2Field.setValue("");
		jpgrooming_card_edc2Field.setValue("");
		jpgrooming_card_no2Field.setValue("");
		jpgrooming_card_nilai2Field.setValue(null);
		jpgrooming_card_nilai2_cfField.setValue(null);
	}
	// Reset card-3 option
	function card3_jualproduk_grooming_reset_form(){
		jpgrooming_card_nama3Field.reset();
		jpgrooming_card_edc3Field.reset();
		jpgrooming_card_no3Field.reset();
		jpgrooming_card_nilai3Field.reset();
		jpgrooming_card_nilai3_cfField.reset();
		jpgrooming_card_nama3Field.setValue("");
		jpgrooming_card_edc3Field.setValue("");
		jpgrooming_card_no3Field.setValue("");
		jpgrooming_card_nilai3Field.setValue(null);
		jpgrooming_card_nilai3_cfField.setValue(null);
	}
	
	// Reset cek option
	function cek_jualproduk_grooming_reset_form(){
		jpgrooming_cek_namaField.reset();
		jpgrooming_cek_noField.reset();
		jpgrooming_cek_validField.reset();
		jpgrooming_cek_bankField.reset();
		jpgrooming_cek_nilaiField.reset();
		jpgrooming_cek_nilai_cfField.reset();
		jpgrooming_cek_namaField.setValue(null);
		jpgrooming_cek_noField.setValue("");
		jpgrooming_cek_validField.setValue("");
		jpgrooming_cek_bankField.setValue("");
		jpgrooming_cek_nilaiField.setValue(null);
		jpgrooming_cek_nilai_cfField.setValue(null);
	}
	// Reset cek-2 option
	function cek2_jualproduk_grooming_reset_form(){
		jpgrooming_cek_nama2Field.reset();
		jpgrooming_cek_no2Field.reset();
		jpgrooming_cek_valid2Field.reset();
		jpgrooming_cek_bank2Field.reset();
		jpgrooming_cek_nilai2Field.reset();
		jpgrooming_cek_nilai2_cfField.reset();
		jpgrooming_cek_nama2Field.setValue(null);
		jpgrooming_cek_no2Field.setValue("");
		jpgrooming_cek_valid2Field.setValue("");
		jpgrooming_cek_bank2Field.setValue("");
		jpgrooming_cek_nilai2Field.setValue(null);
		jpgrooming_cek_nilai2_cfField.setValue(null);
	}
	// Reset cek-3 option
	function cek3_jualproduk_grooming_reset_form(){
		jpgrooming_cek_nama3Field.reset();
		jpgrooming_cek_no3Field.reset();
		jpgrooming_cek_valid3Field.reset();
		jpgrooming_cek_bank3Field.reset();
		jpgrooming_cek_nilai3Field.reset();
		jpgrooming_cek_nilai3_cfField.reset();
		jpgrooming_cek_nama3Field.setValue(null);
		jpgrooming_cek_no3Field.setValue("");
		jpgrooming_cek_valid3Field.setValue("");
		jpgrooming_cek_bank3Field.setValue("");
		jpgrooming_cek_nilai3Field.setValue(null);
		jpgrooming_cek_nilai3_cfField.setValue(null);
	}
	
	// Reset transfer option
	function transfer_jualproduk_grooming_reset_form(){
		jpgrooming_transfer_bankField.reset();
		jpgrooming_transfer_namaField.reset();
		jpgrooming_transfer_nilaiField.reset();
		jpgrooming_transfer_nilai_cfField.reset();
		jpgrooming_transfer_bankField.setValue("");
		jpgrooming_transfer_namaField.setValue(null);
		jpgrooming_transfer_nilaiField.setValue(null);
		jpgrooming_transfer_nilai_cfField.setValue(null);
	}
	// Reset transfer-2 option
	function transfer2_jualproduk_grooming_reset_form(){
		jpgrooming_transfer_bank2Field.reset();
		jpgrooming_transfer_nama2Field.reset();
		jpgrooming_transfer_nilai2Field.reset();
		jpgrooming_transfer_nilai2_cfField.reset();
		jpgrooming_transfer_bank2Field.setValue("");
		jpgrooming_transfer_nama2Field.setValue(null);
		jpgrooming_transfer_nilai2Field.setValue(null);
		jpgrooming_transfer_nilai2_cfField.setValue(null);
	}
	// Reset transfer-3 option
	function transfer3_jualproduk_grooming_reset_form(){
		jpgrooming_transfer_bank3Field.reset();
		jpgrooming_transfer_nama3Field.reset();
		jpgrooming_transfer_nilai3Field.reset();
		jpgrooming_transfer_nilai3_cfField.reset();
		jpgrooming_transfer_bank3Field.setValue("");
		jpgrooming_transfer_nama3Field.setValue(null);
		jpgrooming_transfer_nilai3Field.setValue(null);
		jpgrooming_transfer_nilai3_cfField.setValue(null);
	}

	// Reset tunai option
	function tunai_jualproduk_grooming_reset_form(){
		jpgrooming_tunai_nilaiField.reset();
		jpgrooming_tunai_nilaiField.setValue(null);
		jpgrooming_tunai_nilai_cfField.reset();
		jpgrooming_tunai_nilai_cfField.setValue(null);
	}
	// Reset tunai-2 option
	function tunai2_jualproduk_grooming_reset_form(){
		jpgrooming_tunai_nilai2Field.reset();
		jpgrooming_tunai_nilai2Field.setValue(null);
		jpgrooming_tunai_nilai2_cfField.reset();
		jpgrooming_tunai_nilai2_cfField.setValue(null);
	}
	// Reset tunai-3 option
	function tunai3_jualproduk_grooming_reset_form(){
		jpgrooming_tunai_nilai3Field.reset();
		jpgrooming_tunai_nilai3Field.setValue(null);
		jpgrooming_tunai_nilai3_cfField.reset();
		jpgrooming_tunai_nilai3_cfField.setValue(null);
	}

	//Reset voucher option
	function voucher_jualproduk_grooming_reset_form(){
		jpgrooming_voucher_noField.reset();
		jpgrooming_voucher_cashbackField.reset();
		jpgrooming_voucher_noField.setValue("");
		jpgrooming_voucher_cashbackField.setValue(null);
	}
	//Reset voucher-2 option
	function voucher2_jualproduk_grooming_reset_form(){
		jpgrooming_voucher_no2Field.reset();
		jpgrooming_voucher_cashback2Field.reset();
		jpgrooming_voucher_no2Field.setValue("");
		jpgrooming_voucher_cashback2Field.setValue(null);
	}
	//Reset voucher-3 option
	function voucher3_jualproduk_grooming_reset_form(){
		jpgrooming_voucher_no3Field.reset();
		jpgrooming_voucher_cashback3Field.reset();
		jpgrooming_voucher_no3Field.setValue("");
		jpgrooming_voucher_cashback3Field.setValue(null);
	}
	
	/* Reset form before loading */
	function master_jpgrooming_SelectedRow_reset_form(){
		jpgrooming_idField.reset();
		jpgrooming_idField.setValue(null);
		jpgrooming_nobuktiField.reset();
		jpgrooming_nobuktiField.setValue(null);
		jpgrooming_karyawanField.reset();
		jpgrooming_karyawanField.setValue(null);
		jpgrooming_tanggalField.setValue(dt.format('Y-m-d'));
		jpgrooming_diskonField.reset();
		jpgrooming_diskonField.setValue(null);
		jpgrooming_caraField.reset();
		jpgrooming_caraField.setValue(null);
		jpgrooming_cara2Field.reset();
		jpgrooming_cara2Field.setValue(null);
		jpgrooming_cara3Field.reset();
		jpgrooming_cara3Field.setValue(null);
		
		jpgrooming_cashbackField.reset();
		jpgrooming_cashbackField.setValue(null);
		jpgrooming_cashback_cfField.reset();
		jpgrooming_cashback_cfField.setValue(null);
		
		jpgrooming_keteranganField.reset();
		jpgrooming_keteranganField.setValue(null);

		jpgrooming_subTotalField.reset();
		jpgrooming_subTotalField.setValue(null);

		jpgrooming_totalField.reset();
		jpgrooming_totalField.setValue(null);

		jpgrooming_hutangField.reset();
		jpgrooming_hutangField.setValue(null);

		jpgrooming_jumlahField.reset();
		jpgrooming_jumlahField.setValue(null);

		tunai_jualproduk_grooming_reset_form();
		tunai2_jualproduk_grooming_reset_form();
		tunai3_jualproduk_grooming_reset_form();

		kwitansi_jualproduk_grooming_reset_form();
		kwitansi2_jualproduk_grooming_reset_form();
		kwitansi3_jualproduk_grooming_reset_form();

		card_jualproduk_grooming_reset_form();
		card2_jualproduk_grooming_reset_form();
		card3_jualproduk_grooming_reset_form();

		cek_jualproduk_grooming_reset_form();
		cek2_jualproduk_grooming_reset_form();
		cek3_jualproduk_grooming_reset_form();

		transfer_jualproduk_grooming_reset_form();
		transfer2_jualproduk_grooming_reset_form();
		transfer3_jualproduk_grooming_reset_form();

		voucher_jualproduk_grooming_reset_form();
		voucher2_jualproduk_grooming_reset_form();
		voucher3_jualproduk_grooming_reset_form();

		update_group_carabayar_jpgrooming();
		update_group_carabayar2_jpgrooming();
		update_group_carabayar3_jpgrooming();
		//load_total_produk_bayar();

		jpgrooming_bayarField.reset();
		jpgrooming_bayarField.setValue(null);
	}
 	/* End of Function */
	
	function master_jual_produk_reset_allForm(){
		master_jpgrooming_SelectedRow_reset_form();
		
	}
    
	/* setValue to EDIT */
	function master_jpgrooming_SelectedRow_set_form(){
		var hutang_temp=0;
		
		var subtotal_field=0;
		var dpgrooming_jumlah_field=0;
		var total_field=0;
		var hutang_field=0;
		var diskon_field=0;
		var cashback_field=0;
		
		//master_jpgrooming_SelectedRow_reset_form();
		jpgrooming_idField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_id'));
		jpgrooming_nobuktiField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_nobukti'));
		jpgrooming_karyawanField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_karyawan'));
		jpgrooming_tanggalField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_tanggal'));
		jpgrooming_caraField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_cara'));
		jpgrooming_cara2Field.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_cara2'));
		jpgrooming_cara3Field.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_cara3'));
		jpgrooming_diskonField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_diskon'));
		jpgrooming_cashbackField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_cashback'));
		jpgrooming_cashback_cfField.setValue(CurrencyFormatted(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_cashback')));
		jpgrooming_bayarField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_bayar'));
		
		jpgrooming_keteranganField.setValue(master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_keterangan'));
		
		for(i=0;i<detail_jpgrooming_DataStore.getCount();i++){
			subtotal_field+=detail_jpgrooming_DataStore.getAt(i).data.dpgrooming_subtotal_net;
			dpgrooming_jumlah_field+=detail_jpgrooming_DataStore.getAt(i).data.dpgrooming_jumlah;
		}
		if(jpgrooming_diskonField.getValue()!==""){
			diskon_field=jpgrooming_diskonField.getValue();
		}
		
		if(jpgrooming_cashbackField.getValue()!==""){
			cashback_field=jpgrooming_cashbackField.getValue();
		}
		total_field=subtotal_field*(100-diskon_field)/100-cashback_field;
		
		jpgrooming_jumlahField.setValue(dpgrooming_jumlah_field);
		jpgrooming_subTotalField.setValue(subtotal_field);
		
		jpgrooming_totalField.setValue(total_field);
		
		hutang_temp=total_field-jpgrooming_bayarField.getValue();
		jpgrooming_hutangField.setValue(hutang_temp);
		
		
		
		
		
		//load_membership();
		update_group_carabayar_jpgrooming();
		update_group_carabayar2_jpgrooming();
		update_group_carabayar3_jpgrooming();
		
		switch(jpgrooming_caraField.getValue()){
			case 'kwitansi':
				kwitansi_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jpgrooming_DataStore.getCount()){
								jpgrooming_kwitansi_record=kwitansi_jpgrooming_DataStore.getAt(0).data;
								jpgrooming_kwitansi_noField.setValue(jpgrooming_kwitansi_record.kwitansi_no);
								jpgrooming_kwitansi_namaField.setValue(jpgrooming_kwitansi_record.karyawan_nama);
								jpgrooming_kwitansi_nilaiField.setValue(jpgrooming_kwitansi_record.jkwitansi_nilai);
								jpgrooming_kwitansi_nilai_cfField.setValue(CurrencyFormatted(jpgrooming_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							if(card_jpgrooming_DataStore.getCount()){
								jpgrooming_card_record=card_jpgrooming_DataStore.getAt(0).data;
								jpgrooming_card_namaField.setValue(jpgrooming_card_record.jcard_nama);
								jpgrooming_card_edcField.setValue(jpgrooming_card_record.jcard_edc);
								jpgrooming_card_noField.setValue(jpgrooming_card_record.jcard_no);
								jpgrooming_card_nilaiField.setValue(jpgrooming_card_record.jcard_nilai);
								jpgrooming_card_nilai_cfField.setValue(CurrencyFormatted(jpgrooming_card_record.jcard_nilai));
							}
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jpgrooming_DataStore.getCount()){
									jpgrooming_cek_record=cek_jpgrooming_DataStore.getAt(0).data;
									jpgrooming_cek_namaField.setValue(jpgrooming_cek_record.jcek_nama);
									jpgrooming_cek_noField.setValue(jpgrooming_cek_record.jcek_no);
									jpgrooming_cek_validField.setValue(jpgrooming_cek_record.jcek_valid);
									jpgrooming_cek_bankField.setValue(jpgrooming_cek_record.jcek_bank);
									jpgrooming_cek_nilaiField.setValue(jpgrooming_cek_record.jcek_nilai);
									jpgrooming_cek_nilai_cfField.setValue(CurrencyFormatted(jpgrooming_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(transfer_jpgrooming_DataStore.getCount()){
										jpgrooming_transfer_record=transfer_jpgrooming_DataStore.getAt(0);
										jpgrooming_transfer_bankField.setValue(jpgrooming_transfer_record.data.jtransfer_bank);
										jpgrooming_transfer_namaField.setValue(jpgrooming_transfer_record.data.jtransfer_nama);
										jpgrooming_transfer_nilaiField.setValue(jpgrooming_transfer_record.data.jtransfer_nilai);
										jpgrooming_transfer_nilai_cfField.setValue(CurrencyFormatted(jpgrooming_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jpgrooming_DataStore.getCount()){
										jpgrooming_tunai_record=tunai_jpgrooming_DataStore.getAt(0);
										jpgrooming_tunai_nilaiField.setValue(jpgrooming_tunai_record.data.jtunai_nilai);
										jpgrooming_tunai_nilai_cfField.setValue(CurrencyFormatted(jpgrooming_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
			case 'voucher' :
				voucher_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(voucher_jpgrooming_DataStore.getCount()){
										jpgrooming_voucher_record=voucher_jpgrooming_DataStore.getAt(0);
										jpgrooming_voucher_noField.setValue(jpgrooming_voucher_record.data.tvoucher_novoucher);
										jpgrooming_voucher_cashbackField.setValue(jpgrooming_voucher_record.data.tvoucher_nilai);
									}
							}
					 	}
				  });
				break;
		}

		switch(jpgrooming_cara2Field.getValue()){
			case 'kwitansi':
				kwitansi_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jpgrooming_DataStore.getCount()){
								jpgrooming_kwitansi_record=kwitansi_jpgrooming_DataStore.getAt(0).data;
								jpgrooming_kwitansi_no2Field.setValue(jpgrooming_kwitansi_record.kwitansi_no);
								jpgrooming_kwitansi_nama2Field.setValue(jpgrooming_kwitansi_record.karyawan_nama);
								jpgrooming_kwitansi_nilai2Field.setValue(jpgrooming_kwitansi_record.jkwitansi_nilai);
								jpgrooming_kwitansi_nilai2_cfField.setValue(CurrencyFormatted(jpgrooming_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							 if(card_jpgrooming_DataStore.getCount()){
								 jpgrooming_card_record=card_jpgrooming_DataStore.getAt(0).data;
								 jpgrooming_card_nama2Field.setValue(jpgrooming_card_record.jcard_nama);
								 jpgrooming_card_edc2Field.setValue(jpgrooming_card_record.jcard_edc);
								 jpgrooming_card_no2Field.setValue(jpgrooming_card_record.jcard_no);
								 jpgrooming_card_nilai2Field.setValue(jpgrooming_card_record.jcard_nilai);
								 jpgrooming_card_nilai2_cfField.setValue(CurrencyFormatted(jpgrooming_card_record.jcard_nilai));
							 }
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jpgrooming_DataStore.getCount()){
									jpgrooming_cek_record=cek_jpgrooming_DataStore.getAt(0).data;
									jpgrooming_cek_nama2Field.setValue(jpgrooming_cek_record.jcek_nama);
									jpgrooming_cek_no2Field.setValue(jpgrooming_cek_record.jcek_no);
									jpgrooming_cek_valid2Field.setValue(jpgrooming_cek_record.jcek_valid);
									jpgrooming_cek_bank2Field.setValue(jpgrooming_cek_record.jcek_bank);
									jpgrooming_cek_nilai2Field.setValue(jpgrooming_cek_record.jcek_nilai);
									jpgrooming_cek_nilai2_cfField.setValue(CurrencyFormatted(jpgrooming_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
								jpgrooming_transfer_record=transfer_jpgrooming_DataStore.getAt(0);
									if(transfer_jpgrooming_DataStore.getCount()){
										jpgrooming_transfer_record=transfer_jpgrooming_DataStore.getAt(0);
										jpgrooming_transfer_bank2Field.setValue(jpgrooming_transfer_record.data.jtransfer_bank);
										jpgrooming_transfer_nama2Field.setValue(jpgrooming_transfer_record.data.jtransfer_nama);
										jpgrooming_transfer_nilai2Field.setValue(jpgrooming_transfer_record.data.jtransfer_nilai);
										jpgrooming_transfer_nilai2_cfField.setValue(CurrencyFormatted(jpgrooming_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jpgrooming_DataStore.getCount()){
										jpgrooming_tunai_record=tunai_jpgrooming_DataStore.getAt(0);
										jpgrooming_tunai_nilai2Field.setValue(jpgrooming_tunai_record.data.jtunai_nilai);
										jpgrooming_tunai_nilai2_cfField.setValue(CurrencyFormatted(jpgrooming_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
			case 'voucher' :
				voucher_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(voucher_jpgrooming_DataStore.getCount()){
										jpgrooming_voucher_record=voucher_jpgrooming_DataStore.getAt(0);
										jpgrooming_voucher_no2Field.setValue(jpgrooming_voucher_record.data.tvoucher_novoucher);
										jpgrooming_voucher_cashback2Field.setValue(jpgrooming_voucher_record.data.tvoucher_nilai);
									}
							}
					 	}
				  });
				break;
		}

		switch(jpgrooming_cara3Field.getValue()){
			case 'kwitansi':
				kwitansi_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jpgrooming_DataStore.getCount()){
								jpgrooming_kwitansi_record=kwitansi_jpgrooming_DataStore.getAt(0).data;
								jpgrooming_kwitansi_no3Field.setValue(jpgrooming_kwitansi_record.kwitansi_no);
								jpgrooming_kwitansi_nama3Field.setValue(jpgrooming_kwitansi_record.karyawan_nama);
								jpgrooming_kwitansi_nilai3Field.setValue(jpgrooming_kwitansi_record.jkwitansi_nilai);
								jpgrooming_kwitansi_nilai3_cfField.setValue(CurrencyFormatted(jpgrooming_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							 if(card_jpgrooming_DataStore.getCount()){
								 jpgrooming_card_record=card_jpgrooming_DataStore.getAt(0).data;
								 jpgrooming_card_nama3Field.setValue(jpgrooming_card_record.jcard_nama);
								 jpgrooming_card_edc3Field.setValue(jpgrooming_card_record.jcard_edc);
								 jpgrooming_card_no3Field.setValue(jpgrooming_card_record.jcard_no);
								 jpgrooming_card_nilai3Field.setValue(jpgrooming_card_record.jcard_nilai);
								 jpgrooming_card_nilai3_cfField.setValue(CurrencyFormatted(jpgrooming_card_record.jcard_nilai));
							 }
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jpgrooming_DataStore.load({
					params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jpgrooming_DataStore.getCount()){
									jpgrooming_cek_record=cek_jpgrooming_DataStore.getAt(0).data;
									jpgrooming_cek_nama3Field.setValue(jpgrooming_cek_record.jcek_nama);
									jpgrooming_cek_no3Field.setValue(jpgrooming_cek_record.jcek_no);
									jpgrooming_cek_valid3Field.setValue(jpgrooming_cek_record.jcek_valid);
									jpgrooming_cek_bank3Field.setValue(jpgrooming_cek_record.jcek_bank);
									jpgrooming_cek_nilai3Field.setValue(jpgrooming_cek_record.jcek_nilai);
									jpgrooming_cek_nilai3_cfField.setValue(CurrencyFormatted(jpgrooming_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
								jpgrooming_transfer_record=transfer_jpgrooming_DataStore.getAt(0);
									if(transfer_jpgrooming_DataStore.getCount()){
										jpgrooming_transfer_record=transfer_jpgrooming_DataStore.getAt(0);
										jpgrooming_transfer_bank3Field.setValue(jpgrooming_transfer_record.data.jtransfer_bank);
										jpgrooming_transfer_nama3Field.setValue(jpgrooming_transfer_record.data.jtransfer_nama);
										jpgrooming_transfer_nilai3Field.setValue(jpgrooming_transfer_record.data.jtransfer_nilai);
										jpgrooming_transfer_nilai3_cfField.setValue(CurrencyFormatted(jpgrooming_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jpgrooming_DataStore.getCount()){
										jpgrooming_tunai_record=tunai_jpgrooming_DataStore.getAt(0);
										jpgrooming_tunai_nilai3Field.setValue(jpgrooming_tunai_record.data.jtunai_nilai);
										jpgrooming_tunai_nilai3_cfField.setValue(CurrencyFormatted(jpgrooming_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
			case 'voucher' :
				voucher_jpgrooming_DataStore.load({
						params : { no_faktur: jpgrooming_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(voucher_jpgrooming_DataStore.getCount()){
										jpgrooming_voucher_record=voucher_jpgrooming_DataStore.getAt(0);
										jpgrooming_voucher_no3Field.setValue(jpgrooming_voucher_record.data.tvoucher_novoucher);
										jpgrooming_voucher_cashback3Field.setValue(jpgrooming_voucher_record.data.tvoucher_nilai);
									}
							}
					 	}
				  });
				break;
		}
		
		//detail_jpgrooming_DataStore.load({params:{master_id: jpgrooming_idField.getValue()}});
	}
	/* End setValue to EDIT*/
  
   /* function load_membership(){
		if(jpgrooming_karyawanField.getValue()!=''){
			memberDataStore.load({
					params : { member_cust: jpgrooming_karyawanField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) {
							if(memberDataStore.getCount()){
								jpgrooming_member_record=memberDataStore.getAt(0).data;
								jpgrooming_cust_nomemberField.setValue(jpgrooming_member_record.member_no);
							}
						}
					}
			}); 
		}
	}*/
	/* Function for Check if the form is valid */
	function is_master_jual_produk_form_valid(){
		return (true);
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_jpgrooming_createWindow.isVisible()){
			master_jpgrooming_SelectedRow_reset_form();
			detail_jpgrooming_DataStore.load({params: {master_id:0}});
			post2db='CREATE';
			msg='created';
			master_jpgrooming_carabayar_TabPanel.setActiveTab(0);
			master_jpgrooming_createWindow.show();
		} else {
			master_jpgrooming_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_jpgrooming_confirm_delete(){
		// only one master_jual_produk is selected here
		if(master_jpgroomingListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data berikut?', master_jpgrooming_SelectedRow_delete);
		} else if(master_jpgroomingListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data-data berikut?', master_jpgrooming_SelectedRow_delete);
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
	function master_jpgrooming_confirm_update(){
		master_jpgrooming_SelectedRow_reset_form();
		/* only one record is selected here */
		if(master_jpgroomingListEditorGrid.selModel.getCount() == 1) {
			cbo_dpgrooming_produkDataStore.load({params: {query: master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_id')}});
			cbo_dpgrooming_satuanDataStore.setBaseParam('produk_id', 0);
			cbo_dpgrooming_satuanDataStore.setBaseParam('query', master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_id'));
			//cbo_dpgrooming_satuanDataStore.load({params: {query: master_jpgroomingListEditorGrid.getSelectionModel().getSelected().get('jpgrooming_id')}});
			cbo_dpgrooming_satuanDataStore.load();
			//master_jpgrooming_SelectedRow_set_form();
			//master_jpgrooming_carabayar_TabPanel.setActiveTab(0);
			post2db='UPDATE';
			detail_jpgrooming_DataStore.load({
				params : {master_id : eval(get_pk_id()), start:0, limit:pageS},
				callback: function(opts, success, response){
					if(success){
						/*var subtotal_field=0;
						var dpgrooming_jumlah_field=0;
						var total_field=0;
						var hutang_field=0;
						var diskon_field=0;
						var cashback_field=0;
						for(i=0;i<detail_jpgrooming_DataStore.getCount();i++){
							subtotal_field+=detail_jpgrooming_DataStore.getAt(i).data.dpgrooming_subtotal_net;
							dpgrooming_jumlah_field+=detail_jpgrooming_DataStore.getAt(i).data.dpgrooming_jumlah;
							//jpgrooming_subTotalField.setValue(subtotal_field);
							if(jpgrooming_diskonField.getValue()!==""){
								diskon_field=jpgrooming_diskonField.getValue();
							}
							
							if(jpgrooming_cashbackField.getValue()!==""){
								cashback_field=jpgrooming_cashbackField.getValue();
							}
							total_field=subtotal_field*(100-diskon_field)/100-cashback_field;
						}
						jpgrooming_jumlahField.setValue(dpgrooming_jumlah_field);
						jpgrooming_subTotalField.setValue(subtotal_field);
						jpgrooming_totalField.setValue(total_field);*/
						master_jpgrooming_SelectedRow_set_form();
					}
				}
			});
			
			master_jpgrooming_carabayar_TabPanel.setActiveTab(2);
			master_jpgrooming_carabayar_TabPanel.setActiveTab(1);
			master_jpgrooming_carabayar_TabPanel.setActiveTab(0);
			msg='updated';
			master_jpgrooming_createWindow.hide();
			//master_jpgrooming_createWindow.show();
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
	function master_jpgrooming_SelectedRow_delete(btn){
		if(btn=='yes'){
			var selections = master_jpgroomingListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_jpgroomingListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jpgrooming_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_jualproduk_grooming&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_jpgrooming_DataStore.reload();
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
	master_jpgrooming_DataStore = new Ext.data.Store({
		id: 'master_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jpgrooming_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jpgrooming_id', type: 'int', mapping: 'jpgrooming_id'}, 
			{name: 'jpgrooming_nobukti', type: 'string', mapping: 'jpgrooming_nobukti'}, 
			{name: 'jpgrooming_karyawan', type: 'string', mapping: 'karyawan_nama'}, 
			{name: 'jpgrooming_karyawan_no', type: 'string', mapping: 'karyawan_no'}, 
			//{name: 'jpgrooming_cust_member', type: 'string', mapping: 'cust_member'}, 
			{name: 'jpgrooming_karyawan_id', type: 'int', mapping: 'jpgrooming_karyawan'}, 
			{name: 'jpgrooming_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jpgrooming_tanggal'}, 
			{name: 'jpgrooming_diskon', type: 'int', mapping: 'jpgrooming_diskon'}, 
			{name: 'jpgrooming_cashback', type: 'float', mapping: 'jpgrooming_cashback'},
			{name: 'jpgrooming_cara', type: 'string', mapping: 'jpgrooming_cara'}, 
			{name: 'jpgrooming_cara2', type: 'string', mapping: 'jpgrooming_cara2'}, 
			{name: 'jpgrooming_cara3', type: 'string', mapping: 'jpgrooming_cara3'}, 
			{name: 'jpgrooming_bayar', type: 'float', mapping: 'jpgrooming_bayar'}, 
			{name: 'jpgrooming_total', type: 'float', mapping: 'jpgrooming_totalbiaya'}, 
			{name: 'jpgrooming_keterangan', type: 'string', mapping: 'jpgrooming_keterangan'}, 
			{name: 'jpgrooming_creator', type: 'string', mapping: 'jpgrooming_creator'}, 
			{name: 'jpgrooming_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jpgrooming_date_create'}, 
			{name: 'jpgrooming_update', type: 'string', mapping: 'jpgrooming_update'}, 
			{name: 'jpgrooming_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jpgrooming_date_update'}, 
			{name: 'jpgrooming_revised', type: 'int', mapping: 'jpgrooming_revised'} 
		]),
		sortInfo:{field: 'jpgrooming_id', direction: "DESC"}
	});
	/* End of Function */
	
	cbo_voucher_jpgroomingDataStore = new Ext.data.Store({
		id: 'cbo_voucher_jpgroomingDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_voucher_list', 
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
	/*cbo_cust_jual_produk_DataStore = new Ext.data.Store({
		id: 'cbo_cust_jual_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: 10 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'cust_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column 
			{name: 'cust_id', type: 'int', mapping: 'cust_id'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'cust_no', direction: "ASC"}
	});*/
	
	jpgrooming_karyawanDataStore = new Ext.data.Store({
		id: 'jpgrooming_karyawanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_allkaryawan_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_display', type: 'string', mapping: 'karyawan_nama'},
			//{name: 'karyawan_id', type: 'int', mapping: 'karyawan_id'},
			{name: 'karyawan_no', type: 'string', mapping: 'karyawan_no'},
			{name: 'karyawan_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'karyawan_value', type: 'int', mapping: 'karyawan_id'}
			//{name: 'karyawan_jmltindakan', type: 'int', mapping: 'reportt_jmltindakan'},
		]),
		sortInfo:{field: 'karyawan_no', direction: "ASC"}
	});
	var karyawan_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{karyawan_username}</b> | {karyawan_display} | <b>{karyawan_no}</b></span>',
        '</div></tpl>'
    );
	
	
	
	
	/* Function for Retrieve Combo Kwitansi DataStore */
	cbo_kwitansi_jpgrooming_DataStore = new Ext.data.Store({
		id: 'cbo_kwitansi_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_kwitansi_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kwitansi_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
			{name: 'ckwitansi_id', type: 'int', mapping: 'kwitansi_id'},
			{name: 'ckwitansi_no', type: 'string', mapping: 'kwitansi_no'},
			{name: 'ckwitansi_cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'ckwitansi_cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'ckwitansi_cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'total_sisa', type: 'int', mapping: 'total_sisa'}
		]),
		sortInfo:{field: 'ckwitansi_no', direction: "ASC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Kwitansi DataStore */
	kwitansi_jpgrooming_DataStore = new Ext.data.Store({
		id: 'kwitansi_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_kwitansi_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jkwitansi_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jkwitansi_id', type: 'int', mapping: 'jkwitansi_id'},
			{name: 'kwitansi_no', type: 'string', mapping: 'kwitansi_no'},
			{name: 'jkwitansi_nilai', type: 'float', mapping: 'jkwitansi_nilai'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'karyawan_nama', type: 'string', mapping: 'karyawan_nama'}
		]),
		sortInfo:{field: 'jkwitansi_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Kwitansi DataStore */
	card_jpgrooming_DataStore = new Ext.data.Store({
		id: 'card_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_card_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcard_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
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
	cek_jpgrooming_DataStore = new Ext.data.Store({
		id: 'cek_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_cek_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcek_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
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
	transfer_jpgrooming_DataStore = new Ext.data.Store({
		id: 'transfer_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_transfer_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jtransfer_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jtransfer_id', type: 'int', mapping: 'jtransfer_id'}, 
			{name: 'jtransfer_bank', type: 'int', mapping: 'jtransfer_bank'},
			{name: 'jtransfer_nama', type: 'string', mapping: 'jtransfer_nama'},
			{name: 'jtransfer_nilai', type: 'float', mapping: 'jtransfer_nilai'}
		]),
		sortInfo:{field: 'jtransfer_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Tunai DataStore */
	tunai_jpgrooming_DataStore = new Ext.data.Store({
		id: 'tunai_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_tunai_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jtunai_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jtunai_id', type: 'int', mapping: 'jtunai_id'}, 
			{name: 'jtunai_nilai', type: 'float', mapping: 'jtunai_nilai'}
		]),
		sortInfo:{field: 'jtunai_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* GET Bank-List.Store */
	jpgrooming_bankDataStore = new Ext.data.Store({
		id:'jpgrooming_bankDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_bank_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'mbank_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jpgrooming_bank_value', type: 'int', mapping: 'mbank_id'}, 
			{name: 'jpgrooming_bank_display', type: 'string', mapping: 'mbank_nama'}
		]),
		sortInfo:{field: 'jpgrooming_bank_display', direction: "DESC"}
		});
	/* END GET Bank-List.Store */
	
	/* GET Voucher-Terima-List.Store */
	voucher_jpgrooming_DataStore = new Ext.data.Store({
		id: 'voucher_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_voucher_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'tvoucher_id'
		},[
		/* dataIndex => insert intomaster_jpgrooming_ColumnModel, Mapping => for initiate table column */ 
			{name: 'tvoucher_id', type: 'int', mapping: 'tvoucher_id'}, 
			{name: 'tvoucher_novoucher', type: 'string', mapping: 'tvoucher_novoucher'}, 
			{name: 'tvoucher_nilai', type: 'float', mapping: 'tvoucher_nilai'}
		]),
		sortInfo:{field: 'tvoucher_id', direction: "DESC"}
	});
	/* End of GET Voucher-Terima-List.Store */
	
  	/* Function for Identify of Window Column Model */
	master_jpgrooming_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jpgrooming_id',
			width: 5,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'jpgrooming_tanggal',
			width: 70,	//150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		}, 
		{
			header: '<div align="center">' + 'No Faktur' + '</div>',
			dataIndex: 'jpgrooming_nobukti',
			width: 80,	//150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}, 
		{
			header: '<div align="center">' + 'No Karyawan' + '</div>',
			dataIndex: 'jpgrooming_karyawan_no',
			width: 80,	//185,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Karyawan' + '</div>',
			dataIndex: 'jpgrooming_karyawan',
			width: 200,	//185,
			sortable: true,
			readOnly: true
		}, 
		/*{
			header: '<div align="center">' + 'No Member' + '</div>',
			dataIndex: 'jpgrooming_cust_member',
			width: 80,	//185,
			sortable: true,
			readOnly: true
		}, */
		{
		//	header: 'Jumlah Bayar',
			header: '<div align="center">' + 'Total (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'jpgrooming_total',
			width: 100,	//150,
			sortable: true,
			readOnly: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			
		},
		{
		//	header: 'Jumlah Bayar',
			header: '<div align="center">' + 'Total Bayar (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'jpgrooming_bayar',
			width: 100,	//150,
			sortable: true,
			readOnly: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			
		},
		{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'jpgrooming_keterangan',
			width: 200,	//150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'jpgrooming_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jpgrooming_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jpgrooming_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jpgrooming_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jpgrooming_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_jpgrooming_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_jpgroomingListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_jpgroomingListEditorGrid',
		el: 'fp_master_jpgrooming_SelectedRow',
		title: 'Daftar Penjualan Produk(Grooming)',
		autoHeight: true,
		store: master_jpgrooming_DataStore, // DataStore
		cm: master_jpgrooming_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,	//800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_jpgrooming_DataStore,
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
			handler: master_jpgrooming_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: master_jpgrooming_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_jpgrooming_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_jpgrooming_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_jpgrooming_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_jpgrooming_print  
		}
		]
	});
	//master_jpgroomingListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_jpgrooming_ContextMenu = new Ext.menu.Menu({
		id: 'master_jual_produk_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_jpgrooming_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: master_jpgrooming_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_jpgrooming_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_jpgrooming_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_jpgrooming_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_jpgrooming_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_jpgrooming_SelectedRow=rowIndex;
		master_jpgrooming_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_jpgrooming_editContextMenu(){
		master_jpgroomingListEditorGrid.startEditing(master_jpgrooming_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_jpgroomingListEditorGrid.addListener('rowcontextmenu', onmaster_jpgrooming_ListEditGridContextMenu);
	//master_jpgrooming_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_jpgroomingListEditorGrid.on('afteredit', master_jpgrooming_SelectedRow_update); // inLine Editing Record
	
	// Custom rendering Template
   /* var customer_jual_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
//            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
//            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
            '<span><b>{cust_no} : {cust_nama}</b><br /></span>',
            '{cust_alamat} | {cust_telprumah}',
        '</div></tpl>'
    );*/
	
	var voucher_jpgrooming_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{voucher_nomor}</b>| {voucher_nama}<br/></span>',
			'Jenis: {voucher_jenis}&nbsp;&nbsp;&nbsp;[Nilai: {voucher_cashback}]',
		'</div></tpl>'
    );
	
	
	var kwitansi_jpgrooming_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{ckwitansi_no}</b> <br/>',
			'a/n {ckwitansi_cust_nama} [ {ckwitansi_cust_no} ]<br/>',
			'{ckwitansi_cust_alamat}, <br>Sisa: <b>Rp. {total_sisa}</b> </span>',
		'</div></tpl>'
    );
	
	var produk_jpgrooming_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{dpgrooming_produk_kode}| <b>{dpgrooming_produk_display}</b>',
		'</div></tpl>'
    );
	/*var produk_jpgrooming_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dpgrooming_produk_kode}</b>| {dpgrooming_produk_display}<br/>Group: {dpgrooming_produk_group}<br/>',
			'Kategori: {dpgrooming_produk_kategori}</span>',
		'</div></tpl>'
    );*/
		
	/* Identify  jpgrooming_id Field */
	jpgrooming_idField= new Ext.form.NumberField({
		id: 'jpgrooming_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jpgrooming_nobukti Field */
	jpgrooming_nobuktiField= new Ext.form.TextField({
		id: 'jpgrooming_nobuktiField',
		fieldLabel: 'No. Faktur',
		readOnly:true,
		maxLength: 30,
		//anchor: '95%'
	});
	/* Identify  jpgrooming_karyawan Field */
	jpgrooming_karyawanField= new Ext.form.ComboBox({
		id: 'jpgrooming_karyawanField',
		fieldLabel: 'Karyawan',
		store: jpgrooming_karyawanDataStore,
		mode: 'remote',
		displayField:'karyawan_username',
		valueField: 'karyawan_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: karyawan_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});

	
	jpgrooming_cust_nomemberField= new Ext.form.TextField({
		id: 'jpgrooming_cust_nomemberField',
		fieldLabel: 'No. Member',
		readOnly: true
	});
	
	/* Identify  jpgrooming_tanggal Field */
	jpgrooming_tanggalField= new Ext.form.DateField({
		id: 'jpgrooming_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	});
	/* Identify  jpgrooming_diskon Field */
	jpgrooming_diskonField= new Ext.form.NumberField({
		id: 'jpgrooming_diskonField',
		fieldLabel: 'Diskon (%)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		allowDecimals: false,
		enableKeyEvents: true,
		width: 120,
		maxLength: 2,
		maskRe: /([0-9]+)$/
	});
	
	jpgrooming_cashback_cfField= new Ext.form.TextField({
		id: 'jpgrooming_cashback_cfField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		width: 120,
		maskRe: /([0-9]+)$/ 
		/*,listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jpgrooming_cashbackField.setValue(cf_tonumber);
				load_total_produk_bayar();
				
				var cashback_cf = CurrencyFormatted(this.getValue());
				this.setRawValue(cashback_cf);
			}
		}*/
	});
	jpgrooming_cashbackField= new Ext.form.NumberField({
		id: 'jpgrooming_cashbackField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		enableKeyEvents: true,
		allowDecimals: false,
		width: 120,
		maskRe: /([0-9]+)$/
	});
	
	/* Identify  jpgrooming_cara Field */
	jpgrooming_caraField= new Ext.form.ComboBox({
		id: 'jpgrooming_caraField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_cara_value', 'jpgrooming_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_cara_display',
		valueField: 'jpgrooming_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jpgrooming_cara2 Field */
	jpgrooming_cara2Field= new Ext.form.ComboBox({
		id: 'jpgrooming_cara2Field',
		fieldLabel: 'Cara Bayar 2',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_cara_value', 'jpgrooming_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_cara_display',
		valueField: 'jpgrooming_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jpgrooming_cara3 Field */
	jpgrooming_cara3Field= new Ext.form.ComboBox({
		id: 'jpgrooming_cara3Field',
		fieldLabel: 'Cara Bayar 3',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_cara_value', 'jpgrooming_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_cara_display',
		valueField: 'jpgrooming_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jpgrooming_keterangan Field */
	jpgrooming_keteranganField= new Ext.form.TextArea({
		id: 'jpgrooming_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	// START Field Voucher
	jpgrooming_voucher_noField= new Ext.form.ComboBox({
		id: 'jpgrooming_voucher_noField',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jpgroomingDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_nomor',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jpgrooming_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jpgrooming_voucher_noField.on('select', function(){
		j=cbo_voucher_jpgroomingDataStore.findExact('voucher_nomor',jpgrooming_voucher_noField.getValue(),0);
		if(j>-1){
			jpgrooming_voucher_cashbackField.setValue(cbo_voucher_jpgroomingDataStore.getAt(j).data.voucher_cashback);
			if(post2db=="CREATE")
				load_total_produk_bayar();
			else if(post2db=="UPDATE")
				load_total_bayar_updating();
		}
	});
	
	jpgrooming_voucher_cashbackField= new Ext.ux.form.CFTextField({
		id: 'jpgrooming_voucher_cashbackField',
		fieldLabel: 'Nilai Cashback',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true
	});
	/*jpgrooming_voucher_cashbackField= new Ext.form.NumberField({
		id: 'jpgrooming_voucher_cashbackField',
		fieldLabel: 'Nilai Cashback',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});*/
	
	
	master_jpgrooming_voucherGroup= new Ext.form.FieldSet({
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
				items: [jpgrooming_voucher_noField,jpgrooming_voucher_cashbackField] 
			}
		]
	
	});
	// END Field Voucher
	// START Field Voucher-2
	jpgrooming_voucher_no2Field= new Ext.form.ComboBox({
		id: 'jpgrooming_voucher_no2Field',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jpgroomingDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_nomor',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jpgrooming_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jpgrooming_voucher_no2Field.on('select', function(){
		j=cbo_voucher_jpgroomingDataStore.findExact('voucher_nomor',jpgrooming_voucher_no2Field.getValue(),0);
		if(j>-1){
			jpgrooming_voucher_cashback2Field.setValue(cbo_voucher_jpgroomingDataStore.getAt(j).data.voucher_cashback);
			if(post2db=="CREATE")
				load_total_produk_bayar();
			else if(post2db=="UPDATE")
				load_total_bayar_updating();
		}
	});
	
	jpgrooming_voucher_cashback2Field= new Ext.ux.form.CFTextField({
		id: 'jpgrooming_voucher_cashback2Field',
		fieldLabel: 'Nilai Cashback',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true
	});
	/*jpgrooming_voucher_cashback2Field= new Ext.form.NumberField({
		id: 'jpgrooming_voucher_cashback2Field',
		fieldLabel: 'Nilai Cashback',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});*/
	
	
	master_jpgrooming_voucher2Group= new Ext.form.FieldSet({
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
				items: [jpgrooming_voucher_no2Field,jpgrooming_voucher_cashback2Field] 
			}
		]
	
	});
	// END Field Voucher-2
	// START Field Voucher-3
	jpgrooming_voucher_no3Field= new Ext.form.ComboBox({
		id: 'jpgrooming_voucher_no3Field',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jpgroomingDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_nomor',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jpgrooming_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jpgrooming_voucher_no3Field.on('select', function(){
		j=cbo_voucher_jpgroomingDataStore.findExact('voucher_nomor',jpgrooming_voucher_no3Field.getValue(),0);
		if(j>-1){
			jpgrooming_voucher_cashback3Field.setValue(cbo_voucher_jpgroomingDataStore.getAt(j).data.voucher_cashback);
			if(post2db=="CREATE")
				load_total_produk_bayar();
			else if(post2db=="UPDATE")
				load_total_bayar_updating();
		}
	});
	
	jpgrooming_voucher_cashback3Field= new Ext.ux.form.CFTextField({
		id: 'jpgrooming_voucher_cashback3Field',
		fieldLabel: 'Nilai Cashback',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true
	});
	/*jpgrooming_voucher_cashback3Field= new Ext.form.NumberField({
		id: 'jpgrooming_voucher_cashback3Field',
		fieldLabel: 'Nilai Cashback',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});*/
	
	
	master_jpgrooming_voucher3Group= new Ext.form.FieldSet({
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
				items: [jpgrooming_voucher_no3Field,jpgrooming_voucher_cashback3Field] 
			}
		]
	
	});
	// END Field Voucher-3
	
	// START Field Card
	jpgrooming_card_namaField= new Ext.form.ComboBox({
		id: 'jpgrooming_card_namaField',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_card_value', 'jpgrooming_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_card_display',
		valueField: 'jpgrooming_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jpgrooming_card_edcField= new Ext.form.ComboBox({
		id: 'jpgrooming_card_edcField',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_card_edc_value', 'jpgrooming_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_card_edc_display',
		valueField: 'jpgrooming_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpgrooming_card_noField= new Ext.form.TextField({
		id: 'jpgrooming_card_noField',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jpgrooming_card_nilai_cfField= new Ext.form.TextField({
		id: 'jpgrooming_card_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_card_nilaiField= new Ext.form.NumberField({
		id: 'jpgrooming_card_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jpgrooming_cardGroup= new Ext.form.FieldSet({
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
				items: [jpgrooming_card_namaField,jpgrooming_card_edcField,jpgrooming_card_noField,jpgrooming_card_nilai_cfField] 
			}
		]
	
	});
	// END Field Card
	// START Field Card-2
	jpgrooming_card_nama2Field= new Ext.form.ComboBox({
		id: 'jpgrooming_card_nama2Field',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_card_value', 'jpgrooming_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_card_display',
		valueField: 'jpgrooming_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jpgrooming_card_edc2Field= new Ext.form.ComboBox({
		id: 'jpgrooming_card_edc2Field',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_card_edc_value', 'jpgrooming_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_card_edc_display',
		valueField: 'jpgrooming_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpgrooming_card_no2Field= new Ext.form.TextField({
		id: 'jpgrooming_card_no2Field',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jpgrooming_card_nilai2_cfField= new Ext.form.TextField({
		id: 'jpgrooming_card_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_card_nilai2Field= new Ext.form.NumberField({
		id: 'jpgrooming_card_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jpgrooming_card2Group= new Ext.form.FieldSet({
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
				items: [jpgrooming_card_nama2Field,jpgrooming_card_edc2Field,jpgrooming_card_no2Field,jpgrooming_card_nilai2_cfField] 
			}
		]
	
	});
	// END Field Card-2
	// START Field Card-3
	jpgrooming_card_nama3Field= new Ext.form.ComboBox({
		id: 'jpgrooming_card_nama3Field',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_card_value', 'jpgrooming_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_card_display',
		valueField: 'jpgrooming_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jpgrooming_card_edc3Field= new Ext.form.ComboBox({
		id: 'jpgrooming_card_edc3Field',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jpgrooming_card_edc_value', 'jpgrooming_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_card_edc_display',
		valueField: 'jpgrooming_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpgrooming_card_no3Field= new Ext.form.TextField({
		id: 'jpgrooming_card_no3Field',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jpgrooming_card_nilai3_cfField= new Ext.form.TextField({
		id: 'jpgrooming_card_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_card_nilai3Field= new Ext.form.NumberField({
		id: 'jpgrooming_card_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jpgrooming_card3Group= new Ext.form.FieldSet({
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
				items: [jpgrooming_card_nama3Field,jpgrooming_card_edc3Field,jpgrooming_card_no3Field,jpgrooming_card_nilai3_cfField] 
			}
		]
	
	});
	// END Field Card-3
	
	// StART Field Cek
	jpgrooming_cek_namaField= new Ext.form.TextField({
		id: 'jpgrooming_cek_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpgrooming_cek_noField= new Ext.form.TextField({
		id: 'jpgrooming_cek_noField',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpgrooming_cek_validField= new Ext.form.DateField({
		id: 'jpgrooming_cek_validField',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jpgrooming_cek_bankField= new Ext.form.ComboBox({
		id: 'jpgrooming_cek_bankField',
		fieldLabel: 'Bank',
		store: jpgrooming_bankDataStore,
		mode: 'remote',
		displayField: 'jpgrooming_bank_display',
		valueField: 'jpgrooming_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jpgrooming_cek_bankField)
	});
	
	jpgrooming_cek_nilai_cfField= new Ext.form.TextField({
		id: 'jpgrooming_cek_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_cek_nilaiField= new Ext.form.NumberField({
		id: 'jpgrooming_cek_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jpgrooming_cekGroup = new Ext.form.FieldSet({
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
				items: [jpgrooming_cek_namaField,jpgrooming_cek_noField,jpgrooming_cek_validField,jpgrooming_cek_bankField,jpgrooming_cek_nilai_cfField] 
			}
		]
	
	});
	// END Field Cek
	// StART Field Cek-2
	jpgrooming_cek_nama2Field= new Ext.form.TextField({
		id: 'jpgrooming_cek_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpgrooming_cek_no2Field= new Ext.form.TextField({
		id: 'jpgrooming_cek_no2Field',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpgrooming_cek_valid2Field= new Ext.form.DateField({
		id: 'jpgrooming_cek_valid2Field',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jpgrooming_cek_bank2Field= new Ext.form.ComboBox({
		id: 'jpgrooming_cek_bank2Field',
		fieldLabel: 'Bank',
		store: jpgrooming_bankDataStore,
		mode: 'remote',
		displayField: 'jpgrooming_bank_display',
		valueField: 'jpgrooming_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jpgrooming_cek_bankField)
	});
	
	jpgrooming_cek_nilai2_cfField= new Ext.form.TextField({
		id: 'jpgrooming_cek_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_cek_nilai2Field= new Ext.form.NumberField({
		id: 'jpgrooming_cek_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jpgrooming_cek2Group = new Ext.form.FieldSet({
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
				items: [jpgrooming_cek_nama2Field,jpgrooming_cek_no2Field,jpgrooming_cek_valid2Field,jpgrooming_cek_bank2Field,jpgrooming_cek_nilai2_cfField] 
			}
		]
	
	});
	// END Field Cek-2
	// StART Field Cek-3
	jpgrooming_cek_nama3Field= new Ext.form.TextField({
		id: 'jpgrooming_cek_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpgrooming_cek_no3Field= new Ext.form.TextField({
		id: 'jpgrooming_cek_no3Field',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpgrooming_cek_valid3Field= new Ext.form.DateField({
		id: 'jpgrooming_cek_valid3Field',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jpgrooming_cek_bank3Field= new Ext.form.ComboBox({
		id: 'jpgrooming_cek_bank3Field',
		fieldLabel: 'Bank',
		store: jpgrooming_bankDataStore,
		mode: 'remote',
		displayField: 'jpgrooming_bank_display',
		valueField: 'jpgrooming_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jpgrooming_cek_bankField)
	});
	
	jpgrooming_cek_nilai3_cfField= new Ext.form.TextField({
		id: 'jpgrooming_cek_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_cek_nilai3Field= new Ext.form.NumberField({
		id: 'jpgrooming_cek_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jpgrooming_cek3Group = new Ext.form.FieldSet({
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
				items: [jpgrooming_cek_nama3Field,jpgrooming_cek_no3Field,jpgrooming_cek_valid3Field,jpgrooming_cek_bank3Field,jpgrooming_cek_nilai3_cfField] 
			}
		]
	
	});
	// END Field Cek-3
	
	// START Field Transfer
	jpgrooming_transfer_bankField= new Ext.form.ComboBox({
		id: 'jpgrooming_transfer_bankField',
		fieldLabel: 'Bank',
		store: jpgrooming_bankDataStore,
		mode: 'remote',
		displayField: 'jpgrooming_bank_display',
		valueField: 'jpgrooming_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jpgrooming_transfer_bankField)
	});

	jpgrooming_transfer_namaField= new Ext.form.TextField({
		id: 'jpgrooming_transfer_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpgrooming_transfer_nilai_cfField= new Ext.form.TextField({
		id: 'jpgrooming_transfer_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_transfer_nilaiField= new Ext.form.NumberField({
		id: 'jpgrooming_transfer_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jpgrooming_transferGroup= new Ext.form.FieldSet({
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
				items: [jpgrooming_transfer_bankField,jpgrooming_transfer_namaField,jpgrooming_transfer_nilai_cfField] 
			}
		]
	
	});
	// END Field Transfer
	// START Field Transfer-2
	jpgrooming_transfer_bank2Field= new Ext.form.ComboBox({
		id: 'jpgrooming_transfer_bank2Field',
		fieldLabel: 'Bank',
		store: jpgrooming_bankDataStore,
		mode: 'remote',
		displayField: 'jpgrooming_bank_display',
		valueField: 'jpgrooming_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpgrooming_transfer_nama2Field= new Ext.form.TextField({
		id: 'jpgrooming_transfer_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpgrooming_transfer_nilai2_cfField= new Ext.form.TextField({
		id: 'jpgrooming_transfer_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_transfer_nilai2Field= new Ext.form.NumberField({
		id: 'jpgrooming_transfer_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jpgrooming_transfer2Group= new Ext.form.FieldSet({
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
				items: [jpgrooming_transfer_bank2Field,jpgrooming_transfer_nama2Field,jpgrooming_transfer_nilai2_cfField] 
			}
		]
	
	});
	// END Field Transfer-2
	// START Field Transfer-3
	jpgrooming_transfer_bank3Field= new Ext.form.ComboBox({
		id: 'jpgrooming_transfer_bank3Field',
		fieldLabel: 'Bank',
		store: jpgrooming_bankDataStore,
		mode: 'remote',
		displayField: 'jpgrooming_bank_display',
		valueField: 'jpgrooming_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpgrooming_transfer_nama3Field= new Ext.form.TextField({
		id: 'jpgrooming_transfer_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpgrooming_transfer_nilai3_cfField= new Ext.form.TextField({
		id: 'jpgrooming_transfer_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_transfer_nilai3Field= new Ext.form.NumberField({
		id: 'jpgrooming_transfer_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jpgrooming_transfer3Group= new Ext.form.FieldSet({
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
				items: [jpgrooming_transfer_bank3Field,jpgrooming_transfer_nama3Field,jpgrooming_transfer_nilai3_cfField] 
			}
		]
	
	});
	// END Field Transfer-3
	
	//START Field Tunai-1
	jpgrooming_tunai_nilai_cfField= new Ext.form.TextField({
		id: 'jpgrooming_tunai_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_tunai_nilaiField= new Ext.form.NumberField({
		id: 'jpgrooming_tunai_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jpgrooming_tunaiGroup = new Ext.form.FieldSet({
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
				items: [jpgrooming_tunai_nilai_cfField] 
			}
		]
	
	});
	// END Tunai-1
	
	//START Field Tunai-2
	jpgrooming_tunai_nilai2_cfField= new Ext.form.TextField({
		id: 'jpgrooming_tunai_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_tunai_nilai2Field= new Ext.form.NumberField({
		id: 'jpgrooming_tunai_nilai2Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jpgrooming_tunai2Group = new Ext.form.FieldSet({
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
				items: [jpgrooming_tunai_nilai2_cfField] 
			}
		]
	
	});
	// END Tunai-2
	
	//START Field Tunai-3
	jpgrooming_tunai_nilai3_cfField= new Ext.form.TextField({
		id: 'jpgrooming_tunai_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_tunai_nilai3Field= new Ext.form.NumberField({
		id: 'jpgrooming_tunai_nilai3Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jpgrooming_tunai3Group = new Ext.form.FieldSet({
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
				items: [jpgrooming_tunai_nilai3_cfField] 
			}
		]
	
	});
	// END Tunai-3
	
	//START Field Kwitansi-1
	jpgrooming_kwitansi_namaField= new Ext.form.TextField({
		id: 'jpgrooming_kwitansi_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		readOnly: true,
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_nilai_cfField= new Ext.form.TextField({
		id: 'jpgrooming_kwitansi_nilai_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_kwitansi_nilaiField= new Ext.form.NumberField({
		id: 'jpgrooming_kwitansi_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jpgrooming_kwitansi_noField= new Ext.form.ComboBox({
		id: 'jpgrooming_kwitansi_noField',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jpgrooming_DataStore,
		mode: 'remote',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jpgrooming_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_sisaField= new Ext.form.NumberField({
		id: 'jpgrooming_kwitansi_sisaField',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_noField.on("select",function(){
			j=cbo_kwitansi_jpgrooming_DataStore.findExact('ckwitansi_id',jpgrooming_kwitansi_noField.getValue(),0);
			if(j>-1){
				jpgrooming_kwitansi_namaField.setValue(cbo_kwitansi_jpgrooming_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jpgrooming_kwitansi_sisaField.setValue(cbo_kwitansi_jpgrooming_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-1
	
	//START Field Kwitansi-2
	jpgrooming_kwitansi_nama2Field= new Ext.form.TextField({
		id: 'jpgrooming_kwitansi_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		readOnly: true,
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_nilai2_cfField= new Ext.form.TextField({
		id: 'jpgrooming_kwitansi_nilai2_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_kwitansi_nilai2Field= new Ext.form.NumberField({
		id: 'jpgrooming_kwitansi_nilai2Field',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jpgrooming_kwitansi_no2Field= new Ext.form.ComboBox({
		id: 'jpgrooming_kwitansi_no2Field',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jpgrooming_DataStore,
		mode: 'remote',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jpgrooming_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_sisa2Field= new Ext.form.NumberField({
		id: 'jpgrooming_kwitansi_sisa2Field',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_no2Field.on("select",function(){
			j=cbo_kwitansi_jpgrooming_DataStore.findExact('ckwitansi_id',jpgrooming_kwitansi_no2Field.getValue(),0);
			if(j>-1){
				jpgrooming_kwitansi_nama2Field.setValue(cbo_kwitansi_jpgrooming_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jpgrooming_kwitansi_sisa2Field.setValue(cbo_kwitansi_jpgrooming_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-2
	
	//START Field Kwitansi-3
	jpgrooming_kwitansi_nama3Field= new Ext.form.TextField({
		id: 'jpgrooming_kwitansi_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		readOnly: true,
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_nilai3_cfField= new Ext.form.TextField({
		id: 'jpgrooming_kwitansi_nilai3_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpgrooming_kwitansi_nilai3Field= new Ext.form.NumberField({
		id: 'jpgrooming_kwitansi_nilai3Field',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jpgrooming_kwitansi_no3Field= new Ext.form.ComboBox({
		id: 'jpgrooming_kwitansi_no3Field',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jpgrooming_DataStore,
		mode: 'remote',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jpgrooming_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_sisa3Field= new Ext.form.NumberField({
		id: 'jpgrooming_kwitansi_sisa3Field',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jpgrooming_kwitansi_no3Field.on("select",function(){
			j=cbo_kwitansi_jpgrooming_DataStore.findExact('ckwitansi_id',jpgrooming_kwitansi_no3Field.getValue(),0);
			if(j>-1){
				jpgrooming_kwitansi_nama3Field.setValue(cbo_kwitansi_jpgrooming_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jpgrooming_kwitansi_sisa3Field.setValue(cbo_kwitansi_jpgrooming_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-3
	
	master_jpgrooming_kwitansiGroup = new Ext.form.FieldSet({
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
				items: [jpgrooming_kwitansi_noField,jpgrooming_kwitansi_namaField,jpgrooming_kwitansi_sisaField,jpgrooming_kwitansi_nilai_cfField] 
			}
		]
	
	});
	
	master_jpgrooming_kwitansi2Group = new Ext.form.FieldSet({
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
				items: [jpgrooming_kwitansi_no2Field,jpgrooming_kwitansi_nama2Field,jpgrooming_kwitansi_sisa2Field,jpgrooming_kwitansi_nilai2_cfField] 
			}
		]
	
	});
	
	master_jpgrooming_kwitansi3Group = new Ext.form.FieldSet({
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
				items: [jpgrooming_kwitansi_no3Field,jpgrooming_kwitansi_nama3Field,jpgrooming_kwitansi_sisa3Field,jpgrooming_kwitansi_nilai3_cfField] 
			}
		]
	
	});
	
	//* Bayar
	jpgrooming_jumlahField= new Ext.form.NumberField({
		id: 'jpgrooming_jumlahField',
		fieldLabel: 'Jumlah Item',
		allowBlank: true,
		readOnly: true,
		allowDecimals: false,
		width: 40,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jpgrooming_subTotalField= new Ext.ux.form.CFTextField({
		id: 'jpgrooming_subTotalField',
		fieldLabel: 'Sub Total (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		itemCls: 'rmoney',
		width: 120
	});
	/*jpgrooming_subTotalField= new Ext.form.NumberField({
		id: 'jpgrooming_subTotalField',
		fieldLabel: 'Sub Total (Rp)',
		readOnly: true,
		allowDecimals: false,
		allowBlank: true,
		width: 120,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});*/

	jpgrooming_totalField= new Ext.ux.form.CFTextField({
		id: 'jpgrooming_totalField',
		fieldLabel: '<span style="font-weight:bold">Total (Rp)</span>',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		itemCls: 'rmoney_b',
		width: 120
	});
	/*jpgrooming_totalField= new Ext.form.NumberField({
		id: 'jpgrooming_totalField',
		fieldLabel: '<span style="font-weight:bold">Total (Rp)</span>',
		readOnly: true,
		allowDecimals: false,
		allowBlank: true,
		width: 120,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});*/
	
	jpgrooming_bayarField= new Ext.ux.form.CFTextField({
		id: 'jpgrooming_bayarField',
		fieldLabel: 'Total Bayar (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		itemCls: 'rmoney',
		width: 120
	});
	/*jpgrooming_bayarField= new Ext.form.NumberField({
		id: 'jpgrooming_bayarField',
		fieldLabel: 'Total Bayar (Rp)',
		readOnly: true,
		enableKeyEvents: true,
		allowBlank: true,
		allowDecimals: false,
		width: 120,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});*/
	
	jpgrooming_hutangField= new Ext.ux.form.CFTextField({
		id: 'jpgrooming_hutangField',
		fieldLabel: 'Hutang (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		itemCls: 'rmoney',
		width: 120
	});
	/*jpgrooming_hutangField= new Ext.form.NumberField({
		id: 'jpgrooming_hutangField',
		fieldLabel: 'Hutang (Rp)',
		readOnly: true,
		allowBlank: true,
		allowDecimals: false,
		width: 120,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});*/
	jpgrooming_pesanLabel= new Ext.form.Label({
		style: {
			marginLeft: '100px',
			fontSize: '14px',
			color: '#CC0000'
		}
	});
	jpgrooming_lunasLabel= new Ext.form.Label({
		style: {
			marginLeft: '100px',
			fontSize: '14px',
			color: '#006600'
		}
	});
	
	
	master_jpgrooming_carabayar_TabPanel = new Ext.TabPanel({
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

                items: [jpgrooming_caraField,master_jpgrooming_tunaiGroup,master_jpgrooming_cardGroup,master_jpgrooming_cekGroup,master_jpgrooming_kwitansiGroup,master_jpgrooming_transferGroup,master_jpgrooming_voucherGroup]
            },{
                title:'Cara Bayar 2',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jpgrooming_cara2Field, master_jpgrooming_tunai2Group, master_jpgrooming_kwitansi2Group ,master_jpgrooming_card2Group, master_jpgrooming_cek2Group, master_jpgrooming_transfer2Group, master_jpgrooming_voucher2Group]
            },{
                title:'Cara Bayar 3',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jpgrooming_cara3Field, master_jpgrooming_tunai3Group, master_jpgrooming_kwitansi3Group, master_jpgrooming_card3Group, master_jpgrooming_cek3Group, master_jpgrooming_transfer3Group, master_jpgrooming_voucher3Group]
            }]
	});
	
	master_jpgrooming_bayarGroup = new Ext.form.FieldSet({
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
				items: [master_jpgrooming_carabayar_TabPanel] 
			}
			,{
				columnWidth:0.3,
				labelWidth: 120,
				layout: 'form',
    			labelPad: 0,
				baseCls: 'x-plain',
				border:false,
				labelAlign: 'left',
				items: [jpgrooming_jumlahField, jpgrooming_subTotalField, jpgrooming_diskonField, jpgrooming_cashback_cfField, {xtype: 'spacer',height:10},jpgrooming_totalField, jpgrooming_bayarField,jpgrooming_hutangField, jpgrooming_pesanLabel, jpgrooming_lunasLabel] 
			}
			]
	
	});
	
	/*Fieldset Master*/
	master_jpgrooming_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jpgrooming_nobuktiField, jpgrooming_karyawanField] //jpgrooming_cust_nomemberField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jpgrooming_tanggalField, jpgrooming_keteranganField] 
			}
			]
	
	});
	
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_jualproduk_grooming_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intopeprodukan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dpgrooming_id', type: 'int', mapping: 'dpgrooming_id'}, 
			{name: 'dpgrooming_master', type: 'int', mapping: 'dpgrooming_master'}, 
			{name: 'dpgrooming_produk', type: 'int', mapping: 'dpgrooming_produk'}, 
			{name: 'dpgrooming_satuan', type: 'int', mapping: 'dpgrooming_satuan'}, 
			{name: 'dpgrooming_jumlah', type: 'int', mapping: 'dpgrooming_jumlah'}, 
			{name: 'dpgrooming_harga', type: 'float', mapping: 'dpgrooming_harga'}, 
			{name: 'dpgrooming_diskon', type: 'int', mapping: 'dpgrooming_diskon'},
			{name: 'dpgrooming_sales', type: 'string', mapping: 'dpgrooming_sales'},
			{name: 'dpgrooming_diskon_jenis', type: 'string', mapping: 'dpgrooming_diskon_jenis'},
			{name: 'dpgrooming_subtotal', type: 'float', mapping: 'dpgrooming_subtotal'},
			{name: 'dpgrooming_subtotal_net', type: 'int', mapping: 'dpgrooming_subtotal_net'},
			{name: 'konversi_nilai_temp', type: 'float', mapping: 'konversi_nilai_temp'},
			{name: 'jpgrooming_bayar', type: 'float', mapping: 'jpgrooming_bayar'},
			{name: 'jpgrooming_diskon', type: 'int', mapping: 'jpgrooming_diskon'},
			{name: 'jpgrooming_cashback', type: 'float', mapping: 'jpgrooming_cashback'}
	]);
	//eof
	
	
	//function for json writer of detail
	var detail_jualproduk_grooming_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_jpgrooming_DataStore = new Ext.data.Store({
		id: 'detail_jpgrooming_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=detail_detail_jpgrooming_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: pageS},
		reader: detail_jualproduk_grooming_reader,
		sortInfo:{field: 'dpgrooming_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_jualproduk_grooming= new Ext.ux.grid.RowEditor({
        saveText: 'Update'/*,
        listeners: {
        	berforeedit: function(){
			detail_jpgrooming_DataStore.on('cellclick',function(grid, rowIndex, columnIndex, e){
				Ext.Msg.alert('Status', 'Changes saved successfully.');
			});
			}
		}*//*,
		listeners: {
			afteredit: function(){
				detail_jpgrooming_DataStore.commitChanges();
			}
		}*/
    });
	//eof
	
	cbo_dpgrooming_produkDataStore = new Ext.data.Store({
		id: 'cbo_dpgrooming_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_produk_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'dpgrooming_produk_value', type: 'int', mapping: 'produk_id'},
			{name: 'dpgrooming_produk_harga', type: 'float', mapping: 'produk_harga'},
			{name: 'dpgrooming_produk_kode', type: 'string', mapping: 'produk_kode'},
			{name: 'dpgrooming_produk_satuan', type: 'string', mapping: 'satuan_kode'},
			{name: 'dpgrooming_produk_group', type: 'string', mapping: 'group_nama'},
			{name: 'dpgrooming_produk_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'dpgrooming_produk_du', type: 'float', mapping: 'produk_du'},
			{name: 'dpgrooming_produk_dm', type: 'float', mapping: 'produk_dm'},
			{name: 'dpgrooming_produk_display', type: 'string', mapping: 'produk_nama'}
		]),
		sortInfo:{field: 'dpgrooming_produk_display', direction: "ASC"}
	});
	
	cbo_dpgrooming_satuanDataStore = new Ext.data.Store({
		id: 'cbo_dpgrooming_satuanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_satuan_bydjproduk_list', 
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
		sortInfo:{field: 'djproduk_satuan_default', direction: "DESC"}
	});
	
	/*cbo_dpgrooming_satuanDataStore = new Ext.data.Store({
		id: 'cbo_dpgrooming_satuanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_satuan_byproduk_list', 
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
	});*/
	
	
	memberDataStore = new Ext.data.Store({
		id: 'memberDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_member_by_cust', 
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
		//cbo_dpgrooming_produkDataStore.load({params: {limit:0}});
		//cbo_dpgrooming_satuanDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_jpgrooming=new Ext.form.ComboBox({
			store: cbo_dpgrooming_produkDataStore,
			mode: 'remote',
			displayField: 'dpgrooming_produk_display',
			valueField: 'dpgrooming_produk_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: produk_jpgrooming_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var combo_satuan_jpgrooming=new Ext.form.ComboBox({
		store: cbo_dpgrooming_satuanDataStore,
		mode:'local',
		typeAhead: true,
		displayField: 'djproduk_satuan_display',
		valueField: 'djproduk_satuan_value',
		triggerAction: 'all',
		anchor: '95%'
	});
	
	dpgrooming_idField=new Ext.form.NumberField();
	djproduk_satuan_nilaiField=new Ext.form.NumberField();
	
	combo_jpgrooming.on('select',function(){
		var j=cbo_dpgrooming_produkDataStore.findExact('dpgrooming_produk_value',combo_jpgrooming.getValue(),0);
		if(cbo_dpgrooming_produkDataStore.getCount()){
			dpgrooming_idField.setValue(cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_value);
			cbo_dpgrooming_satuanDataStore.load({
				params: {produk_id:dpgrooming_idField.getValue()},
				callback: function(opts, success, response){
					if(success){
						var nilai_default=0;
						var st=cbo_dpgrooming_satuanDataStore.findExact('djproduk_satuan_default','true',0);
						if(cbo_dpgrooming_satuanDataStore.getCount()>=0){
							nilai_default=cbo_dpgrooming_satuanDataStore.getAt(st).data.djproduk_satuan_nilai;
							if(nilai_default===1){
								temp_konv_nilai.setValue(nilai_default);
							}else if(nilai_default!==1){
								temp_konv_nilai.setValue(nilai_default*(1/nilai_default));
							}
						}
					}
				}
			});
		}
	});

	temp_konv_nilai=new Ext.form.NumberField();

	combo_satuan_jpgrooming.on('focus', function(){
		cbo_dpgrooming_satuanDataStore.setBaseParam('produk_id',combo_jpgrooming.getValue());
		cbo_dpgrooming_satuanDataStore.load();
	});
	combo_satuan_jpgrooming.on('select', function(){
		var j=cbo_dpgrooming_satuanDataStore.findExact('djproduk_satuan_value',combo_satuan_jpgrooming.getValue(),0);
		var jt=cbo_dpgrooming_satuanDataStore.findExact('djproduk_satuan_default','true',0);
		var nilai_terpilih=0;
		var nilai_default=0;
		if(cbo_dpgrooming_satuanDataStore.getCount()>=0){
			if(cbo_dpgrooming_satuanDataStore.getAt(j).data.djproduk_satuan_default=="true"){
				//Harga_Produk=harga yg tercantum di Master Produk tanpa proses bagi/kali
				djproduk_satuan_nilaiField.setValue(1);
				detail_jpgrooming_DataStore.getAt(0).data.konversi_nilai_temp=1;
				temp_konv_nilai.setValue(1);
			}else if(cbo_dpgrooming_satuanDataStore.getAt(j).data.djproduk_satuan_default=="false"){
				//ambil satuan_nilai dr satuan_id yg terpilih, ambil satuan_nilai dr satuan_default=true
				//jika [satuan_nilai dr satuan_default=true] === 1 => Harga_Produk=[satuan_nilai dr satuan_id yg terpilih]*data.djproduk_satuan_harga
				//jika [satuan_nilai dr satuan_default=true] !== 1 AND [satuan_nilai dr satuan_default=true] < [satuan_nilai dr satuan_id yg terpilih] => Harga_Produk=([satuan_nilai dr satuan_id yg terpilih]/[satuan_nilai dr satuan_default=true])*data.djproduk_satuan_harga 
				//jika [satuan_nilai dr satuan_default=true] !== 1 AND [satuan_nilai dr satuan_default=true] > [satuan_nilai dr satuan_id yg terpilih] => Harga_Produk=data.djproduk_satuan_harga/[satuan_nilai dr satuan_default=true]
				nilai_terpilih=cbo_dpgrooming_satuanDataStore.getAt(j).data.djproduk_satuan_nilai;
				nilai_default=cbo_dpgrooming_satuanDataStore.getAt(jt).data.djproduk_satuan_nilai;
				if(nilai_default===1){
					djproduk_satuan_nilaiField.setValue(cbo_dpgrooming_satuanDataStore.getAt(j).data.djproduk_satuan_nilai);
					detail_jpgrooming_DataStore.getAt(0).data.konversi_nilai_temp=cbo_dpgrooming_satuanDataStore.getAt(j).data.djproduk_satuan_nilai;
					temp_konv_nilai.setValue(cbo_dpgrooming_satuanDataStore.getAt(j).data.djproduk_satuan_nilai);
				}else if(nilai_default!==1 && nilai_default<nilai_terpilih){
					djproduk_satuan_nilaiField.setValue(nilai_terpilih/nilai_default);
					detail_jpgrooming_DataStore.getAt(0).data.konversi_nilai_temp=nilai_terpilih/nilai_default;
					temp_konv_nilai.setValue(nilai_terpilih/nilai_default);
				}else if(nilai_default!==1 && nilai_default>nilai_terpilih){
					djproduk_satuan_nilaiField.setValue(1/nilai_default);
					detail_jpgrooming_DataStore.getAt(0).data.konversi_nilai_temp=1/nilai_default;
					temp_konv_nilai.setValue(1/nilai_default);
				}
			}
			
		}
	});
		

	//declaration of detail coloumn model
	detail_jpgrooming_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			align : 'Left',
			header: '<div align="center">' + 'Produk' + '</div>',
			dataIndex: 'dpgrooming_produk',
			width: 300, //250
			sortable: true,
			allowBlank: false,
			editor: combo_jpgrooming,
			renderer: Ext.util.Format.comboRenderer(combo_jpgrooming)
		},
		{
			align :'Left',
			header: '<div align="center">' + 'Satuan' + '</div>',
			dataIndex: 'dpgrooming_satuan',
			width: 60, //80,
			sortable: true,
			editor: combo_satuan_jpgrooming,
			renderer: Ext.util.Format.comboRenderer(combo_satuan_jpgrooming)
/*
			renderer: function(v, params, record){
				j=cbo_dpgrooming_produkDataStore.findExact('dpgrooming_produk_value',record.data.dpgrooming_produk,0);
				if(j>-1){
					return cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_satuan;
				}
			}			
*/
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'dpgrooming_jumlah',
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
			dataIndex: 'dpgrooming_harga',
			width: 100, //150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		}
		,{
			align : 'Right',
			header: '<div align="center">' + 'Sub Total (Rp)' + '</div>',
			dataIndex: 'dpgrooming_subtotal',
			width: 100, //150,
			sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
				return Ext.util.Format.number(record.data.konversi_nilai_temp*record.data.dpgrooming_harga* record.data.dpgrooming_jumlah,'0,000');
			}
		},
		{
			align : 'Left',
			header: '<div align="center">' + 'Jenis Diskon' + '</div>',
			dataIndex: 'dpgrooming_diskon_jenis',
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
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Diskon (%)' + '</div>',
			dataIndex: 'dpgrooming_diskon',
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
		},
		{
			align :'Right',
			header: '<div align="center">' + 'Sub Tot Net (Rp)' + '</div>',
			dataIndex: 'dpgrooming_subtotal_net',
			width: 100, //150,
			sortable: true,
			reaOnly: true,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.dpgrooming_subtotal*(100-record.data.dpgrooming_diskon)/100,'0,000');
            }
		},/*{
			header: 'Sales',
			dataIndex: 'dpgrooming_sales',
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
	detail_jpgrooming_ColumnModel.defaultSortable= true;
	//eof
	
	function get_harga_produk(id_produk){
		var harga_produk=0;
		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_harga_produk',
			params:{ produk_id	: id_produk },
			success: function(response){							
				var result=response.responseText;
				harga_produk=result;
			}
		});
		return harga_produk;
	}
	
	
	//declaration of detail list editor grid
	detail_jpgroomingListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_jpgroomingListEditorGrid',
		el: 'fp_detail_jualproduk_grooming',
		title: 'Detail Penjualan Produk',
		height: 250,
		width: 918,
		autoScroll: true,
		store: detail_jpgrooming_DataStore, // DataStore
		colModel: detail_jpgrooming_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_jualproduk_grooming],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_jpgrooming_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_jpgrooming_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: detail_jpgrooming_confirm_delete
		}
		]
	});
	//eof
	
	//function of detail add
	function detail_jpgrooming_add(){
		var edit_detail_jual_produk= new detail_jpgroomingListEditorGrid.store.recordType({
			dpgrooming_id	:'',		
			dpgrooming_master	:'',		
			dpgrooming_produk	:null,		
			dpgrooming_satuan	:null,		
			dpgrooming_jumlah	:null,		
			dpgrooming_harga	:null,
			dpgrooming_diskon_jenis: null,
			dpgrooming_diskon	:null,
			dpgrooming_sales	:null
		});
		editor_detail_jualproduk_grooming.stopEditing();
		detail_jpgrooming_DataStore.insert(0, edit_detail_jual_produk);
		//detail_jpgroomingListEditorGrid.getView().refresh();
		detail_jpgroomingListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_jualproduk_grooming.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_jual_produk(){
		detail_jpgrooming_DataStore.commitChanges();
		detail_jpgroomingListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_jpgrooming_insert(){
		var count_detail=detail_jpgrooming_DataStore.getCount();
		for(i=0;i<detail_jpgrooming_DataStore.getCount();i++){
			detail_jual_produk_record=detail_jpgrooming_DataStore.getAt(i);
			if(detail_jual_produk_record.data.dpgrooming_produk!==null&&detail_jual_produk_record.data.dpgrooming_produk.dpgrooming_produk!==""){
				Ext.Ajax.request({
					waitMsg: 'Mohon tunggu...',
					url: 'index.php?c=c_master_jualproduk_grooming&m=detail_detail_jpgrooming_insert',
					params:{
						dpgrooming_id	: detail_jual_produk_record.data.dpgrooming_id, 
						dpgrooming_master	: eval(jpgrooming_idField.getValue()), 
						dpgrooming_produk	: detail_jual_produk_record.data.dpgrooming_produk,
						dpgrooming_satuan	: detail_jual_produk_record.data.dpgrooming_satuan,
						dpgrooming_jumlah	: detail_jual_produk_record.data.dpgrooming_jumlah, 
						dpgrooming_harga	: detail_jual_produk_record.data.dpgrooming_harga, 
						dpgrooming_subtotal_net	: detail_jual_produk_record.data.dpgrooming_subtotal_net,
						dpgrooming_diskon	: detail_jual_produk_record.data.dpgrooming_diskon,
						dpgrooming_diskon_jenis	: detail_jual_produk_record.data.dpgrooming_diskon_jenis,
						dpgrooming_sales			: detail_jual_produk_record.data.dpgrooming_sales,
						konversi_nilai_temp	: detail_jual_produk_record.data.konversi_nilai_temp
					},
					timeout: 60000,
					success: function(response){							
						var result=eval(response.responseText);
						if(i==count_detail){
							Ext.Ajax.request({
								waitMsg: 'Mohon tunggu...',
								url: 'index.php?c=c_master_jualproduk_grooming&m=catatan_piutang_update',
								params:{dpgrooming_master	: eval(jpgrooming_idField.getValue())}
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
			}
		}
	}
	//eof
	
	//function for purge detail
	function detail_jpgrooming_purge(){
		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jualproduk_grooming&m=detail_detail_jpgrooming_purge',
			params:{ master_id: eval(jpgrooming_idField.getValue()) },
			callback: function(opts, success, response){
				if(success){
					detail_jpgrooming_insert();
				}
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_jpgrooming_confirm_delete(){
		// only one record is selected here
		if(detail_jpgroomingListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data berikut?', detail_jpgrooming_delete);
		} else if(detail_jpgroomingListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data-data berikut?', detail_jpgrooming_delete);
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
	function detail_jpgrooming_delete(btn){
		if(btn=='yes'){
			var s = detail_jpgroomingListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_jpgrooming_DataStore.remove(r);
			}
		} 
		detail_jpgrooming_DataStore.commitChanges();
	}
	//eof
	
	
	function update_group_carabayar_jpgrooming(){
		var value=jpgrooming_caraField.getValue();
		master_jpgrooming_tunaiGroup.setVisible(false);
		master_jpgrooming_cardGroup.setVisible(false);
		master_jpgrooming_cekGroup.setVisible(false);
		master_jpgrooming_transferGroup.setVisible(false);
		master_jpgrooming_kwitansiGroup.setVisible(false);
		master_jpgrooming_voucherGroup.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jpgrooming_tunai_nilaiField.reset();
		jpgrooming_tunai_nilai_cfField.reset();
		jpgrooming_card_nilaiField.reset();
		jpgrooming_card_nilai_cfField.reset();
		jpgrooming_cek_nilaiField.reset();
		jpgrooming_cek_nilai_cfField.reset();
		jpgrooming_transfer_nilaiField.reset();
		jpgrooming_transfer_nilai_cfField.reset();
		jpgrooming_kwitansi_nilaiField.reset();
		jpgrooming_kwitansi_nilai_cfField.reset();
		jpgrooming_voucher_cashbackField.reset();
		//jpgrooming_voucher_cashback_cfField.reset();
		//load_total_produk_bayar();
		
		if(value=='card'){
			master_jpgrooming_cardGroup.setVisible(true);
		}else if(value=='cek/giro'){
			master_jpgrooming_cekGroup.setVisible(true);
		}else if(value=='transfer'){
			master_jpgrooming_transferGroup.setVisible(true);
		}else if(value=='kwitansi'){
			master_jpgrooming_kwitansiGroup.setVisible(true);
		}else if(value=='voucher'){
			master_jpgrooming_voucherGroup.setVisible(true);
		}else if(value=='tunai'){
			master_jpgrooming_tunaiGroup.setVisible(true);
		}
	}
	
	function update_group_carabayar2_jpgrooming(){
		var value=jpgrooming_cara2Field.getValue();
		master_jpgrooming_tunai2Group.setVisible(false);
		master_jpgrooming_card2Group.setVisible(false);
		master_jpgrooming_cek2Group.setVisible(false);
		master_jpgrooming_transfer2Group.setVisible(false);
		master_jpgrooming_kwitansi2Group.setVisible(false);
		master_jpgrooming_voucher2Group.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jpgrooming_tunai_nilai2Field.reset();
		jpgrooming_tunai_nilai2_cfField.reset();
		jpgrooming_card_nilai2Field.reset();
		jpgrooming_card_nilai2_cfField.reset();
		jpgrooming_cek_nilai2Field.reset();
		jpgrooming_cek_nilai2_cfField.reset();
		jpgrooming_transfer_nilai2Field.reset();
		jpgrooming_transfer_nilai2_cfField.reset();
		jpgrooming_kwitansi_nilai2Field.reset();
		jpgrooming_kwitansi_nilai2_cfField.reset();
		jpgrooming_voucher_cashback2Field.reset();
		//jpgrooming_voucher_cashback2_cfField.reset();
		//load_total_produk_bayar();
		
		if(value=='card'){
			master_jpgrooming_card2Group.setVisible(true);
		}else if(value=='cek/giro'){
			master_jpgrooming_cek2Group.setVisible(true);
		}else if(value=='transfer'){
			master_jpgrooming_transfer2Group.setVisible(true);
		}else if(value=='kwitansi'){
			master_jpgrooming_kwitansi2Group.setVisible(true);
		}else if(value=='voucher'){
			master_jpgrooming_voucher2Group.setVisible(true);
		}else if(value=='tunai'){
			master_jpgrooming_tunai2Group.setVisible(true);
		}
	}
	
	function update_group_carabayar3_jpgrooming(){
		var value=jpgrooming_cara3Field.getValue();
		master_jpgrooming_tunai3Group.setVisible(false);
		master_jpgrooming_card3Group.setVisible(false);
		master_jpgrooming_cek3Group.setVisible(false);
		master_jpgrooming_transfer3Group.setVisible(false);
		master_jpgrooming_kwitansi3Group.setVisible(false);
		master_jpgrooming_voucher3Group.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jpgrooming_tunai_nilai3Field.reset();
		jpgrooming_tunai_nilai3_cfField.reset();
		jpgrooming_card_nilai3Field.reset();
		jpgrooming_card_nilai3_cfField.reset();
		jpgrooming_cek_nilai3Field.reset();
		jpgrooming_cek_nilai3_cfField.reset();
		jpgrooming_transfer_nilai3Field.reset();
		jpgrooming_transfer_nilai3_cfField.reset();
		jpgrooming_kwitansi_nilai3Field.reset();
		jpgrooming_kwitansi_nilai3_cfField.reset();
		jpgrooming_voucher_cashback3Field.reset();
		//jpgrooming_voucher_cashback3_cfField.reset();
		//load_total_produk_bayar();
		
		if(value=='card'){
			master_jpgrooming_card3Group.setVisible(true);
		}else if(value=='cek/giro'){
			master_jpgrooming_cek3Group.setVisible(true);
		}else if(value=='transfer'){
			master_jpgrooming_transfer3Group.setVisible(true);
		}else if(value=='kwitansi'){
			master_jpgrooming_kwitansi3Group.setVisible(true);
		}else if(value=='voucher'){
			master_jpgrooming_voucher3Group.setVisible(true);
		}else if(value=='tunai'){
			master_jpgrooming_tunai3Group.setVisible(true);
		}
	}
	
	
	/*function load_detail_jual_produk(){
		var detail_jual_produk_record;
		for(i=0;i<detail_jpgrooming_DataStore.getCount();i++){
			detail_jual_produk_record=detail_jpgrooming_DataStore.getAt(i);
			var j=cbo_dpgrooming_produkDataStore.findExact('dpgrooming_produk_value',detail_jual_produk_record.data.dpgrooming_produk,0);
			if(j>0){
				detail_jual_produk_record.data.dpgrooming_harga=cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_harga;
				//detail_jual_produk_record.data.dpgrooming_satuan=cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_satuan;
				if(detail_jual_produk_record.data.dpgrooming_diskon==""){
					if(jpgrooming_cust_nomemberField.getValue()!=""){
						if(cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_dm!==0){
							detail_jual_produk_record.data.dpgrooming_diskon=cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_dm;
							detail_jual_produk_record.data.dpgrooming_diskon_jenis='DM';
						}
					}else{
						if(cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_du!==0){
							detail_jual_produk_record.data.dpgrooming_diskon=cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_du;
							detail_jual_produk_record.data.dpgrooming_diskon_jenis='DU';
						}
					}
				}
			}
		}
	}*/
	var konversi_jpgrooming_store = new Ext.data.Store({
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jualproduk_grooming&m=get_konversi_list',
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
		if(detail_jpgrooming_DataStore.getCount()>0){
			detail_jual_produk_record=detail_jpgrooming_DataStore.getAt(0);
			if(detail_jual_produk_record.data.dpgrooming_satuan==null){
				/* JIKA detail satuan tidak dipilih ==> maka otomatis diisi dengan satuan default dari produk yang dipilih */
				var ds=cbo_dpgrooming_satuanDataStore.findExact('djproduk_satuan_default','true',0);
				if(ds>=0){
					detail_jual_produk_record.data.dpgrooming_satuan=cbo_dpgrooming_satuanDataStore.getAt(ds).data.djproduk_satuan_value;
				}
			}
			
			detail_jual_produk_record.data.konversi_nilai_temp=temp_konv_nilai.getValue();
			var j=cbo_dpgrooming_produkDataStore.findExact('dpgrooming_produk_value',detail_jual_produk_record.data.dpgrooming_produk,0);
			if(j>=0){
				detail_jual_produk_record.data.dpgrooming_harga=cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_harga;
				subtotal_harga=eval(detail_jual_produk_record.data.konversi_nilai_temp*detail_jual_produk_record.data.dpgrooming_jumlah*detail_jual_produk_record.data.dpgrooming_harga);
				//detail_jual_produk_record.data.dpgrooming_satuan=cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_satuan;
				if(detail_jual_produk_record.data.dpgrooming_diskon==""){
					if(jpgrooming_cust_nomemberField.getValue()!=""){
						if(cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_dm!==0){
							detail_jual_produk_record.data.dpgrooming_diskon=cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_dm;
							detail_jual_produk_record.data.dpgrooming_diskon_jenis='DM';
						}
					}else{
						if(cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_du!==0){
							detail_jual_produk_record.data.dpgrooming_diskon=cbo_dpgrooming_produkDataStore.getAt(j).data.dpgrooming_produk_du;
							detail_jual_produk_record.data.dpgrooming_diskon_jenis='DU';
						}
					}
				}
			}
			detail_jual_produk_record.data.dpgrooming_subtotal=subtotal_harga;
			detail_jual_produk_record.data.dpgrooming_subtotal_net=subtotal_harga*((100-detail_jual_produk_record.data.dpgrooming_diskon)/100);
		}
		
		for(i=0;i<detail_jpgrooming_DataStore.getCount();i++){
			jumlah_item=jumlah_item+eval(detail_jpgrooming_DataStore.getAt(i).data.dpgrooming_jumlah);
			subtotal_harga_field+=detail_jpgrooming_DataStore.getAt(i).data.dpgrooming_subtotal_net;
		}
		
		jpgrooming_jumlahField.setValue(jumlah_item);
		
		jpgrooming_subTotalField.setValue(subtotal_harga_field);
		
		total_harga=subtotal_harga_field*(100-jpgrooming_diskonField.getValue())/100 - jpgrooming_cashbackField.getValue();
		total_harga=(total_harga>0?Math.round(total_harga):0);
		jpgrooming_totalField.setValue(total_harga);

		

		transfer_nilai=jpgrooming_transfer_nilaiField.getValue();
		if(/^\d+$/.test(transfer_nilai))
			transfer_nilai=jpgrooming_transfer_nilaiField.getValue();
		else
			transfer_nilai=0;
		
		transfer_nilai2=jpgrooming_transfer_nilai2Field.getValue();
		if(/^\d+$/.test(transfer_nilai2))
			transfer_nilai2=jpgrooming_transfer_nilai2Field.getValue();
		else
			transfer_nilai2=0;
		
		transfer_nilai3=jpgrooming_transfer_nilai3Field.getValue();
		if(/^\d+$/.test(transfer_nilai3))
			transfer_nilai3=jpgrooming_transfer_nilai3Field.getValue();
		else
			transfer_nilai3=0;
		
		kwitansi_nilai=jpgrooming_kwitansi_nilaiField.getValue();
		if(/^\d+$/.test(kwitansi_nilai))
			kwitansi_nilai=jpgrooming_kwitansi_nilaiField.getValue();
		else
			kwitansi_nilai=0;
		
		kwitansi_nilai2=jpgrooming_kwitansi_nilai2Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai2))
			kwitansi_nilai2=jpgrooming_kwitansi_nilai2Field.getValue();
		else
			kwitansi_nilai2=0;
		
		kwitansi_nilai3=jpgrooming_kwitansi_nilai3Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai3))
			kwitansi_nilai3=jpgrooming_kwitansi_nilai3Field.getValue();
		else
			kwitansi_nilai3=0;
		
		card_nilai=jpgrooming_card_nilaiField.getValue();
		if(/^\d+$/.test(card_nilai))
			card_nilai=jpgrooming_card_nilaiField.getValue();
		else
			card_nilai=0;
		
		card_nilai2=jpgrooming_card_nilai2Field.getValue();
		if(/^\d+$/.test(card_nilai2))
			card_nilai2=jpgrooming_card_nilai2Field.getValue();
		else
			card_nilai2=0;
		
		card_nilai3=jpgrooming_card_nilai3Field.getValue();
		if(/^\d+$/.test(card_nilai3))
			card_nilai3=jpgrooming_card_nilai3Field.getValue();
		else
			card_nilai3=0;
		
		cek_nilai=jpgrooming_cek_nilaiField.getValue();
		if(/^\d+$/.test(cek_nilai))
			cek_nilai=jpgrooming_cek_nilaiField.getValue();
		else
			cek_nilai=0;
		
		cek_nilai2=jpgrooming_cek_nilai2Field.getValue();
		if(/^\d+$/.test(cek_nilai2))
			cek_nilai2=jpgrooming_cek_nilai2Field.getValue();
		else
			cek_nilai2=0;
		
		cek_nilai3=jpgrooming_cek_nilai3Field.getValue();
		if(/^\d+$/.test(cek_nilai3))
			cek_nilai3=jpgrooming_cek_nilai3Field.getValue();
		else
			cek_nilai3=0;
		
		voucher_nilai=jpgrooming_voucher_cashbackField.getValue();
		if(/^\d+$/.test(voucher_nilai))
			voucher_nilai=jpgrooming_voucher_cashbackField.getValue();
		else
			voucher_nilai=0;
		
		voucher_nilai2=jpgrooming_voucher_cashback2Field.getValue();
		if(/^\d+$/.test(voucher_nilai2))
			voucher_nilai2=jpgrooming_voucher_cashback2Field.getValue();
		else
			voucher_nilai2=0;
		
		voucher_nilai3=jpgrooming_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai3))
			voucher_nilai3=jpgrooming_voucher_cashback3Field.getValue();
		else
			voucher_nilai3=0;

		tunai_nilai=jpgrooming_tunai_nilaiField.getValue();
		if(/^\d+$/.test(tunai_nilai))
			tunai_nilai=jpgrooming_tunai_nilaiField.getValue();
		else
			tunai_nilai=0;

		tunai_nilai2=jpgrooming_tunai_nilai2Field.getValue();
		if(/^\d+$/.test(tunai_nilai2))
			tunai_nilai2=jpgrooming_tunai_nilai2Field.getValue();
		else
			tunai_nilai2=0;

		tunai_nilai3=jpgrooming_tunai_nilai3Field.getValue();
		if(/^\d+$/.test(tunai_nilai3))
			tunai_nilai3=jpgrooming_tunai_nilai3Field.getValue();
		else
			tunai_nilai3=0;


		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		total_bayar=(total_bayar>0?Math.round(total_bayar):0);
		jpgrooming_bayarField.setValue(total_bayar);

		total_hutang=total_harga-total_bayar;
		total_hutang=(total_hutang>0?Math.round(total_hutang):0);
		jpgrooming_hutangField.setValue(total_hutang);
		
		if(total_bayar>total_harga){
			jpgrooming_pesanLabel.setText("Kelebihan Jumlah Bayar");
		}else if(total_bayar<total_harga || total_bayar==total_harga){
			jpgrooming_pesanLabel.setText("");
		}
		if(total_bayar==total_harga){
			jpgrooming_lunasLabel.setText("LUNAS");
		}else if(total_bayar!==total_harga){
			jpgrooming_lunasLabel.setText("");
		}
	}

	function load_total_bayar_updating(){
		var update_total_field=0;
		var update_hutang_field=0;
		var jpgrooming_bayar_temp=jpgrooming_bayarField.getValue();
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
		
		transfer_nilai=jpgrooming_transfer_nilaiField.getValue();
		if(/^\d+$/.test(transfer_nilai))
			transfer_nilai=jpgrooming_transfer_nilaiField.getValue();
		else
			transfer_nilai=0;

		transfer_nilai2=jpgrooming_transfer_nilai2Field.getValue();
		if(/^\d+$/.test(transfer_nilai2))
			transfer_nilai2=jpgrooming_transfer_nilai2Field.getValue();
		else
			transfer_nilai2=0;
		
		transfer_nilai3=jpgrooming_transfer_nilai3Field.getValue();
		if(/^\d+$/.test(transfer_nilai3))
			transfer_nilai3=jpgrooming_transfer_nilai3Field.getValue();
		else
			transfer_nilai3=0;
		
		kwitansi_nilai=jpgrooming_kwitansi_nilaiField.getValue();
		if(/^\d+$/.test(kwitansi_nilai))
			kwitansi_nilai=jpgrooming_kwitansi_nilaiField.getValue();
		else
			kwitansi_nilai=0;
		
		kwitansi_nilai2=jpgrooming_kwitansi_nilai2Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai2))
			kwitansi_nilai2=jpgrooming_kwitansi_nilai2Field.getValue();
		else
			kwitansi_nilai2=0;
		
		kwitansi_nilai3=jpgrooming_kwitansi_nilai3Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai3))
			kwitansi_nilai3=jpgrooming_kwitansi_nilai3Field.getValue();
		else
			kwitansi_nilai3=0;
		
		card_nilai=jpgrooming_card_nilaiField.getValue();
		if(/^\d+$/.test(card_nilai))
			card_nilai=jpgrooming_card_nilaiField.getValue();
		else
			card_nilai=0;
		
		card_nilai2=jpgrooming_card_nilai2Field.getValue();
		if(/^\d+$/.test(card_nilai2))
			card_nilai2=jpgrooming_card_nilai2Field.getValue();
		else
			card_nilai2=0;
		
		card_nilai3=jpgrooming_card_nilai3Field.getValue();
		if(/^\d+$/.test(card_nilai3))
			card_nilai3=jpgrooming_card_nilai3Field.getValue();
		else
			card_nilai3=0;
		
		cek_nilai=jpgrooming_cek_nilaiField.getValue();
		if(/^\d+$/.test(cek_nilai))
			cek_nilai=jpgrooming_cek_nilaiField.getValue();
		else
			cek_nilai=0;
		
		cek_nilai2=jpgrooming_cek_nilai2Field.getValue();
		if(/^\d+$/.test(cek_nilai2))
			cek_nilai2=jpgrooming_cek_nilai2Field.getValue();
		else
			cek_nilai2=0;
		
		cek_nilai3=jpgrooming_cek_nilai3Field.getValue();
		if(/^\d+$/.test(cek_nilai3))
			cek_nilai3=jpgrooming_cek_nilai3Field.getValue();
		else
			cek_nilai3=0;
		
		voucher_nilai=jpgrooming_voucher_cashbackField.getValue();
		if(/^\d+$/.test(voucher_nilai))
			voucher_nilai=jpgrooming_voucher_cashbackField.getValue();
		else
			voucher_nilai=0;
		
		voucher_nilai2=jpgrooming_voucher_cashback2Field.getValue();
		if(/^\d+$/.test(voucher_nilai2))
			voucher_nilai2=jpgrooming_voucher_cashback2Field.getValue();
		else
			voucher_nilai2=0;
		
		voucher_nilai3=jpgrooming_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai3))
			voucher_nilai3=jpgrooming_voucher_cashback3Field.getValue();
		else
			voucher_nilai3=0;

		tunai_nilai=jpgrooming_tunai_nilaiField.getValue();
		if(/^\d+$/.test(tunai_nilai))
			tunai_nilai=jpgrooming_tunai_nilaiField.getValue();
		else
			tunai_nilai=0;

		tunai_nilai2=jpgrooming_tunai_nilai2Field.getValue();
		if(/^\d+$/.test(tunai_nilai2))
			tunai_nilai2=jpgrooming_tunai_nilai2Field.getValue();
		else
			tunai_nilai2=0;

		tunai_nilai3=jpgrooming_tunai_nilai3Field.getValue();
		if(/^\d+$/.test(tunai_nilai3))
			tunai_nilai3=jpgrooming_tunai_nilai3Field.getValue();
		else
			tunai_nilai3=0;

		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		
		update_total_field=jpgrooming_subTotalField.getValue()*((100-jpgrooming_diskonField.getValue())/100)-jpgrooming_cashbackField.getValue();
		jpgrooming_totalField.setValue(update_total_field);

		jpgrooming_bayarField.setValue(total_bayar);
		
		update_hutang_field=update_total_field-total_bayar;
		jpgrooming_hutangField.setValue(update_hutang_field);

		jpgrooming_diskonField.setValue(jpgrooming_diskonField.getValue());
		jpgrooming_cashbackField.setValue(jpgrooming_cashbackField.getValue());
		jpgrooming_cashback_cfField.setValue(CurrencyFormatted(jpgrooming_cashbackField.getValue()));
		
		if(total_bayar>update_total_field){
			jpgrooming_pesanLabel.setText("Kelebihan Jumlah Bayar");
		}else if(total_bayar<update_total_field || total_bayar==update_total_field){
			jpgrooming_pesanLabel.setText("");
		}
		if(total_bayar==update_total_field){
			jpgrooming_lunasLabel.setText("LUNAS");
		}else if(total_bayar!==update_total_field){
			jpgrooming_lunasLabel.setText("");
		}

	}
	
	function load_all_jual_produk(){
		load_total_produk_bayar();
	}
	//event on update of detail data store
	detail_jpgrooming_DataStore.on("update",load_all_jual_produk);
	//detail_jpgrooming_DataStore.on("load",load_total_produk_bayar);
	jpgrooming_bayarField.on("keyup",load_total_produk_bayar);
	jpgrooming_diskonField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_cashbackField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_cashback_cfField.on("keyup",function(){
		var cf_value = jpgrooming_cashback_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_cashbackField.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_cashbackField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//kwitansi
	jpgrooming_kwitansi_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_kwitansi_nilai_cfField.on("keyup",function(){
		var cf_value = jpgrooming_kwitansi_nilai_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_kwitansi_nilaiField.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_kwitansi_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_kwitansi_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_kwitansi_nilai2_cfField.on("keyup",function(){
		var cf_value = jpgrooming_kwitansi_nilai2_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_kwitansi_nilai2Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_kwitansi_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_kwitansi_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_kwitansi_nilai3_cfField.on("keyup",function(){
		var cf_value = jpgrooming_kwitansi_nilai3_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_kwitansi_nilai3Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_kwitansi_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//card
	jpgrooming_card_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_card_nilai_cfField.on("keyup",function(){
		var cf_value = jpgrooming_card_nilai_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_card_nilaiField.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_card_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_card_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_card_nilai2_cfField.on("keyup",function(){
		var cf_value = jpgrooming_card_nilai2_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_card_nilai2Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_card_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_card_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_card_nilai3_cfField.on("keyup",function(){
		var cf_value = jpgrooming_card_nilai3_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_card_nilai3Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_card_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//cek/giro
	jpgrooming_cek_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_cek_nilai_cfField.on("keyup",function(){
		var cf_value = jpgrooming_cek_nilai_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_cek_nilaiField.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_cek_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_cek_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_cek_nilai2_cfField.on("keyup",function(){
		var cf_value = jpgrooming_cek_nilai2_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_cek_nilai2Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_cek_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_cek_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_cek_nilai3_cfField.on("keyup",function(){
		var cf_value = jpgrooming_cek_nilai3_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_cek_nilai3Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_cek_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//transfer
	jpgrooming_transfer_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_transfer_nilai_cfField.on("keyup",function(){
		var cf_value = jpgrooming_transfer_nilai_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_transfer_nilaiField.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_transfer_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_transfer_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_transfer_nilai2_cfField.on("keyup",function(){
		var cf_value = jpgrooming_transfer_nilai2_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_transfer_nilai2Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_transfer_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_transfer_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_transfer_nilai3_cfField.on("keyup",function(){
		var cf_value = jpgrooming_transfer_nilai3_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_transfer_nilai3Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_transfer_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//voucher
	jpgrooming_voucher_cashbackField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_voucher_cashback2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_voucher_cashback3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	//tunai
	jpgrooming_tunai_nilaiField.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_tunai_nilai_cfField.on("keyup",function(){
		var cf_value = jpgrooming_tunai_nilai_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_tunai_nilaiField.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_tunai_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_tunai_nilai2Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_tunai_nilai2_cfField.on("keyup",function(){
		var cf_value = jpgrooming_tunai_nilai2_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_tunai_nilai2Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_tunai_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpgrooming_tunai_nilai3Field.on("keyup",function(){if(post2db=="CREATE"){load_total_produk_bayar();}else if(post2db=="UPDATE"){load_total_bayar_updating();}});
	jpgrooming_tunai_nilai3_cfField.on("keyup",function(){
		var cf_value = jpgrooming_tunai_nilai3_cfField.getValue();
		if(post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_tunai_nilai3Field.setValue(cf_tonumber);
			load_total_produk_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpgrooming_tunai_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	
	jpgrooming_caraField.on("select",update_group_carabayar_jpgrooming);
	jpgrooming_cara2Field.on("select",update_group_carabayar2_jpgrooming);
	jpgrooming_cara3Field.on("select",update_group_carabayar3_jpgrooming);
	jpgrooming_karyawanField.on("select",function(){
		/*load_membership();
		j=memberDataStore.findExact('member_cust',jpgrooming_karyawanField.getValue(),0);
		if(j>-1)
			jpgrooming_cust_nomemberField.setValue(memberDataStore.getAt(j).member_no);
		else
			jpgrooming_cust_nomemberField.setValue("");
*/
		cbo_karyawan=jpgrooming_karyawanDataStore.findExact('karyawan_id',jpgrooming_karyawanField.getValue(),0);
		if(cbo_karyawan>-1){
			cbo_kwitansi_jpgrooming_DataStore.load({params: {kwitansi_cust: jpgrooming_karyawanDataStore.getAt(cbo_karyawan).data.karyawan_id}});
			jpgrooming_cek_namaField.setValue(jpgrooming_karyawanDataStore.getAt(cbo_karyawan).data.karyawan_nama);
			jpgrooming_cek_nama2Field.setValue(jpgrooming_karyawanDataStore.getAt(cbo_karyawan).data.karyawan_nama);
			jpgrooming_cek_nama3Field.setValue(jpgrooming_karyawanDataStore.getAt(cbo_karyawan).data.karyawan_nama);

			jpgrooming_transfer_namaField.setValue(jpgrooming_karyawanDataStore.getAt(cbo_karyawan).data.karyawan_nama);
			jpgrooming_transfer_nama2Field.setValue(jpgrooming_karyawanDataStore.getAt(cbo_karyawan).data.karyawan_nama);
			jpgrooming_transfer_nama3Field.setValue(jpgrooming_karyawanDataStore.getAt(cbo_karyawan).data.karyawan_nama);
		}
	});
	
	function show_windowGrid(){
		//cbo_dpgrooming_satuanDataStore.load();
		master_jpgrooming_DataStore.load({
			params: {start: 0, limit: pageS},
			callback: function(opts, success, response){
				if(success){
					master_jpgrooming_createWindow.show();
				}
			}
		});	// load DataStore
	}
	
	/* Function for retrieve create Window Panel*/ 
	master_jpgrooming_createForm = new Ext.FormPanel({
		title: 'Penjualan Produk',
		labelAlign: 'left',
		el: 'form_produkgrooming_addEdit',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 	940,
		frame: true,
		layout: 'fit',
		items: [master_jpgrooming_masterGroup,detail_jpgroomingListEditorGrid,master_jpgrooming_bayarGroup]
		,
		buttons: [
			{
				text: '<span style="font-weight:bold">Lihat Daftar</span>',
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
				handler: master_jpgrooming_SelectedRow_create
			},
			{
				text: 'Cancel',
				handler: function(){
					master_jpgrooming_SelectedRow_reset_form();
					detail_jpgrooming_DataStore.load({params: {master_id:0}});
					jpgrooming_caraField.setValue("card");
					master_jpgrooming_cardGroup.setVisible(true);
					master_jpgrooming_carabayar_TabPanel.setActiveTab(0);
					post2db="CREATE";
				}
			}
		]
	});
	/* End  of Function*/
	
	
	/* Function for retrieve create Window Form */
	master_jpgrooming_createWindow= new Ext.Window({
		id: 'master_jpgrooming_createWindow',
		//title: post2db+'Master_jual_produk',
		title: 'Daftar Penjualan Produk(Grooming)',
		closable:true,
		closeAction: 'hide',
		//autoWidth: true,
		width: 1200,	//810,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_jpgrooming_create',
		items: master_jpgroomingListEditorGrid
	});
	/* End Window */
	
	/* Function for action list search */
	function master_jpgrooming_list_search(){
		// render according to a SQL date format.
		var jpgrooming_id_search=null;
		var jpgrooming_nobukti_search=null;
		var jpgrooming_karyawan_search=null;
		var jpgrooming_tanggal_search_date="";
		var jpgrooming_diskon_search=null;
		var jpgrooming_cara_search=null;
		var jpgrooming_keterangan_search=null;

		if(jpgrooming_idSearchField.getValue()!==null){jpgrooming_id_search=jpgrooming_idSearchField.getValue();}
		if(jpgrooming_nobuktiSearchField.getValue()!==null){jpgrooming_nobukti_search=jpgrooming_nobuktiSearchField.getValue();}
		if(jpgrooming_karyawanSearchField.getValue()!==null){jpgrooming_karyawan_search=jpgrooming_karyawanSearchField.getValue();}
		if(jpgrooming_tanggalSearchField.getValue()!==""){jpgrooming_tanggal_search_date=jpgrooming_tanggalSearchField.getValue().format('Y-m-d');}
		if(jpgrooming_diskonSearchField.getValue()!==null){jpgrooming_diskon_search=jpgrooming_diskonSearchField.getValue();}
		if(jpgrooming_caraSearchField.getValue()!==null){jpgrooming_cara_search=jpgrooming_caraSearchField.getValue();}
		if(jpgrooming_keteranganSearchField.getValue()!==null){jpgrooming_keterangan_search=jpgrooming_keteranganSearchField.getValue();}
		// change the store parameters
		master_jpgrooming_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jpgrooming_id	:	jpgrooming_id_search, 
			jpgrooming_nobukti	:	jpgrooming_nobukti_search, 
			jpgrooming_karyawan	:	jpgrooming_karyawan_search, 
			jpgrooming_tanggal	:	jpgrooming_tanggal_search_date, 
			jpgrooming_diskon	:	jpgrooming_diskon_search, 
			jpgrooming_cara	:	jpgrooming_cara_search, 
			jpgrooming_keterangan	:	jpgrooming_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		master_jpgrooming_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_jpgrooming_reset_search(){
		// reset the store parameters
		master_jpgrooming_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_jpgrooming_DataStore.reload({params: {start: 0, limit: pageS}});
		master_jpgrooming_searchWindow.close();
	};
	/* End of Fuction */

	function master_jpgrooming_reset_searchForm(){
		jpgrooming_nobuktiSearchField.reset();
		jpgrooming_karyawanSearchField.reset();
		jpgrooming_tanggalSearchField.reset();
		jpgrooming_diskonSearchField.reset();
		jpgrooming_caraSearchField.reset();
		jpgrooming_keteranganSearchField.reset();
	}
	
	/* Field for search */
	/* Identify  jpgrooming_id Search Field */
	jpgrooming_idSearchField= new Ext.form.NumberField({
		id: 'jpgrooming_idSearchField',
		fieldLabel: 'Jproduk Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jpgrooming_nobukti Search Field */
	jpgrooming_nobuktiSearchField= new Ext.form.TextField({
		id: 'jpgrooming_nobuktiSearchField',
		fieldLabel: 'No. Faktur',
		maxLength: 30
	//	anchor: '95%'
	
	});
	/* Identify  jpgrooming_cust Search Field */
	jpgrooming_karyawanSearchField= new Ext.form.TextField({
		id: 'jpgrooming_karyawanSearchField',
		fieldLabel: 'Karyawan',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  jpgrooming_tanggal Search Field */
	jpgrooming_tanggalSearchField= new Ext.form.DateField({
		id: 'jpgrooming_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y',
	
	});
	/* Identify  jpgrooming_diskon Search Field */
	jpgrooming_diskonSearchField= new Ext.form.NumberField({
		id: 'jpgrooming_diskonSearchField',
		fieldLabel: 'Diskon',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jpgrooming_cara Search Field */
	jpgrooming_caraSearchField= new Ext.form.ComboBox({
		id: 'jpgrooming_caraSearchField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jpgrooming_cara'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jpgrooming_cara',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jpgrooming_keterangan Search Field */
	jpgrooming_keteranganSearchField= new Ext.form.TextArea({
		id: 'jpgrooming_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_jpgrooming_searchForm = new Ext.FormPanel({
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
				items: [jpgrooming_nobuktiSearchField, jpgrooming_karyawanSearchField, jpgrooming_tanggalSearchField, jpgrooming_diskonSearchField, jpgrooming_caraSearchField, jpgrooming_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_jpgrooming_list_search
			},{
				text: 'Close',
				handler: function(){
					master_jpgrooming_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_jpgrooming_searchWindow = new Ext.Window({
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
		renderTo: 'elwindow_master_jpgrooming_search',
		items: master_jpgrooming_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_jpgrooming_searchWindow.isVisible()){
			master_jpgrooming_reset_searchForm();
			master_jpgrooming_searchWindow.show();
		} else {
			master_jpgrooming_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_jpgrooming_print(){
		var searchquery = "";
		var jpgrooming_nobukti_print=null;
		var jpgrooming_karyawan_print=null;
		var jpgrooming_tanggal_print_date="";
		var jpgrooming_diskon_print=null;
		var jpgrooming_cara_print=null;
		var jpgrooming_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_jpgrooming_DataStore.baseParams.query!==null){searchquery = master_jpgrooming_DataStore.baseParams.query;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_nobukti!==null){jpgrooming_nobukti_print = master_jpgrooming_DataStore.baseParams.jpgrooming_nobukti;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_karyawan!==null){jpgrooming_karyawan_print = master_jpgrooming_DataStore.baseParams.jpgrooming_karyawan;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_tanggal!==""){jpgrooming_tanggal_print_date = master_jpgrooming_DataStore.baseParams.jpgrooming_tanggal;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_diskon!==null){jpgrooming_diskon_print = master_jpgrooming_DataStore.baseParams.jpgrooming_diskon;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_cara!==null){jpgrooming_cara_print = master_jpgrooming_DataStore.baseParams.jpgrooming_cara;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_keterangan!==null){jpgrooming_keterangan_print = master_jpgrooming_DataStore.baseParams.jpgrooming_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_master_jualproduk_grooming&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jpgrooming_nobukti : jpgrooming_nobukti_print,
			jpgrooming_karyawan : jpgrooming_karyawan_print,
		  	jpgrooming_tanggal : jpgrooming_tanggal_print_date, 
			jpgrooming_diskon : jpgrooming_diskon_print,
			jpgrooming_cara : jpgrooming_cara_print,
			jpgrooming_keterangan : jpgrooming_keterangan_print,
		  	currentlisting: master_jpgrooming_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_jual_produklist.html','master_jual_produklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
				
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
	function master_jpgrooming_export_excel(){
		var searchquery = "";
		var jpgrooming_nobukti_2excel=null;
		var jpgrooming_karyawan_2excel=null;
		var jpgrooming_tanggal_2excel_date="";
		var jpgrooming_diskon_2excel=null;
		var jpgrooming_cara_2excel=null;
		var jpgrooming_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_jpgrooming_DataStore.baseParams.query!==null){searchquery = master_jpgrooming_DataStore.baseParams.query;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_nobukti!==null){jpgrooming_nobukti_2excel = master_jpgrooming_DataStore.baseParams.jpgrooming_nobukti;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_karyawan!==null){jpgrooming_karyawan_2excel = master_jpgrooming_DataStore.baseParams.jpgrooming_karyawan;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_tanggal!==""){jpgrooming_tanggal_2excel_date = master_jpgrooming_DataStore.baseParams.jpgrooming_tanggal;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_diskon!==null){jpgrooming_diskon_2excel = master_jpgrooming_DataStore.baseParams.jpgrooming_diskon;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_cara!==null){jpgrooming_cara_2excel = master_jpgrooming_DataStore.baseParams.jpgrooming_cara;}
		if(master_jpgrooming_DataStore.baseParams.jpgrooming_keterangan!==null){jpgrooming_keterangan_2excel = master_jpgrooming_DataStore.baseParams.jpgrooming_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_master_jualproduk_grooming&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jpgrooming_nobukti : jpgrooming_nobukti_2excel,
			jpgrooming_karyawan : jpgrooming_karyawan_2excel,
		  	jpgrooming_tanggal : jpgrooming_tanggal_2excel_date, 
			jpgrooming_diskon : jpgrooming_diskon_2excel,
			jpgrooming_cara : jpgrooming_cara_2excel,
			jpgrooming_keterangan : jpgrooming_keterangan_2excel,
		  	currentlisting: master_jpgrooming_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	function pertamax(){
		post2db="CREATE";
		jpgrooming_tanggalField.setValue(dt.format('Y-m-d'));
		master_jpgrooming_createForm.render();
		jpgrooming_caraField.setValue('card');
		master_jpgrooming_cardGroup.setVisible(true);
	}
	pertamax();
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_jpgrooming_SelectedRow"></div>
         <div id="fp_detail_jualproduk_grooming"></div>
		<div id="elwindow_master_jpgrooming_create"></div>
        <div id="elwindow_master_jpgrooming_search"></div>
        <div id="form_produkgrooming_addEdit"></div>
    </div>
</div>
</body>