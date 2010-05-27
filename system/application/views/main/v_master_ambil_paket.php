<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: ambil_paket View
	+ Description	: For record view
	+ Filename 		: v_ambil_paket.php
 	+ Author  		: masongbee
 	+ Created on 28/Jan/2010 10:41:22
	
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
var ambil_paket_DataStore;
var ambil_paket_ColumnModel;
var ambil_paketListEditorGrid;
var ambil_paket_createForm;
var ambil_paket_createWindow;
var ambil_paket_searchForm;
var ambil_paket_searchWindow;
var ambil_paket_SelectedRow;
var ambil_paket_ContextMenu;
//for detail data
var ambil_paket_isi_perawatan_DataStor;
var ambil_paket_isi_perawatanListEditorGrid;
var ambil_paket_isi_perawatan_ColumnModel;
var ambil_paket_isi_perawatan_proxy;
var ambil_paket_isi_perawatan_writer;
var ambil_paket_isi_perawatan_reader;
var editor_ambil_paket_isi_perawatan;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var apaket_paketField;
var apaket_paket_kodeField;
var apaket_paket_namaField;
var apaket_kadaluarsaField;
var apaket_fakturSearchField;
var apaket_custSearchField;
var apaket_paketSearchField;
var apaket_kadaluarsaSearchField;
var apaket_kadaluarsa_akhirSearchField;
var apaket_tgl_fakturSearchField;
var apaket_tgl_faktur_akhirSearchField;
var apaket_sisaSearchField;

var dt = new Date();

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
  
  	/* Function for Saving inLine Editing */
	function ambil_paket_update(oGrid_event){
		var ambil_paket_id_update_pk="";
		var ambil_paket_kode_update=null;
		var ambil_paket_nama_update=null;
		var ambil_paket_expired_update=null;

		ambil_paket_id_update_pk = oGrid_event.record.data.ambil_paket_id;
		if(oGrid_event.record.data.ambil_paket_kode!== null){ambil_paket_kode_update = oGrid_event.record.data.ambil_paket_kode;}
		if(oGrid_event.record.data.ambil_paket_nama!== null){ambil_paket_nama_update = oGrid_event.record.data.ambil_paket_nama;}
		if(oGrid_event.record.data.ambil_paket_expired!== null){ambil_paket_expired_update = oGrid_event.record.data.ambil_paket_expired;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_ambil_paket&m=get_action',
			params: {
				task: "UPDATE",
				ambil_paket_id	: ambil_paket_id_update_pk, 
				ambil_paket_kode	:ambil_paket_kode_update,  
				ambil_paket_nama	:ambil_paket_nama_update,  
				ambil_paket_expired	:ambil_paket_expired_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						ambil_paket_DataStore.commitChanges();
						ambil_paket_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the ambil_paket.',
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
	function ambil_paket_create(){
	
		if(is_ambil_paket_form_valid()){	
		var ambil_paket_id_create=null; 
		var ambil_paket_kode_create=null; 
		var ambil_paket_nama_create=null; 
		var ambil_paket_expired_create=null; 

		if(apaket_paketField.getValue()!== null){ambil_paket_id_create = apaket_paketField.getValue();}else{ambil_paket_id_create_pk=get_pk_id();} 
		if(apaket_paket_kodeField.getValue()!== null){ambil_paket_kode_create = apaket_paket_kodeField.getValue();} 
		if(apaket_paket_namaField.getValue()!== null){ambil_paket_nama_create = apaket_paket_namaField.getValue();} 
		if(apaket_kadaluarsaField.getValue()!== null){ambil_paket_expired_create = apaket_kadaluarsaField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_ambil_paket&m=get_action',
			params: {
				task: post2db,
				ambil_paket_id	: ambil_paket_id_create, 
				ambil_paket_kode	: ambil_paket_kode_create, 
				ambil_paket_nama	: ambil_paket_nama_create, 
				ambil_paket_expired	: ambil_paket_expired_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						//ambil_paket_isi_perawatan_purge()
						ambil_paket_isi_perawatan_insert();
						//Ext.MessageBox.alert(post2db+' OK','The Paket was '+msg+' successfully.');
						
						ambil_paket_DataStore.baseParams = { task: 'LIST' };
						ambil_paket_DataStore.reload({params: {start: 0, limit: pageS}});
						
						//ambil_paket_DataStore.reload();
						detail_ambil_paketStore.reload();
						ambil_paket_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Paket.',
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
			return ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_id');
		else if(post2db=='CREATE')
			return apaket_paketField.getValue();
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function ambil_paket_reset_form(){
		apaket_paketField.reset();
		apaket_paketField.setValue(null);
		apaket_paket_kodeField.reset();
		apaket_paket_kodeField.setValue(null);
		apaket_paket_namaField.reset();
		apaket_paket_namaField.setValue(null);
		apaket_kadaluarsaField.reset();
		apaket_kadaluarsaField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function ambil_paket_set_form(){
		//apaket_idField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_id'));
		//apaket_paketField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_paket'));
		apaket_paketField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_paket'));
//		apaket_cust_noField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_cust_no'));
//		apaket_cust_namaField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_cust_nama'));
		apaket_cust_noField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('cust_no'));
		apaket_cust_namaField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('cust_nama'));
		//apaket_fakturField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_faktur'));
		apaket_fakturField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_nobukti'));
		//apaket_faktur_tanggalField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_faktur_tanggal'));
		apaket_faktur_tanggalField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_tanggal'));
//		apaket_paket_kodeField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_paket_kode'));
//		apaket_paket_namaField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_paket_nama'));
		apaket_paket_kodeField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('paket_kode'));
		apaket_paket_namaField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('paket_nama'));
		//apaket_kadaluarsaField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_kadaluarsa'));
		apaket_kadaluarsaField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_kadaluarsa'));
		//apaket_paket_sisaField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_sisa_paket'));
		apaket_paket_sisaField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_sisa_paket'));
		apaket_jpaketField.setValue(ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_master'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_ambil_paket_form_valid(){
		return (true &&  apaket_paket_kodeField.isValid() && apaket_paket_namaField.isValid() && apaket_kadaluarsaField.isValid() );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!ambil_paket_createWindow.isVisible()){
			ambil_paket_reset_form();
			post2db='CREATE';
			msg='created';
			ambil_paket_createWindow.show();
		} else {
			ambil_paket_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function ambil_paket_confirm_delete(){
		// only one ambil_paket is selected here
		if(ambil_paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', ambil_paket_delete);
		} else if(ambil_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', ambil_paket_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
//				msg: 'You can\'t really delete something you haven\'t selected?',
				msg: 'Anda belum memilih data yang akan diedit',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
	/* Function for Update Confirm */
	function ambil_paket_confirm_update(){
		//ambil_paket_isi_perawatan_DataStore.removeAll();
		ambil_paket_isi_perawatan_DataStore.load({params: {master_id:0, start:0, limit:pageS}});
		//cbo_paket_isi_rawatDataStore.load({params:{master_id:0}});
		/* only one record is selected here */
		if(ambil_paketListEditorGrid.selModel.getCount() == 1) {
			ambil_paket_set_form();
			//cbo_paket_isi_rawatDataStore.load({params:{master_id:ambil_paketListEditorGrid.getSelectionModel().getSelected().get('apaket_id')}});
			cbo_paket_isi_rawatDataStore.load({params:{dapaket_dpaket:ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_id'),dapaket_jpaket:ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_master'),dapaket_paket:ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_paket')}});
			cbo_ambil_paket_custDataStore.load({params:{dpaket_master:ambil_paketListEditorGrid.getSelectionModel().getSelected().get('dpaket_master')}});
			//cbo_paket_isi_rawatDataStore.load({params:{master_id:0}});
			post2db='UPDATE';
			//ambil_paket_isi_perawatan_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			ambil_paket_createWindow.show();
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
	function ambil_paket_delete(btn){
		if(btn=='yes'){
			var selections = ambil_paketListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< ambil_paketListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.ambil_paket_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_ambil_paket&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							ambil_paket_DataStore.reload();
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
	ambil_paket_DataStore = new Ext.data.Store({
		id: 'ambil_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'apaket_id'
		},[
		/* dataIndex => insert intoambil_paket_ColumnModel, Mapping => for initiate table column */ 
			//{name: 'apaket_id', type: 'int', mapping: 'apaket_id'},
			//{name: 'apaket_jpaket', type: 'int', mapping: 'apaket_jpaket'},
			//{name: 'apaket_faktur', type: 'string', mapping: 'apaket_faktur'}, 
			{name: 'jpaket_nobukti', type: 'string', mapping: 'jpaket_nobukti'}, 
			//{name: 'apaket_faktur_tanggal', type: 'date', dateFormat:'Y-m-d', mapping: 'apaket_faktur_tanggal'}, 	// by hendri
			{name: 'jpaket_tanggal', type: 'date', dateFormat:'Y-m-d', mapping: 'jpaket_tanggal'},
			//{name: 'apaket_kadaluarsa', type: 'date', dateFormat:'Y-m-d', mapping: 'apaket_kadaluarsa'}, 
			{name: 'dpaket_kadaluarsa', type: 'date', dateFormat:'Y-m-d', mapping: 'dpaket_kadaluarsa'}, 
			//{name: 'apaket_cust', type: 'int', mapping: 'apaket_cust'}, 
//			{name: 'apaket_cust_no', type: 'string', mapping: 'apaket_cust_no'}, 
//			{name: 'apaket_cust_nama', type: 'string', mapping: 'apaket_cust_nama'}, 
			{name: 'cust_no', type: 'string', mapping: 'cust_no'}, 
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'}, 
			//{name: 'apaket_paket', type: 'int', mapping: 'apaket_paket'},
//			{name: 'apaket_paket_kode', type: 'string', mapping: 'apaket_paket_kode'},
//			{name: 'apaket_paket_nama', type: 'string', mapping: 'apaket_paket_nama'},
			{name: 'paket_kode', type: 'string', mapping: 'paket_kode'},
			{name: 'paket_nama', type: 'string', mapping: 'paket_nama'},
			//{name: 'apaket_paket_jumlah', type: 'int', mapping: 'apaket_paket_jumlah'},
			//{name: 'apaket_sisa_paket', type: 'int', mapping: 'apaket_sisa_paket'}
			{name: 'dpaket_id', type: 'int', mapping: 'dpaket_id'},
			{name: 'dpaket_sisa_paket', type: 'int', mapping: 'dpaket_sisa_paket'},
			{name: 'dpaket_master', type: 'int', mapping: 'dpaket_master'},
			{name: 'dpaket_paket', type: 'int', mapping: 'dpaket_paket'}
		])//,
//		sortInfo:{field: 'apaket_paket_nama', direction: "ASC"}
//		sortInfo:{field: 'paket_nama', direction: "ASC"}
	});
	/* End of Function */
	
	cbo_paket_isi_rawatDataStore = new Ext.data.Store({
		id: 'cbo_paket_isi_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=get_isi_rawat_list', 
			method: 'POST'
		}),
		baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			//{name: 'isi_rawat_value', type: 'int', mapping: 'apaket_id'},
			{name: 'isi_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'isi_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'isi_rawat_display', type: 'string', mapping: 'rawat_nama'},
			{name: 'total_sisa_item', type: 'int', mapping: 'apaket_sisa_item'}
		]),
		sortInfo:{field: 'isi_rawat_display', direction: "ASC"}
	});
	var isi_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{isi_rawat_kode}| <b>{isi_rawat_display}</b>| Sisa: <b>{total_sisa_item}</b>',
		'</div></tpl>'
    );
	
	cbo_ambil_paket_custDataStore = new Ext.data.Store({
		id: 'cbo_ambil_paket_custDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=get_pengguna_paket_list', 
			method: 'POST'
		}),
		//baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'sjpaket_id'
		},[
			{name: 'pengguna_paket_value', type: 'int', mapping: 'cust_id'},
			{name: 'pengguna_paket_display', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'},
			{name: 'jpaket_cust', type: 'int', mapping: 'jpaket_cust'}
		]),
		sortInfo:{field: 'jpaket_cust', direction: "DESC"}
	});
	var cust_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {pengguna_paket_display}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	cbo_custDataStore = new Ext.data.Store({
		id: 'cbo_custDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=get_customer_list', 
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
	var customer_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	cbo_paketDataStore = new Ext.data.Store({
		id: 'cbo_paketDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=get_paket_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'paket_id'
		},[
			{name: 'paket_value', type: 'int', mapping: 'paket_id'},
			{name: 'paket_kode', type: 'string', mapping: 'paket_kode'},
			{name: 'paket_display', type: 'string', mapping: 'paket_nama'}
		]),
		sortInfo:{field: 'paket_display', direction: "ASC"}
	});
	var paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{paket_kode}</b>| {paket_display}<br/></span>',
		'</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	ambil_paket_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'No Cust' + '</div>',
//			dataIndex: 'apaket_cust_no',
			dataIndex: 'cust_no',
			width: 80,	//230,
			sortable: true
		}, 
		{
			header: '<div align="center">' + 'Customer' + '</div>',
//			dataIndex: 'apaket_cust_nama',
			dataIndex: 'cust_nama',
			width: 200,	//230,
			sortable: true
		}, 
		/*{
			header: '<div align="center">' + 'Tgl Faktur' + '</div>',
			dataIndex: 'apaket_faktur_tanggal',
			width: 70,
			sortable: true,
//			renderer: Ext.util.Format.dateRenderer('Y-m-d')
			renderer: Ext.util.Format.dateRenderer('d-m-Y')
		}, */
		{
			header: '<div align="center">' + 'Tgl Faktur' + '</div>',
			dataIndex: 'jpaket_tanggal',
			width: 70,
			sortable: true,
//			renderer: Ext.util.Format.dateRenderer('Y-m-d')
			renderer: Ext.util.Format.dateRenderer('d-m-Y')
		}, 
		/*{
			header: '<div align="center">' + 'No Faktur' + '</div>',
			dataIndex: 'apaket_faktur',
			width: 80,
			sortable: true
		}, */
		{
			header: '<div align="center">' + 'No Faktur' + '</div>',
			dataIndex: 'jpaket_nobukti',
			width: 80,
			sortable: true
		}, 
		{
			header: '<div align="center">' + 'Kode Paket' + '</div>',
//			dataIndex: 'apaket_paket_kode',
			dataIndex: 'paket_kode',
			width: 80,	//230,
			sortable: true
		}, 
		{
			header: '<div align="center">' + 'Nama Paket' + '</div>',
//			dataIndex: 'apaket_paket_nama',
			dataIndex: 'paket_nama',
			width: 200,	//230,
			sortable: true
		}, 
		/*{
			header: '<div align="center">' + 'Sisa' + '</div>',
			dataIndex: 'apaket_sisa_paket',
			width: 60,	//90,
			renderer: function(value, cell, record){
				return '<div align="right">' + value + '</div>';
			}
		},*/
		{
			header: '<div align="center">' + 'Sisa' + '</div>',
			dataIndex: 'dpaket_sisa_paket',
			width: 60,	//90,
			renderer: function(value, cell, record){
				return '<div align="right">' + value + '</div>';
			}
		},
		/*{
			header: '<div align="center">' + 'Tgl Exp' + '</div>',
			dataIndex: 'apaket_kadaluarsa',
			width: 70,
			sortable: true,
//			renderer: Ext.util.Format.dateRenderer('Y-m-d')
			renderer: Ext.util.Format.dateRenderer('d-m-Y')
		} */
		{
			header: '<div align="center">' + 'Tgl Kadaluarsa' + '</div>',
			dataIndex: 'dpaket_kadaluarsa',
			width: 70,
			sortable: true,
//			renderer: Ext.util.Format.dateRenderer('Y-m-d')
			renderer: Ext.util.Format.dateRenderer('d-m-Y')
		} 
		]
	);
	
	ambil_paket_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	ambil_paketListEditorGrid =  new Ext.grid.GridPanel({
		id: 'ambil_paketListEditorGrid',
		el: 'fp_ambil_paket',
//		title: 'List Of Paket',
		title: 'Daftar Kepemilikan Paket',
		autoHeight: true,
		store: ambil_paket_DataStore, // DataStore
		cm: ambil_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
		/*view: new Ext.grid.GroupingView({
            forceFit:true,
            groupTextTpl: '{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})'
        }),*/
	  	width: 1220,	//940,	//800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: ambil_paket_DataStore,
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
			text: 'Ambil Paket',
			tooltip: 'Pengambilan Isi Paket',
			iconCls:'icon-update',
			handler: ambil_paket_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled:true,
			handler: ambil_paket_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Adv Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: ambil_paket_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						ambil_paket_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search by (khusus belum kadaluarsa):'});
				Ext.get(this.id).set({qtip:' - No Customer<br> - Nama Customer<br> - Kode Paket<br> - Nama Paket'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: ambil_paket_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: ambil_paket_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: ambil_paket_print  
		}
		]
	});
	ambil_paketListEditorGrid.render();
	/* End of DataStore */
	
	ambil_paketListEditorGrid.on('rowclick', function (ambil_paketListEditorGrid, rowIndex, eventObj) {
        var recordMaster = ambil_paketListEditorGrid.getSelectionModel().getSelected();
        //detail_ambil_paketStore.load({params : {dpaket_master : recordMaster.get("dpaket_master"), dpaket_paket : recordMaster.get("dpaket_paket")}});
		detail_ambil_paketStore.load({params : {dapaket_dpaket : recordMaster.get("dpaket_id")}});
		//ambil_paket_DataStore.reload();
    });
     
	/* Create Context Menu */
	ambil_paket_ContextMenu = new Ext.menu.Menu({
		id: 'ambil_paket_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Ambil Paket', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: ambil_paket_editContextMenu 
		},
/*		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: ambil_paket_confirm_delete 
		},
		'-',
*/		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: ambil_paket_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: ambil_paket_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onambil_paket_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		ambil_paket_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		ambil_paket_SelectedRow=rowIndex;
		ambil_paket_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function ambil_paket_editContextMenu(){
		//ambil_paketListEditorGrid.startEditing(ambil_paket_SelectedRow,1);
		ambil_paket_confirm_update();
  	}
	/* End of Function */
  	
	ambil_paketListEditorGrid.addListener('rowcontextmenu', onambil_paket_ListEditGridContextMenu);
	ambil_paket_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	ambil_paketListEditorGrid.on('afteredit', ambil_paket_update); // inLine Editing Record
	
	apaket_idField= new Ext.form.NumberField({
		id: 'apaket_idField',
		readOnly: true,
		hidden: true,
		width: 94,
		maskRe: /([0-9]+)$/
	});
	/* Identify  apaket_cust_no Field */
	apaket_cust_noField= new Ext.form.TextField({
		id: 'apaket_cust_noField',
		fieldLabel: 'No. Customer',
		readOnly: true,
		anchor: '95%'
	});
	/* Identify  apaket_cust_nama Field */
	apaket_cust_namaField= new Ext.form.TextField({
		id: 'apaket_cust_namaField',
		fieldLabel: 'Customer',
		readOnly: true,
		anchor: '95%'
	});
	/* Identify  apaket_faktur Field */
	apaket_fakturField= new Ext.form.TextField({
		id: 'apaket_fakturField',
		fieldLabel: 'No. Faktur',
		readOnly: true,
		anchor: '95%'
	});
	/* Identify  apaket_faktur_tanggal Field */
	apaket_faktur_tanggalField= new Ext.form.DateField({
		id: 'apaket_faktur_tanggalField',
		fieldLabel: 'Tgl Faktur',
		format : 'd-m-Y',
		disabled: true
	});
	/* Identify  apaket_paket_kode Field */
	apaket_paket_kodeField= new Ext.form.TextField({
		id: 'apaket_paket_kodeField',
		fieldLabel: 'Kode',
		maxLength: 20,
		readOnly: true,
		anchor: '95%'
	});
	/* Identify  apaket_paket_nama Field */
	apaket_paket_namaField= new Ext.form.TextField({
		id: 'apaket_paket_namaField',
		fieldLabel: 'Nama',
		maxLength: 250,
		readOnly: true,
		anchor: '95%'
	});
	/* Identify  apaket_kadaluarsa Field */
	apaket_kadaluarsaField= new Ext.form.DateField({
		id: 'apaket_kadaluarsaField',
		fieldLabel: 'Tgl Expired',
		format : 'd-m-Y',
		disabled: true
	});
	apaket_paket_sisaField= new Ext.form.NumberField({
		id: 'apaket_paket_sisaField',
		fieldLabel: 'Sisa',
		readOnly: true,
		width: 94,
		maskRe: /([0-9]+)$/
	});
	apaket_paketField= new Ext.form.NumberField();
	apaket_jpaketField=new Ext.form.NumberField();
  	/*Fieldset Master*/
	ambil_paket_fakturGroup = new Ext.form.FieldSet({
		title: 'Info Faktur',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [apaket_fakturField, apaket_faktur_tanggalField, apaket_idField]
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [apaket_cust_noField, apaket_cust_namaField]
			}
			]
	
	});
	
	ambil_paket_infoPaketGroup = new Ext.form.FieldSet({
		title: 'Info Paket',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [apaket_paket_kodeField, apaket_paket_namaField]
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [apaket_kadaluarsaField, apaket_paket_sisaField]
			}
			]
	
	});
	
	/* START History Ambil Paket */
	/* Start History DataStore */
	detail_ambil_paketStore = new Ext.data.GroupingStore({
		id: 'detail_ambil_paketStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=get_history_ambil_paket', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'//,
			//id: 'app_id'
		},[
//			{name: 'apaket_faktur', type: 'string', mapping: 'apaket_faktur'},	//simplified, by hendri
//			{name: 'paket_nama', type: 'string', mapping: 'paket_nama'},		//simplified, by hendri
			{name: 'rawat_nama', type: 'string', mapping: 'rawat_nama'},
			{name: 'dapaket_jumlah', type: 'int', mapping: 'dapaket_jumlah'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'tgl_ambil', type: 'date', dateFormat: 'Y-m-d', mapping: 'tgl_ambil'}
		]),
		sortInfo:{field: 'cust_nama', direction: "ASC"}//,
//		groupField: 'apaket_faktur'	//simplified, by hendri
	});
	/* End DataStore */
	//detail_ambil_paketStore.load({params: {master_id: '0'}});
	
	/*detail_ambil_paketStore = new Ext.data.GroupingStore({
		id: 'detail_ambil_paketStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=get_history_ambil_paket', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'//,
			//id: 'app_id'
		},[
        	{name: 'jpaket_nobukti', type: 'string', mapping: 'jpaket_nobukti'},
			{name: 'paket_nama', type: 'string', mapping: 'paket_nama'},
			{name: 'rawat_nama', type: 'string', mapping: 'rawat_nama'},
			{name: 'hapaket_jumlah', type: 'int', mapping: 'hapaket_jumlah'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'}
		]),
		sortInfo:{field: 'cust_nama', direction: "ASC"},
		groupField: 'jpaket_nobukti'
	});*/
	
	detail_ambil_paketColumnModel = new Ext.grid.ColumnModel(
		[
/*		{										//simplified, by hendri
			header: 'No. Faktur',
			dataIndex: 'apaket_faktur',
			width: 80	//90
		},
		{
			header: '<div align="center">' + 'Nama Paket' + '</div>',
			dataIndex: 'paket_nama',
			width: 210
		},
*/		{
			header: '<div align="center">' + 'Tgl Ambil' + '</div>',
			dataIndex: 'tgl_ambil',
			width: 70,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y')
		}, 
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'rawat_nama',
			width: 210
		},
		{
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'dapaket_jumlah',
			width: 60,
			renderer: function(value, cell, record){
				return '<div align="right">' + value + '</div>';
			}
		},{
			header: '<div align="center">' + 'Pemakai' + '</div>',
			dataIndex: 'cust_nama',
			width: 210
		}]
    );
    detail_ambil_paketColumnModel.defaultSortable= true;
	
	var history_ambil_paketPanel = new Ext.grid.GridPanel({
		id: 'history_ambil_paketPanel',
		title: 'Daftar Pengambilan Paket',
        store: detail_ambil_paketStore,
        cm: detail_ambil_paketColumnModel,
		view: new Ext.grid.GroupingView({
            forceFit:true,
            groupTextTpl: '{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})'
        }),
        stripeRows: true,
        autoExpandColumn: 'company',
        autoHeight: true,
		style: 'margin-top: 10px',
        width: 1220	//940	//800
    });
    history_ambil_paketPanel.render('history_ambil_paket');

	/* END History Ambil Paket */
	
		
	/*Detail Declaration */
	/* START Detail Isi Perawatan */
	// Function for json reader of detail
	var ambil_paket_isi_perawatan_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rpaket_id', type: 'int', mapping: 'rpaket_id'}, 
			{name: 'rpaket_perawatan', type: 'int', mapping: 'rpaket_perawatan'}, 
			{name: 'rpaket_jumlah', type: 'int', mapping: 'rpaket_jumlah'}
	]);
	//eof
	
	//function for json writer of detail
	var ambil_paket_isi_perawatan_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	ambil_paket_isi_perawatan_DataStore = new Ext.data.Store({
		id: 'ambil_paket_isi_perawatan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=detail_ambil_paket_isi_perawatan_list', 
			method: 'POST'
		}),
		reader: ambil_paket_isi_perawatan_reader,
		params:{master_id: get_pk_id()},
		sortInfo:{field: 'rpaket_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_ambil_paket_isi_perawatan= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	var combo_paket_isi_rawat=new Ext.form.ComboBox({
			store: cbo_paket_isi_rawatDataStore,
			mode: 'local',
			displayField: 'isi_rawat_display',
			valueField: 'isi_rawat_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:15,
			//hideTrigger:false,
			tpl: isi_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			//lazyRender:true,
			allowBlank: true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var combo_cust_ambil_paket=new Ext.form.ComboBox({
			store: cbo_ambil_paket_custDataStore,
			mode: 'local',
			displayField: 'pengguna_paket_display',
			valueField: 'pengguna_paket_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:15,
			hideTrigger:false,
			tpl: cust_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			allowBlank: true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	combo_cust_ambil_paket.on('focus', function(){
		cbo_ambil_paket_custDataStore.reload();
	});
	
	//declaration of detail coloumn model
	ambil_paket_isi_perawatan_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Tgl Ambil' + '</div>',
			dataIndex: 'tgl_ambil',
			width: 70,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'})
		}, 
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'rpaket_perawatan',
			width: 200,	//150,
			sortable: true,
			editor: combo_paket_isi_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_paket_isi_rawat)
		},
		{
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'rpaket_jumlah',
			align: 'right',
			width: 60,	//80,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: '<div align="center">' + 'Pemakai' + '</div>',
			dataIndex: 'rpaket_cust',
			width: 200,	//150,
			sortable: true,
			editor: combo_cust_ambil_paket,
			renderer: Ext.util.Format.comboRenderer(combo_cust_ambil_paket)
		}]
	);
	ambil_paket_isi_perawatan_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	ambil_paket_isi_perawatanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'ambil_paket_isi_perawatanListEditorGrid',
		el: 'fp_ambil_paket_isi_perawatan',
		title: 'Ambil Paket Perawatan',
		height: 250,
		width: 690,
		autoScroll: true,
		store: ambil_paket_isi_perawatan_DataStore, // DataStore
		colModel: ambil_paket_isi_perawatan_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_ambil_paket_isi_perawatan],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: ambil_paket_isi_perawatan_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: ambil_paket_isi_perawatan_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: ambil_paket_isi_perawatan_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function ambil_paket_isi_perawatan_add(){
		var edit_ambil_paket_isi_perawatan= new ambil_paket_isi_perawatanListEditorGrid.store.recordType({
			tgl_ambil		: dt.dateFormat('Y-m-d'),
			rpaket_perawatan: '',		
			rpaket_jumlah	: '',		
			rpaket_cust		: ''
		});
		editor_ambil_paket_isi_perawatan.stopEditing();
		ambil_paket_isi_perawatan_DataStore.insert(0, edit_ambil_paket_isi_perawatan);
		ambil_paket_isi_perawatanListEditorGrid.getView().refresh();
		ambil_paket_isi_perawatanListEditorGrid.getSelectionModel().selectRow(0);
		editor_ambil_paket_isi_perawatan.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_ambil_paket_isi_perawatan(){
		//ambil_paket_isi_perawatan_DataStore.commitChanges();
		//ambil_paket_isi_perawatanListEditorGrid.getView().refresh();
		/* SET pemakai Paket */
		/*if(ambil_paket_isi_perawatan_DataStore.getCount()>0){
			ambil_paket_isi_perawatan_record=ambil_paket_isi_perawatan_DataStore.getAt(0);
		}*/
	}
	//eof
	
	//function for insert detail
	function ambil_paket_isi_perawatan_insert(){
		var count_detail=ambil_paket_isi_perawatan_DataStore.getCount();
		for(i=0;i<ambil_paket_isi_perawatan_DataStore.getCount();i++){
			var count_i = i;
			ambil_paket_isi_perawatan_record=ambil_paket_isi_perawatan_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_ambil_paket&m=detail_ambil_paket_isi_perawatan_insert',
				params:{
				//dapaket_master	: eval(apaket_idField.getValue()), 
				dapaket_dpaket	: eval(get_pk_id()), 
				dapaket_jpaket	: eval(apaket_jpaketField.getValue()),
				dapaket_paket	: eval(apaket_paketField.getValue()),
				dapaket_item	: ambil_paket_isi_perawatan_record.data.rpaket_perawatan,
				//dapaket_sapaket	: ambil_paket_isi_perawatan_record.data.rpaket_perawatan, 
				dapaket_jumlah	: ambil_paket_isi_perawatan_record.data.rpaket_jumlah,
				dapaket_cust	: ambil_paket_isi_perawatan_record.data.rpaket_cust,
				tgl_ambil		: ambil_paket_isi_perawatan_record.data.tgl_ambil.format('Y-m-d'),
				count	: count_i,
				dcount	: count_detail
				
				},
				success: function(response){							
					var result=eval(response.responseText);
					if(result==0){
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Isi paket tidak mencukupi untuk diambil.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
					}else if(result=='-1'){
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Customer tidak memiliki paket.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
					}else if(result=='1'){
						Ext.MessageBox.alert('OK','Paket telah selesai diambil.');
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
	//eof
	
	//function for insert detail
	/*function ambil_paket_isi_perawatan_insert(){
		for(i=0;i<ambil_paket_isi_perawatan_DataStore.getCount();i++){
			ambil_paket_isi_perawatan_record=ambil_paket_isi_perawatan_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_ambil_paket&m=detail_ambil_paket_isi_perawatan_insert',
				params:{
				hapaket_dpaket	: eval(apaket_paketField.getValue()), 
				hapaket_rawat	: ambil_paket_isi_perawatan_record.data.rpaket_perawatan, 
				hapaket_jumlah	: ambil_paket_isi_perawatan_record.data.rpaket_jumlah,
				hapaket_cust	: ambil_paket_isi_perawatan_record.data.rpaket_cust
				
				}
			});
		}
	}*/
	//eof
	
	//function for purge detail
	function ambil_paket_isi_perawatan_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_ambil_paket&m=detail_ambil_paket_isi_perawatan_purge',
			params:{ master_id: eval(apaket_paketField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function ambil_paket_isi_perawatan_confirm_delete(){
		// only one record is selected here
		if(ambil_paket_isi_perawatanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', ambil_paket_isi_perawatan_delete);
		} else if(ambil_paket_isi_perawatanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', ambil_paket_isi_perawatan_delete);
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
	
	//function for Delete of detail
	function ambil_paket_isi_perawatan_delete(btn){
		if(btn=='yes'){
			var s = ambil_paket_isi_perawatanListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				ambil_paket_isi_perawatan_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	ambil_paket_isi_perawatan_DataStore.on('update', refresh_ambil_paket_isi_perawatan);
	/* END Detail Isi Perawatan */
	
	/* START Detail Isi Produk */
	// Function for json reader of detail
	var ambil_paket_isi_produk_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoproduk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'ipaket_id', type: 'int', mapping: 'ipaket_id'}, 
			{name: 'ipaket_perawatan', type: 'int', mapping: 'ipaket_perawatan'}, 
			{name: 'ipaket_jumlah', type: 'int', mapping: 'ipaket_jumlah'} 
	]);
	//eof
	
	//function for json writer of detail
	var ambil_paket_isi_produk_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	ambil_paket_isi_produk_DataStore = new Ext.data.Store({
		id: 'ambil_paket_isi_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_ambil_paket&m=detail_ambil_paket_isi_produk_list', 
			method: 'POST'
		}),
		reader: ambil_paket_isi_produk_reader,
		baseParams:{master_id: apaket_paketField.getValue()},
		sortInfo:{field: 'ipaket_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_ambil_paket_isi_produk= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	ambil_paket_isi_produk_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Perawatan',
			dataIndex: 'rambil_paket_perawatan',
			width: 150,
			sortable: true,
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
			header: 'Jumlah',
			dataIndex: 'rambil_paket_jumlah',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	ambil_paket_isi_produk_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	ambil_paket_isi_produkListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'ambil_paket_isi_produkListEditorGrid',
		el: 'fp_ambil_paket_isi_produk',
		title: 'Ambil Paket Produk',
		height: 250,
		width: 690,
		autoScroll: true,
		store: ambil_paket_isi_produk_DataStore, // DataStore
		colModel: ambil_paket_isi_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_ambil_paket_isi_produk],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: ambil_paket_isi_produk_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: ambil_paket_isi_produk_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: ambil_paket_isi_produk_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function ambil_paket_isi_produk_add(){
		var edit_ambil_paket_isi_produk= new ambil_paket_isi_produkListEditorGrid.store.recordType({
			rambil_paket_id	:'',		
			rambil_paket_master	:'',		
			rambil_paket_perawatan	:'',		
			rambil_paket_jumlah	:''		
		});
		editor_ambil_paket_isi_produk.stopEditing();
		ambil_paket_isi_produk_DataStore.insert(0, edit_ambil_paket_isi_produk);
		ambil_paket_isi_produkListEditorGrid.getView().refresh();
		ambil_paket_isi_produkListEditorGrid.getSelectionModel().selectRow(0);
		editor_ambil_paket_isi_produk.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_ambil_paket_isi_produk(){
		ambil_paket_isi_produk_DataStore.commitChanges();
		ambil_paket_isi_produkListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function ambil_paket_isi_produk_insert(){
		for(i=0;i<ambil_paket_isi_produk_DataStore.getCount();i++){
			ambil_paket_isi_produk_record=ambil_paket_isi_produk_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_ambil_paket&m=detail_ambil_paket_isi_produk_insert',
				params:{
				rambil_paket_id	: ambil_paket_isi_produk_record.data.rambil_paket_id, 
				rambil_paket_master	: eval(apaket_paketField.getValue()), 
				rambil_paket_perawatan	: ambil_paket_isi_produk_record.data.rambil_paket_perawatan, 
				rambil_paket_jumlah	: ambil_paket_isi_produk_record.data.rambil_paket_jumlah 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function ambil_paket_isi_produk_purge(){
		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_ambil_paket&m=detail_ambil_paket_isi_produk_purge',
			params:{ master_id: eval(apaket_paketField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function ambil_paket_isi_produk_confirm_delete(){
		// only one record is selected here
		if(ambil_paket_isi_produkListEditorGrid.selModel.getCount() == 1){
//			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', ambil_paket_isi_produk_delete);
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', ambil_paket_isi_produk_delete);
		} else if(ambil_paket_isi_produkListEditorGrid.selModel.getCount() > 1){
//			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', ambil_paket_isi_produk_delete);
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', ambil_paket_isi_produk_delete);
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
	
	//function for Delete of detail
	function ambil_paket_isi_produk_delete(btn){
		if(btn=='yes'){
			var s = ambil_paket_isi_produkListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				ambil_paket_isi_produk_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	ambil_paket_isi_produk_DataStore.on('update', refresh_ambil_paket_isi_produk);
	/* END Detail Isi Produk */
	
	var detail_tab_isi = new Ext.TabPanel({
		activeTab: 0,
		items: [ambil_paket_isi_perawatanListEditorGrid,ambil_paket_isi_produkListEditorGrid]
	});
	
	/* Function for retrieve create Window Panel*/ 
	ambil_paket_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [ambil_paket_fakturGroup,ambil_paket_infoPaketGroup,detail_tab_isi]
		,
		buttons: [{
				text: 'Save and Close',
				handler: ambil_paket_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					ambil_paket_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	ambil_paket_createWindow= new Ext.Window({
		id: 'ambil_paket_createWindow',
		title: post2db+'Paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_ambil_paket_create',
		items: ambil_paket_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function ambil_paket_list_search(){
		// render according to a SQL date format.
		var apaket_faktur_search=null;
		var apaket_cust_search=null;
		var apaket_paket_search=null;
		var apaket_kadaluarsa_search=null;
		var apaket_kadaluarsa_akhir_search=null;
		var apakaet_sisa_search=null;
		var apaket_tgl_faktur_search=null;
		var apaket_tgl_faktur_akhir_search=null;

		if(apaket_fakturSearchField.getValue()!==null){apaket_faktur_search=apaket_fakturSearchField.getValue();}
		if(apaket_custSearchField.getValue()!==null){apaket_cust_search=apaket_custSearchField.getValue();}
		if(apaket_paketSearchField.getValue()!==null){apaket_paket_search=apaket_paketSearchField.getValue();}
		if(apaket_sisaSearchField.getValue()!==null){apaket_sisa_search=apaket_sisaSearchField.getValue();}
		if(apaket_kadaluarsaSearchField.getValue()!==""){apaket_kadaluarsa_search=apaket_kadaluarsaSearchField.getValue().format('Y-m-d');}
		if(apaket_kadaluarsa_akhirSearchField.getValue()!==""){apaket_kadaluarsa_akhir_search=apaket_kadaluarsa_akhirSearchField.getValue().format('Y-m-d');}
		if(apaket_tgl_fakturSearchField.getValue()!==""){apaket_tgl_faktur_search=apaket_tgl_fakturSearchField.getValue().format('Y-m-d');}
		if(apaket_tgl_faktur_akhirSearchField.getValue()!==""){apaket_tgl_faktur_akhir_search=apaket_tgl_faktur_akhirSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		ambil_paket_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			apaket_faktur			:	apaket_faktur_search, 
			apaket_cust				:	apaket_cust_search, 
			apaket_paket			:	apaket_paket_search, 
			apaket_kadaluarsa		:	apaket_kadaluarsa_search,
			apaket_kadaluarsa_akhir	:	apaket_kadaluarsa_akhir_search,
			apaket_tgl_faktur		:	apaket_tgl_faktur_search,
			apaket_tgl_faktur_akhir	:	apaket_tgl_faktur_akhir_search,
			apaket_sisa				:	apaket_sisa_search,
		};
		// Cause the datastore to do another query : 
		ambil_paket_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function ambil_paket_reset_search(){
		// reset the store parameters
		ambil_paket_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		ambil_paket_DataStore.reload({params: {start: 0, limit: pageS}});
		ambil_paket_searchWindow.close();
		detail_ambil_paketStore.reload();
	};
	/* End of Fuction */
	
	function ambil_paket_reset_SearchForm(){
		apaket_fakturSearchField.reset();
		apaket_custSearchField.reset();
		apaket_paketSearchField.reset();
		apaket_sisaSearchField.reset();
		apaket_kadaluarsaSearchField.reset();
		apaket_kadaluarsa_akhirSearchField.reset();
		apaket_tgl_fakturSearchField.reset();
		apaket_tgl_faktur_akhirSearchField.reset();
	}
	
	/* Field for search */
	/* Identify  ambil_paket_id Search Field */
	apaket_fakturSearchField= new Ext.form.TextField({
		id: 'apaket_fakturSearchField',
		fieldLabel: 'No Faktur',
		maxLength: 20,
		anchor: '95%'
	});
	/* Identify  ambil_paket_kode Search Field */
	apaket_custSearchField= new Ext.form.ComboBox({
		id: 'apaket_custSearchField',
		fieldLabel: 'Customer',
		store: cbo_custDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  ambil_paket_nama Search Field */
	apaket_paketSearchField= new Ext.form.ComboBox({
		id: 'apaket_paketSearchField',
		fieldLabel: 'Paket',
		store: cbo_paketDataStore,
		mode: 'remote',
		typeAhead: true,
		displayField: 'paket_display',
		valueField: 'paket_value',
		typeAhead: false,
		loadingText: 'Searching...',
		pageSize:pageS,
		hideTrigger:false,
		tpl: paket_tpl,
		//applyTo: 'search',
		itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  ambil_paket_expired Search Field */
	apaket_kadaluarsaSearchField= new Ext.form.DateField({
		id: 'apaket_kadaluarsaSearchField',
		fieldLabel: 'Tanggal Kadaluarsa',
		format : 'd-m-Y'
	});
	apaket_kadaluarsa_akhirSearchField= new Ext.form.DateField({
		id: 'apaket_kadaluarsa_akhirSearchField',
		fieldLabel: 's/d',
		format : 'd-m-Y'
	});
	apaket_tgl_fakturSearchField= new Ext.form.DateField({
		id: 'apaket_tgl_fakturSearchField',
		fieldLabel: 'Tanggal Faktur',
		format : 'd-m-Y'
	});
	apaket_tgl_faktur_akhirSearchField= new Ext.form.DateField({
		id: 'apaket_tgl_faktur_akhirSearchField',
		fieldLabel: 's/d',
		format : 'd-m-Y'
	});
	
	apaket_sisaSearchField= new Ext.form.ComboBox({
		id: 'apaket_sisaSearchField',
		fieldLabel: 'Sisa',
		store:new Ext.data.SimpleStore({
			fields:['apaket_sisa_value', 'apaket_sisa_display'],
			data:[['0','Semua'],['1','Lebih dari 0']]
		}),
		mode: 'local',
		displayField: 'apaket_sisa_display',
		valueField: 'apaket_sisa_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	
	
    
	/* Function for retrieve search Form Panel */
	ambil_paket_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		labelWidth: 120,
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
				items: [
					apaket_custSearchField, 
					{
						layout:'column',
						border:false,
						items:[
						{
							columnWidth:0.60,
							layout: 'form',
							border:false,
							defaultType: 'datefield',
							items: [						
								apaket_tgl_fakturSearchField
							]
						},
						{
							columnWidth:0.40,
							layout: 'form',
							border:false,
							labelWidth:35,
							defaultType: 'datefield',
							items: [						
								apaket_tgl_faktur_akhirSearchField
							]
						}								
						]
					},
					apaket_fakturSearchField, 
					apaket_paketSearchField,
					apaket_sisaSearchField,				
					{
						layout:'column',
						border:false,
						items:[
						{
							columnWidth:0.60,
							layout: 'form',
							border:false,
							defaultType: 'datefield',
							items: [						
								apaket_kadaluarsaSearchField
							]
						},
						{
							columnWidth:0.40,
							layout: 'form',
							border:false,
							labelWidth:35,
							defaultType: 'datefield',
							items: [						
								apaket_kadaluarsa_akhirSearchField
							]
						}								
						]
					}
				] 
			}
 			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: ambil_paket_list_search
			},{
				text: 'Close',
				handler: function(){
					ambil_paket_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	ambil_paket_searchWindow = new Ext.Window({
		title: 'Pencarian Pengambilan Paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_ambil_paket_search',
		items: ambil_paket_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!ambil_paket_searchWindow.isVisible()){
			ambil_paket_reset_SearchForm();
			ambil_paket_searchWindow.show();
		} else {
			ambil_paket_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function ambil_paket_print(){
		var searchquery = "";
		var ambil_paket_kode_print=null;
		var ambil_paket_nama_print=null;
		var ambil_paket_expired_print=null;
		var win;              
		// check if we do have some search data...
		if(ambil_paket_DataStore.baseParams.query!==null){searchquery = ambil_paket_DataStore.baseParams.query;}
		if(ambil_paket_DataStore.baseParams.ambil_paket_kode!==null){ambil_paket_kode_print = ambil_paket_DataStore.baseParams.ambil_paket_kode;}
		if(ambil_paket_DataStore.baseParams.ambil_paket_nama!==null){ambil_paket_nama_print = ambil_paket_DataStore.baseParams.ambil_paket_nama;}
		if(ambil_paket_DataStore.baseParams.ambil_paket_expired!==null){ambil_paket_expired_print = ambil_paket_DataStore.baseParams.ambil_paket_expired;}

		Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_master_ambil_paket&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			ambil_paket_kode : ambil_paket_kode_print,
			ambil_paket_nama : ambil_paket_nama_print,
			ambil_paket_expired : ambil_paket_expired_print,
		  	currentlisting: ambil_paket_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./ambil_paketlist.html','ambil_paketlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function ambil_paket_export_excel(){
		var searchquery = "";
		var ambil_paket_kode_2excel=null;
		var ambil_paket_nama_2excel=null;
		var ambil_paket_expired_2excel=null;
		var win;              
		// check if we do have some search data...
		if(ambil_paket_DataStore.baseParams.query!==null){searchquery = ambil_paket_DataStore.baseParams.query;}
		if(ambil_paket_DataStore.baseParams.ambil_paket_kode!==null){ambil_paket_kode_2excel = ambil_paket_DataStore.baseParams.ambil_paket_kode;}
		if(ambil_paket_DataStore.baseParams.ambil_paket_nama!==null){ambil_paket_nama_2excel = ambil_paket_DataStore.baseParams.ambil_paket_nama;}
		if(ambil_paket_DataStore.baseParams.ambil_paket_expired!==null){ambil_paket_expired_2excel = ambil_paket_DataStore.baseParams.ambil_paket_expired;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_ambil_paket&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			ambil_paket_kode : ambil_paket_kode_2excel,
			ambil_paket_nama : ambil_paket_nama_2excel,
			ambil_paket_expired : ambil_paket_expired_2excel,
		  	currentlisting: ambil_paket_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_ambil_paket"></div>
         <div id="fp_ambil_paket_isi_perawatan"></div>
		 <div id="fp_ambil_paket_isi_produk"></div>
		<div id="elwindow_ambil_paket_create"></div>
        <div id="elwindow_ambil_paket_search"></div>
		<div id="history_ambil_paket"></div>
    </div>
</div>
</body>