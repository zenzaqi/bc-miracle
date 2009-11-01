<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_kstok.php
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

var kstokWindow;
var kstokForm;

/* declare variable here */

var rpt_kstoktglstartField;
var rpt_kstoktglendField;
var rpt_kstokgudangField;

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
	
	cbo_kstok_gudangDataStore = new Ext.data.Store({
	id: 'cbo_kstok_gudangDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_kstok&m=get_gudang_list', 
			method: 'POST'
		}),
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'gudang_id'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column */ 
			{name: 'cbo_gudang_value', type: 'int', mapping: 'gudang_id'},
			{name: 'cbo_gudang_diplay', type: 'string', mapping: 'gudang_nama'}
		]),
	sortInfo:{field: 'cbo_gudang_diplay', direction: "ASC"}
	});
	
	rpt_kstokgudangField= new Ext.form.ComboBox({
		id: 'rpt_kstokgudangField',
		fieldLabel: 'Gudang',
		anchor: '95%',
		store: cbo_kstok_gudangDataStore,
		mode: 'remote',
		displayField: 'cbo_gudang_diplay',
		valueField: 'cbo_gudang_value',
		triggerAction: 'all'
	});
	
	rpt_kstoktglstartField= new Ext.form.DateField({
		id: 'rpt_kstoktglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_kstoktglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_kstoktglendField'
	});
	
	rpt_kstoktglendField= new Ext.form.DateField({
		id: 'rpt_kstoktglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_kstoktglendField',
        vtype: 'daterange',
        startDateField: 'rpt_kstoktglstartField'
	});
	
	rpt_kstok_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Koreksi Stok',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_kstoktglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_kstoktglendField] 
			}
			]
	});
	
	function printreport_kstok(){

		var rpt_kstok_gudang="";
		var rpt_kstok_tglstart="";
		var rpt_kstok_tglend="";
		var win;               
		
		if(rpt_kstokgudangField.getValue()!=""){rpt_kstok_gudang = rpt_kstokgudangField.getValue();}
		if(rpt_kstoktglstartField.getValue()!=''){rpt_kstok_tglstart = rpt_kstoktglstartField.getValue().format('Y-m-d');}
		if(rpt_kstoktglendField.getValue()!=''){rpt_kstok_tglend = rpt_kstoktglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_kstok&m=printreport_kstok',
		params: {
			kstok_gudang : rpt_kstok_gudang,
			kstok_tglstart : rpt_kstok_tglstart, 
			kstok_tglend : rpt_kstok_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_kstoklist.html','report_kstoklist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rpt_kstokreportForm = new Ext.FormPanel({
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
				items: [rpt_kstokgudangField, rpt_kstok_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_kstok
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpt_kstokreportWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_kstokreportWindow = new Ext.Window({
		title: 'Report Order Pembelian',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_kstokreport',
		items: rpt_kstokreportForm
	});
	rpt_kstokreportForm.getForm().load();
  	rpt_kstokreportWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_kstokreport"></div>
    </div>
</div>