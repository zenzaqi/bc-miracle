<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_invoice View
	+ Description	: For record view
	+ Filename 		: v_master_invoice.php
 	+ Author  		: 
 	+ Created on 13/Oct/2009 15:51:36
	
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
var master_invoice_DataStore;
var master_invoice_ColumnModel;
var master_invoiceListEditorGrid;
var master_invoice_createForm;
var master_invoice_createWindow;
var master_invoice_searchForm;
var master_invoice_searchWindow;
var master_invoice_SelectedRow;
var master_invoice_ContextMenu;
//for detail data
var detail_invoice_DataStor;
var detail_invoiceListEditorGrid;
var detail_invoice_ColumnModel;
var detail_invoice_proxy;
var detail_invoice_writer;
var detail_invoice_reader;
var editor_detail_invoice;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var today=new Date().format('Y-m-d');

/* declare variable here for Field*/
var invoice_idField;
var invoice_noField;
var invoice_supplierField;
var invoice_noterimaField;
var invoice_tanggalField;
var invoice_biayaField;
var invoice_jatuhtempoField;
var invoice_penagihField;
var invoice_idSearchField;
var invoice_noSearchField;
var invoice_supplierSearchField;
var invoice_noterimaSearchField;
var invoice_tanggalSearchField;
var invoice_nilaiSearchField;
var invoice_jatuhtempoSearchField;
var invoice_penagihSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function master_invoice_update(oGrid_event){
		var invoice_id_update_pk="";
		var invoice_no_update=null;
		var invoice_supplier_update=null;
		var invoice_noterima_update=null;
		var invoice_tanggal_update_date="";
		var invoice_jatuhtempo_update_date="";
		var invoice_penagih_update=null;
		var invoice_diskon_update=null;
		var invoice_cashback_update=null;
		var invoice_uangmuka_update=null;
		var invoice_biaya_update=null;
		
		invoice_id_update_pk = oGrid_event.record.data.invoice_id;
		if(oGrid_event.record.data.invoice_no!== null){invoice_no_update = oGrid_event.record.data.invoice_no;}
		if(oGrid_event.record.data.invoice_supplier!== null){invoice_supplier_update = oGrid_event.record.data.invoice_supplier;}
		if(oGrid_event.record.data.invoice_noterima!== null){invoice_noterima_update = oGrid_event.record.data.invoice_noterima;}
	 	if(oGrid_event.record.data.invoice_tanggal!== ""){invoice_tanggal_update_date =oGrid_event.record.data.invoice_tanggal.format('Y-m-d');}
	 	if(oGrid_event.record.data.invoice_jatuhtempo!== ""){invoice_jatuhtempo_update_date =oGrid_event.record.data.invoice_jatuhtempo.format('Y-m-d');}
		if(oGrid_event.record.data.invoice_penagih!== null){invoice_penagih_update = oGrid_event.record.data.invoice_penagih;}
		if(oGrid_event.record.data.invoice_diskon!== null){invoice_diskon_update = oGrid_event.record.data.invoice_diskon;}
		if(oGrid_event.record.data.invoice_cashback!== null){invoice_cashback_update = oGrid_event.record.data.invoice_cashback;}
		if(oGrid_event.record.data.invoice_uangmuka!== null){invoice_uangmuka_update = oGrid_event.record.data.invoice_uangmuka;}
		if(oGrid_event.record.data.invoice_biaya!== null){invoice_biaya_update = oGrid_event.record.data.invoice_biaya;}
	
		Ext.Ajax.request({  
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_invoice&m=get_action',
			params: {
				task				: "UPDATE",
				invoice_id			: invoice_id_update_pk, 
				invoice_no			: invoice_no_update,  
				invoice_supplier	: invoice_supplier_update,  
				invoice_noterima	: invoice_noterima_update,  
				invoice_tanggal		: invoice_tanggal_update_date, 
				invoice_diskon		: invoice_diskon_update,
				invoice_cashback	: invoice_cashback_update,
				invoice_biaya		: invoice_biaya_update,
				invoice_uangmuka	: invoice_uangmuka_update,
				invoice_jatuhtempo	: invoice_jatuhtempo_update_date, 
				invoice_penagih		: invoice_penagih_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				if(result!==0){
						Ext.MessageBox.alert(post2db+' OK','Data penerimaan tagihan berhasil disimpan');
						master_invoice_DataStore.reload();
						master_invoice_createWindow.hide();
					}else{
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_invoice.',
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
	function master_invoice_create(){
	
		if(is_master_invoice_form_valid()){	
		var invoice_id_create_pk=null; 
		var invoice_no_create=null; 
		var invoice_supplier_create=null; 
		var invoice_noterima_create=null; 
		var invoice_tanggal_create_date=""; 
		var invoice_nilai_create=null; 
		var invoice_jatuhtempo_create_date=""; 
		var invoice_penagih_create=null; 
		var invoice_diskon_cerate=null;
		var invoice_cahsback_create=null;
		var invoice_biaya_create=null;
		var invoice_uangmuka_create=null;
		var invoice_total_create=null;
		
		if(invoice_idField.getValue()!== null){invoice_id_create_pk = invoice_idField.getValue();}else{invoice_id_create_pk=get_pk_id();} 
		if(invoice_noField.getValue()!== null){invoice_no_create = invoice_noField.getValue();} 
		if(invoice_supplierField.getValue()!== null){invoice_supplier_create = invoice_supplier_idField.getValue();} 
		if(invoice_noterimaField.getValue()!== null){invoice_noterima_create = invoice_noterimaField.getValue();} 
		if(invoice_tanggalField.getValue()!== ""){invoice_tanggal_create_date = invoice_tanggalField.getValue().format('Y-m-d');} 
		if(invoice_jatuhtempoField.getValue()!== ""){invoice_jatuhtempo_create_date = invoice_jatuhtempoField.getValue().format('Y-m-d');} 
		if(invoice_penagihField.getValue()!== null){invoice_penagih_create = invoice_penagihField.getValue();} 
		if(invoice_diskonField.getValue()!==null){invoice_diskon_create = invoice_diskonField.getValue();}
		if(invoice_cashbackField.getValue()!==null){invoice_cashback_create = invoice_cashbackField.getValue();}
		if(invoice_biayaField.getValue()!== null){invoice_biaya_create = invoice_biayaField.getValue();} 
		if(invoice_uangmukaField.getValue()!==null){invoice_uangmuka_create = invoice_uangmukaField.getValue();}
		if(invoice_totalField.getValue()!==null){invoice_total_create = invoice_totalField.getValue();}
		
		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_master_invoice&m=get_action',
			params: {
				task				: post2db,
				invoice_id			: invoice_id_create_pk, 
				invoice_no			: invoice_no_create, 
				invoice_supplier	: invoice_supplier_create, 
				invoice_noterima	: invoice_noterima_create, 
				invoice_tanggal		: invoice_tanggal_create_date, 
				invoice_jatuhtempo	: invoice_jatuhtempo_create_date, 
				invoice_penagih		: invoice_penagih_create,
				invoice_diskon		: invoice_diskon_create,
				invoice_cashback	: invoice_cashback_create,
				invoice_biaya		: invoice_biaya_create,
				invoice_uangmuka	: invoice_uangmuka_create,
				invoice_total		: invoice_total_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				if(result!==0){
						detail_invoice_purge(result)
						Ext.MessageBox.alert(post2db+' OK','Data penerimaan tagihan berhasil disimpan');
						master_invoice_DataStore.reload();
						master_invoice_createWindow.hide();
					}else{
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Master_invoice.',
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
			return master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function master_invoice_reset_form(){
		invoice_idField.reset();
		invoice_idField.setValue(null);
		invoice_noField.reset();
		invoice_noField.setValue(null);
		invoice_supplierField.reset();
		invoice_supplierField.setValue(null);
		invoice_noterimaField.reset();
		invoice_noterimaField.setValue(null);
		invoice_tanggalField.reset();
		invoice_tanggalField.setValue(today);
		invoice_biayaField.reset();
		invoice_biayaField.setValue(0);
		invoice_jatuhtempoField.reset();
		invoice_jatuhtempoField.setValue(today);
		invoice_penagihField.reset();
		invoice_penagihField.setValue(null);
		invoice_diskonField.setValue(0);
		invoice_cashbackField.setValue(0);
		invoice_uangmukaField.setValue(0);
		invoice_totalField.setValue(0);
		
		cbo_invoice_produkDataStore.load();
		cbo_invoice_satuanDataStore.load();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function master_invoice_set_form(){
		invoice_idField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_id'));
		invoice_noField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_no'));
		invoice_supplierField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_supplier'));
		invoice_noterimaField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_noterima'));
		invoice_tanggalField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_tanggal'));
		invoice_biayaField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_biaya'));
		invoice_jatuhtempoField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_jatuhtempo'));
		invoice_penagihField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_penagih'));
		invoice_diskonField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_diskon'));
		invoice_cashbackField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_cashback'));
		invoice_uangmukaField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_uangmuka'));
		invoice_totalField.setValue(master_invoiceListEditorGrid.getSelectionModel().getSelected().get('invoice_total'));
			
		cbo_invoice_produkDataStore.setBaseParam('master_id',get_pk_id());
		cbo_invoice_produkDataStore.setBaseParam('task','detail');
		cbo_invoice_satuanDataStore.load();
		cbo_invoice_produkDataStore.load({
			callback: function(opts, response, success){
				if(success==true){
					detail_invoice_DataStore.setBaseParam('master_id',get_pk_id());
					detail_invoice_DataStore.load({
						callback: function(opts, response, success){
							if(success==true){
								get_total_invoice();
							}
						}
					});
				}
			}
		});
		//set detail data di sini !
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_master_invoice_form_valid(){
		return (invoice_noterimaField.isValid());
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!master_invoice_createWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			master_invoice_reset_form();
			master_invoice_createWindow.show();
		} else {
			master_invoice_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function master_invoice_confirm_delete(){
		// only one master_invoice is selected here
		if(master_invoiceListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_invoice_delete);
		} else if(master_invoiceListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Anda yakin untuk menghapus data ini?', master_invoice_delete);
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
	function master_invoice_confirm_update(){
		/* only one record is selected here */
		if(master_invoiceListEditorGrid.selModel.getCount() == 1) {
			post2db='UPDATE';
			master_invoice_set_form();
			msg='updated';
			master_invoice_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Anda belum memilih data yang akan diubah',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function master_invoice_delete(btn){
		if(btn=='yes'){
			var selections = master_invoiceListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< master_invoiceListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.invoice_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_invoice&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							master_invoice_DataStore.reload();
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
	master_invoice_DataStore = new Ext.data.Store({
		id: 'master_invoice_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_invoice&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'invoice_id'
		},[
		/* dataIndex => insert intomaster_invoice_ColumnModel, Mapping => for initiate table column */ 
			{name: 'invoice_id', type: 'int', mapping: 'invoice_id'}, 
			{name: 'invoice_no', type: 'string', mapping: 'no_bukti'}, 
			{name: 'invoice_supplier', type: 'string', mapping: 'supplier_nama'}, 
			{name: 'invoice_noterima', type: 'string', mapping: 'terima_no'}, 
			{name: 'invoice_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'tanggal'}, 
			{name: 'invoice_diskon', type: 'int', mapping: 'invoice_diskon'},
			{name: 'invoice_cashback', type: 'float', mapping: 'invoice_cashback'},
			{name: 'invoice_biaya', type: 'float', mapping: 'invoice_biaya'},
			{name: 'invoice_uangmuka', type: 'float', mapping: 'invoice_uangmuka'},
			{name: 'invoice_jumlah', type: 'float', mapping: 'jumlah_barang'},
			{name: 'invoice_total', type: 'float', mapping: 'total_nilai'},
			{name: 'invoice_jatuhtempo', type: 'date', dateFormat: 'Y-m-d', mapping: 'invoice_jatuhtempo'}, 
			{name: 'invoice_penagih', type: 'string', mapping: 'invoice_penagih'}, 
			{name: 'invoice_creator', type: 'string', mapping: 'invoice_creator'}, 
			{name: 'invoice_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'invoice_date_create'}, 
			{name: 'invoice_update', type: 'string', mapping: 'invoice_update'}, 
			{name: 'invoice_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'invoice_date_update'}, 
			{name: 'invoice_revised', type: 'int', mapping: 'invoice_revised'} 
		]),
		sortInfo:{field: 'invoice_id', direction: "DESC"}
	});
	/* End of Function */
	
	cbo_invoice_tbeliDataStore = new Ext.data.Store({
		id: 'cbo_invoice_tbeliDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_invoice&m=get_tbeli_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: pageS }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'terima_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_invoice_terima_id', type: 'int', mapping: 'terima_id'},
			{name: 'cbo_invoice_terima_no', type: 'string', mapping: 'terima_no'},
			{name: 'cbo_invoice_terima_supplier', type: 'string', mapping: 'supplier_nama'},
			{name: 'cbo_invoice_terima_supplier_id', type: 'string', mapping: 'supplier_id'}
		]),
		sortInfo:{field: 'cbo_invoice_terima_no', direction: "ASC"}
	});
	
	var invoice_tbeli_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cbo_invoice_terima_no}</b><br /></span>',
            'Supplier: {cbo_invoice_terima_supplier}',
        '</div></tpl>'
    );
    
	detail_invoice_tbeliDataStore = new Ext.data.Store({
		id: 'detail_invoice_tbeliDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_invoice&m=get_dtbeli_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit: pageS }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'terima_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_invoice_terima_id', type: 'int', mapping: 'terima_id'},
			{name: 'cbo_invoice_terima_no', type: 'string', mapping: 'terima_no'},
			{name: 'cbo_invoice_terima_supplier', type: 'string', mapping: 'supplier_nama'},
			{name: 'cbo_invoice_terima_supplier_id', type: 'string', mapping: 'supplier_id'}
		]),
		sortInfo:{field: 'cbo_invoice_terima_no', direction: "ASC"}
	});
	
  	/* Function for Identify of Window Column Model */
	master_invoice_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'invoice_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">Tanggal</div>',
			dataIndex: 'invoice_tanggal',
			width: 70,	//100,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			editor: new Ext.form.DateField({
				format: 'd-m-Y'
			})
		},
		{
			header: '<div align="center">No Tagihan</div>',
			dataIndex: 'invoice_no',
			width: 80,	//100,
			sortable: true,
			readOnly: true
		},
		{
			header: '<div align="center">No PB</div>',
			dataIndex: 'invoice_noterima',
			width: 80,	//120,
			sortable: true,
			readOnly: true
		},
		{
			header: '<div align="center">Supplier</div>',
			dataIndex: 'invoice_supplier',
			width: 200,	//250,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">Jml Item</div>',
			align: 'right',
			dataIndex: 'invoice_jumlah',
			width: 60,	//100,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},
		{
			header: '<div align="center">Sub Total (Rp)</div>',
			align: 'right',
			dataIndex: 'invoice_total',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},
		{
			header: '<div align="center">Diskon (%)</div>',
			dataIndex: 'invoice_diskon',
			align: 'right',
			width: 60,	//100,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},
		{
			header: '<div align="center">Diskon (Rp)</div>',
			dataIndex: 'invoice_cashback',
			align: 'right',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: Ext.util.Format.numberRenderer('0,000')
		},
		{
			header: '<div align="center">Biaya (Rp)</div>',
			dataIndex: 'invoice_biaya',
			align: 'right',
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: '<div align="center">Total Nilai (Rp)</div>',
			align: 'right',
			width: 100,
			sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
					invoice_total_nilai=Ext.util.Format.number((record.data.invoice_total-(record.data.invoice_diskon*record.data.invoice_total/100)+record.data.invoice_biaya-record.data.invoice_cashback),"0,000");
                    return '<span>' + invoice_total_nilai+ '</span>';
            }
		},
		{
			header: 'Jatuh Tempo',
			dataIndex: 'invoice_jatuhtempo',
			width: 70,	//100,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Penagih',
			dataIndex: 'invoice_penagih',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	}),
			hidden: true
		}, 
		{
			header: 'Creator',
			dataIndex: 'invoice_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Create on',
			dataIndex: 'invoice_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'invoice_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'invoice_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Revised',
			dataIndex: 'invoice_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}	]);
	
	master_invoice_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	master_invoiceListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'master_invoiceListEditorGrid',
		el: 'fp_master_invoice',
		title: 'Daftar Penerimaan Tagihan',
		autoHeight: true,
		store: master_invoice_DataStore, // DataStore
		cm: master_invoice_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: master_invoice_DataStore,
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
			handler: master_invoice_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: master_invoice_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: master_invoice_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: master_invoice_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_invoice_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_invoice_print  
		}
		]
	});
	master_invoiceListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	master_invoice_ContextMenu = new Ext.menu.Menu({
		id: 'master_invoice_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: master_invoice_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: master_invoice_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: master_invoice_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: master_invoice_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onmaster_invoice_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		master_invoice_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		master_invoice_SelectedRow=rowIndex;
		master_invoice_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function master_invoice_editContextMenu(){
		master_invoiceListEditorGrid.startEditing(master_invoice_SelectedRow,1);
  	}
	/* End of Function */
  	
		
	/* Identify  invoice_id Field */
	invoice_idField= new Ext.form.NumberField({
		id: 'invoice_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  invoice_no Field */
	invoice_noField= new Ext.form.TextField({
		id: 'invoice_noField',
		fieldLabel: 'No Tagihan',
		maxLength: 50,
		anchor: '95%'
	});
	/* Identify  invoice_supplier Field */
	invoice_supplierField= new Ext.form.TextField({
		id: 'invoice_supplierField',
		fieldLabel: 'Supplier',
		maxLength: 50,
		editable: false,
		anchor: '95%'
	});
	invoice_supplier_idField=new Ext.form.NumberField();
	/* Identify  invoice_noterima Field */
	invoice_noterimaField= new Ext.form.ComboBox({
		id: 'invoice_noterimaField',
		fieldLabel: 'No PB',
		store: cbo_invoice_tbeliDataStore,
		mode: 'remote',
		displayField:'cbo_invoice_terima_no',
		valueField: 'cbo_invoice_terima_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: invoice_tbeli_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%',
		allowBlank: false
	});
	/* Identify  invoice_tanggal Field */
	invoice_tanggalField= new Ext.form.DateField({
		id: 'invoice_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	});
	/* Identify  invoice_nilai Field */
	invoice_biayaField= new Ext.form.NumberField({
		id: 'invoice_biayaField',
		fieldLabel: 'Biaya (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	invoice_diskonField= new Ext.form.NumberField({
		id: 'invoice_diskonField',
		fieldLabel: 'Diskon (%)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maxLength: 2,
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	invoice_cashbackField= new Ext.form.NumberField({
		id: 'invoice_cashbackField',
		fieldLabel: 'Diskon (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	invoice_subtotalField= new Ext.form.NumberField({
		id: 'invoice_subtotalField',
		fieldLabel: 'Sub Total (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	invoice_uangmukaField= new Ext.form.NumberField({
		id: 'invoice_uangmukaField',
		fieldLabel: 'Uang Muka (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	invoice_jumlahitemField= new Ext.form.NumberField({
		id: 'invoice_jumlahitemField',
		fieldLabel: 'Jumlah Item',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	invoice_totalField= new Ext.form.NumberField({
		id: 'invoice_totalField',
		fieldLabel: 'Total Tagihan (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		readOnly: true,
		maskRe: /([0-9]+)$/
	});
	
	
	/* Identify  invoice_jatuhtempo Field */
	invoice_jatuhtempoField= new Ext.form.DateField({
		id: 'invoice_jatuhtempoField',
		fieldLabel: 'Jatuh Tempo',
		format : 'd-m-Y'
	});
	/* Identify  invoice_penagih Field */
	invoice_penagihField= new Ext.form.TextField({
		id: 'invoice_penagihField',
		fieldLabel: 'Penagih',
		maxLength: 50,
		anchor: '95%'
	});
	
	invoice_orderDataStore = new Ext.data.Store({
		id: 'invoice_orderDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_invoice&m=get_invoice_order', 
			method: 'POST'
		}),
		baseParams:{terima_id: 0},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'order_id'
		},[
			{name: 'order_id', type: 'int', mapping: 'order_id'},
			{name: 'order_uangmuka', type: 'float', mapping: 'order_uangmuka'},
			{name: 'order_biaya', type: 'float', mapping: 'order_biaya'},
			{name: 'order_diskon', type: 'int', mapping: 'order_diskon'},
			{name: 'order_cashback', type: 'float', mapping: 'order_cashback'}
		]),
		sortInfo:{field: 'order_id', direction: "ASC"}
	});
	
	invoice_dtbeliDataStore = new Ext.data.Store({
		id: 'invoice_dtbeliDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_invoice&m=get_dtbeli_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'dterima_id'
		},[
			{name: 'dinvoice_id', type: 'int', mapping: 'dterima_id'},
			{name: 'dinvoice_produk', type: 'int', mapping: 'dterima_produk'},
			{name: 'dinvoice_satuan', type: 'int', mapping: 'dterima_satuan'},
			{name: 'dinvoice_jumlah', type: 'int', mapping: 'dterima_jumlah'},
			{name: 'dinvoice_harga', type: 'int', mapping: 'dorder_harga'},
			{name: 'dinvoice_diskon', type: 'int', mapping: 'dorder_diskon'}
		]),
		sortInfo:{field: 'dinvoice_id', direction: "ASC"}
	});
	//invoice_dtbeliDataStore.load({params: {master:3}});
	
	
  	/*Fieldset Master*/
	master_invoice_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [invoice_idField, invoice_noField, invoice_noterimaField, invoice_supplierField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [invoice_tanggalField, invoice_jatuhtempoField, invoice_penagihField, invoice_idField] 
			}
			]
	
	});
	
		
	master_invoice_footerGroup = new Ext.form.FieldSet({
		title: '',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.45,
				layout: 'form',
				border:false,
				items: [invoice_jumlahitemField,invoice_subtotalField] 
			},
			{
				columnWidth:0.55,
				layout: 'form',
				labelWidth: 150,
				border:false,
				items: [invoice_biayaField, invoice_diskonField, invoice_cashbackField, invoice_uangmukaField, invoice_totalField] 
			}
			]
	
	});
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var detail_invoice_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dinvoice_id', type: 'int', mapping: 'dinvoice_id'}, 
			{name: 'dinvoice_master', type: 'int', mapping: 'dinvoice_master'}, 
			{name: 'dinvoice_produk', type: 'int', mapping: 'dinvoice_produk'}, 
			{name: 'dinvoice_satuan', type: 'int', mapping: 'dinvoice_satuan'}, 
			{name: 'dinvoice_jumlah', type: 'int', mapping: 'dinvoice_jumlah'}, 
			{name: 'dinvoice_harga', type: 'float', mapping: 'dinvoice_harga'}, 
			{name: 'dinvoice_diskon', type: 'float', mapping: 'dinvoice_diskon'} 
	]);
	//eof
	
	//function for json writer of detail
	var detail_invoice_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	detail_invoice_DataStore = new Ext.data.Store({
		id: 'detail_invoice_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_invoice&m=detail_detail_invoice_list', 
			method: 'POST'
		}),
		baseParams:{start:0,limit:pageS},
		reader: detail_invoice_reader,
		sortInfo:{field: 'dinvoice_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_detail_invoice= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	/*=== cbo_dproduk_byorderDataStore ==> mengambil "Detail Produk" dari detailList Modul Order Pembelian ===*/
	cbo_invoice_produkDataStore = new Ext.data.Store({
		id: 'cbo_invoice_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_invoice&m=get_produk_list', 
			method: 'POST'
		}),
		baseParams: {task: 'detail',start: 0, limit: pageS},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'produk_id', type: 'int', mapping: 'produk_id'},
			{name: 'produk_nama', type: 'string', mapping: 'produk_nama'},
			{name: 'produk_kategori', type: 'string', mapping: 'kategori_nama'}
		]),
		sortInfo:{field: 'produk_nama', direction: "ASC"}
	});
	/*======= END cbo_dproduk_byorderDataStore =======*/
	
	/*=== cbo_dproduk_byorderDataStore ==> mengambil "Detail Produk" dari detailList Modul Order Pembelian ===*/
	cbo_invoice_satuanDataStore = new Ext.data.Store({
		id: 'cbo_invoice_satuanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_invoice&m=get_satuan_list', 
			method: 'POST'
		}),
		//baseParams: {master_order_id: terima_order_idField.getValue()},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'satuan_id', type: 'int', mapping: 'satuan_id'},
			{name: 'satuan_nama', type: 'string', mapping: 'satuan_nama'},
			{name: 'satuan_kode', type: 'string', mapping: 'satuan_kode'}
		]),
		sortInfo:{field: 'satuan_nama', direction: "DESC"}
	});
	/*======= END cbo_dproduk_byorderDataStore =======*/
	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
	
	var combo_invoice_produk=new Ext.form.ComboBox({
		store: cbo_invoice_produkDataStore,
		mode: 'remote',
		typeAhead: true,
		displayField: 'produk_nama',
		valueField: 'produk_id',
		triggerAction: 'all',
		lazyRender: false
	});
	
	var combo_invoice_satuan=new Ext.form.ComboBox({
		store: cbo_invoice_satuanDataStore,
		mode: 'local',
		typeAhead: true,
		displayField: 'satuan_nama',
		valueField: 'satuan_id',
		triggerAction: 'all',
		lazyRender: false
	});
	
	//declaration of detail coloumn model
	detail_invoice_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">Produk</div>',
			dataIndex: 'dinvoice_produk',
			width: 200,	//250,
			sortable: true,
			renderer: Ext.util.Format.comboRenderer(combo_invoice_produk)
		},
		{
			header: '<div align="center">Satuan</div>',
			dataIndex: 'dinvoice_satuan',
			width: 100,
			sortable: true,
			renderer: Ext.util.Format.comboRenderer(combo_invoice_satuan)
		},
		{
			header: '<div align="center">Jumlah</div>',
			align: 'right',
			dataIndex: 'dinvoice_jumlah',
			width: 60,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			sortable: true,
			editable: false
		},
		{
			header: '<div align="center">Harga (Rp)</div>',
			align: 'right',
			dataIndex: 'dinvoice_harga',
			width: 100,	//150,
			sortable: true,
			renderer: Ext.util.Format.numberRenderer('0,000'),
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 22,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: '<div align="center">Diskon (%)</div>',
			dataIndex: 'dinvoice_diskon',
			width: 60,
			align: 'right',
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: true,
				allowNegative: false,
				blankText: '0',
				maxLength: 2,
				maskRe: /([0-9]+)$/
			})
		},
		{
			header: '<div align="center">Sub Total (Rp)</div>',
			width: 100,	//150,
			align: 'right',
			sortable: true,
			readOnly: true,
			renderer: function(v, params, record){
					subtotal=Ext.util.Format.number((record.data.dinvoice_harga * record.data.dinvoice_jumlah*(100-record.data.dinvoice_diskon)/100),"0,000");
                    return subtotal;
            }
		}]
	);
	detail_invoice_ColumnModel.defaultSortable= true;
	//eof

	
	//declaration of detail list editor grid
	detail_invoiceListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_invoiceListEditorGrid',
		el: 'fp_detail_invoice',
		title: 'Detail Item Barang',
		height: 250,
		width: 940,	//692,
		autoScroll: true,
		store: detail_invoice_DataStore, // DataStore
		colModel: detail_invoice_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_invoice],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: detail_invoice_DataStore,
			displayInfo: true
		})
	});
	//eof
	
	
	//function of detail add
	function detail_invoice_add(){
		var edit_detail_invoice= new detail_invoiceListEditorGrid.store.recordType({
			dinvoice_id	:'',		
			dinvoice_master	:'',		
			dinvoice_produk	:'',		
			dinvoice_satuan	:'',		
			dinvoice_jumlah	:'',		
			dinvoice_harga	:'',		
			dinvoice_diskon	:''		
		});
		editor_detail_invoice.stopEditing();
		detail_invoice_DataStore.insert(0, edit_detail_invoice);
		detail_invoiceListEditorGrid.getView().refresh();
		detail_invoiceListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_invoice.startEditing(0);
	}
	
	function detail_invoice_add_bytbeli($dinvoice_produk, $dinvoice_satuan, $dinvoice_jumlah, $dinvoice_harga, $dinvoice_diskon){
		var edit_detail_invoice= new detail_invoiceListEditorGrid.store.recordType({
			dinvoice_id	:'',		
			dinvoice_master	:'',		
			dinvoice_produk	:$dinvoice_produk,		
			dinvoice_satuan	:$dinvoice_satuan,		
			dinvoice_jumlah	:$dinvoice_jumlah,		
			dinvoice_harga	:$dinvoice_harga,		
			dinvoice_diskon	:$dinvoice_diskon		
		});
		detail_invoice_DataStore.insert(0, edit_detail_invoice);
		detail_invoiceListEditorGrid.getView().refresh();
		detail_invoiceListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_invoice.startEditing(0);
		editor_detail_invoice.stopEditing();
	}
	
	//function for refresh detail
	function refresh_detail_invoice(){
		detail_invoice_DataStore.commitChanges();
		detail_invoiceListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function detail_invoice_insert(master_id){
		for(i=0;i<detail_invoice_DataStore.getCount();i++){
			detail_invoice_record=detail_invoice_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Mohon tunggu...',
				url: 'index.php?c=c_master_invoice&m=detail_invoice_insert',
				params:{
				dinvoice_id	: detail_invoice_record.data.dinvoice_id, 
				dinvoice_master	: master_id, 
				dinvoice_produk	: detail_invoice_record.data.dinvoice_produk, 
				dinvoice_satuan	: detail_invoice_record.data.dinvoice_satuan, 
				dinvoice_jumlah	: detail_invoice_record.data.dinvoice_jumlah, 
				dinvoice_harga	: detail_invoice_record.data.dinvoice_harga, 
				dinvoice_diskon	: detail_invoice_record.data.dinvoice_diskon 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function detail_invoice_purge(pkid){
		Ext.Ajax.request({
			waitMsg: 'Mohon tunggu...',
			url: 'index.php?c=c_master_invoice&m=detail_invoice_purge',
			params:{ master_id: pkid},
			success: function(response){
				detail_invoice_insert(pkid);
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function detail_invoice_confirm_delete(){
		// only one record is selected here
		if(detail_invoiceListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', detail_invoice_delete);
		} else if(detail_invoiceListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', detail_invoice_delete);
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
	function detail_invoice_delete(btn){
		if(btn=='yes'){
			var s = detail_invoiceListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				detail_invoice_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	detail_invoice_DataStore.on('update', refresh_detail_invoice);
	
	/* Function for retrieve create Window Panel*/ 
	master_invoice_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 940,	//700,        
		items: [master_invoice_masterGroup,detail_invoiceListEditorGrid, master_invoice_footerGroup],
		buttons: [{
				text: 'Save and Close',
				handler: master_invoice_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					master_invoice_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	master_invoice_createWindow= new Ext.Window({
		id: 'master_invoice_createWindow',
		title: post2db+' Penerimaan Tagihan',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_master_invoice_create',
		items: master_invoice_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function master_invoice_list_search(){
		// render according to a SQL date format.
		var invoice_id_search=null;
		var invoice_no_search=null;
		var invoice_supplier_search=null;
		var invoice_noterima_search=null;
		var invoice_tanggal_search_date="";
		var invoice_nilai_search=null;
		var invoice_jatuhtempo_search_date="";
		var invoice_penagih_search=null;

		if(invoice_idSearchField.getValue()!==null){invoice_id_search=invoice_idSearchField.getValue();}
		if(invoice_noSearchField.getValue()!==null){invoice_no_search=invoice_noSearchField.getValue();}
		if(invoice_supplierSearchField.getValue()!==null){invoice_supplier_search=invoice_supplierSearchField.getValue();}
		if(invoice_noterimaSearchField.getValue()!==null){invoice_noterima_search=invoice_noterimaSearchField.getValue();}
		if(invoice_tanggalSearchField.getValue()!==""){invoice_tanggal_search_date=invoice_tanggalSearchField.getValue().format('Y-m-d');}
		if(invoice_nilaiSearchField.getValue()!==null){invoice_nilai_search=invoice_nilaiSearchField.getValue();}
		if(invoice_jatuhtempoSearchField.getValue()!==""){invoice_jatuhtempo_search_date=invoice_jatuhtempoSearchField.getValue().format('Y-m-d');}
		if(invoice_penagihSearchField.getValue()!==null){invoice_penagih_search=invoice_penagihSearchField.getValue();}
		// change the store parameters
		master_invoice_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			invoice_id	:	invoice_id_search, 
			invoice_no	:	invoice_no_search, 
			invoice_supplier	:	invoice_supplier_search, 
			invoice_noterima	:	invoice_noterima_search, 
			invoice_tanggal	:	invoice_tanggal_search_date, 
			invoice_nilai	:	invoice_nilai_search, 
			invoice_jatuhtempo	:	invoice_jatuhtempo_search_date, 
			invoice_penagih	:	invoice_penagih_search, 
		};
		// Cause the datastore to do another query : 
		master_invoice_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function master_invoice_reset_search(){
		// reset the store parameters
		master_invoice_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		master_invoice_DataStore.reload({params: {start: 0, limit: pageS}});
		master_invoice_searchWindow.close();
	};
	/* End of Fuction */

	function master_invoice_reset_SearchForm(){
		invoice_noSearchField.reset();
		invoice_supplierSearchField.reset();
		invoice_noterimaSearchField.reset();
		invoice_tanggalSearchField.reset();
		invoice_nilaiSearchField.reset();
		invoice_jatuhtempoSearchField.reset();
		invoice_penagihSearchField.reset();
	}
	
	/* Field for search */
	/* Identify  invoice_id Search Field */
	invoice_idSearchField= new Ext.form.NumberField({
		id: 'invoice_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  invoice_no Search Field */
	invoice_noSearchField= new Ext.form.TextField({
		id: 'invoice_noSearchField',
		fieldLabel: 'No Tagihan',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  invoice_supplier Search Field */
	invoice_supplierSearchField= new Ext.form.NumberField({
		id: 'invoice_supplierSearchField',
		fieldLabel: 'Supplier',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  invoice_noterima Search Field */
	invoice_noterimaSearchField= new Ext.form.ComboBox({
		id: 'invoice_noterimaSearchField',
		fieldLabel: 'No PB',
		store: cbo_invoice_tbeliDataStore,
		mode: 'remote',
		displayField:'cbo_invoice_terima_no',
		valueField: 'cbo_invoice_terima_id',
        typeAhead: false,
        loadingText: 'Mencari...',
        pageSize:10,
        hideTrigger:false,
        tpl: invoice_tbeli_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	
	});
	/* Identify  invoice_tanggal Search Field */
	invoice_tanggalSearchField= new Ext.form.DateField({
		id: 'invoice_tanggalSearchField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	
	});
	/* Identify  invoice_nilai Search Field */
	invoice_nilaiSearchField= new Ext.form.NumberField({
		id: 'invoice_nilaiSearchField',
		fieldLabel: 'Biaya (Rp)',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  invoice_jatuhtempo Search Field */
	invoice_jatuhtempoSearchField= new Ext.form.DateField({
		id: 'invoice_jatuhtempoSearchField',
		fieldLabel: 'Jatuh Tempo',
		format : 'd-m-Y'
	
	});
	/* Identify  invoice_penagih Search Field */
	invoice_penagihSearchField= new Ext.form.TextField({
		id: 'invoice_penagihSearchField',
		fieldLabel: 'Penagih',
		maxLength: 50,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	master_invoice_searchForm = new Ext.FormPanel({
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
				items: [invoice_noSearchField, invoice_noterimaSearchField, invoice_tanggalSearchField, invoice_nilaiSearchField, invoice_jatuhtempoSearchField, invoice_penagihSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: master_invoice_list_search
			},{
				text: 'Close',
				handler: function(){
					master_invoice_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	master_invoice_searchWindow = new Ext.Window({
		title: 'Pencarian Penerimaan Tagihan',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_master_invoice_search',
		items: master_invoice_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!master_invoice_searchWindow.isVisible()){
			master_invoice_reset_SearchForm();
			master_invoice_searchWindow.show();
		} else {
			master_invoice_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function master_invoice_print(){
		var searchquery = "";
		var invoice_no_print=null;
		var invoice_supplier_print=null;
		var invoice_noterima_print=null;
		var invoice_tanggal_print_date="";
		var invoice_nilai_print=null;
		var invoice_jatuhtempo_print_date="";
		var invoice_penagih_print=null;
		var win;              
		// check if we do have some search data...
		if(master_invoice_DataStore.baseParams.query!==null){searchquery = master_invoice_DataStore.baseParams.query;}
		if(master_invoice_DataStore.baseParams.invoice_no!==null){invoice_no_print = master_invoice_DataStore.baseParams.invoice_no;}
		if(master_invoice_DataStore.baseParams.invoice_supplier!==null){invoice_supplier_print = master_invoice_DataStore.baseParams.invoice_supplier;}
		if(master_invoice_DataStore.baseParams.invoice_noterima!==null){invoice_noterima_print = master_invoice_DataStore.baseParams.invoice_noterima;}
		if(master_invoice_DataStore.baseParams.invoice_tanggal!==""){invoice_tanggal_print_date = master_invoice_DataStore.baseParams.invoice_tanggal;}
		if(master_invoice_DataStore.baseParams.invoice_nilai!==null){invoice_nilai_print = master_invoice_DataStore.baseParams.invoice_nilai;}
		if(master_invoice_DataStore.baseParams.invoice_jatuhtempo!==""){invoice_jatuhtempo_print_date = master_invoice_DataStore.baseParams.invoice_jatuhtempo;}
		if(master_invoice_DataStore.baseParams.invoice_penagih!==null){invoice_penagih_print = master_invoice_DataStore.baseParams.invoice_penagih;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_invoice&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			invoice_no : invoice_no_print,
			invoice_supplier : invoice_supplier_print,
			invoice_noterima : invoice_noterima_print,
		  	invoice_tanggal : invoice_tanggal_print_date, 
			invoice_nilai : invoice_nilai_print,
		  	invoice_jatuhtempo : invoice_jatuhtempo_print_date, 
			invoice_penagih : invoice_penagih_print,
		  	currentlisting: master_invoice_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./master_invoicelist.html','master_invoicelist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function master_invoice_export_excel(){
		var searchquery = "";
		var invoice_no_2excel=null;
		var invoice_supplier_2excel=null;
		var invoice_noterima_2excel=null;
		var invoice_tanggal_2excel_date="";
		var invoice_nilai_2excel=null;
		var invoice_jatuhtempo_2excel_date="";
		var invoice_penagih_2excel=null;
		var win;              
		// check if we do have some search data...
		if(master_invoice_DataStore.baseParams.query!==null){searchquery = master_invoice_DataStore.baseParams.query;}
		if(master_invoice_DataStore.baseParams.invoice_no!==null){invoice_no_2excel = master_invoice_DataStore.baseParams.invoice_no;}
		if(master_invoice_DataStore.baseParams.invoice_supplier!==null){invoice_supplier_2excel = master_invoice_DataStore.baseParams.invoice_supplier;}
		if(master_invoice_DataStore.baseParams.invoice_noterima!==null){invoice_noterima_2excel = master_invoice_DataStore.baseParams.invoice_noterima;}
		if(master_invoice_DataStore.baseParams.invoice_tanggal!==""){invoice_tanggal_2excel_date = master_invoice_DataStore.baseParams.invoice_tanggal;}
		if(master_invoice_DataStore.baseParams.invoice_nilai!==null){invoice_nilai_2excel = master_invoice_DataStore.baseParams.invoice_nilai;}
		if(master_invoice_DataStore.baseParams.invoice_jatuhtempo!==""){invoice_jatuhtempo_2excel_date = master_invoice_DataStore.baseParams.invoice_jatuhtempo;}
		if(master_invoice_DataStore.baseParams.invoice_penagih!==null){invoice_penagih_2excel = master_invoice_DataStore.baseParams.invoice_penagih;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_invoice&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			invoice_no : invoice_no_2excel,
			invoice_supplier : invoice_supplier_2excel,
			invoice_noterima : invoice_noterima_2excel,
		  	invoice_tanggal : invoice_tanggal_2excel_date, 
			invoice_nilai : invoice_nilai_2excel,
		  	invoice_jatuhtempo : invoice_jatuhtempo_2excel_date, 
			invoice_penagih : invoice_penagih_2excel,
		  	currentlisting: master_invoice_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	function get_total_invoice(){
		var total_barang=0;
		var total_nilai=0;
		
		for(i=0;i<detail_invoice_DataStore.getCount();i++){
			record_dinvoice=detail_invoice_DataStore.getAt(i);
			total_barang=total_barang+record_dinvoice.data.dinvoice_jumlah;
			total_nilai=total_nilai+record_dinvoice.data.dinvoice_jumlah*record_dinvoice.data.dinvoice_harga*(100-record_dinvoice.data.dinvoice_diskon)/100;
		}
		invoice_jumlahitemField.setValue(total_barang);
		invoice_subtotalField.setValue(total_nilai);
		get_total_tagihan();
	}
	
	function get_total_tagihan(){
		var total_tagihan=0;
		var total_diskon=0;
		
		total_tagihan=invoice_subtotalField.getValue()-invoice_cashbackField.getValue();
		total_diskon=invoice_subtotalField.getValue()*invoice_diskonField.getValue()/100;
		total_tagihan=total_tagihan+invoice_biayaField.getValue()-invoice_uangmukaField.getValue()-total_diskon;
		invoice_totalField.setValue(total_tagihan);
	}
	
	//EVENTS
	master_invoiceListEditorGrid.addListener('rowcontextmenu', onmaster_invoice_ListEditGridContextMenu);
	master_invoice_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	master_invoiceListEditorGrid.on('afteredit', master_invoice_update); // inLine Editing Record
	
	detail_invoice_DataStore.on("update",function(){
		get_total_invoice();
	});
	
	invoice_noterimaField.on('select', function(){
		cbo_invoice_produkDataStore.setBaseParam('terima_id',invoice_noterimaField.getValue());
		cbo_invoice_produkDataStore.setBaseParam('task','terima');
		cbo_invoice_produkDataStore.load();
		invoice_orderDataStore.setBaseParam('terima_id',invoice_noterimaField.getValue());
		invoice_orderDataStore.load({
			callback:function(opts, response, success){
				if(success==true){
					var data_invoice_order=invoice_orderDataStore.getAt(0);
					invoice_diskonField.setValue(data_invoice_order.data.order_diskon);
					invoice_cashbackField.setValue(data_invoice_order.data.order_cashback);
					invoice_uangmukaField.setValue(data_invoice_order.data.order_uangmuka);
					invoice_biayaField.setValue(data_invoice_order.data.order_biaya);
				}
			}
		});
		get_total_tagihan();
		
		var j=cbo_invoice_tbeliDataStore.find('cbo_invoice_terima_id',invoice_noterimaField.getValue());
		
		if(cbo_invoice_tbeliDataStore.getCount()){
			invoice_supplierField.setValue(cbo_invoice_tbeliDataStore.getAt(j).data.cbo_invoice_terima_supplier);
			invoice_supplier_idField.setValue(cbo_invoice_tbeliDataStore.getAt(j).data.cbo_invoice_terima_supplier_id);
				
			invoice_dtbeliDataStore.load({
				params: {master:invoice_noterimaField.getValue()},
				callback: function(opts, response, success){
					if(success==true){
						detail_invoice_DataStore.removeAll();
						for(i=0;i<invoice_dtbeliDataStore.getTotalCount();i++){
							var dtbeli_record=invoice_dtbeliDataStore.getAt(i);
							detail_invoice_DataStore.insert(i,dtbeli_record);	
						}
						get_total_invoice();
					}
				}
			});
			detail_invoice_DataStore.commitChanges();
		}
	});
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_master_invoice"></div>
         <div id="fp_detail_invoice"></div>
		<div id="elwindow_master_invoice_create"></div>
        <div id="elwindow_master_invoice_search"></div>
    </div>
</div>
</body>