<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_rawat View
	+ Description	: For record view
	+ Filename 		: v_master_jual_rawat.php
 	+ Author  		: 
 	+ Created on 01/Sep/2009 23:13:09
	
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
var master_jual_rawat_ColumnModel;
var master_jual_rawatListEditorGrid;
var master_jual_rawat_createForm;
var master_jual_rawat_createWindow;
var master_jual_rawat_searchForm;
var master_jual_rawat_searchWindow;
var master_jual_rawat_SelectedRow;
var master_jual_rawat_ContextMenu;
//for detail data
var detail_jual_rawat_DataStor;
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
var jrawat_cashbackField;
var jrawat_caraField;
var jrawat_cara2Field;
var jrawat_cara3Field;
var jrawat_bayarField;
var jrawat_keteranganField;
//voucher
var jrawat_voucher_noField;
var jrawat_voucher_cashbackField;
//voucher-2
var jrawat_voucher_no2Field;
var jrawat_voucher_cashback2Field;
//voucher-3
var jrawat_voucher_no3Field;
var jrawat_voucher_cashback3Field;

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
var jrawat_card_nameField;
var jrawat_card_edcField;

//cek
var jrawat_cek_nameField;
var jrawat_cek_noField;
var jrawat_cek_validField;
var jrawat_cek_bankField;
//transfer
var jrawat_transfer_bankField;


var jrawat_idSearchField;
var jrawat_nobuktiSearchField;
var jrawat_custSearchField;
var jrawat_tanggalSearchField;
var jrawat_diskonSearchField;
var jrawat_cashbackSearchField;
var jrawat_voucherSearchField;
var jrawat_caraSearchField;
var jrawat_cara2SearchField;
var jrawat_cara3SearchField;
var jrawat_bayarSearchField;
var jrawat_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_jual_rawat_update(oGrid_event){
		var jrawat_id_update_pk="";
		var jrawat_nobukti_update=null;
		var jrawat_cust_update=null;
		var jrawat_tanggal_update_date="";
		var jrawat_diskon_update=null;
		var jrawat_cashback_update=null;
		var jrawat_voucher_update=null;
		var jrawat_cara_update=null;
		var jrawat_bayar_update=null;
		var jrawat_keterangan_update=null;

		jrawat_id_update_pk = oGrid_event.record.data.jrawat_id;
		if(oGrid_event.record.data.jrawat_nobukti!== null){jrawat_nobukti_update = oGrid_event.record.data.jrawat_nobukti;}
		if(oGrid_event.record.data.jrawat_cust!== null){jrawat_cust_update = oGrid_event.record.data.jrawat_cust;}
	 	if(oGrid_event.record.data.jrawat_tanggal!== ""){jrawat_tanggal_update_date =oGrid_event.record.data.jrawat_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jrawat_diskon!== null){jrawat_diskon_update = oGrid_event.record.data.jrawat_diskon;}
		if(oGrid_event.record.data.jrawat_cashback!== null){jrawat_cashback_update = oGrid_event.record.data.jrawat_cashback;}
		if(oGrid_event.record.data.jrawat_voucher!== null){jrawat_voucher_update = oGrid_event.record.data.jrawat_voucher;}
		if(oGrid_event.record.data.jrawat_cara!== null){jrawat_cara_update = oGrid_event.record.data.jrawat_cara;}
		if(oGrid_event.record.data.jrawat_bayar!== null){jrawat_bayar_update = oGrid_event.record.data.jrawat_bayar;}
		if(oGrid_event.record.data.jrawat_keterangan!== null){jrawat_keterangan_update = oGrid_event.record.data.jrawat_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_jual_rawat&m=get_action',
			params: {
				task: "UPDATE",
				jrawat_id	: jrawat_id_update_pk, 
				jrawat_nobukti	:jrawat_nobukti_update,  
				jrawat_cust	:jrawat_cust_update,  
				jrawat_tanggal	: jrawat_tanggal_update_date, 
				jrawat_diskon	:jrawat_diskon_update,  
				jrawat_cashback	:jrawat_cashback_update,  
				jrawat_voucher	:jrawat_voucher_update,  
				jrawat_cara	:jrawat_cara_update,  
				jrawat_bayar	:jrawat_bayar_update,  
				jrawat_keterangan	:jrawat_keterangan_update,  
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
						   msg: 'We could\'t not save the master_jual_rawat.',
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
		var jrawat_cashback_create=null; 
		var jrawat_voucher_create=null; 
		var jrawat_cara_create=null; 
		var jrawat_cara2_create=null; 
		var jrawat_cara3_create=null; 
		var jrawat_bayar_create=null; 
		var jrawat_keterangan_create=null; 
		//voucher
		var jrawat_voucher_no_create=null;
		var jrawat_voucher_cashback_create=null;
		//voucher-2
		var jrawat_voucher_no2_create=null;
		var jrawat_voucher_cashback2_create=null;
		//voucher-3
		var jrawat_voucher_no3_create=null;
		var jrawat_voucher_cashback3_create=null;
		//bayar
		var jrawat_total_create=null;
		var jrawat_bayar_create=null;
		var jrawat_total_bayar_create=null;
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
		//cek
		var jrawat_cek_nama_create=null;
		var jrawat_cek_nomor_create=null;
		var jrawat_cek_valid_create="";
		var jrawat_cek_bank_create=null;
		//cek
		var jrawat_transfer_bank_create=null;
		
		if(jrawat_idField.getValue()!== null){jrawat_id_create = jrawat_idField.getValue();}else{jrawat_id_create_pk=get_pk_id();} 
		if(jrawat_nobuktiField.getValue()!== null){jrawat_nobukti_create = jrawat_nobuktiField.getValue();} 
		if(jrawat_custField.getValue()!== null){jrawat_cust_create = jrawat_custField.getValue();} 
		if(jrawat_tanggalField.getValue()!== ""){jrawat_tanggal_create_date = jrawat_tanggalField.getValue().format('Y-m-d');} 
		if(jrawat_diskonField.getValue()!== null){jrawat_diskon_create = jrawat_diskonField.getValue();} 
		if(jrawat_cashbackField.getValue()!== null){jrawat_cashback_create = jrawat_cashbackField.getValue();} 
		if(jrawat_caraField.getValue()!== null){jrawat_cara_create = jrawat_caraField.getValue();} 
		if(jrawat_cara2Field.getValue()!== null){jrawat_cara2_create = jrawat_cara2Field.getValue();} 
		if(jrawat_cara3Field.getValue()!== null){jrawat_cara3_create = jrawat_cara3Field.getValue();} 
		if(jrawat_bayarField.getValue()!== null){jrawat_bayar_create = jrawat_bayarField.getValue();} 
		if(jrawat_keteranganField.getValue()!== null){jrawat_keterangan_create = jrawat_keteranganField.getValue();} 
		//voucher
		if(jrawat_voucher_noField.getValue()!== null){jrawat_voucher_no_create = jrawat_voucher_noField.getValue();} 
		if(jrawat_voucher_cashbackField.getValue()!== null){jrawat_voucher_cashback_create = jrawat_voucher_cashbackField.getValue();} 
		//voucher-2
		if(jrawat_voucher_no2Field.getValue()!== null){jrawat_voucher_no2_create = jrawat_voucher_no2Field.getValue();} 
		if(jrawat_voucher_cashback2Field.getValue()!== null){jrawat_voucher_cashback2_create = jrawat_voucher_cashback2Field.getValue();} 
		//voucher-3
		if(jrawat_voucher_no3Field.getValue()!== null){jrawat_voucher_no3_create = jrawat_voucher_no3Field.getValue();} 
		if(jrawat_voucher_cashback3Field.getValue()!== null){jrawat_voucher_cashback3_create = jrawat_voucher_cashback3Field.getValue();} 
		//bayar
		if(jrawat_bayarField.getValue()!== null){jrawat_bayar_create = jrawat_bayarField.getValue();}
		if(jrawat_totalField.getValue()!== null){jrawat_total_create = jrawat_totalField.getValue();} 
		if(jrawat_totalbayarField.getValue()!== null){jrawat_total_bayar_create = jrawat_totalbayarField.getValue();} 
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
		if(jrawat_card_nameField.getValue()!== null){jrawat_card_nama_create = jrawat_card_nameField.getValue();} 
		if(jrawat_card_edcField.getValue()!=null){jrawat_card_edc_create = jrawat_card_edcField.getValue();} 
		//cek value
		if(jrawat_cek_nameField.getValue()!== null){jrawat_cek_nama_create = jrawat_cek_nameField.getValue();} 
		if(jrawat_cek_noField.getValue()!== null){jrawat_cek_nomor_create = jrawat_cek_noField.getValue();} 
		if(jrawat_cek_validField.getValue()!== ""){jrawat_cek_valid_create = jrawat_cek_validField.getValue().format('Y-m-d');} 
		if(jrawat_cek_bankField.getValue()!== null){jrawat_cek_bank_create = jrawat_cek_bankField.getValue();} 
		//transfer value
		if(jrawat_transfer_bankField.getValue()!== null){jrawat_transfer_bank_create = jrawat_transfer_bankField.getValue();} 
		
		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_jual_rawat&m=get_action',
			params: {
				task: post2db,
				jrawat_id	: jrawat_id_create_pk, 
				jrawat_nobukti	: jrawat_nobukti_create, 
				jrawat_cust	: jrawat_cust_create, 
				jrawat_tanggal	: jrawat_tanggal_create_date, 
				jrawat_diskon	: jrawat_diskon_create, 
				jrawat_cashback	: jrawat_cashback_create, 
				jrawat_voucher	: jrawat_voucher_create, 
				jrawat_cara	: jrawat_cara_create, 
				jrawat_cara2	: jrawat_cara2_create, 
				jrawat_cara3	: jrawat_cara3_create, 
				jrawat_bayar	: jrawat_bayar_create, 
				jrawat_keterangan	: jrawat_keterangan_create,
				//voucher
				jrawat_voucher_no	:	jrawat_voucher_no_create,
				jrawat_voucher_cashback	:	jrawat_voucher_cashback_create,
				//voucher-2
				jrawat_voucher_no2	:	jrawat_voucher_no2_create,
				jrawat_voucher_cashback2	:	jrawat_voucher_cashback2_create,
				//voucher-3
				jrawat_voucher_no3	:	jrawat_voucher_no3_create,
				jrawat_voucher_cashback3	:	jrawat_voucher_cashback3_create,
				//bayar
				jrawat_bayar			: 	jrawat_bayar_create,
				jrawat_total			: 	jrawat_total_create,
				jrawat_total_bayar		: 	jrawat_total_bayar_create,
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
				//cek posting
				jrawat_cek_nama	: 	jrawat_cek_nama_create,
				jrawat_cek_no		:	jrawat_cek_nomor_create,
				jrawat_cek_valid	: 	jrawat_cek_valid_create,
				jrawat_cek_bank	:	jrawat_cek_bank_create,
				//transfer posting
				jrawat_transfer_bank	:	jrawat_transfer_bank_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_jual_rawat_purge()
						detail_jual_rawat_insert();
						Ext.MessageBox.alert(post2db+' OK','The Master_jual_rawat was '+msg+' successfully.');
						master_jual_rawat_DataStore.reload();
						master_jual_rawat_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_jual_rawat.',
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
			return master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	// Reset kwitansi option
	function kwitansi_jual_produk_reset_form(){
		jrawat_kwitansi_namaField.reset();
		jrawat_kwitansi_nilaiField.reset();
		jrawat_kwitansi_noField.reset();
	}
	// Reset kwitansi-2 option
	function kwitansi2_jual_produk_reset_form(){
		jrawat_kwitansi_nama2Field.reset();
		jrawat_kwitansi_nilai2Field.reset();
		jrawat_kwitansi_no2Field.reset();
	}
	// Reset kwitansi-3 option
	function kwitansi3_jual_produk_reset_form(){
		jrawat_kwitansi_nama3Field.reset();
		jrawat_kwitansi_nilai3Field.reset();
		jrawat_kwitansi_no3Field.reset();
	}
	
	// Reset card option
	function card_jual_rawat_reset_form(){
		jrawat_card_nameField.reset();
		jrawat_card_edcField.reset();
	}
	
	// Reset cek option
	function cek_jual_rawat_reset_form(){
		jrawat_cek_nameField.reset();
		jrawat_cek_noField.reset();
		jrawat_cek_validField.reset();
		jrawat_cek_bankField.reset();
	}
	
	// Reset transfer option
	function transfer_jual_rawat_reset_form(){
		jrawat_transfer_bankField.reset();
	}
	
	
	/* Reset form before loading */
	function master_jual_rawat_reset_form(){
		jrawat_idField.reset();
		jrawat_idField.setValue(null);
		jrawat_nobuktiField.reset();
		jrawat_nobuktiField.setValue(null);
		jrawat_custField.reset();
		jrawat_custField.setValue(null);
		jrawat_tanggalField.reset();
		jrawat_tanggalField.setValue(null);
		jrawat_diskonField.reset();
		jrawat_diskonField.setValue(null);
		jrawat_cashbackField.reset();
		jrawat_cashbackField.setValue(null);
		jrawat_caraField.reset();
		jrawat_caraField.setValue(null);
		jrawat_cara2Field.reset();
		jrawat_cara2Field.setValue(null);
		jrawat_cara3Field.reset();
		jrawat_cara3Field.setValue(null);
		jrawat_bayarField.reset();
		jrawat_bayarField.setValue(null);
		jrawat_keteranganField.reset();
		jrawat_keteranganField.setValue(null);
		transfer_jual_rawat_reset_form();
		card_jual_rawat_reset_form();
		cek_jual_rawat_reset_form();
		kwitansi_jual_rawat_reset_form();
		update_group_carabayar_jual_rawat();
		update_group_carabayar2_jual_rawat();
		update_group_carabayar3_jual_rawat();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_jual_rawat_set_form(){
		jrawat_idField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_id'));
		jrawat_nobuktiField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_nobukti'));
		jrawat_custField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cust'));
		jrawat_tanggalField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_tanggal'));
		jrawat_diskonField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_diskon'));
		jrawat_cashbackField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cashback'));
		jrawat_caraField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cara'));
		jrawat_cara2Field.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cara2'));
		jrawat_cara3Field.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_cara3'));
		jrawat_bayarField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_bayar'));
		jrawat_keteranganField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_keterangan'));

		jrawat_keteranganField.setValue(master_jual_rawatListEditorGrid.getSelectionModel().getSelected().get('jrawat_keterangan'));
		load_membership();
		update_group_carabayar_jual_rawat();
		
		switch(jrawat_caraField.getValue()){
			case 'kwitansi':
				kwitansi_jual_rawat_DataStore.load({
					params : { no_faktur: jrawat_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_rawat_DataStore.getCount()){
								jrawat_kwitansi_record=kwitansi_jual_rawat_DataStore.getAt(0).data;
								jrawat_kwitansi_noField.setValue(jrawat_kwitansi_record.jkwitansi_no);
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
								jrawat_card_nameField.setValue(jrawat_card_record.jcard_nama);
								jrawat_card_edcField.setValue(jrawat_card_record.jcard_edc);
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
									jrawat_cek_nameField.setValue(jrawat_cek_record.jcek_nama);
									jrawat_cek_noField.setValue(jrawat_cek_record.jcek_no);
									jrawat_cek_validField.setValue(jrawat_cek_record.jcek_valid);
									jrawat_cek_bankField.setValue(jrawat_cek_record.jcek_bank);
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
									}
							}
					 	}
				  });
				break;
		}
		
		detail_jual_rawat_DataStore.load({params:{master_id: jrawat_idField.getValue()}});
		
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
		return (true );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_jual_rawat_createWindow.isVisible()){
			master_jual_rawat_reset_form();
			post2db='CREATE';
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
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_jual_rawat_delete);
		} else if(master_jual_rawatListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_jual_rawat_delete);
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
	function master_jual_rawat_confirm_update(){
		/* only one record is selected here */
		if(master_jual_rawatListEditorGrid.selModel.getCount() == 1) {
			master_jual_rawat_set_form();
			master_cara_bayarTabPanel.setActiveTab(0);
			post2db='UPDATE';
			detail_jual_rawat_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			master_jual_rawat_createWindow.show();
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
	function master_jual_rawat_delete(btn){
		if(btn=='yes'){
			var selections = master_jual_rawatListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_jual_rawatListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jrawat_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
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
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jrawat_id'
		},[
		/* dataIndex => insert intomaster_jual_rawat_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jrawat_id', type: 'int', mapping: 'jrawat_id'}, 
			{name: 'jrawat_nobukti', type: 'string', mapping: 'jrawat_nobukti'}, 
			{name: 'jrawat_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'jrawat_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jrawat_tanggal'}, 
			{name: 'jrawat_diskon', type: 'float', mapping: 'jrawat_diskon'}, 
			{name: 'jrawat_cashback', type: 'float', mapping: 'jrawat_cashback'}, 
			{name: 'jrawat_voucher', type: 'string', mapping: 'jrawat_voucher'}, 
			{name: 'jrawat_cara', type: 'string', mapping: 'jrawat_cara'}, 
			{name: 'jrawat_cara2', type: 'string', mapping: 'jrawat_cara2'}, 
			{name: 'jrawat_cara3', type: 'string', mapping: 'jrawat_cara3'}, 
			{name: 'jrawat_bayar', type: 'float', mapping: 'jrawat_bayar'}, 
			{name: 'jrawat_keterangan', type: 'string', mapping: 'jrawat_keterangan'}, 
			{name: 'jrawat_creator', type: 'string', mapping: 'jrawat_creator'}, 
			{name: 'jrawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jrawat_date_create'}, 
			{name: 'jrawat_update', type: 'string', mapping: 'jrawat_update'}, 
			{name: 'jrawat_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jrawat_date_update'}, 
			{name: 'jrawat_revised', type: 'int', mapping: 'jrawat_revised'} 
		]),
		sortInfo:{field: 'jrawat_id', direction: "DESC"}
	});
	/* End of Function */
    
	/* Function for Retrieve DataStore */
	
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
			{name: 'ckwitansi_cust_notelp', type: 'string', mapping: 'cust_telprumah'}
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
			{name: 'jkwitansi_no', type: 'string', mapping: 'jkwitansi_no'}
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
			{name: 'jcard_nama', type: 'string', mapping: 'jcard_nama'},
			{name: 'jcard_edc', type: 'string', mapping: 'jcard_edc'}
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
			{name: 'jtransfer_bank', type: 'string', mapping: 'jtransfer_bank'},
		]),
		sortInfo:{field: 'jtransfer_id', direction: "DESC"}
	});
	/* End of Function */
	
  	/* Function for Identify of Window Column Model */
	master_jual_rawat_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jrawat_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'No. Faktur',
			dataIndex: 'jrawat_nobukti',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}, 
		{
			header: 'Customer',
			dataIndex: 'jrawat_cust',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'jrawat_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Diskon (%)',
			dataIndex: 'jrawat_diskon',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Potongan (Rp)',
			dataIndex: 'jrawat_cashback',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		},
		{
			header: 'Cara Bayar',
			dataIndex: 'jrawat_cara',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Jumlah Bayar',
			dataIndex: 'jrawat_bayar',
			width: 150,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'jrawat_keterangan',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
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
			header: 'Create on',
			dataIndex: 'jrawat_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'jrawat_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update on',
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
		title: 'List Of Jual Perawatan',
		autoHeight: true,
		store: master_jual_rawat_DataStore, // DataStore
		cm: master_jual_rawat_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
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
			handler: master_jual_rawat_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_jual_rawat_DataStore,
			params: {start: 0, limit: pageS},
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
		master_jual_rawatListEditorGrid.startEditing(master_jual_rawat_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_jual_rawatListEditorGrid.addListener('rowcontextmenu', onmaster_jual_rawat_ListEditGridContextMenu);
	master_jual_rawat_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_jual_rawatListEditorGrid.on('afteredit', master_jual_rawat_update); // inLine Editing Record
	
	// Custom rendering Template
    var customer_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	var voucher_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{voucher_nomor}</b>| {voucher_nama}<br/>Jenis: {voucher_jenis}</span>',
		'</div></tpl>'
    );
	
	
	var kwitansi_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{ckwitansi_no}</b> <br/>',
			'a/n {ckwitansi_cust_nama} [ {ckwitansi_cust_no} ]<br/>',
			'Alamat: {ckwitansi_cust_alamat}, notelp: {ckwitansi_cust_notelp} </span>',
		'</div></tpl>'
    );
	
	var rawat_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{drawat_rawat_kode}</b>| {drawat_rawat_display}<br/>Group: {drawat_rawat_group}<br/>',
			'Kategori: {drawat_rawat_kategori}</span>',
		'</div></tpl>'
    );
	
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
		fieldLabel: 'Nomor Faktur',
		maxLength: 30,
		anchor: '95%'
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
	/* Identify  jrawat_tanggal Field */
	jrawat_tanggalField= new Ext.form.DateField({
		id: 'jrawat_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d'
	});
	/* Identify  jrawat_diskon Field */
	jrawat_diskonField= new Ext.form.NumberField({
		id: 'jrawat_diskonField',
		fieldLabel: 'Diskon (%)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		allowDecimals: true,
		maxLength: 2,
		width: 100,
		maskRe: /([0-9]+)$/
	});
	/* Identify  jrawat_cashback Field */
	jrawat_cashbackField= new Ext.form.NumberField({
		id: 'jrawat_cashbackField',
		fieldLabel: 'Potongan Penjualan (Rp)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		allowDecimals: true,
		width: 100,
		maskRe: /([0-9]+)$/
	});
	
	/* START Voucher-1*/
	jrawat_voucher_noField= new Ext.form.ComboBox({
		id: 'jrawat_voucher_noField',
		fieldLabel: 'Nomor Voucher',
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
	
	jrawat_voucher_cashbackField= new Ext.form.NumberField({
		id: 'jrawat_voucher_cashbackField',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%'
	});
	
	master_jual_rawat_voucherGroup= new Ext.form.FieldSet({
		title: '',
		autoHeight: true,
		collapsible: false,
		border: false,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_voucher_noField,jrawat_voucher_cashbackField] 
			}
		]
	
	});
	/* END Voucher-1 */
	/* START Voucher-2*/
	jrawat_voucher_no2Field= new Ext.form.ComboBox({
		id: 'jrawat_voucher_no2Field',
		fieldLabel: 'Nomor Voucher',
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
	
	jrawat_voucher_cashback2Field= new Ext.form.NumberField({
		id: 'jrawat_voucher_cashback2Field',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%'
	});
	
	master_jual_rawat_voucher2Group= new Ext.form.FieldSet({
		title: '',
		autoHeight: true,
		collapsible: false,
		border: false,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_voucher_no2Field,jrawat_voucher_cashback2Field] 
			}
		]
	
	});
	/* END Voucher-2 */
	/* START Voucher-3*/
	jrawat_voucher_no3Field= new Ext.form.ComboBox({
		id: 'jrawat_voucher_no3Field',
		fieldLabel: 'Nomor Voucher',
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
	
	jrawat_voucher_cashback3Field= new Ext.form.NumberField({
		id: 'jrawat_voucher_cashback3Field',
		fieldLabel: 'Nilai Cashback',
		anchor: '95%'
	});
	
	master_jual_rawat_voucher3Group= new Ext.form.FieldSet({
		title: '',
		autoHeight: true,
		collapsible: false,
		border: false,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_voucher_no3Field,jrawat_voucher_cashback3Field] 
			}
		]
	
	});
	/* END Voucher-3 */
	
	/* Identify  jrawat_cara Field */
	jrawat_caraField= new Ext.form.ComboBox({
		id: 'jrawat_caraField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_cara_value', 'jrawat_cara_display'],
			data:[['tunai','tunai'],['voucher','voucher'],['card','card'],['cek/giro','cek/giro'],['kwitansi','kwitansi'],['transfer','transfer']]
		}),
		mode: 'local',
		displayField: 'jrawat_cara_display',
		valueField: 'jrawat_cara_value',
		//anchor: '95%',
		width:100,
		triggerAction: 'all'	
	});
	jrawat_cara2Field= new Ext.form.ComboBox({
		id: 'jrawat_cara2Field',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_cara_value', 'jrawat_cara_display'],
			data:[['tunai','tunai'],['voucher','voucher'],['card','card'],['cek/giro','cek/giro'],['kwitansi','kwitansi'],['transfer','transfer']]
		}),
		mode: 'local',
		displayField: 'jrawat_cara_display',
		valueField: 'jrawat_cara_value',
		//anchor: '95%',
		width:100,
		triggerAction: 'all'	
	});
	jrawat_cara3Field= new Ext.form.ComboBox({
		id: 'jrawat_cara3Field',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['jrawat_cara_value', 'jrawat_cara_display'],
			data:[['tunai','tunai'],['voucher','voucher'],['card','card'],['cek/giro','cek/giro'],['kwitansi','kwitansi'],['transfer','transfer']]
		}),
		mode: 'local',
		displayField: 'jrawat_cara_display',
		valueField: 'jrawat_cara_value',
		//anchor: '95%',
		width:100,
		triggerAction: 'all'	
	});
	/* Identify  jrawat_bayar Field */
	jrawat_bayarField= new Ext.form.NumberField({
		id: 'jrawat_bayarField',
		fieldLabel: 'Jumlah Bayar',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jrawat_keterangan Field */
	jrawat_keteranganField= new Ext.form.TextArea({
		id: 'jrawat_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	jrawat_cust_nomemberField= new Ext.form.TextField({
		id: 'jrawat_cust_nomemberField',
		fieldLabel: 'Nomor Member',
		maxLength: 250,
		anchor: '95%'
	});
	
	
	// Field Card
	jrawat_card_nameField= new Ext.form.ComboBox({
		id: 'jrawat_card_nameField',
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
	
		
	jrawat_card_edcField= new Ext.form.TextField({
		id: 'jrawat_card_edcField',
		fieldLabel: 'EDC',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	master_jual_rawat_cardGroup= new Ext.form.FieldSet({
		title: 'Credit Card',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_card_nameField,jrawat_card_edcField] 
			}
		]
	
	});
	
	//Field Ceck
	jrawat_cek_nameField= new Ext.form.TextField({
		id: 'jrawat_cek_nameField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_cek_noField= new Ext.form.TextField({
		id: 'jrawat_cek_noField',
		fieldLabel: 'Nomor Cek',
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
	
	jrawat_cek_bankField= new Ext.form.TextField({
		id: 'jrawat_cek_bankField',
		fieldLabel: 'Bank',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	
	master_jual_rawat_cekGroup = new Ext.form.FieldSet({
		title: 'Check/Giro',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_cek_nameField,jrawat_cek_noField,jrawat_cek_validField,jrawat_cek_bankField] 
			}
		]
	
	});
	
	//Field Transfer
	jrawat_transfer_bankField= new Ext.form.TextField({
		id: 'jrawat_transfer_bankField',
		fieldLabel: 'Bank',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	master_jual_rawat_transferGroup = new Ext.form.FieldSet({
		title: 'Transfer',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jrawat_transfer_bankField] 
			}
		]
	
	});
	
	//START Field Kwitansi-1
	jrawat_kwitansi_namaField= new Ext.form.TextField({
		id: 'jrawat_kwitansi_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_nilaiField= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_nilaiField',
		fieldLabel: 'Nilai',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_noField= new Ext.form.ComboBox({
		id: 'jrawat_kwitansi_noField',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_produk_DataStore,
		mode: 'remote',
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
	
	jrawat_kwitansi_noField.on("select",function(){
			j=cbo_kwitansi_jual_produk_DataStore.find('ckwitansi_id',jrawat_kwitansi_noField.getValue());
			if(j>-1){
				jrawat_kwitansi_namaField.setValue(cbo_kwitansi_jual_produk_DataStore.getAt(j).data.ckwitansi_cust_nama);
			}
		});
	// END Kwitansi-1
	
	//START Field Kwitansi-2
	jrawat_kwitansi_nama2Field= new Ext.form.TextField({
		id: 'jrawat_kwitansi_nama2Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_nilai2Field= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_nilai2Field',
		fieldLabel: 'Nilai',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_no2Field= new Ext.form.ComboBox({
		id: 'jrawat_kwitansi_no2Field',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_produk_DataStore,
		mode: 'remote',
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
	
	jrawat_kwitansi_no2Field.on("select",function(){
			j=cbo_kwitansi_jual_produk_DataStore.find('ckwitansi_id',jrawat_kwitansi_no2Field.getValue());
			if(j>-1){
				jrawat_kwitansi_nama2Field.setValue(cbo_kwitansi_jual_produk_DataStore.getAt(j).data.ckwitansi_cust_nama);
			}
		});
	// END Kwitansi-2
	
	//START Field Kwitansi-3
	jrawat_kwitansi_nama3Field= new Ext.form.TextField({
		id: 'jrawat_kwitansi_nama3Field',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_nilai3Field= new Ext.form.NumberField({
		id: 'jrawat_kwitansi_nilai3Field',
		fieldLabel: 'Nilai',
		allowBlank: true,
		anchor: '95%'
	});
	
	jrawat_kwitansi_no3Field= new Ext.form.ComboBox({
		id: 'jrawat_kwitansi_no3Field',
		fieldLabel: 'Nomor Kwitansi',
		store: cbo_kwitansi_jual_produk_DataStore,
		mode: 'remote',
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
	
	jrawat_kwitansi_no3Field.on("select",function(){
			j=cbo_kwitansi_jual_produk_DataStore.find('ckwitansi_id',jrawat_kwitansi_no3Field.getValue());
			if(j>-1){
				jrawat_kwitansi_nama3Field.setValue(cbo_kwitansi_jual_produk_DataStore.getAt(j).data.ckwitansi_cust_nama);
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
				items: [jrawat_kwitansi_noField,jrawat_kwitansi_namaField,jrawat_kwitansi_nilaiField] 
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
				items: [jrawat_kwitansi_no2Field,jrawat_kwitansi_nama2Field,jrawat_kwitansi_nilai2Field] 
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
				items: [jrawat_kwitansi_no3Field,jrawat_kwitansi_nama3Field,jrawat_kwitansi_nilai3Field] 
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
		width: 50,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jrawat_totalField= new Ext.form.NumberField({
		id: 'jrawat_totalField',
		fieldLabel: 'Total Nilai',
		readOnly: true,
		allowDecimals: false,
		allowBlank: true,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jrawat_bayarField= new Ext.form.NumberField({
		id: 'jrawat_bayarField',
		fieldLabel: 'Uang Muka/ Tunai (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		allowDecimals: false,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jrawat_totalbayarField= new Ext.form.NumberField({
		id: 'jrawat_totalbayarField',
		fieldLabel: 'Total Hutang (Rp)',
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
		height: 232,
		width: 500,
		defaults:{bodyStyle:'padding:10px'},
		items:[{
                title:'Cara Bayar 1',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jrawat_caraField,master_jual_rawat_cardGroup,master_jual_rawat_cekGroup,master_jual_rawat_kwitansiGroup,master_jual_rawat_transferGroup,master_jual_rawat_voucherGroup]
            },{
                title:'Cara Bayar 2',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jrawat_cara2Field, master_jual_rawat_kwitansi2Group ,master_jual_rawat_card2Group, master_jual_rawat_cek2Group, master_jual_rawat_transfer2Group, master_jual_rawat_voucher2Group]
            },{
                title:'Cara Bayar 3',
                layout:'form',
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [jrawat_cara3Field, master_jual_rawat_kwitansi3Group, master_jual_rawat_card3Group, master_jual_rawat_cek3Group, master_jual_rawat_transfer3Group, master_jual_rawat_voucher3Group]
            }]
	});
	
	master_jual_rawat_bayarGroup = new Ext.form.FieldSet({
		title: '-',
		labelWidth: 150,
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			   {
				columnWidth:0.7,
				layout: 'form',
				border:false,
				items: [master_cara_bayarTabPanel] 
			}
			,{
				columnWidth:0.3,
				layout: 'form',
    			labelPad: 0,
				baseCls: 'x-plain',
				border:false,
				labelAlign: 'left',
				items: [jrawat_jumlahField,jrawat_totalField, jrawat_diskonField, jrawat_cashbackField, jrawat_bayarField,jrawat_totalbayarField] 
			}
			]
	
	});
	
	
  	/*Fieldset Master*/
	master_jual_rawat_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jrawat_nobuktiField, jrawat_custField, jrawat_cust_nomemberField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jrawat_keteranganField, jrawat_tanggalField, jrawat_idField] 
			}/*,
			{
				columnWidth:0.33,
				layout: 'form',
				border:false,
				items: [master_jual_rawat_voucherGroup,jrawat_idField] 
			}*/
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_jual_rawat_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'drawat_id', type: 'int', mapping: 'drawat_id'}, 
			{name: 'drawat_master', type: 'int', mapping: 'drawat_master'}, 
			{name: 'drawat_rawat', type: 'int', mapping: 'drawat_rawat'}, 
			{name: 'drawat_jumlah', type: 'int', mapping: 'drawat_jumlah'}, 
			{name: 'drawat_harga', type: 'float', mapping: 'drawat_harga'}, 
			{name: 'drawat_diskon', type: 'int', mapping: 'drawat_diskon'}, 
			{name: 'drawat_diskon_jenis', type: 'string', mapping: 'drawat_diskon_jenis'}, 
			{name: 'drawat_sales', type: 'string', mapping: 'drawat_sales'} 
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
		baseParams:{master_id: jrawat_idField.getValue()},
		sortInfo:{field: 'drawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_jual_rawat= new Ext.ux.grid.RowEditor({
        saveText: 'Update',
		listeners: {
			afteredit: function(){
				detail_jual_rawat_DataStore.commitChanges();
			}
		}
    });
	//eof
	
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
	
	
		
	Ext.util.Format.comboRenderer = function(combo){
		cbo_drawat_rawatDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_jual_rawat=new Ext.form.ComboBox({
			store: cbo_drawat_rawatDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'drawat_rawat_display',
			valueField: 'drawat_rawat_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:10,
			hideTrigger:false,
			tpl: rawat_jual_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
		

	//declaration of detail coloumn model
	detail_jual_rawat_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Perawatan',
			dataIndex: 'drawat_rawat',
			width: 250,
			sortable: true,
			editor: combo_jual_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_jual_rawat)
		},
		{
			header: 'Jumlah',
			dataIndex: 'drawat_jumlah',
			width: 80,
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
			header: 'Harga (Rp)',
			dataIndex: 'drawat_harga',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},{
			header: 'Sub Total (Rp)',
			dataIndex: 'drawat_diskon',
			width: 150,
			sortable: true,
			reaOnly: true,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.drawat_harga* record.data.drawat_jumlah,'0,000');
            }
		},
		{
			header: 'Diskon (%)',
			dataIndex: 'drawat_diskon',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000%'),
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 2,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'Jenis Diskon',
			dataIndex: 'drawat_diskon_jenis',
			width: 150,
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
			header: 'Sub Total Net (Rp)',
			dataIndex: 'drawat_diskon',
			width: 150,
			sortable: true,
			reaOnly: true,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.drawat_harga* record.data.drawat_jumlah*(100-record.data.drawat_diskon)/100,'0,000');
            }
		},
		{
			header: 'Sales',
			dataIndex: 'drawat_sales',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}]
	);
	detail_jual_rawat_ColumnModel.defaultSortable= true;
	//eof
	
	function get_harga_rawat(id_rawat){
		var harga_rawat=0;
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_jual_rawat&m=get_harga_rawat',
			params:{ rawat_id	: id_rawat },
			success: function(response){							
				var result=response.responseText;
				harga_rawat=result;
			}
		});
		return harga_rawat;
	}
	
	//declaration of detail list editor grid
	detail_jual_rawatListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_jual_rawatListEditorGrid',
		el: 'fp_detail_jual_rawat',
		title: 'Detail detail_jual_rawat',
		height: 250,
		width: 890,
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
			drawat_rawat	:'',		
			drawat_jumlah	:'',		
			drawat_harga	:'',		
			drawat_diskon	:'',		
			drawat_diskon_jenis	:'',		
			drawat_sales	:''		
		});
		editor_detail_jual_rawat.stopEditing();
		detail_jual_rawat_DataStore.insert(0, edit_detail_jual_rawat);
		detail_jual_rawatListEditorGrid.getView().refresh();
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
		for(i=0;i<detail_jual_rawat_DataStore.getCount();i++){
			detail_jual_rawat_record=detail_jual_rawat_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_jual_rawat&m=detail_detail_jual_rawat_insert',
				params:{
				drawat_id	: detail_jual_rawat_record.data.drawat_id, 
				drawat_master	: eval(jrawat_idField.getValue()), 
				drawat_rawat	: detail_jual_rawat_record.data.drawat_rawat, 
				drawat_jumlah	: detail_jual_rawat_record.data.drawat_jumlah, 
				drawat_harga	: detail_jual_rawat_record.data.drawat_harga, 
				drawat_diskon	: detail_jual_rawat_record.data.drawat_diskon, 
				drawat_diskon_jenis	: detail_jual_rawat_record.data.drawat_diskon_jenis, 
				drawat_sales	: detail_jual_rawat_record.data.drawat_sales 
				
				},
				timeout: 60000,
				success: function(response){							
					var result=eval(response.responseText);
					console.log(result);
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
		master_jual_rawat_cardGroup.setVisible(false);
		master_jual_rawat_cekGroup.setVisible(false);
		master_jual_rawat_transferGroup.setVisible(false);
		master_jual_rawat_kwitansiGroup.setVisible(false);
		master_jual_rawat_voucherGroup.setVisible(false);
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
		}
	}
	
	function update_group_carabayar2_jual_rawat(){
		var value=jrawat_cara2Field.getValue();
		master_jual_rawat_card2Group.setVisible(false);
		master_jual_rawat_cek2Group.setVisible(false);
		master_jual_rawat_transfer2Group.setVisible(false);
		master_jual_rawat_kwitansi2Group.setVisible(false);
		master_jual_rawat_voucher2Group.setVisible(false);
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
		}
	}
	
	function update_group_carabayar3_jual_rawat(){
		var value=jrawat_cara3Field.getValue();
		master_jual_rawat_card3Group.setVisible(false);
		master_jual_rawat_cek3Group.setVisible(false);
		master_jual_rawat_transfer3Group.setVisible(false);
		master_jual_rawat_kwitansi3Group.setVisible(false);
		master_jual_rawat_voucher3Group.setVisible(false);
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
		}
	}
	
	
	function load_detail_jual_rawat(){
		var detail_jual_rawat_record;
		for(i=0;i<detail_jual_rawat_DataStore.getCount();i++){
			detail_jual_rawat_record=detail_jual_rawat_DataStore.getAt(i);
			var j=cbo_drawat_rawatDataStore.find('drawat_rawat_value',detail_jual_rawat_record.data.drawat_rawat);
			if(j>0){
				detail_jual_rawat_record.data.drawat_harga=cbo_drawat_rawatDataStore.getAt(j).data.drawat_rawat_harga;
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
		var total_harga=0;
		var total_hutang=0;
		var detail_jual_rawat_record;
		for(i=0;i<detail_jual_rawat_DataStore.getCount();i++){
			detail_jual_rawat_record=detail_jual_rawat_DataStore.getAt(i);
			jumlah_item=jumlah_item+eval(detail_jual_rawat_record.data.drawat_jumlah);
			total_harga=total_harga+eval(detail_jual_rawat_record.data.drawat_jumlah*detail_jual_rawat_record.data.drawat_harga*(100-detail_jual_rawat_record.data.drawat_diskon)/100);
		}
		jrawat_jumlahField.setValue(jumlah_item);
		total_harga=total_harga*(100-jrawat_diskonField.getValue())/100 - jrawat_cashbackField.getValue();
		total_harga=(total_harga>0?Math.round(total_harga):0);
		jrawat_totalField.setValue(total_harga);
		total_hutang=total_harga-jrawat_bayarField.getValue();
		total_hutang=(total_hutang>0?Math.round(total_hutang):0);
		jrawat_totalbayarField.setValue(total_hutang);
	}
	
	function load_all_jual_rawat(){
		load_detail_jual_rawat();
		load_total_rawat_bayar();
	}
	//event on update of detail data store
	detail_jual_rawat_DataStore.on("update",load_all_jual_rawat);
	detail_jual_rawat_DataStore.on("load",load_total_rawat_bayar);
	jrawat_bayarField.on("keyup",load_total_rawat_bayar);
	jrawat_diskonField.on("keyup",load_total_rawat_bayar);
	jrawat_cashbackField.on("keyup",load_total_rawat_bayar);
	jrawat_caraField.on("select",update_group_carabayar_jual_rawat);
	jrawat_cara2Field.on("select",update_group_carabayar2_jual_rawat);
	jrawat_cara3Field.on("select",update_group_carabayar3_jual_rawat);
	jrawat_custField.on("select",
		function(){
			load_membership();
			j=memberDataStore.find('member_cust',jrawat_custField.getValue());
			console.log(jrawat_custField.getValue());
			if(j>-1)
				jrawat_cust_nomemberField.setValue(memberDataStore.getAt(j).member_no);
			else
				jrawat_cust_nomemberField.setValue("");
		});
	//event on update of detail data store
	
	/* Function for retrieve create Window Panel*/ 
	master_jual_rawat_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 900,
		layout: 'form',
		items: [master_jual_rawat_masterGroup,detail_jual_rawatListEditorGrid, master_jual_rawat_bayarGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_jual_rawat_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_jual_rawat_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_jual_rawat_createWindow= new Ext.Window({
		id: 'master_jual_rawat_createWindow',
		title: post2db+'Master_jual_rawat',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
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
		var jrawat_tanggal_search_date="";
		var jrawat_diskon_search=null;
		var jrawat_cashback_search=null;
		var jrawat_voucher_search=null;
		var jrawat_cara_search=null;
		var jrawat_bayar_search=null;
		var jrawat_keterangan_search=null;

		if(jrawat_idSearchField.getValue()!==null){jrawat_id_search=jrawat_idSearchField.getValue();}
		if(jrawat_nobuktiSearchField.getValue()!==null){jrawat_nobukti_search=jrawat_nobuktiSearchField.getValue();}
		if(jrawat_custSearchField.getValue()!==null){jrawat_cust_search=jrawat_custSearchField.getValue();}
		if(jrawat_tanggalSearchField.getValue()!==""){jrawat_tanggal_search_date=jrawat_tanggalSearchField.getValue().format('Y-m-d');}
		if(jrawat_diskonSearchField.getValue()!==null){jrawat_diskon_search=jrawat_diskonSearchField.getValue();}
		if(jrawat_cashbackSearchField.getValue()!==null){jrawat_cashback_search=jrawat_cashbackSearchField.getValue();}
		if(jrawat_voucherSearchField.getValue()!==null){jrawat_voucher_search=jrawat_voucherSearchField.getValue();}
		if(jrawat_caraSearchField.getValue()!==null){jrawat_cara_search=jrawat_caraSearchField.getValue();}
		if(jrawat_bayarSearchField.getValue()!==null){jrawat_bayar_search=jrawat_bayarSearchField.getValue();}
		if(jrawat_keteranganSearchField.getValue()!==null){jrawat_keterangan_search=jrawat_keteranganSearchField.getValue();}
		// change the store parameters
		master_jual_rawat_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jrawat_id	:	jrawat_id_search, 
			jrawat_nobukti	:	jrawat_nobukti_search, 
			jrawat_cust	:	jrawat_cust_search, 
			jrawat_tanggal	:	jrawat_tanggal_search_date, 
			jrawat_diskon	:	jrawat_diskon_search, 
			jrawat_cashback	:	jrawat_cashback_search, 
			jrawat_voucher	:	jrawat_voucher_search, 
			jrawat_cara	:	jrawat_cara_search, 
			jrawat_bayar	:	jrawat_bayar_search, 
			jrawat_keterangan	:	jrawat_keterangan_search, 
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
		fieldLabel: 'Jrawat Nobukti',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  jrawat_cust Search Field */
	jrawat_custSearchField= new Ext.form.NumberField({
		id: 'jrawat_custSearchField',
		fieldLabel: 'Jrawat Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jrawat_tanggal Search Field */
	jrawat_tanggalSearchField= new Ext.form.DateField({
		id: 'jrawat_tanggalSearchField',
		fieldLabel: 'Jrawat Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jrawat_diskon Search Field */
	jrawat_diskonSearchField= new Ext.form.NumberField({
		id: 'jrawat_diskonSearchField',
		fieldLabel: 'Jrawat Diskon',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jrawat_cashback Search Field */
	jrawat_cashbackSearchField= new Ext.form.NumberField({
		id: 'jrawat_cashbackSearchField',
		fieldLabel: 'Jrawat Cashback',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jrawat_voucher Search Field */
	jrawat_voucherSearchField= new Ext.form.ComboBox({
		id: 'jrawat_voucherSearchField',
		fieldLabel: 'Jrawat Voucher',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jrawat_voucher'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jrawat_voucher',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jrawat_cara Search Field */
	jrawat_caraSearchField= new Ext.form.ComboBox({
		id: 'jrawat_caraSearchField',
		fieldLabel: 'Jrawat Cara',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jrawat_cara'],
			data:[['tunai','tunai'],['kredit','kredit'],['card','card'],['cek/giro','cek/giro'],['kwitansi','kwitansi'],['transfer','transfer']]
		}),
		mode: 'local',
		displayField: 'jrawat_cara',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jrawat_bayar Search Field */
	jrawat_bayarSearchField= new Ext.form.NumberField({
		id: 'jrawat_bayarSearchField',
		fieldLabel: 'Jrawat Bayar',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jrawat_keterangan Search Field */
	jrawat_keteranganSearchField= new Ext.form.TextField({
		id: 'jrawat_keteranganSearchField',
		fieldLabel: 'Jrawat Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_jual_rawat_searchForm = new Ext.FormPanel({
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
				items: [jrawat_nobuktiSearchField, jrawat_custSearchField, jrawat_tanggalSearchField, jrawat_diskonSearchField, jrawat_cashbackSearchField, jrawat_voucherSearchField, jrawat_caraSearchField, jrawat_bayarSearchField, jrawat_keteranganSearchField] 
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
		var jrawat_cashback_print=null;
		var jrawat_voucher_print=null;
		var jrawat_cara_print=null;
		var jrawat_bayar_print=null;
		var jrawat_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_rawat_DataStore.baseParams.query!==null){searchquery = master_jual_rawat_DataStore.baseParams.query;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_nobukti!==null){jrawat_nobukti_print = master_jual_rawat_DataStore.baseParams.jrawat_nobukti;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cust!==null){jrawat_cust_print = master_jual_rawat_DataStore.baseParams.jrawat_cust;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_tanggal!==""){jrawat_tanggal_print_date = master_jual_rawat_DataStore.baseParams.jrawat_tanggal;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_diskon!==null){jrawat_diskon_print = master_jual_rawat_DataStore.baseParams.jrawat_diskon;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cashback!==null){jrawat_cashback_print = master_jual_rawat_DataStore.baseParams.jrawat_cashback;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_voucher!==null){jrawat_voucher_print = master_jual_rawat_DataStore.baseParams.jrawat_voucher;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cara!==null){jrawat_cara_print = master_jual_rawat_DataStore.baseParams.jrawat_cara;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_bayar!==null){jrawat_bayar_print = master_jual_rawat_DataStore.baseParams.jrawat_bayar;}
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
			jrawat_cashback : jrawat_cashback_print,
			jrawat_voucher : jrawat_voucher_print,
			jrawat_cara : jrawat_cara_print,
			jrawat_bayar : jrawat_bayar_print,
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
		var jrawat_cashback_2excel=null;
		var jrawat_voucher_2excel=null;
		var jrawat_cara_2excel=null;
		var jrawat_bayar_2excel=null;
		var jrawat_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_rawat_DataStore.baseParams.query!==null){searchquery = master_jual_rawat_DataStore.baseParams.query;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_nobukti!==null){jrawat_nobukti_2excel = master_jual_rawat_DataStore.baseParams.jrawat_nobukti;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cust!==null){jrawat_cust_2excel = master_jual_rawat_DataStore.baseParams.jrawat_cust;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_tanggal!==""){jrawat_tanggal_2excel_date = master_jual_rawat_DataStore.baseParams.jrawat_tanggal;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_diskon!==null){jrawat_diskon_2excel = master_jual_rawat_DataStore.baseParams.jrawat_diskon;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cashback!==null){jrawat_cashback_2excel = master_jual_rawat_DataStore.baseParams.jrawat_cashback;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_voucher!==null){jrawat_voucher_2excel = master_jual_rawat_DataStore.baseParams.jrawat_voucher;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_cara!==null){jrawat_cara_2excel = master_jual_rawat_DataStore.baseParams.jrawat_cara;}
		if(master_jual_rawat_DataStore.baseParams.jrawat_bayar!==null){jrawat_bayar_2excel = master_jual_rawat_DataStore.baseParams.jrawat_bayar;}
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
			jrawat_cashback : jrawat_cashback_2excel,
			jrawat_voucher : jrawat_voucher_2excel,
			jrawat_cara : jrawat_cara_2excel,
			jrawat_bayar : jrawat_bayar_2excel,
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
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_jual_rawat"></div>
         <div id="fp_detail_jual_rawat"></div>
		<div id="elwindow_master_jual_rawat_create"></div>
        <div id="elwindow_master_jual_rawat_search"></div>
    </div>
</div>
</body>