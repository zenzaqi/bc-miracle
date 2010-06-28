<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Resep Dokter View
	+ Description	: For record view
	+ Filename 		: v_resep_dokter.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 14:21:34
	
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
Ext.namespace('Ext.ux.plugin');

Ext.ux.plugin.triggerfieldTooltip = function(config){
    Ext.apply(this, config);
};

Ext.extend(Ext.ux.plugin.triggerfieldTooltip, Ext.util.Observable,{
    init: function(component){
        this.component = component;
        this.component.on('render', this.onRender, this);
    },
    
    //private
    onRender: function(){
        if(this.component.tooltip){
            if(typeof this.component.tooltip == 'object'){
                Ext.QuickTips.register(Ext.apply({
                      target: this.component.trigger
                }, this.component.tooltip));
            } else {
                this.component.trigger.dom[this.component.tooltipType] = this.component.tooltip;
            }
        }
    }
}); 

Ext.apply(Ext.form.VTypes, {
    daterange : function(val, field) {
        var date = field.parseDate(val);

        if(!date){
            return;
        }
        if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
            var start = Ext.getCmp(field.startDateField);
            start.setMaxValue(date);
            start.validate();
            this.dateRangeMax = date;
        } 
        else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
            var end = Ext.getCmp(field.endDateField);
            end.setMinValue(date);
            end.validate();
            this.dateRangeMin = date;
        }
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
    }
});
/* declare function */		
var resep_dokterDataStore;
var resep_dokterColumnModel;
var resep_dokterListEditorGrid;
var resep_dokter_createForm;
var resep_dokter_createWindow;
var resep_dokter_searchForm;
var resep_dokter_searchWindow;
var resep_dokterSelectedRow;
var resep_dokterContextMenu;
//for detail data
var resep_dokter_detail_lepasanDataStore;
var resep_dokter_detail_kombinasiDataStore;
var resep_dokter_detail_tambahanDataStore;
var history_detail_resep_kombinasiListGrid;
var history_detail_resep_kombinasiColumnModel;
//var resepdokter_detail_proxy;
var resepdokter_detail_lepasan_writer;
var resepdokter_detail_tambahan_writer;
//var resepdokter_detail_reader;
var editor_resepdokter_detail;
var editor_detail_resepkombinasi;
var editor_detail_reseplepasan;
var editor_detail_reseptambahan;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var cetak_resepdokter=0;
var dt = new Date();

/* declare variable here for Field*/
var resep_idField;
var resep_noField;
var resep_dokterField;
var resep_custField;
var resepdokter_idSearchField;
var resepdokter_custSearchField;


function resepdokter_cetak(master_id){
//console.log('master_id',+master_id);
	Ext.Ajax.request({   
		waitMsg: 'Mohon tunggu...',
		url: 'index.php?c=c_resep_dokter&m=print_paper',
		params: {resep_id : master_id}, 
		success: function(response){              
			var result=eval(response.responseText);
			switch(result){
			case 1:
				win = window.open('./resepdokter_paper.html','Cetak Resep Dokter','height=480,width=1240,resizable=1,scrollbars=0, menubar=0');
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

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function resepdokter_update(oGrid_event){
		var trawat_id_update_pk="";
		var resep_id_update_pk="";
		var resepdokter_cust_update=null;
		var resep_dokterid_update=null;
		var resep_customer_update=null;
		var resep_tanggal_update="";
		var dtrawat_status_update=null;
		var card_cust_id_update=null;

		resep_id_update_pk = oGrid_event.record.data.resep_id;
		if(oGrid_event.record.data.resep_custid!== null){resepdokter_cust_update = oGrid_event.record.data.resep_custid;}
		if(oGrid_event.record.data.resep_dokterid!== null){resep_dokterid_update = oGrid_event.record.data.resep_dokterid;}
		if(oGrid_event.record.data.resep_customer!== null){resep_customer_update = oGrid_event.record.data.resep_customer;}
		if(oGrid_event.record.data.resep_tanggal!== ""){resep_tanggal_update =oGrid_event.record.data.resep_tanggal.format('Y-m-d');}
		dtrawat_status_update = oGrid_event.record.data.dtrawat_status;
		card_cust_id_update = oGrid_event.record.data.card_cust_id;

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_resep_dokter&m=get_action',
			params: {
				task: "UPDATE",
				mode_edit: "update_list",
				resep_id		: resep_id_update_pk,
				resep_custid	:resepdokter_cust_update,  
				resep_dokterid :resep_dokterid_update,
				resep_customer:resep_customer_update,
				resep_tanggal: resep_tanggal_update,
				dtrawat_status	:dtrawat_status_update,
				card_cust_id	:card_cust_id_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					default:
						resep_dokterDataStore.commitChanges();
						resep_dokterDataStore.reload();
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
	function resepdokter_create(){
	
		if(is_resepdokterform_valid()){	
		var trawat_id_create=null; 
		var card_id_create=null;
		var resep_cust_create=null;
		var resep_tanggal_create="";
		var resep_dokter_create=null;
		var resep_no_create=null;

		if(resep_idField.getValue()!== null){trawat_id_create = resep_idField.getValue();}else{trawat_id_create=get_pk_id();} 
		if(resep_dokterField.getValue()!== null){resep_dokter_create = resep_dokterField.getValue();}
		if(resep_custField.getValue()!== null){resep_cust_create = resep_custField.getValue();}
		if(resep_tanggalField.getValue()!== ""){resep_tanggal_create = resep_tanggalField.getValue().format('Y-m-d');}
		if(resep_noField.getValue()!== null){resep_no_create = resep_noField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_resep_dokter&m=get_action',
			params: {
				task: post2db,
				resep_id	: trawat_id_create, 
				resep_custid	: resep_cust_create,
				resep_tanggal	: resep_tanggal_create,
				resep_dokterid : resep_dokter_create,
				resep_no	: resep_no_create
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						detail_resepdokter_lepasan_purge();
						detail_resepdokter_kombinasi_purge();
						detail_resepdokter_tambahan_purge();
						resep_dokter_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Resep Dokter.',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
						break;
				}     
				resep_dokter_reset_form();
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
  
  	function save_andPrint(){
		cetak_resepdokter=1;
		resepdokter_create();
	}
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='UPDATE')
			return resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function resep_dokter_reset_form(){
		resep_idField.reset();
		resep_idField.setValue(null);
		resep_dokterField.reset();
		resep_dokterField.setValue(null);
		resep_noField.reset();
		resep_noField.setValue('No Resep Auto');
		resep_tanggalField.setValue(dt.format('Y-m-d'));
		resep_nocustField.reset();
		resep_nocustField.setValue(null);
		resep_custField.reset();
		resep_custField.setValue(null);
		resep_sipField.reset();
		resep_sipField.setValue(null);
		//cbo_resep_satuan_DataStore.setBaseParam('task','detail');
		//cbo_resep_satuan_DataStore.setBaseParam('master_id',get_pk_id());
		//cbo_resep_satuan_DataStore.load();
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function resepdokter_set_form(){
		resep_idField.setValue(resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_id'));
		resep_dokterField.setValue(resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_namadokter'));
		resep_custField.setValue(resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_namacust'));
		resep_tanggalField.setValue(resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_tanggal'));
		resep_nocustField.setValue(resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_cust_no'));
		resep_sipField.setValue(resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_sip'));
		resep_noField.setValue(resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_no'));
		cbo_resep_satuan_DataStore.setBaseParam('task','detail');
		cbo_resep_satuan_DataStore.setBaseParam('master_id',get_pk_id());
		cbo_resep_satuan_DataStore.load();
	}
	/* End setValue to EDIT*/

   function load_karyawan_sip(){
		if(resep_dokterField.getValue()!=''){
			auto_karyawansip_DataStore.load({
					params : { karyawan_id: resep_dokterField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) {
							if(auto_karyawansip_DataStore.getCount()){
								resep_auto_sip=auto_karyawansip_DataStore.getAt(0).data;
								resep_sipField.setValue(resep_auto_sip.karyawan_sip);
							}
						}
					}
			}); 
		}
	}
	
	 function load_cust_no(){
		if(resep_custField.getValue()!=''){
			auto_custno_DataStore.load({
					params : { cust_id: resep_custField.getValue() },
					callback: function(opts, success, response)  {
						 if (success) {
							if(auto_custno_DataStore.getCount()){
								resep_auto_custno=auto_custno_DataStore.getAt(0).data;
								resep_nocustField.setValue(resep_auto_custno.cust_no);
							}
						}
					}
			}); 
		}
	}
	
	/* Function for Check if the form is valid */
	function is_resepdokterform_valid(){
		return (true &&  resep_dokterField.isValid() && resep_custField.isValid() &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		resep_dokter_detail_lepasanDataStore.load({params: {master_id:0}});
		resep_dokter_detail_kombinasiDataStore.load({params: {master_id:0}});
		resep_dokter_detail_tambahanDataStore.load({params: {master_id:0}});
		if(!resep_dokter_createWindow.isVisible()){
			resep_dokter_reset_form();
			post2db='CREATE';
			msg='created';
			resep_dokter_createWindow.show();
		} else {
			resep_dokter_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function resepdokter_confirm_delete(){
		if(resep_dokterListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', resepdokter_delete);
		} else if(resep_dokterListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', resepdokter_delete);
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
	function resepdokter_confirm_update(){
		/* only one record is selected here */
		var get_resep_id=resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_id');
		
		cbo_resepdokter_produkDataStore.setBaseParam('query',resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_id'));
		cbo_resepdokter_produkDataStore.load({params:{query:resep_dokterListEditorGrid.getSelectionModel().getSelected().get('resep_id')}});
		
		cbo_resepdokterDataStore.load();
		cbo_resepdokter_customerDataStore.load();
		//cbo_resepdokter_produkDataStore.load();
		cbo_resepdokter_paketDataStore.load();
		//cbo_resep_satuan_DataStore.load();
		if(resep_dokterListEditorGrid.selModel.getCount() == 1) {
			resepdokter_set_form();
			post2db='UPDATE';
			resep_dokter_detail_lepasanDataStore.setBaseParam('master_id',get_pk_id());
			resep_dokter_detail_lepasanDataStore.load();
			resep_dokter_detail_tambahanDataStore.setBaseParam('master_id',get_pk_id());
			resep_dokter_detail_tambahanDataStore.load();
			//resep_dokter_detail_lepasanDataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			resep_dokter_detail_kombinasiDataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			//resep_dokter_detail_tambahanDataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			resep_dokter_createWindow.show();
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
	function resepdokter_delete(btn){
		if(btn=='yes'){
			var selections = resep_dokterListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< resep_dokterListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.resep_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_resep_dokter&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							resep_dokterDataStore.reload();
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
  	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
  
	/* Function for Retrieve DataStore */
	resep_dokterDataStore = new Ext.data.Store({
		id: 'resep_dokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task : "LIST", start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'resep_id'
		},[
		/* dataIndex => insert intoresep_dokterColumnModel, Mapping => for initiate table column */ 
			{name: 'resep_namacust', type: 'string', mapping: 'cust_nama'}, 
			{name: 'resep_cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'resep_no', type: 'string', mapping: 'resep_no'},
			{name: 'resep_id', type: 'int', mapping: 'resep_id'},
			{name: 'resep_namadokter', type: 'string', mapping: 'karyawan_username'},
			{name: 'resep_sip', type: 'string', mapping: 'karyawan_sip'},
			{name: 'resep_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'resep_tanggal'}, 
			{name: 'resep_creator', type: 'string', mapping: 'resep_creator'}, 
			{name: 'resep_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'resep_date_create'}, 
			{name: 'resep_update', type: 'string', mapping: 'resep_update'}, 
			{name: 'resep_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'resep_date_update'}, 
			{name: 'resep_revised', type: 'int', mapping: 'resep_revised'}
		]),
		sortInfo:{field: 'resep_tanggal', direction: "DESC"}
	});
	/* End of Function */
	
	//ComboBox ambil data Customer
	cbo_resepdokter_customerDataStore = new Ext.data.Store({
		id: 'cbo_resepdokter_customerDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit:pageS }, // parameter yang di $_POST ke Controller
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
	var customer_resepdokter_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );

	/* Combo box ambil data dokter */
	cbo_resepdokterDataStore = new Ext.data.Store({
		id: 'cbo_resepdokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=get_dokter_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'karyawan_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'karyawan_username', type: 'string', mapping: 'karyawan_username'},
			//{name: 'karyawan_sip', type: 'string', mapping: 'karyawan_sip'},
			{name: 'karyawan_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'karyawan_jmltindakan', type: 'int', mapping: 'reportt_jmltindakan'}
		]),
		sortInfo:{field: 'karyawan_display', direction: "ASC"}
	});
	var dokter_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{karyawan_username}</b> | {karyawan_display} | </span>',
        '</div></tpl>'
    );
    
	/* Combo box ambil data satuan */
	cbo_resep_satuan_DataStore = new Ext.data.Store({
		id: 'cbo_resep_satuan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=get_satuan_list', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'satuan_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'satuan_id', type: 'int', mapping: 'satuan_id'},
			{name: 'satuan_nama', type: 'string', mapping: 'satuan_nama'}
		]),
		sortInfo:{field: 'satuan_nama', direction: "ASC"}
	});
	/*======= END cbo_resep_satuan_DataStore =======*/
	
  	/* Function for Identify of Window Column Model */
	resep_dokterColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'resep_tanggal',
			width: 60,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			sortable: true,
			hidden: false
		},
		{
			header: '<div align="center">' + 'No Resep' + '</div>',
			dataIndex: 'resep_no',
			width: 60,	//210,
			sortable: true	
		}, 	
		{
			header: '<div align="center">' + 'Dokter' + '</div>',
			dataIndex: 'resep_namadokter',
			width: 60,
			sortable: true,
			editable:false
		}, 
		{
			header: '<div align="center">' + 'No SIP' + '</div>',
			dataIndex: 'resep_sip',
			width: 60,	//210,
			sortable: true,
			readOnly: true	
		}, 
		{
			header: '<div align="center">' + 'No Customer' + '</div>',
			dataIndex: 'resep_cust_no',
			width: 60,	//210,
			sortable: true,
			readOnly: true	
		}, 
		{
			header: '<div align="center">' + 'Customer' + '</div>',
			dataIndex: 'resep_namacust',
			width: 200,	//210,
			sortable: true
		}
	]);
	resep_dokterColumnModel.defaultSortable= true;
	/* End of Function */

	
	

	
	var handleAction = function(action){
        Ext.example.msg('<b>Action</b>', 'You clicked "'+action+'"');
    };
	
	/* Declare DataStore and  show datagrid list */
	resep_dokterListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'resep_dokterListEditorGrid',
		el: 'fp_resep_dokter',
		title: 'Daftar Resep Dokter',
		autoHeight: true,
		store: resep_dokterDataStore, // DataStore
		cm: resep_dokterColumnModel, // Nama-nama Columns
		enableColLock:true,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,	//970,
		bbar: new Ext.PagingToolbar({
			disabled:false,
			store: resep_dokterDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new record',
			disabled:false,
			enableOverflow: true,
			iconCls:'icon-adds', 
			// this is defined in our styles.css
			handler: display_form_window
			//handler: handleAction.createCallback('Add'),
		}, '-',{
			text: 'Edit',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: resepdokter_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: resepdokter_confirm_delete   // Confirm before deleting
		}, '-', 
			new Ext.app.SearchField({
			store: resep_dokterDataStore,
			params: {task: 'LIST',start: 0, limit: pageS},
			listeners:{
				specialkey: function(f,e){
					if(e.getKey() == e.ENTER){
						resep_dokterDataStore.baseParams={task:'LIST',start: 0, limit: pageS};
		            }
				},
				render: function(c){
				Ext.get(this.id).set({qtitle:'Search By'});
				Ext.get(this.id).set({qtip:'- Nama Customer<br>- No Resep'});
				}
			},
			width: 100
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: resepdokter_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: resepdokter_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: resepdokter_print  
		}
		]
	});
	resep_dokterListEditorGrid.show();
	resep_dokterListEditorGrid.render();
	/* End of DataStore */

	 
	 
	 
	 
	/* Create Context Menu */
	resep_dokterContextMenu = new Ext.menu.Menu({
		id: 'resep_dokterListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: resepdokter_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: resepdokter_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: resepdokter_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: resepdokter_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onresepdokter_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		resep_dokterContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		resep_dokterSelectedRow=rowIndex;
		resep_dokterContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function resepdokter_editContextMenu(){
		//resep_dokterListEditorGrid.startEditing(resep_dokterSelectedRow,1);
		resepdokter_confirm_update();
  	}
	/* End of Function */
  	
	resep_dokterListEditorGrid.addListener('rowcontextmenu', onresepdokter_ListEditGridContextMenu);
	resep_dokterDataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	resep_dokterListEditorGrid.on('afteredit', resepdokter_update); // inLine Editing Record
	
	/* Identify  resep_id Field */
	resep_idField= new Ext.form.NumberField({
		id: 'resep_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	resep_noField= new Ext.form.TextField({
		id: 'resep_noField',
		fieldLabel: 'No Resep',
		emptyText: '(No Resep Auto)',
		maxLength: 50,
		readOnly : true
	});
	
	resep_dokterField= new Ext.form.ComboBox({
		//id: 'resep_dokterField',
		fieldLabel: 'Dokter',
		store: cbo_resepdokterDataStore,
		mode: 'remote',
		displayField:'karyawan_username',
		valueField: 'karyawan_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: dokter_tpl,
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		disabled:false,
		anchor: '90%'
	});
	
	resep_sipField= new Ext.form.TextField({
		id: 'resep_sipField',
		fieldLabel: 'SIP',
		readOnly: true
	});
	
	resep_tanggalField= new Ext.form.DateField({
		id: 'resep_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y'
	});
	
	resep_custField= new Ext.form.ComboBox({
		fieldLabel: 'Customer',
		store: cbo_resepdokter_customerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_resepdokter_tpl,
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		disabled:false,
		anchor: '90%'
	});
	
	resep_nocustField= new Ext.form.TextField({
		id: 'resep_nocustField',
		fieldLabel: 'No Cust',
		readOnly: true,
	});

  	/*Fieldset Master*/
	resepdokter_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [resep_tanggalField, resep_noField, resep_dokterField, resep_sipField, resep_custField,resep_nocustField, resep_idField] 
			}
			]
	});
		
	/*master_history_resepkombinasi_itemGroup = new Ext.form.FieldSet({
		title: '-',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		labelSeparator : ':',
		//width: 50,
		anchor: '100%',
		items:[
			{
				columnWidth:1,
				layout: 'form',
				labelAlign: 'left',
				border:false,
				labelWidth: 400,
				items: history_detail_resep_kombinasiListGrid
			}
			]
	
	});*/
		
	//function for editor of detail
	var editor_resepdokter_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	var produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{dproduk_produk_kode}| <b>{dproduk_produk_display}</b>',
		'</div></tpl>'
    );

	//function for json writer of detail
	var resepdokter_detail_lepasan_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	var detail_resepdokter_lepasan_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intopeprodukan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dresepl_id', type: 'int', mapping: 'dresepl_id'}, 
			{name: 'dresepl_master', type: 'int', mapping: 'dresepl_master'}, 
			{name: 'dresepl_produk', type: 'int', mapping: 'dresepl_produk'},
			{name: 'dresepl_satuan', type: 'int', mapping: 'dresepl_satuan'},
			{name: 'dresepl_jumlah', type: 'int', mapping: 'dresepl_jumlah'},
			{name: 'satuan_nama', type: 'string', mapping: 'satuan_nama'}
	]);
	//eof
	
	var detail_resepdokter_kombinasi_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: 'dresepk_id'
	},[
	/* dataIndex => insert intopeprodukan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dresepk_id', type: 'int', mapping: 'dresepk_id'}, 
			{name: 'dresepk_master', type: 'int', mapping: 'dresepk_master'}, 
			{name: 'dresepk_paket', type: 'int', mapping: 'dresepk_paket'}
	]);
	//eof
	
	//function for json writer of detail
	var resepdokter_detail_tambahan_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	var detail_resepdokter_tambahan_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intopeprodukan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dresept_id', type: 'int', mapping: 'dresept_id'}, 
			{name: 'dresept_master', type: 'int', mapping: 'dresept_master'}, 
			{name: 'dresept_tambahan', type: 'string', mapping: 'dresept_tambahan'},
			{name: 'dresept_satuan', type: 'string', mapping: 'dresept_satuan'},
			{name: 'dresept_jumlah', type: 'int', mapping: 'dresept_jumlah'}
	]);
	//eof
	
	var editor_detail_resepkombinasi= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });

	var editor_detail_reseplepasan= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
		/*listeners: {
			afteredit: function(){
				resep_dokter_detail_lepasanDataStore.commitChanges();
				//cbo_resep_satuan_DataStore.load({params: {dresepl_master: "", dresepl_produk: ""}});
			}
		}*/
    });
	
	var editor_detail_reseptambahan= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	
	/*  Combo untuk ambil data produk */
	cbo_resepdokter_produkDataStore = new Ext.data.Store({
		id: 'cbo_resepdokter_produkDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=get_produk_list', 
			method: 'POST'
		}),baseParams: {start: 0,limit:pageS},
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'dproduk_produk_value', type: 'int', mapping: 'produk_id'},
			{name: 'dproduk_produk_harga', type: 'float', mapping: 'produk_harga'},
			{name: 'dproduk_produk_kode', type: 'string', mapping: 'produk_kode'},
			{name: 'dproduk_produk_satuan', type: 'string', mapping: 'satuan_kode'},
			{name: 'dproduk_produk_group', type: 'string', mapping: 'group_nama'},
			{name: 'dproduk_produk_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'dproduk_produk_du', type: 'float', mapping: 'produk_du'},
			{name: 'dproduk_produk_dm', type: 'float', mapping: 'produk_dm'},
			{name: 'dproduk_produk_display', type: 'string', mapping: 'produk_nama'}
		]),
		sortInfo:{field: 'dproduk_produk_display', direction: "ASC"}
	});
	
	/* Combo untuk ambil data paket */ 
	cbo_resepdokter_paketDataStore = new Ext.data.Store({
		id: 'cbo_resepdokter_paketDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=get_paket_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'paket_id'
		},[
			{name: 'dpaket_paket_value', type: 'int', mapping: 'paket_id'},
			{name: 'dpaket_paket_harga', type: 'float', mapping: 'paket_harga'},
			{name: 'dpaket_paket_kode', type: 'string', mapping: 'paket_kode'},
			{name: 'dpaket_paket_du', type: 'float', mapping: 'paket_du'},
			{name: 'dpaket_paket_dm', type: 'float', mapping: 'paket_dm'},
			{name: 'dpaket_paket_display', type: 'string', mapping: 'paket_nama'},
			{name: 'dpaket_paket_expired', type: 'int', mapping: 'paket_expired'}
		]),
		sortInfo:{field: 'dpaket_paket_display', direction: "ASC"}
	});
	
	var resep_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{dpaket_paket_kode} | <b>{dpaket_paket_display}</b></span>',
		'</div></tpl>'
    );
	
	/* Identify datastore, auto SIP for karyawan */
	auto_karyawansip_DataStore = new Ext.data.Store({
		id: 'auto_karyawansip_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=get_auto_karyawan_sip', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: ''
		},[
			{name: 'karyawan_sip', type: 'string', mapping: 'karyawan_sip'}
		]),
		sortInfo:{field: 'karyawan_sip', direction: "ASC"}
	});
	
	/*Identify datastore, auto cust_no for customer */
	auto_custno_DataStore = new Ext.data.Store({
		id: 'auto_custno_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=get_auto_cust_no', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: ''
		},[
			{name: 'cust_no', type: 'string', mapping: 'cust_no'}
		]),
		sortInfo:{field: 'cust_no', direction: "ASC"}
	});
	
	/* Function for Retrieve DataStore of detail lepasan*/
	resep_dokter_detail_lepasanDataStore = new Ext.data.Store({
		id: 'resep_dokter_detail_lepasanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=detail_resepdokter_lepasan_list', 
			method: 'POST'
		}),
		reader: detail_resepdokter_lepasan_reader,
		baseParams: {master_id: get_pk_id(), start: 0, limit: pageS},
		//baseParams:{master_id: resep_idField.getValue()},
		sortInfo:{field: 'dresepl_id', direction: "ASC"}
	});
	
	/* Function for Datastore of detail kombinasi*/
	resep_dokter_detail_kombinasiDataStore = new Ext.data.Store({
		id: 'resep_dokter_detail_kombinasiDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=detail_resepdokter_kombinasi_list', 
			method: 'POST'
		}),
		reader: detail_resepdokter_kombinasi_reader,
		baseParams: {start: 0, limit: pageS},
		//baseParams:{master_id: resep_idField.getValue()},
		sortInfo:{field: 'dresepk_id', direction: "ASC"}
	});
	
	/* Function for Retrieve DataStore of detail tambahan*/
	resep_dokter_detail_tambahanDataStore = new Ext.data.Store({
		id: 'resep_dokter_detail_tambahanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_resep_dokter&m=detail_resepdokter_tambahan_list', 
			method: 'POST'
		}),
		reader: detail_resepdokter_tambahan_reader,
		baseParams: {master_id: get_pk_id(), start: 0, limit: pageS},
		sortInfo:{field: 'dresept_id', direction: "ASC"}
	});
	
	var combo_resepdokter_detailproduk=new Ext.form.ComboBox({
			store: cbo_resepdokter_produkDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dproduk_produk_display',
			valueField: 'dproduk_produk_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: produk_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'
	});
	
	var combo_resep=new Ext.form.ComboBox({
			store: cbo_resepdokter_paketDataStore,
			mode: 'remote',
			displayField: 'dpaket_paket_display',
			valueField: 'dpaket_paket_value',
			typeAhead: false,
			loadingText: 'Searching...',
			pageSize:pageS,
			hideTrigger:false,
			tpl: resep_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small',
			anchor: '95%'	
	});
	
	var combo_resep_detail_satuan=new Ext.form.ComboBox({
		store: cbo_resep_satuan_DataStore,
		mode: 'remote',
		typeAhead: false,
		displayField: 'satuan_nama',
		valueField: 'satuan_id',
		triggerAction: 'all',
		lazyRender:true
		//hideTrigger: true,
		//readOnly:true
	});
	
	dresepl_jumlahField= new Ext.form.NumberField({
		id: 'dresepl_jumlahField',
		fieldLabel: 'Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		enableKeyEvents: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	dresept_jumlahField= new Ext.form.NumberField({
		id: 'dresept_jumlahField',
		fieldLabel: 'Jumlah',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: true,
		enableKeyEvents: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	history_detail_resep_kombinasiColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Nama Detail Resep' + '</div>',
			dataIndex: '',
			width: 210,
			editor: new Ext.form.TextArea({
				maxLength: 250
          	})
			//editor: combo_produk_terima,
			//renderer: Ext.util.Format.comboRenderer(combo_produk_terima)
		}
		]
		
    );
    history_detail_resep_kombinasiColumnModel.defaultSortable= true;
		
	history_detail_resep_kombinasiListGrid =  new Ext.grid.GridPanel({
		id: 'history_detail_resep_kombinasiListGrid',
		el: 'fp_history_detail_resep_kombinasi',
		height: 400,
		width: 400,
		autoScroll: true,
		//store: , // DataStore
		colModel: history_detail_resep_kombinasiColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		//plugins: [editor_detail_reseptambahan],
		frame: true,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds'  				// this is defined in our styles.css
			//handler: resepdokter_detail_tambahan_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete'
			//handler: resepdokter_detail_kombinasi_confirm_delete
		}
		]
	});
		
	resep_dokter_detail_kombinasiColumnModel = new Ext.grid.ColumnModel(
		[
		{
			align : 'Left',
			header: '<div align="center">' + 'Resep Kombinasi' + '</div>',
			dataIndex: 'dresepk_paket',
			width: 800, //250
			sortable: true,
			allowBlank: false,
			//editor: combo_resepdokter_detailproduk,
			editor : combo_resep,
			renderer: Ext.util.Format.comboRenderer(combo_resep)
		}
		]
	);
	resep_dokter_detail_kombinasiColumnModel.defaultSortable= true;
	//eof
	
	detail_resep_kombinasiListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_resep_kombinasiListEditorGrid',
		el: 'fp_detail_resep_dokter',
		title: 'Detail Resep Kombinasi',
		height: 200,
		width: 800,
		autoScroll: true,
		store: resep_dokter_detail_kombinasiDataStore, // DataStore
		colModel: resep_dokter_detail_kombinasiColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_resepkombinasi],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		/*bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: resep_dokter_detailDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',   				// this is defined in our styles.css
			handler: resepdokter_detail_kombinasi_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: resepdokter_detail_kombinasi_confirm_delete
		}
		]
	});
	//eof
	
	resep_dokter_detail_lepasanColumnModel = new Ext.grid.ColumnModel(
		[
		{
			align : 'Left',
			header: '<div align="center">' + 'Produk' + '</div>',
			dataIndex: 'dresepl_produk',
			width: 200, //250
			sortable: true,
			allowBlank: false,
			editor: combo_resepdokter_detailproduk,
			//editor : combo_resep,
			renderer: Ext.util.Format.comboRenderer(combo_resepdokter_detailproduk)
		},
		{
			header: '<div align="center">Satuan</div>',
			dataIndex: 'dresepl_satuan',
			width: 80,
			sortable: true,
			readOnly : true,
			/*editor: combo_resep_detail_satuan,
			renderer: Ext.util.Format.comboRenderer(combo_resep_detail_satuan)*/
			renderer: function(v, params, record){
				j=cbo_resepdokter_produkDataStore.findExact('dproduk_produk_value',record.data.dresepl_produk,0);
				if(j>-1)
					return cbo_resepdokter_produkDataStore.getAt(j).data.dproduk_produk_satuan;
			}
		},
		{
			header: '<div align="center">Jumlah</div>',
			align: 'right',
			dataIndex: 'dresepl_jumlah',
			width: 80,
			sortable: true,
			editor: dresepl_jumlahField
		},
		]
	);
	resep_dokter_detail_lepasanColumnModel.defaultSortable= true;
	
	detail_resep_lepasanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_resep_lepasanListEditorGrid',
		el: 'fp_detail_resep_lepasan',
		title: 'Detail Resep Lepasan',
		height: 200,
		width: 800,
		autoScroll: true,
		store: resep_dokter_detail_lepasanDataStore, // DataStore
		colModel: resep_dokter_detail_lepasanColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_reseplepasan],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		/*bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: resep_dokter_detailDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: resepdokter_detail_lepasan_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: resepdokter_detail_lepasan_confirm_delete
		}
		]
	});
	
	resep_dokter_detail_tambahanColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Resep Tambahan' + '</div>',
			dataIndex: 'dresept_tambahan',
			width: 200,
			sortable: true,
			//allowBlank : false,
			editor: new Ext.form.TextField({
				maxLength: 250,
          	})
		},
		{
			header: '<div align="center">Satuan</div>',
			dataIndex: 'dresept_satuan',
			width: 80,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250,
          	})
		},
		{
			header: '<div align="center">Jumlah</div>',
			align: 'right',
			dataIndex: 'dresept_jumlah',
			width: 80,
			sortable: true,
			editor: dresept_jumlahField
		},
		]
	);
	resep_dokter_detail_tambahanColumnModel.defaultSortable= true;
	
	detail_resep_tambahanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'detail_resep_tambahanListEditorGrid',
		el: 'fp_detail_resep_tambahan',
		title: 'Detail Resep Tambahan',
		height: 200,
		width: 800,
		autoScroll: true,
		store: resep_dokter_detail_tambahanDataStore, // DataStore
		colModel: resep_dokter_detail_tambahanColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_detail_reseptambahan],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		/*bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: resep_dokter_detailDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',				// this is defined in our styles.css
			handler: resepdokter_detail_tambahan_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: resepdokter_detail_tambahan_confirm_delete
		}
		]
	});
	
	// function for resepdokter detail lepasan add
	function resepdokter_detail_lepasan_add(){
		var edit_detail_lepasan_resepdokter= new detail_resep_lepasanListEditorGrid.store.recordType({
			dresepl_id	:'',		
			dresepl_master	:'',		
			dresepl_produk	:'',
			dresepl_satuan	:'',
			dresepl_jumlah	:'',
			dresepl_tambahan:''
		});
		editor_detail_reseplepasan.stopEditing();
		resep_dokter_detail_lepasanDataStore.insert(0, edit_detail_lepasan_resepdokter);
		detail_resep_lepasanListEditorGrid.getView().refresh();
		detail_resep_lepasanListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_reseplepasan.startEditing(0);
	}
	
	// function for resepdokter detail kombinasi add
	function resepdokter_detail_kombinasi_add(){
		var edit_detail_kombinasi_resepdokter= new detail_resep_kombinasiListEditorGrid.store.recordType({
			dresepk_id	:'',		
			dresepk_master	:'',		
			dresepk_paket	:''
		});
		editor_detail_resepkombinasi.stopEditing();
		resep_dokter_detail_kombinasiDataStore.insert(0, edit_detail_kombinasi_resepdokter);
		detail_resep_kombinasiListEditorGrid.getView().refresh();
		detail_resep_kombinasiListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_resepkombinasi.startEditing(0);
	}
	
	// function for resepdokter detail tambahan  add
	function resepdokter_detail_tambahan_add(){
		var edit_detail_tambahan_resepdokter= new detail_resep_tambahanListEditorGrid.store.recordType({
			dresept_id :'',		
			dresept_master 	:'',
			dresept_tambahan:'',
			dresept_satuan	:'',
			dresept_jumlah	:''
		});
		editor_detail_reseptambahan.stopEditing();
		resep_dokter_detail_tambahanDataStore.insert(0, edit_detail_tambahan_resepdokter);
		detail_resep_tambahanListEditorGrid.getView().refresh();
		detail_resep_tambahanListEditorGrid.getSelectionModel().selectRow(0);
		editor_detail_reseptambahan.startEditing(0);
	}
	
	//function for refresh detail lepasan
	function refresh_detail_lepasan_resepdokter(){
		resep_dokter_detail_lepasanDataStore.commitChanges();
		detail_resep_lepasanListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for refresh detail kombinasi
	function refresh_detail_kombinasi_resepdokter(){
		resep_dokter_detail_kombinasiDataStore.commitChanges();
		detail_resep_kombinasiListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for refresh detail tambahan
	function refresh_detail_tambahan_resepdokter(){
		resep_dokter_detail_tambahanDataStore.commitChanges();
		detail_resep_tambahanListEditorGrid.getView().refresh();
	}
	//eof
	
	function resepdokter_detail_lepasan_insert(){
		var count_detail=resep_dokter_detail_lepasanDataStore.getCount();
		for(i=0;i<resep_dokter_detail_lepasanDataStore.getCount();i++){
			var count_i = i;
			produk_detail_record=resep_dokter_detail_lepasanDataStore.getAt(i);

			if(produk_detail_record.data.dresepl_produk!==null&&produk_detail_record.data.dresepl_produk.dresepl_produk!==""){
				Ext.Ajax.request({
					waitMsg: 'Mohon tunggu...',
					url: 'index.php?c=c_resep_dokter&m=resepdokter_detail_lepasan_insert',
					params:{
						cetak	: cetak_resepdokter,
					dresepl_id	: produk_detail_record.data.dresepl_id, 
					dresepl_master	: eval(get_pk_id()), 
					//dresep_master	: eval(resep_idField.getValue()), 
					dresepl_produk	: produk_detail_record.data.dresepl_produk,
					dresepl_satuan	: produk_detail_record.data.dresepl_satuan,
					dresepl_jumlah	: produk_detail_record.data.dresepl_jumlah,
					dresepl_tambahan: produk_detail_record.data.dresepl_tambahan,
					count	: count_i,
					dcount	: count_detail
					},			
					timeout: 60000,
					success: function(response){
						var result=eval(response.responseText);
						if(result==0){
							resep_dokter_detail_lepasanDataStore.load({params: {master_id:0}});
							Ext.MessageBox.alert(post2db+' OK','Data resep dokter berhasil disimpan');
							post2db="CREATE";
							resep_dokterDataStore.load({params: {start: 0, limit: pageS}});
						}else if(result==-1){
							resep_dokter_detail_lepasanDataStore.load({params: {master_id:0}});
							post2db="CREATE";
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'Data resep dokter tidak bisa disimpan',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
							});
						}else if(result>0){
							resep_dokter_detail_lepasanDataStore.load({params: {master_id:0}});
							Ext.Ajax.request({
								waitMsg: 'Mohon tunggu...',
								url: 'index.php?c=c_resep_dokter&m=catatan_piutang_update',
								params:{dproduk_master	: eval(get_pk_id())}
							});
							resepdokter_cetak(result);
							cetak_resepdokter=0;
							post2db="CREATE";
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
	}
	
	function resepdokter_detail_kombinasi_insert(){
		var count_detail_kombinasi=resep_dokter_detail_kombinasiDataStore.getCount();
		for(i=0;i<resep_dokter_detail_kombinasiDataStore.getCount();i++){
			var count_kombinasi_i = i;
			kombinasi_detail_record=resep_dokter_detail_kombinasiDataStore.getAt(i);
			if(kombinasi_detail_record.data.dresepk_paket!==null&&kombinasi_detail_record.data.dresepk_paket.dresepk_paket!==""){
				Ext.Ajax.request({
					waitMsg: 'Mohon tunggu...',
					url: 'index.php?c=c_resep_dokter&m=resepdokter_detail_kombinasi_insert',
					params:{
						cetak	: cetak_resepdokter,
					dresepk_id	: kombinasi_detail_record.data.dresepk_id, 
					dresepk_master	: eval(get_pk_id()), 
					//dresep_master	: eval(resep_idField.getValue()), 
					dresepk_paket	: kombinasi_detail_record.data.dresepk_paket,
					//dresep_tambahan: kombinasi_detail_record.data.dresepl_tambahan,
					count	: count_kombinasi_i,
					dcount	: count_detail_kombinasi
					},			
					timeout: 60000,
					success: function(response){
						var result=eval(response.responseText);
						if(result==0){
							resep_dokter_detail_kombinasiDataStore.load({params: {master_id:0}});
							Ext.MessageBox.alert(post2db+' OK','Data resep dokter berhasil disimpan');
							post2db="CREATE";
							resep_dokterDataStore.load({params: {start: 0, limit: pageS}});
						}else if(result==-1){
							resep_dokter_detail_kombinasiDataStore.load({params: {master_id:0}});
							post2db="CREATE";
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'Data resep dokter tidak bisa disimpan',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
							});
						}else if(result>0){
							resep_dokter_detail_kombinasiDataStore.load({params: {master_id:0}});
							Ext.Ajax.request({
								waitMsg: 'Mohon tunggu...',
								url: 'index.php?c=c_resep_dokter&m=catatan_piutang_update',
								params:{dproduk_master	: eval(get_pk_id())}
							});
							resepdokter_cetak(result);
							cetak_resepdokter=0;
							post2db="CREATE";
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
	}
	

	function resepdokter_detail_tambahan_insert(){
		var count_detail_tambahan=resep_dokter_detail_tambahanDataStore.getCount();
		for(j=0;j<resep_dokter_detail_tambahanDataStore.getCount();j++){
			var tambahan_count_j = j;
			tambahan_detail_record=resep_dokter_detail_tambahanDataStore.getAt(j);
			if(tambahan_detail_record.data.dresept_tambahan!==null&&tambahan_detail_record.data.dresept_tambahan.dresept_tambahan!==""){
				Ext.Ajax.request({
					waitMsg: 'Mohon tunggu...',
					url: 'index.php?c=c_resep_dokter&m=resepdokter_detail_tambahan_insert',
					params:{
					cetak_tambahan	: cetak_resepdokter,
					dresept_id	: tambahan_detail_record.data.dresept_id, 
					dresept_master	: eval(get_pk_id()), 
					dresept_tambahan: tambahan_detail_record.data.dresept_tambahan,
					dresept_satuan	: tambahan_detail_record.data.dresept_satuan,
					dresept_jumlah	: tambahan_detail_record.data.dresept_jumlah,
					count_tambahan	: tambahan_count_j,
					dcount_tambahan	: count_detail_tambahan
					},			
					timeout: 60000,
					success: function(response){
						var result=eval(response.responseText);
						if(result==0){
							resep_dokter_detail_tambahanDataStore.load({params: {master_id:0}});
							Ext.MessageBox.alert(post2db+' OK','Data resep dokter berhasil disimpan');
							post2db="CREATE";
							resep_dokterDataStore.load({params: {start: 0, limit: pageS}});
						}else if(result==-1){
							resep_dokter_detail_tambahanDataStore.load({params: {master_id:0}});
							post2db="CREATE";
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'Data resep dokter tidak bisa disimpan',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
							});
						}else if(result>0){
							resep_dokter_detail_tambahanDataStore.load({params: {master_id:0}});
							Ext.Ajax.request({
								waitMsg: 'Mohon tunggu...',
								url: 'index.php?c=c_resep_dokter&m=catatan_piutang_update',
								params:{dproduk_master	: eval(get_pk_id())}
							});
							resepdokter_cetak(result);
							cetak_resepdokter=0;
							post2db="CREATE";
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
	}
	
	
	function detail_resepdokter_lepasan_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_resep_dokter&m=detail_resepdokter_lepasan_purge',
			params:{ master_id: eval(resep_idField.getValue()) },
			callback: function(opts, success, response){
				if(success){
					resepdokter_detail_lepasan_insert();
				}
			}
		});
	}
	//eof
	
	function detail_resepdokter_kombinasi_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_resep_dokter&m=detail_resepdokter_kombinasi_purge',
			params:{ master_id: eval(resep_idField.getValue()) },
			callback: function(opts, success, response){
				if(success){
					resepdokter_detail_kombinasi_insert();
				}
			}
		});
	}
	
	function detail_resepdokter_tambahan_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_resep_dokter&m=detail_resepdokter_tambahan_purge',
			params:{ master_id: eval(resep_idField.getValue()) },
			callback: function(opts, success, response){
				if(success){
					resepdokter_detail_tambahan_insert();
				}
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail lepasan */
	function resepdokter_detail_lepasan_confirm_delete(){
		// only one record is selected here
		if(detail_resep_lepasanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', resepdokter_detail_lepasan_delete);
		} else if(detail_resep_lepasanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', resepdokter_detail_lepasan_delete);
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
	
	/* Function for Delete Confirm of detail  kombinasi*/
	function resepdokter_detail_kombinasi_confirm_delete(){
		// only one record is selected here
		if(detail_resep_kombinasiListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', resepdokter_detail_kombinasi_delete);
		} else if(detail_resep_lepasanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', resepdokter_detail_kombinasi_delete);
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
	
	
	/* Function for Delete Confirm of detail lepasan */
	function resepdokter_detail_tambahan_confirm_delete(){
		// only one record is selected here
		if(detail_resep_tambahanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', resepdokter_detail_tambahan_delete);
		} else if(detail_resep_tambahanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', resepdokter_detail_tambahan_delete);
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
	
	
	//function for Delete of detail lepasan
	function resepdokter_detail_lepasan_delete(btn){
		if(btn=='yes'){
			var s = detail_resep_lepasanListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				resep_dokter_detail_lepasanDataStore.remove(r);
			}
		}  
	}
	//eof
	
	//function for Delete of detail kombinasi
	function resepdokter_detail_kombinasi_delete(btn){
		if(btn=='yes'){
			var s = detail_resep_kombinasiListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				resep_dokter_detail_kombinasiDataStore.remove(r);
			}
		}  
	}
	//eof
	
	//function for Delete of detail tambahan
	function resepdokter_detail_tambahan_delete(btn){
		if(btn=='yes'){
			var s = detail_resep_tambahanListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				resep_dokter_detail_tambahanDataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	resep_dokter_detail_lepasanDataStore.on('update', refresh_detail_lepasan_resepdokter);
	resep_dokter_detail_kombinasiDataStore.on('update', refresh_detail_kombinasi_resepdokter);
	resep_dokter_detail_tambahanDataStore.on('update', refresh_detail_tambahan_resepdokter);
	
	
	
	
	/* END PRODUK DETAIL*/
	
	resep_dokterField.on("select",function(){
		load_karyawan_sip();
		j=auto_karyawansip_DataStore.find('karyawan_id',resep_dokterField.getValue());
		if(j>-1)
			resep_sipField.setValue(auto_karyawan_sip_DataStore.getAt(j).karyawan_sip);
		else
			resep_sipField.setValue("");
	});
	
	resep_custField.on("select",function(){
		load_cust_no();
		g=auto_custno_DataStore.find('cust_id',resep_custField.getValue());
		if(g>-1)
			resep_nocustField.setValue(auto_cust_no_DataStore.getAt(j).cust_no);
		else
			resep_nocustField.setValue("");
	});
	
	var detail_tab_resepdokter = new Ext.TabPanel({
		plain:true,
		activeTab: 0,
		autoHeight: true,
		items: [detail_resep_kombinasiListEditorGrid, detail_resep_lepasanListEditorGrid, detail_resep_tambahanListEditorGrid
		/*{
					title:'Detail Resep Kombinasi',
					layout:'form',
					border: false,
					frame: true,
					defaults: {width: 400},
					autoHeight: true,
					defaultType: 'textfield',
					items: [detail_resep_kombinasiListEditorGrid]
				},
				{
					title:'Detail Resep Lepasan',
					layout:'form',
					border: false,
					frame: true,
					defaults: {width: 400},
					autoHeight: true,
					defaultType: 'textfield',
					items: [detail_resep_lepasanListEditorGrid]
				}*/
		]
	});
	
	/* Function for retrieve create Window Panel*/ 
	resep_dokter_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 450,        
		items: [resepdokter_masterGroup, detail_tab_resepdokter]
		,
		buttons: [{
				text: 'Save and Print',
				handler: save_andPrint
			},
			
			{
				text: 'Save',
				handler: resepdokter_create
			},
			
			{
				text: 'Cancel',
				handler: function(){
					resep_dokter_reset_form();
					resep_dokter_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	resep_dokter_createWindow= new Ext.Window({
		id: 'resep_dokter_createWindow',
		title: post2db+'Resep Dokter',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_resepdokter_create',
		items: resep_dokter_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function resep_dokter_search(){
		// render according to a SQL date format.
		var resep_id_search=null;
		var resep_cust_search=null;
		var trawat_tgl_start_app_search=null;
		var trawat_tgl_end_app_search=null;
		var trawat_rawat_search=null;
		var resep_dokter_search=null;
		var trawat_status_search=null;

		if(resepdokter_idSearchField.getValue()!==null){resep_id_search=resepdokter_idSearchField.getValue();}
		if(resepdokter_custSearchField.getValue()!==null){resep_cust_search=resepdokter_custSearchField.getValue();}
		if(Ext.getCmp('trawat_medis_tglStartAppSearchField').getValue()!==null){trawat_tgl_start_app_search=Ext.getCmp('trawat_medis_tglStartAppSearchField').getValue();}
		if(Ext.getCmp('trawat_medis_tglEndAppSearchField').getValue()!==null){trawat_tgl_end_app_search=Ext.getCmp('trawat_medis_tglEndAppSearchField').getValue();}
		if(trawat_medis_rawatSearchField.getValue()!==null){trawat_rawat_search=trawat_medis_rawatSearchField.getValue();}
		if(resepdokter_dokterSearchField.getValue()!==null){resep_dokter_search=resepdokter_dokterSearchField.getValue();}
		// change the store parameters
		resep_dokterDataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			trawat_id	:	resep_id_search, 
			card_cust	:	resep_cust_search, 
			trawat_tglapp_start	: 	trawat_tgl_start_app_search,
			trawat_tglapp_end	: 	trawat_tgl_end_app_search,
			trawat_rawat	:	trawat_rawat_search,
			trawat_dokter	:	resep_dokter_search
		};
		// Cause the datastore to do another query : 
		resep_dokterDataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function resepdokter_reset_search(){
		// reset the store parameters
		resep_dokterDataStore.baseParams = { task: 'LIST',start:0,limit:pageS };
		// Cause the datastore to do another query : 
		resep_dokterDataStore.reload({params: {start: 0, limit: pageS}});
		resep_dokter_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  trawat_id Search Field */
	resepdokter_idSearchField= new Ext.form.NumberField({
		id: 'resepdokter_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  card_cust Search Field */
	resepdokter_custSearchField= new Ext.form.ComboBox({
		//id: 'resep_dokterField',
		fieldLabel: 'Customer',
		store: cbo_resepdokter_customerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_resepdokter_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		anchor: '95%'
	});
	trawat_medis_rawatSearchField= new Ext.form.ComboBox({
		fieldLabel: 'Perawatan',
		//store: rekomendasi_perawatan_medisDataStore,
		mode: 'remote',
		displayField:'perawatan_display',
		valueField: 'perawatan_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		width: 214
	});
	resepdokter_dokterSearchField= new Ext.form.ComboBox({
		fieldLabel: 'Dokter',
		store: cbo_resepdokterDataStore,
		mode: 'remote',
		displayField:'karyawan_username',
		valueField: 'karyawan_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: dokter_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: true,
		width: 214
	});
 
	/* Function for retrieve search Form Panel */
	resep_dokter_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 640,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [resepdokter_custSearchField,
						trawat_medis_rawatSearchField,resepdokter_dokterSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: resep_dokter_search
			},{
				text: 'Close',
				handler: function(){
					resep_dokter_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 

	function resep_dokter_reset_formSearch(){
		resepdokter_idSearchField.reset();
		resepdokter_idSearchField.setValue(null);
		resepdokter_custSearchField.reset();
		resepdokter_custSearchField.setValue(null);
		Ext.getCmp('trawat_medis_tglStartAppSearchField').reset();
		Ext.getCmp('trawat_medis_tglStartAppSearchField').setValue(null);
		Ext.getCmp('trawat_medis_tglEndAppSearchField').reset();
		Ext.getCmp('trawat_medis_tglEndAppSearchField').setValue(null);
	}
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	resep_dokter_searchWindow = new Ext.Window({
		title: 'Resep Dokter Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_resep_dokter_search',
		items: resep_dokter_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!resep_dokter_searchWindow.isVisible()){
			resep_dokter_reset_formSearch();
			resep_dokter_searchWindow.show();
		} else {
			resep_dokter_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function resepdokter_print(){
		var searchquery = "";
		var card_cust_print=null;
		var card_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(resep_dokterDataStore.baseParams.query!==null){searchquery = resep_dokterDataStore.baseParams.query;}
		if(resep_dokterDataStore.baseParams.card_cust!==null){card_cust_print = resep_dokterDataStore.baseParams.card_cust;}
		if(resep_dokterDataStore.baseParams.card_keterangan!==null){card_keterangan_print = resep_dokterDataStore.baseParams.card_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_resep_dokter&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			card_cust : card_cust_print,
			card_keterangan : card_keterangan_print,
		  	currentlisting: resep_dokterDataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./tindakanlist.html','tindakanlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function resepdokter_export_excel(){
		var searchquery = "";
		var card_cust_2excel=null;
		var card_keterangan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(resep_dokterDataStore.baseParams.query!==null){searchquery = resep_dokterDataStore.baseParams.query;}
		if(resep_dokterDataStore.baseParams.card_cust!==null){card_cust_2excel = resep_dokterDataStore.baseParams.card_cust;}
		if(resep_dokterDataStore.baseParams.card_keterangan!==null){card_keterangan_2excel = resep_dokterDataStore.baseParams.card_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_resep_dokter&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			card_cust : card_cust_2excel,
			card_keterangan : card_keterangan_2excel,
		  	currentlisting: resep_dokterDataStore.baseParams.task // this tells us if we are searching or not
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
	
	/*combo_resepdokter_detailproduk.on('select', function(){
			
		for(i=0;i<resep_dokter_detail_lepasanDataStore.getCount();i++){
			var detail_data=resep_dokter_detail_lepasanDataStore.getAt(i);
			cbo_resep_satuan_DataStore.setBaseParam('task','produk');
			cbo_resep_satuan_DataStore.setBaseParam('selected_id',combo_resepdokter_detailproduk.getValue());
			cbo_resep_satuan_DataStore.load();
			var j=cbo_resepdokter_produkDataStore.findExact('produk_id',combo_resepdokter_detailproduk.getValue(),0);
			if(j>-1)
			{
				var data_combo=cbo_resepdokter_produkDataStore.getAt(j);
				detail_data.data.dresepl_satuan=data_combo.data.produk_satuan;
				//detail_data.data.drbeli_harga=data_combo.data.produk_harga;
				//detail_data.data.drbeli_diskon=data_combo.data.produk_diskon;
				combo_resep_detail_satuan.setValue(data_combo.data.produk_satuan);
				//dretur_beli_diskonField.setValue(data_combo.data.produk_diskon);
				//dretur_beli_hargaField.setValue(data_combo.data.produk_harga);
				//dretur_beli_subtotalField.setValue((100-data_combo.data.produk_diskon)*data_combo.data.produk_harga*dretur_beli_jumlahField.getValue()/100);
			}
		}
	});*/
	
	
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_resep_dokter"></div>
         <div id="fp_resep_dokter_detail"></div>
		 <div id="fp_detail_resep_dokter"></div>
		 <div id="fp_detail_resep_lepasan"></div>
		 <div id="fp_detail_resep_tambahan"></div>
		 <div id="fp_dresep_dokter"></div>
		 <div id="fp_history_detail_resep_kombinasi"></div>
		<div id="elwindow_resepdokter_create"></div>
        <div id="elwindow_resep_dokter_search"></div>
    </div>
</div>
</body>