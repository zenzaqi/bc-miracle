<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_jual View
	+ Description	: For record view
	+ Filename 		: v_jurnal_jual.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:22:58
	
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
var jurnal_jual_DataStore;
var jurnal_jual_ColumnModel;
var jurnal_jualListEditorGrid;
var jurnal_jual_createForm;
var jurnal_jual_createWindow;
var jurnal_jual_searchForm;
var jurnal_jual_searchWindow;
var jurnal_jual_SelectedRow;
var jurnal_jual_ContextMenu;
//for detail data
var jurnal_jual_detail_DataStor;
var jurnal_jual_detailListEditorGrid;
var jurnal_jual_detail_ColumnModel;
var jurnal_jual_detail_proxy;
var jurnal_jual_detail_writer;
var jurnal_jual_detail_reader;
var editor_jurnal_jual_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var jjual_idField;
var jjual_akunField;
var jjual_tanggalField;
var jjual_keteranganField;
var jjual_nilaiField;
var jjual_refField;
var jjual_penerimaField;
var jjual_postingField;
var jjual_tglpostingField;
var jjual_idSearchField;
var jjual_akunSearchField;
var jjual_tanggalSearchField;
var jjual_keteranganSearchField;
var jjual_nilaiSearchField;
var jjual_refSearchField;
var jjual_penerimaSearchField;
var jjual_postingSearchField;
var jjual_tglpostingSearchField;
var dt = new Date();

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jurnal_jual_update(oGrid_event){
		var jjual_id_update_pk="";
		var jjual_akun_update=null;
		var jjual_tanggal_update_date="";
		var jjual_keterangan_update=null;
		var jjual_nilai_update=null;
		var jjual_ref_update=null;
		var jjual_penerima_update=null;
		var jjual_posting_update=null;
		var jjual_tglposting_update_date="";

		jjual_id_update_pk = oGrid_event.record.data.jjual_id;
		if(oGrid_event.record.data.jjual_akun!== null){jjual_akun_update = oGrid_event.record.data.jjual_akun;}
	 	if(oGrid_event.record.data.jjual_tanggal!== ""){jjual_tanggal_update_date =oGrid_event.record.data.jjual_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jjual_keterangan!== null){jjual_keterangan_update = oGrid_event.record.data.jjual_keterangan;}
		if(oGrid_event.record.data.jjual_nilai!== null){jjual_nilai_update = oGrid_event.record.data.jjual_nilai;}
		if(oGrid_event.record.data.jjual_ref!== null){jjual_ref_update = oGrid_event.record.data.jjual_ref;}
		if(oGrid_event.record.data.jjual_penerima!== null){jjual_penerima_update = oGrid_event.record.data.jjual_penerima;}
		if(oGrid_event.record.data.jjual_posting!== null){jjual_posting_update = oGrid_event.record.data.jjual_posting;}
	 	if(oGrid_event.record.data.jjual_tglposting!== ""){jjual_tglposting_update_date =oGrid_event.record.data.jjual_tglposting.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_jual&m=get_action',
			params: {
				task: "UPDATE",
				jjual_id	: jjual_id_update_pk, 
				jjual_akun	:jjual_akun_update,  
				jjual_tanggal	: jjual_tanggal_update_date, 
				jjual_keterangan	:jjual_keterangan_update,  
				jjual_nilai	:jjual_nilai_update,  
				jjual_ref	:jjual_ref_update,  
				jjual_penerima	:jjual_penerima_update,  
				jjual_posting	:jjual_posting_update,  
				jjual_tglposting	: jjual_tglposting_update_date, 
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jurnal_jual_DataStore.commitChanges();
						jurnal_jual_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the jurnal_jual.',
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
	function jurnal_jual_create(){
		if(jjual_dtotal_nilaiField.getValue()==jjual_nilaiField.getValue()){
			if(is_jurnal_jual_form_valid()){	
			var jjual_id_create_pk=null; 
			var jjual_akun_create=null; 
			var jjual_tanggal_create_date=""; 
			var jjual_keterangan_create=null; 
			var jjual_nilai_create=null; 
			var jjual_ref_create=null; 
			var jjual_penerima_create=null; 
			var jjual_posting_create=null; 
			var jjual_tglposting_create_date=""; 
	
			if(jjual_idField.getValue()!== null){jjual_id_create_pk = jjual_idField.getValue();}else{jjual_id_create_pk=get_pk_id();} 
			if(jjual_akunField.getValue()!== null){jjual_akun_create = jjual_akunField.getValue();} 
			if(jjual_tanggalField.getValue()!== ""){jjual_tanggal_create_date = jjual_tanggalField.getValue().format('Y-m-d');} 
			if(jjual_keteranganField.getValue()!== null){jjual_keterangan_create = jjual_keteranganField.getValue();} 
			if(jjual_nilaiField.getValue()!== null){jjual_nilai_create = jjual_nilaiField.getValue();} 
			if(jjual_refField.getValue()!== null){jjual_ref_create = jjual_refField.getValue();} 
			if(jjual_penerimaField.getValue()!== null){jjual_penerima_create = jjual_penerimaField.getValue();} 
			if(jjual_postingField.getValue()!== null){jjual_posting_create = jjual_postingField.getValue();} 
			if(jjual_tglpostingField.getValue()!== ""){jjual_tglposting_create_date = jjual_tglpostingField.getValue().format('Y-m-d');} 
	
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_jual&m=get_action',
				params: {
					task: post2db,
					jjual_id	: jjual_id_create_pk, 
					jjual_akun	: jjual_akun_create, 
					jjual_tanggal	: jjual_tanggal_create_date, 
					jjual_keterangan	: jjual_keterangan_create, 
					jjual_nilai	: jjual_nilai_create, 
					jjual_ref	: jjual_ref_create, 
					jjual_penerima	: jjual_penerima_create, 
					jjual_posting	: jjual_posting_create, 
					jjual_tglposting	: jjual_tglposting_create_date, 
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							jurnal_jual_detail_purge()
							jurnal_jual_detail_insert();
							Ext.MessageBox.alert(post2db+' OK','The Jurnal_jual was '+msg+' successfully.');
							jurnal_jual_DataStore.reload();
							jurnal_jual_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Jurnal_jual.',
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
			return jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jurnal_jual_reset_form(){
		jjual_idField.reset();
		jjual_idField.setValue(null);
		jjual_akunField.reset();
		jjual_akunField.setValue(null);
		jjual_tanggalField.reset();
		jjual_tanggalField.setValue(null);
		jjual_keteranganField.reset();
		jjual_keteranganField.setValue(null);
		jjual_nilaiField.reset();
		jjual_nilaiField.setValue(null);
		jjual_refField.reset();
		jjual_refField.setValue(null);
		jjual_penerimaField.reset();
		jjual_penerimaField.setValue(null);
		jjual_postingField.reset();
		jjual_postingField.setValue(null);
		jjual_tglpostingField.reset();
		jjual_tglpostingField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jurnal_jual_set_form(){
		jjual_idField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_id'));
		jjual_akunField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_akun'));
		jjual_tanggalField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_tanggal'));
		jjual_keteranganField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_keterangan'));
		jjual_nilaiField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_nilai'));
		jjual_refField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_ref'));
		jjual_penerimaField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_penerima'));
		jjual_postingField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_posting'));
		jjual_tglpostingField.setValue(jurnal_jualListEditorGrid.getSelectionModel().getSelected().get('jjual_tglposting'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jurnal_jual_form_valid(){
		return (true &&  jjual_akunField.isValid() && jjual_tanggalField.isValid() && jjual_keteranganField.isValid() && jjual_nilaiField.isValid() && true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jurnal_jual_createWindow.isVisible()){
			jurnal_jual_reset_form();
			post2db='CREATE';
			msg='created';
			jjual_tanggalField.setValue(dt);
			jurnal_jual_createWindow.show();
		} else {
			jurnal_jual_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jurnal_jual_confirm_delete(){
		// only one jurnal_jual is selected here
		if(jurnal_jualListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_jual_delete);
		} else if(jurnal_jualListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_jual_delete);
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
	function jurnal_jual_confirm_update(){
		/* only one record is selected here */
		if(jurnal_jualListEditorGrid.selModel.getCount() == 1) {
			jurnal_jual_set_form();
			post2db='UPDATE';
			jurnal_jual_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			jurnal_jual_createWindow.show();
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
	function jurnal_jual_delete(btn){
		if(btn=='yes'){
			var selections = jurnal_jualListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jurnal_jualListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jjual_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jurnal_jual&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jurnal_jual_DataStore.reload();
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
	jurnal_jual_DataStore = new Ext.data.Store({
		id: 'jurnal_jual_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_jual&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jjual_id'
		},[
		/* dataIndex => insert intojurnal_jual_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jjual_id', type: 'int', mapping: 'jjual_id'}, 
			{name: 'jjual_akun', type: 'int', mapping: 'jjual_akun'}, 
			{name: 'jjual_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jjual_tanggal'}, 
			{name: 'jjual_keterangan', type: 'string', mapping: 'jjual_keterangan'}, 
			{name: 'jjual_nilai', type: 'float', mapping: 'jjual_nilai'}, 
			{name: 'jjual_ref', type: 'int', mapping: 'jjual_ref'}, 
			{name: 'jjual_penerima', type: 'string', mapping: 'jjual_penerima'}, 
			{name: 'jjual_posting', type: 'string', mapping: 'jjual_posting'}, 
			{name: 'jjual_tglposting', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jjual_tglposting'}, 
			{name: 'jjual_creator', type: 'string', mapping: 'jjual_creator'}, 
			{name: 'jjual_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'jjual_date_create'}, 
			{name: 'jjual_update', type: 'string', mapping: 'jjual_update'}, 
			{name: 'jjual_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'jjual_date_update'}, 
			{name: 'jjual_revised', type: 'int', mapping: 'jjual_revised'} 
		]),
		sortInfo:{field: 'jjual_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* GET detail akun */
	cbo_jjual_akunDataStore = new Ext.data.Store({
		id: 'cbo_jjual_akunDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_jual&m=get_akun_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: 10}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jjual_akun_value', type: 'int', mapping: 'akun_id'},
			{name: 'jjual_akun_nama', type: 'string', mapping: 'akun_nama'},
			{name: 'jjual_akun_kode', type: 'string', mapping: 'akun_kode'}
		]),
		sortInfo:{field: 'jjual_akun_nama', direction: "ASC"}
	});
	/* END akun datasource */
	cbo_jjual_akunDataStore.load();
	var jjual_akun_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{jjual_akun_nama}</b><br /></span>',
            'Kode Akun: {jjual_akun_kode}',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	jurnal_jual_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jjual_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Akun',
			dataIndex: 'jjual_akun',
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
			header: 'Tanggal',
			dataIndex: 'jjual_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'jjual_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 500
          	})
		}, 
		{
			header: 'Nilai',
			dataIndex: 'jjual_nilai',
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
		}, 
		{
			header: 'Ref',
			dataIndex: 'jjual_ref',
			width: 150,
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
			header: 'Penerima',
			dataIndex: 'jjual_penerima',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 255
          	})
		}, 
		{
			header: 'Posting',
			dataIndex: 'jjual_posting',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['jjual_posting_value', 'jjual_posting_display'],
					data: [['T','T'],['Y','Y']]
					}),
				mode: 'local',
               	displayField: 'jjual_posting_display',
               	valueField: 'jjual_posting_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Tglposting',
			dataIndex: 'jjual_tglposting',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Creator',
			dataIndex: 'jjual_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jjual_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jjual_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jjual_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jjual_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	jurnal_jual_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	jurnal_jualListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_jualListEditorGrid',
		el: 'fp_jurnal_jual',
		title: 'List Of Jurnal_jual',
		autoHeight: true,
		store: jurnal_jual_DataStore, // DataStore
		cm: jurnal_jual_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_jual_DataStore,
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
			handler: jurnal_jual_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jurnal_jual_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jurnal_jual_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jurnal_jual_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_jual_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_jual_print  
		}
		]
	});
	jurnal_jualListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jurnal_jual_ContextMenu = new Ext.menu.Menu({
		id: 'jurnal_jual_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jurnal_jual_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jurnal_jual_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_jual_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_jual_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjurnal_jual_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jurnal_jual_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jurnal_jual_SelectedRow=rowIndex;
		jurnal_jual_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jurnal_jual_editContextMenu(){
		jurnal_jualListEditorGrid.startEditing(jurnal_jual_SelectedRow,1);
  	}
	/* End of Function */
  	
	jurnal_jualListEditorGrid.addListener('rowcontextmenu', onjurnal_jual_ListEditGridContextMenu);
	jurnal_jual_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	jurnal_jualListEditorGrid.on('afteredit', jurnal_jual_update); // inLine Editing Record
	
	/* Identify  jjual_id Field */
	jjual_idField= new Ext.form.NumberField({
		id: 'jjual_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jjual_akun Field */
	jjual_akunField= new Ext.form.ComboBox({
		id: 'jjual_akunField',
		fieldLabel: 'Akun',
		store: cbo_jjual_akunDataStore,
		displayField:'jjual_akun_nama',
		mode : 'remote',
		valueField: 'jjual_akun_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: jjual_akun_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '50%'
	});
	/* Identify  jjual_tanggal Field */
	jjual_tanggalField= new Ext.form.DateField({
		id: 'jjual_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		allowBlank: false,
		disabled: true
	});
	/* Identify  jjual_keterangan Field */
	jjual_keteranganField= new Ext.form.TextArea({
		id: 'jjual_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		allowBlank: true,
		anchor: '95%'
	});
	/* Identify  jjual_nilai Field */
	jjual_nilaiField= new Ext.form.NumberField({
		id: 'jjual_nilaiField',
		fieldLabel: 'Nilai',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jjual_ref Field */
	jjual_refField= new Ext.form.NumberField({
		id: 'jjual_refField',
		fieldLabel: 'Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jjual_penerima Field */
	jjual_penerimaField= new Ext.form.TextField({
		id: 'jjual_penerimaField',
		fieldLabel: 'Penerima',
		maxLength: 255,
		anchor: '95%'
	});
	/* Identify  jjual_posting Field */
	jjual_postingField= new Ext.form.ComboBox({
		id: 'jjual_postingField',
		fieldLabel: 'Posting',
		store:new Ext.data.SimpleStore({
			fields:['jjual_posting_value', 'jjual_posting_display'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jjual_posting_display',
		valueField: 'jjual_posting_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jjual_tglposting Field */
	jjual_tglpostingField= new Ext.form.DateField({
		id: 'jjual_tglpostingField',
		fieldLabel: 'Tglposting',
		format : 'Y-m-d',
	});
  	/*Fieldset Master*/
	jjual_dtotal_nilaiField= new Ext.form.NumberField({
		id: 'jjual_dtotal_nilaiField',
		fieldLabel: 'Detail Total Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jurnal_jual_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jjual_tanggalField, jjual_akunField, jjual_keteranganField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jjual_nilaiField, jjual_refField, jjual_penerimaField, jjual_idField] 
			}
			]
	
	});
	
	jurnal_jual_dtotal_nilaiGroup = new Ext.form.FieldSet({
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
				items: [jjual_dtotal_nilaiField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var jurnal_jual_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'djjual_id', type: 'int', mapping: 'djjual_id'}, 
			{name: 'djjual_master', type: 'int', mapping: 'djjual_master'}, 
			{name: 'djjual_keterangan', type: 'string', mapping: 'djjual_keterangan'}, 
			{name: 'djjual_akun', type: 'int', mapping: 'djjual_akun'}, 
			{name: 'djjual_nilai', type: 'float', mapping: 'djjual_nilai'} 
	]);
	//eof
	
	//function for json writer of detail
	var jurnal_jual_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	jurnal_jual_detail_DataStore = new Ext.data.Store({
		id: 'jurnal_jual_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_jual&m=detail_jurnal_jual_detail_list', 
			method: 'POST'
		}),
		reader: jurnal_jual_detail_reader,
		baseParams:{master_id: jjual_idField.getValue()},
		sortInfo:{field: 'djjual_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_jurnal_jual_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_djjual_akun=new Ext.form.ComboBox({
			store: cbo_jjual_akunDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'jjual_akun_nama',
			valueField: 'jjual_akun_value',
			triggerAction: 'all',
			lazyRender:true,

	});
	
	//declaration of detail coloumn model
	jurnal_jual_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Keterangan',
			dataIndex: 'djjual_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextArea({
				maxLength: 250
          	})
		},
		{
			header: 'Akun',
			dataIndex: 'djjual_akun',
			width: 150,
			sortable: true,
			editor: combo_djjual_akun,
			renderer: Ext.util.Format.comboRenderer(combo_djjual_akun)
		},
		{
			header: 'Nilai',
			dataIndex: 'djjual_nilai',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}]
	);
	jurnal_jual_detail_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	jurnal_jual_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_jual_detailListEditorGrid',
		el: 'fp_jurnal_jual_detail',
		title: 'Detail jurnal_jual_detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: jurnal_jual_detail_DataStore, // DataStore
		colModel: jurnal_jual_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_jurnal_jual_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_jual_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: jurnal_jual_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: jurnal_jual_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function jurnal_jual_detail_add(){
		var edit_jurnal_jual_detail= new jurnal_jual_detailListEditorGrid.store.recordType({
			djjual_id	:'',		
			djjual_master	:'',		
			djjual_keterangan	:'',		
			djjual_akun	:'',		
			djjual_nilai	:''		
		});
		editor_jurnal_jual_detail.stopEditing();
		jurnal_jual_detail_DataStore.insert(0, edit_jurnal_jual_detail);
		jurnal_jual_detailListEditorGrid.getView().refresh();
		jurnal_jual_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_jurnal_jual_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_jurnal_jual_detail(){
		jurnal_jual_detail_DataStore.commitChanges();
		jurnal_jual_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function jurnal_jual_detail_insert(){
		for(i=0;i<jurnal_jual_detail_DataStore.getCount();i++){
			jurnal_jual_detail_record=jurnal_jual_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_jual&m=detail_jurnal_jual_detail_insert',
				params:{
				djjual_id	: jurnal_jual_detail_record.data.djjual_id, 
				djjual_master	: eval(jjual_idField.getValue()), 
				djjual_keterangan	: jurnal_jual_detail_record.data.djjual_keterangan, 
				djjual_akun	: jurnal_jual_detail_record.data.djjual_akun, 
				djjual_nilai	: jurnal_jual_detail_record.data.djjual_nilai 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function jurnal_jual_detail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_jual&m=detail_jurnal_jual_detail_purge',
			params:{ master_id: eval(jjual_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function jurnal_jual_detail_confirm_delete(){
		// only one record is selected here
		if(jurnal_jual_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_jual_detail_delete);
		} else if(jurnal_jual_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_jual_detail_delete);
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
	function jurnal_jual_detail_delete(btn){
		if(btn=='yes'){
			var s = jurnal_jual_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				jurnal_jual_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	jurnal_jual_detail_DataStore.on('update', refresh_jurnal_jual_detail);
	
	/* Function for retrieve create Window Panel*/ 
	jurnal_jual_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [jurnal_jual_masterGroup,jurnal_jual_detailListEditorGrid,jurnal_jual_dtotal_nilaiGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: jurnal_jual_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					jurnal_jual_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jurnal_jual_createWindow= new Ext.Window({
		id: 'jurnal_jual_createWindow',
		title: post2db+'Jurnal_jual',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jurnal_jual_create',
		items: jurnal_jual_createForm
	});
	/* End Window */
	
	function detail_jjual_dtotalnilai(){
		var total_nilai=0;
		for(i=0;i<jurnal_jual_detail_DataStore.getCount();i++){
			detail_jjual_record=jurnal_jual_detail_DataStore.getAt(i);
			total_nilai=total_nilai+detail_jjual_record.data.djjual_nilai;
		}
		jjual_dtotal_nilaiField.setValue(total_nilai);
	}
	
	jurnal_jual_detail_DataStore.on('update',detail_jjual_dtotalnilai);
	jurnal_jual_detail_DataStore.on('load',detail_jjual_dtotalnilai);
	
	/* Function for action list search */
	function jurnal_jual_list_search(){
		// render according to a SQL date format.
		var jjual_id_search=null;
		var jjual_akun_search=null;
		var jjual_tanggal_search_date="";
		var jjual_keterangan_search=null;
		var jjual_nilai_search=null;
		var jjual_ref_search=null;
		var jjual_penerima_search=null;
		var jjual_posting_search=null;
		var jjual_tglposting_search_date="";

		if(jjual_idSearchField.getValue()!==null){jjual_id_search=jjual_idSearchField.getValue();}
		if(jjual_akunSearchField.getValue()!==null){jjual_akun_search=jjual_akunSearchField.getValue();}
		if(jjual_tanggalSearchField.getValue()!==""){jjual_tanggal_search_date=jjual_tanggalSearchField.getValue().format('Y-m-d');}
		if(jjual_keteranganSearchField.getValue()!==null){jjual_keterangan_search=jjual_keteranganSearchField.getValue();}
		if(jjual_nilaiSearchField.getValue()!==null){jjual_nilai_search=jjual_nilaiSearchField.getValue();}
		if(jjual_refSearchField.getValue()!==null){jjual_ref_search=jjual_refSearchField.getValue();}
		if(jjual_penerimaSearchField.getValue()!==null){jjual_penerima_search=jjual_penerimaSearchField.getValue();}
		if(jjual_postingSearchField.getValue()!==null){jjual_posting_search=jjual_postingSearchField.getValue();}
		if(jjual_tglpostingSearchField.getValue()!==""){jjual_tglposting_search_date=jjual_tglpostingSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		jurnal_jual_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jjual_id	:	jjual_id_search, 
			jjual_akun	:	jjual_akun_search, 
			jjual_tanggal	:	jjual_tanggal_search_date, 
			jjual_keterangan	:	jjual_keterangan_search, 
			jjual_nilai	:	jjual_nilai_search, 
			jjual_ref	:	jjual_ref_search, 
			jjual_penerima	:	jjual_penerima_search, 
			jjual_posting	:	jjual_posting_search, 
			jjual_tglposting	:	jjual_tglposting_search_date, 
		};
		// Cause the datastore to do another query : 
		jurnal_jual_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jurnal_jual_reset_search(){
		// reset the store parameters
		jurnal_jual_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jurnal_jual_DataStore.reload({params: {start: 0, limit: pageS}});
		jurnal_jual_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  jjual_id Search Field */
	jjual_idSearchField= new Ext.form.NumberField({
		id: 'jjual_idSearchField',
		fieldLabel: 'Jjual Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jjual_akun Search Field */
	jjual_akunSearchField= new Ext.form.NumberField({
		id: 'jjual_akunSearchField',
		fieldLabel: 'Jjual Akun',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jjual_tanggal Search Field */
	jjual_tanggalSearchField= new Ext.form.DateField({
		id: 'jjual_tanggalSearchField',
		fieldLabel: 'Jjual Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jjual_keterangan Search Field */
	jjual_keteranganSearchField= new Ext.form.TextField({
		id: 'jjual_keteranganSearchField',
		fieldLabel: 'Jjual Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  jjual_nilai Search Field */
	jjual_nilaiSearchField= new Ext.form.NumberField({
		id: 'jjual_nilaiSearchField',
		fieldLabel: 'Jjual Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jjual_ref Search Field */
	jjual_refSearchField= new Ext.form.NumberField({
		id: 'jjual_refSearchField',
		fieldLabel: 'Jjual Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jjual_penerima Search Field */
	jjual_penerimaSearchField= new Ext.form.TextField({
		id: 'jjual_penerimaSearchField',
		fieldLabel: 'Jjual Penerima',
		maxLength: 255,
		anchor: '95%'
	
	});
	/* Identify  jjual_posting Search Field */
	jjual_postingSearchField= new Ext.form.ComboBox({
		id: 'jjual_postingSearchField',
		fieldLabel: 'Jjual Posting',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jjual_posting'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jjual_posting',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jjual_tglposting Search Field */
	jjual_tglpostingSearchField= new Ext.form.DateField({
		id: 'jjual_tglpostingSearchField',
		fieldLabel: 'Jjual Tglposting',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	jurnal_jual_searchForm = new Ext.FormPanel({
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
				items: [jjual_akunSearchField, jjual_tanggalSearchField, jjual_keteranganSearchField, jjual_nilaiSearchField, jjual_refSearchField, jjual_penerimaSearchField, jjual_postingSearchField, jjual_tglpostingSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jurnal_jual_list_search
			},{
				text: 'Close',
				handler: function(){
					jurnal_jual_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	jurnal_jual_searchWindow = new Ext.Window({
		title: 'jurnal_jual Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jurnal_jual_search',
		items: jurnal_jual_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jurnal_jual_searchWindow.isVisible()){
			jurnal_jual_searchWindow.show();
		} else {
			jurnal_jual_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jurnal_jual_print(){
		var searchquery = "";
		var jjual_akun_print=null;
		var jjual_tanggal_print_date="";
		var jjual_keterangan_print=null;
		var jjual_nilai_print=null;
		var jjual_ref_print=null;
		var jjual_penerima_print=null;
		var jjual_posting_print=null;
		var jjual_tglposting_print_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_jual_DataStore.baseParams.query!==null){searchquery = jurnal_jual_DataStore.baseParams.query;}
		if(jurnal_jual_DataStore.baseParams.jjual_akun!==null){jjual_akun_print = jurnal_jual_DataStore.baseParams.jjual_akun;}
		if(jurnal_jual_DataStore.baseParams.jjual_tanggal!==""){jjual_tanggal_print_date = jurnal_jual_DataStore.baseParams.jjual_tanggal;}
		if(jurnal_jual_DataStore.baseParams.jjual_keterangan!==null){jjual_keterangan_print = jurnal_jual_DataStore.baseParams.jjual_keterangan;}
		if(jurnal_jual_DataStore.baseParams.jjual_nilai!==null){jjual_nilai_print = jurnal_jual_DataStore.baseParams.jjual_nilai;}
		if(jurnal_jual_DataStore.baseParams.jjual_ref!==null){jjual_ref_print = jurnal_jual_DataStore.baseParams.jjual_ref;}
		if(jurnal_jual_DataStore.baseParams.jjual_penerima!==null){jjual_penerima_print = jurnal_jual_DataStore.baseParams.jjual_penerima;}
		if(jurnal_jual_DataStore.baseParams.jjual_posting!==null){jjual_posting_print = jurnal_jual_DataStore.baseParams.jjual_posting;}
		if(jurnal_jual_DataStore.baseParams.jjual_tglposting!==""){jjual_tglposting_print_date = jurnal_jual_DataStore.baseParams.jjual_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_jual&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jjual_akun : jjual_akun_print,
		  	jjual_tanggal : jjual_tanggal_print_date, 
			jjual_keterangan : jjual_keterangan_print,
			jjual_nilai : jjual_nilai_print,
			jjual_ref : jjual_ref_print,
			jjual_penerima : jjual_penerima_print,
			jjual_posting : jjual_posting_print,
		  	jjual_tglposting : jjual_tglposting_print_date, 
		  	currentlisting: jurnal_jual_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./jurnal_juallist.html','jurnal_juallist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jurnal_jual_export_excel(){
		var searchquery = "";
		var jjual_akun_2excel=null;
		var jjual_tanggal_2excel_date="";
		var jjual_keterangan_2excel=null;
		var jjual_nilai_2excel=null;
		var jjual_ref_2excel=null;
		var jjual_penerima_2excel=null;
		var jjual_posting_2excel=null;
		var jjual_tglposting_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_jual_DataStore.baseParams.query!==null){searchquery = jurnal_jual_DataStore.baseParams.query;}
		if(jurnal_jual_DataStore.baseParams.jjual_akun!==null){jjual_akun_2excel = jurnal_jual_DataStore.baseParams.jjual_akun;}
		if(jurnal_jual_DataStore.baseParams.jjual_tanggal!==""){jjual_tanggal_2excel_date = jurnal_jual_DataStore.baseParams.jjual_tanggal;}
		if(jurnal_jual_DataStore.baseParams.jjual_keterangan!==null){jjual_keterangan_2excel = jurnal_jual_DataStore.baseParams.jjual_keterangan;}
		if(jurnal_jual_DataStore.baseParams.jjual_nilai!==null){jjual_nilai_2excel = jurnal_jual_DataStore.baseParams.jjual_nilai;}
		if(jurnal_jual_DataStore.baseParams.jjual_ref!==null){jjual_ref_2excel = jurnal_jual_DataStore.baseParams.jjual_ref;}
		if(jurnal_jual_DataStore.baseParams.jjual_penerima!==null){jjual_penerima_2excel = jurnal_jual_DataStore.baseParams.jjual_penerima;}
		if(jurnal_jual_DataStore.baseParams.jjual_posting!==null){jjual_posting_2excel = jurnal_jual_DataStore.baseParams.jjual_posting;}
		if(jurnal_jual_DataStore.baseParams.jjual_tglposting!==""){jjual_tglposting_2excel_date = jurnal_jual_DataStore.baseParams.jjual_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_jual&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jjual_akun : jjual_akun_2excel,
		  	jjual_tanggal : jjual_tanggal_2excel_date, 
			jjual_keterangan : jjual_keterangan_2excel,
			jjual_nilai : jjual_nilai_2excel,
			jjual_ref : jjual_ref_2excel,
			jjual_penerima : jjual_penerima_2excel,
			jjual_posting : jjual_posting_2excel,
		  	jjual_tglposting : jjual_tglposting_2excel_date, 
		  	currentlisting: jurnal_jual_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_jurnal_jual"></div>
         <div id="fp_jurnal_jual_detail"></div>
		<div id="elwindow_jurnal_jual_create"></div>
        <div id="elwindow_jurnal_jual_search"></div>
    </div>
</div>
</body>