<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: produk_group View
	+ Description	: For record view
	+ Filename 		: v_produk_group.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 28/Jul/2009 10:10:08
	
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
var produk_group_DataStore;
var produk_group_ColumnModel;
var produk_groupListEditorGrid;
var produk_group_createForm;
var produk_group_createWindow;
var produk_group_searchForm;
var produk_group_searchWindow;
var produk_group_SelectedRow;
var produk_group_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var group_idField;
var group_kodeField;
var group_namaField;
var group_duprodukField;
var group_dmprodukField;
var group_durawatField;
var group_dmrawatField;
var group_dupaketField;
var group_dmpaketField;
var group_kelompokField;
var group_keteranganField;
var group_aktifField;

var group_kodeSearchField;
var group_namaSearchField;
var group_duprodukSearchField;
var group_dmprodukSearchField;
var group_durawatSearchField;
var group_dmrawatSearchField;
var group_dupaketSearchField;
var group_dmpaketSearchField;
var group_keteranganSearchField;
var group_aktifSearchField;


/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function produk_group_update(oGrid_event){
	var group_id_update_pk="";
	var group_nama_update=null;
	var group_kode_update=null;
	var group_duproduk_update=null;
	var group_dmproduk_update=null;
	var group_durawat_update=null;
	var group_dmrawat_update=null;
	var group_dupaket_update=null;
	var group_dmpaket_update=null;
	var group_kelompok_update=null;
	var group_keterangan_update=null;
	var group_aktif_update=null;


	group_id_update_pk = oGrid_event.record.data.group_id;
	if(oGrid_event.record.data.group_nama!== null){group_nama_update = oGrid_event.record.data.group_nama;}
	if(oGrid_event.record.data.group_kode!== null){group_kode_update = oGrid_event.record.data.group_kode;}
	if(oGrid_event.record.data.group_duproduk!== null){group_duproduk_update = oGrid_event.record.data.group_duproduk;}
	if(oGrid_event.record.data.group_dmproduk!== null){group_dmproduk_update = oGrid_event.record.data.group_dmproduk;}
	if(oGrid_event.record.data.group_durawat!== null){group_durawat_update = oGrid_event.record.data.group_durawat;}
	if(oGrid_event.record.data.group_dmrawat!== null){group_dmrawat_update = oGrid_event.record.data.group_dmrawat;}
	if(oGrid_event.record.data.group_dupaket!== null){group_dupaket_update = oGrid_event.record.data.group_dupaket;}
	if(oGrid_event.record.data.group_dmpaket!== null){group_dmpaket_update = oGrid_event.record.data.group_dmpaket;}
	if(oGrid_event.record.data.group_kelompok!== null){group_kelompok_update = oGrid_event.record.data.group_kelompok;}
	if(oGrid_event.record.data.group_keterangan!== null){group_keterangan_update = oGrid_event.record.data.group_keterangan;}
	if(oGrid_event.record.data.group_aktif!== null){group_aktif_update = oGrid_event.record.data.group_aktif;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_produk_group&m=get_action',
			params: {
				task: "UPDATE",
				group_id		: group_id_update_pk,
				group_kode		:group_kode_update,	
				group_nama		:group_nama_update,		
				group_duproduk	:group_duproduk_update,		
				group_dmproduk	:group_dmproduk_update,		
				group_durawat	:group_durawat_update,		
				group_dmrawat	:group_dmrawat_update,		
				group_dupaket	:group_dupaket_update,		
				group_dmpaket	:group_dmpaket_update,
				group_kelompok	:group_kelompok_update,		
				group_keterangan	:group_keterangan_update,		
				group_aktif	:group_aktif_update	
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						produk_group_DataStore.commitChanges();
						produk_group_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not save the produk_group.',
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
	function produk_group_create(){
		if(is_produk_group_form_valid()){
		
		var group_id_create_pk=null;
		var group_kode_create=null;
		var group_nama_create=null;
		var group_duproduk_create=null;
		var group_dmproduk_create=null;
		var group_durawat_create=null;
		var group_dmrawat_create=null;
		var group_dupaket_create=null;
		var group_dmpaket_create=null;
		var group_kelompok_create=null;
		var group_keterangan_create=null;
		var group_aktif_create=null;


		group_id_create_pk=get_pk_id();
		if(group_kodeField.getValue()!== null){group_kode_create = group_kodeField.getValue();}
		if(group_namaField.getValue()!== null){group_nama_create = group_namaField.getValue();}
		if(group_duprodukField.getValue()!== null){group_duproduk_create = group_duprodukField.getValue();}
		if(group_dmprodukField.getValue()!== null){group_dmproduk_create = group_dmprodukField.getValue();}
		if(group_durawatField.getValue()!== null){group_durawat_create = group_durawatField.getValue();}
		if(group_dmrawatField.getValue()!== null){group_dmrawat_create = group_dmrawatField.getValue();}
		if(group_dupaketField.getValue()!== null){group_dupaket_create = group_dupaketField.getValue();}
		if(group_dmpaketField.getValue()!== null){group_dmpaket_create = group_dmpaketField.getValue();}
		if(group_kelompokField.getValue()!== null){group_kelompok_create = group_kelompokField.getValue();}
		if(group_keteranganField.getValue()!== null){group_keterangan_create = group_keteranganField.getValue();}
		if(group_aktifField.getValue()!== null){group_aktif_create = group_aktifField.getValue();}


			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_produk_group&m=get_action',
				params: {
					task: post2db,
					group_id	: group_id_create_pk,
					group_kode	: group_kode_create,
					group_nama	: group_nama_create,	
					group_duproduk	: group_duproduk_create,	
					group_dmproduk	: group_dmproduk_create,	
					group_durawat	: group_durawat_create,	
					group_dmrawat	: group_dmrawat_create,	
					group_dupaket	: group_dupaket_create,	
					group_dmpaket	: group_dmpaket_create,
					group_kelompok	: group_kelompok_create,	
					group_keterangan	: group_keterangan_create,	
					group_aktif	: group_aktif_create
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The Produk_group was '+msg+' successfully.');
							produk_group_DataStore.reload();
							produk_group_createWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the Produk_group.',
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
			return produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function produk_group_reset_form(){
		group_kodeField.reset();
		group_kodeField.setValue(null);
		group_namaField.reset();
		group_namaField.setValue(null);
		group_duprodukField.reset();
		group_duprodukField.setValue(null);
		group_dmprodukField.reset();
		group_dmprodukField.setValue(null);
		group_durawatField.reset();
		group_durawatField.setValue(null);
		group_dmrawatField.reset();
		group_dmrawatField.setValue(null);
		group_dupaketField.reset();
		group_dupaketField.setValue(null);
		group_dmpaketField.reset();
		group_dmpaketField.setValue(null);
		group_kelompokField.reset();
		group_kelompokField.setValue(null);
		group_keteranganField.reset();
		group_keteranganField.setValue(null);
		group_aktifField.reset();
		group_aktifField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function produk_group_set_form(){
		group_kodeField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_kode'));
		group_namaField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_nama'));
		group_duprodukField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_duproduk'));
		group_dmprodukField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_dmproduk'));
		group_durawatField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_durawat'));
		group_dmrawatField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_dmrawat'));
		group_dupaketField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_dupaket'));
		group_dmpaketField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_dmpaket'));
		group_kelompokField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_kelompok'));
		group_keteranganField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_keterangan'));
		group_aktifField.setValue(produk_groupListEditorGrid.getSelectionModel().getSelected().get('group_aktif'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_produk_group_form_valid(){
		return (group_kodeField.isValid() && group_namaField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!produk_group_createWindow.isVisible()){
			produk_group_reset_form();
			post2db='CREATE';
			msg='created';
			produk_group_createWindow.show();
		} else {
			produk_group_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function produk_group_confirm_delete(){
		// only one produk_group is selected here
		if(produk_groupListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', produk_group_delete);
		} else if(produk_groupListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', produk_group_delete);
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
	function produk_group_confirm_update(){
		/* only one record is selected here */
		if(produk_groupListEditorGrid.selModel.getCount() == 1) {
			produk_group_set_form();
			post2db='UPDATE';
			msg='updated';
			produk_group_createWindow.show();
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
	function produk_group_delete(btn){
		if(btn=='yes'){
			var selections = produk_groupListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< produk_groupListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.group_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_produk_group&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							produk_group_DataStore.reload();
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
	produk_group_DataStore = new Ext.data.Store({
		id: 'produk_group_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk_group&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'group_id'
		},[
		/* dataIndex => insert intoproduk_group_ColumnModel, Mapping => for initiate table column */ 
			{name: 'group_id', type: 'int', mapping: 'group_id'},
			{name: 'group_kode', type: 'string', mapping: 'group_kode'},
			{name: 'group_nama', type: 'string', mapping: 'group_nama'},
			{name: 'group_duproduk', type: 'int', mapping: 'group_duproduk'},
			{name: 'group_dmproduk', type: 'int', mapping: 'group_dmproduk'},
			{name: 'group_durawat', type: 'int', mapping: 'group_durawat'},
			{name: 'group_dmrawat', type: 'int', mapping: 'group_dmrawat'},
			{name: 'group_dupaket', type: 'int', mapping: 'group_dupaket'},
			{name: 'group_dmpaket', type: 'int', mapping: 'group_dmpaket'},
			{name: 'group_kelompok', type: 'string', mapping: 'kategori_nama'},
			{name: 'group_keterangan', type: 'string', mapping: 'group_keterangan'},
			{name: 'group_aktif', type: 'string', mapping: 'group_aktif'},
			{name: 'group_creator', type: 'string', mapping: 'group_creator'},
			{name: 'group_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'group_date_create'},
			{name: 'group_update', type: 'string', mapping: 'group_update'},
			{name: 'group_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'group_date_update'},
			{name: 'group_revised', type: 'int', mapping: 'group_revised'}
		]),
		sortInfo:{field: 'group_id', direction: "ASC"}
	});
	/* End of Function */
	
	cbo_group_jenisDataStore = new Ext.data.Store({
		id: 'cbo_group_jenisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_produk_group&m=get_kategori_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: 10 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'kategori_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_jenis_id', type: 'int', mapping: 'kategori_id'},
			{name: 'cbo_jenis_nama', type: 'string', mapping: 'kategori_nama'},
			{name: 'cbo_jenis_kelompok', type: 'string', mapping: 'kategori_jenis'}
		]),
		sortInfo:{field: 'cbo_jenis_nama', direction: "ASC"}
	});
    
  	/* Function for Identify of Window Column Model */
	produk_group_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'group_id',
			width: 50,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Nama',
			dataIndex: 'group_nama',
			width: 250,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Kode',
			dataIndex: 'group_kode',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'DU Produk',
			dataIndex: 'group_duproduk',
			width: 100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + ' %</span>';
			},
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'DM Produk',
			dataIndex: 'group_dmproduk',
			width: 100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + ' %</span>';
			},
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'DU Perawatan',
			dataIndex: 'group_durawat',
			width: 100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + ' %</span>';
			},
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'DM Perawatan',
			dataIndex: 'group_dmrawat',
			width: 100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + ' %</span>';
			},
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'DU Paket',
			dataIndex: 'group_dupaket',
			width: 100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + ' %</span>';
			},
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'DM Paket',
			dataIndex: 'group_dmpaket',
			width: 100,
			sortable: true,
			renderer: function(val){
				return '<span>' + val + ' %</span>';
			},
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: 'Jenis',
			dataIndex: 'group_kelompok',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				store: cbo_group_jenisDataStore,
				mode: 'remote',
				displayField:'cbo_jenis_nama',
				valueField: 'cbo_jenis_id',
		        typeAhead: false,
		        loadingText: 'Searching...',
		        //pageSize:10,
		        hideTrigger:false,
		        //tpl: jenis_group_tpl,
		        //applyTo: 'search',
		        //itemSelector: 'div.search-item',
				triggerAction: 'all',
				lazyRender:true,
				listClass: 'x-combo-list-small',
				anchor: '95%'
			})
		},
		{
			header: 'Keterangan',
			dataIndex: 'group_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Status',
			dataIndex: 'group_aktif',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['group_aktif_value', 'group_aktif_display'],
					data: [['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
					}),
				mode: 'local',
               	displayField: 'group_aktif_display',
               	valueField: 'group_aktif_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
		{
			header: 'Creator',
			dataIndex: 'group_creator',
			width: 150,
			sortable: true,
			hidden: true
		},
		{
			header: 'Create on',
			dataIndex: 'group_date_create',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true
		},
		{
			header: 'Last Update by',
			dataIndex: 'group_update',
			width: 150,
			sortable: true,
			hidden: true
		},
		{
			header: 'Last Update on',
			dataIndex: 'group_date_update',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			hidden: true
		},
		{
			header: 'Revised',
			dataIndex: 'group_revised',
			width: 150,
			sortable: true,
			hidden: true
		}]
	);
	produk_group_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	produk_groupListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'produk_groupListEditorGrid',
		el: 'fp_produk_group',
		title: 'List Of Produk_group',
		autoHeight: true,
		store: produk_group_DataStore, // DataStore
		cm: produk_group_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 980,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: produk_group_DataStore,
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
			handler: produk_group_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled:true,
			handler: produk_group_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: produk_group_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: produk_group_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: produk_group_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: produk_group_print  
		}
		]
	});
	produk_groupListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	produk_group_ContextMenu = new Ext.menu.Menu({
		id: 'produk_group_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: produk_group_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: produk_group_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: produk_group_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: produk_group_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onproduk_group_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		produk_group_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		produk_group_SelectedRow=rowIndex;
		produk_group_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function produk_group_editContextMenu(){
      produk_groupListEditorGrid.startEditing(produk_group_SelectedRow,1);
  	}
	/* End of Function */
  	
	produk_groupListEditorGrid.addListener('rowcontextmenu', onproduk_group_ListEditGridContextMenu);
	//produk_group_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	produk_groupListEditorGrid.on('afteredit', produk_group_update); // inLine Editing Record
	
	/* Identify  group_nama Field */
	group_kodeField= new Ext.form.TextField({
		id: 'group_kodeField',
		fieldLabel: 'Kode <span style="color: #ec0000">*</span>',
		allowBlank: false,
		maxLength: 5,
		width: 100,
		maskRe: /([a-zA-Z]+)$/
	});
	
	group_namaField= new Ext.form.TextField({
		id: 'group_namaField',
		fieldLabel: 'Nama <span style="color: #ec0000">*</span>',
		allowBlank: false,
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  group_duproduk Field */
	group_duprodukField= new Ext.form.NumberField({
		id: 'group_duprodukField',
		fieldLabel: 'Produk',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		maxLength: 3,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_dmproduk Field */
	group_dmprodukField= new Ext.form.NumberField({
		id: 'group_dmprodukField',
		fieldLabel: 'Produk',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		maxLength: 3,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_durawat Field */
	group_durawatField= new Ext.form.NumberField({
		id: 'group_durawatField',
		fieldLabel: 'Perawatan',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_dmrawat Field */
	group_dmrawatField= new Ext.form.NumberField({
		id: 'group_dmrawatField',
		fieldLabel: 'Perawatan',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_dupaket Field */
	group_dupaketField= new Ext.form.NumberField({
		id: 'group_dupaketField',
		fieldLabel: 'Paket',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_dmpaket Field */
	group_dmpaketField= new Ext.form.NumberField({
		id: 'group_dmpaketField',
		fieldLabel: 'Paket',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_kelompok Field */
	group_kelompokField= new Ext.form.ComboBox({
		id: 'group_kelompokField',
		fieldLabel: 'Jenis',
		store: cbo_group_jenisDataStore,
		mode: 'remote',
		editable:false,
		displayField:'cbo_jenis_nama',
		valueField: 'cbo_jenis_id',
        typeAhead: false,
        loadingText: 'Searching...',
        //pageSize:10,
        hideTrigger:false,
        //tpl: jenis_group_tpl,
        //applyTo: 'search',
        //itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  group_keterangan Field */
	group_keteranganField= new Ext.form.TextArea({
		id: 'group_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  group_aktif Field */
	group_aktifField= new Ext.form.ComboBox({
		id: 'group_aktifField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['group_aktif_value', 'group_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		editable:false,
		emptyText: 'Aktif',
		displayField: 'group_aktif_display',
		valueField: 'group_aktif_value',
		width: 80,
		triggerAction: 'all'	
	});
	
	group_diskon_umumFielSet = new Ext.form.FieldSet({
		title: 'Diskon Umum (%)',
		labelWidth: 90,
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [group_duprodukField,group_durawatField,group_dupaketField] 
			}
			]
	});
	
	group_diskon_memberFielSet = new Ext.form.FieldSet({
		title: 'Diskon Member (%)',
		labelWidth: 90,
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [group_dmprodukField,group_dmrawatField,group_dmpaketField] 
			}
			]
	});
	
	/* Function for retrieve create Window Panel*/ 
	produk_group_createForm = new Ext.FormPanel({
		labelAlign: 'left',
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
				items: [group_kodeField,group_namaField, 
						{
							layout:'column',
							border:false,
							items:[
								   {
									   columnWidth:0.5,
									   layout: 'form',
									   border:false,
									   items:[group_diskon_umumFielSet]
								   },
								   {
									   columnWidth:0.5,
									   layout: 'form',
									   border:false,
									   items:[group_diskon_memberFielSet]
								   }
								   ]
						}
						,group_kelompokField,group_keteranganField, group_aktifField] 
			}
			
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: produk_group_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					produk_group_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	produk_group_createWindow= new Ext.Window({
		id: 'produk_group_createWindow',
		title: post2db+'Produk_group',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_produk_group_create',
		items: produk_group_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function produk_group_list_search(){
		// render according to a SQL date format.
		//var group_id_search=null;
		var group_kode_search=null;
		var group_nama_search=null;
		var group_duproduk_search=null;
		var group_dmproduk_search=null;
		var group_durawat_search=null;
		var group_dmrawat_search=null;
		var group_dupaket_search=null;
		var group_dmpaket_search=null;
		var group_keterangan_search=null;
		var group_aktif_search=null;
		var group_kelompok_search=null;


		//if(group_idSearchField.getValue()!==null){group_id_search=group_idSearchField.getValue();}
		if(group_kodeSearchField.getValue()!==null){group_kode_search=group_kodeSearchField.getValue();}
		if(group_namaSearchField.getValue()!==null){group_nama_search=group_namaSearchField.getValue();}
		if(group_duprodukSearchField.getValue()!==null){group_duproduk_search=group_duprodukSearchField.getValue();}
		if(group_dmprodukSearchField.getValue()!==null){group_dmproduk_search=group_dmprodukSearchField.getValue();}
		if(group_durawatSearchField.getValue()!==null){group_durawat_search=group_durawatSearchField.getValue();}
		if(group_dmrawatSearchField.getValue()!==null){group_dmrawat_search=group_dmrawatSearchField.getValue();}
		if(group_dupaketSearchField.getValue()!==null){group_dupaket_search=group_dupaketSearchField.getValue();}
		if(group_dmpaketSearchField.getValue()!==null){group_dmpaket_search=group_dmpaketSearchField.getValue();}
		if(group_keteranganSearchField.getValue()!==null){group_keterangan_search=group_keteranganSearchField.getValue();}
		if(group_aktifSearchField.getValue()!==null){group_aktif_search=group_aktifSearchField.getValue();}
		if(group_kelompokSearchField.getValue()!==null){group_kelompok_search=group_kelompokSearchField.getValue();}
		// change the store parameters
		produk_group_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			//group_id	:	group_id_search, 
			group_kode	:	group_kode_search, 
			group_nama	:	group_nama_search, 
			group_duproduk	:	group_duproduk_search, 
			group_dmproduk	:	group_dmproduk_search, 
			group_durawat	:	group_durawat_search, 
			group_dmrawat	:	group_dmrawat_search, 
			group_dupaket	:	group_dupaket_search, 
			group_dmpaket	:	group_dmpaket_search, 
			group_keterangan	:	group_keterangan_search, 
			group_aktif	:	group_aktif_search,
			group_kelompok	:	group_kelompok_search
		};
		// Cause the datastore to do another query : 
		produk_group_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function produk_group_reset_search(){
		// reset the store parameters
		produk_group_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		produk_group_DataStore.reload({params: {start: 0, limit: pageS}});
		produk_group_searchWindow.close();
	};
	/* End of Fuction */

	function produk_group_reset_SearchForm(){
		group_kodeSearchField.reset();
		group_namaSearchField.reset();
		group_duprodukSearchField.reset();
		group_dmprodukSearchField.reset();
		group_durawatSearchField.reset();
		group_dmrawatSearchField.reset();
		group_dupaketSearchField.reset();
		group_dmpaketSearchField.reset();
		group_keteranganSearchField.reset();
		group_aktifSearchField.reset();
		group_kelompokSearchField.reset();
	}
	
	/* Field for search */
	/* Identify  group_nama Field */
	group_kodeSearchField= new Ext.form.TextField({
		id: 'group_kodeSearchField',
		fieldLabel: 'Kode <span style="color: #ec0000">*</span>',
		allowBlank: false,
		maxLength: 5,
		width: 100,
		maskRe: /([a-zA-Z]+)$/
	});
	
	group_namaSearchField= new Ext.form.TextField({
		id: 'group_namaSearchField',
		fieldLabel: 'Nama <span style="color: #ec0000">*</span>',
		allowBlank: false,
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  group_duproduk Field */
	group_duprodukSearchField= new Ext.form.NumberField({
		id: 'group_duprodukSearchField',
		fieldLabel: 'Produk',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		maxLength: 3,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_dmproduk Field */
	group_dmprodukSearchField= new Ext.form.NumberField({
		id: 'group_dmprodukSearchField',
		fieldLabel: 'Produk',
		allowNegatife : false,
		emptyText: '0',
		allowDecimals: false,
		maxLength: 3,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_durawat Field */
	group_durawatSearchField= new Ext.form.NumberField({
		id: 'group_durawatSearchField',
		fieldLabel: 'Perawatan',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_dmrawat Field */
	group_dmrawatSearchField= new Ext.form.NumberField({
		id: 'group_dmrawatSearchField',
		fieldLabel: 'Perawatan',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_dupaket Field */
	group_dupaketSearchField= new Ext.form.NumberField({
		id: 'group_dupaketSearchField',
		fieldLabel: 'Paket',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_dmpaket Field */
	group_dmpaketSearchField= new Ext.form.NumberField({
		id: 'group_dmpaketSearchField',
		fieldLabel: 'Paket',
		allowNegatife : false,
		emptyText: '0',
		maxLength: 3,
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  group_kelompok Field */
	group_kelompokSearchField= new Ext.form.ComboBox({
		id: 'group_kelompokSearchField',
		fieldLabel: 'Jenis',
		store: cbo_group_jenisDataStore,
		mode: 'remote',
		displayField:'cbo_jenis_nama',
		valueField: 'cbo_jenis_id',
        typeAhead: false,
        loadingText: 'Searching...',
        //pageSize:10,
        hideTrigger:false,
        //tpl: jenis_group_tpl,
        //applyTo: 'search',
        //itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  group_keterangan Field */
	group_keteranganSearchField= new Ext.form.TextArea({
		id: 'group_keteranganSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  group_aktif Field */
	group_aktifSearchField= new Ext.form.ComboBox({
		id: 'group_aktifSearchField',
		fieldLabel: 'Status',
		store:new Ext.data.SimpleStore({
			fields:['group_aktif_value', 'group_aktif_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		emptyText: 'Aktif',
		displayField: 'group_aktif_display',
		valueField: 'group_aktif_value',
		width: 90,
		triggerAction: 'all'	
	});
	
	group_diskon_umumSearchFielSet = new Ext.form.FieldSet({
		title: 'Diskon Umum (%)',
		labelWidth: 90,
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [group_duprodukSearchField,group_durawatSearchField,group_dupaketSearchField] 
			}
			]
	});
	
	group_diskon_memberSearchFielSet = new Ext.form.FieldSet({
		title: 'Diskon Member (%)',
		labelWidth: 90,
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '95%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [group_dmprodukSearchField,group_dmrawatSearchField,group_dmpaketSearchField] 
			}
			]
	});
	
	/* Function for retrieve search Form Panel */
	produk_group_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
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
				items: [group_kodeSearchField,group_namaSearchField, 
						{
							layout:'column',
							border:false,
							items:[
								   {
									   columnWidth:0.5,
									   layout: 'form',
									   border:false,
									   items:[group_diskon_umumSearchFielSet]
								   },
								   {
									   columnWidth:0.5,
									   layout: 'form',
									   border:false,
									   items:[group_diskon_memberSearchFielSet]
								   }
								   ]
						}
						,group_kelompokSearchField,group_keteranganSearchField, group_aktifSearchField] 
			}
			
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: produk_group_list_search
			},{
				text: 'Close',
				handler: function(){
					produk_group_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	produk_group_searchWindow = new Ext.Window({
		title: 'produk_group Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_produk_group_search',
		items: produk_group_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!produk_group_searchWindow.isVisible()){
			produk_group_reset_SearchForm();
			produk_group_searchWindow.show();
		} else {
			produk_group_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function produk_group_print(){
		var searchquery = "";
		var group_kode_print=null;
		var group_nama_print=null;
		var group_duproduk_print=null;
		var group_dmproduk_print=null;
		var group_durawat_print=null;
		var group_dmrawat_print=null;
		var group_dupaket_print=null;
		var group_dmpaket_print=null;
		var group_keterangan_print=null;
		var group_aktif_print=null;
		var win;              
		// check if we do have some search data...
		if(produk_group_DataStore.baseParams.query!==null){searchquery = produk_group_DataStore.baseParams.query;}
		if(produk_group_DataStore.baseParams.group_kode!==null){group_kode_print = produk_group_DataStore.baseParams.group_kode;}
		if(produk_group_DataStore.baseParams.group_nama!==null){group_nama_print = produk_group_DataStore.baseParams.group_nama;}
		if(produk_group_DataStore.baseParams.group_duproduk!==null){group_duproduk_print = produk_group_DataStore.baseParams.group_duproduk;}
		if(produk_group_DataStore.baseParams.group_dmproduk!==null){group_dmproduk_print = produk_group_DataStore.baseParams.group_dmproduk;}
		if(produk_group_DataStore.baseParams.group_durawat!==null){group_durawat_print = produk_group_DataStore.baseParams.group_durawat;}
		if(produk_group_DataStore.baseParams.group_dmrawat!==null){group_dmrawat_print = produk_group_DataStore.baseParams.group_dmrawat;}
		if(produk_group_DataStore.baseParams.group_dupaket!==null){group_dupaket_print = produk_group_DataStore.baseParams.group_dupaket;}
		if(produk_group_DataStore.baseParams.group_dmpaket!==null){group_dmpaket_print = produk_group_DataStore.baseParams.group_dmpaket;}
		if(produk_group_DataStore.baseParams.group_keterangan!==null){group_keterangan_print = produk_group_DataStore.baseParams.group_keterangan;}
		if(produk_group_DataStore.baseParams.group_aktif!==null){group_aktif_print = produk_group_DataStore.baseParams.group_aktif;}
	
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_produk_group&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			group_kode : group_kode_print,
			group_nama : group_nama_print,
			group_duproduk : group_duproduk_print,
			group_dmproduk : group_dmproduk_print,
			group_durawat : group_durawat_print,
			group_dmrawat : group_dmrawat_print,
			group_dupaket : group_dupaket_print,
			group_dmpaket : group_dmpaket_print,
			group_keterangan : group_keterangan_print,
			group_aktif : group_aktif_print,
		  	currentlisting: produk_group_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./produk_grouplist.html','produk_grouplist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function produk_group_export_excel(){
		var searchquery = "";
		var group_kode_2excel=null;
		var group_nama_2excel=null;
		var group_duproduk_2excel=null;
		var group_dmproduk_2excel=null;
		var group_durawat_2excel=null;
		var group_dmrawat_2excel=null;
		var group_dupaket_2excel=null;
		var group_dmpaket_2excel=null;
		var group_keterangan_2excel=null;
		var group_aktif_2excel=null;
		var win;              
		// check if we do have some search data...
		if(produk_group_DataStore.baseParams.query!==null){searchquery = produk_group_DataStore.baseParams.query;}
		if(produk_group_DataStore.baseParams.group_kode!==null){group_kode_2excel = produk_group_DataStore.baseParams.group_kode;}
		if(produk_group_DataStore.baseParams.group_nama!==null){group_nama_2excel = produk_group_DataStore.baseParams.group_nama;}
		if(produk_group_DataStore.baseParams.group_duproduk!==null){group_duproduk_2excel = produk_group_DataStore.baseParams.group_duproduk;}
		if(produk_group_DataStore.baseParams.group_dmproduk!==null){group_dmproduk_2excel = produk_group_DataStore.baseParams.group_dmproduk;}
		if(produk_group_DataStore.baseParams.group_durawat!==null){group_durawat_2excel = produk_group_DataStore.baseParams.group_durawat;}
		if(produk_group_DataStore.baseParams.group_dmrawat!==null){group_dmrawat_2excel = produk_group_DataStore.baseParams.group_dmrawat;}
		if(produk_group_DataStore.baseParams.group_dupaket!==null){group_dupaket_2excel = produk_group_DataStore.baseParams.group_dupaket;}
		if(produk_group_DataStore.baseParams.group_dmpaket!==null){group_dmpaket_2excel = produk_group_DataStore.baseParams.group_dmpaket;}
		if(produk_group_DataStore.baseParams.group_keterangan!==null){group_keterangan_2excel = produk_group_DataStore.baseParams.group_keterangan;}
		if(produk_group_DataStore.baseParams.group_aktif!==null){group_aktif_2excel = produk_group_DataStore.baseParams.group_aktif;}
	
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_produk_group&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			group_kode : group_kode_2excel,
			group_nama : group_nama_2excel,
			group_duproduk : group_duproduk_2excel,
			group_dmproduk : group_dmproduk_2excel,
			group_durawat : group_durawat_2excel,
			group_dmrawat : group_dmrawat_2excel,
			group_dupaket : group_dupaket_2excel,
			group_dmpaket : group_dmpaket_2excel,
			group_keterangan : group_keterangan_2excel,
			group_aktif : group_aktif_2excel,
		  	currentlisting: produk_group_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_produk_group"></div>
		<div id="elwindow_produk_group_create"></div>
        <div id="elwindow_produk_group_search"></div>
    </div>
</div>
</body>