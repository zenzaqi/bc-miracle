<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: info View
	+ Description	: For record view
	+ Filename 		: v_info.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 14/Jul/2009 15:33:36
	
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
</head>
<script>

var rpt_jrpdukWindow;
var rpt_jrpdukForm;

/* declare variable here */
var rpt_jproduk_tglawalField;
var rpt_jproduk_tglakhirField;
var rpt_jproduk_rekapField;
var rpt_jproduk_detailField;
var today=new Date().format('Y-m-d');

<?
$idForm=24;
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

	rpt_jproduk_tglawalField= new Ext.form.DateField({
		id: 'rpt_jproduk_tglawalField',
		fieldLabel: 'Tanggal ',
		format : 'Y-m-d',
		name: 'rpt_jproduk_tglawalField',
        vtype: 'daterange',
		allowBlank: false,
        endDateField: 'rpt_jproduk_tglakhirField'
	});
	
	rpt_jproduk_tglakhirField= new Ext.form.DateField({
		id: 'rpt_jproduk_tglakhirField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_kegiatantglendField',
        vtype: 'daterange',
		allowBlank: false,
        startDateField: 'rpt_jproduk_tglawalField',
		value: today
	});
	
	rpt_jproduk_rekapField=new Ext.form.Radio({
		id: 'rpt_jproduk_rekapField',
		boxLabel: 'Rekap',
		name: 'jproduk_opsi',
		checked: true
	});
	
	rpt_jproduk_detailField=new Ext.form.Radio({
		id: 'rpt_jproduk_detailField',
		boxLabel: 'Detail',
		name: 'jproduk_opsi'
	});
	
	var rpt_jproduk_tanggalField=new Ext.form.FieldSet({
		id:'rpt_jproduk_tanggalField',
		title : 'Tanggal',
		layout: 'column',
		bodyStyle:'padding: 0px 0px 0',
		frame: false,
		bolder: false,
		anchor: '98%',
		items:[
			   {
				   columnWidth: 0.6,
				   border: false,
				   layout: 'form',
				   items:[rpt_jproduk_tglawalField]
				},
				{
				   columnWidth: 0.4,
				   border: false,
				   layout: 'form',
				   labelWidth:30,
				   items:[rpt_jproduk_tglakhirField]
				},
		]
	});
	
	var	rpt_jproduk_opsiField=new Ext.form.FieldSet({
		id: 'rpt_jproduk_opsiField',
		title: 'Opsi',
		border: true,
		anchor: '98%',
		items: [rpt_jproduk_rekapField ,rpt_jproduk_detailField]
	});
	
	/* Function for print List Grid */
	function print_rpt_jproduk(){
		var jproduk_tglawal="";
		var jproduk_tglakhir="";
		var jrpdouk_opsi="";
		
		var win;               // our popup window
		// check if we do have some search data...
		if(rpt_jproduk_tglawalField.getValue()!==""){jproduk_tglawal = rpt_jproduk_tglawalField.getValue().format('Y-m-d');}
		if(rpt_jproduk_tglakhirField.getValue()!==""){jproduk_tglakhir = rpt_jproduk_tglakhirField.getValue().format('Y-m-d');}
		if(rpt_jproduk_rekapField.getValue()==true){jproduk_opsi='rekap';}else{jproduk_opsi='detail'}
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_master_jual_produk&m=print_laporan',
		params: {
		  	tgl_awal	: jproduk_tglawal,
			tgl_akhir	: jproduk_tglakhir,
			opsi		: jproduk_opsi
		  	
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./print/report_jproduk.html','report_jproduk','height=400,width=800,resizable=1,scrollbars=1, menubar=1');
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
	
	rpt_jrpdukForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		x:0,
		y:0,
		width: 400, 
		autoHeight: true,
		items: [rpt_jproduk_tanggalField,rpt_jproduk_opsiField],
		monitorValid:true,
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: print_rpt_jproduk
			},{
				text: 'Close',
				handler: function(){
					rpt_jprodukWindow.hide();
					mainPanel.remove(mainPanel.getActiveTab().getId());
				}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_jprodukWindow = new Ext.Window({
		title: 'Laporan Penjualan Produk',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_jproduk',
		items: rpt_jrpdukForm
	});
  	rpt_jprodukWindow.show();
  	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_info"></div>
		<div id="elwindow_rpt_jproduk"></div>
    </div>
</div>
</body>