<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_tbeli.php
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

var tbeliWindow;
var tbeliForm;

/* declare variable here */

var rpt_tbelitglstartField;
var rpt_tbelitglendField;
var rpt_tbelisupplierField;
var rpt_tbelinoorderField;

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
	
	cbo_noorderDataStore = new Ext.data.Store({
	id: 'cbo_noorderDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_tbeli&m=get_order_beli_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'order_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_order_value', type: 'int', mapping: 'order_id'},
			{name: 'cbo_order_diplay', type: 'int', mapping: 'order_no'}
		]),
	sortInfo:{field: 'cbo_order_diplay', direction: "ASC"}
	});
	
	cbo_supplierDataStore = new Ext.data.Store({
	id: 'cbo_supplierDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_tbeli&m=get_supplier_list', 
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
	
	rpt_tbelinoorderField= new Ext.form.ComboBox({
		id: 'rpt_tbelinoorderField',
		fieldLabel: 'No.Order',
		anchor: '95%',
		store: cbo_noorderDataStore,
		mode: 'remote',
		displayField: 'cbo_order_diplay',
		valueField: 'cbo_order_value',
		triggerAction: 'all'
	});
	
	rpt_tbelisupplierField= new Ext.form.ComboBox({
		id: 'rpt_tbelisupplierField',
		fieldLabel: 'Supplier',
		anchor: '95%',
		store: cbo_supplierDataStore,
		mode: 'remote',
		displayField: 'cbo_supplier_nama',
		valueField: 'cbo_supplier_id',
		triggerAction: 'all'
	});
	
	rpt_tbelitglstartField= new Ext.form.DateField({
		id: 'rpt_tbelitglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_tbelitglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_tbelitglendField'
	});
	
	rpt_tbelitglendField= new Ext.form.DateField({
		id: 'rpt_tbelitglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_tbelitglendField',
        vtype: 'daterange',
        startDateField: 'rpt_tbelitglstartField'
	});
	
	rpt_tbeli_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Penerimaan Pembelian',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_tbelitglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_tbelitglendField] 
			}
			]
	});
	
	function printreport_tbeli(){

		var rpt_terima_supplier="";
		var rpt_terima_noorder="";
		var rpt_terima_tglstart="";
		var rpt_terima_tglend="";
		var win;               
		
		if(rpt_tbelisupplierField.getValue()!=""){rpt_terima_supplier = rpt_tbelisupplierField.getValue();}
		if(rpt_tbelinoorderField.getValue()!=""){rpt_terima_noorder = rpt_tbelinoorderField.getValue();}
		if(rpt_tbelitglstartField.getValue()!=''){rpt_terima_tglstart = rpt_tbelitglstartField.getValue().format('Y-m-d');}
		if(rpt_tbelitglendField.getValue()!=''){rpt_terima_tglend = rpt_tbelitglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_tbeli&m=printreport_tbeli',
		params: {
		  	terima_supplier : rpt_terima_supplier,
			terima_order : rpt_terima_noorder,
			terima_tglstart : rpt_terima_tglstart, 
			terima_tglend : rpt_terima_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_tbelilist.html','report_tbelilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rpt_tbelireportForm = new Ext.FormPanel({
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
				items: [rpt_tbelinoorderField, rpt_tbelisupplierField, rpt_tbeli_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_tbeli
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpt_tbelireportWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_tbelireportWindow = new Ext.Window({
		title: 'Report Order Pembelian',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_tbelireport',
		items: rpt_tbelireportForm
	});
	rpt_tbelireportForm.getForm().load();
  	rpt_tbelireportWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_tbelireport"></div>
    </div>
</div>