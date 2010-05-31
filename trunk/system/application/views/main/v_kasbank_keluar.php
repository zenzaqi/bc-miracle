<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: kasbank View
	+ Description	: For record view
	+ Filename 		: v_kasbank.php
 	+ Author  		: Zainal, Anam
 	+ Created on 12/Mar/2010 10:45:40
	
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
var kasbank_keluar_DataStore;
var kasbank_keluar_ColumnModel;
var kasbankKeluarListEditorGrid;
var kasbank_keluar_saveForm;
var kasbank_keluar_saveWindow;
var kasbank_keluar_searchForm;
var kasbank_keluar_searchWindow;
var kasbank_keluar_SelectedRow;
var kasbank_keluar_ContextMenu;
//for detail data
var kasbank_keluar_detail_DataStore;
var kasbank_keluar_detailListEditorGrid;
var kasbank_keluar_detail_ColumnModel;
var kasbank_keluar_detail_proxy;
var kasbank_keluar_detail_writer;
var kasbank_keluar_detail_reader;
var editor_kasbank_keluar_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var kasbank_keluar_idField;
var kasbank_keluar_tanggalField;
var kasbank_keluar_nobuktiField;
var kasbank_keluar_akunField;
var kasbank_keluar_terimauntukField;
var kasbank_keluar_jenisField;
var kasbank_keluar_norefField;
var kasbank_keluar_keteranganField;
var kasbank_keluar_authorField;
var kasbank_keluar_postField;
var kasbank_keluar_date_postField;
var kasbank_keluar_idSearchField;
var kasbank_keluar_tanggalSearchField;
var kasbank_keluar_nobuktiSearchField;
var kasbank_keluar_akunSearchField;
var kasbank_keluar_terimauntukSearchField;
var kasbank_keluar_jenisSearchField;
var kasbank_keluar_norefSearchField;
var kasbank_keluar_keteranganSearchField;
var kasbank_keluar_authorSearchField;
var kasbank_keluar_postSearchField;
var kasbank_keluar_date_postSearchField;
var total_debet;
var total_keluar_kredit;
var jenis_kasbank = "keluar";
/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  /* Function for Saving inLine Editing */
	function kasbank_keluar_inline_update(oGrid_event){
		var kasbank_keluar_id_update_pk="";
		var kasbank_keluar_tanggal_update_date="";
		var kasbank_keluar_nobukti_update=null;
		var kasbank_keluar_akun_update=null;
		var kasbank_keluar_terimauntuk_update=null;
		var kasbank_keluar_jenis_update=null;
		var kasbank_keluar_noref_update=null;
		var kasbank_keluar_keterangan_update=null;
		var kasbank_keluar_post_update=null;
		var kasbank_keluar_date_post_update_date="";

		kasbank_keluar_id_update_pk = oGrid_event.record.data.kasbank_keluar_id;
	 	if(oGrid_event.record.data.kasbank_keluar_tanggal!== ""){kasbank_keluar_tanggal_update_date =oGrid_event.record.data.kasbank_keluar_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.kasbank_keluar_nobukti!== null){kasbank_keluar_nobukti_update = oGrid_event.record.data.kasbank_keluar_nobukti;}
		if(oGrid_event.record.data.kasbank_keluar_akun!== null){kasbank_keluar_akun_update = oGrid_event.record.data.kasbank_keluar_akun;}
		if(oGrid_event.record.data.kasbank_keluar_terimauntuk!== null){kasbank_keluar_terimauntuk_update = oGrid_event.record.data.kasbank_keluar_terimauntuk;}
		if(oGrid_event.record.data.kasbank_keluar_jenis!== null){kasbank_keluar_jenis_update = oGrid_event.record.data.kasbank_keluar_jenis;}
		if(oGrid_event.record.data.kasbank_keluar_noref!== null){kasbank_keluar_noref_update = oGrid_event.record.data.kasbank_keluar_noref;}
		if(oGrid_event.record.data.kasbank_keluar_keterangan!== null){kasbank_keluar_keterangan_update = oGrid_event.record.data.kasbank_keluar_keterangan;}
		if(oGrid_event.record.data.kasbank_keluar_post!== null){kasbank_keluar_post_update = oGrid_event.record.data.kasbank_keluar_post;}
	 	if(oGrid_event.record.data.kasbank_keluar_date_post!== ""){kasbank_keluar_date_post_update_date =oGrid_event.record.data.kasbank_keluar_date_post.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_kasbank_keluar&m=get_action',
			params: {
				kasbank_keluar_id	: kasbank_keluar_id_update_pk, 
				kasbank_keluar_tanggal	: kasbank_keluar_tanggal_update_date, 
				kasbank_keluar_nobukti	:kasbank_keluar_nobukti_update,
				kasbank_keluar_akun	:kasbank_keluar_akun_update,
				kasbank_keluar_terimauntuk	:kasbank_keluar_terimauntuk_update,
				//kasbank_keluar_jenis	:kasbank_keluar_jenis_update,
				kasbank_keluar_jenis	: jenis_kasbank,
				kasbank_keluar_noref	:kasbank_keluar_noref_update,
				kasbank_keluar_keterangan	:kasbank_keluar_keterangan_update,
				kasbank_keluar_post	:kasbank_keluar_post_update,
				kasbank_keluar_date_post	: kasbank_keluar_date_post_update_date, 
				task: "UPDATE"
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				if(result!==0){
						kasbank_keluar_detail_purge(result);
						Ext.MessageBox.alert(post2db+' OK','The Kasbank was '+post2db+' successfully.');
						kasbank_keluar_DataStore.reload();
						kasbank_keluar_saveWindow.hide();
				}else{
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Tbl T Kasbank.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
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
  
  	/* Function for add and edit data form, open window form */
	function kasbank_keluar_save(){
	
		if(is_kasbank_keluar_form_valid()){	
			var kasbank_keluar_id_field_pk=null; 
			var kasbank_keluar_tanggal_field_date=""; 
			var kasbank_keluar_nobukti_field=null; 
			var kasbank_keluar_akun_field=null; 
			var kasbank_keluar_terimauntuk_field=null; 
			var kasbank_keluar_jenis_field=null; 
			var kasbank_keluar_noref_field=null; 
			var kasbank_keluar_keterangan_field=null; 
			var kasbank_keluar_post_field=null; 
			var kasbank_keluar_date_post_field_date=""; 

			kasbank_keluar_id_field_pk=get_pk_id();
			if(kasbank_keluar_tanggalField.getValue()!== ""){kasbank_keluar_tanggal_field_date = kasbank_keluar_tanggalField.getValue().format('Y-m-d');} 
			if(kasbank_keluar_nobuktiField.getValue()!== null){kasbank_keluar_nobukti_field = kasbank_keluar_nobuktiField.getValue();} 
			if(kasbank_keluar_akunField.getValue()!== null){kasbank_keluar_akun_field = kasbank_keluar_akunField.getValue();} 
			if(kasbank_keluar_terimauntukField.getValue()!== null){kasbank_keluar_terimauntuk_field = kasbank_keluar_terimauntukField.getValue();} 
			if(kasbank_keluar_jenisField.getValue()!== null){kasbank_keluar_jenis_field = 'keluar';} 
			if(kasbank_keluar_norefField.getValue()!== null){kasbank_keluar_noref_field = kasbank_keluar_norefField.getValue();} 
			if(kasbank_keluar_keteranganField.getValue()!== null){kasbank_keluar_keterangan_field = kasbank_keluar_keteranganField.getValue();} 
			//if(kasbank_keluar_postField.getValue()!== null){kasbank_keluar_post_field = kasbank_keluar_postField.getValue();} 
			//if(kasbank_keluar_date_postField.getValue()!== ""){kasbank_keluar_date_post_field_date = kasbank_keluar_date_postField.getValue().format('Y-m-d');} 

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_kasbank_keluar&m=get_action',
				params: {
					kasbank_keluar_id			: kasbank_keluar_id_field_pk, 
					kasbank_keluar_tanggal		: kasbank_keluar_tanggal_field_date, 
					kasbank_keluar_nobukti		: kasbank_keluar_nobukti_field, 
					kasbank_keluar_akun		: kasbank_keluar_akun_field, 
					kasbank_keluar_terimauntuk	: kasbank_keluar_terimauntuk_field, 
					kasbank_keluar_jenis		: kasbank_keluar_jenis_field, 
					kasbank_keluar_noref		: kasbank_keluar_noref_field, 
					kasbank_keluar_keterangan	: kasbank_keluar_keterangan_field, 
					kasbank_keluar_post		: kasbank_keluar_post_field, 
					kasbank_keluar_date_post	: kasbank_keluar_date_post_field_date, 
					task				: post2db
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					if(result!==0){
							kasbank_keluar_detail_purge(result);
							Ext.MessageBox.alert(post2db+' OK','The Tbl T Kasbank was '+post2db+' successfully.');
							kasbank_keluar_DataStore.reload();
							kasbank_keluar_saveWindow.hide();
					}else{
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Tbl T Kasbank.',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
							});
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
			return kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function kasbank_keluar_reset_form(){
		kasbank_keluar_tanggalField.reset();
		kasbank_keluar_tanggalField.setValue(null);
		kasbank_keluar_nobuktiField.reset();
		kasbank_keluar_nobuktiField.setValue(null);
		kasbank_keluar_akunField.reset();
		kasbank_keluar_akunField.setValue(null);
		kasbank_keluar_terimauntukField.reset();
		kasbank_keluar_terimauntukField.setValue(null);
		//kasbank_keluar_jenisField.reset();
		//kasbank_keluar_jenisField.setValue(null);
		kasbank_keluar_norefField.reset();
		kasbank_keluar_norefField.setValue(null);
		kasbank_keluar_keteranganField.reset();
		kasbank_keluar_keteranganField.setValue(null);
		//kasbank_keluar_postField.reset();
		//kasbank_keluar_postField.setValue(null);
		//kasbank_keluar_date_postField.reset();
		//kasbank_keluar_date_postField.setValue(null);
		jumlah_total_debet=null;
		
		jumlah_total_keluar_kredit=null;
		
		kasbank_keluar_detail_DataStore.setBaseParam('master_id',null);
		kasbank_keluar_detail_DataStore.load();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function kasbank_keluar_set_form(){
		
		kasbank_keluar_tanggalField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_tanggal'));
		kasbank_keluar_nobuktiField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_nobukti'));
		kasbank_keluar_akunField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_akun'));
		kasbank_keluar_terimauntukField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_terimauntuk'));
		kasbank_keluar_jenisField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_jenis'));
		kasbank_keluar_norefField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_noref'));
		kasbank_keluar_keteranganField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_keterangan'));
		//kasbank_keluar_postField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_post'));
		//kasbank_keluar_date_postField.setValue(kasbankKeluarListEditorGrid.getSelectionModel().getSelected().get('kasbank_keluar_date_post'));
		kasbank_keluar_detail_DataStore.setBaseParam('master_id',get_pk_id());
		kasbank_keluar_detail_DataStore.load();
		
		
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_kasbank_keluar_form_valid(){
		return (true);
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!kasbank_keluar_saveWindow.isVisible()){
			kasbank_keluar_reset_form();
			post2db='CREATE';
			msg='created';
			kasbank_keluar_saveWindow.show();
		} else {
			kasbank_keluar_saveWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function kasbank_keluar_confirm_delete(){
		// only one kasbank is selected here
		if(kasbankKeluarListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', kasbank_keluar_delete);
		} else if(kasbankKeluarListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', kasbank_keluar_delete);
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
	function kasbank_keluar_confirm_update(){
		/* only one record is selected here */
		if(kasbankKeluarListEditorGrid.selModel.getCount() == 1) {
			
			post2db='UPDATE';
			kasbank_keluar_set_form();
			msg='updated';
			
			kasbank_keluar_saveWindow.show();
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
	function kasbank_keluar_delete(btn){
		if(btn=='yes'){
			var selections = kasbankKeluarListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< kasbankKeluarListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.kasbank_keluar_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_kasbank_keluar&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							kasbank_keluar_DataStore.reload();
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
	kasbank_keluar_DataStore = new Ext.data.Store({
		id: 'kasbank_keluar_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_kasbank_keluar&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kasbank_keluar_id'
		},[
		/* dataIndex => insert intokasbank_keluar_ColumnModel, Mapping => for initiate table column */ 
			{name: 'kasbank_keluar_id', type: 'int', mapping: 'kasbank_id'}, 
			{name: 'kasbank_keluar_tanggal', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kasbank_tanggal'}, 
			{name: 'kasbank_keluar_nobukti', type: 'string', mapping: 'kasbank_nobukti'}, 
			{name: 'kasbank_keluar_akun', type: 'string', mapping: 'akun_nama'}, 
			{name: 'kasbank_keluar_kode', type: 'string', mapping: 'akun_kode'}, 
			{name: 'kasbank_keluar_terimauntuk', type: 'string', mapping: 'kasbank_terimauntuk'}, 
			{name: 'kasbank_keluar_jenis', type: 'string', mapping: 'kasbank_jenis'}, 
			{name: 'kasbank_keluar_noref', type: 'string', mapping: 'kasbank_noref'}, 
			{name: 'kasbank_keluar_keterangan', type: 'string', mapping: 'kasbank_keterangan'}, 
			{name: 'kasbank_keluar_author', type: 'string', mapping: 'kasbank_author'}, 
			{name: 'kasbank_keluar_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kasbank_date_create'}, 
			{name: 'kasbank_keluar_update', type: 'string', mapping: 'kasbank_update'}, 
			{name: 'kasbank_keluar_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kasbank_date_update'}, 
			{name: 'kasbank_keluar_post', type: 'string', mapping: 'kasbank_keluar_post'}, 
			{name: 'kasbank_keluar_date_post', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kasbank_date_post'}, 
			{name: 'kasbank_keluar_revised', type: 'int', mapping: 'kasbank_mrevised'} 
		]),
		sortInfo:{field: 'kasbank_keluar_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for Retrieve DataStore */
	tbl_m_akun_DataStore = new Ext.data.Store({
		id: 'tbl_m_akun_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_tbl_m_akun&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intotbl_m_akun_ColumnModel, Mapping => for initiate table column */ 
			{name: 'akun_id', type: 'int', mapping: 'akun_id'}, 
			{name: 'akun_kode', type: 'string', mapping: 'akun_kode'}, 
			{name: 'akun_jenis', type: 'string', mapping: 'akun_jenis'}, 
			{name: 'akun_parent', type: 'int', mapping: 'akun_parent'}, 
			{name: 'akun_level', type: 'int', mapping: 'akun_level'}, 
			{name: 'akun_nama', type: 'string', mapping: 'akun_nama'}, 
			{name: 'akun_debet', type: 'float', mapping: 'akun_debet'}, 
			{name: 'akun_kredit', type: 'float', mapping: 'akun_kredit'}, 
			{name: 'akun_saldo', type: 'float', mapping: 'akun_saldo'}, 
			{name: 'akun_aktif', type: 'string', mapping: 'akun_aktif'}, 
			{name: 'akun_creator', type: 'string', mapping: 'akun_creator'}, 
			{name: 'akun_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'akun_date_create'}, 
			{name: 'akun_update', type: 'string', mapping: 'akun_update'}, 
			{name: 'akun_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'akun_date_update'}, 
			{name: 'akun_revised', type: 'int', mapping: 'akun_revised'} 
		]),
		sortInfo:{field: 'akun_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	kasbank_keluar_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'kasbank_keluar_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Tanggal',
			dataIndex: 'kasbank_keluar_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			}),
			readOnly: true
		}, 
		{
			header: 'No Bukti',
			dataIndex: 'kasbank_keluar_nobukti',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		// {
			// header: 'Akun',
			// dataIndex: 'kasbank_keluar_akun',
			// width: 150,
			// sortable: true,
			// readOnly: true
		// }, 
		{
			header: 'Nama Akun',
			dataIndex: 'kasbank_keluar_akun',
			width: 250,
			sortable: true,
			readOnly: true,
			editor: new Ext.form.ComboBox({
					id: 'cb_kasbank_keluar_akun',
					store: tbl_m_akun_DataStore,
					mode: 'remote',
					displayField: 'akun_nama',
					valueField: 'akun_id',
					loadingText: 'Searching...',
					typeAhead: true,
					pageSize: pageS,
					triggerAction: 'all',
					lazyRender:true,
					listClass: 'x-combo-list-small',
					anchor: '80%',
					hideTrigger: false
		    	})
		}, 	
		{	header: 'Kode Akun',
			dataIndex: 'kasbank_keluar_kode',
			width: 100,
			readOnly: true
		},
		
		{
			header: 'Untuk',
			dataIndex: 'kasbank_keluar_terimauntuk',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250			})
		}, 
		// {
			// header: 'Jenis',
			// dataIndex: 'kasbank_keluar_jenis',
			// width: 150,
			// sortable: true,
			// readOnly: true,
		// }, 
		{
			header: 'No. Ref',
			dataIndex: 'kasbank_keluar_noref',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'kasbank_keluar_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
			}),
			hidden: true,
		}, 
		{
			header: 'Author',
			dataIndex: 'kasbank_keluar_author',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Create on',
			dataIndex: 'kasbank_keluar_date_create',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'kasbank_keluar_update',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'kasbank_keluar_date_update',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Posted',
			dataIndex: 'kasbank_keluar_post',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Posted on',
			dataIndex: 'kasbank_keluar_date_post',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Revised',
			dataIndex: 'kasbank_keluar_revised',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}	]);
	
	kasbank_keluar_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	kasbankKeluarListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'kasbankKeluarListEditorGrid',
		el: 'fp_kasbank_keluar',
		title: 'Kas/Bank Keluar',
		autoHeight: true,
		store: kasbank_keluar_DataStore, // DataStore
		cm: kasbank_keluar_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: kasbank_keluar_DataStore,
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
			handler: kasbank_keluar_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: kasbank_keluar_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: kasbank_keluar_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: kasbank_keluar_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: kasbank_keluar_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: kasbank_keluar_print  
		}
		]
	});
	kasbankKeluarListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	kasbank_keluar_ContextMenu = new Ext.menu.Menu({
		id: 'kasbank_keluar_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: kasbank_keluar_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: kasbank_keluar_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: kasbank_keluar_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: kasbank_keluar_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onkasbank_keluar_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		kasbank_keluar_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		kasbank_keluar_SelectedRow=rowIndex;
		kasbank_keluar_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function kasbank_keluar_editContextMenu(){
		//kasbankKeluarListEditorGrid.startEditing(kasbank_keluar_SelectedRow,1);
		kasbank_keluar_confirm_update();
  	}
	/* End of Function */
  	
	kasbankKeluarListEditorGrid.addListener('rowcontextmenu', onkasbank_keluar_ListEditGridContextMenu);
	kasbank_keluar_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	kasbankKeluarListEditorGrid.on('afteredit', kasbank_keluar_inline_update); // inLine Editing Record
	
	/* Identify  kasbank_keluar_tanggal Field */
	kasbank_keluar_tanggalField= new Ext.form.DateField({
		id: 'kasbank_keluar_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		anchor: '95%'
	});
	/* Identify  kasbank_keluar_nobukti Field */
	kasbank_keluar_nobuktiField= new Ext.form.TextField({
		id: 'kasbank_keluar_nobuktiField',
		fieldLabel: 'No Bukti',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  kasbank_keluar_akun Field */
	kasbank_keluar_akunField= new Ext.form.ComboBox({
		id: 'kasbank_keluar_akunField',
		fieldLabel: 'Akun',
		store: tbl_m_akun_DataStore,
		mode: 'remote',
		displayField: 'akun_nama',
		valueField: 'akun_id',
		loadingText: 'Searching...',
		typeAhead: false,
		pageSize: pageS,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%',
		hideTrigger: false
	
	});

	// kasbank_keluar_akunField= new Ext.form.NumberField({
		// id: 'kasbank_keluar_akunField',
		// fieldLabel: 'Akun',
		// allowNegatife : false,
		// blankText: '0',
		// allowDecimals: false,
				// anchor: '95%',
		// maskRe: /([0-9]+)$/
	// });
	/* Identify  kasbank_keluar_terimauntuk Field */
	kasbank_keluar_terimauntukField= new Ext.form.TextField({
		id: 'kasbank_keluar_terimauntukField',
		fieldLabel: 'Untuk',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  kasbank_keluar_jenis Field */
	kasbank_keluar_jenisField= new Ext.form.TextField({
		id: 'kasbank_keluar_jenisField',
		fieldLabel: 'Jenis',
		readOnly : true,
		hidden : true,
		hideLabel : true,
		value: 'keluar',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  kasbank_keluar_noref Field */
	kasbank_keluar_norefField= new Ext.form.TextField({
		id: 'kasbank_keluar_norefField',
		fieldLabel: 'No Referensi',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  kasbank_keluar_keterangan Field */
	kasbank_keluar_keteranganField= new Ext.form.TextArea({
		id: 'kasbank_keluar_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  kasbank_keluar_post Field */
	// kasbank_keluar_postField= new Ext.form.ComboBox({
		// id: 'kasbank_keluar_postField',
		// hidden: true,
		// fieldLabel: 'Post',
		// store:new Ext.data.SimpleStore({
			// fields:['kasbank_keluar_post_value', 'kasbank_keluar_post_display'],
			// data:[['T','T'],['Y','Y']]
		// }),
		// mode: 'local',
		// displayField: 'kasbank_keluar_post_display',
		// valueField: 'kasbank_keluar_post_value',
		// anchor: '95%',
		// triggerAction: 'all'	
	// });
	// /* Identify  kasbank_keluar_date_post Field */
	// kasbank_keluar_date_postField= new Ext.form.DateField({
		// id: 'kasbank_keluar_date_postField',
		// fieldLabel: 'Date Post',
		// hidden: true,
		// format : 'Y-m-d'
	// });
	
  	/*Fieldset Master*/
	kasbank_keluar_masterGroup = new Ext.form.FieldSet({
		title: 'Master ',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.35,
				layout: 'form',
				border:false,
				items: [kasbank_keluar_tanggalField, kasbank_keluar_nobuktiField,  kasbank_keluar_jenisField,  kasbank_keluar_norefField ] 
			},{
				columnWidth:0.65,
				layout: 'form',
				border:false,
				items: [kasbank_keluar_akunField, kasbank_keluar_terimauntukField, kasbank_keluar_keteranganField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
	// Function for json reader of detail
	var kasbank_keluar_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dkasbank_keluar_id', type: 'int', mapping: 'dkasbank_id'}, 
			{name: 'dkasbank_keluar_master', type: 'int', mapping: 'dkasbank_master'}, 
			{name: 'dkasbank_keluar_akun', type: 'int', mapping: 'dkasbank_akun'}, 
			{name: 'dkasbank_keluar_detail', type: 'string', mapping: 'dkasbank_detail'}, 
			{name: 'dkasbank_keluar_debet', type: 'float', mapping: 'dkasbank_debet'}, 
			{name: 'dkasbank_keluar_kredit', type: 'float', mapping: 'dkasbank_kredit'} 
	]);
	//eof
	
	//function for json writer of detail
	var kasbank_keluar_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	kasbank_keluar_detail_DataStore = new Ext.data.Store({
		id: 'kasbank_keluar_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_kasbank_keluar&m=detail_kasbank_keluar_detail_list', 
			method: 'POST'
		}),
		baseParams:{master_id: get_pk_id()},
		reader: kasbank_keluar_detail_reader,
		sortInfo:{field: 'dkasbank_keluar_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_kasbank_keluar_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//function combo render
	Ext.util.Format.comboRenderer = function(combo){
		tbl_m_akun_DataStore.load();
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_akun=new Ext.form.ComboBox({
			store: tbl_m_akun_DataStore,
			mode: 'remote',
			displayField: 'akun_nama',
			valueField: 'akun_id',
			loadingText: 'Searching...',
			typeAhead: true,
			pageSize: pageS,
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '80%',
			hideTrigger: false
	});
	//eof
	
	
	//declaration of detail coloumn model
	kasbank_keluar_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		
		{
			header: 'Akun',
			dataIndex: 'dkasbank_keluar_akun',
			width: 295,
			sortable: false,
			editor: combo_akun,
			renderer: Ext.util.Format.comboRenderer(combo_akun)
		}, 
		{
			header: 'Kode Akun',
			dataIndex: 'dkasbank_keluar_akun',
			width: 100,
			readOnly: true
		},

		{
			header: 'Keterangan',
			dataIndex: 'dkasbank_keluar_detail',
			width: 250,
			editor: new Ext.form.TextField({
				maxLength: 250			
			})
		}, 
		{
			header: 'Debet (Rp)',
			dataIndex: 'dkasbank_keluar_debet',
			width: 150,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})

		}, 
		{
			header: 'Kredit (Rp)',
			dataIndex: 'dkasbank_keluar_kredit',
			width: 150,
			readOnly: true,
		}]
	);
	kasbank_keluar_detail_ColumnModel.defaultSortable= true;
	//eof

	//declaration of detail list editor grid
	kasbank_keluar_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'kasbank_keluar_detailListEditorGrid',
		el: 'fp_kasbank_keluar_detail',
		title: 'Detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: kasbank_keluar_detail_DataStore, // DataStore
		colModel: kasbank_keluar_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_kasbank_keluar_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: kasbank_keluar_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: kasbank_keluar_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: kasbank_keluar_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function kasbank_keluar_detail_add(){
		var edit_kasbank_keluar_detail= new kasbank_keluar_detailListEditorGrid.store.recordType({
			dkasbank_keluar_id	:'',		
			dkasbank_keluar_akun	:'',		
			dkasbank_keluar_detail	:'',		
			dkasbank_keluar_debet	: 0,		
			dkasbank_keluar_kredit	: ''		
		});
		editor_kasbank_keluar_detail.stopEditing();
		kasbank_keluar_detail_DataStore.insert(0, edit_kasbank_keluar_detail);
		kasbank_keluar_detailListEditorGrid.getView().refresh();
		kasbank_keluar_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_kasbank_keluar_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_kasbank_keluar_detail(){
		
		kasbank_keluar_detail_DataStore.commitChanges();
		kasbank_keluar_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function kasbank_keluar_detail_insert(pkid){
		for(i=0;i<kasbank_keluar_detail_DataStore.getCount();i++){
			kasbank_keluar_detail_record=kasbank_keluar_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_kasbank_keluar&m=detail_kasbank_keluar_detail_insert',
				params:{
				dkasbank_keluar_id	: kasbank_keluar_detail_record.data.dkasbank_keluar_id, 
				dkasbank_keluar_master	: eval(pkid), 
				dkasbank_keluar_akun	: kasbank_keluar_detail_record.data.dkasbank_keluar_akun, 
				dkasbank_keluar_detail	: kasbank_keluar_detail_record.data.dkasbank_keluar_detail, 
				dkasbank_keluar_debet	: kasbank_keluar_detail_record.data.dkasbank_keluar_debet, 
				dkasbank_keluar_kredit	: kasbank_keluar_detail_record.data.dkasbank_keluar_kredit 
				
				}
			});
		}
		kasbank_keluar_DataStore.reload();
	}
	//eof
	
	//function for purge detail
	function kasbank_keluar_detail_purge(pkid){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_kasbank_keluar&m=detail_kasbank_keluar_detail_purge',
			params:{ master_id: pkid },
			success:function(response){
				kasbank_keluar_detail_insert(pkid);
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function kasbank_keluar_detail_confirm_delete(){
		// only one record is selected here
		if(kasbank_keluar_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', kasbank_keluar_detail_delete);
		} else if(kasbank_keluar_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', kasbank_keluar_detail_delete);
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
	function kasbank_keluar_detail_delete(btn){
		if(btn=='yes'){
			var s = kasbank_keluar_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				kasbank_keluar_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	kasbank_keluar_detail_DataStore.on('update', refresh_kasbank_keluar_detail);

	/* Identify  total_debet Field */
	total_debet= new Ext.form.NumberField({
		id: 'total_debet',
		fieldLabel: 'Total Debet',
		allowDecimals: true,
		allowNegative: false,
		readOnly: true,
		blankText: '0',
		maxLength: 22,
		maskRe: /([0-9]+)$/
	});
	total_keluar_kredit= new Ext.form.NumberField({
		id: 'total_keluar_kredit',
		fieldLabel: 'Total Kredit',
		allowDecimals: true,
		allowNegative: false,
		readOnly: true,
		blankText: '0',
		maxLength: 22,
		maskRe: /([0-9]+)$/
	});
  	/*Fieldset Total Jumlah*/
	jumlah_total = new Ext.form.FieldSet({
		title: 'Total Jumlah ',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [total_debet ] 
			},{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [total_keluar_kredit ] 
			}
			]
	
	});
	
	
	/* Function for retrieve create Window Panel*/ 
	kasbank_keluar_saveForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [kasbank_keluar_masterGroup,kasbank_keluar_detailListEditorGrid,jumlah_total]
		,
		buttons: [{
				text: 'Save and Close',
				handler: kasbank_keluar_save
			}
			,{
				text: 'Cancel',
				handler: function(){
					kasbank_keluar_saveWindow.hide();
				}
			}
		]
	});
	

	/* Function for retrieve create Window Form */
	kasbank_keluar_saveWindow= new Ext.Window({
		id: 'kasbank_keluar_saveWindow',
		title: post2db+' Kas/Bank Keluar',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_kasbank_keluar_save',
		items: kasbank_keluar_saveForm
	});
	/* End Window */
	
	/* Function for action list search */
	function kasbank_keluar_list_search(){
		// render according to a SQL date format.
		var kasbank_keluar_id_search=null;
		var kasbank_keluar_tanggal_search_date="";
		var kasbank_keluar_nobukti_search=null;
		var kasbank_keluar_akun_search=null;
		var kasbank_keluar_terimauntuk_search=null;
		var kasbank_keluar_jenis_search=null;
		var kasbank_keluar_noref_search=null;
		var kasbank_keluar_keterangan_search=null;
		var kasbank_keluar_post_search=null;
		var kasbank_keluar_date_post_search_date="";

		if(kasbank_keluar_idSearchField.getValue()!==null){kasbank_keluar_id_search=kasbank_keluar_idSearchField.getValue();}
		if(kasbank_keluar_tanggalSearchField.getValue()!==""){kasbank_keluar_tanggal_search_date=kasbank_keluar_tanggalSearchField.getValue().format('Y-m-d');}
		if(kasbank_keluar_nobuktiSearchField.getValue()!==null){kasbank_keluar_nobukti_search=kasbank_keluar_nobuktiSearchField.getValue();}
		if(kasbank_keluar_akunSearchField.getValue()!==null){kasbank_keluar_akun_search=kasbank_keluar_akunSearchField.getValue();}
		if(kasbank_keluar_terimauntukSearchField.getValue()!==null){kasbank_keluar_terimauntuk_search=kasbank_keluar_terimauntukSearchField.getValue();}
		if(kasbank_keluar_jenisSearchField.getValue()!==null){kasbank_keluar_jenis_search=kasbank_keluar_jenisSearchField.getValue();}
		if(kasbank_keluar_norefSearchField.getValue()!==null){kasbank_keluar_noref_search=kasbank_keluar_norefSearchField.getValue();}
		if(kasbank_keluar_keteranganSearchField.getValue()!==null){kasbank_keluar_keterangan_search=kasbank_keluar_keteranganSearchField.getValue();}
		if(kasbank_keluar_postSearchField.getValue()!==null){kasbank_keluar_post_search=kasbank_keluar_postSearchField.getValue();}
		if(kasbank_keluar_date_postSearchField.getValue()!==""){kasbank_keluar_date_post_search_date=kasbank_keluar_date_postSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		kasbank_keluar_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			kasbank_keluar_id			:	kasbank_keluar_id_search, 
			kasbank_keluar_tanggal		:	kasbank_keluar_tanggal_search_date, 
			kasbank_keluar_nobukti		:	kasbank_keluar_nobukti_search, 
			kasbank_keluar_akun		:	kasbank_keluar_akun_search, 
			kasbank_keluar_terimauntuk	:	kasbank_keluar_terimauntuk_search, 
			kasbank_keluar_jenis		:	kasbank_keluar_jenis_search, 
			kasbank_keluar_noref		:	kasbank_keluar_noref_search, 
			kasbank_keluar_keterangan	:	kasbank_keluar_keterangan_search, 
			kasbank_keluar_post		:	kasbank_keluar_post_search, 
			kasbank_keluar_date_post	:	kasbank_keluar_date_post_search_date
		};
		// Cause the datastore to do another query : 
		kasbank_keluar_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function kasbank_keluar_reset_search(){
		// reset the store parameters
		kasbank_keluar_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		kasbank_keluar_DataStore.reload({params: {start: 0, limit: pageS}});
		kasbank_keluar_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  kasbank_keluar_id Search Field */
	kasbank_keluar_idSearchField= new Ext.form.NumberField({
		id: 'kasbank_keluar_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  kasbank_keluar_tanggal Search Field */
	kasbank_keluar_tanggalSearchField= new Ext.form.DateField({
		id: 'kasbank_keluar_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d'
	
	});
	/* Identify  kasbank_keluar_nobukti Search Field */
	kasbank_keluar_nobuktiSearchField= new Ext.form.TextField({
		id: 'kasbank_keluar_nobuktiSearchField',
		fieldLabel: 'Nobukti',
		maxLength: 50,
		anchor: '50%'
	
	});
	/* Identify  kasbank_keluar_akun Search Field */
	kasbank_keluar_akunSearchField= new Ext.form.ComboBox({
		id: 'kasbank_keluar_akunSearchField',
		fieldLabel: 'Akun',
		store: tbl_m_akun_DataStore,
		mode: 'remote',
		displayField: 'akun_nama',
		valueField: 'akun_id',
		loadingText: 'Searching...',
		typeAhead: false,
		pageSize: pageS,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%',
		hideTrigger: false
	
	});
	
	// kasbank_keluar_akunSearchField= new Ext.form.NumberField({
		// id: 'kasbank_keluar_akunSearchField',
		// fieldLabel: 'Kasbank Akun',
		// allowNegatife : false,
		// blankText: '0',
		// allowDecimals: false,
		// anchor: '95%',
		// maskRe: /([0-9]+)$/
	
	// });
	/* Identify  kasbank_keluar_terimauntuk Search Field */
	kasbank_keluar_terimauntukSearchField= new Ext.form.TextField({
		id: 'kasbank_keluar_terimauntukSearchField',
		fieldLabel: 'Terima Untuk',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  kasbank_keluar_jenis Search Field */
	kasbank_keluar_jenisSearchField= new Ext.form.ComboBox({
		id: 'kasbank_keluar_jenisSearchField',
		fieldLabel: 'Jenis',
		store:new Ext.data.SimpleStore({
			fields:['value', 'kasbank_keluar_jenis'],
			data:[['keluar','keluar'],['masuk','masuk']]
		}),
		mode: 'local',
		displayField: 'kasbank_keluar_jenis',
		valueField: 'value',
		anchor: '50%',
		triggerAction: 'all'	 
	
	});
	/* Identify  kasbank_keluar_noref Search Field */
	kasbank_keluar_norefSearchField= new Ext.form.TextField({
		id: 'kasbank_keluar_norefSearchField',
		fieldLabel: 'No Referensi',
		maxLength: 50,
		anchor: '50%'
	
	});
	/* Identify  kasbank_keluar_keterangan Search Field */
	kasbank_keluar_keteranganSearchField= new Ext.form.TextArea({
		id: 'kasbank_keluar_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  kasbank_keluar_post Search Field */
	kasbank_keluar_postSearchField= new Ext.form.ComboBox({
		id: 'kasbank_keluar_postSearchField',
		fieldLabel: 'Post',
		store:new Ext.data.SimpleStore({
			fields:['value', 'kasbank_keluar_post'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'kasbank_keluar_post',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  kasbank_keluar_date_post Search Field */
	kasbank_keluar_date_postSearchField= new Ext.form.DateField({
		id: 'kasbank_keluar_date_postSearchField',
		fieldLabel: 'Date Post',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	kasbank_keluar_searchForm = new Ext.FormPanel({
		labelAlign:'left',
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
				items: [kasbank_keluar_tanggalSearchField, kasbank_keluar_nobuktiSearchField, kasbank_keluar_akunSearchField, kasbank_keluar_terimauntukSearchField, kasbank_keluar_jenisSearchField, kasbank_keluar_norefSearchField, kasbank_keluar_keteranganSearchField, ] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: kasbank_keluar_list_search
			},{
				text: 'Close',
				handler: function(){
					kasbank_keluar_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	kasbank_keluar_searchWindow = new Ext.Window({
		title: 'Kas/Bank Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_kasbank_keluar_search',
		items: kasbank_keluar_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!kasbank_keluar_searchWindow.isVisible()){
			kasbank_keluar_searchWindow.show();
		} else {
			kasbank_keluar_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function kasbank_keluar_print(){
		var searchquery = "";
		var kasbank_keluar_tanggal_print_date="";
		var kasbank_keluar_nobukti_print=null;
		var kasbank_keluar_akun_print=null;
		var kasbank_keluar_terimauntuk_print=null;
		var kasbank_keluar_jenis_print=null;
		var kasbank_keluar_noref_print=null;
		var kasbank_keluar_keterangan_print=null;
		var kasbank_keluar_post_print=null;
		var kasbank_keluar_date_post_print_date="";
		var win;              
		// check if we do have some search data...
		if(kasbank_keluar_DataStore.baseParams.query!==null){searchquery = kasbank_keluar_DataStore.baseParams.query;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_tanggal!==""){kasbank_keluar_tanggal_print_date = kasbank_keluar_DataStore.baseParams.kasbank_keluar_tanggal;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_nobukti!==null){kasbank_keluar_nobukti_print = kasbank_keluar_DataStore.baseParams.kasbank_keluar_nobukti;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_akun!==null){kasbank_keluar_akun_print = kasbank_keluar_DataStore.baseParams.kasbank_keluar_akun;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_terimauntuk!==null){kasbank_keluar_terimauntuk_print = kasbank_keluar_DataStore.baseParams.kasbank_keluar_terimauntuk;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_jenis!==null){kasbank_keluar_jenis_print = kasbank_keluar_DataStore.baseParams.kasbank_keluar_jenis;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_noref!==null){kasbank_keluar_noref_print = kasbank_keluar_DataStore.baseParams.kasbank_keluar_noref;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_keterangan!==null){kasbank_keluar_keterangan_print = kasbank_keluar_DataStore.baseParams.kasbank_keluar_keterangan;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_post!==null){kasbank_keluar_post_print = kasbank_keluar_DataStore.baseParams.kasbank_keluar_post;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_date_post!==""){kasbank_keluar_date_post_print_date = kasbank_keluar_DataStore.baseParams.kasbank_keluar_date_post;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_kasbank_keluar&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	kasbank_keluar_tanggal : kasbank_keluar_tanggal_print_date, 
			kasbank_keluar_nobukti : kasbank_keluar_nobukti_print,
			kasbank_keluar_akun : kasbank_keluar_akun_print,
			kasbank_keluar_terimauntuk : kasbank_keluar_terimauntuk_print,
			kasbank_keluar_jenis : kasbank_keluar_jenis_print,
			kasbank_keluar_noref : kasbank_keluar_noref_print,
			kasbank_keluar_keterangan : kasbank_keluar_keterangan_print,
			kasbank_keluar_post : kasbank_keluar_post_print,
		  	kasbank_keluar_date_post : kasbank_keluar_date_post_print_date, 
		  	currentlisting: kasbank_keluar_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/kasbank_keluar_printlist.html','kasbanklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function kasbank_keluar_export_excel(){
		var searchquery = "";
		var kasbank_keluar_tanggal_2excel_date="";
		var kasbank_keluar_nobukti_2excel=null;
		var kasbank_keluar_akun_2excel=null;
		var kasbank_keluar_terimauntuk_2excel=null;
		var kasbank_keluar_jenis_2excel=null;
		var kasbank_keluar_noref_2excel=null;
		var kasbank_keluar_keterangan_2excel=null;
		var kasbank_keluar_post_2excel=null;
		var kasbank_keluar_date_post_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(kasbank_keluar_DataStore.baseParams.query!==null){searchquery = kasbank_keluar_DataStore.baseParams.query;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_tanggal!==""){kasbank_keluar_tanggal_2excel_date = kasbank_keluar_DataStore.baseParams.kasbank_keluar_tanggal;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_nobukti!==null){kasbank_keluar_nobukti_2excel = kasbank_keluar_DataStore.baseParams.kasbank_keluar_nobukti;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_akun!==null){kasbank_keluar_akun_2excel = kasbank_keluar_DataStore.baseParams.kasbank_keluar_akun;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_terimauntuk!==null){kasbank_keluar_terimauntuk_2excel = kasbank_keluar_DataStore.baseParams.kasbank_keluar_terimauntuk;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_jenis!==null){kasbank_keluar_jenis_2excel = kasbank_keluar_DataStore.baseParams.kasbank_keluar_jenis;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_noref!==null){kasbank_keluar_noref_2excel = kasbank_keluar_DataStore.baseParams.kasbank_keluar_noref;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_keterangan!==null){kasbank_keluar_keterangan_2excel = kasbank_keluar_DataStore.baseParams.kasbank_keluar_keterangan;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_post!==null){kasbank_keluar_post_2excel = kasbank_keluar_DataStore.baseParams.kasbank_keluar_post;}
		if(kasbank_keluar_DataStore.baseParams.kasbank_keluar_date_post!==""){kasbank_keluar_date_post_2excel_date = kasbank_keluar_DataStore.baseParams.kasbank_keluar_date_post;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_kasbank_keluar&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	kasbank_keluar_tanggal : kasbank_keluar_tanggal_2excel_date, 
			kasbank_keluar_nobukti : kasbank_keluar_nobukti_2excel,
			kasbank_keluar_akun : kasbank_keluar_akun_2excel,
			kasbank_keluar_terimauntuk : kasbank_keluar_terimauntuk_2excel,
			kasbank_keluar_jenis : kasbank_keluar_jenis_2excel,
			kasbank_keluar_noref : kasbank_keluar_noref_2excel,
			kasbank_keluar_keterangan : kasbank_keluar_keterangan_2excel,
			kasbank_keluar_post : kasbank_keluar_post_2excel,
		  	kasbank_keluar_date_post : kasbank_keluar_date_post_2excel_date, 
		  	currentlisting: kasbank_keluar_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	function get_total_keluar_debet_kredit(){
		var jumlah_total_debet=0;
		var jumlah_total_keluar_kredit=0;
		for(i=0;i<kasbank_keluar_detail_DataStore.getCount();i++){
			record_data=kasbank_keluar_detail_DataStore.getAt(i);
			jumlah_total_debet+=record_data.data.dkasbank_keluar_debet;
			jumlah_total_keluar_kredit+=record_data.data.dkasbank_keluar_kredit;
		}
		console.log('jml debet'+jumlah_total_debet);
		total_debet.setValue(jumlah_total_debet);
		total_keluar_kredit.setValue(jumlah_total_keluar_kredit);
	}
	
	kasbank_keluar_detail_DataStore.on("update",function(){
		kasbank_keluar_detail_DataStore.commitChanges();
		get_total_keluar_debet_kredit();
	});
	/*End of Function */
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_kasbank_keluar"></div>
        <div id="fp_kasbank_keluar_detail"></div>
		<div id="elwindow_kasbank_keluar_save"></div>
        <div id="elwindow_kasbank_keluar_search"></div>
    </div>
</div>
</body>
</html>