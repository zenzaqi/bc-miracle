<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_paket View
	+ Description	: For record view
	+ Filename 		: v_master_jual_paket.php
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
var master_jual_paket_DataStore;
var master_jual_paket_ColumnModel;
var master_jual_paketListEditorGrid;
var master_jual_paket_createForm;
var master_jual_paket_createWindow;
var master_jual_paket_searchForm;
var master_jual_paket_searchWindow;
var master_jual_paket_SelectedRow;
var master_jual_paket_ContextMenu;
//for detail data
var detail_jual_paket_DataStor;
var detail_jual_paketListEditorGrid;
var detail_jual_paket_ColumnModel;
var detail_jual_paket_proxy;
var detail_jual_paket_writer;
var detail_jual_paket_reader;
var editor_detail_jual_paket;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var dt= new Date();
/* declare variable here for Field*/
var jpaket_idField;
var jpaket_nobuktiField;
var jpaket_custField;
var jpaket_tanggalField;
var jpaket_diskonField;
var jpaket_cashbackField;
var jpaket_voucherField;
var jpaket_caraField;
var jpaket_bayarField;
var jpaket_keteranganField;
var jpaket_voucher_noField;
var is_member=false;
//kwitansi
var jpaket_kwitansi_nameField;
var jpaket_kwitansi_noField;
//card
var jpaket_card_nameField;
var jpaket_card_edcField;

//cek
var jpaket_cek_nameField;
var jpaket_cek_noField;
var jpaket_cek_validField;
var jpaket_cek_bankField;
//transfer
var jpaket_transfer_bankField;


var jpaket_idSearchField;
var jpaket_nobuktiSearchField;
var jpaket_custSearchField;
var jpaket_tanggalSearchField;
var jpaket_diskonSearchField;
var jpaket_cashbackSearchField;
var jpaket_voucherSearchField;
var jpaket_caraSearchField;
var jpaket_bayarSearchField;
var jpaket_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_jual_paket_update(oGrid_event){
		var jpaket_id_update_pk="";
		var jpaket_nobukti_update=null;
		var jpaket_cust_update=null;
		var jpaket_tanggal_update_date="";
		var jpaket_diskon_update=null;
		var jpaket_cashback_update=null;
		var jpaket_voucher_update=null;
		var jpaket_cara_update=null;
		var jpaket_bayar_update=null;
		var jpaket_keterangan_update=null;

		jpaket_id_update_pk = oGrid_event.record.data.jpaket_id;
		if(oGrid_event.record.data.jpaket_nobukti!== null){jpaket_nobukti_update = oGrid_event.record.data.jpaket_nobukti;}
		if(oGrid_event.record.data.jpaket_cust!== null){jpaket_cust_update = oGrid_event.record.data.jpaket_cust;}
	 	if(oGrid_event.record.data.jpaket_tanggal!== ""){jpaket_tanggal_update_date =oGrid_event.record.data.jpaket_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jpaket_diskon!== null){jpaket_diskon_update = oGrid_event.record.data.jpaket_diskon;}
		if(oGrid_event.record.data.jpaket_cashback!== null){jpaket_cashback_update = oGrid_event.record.data.jpaket_cashback;}
		if(oGrid_event.record.data.jpaket_voucher!== null){jpaket_voucher_update = oGrid_event.record.data.jpaket_voucher;}
		if(oGrid_event.record.data.jpaket_cara!== null){jpaket_cara_update = oGrid_event.record.data.jpaket_cara;}
		if(oGrid_event.record.data.jpaket_bayar!== null){jpaket_bayar_update = oGrid_event.record.data.jpaket_bayar;}
		if(oGrid_event.record.data.jpaket_keterangan!== null){jpaket_keterangan_update = oGrid_event.record.data.jpaket_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_jual_paket&m=get_action',
			params: {
				task: "UPDATE",
				jpaket_id	: jpaket_id_update_pk, 
				jpaket_nobukti	:jpaket_nobukti_update,  
				jpaket_cust	:jpaket_cust_update,  
				jpaket_tanggal	: jpaket_tanggal_update_date, 
				jpaket_diskon	:jpaket_diskon_update,  
				jpaket_cashback	:jpaket_cashback_update,  
				jpaket_voucher	:jpaket_voucher_update,  
				jpaket_cara	:jpaket_cara_update,  
				jpaket_bayar	:jpaket_bayar_update,  
				jpaket_keterangan	:jpaket_keterangan_update,  
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
	
		if(is_master_jual_paket_form_valid()){	
		var jpaket_id_create_pk=null; 
		var jpaket_nobukti_create=null; 
		var jpaket_cust_create=null; 
		var jpaket_tanggal_create_date=""; 
		var jpaket_diskon_create=null; 
		var jpaket_cashback_create=null; 
		var jpaket_voucher_create=null; 
		var jpaket_cara_create=null; 
		var jpaket_bayar_create=null; 
		var jpaket_keterangan_create=null; 
		var jpaket_voucher_no_create="";
		//bayar
		var jpaket_total_create=null;
		var jpaket_bayar_create=null;
		var jpaket_total_bayar_create=null;
		//kwitansi
		var jpaket_kwitansi_nama_create=null;
		var jpaket_kwitansi_nomor_create=null;
		//card
		var jpaket_card_nama_create=null;
		var jpaket_card_edc_create=null;
		//cek
		var jpaket_cek_nama_create=null;
		var jpaket_cek_nomor_create=null;
		var jpaket_cek_valid_create="";
		var jpaket_cek_bank_create=null;
		//cek
		var jpaket_transfer_bank_create=null;
		
		if(jpaket_idField.getValue()!== null){jpaket_id_create = jpaket_idField.getValue();}else{jpaket_id_create_pk=get_pk_id();} 
		if(jpaket_nobuktiField.getValue()!== null){jpaket_nobukti_create = jpaket_nobuktiField.getValue();} 
		if(jpaket_custField.getValue()!== null){jpaket_cust_create = jpaket_custField.getValue();} 
		if(jpaket_tanggalField.getValue()!== ""){jpaket_tanggal_create_date = jpaket_tanggalField.getValue().format('Y-m-d');} 
		if(jpaket_diskonField.getValue()!== null){jpaket_diskon_create = jpaket_diskonField.getValue();} 
		if(jpaket_cashbackField.getValue()!== null){jpaket_cashback_create = jpaket_cashbackField.getValue();} 
		if(jpaket_voucherField.getValue()!== null){jpaket_voucher_create = jpaket_voucherField.getValue();} 
		if(jpaket_caraField.getValue()!== null){jpaket_cara_create = jpaket_caraField.getValue();} 
		if(jpaket_bayarField.getValue()!== null){jpaket_bayar_create = jpaket_bayarField.getValue();} 
		if(jpaket_keteranganField.getValue()!== null){jpaket_keterangan_create = jpaket_keteranganField.getValue();} 
		if(jpaket_voucher_noField.getValue()!== null){jpaket_voucher_no_create = jpaket_voucher_noField.getValue();} 
		//bayar
		if(jpaket_bayarField.getValue()!== null){jpaket_bayar_create = jpaket_bayarField.getValue();}
		if(jpaket_totalField.getValue()!== null){jpaket_total_create = jpaket_totalField.getValue();} 
		if(jpaket_totalbayarField.getValue()!== null){jpaket_total_bayar_create = jpaket_totalbayarField.getValue();} 
		//kwitansi value
		if(jpaket_kwitansi_noField.getValue()!== null){jpaket_kwitansi_nomor_create = jpaket_kwitansi_noField.getValue();} 
		//card value
		if(jpaket_card_nameField.getValue()!== null){jpaket_card_nama_create = jpaket_card_nameField.getValue();} 
		if(jpaket_card_edcField.getValue()!=null){jpaket_card_edc_create = jpaket_card_edcField.getValue();} 
		//cek value
		if(jpaket_cek_nameField.getValue()!== null){jpaket_cek_nama_create = jpaket_cek_nameField.getValue();} 
		if(jpaket_cek_noField.getValue()!== null){jpaket_cek_nomor_create = jpaket_cek_noField.getValue();} 
		if(jpaket_cek_validField.getValue()!== ""){jpaket_cek_valid_create = jpaket_cek_validField.getValue().format('Y-m-d');} 
		if(jpaket_cek_bankField.getValue()!== null){jpaket_cek_bank_create = jpaket_cek_bankField.getValue();} 
		//transfer value
		if(jpaket_transfer_bankField.getValue()!== null){jpaket_transfer_bank_create = jpaket_transfer_bankField.getValue();} 
		
		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_jual_paket&m=get_action',
			params: {
				task: post2db,
				jpaket_id	: jpaket_id_create_pk, 
				jpaket_nobukti	: jpaket_nobukti_create, 
				jpaket_cust	: jpaket_cust_create, 
				jpaket_tanggal	: jpaket_tanggal_create_date, 
				jpaket_diskon	: jpaket_diskon_create, 
				jpaket_cashback	: jpaket_cashback_create, 
				jpaket_voucher	: jpaket_voucher_create, 
				jpaket_cara	: jpaket_cara_create, 
				jpaket_bayar	: jpaket_bayar_create, 
				jpaket_keterangan	: jpaket_keterangan_create,
				jpaket_voucher_no	:	jpaket_voucher_no_create,
				//bayar
				jpaket_bayar			: 	jpaket_bayar_create,
				jpaket_total			: 	jpaket_total_create,
				jpaket_total_bayar		: 	jpaket_total_bayar_create,
				//kwitansi posting
				jpaket_kwitansi_no		:	jpaket_kwitansi_nomor_create,
				//card posting
				jpaket_card_nama	: 	jpaket_card_nama_create,
				jpaket_card_edc	:	jpaket_card_edc_create,
				//cek posting
				jpaket_cek_nama	: 	jpaket_cek_nama_create,
				jpaket_cek_no		:	jpaket_cek_nomor_create,
				jpaket_cek_valid	: 	jpaket_cek_valid_create,
				jpaket_cek_bank	:	jpaket_cek_bank_create,
				//transfer posting
				jpaket_transfer_bank	:	jpaket_transfer_bank_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_jual_paket_purge()
						detail_jual_paket_insert();
						Ext.MessageBox.alert(post2db+' OK','The Master_jual_paket was '+msg+' successfully.');
						master_jual_paket_DataStore.reload();
						master_jual_paket_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_jual_paket.',
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
			return master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	// Reset kwitansi option
	function kwitansi_jual_paket_reset_form(){
		jpaket_kwitansi_nameField.reset();
		jpaket_kwitansi_noField.reset();
	}
	
	// Reset card option
	function card_jual_paket_reset_form(){
		jpaket_card_nameField.reset();
		jpaket_card_edcField.reset();
	}
	
	// Reset cek option
	function cek_jual_paket_reset_form(){
		jpaket_cek_nameField.reset();
		jpaket_cek_noField.reset();
		jpaket_cek_validField.reset();
		jpaket_cek_bankField.reset();
	}
	
	// Reset transfer option
	function transfer_jual_paket_reset_form(){
		jpaket_transfer_bankField.reset();
	}
	
	
	/* Reset form before loading */
	function master_jual_paket_reset_form(){
		jpaket_idField.reset();
		jpaket_idField.setValue(null);
		jpaket_nobuktiField.reset();
		jpaket_nobuktiField.setValue(null);
		jpaket_custField.reset();
		jpaket_custField.setValue(null);
		jpaket_tanggalField.reset();
		jpaket_tanggalField.setValue(null);
		jpaket_diskonField.reset();
		jpaket_diskonField.setValue(null);
		jpaket_cashbackField.reset();
		jpaket_cashbackField.setValue(null);
		jpaket_voucherField.reset();
		jpaket_voucherField.setValue(null);
		jpaket_caraField.reset();
		jpaket_caraField.setValue(null);
		jpaket_bayarField.reset();
		jpaket_bayarField.setValue(null);
		jpaket_keteranganField.reset();
		jpaket_keteranganField.setValue(null);
		transfer_jual_paket_reset_form();
		card_jual_paket_reset_form();
		cek_jual_paket_reset_form();
		kwitansi_jual_paket_reset_form();
		update_group_carabayar_jual_paket();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_jual_paket_set_form(){
		jpaket_idField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_id'));
		jpaket_nobuktiField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_nobukti'));
		jpaket_custField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cust'));
		jpaket_tanggalField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_tanggal'));
		jpaket_diskonField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_diskon'));
		jpaket_cashbackField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cashback'));
		jpaket_voucherField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_voucher'));
		jpaket_caraField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_cara'));
		jpaket_bayarField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_bayar'));
		jpaket_keteranganField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_keterangan'));
		
		if(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_voucher')=='Y'){
			jpaket_voucherField.setValue(true);
			jpaket_voucher_noField.setVisible(true);
			jpaket_voucher_noField.setDisabled(false);
		}else{
			jpaket_voucherField.setValue(false);
			jpaket_voucher_noField.setVisible(false);
			jpaket_voucher_noField.setDisabled(true);
		}
		jpaket_keteranganField.setValue(master_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_keterangan'));
		load_membership();
		update_group_carabayar_jual_paket();
		
		switch(jpaket_caraField.getValue()){
			case 'kwitansi':
				kwitansi_jual_paket_DataStore.load({
					params : { no_faktur: jpaket_nobuktiField.getValue() },
					callback: function(opts, success, response)  {
						  if (success) {
							if(kwitansi_jual_paket_DataStore.getCount()){
								jpaket_kwitansi_record=kwitansi_jual_paket_DataStore.getAt(0).data;
								jpaket_kwitansi_noField.setValue(jpaket_kwitansi_record.jkwitansi_no);
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
								jpaket_card_nameField.setValue(jpaket_card_record.jcard_nama);
								jpaket_card_edcField.setValue(jpaket_card_record.jcard_edc);
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
									jpaket_cek_nameField.setValue(jpaket_cek_record.jcek_nama);
									jpaket_cek_noField.setValue(jpaket_cek_record.jcek_no);
									jpaket_cek_validField.setValue(jpaket_cek_record.jcek_valid);
									jpaket_cek_bankField.setValue(jpaket_cek_record.jcek_bank);
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
									}
							}
					 	}
				  });
				break;
		}
		
		detail_jual_paket_DataStore.load({params:{master_id: jpaket_idField.getValue()}});
		
	}
	/* End setValue to EDIT*/
  
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
		return (true );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_jual_paket_createWindow.isVisible()){
			master_jual_paket_reset_form();
			post2db='CREATE';
			msg='created';
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
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_jual_paket_delete);
		} else if(master_jual_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_jual_paket_delete);
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
	function master_jual_paket_confirm_update(){
		/* only one record is selected here */
		if(master_jual_paketListEditorGrid.selModel.getCount() == 1) {
			master_jual_paket_set_form();
			post2db='UPDATE';
			detail_jual_paket_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			master_jual_paket_createWindow.show();
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
	function master_jual_paket_delete(btn){
		if(btn=='yes'){
			var selections = master_jual_paketListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_jual_paketListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jpaket_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
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
			{name: 'jpaket_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jpaket_tanggal'}, 
			{name: 'jpaket_diskon', type: 'float', mapping: 'jpaket_diskon'}, 
			{name: 'jpaket_cashback', type: 'float', mapping: 'jpaket_cashback'}, 
			{name: 'jpaket_voucher', type: 'string', mapping: 'jpaket_voucher'}, 
			{name: 'jpaket_cara', type: 'string', mapping: 'jpaket_cara'}, 
			{name: 'jpaket_bayar', type: 'float', mapping: 'jpaket_bayar'}, 
			{name: 'jpaket_keterangan', type: 'string', mapping: 'jpaket_keterangan'}, 
			{name: 'jpaket_creator', type: 'string', mapping: 'jpaket_creator'}, 
			{name: 'jpaket_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jpaket_date_create'}, 
			{name: 'jpaket_update', type: 'string', mapping: 'jpaket_update'}, 
			{name: 'jpaket_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jpaket_date_update'}, 
			{name: 'jpaket_revised', type: 'int', mapping: 'jpaket_revised'} 
		]),
		sortInfo:{field: 'jpaket_id', direction: "DESC"}
	});
	/* End of Function */
    
	/* Function for Retrieve DataStore */
	
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
			{name: 'voucher_allpaket', type: 'string', mapping: 'voucher_allpaket'}
		]),
		sortInfo:{field: 'voucher_nomor', direction: "ASC"}
	});
	
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
			{name: 'ckwitansi_cust_notelp', type: 'string', mapping: 'cust_telprumah'}
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
			{name: 'jkwitansi_no', type: 'string', mapping: 'jkwitansi_no'}
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
			{name: 'jcard_nama', type: 'string', mapping: 'jcard_nama'},
			{name: 'jcard_edc', type: 'string', mapping: 'jcard_edc'}
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
			{name: 'jtransfer_bank', type: 'string', mapping: 'jtransfer_bank'},
		]),
		sortInfo:{field: 'jtransfer_id', direction: "DESC"}
	});
	/* End of Function */
	
  	/* Function for Identify of Window Column Model */
	master_jual_paket_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jpaket_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'No. Faktur',
			dataIndex: 'jpaket_nobukti',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}, 
		{
			header: 'Customer',
			dataIndex: 'jpaket_cust',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'jpaket_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Diskon (%)',
			dataIndex: 'jpaket_diskon',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Potongan (Rp)',
			dataIndex: 'jpaket_cashback',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		},
		{
			header: 'Cara Bayar',
			dataIndex: 'jpaket_cara',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Jumlah Bayar',
			dataIndex: 'jpaket_bayar',
			width: 150,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'jpaket_keterangan',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
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
			header: 'Create on',
			dataIndex: 'jpaket_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'jpaket_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update on',
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
		title: 'List Of Jual Paket',
		autoHeight: true,
		store: master_jual_paket_DataStore, // DataStore
		cm: master_jual_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
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
			handler: master_jual_paket_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_jual_paket_DataStore,
			params: {start: 0, limit: pageS},
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
	master_jual_paketListEditorGrid.render();
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
	master_jual_paket_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_jual_paketListEditorGrid.on('afteredit', master_jual_paket_update); // inLine Editing Record
	
	// Custom rendering Template
    var customer_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	var voucher_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{voucher_nomor}</b>| {voucher_nama}<br/>Jenis: {voucher_jenis}</span>',
		'</div></tpl>'
    );
	
	
	var kwitansi_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{ckwitansi_no}</b> <br/>',
			'a/n {ckwitansi_cust_nama} [ {ckwitansi_cust_no} ]<br/>',
			'Alamat: {ckwitansi_cust_alamat}, notelp: {ckwitansi_cust_notelp} </span>',
		'</div></tpl>'
    );
	
	var paket_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dpaket_paket_kode}</b>| {dpaket_paket_display}<br/>Group: {dpaket_paket_group}<br/>',
			'Kategori: {dpaket_paket_kategori}</span>',
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
		fieldLabel: 'Nomor Faktur',
		maxLength: 30,
		anchor: '95%'
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
	/* Identify  jpaket_tanggal Field */
	jpaket_tanggalField= new Ext.form.DateField({
		id: 'jpaket_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d'
	});
	/* Identify  jpaket_diskon Field */
	jpaket_diskonField= new Ext.form.NumberField({
		id: 'jpaket_diskonField',
		fieldLabel: 'Diskon (%)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		allowDecimals: true,
		maxLength: 2,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jpaket_cashback Field */
	jpaket_cashbackField= new Ext.form.NumberField({
		id: 'jpaket_cashbackField',
		fieldLabel: 'Potongan Penjualan (Rp)',
		allowNegatife : false,
		blankText: '0',
		emptyText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jpaket_voucher Field */
	jpaket_voucherField= new Ext.form.Checkbox({
		id: 'jpaket_voucherField',
		fieldLabel: 'Voucher ?',
		maxLength: 30,
		anchor: '95%'
	});
	
	/* Identify  jpaket_nobukti Field */
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
	
	master_jual_paket_voucherGroup= new Ext.form.FieldSet({
		title: '',
		autoHeight: true,
		collapsible: false,
		border: false,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:0.2,
				layout: 'form',
				border:false,
				items: [jpaket_voucherField] 
			},
			{
				columnWidth:0.8,
				layout: 'form',
				border:false,
				items: [jpaket_voucher_noField] 
			}
		]
	
	});
	
	/* Identify  jpaket_cara Field */
	jpaket_caraField= new Ext.form.ComboBox({
		id: 'jpaket_caraField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['jpaket_cara_value', 'jpaket_cara_display'],
			data:[['tunai','tunai'],['kredit','kredit'],['card','card'],['cek/giro','cek/giro'],['kwitansi','kwitansi'],['transfer','transfer']]
		}),
		mode: 'local',
		displayField: 'jpaket_cara_display',
		valueField: 'jpaket_cara_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jpaket_bayar Field */
	jpaket_bayarField= new Ext.form.NumberField({
		id: 'jpaket_bayarField',
		fieldLabel: 'Jumlah Bayar',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jpaket_keterangan Field */
	jpaket_keteranganField= new Ext.form.TextArea({
		id: 'jpaket_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	jpaket_cust_nomemberField= new Ext.form.TextField({
		id: 'jpaket_cust_nomemberField',
		fieldLabel: 'Nomor Member',
		maxLength: 250,
		anchor: '95%'
	});
	
	
	// Field Card
	jpaket_card_nameField= new Ext.form.ComboBox({
		id: 'jpaket_card_nameField',
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
	
		
	jpaket_card_edcField= new Ext.form.TextField({
		id: 'jpaket_card_edcField',
		fieldLabel: 'EDC',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	master_jual_paket_cardGroup= new Ext.form.FieldSet({
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
				items: [jpaket_card_nameField,jpaket_card_edcField] 
			}
		]
	
	});
	
	//Field Ceck
	jpaket_cek_nameField= new Ext.form.TextField({
		id: 'jpaket_cek_nameField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	jpaket_cek_noField= new Ext.form.TextField({
		id: 'jpaket_cek_noField',
		fieldLabel: 'Nomor Cek',
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
	
	jpaket_cek_bankField= new Ext.form.TextField({
		id: 'jpaket_cek_bankField',
		fieldLabel: 'Bank',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	
	master_jual_paket_cekGroup = new Ext.form.FieldSet({
		title: 'Check/Giro',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jpaket_cek_nameField,jpaket_cek_noField,jpaket_cek_validField,jpaket_cek_bankField] 
			}
		]
	
	});
	
	//Field Transfer
	jpaket_transfer_bankField= new Ext.form.TextField({
		id: 'jpaket_transfer_bankField',
		fieldLabel: 'Bank',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	master_jual_paket_transferGroup=master_jual_paket_masterGroup = new Ext.form.FieldSet({
		title: 'Transfer',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jpaket_transfer_bankField] 
			}
		]
	
	});
	
	//Field Transfer
	jpaket_kwitansi_nameField= new Ext.form.TextField({
		id: 'jpaket_kwitansi_nameField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
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
	
	jpaket_kwitansi_noField.on("select",function(){
			j=cbo_kwitansi_jual_paket_DataStore.find('ckwitansi_id',jpaket_kwitansi_noField.getValue());
			if(j>-1){
				jpaket_kwitansi_nameField.setValue(cbo_kwitansi_jual_paket_DataStore.getAt(j).data.ckwitansi_cust_nama);
			}
		});
	
	master_jual_paket_kwitansiGroup = new Ext.form.FieldSet({
		title: 'Kwitansi',
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jpaket_kwitansi_noField,jpaket_kwitansi_nameField] 
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
		anchor: '95%',
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jpaket_totalField= new Ext.form.NumberField({
		id: 'jpaket_totalField',
		fieldLabel: 'Total Nilai',
		readOnly: true,
		allowDecimals: false,
		allowBlank: true,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jpaket_bayarField= new Ext.form.NumberField({
		id: 'jpaket_bayarField',
		fieldLabel: 'Uang Muka/ Tunai (Rp)',
		enableKeyEvents: true,
		allowBlank: true,
		allowDecimals: false,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	jpaket_totalbayarField= new Ext.form.NumberField({
		id: 'jpaket_totalbayarField',
		fieldLabel: 'Total Hutang (Rp)',
		readOnly: true,
		allowBlank: true,
		allowDecimals: false,
		width: 100,
		maxLength: 50,
		maskRe: /([0-9]+)$/
	});
	
	
	master_jual_paket_bayarGroup = new Ext.form.FieldSet({
		title: '-',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			   {
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jpaket_caraField,master_jual_paket_cardGroup,master_jual_paket_cekGroup,master_jual_paket_kwitansiGroup,master_jual_paket_transferGroup] 
			},
			{
				columnWidth:0.15,
				layout: 'form',
				border:false,
				items: [jpaket_jumlahField] 
			}
			,{
				columnWidth:0.35,
				layout: 'form',
    			labelPad: 0,
				baseCls: 'x-plain',
				border:false,
				labelAlign: 'left',
				items: [jpaket_totalField, jpaket_diskonField, jpaket_cashbackField, jpaket_bayarField,jpaket_totalbayarField] 
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
				columnWidth:0.33,
				layout: 'form',
				border:false,
				items: [jpaket_nobuktiField, jpaket_custField, jpaket_cust_nomemberField] 
			},
			{
				columnWidth:0.33,
				layout: 'form',
				border:false,
				items: [jpaket_keteranganField, jpaket_tanggalField] 
			},
			{
				columnWidth:0.33,
				layout: 'form',
				border:false,
				items: [master_jual_paket_voucherGroup,jpaket_idField] 
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
			{name: 'dpaket_kadaluarsa', type: 'date', dateFormat: 'Y-m-d', mapping: 'dpaket_kadaluarsa'}, 
			{name: 'dpaket_jumlah', type: 'int', mapping: 'dpaket_jumlah'}, 
			{name: 'dpaket_harga', type: 'float', mapping: 'dpaket_harga'}, 
			{name: 'dpaket_diskon', type: 'int', mapping: 'dpaket_diskon'}, 
			{name: 'dpaket_diskon_jenis', type: 'string', mapping: 'dpaket_diskon_jenis'}, 
			{name: 'dpaket_sales', type: 'string', mapping: 'dpaket_sales'} 
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
		}),baseParams: {start: 0, limit: pageS},
		reader: detail_jual_paket_reader,
		baseParams:{master_id: jpaket_idField.getValue()},
		sortInfo:{field: 'dpaket_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_jual_paket= new Ext.ux.grid.RowEditor({
        saveText: 'Update',
		listeners: {
			afteredit: function(){
				detail_jual_paket_DataStore.commitChanges();
			}
		}
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
			{name: 'dpaket_paket_kadaluarsa', type: 'int', mapping: 'paket_kadaluarsa'},
			{name: 'dpaket_paket_kode', type: 'string', mapping: 'paket_kode'},
			{name: 'dpaket_paket_group', type: 'string', mapping: 'group_nama'},
			{name: 'dpaket_paket_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'dpaket_paket_du', type: 'float', mapping: 'paket_du'},
			{name: 'dpaket_paket_dm', type: 'float', mapping: 'paket_dm'},
			{name: 'dpaket_paket_display', type: 'string', mapping: 'paket_nama'}
		]),
		sortInfo:{field: 'dpaket_paket_display', direction: "ASC"}
	});
	
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
	
	
		
	Ext.util.Format.comboRenderer = function(combo){
		cbo_dpaket_paketDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_jual_paket=new Ext.form.ComboBox({
			store: cbo_dpaket_paketDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dpaket_paket_display',
			valueField: 'dpaket_paket_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:10,
			hideTrigger:false,
			tpl: paket_jual_paket_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
		

	//declaration of detail coloumn model
	detail_jual_paket_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Paket',
			dataIndex: 'dpaket_paket',
			width: 250,
			sortable: true,
			editor: combo_jual_paket,
			renderer: Ext.util.Format.comboRenderer(combo_jual_paket)
		},
		{
			header: 'Jumlah',
			dataIndex: 'dpaket_jumlah',
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
			header: 'Kadaluarsa',
			dataIndex: 'dpaket_kadaluarsa',
			width: 80,
			sortable: true,
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		},
		{
			header: 'Harga (Rp)',
			dataIndex: 'dpaket_harga',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},{
			header: 'Sub Total (Rp)',
			dataIndex: 'dpaket_diskon',
			width: 150,
			sortable: true,
			reaOnly: true,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.dpaket_harga* record.data.dpaket_jumlah,'0,000');
            }
		},
		{
			header: 'Diskon (%)',
			dataIndex: 'dpaket_diskon',
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
			dataIndex: 'dpaket_diskon_jenis',
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
			dataIndex: 'dpaket_diskon',
			width: 150,
			sortable: true,
			reaOnly: true,
			renderer: function(v, params, record){
					return Ext.util.Format.number(record.data.dpaket_harga* record.data.dpaket_jumlah*(100-record.data.dpaket_diskon)/100,'0,000');
            }
		},
		{
			header: 'Sales',
			dataIndex: 'dpaket_sales',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		}]
	);
	detail_jual_paket_ColumnModel.defaultSortable= true;
	//eof
	
	function get_harga_paket(id_paket){
		var harga_paket=0;
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
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
		title: 'Detail detail_jual_paket',
		height: 250,
		width: 890,
		autoScroll: true,
		store: detail_jual_paket_DataStore, // DataStore
		colModel: detail_jual_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_jual_paket],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
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
			handler: detail_jual_paket_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function detail_jual_paket_add(){
		var edit_detail_jual_paket= new detail_jual_paketListEditorGrid.store.recordType({
			dpaket_id	:'',		
			dpaket_master	:null,		
			dpaket_paket	:null,
			dpaket_kadaluarsa	:null,
			dpaket_jumlah	:null,		
			dpaket_harga	:null,		
			dpaket_diskon	:null,		
			dpaket_diskon_jenis	:null,		
			dpaket_sales	:''		
		});
		editor_detail_jual_paket.stopEditing();
		detail_jual_paket_DataStore.insert(0, edit_detail_jual_paket);
		detail_jual_paketListEditorGrid.getView().refresh();
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
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){
			detail_jual_paket_record=detail_jual_paket_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_jual_paket&m=detail_detail_jual_paket_insert',
				params:{
				dpaket_id	: detail_jual_paket_record.data.dpaket_id, 
				dpaket_master	: eval(jpaket_idField.getValue()), 
				dpaket_paket	: detail_jual_paket_record.data.dpaket_paket, 
				dpaket_kadaluarsa	: detail_jual_paket_record.data.dpaket_kadaluarsa, 
				dpaket_jumlah	: detail_jual_paket_record.data.dpaket_jumlah, 
				dpaket_harga	: detail_jual_paket_record.data.dpaket_harga, 
				dpaket_diskon	: detail_jual_paket_record.data.dpaket_diskon, 
				dpaket_diskon_jenis	: detail_jual_paket_record.data.dpaket_diskon_jenis, 
				dpaket_sales	: detail_jual_paket_record.data.dpaket_sales 
				
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
	function detail_jual_paket_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_jual_paket&m=detail_detail_jual_paket_purge',
			params:{ master_id: eval(jpaket_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_jual_paket_confirm_delete(){
		// only one record is selected here
		if(detail_jual_paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_jual_paket_delete);
		} else if(detail_jual_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_jual_paket_delete);
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
	function detail_jual_paket_delete(btn){
		if(btn=='yes'){
			var s = detail_jual_paketListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_jual_paket_DataStore.remove(r);
			}
		} 
		detail_jual_paket_DataStore.commitChanges();
	}
	//eof
	function update_group_carabayar_jual_paket(){
		var value=jpaket_caraField.getValue();
		master_jual_paket_cardGroup.setVisible(false);
		master_jual_paket_cekGroup.setVisible(false);
		master_jual_paket_transferGroup.setVisible(false);
		master_jual_paket_kwitansiGroup.setVisible(false);
		if(value=='card'){
			master_jual_paket_cardGroup.setVisible(true);
		}else if(value=='cek/giro'){
			master_jual_paket_cekGroup.setVisible(true);
		}else if(value=='transfer'){
			master_jual_paket_transferGroup.setVisible(true);
		}else if(value=='kwitansi'){
			master_jual_paket_kwitansiGroup.setVisible(true);
		}
	}
	
	function activate_voucher_jual_paket(){
		jpaket_voucher_noField.setVisible(jpaket_voucherField.getValue());
		if(jpaket_voucher_noField.isVisible())
			jpaket_voucher_noField.focus();
	}
	
	
	function load_detail_jual_paket(){
		var detail_jual_paket_record;
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){
			detail_jual_paket_record=detail_jual_paket_DataStore.getAt(i);
			var j=cbo_dpaket_paketDataStore.find('dpaket_paket_value',detail_jual_paket_record.data.dpaket_paket);
			if(j>0){
				detail_jual_paket_record.data.dpaket_harga=cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_harga;
				detail_jual_paket_record.data.dpaket_kadaluarsa=dt.format('Y-m-d')+cbo_dpaket_paketDataStore.getAt(j).data.dpaket_paket_kadaluarsa;
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
	
	function load_total_paket_bayar(){
		var jumlah_item=0;
		var total_harga=0;
		var total_hutang=0;
		var detail_jual_paket_record;
		for(i=0;i<detail_jual_paket_DataStore.getCount();i++){
			detail_jual_paket_record=detail_jual_paket_DataStore.getAt(i);
			jumlah_item=jumlah_item+eval(detail_jual_paket_record.data.dpaket_jumlah);
			total_harga=total_harga+eval(detail_jual_paket_record.data.dpaket_jumlah*detail_jual_paket_record.data.dpaket_harga*(100-detail_jual_paket_record.data.dpaket_diskon)/100);
		}
		jpaket_jumlahField.setValue(jumlah_item);
		total_harga=total_harga*(100-jpaket_diskonField.getValue())/100 - jpaket_cashbackField.getValue();
		total_harga=(total_harga>0?Math.round(total_harga):0);
		jpaket_totalField.setValue(total_harga);
		total_hutang=total_harga-jpaket_bayarField.getValue();
		total_hutang=(total_hutang>0?Math.round(total_hutang):0);
		jpaket_totalbayarField.setValue(total_hutang);
	}
	
	function load_all_jual_paket(){
		load_detail_jual_paket();
		load_total_paket_bayar();
	}
	//event on update of detail data store
	detail_jual_paket_DataStore.on("update",load_all_jual_paket);
	detail_jual_paket_DataStore.on("load",load_total_paket_bayar);
	jpaket_bayarField.on("keyup",load_total_paket_bayar);
	jpaket_diskonField.on("keyup",load_total_paket_bayar);
	jpaket_cashbackField.on("keyup",load_total_paket_bayar);
	jpaket_caraField.on("select",update_group_carabayar_jual_paket);
	jpaket_voucherField.on("check",activate_voucher_jual_paket);
	jpaket_custField.on("select",
		function(){
			load_membership();
			j=memberDataStore.find('member_cust',jpaket_custField.getValue());
			console.log(jpaket_custField.getValue());
			if(j>-1)
				jpaket_cust_nomemberField.setValue(memberDataStore.getAt(j).member_no);
			else
				jpaket_cust_nomemberField.setValue("");
		});
	//event on update of detail data store
	
	/* Function for retrieve create Window Panel*/ 
	master_jual_paket_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 900,
		layout: 'fit',
		items: [master_jual_paket_masterGroup,detail_jual_paketListEditorGrid, master_jual_paket_bayarGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_jual_paket_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_jual_paket_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_jual_paket_createWindow= new Ext.Window({
		id: 'master_jual_paket_createWindow',
		title: post2db+'Master_jual_paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_jual_paket_create',
		items: master_jual_paket_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function master_jual_paket_list_search(){
		// render according to a SQL date format.
		var jpaket_id_search=null;
		var jpaket_nobukti_search=null;
		var jpaket_cust_search=null;
		var jpaket_tanggal_search_date="";
		var jpaket_diskon_search=null;
		var jpaket_cashback_search=null;
		var jpaket_voucher_search=null;
		var jpaket_cara_search=null;
		var jpaket_bayar_search=null;
		var jpaket_keterangan_search=null;

		if(jpaket_idSearchField.getValue()!==null){jpaket_id_search=jpaket_idSearchField.getValue();}
		if(jpaket_nobuktiSearchField.getValue()!==null){jpaket_nobukti_search=jpaket_nobuktiSearchField.getValue();}
		if(jpaket_custSearchField.getValue()!==null){jpaket_cust_search=jpaket_custSearchField.getValue();}
		if(jpaket_tanggalSearchField.getValue()!==""){jpaket_tanggal_search_date=jpaket_tanggalSearchField.getValue().format('Y-m-d');}
		if(jpaket_diskonSearchField.getValue()!==null){jpaket_diskon_search=jpaket_diskonSearchField.getValue();}
		if(jpaket_cashbackSearchField.getValue()!==null){jpaket_cashback_search=jpaket_cashbackSearchField.getValue();}
		if(jpaket_voucherSearchField.getValue()!==null){jpaket_voucher_search=jpaket_voucherSearchField.getValue();}
		if(jpaket_caraSearchField.getValue()!==null){jpaket_cara_search=jpaket_caraSearchField.getValue();}
		if(jpaket_bayarSearchField.getValue()!==null){jpaket_bayar_search=jpaket_bayarSearchField.getValue();}
		if(jpaket_keteranganSearchField.getValue()!==null){jpaket_keterangan_search=jpaket_keteranganSearchField.getValue();}
		// change the store parameters
		master_jual_paket_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jpaket_id	:	jpaket_id_search, 
			jpaket_nobukti	:	jpaket_nobukti_search, 
			jpaket_cust	:	jpaket_cust_search, 
			jpaket_tanggal	:	jpaket_tanggal_search_date, 
			jpaket_diskon	:	jpaket_diskon_search, 
			jpaket_cashback	:	jpaket_cashback_search, 
			jpaket_voucher	:	jpaket_voucher_search, 
			jpaket_cara	:	jpaket_cara_search, 
			jpaket_bayar	:	jpaket_bayar_search, 
			jpaket_keterangan	:	jpaket_keterangan_search, 
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
		fieldLabel: 'Jpaket Nobukti',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  jpaket_cust Search Field */
	jpaket_custSearchField= new Ext.form.NumberField({
		id: 'jpaket_custSearchField',
		fieldLabel: 'Jpaket Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jpaket_tanggal Search Field */
	jpaket_tanggalSearchField= new Ext.form.DateField({
		id: 'jpaket_tanggalSearchField',
		fieldLabel: 'Jpaket Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jpaket_diskon Search Field */
	jpaket_diskonSearchField= new Ext.form.NumberField({
		id: 'jpaket_diskonSearchField',
		fieldLabel: 'Jpaket Diskon',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jpaket_cashback Search Field */
	jpaket_cashbackSearchField= new Ext.form.NumberField({
		id: 'jpaket_cashbackSearchField',
		fieldLabel: 'Jpaket Cashback',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jpaket_voucher Search Field */
	jpaket_voucherSearchField= new Ext.form.ComboBox({
		id: 'jpaket_voucherSearchField',
		fieldLabel: 'Jpaket Voucher',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jpaket_voucher'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jpaket_voucher',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jpaket_cara Search Field */
	jpaket_caraSearchField= new Ext.form.ComboBox({
		id: 'jpaket_caraSearchField',
		fieldLabel: 'Jpaket Cara',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jpaket_cara'],
			data:[['tunai','tunai'],['kredit','kredit'],['card','card'],['cek/giro','cek/giro'],['kwitansi','kwitansi'],['transfer','transfer']]
		}),
		mode: 'local',
		displayField: 'jpaket_cara',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jpaket_bayar Search Field */
	jpaket_bayarSearchField= new Ext.form.NumberField({
		id: 'jpaket_bayarSearchField',
		fieldLabel: 'Jpaket Bayar',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jpaket_keterangan Search Field */
	jpaket_keteranganSearchField= new Ext.form.TextField({
		id: 'jpaket_keteranganSearchField',
		fieldLabel: 'Jpaket Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_jual_paket_searchForm = new Ext.FormPanel({
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
				items: [jpaket_nobuktiSearchField, jpaket_custSearchField, jpaket_tanggalSearchField, jpaket_diskonSearchField, jpaket_cashbackSearchField, jpaket_voucherSearchField, jpaket_caraSearchField, jpaket_bayarSearchField, jpaket_keteranganSearchField] 
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
		title: 'master_jual_paket Search',
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
		var jpaket_cashback_print=null;
		var jpaket_voucher_print=null;
		var jpaket_cara_print=null;
		var jpaket_bayar_print=null;
		var jpaket_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_paket_DataStore.baseParams.query!==null){searchquery = master_jual_paket_DataStore.baseParams.query;}
		if(master_jual_paket_DataStore.baseParams.jpaket_nobukti!==null){jpaket_nobukti_print = master_jual_paket_DataStore.baseParams.jpaket_nobukti;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cust!==null){jpaket_cust_print = master_jual_paket_DataStore.baseParams.jpaket_cust;}
		if(master_jual_paket_DataStore.baseParams.jpaket_tanggal!==""){jpaket_tanggal_print_date = master_jual_paket_DataStore.baseParams.jpaket_tanggal;}
		if(master_jual_paket_DataStore.baseParams.jpaket_diskon!==null){jpaket_diskon_print = master_jual_paket_DataStore.baseParams.jpaket_diskon;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cashback!==null){jpaket_cashback_print = master_jual_paket_DataStore.baseParams.jpaket_cashback;}
		if(master_jual_paket_DataStore.baseParams.jpaket_voucher!==null){jpaket_voucher_print = master_jual_paket_DataStore.baseParams.jpaket_voucher;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cara!==null){jpaket_cara_print = master_jual_paket_DataStore.baseParams.jpaket_cara;}
		if(master_jual_paket_DataStore.baseParams.jpaket_bayar!==null){jpaket_bayar_print = master_jual_paket_DataStore.baseParams.jpaket_bayar;}
		if(master_jual_paket_DataStore.baseParams.jpaket_keterangan!==null){jpaket_keterangan_print = master_jual_paket_DataStore.baseParams.jpaket_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_jual_paket&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jpaket_nobukti : jpaket_nobukti_print,
			jpaket_cust : jpaket_cust_print,
		  	jpaket_tanggal : jpaket_tanggal_print_date, 
			jpaket_diskon : jpaket_diskon_print,
			jpaket_cashback : jpaket_cashback_print,
			jpaket_voucher : jpaket_voucher_print,
			jpaket_cara : jpaket_cara_print,
			jpaket_bayar : jpaket_bayar_print,
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
		var jpaket_cashback_2excel=null;
		var jpaket_voucher_2excel=null;
		var jpaket_cara_2excel=null;
		var jpaket_bayar_2excel=null;
		var jpaket_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_jual_paket_DataStore.baseParams.query!==null){searchquery = master_jual_paket_DataStore.baseParams.query;}
		if(master_jual_paket_DataStore.baseParams.jpaket_nobukti!==null){jpaket_nobukti_2excel = master_jual_paket_DataStore.baseParams.jpaket_nobukti;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cust!==null){jpaket_cust_2excel = master_jual_paket_DataStore.baseParams.jpaket_cust;}
		if(master_jual_paket_DataStore.baseParams.jpaket_tanggal!==""){jpaket_tanggal_2excel_date = master_jual_paket_DataStore.baseParams.jpaket_tanggal;}
		if(master_jual_paket_DataStore.baseParams.jpaket_diskon!==null){jpaket_diskon_2excel = master_jual_paket_DataStore.baseParams.jpaket_diskon;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cashback!==null){jpaket_cashback_2excel = master_jual_paket_DataStore.baseParams.jpaket_cashback;}
		if(master_jual_paket_DataStore.baseParams.jpaket_voucher!==null){jpaket_voucher_2excel = master_jual_paket_DataStore.baseParams.jpaket_voucher;}
		if(master_jual_paket_DataStore.baseParams.jpaket_cara!==null){jpaket_cara_2excel = master_jual_paket_DataStore.baseParams.jpaket_cara;}
		if(master_jual_paket_DataStore.baseParams.jpaket_bayar!==null){jpaket_bayar_2excel = master_jual_paket_DataStore.baseParams.jpaket_bayar;}
		if(master_jual_paket_DataStore.baseParams.jpaket_keterangan!==null){jpaket_keterangan_2excel = master_jual_paket_DataStore.baseParams.jpaket_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_jual_paket&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jpaket_nobukti : jpaket_nobukti_2excel,
			jpaket_cust : jpaket_cust_2excel,
		  	jpaket_tanggal : jpaket_tanggal_2excel_date, 
			jpaket_diskon : jpaket_diskon_2excel,
			jpaket_cashback : jpaket_cashback_2excel,
			jpaket_voucher : jpaket_voucher_2excel,
			jpaket_cara : jpaket_cara_2excel,
			jpaket_bayar : jpaket_bayar_2excel,
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
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_jual_paket"></div>
         <div id="fp_detail_jual_paket"></div>
		<div id="elwindow_master_jual_paket_create"></div>
        <div id="elwindow_master_jual_paket_search"></div>
    </div>
</div>
</body>