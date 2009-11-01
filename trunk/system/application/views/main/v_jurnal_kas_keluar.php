<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_kas_keluar View
	+ Description	: For record view
	+ Filename 		: v_jurnal_kas_keluar.php
 	+ Author  		: 
 	+ Created on 03/Oct/2009 13:09:57
	
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
var jurnal_kas_keluar_DataStore;
var jurnal_kas_keluar_ColumnModel;
var jurnal_kas_keluarListEditorGrid;
var jurnal_kas_keluar_createForm;
var jurnal_kas_keluar_createWindow;
var jurnal_kas_keluar_searchForm;
var jurnal_kas_keluar_searchWindow;
var jurnal_kas_keluar_SelectedRow;
var jurnal_kas_keluar_ContextMenu;
//for detail data
var jurnal_kas_keluar_detail_DataStor;
var jurnal_kas_keluar_detailListEditorGrid;
var jurnal_kas_keluar_detail_ColumnModel;
var jurnal_kas_keluar_detail_proxy;
var jurnal_kas_keluar_detail_writer;
var jurnal_kas_keluar_detail_reader;
var editor_jurnal_kas_keluar_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var jkkas_idField;
var jkkas_akunField;
var jkkas_tanggalField;
var jkkas_keteranganField;
var jkkas_nilaiField;
var jkkas_pemakaiField;
var jkkas_refField;
var jkkas_postingField;
var jkkas_tglpostingField;
var jkkas_idSearchField;
var jkkas_akunSearchField;
var jkkas_tanggalSearchField;
var jkkas_keteranganSearchField;
var jkkas_nilaiSearchField;
var jkkas_pemakaiSearchField;
var jkkas_refSearchField;
var jkkas_postingSearchField;
var jkkas_tglpostingSearchField;

var dt = new Date();

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jurnal_kas_keluar_update(oGrid_event){
		var jkkas_id_update_pk="";
		var jkkas_akun_update=null;
		var jkkas_tanggal_update_date="";
		var jkkas_keterangan_update=null;
		var jkkas_nilai_update=null;
		var jkkas_pemakai_update=null;
		var jkkas_ref_update=null;
		var jkkas_posting_update=null;
		var jkkas_tglposting_update_date="";

		jkkas_id_update_pk = oGrid_event.record.data.jkkas_id;
		if(oGrid_event.record.data.jkkas_akun!== null){jkkas_akun_update = oGrid_event.record.data.jkkas_akun;}
	 	if(oGrid_event.record.data.jkkas_tanggal!== ""){jkkas_tanggal_update_date =oGrid_event.record.data.jkkas_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jkkas_keterangan!== null){jkkas_keterangan_update = oGrid_event.record.data.jkkas_keterangan;}
		if(oGrid_event.record.data.jkkas_nilai!== null){jkkas_nilai_update = oGrid_event.record.data.jkkas_nilai;}
		if(oGrid_event.record.data.jkkas_pemakai!== null){jkkas_pemakai_update = oGrid_event.record.data.jkkas_pemakai;}
		if(oGrid_event.record.data.jkkas_ref!== null){jkkas_ref_update = oGrid_event.record.data.jkkas_ref;}
		if(oGrid_event.record.data.jkkas_posting!== null){jkkas_posting_update = oGrid_event.record.data.jkkas_posting;}
	 	if(oGrid_event.record.data.jkkas_tglposting!== ""){jkkas_tglposting_update_date =oGrid_event.record.data.jkkas_tglposting.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_kas_keluar&m=get_action',
			params: {
				task: "UPDATE",
				jkkas_id	: jkkas_id_update_pk, 
				jkkas_akun	:jkkas_akun_update,  
				jkkas_tanggal	: jkkas_tanggal_update_date, 
				jkkas_keterangan	:jkkas_keterangan_update,  
				jkkas_nilai	:jkkas_nilai_update,  
				jkkas_pemakai	:jkkas_pemakai_update,  
				jkkas_ref	:jkkas_ref_update,  
				jkkas_posting	:jkkas_posting_update,  
				jkkas_tglposting	: jkkas_tglposting_update_date, 
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jurnal_kas_keluar_DataStore.commitChanges();
						jurnal_kas_keluar_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the jurnal_kas_keluar.',
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
	function jurnal_kas_keluar_create(){
		if(jkkas_dtotal_nilaiField.getValue()==jkkas_nilaiField.getValue()){
			if(is_jurnal_kas_keluar_form_valid()){	
			var jkkas_id_create_pk=null; 
			var jkkas_akun_create=null; 
			var jkkas_tanggal_create_date=""; 
			var jkkas_keterangan_create=null; 
			var jkkas_nilai_create=null; 
			var jkkas_pemakai_create=null; 
			var jkkas_ref_create=null; 
			var jkkas_posting_create=null; 
			var jkkas_tglposting_create_date=""; 
	
			if(jkkas_idField.getValue()!== null){jkkas_id_create_pk = jkkas_idField.getValue();}else{jkkas_id_create_pk=get_pk_id();} 
			if(jkkas_akunField.getValue()!== null){jkkas_akun_create = jkkas_akunField.getValue();} 
			if(jkkas_tanggalField.getValue()!== ""){jkkas_tanggal_create_date = jkkas_tanggalField.getValue().format('Y-m-d');} 
			if(jkkas_keteranganField.getValue()!== null){jkkas_keterangan_create = jkkas_keteranganField.getValue();} 
			if(jkkas_nilaiField.getValue()!== null){jkkas_nilai_create = jkkas_nilaiField.getValue();} 
			if(jkkas_pemakaiField.getValue()!== null){jkkas_pemakai_create = jkkas_pemakaiField.getValue();} 
			if(jkkas_refField.getValue()!== null){jkkas_ref_create = jkkas_refField.getValue();} 
			if(jkkas_postingField.getValue()!== null){jkkas_posting_create = jkkas_postingField.getValue();} 
			if(jkkas_tglpostingField.getValue()!== ""){jkkas_tglposting_create_date = jkkas_tglpostingField.getValue().format('Y-m-d');} 
	
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_kas_keluar&m=get_action',
				params: {
					task: post2db,
					jkkas_id	: jkkas_id_create_pk, 
					jkkas_akun	: jkkas_akun_create, 
					jkkas_tanggal	: jkkas_tanggal_create_date, 
					jkkas_keterangan	: jkkas_keterangan_create, 
					jkkas_nilai	: jkkas_nilai_create, 
					jkkas_pemakai	: jkkas_pemakai_create, 
					jkkas_ref	: jkkas_ref_create, 
					jkkas_posting	: jkkas_posting_create, 
					jkkas_tglposting	: jkkas_tglposting_create_date, 
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							jurnal_kas_keluar_detail_purge()
							jurnal_kas_keluar_detail_insert();
							Ext.MessageBox.alert(post2db+' OK','The Jurnal_kas_keluar was '+msg+' successfully.');
							jurnal_kas_keluar_DataStore.reload();
							jurnal_kas_keluar_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Jurnal_kas_keluar.',
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
		} else{
			Ext.MessageBox.show({
			   title: 'Warning',
			   minWidth: 315,
			   msg: 'Detail Total Nilai harus = Master Nilai.',
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
			return jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jurnal_kas_keluar_reset_form(){
		jkkas_idField.reset();
		jkkas_idField.setValue(null);
		jkkas_akunField.reset();
		jkkas_akunField.setValue(null);
		jkkas_tanggalField.reset();
		jkkas_tanggalField.setValue(null);
		jkkas_keteranganField.reset();
		jkkas_keteranganField.setValue(null);
		jkkas_nilaiField.reset();
		jkkas_nilaiField.setValue(null);
		jkkas_pemakaiField.reset();
		jkkas_pemakaiField.setValue(null);
		jkkas_refField.reset();
		jkkas_refField.setValue(null);
		jkkas_postingField.reset();
		jkkas_postingField.setValue(null);
		jkkas_tglpostingField.reset();
		jkkas_tglpostingField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jurnal_kas_keluar_set_form(){
		jkkas_idField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_id'));
		jkkas_akunField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_akun'));
		jkkas_tanggalField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_tanggal'));
		jkkas_keteranganField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_keterangan'));
		jkkas_nilaiField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_nilai'));
		jkkas_pemakaiField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_pemakai'));
		jkkas_refField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_ref'));
		jkkas_postingField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_posting'));
		jkkas_tglpostingField.setValue(jurnal_kas_keluarListEditorGrid.getSelectionModel().getSelected().get('jkkas_tglposting'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jurnal_kas_keluar_form_valid(){
		return (true &&  jkkas_akunField.isValid() && true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jurnal_kas_keluar_createWindow.isVisible()){
			jurnal_kas_keluar_reset_form();
			post2db='CREATE';
			msg='created';
			jkkas_tanggalField.setValue(dt);
			jurnal_kas_keluar_createWindow.show();
		} else {
			jurnal_kas_keluar_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jurnal_kas_keluar_confirm_delete(){
		// only one jurnal_kas_keluar is selected here
		if(jurnal_kas_keluarListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_kas_keluar_delete);
		} else if(jurnal_kas_keluarListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_kas_keluar_delete);
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
	function jurnal_kas_keluar_confirm_update(){
		/* only one record is selected here */
		if(jurnal_kas_keluarListEditorGrid.selModel.getCount() == 1) {
			jurnal_kas_keluar_set_form();
			post2db='UPDATE';
			jurnal_kas_keluar_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			jurnal_kas_keluar_createWindow.show();
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
	function jurnal_kas_keluar_delete(btn){
		if(btn=='yes'){
			var selections = jurnal_kas_keluarListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jurnal_kas_keluarListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jkkas_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jurnal_kas_keluar&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jurnal_kas_keluar_DataStore.reload();
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
	jurnal_kas_keluar_DataStore = new Ext.data.Store({
		id: 'jurnal_kas_keluar_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_kas_keluar&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jkkas_id'
		},[
		/* dataIndex => insert intojurnal_kas_keluar_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jkkas_id', type: 'int', mapping: 'jkkas_id'}, 
			{name: 'jkkas_akun', type: 'int', mapping: 'jkkas_akun'}, 
			{name: 'jkkas_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jkkas_tanggal'}, 
			{name: 'jkkas_keterangan', type: 'string', mapping: 'jkkas_keterangan'}, 
			{name: 'jkkas_nilai', type: 'float', mapping: 'jkkas_nilai'}, 
			{name: 'jkkas_pemakai', type: 'string', mapping: 'jkkas_pemakai'}, 
			{name: 'jkkas_ref', type: 'int', mapping: 'jkkas_ref'}, 
			{name: 'jkkas_posting', type: 'string', mapping: 'jkkas_posting'}, 
			{name: 'jkkas_tglposting', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jkkas_tglposting'}, 
			{name: 'jkkas_creator', type: 'string', mapping: 'jkkas_creator'}, 
			{name: 'jkkas_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'jkkas_date_create'}, 
			{name: 'jkkas_update', type: 'string', mapping: 'jkkas_update'}, 
			{name: 'jkkas_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'jkkas_date_update'}, 
			{name: 'jkkas_revised', type: 'int', mapping: 'jkkas_revised'} 
		]),
		sortInfo:{field: 'jkkas_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* GET detail akun */
	cbo_jkkas_akunDataStore = new Ext.data.Store({
		id: 'cbo_jkkas_akunDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_kas_keluar&m=get_akun_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: 10}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jkkas_akun_value', type: 'int', mapping: 'akun_id'},
			{name: 'jkkas_akun_nama', type: 'string', mapping: 'akun_nama'},
			{name: 'jkkas_akun_kode', type: 'string', mapping: 'akun_kode'}
		]),
		sortInfo:{field: 'jkkas_akun_nama', direction: "ASC"}
	});
	/* END akun datasource */
	cbo_jkkas_akunDataStore.load();
	var jkkas_akun_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{jkkas_akun_nama}</b><br /></span>',
            'Kode Akun: {jkkas_akun_kode}',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	jurnal_kas_keluar_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jkkas_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Akun',
			dataIndex: 'jkkas_akun',
			width: 150,
			sortable: true,
			editable: false
//			editor: new Ext.form.NumberField({
//				allowBlank: false,
//				allowDecimals: false,
//				allowNegative: false,
//				blankText: '0',
//				maxLength: 11,
//				maskRe: /([0-9]+)$/
//			})
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'jkkas_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editable: false
//			editor: new Ext.form.DateField({
//				format: 'Y-m-d'
//			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'jkkas_keterangan',
			width: 150,
			sortable: true,
			editable: false
//			editor: new Ext.form.TextField({
//				maxLength: 250
//          	})
		}, 
		{
			header: 'Nilai',
			dataIndex: 'jkkas_nilai',
			width: 150,
			sortable: true,
			editable: false
//			editor: new Ext.form.NumberField({
//				allowDecimals: true,
//				allowNegative: false,
//				blankText: '0',
//				maxLength: 22,
//				maskRe: /([0-9]+)$/
//			})
		}, 
		{
			header: 'Pemakai',
			dataIndex: 'jkkas_pemakai',
			width: 150,
			sortable: true,
			editable: false
//			editor: new Ext.form.TextField({
//				maxLength: 255
//          	})
		}, 
		{
			header: 'Ref',
			dataIndex: 'jkkas_ref',
			width: 150,
			sortable: true,
			editable: false
//			editor: new Ext.form.NumberField({
//				allowDecimals: false,
//				allowNegative: false,
//				blankText: '0',
//				maxLength: 11,
//				maskRe: /([0-9]+)$/
//			})
		}, 
		{
			header: 'Posting',
			dataIndex: 'jkkas_posting',
			width: 150,
			sortable: true,
			editable: false
//			editor: new Ext.form.ComboBox({
//				typeAhead: true,
//				triggerAction: 'all',
//				store:new Ext.data.SimpleStore({
//					fields:['jkkas_posting_value', 'jkkas_posting_display'],
//					data: [['T','T'],['Y','Y']]
//					}),
//				mode: 'local',
//               	displayField: 'jkkas_posting_display',
//               	valueField: 'jkkas_posting_value',
//               	lazyRender:true,
//               	listClass: 'x-combo-list-small'
//            })
		}, 
		{
			header: 'Tglposting',
			dataIndex: 'jkkas_tglposting',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editable: false
//			editor: new Ext.form.DateField({
//				format: 'Y-m-d'
//			})
		}, 
		{
			header: 'Creator',
			dataIndex: 'jkkas_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jkkas_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jkkas_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jkkas_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jkkas_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	jurnal_kas_keluar_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	jurnal_kas_keluarListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_kas_keluarListEditorGrid',
		el: 'fp_jurnal_kas_keluar',
		title: 'List Of Jurnal_kas_keluar',
		autoHeight: true,
		store: jurnal_kas_keluar_DataStore, // DataStore
		cm: jurnal_kas_keluar_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_kas_keluar_DataStore,
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
			handler: jurnal_kas_keluar_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jurnal_kas_keluar_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jurnal_kas_keluar_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jurnal_kas_keluar_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_kas_keluar_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_kas_keluar_print  
		}
		]
	});
	jurnal_kas_keluarListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jurnal_kas_keluar_ContextMenu = new Ext.menu.Menu({
		id: 'jurnal_kas_keluar_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jurnal_kas_keluar_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jurnal_kas_keluar_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_kas_keluar_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_kas_keluar_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjurnal_kas_keluar_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jurnal_kas_keluar_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jurnal_kas_keluar_SelectedRow=rowIndex;
		jurnal_kas_keluar_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jurnal_kas_keluar_editContextMenu(){
		jurnal_kas_keluarListEditorGrid.startEditing(jurnal_kas_keluar_SelectedRow,1);
  	}
	/* End of Function */
  	
	jurnal_kas_keluarListEditorGrid.addListener('rowcontextmenu', onjurnal_kas_keluar_ListEditGridContextMenu);
	jurnal_kas_keluar_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	jurnal_kas_keluarListEditorGrid.on('afteredit', jurnal_kas_keluar_update); // inLine Editing Record
	
	/* Identify  jkkas_id Field */
	jkkas_idField= new Ext.form.NumberField({
		id: 'jkkas_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jkkas_akun Field */
	jkkas_akunField= new Ext.form.ComboBox({
		id: 'jkkas_akunField',
		fieldLabel: 'Akun',
		store: cbo_jkkas_akunDataStore,
		displayField:'jkkas_akun_nama',
		mode : 'remote',
		valueField: 'jkkas_akun_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: jkkas_akun_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '50%'
	});
	/* Identify  jkkas_tanggal Field */
	jkkas_tanggalField= new Ext.form.DateField({
		id: 'jkkas_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		disabled: true
	});
	/* Identify  jkkas_keterangan Field */
	jkkas_keteranganField= new Ext.form.TextArea({
		id: 'jkkas_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  jkkas_nilai Field */
	jkkas_nilaiField= new Ext.form.NumberField({
		id: 'jkkas_nilaiField',
		fieldLabel: 'Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jkkas_pemakai Field */
	jkkas_pemakaiField= new Ext.form.TextField({
		id: 'jkkas_pemakaiField',
		fieldLabel: 'Pemakai',
		maxLength: 255,
		anchor: '95%'
	});
	/* Identify  jkkas_ref Field */
	jkkas_refField= new Ext.form.NumberField({
		id: 'jkkas_refField',
		fieldLabel: 'Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jkkas_posting Field */
	jkkas_postingField= new Ext.form.ComboBox({
		id: 'jkkas_postingField',
		fieldLabel: 'Posting',
		store:new Ext.data.SimpleStore({
			fields:['jkkas_posting_value', 'jkkas_posting_display'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jkkas_posting_display',
		valueField: 'jkkas_posting_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jkkas_tglposting Field */
	jkkas_tglpostingField= new Ext.form.DateField({
		id: 'jkkas_tglpostingField',
		fieldLabel: 'Tglposting',
		format : 'Y-m-d',
	});
	jkkas_dtotal_nilaiField= new Ext.form.NumberField({
		id: 'jkkas_dtotal_nilaiField',
		fieldLabel: 'Detail Total Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
  	/*Fieldset Master*/
	jurnal_kas_keluar_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jkkas_tanggalField, jkkas_akunField, jkkas_keteranganField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jkkas_nilaiField, jkkas_pemakaiField, jkkas_refField, jkkas_idField] 
			}
			]
	
	});
	
	jurnal_kkas_dtotal_nilaiGroup = new Ext.form.FieldSet({
		title: '-',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '50%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jkkas_dtotal_nilaiField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var jurnal_kas_keluar_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'djkkas_id', type: 'int', mapping: 'djkkas_id'}, 
			{name: 'djkkas_master', type: 'int', mapping: 'djkkas_master'}, 
			{name: 'djkkas_akun', type: 'int', mapping: 'djkkas_akun'}, 
			{name: 'djkkas_keterangan', type: 'string', mapping: 'djkkas_keterangan'}, 
			{name: 'djkkas_nilai', type: 'float', mapping: 'djkkas_nilai'} 
	]);
	//eof
	
	//function for json writer of detail
	var jurnal_kas_keluar_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	jurnal_kas_keluar_detail_DataStore = new Ext.data.Store({
		id: 'jurnal_kas_keluar_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_kas_keluar&m=detail_jurnal_kas_keluar_detail_list', 
			method: 'POST'
		}),
		reader: jurnal_kas_keluar_detail_reader,
		baseParams:{master_id: jkkas_idField.getValue()},
		sortInfo:{field: 'djkkas_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_jurnal_kas_keluar_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_djkkas_akun=new Ext.form.ComboBox({
			store: cbo_jkkas_akunDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'jkkas_akun_nama',
			valueField: 'jkkas_akun_value',
			triggerAction: 'all',
			lazyRender:true

	});
	
	//declaration of detail coloumn model
	jurnal_kas_keluar_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Akun',
			dataIndex: 'djkkas_akun',
			width: 150,
			sortable: true,
			editor: combo_djkkas_akun,
			renderer: Ext.util.Format.comboRenderer(combo_djkkas_akun)
		},
		{
			header: 'Keterangan',
			dataIndex: 'djkkas_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Nilai',
			dataIndex: 'djkkas_nilai',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	jurnal_kas_keluar_detail_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	jurnal_kas_keluar_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_kas_keluar_detailListEditorGrid',
		el: 'fp_jurnal_kas_keluar_detail',
		title: 'Detail jurnal_kas_keluar_detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: jurnal_kas_keluar_detail_DataStore, // DataStore
		colModel: jurnal_kas_keluar_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_jurnal_kas_keluar_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_kas_keluar_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: jurnal_kas_keluar_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: jurnal_kas_keluar_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function jurnal_kas_keluar_detail_add(){
		var edit_jurnal_kas_keluar_detail= new jurnal_kas_keluar_detailListEditorGrid.store.recordType({
			djkkas_id	:'',		
			djkkas_master	:'',		
			djkkas_akun	:'',		
			djkkas_keterangan	:'',		
			djkkas_nilai	:''		
		});
		editor_jurnal_kas_keluar_detail.stopEditing();
		jurnal_kas_keluar_detail_DataStore.insert(0, edit_jurnal_kas_keluar_detail);
		jurnal_kas_keluar_detailListEditorGrid.getView().refresh();
		jurnal_kas_keluar_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_jurnal_kas_keluar_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_jurnal_kas_keluar_detail(){
		jurnal_kas_keluar_detail_DataStore.commitChanges();
		jurnal_kas_keluar_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function jurnal_kas_keluar_detail_insert(){
		for(i=0;i<jurnal_kas_keluar_detail_DataStore.getCount();i++){
			jurnal_kas_keluar_detail_record=jurnal_kas_keluar_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_kas_keluar&m=detail_jurnal_kas_keluar_detail_insert',
				params:{
				djkkas_id	: jurnal_kas_keluar_detail_record.data.djkkas_id, 
				djkkas_master	: eval(jkkas_idField.getValue()), 
				djkkas_akun	: jurnal_kas_keluar_detail_record.data.djkkas_akun, 
				djkkas_keterangan	: jurnal_kas_keluar_detail_record.data.djkkas_keterangan, 
				djkkas_nilai	: jurnal_kas_keluar_detail_record.data.djkkas_nilai 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function jurnal_kas_keluar_detail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_kas_keluar&m=detail_jurnal_kas_keluar_detail_purge',
			params:{ master_id: eval(jkkas_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function jurnal_kas_keluar_detail_confirm_delete(){
		// only one record is selected here
		if(jurnal_kas_keluar_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_kas_keluar_detail_delete);
		} else if(jurnal_kas_keluar_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_kas_keluar_detail_delete);
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
	function jurnal_kas_keluar_detail_delete(btn){
		if(btn=='yes'){
			var s = jurnal_kas_keluar_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				jurnal_kas_keluar_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	jurnal_kas_keluar_detail_DataStore.on('update', refresh_jurnal_kas_keluar_detail);
	
	/* Function for retrieve create Window Panel*/ 
	jurnal_kas_keluar_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [jurnal_kas_keluar_masterGroup,jurnal_kas_keluar_detailListEditorGrid,jurnal_kkas_dtotal_nilaiGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: jurnal_kas_keluar_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					jurnal_kas_keluar_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jurnal_kas_keluar_createWindow= new Ext.Window({
		id: 'jurnal_kas_keluar_createWindow',
		title: post2db+'Jurnal_kas_keluar',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jurnal_kas_keluar_create',
		items: jurnal_kas_keluar_createForm
	});
	/* End Window */
	
	function detail_jkkas_dtotalnilai(){
		var total_nilai=0;
		for(i=0;i<jurnal_kas_keluar_detail_DataStore.getCount();i++){
			detail_jkkas_record=jurnal_kas_keluar_detail_DataStore.getAt(i);
			total_nilai=total_nilai+detail_jkkas_record.data.djkkas_nilai;
		}
		jkkas_dtotal_nilaiField.setValue(total_nilai);
	}
	
	jurnal_kas_keluar_detail_DataStore.on('update',detail_jkkas_dtotalnilai);
	jurnal_kas_keluar_detail_DataStore.on('load',detail_jkkas_dtotalnilai);
	
	/* Function for action list search */
	function jurnal_kas_keluar_list_search(){
		// render according to a SQL date format.
		var jkkas_id_search=null;
		var jkkas_akun_search=null;
		var jkkas_tanggal_search_date="";
		var jkkas_keterangan_search=null;
		var jkkas_nilai_search=null;
		var jkkas_pemakai_search=null;
		var jkkas_ref_search=null;
		var jkkas_posting_search=null;
		var jkkas_tglposting_search_date="";

		if(jkkas_idSearchField.getValue()!==null){jkkas_id_search=jkkas_idSearchField.getValue();}
		if(jkkas_akunSearchField.getValue()!==null){jkkas_akun_search=jkkas_akunSearchField.getValue();}
		if(jkkas_tanggalSearchField.getValue()!==""){jkkas_tanggal_search_date=jkkas_tanggalSearchField.getValue().format('Y-m-d');}
		if(jkkas_keteranganSearchField.getValue()!==null){jkkas_keterangan_search=jkkas_keteranganSearchField.getValue();}
		if(jkkas_nilaiSearchField.getValue()!==null){jkkas_nilai_search=jkkas_nilaiSearchField.getValue();}
		if(jkkas_pemakaiSearchField.getValue()!==null){jkkas_pemakai_search=jkkas_pemakaiSearchField.getValue();}
		if(jkkas_refSearchField.getValue()!==null){jkkas_ref_search=jkkas_refSearchField.getValue();}
		if(jkkas_postingSearchField.getValue()!==null){jkkas_posting_search=jkkas_postingSearchField.getValue();}
		if(jkkas_tglpostingSearchField.getValue()!==""){jkkas_tglposting_search_date=jkkas_tglpostingSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		jurnal_kas_keluar_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jkkas_id	:	jkkas_id_search, 
			jkkas_akun	:	jkkas_akun_search, 
			jkkas_tanggal	:	jkkas_tanggal_search_date, 
			jkkas_keterangan	:	jkkas_keterangan_search, 
			jkkas_nilai	:	jkkas_nilai_search, 
			jkkas_pemakai	:	jkkas_pemakai_search, 
			jkkas_ref	:	jkkas_ref_search, 
			jkkas_posting	:	jkkas_posting_search, 
			jkkas_tglposting	:	jkkas_tglposting_search_date, 
		};
		// Cause the datastore to do another query : 
		jurnal_kas_keluar_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jurnal_kas_keluar_reset_search(){
		// reset the store parameters
		jurnal_kas_keluar_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jurnal_kas_keluar_DataStore.reload({params: {start: 0, limit: pageS}});
		jurnal_kas_keluar_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  jkkas_id Search Field */
	jkkas_idSearchField= new Ext.form.NumberField({
		id: 'jkkas_idSearchField',
		fieldLabel: 'Jkkas Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jkkas_akun Search Field */
	jkkas_akunSearchField= new Ext.form.NumberField({
		id: 'jkkas_akunSearchField',
		fieldLabel: 'Jkkas Akun',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jkkas_tanggal Search Field */
	jkkas_tanggalSearchField= new Ext.form.DateField({
		id: 'jkkas_tanggalSearchField',
		fieldLabel: 'Jkkas Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jkkas_keterangan Search Field */
	jkkas_keteranganSearchField= new Ext.form.TextField({
		id: 'jkkas_keteranganSearchField',
		fieldLabel: 'Jkkas Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  jkkas_nilai Search Field */
	jkkas_nilaiSearchField= new Ext.form.NumberField({
		id: 'jkkas_nilaiSearchField',
		fieldLabel: 'Jkkas Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jkkas_pemakai Search Field */
	jkkas_pemakaiSearchField= new Ext.form.TextField({
		id: 'jkkas_pemakaiSearchField',
		fieldLabel: 'Jkkas Pemakai',
		maxLength: 255,
		anchor: '95%'
	
	});
	/* Identify  jkkas_ref Search Field */
	jkkas_refSearchField= new Ext.form.NumberField({
		id: 'jkkas_refSearchField',
		fieldLabel: 'Jkkas Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jkkas_posting Search Field */
	jkkas_postingSearchField= new Ext.form.ComboBox({
		id: 'jkkas_postingSearchField',
		fieldLabel: 'Jkkas Posting',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jkkas_posting'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jkkas_posting',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jkkas_tglposting Search Field */
	jkkas_tglpostingSearchField= new Ext.form.DateField({
		id: 'jkkas_tglpostingSearchField',
		fieldLabel: 'Jkkas Tglposting',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	jurnal_kas_keluar_searchForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 300,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [jkkas_akunSearchField, jkkas_tanggalSearchField, jkkas_keteranganSearchField, jkkas_nilaiSearchField, jkkas_pemakaiSearchField, jkkas_refSearchField, jkkas_postingSearchField, jkkas_tglpostingSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jurnal_kas_keluar_list_search
			},{
				text: 'Close',
				handler: function(){
					jurnal_kas_keluar_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	jurnal_kas_keluar_searchWindow = new Ext.Window({
		title: 'jurnal_kas_keluar Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jurnal_kas_keluar_search',
		items: jurnal_kas_keluar_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jurnal_kas_keluar_searchWindow.isVisible()){
			jurnal_kas_keluar_searchWindow.show();
		} else {
			jurnal_kas_keluar_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jurnal_kas_keluar_print(){
		var searchquery = "";
		var jkkas_akun_print=null;
		var jkkas_tanggal_print_date="";
		var jkkas_keterangan_print=null;
		var jkkas_nilai_print=null;
		var jkkas_pemakai_print=null;
		var jkkas_ref_print=null;
		var jkkas_posting_print=null;
		var jkkas_tglposting_print_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_kas_keluar_DataStore.baseParams.query!==null){searchquery = jurnal_kas_keluar_DataStore.baseParams.query;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_akun!==null){jkkas_akun_print = jurnal_kas_keluar_DataStore.baseParams.jkkas_akun;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_tanggal!==""){jkkas_tanggal_print_date = jurnal_kas_keluar_DataStore.baseParams.jkkas_tanggal;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_keterangan!==null){jkkas_keterangan_print = jurnal_kas_keluar_DataStore.baseParams.jkkas_keterangan;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_nilai!==null){jkkas_nilai_print = jurnal_kas_keluar_DataStore.baseParams.jkkas_nilai;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_pemakai!==null){jkkas_pemakai_print = jurnal_kas_keluar_DataStore.baseParams.jkkas_pemakai;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_ref!==null){jkkas_ref_print = jurnal_kas_keluar_DataStore.baseParams.jkkas_ref;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_posting!==null){jkkas_posting_print = jurnal_kas_keluar_DataStore.baseParams.jkkas_posting;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_tglposting!==""){jkkas_tglposting_print_date = jurnal_kas_keluar_DataStore.baseParams.jkkas_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_kas_keluar&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jkkas_akun : jkkas_akun_print,
		  	jkkas_tanggal : jkkas_tanggal_print_date, 
			jkkas_keterangan : jkkas_keterangan_print,
			jkkas_nilai : jkkas_nilai_print,
			jkkas_pemakai : jkkas_pemakai_print,
			jkkas_ref : jkkas_ref_print,
			jkkas_posting : jkkas_posting_print,
		  	jkkas_tglposting : jkkas_tglposting_print_date, 
		  	currentlisting: jurnal_kas_keluar_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./jurnal_kas_keluarlist.html','jurnal_kas_keluarlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jurnal_kas_keluar_export_excel(){
		var searchquery = "";
		var jkkas_akun_2excel=null;
		var jkkas_tanggal_2excel_date="";
		var jkkas_keterangan_2excel=null;
		var jkkas_nilai_2excel=null;
		var jkkas_pemakai_2excel=null;
		var jkkas_ref_2excel=null;
		var jkkas_posting_2excel=null;
		var jkkas_tglposting_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_kas_keluar_DataStore.baseParams.query!==null){searchquery = jurnal_kas_keluar_DataStore.baseParams.query;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_akun!==null){jkkas_akun_2excel = jurnal_kas_keluar_DataStore.baseParams.jkkas_akun;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_tanggal!==""){jkkas_tanggal_2excel_date = jurnal_kas_keluar_DataStore.baseParams.jkkas_tanggal;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_keterangan!==null){jkkas_keterangan_2excel = jurnal_kas_keluar_DataStore.baseParams.jkkas_keterangan;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_nilai!==null){jkkas_nilai_2excel = jurnal_kas_keluar_DataStore.baseParams.jkkas_nilai;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_pemakai!==null){jkkas_pemakai_2excel = jurnal_kas_keluar_DataStore.baseParams.jkkas_pemakai;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_ref!==null){jkkas_ref_2excel = jurnal_kas_keluar_DataStore.baseParams.jkkas_ref;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_posting!==null){jkkas_posting_2excel = jurnal_kas_keluar_DataStore.baseParams.jkkas_posting;}
		if(jurnal_kas_keluar_DataStore.baseParams.jkkas_tglposting!==""){jkkas_tglposting_2excel_date = jurnal_kas_keluar_DataStore.baseParams.jkkas_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_kas_keluar&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jkkas_akun : jkkas_akun_2excel,
		  	jkkas_tanggal : jkkas_tanggal_2excel_date, 
			jkkas_keterangan : jkkas_keterangan_2excel,
			jkkas_nilai : jkkas_nilai_2excel,
			jkkas_pemakai : jkkas_pemakai_2excel,
			jkkas_ref : jkkas_ref_2excel,
			jkkas_posting : jkkas_posting_2excel,
		  	jkkas_tglposting : jkkas_tglposting_2excel_date, 
		  	currentlisting: jurnal_kas_keluar_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_jurnal_kas_keluar"></div>
         <div id="fp_jurnal_kas_keluar_detail"></div>
		<div id="elwindow_jurnal_kas_keluar_create"></div>
        <div id="elwindow_jurnal_kas_keluar_search"></div>
    </div>
</div>
</body>