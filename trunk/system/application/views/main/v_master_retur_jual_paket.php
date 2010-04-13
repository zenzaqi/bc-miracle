<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_retur_jual_paket View
	+ Description	: For record view
	+ Filename 		: v_master_retur_jual_paket.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 14:53:56
	
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
var master_retur_jual_paket_DataStore;
var master_retur_jual_paket_ColumnModel;
var master_retur_jual_paketListEditorGrid;
var master_retur_jual_paket_createForm;
var master_retur_jual_paket_createWindow;
var master_retur_jual_paket_searchForm;
var master_retur_jual_paket_searchWindow;
var master_retur_jual_paket_SelectedRow;
var master_retur_jual_paket_ContextMenu;
//for detail data
var detail_retur_paket_rawat_DataStor;
var detail_retur_paket_tokwitansiListEditorGrid;
var detail_retur_paket_tokwitansiColumnModel;
var detail_retur_paket_rawat_proxy;
var detail_retur_paket_tokwitansi_writer;
var detail_retur_paket_tokwitansi_reader;
var editor_detail_retur_paket_tokwitansi;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var rpaket_idField;
var rpaket_nobuktiField;
var rpaket_nobuktijualField;
var rpaket_custField;
var rpaket_tanggalField;
var rpaket_keteranganField;
var rpaket_idSearchField;
var rpaket_nobuktiSearchField;
var rpaket_nobuktijualSearchField;
var rpaket_custSearchField;
var rpaket_tanggalSearchField;
var rpaket_keteranganSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
	
	Ext.util.Format.comboRenderer = function(combo){
  	    return function(value){
  	        var record = combo.findRecord(combo.valueField, value);
  	        return record ? record.get(combo.displayField) : combo.valueNotFoundText;
  	    }
  	}
	
	// define a custom summary function
    Ext.ux.grid.GroupSummary.Calculations['totalCost'] = function(v, record, field){
        return v + (record.data.estimate * record.data.rate);
    };

	// utilize custom extension for Group Summary
    var summary = new Ext.ux.grid.GroupSummary();
  
  	/* Function for Saving inLine Editing */
	function master_retur_jual_paket_update(oGrid_event){
		var rpaket_id_update_pk="";
		var rpaket_nobukti_update=null;
		var rpaket_nobuktijual_update=null;
		var rpaket_cust_update=null;
		var rpaket_tanggal_update_date="";
		var rpaket_keterangan_update=null;

		rpaket_id_update_pk = oGrid_event.record.data.rpaket_id;
		if(oGrid_event.record.data.rpaket_nobukti!== null){rpaket_nobukti_update = oGrid_event.record.data.rpaket_nobukti;}
		if(oGrid_event.record.data.rpaket_nobuktijual!== null){rpaket_nobuktijual_update = oGrid_event.record.data.rpaket_nobuktijual;}
		if(oGrid_event.record.data.rpaket_cust!== null){rpaket_cust_update = oGrid_event.record.data.rpaket_cust;}
	 	if(oGrid_event.record.data.rpaket_tanggal!== ""){rpaket_tanggal_update_date =oGrid_event.record.data.rpaket_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.rpaket_keterangan!== null){rpaket_keterangan_update = oGrid_event.record.data.rpaket_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_retur_jual_paket&m=get_action',
			params: {
				task: "UPDATE",
				rpaket_id	: rpaket_id_update_pk, 
				rpaket_nobukti	:rpaket_nobukti_update,  
				rpaket_nobuktijual	:rpaket_nobuktijual_update,  
				rpaket_cust	:rpaket_cust_update,  
				rpaket_tanggal	: rpaket_tanggal_update_date, 
				rpaket_keterangan	:rpaket_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_retur_jual_paket_DataStore.commitChanges();
						master_retur_jual_paket_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data retur penjualan paket tidak bisa disimpan',
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
	function master_retur_jual_paket_create(){
	
		if(is_master_retur_jual_paket_form_valid()){	
		var rpaket_id_create_pk=null; 
		var rpaket_nobukti_create=null; 
		var rpaket_nobuktijual_create=null; 
		var rpaket_cust_create=null; 
		var rpaket_tanggal_create_date=""; 
		var rpaket_keterangan_create=null; 
		var rpaket_kwitansi_nilai_create=null; 
		var rpaket_kwitansi_keterangan_create=null; 

		if(rpaket_idField.getValue()!== null){rpaket_id_create_pk = rpaket_idField.getValue();}else{rpaket_id_create_pk=get_pk_id();} 
		if(rpaket_nobuktiField.getValue()!= null){rpaket_nobukti_create = rpaket_nobuktiField.getValue();} 
		if(rpaket_nobuktijualField.getValue()!= null){rpaket_nobuktijual_create = rpaket_nobuktijualField.getValue();} 
		if(rpaket_custField.getValue()!= null){rpaket_cust_create = rpaket_custidField.getValue();} 
		if(rpaket_tanggalField.getValue()!= ""){rpaket_tanggal_create_date = rpaket_tanggalField.getValue().format('Y-m-d');} 
		if(rpaket_keteranganField.getValue()!= null){rpaket_keterangan_create = rpaket_keteranganField.getValue();} 
		if(rpaket_kwitansi_nilaiField.getValue()!== null){rpaket_kwitansi_nilai_create = rpaket_kwitansi_nilaiField.getValue();} 
		if(rpaket_kwitansi_keteranganField.getValue()!== null){rpaket_kwitansi_keterangan_create = rpaket_kwitansi_keteranganField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_retur_jual_paket&m=get_action',
			params: {
				task: post2db,
				rpaket_id	: rpaket_id_create_pk, 
				rpaket_nobukti	: rpaket_nobukti_create, 
				rpaket_nobuktijual	: rpaket_nobuktijual_create, 
				rpaket_cust	: rpaket_cust_create, 
				rpaket_tanggal	: rpaket_tanggal_create_date, 
				rpaket_keterangan	: rpaket_keterangan_create, 
				rpaket_kwitansi_nilai	: rpaket_kwitansi_nilai_create, 
				rpaket_kwitansi_keterangan	: rpaket_kwitansi_keterangan_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_retur_paket_tokwitansi_purge();
						detail_retur_paket_tokwitansi_insert();
						Ext.MessageBox.alert(post2db+' OK','Data retur penjualan paket berhasil disimpan');
						master_retur_jual_paket_DataStore.reload();
						master_retur_jual_paket_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'Data retur penjualan paket tidak bisa disimpan',
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
			return master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('rpaket_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_retur_jual_paket_reset_form(){
		rpaket_idField.reset();
		rpaket_idField.setValue(null);
		rpaket_nobuktiField.reset();
		rpaket_nobuktiField.setValue(null);
		rpaket_nobuktijualField.reset();
		rpaket_nobuktijualField.setValue(null);
		rpaket_custField.reset();
		rpaket_custField.setValue(null);
		rpaket_tanggalField.reset();
		rpaket_tanggalField.setValue(null);
		rpaket_keteranganField.reset();
		rpaket_keteranganField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_retur_jual_paket_set_form(){
		rpaket_idField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('rpaket_id'));
		rpaket_nobuktiField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('rpaket_nobukti'));
		rpaket_nobuktijualField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('rpaket_nobuktijual'));
		rpaket_custField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('rpaket_cust'));
		rpaket_custidField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('rpaket_cust_id'));
		rpaket_tanggalField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('rpaket_tanggal'));
		rpaket_keteranganField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('rpaket_keterangan'));
		rpaket_kwitansi_nilaiField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('kwitansi_nilai'));
		rpaket_kwitansi_keteranganField.setValue(master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('kwitansi_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_retur_jual_paket_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_retur_jual_paket_createWindow.isVisible()){
			detail_retur_paket_tokwitansiDataStore.setBaseParam('master_id',0);
			detail_retur_paket_tokwitansiDataStore.load();
			master_retur_jual_paket_reset_form();
			post2db='CREATE';
			msg='created';
			master_retur_jual_paket_createWindow.show();
		} else {
			master_retur_jual_paket_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_retur_jual_paket_confirm_delete(){
		// only one master_retur_jual_paket is selected here
		if(master_retur_jual_paketListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_retur_jual_paket_delete);
		} else if(master_retur_jual_paketListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_retur_jual_paket_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih data yang akan dihapus',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
	/* Function for Update Confirm */
	function master_retur_jual_paket_confirm_update(){
		/* only one record is selected here */
		if(master_retur_jual_paketListEditorGrid.selModel.getCount() == 1) {
			master_retur_jual_paket_set_form();
			post2db='UPDATE';
			detail_retur_paket_tokwitansiDataStore.load({params: {master_id:master_retur_jual_paketListEditorGrid.getSelectionModel().getSelected().get('jpaket_id'), start:0, limit:pageS}});
			msg='updated';
			master_retur_jual_paket_createWindow.show();
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
	function master_retur_jual_paket_delete(btn){
		if(btn=='yes'){
			var selections = master_retur_jual_paketListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_retur_jual_paketListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.rpaket_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_retur_jual_paket&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_retur_jual_paket_DataStore.reload();
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
	master_retur_jual_paket_DataStore = new Ext.data.Store({
		id: 'master_retur_jual_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_paket&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rpaket_id'
		},[
		/* dataIndex => insert intomaster_retur_jual_paket_ColumnModel, Mapping => for initiate table column */ 
			{name: 'rpaket_id', type: 'int', mapping: 'rpaket_id'}, 
			{name: 'rpaket_nobukti', type: 'string', mapping: 'rpaket_nobukti'}, 
			{name: 'jpaket_id', type: 'int', mapping: 'jpaket_id'}, 
			{name: 'rpaket_nobuktijual', type: 'string', mapping: 'jpaket_nobukti'}, 
			{name: 'rpaket_cust_no', type: 'string', mapping: 'cust_no'}, 
			{name: 'rpaket_cust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'rpaket_cust_id', type: 'int', mapping: 'cust_id'}, 
			{name: 'rpaket_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'rpaket_tanggal'}, 
			{name: 'rpaket_keterangan', type: 'string', mapping: 'rpaket_keterangan'}, 
			{name: 'rpaket_creator', type: 'string', mapping: 'rpaket_creator'}, 
			{name: 'rpaket_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'rpaket_date_create'}, 
			{name: 'rpaket_update', type: 'string', mapping: 'rpaket_update'}, 
			{name: 'rpaket_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'rpaket_date_update'}, 
			{name: 'rpaket_revised', type: 'int', mapping: 'rpaket_revised'},
			{name: 'kwitansi_id', type: 'int', mapping: 'kwitansi_id'},
			{name: 'kwitansi_nilai', type: 'float', mapping: 'kwitansi_nilai'},
			{name: 'kwitansi_keterangan', type: 'string', mapping: 'kwitansi_keterangan'} 
		]),
		sortInfo:{field: 'rpaket_id', direction: "DESC"}
	});
	/* End of Function */
	
	cbo_retur_paket_DataSore = new Ext.data.Store({
		id: 'cbo_retur_paket_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_paket&m=get_jual_paket_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jpaket_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'retur_paket_value', type: 'int', mapping: 'jpaket_id'},
			{name: 'retur_paket_display', type: 'string', mapping: 'jpaket_nobukti'},
			{name: 'retur_paket_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'jpaket_tanggal'},
			{name: 'retur_paket_nama_customer', type: 'string', mapping: 'cust_nama'},
			{name: 'retur_paket_customer_id', type: 'string', mapping: 'cust_id'},
			{name: 'retur_paket_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'jpaket_total_bayar', type: 'float', mapping: 'jpaket_total_bayar'},
			{name: 'jpaket_total_retur', type: 'float', mapping: 'jpaket_total_retur'}
		]),
		sortInfo:{field: 'retur_paket_display', direction: "ASC"}
	});
	
	cbo_drpaket_rawatDataStore = new Ext.data.Store({
		id: 'cbo_drpaket_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_paket&m=get_rawat_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'drpaket_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'drpaket_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'drpaket_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'drpaket_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'drpaket_rawat_display', direction: "ASC"}
	});
	var rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{drpaket_rawat_kode}| <b>{drpaket_rawat_display}</b>',
		'</div></tpl>'
    );
	
	cbo_dretur_rawatDataStore = new Ext.data.Store({
		id: 'cbo_dretur_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_paket&m=get_retur_rawat_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'dretur_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'dretur_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'dretur_rawat_harga', type: 'string', mapping: 'rawat_harga'},
			{name: 'dretur_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'dretur_rawat_display', direction: "ASC"}
	});
	var retur_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{dretur_rawat_kode}| <b>{dretur_rawat_display}</b> | Rp.{dretur_rawat_harga}',
		'</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	master_retur_jual_paket_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'rpaket_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'rpaket_tanggal',
			width: 70,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		}, 
		{
			header: '<div align="center">' + 'No Faktur' + '</div>',
			dataIndex: 'rpaket_nobukti',
			width: 100,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		}, 
		{
			header: '<div align="center">' + 'No Faktur Jual' + '</div>',
			dataIndex: 'rpaket_nobuktijual',
			width: 100,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 100
          	})
		}, 
		{
			header: '<div align="center">' + 'No Cust' + '</div>',
			dataIndex: 'rpaket_cust_no',
			width: 80,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">' + 'Customer' + '</div>',
			dataIndex: 'rpaket_cust',
			width: 200,
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
			header: '<div align="center">' + 'Nilai Kuitansi (Rp)' + '</div>',
			dataIndex: 'kwitansi_nilai',
			align: 'right',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: function(val){
				return '<span> '+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{
			header: '<div align="center">' + 'Keterangan' + '</div>',
			dataIndex: 'rpaket_keterangan',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}, 
		{
			header: 'Creator',
			dataIndex: 'rpaket_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'rpaket_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'rpaket_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'rpaket_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'rpaket_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_retur_jual_paket_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_retur_jual_paketListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_retur_jual_paketListEditorGrid',
		el: 'fp_master_retur_jual_paket',
		title: 'Daftar Retur Penjualan Paket',
		autoHeight: true,
		store: master_retur_jual_paket_DataStore, // DataStore
		cm: master_retur_jual_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_retur_jual_paket_DataStore,
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
			handler: master_retur_jual_paket_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_retur_jual_paket_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_retur_jual_paket_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_retur_jual_paket_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_retur_jual_paket_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_retur_jual_paket_print  
		}
		]
	});
	master_retur_jual_paketListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_retur_jual_paket_ContextMenu = new Ext.menu.Menu({
		id: 'master_retur_jual_paket_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_retur_jual_paket_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_retur_jual_paket_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_retur_jual_paket_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_retur_jual_paket_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_retur_jual_paket_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_retur_jual_paket_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_retur_jual_paket_SelectedRow=rowIndex;
		master_retur_jual_paket_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_retur_jual_paket_editContextMenu(){
		master_retur_jual_paketListEditorGrid.startEditing(master_retur_jual_paket_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_retur_jual_paketListEditorGrid.addListener('rowcontextmenu', onmaster_retur_jual_paket_ListEditGridContextMenu);
	master_retur_jual_paket_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_retur_jual_paketListEditorGrid.on('afteredit', master_retur_jual_paket_update); // inLine Editing Record
	
	var retur_jual_paket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{retur_paket_display}</b> | Tgl-Retur:{retur_paket_tanggal:date("M j, Y")}<br /></span>',
            'Customer: {retur_paket_nama_customer}&nbsp;&nbsp;&nbsp;[Alamat: {retur_paket_alamat}]',
        '</div></tpl>'
    );
	
	/* Identify  rpaket_id Field */
	rpaket_idField= new Ext.form.NumberField({
		id: 'rpaket_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		hideLabel: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  rpaket_nobukti Field */
	rpaket_nobuktiField= new Ext.form.TextField({
		id: 'rpaket_nobuktiField',
		fieldLabel: 'No Faktur',
		maxLength: 100,
		readOnly: true,
		anchor: '95%'
	});
	/* Identify  rpaket_nobuktijual Field */
	rpaket_nobuktijualField= new Ext.form.ComboBox({
		id: 'rpaket_nobuktijualField',
		fieldLabel: 'No Faktur Jual',
		store: cbo_retur_paket_DataSore,
		mode: 'remote',
		displayField:'retur_paket_display',
		valueField: 'retur_paket_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: retur_jual_paket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		//listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	/* Identify  rpaket_cust Field */
	rpaket_custField= new Ext.form.TextField({
		id: 'rpaket_custField',
		fieldLabel: 'Customer',
		maxLength: 100,
		anchor: '95%'
	});
	rpaket_custidField=new Ext.form.NumberField();
	/* Identify  rpaket_tanggal Field */
	rpaket_tanggalField= new Ext.form.DateField({
		id: 'rpaket_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  rpaket_keterangan Field */
	rpaket_keteranganField= new Ext.form.TextArea({
		id: 'rpaket_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	
	rpaket_kwitansi_nilaiField= new Ext.ux.form.CFTextField({
		id: 'rpaket_kwitansi_nilaiField',
		fieldLabel: 'Nilai Kuitansi(Rp)',
		valueRenderer: 'numberToCurrency',
		//allowNegatife : false,
		//blankText: '0',
		//allowDecimals: true,
		readOnly: true,
		anchor: '95%'//,
		//maskRe: /([0-9]+)$/
	});
	rpaket_kwitansi_keteranganField= new Ext.form.TextArea({
		id: 'rpaket_kwitansi_keteranganField',
		fieldLabel: 'Keterangan Kuitansi',
		maxLength: 250,
		anchor: '95%'
	});
	
	rpaket_jpaket_total_bayarField= new Ext.ux.form.CFTextField({
		id: 'rpaket_jpaket_total_bayarField',
		fieldLabel: 'No.Faktur Jual - Total Bayar',
		valueRenderer: 'numberToCurrency',
		readOnly: true,
		anchor: '95%'
	});
	
	rpaket_nobuktijualField.on('select', function(){
		var j=cbo_retur_paket_DataSore.find('retur_paket_value',rpaket_nobuktijualField.getValue());
		if(cbo_retur_paket_DataSore.getCount()){
			rpaket_custField.setValue(cbo_retur_paket_DataSore.getAt(j).data.retur_paket_nama_customer);
			rpaket_custidField.setValue(cbo_retur_paket_DataSore.getAt(j).data.retur_paket_customer_id);
			rpaket_jpaket_total_bayarField.setValue(cbo_retur_paket_DataSore.getAt(j).data.jpaket_total_bayar);
			rpaket_kwitansi_nilaiField.setValue(cbo_retur_paket_DataSore.getAt(j).data.jpaket_total_retur);
			//cbo_drpaket_rawatDataStore.load({params: {query: rpaket_nobuktijualField.getValue()}});
			detail_retur_paket_tokwitansiDataStore.load({params: {master_id:rpaket_nobuktijualField.getValue(), start:0, limit:pageS}});
		}
	});
	
  	/*Fieldset Master*/
	master_retur_jual_paket_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpaket_nobuktiField, rpaket_nobuktijualField, rpaket_custField, rpaket_jpaket_total_bayarField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpaket_tanggalField, rpaket_keteranganField, rpaket_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
	/* START Detail Retur to Kwitansi */
	// Function for json reader of detail
	var detail_retur_paket_tokwitansi_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			/*{name: 'sapaket_master', type: 'int', mapping: 'sapaket_master'}, 
			{name: 'sapaket_item', type: 'int', mapping: 'sapaket_item'}, 
			{name: 'sapaket_item_nama', type: 'string', mapping: 'sapaket_item_nama'}, 
			{name: 'jumlah_terpakai', type: 'int', mapping: 'jumlah_terpakai'}, 
			{name: 'rawat_harga', type: 'float', mapping: 'rawat_harga'} */
			{name: 'rpaket_perawatan', type: 'int', mapping: 'rpaket_perawatan'}, 
			{name: 'rawat_nama', type: 'string', mapping: 'rawat_nama'}, 
			{name: 'total_sisa_item', type: 'int', mapping: 'total_sisa_item'}, 
			{name: 'total_ambil_item', type: 'int', mapping: 'total_ambil_item'}, 
			{name: 'rawat_harga', type: 'float', mapping: 'rawat_harga'}
	]);
	//eof
	
	//function for json writer of detail
	var detail_retur_paket_tokwitansi_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_retur_paket_tokwitansiDataStore = new Ext.data.Store({
		id: 'detail_retur_paket_tokwitansiDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_retur_jual_paket&m=detail_retur_paket_tokwitansi_list', 
			method: 'POST'
		}),
		reader: detail_retur_paket_tokwitansi_reader,
		baseParams:{master_id: rpaket_idField.getValue(), start:0, limit:pageS},
		sortInfo:{field: 'rawat_nama', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_retur_paket_tokwitansi= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	var combo_retur_paket_tokwitansi=new Ext.form.ComboBox({
			store: cbo_drpaket_rawatDataStore,
			mode: 'local',
			displayField: 'drpaket_rawat_display',
			valueField: 'drpaket_rawat_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'

	});
	
	//declaration of detail coloumn model
	detail_retur_paket_tokwitansiColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Perawatan',
			dataIndex: 'rawat_nama',
			width: 150,
			sortable: true/*,
			editor: combo_retur_paket_tokwitansi,
			renderer: Ext.util.Format.comboRenderer(combo_retur_paket_tokwitansi)*/
		},
		{
			header: 'Jumlah Diambil',
			dataIndex: 'total_ambil_item',
			width: 150,
			sortable: true/*,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})*/
		},
		{
			header: 'Harga',
			dataIndex: 'rawat_harga',
			width: 150,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},
		{
			header: 'Sub Total',
			dataIndex: 'drpaket_subtotal',
			width: 150,
			sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
				return Ext.util.Format.number(record.data.total_ambil_item*record.data.rawat_harga,'0,000');
			}
		}]
	);
	detail_retur_paket_tokwitansiColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	detail_retur_paket_tokwitansiListEditorGrid =  new Ext.grid.GridPanel({
		id: 'detail_retur_paket_tokwitansiListEditorGrid',
		el: 'fp_detail_retur_paket_tokwitansi',
		title: 'Detail detail_retur_paket_rawat',
		height: 250,
		width: 690,
		autoScroll: true,
		store: detail_retur_paket_tokwitansiDataStore, // DataStore
		colModel: detail_retur_paket_tokwitansiColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		//plugins: [editor_detail_retur_paket_tokwitansi],
		frame: true,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_retur_paket_tokwitansiDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: detail_retur_paket_tokwitansi_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: detail_retur_paket_tokwitansi_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function detail_retur_paket_tokwitansi_add(){
		var edit_detail_retur_paket_tokwitansi= new detail_retur_paket_tokwitansiListEditorGrid.store.recordType({
			drpaket_id	:'',		
			drpaket_master	:'',		
			drpaket_rawat	:'',		
			drpaket_jumlah	:'',		
			drpaket_harga	:''		
		});
		editor_detail_retur_paket_tokwitansi.stopEditing();
		detail_retur_paket_tokwitansiDataStore.insert(0, edit_detail_retur_paket_tokwitansi);
		detail_retur_paket_tokwitansiListEditorGrid.getView().refresh();
		detail_retur_paket_tokwitansiListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_retur_paket_tokwitansi.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_detail_retur_paket_tokwitansi(){
		/*var sum_subtotal_detail=0;
		//detail_retur_paket_tokwitansiDataStore.commitChanges();
		detail_retur_paket_tokwitansiListEditorGrid.getView().refresh();
		detail_retur_tokwitansi_record=detail_retur_paket_tokwitansiDataStore.getAt(0);
		if(detail_retur_paket_tokwitansiDataStore.getCount()>=0){
			var drtokwitansi = cbo_drpaket_rawatDataStore.find('drpaket_rawat_value',detail_retur_tokwitansi_record.data.drpaket_rawat);
			if(drtokwitansi>=0){
				detail_retur_tokwitansi_record.data.drpaket_harga=cbo_drpaket_rawatDataStore.getAt(drtokwitansi).data.drpaket_rawat_harga;
				
				for(i=0;i<detail_retur_paket_tokwitansiDataStore.getCount();i++){
					sum_subtotal_detail+=(detail_retur_paket_tokwitansiDataStore.getAt(i).data.drpaket_jumlah*cbo_drpaket_rawatDataStore.getAt(drtokwitansi).data.drpaket_rawat_harga);
					rpaket_kwitansi_nilaiField.setValue(sum_subtotal_detail);
				}
			}
		}*/
		var sum_subtotal_detail=0;
		var total_nilai_kuitansi=0;
		if(detail_retur_paket_tokwitansiDataStore.getCount()>0){
			for(i=0;i<detail_retur_paket_tokwitansiDataStore.getCount();i++){
				sum_subtotal_detail += ((detail_retur_paket_tokwitansiDataStore.getAt(i).data.total_ambil_item)*(detail_retur_paket_tokwitansiDataStore.getAt(i).data.rawat_harga));
			}
			total_nilai_kuitansi = rpaket_jpaket_total_bayarField.getValue()-sum_subtotal_detail;
			rpaket_kwitansi_nilaiField.setValue(total_nilai_kuitansi);
		}
	}
	//eof
	
	//function for insert detail
	function detail_retur_paket_tokwitansi_insert(){
		for(i=0;i<detail_retur_paket_tokwitansiDataStore.getCount();i++){
			detail_retur_paket_rawat_record=detail_retur_paket_tokwitansiDataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_retur_jual_paket&m=detail_retur_paket_tokwitansi_insert',
				params:{
				drpaket_id	: detail_retur_paket_rawat_record.data.drpaket_id, 
				drpaket_master	: eval(rpaket_idField.getValue()), 
				drpaket_rawat	: detail_retur_paket_rawat_record.data.drpaket_rawat, 
				drpaket_jumlah	: detail_retur_paket_rawat_record.data.drpaket_jumlah, 
				drpaket_harga	: detail_retur_paket_rawat_record.data.drpaket_harga 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function detail_retur_paket_tokwitansi_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_retur_jual_paket&m=detail_retur_paket_tokwitansi_purge',
			params:{ master_id: eval(rpaket_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_retur_paket_tokwitansi_confirm_delete(){
		// only one record is selected here
		if(detail_retur_paket_tokwitansiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_retur_paket_tokwitansi_delete);
		} else if(detail_retur_paket_tokwitansiListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_retur_paket_tokwitansi_delete);
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
	function detail_retur_paket_tokwitansi_delete(btn){
		if(btn=='yes'){
			var s = detail_retur_paket_tokwitansiListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_retur_paket_tokwitansiDataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	//detail_retur_paket_tokwitansiDataStore.on('update', refresh_detail_retur_paket_tokwitansi);
	detail_retur_paket_tokwitansiDataStore.on('load', refresh_detail_retur_paket_tokwitansi);
	
	kwitansi_tercetakGroup = new Ext.form.FieldSet({
		title: 'Kuitansi Tercetak',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpaket_kwitansi_nilaiField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpaket_kwitansi_keteranganField] 
			}
			]
	
	});
	/* END Detail Retur to Kwitansi */
	
	/* Function for retrieve create Window Panel*/ 
	master_retur_jual_paket_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [master_retur_jual_paket_masterGroup,detail_retur_paket_tokwitansiListEditorGrid,kwitansi_tercetakGroup]
		,
		buttons: [{
				text: 'Cetak Kuitansi',
				handler: master_retur_jual_paket_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_retur_jual_paket_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_retur_jual_paket_createWindow= new Ext.Window({
		id: 'master_retur_jual_paket_createWindow',
		title: post2db+'Retur Penjualan Paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_retur_jual_paket_create',
		items: master_retur_jual_paket_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function master_retur_jual_paket_list_search(){
		// render according to a SQL date format.
		var rpaket_id_search=null;
		var rpaket_nobukti_search=null;
		var rpaket_nobuktijual_search=null;
		var rpaket_cust_search=null;
		var rpaket_tanggal_search_date="";
		var rpaket_keterangan_search=null;

		if(rpaket_idSearchField.getValue()!==null){rpaket_id_search=rpaket_idSearchField.getValue();}
		if(rpaket_nobuktiSearchField.getValue()!==null){rpaket_nobukti_search=rpaket_nobuktiSearchField.getValue();}
		if(rpaket_nobuktijualSearchField.getValue()!==null){rpaket_nobuktijual_search=rpaket_nobuktijualSearchField.getValue();}
		if(rpaket_custSearchField.getValue()!==null){rpaket_cust_search=rpaket_custSearchField.getValue();}
		if(rpaket_tanggalSearchField.getValue()!==""){rpaket_tanggal_search_date=rpaket_tanggalSearchField.getValue().format('Y-m-d');}
		if(rpaket_keteranganSearchField.getValue()!==null){rpaket_keterangan_search=rpaket_keteranganSearchField.getValue();}
		// change the store parameters
		master_retur_jual_paket_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			rpaket_id	:	rpaket_id_search, 
			rpaket_nobukti	:	rpaket_nobukti_search, 
			rpaket_nobuktijual	:	rpaket_nobuktijual_search, 
			rpaket_cust	:	rpaket_cust_search, 
			rpaket_tanggal	:	rpaket_tanggal_search_date, 
			rpaket_keterangan	:	rpaket_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		master_retur_jual_paket_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_retur_jual_paket_reset_search(){
		// reset the store parameters
		master_retur_jual_paket_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_retur_jual_paket_DataStore.reload({params: {start: 0, limit: pageS}});
		master_retur_jual_paket_searchWindow.close();
	};
	/* End of Fuction */
	
	function master_retur_jual_paket_reset_SearchForm(){
		rpaket_nobuktiSearchField.reset();
		rpaket_nobuktijualSearchField.reset();
		rpaket_custSearchField.reset();
		rpaket_tanggalSearchField.reset();
		rpaket_keteranganSearchField.reset();
	}
	
	
	/* Field for search */
	/* Identify  rpaket_id Search Field */
	rpaket_idSearchField= new Ext.form.NumberField({
		id: 'rpaket_idSearchField',
		fieldLabel: 'Rpaket Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  rpaket_nobukti Search Field */
	rpaket_nobuktiSearchField= new Ext.form.TextField({
		id: 'rpaket_nobuktiSearchField',
		fieldLabel: 'Rpaket Nobukti',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  rpaket_nobuktijual Search Field */
	rpaket_nobuktijualSearchField= new Ext.form.TextField({
		id: 'rpaket_nobuktijualSearchField',
		fieldLabel: 'Rpaket Nobuktijual',
		maxLength: 100,
		anchor: '95%'
	
	});
	/* Identify  rpaket_cust Search Field */
	rpaket_custSearchField= new Ext.form.NumberField({
		id: 'rpaket_custSearchField',
		fieldLabel: 'Rpaket Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  rpaket_tanggal Search Field */
	rpaket_tanggalSearchField= new Ext.form.DateField({
		id: 'rpaket_tanggalSearchField',
		fieldLabel: 'Rpaket Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  rpaket_keterangan Search Field */
	rpaket_keteranganSearchField= new Ext.form.TextField({
		id: 'rpaket_keteranganSearchField',
		fieldLabel: 'Rpaket Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_retur_jual_paket_searchForm = new Ext.FormPanel({
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
				items: [rpaket_nobuktiSearchField, rpaket_nobuktijualSearchField, rpaket_custSearchField, rpaket_tanggalSearchField, rpaket_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_retur_jual_paket_list_search
			},{
				text: 'Close',
				handler: function(){
					master_retur_jual_paket_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_retur_jual_paket_searchWindow = new Ext.Window({
		title: 'Pencarian Retur Penjualan Paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_retur_jual_paket_search',
		items: master_retur_jual_paket_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_retur_jual_paket_searchWindow.isVisible()){
			master_retur_jual_paket_reset_SearchForm();
			master_retur_jual_paket_searchWindow.show();
		} else {
			master_retur_jual_paket_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_retur_jual_paket_print(){
		var searchquery = "";
		var rpaket_nobukti_print=null;
		var rpaket_nobuktijual_print=null;
		var rpaket_cust_print=null;
		var rpaket_tanggal_print_date="";
		var rpaket_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_retur_jual_paket_DataStore.baseParams.query!==null){searchquery = master_retur_jual_paket_DataStore.baseParams.query;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_nobukti!==null){rpaket_nobukti_print = master_retur_jual_paket_DataStore.baseParams.rpaket_nobukti;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_nobuktijual!==null){rpaket_nobuktijual_print = master_retur_jual_paket_DataStore.baseParams.rpaket_nobuktijual;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_cust!==null){rpaket_cust_print = master_retur_jual_paket_DataStore.baseParams.rpaket_cust;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_tanggal!==""){rpaket_tanggal_print_date = master_retur_jual_paket_DataStore.baseParams.rpaket_tanggal;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_keterangan!==null){rpaket_keterangan_print = master_retur_jual_paket_DataStore.baseParams.rpaket_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_retur_jual_paket&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			rpaket_nobukti : rpaket_nobukti_print,
			rpaket_nobuktijual : rpaket_nobuktijual_print,
			rpaket_cust : rpaket_cust_print,
		  	rpaket_tanggal : rpaket_tanggal_print_date, 
			rpaket_keterangan : rpaket_keterangan_print,
		  	currentlisting: master_retur_jual_paket_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_retur_jual_paketlist.html','master_retur_jual_paketlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_retur_jual_paket_export_excel(){
		var searchquery = "";
		var rpaket_nobukti_2excel=null;
		var rpaket_nobuktijual_2excel=null;
		var rpaket_cust_2excel=null;
		var rpaket_tanggal_2excel_date="";
		var rpaket_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_retur_jual_paket_DataStore.baseParams.query!==null){searchquery = master_retur_jual_paket_DataStore.baseParams.query;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_nobukti!==null){rpaket_nobukti_2excel = master_retur_jual_paket_DataStore.baseParams.rpaket_nobukti;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_nobuktijual!==null){rpaket_nobuktijual_2excel = master_retur_jual_paket_DataStore.baseParams.rpaket_nobuktijual;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_cust!==null){rpaket_cust_2excel = master_retur_jual_paket_DataStore.baseParams.rpaket_cust;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_tanggal!==""){rpaket_tanggal_2excel_date = master_retur_jual_paket_DataStore.baseParams.rpaket_tanggal;}
		if(master_retur_jual_paket_DataStore.baseParams.rpaket_keterangan!==null){rpaket_keterangan_2excel = master_retur_jual_paket_DataStore.baseParams.rpaket_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_retur_jual_paket&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			rpaket_nobukti : rpaket_nobukti_2excel,
			rpaket_nobuktijual : rpaket_nobuktijual_2excel,
			rpaket_cust : rpaket_cust_2excel,
		  	rpaket_tanggal : rpaket_tanggal_2excel_date, 
			rpaket_keterangan : rpaket_keterangan_2excel,
		  	currentlisting: master_retur_jual_paket_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_retur_jual_paket"></div>
         <div id="fp_detail_retur_paket_tokwitansi"></div>
		<div id="elwindow_master_retur_jual_paket_create"></div>
        <div id="elwindow_master_retur_jual_paket_search"></div>
    </div>
</div>
</body>