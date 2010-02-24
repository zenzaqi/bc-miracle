<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: appointment View
	+ Description	: For record view
	+ Filename 		: v_appointment.php
 	+ Author  		: masongbee
 	+ Created on 29/Oct/2009 13:33:53
	
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
			padding:1px 1px 1px 1px;
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
			margin:0 0 1px 1px;
			width:100px;
			display:block;
			clear:none;
		}
		.blue-row .x-grid3-cell-inner{
	      color:blue;
	    }
    </style>
<script>


Ext.namespace('Ext.ux.plugin');

Ext.ux.plugin.triggerfieldTooltip = function(config){
    Ext.apply(this, config);
};

Ext.extend(Ext.ux.plugin.triggerfieldTooltip, Ext.util.Observable,{
    init: function(component){
        this.component = component;
        this.component.on('render', this.onRender, this);
    },
    
    //private
    onRender: function(){
        if(this.component.tooltip){
            if(typeof this.component.tooltip == 'object'){
                Ext.QuickTips.register(Ext.apply({
                      target: this.component.trigger
                }, this.component.tooltip));
            } else {
                this.component.trigger.dom[this.component.tooltipType] = this.component.tooltip;
            }
        }
    }
}); 

Ext.apply(Ext.form.VTypes, {
    daterange : function(val, field) {
        var date = field.parseDate(val);

        if(!date){
            return;
        }
        if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
            var start = Ext.getCmp(field.startDateField);
            start.setMaxValue(date);
            start.validate();
            this.dateRangeMax = date;
        } 
        else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
            var end = Ext.getCmp(field.endDateField);
            end.setMinValue(date);
            end.validate();
            this.dateRangeMin = date;
        }
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
    }
});


/* declare function */		
var appointment_DataStore;
var appointment_ColumnModel;
var appointmentListEditorGrid;
var appointment_createForm;
var appointment_createWindow;
var appointment_searchForm;
var appointment_searchWindow;
var appointment_SelectedRow;
var appointment_ContextMenu;
//for detail data
var appointment_detail_medisDataStore;
var appointment_detail_medisListEditorGrid;
var appointment_detail_medis_ColumnModel;
var appointment_detail_proxy;
var appointment_detail_medis_writer;
var appointment_detail_medis_reader;
var editor_appointment_detail_medis;

var appointment_detail_nonmedisDataStore;
var appointment_detail_nonmedisListEditorGrid;
var appointment_detail_nonmedis_ColumnModel;
var appointment_detail_nonmedis_writer;
var appointment_detail_nonmedis_reader;
var editor_appointment_detail_nonmedis;

//declare konstant
var post2db = '';
var msg = '';
var pageS=100;
var dmedis_record='';
var dnonmedis_record='';

/* declare variable here for Field*/
var app_idField;
var app_customerField;
var app_tanggalField;
var app_caraField;
var app_keteranganField;
var app_idSearchField;
var app_customerSearchField;
var app_caraSearchField;
var app_keteranganSearchField;
var app_kategoriSearchField;
var app_dokterSearchField;
var app_terapisSearchField;
var app_tgl_startReservasiSearchField;
var app_tgl_endReservasiSearchField
var app_tgl_startAppSearchField;
var app_tgl_endAppSearchField;

var app_cust_namaBaruField;
var app_cust_telpBaruField;
var app_cust_hpBaruField;
var app_cust_keteranganBaruField;

var dt = new Date();

Ext.util.Format.comboRenderer = function(combo){
	return function(value){
		var record = combo.findRecord(combo.valueField, value);
		return record ? record.get(combo.displayField) : combo.valueNotFoundText;
	}
}

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function appointment_update(oGrid_event){
		var app_id_update_pk="";
		var app_customer_update=null;
		var dapp_tglreservasi_update_date="";
		var app_cara_update=null;
		var app_keterangan_update=null;
		var dapp_id_update="";
		var dapp_status_update="";
		var dapp_dokter_update="";
		var dapp_terapis_update="";
		var dapp_kategori_nama_update="";
		var dapp_rawat_id_update="";
		var dapp_dokter_id_update="";
		var dapp_terapis_id_update="";
		var dapp_jamreservasi_update="";
		var app_cust_id_update="";
		var dapp_dokter_no_update="";
		var dapp_terapis_no_update="";
		var dapp_dokter_ganti_update="";
		var dapp_terapis_ganti_update="";
		var dapp_keterangan_update="";
		var dapp_locked_update=0;
		var dapp_counter_update=true;

		app_id_update_pk = oGrid_event.record.data.app_id;
		if(oGrid_event.record.data.app_customer!== null){app_customer_update = oGrid_event.record.data.app_customer;}
	 	if(oGrid_event.record.data.dapp_tglreservasi!== ""){dapp_tglreservasi_update_date =oGrid_event.record.data.dapp_tglreservasi.format('Y-m-d');}
		if(oGrid_event.record.data.app_cara!== null){app_cara_update = oGrid_event.record.data.app_cara;}
		if(oGrid_event.record.data.app_keterangan!== null){app_keterangan_update = oGrid_event.record.data.app_keterangan;}
		if(oGrid_event.record.data.dapp_id!== ""){dapp_id_update = oGrid_event.record.data.dapp_id;}
		if(oGrid_event.record.data.dapp_status!== ""){dapp_status_update = oGrid_event.record.data.dapp_status;}
		if(oGrid_event.record.data.dokter_nama!== ""){dapp_dokter_update = oGrid_event.record.data.dokter_nama;}
		if(oGrid_event.record.data.terapis_nama!== ""){dapp_terapis_update = oGrid_event.record.data.terapis_nama;}
		if(oGrid_event.record.data.kategori_nama!== ""){dapp_kategori_nama_update = oGrid_event.record.data.kategori_nama;}
		dapp_rawat_id_update = oGrid_event.record.data.rawat_id;
		dapp_dokter_id_update = oGrid_event.record.data.dokter_id;
		dapp_terapis_id_update = oGrid_event.record.data.terapis_id;
		dapp_jamreservasi_update = oGrid_event.record.data.dapp_jamreservasi;
		app_cust_id_update = oGrid_event.record.data.cust_id;
		if(oGrid_event.record.data.dokter_no!== ""){dapp_dokter_no_update = oGrid_event.record.data.dokter_no;}
		if(oGrid_event.record.data.terapis_no!== ""){dapp_terapis_no_update = oGrid_event.record.data.terapis_no;}
		dapp_dokter_ganti_update = oGrid_event.record.data.dokter_username;
		dapp_terapis_ganti_update = oGrid_event.record.data.terapis_username;
		if(oGrid_event.record.data.dapp_keterangan!== ""){dapp_keterangan_update = oGrid_event.record.data.dapp_keterangan;}
		dapp_locked_update = oGrid_event.record.data.dapp_locked;
		dapp_counter_update = oGrid_event.record.data.dapp_counter;

		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_appointment&m=get_action',
			params: {
				task: "UPDATE",
				app_id	: app_id_update_pk, 
				app_customer	:app_customer_update,  
				dapp_tglreservasi	: dapp_tglreservasi_update_date, 
				app_cara	:app_cara_update,  
				app_keterangan	:app_keterangan_update,
				dapp_id	:dapp_id_update,  
				dapp_status	:dapp_status_update,
				dokter_nama	:dapp_dokter_update,
				terapis_nama	:dapp_terapis_update,
				kategori_nama :dapp_kategori_nama_update,
				rawat_id	:dapp_rawat_id_update,
				dokter_id	:dapp_dokter_id_update,
				terapis_id	:dapp_terapis_id_update,
				dapp_jamreservasi	:dapp_jamreservasi_update,
				cust_id	:app_cust_id_update,
				dapp_dokter_no	:dapp_dokter_no_update,
				dapp_terapis_no	:dapp_terapis_no_update,
				dapp_dokter_ganti	:dapp_dokter_ganti_update,
				dapp_terapis_ganti	:dapp_terapis_ganti_update,
				dapp_keterangan	: dapp_keterangan_update,
				dapp_locked	: dapp_locked_update,
				dapp_counter : dapp_counter_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						appointment_DataStore.commitChanges();
						appointment_DataStore.reload();
						dapp_dokterDataStore.load();
						break;
					case 2:
						Ext.MessageBox.show({
						   title: 'Warning',
						   width: 250,
						   msg: 'Status tidak bisa diubah karena tindakan sudah selesai',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						appointment_DataStore.reload();
						break;
					case 3:
						Ext.MessageBox.show({
						   title: 'Warning',
						   width: 250,
						   msg: 'Tanggal appointment tidak sama dengan hari ini',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						appointment_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
//						   msg: 'We could\'t not save the appointment.',
						   msg: 'Data appointment tidak bisa disimpan',
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
	function appointment_create(){
		app_id_create_pk=get_pk_id();
		var appointment_detail_medis_record;
		var appointment_detail_nonmedis_record;
		for(i=0;i<appointment_detail_medisDataStore.getCount();i++){
			appointment_detail_medis_record=appointment_detail_medisDataStore.getAt(i);
			if(appointment_detail_medis_record.data.dapp_medis_perawatan!="" && appointment_detail_medis_record.data.dapp_medis_jamreservasi!=""){
				dmedis_record='ada';
			}
		}
		for(i=0;i<appointment_detail_nonmedisDataStore.getCount();i++){
			appointment_detail_nonmedis_record=appointment_detail_nonmedisDataStore.getAt(i);
			if(appointment_detail_nonmedis_record.data.dapp_nonmedis_perawatan!="" && appointment_detail_nonmedis_record.data.dapp_nonmedis_jamreservasi!=""){
				dnonmedis_record='ada';
			}
		}
		if(is_appointment_form_valid() && ((app_customerField.getValue()!==null && /^\d+$/.test(app_customerField.getValue()) || app_id_create_pk!=="") || app_cust_namaBaruField.getValue()!==null) && (dmedis_record=='ada' || dnonmedis_record=='ada')){
		var app_id_create_pk=null; 
		var app_customer_create=""; 
		var app_tanggal_create_date=""; 
		var app_cara_create=null; 
		var app_keterangan_create=null; 

		var app_cust_namaBaru_create;
		var app_cust_telpBaru_create;
		var app_cust_hpBaru_create;
		var app_cust_keteranganBaru_create;

		if(app_idField.getValue()!== null){app_id_create = app_idField.getValue();}else{app_id_create_pk=get_pk_id();} 
		if(app_customerField.getValue()!== null){app_customer_create = app_customerField.getValue();} 
		if(app_tanggalField.getValue()!== ""){app_tanggal_create_date = app_tanggalField.getValue().format('Y-m-d');} 
		if(app_caraField.getValue()!== null){app_cara_create = app_caraField.getValue();} 
		if(app_keteranganField.getValue()!== null){app_keterangan_create = app_keteranganField.getValue();}
		if(app_cust_namaBaruField.getValue()!== null){app_cust_namaBaru_create = app_cust_namaBaruField.getValue();}  
		if(app_cust_telpBaruField.getValue()!== null){app_cust_telpBaru_create = app_cust_telpBaruField.getValue();}
		if(app_cust_hpBaruField.getValue()!== null){app_cust_hpBaru_create = app_cust_hpBaruField.getValue();}
		if(app_cust_keteranganBaruField.getValue()!== null){app_cust_keteranganBaru_create = app_cust_keteranganBaruField.getValue();}
			 

		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_appointment&m=get_action',
			params: {
				task: post2db,
				app_id	: app_id_create_pk, 
				app_customer	: app_customer_create, 
				app_tanggal	: app_tanggal_create_date, 
				app_cara	: app_cara_create, 
				app_keterangan	: app_keterangan_create, 
				app_cust_nama_baru	: app_cust_namaBaru_create,
				app_cust_telp_baru	: app_cust_telpBaru_create,
				app_cust_hp_baru	: app_cust_hpBaru_create,
				app_cust_keterangan_baru	: app_cust_keteranganBaru_create
				
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						//appointment_detail_purge();
						appointment_detail_medis_insert();
						appointment_detail_nonmedis_insert();
//						appointment_detail_medis_purge();
//						appointment_detail_nonmedis_purge();
						//Ext.MessageBox.alert(post2db+' OK','The Appointment was '+msg+' successfully.');
						Ext.MessageBox.alert(post2db+' OK','Data appointment berhasil disimpan');
						//appointment_DataStore.reload();
						appointment_createWindow.hide();
						break;
					case 2:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Customer sudah terdaftar.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
					case 3:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'No telp atau no ponsel customer baru tidak boleh kosong.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data appointment tidak bisa disimpan',
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
			if(!/^\d+$/.test(app_customerField.getValue())){
				Ext.MessageBox.show({
					title: 'Warning',
//					msg: 'Customer harus di-Pilih <br>bukan isian!.',
					msg: 'Customer harus dipilih, <br>bukan isian',
					buttons: Ext.MessageBox.OK,
					minWidth: 250,
					animEl: 'save',
					icon: Ext.MessageBox.WARNING
				});
			}else {
				Ext.MessageBox.show({
					title: 'Warning',
//					msg: 'Ada DATA yang BELUM di-ISI!.',
					msg: 'Ada data yang belum diinputkan',
					buttons: Ext.MessageBox.OK,
					minWidth: 250,
					animEl: 'save',
					icon: Ext.MessageBox.WARNING
				});
			}
		}
	}
 	/* End of Function */
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='UPDATE'){
			return appointmentListEditorGrid.getSelectionModel().getSelected().get('app_id');
		}else {
			return 0;
		}
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function appointment_reset_form(){
		app_idField.reset();
		app_idField.setValue(null);
		app_customerField.reset();
		app_customerField.setValue(null);
		app_tanggalField.reset();
		app_tanggalField.setValue(null);
		app_caraField.reset();
		app_caraField.setValue(null);
		app_keteranganField.reset();
		app_keteranganField.setValue(null);
	}
 	/* End of Function */
 	
 	function appointment_custBaruGroup_reset(){
 		appointment_custBaruGroup.collapse(true);
 		app_cust_namaBaruField.reset();
 		app_cust_namaBaruField.setValue(null);
 		app_cust_telpBaruField.reset();
 		app_cust_telpBaruField.setValue(null);
 		app_cust_hpBaruField.reset();
 		app_cust_hpBaruField.setValue(null);
 		app_cust_keteranganBaruField.reset();
 		app_cust_keteranganBaruField.setValue(null);
 	}
  
	/* setValue to EDIT */
	function appointment_set_form(){
		app_idField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_id'));
		app_customerField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('cust_nama'));
		app_tanggalField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_tanggal'));
		app_caraField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_cara'));
		app_keteranganField.setValue(appointmentListEditorGrid.getSelectionModel().getSelected().get('app_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_appointment_form_valid(){
		//return (app_customerField.isValid() && app_cust_namaBaruField.isValid());
		return true;
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		appointment_custBaruGroup_reset();
		dapp_dokterDataStore.reload();
		dapp_terapisDataStore.reload();
		if(!appointment_createWindow.isVisible()){
			post2db='CREATE';
			appointment_detail_medisDataStore.load({
				params : {master_id : 0, start:0, limit:pageS}/*,
				callback: function(opts, success, response)  {
					  if (success) {
						  appointment_detail_medis_add();
					  }
				}*/
			});
			appointment_detail_nonmedisDataStore.load({
				params : {master_id : 0, start:0, limit:pageS}/*,
				callback: function(opts, success, response)  {
					  if (success) {
						  appointment_detail_nonmedis_add();
					  }
				}*/
			});
			appointment_reset_form();
			app_tanggalField.setValue(dt.dateFormat('Y-m-d'));
			app_caraField.setValue('Telp');
			msg='created';
			appointment_createWindow.show();
		} else {
			appointment_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function appointment_confirm_delete(){
		// only one appointment is selected here
		if(appointmentListEditorGrid.selModel.getCount() == 1){
//			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', appointment_detail_delete);
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', appointment_detail_delete);
		} else if(appointmentListEditorGrid.selModel.getCount() > 1){
//			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', appointment_detail_delete);
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', appointment_detail_delete);
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
	function appointment_confirm_update(){
		/* only one record is selected here */
		cbo_dapp_rawat_medisDataStore.load({params:{query:appointmentListEditorGrid.getSelectionModel().getSelected().get('app_id')}});
		cbo_dapp_rawat_nonmedisDataStore.load({params:{query:appointmentListEditorGrid.getSelectionModel().getSelected().get('app_id')}});
		dapp_dokterDataStore.load();
		dapp_terapisDataStore.load();
		if(appointmentListEditorGrid.selModel.getCount() == 1) {
			medis_orNonMedis=appointmentListEditorGrid.getSelectionModel().getSelected().get('kategori_nama');
			if(medis_orNonMedis=="Medis")
				detail_tab_perawatan.setActiveTab(0);
			if(medis_orNonMedis=="Non Medis")
				detail_tab_perawatan.setActiveTab(1);
			appointment_set_form();
			post2db='UPDATE';
			appointment_detail_medisDataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			appointment_detail_nonmedisDataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			appointment_createWindow.show();
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
	function appointment_delete(btn){
		if(btn=='yes'){
			var selections = appointmentListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< appointmentListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.app_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
//				waitMsg: 'Please Wait',
				waitMsg: 'Mohon tunggu',
				url: 'index.php?c=c_appointment&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							appointment_DataStore.reload();
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
  	
	/* Function for Delete Record */
	function appointment_detail_delete(btn){
		if(btn=='yes'){
			var selections = appointmentListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< appointmentListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.dapp_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_appointment&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							appointment_DataStore.reload();
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
	appointment_DataStore = new Ext.data.GroupingStore({
		id: 'appointment_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'//,
			//id: 'app_id'
		},[
		/* dataIndex => insert intoappointment_ColumnModel, Mapping => for initiate table column */ 
			{name: 'app_id', type: 'int', mapping: 'app_id'}, 
			{name: 'cust_id', type: 'int', mapping: 'cust_id'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'rawat_id', type: 'int', mapping: 'rawat_id'}, 
			{name: 'rawat_nama', type: 'string', mapping: 'rawat_nama'}, 
			{name: 'dapp_jamreservasi', type: 'string', mapping: 'dapp_jamreservasi'}, 
			{name: 'dokter_id', type: 'int', mapping: 'dokter_id'}, 
			{name: 'dokter_nama', type: 'string', mapping: 'dokter_nama'},
			{name: 'dokter_username', type: 'string', mapping: 'dokter_username'},
			{name: 'dokter_no', type: 'string', mapping: 'dokter_no'},
			{name: 'terapis_id', type: 'int', mapping: 'terapis_id'},
			{name: 'terapis_nama', type: 'string', mapping: 'terapis_nama'},
			{name: 'terapis_username', type: 'string', mapping: 'terapis_username'},
			{name: 'terapis_no', type: 'string', mapping: 'terapis_no'},
			{name: 'kategori_nama', type: 'string', mapping: 'kategori_nama'}, 
			{name: 'dapp_id', type: 'int', mapping: 'dapp_id'},
			{name: 'dapp_status', type: 'string', mapping: 'dapp_status'},
			{name: 'app_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'app_tanggal'}, 
			{name: 'dapp_tglreservasi', type: 'date', dateFormat: 'Y-m-d', mapping: 'dapp_tglreservasi'}, 
			{name: 'app_cara', type: 'string', mapping: 'app_cara'}, 
			{name: 'app_keterangan', type: 'string', mapping: 'app_keterangan'}, 
			{name: 'dapp_jamdatang', type: 'string', mapping: 'dapp_jamdatang'}, 
			{name: 'app_creator', type: 'string', mapping: 'app_creator'}, 
			{name: 'app_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'app_date_create'}, 
			{name: 'app_update', type: 'string', mapping: 'app_update'}, 
			{name: 'app_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'app_date_update'}, 
			{name: 'app_revised', type: 'int', mapping: 'app_revised'},
			{name: 'dapp_keterangan', type: 'string', mapping: 'dapp_keterangan'},
			{name: 'rawat_warna', type: 'int', mapping: 'rawat_warna'},
			{name: 'dapp_locked', type: 'int', mapping: 'dapp_locked'},
			{name: 'dapp_counter', type: 'string', mapping: 'dapp_counter'}
		]),
		sortInfo:{field: 'dapp_tglreservasi', direction: "ASC"},
		groupField: 'dokter_username'
	});
	/* End of Function */
	
	//ComboBox ambil data Customer
	cbo_app_cutomerDataStore = new Ext.data.Store({
		id: 'cbo_app_cutomerDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_customer_list', 
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
	//Template yang akan tampil di ComboBox
	var customer_app_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );

	dapp_dokterDataStore = new Ext.data.Store({
		id: 'dapp_dokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_dokter_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'dokter_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'dokter_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'dokter_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'dokter_count', type: 'int', mapping: 'dokter_count'}
		]),
		sortInfo:{field: 'dokter_display', direction: "ASC"}
	});
	var dapp_dokter_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dokter_username}</b> | {dokter_display} | <b>{dokter_count}</b>',
        '</div></tpl>'
    );

	dapp_terapisDataStore = new Ext.data.Store({
		id: 'dapp_terapisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_terapis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'terapis_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'terapis_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'terapis_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'terapis_count', type: 'int', mapping: 'terapis_count'},
			{name: 'absensi_shift', type: 'string', mapping: 'absensi_shift'}
		])/*,
		sortInfo:{field: 'terapis_display', direction: "ASC"}*/
	});
	var dapp_terapis_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{terapis_count}</b> | <b>{terapis_username}</b> | <b>{absensi_shift}</b></span>',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	appointment_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Tgl App',
			dataIndex: 'dapp_tglreservasi',
			width: 70,
			sortable: false,
			hidden: false,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		}, 
		{
			header: '<div align="center">' + 'Jam App' + '</div>',
			dataIndex: 'dapp_jamreservasi',
			width: 55,	//60,
			defaultSortable: false,
			editor: new Ext.form.TimeField({
				format: 'H:i:s',
				minValue: '7:00',
				maxValue: '21:00',
				increment: 30
			})
		}, 
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'rawat_nama',
			width: 210,
			sortable: false,
			renderer: function(value, cell, record){
				cell.css = "readonlycell";
				if(record.data.rawat_warna==1){
					return '<span style="color:red;">' + value + '</span>';
				}
				if(record.data.rawat_warna==2){
					return '<span style="color:black;"><b>' + value + '</b></span>';
				}
				return value;
			}
		}, 
		{
			header: '<div align="center">' + 'No. Cust' + '</div>',
			dataIndex: 'cust_no',
			width: 75,
			sortable: false,
			renderer: disable_color
		}, 
		{
			header: '<div align="center">' + 'Customer' + '</div>',
			dataIndex: 'cust_nama',
			width: 190,
			sortable: false,
			renderer: disable_color
		}, 
		{
			//header: '<div align="center">' + 'Dokter' + '</div>',
			header: 'Dokter',
			dataIndex: 'dokter_username',
			width: 70,
			sortable: false,
			editor: new Ext.form.ComboBox({
				store: dapp_dokterDataStore,
				mode: 'remote',
				tpl: dapp_dokter_tpl,
				displayField: 'dokter_username',
				valueField: 'dokter_value',
				loadingText: 'Searching...',
				itemSelector: 'div.search-item',
				triggerAction: 'all',
				anchor: '95%'
			})
		}, 
		{
			header: '<div align="center">' + 'Therapist' + '</div>',
			dataIndex: 'terapis_username',
			width: 140,
			sortable: false,
			editor: new Ext.form.ComboBox({
				store: dapp_terapisDataStore,
				mode: 'remote',
				tpl: dapp_terapis_tpl,
				displayField: 'terapis_username',
				valueField: 'terapis_value',
				loadingText: 'Searching...',
				itemSelector: 'div.search-item',
				triggerAction: 'all',
				anchor: '95%'
			})
		}, 
		{
			header: 'Kategori',
			dataIndex: 'kategori_nama',
			width: 70,
			hidden: true,
			sortable: false,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'dapp_status',
			width: 75,
			sortable: false,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dapp_status_value', 'dapp_status_display'],
					data: [['reservasi','reservasi'],['konfirmasi','konfirmasi'],['datang','datang'],['batal','batal']]
					}),
				mode: 'local',
               	displayField: 'dapp_status_display',
               	valueField: 'dapp_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            }),
            renderer: ch_status
		}, 
		{
			header: '<div align="center">' + 'Jam Dtg' + '</div>',
			dataIndex: 'dapp_jamdatang',
			width: 55,
			sortable: false,
			editor: new Ext.form.TextField({
				maxLength: 10
          	})
		}, 
		{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'dapp_keterangan',
			width: 260,
			sortable: false,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		}, 
		{
			header: 'App Creator',
			dataIndex: 'app_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'App Date Create',
			dataIndex: 'app_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'App Update',
			dataIndex: 'app_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'App Date Update',
			dataIndex: 'app_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'App Revised',
			dataIndex: 'app_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		},
		{
			header: 'Kode Warna',
			dataIndex: 'rawat_warna',
			width: 50,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	appointment_ColumnModel.defaultSortable= true;
	/* End of Function */
	var width_listGrid=500;
	function width_list(){
		return 1100;
	}

	function ch_status(val){
		if(val=="datang"){
			return '<span style="color:green;"><b>' + val + '</b></span>';
		}else if(val=="konfirmasi"){
			return '<span style="color:blue;"><b>' + val + '</b></span>';
		}else if(val=="batal"){
			return '<span style="color:red;"><b>' + val + '</b></span>';
		}
		return val;
	}

	function disable_color(value, cell){
		cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
		return value;
	}
	
	tbar_jenis_rawatField= new Ext.form.ComboBox({
		id: 'tbar_jenis_rawatField',
		store:new Ext.data.SimpleStore({
			fields:['tbar_medis_or_non_value', 'tbar_medis_or_non_display'],
			data:[['Medis','Medis'],['Non Medis','Non Medis']]
		}),
		mode: 'local',
		displayField: 'tbar_medis_or_non_display',
		valueField: 'tbar_medis_or_non_value',
		listeners:{
			render: function(c){
			Ext.get(this.id).set({qtip:'Pilihan Medis / Non Medis'});
			}
		},
		editable:false,
		width: 76,
		triggerAction: 'all'	
	});
	
	tbar_dokter_tglField= new Ext.form.DateField({
		id: 'tbar_dokter_tglField',
		fieldLabel: 'Tanggal Reservasi',
		format : 'd-m-Y',
		emptyText: 'Tgl App',
		ref: '../appDokterTgl'
	});
	
	tbar_nonmedis_tglField= new Ext.form.DateField({
		id: 'tbar_nonmedis_tglField',
		fieldLabel: 'Tanggal Reservasi',
		format : 'd-m-Y',
		emptyText: 'Tgl App',
		hidden:true,
		ref: '../appNonMedisTgl'
	});
    
	/* Declare DataStore and  show datagrid list */
	appointmentListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'appointmentListEditorGrid',
		el: 'fp_appointment',
		title: 'Daftar Appointment',
		autoHeight: true,
		store: appointment_DataStore, // DataStore
		cm: appointment_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		//viewConfig: { forceFit:true},
		view: new Ext.grid.GroupingView({
            forceFit:true,
            groupTextTpl: '{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})'
        }),
	  	width: 1220,
	  	//autoWidth: true,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: appointment_DataStore,
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
			disabled:false,
			handler: appointment_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: appointment_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			id: 'simpleSearch',
			store: appointment_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					tbar_jenis_rawatField.reset();
					if(e.getKey() == e.ENTER){
						//appointment_ColumnModel.setHidden(5,false);
						//appointment_ColumnModel.setHidden(6,false);
						appointment_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
						appointment_DataStore.groupBy('dokter_username');
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- Default Tgl Sekarang<br>- Nama Customer<br>- Cara Appointment<br>- Keterangan'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: appointment_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: appointment_export_excel
		}, '-',tbar_jenis_rawatField, '-',tbar_nonmedis_tglField, '-',tbar_dokter_tglField, '-',{
			xtype: 'combo',
			id: 'cbo_dokter',
			text: 'Pilihan Dokter',
			emptyText: 'Pilihan Dokter',
			width: 200,
			store: dapp_dokterDataStore,
            fieldLabel: 'ComboBox Dokter',
            mode: 'remote',
			tpl: dapp_dokter_tpl,
			displayField: 'dokter_username',
			valueField: 'dokter_value',
			loadingText: 'Searching...',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: appointment_print  
		}, '-',{
			text: 'Waiting List',
			tooltip: 'Waiting List',
			//iconCls:'icon-print',
			handler: function(){window.open("system/application/views/main/waitinglist/waitinglist.php")}  
		}
//		{
//			text: 'Waiting List',
//			tooltip: 'Waiting List',
//			iconCls:'icon-print',
//			handler: function(){window.open("waitinglist/waitinglist.php")  
		/*,{
			xtype: 'combo',
			id: 'cbo_page',
			width: 50,
			store: new Ext.data.SimpleStore({
				fields:['set_page', 'set_page'],
				data: [[5,5],[10,10],[15,15],[20,20],[25,25]]
				}),
            fieldLabel: 'ComboBox',
            displayField: 'set_page',
            valueField: 'set_page', 
            typeAhead: true,
            forceSelection: true,
            mode: 'local',
            triggerAction: 'all',
            selectOnFocus: true,
            editable: true
		}*/
		]
	});
	appointmentListEditorGrid.render();
	tbar_jenis_rawatField.setValue('Medis');
	/* End of DataStore */
	/*Ext.getCmp('cbo_page').on('select', function(){
	});*/
	
	tbar_jenis_rawatField.on('select', function(){
		appointment_DataStore.setBaseParam('query','');
		if(tbar_jenis_rawatField.getValue()=="Medis"){
			tbar_nonmedis_tglField.reset();
			tbar_dokter_tglField.setVisible(true);
			Ext.getCmp('cbo_dokter').setVisible(true);
			tbar_nonmedis_tglField.setVisible(false);
			
			appointment_DataStore.load({params: {
				task: 'LIST',
				start: 0,
				limit: pageS,
				jenis_rawat: tbar_jenis_rawatField.getValue()
			}});
			appointment_DataStore.groupBy('dokter_username');
			//appointment_ColumnModel.setHidden(5,false);
			//appointment_ColumnModel.setHidden(6,true);
		}else if(tbar_jenis_rawatField.getValue()=="Non Medis"){
			Ext.getCmp('cbo_dokter').reset();
			tbar_dokter_tglField.reset();
			tbar_dokter_tglField.setVisible(false);
			Ext.getCmp('cbo_dokter').setVisible(false);
			tbar_nonmedis_tglField.setVisible(true);
			
			appointment_DataStore.load({params: {
				task: 'LIST',
				start: 0,
				limit: pageS,
				jenis_rawat: tbar_jenis_rawatField.getValue()
			}});
			appointment_DataStore.groupBy('dapp_tglreservasi');
			//appointment_ColumnModel.setHidden(5,true);
			//appointment_ColumnModel.setHidden(6,false);
		}
	});
	
	Ext.getCmp('cbo_dokter').on('select', function(){
		appointment_DataStore.setBaseParam('query',Ext.getCmp('cbo_dokter').getValue());
		appointment_DataStore.load({params: {
			task: 'LIST',
			start: 0,
			limit: pageS,
			query: Ext.getCmp('cbo_dokter').getValue(),
			tgl_app: tbar_dokter_tglField.getValue()
		}});
	});
	
	tbar_dokter_tglField.on('select',function(){
		//if(Ext.getCmp('cbo_dokter').getValue()!==""){
			appointment_DataStore.setBaseParam('query',Ext.getCmp('cbo_dokter').getValue());
			appointment_DataStore.load({params: {
				task: 'LIST',
				start: 0,
				limit: pageS,
				query: Ext.getCmp('cbo_dokter').getValue(),
				jenis_rawat: tbar_jenis_rawatField.getValue(),
				tgl_app: tbar_dokter_tglField.getValue()
			}});
		//}
	});
	
	tbar_nonmedis_tglField.on('select',function(){
		appointment_DataStore.load({params: {
			task: 'LIST',
			start: 0,
			limit: pageS,
			jenis_rawat: tbar_jenis_rawatField.getValue(),
			tgl_app: tbar_nonmedis_tglField.getValue().format('d-m-Y')
		}});
	});
     
	/* Create Context Menu */
	appointment_ContextMenu = new Ext.menu.Menu({
		id: 'appointment_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: appointment_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: appointment_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: appointment_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: appointment_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onappointment_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		appointment_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		appointment_SelectedRow=rowIndex;
		appointment_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function appointment_editContextMenu(){
		//appointmentListEditorGrid.startEditing(appointment_SelectedRow,1);
		appointment_confirm_update();
  	}
	/* End of Function */
  	
	appointmentListEditorGrid.addListener('rowcontextmenu', onappointment_ListEditGridContextMenu);
	appointment_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	appointmentListEditorGrid.on('afteredit', appointment_update); // inLine Editing Record
	
	/* Identify  app_id Field */
	app_idField= new Ext.form.NumberField({
		id: 'app_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  app_customer Field */
	app_customerField= new Ext.form.ComboBox({
		//id: 'app_customerField',
		fieldLabel: 'Customer',
		store: cbo_app_cutomerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_app_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'query',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		anchor: '95%',
		queryDelay:1200,
		listeners:{
			/*beforequery: function(qe){
	            delete qe.combo.lastQuery;
	        },*/
			specialkey: function(f,e){
				if(e.getKey() == e.ENTER){
					cbo_app_cutomerDataStore.load({params: {query:app_customerField.getValue()}});
	            }
			},
			render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- No.Customer<br>- Nama Customer<br>- No.Telp Rumah<br>- No.Telp Kantor<br>- No.HP'});
			}
		}
	});
	/* Identify  app_tanggal Field */
	app_tanggalField= new Ext.form.DateField({
		id: 'app_tanggalField',
		fieldLabel: 'Tanggal Reservasi',
		format : 'd-m-Y',
	});
	/* Identify  app_cara Field */
	app_caraField= new Ext.form.ComboBox({
		id: 'app_caraField',
		fieldLabel: 'Cara',// <span id="tet">[?]</span>
		store:new Ext.data.SimpleStore({
			fields:['app_cara_value', 'app_cara_display'],
			data:[['Datang','Walk-in'],['Telp','Telp'],['SMS','SMS']]
		}),
		mode: 'local',
		name:'app_cara',
		displayField: 'app_cara_display',
		valueField: 'app_cara_value',
		width: 94,
		triggerAction: 'all'	
	});
	/* Identify  app_keterangan Field */
	app_keteranganField= new Ext.form.TextArea({
		id: 'app_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	appointment_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [app_customerField, app_tanggalField, app_caraField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [app_keteranganField, app_idField] 
			}
			]
	
	});

	app_cust_namaBaruField=new Ext.form.TextField({
		id: 'app_cust_namaBaruField',
		fieldLabel: 'Nama Customer',
		maxLength: 30,
		anchor: '95%'
	});

	app_cust_telpBaruField=new Ext.form.TextField({
		id: 'app_cust_telpBaruField',
		fieldLabel: 'No.Telp. Rumah',
		maxLength: 30,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	app_cust_hpBaruField=new Ext.form.TextField({
		id: 'app_cust_hpBaruField',
		fieldLabel: 'No. HandPhone',
		maxLength: 30,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	app_cust_keteranganBaruField= new Ext.form.TextArea({
		id: 'app_cust_keteranganBaruField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});

	appointment_custBaruGroup = new Ext.form.FieldSet({
		title: 'Customer Baru',
		checkboxToggle:true,
		autoHeight: true,
		layout:'column',
		collapsed: true,
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [app_cust_namaBaruField, app_cust_telpBaruField, app_cust_hpBaruField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [app_cust_keteranganBaruField] 
			} ]
	
	});
	
	cbo_dapp_rawat_medisDataStore = new Ext.data.Store({
		id: 'cbo_dapp_rawat_medisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_rawat_medis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'dapp_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'dapp_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'dapp_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'dapp_rawat_group', type: 'string', mapping: 'group_nama'},
			{name: 'dapp_rawat_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'dapp_rawat_du', type: 'float', mapping: 'rawat_du'},
			{name: 'dapp_rawat_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'dapp_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'dapp_rawat_display', direction: "ASC"}
	});
	cbo_dapp_rawat_nonmedisDataStore = new Ext.data.Store({
		id: 'cbo_dapp_rawat_nonmedisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_rawat_nonmedis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'dapp_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'dapp_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'dapp_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'dapp_rawat_group', type: 'string', mapping: 'group_nama'},
			{name: 'dapp_rawat_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'dapp_rawat_du', type: 'float', mapping: 'rawat_du'},
			{name: 'dapp_rawat_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'dapp_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'dapp_rawat_display', direction: "ASC"}
	});
	var rawat_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{dapp_rawat_kode}| <b>{dapp_rawat_display}</b>',
		'</div></tpl>'
    );
	/*var rawat_jual_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dapp_rawat_kode}</b>| {dapp_rawat_display}<br/>Group: {dapp_rawat_group}<br/>',
			'Kategori: {dapp_rawat_kategori}</span>',
		'</div></tpl>'
    );*/
	
	cbo_dapp_dokterDataStore = new Ext.data.Store({
		id: 'cbo_dapp_dokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_dokter_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'dokter_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'dokter_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'dokter_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'dokter_count', type: 'int', mapping: 'dokter_count'}
		]),
		sortInfo:{field: 'dokter_display', direction: "ASC"}
	});
	var dokter_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dokter_username}</b> | {dokter_display} | <b>{dokter_count}</b></span>',
        '</div></tpl>'
    );
	
	/*cbo_dapp_terapisDataStore = new Ext.data.Store({
		id: 'cbo_dapp_terapisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=get_terapis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		// dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column 
			{name: 'terapis_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'terapis_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'terapis_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'terapis_jmltindakan', type: 'int', mapping: 'reportt_jmltindakan'}
		]),
		sortInfo:{field: 'terapis_display', direction: "ASC"}
	});
	var cbo_terapis_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{terapis_username}</b> | {terapis_display} | <b>{terapis_jmltindakan}</b></span>',
        '</div></tpl>'
    );*/
	
	
	
		
	/* START DETAIL-MEDIS Declaration */
		
	// Function for json reader of detail
	var appointment_detail_medis_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dapp_medis_id', type: 'int', mapping: 'dapp_id'}, 
			{name: 'dapp_medis_master', type: 'int', mapping: 'dapp_master'}, 
			{name: 'dapp_medis_perawatan', type: 'int', mapping: 'dapp_perawatan'}, 
			{name: 'dapp_medis_tglreservasi', type: 'date', dateFormat: 'Y-m-d', mapping: 'dapp_tglreservasi'}, 
			{name: 'dapp_medis_jamreservasi', type: 'string', mapping: 'dapp_jamreservasi'}, 
			{name: 'dapp_medis_petugas', type: 'int', mapping: 'dapp_petugas'}, 
			{name: 'dapp_medis_petugas2', type: 'int', mapping: 'dapp_petugas2'}, 
			{name: 'dapp_medis_status', type: 'string', mapping: 'dapp_status'}, 
			{name: 'dapp_medis_tgldatang', type: 'date', dateFormat: 'Y-m-d', mapping: 'dapp_tgldatang'}, 
			{name: 'dapp_medis_jamdatang', type: 'string', mapping: 'dapp_jamdatang'},
			{name: 'dapp_medis_keterangan', type: 'string', mapping: 'dapp_keterangan'}
	]);
	//eof
	
	//function for json writer of detail
	var appointment_detail_medis_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	appointment_detail_medisDataStore = new Ext.data.Store({
		id: 'appointment_detail_medisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=detail_appointment_detail_medis_list', 
			method: 'POST'
		}),
		reader: appointment_detail_medis_reader,
		baseParams:{master_id: app_idField.getValue()},
		sortInfo:{field: 'dapp_medis_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_appointment_detail_medis= new Ext.ux.grid.RowEditor({
        saveText: 'Update'/*,
        listeners: {
			afteredit: function(){
				cbo_dapp_dokterDataStore.load();
			}
		}*/
    });
	//eof
	
	var combo_dapp_rawat_medis=new Ext.form.ComboBox({
			store: cbo_dapp_rawat_medisDataStore,
			mode: 'remote',
			displayField: 'dapp_rawat_display',
			valueField: 'dapp_rawat_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:15,
			hideTrigger:false,
			tpl: rawat_jual_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			allowBlank: true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var combo_dapp_dokter_medis=new Ext.form.ComboBox({
			store: dapp_dokterDataStore,
			mode: 'remote',
			tpl: dapp_dokter_tpl,
			displayField: 'dokter_username',
			valueField: 'dokter_value',
			loadingText: 'Searching...',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			anchor: '95%'
	});
	
/*	var combo_dapp_terapis_medis=new Ext.form.ComboBox({
			store: cbo_dapp_terapisDataStore,
			mode: 'remote',
			displayField: 'terapis_display',
			valueField: 'terapis_value',
			loadingText: 'Searching...',
			triggerAction: 'all',
			anchor: '95%'

	});*/

	var combo_dapp_jam_medis=new Ext.form.TimeField({
		format: 'H:i:s',
		minValue: '7:00',
		maxValue: '21:00',
		increment: 30,
		width: 94
	});
	/*combo_dapp_jam_medis.on('select', function(){
		var dapp_medis_record;
		var j=appointment_detail_medisListEditorGrid.getStore().getCount();
		for(i=0;i<j;i++){
			dapp_medis_record=appointment_detail_medisListEditorGrid.getStore().getAt(i);
			//cbo_dapp_dokterDataStore.load({params: {tgl_app:dapp_medis_record.data.dapp_medis_tglreservasi}});
			cbo_dapp_dokterDataStore.load({params: {tgl_app:combo_dapp_tgl_medis.getValue()}});
		}
	});*/

	var combo_dapp_tgl_medis=new Ext.form.DateField({
		format: 'd-m-Y'
	});
	/*combo_dapp_tgl_medis.on('select', function(){
		combo_dapp_tgl_medis.setValue(combo_dapp_tgl_medis.getValue().format('Y-m-d'));
	});*/

	var combo_dapp_medis_status=new Ext.form.ComboBox({
		typeAhead: true,
		triggerAction: 'all',
		store:new Ext.data.SimpleStore({
			fields:['dapp_status_value', 'dapp_status_display'],
			data: [['reservasi','reservasi'],['konfirmasi','konfirmasi'],['datang','datang'],['batal','batal']]
			}),
		mode: 'local',
       	displayField: 'dapp_status_display',
       	valueField: 'dapp_status_value',
       	lazyRender:true,
       	listClass: 'x-combo-list-small'
    });
	
	//declaration of detail coloumn model
	appointment_detail_medis_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Perawatan <span id="medis" style="font-size:11px;color:#F00">| search by?</span>',
			dataIndex: 'dapp_medis_perawatan',
			width: 230,
			sortable: true,
			editor: combo_dapp_rawat_medis,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_rawat_medis)
		},
		{
			header: 'Tgl Appointment',
			dataIndex: 'dapp_medis_tglreservasi',
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: combo_dapp_tgl_medis
		},
		{
			header: 'Jam Appointment',
			dataIndex: 'dapp_medis_jamreservasi',
			width: 100,
			sortable: true,
			editor: combo_dapp_jam_medis
		},
		{
			header: 'Dokter',
			dataIndex: 'dapp_medis_petugas',
			width: 210,
			sortable: true,
			editor: combo_dapp_dokter_medis,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_dokter_medis)
		},
		{
			header: 'Status',
			dataIndex: 'dapp_medis_status',
			width: 100,
			sortable: true,
			editable:false,
			editor: combo_dapp_medis_status
		},
		{
			header:'Keterangan',
			dataIndex: 'dapp_medis_keterangan',
			width:200,
			sortable:false,
			editor: new Ext.form.TextField({maxLength:250})
		}]
	);
	appointment_detail_medis_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid Perawatan Medis
	appointment_detail_medisListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'appointment_detail_medisListEditorGrid',
		el: 'fp_appointment_detail_medis',
//		title: 'Detail PERAWATAN MEDIS',
		title: 'Detail Perawatan Medis',
		height: 250,
		width: 940,
		autoScroll: true,
		store: appointment_detail_medisDataStore, // DataStore
		colModel: appointment_detail_medis_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_appointment_detail_medis],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: appointment_detail_medisDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail medis record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: appointment_detail_medis_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail medis selected record',
			iconCls:'icon-delete',
			handler: appointment_detail_medis_confirm_delete
		}
		]
	});
	//eof
	
/** Event DETAIL-MEDIS **/	
	//function of detail-medis add
	function appointment_detail_medis_add(){
		var edit_appointment_detail_medis= new appointment_detail_medisListEditorGrid.store.recordType({
			dapp_medis_id	:'',		
			dapp_medis_master	:'',		
			dapp_medis_perawatan	:'',		
			dapp_medis_tglreservasi	:dt.dateFormat('Y-m-d'),		
			dapp_medis_jamreservasi	:'',		
			dapp_medis_petugas	:'',		
//			dapp_medis_petugas2	:'',		
			dapp_medis_status	:'reservasi'
		});
		editor_appointment_detail_medis.stopEditing();
		appointment_detail_medisDataStore.insert(0, edit_appointment_detail_medis);
		appointment_detail_medisListEditorGrid.getView().refresh();
		appointment_detail_medisListEditorGrid.getSelectionModel().selectRow(0);
		editor_appointment_detail_medis.startEditing(0);
	}
	
	//function for refresh detail medis
	function refresh_appointment_detail_medis(){
		//appointment_detail_medisDataStore.commitChanges();
		//appointment_detail_medisListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail medis
	function appointment_detail_medis_insert(){
		for(i=0;i<appointment_detail_medisDataStore.getCount();i++){
			appointment_detail_medis_record=appointment_detail_medisDataStore.getAt(i);
			if(app_caraField.getValue()=="Datang"){appointment_detail_medis_record.data.dapp_medis_status="Datang"}
			if(appointment_detail_medis_record.data.dapp_medis_perawatan!=""){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_appointment&m=detail_appointment_detail_medis_insert',
					params:{
					dapp_medis_id	: appointment_detail_medis_record.data.dapp_medis_id, 
					dapp_medis_master	: eval(app_idField.getValue()), 
					dapp_medis_perawatan	: appointment_detail_medis_record.data.dapp_medis_perawatan, 
					dapp_medis_tglreservasi	: appointment_detail_medis_record.data.dapp_medis_tglreservasi.format('Y-m-d'),
					dapp_medis_jamreservasi	: appointment_detail_medis_record.data.dapp_medis_jamreservasi, 
					dapp_medis_petugas	: appointment_detail_medis_record.data.dapp_medis_petugas, 
	//				dapp_medis_petugas2	: appointment_detail_medis_record.data.dapp_medis_petugas2, 
					dapp_medis_status	: appointment_detail_medis_record.data.dapp_medis_status,
					dapp_medis_keterangan	: appointment_detail_medis_record.data.dapp_medis_keterangan,
					app_cara	: app_caraField.getValue(),
					app_customer	: app_customerField.getValue(),
					app_keterangan	: app_keteranganField.getValue()
					},
					callback: function(opts, success, response){
						if(success)
							appointment_DataStore.reload();
					}
				});
			}
		}
	}
	//eof
	
	//function for purge detail medis
	function appointment_detail_purge(){
		Ext.Ajax.request({
//			waitMsg: 'Please wait...',
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_appointment&m=detail_appointment_detail_purge',
			params:{ master_id: eval(app_idField.getValue()) },
			callback: function(opts, success, response){
				if(success){
					appointment_detail_medis_insert();
					appointment_detail_nonmedis_insert();
				}
			}
		});
		
	}
/*	function appointment_detail_medis_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_appointment&m=detail_appointment_detail_medis_purge',
			params:{ master_id: eval(app_idField.getValue()) },
			success: function(response){							
				var result=eval(response.responseText);
				console.log(result);
				appointment_detail_medis_insert();
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
	//eof
	
	/* Function for Delete Confirm of detail medis */
	function appointment_detail_medis_confirm_delete(){
		// only one record is selected here
		if(appointment_detail_medisListEditorGrid.selModel.getCount() == 1){
//			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', appointment_detail_medis_delete);
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', appointment_detail_medis_delete);
		} else if(appointment_detail_medisListEditorGrid.selModel.getCount() > 1){
//			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', appointment_detail_medis_delete);
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', appointment_detail_medis_delete);
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
	//eof
	
	//function for Delete of detail medis
	function appointment_detail_medis_delete(btn){
		if(btn=='yes'){
			var s = appointment_detail_medisListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				appointment_detail_medisDataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail medis data store
	//appointment_detail_medisDataStore.on('update', refresh_appointment_detail_medis);
/** END Event DETAIL-MEDIS **/	


	/* START DETAIL-NONMEDIS Declaration */
		
	// Function for json reader of detail nonmedis
	var appointment_detail_nonmedis_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dapp_nonmedis_id', type: 'int', mapping: 'dapp_id'}, 
			{name: 'dapp_nonmedis_master', type: 'int', mapping: 'dapp_master'}, 
			{name: 'dapp_nonmedis_perawatan', type: 'int', mapping: 'dapp_perawatan'}, 
			{name: 'dapp_nonmedis_tglreservasi', type: 'date', dateFormat: 'Y-m-d', mapping: 'dapp_tglreservasi'}, 
			{name: 'dapp_nonmedis_jamreservasi', type: 'string', mapping: 'dapp_jamreservasi'}, 
			{name: 'dapp_nonmedis_petugas', type: 'int', mapping: 'dapp_petugas'}, 
			{name: 'dapp_nonmedis_petugas2', type: 'int', mapping: 'dapp_petugas2'}, 
			{name: 'dapp_nonmedis_status', type: 'string', mapping: 'dapp_status'}, 
			{name: 'dapp_nonmedis_tgldatang', type: 'date', dateFormat: 'Y-m-d', mapping: 'dapp_tgldatang'}, 
			{name: 'dapp_nonmedis_jamdatang', type: 'string', mapping: 'dapp_jamdatang'},
			{name: 'dapp_nonmedis_keterangan', type: 'string', mapping: 'dapp_keterangan'}
	]);
	//eof
	
	//function for json writer of detail nonmedis
	var appointment_detail_nonmedis_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail nonmedis*/
	appointment_detail_nonmedisDataStore = new Ext.data.Store({
		id: 'appointment_detail_nonmedisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_appointment&m=detail_appointment_detail_nonmedis_list', 
			method: 'POST'
		}),
		reader: appointment_detail_nonmedis_reader,
		baseParams:{master_id: app_idField.getValue()},
		sortInfo:{field: 'dapp_nonmedis_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail nonmedis
	var editor_appointment_detail_nonmedis= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	
	
	var combo_dapp_rawat_nonmedis=new Ext.form.ComboBox({
			store: cbo_dapp_rawat_nonmedisDataStore,
			mode: 'remote',
			displayField: 'dapp_rawat_display',
			valueField: 'dapp_rawat_value',
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
	
/*	var combo_dapp_dokter_nonmedis=new Ext.form.ComboBox({
			store: cbo_dapp_dokterDataStore,
			mode: 'remote',
			displayField: 'dokter_display',
			valueField: 'dokter_value',
			loadingText: 'Searching...',
			triggerAction: 'all',
			anchor: '95%'
	});*/
	
	var combo_dapp_terapis_nonmedis=new Ext.form.ComboBox({
			store: dapp_terapisDataStore,
			mode: 'local',
			tpl: dapp_terapis_tpl,
			displayField: 'terapis_username',
			valueField: 'terapis_value',
			loadingText: 'Searching...',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			anchor: '95%'

	});

	var combo_dapp_jam_nonmedis=new Ext.form.TimeField({
		format: 'H:i:s',
		minValue: '7:00',
		maxValue: '21:00',
		increment: 30,
		width: 94
	});
	/*combo_dapp_jam_nonmedis.on('select', function(){
		var dapp_nonmedis_record;
		var j=appointment_detail_nonmedisListEditorGrid.getStore().getCount();
		for(i=0;i<j;i++){
			dapp_nonmedis_record=appointment_detail_nonmedisListEditorGrid.getStore().getAt(i);
			//cbo_dapp_dokterDataStore.load({params: {tgl_app:dapp_medis_record.data.dapp_medis_tglreservasi}});
			cbo_dapp_terapisDataStore.load({params: {tgl_app:combo_dapp_tgl_nonmedis.getValue()}});
		}
	});*/

	var combo_dapp_tgl_nonmedis=new Ext.form.DateField({
		format: 'd-m-Y'
	});
	combo_dapp_tgl_nonmedis.on('select', function(){
		//combo_dapp_tgl_nonmedis.setValue(combo_dapp_tgl_nonmedis.getValue().format('Y-m-d'));
		dapp_terapisDataStore.load({params:{tgl_app:combo_dapp_tgl_nonmedis.getValue().format('Y-m-d')}});
	});
	
	//declaration of detail nonmedis coloumn model
	appointment_detail_nonmedis_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Perawatan <span id="nonmedis" style="font-size:11px;color:#F00">| search by?</span>',
			dataIndex: 'dapp_nonmedis_perawatan',
			width: 230,
			sortable: true,
			editor: combo_dapp_rawat_nonmedis,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_rawat_nonmedis)
		},
		{
			header: 'Tgl Apointment',
			dataIndex: 'dapp_nonmedis_tglreservasi',
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: combo_dapp_tgl_nonmedis
		},
		{
			header: 'Jam Appointment',
			dataIndex: 'dapp_nonmedis_jamreservasi',
			width: 100,
			sortable: true,
			editor: combo_dapp_jam_nonmedis
		},
		{
			header: 'Therapist',
			dataIndex: 'dapp_nonmedis_petugas2',
			width: 210,
			sortable: true,
			editor: combo_dapp_terapis_nonmedis,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_terapis_nonmedis)
		},
		{
			header: 'Status',
			dataIndex: 'dapp_nonmedis_status',
			width: 100,
			editable: false,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dapp_status_value', 'dapp_status_display'],
					data: [['reservasi','reservasi'],['konfirmasi','konfirmasi'],['datang','datang'],['batal','batal']]
					}),
				mode: 'local',
               	displayField: 'dapp_status_display',
               	valueField: 'dapp_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header:'Keterangan',
			dataIndex: 'dapp_nonmedis_keterangan',
			width:200,
			sortable:false,
			editor: new Ext.form.TextField({maxLength:250})
		},{
            xtype: 'booleancolumn',
            header: 'Hitung',
            dataIndex: 'dapp_nonmedis_counter',
            align: 'center',
            width: 60,
            trueText: 'Yes',
            falseText: 'No',
            editor: {
                xtype: 'checkbox'
            }
        }]
	);
	appointment_detail_nonmedis_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail nonmedis list editor grid Perawatan Medis
	appointment_detail_nonmedisListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'appointment_detail_nonmedisListEditorGrid',
		el: 'fp_appointment_detail_nonmedis',
//		title: 'Detail PERAWATAN NON-MEDIS',
		title: 'Detail Perawatan Non Medis',
		height: 250,
		width: 700,
		autoScroll: true,
		store: appointment_detail_nonmedisDataStore, // DataStore
		colModel: appointment_detail_nonmedis_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_appointment_detail_nonmedis],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: appointment_detail_nonmedisDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail nonmedis record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: appointment_detail_nonmedis_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail nonmedis selected record',
			iconCls:'icon-delete',
			handler: appointment_detail_nonmedis_confirm_delete
		}
		]
	});
	//eof

/** Event DETAIL-NONMEDIS **/	
	//function of detail-nonmedis add
	function appointment_detail_nonmedis_add(){
		var edit_appointment_detail_nonmedis= new appointment_detail_nonmedisListEditorGrid.store.recordType({
			dapp_nonmedis_id	:'',		
			dapp_nonmedis_master	:'',		
			dapp_nonmedis_perawatan	:'',		
			dapp_nonmedis_tglreservasi	:dt.dateFormat('Y-m-d'),		
			dapp_nonmedis_jamreservasi	:'',		
//			dapp_nonmedis_petugas	:'',		
			dapp_nonmedis_petugas2	:'',		
			dapp_nonmedis_status	:'reservasi',
			dapp_nonmedis_counter	:true
		});
		editor_appointment_detail_nonmedis.stopEditing();
		appointment_detail_nonmedisDataStore.insert(0, edit_appointment_detail_nonmedis);
		appointment_detail_nonmedisListEditorGrid.getView().refresh();
		appointment_detail_nonmedisListEditorGrid.getSelectionModel().selectRow(0);
		editor_appointment_detail_nonmedis.startEditing(0);
	}
	
	//function for refresh detail nonmedis
	function refresh_appointment_detail_nonmedis(){
		appointment_detail_nonmedisDataStore.commitChanges();
		appointment_detail_nonmedisListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail nonmedis
	function appointment_detail_nonmedis_insert(){
		for(i=0;i<appointment_detail_nonmedisDataStore.getCount();i++){
			appointment_detail_nonmedis_record=appointment_detail_nonmedisDataStore.getAt(i);
			if(app_caraField.getValue()=="Datang"){appointment_detail_nonmedis_record.data.dapp_nonmedis_status="Datang"}
			if(appointment_detail_nonmedis_record.data.dapp_nonmedis_perawatan!=""){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_appointment&m=detail_appointment_detail_nonmedis_insert',
					params:{
					dapp_nonmedis_id	: appointment_detail_nonmedis_record.data.dapp_nonmedis_id, 
					dapp_nonmedis_master	: eval(app_idField.getValue()), 
					dapp_nonmedis_perawatan	: appointment_detail_nonmedis_record.data.dapp_nonmedis_perawatan, 
					dapp_nonmedis_tglreservasi	: appointment_detail_nonmedis_record.data.dapp_nonmedis_tglreservasi.format('Y-m-d'),
					dapp_nonmedis_jamreservasi	: appointment_detail_nonmedis_record.data.dapp_nonmedis_jamreservasi, 
	//				dapp_nonmedis_petugas	: appointment_detail_nonmedis_record.data.dapp_nonmedis_petugas, 
					dapp_nonmedis_petugas2	: appointment_detail_nonmedis_record.data.dapp_nonmedis_petugas2, 
					dapp_nonmedis_status	: appointment_detail_nonmedis_record.data.dapp_nonmedis_status,
					dapp_nonmedis_keterangan	: appointment_detail_nonmedis_record.data.dapp_nonmedis_keterangan,
					dapp_nonmedis_counter	: appointment_detail_nonmedis_record.data.dapp_nonmedis_counter,
					app_cara	: app_caraField.getValue(),
					app_customer	: app_customerField.getValue(),
					app_keterangan	: app_keteranganField.getValue()
					},
					callback: function(opts, success, response){
						if(success)
							appointment_DataStore.reload();
					}
				});
			}
		}
	}
	//eof
	
	//function for purge detail nonmedis
/*	function appointment_detail_nonmedis_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_appointment&m=detail_appointment_detail_nonmedis_purge',
			params:{ master_id: eval(app_idField.getValue()) },
			success: function(response){							
				var result=eval(response.responseText);
				console.log(result);
				appointment_detail_nonmedis_insert();
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
	//eof
	
	/* Function for Delete Confirm of detail nonmedis */
	function appointment_detail_nonmedis_confirm_delete(){
		// only one record is selected here
		if(appointment_detail_nonmedisListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', appointment_detail_nonmedis_delete);
		} else if(appointment_detail_nonmedisListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', appointment_detail_nonmedis_delete);
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
	//eof
	
	//function for Delete of detail nonmedis
	function appointment_detail_nonmedis_delete(btn){
		if(btn=='yes'){
			var s = appointment_detail_nonmedisListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				appointment_detail_nonmedisDataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail nonmedis data store
	//appointment_detail_nonmedisDataStore.on('update', refresh_appointment_detail_nonmedis);
/** END Event DETAIL-NONMEDIS **/	
	
	var detail_tab_perawatan = new Ext.TabPanel({
		plain:true,
		activeTab: 0,
		autoHeight: true,
		items: [appointment_detail_medisListEditorGrid,appointment_detail_nonmedisListEditorGrid]
	});
	
	/* Function for retrieve create Window Panel*/ 
	appointment_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 950,        
		items: [appointment_masterGroup,appointment_custBaruGroup,detail_tab_perawatan]
		,
		buttons: [{
				text: 'Save and Close',
				handler: appointment_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					appointment_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	appointment_createWindow= new Ext.Window({
		id: 'appointment_createWindow',
		title: post2db+'Appointment',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_appointment_create',
		items: appointment_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function appointment_list_search(){
		// render according to a SQL date format.
		var app_id_search=null;
		var app_customer_search=null;
		var app_tanggal_search_date="";
		var app_cara_search=null;
		//var app_keterangan_search=null;
		var app_kategori_search=null;
		var app_dokter_search=null;
		var app_terapis_search=null;
		var app_tgl_start_reservasi_search=null;
		var app_tgl_end_reservasi_search=null;
		var app_tgl_start_app_search=null;
		var app_tgl_end_app_search=null;
		var app_rawat_medis_search=null;
		var app_rawat_nonmedis_search=null;

		if(app_idSearchField.getValue()!==null){app_id_search=app_idSearchField.getValue();}
		if(app_customerSearchField.getValue()!==null){app_customer_search=app_customerSearchField.getValue();}
		if(app_caraSearchField.getValue()!==null){app_cara_search=app_caraSearchField.getValue();}
		//if(app_keteranganSearchField.getValue()!==null){app_keterangan_search=app_keteranganSearchField.getValue();}
		if(app_kategoriSearchField.getValue()!==null){app_kategori_search=app_kategoriSearchField.getValue();}
		if(app_dokterSearchField.getValue()!==null){app_dokter_search=app_dokterSearchField.getValue();}
		if(app_terapisSearchField.getValue()!==null){app_terapis_search=app_terapisSearchField.getValue();}
		if(app_perawatan_medisSearchField.getValue()!==null){app_rawat_medis_search=app_perawatan_medisSearchField.getValue();}
		if(app_perawatan_nonmedisSearchField.getValue()!==null){app_rawat_nonmedis_search=app_perawatan_nonmedisSearchField.getValue();}
		if(Ext.getCmp('app_tgl_startReservasiSearchField').getValue()!=""){app_tgl_start_reservasi_search=Ext.getCmp('app_tgl_startReservasiSearchField').getValue().format('Y-m-d');}
		if(Ext.getCmp('app_tgl_endReservasiSearchField').getValue()!==""){app_tgl_end_reservasi_search=Ext.getCmp('app_tgl_endReservasiSearchField').getValue().format('Y-m-d');}
		if(Ext.getCmp('app_tgl_startAppSearchField').getValue()!==""){app_tgl_start_app_search=Ext.getCmp('app_tgl_startAppSearchField').getValue().format('Y-m-d');}
		if(Ext.getCmp('app_tgl_endAppSearchField').getValue()!==""){app_tgl_end_app_search=Ext.getCmp('app_tgl_endAppSearchField').getValue().format('Y-m-d');}
		// change the store parameters
		appointment_DataStore.baseParams = {
			task: 'SEARCH',
			start: 0,
			limit: pageS,
			//variable here
			app_id	:	app_id_search, 
			app_customer	:	app_customer_search, 
			app_cara	:	app_cara_search, 
			//app_keterangan	:	app_keterangan_search,
			app_kategori	:	app_kategori_search, 
			app_dokter	:	app_dokter_search,
			app_terapis	:	app_terapis_search,
			app_tgl_start_reservasi	: app_tgl_start_reservasi_search,
			app_tgl_end_reservasi	: app_tgl_end_reservasi_search,
			app_tgl_start_app	: app_tgl_start_app_search,
			app_tgl_end_app	: app_tgl_end_app_search,
			app_rawat_medis	: app_rawat_medis_search,
			app_rawat_nonmedis	: app_rawat_nonmedis_search
		};
		// Cause the datastore to do another query : 
		appointment_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function appointment_reset_search(){
		tbar_jenis_rawatField.setValue('Medis');
		//tbar_jenis_rawatField.reset();
		Ext.getCmp('cbo_dokter').reset();
		tbar_dokter_tglField.reset();
		// reset the store parameters
		appointment_DataStore.baseParams = { task: 'LIST',start:0,limit:pageS };
		appointment_DataStore.groupBy('dokter_username');
		// Cause the datastore to do another query : 
		appointment_DataStore.reload({params: {start: 0, limit: pageS}});
		appointment_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  app_id Search Field */
	app_idSearchField= new Ext.form.NumberField({
		id: 'app_idSearchField',
		fieldLabel: 'App Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  app_customer Search Field */
	app_customerSearchField= new Ext.form.ComboBox({
		id: 'app_customerSearchField',
		fieldLabel: 'Customer',
		store: cbo_app_cutomerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_app_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		anchor: '95%'
	});
	/* Identify  app_cara Search Field */
	app_caraSearchField= new Ext.form.ComboBox({
		id: 'app_caraSearchField',
		fieldLabel: 'Cara',
		store:new Ext.data.SimpleStore({
			fields:['value', 'app_cara'],
			data:[['Datang','Datang'],['Telp','Telp'],['SMS','SMS']]
		}),
		mode: 'local',
		displayField: 'app_cara',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  dokter Search Field */
	app_kategoriSearchField= new Ext.form.ComboBox({
		id: 'app_kategoriSearchField',
		//fieldLabel: 'Kategori',
		fieldLabel: 'Jenis Perawatan',
		store:new Ext.data.SimpleStore({
			fields:['value', 'dokter_nama'],
			data:[['Medis','Medis'],['Non Medis','Non Medis']]
		}),
		mode: 'local',
		displayField: 'dokter_nama',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  Dokter Search Field */
	app_dokterSearchField= new Ext.form.ComboBox({
		id: 'app_dokterSearchField',
		fieldLabel: 'Dokter',
		store: dapp_dokterDataStore,
		tpl: dapp_dokter_tpl,
		mode: 'remote',
		displayField:'dokter_display',
		valueField: 'dokter_value',
        loadingText: 'Searching...',
        itemSelector: 'div.search-item',
        triggerAction: 'all',
		allowBlank: true,
		anchor: '95%'
	});
	/* Identify  Terapis Search Field */
	app_terapisSearchField= new Ext.form.ComboBox({
		id: 'app_terapisSearchField',
		fieldLabel: 'Therapist',
		store: dapp_terapisDataStore,
		tpl: dapp_terapis_tpl,
		mode: 'remote',
		displayField:'terapis_display',
		valueField: 'terapis_value',
        loadingText: 'Searching...',
        itemSelector: 'div.search-item',
        triggerAction: 'all',
		allowBlank: true,
		anchor: '95%'
	});
	app_perawatan_medisSearchField= new Ext.form.ComboBox({
		id: 'app_perawatan_medisSearchField',
		fieldLabel: 'Perawatan Medis',
		store: cbo_dapp_rawat_medisDataStore,
		mode: 'remote',
		displayField: 'dapp_rawat_display',
		valueField: 'dapp_rawat_value',
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
	app_perawatan_nonmedisSearchField= new Ext.form.ComboBox({
		id: 'app_perawatan_nonmedisSearchField',
		fieldLabel: 'Perawatan Non-Medis',
		store: cbo_dapp_rawat_nonmedisDataStore,
		mode: 'remote',
		typeAhead: true,
		displayField: 'dapp_rawat_display',
		valueField: 'dapp_rawat_value',
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
	/* Identify  app_keterangan Search Field */
	/*app_keteranganSearchField= new Ext.form.TextArea({
		id: 'app_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});*/
	/* Identify ap_tglReservasi Searcg Field*/
	/*app_tgl_startReservasiSearchField= new Ext.form.DateField({
		fieldLabel: 'Tanggal Reservasi',
        id: 'app_tgl_startReservasiSearchField',
        vtype: 'daterange',
        endDateField: 'app_tgl_endReservasiSearchField' // id of the end date field
	});
	app_tgl_endReservasiSearchField= new Ext.form.DateField({
		fieldLabel:'s/d',
        id: 'app_tgl_endReservasiSearchField',
        vtype: 'daterange',
        endDateField: 'app_tgl_startReservasiSearchField' // id of the end date field
	});*/
	/* Identify ap_tglApp Searcg Field*/
	app_tgl_startAppSearchField= new Ext.form.DateField({
		fieldLabel: 'Tanggal Appointment',
        name: 'app_tgl_startAppSearchField',
        id: 'app_tgl_startAppSearchField',
        //vtype: 'daterange',
        endDateField: 'app_tgl_endAppSearchField' // id of the end date field
	});
	app_tgl_endAppSearchField= new Ext.form.DateField({
		fieldLabel:'s/d',
        name: 'app_tgl_endAppSearchField',
        id: 'app_tgl_endAppSearchField',
        //vtype: 'daterange',
        endDateField: 'app_tgl_startAppSearchField' // id of the end date field
	});
    
	/* Function for retrieve search Form Panel */
	appointment_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		labelWidth: 130,
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
				items: [app_customerSearchField, 
					{
						layout:'column',
						border:false,
						items:[
								{
									columnWidth:0.5,
									layout: 'form',
									labelWidth:130,
									border:false,
									defaultType: 'datefield',
									items: [
										{
											fieldLabel: 'Tgl Reservasi',
									        name: 'app_tgl_startReservasiSearchField',
									        id: 'app_tgl_startReservasiSearchField',
									        //vtype: 'daterange',
									        endDateField: 'app_tgl_endReservasiSearchField' // id of the end date field
									    },
									    {
											fieldLabel: 'Tgl Appointment',
									        name: 'app_tgl_startAppSearchField',
									        id: 'app_tgl_startAppSearchField',
									        //vtype: 'daterange',
									        endDateField: 'app_tgl_endAppSearchField' // id of the end date field
									    }] 
								},
								{
									columnWidth:0.5,
									layout: 'form',
									labelWidth:15,
									border:false,
									defaultType: 'datefield',
									items: [
										{
									        fieldLabel: 's/d',
									        name: 'app_tgl_endReservasiSearchField',
									        id: 'app_tgl_endReservasiSearchField',
									        //vtype: 'daterange',
									        startDateField: 'app_tgl_startReservasiSearchField' // id of the start date field
								      	},
								      	{
											fieldLabel: 's/d',
									        name: 'app_tgl_endAppSearchField',
									        id: 'app_tgl_endAppSearchField',
									        //vtype: 'daterange',
									        endDateField: 'app_tgl_startAppSearchField' // id of the end date field
									    }] 
								}]
					},app_perawatan_medisSearchField ,app_perawatan_nonmedisSearchField ,app_caraSearchField, app_kategoriSearchField, app_dokterSearchField, app_terapisSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: function(){
					appointment_list_search();
					appointment_searchWindow.hide();
				}
			},{
				text: 'Close',
				handler: function(){
					appointment_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	appointment_searchWindow = new Ext.Window({
		title: 'appointment Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_appointment_search',
		items: appointment_searchForm
	});
    /* End of Function */ 
    
	function appointment_reset_formSearch(){
		app_idSearchField.reset();
		app_idSearchField.setValue(null);
		app_customerSearchField.reset();
		app_customerSearchField.setValue(null);
		app_caraSearchField.reset();
		app_caraSearchField.setValue(null);
		app_kategoriSearchField.reset();
		app_kategoriSearchField.setValue(null);
		app_dokterSearchField.reset();
		app_dokterSearchField.setValue(null);
		app_terapisSearchField.reset();
		app_terapisSearchField.setValue(null);
		/*Ext.getCmp('app_tgl_startReservasiSearchField').reset();
		Ext.getCmp('app_tgl_startReservasiSearchField').setValue(null);
		Ext.getCmp('app_tgl_endReservasiSearchField').reset();
		Ext.getCmp('app_tgl_endReservasiSearchField').setValue(null);*/
		Ext.getCmp('app_tgl_startAppSearchField').reset();
		Ext.getCmp('app_tgl_startAppSearchField').setValue(null);
		Ext.getCmp('app_tgl_endAppSearchField').reset();
		Ext.getCmp('app_tgl_endAppSearchField').setValue(null);
	}
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!appointment_searchWindow.isVisible()){
			appointment_reset_formSearch();
			appointment_searchWindow.show();
		} else {
			appointment_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function appointment_print(){
		var searchquery = "";
		var app_customer_print=null;
		var app_tanggal_print_date="";
		var app_cara_print=null;
		var app_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(appointment_DataStore.baseParams.query!==null){searchquery = appointment_DataStore.baseParams.query;}
		if(appointment_DataStore.baseParams.app_customer!==null){app_customer_print = appointment_DataStore.baseParams.app_customer;}
		if(appointment_DataStore.baseParams.app_tanggal!==""){app_tanggal_print_date = appointment_DataStore.baseParams.app_tanggal;}
		if(appointment_DataStore.baseParams.app_cara!==null){app_cara_print = appointment_DataStore.baseParams.app_cara;}
		if(appointment_DataStore.baseParams.app_keterangan!==null){app_keterangan_print = appointment_DataStore.baseParams.app_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_appointment&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			app_customer : app_customer_print,
		  	app_tanggal : app_tanggal_print_date, 
			app_cara : app_cara_print,
			app_keterangan : app_keterangan_print,
		  	currentlisting: appointment_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./appointmentlist.html','appointmentlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function appointment_export_excel(){
		var searchquery = "";
		var app_customer_2excel=null;
		var app_cara_2excel=null;
		var app_kategori_2excel=null;
		var app_dokter_2excel=null;
		var app_terapis_2excel=null;
		var app_rawat_medis_2excel=null;
		var app_rawat_nonmedis_2excel=null;
		var app_tgl_start_reservasi_2excel=null;
		var app_tgl_end_reservasi_2excel=null;
		var app_tgl_start_app_2excel=null;
		var app_tgl_end_app_2excel=null;
		var win;              
		// check if we do have some search data...
		if(appointment_DataStore.baseParams.query!==null){searchquery = appointment_DataStore.baseParams.query;}
		if(appointment_DataStore.baseParams.app_customer!==null){app_customer_2excel = appointment_DataStore.baseParams.app_customer;}
		if(appointment_DataStore.baseParams.app_cara!==null){app_cara_2excel = appointment_DataStore.baseParams.app_cara;}
		if(appointment_DataStore.baseParams.app_kategori!==null){app_kategori_2excel = appointment_DataStore.baseParams.app_kategori;}
		if(appointment_DataStore.baseParams.app_dokter!==null){app_dokter_2excel = appointment_DataStore.baseParams.app_dokter;}
		if(appointment_DataStore.baseParams.app_terapis!==null){app_terapis_2excel = appointment_DataStore.baseParams.app_terapis;}
		if(appointment_DataStore.baseParams.app_tgl_start_reservasi!==null){app_tgl_start_reservasi_2excel = appointment_DataStore.baseParams.app_tgl_start_reservasi;}
		if(appointment_DataStore.baseParams.app_tgl_end_reservasi!==null){app_tgl_end_reservasi_2excel = appointment_DataStore.baseParams.app_tgl_end_reservasi;}
		if(appointment_DataStore.baseParams.app_tgl_start_app!==null){app_tgl_start_app_2excel = appointment_DataStore.baseParams.app_tgl_start_app;}
		if(appointment_DataStore.baseParams.app_tgl_end_app!==null){app_tgl_end_app_2excel = appointment_DataStore.baseParams.app_tgl_end_app;}
		if(appointment_DataStore.baseParams.app_rawat_medis!==null){app_rawat_medis_2excel = appointment_DataStore.baseParams.app_rawat_medis;}
		if(appointment_DataStore.baseParams.app_rawat_nonmedis!==null){app_rawat_nonmedis_2excel = appointment_DataStore.baseParams.app_rawat_nonmedis;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_appointment&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			app_customer : app_customer_2excel,
			app_cara : app_cara_2excel,
			app_kategori	: app_cara_2excel,
			app_dokter	: app_dokter_2excel,
			app_terapis	: app_terapis_2excel,
			app_tgl_start_reservasi	: app_tgl_start_reservasi_2excel,
			app_tgl_end_reservasi	: app_tgl_end_reservasi_2excel,
			app_tgl_start_app	: app_tgl_start_app_2excel,
			app_tgl_end_app	: app_tgl_end_app_2excel,
			app_rawat_medis	: app_rawat_medis_2excel,
			app_rawat_nonmedis	: app_rawat_nonmedis_2excel,
		  	currentlisting: appointment_DataStore.baseParams.task // this tells us if we are searching or not
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

	new Ext.ToolTip({
		target:Ext.get('help_customer'),
		title: 'Search-By',
		dismissDelay: 15000,
		html: '- No.Customer<br>- Nama Customer<br>- Telp. Rumah<br>- Telp. Kantor<br>- HandPhone',
		trackMouse: true
		});
	new Ext.ToolTip({
		target:Ext.get('medis'),
		title: 'Search-By',
		dismissDelay: 15000,
		html: '- Kode Perawatan<br>- Nama Perawatan',
		trackMouse: true
		});
	new Ext.ToolTip({
		target:Ext.get('nonmedis'),
		title: 'Search-By',
		dismissDelay: 15000,
		html: '- Kode Perawatan<br>- Nama Perawatan',
		trackMouse: true
		});
	Ext.QuickTips.init();
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_appointment"></div>
        <div id="fp_appointment_detail_medis"></div>
		<div id="fp_appointment_detail_nonmedis"></div>
		<div id="elwindow_appointment_create"></div>
        <div id="elwindow_appointment_search"></div>
    </div>
</div>
</body>