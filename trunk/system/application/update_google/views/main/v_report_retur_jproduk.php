<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_rproduk.php
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

var rprodukWindow;
var rprodukForm;

/* declare variable here */

var rpt_rproduktglstartField;
var rpt_rproduktglendField;
var rpt_rprodukcustomerField;

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
	
	cbo_rproduk_customerDataStore = new Ext.data.Store({
	id: 'cbo_rproduk_customerDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_retur_jproduk&m=get_customer_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'cust_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_cust_value', type: 'int', mapping: 'cust_id'},
			{name: 'cbo_cust_display', type: 'string', mapping: 'cust_nama'},
			{name: 'cbo_cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cbo_cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cbo_cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cbo_cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
	sortInfo:{field: 'cbo_cust_display', direction: "ASC"}
	});
	
	cbo_retur_m_jprodukDataStore = new Ext.data.Store({
	id: 'cbo_retur_m_jprodukDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_retur_jproduk&m=get_master_jproduk_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jproduk_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_jproduk_value', type: 'int', mapping: 'jproduk_id'},
			{name: 'cbo_jproduk_display', type: 'string', mapping: 'jproduk_nobukti'}
		]),
	sortInfo:{field: 'cbo_jproduk_display', direction: "ASC"}
	});
	
	cbo_retur_m_rprodukDataStore = new Ext.data.Store({
	id: 'cbo_retur_m_rprodukDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_retur_jproduk&m=get_master_rproduk_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rproduk_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_rproduk_value', type: 'int', mapping: 'rproduk_id'},
			{name: 'cbo_rproduk_display', type: 'string', mapping: 'rproduk_nobukti'}
		]),
	sortInfo:{field: 'cbo_rproduk_display', direction: "ASC"}
	});
	
	var customer_rproduk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cbo_cust_no} : {cbo_cust_display}</b> | Tgl-Lahir:{cbo_cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cbo_cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cbo_cust_telprumah}]',
        '</div></tpl>'
    );
	
	rpt_rprodukcustomerField= new Ext.form.ComboBox({
		id: 'rpt_rprodukcustomerField',
		fieldLabel: 'Customer',
		store: cbo_rproduk_customerDataStore,
		mode: 'remote',
		displayField:'cbo_cust_display',
		valueField: 'cbo_cust_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_rproduk_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	rpt_rproduk_nobuktiField= new Ext.form.ComboBox({
		id: 'rpt_rproduk_nobuktiField',
		fieldLabel: 'No.Faktur',
		anchor: '95%',
		store: cbo_retur_m_rprodukDataStore,
		mode: 'remote',
		displayField: 'cbo_rproduk_display',
		valueField: 'cbo_rproduk_value',
		triggerAction: 'all'
	});
	
	rpt_rproduk_nobuktijualField= new Ext.form.ComboBox({
		id: 'rpt_rproduk_nobuktijualField',
		fieldLabel: 'No.Faktur Jual',
		anchor: '95%',
		store: cbo_retur_m_jprodukDataStore,
		mode: 'remote',
		displayField: 'cbo_jproduk_display',
		valueField: 'cbo_jproduk_value',
		triggerAction: 'all'
	});
	
	rpt_rproduktglstartField= new Ext.form.DateField({
		id: 'rpt_rproduktglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_rproduktglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_rproduktglendField'
	});
	
	rpt_rproduktglendField= new Ext.form.DateField({
		id: 'rpt_rproduktglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_rproduktglendField',
        vtype: 'daterange',
        startDateField: 'rpt_rproduktglstartField'
	});
	
	rpt_rproduk_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Retur Penjualan Produk',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_rproduktglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_rproduktglendField] 
			}
			]
	});
	
	function printreport_rproduk(){

		var rpt_rproduk_customer="";
		var rpt_rproduk_nobukti="";
		var rpt_rproduk_nobuktijual="";
		var rpt_rproduk_tglstart="";
		var rpt_rproduk_tglend="";
		var win;               
		
		if(rpt_rprodukcustomerField.getValue()!=""){rpt_rproduk_customer = rpt_rprodukcustomerField.getValue();}
		if(rpt_rproduk_nobuktijualField.getValue()!=""){rpt_rproduk_nobuktijual = rpt_rproduk_nobuktijualField.getValue();}
		if(rpt_rproduk_nobuktiField.getValue()!=""){rpt_rproduk_nobukti = rpt_rproduk_nobuktiField.getValue();}
		if(rpt_rproduktglstartField.getValue()!=''){rpt_rproduk_tglstart = rpt_rproduktglstartField.getValue().format('Y-m-d');}
		if(rpt_rproduktglendField.getValue()!=''){rpt_rproduk_tglend = rpt_rproduktglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_retur_jproduk&m=printreport_rproduk',
		params: {
			rproduk_cust : rpt_rproduk_customer,
			rproduk_nobuktijual : rpt_rproduk_nobuktijual,
			rproduk_nobukti : rpt_rproduk_nobukti,
			rproduk_tglstart : rpt_rproduk_tglstart, 
			rproduk_tglend : rpt_rproduk_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_rproduklist.html','report_rproduklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rprodukForm = new Ext.FormPanel({
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
				items: [rpt_rproduk_nobuktiField, rpt_rproduk_nobuktijualField, rpt_rprodukcustomerField, rpt_rproduk_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_rproduk
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rprodukWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rprodukWindow = new Ext.Window({
		title: 'Report Retur Penjualan Produk',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_rprodukreport',
		items: rprodukForm
	});
	rprodukForm.getForm().load();
  	rprodukWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_rprodukreport"></div>
    </div>
</div>