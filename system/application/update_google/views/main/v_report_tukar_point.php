<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_tukar_point.php
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

var tukar_pointWindow;
var tukar_pointForm;

/* declare variable here */

var rpt_tukar_pointtglstartField;
var rpt_tukar_pointtglendField;
var rpt_tukar_pointcustomerField;

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
	
	cbo_tukar_point_customerDataStore = new Ext.data.Store({
	id: 'cbo_tukar_point_customerDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_tukar_point&m=get_customer_list', 
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
	
	var customer_tukar_point_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cbo_cust_no} : {cbo_cust_diplay}</b> | Tgl-Lahir:{cbo_cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cbo_cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cbo_cust_telprumah}]',
        '</div></tpl>'
    );
	
	rpt_tukar_pointcustomerField= new Ext.form.ComboBox({
		id: 'rpt_tukar_pointcustomerField',
		fieldLabel: 'Customer',
		store: cbo_tukar_point_customerDataStore,
		mode: 'remote',
		displayField:'cbo_cust_diplay',
		valueField: 'cbo_cust_value',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: customer_tukar_point_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	
	rpt_tukar_pointtglstartField= new Ext.form.DateField({
		id: 'rpt_tukar_pointtglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_tukar_pointtglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_tukar_pointtglendField'
	});
	
	rpt_tukar_pointtglendField= new Ext.form.DateField({
		id: 'rpt_tukar_pointtglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_tukar_pointtglendField',
        vtype: 'daterange',
        startDateField: 'rpt_tukar_pointtglstartField'
	});
	
	rpt_tukar_point_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Tukar Point',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_tukar_pointtglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_tukar_pointtglendField] 
			}
			]
	});
	
	function printreport_tukar_point(){

		var rpt_tukar_point_customer="";
		var rpt_tukar_point_nobukti="";
		var rpt_tukar_point_tglstart="";
		var rpt_tukar_point_tglend="";
		var win;               
		
		if(rpt_tukar_pointcustomerField.getValue()!=""){rpt_tukar_point_customer = rpt_tukar_pointcustomerField.getValue();}
		if(rpt_tukar_pointtglstartField.getValue()!=''){rpt_tukar_point_tglstart = rpt_tukar_pointtglstartField.getValue().format('Y-m-d');}
		if(rpt_tukar_pointtglendField.getValue()!=''){rpt_tukar_point_tglend = rpt_tukar_pointtglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_tukar_point&m=printreport_tukar_point',
		params: {
			tukar_point_cust : rpt_tukar_point_customer,
			tukar_point_nobukti : rpt_tukar_point_nobukti,
			tukar_point_tglstart : rpt_tukar_point_tglstart, 
			tukar_point_tglend : rpt_tukar_point_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_tukar_pointlist.html','report_tukar_pointlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rpt_tukar_pointreportForm = new Ext.FormPanel({
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
				items: [rpt_tukar_pointcustomerField, rpt_tukar_point_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_tukar_point
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpt_tukar_pointreportWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_tukar_pointreportWindow = new Ext.Window({
		title: 'Report Point Reward',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_tukar_pointreport',
		items: rpt_tukar_pointreportForm
	});
	rpt_tukar_pointreportForm.getForm().load();
  	rpt_tukar_pointreportWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_tukar_pointreport"></div>
    </div>
</div>