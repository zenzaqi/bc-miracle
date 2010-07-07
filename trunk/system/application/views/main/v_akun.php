<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: akun View
	+ Description	: For record view
	+ Filename 		: v_akun.php
 	+ creator  		: 
 	+ Created on 12/Mar/2010 10:42:59
	
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
var akun_saveForm;
var akun_saveWindow;
var akun_searchForm;
var akun_searchWindow;
var akun_SelectedRow;
var akun_ContextMenu;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var akun_idField;
var akun_kodeField;
var akun_jenisField;
var akun_parentField;
var akun_levelField;
var akun_namaField;
var akun_debetField;
var akun_kreditField;
var akun_saldoField;
var akun_aktifField;
var akun_idSearchField;
var akun_kodeSearchField;
var akun_jenisSearchField;
var akun_parentSearchField;
var akun_levelSearchField;
var akun_namaSearchField;
var akun_debetSearchField;
var akun_kreditSearchField;
var akun_saldoSearchField;
var akun_aktifSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function akun_inline_update(oGrid_event){
		var akun_id_update_pk="";
		var akun_kode_update=null;
		var akun_jenis_update=null;
		var akun_parent_update=null;
		var akun_level_update=null;
		var akun_nama_update=null;
		var akun_debet_update=null;
		var akun_kredit_update=null;
		var akun_saldo_update=null;
		var akun_aktif_update=null;

		akun_id_update_pk = oGrid_event.record.data.akun_id;
		if(oGrid_event.record.data.akun_kode!== null){akun_kode_update = oGrid_event.record.data.akun_kode;}
		if(oGrid_event.record.data.akun_jenis!== null){akun_jenis_update = oGrid_event.record.data.akun_jenis;}
		if(oGrid_event.record.data.akun_parent!== null){akun_parent_update = oGrid_event.record.data.akun_parent;}
		if(oGrid_event.record.data.akun_level!== null){akun_level_update = oGrid_event.record.data.akun_level;}
		if(oGrid_event.record.data.akun_nama!== null){akun_nama_update = oGrid_event.record.data.akun_nama;}
		if(oGrid_event.record.data.akun_debet!== null){akun_debet_update = oGrid_event.record.data.akun_debet;}
		if(oGrid_event.record.data.akun_kredit!== null){akun_kredit_update = oGrid_event.record.data.akun_kredit;}
		if(oGrid_event.record.data.akun_saldo!== null){akun_saldo_update = oGrid_event.record.data.akun_saldo;}
		if(oGrid_event.record.data.akun_aktif!== null){akun_aktif_update = oGrid_event.record.data.akun_aktif;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_akun&m=get_action',
			params: {
				akun_id		: akun_id_update_pk, 
				akun_kode	: akun_kode_update,
				akun_jenis	: akun_jenis_update,
				akun_parent	: akun_parent_update,
				akun_level	: akun_level_update,
				akun_nama	: akun_nama_update,
				akun_debet	: akun_debet_update,
				akun_kredit	: akun_kredit_update,
				akun_saldo	: akun_saldo_update,
				akun_aktif	: akun_aktif_update,
				task		: "UPDATE"
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
						   msg: 'Tidak dapat menyimpan Data Akun.',
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
  
  	/* Function for add and edit data form, open window form */
	function akun_save(){
	
		if(is_akun_form_valid()){	
			var akun_id_field_pk=null; 
			var akun_kode_field=null; 
			var akun_jenis_field=null; 
			var akun_parent_field=null; 
			var akun_level_field=null; 
			var akun_nama_field=null; 
			var akun_debet_field=null; 
			var akun_kredit_field=null; 
			var akun_saldo_field=null; 
			var akun_aktif_field=null; 

			akun_id_field_pk=get_pk_id();
			if(akun_kodeField.getValue()!== null){akun_kode_field = akun_kodeField.getValue();} 
			if(akun_jenisField.getValue()!== null){akun_jenis_field = akun_jenisField.getValue();} 
			if(akun_parentField.getValue()!== null){akun_parent_field = akun_parentField.getValue();} 
			if(akun_namaField.getValue()!== null){akun_nama_field = akun_namaField.getValue();} 
			if(akun_debetField.getValue()!== null){akun_debet_field = akun_debetField.getValue();} 
			if(akun_kreditField.getValue()!== null){akun_kredit_field = akun_kreditField.getValue();} 
			if(akun_saldoField.getValue()!== null){akun_saldo_field = akun_saldoField.getValue();} 
			if(akun_aktifField.getValue()!== null){akun_aktif_field = akun_aktifField.getValue();} 

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_akun&m=get_action',
				params: {
					akun_id	: akun_id_field_pk, 
					akun_kode	: akun_kode_field, 
					akun_jenis	: akun_jenis_field, 
					akun_parent	: akun_parent_field, 
					akun_nama	: akun_nama_field, 
					akun_debet	: akun_debet_field, 
					akun_kredit	: akun_kredit_field, 
					akun_saldo	: akun_saldo_field, 
					akun_aktif	: akun_aktif_field, 
					task		: post2db
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','Data Akun sukses disimpan.');
							akun_DataStore.reload();
							akun_saveWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Tbl M Akun.',
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
		akun_jenisField.reset();
		akun_jenisField.setValue(null);
		akun_parentField.reset();
		akun_parentField.setValue(null);
/*		akun_levelField.reset();
		akun_levelField.setValue(null);*/
		akun_namaField.reset();
		akun_namaField.setValue(null);
		akun_debetField.reset();
		akun_debetField.setValue(null);
		akun_kreditField.reset();
		akun_kreditField.setValue(null);
		akun_saldoField.reset();
		akun_saldoField.setValue(null);
		akun_aktifField.reset();
		akun_aktifField.setValue('Y');
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function akun_set_form(){
		akun_kodeField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_kode'));
		akun_jenisField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_jenis'));
		akun_parentField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_parent'));
/*		akun_levelField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_level'));*/
		akun_namaField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_nama'));
		akun_debetField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_debet'));
		akun_kreditField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_kredit'));
		akun_saldoField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_saldo'));
		akun_aktifField.setValue(akunListEditorGrid.getSelectionModel().getSelected().get('akun_aktif'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_akun_form_valid(){
		return (akun_namaField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!akun_saveWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			akun_reset_form();
			akun_kodeField.setDisabled(false);
			akun_saveWindow.show();
		} else {
			akun_saveWindow.toFront();
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
			post2db='UPDATE';
			msg='updated';
			akun_set_form();
			akun_kodeField.setDisabled(true);
			akun_saveWindow.show();
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
		baseParams:{task: "LIST", start:0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intoakun_ColumnModel, Mapping => for initiate table column */ 
			{name: 'akun_id', type: 'int', mapping: 'akun_id'}, 
			{name: 'akun_kode', type: 'string', mapping: 'akun_kode'}, 
			{name: 'akun_jenis', type: 'string', mapping: 'akun_jenis'}, 
			{name: 'akun_parent', type: 'int', mapping: 'akun_parent'}, 
			{name: 'akun_parent_nama', type: 'string', mapping: 'parent_nama'}, 
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
 
 	akun_comboDataStore = new Ext.data.Store({
		id: 'akun_comboDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_akun&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intoakun_ColumnModel, Mapping => for initiate table column */ 
			{name: 'akun_id', type: 'int', mapping: 'akun_id'}, 
			{name: 'akun_kode', type: 'string', mapping: 'akun_kode'}, 
			{name: 'akun_jenis', type: 'string', mapping: 'akun_jenis'}, 
			{name: 'akun_parent', type: 'int', mapping: 'akun_parent'}, 
			{name: 'akun_parent_nama', type: 'string', mapping: 'parent_nama'}, 
			{name: 'akun_parent_jenis', type: 'string', mapping: 'parent_jenis'}, 
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
	
	//function combo render
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_akun=new Ext.form.ComboBox({
		store: akun_comboDataStore,
		mode: 'remote',
		displayField: 'akun_nama',
		valueField: 'akun_id',
		loadingext: 'Searching...',
		typeAhead: true,
		pageSize: pageS,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%',
		hideTrigger: false
	});
	//eof
     
/*	var tree = new Ext.ux.tree.ColumnTree({
        width: 550,
        height: 300,
        rootVisible:false,
        autoScroll:true,
        title: 'Example Tasks',
        renderTo: 'fp_akun_tree',
          columns:[{
            header:'Task',
            width:330,
            dataIndex:'task'
        },{
            header:'Duration',
            width:100,
            dataIndex:'duration'
        },{
            header:'Assigned To',
            width:100,
            dataIndex:'user'
        }],
        loader: new Ext.tree.TreeLoader({
            dataUrl:'<? //=base_url();?>assets/column-data.json',
            uiProviders:{
                'col': Ext.ux.tree.ColumnNodeUI
            }
        }),
        root: new Ext.tree.AsyncTreeNode({
            text:'task'
        })
    });*/
	
	/*var Tree = Ext.tree;

    var tree = new Tree.TreePanel({
        useArrows: true,
        autoScroll: true,
        animate: true,
        enableDD: true,
        containerScroll: true,
        border: false,
        dataUrl: 'index.php?c=c_akun&m=get_action',
        root: {
            nodeType: 'async',
            text: 'Ext JS',
            draggable: false,
            id: 'src'
        }
    });*/

    // render the tree
/*    tree.render('fp_akun_tree');
    tree.getRootNode().expand();*/


	
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
				maxLength: 25			})
		}, 
		{
			header: 'Jenis',
			dataIndex: 'akun_jenis',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Parent',
			dataIndex: 'akun_parent_nama',
			width: 250,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Nama',
			dataIndex: 'akun_nama',
			width: 250,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 255			})
		}, 
		{
			header: 'Debet',
			dataIndex: 'akun_debet',
			width: 100,
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
			header: 'Kredit',
			dataIndex: 'akun_kredit',
			width: 100,
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
			header: 'Saldo',
			dataIndex: 'akun_saldo',
			width: 100,
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
			header: 'Aktif',
			dataIndex: 'akun_aktif',
			width: 100,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['akun_aktif_value', 'akun_aktif_display'],
					data: [['T','Tidak'],['Y','Ya']]
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
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Create on',
			dataIndex: 'akun_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'akun_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'akun_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Akun Revised',
			dataIndex: 'akun_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}	]);
	
	akun_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	akunListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'akunListEditorGrid',
		el: 'fp_akun',
		title: 'Daftar Akun',
		autoHeight: true,
		store: akun_DataStore, // DataStore
		cm: akun_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1024,
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
			handler: akun_editContextMenu 
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
		//akunListEditorGrid.startEditing(akun_SelectedRow,1);
		akun_confirm_update();
  	}
	/* End of Function */
  	
	akunListEditorGrid.addListener('rowcontextmenu', onakun_ListEditGridContextMenu);
	akun_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	akunListEditorGrid.on('afteredit', akun_inline_update); // inLine Editing Record
	
	/* Identify  akun_kode Field */
	akun_kodeField= new Ext.form.TextField({
		id: 'akun_kodeField',
		fieldLabel: 'Kode *',
		maxLength: 25,
		anchor: '95%',
		allowBlank: false
	});
	/* Identify  akun_jenis Field */
	akun_jenisField= new Ext.form.ComboBox({
		id: 'akun_jenisField',
		fieldLabel: 'Jenis *',
		store:new Ext.data.SimpleStore({
			fields:['akun_jenis_value', 'akun_jenis_display'],
			data: [
					['Aset','Aset'],
					['Kewajiban','Kewajiban'],
					['Ekuitas','Ekuitas'],
					['Pendapatan','Pendapatan'],
					['Beban','Beban'],
					['Lain-lain','Lain-lain']
				]
			}),
		mode: 'local',
		displayField: 'akun_jenis_display',
		valueField: 'akun_jenis_value',
		anchor: '80%',
		triggerAction: 'all',
		allowBlank: false
	});

	/* Identify  akun_parent Field */
	akun_parentField= new Ext.form.ComboBox({
		id: 'akun_parentField',
		fieldLabel: 'Parent',
		store: akun_DataStore,
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

	/* Identify  akun_nama Field */
	akun_namaField= new Ext.form.TextField({
		id: 'akun_namaField',
		fieldLabel: 'Nama',
		maxLength: 255,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  akun_debet Field */
	akun_debetField= new Ext.form.NumberField({
		id: 'akun_debetField',
		fieldLabel: 'Debet',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  akun_kredit Field */
	akun_kreditField= new Ext.form.NumberField({
		id: 'akun_kreditField',
		fieldLabel: 'Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  akun_saldo Field */
	akun_saldoField= new Ext.form.NumberField({
		id: 'akun_saldoField',
		fieldLabel: 'Saldo',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  akun_aktif Field */
	akun_aktifField= new Ext.form.ComboBox({
		id: 'akun_aktifField',
		fieldLabel: 'Aktif',
		store:new Ext.data.SimpleStore({
			fields:['akun_aktif_value', 'akun_aktif_display'],
			data:[['T','Tidak'],['Y','Ya']]
		}),
		mode: 'local',
		displayField: 'akun_aktif_display',
		valueField: 'akun_aktif_value',
		anchor: '70%',
		triggerAction: 'all'	
	});

	
	/* Function for retrieve create Window Panel*/ 
	akun_saveForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 400,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [akun_kodeField, akun_parentField, akun_jenisField, akun_namaField, akun_debetField, akun_kreditField, akun_saldoField, akun_aktifField] 
			}
			],
		buttons: [{
				text: 'Save and Close',
				handler: akun_save
			}
			,{
				text: 'Cancel',
				handler: function(){
					akun_saveWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	akun_saveWindow= new Ext.Window({
		id: 'akun_saveWindow',
		title: post2db+' Kode Akun',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_akun_save',
		items: akun_saveForm
	});
	/* End Window */
	
	/* Function for action list search */
	function akun_list_search(){
		// render according to a SQL date format.
		var akun_id_search=null;
		var akun_kode_search=null;
		var akun_jenis_search=null;
		var akun_parent_search=null;
		var akun_level_search=null;
		var akun_nama_search=null;
		var akun_debet_search=null;
		var akun_kredit_search=null;
		var akun_saldo_search=null;
		var akun_aktif_search=null;

		if(akun_idSearchField.getValue()!==null){akun_id_search=akun_idSearchField.getValue();}
		if(akun_kodeSearchField.getValue()!==null){akun_kode_search=akun_kodeSearchField.getValue();}
		if(akun_jenisSearchField.getValue()!==null){akun_jenis_search=akun_jenisSearchField.getValue();}
		if(akun_parentSearchField.getValue()!==null){akun_parent_search=akun_parentSearchField.getValue();}
		if(akun_levelSearchField.getValue()!==null){akun_level_search=akun_levelSearchField.getValue();}
		if(akun_namaSearchField.getValue()!==null){akun_nama_search=akun_namaSearchField.getValue();}
		if(akun_debetSearchField.getValue()!==null){akun_debet_search=akun_debetSearchField.getValue();}
		if(akun_kreditSearchField.getValue()!==null){akun_kredit_search=akun_kreditSearchField.getValue();}
		if(akun_saldoSearchField.getValue()!==null){akun_saldo_search=akun_saldoSearchField.getValue();}
		if(akun_aktifSearchField.getValue()!==null){akun_aktif_search=akun_aktifSearchField.getValue();}
		// change the store parameters
		akun_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			akun_id	:	akun_id_search, 
			akun_kode	:	akun_kode_search, 
			akun_jenis	:	akun_jenis_search, 
			akun_parent	:	akun_parent_search, 
			akun_level	:	akun_level_search, 
			akun_nama	:	akun_nama_search, 
			akun_debet	:	akun_debet_search, 
			akun_kredit	:	akun_kredit_search, 
			akun_saldo	:	akun_saldo_search, 
			akun_aktif	:	akun_aktif_search, 
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
	
	/* Field for search */
	/* Identify  akun_id Search Field */
	akun_idSearchField= new Ext.form.NumberField({
		id: 'akun_idSearchField',
		fieldLabel: 'Akun Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  akun_kode Search Field */
	akun_kodeSearchField= new Ext.form.TextField({
		id: 'akun_kodeSearchField',
		fieldLabel: 'Kode',
		maxLength: 25,
		anchor: '95%'
	
	});
	/* Identify  akun_jenis Search Field */
	akun_jenisSearchField= new Ext.form.ComboBox({
		id: 'akun_jenisSearchField',
		fieldLabel: 'Jenis',
		store:new Ext.data.SimpleStore({
			fields:['akun_jenisSearch_value', 'akun_jenisSearch_display'],
			data: [
					['Aset','Aset'],
					['Kewajiban','Kewajiban'],
					['Ekuitas','Ekuitas'],
					['Pendapatan','Pendapatan'],
					['Beban','Beban']
				]
			}),
		mode: 'local',
		displayField: 'akun_jenisSearch_display',
		valueField: 'akun_jenisSearch_value',
		anchor: '80%',
		triggerAction: 'all'	 
	
	});

	// akun_jenisSearchField= new Ext.form.TextField({
		// id: 'akun_jenisSearchField',
		// fieldLabel: 'Jenis',
		// maxLength: 255,
		// anchor: '95%'
	
	// });
	
	/* Identify  akun_parent Search Field */
	akun_parentSearchField= new Ext.form.ComboBox({
		id: 'akun_parentSearchField',
		fieldLabel: 'Parent',
		store: akun_DataStore,
		mode: 'remote',
		displayField: 'akun_nama',
		valueField: 'akun_id',
		loadingText: 'Searching...',
		typeAhead: false,
		pageSize: pageS,
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '80%'
		,hideTrigger: false
	});

	// akun_parentSearchField= new Ext.form.NumberField({
		// id: 'akun_parentSearchField',
		// fieldLabel: 'Parent',
		// allowNegatife : false,
		// blankText: '0',
		// allowDecimals: false,
		// anchor: '95%',
		// maskRe: /([0-9]+)$/
	
	// });
	/* Identify  akun_level Search Field */
	akun_levelSearchField= new Ext.form.NumberField({
		id: 'akun_levelSearchField',
		fieldLabel: 'Level',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  akun_nama Search Field */
	akun_namaSearchField= new Ext.form.TextField({
		id: 'akun_namaSearchField',
		fieldLabel: 'Nama',
		maxLength: 255,
		anchor: '95%'
	
	});
	/* Identify  akun_debet Search Field */
	akun_debetSearchField= new Ext.form.NumberField({
		id: 'akun_debetSearchField',
		fieldLabel: 'Debet',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  akun_kredit Search Field */
	akun_kreditSearchField= new Ext.form.NumberField({
		id: 'akun_kreditSearchField',
		fieldLabel: 'Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  akun_saldo Search Field */
	akun_saldoSearchField= new Ext.form.NumberField({
		id: 'akun_saldoSearchField',
		fieldLabel: 'Saldo',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  akun_aktif Search Field */
	akun_aktifSearchField= new Ext.form.ComboBox({
		id: 'akun_aktifSearchField',
		fieldLabel: 'Aktif',
		store:new Ext.data.SimpleStore({
			fields:['value', 'akun_aktif'],
			data:[['T','Tidak'],['Y','Ya']]
		}),
		mode: 'local',
		displayField: 'akun_aktif',
		valueField: 'value',
		anchor: '70%',
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	akun_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
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
				items: [akun_kodeSearchField, akun_jenisSearchField, akun_parentSearchField, akun_namaSearchField, akun_debetSearchField, akun_kreditSearchField, akun_saldoSearchField, akun_aktifSearchField] 
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
		title: 'Pencarian Akun',
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
		var akun_jenis_print=null;
		var akun_parent_print=null;
		var akun_level_print=null;
		var akun_nama_print=null;
		var akun_debet_print=null;
		var akun_kredit_print=null;
		var akun_saldo_print=null;
		var akun_aktif_print=null;
		var win;              
		// check if we do have some search data...
		if(akun_DataStore.baseParams.query!==null){searchquery = akun_DataStore.baseParams.query;}
		if(akun_DataStore.baseParams.akun_kode!==null){akun_kode_print = akun_DataStore.baseParams.akun_kode;}
		if(akun_DataStore.baseParams.akun_jenis!==null){akun_jenis_print = akun_DataStore.baseParams.akun_jenis;}
		if(akun_DataStore.baseParams.akun_parent!==null){akun_parent_print = akun_DataStore.baseParams.akun_parent;}
		if(akun_DataStore.baseParams.akun_level!==null){akun_level_print = akun_DataStore.baseParams.akun_level;}
		if(akun_DataStore.baseParams.akun_nama!==null){akun_nama_print = akun_DataStore.baseParams.akun_nama;}
		if(akun_DataStore.baseParams.akun_debet!==null){akun_debet_print = akun_DataStore.baseParams.akun_debet;}
		if(akun_DataStore.baseParams.akun_kredit!==null){akun_kredit_print = akun_DataStore.baseParams.akun_kredit;}
		if(akun_DataStore.baseParams.akun_saldo!==null){akun_saldo_print = akun_DataStore.baseParams.akun_saldo;}
		if(akun_DataStore.baseParams.akun_aktif!==null){akun_aktif_print = akun_DataStore.baseParams.akun_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_akun&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			akun_kode : akun_kode_print,
			akun_jenis : akun_jenis_print,
			akun_parent : akun_parent_print,
			akun_level : akun_level_print,
			akun_nama : akun_nama_print,
			akun_debet : akun_debet_print,
			akun_kredit : akun_kredit_print,
			akun_saldo : akun_saldo_print,
			akun_aktif : akun_aktif_print,
		  	currentlisting: akun_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/akun_printlist.html','akunlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
		var akun_jenis_2excel=null;
		var akun_parent_2excel=null;
		var akun_level_2excel=null;
		var akun_nama_2excel=null;
		var akun_debet_2excel=null;
		var akun_kredit_2excel=null;
		var akun_saldo_2excel=null;
		var akun_aktif_2excel=null;
		var win;              
		// check if we do have some search data...
		if(akun_DataStore.baseParams.query!==null){searchquery = akun_DataStore.baseParams.query;}
		if(akun_DataStore.baseParams.akun_kode!==null){akun_kode_2excel = akun_DataStore.baseParams.akun_kode;}
		if(akun_DataStore.baseParams.akun_jenis!==null){akun_jenis_2excel = akun_DataStore.baseParams.akun_jenis;}
		if(akun_DataStore.baseParams.akun_parent!==null){akun_parent_2excel = akun_DataStore.baseParams.akun_parent;}
		if(akun_DataStore.baseParams.akun_level!==null){akun_level_2excel = akun_DataStore.baseParams.akun_level;}
		if(akun_DataStore.baseParams.akun_nama!==null){akun_nama_2excel = akun_DataStore.baseParams.akun_nama;}
		if(akun_DataStore.baseParams.akun_debet!==null){akun_debet_2excel = akun_DataStore.baseParams.akun_debet;}
		if(akun_DataStore.baseParams.akun_kredit!==null){akun_kredit_2excel = akun_DataStore.baseParams.akun_kredit;}
		if(akun_DataStore.baseParams.akun_saldo!==null){akun_saldo_2excel = akun_DataStore.baseParams.akun_saldo;}
		if(akun_DataStore.baseParams.akun_aktif!==null){akun_aktif_2excel = akun_DataStore.baseParams.akun_aktif;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_akun&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			akun_kode : akun_kode_2excel,
			akun_jenis : akun_jenis_2excel,
			akun_parent : akun_parent_2excel,
			akun_level : akun_level_2excel,
			akun_nama : akun_nama_2excel,
			akun_debet : akun_debet_2excel,
			akun_kredit : akun_kredit_2excel,
			akun_saldo : akun_saldo_2excel,
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
	//EVENTS
	
	akun_parentField.on("select",function(){
		akun_comboDataStore.reload({params:{start:0}});
		var j= akun_comboDataStore.findExact('akun_id',akun_parentField.getValue(),0);
		if(j>=0){
			var record_akun=akun_comboDataStore.getAt(j);
			akun_jenisField.setValue(record_akun.data.akun_parent_jenis);
		}
		
	});
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_akun"></div>
         <div id="fp_akun_tree"></div>
		<div id="elwindow_akun_save"></div>
        <div id="elwindow_akun_search"></div>
    </div>
</div>
</body>
</html>