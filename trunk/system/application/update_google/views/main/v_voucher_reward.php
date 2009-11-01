<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: voucher_reward View
	+ Description	: For record view
	+ Filename 		: v_voucher_reward.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:13:44
	
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
var voucher_reward_DataStore;
var voucher_reward_ColumnModel;
var voucher_rewardListEditorGrid;
var voucher_reward_createForm;
var voucher_reward_createWindow;
var voucher_reward_searchForm;
var voucher_reward_searchWindow;
var voucher_reward_SelectedRow;
var voucher_reward_ContextMenu;
//for detail data
var _DataStor;
var ListEditorGrid;
var _ColumnModel;
var _proxy;
var _writer;
var _reader;
var editor_;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var voucher_idField;
var voucher_namaField;
var voucher_pointField;
var voucher_jenisField;
var voucher_jumlahField;
var voucher_kadaluarsaField;
var voucher_idSearchField;
var voucher_namaSearchField;
var voucher_pointSearchField;
var voucher_jenisSearchField;
var voucher_jumlahSearchField;
var voucher_kadaluarsaSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function voucher_reward_update(oGrid_event){
		var voucher_id_update_pk="";
		var voucher_nama_update=null;
		var voucher_point_update=null;
		var voucher_jenis_update=null;
		var voucher_jumlah_update=null;
		var voucher_kadaluarsa_update_date="";

		voucher_id_update_pk = oGrid_event.record.data.voucher_id;
		if(oGrid_event.record.data.voucher_nama!== null){voucher_nama_update = oGrid_event.record.data.voucher_nama;}
		if(oGrid_event.record.data.voucher_point!== null){voucher_point_update = oGrid_event.record.data.voucher_point;}
		if(oGrid_event.record.data.voucher_jenis!== null){voucher_jenis_update = oGrid_event.record.data.voucher_jenis;}
		if(oGrid_event.record.data.voucher_jumlah!== null){voucher_jumlah_update = oGrid_event.record.data.voucher_jumlah;}
	 	if(oGrid_event.record.data.voucher_kadaluarsa!== ""){voucher_kadaluarsa_update_date =oGrid_event.record.data.voucher_kadaluarsa.format('Y-m-d');}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_voucher_reward&m=get_action',
			params: {
				task: "UPDATE",
				voucher_id	: voucher_id_update_pk, 
				voucher_nama	:voucher_nama_update,  
				voucher_point	:voucher_point_update,  
				voucher_jenis	:voucher_jenis_update,  
				voucher_jumlah	:voucher_jumlah_update,  
				voucher_kadaluarsa	: voucher_kadaluarsa_update_date, 
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						voucher_reward_DataStore.commitChanges();
						voucher_reward_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the voucher_reward.',
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
	function voucher_reward_create(){
	
		if(is_voucher_reward_form_valid()){	
		var voucher_id_create_pk=null; 
		var voucher_nama_create=null; 
		var voucher_point_create=null; 
		var voucher_jenis_create=null; 
		var voucher_jumlah_create=null; 
		var voucher_kadaluarsa_create_date=""; 

		if(voucher_idField.getValue()!== null){voucher_id_create = voucher_idField.getValue();}else{voucher_id_create_pk=get_pk_id();} 
		if(voucher_namaField.getValue()!== null){voucher_nama_create = voucher_namaField.getValue();} 
		if(voucher_pointField.getValue()!== null){voucher_point_create = voucher_pointField.getValue();} 
		if(voucher_jenisField.getValue()!== null){voucher_jenis_create = voucher_jenisField.getValue();} 
		if(voucher_jumlahField.getValue()!== null){voucher_jumlah_create = voucher_jumlahField.getValue();} 
		if(voucher_kadaluarsaField.getValue()!== ""){voucher_kadaluarsa_create_date = voucher_kadaluarsaField.getValue().format('Y-m-d');} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_voucher_reward&m=get_action',
			params: {
				task: post2db,
				voucher_id	: voucher_id_create_pk, 
				voucher_nama	: voucher_nama_create, 
				voucher_point	: voucher_point_create, 
				voucher_jenis	: voucher_jenis_create, 
				voucher_jumlah	: voucher_jumlah_create, 
				voucher_kadaluarsa	: voucher_kadaluarsa_create_date, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						Ext.MessageBox.alert(post2db+' OK','The Voucher_reward was '+msg+' successfully.');
						voucher_reward_DataStore.reload();
						voucher_reward_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Voucher_reward.',
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
			return voucher_rewardListEditorGrid.getSelectionModel().getSelected().get('voucher_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function voucher_reward_reset_form(){
		voucher_idField.reset();
		voucher_idField.setValue(null);
		voucher_namaField.reset();
		voucher_namaField.setValue(null);
		voucher_pointField.reset();
		voucher_pointField.setValue(null);
		voucher_jenisField.reset();
		voucher_jenisField.setValue(null);
		voucher_jumlahField.reset();
		voucher_jumlahField.setValue(null);
		voucher_kadaluarsaField.reset();
		voucher_kadaluarsaField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function voucher_reward_set_form(){
		voucher_idField.setValue(voucher_rewardListEditorGrid.getSelectionModel().getSelected().get('voucher_id'));
		voucher_namaField.setValue(voucher_rewardListEditorGrid.getSelectionModel().getSelected().get('voucher_nama'));
		voucher_pointField.setValue(voucher_rewardListEditorGrid.getSelectionModel().getSelected().get('voucher_point'));
		voucher_jenisField.setValue(voucher_rewardListEditorGrid.getSelectionModel().getSelected().get('voucher_jenis'));
		voucher_jumlahField.setValue(voucher_rewardListEditorGrid.getSelectionModel().getSelected().get('voucher_jumlah'));
		voucher_kadaluarsaField.setValue(voucher_rewardListEditorGrid.getSelectionModel().getSelected().get('voucher_kadaluarsa'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_voucher_reward_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!voucher_reward_createWindow.isVisible()){
			voucher_reward_reset_form();
			post2db='CREATE';
			msg='created';
			voucher_reward_createWindow.show();
		} else {
			voucher_reward_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function voucher_reward_confirm_delete(){
		// only one voucher_reward is selected here
		if(voucher_rewardListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', voucher_reward_delete);
		} else if(voucher_rewardListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', voucher_reward_delete);
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
	function voucher_reward_confirm_update(){
		/* only one record is selected here */
		if(voucher_rewardListEditorGrid.selModel.getCount() == 1) {
			voucher_reward_set_form();
			post2db='UPDATE';
			msg='updated';
			voucher_reward_createWindow.show();
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
	function voucher_reward_delete(btn){
		if(btn=='yes'){
			var selections = voucher_rewardListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< voucher_rewardListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.voucher_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_voucher_reward&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							voucher_reward_DataStore.reload();
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
	voucher_reward_DataStore = new Ext.data.Store({
		id: 'voucher_reward_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_voucher_reward&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'voucher_id'
		},[
		/* dataIndex => insert intovoucher_reward_ColumnModel, Mapping => for initiate table column */ 
			{name: 'voucher_id', type: 'int', mapping: 'voucher_id'}, 
			{name: 'voucher_nama', type: 'string', mapping: 'voucher_nama'}, 
			{name: 'voucher_point', type: 'int', mapping: 'voucher_point'}, 
			{name: 'voucher_jenis', type: 'string', mapping: 'voucher_jenis'}, 
			{name: 'voucher_jumlah', type: 'int', mapping: 'voucher_jumlah'}, 
			{name: 'voucher_kadaluarsa', type: 'date', dateFormat: 'Y-m-d', mapping: 'voucher_kadaluarsa'}, 
			{name: 'voucher_creator', type: 'string', mapping: 'voucher_creator'}, 
			{name: 'voucher_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'voucher_date_create'}, 
			{name: 'voucher_update', type: 'string', mapping: 'voucher_update'}, 
			{name: 'voucher_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'voucher_date_update'}, 
			{name: 'voucher_revised', type: 'int', mapping: 'voucher_revised'} 
		]),
		sortInfo:{field: 'voucher_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	voucher_reward_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'voucher_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Voucher Nama',
			dataIndex: 'voucher_nama',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: 'Voucher Point',
			dataIndex: 'voucher_point',
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
			header: 'Voucher Jenis',
			dataIndex: 'voucher_jenis',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['voucher_jenis_value', 'voucher_jenis_display'],
					data: [['produk','produk'],['perawatan','perawatan'],['lainnya','lainnya']]
					}),
				mode: 'local',
               	displayField: 'voucher_jenis_display',
               	valueField: 'voucher_jenis_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Voucher Jumlah',
			dataIndex: 'voucher_jumlah',
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
			header: 'Voucher Kadaluarsa',
			dataIndex: 'voucher_kadaluarsa',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Voucher Creator',
			dataIndex: 'voucher_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Voucher Date Create',
			dataIndex: 'voucher_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Voucher Update',
			dataIndex: 'voucher_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Voucher Date Update',
			dataIndex: 'voucher_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Voucher Revised',
			dataIndex: 'voucher_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	voucher_reward_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	voucher_rewardListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'voucher_rewardListEditorGrid',
		el: 'fp_voucher_reward',
		title: 'List Of Voucher_reward',
		autoHeight: true,
		store: voucher_reward_DataStore, // DataStore
		cm: voucher_reward_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: voucher_reward_DataStore,
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
			handler: voucher_reward_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: voucher_reward_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: voucher_reward_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: voucher_reward_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: voucher_reward_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: voucher_reward_print  
		}
		]
	});
	voucher_rewardListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	voucher_reward_ContextMenu = new Ext.menu.Menu({
		id: 'voucher_reward_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: voucher_reward_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: voucher_reward_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: voucher_reward_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: voucher_reward_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onvoucher_reward_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		voucher_reward_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		voucher_reward_SelectedRow=rowIndex;
		voucher_reward_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function voucher_reward_editContextMenu(){
		voucher_rewardListEditorGrid.startEditing(voucher_reward_SelectedRow,1);
  	}
	/* End of Function */
  	
	voucher_rewardListEditorGrid.addListener('rowcontextmenu', onvoucher_reward_ListEditGridContextMenu);
	voucher_reward_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	voucher_rewardListEditorGrid.on('afteredit', voucher_reward_update); // inLine Editing Record
	
	/* Identify  voucher_id Field */
	voucher_idField= new Ext.form.NumberField({
		id: 'voucher_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_nama Field */
	voucher_namaField= new Ext.form.TextField({
		id: 'voucher_namaField',
		fieldLabel: 'Voucher Nama',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  voucher_point Field */
	voucher_pointField= new Ext.form.NumberField({
		id: 'voucher_pointField',
		fieldLabel: 'Voucher Point',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_jenis Field */
	voucher_jenisField= new Ext.form.ComboBox({
		id: 'voucher_jenisField',
		fieldLabel: 'Voucher Jenis',
		store:new Ext.data.SimpleStore({
			fields:['voucher_jenis_value', 'voucher_jenis_display'],
			data:[['produk','produk'],['perawatan','perawatan'],['lainnya','lainnya']]
		}),
		mode: 'local',
		displayField: 'voucher_jenis_display',
		valueField: 'voucher_jenis_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  voucher_jumlah Field */
	voucher_jumlahField= new Ext.form.NumberField({
		id: 'voucher_jumlahField',
		fieldLabel: 'Voucher Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  voucher_kadaluarsa Field */
	voucher_kadaluarsaField= new Ext.form.DateField({
		id: 'voucher_kadaluarsaField',
		fieldLabel: 'Voucher Kadaluarsa',
		format : 'Y-m-d',
	});

	
	/* Function for retrieve create Window Panel*/ 
	voucher_reward_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 300,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [voucher_idField, voucher_namaField, voucher_pointField, voucher_jenisField, voucher_jumlahField, voucher_kadaluarsaField] 
			}
			],
		buttons: [{
				text: 'Save and Close',
				handler: voucher_reward_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					voucher_reward_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	voucher_reward_createWindow= new Ext.Window({
		id: 'voucher_reward_createWindow',
		title: post2db+'Voucher_reward',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_voucher_reward_create',
		items: voucher_reward_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function voucher_reward_list_search(){
		// render according to a SQL date format.
		var voucher_id_search=null;
		var voucher_nama_search=null;
		var voucher_point_search=null;
		var voucher_jenis_search=null;
		var voucher_jumlah_search=null;
		var voucher_kadaluarsa_search_date="";

		if(voucher_idSearchField.getValue()!==null){voucher_id_search=voucher_idSearchField.getValue();}
		if(voucher_namaSearchField.getValue()!==null){voucher_nama_search=voucher_namaSearchField.getValue();}
		if(voucher_pointSearchField.getValue()!==null){voucher_point_search=voucher_pointSearchField.getValue();}
		if(voucher_jenisSearchField.getValue()!==null){voucher_jenis_search=voucher_jenisSearchField.getValue();}
		if(voucher_jumlahSearchField.getValue()!==null){voucher_jumlah_search=voucher_jumlahSearchField.getValue();}
		if(voucher_kadaluarsaSearchField.getValue()!==""){voucher_kadaluarsa_search_date=voucher_kadaluarsaSearchField.getValue().format('Y-m-d');}
		// change the store parameters
		voucher_reward_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			voucher_id	:	voucher_id_search, 
			voucher_nama	:	voucher_nama_search, 
			voucher_point	:	voucher_point_search, 
			voucher_jenis	:	voucher_jenis_search, 
			voucher_jumlah	:	voucher_jumlah_search, 
			voucher_kadaluarsa	:	voucher_kadaluarsa_search_date, 
		};
		// Cause the datastore to do another query : 
		voucher_reward_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function voucher_reward_reset_search(){
		// reset the store parameters
		voucher_reward_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		voucher_reward_DataStore.reload({params: {start: 0, limit: pageS}});
		voucher_reward_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  voucher_id Search Field */
	voucher_idSearchField= new Ext.form.NumberField({
		id: 'voucher_idSearchField',
		fieldLabel: 'Voucher Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_nama Search Field */
	voucher_namaSearchField= new Ext.form.TextField({
		id: 'voucher_namaSearchField',
		fieldLabel: 'Voucher Nama',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  voucher_point Search Field */
	voucher_pointSearchField= new Ext.form.NumberField({
		id: 'voucher_pointSearchField',
		fieldLabel: 'Voucher Point',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_jenis Search Field */
	voucher_jenisSearchField= new Ext.form.ComboBox({
		id: 'voucher_jenisSearchField',
		fieldLabel: 'Voucher Jenis',
		store:new Ext.data.SimpleStore({
			fields:['value', 'voucher_jenis'],
			data:[['produk','produk'],['perawatan','perawatan'],['lainnya','lainnya']]
		}),
		mode: 'local',
		displayField: 'voucher_jenis',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  voucher_jumlah Search Field */
	voucher_jumlahSearchField= new Ext.form.NumberField({
		id: 'voucher_jumlahSearchField',
		fieldLabel: 'Voucher Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  voucher_kadaluarsa Search Field */
	voucher_kadaluarsaSearchField= new Ext.form.DateField({
		id: 'voucher_kadaluarsaSearchField',
		fieldLabel: 'Voucher Kadaluarsa',
		format : 'Y-m-d',
	
	});
    
	/* Function for retrieve search Form Panel */
	voucher_reward_searchForm = new Ext.FormPanel({
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
				items: [voucher_namaSearchField, voucher_pointSearchField, voucher_jenisSearchField, voucher_jumlahSearchField, voucher_kadaluarsaSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: voucher_reward_list_search
			},{
				text: 'Close',
				handler: function(){
					voucher_reward_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	voucher_reward_searchWindow = new Ext.Window({
		title: 'voucher_reward Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_voucher_reward_search',
		items: voucher_reward_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!voucher_reward_searchWindow.isVisible()){
			voucher_reward_searchWindow.show();
		} else {
			voucher_reward_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function voucher_reward_print(){
		var searchquery = "";
		var voucher_nama_print=null;
		var voucher_point_print=null;
		var voucher_jenis_print=null;
		var voucher_jumlah_print=null;
		var voucher_kadaluarsa_print_date="";
		var win;              
		// check if we do have some search data...
		if(voucher_reward_DataStore.baseParams.query!==null){searchquery = voucher_reward_DataStore.baseParams.query;}
		if(voucher_reward_DataStore.baseParams.voucher_nama!==null){voucher_nama_print = voucher_reward_DataStore.baseParams.voucher_nama;}
		if(voucher_reward_DataStore.baseParams.voucher_point!==null){voucher_point_print = voucher_reward_DataStore.baseParams.voucher_point;}
		if(voucher_reward_DataStore.baseParams.voucher_jenis!==null){voucher_jenis_print = voucher_reward_DataStore.baseParams.voucher_jenis;}
		if(voucher_reward_DataStore.baseParams.voucher_jumlah!==null){voucher_jumlah_print = voucher_reward_DataStore.baseParams.voucher_jumlah;}
		if(voucher_reward_DataStore.baseParams.voucher_kadaluarsa!==""){voucher_kadaluarsa_print_date = voucher_reward_DataStore.baseParams.voucher_kadaluarsa;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_voucher_reward&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			voucher_nama : voucher_nama_print,
			voucher_point : voucher_point_print,
			voucher_jenis : voucher_jenis_print,
			voucher_jumlah : voucher_jumlah_print,
		  	voucher_kadaluarsa : voucher_kadaluarsa_print_date, 
		  	currentlisting: voucher_reward_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./voucher_rewardlist.html','voucher_rewardlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function voucher_reward_export_excel(){
		var searchquery = "";
		var voucher_nama_2excel=null;
		var voucher_point_2excel=null;
		var voucher_jenis_2excel=null;
		var voucher_jumlah_2excel=null;
		var voucher_kadaluarsa_2excel_date="";
		var win;              
		// check if we do have some search data...
		if(voucher_reward_DataStore.baseParams.query!==null){searchquery = voucher_reward_DataStore.baseParams.query;}
		if(voucher_reward_DataStore.baseParams.voucher_nama!==null){voucher_nama_2excel = voucher_reward_DataStore.baseParams.voucher_nama;}
		if(voucher_reward_DataStore.baseParams.voucher_point!==null){voucher_point_2excel = voucher_reward_DataStore.baseParams.voucher_point;}
		if(voucher_reward_DataStore.baseParams.voucher_jenis!==null){voucher_jenis_2excel = voucher_reward_DataStore.baseParams.voucher_jenis;}
		if(voucher_reward_DataStore.baseParams.voucher_jumlah!==null){voucher_jumlah_2excel = voucher_reward_DataStore.baseParams.voucher_jumlah;}
		if(voucher_reward_DataStore.baseParams.voucher_kadaluarsa!==""){voucher_kadaluarsa_2excel_date = voucher_reward_DataStore.baseParams.voucher_kadaluarsa;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_voucher_reward&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			voucher_nama : voucher_nama_2excel,
			voucher_point : voucher_point_2excel,
			voucher_jenis : voucher_jenis_2excel,
			voucher_jumlah : voucher_jumlah_2excel,
		  	voucher_kadaluarsa : voucher_kadaluarsa_2excel_date, 
		  	currentlisting: voucher_reward_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_voucher_reward"></div>
		<div id="elwindow_voucher_reward_create"></div>
        <div id="elwindow_voucher_reward_search"></div>
    </div>
</div>
</body>