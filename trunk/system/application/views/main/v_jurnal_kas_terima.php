<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal_kas_terima View
	+ Description	: For record view
	+ Filename 		: v_jurnal_kas_terima.php
 	+ Author  		: 
 	+ Created on 03/Oct/2009 13:10:15
	
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
var jurnal_kas_terima_DataStore;
var jurnal_kas_terima_ColumnModel;
var jurnal_kas_terimaListEditorGrid;
var jurnal_kas_terima_createForm;
var jurnal_kas_terima_createWindow;
var jurnal_kas_terima_searchForm;
var jurnal_kas_terima_searchWindow;
var jurnal_kas_terima_SelectedRow;
var jurnal_kas_terima_ContextMenu;
//for detail data
var jurnal_kas_terima_detail_DataStor;
var jurnal_kas_terima_detailListEditorGrid;
var jurnal_kas_terima_detail_ColumnModel;
var jurnal_kas_terima_detail_proxy;
var jurnal_kas_terima_detail_writer;
var jurnal_kas_terima_detail_reader;
var editor_jurnal_kas_terima_detail;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var today=new Date().format('Y-m-d');

/* declare variable here for Field*/
var jmkas_idField;
var jmkas_akunField;
var jmkas_tanggalField;
var jmkas_keteranganField;
var jmkas_nilaiField;
var jmkas_asalField;
var jmkas_refField;
var jmkas_postingField;
var jmkas_tglpostingField;
var jmkas_idSearchField;
var jmkas_akunSearchField;
var jmkas_tanggalSearchField;
var jmkas_keteranganSearchField;
var jmkas_nilaiSearchField;
var jmkas_asalSearchField;
var jmkas_refSearchField;
var jmkas_postingSearchField;
var jmkas_tglpostingSearchField;


/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function jurnal_kas_terima_update(oGrid_event){
		var jmkas_id_update_pk="";
		var jmkas_akun_update=null;
		var jmkas_tanggal_update_date="";
		var jmkas_keterangan_update=null;
		var jmkas_nilai_update=null;
		var jmkas_asal_update=null;
		var jmkas_ref_update=null;
		var jmkas_posting_update=null;
		var jmkas_tglposting_update_date="";

		jmkas_id_update_pk = oGrid_event.record.data.jmkas_id;
		if(oGrid_event.record.data.jmkas_akun!== null){jmkas_akun_update = oGrid_event.record.data.jmkas_akun;}
	 	if(oGrid_event.record.data.jmkas_tanggal!== ""){jmkas_tanggal_update_date =oGrid_event.record.data.jmkas_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.jmkas_keterangan!== null){jmkas_keterangan_update = oGrid_event.record.data.jmkas_keterangan;}
		if(oGrid_event.record.data.jmkas_nilai!== null){jmkas_nilai_update = oGrid_event.record.data.jmkas_nilai;}
		if(oGrid_event.record.data.jmkas_asal!== null){jmkas_asal_update = oGrid_event.record.data.jmkas_asal;}
		if(oGrid_event.record.data.jmkas_ref!== null){jmkas_ref_update = oGrid_event.record.data.jmkas_ref;}
		if(oGrid_event.record.data.jmkas_posting!== null){jmkas_posting_update = oGrid_event.record.data.jmkas_posting;}
	 	if(oGrid_event.record.data.jmkas_tglposting!== ""){jmkas_tglposting_update_date =oGrid_event.record.data.jmkas_tglposting.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_kas_terima&m=get_action',
			params: {
				task				: "UPDATE",
				jmkas_id			: jmkas_id_update_pk, 
				jmkas_akun			: jmkas_akun_update,  
				jmkas_tanggal		: jmkas_tanggal_update_date, 
				jmkas_keterangan	: jmkas_keterangan_update,  
				jmkas_nilai			: jmkas_nilai_update,  
				jmkas_asal			: jmkas_asal_update,  
				jmkas_ref			: jmkas_ref_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						jurnal_kas_terima_DataStore.commitChanges();
						jurnal_kas_terima_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the jurnal_kas_terima.',
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
	function jurnal_kas_terima_create(){
		if(jmkas_dtotal_nilaiField.getValue()==jmkas_nilaiField.getValue()){
			if(is_jurnal_kas_terima_form_valid()){	
			var jmkas_id_create_pk=null; 
			var jmkas_akun_create=null; 
			var jmkas_tanggal_create_date=""; 
			var jmkas_keterangan_create=null; 
			var jmkas_nilai_create=null; 
			var jmkas_asal_create=null; 
			var jmkas_ref_create=null; 
			var jmkas_posting_create=null; 
			var jmkas_tglposting_create_date=""; 
	
			if(jmkas_idField.getValue()!== null){jmkas_id_create_pk = jmkas_idField.getValue();}else{jmkas_id_create_pk=get_pk_id();} 
			if(jmkas_akunField.getValue()!== null){jmkas_akun_create = jmkas_akunField.getValue();} 
			if(jmkas_tanggalField.getValue()!== ""){jmkas_tanggal_create_date = jmkas_tanggalField.getValue().format('Y-m-d');} 
			if(jmkas_keteranganField.getValue()!== null){jmkas_keterangan_create = jmkas_keteranganField.getValue();} 
			if(jmkas_nilaiField.getValue()!== null){jmkas_nilai_create = jmkas_nilaiField.getValue();} 
			if(jmkas_asalField.getValue()!== null){jmkas_asal_create = jmkas_asalField.getValue();} 
			if(jmkas_refField.getValue()!== null){jmkas_ref_create = jmkas_refField.getValue();} 
			if(jmkas_postingField.getValue()!== null){jmkas_posting_create = jmkas_postingField.getValue();} 
			if(jmkas_tglpostingField.getValue()!== ""){jmkas_tglposting_create_date = jmkas_tglpostingField.getValue().format('Y-m-d');} 
	
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_kas_terima&m=get_action',
				params: {
					task				: post2db,
					jmkas_id			: jmkas_id_create_pk, 
					jmkas_akun			: jmkas_akun_create, 
					jmkas_tanggal		: jmkas_tanggal_create_date, 
					jmkas_keterangan	: jmkas_keterangan_create, 
					jmkas_nilai			: jmkas_nilai_create, 
					jmkas_asal			: jmkas_asal_create, 
					jmkas_ref			: jmkas_ref_create
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							jurnal_kas_terima_detail_purge()
							Ext.MessageBox.alert(post2db+' OK','Jurnal terima kas berhasil disimpan !');
							jurnal_kas_terima_DataStore.reload();
							jurnal_kas_terima_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'Maaf, jurnal terima kas gagal disimpan.',
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
			return jurnal_kas_terimaListEditorGrid.getSelectionModel().getSelected().get('jmkas_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jurnal_kas_terima_reset_form(){
		jmkas_idField.reset();
		jmkas_idField.setValue(null);
		jmkas_akunField.reset();
		jmkas_akunField.setValue(null);
		jmkas_tanggalField.reset();
		jmkas_tanggalField.setValue(null);
		jmkas_keteranganField.reset();
		jmkas_keteranganField.setValue(null);
		jmkas_nilaiField.reset();
		jmkas_nilaiField.setValue(null);
		jmkas_asalField.reset();
		jmkas_asalField.setValue(null);
		jmkas_refField.reset();
		jmkas_refField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jurnal_kas_terima_set_form(){
		jmkas_idField.setValue(jurnal_kas_terimaListEditorGrid.getSelectionModel().getSelected().get('jmkas_id'));
		jmkas_akunField.setValue(jurnal_kas_terimaListEditorGrid.getSelectionModel().getSelected().get('jmkas_akun'));
		jmkas_tanggalField.setValue(jurnal_kas_terimaListEditorGrid.getSelectionModel().getSelected().get('jmkas_tanggal'));
		jmkas_keteranganField.setValue(jurnal_kas_terimaListEditorGrid.getSelectionModel().getSelected().get('jmkas_keterangan'));
		jmkas_nilaiField.setValue(jurnal_kas_terimaListEditorGrid.getSelectionModel().getSelected().get('jmkas_nilai'));
		jmkas_asalField.setValue(jurnal_kas_terimaListEditorGrid.getSelectionModel().getSelected().get('jmkas_asal'));
		jmkas_refField.setValue(jurnal_kas_terimaListEditorGrid.getSelectionModel().getSelected().get('jmkas_ref'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jurnal_kas_terima_form_valid(){
		return (jmkas_akunField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jurnal_kas_terima_createWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			jurnal_kas_terima_reset_form();
			jurnal_kas_terima_createWindow.show();
		} else {
			jurnal_kas_terima_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jurnal_kas_terima_confirm_delete(){
		// only one jurnal_kas_terima is selected here
		if(jurnal_kas_terimaListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_kas_terima_delete);
		} else if(jurnal_kas_terimaListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_kas_terima_delete);
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
	function jurnal_kas_terima_confirm_update(){
		/* only one record is selected here */
		if(jurnal_kas_terimaListEditorGrid.selModel.getCount() == 1) {
			jurnal_kas_terima_set_form();
			post2db='UPDATE';
			jurnal_kas_terima_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			jurnal_kas_terima_createWindow.show();
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
	function jurnal_kas_terima_delete(btn){
		if(btn=='yes'){
			var selections = jurnal_kas_terimaListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jurnal_kas_terimaListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jmkas_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jurnal_kas_terima&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jurnal_kas_terima_DataStore.reload();
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
	jurnal_kas_terima_DataStore = new Ext.data.Store({
		id: 'jurnal_kas_terima_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_kas_terima&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jmkas_id'
		},[
		/* dataIndex => insert intojurnal_kas_terima_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jmkas_id', type: 'int', mapping: 'jmkas_id'}, 
			{name: 'jmkas_akun', type: 'int', mapping: 'jmkas_akun'}, 
			{name: 'jmkas_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jmkas_tanggal'}, 
			{name: 'jmkas_keterangan', type: 'string', mapping: 'jmkas_keterangan'}, 
			{name: 'jmkas_nilai', type: 'float', mapping: 'jmkas_nilai'}, 
			{name: 'jmkas_asal', type: 'string', mapping: 'jmkas_asal'}, 
			{name: 'jmkas_ref', type: 'int', mapping: 'jmkas_ref'}, 
			{name: 'jmkas_posting', type: 'string', mapping: 'jmkas_posting'}, 
			{name: 'jmkas_tglposting', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jmkas_tglposting'}, 
			{name: 'jmkas_creator', type: 'string', mapping: 'jmkas_creator'}, 
			{name: 'jmkas_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'jmkas_date_create'}, 
			{name: 'jmkas_update', type: 'string', mapping: 'jmkas_update'}, 
			{name: 'jmkas_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'jmkas_date_update'}, 
			{name: 'jmkas_revised', type: 'int', mapping: 'jmkas_revised'} 
		]),
		sortInfo:{field: 'jmkas_id', direction: "DESC"}
	});
	/* End of Function */
	
	/* GET detail akun */
	cbo_jmkas_akunDataStore = new Ext.data.Store({
		id: 'cbo_jmkas_akunDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_kas_terima&m=get_akun_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: 10}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'jmkas_akun_value', type: 'int', mapping: 'akun_id'},
			{name: 'jmkas_akun_nama', type: 'string', mapping: 'akun_nama'},
			{name: 'jmkas_akun_kode', type: 'string', mapping: 'akun_kode'}
		]),
		sortInfo:{field: 'jmkas_akun_nama', direction: "ASC"}
	});
	/* END akun datasource */
	cbo_jmkas_akunDataStore.load();
	var jmkas_akun_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{jmkas_akun_nama}</b><br /></span>',
            'Kode Akun: {jmkas_akun_kode}',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	jurnal_kas_terima_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'jmkas_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Akun',
			dataIndex: 'jmkas_akun',
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
			dataIndex: 'jmkas_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'jmkas_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Nilai',
			dataIndex: 'jmkas_nilai',
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
			header: 'Asal',
			dataIndex: 'jmkas_asal',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 255
          	})
		}, 
		{
			header: 'Ref',
			dataIndex: 'jmkas_ref',
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
			header: 'Posting',
			dataIndex: 'jmkas_posting',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['jmkas_posting_value', 'jmkas_posting_display'],
					data: [['T','T'],['Y','Y']]
					}),
				mode: 'local',
               	displayField: 'jmkas_posting_display',
               	valueField: 'jmkas_posting_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Tglposting',
			dataIndex: 'jmkas_tglposting',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Creator',
			dataIndex: 'jmkas_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'jmkas_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'jmkas_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'jmkas_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'jmkas_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	jurnal_kas_terima_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	jurnal_kas_terimaListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_kas_terimaListEditorGrid',
		el: 'fp_jurnal_kas_terima',
		title: 'List Of Jurnal_kas_terima',
		autoHeight: true,
		store: jurnal_kas_terima_DataStore, // DataStore
		cm: jurnal_kas_terima_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_kas_terima_DataStore,
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
			handler: jurnal_kas_terima_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jurnal_kas_terima_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jurnal_kas_terima_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jurnal_kas_terima_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_kas_terima_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_kas_terima_print  
		}
		]
	});
	jurnal_kas_terimaListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jurnal_kas_terima_ContextMenu = new Ext.menu.Menu({
		id: 'jurnal_kas_terima_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jurnal_kas_terima_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jurnal_kas_terima_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: jurnal_kas_terima_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: jurnal_kas_terima_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjurnal_kas_terima_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jurnal_kas_terima_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jurnal_kas_terima_SelectedRow=rowIndex;
		jurnal_kas_terima_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jurnal_kas_terima_editContextMenu(){
		jurnal_kas_terimaListEditorGrid.startEditing(jurnal_kas_terima_SelectedRow,1);
  	}
	/* End of Function */
  	
	jurnal_kas_terimaListEditorGrid.addListener('rowcontextmenu', onjurnal_kas_terima_ListEditGridContextMenu);
	jurnal_kas_terima_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	jurnal_kas_terimaListEditorGrid.on('afteredit', jurnal_kas_terima_update); // inLine Editing Record
	
	/* Identify  jmkas_id Field */
	jmkas_idField= new Ext.form.NumberField({
		id: 'jmkas_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jmkas_akun Field */
	jmkas_akunField= new Ext.form.ComboBox({
		id: 'jmkas_akunField',
		fieldLabel: 'Akun',
		store: cbo_jmkas_akunDataStore,
		displayField:'jmkas_akun_nama',
		mode : 'remote',
		valueField: 'jmkas_akun_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: jmkas_akun_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '50%'
	});
	/* Identify  jmkas_tanggal Field */
	jmkas_tanggalField= new Ext.form.DateField({
		id: 'jmkas_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		disabled: true
	});
	/* Identify  jmkas_keterangan Field */
	jmkas_keteranganField= new Ext.form.TextArea({
		id: 'jmkas_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  jmkas_nilai Field */
	jmkas_nilaiField= new Ext.form.NumberField({
		id: 'jmkas_nilaiField',
		fieldLabel: 'Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jmkas_asal Field */
	jmkas_asalField= new Ext.form.TextField({
		id: 'jmkas_asalField',
		fieldLabel: 'Asal',
		maxLength: 255,
		anchor: '95%'
	});
	/* Identify  jmkas_ref Field */
	jmkas_refField= new Ext.form.NumberField({
		id: 'jmkas_refField',
		fieldLabel: 'Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jmkas_posting Field */
	jmkas_postingField= new Ext.form.ComboBox({
		id: 'jmkas_postingField',
		fieldLabel: 'Posting',
		store:new Ext.data.SimpleStore({
			fields:['jmkas_posting_value', 'jmkas_posting_display'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jmkas_posting_display',
		valueField: 'jmkas_posting_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  jmkas_tglposting Field */
	jmkas_tglpostingField= new Ext.form.DateField({
		id: 'jmkas_tglpostingField',
		fieldLabel: 'Tglposting',
		format : 'Y-m-d',
	});
	jmkas_dtotal_nilaiField= new Ext.form.NumberField({
		id: 'jmkas_dtotal_nilaiField',
		fieldLabel: 'Detail Total Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	/*Fieldset Master*/
	jurnal_kas_terima_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jmkas_tanggalField, jmkas_akunField, jmkas_keteranganField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [jmkas_nilaiField, jmkas_asalField, jmkas_refField, jmkas_idField] 
			}
			]
	
	});
	
	jurnal_mkas_dtotal_nilaiGroup = new Ext.form.FieldSet({
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
				items: [jmkas_dtotal_nilaiField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var jurnal_kas_terima_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'djmkas_id', type: 'int', mapping: 'djmkas_id'}, 
			{name: 'djmkas_master', type: 'int', mapping: 'djmkas_master'}, 
			{name: 'djmkas_akun', type: 'int', mapping: 'djmkas_akun'}, 
			{name: 'djmkas_keterangan', type: 'string', mapping: 'djmkas_keterangan'}, 
			{name: 'djmkas_nilai', type: 'float', mapping: 'djmkas_nilai'} 
	]);
	//eof
	
	//function for json writer of detail
	var jurnal_kas_terima_detail_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	jurnal_kas_terima_detail_DataStore = new Ext.data.Store({
		id: 'jurnal_kas_terima_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal_kas_terima&m=detail_jurnal_kas_terima_detail_list', 
			method: 'POST'
		}),
		reader: jurnal_kas_terima_detail_reader,
		baseParams:{master_id: jmkas_idField.getValue()},
		sortInfo:{field: 'djmkas_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_jurnal_kas_terima_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_djmkas_akun=new Ext.form.ComboBox({
			store: cbo_jmkas_akunDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'jmkas_akun_nama',
			valueField: 'jmkas_akun_value',
			triggerAction: 'all',
			lazyRender:true

	});
	
	//declaration of detail coloumn model
	jurnal_kas_terima_detail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Akun',
			dataIndex: 'djmkas_akun',
			width: 150,
			sortable: true,
			editor: combo_djmkas_akun,
			renderer: Ext.util.Format.comboRenderer(combo_djmkas_akun)
		},
		{
			header: 'Keterangan',
			dataIndex: 'djmkas_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Nilai',
			dataIndex: 'djmkas_nilai',
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
	jurnal_kas_terima_detail_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	jurnal_kas_terima_detailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnal_kas_terima_detailListEditorGrid',
		el: 'fp_jurnal_kas_terima_detail',
		title: 'Detail jurnal_kas_terima_detail',
		height: 250,
		width: 690,
		autoScroll: true,
		store: jurnal_kas_terima_detail_DataStore, // DataStore
		colModel: jurnal_kas_terima_detail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_jurnal_kas_terima_detail],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_kas_terima_detail_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: jurnal_kas_terima_detail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: jurnal_kas_terima_detail_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function jurnal_kas_terima_detail_add(){
		var edit_jurnal_kas_terima_detail= new jurnal_kas_terima_detailListEditorGrid.store.recordType({
			djmkas_id	:'',		
			djmkas_master	:'',		
			djmkas_akun	:'',		
			djmkas_keterangan	:'',		
			djmkas_nilai	:''		
		});
		editor_jurnal_kas_terima_detail.stopEditing();
		jurnal_kas_terima_detail_DataStore.insert(0, edit_jurnal_kas_terima_detail);
		jurnal_kas_terima_detailListEditorGrid.getView().refresh();
		jurnal_kas_terima_detailListEditorGrid.getSelectionModel().selectRow(0);
		editor_jurnal_kas_terima_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_jurnal_kas_terima_detail(){
		jurnal_kas_terima_detail_DataStore.commitChanges();
		jurnal_kas_terima_detailListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function jurnal_kas_terima_detail_insert(){
		for(i=0;i<jurnal_kas_terima_detail_DataStore.getCount();i++){
			jurnal_kas_terima_detail_record=jurnal_kas_terima_detail_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal_kas_terima&m=detail_jurnal_kas_terima_detail_insert',
				params:{
				djmkas_id	: jurnal_kas_terima_detail_record.data.djmkas_id, 
				djmkas_master	: eval(jmkas_idField.getValue()), 
				djmkas_akun	: jurnal_kas_terima_detail_record.data.djmkas_akun, 
				djmkas_keterangan	: jurnal_kas_terima_detail_record.data.djmkas_keterangan, 
				djmkas_nilai	: jurnal_kas_terima_detail_record.data.djmkas_nilai 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function jurnal_kas_terima_detail_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal_kas_terima&m=detail_jurnal_kas_terima_detail_purge',
			params:{ master_id: eval(jmkas_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function jurnal_kas_terima_detail_confirm_delete(){
		// only one record is selected here
		if(jurnal_kas_terima_detailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', jurnal_kas_terima_detail_delete);
		} else if(jurnal_kas_terima_detailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', jurnal_kas_terima_detail_delete);
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
	function jurnal_kas_terima_detail_delete(btn){
		if(btn=='yes'){
			var s = jurnal_kas_terima_detailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				jurnal_kas_terima_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	jurnal_kas_terima_detail_DataStore.on('update', refresh_jurnal_kas_terima_detail);
	
	/* Function for retrieve create Window Panel*/ 
	jurnal_kas_terima_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [jurnal_kas_terima_masterGroup,jurnal_kas_terima_detailListEditorGrid,jurnal_mkas_dtotal_nilaiGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: jurnal_kas_terima_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					jurnal_kas_terima_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jurnal_kas_terima_createWindow= new Ext.Window({
		id: 'jurnal_kas_terima_createWindow',
		title: post2db+'Jurnal_kas_terima',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jurnal_kas_terima_create',
		items: jurnal_kas_terima_createForm
	});
	/* End Window */
	
	function detail_jmkas_dtotalnilai(){
		var total_nilai=0;
		for(i=0;i<jurnal_kas_terima_detail_DataStore.getCount();i++){
			detail_jmkas_record=jurnal_kas_terima_detail_DataStore.getAt(i);
			total_nilai=total_nilai+detail_jmkas_record.data.djmkas_nilai;
		}
		jmkas_dtotal_nilaiField.setValue(total_nilai);
	}
	
	jurnal_kas_terima_detail_DataStore.on('update',detail_jmkas_dtotalnilai);
	jurnal_kas_terima_detail_DataStore.on('load',detail_jmkas_dtotalnilai);
	
	/* Function for action list search */
	function jurnal_kas_terima_list_search(){
		// render according to a SQL date format.
		var jmkas_id_search=null;
		var jmkas_akun_search=null;
		var jmkas_tanggal_search_date="";
		var jmkas_keterangan_search=null;
		var jmkas_nilai_search=null;
		var jmkas_asal_search=null;
		var jmkas_ref_search=null;
		var jmkas_posting_search=null;
		var jmkas_tglposting_search_date="";

		if(jmkas_idSearchField.getValue()!==null){jmkas_id_search=jmkas_idSearchField.getValue();}
		if(jmkas_akunSearchField.getValue()!==null){jmkas_akun_search=jmkas_akunSearchField.getValue();}
		if(jmkas_tanggalSearchField.getValue()!==""){jmkas_tanggal_search_date=jmkas_tanggalSearchField.getValue().format('Y-m-d');}
		if(jmkas_keteranganSearchField.getValue()!==null){jmkas_keterangan_search=jmkas_keteranganSearchField.getValue();}
		if(jmkas_nilaiSearchField.getValue()!==null){jmkas_nilai_search=jmkas_nilaiSearchField.getValue();}
		if(jmkas_asalSearchField.getValue()!==null){jmkas_asal_search=jmkas_asalSearchField.getValue();}
		if(jmkas_refSearchField.getValue()!==null){jmkas_ref_search=jmkas_refSearchField.getValue();}
		if(jmkas_postingSearchField.getValue()!==null){jmkas_posting_search=jmkas_postingSearchField.getValue();}
		if(jmkas_tglpostingSearchField.getValue()!==""){jmkas_tglposting_search_date=jmkas_tglpostingSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		jurnal_kas_terima_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			jmkas_id	:	jmkas_id_search, 
			jmkas_akun	:	jmkas_akun_search, 
			jmkas_tanggal	:	jmkas_tanggal_search_date, 
			jmkas_keterangan	:	jmkas_keterangan_search, 
			jmkas_nilai	:	jmkas_nilai_search, 
			jmkas_asal	:	jmkas_asal_search, 
			jmkas_ref	:	jmkas_ref_search, 
			jmkas_posting	:	jmkas_posting_search, 
			jmkas_tglposting	:	jmkas_tglposting_search_date, 
		};
		// Cause the datastore to do another query : 
		jurnal_kas_terima_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jurnal_kas_terima_reset_search(){
		// reset the store parameters
		jurnal_kas_terima_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		jurnal_kas_terima_DataStore.reload({params: {start: 0, limit: pageS}});
		jurnal_kas_terima_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  jmkas_id Search Field */
	jmkas_idSearchField= new Ext.form.NumberField({
		id: 'jmkas_idSearchField',
		fieldLabel: 'Jmkas Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jmkas_akun Search Field */
	jmkas_akunSearchField= new Ext.form.NumberField({
		id: 'jmkas_akunSearchField',
		fieldLabel: 'Jmkas Akun',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jmkas_tanggal Search Field */
	jmkas_tanggalSearchField= new Ext.form.DateField({
		id: 'jmkas_tanggalSearchField',
		fieldLabel: 'Jmkas Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  jmkas_keterangan Search Field */
	jmkas_keteranganSearchField= new Ext.form.TextField({
		id: 'jmkas_keteranganSearchField',
		fieldLabel: 'Jmkas Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  jmkas_nilai Search Field */
	jmkas_nilaiSearchField= new Ext.form.NumberField({
		id: 'jmkas_nilaiSearchField',
		fieldLabel: 'Jmkas Nilai',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jmkas_asal Search Field */
	jmkas_asalSearchField= new Ext.form.TextField({
		id: 'jmkas_asalSearchField',
		fieldLabel: 'Jmkas Asal',
		maxLength: 255,
		anchor: '95%'
	
	});
	/* Identify  jmkas_ref Search Field */
	jmkas_refSearchField= new Ext.form.NumberField({
		id: 'jmkas_refSearchField',
		fieldLabel: 'Jmkas Ref',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  jmkas_posting Search Field */
	jmkas_postingSearchField= new Ext.form.ComboBox({
		id: 'jmkas_postingSearchField',
		fieldLabel: 'Jmkas Posting',
		store:new Ext.data.SimpleStore({
			fields:['value', 'jmkas_posting'],
			data:[['T','T'],['Y','Y']]
		}),
		mode: 'local',
		displayField: 'jmkas_posting',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  jmkas_tglposting Search Field */
	jmkas_tglpostingSearchField= new Ext.form.DateField({
		id: 'jmkas_tglpostingSearchField',
		fieldLabel: 'Jmkas Tglposting',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	jurnal_kas_terima_searchForm = new Ext.FormPanel({
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
				items: [jmkas_akunSearchField, jmkas_tanggalSearchField, jmkas_keteranganSearchField, jmkas_nilaiSearchField, jmkas_asalSearchField, jmkas_refSearchField, jmkas_postingSearchField, jmkas_tglpostingSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jurnal_kas_terima_list_search
			},{
				text: 'Close',
				handler: function(){
					jurnal_kas_terima_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	jurnal_kas_terima_searchWindow = new Ext.Window({
		title: 'jurnal_kas_terima Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jurnal_kas_terima_search',
		items: jurnal_kas_terima_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jurnal_kas_terima_searchWindow.isVisible()){
			jurnal_kas_terima_searchWindow.show();
		} else {
			jurnal_kas_terima_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jurnal_kas_terima_print(){
		var searchquery = "";
		var jmkas_akun_print=null;
		var jmkas_tanggal_print_date="";
		var jmkas_keterangan_print=null;
		var jmkas_nilai_print=null;
		var jmkas_asal_print=null;
		var jmkas_ref_print=null;
		var jmkas_posting_print=null;
		var jmkas_tglposting_print_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_kas_terima_DataStore.baseParams.query!==null){searchquery = jurnal_kas_terima_DataStore.baseParams.query;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_akun!==null){jmkas_akun_print = jurnal_kas_terima_DataStore.baseParams.jmkas_akun;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_tanggal!==""){jmkas_tanggal_print_date = jurnal_kas_terima_DataStore.baseParams.jmkas_tanggal;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_keterangan!==null){jmkas_keterangan_print = jurnal_kas_terima_DataStore.baseParams.jmkas_keterangan;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_nilai!==null){jmkas_nilai_print = jurnal_kas_terima_DataStore.baseParams.jmkas_nilai;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_asal!==null){jmkas_asal_print = jurnal_kas_terima_DataStore.baseParams.jmkas_asal;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_ref!==null){jmkas_ref_print = jurnal_kas_terima_DataStore.baseParams.jmkas_ref;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_posting!==null){jmkas_posting_print = jurnal_kas_terima_DataStore.baseParams.jmkas_posting;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_tglposting!==""){jmkas_tglposting_print_date = jurnal_kas_terima_DataStore.baseParams.jmkas_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_kas_terima&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jmkas_akun : jmkas_akun_print,
		  	jmkas_tanggal : jmkas_tanggal_print_date, 
			jmkas_keterangan : jmkas_keterangan_print,
			jmkas_nilai : jmkas_nilai_print,
			jmkas_asal : jmkas_asal_print,
			jmkas_ref : jmkas_ref_print,
			jmkas_posting : jmkas_posting_print,
		  	jmkas_tglposting : jmkas_tglposting_print_date, 
		  	currentlisting: jurnal_kas_terima_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./jurnal_kas_terimalist.html','jurnal_kas_terimalist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function jurnal_kas_terima_export_excel(){
		var searchquery = "";
		var jmkas_akun_2excel=null;
		var jmkas_tanggal_2excel_date="";
		var jmkas_keterangan_2excel=null;
		var jmkas_nilai_2excel=null;
		var jmkas_asal_2excel=null;
		var jmkas_ref_2excel=null;
		var jmkas_posting_2excel=null;
		var jmkas_tglposting_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(jurnal_kas_terima_DataStore.baseParams.query!==null){searchquery = jurnal_kas_terima_DataStore.baseParams.query;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_akun!==null){jmkas_akun_2excel = jurnal_kas_terima_DataStore.baseParams.jmkas_akun;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_tanggal!==""){jmkas_tanggal_2excel_date = jurnal_kas_terima_DataStore.baseParams.jmkas_tanggal;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_keterangan!==null){jmkas_keterangan_2excel = jurnal_kas_terima_DataStore.baseParams.jmkas_keterangan;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_nilai!==null){jmkas_nilai_2excel = jurnal_kas_terima_DataStore.baseParams.jmkas_nilai;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_asal!==null){jmkas_asal_2excel = jurnal_kas_terima_DataStore.baseParams.jmkas_asal;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_ref!==null){jmkas_ref_2excel = jurnal_kas_terima_DataStore.baseParams.jmkas_ref;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_posting!==null){jmkas_posting_2excel = jurnal_kas_terima_DataStore.baseParams.jmkas_posting;}
		if(jurnal_kas_terima_DataStore.baseParams.jmkas_tglposting!==""){jmkas_tglposting_2excel_date = jurnal_kas_terima_DataStore.baseParams.jmkas_tglposting;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal_kas_terima&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			jmkas_akun : jmkas_akun_2excel,
		  	jmkas_tanggal : jmkas_tanggal_2excel_date, 
			jmkas_keterangan : jmkas_keterangan_2excel,
			jmkas_nilai : jmkas_nilai_2excel,
			jmkas_asal : jmkas_asal_2excel,
			jmkas_ref : jmkas_ref_2excel,
			jmkas_posting : jmkas_posting_2excel,
		  	jmkas_tglposting : jmkas_tglposting_2excel_date, 
		  	currentlisting: jurnal_kas_terima_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_jurnal_kas_terima"></div>
         <div id="fp_jurnal_kas_terima_detail"></div>
		<div id="elwindow_jurnal_kas_terima_create"></div>
        <div id="elwindow_jurnal_kas_terima_search"></div>
    </div>
</div>
</body>