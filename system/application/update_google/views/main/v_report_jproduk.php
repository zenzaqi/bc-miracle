<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_jproduk.php
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

var jprodukWindow;
var jprodukForm;

/* declare variable here */

var rpt_jproduktglstartField;
var rpt_jproduktglendField;
var rpt_jprodukcustomerField;

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
	
	cbo_jproduk_customerDataStore = new Ext.data.Store({
	id: 'cbo_jproduk_customerDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_jproduk&m=get_customer_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'cust_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_cust_value', type: 'int', mapping: 'cust_id'},
			{name: 'cbo_cust_diplay', type: 'string', mapping: 'cust_nama'},
			{name: 'cbo_cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cbo_cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cbo_cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cbo_cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
	sortInfo:{field: 'cbo_cust_diplay', direction: "ASC"}
	});
	
	cbo_jproduk_m_jprodukDataStore = new Ext.data.Store({
	id: 'cbo_jproduk_m_jprodukDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_jproduk&m=get_master_jproduk_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jproduk_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_jproduk_value', type: 'int', mapping: 'jproduk_id'},
			{name: 'cbo_jproduk_diplay', type: 'string', mapping: 'jproduk_nobukti'}
		]),
	sortInfo:{field: 'cbo_jproduk_diplay', direction: "ASC"}
	});
	
	var customer_jproduk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cbo_cust_no} : {cbo_cust_diplay}</b> | Tgl-Lahir:{cbo_cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cbo_cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cbo_cust_telprumah}]',
        '</div></tpl>'
    );
	
	rpt_jprodukcustomerField= new Ext.form.ComboBox({
		id: 'rpt_jprodukcustomerField',
		fieldLabel: 'Customer',
		store: cbo_jproduk_customerDataStore,
		mode: 'remote',
		displayField:'cbo_cust_diplay',
		valueField: 'cbo_cust_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_jproduk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	rpt_jproduknobuktiField= new Ext.form.ComboBox({
		id: 'rpt_jproduknobuktiField',
		fieldLabel: 'No.Faktur',
		anchor: '95%',
		store: cbo_jproduk_m_jprodukDataStore,
		mode: 'remote',
		displayField: 'cbo_jproduk_diplay',
		valueField: 'cbo_jproduk_value',
		triggerAction: 'all'
	});
	
	rpt_jproduktglstartField= new Ext.form.DateField({
		id: 'rpt_jproduktglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_jproduktglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_jproduktglendField'
	});
	
	rpt_jproduktglendField= new Ext.form.DateField({
		id: 'rpt_jproduktglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_jproduktglendField',
        vtype: 'daterange',
        startDateField: 'rpt_jproduktglstartField'
	});
	
	rpt_jproduk_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Penjualan Produk',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_jproduktglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_jproduktglendField] 
			}
			]
	});
	
	function printreport_jproduk(){

		var rpt_jproduk_customer="";
		var rpt_jproduk_nobukti="";
		var rpt_jproduk_tglstart="";
		var rpt_jproduk_tglend="";
		var win;               
		
		if(rpt_jprodukcustomerField.getValue()!=""){rpt_jproduk_customer = rpt_jprodukcustomerField.getValue();}
		if(rpt_jproduknobuktiField.getValue()!=""){rpt_jproduk_nobukti = rpt_jproduknobuktiField.getValue();}
		if(rpt_jproduktglstartField.getValue()!=''){rpt_jproduk_tglstart = rpt_jproduktglstartField.getValue().format('Y-m-d');}
		if(rpt_jproduktglendField.getValue()!=''){rpt_jproduk_tglend = rpt_jproduktglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_jproduk&m=printreport_jproduk',
		params: {
			jproduk_cust : rpt_jproduk_customer,
			jproduk_nobukti : rpt_jproduk_nobukti,
			jproduk_tglstart : rpt_jproduk_tglstart, 
			jproduk_tglend : rpt_jproduk_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_jproduklist.html','report_jproduklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rpt_jprodukreportForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		x:0,
		y:0,
		width: 250,
		height: 250,
		items: [{
			layout:'column',
			border:false,
			items:[{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [rpt_jproduknobuktiField, rpt_jprodukcustomerField, rpt_jproduk_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_jproduk
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpt_jprodukreportWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_jprodukreportWindow = new Ext.Window({
		title: 'Report Penjualan Produk',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_jprodukreport',
		items: rpt_jprodukreportForm
	});
	rpt_jprodukreportForm.getForm().load();
  	rpt_jprodukreportWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_jprodukreport"></div>
    </div>
</div>