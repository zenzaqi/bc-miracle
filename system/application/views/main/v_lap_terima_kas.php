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
</head>
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

var rpt_terimakasWindow;
var rpt_terimakasForm;

var rpt_terimakas_tglawalField;
var rpt_terimakas_tglakhirField;
var rpt_terimakas_rekapField;
var rpt_terimakas_detailField;
var rpt_terimakas_bulanField;
var rpt_terimakas_tahunField;
var rpt_terimakas_opsitglField;
var rpt_terimakas_opsiblnField;
var rpt_terimakas_opsiallField;
var rpt_terimakas_groupField;

var today=new Date().format('Y-m-d');
var yesterday=new Date().add(Date.DAY, -1).format('Y-m-d');
var thismonth=new Date().format('m');
var thisyear=new Date().format('Y');
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
<?
$tahun="[";
for($i=(date('Y')-4);$i<=date('Y');$i++){
	$tahun.="['$i'],";
}
$tahun=substr($tahun,0,strlen($tahun)-1);
$tahun.="]";
$bulan="";
?>
Ext.onReady(function(){
  Ext.QuickTips.init();

	var group_master_Store= new Ext.data.SimpleStore({
			id: 'group_master_Store',
			fields:['group'],
			data:[['No Faktur'],['Tanggal'],['Customer']]
	});
	
	var group_detail_Store= new Ext.data.SimpleStore({
			id: 'group_detail_Store',
			fields:['group'],
			data:[['No Faktur'],['Tanggal'],['Customer'],['Produk'],['Sales'],['Jenis Diskon']]
	});
	
	var rpt_terimakas_groupField=new Ext.form.ComboBox({
		id:'rpt_terimakas_groupField',
		fieldLabel:'Kelompokkan',
		store: group_master_Store,
		mode: 'local',
		displayField: 'group',
		valueField: 'group',
		value: 'No Faktur',
		width: 100,
		triggerAction: 'all',
		typeAhead: true,
		lazyRender: true
	});
	
	rpt_terimakas_bulanField=new Ext.form.ComboBox({
		id:'rpt_terimakas_bulanField',
		fieldLabel:' ',
		store:new Ext.data.SimpleStore({
			fields:['value', 'display'],
			data:[['01','Januari'],['02','Pebruari'],['03','Maret'],['04','April'],['05','Mei'],['06','Juni'],['07','Juli'],['08','Agustus'],['09','September'],['10','Oktober'],['11','Nopember'],['12','Desember']]
		}),
		mode: 'local',
		displayField: 'display',
		valueField: 'value',
		value: thismonth,
		width: 100,
		triggerAction: 'all'
	});
	
	rpt_terimakas_tahunField=new Ext.form.ComboBox({
		id:'rpt_terimakas_tahunField',
		fieldLabel:' ',
		store:new Ext.data.SimpleStore({
			fields:['tahun'],
			data: <?php echo $tahun; ?>
		}),
		mode: 'local',
		displayField: 'tahun',
		valueField: 'tahun',
		value: thisyear,
		width: 100,
		triggerAction: 'all'
	});
	
	rpt_terimakas_opsitglField=new Ext.form.Radio({
		id:'rpt_terimakas_opsitglField',
		boxLabel:'Tanggal',
		width:100,
		name: 'filter_opsi'
	});
	
	rpt_terimakas_opsiblnField=new Ext.form.Radio({
		id:'rpt_terimakas_opsiblnField',
		boxLabel:'Bulan',
		width:100,
		name: 'filter_opsi',
		checked: true
	});
	
	rpt_terimakas_opsiallField=new Ext.form.Radio({
		id:'rpt_terimakas_opsiallField',
		boxLabel:'Semua',
		name: 'filter_opsi',
		checked: true
	});
	
	rpt_terimakas_tglawalField= new Ext.form.DateField({
		id: 'rpt_terimakas_tglawalField',
		fieldLabel: ' ',
		format : 'Y-m-d',
		name: 'rpt_terimakas_tglawalField',
        vtype: 'daterange',
		allowBlank: true,
		width: 100,
        endDateField: 'rpt_terimakas_tglakhirField'
	});
	
	rpt_terimakas_tglakhirField= new Ext.form.DateField({
		id: 'rpt_terimakas_tglakhirField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'rpt_terimakas_tglakhirField',
        vtype: 'daterange',
		allowBlank: true,
		width: 100,
        startDateField: 'rpt_terimakas_tglawalField',
		value: today
	});
	
	rpt_terimakas_rekapField=new Ext.form.Radio({
		id: 'rpt_terimakas_rekapField',
		boxLabel: 'Rekap',
		name: 'terimakas_opsi',
		checked: true
	});
	
	rpt_terimakas_detailField=new Ext.form.Radio({
		id: 'rpt_terimakas_detailField',
		boxLabel: 'Detail',
		name: 'terimakas_opsi'
	});
	
	var rpt_terimakas_periodeField=new Ext.form.FieldSet({
		id:'rpt_terimakas_periodeField',
		title : 'Periode',
		layout: 'form',
		bodyStyle:'padding: 0px 0px 0',
		frame: false,
		bolder: false,
		anchor: '98%',
		items:[{
				layout: 'column',
				border: false,
				items:[rpt_terimakas_opsitglField, {
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							items:[rpt_terimakas_tglawalField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[rpt_terimakas_tglakhirField]
					   }]
			},{
				layout: 'column',
				border: false,
				items:[rpt_terimakas_opsiblnField,{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							items:[rpt_terimakas_bulanField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[rpt_terimakas_tahunField]
					   }]
			}]
	});
	
	var	rpt_terimakas_opsiField=new Ext.form.FieldSet({
		id: 'rpt_terimakas_opsiField',
		title: 'Opsi',
		border: true,
		anchor: '98%',
		items: [rpt_terimakas_rekapField ,rpt_terimakas_detailField]
	});
	
	var	rpt_terimakas_groupbyField=new Ext.form.FieldSet({
		id: 'rpt_terimakas_groupbyField',
		title: 'Group By',
		border: true,
		anchor: '98%',
		items: [rpt_terimakas_groupField]
	});
	
	function is_valid_form(){
		if(rpt_terimakas_opsitglField.getValue()==true){
			rpt_terimakas_tglawalField.allowBlank=false;
			rpt_terimakas_tglakhirField.allowBlank=false;
			if(rpt_terimakas_tglawalField.isValid() && rpt_terimakas_tglakhirField.isValid())
				return true;
			else
				return false;
		}else{
			rpt_terimakas_tglawalField.allowBlank=true;
			rpt_terimakas_tglakhirField.allowBlank=true;
			return true;
		}
	}
	
	/* Function for print List Grid */
	function print_rpt_terimakas(){
		
		var terimakas_tglawal="";
		var terimakas_tglakhir="";
		var terimakas_opsi="";
		var terimakas_bulan="";
		var terimakas_tahun="";
		var terimakas_periode="";
		var terimakas_group="";
		
		var win;               
		if(is_valid_form()){
			
		if(rpt_terimakas_tglawalField.getValue()!==""){terimakas_tglawal = rpt_terimakas_tglawalField.getValue().format('Y-m-d');}
		if(rpt_terimakas_tglakhirField.getValue()!==""){terimakas_tglakhir = rpt_terimakas_tglakhirField.getValue().format('Y-m-d');}
		if(rpt_terimakas_bulanField.getValue()!==""){terimakas_bulan=rpt_terimakas_bulanField.getValue(); }
		if(rpt_terimakas_tahunField.getValue()!==""){terimakas_tahun=rpt_terimakas_tahunField.getValue(); }
		if(rpt_terimakas_opsitglField.getValue()==true){
			terimakas_periode='tanggal';
		}else if(rpt_terimakas_opsiblnField.getValue()==true){
			terimakas_periode='bulan';
		}else{
			terimakas_periode='all';
		}
		if(rpt_terimakas_groupField.getValue()!==""){terimakas_group=rpt_terimakas_groupField.getValue(); }
		
		//if(rpt_terimakas_rekapField.getValue()==true){terimakas_opsi='rekap';}else{terimakas_opsi='detail';}
		
			Ext.Ajax.request({   
				waitMsg: 'Please Wait...',
				url: 'index.php?c=c_lap_terima_kas&m=print_laporan',
				params: {
					tgl_awal	: terimakas_tglawal,
					tgl_akhir	: terimakas_tglakhir,
					/*opsi		: terimakas_opsi,*/
					bulan		: terimakas_bulan,
					tahun		: terimakas_tahun,
					periode		: terimakas_periode
					
				}, 
				success: function(response){              
					var result=eval(response.responseText);
					switch(result){
					case 1:
						win = window.open('./print/report_terimakas.html','report_terimakas','height=400,width=800,resizable=1,scrollbars=1, menubar=1');
						//win.print();
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
		}else{
			Ext.MessageBox.show({
			   title: 'Warning',
			   msg: 'Not valid form.',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.WARNING
			});	
		}
	}
	/* Enf Function */
	
	rpt_terimakasForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		x:0,
		y:0,
		width: 400, 
		autoHeight: true,
		items: [rpt_terimakas_periodeField],
		monitorValid:true,
		buttons: [{
				text: 'Print',
				formBind: true,
				handler: print_rpt_terimakas
			},{
				text: 'Close',
				handler: function(){
					rpt_terimakasWindow.hide();
					mainPanel.remove(mainPanel.getActiveTab().getId());
				}
		}]
		
	});
	
	/* Form Advanced Search */
	rpt_terimakasWindow = new Ext.Window({
		title: 'Laporan Penerimaan Kas',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rpt_terimakas',
		items: rpt_terimakasForm
	});
  	rpt_terimakasWindow.show();
	
	//EVENTS
	
	/*rpt_terimakas_rekapField.on("check", function(){
		rpt_terimakas_groupField.setValue('No faktur');
		if(rpt_terimakas_rekapField.getValue()==true){
			rpt_terimakas_groupField.bindStore(group_master_Store);
		}else
		{
			rpt_terimakas_groupField.bindStore(group_detail_Store);
		}
	});
	
	rpt_terimakas_detailField.on("check", function(){
		rpt_terimakas_groupField.setValue('No Faktur');
		if(rpt_terimakas_detailField.getValue()==true){
			rpt_terimakas_groupField.bindStore(group_detail_Store);
		}else
		{
			rpt_terimakas_groupField.bindStore(group_master_Store);
		}
	});*/
	
	/*rpt_terimakas_opsitglField.on("check",function(){
		if(rpt_terimakas_opsitglField.getValue()==true){
			rpt_terimakas_tglawalField.allowBlank=false;
			rpt_terimakas_tglakhirField.allowBlank=false;
		}else{
			rpt_terimakas_tglawalField.allowBlank=true;
			rpt_terimakas_tglakhirField.allowBlank=true;
		}
		
	});*/
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_info"></div>
		<div id="elwindow_rpt_terimakas"></div>
    </div>
</div>
</body>