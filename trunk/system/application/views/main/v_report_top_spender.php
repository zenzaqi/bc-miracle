<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan View
	+ Description	: For record view
	+ Filename 		: v_tindakan.php
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
var tindakan_medisDataStore;
//var sum_kreditDataStore;
var tindakan_medisColumnModel;
//var sum_kreditColumnModel;
var tindakanListEditorGrid;
var tindakan_medis_createForm;
var tindakan_medis_createWindow;
var tindakan_medis_searchForm;
var tindakan_medis_searchWindow;
var tindakan_medisSelectedRow;
var tindakan_medisContextMenu;
var jenisField;
var jumlahField;
//for detail data
var tindakan_medis_detail_DataStore;
var tindakan_medisdetailListEditorGrid;
var tindakan_medisdetail_ColumnModel;
var tindakan_medis_detail_proxy;
var tindakan_medis_detail_writer;
var tindakan_medis_detail_reader;
var editor_tindakan_medis_detail;

var today=new Date().format('d-m-Y');

//declare konstant 
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var trawat_medis_idField;
var trawat_medis_idSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function tindakan_medis_update(oGrid_event){
		var trawat_id_update_pk="";
		var dtrawat_perawatan_id_update=null;
		var dtrawat_perawatan_update=null;
		var dtrawat_id_update=null;
		var dtrawat_dapp_update="";
		var dtrawat_dokter_update=null;
		var dtrawat_dokter_id_update=null;

		trawat_id_update_pk = oGrid_event.record.data.trawat_id;
		dtrawat_perawatan_id_update = oGrid_event.record.data.dtrawat_perawatan_id;
		dtrawat_perawatan_update = oGrid_event.record.data.dtrawat_perawatan;
		dtrawat_id_update = oGrid_event.record.data.dtrawat_id;
		dtrawat_dapp_update = oGrid_event.record.data.dtrawat_dapp;
		dtrawat_dokter_update = oGrid_event.record.data.dtrawat_petugas1;
		dtrawat_dokter_id_update = oGrid_event.record.data.dtrawat_petugas1_id;
		dpaket_id_update = oGrid_event.record.data.dpaket_id;
		rpaket_perawatan_update = oGrid_event.record.data.rpaket_perawatan;

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_report_top_spender&m=get_action',
			params: {
				task: "UPDATE",
				mode_edit: "update_list",
				trawat_id	: trawat_id_update_pk, 
				dtrawat_perawatan_id	:dtrawat_perawatan_id_update,
				dtrawat_perawatan	:dtrawat_perawatan_update,
				dtrawat_id	:dtrawat_id_update,
				dtrawat_dapp	: dtrawat_dapp_update,
				dtrawat_dokter : dtrawat_dokter_update,
				dtrawat_dokter_id : dtrawat_dokter_id_update,
				dpaket_id	: dpaket_id_update,
				rpaket_perawatan	: rpaket_perawatan_update
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
			
					default:
						tindakan_medisDataStore.commitChanges();
						tindakan_medisDataStore.reload();
						//trawat_medis_perawatanDataStore.reload();
		
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
	function tindakan_medis_create(){
	
		if(is_tindakan_medisform_valid()){	
		var trawat_id_create=null; 


		if(trawat_medis_idField.getValue()!== null){trawat_id_create = trawat_medis_idField.getValue();}else{trawat_id_create=get_pk_id();} 
		if(jenisField.getValue()!== null){produk_aktif_create = jenisField.getValue();}
		//if(jumlahField.getValue()!== null){produk_aktif_create1 = jumlahField.getValue();}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_report_top_spender&m=get_action',
			params: {
				task: post2db,
				trawat_id	: trawat_id_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						tindakan_medisdetail_insert();
						dtindakan_jual_nonmedis_insert();
						tindakan_medis_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Tindakan.',
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
			return tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function tindakan_medisreset_form(){
		trawat_medis_idField.reset();
		trawat_medis_idField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function tindakan_medis_set_form(){
		trawat_medis_idField.setValue(tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_id'));
		trawat_medis_custidField.setValue(tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_cust_id'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_tindakan_medisform_valid(){
		return (true &&  trawat_medis_custField.isValid() && true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
	
	// cek valid
	function is_tindakan_medis_searchform_valid(){
		return (Ext.getCmp('trawat_medis_tglStartAppSearchField').isValid() && jumlahField.getValue()!=null && jenisField.getValue()!=null);
		// && trawat_medis_dokterSearchField.isValid()
	}
	
  	/* End of Function */
	
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!tindakan_medis_createWindow.isVisible()){
			tindakan_medis_detail_DataStore.load({
				params: {master_id:0, start:0, limit:pageS}
			});
			tindakan_medisreset_form();
			post2db='CREATE';
			msg='created';
			tindakan_medis_createWindow.show();
		} else {
			tindakan_medis_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function tindakan_medisconfirm_delete(){
		// only one tindakan is selected here
		if(tindakanListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_medisdelete);
		} else if(tindakanListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_medisdelete);
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
	
	function tindakan_medisconfirm_update(){
		/* only one record is selected here */
		var get_trawat_id=tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_id');
		
		//cbo_dtindakan_terapisDataStore.load();
		//cbo_dtindakan_dokterDataStore.load();
		if(tindakanListEditorGrid.selModel.getCount() == 1) {
			//trawat_medis_perawatanDataStore.load({params:{query:tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_id')}});
			//cbo_perawatan_dtjnonmedisDataStore.load({params:{query:tindakanListEditorGrid.getSelectionModel().getSelected().get('trawat_id')}});
			tindakan_medis_set_form();
			post2db='UPDATE';
			tindakan_medis_detail_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			dtindakan_jual_nonmedisDataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			tindakan_medis_createWindow.show();
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
	function tindakan_medisdelete(btn){
		if(btn=='yes'){
			var selections = tindakanListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< tindakanListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.trawat_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_report_top_spender&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							tindakan_medisDataStore.reload();
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
	//isc_datastore
	tindakan_medisDataStore = new Ext.data.Store({
		id: 'tindakan_medisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: ''
		},[
		/* dataIndex => insert intotindakan_medisColumnModel, Mapping => for initiate table column */ 
			//{name: 'dtrawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_date_create'},
			//{name: 'tindakan_dokter', type: 'string', mapping: 'karyawan_username'}, 
			//{name: 'tindakan_perawatan', type: 'string', mapping: 'rawat_nama'},
			//{name: 'dtrawat_petugas1', type: 'string', mapping: 'dokter_username'},
			//{name: 'trawat_cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			//{name: 'trawat_keterangan', type: 'string', mapping: 'trawat_keterangan'}, 
			//{name: 'trawat_creator', type: 'string', mapping: 'trawat_creator'}, 
			//{name: 'trawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'trawat_date_create'}, 
			//{name: 'trawat_update', type: 'string', mapping: 'trawat_update'}, 
			//{name: 'trawat_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'trawat_date_update'}, 
			//{name: 'trawat_revised', type: 'int', mapping: 'trawat_revised'},
			//{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'},
			//{name: 'dtrawat_dapp', type: 'int', mapping: 'dtrawat_dapp'},
			//{name: 'dtrawat_perawatan_id', type: 'int', mapping: 'dtrawat_perawatan'},
			//{name: 'dtrawat_perawatan', type: 'string', mapping: 'rawat_nama'},
			//{name: 'dtrawat_petugas1', type: 'string', mapping: 'dokter_username'},
			//{name: 'dtrawat_petugas1_id', type: 'int', mapping: 'dokter_id'},
			//{name: 'dtrawat_jam', type: 'string', mapping: 'dtrawat_jam'},
			//{name: 'dtrawat_tglapp', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_tglapp'},
			//{name: 'dtrawat_status', type: 'string', mapping: 'dtrawat_status'},
			//{name: 'perawatan_harga', type: 'float', mapping: 'rawat_harga'},
			//{name: 'perawatan_du', type: 'int', mapping: 'rawat_du'},
			//{name: 'perawatan_dm', type: 'int', mapping: 'rawat_dm'},
			//{name: 'cust_member', type: 'string', mapping: 'cust_member'},
			//{name: 'dtrawat_keterangan', type: 'string', mapping: 'dtrawat_keterangan'},
			//{name: 'dtrawat_ambil_paket', type: 'string', mapping: 'dtrawat_ambil_paket'},
			//{name: 'cust_punya_paket', type: 'string', mapping: 'cust_punya_paket'},
			//{name: 'dpaket_id', type: 'int', mapping: 'dpaket_id'},
			//{name: 'rpaket_perawatan', type: 'int', mapping: 'rpaket_perawatan'},
			//{name: 'dtrawat_edit', type: 'string', mapping: 'Jumlah_rawat'},
			//{name: 'dtrawat_skredit', type: 'string', mapping: 'rawat_kredit'},
			//{name: 'dtrawat_jkredit', type: 'string', mapping: 'Total_kredit'},
			{name: 'total', type: 'float', mapping: 'total'},
			//{name: 'all_total', type: 'float', mapping: 'all_total'},
			{name: 'customer_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'customer_member', type: 'string', mapping: 'cust_member'},
		]),
		sortInfo:{field: 'total', direction: "DESC"}
	});
	/* End of Function */
	
	
	/* Function for summary kredit data store */ 
	/*
	sum_kreditDataStore = new Ext.data.Store({
		id: 'sum_kreditDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST2",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'dtrawat_id'
		},[
		/* dataIndex => insert intotindakan_medisColumnModel, Mapping => for initiate table column 
			{name: 'dtrawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_date_create'},
			{name: 'tindakan_dokter', type: 'string', mapping: 'karyawan_username'}, 
			{name: 'tindakan_perawatan', type: 'string', mapping: 'rawat_nama'},
			{name: 'dtrawat_petugas1', type: 'string', mapping: 'dokter_username'},
			{name: 'trawat_cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'trawat_keterangan', type: 'string', mapping: 'trawat_keterangan'}, 
			{name: 'trawat_creator', type: 'string', mapping: 'trawat_creator'}, 
			{name: 'trawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'trawat_date_create'}, 
			{name: 'trawat_update', type: 'string', mapping: 'trawat_update'}, 
			{name: 'trawat_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'trawat_date_update'}, 
			{name: 'trawat_revised', type: 'int', mapping: 'trawat_revised'},
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'},
			{name: 'dtrawat_dapp', type: 'int', mapping: 'dtrawat_dapp'},
			{name: 'dtrawat_perawatan_id', type: 'int', mapping: 'dtrawat_perawatan'},
			{name: 'dtrawat_perawatan', type: 'string', mapping: 'rawat_nama'},
			{name: 'dtrawat_petugas1_id', type: 'int', mapping: 'dokter_id'},
			{name: 'dtrawat_jam', type: 'string', mapping: 'dtrawat_jam'},
			{name: 'dtrawat_tglapp', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_tglapp'},
			{name: 'dpaket_id', type: 'int', mapping: 'dpaket_id'},
			{name: 'rpaket_perawatan', type: 'int', mapping: 'rpaket_perawatan'},
			{name: 'dtrawat_edit', type: 'string', mapping: 'Jumlah_rawat'},
			{name: 'dtrawat_skredit', type: 'string', mapping: 'rawat_kredit'},
			{name: 'dtrawat_jkredit', type: 'string', mapping: 'Total_kredit'},
			{name: 'dtrawat_kredit', type: 'string', mapping: 'grand_total'},
		]),
		sortInfo:{field: 'dtrawat_petugas1', direction: "DESC"}
	});
	*/
	/* End of Function */
	/*
	trawat_medis_perawatanDataStore = new Ext.data.Store({
		id: 'trawat_medis_perawatanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=get_tindakan_medis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'perawatan_value', type: 'int', mapping: 'rawat_id'},
			{name: 'perawatan_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'perawatan_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'perawatan_group', type: 'string', mapping: 'group_nama'},
			{name: 'perawatan_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'perawatan_du', type: 'float', mapping: 'rawat_du'},
			{name: 'perawatan_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'perawatan_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'perawatan_display', direction: "ASC"}
	});
	
	var trawat_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{perawatan_kode}| <b>{perawatan_display}</b>',
		'</div></tpl>'
    );
	/*
	
	//tindakan medis data store
	/*
	cbo_dtindakan_dokterDataStore = new Ext.data.Store({
		id: 'cbo_dtindakan_dokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=get_dokter_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column 
			{name: 'karyawan_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'karyawan_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'karyawan_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'karyawan_jmltindakan', type: 'int', mapping: 'reportt_jmltindakan'}
		]),
		sortInfo:{field: 'karyawan_display', direction: "ASC"}
	});
	
	var dokter_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{karyawan_username}</b> | {karyawan_display} | <b>{karyawan_jmltindakan}</b></span>',
        '</div></tpl>'
    );
	*/
    
  	/* Function for Identify of Window Column Model */
	//Tampilkan di grid
	tindakan_medisColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'No Customer' + '</div>',
			dataIndex: 'cust_no',
			width: 80,
			sortable: true,
			editable:true,
			editor: new Ext.form.ComboBox({
				//store: cbo_dtindakan_dokterDataStore,
				mode: 'remote',
				displayField: 'karyawan_username',
				valueField: 'karyawan_value',
				loadingText: 'Searching...',
				triggerAction: 'all',
				anchor: '95%'
			})
		}, 
		{
			header: '<div align="center">' + 'Nama Customer' + '</div>',
			dataIndex: 'customer_nama',
			width: 300,//185,	//210,
			sortable: true,
			editor: new Ext.form.ComboBox({
				//store: trawat_medis_perawatanDataStore,
				mode: 'remote',
				displayField: 'rawat_nama',
				valueField: 'perawatan_value',
				//tpl: trawat_rawat_tpl,
				itemSelector: 'div.search-item',
				loadingText: 'Searching...',
				triggerAction: 'all',
				anchor: '95%'
			})
		}, 
		{
			header: '<div align="center">' + 'No Member' + '</div>',
			dataIndex: 'customer_member',
			width: 80,//185,	//210,
			sortable: true,
			editor: new Ext.form.ComboBox({
				//store: trawat_medis_perawatanDataStore,
				mode: 'remote',
				//displayField: 'rawat_nama',
				//valueField: 'perawatan_value',
				//tpl: trawat_rawat_tpl,
				itemSelector: 'div.search-item',
				loadingText: 'Searching...',
				triggerAction: 'all',
				anchor: '95%'
			})
		}, 
		{	
			align : 'Right',
			header: '<div align="center">' + 'Total (Rp)' + '</div>',
			dataIndex: 'total',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			readOnly: true,
			width: 80,	//55,
			sortable: true
		}/*,
		{	
			align : 'Right',
			header: '<div align="center">' + 'Kredit (Satuan)' + '</div>',
			dataIndex: 'dtrawat_skredit',
			width: 80,	//55,
			sortable: false
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Total Kredit' + '</div>',
			dataIndex: 'dtrawat_jkredit',
			width: 80,	//55,
			sortable: false
		},
		*/
	]);
	
	tindakan_medisColumnModel.defaultSortable= true;
	/* End of Function */
	function ch_status(val){
		if(val=="selesai"){
			return '<span style="color:blue;"><b>' + val + '</b></span>';
		}else if(val=="siap"){
			return '<span style="color:green;"><b>' + val + '</b></span>';
		}else if(val=="datang"){
			return '<span style="color:red;"><b>' + val + '</b></span>';
		}else if(val=="batal"){
			return '<span style="color:black;"><b>' + val + '</b></span>';
		}
		return val;
	}
    /*
	sum_kreditColumnModel = new Ext.grid.ColumnModel(
		[
	
		{	
			align : 'Right',
			header: '<div align="right">' + 'Grand Total Kredit' + '</div>',
			dataIndex: 'dtrawat_kredit',
			width: 80,	//55,
			sortable: false
		},
		]);
	*/
	//sum_kreditColumnModel.defaultSortable= true;
	/* End of Function */
	function ch_status(val){
		if(val=="selesai"){
			return '<span style="color:blue;"><b>' + val + '</b></span>';
		}else if(val=="siap"){
			return '<span style="color:green;"><b>' + val + '</b></span>';
		}else if(val=="datang"){
			return '<span style="color:red;"><b>' + val + '</b></span>';
		}else if(val=="batal"){
			return '<span style="color:black;"><b>' + val + '</b></span>';
		}
		return val;
	}
	
	/* Declare DataStore and  show datagrid list */
	tindakanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'tindakanListEditorGrid',
		el: 'fp_top_spender',
		title: 'Laporan Top Spender',
		autoHeight: true,
		store: tindakan_medisDataStore, // DataStore
		cm: tindakan_medisColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800, //940,//1200,	//970,
		bbar: new Ext.PagingToolbar({
			//pageSize: pageS,
			disabled:true,
			store: tindakan_medisDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tindakan_medisexport_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tindakan_medisprint  
		}
		]
	});
	tindakanListEditorGrid.render();
	/* End of DataStore */
	
	/*
	tindakanListEditorGrid2 =  new Ext.grid.EditorGridPanel({
		id: 'tindakanListEditorGrid2',
		el: 'fp_top_spender',
		title: '',
		autoHeight: true,
		store: sum_kreditDataStore, // DataStore
		cm: sum_kreditColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800, //940,//1200,	//970,
	
		/* Add Control on ToolBar */
	
	//});
	//tindakanListEditorGrid2.render();
	
	/* Create Context Menu */
	tindakan_medisContextMenu = new Ext.menu.Menu({
		id: 'tindakan_medisListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: tindakan_mediseditContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: tindakan_medisconfirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: tindakan_medisprint 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: tindakan_medisexport_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function ontindakan_medisListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		tindakan_medisContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		tindakan_medisSelectedRow=rowIndex;
		tindakan_medisContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function tindakan_mediseditContextMenu(){
		//tindakanListEditorGrid.startEditing(tindakan_medisSelectedRow,1);
		tindakan_medisconfirm_update();
  	}
	/* End of Function */
  	
	tindakanListEditorGrid.addListener('rowcontextmenu', ontindakan_medisListEditGridContextMenu);
	tindakan_medisDataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	tindakanListEditorGrid.on('afteredit', tindakan_medis_update); // inLine Editing Record
	
	/* Identify  trawat_id Field */
	trawat_medis_idField= new Ext.form.NumberField({
		id: 'trawat_medis_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	/* Identify  jenis Combo*/
	jenisField= new Ext.form.ComboBox({
		id: 'jenisField',
		fieldLabel: 'Jenis',
		store:new Ext.data.SimpleStore({
			fields:['jenis_value', 'jenis_display'],
			data:[['Perawatan','Perawatan'],['Produk','Produk'],['Paket','Paket'],['Semua','Semua']]
		}),
		mode: 'local',
		editable:false,
		emptyText: 'Pilih Satu...',
		displayField: 'jenis_display',
		valueField: 'jenis_value',
		width: 100,
		triggerAction: 'all'	
	});

	/* Identify  jumlah Combo*/
	jumlahField= new Ext.form.ComboBox({
		id: 'jumlahField',
		fieldLabel: 'Jumlah',
		store:new Ext.data.SimpleStore({
			fields:['jumlah_value', 'jumlah_display'],
			data:[['5','5'],['10','10'],['15','15'],['20','20'],['25','25'],['30','30'],['35','35'],['40','40'],['45','45'],['50','50']]
		}),
		mode: 'local',
		editable:false,
		emptyText: 'Pilih Satu...',
		displayField: 'jumlah_display',
		valueField: 'jumlah_value',
		width: 50,
		triggerAction: 'all'	
	});
  	/*Fieldset Master*/
	tindakan_medismasterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [trawat_medis_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	
	/* Function for Retrieve DataStore of detail*/
	tindakan_medis_detail_DataStore = new Ext.data.Store({
		id: 'tindakan_medis_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=detail_tindakan_detail_list', 
			method: 'POST'
		}),
		reader: tindakan_medis_detail_reader,
		baseParams:{master_id: trawat_medis_idField.getValue()},
		sortInfo:{field: 'dtrawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_tindakan_medis_detail= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	/*
	cbo_dapp_dokterDataStore = new Ext.data.Store({
		id: 'cbo_dapp_dokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=get_dokter_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column 
			{name: 'dokter_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'dokter_value', type: 'int', mapping: 'karyawan_id'}
		]),
		sortInfo:{field: 'dokter_display', direction: "ASC"}
	});
	*/
	/*
	cbo_dtindakan_terapisDataStore = new Ext.data.Store({
		id: 'cbo_dtindakan_terapisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=get_terapis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'karyawan_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column 
			{name: 'dtrawat_karyawan_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'dtrawat_karyawan_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'dtrawat_karyawan_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'dtrawat_karyawan_jmltindakan', type: 'int', mapping: 'reportt_jmltindakan'}
		]),
		sortInfo:{field: 'dtrawat_karyawan_display', direction: "ASC"}
	});
	*/
	
	cbo_trawat_rawatDataStore = new Ext.data.Store({
		id: 'cbo_trawat_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=get_tindakan_medis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'trawat_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'trawat_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'trawat_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'trawat_rawat_group', type: 'string', mapping: 'group_nama'},
			{name: 'trawat_rawat_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'trawat_rawat_du', type: 'float', mapping: 'rawat_du'},
			{name: 'trawat_rawat_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'trawat_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'trawat_rawat_display', direction: "ASC"}
	});
	var cbo_trawat_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{trawat_rawat_kode}| <b>{trawat_rawat_display}</b>',
		'</div></tpl>'
    );
	
	/*
	var combo_trawat_rawat=new Ext.form.ComboBox({
			store: trawat_medis_perawatanDataStore,
			mode: 'remote',
			typeAhead: false,
			displayField: 'perawatan_display',
			valueField: 'perawatan_value',
			loadingText: 'Searching...',
			pageSize:10,
			hideTrigger:false,
			tpl: trawat_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
	});
	*/
	/*
	var combo_dapp_dokter=new Ext.form.ComboBox({
			store: cbo_dtindakan_dokterDataStore,
			mode: 'remote',
			displayField: 'karyawan_username',
			valueField: 'karyawan_value',
			tpl: dokter_tpl,
			loadingText: 'Searching...',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			anchor: '95%'
	});
	*/
	
	var checkColumn = new Ext.grid.CheckColumn({
		header: 'Ambil Paket',
		dataIndex: 'dtrawat_ambil_paket',
		hidden: true,
		width: 75
	});
	
	//declaration of detail coloumn model
	tindakan_medisdetail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'dtrawat_status',
			width: 80,	//100,
			sortable: true,
			editable:false,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dtrawat_status_value', 'dtrawat_status_display'],
					data: [['batal','batal'],['selesai','selesai'],['datang','datang']]
					}),
				mode: 'local',
               	displayField: 'dtrawat_status_display',
               	valueField: 'dtrawat_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
	checkColumn]
	);
	tindakan_medisdetail_ColumnModel.defaultSortable= true;
	//eof
	
	
	//declaration of detail list editor grid
	tindakan_medisdetailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'tindakan_medisdetailListEditorGrid',
		el: 'fp_top_tindakan_medisdetail',
		title: 'Detail Tindakan Medis',
		height: 200,
		width: 888,
		autoScroll: true,
		store: tindakan_medis_detail_DataStore, // DataStore
		colModel: tindakan_medisdetail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_tindakan_medis_detail,checkColumn],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},

		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: tindakan_medisdetail_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: tindakan_medisdetail_confirm_delete
		}
		]
	});
	//eof
	

	//function of detail add
	function tindakan_medisdetail_add(){
		var edit_tindakan_medisdetail= new tindakan_medisdetailListEditorGrid.store.recordType({
			dtrawat_id	:'',		
			dtrawat_master	:'',		
			dtrawat_perawatan	:'',		
			dtrawat_petugas1	:'',		
			dtrawat_jam	:'',		
			dtrawat_status	:'datang',
			dtrawat_keterangan	: ''
		});
		editor_tindakan_medis_detail.stopEditing();
		tindakan_medis_detail_DataStore.insert(0, edit_tindakan_medisdetail);
		tindakan_medisdetailListEditorGrid.getView().refresh();
		tindakan_medisdetailListEditorGrid.getSelectionModel().selectRow(0);
		editor_tindakan_medis_detail.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_tindakan_medisdetail(){

	}
	//eof
	
	//function for insert detail
	function tindakan_medisdetail_insert(){
		for(i=0;i<tindakan_medis_detail_DataStore.getCount();i++){
			tindakan_medisdetail_record=tindakan_medis_detail_DataStore.getAt(i);
			if(tindakan_medisdetail_record.data.dtrawat_perawatan!=""){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_report_top_spender&m=detail_tindakan_medis_detail_insert',
					params:{
					dtrawat_id	: tindakan_medisdetail_record.data.dtrawat_id, 
					dtrawat_master	: eval(trawat_medis_idField.getValue()), 
					dtrawat_perawatan	: tindakan_medisdetail_record.data.dtrawat_perawatan, 
					dtrawat_petugas1	: tindakan_medisdetail_record.data.dtrawat_petugas1, 
					dtrawat_petugas2	: tindakan_medisdetail_record.data.dtrawat_petugas2, 
					dtrawat_jamreservasi	: tindakan_medisdetail_record.data.dtrawat_jam, 
					dtrawat_kategori	: tindakan_medisdetail_record.data.dtrawat_kategori, 
					dtrawat_status	: tindakan_medisdetail_record.data.dtrawat_status,
					dtrawat_keterangan	: tindakan_medisdetail_record.data.dtrawat_keterangan,
					dtrawat_ambil_paket	: tindakan_medisdetail_record.data.dtrawat_ambil_paket,
					dtrawat_cust	: trawat_medis_custidField.getValue()
					},
					callback: function(opts, success, response){
						if(success){
							tindakan_medisDataStore.reload();
						
						}
					}
				});
			}
		}
	}
	//eof
	

	
	/* Function for Delete Confirm of detail */
	function tindakan_medisdetail_confirm_delete(){
		// only one record is selected here
		if(tindakan_medisdetailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_medisdetail_delete);
		} else if(tindakan_medisdetailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_medisdetail_delete);
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
	function tindakan_medisdetail_delete(btn){
		if(btn=='yes'){
			var s = tindakan_medisdetailListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				tindakan_medis_detail_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	tindakan_medis_detail_DataStore.on('update', refresh_tindakan_medisdetail);
	
	/* START JUAL DETAIL_NON-MEDIS */
	/*Detail Declaration */
		
	// Function for json reader of detail
	var dtindakan_jual_nonmedis_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'}, 
			{name: 'dtrawat_master', type: 'int', mapping: 'dtrawat_master'}, 
			{name: 'dtrawat_perawatan', type: 'int', mapping: 'dtrawat_perawatan'}, 
			{name: 'dtrawat_petugas1', type: 'int', mapping: 'dtrawat_petugas1'}, 
			{name: 'dtrawat_petugas2', type: 'int', mapping: 'dtrawat_petugas2'}, 
			{name: 'dtrawat_jam', type: 'string', mapping: 'dtrawat_jam'}, 
			{name: 'dtrawat_kategori', type: 'string', mapping: 'dtrawat_kategori'}, 
			{name: 'dtrawat_status', type: 'string', mapping: 'dtrawat_status'},
			{name: 'dtrawat_keterangan', type: 'string', mapping: 'dtrawat_keterangan'} 
	]);
	//eof
	
	//function for json writer of detail
	var dtindakan_jual_nonmedis_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	dtindakan_jual_nonmedisDataStore = new Ext.data.Store({
		id: 'dtindakan_jual_nonmedisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=dtindakan_jual_nonmedis_list', 
			method: 'POST'
		}),
		reader: dtindakan_jual_nonmedis_reader,
		baseParams:{master_id: trawat_medis_idField.getValue()},
		sortInfo:{field: 'dtrawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_dtindakan_jual_nonmedis= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	var terapis_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dtrawat_karyawan_username}</b> | {dtrawat_karyawan_display} | <b>{dtrawat_karyawan_jmltindakan}</b></span>',
        '</div></tpl>'
    );
	/*
	cbo_perawatan_dtjnonmedisDataStore = new Ext.data.Store({
		id: 'cbo_perawatan_dtjnonmedisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_top_spender&m=get_nonmedis_in_tmedis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'perawatan_value', type: 'int', mapping: 'rawat_id'},
			{name: 'perawatan_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'perawatan_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'perawatan_group', type: 'string', mapping: 'group_nama'},
			{name: 'perawatan_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'perawatan_du', type: 'float', mapping: 'rawat_du'},
			{name: 'perawatan_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'perawatan_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'perawatan_display', direction: "ASC"}
	});
	var rawat_dtjnonmedis_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{perawatan_kode}| <b>{perawatan_display}</b>',
		'</div></tpl>'
    );
	*/
	/*
	var combo_perawatan_dtjnonmedis=new Ext.form.ComboBox({
			store: cbo_perawatan_dtjnonmedisDataStore,
			mode: 'remote',
			typeAhead: false,
			displayField: 'perawatan_display',
			valueField: 'perawatan_value',
			tpl: rawat_dtjnonmedis_tpl,
			loadingText: 'Searching...',
			hideTrigger:false,
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
			listClass: 'x-combo-list-small'
	});
	*/
	/*
	var combo_dtindakan_terapis=new Ext.form.ComboBox({
			store: cbo_dtindakan_terapisDataStore,
			mode: 'remote',
			typeAhead: true,
			displayField: 'dtrawat_karyawan_username',
			valueField: 'dtrawat_karyawan_value',
			tpl: terapis_tpl,
			loadingText: 'Searching...',
			itemSelector: 'div.search-item',
			triggerAction: 'all'
	});
	*/
	
	//declaration of detail coloumn model
	/*
	tindakan_nonmedis_detailColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'dtrawat_perawatan',
			width: 290,
			sortable: true,
			editor: combo_perawatan_dtjnonmedis,
			renderer: Ext.util.Format.comboRenderer(combo_perawatan_dtjnonmedis)
		},

		{
			header: '<div align="center">' + 'Detail Keterangan' + '</div>',
			dataIndex: 'dtrawat_keterangan',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250,
			})
		}]
	);
	*/
	//tindakan_nonmedis_detailColumnModel.defaultSortable= true;
	//eof
	

	//declaration of detail list editor grid
	/*
	dtindakan_jual_nonmedisListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'dtindakan_jual_nonmedisListEditorGrid',
		el: 'fp_top_dtindakan_jual_nonmedis',
		title: 'Detail Tindakan Non Medis',
		height: 200,
		width: 888,
		autoScroll: true,
		store: dtindakan_jual_nonmedisDataStore, // DataStore
		colModel: tindakan_nonmedis_detailColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_dtindakan_jual_nonmedis],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		/*bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: dtindakan_jual_nonmedisDataStore,
			displayInfo: true
		}),*/
		/* Add Control on ToolBar 
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: dtindakan_jual_nonmedis_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: dtindakan_jual_nonmedis_confirm_delete
		}
		]
	});
	*/
	//eof

	
	//function of detail add
	/*
	function dtindakan_jual_nonmedis_add(){
		var edit_tindakan_nonmedis_detail= new dtindakan_jual_nonmedisListEditorGrid.store.recordType({
			dtrawat_perawatan	:'',
			dtrawat_keterangan	:''		
		});
		editor_dtindakan_jual_nonmedis.stopEditing();
		dtindakan_jual_nonmedisDataStore.insert(0, edit_tindakan_nonmedis_detail);
		dtindakan_jual_nonmedisListEditorGrid.getView().refresh();
		dtindakan_jual_nonmedisListEditorGrid.getSelectionModel().selectRow(0);
		editor_dtindakan_jual_nonmedis.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_dtindakan_jual_nonmedis(){
		//dtindakan_jual_nonmedisDataStore.commitChanges();
		//dtindakan_jual_nonmedisListEditorGrid.getView().refresh();
	}
	*/
	//eof
	
	//function for insert detail
	function dtindakan_jual_nonmedis_insert(){
		if(dtindakan_jual_nonmedisDataStore.getCount()!=0){
			for(i=0;i<dtindakan_jual_nonmedisDataStore.getCount();i++){
				tindakan_nonmedis_detail_record=dtindakan_jual_nonmedisDataStore.getAt(i);
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_report_top_spender&m=detail_dtindakan_jual_nonmedis_insert',
					params:{
					dtrawat_id	: tindakan_nonmedis_detail_record.data.dtrawat_id, 
					dtrawat_master	: eval(trawat_medis_idField.getValue()), 
					dtrawat_perawatan	: tindakan_nonmedis_detail_record.data.dtrawat_perawatan, 
					dtrawat_keterangan	: tindakan_nonmedis_detail_record.data.dtrawat_keterangan,
					customer_id	: trawat_medis_custidField.getValue()
					}
				});
			}
		}else if(dtindakan_jual_nonmedisDataStore.getCount()==0){
			dtindakan_jual_nonmedis_purge();
		}
	}
	//eof
	
	//function for purge detail
	function dtindakan_jual_nonmedis_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_report_top_spender&m=detail_tindakan_nonmedis_detail_purge',
			params:{ master_id: eval(trawat_medis_idField.getValue()) },
			callback: function(opts, success, response){
				if(success){
					//dtindakan_jual_nonmedis_insert();
					dtindakan_jual_nonmedisDataStore.reload();
				}
			}
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	/*
	function dtindakan_jual_nonmedis_confirm_delete(){
		// only one record is selected here
		if(dtindakan_jual_nonmedisListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', dtindakan_jual_nonmedis_delete);
		} else if(dtindakan_jual_nonmedisListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', dtindakan_jual_nonmedis_delete);
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
	*/
	//eof
	
	//function for Delete of detail
	/*
	function dtindakan_jual_nonmedis_delete(btn){
		if(btn=='yes'){
			var s = dtindakan_jual_nonmedisListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				dtindakan_jual_nonmedisDataStore.remove(r);
			}
		}  
	}
	*/
	//eof
	
	//event on update of detail data store
	//dtindakan_jual_nonmedisDataStore.on('update', refresh_dtindakan_jual_nonmedis);
	/* END JUAL DETAIL_NON-MEDIS */
	/*
	var detail_tab_tindakan = new Ext.TabPanel({
		plain:true,
		activeTab: 0,
		autoHeight: true,
		items: [tindakan_medisdetailListEditorGrid,dtindakan_jual_nonmedisListEditorGrid]
	});
	*/
	
	/* Function for retrieve create Window Panel*/ 
	/*
	tindakan_medis_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 930,        
		items: [tindakan_medismasterGroup, detail_tab_tindakan]
		,
		buttons: [{
				text: 'Save and Close',
				handler: tindakan_medis_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					tindakan_medis_createWindow.hide();
				}
			}
		]
	});
	*/
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	tindakan_medis_createWindow= new Ext.Window({
		id: 'tindakan_medis_createWindow',
		title: post2db+'Tindakan Medis',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_top_spender_create',
		items: tindakan_medis_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function top_spender_search(){
		// render according to a SQL date format.
		// KIRIM
		if(is_tindakan_medis_searchform_valid())
		{
		var trawat_id_search=null;
		var trawat_tgl_start_app_search=null;
		var trawat_tgl_end_app_search=null;
		var trawat_dokter_search=null;
		var jenisField_search=null;
		var jumlahField_search=null;

		if(trawat_medis_idSearchField.getValue()!==null){trawat_id_search=trawat_medis_idSearchField.getValue();}
		if(Ext.getCmp('trawat_medis_tglStartAppSearchField').getValue()!==null){trawat_tgl_start_app_search=Ext.getCmp('trawat_medis_tglStartAppSearchField').getValue();}
		if(Ext.getCmp('trawat_medis_tglEndAppSearchField').getValue()!==null){trawat_tgl_end_app_search=Ext.getCmp('trawat_medis_tglEndAppSearchField').getValue();}
		if(jenisField.getValue()!==null){jenisField_search=jenisField.getValue();}
		if(jumlahField.getValue()!==null){jumlahField_search=jumlahField.getValue();}
		//if(trawat_medis_dokterSearchField.getValue()!==null){trawat_dokter_search=trawat_medis_dokterSearchField.getValue();}
		// change the store parameters
		tindakan_medisDataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			/*
			trawat_id	:	trawat_id_search, 
			trawat_tglapp_start	: 	trawat_tgl_start_app_search,
			trawat_tglapp_end	: 	trawat_tgl_end_app_search,
			trawat_dokter	:	trawat_dokter_search,
			*/
			trawat_id	:	trawat_id_search, 
			trawat_tglapp_start	: 	trawat_tgl_start_app_search,
			trawat_tglapp_end	: 	trawat_tgl_end_app_search,
			top_jenis	:	jenisField_search,
			top_jumlah	:	jumlahField_search,
		};
		/*
		sum_kreditDataStore.baseParams = {
			task: 'SEARCH2',
			//variable here
			trawat_id	:	trawat_id_search, 
			trawat_tglapp_start	: 	trawat_tgl_start_app_search,
			trawat_tglapp_end	: 	trawat_tgl_end_app_search,
			trawat_dokter	:	trawat_dokter_search,
		};
		*/
		
		// Cause the datastore to do another query : 
		tindakan_medisDataStore.reload({params: {start: 0, limit: pageS}});
		//sum_kreditDataStore.reload({params: {start: 0, limit: pageS}});
		
	
		}
		
		else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Tanggal, Jenis, atau Jumlah belum diisi',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}

		
	}
		
	/* Function for reset search result */
	function tindakan_medisreset_search(){
		// reset the store parameters
		tindakan_medisDataStore.baseParams = { task: 'LIST',start:0,limit:pageS };
		// Cause the datastore to do another query : 
		tindakan_medisDataStore.reload({params: {start: 0, limit: pageS}});
		tindakan_medis_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  trawat_id Search Field */
	trawat_medis_idSearchField= new Ext.form.NumberField({
		id: 'trawat_medis_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});

	/*
	trawat_medis_dokterSearchField= new Ext.form.ComboBox({
		fieldLabel: 'Dokter',
		store: cbo_dtindakan_dokterDataStore,
		mode: 'remote',
		displayField:'karyawan_username',
		valueField: 'karyawan_username',
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
		allowBlank: false,
		width: 214
	});
	*/

	var dt = new Date(); 
	
	/* Function for retrieve search Form Panel */
	tindakan_medis_searchForm = new Ext.FormPanel({
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
				items: [
				        {
						layout:'column',
						border:false,
						items:[
				        {
							columnWidth:0.33,
							layout: 'form',
							border:false,
							defaultType: 'datefield',
							items: [
							    {
									//fieldLabel: 'Tanggal Tindakan',
									fieldLabel: 'Tanggal',
							        name: 'trawat_medis_tglStartAppSearchField',
							        id: 'trawat_medis_tglStartAppSearchField',
									vtype: 'daterange',
									allowBlank: false,
									format: 'd-m-Y',
							        endDateField: 'trawat_medis_tglEndAppSearchField' // id of the end date field Ext.getCmp('trawat_medis_tglStartAppSearchField').isValid()
							    }] 
						},
						{
							columnWidth:0.30,
							layout: 'form',
							labelWidth:20,
							border:false,
							defaultType: 'datefield',
							items: [
						      	{
									fieldLabel: 's/d',
							        name: 'trawat_medis_tglEndAppSearchField',
							        id: 'trawat_medis_tglEndAppSearchField',
							        vtype: 'daterange',
									allowBlank: false,
									format: 'd-m-Y',
							        startDateField: 'trawat_medis_tglStartAppSearchField' // id of the end date field
							    }] 
						}]},
						jenisField, jumlahField]
						//trawat_medis_dokterSearchField 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				//handler: tindakan_medislist_search
				handler: top_spender_search
			},{
				text: 'Close',
				handler: function(){
					tindakan_medis_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
    
	function tindakan_medis_reset_formSearch(){
		trawat_medis_idSearchField.reset();
		trawat_medis_idSearchField.setValue(null);
		jenisField.reset();
		jenisField.setValue(null);
		jumlahField.reset();
		jumlahField.setValue(null);
		Ext.getCmp('trawat_medis_tglStartAppSearchField').reset();
		Ext.getCmp('trawat_medis_tglStartAppSearchField').setValue(null);
		Ext.getCmp('trawat_medis_tglEndAppSearchField').reset();
		Ext.getCmp('trawat_medis_tglEndAppSearchField').setValue(today);
	}
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	tindakan_medis_searchWindow = new Ext.Window({
		title: 'Pencarian Jumlah Top Spender',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_top_spender_search',
		items: tindakan_medis_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!tindakan_medis_searchWindow.isVisible()){
			tindakan_medis_reset_formSearch();
			tindakan_medis_searchWindow.show();
		} else {
			tindakan_medis_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function tindakan_medisprint(){
		var searchquery = "";
		var trawat_cust_print=null;
		var trawat_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(tindakan_medisDataStore.baseParams.query!==null){searchquery = tindakan_medisDataStore.baseParams.query;}
		if(tindakan_medisDataStore.baseParams.trawat_cust!==null){trawat_cust_print = tindakan_medisDataStore.baseParams.trawat_cust;}
		if(tindakan_medisDataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_print = tindakan_medisDataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_top_spender&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_print,
			trawat_keterangan : trawat_keterangan_print,
		  	currentlisting: tindakan_medisDataStore.baseParams.task // this tells us if we are searching or not
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
	function tindakan_medisexport_excel(){
		var searchquery = "";
		var tindakan_dokter_2excel=null;
		//var tindakan_perawatan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(tindakan_medisDataStore.baseParams.query!==null){searchquery = tindakan_medisDataStore.baseParams.query;}
		if(tindakan_medisDataStore.baseParams.trawat_dokter!==null){tindakan_dokter_2excel = tindakan_medisDataStore.baseParams.trawat_dokter;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_top_spender&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_dokter : tindakan_dokter_2excel,
		  	currentlisting: tindakan_medisDataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_top_spender"></div>
         <div id="fp_top_tindakan_medisdetail"></div>
		 <div id="fp_top_dtindakan_jual_nonmedis"></div>
		<div id="elwindow_top_spender_create"></div>
        <div id="elwindow_top_spender_search"></div>
    </div>
</div>
</body>