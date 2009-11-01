<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_beli View
	+ Description	: For record view
	+ Filename 		: v_jurnal_beli.php
 	+ Author  		: 
 	+ Created on 30/Sep/2009 11:22:37
	
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
var jurnal_beli_DataStore;
var jurnal_beli_ColumnModel;
var jurnal_beliListEditorGrid;
var jurnal_beli_createForm;
var jurnal_beli_createWindow;
var jurnal_beli_searchForm;
var jurnal_beli_searchWindow;
var jurnal_beli_SelectedRow;
var jurnal_beli_ContextMenu;
//for detail data
var jurnal_beli_detail_DataStor;
var jurnal_beli_detailListEditorGrid;
var jurnal_beli_detail_ColumnModel;
var jurnal_beli_detail_proxy;
var jurnal_beli_detail_writer;
var jurnal_beli_detail_reader;
var editor_jurnal_beli_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var jbeli_idField;
var jbeli_tanggalField;
var jbeli_akunField;
var jbeli_keteranganField;
var jbeli_nilaiField;
var jbeli_refField;
var jbeli_penerimaField;
var jbeli_postingField;
var jbeli_tglpostingField;
var jbeli_idSearchField;
var jbeli_tanggalSearchField;
var jbeli_akunSearchField;
var jbeli_keteranganSearchField;
var jbeli_nilaiSearchField;
var jbeli_refSearchField;
var jbeli_penerimaSearchField;
var jbeli_postingSearchField;
var jbeli_tglpostingSearchField;

var dt = new Date();

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jurnal_beli_update(oGrid_event){
		var jbeli_id_update_pk="";
		var jbeli_tanggal_update_date="";
		var jbeli_akun_update=null;
		var jbeli_keterangan_update=null;
		var jbeli_nilai_update=null;
		var jbeli_ref_update=null;
		var jbeli_penerima_update=null;
		var jbeli_posting_update=null;
		var jbeli_tglposting_update_date="";

		jbeli_id_update_pk = oGrid_event.record.data.jbeli_id;
	 	if(oGrid_event.record.data.jbeli_tanggal!== ""){jbeli_tanggal_update_date =oGrid_event.record.data.jbeli_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jbeli_akun!== null){jbeli_akun_update = oGrid_event.record.data.jbeli_akun;}
		if(oGrid_event.record.data.jbeli_keterangan!== null){jbeli_keterangan_update = oGrid_event.record.data.jbeli_keterangan;}
		if(oGrid_event.record.data.jbeli_nilai!== null){jbeli_nilai_update = oGrid_event.record.data.jbeli_nilai;}
		if(oGrid_event.record.data.jbeli_ref!== null){jbeli_ref_update = oGrid_event.record.data.jbeli_ref;}
		if(oGrid_event.record.data.jbeli_penerima!== null){jbeli_penerima_update = oGrid_event.record.data.jbeli_penerima;}
		if(oGrid_event.record.data.jbeli_posting!== null){jbeli_posting_update = oGrid_event.record.data.jbeli_posting;}
	 	if(oGrid_event.record.data.jbeli_tglposting!== ""){jbeli_tglposting_update_date =oGrid_event.record.data.jbeli_tglposting.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_beli&m=get_action',
			params: {
				task: "UPDATE",
				jbeli_id	: jbeli_id_update_pk, 
				jbeli_tanggal	: jbeli_tanggal_update_date, 
				jbeli_akun	:jbeli_akun_update,  
				jbeli_keterangan	:jbeli_keterangan_update,  
				jbeli_nilai	:jbeli_nilai_update,  
				jbeli_ref	:jbeli_ref_update,  
				jbeli_penerima	:jbeli_penerima_update,  
				jbeli_posting	:jbeli_posting_update,  
				jbeli_tglposting	: jbeli_tglposting_update_date, 
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jurnal_beli_DataStore.commitChanges();
						jurnal_beli_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the jurnal_beli.',
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
	function jurnal_beli_create(){
		if(jbeli_dtotal_nilaiField.getValue()==jbeli_nilaiField.getValue()){
			if(is_jurnal_beli_form_valid()){	
			var jbeli_id_create_pk=null; 
			var jbeli_tanggal_create_date=""; 
			var jbeli_akun_create=null; 
			var jbeli_keterangan_create=null; 
			var jbeli_nilai_create=null; 
			var jbeli_ref_create=null; 
			var jbeli_penerima_create=null; 
			var jbeli_posting_create=null; 
			var jbeli_tglposting_create_date=""; 
	
			if(jbeli_idField.getValue()!== null){jbeli_id_create_pk = jbeli_idField.getValue();}else{jbeli_id_create_pk=get_pk_id();} 
			if(jbeli_tanggalField.getValue()!== ""){jbeli_tanggal_create_date = jbeli_tanggalField.getValue().format('Y-m-d');} 
			if(jbeli_akunField.getValue()!== null){jbeli_akun_create = jbeli_akunField.getValue();} 
			if(jbeli_keteranganField.getValue()!== null){jbeli_keterangan_create = jbeli_keteranganField.getValue();} 
			if(jbeli_nilaiField.getValue()!== null){jbeli_nilai_create = jbeli_nilaiField.getValue();} 
			if(jbeli_refField.getValue()!== null){jbeli_ref_create = jbeli_refField.getValue();} 
			if(jbeli_penerimaField.getValue()!== null){jbeli_penerima_create = jbeli_penerimaField.getValue();} 
			if(jbeli_postingField.getValue()!== null){jbeli_posting_create = jbeli_postingField.getValue();} 
			if(jbeli_tglpostingField.getValue()!== ""){jbeli_tglposting_create_date = jbeli_tglpostingField.getValue().format('Y-m-d');} 
	
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_beli&m=get_action',
				params: {
					task: post2db,
					jbeli_id	: jbeli_id_create_pk, 
					jbeli_tanggal	: jbeli_tanggal_create_date, 
					jbeli_akun	: jbeli_akun_create, 
					jbeli_keterangan	: jbeli_keterangan_create, 
					jbeli_nilai	: jbeli_nilai_create, 
					jbeli_ref	: jbeli_ref_create, 
					jbeli_penerima	: jbeli_penerima_create, 
					jbeli_posting	: jbeli_posting_create, 
					jbeli_tglposting	: jbeli_tglposting_create_date, 
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							jurnal_beli_detail_purge()
							jurnal_beli_detail_insert();
							Ext.MessageBox.alert(post2db+' OK','The Jurnal_beli was '+msg+' successfully.');
							jurnal_beli_DataStore.reload();
							jurnal_beli_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Jurnal_beli.',
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
			return jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jurnal_beli_reset_form(){
		jbeli_idField.reset();
		jbeli_idField.setValue(null);
		jbeli_tanggalField.reset();
		jbeli_tanggalField.setValue(null);
		jbeli_akunField.reset();
		jbeli_akunField.setValue(null);
		jbeli_keteranganField.reset();
		jbeli_keteranganField.setValue(null);
		jbeli_nilaiField.reset();
		jbeli_nilaiField.setValue(null);
		jbeli_refField.reset();
		jbeli_refField.setValue(null);
		jbeli_penerimaField.reset();
		jbeli_penerimaField.setValue(null);
		jbeli_postingField.reset();
		jbeli_postingField.setValue(null);
		jbeli_tglpostingField.reset();
		jbeli_tglpostingField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jurnal_beli_set_form(){
		jbeli_idField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_id'));
		jbeli_tanggalField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_tanggal'));
		jbeli_akunField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_akun'));
		jbeli_keteranganField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_keterangan'));
		jbeli_nilaiField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_nilai'));
		jbeli_refField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_ref'));
		jbeli_penerimaField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_penerima'));
		jbeli_postingField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_posting'));
		jbeli_tglpostingField.setValue(jurnal_beliListEditorGrid.getSelectionModel().getSelected().get('jbeli_tglposting'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jurnal_beli_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jurnal_beli_createWindow.isVisible()){
			jurnal_beli_reset_form();
			post2db='CREATE';
			msg='created';
			jbeli_tanggalField.setValue(dt);
			jurnal_beli_createWindow.show();
		} else {
			jurnal_beli_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jurnal_beli_confirm_delete(){
		// only one jurnal_beli is selected here
		if(jurnal_beliListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_beli_delete);
		} else if(jurnal_beliListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_beli_delete);
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
	function jurnal_beli_confirm_update(){
		/* only one record is selected here */
		if(jurnal_beliListEditorGrid.selModel.getCount() == 1) {
			jurnal_beli_set_form();
			post2db='UPDATE';
			jurnal_beli_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			jurnal_beli_createWindow.show();
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
	function jurnal_beli_delete(btn){
		if(btn=='yes'){
			var selections = jurnal_beliListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jurnal_beliListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jbeli_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jurnal_beli&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jurnal_beli_DataStore.reload();
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
	jurnal_beli_DataStore = new Ext.data.Store({
		id: 'jurnal_beli_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_beli&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jbeli_id'
		},[
		/* dataIndex => insert intojurnal_beli_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jbeli_id', type: 'int', mapping: 'jbeli_id'}, 
			{name: 'jbeli_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jbeli_tanggal'}, 
			{name: 'jbeli_akun', type: 'string', mapping: 'akun_nama'}, 
			{name: 'jbeli_keterangan', type: 'string', mapping: 'jbeli_keterangan'}, 
			{name: 'jbeli_nilai', type: 'float', mapping: 'jbeli_nilai'}, 
			{name: 'jbeli_ref', type: 'int', mapping: 'jbeli_ref'}, 
			{name: 'jbeli_penerima', type: 'string', mapping: 'jbeli_penerima'}, 
			{name: 'jbeli_posting', type: 'string', mapping: 'jbeli_posting'}, 
			{name: 'jbeli_tglposting', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jbeli_tglposting'}, 
			{name: 'jbeli_creator', type: 'string', mapping: 'jbeli_creator'}, 
			{name: 'jbeli_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'jbeli_date_create'}, 
			{name: 'jbeli_update', type: 'string', mapping: 'jbeli_update'}, 
			{name: 'jbeli_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'jbeli_date_update'}, 
			{name: 'jbeli_revised', type: 'int', mapping: 'jbeli_revised'} 
		]),
		sortInfo:{field: 'jbeli_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* GET detail akun */
	cbo_jbeli_akunDataStore = new Ext.data.Store({
		id: 'cbo_jbeli_akunDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_beli&m=get_akun_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: 10}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jbeli_akun_value', type: 'int', mapping: 'akun_id'},
			{name: 'jbeli_akun_nama', type: 'string', mapping: 'akun_nama'},
			{name: 'jbeli_akun_kode', type: 'string', mapping: 'akun_kode'}
		]),
		sortInfo:{field: 'jbeli_akun_nama', direction: "ASC"}
	});
	/* END akun datasource */
	cbo_jbeli_akunDataStore.load();
	var jbeli_akun_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{jbeli_akun_nama}</b><br /></span>',
            'Kode Akun: {jbeli_akun_kode}',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	jurnal_beli_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jbeli_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Tanggal',
			dataIndex: 'jbeli_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Akun',
			dataIndex: 'jbeli_akun',
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
			header: 'Keterangan',
			dataIndex: 'jbeli_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		}, 
		{
			header: 'Nilai',
			dataIndex: 'jbeli_nilai',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Ref',
			dataIndex: 'jbeli_ref',
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
			dataIndex: 'jbeli_penerima',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: 'Posting',
			dataIndex: 'jbeli_posting',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['jbeli_posting_value', 'jbeli_posting_display'],
					data: [['T','T'],['Y','Y']]
					}),
				mode: 'local',
               	displayField: 'jbeli_posting_display',
               	valueField: 'jbeli_posting_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Tglposting',
			dataIndex: 'jbeli_tglposting',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Creator',
			dataIndex: 'jbeli_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jbeli_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jbeli_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jbeli_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jbeli_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	jurnal_beli_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	jurnal_beliListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_beliListEditorGrid',
		el: 'fp_jurnal_beli',
		title: 'List Of Jurnal_beli',
		autoHeight: true,
		store: jurnal_beli_DataStore, // DataStore
		cm: jurnal_beli_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_beli_DataStore,
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
			handler: jurnal_beli_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jurnal_beli_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jurnal_beli_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jurnal_beli_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_beli_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_beli_print  
		}
		]
	});
	jurnal_beliListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jurnal_beli_ContextMenu = new Ext.menu.Menu({
		id: 'jurnal_beli_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jurnal_beli_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jurnal_beli_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_beli_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_beli_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjurnal_beli_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jurnal_beli_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jurnal_beli_SelectedRow=rowIndex;
		jurnal_beli_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jurnal_beli_editContextMenu(){
		jurnal_beliListEditorGrid.startEditing(jurnal_beli_SelectedRow,1);
  	}
	/* End of Function */
  	
	jurnal_beliListEditorGrid.addListener('rowcontextmenu', onjurnal_beli_ListEditGridContextMenu);
	jurnal_beli_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	jurnal_beliListEditorGrid.on('afteredit', jurnal_beli_update); // inLine Editing Record
	
	/* Identify  jbeli_id Field */
	jbeli_idField= new Ext.form.NumberField({
		id: 'jbeli_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jbeli_tanggal Field */
	jbeli_tanggalField= new Ext.form.DateField({
		id: 'jbeli_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		disabled: true
	});
	/* Identify  jbeli_akun Field */
	jbeli_akunField= new Ext.form.ComboBox({
		id: 'jbeli_akunField',
		fieldLabel: 'Akun',
		store: cbo_jbeli_akunDataStore,
		displayField:'jbeli_akun_nama',
		mode : 'remote',
		valueField: 'jbeli_akun_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: jbeli_akun_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '50%'
	});
	/* Identify  jbeli_keterangan Field */
	jbeli_keteranganField= new Ext.form.TextArea({
		id: 'jbeli_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  jbeli_nilai Field */
	jbeli_nilaiField= new Ext.form.NumberField({
		id: 'jbeli_nilaiField',
		fieldLabel: 'Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jbeli_ref Field */
	jbeli_refField= new Ext.form.NumberField({
		id: 'jbeli_refField',
		fieldLabel: 'Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jbeli_penerima Field */
	jbeli_penerimaField= new Ext.form.TextField({
		id: 'jbeli_penerimaField',
		fieldLabel: 'Penerima',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jbeli_posting Field */
	jbeli_postingField= new Ext.form.ComboBox({
		id: 'jbeli_postingField',
		fieldLabel: 'Posting',
		store:new Ext.data.SimpleStore({
			fields:['jbeli_posting_value', 'jbeli_posting_display'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jbeli_posting_display',
		valueField: 'jbeli_posting_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jbeli_tglposting Field */
	jbeli_tglpostingField= new Ext.form.DateField({
		id: 'jbeli_tglpostingField',
		fieldLabel: 'Tglposting',
		format : 'Y-m-d',
	});
	jbeli_dtotal_nilaiField= new Ext.form.NumberField({
		id: 'jbeli_dtotal_nilaiField',
		fieldLabel: 'Detail Total Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	/*Fieldset Master*/
	jurnal_beli_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jbeli_tanggalField, jbeli_akunField, jbeli_keteranganField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jbeli_nilaiField, jbeli_refField, jbeli_penerimaField, jbeli_idField] 
			}
			]
	
	});
	
	jurnal_beli_dtotal_nilaiGroup = new Ext.form.FieldSet({
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
				items: [jbeli_dtotal_nilaiField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var jurnal_beli_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'djbeli_id', type: 'int', mapping: 'djbeli_id'}, 
			{name: 'djbeli_master', type: 'int', mapping: 'djbeli_master'}, 
			{name: 'djbeli_keterangan', type: 'string', mapping: 'djbeli_keterangan'}, 
			{name: 'djbeli_akun', type: 'int', mapping: 'djbeli_akun'}, 
			{name: 'djbeli_nilai', type: 'float', mapping: 'djbeli_nilai'} 
	]);
	//eof
	
	//function for json writer of detail
	var jurnal_beli_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	jurnal_beli_detail_DataStore = new Ext.data.Store({
		id: 'jurnal_beli_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_beli&m=detail_jurnal_beli_detail_list', 
			method: 'POST'
		}),
		reader: jurnal_beli_detail_reader,
		baseParams:{master_id: jbeli_idField.getValue()},
		sortInfo:{field: 'djbeli_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_jurnal_beli_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_djbeli_akun=new Ext.form.ComboBox({
			store: cbo_jbeli_akunDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'jbeli_akun_nama',
			valueField: 'jbeli_akun_value',
			triggerAction: 'all',
			lazyRender:true

	});
	
	//declaration of detail coloumn model
	jurnal_beli_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Keterangan',
			dataIndex: 'djbeli_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Akun',
			dataIndex: 'djbeli_akun',
			width: 150,
			sortable: true,
			editor: combo_djbeli_akun,
			renderer: Ext.util.Format.comboRenderer(combo_djbeli_akun)
		},
		{
			header: 'Nilai',
			dataIndex: 'djbeli_nilai',
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
	jurnal_beli_detail_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	jurnal_beli_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_beli_detailListEditorGrid',
		el: 'fp_jurnal_beli_detail',
		title: 'Detail jurnal_beli_detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: jurnal_beli_detail_DataStore, // DataStore
		colModel: jurnal_beli_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_jurnal_beli_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_beli_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: jurnal_beli_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: jurnal_beli_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function jurnal_beli_detail_add(){
		var edit_jurnal_beli_detail= new jurnal_beli_detailListEditorGrid.store.recordType({
			djbeli_id	:'',		
			djbeli_master	:'',		
			djbeli_keterangan	:'',		
			djbeli_akun	:'',		
			djbeli_nilai	:''		
		});
		editor_jurnal_beli_detail.stopEditing();
		jurnal_beli_detail_DataStore.insert(0, edit_jurnal_beli_detail);
		jurnal_beli_detailListEditorGrid.getView().refresh();
		jurnal_beli_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_jurnal_beli_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_jurnal_beli_detail(){
		jurnal_beli_detail_DataStore.commitChanges();
		jurnal_beli_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function jurnal_beli_detail_insert(){
		for(i=0;i<jurnal_beli_detail_DataStore.getCount();i++){
			jurnal_beli_detail_record=jurnal_beli_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_beli&m=detail_jurnal_beli_detail_insert',
				params:{
				djbeli_id	: jurnal_beli_detail_record.data.djbeli_id, 
				djbeli_master	: eval(jbeli_idField.getValue()), 
				djbeli_keterangan	: jurnal_beli_detail_record.data.djbeli_keterangan, 
				djbeli_akun	: jurnal_beli_detail_record.data.djbeli_akun, 
				djbeli_nilai	: jurnal_beli_detail_record.data.djbeli_nilai 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function jurnal_beli_detail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_beli&m=detail_jurnal_beli_detail_purge',
			params:{ master_id: eval(jbeli_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function jurnal_beli_detail_confirm_delete(){
		// only one record is selected here
		if(jurnal_beli_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_beli_detail_delete);
		} else if(jurnal_beli_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_beli_detail_delete);
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
	function jurnal_beli_detail_delete(btn){
		if(btn=='yes'){
			var s = jurnal_beli_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				jurnal_beli_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	jurnal_beli_detail_DataStore.on('update', refresh_jurnal_beli_detail);
	
	/* Function for retrieve create Window Panel*/ 
	jurnal_beli_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [jurnal_beli_masterGroup,jurnal_beli_detailListEditorGrid,jurnal_beli_dtotal_nilaiGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: jurnal_beli_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					jurnal_beli_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jurnal_beli_createWindow= new Ext.Window({
		id: 'jurnal_beli_createWindow',
		title: post2db+'Jurnal_beli',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jurnal_beli_create',
		items: jurnal_beli_createForm
	});
	/* End Window */
	
	function detail_jbeli_dtotalnilai(){
		var total_nilai=0;
		for(i=0;i<jurnal_beli_detail_DataStore.getCount();i++){
			detail_jbeli_record=jurnal_beli_detail_DataStore.getAt(i);
			total_nilai=total_nilai+detail_jbeli_record.data.djbeli_nilai;
		}
		jbeli_dtotal_nilaiField.setValue(total_nilai);
	}
	
	jurnal_beli_detail_DataStore.on('update',detail_jbeli_dtotalnilai);
	jurnal_beli_detail_DataStore.on('load',detail_jbeli_dtotalnilai);
	
	/* Function for action list search */
	function jurnal_beli_list_search(){
		// render according to a SQL date format.
		var jbeli_id_search=null;
		var jbeli_tanggal_search_date="";
		var jbeli_akun_search=null;
		var jbeli_keterangan_search=null;
		var jbeli_nilai_search=null;
		var jbeli_ref_search=null;
		var jbeli_penerima_search=null;
		var jbeli_posting_search=null;
		var jbeli_tglposting_search_date="";

		if(jbeli_idSearchField.getValue()!==null){jbeli_id_search=jbeli_idSearchField.getValue();}
		if(jbeli_tanggalSearchField.getValue()!==""){jbeli_tanggal_search_date=jbeli_tanggalSearchField.getValue().format('Y-m-d');}
		if(jbeli_akunSearchField.getValue()!==null){jbeli_akun_search=jbeli_akunSearchField.getValue();}
		if(jbeli_keteranganSearchField.getValue()!==null){jbeli_keterangan_search=jbeli_keteranganSearchField.getValue();}
		if(jbeli_nilaiSearchField.getValue()!==null){jbeli_nilai_search=jbeli_nilaiSearchField.getValue();}
		if(jbeli_refSearchField.getValue()!==null){jbeli_ref_search=jbeli_refSearchField.getValue();}
		if(jbeli_penerimaSearchField.getValue()!==null){jbeli_penerima_search=jbeli_penerimaSearchField.getValue();}
		if(jbeli_postingSearchField.getValue()!==null){jbeli_posting_search=jbeli_postingSearchField.getValue();}
		if(jbeli_tglpostingSearchField.getValue()!==""){jbeli_tglposting_search_date=jbeli_tglpostingSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		jurnal_beli_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jbeli_id	:	jbeli_id_search, 
			jbeli_tanggal	:	jbeli_tanggal_search_date, 
			jbeli_akun	:	jbeli_akun_search, 
			jbeli_keterangan	:	jbeli_keterangan_search, 
			jbeli_nilai	:	jbeli_nilai_search, 
			jbeli_ref	:	jbeli_ref_search, 
			jbeli_penerima	:	jbeli_penerima_search, 
			jbeli_posting	:	jbeli_posting_search, 
			jbeli_tglposting	:	jbeli_tglposting_search_date, 
		};
		// Cause the datastore to do another query : 
		jurnal_beli_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jurnal_beli_reset_search(){
		// reset the store parameters
		jurnal_beli_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jurnal_beli_DataStore.reload({params: {start: 0, limit: pageS}});
		jurnal_beli_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  jbeli_id Search Field */
	jbeli_idSearchField= new Ext.form.NumberField({
		id: 'jbeli_idSearchField',
		fieldLabel: 'Jbeli Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jbeli_tanggal Search Field */
	jbeli_tanggalSearchField= new Ext.form.DateField({
		id: 'jbeli_tanggalSearchField',
		fieldLabel: 'Jbeli Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jbeli_akun Search Field */
	jbeli_akunSearchField= new Ext.form.NumberField({
		id: 'jbeli_akunSearchField',
		fieldLabel: 'Jbeli Akun',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jbeli_keterangan Search Field */
	jbeli_keteranganSearchField= new Ext.form.TextField({
		id: 'jbeli_keteranganSearchField',
		fieldLabel: 'Jbeli Keterangan',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  jbeli_nilai Search Field */
	jbeli_nilaiSearchField= new Ext.form.NumberField({
		id: 'jbeli_nilaiSearchField',
		fieldLabel: 'Jbeli Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jbeli_ref Search Field */
	jbeli_refSearchField= new Ext.form.NumberField({
		id: 'jbeli_refSearchField',
		fieldLabel: 'Jbeli Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jbeli_penerima Search Field */
	jbeli_penerimaSearchField= new Ext.form.TextField({
		id: 'jbeli_penerimaSearchField',
		fieldLabel: 'Jbeli Penerima',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  jbeli_posting Search Field */
	jbeli_postingSearchField= new Ext.form.ComboBox({
		id: 'jbeli_postingSearchField',
		fieldLabel: 'Jbeli Posting',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jbeli_posting'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jbeli_posting',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jbeli_tglposting Search Field */
	jbeli_tglpostingSearchField= new Ext.form.DateField({
		id: 'jbeli_tglpostingSearchField',
		fieldLabel: 'Jbeli Tglposting',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	jurnal_beli_searchForm = new Ext.FormPanel({
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
				items: [jbeli_tanggalSearchField, jbeli_akunSearchField, jbeli_keteranganSearchField, jbeli_nilaiSearchField, jbeli_refSearchField, jbeli_penerimaSearchField, jbeli_postingSearchField, jbeli_tglpostingSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jurnal_beli_list_search
			},{
				text: 'Close',
				handler: function(){
					jurnal_beli_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	jurnal_beli_searchWindow = new Ext.Window({
		title: 'jurnal_beli Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jurnal_beli_search',
		items: jurnal_beli_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jurnal_beli_searchWindow.isVisible()){
			jurnal_beli_searchWindow.show();
		} else {
			jurnal_beli_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jurnal_beli_print(){
		var searchquery = "";
		var jbeli_tanggal_print_date="";
		var jbeli_akun_print=null;
		var jbeli_keterangan_print=null;
		var jbeli_nilai_print=null;
		var jbeli_ref_print=null;
		var jbeli_penerima_print=null;
		var jbeli_posting_print=null;
		var jbeli_tglposting_print_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_beli_DataStore.baseParams.query!==null){searchquery = jurnal_beli_DataStore.baseParams.query;}
		if(jurnal_beli_DataStore.baseParams.jbeli_tanggal!==""){jbeli_tanggal_print_date = jurnal_beli_DataStore.baseParams.jbeli_tanggal;}
		if(jurnal_beli_DataStore.baseParams.jbeli_akun!==null){jbeli_akun_print = jurnal_beli_DataStore.baseParams.jbeli_akun;}
		if(jurnal_beli_DataStore.baseParams.jbeli_keterangan!==null){jbeli_keterangan_print = jurnal_beli_DataStore.baseParams.jbeli_keterangan;}
		if(jurnal_beli_DataStore.baseParams.jbeli_nilai!==null){jbeli_nilai_print = jurnal_beli_DataStore.baseParams.jbeli_nilai;}
		if(jurnal_beli_DataStore.baseParams.jbeli_ref!==null){jbeli_ref_print = jurnal_beli_DataStore.baseParams.jbeli_ref;}
		if(jurnal_beli_DataStore.baseParams.jbeli_penerima!==null){jbeli_penerima_print = jurnal_beli_DataStore.baseParams.jbeli_penerima;}
		if(jurnal_beli_DataStore.baseParams.jbeli_posting!==null){jbeli_posting_print = jurnal_beli_DataStore.baseParams.jbeli_posting;}
		if(jurnal_beli_DataStore.baseParams.jbeli_tglposting!==""){jbeli_tglposting_print_date = jurnal_beli_DataStore.baseParams.jbeli_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_beli&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	jbeli_tanggal : jbeli_tanggal_print_date, 
			jbeli_akun : jbeli_akun_print,
			jbeli_keterangan : jbeli_keterangan_print,
			jbeli_nilai : jbeli_nilai_print,
			jbeli_ref : jbeli_ref_print,
			jbeli_penerima : jbeli_penerima_print,
			jbeli_posting : jbeli_posting_print,
		  	jbeli_tglposting : jbeli_tglposting_print_date, 
		  	currentlisting: jurnal_beli_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./jurnal_belilist.html','jurnal_belilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jurnal_beli_export_excel(){
		var searchquery = "";
		var jbeli_tanggal_2excel_date="";
		var jbeli_akun_2excel=null;
		var jbeli_keterangan_2excel=null;
		var jbeli_nilai_2excel=null;
		var jbeli_ref_2excel=null;
		var jbeli_penerima_2excel=null;
		var jbeli_posting_2excel=null;
		var jbeli_tglposting_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_beli_DataStore.baseParams.query!==null){searchquery = jurnal_beli_DataStore.baseParams.query;}
		if(jurnal_beli_DataStore.baseParams.jbeli_tanggal!==""){jbeli_tanggal_2excel_date = jurnal_beli_DataStore.baseParams.jbeli_tanggal;}
		if(jurnal_beli_DataStore.baseParams.jbeli_akun!==null){jbeli_akun_2excel = jurnal_beli_DataStore.baseParams.jbeli_akun;}
		if(jurnal_beli_DataStore.baseParams.jbeli_keterangan!==null){jbeli_keterangan_2excel = jurnal_beli_DataStore.baseParams.jbeli_keterangan;}
		if(jurnal_beli_DataStore.baseParams.jbeli_nilai!==null){jbeli_nilai_2excel = jurnal_beli_DataStore.baseParams.jbeli_nilai;}
		if(jurnal_beli_DataStore.baseParams.jbeli_ref!==null){jbeli_ref_2excel = jurnal_beli_DataStore.baseParams.jbeli_ref;}
		if(jurnal_beli_DataStore.baseParams.jbeli_penerima!==null){jbeli_penerima_2excel = jurnal_beli_DataStore.baseParams.jbeli_penerima;}
		if(jurnal_beli_DataStore.baseParams.jbeli_posting!==null){jbeli_posting_2excel = jurnal_beli_DataStore.baseParams.jbeli_posting;}
		if(jurnal_beli_DataStore.baseParams.jbeli_tglposting!==""){jbeli_tglposting_2excel_date = jurnal_beli_DataStore.baseParams.jbeli_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_beli&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
		  	jbeli_tanggal : jbeli_tanggal_2excel_date, 
			jbeli_akun : jbeli_akun_2excel,
			jbeli_keterangan : jbeli_keterangan_2excel,
			jbeli_nilai : jbeli_nilai_2excel,
			jbeli_ref : jbeli_ref_2excel,
			jbeli_penerima : jbeli_penerima_2excel,
			jbeli_posting : jbeli_posting_2excel,
		  	jbeli_tglposting : jbeli_tglposting_2excel_date, 
		  	currentlisting: jurnal_beli_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_jurnal_beli"></div>
         <div id="fp_jurnal_beli_detail"></div>
		<div id="elwindow_jurnal_beli_create"></div>
        <div id="elwindow_jurnal_beli_search"></div>
    </div>
</div>
</body>