<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: akun View
	+ Description	: For record view
	+ Filename 		: v_akun.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 16/Jul/2009 14:18:30
	
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
var akun_DataStore;
var akun_ColumnModel;
var akunListEditorGrid;
var akun_createForm;
var akun_createWindow;
var akun_searchForm;
var akun_searchWindow;
var akun_SelectedRow;
var akun_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var akun_idField;
var akun_kodeField;
var akun_namaField;
var akun_parentField;
var akun_neracaField;
var akun_rugilabaField;
var akun_debetField;
var akun_kreditField;
var akun_saldoField;
var akun_keteranganField;
var akun_aktifField;

var akun_idSearchField;
var akun_kodeSearchField;
var akun_namaSearchField;
var akun_parentSearchField;
var akun_neracaSearchField;
var akun_rugilabaSearchField;
var akun_debetSearchField;
var akun_kreditSearchField;
var akun_saldoSearchField;
var akun_keteranganSearchField;
var akun_aktifSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function akun_update(oGrid_event){
	var akun_id_update_pk="";
	var akun_kode_update=null;
	var akun_nama_update=null;
	var akun_parent_update=null;
	var akun_neraca_update=null;
	var akun_rugilaba_update=null;
	var akun_debet_update=null;
	var akun_kredit_update=null;
	var akun_saldo_update=null;
	var akun_keterangan_update=null;
	var akun_aktif_update=null;

	akun_id_update_pk = get_pk_id();
	if(oGrid_event.record.data.akun_kode!== null){akun_kode_update = oGrid_event.record.data.akun_kode;}
	if(oGrid_event.record.data.akun_nama!== null){akun_nama_update = oGrid_event.record.data.akun_nama;}
	if(oGrid_event.record.data.akun_parent!== null){akun_parent_update = oGrid_event.record.data.akun_parent;}
	if(oGrid_event.record.data.akun_neraca!== null){akun_neraca_update = oGrid_event.record.data.akun_neraca;}
	if(oGrid_event.record.data.akun_rugilaba!== null){akun_rugilaba_update = oGrid_event.record.data.akun_rugilaba;}
	if(oGrid_event.record.data.akun_debet!== null){akun_debet_update = oGrid_event.record.data.akun_debet;}
	if(oGrid_event.record.data.akun_kredit!== null){akun_kredit_update = oGrid_event.record.data.akun_kredit;}
	if(oGrid_event.record.data.akun_saldo!== null){akun_saldo_update = oGrid_event.record.data.akun_saldo;}
	if(oGrid_event.record.data.akun_keterangan!== null){akun_keterangan_update = oGrid_event.record.data.akun_keterangan;}
	if(oGrid_event.record.data.akun_aktif!== null){akun_aktif_update = oGrid_event.record.data.akun_aktif;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_akun&m=get_action',
			params: {
				task: "UPDATE",
				akun_id	: get_pk_id(),				
				akun_kode	:akun_kode_update,		
				akun_nama	:akun_nama_update,		
				akun_parent	:akun_parent_update,		
				akun_neraca	:akun_neraca_update,		
				akun_rugilaba	:akun_rugilaba_update,		
				akun_debet	:akun_debet_update,		
				akun_kredit	:akun_kredit_update,		
				akun_saldo	:akun_saldo_update,		
				akun_keterangan	:akun_keterangan_update,		
				akun_aktif	:akun_aktif_update	
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						akun_DataStore.commitChanges();
						akun_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the akun.',
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
	function akun_create(){
		if(is_akun_form_valid()){
		
		var akun_id_create_pk=null;
		var akun_kode_create=null;
		var akun_nama_create=null;
		var akun_parent_create=null;
		var akun_neraca_create=null;
		var akun_rugilaba_create=null;
		var akun_debet_create=null;
		var akun_kredit_create=null;
		var akun_saldo_create=null;
		var akun_keterangan_create=null;
		var akun_aktif_create=null;

		akun_id_create_pk=get_pk_id();
		if(akun_kodeField.getValue()!== null){akun_kode_create = akun_kodeField.getValue();}
		if(akun_namaField.getValue()!== null){akun_nama_create = akun_namaField.getValue();}
		if(akun_parentField.getValue()!== null){akun_parent_create = akun_parentField.getValue();}
		if(akun_neracaField.getValue()!== null){akun_neraca_create = akun_neracaField.getValue();}
		if(akun_rugilabaField.getValue()!== null){akun_rugilaba_create = akun_rugilabaField.getValue();}
		if(akun_debetField.getValue()!== null){akun_debet_create = akun_debetField.getValue();}
		if(akun_kreditField.getValue()!== null){akun_kredit_create = akun_kreditField.getValue();}
		if(akun_saldoField.getValue()!== null){akun_saldo_create = akun_saldoField.getValue();}
		if(akun_keteranganField.getValue()!== null){akun_keterangan_create = akun_keteranganField.getValue();}
		if(akun_aktifField.getValue()!== null){akun_aktif_create = akun_aktifField.getValue();}

		Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_akun&m=get_action',
				params: {
					task: post2db,
					akun_id	: akun_id_create_pk,	
					akun_kode	: akun_kode_create,	
					akun_nama	: akun_nama_create,	
					akun_parent	: akun_parent_create,	
					akun_neraca	: akun_neraca_create,	
					akun_rugilaba	: akun_rugilaba_create,	
					akun_debet	: akun_debet_create,	
					akun_kredit	: akun_kredit_create,	
					akun_saldo	: akun_saldo_create,	
					akun_keterangan	: akun_keterangan_create,	
					akun_aktif	: akun_aktif_create
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Akun was '+msg+' successfully.');
							akun_DataStore.reload();
							akun_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Akun.',
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
			return akunListEditorGrid.getSelectionModel().getSelected().get('akun_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function akun_reset_form(){
		akun_kodeField.reset();
		akun_kodeField.setValue(null);
		akun_namaField.reset();
		akun_namaField.setValue(null);
		akun_parentField.reset();
		akun_parentField.setValue(null);
		akun_neracaField.reset();
		akun_neracaField.setValue(null);
		akun_rugilabaField.reset();
		akun_rugilabaField.setValue(null);
		akun_debetField.reset();
		akun_debetField.setValue(null);
		akun_kreditField.reset();
		akun_kreditField.setValue(null);
		akun_saldoField.reset();
		akun_saldoField.setValue(null);
		akun_keteranganField.reset();
		akun_keteranganField.setValue(null);
		akun_aktifField.reset();
		akun_aktifField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function akun_set_form(){
		akun_kodeField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_kode'));
		akun_namaField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_nama'));
		akun_parentField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_parent'));
		akun_neracaField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_neraca'));
		akun_rugilabaField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_rugilaba'));
		akun_debetField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_debet'));
		akun_kreditField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_kredit'));
		akun_saldoField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_saldo'));
		akun_keteranganField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_keterangan'));
		akun_aktifField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_aktif'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_akun_form_valid(){
		return ( akun_kodeField.isValid() && akun_namaField.isValid() &&  akun_debetField.isValid() && akun_kreditField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!akun_createWindow.isVisible()){
			akun_reset_form();
			post2db='CREATE';
			msg='created';
			cbo_akun_kodeDataStore.reload();
			akun_createWindow.show();
		} else {
			akun_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function akun_confirm_delete(){
		// only one akun is selected here
		if(akunListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', akun_delete);
		} else if(akunListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', akun_delete);
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
	function akun_confirm_update(){
		/* only one record is selected here */
		if(akunListEditorGrid.selModel.getCount() == 1) {
			akun_set_form();
			post2db='UPDATE';
			msg='updated';
			cbo_akun_kodeDataStore.reload();
			akun_createWindow.show();
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
	function akun_delete(btn){
		if(btn=='yes'){
			var selections = akunListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< akunListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.akun_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_akun&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							akun_DataStore.reload();
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
	akun_DataStore = new Ext.data.Store({
		id: 'akun_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_akun&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intoakun_ColumnModel, Mapping => for initiate table column */ 
			{name: 'akun_id', type: 'int', mapping: 'akun_id'},
			{name: 'akun_kode', type: 'string', mapping: 'akun_kode'},
			{name: 'akun_nama', type: 'string', mapping: 'akun_nama'},
			{name: 'akun_parent', type: 'string', mapping: 'nama_parent'},
			{name: 'akun_neraca', type: 'string', mapping: 'akun_neraca'},
			{name: 'akun_rugilaba', type: 'string', mapping: 'akun_rugilaba'},
			{name: 'akun_debet', type: 'string', mapping: 'akun_debet'},
			{name: 'akun_kredit', type: 'string', mapping: 'akun_kredit'},
			{name: 'akun_saldo', type: 'float', mapping: 'akun_saldo'},
			{name: 'akun_keterangan', type: 'string', mapping: 'akun_keterangan'},
			{name: 'akun_aktif', type: 'string', mapping: 'akun_aktif'},
			{name: 'akun_creator', type: 'string', mapping: 'akun_creator'},
			{name: 'akun_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'akun_date_create'},
			{name: 'akun_update', type: 'string', mapping: 'akun_update'},
			{name: 'akun_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'akun_date_update'},
			{name: 'akun_revised', type: 'int', mapping: 'akun_revised'}
		]),
		sortInfo:{field: 'akun_id', direction: "ASC"}
	});
	/* End of Function */
	
	cbo_akun_kodeDataStore = new Ext.data.Store({
		id: 'cbo_akun_kodeDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_akun&m=get_akun_kode_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'akun_kode_value', type: 'string', mapping: 'akun_id'},
			{name: 'akun_kode_display', type: 'string', mapping: 'akun_nama'}
		]),
		sortInfo:{field: 'akun_kode_value', direction: "ASC"}
	});
    
  	/* Function for Identify of Window Column Model */
	akun_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'akun_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Kode',
			dataIndex: 'akun_kode',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 20
          	})
		},
		{
			header: 'Nama',
			dataIndex: 'akun_nama',
			width: 250,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Induk',
			dataIndex: 'akun_parent',
			width: 250,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: cbo_akun_kodeDataStore,
				mode: 'local',
				displayField: 'akun_kode_display',
				valueField: 'akun_kode_value',
				allowBlank: true,
				triggerAction: 'all'
			})
		},
		{
			header: 'Neraca ?',
			dataIndex: 'akun_neraca',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['akun_neraca_value', 'akun_neraca_display'],
					data: [['Y','Y'],['T','T']]
					}),
				mode: 'local',
               	displayField: 'akun_neraca_display',
               	valueField: 'akun_neraca_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Laba/Rugi ?',
			dataIndex: 'akun_rugilaba',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['akun_rugilaba_value', 'akun_rugilaba_display'],
					data: [['Y','Y'],['T','T']]
					}),
				mode: 'local',
               	displayField: 'akun_rugilaba_display',
               	valueField: 'akun_rugilaba_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Debet',
			dataIndex: 'akun_debet',
			width: 100,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['akun_debet_value', 'akun_debet_display'],
					data: [['+','+'],['-','-']]
					}),
				mode: 'local',
               	displayField: 'akun_debet_display',
               	valueField: 'akun_debet_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Kredit',
			dataIndex: 'akun_kredit',
			width: 100,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['akun_kredit_value', 'akun_kredit_display'],
					data: [['+','+'],['-','-']]
					}),
				mode: 'local',
               	displayField: 'akun_kredit_display',
               	valueField: 'akun_kredit_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Nilai Saldo',
			dataIndex: 'akun_saldo',
			width: 250,
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
			header: 'Keterangan',
			dataIndex: 'akun_keterangan',
			width: 150,
			sortable: true,
			hidden: true,
			editor: new Ext.form.TextField({
				allowBlank: true,
				maxLength: 500
			})
		},
		{
			header: 'Status',
			dataIndex: 'akun_aktif',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['akun_aktif_value', 'akun_aktif_display'],
					data: [['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
					}),
				mode: 'local',
               	displayField: 'akun_aktif_display',
               	valueField: 'akun_aktif_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Creator',
			dataIndex: 'akun_creator',
			width: 150,
			sortable: true,
			hidden: true
		},
		{
			header: 'Create on',
			dataIndex: 'akun_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true
		},
		{
			header: 'Last Update by',
			dataIndex: 'akun_update',
			width: 150,
			sortable: true,
			hidden: true
		},
		{
			header: 'Last Update on',
			dataIndex: 'akun_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true
		},
		{
			header: 'Revised',
			dataIndex: 'akun_revised',
			width: 150,
			sortable: true,
			hidden: true
		}]
	);
	akun_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	akunListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'akunListEditorGrid',
		el: 'fp_akun',
		title: 'List Of Akun',
		autoHeight: true,
		store: akun_DataStore, // DataStore
		cm: akun_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 900,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: akun_DataStore,
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
			handler: akun_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: akun_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: akun_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: akun_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: akun_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: akun_print  
		}
		]
	});
	akunListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	akun_ContextMenu = new Ext.menu.Menu({
		id: 'akun_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: akun_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: akun_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: akun_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: akun_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onakun_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		akun_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		akun_SelectedRow=rowIndex;
		akun_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function akun_editContextMenu(){
      akunListEditorGrid.startEditing(akun_SelectedRow,1);
  	}
	/* End of Function */
  	
	akunListEditorGrid.addListener('rowcontextmenu', onakun_ListEditGridContextMenu);
	akun_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	akunListEditorGrid.on('afteredit', akun_update); // inLine Editing Record
	
	cbo_akun_kodeDataStore.load();
	
	/* Identify  akun_kode Field */
	akun_kodeField= new Ext.form.TextField({
		id: 'akun_kodeField',
		fieldLabel: 'Kode <span style="color: #ec0000">*</span>',
		maxLength: 20,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  akun_nama Field */
	akun_namaField= new Ext.form.TextField({
		id: 'akun_namaField',
		fieldLabel: 'Nama <span style="color: #ec0000">*</span>',
		maxLength: 250,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  akun_parent Field */
	akun_parentField= new Ext.form.ComboBox({
		id: 'akun_parentField',
		fieldLabel: 'Induk Akun',
		store: cbo_akun_kodeDataStore,
		mode: 'remote',
		displayField: 'akun_kode_display',
		valueField: 'akun_kode_value',
		allowBlank: true,
		anchor: '95%',
		triggerAction: 'all'
	});
	/* Identify  akun_neraca Field */
	akun_neracaField= new Ext.form.ComboBox({
		id: 'akun_neracaField',
		fieldLabel: 'Neraca ? <span style="color: #ec0000">*</span>',
		store:new Ext.data.SimpleStore({
			fields:['akun_neraca_value', 'akun_neraca_display'],
			data:[['Y','Y'],['T','T']]
		}),
		mode: 'local',
		displayField: 'akun_neraca_display',
		valueField: 'akun_neraca_value',
		allowBlank: false,
		width: 70,
		triggerAction: 'all'	
	});
	/* Identify  akun_rugilaba Field */
	akun_rugilabaField= new Ext.form.ComboBox({
		id: 'akun_rugilabaField',
		fieldLabel: 'Laba/Rugi ? <span style="color: #ec0000">*</span>',
		store:new Ext.data.SimpleStore({
			fields:['akun_rugilaba_value', 'akun_rugilaba_display'],
			data:[['Y','Y'],['T','T']]
		}),
		mode: 'local',
		displayField: 'akun_rugilaba_display',
		valueField: 'akun_rugilaba_value',
		allowBlank: false,
		width: 70,
		triggerAction: 'all'	
	});
	/* Identify  akun_debet Field */
	akun_debetField= new Ext.form.ComboBox({
		id: 'akun_debetField',
		fieldLabel: 'Aksi Debet',
		store:new Ext.data.SimpleStore({
			fields:['akun_debet_value', 'akun_debet_display'],
			data:[['+','+'],['-','-']]
		}),
		mode: 'local',
		displayField: 'akun_debet_display',
		valueField: 'akun_debet_value',
		allowBlank: false,
		width: 70,
		triggerAction: 'all'	
	});
	/* Identify  akun_kredit Field */
	akun_kreditField= new Ext.form.ComboBox({
		id: 'akun_kreditField',
		fieldLabel: 'Aksi Kredit',
		store:new Ext.data.SimpleStore({
			fields:['akun_kredit_value', 'akun_kredit_display'],
			data:[['+','+'],['-','-']]
		}),
		mode: 'local',
		displayField: 'akun_kredit_display',
		valueField: 'akun_kredit_value',
		allowBlank: false,
		width: 70,
		triggerAction: 'all'	
	});
	/* Identify  akun_saldo Field */
	akun_saldoField= new Ext.form.NumberField({
		id: 'akun_saldoField',
		fieldLabel: 'Nilai Saldo',
		allowNegatife : false,
		emptyText: '0',
		allowBlank: true,
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  akun_keterangan Field */
	akun_keteranganField= new Ext.form.TextArea({
		id: 'akun_keteranganField',
		fieldLabel: 'Keterangan',
		allowBlank: true,
		anchor: '95%'
	});
	/* Identify  akun_aktif Field */
	akun_aktifField= new Ext.form.ComboBox({
		id: 'akun_aktifField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['akun_aktif_value', 'akun_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		displayField: 'akun_aktif_display',
		valueField: 'akun_aktif_value',
		width: 80,
		triggerAction: 'all'	
	});
	  	
	/* Function for retrieve create Window Panel*/ 
	akun_createForm = new Ext.FormPanel({
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
				items: [akun_kodeField, akun_namaField, akun_parentField, akun_neracaField, akun_rugilabaField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [akun_debetField, akun_kreditField, akun_saldoField, akun_keteranganField, akun_aktifField] 
			}
			
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: akun_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					akun_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	akun_createWindow= new Ext.Window({
		id: 'akun_createWindow',
		title: post2db+'Akun',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_akun_create',
		items: akun_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function akun_list_search(){
		// render according to a SQL date format.
		var akun_id_search=null;
		var akun_kode_search=null;
		var akun_nama_search=null;
		var akun_parent_search=null;
		var akun_neraca_search=null;
		var akun_rugilaba_search=null;
		var akun_debet_search=null;
		var akun_kredit_search=null;
		var akun_saldo_search=null;
		var akun_keterangan_search=null;
		var akun_aktif_search=null;

		if(akun_idSearchField.getValue()!==null){akun_id_search=akun_idSearchField.getValue();}
		if(akun_kodeSearchField.getValue()!==null){akun_kode_search=akun_kodeSearchField.getValue();}
		if(akun_namaSearchField.getValue()!==null){akun_nama_search=akun_namaSearchField.getValue();}
		if(akun_parentSearchField.getValue()!==null){akun_parent_search=akun_parentSearchField.getValue();}
		if(akun_neracaSearchField.getValue()!==null){akun_neraca_search=akun_neracaSearchField.getValue();}
		if(akun_rugilabaSearchField.getValue()!==null){akun_rugilaba_search=akun_rugilabaSearchField.getValue();}
		if(akun_debetSearchField.getValue()!==null){akun_debet_search=akun_debetSearchField.getValue();}
		if(akun_kreditSearchField.getValue()!==null){akun_kredit_search=akun_kreditSearchField.getValue();}
		if(akun_saldoSearchField.getValue()!==null){akun_saldo_search=akun_saldoSearchField.getValue();}
		if(akun_keteranganSearchField.getValue()!==null){akun_keterangan_search=akun_keteranganSearchField.getValue();}
		if(akun_aktifSearchField.getValue()!==null){akun_aktif_search=akun_aktifSearchField.getValue();}
		// change the store parameters
		akun_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			akun_id	:	akun_id_search, 
			akun_kode	:	akun_kode_search, 
			akun_nama	:	akun_nama_search, 
			akun_parent	:	akun_parent_search, 
			akun_neraca	:	akun_neraca_search, 
			akun_rugilaba	:	akun_rugilaba_search, 
			akun_debet	:	akun_debet_search, 
			akun_kredit	:	akun_kredit_search, 
			akun_saldo	:	akun_saldo_search, 
			akun_keterangan	:	akun_keterangan_search, 
			akun_aktif	:	akun_aktif_search
	};
		// Cause the datastore to do another query : 
		akun_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function akun_reset_search(){
		// reset the store parameters
		akun_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		akun_DataStore.reload({params: {start: 0, limit: pageS}});
		akun_searchWindow.close();
	};
	/* End of Fuction */
	
	function akun_reset_SearchForm(){
		akun_kodeSearchField.reset();
		akun_kodeSearchField.setValue(null);
		akun_namaSearchField.reset();
		akun_namaSearchField.setValue(null);
		akun_parentSearchField.reset();
		akun_parentSearchField.setValue(null);
		akun_neracaSearchField.reset();
		akun_neracaSearchField.setValue(null);
		akun_rugilabaSearchField.reset();
		akun_rugilabaSearchField.setValue(null);
		akun_debetSearchField.reset();
		akun_debetSearchField.setValue(null);
		akun_kreditSearchField.reset();
		akun_kreditSearchField.setValue(null);
		akun_saldoSearchField.reset();
		akun_saldoSearchField.setValue(null);
		akun_keteranganSearchField.reset();
		akun_keteranganSearchField.setValue(null);
		akun_aktifSearchField.reset();
		akun_aktifSearchField.setValue(null);
	}
	
	/* Field for search */
	/* Identify  akun_id Search Field */
	akun_idSearchField= new Ext.form.NumberField({
		id: 'akun_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  akun_kode Search Field */
	akun_kodeSearchField= new Ext.form.TextField({
		id: 'akun_kodeSearchField',
		fieldLabel: 'Kode Akun',
		maxLength: 20,
		anchor: '95%'
	
	});
	/* Identify  akun_nama Search Field */
	akun_namaSearchField= new Ext.form.TextField({
		id: 'akun_namaSearchField',
		fieldLabel: 'Nama Akun',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  akun_parent Search Field */
	akun_parentSearchField= new Ext.form.NumberField({
		id: 'akun_parentSearchField',
		fieldLabel: 'Kode Induk',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  akun_neraca Search Field */
	akun_neracaSearchField= new Ext.form.ComboBox({
		id: 'akun_neracaSearchField',
		fieldLabel: 'Neraca ?',
		store:new Ext.data.SimpleStore({
			fields:['value', 'akun_neraca'],
			data:[['Y','Y'],['T','T']]
		}),
		mode: 'local',
		displayField: 'akun_neraca',
		valueField: 'value',
		width: 70,
		triggerAction: 'all'	 
	
	});
	/* Identify  akun_rugilaba Search Field */
	akun_rugilabaSearchField= new Ext.form.ComboBox({
		id: 'akun_rugilabaSearchField',
		fieldLabel: 'Laba/Rugi ?',
		store:new Ext.data.SimpleStore({
			fields:['value', 'akun_rugilaba'],
			data:[['Y','Y'],['T','T']]
		}),
		mode: 'local',
		displayField: 'akun_rugilaba',
		valueField: 'value',
		width: 70,
		triggerAction: 'all'	 
	
	});
	/* Identify  akun_debet Search Field */
	akun_debetSearchField= new Ext.form.ComboBox({
		id: 'akun_debetSearchField',
		fieldLabel: 'Aksi Debet',
		store:new Ext.data.SimpleStore({
			fields:['value', 'akun_debet'],
			data:[['+','+'],['-','-']]
		}),
		mode: 'local',
		displayField: 'akun_debet',
		valueField: 'value',
		width: 70,
		triggerAction: 'all'	 
	
	});
	/* Identify  akun_kredit Search Field */
	akun_kreditSearchField= new Ext.form.ComboBox({
		id: 'akun_kreditSearchField',
		fieldLabel: 'Aksi Kredit',
		store:new Ext.data.SimpleStore({
			fields:['value', 'akun_kredit'],
			data:[['+','+'],['-','-']]
		}),
		mode: 'local',
		displayField: 'akun_kredit',
		valueField: 'value',
		width: 70,
		triggerAction: 'all'	 
	
	});
	/* Identify  akun_saldo Search Field */
	akun_saldoSearchField= new Ext.form.NumberField({
		id: 'akun_saldoSearchField',
		fieldLabel: 'Nilai Saldo',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  akun_keterangan Search Field */
	akun_keteranganSearchField= new Ext.form.TextArea({
		id: 'akun_keteranganSearchField',
		fieldLabel: 'Nilai Saldo',
		allowBlank: true,
		anchor: '95%'
	
	});
	/* Identify  akun_aktif Search Field */
	akun_aktifSearchField= new Ext.form.ComboBox({
		id: 'akun_aktifSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['value', 'akun_aktif'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		displayField: 'akun_aktif',
		valueField: 'value',
		width: 80,
		triggerAction: 'all'	 
	
	});
	  
	/* Function for retrieve search Form Panel */
	akun_searchForm = new Ext.FormPanel({
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
				items: [akun_kodeSearchField, akun_namaSearchField, akun_parentSearchField, akun_neracaSearchField, akun_rugilabaSearchField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [ akun_debetSearchField, akun_kreditSearchField, akun_saldoSearchField, akun_keteranganSearchField, akun_aktifSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: akun_list_search
			},{
				text: 'Close',
				handler: function(){
					akun_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	akun_searchWindow = new Ext.Window({
		title: 'akun Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_akun_search',
		items: akun_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!akun_searchWindow.isVisible()){
			akun_reset_SearchForm();
			akun_searchWindow.show();
		} else {
			akun_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function akun_print(){
		var searchquery = "";
		var akun_kode_print=null;
		var akun_nama_print=null;
		var akun_parent_print=null;
		var akun_neraca_print=null;
		var akun_rugilaba_print=null;
		var akun_debet_print=null;
		var akun_kredit_print=null;
		var akun_saldo_print=null;
		var akun_keterangan_print=null;
		var akun_aktif_print=null;
		var win;              
		// check if we do have some search data...
		if(akun_DataStore.baseParams.query!==null){searchquery = akun_DataStore.baseParams.query;}
		if(akun_DataStore.baseParams.akun_kode!==null){akun_kode_print = akun_DataStore.baseParams.akun_kode;}
		if(akun_DataStore.baseParams.akun_nama!==null){akun_nama_print = akun_DataStore.baseParams.akun_nama;}
		if(akun_DataStore.baseParams.akun_parent!==null){akun_parent_print = akun_DataStore.baseParams.akun_parent;}
		if(akun_DataStore.baseParams.akun_neraca!==null){akun_neraca_print = akun_DataStore.baseParams.akun_neraca;}
		if(akun_DataStore.baseParams.akun_rugilaba!==null){akun_rugilaba_print = akun_DataStore.baseParams.akun_rugilaba;}
		if(akun_DataStore.baseParams.akun_debet!==null){akun_debet_print = akun_DataStore.baseParams.akun_debet;}
		if(akun_DataStore.baseParams.akun_kredit!==null){akun_kredit_print = akun_DataStore.baseParams.akun_kredit;}
		if(akun_DataStore.baseParams.akun_saldo!==null){akun_saldo_print = akun_DataStore.baseParams.akun_saldo;}
		if(akun_DataStore.baseParams.akun_keterangan!==null){akun_keterangan_print = akun_DataStore.baseParams.akun_keterangan;}
		if(akun_DataStore.baseParams.akun_aktif!==null){akun_aktif_print = akun_DataStore.baseParams.akun_aktif;}
		

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_akun&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			akun_kode : akun_kode_print,
			akun_nama : akun_nama_print,
			akun_parent : akun_parent_print,
			akun_neraca : akun_neraca_print,
			akun_rugilaba : akun_rugilaba_print,
			akun_debet : akun_debet_print,
			akun_kredit : akun_kredit_print,
			akun_saldo : akun_saldo_print,
			akun_keterangan : akun_keterangan_print,
			akun_aktif : akun_aktif_print,
		  	currentlisting: akun_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./akunlist.html','akunlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function akun_export_excel(){
		var searchquery = "";
		var akun_kode_2excel=null;
		var akun_nama_2excel=null;
		var akun_parent_2excel=null;
		var akun_neraca_2excel=null;
		var akun_rugilaba_2excel=null;
		var akun_debet_2excel=null;
		var akun_kredit_2excel=null;
		var akun_saldo_2excel=null;
		var akun_keterangan_2excel=null;
		var akun_aktif_2excel=null;
		var win;              
		// check if we do have some search data...
		if(akun_DataStore.baseParams.query!==null){searchquery = akun_DataStore.baseParams.query;}
		if(akun_DataStore.baseParams.akun_kode!==null){akun_kode_2excel = akun_DataStore.baseParams.akun_kode;}
		if(akun_DataStore.baseParams.akun_nama!==null){akun_nama_2excel = akun_DataStore.baseParams.akun_nama;}
		if(akun_DataStore.baseParams.akun_parent!==null){akun_parent_2excel = akun_DataStore.baseParams.akun_parent;}
		if(akun_DataStore.baseParams.akun_neraca!==null){akun_neraca_2excel = akun_DataStore.baseParams.akun_neraca;}
		if(akun_DataStore.baseParams.akun_rugilaba!==null){akun_rugilaba_2excel = akun_DataStore.baseParams.akun_rugilaba;}
		if(akun_DataStore.baseParams.akun_debet!==null){akun_debet_2excel = akun_DataStore.baseParams.akun_debet;}
		if(akun_DataStore.baseParams.akun_kredit!==null){akun_kredit_2excel = akun_DataStore.baseParams.akun_kredit;}
		if(akun_DataStore.baseParams.akun_saldo!==null){akun_saldo_2excel = akun_DataStore.baseParams.akun_saldo;}
		if(akun_DataStore.baseParams.akun_keterangan!==null){akun_keterangan_2excel = akun_DataStore.baseParams.akun_keterangan;}
		if(akun_DataStore.baseParams.akun_aktif!==null){akun_aktif_2excel = akun_DataStore.baseParams.akun_aktif;}
		

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_akun&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			akun_kode : akun_kode_2excel,
			akun_nama : akun_nama_2excel,
			akun_parent : akun_parent_2excel,
			akun_neraca : akun_neraca_2excel,
			akun_rugilaba : akun_rugilaba_2excel,
			akun_debet : akun_debet_2excel,
			akun_kredit : akun_kredit_2excel,
			akun_saldo : akun_saldo_2excel,
			akun_keterangan : akun_keterangan_2excel,
			akun_aktif : akun_aktif_2excel,
		  	currentlisting: akun_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_akun"></div>
		<div id="elwindow_akun_create"></div>
        <div id="elwindow_akun_search"></div>
    </div>
</div>
</body>