<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Order Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_obeli.php
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

var obeliWindow;
var obeliForm;

/* declare variable here */

var rpt_obelitglstartField;
var rpt_obelitglendField;
var rpt_obelisupplierField;
var rpt_obelicarabayarField;

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
	
	cbo_supplierDataStore = new Ext.data.Store({
	id: 'cbo_supplierDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_obeli&m=get_supplier_list', 
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
	
	cbo_supplierDataStore.load();
	
	rpt_obelitglstartField= new Ext.form.DateField({
		id: 'rpt_obelitglstartField',
		fieldLabel: 'Tanggal ',
		format : 'Y-m-d',
		name: 'rpt_obelitglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_obelitglendField'
	});
	
	rpt_obelitglendField= new Ext.form.DateField({
		id: 'rpt_obelitglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_obelitglendField',
        vtype: 'daterange',
        startDateField: 'rpt_obelitglstartField'
	});
	
	rpt_obelisupplierField= new Ext.form.ComboBox({
		id: 'rpt_obelisupplierField',
		fieldLabel: 'Supplier',
		//name: 'rpt_obelisupplier',
		anchor: '95%',
		store: cbo_supplierDataStore,
		mode: 'local',
		displayField: 'cbo_supplier_nama',
		valueField: 'cbo_supplier_id',
		triggerAction: 'all'
	});
	
	rpt_obelicarabayarField= new Ext.form.ComboBox({
		id: 'rpt_obelicarabayarField',
		fieldLabel: 'Cara Bayar',
		store:new Ext.data.SimpleStore({
			fields:['order_carabayar_value', 'order_carabayar_display'],
			data:[['tunai','tunai'],['kredit','kredit'],['konsinyasi','konsinyasi']]
		}),
		mode: 'local',
		displayField: 'order_carabayar_display',
		valueField: 'order_carabayar_value',
		anchor: '50%',
		triggerAction: 'all'
	});
	
	function printreport_obeli(){

		var rpt_order_supplier="";
		var rpt_order_carabayar="";
		var rpt_order_tglstart="";
		var rpt_order_tglend="";
		var win;               
		
		if(rpt_obelisupplierField.getValue()!==null){rpt_order_supplier = rpt_obelisupplierField.getValue();}
		if(rpt_obelicarabayarField.getValue()!==null){rpt_order_carabayar = rpt_obelicarabayarField.getValue();}
		if(rpt_obelitglstartField.getValue()!=''){rpt_order_tglstart = rpt_obelitglstartField.getValue().format('Y-m-d');}
		if(rpt_obelitglendField.getValue()!=''){rpt_order_tglend = rpt_obelitglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_obeli&m=printreport_obeli',
		params: {
		  	order_supplier : rpt_order_supplier,
			order_carabayar : rpt_order_carabayar,
			order_tglstart : rpt_order_tglstart, 
			order_tglend : rpt_order_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_obelilist.html','report_obelilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rpt_obelireportForm = new Ext.FormPanel({
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
				items: [rpt_obelisupplierField, rpt_obelitglstartField, rpt_obelitglendField, rpt_obelicarabayarField] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_obeli
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpt_obelireportWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_obelireportWindow = new Ext.Window({
		title: 'Report Order Pembelian',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_obelireport',
		items: rpt_obelireportForm
	});
	rpt_obelireportForm.getForm().load();
  	rpt_obelireportWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_obelireport"></div>
    </div>
</div>