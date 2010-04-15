<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_rawat View
	+ Description	: For record view
	+ Filename 		: v_master_jual_rawat.php
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
var master_jual_rawat_DataStore;
var kwitansi_jual_rawat_DataStore;
var card_jual_rawat_DataStore;
var cek_jual_rawat_DataStore;
var transfer_jual_rawat_DataStore;
//
var master_jual_rawat_ColumnModel;
var master_jual_rawatListEditorGrid;
var master_jual_rawat_createForm;
var master_jual_rawat_createWindow;
var master_jual_rawat_searchForm;
var master_jual_rawat_searchWindow;
var master_jual_rawat_SelectedRow;
var master_jual_rawat_ContextMenu;
//for detail data
var detail_jual_rawat_DataStore;
var detail_jual_rawatListEditorGrid;
var detail_jual_rawat_ColumnModel;
var detail_jual_rawat_proxy;
var detail_jual_rawat_writer;
var detail_jual_rawat_reader;
var editor_detail_jual_rawat;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var jrawat_idField;
var jrawat_nobuktiField;
var jrawat_custField;
var jrawat_tanggalField;
var jrawat_diskonField;
var jrawat_bayarField;
var jrawat_caraField;
var jrawat_cara2Field;
var jrawat_cara3Field;
var jrawat_keteranganField;
//tunai
var jrawat_tunai_nilaiField;
//tunai-2
var jrawat_tunai_nilai2Field;
//tunai-3
var jrawat_tunai_nilai3Field;
//voucher
var jrawat_voucher_noField;
var jrawat_voucher_cashbackField;
//voucher-2
var jrawat_voucher_no2Field;
var jrawat_voucher_cashback2Field;
//voucher-3
var jrawat_voucher_no3Field;
var jrawat_voucher_cashback3Field;

var jrawat_cashbackField;
var is_member=false;
//kwitansi
var jrawat_kwitansi_namaField;
var jrawat_kwitansi_nilaiField;
var jrawat_kwitansi_noField;
//kwitansi-2
var jrawat_kwitansi_nama2Field;
var jrawat_kwitansi_nilai2Field;
var jrawat_kwitansi_no2Field;
//kwitansi-3
var jrawat_kwitansi_nama3Field;
var jrawat_kwitansi_nilai3Field;
var jrawat_kwitansi_no3Field;

//card
var jrawat_card_namaField;
var jrawat_card_edcField;
var jrawat_card_noField;
var jrawat_card_nilaiField;
//card-2
var jrawat_card_nama2Field;
var jrawat_card_edc2Field;
var jrawat_card_no2Field;
var jrawat_card_nilai2Field;
//card-3
var jrawat_card_nama3Field;
var jrawat_card_edc3Field;
var jrawat_card_no3Field;
var jrawat_card_nilai3Field;

//cek
var jrawat_cek_namaField;
var jrawat_cek_noField;
var jrawat_cek_validField;
var jrawat_cek_bankField;
var jrawat_cek_nilaiField;
//cek-2
var jrawat_cek_nama2Field;
var jrawat_cek_no2Field;
var jrawat_cek_valid2Field;
var jrawat_cek_bank2Field;
var jrawat_cek_nilai2Field;
//cek-3
var jrawat_cek_nama3Field;
var jrawat_cek_no3Field;
var jrawat_cek_valid3Field;
var jrawat_cek_bank3Field;
var jrawat_cek_nilai3Field;

//transfer
var jrawat_transfer_bankField;
var jrawat_transfer_namaField;
var jrawat_transfer_nilaiField;
//transfer-2
var jrawat_transfer_bank2Field;
var jrawat_transfer_nama2Field;
var jrawat_transfer_nilai2Field;
//transfer-3
var jrawat_transfer_bank3Field;
var jrawat_transfer_nama3Field;
var jrawat_transfer_nilai3Field;

var jrawat_idSearchField;
var jrawat_nobuktiSearchField;
var jrawat_custSearchField;
var jrawat_diskonSearchField;
var jrawat_caraSearchField;
var jrawat_keteranganSearchField;
var dt= new Date();

var cetak_jrawat=0;

function jrawat_cetak(){
	Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_jual_rawat&m=print_paper',
		params: { jrawat_id : jrawat_idField.getValue()	}, 
		success: function(response){              
			var result=eval(response.responseText);
			switch(result){
			case 1:
				win = window.open('./jrawat_paper.html','Cetak Penjualan Perawatan','height=480,width=1240,resizable=1,scrollbars=0, menubar=0');
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
  		//jrawat_bankDataStore.load();
  		//cbo_drawat_rawatDataStore.load();
  	    return function(value){
  	        var record = combo.findRecord(combo.valueField, value);
  	        return record ? record.get(combo.displayField) : combo.valueNotFoundText;
  	    }
  	}
  
  	/* Function for Saving inLine Editing */
	function master_jual_rawat_update(oGrid_event){
		var jrawat_id_update_pk="";
		var jrawat_nobukti_update=null;
		var jrawat_cust_update=null;
		var jrawat_tanggal_update_date="";
		var jrawat_diskon_update=null;
		var jrawat_cara_update=null;
		var jrawat_keterangan_update=null;
		var jrawat_statdok_update=null;

		jrawat_id_update_pk = oGrid_event.record.data.jrawat_id;
		if(oGrid_event.record.data.jrawat_nobukti!== null){jrawat_nobukti_update = oGrid_event.record.data.jrawat_nobukti;}
		if(oGrid_event.record.data.jrawat_cust!== null){jrawat_cust_update = oGrid_event.record.data.jrawat_cust;}
	 	if(oGrid_event.record.data.jrawat_tanggal!== ""){jrawat_tanggal_update_date =oGrid_event.record.data.jrawat_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jrawat_diskon!== null){jrawat_diskon_update = oGrid_event.record.data.jrawat_diskon;}
		if(oGrid_event.record.data.jrawat_cara!== null){jrawat_cara_update = oGrid_event.record.data.jrawat_cara;}
		if(oGrid_event.record.data.jrawat_keterangan!== null){jrawat_keterangan_update = oGrid_event.record.data.jrawat_keterangan;}
		if(oGrid_event.record.data.jrawat_stat_dok!== null){jrawat_statdok_update = oGrid_event.record.data.jrawat_stat_dok;}

		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jual_rawat&m=get_action',
			params: {
				task: "UPDATE",
				jrawat_id	: jrawat_id_update_pk, 
				jrawat_nobukti	:jrawat_nobukti_update,  
				jrawat_cust	:jrawat_cust_update,  
				jrawat_tanggal	: jrawat_tanggal_update_date, 
				jrawat_diskon	:jrawat_diskon_update,  
				jrawat_cara	:jrawat_cara_update,  
				jrawat_keterangan	:jrawat_keterangan_update, 
				jrawat_stat_dok		:jrawat_statdok_update,
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_jual_rawat_DataStore.commitChanges();
						master_jual_rawat_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
//						   msg: 'We could\'t not save the master_jual_rawat.',
						   msg: 'Data Penjualan Perawatan tidak bisa disimpan',
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
	function master_jual_rawat_create(){
	
		if(is_master_jual_rawat_form_valid()){	
		var jrawat_id_create_pk=null; 
		var jrawat_nobukti_create=null; 
		var jrawat_cust_create=null; 
		var jrawat_tanggal_create_date=""; 
		var jrawat_diskon_create=null; 
		var jrawat_cara_create=null; 
		var jrawat_cara2_create=null; 
		var jrawat_cara3_create=null; 
		var jrawat_keterangan_create=null; 
		var jrawat_statdok_create=null;
		//tunai
		var jrawat_tunai_nilai_create=null;
		//tunai-2
		var jrawat_tunai_nilai2_create=null;
		//tunai-3
		var jrawat_tunai_nilai3_create=null;
		//voucher
		var jrawat_voucher_no_create=null;
		var jrawat_voucher_cashback_create=null;
		//voucher-2
		var jrawat_voucher_no2_create=null;
		var jrawat_voucher_cashback2_create=null;
		//voucher-3
		var jrawat_voucher_no3_create=null;
		var jrawat_voucher_cashback3_create=null;
		
		var jrawat_cashback_create=null;
		//bayar
		var jrawat_subtotal_create=null;
		var jrawat_total_create=null;
		var jrawat_bayar_create=null;
		var jrawat_hutang_create=null;
		//kwitansi
		var jrawat_kwitansi_nama_create=null;
		var jrawat_kwitansi_nomor_create=null;
		var jrawat_kwitansi_nilai_create=null;
		//kwitansi-2
		var jrawat_kwitansi_nama2_create=null;
		var jrawat_kwitansi_nomor2_create=null;
		var jrawat_kwitansi_nilai2_create=null;
		//kwitansi-3
		var jrawat_kwitansi_nama3_create=null;
		var jrawat_kwitansi_nomor3_create=null;
		var jrawat_kwitansi_nilai3_create=null;
		//card
		var jrawat_card_nama_create=null;
		var jrawat_card_edc_create=null;
		var jrawat_card_no_create=null;
		var jrawat_card_nilai_create=null;
		//card-2
		var jrawat_card_nama2_create=null;
		var jrawat_card_edc2_create=null;
		var jrawat_card_no2_create=null;
		var jrawat_card_nilai2_create=null;
		//card-3
		var jrawat_card_nama3_create=null;
		var jrawat_card_edc3_create=null;
		var jrawat_card_no3_create=null;
		var jrawat_card_nilai3_create=null;
		//cek
		var jrawat_cek_nama_create=null;
		var jrawat_cek_nomor_create=null;
		var jrawat_cek_valid_create="";
		var jrawat_cek_bank_create=null;
		var jrawat_cek_nilai_create=null;
		//cek-2
		var jrawat_cek_nama2_create=null;
		var jrawat_cek_nomor2_create=null;
		var jrawat_cek_valid2_create="";
		var jrawat_cek_bank2_create=null;
		var jrawat_cek_nilai2_create=null;
		//cek-3
		var jrawat_cek_nama3_create=null;
		var jrawat_cek_nomor3_create=null;
		var jrawat_cek_valid3_create="";
		var jrawat_cek_bank3_create=null;
		var jrawat_cek_nilai3_create=null;
		//transfer
		var jrawat_transfer_bank_create=null;
		var jrawat_transfer_nama_create=null;
		var jrawat_transfer_nilai_create=null;
		//transfer-2
		var jrawat_transfer_bank2_create=null;
		var jrawat_transfer_nama2_create=null;
		var jrawat_transfer_nilai2_create=null;
		//transfer-3
		var jrawat_transfer_bank3_create=null;
		var jrawat_transfer_nama3_create=null;
		var jrawat_transfer_nilai3_create=null;
		
		if(jrawat_idField.getValue()!== null){jrawat_id_create_pk = jrawat_idField.getValue();}else{jrawat_id_create_pk=get_pk_id();} 
		if(jrawat_nobuktiField.getValue()!== null){jrawat_nobukti_create = jrawat_nobuktiField.getValue();} 
		if(jrawat_custField.getValue()!== null){jrawat_cust_create = jrawat_custField.getValue();} 
		if(jrawat_tanggalField.getValue()!== ""){jrawat_tanggal_create_date = jrawat_tanggalField.getValue().format('Y-m-d');} 
		if(jrawat_diskonField.getValue()!== null){jrawat_diskon_create = jrawat_diskonField.getValue();} 
		if(jrawat_caraField.getValue()!== null){jrawat_cara_create = jrawat_caraField.getValue();} 
		if(jrawat_cara2Field.getValue()!== null){jrawat_cara2_create = jrawat_cara2Field.getValue();} 
		if(jrawat_cara3Field.getValue()!== null){jrawat_cara3_create = jrawat_cara3Field.getValue();} 
		if(jrawat_keteranganField.getValue()!== null){jrawat_keterangan_create = jrawat_keteranganField.getValue();} 
		if(jrawat_stat_dokField.getValue()!== null){jrawat_statdok_create = jrawat_stat_dokField.getValue();} 
		//tunai
		if(jrawat_tunai_nilaiField.getValue()!== null){jrawat_tunai_nilai_create = jrawat_tunai_nilaiField.getValue();}
		//tunai-2
		if(jrawat_tunai_nilai2Field.getValue()!== null){jrawat_tunai_nilai2_create = jrawat_tunai_nilai2Field.getValue();}
		//tunai-3
		if(jrawat_tunai_nilai3Field.getValue()!== null){jrawat_tunai_nilai3_create = jrawat_tunai_nilai3Field.getValue();}
		//voucher
		if(jrawat_voucher_noField.getValue()!== null){jrawat_voucher_no_create = jrawat_voucher_noField.getValue();} 
		if(jrawat_voucher_cashbackField.getValue()!== null){jrawat_voucher_cashback_create = jrawat_voucher_cashbackField.getValue();} 
		//voucher-2
		if(jrawat_voucher_no2Field.getValue()!== null){jrawat_voucher_no2_create = jrawat_voucher_no2Field.getValue();} 
		if(jrawat_voucher_cashback2Field.getValue()!== null){jrawat_voucher_cashback2_create = jrawat_voucher_cashback2Field.getValue();} 
		//voucher-3
		if(jrawat_voucher_no3Field.getValue()!== null){jrawat_voucher_no3_create = jrawat_voucher_no3Field.getValue();} 
		if(jrawat_voucher_cashback3Field.getValue()!== null){jrawat_voucher_cashback3_create = jrawat_voucher_cashback3Field.getValue();} 
		
		if(jrawat_cashbackField.getValue()!== null){jrawat_cashback_create = jrawat_cashbackField.getValue();} 
		//bayar
		if(jrawat_totalField.getValue()!== null){jrawat_total_create = jrawat_totalField.getValue();}
		if(jrawat_bayarField.getValue()!== null){jrawat_bayar_create = jrawat_bayarField.getValue();}
		if(jrawat_subTotalField.getValue()!== null){jrawat_subtotal_create = jrawat_subTotalField.getValue();} 
		if(jrawat_hutangField.getValue()!== null){jrawat_hutang_create = jrawat_hutangField.getValue();} 
		//kwitansi value
		if(jrawat_kwitansi_noField.getValue()!== null){jrawat_kwitansi_nomor_create = jrawat_kwitansi_noField.getValue();} 
		if(jrawat_kwitansi_namaField.getValue()!== null){jrawat_kwitansi_nama_create = jrawat_kwitansi_namaField.getValue();} 
		if(jrawat_kwitansi_nilaiField.getValue()!== null){jrawat_kwitansi_nilai_create = jrawat_kwitansi_nilaiField.getValue();} 
		//kwitansi-2 value
		if(jrawat_kwitansi_no2Field.getValue()!== null){jrawat_kwitansi_nomor2_create = jrawat_kwitansi_no2Field.getValue();} 
		if(jrawat_kwitansi_nama2Field.getValue()!== null){jrawat_kwitansi_nama2_create = jrawat_kwitansi_nama2Field.getValue();} 
		if(jrawat_kwitansi_nilai2Field.getValue()!== null){jrawat_kwitansi_nilai2_create = jrawat_kwitansi_nilai2Field.getValue();} 
		//kwitansi-3 value
		if(jrawat_kwitansi_no3Field.getValue()!== null){jrawat_kwitansi_nomor3_create = jrawat_kwitansi_no3Field.getValue();} 
		if(jrawat_kwitansi_nama3Field.getValue()!== null){jrawat_kwitansi_nama3_create = jrawat_kwitansi_nama3Field.getValue();} 
		if(jrawat_kwitansi_nilai3Field.getValue()!== null){jrawat_kwitansi_nilai3_create = jrawat_kwitansi_nilai3Field.getValue();} 
		//card value
		if(jrawat_card_namaField.getValue()!== null){jrawat_card_nama_create = jrawat_card_namaField.getValue();} 
		if(jrawat_card_edcField.getValue()!==null){jrawat_card_edc_create = jrawat_card_edcField.getValue();} 
		if(jrawat_card_noField.getValue()!==null){jrawat_card_no_create = jrawat_card_noField.getValue();}
		if(jrawat_card_nilaiField.getValue()!==null){jrawat_card_nilai_create = jrawat_card_nilaiField.getValue();} 
		//card-2 value
		if(jrawat_card_nama2Field.getValue()!== null){jrawat_card_nama2_create = jrawat_card_nama2Field.getValue();} 
		if(jrawat_card_edc2Field.getValue()!==null){jrawat_card_edc2_create = jrawat_card_edc2Field.getValue();} 
		if(jrawat_card_no2Field.getValue()!==null){jrawat_card_no2_create = jrawat_card_no2Field.getValue();}
		if(jrawat_card_nilai2Field.getValue()!==null){jrawat_card_nilai2_create = jrawat_card_nilai2Field.getValue();} 
		//card-3 value
		if(jrawat_card_nama3Field.getValue()!== null){jrawat_card_nama3_create = jrawat_card_nama3Field.getValue();} 
		if(jrawat_card_edc3Field.getValue()!==null){jrawat_card_edc3_create = jrawat_card_edc3Field.getValue();} 
		if(jrawat_card_no3Field.getValue()!==null){jrawat_card_no3_create = jrawat_card_no3Field.getValue();}
		if(jrawat_card_nilai3Field.getValue()!==null){jrawat_card_nilai3_create = jrawat_card_nilai3Field.getValue();} 
		//cek value
		if(jrawat_cek_namaField.getValue()!== null){jrawat_cek_nama_create = jrawat_cek_namaField.getValue();} 
		if(jrawat_cek_noField.getValue()!== null){jrawat_cek_nomor_create = jrawat_cek_noField.getValue();} 
		if(jrawat_cek_validField.getValue()!== ""){jrawat_cek_valid_create = jrawat_cek_validField.getValue().format('Y-m-d');} 
		if(jrawat_cek_bankField.getValue()!== null){jrawat_cek_bank_create = jrawat_cek_bankField.getValue();} 
		if(jrawat_cek_nilaiField.getValue()!== null){jrawat_cek_nilai_create = jrawat_cek_nilaiField.getValue();} 
		//cek-2 value
		if(jrawat_cek_nama2Field.getValue()!== null){jrawat_cek_nama2_create = jrawat_cek_nama2Field.getValue();} 
		if(jrawat_cek_no2Field.getValue()!== null){jrawat_cek_nomor2_create = jrawat_cek_no2Field.getValue();} 
		if(jrawat_cek_valid2Field.getValue()!== ""){jrawat_cek_valid2_create = jrawat_cek_valid2Field.getValue().format('Y-m-d');} 
		if(jrawat_cek_bank2Field.getValue()!== null){jrawat_cek_bank2_create = jrawat_cek_bank2Field.getValue();} 
		if(jrawat_cek_nilai2Field.getValue()!== null){jrawat_cek_nilai2_create = jrawat_cek_nilai2Field.getValue();} 
		//cek-3 value
		if(jrawat_cek_nama3Field.getValue()!== null){jrawat_cek_nama3_create = jrawat_cek_nama3Field.getValue();} 
		if(jrawat_cek_no3Field.getValue()!== null){jrawat_cek_nomor3_create = jrawat_cek_no3Field.getValue();} 
		if(jrawat_cek_valid3Field.getValue()!== ""){jrawat_cek_valid3_create = jrawat_cek_valid3Field.getValue().format('Y-m-d');} 
		if(jrawat_cek_bank3Field.getValue()!== null){jrawat_cek_bank3_create = jrawat_cek_bank3Field.getValue();} 
		if(jrawat_cek_nilai3Field.getValue()!== null){jrawat_cek_nilai3_create = jrawat_cek_nilai3Field.getValue();} 
		//transfer value
		if(jrawat_transfer_bankField.getValue()!== null){jrawat_transfer_bank_create = jrawat_transfer_bankField.getValue();} 
		if(jrawat_transfer_namaField.getValue()!== null){jrawat_transfer_nama_create = jrawat_transfer_namaField.getValue();}
		if(jrawat_transfer_nilaiField.getValue()!== null){jrawat_transfer_nilai_create = jrawat_transfer_nilaiField.getValue();} 
		//transfer-2 value
		if(jrawat_transfer_bank2Field.getValue()!== null){jrawat_transfer_bank2_create = jrawat_transfer_bank2Field.getValue();} 
		if(jrawat_transfer_nama2Field.getValue()!== null){jrawat_transfer_nama2_create = jrawat_transfer_nama2Field.getValue();}
		if(jrawat_transfer_nilai2Field.getValue()!== null){jrawat_transfer_nilai2_create = jrawat_transfer_nilai2Field.getValue();} 
		//transfer-3 value
		if(jrawat_transfer_bank3Field.getValue()!== null){jrawat_transfer_bank3_create = jrawat_transfer_bank3Field.getValue();} 
		if(jrawat_transfer_nama3Field.getValue()!== null){jrawat_transfer_nama3_create = jrawat_transfer_nama3Field.getValue();}
		if(jrawat_transfer_nilai3Field.getValue()!== null){jrawat_transfer_nilai3_create = jrawat_transfer_nilai3Field.getValue();} 
		
		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jual_rawat&m=get_action',
			params: {
				task: post2db,
				cetak_jrawat:cetak_jrawat,
				jrawat_id			: 	jrawat_id_create_pk, 
				jrawat_nobukti		: 	jrawat_nobukti_create, 
				jrawat_cust		: 	jrawat_cust_create, 
				jrawat_tanggal		: 	jrawat_tanggal_create_date, 
				jrawat_diskon		: 	jrawat_diskon_create, 
				jrawat_cara		: 	jrawat_cara_create, 
				jrawat_cara2		: 	jrawat_cara2_create, 
				jrawat_cara3		: 	jrawat_cara3_create, 
				jrawat_keterangan	: 	jrawat_keterangan_create,
				jrawat_stat_dok		:	jrawat_statdok_create,
				jrawat_cashback	: 	jrawat_cashback_create,
				//tunai
				jrawat_tunai_nilai	:	jrawat_tunai_nilai_create,
				//tunai-2
				jrawat_tunai_nilai2	:	jrawat_tunai_nilai2_create,
				//tunai-3
				jrawat_tunai_nilai3	:	jrawat_tunai_nilai3_create,
				//voucher
				jrawat_voucher_no	:	jrawat_voucher_no_create,
				jrawat_voucher_cashback	:	jrawat_voucher_cashback_create,
				//voucher-2
				jrawat_voucher_no2	:	jrawat_voucher_no2_create,
				jrawat_voucher_cashback2	:	jrawat_voucher_cashback2_create,
				//voucher-3
				jrawat_voucher_no3	:	jrawat_voucher_no3_create,
				jrawat_voucher_cashback3	:	jrawat_voucher_cashback3_create,
				
				jrawat_voucher_cashback	:	jrawat_voucher_cashback_create,
				//bayar
				jrawat_total			: 	jrawat_total_create,
				jrawat_bayar			: 	jrawat_bayar_create,
				jrawat_subtotal			: 	jrawat_subtotal_create,
				jrawat_hutang		: 	jrawat_hutang_create,
				//kwitansi posting
				jrawat_kwitansi_no		:	jrawat_kwitansi_nomor_create,
				jrawat_kwitansi_nama		:	jrawat_kwitansi_nama_create,
				jrawat_kwitansi_nilai		:	jrawat_kwitansi_nilai_create,
				//kwitansi-2 posting
				jrawat_kwitansi_no2		:	jrawat_kwitansi_nomor2_create,
				jrawat_kwitansi_nama2		:	jrawat_kwitansi_nama2_create,
				jrawat_kwitansi_nilai2		:	jrawat_kwitansi_nilai2_create,
				//kwitansi-3 posting
				jrawat_kwitansi_no3		:	jrawat_kwitansi_nomor3_create,
				jrawat_kwitansi_nama3		:	jrawat_kwitansi_nama3_create,
				jrawat_kwitansi_nilai3		:	jrawat_kwitansi_nilai3_create,
				//card posting
				jrawat_card_nama	: 	jrawat_card_nama_create,
				jrawat_card_edc	:	jrawat_card_edc_create,
				jrawat_card_no		:	jrawat_card_no_create,
				jrawat_card_nilai	:	jrawat_card_nilai_create,
				//card-2 posting
				jrawat_card_nama2	: 	jrawat_card_nama2_create,
				jrawat_card_edc2	:	jrawat_card_edc2_create,
				jrawat_card_no2	:	jrawat_card_no2_create,
				jrawat_card_nilai2	:	jrawat_card_nilai2_create,
				//card-3 posting
				jrawat_card_nama3	: 	jrawat_card_nama3_create,
				jrawat_card_edc3	:	jrawat_card_edc3_create,
				jrawat_card_no3	:	jrawat_card_no3_create,
				jrawat_card_nilai3	:	jrawat_card_nilai3_create,
				//cek posting
				jrawat_cek_nama	: 	jrawat_cek_nama_create,
				jrawat_cek_no		:	jrawat_cek_nomor_create,
				jrawat_cek_valid	: 	jrawat_cek_valid_create,
				jrawat_cek_bank	:	jrawat_cek_bank_create,
				jrawat_cek_nilai	:	jrawat_cek_nilai_create,
				//cek-2 posting
				jrawat_cek_nama2	: 	jrawat_cek_nama2_create,
				jrawat_cek_no2		:	jrawat_cek_nomor2_create,
				jrawat_cek_valid2	: 	jrawat_cek_valid2_create,
				jrawat_cek_bank2	:	jrawat_cek_bank2_create,
				jrawat_cek_nilai2	:	jrawat_cek_nilai2_create,
				//cek-3 posting
				jrawat_cek_nama3	: 	jrawat_cek_nama3_create,
				jrawat_cek_no3		:	jrawat_cek_nomor3_create,
				jrawat_cek_valid3	: 	jrawat_cek_valid3_create,
				jrawat_cek_bank3	:	jrawat_cek_bank3_create,
				jrawat_cek_nilai3	:	jrawat_cek_nilai3_create,
				//transfer posting
				jrawat_transfer_bank	:	jrawat_transfer_bank_create,
				jrawat_transfer_nama	:	jrawat_transfer_nama_create,
				jrawat_transfer_nilai	:	jrawat_transfer_nilai_create,
				//transfer-2 posting
				jrawat_transfer_bank2	:	jrawat_transfer_bank2_create,
				jrawat_transfer_nama2	:	jrawat_transfer_nama2_create,
				jrawat_transfer_nilai2	:	jrawat_transfer_nilai2_create,
				//transfer-3 posting
				jrawat_transfer_bank3	:	jrawat_transfer_bank3_create,
				jrawat_transfer_nama3	:	jrawat_transfer_nama3_create,
				jrawat_transfer_nilai3	:	jrawat_transfer_nilai3_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						//detail_jual_rawat_purge();
						//detail_jual_rawat_insert();
						//Ext.MessageBox.alert(post2db+' OK','The Master_jual_rawat was '+msg+' successfully.');
						//Ext.MessageBox.alert(post2db+' OK','Data penjualan perawatan berhasil disimpan');
						if(cetak_jrawat==1){
							jrawat_cetak();
						}
						master_jual_rawat_DataStore.reload();
						detail_jual_rawat_DataStore.load({params: {master_id:0}});
						master_jual_rawat_createWindow.hide();
						break;
					case 0:
						Ext.MessageBox.show({
						   title: 'Warning',
//						   msg: 'We could\'t not '+msg+' the Master_jual_rawat.',
						   msg: 'Data Penjualan Perawatan tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   //msg: 'We could\'t not '+msg+' the Master_jual_produk.',
						   msg: 'Data penjualan perawatan tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
					/*default:
						jrawat_idField.setValue(result);
						jrawat_cetak();
						master_jual_rawat_createWindow.hide();
						break;*/
				}
				master_jual_rawat_reset_allForm();
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
			Ext.MessageBox.show({
				title: 'Warning',
//				msg: 'Your Form is not valid!.',
				msg: 'Form Anda belum lengkap',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
 	/* End of Function */
	
	function save_andPrint(){
		cetak_jrawat=1;
		master_jual_rawat_create();
	}
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='UPDATE')
			return master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	// Reset kwitansi option
	function kwitansi_jual_rawat_reset_form(){
		jrawat_kwitansi_namaField.reset();
		jrawat_kwitansi_nilaiField.reset();
		jrawat_kwitansi_nilai_cfField.reset();
		jrawat_kwitansi_noField.reset();
	}
	// Reset kwitansi-2 option
	function kwitansi2_jual_rawat_reset_form(){
		jrawat_kwitansi_nama2Field.reset();
		jrawat_kwitansi_nilai2Field.reset();
		jrawat_kwitansi_nilai2_cfField.reset();
		jrawat_kwitansi_no2Field.reset();
	}
	// Reset kwitansi-3 option
	function kwitansi3_jual_rawat_reset_form(){
		jrawat_kwitansi_nama3Field.reset();
		jrawat_kwitansi_nilai3Field.reset();
		jrawat_kwitansi_nilai3_cfField.reset();
		jrawat_kwitansi_no3Field.reset();
	}
	
	// Reset card option
	function card_jual_rawat_reset_form(){
		jrawat_card_namaField.reset();
		jrawat_card_edcField.reset();
		jrawat_card_noField.reset();
		jrawat_card_nilaiField.reset();
		jrawat_card_nilai_cfField.reset();
	}
	// Reset card-2 option
	function card2_jual_rawat_reset_form(){
		jrawat_card_nama2Field.reset();
		jrawat_card_edc2Field.reset();
		jrawat_card_no2Field.reset();
		jrawat_card_nilai2Field.reset();
		jrawat_card_nilai2_cfField.reset();
	}
	// Reset card-3 option
	function card3_jual_rawat_reset_form(){
		jrawat_card_nama3Field.reset();
		jrawat_card_edc3Field.reset();
		jrawat_card_no3Field.reset();
		jrawat_card_nilai3Field.reset();
		jrawat_card_nilai3_cfField.reset();
	}
	
	// Reset cek option
	function cek_jual_rawat_reset_form(){
		jrawat_cek_namaField.reset();
		jrawat_cek_noField.reset();
		jrawat_cek_validField.reset();
		jrawat_cek_bankField.reset();
		jrawat_cek_nilaiField.reset();
		jrawat_cek_nilai_cfField.reset();
	}
	// Reset cek-2 option
	function cek2_jual_rawat_reset_form(){
		jrawat_cek_nama2Field.reset();
		jrawat_cek_no2Field.reset();
		jrawat_cek_valid2Field.reset();
		jrawat_cek_bank2Field.reset();
		jrawat_cek_nilai2Field.reset();
		jrawat_cek_nilai2_cfField.reset();
	}
	// Reset cek-3 option
	function cek3_jual_rawat_reset_form(){
		jrawat_cek_nama3Field.reset();
		jrawat_cek_no3Field.reset();
		jrawat_cek_valid3Field.reset();
		jrawat_cek_bank3Field.reset();
		jrawat_cek_nilai3Field.reset();
		jrawat_cek_nilai3_cfField.reset();
	}
	
	// Reset transfer option
	function transfer_jual_rawat_reset_form(){
		jrawat_transfer_bankField.reset();
		jrawat_transfer_namaField.reset();
		jrawat_transfer_nilaiField.reset();
		jrawat_transfer_nilai_cfField.reset();
	}
	// Reset transfer-2 option
	function transfer2_jual_rawat_reset_form(){
		jrawat_transfer_bank2Field.reset();
		jrawat_transfer_nama2Field.reset();
		jrawat_transfer_nilai2Field.reset();
		jrawat_transfer_nilai2_cfField.reset();
	}
	// Reset transfer-3 option
	function transfer3_jual_rawat_reset_form(){
		jrawat_transfer_bank3Field.reset();
		jrawat_transfer_nama3Field.reset();
		jrawat_transfer_nilai3Field.reset();
		jrawat_transfer_nilai3_cfField.reset();
	}

	// Reset tunai option
	function tunai_jual_rawat_reset_form(){
		jrawat_tunai_nilaiField.reset();
		jrawat_tunai_nilai_cfField.reset();
	}
	// Reset tunai-2 option
	function tunai2_jual_rawat_reset_form(){
		jrawat_tunai_nilai2Field.reset();
		jrawat_tunai_nilai2_cfField.reset();
	}
	// Reset tunai-3 option
	function tunai3_jual_rawat_reset_form(){
		jrawat_tunai_nilai3Field.reset();
		jrawat_tunai_nilai3_cfField.reset();
	}

	//Reset voucher option
	function voucher_jual_rawat_reset_form(){
		jrawat_voucher_noField.reset();
		jrawat_voucher_cashbackField.reset();
	}
	//Reset voucher-2 option
	function voucher2_jual_rawat_reset_form(){
		jrawat_voucher_no2Field.reset();
		jrawat_voucher_cashback2Field.reset();
	}
	//Reset voucher-3 option
	function voucher3_jual_rawat_reset_form(){
		jrawat_voucher_no3Field.reset();
		jrawat_voucher_cashback3Field.reset();
	}
	
	/* Reset form before loading */
	function master_jual_rawat_reset_form(){
		jrawat_idField.reset();
		jrawat_idField.setValue(null);
		jrawat_nobuktiField.reset();
		jrawat_nobuktiField.setValue(null);
		jrawat_custField.reset();
		jrawat_custField.setValue(null);
		jrawat_tanggalField.setValue(dt.format('Y-m-d'));
		jrawat_diskonField.reset();
		jrawat_diskonField.setValue(null);
		jrawat_caraField.reset();
		jrawat_caraField.setValue(null);
		jrawat_cara2Field.reset();
		jrawat_cara2Field.setValue(null);
		jrawat_cara3Field.reset();
		jrawat_cara3Field.setValue(null);
		
		jrawat_keteranganField.reset();
		jrawat_keteranganField.setValue(null);
		jrawat_stat_dokField.reset();
		jrawat_stat_dokField.setValue('Terbuka');
		
		jrawat_cust_nomemberField.reset();
		jrawat_cust_nomemberField.setValue(null);
		
		jrawat_jumlahField.reset();
		jrawat_jumlahField.setValue(null);
		jrawat_diskonField.reset();
		jrawat_diskonField.setValue(null);
		jrawat_cashbackField.reset();
		jrawat_cashbackField.setValue(null);
		jrawat_cashback_cfField.reset();
		jrawat_cashback_cfField.setValue(null);
		jrawat_subTotalField.reset();
		jrawat_subTotalField.setValue(null);
		jrawat_totalField.reset();
		jrawat_totalField.setValue(null);
		jrawat_bayarField.reset();
		jrawat_bayarField.setValue(null);
		jrawat_hutangField.reset();
		jrawat_hutangField.setValue(null);
		jrawat_pesanLabel.setText("");
		jrawat_lunasLabel.setText("");

		tunai_jual_rawat_reset_form();
		tunai2_jual_rawat_reset_form();
		tunai3_jual_rawat_reset_form();

		kwitansi_jual_rawat_reset_form();
		kwitansi2_jual_rawat_reset_form();
		kwitansi3_jual_rawat_reset_form();

		card_jual_rawat_reset_form();
		card2_jual_rawat_reset_form();
		card3_jual_rawat_reset_form();

		cek_jual_rawat_reset_form();
		cek2_jual_rawat_reset_form();
		cek3_jual_rawat_reset_form();

		transfer_jual_rawat_reset_form();
		transfer2_jual_rawat_reset_form();
		transfer3_jual_rawat_reset_form();

		voucher_jual_rawat_reset_form();
		voucher2_jual_rawat_reset_form();
		voucher3_jual_rawat_reset_form();

		update_group_carabayar_jual_rawat();
		update_group_carabayar2_jual_rawat();
		update_group_carabayar3_jual_rawat();
	}
 	/* End of Function */
	
	function master_jual_rawat_reset_allForm(){
		master_jual_rawat_reset_form();
		
	}
    
	/* setValue to EDIT */
	function master_jual_rawat_set_form(){
		//master_jual_rawat_reset_form();
		var hutang_temp=0;
		
		var subtotal_field=0;
		var drawat_jumlah_field=0;
		var total_field=0;
		var hutang_field=0;
		var diskon_field=0;
		var cashback_field=0;
		
		jrawat_idField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id'));
		jrawat_nobuktiField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_nobukti'));
		jrawat_custField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cust'));
		jrawat_tanggalField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_tanggal'));
		jrawat_diskonField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_diskon'));
		jrawat_cashbackField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cashback'));
		jrawat_cashback_cfField.setValue(CurrencyFormatted(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cashback')));
		if(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cara')==""){
			jrawat_caraField.setValue("card");
		}else{
			jrawat_caraField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cara'));
		}
		jrawat_cara2Field.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cara2'));
		jrawat_cara3Field.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cara3'));
		jrawat_bayarField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_bayar'));
		

		jrawat_keteranganField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_keterangan'));
		jrawat_stat_dokField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_stat_dok'));
		
		for(i=0;i<detail_jual_rawat_DataStore.getCount();i++){
			subtotal_field+=detail_jual_rawat_DataStore.getAt(i).data.drawat_subtotal_net;
			drawat_jumlah_field+=detail_jual_rawat_DataStore.getAt(i).data.drawat_jumlah;
		}
		if(jrawat_diskonField.getValue()!==""){
			diskon_field=jrawat_diskonField.getValue();
		}
		if(jrawat_cashbackField.getValue()!==""){
			cashback_field=jrawat_cashbackField.getValue();
		}
		total_field=subtotal_field*(100-diskon_field)/100-cashback_field;
		
		jrawat_jumlahField.setValue(drawat_jumlah_field);
		jrawat_subTotalField.setValue(subtotal_field);
		jrawat_totalField.setValue(total_field);
		
		//hutang_temp=total_field-jrawat_bayarField.getValue();
		hutang_temp=total_field-master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_bayar');
		jrawat_hutangField.setValue(hutang_temp);
		
		
		load_membership();
		update_group_carabayar_jual_rawat();
		update_group_carabayar2_jual_rawat();
		update_group_carabayar3_jual_rawat();
		
		switch(jrawat_caraField.getValue()){
			case 'kwitansi':
				kwitansi_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_rawat_DataStore.getCount()){
								jrawat_kwitansi_record=kwitansi_jual_rawat_DataStore.getAt(0).data;
								jrawat_kwitansi_noField.setValue(jrawat_kwitansi_record.kwitansi_no);
								jrawat_kwitansi_namaField.setValue(jrawat_kwitansi_record.cust_nama);
								jrawat_kwitansi_nilaiField.setValue(jrawat_kwitansi_record.jkwitansi_nilai);
								jrawat_kwitansi_nilai_cfField.setValue(CurrencyFormatted(jrawat_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							if(card_jual_rawat_DataStore.getCount()){
								jrawat_card_record=card_jual_rawat_DataStore.getAt(0).data;
								jrawat_card_namaField.setValue(jrawat_card_record.jcard_nama);
								jrawat_card_edcField.setValue(jrawat_card_record.jcard_edc);
								jrawat_card_noField.setValue(jrawat_card_record.jcard_no);
								jrawat_card_nilaiField.setValue(jrawat_card_record.jcard_nilai);
								jrawat_card_nilai_cfField.setValue(CurrencyFormatted(jrawat_card_record.jcard_nilai));
							}
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_rawat_DataStore.getCount()){
									jrawat_cek_record=cek_jual_rawat_DataStore.getAt(0).data;
									jrawat_cek_namaField.setValue(jrawat_cek_record.jcek_nama);
									jrawat_cek_noField.setValue(jrawat_cek_record.jcek_no);
									jrawat_cek_validField.setValue(jrawat_cek_record.jcek_valid);
									jrawat_cek_bankField.setValue(jrawat_cek_record.jcek_bank);
									jrawat_cek_nilaiField.setValue(jrawat_cek_record.jcek_nilai);
									jrawat_cek_nilai_cfField.setValue(CurrencyFormatted(jrawat_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;
			case 'transfer' :
				transfer_jual_rawat_DataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(transfer_jual_rawat_DataStore.getCount()){
										jrawat_transfer_record=transfer_jual_rawat_DataStore.getAt(0);
										jrawat_transfer_bankField.setValue(jrawat_transfer_record.data.jtransfer_bank);
										jrawat_transfer_namaField.setValue(jrawat_transfer_record.data.jtransfer_nama);
										jrawat_transfer_nilaiField.setValue(jrawat_transfer_record.data.jtransfer_nilai);
										jrawat_transfer_nilai_cfField.setValue(CurrencyFormatted(jrawat_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_rawat_DataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_rawat_DataStore.getCount()){
										jrawat_tunai_record=tunai_jual_rawat_DataStore.getAt(0);
										jrawat_tunai_nilaiField.setValue(jrawat_tunai_record.data.jtunai_nilai);
										jrawat_tunai_nilai_cfField.setValue(CurrencyFormatted(jrawat_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
			case 'voucher' :
				voucher_jual_rawatDataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(voucher_jual_rawatDataStore.getCount()){
										jrawat_voucher_record=voucher_jual_rawatDataStore.getAt(0);
										jrawat_voucher_noField.setValue(jrawat_voucher_record.data.tvoucher_novoucher);
										jrawat_voucher_cashbackField.setValue(jrawat_voucher_record.data.voucher_cashback);
									}
							}
					 	}
				  });
				break;
		}

		switch(jrawat_cara2Field.getValue()){
			case 'kwitansi':
				kwitansi_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_rawat_DataStore.getCount()){
								jrawat_kwitansi_record=kwitansi_jual_rawat_DataStore.getAt(0).data;
								jrawat_kwitansi_no2Field.setValue(jrawat_kwitansi_record.kwitansi_no);
								jrawat_kwitansi_nama2Field.setValue(jrawat_kwitansi_record.cust_nama);
								jrawat_kwitansi_nilai2Field.setValue(jrawat_kwitansi_record.jkwitansi_nilai);
								jrawat_kwitansi_nilai2_cfField.setValue(CurrencyFormatted(jrawat_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							 if(card_jual_rawat_DataStore.getCount()){
								 jrawat_card_record=card_jual_rawat_DataStore.getAt(0).data;
								 jrawat_card_nama2Field.setValue(jrawat_card_record.jcard_nama);
								 jrawat_card_edc2Field.setValue(jrawat_card_record.jcard_edc);
								 jrawat_card_no2Field.setValue(jrawat_card_record.jcard_no);
								 jrawat_card_nilai2Field.setValue(jrawat_card_record.jcard_nilai);
								 jrawat_card_nilai2_cfField.setValue(CurrencyFormatted(jrawat_card_record.jcard_nilai));
							 }
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_rawat_DataStore.getCount()){
									jrawat_cek_record=cek_jual_rawat_DataStore.getAt(0).data;
									jrawat_cek_nama2Field.setValue(jrawat_cek_record.jcek_nama);
									jrawat_cek_no2Field.setValue(jrawat_cek_record.jcek_no);
									jrawat_cek_valid2Field.setValue(jrawat_cek_record.jcek_valid);
									jrawat_cek_bank2Field.setValue(jrawat_cek_record.jcek_bank);
									jrawat_cek_nilai2Field.setValue(jrawat_cek_record.jcek_nilai);
									jrawat_cek_nilai2_cfField.setValue(CurrencyFormatted(jrawat_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jual_rawat_DataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
								jrawat_transfer_record=transfer_jual_rawat_DataStore.getAt(0);
									if(transfer_jual_rawat_DataStore.getCount()){
										jrawat_transfer_record=transfer_jual_rawat_DataStore.getAt(0);
										jrawat_transfer_bank2Field.setValue(jrawat_transfer_record.data.jtransfer_bank);
										jrawat_transfer_nama2Field.setValue(jrawat_transfer_record.data.jtransfer_nama);
										jrawat_transfer_nilai2Field.setValue(jrawat_transfer_record.data.jtransfer_nilai);
										jrawat_transfer_nilai2_cfField.setValue(CurrencyFormatted(jrawat_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_rawat_DataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_rawat_DataStore.getCount()){
										jrawat_tunai_record=tunai_jual_rawat_DataStore.getAt(0);
										jrawat_tunai_nilai2Field.setValue(jrawat_tunai_record.data.jtunai_nilai);
										jrawat_tunai_nilai2_cfField.setValue(CurrencyFormatted(jrawat_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
			case 'voucher' :
				voucher_jual_rawatDataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_rawat_DataStore.getCount()){
										jrawat_voucher_record=voucher_jual_rawatDataStore.getAt(0);
										jrawat_voucher_no2Field.setValue(jrawat_tunai_record.data.tvoucher_novoucher);
										jrawat_voucher_cashback2Field.setValue(jrawat_tunai_record.data.voucher_cashback);
									}
							}
					 	}
				  });
				break;
		}

		switch(jrawat_cara3Field.getValue()){
			case 'kwitansi':
				kwitansi_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_rawat_DataStore.getCount()){
								jrawat_kwitansi_record=kwitansi_jual_rawat_DataStore.getAt(0).data;
								jrawat_kwitansi_no3Field.setValue(jrawat_kwitansi_record.kwitansi_no);
								jrawat_kwitansi_nama3Field.setValue(jrawat_kwitansi_record.cust_nama);
								jrawat_kwitansi_nilai3Field.setValue(jrawat_kwitansi_record.jkwitansi_nilai);
								jrawat_kwitansi_nilai3_cfField.setValue(CurrencyFormatted(jrawat_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							 if(card_jual_rawat_DataStore.getCount()){
								 jrawat_card_record=card_jual_rawat_DataStore.getAt(0).data;
								 jrawat_card_nama3Field.setValue(jrawat_card_record.jcard_nama);
								 jrawat_card_edc3Field.setValue(jrawat_card_record.jcard_edc);
								 jrawat_card_no3Field.setValue(jrawat_card_record.jcard_no);
								 jrawat_card_nilai3Field.setValue(jrawat_card_record.jcard_nilai);
								 jrawat_card_nilai3_cfField.setValue(CurrencyFormatted(jrawat_card_record.jcard_nilai));
							 }
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_rawat_DataStore.getCount()){
									jrawat_cek_record=cek_jual_rawat_DataStore.getAt(0).data;
									jrawat_cek_nama3Field.setValue(jrawat_cek_record.jcek_nama);
									jrawat_cek_no3Field.setValue(jrawat_cek_record.jcek_no);
									jrawat_cek_valid3Field.setValue(jrawat_cek_record.jcek_valid);
									jrawat_cek_bank3Field.setValue(jrawat_cek_record.jcek_bank);
									jrawat_cek_nilai3Field.setValue(jrawat_cek_record.jcek_nilai);
									jrawat_cek_nilai3_cfField.setValue(CurrencyFormatted(jrawat_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jual_rawat_DataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
								jrawat_transfer_record=transfer_jual_rawat_DataStore.getAt(0);
									if(transfer_jual_rawat_DataStore.getCount()){
										jrawat_transfer_record=transfer_jual_rawat_DataStore.getAt(0);
										jrawat_transfer_bank3Field.setValue(jrawat_transfer_record.data.jtransfer_bank);
										jrawat_transfer_nama3Field.setValue(jrawat_transfer_record.data.jtransfer_nama);
										jrawat_transfer_nilai3Field.setValue(jrawat_transfer_record.data.jtransfer_nilai);
										jrawat_transfer_nilai3_cfField.setValue(CurrencyFormatted(jrawat_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_rawat_DataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_rawat_DataStore.getCount()){
										jrawat_tunai_record=tunai_jual_rawat_DataStore.getAt(0);
										jrawat_tunai_nilai3Field.setValue(jrawat_tunai_record.data.jtunai_nilai);
										jrawat_tunai_nilai3_cfField.setValue(CurrencyFormatted(jrawat_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
			case 'voucher' :
				voucher_jual_rawatDataStore.load({
						params : { no_faktur: jrawat_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_rawat_DataStore.getCount()){
										jrawat_voucher_record=voucher_jual_rawatDataStore.getAt(0);
										jrawat_voucher_no3Field.setValue(jrawat_tunai_record.data.tvoucher_novoucher);
										jrawat_voucher_cashback3Field.setValue(jrawat_tunai_record.data.voucher_cashback);
									}
							}
					 	}
				  });
				break;
		}
		
		//detail_jual_rawat_DataStore.load({params:{master_id: jrawat_idField.getValue()}});
		//detail_jual_rawat_DataStore.load({params : {master_id : master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id'), start:0, limit:pageS},callback:function(opts, success, response){if(success)load_total_rawat_bayar();}});
		//load_total_rawat_bayar();
	}
	/* End setValue to EDIT*/
  
    function load_membership(){
		if(jrawat_custField.getValue()!=''){
			memberDataStore.load({
					params : { member_cust: jrawat_custField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) {
							if(memberDataStore.getCount()){
								jrawat_member_record=memberDataStore.getAt(0).data;
								jrawat_cust_nomemberField.setValue(jrawat_member_record.member_no);
							}
						}
					}
			}); 
		}
	}
	/* Function for Check if the form is valid */
	function is_master_jual_rawat_form_valid(){
		return (true);
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_jual_rawat_createWindow.isVisible()){
			master_jual_rawat_reset_form();
			jrawat_caraField.setValue("card");
			master_jual_rawat_cardGroup.setVisible(true);
			detail_jual_rawat_DataStore.load({params: {master_id:0}});
			detail_ambil_paketDataStore.load({params: {master_id : 0, start:0, limit:pageS}});
			post2db="CREATE";
			msg='created';
			master_cara_bayarTabPanel.setActiveTab(0);
			master_jual_rawat_createWindow.show();
		} else {
			master_jual_rawat_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_jual_rawat_confirm_delete(){
		// only one master_jual_rawat is selected here
		if(master_jual_rawatListEditorGrid.selModel.getCount() == 1){
//			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_jual_rawat_delete);
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_jual_rawat_delete);
		} else if(master_jual_rawatListEditorGrid.selModel.getCount() > 1){
//			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_jual_rawat_delete);
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_jual_rawat_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
//				msg: 'You can\'t really delete something you haven\'t selected?',
				msg: 'Anda belum memilih data yang akan dihapus',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
	/* Function for Update Confirm */
	function master_jual_rawat_confirm_update(){
		master_jual_rawat_reset_form();
		/* only one record is selected here */
		if(master_jual_rawatListEditorGrid.selModel.getCount() == 1) {
			///////cbo_drawat_rawatDataStore.load({params: {query:master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id')}});
			//cbo_perawatanDataStore.load({params: {query:master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id')}});
			cbo_kwitansi_jual_rawat_DataStore.load();
			master_cara_bayarTabPanel.setActiveTab(0);
			post2db='UPDATE';
			//detail_jual_rawat_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			detail_ambil_paketDataStore.load({params: {master_id : master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cust_id'), start:0, limit:pageS}});
			cbo_drawat_rawatDataStore.load({
				params: {query:master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id')},
				callback:function(opts, success, response){
					if(success){
						detail_jual_rawat_DataStore.load({
							params : {master_id : master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id'), start:0, limit:pageS},
							callback:function(opts, success, response){
								if(success){
									master_jual_rawat_set_form();
								}
							}
						});
					}
				}
			});
			/*detail_jual_rawat_DataStore.load({
				params : {master_id : master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id'), start:0, limit:pageS},
				callback:function(opts, success, response){
					if(success){
						master_jual_rawat_set_form();
					}
				}
			});*/
			//master_jual_rawat_set_form();
			msg='updated';
			//master_jual_rawat_createWindow.hide();
			master_jual_rawat_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
//				msg: 'You can\'t really update something you haven\'t selected?',
				msg: 'Anda belum memilih data yang akan diedit',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function master_jual_rawat_delete(btn){
		if(btn=='yes'){
			var selections = master_jual_rawatListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_jual_rawatListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jrawat_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
//				waitMsg: 'Please Wait',
				waitMsg: 'Mohon tunggu..',
				url: 'index.php?c=c_master_jual_rawat&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_jual_rawat_DataStore.reload();
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
	master_jual_rawat_DataStore = new Ext.data.Store({
		id: 'master_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jrawat_nobukti'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jrawat_id', type: 'int', mapping: 'jrawat_id'}, 
			{name: 'jrawat_nobukti', type: 'string', mapping: 'jrawat_nobukti'}, 
			{name: 'jrawat_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'jrawat_cust_id', type: 'int', mapping: 'jrawat_cust'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_member', type: 'string', mapping: 'cust_member'},
			{name: 'jrawat_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jrawat_tanggal'}, 
			{name: 'jrawat_diskon', type: 'int', mapping: 'jrawat_diskon'}, 
			{name: 'jrawat_cashback', type: 'float', mapping: 'jrawat_cashback'},
			{name: 'jrawat_cara', type: 'string', mapping: 'jrawat_cara'}, 
			{name: 'jrawat_cara2', type: 'string', mapping: 'jrawat_cara2'}, 
			{name: 'jrawat_cara3', type: 'string', mapping: 'jrawat_cara3'}, 
			{name: 'jrawat_total', type: 'float', mapping: 'jrawat_totalbiaya'}, 
			{name: 'jrawat_bayar', type: 'float', mapping: 'jrawat_bayar'},
			{name: 'jrawat_keterangan', type: 'string', mapping: 'jrawat_keterangan'},
			{name: 'jrawat_stat_dok', type: 'string', mapping: 'jrawat_stat_dok'}, 				
			{name: 'jrawat_creator', type: 'string', mapping: 'jrawat_creator'}, 
			{name: 'jrawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jrawat_date_create'}, 
			{name: 'jrawat_update', type: 'string', mapping: 'jrawat_update'}, 
			{name: 'jrawat_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jrawat_date_update'}, 
			{name: 'jrawat_revised', type: 'int', mapping: 'jrawat_revised'},
			{name: 'keterangan_paket', type: 'string', mapping: 'keterangan_paket'}
		]),
		sortInfo:{field: 'jrawat_nobukti', direction: "DESC"}
	});
	/* End of Function */
	
	cbo_voucher_jual_rawatDataStore = new Ext.data.Store({
		id: 'cbo_voucher_jual_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_voucher_list', 
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
	
	voucher_jual_rawatDataStore = new Ext.data.Store({
		id: 'voucher_jual_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_voucher_by_ref', 
			method: 'POST'
		}),baseParams: {start:0, limit: 10},
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'tvoucher_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'tvoucher_id', type: 'int', mapping: 'tvoucher_id'},
			{name: 'tvoucher_novoucher', type: 'string', mapping: 'tvoucher_novoucher'},
			{name: 'voucher_cashback', type: 'float', mapping: 'voucher_cashback'}
		]),
		sortInfo:{field: 'tvoucher_novoucher', direction: "ASC"}
	});
	
	
	/* Function for Retrieve DataStore */
	cbo_cust_jual_rawat_DataStore = new Ext.data.Store({
		id: 'cbo_cust_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_customer_list', 
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
	cbo_kwitansi_jual_rawat_DataStore = new Ext.data.Store({
		id: 'cbo_kwitansi_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_kwitansi_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kwitansi_id'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
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
	kwitansi_jual_rawat_DataStore = new Ext.data.Store({
		id: 'kwitansi_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_kwitansi_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jkwitansi_id'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jkwitansi_id', type: 'int', mapping: 'jkwitansi_id'},
			{name: 'kwitansi_no', type: 'string', mapping: 'kwitansi_no'},
			{name: 'jkwitansi_nilai', type: 'float', mapping: 'jkwitansi_nilai'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'}
		]),
		sortInfo:{field: 'jkwitansi_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Kwitansi DataStore */
	card_jual_rawat_DataStore = new Ext.data.Store({
		id: 'card_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_card_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcard_id'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
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
	cek_jual_rawat_DataStore = new Ext.data.Store({
		id: 'cek_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_cek_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcek_id'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jcek_id', type: 'int', mapping: 'jcek_id'}, 
			{name: 'jcek_nama', type: 'string', mapping: 'jcek_nama'},
			{name: 'jcek_no', type: 'string', mapping: 'jcek_no'},
			{name: 'jcek_valid', type: 'string', mapping: 'jcek_valid'}, 
			{name: 'jcek_bank', type: 'string', mapping: 'jcek_bank'},
			{name: 'jcek_nilai', type: 'float', mapping: 'jcek_nilai'}
		]),
		sortInfo:{field: 'jcek_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Transfer DataStore */
	transfer_jual_rawat_DataStore = new Ext.data.Store({
		id: 'transfer_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_transfer_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jtransfer_id'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jtransfer_id', type: 'int', mapping: 'jtransfer_id'}, 
			{name: 'jtransfer_bank', type: 'int', mapping: 'jtransfer_bank'},
			{name: 'jtransfer_nama', type: 'string', mapping: 'jtransfer_nama'},
			{name: 'jtransfer_nilai', type: 'float', mapping: 'jtransfer_nilai'}
		]),
		sortInfo:{field: 'jtransfer_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Tunai DataStore */
	tunai_jual_rawat_DataStore = new Ext.data.Store({
		id: 'tunai_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_tunai_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jtunai_id'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jtunai_id', type: 'int', mapping: 'jtunai_id'}, 
			{name: 'jtunai_nilai', type: 'float', mapping: 'jtunai_nilai'}
		]),
		sortInfo:{field: 'jtunai_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* GET Bank-List.Store */
	jrawat_bankDataStore = new Ext.data.Store({
		id:'jrawat_bankDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_bank_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'mbank_id'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jrawat_bank_value', type: 'int', mapping: 'mbank_id'}, 
			{name: 'jrawat_bank_display', type: 'string', mapping: 'mbank_nama'}
		]),
		sortInfo:{field: 'jrawat_bank_display', direction: "DESC"}
		});
	/* END GET Bank-List.Store */
	
	cbo_drawat_rawatDataStore = new Ext.data.Store({
		id: 'cbo_drawat_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_rawat_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'drawat_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'drawat_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'drawat_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'drawat_rawat_group', type: 'string', mapping: 'group_nama'},
			{name: 'drawat_rawat_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'drawat_rawat_du', type: 'float', mapping: 'rawat_du'},
			{name: 'drawat_rawat_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'drawat_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'drawat_rawat_display', direction: "ASC"}
	});
	
	cbo_perawatanDataStore = new Ext.data.Store({
		id: 'cbo_perawatanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_cbo_rawat_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'drawat_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'drawat_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'drawat_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'drawat_rawat_display', direction: "ASC"}
	});
	
	var cbo_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{drawat_rawat_kode}| <b>{drawat_rawat_display}</b>',
		'</div></tpl>'
    );
	
  	/* Function for Identify of Window Column Model */
	master_jual_rawat_ColumnModel = new Ext.grid.ColumnModel(
		[/*{
			header: '#',
			readOnly: true,
			dataIndex: 'jrawat_id',
			width: 5,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},*/
		{
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'jrawat_tanggal',
			width: 70,	//78,
			sortable: true,
//			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
//				format: 'Y-m-d'
				format: 'd-m-Y'
			})
		}, 
		{
			header: '<div align="center">' + 'No Faktur' + '</div>',
			dataIndex: 'jrawat_nobukti',
			width: 90,	//82,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}, 
		{
			header: '<div align="center">' + 'No Cust' + '</div>',
			dataIndex: 'cust_no',
			width: 80,
			sortable: false,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Customer' + '</div>',
			dataIndex: 'jrawat_cust',
			width: 200,	//185,
			sortable: true,
			readOnly: true
		}, 
		{
//			header: 'Member Customer',
			header: '<div align="center">' + 'No Member' + '</div>',
			dataIndex: 'cust_member',
			width: 80,	//100,
			sortable: false,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Total (Rp)' + '</div>',
			dataIndex: 'jrawat_total',
			align: 'right',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: function(val){
//				return '<span> Rp. '+Ext.util.Format.number(val,'0,000')+'</span>';
				return '<span> '+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			
		},
		{
			header: '<div align="center">' + 'Total Bayar (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'jrawat_bayar',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: function(val){
//				return '<span> Rp. '+Ext.util.Format.number(val,'0,000')+'</span>';
				return '<span> '+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			
		},
		{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'jrawat_keterangan',
			width: 180,	//190,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: '<div align="center">' + 'Paket' + '</div>',
			dataIndex: 'keterangan_paket',
			width: 80
		}, 
		{
			header: '<div align="center">' + 'Stat Dok' + '</div>',
			dataIndex: 'jrawat_stat_dok',
			width: 80
		}, 
		{
			header: 'Creator',
			dataIndex: 'jrawat_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jrawat_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jrawat_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jrawat_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jrawat_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_jual_rawat_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_jual_rawatListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_jual_rawatListEditorGrid',
		el: 'fp_master_jual_rawat',
//		title: 'List Of Master_jual_rawat',
		title: 'Daftar Penjualan Perawatan',
		autoHeight: true,
		store: master_jual_rawat_DataStore, // DataStore
		cm: master_jual_rawat_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,	//940,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_jual_rawat_DataStore,
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
			handler: master_jual_rawat_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: master_jual_rawat_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_jual_rawat_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						master_jual_rawat_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- No Faktur<br>- No Cust<br>- Nama Customer<br>- No Member'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_jual_rawat_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_jual_rawat_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_jual_rawat_print  
		}
		]
	});
	master_jual_rawatListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_jual_rawat_ContextMenu = new Ext.menu.Menu({
		id: 'master_jual_rawat_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_jual_rawat_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: master_jual_rawat_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_jual_rawat_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_jual_rawat_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_jual_rawat_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_jual_rawat_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_jual_rawat_SelectedRow=rowIndex;
		master_jual_rawat_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_jual_rawat_editContextMenu(){
		//master_jual_rawatListEditorGrid.startEditing(master_jual_rawat_SelectedRow,1);
		master_jual_rawat_confirm_update();
  	}
	/* End of Function */
  	
	master_jual_rawatListEditorGrid.addListener('rowcontextmenu', onmaster_jual_rawat_ListEditGridContextMenu);
	master_jual_rawat_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_jual_rawatListEditorGrid.on('afteredit', master_jual_rawat_update); // inLine Editing Record
	
	// Custom rendering Template
    var customer_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
//            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
//           'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
            '<span><b>{cust_no} : {cust_nama}</b><br /></span>',
            '{cust_alamat} | {cust_telprumah}',
        '</div></tpl>'
    );
	
	var voucher_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{voucher_nomor}</b>| {voucher_nama}<br/></span>',
			'Jenis: {voucher_jenis}&nbsp;&nbsp;&nbsp;[Nilai: {voucher_cashback}]',
		'</div></tpl>'
    );
	
	
	var kwitansi_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{ckwitansi_no}</b> <br/>',
			'a/n {ckwitansi_cust_nama} [ {ckwitansi_cust_no} ]<br/></span>',
			'{ckwitansi_cust_alamat}, <br>Sisa: <b>Rp. {total_sisa}</b> </span>',
		'</div></tpl>'
    );
	
	var rawat_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{drawat_rawat_kode}| <b>{drawat_rawat_display}</b>',
		'</div></tpl>'
    );
	/*var rawat_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{drawat_rawat_kode}</b>| {drawat_rawat_display}<br/>Group: {drawat_rawat_group}<br/>',
			'Kategori: {drawat_rawat_kategori}</span>',
		'</div></tpl>'
    );*/
		
	/* Identify  jrawat_id Field */
	jrawat_idField= new Ext.form.NumberField({
		id: 'jrawat_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jrawat_nobukti Field */
	jrawat_nobuktiField= new Ext.form.TextField({
		id: 'jrawat_nobuktiField',
		fieldLabel: 'No. Faktur',
		readOnly:true
	//	maxLength: 30,
	//	anchor: '95%'
	});
	/* Identify  jrawat_cust Field */
	jrawat_custField= new Ext.form.ComboBox({
		id: 'jrawat_custField',
		fieldLabel: 'Customer',
		store: cbo_cust_jual_rawat_DataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_jual_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jrawat_cust_nomemberField= new Ext.form.TextField({
		id: 'jrawat_cust_nomemberField',
		fieldLabel: 'No. Member',
		readOnly: true
	});
	
	/* Identify  jrawat_tanggal Field */
	jrawat_tanggalField= new Ext.form.DateField({
		id: 'jrawat_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	});
	/* Identify  jrawat_diskon Field */
	jrawat_diskonField= new Ext.form.NumberField({
		id: 'jrawat_diskonField',
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
	
	jrawat_cashback_cfField= new Ext.form.TextField({
		id: 'jrawat_cashback_cfField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		width: 120,
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_cashbackField.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/
	});
	
	jrawat_cashbackField= new Ext.form.NumberField({
		id: 'jrawat_cashbackField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		enableKeyEvents: true,
		allowDecimals: false,
		width: 100,
		maskRe: /([0-9]+)$/
	});
	
	/* Identify  jrawat_cara Field */
	jrawat_caraField= new Ext.form.ComboBox({
		id: 'jrawat_caraField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_cara_value', 'jrawat_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kuitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jrawat_cara_display',
		valueField: 'jrawat_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jrawat_cara2 Field */
	jrawat_cara2Field= new Ext.form.ComboBox({
		id: 'jrawat_cara2Field',
		fieldLabel: 'Cara Bayar 2',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_cara_value', 'jrawat_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kuitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jrawat_cara_display',
		valueField: 'jrawat_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jrawat_cara3 Field */
	jrawat_cara3Field= new Ext.form.ComboBox({
		id: 'jrawat_cara3Field',
		fieldLabel: 'Cara Bayar 3',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_cara_value', 'jrawat_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kuitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jrawat_cara_display',
		valueField: 'jrawat_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	
	jrawat_stat_dokField= new Ext.form.ComboBox({
		id: 'jrawat_stat_dokField',
		fieldLabel: 'Status Dokumen',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_stat_dok_value', 'jrawat_stat_dok_display'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup'],['Batal','Batal']]
		}),
		mode: 'local',
		emptyText: 'Terbuka',
		displayField: 'jrawat_stat_dok_display',
		valueField: 'jrawat_stat_dok_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	
	
	
	
	/* Identify  jrawat_keterangan Field */
	jrawat_keteranganField= new Ext.form.TextArea({
		id: 'jrawat_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	// START Field Voucher
	jrawat_voucher_noField= new Ext.form.ComboBox({
		id: 'jrawat_voucher_noField',
		fieldLabel: 'No Voucher',
		store: cbo_voucher_jual_rawatDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_nomor',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jrawat_voucher_noField.on('select', function(){
		j=cbo_voucher_jual_rawatDataStore.find('voucher_nomor',jrawat_voucher_noField.getValue());
		if(j>-1){
			jrawat_voucher_cashbackField.setValue(cbo_voucher_jual_rawatDataStore.getAt(j).data.voucher_cashback);
			load_total_rawat_bayar();
		}
	});
	
	jrawat_voucher_cashbackField= new Ext.ux.form.CFTextField({
		id: 'jrawat_voucher_cashbackField',
		fieldLabel: 'Nilai Cashback',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_rawat_voucherGroup= new Ext.form.FieldSet({
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
				items: [jrawat_voucher_noField,jrawat_voucher_cashbackField] 
			}
		]
	
	});
	// END Field Voucher
	// START Field Voucher-2
	jrawat_voucher_no2Field= new Ext.form.ComboBox({
		id: 'jrawat_voucher_no2Field',
		fieldLabel: 'No Voucher',
		store: cbo_voucher_jual_rawatDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_nomor',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jrawat_voucher_no2Field.on('select', function(){
		j=cbo_voucher_jual_rawatDataStore.find('voucher_nomor',jrawat_voucher_no2Field.getValue());
		if(j>-1){
			jrawat_voucher_cashback2Field.setValue(cbo_voucher_jual_rawatDataStore.getAt(j).data.voucher_cashback);
			load_total_rawat_bayar();
		}
	});
	
	jrawat_voucher_cashback2Field= new Ext.ux.form.CFTextField({
		id: 'jrawat_voucher_cashback2Field',
		fieldLabel: 'Nilai Cashback',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_rawat_voucher2Group= new Ext.form.FieldSet({
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
				items: [jrawat_voucher_no2Field,jrawat_voucher_cashback2Field] 
			}
		]
	
	});
	// END Field Voucher-2
	// START Field Voucher-3
	jrawat_voucher_no3Field= new Ext.form.ComboBox({
		id: 'jrawat_voucher_no3Field',
		fieldLabel: 'No Voucher',
		store: cbo_voucher_jual_rawatDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jrawat_voucher_no3Field.on('select', function(){
		j=cbo_voucher_jual_rawatDataStore.find('voucher_nomor',jrawat_voucher_no3Field.getValue());
		if(j>-1){
			jrawat_voucher_cashback3Field.setValue(cbo_voucher_jual_rawatDataStore.getAt(j).data.voucher_cashback);
			load_total_rawat_bayar();
		}
	});
	
	jrawat_voucher_cashback3Field= new Ext.ux.form.CFTextField({
		id: 'jrawat_voucher_cashback3Field',
		fieldLabel: 'Nilai Cashback',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_rawat_voucher3Group= new Ext.form.FieldSet({
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
				items: [jrawat_voucher_no3Field,jrawat_voucher_cashback3Field] 
			}
		]
	
	});
	// END Field Voucher-3
	
	// START Field Card
	jrawat_card_namaField= new Ext.form.ComboBox({
		id: 'jrawat_card_namaField',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_card_value', 'jrawat_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jrawat_card_display',
		valueField: 'jrawat_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jrawat_card_edcField= new Ext.form.ComboBox({
		id: 'jrawat_card_edcField',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_card_edc_value', 'jrawat_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jrawat_card_edc_display',
		valueField: 'jrawat_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jrawat_card_noField= new Ext.form.TextField({
		id: 'jrawat_card_noField',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jrawat_card_nilai_cfField= new Ext.form.TextField({
		id: 'jrawat_card_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_card_nilaiField.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_card_nilaiField= new Ext.form.NumberField({
		id: 'jrawat_card_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_rawat_cardGroup= new Ext.form.FieldSet({
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
				items: [jrawat_card_namaField,jrawat_card_edcField,jrawat_card_noField,jrawat_card_nilai_cfField] 
			}
		]
	
	});
	// END Field Card
	// START Field Card-2
	jrawat_card_nama2Field= new Ext.form.ComboBox({
		id: 'jrawat_card_nama2Field',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_card_value', 'jrawat_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jrawat_card_display',
		valueField: 'jrawat_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jrawat_card_edc2Field= new Ext.form.ComboBox({
		id: 'jrawat_card_edc2Field',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_card_edc_value', 'jrawat_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jrawat_card_edc_display',
		valueField: 'jrawat_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jrawat_card_no2Field= new Ext.form.TextField({
		id: 'jrawat_card_no2Field',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jrawat_card_nilai2_cfField= new Ext.form.TextField({
		id: 'jrawat_card_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_card_nilai2Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_card_nilai2Field= new Ext.form.NumberField({
		id: 'jrawat_card_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_rawat_card2Group= new Ext.form.FieldSet({
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
				items: [jrawat_card_nama2Field,jrawat_card_edc2Field,jrawat_card_no2Field,jrawat_card_nilai2_cfField] 
			}
		]
	
	});
	// END Field Card-2
	// START Field Card-3
	jrawat_card_nama3Field= new Ext.form.ComboBox({
		id: 'jrawat_card_nama3Field',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_card_value', 'jrawat_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jrawat_card_display',
		valueField: 'jrawat_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jrawat_card_edc3Field= new Ext.form.ComboBox({
		id: 'jrawat_card_edc3Field',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_card_edc_value', 'jrawat_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jrawat_card_edc_display',
		valueField: 'jrawat_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jrawat_card_no3Field= new Ext.form.TextField({
		id: 'jrawat_card_no3Field',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jrawat_card_nilai3_cfField= new Ext.form.TextField({
		id: 'jrawat_card_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_card_nilai3Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_card_nilai3Field= new Ext.form.NumberField({
		id: 'jrawat_card_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_rawat_card3Group= new Ext.form.FieldSet({
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
				items: [jrawat_card_nama3Field,jrawat_card_edc3Field,jrawat_card_no3Field,jrawat_card_nilai3_cfField] 
			}
		]
	
	});
	// END Field Card-3
	
	// StART Field Cek
	jrawat_cek_namaField= new Ext.form.TextField({
		id: 'jrawat_cek_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_cek_noField= new Ext.form.TextField({
		id: 'jrawat_cek_noField',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jrawat_cek_validField= new Ext.form.DateField({
		id: 'jrawat_cek_validField',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jrawat_cek_bankField= new Ext.form.ComboBox({
		id: 'jrawat_cek_bankField',
		fieldLabel: 'Bank',
		store: jrawat_bankDataStore,
		mode: 'remote',
		displayField: 'jrawat_bank_display',
		valueField: 'jrawat_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jrawat_cek_bankField)
	});
	
	jrawat_cek_nilai_cfField= new Ext.form.TextField({
		id: 'jrawat_cek_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_cek_nilaiField.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_cek_nilaiField= new Ext.form.NumberField({
		id: 'jrawat_cek_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_rawat_cekGroup = new Ext.form.FieldSet({
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
				items: [jrawat_cek_namaField,jrawat_cek_noField,jrawat_cek_validField,jrawat_cek_bankField,jrawat_cek_nilai_cfField] 
			}
		]
	
	});
	// END Field Cek
	// StART Field Cek-2
	jrawat_cek_nama2Field= new Ext.form.TextField({
		id: 'jrawat_cek_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_cek_no2Field= new Ext.form.TextField({
		id: 'jrawat_cek_no2Field',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jrawat_cek_valid2Field= new Ext.form.DateField({
		id: 'jrawat_cek_valid2Field',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jrawat_cek_bank2Field= new Ext.form.ComboBox({
		id: 'jrawat_cek_bank2Field',
		fieldLabel: 'Bank',
		store: jrawat_bankDataStore,
		mode: 'remote',
		displayField: 'jrawat_bank_display',
		valueField: 'jrawat_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jrawat_cek_bankField)
	});
	
	jrawat_cek_nilai2_cfField= new Ext.form.TextField({
		id: 'jrawat_cek_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_cek_nilai2Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_cek_nilai2Field= new Ext.form.NumberField({
		id: 'jrawat_cek_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_rawat_cek2Group = new Ext.form.FieldSet({
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
				items: [jrawat_cek_nama2Field,jrawat_cek_no2Field,jrawat_cek_valid2Field,jrawat_cek_bank2Field,jrawat_cek_nilai2_cfField] 
			}
		]
	
	});
	// END Field Cek-2
	// StART Field Cek-3
	jrawat_cek_nama3Field= new Ext.form.TextField({
		id: 'jrawat_cek_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_cek_no3Field= new Ext.form.TextField({
		id: 'jrawat_cek_no3Field',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jrawat_cek_valid3Field= new Ext.form.DateField({
		id: 'jrawat_cek_valid3Field',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jrawat_cek_bank3Field= new Ext.form.ComboBox({
		id: 'jrawat_cek_bank3Field',
		fieldLabel: 'Bank',
		store: jrawat_bankDataStore,
		mode: 'remote',
		displayField: 'jrawat_bank_display',
		valueField: 'jrawat_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jrawat_cek_bankField)
	});
	
	jrawat_cek_nilai3_cfField= new Ext.form.TextField({
		id: 'jrawat_cek_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_cek_nilai3Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_cek_nilai3Field= new Ext.form.NumberField({
		id: 'jrawat_cek_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_rawat_cek3Group = new Ext.form.FieldSet({
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
				items: [jrawat_cek_nama3Field,jrawat_cek_no3Field,jrawat_cek_valid3Field,jrawat_cek_bank3Field,jrawat_cek_nilai3_cfField] 
			}
		]
	
	});
	// END Field Cek-3
	
	// START Field Transfer
	jrawat_transfer_bankField= new Ext.form.ComboBox({
		id: 'jrawat_transfer_bankField',
		fieldLabel: 'Bank',
		store: jrawat_bankDataStore,
		mode: 'remote',
		displayField: 'jrawat_bank_display',
		valueField: 'jrawat_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jrawat_transfer_bankField)
	});

	jrawat_transfer_namaField= new Ext.form.TextField({
		id: 'jrawat_transfer_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jrawat_transfer_nilai_cfField= new Ext.form.TextField({
		id: 'jrawat_transfer_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_transfer_nilaiField.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_transfer_nilaiField= new Ext.form.NumberField({
		id: 'jrawat_transfer_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_rawat_transferGroup= new Ext.form.FieldSet({
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
				items: [jrawat_transfer_bankField,jrawat_transfer_namaField,jrawat_transfer_nilai_cfField] 
			}
		]
	
	});
	// END Field Transfer
	// START Field Transfer-2
	jrawat_transfer_bank2Field= new Ext.form.ComboBox({
		id: 'jrawat_transfer_bank2Field',
		fieldLabel: 'Bank',
		store: jrawat_bankDataStore,
		mode: 'remote',
		displayField: 'jrawat_bank_display',
		valueField: 'jrawat_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jrawat_transfer_nama2Field= new Ext.form.TextField({
		id: 'jrawat_transfer_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jrawat_transfer_nilai2_cfField= new Ext.form.TextField({
		id: 'jrawat_transfer_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_transfer_nilai2Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_transfer_nilai2Field= new Ext.form.NumberField({
		id: 'jrawat_transfer_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_rawat_transfer2Group= new Ext.form.FieldSet({
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
				items: [jrawat_transfer_bank2Field,jrawat_transfer_nama2Field,jrawat_transfer_nilai2_cfField] 
			}
		]
	
	});
	// END Field Transfer-2
	// START Field Transfer-3
	jrawat_transfer_bank3Field= new Ext.form.ComboBox({
		id: 'jrawat_transfer_bank3Field',
		fieldLabel: 'Bank',
		store: jrawat_bankDataStore,
		mode: 'remote',
		displayField: 'jrawat_bank_display',
		valueField: 'jrawat_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jrawat_transfer_nama3Field= new Ext.form.TextField({
		id: 'jrawat_transfer_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jrawat_transfer_nilai3_cfField= new Ext.form.TextField({
		id: 'jrawat_transfer_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_transfer_nilai3Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_transfer_nilai3Field= new Ext.form.NumberField({
		id: 'jrawat_transfer_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_rawat_transfer3Group= new Ext.form.FieldSet({
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
				items: [jrawat_transfer_bank3Field,jrawat_transfer_nama3Field,jrawat_transfer_nilai3_cfField] 
			}
		]
	
	});
	// END Field Transfer-3
	
	//START Field Tunai-1
	jrawat_tunai_nilai_cfField= new Ext.form.TextField({
		id: 'jrawat_tunai_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_tunai_nilaiField.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_tunai_nilaiField= new Ext.form.NumberField({
		id: 'jrawat_tunai_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_rawat_tunaiGroup = new Ext.form.FieldSet({
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
				items: [jrawat_tunai_nilai_cfField] 
			}
		]
	
	});
	// END Tunai-1
	
	//START Field Tunai-2
	jrawat_tunai_nilai2_cfField= new Ext.form.TextField({
		id: 'jrawat_tunai_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_tunai_nilai2Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_tunai_nilai2Field= new Ext.form.NumberField({
		id: 'jrawat_tunai_nilai2Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_rawat_tunai2Group = new Ext.form.FieldSet({
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
				items: [jrawat_tunai_nilai2_cfField] 
			}
		]
	
	});
	// END Tunai-2
	
	//START Field Tunai-3
	jrawat_tunai_nilai3_cfField= new Ext.form.TextField({
		id: 'jrawat_tunai_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_tunai_nilai3Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_tunai_nilai3Field= new Ext.form.NumberField({
		id: 'jrawat_tunai_nilai3Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_rawat_tunai3Group = new Ext.form.FieldSet({
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
				items: [jrawat_tunai_nilai3_cfField] 
			}
		]
	
	});
	// END Tunai-3
	
	//START Field Kwitansi-1
	jrawat_kwitansi_namaField= new Ext.form.TextField({
		id: 'jrawat_kwitansi_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		disabled:true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_nilai_cfField= new Ext.form.TextField({
		id: 'jrawat_kwitansi_nilai_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_kwitansi_nilaiField.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_kwitansi_nilaiField= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jrawat_kwitansi_noField= new Ext.form.ComboBox({
		id: 'jrawat_kwitansi_noField',
		fieldLabel: 'No Kuitansi',
		store: cbo_kwitansi_jual_rawat_DataStore,
		mode: 'remote',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%',
		listeners:{
			render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- No Cust<br>- Nama Customer<br>- Alamat Customer<br>- No Kuitansi'});
			}
		}
	});
	
	jrawat_kwitansi_sisaField= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_sisaField',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_noField.on("select",function(){
			j=cbo_kwitansi_jual_rawat_DataStore.find('ckwitansi_id',jrawat_kwitansi_noField.getValue());
			if(j>-1){
				jrawat_kwitansi_namaField.setValue(cbo_kwitansi_jual_rawat_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jrawat_kwitansi_sisaField.setValue(cbo_kwitansi_jual_rawat_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-1
	
	//START Field Kwitansi-2
	jrawat_kwitansi_nama2Field= new Ext.form.TextField({
		id: 'jrawat_kwitansi_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		disabled:true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_nilai2_cfField= new Ext.form.TextField({
		id: 'jrawat_kwitansi_nilai2_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_kwitansi_nilai2Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_kwitansi_nilai2Field= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_nilai2Field',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jrawat_kwitansi_no2Field= new Ext.form.ComboBox({
		id: 'jrawat_kwitansi_no2Field',
		fieldLabel: 'No Kuitansi',
		store: cbo_kwitansi_jual_rawat_DataStore,
		mode: 'local',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jrawat_kwitansi_sisa2Field= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_sisa2Field',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_no2Field.on("select",function(){
			j=cbo_kwitansi_jual_rawat_DataStore.find('ckwitansi_id',jrawat_kwitansi_no2Field.getValue());
			if(j>-1){
				jrawat_kwitansi_nama2Field.setValue(cbo_kwitansi_jual_rawat_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jrawat_kwitansi_sisa2Field.setValue(cbo_kwitansi_jual_rawat_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-2
	
	//START Field Kwitansi-3
	jrawat_kwitansi_nama3Field= new Ext.form.TextField({
		id: 'jrawat_kwitansi_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		disabled:true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_nilai3_cfField= new Ext.form.TextField({
		id: 'jrawat_kwitansi_nilai3_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		listeners: {
			'keyup': function(){
				var cf_tonumber = convertToNumber(this.getValue());
				jrawat_kwitansi_nilai3Field.setValue(cf_tonumber);
				load_total_rawat_bayar();
				
				var number_tocf = CurrencyFormatted(this.getValue());
				this.setRawValue(number_tocf);
			}
		},
		maskRe: /([0-9]+)$/ 
	});
	jrawat_kwitansi_nilai3Field= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_nilai3Field',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jrawat_kwitansi_no3Field= new Ext.form.ComboBox({
		id: 'jrawat_kwitansi_no3Field',
		fieldLabel: 'No Kuitansi',
		store: cbo_kwitansi_jual_rawat_DataStore,
		mode: 'local',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jrawat_kwitansi_sisa3Field= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_sisa3Field',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_no3Field.on("select",function(){
			j=cbo_kwitansi_jual_rawat_DataStore.find('ckwitansi_id',jrawat_kwitansi_no3Field.getValue());
			if(j>-1){
				jrawat_kwitansi_nama3Field.setValue(cbo_kwitansi_jual_rawat_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jrawat_kwitansi_sisa3Field.setValue(cbo_kwitansi_jual_rawat_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-3
	
	master_jual_rawat_kwitansiGroup = new Ext.form.FieldSet({
		title: 'Kuitansi',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_kwitansi_noField,jrawat_kwitansi_namaField,jrawat_kwitansi_sisaField,jrawat_kwitansi_nilai_cfField] 
			}
		]
	
	});
	
	master_jual_rawat_kwitansi2Group = new Ext.form.FieldSet({
		title: 'Kuitansi',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_kwitansi_no2Field,jrawat_kwitansi_nama2Field,jrawat_kwitansi_sisa2Field,jrawat_kwitansi_nilai2_cfField] 
			}
		]
	
	});
	
	master_jual_rawat_kwitansi3Group = new Ext.form.FieldSet({
		title: 'Kuitansi',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_kwitansi_no3Field,jrawat_kwitansi_nama3Field,jrawat_kwitansi_sisa2Field,jrawat_kwitansi_nilai3_cfField] 
			}
		]
	
	});
	
	//* Bayar
	jrawat_jumlahField= new Ext.form.NumberField({
		id: 'jrawat_jumlahField',
		fieldLabel: 'Jumlah Item',
		allowBlank: true,
		readOnly: true,
		allowDecimals: false,
		width: 40,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jrawat_subTotalField= new Ext.ux.form.CFTextField({
		id: 'jrawat_subTotalField',
		fieldLabel: 'Sub Total (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		width: 120
	});

	jrawat_totalField= new Ext.ux.form.CFTextField({
		id: 'jrawat_totalField',
		fieldLabel: '<span style="font-weight:bold">Total (Rp)</span>',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		enableKeyEvents: true,
		itemCls: 'rmoney_b',
		width: 120
	});
	
	/*jrawat_bayarField= new Ext.form.NumberField({
		id: 'jrawat_bayarField',
		fieldLabel: 'Total Bayar (Rp)',
		readOnly: true,
		enableKeyEvents: true,
		allowBlank: true,
		allowDecimals: false,
		width: 120,
		maxLength: 50
	});*/
	jrawat_bayarField= new Ext.ux.form.CFTextField({
		id: 'jrawat_bayarField',
		fieldLabel: 'Total Bayar (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		width: 120
	});
	
	/*jrawat_hutangField= new Ext.form.NumberField({
		id: 'jrawat_hutangField',
		fieldLabel: 'Hutang (Rp)',
		readOnly: true,
		allowBlank: true,
		allowDecimals: false,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});*/
	jrawat_hutangField= new Ext.ux.form.CFTextField({
		id: 'jrawat_hutangField',
		fieldLabel: 'Hutang (Rp)',
		valueRenderer: 'numberToCurrency',
		allowNegatife: true,
		readOnly: true,
		itemCls: 'rmoney',
		width: 120
		//maskRe: new RegExp('[0123456789.km ]'),
		//hiddenName: 'length'
	});
	jrawat_pesanLabel= new Ext.form.Label({
		style: {
			marginLeft: '100px',
			fontSize: '14px',
			color: '#CC0000'
		}
	});
	jrawat_lunasLabel= new Ext.form.Label({
		style: {
			marginLeft: '100px',
			fontSize: '14px',
			color: '#006600'
		}
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

                items: [jrawat_caraField,master_jual_rawat_tunaiGroup,master_jual_rawat_cardGroup,master_jual_rawat_cekGroup,master_jual_rawat_kwitansiGroup,master_jual_rawat_transferGroup,master_jual_rawat_voucherGroup]
            },{
                title:'Cara Bayar 2',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jrawat_cara2Field, master_jual_rawat_tunai2Group, master_jual_rawat_kwitansi2Group ,master_jual_rawat_card2Group, master_jual_rawat_cek2Group, master_jual_rawat_transfer2Group, master_jual_rawat_voucher2Group]
            },{
                title:'Cara Bayar 3',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jrawat_cara3Field, master_jual_rawat_tunai3Group, master_jual_rawat_kwitansi3Group, master_jual_rawat_card3Group, master_jual_rawat_cek3Group, master_jual_rawat_transfer3Group, master_jual_rawat_voucher3Group]
            }]
	});
	
	master_jual_rawat_bayarGroup = new Ext.form.FieldSet({
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
				labelWidth: 120,
				layout: 'form',
    			labelPad: 0,
				baseCls: 'x-plain',
				border:false,
				labelAlign: 'left',
				items: [jrawat_jumlahField, jrawat_subTotalField, jrawat_diskonField, jrawat_cashback_cfField, {xtype: 'spacer',height:10},jrawat_totalField, jrawat_bayarField,jrawat_hutangField,jrawat_pesanLabel,jrawat_lunasLabel] 
			}
			]
	
	});
	
	/*Fieldset Master*/
	master_jual_rawat_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jrawat_nobuktiField, jrawat_custField, jrawat_cust_nomemberField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jrawat_tanggalField, jrawat_keteranganField, jrawat_stat_dokField] 
			}
			]
	
	});
	
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_jual_rawat_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intopeprodukan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'drawat_id', type: 'int', mapping: 'drawat_id'}, 
			{name: 'drawat_master', type: 'int', mapping: 'drawat_master'}, 
			{name: 'drawat_rawat', type: 'int', mapping: 'drawat_rawat'}, 
			{name: 'drawat_jumlah', type: 'int', mapping: 'drawat_jumlah'}, 
			{name: 'drawat_harga', type: 'float', mapping: 'drawat_harga'}, 
			{name: 'drawat_diskon', type: 'int', mapping: 'drawat_diskon'},
			{name: 'drawat_sales', type: 'string', mapping: 'drawat_sales'},
			{name: 'drawat_diskon_jenis', type: 'string', mapping: 'drawat_diskon_jenis'},
			{name: 'drawat_subtotal', type: 'float', mapping: 'drawat_subtotal'},
			{name: 'drawat_subtotal_net', type: 'int', mapping: 'drawat_subtotal_net'}
	]);
	//eof
	
	
	//function for json writer of detail
	var detail_jual_rawat_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_jual_rawat_DataStore = new Ext.data.Store({
		id: 'detail_jual_rawat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=detail_detail_jual_rawat_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: pageS},
		reader: detail_jual_rawat_reader,
		sortInfo:{field: 'drawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_jual_rawat= new Ext.ux.grid.RowEditor({
        saveText: 'Update'/*,
		listeners: {
			afteredit: function(){
				detail_jual_rawat_DataStore.commitChanges();
			}
		}*/
    });
	//eof
	
	
	memberDataStore = new Ext.data.Store({
		id: 'memberDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=get_member_by_cust', 
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
	
	
		
	/*Ext.util.Format.comboRenderer = function(combo){
		cbo_drawat_rawatDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}*/
	
	var combo_jual_rawat=new Ext.form.ComboBox({
			store: cbo_drawat_rawatDataStore,
			mode: 'remote',
			displayField: 'drawat_rawat_display',
			valueField: 'drawat_rawat_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: rawat_jual_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	drawat_idField=new Ext.form.NumberField();
	
	combo_jual_rawat.on('select',function(){
		for(i=0;i<detail_jual_rawat_DataStore.getCount();i++){	
			detail_jual_rawat_record=detail_jual_rawat_DataStore.getAt(i);
			var c_dtStore=0;
			var j=cbo_drawat_rawatDataStore.find('drawat_rawat_value',combo_jual_rawat.getValue());
			if(cbo_drawat_rawatDataStore.getCount()){
				drawat_idField.setValue(cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_value);
				//detail_jual_rawat_record.data.drawat_jumlah='2';
			}
		}
	});
		

	//declaration of detail coloumn model
	detail_jual_rawat_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'drawat_rawat',
			width: 400,	//250,
			sortable: true,
			allowBlank: false,
			editor: combo_jual_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_jual_rawat)
		},
		{
			align: 'Right',
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'drawat_jumlah',
			width: 60,	//80,
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
			align: 'Right',
			header: '<div align="center">' + 'Harga (Rp)' + '</div>',
			dataIndex: 'drawat_harga',
			width: 100,	//150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		}
		,{
			align: 'Right',
			header: '<div align="center">' + 'Sub Total (Rp)' + '</div>',
			dataIndex: 'drawat_subtotal',
			width: 100, //150,
			sortable: true,
			reaOnly: true,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.drawat_harga* record.data.drawat_jumlah,'0,000');
            }
		},
		{
			header: '<div align="center">' + 'Jenis Diskon' + '</div>',
			dataIndex: 'drawat_diskon_jenis',
			width: 80,	//100,
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
			align: 'Right',
			header: '<div align="center">' + 'Diskon (%)' + '</div>',
			dataIndex: 'drawat_diskon',
			width: 80, //90,
			sortable: true,
//			renderer: Ext.util.Format.numberRenderer('0,000%'),
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
			align: 'Right',
			header: '<div align="center">' + 'Sub Tot Net (Rp)' + '</div>',
			dataIndex: 'drawat_subtotal_net',
			width: 100, //150,
			sortable: true,
			reaOnly: true,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.drawat_harga* record.data.drawat_jumlah*(100-record.data.drawat_diskon)/100,'0,000');

            }
/*		},{
			header: 'Sales',
			dataIndex: 'drawat_sales',
			width: 150,
			sortable: true,
			reaOnly: true
*/		}]
	);
	detail_jual_rawat_ColumnModel.defaultSortable= true;
	//eof
	
	function get_harga_rawat(id_produk){
		var harga_produk=0;
		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_jual_rawat&m=get_harga_rawat',
			params:{ produk_id	: id_produk },
			success: function(response){							
				var result=response.responseText;
				harga_produk=result;
			}
		});
		return harga_produk;
	}
	
	
	//declaration of detail list editor grid
	detail_jual_rawatListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_jual_rawatListEditorGrid',
		el: 'fp_detail_jual_rawat',
		title: 'Detail Penjualan Perawatan',
		height: 225,	//250,
		width: 940,	//938,
		autoScroll: true,
		store: detail_jual_rawat_DataStore, // DataStore
		colModel: detail_jual_rawat_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_jual_rawat],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_jual_rawat_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_jual_rawat_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: detail_jual_rawat_confirm_delete
		}
		]
	});
	//eof
	
	//function of detail add
	function detail_jual_rawat_add(){
		var edit_detail_jual_rawat= new detail_jual_rawatListEditorGrid.store.recordType({
			drawat_id	:'',		
			drawat_master	:'',		
			drawat_rawat	:null,		
			drawat_satuan	:null,		
			drawat_jumlah	:null,		
			drawat_harga	:null,
			drawat_diskon_jenis: null,
			drawat_diskon	:null,
			drawat_sales	:null
		});
		editor_detail_jual_rawat.stopEditing();
		detail_jual_rawat_DataStore.insert(0, edit_detail_jual_rawat);
		//detail_jual_rawatListEditorGrid.getView().refresh();
		detail_jual_rawatListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_jual_rawat.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_jual_rawat(){
		detail_jual_rawat_DataStore.commitChanges();
		detail_jual_rawatListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_jual_rawat_insert(){
		var count_detail=detail_jual_rawat_DataStore.getCount();
		for(i=0;i<detail_jual_rawat_DataStore.getCount();i++){
			detail_jual_rawat_record=detail_jual_rawat_DataStore.getAt(i);
			if(detail_jual_rawat_record.data.drawat_rawat!==null&&detail_jual_rawat_record.data.drawat_rawat.drawat_rawat!==""){
				Ext.Ajax.request({
					waitMsg: 'Mohon tunggu...',
					url: 'index.php?c=c_master_jual_rawat&m=detail_detail_jual_rawat_insert',
					params:{
						drawat_id	: detail_jual_rawat_record.data.drawat_id, 
						drawat_master	: eval(jrawat_idField.getValue()), 
						drawat_rawat	: detail_jual_rawat_record.data.drawat_rawat, 
						drawat_jumlah	: detail_jual_rawat_record.data.drawat_jumlah, 
						drawat_harga	: detail_jual_rawat_record.data.drawat_harga, 
						drawat_diskon	: detail_jual_rawat_record.data.drawat_diskon,
						drawat_diskon_jenis	: detail_jual_rawat_record.data.drawat_diskon_jenis,
						drawat_sales			: detail_jual_rawat_record.data.drawat_sales,
						jrawat_id		: eval(jrawat_idField.getValue())
					},
					timeout: 60000,
					success: function(response){							
						var result=eval(response.responseText);
						if(i==count_detail){
							Ext.Ajax.request({
								waitMsg: 'Mohon tunggu...',
								url: 'index.php?c=c_master_jual_rawat&m=catatan_piutang_update',
								params:{drawat_master	: eval(jrawat_idField.getValue())}
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
		}
	}
	//eof
	
	//function for purge detail
	function detail_jual_rawat_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_jual_rawat&m=detail_detail_jual_rawat_purge',
			params:{ master_id: eval(jrawat_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_jual_rawat_confirm_delete(){
		// only one record is selected here
		if(detail_jual_rawatListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_jual_rawat_delete);
		} else if(detail_jual_rawatListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_jual_rawat_delete);
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
	function detail_jual_rawat_delete(btn){
		if(btn=='yes'){
			var s = detail_jual_rawatListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_jual_rawat_DataStore.remove(r);
			}
		} 
		detail_jual_rawat_DataStore.commitChanges();
	}
	//eof
	
	
	function update_group_carabayar_jual_rawat(){
		var value=jrawat_caraField.getValue();
		master_jual_rawat_tunaiGroup.setVisible(false);
		master_jual_rawat_cardGroup.setVisible(false);
		master_jual_rawat_cekGroup.setVisible(false);
		master_jual_rawat_transferGroup.setVisible(false);
		master_jual_rawat_kwitansiGroup.setVisible(false);
		master_jual_rawat_voucherGroup.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jrawat_tunai_nilaiField.reset();
		jrawat_tunai_nilai_cfField.reset();
		jrawat_card_nilaiField.reset();
		jrawat_card_nilai_cfField.reset();
		jrawat_cek_nilaiField.reset();
		jrawat_cek_nilai_cfField.reset();
		jrawat_transfer_nilaiField.reset();
		jrawat_transfer_nilai_cfField.reset();
		jrawat_kwitansi_nilaiField.reset();
		jrawat_kwitansi_nilai_cfField.reset();
		jrawat_voucher_cashbackField.reset();
		//jrawat_voucher_cashback_cfField.reset();
		//load_total_rawat_bayar();
		
		if(value=='card'){
			master_jual_rawat_cardGroup.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_rawat_cekGroup.setVisible(true);
		}else if(value=='transfer'){
			master_jual_rawat_transferGroup.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_rawat_kwitansiGroup.setVisible(true);
		}else if(value=='voucher'){
			master_jual_rawat_voucherGroup.setVisible(true);
		}else if(value=='tunai'){
			master_jual_rawat_tunaiGroup.setVisible(true);
		}
	}
	
	function update_group_carabayar2_jual_rawat(){
		var value=jrawat_cara2Field.getValue();
		master_jual_rawat_tunai2Group.setVisible(false);
		master_jual_rawat_card2Group.setVisible(false);
		master_jual_rawat_cek2Group.setVisible(false);
		master_jual_rawat_transfer2Group.setVisible(false);
		master_jual_rawat_kwitansi2Group.setVisible(false);
		master_jual_rawat_voucher2Group.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jrawat_tunai_nilai2Field.reset();
		jrawat_card_nilai2Field.reset();
		jrawat_cek_nilai2Field.reset();
		jrawat_transfer_nilai2Field.reset();
		jrawat_kwitansi_nilai2Field.reset();
		jrawat_voucher_cashback2Field.reset();
		//load_total_rawat_bayar();
		
		if(value=='card'){
			master_jual_rawat_card2Group.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_rawat_cek2Group.setVisible(true);
		}else if(value=='transfer'){
			master_jual_rawat_transfer2Group.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_rawat_kwitansi2Group.setVisible(true);
		}else if(value=='voucher'){
			master_jual_rawat_voucher2Group.setVisible(true);
		}else if(value=='tunai'){
			master_jual_rawat_tunai2Group.setVisible(true);
		}
	}
	
	function update_group_carabayar3_jual_rawat(){
		var value=jrawat_cara3Field.getValue();
		master_jual_rawat_tunai3Group.setVisible(false);
		master_jual_rawat_card3Group.setVisible(false);
		master_jual_rawat_cek3Group.setVisible(false);
		master_jual_rawat_transfer3Group.setVisible(false);
		master_jual_rawat_kwitansi3Group.setVisible(false);
		master_jual_rawat_voucher3Group.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jrawat_tunai_nilai3Field.reset();
		jrawat_card_nilai3Field.reset();
		jrawat_cek_nilai3Field.reset();
		jrawat_transfer_nilai3Field.reset();
		jrawat_kwitansi_nilai3Field.reset();
		jrawat_voucher_cashback3Field.reset();
		//load_total_rawat_bayar();
		
		if(value=='card'){
			master_jual_rawat_card3Group.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_rawat_cek3Group.setVisible(true);
		}else if(value=='transfer'){
			master_jual_rawat_transfer3Group.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_rawat_kwitansi3Group.setVisible(true);
		}else if(value=='voucher'){
			master_jual_rawat_voucher3Group.setVisible(true);
		}else if(value=='tunai'){
			master_jual_rawat_tunai3Group.setVisible(true);
		}
	}
	
	
	function load_detail_jual_rawat(){
		var detail_jual_rawat_record;
		for(i=0;i<detail_jual_rawat_DataStore.getCount();i++){
			detail_jual_rawat_record=detail_jual_rawat_DataStore.getAt(i);
			var j=cbo_drawat_rawatDataStore.find('drawat_rawat_value',detail_jual_rawat_record.data.drawat_rawat);
			if(j>0){
				detail_jual_rawat_record.data.drawat_harga=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_harga;
				//detail_jual_rawat_record.data.drawat_satuan=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_satuan;
				if(detail_jual_rawat_record.data.drawat_diskon==""){
					if(jrawat_cust_nomemberField.getValue()!=""){
						if(cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_dm!==0){
							detail_jual_rawat_record.data.drawat_diskon=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_dm;
							detail_jual_rawat_record.data.drawat_diskon_jenis='DM';
						}
					}else{
						if(cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_du!==0){
							detail_jual_rawat_record.data.drawat_diskon=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_du;
							detail_jual_rawat_record.data.drawat_diskon_jenis='DU';
						}
					}
				}
			}
		}
	}
	
	function load_total_rawat_bayar(){
		var jumlah_item=0;
		var subtotal_harga=0;
		var total_harga=0;
		var total_hutang=0;
		var total_bayar=0;

		var total_harga2=0;
		var total_bayar2=0;

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
		
		var detail_jual_rawat_record;
		for(i=0;i<detail_jual_rawat_DataStore.getCount();i++){
			detail_jual_rawat_record=detail_jual_rawat_DataStore.getAt(i);
			var j=cbo_drawat_rawatDataStore.find('drawat_rawat_value',detail_jual_rawat_record.data.drawat_rawat);
			if(j>=0){
				detail_jual_rawat_record.data.drawat_harga=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_harga;
				//detail_jual_rawat_record.data.drawat_satuan=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_satuan;
				if(detail_jual_rawat_record.data.drawat_diskon==""){
					if(jrawat_cust_nomemberField.getValue()!=""){
						if(cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_dm!==0){
							detail_jual_rawat_record.data.drawat_diskon=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_dm;
							detail_jual_rawat_record.data.drawat_diskon_jenis='DM';
						}
					}else{
						//if(cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_du!==0){
							detail_jual_rawat_record.data.drawat_diskon=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_du;
							detail_jual_rawat_record.data.drawat_diskon_jenis='DU';
						//}
					}
				}
			}
			
			//detail_jual_rawat_record=detail_jual_rawat_DataStore.getAt(i);
			jumlah_item=jumlah_item+eval(detail_jual_rawat_record.data.drawat_jumlah);
			subtotal_harga=subtotal_harga+eval(detail_jual_rawat_record.data.drawat_jumlah*detail_jual_rawat_record.data.drawat_harga*(100-detail_jual_rawat_record.data.drawat_diskon)/100);
		}
		jrawat_jumlahField.setValue(jumlah_item);
		jrawat_subTotalField.setValue(subtotal_harga);
		total_harga=subtotal_harga*(100-jrawat_diskonField.getValue())/100 - jrawat_cashbackField.getValue();
		total_harga=(total_harga>0?Math.round(total_harga):0);
		//jrawat_subTotalField.setValue(total_harga);
		jrawat_totalField.setValue(total_harga);

		

		transfer_nilai=jrawat_transfer_nilaiField.getValue();
		if(/^\d+$/.test(transfer_nilai))
			transfer_nilai=jrawat_transfer_nilaiField.getValue();
		else
			transfer_nilai=0;
		
		transfer_nilai2=jrawat_transfer_nilai2Field.getValue();
		if(/^\d+$/.test(transfer_nilai2))
			transfer_nilai2=jrawat_transfer_nilai2Field.getValue();
		else
			transfer_nilai2=0;
		
		transfer_nilai3=jrawat_transfer_nilai3Field.getValue();
		if(/^\d+$/.test(transfer_nilai3))
			transfer_nilai3=jrawat_transfer_nilai3Field.getValue();
		else
			transfer_nilai3=0;
		
		kwitansi_nilai=jrawat_kwitansi_nilaiField.getValue();
		if(/^\d+$/.test(kwitansi_nilai))
			kwitansi_nilai=jrawat_kwitansi_nilaiField.getValue();
		else
			kwitansi_nilai=0;
		
		kwitansi_nilai2=jrawat_kwitansi_nilai2Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai2))
			kwitansi_nilai2=jrawat_kwitansi_nilai2Field.getValue();
		else
			kwitansi_nilai2=0;
		
		kwitansi_nilai3=jrawat_kwitansi_nilai3Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai3))
			kwitansi_nilai3=jrawat_kwitansi_nilai3Field.getValue();
		else
			kwitansi_nilai3=0;
		
		card_nilai=jrawat_card_nilaiField.getValue();
		if(/^\d+$/.test(card_nilai))
			card_nilai=jrawat_card_nilaiField.getValue();
		else
			card_nilai=0;
		
		card_nilai2=jrawat_card_nilai2Field.getValue();
		if(/^\d+$/.test(card_nilai2))
			card_nilai2=jrawat_card_nilai2Field.getValue();
		else
			card_nilai2=0;
		
		card_nilai3=jrawat_card_nilai3Field.getValue();
		if(/^\d+$/.test(card_nilai3))
			card_nilai3=jrawat_card_nilai3Field.getValue();
		else
			card_nilai3=0;
		
		cek_nilai=jrawat_cek_nilaiField.getValue();
		if(/^\d+$/.test(cek_nilai))
			cek_nilai=jrawat_cek_nilaiField.getValue();
		else
			cek_nilai=0;
		
		cek_nilai2=jrawat_cek_nilai2Field.getValue();
		if(/^\d+$/.test(cek_nilai2))
			cek_nilai2=jrawat_cek_nilai2Field.getValue();
		else
			cek_nilai2=0;
		
		cek_nilai3=jrawat_cek_nilai3Field.getValue();
		if(/^\d+$/.test(cek_nilai3))
			cek_nilai3=jrawat_cek_nilai3Field.getValue();
		else
			cek_nilai3=0;
		
		voucher_nilai=jrawat_voucher_cashbackField.getValue();
		if(/^\d+$/.test(voucher_nilai))
			voucher_nilai=jrawat_voucher_cashbackField.getValue();
		else
			voucher_nilai=0;
		
		voucher_nilai2=jrawat_voucher_cashback2Field.getValue();
		if(/^\d+$/.test(voucher_nilai2))
			voucher_nilai2=jrawat_voucher_cashback2Field.getValue();
		else
			voucher_nilai2=0;
		
		voucher_nilai3=jrawat_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai3))
			voucher_nilai3=jrawat_voucher_cashback3Field.getValue();
		else
			voucher_nilai3=0;

		tunai_nilai=jrawat_tunai_nilaiField.getValue();
		if(/^\d+$/.test(tunai_nilai))
			tunai_nilai=jrawat_tunai_nilaiField.getValue();
		else
			tunai_nilai=0;

		tunai_nilai2=jrawat_tunai_nilai2Field.getValue();
		if(/^\d+$/.test(tunai_nilai2))
			tunai_nilai2=jrawat_tunai_nilai2Field.getValue();
		else
			tunai_nilai2=0;

		tunai_nilai3=jrawat_tunai_nilai3Field.getValue();
		if(/^\d+$/.test(tunai_nilai3))
			tunai_nilai3=jrawat_tunai_nilai3Field.getValue();
		else
			tunai_nilai3=0;


		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		total_bayar=(total_bayar>0?Math.round(total_bayar):0);
		jrawat_bayarField.setValue(total_bayar);

		//total_hutang=total_harga-jrawat_bayarField.getValue()-jrawat_transfer_nilaiField.getValue()-jrawat_transfer_nilai2Field.getValue()-jrawat_transfer_nilai3Field.getValue()-jrawat_kwitansi_nilaiField.getValue()-jrawat_kwitansi_nilai2Field.getValue()-jrawat_kwitansi_nilai3Field.getValue()-jrawat_card_nilaiField.getValue()-jrawat_card_nilai2Field.getValue()-jrawat_card_nilai3Field.getValue()-jrawat_cek_nilaiField.getValue()-jrawat_cek_nilai2Field.getValue()-jrawat_cek_nilai3Field.getValue()-jrawat_voucher_cashbackField.getValue()-jrawat_voucher_cashback2Field.getValue()-jrawat_voucher_cashback3Field.getValue();
		total_hutang=total_harga-total_bayar;
		
		total_hutang=(total_hutang>0?Math.round(total_hutang):0);
		jrawat_hutangField.setValue(total_hutang);
		
		if(total_bayar>total_harga){
			jrawat_pesanLabel.setText("Kelebihan Jumlah Bayar");
		}else if(total_bayar<total_harga || total_bayar==total_harga){
			jrawat_pesanLabel.setText("");
		}
		if(total_bayar==total_harga){
			jrawat_lunasLabel.setText("LUNAS");
		}else if(total_bayar!==total_harga){
			jrawat_lunasLabel.setText("");
		}
	}
	
	function load_all_jual_rawat(){
		//load_detail_jual_rawat();
		load_total_rawat_bayar();
	}
	//event on update of detail data store
	detail_jual_rawat_DataStore.on("update",load_all_jual_rawat);
	//detail_jual_rawat_DataStore.on("load",load_total_rawat_bayar);
	jrawat_bayarField.on("keyup",load_total_rawat_bayar);
	jrawat_diskonField.on("keyup",load_total_rawat_bayar);
	jrawat_cashbackField.on("keyup",load_total_rawat_bayar);
	//kwitansi
	jrawat_kwitansi_nilaiField.on("keyup",load_total_rawat_bayar);
	jrawat_kwitansi_nilai2Field.on("keyup",load_total_rawat_bayar);
	jrawat_kwitansi_nilai3Field.on("keyup",load_total_rawat_bayar);
	//card
	jrawat_card_nilaiField.on("keyup",load_total_rawat_bayar);
	jrawat_card_nilai2Field.on("keyup",load_total_rawat_bayar);
	jrawat_card_nilai3Field.on("keyup",load_total_rawat_bayar);
	//cek/giro
	jrawat_cek_nilaiField.on("keyup",load_total_rawat_bayar);
	jrawat_cek_nilai2Field.on("keyup",load_total_rawat_bayar);
	jrawat_cek_nilai3Field.on("keyup",load_total_rawat_bayar);
	//transfer
	jrawat_transfer_nilaiField.on("keyup",load_total_rawat_bayar);
	jrawat_transfer_nilai2Field.on("keyup",load_total_rawat_bayar);
	jrawat_transfer_nilai3Field.on("keyup",load_total_rawat_bayar);
	//voucher
	jrawat_voucher_cashbackField.on("keyup",load_total_rawat_bayar);
	jrawat_voucher_cashback2Field.on("keyup",load_total_rawat_bayar);
	jrawat_voucher_cashback3Field.on("keyup",load_total_rawat_bayar);
	//tunai
	jrawat_tunai_nilaiField.on("keyup",load_total_rawat_bayar);
	jrawat_tunai_nilai2Field.on("keyup",load_total_rawat_bayar);
	jrawat_tunai_nilai3Field.on("keyup",load_total_rawat_bayar);
	
	jrawat_caraField.on("select",update_group_carabayar_jual_rawat);
	jrawat_cara2Field.on("select",update_group_carabayar2_jual_rawat);
	jrawat_cara3Field.on("select",update_group_carabayar3_jual_rawat);
	jrawat_custField.on("select",function(){
		load_membership();
		j=memberDataStore.find('member_cust',jrawat_custField.getValue());
		if(j>-1)
			jrawat_cust_nomemberField.setValue(memberDataStore.getAt(j).member_no);
		else
			jrawat_cust_nomemberField.setValue("");

		cbo_cust=cbo_cust_jual_rawat_DataStore.find('cust_id',jrawat_custField.getValue());
		if(cbo_cust>-1){
			//cbo_kwitansi_jual_rawat_DataStore.load({params: {kwitansi_cust: cbo_cust_jual_rawat_DataStore.getAt(cbo_cust).data.cust_id}});
			jrawat_cek_namaField.setValue(cbo_cust_jual_rawat_DataStore.getAt(cbo_cust).data.cust_nama);
			jrawat_cek_nama2Field.setValue(cbo_cust_jual_rawat_DataStore.getAt(cbo_cust).data.cust_nama);
			jrawat_cek_nama3Field.setValue(cbo_cust_jual_rawat_DataStore.getAt(cbo_cust).data.cust_nama);

			jrawat_transfer_namaField.setValue(cbo_cust_jual_rawat_DataStore.getAt(cbo_cust).data.cust_nama);
			jrawat_transfer_nama2Field.setValue(cbo_cust_jual_rawat_DataStore.getAt(cbo_cust).data.cust_nama);
			jrawat_transfer_nama3Field.setValue(cbo_cust_jual_rawat_DataStore.getAt(cbo_cust).data.cust_nama);
		}
	});
	
	function show_windowGrid(){
		master_jual_rawat_DataStore.load({
			params: {start: 0, limit: pageS},
			callback: function(opts, success, response){
				if(success){
					master_jual_rawat_createWindow.show();
				}
			}
		});	// load DataStore
	}
	
	/* START Detail Pengambilan Paket */
	// Function for json reader of detail
	var detail_ambil_paket_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intopeprodukan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jpaket_nobukti', type: 'string', mapping: 'jpaket_nobukti'}, 
			{name: 'paket_nama', type: 'string', mapping: 'paket_nama'}, 
			{name: 'rawat_nama', type: 'string', mapping: 'rawat_nama'}, 
			{name: 'dapaket_jumlah', type: 'int', mapping: 'dapaket_jumlah'}, 
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'}
	]);
	//eof
	
	
	//function for json writer of detail
	var detail_ambil_paket_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_ambil_paketDataStore = new Ext.data.Store({
		id: 'detail_ambil_paketDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_rawat&m=detail_ambil_paket_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: pageS},
		reader: detail_ambil_paket_reader,
		sortInfo:{field: 'jpaket_nobukti', direction: "ASC"}
	});
	/* End of Function */
	
	detail_ambil_paketColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'No Faktur' + '</div>',
			dataIndex: 'jpaket_nobukti',
			width: 100,	//250,
			sortable: true
		},
		{
			header: '<div align="center">' + 'Nama Paket' + '</div>',
			dataIndex: 'paket_nama',
			width: 280,
			sortable: true
		},
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'rawat_nama',
			width: 300,	//100,
			sortable: true
		},
		{
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'dapaket_jumlah',
			width: 60,	//100,
			sortable: true
		},
		{
			//align: 'Right',
			header: '<div align="center">' + 'Customer' + '</div>',
			dataIndex: 'cust_nama',
			width: 200, //150,
			sortable: true,
			reaOnly: true
		}]
	);
	detail_ambil_paketColumnModel.defaultSortable= true;
	
	//declaration of detail list editor grid
	detail_ambil_paketListGrid =  new Ext.grid.GridPanel({
		id: 'detail_ambil_paketListGrid',
		el: 'fp_detail_ambil_paket',
		//title: 'Detail Pengambilan Paket',
		title: 'Info Paket (dari Kasir - Pengambilan Paket)',
		height: 150,	//250,
		width: 940,	//938,
		autoScroll: true,
		store: detail_ambil_paketDataStore, // DataStore
		colModel: detail_ambil_paketColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		//plugins: [editor_detail_jual_rawat],
		frame: true,
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_ambil_paketDataStore,
			displayInfo: true
		})
	});
	//eof
	/* END Detail Pengambilan Paket */
	
	/* Function for retrieve create Window Panel*/ 
	master_jual_rawat_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		//el: 'form_rawat_addEdit',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 950,
		//plain: true,
		//layout: 'fit',
		items: [master_jual_rawat_masterGroup,detail_jual_rawatListEditorGrid,detail_ambil_paketListGrid,master_jual_rawat_bayarGroup]
		,
		buttons: [
			{
				text: 'Save and Print',
				handler: save_andPrint
			},
			{
				text: 'Save',
				handler: master_jual_rawat_create
			},
			{
				text: 'Cancel',
				handler: function(){
					master_jual_rawat_reset_form();
					master_cara_bayarTabPanel.setActiveTab(0);
					master_jual_rawat_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	
	/* Function for retrieve create Window Form */
	master_jual_rawat_createWindow= new Ext.Window({
		id: 'master_jual_rawat_createWindow',
//		title: post2db+'Master_jual_rawat',
		title: post2db+'Penjualan Perawatan',
		closable:true,
		closeAction: 'hide',
		//autoWidth: true,
		width:965,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_jual_rawat_create',
		items: master_jual_rawat_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function master_jual_rawat_list_search(){
		// render according to a SQL date format.
		var jrawat_id_search=null;
		var jrawat_nobukti_search=null;
		var jrawat_cust_search=null;
		var jrawat_diskon_search=null;
		var jrawat_cara_search=null;
		var jrawat_keterangan_search=null;
		var jrawat_statdok_search=null;
		var jrawat_tgl_start_search="";
		var jrawat_tgl_end_search="";

		if(jrawat_idSearchField.getValue()!==null){jrawat_id_search=jrawat_idSearchField.getValue();}
		if(jrawat_nobuktiSearchField.getValue()!==null){jrawat_nobukti_search=jrawat_nobuktiSearchField.getValue();}
		if(jrawat_custSearchField.getValue()!==null){jrawat_cust_search=jrawat_custSearchField.getValue();}
		if(jrawat_diskonSearchField.getValue()!==null){jrawat_diskon_search=jrawat_diskonSearchField.getValue();}
		if(jrawat_caraSearchField.getValue()!==null){jrawat_cara_search=jrawat_caraSearchField.getValue();}
		if(jrawat_keteranganSearchField.getValue()!==null){jrawat_keterangan_search=jrawat_keteranganSearchField.getValue();}
		if(jrawat_statdokSearchField.getValue()!==null){jrawat_statdok_search=jrawat_statdokSearchField.getValue();}
		if(Ext.getCmp('jrawat_tanggalStartAppSearchField').getValue()!==""){jrawat_tgl_start_search=Ext.getCmp('jrawat_tanggalStartAppSearchField').getValue().format('Y-m-d');}
		if(Ext.getCmp('jrawat_tanggalEndAppSearchField').getValue()!==""){jrawat_tgl_end_search=Ext.getCmp('jrawat_tanggalEndAppSearchField').getValue().format('Y-m-d');}
		// change the store parameters
		master_jual_rawat_DataStore.baseParams = {
			task: 'SEARCH',
			start: 0,
			limit: pageS,
			//variable here
			jrawat_id	:	jrawat_id_search, 
			jrawat_nobukti	:	jrawat_nobukti_search, 
			jrawat_cust	:	jrawat_cust_search, 
			jrawat_diskon	:	jrawat_diskon_search, 
			jrawat_cara	:	jrawat_cara_search, 
			jrawat_keterangan	:	jrawat_keterangan_search,
			jrawat_stat_dok		:	jrawat_statdok_search,
			jrawat_tgl_start	: 	jrawat_tgl_start_search,
			jrawat_tgl_end	: 	jrawat_tgl_end_search
		};
		// Cause the datastore to do another query : 
		master_jual_rawat_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_jual_rawat_reset_search(){
		// reset the store parameters
		master_jual_rawat_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_jual_rawat_DataStore.reload({params: {start: 0, limit: pageS}});
		master_jual_rawat_searchWindow.close();
	};
	/* End of Fuction */

	function master_jual_rawat_reset_SearchForm(){
		jrawat_nobuktiSearchField.reset();
		jrawat_nobuktiSearchField.setValue(null);
		jrawat_custSearchField.reset();
		jrawat_custSearchField.setValue(null);
		jrawat_diskonSearchField.reset();
		jrawat_diskonSearchField.setValue(null);
		jrawat_caraSearchField.reset();
		jrawat_caraSearchField.setValue(null);
		jrawat_keteranganSearchField.reset();
		jrawat_keteranganSearchField.setValue(null);
		jrawat_statdokSearchField.reset();
		jrawat_statdokSearchField.setValue(null);
		Ext.getCmp('jrawat_tanggalStartAppSearchField').reset();
		Ext.getCmp('jrawat_tanggalStartAppSearchField').setValue(null);
		Ext.getCmp('jrawat_tanggalEndAppSearchField').reset();
		Ext.getCmp('jrawat_tanggalEndAppSearchField').setValue(null);
	}
	
	/* Field for search */
	/* Identify  jrawat_id Search Field */
	jrawat_idSearchField= new Ext.form.NumberField({
		id: 'jrawat_idSearchField',
		fieldLabel: 'Jrawat Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jrawat_nobukti Search Field */
	jrawat_nobuktiSearchField= new Ext.form.TextField({
		id: 'jrawat_nobuktiSearchField',
		fieldLabel: 'No. Faktur',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  jrawat_cust Search Field */
	jrawat_custSearchField= new Ext.form.ComboBox({
		id: 'jrawat_custSearchField',
		fieldLabel: 'Customer',
		store: cbo_cust_jual_rawat_DataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_jual_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  jrawat_diskon Search Field */
	jrawat_diskonSearchField= new Ext.form.NumberField({
		id: 'jrawat_diskonSearchField',
		fieldLabel: 'Diskon',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		width:94,
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jrawat_cara Search Field */
	jrawat_caraSearchField= new Ext.form.ComboBox({
		id: 'jrawat_caraSearchField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jrawat_cara'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jrawat_cara',
		valueField: 'value',
		width:94,
		triggerAction: 'all'	 
	
	});
	/* Identify  jrawat_keterangan Search Field */
	jrawat_keteranganSearchField= new Ext.form.TextArea({
		id: 'jrawat_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	
	jrawat_statdokSearchField= new Ext.form.TextArea({
		id: 'jrawat_statdokSearchField',
		fieldLabel: 'Status Dokumen',
		maxLength: 250,
		anchor: '95%'
	
	});
	
    
	/* Function for retrieve search Form Panel */
	master_jual_rawat_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 560,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_nobuktiSearchField, jrawat_custSearchField, 
				        {
							layout:'column',
							border:false,
							items:[
					        {
								columnWidth:0.38,
								layout: 'form',
								border:false,
								defaultType: 'datefield',
								items: [
								    {
										fieldLabel: 'Tanggal',
								        name: 'jrawat_tanggalStartAppSearchField',
								        id: 'jrawat_tanggalStartAppSearchField',
								        //vtype: 'daterange',
								        endDateField: 'jrawat_tanggalEndAppSearchField' // id of the end date field
								    }] 
							},
							{
								columnWidth:0.55,
								layout: 'form',
								labelWidth:20,
								border:false,
								defaultType: 'datefield',
								items: [
							      	{
										fieldLabel: 's/d',
								        name: 'jrawat_tanggalEndAppSearchField',
								        id: 'jrawat_tanggalEndAppSearchField',
								        //vtype: 'daterange',
								        startDateField: 'jrawat_tanggalStartAppSearchField' // id of the end date field
								    }] 
							}]
						}
						, jrawat_diskonSearchField, jrawat_caraSearchField, jrawat_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_jual_rawat_list_search
			},{
				text: 'Close',
				handler: function(){
					master_jual_rawat_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_jual_rawat_searchWindow = new Ext.Window({
		title: 'master_jual_rawat Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_jual_rawat_search',
		items: master_jual_rawat_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_jual_rawat_searchWindow.isVisible()){
			master_jual_rawat_reset_SearchForm();
			master_jual_rawat_searchWindow.show();
		} else {
			master_jual_rawat_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_jual_rawat_print(){
		var searchquery = "";
		var jrawat_nobukti_print=null;
		var jrawat_cust_print=null;
		var jrawat_tanggal_print_date="";
		var jrawat_diskon_print=null;
		var jrawat_cara_print=null;
		var jrawat_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_rawat_DataStore.baseParams.query!==null){searchquery = master_jual_rawat_DataStore.baseParams.query;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_nobukti!==null){jrawat_nobukti_print = master_jual_rawat_DataStore.baseParams.jrawat_nobukti;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cust!==null){jrawat_cust_print = master_jual_rawat_DataStore.baseParams.jrawat_cust;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_tanggal!==""){jrawat_tanggal_print_date = master_jual_rawat_DataStore.baseParams.jrawat_tanggal;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_diskon!==null){jrawat_diskon_print = master_jual_rawat_DataStore.baseParams.jrawat_diskon;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cara!==null){jrawat_cara_print = master_jual_rawat_DataStore.baseParams.jrawat_cara;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_keterangan!==null){jrawat_keterangan_print = master_jual_rawat_DataStore.baseParams.jrawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_jual_rawat&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jrawat_nobukti : jrawat_nobukti_print,
			jrawat_cust : jrawat_cust_print,
		  	jrawat_tanggal : jrawat_tanggal_print_date, 
			jrawat_diskon : jrawat_diskon_print,
			jrawat_cara : jrawat_cara_print,
			jrawat_keterangan : jrawat_keterangan_print,
		  	currentlisting: master_jual_rawat_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_jual_rawatlist.html','master_jual_rawatlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_jual_rawat_export_excel(){
		var searchquery = "";
		var jrawat_nobukti_2excel=null;
		var jrawat_cust_2excel=null;
		var jrawat_tanggal_2excel_date="";
		var jrawat_diskon_2excel=null;
		var jrawat_cara_2excel=null;
		var jrawat_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_rawat_DataStore.baseParams.query!==null){searchquery = master_jual_rawat_DataStore.baseParams.query;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_nobukti!==null){jrawat_nobukti_2excel = master_jual_rawat_DataStore.baseParams.jrawat_nobukti;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cust!==null){jrawat_cust_2excel = master_jual_rawat_DataStore.baseParams.jrawat_cust;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_tanggal!==""){jrawat_tanggal_2excel_date = master_jual_rawat_DataStore.baseParams.jrawat_tanggal;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_diskon!==null){jrawat_diskon_2excel = master_jual_rawat_DataStore.baseParams.jrawat_diskon;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cara!==null){jrawat_cara_2excel = master_jual_rawat_DataStore.baseParams.jrawat_cara;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_keterangan!==null){jrawat_keterangan_2excel = master_jual_rawat_DataStore.baseParams.jrawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_jual_rawat&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jrawat_nobukti : jrawat_nobukti_2excel,
			jrawat_cust : jrawat_cust_2excel,
		  	jrawat_tanggal : jrawat_tanggal_2excel_date, 
			jrawat_diskon : jrawat_diskon_2excel,
			jrawat_cara : jrawat_cara_2excel,
			jrawat_keterangan : jrawat_keterangan_2excel,
		  	currentlisting: master_jual_rawat_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	/*function pertamax(){
		post2db="CREATE";
		jrawat_tanggalField.setValue(dt.format('Y-m-d'));
		master_jual_rawat_createForm.render();
	}
	pertamax();*/
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_jual_rawat"></div>
         <div id="fp_detail_jual_rawat"></div>
		 <div id="fp_detail_ambil_paket"></div>
		<div id="elwindow_master_jual_rawat_create"></div>
        <div id="elwindow_master_jual_rawat_search"></div>
<!--        <div id="form_rawat_addEdit"></div>-->
    </div>
</div>
</body>