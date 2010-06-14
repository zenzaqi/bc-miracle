<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_lunas_piutang View
	+ Description	: For record view
	+ Filename 		: v_master_lunas_piutang.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:02:05
	
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
var master_lunas_piutang_DataStore;
var master_lunas_piutang_ColumnModel;
var master_lunas_piutangListEditorGrid;
var multi_lunas_piutang_createForm;
var multi_lunas_piutang_createWindow;
var master_lunas_piutang_searchForm;
var master_lunas_piutang_searchWindow;
var master_lunas_piutang_SelectedRow;
var master_lunas_piutang_ContextMenu;
//for detail data
var detail_lunas_piutang_DataStor;
var form_bayar_piutangListEditorGrid;
var form_bayar_piutang_ColumnModel;
var detail_lunas_piutang_proxy;
var form_bayar_piutang_writer;
var form_bayar_piutang_reader;
var editor_form_bayar_piutang;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var lpiutang_idField;
var lpiutang_fakturField;
var lpiutang_custField;
var lpiutang_tanggalField;
var lpiutang_keteranganField;
var lpiutang_idSearchField;
var lpiutang_noSearchField;
var lpiutang_custSearchField;
var lpiutang_tanggalSearchField;
var lpiutang_keteranganSearchField;


function piutang_cetak(dpiutang_nobukti){
	Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_master_lunas_piutang&m=print_paper',
		params: { dpiutang_nobukti : dpiutang_nobukti}, 
		success: function(response){              
			var result=eval(response.responseText);
			switch(result){
			case 1:
				win = window.open('./piutang_paper.html','Cetak Pelunasan Piutang','height=480,width=1340,resizable=1,scrollbars=0, menubar=0');
				//win.print();
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


Ext.util.Format.comboRenderer = function(combo){
	return function(value){
		var record = combo.findRecord(combo.valueField, value);
		return record ? record.get(combo.displayField) : combo.valueNotFoundText;
	}
}

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_lunas_piutang_update(oGrid_event){
		var lpiutang_id_update_pk="";
		var lpiutang_no_update=null;
		var lpiutang_cust_update=null;
		var lpiutang_tanggal_update_date="";
		var lpiutang_keterangan_update=null;

		lpiutang_id_update_pk = oGrid_event.record.data.lpiutang_id;
		if(oGrid_event.record.data.lpiutang_no!== null){lpiutang_no_update = oGrid_event.record.data.lpiutang_no;}
		if(oGrid_event.record.data.lpiutang_cust!== null){lpiutang_cust_update = oGrid_event.record.data.lpiutang_cust;}
	 	if(oGrid_event.record.data.lpiutang_tanggal!== ""){lpiutang_tanggal_update_date =oGrid_event.record.data.lpiutang_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.lpiutang_keterangan!== null){lpiutang_keterangan_update = oGrid_event.record.data.lpiutang_keterangan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_lunas_piutang&m=get_action',
			params: {
				task: "UPDATE",
				lpiutang_id	: lpiutang_id_update_pk, 
				lpiutang_no	:lpiutang_no_update,  
				lpiutang_cust	:lpiutang_cust_update,  
				lpiutang_tanggal	: lpiutang_tanggal_update_date, 
				lpiutang_keterangan	:lpiutang_keterangan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						master_lunas_piutang_DataStore.commitChanges();
						master_lunas_piutang_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the master_lunas_piutang.',
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
	function master_lunas_piutang_create(){
	
		if(is_master_lunas_piutang_form_valid()){	
		var lpiutang_id_create_pk=null; 
		var lpiutang_faktur_create=null; 
		var lpiutang_cust_create=null; 
		var lpiutang_tanggal_create_date=""; 
		var lpiutang_keterangan_create=null; 
		var piutang_cara_create=null;

		if(lpiutang_idField.getValue()!== null){lpiutang_id_create = lpiutang_idField.getValue();}else{lpiutang_id_create_pk=get_pk_id();} 
		if(lpiutang_fakturField.getValue()!== null){lpiutang_faktur_create = lpiutang_fakturField.getValue();} 
		if(lpiutang_custField.getValue()!== null){lpiutang_cust_create = lpiutang_custField.getValue();} 
		if(lpiutang_tanggalField.getValue()!== ""){lpiutang_tanggal_create_date = lpiutang_tanggalField.getValue().format('Y-m-d');} 
		if(lpiutang_keteranganField.getValue()!== null){lpiutang_keterangan_create = lpiutang_keteranganField.getValue();} 
		if(piutang_caraField.getValue()!== null){piutang_cara_create = piutang_caraField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_lunas_piutang&m=get_action',
			params: {
				task: post2db,
				lpiutang_id	: lpiutang_id_create_pk, 
				lpiutang_faktur	: lpiutang_faktur_create, 
				lpiutang_cust	: lpiutang_cust_create, 
				lpiutang_tanggal	: lpiutang_tanggal_create_date, 
				lpiutang_keterangan	: lpiutang_keterangan_create, 
				piutang_cara	: piutang_cara_create
			}, 
			success: function(response){             
				//var result=eval(response.responseText);
				var result=response.responseText;
				if(result!==''){
					form_bayar_piutang_insert(result);
					Ext.MessageBox.alert(post2db+' OK','The Master_lunas_piutang was '+msg+' successfully.');
					master_lunas_piutang_DataStore.reload();
					single_lunas_piutang_createWindow.hide();
				}else{
					Ext.MessageBox.show({
					   title: 'Warning',
					   msg: 'We could\'t not '+msg+' the Master_lunas_piutang.',
					   buttons: Ext.MessageBox.OK,
					   animEl: 'save',
					   icon: Ext.MessageBox.WARNING
					});
					master_lunas_piutang_DataStore.reload();
					single_lunas_piutang_createWindow.hide();
				}
				/*switch(result){
					case 1:
						//form_bayar_piutang_purge();
						form_bayar_piutang_insert();
						Ext.MessageBox.alert(post2db+' OK','The Master_lunas_piutang was '+msg+' successfully.');
						master_lunas_piutang_DataStore.reload();
						single_lunas_piutang_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_lunas_piutang.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
				}        */
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
			return master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	function piutang_bayar_tunai_reset_form(){
		piutang_tunai_nilaiField.reset();
		piutang_tunai_nilaiField.setValue(null);
	}
	
	function piutang_bayar_card_reset_form(){
		piutang_card_namaField.reset();
		piutang_card_namaField.setValue(null);
		piutang_card_edcField.reset();
		piutang_card_edcField.setValue(null);
		piutang_card_noField.reset();
		piutang_card_noField.setValue(null);
		piutang_card_nilaiField.reset();
		piutang_card_nilaiField.setValue(null);
	}
	
	function piutang_bayar_cek_reset_form(){
		piutang_cek_namaField.reset();
		piutang_cek_namaField.setValue(null);
		piutang_cek_noField.reset();
		piutang_cek_noField.setValue(null);
		piutang_cek_validField.reset();
		piutang_cek_validField.setValue(null);
		piutang_cek_bankField.reset();
		piutang_cek_bankField.setValue(null);
		piutang_cek_nilaiField.reset();
		piutang_cek_nilaiField.setValue(null);
	}
	
	function piutang_bayar_transfer_reset_form(){
		piutang_transfer_bankField.reset();
		piutang_transfer_bankField.setValue(null);
		piutang_transfer_namaField.reset();
		piutang_transfer_namaField.setValue(null);
		piutang_transfer_nilaiField.reset();
		piutang_transfer_nilaiField.setValue(null);
	}
	
	/* Reset form before loading */
	function master_lunas_piutang_reset_form(){
		lpiutang_idField.reset();
		lpiutang_idField.setValue(null);
		lpiutang_fakturField.reset();
		lpiutang_fakturField.setValue(null);
		lpiutang_custField.reset();
		lpiutang_custField.setValue(null);
		lpiutang_tanggalField.reset();
		lpiutang_tanggalField.setValue(null);
		lpiutang_keteranganField.reset();
		lpiutang_keteranganField.setValue(null);
		piutang_caraField.reset();
		piutang_caraField.setValue(null);
		
		piutang_bayar_tunai_reset_form();
		piutang_bayar_card_reset_form();
		piutang_bayar_cek_reset_form();
		piutang_bayar_transfer_reset_form();
		
		piutang_bayar_tunaiGroup.setVisible(false);
		piutang_bayar_cardGroup.setVisible(false);
		piutang_bayar_cekGroup.setVisible(false);
		piutang_bayar_transferGroup.setVisible(false);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_lunas_piutang_set_form(){
		lpiutang_idField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_id'));
		lpiutang_fakturField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_faktur'));
		lpiutang_custField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('cust_nama'));
		lpiutang_tanggalField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_tanggal'));
		lpiutang_keteranganField.setValue(master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_keterangan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_lunas_piutang_form_valid(){
		return (true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!multi_lunas_piutang_createWindow.isVisible()){
			master_lunas_piutang_reset_form();
			post2db='CREATE';
			msg='created';
			multi_lunas_piutang_createWindow.show();
		} else {
			multi_lunas_piutang_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_lunas_piutang_confirm_delete(){
		// only one master_lunas_piutang is selected here
		if(master_lunas_piutangListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', master_lunas_piutang_delete);
		} else if(master_lunas_piutangListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', master_lunas_piutang_delete);
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
	function master_lunas_piutang_confirm_update(){
		/* only one record is selected here */
		if(master_lunas_piutangListEditorGrid.selModel.getCount() == 1) {
			master_lunas_piutang_reset_form();
			master_lunas_piutang_set_form();
			piutang_caraField.setValue("card");
			piutang_bayar_cardGroup.setVisible(true);
			post2db='UPDATE';
			form_bayar_piutang_DataStore.load({
				params : {cust_id : master_lunas_piutangListEditorGrid.getSelectionModel().getSelected().get('lpiutang_cust')},
				callback: function(opts, success, response){
					var total_piutang=0;
					if(success){
						for(i=0;i<form_bayar_piutang_DataStore.getCount();i++){
							total_piutang += form_bayar_piutang_DataStore.getAt(i).data.lpiutang_sisa;
						}
						piutang_total_nilaiField.setValue(total_piutang);
					}
				}
			});
			msg='updated';
			single_lunas_piutang_createWindow.show();
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
	function master_lunas_piutang_delete(btn){
		if(btn=='yes'){
			var selections = master_lunas_piutangListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_lunas_piutangListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.lpiutang_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_master_lunas_piutang&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_lunas_piutang_DataStore.reload();
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
	master_lunas_piutang_DataStore = new Ext.data.GroupingStore({
		id: 'master_lunas_piutang_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_lunas_piutang&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'lpiutang_id'
		},[
		/* dataIndex => insert intomaster_lunas_piutang_ColumnModel, Mapping => for initiate table column */ 
			{name: 'lpiutang_id', type: 'int', mapping: 'lpiutang_id'}, 
			{name: 'lpiutang_faktur', type: 'string', mapping: 'lpiutang_faktur'}, 
			{name: 'lpiutang_cust', type: 'int', mapping: 'lpiutang_cust'}, 
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'}, 
			{name: 'lpiutang_faktur_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'lpiutang_faktur_tanggal'}, 
			{name: 'lpiutang_total', type: 'float', mapping: 'lpiutang_total'}, 
			{name: 'lpiutang_sisa', type: 'float', mapping: 'lpiutang_sisa'}, 
			{name: 'lpiutang_keterangan', type: 'string', mapping: 'lpiutang_keterangan'}, 
			{name: 'lpiutang_status', type: 'string', mapping: 'lpiutang_status'}, 
			{name: 'lpiutang_creator', type: 'string', mapping: 'lpiutang_creator'}, 
			{name: 'lpiutang_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'lpiutang_date_create'}, 
			{name: 'lpiutang_update', type: 'string', mapping: 'lpiutang_update'}, 
			{name: 'lpiutang_date_update', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'lpiutang_date_update'}, 
			{name: 'lpiutang_revised', type: 'int', mapping: 'lpiutang_revised'} 
		]),
		sortInfo:{field: 'lpiutang_id', direction: "DESC"},
		groupField: 'cust_nama'
	});
	/* End of Function */
	
	//ComboBox ambil data Customer
	cbo_cutomerDataStore = new Ext.data.Store({
		id: 'cbo_cutomerDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_lunas_piutang&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: 10 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'cust_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'cust_id', type: 'int', mapping: 'cust_id'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'cust_no', direction: "ASC"}
	});
	//Template yang akan tampil di ComboBox
	var customer_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	cbo_nofaktur_jualDataStore = new Ext.data.Store({
		id: 'cbo_nofaktur_jualDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_lunas_piutang&m=get_faktur_jual_list_bycust', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'lpiutang_id'
		},[
			{name: 'cbo_nofaktur_value', type: 'int', mapping: 'lpiutang_id'},
			{name: 'cbo_nofaktur_display', type: 'string', mapping: 'lpiutang_faktur'},
			{name: 'cbo_nofaktur_tgl', type: 'date', dateFormat:'Y-m-d', mapping: 'lpiutang_faktur_tanggal'},
			{name: 'cbo_nofaktur_total', type: 'float', mapping: 'lpiutang_total'},
			{name: 'cbo_nofaktur_sisa', type: 'float', mapping: 'lpiutang_sisa'}
		]),
		sortInfo:{field: 'cbo_nofaktur_display', direction: "ASC"}
	});
	var nofaktur_jual_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cbo_nofaktur_display}</b>| Jumlah Piutang: <b>{cbo_nofaktur_sisa}</b>',
		'</div></tpl>'
    );
	
	/* GET Bank-List.Store */
	piutang_bankDataStore = new Ext.data.Store({
		id:'piutang_bankDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_lunas_piutang&m=get_bank_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'mbank_id'
		},[
		/* dataIndex => insert intomaster_jual_produk_ColumnModel, Mapping => for initiate table column */ 
			{name: 'piutang_bank_value', type: 'int', mapping: 'mbank_id'}, 
			{name: 'piutang_bank_display', type: 'string', mapping: 'mbank_nama'}
		]),
		sortInfo:{field: 'piutang_bank_display', direction: "DESC"}
		});
	/* END GET Bank-List.Store */
    
  	/* Function for Identify of Window Column Model */
	master_lunas_piutang_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'lpiutang_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'No.Faktur Jual',
			dataIndex: 'lpiutang_faktur',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'lpiutang_faktur_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
		}, 
		{
			header: 'Customer',
			dataIndex: 'cust_nama',
			width: 210,
			sortable: true,
			hidden: true
		}, 
		{
			header: 'Total Piutang',
			dataIndex: 'lpiutang_total',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		}, 
		{
			header: 'Sisa Piutang',
			dataIndex: 'lpiutang_sisa',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		}, 
		{
			header: 'Keterangan',
			dataIndex: 'lpiutang_keterangan',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 150
          	})
		}, 
		{
			header: 'Status',
			dataIndex: 'lpiutang_status',
			width: 150,
			sortable: true
		}, 
		{
			header: 'Creator',
			dataIndex: 'lpiutang_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Create',
			dataIndex: 'lpiutang_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Update',
			dataIndex: 'lpiutang_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Date Update',
			dataIndex: 'lpiutang_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'lpiutang_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_lunas_piutang_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_lunas_piutangListEditorGrid =  new Ext.grid.GridPanel({
		id: 'master_lunas_piutangListEditorGrid',
		el: 'fp_master_lunas_piutang',
		title: 'List Of Master_lunas_piutang',
		autoHeight: true,
		store: master_lunas_piutang_DataStore, // DataStore
		cm: master_lunas_piutang_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		trackMouseOver: false,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		view: new Ext.grid.GroupingView({
            forceFit:true,
            groupTextTpl: '{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})'
        }),
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_lunas_piutang_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			disabled: true,
			handler: display_form_window
		}, '-',{
			text: 'Bayar',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: master_lunas_piutang_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: master_lunas_piutang_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_lunas_piutang_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_lunas_piutang_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_lunas_piutang_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_lunas_piutang_print  
		}
		]
	});
	master_lunas_piutangListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_lunas_piutang_ContextMenu = new Ext.menu.Menu({
		id: 'master_lunas_piutang_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_lunas_piutang_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_lunas_piutang_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_lunas_piutang_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_lunas_piutang_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	master_lunas_piutangListEditorGrid.on('rowclick', function (master_lunas_piutangListEditorGrid, rowIndex, eventObj) {
        var recordMaster = master_lunas_piutangListEditorGrid.getSelectionModel().getSelected();
        detail_bayar_piutangStore.setBaseParam('lpiutang_id',recordMaster.get("lpiutang_id"));
		detail_bayar_piutangStore.load({params : {lpiutang_id : recordMaster.get("lpiutang_id"), start:0, limit:pageS}});
		master_lunas_piutang_DataStore.reload();
    });
	
	/* Event while selected row via context menu */
	function onmaster_lunas_piutang_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_lunas_piutang_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_lunas_piutang_SelectedRow=rowIndex;
		master_lunas_piutang_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_lunas_piutang_editContextMenu(){
		master_lunas_piutangListEditorGrid.startEditing(master_lunas_piutang_SelectedRow,1);
  	}
	/* End of Function */
  	
	master_lunas_piutangListEditorGrid.addListener('rowcontextmenu', onmaster_lunas_piutang_ListEditGridContextMenu);
	master_lunas_piutang_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_lunas_piutangListEditorGrid.on('afteredit', master_lunas_piutang_update); // inLine Editing Record
	
	/* Identify  lpiutang_id Field */
	lpiutang_idField= new Ext.form.NumberField({
		id: 'lpiutang_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  lpiutang_no Field */
	lpiutang_fakturField= new Ext.form.TextField({
		id: 'lpiutang_fakturField',
		fieldLabel: 'No.Faktur',
		readOnly: true,
		maxLength: 50,
		emptyText: '(auto)',
		anchor: '95%'
	});
	lpiutang_custField= new Ext.form.TextField({
		id: 'lpiutang_custField',
		fieldLabel: 'Customer',
		readOnly: true,
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  lpiutang_cust Field */
	/*lpiutang_custField= new Ext.form.ComboBox({
		id: 'lpiutang_custField',
		fieldLabel: 'Customer',
		store: cbo_cutomerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_tpl,
        itemSelector: 'div.search-item',
		triggerAction: 'query',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		anchor: '95%',
		queryDelay:1200,
		listeners:{
			render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- No.Customer<br>- Nama Customer<br>- No.Telp Rumah<br>- No.Telp Kantor<br>- No.HP'});
			}
		}
	});*/
	/* Identify  lpiutang_tanggal Field */
	lpiutang_tanggalField= new Ext.form.DateField({
		id: 'lpiutang_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
	});
	/* Identify  lpiutang_keterangan Field */
	lpiutang_keteranganField= new Ext.form.TextArea({
		id: 'lpiutang_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 150,
		height: 65,
		anchor: '95%'
	});
	
	/* Identify  piutang_total_nilai Field */
	piutang_total_nilaiField= new Ext.form.NumberField({
		id: 'piutang_total_nilaiField',
		fieldLabel: '<b>Total (Rp)</b>',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '100%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  piutang_total_bayar Field */
	piutang_total_bayarField= new Ext.form.NumberField({
		id: 'piutang_total_bayarField',
		fieldLabel: 'Total Bayar (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		readOnly: true,
		anchor: '100%',
		maskRe: /([0-9]+)$/
	});
	
	
  	/*Fieldset Master*/
	multi_lunas_piutang_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [lpiutang_custField, lpiutang_tanggalField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [lpiutang_keteranganField, lpiutang_idField] 
			}
			]
	
	});
	
	single_lunas_piutang_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [lpiutang_custField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [lpiutang_keteranganField] 
			}
			]
	
	});
	
	//START Bayar Tunai
	piutang_tunai_nilaiField= new Ext.form.NumberField({
		id: 'piutang_tunai_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});

	piutang_bayar_tunaiGroup = new Ext.form.FieldSet({
		title: 'Tunai',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '99%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [/*piutang_tunai_nilaiField*/] 
			}
		]
	
	});
	// END Bayar Tunai
	
	// START Bayar Card
	piutang_card_namaField= new Ext.form.ComboBox({
		id: 'piutang_card_namaField',
		fieldLabel: 'Jenis Kartu',
		store:new Ext.data.SimpleStore({
			fields:['piutang_card_value', 'piutang_card_display'],
			data:[['VISA','VISA'],['MASTERCARD','MASTERCARD'],['Debit','Debit']]
		}),
		mode: 'local',
		displayField: 'piutang_card_display',
		valueField: 'piutang_card_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
		
	piutang_card_edcField= new Ext.form.ComboBox({
		id: 'piutang_card_edcField',
		fieldLabel: 'EDC',
		store:new Ext.data.SimpleStore({
			fields:['piutang_card_edc_value', 'piutang_card_edc_display'],
			data:[['1','1'],['2','2'],['3','3']]
		}),
		mode: 'local',
		displayField: 'piutang_card_edc_display',
		valueField: 'piutang_card_edc_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	piutang_card_noField= new Ext.form.TextField({
		id: 'piutang_card_noField',
		fieldLabel: 'No. Kartu',
		maxLength: 30,
		anchor: '95%'
	});
	
	piutang_card_nilaiField= new Ext.form.NumberField({
		id: 'piutang_card_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	piutang_bayar_cardGroup= new Ext.form.FieldSet({
		title: 'Credit Card',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		anchor: '99%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [piutang_card_namaField,piutang_card_edcField,piutang_card_noField/*,piutang_card_nilaiField*/] 
			}
		]
	
	});
	// END Bayar Card
	// START Bayar Cek
	piutang_cek_namaField= new Ext.form.TextField({
		id: 'piutang_cek_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%'
	});
	
	piutang_cek_noField= new Ext.form.TextField({
		id: 'piutang_cek_noField',
		fieldLabel: 'No. Cek/Giro',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	piutang_cek_validField= new Ext.form.DateField({
		id: 'piutang_cek_validField',
		allowBlank: true,
		fieldLabel: 'Valid',
		format: 'Y-m-d'
	});
	
	piutang_cek_bankField= new Ext.form.ComboBox({
		id: 'piutang_cek_bankField',
		fieldLabel: 'Bank',
		store: piutang_bankDataStore,
		mode: 'remote',
		displayField: 'piutang_bank_display',
		valueField: 'piutang_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});
	
	piutang_cek_nilaiField= new Ext.form.NumberField({
		id: 'piutang_cek_nilaiField',
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		enableKeyEvents: true,
		maskRe: /([0-9]+)$/
	});
	
	
	piutang_bayar_cekGroup = new Ext.form.FieldSet({
		title: 'Check/Giro',
		collapsible: true,
		layout:'column',
		anchor: '99%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [piutang_cek_namaField,piutang_cek_noField,piutang_cek_validField,piutang_cek_bankField/*,piutang_cek_nilaiField*/] 
			}
		]
	
	});
	// END Bayar Cek
	
	// START Bayar Transfer
	piutang_transfer_bankField= new Ext.form.ComboBox({
		id: 'piutang_transfer_bankField',
		fieldLabel: 'Bank',
		store: piutang_bankDataStore,
		mode: 'remote',
		displayField: 'piutang_bank_display',
		valueField: 'piutang_bank_value',
		allowBlank: true,
		anchor: '50%',
		triggerAction: 'all',
		lazyRenderer: true
	});

	piutang_transfer_namaField= new Ext.form.TextField({
		id: 'piutang_transfer_namaField',
		fieldLabel: 'Atas Nama',
		allowBlank: true,
		anchor: '95%',
		maxLength: 50
	});
	
	piutang_transfer_nilaiField= new Ext.form.NumberField({
		id: 'piutang_transfer_nilaiField',
		enableKeyEvents: true,
		fieldLabel: 'Jumlah (Rp)',
		allowBlank: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	piutang_bayar_transferGroup= new Ext.form.FieldSet({
		title: 'Transfer',
		collapsible: true,
		layout:'column',
		anchor: '99%',
		hidden: true,
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [piutang_transfer_bankField,piutang_transfer_namaField/*,piutang_transfer_nilaiField*/] 
			}
		]
	
	});
	// END Bayar Transfer
	
	/* Identify  piutang_cara Field */
	piutang_caraField= new Ext.form.ComboBox({
		id: 'piutang_caraField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['piutang_cara_value', 'piutang_cara_display'],
			data:[['tunai','Tunai'],['card','Kartu Kredit'],['cek/giro','Cek/Giro'],['transfer','Transfer']]
		}),
		mode: 'local',
		displayField: 'piutang_cara_display',
		valueField: 'piutang_cara_value',
		anchor: '60%',
		//width: 60,
		triggerAction: 'all'	
	});
	piutang_caraField.on('select', function(){
		var value=piutang_caraField.getValue();
		piutang_bayar_tunaiGroup.setVisible(false);
		piutang_bayar_cardGroup.setVisible(false);
		piutang_bayar_cekGroup.setVisible(false);
		piutang_bayar_transferGroup.setVisible(false);
		//RESET Nilai di Cara Bayar-1
		piutang_tunai_nilaiField.reset();
		piutang_card_nilaiField.reset();
		piutang_cek_nilaiField.reset();
		piutang_transfer_nilaiField.reset();
		
		if(value=='card'){
			piutang_bayar_cardGroup.setVisible(true);
		}else if(value=='cek/giro'){
			piutang_bayar_cekGroup.setVisible(true);
		}else if(value=='transfer'){
			piutang_bayar_transferGroup.setVisible(true);
		}else if(value=='tunai'){
			piutang_bayar_tunaiGroup.setVisible(true);
		}
	});
	
	piutang_cara_bayarTabPanel = new Ext.TabPanel({
		plain:true,
		activeTab: 0,
		//autoHeigth: true,
		frame: true,
		height: 242,
		width: 400,
		defaults:{bodyStyle:'padding:10px'},
		items:[{
                title:'Cara Bayar',
                layout:'form',
				frame: true,
                defaults: {width: 230},
                defaultType: 'textfield',

                items: [piutang_caraField,piutang_bayar_tunaiGroup,piutang_bayar_cardGroup,piutang_bayar_cekGroup,piutang_bayar_transferGroup]
            }]
	});
	
	total_bayarGroup = new Ext.form.FieldSet({
		//title: '-',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		frame: true,
		items:[
			   {
				columnWidth:0.65,
				layout: 'form',
				border:false,
				items: [piutang_cara_bayarTabPanel] 
			}
			,{
				columnWidth:0.35,
				labelWidth: 100,
				layout: 'form',
    			labelPad: 8,
				baseCls: 'x-plain',
				border:false,
				anchor: '100%',
				labelAlign: 'left',
				items: [piutang_total_nilaiField, piutang_total_bayarField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var form_bayar_piutang_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'lpiutang_id', type: 'int', mapping: 'lpiutang_id'}, 
			{name: 'lpiutang_faktur', type: 'string', mapping: 'lpiutang_faktur'}, 
			{name: 'lpiutang_sisa', type: 'float', mapping: 'lpiutang_sisa'} 
	]);
	//eof
	
	//function for json writer of detail
	var form_bayar_piutang_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	form_bayar_piutang_DataStore = new Ext.data.GroupingStore({
		id: 'form_bayar_piutang_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_lunas_piutang&m=form_bayar_piutang_list', 
			method: 'POST'
		}),
		reader: form_bayar_piutang_reader,
		//baseParams:{master_id: lpiutang_idField.getValue()},
		sortInfo:{field: 'lpiutang_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_form_bayar_piutang= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	form_bayar_piutang_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'No.Faktur Jual',
			dataIndex: 'lpiutang_faktur',
			width: 150,
			sortable: true
		},
		{
			header: 'Total Piutang (Rp)',
			dataIndex: 'lpiutang_sisa',
			renderer: Ext.util.Format.numberRenderer('0,000')
		},
		{
			header: 'Jumlah Pelunasan (Rp)',
			dataIndex: 'lpiutang_bayar',
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			}),
			renderer: Ext.util.Format.numberRenderer('0,000')
		}]
	);
	form_bayar_piutang_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	form_bayar_piutangListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'form_bayar_piutangListEditorGrid',
		el: 'fp_form_bayar_piutang',
		title: 'Detail Pelunasan',
		height: 250,
		width: 690,
		autoScroll: true,
		store: form_bayar_piutang_DataStore, // DataStore
		colModel: form_bayar_piutang_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_form_bayar_piutang],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: form_bayar_piutang_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			disabled: true,
			handler: form_bayar_piutang_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: form_bayar_piutang_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function form_bayar_piutang_add(){
		var edit_form_bayar_piutang= new form_bayar_piutangListEditorGrid.store.recordType({
			dpiutang_id	:'',		
			dpiutang_master	:'',		
			dpiutang_nohutang	:'',		
			dpiutang_nilai	:''		
		});
		editor_form_bayar_piutang.stopEditing();
		form_bayar_piutang_DataStore.insert(0, edit_form_bayar_piutang);
		form_bayar_piutangListEditorGrid.getView().refresh();
		form_bayar_piutangListEditorGrid.getSelectionModel().selectRow(0);
		editor_form_bayar_piutang.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_form_bayar_piutang(){
		//form_bayar_piutang_DataStore.commitChanges();
		//form_bayar_piutangListEditorGrid.getView().refresh();
		if(form_bayar_piutang_DataStore.getCount()>0){
			var total_bayar=0;
			for(i=0;i<form_bayar_piutang_DataStore.getCount();i++){
				if(form_bayar_piutang_DataStore.getAt(i).data.lpiutang_bayar==undefined || form_bayar_piutang_DataStore.getAt(i).data.lpiutang_bayar==''){
					total_bayar += 0;
				}else{
					total_bayar += form_bayar_piutang_DataStore.getAt(i).data.lpiutang_bayar;
				}
			}
			piutang_total_bayarField.setValue(total_bayar);
		}
	}
	//eof
	
	//function for insert detail
	function form_bayar_piutang_insert(dpiutang_nobukti){
		var count_detail=form_bayar_piutang_DataStore.getCount();
		for(i=0;i<form_bayar_piutang_DataStore.getCount();i++){
			var count_i = i;
			form_bayar_piutang_record=form_bayar_piutang_DataStore.getAt(i);
			
			var dpiutang_cara_insert=null;
			// Bayar Tunai
			var dpiutang_tunai_nilai_insert=null;
			// Bayar Card/Kartu Kredit
			var dpiutang_card_nama_insert=null;
			var dpiutang_card_edc_insert=null;
			var dpiutang_card_no_insert="";
			var dpiutang_card_nilai_insert=null;
			// Bayar Cek
			var dpiutang_cek_nama_insert=null;
			var dpiutang_cek_nomor_insert="";
			var dpiutang_cek_valid_insert="";
			var dpiutang_cek_bank_insert=null;
			var dpiutang_cek_nilai_insert=null;
			// Bayar Transfer
			var dpiutang_transfer_bank_insert=null;
			var dpiutang_transfer_nama_insert=null;
			var dpiutang_transfer_nilai_insert=null;
			
			if(piutang_caraField.getValue()!== null){dpiutang_cara_insert = piutang_caraField.getValue();} 
			
			if(piutang_tunai_nilaiField.getValue()!== null){dpiutang_tunai_nilai_insert = piutang_tunai_nilaiField.getValue();}
			
			if(piutang_card_namaField.getValue()!== null){dpiutang_card_nama_insert = piutang_card_namaField.getValue();} 
			if(piutang_card_edcField.getValue()!== null){dpiutang_card_edc_insert = piutang_card_edcField.getValue();} 
			if(piutang_card_noField.getValue()!==""){dpiutang_card_no_insert = piutang_card_noField.getValue();}
			if(piutang_card_nilaiField.getValue()!== null){dpiutang_card_nilai_insert = piutang_card_nilaiField.getValue();} 
			
			if(piutang_cek_namaField.getValue()!== null){dpiutang_cek_nama_insert = piutang_cek_namaField.getValue();} 
			if(piutang_cek_noField.getValue()!== ""){dpiutang_cek_nomor_insert = piutang_cek_noField.getValue();} 
			if(piutang_cek_validField.getValue()!== ""){dpiutang_cek_valid_insert = piutang_cek_validField.getValue().format('Y-m-d');} 
			if(piutang_cek_bankField.getValue()!== null){dpiutang_cek_bank_insert = piutang_cek_bankField.getValue();} 
			if(piutang_cek_nilaiField.getValue()!== null){dpiutang_cek_nilai_insert = piutang_cek_nilaiField.getValue();} 
			
			if(piutang_transfer_bankField.getValue()!== null){dpiutang_transfer_bank_insert = piutang_transfer_bankField.getValue();} 
			if(piutang_transfer_namaField.getValue()!== null){dpiutang_transfer_nama_insert = piutang_transfer_namaField.getValue();}
			if(piutang_transfer_nilaiField.getValue()!== null){dpiutang_transfer_nilai_insert = piutang_transfer_nilaiField.getValue();} 
			
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_master_lunas_piutang&m=form_bayar_piutang_insert',
				params:{
				dpiutang_master	: form_bayar_piutang_record.data.lpiutang_id, 
				dpiutang_nilai	: form_bayar_piutang_record.data.lpiutang_bayar,
				
				dpiutang_cara	: dpiutang_cara_insert,
				// Bayar Tunai
				dpiutang_tunai_nilai	:	dpiutang_tunai_nilai_insert,
				// Bayar Card/Kartu Kredit
				dpiutang_card_nama	: 	dpiutang_card_nama_insert,
				dpiutang_card_edc	:	dpiutang_card_edc_insert,
				dpiutang_card_no		:	dpiutang_card_no_insert,
				dpiutang_card_nilai	:	dpiutang_card_nilai_insert,
				// Bayar Cek/Giro
				dpiutang_cek_nama	: 	dpiutang_cek_nama_insert,
				dpiutang_cek_no		:	dpiutang_cek_nomor_insert,
				dpiutang_cek_valid	: 	dpiutang_cek_valid_insert,
				dpiutang_cek_bank	:	dpiutang_cek_bank_insert,
				dpiutang_cek_nilai	:	dpiutang_cek_nilai_insert,
				// Bayar Transfer
				dpiutang_transfer_bank	:	dpiutang_transfer_bank_insert,
				dpiutang_transfer_nama	:	dpiutang_transfer_nama_insert,
				dpiutang_transfer_nilai	:	dpiutang_transfer_nilai_insert,
				dpiutang_nobukti	: dpiutang_nobukti,
				count	: count_i,
				dcount	: count_detail
				},
				success: function(response){
					var result=eval(response.responseText);
					if(result==0){
						master_lunas_piutang_DataStore.baseParams = { task: 'LIST' };
						master_lunas_piutang_DataStore.reload({params: {start: 0, limit: pageS}});
					}else if(result==1){
						piutang_cetak(dpiutang_nobukti);
						master_lunas_piutang_DataStore.baseParams = { task: 'LIST' };
						master_lunas_piutang_DataStore.reload({params: {start: 0, limit: pageS}});
					}else if(result==-1){
						Ext.MessageBox.show({
						   title: 'Warning',
						   //msg: 'We could\'t not '+msg+' the Master_jual_produk.',
						   msg: 'Data penjualan produk tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						master_lunas_piutang_DataStore.baseParams = { task: 'LIST' };
						master_lunas_piutang_DataStore.reload({params: {start: 0, limit: pageS}});
					}
				}
				/*callback: function(opts, success, response){
					console.log('dpiutang_nobukti'+ dpiutang_nobukti);
					master_lunas_piutang_DataStore.baseParams = { task: 'LIST' };
					// Cause the datastore to do another query : 
					master_lunas_piutang_DataStore.reload({params: {start: 0, limit: pageS}});
				}*/
			});
		}
	}
	//eof
	
	//function for purge detail
	function form_bayar_piutang_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_lunas_piutang&m=form_bayar_piutang_purge',
			params:{ master_id: eval(lpiutang_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function form_bayar_piutang_confirm_delete(){
		// only one record is selected here
		if(form_bayar_piutangListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', form_bayar_piutang_delete);
		} else if(form_bayar_piutangListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', form_bayar_piutang_delete);
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
	function form_bayar_piutang_delete(btn){
		if(btn=='yes'){
			var s = form_bayar_piutangListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				form_bayar_piutang_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	form_bayar_piutang_DataStore.on('update', refresh_form_bayar_piutang);
	
	/* Function for retrieve create Window Panel*/ 
	multi_lunas_piutang_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [multi_lunas_piutang_masterGroup,form_bayar_piutangListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_lunas_piutang_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					multi_lunas_piutang_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	multi_lunas_piutang_createWindow= new Ext.Window({
		id: 'multi_lunas_piutang_createWindow',
		title: post2db+'Master_lunas_piutang',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_lunas_piutang_create',
		items: multi_lunas_piutang_createForm
	});
	/* End Window */
	
	/* Function for retrieve create Window Panel*/ 
	single_lunas_piutang_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [single_lunas_piutang_masterGroup,form_bayar_piutangListEditorGrid,total_bayarGroup]
		,
		buttons: [{
				text: 'Save and Close',
				handler: master_lunas_piutang_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					single_lunas_piutang_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	single_lunas_piutang_createWindow= new Ext.Window({
		id: 'single_lunas_piutang_createWindow',
		title: post2db+'Master_lunas_piutang',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_lunas_piutang_create',
		items: single_lunas_piutang_createForm
	});
	/* End Window */
	
	/* START History Bayar Piutang*/
	/* Start History DataStore */
	detail_bayar_piutangStore = new Ext.data.Store({
		id: 'detail_bayar_piutangStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_lunas_piutang&m=detail_lunas_piutang_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'//,
			//id: 'app_id'
		},[
        	{name: 'dpiutang_id', type: 'int', mapping: 'dpiutang_id'}, 
			{name: 'dpiutang_nobukti', type: 'string', mapping: 'dpiutang_nobukti'}, 
			{name: 'dpiutang_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'dpiutang_tanggal'},
			{name: 'dpiutang_nilai', type: 'float', mapping: 'dpiutang_nilai'}
		])
	});
	/* End DataStore */
	//detail_bayar_piutangStore.load({params: {master_id: '0'}});
	
	detail_bayar_piutangColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '<div align="center">' + 'No. Faktur Pelunasan' + '</div>',	//'Referensi',
			dataIndex: 'dpiutang_nobukti',
			width: 80,	//150,
			sortable: true
		},
		{
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'dpiutang_tanggal',
			width: 80,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d')
		},
		{
			header: '<div align="center">' + 'Nilai (Rp)' + '</div>',
			align: 'right',
			dataIndex: 'dpiutang_nilai',
			width: 100,	//150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000')			
		}]
    );
    detail_bayar_piutangColumnModel.defaultSortable= true;
	
	var history_bayar_piutangPanel = new Ext.grid.GridPanel({
		id: 'history_bayar_piutangPanel',
		title: 'Detail Pelunasan Piutang',
        store: detail_bayar_piutangStore,
        cm: detail_bayar_piutangColumnModel,
		/*view: new Ext.grid.GroupingView({
            forceFit:true,
            groupTextTpl: '{text} ({[values.rs.length]} {[values.rs.length > 1 ? "Items" : "Item"]})'
        }),*/
		viewConfig: { forceFit:true },
        stripeRows: true,
        autoExpandColumn: 'dpiutang_nobukti',
        autoHeight: true,
		style: 'margin-top: 10px',
        width: 800	//800
    });
    history_bayar_piutangPanel.render('history_bayar_piutang');

	/* END History Pemakaian Kwitansi */
	
	/* Function for action list search */
	function master_lunas_piutang_list_search(){
		// render according to a SQL date format.
		var lpiutang_id_search=null;
		var lpiutang_no_search=null;
		var lpiutang_cust_search=null;
		var lpiutang_tanggal_search_date="";
		var lpiutang_keterangan_search=null;

		if(lpiutang_idSearchField.getValue()!==null){lpiutang_id_search=lpiutang_idSearchField.getValue();}
		if(lpiutang_noSearchField.getValue()!==null){lpiutang_no_search=lpiutang_noSearchField.getValue();}
		if(lpiutang_custSearchField.getValue()!==null){lpiutang_cust_search=lpiutang_custSearchField.getValue();}
		if(lpiutang_tanggalSearchField.getValue()!==""){lpiutang_tanggal_search_date=lpiutang_tanggalSearchField.getValue().format('Y-m-d');}
		if(lpiutang_keteranganSearchField.getValue()!==null){lpiutang_keterangan_search=lpiutang_keteranganSearchField.getValue();}
		// change the store parameters
		master_lunas_piutang_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			lpiutang_id	:	lpiutang_id_search, 
			lpiutang_no	:	lpiutang_no_search, 
			lpiutang_cust	:	lpiutang_cust_search, 
			lpiutang_tanggal	:	lpiutang_tanggal_search_date, 
			lpiutang_keterangan	:	lpiutang_keterangan_search, 
		};
		// Cause the datastore to do another query : 
		master_lunas_piutang_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_lunas_piutang_reset_search(){
		// reset the store parameters
		master_lunas_piutang_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_lunas_piutang_DataStore.reload({params: {start: 0, limit: pageS}});
		master_lunas_piutang_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  lpiutang_id Search Field */
	lpiutang_idSearchField= new Ext.form.NumberField({
		id: 'lpiutang_idSearchField',
		fieldLabel: 'Lpiutang Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  lpiutang_no Search Field */
	lpiutang_noSearchField= new Ext.form.TextField({
		id: 'lpiutang_noSearchField',
		fieldLabel: 'Lpiutang No',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  lpiutang_cust Search Field */
	lpiutang_custSearchField= new Ext.form.NumberField({
		id: 'lpiutang_custSearchField',
		fieldLabel: 'Lpiutang Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  lpiutang_tanggal Search Field */
	lpiutang_tanggalSearchField= new Ext.form.DateField({
		id: 'lpiutang_tanggalSearchField',
		fieldLabel: 'Lpiutang Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  lpiutang_keterangan Search Field */
	lpiutang_keteranganSearchField= new Ext.form.TextField({
		id: 'lpiutang_keteranganSearchField',
		fieldLabel: 'Lpiutang Keterangan',
		maxLength: 150,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_lunas_piutang_searchForm = new Ext.FormPanel({
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
				items: [lpiutang_noSearchField, lpiutang_custSearchField, lpiutang_tanggalSearchField, lpiutang_keteranganSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_lunas_piutang_list_search
			},{
				text: 'Close',
				handler: function(){
					master_lunas_piutang_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_lunas_piutang_searchWindow = new Ext.Window({
		title: 'master_lunas_piutang Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_lunas_piutang_search',
		items: master_lunas_piutang_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_lunas_piutang_searchWindow.isVisible()){
			master_lunas_piutang_searchWindow.show();
		} else {
			master_lunas_piutang_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_lunas_piutang_print(){
		var searchquery = "";
		var lpiutang_no_print=null;
		var lpiutang_cust_print=null;
		var lpiutang_tanggal_print_date="";
		var lpiutang_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(master_lunas_piutang_DataStore.baseParams.query!==null){searchquery = master_lunas_piutang_DataStore.baseParams.query;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_no!==null){lpiutang_no_print = master_lunas_piutang_DataStore.baseParams.lpiutang_no;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_cust!==null){lpiutang_cust_print = master_lunas_piutang_DataStore.baseParams.lpiutang_cust;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_tanggal!==""){lpiutang_tanggal_print_date = master_lunas_piutang_DataStore.baseParams.lpiutang_tanggal;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_keterangan!==null){lpiutang_keterangan_print = master_lunas_piutang_DataStore.baseParams.lpiutang_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_lunas_piutang&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			lpiutang_no : lpiutang_no_print,
			lpiutang_cust : lpiutang_cust_print,
		  	lpiutang_tanggal : lpiutang_tanggal_print_date, 
			lpiutang_keterangan : lpiutang_keterangan_print,
		  	currentlisting: master_lunas_piutang_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_lunas_piutanglist.html','master_lunas_piutanglist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_lunas_piutang_export_excel(){
		var searchquery = "";
		var lpiutang_no_2excel=null;
		var lpiutang_cust_2excel=null;
		var lpiutang_tanggal_2excel_date="";
		var lpiutang_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_lunas_piutang_DataStore.baseParams.query!==null){searchquery = master_lunas_piutang_DataStore.baseParams.query;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_no!==null){lpiutang_no_2excel = master_lunas_piutang_DataStore.baseParams.lpiutang_no;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_cust!==null){lpiutang_cust_2excel = master_lunas_piutang_DataStore.baseParams.lpiutang_cust;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_tanggal!==""){lpiutang_tanggal_2excel_date = master_lunas_piutang_DataStore.baseParams.lpiutang_tanggal;}
		if(master_lunas_piutang_DataStore.baseParams.lpiutang_keterangan!==null){lpiutang_keterangan_2excel = master_lunas_piutang_DataStore.baseParams.lpiutang_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_lunas_piutang&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			lpiutang_no : lpiutang_no_2excel,
			lpiutang_cust : lpiutang_cust_2excel,
		  	lpiutang_tanggal : lpiutang_tanggal_2excel_date, 
			lpiutang_keterangan : lpiutang_keterangan_2excel,
		  	currentlisting: master_lunas_piutang_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_master_lunas_piutang"></div>
         <div id="fp_form_bayar_piutang"></div>
		 <div id="history_bayar_piutang"></div>
		<div id="elwindow_master_lunas_piutang_create"></div>
        <div id="elwindow_master_lunas_piutang_search"></div>
    </div>
</div>
</body>