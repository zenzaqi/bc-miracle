<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: perawatan View
	+ Description	: For record view
	+ Filename 		: v_perawatan.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:26:32
	
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
var perawatan_DataStore;
var perawatan_ColumnModel;
var perawatanListEditorGrid;
var perawatan_createForm;
var perawatan_createWindow;
var perawatan_searchForm;
var perawatan_searchWindow;
var perawatan_SelectedRow;
var perawatan_ContextMenu;
//for detail data
var perawatan_konsumsi_DataStor;
var perawatan_konsumsiListEditorGrid;
var perawatan_konsumsi_ColumnModel;
var perawatan_konsumsi_proxy;
var perawatan_konsumsi_writer;
var perawatan_konsumsi_reader;
var editor_perawatan_konsumsi;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var rawat_idField;
var rawat_kodeField;
var rawat_kodelamaField;
var rawat_namaField;
var rawat_groupField;
var rawat_jenisField;
var rawat_kontribusiField;
var rawat_kategoriField;
var rawat_kategoritxtField;
var rawat_keteranganField;
var rawat_duField;
var rawat_dmField;
var rawat_pointField;
var rawat_kreditField;
var rawat_jumlah_tindakanField;
var rawat_hargaField;
var rawat_gudangField;
var rawat_aktifField;
var rawat_idSearchField;
var rawat_kodeSearchField;
var rawat_kodelamaSearchField;
var rawat_namaSearchField;
var rawat_groupSearchField;
var rawat_kategoriSearchField;
var rawat_jenisSearchField;
var rawat_keteranganSearchField;
var rawat_duSearchField;
var rawat_dmSearchField;
var rawat_pointSearchField;
var rawat_kreditSearchField;
var rawat_hargaSearchField;
var rawat_jumlah_tindakanSearchField;
var rawat_gudangSearchField;
var rawat_aktifSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function perawatan_update(oGrid_event){
		var rawat_id_update_pk="";
		var rawat_kode_update=null;
		var rawat_kodelama_update=null;
		var rawat_nama_update=null;
		var rawat_group_update=null;
		var rawat_kategori_update=null;
		var rawat_kontribusi_update=null;
		var rawat_jenis_update=null;
		var rawat_keterangan_update=null;
		var rawat_du_update=null;
		var rawat_dm_update=null;
		var rawat_point_update=null;
		var rawat_kredit_update=null;
		var rawat_jumlah_tindakan_update=null;
		var rawat_harga_update=null;
		var rawat_gudang_update=null;
		var rawat_aktif_update=null;

		rawat_id_update_pk = oGrid_event.record.data.rawat_id;
		if(oGrid_event.record.data.rawat_kode!== null){rawat_kode_update = oGrid_event.record.data.rawat_kode;}
		if(oGrid_event.record.data.rawat_kodelama!== null){rawat_kodelama_update = oGrid_event.record.data.rawat_kodelama;}
		if(oGrid_event.record.data.rawat_nama!== null){rawat_nama_update = oGrid_event.record.data.rawat_nama;}
		if(oGrid_event.record.data.rawat_group!== null){rawat_group_update = oGrid_event.record.data.rawat_group;}
		if(oGrid_event.record.data.rawat_kategori!== null){rawat_kategori_update = oGrid_event.record.data.rawat_kategori;}
		if(oGrid_event.record.data.rawat_kontribusi!== null){rawat_kontribusi_update = oGrid_event.record.data.rawat_kontribusi;}
		if(oGrid_event.record.data.rawat_jenis!== null){rawat_jenis_update = oGrid_event.record.data.rawat_jenis;}
		if(oGrid_event.record.data.rawat_keterangan!== null){rawat_keterangan_update = oGrid_event.record.data.rawat_keterangan;}
		if(oGrid_event.record.data.rawat_du!== null){rawat_du_update = oGrid_event.record.data.rawat_du;}
		if(oGrid_event.record.data.rawat_dm!== null){rawat_dm_update = oGrid_event.record.data.rawat_dm;}
		if(oGrid_event.record.data.rawat_point!== null){rawat_point_update = oGrid_event.record.data.rawat_point;}
		if(oGrid_event.record.data.rawat_kredit!== null){rawat_kredit_update = oGrid_event.record.data.rawat_kredit;}
		if(oGrid_event.record.data.rawat_harga!== null){rawat_harga_update = oGrid_event.record.data.rawat_harga;}
		if(oGrid_event.record.data.rawat_jumlah_tindakan!== null){rawat_jumlah_tindakan_update = oGrid_event.record.data.rawat_jumlah_tindakan;}
		if(oGrid_event.record.data.rawat_gudang!== null){rawat_gudang_update = oGrid_event.record.data.rawat_gudang;}
		if(oGrid_event.record.data.rawat_aktif!== null){rawat_aktif_update = oGrid_event.record.data.rawat_aktif;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_perawatan&m=get_action',
			params: {
				task: "UPDATE",
				rawat_id	: rawat_id_update_pk, 
				rawat_kode	:rawat_kode_update,  
				rawat_kodelama	:rawat_kodelama_update,  
				rawat_nama	:rawat_nama_update,  
				rawat_group	:rawat_group_update,  
				rawat_kategori	:rawat_kategori_update,
				rawat_kontribusi : rawat_kontribusi_update,
				rawat_jenis	:rawat_jenis_update,  
				rawat_keterangan	:rawat_keterangan_update,  
				rawat_du	:rawat_du_update,  
				rawat_dm	:rawat_dm_update,  
				rawat_point	:rawat_point_update,
				rawat_kredit :rawat_kredit_update,
				rawat_jumlah_tindakan : rawat_jumlah_tindakan_update,
				rawat_harga	:rawat_harga_update,  
				rawat_gudang	:rawat_gudang_update,  
				rawat_aktif	:rawat_aktif_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						perawatan_DataStore.commitChanges();
						perawatan_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the perawatan.',
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
	function perawatan_create(){
	
		if(is_perawatan_form_valid()){	
		var rawat_id_create_pk=null; 
		var rawat_kode_create=null; 
		var rawat_kodelama_create=null; 
		var rawat_nama_create=null; 
		var rawat_group_create=null; 
		var rawat_kategori_create=null; 
		var rawat_kontribusi_create=null;
		var rawat_jenis_create=null; 
		var rawat_keterangan_create=null; 
		var rawat_du_create=null; 
		var rawat_dm_create=null; 
		var rawat_point_create=null;
		var rawat_kredit_create=null;
		var rawat_jumlah_tindakan_create=null;
		var rawat_harga_create=null; 
		var rawat_gudang_create=null; 
		var rawat_aktif_create=null; 

		if(rawat_idField.getValue()!== null){rawat_id_create_pk = rawat_idField.getValue();}else{rawat_id_create_pk=get_pk_id();} 
		if(rawat_kodeField.getValue()!== null){rawat_kode_create = rawat_kodeField.getValue();} 
		if(rawat_kodelamaField.getValue()!== null){rawat_kodelama_create = rawat_kodelamaField.getValue();} 
		if(rawat_namaField.getValue()!== null){rawat_nama_create = rawat_namaField.getValue();} 
		if(rawat_groupField.getValue()!== null){rawat_group_create = rawat_groupField.getValue();} 
		if(rawat_jenisField.getValue()!== null){rawat_jenis_create = rawat_jenisField.getValue();} 
		if(rawat_kontribusiField.getValue()!== null){rawat_kontribusi_create = rawat_kontribusiField.getValue();} 
		if(rawat_kategoriField.getValue()!== null){rawat_kategori_create = rawat_kategoriField.getValue();} 
		if(rawat_keteranganField.getValue()!== null){rawat_keterangan_create = rawat_keteranganField.getValue();} 
		if(rawat_duField.getValue()!== null){rawat_du_create = rawat_duField.getValue();} 
		if(rawat_dmField.getValue()!== null){rawat_dm_create = rawat_dmField.getValue();} 
		if(rawat_pointField.getValue()!== null){rawat_point_create = rawat_pointField.getValue();}
		if(rawat_kreditField.getValue()!== null){rawat_kredit_create = rawat_kreditField.getValue();} 
		if(rawat_hargaField.getValue()!== null){rawat_harga_create = rawat_hargaField.getValue();}
		if(rawat_jumlah_tindakanField.getValue()!== null){rawat_jumlah_tindakan_create = rawat_jumlah_tindakanField.getValue();} 
		if(rawat_gudangField.getValue()!== null){rawat_gudang_create = rawat_gudangField.getValue();} 
		if(rawat_aktifField.getValue()!== null){rawat_aktif_create = rawat_aktifField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_perawatan&m=get_action',
			params: {
				task: post2db,
				rawat_id	: rawat_id_create_pk, 
				rawat_kode	: rawat_kode_create, 
				rawat_kodelama	: rawat_kodelama_create, 
				rawat_nama	: rawat_nama_create, 
				rawat_group	: rawat_group_create, 
				rawat_kategori	: rawat_kategori_create,
				rawat_kontribusi : rawat_kontribusi_create,
				rawat_jenis	: rawat_jenis_create, 
				rawat_keterangan	: rawat_keterangan_create, 
				rawat_du	: rawat_du_create, 
				rawat_dm	: rawat_dm_create, 
				rawat_point	: rawat_point_create,
				rawat_kredit : rawat_kredit_create,
				rawat_jumlah_tindakan : rawat_jumlah_tindakan_create,
				rawat_harga	: rawat_harga_create, 
				rawat_gudang	: rawat_gudang_create, 
				rawat_aktif	: rawat_aktif_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						perawatan_konsumsi_purge();
						perawatan_alat_purge();
						Ext.MessageBox.alert(post2db+' OK','Data perawatan berhasil disimpan');
						perawatan_DataStore.reload();
						perawatan_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data perawatan tidak bisa disimpan',
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
			return perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_id');
		else if(post2db=='CREATE')
			return rawat_idField.getValue();
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function perawatan_reset_form(){
		rawat_idField.reset();
		rawat_idField.setValue(null);
		rawat_kodeField.reset();
		rawat_kodeField.setValue(null);
		rawat_kodelamaField.reset();
		rawat_kodelamaField.setValue(null);
		rawat_namaField.reset();
		rawat_namaField.setValue(null);
		rawat_groupField.reset();
		rawat_groupField.setValue(null);
		rawat_jenisField.reset();
		rawat_jenisField.setValue(null);
		rawat_kontribusiField.reset();
		rawat_kontribusiField.setValue(null);
		rawat_kategoriField.reset();
		rawat_kategoriField.setValue(null);
		rawat_keteranganField.reset();
		rawat_keteranganField.setValue(null);
		rawat_duField.reset();
		rawat_duField.setValue(null);
		rawat_dmField.reset();
		rawat_dmField.setValue(null);
		rawat_pointField.reset();
		rawat_pointField.setValue(null);
		rawat_kreditField.reset();
		rawat_kreditField.setValue(null);
		rawat_jumlah_tindakanField.reset();
		rawat_jumlah_tindakanField.setValue(null);
		rawat_hargaField.reset();
		rawat_hargaField.setValue(null);
		rawat_gudangField.reset();
		rawat_gudangField.setValue(null);
		rawat_aktifField.reset();
		rawat_aktifField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function perawatan_set_form(){
		rawat_idField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_id'));
		rawat_kodeField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_kode'));
		rawat_kodelamaField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_kodelama'));
		rawat_namaField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_nama'));
		rawat_groupField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_group'));
		rawat_jenisField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_jenis'));
		rawat_kontribusiField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_kontribusi'));
		rawat_kategoriField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_kategori_id'));
		rawat_kategoritxtField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_kategori_nama'));
		rawat_keteranganField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_keterangan'));
		rawat_duField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_du'));
		rawat_dmField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_dm'));
		rawat_pointField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_point'));
		rawat_kreditField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_kredit'));
		rawat_hargaField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_harga'));
		rawat_jumlah_tindakanField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_jumlah_tindakan'));
		rawat_gudangField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_gudang'));
		rawat_aktifField.setValue(perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_aktif'));
		
		cbo_satuan_produkDataStore.setBaseParam('task','detail');
		cbo_satuan_produkDataStore.setBaseParam('master_id',get_pk_id());
		cbo_satuan_produkDataStore.load();
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_perawatan_form_valid(){
		return (rawat_namaField.isValid() && rawat_groupField.isValid() && rawat_jenisField.isValid() && rawat_gudangField.isValid() );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		perawatan_konsumsi_DataStore.load({params:{master_id:0}});
		if(!perawatan_createWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			perawatan_reset_form();
			rawat_aktifField.setValue('Aktif');
			perawatan_createWindow.show();
		} else {
			perawatan_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function perawatan_confirm_delete(){
		// only one perawatan is selected here
		if(perawatanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', perawatan_delete);
		} else if(perawatanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', perawatan_delete);
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
	function perawatan_confirm_update(){
		/* only one record is selected here */
		cbo_rawat_produkDataStore.setBaseParam('query',perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_id'));
		cbo_rawat_produkDataStore.load({params:{query:perawatanListEditorGrid.getSelectionModel().getSelected().get('rawat_id')}});
		cbo_rawat_alatDataStore.load();
		//cbo_rawat_gudangDataSore.load();
		if(perawatanListEditorGrid.selModel.getCount() == 1) {
			perawatan_set_form();
			post2db='UPDATE';
			perawatan_konsumsi_DataStore.setBaseParam('master_id',get_pk_id());
			perawatan_konsumsi_DataStore.load();
			perawatan_alat_DataStore.load({params : {master_id : get_pk_id(), start:0, limit:pageS}});
			msg='updated';
			perawatan_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih data yang akan diubah',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function perawatan_delete(btn){
		if(btn=='yes'){
			var selections = perawatanListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< perawatanListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.rawat_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_perawatan&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							perawatan_DataStore.reload();
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
	perawatan_DataStore = new Ext.data.Store({
		id: 'perawatan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
		/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rawat_id', type: 'int', mapping: 'rawat_id'}, 
			{name: 'rawat_kode', type: 'string', mapping: 'rawat_kode'}, 
			{name: 'rawat_kodelama', type: 'string', mapping: 'rawat_kodelama'}, 
			{name: 'rawat_nama', type: 'string', mapping: 'rawat_nama'}, 
			{name: 'rawat_group', type: 'string', mapping: 'group_nama'}, 
			{name: 'rawat_kategori_nama', type: 'string', mapping: 'kategori_nama'},
			{name: 'rawat_kategori_id', type: 'string', mapping: 'rawat_kategori'},
			{name: 'rawat_kontribusi', type: 'string', mapping: 'kategori2_nama'}, 
			{name: 'rawat_jenis', type: 'string', mapping: 'jenis_nama'}, 
			{name: 'rawat_keterangan', type: 'string', mapping: 'rawat_keterangan'}, 
			{name: 'rawat_du', type: 'int', mapping: 'rawat_du'}, 
			{name: 'rawat_dm', type: 'int', mapping: 'rawat_dm'}, 
			{name: 'rawat_point', type: 'int', mapping: 'rawat_point'},
			{name: 'rawat_kredit', type: 'int', mapping: 'rawat_kredit'},
			{name: 'rawat_jumlah_tindakan', type: 'int', mapping: 'rawat_jumlah_tindakan'},			
			{name: 'rawat_harga', type: 'float', mapping: 'rawat_harga'}, 
			{name: 'rawat_gudang', type: 'string', mapping: 'gudang_nama'}, 
			{name: 'rawat_aktif', type: 'string', mapping: 'rawat_aktif'}, 
			{name: 'rawat_creator', type: 'string', mapping: 'rawat_creator'}, 
			{name: 'rawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'rawat_date_create'}, 
			{name: 'rawat_update', type: 'string', mapping: 'rawat_update'}, 
			{name: 'rawat_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'rawat_date_update'}, 
			{name: 'rawat_revised', type: 'int', mapping: 'rawat_revised'} 
		]),
		sortInfo:{field: 'rawat_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Datastore Rawat Group*/
	cbo_rawat_groupDataStore = new Ext.data.Store({
		id: 'cbo_rawat_groupDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_group_perawatan_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'group_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rawat_group_value', type: 'int', mapping: 'group_id'},
			{name: 'rawat_group_display', type: 'string', mapping: 'group_nama'},
			{name: 'rawat_group_durawat', type: 'int', mapping: 'group_durawat'},
			{name: 'rawat_group_dmrawat', type: 'int', mapping: 'group_dmrawat'},
			{name: 'rawat_group_kelompok', type: 'string', mapping: 'kategori_nama'},
			{name: 'rawat_group_kelompok_id', type: 'int', mapping: 'kategori_id'}
		]),
		sortInfo:{field: 'rawat_group_display', direction: "ASC"}
	});
	
	/* Datastore Rawat kategori */
	cbo_rawat_jenisDataSore = new Ext.data.Store({
		id: 'cbo_rawat_jenisDataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_jenis_perawatan_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jenis_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rawat_jenis_value', type: 'int', mapping: 'jenis_id'},
			{name: 'rawat_jenis_display', type: 'string', mapping: 'jenis_nama'}
		]),
		sortInfo:{field: 'rawat_jenis_display', direction: "ASC"}
	});
	
	/* Datastore Rawat Kontribusi */
	cbo_rawat_kontribusiDataSore = new Ext.data.Store({
		id: 'cbo_rawat_kontribusiDataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_kontribusi_rawat_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kategori2_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rawat_kontribusi_value', type: 'int', mapping: 'kategori2_id'},
			{name: 'rawat_kontribusi_display', type: 'string', mapping: 'kategori2_nama'}
		]),
		sortInfo:{field: 'rawat_kontribusi_display', direction: "ASC"}
	});
	
	/* Datastore Rawat Jenis */
	cbo_rawat_kategoriDataStore = new Ext.data.Store({
		id: 'cbo_rawat_kategoriDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_kategori_perawatan_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kategori_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rawat_kategori_value', type: 'int', mapping: 'kategori_id'},
			{name: 'rawat_kategori_display', type: 'string', mapping: 'kategori_nama'}
		]),
		sortInfo:{field: 'rawat_kategori_display', direction: "ASC"}
	});
	
	/* Datastore Rawat Gudang */
	cbo_rawat_gudangDataSore = new Ext.data.Store({
		id: 'cbo_rawat_gudangDataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_gudang_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'gudang_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rawat_gudang_value', type: 'int', mapping: 'gudang_id'},
			{name: 'rawat_gudang_display', type: 'string', mapping: 'gudang_nama'}
		]),
		sortInfo:{field: 'rawat_gudang_display', direction: "ASC"}
	});
    
  	/* Function for Identify of Window Column Model */
	perawatan_ColumnModel = new Ext.grid.ColumnModel(
		[/*{
			header: '#',
			readOnly: true,
			dataIndex: 'rawat_id',
			width: 70,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},*/
		{
			header: '<div align="center">' + 'Kode Lama' + '</div>',
			dataIndex: 'rawat_kodelama',
			width: 120,	//150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: true,
				maxLength: 20
          	})
		},
		{
			header: '<div align="center">' + 'Kode Baru' + '</div>',
			dataIndex: 'rawat_kode',
			width: 120,	//150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 20
          	})
		},
		{
			header: '<div align="center">' + 'Nama Perawatan' + '</div>',
			dataIndex: 'rawat_nama',
			width: 300,	//250,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 250
          	})
		}, 
		{
			header: '<div align="center">' + 'Group 1' + '</div>',
			dataIndex: 'rawat_group',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: cbo_rawat_groupDataStore,
				mode: 'remote',
				displayField: 'rawat_group_display',
				valueField: 'rawat_group_value',
				triggerAction: 'all'
			})
		},
		{
			header: '<div align="center">' + 'Group 2' + '</div>',
			dataIndex: 'rawat_jenis',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: cbo_rawat_jenisDataSore,
				mode: 'remote',
				displayField: 'rawat_jenis_display',
				valueField: 'rawat_jenis_value',
				triggerAction: 'all'
			})
		}, 
		{
			header: '<div align="center">' + 'Jenis' + '</div>',
			dataIndex: 'rawat_kategori_nama',
			width: 120,	//150,
			sortable: true,
			editable: false
		}, 
		{
			header: '<div align="center">' + 'DU (%)' + '</div>',
			align: 'right',
			dataIndex: 'rawat_du',
			width: 80,	//100,
			renderer: function(val){
				return '<span>' + val + ' </span>' + '</div>';
			},
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
			header: '<div align="center">' + 'DM (%)' + '</div>',
			align: 'right',
			dataIndex: 'rawat_dm',
			width: 80,	//100,
			renderer: function(val){
				return '<span>' + val + '</span>';
			},
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
			header: '<div align="center">' + 'Poin' + '</div>',
			dataIndex: 'rawat_point',
			align: 'right',
			width: 80,	//100,
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
			header: '<div align="center">' + 'Kredit' + '</div>',
			dataIndex: 'rawat_kredit',
			align: 'right',
			width: 80,	//100,
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
			header: '<div align="center">' + 'Sat.Jml.Tindakan' + '</div>',
			dataIndex: 'rawat_jumlah_tindakan',
			align: 'right',
			width: 100,	//150,
			sortable: true,
			hidden : true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			},
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		
		{
			header: '<div align="center">' + 'Harga (Rp)' + '</div>',
			dataIndex: 'rawat_harga',
			align: 'right',
			width: 100,	//150,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			},
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: '<div align="center">' + 'Gudang' + '</div>',
			dataIndex: 'rawat_gudang',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: cbo_rawat_gudangDataSore,
				mode: 'remote',
				displayField: 'rawat_gudang_display',
				valueField: 'rawat_gudang_value',
				triggerAction: 'all'
			})
		}, 
		{
			header: 'Contribution',
			dataIndex: 'rawat_kontribusi',
			width: 150,
			sortable: true,
			hidden: true,
			editor: new Ext.form.ComboBox({
				store: cbo_rawat_kontribusiDataSore,
				mode: 'remote',
				editable:false,
				displayField: 'rawat_kontribusi_display',
				valueField: 'rawat_kontribusi_value',
				triggerAction: 'all'
			})
		}, 
		{
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'rawat_aktif',
			width: 80,	//150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['rawat_aktif_value', 'rawat_aktif_display'],
					data: [['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
					}),
				mode: 'local',
               	displayField: 'rawat_aktif_display',
               	valueField: 'rawat_aktif_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Creator',
			dataIndex: 'rawat_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'rawat_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'rawat_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'rawat_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'rawat_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	perawatan_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	perawatanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'perawatanListEditorGrid',
		el: 'fp_perawatan',
//		title: 'List Of Perawatan',
		title: 'Daftar Perawatan',
		autoHeight: true,
		store: perawatan_DataStore, // DataStore
		cm: perawatan_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			hideParent:true,
			store: perawatan_DataStore,
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
			handler: perawatan_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled:true,
			handler: perawatan_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: perawatan_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						perawatan_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search by (aktif only):'});
				Ext.get(this.id).set({qtip:'- Kode Baru<br>- Kode Lama<br>- Nama Perawatan<br>- Group 1<br>- Group 2<br>- Jenis'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: perawatan_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: perawatan_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: perawatan_print  
		}
		]
	});
	perawatanListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	perawatan_ContextMenu = new Ext.menu.Menu({
		id: 'perawatan_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: perawatan_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: perawatan_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: perawatan_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: perawatan_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onperawatan_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		perawatan_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		perawatan_SelectedRow=rowIndex;
		perawatan_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function perawatan_editContextMenu(){
		perawatanListEditorGrid.startEditing(perawatan_SelectedRow,1);
  	}
	/* End of Function */
  	
	perawatanListEditorGrid.addListener('rowcontextmenu', onperawatan_ListEditGridContextMenu);
	//perawatan_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	perawatanListEditorGrid.on('afteredit', perawatan_update); // inLine Editing Record
	
	/* Identify  rawat_id Field */
	rawat_idField= new Ext.form.NumberField({
		id: 'rawat_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  rawat_kode Field */
	rawat_kodeField= new Ext.form.TextField({
		id: 'rawat_kodeField',
		fieldLabel: 'Kode Baru',
		maxLength: 20,
		readOnly: false,
		emptyText: '(auto)',
		width: 100,
		maskRe: /([A-Z0-9]+)$/
	});
	/* Identify  rawat_kodelama Field */
	rawat_kodelamaField= new Ext.form.TextField({
		id: 'rawat_kodelamaField',
		fieldLabel: 'Kode Lama',
		maxLength: 20,
		width: 100
	});
	/* Identify  rawat_nama Field */
	rawat_namaField= new Ext.form.TextField({
		id: 'rawat_namaField',
		fieldLabel: 'Nama <span style="color: #ec0000">*</span>',
		maxLength: 250,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  rawat_group Field */
	rawat_groupField= new Ext.form.ComboBox({
		id: 'rawat_groupField',
		fieldLabel: 'Group 1 <span style="color: #ec0000">*</span>',
		store: cbo_rawat_groupDataStore,
		mode: 'remote',
		editable:false,
		allowBlank: false,
		displayField: 'rawat_group_display',
		valueField: 'rawat_group_value',
		width: 120,
		triggerAction: 'all'
	});
	/* Identify  rawat_kategori Field */
	rawat_jenisField= new Ext.form.ComboBox({
		id: 'rawat_jenisField',
		fieldLabel: 'Group 2 <span style="color: #ec0000">*</span>',
		store: cbo_rawat_jenisDataSore,
		mode: 'remote',
		editable:false,
		allowBlank: false,
		displayField: 'rawat_jenis_display',
		valueField: 'rawat_jenis_value',
		width: 120,
		triggerAction: 'all'
	});
	
	rawat_kontribusiField= new Ext.form.ComboBox({
		id: 'rawat_kontribusiField',
		fieldLabel: 'Contribution Category',
		store: cbo_rawat_kontribusiDataSore,
		mode: 'remote',
		editable:false,
		displayField: 'rawat_kontribusi_display',
		valueField: 'rawat_kontribusi_value',
		triggerAction: 'all'
	});
	
	/* Identify  rawat_jenis Field */
	rawat_kategoriField= new Ext.form.NumberField();
	rawat_kategoritxtField= new Ext.form.TextField({
		id: 'rawat_kategoritxtField',
		fieldLabel: 'Jenis',
		disabled: true,
		width: 120
	});
	/* Identify  rawat_keterangan Field */
	rawat_keteranganField= new Ext.form.TextArea({
		id: 'rawat_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  rawat_du Field */
	rawat_duField= new Ext.form.NumberField({
		id: 'rawat_duField',
		name: 'rawat_duField',
		fieldLabel: 'Diskon Umum (%)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  rawat_dm Field */
	rawat_dmField= new Ext.form.NumberField({
		id: 'rawat_dmField',
		name: 'rawat_dmField',
		fieldLabel: 'Diskon Member (%)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  rawat_point Field */
	rawat_pointField= new Ext.form.NumberField({
		id: 'rawat_pointField',
		name: 'rawat_pointField',
		fieldLabel: 'Poin',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	
	rawat_kreditField= new Ext.form.NumberField({
		id: 'rawat_kreditField',
		name: 'rawat_kreditField',
		fieldLabel: 'Kredit',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	
	rawat_jumlah_tindakanField= new Ext.form.NumberField({
		id: 'rawat_jumlah_tindakanField',
		name: 'rawat_jumlah_tindakanField',
		fieldLabel: 'Sat.Jml.Tindakan',
		allowNegatife : false,
		emptyText: '1',
		allowBlank: true,
		allowDecimals: true,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	
	/* Identify  rawat_harga Field */
	rawat_hargaField= new Ext.form.NumberField({
		id: 'rawat_hargaField',
		name: 'rawat_hargaField',
		fieldLabel: 'Harga (Rp)',
		allowNegatife : false,
		emptyText: '0',
		allowBlank: true,
		allowDecimals: true,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  rawat_gudang Field */
	rawat_gudangField= new Ext.form.ComboBox({
		id: 'rawat_gudangField',
		fieldLabel: 'Gudang',
		store: cbo_rawat_gudangDataSore,
		mode: 'remote',
		editable:false,
		allowBlank: false,
		displayField: 'rawat_gudang_display',
		valueField: 'rawat_gudang_value',
		width: 120,
		triggerAction: 'all'
	});
	/* Identify  rawat_aktif Field */
	rawat_aktifField= new Ext.form.ComboBox({
		id: 'rawat_aktifField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['rawat_aktif_value', 'rawat_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		editable:false,
		displayField: 'rawat_aktif_display',
		valueField: 'rawat_aktif_value',
		//anchor: '95%',
		width: 80,
		triggerAction: 'all'	
	});
	
	rawat_groupField.on('select', function(){
		var record=cbo_rawat_groupDataStore.findExact('rawat_group_value', rawat_groupField.getValue(),0);
		if(cbo_rawat_groupDataStore.getCount()){
			rawat_duField.setValue(cbo_rawat_groupDataStore.getAt(record).data.rawat_group_durawat);
			rawat_dmField.setValue(cbo_rawat_groupDataStore.getAt(record).data.rawat_group_dmrawat);
			rawat_kategoritxtField.setValue(cbo_rawat_groupDataStore.getAt(record).data.rawat_group_kelompok);
			rawat_kategoriField.setValue(cbo_rawat_groupDataStore.getAt(record).data.rawat_group_kelompok_id);
			if(cbo_rawat_groupDataStore.getAt(record).data.rawat_group_kelompok=="Medis" || cbo_rawat_groupDataStore.getAt(record).data.rawat_group_kelompok=="Surgery"){
				//rawat_gudangField.setValue("Gudang Besar");
				cbo_rawat_gudangDataSore.load();
			}else if(cbo_rawat_groupDataStore.getAt(record).data.rawat_group_kelompok=="Non Medis"){
				//rawat_gudangField.setValue("Gudang BT");
				cbo_rawat_gudangDataSore.load();
			}else{
				rawat_gudangField.setValue("");
			}
		}
	});
	
  	/*Fieldset Master*/
	perawatan_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		labelWidth:120,
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rawat_kodelamaField, rawat_kodeField, rawat_namaField, rawat_groupField, rawat_jenisField, rawat_kategoritxtField, rawat_duField, rawat_dmField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rawat_pointField, rawat_kreditField, rawat_jumlah_tindakanField, rawat_hargaField, rawat_kontribusiField, rawat_gudangField, rawat_keteranganField, rawat_aktifField, rawat_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var perawatan_konsumsi_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'krawat_id', type: 'int', mapping: 'krawat_id'}, 
			{name: 'krawat_master', type: 'int', mapping: 'krawat_master'}, 
			{name: 'krawat_produk', type: 'int', mapping: 'krawat_produk'}, 
			{name: 'krawat_satuan', type: 'int', mapping: 'krawat_satuan'}, 
			{name: 'krawat_jumlah', type: 'float', mapping: 'krawat_jumlah'} 
	]);
	//eof
	
	var perawatan_alat_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'arawat_id', type: 'int', mapping: 'arawat_id'}, 
			{name: 'arawat_master', type: 'int', mapping: 'arawat_master'}, 
			{name: 'arawat_alat', type: 'int', mapping: 'arawat_alat'}, 
			{name: 'arawat_jumlah', type: 'int', mapping: 'arawat_jumlah'} 
	]);
	//eof
	
	//function for json writer of detail
	var perawatan_konsumsi_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	perawatan_konsumsi_DataStore = new Ext.data.Store({
		id: 'perawatan_konsumsi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=detail_perawatan_konsumsi_list', 
			method: 'POST'
		}),
		reader: perawatan_konsumsi_reader,
		baseParams:{master_id: get_pk_id(), start: 0, limit: pageS},
		sortInfo:{field: 'krawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	/* Function for Retrieve DataStore of detail*/
	perawatan_alat_DataStore = new Ext.data.Store({
		id: 'perawatan_alat_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=detail_perawatan_alat_list', 
			method: 'POST'
		}),
		reader: perawatan_alat_reader,
		baseParams:{master_id: get_pk_id(), start: 0, limit: pageS},
		sortInfo:{field: 'arawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_perawatan_konsumsi= new Ext.ux.grid.RowEditor({
        saveText: 'Update'/*,
		listeners: {
			afteredit: function(){
				perawatan_konsumsi_DataStore.commitChanges();
			}
		}*/
    });
	//eof
	
	//function for editor of detail
	var editor_perawatan_alat= new Ext.ux.grid.RowEditor({
        saveText: 'Update',
		listeners: {
			afteredit: function(){
				perawatan_alat_DataStore.commitChanges();
			}
		}
    });
	//eof
	
	Ext.util.Format.comboRenderer = function(combo){
		//cbo_rawat_produkDataStore.load();
		//cbo_rawat_alatDataStore.load();
		//cbo_rawat_gudangDataSore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	
	cbo_rawat_produkDataStore = new Ext.data.Store({
		id: 'cbo_rawat_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_produk_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 50 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'rawat_produk_value', type: 'int', mapping: 'produk_id'},
			{name: 'rawat_produk_harga', type: 'float', mapping: 'produk_harga'},
			{name: 'rawat_produk_kode', type: 'string', mapping: 'produk_kode'},
			{name: 'rawat_produk_kodelama', type: 'string', mapping: 'produk_kodelama'},
			{name: 'rawat_produk_satuan', type: 'string', mapping: 'satuan_kode'},
			{name: 'rawat_produk_group', type: 'string', mapping: 'group_nama'},
			{name: 'rawat_produk_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'rawat_produk_du', type: 'float', mapping: 'produk_du'},
			{name: 'rawat_produk_dm', type: 'float', mapping: 'produk_dm'},
			{name: 'rawat_produk_display', type: 'string', mapping: 'produk_nama'}
		]),
		sortInfo:{field: 'rawat_produk_display', direction: "ASC"}
	});
	
	
	
	cbo_rawat_alatDataStore = new Ext.data.Store({
		id: 'cbo_rawat_alatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_alat_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'alat_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'alat_value', type: 'int', mapping: 'alat_id'},
			{name: 'alat_display', type: 'string', mapping: 'alat_nama'},
			{name: 'alat_jumlah', type: 'int', mapping: 'alat_jumlah'}
		]),
		sortInfo:{field: 'alat_display', direction: "ASC"}
	});
	
	var rawat_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{rawat_produk_display}<br/>Lama:{rawat_produk_kodelama}| Baru:<b>{rawat_produk_kode}</b> <br/>Group 1: {rawat_produk_group}, ',
			'Kategori: {rawat_produk_kategori}</span>',
		'</div></tpl>'
    );
	
	cbo_satuan_produkDataStore = new Ext.data.Store({
		id: 'cbo_satuan_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perawatan&m=get_satuan_list', 
			method: 'POST'
		}),
		baseParams: {start:0,limit:pageS, task:'detail'},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_value'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'satuan_value', type: 'int', mapping: 'satuan_id'},
			{name: 'satuan_nama', type: 'string', mapping: 'satuan_nama'}
		]),
		sortInfo:{field: 'satuan_nama', direction: "ASC"}
	});
	
	
	var combo_rawat_produk=new Ext.form.ComboBox({
			store: cbo_rawat_produkDataStore,
			mode: 'remote',
			typeAhead: false,
			displayField: 'rawat_produk_display',
			valueField: 'rawat_produk_value',
			triggerAction: 'all',
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: rawat_produk_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	
	var combo_rawat_alat=new Ext.form.ComboBox({
			store: cbo_rawat_alatDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'alat_display',
			valueField: 'alat_value',
			triggerAction: 'all',
			loadingText: 'Searching...',
			pageSize: pageS,
			hideTrigger:false,
			lazyRender:true,
			anchor: '95%'

	});
	
	var combo_dproduk_satuan=new Ext.form.ComboBox({
		store: cbo_satuan_produkDataStore,
		mode: 'local',
		typeAhead: true,
		displayField: 'satuan_nama',
		valueField: 'satuan_value',
		triggerAction: 'all',
		lazyRender:true
	});
	/*combo_dproduk_satuan.on("focus",function(){
		cbo_satuan_produkDataStore.setBaseParam('task','produk');
		cbo_satuan_produkDataStore.setBaseParam('selected_id',combo_rawat_produk.getValue());
		cbo_satuan_produkDataStore.load();
	});*/
	
	//declaration of detail coloumn model
	perawatan_konsumsi_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">Produk</div>',
			dataIndex: 'krawat_produk',
			width: 300,
			sortable: true,
			editor: combo_rawat_produk,
			renderer: Ext.util.Format.comboRenderer(combo_rawat_produk)
		},
		{
			header: '<div align="center">Satuan</div>',
			dataIndex: 'krawat_satuan',
			width: 60,
			sortable: true,
			/*editor: combo_dproduk_satuan,
			renderer: Ext.util.Format.comboRenderer(combo_dproduk_satuan)*/
			readOnly: true,
			renderer: function(v, params, record){
				j=cbo_rawat_produkDataStore.findExact('rawat_produk_value',record.data.krawat_produk,0);
				if(j>-1)
					return cbo_rawat_produkDataStore.getAt(j).data.rawat_produk_satuan;
			}
		},
		{
			header: '<div align="center">Jumlah</div>',
			dataIndex: 'krawat_jumlah',
			align: 'right',
			width: 40,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				emptyText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	perawatan_konsumsi_ColumnModel.defaultSortable= true;
	//eof
	
	
	//declaration of detail coloumn model
	perawatan_alat_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Nama Alat',
			dataIndex: 'arawat_alat',
			width: 250,
			sortable: true,
			editor: combo_rawat_alat,
			renderer: Ext.util.Format.comboRenderer(combo_rawat_alat)
		},
		{
			header: 'Jumlah',
			dataIndex: 'arawat_jumlah',
			width: 100,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				emptyText: '0',
				maxLength: 2,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	perawatan_alat_ColumnModel.defaultSortable= true;
	
	
	//declaration of detail list editor grid
	perawatan_konsumsiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'perawatan_konsumsiListEditorGrid',
		el: 'fp_perawatan_konsumsi',
		title: 'Detail Standard Bahan',
		height: 350,
		width: 690,
		autoScroll: true,
		store: perawatan_konsumsi_DataStore, // DataStore
		colModel: perawatan_konsumsi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_perawatan_konsumsi],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: perawatan_konsumsi_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: perawatan_konsumsi_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: perawatan_konsumsi_confirm_delete
		}
		]
	});
	//eof
	
	//declaration of detail list editor grid
	perawatan_alatListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'perawatan_alatListEditorGrid',
		el: 'fp_perawatan_alat',
		title: 'Detail perawatan_alat',
		height: 350,
		width: 690,
		autoScroll: true,
		store: perawatan_alat_DataStore, // DataStore
		colModel: perawatan_alat_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_perawatan_alat],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: perawatan_alat_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: perawatan_alat_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: perawatan_alat_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function perawatan_konsumsi_add(){
		var edit_perawatan_konsumsi= new perawatan_konsumsiListEditorGrid.store.recordType({
			krawat_id	:'',		
			krawat_master	:'',		
			krawat_produk	:'',		
			krawat_satuan	:'',		
			krawat_jumlah	:''		
		});
		editor_perawatan_konsumsi.stopEditing();
		perawatan_konsumsi_DataStore.insert(0, edit_perawatan_konsumsi);
		//perawatan_konsumsiListEditorGrid.getView().refresh();
		perawatan_konsumsiListEditorGrid.getSelectionModel().selectRow(0);
		editor_perawatan_konsumsi.startEditing(0);
	}
	
	//function of detail add
	function perawatan_alat_add(){
		var edit_perawatan_alat= new perawatan_alatListEditorGrid.store.recordType({
			arawat_id	:'',		
			arawat_master	:'',		
			arawat_alat	:'',		
			arawat_jumlah	:''		
		});
		editor_perawatan_alat.stopEditing();
		perawatan_alat_DataStore.insert(0, edit_perawatan_alat);
		perawatan_alatListEditorGrid.getView().refresh();
		perawatan_alatListEditorGrid.getSelectionModel().selectRow(0);
		editor_perawatan_alat.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_perawatan_konsumsi(){
		perawatan_konsumsi_DataStore.commitChanges();
		perawatan_konsumsiListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function perawatan_konsumsi_insert(){
		for(i=0;i<perawatan_konsumsi_DataStore.getCount();i++){
			perawatan_konsumsi_record=perawatan_konsumsi_DataStore.getAt(i);
			if(perawatan_konsumsi_record.data.krawat_produk!=="" && perawatan_konsumsi_record.data.krawat_produk!==null){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_perawatan&m=detail_perawatan_konsumsi_insert',
					params:{
					krawat_id	: perawatan_konsumsi_record.data.krawat_id, 
					krawat_master	: get_pk_id(), 
					krawat_produk	: perawatan_konsumsi_record.data.krawat_produk, 
					krawat_satuan	: perawatan_konsumsi_record.data.krawat_satuan, 
					krawat_jumlah	: perawatan_konsumsi_record.data.krawat_jumlah 
					
					}
				});
			}
		}
	}
	//eof
	
	//function for insert detail
	function perawatan_alat_insert(){
		for(i=0;i<perawatan_alat_DataStore.getCount();i++){
			perawatan_alat_record=perawatan_alat_DataStore.getAt(i);
			if(perawatan_konsumsi_record.data.arawat_alat!=="" && perawatan_konsumsi_record.data.arawat_alat!==null){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_perawatan&m=detail_perawatan_alat_insert',
					params:{
					arawat_id	: perawatan_alat_record.data.arawat_id, 
					arawat_master	: get_pk_id(), 
					arawat_alat	: perawatan_alat_record.data.arawat_alat, 
					arawat_jumlah	: perawatan_alat_record.data.arawat_jumlah 	
					}
				});
			}
		}
	}
	//eof
	
	//function for purge detail
	function perawatan_konsumsi_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_perawatan&m=detail_perawatan_konsumsi_purge',
			params:{ master_id: get_pk_id() },
			timeout: 5000,			
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						perawatan_konsumsi_insert();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Produk.',
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
	//eof
	
	//function for purge detail
	function perawatan_alat_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_perawatan&m=detail_perawatan_alat_purge',
			params:{ master_id: get_pk_id() },
			timeout: 5000,			
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						perawatan_alat_insert();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Produk.',
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
	//eof
	
	/* Function for Delete Confirm of detail */
	function perawatan_konsumsi_confirm_delete(){
		// only one record is selected here
		if(perawatan_konsumsiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', perawatan_konsumsi_delete);
		} else if(perawatan_konsumsiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', perawatan_konsumsi_delete);
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
	
	/* Function for Delete Confirm of detail */
	function perawatan_alat_confirm_delete(){
		// only one record is selected here
		if(perawatan_alatListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', perawatan_alat_delete);
		} else if(perawatan_alatListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', perawatan_alat_delete);
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
	function perawatan_konsumsi_delete(btn){
		if(btn=='yes'){
			var s = perawatan_konsumsiListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				perawatan_konsumsi_DataStore.remove(r);
			}
		}
		//perawatan_konsumsi_DataStore.commitChanges();
	}
	//eof
	
	//function for Delete of detail
	function perawatan_alat_delete(btn){
		if(btn=='yes'){
			var s = perawatan_alatListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				perawatan_alat_DataStore.remove(r);
			}
		} 
		perawatan_alat_DataStore.commitChanges();
	}
	//eof
	
	//event on update of detail data store
	//perawatan_konsumsi_DataStore.on('update', refresh_perawatan_konsumsi);
	
	var detail_tab_rawat = new Ext.TabPanel({
		activeTab: 0,
		items: [perawatan_konsumsiListEditorGrid,perawatan_alatListEditorGrid]
	});
	
	/* Function for retrieve create Window Panel*/ 
	perawatan_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [perawatan_masterGroup,detail_tab_rawat]
		,
		buttons: [{
				text: 'Save and Close',
				handler: perawatan_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					perawatan_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	perawatan_createWindow= new Ext.Window({
		id: 'perawatan_createWindow',
		title: post2db+'Perawatan',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_perawatan_create',
		items: perawatan_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function perawatan_list_search(){
		// render according to a SQL date format.
		var rawat_id_search=null;
		var rawat_kode_search=null;
		var rawat_kodelama_search=null;
		var rawat_nama_search=null;
		var rawat_group_search=null;
		var rawat_kategori_search=null;
		var rawat_jenis_search=null;
		var rawat_keterangan_search=null;
		var rawat_du_search=null;
		var rawat_dm_search=null;
		var rawat_point_search=null;
		var rawat_kredit_search=null;
		var rawat_jumlah_tindakan_search=null;
		var rawat_harga_search=null;
		var rawat_gudang_search=null;
		var rawat_aktif_search=null;

		if(rawat_idSearchField.getValue()!==null){rawat_id_search=rawat_idSearchField.getValue();}
		if(rawat_kodeSearchField.getValue()!==null){rawat_kode_search=rawat_kodeSearchField.getValue();}
		if(rawat_kodelamaSearchField.getValue()!==null){rawat_kodelama_search=rawat_kodelamaSearchField.getValue();}
		if(rawat_namaSearchField.getValue()!==null){rawat_nama_search=rawat_namaSearchField.getValue();}
		if(rawat_groupSearchField.getValue()!==null){rawat_group_search=rawat_groupSearchField.getValue();}
		if(rawat_kategoriSearchField.getValue()!==null){rawat_kategori_search=rawat_kategoriSearchField.getValue();}
		if(rawat_jenisSearchField.getValue()!==null){rawat_jenis_search=rawat_jenisSearchField.getValue();}
		if(rawat_keteranganSearchField.getValue()!==null){rawat_keterangan_search=rawat_keteranganSearchField.getValue();}
		if(rawat_duSearchField.getValue()!==null){rawat_du_search=rawat_duSearchField.getValue();}
		if(rawat_dmSearchField.getValue()!==null){rawat_dm_search=rawat_dmSearchField.getValue();}
		if(rawat_pointSearchField.getValue()!==null){rawat_point_search=rawat_pointSearchField.getValue();}
		if(rawat_kreditSearchField.getValue()!==null){rawat_kredit_search=rawat_kreditSearchField.getValue();}
		if(rawat_jumlah_tindakanSearchField.getValue()!==null){rawat_jumlah_tindakan_search=rawat_jumlah_tindakanSearchField.getValue();}
		if(rawat_hargaSearchField.getValue()!==null){rawat_harga_search=rawat_hargaSearchField.getValue();}
		if(rawat_gudangSearchField.getValue()!==null){rawat_gudang_search=rawat_gudangSearchField.getValue();}
		if(rawat_aktifSearchField.getValue()!==null){rawat_aktif_search=rawat_aktifSearchField.getValue();}
		
		// change the store parameters
		perawatan_DataStore.baseParams = {
			task: 'SEARCH',
			start: 0,
			limit: pageS,
			//variable here
			rawat_id	:	rawat_id_search, 
			rawat_kode	:	rawat_kode_search, 
			rawat_kodelama	:	rawat_kodelama_search, 
			rawat_nama	:	rawat_nama_search, 
			rawat_group	:	rawat_group_search, 
			rawat_kategori	:	rawat_kategori_search, 
			rawat_jenis	:	rawat_jenis_search, 
			rawat_keterangan	:	rawat_keterangan_search, 
			rawat_du	:	rawat_du_search, 
			rawat_dm	:	rawat_dm_search, 
			rawat_point	:	rawat_point_search, 
			rawat_kredit :	rawat_kredit_search,
			rawat_jumlah_tindakan : rawat_jumlah_tindakan_search,
			rawat_harga	:	rawat_harga_search, 
			rawat_gudang	:	rawat_gudang_search, 
			rawat_aktif	:	rawat_aktif_search, 
		};
		// Cause the datastore to do another query : 
		perawatan_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function perawatan_reset_search(){
		// reset the store parameters
		perawatan_DataStore.baseParams = { task: 'LIST',start:0,limit:pageS };
		// Cause the datastore to do another query : 
		perawatan_DataStore.reload({params: {start: 0, limit: pageS}});
		perawatan_searchWindow.close();
	};
	/* End of Fuction */
	
	function perawatan_reset_SearchForm(){
		rawat_idSearchField.reset();
		rawat_idSearchField.setValue(null);
		rawat_kodeSearchField.reset();
		rawat_kodeSearchField.setValue(null);
		rawat_kodelamaSearchField.reset();
		rawat_kodelamaSearchField.setValue(null);
		rawat_namaSearchField.reset();
		rawat_namaSearchField.setValue(null);
		rawat_groupSearchField.reset();
		rawat_groupSearchField.setValue(null);
		rawat_kategoriSearchField.reset();
		rawat_kategoriSearchField.setValue(null);
		rawat_jenisSearchField.reset();
		rawat_jenisSearchField.setValue(null);
		rawat_keteranganSearchField.reset();
		rawat_keteranganSearchField.setValue(null);
		rawat_duSearchField.reset();
		rawat_duSearchField.setValue(null);
		rawat_dmSearchField.reset();
		rawat_dmSearchField.setValue(null);
		rawat_pointSearchField.reset();
		rawat_pointSearchField.setValue(null);
		rawat_kreditSearchField.reset();
		rawat_kreditSearchField.setValue(null);
		rawat_jumlah_tindakanSearchField.reset();
		rawat_jumlah_tindakanSearchField.setValue(null);
		rawat_hargaSearchField.reset();
		rawat_hargaSearchField.setValue(null);
		rawat_gudangSearchField.reset();
		rawat_gudangSearchField.setValue(null);
		rawat_aktifSearchField.reset();
		rawat_aktifSearchField.setValue(null);
	}
	
	/* Field for search */
	/* Identify  rawat_id Search Field */
	rawat_idSearchField= new Ext.form.NumberField({
		id: 'rawat_idSearchField',
		fieldLabel: 'Rawat Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  rawat_kode Search Field */
	rawat_kodeSearchField= new Ext.form.TextField({
		id: 'rawat_kodeSearchField',
		fieldLabel: 'Kode Baru',
		maxLength: 20,
		width: 100
	
	});
	/* Identify  rawat_kodelama Search Field */
	rawat_kodelamaSearchField= new Ext.form.TextField({
		id: 'rawat_kodelamaSearchField',
		fieldLabel: 'Kode Lama',
		maxLength: 20,
		width: 100
	
	});
	/* Identify  rawat_nama Search Field */
	rawat_namaSearchField= new Ext.form.TextField({
		id: 'rawat_namaSearchField',
		fieldLabel: 'Nama',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  rawat_group Search Field */
	rawat_groupSearchField= new Ext.form.ComboBox({
		id: 'rawat_groupSearchField',
		fieldLabel: 'Group 1',
		store: cbo_rawat_groupDataStore,
		mode: 'remote',
		displayField: 'rawat_group_display',
		valueField: 'rawat_group_value',
		width: 120,
		triggerAction: 'all'
	});
	/* Identify  rawat_kategori Search Field */
	rawat_jenisSearchField= new Ext.form.ComboBox({
		id: 'rawat_jenisSearchField',
		fieldLabel: 'Group 2',
		store: cbo_rawat_jenisDataSore,
		mode: 'remote',
		displayField: 'rawat_jenis_display',
		valueField: 'rawat_jenis_value',
		width: 120,
		triggerAction: 'all'
	});
	
	rawat_kategoriSearchField= new Ext.form.ComboBox({
		id: 'rawat_kategoriSearchField',
		fieldLabel: 'Jenis',
		store: cbo_rawat_kategoriDataStore,
		mode: 'remote',
		displayField: 'rawat_kategori_display',
		valueField: 'rawat_kategori_value',
		width: 120,
		triggerAction: 'all'
	});
	
	/* Identify  rawat_keterangan Search Field */
	rawat_keteranganSearchField= new Ext.form.TextArea({
		id: 'rawat_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  rawat_du Search Field */
	rawat_duSearchField= new Ext.form.NumberField({
		id: 'rawat_duSearchField',
		fieldLabel: 'Diskon Umum (%)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  rawat_dm Search Field */
	rawat_dmSearchField= new Ext.form.NumberField({
		id: 'rawat_dmSearchField',
		fieldLabel: 'Diskon Member (%)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  rawat_point Search Field */
	rawat_pointSearchField= new Ext.form.NumberField({
		id: 'rawat_pointSearchField',
		fieldLabel: 'Poin',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	
	});
	
	rawat_kreditSearchField= new Ext.form.NumberField({
		id: 'rawat_kreditSearchField',
		fieldLabel: 'Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	
	});
	
	/* Identify  rawat_harga Search Field */
	rawat_hargaSearchField= new Ext.form.NumberField({
		id: 'rawat_hargaSearchField',
		fieldLabel: 'Harga (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		width: 60,
		maskRe: /([0-9]+)$/
	
	});
	
	rawat_jumlah_tindakanSearchField= new Ext.form.NumberField({
		id: 'rawat_jumlah_tindakanSearchField',
		fieldLabel: 'Sat.Jmlh.Tindakan',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		width: 60,
		maskRe: /([0-9]+)$/
	
	});
	
	/* Identify  rawat_kontribusi Search Field */
	rawat_kontribusiSearchField= new Ext.form.ComboBox({
		id: 'rawat_kontribusiSearchField',
		fieldLabel: 'Contribution Category',
		store: cbo_rawat_kontribusiDataSore,
		mode: 'remote',
		editable:false,
		displayField: 'rawat_kontribusi_display',
		valueField: 'rawat_kontribusi_value',
		triggerAction: 'all'
	});
	/* Identify  rawat_gudang Search Field */
	rawat_gudangSearchField= new Ext.form.ComboBox({
		id: 'rawat_gudangSearchField',
		fieldLabel: 'Gudang',
		store: cbo_rawat_gudangDataSore,
		mode: 'remote',
		displayField: 'rawat_gudang_display',
		valueField: 'rawat_gudang_value',
		width: 120,
		triggerAction: 'all'
	});
	
	
	/* Identify  rawat_aktif Search Field */
	rawat_aktifSearchField= new Ext.form.ComboBox({
		id: 'rawat_aktifSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'rawat_aktif'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		displayField: 'rawat_aktif',
		valueField: 'value',
		width: 120,
		triggerAction: 'all'
	
	});
    
	/* Function for retrieve search Form Panel */
	perawatan_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		labelWidth:120,
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 600,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rawat_kodelamaSearchField, rawat_kodeSearchField, rawat_namaSearchField, rawat_groupSearchField, rawat_jenisSearchField, rawat_kategoriSearchField, rawat_duSearchField, rawat_dmSearchField] 
			}
 
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rawat_pointSearchField, rawat_kreditSearchField, rawat_jumlah_tindakanSearchField, rawat_hargaSearchField, rawat_kontribusiSearchField, rawat_gudangSearchField, rawat_keteranganSearchField, rawat_aktifSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: perawatan_list_search
			},{
				text: 'Close',
				handler: function(){
					perawatan_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	perawatan_searchWindow = new Ext.Window({
		title: 'perawatan Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_perawatan_search',
		items: perawatan_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!perawatan_searchWindow.isVisible()){
			perawatan_reset_SearchForm();
			perawatan_searchWindow.show();
		} else {
			perawatan_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function perawatan_print(){
		var searchquery = "";
		var rawat_kode_print=null;
		var rawat_kodelama_print=null;
		var rawat_nama_print=null;
		var rawat_group_print=null;
		var rawat_kategori_print=null;
		var rawat_jenis_print=null;
		var rawat_keterangan_print=null;
		var rawat_du_print=null;
		var rawat_dm_print=null;
		var rawat_point_print=null;
		var rawat_kredit_print=null;
		var rawat_harga_print=null;
		var rawat_gudang_print=null;
		var rawat_aktif_print=null;
		var win;              
		// check if we do have some search data...
		if(perawatan_DataStore.baseParams.query!==null){searchquery = perawatan_DataStore.baseParams.query;}
		if(perawatan_DataStore.baseParams.rawat_kode!==null){rawat_kode_print = perawatan_DataStore.baseParams.rawat_kode;}
		if(perawatan_DataStore.baseParams.rawat_kodelama!==null){rawat_kodelama_print = perawatan_DataStore.baseParams.rawat_kodelama;}
		if(perawatan_DataStore.baseParams.rawat_nama!==null){rawat_nama_print = perawatan_DataStore.baseParams.rawat_nama;}
		if(perawatan_DataStore.baseParams.rawat_group!==null){rawat_group_print = perawatan_DataStore.baseParams.rawat_group;}
		if(perawatan_DataStore.baseParams.rawat_kategori!==null){rawat_kategori_print = perawatan_DataStore.baseParams.rawat_kategori;}
		if(perawatan_DataStore.baseParams.rawat_jenis!==null){rawat_jenis_print = perawatan_DataStore.baseParams.rawat_jenis;}
		if(perawatan_DataStore.baseParams.rawat_keterangan!==null){rawat_keterangan_print = perawatan_DataStore.baseParams.rawat_keterangan;}
		if(perawatan_DataStore.baseParams.rawat_du!==null){rawat_du_print = perawatan_DataStore.baseParams.rawat_du;}
		if(perawatan_DataStore.baseParams.rawat_dm!==null){rawat_dm_print = perawatan_DataStore.baseParams.rawat_dm;}
		if(perawatan_DataStore.baseParams.rawat_point!==null){rawat_point_print = perawatan_DataStore.baseParams.rawat_point;}
		if(perawatan_DataStore.baseParams.rawat_kredit!==null){rawat_kredit_print = perawatan_DataStore.baseParams.rawat_kredit;}
		if(perawatan_DataStore.baseParams.rawat_harga!==null){rawat_harga_print = perawatan_DataStore.baseParams.rawat_harga;}
		if(perawatan_DataStore.baseParams.rawat_gudang!==null){rawat_gudang_print = perawatan_DataStore.baseParams.rawat_gudang;}
		if(perawatan_DataStore.baseParams.rawat_aktif!==null){rawat_aktif_print = perawatan_DataStore.baseParams.rawat_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_perawatan&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			rawat_kode : rawat_kode_print,
			rawat_kodelama : rawat_kodelama_print,
			rawat_nama : rawat_nama_print,
			rawat_group : rawat_group_print,
			rawat_kategori : rawat_kategori_print,
			rawat_jenis : rawat_jenis_print,
			rawat_keterangan : rawat_keterangan_print,
			rawat_du : rawat_du_print,
			rawat_dm : rawat_dm_print,
			rawat_point : rawat_point_print,
			rawat_kredit : rawat_kredit_print,
			rawat_harga : rawat_harga_print,
			rawat_gudang : rawat_gudang_print,
			rawat_aktif : rawat_aktif_print,
		  	currentlisting: perawatan_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./perawatanlist.html','perawatanlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function perawatan_export_excel(){
		var searchquery = "";
		var rawat_kode_2excel=null;
		var rawat_kodelama_2excel=null;
		var rawat_nama_2excel=null;
		var rawat_group_2excel=null;
		var rawat_kategori_2excel=null;
		var rawat_jenis_2excel=null;
		var rawat_keterangan_2excel=null;
		var rawat_du_2excel=null;
		var rawat_dm_2excel=null;
		var rawat_point_2excel=null;
		var rawat_harga_2excel=null;
		var rawat_gudang_2excel=null;
		var rawat_aktif_2excel=null;
		var win;              
		// check if we do have some search data...
		if(perawatan_DataStore.baseParams.query!==null){searchquery = perawatan_DataStore.baseParams.query;}
		if(perawatan_DataStore.baseParams.rawat_kode!==null){rawat_kode_2excel = perawatan_DataStore.baseParams.rawat_kode;}
		if(perawatan_DataStore.baseParams.rawat_kodelama!==null){rawat_kodelama_2excel = perawatan_DataStore.baseParams.rawat_kodelama;}
		if(perawatan_DataStore.baseParams.rawat_nama!==null){rawat_nama_2excel = perawatan_DataStore.baseParams.rawat_nama;}
		if(perawatan_DataStore.baseParams.rawat_group!==null){rawat_group_2excel = perawatan_DataStore.baseParams.rawat_group;}
		if(perawatan_DataStore.baseParams.rawat_kategori!==null){rawat_kategori_2excel = perawatan_DataStore.baseParams.rawat_kategori;}
		if(perawatan_DataStore.baseParams.rawat_jenis!==null){rawat_jenis_2excel = perawatan_DataStore.baseParams.rawat_jenis;}
		if(perawatan_DataStore.baseParams.rawat_keterangan!==null){rawat_keterangan_2excel = perawatan_DataStore.baseParams.rawat_keterangan;}
		if(perawatan_DataStore.baseParams.rawat_du!==null){rawat_du_2excel = perawatan_DataStore.baseParams.rawat_du;}
		if(perawatan_DataStore.baseParams.rawat_dm!==null){rawat_dm_2excel = perawatan_DataStore.baseParams.rawat_dm;}
		if(perawatan_DataStore.baseParams.rawat_point!==null){rawat_point_2excel = perawatan_DataStore.baseParams.rawat_point;}
		if(perawatan_DataStore.baseParams.rawat_harga!==null){rawat_harga_2excel = perawatan_DataStore.baseParams.rawat_harga;}
		if(perawatan_DataStore.baseParams.rawat_gudang!==null){rawat_gudang_2excel = perawatan_DataStore.baseParams.rawat_gudang;}
		if(perawatan_DataStore.baseParams.rawat_aktif!==null){rawat_aktif_2excel = perawatan_DataStore.baseParams.rawat_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_perawatan&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			rawat_kode : rawat_kode_2excel,
			rawat_kodelama : rawat_kodelama_2excel,
			rawat_nama : rawat_nama_2excel,
			rawat_group : rawat_group_2excel,
			rawat_kategori : rawat_kategori_2excel,
			rawat_jenis : rawat_jenis_2excel,
			rawat_keterangan : rawat_keterangan_2excel,
			rawat_du : rawat_du_2excel,
			rawat_dm : rawat_dm_2excel,
			rawat_point : rawat_point_2excel,
			rawat_harga : rawat_harga_2excel,
			rawat_gudang : rawat_gudang_2excel,
			rawat_aktif : rawat_aktif_2excel,
		  	currentlisting: perawatan_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_perawatan"></div>
        <div id="fp_perawatan_konsumsi"></div>
        <div id="fp_perawatan_alat"></div>
		<div id="elwindow_perawatan_create"></div>
        <div id="elwindow_perawatan_search"></div>
    </div>
</div>
</body>