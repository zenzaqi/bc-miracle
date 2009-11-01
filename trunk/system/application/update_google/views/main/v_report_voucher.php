<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_voucher.php
 	+ Author  		: 
 	+ Created on 01/May/2009 06:35:27
	
*/
?>
<div id="welcome">
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

var voucherWindow;
var voucherForm;

/* declare variable here */

var rpt_vouchertglstartField;
var rpt_vouchertglendField;
var rpt_vouchernamaField;
var rpt_voucherrefpromoField;
var rpt_voucherjenisField;

<?
$idForm=20;
?>
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
        return true;
    }
});


Ext.onReady(function(){
  Ext.QuickTips.init();
	
	cbo_voucher_promoDataStore = new Ext.data.Store({
		id: 'cbo_voucher_promoDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_voucher&m=get_promo_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'promo_id', type: 'int', mapping: 'promo_id'},
			{name: 'promo_acara', type: 'string', mapping: 'promo_acara'},
			{name: 'promo_tempat', type: 'string', mapping: 'promo_tempat'},
			{name: 'promo_tglmulai', type: 'date', dateFormat: 'Y-m-d', mapping: 'promo_tglmulai'}, 
			{name: 'promo_tglselesai', type: 'date', dateFormat: 'Y-m-d', mapping: 'promo_tglselesai'}, 
			{name: 'promo_cashback', type: 'float', mapping: 'promo_cashback'}, 
			{name: 'promo_mincash', type: 'float', mapping: 'promo_mincash'}, 
			{name: 'promo_diskon', type: 'float', mapping: 'promo_diskon'}, 
			{name: 'promo_allproduk', type: 'string', mapping: 'promo_allproduk'}, 
			{name: 'promo_allrawat', type: 'string', mapping: 'promo_allrawat'}, 
		]),
		sortInfo:{field: 'promo_id', direction: "DESC"}
	});
	
	var voucher_promo_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{promo_acara}</b>| Tempat : {promo_tempat}<br/>',
			'Tanggal: {promo_tglmulai:date("M j, Y")} s/d {promo_tglselesai:date("M j, Y")}</span>',
		'</div></tpl>'
    );
	
	rpt_vouchernamaField= new Ext.form.TextField({
		id: 'rpt_vouchernamaField',
		fieldLabel: 'Nama Voucher',
		maxLength: 20,
		allowBlank: true,
		anchor: '95%'
	});
	
	rpt_voucherjenisField= new Ext.form.ComboBox({
		id: 'rpt_voucherjenisField',
		fieldLabel: 'Jenis',
		store:new Ext.data.SimpleStore({
			fields:['voucher_jenis_value', 'voucher_jenis_display'],
			data:[['promo','promo'],['reward','reward']]
		}),
		mode: 'local',
		displayField: 'voucher_jenis_display',
		valueField: 'voucher_jenis_value',
		anchor: '95%',
		triggerAction: 'all'
	});
	
	rpt_voucherrefpromoField= new Ext.form.ComboBox({
		id: 'rpt_voucherrefpromoField',
		fieldLabel: 'Referensi Promo',
		store: cbo_voucher_promoDataStore,
		mode: 'remote',
		displayField:'promo_acara',
		valueField: 'promo_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: voucher_promo_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	rpt_vouchertglstartField= new Ext.form.DateField({
		id: 'rpt_vouchertglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_vouchertglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_vouchertglendField'
	});
	
	rpt_vouchertglendField= new Ext.form.DateField({
		id: 'rpt_vouchertglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_vouchertglendField',
        vtype: 'daterange',
        startDateField: 'rpt_vouchertglstartField'
	});
	
	rpt_voucher_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Kadaluarsa',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_vouchertglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_vouchertglendField] 
			}
			]
	});
	
	function printreport_voucher(){

		var rpt_voucher_nama="";
		var rpt_voucher_jenis="";
		var rpt_voucher_refpromo="";
		var rpt_voucher_tglstart="";
		var rpt_voucher_tglend="";
		var win;               
		
		if(rpt_vouchernamaField.getValue()!=''){rpt_voucher_nama = rpt_vouchernamaField.getValue();}
		if(rpt_voucherjenisField.getValue()!=''){rpt_voucher_jenis = rpt_voucherjenisField.getValue();}
		if(rpt_voucherrefpromoField.getValue()!=''){rpt_voucher_refpromo = rpt_voucherrefpromoField.getValue();}
		if(rpt_vouchertglstartField.getValue()!=''){rpt_voucher_tglstart = rpt_vouchertglstartField.getValue().format('Y-m-d');}
		if(rpt_vouchertglendField.getValue()!=''){rpt_voucher_tglend = rpt_vouchertglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_voucher&m=printreport_voucher',
		params: {
			voucher_nama : rpt_voucher_nama,
			voucher_jenis : rpt_voucher_jenis,
			voucher_promo : rpt_voucher_refpromo,
			voucher_tglstart : rpt_voucher_tglstart, 
			voucher_tglend : rpt_voucher_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_voucherlist.html','report_voucherlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
				win.print();
				break;
		  	default:
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Unable to print the report!',
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
	
	
	rpt_voucherreportForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		x:0,
		y:0,
		width: 250,
		height: 280,
		items: [{
			layout:'column',
			border:false,
			items:[{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [rpt_vouchernamaField, rpt_voucherjenisField, rpt_voucherrefpromoField, rpt_voucher_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_voucher
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpt_voucherreportWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_voucherreportWindow = new Ext.Window({
		title: 'Report Penjualan Produk',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_voucherreport',
		items: rpt_voucherreportForm
	});
	rpt_voucherreportForm.getForm().load();
  	rpt_voucherreportWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_voucherreport"></div>
    </div>
</div>