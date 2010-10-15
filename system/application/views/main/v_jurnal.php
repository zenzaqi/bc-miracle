<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: jurnal View
	+ Description	: For record view
	+ Filename 		: v_jurnal.php
 	+ creator  		: 
 	+ Created on 01/Apr/2010 12:13:56
	
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
var jurnal_DataStore;
var jurnal_ColumnModel;
var jurnalListEditorGrid;
var jurnal_saveForm;
var jurnal_saveWindow;
var jurnal_searchForm;
var jurnal_searchWindow;
var jurnal_SelectedRow;
var jurnal_ContextMenu;

//declare konstant
var post2db = '';
var msg = '';
var pageS=16;
var today=new Date().format('Y-m-d');
var thismonth=new Date().format('Y-m');
/* declare variable here for Field*/
var jurnal_idField;
var jurnal_tanggalField;
var jurnal_akunField;
var jurnal_keteranganField;
var jurnal_norefField;
var jurnal_debetField;
var jurnal_kreditField;


var jurnal_tanggal_mulaiSearchField;
var jurnal_akunSearchField;
var jurnal_keteranganSearchField;
var jurnal_norefSearchField;
var jurnal_debetSearchField;
var jurnal_kreditSearchField;
var jurnal_unitSearchField;
var jurnal_postSearchField;
var jurnal_date_postSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */

  	/* Function for add and edit data form, open window form */
	function jurnal_save(){
	
		if(is_jurnal_form_valid()){	
		
			if(detail_jurnal_DataStore.getCount()<2){
				
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Maaf, data transaksi minimal ada 2 (dua) dengan nilai seimbang.',
					width: 300,
					buttons: Ext.MessageBox.OK,
					animEl: 'save',
					icon: Ext.MessageBox.WARNING
				});
				
			}else{
				
				if(jurnal_totaldebetField.getValue()==jurnal_totalkreditField.getValue()) {
					
				var jurnal_id_field_pk=null; 
				var jurnal_tanggal_field_date=""; 
				var jurnal_keterangan_field=null; 
				//var jurnal_noref_field=null; 
				var jurnal_unit_field=null; 
				var jurnal_no_field=null;
	
				jurnal_id_field_pk=get_pk_id();
				if(jurnal_tanggalField.getValue()!== ""){jurnal_tanggal_field_date = jurnal_tanggalField.getValue().format('Y-m-d');} 
				if(jurnal_keteranganField.getValue()!== null){jurnal_keterangan_field = jurnal_keteranganField.getValue();} 
				if(jurnal_noField.getValue()!== null){jurnal_no_field = jurnal_noField.getValue();} 
	
				Ext.Ajax.request({  
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_jurnal&m=get_action',
					params: {
						jurnal_id			: jurnal_id_field_pk, 
						jurnal_tanggal		: jurnal_tanggal_field_date, 
						jurnal_keterangan	: jurnal_keterangan_field, 
						jurnal_no			: jurnal_no_field,
						task				: post2db
					}, 
					success: function(response){             
						var result=response.responseText;
						var rsp_kode=result.substring(0,2);
						var rsp_msg=result.replace(rsp_kode+':','');
						if(rsp_kode=='OK'){
								detail_jurnal_purge(eval(rsp_msg));
								Ext.MessageBox.alert(post2db+' OK','Jurnal Umum sukses disimpan.');
								jurnal_saveWindow.hide();
						}else{
								Ext.MessageBox.show({
								   title: 'Warning',
								   msg: rsp_msg,
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
							   msg: 'Koneksi database gagal.',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'database',
							   icon: Ext.MessageBox.ERROR
						});	
					}                      
				});
				
				}else{
				
					Ext.MessageBox.show({
						title: 'Warning',
						msg: 'Maaf, data debet-kredit belum seimbang.',
						width: 300,
						buttons: Ext.MessageBox.OK,
						animEl: 'save',
						icon: Ext.MessageBox.WARNING
					});
					
				}
			}
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Maaf, isian belum lengkap.',
				width: 300,
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
			return jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function jurnal_reset_form(){
		jurnal_tanggalField.reset();
		jurnal_tanggalField.setValue(today);
		jurnal_keteranganField.reset();
		jurnal_keteranganField.setValue(null);
		jurnal_norefField.reset();
		jurnal_norefField.setValue(null);
		jurnal_noField.reset();
		jurnal_noField.setValue(null);
		jurnal_totaldebetField.setValue(0);
		jurnal_totalkreditField.setValue(0);
		
		cbo_akun_renderDataStore.setBaseParam('task','all');
		cbo_akun_renderDataStore.setBaseParam('master_id', -1);
		cbo_akun_renderDataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_jurnal_DataStore.setBaseParam('master_id',-1);
					detail_jurnal_DataStore.load();
				}
			}
		});
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function jurnal_set_form(){
		jurnal_tanggalField.setValue(jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_tanggal'));
		jurnal_keteranganField.setValue(jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_keterangan'));
		jurnal_norefField.setValue(jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_noref'));
		jurnal_noField.setValue(jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_no'));
		
		cbo_akun_renderDataStore.setBaseParam('task','detail');
		cbo_akun_renderDataStore.setBaseParam('master_id', get_pk_id());
		cbo_akun_renderDataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_jurnal_DataStore.setBaseParam('master_id',get_pk_id());
					detail_jurnal_DataStore.load({
						callback: function(r,opt,success){
							if(success==true){
								set_balance();
							}
						}
					});
					
				}
			}
		});
		
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_jurnal_form_valid(){
		return (jurnal_tanggalField.isValid() && jurnal_noField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!jurnal_saveWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			jurnal_reset_form();
			jurnal_saveWindow.show();
		} else {
			jurnal_saveWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function jurnal_confirm_delete(){
		// only one jurnal is selected here
		if(jurnalListEditorGrid.selModel.getCount() == 1){
			if(jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_post')=='Y'){
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Jurnal yang sudah terposting tidak dapat dihapus',
					buttons: Ext.MessageBox.OK,
					animEl: 'save',
					width: 300,
					icon: Ext.MessageBox.WARNING
				});
			}else{
				Ext.MessageBox.confirm('Perhatian !','Apakah anda benar-benar akan menghapus data ini?', jurnal_delete);
			}

		} else if(jurnalListEditorGrid.selModel.getCount() > 1){
			var selections = jurnalListEditorGrid.selModel.getSelections();
			var count_post=0;
			for(i = 0; i< jurnalListEditorGrid.selModel.getCount(); i++){
				if(selections[i].json.jurnal_post=='Y') count_post++;
			}
			if(count_post>0){
			Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Jurnal yang sudah terposting tidak dapat dihapus',
					buttons: Ext.MessageBox.OK,
					animEl: 'save',
					width: 300,
					icon: Ext.MessageBox.WARNING
				});
			}else{
				Ext.MessageBox.confirm('Perhatian !','Apakah anda benar-benar akan menghapus data ini?', jurnal_delete);
			}
			
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Pilih data untuk melakukan delete',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
	/* Function for Update Confirm */
	function jurnal_confirm_update(){
		/* only one record is selected here */
		if(jurnalListEditorGrid.selModel.getCount() == 1) {
			
			if(jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_post')=='Y'){
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Jurnal yang sudah terposting tidak dapat diubah',
					buttons: Ext.MessageBox.OK,
					animEl: 'save',
					width: 300,
					icon: Ext.MessageBox.WARNING
				});
			}else{
				post2db='UPDATE';
				msg='updated';
				jurnal_set_form();
				jurnal_saveWindow.show();
			}
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Pilih data untuk melakukan update',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				width: 300,
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function jurnal_delete(btn){
		if(btn=='yes'){
			var selections = jurnalListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< jurnalListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.jurnal_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_jurnal&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							jurnal_DataStore.reload();
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
					   msg: 'Koneksi database gagal.',
					   buttons: Ext.MessageBox.OK,
					   animEl: 'database',
					   icon: Ext.MessageBox.ERROR
					});	
				}
			});
		}  
	}
  	/* End of Function */
  
  		/* Function for Update Confirm */
	function jurnal_confirm_reopen(){
		if(jurnalListEditorGrid.selModel.getCount() == 1) {
				var id="";
				var tanggal=null;
				
			if(jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_post')=='Y' && 
			   jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_tanggal').format('Y-m')==thismonth){
				
				id = jurnalListEditorGrid.getSelectionModel().getSelected().get('jurnal_id');
				
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_jurnal&m=jurnal_reopen',
					params:{
						jurnal_id : id
					},
					success:function(response){
						Ext.MessageBox.show({
							title: 'Warning',
							msg: 'Pembukaan posting Data Sukses',
							buttons: Ext.MessageBox.OK,
							animEl: 'save',
							icon: Ext.MessageBox.OK
						});
						jurnal_DataStore.reload();
					},
					failure:function(response){
						Ext.MessageBox.show({
							title: 'Warning',
							msg: 'Pembukaan Posting gagal',
							buttons: Ext.MessageBox.OK,
							animEl: 'save',
							icon: Ext.MessageBox.WARING
						});
					}
				});
				
			}else{
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Hanya data yang sudah terposting pada bulan berjalan yang dapat dibuka',
					buttons: Ext.MessageBox.OK,
					animEl: 'save',
					icon: Ext.MessageBox.WARNING
				});
			}
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Pilih data untuk melakukan pembukaan posting',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
	
	/* Function for Retrieve DataStore */
	jurnal_DataStore = new Ext.data.GroupingStore({
		id: 'jurnal_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal&m=get_action', 
			method: 'POST'
		}),
		groupField:'jurnal_id',
		baseParams:{task: "LIST", start: 0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jurnal_detalid'
		},[
			{name: 'jurnal_id', type: 'int', mapping: 'jurnal_id'},
			{name: 'jurnal_no', type: 'string', mapping: 'jurnal_no'},
			{name: 'jurnal_detalid', type: 'int', mapping: 'djurnal_id'}, 
			{name: 'jurnal_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jurnal_tanggal'}, 
			{name: 'jurnal_akun', type: 'string', mapping: 'akun_kode'}, 
			{name: 'jurnal_akun_nama', type: 'string', mapping: 'akun_nama'}, 
			{name: 'jurnal_keterangan', type: 'string', mapping: 'djurnal_detail'}, 
			{name: 'jurnal_noref', type: 'string', mapping: 'jurnal_noref'}, 
			{name: 'jurnal_debet', type: 'float', mapping: 'djurnal_debet'}, 
			{name: 'jurnal_kredit', type: 'float', mapping: 'djurnal_kredit'}, 
			{name: 'jurnal_saldo', type: 'float'}, 
			{name: 'jurnal_unit', type: 'int', mapping: 'jurnal_unit'}, 
			{name: 'jurnal_author', type: 'string', mapping: 'jurnal_author'}, 
			{name: 'jurnal_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jurnal_date_create'}, 
			{name: 'jurnal_update', type: 'string', mapping: 'jurnal_update'}, 
			{name: 'jurnal_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jurnal_date_update'}, 
			{name: 'jurnal_post', type: 'string', mapping: 'jurnal_post'}, 
			{name: 'jurnal_date_post', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'jurnal_date_post'}, 
			{name: 'jurnal_revised', type: 'int', mapping: 'jurnal_revised'} 
		]),
		sortInfo:{field: 'jurnal_tanggal', direction: "DESC"}
	});
	/* End of Function */
    
	Ext.ux.grid.GroupSummary.Calculations['totalSaldo'] = function(v, record, field){
        return v + (record.data.jurnal_debet-record.data.jurnal_kredit);
    };
	
  	/* Function for Identify of Window Column Model */
	jurnal_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Tanggal',
			dataIndex: 'jurnal_tanggal',
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			readOnly: true
		},
		{
			header: 'No Jurnal',
			dataIndex: 'jurnal_id',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
				var jurnal_no="";
				if(record.data.jurnal_post=='Y')
					jurnal_no='<b><font color=RED>'+record.data.jurnal_no+'</font></b>';
				else
					jurnal_no='<b>'+record.data.jurnal_no+'</b>';
					
                return '<span>' + jurnal_no+ '</span>';
            }
		}, 
		{
			header: 'Nama Rekening',
			dataIndex: 'jurnal_akun_nama',
			width: 200,
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Kode',
			dataIndex: 'jurnal_akun',
			width: 100,
			sortable: true,
			readOnly: true,
			summaryType: 'count',
				hideable: false,
				summaryRenderer: function(v, params, data){
					return ((v === 0 || v > 1) ? '(' + v +' data transaksi)' : '(1 data transaksi)');
			}
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'jurnal_keterangan',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50			
			})
		}, 
		{
			header: 'Nilai Debet (Rp)',
			dataIndex: 'jurnal_debet',
			width: 100,
			align: 'right',
			summaryType: 'sum',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Nilai Kredit (Rp)',
			dataIndex: 'jurnal_kredit',
			width: 100,
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			summaryType: 'sum',
			sortable: true,
			readOnly: true
		}, 
		{
			header: 'Unit',
			dataIndex: 'jurnal_unit',
			width: 150,
			sortable: true,
			readOnly: true,
			hidden: true
		}, 
		{
			header: 'Author',
			dataIndex: 'jurnal_author',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}	
		]);
	
	jurnal_ColumnModel.defaultSortable= true;
	/* End of Function */
    var summary = new Ext.ux.grid.GroupSummary();

	/* Declare DataStore and  show datagrid list */
	jurnalListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'jurnalListEditorGrid',
		el: 'fp_jurnal',
		title: 'Daftar Jurnal Umum',
		autoHeight: true,
		store: jurnal_DataStore, // DataStore
		cm: jurnal_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1024,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: jurnal_DataStore,
			displayInfo: true
		}),
		view: new Ext.grid.GroupingView({
            forceFit: true,
            showGroupName: false,
            enableNoGroups: false,
			enableGroupingMenu: false,
            hideGroupedColumn: true
        }),
		plugins: summary,
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
			handler: jurnal_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: jurnal_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: jurnal_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: jurnal_reset_search,
			iconCls:'icon-refresh'
		}<?php if(ereg('R',$this->m_security->get_access_group_by_kode('MENU_POSTING'))){ ?>
		,'-',
		{
			text: 'Buka Posting',
			tooltip: 'Buka Posting',
			iconCls:'icon-reopen',
			handler: jurnal_confirm_reopen   // Confirm before updating
		}
		<?php } ?>
		]
	});
	jurnalListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	jurnal_ContextMenu = new Ext.menu.Menu({
		id: 'jurnal_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: jurnal_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: jurnal_confirm_delete 
		}<?php if(ereg('R',$this->m_security->get_access_group_by_kode('MENU_POSTING'))){ ?>
		,'-',
		{
			text: 'Buka Posting',
			tooltip: 'Buka Posting',
			iconCls:'icon-reopen',
			handler: jurnal_confirm_reopen   // Confirm before updating
		}
		<?php } ?>
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onjurnal_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		jurnal_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		jurnal_SelectedRow=rowIndex;
		jurnal_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function jurnal_editContextMenu(){
		//jurnalListEditorGrid.startEditing(jurnal_SelectedRow,1);
		jurnal_confirm_update();
  	}
	/* End of Function */
  	
	jurnalListEditorGrid.addListener('rowcontextmenu', onjurnal_ListEditGridContextMenu);
	jurnal_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore

	
	/* Identify  jurnal_tanggal Field */
	jurnal_tanggalField= new Ext.form.DateField({
		id: 'jurnal_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		value: today,
		allowBlank: false
	});
	
	jurnal_noField=new Ext.form.TextField({
		id: 'jurnal_noField',
		fieldLabel: 'No Jurnal',
		anchor: '95%',
		readOnly: false,
		allowBlank: false
	});
	
	/* Identify  jurnal_akun Field */
	jurnal_akunField= new Ext.form.TextField({
		id: 'jurnal_akunField',
		readOnly: true
	});
	/* Identify  jurnal_keterangan Field */
	jurnal_keteranganField= new Ext.form.TextArea({
		id: 'jurnal_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  jurnal_noref Field */
	jurnal_norefField= new Ext.form.TextField({
		id: 'jurnal_norefField',
		fieldLabel: 'No Ref',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  jurnal_debet Field */
	jurnal_debetField= new Ext.form.NumberField({
		id: 'jurnal_debetField',
		fieldLabel: 'Nilai Debet',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		enableKeyEvents: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jurnal_kredit Field */
	jurnal_kreditField= new Ext.form.NumberField({
		id: 'jurnal_kreditField',
		fieldLabel: 'Nilai Kredit',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		enableKeyEvents: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	jurnal_totaldebetField= new Ext.form.TextField({
		id: 'jurnal_totaldebetField',
		fieldLabel: 'Total Debet',
		readOnly: true,
		blankText: '0',
		valueRenderer: 'numberToCurrency',
		itemCls: 'rmoney',
		maskRe: /([0-9]+)$/
	});
	/* Identify  jurnal_kredit Field */
	jurnal_totalkreditField= new Ext.form.TextField({
		id: 'jurnal_totalkreditField',
		fieldLabel: 'Total Kredit',
		readOnly: true,
		blankText: '0',
		valueRenderer: 'numberToCurrency',
		itemCls: 'rmoney',
		maskRe: /([0-9]+)$/
	});
	
	balance_Group = new Ext.form.FieldSet({
		title: 'Balance',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		labelSeparator : ':',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [jurnal_totaldebetField] 
			},{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [jurnal_totalkreditField] 
			}
			]
	
	});
	
	master_Group = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		labelSeparator : ':',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [jurnal_tanggalField, jurnal_noField] 
			},{
				columnWidth:0.5,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				items: [jurnal_keteranganField] 
			}
			]
	
	});
	

	
	//DETAIL DECLARATION
	var jurnal_detail_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'jurnal_id'
	},[
		{name: 'jurnal_id', type: 'int', mapping: 'djurnal_id'}, 
		{name: 'jurnal_akun', type: 'int', mapping: 'djurnal_akun'}, 
		{name: 'jurnal_akun_kode', type: 'string', mapping: 'akun_kode'}, 
		{name: 'jurnal_detail', type: 'string', mapping: 'djurnal_detail'},
		{name: 'jurnal_debet', type: 'float', mapping: 'djurnal_debet'}, 
		{name: 'jurnal_kredit', type: 'float', mapping: 'djurnal_kredit'}			
	]);
	//eof
	
	//function for json writer of detail
	var detail_jurnal_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	
	detail_jurnal_DataStore = new Ext.data.Store({
		id: 'detail_jurnal_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal&m=get_detail_jurnal_list', 
			method: 'POST'
		}),
		reader: jurnal_detail_reader,
		baseParams:{start:0, limit:pageS, task: 'detail', master_id: 0},
		sortInfo:{field: 'jurnal_id', direction: 'DESC'}
	});
	/* End of Function */
	
	
	//function for editor of detail
	var editor_detail_jurnal= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	
	cbo_akunDataStore = new Ext.data.Store({
		id: 'cbo_akunDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal&m=get_akun_list', 
			method: 'POST'
		}),
		baseParams:{start:0,limit:pageS,task:'detail'},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
			{name: 'akun_id', type: 'int', mapping: 'akun_id'},
			{name: 'akun_kode', type: 'string', mapping: 'akun_kode'},
			{name: 'akun_nama', type: 'string', mapping: 'akun_nama'}
		]),
		sortInfo:{field: 'akun_kode', direction: "ASC"}
	});
	
	cbo_akun_renderDataStore = new Ext.data.Store({
		id: 'cbo_akun_renderDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_jurnal&m=get_akun_list', 
			method: 'POST'
		}),
		baseParams:{start:0,limit:pageS,task:'detail'},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
			{name: 'akun_id', type: 'int', mapping: 'akun_id'},
			{name: 'akun_kode', type: 'string', mapping: 'akun_kode'},
			{name: 'akun_nama', type: 'string', mapping: 'akun_nama'}
		]),
		sortInfo:{field: 'akun_kode', direction: "ASC"}
	});
	
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var akun_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>[{akun_kode}] - {akun_nama}</b></span>',
        '</div></tpl>'
    );
	
	var combo_akun_jurnal_umum=new Ext.form.ComboBox({
		store: cbo_akunDataStore,
		mode: 'remote',
		typeAhead: false,
		displayField: 'akun_nama',
		valueField: 'akun_id',
		triggerAction: 'all',
		lazyRender: false,
		pageSize: pageS,
		enableKeyEvents: true,
		tpl: akun_tpl,
		itemSelector: 'div.search-item',
		triggerAction: 'all',
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	var combo_akun_jurnal_umum_reader=new Ext.form.ComboBox({
		store: cbo_akun_renderDataStore,
		mode: 'remote',
		typeAhead: false,
		displayField: 'akun_nama',
		valueField: 'akun_id',
		triggerAction: 'all',
		lazyRender: false,
		pageSize: pageS,
		enableKeyEvents: true,
		tpl: akun_tpl,
		itemSelector: 'div.search-item',
		triggerAction: 'all',
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	
	detail_jurnal_ColumnModel = new Ext.grid.ColumnModel(
		[
		 {
			header: '<div align="center">' + 'Nama Rekening' + '</div>',
			dataIndex: 'jurnal_akun',
			width: 200,	//250,
			sortable: true,
			editor: combo_akun_jurnal_umum,
			renderer: Ext.util.Format.comboRenderer(combo_akun_jurnal_umum_reader)
		},
		{
			header: '<div align="center">' + 'Kode' + '</div>',
			dataIndex: 'jurnal_akun_kode',
			width: 80,
			editor: jurnal_akunField,
			readOnly: true
		},{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'jurnal_detail',
			width: 200,
			editor: new Ext.form.TextField({})
		},
		{
			header: '<div align="center">' + 'Debet' + '</div>',
			align: 'right',
			dataIndex: 'jurnal_debet',
			width: 60,	//100,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: jurnal_debetField
		},
		{
			header: '<div align="center">' + 'Kredit' + '</div>',
			align: 'right',
			dataIndex: 'jurnal_kredit',
			width: 60,	//100,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: jurnal_kreditField
			
		}
		]
	);
	detail_jurnal_ColumnModel.defaultSortable= true;
	
	
	//declaration of detail list editor grid
	detail_jurnalListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_jurnalListEditorGrid',
		el: 'fp_detail_jurnal',
		title: 'Detail Jurnal',
		height: 250,
		width: 790,	//690,
		autoScroll: true,
		store: detail_jurnal_DataStore, // DataStore
		colModel: detail_jurnal_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_jurnal],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_jurnal_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_jurnal_confirm_delete
		}
		]
	});
	//eof
	
	//function of detail add
	function detail_jurnal_add(){
		var edit_detail_jurnal= new detail_jurnalListEditorGrid.store.recordType({
			jurnal_akun			:null,		
			jurnal_detail		:null,		
			jurnal_debet		:0,		
			jurnal_kredit		:0	
		});
		editor_detail_jurnal.stopEditing();
		detail_jurnal_DataStore.insert(0, edit_detail_jurnal);
		detail_jurnalListEditorGrid.getView().refresh();
		detail_jurnalListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_jurnal.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_jurnal(){
		detail_jurnal_DataStore.commitChanges();
		detail_jurnalListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_jurnal_insert(pkid){
		var total_jurnal=0;
		for(i=0;i<detail_jurnal_DataStore.getCount();i++){
			detail_jurnal_record=detail_jurnal_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_jurnal&m=detail_jurnal_insert',
				params:{
				jurnal_master	: pkid, 
				jurnal_akun		: detail_jurnal_record.data.jurnal_akun, 
				jurnal_detail	: detail_jurnal_record.data.jurnal_detail, 
				jurnal_debet	: detail_jurnal_record.data.jurnal_debet, 
				jurnal_kredit	: detail_jurnal_record.data.jurnal_kredit
				
				},
				success:function(response){
					total_jurnal++;
					if(total_jurnal==detail_jurnal_DataStore.getCount()) jurnal_DataStore.reload();	
				}
			});
		}	
	}
	//eof
	
	//function for purge detail
	function detail_jurnal_purge(pkid){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_jurnal&m=detail_jurnal_purge',
			params:{ jurnal_master: pkid },
			success:function(response){
				detail_jurnal_insert(pkid);
			}
		});
		jurnal_DataStore.reload();
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_jurnal_confirm_delete(){
		// only one record is selected here
		if(detail_jurnalListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_jurnal_delete);
		} else if(detail_jurnalListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_jurnal_delete);
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
	function detail_jurnal_delete(btn){
		if(btn=='yes'){
			var s = detail_jurnalListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_jurnal_DataStore.remove(r);
			}
		} 
		detail_jurnal_DataStore.commitChanges();
	}
	//eof
	
	/* Function for retrieve create Window Panel*/ 
	jurnal_saveForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 800,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [master_Group, detail_jurnalListEditorGrid, balance_Group ] 
			}
			],
		buttons: [{
				text: 'Save and Close',
				formBind: true,
				handler: jurnal_save
			}
			,{
				text: 'Cancel',
				handler: function(){
					jurnal_saveWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	jurnal_saveWindow= new Ext.Window({
		id: 'jurnal_saveWindow',
		title: post2db+'Jurnal Umum',
		closable:true,
		closeAction: 'hide',
		width: 820,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_jurnal_save',
		items: jurnal_saveForm
	});
	/* End Window */
	
	/* Function for action list search */
	function jurnal_list_search(){
		// render according to a SQL date format.
		var jurnal_no_search=null;
		var jurnal_tanggal_mulai_search_date="";
		var jurnal_tanggal_akhir_search_date="";

		if(jurnal_noSearchField.getValue()!==null){jurnal_no_search=jurnal_noSearchField.getValue();}
		if(jurnal_tanggal_mulaiSearchField.getValue()!==""){jurnal_tanggal_mulai_search_date=jurnal_tanggal_mulaiSearchField.getValue().format('Y-m-d');}
		if(jurnal_tanggal_akhirSearchField.getValue()!==""){jurnal_tanggal_akhir_search_date=jurnal_tanggal_akhirSearchField.getValue().format('Y-m-d');}

		// change the store parameters
		jurnal_DataStore.baseParams = {
			task				: 'SEARCH',
			jurnal_tgl_awal		:	jurnal_tanggal_mulai_search_date, 
			jurnal_tgl_akhir	:	jurnal_tanggal_akhir_search_date, 
			jurnal_no			:	jurnal_no_search
		};
		// Cause the datastore to do another query : 
		jurnal_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function jurnal_reset_search(){
		// reset the store parameters
		jurnal_DataStore.baseParams = { task: 'LIST', start:0, limit:pageS };
		// Cause the datastore to do another query : 
		jurnal_DataStore.reload({params: {start: 0, limit: pageS}});
		jurnal_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Identify  jurnal_tanggal Search Field */
	jurnal_tanggal_mulaiSearchField= new Ext.form.DateField({
		id: 'jurnal_tanggal_mulaiSearchField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d'
	
	});

		/* Identify  jurnal_tanggal Search Field */
	jurnal_tanggal_akhirSearchField= new Ext.form.DateField({
		id: 'jurnal_tanggal_akhirSearchField',
		fieldLabel: 's/d',
		format : 'Y-m-d'
	
	});
	
	/* Identify  jurnal_akun Search Field */
	jurnal_noSearchField= new Ext.form.TextField({
		id: 'jurnal_noSearchField',
		fieldLabel: 'No Jurnal',
		anchor: '95%'
	});
	
    
	/* Function for retrieve search Form Panel */
	jurnal_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 500,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [{
						layout:'column',
						border:false,
						items:[
						{
							columnWidth:0.5,
							layout: 'form',
							border:false,
							defaultType: 'datefield',
							items: [jurnal_tanggal_mulaiSearchField]
						},
						{
							columnWidth:0.5,
							layout: 'form',
							border:false,
							labelWidth:20,
							defaultType: 'datefield',
							items: [jurnal_tanggal_akhirSearchField]
						}						
								
				        ]
						},jurnal_noSearchField
						] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: jurnal_list_search
			},{
				text: 'Close',
				handler: function(){
					jurnal_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	

	/* Function for retrieve search Window Form, used for andvaced search */
	jurnal_searchWindow = new Ext.Window({
		title: 'Pencarian Jurnal',
		closable:true,
		closeAction: 'hide',
		width: 520,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_jurnal_search',
		items: jurnal_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!jurnal_searchWindow.isVisible()){
			jurnal_searchWindow.show();
		} else {
			jurnal_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function jurnal_print(){
		var searchquery = "";
		
		var jurnal_no_print=null;
		var jurnal_tanggal_mulai_print_date="";
		var jurnal_tanggal_akhir_print_date="";

		// check if we do have some search data...
		if(jurnal_DataStore.baseParams.query!==null){searchquery = jurnal_DataStore.baseParams.query;}
		if(jurnal_DataStore.baseParams.jurnal_no!==null){jurnal_no_print = jurnal_DataStore.baseParams.jurnal_no;}
		if(jurnal_DataStore.baseParams.jurnal_tgl_awal!==null){ jurnal_tgl_awal_print = jurnal_DataStore.baseParams.jurnal_tgl_awal; }
		if(jurnal_DataStore.baseParams.jurnal_tgl_akhir!==null){ jurnal_tgl_akhir_print = jurnal_DataStore.baseParams.jurnal_tgl_akhir; }
	
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal&m=get_action',
		params: {
			task				: "PRINT",
		  	query				: searchquery,                    		
			jurnal_no			: jurnal_no_print,
			jurnal_tgl_awal 	: jurnal_tgl_awal_print,
			jurnal_tgl_akhir	: jurnal_tgl_akhir_print,
		  	currentlisting		: jurnal_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/jurnal_printlist.html','jurnallist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
			   msg: 'Koneksi database gagal.',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});		
		} 	                     
		});
	}
	/* Enf Function */
	
	/* Function for print Export to Excel Grid */
	function jurnal_export_excel(){
		var searchquery = "";
		
		var jurnal_no_print=null;
		var jurnal_tanggal_mulai_print_date="";
		var jurnal_tanggal_akhir_print_date="";

		// check if we do have some search data...
		if(jurnal_DataStore.baseParams.query!==null){searchquery = jurnal_DataStore.baseParams.query;}
		if(jurnal_DataStore.baseParams.jurnal_no!==null){jurnal_no_excel = jurnal_DataStore.baseParams.jurnal_no;}
		if(jurnal_DataStore.baseParams.jurnal_tgl_awal!==null){ jurnal_tgl_awal_excel = jurnal_DataStore.baseParams.jurnal_tgl_awal; }
		if(jurnal_DataStore.baseParams.jurnal_tgl_akhir!==null){ jurnal_tgl_akhir_excel = jurnal_DataStore.baseParams.jurnal_tgl_akhir; }
	

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_jurnal&m=get_action',
		params: {
			task				: "PRINT",
		  	query				: searchquery,                    		
			jurnal_no			: jurnal_no_excel,
			jurnal_tgl_awal 	: jurnal_tgl_awal_excel,
			jurnal_tgl_akhir	: jurnal_tgl_akhir_excel,
		  	currentlisting		: jurnal_DataStore.baseParams.task
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
			   msg: 'Koneksi database gagal.',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});    
		} 	                     
		});
	}
	/*End of Function */
	

	//EVENTS
	
	function set_balance(){
		var total_debet=0;
		var total_kredit=0;
		for(i=0;i<detail_jurnal_DataStore.getCount();i++){
			var data_balance=detail_jurnal_DataStore.getAt(i);
			total_debet=total_debet+data_balance.data.jurnal_debet;
			total_kredit=total_kredit+data_balance.data.jurnal_kredit;	
		}
		jurnal_totaldebetField.setValue(CurrencyFormatted(total_debet));
		jurnal_totalkreditField.setValue(CurrencyFormatted(total_kredit));
	}

	jurnal_kreditField.on('keyup',function(){
		set_balance();
	});
	

	
	jurnal_debetField.on('keyup',function(){
		set_balance();
	});
	
	jurnal_kreditField.on('keyup',function(){
		set_balance();
	});
	
	
	detail_jurnal_DataStore.on("update",function(){
		detail_jurnal_DataStore.commitChanges();
		var query_selected="";									   
		cbo_akun_renderDataStore.lastQuery=null;
		for(i=0;i<detail_jurnal_DataStore.getCount();i++){
			detail_record=detail_jurnal_DataStore.getAt(i);
			query_selected=query_selected+detail_record.data.jurnal_akun+",";
		}
		cbo_akun_renderDataStore.setBaseParam('task','selected');
		cbo_akun_renderDataStore.setBaseParam('master_id',get_pk_id());
		cbo_akun_renderDataStore.setBaseParam('selected_id',query_selected);
		cbo_akun_renderDataStore.load({
			callback: function(r,opt,success){
				if(success==true){
					detail_jurnalListEditorGrid.getView().refresh();
				}
			}
		});
		
		
		set_balance();
		
	});
	/*End of Function */
	
	combo_akun_jurnal_umum.on("focus",function(){
		cbo_akunDataStore.setBaseParam('task','all');
		cbo_akunDataStore.load({params:{start:0, limit: pageS}});	
	});
	
	
	combo_akun_jurnal_umum.on('select',function(){
		var j=cbo_akunDataStore.findExact('akun_id',combo_akun_jurnal_umum.getValue());
		if(j>-1){
			var data_akun=cbo_akunDataStore.getAt(j);
			jurnal_akunField.setValue(data_akun.data.akun_kode);
		}
	});
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_jurnal"></div>
        <div id="fp_detail_jurnal"></div>
		<div id="elwindow_jurnal_save"></div>
        <div id="elwindow_jurnal_search"></div>
    </div>
</div>
</body>
</html>