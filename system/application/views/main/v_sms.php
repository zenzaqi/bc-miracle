<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: sms View
	+ Description	: For record view
	+ Filename 		: v_sms.php
 	+ creator  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
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
/* declare function */		
var sms_DataStore;
var sms_ColumnModel;
var smsListEditorGrid;
var sms_saveForm;
var sms_saveWindow;
var sms_searchForm;
var sms_searchWindow;
var sms_SelectedRow;
var sms_ContextMenu;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var today=new Date().format('Y-m-d');
/* declare variable here for Field*/
var sms_idField;
var sms_namaField;
var sms_detailField;
var sms_idSearchField;
var sms_namaSearchField;
var sms_detailSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  	Ext.form.Field.prototype.msgTarget = 'side';
	 
  	/* Function for add and edit data form, open window form */
	function sms_save(post2db){
	
		if(is_sms_form_valid()){
			var sms_pk="";
			var sms_opsi="";
			var sms_dest="";
			var sms_isi="";
			
			if(sms_detailField.getValue()!=="") sms_isi=sms_detailField.getValue();
			if(sms_semua_radioField.getValue()==true){
				sms_opsi='semua';
			}else if(sms_group_radioField.getValue()==true){
				sms_opsi='group';
				sms_dest=sms_destgroupField.getValue();
			}else if(sms_number_radioField.getValue()==true){
				sms_opsi='number';
				sms_dest=sms_destnumField.getValue();
			}else if(sms_kelamin_radioField.getValue()==true){
				sms_opsi='kelamin';
				sms_dest=sms_kelaminField.getValue();
			}else if(sms_ultah_radioField.getValue()==true){
				sms_opsi='ultah';
				sms_dest=sms_bulanlahir_startField.getValue() + '-' +sms_tgllahir_startField.getValue()+ 's/d'+sms_bulanlahir_endField.getValue() + '-' +sms_tgllahir_endField.getValue();
			}else if(sms_member_radioField.getValue()==true){
				sms_opsi='member';
				if(sms_membershipField.getValue()=='Expired'){
					sms_dest=sms_membershipField.getValue()+':'+sms_tglexp_startField.getValue().format('Y-m-d')+ 's/d'+sms_tglexp_endField.getValue().format('Y-m-d');
				}else{
					sms_dest=sms_membershipField.getValue();
				}
				
				
			}
			
			//console.log('group'+sms_number_radioField.getValue());
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_sms&m=sms_save',
				timeout: 3600000,
				params: {
					isms_opsi	: sms_opsi,
					isms_dest	: sms_dest,
					isms_isi	: sms_isi,
					isms_task	: post2db
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','SMS sukses !');
							mainPanel.remove(mainPanel.getActiveTab().getId());
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'We could\'t not '+msg+' the sms.',
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
			
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Your Form is not valid!.',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	
	}
 	/* End of Function */
  
  	
	
  	/* Function for Retrieve DataStore */
	phonegroup_DataStore = new Ext.data.Store({
		id: 'phonegroup_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_sms&m=get_phonegroup_list', 
			method: 'POST'
		}),
		baseParams:{query:'',start:0, limit: 15 }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'phonegroup_id'
		},[
		/* dataIndex => insert intophonegroup_ColumnModel, Mapping => for initiate table column */ 
			{name: 'phonegroup_id', type: 'int', mapping: 'phonegroup_id'}, 
			{name: 'phonegroup_nama', type: 'string', mapping: 'phonegroup_nama'},
			{name: 'phonegroup_detail', type: 'string', mapping: 'phonegroup_detail'},
			{name: 'phonegroup_jumlah', type: 'float', mapping: 'phonegroup_jumlah'}
		]),
		sortInfo:{field: 'phonegroup_nama', direction: "ASC"}
	});
	
	var phonegroup_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{phonegroup_nama} ({phonegroup_jumlah} orang)</b> <br/>',
			'{phonegroup_detail}</span>',
        '</div></tpl>'
    );
	
	
	/* Identify  sms_nama Field */
	var sms_destgroupField= new Ext.form.ComboBox({
		id: 'sms_destgroupField',
		fieldLabel: 'Group',
		store: phonegroup_DataStore,
		mode: 'remote',
		displayField: 'phonegroup_nama',
		valueField: 'phonegroup_id',
		loadingText: 'Searching...',
		typeAhead: false,
        pageSize: pageS,
        tpl: phonegroup_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		width: 300
	});
	/* Identify  sms_detail Field */
	
	var sms_destnumField=new Ext.form.TextArea({
		id: 'sms_destnumField',
		fieldLabel: 'Nomer (pisahkan dengan koma [,])',
		maxLength: 250,
		maskRe: /^\+|,|([0-9]+)$/,
		width: 300
	});
	
	var bulanStore=new Ext.data.SimpleStore({
		fields:['bulan_id','bulan_nama'],
		data:[['01','Januari'],['02','Pebruari'],['03','Maret'],['04','April'],['05','Mei'],['06','Juni'],['07','Juli'],['08','Agustus'],['09','September'],['10','Oktober'],['11','Nopember'],['12','Desember']]
	});
	
	var tanggalStore=new Ext.data.SimpleStore({
		fields:['tanggal'],
		data:[['01'],['02'],['03'],['04'],['05'],['06'],['07'],['08'],['09'],['10'],
			  ['11'],['12'],['13'],['14'],['15'],['16'],['17'],['18'],['19'],['20'],
			  ['21'],['22'],['23'],['24'],['25'],['26'],['27'],['28'],['29'],['30'],['31']]
	});
	
	var sms_tgllahir_startField=new Ext.form.ComboBox({
		id:	'sms_tgllahir_startField',
		name: 'sms_tgllahir_startField',
		typeAhead: true,
		triggerAction: 'all',
		store:tanggalStore,
		mode: 'local',
		width: 50,
		displayField: 'tanggal',
		valueField: 'tanggal',
		value: '01',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		bodyStyle:'padding:5px'
	});
	
	var sms_bulanlahir_startField=new Ext.form.ComboBox({
		id:	'sms_bulanlahir_startField',
		name: 'sms_bulanlahir_startField',
		typeAhead: true,
		triggerAction: 'all',
		store: bulanStore,
		mode: 'local',
		value: '01',
		width: 80,
		displayField: 'bulan_nama',
		valueField: 'bulan_id',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		bodyStyle:'padding:5px'
	});
	
	var sms_tgllahir_endField=new Ext.form.ComboBox({
		id:	'sms_tgllahir_endField',
		name: 'sms_tgllahir_endField',
		typeAhead: true,
		triggerAction: 'all',
		store: tanggalStore,
		mode: 'local',
		width: 50,
		value: '01',
		displayField: 'tanggal',
		valueField: 'tanggal',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		bodyStyle:'padding:5px'
	});
	
	var sms_tgllahir_labelField=new Ext.form.Label({
		bodyStyle:'padding:5px',
		html: '&nbsp; s/d ',
		width: 30,
		frame: false,
		border: false
	});
	
	var sms_tglexp_labelField=new Ext.form.Label({
		bodyStyle:'padding:5px',
		html: '&nbsp; s/d ',
		width: 30,
		frame: false,
		border: false
	});
	
	
	var sms_bulanlahir_endField=new Ext.form.ComboBox({
		id:	'sms_bulanlahir_endField',
		name: 'sms_bulanlahir_endField',
		typeAhead: true,
		triggerAction: 'all',
		store: bulanStore,
		mode: 'local',
		width: 80,
		value: '01',
		displayField: 'bulan_nama',
		valueField: 'bulan_id',
		lazyRender:true,
		listClass: 'x-combo-list-small'
	});
	
	var sms_ultah_groupField=new Ext.form.FieldSet({
		id:	'sms_ultah_groupField',
		name: 'sms_ultah_groupField',
		layout: 'column',
		frame: false,
		border: false,
		items:[sms_tgllahir_startField,sms_bulanlahir_startField,sms_tgllahir_labelField,sms_tgllahir_endField,sms_bulanlahir_endField]
	
	});
	
	var sms_membershipField=new Ext.form.ComboBox({
		id:	'sms_membershipField',
		name: 'sms_membershipField',
		typeAhead: true,
		triggerAction: 'all',
		store: new Ext.data.SimpleStore({
			fields:['membership'],
			data:[['Semua'],['Aktif'],['Non Aktif'],['Expired']]
		}),
		mode: 'local',
		width: 80,
		value : 'Semua',
		displayField: 'membership',
		valueField: 'membership',
		lazyRender:true,
		listClass: 'x-combo-list-small'
	});
	
	
	var sms_tglexp_startField=new Ext.form.DateField({
		id:	'sms_tglexp_startField',
		name: 'sms_tglexp_startField',
		format: 'Y-m-d',
		value: today
	});
	
	
	var sms_tglexp_endField=new Ext.form.DateField({
		id:	'sms_tglexp_endField',
		name: 'sms_tglexp_endField',
		format: 'Y-m-d',
		value: today
	});
	
	
	
	var sms_member_expField=new Ext.form.FieldSet({
		layout: 'column',
		frame: false,
		border: false,
		disabled : true,
		bodyStyle:'padding-top:5px;padding-bottom:5px;padding-left:0px',
		items: [sms_tglexp_startField,sms_tglexp_labelField,sms_tglexp_endField]
	});
	
	var sms_member_groupField=new Ext.form.FieldSet({
		id:	'sms_member_groupField',
		name: 'sms_member_groupField',
		layout: 'form',
		frame: false,
		border: false,
		items:[{
			   		layout:'column',
					frame: false,
					border: false,
					bodyStyle:'padding-top:5px;padding-bottom:5px',
					items: [sms_membershipField]
			   },
			   {
			   		layout:'column',
					frame: false,
					border: false,
					bodyStyle:'padding-top:5px;padding-bottom:5px',
					items: [sms_member_expField]
			   }]
	});
	
	
	var sms_kelaminField=new Ext.form.ComboBox({
		id:	'sms_kelaminField',
		name: 'sms_kelaminField',
		typeAhead: true,
		triggerAction: 'all',
		store: new Ext.data.SimpleStore({
			fields:['kelamin_id','kelamin_nama'],
			data:[['L','Laki-laki'],['P','Perempuan']]
		}),
		mode: 'local',
		width: 100,
		value: 'P',
		displayField: 'kelamin_nama',
		valueField: 'kelamin_id',
		lazyRender:true,
		listClass: 'x-combo-list-small'
	});
	
	function is_sms_form_valid(){
		return (sms_destgroupField.isValid() && sms_destnumField.isValid() && sms_kelaminField.isValid() && sms_membershipField.isValid() && sms_detailField.isValid());
	}
	
	
	var sms_group_radioField=new Ext.form.Radio({
		id:'sms_group_radioField',
		name:'sms_opsiField',
		width: 100,
		boxLabel: 'Phonegroup',
		value: 'selected'
	});
	
	var sms_semua_radioField=new Ext.form.Radio({
		id:'sms_semua_radioField',
		name:'sms_opsiField',
		width: 100,
		boxLabel: 'Semua Customer',
		checked: true,
		value: 'selected'
	});
	
	var sms_number_radioField=new Ext.form.Radio({
		id:'sms_number_radioField',
		name:'sms_opsiField',
		width: 100,
		boxLabel: 'Nomer <br> P',
		value: 'selected'
	});
	
	var sms_kelamin_radioField=new Ext.form.Radio({
		id:'sms_kelamin_radioField',
		name:'sms_opsiField',
		width: 100,
		boxLabel: 'Jenis Kelamin',
		value: 'selected'
	});
	
	var sms_ultah_radioField=new Ext.form.Radio({
		id:'sms_ultah_radioField',
		name:'sms_opsiField',
		width: 100,
		boxLabel: 'Ulang Tahun',
		value: 'selected'
	});
	
	var sms_member_radioField=new Ext.form.Radio({
		id:'sms_member_radioField',
		name:'sms_opsiField',
		width: 100,
		boxLabel: 'Member',
		value: 'selected'
	});

	var sms_destinationField = new Ext.form.FieldSet({
		title: 'Opsi Tujuan',
		anchor: '98%',
		layout:'form',
		frame: false,
		border: true,
		items:[{
			     	layout: 'column',
					frame: false,
					border: false,
					bodyStyle:'padding:5px',
				 	items: [sms_semua_radioField]
			   },{
			     	layout: 'column',
					frame: false,
					border: false,
					bodyStyle:'padding:5px',
				 	items: [sms_group_radioField,sms_destgroupField]
			   },{
					layout: 'column',
					frame: false,
					border: false,
					bodyStyle:'padding:5px',
					items: [sms_number_radioField,sms_destnumField]
			   },{
				   	layout: 'column',
					frame: false,
					border: false,
					bodyStyle:'padding:5px',
					items: [sms_kelamin_radioField,sms_kelaminField]
			   },{
				   	layout: 'column',
					frame: false,
					border: false,
					bodyStyle:'padding:5px',
					items: [sms_ultah_radioField,sms_ultah_groupField]
			   },{
				   	layout: 'column',
					frame: false,
					border: false,
					bodyStyle:'padding:5px',
					items: [sms_member_radioField,sms_member_groupField]
			   }]
	});
	
	sms_detailField= new Ext.form.TextArea({
		id: 'sms_detailField',
		fieldLabel: 'Isi Pesan',
		maxLength: 500,
		bodyStyle:'padding:5px',
		anchor: '95%',
		allowBlank: false
	});

	
	
	/* Function for retrieve create Window Panel*/ 
	sms_saveForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 500,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [sms_destinationField, sms_detailField] 
			}
			],
		buttons: [{
				text: 'Send',
				handler: function(){ sms_save('send'); }
			},{
				text: 'Draft',
				handler: function(){ sms_save('draft'); }
			}
			,{
				text: 'Cancel',
				handler: function(){
					mainPanel.remove(mainPanel.getActiveTab().getId());
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	sms_saveWindow= new Ext.Window({
		id: 'sms_saveWindow',
		title: 'New SMS',
		closable:false,
		closeAction: 'close',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_sms_save',
		items: sms_saveForm
	});
	/* End Window */
	

	sms_saveWindow.show();
	
	function setDisableAll(){
		sms_destgroupField.setDisabled(true);
		sms_destnumField.setDisabled(true);
		sms_kelaminField.setDisabled(true);
		sms_ultah_groupField.setDisabled(true);
		sms_membershipField.setDisabled(true);
		sms_member_expField.setDisabled(true);
		
		sms_destgroupField.allowBlank=true;
		sms_destnumField.allowBlank=true;
		sms_kelaminField.allowBlank=true;
		sms_membershipField.allowBlank=true;
	}
	
	setDisableAll();
	
	sms_membershipField.on("select",function(){
		if(sms_membershipField.getValue()=='Expired'){
			sms_member_expField.setDisabled(false);
		}else{
			sms_member_expField.setDisabled(true);
		}
	});
	
	sms_group_radioField.on("check",function(){
		if(sms_group_radioField.getValue()==true){
			setDisableAll();
			sms_destgroupField.setDisabled(false);
			sms_destgroupField.allowBlank=false;
		}		
	});
	
	sms_number_radioField.on("check",function(){
	 	if(sms_number_radioField.getValue()==true){
			setDisableAll();
			sms_destnumField.setDisabled(false);
			sms_destnumField.allowBlank=false;
	 	}
	});
	
	sms_kelamin_radioField.on("check",function(){
		if(sms_kelamin_radioField.getValue()==true){
			setDisableAll();
			sms_kelaminField.setDisabled(false);
			sms_kelaminField.allowBlank=false;
		}
	});
	
	sms_ultah_radioField.on("check",function(){
		if(sms_ultah_radioField.getValue()==true){
			setDisableAll();
			sms_ultah_groupField.setDisabled(false);
		}
	});
	
	sms_member_radioField.on("check",function(){
		if(sms_member_radioField.getValue()==true){
			setDisableAll();
			sms_membershipField.setDisabled(false);
			sms_membershipField.allowBlank=false;
		}
	});
	
	
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_sms"></div>
		<div id="elwindow_sms_save"></div>
    </div>
</div>
</body>