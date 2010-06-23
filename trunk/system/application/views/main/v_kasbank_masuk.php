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
var kasbank_masuk_DataStore;
var kasbank_masuk_ColumnModel;
var kasbankMasukListEditorGrid;
var kasbank_masuk_saveForm;
var kasbank_masuk_saveWindow;
var kasbank_masuk_searchForm;
var kasbank_masuk_searchWindow;
var kasbank_masuk_SelectedRow;
var kasbank_masuk_ContextMenu;
//for detail data
var kasbank_masuk_detail_DataStore;
var kasbank_masuk_detailListEditorGrid;
var kasbank_masuk_detail_ColumnModel;
var kasbank_masuk_detail_proxy;
var kasbank_masuk_detail_writer;
var kasbank_masuk_detail_reader;
var editor_kasbank_masuk_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var kasbank_masuk_idField;
var kasbank_masuk_tanggalField;
var kasbank_masuk_nobuktiField;
var kasbank_masuk_akunField;
var kasbank_masuk_terimauntukField;
var kasbank_masuk_jenisField;
var kasbank_masuk_norefField;
var kasbank_masuk_keteranganField;
var kasbank_masuk_authorField;
var kasbank_masuk_postField;
var kasbank_masuk_date_postField;
var kasbank_masuk_idSearchField;
var kasbank_masuk_tanggalSearchField;
var kasbank_masuk_nobuktiSearchField;
var kasbank_masuk_akunSearchField;
var kasbank_masuk_terimauntukSearchField;
var kasbank_masuk_jenisSearchField;
var kasbank_masuk_norefSearchField;
var kasbank_masuk_keteranganSearchField;
var kasbank_masuk_authorSearchField;
var kasbank_masuk_postSearchField;
var kasbank_masuk_date_postSearchField;
var total_debet;
var total_masuk_kredit;
var jenis_kasbank = "masuk";
/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  /* Function for Saving inLine Editing */
	function kasbank_masuk_inline_update(oGrid_event){
		var kasbank_masuk_id_update_pk="";
		var kasbank_masuk_tanggal_update_date="";
		var kasbank_masuk_nobukti_update=null;
		var kasbank_masuk_akun_update=null;
		var kasbank_masuk_terimauntuk_update=null;
		var kasbank_masuk_jenis_update=null;
		var kasbank_masuk_noref_update=null;
		var kasbank_masuk_keterangan_update=null;
		var kasbank_masuk_post_update=null;
		var kasbank_masuk_date_post_update_date="";

		kasbank_masuk_id_update_pk = oGrid_event.record.data.kasbank_masuk_id;
	 	if(oGrid_event.record.data.kasbank_masuk_tanggal!== ""){kasbank_masuk_tanggal_update_date =oGrid_event.record.data.kasbank_masuk_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.kasbank_masuk_nobukti!== null){kasbank_masuk_nobukti_update = oGrid_event.record.data.kasbank_masuk_nobukti;}
		if(oGrid_event.record.data.kasbank_masuk_akun!== null){kasbank_masuk_akun_update = oGrid_event.record.data.kasbank_masuk_akun;}
		if(oGrid_event.record.data.kasbank_masuk_terimauntuk!== null){kasbank_masuk_terimauntuk_update = oGrid_event.record.data.kasbank_masuk_terimauntuk;}
		if(oGrid_event.record.data.kasbank_masuk_jenis!== null){kasbank_masuk_jenis_update = oGrid_event.record.data.kasbank_masuk_jenis;}
		if(oGrid_event.record.data.kasbank_masuk_noref!== null){kasbank_masuk_noref_update = oGrid_event.record.data.kasbank_masuk_noref;}
		if(oGrid_event.record.data.kasbank_masuk_keterangan!== null){kasbank_masuk_keterangan_update = oGrid_event.record.data.kasbank_masuk_keterangan;}
		if(oGrid_event.record.data.kasbank_masuk_post!== null){kasbank_masuk_post_update = oGrid_event.record.data.kasbank_masuk_post;}
	 	if(oGrid_event.record.data.kasbank_masuk_date_post!== ""){kasbank_masuk_date_post_update_date =oGrid_event.record.data.kasbank_masuk_date_post.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_kasbank_masuk&m=get_action',
			params: {
				kasbank_masuk_id	: kasbank_masuk_id_update_pk, 
				kasbank_masuk_tanggal	: kasbank_masuk_tanggal_update_date, 
				kasbank_masuk_nobukti	:kasbank_masuk_nobukti_update,
				kasbank_masuk_akun	:kasbank_masuk_akun_update,
				kasbank_masuk_terimauntuk	:kasbank_masuk_terimauntuk_update,
				//kasbank_masuk_jenis	:kasbank_masuk_jenis_update,
				kasbank_masuk_jenis	: jenis_kasbank,
				kasbank_masuk_noref	:kasbank_masuk_noref_update,
				kasbank_masuk_keterangan	:kasbank_masuk_keterangan_update,
				kasbank_masuk_post	:kasbank_masuk_post_update,
				kasbank_masuk_date_post	: kasbank_masuk_date_post_update_date, 
				task: "UPDATE"
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				if(result!==0){
						kasbank_masuk_detail_purge(result);
						Ext.MessageBox.alert(post2db+' OK','The Kasbank was '+post2db+' successfully.');
						kasbank_masuk_DataStore.reload();
						kasbank_masuk_saveWindow.hide();
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
	function kasbank_masuk_save(){
	
		if(is_kasbank_masuk_form_valid()){	
			var kasbank_masuk_id_field_pk=null; 
			var kasbank_masuk_tanggal_field_date=""; 
			var kasbank_masuk_nobukti_field=null; 
			var kasbank_masuk_akun_field=null; 
			var kasbank_masuk_terimauntuk_field=null; 
			var kasbank_masuk_jenis_field=null; 
			var kasbank_masuk_noref_field=null; 
			var kasbank_masuk_keterangan_field=null; 
			var kasbank_masuk_post_field=null; 
			var kasbank_masuk_date_post_field_date=""; 
			
			

			kasbank_masuk_id_field_pk=get_pk_id();
			if(kasbank_masuk_tanggalField.getValue()!== ""){kasbank_masuk_tanggal_field_date = kasbank_masuk_tanggalField.getValue().format('Y-m-d');} 
			if(kasbank_masuk_nobuktiField.getValue()!== null){kasbank_masuk_nobukti_field = kasbank_masuk_nobuktiField.getValue();} 
			if(kasbank_masuk_akunField.getValue()!== null){kasbank_masuk_akun_field = kasbank_masuk_akunField.getValue();} 
			if(kasbank_masuk_terimauntukField.getValue()!== null){kasbank_masuk_terimauntuk_field = kasbank_masuk_terimauntukField.getValue();} 
			if(kasbank_masuk_jenisField.getValue()!== null){kasbank_masuk_jenis_field = 'masuk';} 
			if(kasbank_masuk_norefField.getValue()!== null){kasbank_masuk_noref_field = kasbank_masuk_norefField.getValue();} 
			if(kasbank_masuk_keteranganField.getValue()!== null){kasbank_masuk_keterangan_field = kasbank_masuk_keteranganField.getValue();} 
			//if(kasbank_masuk_postField.getValue()!== null){kasbank_masuk_post_field = kasbank_masuk_postField.getValue();} 
			//if(kasbank_masuk_date_postField.getValue()!== ""){kasbank_masuk_date_post_field_date = kasbank_masuk_date_postField.getValue().format('Y-m-d');} 

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_kasbank_masuk&m=get_action',
				params: {
					kasbank_masuk_id			: kasbank_masuk_id_field_pk, 
					kasbank_masuk_tanggal		: kasbank_masuk_tanggal_field_date, 
					kasbank_masuk_nobukti		: kasbank_masuk_nobukti_field, 
					kasbank_masuk_akun		: kasbank_masuk_akun_field, 
					kasbank_masuk_terimauntuk	: kasbank_masuk_terimauntuk_field, 
					kasbank_masuk_jenis		: kasbank_masuk_jenis_field, 
					kasbank_masuk_noref		: kasbank_masuk_noref_field, 
					kasbank_masuk_keterangan	: kasbank_masuk_keterangan_field, 
					kasbank_masuk_post		: kasbank_masuk_post_field, 
					kasbank_masuk_date_post	: kasbank_masuk_date_post_field_date, 
					task				: post2db
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					if(result!==0){
							kasbank_masuk_detail_purge(result);
							Ext.MessageBox.alert(post2db+' OK','The Tbl T Kasbank was '+post2db+' successfully.');
							kasbank_masuk_DataStore.reload();
							kasbank_masuk_saveWindow.hide();
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
			return kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function kasbank_masuk_reset_form(){
		kasbank_masuk_tanggalField.reset();
		kasbank_masuk_tanggalField.setValue(null);
		kasbank_masuk_nobuktiField.reset();
		kasbank_masuk_nobuktiField.setValue(null);
		kasbank_masuk_akunField.reset();
		kasbank_masuk_akunField.setValue(null);
		kasbank_masuk_terimauntukField.reset();
		kasbank_masuk_terimauntukField.setValue(null);
		//kasbank_masuk_jenisField.reset();
		//kasbank_masuk_jenisField.setValue(null);
		kasbank_masuk_norefField.reset();
		kasbank_masuk_norefField.setValue(null);
		kasbank_masuk_keteranganField.reset();
		kasbank_masuk_keteranganField.setValue(null);
		//kasbank_masuk_postField.reset();
		//kasbank_masuk_postField.setValue(null);
		//kasbank_masuk_date_postField.reset();
		//kasbank_masuk_date_postField.setValue(null);
		jumlah_total_debet=null;
		
		jumlah_total_masuk_kredit=null;
		
		kasbank_masuk_detail_DataStore.setBaseParam('master_id',null);
		kasbank_masuk_detail_DataStore.load();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function kasbank_masuk_set_form(){
		
		kasbank_masuk_tanggalField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_tanggal'));
		kasbank_masuk_nobuktiField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_nobukti'));
		kasbank_masuk_akunField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_akun'));
		kasbank_masuk_terimauntukField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_terimauntuk'));
		kasbank_masuk_jenisField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_jenis'));
		kasbank_masuk_norefField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_noref'));
		kasbank_masuk_keteranganField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_keterangan'));
		//kasbank_masuk_postField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_post'));
		//kasbank_masuk_date_postField.setValue(kasbankMasukListEditorGrid.getSelectionModel().getSelected().get('kasbank_masuk_date_post'));
		kasbank_masuk_detail_DataStore.setBaseParam('master_id',get_pk_id());
		kasbank_masuk_detail_DataStore.load();
		
		
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_kasbank_masuk_form_valid(){
		return (true);
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!kasbank_masuk_saveWindow.isVisible()){
			kasbank_masuk_reset_form();
			post2db='CREATE';
			msg='created';
			kasbank_masuk_saveWindow.show();
		} else {
			kasbank_masuk_saveWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function kasbank_masuk_confirm_delete(){
		// only one kasbank is selected here
		if(kasbankMasukListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', kasbank_masuk_delete);
		} else if(kasbankMasukListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', kasbank_masuk_delete);
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
	function kasbank_masuk_confirm_update(){
		/* only one record is selected here */
		if(kasbankMasukListEditorGrid.selModel.getCount() == 1) {
			
			post2db='UPDATE';
			kasbank_masuk_set_form();
			msg='updated';
			
			kasbank_masuk_saveWindow.show();
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
	function kasbank_masuk_delete(btn){
		if(btn=='yes'){
			var selections = kasbankMasukListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< kasbankMasukListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.kasbank_masuk_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_kasbank_masuk&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							kasbank_masuk_DataStore.reload();
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
	kasbank_masuk_DataStore = new Ext.data.Store({
		id: 'kasbank_masuk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_kasbank_masuk&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kasbank_masuk_id'
		},[
		/* dataIndex => insert intokasbank_masuk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'kasbank_masuk_id', type: 'int', mapping: 'kasbank_id'}, 
			{name: 'kasbank_masuk_tanggal', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kasbank_tanggal'}, 
			{name: 'kasbank_masuk_nobukti', type: 'string', mapping: 'kasbank_nobukti'}, 
			{name: 'kasbank_masuk_akun', type: 'string', mapping: 'akun_nama'}, 
			{name: 'kasbank_masuk_kode', type: 'string', mapping: 'akun_kode'}, 
			{name: 'kasbank_masuk_terimauntuk', type: 'string', mapping: 'kasbank_terimauntuk'}, 
			{name: 'kasbank_masuk_jenis', type: 'string', mapping: 'kasbank_jenis'}, 
			{name: 'kasbank_masuk_noref', type: 'string', mapping: 'kasbank_noref'}, 
			{name: 'kasbank_masuk_keterangan', type: 'string', mapping: 'kasbank_keterangan'}, 
			{name: 'kasbank_masuk_author', type: 'string', mapping: 'kasbank_author'}, 
			{name: 'kasbank_masuk_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kasbank_date_create'}, 
			{name: 'kasbank_masuk_update', type: 'string', mapping: 'kasbank_update'}, 
			{name: 'kasbank_masuk_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kasbank_date_update'}, 
			{name: 'kasbank_masuk_post', type: 'string', mapping: 'kasbank_masuk_post'}, 
			{name: 'kasbank_masuk_date_post', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'kasbank_date_post'}, 
			{name: 'kasbank_masuk_revised', type: 'int', mapping: 'kasbank_mrevised'} 
		]),
		sortInfo:{field: 'kasbank_masuk_id', direction: "DESC"}
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
	kasbank_masuk_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'kasbank_masuk_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Tanggal',
			dataIndex: 'kasbank_masuk_tanggal',
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
			dataIndex: 'kasbank_masuk_nobukti',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Nama Akun',
			dataIndex: 'kasbank_masuk_akun',
			width: 250,
			sortable: true,
			readOnly: true,
			editor: new Ext.form.ComboBox({
					id: 'cb_kasbank_masuk_akun',
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
			dataIndex: 'kasbank_masuk_kode',
			width: 100,
			readOnly: true
		},
		{
			header: 'Terima',
			dataIndex: 'kasbank_masuk_terimauntuk',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250			})
		}, 
		// {
			// header: 'Jenis',
			// dataIndex: 'kasbank_masuk_jenis',
			// width: 150,
			// sortable: true,
			// readOnly: true,
		// }, 
		{
			header: 'No. Ref',
			dataIndex: 'kasbank_masuk_noref',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'kasbank_masuk_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250			}),
			hidden: true,
		}, 
		{
			header: 'Author',
			dataIndex: 'kasbank_masuk_author',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Create on',
			dataIndex: 'kasbank_masuk_date_create',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'kasbank_masuk_update',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'kasbank_masuk_date_update',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Posted',
			dataIndex: 'kasbank_masuk_post',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Posted on',
			dataIndex: 'kasbank_masuk_date_post',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Revised',
			dataIndex: 'kasbank_masuk_revised',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}	]);
	
	kasbank_masuk_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	kasbankMasukListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'kasbankMasukListEditorGrid',
		el: 'fp_kasbank_masuk',
		title: 'Kas/Bank Masuk',
		autoHeight: true,
		store: kasbank_masuk_DataStore, // DataStore
		cm: kasbank_masuk_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: kasbank_masuk_DataStore,
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
			handler: kasbank_masuk_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: kasbank_masuk_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: kasbank_masuk_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: kasbank_masuk_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: kasbank_masuk_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: kasbank_masuk_print  
		}
		]
	});
	kasbankMasukListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	kasbank_masuk_ContextMenu = new Ext.menu.Menu({
		id: 'kasbank_masuk_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: kasbank_masuk_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: kasbank_masuk_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: kasbank_masuk_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: kasbank_masuk_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onkasbank_masuk_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		kasbank_masuk_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		kasbank_masuk_SelectedRow=rowIndex;
		kasbank_masuk_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function kasbank_masuk_editContextMenu(){
		//kasbankMasukListEditorGrid.startEditing(kasbank_masuk_SelectedRow,1);
		kasbank_masuk_confirm_update();
  	}
	/* End of Function */
  	
	kasbankMasukListEditorGrid.addListener('rowcontextmenu', onkasbank_masuk_ListEditGridContextMenu);
	kasbank_masuk_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	kasbankMasukListEditorGrid.on('afteredit', kasbank_masuk_inline_update); // inLine Editing Record
	
	// function select data store
	// kasbank_masuk_akunField.on('select', function(){
		// var index=tbl_m_akun_DataStore.findExact('akun_id',kasbank_masuk_akunField.getValue(),0);
		// if(index>-1){
			// kasbank_masuk_kodeakunField.setValue(tbl_m_akun_DataStore.getAt(index).data.akun_kode);
		// }
	// });
	
	
	/* Identify  kasbank_masuk_tanggal Field */
	kasbank_masuk_tanggalField= new Ext.form.DateField({
		id: 'kasbank_masuk_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		anchor: '95%'
	});
	/* Identify  kasbank_masuk_nobukti Field */
	kasbank_masuk_nobuktiField= new Ext.form.TextField({
		id: 'kasbank_masuk_nobuktiField',
		fieldLabel: 'No Bukti',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  kasbank_masuk_akun Field */
	kasbank_masuk_akunField= new Ext.form.ComboBox({
		id: 'kasbank_masuk_akunField',
		fieldLabel: 'Nama Akun',
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

	/* Identify  kasbank_masuk_kodeakun Field */
	kasbank_masuk_kodeakunField= new Ext.form.TextField({
		id: 'kasbank_masuk_kodeakunField',
		fieldLabel: 'Kode akun',
		maxLength: 250,
		anchor: '95%',
		readOnly: true
	});
	/* Identify  kasbank_masuk_terimauntuk Field */
	kasbank_masuk_terimauntukField= new Ext.form.TextField({
		id: 'kasbank_masuk_terimauntukField',
		fieldLabel: 'Terima',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  kasbank_masuk_jenis Field */
	kasbank_masuk_jenisField= new Ext.form.TextField({
		id: 'kasbank_masuk_jenisField',
		fieldLabel: 'Jenis',
		readOnly : true,
		hidden : true,
		hideLabel : true,
		value: 'masuk',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  kasbank_masuk_noref Field */
	kasbank_masuk_norefField= new Ext.form.TextField({
		id: 'kasbank_masuk_norefField',
		fieldLabel: 'No Referensi',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  kasbank_masuk_keterangan Field */
	kasbank_masuk_keteranganField= new Ext.form.TextArea({
		id: 'kasbank_masuk_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  kasbank_masuk_post Field */
	// kasbank_masuk_postField= new Ext.form.ComboBox({
		// id: 'kasbank_masuk_postField',
		// hidden: true,
		// fieldLabel: 'Post',
		// store:new Ext.data.SimpleStore({
			// fields:['kasbank_masuk_post_value', 'kasbank_masuk_post_display'],
			// data:[['T','T'],['Y','Y']]
		// }),
		// mode: 'local',
		// displayField: 'kasbank_masuk_post_display',
		// valueField: 'kasbank_masuk_post_value',
		// anchor: '95%',
		// triggerAction: 'all'	
	// });
	// /* Identify  kasbank_masuk_date_post Field */
	// kasbank_masuk_date_postField= new Ext.form.DateField({
		// id: 'kasbank_masuk_date_postField',
		// fieldLabel: 'Date Post',
		// hidden: true,
		// format : 'Y-m-d'
	// });
	
  	/*Fieldset Master*/
	kasbank_masuk_masterGroup = new Ext.form.FieldSet({
		title: 'Master ',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.35,
				layout: 'form',
				border:false,
				items: [kasbank_masuk_tanggalField, kasbank_masuk_nobuktiField,  kasbank_masuk_jenisField,  kasbank_masuk_norefField ] 
			},{
				columnWidth:0.65,
				layout: 'form',
				border:false,
				items: [kasbank_masuk_akunField, kasbank_masuk_kodeakunField, kasbank_masuk_terimauntukField, kasbank_masuk_keteranganField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
	// Function for json reader of detail
	var kasbank_masuk_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dkasbank_masuk_id', type: 'int', mapping: 'dkasbank_id'}, 
			{name: 'dkasbank_masuk_master', type: 'int', mapping: 'dkasbank_master'}, 
			{name: 'dkasbank_masuk_akun', type: 'int', mapping: 'dkasbank_akun'}, 
			{name: 'dkasbank_masuk_detail', type: 'string', mapping: 'dkasbank_detail'}, 
			{name: 'dkasbank_masuk_debet', type: 'float', mapping: 'dkasbank_debet'}, 
			{name: 'dkasbank_masuk_kredit', type: 'float', mapping: 'dkasbank_kredit'} 
	]);
	//eof
	
	//function for json writer of detail
	var kasbank_masuk_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	kasbank_masuk_detail_DataStore = new Ext.data.Store({
		id: 'kasbank_masuk_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_kasbank_masuk&m=detail_kasbank_masuk_detail_list', 
			method: 'POST'
		}),
		baseParams:{master_id: get_pk_id()},
		reader: kasbank_masuk_detail_reader,
		sortInfo:{field: 'dkasbank_masuk_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_kasbank_masuk_detail= new Ext.ux.grid.RowEditor({
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
	

	// variable combo akun
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
	kasbank_masuk_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		
		{
			header: 'Akun',
			dataIndex: 'dkasbank_masuk_akun',
			width: 295,
			sortable: false,
			editor: combo_akun,
			renderer: Ext.util.Format.comboRenderer(combo_akun)
		}, 
		{
			header: 'Kode Akun',
			dataIndex: 'dkasbank_masuk_akun',
			width: 100,
			readOnly: true
		},

		{
			header: 'Keterangan',
			dataIndex: 'dkasbank_masuk_detail',
			width: 250,
			editor: new Ext.form.TextField({
				maxLength: 250			
			})
		}, 
		{
			header: 'Debet (Rp)',
			dataIndex: 'dkasbank_masuk_debet',
			width: 150,
			readOnly: true

		}, 
		{
			header: 'Kredit (Rp)',
			dataIndex: 'dkasbank_masuk_kredit',
			width: 150,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	kasbank_masuk_detail_ColumnModel.defaultSortable= true;
	//eof

	//declaration of detail list editor grid
	kasbank_masuk_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'kasbank_masuk_detailListEditorGrid',
		el: 'fp_kasbank_masuk_detail',
		title: 'Detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: kasbank_masuk_detail_DataStore, // DataStore
		colModel: kasbank_masuk_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_kasbank_masuk_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: kasbank_masuk_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: kasbank_masuk_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: kasbank_masuk_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function kasbank_masuk_detail_add(){
		var edit_kasbank_masuk_detail= new kasbank_masuk_detailListEditorGrid.store.recordType({
			dkasbank_masuk_id	:'',		
			dkasbank_masuk_akun	:'',		
			dkasbank_masuk_detail	:'',		
			dkasbank_masuk_debet	: '',		
			dkasbank_masuk_kredit	: 0		
		});
		editor_kasbank_masuk_detail.stopEditing();
		kasbank_masuk_detail_DataStore.insert(0, edit_kasbank_masuk_detail);
		kasbank_masuk_detailListEditorGrid.getView().refresh();
		kasbank_masuk_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_kasbank_masuk_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_kasbank_masuk_detail(){
		
		kasbank_masuk_detail_DataStore.commitChanges();
		kasbank_masuk_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function kasbank_masuk_detail_insert(pkid){
		for(i=0;i<kasbank_masuk_detail_DataStore.getCount();i++){
			kasbank_masuk_detail_record=kasbank_masuk_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_kasbank_masuk&m=detail_kasbank_masuk_detail_insert',
				params:{
				dkasbank_masuk_id	: kasbank_masuk_detail_record.data.dkasbank_masuk_id, 
				dkasbank_masuk_master	: eval(pkid), 
				dkasbank_masuk_akun	: kasbank_masuk_detail_record.data.dkasbank_masuk_akun, 
				dkasbank_masuk_detail	: kasbank_masuk_detail_record.data.dkasbank_masuk_detail, 
				dkasbank_masuk_debet	: kasbank_masuk_detail_record.data.dkasbank_masuk_debet, 
				dkasbank_masuk_kredit	: kasbank_masuk_detail_record.data.dkasbank_masuk_kredit 
				
				}
			});
		}
		kasbank_masuk_DataStore.reload();
	}
	//eof
	
	//function for purge detail
	function kasbank_masuk_detail_purge(pkid){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_kasbank_masuk&m=detail_kasbank_masuk_detail_purge',
			params:{ master_id: pkid },
			success:function(response){
				kasbank_masuk_detail_insert(pkid);
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function kasbank_masuk_detail_confirm_delete(){
		// only one record is selected here
		if(kasbank_masuk_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', kasbank_masuk_detail_delete);
		} else if(kasbank_masuk_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', kasbank_masuk_detail_delete);
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
	function kasbank_masuk_detail_delete(btn){
		if(btn=='yes'){
			var s = kasbank_masuk_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				kasbank_masuk_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	kasbank_masuk_detail_DataStore.on('update', refresh_kasbank_masuk_detail);

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
	total_masuk_kredit= new Ext.form.NumberField({
		id: 'total_masuk_kredit',
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
				items: [total_masuk_kredit ] 
			}
			]
	
	});
	
	
	/* Function for retrieve create Window Panel*/ 
	kasbank_masuk_saveForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [kasbank_masuk_masterGroup,kasbank_masuk_detailListEditorGrid,jumlah_total]
		,
		buttons: [{
				text: 'Save and Close',
				handler: kasbank_masuk_save
			}
			,{
				text: 'Cancel',
				handler: function(){
					kasbank_masuk_saveWindow.hide();
				}
			}
		]
	});
	

	/* Function for retrieve create Window Form */
	kasbank_masuk_saveWindow= new Ext.Window({
		id: 'kasbank_masuk_saveWindow',
		title: post2db+' Kas/Bank Masuk',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_kasbank_masuk_save',
		items: kasbank_masuk_saveForm
	});
	/* End Window */
	
	/* Function for action list search */
	function kasbank_masuk_list_search(){
		// render according to a SQL date format.
		var kasbank_masuk_id_search=null;
		var kasbank_masuk_tanggal_search_date="";
		var kasbank_masuk_nobukti_search=null;
		var kasbank_masuk_akun_search=null;
		var kasbank_masuk_terimauntuk_search=null;
		var kasbank_masuk_jenis_search=null;
		var kasbank_masuk_noref_search=null;
		var kasbank_masuk_keterangan_search=null;
		var kasbank_masuk_post_search=null;
		var kasbank_masuk_date_post_search_date="";

		if(kasbank_masuk_idSearchField.getValue()!==null){kasbank_masuk_id_search=kasbank_masuk_idSearchField.getValue();}
		if(kasbank_masuk_tanggalSearchField.getValue()!==""){kasbank_masuk_tanggal_search_date=kasbank_masuk_tanggalSearchField.getValue().format('Y-m-d');}
		if(kasbank_masuk_nobuktiSearchField.getValue()!==null){kasbank_masuk_nobukti_search=kasbank_masuk_nobuktiSearchField.getValue();}
		if(kasbank_masuk_akunSearchField.getValue()!==null){kasbank_masuk_akun_search=kasbank_masuk_akunSearchField.getValue();}
		if(kasbank_masuk_terimauntukSearchField.getValue()!==null){kasbank_masuk_terimauntuk_search=kasbank_masuk_terimauntukSearchField.getValue();}
		if(kasbank_masuk_jenisSearchField.getValue()!==null){kasbank_masuk_jenis_search=kasbank_masuk_jenisSearchField.getValue();}
		if(kasbank_masuk_norefSearchField.getValue()!==null){kasbank_masuk_noref_search=kasbank_masuk_norefSearchField.getValue();}
		if(kasbank_masuk_keteranganSearchField.getValue()!==null){kasbank_masuk_keterangan_search=kasbank_masuk_keteranganSearchField.getValue();}
		if(kasbank_masuk_postSearchField.getValue()!==null){kasbank_masuk_post_search=kasbank_masuk_postSearchField.getValue();}
		if(kasbank_masuk_date_postSearchField.getValue()!==""){kasbank_masuk_date_post_search_date=kasbank_masuk_date_postSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		kasbank_masuk_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			kasbank_masuk_id			:	kasbank_masuk_id_search, 
			kasbank_masuk_tanggal		:	kasbank_masuk_tanggal_search_date, 
			kasbank_masuk_nobukti		:	kasbank_masuk_nobukti_search, 
			kasbank_masuk_akun		:	kasbank_masuk_akun_search, 
			kasbank_masuk_terimauntuk	:	kasbank_masuk_terimauntuk_search, 
			kasbank_masuk_jenis		:	kasbank_masuk_jenis_search, 
			kasbank_masuk_noref		:	kasbank_masuk_noref_search, 
			kasbank_masuk_keterangan	:	kasbank_masuk_keterangan_search, 
			kasbank_masuk_post		:	kasbank_masuk_post_search, 
			kasbank_masuk_date_post	:	kasbank_masuk_date_post_search_date
		};
		// Cause the datastore to do another query : 
		kasbank_masuk_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function kasbank_masuk_reset_search(){
		// reset the store parameters
		kasbank_masuk_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		kasbank_masuk_DataStore.reload({params: {start: 0, limit: pageS}});
		kasbank_masuk_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  kasbank_masuk_id Search Field */
	kasbank_masuk_idSearchField= new Ext.form.NumberField({
		id: 'kasbank_masuk_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  kasbank_masuk_tanggal Search Field */
	kasbank_masuk_tanggalSearchField= new Ext.form.DateField({
		id: 'kasbank_masuk_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d'
	
	});
	/* Identify  kasbank_masuk_nobukti Search Field */
	kasbank_masuk_nobuktiSearchField= new Ext.form.TextField({
		id: 'kasbank_masuk_nobuktiSearchField',
		fieldLabel: 'Nobukti',
		maxLength: 50,
		anchor: '50%'
	
	});
	/* Identify  kasbank_masuk_akun Search Field */
	kasbank_masuk_akunSearchField= new Ext.form.ComboBox({
		id: 'kasbank_masuk_akunSearchField',
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
	
	// kasbank_masuk_akunSearchField= new Ext.form.NumberField({
		// id: 'kasbank_masuk_akunSearchField',
		// fieldLabel: 'Kasbank Akun',
		// allowNegatife : false,
		// blankText: '0',
		// allowDecimals: false,
		// anchor: '95%',
		// maskRe: /([0-9]+)$/
	
	// });
	/* Identify  kasbank_masuk_terimauntuk Search Field */
	kasbank_masuk_terimauntukSearchField= new Ext.form.TextField({
		id: 'kasbank_masuk_terimauntukSearchField',
		fieldLabel: 'Terima Untuk',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  kasbank_masuk_jenis Search Field */
	kasbank_masuk_jenisSearchField= new Ext.form.ComboBox({
		id: 'kasbank_masuk_jenisSearchField',
		fieldLabel: 'Jenis',
		store:new Ext.data.SimpleStore({
			fields:['value', 'kasbank_masuk_jenis'],
			data:[['keluar','keluar'],['masuk','masuk']]
		}),
		mode: 'local',
		displayField: 'kasbank_masuk_jenis',
		valueField: 'value',
		anchor: '50%',
		triggerAction: 'all'	 
	
	});
	/* Identify  kasbank_masuk_noref Search Field */
	kasbank_masuk_norefSearchField= new Ext.form.TextField({
		id: 'kasbank_masuk_norefSearchField',
		fieldLabel: 'No Referensi',
		maxLength: 50,
		anchor: '50%'
	
	});
	/* Identify  kasbank_masuk_keterangan Search Field */
	kasbank_masuk_keteranganSearchField= new Ext.form.TextArea({
		id: 'kasbank_masuk_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  kasbank_masuk_post Search Field */
	kasbank_masuk_postSearchField= new Ext.form.ComboBox({
		id: 'kasbank_masuk_postSearchField',
		fieldLabel: 'Post',
		store:new Ext.data.SimpleStore({
			fields:['value', 'kasbank_masuk_post'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'kasbank_masuk_post',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  kasbank_masuk_date_post Search Field */
	kasbank_masuk_date_postSearchField= new Ext.form.DateField({
		id: 'kasbank_masuk_date_postSearchField',
		fieldLabel: 'Date Post',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	kasbank_masuk_searchForm = new Ext.FormPanel({
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
				items: [kasbank_masuk_tanggalSearchField, kasbank_masuk_nobuktiSearchField, kasbank_masuk_akunSearchField, kasbank_masuk_terimauntukSearchField, kasbank_masuk_jenisSearchField, kasbank_masuk_norefSearchField, kasbank_masuk_keteranganSearchField, ] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: kasbank_masuk_list_search
			},{
				text: 'Close',
				handler: function(){
					kasbank_masuk_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	kasbank_masuk_searchWindow = new Ext.Window({
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
		renderTo: 'elwindow_kasbank_masuk_search',
		items: kasbank_masuk_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!kasbank_masuk_searchWindow.isVisible()){
			kasbank_masuk_searchWindow.show();
		} else {
			kasbank_masuk_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function kasbank_masuk_print(){
		var searchquery = "";
		var kasbank_masuk_tanggal_print_date="";
		var kasbank_masuk_nobukti_print=null;
		var kasbank_masuk_akun_print=null;
		var kasbank_masuk_terimauntuk_print=null;
		var kasbank_masuk_jenis_print=null;
		var kasbank_masuk_noref_print=null;
		var kasbank_masuk_keterangan_print=null;
		var kasbank_masuk_post_print=null;
		var kasbank_masuk_date_post_print_date="";
		var win;              
		// check if we do have some search data...
		if(kasbank_masuk_DataStore.baseParams.query!==null){searchquery = kasbank_masuk_DataStore.baseParams.query;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_tanggal!==""){kasbank_masuk_tanggal_print_date = kasbank_masuk_DataStore.baseParams.kasbank_masuk_tanggal;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_nobukti!==null){kasbank_masuk_nobukti_print = kasbank_masuk_DataStore.baseParams.kasbank_masuk_nobukti;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_akun!==null){kasbank_masuk_akun_print = kasbank_masuk_DataStore.baseParams.kasbank_masuk_akun;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_terimauntuk!==null){kasbank_masuk_terimauntuk_print = kasbank_masuk_DataStore.baseParams.kasbank_masuk_terimauntuk;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_jenis!==null){kasbank_masuk_jenis_print = kasbank_masuk_DataStore.baseParams.kasbank_masuk_jenis;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_noref!==null){kasbank_masuk_noref_print = kasbank_masuk_DataStore.baseParams.kasbank_masuk_noref;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_keterangan!==null){kasbank_masuk_keterangan_print = kasbank_masuk_DataStore.baseParams.kasbank_masuk_keterangan;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_post!==null){kasbank_masuk_post_print = kasbank_masuk_DataStore.baseParams.kasbank_masuk_post;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_date_post!==""){kasbank_masuk_date_post_print_date = kasbank_masuk_DataStore.baseParams.kasbank_masuk_date_post;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_kasbank_masuk&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	kasbank_masuk_tanggal : kasbank_masuk_tanggal_print_date, 
			kasbank_masuk_nobukti : kasbank_masuk_nobukti_print,
			kasbank_masuk_akun : kasbank_masuk_akun_print,
			kasbank_masuk_terimauntuk : kasbank_masuk_terimauntuk_print,
			kasbank_masuk_jenis : kasbank_masuk_jenis_print,
			kasbank_masuk_noref : kasbank_masuk_noref_print,
			kasbank_masuk_keterangan : kasbank_masuk_keterangan_print,
			kasbank_masuk_post : kasbank_masuk_post_print,
		  	kasbank_masuk_date_post : kasbank_masuk_date_post_print_date, 
		  	currentlisting: kasbank_masuk_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/kasbank_masuk_printlist.html','kasbanklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function kasbank_masuk_export_excel(){
		var searchquery = "";
		var kasbank_masuk_tanggal_2excel_date="";
		var kasbank_masuk_nobukti_2excel=null;
		var kasbank_masuk_akun_2excel=null;
		var kasbank_masuk_terimauntuk_2excel=null;
		var kasbank_masuk_jenis_2excel=null;
		var kasbank_masuk_noref_2excel=null;
		var kasbank_masuk_keterangan_2excel=null;
		var kasbank_masuk_post_2excel=null;
		var kasbank_masuk_date_post_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(kasbank_masuk_DataStore.baseParams.query!==null){searchquery = kasbank_masuk_DataStore.baseParams.query;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_tanggal!==""){kasbank_masuk_tanggal_2excel_date = kasbank_masuk_DataStore.baseParams.kasbank_masuk_tanggal;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_nobukti!==null){kasbank_masuk_nobukti_2excel = kasbank_masuk_DataStore.baseParams.kasbank_masuk_nobukti;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_akun!==null){kasbank_masuk_akun_2excel = kasbank_masuk_DataStore.baseParams.kasbank_masuk_akun;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_terimauntuk!==null){kasbank_masuk_terimauntuk_2excel = kasbank_masuk_DataStore.baseParams.kasbank_masuk_terimauntuk;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_jenis!==null){kasbank_masuk_jenis_2excel = kasbank_masuk_DataStore.baseParams.kasbank_masuk_jenis;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_noref!==null){kasbank_masuk_noref_2excel = kasbank_masuk_DataStore.baseParams.kasbank_masuk_noref;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_keterangan!==null){kasbank_masuk_keterangan_2excel = kasbank_masuk_DataStore.baseParams.kasbank_masuk_keterangan;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_post!==null){kasbank_masuk_post_2excel = kasbank_masuk_DataStore.baseParams.kasbank_masuk_post;}
		if(kasbank_masuk_DataStore.baseParams.kasbank_masuk_date_post!==""){kasbank_masuk_date_post_2excel_date = kasbank_masuk_DataStore.baseParams.kasbank_masuk_date_post;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_kasbank_masuk&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	kasbank_masuk_tanggal : kasbank_masuk_tanggal_2excel_date, 
			kasbank_masuk_nobukti : kasbank_masuk_nobukti_2excel,
			kasbank_masuk_akun : kasbank_masuk_akun_2excel,
			kasbank_masuk_terimauntuk : kasbank_masuk_terimauntuk_2excel,
			kasbank_masuk_jenis : kasbank_masuk_jenis_2excel,
			kasbank_masuk_noref : kasbank_masuk_noref_2excel,
			kasbank_masuk_keterangan : kasbank_masuk_keterangan_2excel,
			kasbank_masuk_post : kasbank_masuk_post_2excel,
		  	kasbank_masuk_date_post : kasbank_masuk_date_post_2excel_date, 
		  	currentlisting: kasbank_masuk_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	function get_total_masuk_debet_kredit(){
		var jumlah_total_debet=0;
		var jumlah_total_masuk_kredit=0;
		for(i=0;i<kasbank_masuk_detail_DataStore.getCount();i++){
			record_data=kasbank_masuk_detail_DataStore.getAt(i);
			jumlah_total_debet+=record_data.data.dkasbank_masuk_debet;
			jumlah_total_masuk_kredit+=record_data.data.dkasbank_masuk_kredit;
		}
		total_debet.setValue(jumlah_total_debet);
		total_masuk_kredit.setValue(jumlah_total_masuk_kredit);
	}
	
	kasbank_masuk_detail_DataStore.on("update",function(){
		kasbank_masuk_detail_DataStore.commitChanges();
		get_total_masuk_debet_kredit();
	});
	/*End of Function */
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_kasbank_masuk"></div>
        <div id="fp_kasbank_masuk_detail"></div>
		<div id="elwindow_kasbank_masuk_save"></div>
        <div id="elwindow_kasbank_masuk_search"></div>
    </div>
</div>
</body>
</html>