<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Report Penerimaan Pembelian
	+ Description	: For record view
	+ Filename 		: V_report_mutasi.php
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

var mutasiWindow;
var mutasiForm;

/* declare variable here */

var rpt_mutasitglstartField;
var rpt_mutasitglendField;
var rpt_mutasitujuanField;
var rpt_mutasiasalField;

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
	
	cbo_mutasi_gudangDataStore = new Ext.data.Store({
	id: 'cbo_mutasi_gudangDataStore',
	proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_mutasi&m=get_gudang_list', 
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
	
	rpt_mutasiasalField= new Ext.form.ComboBox({
		id: 'rpt_mutasiasalField',
		fieldLabel: 'Gudang Asal',
		anchor: '95%',
		store: cbo_mutasi_gudangDataStore,
		mode: 'remote',
		displayField: 'cbo_gudang_diplay',
		valueField: 'cbo_gudang_value',
		triggerAction: 'all'
	});
	
	rpt_mutasitujuanField= new Ext.form.ComboBox({
		id: 'rpt_mutasitujuanField',
		fieldLabel: 'Gudang Tujuan',
		anchor: '95%',
		store: cbo_mutasi_gudangDataStore,
		mode: 'remote',
		displayField: 'cbo_gudang_diplay',
		valueField: 'cbo_gudang_value',
		triggerAction: 'all'
	});
	
	rpt_mutasitglstartField= new Ext.form.DateField({
		id: 'rpt_mutasitglstartField',
		fieldLabel: 'Mulai',
		format : 'Y-m-d',
		name: 'rpt_mutasitglstartField',
        vtype: 'daterange',
        endDateField: 'rpt_mutasitglendField'
	});
	
	rpt_mutasitglendField= new Ext.form.DateField({
		id: 'rpt_mutasitglendField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_mutasitglendField',
        vtype: 'daterange',
        startDateField: 'rpt_mutasitglstartField'
	});
	
	rpt_mutasi_tglGroup = new Ext.form.FieldSet({
		title: 'Tanggal Penerimaan Pembelian',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_mutasitglstartField] 
			},
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [rpt_mutasitglendField] 
			}
			]
	});
	
	function printreport_mutasi(){

		var rpt_mutasi_asal="";
		var rpt_mutasi_tujuan="";
		var rpt_mutasi_tglstart="";
		var rpt_mutasi_tglend="";
		var win;               
		
		if(rpt_mutasiasalField.getValue()!=""){rpt_mutasi_asal = rpt_mutasiasalField.getValue();}
		if(rpt_mutasitujuanField.getValue()!=""){rpt_mutasi_tujuan = rpt_mutasitujuanField.getValue();}
		if(rpt_mutasitglstartField.getValue()!=''){rpt_mutasi_tglstart = rpt_mutasitglstartField.getValue().format('Y-m-d');}
		if(rpt_mutasitglendField.getValue()!=''){rpt_mutasi_tglend = rpt_mutasitglendField.getValue().format('Y-m-d');}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_mutasi&m=printreport_mutasi',
		params: {
		  	mutasi_asal : rpt_mutasi_asal,
			mutasi_tujuan : rpt_mutasi_tujuan,
			mutasi_tglstart : rpt_mutasi_tglstart, 
			mutasi_tglend : rpt_mutasi_tglend
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./report_mutasilist.html','report_mutasilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	
	
	rpt_mutasireportForm = new Ext.FormPanel({
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
				items: [rpt_mutasiasalField, rpt_mutasitujuanField, rpt_mutasi_tglGroup] 
			}]
		}],
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: printreport_mutasi
			},{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				rpt_mutasireportWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_mutasireportWindow = new Ext.Window({
		title: 'Report Order Pembelian',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_mutasireport',
		items: rpt_mutasireportForm
	});
	rpt_mutasireportForm.getForm().load();
  	rpt_mutasireportWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_rpt_mutasireport"></div>
    </div>
</div>