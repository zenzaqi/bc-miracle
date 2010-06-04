<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_paket View
	+ Description	: For record view
	+ Filename 		: v_master_jual_paket.php
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
var master_jual_paket_DataStore;
var kwitansi_jual_paket_DataStore;
var card_jual_paket_DataStore;
var cek_jual_paket_DataStore;
var transfer_jual_paket_DataStore;
//
var master_jual_paket_ColumnModel;
var master_jual_paketListEditorGrid;
var master_jual_paket_createForm;
var master_jual_paket_createWindow;
var master_jual_paket_searchForm;
var master_jual_paket_searchWindow;
var master_jual_paket_SelectedRow;
var master_jual_paket_ContextMenu;
//for detail data
var detail_jual_paket_DataStore;
var detail_jual_paketListEditorGrid;
var detail_jual_paket_ColumnModel;
var detail_jual_paket_proxy;
var detail_jual_paket_writer;
var detail_jual_paket_reader;
var editor_detail_jual_paket;

//declare konstant
var jpaket_post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var jpaket_idField;
var jpaket_nobuktiField;
var jpaket_custField;
var jpaket_tanggalField;
var jpaket_diskonField;
var jpaket_bayarField;
var jpaket_caraField;
var jpaket_cara2Field;
var jpaket_cara3Field;
var jpaket_keteranganField;
//tunai
var jpaket_tunai_nilaiField;
//tunai-2
var jpaket_tunai_nilai2Field;
//tunai-3
var jpaket_tunai_nilai3Field;
//voucher
var jpaket_voucher_noField;
var jpaket_voucher_cashbackField;
//voucher-2
var jpaket_voucher_no2Field;
var jpaket_voucher_cashback2Field;
//voucher-3
var jpaket_voucher_no3Field;
var jpaket_voucher_cashback3Field;

var jpaket_cashbackField;
var is_member=false;
//kwitansi
var jpaket_kwitansi_namaField;
var jpaket_kwitansi_nilaiField;
var jpaket_kwitansi_noField;
//kwitansi-2
var jpaket_kwitansi_nama2Field;
var jpaket_kwitansi_nilai2Field;
var jpaket_kwitansi_no2Field;
//kwitansi-3
var jpaket_kwitansi_nama3Field;
var jpaket_kwitansi_nilai3Field;
var jpaket_kwitansi_no3Field;

//card
var jpaket_card_namaField;
var jpaket_card_edcField;
var jpaket_card_noField;
var jpaket_card_nilaiField;
//card-2
var jpaket_card_nama2Field;
var jpaket_card_edc2Field;
var jpaket_card_no2Field;
var jpaket_card_nilai2Field;
//card-3
var jpaket_card_nama3Field;
var jpaket_card_edc3Field;
var jpaket_card_no3Field;
var jpaket_card_nilai3Field;

//cek
var jpaket_cek_namaField;
var jpaket_cek_noField;
var jpaket_cek_validField;
var jpaket_cek_bankField;
var jpaket_cek_nilaiField;
//cek-2
var jpaket_cek_nama2Field;
var jpaket_cek_no2Field;
var jpaket_cek_valid2Field;
var jpaket_cek_bank2Field;
var jpaket_cek_nilai2Field;
//cek-3
var jpaket_cek_nama3Field;
var jpaket_cek_no3Field;
var jpaket_cek_valid3Field;
var jpaket_cek_bank3Field;
var jpaket_cek_nilai3Field;

//transfer
var jpaket_transfer_bankField;
var jpaket_transfer_namaField;
var jpaket_transfer_nilaiField;
//transfer-2
var jpaket_transfer_bank2Field;
var jpaket_transfer_nama2Field;
var jpaket_transfer_nilai2Field;
//transfer-3
var jpaket_transfer_bank3Field;
var jpaket_transfer_nama3Field;
var jpaket_transfer_nilai3Field;

var jpaket_idSearchField;
var jpaket_nobuktiSearchField;
var jpaket_custSearchField;
var jpaket_tanggalSearchField;
var jpaket_tanggal_akhirSearchField;
var jpaket_diskonSearchField;
var jpaket_caraSearchField;
var jpaket_keteranganSearchField;
var jpaket_stat_dokSearchField;
var dt= new Date();

var cetak_jpaket=0;

function jpaket_cetak(master_id){
	Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_master_jual_paket&m=print_paper',
		params: { jpaket_id : master_id}, 
		success: function(response){              
			var result=eval(response.responseText);
			switch(result){
			case 1:
				win = window.open('./jpaket_paper.html','Cetak Penjualan Paket','height=480,width=1240,resizable=1,scrollbars=0, menubar=0');
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
  		//jpaket_bankDataStore.load();
  	    return function(value){
  	        var record = combo.findRecord(combo.valueField, value);
  	        return record ? record.get(combo.displayField) : combo.valueNotFoundText;
  	    }
  	}
  
  	/* Function for Saving inLine Editing */
	function master_jual_paket_update(oGrid_event){
		var jpaket_id_update_pk="";
		var jpaket_nobukti_update=null;
		var jpaket_cust_update=null;
		var jpaket_tanggal_update_date="";
		var jpaket_diskon_update=null;
		var jpaket_cara_update=null;
		var jpaket_keterangan_update=null;
		var jpaket_statdok_update=null;

		jpaket_id_update_pk = oGrid_event.record.data.jpaket_id;
		if(oGrid_event.record.data.jpaket_nobukti!== null){jpaket_nobukti_update = oGrid_event.record.data.jpaket_nobukti;}
		if(oGrid_event.record.data.jpaket_cust!== null){jpaket_cust_update = oGrid_event.record.data.jpaket_cust;}
	 	if(oGrid_event.record.data.jpaket_tanggal!== ""){jpaket_tanggal_update_date =oGrid_event.record.data.jpaket_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jpaket_diskon!== null){jpaket_diskon_update = oGrid_event.record.data.jpaket_diskon;}
		if(oGrid_event.record.data.jpaket_cara!== null){jpaket_cara_update = oGrid_event.record.data.jpaket_cara;}
		if(oGrid_event.record.data.jpaket_keterangan!== null){jpaket_keterangan_update = oGrid_event.record.data.jpaket_keterangan;}
		if(oGrid_event.record.data.jpaket_stat_dok!== null){jpaket_statdok_update = oGrid_event.record.data.jpaket_stat_dok;}

		Ext.Ajax.request({  
			waitMsg: 'Mohon  Tunggu...',
			url: 'index.php?c=c_master_jual_paket&m=get_action',
			params: {
				task: "UPDATE",
				jpaket_id	: jpaket_id_update_pk, 
				jpaket_nobukti	:jpaket_nobukti_update,  
				jpaket_cust	:jpaket_cust_update,  
				jpaket_tanggal	: jpaket_tanggal_update_date, 
				jpaket_diskon	:jpaket_diskon_update,  
				jpaket_cara	:jpaket_cara_update,  
				jpaket_keterangan	:jpaket_keterangan_update,
				jpaket_stat_dok		:jpaket_statdok_update,
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_jual_paket_DataStore.commitChanges();
						master_jual_paket_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the master_jual_paket.',
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
	function master_jual_paket_create(){
		var dpaket_paket_id="";
		for(i=0; i<detail_jual_paket_DataStore.getCount(); i++){
			detail_jual_paket_record=detail_jual_paket_DataStore.getAt(i);
			if(/^\d+$/.test(detail_jual_paket_record.data.dpaket_paket)){
				dpaket_paket_id="ada";
			}
		}
	
		if(is_master_jual_paket_form_valid()&& dpaket_paket_id=="ada" && ((/^\d+$/.test(jpaket_custField.getValue()) && jpaket_post2db=="CREATE") || jpaket_post2db=="UPDATE")){	
		var jpaket_id_create_pk=null; 
		var jpaket_nobukti_create=null; 
		var jpaket_cust_create=null; 
		var jpaket_tanggal_create_date=""; 
		var jpaket_diskon_create=null; 
		var jpaket_cara_create=null; 
		var jpaket_cara2_create=null; 
		var jpaket_cara3_create=null; 
		var jpaket_keterangan_create=null;
		var jpaket_statdok_create=null;
		//tunai
		var jpaket_tunai_nilai_create=null;
		//tunai-2
		var jpaket_tunai_nilai2_create=null;
		//tunai-3
		var jpaket_tunai_nilai3_create=null;
		//voucher
		var jpaket_voucher_no_create=null;
		var jpaket_voucher_cashback_create=null;
		//voucher-2
		var jpaket_voucher_no2_create=null;
		var jpaket_voucher_cashback2_create=null;
		//voucher-3
		var jpaket_voucher_no3_create=null;
		var jpaket_voucher_cashback3_create=null;
		
		var jpaket_cashback_create=null;
		//bayar
		var jpaket_subtotal_create=null;
		var jpaket_total_create=null;
		var jpaket_bayar_create=null;
		var jpaket_hutang_create=null;
		//kwitansi
		var jpaket_kwitansi_nama_create=null;
		var jpaket_kwitansi_nomor_create=null;
		var jpaket_kwitansi_nilai_create=null;
		//kwitansi-2
		var jpaket_kwitansi_nama2_create=null;
		var jpaket_kwitansi_nomor2_create=null;
		var jpaket_kwitansi_nilai2_create=null;
		//kwitansi-3
		var jpaket_kwitansi_nama3_create=null;
		var jpaket_kwitansi_nomor3_create=null;
		var jpaket_kwitansi_nilai3_create=null;
		//card
		var jpaket_card_nama_create=null;
		var jpaket_card_edc_create=null;
		var jpaket_card_no_create=null;
		var jpaket_card_nilai_create=null;
		//card-2
		var jpaket_card_nama2_create=null;
		var jpaket_card_edc2_create=null;
		var jpaket_card_no2_create=null;
		var jpaket_card_nilai2_create=null;
		//card-3
		var jpaket_card_nama3_create=null;
		var jpaket_card_edc3_create=null;
		var jpaket_card_no3_create=null;
		var jpaket_card_nilai3_create=null;
		//cek
		var jpaket_cek_nama_create=null;
		var jpaket_cek_nomor_create=null;
		var jpaket_cek_valid_create="";
		var jpaket_cek_bank_create=null;
		var jpaket_cek_nilai_create=null;
		//cek-2
		var jpaket_cek_nama2_create=null;
		var jpaket_cek_nomor2_create=null;
		var jpaket_cek_valid2_create="";
		var jpaket_cek_bank2_create=null;
		var jpaket_cek_nilai2_create=null;
		//cek-3
		var jpaket_cek_nama3_create=null;
		var jpaket_cek_nomor3_create=null;
		var jpaket_cek_valid3_create="";
		var jpaket_cek_bank3_create=null;
		var jpaket_cek_nilai3_create=null;
		//transfer
		var jpaket_transfer_bank_create=null;
		var jpaket_transfer_nama_create=null;
		var jpaket_transfer_nilai_create=null;
		//transfer-2
		var jpaket_transfer_bank2_create=null;
		var jpaket_transfer_nama2_create=null;
		var jpaket_transfer_nilai2_create=null;
		//transfer-3
		var jpaket_transfer_bank3_create=null;
		var jpaket_transfer_nama3_create=null;
		var jpaket_transfer_nilai3_create=null;
		
		if(jpaket_idField.getValue()!== null){jpaket_id_create_pk = jpaket_idField.getValue();}else{jpaket_id_create_pk=get_pk_id();} 
		if(jpaket_nobuktiField.getValue()!== null){jpaket_nobukti_create = jpaket_nobuktiField.getValue();} 
		if(jpaket_custField.getValue()!== null){jpaket_cust_create = jpaket_custField.getValue();} 
		if(jpaket_tanggalField.getValue()!== ""){jpaket_tanggal_create_date = jpaket_tanggalField.getValue().format('Y-m-d');} 
		if(jpaket_diskonField.getValue()!== null){jpaket_diskon_create = jpaket_diskonField.getValue();} 
		if(jpaket_caraField.getValue()!== null){jpaket_cara_create = jpaket_caraField.getValue();} 
		if(jpaket_cara2Field.getValue()!== null){jpaket_cara2_create = jpaket_cara2Field.getValue();} 
		if(jpaket_cara3Field.getValue()!== null){jpaket_cara3_create = jpaket_cara3Field.getValue();} 
		if(jpaket_keteranganField.getValue()!== null){jpaket_keterangan_create = jpaket_keteranganField.getValue();}
		if(jpaket_stat_dokField.getValue()!== null){jpaket_statdok_create = jpaket_stat_dokField.getValue();} 
		//tunai
		if(jpaket_tunai_nilaiField.getValue()!== null){jpaket_tunai_nilai_create = jpaket_tunai_nilaiField.getValue();}
		//tunai-2
		if(jpaket_tunai_nilai2Field.getValue()!== null){jpaket_tunai_nilai2_create = jpaket_tunai_nilai2Field.getValue();}
		//tunai-3
		if(jpaket_tunai_nilai3Field.getValue()!== null){jpaket_tunai_nilai3_create = jpaket_tunai_nilai3Field.getValue();}
		//voucher
		if(jpaket_voucher_noField.getValue()!== null){jpaket_voucher_no_create = jpaket_voucher_noField.getValue();} 
		if(jpaket_voucher_cashbackField.getValue()!== null){jpaket_voucher_cashback_create = jpaket_voucher_cashbackField.getValue();} 
		//voucher-2
		if(jpaket_voucher_no2Field.getValue()!== null){jpaket_voucher_no2_create = jpaket_voucher_no2Field.getValue();} 
		if(jpaket_voucher_cashback2Field.getValue()!== null){jpaket_voucher_cashback2_create = jpaket_voucher_cashback2Field.getValue();} 
		//voucher-3
		if(jpaket_voucher_no3Field.getValue()!== null){jpaket_voucher_no3_create = jpaket_voucher_no3Field.getValue();} 
		if(jpaket_voucher_cashback3Field.getValue()!== null){jpaket_voucher_cashback3_create = jpaket_voucher_cashback3Field.getValue();} 
		
		if(jpaket_cashbackField.getValue()!== null){jpaket_cashback_create = jpaket_cashbackField.getValue();} 
		//bayar
		if(jpaket_bayarField.getValue()!== null){jpaket_bayar_create = jpaket_bayarField.getValue();}
		if(jpaket_subTotalField.getValue()!== null){jpaket_subtotal_create = jpaket_subTotalField.getValue();} 
		if(jpaket_totalField.getValue()!== null){jpaket_total_create = jpaket_totalField.getValue();} 
		if(jpaket_hutangField.getValue()!== null){jpaket_hutang_create = jpaket_hutangField.getValue();} 
		//kwitansi value
		if(jpaket_kwitansi_noField.getValue()!== null){jpaket_kwitansi_nomor_create = jpaket_kwitansi_noField.getValue();} 
		if(jpaket_kwitansi_namaField.getValue()!== null){jpaket_kwitansi_nama_create = jpaket_kwitansi_namaField.getValue();} 
		if(jpaket_kwitansi_nilaiField.getValue()!== null){jpaket_kwitansi_nilai_create = jpaket_kwitansi_nilaiField.getValue();} 
		//kwitansi-2 value
		if(jpaket_kwitansi_no2Field.getValue()!== null){jpaket_kwitansi_nomor2_create = jpaket_kwitansi_no2Field.getValue();} 
		if(jpaket_kwitansi_nama2Field.getValue()!== null){jpaket_kwitansi_nama2_create = jpaket_kwitansi_nama2Field.getValue();} 
		if(jpaket_kwitansi_nilai2Field.getValue()!== null){jpaket_kwitansi_nilai2_create = jpaket_kwitansi_nilai2Field.getValue();} 
		//kwitansi-3 value
		if(jpaket_kwitansi_no3Field.getValue()!== null){jpaket_kwitansi_nomor3_create = jpaket_kwitansi_no3Field.getValue();} 
		if(jpaket_kwitansi_nama3Field.getValue()!== null){jpaket_kwitansi_nama3_create = jpaket_kwitansi_nama3Field.getValue();} 
		if(jpaket_kwitansi_nilai3Field.getValue()!== null){jpaket_kwitansi_nilai3_create = jpaket_kwitansi_nilai3Field.getValue();} 
		//card value
		if(jpaket_card_namaField.getValue()!== null){jpaket_card_nama_create = jpaket_card_namaField.getValue();} 
		if(jpaket_card_edcField.getValue()!==null){jpaket_card_edc_create = jpaket_card_edcField.getValue();} 
		if(jpaket_card_noField.getValue()!==null){jpaket_card_no_create = jpaket_card_noField.getValue();}
		if(jpaket_card_nilaiField.getValue()!==null){jpaket_card_nilai_create = jpaket_card_nilaiField.getValue();} 
		//card-2 value
		if(jpaket_card_nama2Field.getValue()!== null){jpaket_card_nama2_create = jpaket_card_nama2Field.getValue();} 
		if(jpaket_card_edc2Field.getValue()!==null){jpaket_card_edc2_create = jpaket_card_edc2Field.getValue();} 
		if(jpaket_card_no2Field.getValue()!==null){jpaket_card_no2_create = jpaket_card_no2Field.getValue();}
		if(jpaket_card_nilai2Field.getValue()!==null){jpaket_card_nilai2_create = jpaket_card_nilai2Field.getValue();} 
		//card-3 value
		if(jpaket_card_nama3Field.getValue()!== null){jpaket_card_nama3_create = jpaket_card_nama3Field.getValue();} 
		if(jpaket_card_edc3Field.getValue()!==null){jpaket_card_edc3_create = jpaket_card_edc3Field.getValue();} 
		if(jpaket_card_no3Field.getValue()!==null){jpaket_card_no3_create = jpaket_card_no3Field.getValue();}
		if(jpaket_card_nilai3Field.getValue()!==null){jpaket_card_nilai3_create = jpaket_card_nilai3Field.getValue();} 
		//cek value
		if(jpaket_cek_namaField.getValue()!== null){jpaket_cek_nama_create = jpaket_cek_namaField.getValue();} 
		if(jpaket_cek_noField.getValue()!== null){jpaket_cek_nomor_create = jpaket_cek_noField.getValue();} 
		if(jpaket_cek_validField.getValue()!== ""){jpaket_cek_valid_create = jpaket_cek_validField.getValue().format('Y-m-d');} 
		if(jpaket_cek_bankField.getValue()!== null){jpaket_cek_bank_create = jpaket_cek_bankField.getValue();} 
		if(jpaket_cek_nilaiField.getValue()!== null){jpaket_cek_nilai_create = jpaket_cek_nilaiField.getValue();} 
		//cek-2 value
		if(jpaket_cek_nama2Field.getValue()!== null){jpaket_cek_nama2_create = jpaket_cek_nama2Field.getValue();} 
		if(jpaket_cek_no2Field.getValue()!== null){jpaket_cek_nomor2_create = jpaket_cek_no2Field.getValue();} 
		if(jpaket_cek_valid2Field.getValue()!== ""){jpaket_cek_valid2_create = jpaket_cek_valid2Field.getValue().format('Y-m-d');} 
		if(jpaket_cek_bank2Field.getValue()!== null){jpaket_cek_bank2_create = jpaket_cek_bank2Field.getValue();} 
		if(jpaket_cek_nilai2Field.getValue()!== null){jpaket_cek_nilai2_create = jpaket_cek_nilai2Field.getValue();} 
		//cek-3 value
		if(jpaket_cek_nama3Field.getValue()!== null){jpaket_cek_nama3_create = jpaket_cek_nama3Field.getValue();} 
		if(jpaket_cek_no3Field.getValue()!== null){jpaket_cek_nomor3_create = jpaket_cek_no3Field.getValue();} 
		if(jpaket_cek_valid3Field.getValue()!== ""){jpaket_cek_valid3_create = jpaket_cek_valid3Field.getValue().format('Y-m-d');} 
		if(jpaket_cek_bank3Field.getValue()!== null){jpaket_cek_bank3_create = jpaket_cek_bank3Field.getValue();} 
		if(jpaket_cek_nilai3Field.getValue()!== null){jpaket_cek_nilai3_create = jpaket_cek_nilai3Field.getValue();} 
		//transfer value
		if(jpaket_transfer_bankField.getValue()!== null){jpaket_transfer_bank_create = jpaket_transfer_bankField.getValue();} 
		if(jpaket_transfer_namaField.getValue()!== null){jpaket_transfer_nama_create = jpaket_transfer_namaField.getValue();}
		if(jpaket_transfer_nilaiField.getValue()!== null){jpaket_transfer_nilai_create = jpaket_transfer_nilaiField.getValue();} 
		//transfer-2 value
		if(jpaket_transfer_bank2Field.getValue()!== null){jpaket_transfer_bank2_create = jpaket_transfer_bank2Field.getValue();} 
		if(jpaket_transfer_nama2Field.getValue()!== null){jpaket_transfer_nama2_create = jpaket_transfer_nama2Field.getValue();}
		if(jpaket_transfer_nilai2Field.getValue()!== null){jpaket_transfer_nilai2_create = jpaket_transfer_nilai2Field.getValue();} 
		//transfer-3 value
		if(jpaket_transfer_bank3Field.getValue()!== null){jpaket_transfer_bank3_create = jpaket_transfer_bank3Field.getValue();} 
		if(jpaket_transfer_nama3Field.getValue()!== null){jpaket_transfer_nama3_create = jpaket_transfer_nama3Field.getValue();}
		if(jpaket_transfer_nilai3Field.getValue()!== null){jpaket_transfer_nilai3_create = jpaket_transfer_nilai3Field.getValue();} 
		
		Ext.Ajax.request({  
			waitMsg: 'Mohon  Tunggu...',
			url: 'index.php?c=c_master_jual_paket&m=get_action',
			params: {
				task: jpaket_post2db,
				jpaket_id			: 	jpaket_id_create_pk, 
				jpaket_nobukti		: 	jpaket_nobukti_create, 
				jpaket_cust		: 	jpaket_cust_create, 
				jpaket_tanggal		: 	jpaket_tanggal_create_date, 
				jpaket_diskon		: 	jpaket_diskon_create, 
				jpaket_cara		: 	jpaket_cara_create, 
				jpaket_cara2		: 	jpaket_cara2_create, 
				jpaket_cara3		: 	jpaket_cara3_create, 
				jpaket_keterangan	: 	jpaket_keterangan_create,
				jpaket_stat_dok		:	jpaket_statdok_create,
				jpaket_cashback	: 	jpaket_cashback_create,
				//tunai
				jpaket_tunai_nilai	:	jpaket_tunai_nilai_create,
				//tunai-2
				jpaket_tunai_nilai2	:	jpaket_tunai_nilai2_create,
				//tunai-3
				jpaket_tunai_nilai3	:	jpaket_tunai_nilai3_create,
				//voucher
				jpaket_voucher_no	:	jpaket_voucher_no_create,
				jpaket_voucher_cashback	:	jpaket_voucher_cashback_create,
				//voucher-2
				jpaket_voucher_no2	:	jpaket_voucher_no2_create,
				jpaket_voucher_cashback2	:	jpaket_voucher_cashback2_create,
				//voucher-3
				jpaket_voucher_no3	:	jpaket_voucher_no3_create,
				jpaket_voucher_cashback3	:	jpaket_voucher_cashback3_create,
				
				jpaket_voucher_cashback	:	jpaket_voucher_cashback_create,
				//bayar
				jpaket_bayar			: 	jpaket_bayar_create,
				jpaket_subtotal			: 	jpaket_subtotal_create,
				jpaket_total			: 	jpaket_total_create,
				jpaket_hutang		: 	jpaket_hutang_create,
				//kwitansi posting
				jpaket_kwitansi_no		:	jpaket_kwitansi_nomor_create,
				jpaket_kwitansi_nama		:	jpaket_kwitansi_nama_create,
				jpaket_kwitansi_nilai		:	jpaket_kwitansi_nilai_create,
				//kwitansi-2 posting
				jpaket_kwitansi_no2		:	jpaket_kwitansi_nomor2_create,
				jpaket_kwitansi_nama2		:	jpaket_kwitansi_nama2_create,
				jpaket_kwitansi_nilai2		:	jpaket_kwitansi_nilai2_create,
				//kwitansi-3 posting
				jpaket_kwitansi_no3		:	jpaket_kwitansi_nomor3_create,
				jpaket_kwitansi_nama3		:	jpaket_kwitansi_nama3_create,
				jpaket_kwitansi_nilai3		:	jpaket_kwitansi_nilai3_create,
				//card posting
				jpaket_card_nama	: 	jpaket_card_nama_create,
				jpaket_card_edc	:	jpaket_card_edc_create,
				jpaket_card_no		:	jpaket_card_no_create,
				jpaket_card_nilai	:	jpaket_card_nilai_create,
				//card-2 posting
				jpaket_card_nama2	: 	jpaket_card_nama2_create,
				jpaket_card_edc2	:	jpaket_card_edc2_create,
				jpaket_card_no2	:	jpaket_card_no2_create,
				jpaket_card_nilai2	:	jpaket_card_nilai2_create,
				//card-3 posting
				jpaket_card_nama3	: 	jpaket_card_nama3_create,
				jpaket_card_edc3	:	jpaket_card_edc3_create,
				jpaket_card_no3	:	jpaket_card_no3_create,
				jpaket_card_nilai3	:	jpaket_card_nilai3_create,
				//cek posting
				jpaket_cek_nama	: 	jpaket_cek_nama_create,
				jpaket_cek_no		:	jpaket_cek_nomor_create,
				jpaket_cek_valid	: 	jpaket_cek_valid_create,
				jpaket_cek_bank	:	jpaket_cek_bank_create,
				jpaket_cek_nilai	:	jpaket_cek_nilai_create,
				//cek-2 posting
				jpaket_cek_nama2	: 	jpaket_cek_nama2_create,
				jpaket_cek_no2		:	jpaket_cek_nomor2_create,
				jpaket_cek_valid2	: 	jpaket_cek_valid2_create,
				jpaket_cek_bank2	:	jpaket_cek_bank2_create,
				jpaket_cek_nilai2	:	jpaket_cek_nilai2_create,
				//cek-3 posting
				jpaket_cek_nama3	: 	jpaket_cek_nama3_create,
				jpaket_cek_no3		:	jpaket_cek_nomor3_create,
				jpaket_cek_valid3	: 	jpaket_cek_valid3_create,
				jpaket_cek_bank3	:	jpaket_cek_bank3_create,
				jpaket_cek_nilai3	:	jpaket_cek_nilai3_create,
				//transfer posting
				jpaket_transfer_bank	:	jpaket_transfer_bank_create,
				jpaket_transfer_nama	:	jpaket_transfer_nama_create,
				jpaket_transfer_nilai	:	jpaket_transfer_nilai_create,
				//transfer-2 posting
				jpaket_transfer_bank2	:	jpaket_transfer_bank2_create,
				jpaket_transfer_nama2	:	jpaket_transfer_nama2_create,
				jpaket_transfer_nilai2	:	jpaket_transfer_nilai2_create,
				//transfer-3 posting
				jpaket_transfer_bank3	:	jpaket_transfer_bank3_create,
				jpaket_transfer_nama3	:	jpaket_transfer_nama3_create,
				jpaket_transfer_nilai3	:	jpaket_transfer_nilai3_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_jual_paket_purge();
						detail_pengguna_paket_purge();
						/*detail_pengguna_paket_insert();
						Ext.MessageBox.alert('OK', 'Data penjualan paket berhasil disimpan');*/
						//detail_jual_paket_DataStore.load({params: {master_id:0}});
						//detail_pengguna_paket_DataStore.load({params: {master_id:0}});
						master_jual_paket_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   //msg: 'We could\'t not '+msg+' the Master_jual_paket.',
						   msg: 'Data penjualan paket tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
				}
				master_jual_paket_reset_allForm();
				jpaket_caraField.setValue("card");
				master_jual_paket_cardGroup.setVisible(true);
				master_cara_bayarTabPanel.setActiveTab(0);
				//jpaket_post2db="CREATE";
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
	
	function save_andPrint(){
		cetak_jpaket=1;
		master_jual_paket_create();
	}
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(jpaket_post2db=='UPDATE'){
			return master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_id');
		}else 
			return 0;
	}
	/* End of Function  */
	
	// Reset kwitansi option
	function kwitansi_jual_paket_reset_form(){
		jpaket_kwitansi_namaField.reset();
		jpaket_kwitansi_nilaiField.reset();
		jpaket_kwitansi_noField.reset();
	}
	// Reset kwitansi-2 option
	function kwitansi2_jual_paket_reset_form(){
		jpaket_kwitansi_nama2Field.reset();
		jpaket_kwitansi_nilai2Field.reset();
		jpaket_kwitansi_no2Field.reset();
	}
	// Reset kwitansi-3 option
	function kwitansi3_jual_paket_reset_form(){
		jpaket_kwitansi_nama3Field.reset();
		jpaket_kwitansi_nilai3Field.reset();
		jpaket_kwitansi_no3Field.reset();
	}
	
	// Reset card option
	function card_jual_paket_reset_form(){
		jpaket_card_namaField.reset();
		jpaket_card_edcField.reset();
		jpaket_card_noField.reset();
		jpaket_card_nilaiField.reset();
	}
	// Reset card-2 option
	function card2_jual_paket_reset_form(){
		jpaket_card_nama2Field.reset();
		jpaket_card_edc2Field.reset();
		jpaket_card_no2Field.reset();
		jpaket_card_nilai2Field.reset();
	}
	// Reset card-3 option
	function card3_jual_paket_reset_form(){
		jpaket_card_nama3Field.reset();
		jpaket_card_edc3Field.reset();
		jpaket_card_no3Field.reset();
		jpaket_card_nilai3Field.reset();
	}
	
	// Reset cek option
	function cek_jual_paket_reset_form(){
		jpaket_cek_namaField.reset();
		jpaket_cek_noField.reset();
		jpaket_cek_validField.reset();
		jpaket_cek_bankField.reset();
		jpaket_cek_nilaiField.reset();
	}
	// Reset cek-2 option
	function cek2_jual_paket_reset_form(){
		jpaket_cek_nama2Field.reset();
		jpaket_cek_no2Field.reset();
		jpaket_cek_valid2Field.reset();
		jpaket_cek_bank2Field.reset();
		jpaket_cek_nilai2Field.reset();
	}
	// Reset cek-3 option
	function cek3_jual_paket_reset_form(){
		jpaket_cek_nama3Field.reset();
		jpaket_cek_no3Field.reset();
		jpaket_cek_valid3Field.reset();
		jpaket_cek_bank3Field.reset();
		jpaket_cek_nilai3Field.reset();
	}
	
	// Reset transfer option
	function transfer_jual_paket_reset_form(){
		jpaket_transfer_bankField.reset();
		jpaket_transfer_namaField.reset();
		jpaket_transfer_nilaiField.reset();
	}
	// Reset transfer-2 option
	function transfer2_jual_paket_reset_form(){
		jpaket_transfer_bank2Field.reset();
		jpaket_transfer_nama2Field.reset();
		jpaket_transfer_nilai2Field.reset();
	}
	// Reset transfer-3 option
	function transfer3_jual_paket_reset_form(){
		jpaket_transfer_bank3Field.reset();
		jpaket_transfer_nama3Field.reset();
		jpaket_transfer_nilai3Field.reset();
	}

	// Reset tunai option
	function tunai_jual_paket_reset_form(){
		jpaket_tunai_nilaiField.reset();
	}
	// Reset tunai-2 option
	function tunai2_jual_paket_reset_form(){
		jpaket_tunai_nilai2Field.reset();
	}
	// Reset tunai-3 option
	function tunai3_jual_paket_reset_form(){
		jpaket_tunai_nilai3Field.reset();
	}

	//Reset voucher option
	function voucher_jual_paket_reset_form(){
		jpaket_voucher_noField.reset();
		jpaket_voucher_cashbackField.reset();
	}
	//Reset voucher-2 option
	function voucher2_jual_paket_reset_form(){
		jpaket_voucher_no2Field.reset();
		jpaket_voucher_cashback2Field.reset();
	}
	//Reset voucher-3 option
	function voucher3_jual_paket_reset_form(){
		jpaket_voucher_no3Field.reset();
		jpaket_voucher_cashback3Field.reset();
	}
	
	/* Reset form before loading */
	function master_jual_paket_reset_form(){
		jpaket_idField.reset();
		jpaket_idField.setValue(null);
		jpaket_nobuktiField.reset();
		jpaket_nobuktiField.setValue(null);
		jpaket_custField.reset();
		jpaket_custField.setValue(null);
		jpaket_cust_nomemberField.reset();
		jpaket_cust_nomemberField.setValue(null);
		jpaket_tanggalField.setValue(dt.format('Y-m-d'));
		jpaket_diskonField.reset();
		jpaket_diskonField.setValue(null);
		jpaket_caraField.reset();
		jpaket_caraField.setValue(null);
		jpaket_cara2Field.reset();
		jpaket_cara2Field.setValue(null);
		jpaket_cara3Field.reset();
		jpaket_cara3Field.setValue(null);
		jpaket_cashbackField.reset();
		jpaket_cashbackField.setValue(null);
		jpaket_cashback_cfField.reset();
		jpaket_cashback_cfField.setValue(null);
		
		jpaket_keteranganField.reset();
		jpaket_keteranganField.setValue(null);
		
		jpaket_stat_dokField.reset();
		jpaket_stat_dokField.setValue('Terbuka');
		
		jpaket_subTotalField.reset();
		jpaket_subTotalField.setValue(null);

		jpaket_totalField.reset();
		jpaket_totalField.setValue(null);

		jpaket_hutangField.reset();
		jpaket_hutangField.setValue(null);

		jpaket_jumlahField.reset();
		jpaket_jumlahField.setValue(null);

		tunai_jual_paket_reset_form();
		tunai2_jual_paket_reset_form();
		tunai3_jual_paket_reset_form();

		kwitansi_jual_paket_reset_form();
		kwitansi2_jual_paket_reset_form();
		kwitansi3_jual_paket_reset_form();

		card_jual_paket_reset_form();
		card2_jual_paket_reset_form();
		card3_jual_paket_reset_form();

		cek_jual_paket_reset_form();
		cek2_jual_paket_reset_form();
		cek3_jual_paket_reset_form();

		transfer_jual_paket_reset_form();
		transfer2_jual_paket_reset_form();
		transfer3_jual_paket_reset_form();

		voucher_jual_paket_reset_form();
		voucher2_jual_paket_reset_form();
		voucher3_jual_paket_reset_form();

		update_group_carabayar_jual_paket();
		update_group_carabayar2_jual_paket();
		update_group_carabayar3_jual_paket();
		//load_total_paket_bayar();

		jpaket_bayarField.reset();
		jpaket_bayarField.setValue(null);
		
		/* Enable if jpaket_post2db="CREATE" */
		jpaket_custField.setDisabled(false);
		jpaket_tanggalField.setDisabled(false);
		jpaket_custField.setDisabled(false);
		jpaket_custField.setDisabled(false);
		jpaket_tanggalField.setDisabled(false);
		jpaket_keteranganField.setDisabled(false);
		master_cara_bayarTabPanel.setDisabled(false);
		detail_jual_paketListEditorGrid.setDisabled(false);
		detail_pengguna_paketListEditorGrid.setDisabled(false);
		jpaket_diskonField.setDisabled(false);
		jpaket_cashback_cfField.setDisabled(false);
	}
 	/* End of Function */
	
	function master_jual_paket_reset_allForm(){
		master_jual_paket_reset_form();
		
	}
    
	/* setValue to EDIT */
	function master_jual_paket_set_form(){
		var hutang_temp=0;
		
		var subtotal_field=0;
		var dpaket_jumlah_field=0;
		var total_field=0;
		var hutang_field=0;
		var diskon_field=0;
		var cashback_field=0;
		
		//master_jual_paket_reset_form();
		jpaket_idField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_id'));
		jpaket_nobuktiField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_nobukti'));
		jpaket_cust_idField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cust_id'));
		jpaket_custField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cust'));
		jpaket_tanggalField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_tanggal'));
		jpaket_diskonField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_diskon'));
		jpaket_cashbackField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cashback'));
		jpaket_cashback_cfField.setValue(CurrencyFormatted(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cashback')));
		jpaket_caraField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cara'));
		jpaket_cara2Field.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cara2'));
		jpaket_cara3Field.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cara3'));
		jpaket_bayarField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_bayar'));

		jpaket_keteranganField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_keterangan'));
		jpaket_stat_dokField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_stat_dok'));
		
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){
			subtotal_field+=detail_jual_paket_DataStore.getAt(i).data.dpaket_subtotal_net;
			dpaket_jumlah_field+=detail_jual_paket_DataStore.getAt(i).data.dpaket_jumlah;
		}
		
		if(jpaket_diskonField.getValue()!==""){
			diskon_field=jpaket_diskonField.getValue();
		}
		if(jpaket_cashbackField.getValue()!==""){
			cashback_field=jpaket_cashbackField.getValue();
		}
		total_field=subtotal_field*(100-diskon_field)/100-cashback_field;
		
		jpaket_jumlahField.setValue(dpaket_jumlah_field);
		jpaket_subTotalField.setValue(subtotal_field);
		
		jpaket_totalField.setValue(total_field);
		
		hutang_temp=total_field-jpaket_bayarField.getValue();
		jpaket_hutangField.setValue(hutang_temp);
		
		load_membership();
		update_group_carabayar_jual_paket();
		update_group_carabayar2_jual_paket();
		update_group_carabayar3_jual_paket();
		
		switch(jpaket_caraField.getValue()){
			case 'kwitansi':
				kwitansi_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_paket_DataStore.getCount()){
								jpaket_kwitansi_record=kwitansi_jual_paket_DataStore.getAt(0).data;
								jpaket_kwitansi_noField.setValue(jpaket_kwitansi_record.kwitansi_no);
								jpaket_kwitansi_namaField.setValue(jpaket_kwitansi_record.cust_nama);
								jpaket_kwitansi_nilaiField.setValue(jpaket_kwitansi_record.jkwitansi_nilai);
								jpaket_kwitansi_nilai_cfField.setValue(CurrencyFormatted(jpaket_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							if(card_jual_paket_DataStore.getCount()){
								jpaket_card_record=card_jual_paket_DataStore.getAt(0).data;
								jpaket_card_namaField.setValue(jpaket_card_record.jcard_nama);
								jpaket_card_edcField.setValue(jpaket_card_record.jcard_edc);
								jpaket_card_noField.setValue(jpaket_card_record.jcard_no);
								jpaket_card_nilaiField.setValue(jpaket_card_record.jcard_nilai);
								jpaket_card_nilai_cfField.setValue(CurrencyFormatted(jpaket_card_record.jcard_nilai));
							}
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_paket_DataStore.getCount()){
									jpaket_cek_record=cek_jual_paket_DataStore.getAt(0).data;
									jpaket_cek_namaField.setValue(jpaket_cek_record.jcek_nama);
									jpaket_cek_noField.setValue(jpaket_cek_record.jcek_no);
									jpaket_cek_validField.setValue(jpaket_cek_record.jcek_valid);
									jpaket_cek_bankField.setValue(jpaket_cek_record.jcek_bank);
									jpaket_cek_nilaiField.setValue(jpaket_cek_record.jcek_nilai);
									jpaket_cek_nilai_cfField.setValue(CurrencyFormatted(jpaket_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jual_paket_DataStore.load({
						params : { no_faktur: jpaket_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(transfer_jual_paket_DataStore.getCount()){
										jpaket_transfer_record=transfer_jual_paket_DataStore.getAt(0);
										jpaket_transfer_bankField.setValue(jpaket_transfer_record.data.jtransfer_bank);
										jpaket_transfer_namaField.setValue(jpaket_transfer_record.data.jtransfer_nama);
										jpaket_transfer_nilaiField.setValue(jpaket_transfer_record.data.jtransfer_nilai);
										jpaket_transfer_nilai_cfField.setValue(CurrencyFormatted(jpaket_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_paket_DataStore.load({
						params : { no_faktur: jpaket_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_paket_DataStore.getCount()){
										jpaket_tunai_record=tunai_jual_paket_DataStore.getAt(0);
										jpaket_tunai_nilaiField.setValue(jpaket_tunai_record.data.jtunai_nilai);
										jpaket_tunai_nilai_cfField.setValue(CurrencyFormatted(jpaket_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
		}

		switch(jpaket_cara2Field.getValue()){
			case 'kwitansi':
				kwitansi_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_paket_DataStore.getCount()){
								jpaket_kwitansi_record=kwitansi_jual_paket_DataStore.getAt(0).data;
								jpaket_kwitansi_no2Field.setValue(jpaket_kwitansi_record.kwitansi_no);
								jpaket_kwitansi_nama2Field.setValue(jpaket_kwitansi_record.cust_nama);
								jpaket_kwitansi_nilai2Field.setValue(jpaket_kwitansi_record.jkwitansi_nilai);
								jpaket_kwitansi_nilai2_cfField.setValue(CurrencyFormatted(jpaket_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							 if(card_jual_paket_DataStore.getCount()){
								 jpaket_card_record=card_jual_paket_DataStore.getAt(0).data;
								 jpaket_card_nama2Field.setValue(jpaket_card_record.jcard_nama);
								 jpaket_card_edc2Field.setValue(jpaket_card_record.jcard_edc);
								 jpaket_card_no2Field.setValue(jpaket_card_record.jcard_no);
								 jpaket_card_nilai2Field.setValue(jpaket_card_record.jcard_nilai);
								 jpaket_card_nilai2_cfField.setValue(CurrencyFormatted(jpaket_card_record.jcard_nilai));
							 }
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_paket_DataStore.getCount()){
									jpaket_cek_record=cek_jual_paket_DataStore.getAt(0).data;
									jpaket_cek_nama2Field.setValue(jpaket_cek_record.jcek_nama);
									jpaket_cek_no2Field.setValue(jpaket_cek_record.jcek_no);
									jpaket_cek_valid2Field.setValue(jpaket_cek_record.jcek_valid);
									jpaket_cek_bank2Field.setValue(jpaket_cek_record.jcek_bank);
									jpaket_cek_nilai2Field.setValue(jpaket_cek_record.jcek_nilai);
									jpaket_cek_nilai2_cfField.setValue(CurrencyFormatted(jpaket_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jual_paket_DataStore.load({
						params : { no_faktur: jpaket_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
								jpaket_transfer_record=transfer_jual_paket_DataStore.getAt(0);
									if(transfer_jual_paket_DataStore.getCount()){
										jpaket_transfer_record=transfer_jual_paket_DataStore.getAt(0);
										jpaket_transfer_bank2Field.setValue(jpaket_transfer_record.data.jtransfer_bank);
										jpaket_transfer_nama2Field.setValue(jpaket_transfer_record.data.jtransfer_nama);
										jpaket_transfer_nilai2Field.setValue(jpaket_transfer_record.data.jtransfer_nilai);
										jpaket_transfer_nilai2_cfField.setValue(CurrencyFormatted(jpaket_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_paket_DataStore.load({
						params : { no_faktur: jpaket_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_paket_DataStore.getCount()){
										jpaket_tunai_record=tunai_jual_paket_DataStore.getAt(0);
										jpaket_tunai_nilai2Field.setValue(jpaket_tunai_record.data.jtunai_nilai);
										jpaket_tunai_nilai2_cfField.setValue(CurrencyFormatted(jpaket_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
		}

		switch(jpaket_cara3Field.getValue()){
			case 'kwitansi':
				kwitansi_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_paket_DataStore.getCount()){
								jpaket_kwitansi_record=kwitansi_jual_paket_DataStore.getAt(0).data;
								jpaket_kwitansi_no3Field.setValue(jpaket_kwitansi_record.kwitansi_no);
								jpaket_kwitansi_nama3Field.setValue(jpaket_kwitansi_record.cust_nama);
								jpaket_kwitansi_nilai3Field.setValue(jpaket_kwitansi_record.jkwitansi_nilai);
								jpaket_kwitansi_nilai3_cfField.setValue(CurrencyFormatted(jpaket_kwitansi_record.jkwitansi_nilai));
							}
						  }
					  }
				});
				break;
			case 'card' :
				card_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) { 
							 if(card_jual_paket_DataStore.getCount()){
								 jpaket_card_record=card_jual_paket_DataStore.getAt(0).data;
								 jpaket_card_nama3Field.setValue(jpaket_card_record.jcard_nama);
								 jpaket_card_edc3Field.setValue(jpaket_card_record.jcard_edc);
								 jpaket_card_no3Field.setValue(jpaket_card_record.jcard_no);
								 jpaket_card_nilai3Field.setValue(jpaket_card_record.jcard_nilai);
								 jpaket_card_nilai3_cfField.setValue(CurrencyFormatted(jpaket_card_record.jcard_nilai));
							 }
						 }
					}
				});
				break;
			case 'cek/giro':
				cek_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
							if (success) {
								if(cek_jual_paket_DataStore.getCount()){
									jpaket_cek_record=cek_jual_paket_DataStore.getAt(0).data;
									jpaket_cek_nama3Field.setValue(jpaket_cek_record.jcek_nama);
									jpaket_cek_no3Field.setValue(jpaket_cek_record.jcek_no);
									jpaket_cek_valid3Field.setValue(jpaket_cek_record.jcek_valid);
									jpaket_cek_bank3Field.setValue(jpaket_cek_record.jcek_bank);
									jpaket_cek_nilai3Field.setValue(jpaket_cek_record.jcek_nilai);
									jpaket_cek_nilai3_cfField.setValue(CurrencyFormatted(jpaket_cek_record.jcek_nilai));
								}
							}
					 	}
				  });
				break;								
			case 'transfer' :
				transfer_jual_paket_DataStore.load({
						params : { no_faktur: jpaket_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
								jpaket_transfer_record=transfer_jual_paket_DataStore.getAt(0);
									if(transfer_jual_paket_DataStore.getCount()){
										jpaket_transfer_record=transfer_jual_paket_DataStore.getAt(0);
										jpaket_transfer_bank3Field.setValue(jpaket_transfer_record.data.jtransfer_bank);
										jpaket_transfer_nama3Field.setValue(jpaket_transfer_record.data.jtransfer_nama);
										jpaket_transfer_nilai3Field.setValue(jpaket_transfer_record.data.jtransfer_nilai);
										jpaket_transfer_nilai3_cfField.setValue(CurrencyFormatted(jpaket_transfer_record.data.jtransfer_nilai));
									}
							}
					 	}
				  });
				break;
			case 'tunai' :
				tunai_jual_paket_DataStore.load({
						params : { no_faktur: jpaket_nobuktiField.getValue() },
					  	callback: function(opts, success, response)  {
							if (success) {
									if(tunai_jual_paket_DataStore.getCount()){
										jpaket_tunai_record=tunai_jual_paket_DataStore.getAt(0);
										jpaket_tunai_nilai3Field.setValue(jpaket_tunai_record.data.jtunai_nilai);
										jpaket_tunai_nilai3_cfField.setValue(CurrencyFormatted(jpaket_tunai_record.data.jtunai_nilai));
									}
							}
					 	}
				  });
				break;
		}
		
		//detail_jual_paket_DataStore.load({params:{master_id: jpaket_idField.getValue()}});
	}
	/* End setValue to EDIT*/
	
	
	/*Function utk mengnon-aktifkan beberapa field ketika status dok diganti Tertutup*/
	function master_jual_paket_set_updating(){
		if(jpaket_post2db=="UPDATE" && master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_stat_dok')=="Terbuka"){
			jpaket_custField.setDisabled(false);
			jpaket_tanggalField.setDisabled(false);
			jpaket_keteranganField.setDisabled(false);
			master_cara_bayarTabPanel.setDisabled(false);
			detail_jual_paketListEditorGrid.setDisabled(false);
			detail_pengguna_paketListEditorGrid.setDisabled(false);
			jpaket_diskonField.setDisabled(false);
			jpaket_cashback_cfField.setDisabled(false);
		}
		if(jpaket_post2db=="UPDATE" && master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_stat_dok')=="Tertutup"){
			jpaket_custField.setDisabled(true);
			jpaket_tanggalField.setDisabled(true);
			jpaket_keteranganField.setDisabled(true);
			master_cara_bayarTabPanel.setDisabled(false);
			detail_jual_paketListEditorGrid.setDisabled(true);
			detail_pengguna_paketListEditorGrid.setDisabled(true);
			jpaket_diskonField.setDisabled(true);
			jpaket_cashback_cfField.setDisabled(true);
		}
	}
  
  
  
  

    function load_membership(){
		if(jpaket_custField.getValue()!=''){
			memberDataStore.load({
					params : { member_cust: jpaket_custField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) {
							if(memberDataStore.getCount()){
								jpaket_member_record=memberDataStore.getAt(0).data;
								jpaket_cust_nomemberField.setValue(jpaket_member_record.member_no);
							}
						}
					}
			}); 
		}
	}
	/* Function for Check if the form is valid */
	function is_master_jual_paket_form_valid(){
		return (true);
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_jual_paket_createWindow.isVisible()){
			master_jual_paket_reset_form();
			detail_jual_paket_DataStore.load({params: {master_id:0}});
			jpaket_post2db='CREATE';
			msg='created';
			master_cara_bayarTabPanel.setActiveTab(0);
			master_jual_paket_createWindow.show();
		} else {
			master_jual_paket_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_jual_paket_confirm_delete(){
		// only one master_jual_paket is selected here
		if(master_jual_paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_jual_paket_delete);
		} else if(master_jual_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_jual_paket_delete);
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
	function master_jual_paket_confirm_update(){
		/////cbo_dpaket_paketDataStore.load({params:{query:master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_id')}});
		cbo_cust_pengguna_paket_DataStore.load({params:{query:master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_id')}});
		/* only one record is selected here */
		if(master_jual_paketListEditorGrid.selModel.getCount() == 1) {
			//master_jual_paket_set_form();
			master_cara_bayarTabPanel.setActiveTab(0);
			jpaket_post2db='UPDATE';
			cbo_dpaket_paketDataStore.load({
				params:{query:master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_id')},
				callback: function(opts, success, response){
					if(success){
						detail_jual_paket_DataStore.load({
							params : {master_id : eval(get_pk_id()), start:0, limit:pageS},
							callback: function(opts, success, response){
								if(success){
									master_jual_paket_set_form();
									master_jual_paket_set_updating();
								}
							}
						});
					}
				}
			});
			/*detail_jual_paket_DataStore.load({
				params : {master_id : eval(get_pk_id()), start:0, limit:pageS},
				callback: function(opts, success, response){
					if(success){
						master_jual_paket_set_form();
					}
				}
			});*/
			detail_pengguna_paket_DataStore.load({params:{master_id : eval(get_pk_id())}});
			msg='updated';
			master_jual_paket_createWindow.hide();
			//master_jual_paket_createWindow.show();
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
	function master_jual_paket_delete(btn){
		if(btn=='yes'){
			var selections = master_jual_paketListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_jual_paketListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jpaket_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_jual_paket&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_jual_paket_DataStore.reload();
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
	master_jual_paket_DataStore = new Ext.data.Store({
		id: 'master_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jpaket_id'
		},[
		/* dataIndex => insert intomaster_jual_paket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jpaket_id', type: 'int', mapping: 'jpaket_id'}, 
			{name: 'jpaket_nobukti', type: 'string', mapping: 'jpaket_nobukti'}, 
			{name: 'jpaket_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'jpaket_cust_id', type: 'int', mapping: 'jpaket_cust'},
			{name: 'jpaket_cust_no', type: 'string', mapping: 'cust_no'},		//additional by hendri
			{name: 'jpaket_cust_member', type: 'string', mapping: 'cust_member'},		//additional by hendri
			{name: 'jpaket_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jpaket_tanggal'}, 
			{name: 'jpaket_diskon', type: 'int', mapping: 'jpaket_diskon'}, 
			{name: 'jpaket_cashback', type: 'float', mapping: 'jpaket_cashback'},
			{name: 'jpaket_cara', type: 'string', mapping: 'jpaket_cara'}, 
			{name: 'jpaket_cara2', type: 'string', mapping: 'jpaket_cara2'}, 
			{name: 'jpaket_cara3', type: 'string', mapping: 'jpaket_cara3'}, 
			{name: 'jpaket_total', type: 'float', mapping: 'jpaket_totalbiaya'}, 	//additional by hendri
			{name: 'jpaket_bayar', type: 'float', mapping: 'jpaket_bayar'}, 
			{name: 'jpaket_keterangan', type: 'string', mapping: 'jpaket_keterangan'},
			{name: 'jpaket_stat_dok', type: 'string', mapping: 'jpaket_stat_dok'}, 			
			{name: 'jpaket_creator', type: 'string', mapping: 'jpaket_creator'}, 
			{name: 'jpaket_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jpaket_date_create'}, 
			{name: 'jpaket_update', type: 'string', mapping: 'jpaket_update'}, 
			{name: 'jpaket_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jpaket_date_update'}, 
			{name: 'jpaket_revised', type: 'int', mapping: 'jpaket_revised'} 
		]),
		sortInfo:{field: 'jpaket_id', direction: "DESC"}
	});
	/* End of Function */
	
	cbo_voucher_jual_paketDataStore = new Ext.data.Store({
		id: 'cbo_voucher_jual_paketDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_voucher_list', 
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
	cbo_cust_jual_paket_DataStore = new Ext.data.Store({
		id: 'cbo_cust_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_customer_list', 
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
	cbo_kwitansi_jual_paket_DataStore = new Ext.data.Store({
		id: 'cbo_kwitansi_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_kwitansi_list', 
			method: 'POST'
		}),
		//baseParams: {start:0, limit:pageS},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kwitansi_id'
		},[
		/* dataIndex => insert intomaster_jual_paket_ColumnModel, Mapping => for initiate table column */ 
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
	kwitansi_jual_paket_DataStore = new Ext.data.Store({
		id: 'kwitansi_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_kwitansi_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jkwitansi_id'
		},[
		/* dataIndex => insert intomaster_jual_paket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jkwitansi_id', type: 'int', mapping: 'jkwitansi_id'},
			{name: 'kwitansi_no', type: 'string', mapping: 'kwitansi_no'},
			{name: 'jkwitansi_nilai', type: 'float', mapping: 'jkwitansi_nilai'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'}
		]),
		sortInfo:{field: 'jkwitansi_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Kwitansi DataStore */
	card_jual_paket_DataStore = new Ext.data.Store({
		id: 'card_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_card_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcard_id'
		},[
		/* dataIndex => insert intomaster_jual_paket_ColumnModel, Mapping => for initiate table column */ 
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
	cek_jual_paket_DataStore = new Ext.data.Store({
		id: 'cek_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_cek_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jcek_id'
		},[
		/* dataIndex => insert intomaster_jual_paket_ColumnModel, Mapping => for initiate table column */ 
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
	transfer_jual_paket_DataStore = new Ext.data.Store({
		id: 'transfer_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_transfer_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jtransfer_id'
		},[
		/* dataIndex => insert intomaster_jual_paket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jtransfer_id', type: 'int', mapping: 'jtransfer_id'}, 
			{name: 'jtransfer_bank', type: 'int', mapping: 'jtransfer_bank'},
			{name: 'jtransfer_nama', type: 'string', mapping: 'jtransfer_nama'},
			{name: 'jtransfer_nilai', type: 'float', mapping: 'jtransfer_nilai'}
		]),
		sortInfo:{field: 'jtransfer_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve Tunai DataStore */
	tunai_jual_paket_DataStore = new Ext.data.Store({
		id: 'tunai_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_tunai_by_ref', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jtunai_id'
		},[
		/* dataIndex => insert intomaster_jual_paket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jtunai_id', type: 'int', mapping: 'jtunai_id'}, 
			{name: 'jtunai_nilai', type: 'float', mapping: 'jtunai_nilai'}
		]),
		sortInfo:{field: 'jtunai_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* GET Bank-List.Store */
	jpaket_bankDataStore = new Ext.data.Store({
		id:'jpaket_bankDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_bank_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'mbank_id'
		},[
		/* dataIndex => insert intomaster_jual_paket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jpaket_bank_value', type: 'int', mapping: 'mbank_id'}, 
			{name: 'jpaket_bank_display', type: 'string', mapping: 'mbank_nama'}
		]),
		sortInfo:{field: 'jpaket_bank_display', direction: "DESC"}
		});
	/* END GET Bank-List.Store */
	
	cbo_cust_pengguna_paket_DataStore = new Ext.data.Store({
		id: 'cbo_cust_pengguna_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_customer_pengguna_list', 
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
	
  	/* Function for Identify of Window Column Model */
	master_jual_paket_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jpaket_id',
			width: 5,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'jpaket_tanggal',
			width: 70,	//150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		}, 
		{
			header: '<div align="center">' + 'No Faktur' + '</div>',
			dataIndex: 'jpaket_nobukti',
			width: 80,	//150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}, 
		{
			header: '<div align="center">' + 'No Cust' + '</div>',
			dataIndex: 'jpaket_cust_no',
			width: 80,	//185,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Customer' + '</div>',
			dataIndex: 'jpaket_cust',
			width: 200,	//185,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Member' + '</div>',
			dataIndex: 'jpaket_cust_member',
			width: 80,	//185,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Total (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'jpaket_total',
			width: 100,	//150,
			sortable: true,
			readOnly: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			
		},
		{
			header: '<div align="center">' + 'Total Bayar (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'jpaket_bayar',
			width: 100,	//150,
			sortable: true,
			readOnly: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			
		},
		{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'jpaket_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		
		{
			header: '<div align="center">' + 'Stat Dok' + '</div>',
			dataIndex: 'jpaket_stat_dok',
			width: 80,	//150,
			sortable: true
		}, 
		
		
		{
			header: 'Creator',
			dataIndex: 'jpaket_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jpaket_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jpaket_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jpaket_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jpaket_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_jual_paket_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_jual_paketListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_jual_paketListEditorGrid',
		el: 'fp_master_jual_paket',
		title: 'Daftar Penjualan Paket',
		autoHeight: true,
		store: master_jual_paket_DataStore, // DataStore
		cm: master_jual_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,	//800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_jual_paket_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			disabled: true,
			handler: display_form_window
		}, '-',{
			text: 'Edit',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: master_jual_paket_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: master_jual_paket_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_jual_paket_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						master_jual_paket_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- No Faktur<br>- Nama Customer<br>- No Cust'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_jual_paket_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_jual_paket_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_jual_paket_print  
		}
		]
	});
	//master_jual_paketListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_jual_paket_ContextMenu = new Ext.menu.Menu({
		id: 'master_jual_paket_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_jual_paket_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: master_jual_paket_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_jual_paket_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_jual_paket_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_jual_paket_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_jual_paket_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_jual_paket_SelectedRow=rowIndex;
		master_jual_paket_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_jual_paket_editContextMenu(){
		master_jual_paketListEditorGrid.startEditing(master_jual_paket_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_jual_paketListEditorGrid.addListener('rowcontextmenu', onmaster_jual_paket_ListEditGridContextMenu);
	//master_jual_paket_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_jual_paketListEditorGrid.on('afteredit', master_jual_paket_update); // inLine Editing Record
	
	// Custom rendering Template
    var customer_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
//            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
//            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
            '<span><b>{cust_no} : {cust_nama}</b><br /></span>',
            '{cust_alamat} | {cust_telprumah}',
        '</div></tpl>'
    );
	
	var voucher_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{voucher_nomor}</b>| {voucher_nama}<br/></span>',
			'Jenis: {voucher_jenis}&nbsp;&nbsp;&nbsp;[Nilai: {voucher_cashback}]',
		'</div></tpl>'
    );
	
	
	var kwitansi_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{ckwitansi_no}</b> <br/>',
			'a/n {ckwitansi_cust_nama} [ {ckwitansi_cust_no} ]<br/>',
			'{ckwitansi_cust_alamat}, <br>Sisa: <b>Rp. {total_sisa}</b> </span>',
		'</div></tpl>'
    );
	
/*	var paket_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dpaket_paket_kode}</b>| {dpaket_paket_display}<br/>Group: {dpaket_paket_group}<br/>',
			'Kategori: {dpaket_paket_kategori}</span>',
		'</div></tpl>'
    );
*/	var paket_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{dpaket_paket_kode} | <b>{dpaket_paket_display}</b></span>',
		'</div></tpl>'
    );
		
	/* Identify  jpaket_id Field */
	jpaket_idField= new Ext.form.NumberField({
		id: 'jpaket_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jpaket_nobukti Field */
	jpaket_nobuktiField= new Ext.form.TextField({
		id: 'jpaket_nobuktiField',
		fieldLabel: 'No Faktur',
//		readOnly:true,	//sementara, utk input manual
		maxLength: 30,
//		anchor: '95%'
	});
	/* Identify  jpaket_cust Field */
	jpaket_custField= new Ext.form.ComboBox({
		id: 'jpaket_custField',
		fieldLabel: 'Customer',
		store: cbo_cust_jual_paket_DataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jpaket_cust_idField= new Ext.form.NumberField();
	
	jpaket_cust_nomemberField= new Ext.form.TextField({
		id: 'jpaket_cust_nomemberField',
		fieldLabel: 'No Member',
		readOnly: true
	});
	
	/* Identify  jpaket_tanggal Field */
	jpaket_tanggalField= new Ext.form.DateField({
		id: 'jpaket_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	});
	/* Identify  jpaket_diskon Field */
	jpaket_diskonField= new Ext.form.NumberField({
		id: 'jpaket_diskonField',
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
	
	jpaket_cashback_cfField= new Ext.form.TextField({
		id: 'jpaket_cashback_cfField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		width: 120,
		maskRe: /([0-9]+)$/
	});
	jpaket_cashbackField= new Ext.form.NumberField({
		id: 'jpaket_cashbackField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		enableKeyEvents: true,
		allowDecimals: false,
		width: 100,
		maskRe: /([0-9]+)$/
	});
	
	/* Identify  jpaket_cara Field */
	jpaket_caraField= new Ext.form.ComboBox({
		id: 'jpaket_caraField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_cara_value', 'jpaket_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jpaket_cara_display',
		valueField: 'jpaket_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jpaket_cara2 Field */
	jpaket_cara2Field= new Ext.form.ComboBox({
		id: 'jpaket_cara2Field',
		fieldLabel: 'Cara Bayar 2',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_cara_value', 'jpaket_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jpaket_cara_display',
		valueField: 'jpaket_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	/* Identify  jpaket_cara3 Field */
	jpaket_cara3Field= new Ext.form.ComboBox({
		id: 'jpaket_cara3Field',
		fieldLabel: 'Cara Bayar 3',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_cara_value', 'jpaket_cara_display'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jpaket_cara_display',
		valueField: 'jpaket_cara_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	
	
	jpaket_stat_dokField= new Ext.form.ComboBox({
		id: 'jpaket_stat_dokField',
		fieldLabel: 'Status Dokumen',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_stat_dok_value', 'jpaket_stat_dok_display'],
			data:[['Terbuka','Terbuka'],['Tertutup','Tertutup'],['Batal','Batal']]
		}),
		mode: 'local',
		emptyText: 'Terbuka',
		displayField: 'jpaket_stat_dok_display',
		valueField: 'jpaket_stat_dok_value',
		editable: false,
		//anchor: '95%',
		width: 100,
		triggerAction: 'all'	
	});
	
	
	
	/* Identify  jpaket_keterangan Field */
	jpaket_keteranganField= new Ext.form.TextArea({
		id: 'jpaket_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	// START Field Voucher
	jpaket_voucher_noField= new Ext.form.ComboBox({
		id: 'jpaket_voucher_noField',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jual_paketDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	jpaket_voucher_noField.on('select', function(){
		j=cbo_voucher_jual_paketDataStore.find('voucher_nomor',jpaket_kwitansi_noField.getValue());
		if(j>-1){
			jpaket_kwitansi_namaField.setValue(cbo_kwitansi_jual_paket_DataStore.getAt(j).data.ckwitansi_cust_nama);
		}
	});
	
	jpaket_voucher_cashbackField= new Ext.form.NumberField({
		id: 'jpaket_voucher_cashbackField',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_paket_voucherGroup= new Ext.form.FieldSet({
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
				items: [jpaket_voucher_noField,jpaket_voucher_cashbackField] 
			}
		]
	
	});
	// END Field Voucher
	// START Field Voucher-2
	jpaket_voucher_no2Field= new Ext.form.ComboBox({
		id: 'jpaket_voucher_no2Field',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jual_paketDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jpaket_voucher_cashback2Field= new Ext.form.NumberField({
		id: 'jpaket_voucher_cashback2Field',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_paket_voucher2Group= new Ext.form.FieldSet({
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
				items: [jpaket_voucher_no2Field,jpaket_voucher_cashback2Field] 
			}
		]
	
	});
	// END Field Voucher-2
	// START Field Voucher-3
	jpaket_voucher_no3Field= new Ext.form.ComboBox({
		id: 'jpaket_voucher_no3Field',
		fieldLabel: 'Nomor Voucher',
		store: cbo_voucher_jual_paketDataStore,
		mode: 'remote',
		displayField:'voucher_nomor',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jpaket_voucher_cashback3Field= new Ext.form.NumberField({
		id: 'jpaket_voucher_cashback3Field',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_paket_voucher3Group= new Ext.form.FieldSet({
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
				items: [jpaket_voucher_no3Field,jpaket_voucher_cashback3Field] 
			}
		]
	
	});
	// END Field Voucher-3
	
	// START Field Card
	jpaket_card_namaField= new Ext.form.ComboBox({
		id: 'jpaket_card_namaField',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_card_value', 'jpaket_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jpaket_card_display',
		valueField: 'jpaket_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jpaket_card_edcField= new Ext.form.ComboBox({
		id: 'jpaket_card_edcField',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_card_edc_value', 'jpaket_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jpaket_card_edc_display',
		valueField: 'jpaket_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpaket_card_noField= new Ext.form.TextField({
		id: 'jpaket_card_noField',
		fieldLabel: 'No Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jpaket_card_nilai_cfField= new Ext.form.TextField({
		id: 'jpaket_card_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_card_nilaiField= new Ext.form.NumberField({
		id: 'jpaket_card_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_paket_cardGroup= new Ext.form.FieldSet({
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
				items: [jpaket_card_namaField,jpaket_card_edcField,jpaket_card_noField,jpaket_card_nilai_cfField] 
			}
		]
	
	});
	// END Field Card
	// START Field Card-2
	jpaket_card_nama2Field= new Ext.form.ComboBox({
		id: 'jpaket_card_nama2Field',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_card_value', 'jpaket_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jpaket_card_display',
		valueField: 'jpaket_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jpaket_card_edc2Field= new Ext.form.ComboBox({
		id: 'jpaket_card_edc2Field',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_card_edc_value', 'jpaket_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jpaket_card_edc_display',
		valueField: 'jpaket_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpaket_card_no2Field= new Ext.form.TextField({
		id: 'jpaket_card_no2Field',
		fieldLabel: 'No Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jpaket_card_nilai2_cfField= new Ext.form.TextField({
		id: 'jpaket_card_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_card_nilai2Field= new Ext.form.NumberField({
		id: 'jpaket_card_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_paket_card2Group= new Ext.form.FieldSet({
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
				items: [jpaket_card_nama2Field,jpaket_card_edc2Field,jpaket_card_no2Field,jpaket_card_nilai2_cfField] 
			}
		]
	
	});
	// END Field Card-2
	// START Field Card-3
	jpaket_card_nama3Field= new Ext.form.ComboBox({
		id: 'jpaket_card_nama3Field',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_card_value', 'jpaket_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'jpaket_card_display',
		valueField: 'jpaket_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	jpaket_card_edc3Field= new Ext.form.ComboBox({
		id: 'jpaket_card_edc3Field',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_card_edc_value', 'jpaket_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'jpaket_card_edc_display',
		valueField: 'jpaket_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpaket_card_no3Field= new Ext.form.TextField({
		id: 'jpaket_card_no3Field',
		fieldLabel: 'No Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	jpaket_card_nilai3_cfField= new Ext.form.TextField({
		id: 'jpaket_card_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_card_nilai3Field= new Ext.form.NumberField({
		id: 'jpaket_card_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	master_jual_paket_card3Group= new Ext.form.FieldSet({
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
				items: [jpaket_card_nama3Field,jpaket_card_edc3Field,jpaket_card_no3Field,jpaket_card_nilai3_cfField] 
			}
		]
	
	});
	// END Field Card-3
	
	// StART Field Cek
	jpaket_cek_namaField= new Ext.form.TextField({
		id: 'jpaket_cek_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpaket_cek_noField= new Ext.form.TextField({
		id: 'jpaket_cek_noField',
		fieldLabel: 'No Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpaket_cek_validField= new Ext.form.DateField({
		id: 'jpaket_cek_validField',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jpaket_cek_bankField= new Ext.form.ComboBox({
		id: 'jpaket_cek_bankField',
		fieldLabel: 'Bank',
		store: jpaket_bankDataStore,
		mode: 'remote',
		displayField: 'jpaket_bank_display',
		valueField: 'jpaket_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jpaket_cek_bankField)
	});
	
	jpaket_cek_nilai_cfField= new Ext.form.TextField({
		id: 'jpaket_cek_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_cek_nilaiField= new Ext.form.NumberField({
		id: 'jpaket_cek_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_paket_cekGroup = new Ext.form.FieldSet({
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
				items: [jpaket_cek_namaField,jpaket_cek_noField,jpaket_cek_validField,jpaket_cek_bankField,jpaket_cek_nilai_cfField] 
			}
		]
	
	});
	// END Field Cek
	// StART Field Cek-2
	jpaket_cek_nama2Field= new Ext.form.TextField({
		id: 'jpaket_cek_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpaket_cek_no2Field= new Ext.form.TextField({
		id: 'jpaket_cek_no2Field',
		fieldLabel: 'No Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpaket_cek_valid2Field= new Ext.form.DateField({
		id: 'jpaket_cek_valid2Field',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jpaket_cek_bank2Field= new Ext.form.ComboBox({
		id: 'jpaket_cek_bank2Field',
		fieldLabel: 'Bank',
		store: jpaket_bankDataStore,
		mode: 'remote',
		displayField: 'jpaket_bank_display',
		valueField: 'jpaket_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jpaket_cek_bankField)
	});
	
	jpaket_cek_nilai2_cfField= new Ext.form.TextField({
		id: 'jpaket_cek_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_cek_nilai2Field= new Ext.form.NumberField({
		id: 'jpaket_cek_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_paket_cek2Group = new Ext.form.FieldSet({
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
				items: [jpaket_cek_nama2Field,jpaket_cek_no2Field,jpaket_cek_valid2Field,jpaket_cek_bank2Field,jpaket_cek_nilai2_cfField] 
			}
		]
	
	});
	// END Field Cek-2
	// StART Field Cek-3
	jpaket_cek_nama3Field= new Ext.form.TextField({
		id: 'jpaket_cek_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpaket_cek_no3Field= new Ext.form.TextField({
		id: 'jpaket_cek_no3Field',
		fieldLabel: 'No Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpaket_cek_valid3Field= new Ext.form.DateField({
		id: 'jpaket_cek_valid3Field',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	jpaket_cek_bank3Field= new Ext.form.ComboBox({
		id: 'jpaket_cek_bank3Field',
		fieldLabel: 'Bank',
		store: jpaket_bankDataStore,
		mode: 'remote',
		displayField: 'jpaket_bank_display',
		valueField: 'jpaket_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jpaket_cek_bankField)
	});
	
	jpaket_cek_nilai3_cfField= new Ext.form.TextField({
		id: 'jpaket_cek_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_cek_nilai3Field= new Ext.form.NumberField({
		id: 'jpaket_cek_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_paket_cek3Group = new Ext.form.FieldSet({
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
				items: [jpaket_cek_nama3Field,jpaket_cek_no3Field,jpaket_cek_valid3Field,jpaket_cek_bank3Field,jpaket_cek_nilai3_cfField] 
			}
		]
	
	});
	// END Field Cek-3
	
	// START Field Transfer
	jpaket_transfer_bankField= new Ext.form.ComboBox({
		id: 'jpaket_transfer_bankField',
		fieldLabel: 'Bank',
		store: jpaket_bankDataStore,
		mode: 'remote',
		displayField: 'jpaket_bank_display',
		valueField: 'jpaket_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true,
		renderer: Ext.util.Format.comboRenderer(jpaket_transfer_bankField)
	});

	jpaket_transfer_namaField= new Ext.form.TextField({
		id: 'jpaket_transfer_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpaket_transfer_nilai_cfField= new Ext.form.TextField({
		id: 'jpaket_transfer_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_transfer_nilaiField= new Ext.form.NumberField({
		id: 'jpaket_transfer_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_paket_transferGroup= new Ext.form.FieldSet({
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
				items: [jpaket_transfer_bankField,jpaket_transfer_namaField,jpaket_transfer_nilai_cfField] 
			}
		]
	
	});
	// END Field Transfer
	// START Field Transfer-2
	jpaket_transfer_bank2Field= new Ext.form.ComboBox({
		id: 'jpaket_transfer_bank2Field',
		fieldLabel: 'Bank',
		store: jpaket_bankDataStore,
		mode: 'remote',
		displayField: 'jpaket_bank_display',
		valueField: 'jpaket_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpaket_transfer_nama2Field= new Ext.form.TextField({
		id: 'jpaket_transfer_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpaket_transfer_nilai2_cfField= new Ext.form.TextField({
		id: 'jpaket_transfer_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_transfer_nilai2Field= new Ext.form.NumberField({
		id: 'jpaket_transfer_nilai2Field',
		fieldLabel: 'Jumlah (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_paket_transfer2Group= new Ext.form.FieldSet({
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
				items: [jpaket_transfer_bank2Field,jpaket_transfer_nama2Field,jpaket_transfer_nilai2_cfField] 
			}
		]
	
	});
	// END Field Transfer-2
	// START Field Transfer-3
	jpaket_transfer_bank3Field= new Ext.form.ComboBox({
		id: 'jpaket_transfer_bank3Field',
		fieldLabel: 'Bank',
		store: jpaket_bankDataStore,
		mode: 'remote',
		displayField: 'jpaket_bank_display',
		valueField: 'jpaket_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	jpaket_transfer_nama3Field= new Ext.form.TextField({
		id: 'jpaket_transfer_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	jpaket_transfer_nilai3_cfField= new Ext.form.TextField({
		id: 'jpaket_transfer_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_transfer_nilai3Field= new Ext.form.NumberField({
		id: 'jpaket_transfer_nilai3Field',
		fieldLabel: 'Jumlah (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	master_jual_paket_transfer3Group= new Ext.form.FieldSet({
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
				items: [jpaket_transfer_bank3Field,jpaket_transfer_nama3Field,jpaket_transfer_nilai3_cfField] 
			}
		]
	
	});
	// END Field Transfer-3
	
	//START Field Tunai-1
	jpaket_tunai_nilai_cfField= new Ext.form.TextField({
		id: 'jpaket_tunai_nilai_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_tunai_nilaiField= new Ext.form.NumberField({
		id: 'jpaket_tunai_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_paket_tunaiGroup = new Ext.form.FieldSet({
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
				items: [jpaket_tunai_nilai_cfField] 
			}
		]
	
	});
	// END Tunai-1
	
	//START Field Tunai-2
	jpaket_tunai_nilai2_cfField= new Ext.form.TextField({
		id: 'jpaket_tunai_nilai2_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_tunai_nilai2Field= new Ext.form.NumberField({
		id: 'jpaket_tunai_nilai2Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_paket_tunai2Group = new Ext.form.FieldSet({
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
				items: [jpaket_tunai_nilai2_cfField] 
			}
		]
	
	});
	// END Tunai-2
	
	//START Field Tunai-3
	jpaket_tunai_nilai3_cfField= new Ext.form.TextField({
		id: 'jpaket_tunai_nilai3_cfField',
		fieldLabel: 'Jumlah (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_tunai_nilai3Field= new Ext.form.NumberField({
		id: 'jpaket_tunai_nilai3Field',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	master_jual_paket_tunai3Group = new Ext.form.FieldSet({
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
				items: [jpaket_tunai_nilai3_cfField] 
			}
		]
	
	});
	// END Tunai-3
	
	//START Field Kwitansi-1
	jpaket_kwitansi_namaField= new Ext.form.TextField({
		id: 'jpaket_kwitansi_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpaket_kwitansi_nilai_cfField= new Ext.form.TextField({
		id: 'jpaket_kwitansi_nilai_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_kwitansi_nilaiField= new Ext.form.NumberField({
		id: 'jpaket_kwitansi_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jpaket_kwitansi_noField= new Ext.form.ComboBox({
		id: 'jpaket_kwitansi_noField',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_paket_DataStore,
		mode: 'remote',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jpaket_kwitansi_sisaField= new Ext.form.NumberField({
		id: 'jpaket_kwitansi_sisaField',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jpaket_kwitansi_noField.on("select",function(){
			j=cbo_kwitansi_jual_paket_DataStore.find('ckwitansi_id',jpaket_kwitansi_noField.getValue());
			if(j>-1){
				jpaket_kwitansi_namaField.setValue(cbo_kwitansi_jual_paket_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jpaket_kwitansi_sisaField.setValue(cbo_kwitansi_jual_paket_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-1
	
	//START Field Kwitansi-2
	jpaket_kwitansi_nama2Field= new Ext.form.TextField({
		id: 'jpaket_kwitansi_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpaket_kwitansi_nilai2_cfField= new Ext.form.TextField({
		id: 'jpaket_kwitansi_nilai2_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_kwitansi_nilai2_cfField= new Ext.form.TextField({
		id: 'jpaket_kwitansi_nilai2_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_kwitansi_nilai2Field= new Ext.form.NumberField({
		id: 'jpaket_kwitansi_nilai2Field',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jpaket_kwitansi_no2Field= new Ext.form.ComboBox({
		id: 'jpaket_kwitansi_no2Field',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_paket_DataStore,
		mode: 'remote',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jpaket_kwitansi_sisa2Field= new Ext.form.NumberField({
		id: 'jpaket_kwitansi_sisa2Field',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jpaket_kwitansi_no2Field.on("select",function(){
			j=cbo_kwitansi_jual_paket_DataStore.find('ckwitansi_id',jpaket_kwitansi_no2Field.getValue());
			if(j>-1){
				jpaket_kwitansi_nama2Field.setValue(cbo_kwitansi_jual_paket_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jpaket_kwitansi_sisa2Field.setValue(cbo_kwitansi_jual_paket_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-2
	
	//START Field Kwitansi-3
	jpaket_kwitansi_nama3Field= new Ext.form.TextField({
		id: 'jpaket_kwitansi_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpaket_kwitansi_nilai3_cfField= new Ext.form.TextField({
		id: 'jpaket_kwitansi_nilai3_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_kwitansi_nilai3_cfField= new Ext.form.TextField({
		id: 'jpaket_kwitansi_nilai3_cfField',
		fieldLabel: 'Diambil (Rp)',
		allowNegatife : false,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		anchor: '95%',
		maskRe: /([0-9]+)$/ 
	});
	jpaket_kwitansi_nilai3Field= new Ext.form.NumberField({
		id: 'jpaket_kwitansi_nilai3Field',
		enableKeyEvents: true,
		fieldLabel: 'Diambil (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jpaket_kwitansi_no3Field= new Ext.form.ComboBox({
		id: 'jpaket_kwitansi_no3Field',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_paket_DataStore,
		mode: 'remote',
		displayField:'ckwitansi_no',
		valueField: 'ckwitansi_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: kwitansi_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	jpaket_kwitansi_sisa3Field= new Ext.form.NumberField({
		id: 'jpaket_kwitansi_sisa3Field',
		fieldLabel: 'Sisa (Rp)',
		readOnly: true,
		anchor: '95%'
	});
	
	jpaket_kwitansi_no3Field.on("select",function(){
			j=cbo_kwitansi_jual_paket_DataStore.find('ckwitansi_id',jpaket_kwitansi_no3Field.getValue());
			if(j>-1){
				jpaket_kwitansi_nama3Field.setValue(cbo_kwitansi_jual_paket_DataStore.getAt(j).data.ckwitansi_cust_nama);
				jpaket_kwitansi_sisa3Field.setValue(cbo_kwitansi_jual_paket_DataStore.getAt(j).data.total_sisa);
			}
		});
	// END Kwitansi-3
	
	master_jual_paket_kwitansiGroup = new Ext.form.FieldSet({
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
				items: [jpaket_kwitansi_noField,jpaket_kwitansi_namaField,jpaket_kwitansi_sisaField,jpaket_kwitansi_nilai_cfField] 
			}
		]
	
	});
	
	master_jual_paket_kwitansi2Group = new Ext.form.FieldSet({
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
				items: [jpaket_kwitansi_no2Field,jpaket_kwitansi_nama2Field,jpaket_kwitansi_sisa2Field,jpaket_kwitansi_nilai2_cfField] 
			}
		]
	
	});
	
	master_jual_paket_kwitansi3Group = new Ext.form.FieldSet({
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
				items: [jpaket_kwitansi_no3Field,jpaket_kwitansi_nama3Field,jpaket_kwitansi_sisa3Field,jpaket_kwitansi_nilai3_cfField] 
			}
		]
	
	});
	
	//* Bayar
	jpaket_jumlahField= new Ext.form.NumberField({
		id: 'jpaket_jumlahField',
		fieldLabel: 'Jumlah Item',
		allowBlank: true,
		readOnly: true,
		allowDecimals: false,
		width: 40,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jpaket_subTotalField= new Ext.ux.form.CFTextField({
		id: 'jpaket_subTotalField',
		fieldLabel: 'Sub Total (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		itemCls: 'rmoney',
		width: 120
	});
	/*jpaket_subTotalField= new Ext.ux.form.CFTextField({
		id: 'jpaket_subTotalField',
		fieldLabel: 'Sub Total (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		enableKeyEvents: true,
		itemCls: 'rmoney',
		width: 120
	});*/
	
	jpaket_totalField= new Ext.ux.form.CFTextField({
		id: 'jpaket_totalField',
		fieldLabel: '<span style="font-weight:bold">Total (Rp)</span>',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		itemCls: 'rmoney_b',
		width: 120
	});
	/*jpaket_totalField= new Ext.form.NumberField({
		id: 'jpaket_totalField',
		fieldLabel: '<span style="font-weight:bold">Total (Rp)</span>',
		readOnly: true,
		allowDecimals: false,
		allowBlank: true,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});*/
	
	jpaket_bayarField= new Ext.ux.form.CFTextField({
		id: 'jpaket_bayarField',
		fieldLabel: 'Total Bayar (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		itemCls: 'rmoney',
		width: 120
	});
	/*jpaket_bayarField= new Ext.form.NumberField({
		id: 'jpaket_bayarField',
		fieldLabel: 'Total Bayar (Rp)',
		readOnly: true,
		enableKeyEvents: true,
		allowBlank: true,
		allowDecimals: false,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});*/
	
	jpaket_hutangField= new Ext.ux.form.CFTextField({
		id: 'jpaket_hutangField',
		fieldLabel: 'Hutang (Rp)',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		itemCls: 'rmoney',
		width: 120
	});
	/*jpaket_hutangField= new Ext.form.NumberField({
		id: 'jpaket_hutangField',
		fieldLabel: 'Hutang (Rp)',
		readOnly: true,
		allowBlank: true,
		allowDecimals: false,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});*/
	
	
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

                items: [jpaket_caraField,master_jual_paket_tunaiGroup,master_jual_paket_cardGroup,master_jual_paket_cekGroup,master_jual_paket_kwitansiGroup,master_jual_paket_transferGroup,master_jual_paket_voucherGroup]
            },{
                title:'Cara Bayar 2',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jpaket_cara2Field, master_jual_paket_tunai2Group, master_jual_paket_kwitansi2Group ,master_jual_paket_card2Group, master_jual_paket_cek2Group, master_jual_paket_transfer2Group, master_jual_paket_voucher2Group]
            },{
                title:'Cara Bayar 3',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jpaket_cara3Field, master_jual_paket_tunai3Group, master_jual_paket_kwitansi3Group, master_jual_paket_card3Group, master_jual_paket_cek3Group, master_jual_paket_transfer3Group, master_jual_paket_voucher3Group]
            }]
	});
	
	master_jual_paket_bayarGroup = new Ext.form.FieldSet({
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
				items: [jpaket_jumlahField, jpaket_subTotalField, jpaket_diskonField, jpaket_cashback_cfField, {xtype: 'spacer',height:10},jpaket_totalField, jpaket_bayarField,jpaket_hutangField] 
			}
			]
	
	});
	
	/*Fieldset Master*/
	master_jual_paket_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jpaket_nobuktiField, jpaket_custField, jpaket_cust_nomemberField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jpaket_tanggalField, jpaket_keteranganField, jpaket_stat_dokField] 
			},
			{
				columnWidth:0.72,
				//layout: 'column',
				//border:false,
				buttons: [{
				text: '<span style="font-weight:bold">Edit Dokumen</span>'
				//handler: show_windowGrid
				}]
			}
			]
	
	});
	
	/*Detail Declaration */
	
	// Function for json reader of detail
	var detail_jual_paket_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoPaket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dpaket_id', type: 'int', mapping: 'dpaket_id'}, 
			{name: 'dpaket_master', type: 'int', mapping: 'dpaket_master'}, 
			{name: 'dpaket_paket', type: 'int', mapping: 'dpaket_paket'},
			{name: 'dpaket_karyawan', type: 'int', mapping: 'dpaket_karyawan'},
			{name: 'dpaket_kadaluarsa', type: 'date', dateFormat: 'Y-m-d', mapping: 'dpaket_kadaluarsa'}, 
			{name: 'dpaket_jumlah', type: 'int', mapping: 'dpaket_jumlah'}, 
			{name: 'dpaket_harga', type: 'float', mapping: 'dpaket_harga'}, 
			{name: 'dpaket_diskon', type: 'int', mapping: 'dpaket_diskon'}, 
			{name: 'dpaket_diskon_jenis', type: 'string', mapping: 'dpaket_diskon_jenis'}, 
			{name: 'dpaket_sales', type: 'string', mapping: 'dpaket_sales'},
			{name: 'dpaket_subtotal', type: 'float', mapping: 'dpaket_subtotal'},
			{name: 'dpaket_subtotal_net', type: 'int', mapping: 'dpaket_subtotal_net'},
			{name: 'jpaket_bayar', type: 'float', mapping: 'jpaket_bayar'},
			{name: 'jpaket_diskon', type: 'int', mapping: 'jpaket_diskon'},
			{name: 'jpaket_cashback', type: 'float', mapping: 'jpaket_cashback'},
			{name: 'paket_point', type: 'int', mapping: 'paket_point'}
	]);
	//eof
	
	//function for json writer of detail
	var detail_jual_paket_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	
	
	/* Function for Retrieve DataStore of detail*/
	detail_jual_paket_DataStore = new Ext.data.Store({
		id: 'detail_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=detail_detail_jual_paket_list', 
			method: 'POST'
		}),baseParams: {master_id: jpaket_idField.getValue(), start: 0, limit: pageS},
		reader: detail_jual_paket_reader,
		sortInfo:{field: 'dpaket_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_jual_paket= new Ext.ux.grid.RowEditor({
        saveText: 'Update'/*,
		listeners: {
			afteredit: function(){
				detail_jual_paket_DataStore.commitChanges();
			}
		}*/
    });
	//eof
	
	cbo_dpaket_paketDataStore = new Ext.data.Store({
		id: 'cbo_dpaket_paketDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_paket_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'paket_id'
		},[
			{name: 'dpaket_paket_value', type: 'int', mapping: 'paket_id'},
			{name: 'dpaket_paket_harga', type: 'float', mapping: 'paket_harga'},
			{name: 'dpaket_paket_kode', type: 'string', mapping: 'paket_kode'},
			{name: 'dpaket_paket_du', type: 'float', mapping: 'paket_du'},
			{name: 'dpaket_paket_dm', type: 'float', mapping: 'paket_dm'},
			{name: 'dpaket_paket_display', type: 'string', mapping: 'paket_nama'},
			{name: 'dpaket_paket_expired', type: 'int', mapping: 'paket_expired'}
		]),
		sortInfo:{field: 'dpaket_paket_display', direction: "ASC"}
	});
	
	cbo_dpaket_reveralDataStore = new Ext.data.Store({
		id: 'cbo_dpaket_reveralDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_reveral_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 100 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			//id: 'produk_id'
		},[
			{name: 'karyawan_display', type: 'string', mapping: 'karyawan_username'},
			//{name: 'karyawan_id', type: 'int', mapping: 'karyawan_id'},
			{name: 'karyawan_no', type: 'string', mapping: 'karyawan_no'},
			{name: 'nama_karyawan', type: 'string', mapping: 'karyawan_nama'},
			{name: 'karyawan_value', type: 'int', mapping: 'karyawan_id'}
		]),
		sortInfo:{field: 'karyawan_no', direction: "ASC"}
	});
	var reveral_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{nama_karyawan}</b> | {karyawan_display}</span>',
        '</div></tpl>'
    );
	
	
	
	memberDataStore = new Ext.data.Store({
		id: 'memberDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=get_member_by_cust', 
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
	
	var combo_jual_paket=new Ext.form.ComboBox({
			store: cbo_dpaket_paketDataStore,
			mode: 'remote',
			displayField: 'dpaket_paket_display',
			valueField: 'dpaket_paket_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: paket_jual_paket_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'
	});
	
	dpaket_idField=new Ext.form.NumberField();
	
	combo_jual_paket.on('select',function(){
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){	
			detail_jual_paket_record=detail_jual_paket_DataStore.getAt(i);
			var j=cbo_dpaket_paketDataStore.find('dpaket_paket_value',combo_jual_paket.getValue());
			if(cbo_dpaket_paketDataStore.getCount()){
				dpaket_idField.setValue(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_value);
				dpaket_jumlahField.setValue(1);
				var dpaket_jumlah_diskon = 0;
				//* Check no_member JIKA <>"" ==> jenis-diskon=DM /
				if(jpaket_cust_nomemberField.getValue()!==""){
						dpaket_jenisdiskonField.setValue('DM');
						dpaket_jumlah_diskon = cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_dm;
						dpaket_jumlahdiskonField.setValue(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_dm);
				}else{
						dpaket_jenisdiskonField.setValue('DU');
						dpaket_jumlah_diskon = cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_du;
						dpaket_jumlahdiskonField.setValue(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_du);
				}
				
				var DayLength=1*24*60*60*1000;
				var Days=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_expired;
				//var dt_kadaluarsa=new Date(dt*1+DayLength*Days);
				var dt_kadaluarsa=new Date(jpaket_tanggalField.getValue()*1+DayLength*Days);
				dpaket_kadaluarsaField.setValue(dt_kadaluarsa);
				dpaket_hargaField.setValue(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_harga);
				dpaket_subtotalField.setValue(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_harga);
				dpaket_subtotalnetField.setValue(((100-dpaket_jumlah_diskon)/100)*cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_harga);
			}
		}
	});
	
	var combo_reveral_paket=new Ext.form.ComboBox({
			store: cbo_dpaket_reveralDataStore,
			mode: 'remote',
			displayField: 'karyawan_display',
			valueField: 'karyawan_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: reveral_paket_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var dpaket_kadaluarsaField= new Ext.form.DateField({
		id: 'dpaket_kadaluarsaField',
		readOnly: true,
		format : 'd-m-Y',
	});
	
	var dpaket_hargaField= new Ext.form.NumberField({
		id: 'dpaket_hargaField',
		allowNegatife : false,
		allowDecimals: false,
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	var dpaket_subtotalField= new Ext.form.NumberField({
		id: 'dpaket_subtotalField',
		allowNegatife : false,
		allowDecimals: false,
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	var dpaket_subtotalnetField= new Ext.form.NumberField({
		id: 'dpaket_subtotalnetField',
		allowNegatife : false,
		allowDecimals: false,
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	var dpaket_jumlahField= new Ext.form.NumberField({
		allowDecimals: false,
		allowNegative: false,
		blankText: '0',
		maxLength: 11,
		maskRe: /([0-9]+)$/
	});
	
	var dpaket_jenisdiskonField= new Ext.form.ComboBox({
		store:new Ext.data.SimpleStore({
			fields:['diskon_jenis_value'],
			data:[['DU'],['DM'],['Promo'],['Ultah'],['Kolega']]
		}),
		mode: 'local',
		displayField: 'diskon_jenis_value',
		valueField: 'diskon_jenis_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
	var dpaket_jumlahdiskonField= new Ext.form.NumberField({
		allowDecimals: false,
		allowNegative: false,
		blankText: '0',
		maxLength: 11,
		maskRe: /([0-9]+)$/
	});
		

	//declaration of detail coloumn model
	detail_jual_paket_ColumnModel = new Ext.grid.ColumnModel(
		[
		{	align : 'Left',
			header: '<div align="center">' + 'Paket' + '</div>',
			dataIndex: 'dpaket_paket',
			width: 300, //298,
			sortable: false,
			editor: combo_jual_paket,
			renderer: Ext.util.Format.comboRenderer(combo_jual_paket)
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'dpaket_jumlah',
			width: 60, //70,
			sortable: false,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: dpaket_jumlahField
		},
		{
			align : 'Left',
			header: '<div align="center">' + 'Kadaluarsa' + '</div>',
			dataIndex: 'dpaket_kadaluarsa',
			width: 80,//90,
			sortable: false,
			editor: dpaket_kadaluarsaField,
			renderer: Ext.util.Format.dateRenderer('d-m-Y')/*,
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})*/
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Harga (Rp)' + '</div>',
			dataIndex: 'dpaket_harga',
			width: 100, //80,
			sortable: false,
			editor: dpaket_hargaField,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},{
			align : 'Right',
			header: '<div align="center">' + 'Sub Total (Rp)' + '</div>',
			dataIndex: 'dpaket_subtotal',
			width: 100, //80,
			sortable: false,
			editor: dpaket_subtotalField,
			renderer: Ext.util.Format.numberRenderer('0,000')/*,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.dpaket_harga* record.data.dpaket_jumlah,'0,000');
            }*/
		},
		{
			align : 'Left',
			header: '<div align="center">' + 'Jenis Diskon' + '</div>',
			dataIndex: 'dpaket_diskon_jenis',
			width: 80,
			sortable: false,
			editor: dpaket_jenisdiskonField
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Diskon (%)' + '</div>',
			dataIndex: 'dpaket_diskon',
			width: 80,
			sortable: false,
			editor: dpaket_jumlahdiskonField,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},{
			align : 'Right',
			header: '<div align="center">' + 'Sub Tot Net (Rp)' + '</div>',
			dataIndex: 'dpaket_subtotal_net',
			width: 100, //80,
			sortable: false,
			editor: dpaket_subtotalnetField,
			renderer: Ext.util.Format.numberRenderer('0,000')
			/*renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.dpaket_harga* record.data.dpaket_jumlah*(100-record.data.dpaket_diskon)/100,'0,000');
            }*/
		},
		{
			align : 'Left',
			header: '<div align="center">' + 'Referal' + '</div>',
			dataIndex: 'dpaket_karyawan',
			width: 150, //250
			sortable: false,
			allowBlank: false,
			editor: combo_reveral_paket,
			renderer: Ext.util.Format.comboRenderer(combo_reveral_paket)
		},
		
		/*{
			header: 'Sales',
			dataIndex: 'dpaket_sales',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}*/]
	);
	detail_jual_paket_ColumnModel.defaultSortable= true;
	//eof
	
	function get_harga_paket(id_paket){
		var harga_paket=0;
		Ext.Ajax.request({
			waitMsg: 'Mohon  Tunggu...',
			url: 'index.php?c=c_master_jual_paket&m=get_harga_paket',
			params:{ paket_id	: id_paket },
			success: function(response){							
				var result=response.responseText;
				harga_paket=result;
			}
		});
		return harga_paket;
	}
	
	
	//declaration of detail list editor grid
	detail_jual_paketListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_jual_paketListEditorGrid',
		el: 'fp_detail_jual_paket',
		title: 'Detail Penjualan Paket',
		height: 250,
		width: 938,
		autoScroll: true,
		store: detail_jual_paket_DataStore, // DataStore
		colModel: detail_jual_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 0 0 0',
		plugins: [editor_detail_jual_paket],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:false},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_jual_paket_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_jual_paket_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			disabled: false,
			handler: detail_jual_paket_confirm_delete
		}
		]
	});
	//eof
	
	//function of detail add
	function detail_jual_paket_add(){
		var edit_detail_jual_paket= new detail_jual_paketListEditorGrid.store.recordType({
			dpaket_id	:'',		
			dpaket_master	:'',		
			dpaket_paket	:null,
			dpaket_karyawan :null,
			dpaket_jumlah	:null,
			dpaket_kadaluarsa	:null,
			dpaket_harga	:null,
			dpaket_diskon_jenis: null,
			dpaket_diskon	:null,
			dpaket_sales	:null
		});
		editor_detail_jual_paket.stopEditing();
		detail_jual_paket_DataStore.insert(0, edit_detail_jual_paket);
		//detail_jual_paketListEditorGrid.getView().refresh();
		detail_jual_paketListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_jual_paket.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_jual_paket(){
		detail_jual_paket_DataStore.commitChanges();
		detail_jual_paketListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_jual_paket_insert(){
		var count_detail=detail_jual_paket_DataStore.getCount();
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){
			var count_i = i;
			detail_jual_paket_record=detail_jual_paket_DataStore.getAt(i);
			if(detail_jual_paket_record.data.dpaket_paket!==null&&detail_jual_paket_record.data.dpaket_paket.dpaket_paket!==""){
				Ext.Ajax.request({
					waitMsg: 'Mohon  Tunggu...',
					url: 'index.php?c=c_master_jual_paket&m=detail_detail_jual_paket_insert',
					params:{
						cetak	: cetak_jpaket,
						dpaket_id	: detail_jual_paket_record.data.dpaket_id, 
						dpaket_master	: eval(get_pk_id()),
						dpaket_paket	: detail_jual_paket_record.data.dpaket_paket, 
						dpaket_karyawan : detail_jual_paket_record.data.dpaket_karyawan,
						dpaket_jumlah	: detail_jual_paket_record.data.dpaket_jumlah,
						dpaket_kadaluarsa	: detail_jual_paket_record.data.dpaket_kadaluarsa.format('Y-m-d'),
						dpaket_harga	: detail_jual_paket_record.data.dpaket_harga, 
						dpaket_diskon	: detail_jual_paket_record.data.dpaket_diskon,
						dpaket_diskon_jenis	: detail_jual_paket_record.data.dpaket_diskon_jenis,
						dpaket_sales	: detail_jual_paket_record.data.dpaket_sales,
						count	: count_i,
						dcount	: count_detail
					},
					timeout: 60000,
					success: function(response){							
						/*var result=eval(response.responseText);
						if(i==count_detail){
							Ext.Ajax.request({
								waitMsg: 'Mohon tunggu...',
								url: 'index.php?c=c_master_jual_paket&m=catatan_piutang_update',
								params:{dpaket_master	: eval(jpaket_idField.getValue())}
							});
						}*/
						var result=eval(response.responseText);
						if(result==0){
							detail_jual_paket_DataStore.load({params: {master_id:0}});
							/*Ext.Ajax.request({
								waitMsg: 'Mohon tunggu...',
								url: 'index.php?c=c_master_jual_paket&m=catatan_piutang_update',
								params:{dpaket_master	: eval(get_pk_id())}
							});*/
							Ext.MessageBox.alert(jpaket_post2db+' OK','Data penjualan paket berhasil disimpan');
							jpaket_post2db="CREATE";
						}else if(result==-1){
							detail_jual_paket_DataStore.load({params: {master_id:0}});
							jpaket_post2db="CREATE";
							Ext.MessageBox.show({
							   title: 'Warning',
							   //msg: 'We could\'t not '+msg+' the Master_jual_produk.',
							   msg: 'Data penjualan paket tidak bisa disimpan',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
							});
						}else if(result>0){
							detail_jual_paket_DataStore.load({params: {master_id:0}});
							Ext.Ajax.request({
								waitMsg: 'Mohon tunggu...',
								url: 'index.php?c=c_master_jual_paket&m=catatan_piutang_update',
								params:{dpaket_master	: eval(get_pk_id())}
							});
							jpaket_cetak(result);
							cetak_jpaket=0;
							jpaket_post2db="CREATE";
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
	function detail_jual_paket_purge(){
		Ext.Ajax.request({
			waitMsg: 'Mohon  Tunggu...',
			url: 'index.php?c=c_master_jual_paket&m=detail_detail_jual_paket_purge',
			params:{ master_id: eval(jpaket_idField.getValue()) },
			callback: function(opts, success, response){
				if(success)
					detail_jual_paket_insert();
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_jual_paket_confirm_delete(){
		// only one record is selected here
		if(detail_jual_paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', detail_jual_paket_delete);
		} else if(detail_jual_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', detail_jual_paket_delete);
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
	//eof
	
	//function for Delete of detail
	function detail_jual_paket_delete(btn){
		if(btn=='yes'){
			var s = detail_jual_paketListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_jual_paket_DataStore.remove(r);
			}
		} 
		detail_jual_paket_DataStore.commitChanges();
		
		/*if(btn=='yes'){
			var selections = detail_jual_paketListEditorGrid.selModel.getSelections();
			
			var prez = [];
			for(i = 0; i< detail_jual_paketListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.dpaket_id);
				
			}
			var encoded_array = Ext.encode(prez);
			
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_jual_paket&m=detail_detail_jual_paket_purge',
				params: { ids:  encoded_array }, 
				success: function(response){
					Ext.MessageBox.show({
					   	title: 'Please wait',
					   	msg: 'Loading items...',
					   	progressText: 'Initializing...',
					   	width:300,
					   	progress:true,
					   	closable:false,
					   	animEl: 'mb6'
				   	});
			
				   	// this hideous block creates the bogus progress
				   	var f = function(v){
						return function(){
							if(v == 12){
								Ext.MessageBox.hide();
								Ext.MessageBox.alert('Status', 'The data has been deleted.');
							}else{
								var i = v/11;
								Ext.MessageBox.updateProgress(i, Math.round(100*i)+'% completed');
							}
					   };
				   	};
				   	for(var i = 1; i < 13; i++){
					   setTimeout(f(i), i*100);
				   	}
					detail_jual_paket_DataStore.reload();
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
		}*/
		
	}
	//eof
	
	/* START Detail Pengguna Paket */
	/*Detail Declaration */
	
	// Function for json reader of detail
	var detail_pengguna_paket_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoPaket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'ppaket_id', type: 'int', mapping: 'ppaket_id'}, 
			{name: 'ppaket_master', type: 'int', mapping: 'ppaket_master'}, 
			{name: 'ppaket_cust', type: 'int', mapping: 'ppaket_cust'}
	]);
	//eof
	
	//function for json writer of detail
	var detail_pengguna_paket_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	
	
	/* Function for Retrieve DataStore of detail*/
	detail_pengguna_paket_DataStore = new Ext.data.Store({
		id: 'detail_pengguna_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_jual_paket&m=detail_pengguna_paket_list', 
			method: 'POST'
		}),baseParams: {master_id: jpaket_idField.getValue(), start: 0, limit: pageS},
		reader: detail_pengguna_paket_reader,
		sortInfo:{field: 'ppaket_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_pengguna_paket= new Ext.ux.grid.RowEditor({
        saveText: 'Update'/*,
		listeners: {
			afteredit: function(){
				detail_pengguna_paket_DataStore.commitChanges();
			}
		}*/
    });
	//eof
	
	
	var combo_pengguna_paket=new Ext.form.ComboBox({
		store: cbo_cust_pengguna_paket_DataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small'
	});

	//declaration of detail coloumn model
	detail_pengguna_paket_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Customer Lain',
			dataIndex: 'ppaket_cust',
			width: 298,
			sortable: true,
			editor: combo_pengguna_paket,
			renderer: Ext.util.Format.comboRenderer(combo_pengguna_paket)
		}/*,
		{
			header: 'Customer Lain',
			dataIndex: 'ppaket_cust',
			width: 298,
			sortable: true,
			editor: combo_pengguna_paket,
			renderer: Ext.util.Format.comboRenderer(combo_pengguna_paket)
		}*/]
	);
	detail_pengguna_paket_ColumnModel.defaultSortable= true;
	//eof
	
	//declaration of detail list editor grid
	detail_pengguna_paketListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_pengguna_paketListEditorGrid',
		el: 'fp_detail_pengguna_paket',
		title: 'Daftar Pemakai Paket',
		height: 250,
		width: 940,	//938,
		autoScroll: true,
		store: detail_pengguna_paket_DataStore, // DataStore
		colModel: detail_pengguna_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 0 0 0',
		plugins: [editor_detail_pengguna_paket],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_pengguna_paket_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_pengguna_paket_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_pengguna_paket_confirm_delete
		}
		]
	});
	//eof
	
	//function of detail add
	function detail_pengguna_paket_add(){
		var edit_detail_pengguna_paket= new detail_pengguna_paketListEditorGrid.store.recordType({
			dpaket_id	:'',		
			dpaket_master	:'',		
			dpaket_paket	:null
		});
		editor_detail_pengguna_paket.stopEditing();
		detail_pengguna_paket_DataStore.insert(0, edit_detail_pengguna_paket);
		//detail_pengguna_paketListEditorGrid.getView().refresh();
		detail_pengguna_paketListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_pengguna_paket.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_pengguna_paket(){
		detail_pengguna_paket_DataStore.commitChanges();
		detail_pengguna_paketListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_pengguna_paket_insert(){
		for(i=0;i<detail_pengguna_paket_DataStore.getCount();i++){
			detail_pengguna_paket_record=detail_pengguna_paket_DataStore.getAt(i);
			if(detail_pengguna_paket_record.data.ppaket_cust!==null&&detail_pengguna_paket_record.data.ppaket_cust!==""){
				Ext.Ajax.request({
					waitMsg: 'Mohon  Tunggu...',
					url: 'index.php?c=c_master_jual_paket&m=detail_pengguna_paket_insert',
					params:{
						ppaket_master	: eval(get_pk_id()), 
						ppaket_cust	: detail_pengguna_paket_record.data.ppaket_cust
					},
					timeout: 60000,
					success: function(response){							
						var result=eval(response.responseText);
						detail_pengguna_paket_DataStore.load({params: {master_id:0}});
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
	function detail_pengguna_paket_purge(){
		Ext.Ajax.request({
			waitMsg: 'Mohon  Tunggu...',
			url: 'index.php?c=c_master_jual_paket&m=detail_pengguna_paket_purge',
			params:{ master_id: eval(jpaket_idField.getValue()) },
			callback: function(opts, success, response){
				if(success)
					detail_pengguna_paket_insert();
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_pengguna_paket_confirm_delete(){
		// only one record is selected here
		if(detail_pengguna_paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', detail_pengguna_paket_delete);
		} else if(detail_pengguna_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', detail_pengguna_paket_delete);
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
	//eof
	
	//function for Delete of detail
	function detail_pengguna_paket_delete(btn){
		if(btn=='yes'){
			var s = detail_pengguna_paketListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_pengguna_paket_DataStore.remove(r);
			}
		} 
		detail_pengguna_paket_DataStore.commitChanges();
	}
	//eof
	/* END Detail Pengguna Paket*/
	
	
	function update_group_carabayar_jual_paket(){
		var value=jpaket_caraField.getValue();
		master_jual_paket_tunaiGroup.setVisible(false);
		master_jual_paket_cardGroup.setVisible(false);
		master_jual_paket_cekGroup.setVisible(false);
		master_jual_paket_transferGroup.setVisible(false);
		master_jual_paket_kwitansiGroup.setVisible(false);
		master_jual_paket_voucherGroup.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jpaket_tunai_nilaiField.reset();
		jpaket_tunai_nilai_cfField.reset();
		jpaket_card_nilaiField.reset();
		jpaket_card_nilai_cfField.reset();
		jpaket_cek_nilaiField.reset();
		jpaket_cek_nilai_cfField.reset();
		jpaket_transfer_nilaiField.reset();
		jpaket_transfer_nilai_cfField.reset();
		jpaket_kwitansi_nilaiField.reset();
		jpaket_kwitansi_nilai_cfField.reset();
		jpaket_voucher_cashbackField.reset();
		//jpaket_voucher_cashback_cfField.reset();
		//load_total_paket_bayar();
		
		if(value=='card'){
			master_jual_paket_cardGroup.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_paket_cekGroup.setVisible(true);
		}else if(value=='transfer'){
			master_jual_paket_transferGroup.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_paket_kwitansiGroup.setVisible(true);
		}else if(value=='voucher'){
			master_jual_paket_voucherGroup.setVisible(true);
		}else if(value=='tunai'){
			master_jual_paket_tunaiGroup.setVisible(true);
		}
	}
	
	function update_group_carabayar2_jual_paket(){
		var value=jpaket_cara2Field.getValue();
		master_jual_paket_tunai2Group.setVisible(false);
		master_jual_paket_card2Group.setVisible(false);
		master_jual_paket_cek2Group.setVisible(false);
		master_jual_paket_transfer2Group.setVisible(false);
		master_jual_paket_kwitansi2Group.setVisible(false);
		master_jual_paket_voucher2Group.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jpaket_tunai_nilai2Field.reset();
		jpaket_tunai_nilai2_cfField.reset();
		jpaket_card_nilai2Field.reset();
		jpaket_card_nilai2_cfField.reset();
		jpaket_cek_nilai2Field.reset();
		jpaket_cek_nilai2_cfField.reset();
		jpaket_transfer_nilai2Field.reset();
		jpaket_transfer_nilai2_cfField.reset();
		jpaket_kwitansi_nilai2Field.reset();
		jpaket_kwitansi_nilai2_cfField.reset();
		jpaket_voucher_cashback2Field.reset();
		//jpaket_voucher_cashback2_cfField.reset();
		//load_total_paket_bayar();
		
		if(value=='card'){
			master_jual_paket_card2Group.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_paket_cek2Group.setVisible(true);
		}else if(value=='transfer'){
			master_jual_paket_transfer2Group.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_paket_kwitansi2Group.setVisible(true);
		}else if(value=='voucher'){
			master_jual_paket_voucher2Group.setVisible(true);
		}else if(value=='tunai'){
			master_jual_paket_tunai2Group.setVisible(true);
		}
	}
	
	function update_group_carabayar3_jual_paket(){
		var value=jpaket_cara3Field.getValue();
		master_jual_paket_tunai3Group.setVisible(false);
		master_jual_paket_card3Group.setVisible(false);
		master_jual_paket_cek3Group.setVisible(false);
		master_jual_paket_transfer3Group.setVisible(false);
		master_jual_paket_kwitansi3Group.setVisible(false);
		master_jual_paket_voucher3Group.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		jpaket_tunai_nilai3Field.reset();
		jpaket_tunai_nilai3_cfField.reset();
		jpaket_card_nilai3Field.reset();
		jpaket_card_nilai3_cfField.reset();
		jpaket_cek_nilai3Field.reset();
		jpaket_cek_nilai3_cfField.reset();
		jpaket_transfer_nilai3Field.reset();
		jpaket_transfer_nilai3_cfField.reset();
		jpaket_kwitansi_nilai3Field.reset();
		jpaket_kwitansi_nilai3_cfField.reset();
		jpaket_voucher_cashback3Field.reset();
		//jpaket_voucher_cashback3_cfField.reset();
		//load_total_paket_bayar();
		
		if(value=='card'){
			master_jual_paket_card3Group.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_paket_cek3Group.setVisible(true);
		}else if(value=='transfer'){
			master_jual_paket_transfer3Group.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_paket_kwitansi3Group.setVisible(true);
		}else if(value=='voucher'){
			master_jual_paket_voucher3Group.setVisible(true);
		}else if(value=='tunai'){
			master_jual_paket_tunai3Group.setVisible(true);
		}
	}
	
	
	function load_detail_jual_paket(){
		var detail_jual_paket_record;
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){
			detail_jual_paket_record=detail_jual_paket_DataStore.getAt(i);
			var j=cbo_dpaket_paketDataStore.find('dpaket_paket_value',detail_jual_paket_record.data.dpaket_paket);
			if(j>-1){
				detail_jual_paket_record.data.dpaket_harga=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_harga;
				if(detail_jual_paket_record.data.dpaket_diskon==""){
					if(jpaket_cust_nomemberField.getValue()!=""){
						if(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_dm!==0){
							detail_jual_paket_record.data.dpaket_diskon=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_dm;
							detail_jual_paket_record.data.dpaket_diskon_jenis='DM';
						}
					}else{
						if(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_du!==0){
							detail_jual_paket_record.data.dpaket_diskon=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_du;
							detail_jual_paket_record.data.dpaket_diskon_jenis='DU';
						}
					}
				}
			}
		}
	}
	
	
	/* START LOAD TOTAL BAYAR */
	function load_total_paket_bayar(){
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
		
		/* dpaket_kadaluarsa => disetValue sesuai dgn setting jml-hari Expired dari Master Paket */

		var detail_jual_paket_record;
		if(detail_jual_paket_DataStore.getCount()>0){
			detail_jual_paket_record=detail_jual_paket_DataStore.getAt(0);
			var j=cbo_dpaket_paketDataStore.find('dpaket_paket_value',detail_jual_paket_record.data.dpaket_paket);
			if(j>=0){
				detail_jual_paket_record.data.dpaket_harga=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_harga;
				var DayLength=1*24*60*60*1000;
				var Days=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_expired;
				//var dt_kadaluarsa=new Date(dt*1+DayLength*Days);
				var dt_kadaluarsa=new Date(jpaket_tanggalField.getValue()*1+DayLength*Days);
				detail_jual_paket_record.data.dpaket_kadaluarsa=dt_kadaluarsa;
				
				subtotal_harga=eval(detail_jual_paket_record.data.dpaket_jumlah*detail_jual_paket_record.data.dpaket_harga);
				//detail_jual_paket_record.data.dpaket_satuan=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_satuan;
				if(detail_jual_paket_record.data.dpaket_diskon==""){
					if(jpaket_cust_nomemberField.getValue()!=""){
						if(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_dm!==0){
							detail_jual_paket_record.data.dpaket_diskon=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_dm;
							detail_jual_paket_record.data.dpaket_diskon_jenis='DM';
						}
					}else{
						if(cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_du!==0){
							detail_jual_paket_record.data.dpaket_diskon=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_du;
							detail_jual_paket_record.data.dpaket_diskon_jenis='DU';
						}
					}
				}
			}
			detail_jual_paket_record.data.dpaket_subtotal=subtotal_harga;
			detail_jual_paket_record.data.dpaket_subtotal_net=subtotal_harga*((100-detail_jual_paket_record.data.dpaket_diskon)/100);
		}
		//(record.data.dpaket_subtotal* record.data.dpaket_jumlah*(100-record.data.dpaket_diskon)/100,'0,000')
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){
			jumlah_item=jumlah_item+eval(detail_jual_paket_DataStore.getAt(i).data.dpaket_jumlah);
			subtotal_harga_field+=detail_jual_paket_DataStore.getAt(i).data.dpaket_subtotal_net;
		}
		
		jpaket_jumlahField.setValue(jumlah_item);
		//jpaket_subTotalField.setValue(subtotal_harga*(100-detail_jual_paket_record.data.dpaket_diskon)/100);
		jpaket_subTotalField.setValue(subtotal_harga_field);
		total_harga=subtotal_harga_field*(100-jpaket_diskonField.getValue())/100 - jpaket_cashbackField.getValue();
		total_harga=(total_harga>0?Math.round(total_harga):0);
		//jpaket_subTotalField.setValue(total_harga);
		jpaket_totalField.setValue(total_harga);

		

		transfer_nilai=jpaket_transfer_nilaiField.getValue();
		if(/^\d+$/.test(transfer_nilai))
			transfer_nilai=jpaket_transfer_nilaiField.getValue();
		else
			transfer_nilai=0;
		
		transfer_nilai2=jpaket_transfer_nilai2Field.getValue();
		if(/^\d+$/.test(transfer_nilai2))
			transfer_nilai2=jpaket_transfer_nilai2Field.getValue();
		else
			transfer_nilai2=0;
		
		transfer_nilai3=jpaket_transfer_nilai3Field.getValue();
		if(/^\d+$/.test(transfer_nilai3))
			transfer_nilai3=jpaket_transfer_nilai3Field.getValue();
		else
			transfer_nilai3=0;
		
		kwitansi_nilai=jpaket_kwitansi_nilaiField.getValue();
		if(/^\d+$/.test(kwitansi_nilai))
			kwitansi_nilai=jpaket_kwitansi_nilaiField.getValue();
		else
			kwitansi_nilai=0;
		
		kwitansi_nilai2=jpaket_kwitansi_nilai2Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai2))
			kwitansi_nilai2=jpaket_kwitansi_nilai2Field.getValue();
		else
			kwitansi_nilai2=0;
		
		kwitansi_nilai3=jpaket_kwitansi_nilai3Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai3))
			kwitansi_nilai3=jpaket_kwitansi_nilai3Field.getValue();
		else
			kwitansi_nilai3=0;
		
		card_nilai=jpaket_card_nilaiField.getValue();
		if(/^\d+$/.test(card_nilai))
			card_nilai=jpaket_card_nilaiField.getValue();
		else
			card_nilai=0;
		
		card_nilai2=jpaket_card_nilai2Field.getValue();
		if(/^\d+$/.test(card_nilai2))
			card_nilai2=jpaket_card_nilai2Field.getValue();
		else
			card_nilai2=0;
		
		card_nilai3=jpaket_card_nilai3Field.getValue();
		if(/^\d+$/.test(card_nilai3))
			card_nilai3=jpaket_card_nilai3Field.getValue();
		else
			card_nilai3=0;
		
		cek_nilai=jpaket_cek_nilaiField.getValue();
		if(/^\d+$/.test(cek_nilai))
			cek_nilai=jpaket_cek_nilaiField.getValue();
		else
			cek_nilai=0;
		
		cek_nilai2=jpaket_cek_nilai2Field.getValue();
		if(/^\d+$/.test(cek_nilai2))
			cek_nilai2=jpaket_cek_nilai2Field.getValue();
		else
			cek_nilai2=0;
		
		cek_nilai3=jpaket_cek_nilai3Field.getValue();
		if(/^\d+$/.test(cek_nilai3))
			cek_nilai3=jpaket_cek_nilai3Field.getValue();
		else
			cek_nilai3=0;
		
		voucher_nilai=jpaket_voucher_cashbackField.getValue();
		if(/^\d+$/.test(voucher_nilai))
			voucher_nilai=jpaket_voucher_cashbackField.getValue();
		else
			voucher_nilai=0;
		
		voucher_nilai2=jpaket_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai2))
			voucher_nilai2=jpaket_voucher_cashback3Field.getValue();
		else
			voucher_nilai2=0;
		
		voucher_nilai3=jpaket_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai3))
			voucher_nilai3=jpaket_voucher_cashback3Field.getValue();
		else
			voucher_nilai3=0;

		tunai_nilai=jpaket_tunai_nilaiField.getValue();
		if(/^\d+$/.test(tunai_nilai))
			tunai_nilai=jpaket_tunai_nilaiField.getValue();
		else
			tunai_nilai=0;

		tunai_nilai2=jpaket_tunai_nilai2Field.getValue();
		if(/^\d+$/.test(tunai_nilai2))
			tunai_nilai2=jpaket_tunai_nilai2Field.getValue();
		else
			tunai_nilai2=0;

		tunai_nilai3=jpaket_tunai_nilai3Field.getValue();
		if(/^\d+$/.test(tunai_nilai3))
			tunai_nilai3=jpaket_tunai_nilai3Field.getValue();
		else
			tunai_nilai3=0;


		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		total_bayar=(total_bayar>0?Math.round(total_bayar):0);
		jpaket_bayarField.setValue(total_bayar);

		total_hutang=total_harga-total_bayar;
		total_hutang=(total_hutang>0?Math.round(total_hutang):0);
		jpaket_hutangField.setValue(total_hutang);
	}

	function load_total_bayar_updating(){
		var update_total_field=0;
		var update_hutang_field=0;
		var jpaket_bayar_temp=jpaket_bayarField.getValue();
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
		
		transfer_nilai=jpaket_transfer_nilaiField.getValue();
		if(/^\d+$/.test(transfer_nilai))
			transfer_nilai=jpaket_transfer_nilaiField.getValue();
		else
			transfer_nilai=0;

		transfer_nilai2=jpaket_transfer_nilai2Field.getValue();
		if(/^\d+$/.test(transfer_nilai2))
			transfer_nilai2=jpaket_transfer_nilai2Field.getValue();
		else
			transfer_nilai2=0;
		
		transfer_nilai3=jpaket_transfer_nilai3Field.getValue();
		if(/^\d+$/.test(transfer_nilai3))
			transfer_nilai3=jpaket_transfer_nilai3Field.getValue();
		else
			transfer_nilai3=0;
		
		kwitansi_nilai=jpaket_kwitansi_nilaiField.getValue();
		if(/^\d+$/.test(kwitansi_nilai))
			kwitansi_nilai=jpaket_kwitansi_nilaiField.getValue();
		else
			kwitansi_nilai=0;
		
		kwitansi_nilai2=jpaket_kwitansi_nilai2Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai2))
			kwitansi_nilai2=jpaket_kwitansi_nilai2Field.getValue();
		else
			kwitansi_nilai2=0;
		
		kwitansi_nilai3=jpaket_kwitansi_nilai3Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai3))
			kwitansi_nilai3=jpaket_kwitansi_nilai3Field.getValue();
		else
			kwitansi_nilai3=0;
		
		card_nilai=jpaket_card_nilaiField.getValue();
		if(/^\d+$/.test(card_nilai))
			card_nilai=jpaket_card_nilaiField.getValue();
		else
			card_nilai=0;
		
		card_nilai2=jpaket_card_nilai2Field.getValue();
		if(/^\d+$/.test(card_nilai2))
			card_nilai2=jpaket_card_nilai2Field.getValue();
		else
			card_nilai2=0;
		
		card_nilai3=jpaket_card_nilai3Field.getValue();
		if(/^\d+$/.test(card_nilai3))
			card_nilai3=jpaket_card_nilai3Field.getValue();
		else
			card_nilai3=0;
		
		cek_nilai=jpaket_cek_nilaiField.getValue();
		if(/^\d+$/.test(cek_nilai))
			cek_nilai=jpaket_cek_nilaiField.getValue();
		else
			cek_nilai=0;
		
		cek_nilai2=jpaket_cek_nilai2Field.getValue();
		if(/^\d+$/.test(cek_nilai2))
			cek_nilai2=jpaket_cek_nilai2Field.getValue();
		else
			cek_nilai2=0;
		
		cek_nilai3=jpaket_cek_nilai3Field.getValue();
		if(/^\d+$/.test(cek_nilai3))
			cek_nilai3=jpaket_cek_nilai3Field.getValue();
		else
			cek_nilai3=0;
		
		voucher_nilai=jpaket_voucher_cashbackField.getValue();
		if(/^\d+$/.test(voucher_nilai))
			voucher_nilai=jpaket_voucher_cashbackField.getValue();
		else
			voucher_nilai=0;
		
		voucher_nilai2=jpaket_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai2))
			voucher_nilai2=jpaket_voucher_cashback3Field.getValue();
		else
			voucher_nilai2=0;
		
		voucher_nilai3=jpaket_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai3))
			voucher_nilai3=jpaket_voucher_cashback3Field.getValue();
		else
			voucher_nilai3=0;

		tunai_nilai=jpaket_tunai_nilaiField.getValue();
		if(/^\d+$/.test(tunai_nilai))
			tunai_nilai=jpaket_tunai_nilaiField.getValue();
		else
			tunai_nilai=0;

		tunai_nilai2=jpaket_tunai_nilai2Field.getValue();
		if(/^\d+$/.test(tunai_nilai2))
			tunai_nilai2=jpaket_tunai_nilai2Field.getValue();
		else
			tunai_nilai2=0;

		tunai_nilai3=jpaket_tunai_nilai3Field.getValue();
		if(/^\d+$/.test(tunai_nilai3))
			tunai_nilai3=jpaket_tunai_nilai3Field.getValue();
		else
			tunai_nilai3=0;

		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		
		update_total_field=jpaket_subTotalField.getValue()*((100-jpaket_diskonField.getValue())/100)-jpaket_cashbackField.getValue();
		jpaket_totalField.setValue(update_total_field);

		jpaket_bayarField.setValue(total_bayar);
		
		update_hutang_field=update_total_field-total_bayar;
		jpaket_hutangField.setValue(update_hutang_field);

		jpaket_diskonField.setValue(jpaket_diskonField.getValue());
		jpaket_cashbackField.setValue(jpaket_cashbackField.getValue());
		jpaket_cashback_cfField.setValue(CurrencyFormatted(jpaket_cashbackField.getValue()));
	}
	/* END LOAD TOTAL BAYAR */
	
	
	function load_total_bayar(){
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
		
		/* dpaket_kadaluarsa => disetValue sesuai dgn setting jml-hari Expired dari Master Paket */

		var detail_jual_paket_record;
		
		//(record.data.dpaket_subtotal* record.data.dpaket_jumlah*(100-record.data.dpaket_diskon)/100,'0,000')
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){
			jumlah_item=jumlah_item+eval(detail_jual_paket_DataStore.getAt(i).data.dpaket_jumlah);
			subtotal_harga_field+=detail_jual_paket_DataStore.getAt(i).data.dpaket_subtotal_net;
		}
		
		jpaket_jumlahField.setValue(jumlah_item);
		//jpaket_subTotalField.setValue(subtotal_harga*(100-detail_jual_paket_record.data.dpaket_diskon)/100);
		jpaket_subTotalField.setValue(subtotal_harga_field);
		total_harga=subtotal_harga_field*(100-jpaket_diskonField.getValue())/100 - jpaket_cashbackField.getValue();
		total_harga=(total_harga>0?Math.round(total_harga):0);
		//jpaket_subTotalField.setValue(total_harga);
		jpaket_totalField.setValue(total_harga);

		

		transfer_nilai=jpaket_transfer_nilaiField.getValue();
		if(/^\d+$/.test(transfer_nilai))
			transfer_nilai=jpaket_transfer_nilaiField.getValue();
		else
			transfer_nilai=0;
		
		transfer_nilai2=jpaket_transfer_nilai2Field.getValue();
		if(/^\d+$/.test(transfer_nilai2))
			transfer_nilai2=jpaket_transfer_nilai2Field.getValue();
		else
			transfer_nilai2=0;
		
		transfer_nilai3=jpaket_transfer_nilai3Field.getValue();
		if(/^\d+$/.test(transfer_nilai3))
			transfer_nilai3=jpaket_transfer_nilai3Field.getValue();
		else
			transfer_nilai3=0;
		
		kwitansi_nilai=jpaket_kwitansi_nilaiField.getValue();
		if(/^\d+$/.test(kwitansi_nilai))
			kwitansi_nilai=jpaket_kwitansi_nilaiField.getValue();
		else
			kwitansi_nilai=0;
		
		kwitansi_nilai2=jpaket_kwitansi_nilai2Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai2))
			kwitansi_nilai2=jpaket_kwitansi_nilai2Field.getValue();
		else
			kwitansi_nilai2=0;
		
		kwitansi_nilai3=jpaket_kwitansi_nilai3Field.getValue();
		if(/^\d+$/.test(kwitansi_nilai3))
			kwitansi_nilai3=jpaket_kwitansi_nilai3Field.getValue();
		else
			kwitansi_nilai3=0;
		
		card_nilai=jpaket_card_nilaiField.getValue();
		if(/^\d+$/.test(card_nilai))
			card_nilai=jpaket_card_nilaiField.getValue();
		else
			card_nilai=0;
		
		card_nilai2=jpaket_card_nilai2Field.getValue();
		if(/^\d+$/.test(card_nilai2))
			card_nilai2=jpaket_card_nilai2Field.getValue();
		else
			card_nilai2=0;
		
		card_nilai3=jpaket_card_nilai3Field.getValue();
		if(/^\d+$/.test(card_nilai3))
			card_nilai3=jpaket_card_nilai3Field.getValue();
		else
			card_nilai3=0;
		
		cek_nilai=jpaket_cek_nilaiField.getValue();
		if(/^\d+$/.test(cek_nilai))
			cek_nilai=jpaket_cek_nilaiField.getValue();
		else
			cek_nilai=0;
		
		cek_nilai2=jpaket_cek_nilai2Field.getValue();
		if(/^\d+$/.test(cek_nilai2))
			cek_nilai2=jpaket_cek_nilai2Field.getValue();
		else
			cek_nilai2=0;
		
		cek_nilai3=jpaket_cek_nilai3Field.getValue();
		if(/^\d+$/.test(cek_nilai3))
			cek_nilai3=jpaket_cek_nilai3Field.getValue();
		else
			cek_nilai3=0;
		
		voucher_nilai=jpaket_voucher_cashbackField.getValue();
		if(/^\d+$/.test(voucher_nilai))
			voucher_nilai=jpaket_voucher_cashbackField.getValue();
		else
			voucher_nilai=0;
		
		voucher_nilai2=jpaket_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai2))
			voucher_nilai2=jpaket_voucher_cashback3Field.getValue();
		else
			voucher_nilai2=0;
		
		voucher_nilai3=jpaket_voucher_cashback3Field.getValue();
		if(/^\d+$/.test(voucher_nilai3))
			voucher_nilai3=jpaket_voucher_cashback3Field.getValue();
		else
			voucher_nilai3=0;

		tunai_nilai=jpaket_tunai_nilaiField.getValue();
		if(/^\d+$/.test(tunai_nilai))
			tunai_nilai=jpaket_tunai_nilaiField.getValue();
		else
			tunai_nilai=0;

		tunai_nilai2=jpaket_tunai_nilai2Field.getValue();
		if(/^\d+$/.test(tunai_nilai2))
			tunai_nilai2=jpaket_tunai_nilai2Field.getValue();
		else
			tunai_nilai2=0;

		tunai_nilai3=jpaket_tunai_nilai3Field.getValue();
		if(/^\d+$/.test(tunai_nilai3))
			tunai_nilai3=jpaket_tunai_nilai3Field.getValue();
		else
			tunai_nilai3=0;


		total_bayar=transfer_nilai+transfer_nilai2+transfer_nilai3+kwitansi_nilai+kwitansi_nilai2+kwitansi_nilai3+card_nilai+card_nilai2+card_nilai3+cek_nilai+cek_nilai2+cek_nilai3+voucher_nilai+voucher_nilai2+voucher_nilai3+tunai_nilai+tunai_nilai2+tunai_nilai3;
		total_bayar=(total_bayar>0?Math.round(total_bayar):0);
		jpaket_bayarField.setValue(total_bayar);

		total_hutang=total_harga-total_bayar;
		total_hutang=(total_hutang>0?Math.round(total_hutang):0);
		jpaket_hutangField.setValue(total_hutang);
	}
	
	function load_all_jual_paket(){
		//load_detail_jual_paket();
		load_total_paket_bayar();
	}
	//event on update of detail data store
	//detail_jual_paket_DataStore.on("update",load_all_jual_paket);
	detail_jual_paket_DataStore.on("update",load_total_bayar);
	jpaket_bayarField.on("keyup",load_total_paket_bayar);
	jpaket_diskonField.on("keyup",load_total_paket_bayar);
	jpaket_cashbackField.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_cashback_cfField.on("keyup",function(){
		var cf_value = jpaket_cashback_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_cashbackField.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_cashbackField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//kwitansi
	jpaket_kwitansi_nilaiField.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_kwitansi_nilai_cfField.on("keyup",function(){
		var cf_value = jpaket_kwitansi_nilai_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_kwitansi_nilaiField.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_kwitansi_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_kwitansi_nilai2Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_kwitansi_nilai2_cfField.on("keyup",function(){
		var cf_value = jpaket_kwitansi_nilai2_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_kwitansi_nilai2Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_kwitansi_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_kwitansi_nilai3Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_kwitansi_nilai3_cfField.on("keyup",function(){
		var cf_value = jpaket_kwitansi_nilai3_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_kwitansi_nilai3Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_produk_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_kwitansi_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//card
	jpaket_card_nilaiField.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_card_nilai_cfField.on("keyup",function(){
		var cf_value = jpaket_card_nilai_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_card_nilaiField.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_card_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_card_nilai2Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_card_nilai2_cfField.on("keyup",function(){
		var cf_value = jpaket_card_nilai2_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_card_nilai2Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_card_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_card_nilai3Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_card_nilai3_cfField.on("keyup",function(){
		var cf_value = jpaket_card_nilai3_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_card_nilai3Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_card_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//cek/giro
	jpaket_cek_nilaiField.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_cek_nilai_cfField.on("keyup",function(){
		var cf_value = jpaket_cek_nilai_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_cek_nilaiField.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_cek_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_cek_nilai2Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_cek_nilai2_cfField.on("keyup",function(){
		var cf_value = jpaket_cek_nilai2_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_cek_nilai2Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_cek_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_cek_nilai3Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_cek_nilai3_cfField.on("keyup",function(){
		var cf_value = jpaket_cek_nilai3_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_cek_nilai3Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_cek_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//transfer
	jpaket_transfer_nilaiField.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_transfer_nilai_cfField.on("keyup",function(){
		var cf_value = jpaket_transfer_nilai_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_transfer_nilaiField.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_transfer_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_transfer_nilai2Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_transfer_nilai2_cfField.on("keyup",function(){
		var cf_value = jpaket_transfer_nilai2_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_transfer_nilai2Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_transfer_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_transfer_nilai3Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_transfer_nilai3_cfField.on("keyup",function(){
		var cf_value = jpaket_transfer_nilai3_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_transfer_nilai3Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_transfer_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	//voucher
	jpaket_voucher_cashbackField.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_voucher_cashback2Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_voucher_cashback3Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	//tunai
	jpaket_tunai_nilaiField.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_tunai_nilai_cfField.on("keyup",function(){
		var cf_value = jpaket_tunai_nilai_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_tunai_nilaiField.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_tunai_nilaiField.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_tunai_nilai2Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_tunai_nilai2_cfField.on("keyup",function(){
		var cf_value = jpaket_tunai_nilai2_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_tunai_nilai2Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_tunai_nilai2Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	jpaket_tunai_nilai3Field.on("keyup",function(){if(jpaket_post2db=="CREATE"){load_total_paket_bayar();}else if(jpaket_post2db=="UPDATE"){load_total_bayar_updating();}});
	jpaket_tunai_nilai3_cfField.on("keyup",function(){
		var cf_value = jpaket_tunai_nilai3_cfField.getValue();
		if(jpaket_post2db=="CREATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_tunai_nilai3Field.setValue(cf_tonumber);
			load_total_paket_bayar();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_paket_bayar();
		}else if(jpaket_post2db=="UPDATE"){
			var cf_tonumber = convertToNumber(cf_value);
			jpaket_tunai_nilai3Field.setValue(cf_tonumber);
			load_total_bayar_updating();
			
			var number_tocf = CurrencyFormatted(cf_value);
			this.setRawValue(number_tocf);
			//load_total_bayar_updating();
		}
	});
	
	jpaket_caraField.on("select",update_group_carabayar_jual_paket);
	jpaket_cara2Field.on("select",update_group_carabayar2_jual_paket);
	jpaket_cara3Field.on("select",update_group_carabayar3_jual_paket);
	jpaket_custField.on("select",function(){
		load_membership();
		j=memberDataStore.find('member_cust',jpaket_custField.getValue());
		if(j>-1)
			jpaket_cust_nomemberField.setValue(memberDataStore.getAt(j).member_no);
		else
			jpaket_cust_nomemberField.setValue("");

		cbo_cust=cbo_cust_jual_paket_DataStore.find('cust_id',jpaket_custField.getValue());
		if(cbo_cust>-1){
			cbo_kwitansi_jual_paket_DataStore.load({params: {kwitansi_cust: cbo_cust_jual_paket_DataStore.getAt(cbo_cust).data.cust_id}});
			jpaket_cek_namaField.setValue(cbo_cust_jual_paket_DataStore.getAt(cbo_cust).data.cust_nama);
			jpaket_cek_nama2Field.setValue(cbo_cust_jual_paket_DataStore.getAt(cbo_cust).data.cust_nama);
			jpaket_cek_nama3Field.setValue(cbo_cust_jual_paket_DataStore.getAt(cbo_cust).data.cust_nama);

			jpaket_transfer_namaField.setValue(cbo_cust_jual_paket_DataStore.getAt(cbo_cust).data.cust_nama);
			jpaket_transfer_nama2Field.setValue(cbo_cust_jual_paket_DataStore.getAt(cbo_cust).data.cust_nama);
			jpaket_transfer_nama3Field.setValue(cbo_cust_jual_paket_DataStore.getAt(cbo_cust).data.cust_nama);
		}
	});
	
	function show_windowGrid(){
		master_jual_paket_DataStore.load({
			params: {start: 0, limit: pageS},
			callback: function(opts, success, response){
				if(success){
					master_jual_paket_createWindow.show();
				}
			}
		});	// load DataStore
	}
	
	var detail_tab_jual_paket = new Ext.TabPanel({
		plain:true,
		activeTab: 0,
		autoHeight: true,
		items: [detail_jual_paketListEditorGrid,detail_pengguna_paketListEditorGrid]
	});
	
	/* Function for retrieve create Window Panel*/ 
	master_jual_paket_createForm = new Ext.FormPanel({
		title: 'Penjualan Paket',
		labelAlign: 'left',
		el: 'form_paket_addEdit',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 940,	//950,
		//plain: true,
		frame:true,
		layout: 'fit',
		items: [master_jual_paket_masterGroup,detail_tab_jual_paket,master_jual_paket_bayarGroup]
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
				handler: master_jual_paket_create
			},
			{
				text: 'Cancel',
				handler: function(){
					master_jual_paket_reset_form();
					detail_jual_paket_DataStore.load({params: {master_id:0}});
					jpaket_caraField.setValue("card");
					master_jual_paket_cardGroup.setVisible(true);
					detail_pengguna_paket_DataStore.removeAll();
					master_cara_bayarTabPanel.setActiveTab(0);
					jpaket_post2db="CREATE";
				}
			}
		]
	});
	/* End  of Function*/
	
	
	/* Function for retrieve create Window Form */
	master_jual_paket_createWindow= new Ext.Window({
		id: 'master_jual_paket_createWindow',
		//title: jpaket_post2db+'Master_jual_paket',
		title: 'Daftar Penjualan Paket',
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
		renderTo: 'elwindow_master_jual_paket_create',
		items: master_jual_paketListEditorGrid
	});
	/* End Window */
	
	/* Function for action list search */
	function master_jual_paket_list_search(){
		// render according to a SQL date format.
		var jpaket_id_search=null;
		var jpaket_nobukti_search=null;
		var jpaket_cust_search=null;
		var jpaket_tanggal_search_date="";
		var jpaket_tanggal_akhir_search_date="";
		var jpaket_diskon_search=null;
		var jpaket_cara_search=null;
		var jpaket_keterangan_search=null;
		var jpaket_stat_dok_search=null;

		if(jpaket_idSearchField.getValue()!==null){jpaket_id_search=jpaket_idSearchField.getValue();}
		if(jpaket_nobuktiSearchField.getValue()!==null){jpaket_nobukti_search=jpaket_nobuktiSearchField.getValue();}
		if(jpaket_custSearchField.getValue()!==null){jpaket_cust_search=jpaket_custSearchField.getValue();}
		if(jpaket_tanggalSearchField.getValue()!==""){jpaket_tanggal_search_date=jpaket_tanggalSearchField.getValue().format('Y-m-d');}
		if(jpaket_tanggal_akhirSearchField.getValue()!==""){jpaket_tanggal_akhir_search_date=jpaket_tanggal_akhirSearchField.getValue().format('Y-m-d');}
		if(jpaket_diskonSearchField.getValue()!==null){jpaket_diskon_search=jpaket_diskonSearchField.getValue();}
		if(jpaket_caraSearchField.getValue()!==null){jpaket_cara_search=jpaket_caraSearchField.getValue();}
		if(jpaket_keteranganSearchField.getValue()!==null){jpaket_keterangan_search=jpaket_keteranganSearchField.getValue();}
		if(jpaket_stat_dokSearchField.getValue()!==null){jpaket_stat_dok_search=jpaket_stat_dokSearchField.getValue();}
		// change the store parameters
		master_jual_paket_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jpaket_id	:	jpaket_id_search, 
			jpaket_nobukti	:	jpaket_nobukti_search, 
			jpaket_cust	:	jpaket_cust_search, 
			jpaket_tanggal	:	jpaket_tanggal_search_date, 
			jpaket_tanggal_akhir	:	jpaket_tanggal_akhir_search_date, 
			jpaket_diskon	:	jpaket_diskon_search, 
			jpaket_cara	:	jpaket_cara_search, 
			jpaket_keterangan	:	jpaket_keterangan_search, 
			jpaket_stat_dok	:	jpaket_stat_dok_search, 
		};
		// Cause the datastore to do another query : 
		master_jual_paket_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_jual_paket_reset_search(){
		// reset the store parameters
		master_jual_paket_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_jual_paket_DataStore.reload({params: {start: 0, limit: pageS}});
		master_jual_paket_searchWindow.close();
	};
	/* End of Fuction */

	function master_jual_paket_reset_SearchForm(){
		jpaket_nobuktiSearchField.reset();
		jpaket_custSearchField.reset();
		jpaket_tanggalSearchField.reset();
		jpaket_tanggal_akhirSearchField.reset();
		jpaket_diskonSearchField.reset();
		jpaket_caraSearchField.reset();
		jpaket_keteranganSearchField.reset();
		jpaket_stat_dokSearchField.reset();
	}
	
	/* Field for search */
	/* Identify  jpaket_id Search Field */
	jpaket_idSearchField= new Ext.form.NumberField({
		id: 'jpaket_idSearchField',
		fieldLabel: 'Jpaket Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jpaket_nobukti Search Field */
	jpaket_nobuktiSearchField= new Ext.form.TextField({
		id: 'jpaket_nobuktiSearchField',
		fieldLabel: 'No Faktur',
		maxLength: 30,
//		anchor: '95%'
	
	});
	/* Identify  jpaket_cust Search Field */
	jpaket_custSearchField= new Ext.form.TextField({
		id: 'jpaket_custSearchField',
		fieldLabel: 'Customer',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  jpaket_tanggal Search Field */
	jpaket_tanggalSearchField= new Ext.form.DateField({
		id: 'jpaket_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y',
	});
	jpaket_tanggal_akhirSearchField= new Ext.form.DateField({
		id: 'jpaket_tanggal_akhirSearchField',
		fieldLabel: 's/d',
		format : 'd-m-Y',	
	});
	/* Identify  jpaket_diskon Search Field */
	jpaket_diskonSearchField= new Ext.form.NumberField({
		id: 'jpaket_diskonSearchField',
		fieldLabel: 'Diskon',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jpaket_cara Search Field */
	jpaket_caraSearchField= new Ext.form.ComboBox({
		id: 'jpaket_caraSearchField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jpaket_cara'],
			data:[['tunai','Tunai'],['kwitansi','Kwitansi'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer'],['voucher','Voucher']]
		}),
		mode: 'local',
		displayField: 'jpaket_cara',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jpaket_keterangan Search Field */
	jpaket_keteranganSearchField= new Ext.form.TextArea({
		id: 'jpaket_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
 
	jpaket_stat_dokSearchField= new Ext.form.ComboBox({
		id: 'jpaket_stat_dokSearchField',
		fieldLabel: 'Status Dokumen',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jpaket_stat_dok'],
			data:[['Terbuka','Terbuka'], ['Tertutup','Tertutup'], ['Batal','Batal']]
		}),
		mode: 'local',
		displayField: 'jpaket_stat_dok',
		valueField: 'value',
		//anchor: '60%', //'95%',
		width: 96,
		triggerAction: 'all'	 	
	});
 
	/* Function for retrieve search Form Panel */
	master_jual_paket_searchForm = new Ext.FormPanel({
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
				items: [jpaket_nobuktiSearchField, jpaket_custSearchField, 

					{
						layout:'column',
						border:false,
						items:[
						{
							columnWidth:0.45,
							layout: 'form',
							border:false,
							defaultType: 'datefield',
							items: [						
								jpaket_tanggalSearchField
							]
						},
						{
							columnWidth:0.30,
							layout: 'form',
							border:false,
							labelWidth:30,
							defaultType: 'datefield',
							items: [						
								jpaket_tanggal_akhirSearchField
							]
						}						
								
				        ]
					},	
				//jpaket_diskonSearchField, 
				jpaket_caraSearchField, jpaket_keteranganSearchField, jpaket_stat_dokSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_jual_paket_list_search
			},{
				text: 'Close',
				handler: function(){
					master_jual_paket_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_jual_paket_searchWindow = new Ext.Window({
		title: 'Pencarian Penjualan Paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_jual_paket_search',
		items: master_jual_paket_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_jual_paket_searchWindow.isVisible()){
			master_jual_paket_reset_SearchForm();
			master_jual_paket_searchWindow.show();
		} else {
			master_jual_paket_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_jual_paket_print(){
		var searchquery = "";
		var jpaket_nobukti_print=null;
		var jpaket_cust_print=null;
		var jpaket_tanggal_print_date="";
		var jpaket_diskon_print=null;
		var jpaket_cara_print=null;
		var jpaket_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_paket_DataStore.baseParams.query!==null){searchquery = master_jual_paket_DataStore.baseParams.query;}
		if(master_jual_paket_DataStore.baseParams.jpaket_nobukti!==null){jpaket_nobukti_print = master_jual_paket_DataStore.baseParams.jpaket_nobukti;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cust!==null){jpaket_cust_print = master_jual_paket_DataStore.baseParams.jpaket_cust;}
		if(master_jual_paket_DataStore.baseParams.jpaket_tanggal!==""){jpaket_tanggal_print_date = master_jual_paket_DataStore.baseParams.jpaket_tanggal;}
		if(master_jual_paket_DataStore.baseParams.jpaket_diskon!==null){jpaket_diskon_print = master_jual_paket_DataStore.baseParams.jpaket_diskon;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cara!==null){jpaket_cara_print = master_jual_paket_DataStore.baseParams.jpaket_cara;}
		if(master_jual_paket_DataStore.baseParams.jpaket_keterangan!==null){jpaket_keterangan_print = master_jual_paket_DataStore.baseParams.jpaket_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon  Tunggu...',
		url: 'index.php?c=c_master_jual_paket&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jpaket_nobukti : jpaket_nobukti_print,
			jpaket_cust : jpaket_cust_print,
		  	jpaket_tanggal : jpaket_tanggal_print_date, 
			jpaket_diskon : jpaket_diskon_print,
			jpaket_cara : jpaket_cara_print,
			jpaket_keterangan : jpaket_keterangan_print,
		  	currentlisting: master_jual_paket_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_jual_paketlist.html','master_jual_paketlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_jual_paket_export_excel(){
		var searchquery = "";
		var jpaket_nobukti_2excel=null;
		var jpaket_cust_2excel=null;
		var jpaket_tanggal_2excel_date="";
		var jpaket_diskon_2excel=null;
		var jpaket_cara_2excel=null;
		var jpaket_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_paket_DataStore.baseParams.query!==null){searchquery = master_jual_paket_DataStore.baseParams.query;}
		if(master_jual_paket_DataStore.baseParams.jpaket_nobukti!==null){jpaket_nobukti_2excel = master_jual_paket_DataStore.baseParams.jpaket_nobukti;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cust!==null){jpaket_cust_2excel = master_jual_paket_DataStore.baseParams.jpaket_cust;}
		if(master_jual_paket_DataStore.baseParams.jpaket_tanggal!==""){jpaket_tanggal_2excel_date = master_jual_paket_DataStore.baseParams.jpaket_tanggal;}
		if(master_jual_paket_DataStore.baseParams.jpaket_diskon!==null){jpaket_diskon_2excel = master_jual_paket_DataStore.baseParams.jpaket_diskon;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cara!==null){jpaket_cara_2excel = master_jual_paket_DataStore.baseParams.jpaket_cara;}
		if(master_jual_paket_DataStore.baseParams.jpaket_keterangan!==null){jpaket_keterangan_2excel = master_jual_paket_DataStore.baseParams.jpaket_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon  Tunggu...',
		url: 'index.php?c=c_master_jual_paket&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jpaket_nobukti : jpaket_nobukti_2excel,
			jpaket_cust : jpaket_cust_2excel,
		  	jpaket_tanggal : jpaket_tanggal_2excel_date, 
			jpaket_diskon : jpaket_diskon_2excel,
			jpaket_cara : jpaket_cara_2excel,
			jpaket_keterangan : jpaket_keterangan_2excel,
		  	currentlisting: master_jual_paket_DataStore.baseParams.task // this tells us if we are searching or not
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
		jpaket_post2db="CREATE";
		jpaket_tanggalField.setValue(dt.format('Y-m-d'));
		master_jual_paket_createForm.render();
		jpaket_caraField.setValue('card');
		master_jual_paket_cardGroup.setVisible(true);
	}
	pertamax();
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_jual_paket"></div>
         <div id="fp_detail_jual_paket"></div>
		 <div id="fp_detail_pengguna_paket"></div>
		<div id="elwindow_master_jual_paket_create"></div>
        <div id="elwindow_master_jual_paket_search"></div>
        <div id="form_paket_addEdit"></div>
    </div>
</div>
</body>