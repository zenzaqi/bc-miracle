<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com,
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id

	+ Module  		: paket View
	+ Description	: For record view
	+ Filename 		: v_paket.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 19/Aug/2009 16:12:06

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
var paket_DataStore;
var paket_ColumnModel;
var paketListEditorGrid;
var paket_createForm;
var paket_createWindow;
var paket_searchForm;
var paket_searchWindow;
var paket_SelectedRow;
var paket_ContextMenu;
//for detail data
var paket_isi_perawatan_DataStor;
var paket_isi_perawatanListEditorGrid;
var paket_isi_perawatan_ColumnModel;
var paket_isi_perawatan_proxy;
var paket_isi_perawatan_writer;
var paket_isi_perawatan_reader;
var editor_paket_isi_perawatan;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var paket_idField;
var paket_kodeField;
var paket_kodelamaField;
var paket_namaField;
var paket_standart_tetapField;
var paket_groupField;
var paket_kategoriField;
var paket_kategoritxtField;
var paket_keteranganField;
var paket_duField;
var paket_dmField;
var paket_pointField;
var paket_hargaField;
var paket_expiredField;
var paket_perpanjanganField;
var paket_aktifField;
var paket_idSearchField;
var paket_kodeSearchField;
var paket_kodelamaSearchField;
var paket_namaSearchField;
var paket_groupSearchField;
var paket_keteranganSearchField;
var paket_duSearchField;
var paket_dmSearchField;
var paket_pointSearchField;
var paket_hargaSearchField;
var paket_expiredSearchField;
var paket_aktifSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */

  	/* Function for Saving inLine Editing */
	function paket_update(oGrid_event){
		var paket_id_update_pk="";
		var paket_kode_update=null;
		var paket_kodelama_update=null;
		var paket_nama_update=null;
		var paket_group_update=null;
		var paket_keterangan_update=null;
		var paket_du_update=null;
		var paket_dm_update=null;
		var paket_point_update=null;
		var paket_harga_update=null;
		var paket_expired_update=null;
		var paket_perpanjangan_update=null;
		var paket_aktif_update=null;

		paket_id_update_pk = oGrid_event.record.data.paket_id;
		if(oGrid_event.record.data.paket_kode!== null){paket_kode_update = oGrid_event.record.data.paket_kode;}
		if(oGrid_event.record.data.paket_kodelama!== null){paket_kodelama_update = oGrid_event.record.data.paket_kodelama;}
		if(oGrid_event.record.data.paket_nama!== null){paket_nama_update = oGrid_event.record.data.paket_nama;}
		if(oGrid_event.record.data.paket_group!== null){paket_group_update = oGrid_event.record.data.paket_group;}
		if(oGrid_event.record.data.paket_keterangan!== null){paket_keterangan_update = oGrid_event.record.data.paket_keterangan;}
		if(oGrid_event.record.data.paket_du!== null){paket_du_update = oGrid_event.record.data.paket_du;}
		if(oGrid_event.record.data.paket_dm!== null){paket_dm_update = oGrid_event.record.data.paket_dm;}
		if(oGrid_event.record.data.paket_point!== null){paket_point_update = oGrid_event.record.data.paket_point;}
		if(oGrid_event.record.data.paket_harga!== null){paket_harga_update = oGrid_event.record.data.paket_harga;}
		if(oGrid_event.record.data.paket_expired!== null){paket_expired_update = oGrid_event.record.data.paket_expired;}
		if(oGrid_event.record.data.paket_perpanjangan!== null){paket_perpanjangan_update = oGrid_event.record.data.paket_perpanjangan;}
		if(oGrid_event.record.data.paket_aktif!== null){paket_aktif_update = oGrid_event.record.data.paket_aktif;}

		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_paket&m=get_action',
			params: {
				task: "UPDATE",
				paket_id	: paket_id_update_pk,
				paket_kode	:paket_kode_update,
				paket_kodelama	:paket_kodelama_update,
				paket_nama	:paket_nama_update,
				paket_group	:paket_group_update,
				paket_keterangan	:paket_keterangan_update,
				paket_du	:paket_du_update,
				paket_dm	:paket_dm_update,
				paket_point	:paket_point_update,
				paket_harga	:paket_harga_update,
				paket_expired	:paket_expired_update,
				paket_perpanjangan : paket_perpanjangan_update,
				paket_aktif	:paket_aktif_update,
			},
			success: function(response){
				var result=eval(response.responseText);
				switch(result){
					case 1:
						paket_DataStore.commitChanges();
						paket_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data Paket tidak bisa disimpan',
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
	function paket_create(){

		if(is_paket_form_valid()){
		var paket_id_create_pk=null;
		var paket_kode_create=null;
		var paket_kodelama_create=null;
		var paket_nama_create=null;
		var paket_group_create=null;
		var paket_keterangan_create=null;
		var paket_du_create=null;
		var paket_dm_create=null;
		var paket_point_create=null;
		var paket_harga_create=null;
		var paket_expired_create=null;
		var paket_perpanjangan_create=null;
		var paket_aktif_create=null;

		if(paket_idField.getValue()!== null){paket_id_create_pk = paket_idField.getValue();}else{paket_id_create_pk=get_pk_id();}
		if(paket_kodeField.getValue()!== null){paket_kode_create = paket_kodeField.getValue();}
		if(paket_kodelamaField.getValue()!== null){paket_kodelama_create = paket_kodelamaField.getValue();}
		if(paket_namaField.getValue()!== null){paket_nama_create = paket_namaField.getValue();}
		if(paket_groupField.getValue()!== null){paket_group_create = paket_groupField.getValue();}
		if(paket_keteranganField.getValue()!== null){paket_keterangan_create = paket_keteranganField.getValue();}
		if(paket_duField.getValue()!== null){paket_du_create = paket_duField.getValue();}
		if(paket_dmField.getValue()!== null){paket_dm_create = paket_dmField.getValue();}
		if(paket_pointField.getValue()!== null){paket_point_create = paket_pointField.getValue();}
		if(paket_hargaField.getValue()!== null){paket_harga_create = convertToNumber(paket_hargaField.getValue());}
		if(paket_expiredField.getValue()!== null){paket_expired_create = paket_expiredField.getValue();}
		if(paket_perpanjanganField.getValue()!== null){paket_perpanjangan_create = paket_perpanjanganField.getValue();}
		if(paket_aktifField.getValue()!== null){paket_aktif_create = paket_aktifField.getValue();}

		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_paket&m=get_action',
			params: {
				task: post2db,
				paket_id	: paket_id_create_pk,
				paket_kode	: paket_kode_create,
				paket_kodelama	: paket_kodelama_create,
				paket_nama	: paket_nama_create,
				paket_standart_tetap : paket_standart_tetapField.getValue(),
				paket_group	: paket_group_create,
				paket_keterangan	: paket_keterangan_create,
				paket_du	: paket_du_create,
				paket_dm	: paket_dm_create,
				paket_point	: paket_point_create,
				paket_harga	: paket_harga_create,
				paket_expired	: paket_expired_create,
				paket_perpanjangan : paket_perpanjangan_create,
				paket_aktif	: paket_aktif_create,
			},
			success: function(response){
				var result=eval(response.responseText);
				switch(result){
					case 1:
						paket_isi_produk_purge();
						paket_isi_perawatan_purge();
						Ext.MessageBox.alert(post2db+' OK','Data Paket berhasil disimpan');
						paket_DataStore.reload();
						paket_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data paket tidak bisa disimpan',
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
			return paketListEditorGrid.getSelectionModel().getSelected().get('paket_id');
		else if(post2db=='CREATE')
			return paket_idField.getValue();
		else
			return 0;
	}
	/* End of Function  */

	/* Reset form before loading */
	function paket_reset_form(){
		paket_idField.reset();
		paket_idField.setValue(null);
		paket_kodeField.reset();
		paket_kodeField.setValue(null);
		paket_kodelamaField.reset();
		paket_kodelamaField.setValue(null);
		paket_namaField.reset();
		paket_namaField.setValue(null);
		paket_standart_tetapField.reset();
		paket_standart_tetapField.setValue(null);
		paket_groupField.reset();
		paket_groupField.setValue(null);
		paket_keteranganField.reset();
		paket_keteranganField.setValue(null);
		paket_duField.reset();
		paket_duField.setValue(null);
		paket_dmField.reset();
		paket_dmField.setValue(null);
		paket_pointField.reset();
		paket_pointField.setValue(null);
		paket_hargaField.reset();
		paket_hargaField.setValue(null);
		paket_expiredField.reset();
		paket_expiredField.setValue(null);
		paket_perpanjanganField.reset();
		paket_perpanjanganField.setValue(null);
		paket_aktifField.reset();
		paket_aktifField.setValue(null);
		paket_kategoritxtField.reset();
		paket_kategoritxtField.setValue(null);
		paket_hargaField.setValue(0);
		
		paket_isi_perawatan_DataStore.load({params: { master_id: -1, start:0, limit: pageS}});
		paket_isi_produk_DataStore.load({params: { master_id: -1, start:0, limit: pageS}});

	}
 	/* End of Function */

	/* setValue to EDIT */
	function paket_set_form(){
		paket_idField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_id'));
		paket_kodeField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_kode'));
		paket_kodelamaField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_kodelama'));
		paket_namaField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_nama'));
		paket_standart_tetapField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_standart_tetap'));
		paket_groupField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_group'));
		paket_keteranganField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_keterangan'));
		paket_duField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_du'));
		paket_dmField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_dm'));
		paket_pointField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_point'));
		paket_hargaField.setValue(CurrencyFormatted(paketListEditorGrid.getSelectionModel().getSelected().get('paket_harga')));
		paket_expiredField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_expired'));
		paket_perpanjanganField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_perpanjangan'));
		paket_aktifField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('paket_aktif'));
		paket_kategoriField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('kategori_id'));
		paket_kategoritxtField.setValue(paketListEditorGrid.getSelectionModel().getSelected().get('kategori_nama'));

		cbo_rawat_listDataStore.load({params: {query: get_pk_id()}});
		cbo_produk_listDataStore.load({params: {query: get_pk_id()}});
		paket_isi_produk_DataStore.load({params: { master_id: get_pk_id(), start:0, limit: pageS}});
		paket_isi_perawatan_DataStore.load({params: { master_id: get_pk_id(), start:0, limit: pageS}});


	}
	/* End setValue to EDIT*/

	/* Function for Check if the form is valid */
	function is_paket_form_valid(){
		return (paket_namaField.isValid() && paket_groupField.isValid() );
	}
  	/* End of Function */

  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!paket_createWindow.isVisible()){


			post2db='CREATE';
			msg='created';
			paket_reset_form();

			paket_createWindow.show();
		} else {
			paket_createWindow.toFront();
		}
	}
  	/* End of Function */

  	/* Function for Delete Confirm */
	function paket_confirm_delete(){
		// only one paket is selected here
		if(paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', paket_delete);
		} else if(paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', paket_delete);
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
	function paket_confirm_update(){
		/* only one record is selected here */
		if(paketListEditorGrid.selModel.getCount() == 1) {


			post2db='UPDATE';
			msg='updated';
			paket_set_form();
			paket_createWindow.show();
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
	function paket_delete(btn){
		if(btn=='yes'){
			var selections = paketListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< paketListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.paket_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_paket&m=get_action',
				params: { task: "DELETE", ids:  encoded_array },
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							paket_DataStore.reload();
							break;
						default:
							Ext.MessageBox.show({
								title: 'Warning',
								msg: 'Data tidak bisa dihapus',
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
	paket_DataStore = new Ext.data.Store({
		id: 'paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_paket&m=get_action',
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'paket_id'
		},[
			{name: 'paket_id', type: 'int', mapping: 'paket_id'},
			{name: 'paket_kode', type: 'string', mapping: 'paket_kode'},
			{name: 'paket_kodelama', type: 'string', mapping: 'paket_kodelama'},
			{name: 'paket_nama', type: 'string', mapping: 'paket_nama'},
			{name: 'paket_standart_tetap', type: 'int', mapping: 'paket_standart_tetap'},
			{name: 'paket_group', type: 'string', mapping: 'group_nama'},
			{name: 'paket_keterangan', type: 'string', mapping: 'paket_keterangan'},
			{name: 'paket_du', type: 'int', mapping: 'paket_du'},
			{name: 'paket_dm', type: 'int', mapping: 'paket_dm'},
			{name: 'paket_point', type: 'int', mapping: 'paket_point'},
			{name: 'paket_harga', type: 'float', mapping: 'paket_harga'},
			{name: 'paket_expired', type: 'int', mapping: 'paket_expired'},
			{name: 'paket_perpanjangan', type: 'int', mapping: 'paket_perpanjangan'},
			{name: 'paket_aktif', type: 'string', mapping: 'paket_aktif'},
			{name: 'kategori_nama', type: 'string', mapping: 'kategori_nama'},
			{name: 'kategori_id', type: 'int', mapping: 'kategori_id'},
			{name: 'paket_creator', type: 'string', mapping: 'paket_creator'},
			{name: 'paket_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'paket_date_create'},
			{name: 'paket_update', type: 'string', mapping: 'paket_update'},
			{name: 'paket_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'paket_date_update'},
			{name: 'paket_revised', type: 'int', mapping: 'paket_revised'}
		]),
		sortInfo:{field: 'paket_id', direction: "DESC"}
	});
	/* End of Function */

	cbo_produk_satuanDataStore = new Ext.data.Store({
	id: 'cbo_produk_satuanDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_paket&m=get_satuan_list',
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
			{name: 'produk_satuan_value', type: 'int', mapping: 'satuan_id'},
			{name: 'produk_satuan_display', type: 'string', mapping: 'satuan_nama'}
		]),
	sortInfo:{field: 'produk_satuan_display', direction: "ASC"}
	});



	cbo_paket_groupDataStore = new Ext.data.Store({
	id: 'cbo_paket_groupDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_paket&m=get_group_paket_list',
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'group_id'
		},[
			{name: 'paket_group_value', type: 'int', mapping: 'group_id'},
			{name: 'paket_group_display', type: 'string', mapping: 'group_nama'},
			{name: 'paket_group_dupaket', type: 'int', mapping: 'group_dupaket'},
			{name: 'paket_group_dmpaket', type: 'int', mapping: 'group_dmpaket'},
			{name: 'paket_group_kategori_nama', type: 'string', mapping: 'kategori_nama'},
			{name: 'paket_group_kategori_id', type: 'int', mapping: 'kategori_id'}
		]),
	sortInfo:{field: 'paket_group_display', direction: "ASC"}
	});

//	cbo_paket_kategori_DataStore = new Ext.data.Store({
//		id: 'cbo_paket_kategori_DataStore',
//		proxy: new Ext.data.HttpProxy({
//			url: 'index.php?c=c_paket&m=get_kategori_paket_list',
//			method: 'POST'
//		}),
//		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
//		reader: new Ext.data.JsonReader({
//			root: 'results',
//			totalProperty: 'total',
//			id: 'kategori_id'
//		},[
//		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */
//			{name: 'paket_kategori_value', type: 'int', mapping: 'kategori_id'},
//			{name: 'paket_kategori_display', type: 'string', mapping: 'kategori_nama'}
//		]),
//		sortInfo:{field: 'paket_kategori_display', direction: "ASC"}
//	});

  	/* Function for Identify of Window Column Model */
	paket_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'paket_id',
			width: 70,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">' + 'Kode Lama' + '</div>',
			dataIndex: 'paket_kodelama',
			width: 120,	//150,
			sortable: true
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 20
          	})
			<?php } ?>
		},
		{
			header: '<div align="center">' + 'Kode Baru' + '</div>',
			dataIndex: 'paket_kode',
			width: 120,	//150,
			sortable: true,
			readOnly: true
		},
		{
			header: '<div align="center">' + 'Nama' + '</div>',
			dataIndex: 'paket_nama',
			width: 300,	//250,
			sortable: true
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 250
          	})
			<?php } ?>
		},
		{
			header: '<div align="center">' + 'Group 1' + '</div>',
			dataIndex: 'paket_group',
			width: 120,	//150,
			sortable: true
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_paket_groupDataStore,
				mode: 'local',
               	displayField: 'paket_group_display',
               	valueField: 'paket_group_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
			<?php } ?>
		},
		{
			header: '<div align="center">' + 'Jenis' + '</div>',
			dataIndex: 'kategori_nama',
			width: 120,	//150,
			sortable: true,
			editable: false,
			hidden: true
		},
		{
			header: '<div align="center">' + 'DU (%)' + '</div>',
			align: 'right',
			dataIndex: 'paket_du',
			width: 60,	//100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + '</span>';
			}
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
			<?php } ?>
		},
		{
			header: '<div align="center">' + 'DM (%)' + '</div>',
			align: 'right',
			dataIndex: 'paket_dm',
			width: 60,	//100,
			renderer: function(val){
				return '<span>' + val + '</span>';
			}
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
			<?php } ?>
		},
		{
			header: '<div align="center">' + 'Poin' + '</div>',
			align: 'right',
			dataIndex: 'paket_point',
			width: 60,	//100,
			sortable: true
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
			<?php } ?>
		},
		{
			header: '<div align="center">' + 'Harga (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'paket_harga',
			width: 100,	//150,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
			<?php } ?>
		},
		{
			header: '<div align="center">' + 'Exp. (hari)' + '</div>',
			align: 'right',
			dataIndex: 'paket_expired',
			width: 70,	//150,
			renderer: function(val){
				return '<span>' + val + '</span>';
			}
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 3,
				maskRe: /([0-9]+)$/
			})
			<?php } ?>
		},
		{
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'paket_aktif',
			width: 80,	//150,
			sortable: true
			<?php if(eregi('U',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['paket_aktif_value', 'paket_aktif_display'],
					data: [['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
					}),
				mode: 'local',
               	displayField: 'paket_aktif_display',
               	valueField: 'paket_aktif_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
			<?php } ?>
		},
		{
			header: 'Creator',
			dataIndex: 'paket_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		},
		{
			header: 'Create on',
			dataIndex: 'paket_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		},
		{
			header: 'Last Update by',
			dataIndex: 'paket_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		},
		{
			header: 'Last Update on',
			dataIndex: 'paket_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		},
		{
			header: 'Revised',
			dataIndex: 'paket_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);

	paket_ColumnModel.defaultSortable= true;
	/* End of Function */

	/* Declare DataStore and  show datagrid list */
	paketListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'paketListEditorGrid',
		el: 'fp_paket',
		title: 'Daftar Paket',
		autoHeight: true,
		store: paket_DataStore, // DataStore
		cm: paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 940,	//900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: paket_DataStore,
			displayInfo: true
		}),
		tbar: [
		<?php if(eregi('C',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
		{
			text: 'Add',
			tooltip: 'Add new record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: display_form_window
		}, '-',
		<?php } ?>
		<?php if(eregi('U|R',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
		{
			text: 'Edit',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: paket_confirm_update   // Confirm before updating
		}, '-',
		<?php } ?>
		<?php if(eregi('D',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
		{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled:true,
			handler: paket_confirm_delete   // Confirm before deleting
		}, '-',
		<?php } ?>
		{
			text: 'Adv Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window
		}, '-',
			new Ext.app.SearchField({
			store: paket_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						paket_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Simple search:'});
				Ext.get(this.id).set({qtip:'- (Aktif only)<br>- Kode Baru<br>- Nama<br>- Group 1<br>- Group 2<br>- Jenis'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: paket_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: paket_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: paket_print
		}
		]
	});
	paketListEditorGrid.render();
	/* End of DataStore */

	/* Create Context Menu */
	paket_ContextMenu = new Ext.menu.Menu({
		id: 'paket_ListEditorGridContextMenu',
		items: [
		<?php if(eregi('U|R',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
		{
			text: 'Edit', tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: paket_editContextMenu
		},
		<?php } ?>
		<?php if(eregi('D',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
		{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: paket_confirm_delete
		},
		<?php } ?>
		'-',
		{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: paket_print
		},
		{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: paket_export_excel
		}
		]
	});
	/* End of Declaration */

	/* Event while selected row via context menu */
	function onpaket_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		paket_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		paket_SelectedRow=rowIndex;
		paket_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */

	/* function for editing row via context menu */
	function paket_editContextMenu(){
		//paketListEditorGrid.startEditing(paket_SelectedRow,1);
		paket_confirm_update();
  	}
	/* End of Function */

	paketListEditorGrid.addListener('rowcontextmenu', onpaket_ListEditGridContextMenu);
	//paket_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	paketListEditorGrid.on('afteredit', paket_update); // inLine Editing Record

	/* Identify  paket_id Field */
	paket_idField= new Ext.form.NumberField({
		id: 'paket_idField',
		allowNegatife : false,
		allowBlank: true,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_kode Field */
	paket_kodeField= new Ext.form.TextField({
		id: 'paket_kodeField',
		fieldLabel: 'Kode Baru',
		maxLength: 20,
		allowBlank: true,
		readOnly: true,
		emptyText: '(auto)',
		width: 100
	});
	/* Identify  paket_kodelama Field */
	paket_kodelamaField= new Ext.form.TextField({
		id: 'paket_kodelamaField',
		fieldLabel: 'Kode Lama',
		maxLength: 20,
		allowBlank: true,
		width: 100
	});
	/* Identify  paket_nama Field */
	paket_namaField= new Ext.form.TextField({
		id: 'paket_namaField',
		fieldLabel: 'Nama <span style="color: #ec0000">*</span>',
		maxLength: 250,
		allowBlank: false,
		anchor: '95%'
	});

	/* Identify Paket standart Tetap*/
	paket_standart_tetapField=new Ext.form.Checkbox({
		id : 'paket_standart_tetapField',
		boxLabel: 'Paket Standart Tetap?',
		name: 'paket_standart_tetap'
	});

	/* Identify  paket_group Field */
	paket_groupField= new Ext.form.ComboBox({
		id: 'paket_groupField',
		fieldLabel: 'Group 1 <span style="color: #ec0000">*</span>',
		typeAhead: true,
		triggerAction: 'all',
		store: cbo_paket_groupDataStore,
		mode: 'remote',
		editable:false,
		displayField: 'paket_group_display',
		valueField: 'paket_group_value',
		lazyRender:true,
		allowBlank: false,
		width: 120,
		listClass: 'x-combo-list-small'
	});
	/* Identify  produk_kategori Field */
	paket_kategoriField= new Ext.form.NumberField();
	paket_kategoritxtField= new Ext.form.TextField({
		id: 'paket_kategoritxtField',
		fieldLabel: 'Jenis',
		disabled: true,
		width: 120
	});
	/* Identify  paket_keterangan Field */
	paket_keteranganField= new Ext.form.TextArea({
		id: 'paket_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  paket_du Field */
	paket_duField= new Ext.form.NumberField({
		id: 'paket_duField',
		name: 'paket_duField',
		fieldLabel: 'Diskon Umum (%)',
		allowNegatife : false,
		emptyText: '0',
		allowBlank: true,
		allowDecimals: false,
		maxLength: 3,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_dm Field */
	paket_dmField= new Ext.form.NumberField({
		id: 'paket_dmField',
		name: 'paket_dmField',
		fieldLabel: 'Diskon Member (%)',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowBlank: true,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_point Field */
	paket_pointField= new Ext.form.NumberField({
		id: 'paket_pointField',
		name: 'paket_pointField',
		fieldLabel: 'Poin (x)',
		allowNegatife : false,
		emptyText: '1',
		maxLength: 11,
		allowBlank: true,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_harga Field */
	paket_hargaField= new Ext.form.TextField({
		id: 'paket_hargaField',
		name: 'paket_hargaField',
		fieldLabel: 'Harga Jual (Rp.)',
		maxLength: 12,
		valueRenderer: 'numberToCurrency',
		itemCls: 'rmoney',
		width: 120,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_expired Field */
	paket_expiredField= new Ext.form.NumberField({
		id: 'paket_expiredField',
		name: 'paket_expiredField',
		fieldLabel: 'Kadaluarsa (hari) [0=unlimited]',
		allowNegatife : false,
		emptyText: '365',
		maxLength: 3,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});

	/* Identify  paket_perpanjangan Field */
	paket_perpanjanganField= new Ext.form.NumberField({
		id: 'paket_perpanjanganField',
		name: 'paket_perpanjanganField',
		fieldLabel: 'Perpanjangan (hari)',
		allowNegatife : false,
		emptyText: '365',
		maxLength: 3,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});

	/* Identify  paket_aktif Field */
	paket_aktifField= new Ext.form.ComboBox({
		id: 'paket_aktifField',
		name: 'paket_aktifField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['paket_aktif_value', 'paket_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		editable:false,
		emptyText: 'Aktif',
		displayField: 'paket_aktif_display',
		valueField: 'paket_aktif_value',
		//anchor: '30%',
		width: 80,
		triggerAction: 'all'
	});

	paket_groupField.on('select', function(){
		var record=cbo_paket_groupDataStore.findExact('paket_group_value', paket_groupField.getValue(),0);
		if(cbo_paket_groupDataStore.getCount()){
			paket_duField.setValue(cbo_paket_groupDataStore.getAt(record).data.paket_group_dupaket);
			paket_dmField.setValue(cbo_paket_groupDataStore.getAt(record).data.paket_group_dmpaket);
			paket_kategoritxtField.setValue(cbo_paket_groupDataStore.getAt(record).data.paket_group_kategori_nama);
			paket_kategoriField.setValue(cbo_paket_groupDataStore.getAt(record).data.paket_group_kategori_id);
		}
	});

  	/*Fieldset Master*/
	paket_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth: 0.5,
				layout: 'form',
				labelWidth: 120,
				border:false,
				items: [paket_kodelamaField, paket_kodeField, paket_namaField, paket_standart_tetapField, paket_groupField, paket_hargaField, paket_duField, paket_dmField]
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [paket_expiredField, paket_perpanjanganField, paket_pointField, paket_keteranganField, paket_aktifField,paket_idField]
			}
			]

	});


	/*Detail Declaration */

	// Function for json reader of detail
	var paket_isi_perawatan_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'rpaket_id'
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */
			{name: 'rpaket_id', type: 'int', mapping: 'rpaket_id'},
			{name: 'rpaket_master', type: 'int', mapping: 'rpaket_master'},
			{name: 'rpaket_perawatan', type: 'int', mapping: 'rpaket_perawatan'},
			{name: 'rpaket_jumlah', type: 'int', mapping: 'rpaket_jumlah'}
	]);
	//eof

	//function for json writer of detail
	var paket_isi_perawatan_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof

	/* Function for Retrieve DataStore of detail*/
	paket_isi_perawatan_DataStore = new Ext.data.Store({
		id: 'paket_isi_perawatan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_paket&m=detail_paket_isi_perawatan_list',
			method: 'POST'
		}),
		reader: paket_isi_perawatan_reader,
		baseParams:{master_id: get_pk_id(), start:0, limit: pageS },
		sortInfo:{field: 'rpaket_id', direction: "ASC"}
	});
	/* End of Function */
	paket_isi_perawatan_DataStore.load({params: { master_id: get_pk_id(), start:0, limit: pageS}});

	//function for editor of detail
	var editor_paket_isi_perawatan= new Ext.ux.grid.RowEditor({
        saveText: 'Update',
		listeners: {
			afteredit: function(){
				paket_isi_perawatan_DataStore.commitChanges();
			}
		}
    });
	//eof
	/*
	cbo_produk_listDataStore = new Ext.data.Store({
	id: 'cbo_produk_listDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_paket&m=get_produk_list',
			method: 'POST'
		}), baseParams: {start: 0, limit: pageS},
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'produk_id', type: 'int', mapping: 'produk_id'},
			{name: 'produk_kode', type: 'string', mapping: 'produk_kode'},
			{name: 'produk_satuan', type: 'string', mapping: 'satuan_kode'},
			{name: 'produk_group', type: 'string', mapping: 'group_nama'},
			{name: 'produk_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'produk_nama', type: 'string', mapping: 'produk_nama'}
		]),
	sortInfo:{field: 'produk_nama', direction: "ASC"}
	});*/

	cbo_produk_listDataStore = new Ext.data.Store({
		id: 'cbo_produk_listDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_paket&m=get_produk_list',
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


	cbo_rawat_listDataStore = new Ext.data.Store({
		id: 'cbo_rawat_listDataStore',
		proxy: new Ext.data.HttpProxy({
				url: 'index.php?c=c_paket&m=get_rawat_list',
				method: 'POST'
			}), baseParams: {start: 0, limit: pageS},
				reader: new Ext.data.JsonReader({
				root: 'results',
				totalProperty: 'total',
				id: 'rawat_id'
			},[
			/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */
				{name: 'rawat_id', type: 'int', mapping: 'rawat_id'},
				{name: 'rawat_kode', type: 'string', mapping: 'rawat_kode'},
				{name: 'rawat_nama', type: 'string', mapping: 'rawat_nama'}
			]),
		sortInfo:{field: 'rawat_nama', direction: "ASC"}
	});


	var paket_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{dproduk_produk_kode}| <b>{dproduk_produk_display}</b></span>',
		'</div></tpl>'
    );

	var paket_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{rawat_kode}| <b>{rawat_nama}</b></span>',
		'</div></tpl>'
    );

	Ext.util.Format.comboRenderer = function(combo){
		cbo_rawat_listDataStore.load();
		cbo_produk_listDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}

	var combo_paket_produk=new Ext.form.ComboBox({
			store: cbo_produk_listDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dproduk_produk_display',
			valueField: 'dproduk_produk_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: paket_produk_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});

	var combo_paket_rawat=new Ext.form.ComboBox({
			store: cbo_rawat_listDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'rawat_nama',
			valueField: 'rawat_id',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: paket_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});

	//function of detail add
	function paket_isi_perawatan_add(){
		var edit_paket_isi_perawatan= new paket_isi_perawatanListEditorGrid.store.recordType({
			rpaket_id		:'',
			rpaket_master	:'',
			rpaket_perawatan:null,
			rpaket_jumlah	:1
		});
		editor_paket_isi_perawatan.stopEditing();
		paket_isi_perawatan_DataStore.insert(0, edit_paket_isi_perawatan);
		paket_isi_perawatanListEditorGrid.getView().refresh();
		paket_isi_perawatanListEditorGrid.getSelectionModel().selectRow(0);
		editor_paket_isi_perawatan.startEditing(0);
	}
	//eof

	//declaration of detail coloumn model
	paket_isi_perawatan_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			align : 'Left',
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'rpaket_perawatan',
			width: 150,
			sortable: true,
			editor: combo_paket_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_paket_rawat)
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'rpaket_jumlah',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				//blankText: '1',
				//emptyText: '1',
				maxLength: 3,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	paket_isi_perawatan_ColumnModel.defaultSortable= true;
	//eof



	//declaration of detail list editor grid
	paket_isi_perawatanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'paket_isi_perawatanListEditorGrid',
		el: 'fp_paket_isi_perawatan',
		title: 'Detail Paket Isi Perawatan',
		height: 250,
		width: 690,
		autoScroll: true,
		store: paket_isi_perawatan_DataStore, // DataStore
		colModel: paket_isi_perawatan_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_paket_isi_perawatan],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		<?php if(eregi('U|C',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: paket_isi_perawatan_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: paket_isi_perawatan_confirm_delete
		}
		]
		<?php } ?>
	});
	//eof
	//function for insert detail
	function paket_isi_perawatan_insert(){
		for(i=0;i<paket_isi_perawatan_DataStore.getCount();i++){
			paket_isi_perawatan_record=paket_isi_perawatan_DataStore.getAt(i);
			if(paket_isi_perawatan_record.rpaket_perawatan!=="" && paket_isi_perawatan_record.rpaket_perawatan!==null){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_paket&m=detail_paket_isi_perawatan_insert',
					params:{
					rpaket_id	: paket_isi_perawatan_record.data.rpaket_id,
					rpaket_master	: get_pk_id(),
					rpaket_perawatan	: paket_isi_perawatan_record.data.rpaket_perawatan,
					rpaket_jumlah	: paket_isi_perawatan_record.data.rpaket_jumlah
					}
				});
			}
		}
	}
	//eof

	//function for purge detail
	function paket_isi_perawatan_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_paket&m=detail_paket_isi_perawatan_purge',
			params:{ master_id: get_pk_id() },
			timeout: 5000,
			success: function(response){
				var result=eval(response.responseText);
				paket_isi_perawatan_insert();
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
	//eof

	/* Function for Delete Confirm of detail */
	function paket_isi_perawatan_confirm_delete(){
		// only one record is selected here
		if(paket_isi_perawatanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data berikut?', paket_isi_perawatan_delete);
		} else if(paket_isi_perawatanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data-data berikut?', paket_isi_perawatan_delete);
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
	function paket_isi_perawatan_delete(btn){
		if(btn=='yes'){
			var s = paket_isi_perawatanListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				paket_isi_perawatan_DataStore.remove(r);
			}
		}
		paket_isi_perawatan_DataStore.commitChanges();
	}
	//eof
	// EOF DETAIL

	/*Detail Declaration of detail produk*/
	// Function for json reader of detail
	var paket_isi_produk_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
			{name: 'ipaket_id', type: 'int', mapping: 'ipaket_id'},
			{name: 'ipaket_master', type: 'int', mapping: 'ipaket_master'},
			{name: 'ipaket_produk', type: 'int', mapping: 'ipaket_produk'},
			{name: 'ipaket_satuan', type: 'string', mapping: 'satuan_kode'},
			{name: 'produk_nama', type: 'string', mapping: 'produk_nama'},
			{name: 'ipaket_jumlah', type: 'float', mapping: 'ipaket_jumlah'}
	]);
	//eof

	//function for json writer of detail
	var paket_isi_produk_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof

	/* Function for Retrieve DataStore of detail*/
	paket_isi_produk_DataStore = new Ext.data.Store({
		id: 'paket_isi_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_paket&m=detail_paket_isi_produk_list',
			method: 'POST'
		}),
		reader: paket_isi_produk_reader,
		baseParams:{start:0, limit: pageS},
		sortInfo:{field: 'ipaket_id', direction: "ASC"}
	});
	/* End of Function */

	//function for editor of detail
	var editor_paket_isi_produk= new Ext.ux.grid.RowEditor({
        saveText: 'Update',
		listeners: {
			afteredit: function(){
				paket_isi_produk_DataStore.commitChanges();
			}
		}
    });
	//eof

	//function of detail add
	function paket_isi_produk_add(){
		var edit_paket_isi_produk= new paket_isi_produkListEditorGrid.store.recordType({
			ipaket_id	:'',
			ipaket_master	: null,
			ipaket_produk	: null,
			ipaket_jumlah	: null
		});
		editor_paket_isi_produk.stopEditing();
		paket_isi_produk_DataStore.insert(0, edit_paket_isi_produk);
		paket_isi_produkListEditorGrid.getView().refresh();
		paket_isi_produkListEditorGrid.getSelectionModel().selectRow(0);
		editor_paket_isi_produk.startEditing(0);
	}

	//declaration of detail coloumn model
	paket_isi_produk_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			align : 'Left',
			header: '<div align="center">' + 'Produk' + '</div>',
			dataIndex: 'ipaket_produk',
			width: 250,
			sortable: false,
			allowBlank : false,
			editor: combo_paket_produk,
			renderer: Ext.util.Format.comboRenderer(combo_paket_produk)
		},
		{
			align : 'Left',
			header: '<div align="center">' + 'Satuan' + '</div>',
			dataIndex: 'ipaket_satuan',
			width: 100,
			sortable: true,
			renderer: function(v, params, record){
				j=cbo_produk_listDataStore.findExact('produk_id',record.data.ipaket_produk,0);
				if(j>-1)
					return cbo_produk_listDataStore.getAt(j).data.produk_satuan;
			}
		},
		{
			align : 'Right',
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'ipaket_jumlah',
			width: 100,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				//blankText: '1',
				maxLength: 3
				//maskRe: /([0-9]+)$/
			})
		}]
	);
	paket_isi_produk_ColumnModel.defaultSortable= true;
	//eof

	//declaration of detail list editor grid
	paket_isi_produkListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'paket_isi_produkListEditorGrid',
		el: 'fp_paket_isi_produk',
		title: 'Detail Paket Isi produk',
		height: 250,
		width: 690,
		autoScroll: true,
		store: paket_isi_produk_DataStore, // DataStore
		colModel: paket_isi_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_paket_isi_produk],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		<?php if(eregi('U|C',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: paket_isi_produk_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: paket_isi_produk_confirm_delete
		}
		]
		<?php } ?>
	});
	//eof


	//function for purge detail
	function paket_isi_produk_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_paket&m=detail_paket_isi_produk_purge',
			params:{ master_id: get_pk_id() },
			timeout: 5000,
			success: function(response){
				var result=eval(response.responseText);
				paket_isi_produk_insert();
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
	//eof

	//function for insert detail
	function paket_isi_produk_insert(){
		for(i=0;i<paket_isi_produk_DataStore.getCount();i++){
			paket_isi_produk_record=paket_isi_produk_DataStore.getAt(i);
			if(paket_isi_produk_record.data.ipaket_produk!=="" && paket_isi_produk_record.data.ipaket_produk!==null){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_paket&m=detail_paket_isi_produk_insert',
					params:{
					ipaket_master	: get_pk_id(),
					ipaket_produk	: paket_isi_produk_record.data.ipaket_produk,
					ipaket_satuan	: paket_isi_produk_record.data.ipaket_satuan,
					ipaket_jumlah	: paket_isi_produk_record.data.ipaket_jumlah
					}
				});
			}
		}
	}
	//eof

	/* Function for Delete Confirm of detail */
	function paket_isi_produk_confirm_delete(){
		// only one record is selected here
		if(paket_isi_produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data berikut?', paket_isi_produk_delete);
		} else if(paket_isi_produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Apakah Anda yakin akan menghapus data-data berikut?', paket_isi_produk_delete);
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
	function paket_isi_produk_delete(btn){
		if(btn=='yes'){
			var s = paket_isi_produkListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				paket_isi_produk_DataStore.remove(r);
			}
		}
		paket_isi_produk_DataStore.commitChanges();
	}
	//eof


	var detail_tab_paket = new Ext.TabPanel({
		activeTab: 0,
		items: [paket_isi_perawatanListEditorGrid,paket_isi_produkListEditorGrid]
	});


	/* Function for retrieve create Window Panel*/
	paket_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,
		items: [paket_masterGroup,detail_tab_paket],
		buttons: [
			<?php if(eregi('U|C',$this->m_security->get_access_group_by_kode('MENU_PAKET'))){ ?>
			{
				text: 'Save and Close',
				handler: paket_create
			}
			,
			<?php } ?>
			{
				text: 'Cancel',
				handler: function(){
					paket_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/

	/* Function for retrieve create Window Form */
	paket_createWindow= new Ext.Window({
		id: 'paket_createWindow',
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
		renderTo: 'elwindow_paket_create',
		items: paket_createForm
	});
	/* End Window */

	/* Function for action list search */
	function paket_list_search(){
		// render according to a SQL date format.
		var paket_id_search=null;
		var paket_kode_search=null;
		var paket_kodelama_search=null;
		var paket_nama_search=null;
		var paket_group_search=null;
		var paket_keterangan_search=null;
		var paket_du_search=null;
		var paket_dm_search=null;
		var paket_point_search=null;
		var paket_harga_search=null;
		var paket_expired_search=null;
		var paket_aktif_search=null;

		if(paket_idSearchField.getValue()!==null){paket_id_search=paket_idSearchField.getValue();}
		if(paket_kodeSearchField.getValue()!==null){paket_kode_search=paket_kodeSearchField.getValue();}
		if(paket_kodelamaSearchField.getValue()!==null){paket_kodelama_search=paket_kodelamaSearchField.getValue();}
		if(paket_namaSearchField.getValue()!==null){paket_nama_search=paket_namaSearchField.getValue();}
		if(paket_groupSearchField.getValue()!==null){paket_group_search=paket_groupSearchField.getValue();}
		if(paket_keteranganSearchField.getValue()!==null){paket_keterangan_search=paket_keteranganSearchField.getValue();}
		if(paket_duSearchField.getValue()!==null){paket_du_search=paket_duSearchField.getValue();}
		if(paket_dmSearchField.getValue()!==null){paket_dm_search=paket_dmSearchField.getValue();}
		if(paket_pointSearchField.getValue()!==null){paket_point_search=paket_pointSearchField.getValue();}
		if(paket_hargaSearchField.getValue()!==null){paket_harga_search=paket_hargaSearchField.getValue();}
		if(paket_expiredSearchField.getValue()!==null){paket_expired_search=paket_expiredSearchField.getValue();}
		if(paket_aktifSearchField.getValue()!==null){paket_aktif_search=paket_aktifSearchField.getValue();}
		// change the store parameters
		paket_DataStore.baseParams = {
			task: 'SEARCH',
			start: 0,
			limit: pageS,
			//variable here
			paket_id	:	paket_id_search,
			paket_kode	:	paket_kode_search,
			paket_kodelama	:	paket_kodelama_search,
			paket_nama	:	paket_nama_search,
			paket_group	:	paket_group_search,
			paket_keterangan	:	paket_keterangan_search,
			paket_du	:	paket_du_search,
			paket_dm	:	paket_dm_search,
			paket_point	:	paket_point_search,
			paket_harga	:	paket_harga_search,
			paket_expired	:	paket_expired_search,
			paket_aktif	:	paket_aktif_search,
		};
		// Cause the datastore to do another query :
		paket_DataStore.reload({params: {start: 0, limit: pageS}});
	}

	/* Function for reset search result */
	function paket_reset_search(){
		// reset the store parameters
		paket_DataStore.baseParams = { task: 'LIST',start:0,limit:pageS };
		// Cause the datastore to do another query :
		paket_DataStore.reload({params: {start: 0, limit: pageS}});
		paket_searchWindow.close();
	};
	/* End of Fuction */

	function paket_reset_SearchForm(){
		paket_idSearchField.reset();
		paket_idSearchField.setValue(null);
		paket_kodeSearchField.reset();
		paket_kodeSearchField.setValue(null);
		paket_kodelamaSearchField.reset();
		paket_kodelamaSearchField.setValue(null);
		paket_namaSearchField.reset();
		paket_namaSearchField.setValue(null);
		paket_groupSearchField.reset();
		paket_groupSearchField.setValue(null);
		paket_keteranganSearchField.reset();
		paket_keteranganSearchField.setValue(null);
		paket_duSearchField.reset();
		paket_duSearchField.setValue(null);
		paket_dmSearchField.reset();
		paket_dmSearchField.setValue(null);
		paket_pointSearchField.reset();
		paket_pointSearchField.setValue(null);
		paket_hargaSearchField.reset();
		paket_hargaSearchField.setValue(null);
		paket_expiredSearchField.reset();
		paket_expiredSearchField.setValue(null);
		paket_aktifSearchField.reset();
		paket_aktifSearchField.setValue(null);
	}

	/* Field for search */
	/* Identify  paket_id Field */
	paket_idSearchField= new Ext.form.NumberField({
		id: 'paket_idSearchField',
		allowNegatife : false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_kode Field */
	paket_kodeSearchField= new Ext.form.TextField({
		id: 'paket_kodeSearchField',
		fieldLabel: 'Kode Baru',
		maxLength: 20,
		readOnly: false,
//		emptyText: '(auto)',
		width: 100
	});
	/* Identify  paket_kodelama Field */
	paket_kodelamaSearchField= new Ext.form.TextField({
		id: 'paket_kodelamaSearchField',
		fieldLabel: 'Kode Lama',
		maxLength: 20,
		width: 100
	});
	/* Identify  paket_nama Field */
	paket_namaSearchField= new Ext.form.TextField({
		id: 'paket_namaSearchField',
		fieldLabel: 'Nama ',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  paket_group Field */
	paket_groupSearchField= new Ext.form.ComboBox({
		id: 'paket_groupSearchField',
		fieldLabel: 'Group 1 ',
		typeAhead: true,
		triggerAction: 'all',
		store: cbo_paket_groupDataStore,
		mode: 'remote',
		displayField: 'paket_group_display',
		valueField: 'paket_group_value',
		lazyRender:true,
		width: 120,
		listClass: 'x-combo-list-small'
	});
	/* Identify  produk_kategori Field */
//	paket_kategoriSearchField= new Ext.form.ComboBox({
//		id: 'paket_kategoriSearchField',
//		fieldLabel: 'Jenis <span style="color: #ec0000">*</span>',
//		store: cbo_paket_kategori_DataStore,
//		mode: 'remote',
//		displayField: 'paket_kategori_display',
//		valueField: 'paket_kategori_value',
//		width: 120,
//		triggerAction: 'all'
//	});
	/* Identify  paket_keterangan Field */
	paket_keteranganSearchField= new Ext.form.TextArea({
		id: 'paket_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  paket_du Field */
	paket_duSearchField= new Ext.form.NumberField({
		id: 'paket_duSearchField',
		fieldLabel: 'Diskon Umum (%)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		maxLength: 3,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_dm Field */
	paket_dmSearchField= new Ext.form.NumberField({
		id: 'paket_dmSearchField',
		fieldLabel: 'Diskon Member (%)',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_point Field */
	paket_pointSearchField= new Ext.form.NumberField({
		id: 'paket_pointSearchField',
		fieldLabel: 'Point',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 11,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_harga Field */
	paket_hargaSearchField= new Ext.form.TextField({
		id: 'paket_hargaSearchField',
		fieldLabel: 'Harga Jual (Rp.)',
		valueRenderer: 'numberToCurrency',
		itemCls: 'rmoney',
		emptyText: '0',
		maxLength: 12,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_expired Field */
	paket_expiredSearchField= new Ext.form.NumberField({
		id: 'paket_expiredSearchField',
		fieldLabel: 'Kadaluarsa (hari) [0=unlimited]',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  paket_aktif Field */
	paket_aktifSearchField= new Ext.form.ComboBox({
		id: 'paket_aktifSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['paket_aktif_value', 'paket_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		emptyText: 'Aktif',
		displayField: 'paket_aktif_display',
		valueField: 'paket_aktif_value',
		//anchor: '30%',
		width: 80,
		triggerAction: 'all'
	});

	/* Function for retrieve search Form Panel */
	paket_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 600,
		items: [{
			layout:'column',
			border:false,
			items:[
					{
						columnWidth: 0.5,
						layout: 'form',
						border:false,
						items: [paket_kodelamaSearchField, paket_kodeSearchField, paket_namaSearchField, paket_groupSearchField, paket_hargaSearchField, paket_duSearchField, paket_dmSearchField]
					}
					,{
						columnWidth:0.5,
						layout: 'form',
						border:false,
						items: [paket_expiredSearchField, paket_pointSearchField, paket_keteranganSearchField, paket_aktifSearchField,paket_idSearchField]
					}
					]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: paket_list_search
			},{
				text: 'Close',
				handler: function(){
					paket_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */

	/* Function for retrieve search Window Form, used for andvaced search */
	paket_searchWindow = new Ext.Window({
		title: 'Pencarian Paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_paket_search',
		items: paket_searchForm
	});
    /* End of Function */

  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!paket_searchWindow.isVisible()){
			paket_reset_SearchForm();
			paket_searchWindow.show();
		} else {
			paket_searchWindow.toFront();
		}
	}
  	/* End Function */

	/* Function for print List Grid */
	function paket_print(){
		var searchquery = "";
		var paket_kode_print=null;
		var paket_kodelama_print=null;
		var paket_nama_print=null;
		var paket_group_print=null;
		var paket_keterangan_print=null;
		var paket_du_print=null;
		var paket_dm_print=null;
		var paket_point_print=null;
		var paket_harga_print=null;
		var paket_expired_print=null;
		var paket_aktif_print=null;
		var win;
		// check if we do have some search data...
		if(paket_DataStore.baseParams.query!==null){searchquery = paket_DataStore.baseParams.query;}
		if(paket_DataStore.baseParams.paket_kode!==null){paket_kode_print = paket_DataStore.baseParams.paket_kode;}
		if(paket_DataStore.baseParams.paket_kodelama!==null){paket_kodelama_print = paket_DataStore.baseParams.paket_kodelama;}
		if(paket_DataStore.baseParams.paket_nama!==null){paket_nama_print = paket_DataStore.baseParams.paket_nama;}
		if(paket_DataStore.baseParams.paket_group!==null){paket_group_print = paket_DataStore.baseParams.paket_group;}
		if(paket_DataStore.baseParams.paket_keterangan!==null){paket_keterangan_print = paket_DataStore.baseParams.paket_keterangan;}
		if(paket_DataStore.baseParams.paket_du!==null){paket_du_print = paket_DataStore.baseParams.paket_du;}
		if(paket_DataStore.baseParams.paket_dm!==null){paket_dm_print = paket_DataStore.baseParams.paket_dm;}
		if(paket_DataStore.baseParams.paket_point!==null){paket_point_print = paket_DataStore.baseParams.paket_point;}
		if(paket_DataStore.baseParams.paket_harga!==null){paket_harga_print = paket_DataStore.baseParams.paket_harga;}
		if(paket_DataStore.baseParams.paket_expired!==null){paket_expired_print = paket_DataStore.baseParams.paket_expired;}
		if(paket_DataStore.baseParams.paket_aktif!==null){paket_aktif_print = paket_DataStore.baseParams.paket_aktif;}

		Ext.Ajax.request({
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_paket&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			paket_kode : paket_kode_print,
			paket_kodelama : paket_kodelama_print,
			paket_nama : paket_nama_print,
			paket_group : paket_group_print,
			paket_keterangan : paket_keterangan_print,
			paket_du : paket_du_print,
			paket_dm : paket_dm_print,
			paket_point : paket_point_print,
			paket_harga : paket_harga_print,
			paket_expired : paket_expired_print,
			paket_aktif : paket_aktif_print,
		  	currentlisting: paket_DataStore.baseParams.task // this tells us if we are searching or not
		},
		success: function(response){
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./paketlist.html','paketlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');

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
	function paket_export_excel(){
		var searchquery = "";
		var paket_kode_2excel=null;
		var paket_kodelama_2excel=null;
		var paket_nama_2excel=null;
		var paket_group_2excel=null;
		var paket_keterangan_2excel=null;
		var paket_du_2excel=null;
		var paket_dm_2excel=null;
		var paket_point_2excel=null;
		var paket_harga_2excel=null;
		var paket_expired_2excel=null;
		var paket_aktif_2excel=null;
		var win;
		// check if we do have some search data...
		if(paket_DataStore.baseParams.query!==null){searchquery = paket_DataStore.baseParams.query;}
		if(paket_DataStore.baseParams.paket_kode!==null){paket_kode_2excel = paket_DataStore.baseParams.paket_kode;}
		if(paket_DataStore.baseParams.paket_kodelama!==null){paket_kodelama_2excel = paket_DataStore.baseParams.paket_kodelama;}
		if(paket_DataStore.baseParams.paket_nama!==null){paket_nama_2excel = paket_DataStore.baseParams.paket_nama;}
		if(paket_DataStore.baseParams.paket_group!==null){paket_group_2excel = paket_DataStore.baseParams.paket_group;}
		if(paket_DataStore.baseParams.paket_keterangan!==null){paket_keterangan_2excel = paket_DataStore.baseParams.paket_keterangan;}
		if(paket_DataStore.baseParams.paket_du!==null){paket_du_2excel = paket_DataStore.baseParams.paket_du;}
		if(paket_DataStore.baseParams.paket_dm!==null){paket_dm_2excel = paket_DataStore.baseParams.paket_dm;}
		if(paket_DataStore.baseParams.paket_point!==null){paket_point_2excel = paket_DataStore.baseParams.paket_point;}
		if(paket_DataStore.baseParams.paket_harga!==null){paket_harga_2excel = paket_DataStore.baseParams.paket_harga;}
		if(paket_DataStore.baseParams.paket_expired!==null){paket_expired_2excel = paket_DataStore.baseParams.paket_expired;}
		if(paket_DataStore.baseParams.paket_aktif!==null){paket_aktif_2excel = paket_DataStore.baseParams.paket_aktif;}

		Ext.Ajax.request({
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_paket&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			paket_kode : paket_kode_2excel,
			paket_kodelama : paket_kodelama_2excel,
			paket_nama : paket_nama_2excel,
			paket_group : paket_group_2excel,
			paket_keterangan : paket_keterangan_2excel,
			paket_du : paket_du_2excel,
			paket_dm : paket_dm_2excel,
			paket_point : paket_point_2excel,
			paket_harga : paket_harga_2excel,
			paket_expired : paket_expired_2excel,
			paket_aktif : paket_aktif_2excel,
		  	currentlisting: paket_DataStore.baseParams.task // this tells us if we are searching or not
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

	paket_hargaField.on('focus',function(){ paket_hargaField.setValue(convertToNumber(paket_hargaField.getValue())); });
	paket_hargaField.on('blur',function(){ paket_hargaField.setValue(CurrencyFormatted(paket_hargaField.getValue())); });

});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_paket"></div>
         <div id="fp_paket_isi_perawatan"></div>
         <div id="fp_paket_isi_produk"></div>
		<div id="elwindow_paket_create"></div>
        <div id="elwindow_paket_search"></div>
    </div>
</div>
</body>