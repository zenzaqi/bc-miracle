<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: karyawan View
	+ Description	: For record view
	+ Filename 		: v_karyawan.php
 	+ Author  		: Mukhlison
 	+ Created on 06/Aug/2009 17:08:43
	
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
var karyawan_DataStore;
var karyawan_ColumnModel;
var karyawanListEditorGrid;
var karyawan_createForm;
var karyawan_createWindow;
var karyawan_searchForm;
var karyawan_searchWindow;
var karyawan_SelectedRow;
var karyawan_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var karyawan_idField;
var karyawan_noField;
var karyawan_npwpField;
var karyawan_usernameField;
var karyawan_namaField;
var karyawan_kelaminField;
var karyawan_tgllahirField;
var karyawan_alamatField;
var karyawan_kotaField;
var karyawan_kodeposField;
var karyawan_emailField;
var karyawan_emiracleField;
var karyawan_keteranganField;
var karyawan_notelpField;
var karyawan_notelp2Field;
var karyawan_notelp3Field;
var karyawan_notelp4Field;
var karyawan_cabangField;
var karyawan_jabatanField;
var karyawan_departemenField;
var karyawan_golonganField;
var karyawan_golongantxtField;
var karyawan_tglmasukField;
var karyawan_atasanField;
var karyawan_aktifField;

var karyawan_idSearchField;
var karyawan_noSearchField;
var karyawan_npwpSearchField;
var karyawan_usernameSearchField;
var karyawan_namaSearchField;
var karyawan_kelaminSearchField;
var karyawan_tgllahirSearchField;
var karyawan_alamatSearchField;
var karyawan_kotaSearchField;
var karyawan_kodeposSearchField;
var karyawan_emailSearchField;
var karyawan_emiracleSearchField;
var karyawan_keteranganSearchField;
var karyawan_notelpSearchField;
var karyawan_notelp2SearchField;
var karyawan_notelp3SearchField;
var karyawan_notelp4SearchField;
var karyawan_cabangSearchField;
var karyawan_jabatanSearchField;
var karyawan_departemenSearchField;
var karyawan_golonganSearchField;
var karyawan_tglmasukSearchField;
var karyawan_atasanSearchField;
var karyawan_aktifSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function karyawan_update(oGrid_event){
		var karyawan_id_update_pk="";
		var karyawan_no_update=null;
		var karyawan_npwp_update=null;
		var karyawan_username_update=null;
		var karyawan_nama_update=null;
		var karyawan_kelamin_update=null;
		var karyawan_tgllahir_update_date="";
		var karyawan_alamat_update=null;
		var karyawan_kota_update=null;
		var karyawan_kodepos_update=null;
		var karyawan_email_update=null;
		var karyawan_emiracle_update=null;
		var karyawan_keterangan_update=null;
		var karyawan_notelp_update=null;
		var karyawan_notelp2_update=null;
		var karyawan_notelp3_update=null;
		var karyawan_notelp4_update=null;
		var karyawan_cabang_update=null;
		var karyawan_jabatan_update=null;
		var karyawan_departemen_update=null;
		var karyawan_golongan_update=null;
		var karyawan_tglmasuk_update_date="";
		var karyawan_atasan_update=null;
		var karyawan_aktif_update=null;
	
		karyawan_id_update_pk = oGrid_event.record.data.karyawan_id;
		if(oGrid_event.record.data.karyawan_no!== null){karyawan_no_update = oGrid_event.record.data.karyawan_no;}
		if(oGrid_event.record.data.karyawan_npwp!== null){karyawan_npwp_update = oGrid_event.record.data.karyawan_npwp;}
		if(oGrid_event.record.data.karyawan_username!== null){karyawan_username_update = oGrid_event.record.data.karyawan_username;}
		if(oGrid_event.record.data.karyawan_nama!== null){karyawan_nama_update = oGrid_event.record.data.karyawan_nama;}
		if(oGrid_event.record.data.karyawan_kelamin!== null){karyawan_kelamin_update = oGrid_event.record.data.karyawan_kelamin;}
		if(oGrid_event.record.data.karyawan_tgllahir!== ""){karyawan_tgllahir_update_date =oGrid_event.record.data.karyawan_tgllahir.format('Y-m-d');}
		if(oGrid_event.record.data.karyawan_alamat!== null){karyawan_alamat_update = oGrid_event.record.data.karyawan_alamat;}
		if(oGrid_event.record.data.karyawan_kota!== null){karyawan_kota_update = oGrid_event.record.data.karyawan_kota;}
		if(oGrid_event.record.data.karyawan_kodepos!== null){karyawan_kodepos_update = oGrid_event.record.data.karyawan_kodepos;}
		if(oGrid_event.record.data.karyawan_email!== null){karyawan_email_update = oGrid_event.record.data.karyawan_email;}
		if(oGrid_event.record.data.karyawan_emiracle!== null){karyawan_emiracle_update = oGrid_event.record.data.karyawan_emiracle;}
		if(oGrid_event.record.data.karyawan_keterangan!== null){karyawan_keterangan_update = oGrid_event.record.data.karyawan_keterangan;}
		if(oGrid_event.record.data.karyawan_notelp!== null){karyawan_notelp_update = oGrid_event.record.data.karyawan_notelp;}
		if(oGrid_event.record.data.karyawan_notelp2!== null){karyawan_notelp2_update = oGrid_event.record.data.karyawan_notelp2;}
		if(oGrid_event.record.data.karyawan_notelp3!== null){karyawan_notelp3_update = oGrid_event.record.data.karyawan_notelp3;}
		if(oGrid_event.record.data.karyawan_notelp4!== null){karyawan_notelp4_update = oGrid_event.record.data.karyawan_notelp4;}
		if(oGrid_event.record.data.karyawan_cabang!== null){karyawan_cabang_update = oGrid_event.record.data.karyawan_cabang;}
		if(oGrid_event.record.data.karyawan_jabatan!== null){karyawan_jabatan_update = oGrid_event.record.data.karyawan_jabatan;}
		if(oGrid_event.record.data.karyawan_departemen!== null){karyawan_departemen_update = oGrid_event.record.data.karyawan_departemen;}
		if(oGrid_event.record.data.karyawan_golongan!== null){karyawan_golongan_update = oGrid_event.record.data.karyawan_golongan;}
		if(oGrid_event.record.data.karyawan_tglmasuk!== ""){karyawan_tglmasuk_update_date =oGrid_event.record.data.karyawan_tglmasuk.format('Y-m-d');}
		if(oGrid_event.record.data.karyawan_atasan!== null){karyawan_atasan_update = oGrid_event.record.data.karyawan_atasan;}
		if(oGrid_event.record.data.karyawan_aktif!== null){karyawan_aktif_update = oGrid_event.record.data.karyawan_aktif;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_karyawan&m=get_action',
			params: {
				task: "UPDATE",
				karyawan_id	: karyawan_id_update_pk,				
				karyawan_no	:karyawan_no_update,		
				karyawan_npwp	:karyawan_npwp_update,		
				karyawan_username	:karyawan_username_update,		
				karyawan_nama	:karyawan_nama_update,		
				karyawan_kelamin	:karyawan_kelamin_update,		
				karyawan_tgllahir	: karyawan_tgllahir_update_date,				
				karyawan_alamat	:karyawan_alamat_update,		
				karyawan_kota	:karyawan_kota_update,		
				karyawan_kodepos	:karyawan_kodepos_update,		
				karyawan_email	:karyawan_email_update,		
				karyawan_emiracle	:karyawan_emiracle_update,		
				karyawan_keterangan	:karyawan_keterangan_update,		
				karyawan_notelp	:karyawan_notelp_update,		
				karyawan_notelp2	:karyawan_notelp2_update,		
				karyawan_notelp3	:karyawan_notelp3_update,
				karyawan_notelp4	:karyawan_notelp4_update,
				karyawan_cabang	:karyawan_cabang_update,		
				karyawan_jabatan	:karyawan_jabatan_update,		
				karyawan_departemen	:karyawan_departemen_update,		
				karyawan_golongan	:karyawan_golongan_update,		
				karyawan_tglmasuk	: karyawan_tglmasuk_update_date,				
				karyawan_atasan	:karyawan_atasan_update,		
				karyawan_aktif	:karyawan_aktif_update,		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						karyawan_DataStore.commitChanges();
						karyawan_DataStore.reload();
						cbo_karyawan_cabang_DataStore.reload();
						cbo_karyawan_departemen_DataStore.reload();
						cbo_karyawan_jabatan_DataStore.reload();
						cbo_karyawan_atasan_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the karyawan.',
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
	function karyawan_create(){
		if(is_karyawan_form_valid()){
		
		var karyawan_id_create_pk=null;
		var karyawan_no_create=null;
		var karyawan_npwp_create=null;
		var karyawan_username_create=null;
		var karyawan_nama_create=null;
		var karyawan_kelamin_create=null;
		var karyawan_tgllahir_create_date="";
		var karyawan_alamat_create=null;
		var karyawan_kota_create=null;
		var karyawan_kodepos_create=null;
		var karyawan_email_create=null;
		var karyawan_emiracle_create=null;
		var karyawan_keterangan_create=null;
		var karyawan_notelp_create=null;
		var karyawan_notelp2_create=null;
		var karyawan_notelp3_create=null;
		var karyawan_notelp4_create=null;
		var karyawan_cabang_create=null;
		var karyawan_jabatan_create=null;
		var karyawan_departemen_create=null;
		var karyawan_golongan_create=null;
		var karyawan_golongantxt_create=null;
		var karyawan_tglmasuk_create_date="";
		var karyawan_atasan_create=null;
		var karyawan_aktif_create=null;

		karyawan_id_create_pk=get_pk_id();
		if(karyawan_noField.getValue()!== null){karyawan_no_create = karyawan_noField.getValue();}
		if(karyawan_npwpField.getValue()!== null){karyawan_npwp_create = karyawan_npwpField.getValue();}
		if(karyawan_usernameField.getValue()!== null){karyawan_username_create = karyawan_usernameField.getValue();}
		if(karyawan_namaField.getValue()!== null){karyawan_nama_create = karyawan_namaField.getValue();}
		if(karyawan_kelaminField.getValue()!== null){karyawan_kelamin_create = karyawan_kelaminField.getValue();}
		if(karyawan_tgllahirField.getValue()!== ""){karyawan_tgllahir_create_date = karyawan_tgllahirField.getValue().format('Y-m-d');}
		if(karyawan_alamatField.getValue()!== null){karyawan_alamat_create = karyawan_alamatField.getValue();}
		if(karyawan_kotaField.getValue()!== null){karyawan_kota_create = karyawan_kotaField.getValue();}
		if(karyawan_kodeposField.getValue()!== null){karyawan_kodepos_create = karyawan_kodeposField.getValue();}
		if(karyawan_emailField.getValue()!== null){karyawan_email_create = karyawan_emailField.getValue();}
		if(karyawan_emiracleField.getValue()!== null){karyawan_emiracle_create = karyawan_emiracleField.getValue();}
		if(karyawan_keteranganField.getValue()!== null){karyawan_keterangan_create = karyawan_keteranganField.getValue();}
		if(karyawan_notelpField.getValue()!== null){karyawan_notelp_create = karyawan_notelpField.getValue();}
		if(karyawan_notelp2Field.getValue()!== null){karyawan_notelp2_create = karyawan_notelp2Field.getValue();}
		if(karyawan_notelp3Field.getValue()!== null){karyawan_notelp3_create = karyawan_notelp3Field.getValue();}
		if(karyawan_notelp4Field.getValue()!== null){karyawan_notelp4_create = karyawan_notelp4Field.getValue();}
		if(karyawan_cabangField.getValue()!== null){karyawan_cabang_create = karyawan_cabangField.getValue();}
		if(karyawan_jabatanField.getValue()!== null){karyawan_jabatan_create = karyawan_jabatanField.getValue();}
		if(karyawan_departemenField.getValue()!== null){karyawan_departemen_create = karyawan_departemenField.getValue();}
		if(karyawan_golonganField.getValue()!== null){karyawan_golongan_create = karyawan_golonganField.getValue();}
		if(karyawan_golongantxtField.getValue()!== null){karyawan_golongantxt_create = karyawan_golongantxtField.getValue();}
		if(karyawan_tglmasukField.getValue()!== ""){karyawan_tglmasuk_create_date = karyawan_tglmasukField.getValue().format('Y-m-d');}
		if(karyawan_atasanField.getValue()!== null){karyawan_atasan_create = karyawan_atasanField.getValue();}
		if(karyawan_aktifField.getValue()!== null){karyawan_aktif_create = karyawan_aktifField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_karyawan&m=get_action',
				params: {
					task: post2db,
					karyawan_id	: karyawan_id_create_pk,	
					karyawan_no	: karyawan_no_create,	
					karyawan_npwp	: karyawan_npwp_create,	
					karyawan_username	: karyawan_username_create,	
					karyawan_nama	: karyawan_nama_create,	
					karyawan_kelamin	: karyawan_kelamin_create,	
					karyawan_tgllahir	: karyawan_tgllahir_create_date,					
					karyawan_alamat	: karyawan_alamat_create,	
					karyawan_kota	: karyawan_kota_create,	
					karyawan_kodepos	: karyawan_kodepos_create,	
					karyawan_email	: karyawan_email_create,	
					karyawan_emiracle	: karyawan_emiracle_create,	
					karyawan_keterangan	: karyawan_keterangan_create,	
					karyawan_notelp	: karyawan_notelp_create,	
					karyawan_notelp2	: karyawan_notelp2_create,	
					karyawan_notelp3	: karyawan_notelp3_create,	
					karyawan_notelp4	: karyawan_notelp4_create,	
					karyawan_cabang	: karyawan_cabang_create,	
					karyawan_jabatan	: karyawan_jabatan_create,	
					karyawan_departemen	: karyawan_departemen_create,	
					karyawan_golongan	: karyawan_golongan_create,	
					karyawan_golongantxt	: karyawan_golongantxt_create,	
					karyawan_tglmasuk	: karyawan_tglmasuk_create_date,					
					karyawan_atasan	: karyawan_atasan_create,	
					karyawan_aktif	: karyawan_aktif_create,	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Karyawan was '+msg+' successfully.');
							karyawan_DataStore.reload();
							cbo_karyawan_cabang_DataStore.reload();
							cbo_karyawan_departemen_DataStore.reload();
							cbo_karyawan_jabatan_DataStore.reload();
							cbo_karyawan_atasan_DataStore.reload();

							karyawan_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Karyawan.',
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
				width: 230,
				msg: 'Data Belum Lengkap!.',
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
			return karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function karyawan_reset_form(){
		karyawan_noField.reset();
		karyawan_noField.setValue(null);
		karyawan_npwpField.reset();
		karyawan_npwpField.setValue(null);
		karyawan_usernameField.reset();
		karyawan_usernameField.setValue(null);
		karyawan_namaField.reset();
		karyawan_namaField.setValue(null);
		karyawan_kelaminField.reset();
		karyawan_kelaminField.setValue(null);
		karyawan_tgllahirField.reset();
		karyawan_tgllahirField.setValue(null);
		karyawan_alamatField.reset();
		karyawan_alamatField.setValue(null);
		karyawan_kotaField.reset();
		karyawan_kotaField.setValue(null);
		karyawan_kodeposField.reset();
		karyawan_kodeposField.setValue(null);
		karyawan_emailField.reset();
		karyawan_emailField.setValue(null);
		karyawan_emiracleField.reset();
		karyawan_emiracleField.setValue(null);
		karyawan_keteranganField.reset();
		karyawan_keteranganField.setValue(null);
		karyawan_notelpField.reset();
		karyawan_notelpField.setValue(null);
		karyawan_notelp2Field.reset();
		karyawan_notelp2Field.setValue(null);
		karyawan_notelp3Field.reset();
		karyawan_notelp3Field.setValue(null);
		karyawan_notelp4Field.reset();
		karyawan_notelp4Field.setValue(null);
		karyawan_cabangField.reset();
		karyawan_cabangField.setValue(null);
		karyawan_jabatanField.reset();
		karyawan_jabatanField.setValue(null);
		karyawan_departemenField.reset();
		karyawan_departemenField.setValue(null);
		karyawan_golonganField.reset();
		karyawan_golonganField.setValue(null);
		karyawan_tglmasukField.reset();
		karyawan_tglmasukField.setValue(null);
		karyawan_atasanField.reset();
		karyawan_atasanField.setValue(null);
		karyawan_aktifField.reset();
		karyawan_aktifField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function karyawan_set_form(){
		karyawan_noField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_no'));
		karyawan_npwpField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_npwp'));
		karyawan_usernameField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_username'));
		karyawan_namaField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_nama'));
		karyawan_kelaminField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_kelamin'));
		karyawan_tgllahirField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_tgllahir'));
		karyawan_alamatField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_alamat'));
		karyawan_kotaField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_kota'));
		karyawan_kodeposField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_kodepos'));
		karyawan_emailField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_email'));
		karyawan_emiracleField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_emiracle'));
		karyawan_keteranganField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_keterangan'));
		karyawan_notelpField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_notelp'));
		karyawan_notelp2Field.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_notelp2'));
		karyawan_notelp3Field.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_notelp3'));
		karyawan_notelp4Field.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_notelp4'));
		karyawan_cabangField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_cabang'));
		karyawan_jabatanField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_jabatan'));
		karyawan_departemenField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_departemen'));
		karyawan_golonganField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_golongan'));
		karyawan_tglmasukField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_tglmasuk'));
		karyawan_atasanField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_atasan'));
		karyawan_aktifField.setValue(karyawanListEditorGrid.getSelectionModel().getSelected().get('karyawan_aktif'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_karyawan_form_valid(){
		return ( karyawan_namaField.isValid() && karyawan_usernameField.isValid() &&  karyawan_cabangField.isValid() && karyawan_jabatanField.isValid() && karyawan_departemenField.isValid() && karyawan_kelaminField.isValid() );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		cbo_karyawan_cabang_DataStore.reload();
		cbo_karyawan_departemen_DataStore.reload();
		cbo_karyawan_jabatan_DataStore.reload();
		cbo_karyawan_atasan_DataStore.reload();
		
		if(!karyawan_createWindow.isVisible()){
			karyawan_reset_form();
			post2db='CREATE';
			msg='created';
			karyawan_aktifField.setValue('Aktif');
			karyawan_createWindow.show();
		} else {
			karyawan_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function karyawan_confirm_delete(){
		// only one karyawan is selected here
		if(karyawanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', karyawan_delete);
		} else if(karyawanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', karyawan_delete);
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
	function karyawan_confirm_update(){
		/* only one record is selected here */
		if(karyawanListEditorGrid.selModel.getCount() == 1) {
			karyawan_set_form();
			post2db='UPDATE';
			msg='updated';
			cbo_karyawan_atasan_DataStore.load({params: {karyawan_id: get_pk_id()}});
			karyawan_createWindow.show();
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
	function karyawan_delete(btn){
		if(btn=='yes'){
			var selections = karyawanListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< karyawanListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.karyawan_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_karyawan&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							karyawan_DataStore.reload();
							cbo_karyawan_cabang_DataStore.reload();
							cbo_karyawan_departemen_DataStore.reload();
							cbo_karyawan_jabatan_DataStore.reload();
							cbo_karyawan_atasan_DataStore.reload();

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
	karyawan_DataStore = new Ext.data.Store({
		id: 'karyawan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_karyawan&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0, limit: pageS }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'karyawan_id'
		},[
		/* dataIndex => insert intokaryawan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_id', type: 'int', mapping: 'karyawan_id'},
			{name: 'karyawan_no', type: 'string', mapping: 'karyawan_no'},
			{name: 'karyawan_npwp', type: 'string', mapping: 'karyawan_npwp'},
			{name: 'karyawan_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'karyawan_nama', type: 'string', mapping: 'karyawan_nama'},
			{name: 'karyawan_kelamin', type: 'string', mapping: 'karyawan_kelamin'},
			{name: 'karyawan_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'karyawan_tgllahir'},
			{name: 'karyawan_alamat', type: 'string', mapping: 'karyawan_alamat'},
			{name: 'karyawan_kota', type: 'string', mapping: 'karyawan_kota'},
			{name: 'karyawan_kodepos', type: 'string', mapping: 'karyawan_kodepos'},
			{name: 'karyawan_email', type: 'string', mapping: 'karyawan_email'},
			{name: 'karyawan_emiracle', type: 'string', mapping: 'karyawan_emiracle'},
			{name: 'karyawan_keterangan', type: 'string', mapping: 'karyawan_keterangan'},
			{name: 'karyawan_notelp', type: 'string', mapping: 'karyawan_notelp'},
			{name: 'karyawan_notelp2', type: 'string', mapping: 'karyawan_notelp2'},
			{name: 'karyawan_notelp3', type: 'string', mapping: 'karyawan_notelp3'},
			{name: 'karyawan_notelp4', type: 'string', mapping: 'karyawan_notelp4'},
			{name: 'karyawan_cabang', type: 'string', mapping: 'cabang_nama'},
			{name: 'karyawan_jabatan', type: 'string', mapping: 'jabatan_nama'},
			{name: 'karyawan_departemen', type: 'string', mapping: 'departemen_nama'},
			{name: 'karyawan_golongan', type: 'string', mapping: 'karyawan_golongan'},
			{name: 'karyawan_tglmasuk', type: 'date', dateFormat: 'Y-m-d', mapping: 'karyawan_tglmasuk'},
			{name: 'karyawan_atasan', type: 'int', mapping: 'karyawan_atasan'},
			{name: 'karyawan_aktif', type: 'string', mapping: 'karyawan_aktif'},
			{name: 'karyawan_creator', type: 'string', mapping: 'karyawan_creator'},
			{name: 'karyawan_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'karyawan_date_create'},
			{name: 'karyawan_update', type: 'string', mapping: 'karyawan_update'},
			{name: 'karyawan_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'karyawan_date_update'},
			{name: 'karyawan_revised', type: 'int', mapping: 'karyawan_revised'}
		]),
		sortInfo:{field: 'karyawan_id', direction: "ASC"}
	});
	/* End of Function */
	
	cbo_karyawan_atasan_DataStore = new Ext.data.Store({
		id: 'cbo_karyawan_atasan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_karyawan&m=get_karyawan_atasan_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_atasan_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'karyawan_atasan_value', type: 'int', mapping: 'karyawan_id'}
		]),
		sortInfo:{field: 'karyawan_atasan_display', direction: "ASC"}
	});
	
	cbo_karyawan_golongan_DataStore = new Ext.data.Store({
		id: 'cbo_karyawan_golongan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_karyawan&m=get_karyawan_golongan_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_golongan_display', type: 'string', mapping: 'karyawan_golongan'}
		]),
		sortInfo:{field: 'karyawan_golongan_display', direction: "ASC"}
	});
	
	cbo_karyawan_jabatan_DataStore = new Ext.data.Store({
		id: 'cbo_karyawan_jabatan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_karyawan&m=get_karyawan_jabatan_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_jabatan_display', type: 'string', mapping: 'jabatan_nama'},
			{name: 'karyawan_jabatan_value', type: 'int', mapping: 'jabatan_id'}
		]),
		sortInfo:{field: 'karyawan_jabatan_value', direction: "ASC"}
	});
	
	cbo_karyawan_cabang_DataStore = new Ext.data.Store({
		id: 'cbo_karyawan_cabang_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_karyawan&m=get_karyawan_cabang_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_cabang_display', type: 'string', mapping: 'cabang_nama'},
			{name: 'karyawan_cabang_value', type: 'int', mapping: 'cabang_id'}
		]),
		sortInfo:{field: 'karyawan_cabang_value', direction: "ASC"}
	});
	
	cbo_karyawan_departemen_DataStore = new Ext.data.Store({
		id: 'cbo_karyawan_departemen_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_karyawan&m=get_karyawan_departemen_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_departemen_display', type: 'string', mapping: 'departemen_nama'},
			{name: 'karyawan_departemen_value', type: 'int', mapping: 'departemen_id'}
		]),
		sortInfo:{field: 'karyawan_departemen_value', direction: "ASC"}
	});
    
  	/* Function for Identify of Window Column Model */
	karyawan_ColumnModel = new Ext.grid.ColumnModel(
		[/*{
			//index=0
			header: '#',
			readOnly: true,
			dataIndex: 'karyawan_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},*/
		{
			/*index=1*/
			header: '<div align="center">' + 'NIK' + '</div>',
			dataIndex: 'karyawan_no',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		},
		{
			/*index=2*/
			header: '<div align="center">' + 'NPWP' + '</div>',
			dataIndex: 'karyawan_npwp',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	}),
			hidden: true
		},
		{
			/*index=4*/
			header: '<div align="center">' + 'Nama Lengkap' + '</div>',
			dataIndex: 'karyawan_nama',
			width: 180,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			/*index=3*/
			header: '<div align="center">' + 'Panggilan' + '</div>',
			dataIndex: 'karyawan_username',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 15
          	})
		},
		{
			/*index=5*/
			header: '<div align="center">' + 'L/P' + '</div>',
			dataIndex: 'karyawan_kelamin',
			width: 30,
			sortable: true,
			hidden: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['karyawan_kelamin_value', 'karyawan_kelamin_display'],
					data: [['L','Laki-laki'],['P','Perempuan']]
					}),
				mode: 'local',
               	displayField: 'karyawan_kelamin_display',
               	valueField: 'karyawan_kelamin_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			/*index=6*/
			header: '<div align="center">' + 'Tgl Lahir' + '</div>',
			dataIndex: 'karyawan_tgllahir',
			width: 80,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		},
		{
			/*index=7*/
			header: '<div align="center">' + 'Alamat' + '</div>',
			dataIndex: 'karyawan_alamat',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			/*index=8*/
			header: '<div align="center">' + 'Kota' + '</div>',
			dataIndex: 'karyawan_kota',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 30
          	})
		},
		{
			/*index=9*/
			header: '<div align="center">' + 'Kode Pos' + '</div>',
			dataIndex: 'karyawan_kodepos',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 10
          	}), 
			hidden: true
		},
		{
			/*index=10*/
			header: '<div align="center">' + 'Email' + '</div>',
			dataIndex: 'karyawan_email',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 40
          	}),
			hidden: true
		},
		{
			/*index=11*/
			header: '<div align="center">' + 'Email Miracle' + '</div>',
			dataIndex: 'karyawan_emiracle',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 40
          	}),
			hidden: true
		},
		{
			/*index=12*/
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'karyawan_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	}),
			hidden: true
		},
		{
			/*index=13*/
			header: '<div align="center">' + 'Telp Rumah' + '</div>',
			dataIndex: 'karyawan_notelp',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 25
          	})
		},
		{
			/*index=14*/
			header: '<div align="center">' + 'Ponsel 1' + '</div>',
			dataIndex: 'karyawan_notelp2',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 25
          	}),
			hidden: false
		},
		{
			/*index=15*/
			header: '<div align="center">' + 'Ponsel 2' + '</div>',
			dataIndex: 'karyawan_notelp3',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 25
          	}),
			hidden: true
		},
		{
			/*index=16*/
			header: '<div align="center">' + 'Ponsel 3' + '</div>',
			dataIndex: 'karyawan_notelp4',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 25
          	}),hidden: true
			
		},
		{
			/*index=17*/
			header: '<div align="center">' + 'Cabang' + '</div>',
			dataIndex: 'karyawan_cabang',
			width: 100,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_karyawan_cabang_DataStore,
				mode: 'remote',
               	displayField: 'karyawan_cabang_display',
               	valueField: 'karyawan_cabang_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            }),
			hidden: true
		},
		{
			/*index=18*/
			header: '<div align="center">' + 'Jabatan' + '</div>',
			dataIndex: 'karyawan_jabatan',
			width: 100,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_karyawan_jabatan_DataStore,
				mode: 'remote',
               	displayField: 'karyawan_jabatan_display',
               	valueField: 'karyawan_jabatan_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            }),
			hidden: true
		},
		{
			/*index=19*/
			header: '<div align="center">' + 'Departemen' + '</div>',
			dataIndex: 'karyawan_departemen',
			width: 80,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_karyawan_departemen_DataStore,
				mode: 'remote',
               	displayField: 'karyawan_departemen_display',
               	valueField: 'karyawan_departemen_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            }),
			hidden: false
		},
		{
			/*index=20*/
			header: '<div align="center">' + 'Gol' + '</div>',
			dataIndex: 'karyawan_golongan',
			width: 60,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_karyawan_golongan_DataStore,
				mode: 'remote',
               	displayField: 'karyawan_golongan_display',
               	valueField: 'karyawan_golongan_display',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            }),
			hidden: true
		},
		{
			/*index=21*/
			header: '<div align="center">' + 'Tgl Masuk' + '</div>',
			dataIndex: 'karyawan_tglmasuk',
			width: 70,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			}),
			hidden: true
		},
		{
			/*index=22*/
			header: '<div align="center">' + 'Atasan' + '</div>',
			dataIndex: 'karyawan_atasan',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store: cbo_karyawan_atasan_DataStore,
				mode: 'remote',
               	displayField: 'karyawan_atasan_display',
               	valueField: 'karyawan_atasan_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            }),
			hidden: true
		},
		{
			/*index=23*/
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'karyawan_aktif',
			width: 80,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['karyawan_aktif_value', 'karyawan_aktif_display'],
					data: [['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
					}),
				mode: 'local',
               	displayField: 'karyawan_aktif_display',
               	valueField: 'karyawan_aktif_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            }),
			hidden: false
		},
		{
			/*index=24*/
			header: 'Creator',
			dataIndex: 'karyawan_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		},
		{
			/*index=25*/
			header: 'Create on',
			dataIndex: 'karyawan_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true,
			readOnly: true
		},
		{
			/*index=26*/
			header: 'Last Update by',
			dataIndex: 'karyawan_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		},
		{
			/*index=27*/
			header: 'Last Update on',
			dataIndex: 'karyawan_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true,
			readOnly: true
		},
		{
			/*index=28*/
			header: 'Revised',
			dataIndex: 'karyawan_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}]
	);
	karyawan_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	karyawanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'karyawanListEditorGrid',
		el: 'fp_karyawan',
		title: 'Daftar Karyawan',
		autoHeight: true,
		store: karyawan_DataStore, // DataStore
		cm: karyawan_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: karyawan_DataStore,
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
			handler: karyawan_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled:true,
			handler: karyawan_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: karyawan_DataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						karyawan_DataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search by (aktif only):'});
				Ext.get(this.id).set({qtip:'- NIK<br>- Nama Lengkap<br>- Panggilan<br>- Departemen'});
				}
			},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: karyawan_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: karyawan_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: karyawan_print  
		}
		]
	});
	karyawanListEditorGrid.render();
	/* End of DataStore */
	
	/*karyawanListEditorGrid.getColumnModel().setHidden(3, true);
	karyawanListEditorGrid.getColumnModel().setHidden(9, true);
	karyawanListEditorGrid.getColumnModel().setHidden(14, true);
	karyawanListEditorGrid.getColumnModel().setHidden(15, true);
	karyawanListEditorGrid.getColumnModel().setHidden(24, true);
	karyawanListEditorGrid.getColumnModel().setHidden(25, true);
	karyawanListEditorGrid.getColumnModel().setHidden(26, true);
	karyawanListEditorGrid.getColumnModel().setHidden(27, true);
	karyawanListEditorGrid.getColumnModel().setHidden(26, true);*/
     
	/* Create Context Menu */
	karyawan_ContextMenu = new Ext.menu.Menu({
		id: 'karyawan_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: karyawan_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: karyawan_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: karyawan_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: karyawan_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onkaryawan_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		karyawan_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		karyawan_SelectedRow=rowIndex;
		karyawan_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function karyawan_editContextMenu(){
      karyawanListEditorGrid.startEditing(karyawan_SelectedRow,1);
  	}
	/* End of Function */
  	
	karyawanListEditorGrid.addListener('rowcontextmenu', onkaryawan_ListEditGridContextMenu);
	//karyawan_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	karyawanListEditorGrid.on('afteredit', karyawan_update); // inLine Editing Record
	
	//cbo_karyawan_golongan_DataStore.load();
	//cbo_karyawan_jabatan_DataStore.load();
	//cbo_karyawan_cabang_DataStore.load();
	//cbo_karyawan_departemen_DataStore.load();
	//cbo_karyawan_atasan_DataStore.load();
	
	/* Identify  karyawan_no Field */
	karyawan_noField= new Ext.form.TextField({
		id: 'karyawan_noField',
		fieldLabel: 'NIK <span style="color: #ec0000">*</span>',
		maxLength: 30,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  karyawan_npwp Field */
	karyawan_npwpField= new Ext.form.TextField({
		id: 'karyawan_npwpField',
		fieldLabel: 'NPWP',
		maxLength: 30,
		anchor: '95%'
	});
	/* Identify  karyawan_username Field */
	karyawan_usernameField= new Ext.form.TextField({
		id: 'karyawan_usernameField',
		fieldLabel: '&nbsp;&nbsp;&nbsp;Panggilan <span style="color: #ec0000">*</span>',
		maxLength: 15,
		allowBlank: false,
		width: 100
	});
	/* Identify  karyawan_nama Field */
	karyawan_namaField= new Ext.form.TextField({
		id: 'karyawan_namaField',
		fieldLabel: 'Nama Lengkap <span style="color: #ec0000">*</span>',
		maxLength: 50,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  karyawan_kelamin Field */
	karyawan_kelaminField= new Ext.form.ComboBox({
		id: 'karyawan_kelaminField',
		fieldLabel: 'Jenis Kelamin <span style="color: #ec0000">*</span>',
		store:new Ext.data.SimpleStore({
			fields:['karyawan_kelamin_value', 'karyawan_kelamin_display'],
			data:[['L','Laki-laki'],['P','Perempuan']]
		}),
		mode: 'local',
		editable:false,
		allowBlank: false,
		displayField: 'karyawan_kelamin_display',
		valueField: 'karyawan_kelamin_value',
		width: 80,
		triggerAction: 'all'	
	});
	/* Identify  karyawan_tgllahir Field */
	karyawan_tgllahirField= new Ext.form.DateField({
		id: 'karyawan_tgllahirField',
		fieldLabel: 'Tgl Lahir',
		format : 'Y-m-d',
	});
	/* Identify  karyawan_alamat Field */
	karyawan_alamatField= new Ext.form.TextField({
		id: 'karyawan_alamatField',
		fieldLabel: 'Alamat <span style="color: #ec0000">*</span>',
		maxLength: 250,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  karyawan_kota Field */
	karyawan_kotaField= new Ext.form.TextField({
		id: 'karyawan_kotaField ',
		fieldLabel: 'Kota',
		maxLength: 30,
		anchor: '95%'
	});
	/* Identify  karyawan_kodepos Field */
	karyawan_kodeposField= new Ext.form.TextField({
		id: 'karyawan_kodeposField',
		fieldLabel: 'Kode Pos',
		maxLength: 5,
		width: 60
	});
	/* Identify  karyawan_email Field */
	karyawan_emailField= new Ext.form.TextField({
		id: 'karyawan_emailField',
		fieldLabel: 'Email',
		maxLength: 40,
		anchor: '95%'
	});
	/* Identify  karyawan_emiracle Field */
	karyawan_emiracleField= new Ext.form.TextField({
		id: 'karyawan_emiracleField',
		fieldLabel: 'Email Miracle',
		maxLength: 40,
		anchor: '95%'
	});
	/* Identify  karyawan_keterangan Field */
	karyawan_keteranganField= new Ext.form.TextArea({
		id: 'karyawan_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  karyawan_notelp Field */
	karyawan_notelpField= new Ext.form.TextField({
		id: 'karyawan_notelpField',
		fieldLabel: 'No.Telp Rumah',
		maxLength: 25,
		anchor: '95%'
	});
	/* Identify  karyawan_notelp2 Field */
	karyawan_notelp2Field= new Ext.form.TextField({
		id: 'karyawan_notelp2Field',
		fieldLabel: 'Ponsel 1',
		maxLength: 25,
		anchor: '95%'
	});
	/* Identify  karyawan_notelp3 Field */
	karyawan_notelp3Field= new Ext.form.TextField({
		id: 'karyawan_notelp3Field',
		fieldLabel: 'Ponsel 2',
		maxLength: 25,
		anchor: '95%'
	});
	/* Identify  karyawan_notelp4 Field */
	karyawan_notelp4Field= new Ext.form.TextField({
		id: 'karyawan_notelp4Field',
		fieldLabel: 'Ponsel 3',
		maxLength: 25,
		anchor: '95%'
	});
	/* Identify  karyawan_cabang Field */
	karyawan_cabangField= new Ext.form.ComboBox({
		id: 'karyawan_cabangField ',
		fieldLabel: 'Cabang <span style="color: #ec0000">*</span>',
		store:cbo_karyawan_cabang_DataStore,
		mode: 'remote',
		editable:false,
		allowBlank: false,
		displayField: 'karyawan_cabang_display',
		valueField: 'karyawan_cabang_value',
		anchor: '95%',
		triggerAction: 'all'
	});
	/* Identify  karyawan_jabatan Field */
	karyawan_jabatanField= new Ext.form.ComboBox({
		id: 'karyawan_jabatanField',
		fieldLabel: 'Jabatan <span style="color: #ec0000">*</span>',
		store:cbo_karyawan_jabatan_DataStore,
		mode: 'remote',
		editable:false,
		allowBlank: false,
		displayField: 'karyawan_jabatan_display',
		valueField: 'karyawan_jabatan_value',
		anchor: '95%',
		triggerAction: 'all'
	});
	/* Identify  karyawan_departemen Field */
	karyawan_departemenField= new Ext.form.ComboBox({
		id: 'karyawan_departemenField',
		fieldLabel: 'Departemen <span style="color: #ec0000">*</span>',
		store:cbo_karyawan_departemen_DataStore,
		mode: 'remote',
		editable:false,
		allowBlank: false,
		displayField: 'karyawan_departemen_display',
		valueField: 'karyawan_departemen_value',
		anchor: '95%',
		triggerAction: 'all'
	});
	/* Identify  karyawan_golongan Field */
	karyawan_golonganField= new Ext.form.ComboBox({
		id: 'karyawan_golonganField',
		fieldLabel: 'Golongan',
		store:cbo_karyawan_golongan_DataStore,
		mode: 'remote',
		editable:false,
		allowBlank: true,
		displayField: 'karyawan_golongan_display',
		valueField: 'karyawan_golongan_display',
		anchor: '95%',
		triggerAction: 'all'
	});
	/* Identify  karyawan_golongantxt Field */
	karyawan_golongantxtField= new Ext.form.TextField({
		id: 'karyawan_golongantxtField',
		fieldLabel: '&nbsp;&nbsp;&nbsp;Tambah (optional)',
		maxLength: 50,
		allowBlank: true,
		emptyText: 'Golongan lainnya...',
		anchor: '95%'
	});
	/* Identify  karyawan_tglmasuk Field */
	karyawan_tglmasukField= new Ext.form.DateField({
		id: 'karyawan_tglmasukField',
		fieldLabel: 'Tanggal Masuk',
		format : 'Y-m-d',
	});
	/* Identify  karyawan_atasan Field */
	karyawan_atasanField= new Ext.form.ComboBox({
		id: 'karyawan_atasanField',
		fieldLabel: 'Atasan',
		store:cbo_karyawan_atasan_DataStore,
		mode: 'remote',
		editable:false,
		displayField: 'karyawan_atasan_display',
		valueField: 'karyawan_atasan_value',
		allowBlank: true,
		anchor: '95%',
		triggerAction: 'all'
	});
	/* Identify  karyawan_aktif Field */
	karyawan_aktifField= new Ext.form.ComboBox({
		id: 'karyawan_aktifField',
		fieldLabel: 'Status <span style="color: #ec0000">*</span>',
		store:new Ext.data.SimpleStore({
			fields:['karyawan_aktif_value', 'karyawan_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		editable:false,
		displayField: 'karyawan_aktif_display',
		valueField: 'karyawan_aktif_value',
		emptyText: 'Aktif',
		width: 80,
		triggerAction: 'all'	
	});
  	
	group_alamat = new Ext.form.FieldSet({
		title: 'Alamat',
		autoHeight: true,
		defaultType: 'textfield',
		anchor: '95%',
		items:[karyawan_alamatField ,karyawan_kotaField ,karyawan_kodeposField]
	});
	
	group_kontak = new Ext.form.FieldSet({
		title: 'Kontak',
		autoHeight: true,
		defaultType: 'textfield',
		anchor: '95%',
		items:[karyawan_notelpField ,karyawan_notelp2Field ,karyawan_notelp3Field,karyawan_notelp4Field ,karyawan_emailField]
	});
	
	group_pekerjaan = new Ext.form.FieldSet({
		title: 'Pekerjaan',
		autoHeight: true,
		defaultType: 'textfield',
		anchor: '95%',
		items:[karyawan_tglmasukField, karyawan_cabangField ,karyawan_jabatanField, karyawan_departemenField, karyawan_golonganField, karyawan_golongantxtField, karyawan_atasanField, karyawan_emiracleField]
	});
	
	/* Function for retrieve create Window Panel*/ 
	karyawan_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		labelWidth: 120,
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [karyawan_noField, karyawan_npwpField, karyawan_namaField, karyawan_usernameField, karyawan_tgllahirField, karyawan_kelaminField, group_alamat, group_kontak ] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [group_pekerjaan, karyawan_keteranganField, karyawan_aktifField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: karyawan_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					karyawan_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	karyawan_createWindow= new Ext.Window({
		id: 'karyawan_createWindow',
		title: post2db+'Karyawan',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_karyawan_create',
		items: karyawan_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function karyawan_list_search(){
		// render according to a SQL date format.
		var karyawan_id_search=null;
		var karyawan_no_search=null;
		var karyawan_npwp_search=null;
		var karyawan_username_search=null;
		var karyawan_nama_search=null;
		var karyawan_kelamin_search=null;
		var karyawan_tgllahir_search_date="";
		var karyawan_alamat_search=null;
		var karyawan_kota_search=null;
		var karyawan_kodepos_search=null;
		var karyawan_email_search=null;
		var karyawan_emiracle_search=null;
		var karyawan_keterangan_search=null;
		var karyawan_notelp_search=null;
		var karyawan_notelp2_search=null;
		var karyawan_notelp3_search=null;
		var karyawan_notelp4_search=null;
		var karyawan_cabang_search=null;
		var karyawan_jabatan_search=null;
		var karyawan_departemen_search=null;
		var karyawan_golongan_search=null;
		var karyawan_tglmasuk_search_date="";
		var karyawan_atasan_search=null;
		var karyawan_aktif_search=null;

		if(karyawan_idSearchField.getValue()!==null){karyawan_id_search=karyawan_idSearchField.getValue();}
		if(karyawan_noSearchField.getValue()!==null){karyawan_no_search=karyawan_noSearchField.getValue();}
		if(karyawan_npwpSearchField.getValue()!==null){karyawan_npwp_search=karyawan_npwpSearchField.getValue();}
		if(karyawan_usernameSearchField.getValue()!==null){karyawan_username_search=karyawan_usernameSearchField.getValue();}
		if(karyawan_namaSearchField.getValue()!==null){karyawan_nama_search=karyawan_namaSearchField.getValue();}
		if(karyawan_kelaminSearchField.getValue()!==null){karyawan_kelamin_search=karyawan_kelaminSearchField.getValue();}
		if(karyawan_tgllahirSearchField.getValue()!==""){karyawan_tgllahir_search_date=karyawan_tgllahirSearchField.getValue().format('Y-m-d');}
		if(karyawan_alamatSearchField.getValue()!==null){karyawan_alamat_search=karyawan_alamatSearchField.getValue();}
		if(karyawan_kotaSearchField.getValue()!==null){karyawan_kota_search=karyawan_kotaSearchField.getValue();}
		if(karyawan_kodeposSearchField.getValue()!==null){karyawan_kodepos_search=karyawan_kodeposSearchField.getValue();}
		if(karyawan_emailSearchField.getValue()!==null){karyawan_email_search=karyawan_emailSearchField.getValue();}
		if(karyawan_emiracleSearchField.getValue()!==null){karyawan_emiracle_search=karyawan_emiracleSearchField.getValue();}
		if(karyawan_keteranganSearchField.getValue()!==null){karyawan_keterangan_search=karyawan_keteranganSearchField.getValue();}
		if(karyawan_notelpSearchField.getValue()!==null){karyawan_notelp_search=karyawan_notelpSearchField.getValue();}
		if(karyawan_notelp2SearchField.getValue()!==null){karyawan_notelp2_search=karyawan_notelp2SearchField.getValue();}
		if(karyawan_notelp3SearchField.getValue()!==null){karyawan_notelp3_search=karyawan_notelp3SearchField.getValue();}
		if(karyawan_notelp4SearchField.getValue()!==null){karyawan_notelp4_search=karyawan_notelp4SearchField.getValue();}
		if(karyawan_cabangSearchField.getValue()!==null){karyawan_cabang_search=karyawan_cabangSearchField.getValue();}
		if(karyawan_jabatanSearchField.getValue()!==null){karyawan_jabatan_search=karyawan_jabatanSearchField.getValue();}
		if(karyawan_departemenSearchField.getValue()!==null){karyawan_departemen_search=karyawan_departemenSearchField.getValue();}
		if(karyawan_golonganSearchField.getValue()!==null){karyawan_golongan_search=karyawan_golonganSearchField.getValue();}
		if(karyawan_tglmasukSearchField.getValue()!==""){karyawan_tglmasuk_search_date=karyawan_tglmasukSearchField.getValue().format('Y-m-d');}
		if(karyawan_atasanSearchField.getValue()!==null){karyawan_atasan_search=karyawan_atasanSearchField.getValue();}
		if(karyawan_aktifSearchField.getValue()!==null){karyawan_aktif_search=karyawan_aktifSearchField.getValue();}
		// change the store parameters
		karyawan_DataStore.baseParams = {
			task: 'SEARCH',
			start: 0,
			limit: pageS,
			//variable here
			karyawan_id	:	karyawan_id_search, 
			karyawan_no	:	karyawan_no_search, 
			karyawan_npwp	:	karyawan_npwp_search, 
			karyawan_username	:	karyawan_username_search, 
			karyawan_nama	:	karyawan_nama_search, 
			karyawan_kelamin	:	karyawan_kelamin_search, 
			karyawan_tgllahir	:	karyawan_tgllahir_search_date, 
			karyawan_alamat	:	karyawan_alamat_search, 
			karyawan_kota	:	karyawan_kota_search, 
			karyawan_kodepos	:	karyawan_kodepos_search, 
			karyawan_email	:	karyawan_email_search, 
			karyawan_emiracle	:	karyawan_emiracle_search, 
			karyawan_keterangan	:	karyawan_keterangan_search, 
			karyawan_notelp	:	karyawan_notelp_search, 
			karyawan_notelp2	:	karyawan_notelp2_search, 
			karyawan_notelp3	:	karyawan_notelp3_search, 
			karyawan_notelp4	:	karyawan_notelp4_search, 
			karyawan_cabang	:	karyawan_cabang_search, 
			karyawan_jabatan	:	karyawan_jabatan_search, 
			karyawan_departemen	:	karyawan_departemen_search, 
			karyawan_golongan	:	karyawan_golongan_search, 
			karyawan_tglmasuk	:	karyawan_tglmasuk_search_date, 
			karyawan_atasan	:	karyawan_atasan_search, 
			karyawan_aktif	:	karyawan_aktif_search, 
		};
		// Cause the datastore to do another query : 
		karyawan_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function karyawan_reset_search(){
		// reset the store parameters
		karyawan_DataStore.baseParams = { task: 'LIST',start:0, limit: pageS };
		// Cause the datastore to do another query : 
		karyawan_DataStore.reload({params: {start: 0, limit: pageS}});
		cbo_karyawan_cabang_DataStore.reload();
		cbo_karyawan_departemen_DataStore.reload();
		cbo_karyawan_jabatan_DataStore.reload();
		cbo_karyawan_atasan_DataStore.reload();

		karyawan_searchWindow.close();
	};
	/* End of Fuction */
	
	function karyawan_reset_SearchForm(){
		karyawan_noSearchField.reset();
		karyawan_noSearchField.setValue(null);
		karyawan_npwpSearchField.reset();
		karyawan_npwpSearchField.setValue(null);
		karyawan_usernameSearchField.reset();
		karyawan_usernameSearchField.setValue(null);
		karyawan_namaSearchField.reset();
		karyawan_namaSearchField.setValue(null);
		karyawan_kelaminSearchField.reset();
		karyawan_kelaminSearchField.setValue(null);
		karyawan_tgllahirSearchField.reset();
		karyawan_tgllahirSearchField.setValue(null);
		karyawan_alamatSearchField.reset();
		karyawan_alamatSearchField.setValue(null);
		karyawan_kotaSearchField.reset();
		karyawan_kotaSearchField.setValue(null);
		karyawan_kodeposSearchField.reset();
		karyawan_kodeposSearchField.setValue(null);
		karyawan_emailSearchField.reset();
		karyawan_emailSearchField.setValue(null);
		karyawan_emiracleSearchField.reset();
		karyawan_emiracleSearchField.setValue(null);
		karyawan_keteranganSearchField.reset();
		karyawan_keteranganSearchField.setValue(null);
		karyawan_notelpSearchField.reset();
		karyawan_notelpSearchField.setValue(null);
		karyawan_notelp2SearchField.reset();
		karyawan_notelp2SearchField.setValue(null);
		karyawan_notelp3SearchField.reset();
		karyawan_notelp3SearchField.setValue(null);
		karyawan_notelp4SearchField.reset();
		karyawan_notelp4SearchField.setValue(null);
		karyawan_cabangSearchField.reset();
		karyawan_cabangSearchField.setValue(null);
		karyawan_jabatanSearchField.reset();
		karyawan_jabatanSearchField.setValue(null);
		karyawan_departemenSearchField.reset();
		karyawan_departemenSearchField.setValue(null);
		karyawan_golonganSearchField.reset();
		karyawan_golonganSearchField.setValue(null);
		karyawan_tglmasukSearchField.reset();
		karyawan_tglmasukSearchField.setValue(null);
		karyawan_atasanSearchField.reset();
		karyawan_atasanSearchField.setValue(null);
		karyawan_aktifSearchField.reset();
		karyawan_aktifSearchField.setValue(null);
	}
	
	/* Field for search */
	/* Identify  karyawan_id Search Field */
	karyawan_idSearchField= new Ext.form.NumberField({
		id: 'karyawan_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  karyawan_no Search Field */
	karyawan_noSearchField= new Ext.form.TextField({
		id: 'karyawan_noSearchField',
		fieldLabel: 'NIK',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  karyawan_npwp Search Field */
	karyawan_npwpSearchField= new Ext.form.TextField({
		id: 'karyawan_npwpSearchField',
		fieldLabel: 'NPWP',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  karyawan_username Search Field */
	karyawan_usernameSearchField= new Ext.form.TextField({
		id: 'karyawan_usernameSearchField',
		fieldLabel: '&nbsp;&nbsp;&nbsp;Panggilan',
		maxLength: 15,
		width: 100
	
	});
	/* Identify  karyawan_nama Search Field */
	karyawan_namaSearchField= new Ext.form.TextField({
		id: 'karyawan_namaSearchField',
		fieldLabel: 'Nama Lengkap',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  karyawan_kelamin Search Field */
	karyawan_kelaminSearchField= new Ext.form.ComboBox({
		id: 'karyawan_kelaminSearchField',
		fieldLabel: 'Jenis Kelamin',
		store:new Ext.data.SimpleStore({
			fields:['value', 'karyawan_kelamin'],
			data:[['L','Laki-laki'],['P','Perempuan']]
		}),
		mode: 'local',
		displayField: 'karyawan_kelamin',
		valueField: 'value',
		width: 80,
		triggerAction: 'all'	 
	
	});
	/* Identify  karyawan_tgllahir Search Field */
	karyawan_tgllahirSearchField= new Ext.form.DateField({
		id: 'karyawan_tgllahirSearchField',
		fieldLabel: 'Tgl Lahir',
		format : 'Y-m-d',
	
	});
	/* Identify  karyawan_alamat Search Field */
	karyawan_alamatSearchField= new Ext.form.TextField({
		id: 'karyawan_alamatSearchField',
		fieldLabel: 'Alamat',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  karyawan_kota Search Field */
	karyawan_kotaSearchField= new Ext.form.TextField({
		id: 'karyawan_kotaSearchField',
		fieldLabel: 'Kota',
		maxLength: 30,
		anchor: '95%'
	
	});
	/* Identify  karyawan_kodepos Search Field */
	karyawan_kodeposSearchField= new Ext.form.TextField({
		id: 'karyawan_kodeposSearchField',
		fieldLabel: 'Kode Pos',
		maxLength: 5,
		width: 60
	
	});
	/* Identify  karyawan_email Search Field */
	karyawan_emailSearchField= new Ext.form.TextField({
		id: 'karyawan_emailSearchField',
		fieldLabel: 'Email',
		maxLength: 40,
		anchor: '95%'
	
	});
	/* Identify  karyawan_emiracle Search Field */
	karyawan_emiracleSearchField= new Ext.form.TextField({
		id: 'karyawan_emiracleSearchField',
		fieldLabel: 'Email Miracle',
		maxLength: 40,
		anchor: '95%'
	
	});
	/* Identify  karyawan_keterangan Search Field */
	karyawan_keteranganSearchField= new Ext.form.TextArea({
		id: 'karyawan_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  karyawan_notelp Search Field */
	karyawan_notelpSearchField= new Ext.form.TextField({
		id: 'karyawan_notelpSearchField',
		fieldLabel: 'No. Telp Rumah',
		maxLength: 25,
		anchor: '95%'
	
	});
	/* Identify  karyawan_notelp2 Search Field */
	karyawan_notelp2SearchField= new Ext.form.TextField({
		id: 'karyawan_notelp2SearchField',
		fieldLabel: 'No. Ponsel 1',
		maxLength: 25,
		anchor: '95%'
	
	});
	/* Identify  karyawan_notelp3 Search Field */
	karyawan_notelp3SearchField= new Ext.form.TextField({
		id: 'karyawan_notelp3SearchField',
		fieldLabel: 'No. Ponsel 2',
		maxLength: 25,
		anchor: '95%'
	
	});
	
	karyawan_notelp4SearchField= new Ext.form.TextField({
		id: 'karyawan_notelp4SearchField',
		fieldLabel: 'No. Ponsel 3',
		maxLength: 25,
		anchor: '95%'
	
	});
	
	/* Identify  karyawan_cabang Search Field */
	karyawan_cabangSearchField= new Ext.form.ComboBox({
		id: 'karyawan_cabangSearchField',
		fieldLabel: 'Cabang',
		store:cbo_karyawan_cabang_DataStore,
		mode: 'remote',
		displayField: 'karyawan_cabang_display',
		valueField: 'karyawan_cabang_value',
		allowBlank: true,
		anchor: '95%',
		triggerAction: 'all'
	
	});
	/* Identify  karyawan_jabatan Search Field */
	karyawan_jabatanSearchField= new Ext.form.ComboBox({
		id: 'karyawan_jabatanSearchField',
		fieldLabel: 'Jabatan',
		store:cbo_karyawan_jabatan_DataStore,
		mode: 'remote',
		displayField: 'karyawan_jabatan_display',
		valueField: 'karyawan_jabatan_value',
		allowBlank: true,
		anchor: '95%',
		triggerAction: 'all'
	
	});
	/* Identify  karyawan_departemen Search Field */
	karyawan_departemenSearchField= new Ext.form.ComboBox({
		id: 'karyawan_departemenSearchField',
		fieldLabel: 'Departemen',
		store:cbo_karyawan_departemen_DataStore,
		mode: 'remote',
		displayField: 'karyawan_departemen_display',
		valueField: 'karyawan_departemen_value',
		allowBlank: true,
		anchor: '95%',
		triggerAction: 'all'
	
	});
	/* Identify  karyawan_golongan Search Field */
	karyawan_golonganSearchField= new Ext.form.ComboBox({
		id: 'karyawan_golonganSearchField',
		fieldLabel: 'Golongan',
		store:cbo_karyawan_golongan_DataStore,
		mode: 'remote',
		displayField: 'karyawan_golongan_display',
		valueField: 'karyawan_golongan_display',
		allowBlank: true,
		anchor: '95%',
		triggerAction: 'all'
	
	});
	/* Identify  karyawan_tglmasuk Search Field */
	karyawan_tglmasukSearchField= new Ext.form.DateField({
		id: 'karyawan_tglmasukSearchField',
		fieldLabel: 'Tanggal Masuk',
		format : 'Y-m-d',
	
	});
	/* Identify  karyawan_atasan Search Field */
	karyawan_atasanSearchField= new Ext.form.ComboBox({
		id: 'karyawan_atasanSearchField',
		fieldLabel: 'Atasan',
		store:cbo_karyawan_atasan_DataStore,
		mode: 'remote',
		displayField: 'karyawan_atasan_display',
		valueField: 'karyawan_atasan_value',
		allowBlank: true,
		anchor: '95%',
		triggerAction: 'all'
	
	});
	/* Identify  karyawan_aktif Search Field */
	karyawan_aktifSearchField= new Ext.form.ComboBox({
		id: 'karyawan_aktifSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'karyawan_aktif'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		displayField: 'karyawan_aktif',
		valueField: 'value',
		emptyText: 'Aktif',
		width: 80,
		triggerAction: 'all'	 
	
	});
	
	group_search_alamat = new Ext.form.FieldSet({
		title: 'Alamat',
		autoHeight: true,
		defaultType: 'textfield',
		anchor: '95%',
		items:[karyawan_alamatSearchField ,karyawan_kotaSearchField ,karyawan_kodeposSearchField]
	});
	
	group_search_kontak = new Ext.form.FieldSet({
		title: 'Kontak',
		autoHeight: true,
		defaultType: 'textfield',
		anchor: '95%',
		items:[karyawan_notelpSearchField ,karyawan_notelp2SearchField ,karyawan_notelp3SearchField,karyawan_notelp4SearchField ,karyawan_emailSearchField]
	});
	
	group_search_pekerjaan = new Ext.form.FieldSet({
		title: 'Pekerjaan',
		autoHeight: true,
		defaultType: 'textfield',
		anchor: '95%',
		items:[karyawan_tglmasukSearchField, karyawan_cabangSearchField, karyawan_jabatanSearchField, karyawan_departemenSearchField, karyawan_golonganSearchField, karyawan_atasanSearchField, karyawan_emiracleSearchField]
	});
    
	/* Function for retrieve search Form Panel */
	karyawan_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [karyawan_noSearchField, karyawan_npwpSearchField, karyawan_namaSearchField, karyawan_usernameSearchField, karyawan_tgllahirSearchField, karyawan_kelaminSearchField, group_search_alamat, group_search_kontak ] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [group_search_pekerjaan, karyawan_keteranganSearchField, karyawan_aktifSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: karyawan_list_search
			},{
				text: 'Close',
				handler: function(){
					karyawan_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	karyawan_searchWindow = new Ext.Window({
		title: 'karyawan Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_karyawan_search',
		items: karyawan_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!karyawan_searchWindow.isVisible()){
			karyawan_reset_SearchForm();
			karyawan_searchWindow.show();
		} else {
			karyawan_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function karyawan_print(){
		var searchquery = "";
		var karyawan_no_print=null;
		var karyawan_npwp_print=null;
		var karyawan_username_print=null;
		var karyawan_nama_print=null;
		var karyawan_kelamin_print=null;
		var karyawan_tgllahir_print_date="";
		var karyawan_alamat_print=null;
		var karyawan_kota_print=null;
		var karyawan_kodepos_print=null;
		var karyawan_email_print=null;
		var karyawan_emiracle_print=null;
		var karyawan_keterangan_print=null;
		var karyawan_notelp_print=null;
		var karyawan_notelp2_print=null;
		var karyawan_notelp3_print=null;
		var karyawan_cabang_print=null;
		var karyawan_jabatan_print=null;
		var karyawan_departemen_print=null;
		var karyawan_golongan_print=null;
		var karyawan_tglmasuk_print_date="";
		var karyawan_atasan_print=null;
		var karyawan_aktif_print=null;
		var win;              
		// check if we do have some search data...
		if(karyawan_DataStore.baseParams.query!==null){searchquery = karyawan_DataStore.baseParams.query;}
		if(karyawan_DataStore.baseParams.karyawan_no!==null){karyawan_no_print = karyawan_DataStore.baseParams.karyawan_no;}
		if(karyawan_DataStore.baseParams.karyawan_npwp!==null){karyawan_npwp_print = karyawan_DataStore.baseParams.karyawan_npwp;}
		if(karyawan_DataStore.baseParams.karyawan_username!==null){karyawan_username_print = karyawan_DataStore.baseParams.karyawan_username;}
		if(karyawan_DataStore.baseParams.karyawan_nama!==null){karyawan_nama_print = karyawan_DataStore.baseParams.karyawan_nama;}
		if(karyawan_DataStore.baseParams.karyawan_kelamin!==null){karyawan_kelamin_print = karyawan_DataStore.baseParams.karyawan_kelamin;}
		if(karyawan_DataStore.baseParams.karyawan_tgllahir!==""){karyawan_tgllahir_print_date = karyawan_DataStore.baseParams.karyawan_tgllahir;}
		if(karyawan_DataStore.baseParams.karyawan_alamat!==null){karyawan_alamat_print = karyawan_DataStore.baseParams.karyawan_alamat;}
		if(karyawan_DataStore.baseParams.karyawan_kota!==null){karyawan_kota_print = karyawan_DataStore.baseParams.karyawan_kota;}
		if(karyawan_DataStore.baseParams.karyawan_kodepos!==null){karyawan_kodepos_print = karyawan_DataStore.baseParams.karyawan_kodepos;}
		if(karyawan_DataStore.baseParams.karyawan_email!==null){karyawan_email_print = karyawan_DataStore.baseParams.karyawan_email;}
		if(karyawan_DataStore.baseParams.karyawan_emiracle!==null){karyawan_emiracle_print = karyawan_DataStore.baseParams.karyawan_emiracle;}
		if(karyawan_DataStore.baseParams.karyawan_keterangan!==null){karyawan_keterangan_print = karyawan_DataStore.baseParams.karyawan_keterangan;}
		if(karyawan_DataStore.baseParams.karyawan_notelp!==null){karyawan_notelp_print = karyawan_DataStore.baseParams.karyawan_notelp;}
		if(karyawan_DataStore.baseParams.karyawan_notelp2!==null){karyawan_notelp2_print = karyawan_DataStore.baseParams.karyawan_notelp2;}
		if(karyawan_DataStore.baseParams.karyawan_notelp3!==null){karyawan_notelp3_print = karyawan_DataStore.baseParams.karyawan_notelp3;}
		if(karyawan_DataStore.baseParams.karyawan_cabang!==null){karyawan_cabang_print = karyawan_DataStore.baseParams.karyawan_cabang;}
		if(karyawan_DataStore.baseParams.karyawan_jabatan!==null){karyawan_jabatan_print = karyawan_DataStore.baseParams.karyawan_jabatan;}
		if(karyawan_DataStore.baseParams.karyawan_departemen!==null){karyawan_departemen_print = karyawan_DataStore.baseParams.karyawan_departemen;}
		if(karyawan_DataStore.baseParams.karyawan_golongan!==null){karyawan_golongan_print = karyawan_DataStore.baseParams.karyawan_golongan;}
		if(karyawan_DataStore.baseParams.karyawan_tglmasuk!==""){karyawan_tglmasuk_print_date = karyawan_DataStore.baseParams.karyawan_tglmasuk;}
		if(karyawan_DataStore.baseParams.karyawan_atasan!==null){karyawan_atasan_print = karyawan_DataStore.baseParams.karyawan_atasan;}
		if(karyawan_DataStore.baseParams.karyawan_aktif!==null){karyawan_aktif_print = karyawan_DataStore.baseParams.karyawan_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_karyawan&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			karyawan_no : karyawan_no_print,
			karyawan_npwp : karyawan_npwp_print,
			karyawan_username : karyawan_username_print,
			karyawan_nama : karyawan_nama_print,
			karyawan_kelamin : karyawan_kelamin_print,
		  	karyawan_tgllahir : karyawan_tgllahir_print_date, 
			karyawan_alamat : karyawan_alamat_print,
			karyawan_kota : karyawan_kota_print,
			karyawan_kodepos : karyawan_kodepos_print,
			karyawan_email : karyawan_email_print,
			karyawan_emiracle : karyawan_emiracle_print,
			karyawan_keterangan : karyawan_keterangan_print,
			karyawan_notelp : karyawan_notelp_print,
			karyawan_notelp2 : karyawan_notelp2_print,
			karyawan_notelp3 : karyawan_notelp3_print,
			karyawan_cabang : karyawan_cabang_print,
			karyawan_jabatan : karyawan_jabatan_print,
			karyawan_departemen : karyawan_departemen_print,
			karyawan_golongan : karyawan_golongan_print,
		  	karyawan_tglmasuk : karyawan_tglmasuk_print_date, 
			karyawan_atasan : karyawan_atasan_print,
			karyawan_aktif : karyawan_aktif_print,
		  	currentlisting: karyawan_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./karyawanlist.html','karyawanlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function karyawan_export_excel(){
		var searchquery = "";
		var karyawan_no_2excel=null;
		var karyawan_npwp_2excel=null;
		var karyawan_username_2excel=null;
		var karyawan_nama_2excel=null;
		var karyawan_kelamin_2excel=null;
		var karyawan_tgllahir_2excel_date="";
		var karyawan_alamat_2excel=null;
		var karyawan_kota_2excel=null;
		var karyawan_kodepos_2excel=null;
		var karyawan_email_2excel=null;
		var karyawan_emiracle_2excel=null;
		var karyawan_keterangan_2excel=null;
		var karyawan_notelp_2excel=null;
		var karyawan_notelp2_2excel=null;
		var karyawan_notelp3_2excel=null;
		var karyawan_cabang_2excel=null;
		var karyawan_jabatan_2excel=null;
		var karyawan_departemen_2excel=null;
		var karyawan_golongan_2excel=null;
		var karyawan_tglmasuk_2excel_date="";
		var karyawan_atasan_2excel=null;
		var karyawan_aktif_2excel=null;
		var win;              
		// check if we do have some search data...
		if(karyawan_DataStore.baseParams.query!==null){searchquery = karyawan_DataStore.baseParams.query;}
		if(karyawan_DataStore.baseParams.karyawan_no!==null){karyawan_no_2excel = karyawan_DataStore.baseParams.karyawan_no;}
		if(karyawan_DataStore.baseParams.karyawan_npwp!==null){karyawan_npwp_2excel = karyawan_DataStore.baseParams.karyawan_npwp;}
		if(karyawan_DataStore.baseParams.karyawan_username!==null){karyawan_username_2excel = karyawan_DataStore.baseParams.karyawan_username;}
		if(karyawan_DataStore.baseParams.karyawan_nama!==null){karyawan_nama_2excel = karyawan_DataStore.baseParams.karyawan_nama;}
		if(karyawan_DataStore.baseParams.karyawan_kelamin!==null){karyawan_kelamin_2excel = karyawan_DataStore.baseParams.karyawan_kelamin;}
		if(karyawan_DataStore.baseParams.karyawan_tgllahir!==""){karyawan_tgllahir_2excel_date = karyawan_DataStore.baseParams.karyawan_tgllahir;}
		if(karyawan_DataStore.baseParams.karyawan_alamat!==null){karyawan_alamat_2excel = karyawan_DataStore.baseParams.karyawan_alamat;}
		if(karyawan_DataStore.baseParams.karyawan_kota!==null){karyawan_kota_2excel = karyawan_DataStore.baseParams.karyawan_kota;}
		if(karyawan_DataStore.baseParams.karyawan_kodepos!==null){karyawan_kodepos_2excel = karyawan_DataStore.baseParams.karyawan_kodepos;}
		if(karyawan_DataStore.baseParams.karyawan_email!==null){karyawan_email_2excel = karyawan_DataStore.baseParams.karyawan_email;}
		if(karyawan_DataStore.baseParams.karyawan_emiracle!==null){karyawan_emiracle_2excel = karyawan_DataStore.baseParams.karyawan_emiracle;}
		if(karyawan_DataStore.baseParams.karyawan_keterangan!==null){karyawan_keterangan_2excel = karyawan_DataStore.baseParams.karyawan_keterangan;}
		if(karyawan_DataStore.baseParams.karyawan_notelp!==null){karyawan_notelp_2excel = karyawan_DataStore.baseParams.karyawan_notelp;}
		if(karyawan_DataStore.baseParams.karyawan_notelp2!==null){karyawan_notelp2_2excel = karyawan_DataStore.baseParams.karyawan_notelp2;}
		if(karyawan_DataStore.baseParams.karyawan_notelp3!==null){karyawan_notelp3_2excel = karyawan_DataStore.baseParams.karyawan_notelp3;}
		if(karyawan_DataStore.baseParams.karyawan_cabang!==null){karyawan_cabang_2excel = karyawan_DataStore.baseParams.karyawan_cabang;}
		if(karyawan_DataStore.baseParams.karyawan_jabatan!==null){karyawan_jabatan_2excel = karyawan_DataStore.baseParams.karyawan_jabatan;}
		if(karyawan_DataStore.baseParams.karyawan_departemen!==null){karyawan_departemen_2excel = karyawan_DataStore.baseParams.karyawan_departemen;}
		if(karyawan_DataStore.baseParams.karyawan_golongan!==null){karyawan_golongan_2excel = karyawan_DataStore.baseParams.karyawan_golongan;}
		if(karyawan_DataStore.baseParams.karyawan_tglmasuk!==""){karyawan_tglmasuk_2excel_date = karyawan_DataStore.baseParams.karyawan_tglmasuk;}
		if(karyawan_DataStore.baseParams.karyawan_atasan!==null){karyawan_atasan_2excel = karyawan_DataStore.baseParams.karyawan_atasan;}
		if(karyawan_DataStore.baseParams.karyawan_aktif!==null){karyawan_aktif_2excel = karyawan_DataStore.baseParams.karyawan_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_karyawan&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			karyawan_no : karyawan_no_2excel,
			karyawan_npwp : karyawan_npwp_2excel,
			karyawan_username : karyawan_username_2excel,
			karyawan_nama : karyawan_nama_2excel,
			karyawan_kelamin : karyawan_kelamin_2excel,
		  	karyawan_tgllahir : karyawan_tgllahir_2excel_date, 
			karyawan_alamat : karyawan_alamat_2excel,
			karyawan_kota : karyawan_kota_2excel,
			karyawan_kodepos : karyawan_kodepos_2excel,
			karyawan_email : karyawan_email_2excel,
			karyawan_emiracle : karyawan_emiracle_2excel,
			karyawan_keterangan : karyawan_keterangan_2excel,
			karyawan_notelp : karyawan_notelp_2excel,
			karyawan_notelp2 : karyawan_notelp2_2excel,
			karyawan_notelp3 : karyawan_notelp3_2excel,
			karyawan_cabang : karyawan_cabang_2excel,
			karyawan_jabatan : karyawan_jabatan_2excel,
			karyawan_departemen : karyawan_departemen_2excel,
			karyawan_golongan : karyawan_golongan_2excel,
		  	karyawan_tglmasuk : karyawan_tglmasuk_2excel_date, 
			karyawan_atasan : karyawan_atasan_2excel,
			karyawan_aktif : karyawan_aktif_2excel,
		  	currentlisting: karyawan_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_karyawan"></div>
		<div id="elwindow_karyawan_create"></div>
        <div id="elwindow_karyawan_search"></div>
    </div>
</div>
</body>