<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan_nonmedis View
	+ Description	: For record view
	+ Filename 		: v_tindakan_nonmedis_nonmedis.php
 	+ Author  		: masongbee
 	+ Created on 22/Oct/2009 19:16:47
	
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
var tindakan_nonmedis_DataStore;
var tindakan_nonmedis_ColumnModel;
var tindakan_nonmedisListEditorGrid;
var tindakan_nonmedis_createForm;
var tindakan_nonmedis_createWindow;
var tindakan_nonmedis_searchForm;
var tindakan_nonmedis_searchWindow;
var tindakan_nonmedis_SelectedRow;
var tindakan_nonmedisContextMenu;
//for detail data
var tindakan_nonmedis_detail_DataStor;
var tindakan_nonmedis_detailListEditorGrid;
var tindakan_nonmedis_detail_ColumnModel;
var tindakan_nonmedis_detail_proxy;
var tindakan_nonmedis_detail_writer;
var tindakan_nonmedis_detail_reader;
var editor_tindakan_nonmedis_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var trawat_nonmedis_idField;
var trawat_nonmedis_custField;
var trawat_nonmedis_keteranganField;
var trawat_nonmedis_idSearchField;
var trawat_nonmedis_custSearchField;
//var trawat_nonmedis_appointmentSearchField;
var trawat_nonmedis_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function tindakan_nonmedis_update(oGrid_event){
		var trawat_id_update_pk="";
		var trawat_cust_update=null;
		var trawat_keterangan_update=null;
		var dtrawat_status_update=null;
		var trawat_cust_id_update=null;
		var dtrawat_perawatan_id_update=null;
		var dtrawat_perawatan_update=null;
		var dtrawat_id_update=null;
		var perawatan_harga_update=null;
		var perawatan_du_update=null;
		var perawatan_dm_update=null;
		var cust_member_update=null;
		var dtrawat_keterangan_update=null;
		var dtrawat_dapp_update="";
		var dtrawat_terapis_update=null;
		var dtrawat_terapis_id_update=null;
		var dtrawat_ambil_paket_update="";
		var dapaket_dpaket_update=null;
		var dapaket_jpaket_update=null;
		var dapaket_paket_update=null;
		var dapaket_item_update=null;

		trawat_id_update_pk = oGrid_event.record.data.trawat_id;
		if(oGrid_event.record.data.trawat_cust!== null){trawat_cust_update = oGrid_event.record.data.trawat_cust;}
		if(oGrid_event.record.data.trawat_keterangan!== null){trawat_keterangan_update = oGrid_event.record.data.trawat_keterangan;}
		dtrawat_status_update = oGrid_event.record.data.dtrawat_status;
		trawat_cust_id_update = oGrid_event.record.data.trawat_cust_id;
		dtrawat_perawatan_id_update = oGrid_event.record.data.dtrawat_perawatan_id;
		dtrawat_perawatan_update = oGrid_event.record.data.dtrawat_perawatan;
		dtrawat_id_update = oGrid_event.record.data.dtrawat_id;
		perawatan_harga_update = oGrid_event.record.data.perawatan_harga;
		perawatan_du_update = oGrid_event.record.data.perawatan_du;
		perawatan_dm_update = oGrid_event.record.data.perawatan_dm;
		cust_member_update = oGrid_event.record.data.cust_member;
		dtrawat_terapis_update = oGrid_event.record.data.dtrawat_petugas2;
		dtrawat_terapis_id_update = oGrid_event.record.data.dtrawat_petugas2_id;
		if(oGrid_event.record.data.dtrawat_keterangan!== null){dtrawat_keterangan_update = oGrid_event.record.data.dtrawat_keterangan;}
		dtrawat_dapp_update = oGrid_event.record.data.dtrawat_dapp;
		dtrawat_ambil_paket_update = oGrid_event.record.data.dtrawat_ambil_paket;
		dapaket_dpaket_update = oGrid_event.record.data.dapaket_dpaket;
		dapaket_jpaket_update = oGrid_event.record.data.dapaket_jpaket;
		dapaket_paket_update = oGrid_event.record.data.dapaket_paket;
		dapaket_item_update = oGrid_event.record.data.dapaket_item;

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_nonmedis&m=get_action',
			params: {
				task: "UPDATE",
				mode_edit: "update_list",
				trawat_id	: trawat_id_update_pk, 
				trawat_cust	:trawat_cust_update,  
				trawat_keterangan	:trawat_keterangan_update,  
				dtrawat_status	:dtrawat_status_update,
				trawat_cust_id	:trawat_cust_id_update,
				dtrawat_perawatan_id	:dtrawat_perawatan_id_update,
				dtrawat_perawatan	:dtrawat_perawatan_update,
				dtrawat_id	:dtrawat_id_update,
				rawat_harga	:perawatan_harga_update,
				rawat_du	:perawatan_du_update,
				rawat_dm	:perawatan_dm_update,
				cust_member	:cust_member_update,
				dtrawat_terapis	: dtrawat_terapis_update,
				dtrawat_terapis_id	: dtrawat_terapis_id_update,
				dtrawat_keterangan	:dtrawat_keterangan_update,
				dtrawat_dapp	: dtrawat_dapp_update,
				dtrawat_ambil_paket	: dtrawat_ambil_paket_update,
				dapaket_dpaket	: dapaket_dpaket_update,
				dapaket_jpaket	: dapaket_jpaket_update,
				dapaket_paket	: dapaket_paket_update,
				dapaket_item	: dapaket_item_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					/*case 1:
						tindakan_nonmedis_DataStore.commitChanges();
						tindakan_nonmedis_DataStore.reload();
						trawat_medis_perawatanDataStore.reload();
						break;
					case 2:
						tindakan_nonmedis_DataStore.reload();
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Tidak bisa diubah, karena di Kasir sudah selesai diproses.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
					case 3:
						tindakan_nonmedis_DataStore.reload();
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Tidak dilakukan perubahan apapun, karena perawatan pengganti tidak terdapat dalam Kepemilikan Paket.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   width: 250,
						   icon: Ext.MessageBox.WARNING
						});
						break;*/
					default:
						tindakan_nonmedis_DataStore.commitChanges();
						tindakan_nonmedis_DataStore.reload();
						trawat_nonmedis_perawatanDataStore.reload();
						/*Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Perubahan tidak dapat disimpan.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});*/
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
	function tindakan_nonmedis_create(){
		/*for(i=0;i<tindakan_nonmedis_detail_DataStore.getCount();i++){
			appointment_detail_nonmedis_record=tindakan_nonmedis_detail_DataStore.getAt(i);
			if(!/^\d+$/.test(appointment_detail_nonmedis_record.data.dtrawat_perawatan)){
				//dtnonmedis_rawat='ada';
			}
		}*/
	
		if(is_tindakan_nonmedis_form_valid()){	
		var trawat_id_create=null; 
		var trawat_cust_create=null; 
		var trawat_keterangan_create=null; 

		if(trawat_nonmedis_idField.getValue()!== null){trawat_id_create = trawat_nonmedis_idField.getValue();}else{trawat_id_create_pk=get_pk_id();} 
		if(trawat_nonmedis_custField.getValue()!== null){trawat_cust_create = trawat_nonmedis_custField.getValue();} 
		if(trawat_nonmedis_keteranganField.getValue()!== null){trawat_keterangan_create = trawat_nonmedis_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_nonmedis&m=get_action',
			params: {
				task: post2db,
				trawat_id	: trawat_id_create, 
				trawat_cust	: trawat_cust_create, 
				trawat_keterangan	: trawat_keterangan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						//tindakan_nonmedis_detail_purge();
						tindakan_nonmedis_detail_insert();
						//Ext.MessageBox.alert(post2db+' OK','The Tindakan was '+msg+' successfully.');
						tindakan_nonmedis_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Tindakan.',
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
			return tindakan_nonmedisListEditorGrid.getSelectionModel().getSelected().get('trawat_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function tindakan_nonmedis_reset_form(){
		trawat_nonmedis_idField.reset();
		trawat_nonmedis_idField.setValue(null);
		trawat_nonmedis_custField.reset();
		trawat_nonmedis_custField.setValue(null);
		trawat_nonmedis_keteranganField.reset();
		trawat_nonmedis_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function tindakan_nonmedis_set_form(){
		trawat_nonmedis_idField.setValue(tindakan_nonmedisListEditorGrid.getSelectionModel().getSelected().get('trawat_id'));
		trawat_nonmedis_custField.setValue(tindakan_nonmedisListEditorGrid.getSelectionModel().getSelected().get('trawat_cust'));
		trawat_nonmedis_custidField.setValue(tindakan_nonmedisListEditorGrid.getSelectionModel().getSelected().get('trawat_cust_id'));
		trawat_nonmedis_keteranganField.setValue(tindakan_nonmedisListEditorGrid.getSelectionModel().getSelected().get('trawat_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_tindakan_nonmedis_form_valid(){
		return (true &&  trawat_nonmedis_custField.isValid() && true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!tindakan_nonmedis_createWindow.isVisible()){
			tindakan_nonmedis_reset_form();
			post2db='CREATE';
			msg='created';
			tindakan_nonmedis_createWindow.show();
		} else {
			tindakan_nonmedis_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function tindakan_nonmedis_confirm_delete(){
		// only one tindakan_nonmedis is selected here
		if(tindakan_nonmedisListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_nonmedis_delete);
		} else if(tindakan_nonmedisListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_nonmedis_delete);
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
	function tindakan_nonmedis_confirm_update(){
		/* only one record is selected here */
		
		if(tindakan_nonmedisListEditorGrid.selModel.getCount() == 1) {
			cbo_dtrawat_petugas_nonmedisDataStore.load();
			trawat_nonmedis_perawatanDataStore.load({params:{query:tindakan_nonmedisListEditorGrid.getSelectionModel().getSelected().get('trawat_id')}});
			//cbo_dtrawat_perawatan_nonmedisDataStore.load();
			tindakan_nonmedis_set_form();
			post2db='UPDATE';
			tindakan_nonmedis_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			tindakan_nonmedis_createWindow.show();
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
	function tindakan_nonmedis_delete(btn){
		if(btn=='yes'){
			var selections = tindakan_nonmedisListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< tindakan_nonmedisListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.trawat_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_tindakan_nonmedis&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							tindakan_nonmedis_DataStore.reload();
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
  	
	Ext.util.Format.comboRenderer = function(combo){
		//trawat_nonmedis_perawatanDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
  
	/* Function for Retrieve DataStore */
	tindakan_nonmedis_DataStore = new Ext.data.Store({
		id: 'tindakan_nonmedis_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_nonmedis&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'dtrawat_id'
		},[
		/* dataIndex => insert intotindakan_nonmedis_ColumnModel, Mapping => for initiate table column */ 
			{name: 'trawat_id', type: 'int', mapping: 'trawat_id'}, 
			{name: 'trawat_cust_id', type: 'int', mapping: 'trawat_cust'}, 
			{name: 'trawat_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'trawat_cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'trawat_keterangan', type: 'string', mapping: 'trawat_keterangan'}, 
			{name: 'trawat_creator', type: 'string', mapping: 'trawat_creator'}, 
			{name: 'trawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'trawat_date_create'}, 
			{name: 'trawat_update', type: 'string', mapping: 'trawat_update'}, 
			{name: 'trawat_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'trawat_date_update'}, 
			{name: 'trawat_revised', type: 'int', mapping: 'trawat_revised'},
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'},
			{name: 'dtrawat_dapp', type: 'int', mapping: 'dtrawat_dapp'},
			{name: 'dtrawat_perawatan_id', type: 'int', mapping: 'dtrawat_perawatan'},
			{name: 'dtrawat_perawatan', type: 'string', mapping: 'rawat_nama'},
			{name: 'dtrawat_petugas2', type: 'string', mapping: 'terapis_username'},
			{name: 'dtrawat_petugas2_id', type: 'int', mapping: 'terapis_id'},
			{name: 'dtrawat_jam', type: 'string', mapping: 'dtrawat_jam'},
			{name: 'dtrawat_tglapp', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_tglapp'},
			{name: 'dtrawat_status', type: 'string', mapping: 'dtrawat_status'},
			{name: 'perawatan_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'perawatan_du', type: 'int', mapping: 'rawat_du'},
			{name: 'perawatan_dm', type: 'int', mapping: 'rawat_dm'},
			{name: 'cust_member', type: 'string', mapping: 'cust_member'},
			{name: 'dtrawat_keterangan', type: 'string', mapping: 'dtrawat_keterangan'},
			{name: 'dtrawat_ambil_paket', type: 'string', mapping: 'dtrawat_ambil_paket'},
			{name: 'cust_punya_paket', type: 'string', mapping: 'cust_punya_paket'},
			{name: 'dapaket_dpaket', type: 'int', mapping: 'dpaket_id'},
			{name: 'dapaket_jpaket', type: 'int', mapping: 'dpaket_master'},
			{name: 'dapaket_paket', type: 'int', mapping: 'dpaket_paket'},
			{name: 'dtrawat_edit', type: 'string', mapping: 'dtrawat_edit'}
		])/*,
		sortInfo:{field: 'dtrawat_id', direction: "DESC"}*/
	});
	/* End of Function */
	
	//ComboBox ambil data Customer
	cbo_tnonmedis_cutomerDataStore = new Ext.data.Store({
		id: 'cbo_tnonmedis_cutomerDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_nonmedis&m=get_customer_list', 
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
	var customer_tnonmedis_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	trawat_nonmedis_perawatanDataStore = new Ext.data.Store({
		id: 'trawat_nonmedis_perawatanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_nonmedis&m=get_tindakan_nonmedis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'perawatan_value', type: 'int', mapping: 'rawat_id'},
			{name: 'perawatan_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'perawatan_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'perawatan_group', type: 'string', mapping: 'group_nama'},
			{name: 'perawatan_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'perawatan_du', type: 'float', mapping: 'rawat_du'},
			{name: 'perawatan_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'perawatan_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'perawatan_display', direction: "ASC"}
	});
	var cbo_trawat_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{perawatan_kode}| <b>{perawatan_display}</b>',
		'</div></tpl>'
    );
	/*var cbo_trawat_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{perawatan_kode}</b>| {perawatan_display}<br/>Group: {perawatan_group}<br/>',
			'Kategori: {perawatan_kategori}</span>',
		'</div></tpl>'
    );*/

	dtrawat_karyawanDataStore = new Ext.data.Store({
		id: 'dtrawat_karyawanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_nonmedis&m=get_terapis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'karyawan_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'karyawan_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'karyawan_jmltindakan', type: 'int', mapping: 'reportt_jmltindakan'}
		]),
		sortInfo:{field: 'karyawan_display', direction: "ASC"}
	});
    var karyawan_terapis_tpl = new Ext.XTemplate(
            '<tpl for="."><div class="search-item">',
                '<span><b>{karyawan_username}</b> | {karyawan_display} | <b>{karyawan_jmltindakan}</b></span>',
            '</div></tpl>'
        );
    
  	/* Function for Identify of Window Column Model */
	tindakan_nonmedis_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '<div align="center">' + 'No Cust' + '</div>',	//'No.Customer',
			readOnly: true,
			dataIndex: 'trawat_cust_no',
			width: 65,	//75,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: '<div align="center">' + 'Customer',
			dataIndex: 'trawat_cust',
			width: 185,	//210,
			sortable: true,
			editable:false,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'dtrawat_perawatan',
			width: 185,	//210,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: trawat_nonmedis_perawatanDataStore,
				mode: 'remote',
				displayField: 'perawatan_display',
				valueField: 'perawatan_value',
				loadingText: 'Searching...',
				triggerAction: 'all',
				anchor: '95%'
			})
		}, 
		{
			header: '<div align="center">' + 'Therapist' + '</div>',
			dataIndex: 'dtrawat_petugas2',
			width: 80,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: dtrawat_karyawanDataStore,
				mode: 'remote',
				displayField: 'karyawan_username',
				valueField: 'karyawan_value',
				loadingText: 'Searching...',
				triggerAction: 'all',
				anchor: '95%'
			})
		}, 
		{
			header: '<div align="center">' + 'Jam App' + '</div>',
			dataIndex: 'dtrawat_jam',
			width: 55,
			sortable: true
		}, 
		{
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'dtrawat_status',
			width: 60,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dtrawat_status_value', 'dtrawat_status_display'],
					data: [['batal','batal'],['selesai','selesai'],['datang','datang']]
					}),
				mode: 'local',
               	displayField: 'dtrawat_status_display',
               	valueField: 'dtrawat_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            }),
            renderer: ch_status
		}, 
		{
			header: '<div align="center">' + 'Detail Keterangan' + '</div>',
			dataIndex: 'dtrawat_keterangan',
			width: 185,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Tgl App',
			dataIndex: 'dtrawat_tglapp',
			width: 150,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			sortable: true,
			hidden: true
		}, 
		{
			xtype: 'booleancolumn',
			header: 'Ambil Paket',
			dataIndex: 'dtrawat_ambil_paket',
			width: 60,	//65,
			align: 'center',
			trueText: 'Yes',
			falseText: 'No',
			editor: {
                xtype: 'checkbox'
            }
		},
		{
			header: '<div align="center">' + 'Info Paket' + '</div>',
			dataIndex: 'cust_punya_paket',
			width: 60,	//55,
			sortable: false,
			hidden: true
		},
		{
			header: '<div align="center">' + 'Stat Kasir' + '</div>',
			dataIndex: 'dtrawat_edit',
			width: 60,	//55,
			sortable: false
		},
		{
			header: 'Creator',
			dataIndex: 'trawat_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'trawat_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'trawat_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'trawat_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'trawat_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	tindakan_nonmedis_ColumnModel.defaultSortable= true;
	/* End of Function */
	function ch_status(val){
		if(val=="selesai"){
			return '<span style="color:blue;"><b>' + val + '</b></span>';
		}else if(val=="siap"){
			return '<span style="color:green;"><b>' + val + '</b></span>';
		}else if(val=="datang"){
			return '<span style="color:red;"><b>' + val + '</b></span>';
		}else if(val=="batal"){
			return '<span style="color:black;"><b>' + val + '</b></span>';
		}
		return val;
	}
    
	/* Declare DataStore and  show datagrid list */
	tindakan_nonmedisListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'tindakan_nonmedisListEditorGrid',
		el: 'fp_tindakan_nonmedis',
		title: 'Daftar Tindakan Non Medis',
		autoHeight: true,
		store: tindakan_nonmedis_DataStore, // DataStore
		cm: tindakan_nonmedis_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,	//970,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: tindakan_nonmedis_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			disabled:true,
			handler: display_form_window
		}, '-',{
			text: 'Edit',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: tindakan_nonmedis_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled:true,
			handler: tindakan_nonmedis_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: tindakan_nonmedis_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						tindakan_nonmedis_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- Nama Customer<br>- Nama Perawatan<br>- Nama Dokter<br>- Status'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: tindakan_nonmedis_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tindakan_nonmedis_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tindakan_nonmedis_print  
		}, '-',{
			text: 'Absensi',
			tooltip: 'Absensi Therapist',
			iconCls:'',
			//handler: tindakan_nonmedis_print  
			handler: function(){window.open("../Add-on/absensi/index.php")} 
		}
		]
	});
	tindakan_nonmedisListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	tindakan_nonmedisContextMenu = new Ext.menu.Menu({
		id: 'tindakan_nonmedis_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: tindakan_nonmedis_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: tindakan_nonmedis_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tindakan_nonmedis_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tindakan_nonmedis_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function ontindakan_nonmedis_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		tindakan_nonmedisContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		tindakan_nonmedis_SelectedRow=rowIndex;
		tindakan_nonmedisContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function tindakan_nonmedis_editContextMenu(){
		//tindakan_nonmedisListEditorGrid.startEditing(tindakan_nonmedis_SelectedRow,1);
		tindakan_nonmedis_confirm_update();
  	}
	/* End of Function */
  	
	tindakan_nonmedisListEditorGrid.addListener('rowcontextmenu', ontindakan_nonmedis_ListEditGridContextMenu);
	tindakan_nonmedis_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	tindakan_nonmedisListEditorGrid.on('afteredit', tindakan_nonmedis_update); // inLine Editing Record
	
	/* Identify  trawat_id Field */
	trawat_nonmedis_idField= new Ext.form.NumberField({
		id: 'trawat_nonmedis_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  trawat_cust Field */
	trawat_nonmedis_custField= new Ext.form.ComboBox({
		//id: 'trawat_nonmedis_custField',
		fieldLabel: 'Customer <span id="help_customer" style="font-size:11px;color:#F00">[?]</span>',
		store: cbo_tnonmedis_cutomerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_tnonmedis_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		disabled:true,
		anchor: '95%'
	});
	trawat_nonmedis_custidField= new Ext.form.NumberField();
	/* Identify  trawat_appointment Field */
//	trawat_nonmedis_appointmentField= new Ext.form.ComboBox({
//		id: 'trawat_nonmedis_appointmentField',
//		fieldLabel: 'Appointment',
//		store:new Ext.data.SimpleStore({
//			fields:['trawat_appointment_value', 'trawat_appointment_display'],
//			data:[['Medis','Medis'],['Non Medis','Non Medis']]
//		}),
//		mode: 'local',
//		displayField: 'trawat_appointment_display',
//		valueField: 'trawat_appointment_value',
//		anchor: '95%',
//		triggerAction: 'all'	
//	});
	/* Identify  trawat_keterangan Field */
	trawat_nonmedis_keteranganField= new Ext.form.TextArea({
		id: 'trawat_nonmedis_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	tindakan_nonmedis_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [trawat_nonmedis_custField, trawat_nonmedis_keteranganField, trawat_nonmedis_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var tindakan_nonmedis_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'}, 
			{name: 'dtrawat_master', type: 'int', mapping: 'dtrawat_master'}, 
			{name: 'dtrawat_perawatan', type: 'int', mapping: 'dtrawat_perawatan'}, 
			{name: 'dtrawat_petugas1', type: 'int', mapping: 'dtrawat_petugas1'}, 
			{name: 'dtrawat_petugas2', type: 'int', mapping: 'dtrawat_petugas2'}, 
			{name: 'dtrawat_jam', type: 'string', mapping: 'dtrawat_jam'}, 
			{name: 'dtrawat_kategori', type: 'string', mapping: 'dtrawat_kategori'}, 
			{name: 'dtrawat_status', type: 'string', mapping: 'dtrawat_status'},
			{name: 'dtrawat_keterangan', type: 'string', mapping: 'dtrawat_keterangan'},
			{name: 'dtrawat_ambil_paket', type: 'bool', mapping: 'dtrawat_ambil_paket'}
	]);
	//eof
	
	//function for json writer of detail
	var tindakan_nonmedis_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	tindakan_nonmedis_detail_DataStore = new Ext.data.Store({
		id: 'tindakan_nonmedis_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_nonmedis&m=detail_tindakan_detail_list', 
			method: 'POST'
		}),
		reader: tindakan_nonmedis_detail_reader,
		baseParams:{master_id: trawat_nonmedis_idField.getValue()},
		sortInfo:{field: 'dtrawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_tindakan_nonmedis_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	cbo_dtrawat_perawatan_nonmedisDataStore = new Ext.data.Store({
		id: 'cbo_dtrawat_perawatan_nonmedisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_nonmedis&m=get_perawatan_nonmedis_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			//dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column  
			{name: 'dtrawat_perawatan_value', type: 'int', mapping: 'rawat_id'},
			{name: 'dtrawat_perawatan_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'dtrawat_perawatan_display', direction: "ASC"}
	});
	
	cbo_dtrawat_petugas_nonmedisDataStore = new Ext.data.Store({
		id: 'cbo_dtrawat_petugas_nonmedisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tindakan_nonmedis&m=get_terapis_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'karyawan_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'dtrawat_karyawan_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'dtrawat_karyawan_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'dtrawat_karyawan_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'dtrawat_karyawan_jmltindakan', type: 'int', mapping: 'reportt_jmltindakan'}
		]),
		sortInfo:{field: 'dtrawat_karyawan_display', direction: "ASC"}
	});
	var karyawan_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dtrawat_karyawan_username}</b> | {dtrawat_karyawan_display} | <b>{dtrawat_karyawan_jmltindakan}</b></span>',
        '</div></tpl>'
    );
	
	var combo_dtrawat_perawatan=new Ext.form.ComboBox({
			store: trawat_nonmedis_perawatanDataStore,
			mode: 'remote',
			typeAhead: false,
			displayField: 'perawatan_display',
			valueField: 'perawatan_value',
			loadingText: 'Searching...',
			pageSize:10,
			hideTrigger:false,
			tpl: cbo_trawat_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true
	});
	
	var combo_dapp_terapis=new Ext.form.ComboBox({
			store: cbo_dtrawat_petugas_nonmedisDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dtrawat_karyawan_username',
			valueField: 'dtrawat_karyawan_value',
			tpl: karyawan_tpl,
			loadingText: 'Searching...',
			itemSelector: 'div.search-item',
			triggerAction: 'all'
	});
	
	var checkColumn = new Ext.grid.CheckColumn({
		header: 'Ambil Paket',
		dataIndex: 'dtrawat_ambil_paket',
		hidden: true,
		width: 75
	});
	
	//declaration of detail coloumn model
	tindakan_nonmedis_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'dtrawat_perawatan',
			width: 300,	//290,
			sortable: true,
			editor: combo_dtrawat_perawatan,
			renderer: Ext.util.Format.comboRenderer(combo_dtrawat_perawatan)
		},
		{
			header: '<div align="center">' + 'Therapist' + '</div>',
			dataIndex: 'dtrawat_petugas2',
			width: 140,	//200,
			sortable: true,
			editor: combo_dapp_terapis,
			renderer: Ext.util.Format.comboRenderer(combo_dapp_terapis)
		},
		{
			header: '<div align="center">' + 'Jam App' + '</div>',
			dataIndex: 'dtrawat_jam',
			width: 60,	//100,
			sortable: true,
			editor: new Ext.form.TimeField({
				format: 'H:i:s',
				minValue: '7:00',
				maxValue: '21:00',
				increment: 30,
				width: 94
			})
		},
		{
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'dtrawat_status',
			width: 80,	//100,
			sortable: true,
			editable:false,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dtrawat_status_value', 'dtrawat_status_display'],
					data: [['batal','batal'],['selesai','selesai'],['datang','datang']]
					}),
				mode: 'local',
               	displayField: 'dtrawat_status_display',
               	valueField: 'dtrawat_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: '<div align="center">' + 'Detail Keterangan' + '</div>',
			dataIndex: 'dtrawat_keterangan',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250,
			})
		},checkColumn]
	);
	tindakan_nonmedis_detail_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	tindakan_nonmedis_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'tindakan_nonmedis_detailListEditorGrid',
		el: 'fp_tindakan_nonmedis_detail',
		title: 'Detail Tindakan Non Medis',
		height: 250,
		width: 920,
		autoScroll: true,
		store: tindakan_nonmedis_detail_DataStore, // DataStore
		colModel: tindakan_nonmedis_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_tindakan_nonmedis_detail,checkColumn],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: tindakan_nonmedis_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: tindakan_nonmedis_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: tindakan_nonmedis_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function tindakan_nonmedis_detail_add(){
		var edit_tindakan_nonmedis_detail= new tindakan_nonmedis_detailListEditorGrid.store.recordType({
			dtrawat_id	:'',		
			dtrawat_master	:'',		
			dtrawat_perawatan	:'',		
			dtrawat_petugas1	:'',		
			dtrawat_petugas2	:'',		
			dtrawat_jam	:'',		
			dtrawat_kategori	:'',		
			dtrawat_status	:'datang'		
		});
		editor_tindakan_nonmedis_detail.stopEditing();
		tindakan_nonmedis_detail_DataStore.insert(0, edit_tindakan_nonmedis_detail);
		tindakan_nonmedis_detailListEditorGrid.getView().refresh();
		tindakan_nonmedis_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_tindakan_nonmedis_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_tindakan_nonmedis_detail(){
		//tindakan_nonmedis_detail_DataStore.commitChanges();
		//tindakan_nonmedis_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function tindakan_nonmedis_detail_insert(){
		for(i=0;i<tindakan_nonmedis_detail_DataStore.getCount();i++){
			tindakan_nonmedis_detail_record=tindakan_nonmedis_detail_DataStore.getAt(i);
			if(tindakan_nonmedis_detail_record.data.dtrawat_perawatan!=""){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_tindakan_nonmedis&m=detail_tindakan_nonmedis_detail_insert',
					params:{
					dtrawat_id	: tindakan_nonmedis_detail_record.data.dtrawat_id, 
					dtrawat_master	: eval(trawat_nonmedis_idField.getValue()), 
					dtrawat_perawatan	: tindakan_nonmedis_detail_record.data.dtrawat_perawatan, 
					dtrawat_petugas1	: tindakan_nonmedis_detail_record.data.dtrawat_petugas1, 
					dtrawat_petugas2	: tindakan_nonmedis_detail_record.data.dtrawat_petugas2, 
					dtrawat_jam	: tindakan_nonmedis_detail_record.data.dtrawat_jam, 
					dtrawat_kategori	: tindakan_nonmedis_detail_record.data.dtrawat_kategori, 
					dtrawat_status	: tindakan_nonmedis_detail_record.data.dtrawat_status, 
					dtrawat_keterangan	: tindakan_nonmedis_detail_record.data.dtrawat_keterangan,
					dtrawat_ambil_paket	: tindakan_nonmedis_detail_record.data.dtrawat_ambil_paket,
					dtrawat_cust	: trawat_nonmedis_custidField.getValue()
					},
					callback: function(opts, success, response){
						if(success){
							tindakan_nonmedis_DataStore.reload();
							/*var result = response.responseText;
							switch(result){
								default:
									Ext.MessageBox.show({
									   title: 'Warning',
									   msg: result,
									   buttons: Ext.MessageBox.OK,
									   width: 300,
									   animEl: 'save'
									});
									break;
							}*/
						}
					}
				});
			}
		}
	}
	//eof
	
	//function for purge detail
	function tindakan_nonmedis_detail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_tindakan_nonmedis&m=detail_tindakan_nonmedis_detail_purge',
			params:{ master_id: eval(trawat_nonmedis_idField.getValue()) },
			callback: function(opts, success, response){
				if(success){
					tindakan_nonmedis_detail_insert();
					tindakan_nonmedis_DataStore.reload();
				}
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function tindakan_nonmedis_detail_confirm_delete(){
		// only one record is selected here
		if(tindakan_nonmedis_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_nonmedis_detail_delete);
		} else if(tindakan_nonmedis_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_nonmedis_detail_delete);
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
	function tindakan_nonmedis_detail_delete(btn){
		if(btn=='yes'){
			var s = tindakan_nonmedis_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				tindakan_nonmedis_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	tindakan_nonmedis_detail_DataStore.on('update', refresh_tindakan_nonmedis_detail);
	
	/* Function for retrieve create Window Panel*/ 
	tindakan_nonmedis_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 930,        
		items: [tindakan_nonmedis_masterGroup,tindakan_nonmedis_detailListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: tindakan_nonmedis_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					tindakan_nonmedis_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	tindakan_nonmedis_createWindow= new Ext.Window({
		id: 'tindakan_nonmedis_createWindow',
		title: post2db+'Tindakan Non Medis',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_tindakan_nonmedis_create',
		items: tindakan_nonmedis_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function tindakan_nonmedis_list_search(){
		// render according to a SQL date format.
		var trawat_id_search=null;
		var trawat_cust_search=null;
		//var trawat_keterangan_search=null;
		var trawat_tgl_start_app_search=null;
		var trawat_tgl_end_app_search=null;
		var trawat_rawat_search=null;
		var trawat_terapis_search=null;
		var trawat_status_search=null;

		if(trawat_nonmedis_idSearchField.getValue()!==null){trawat_id_search=trawat_nonmedis_idSearchField.getValue();}
		if(trawat_nonmedis_custSearchField.getValue()!==null){trawat_cust_search=trawat_nonmedis_custSearchField.getValue();}
		//if(trawat_nonmedis_keteranganSearchField.getValue()!==null){trawat_keterangan_search=trawat_nonmedis_keteranganSearchField.getValue();}
		if(Ext.getCmp('trawat_nonmedis_tglStartAppSearchField').getValue()!==null){trawat_tgl_start_app_search=Ext.getCmp('trawat_nonmedis_tglStartAppSearchField').getValue();}
		if(Ext.getCmp('trawat_nonmedis_tglEndAppSearchField').getValue()!==null){trawat_tgl_end_app_search=Ext.getCmp('trawat_nonmedis_tglEndAppSearchField').getValue();}
		if(trawat_nonmedis_rawatSearchField.getValue()!==null){trawat_rawat_search=trawat_nonmedis_rawatSearchField.getValue();}
		if(trawat_nonmedis_terapisSearchField.getValue()!==null){trawat_terapis_search=trawat_nonmedis_terapisSearchField.getValue();}
		if(trawat_nonmedis_statusSearchField.getValue()!==null){trawat_status_search=trawat_nonmedis_statusSearchField.getValue();}
		// change the store parameters
		tindakan_nonmedis_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			trawat_id	:	trawat_id_search, 
			trawat_cust	:	trawat_cust_search, 
			//trawat_keterangan	:	trawat_keterangan_search,
			trawat_tglapp_start	: 	trawat_tgl_start_app_search,
			trawat_tglapp_end	: 	trawat_tgl_end_app_search,
			trawat_rawat	:	trawat_rawat_search,
			trawat_terapis	:	trawat_terapis_search,
			trawat_status	:	trawat_status_search 
		};
		// Cause the datastore to do another query : 
		tindakan_nonmedis_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function tindakan_nonmedis_reset_search(){
		// reset the store parameters
		tindakan_nonmedis_DataStore.baseParams = { task: 'LIST',start:0,limit:pageS };
		// Cause the datastore to do another query : 
		tindakan_nonmedis_DataStore.reload({params: {start: 0, limit: pageS}});
		tindakan_nonmedis_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  trawat_id Search Field */
	trawat_nonmedis_idSearchField= new Ext.form.NumberField({
		id: 'trawat_nonmedis_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  trawat_cust Search Field */
	trawat_nonmedis_custSearchField= new Ext.form.ComboBox({
		//id: 'trawat_medis_custField',
		fieldLabel: 'Customer',
		store: cbo_tnonmedis_cutomerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_tnonmedis_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		anchor: '95%'
	});
	trawat_nonmedis_rawatSearchField= new Ext.form.ComboBox({
		fieldLabel: 'Perawatan',
		store: trawat_nonmedis_perawatanDataStore,
		mode: 'remote',
		displayField:'perawatan_display',
		valueField: 'perawatan_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: cbo_trawat_rawat_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		width: 214
	});
	trawat_nonmedis_terapisSearchField= new Ext.form.ComboBox({
		fieldLabel: 'Terapis',
		store: dtrawat_karyawanDataStore,
		mode: 'remote',
		displayField:'karyawan_username',
		valueField: 'karyawan_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: karyawan_terapis_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		width: 214
	});
	trawat_nonmedis_statusSearchField= new Ext.form.ComboBox({
		fieldLabel: 'Status',
		store: new Ext.data.SimpleStore({
			fields:['dtrawat_status_value', 'dtrawat_status_display'],
			data: [['batal','batal'],['selesai','selesai'],['datang','datang']]
			}),
		mode: 'local',
		displayField:'dtrawat_status_display',
		valueField: 'dtrawat_status_value',
        typeAhead: false,
        hideTrigger:false,
        //applyTo: 'search',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		width: 94
	});
	/* Identify  trawat_keterangan Search Field */
	trawat_nonmedis_keteranganSearchField= new Ext.form.TextArea({
		id: 'trawat_nonmedis_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	tindakan_nonmedis_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 540,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [trawat_nonmedis_custSearchField,
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
									fieldLabel: 'Tanggal Appointment',
							        name: 'trawat_nonmedis_tglStartAppSearchField',
							        id: 'trawat_nonmedis_tglStartAppSearchField',
							        vtype: 'daterange',
							        endDateField: 'trawat_nonmedis_tglEndAppSearchField' // id of the end date field
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
							        name: 'trawat_nonmedis_tglEndAppSearchField',
							        id: 'trawat_nonmedis_tglEndAppSearchField',
							        vtype: 'daterange',
							        startDateField: 'trawat_nonmedis_tglStartAppSearchField' // id of the end date field
							    }] 
						}]},
						trawat_nonmedis_rawatSearchField,trawat_nonmedis_terapisSearchField,trawat_nonmedis_statusSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: tindakan_nonmedis_list_search
			},{
				text: 'Close',
				handler: function(){
					tindakan_nonmedis_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	function tindakan_nonmedis_reset_formSearch(){
		trawat_nonmedis_idSearchField.reset();
		trawat_nonmedis_idSearchField.setValue(null);
		trawat_nonmedis_custSearchField.reset();
		trawat_nonmedis_custSearchField.setValue(null);
		trawat_nonmedis_keteranganSearchField.reset();
		trawat_nonmedis_keteranganSearchField.setValue(null);
		Ext.getCmp('trawat_nonmedis_tglStartAppSearchField').reset();
		Ext.getCmp('trawat_nonmedis_tglStartAppSearchField').setValue(null);
		Ext.getCmp('trawat_nonmedis_tglEndAppSearchField').reset();
		Ext.getCmp('trawat_nonmedis_tglEndAppSearchField').setValue(null);
	}
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	tindakan_nonmedis_searchWindow = new Ext.Window({
		title: 'tindakan_nonmedis Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_tindakan_nonmedis_search',
		items: tindakan_nonmedis_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!tindakan_nonmedis_searchWindow.isVisible()){
			tindakan_nonmedis_reset_formSearch();
			tindakan_nonmedis_searchWindow.show();
		} else {
			tindakan_nonmedis_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function tindakan_nonmedis_print(){
		var searchquery = "";
		var trawat_cust_print=null;
		var trawat_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(tindakan_nonmedis_DataStore.baseParams.query!==null){searchquery = tindakan_nonmedis_DataStore.baseParams.query;}
		if(tindakan_nonmedis_DataStore.baseParams.trawat_cust!==null){trawat_cust_print = tindakan_nonmedis_DataStore.baseParams.trawat_cust;}
		if(tindakan_nonmedis_DataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_print = tindakan_nonmedis_DataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_tindakan_nonmedis&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_print,
			trawat_keterangan : trawat_keterangan_print,
		  	currentlisting: tindakan_nonmedis_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./tindakan_nonmedislist.html','tindakan_nonmedislist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function tindakan_nonmedis_export_excel(){
		var searchquery = "";
		var trawat_cust_2excel=null;
		var trawat_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(tindakan_nonmedis_DataStore.baseParams.query!==null){searchquery = tindakan_nonmedis_DataStore.baseParams.query;}
		if(tindakan_nonmedis_DataStore.baseParams.trawat_cust!==null){trawat_cust_2excel = tindakan_nonmedis_DataStore.baseParams.trawat_cust;}
		if(tindakan_nonmedis_DataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_2excel = tindakan_nonmedis_DataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_tindakan_nonmedis&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_2excel,
			trawat_keterangan : trawat_keterangan_2excel,
		  	currentlisting: tindakan_nonmedis_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_tindakan_nonmedis"></div>
         <div id="fp_tindakan_nonmedis_detail"></div>
		<div id="elwindow_tindakan_nonmedis_create"></div>
        <div id="elwindow_tindakan_nonmedis_search"></div>
    </div>
</div>
</body>