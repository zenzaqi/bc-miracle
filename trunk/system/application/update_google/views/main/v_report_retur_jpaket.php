<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_rpaket.php
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

var rpaketWindow;
var rpaketForm;

/* declare variable here */

var rpt_rpakettglstartField;
var rpt_rpakettglendField;
var rpt_rpaketcustomerField;

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
	
	cbo_rpaket_customerDataStore = new Ext.data.Store({
	id: 'cbo_rpaket_customerDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_retur_jpaket&m=get_customer_list', 
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
	
	cbo_retur_m_jpaketDataStore = new Ext.data.Store({
	id: 'cbo_retur_m_jpaketDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_retur_jpaket&m=get_master_jpaket_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'jpaket_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_jpaket_value', type: 'int', mapping: 'jpaket_id'},
			{name: 'cbo_jpaket_display', type: 'string', mapping: 'jpaket_nobukti'}
		]),
	sortInfo:{field: 'cbo_jpaket_display', direction: "ASC"}
	});
	
	cbo_retur_m_rpaketDataStore = new Ext.data.Store({
	id: 'cbo_retur_m_rpaketDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_retur_jpaket&m=get_master_rpaket_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rpaket_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_rpaket_value', type: 'int', mapping: 'rpaket_id'},
			{name: 'cbo_rpaket_display', type: 'string', mapping: 'rpaket_nobukti'}
		]),
	sortInfo:{field: 'cbo_rpaket_display', direction: "ASC"}
	});
	
	var customer_rpaket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cbo_cust_no} : {cbo_cust_display}</b> | Tgl-Lahir:{cbo_cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cbo_cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cbo_cust_telprumah}]',
        '</div></tpl>'
    );
	
	rpt_rpaketcustomerField= new Ext.form.ComboBox({
		id: 'rpt_rpaketcustomerField',
		fieldLabel: 'Customer',
		store: cbo_rpaket_customerDataStore,
		mode: 'remote',
		displayField:'cbo_cust_display',
		valueField: 'cbo_cust_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_rpaket_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	rpt_rpaket_nobuktiField= new Ext.form.ComboBox({
		id: 'rpt_rpaket_nobuktiField',
		fieldLabel: 'No.Faktur',
		anchor: '95%',
		store: cbo_retur_m_rpaketDataStore,
		mode: 'remote',
		displayField: 'cbo_rpaket_display',
		valueField: 'cbo_rpaket_value',
		triggerAction: 'all'
	});
	
	rpt_rpaket_nobuktijualField= new Ext.form.ComboBox({
		id: 'rpt_rpaket_nobuktijualField',
		fieldLabel: 'No.Faktur Jual',
		anchor: '95%',
		store: cbo_retur_m_jpaketDataStore,
		mode: 'remote',
		displayField: 'cbo_jpaket_display',
		valueField: 'cbo_jpaket_value',
		triggerAction: 'all'
	});
	
	rpt_rpakettglstartField= new Ext.form.DateField({
		id: 'rpt_rpakettglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_rpakettglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_rpakettglendField'
	});
	
	rpt_rpakettglendField= new Ext.form.DateField({
		id: 'rpt_rpakettglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_rpakettglendField',
        vtype: 'daterange',
        startDateField: 'rpt_rpakettglstartField'
	});
	
	rpt_rpaket_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Retur Penjualan Paket',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_rpakettglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_rpakettglendField] 
			}
			]
	});
	
	function printreport_rpaket(){

		var rpt_rpaket_customer="";
		var rpt_rpaket_nobukti="";
		var rpt_rpaket_nobuktijual="";
		var rpt_rpaket_tglstart="";
		var rpt_rpaket_tglend="";
		var win;               
		
		if(rpt_rpaketcustomerField.getValue()!=""){rpt_rpaket_customer = rpt_rpaketcustomerField.getValue();}
		if(rpt_rpaket_nobuktijualField.getValue()!=""){rpt_rpaket_nobuktijual = rpt_rpaket_nobuktijualField.getValue();}
		if(rpt_rpaket_nobuktiField.getValue()!=""){rpt_rpaket_nobukti = rpt_rpaket_nobuktiField.getValue();}
		if(rpt_rpakettglstartField.getValue()!=''){rpt_rpaket_tglstart = rpt_rpakettglstartField.getValue().format('Y-m-d');}
		if(rpt_rpakettglendField.getValue()!=''){rpt_rpaket_tglend = rpt_rpakettglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_retur_jpaket&m=printreport_rpaket',
		params: {
			rpaket_cust : rpt_rpaket_customer,
			rpaket_nobuktijual : rpt_rpaket_nobuktijual,
			rpaket_nobukti : rpt_rpaket_nobukti,
			rpaket_tglstart : rpt_rpaket_tglstart, 
			rpaket_tglend : rpt_rpaket_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_rpaketlist.html','report_rpaketlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rpaketForm = new Ext.FormPanel({
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
				items: [rpt_rpaket_nobuktiField, rpt_rpaket_nobuktijualField, rpt_rpaketcustomerField, rpt_rpaket_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_rpaket
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpaketWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpaketWindow = new Ext.Window({
		title: 'Report Retur Penjualan Paket',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_rpaketreport',
		items: rpaketForm
	});
	rpaketForm.getForm().load();
  	rpaketWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_rpaketreport"></div>
    </div>
</div>