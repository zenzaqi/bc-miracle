<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_rbeli.php
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

var rbeliWindow;
var rbeliForm;

/* declare variable here */

var rpt_rbelitglstartField;
var rpt_rbelitglendField;
var rpt_rbelisupplierField;
var rpt_rbelinoterimaField;

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
	
	cbo_noterimaDataStore = new Ext.data.Store({
	id: 'cbo_noterimaDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_rbeli&m=get_terima_beli_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'terima_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_terima_value', type: 'int', mapping: 'terima_id'},
			{name: 'cbo_terima_diplay', type: 'int', mapping: 'terima_no'}
		]),
	sortInfo:{field: 'cbo_terima_diplay', direction: "ASC"}
	});
	
	cbo_supplierDataStore = new Ext.data.Store({
	id: 'cbo_supplierDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_rbeli&m=get_supplier_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'supplier_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_supplier_id', type: 'int', mapping: 'supplier_id'},
			{name: 'cbo_supplier_nama', type: 'string', mapping: 'supplier_nama'}
		]),
	sortInfo:{field: 'cbo_supplier_id', direction: "ASC"}
	});
	
	rpt_rbelinoterimaField= new Ext.form.ComboBox({
		id: 'rpt_rbelinoterimaField',
		fieldLabel: 'No.Faktur',
		anchor: '95%',
		store: cbo_noterimaDataStore,
		mode: 'remote',
		displayField: 'cbo_terima_diplay',
		valueField: 'cbo_terima_value',
		triggerAction: 'all'
	});
	
	rpt_rbelisupplierField= new Ext.form.ComboBox({
		id: 'rpt_rbelisupplierField',
		fieldLabel: 'Supplier',
		anchor: '95%',
		store: cbo_supplierDataStore,
		mode: 'remote',
		displayField: 'cbo_supplier_nama',
		valueField: 'cbo_supplier_id',
		triggerAction: 'all'
	});
	
	rpt_rbelitglstartField= new Ext.form.DateField({
		id: 'rpt_rbelitglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_rbelitglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_rbelitglendField'
	});
	
	rpt_rbelitglendField= new Ext.form.DateField({
		id: 'rpt_rbelitglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_rbelitglendField',
        vtype: 'daterange',
        startDateField: 'rpt_rbelitglstartField'
	});
	
	rpt_rbeli_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Penerimaan Pembelian',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_rbelitglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_rbelitglendField] 
			}
			]
	});
	
	function printreport_rbeli(){

		var rpt_rbeli_supplier="";
		var rpt_rbeli_noterima="";
		var rpt_rbeli_tglstart="";
		var rpt_rbeli_tglend="";
		var win;               
		
		if(rpt_rbelisupplierField.getValue()!=""){rpt_rbeli_supplier = rpt_rbelisupplierField.getValue();}
		if(rpt_rbelinoterimaField.getValue()!=""){rpt_rbeli_noterima = rpt_rbelinoterimaField.getValue();}
		if(rpt_rbelitglstartField.getValue()!=''){rpt_rbeli_tglstart = rpt_rbelitglstartField.getValue().format('Y-m-d');}
		if(rpt_rbelitglendField.getValue()!=''){rpt_rbeli_tglend = rpt_rbelitglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_rbeli&m=printreport_rbeli',
		params: {
		  	rbeli_supplier : rpt_rbeli_supplier,
			rbeli_terima : rpt_rbeli_noterima,
			rbeli_tglstart : rpt_rbeli_tglstart, 
			rbeli_tglend : rpt_rbeli_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_rbelilist.html','report_rbelilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rpt_rbelireportForm = new Ext.FormPanel({
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
				items: [rpt_rbelinoterimaField, rpt_rbelisupplierField, rpt_rbeli_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_rbeli
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpt_rbelireportWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_rbelireportWindow = new Ext.Window({
		title: 'Report Order Pembelian',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_rbelireport',
		items: rpt_rbelireportForm
	});
	rpt_rbelireportForm.getForm().load();
  	rpt_rbelireportWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_rbelireport"></div>
    </div>
</div>