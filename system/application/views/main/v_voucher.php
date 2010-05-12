<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: voucher View
	+ Description	: For record view
	+ Filename 		: v_voucher.php
 	+ Author  		: 
 	+ Created on 27/Aug/2009 06:40:41
	
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
var voucher_DataStore;
var voucher_ColumnModel;
var voucherListEditorGrid;
var voucher_createForm;
var voucher_createWindow;
var voucher_searchForm;
var voucher_searchWindow;
var voucher_SelectedRow;
var voucher_ContextMenu;
//for detail data
var voucher_produk_DataStore;
var voucher_produkListEditorGrid;
var voucher_produk_ColumnModel;
var voucher_produk_proxy;
var voucher_produk_writer;
var voucher_produk_reader;
var voucher_perawatan_DataStore;
var voucher_perawatanListEditorGrid;
var voucher_perawatan_ColumnModel;
var voucher_perawatan_proxy;
var voucher_perawatan_writer;
var voucher_perawatan_reader;

var editor_voucher_produk;
var editor_voucher_perawatan;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var voucher_idField;
var voucher_namaField;
var voucher_jenisField;
var voucher_pointField;
var voucher_jumlahField;
var voucher_kadaluarsaField;
var voucher_cashbackField;
var voucher_mincashField;
var voucher_diskonField;
var voucher_promoField;
var voucher_allprodukField;
var voucher_allrawatField;
var voucher_idSearchField;
var voucher_namaSearchField;
var voucher_jenisSearchField;
var voucher_pointSearchField;
var voucher_jumlahSearchField;
var voucher_kadaluarsaSearchField;
var voucher_cashbackSearchField;
var voucher_mincashSearchField;
var voucher_diskonSearchField;
var voucher_promoSearchField;
var voucher_allprodukSearchField;
var voucher_allrawatSearchField;

function voucher_cetak(master_id){
	Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_voucher&m=print_paper',
		params: { kvoucher_master : master_id}, 
		success: function(response){              
			var result=eval(response.responseText);
			switch(result){
			case 1:
				win = window.open('./voucher_paper.html','Cetak Voucher','height=480,width=1340,resizable=1,scrollbars=0, menubar=0');
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
  
  	/* Function for Saving inLine Editing */
	function voucher_update(oGrid_event){
		var voucher_id_update_pk="";
		var voucher_nama_update=null;
		var voucher_jenis_update=null;
		var voucher_point_update=null;
		var voucher_jumlah_update=null;
		var voucher_kadaluarsa_update_date="";
		var voucher_cashback_update=null;
		var voucher_mincash_update=null;
		var voucher_diskon_update=null;
		var voucher_promo_update=null;
		var voucher_allproduk_update=null;
		var voucher_allrawat_update=null;

		voucher_id_update_pk = oGrid_event.record.data.voucher_id;
		if(oGrid_event.record.data.voucher_nama!== null){voucher_nama_update = oGrid_event.record.data.voucher_nama;}
		if(oGrid_event.record.data.voucher_jenis!== null){voucher_jenis_update = oGrid_event.record.data.voucher_jenis;}
		if(oGrid_event.record.data.voucher_point!== null){voucher_point_update = oGrid_event.record.data.voucher_point;}
		if(oGrid_event.record.data.voucher_jumlah!== null){voucher_jumlah_update = oGrid_event.record.data.voucher_jumlah;}
	 	if(oGrid_event.record.data.voucher_kadaluarsa!== ""){voucher_kadaluarsa_update_date =oGrid_event.record.data.voucher_kadaluarsa.format('Y-m-d');}
		if(oGrid_event.record.data.voucher_cashback!== null){voucher_cashback_update = oGrid_event.record.data.voucher_cashback;}
		if(oGrid_event.record.data.voucher_mincash!== null){voucher_mincash_update = oGrid_event.record.data.voucher_mincash;}
		if(oGrid_event.record.data.voucher_diskon!== null){voucher_diskon_update = oGrid_event.record.data.voucher_diskon;}
		if(oGrid_event.record.data.voucher_promo!== null){voucher_promo_update = oGrid_event.record.data.voucher_promo;}
		if(oGrid_event.record.data.voucher_allproduk!== null){voucher_allproduk_update = oGrid_event.record.data.voucher_allproduk;}
		if(oGrid_event.record.data.voucher_allrawat!== null){voucher_allrawat_update = oGrid_event.record.data.voucher_allrawat;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_voucher&m=get_action',
			params: {
				task: "UPDATE",
				voucher_id	: voucher_id_update_pk, 
				voucher_nama	:voucher_nama_update,  
				voucher_jenis	:voucher_jenis_update,  
				voucher_point	:voucher_point_update,  
				voucher_jumlah	:voucher_jumlah_update,  
				voucher_kadaluarsa	: voucher_kadaluarsa_update_date, 
				voucher_cashback	:voucher_cashback_update,  
				voucher_mincash	:voucher_mincash_update,  
				voucher_diskon	:voucher_diskon_update,  
				voucher_promo	:voucher_promo_update,  
				voucher_allproduk	:voucher_allproduk_update,  
				voucher_allrawat	:voucher_allrawat_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						voucher_DataStore.commitChanges();
						voucher_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the voucher.',
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
	function voucher_create(){
	
		if(is_voucher_form_valid() && (voucher_nomor_awalField.getValue()<voucher_nomor_akhirField.getValue())){	
		var voucher_id_create_pk=null; 
		var voucher_nama_create=null; 
		var voucher_jenis_create=null; 
		var voucher_point_create=null; 
		var voucher_jumlah_create=null; 
		var voucher_kadaluarsa_create_date=""; 
		var voucher_cashback_create=null; 
		var voucher_mincash_create=null; 
		var voucher_diskon_create=null; 
		var voucher_promo_create=null; 
		var voucher_allproduk_create=null; 
		var voucher_allrawat_create=null; 
		var voucher_acara_create="";
		var voucher_nomor_awal_create="";
		var voucher_nomor_akhir_create="";

		if(voucher_idField.getValue()!== null){voucher_id_create_pk = voucher_idField.getValue();}else{voucher_id_create_pk=get_pk_id();} 
		if(voucher_namaField.getValue()!== null){voucher_nama_create = voucher_namaField.getValue();} 
		if(voucher_jenisField.getValue()!== null){voucher_jenis_create = voucher_jenisField.getValue();} 
		if(voucher_pointField.getValue()!== null){voucher_point_create = voucher_pointField.getValue();} 
		if(voucher_jumlahField.getValue()!== null){voucher_jumlah_create = voucher_jumlahField.getValue();} 
		if(voucher_kadaluarsaField.getValue()!== ""){voucher_kadaluarsa_create_date = voucher_kadaluarsaField.getValue().format('Y-m-d');} 
		if(voucher_cashbackField.getValue()!== null){voucher_cashback_create = voucher_cashbackField.getValue();} 
		if(voucher_mincashField.getValue()!== null){voucher_mincash_create = voucher_mincashField.getValue();} 
		if(voucher_diskonField.getValue()!== null){voucher_diskon_create = voucher_diskonField.getValue();} 
		if(voucher_promoField.getValue()!== null){voucher_promo_create = voucher_promoField.getValue();} 
		if(voucher_allprodukField.getValue()!== null){voucher_allproduk_create = voucher_allprodukField.getValue();} 
		if(voucher_allrawatField.getValue()!== null){voucher_allrawat_create = voucher_allrawatField.getValue();} 
		if(voucher_acaraField.getValue()!== ""){voucher_acara_create = voucher_acaraField.getValue();} 
		if(voucher_nomor_awalField.getValue()!== ""){voucher_nomor_awal_create = voucher_nomor_awalField.getValue();} 
		if(voucher_nomor_akhirField.getValue()!== ""){voucher_nomor_akhir_create = voucher_nomor_akhirField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_voucher&m=get_action',
			params: {
				task: post2db,
				voucher_id	: voucher_id_create_pk, 
				voucher_nama	: voucher_nama_create, 
				voucher_jenis	: voucher_jenis_create, 
				voucher_point	: voucher_point_create, 
				voucher_jumlah	: voucher_jumlah_create, 
				voucher_kadaluarsa	: voucher_kadaluarsa_create_date, 
				voucher_cashback	: voucher_cashback_create, 
				voucher_mincash	: voucher_mincash_create, 
				voucher_diskon	: voucher_diskon_create, 
				voucher_promo	: voucher_promo_create, 
				voucher_allproduk	: voucher_allproduk_create, 
				voucher_allrawat	: voucher_allrawat_create, 
				voucher_acara	: voucher_acara_create,
				voucher_nomor_awal	: voucher_nomor_awal_create,
				voucher_nomor_akhir	: voucher_nomor_akhir_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						Ext.MessageBox.alert(post2db+' OK','The Voucher was '+msg+' successfully.');
						voucher_DataStore.reload();
						voucher_createWindow.hide();
						break;
					case 2:
						//EDIT where tidak untuk semua produk atau tidak semua perawatan
						Ext.MessageBox.alert(post2db+' OK','The Voucher was '+msg+' successfully.');
						voucher_DataStore.reload();
						voucher_produk_purge();
						voucher_perawatan_purge();
						voucher_createWindow.hide();
						break;
					case -1:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data tidak bisa disimpan.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						voucher_DataStore.reload();
						voucher_createWindow.hide();
						break;
					default:
						Ext.MessageBox.alert(post2db+' OK','Data berhasil disimpan.');
						voucher_DataStore.reload();
						voucher_createWindow.hide();
						voucher_cetak(result);
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
			return voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function voucher_reset_form(){
		voucher_idField.reset();
		voucher_idField.setValue(null);
		voucher_namaField.reset();
		voucher_namaField.setValue(null);
		//voucher_jenisField.reset();
		//voucher_jenisField.setValue('reward');
		//voucher_pointField.reset();
		voucher_pointField.setValue(0);
		//voucher_jumlahField.reset();
		voucher_jumlahField.setValue(1);
		voucher_kadaluarsaField.reset();
		
		voucher_kadaluarsaField.setValue(null);
		//voucher_cashbackField.reset();
		voucher_cashbackField.setValue(0);
		//voucher_mincashField.reset();
		voucher_mincashField.setValue(0);
		//voucher_diskonField.reset();
		voucher_diskonField.setValue(0);
		voucher_promoField.reset();
		voucher_promoField.setValue(null);
		//voucher_allprodukField.reset();
		voucher_allprodukField.setValue(false);
		//voucher_allrawatField.reset();
		voucher_allrawatField.setValue(false);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function voucher_set_form(){
		voucher_idField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_id'));
		voucher_namaField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_nama'));
		voucher_jenisField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_jenis'));
		voucher_pointField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_point'));
		voucher_jumlahField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_jumlah'));
		voucher_kadaluarsaField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_kadaluarsa'));
		voucher_cashbackField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_cashback'));
		voucher_mincashField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_mincash'));
		voucher_diskonField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_diskon'));
		voucher_promoField.setValue(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_promo'));
		
		if(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_allproduk')=='Y'){
			voucher_allprodukField.setValue(true);
			voucher_produkListEditorGrid.setDisabled(true);
		}else{
			voucher_allprodukField.setValue(false);
			voucher_produkListEditorGrid.setDisabled(false);
		}
		
		if(voucherListEditorGrid.getSelectionModel().getSelected().get('voucher_allrawat')=='Y'){
			voucher_allrawatField.setValue(true);
			voucher_perawatanListEditorGrid.setDisabled(true)
		}else{
			voucher_allrawatField.setValue(false);
			voucher_perawatanListEditorGrid.setDisabled(false);
		}
		
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_voucher_form_valid(){
		return ( voucher_namaField.isValid() && voucher_nomor_awalField.isValid() && voucher_nomor_awalField.isValid() );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!voucher_createWindow.isVisible()){
			voucher_reset_form();
			post2db='CREATE';
			msg='created';
			voucher_createWindow.show();
		} else {
			voucher_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function voucher_confirm_delete(){
		// only one voucher is selected here
		if(voucherListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', voucher_delete);
		} else if(voucherListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', voucher_delete);
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
	function voucher_confirm_update(){
		/* only one record is selected here */
		if(voucherListEditorGrid.selModel.getCount() == 1) {
			voucher_set_form();
			post2db='UPDATE';
			voucher_produk_DataStore.setBaseParam('master_id',get_pk_id());
			voucher_perawatan_DataStore.setBaseParam('master_id',get_pk_id());
			voucher_kupon_DataStore.setBaseParam('master_id',get_pk_id());
			voucher_produk_DataStore.load();
			voucher_perawatan_DataStore.load();
			voucher_kupon_DataStore.load();
			msg='updated';
			voucher_createWindow.show();
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
	function voucher_delete(btn){
		if(btn=='yes'){
			var selections = voucherListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< voucherListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.voucher_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_voucher&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							voucher_DataStore.reload();
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
	voucher_DataStore = new Ext.data.Store({
		id: 'voucher_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_voucher&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'voucher_id'
		},[
		/* dataIndex => insert intovoucher_ColumnModel, Mapping => for initiate table column */ 
			{name: 'voucher_id', type: 'int', mapping: 'voucher_id'}, 
			{name: 'voucher_nama', type: 'string', mapping: 'voucher_nama'}, 
			{name: 'voucher_jenis', type: 'string', mapping: 'voucher_jenis'}, 
			{name: 'voucher_point', type: 'int', mapping: 'voucher_point'}, 
			{name: 'voucher_jumlah', type: 'int', mapping: 'voucher_jumlah'}, 
			{name: 'voucher_kadaluarsa', type: 'date', dateFormat: 'Y-m-d', mapping: 'voucher_kadaluarsa'}, 
			{name: 'voucher_cashback', type: 'float', mapping: 'voucher_cashback'}, 
			{name: 'voucher_mincash', type: 'float', mapping: 'voucher_mincash'}, 
			{name: 'voucher_diskon', type: 'int', mapping: 'voucher_diskon'}, 
			{name: 'voucher_promo', type: 'int', mapping: 'voucher_promo'}, 
			{name: 'voucher_allproduk', type: 'string', mapping: 'voucher_allproduk'}, 
			{name: 'voucher_allrawat', type: 'string', mapping: 'voucher_allrawat'}, 
			{name: 'voucher_creator', type: 'string', mapping: 'voucher_creator'}, 
			{name: 'voucher_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'voucher_date_create'}, 
			{name: 'voucher_update', type: 'string', mapping: 'voucher_update'}, 
			{name: 'voucher_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'voucher_date_update'}, 
			{name: 'voucher_revised', type: 'int', mapping: 'voucher_revised'} 
		]),
		sortInfo:{field: 'voucher_id', direction: "DESC"}
	});
	/* End of Function */
    cbo_voucher_promoDataStore = new Ext.data.Store({
		id: 'cbo_voucher_promoDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_voucher&m=get_promo_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'promo_id'
		},[
			{name: 'voucher_id', type: 'int', mapping: 'promo_id'},
			{name: 'voucher_acara', type: 'string', mapping: 'promo_acara'},
			{name: 'voucher_tempat', type: 'string', mapping: 'promo_tempat'},
			{name: 'voucher_tglmulai', type: 'date', dateFormat: 'Y-m-d', mapping: 'promo_tglmulai'}, 
			{name: 'voucher_tglselesai', type: 'date', dateFormat: 'Y-m-d', mapping: 'promo_tglselesai'}, 
			{name: 'voucher_cashback', type: 'float', mapping: 'promo_cashback'}, 
			{name: 'voucher_mincash', type: 'float', mapping: 'voucher_mincash'}, 
			{name: 'voucher_diskon', type: 'float', mapping: 'voucher_diskon'}, 
			{name: 'voucher_allproduk', type: 'string', mapping: 'voucher_allproduk'}, 
			{name: 'voucher_allrawat', type: 'string', mapping: 'voucher_allrawat'}, 
		]),
		sortInfo:{field: 'voucher_id', direction: "DESC"}
	});
	
	var voucher_promo_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{voucher_acara}</b>| Tempat : {voucher_tempat}<br/>',
			'Tanggal: {voucher_tglmulai:date("M j, Y")} s/d {voucher_tglselesai:date("M j, Y")}</span>',
		'</div></tpl>'
    );
	
  	/* Function for Identify of Window Column Model */
	voucher_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'voucher_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">' + 'Nama Voucher' + '</div>',
			dataIndex: 'voucher_nama',
			width: 260,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: '<div align="center">' + 'Jenis' + '</div>',
			dataIndex: 'voucher_jenis',
			width: 120,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['voucher_jenis_value', 'voucher_jenis_display'],
					data: [['promo','promo'],['reward','reward']]
					}),
				mode: 'local',
               	displayField: 'voucher_jenis_display',
               	valueField: 'voucher_jenis_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: '<div align="center">' + 'Poin' + '</div>',
			dataIndex: 'voucher_point',
			align: 'right',
			width: 60,
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
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'voucher_jumlah',
			align: 'right',
			width: 60,
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
			header: '<div align="center">' + 'Kadaluarsa' + '</div>',
			dataIndex: 'voucher_kadaluarsa',
			width: 70,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		}, 
		{
			header: '<div align="center">' + 'Cashback (Rp)' + '</div>',
			dataIndex: 'voucher_cashback',
			align: 'right',
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: '<div align="center">' + 'Min Transaksi (Rp)' + '</div>',
			dataIndex: 'voucher_mincash',
			align: 'right',
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: '<div align="center">' + 'Diskon (%)' + '</div>',
			dataIndex: 'voucher_diskon',
			align: 'right',
			width: 60,
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
			header: '<div align="center">' + 'Ref Promo' + '</div>',
			dataIndex: 'voucher_promo',
			width: 200,
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
			header: 'Creator',
			dataIndex: 'voucher_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Create on',
			dataIndex: 'voucher_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'voucher_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'voucher_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'voucher_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	voucher_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	voucherListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'voucherListEditorGrid',
		el: 'fp_voucher',
		title: 'Daftar Voucher',
		autoHeight: true,
		store: voucher_DataStore, // DataStore
		cm: voucher_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: voucher_DataStore,
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
			handler: voucher_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			disabled: true,
			iconCls:'icon-delete',
			handler: voucher_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: voucher_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: voucher_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: voucher_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: voucher_print  
		}
		]
	});
	voucherListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	voucher_ContextMenu = new Ext.menu.Menu({
		id: 'voucher_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: voucher_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: voucher_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: voucher_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: voucher_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onvoucher_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		voucher_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		voucher_SelectedRow=rowIndex;
		voucher_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function voucher_editContextMenu(){
		voucherListEditorGrid.startEditing(voucher_SelectedRow,1);
  	}
	/* End of Function */
  	
	voucherListEditorGrid.addListener('rowcontextmenu', onvoucher_ListEditGridContextMenu);
	voucher_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	voucherListEditorGrid.on('afteredit', voucher_update); // inLine Editing Record
	
	/* Identify  voucher_id Field */
	voucher_idField= new Ext.form.NumberField({
		id: 'voucher_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: true,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_nama Field */
	voucher_namaField= new Ext.form.TextField({
		id: 'voucher_namaField',
		fieldLabel: 'Nama Voucher',
		maxLength: 50,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  voucher_jenis Field */
	voucher_jenisField= new Ext.form.ComboBox({
		id: 'voucher_jenisField',
		fieldLabel: 'Jenis',
		store:new Ext.data.SimpleStore({
			fields:['voucher_jenis_value', 'voucher_jenis_display'],
			data:[['promo','promo'],['reward','reward']]
		}),
		mode: 'local',
		displayField: 'voucher_jenis_display',
		valueField: 'voucher_jenis_value',
		anchor: '50%',
		triggerAction: 'all'	
	});
	/* Identify  voucher_point Field */
	voucher_pointField= new Ext.form.NumberField({
		id: 'voucher_pointField',
		fieldLabel: 'Point tukar',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		width: 40,
		maxLength: 4,
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_jumlah Field */
	voucher_jumlahField= new Ext.form.NumberField({
		id: 'voucher_jumlahField',
		fieldLabel: 'Jumlah (lembar)',
		allowNegatife : false,
		blankText: '1',
		maxLength: 4,
		allowDecimals: false,
		width: 40,
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_kadaluarsa Field */
	voucher_kadaluarsaField= new Ext.form.DateField({
		id: 'voucher_kadaluarsaField',
		fieldLabel: 'Kadaluarsa',
		format : 'Y-m-d',
	});
	/* Identify  voucher_cashback Field */
	voucher_cashbackField= new Ext.form.NumberField({
		id: 'voucher_cashbackField',
		fieldLabel: 'Cashback (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_mincash Field */
	voucher_mincashField= new Ext.form.NumberField({
		id: 'voucher_mincashField',
		fieldLabel: 'Minimal Transaksi (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_diskon Field */
	voucher_diskonField= new Ext.form.NumberField({
		id: 'voucher_diskonField',
		fieldLabel: 'Diskon ( % )',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		width: 40,
		maxLength: 2,
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_promo Field */
	voucher_promoField= new Ext.form.ComboBox({
		id: 'voucher_promoField',
		fieldLabel: 'Referensi Promo',
		store: cbo_voucher_promoDataStore,
		mode: 'remote',
		displayField:'voucher_acara',
		valueField: 'voucher_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_promo_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  voucher_allproduk Field */
	voucher_allprodukField= new Ext.form.Checkbox({
		id: 'voucher_allprodukField',
		fieldLabel: 'Berlaku untuk semua Produk ?',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  voucher_allrawat Field */
	voucher_allrawatField= new Ext.form.Checkbox({
		id: 'voucher_allrawatField',
		fieldLabel: 'Berlaku untuk semua Perawatan ?',
		anchor: '95%',
		triggerAction: 'all'	
	});
	voucher_acaraField= new Ext.form.TextField({
		id: 'voucher_acaraField',
		fieldLabel: 'Nama Acara',
		maxLength: 50,
		anchor: '95%'
	});
	/* Cetak Nomor Voucher Awal */
	voucher_nomor_awalField= new Ext.form.NumberField({
		id: 'voucher_nomor_awalField',
		fieldLabel: 'Nomor Awal',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		allowBlank: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Cetak Nomor Voucher Akhir */
	voucher_nomor_akhirField= new Ext.form.NumberField({
		id: 'voucher_nomor_akhirField',
		fieldLabel: 'Nomor Akhir',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		allowBlank: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
  	/*Fieldset Master*/
	voucher_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.6,
				layout: 'form',
				border:false,
				items: [voucher_namaField, voucher_jenisField, voucher_acaraField, voucher_pointField, voucher_jumlahField, voucher_kadaluarsaField, voucher_idField] 
			}
			,{
				columnWidth:0.4,
				layout: 'form',
				labelWidth: 180,
				border:false,
				items: [voucher_cashbackField, voucher_mincashField, voucher_diskonField, voucher_allprodukField,voucher_allrawatField] 
			}
			]
	
	});
	
	voucher_nomorGroup= new Ext.form.FieldSet({
		title: 'Nomor Cetak',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [voucher_nomor_awalField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [voucher_nomor_akhirField] 
			}
			]
	});
	
		
	/*Detail Declaration */
	// Kupon Voucher
	voucher_kupon_DataStore = new Ext.data.Store({
		id: 'voucher_kupon_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_voucher&m=get_voucher_kupon_list', 
			method: 'POST'
		}),baseParams:{start:0,limit:pageS},
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'kvoucher_id', type: 'int', mapping: 'kvoucher_id'},
			{name: 'kvoucher_nomor', type: 'string', mapping: 'kvoucher_nomor'}
		]),
		sortInfo:{field: 'kvoucher_nomor', direction: "ASC"}
	});
	
	
	voucher_kupon_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Nomor Kupon',
			dataIndex: 'kvoucher_nomor',
			width: 150,
			sortable: true,
			readOnly: true
		}]
	);
	
	//kupon grid
	voucher_kuponListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'voucher_kuponListEditorGrid',
		el: 'fp_voucher_kupon',
		title: 'Kupon yang diterbitkan',
		height: 250,
		width: 690,
		autoScroll: true,
		store: voucher_kupon_DataStore, // DataStore
		colModel: voucher_kupon_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: voucher_kupon_DataStore,
			displayInfo: true
		})
	});
	
	/*Detail Declaration */
		
	// Function for json reader of detail
	var voucher_perawatan_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'rvoucher_id'
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rvoucher_id', type: 'int', mapping: 'rvoucher_id'}, 
			{name: 'rvoucher_master', type: 'int', mapping: 'rvoucher_master'}, 
			{name: 'rvoucher_perawatan', type: 'int', mapping: 'rvoucher_perawatan'}
	]);
	//eof
	
	//function for json writer of detail
	var voucher_perawatan_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	voucher_perawatan_DataStore = new Ext.data.Store({
		id: 'voucher_perawatan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_voucher&m=detail_voucher_perawatan_list', 
			method: 'POST'
		}),
		reader: voucher_perawatan_reader,
		baseParams:{master_id: get_pk_id(), start:0, limit: pageS },
		sortInfo:{field: 'rvoucher_id', direction: "ASC"}
	});
	/* End of Function */

	//function for editor of detail
	var editor_voucher_perawatan= new Ext.ux.grid.RowEditor({
        saveText: 'Update',
		listeners: {
			afteredit: function(){
				voucher_perawatan_DataStore.commitChanges();
			}
		}
    });
	//eof
	
	cbo_produk_listDataStore = new Ext.data.Store({
	id: 'cbo_produk_listDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_voucher&m=get_produk_list', 
			method: 'POST'
		}), baseParams: {start: 0, limit: pageS},
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'produk_id', type: 'int', mapping: 'produk_id'},
			{name: 'produk_kode', type: 'string', mapping: 'produk_kode'},
			{name: 'produk_group', type: 'string', mapping: 'group_nama'},
			{name: 'produk_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'produk_nama', type: 'string', mapping: 'produk_nama'}
		]),
	sortInfo:{field: 'produk_nama', direction: "ASC"}
	});
	
	cbo_rawat_listDataStore = new Ext.data.Store({
		id: 'cbo_rawat_listDataStore',
		proxy: new Ext.data.HttpProxy({
				url: 'index.php?c=c_voucher&m=get_rawat_list', 
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
	
	
	var voucher_produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{produk_kode}| <b>{produk_nama}</b></span>',
		'</div></tpl>'
    );
	
	var voucher_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{rawat_kode}| <b>{rawat_nama}</b></span>',
		'</div></tpl>'
    );
	
	Ext.util.Format.comboRenderer = function(combo){
		cbo_rawat_listDataStore.load({params:{query:get_pk_id()}});
		cbo_produk_listDataStore.load({params:{query:get_pk_id()}});
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	};
	
	var combo_voucher_produk=new Ext.form.ComboBox({
			store: cbo_produk_listDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'produk_nama',
			valueField: 'produk_id',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: voucher_produk_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	var combo_voucher_rawat=new Ext.form.ComboBox({
			store: cbo_rawat_listDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'rawat_nama',
			valueField: 'rawat_id',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: voucher_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	//function of detail add
	function voucher_perawatan_add(){
		var edit_voucher_perawatan= new voucher_perawatanListEditorGrid.store.recordType({
			rvoucher_id		:'',		
			rvoucher_master	:'',		
			rvoucher_perawatan:null
		});
		editor_voucher_perawatan.stopEditing();
		voucher_perawatan_DataStore.insert(0, edit_voucher_perawatan);
		voucher_perawatanListEditorGrid.getView().refresh();
		voucher_perawatanListEditorGrid.getSelectionModel().selectRow(0);
		editor_voucher_perawatan.startEditing(0);
	}
	//eof
	
	//declaration of detail coloumn model
	voucher_perawatan_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			dataIndex: 'rvoucher_id',
			readOnly: true,
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Perawatan',
			dataIndex: 'rvoucher_perawatan',
			width: 150,
			sortable: true,
			editor: combo_voucher_rawat,
			renderer: Ext.util.Format.comboRenderer(combo_voucher_rawat)
		}
		]
	);
	voucher_perawatan_ColumnModel.defaultSortable= true;
	//eof
	
	//declaration of detail list editor grid
	voucher_perawatanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'voucher_perawatanListEditorGrid',
		el: 'fp_voucher_perawatan',
		title: 'Voucher untuk Perawatan',
		height: 250,
		width: 690,
		autoScroll: true,
		store: voucher_perawatan_DataStore, // DataStore
		colModel: voucher_perawatan_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_voucher_perawatan],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: voucher_perawatan_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: voucher_perawatan_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: voucher_perawatan_confirm_delete
		}
		]
	});
	//eof
	
	
	
	
	//function for insert detail
	function voucher_perawatan_insert(){
		for(i=0;i<voucher_perawatan_DataStore.getCount();i++){
			voucher_perawatan_record=voucher_perawatan_DataStore.getAt(i);
			if(voucher_perawatan_record.rvoucher_perawatan!=="" && voucher_perawatan_record.rvoucher_perawatan!==null){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_voucher&m=detail_voucher_perawatan_insert',
					params:{
					rvoucher_id	: voucher_perawatan_record.data.rvoucher_id, 
					rvoucher_master	: get_pk_id(), 
					rvoucher_perawatan	: voucher_perawatan_record.data.rvoucher_perawatan
					}	
				});
			}
		}
	}
	//eof
	
	//function for purge detail
	function voucher_perawatan_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_voucher&m=detail_voucher_perawatan_purge',
			params:{ master_id: get_pk_id() },
			timeout: 5000,
			success: function(response){							
				var result=eval(response.responseText);
				voucher_perawatan_insert();
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
	function voucher_perawatan_confirm_delete(){
		// only one record is selected here
		if(voucher_perawatanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', voucher_perawatan_delete);
		} else if(voucher_perawatanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', voucher_perawatan_delete);
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
	function voucher_perawatan_delete(btn){
		if(btn=='yes'){
			var s = voucher_perawatanListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				voucher_perawatan_DataStore.remove(r);
			}
		} 
		voucher_perawatan_DataStore.commitChanges();
	}
	//eof
	// EOF DETAIL
	
	/*Detail Declaration of detail produk*/
		
	// Function for json reader of detail
	var voucher_produk_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'ivoucher_id'
	},[
	/* dataIndex => insert intoproduk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'ivoucher_id', type: 'int', mapping: 'ivoucher_id'}, 
			{name: 'ivoucher_master', type: 'int', mapping: 'ivoucher_master'}, 
			{name: 'ivoucher_produk', type: 'int', mapping: 'ivoucher_produk'}
	]);
	//eof
	
	//function for json writer of detail
	var voucher_produk_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	voucher_produk_DataStore = new Ext.data.Store({
		id: 'voucher_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_voucher&m=detail_voucher_produk_list', 
			method: 'POST'
		}),
		reader: voucher_produk_reader,
		baseParams:{master_id: get_pk_id(), start:0, limit: pageS},
		sortInfo:{field: 'ivoucher_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_voucher_produk= new Ext.ux.grid.RowEditor({
        saveText: 'Update',
		listeners: {
			afteredit: function(){
				voucher_produk_DataStore.commitChanges();
			}
		}
    });
	//eof
	
	
	//function of detail add
	function voucher_produk_add(){
		var edit_voucher_produk= new voucher_produkListEditorGrid.store.recordType({
			ivoucher_id	:'',		
			ivoucher_master	: null,		
			ivoucher_produk	: null	
		});
		editor_voucher_produk.stopEditing();
		voucher_produk_DataStore.insert(0, edit_voucher_produk);
		voucher_produkListEditorGrid.getView().refresh();
		voucher_produkListEditorGrid.getSelectionModel().selectRow(0);
		editor_voucher_produk.startEditing(0);
	}
	
	//declaration of detail coloumn model
	voucher_produk_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			dataIndex: 'ivoucher_id',
			readOnly: true,
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'produk',
			dataIndex: 'ivoucher_produk',
			width: 250,
			sortable: true,
			editor: combo_voucher_produk,
			renderer: Ext.util.Format.comboRenderer(combo_voucher_produk)
		}]
	);
	voucher_produk_ColumnModel.defaultSortable= true;
	//eof
	
	
	//declaration of detail list editor grid
	voucher_produkListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'voucher_produkListEditorGrid',
		el: 'fp_voucher_produk',
		title: 'Voucher untuk Produk',
		height: 250,
		width: 690,
		autoScroll: true,
		store: voucher_produk_DataStore, // DataStore
		colModel: voucher_produk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_voucher_produk],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: voucher_produk_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: voucher_produk_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: voucher_produk_confirm_delete
		}
		]
	});
	//eof
	
		

	//function for purge detail
	function voucher_produk_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_voucher&m=detail_voucher_produk_purge',
			params:{ master_id: get_pk_id() },
			timeout: 5000,
			success: function(response){							
				var result=eval(response.responseText);
				voucher_produk_insert();
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
	
	//function for insert detail
	function voucher_produk_insert(){
		for(i=0;i<voucher_produk_DataStore.getCount();i++){
			voucher_produk_record=voucher_produk_DataStore.getAt(i);
			if(voucher_produk_record.data.ivoucher_produk!=="" && voucher_produk_record.data.ivoucher_produk!==null){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_voucher&m=detail_voucher_produk_insert',
					params:{
					ivoucher_master	: get_pk_id(), 
					ivoucher_produk	: voucher_produk_record.data.ivoucher_produk
					}		
				});
			}
		}
	}
	//eof
	
	
	
	/* Function for Delete Confirm of detail */
	function voucher_produk_confirm_delete(){
		// only one record is selected here
		if(voucher_produkListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', voucher_produk_delete);
		} else if(voucher_produkListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', voucher_produk_delete);
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
	function voucher_produk_delete(btn){
		if(btn=='yes'){
			var s = voucher_produkListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				voucher_produk_DataStore.remove(r);
			}
		}  
		voucher_produk_DataStore.commitChanges();
	}
	//eof
	
		

	// EOF detail
	
	var detail_tab_voucher = new Ext.TabPanel({
		activeTab: 0,
		items: [voucher_produkListEditorGrid,voucher_perawatanListEditorGrid,voucher_kuponListEditorGrid]
	});
	
		
	/* Function for retrieve create Window Panel*/ 
	voucher_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [voucher_masterGroup,voucher_nomorGroup,detail_tab_voucher]
		,
		buttons: [{
				text: 'Save and Close',
				handler: voucher_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					voucher_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	voucher_createWindow= new Ext.Window({
		id: 'voucher_createWindow',
		title: post2db+'Voucher',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_voucher_create',
		items: voucher_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function voucher_list_search(){
		// render according to a SQL date format.
		var voucher_id_search=null;
		var voucher_nama_search=null;
		var voucher_jenis_search=null;
		var voucher_point_search=null;
		var voucher_jumlah_search=null;
		var voucher_kadaluarsa_search_date="";
		var voucher_cashback_search=null;
		var voucher_mincash_search=null;
		var voucher_diskon_search=null;
		var voucher_promo_search=null;
		var voucher_allproduk_search=null;
		var voucher_allrawat_search=null;

		if(voucher_idSearchField.getValue()!==null){voucher_id_search=voucher_idSearchField.getValue();}
		if(voucher_namaSearchField.getValue()!==null){voucher_nama_search=voucher_namaSearchField.getValue();}
		if(voucher_jenisSearchField.getValue()!==null){voucher_jenis_search=voucher_jenisSearchField.getValue();}
		if(voucher_pointSearchField.getValue()!==null){voucher_point_search=voucher_pointSearchField.getValue();}
		if(voucher_jumlahSearchField.getValue()!==null){voucher_jumlah_search=voucher_jumlahSearchField.getValue();}
		if(voucher_kadaluarsaSearchField.getValue()!==""){voucher_kadaluarsa_search_date=voucher_kadaluarsaSearchField.getValue().format('Y-m-d');}
		if(voucher_cashbackSearchField.getValue()!==null){voucher_cashback_search=voucher_cashbackSearchField.getValue();}
		if(voucher_mincashSearchField.getValue()!==null){voucher_mincash_search=voucher_mincashSearchField.getValue();}
		if(voucher_diskonSearchField.getValue()!==null){voucher_diskon_search=voucher_diskonSearchField.getValue();}
		if(voucher_promoSearchField.getValue()!==null){voucher_promo_search=voucher_promoSearchField.getValue();}
		if(voucher_allprodukSearchField.getValue()!==null){voucher_allproduk_search=voucher_allprodukSearchField.getValue();}
		if(voucher_allrawatSearchField.getValue()!==null){voucher_allrawat_search=voucher_allrawatSearchField.getValue();}
		// change the store parameters
		voucher_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			voucher_id	:	voucher_id_search, 
			voucher_nama	:	voucher_nama_search, 
			voucher_jenis	:	voucher_jenis_search, 
			voucher_point	:	voucher_point_search, 
			voucher_jumlah	:	voucher_jumlah_search, 
			voucher_kadaluarsa	:	voucher_kadaluarsa_search_date, 
			voucher_cashback	:	voucher_cashback_search, 
			voucher_mincash	:	voucher_mincash_search, 
			voucher_diskon	:	voucher_diskon_search, 
			voucher_promo	:	voucher_promo_search, 
			voucher_allproduk	:	voucher_allproduk_search, 
			voucher_allrawat	:	voucher_allrawat_search, 
		};
		// Cause the DataStore to do another query : 
		voucher_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function voucher_reset_search(){
		// reset the store parameters
		voucher_DataStore.baseParams = { task: 'LIST' };
		// Cause the DataStore to do another query : 
		voucher_DataStore.reload({params: {start: 0, limit: pageS}});
		voucher_searchWindow.close();
	};
	/* End of Fuction */

	function voucher_reset_SearchForm(){
		voucher_namaSearchField.reset();
		voucher_jenisSearchField.reset();
		voucher_pointSearchField.reset();
		voucher_jumlahSearchField.reset();
		voucher_kadaluarsaSearchField.reset();
		voucher_cashbackSearchField.reset();
		voucher_mincashSearchField.reset();
		voucher_diskonSearchField.reset();
		voucher_promoSearchField.reset();
		voucher_allprodukSearchField.reset();
		voucher_allrawatSearchField.reset();
	}

	
	/* Field for search */
	/* Identify  voucher_id Search Field */
	voucher_idSearchField= new Ext.form.NumberField({
		id: 'voucher_idSearchField',
		fieldLabel: 'Voucher Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_nama Search Field */
	voucher_namaSearchField= new Ext.form.TextField({
		id: 'voucher_namaSearchField',
		fieldLabel: 'Voucher Nama',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  voucher_jenis Search Field */
	voucher_jenisSearchField= new Ext.form.ComboBox({
		id: 'voucher_jenisSearchField',
		fieldLabel: 'Voucher Jenis',
		store:new Ext.data.SimpleStore({
			fields:['value', 'voucher_jenis'],
			data:[['promo','promo'],['reward','reward']]
		}),
		mode: 'local',
		displayField: 'voucher_jenis',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  voucher_point Search Field */
	voucher_pointSearchField= new Ext.form.NumberField({
		id: 'voucher_pointSearchField',
		fieldLabel: 'Voucher Point',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_jumlah Search Field */
	voucher_jumlahSearchField= new Ext.form.NumberField({
		id: 'voucher_jumlahSearchField',
		fieldLabel: 'Voucher Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_kadaluarsa Search Field */
	voucher_kadaluarsaSearchField= new Ext.form.DateField({
		id: 'voucher_kadaluarsaSearchField',
		fieldLabel: 'Voucher Kadaluarsa',
		format : 'Y-m-d',
	
	});
	/* Identify  voucher_cashback Search Field */
	voucher_cashbackSearchField= new Ext.form.NumberField({
		id: 'voucher_cashbackSearchField',
		fieldLabel: 'Voucher Cashback',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_mincash Search Field */
	voucher_mincashSearchField= new Ext.form.NumberField({
		id: 'voucher_mincashSearchField',
		fieldLabel: 'Voucher Mincash',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_diskon Search Field */
	voucher_diskonSearchField= new Ext.form.NumberField({
		id: 'voucher_diskonSearchField',
		fieldLabel: 'Voucher Diskon',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_promo Search Field */
	voucher_promoSearchField= new Ext.form.NumberField({
		id: 'voucher_promoSearchField',
		fieldLabel: 'Voucher Promo',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_allproduk Search Field */
	voucher_allprodukSearchField= new Ext.form.ComboBox({
		id: 'voucher_allprodukSearchField',
		fieldLabel: 'Voucher Allproduk',
		store:new Ext.data.SimpleStore({
			fields:['value', 'voucher_allproduk'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'voucher_allproduk',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  voucher_allrawat Search Field */
	voucher_allrawatSearchField= new Ext.form.ComboBox({
		id: 'voucher_allrawatSearchField',
		fieldLabel: 'Voucher Allrawat',
		store:new Ext.data.SimpleStore({
			fields:['value', 'voucher_allrawat'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'voucher_allrawat',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	voucher_searchForm = new Ext.FormPanel({
		labelAlign: 'top',
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
				items: [voucher_namaSearchField, voucher_jenisSearchField, voucher_pointSearchField, voucher_jumlahSearchField, voucher_kadaluarsaSearchField] 
			}
 
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [voucher_cashbackSearchField, voucher_mincashSearchField, voucher_diskonSearchField, voucher_promoSearchField, voucher_allprodukSearchField,voucher_allrawatSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: voucher_list_search
			},{
				text: 'Close',
				handler: function(){
					voucher_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	voucher_searchWindow = new Ext.Window({
		title: 'voucher Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_voucher_search',
		items: voucher_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!voucher_searchWindow.isVisible()){
			voucher_reset_SearchForm();
			voucher_searchWindow.show();
		} else {
			voucher_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function voucher_print(){
		var searchquery = "";
		var voucher_nama_print=null;
		var voucher_jenis_print=null;
		var voucher_point_print=null;
		var voucher_jumlah_print=null;
		var voucher_kadaluarsa_print_date="";
		var voucher_cashback_print=null;
		var voucher_mincash_print=null;
		var voucher_diskon_print=null;
		var voucher_promo_print=null;
		var voucher_allproduk_print=null;
		var voucher_allrawat_print=null;
		var win;              
		// check if we do have some search data...
		if(voucher_DataStore.baseParams.query!==null){searchquery = voucher_DataStore.baseParams.query;}
		if(voucher_DataStore.baseParams.voucher_nama!==null){voucher_nama_print = voucher_DataStore.baseParams.voucher_nama;}
		if(voucher_DataStore.baseParams.voucher_jenis!==null){voucher_jenis_print = voucher_DataStore.baseParams.voucher_jenis;}
		if(voucher_DataStore.baseParams.voucher_point!==null){voucher_point_print = voucher_DataStore.baseParams.voucher_point;}
		if(voucher_DataStore.baseParams.voucher_jumlah!==null){voucher_jumlah_print = voucher_DataStore.baseParams.voucher_jumlah;}
		if(voucher_DataStore.baseParams.voucher_kadaluarsa!==""){voucher_kadaluarsa_print_date = voucher_DataStore.baseParams.voucher_kadaluarsa;}
		if(voucher_DataStore.baseParams.voucher_cashback!==null){voucher_cashback_print = voucher_DataStore.baseParams.voucher_cashback;}
		if(voucher_DataStore.baseParams.voucher_mincash!==null){voucher_mincash_print = voucher_DataStore.baseParams.voucher_mincash;}
		if(voucher_DataStore.baseParams.voucher_diskon!==null){voucher_diskon_print = voucher_DataStore.baseParams.voucher_diskon;}
		if(voucher_DataStore.baseParams.voucher_promo!==null){voucher_promo_print = voucher_DataStore.baseParams.voucher_promo;}
		if(voucher_DataStore.baseParams.voucher_allproduk!==null){voucher_allproduk_print = voucher_DataStore.baseParams.voucher_allproduk;}
		if(voucher_DataStore.baseParams.voucher_allrawat!==null){voucher_allrawat_print = voucher_DataStore.baseParams.voucher_allrawat;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_voucher&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			voucher_nama : voucher_nama_print,
			voucher_jenis : voucher_jenis_print,
			voucher_point : voucher_point_print,
			voucher_jumlah : voucher_jumlah_print,
		  	voucher_kadaluarsa : voucher_kadaluarsa_print_date, 
			voucher_cashback : voucher_cashback_print,
			voucher_mincash : voucher_mincash_print,
			voucher_diskon : voucher_diskon_print,
			voucher_promo : voucher_promo_print,
			voucher_allproduk : voucher_allproduk_print,
			voucher_allrawat : voucher_allrawat_print,
		  	currentlisting: voucher_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./voucherlist.html','voucherlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function voucher_export_excel(){
		var searchquery = "";
		var voucher_nama_2excel=null;
		var voucher_jenis_2excel=null;
		var voucher_point_2excel=null;
		var voucher_jumlah_2excel=null;
		var voucher_kadaluarsa_2excel_date="";
		var voucher_cashback_2excel=null;
		var voucher_mincash_2excel=null;
		var voucher_diskon_2excel=null;
		var voucher_promo_2excel=null;
		var voucher_allproduk_2excel=null;
		var voucher_allrawat_2excel=null;
		var win;              
		// check if we do have some search data...
		if(voucher_DataStore.baseParams.query!==null){searchquery = voucher_DataStore.baseParams.query;}
		if(voucher_DataStore.baseParams.voucher_nama!==null){voucher_nama_2excel = voucher_DataStore.baseParams.voucher_nama;}
		if(voucher_DataStore.baseParams.voucher_jenis!==null){voucher_jenis_2excel = voucher_DataStore.baseParams.voucher_jenis;}
		if(voucher_DataStore.baseParams.voucher_point!==null){voucher_point_2excel = voucher_DataStore.baseParams.voucher_point;}
		if(voucher_DataStore.baseParams.voucher_jumlah!==null){voucher_jumlah_2excel = voucher_DataStore.baseParams.voucher_jumlah;}
		if(voucher_DataStore.baseParams.voucher_kadaluarsa!==""){voucher_kadaluarsa_2excel_date = voucher_DataStore.baseParams.voucher_kadaluarsa;}
		if(voucher_DataStore.baseParams.voucher_cashback!==null){voucher_cashback_2excel = voucher_DataStore.baseParams.voucher_cashback;}
		if(voucher_DataStore.baseParams.voucher_mincash!==null){voucher_mincash_2excel = voucher_DataStore.baseParams.voucher_mincash;}
		if(voucher_DataStore.baseParams.voucher_diskon!==null){voucher_diskon_2excel = voucher_DataStore.baseParams.voucher_diskon;}
		if(voucher_DataStore.baseParams.voucher_promo!==null){voucher_promo_2excel = voucher_DataStore.baseParams.voucher_promo;}
		if(voucher_DataStore.baseParams.voucher_allproduk!==null){voucher_allproduk_2excel = voucher_DataStore.baseParams.voucher_allproduk;}
		if(voucher_DataStore.baseParams.voucher_allrawat!==null){voucher_allrawat_2excel = voucher_DataStore.baseParams.voucher_allrawat;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_voucher&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			voucher_nama : voucher_nama_2excel,
			voucher_jenis : voucher_jenis_2excel,
			voucher_point : voucher_point_2excel,
			voucher_jumlah : voucher_jumlah_2excel,
		  	voucher_kadaluarsa : voucher_kadaluarsa_2excel_date, 
			voucher_cashback : voucher_cashback_2excel,
			voucher_mincash : voucher_mincash_2excel,
			voucher_diskon : voucher_diskon_2excel,
			voucher_promo : voucher_promo_2excel,
			voucher_allproduk : voucher_allproduk_2excel,
			voucher_allrawat : voucher_allrawat_2excel,
		  	currentlisting: voucher_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	voucher_jenisField.on("select",function(){
		if(voucher_jenisField.getValue()=='reward'){
			//voucher_promoField.getEl().up('.x-form-item').setDisplayed(false);
			voucher_acaraField.getEl().up('.x-form-item').setDisplayed(false);
			voucher_pointField.getEl().up('.x-form-item').setDisplayed(true);

		}else{
			//voucher_promoField.getEl().up('.x-form-item').setDisplayed(true);
			voucher_acaraField.getEl().up('.x-form-item').setDisplayed(true);
			voucher_pointField.getEl().up('.x-form-item').setDisplayed(false);
		}
	});
	
	voucher_produkListEditorGrid.setDisabled(true);
	voucher_perawatanListEditorGrid.setDisabled(true);
	
	voucher_allprodukField.on("check",function(){
		if(voucher_allprodukField.getValue()==true)
			voucher_produkListEditorGrid.setDisabled(true);
		else
			voucher_produkListEditorGrid.setDisabled(false);
	});
	
	voucher_allrawatField.on("check",function(){
		if(voucher_allrawatField.getValue()==true)
			voucher_perawatanListEditorGrid.setDisabled(true);
		else
			voucher_perawatanListEditorGrid.setDisabled(false);
	});
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_voucher"></div>
         <div id="fp_voucher_produk"></div>
         <div id="fp_voucher_perawatan"></div>
         <div id="fp_voucher_kupon"></div>
		<div id="elwindow_voucher_create"></div>
        <div id="elwindow_voucher_search"></div>
    </div>
</div>
</body>