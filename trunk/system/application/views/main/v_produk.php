<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: produk View
	+ Description	: For record view
	+ Filename 		: v_produk.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:29:05
	
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
var produk_DataStore;
var produk_ColumnModel;
var produkListEditorGrid;
var produk_createForm;
var produk_createWindow;
var produk_searchForm;
var produk_searchWindow;
var produk_SelectedRow;
var produk_ContextMenu;
//for detail data
var satuan_konversi_DataStore;
var satuan_konversiListEditorGrid;
var satuan_konversi_ColumnModel;
var satuan_konversi_proxy;
var satuan_konversi_writer;
var satuan_konversi_reader;
var editor_satuan_konversi;

//declare konstant
var post2db = '';
var msg = '';
//var pageS=15;

/* declare variable here for Field*/
var produk_idField;
var produk_kodeField;
var produk_kodelamaField;
var produk_groupField;
var produk_kategoriField;
var produk_kontribusiField;
var produk_jenisField;
var produk_namaField;
var produk_satuanField;
var produk_duField;
var produk_dmField;
var produk_pointField;
var produk_volumeField;
var produk_hargaField;
var produk_keteranganField;
var produk_aktifField;

var produk_idSearchField;
var produk_kodeSearchField;
var produk_kodelamaSearchField;
var produk_groupSearchField;
var produk_kategoriSearchField;
var produk_kontribusiField;
var produk_jenisSearchField;
var produk_namaSearchField;
var produk_satuanSearchField;
var produk_duSearchField;
var produk_dmSearchField;
var produk_pointSearchField;
var produk_volumeSearchField;
var produk_hargaSearchField;
var produk_keteranganSearchField;
var produk_aktifSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function produk_update(oGrid_event){
		var produk_id_update_pk="";
		var produk_kode_update=null;
		var produk_kodelama_update=null;
		var produk_group_update=null;
		var produk_kategori_update=null;
		var produk_kontribusi_update=null;
		var produk_jenis_update=null;
		var produk_nama_update=null;
		var produk_satuan_update=null;
		var produk_du_update=null;
		var produk_dm_update=null;
		var produk_point_update=null;
		var produk_volume_update=null;
		var produk_harga_update=null;
		var produk_keterangan_update=null;
		var produk_aktif_update=null;

		produk_id_update_pk = oGrid_event.record.data.produk_id;
		if(oGrid_event.record.data.produk_kode!== null){produk_kode_update = oGrid_event.record.data.produk_kode;}
		if(oGrid_event.record.data.produk_kodelama!== null){produk_kodelama_update = oGrid_event.record.data.produk_kodelama;}
		if(oGrid_event.record.data.produk_group!== null){produk_group_update = oGrid_event.record.data.produk_group;}
		if(oGrid_event.record.data.produk_kategori!== null){produk_kategori_update = oGrid_event.record.data.produk_kategori;}
		if(oGrid_event.record.data.produk_kontribusi!== null){produk_kontribusi_update = oGrid_event.record.data.produk_kontribusi;}
		if(oGrid_event.record.data.produk_jenis!== null){produk_jenis_update = oGrid_event.record.data.produk_jenis;}
		if(oGrid_event.record.data.produk_nama!== null){produk_nama_update = oGrid_event.record.data.produk_nama;}
		if(oGrid_event.record.data.produk_satuan!== null){produk_satuan_update = oGrid_event.record.data.produk_satuan;}
		if(oGrid_event.record.data.produk_du!== null){produk_du_update = oGrid_event.record.data.produk_du;}
		if(oGrid_event.record.data.produk_dm!== null){produk_dm_update = oGrid_event.record.data.produk_dm;}
		if(oGrid_event.record.data.produk_point!== null){produk_point_update = oGrid_event.record.data.produk_point;}
		if(oGrid_event.record.data.produk_volume!== null){produk_volume_update = oGrid_event.record.data.produk_volume;}
		if(oGrid_event.record.data.produk_harga!== null){produk_harga_update = oGrid_event.record.data.produk_harga;}
		if(oGrid_event.record.data.produk_keterangan!== null){produk_keterangan_update = oGrid_event.record.data.produk_keterangan;}
		if(oGrid_event.record.data.produk_aktif!== null){produk_aktif_update = oGrid_event.record.data.produk_aktif;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_produk&m=get_action',
			params: {
				task: "UPDATE",
				produk_id	: produk_id_update_pk, 
				produk_kode	:produk_kode_update,  
				produk_kodelama	:produk_kodelama_update,  
				produk_group	:produk_group_update,  
				produk_kategori	:produk_kategori_update, 
				produk_kontribusi	:produk_kontribusi_update,  
				produk_jenis	:produk_jenis_update,  
				produk_nama	:produk_nama_update,  
				produk_satuan	:produk_satuan_update,  
				produk_du	:produk_du_update,  
				produk_dm	:produk_dm_update,  
				produk_point	:produk_point_update,  
				produk_volume	:produk_volume_update,  
				produk_harga	:produk_harga_update,  
				produk_keterangan	:produk_keterangan_update,  
				produk_aktif	:produk_aktif_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						produk_DataStore.commitChanges();
						produk_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the produk.',
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
	function produk_create(){
	
		if(is_produk_form_valid()){	
		var produk_id_create_pk=null; 
		var produk_kode_create=null; 
		var produk_kodelama_create=null; 
		var produk_group_create=null; 
		var produk_kategori_create=null; 
		var produk_kontribusi_create=null; 
		var produk_jenis_create=null; 
		var produk_nama_create=null; 
		var produk_satuan_create=null; 
		var produk_du_create=null; 
		var produk_dm_create=null; 
		var produk_point_create=null; 
		var produk_volume_create=null; 
		var produk_harga_create=null; 
		var produk_keterangan_create=null; 
		var produk_aktif_create=null; 

		if(produk_idField.getValue()!== null){produk_id_create_pk = produk_idField.getValue();}else{produk_id_create_pk=get_pk_id();} 
		if(produk_kodeField.getValue()!== null){produk_kode_create = produk_kodeField.getValue();} 
		if(produk_kodelamaField.getValue()!== null){produk_kodelama_create = produk_kodelamaField.getValue();} 
		if(produk_groupField.getValue()!== null){produk_group_create = produk_groupField.getValue();} 
		//if(produk_kategoriField.getValue()!== null){produk_kategori_create = produk_kategoriField.getValue();} 
		if(produk_kontribusiField.getValue()!== null){produk_kontribusi_create = produk_kontribusiField.getValue();} 
		if(produk_jenisField.getValue()!== null){produk_jenis_create = produk_jenisField.getValue();} 
		if(produk_namaField.getValue()!== null){produk_nama_create = produk_namaField.getValue();} 
		if(produk_satuanField.getValue()!== null){produk_satuan_create = produk_satuanField.getValue();} 
		if(produk_duField.getValue()!== null){produk_du_create = produk_duField.getValue();} 
		if(produk_dmField.getValue()!== null){produk_dm_create = produk_dmField.getValue();} 
		if(produk_pointField.getValue()!== null){produk_point_create = produk_pointField.getValue();} 
		if(produk_volumeField.getValue()!== null){produk_volume_create = produk_volumeField.getValue();} 
		if(produk_hargaField.getValue()!== null){produk_harga_create = produk_hargaField.getValue();} 
		if(produk_keteranganField.getValue()!== null){produk_keterangan_create = produk_keteranganField.getValue();} 
		if(produk_aktifField.getValue()!== null){produk_aktif_create = produk_aktifField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_produk&m=get_action',
			params: {
				task: post2db,
				produk_id	: produk_id_create_pk, 
				produk_kode	: produk_kode_create, 
				produk_kodelama	: produk_kodelama_create, 
				produk_group	: produk_group_create, 
				//produk_kategori	: produk_kategori_create,
				produk_kontribusi	: produk_kontribusi_create,
				produk_jenis	: produk_jenis_create, 
				produk_nama	: produk_nama_create, 
				produk_satuan	: produk_satuan_create, 
				produk_du	: produk_du_create, 
				produk_dm	: produk_dm_create, 
				produk_point	: produk_point_create, 
				produk_volume	: produk_volume_create, 
				produk_harga	: produk_harga_create, 
				produk_keterangan	: produk_keterangan_create, 
				produk_aktif	: produk_aktif_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						satuan_konversi_purge();
						produk_DataStore.reload();
						produk_createWindow.hide();
						Ext.MessageBox.alert('OK','The Produk was updated successfully');
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
			return produkListEditorGrid.getSelectionModel().getSelected().get('produk_id');
		else if(post2db=='CREATE')
			return produk_idField.getValue();
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function produk_reset_form(){
		produk_idField.reset();
		produk_idField.setValue(null);
		produk_kodeField.reset();
		produk_kodeField.setValue(null);
		produk_kodelamaField.reset();
		produk_kodelamaField.setValue(null);
		produk_groupField.reset();
		produk_groupField.setValue(null);
		produk_kategoriField.reset();
		produk_kategoriField.setValue(null);
		produk_kontribusiField.reset();
		produk_kontribusiField.setValue(null);
		produk_jenisField.reset();
		produk_jenisField.setValue(null);
		produk_namaField.reset();
		produk_namaField.setValue(null);
		produk_satuanField.reset();
		produk_satuanField.setValue(null);
		produk_duField.reset();
		produk_duField.setValue(null);
		produk_dmField.reset();
		produk_dmField.setValue(null);
		produk_pointField.reset();
		produk_pointField.setValue(null);
		produk_volumeField.reset();
		produk_volumeField.setValue(null);
		produk_hargaField.reset();
		produk_hargaField.setValue(null);
		produk_keteranganField.reset();
		produk_keteranganField.setValue(null);
		produk_aktifField.reset();
		produk_aktifField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function produk_set_form(){
		produk_idField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_id'));
		produk_kodeField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_kode'));
		produk_kodelamaField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_kodelama'));
		produk_groupField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_group'));
		//produk_kategoriField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_kategori'));
		produk_kontribusiField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_kontribusi'));
		produk_jenisField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_jenis'));
		produk_namaField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_nama'));
		produk_satuanField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_satuan'));
		produk_duField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_du'));
		produk_dmField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_dm'));
		produk_pointField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_point'));
		produk_volumeField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_volume'));
		produk_hargaField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_harga'));
		produk_keteranganField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_keterangan'));
		produk_aktifField.setValue(produkListEditorGrid.getSelectionModel().getSelected().get('produk_aktif'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_produk_form_valid(){
		return (produk_kodeField.isValid() && produk_groupField.isValid() && produk_namaField.isValid() &&  produk_hargaField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		satuan_konversi_DataStore.load({params: {master_id: get_pk_id(), start:0, limit:15}});
		if(!produk_createWindow.isVisible()){
			produk_reset_form();
			post2db='CREATE';
			msg='created';
			produk_createWindow.show();
		} else {
			produk_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function produk_confirm_delete(){
		// only one produk is selected here
		if(produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', produk_delete);
		} else if(produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', produk_delete);
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
	function produk_confirm_update(){
		/* only one record is selected here */
		if(produkListEditorGrid.selModel.getCount() == 1) {
			produk_set_form();
			post2db='UPDATE';
			satuan_konversi_DataStore.load({params : {master_id : get_pk_id(), start:0, limit:15}});
			msg='updated';
			produk_createWindow.show();
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
	function produk_delete(btn){
		if(btn=='yes'){
			var selections = produkListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< produkListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.produk_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_produk&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							produk_DataStore.reload();
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
	produk_DataStore = new Ext.data.Store({
		id: 'produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:10}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
		/* dataIndex => insert intoproduk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'produk_id', type: 'int', mapping: 'produk_id'}, 
			{name: 'produk_kode', type: 'string', mapping: 'produk_kode'}, 
			{name: 'produk_kodelama', type: 'string', mapping: 'produk_kodelama'}, 
			{name: 'produk_group', type: 'string', mapping: 'group_nama'}, 
			{name: 'produk_kategori', type: 'string', mapping: 'kategori_nama'}, 
			{name: 'produk_kontribusi', type: 'string', mapping: 'kategori2_nama'}, 
			{name: 'produk_jenis', type: 'string', mapping: 'jenis_nama'}, 
			{name: 'produk_nama', type: 'string', mapping: 'produk_nama'}, 
			{name: 'produk_satuan', type: 'string', mapping: 'satuan_nama'}, 
			{name: 'produk_du', type: 'int', mapping: 'produk_du'}, 
			{name: 'produk_dm', type: 'int', mapping: 'produk_dm'}, 
			{name: 'produk_point', type: 'int', mapping: 'produk_point'}, 
			{name: 'produk_volume', type: 'int', mapping: 'produk_volume'}, 
			{name: 'produk_harga', type: 'float', mapping: 'produk_harga'}, 
			{name: 'produk_keterangan', type: 'string', mapping: 'produk_keterangan'}, 
			{name: 'produk_aktif', type: 'string', mapping: 'produk_aktif'}, 
			{name: 'produk_creator', type: 'string', mapping: 'produk_creator'}, 
			{name: 'produk_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'produk_date_create'}, 
			{name: 'produk_update', type: 'string', mapping: 'produk_update'}, 
			{name: 'produk_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'produk_date_update'}, 
			{name: 'poduk_revised', type: 'int', mapping: 'poduk_revised'} 
		]),
		sortInfo:{field: 'produk_id', direction: "DESC"}
	});
	/* End of Function */
	
	cbo_produk_groupDataSore = new Ext.data.Store({
		id: 'cbo_produk_groupDataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk&m=get_group_produk_list', 
			method: 'POST'
		}),
		//baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'group_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'produk_group_value', type: 'int', mapping: 'group_id'},
			{name: 'produk_group_display', type: 'string', mapping: 'group_nama'},
			{name: 'produk_group_duproduk', type: 'int', mapping: 'group_duproduk'},
			{name: 'produk_group_dmproduk', type: 'int', mapping: 'group_dmproduk'},
			{name: 'produk_group_kelompok', type: 'string', mapping: 'kategori_nama'}
		]),
		sortInfo:{field: 'produk_group_display', direction: "ASC"}
	});
	
//	cbo_produk_kategori_DataSore = new Ext.data.Store({
//		id: 'cbo_produk_kategori_DataSore',
//		proxy: new Ext.data.HttpProxy({
//			url: 'index.php?c=c_produk&m=get_kategori_produk_list', 
//			method: 'POST'
//		}),
//		//baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
//		reader: new Ext.data.JsonReader({
//			root: 'results',
//			totalProperty: 'total',
//			id: 'kategori_id'
//		},[
//		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
//			{name: 'produk_kategori_value', type: 'int', mapping: 'kategori_id'},
//			{name: 'produk_kategori_display', type: 'string', mapping: 'kategori_nama'}
//		]),
//		sortInfo:{field: 'produk_kategori_display', direction: "ASC"}
//	});
	
	cbo_produk_kontribusi_DataSore = new Ext.data.Store({
		id: 'cbo_produk_kontribusi_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk&m=get_kontribusi_produk_list', 
			method: 'POST'
		}),
		//baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kategori2_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'produk_kontribusi_value', type: 'int', mapping: 'kategori2_id'},
			{name: 'produk_kontribusi_display', type: 'string', mapping: 'kategori2_nama'}
		]),
		sortInfo:{field: 'produk_kontribusi_display', direction: "ASC"}
	});
	
	
	cbo_produk_jenis_DataSore = new Ext.data.Store({
		id: 'cbo_produk_jenis_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk&m=get_jenis_produk_list', 
			method: 'POST'
		}),
		//baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jenis_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'produk_jenis_value', type: 'int', mapping: 'jenis_id'},
			{name: 'produk_jenis_display', type: 'string', mapping: 'jenis_nama'}
		]),
		sortInfo:{field: 'produk_jenis_display', direction: "ASC"}
	});
	
	cbo_produk_satuan_DataSore = new Ext.data.Store({
		id: 'cbo_produk_satuan_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk&m=get_satuan_list', 
			method: 'POST'
		}),
		//baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'produk_satuan_value', type: 'int', mapping: 'satuan_id'},
			{name: 'produk_satuan_display', type: 'string', mapping: 'satuan_nama'}
		]),
		sortInfo:{field: 'produk_satuan_display', direction: "ASC"}
	});
    
  	/* Function for Identify of Window Column Model */
	produk_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'produk_id',
			width: 60,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Kode',
			dataIndex: 'produk_kode',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 20
          	})
		}, 
		{
			header: 'Nama',
			dataIndex: 'produk_nama',
			width: 250,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 250
          	})
		}, 
		{
			header: 'Group',
			dataIndex: 'produk_group',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: cbo_produk_groupDataSore,
				mode: 'remote',
				displayField: 'produk_group_display',
				valueField: 'produk_group_value',
				triggerAction: 'all'
			})
		},
		{
			header: 'Group 2',
			dataIndex: 'produk_jenis',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: cbo_produk_jenis_DataSore,
				mode: 'remote',
				displayField: 'produk_jenis_display',
				valueField: 'produk_jenis_value',
				triggerAction: 'all'
			})
		}, 
		{
			header: 'Jenis',
			dataIndex: 'produk_kategori',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Satuan',
			dataIndex: 'produk_satuan',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'DU',
			dataIndex: 'produk_du',
			width: 100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + ' %</span>';
			},
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
			header: 'DM',
			dataIndex: 'produk_dm',
			width: 100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + ' %</span>';
			},
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
			header: 'Point',
			dataIndex: 'produk_point',
			width: 100,
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
			header: 'Volume',
			dataIndex: 'produk_volume',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 250
			})
		},
		{
			header: 'Harga',
			dataIndex: 'produk_harga',
			width: 150,
			sortable: true,
			renderer: function(val){
				return '<span>Rp. '+Ext.util.Format.number(val,'0,000')+'</span>';
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
			header: 'Status',
			dataIndex: 'produk_aktif',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['produk_aktif_value', 'produk_aktif_display'],
					data: [['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
					}),
				mode: 'local',
               	displayField: 'produk_aktif_display',
               	valueField: 'produk_aktif_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Creator',
			dataIndex: 'produk_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'produk_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'produk_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'produk_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'poduk_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	produk_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	produkListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'produkListEditorGrid',
		el: 'fp_produk',
		title: 'List Of Produk',
		autoHeight: true,
		store: produk_DataStore, // DataStore
		cm: produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,
		bbar: new Ext.PagingToolbar({
			pageSize: 15,
			store: produk_DataStore,
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
			handler: produk_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: produk_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: produk_DataStore,
			//params: {start: 0, limit: 15},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: produk_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: produk_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: produk_print  
		}
		]
	});
	produkListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	produk_ContextMenu = new Ext.menu.Menu({
		id: 'produk_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: produk_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: produk_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: produk_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: produk_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onproduk_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		produk_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		produk_SelectedRow=rowIndex;
		produk_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function produk_editContextMenu(){
		produkListEditorGrid.startEditing(produk_SelectedRow,1);
  	}
	/* End of Function */
  	
	produkListEditorGrid.addListener('rowcontextmenu', onproduk_ListEditGridContextMenu);
	produk_DataStore.load({params: {start: 0, limit: 15}});	// load DataStore
	produkListEditorGrid.on('afteredit', produk_update); // inLine Editing Record
	
	/* Identify  produk_id Field */
	produk_idField= new Ext.form.NumberField({
		id: 'produk_idField',
		fieldLabel: 'ID',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		hideLabel: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_kode Field */
	produk_kodeField= new Ext.form.TextField({
		id: 'produk_kodeField',
		fieldLabel: 'Kode',
		maxLength: 20,
		allowBlank: true,
		readOnly: true,
		emptyText: '(auto)',
		width: 100
	});
	/* Identify  produk_kodelama Field */
	produk_kodelamaField= new Ext.form.TextField({
		id: 'produk_kodelamaField',
		fieldLabel: 'Kode Lama',
		maxLength: 20,
		allowBlank: true,
		width: 100
	});
	/* Identify  produk_group Field */
	produk_groupField= new Ext.form.ComboBox({
		id: 'produk_groupField',
		fieldLabel: 'Group <span style="color: #ec0000">*</span>',
		store: cbo_produk_groupDataSore,
		mode: 'remote',
		allowBlank: false,
		displayField: 'produk_group_display',
		valueField: 'produk_group_value',
		width: 120,
		triggerAction: 'all'
	});
	/* Identify  produk_kategori Field */
	produk_kategoriField= new Ext.form.TextField({
		id: 'produk_kategoriField',
		fieldLabel: 'Jenis',
		maxLength: 20,
		readOnly: true,
		width: 120
	});
	/* Identify  produk_kategori Field */
	produk_kontribusiField= new Ext.form.ComboBox({
		id: 'produk_kontribusiField',
		fieldLabel: 'Contribution Category',
		store: cbo_produk_kontribusi_DataSore,
		mode: 'remote',
		displayField: 'produk_kontribusi_display',
		valueField: 'produk_kontribusi_value',
		anchor: '95%',
		triggerAction: 'all'
	});
	/* Identify  produk_jenis Field */
	produk_jenisField= new Ext.form.ComboBox({
		id: 'produk_jenisField',
		fieldLabel: 'Group 2 <span style="color: #ec0000">*</span>',
		store: cbo_produk_jenis_DataSore,
		mode: 'remote',
		allowBlank: false,
		displayField: 'produk_jenis_display',
		valueField: 'produk_jenis_value',
		width: 120,
		triggerAction: 'all'
	});
	/* Identify  produk_nama Field */
	produk_namaField= new Ext.form.TextField({
		id: 'produk_namaField',
		fieldLabel: 'Nama <span style="color: #ec0000">*</span>',
		maxLength: 250,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  produk_satuan Field */
	produk_satuanField= new Ext.form.ComboBox({
		id: 'produk_satuanField',
		fieldLabel: 'Satuan',
		store: cbo_produk_satuan_DataSore,
		mode: 'remote',
		displayField: 'produk_satuan_display',
		valueField: 'produk_satuan_value',
		anchor: '50%',
		triggerAction: 'all'
	});
	/* Identify  produk_du Field */
	produk_duField= new Ext.form.NumberField({
		id: 'produk_duField',
		name: 'produk_duField',
		fieldLabel: 'Diskon Umum (%)',
		allowNegatife : false,
		emptyText: '0',
		allowBlank: true,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_dm Field */
	produk_dmField= new Ext.form.NumberField({
		id: 'produk_dmField',
		name: 'produk_dmField',
		fieldLabel: 'Diskon Member (%)',
		allowNegatife : false,
		emptyText: '0',
		allowBlank: true,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_point Field */
	produk_pointField= new Ext.form.NumberField({
		id: 'produk_pointField',
		name: 'produk_pointField',
		fieldLabel: 'Point',
		allowNegatife : false,
		emptyText: '0',
		allowBlank: true,
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_volume Field */
	produk_volumeField= new Ext.form.TextField({
		id: 'produk_volumeField',
		fieldLabel: 'Volume',
		maxLength: 250
	});
	/* Identify  produk_harga Field */
	produk_hargaField= new Ext.form.NumberField({
		id: 'produk_hargaField',
		name: 'produk_hargaField',
		fieldLabel: 'Harga (Rp) <span style="color: #ec0000">*</span>',
		allowNegatife : false,
		emptyText: '0',
		allowBlank: false,
		allowDecimals: true,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_keterangan Field */
	produk_keteranganField= new Ext.form.TextArea({
		id: 'produk_keteranganField',
		fieldLabel: 'Keterangan',
		allowBlank: true,
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  produk_aktif Field */
	produk_aktifField= new Ext.form.ComboBox({
		id: 'produk_aktifField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['produk_aktif_value', 'produk_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		emptyText: 'Aktif',
		displayField: 'produk_aktif_display',
		valueField: 'produk_aktif_value',
		width: 80,
		triggerAction: 'all'	
	});
	
	produk_groupField.on('select', function(){
		var record=cbo_produk_groupDataSore.find('produk_group_value', produk_groupField.getValue());
		if(cbo_produk_groupDataSore.getCount()){
			produk_duField.setValue(cbo_produk_groupDataSore.getAt(record).data.produk_group_duproduk);
			produk_dmField.setValue(cbo_produk_groupDataSore.getAt(record).data.produk_group_dmproduk);
			produk_kategoriField.setValue(cbo_produk_groupDataSore.getAt(record).data.produk_group_kelompok);
		}
	});
	
  	/*Fieldset Master*/
	produk_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [produk_kodelamaField, produk_kodeField, produk_groupField, produk_jenisField, produk_kategoriField, produk_namaField, produk_hargaField, produk_duField, produk_dmField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [produk_pointField, produk_volumeField, produk_kontribusiField, produk_keteranganField, produk_aktifField, produk_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var satuan_konversi_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'konversi_id'
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'konversi_id', type: 'int', mapping: 'konversi_id'}, 
			{name: 'konversi_produk', type: 'int', mapping: 'konversi_produk'}, 
			{name: 'konversi_satuan', type: 'int', mapping: 'konversi_satuan'}, 
			{name: 'konversi_nilai', type: 'float', mapping: 'konversi_nilai'},
			{name: 'konversi_default', type: 'string', mapping: 'konversi_default'}
	]);
	//eof
	
	//function for json writer of detail
	var satuan_konversi_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	satuan_konversi_DataStore = new Ext.data.Store({
		id: 'satuan_konversi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk&m=detail_satuan_konversi_list', 
			method: 'POST'
		}),
		reader: satuan_konversi_reader,
		baseParams:{master_id: get_pk_id()},
		sortInfo:{field: 'konversi_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_satuan_konversi= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	Ext.util.Format.comboRenderer = function(combo){
		cbo_produk_satuanDataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	cbo_produk_satuanDataStore = new Ext.data.Store({
		id: 'cbo_produk_satuanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk&m=get_satuan_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'produk_satuan_value', type: 'int', mapping: 'satuan_id'},
			{name: 'produk_satuan_display', type: 'string', mapping: 'satuan_nama'}
		]),
		sortInfo:{field: 'produk_satuan_value', direction: "ASC"}
	});
	
	var combo_produk_satuan=new Ext.form.ComboBox({
			store: cbo_produk_satuanDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'produk_satuan_display',
			valueField: 'produk_satuan_value',
			triggerAction: 'all',
			lazyRender:true
	});
	
	//declaration of detail coloumn model
	satuan_konversi_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Satuan',
			dataIndex: 'konversi_satuan',
			width: 295,
			sortable: false,
			editor: combo_produk_satuan,
			renderer: Ext.util.Format.comboRenderer(combo_produk_satuan)
		},
		{
			header: 'Nilai',
			dataIndex: 'konversi_nilai',
			width: 295,
			sortable: false,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			xtype: 'booleancolumn',
			header: 'Setting Default<br>(<span style="color:#F00">pilih hanya satu</span>)',
			dataIndex: 'konversi_default',
			width: 100,
			align: 'center',
			trueText: 'Yes',
			falseText: 'No',
			editor: {xtype: 'checkbox'}
		}]
	);
	satuan_konversi_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	satuan_konversiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'satuan_konversiListEditorGrid',
		el: 'fp_satuan_konversi',
		title: 'Detail satuan_konversi',
		height: 250,
		width: 690,
		autoScroll: true,
		store: satuan_konversi_DataStore, // DataStore
		colModel: satuan_konversi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_satuan_konversi],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: 15,
			store: satuan_konversi_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: satuan_konversi_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: satuan_konversi_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function satuan_konversi_add(){
		var edit_satuan_konversi= new satuan_konversiListEditorGrid.store.recordType({
			konversi_id	:'',		
			konversi_produk	:'',		
			konversi_satuan	:'',		
			konversi_nilai	:'',
			konversi_default :false
		});
		editor_satuan_konversi.stopEditing();
		satuan_konversi_DataStore.insert(0, edit_satuan_konversi);
		satuan_konversiListEditorGrid.getView().refresh();
		satuan_konversiListEditorGrid.getSelectionModel().selectRow(0);
		editor_satuan_konversi.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_satuan_konversi(){
		satuan_konversi_DataStore.commitChanges();
		satuan_konversiListEditorGrid.getView().refresh();
	}
	//eof
	
	function check_konversi_default(){
		$count_default=0;
		for ($i = 0; $i < satuan_konversi_DataStore.getCount(); $i++) {
			satuan_konversi_default=satuan_konversi_DataStore.getAt($i);
			//console.log("value konversi_default = "+satuan_konversi_default.data.konversi_default);
			if(satuan_konversi_default.data.konversi_default==true || satuan_konversi_default.data.konversi_default=='true')
				$count_default+=1;
		}
		//console.log('count = '+$count_default);
		if($count_default==1)
			master_detail_insert();
		else {
			Ext.MessageBox.alert('Warning','Setting Default harus hanya satu...');
		}
	}
	function satuan_konversi_insert(){
		for(i=0;i<satuan_konversi_DataStore.getCount();i++){
			satuan_konversi_record=satuan_konversi_DataStore.getAt(i);
			if(satuan_konversi_record.data.konversi_satuan!=="" && satuan_konversi_record.data.konversi_satuan!==null){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_produk&m=detail_satuan_konversi_insert',
					params:{
					konversi_id	: satuan_konversi_record.data.konversi_id, 
					konversi_produk	: get_pk_id(), 
					konversi_satuan	: satuan_konversi_record.data.konversi_satuan, 
					konversi_nilai	: satuan_konversi_record.data.konversi_nilai,
					konversi_default	: satuan_konversi_record.data.konversi_default
					}
				});
			}
		}
	}
	//function for insert detail
	function master_detail_insert(){
		var check_konversi_nilai=0;
		for(j=0;j<satuan_konversi_DataStore.getCount();j++){
			check_konversi_record=satuan_konversi_DataStore.getAt(j);
			if(check_konversi_record.data.konversi_nilai==1){
				check_konversi_nilai+=1;
				produk_satuanField.setValue(check_konversi_record.data.konversi_satuan);
			}
		}
		switch(check_konversi_nilai){
			case 1:
				produk_create(); 
				
				break;
			default:
				Ext.MessageBox.show({
				   title: 'Warning',
				   msg: 'Harus menambahkan baris Detail dan <br>Konversi Nilai = 1 <br>harus ada minimal sejumlah 1.',
				   buttons: Ext.MessageBox.OK,
				   animEl: 'save',
				   minWidth: 250,
				   icon: Ext.MessageBox.WARNING
				});
				break;
		}
	}
	//eof
	
	//function for purge detail
	function satuan_konversi_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_produk&m=detail_satuan_konversi_purge',
			params:{ master_id: eval(produk_idField.getValue()) },
			timeout : 5000,
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						satuan_konversi_insert();
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
	function satuan_konversi_confirm_delete(){
		// only one record is selected here
		if(satuan_konversiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', satuan_konversi_delete);
		} else if(satuan_konversiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', satuan_konversi_delete);
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
	function satuan_konversi_delete(btn){
		if(btn=='yes'){
			var s = satuan_konversiListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				satuan_konversi_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	satuan_konversi_DataStore.on('update', refresh_satuan_konversi);
	
	/* Function for retrieve create Window Panel*/ 
	produk_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [produk_masterGroup,satuan_konversiListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: check_konversi_default
				//handler: master_detail_insert
			}
			,{
				text: 'Cancel',
				handler: function(){
					produk_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	produk_createWindow= new Ext.Window({
		id: 'produk_createWindow',
		title: post2db+'Produk',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_produk_create',
		items: produk_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function produk_list_search(){
		// render according to a SQL date format.
		var produk_id_search=null;
		var produk_kode_search=null;
		var produk_kodelama_search=null;
		var produk_group_search=null;
		var produk_kategori_search=null;
		var produk_jenis_search=null;
		var produk_nama_search=null;
		var produk_satuan_search=null;
		var produk_du_search=null;
		var produk_dm_search=null;
		var produk_point_search=null;
		var produk_volume_search=null;
		var produk_kontribusi_search=null;
		var produk_harga_search=null;
		var produk_keterangan_search=null;
		var produk_aktif_search=null;

		if(produk_idSearchField.getValue()!==null){produk_id_search=produk_idSearchField.getValue();}
		if(produk_kodeSearchField.getValue()!==null){produk_kode_search=produk_kodeSearchField.getValue();}
		if(produk_kodelamaSearchField.getValue()!==null){produk_kodelama_search=produk_kodelamaSearchField.getValue();}
		if(produk_groupSearchField.getValue()!==null){produk_group_search=produk_groupSearchField.getValue();}
		if(produk_kategoriSearchField.getValue()!==null){produk_kategori_search=produk_kategoriSearchField.getValue();}
		if(produk_jenisSearchField.getValue()!==null){produk_jenis_search=produk_jenisSearchField.getValue();}
		if(produk_namaSearchField.getValue()!==null){produk_nama_search=produk_namaSearchField.getValue();}
		if(produk_satuanSearchField.getValue()!==null){produk_satuan_search=produk_satuanSearchField.getValue();}
		if(produk_duSearchField.getValue()!==null){produk_du_search=produk_duSearchField.getValue();}
		if(produk_dmSearchField.getValue()!==null){produk_dm_search=produk_dmSearchField.getValue();}
		if(produk_pointSearchField.getValue()!==null){produk_point_search=produk_pointSearchField.getValue();}
		if(produk_kontribusiSearchField.getValue()!==null){produk_kontribusi_search=produk_kontribusiSearchField.getValue();}
		if(produk_volumeSearchField.getValue()!==null){produk_volume_search=produk_volumeSearchField.getValue();}
		if(produk_hargaSearchField.getValue()!==null){produk_harga_search=produk_hargaSearchField.getValue();}
		if(produk_keteranganSearchField.getValue()!==null){produk_keterangan_search=produk_keteranganSearchField.getValue();}
		if(produk_aktifSearchField.getValue()!==null){produk_aktif_search=produk_aktifSearchField.getValue();}
		
		// change the store parameters
		produk_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			produk_id	:	produk_id_search, 
			produk_kode	:	produk_kode_search, 
			produk_kodelama	:	produk_kodelama_search, 
			produk_group	:	produk_group_search, 
			produk_kategori	:	produk_kategori_search, 
			produk_jenis	:	produk_jenis_search, 
			produk_nama	:	produk_nama_search, 
			produk_satuan	:	produk_satuan_search, 
			produk_du	:	produk_du_search, 
			produk_dm	:	produk_dm_search, 
			produk_point	:	produk_point_search, 
			produk_kontribusi	:	produk_kontribusi_search,
			produk_volume	:	produk_volume_search,
			produk_harga	:	produk_harga_search, 
			produk_keterangan	:	produk_keterangan_search, 
			produk_aktif	:	produk_aktif_search, 
		};
		// Cause the datastore to do another query : 
		produk_DataStore.reload({params: {start: 0, limit: 15}});
	}
		
	/* Function for reset search result */
	function produk_reset_search(){
		// reset the store parameters
		produk_DataStore.baseParams = { task: 'LIST',start:0,limit:15 };
		// Cause the datastore to do another query : 
		produk_DataStore.reload({params: {start: 0, limit: 15}});
		produk_searchWindow.close();
	};
	/* End of Fuction */
	
	function produk_reset_SearchForm(){
		produk_idSearchField.reset();
		produk_idSearchField.setValue(null);
		produk_kodeSearchField.reset();
		produk_kodeSearchField.setValue(null);
		produk_kodelamaSearchField.reset();
		produk_kodelamaSearchField.setValue(null);
		produk_groupSearchField.reset();
		produk_groupSearchField.setValue(null);
		produk_kategoriSearchField.reset();
		produk_kategoriSearchField.setValue(null);
		produk_jenisSearchField.reset();
		produk_jenisSearchField.setValue(null);
		produk_namaSearchField.reset();
		produk_namaSearchField.setValue(null);
		produk_satuanSearchField.reset();
		produk_satuanSearchField.setValue(null);
		produk_duSearchField.reset();
		produk_duSearchField.setValue(null);
		produk_dmSearchField.reset();
		produk_dmSearchField.setValue(null);
		produk_pointSearchField.reset();
		produk_pointSearchField.setValue(null);
		produk_kontribusiSearchField.reset();
		produk_kontribusiSearchField.setValue(null);
		produk_volumeSearchField.reset();
		produk_volumeSearchField.setValue(null);
		produk_hargaSearchField.reset();
		produk_hargaSearchField.setValue(null);
		produk_keteranganSearchField.reset();
		produk_keteranganSearchField.setValue(null);
		produk_aktifSearchField.reset();
		produk_aktifSearchField.setValue(null);
	}
	
	/* Field for search */
	/* Identify  produk_id Field */
	produk_idSearchField= new Ext.form.NumberField({
		id: 'produk_idSearchField',
		fieldLabel: 'ID',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		hidden: true,
		hideLabel: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_kode Field */
	produk_kodeSearchField= new Ext.form.TextField({
		id: 'produk_kodeSearchField',
		fieldLabel: 'Kode',
		maxLength: 20,
		emptyText: '(auto)',
		width: 100
	});
	/* Identify  produk_kodelama Field */
	produk_kodelamaSearchField= new Ext.form.TextField({
		id: 'produk_kodelamaSearchField',
		fieldLabel: 'Kode Lama',
		maxLength: 20,
		width: 100
	});
	/* Identify  produk_group Field */
	produk_groupSearchField= new Ext.form.ComboBox({
		id: 'produk_groupSearchField',
		fieldLabel: 'Group <span style="color: #ec0000">*</span>',
		store: cbo_produk_groupDataSore,
		mode: 'remote',
		displayField: 'produk_group_display',
		valueField: 'produk_group_value',
		width: 120,
		triggerAction: 'all'
	});
	/* Identify  produk_kategori Field */
	produk_kategoriSearchField= new Ext.form.TextField({
		id: 'produk_kategoriSearchField',
		fieldLabel: 'Jenis',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  produk_kategori Field */
	produk_kontribusiSearchField= new Ext.form.ComboBox({
		id: 'produk_kontribusiSearchField',
		fieldLabel: 'Contribution Category',
		store: cbo_produk_kontribusi_DataSore,
		mode: 'remote',
		displayField: 'produk_kontribusi_display',
		valueField: 'produk_kontribusi_value',
		anchor: '95%',
		triggerAction: 'all'
	});
	/* Identify  produk_jenis Field */
	produk_jenisSearchField= new Ext.form.ComboBox({
		id: 'produk_jenisSearchField',
		fieldLabel: 'Group 2 <span style="color: #ec0000">*</span>',
		store: cbo_produk_jenis_DataSore,
		mode: 'remote',
		displayField: 'produk_jenis_display',
		valueField: 'produk_jenis_value',
		width: 120,
		triggerAction: 'all'
	});
	/* Identify  produk_nama Field */
	produk_namaSearchField= new Ext.form.TextField({
		id: 'produk_namaSearchField',
		fieldLabel: 'Nama <span style="color: #ec0000">*</span>',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  produk_satuan Field */
	produk_satuanSearchField= new Ext.form.ComboBox({
		id: 'produk_satuanSearchField',
		fieldLabel: 'Satuan',
		store: cbo_produk_satuan_DataSore,
		mode: 'remote',
		displayField: 'produk_satuan_display',
		valueField: 'produk_satuan_value',
		anchor: '50%',
		triggerAction: 'all'
	});
	/* Identify  produk_du Field */
	produk_duSearchField= new Ext.form.NumberField({
		id: 'produk_duSearchField',
		name: 'produk_duField',
		fieldLabel: 'Diskon Umum (%)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_dm Field */
	produk_dmSearchField= new Ext.form.NumberField({
		id: 'produk_dmSearchField',
		name: 'produk_dmField',
		fieldLabel: 'Diskon Member (%)',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_point Field */
	produk_pointSearchField= new Ext.form.NumberField({
		id: 'produk_pointSearchField',
		name: 'produk_pointField',
		fieldLabel: 'Point',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_volume Field */
	produk_volumeSearchField= new Ext.form.TextField({
		id: 'produk_volumeSearchField',
		fieldLabel: 'Volume',
		maxLength: 250
	});
	/* Identify  produk_harga Field */
	produk_hargaSearchField= new Ext.form.NumberField({
		id: 'produk_hargaSearchField',
		name: 'produk_hargaField',
		fieldLabel: 'Harga (Rp) <span style="color: #ec0000">*</span>',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: true,
		width: 60,
		maskRe: /([0-9]+)$/
	});
	/* Identify  produk_keterangan Field */
	produk_keteranganSearchField= new Ext.form.TextArea({
		id: 'produk_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  produk_aktif Field */
	produk_aktifSearchField= new Ext.form.ComboBox({
		id: 'produk_aktifSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['produk_aktif_value', 'produk_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		emptyText: 'Aktif',
		displayField: 'produk_aktif_display',
		valueField: 'produk_aktif_value',
		width: 80,
		triggerAction: 'all'	
	});
    
	/* Function for retrieve search Form Panel */
	produk_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
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
				items: [produk_kodelamaSearchField, produk_kodeSearchField, produk_groupSearchField, produk_jenisSearchField, produk_kategoriSearchField, produk_namaSearchField, produk_hargaSearchField, produk_duSearchField, produk_dmSearchField] 
			}
 
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [produk_pointSearchField, produk_volumeSearchField, produk_kontribusiSearchField, produk_keteranganSearchField, produk_aktifSearchField, produk_idSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: produk_list_search
			},{
				text: 'Close',
				handler: function(){
					produk_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	produk_searchWindow = new Ext.Window({
		title: 'produk Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_produk_search',
		items: produk_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!produk_searchWindow.isVisible()){
			produk_reset_SearchForm();
			produk_searchWindow.show();
		} else {
			produk_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function produk_print(){
		var searchquery = "";
		var produk_kode_print=null;
		var produk_kodelama_print=null;
		var produk_group_print=null;
		var produk_kategori_print=null;
		var produk_jenis_print=null;
		var produk_nama_print=null;
		var produk_satuan_print=null;
		var produk_du_print=null;
		var produk_dm_print=null;
		var produk_point_print=null;
		var produk_volume_print=null;
		var produk_harga_print=null;
		var produk_keterangan_print=null;
		var produk_aktif_print=null;
		var win;              
		// check if we do have some search data...
		if(produk_DataStore.baseParams.query!==null){searchquery = produk_DataStore.baseParams.query;}
		if(produk_DataStore.baseParams.produk_kode!==null){produk_kode_print = produk_DataStore.baseParams.produk_kode;}
		if(produk_DataStore.baseParams.produk_kodelama!==null){produk_kodelama_print = produk_DataStore.baseParams.produk_kodelama;}
		if(produk_DataStore.baseParams.produk_group!==null){produk_group_print = produk_DataStore.baseParams.produk_group;}
		if(produk_DataStore.baseParams.produk_kategori!==null){produk_kategori_print = produk_DataStore.baseParams.produk_kategori;}
		if(produk_DataStore.baseParams.produk_jenis!==null){produk_jenis_print = produk_DataStore.baseParams.produk_jenis;}
		if(produk_DataStore.baseParams.produk_nama!==null){produk_nama_print = produk_DataStore.baseParams.produk_nama;}
		if(produk_DataStore.baseParams.produk_satuan!==null){produk_satuan_print = produk_DataStore.baseParams.produk_satuan;}
		if(produk_DataStore.baseParams.produk_du!==null){produk_du_print = produk_DataStore.baseParams.produk_du;}
		if(produk_DataStore.baseParams.produk_dm!==null){produk_dm_print = produk_DataStore.baseParams.produk_dm;}
		if(produk_DataStore.baseParams.produk_point!==null){produk_point_print = produk_DataStore.baseParams.produk_point;}
		if(produk_DataStore.baseParams.produk_volume!==null){produk_volume_print = produk_DataStore.baseParams.produk_volume;}
		if(produk_DataStore.baseParams.produk_harga!==null){produk_harga_print = produk_DataStore.baseParams.produk_harga;}
		if(produk_DataStore.baseParams.produk_keterangan!==null){produk_keterangan_print = produk_DataStore.baseParams.produk_keterangan;}
		if(produk_DataStore.baseParams.produk_aktif!==null){produk_aktif_print = produk_DataStore.baseParams.produk_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_produk&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			produk_kode : produk_kode_print,
			produk_kodelama : produk_kodelama_print,
			produk_group : produk_group_print,
			produk_kategori : produk_kategori_print,
			produk_jenis : produk_jenis_print,
			produk_nama : produk_nama_print,
			produk_satuan : produk_satuan_print,
			produk_du : produk_du_print,
			produk_dm : produk_dm_print,
			produk_point : produk_point_print,
			produk_volume : produk_volume_print,
			produk_harga : produk_harga_print,
			produk_keterangan : produk_keterangan_print,
			produk_aktif : produk_aktif_print,
		  	currentlisting: produk_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./produklist.html','produklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function produk_export_excel(){
		var searchquery = "";
		var produk_kode_2excel=null;
		var produk_kodelama_2excel=null;
		var produk_group_2excel=null;
		var produk_kategori_2excel=null;
		var produk_jenis_2excel=null;
		var produk_nama_2excel=null;
		var produk_satuan_2excel=null;
		var produk_du_2excel=null;
		var produk_dm_2excel=null;
		var produk_point_2excel=null;
		var produk_volume_2excel=null;
		var produk_harga_2excel=null;
		var produk_keterangan_2excel=null;
		var produk_aktif_2excel=null;
		var win;              
		// check if we do have some search data...
		if(produk_DataStore.baseParams.query!==null){searchquery = produk_DataStore.baseParams.query;}
		if(produk_DataStore.baseParams.produk_kode!==null){produk_kode_2excel = produk_DataStore.baseParams.produk_kode;}
		if(produk_DataStore.baseParams.produk_kodelama!==null){produk_kodelama_2excel = produk_DataStore.baseParams.produk_kodelama;}
		if(produk_DataStore.baseParams.produk_group!==null){produk_group_2excel = produk_DataStore.baseParams.produk_group;}
		if(produk_DataStore.baseParams.produk_kategori!==null){produk_kategori_2excel = produk_DataStore.baseParams.produk_kategori;}
		if(produk_DataStore.baseParams.produk_jenis!==null){produk_jenis_2excel = produk_DataStore.baseParams.produk_jenis;}
		if(produk_DataStore.baseParams.produk_nama!==null){produk_nama_2excel = produk_DataStore.baseParams.produk_nama;}
		if(produk_DataStore.baseParams.produk_satuan!==null){produk_satuan_2excel = produk_DataStore.baseParams.produk_satuan;}
		if(produk_DataStore.baseParams.produk_du!==null){produk_du_2excel = produk_DataStore.baseParams.produk_du;}
		if(produk_DataStore.baseParams.produk_dm!==null){produk_dm_2excel = produk_DataStore.baseParams.produk_dm;}
		if(produk_DataStore.baseParams.produk_point!==null){produk_point_2excel = produk_DataStore.baseParams.produk_point;}
		if(produk_DataStore.baseParams.produk_volume!==null){produk_volume_2excel = produk_DataStore.baseParams.produk_volume;}
		if(produk_DataStore.baseParams.produk_harga!==null){produk_harga_2excel = produk_DataStore.baseParams.produk_harga;}
		if(produk_DataStore.baseParams.produk_keterangan!==null){produk_keterangan_2excel = produk_DataStore.baseParams.produk_keterangan;}
		if(produk_DataStore.baseParams.produk_aktif!==null){produk_aktif_2excel = produk_DataStore.baseParams.produk_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_produk&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			produk_kode : produk_kode_2excel,
			produk_kodelama : produk_kodelama_2excel,
			produk_group : produk_group_2excel,
			produk_kategori : produk_kategori_2excel,
			produk_jenis : produk_jenis_2excel,
			produk_nama : produk_nama_2excel,
			produk_satuan : produk_satuan_2excel,
			produk_du : produk_du_2excel,
			produk_dm : produk_dm_2excel,
			produk_point : produk_point_2excel,
			produk_volume : produk_volume_2excel,
			produk_harga : produk_harga_2excel,
			produk_keterangan : produk_keterangan_2excel,
			produk_aktif : produk_aktif_2excel,
		  	currentlisting: produk_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_produk"></div>
         <div id="fp_satuan_konversi"></div>
		<div id="elwindow_produk_create"></div>
        <div id="elwindow_produk_search"></div>
    </div>
</div>
</body>