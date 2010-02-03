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
			var sms_nomer="";
			var sms_group="";
			var sms_isi="";
			var sms_opsi="";
			
			if(sms_destnumField.getValue()!=="") sms_nomer=sms_destnumField.getValue();
			if(sms_destgroupField.getValue()!=="") sms_group=sms_destgroupField.getValue();
			if(sms_detailField.getValue()!=="") sms_isi=sms_detailField.getValue();
			if(phonegroup_filterField.getValue()!=="") sms_opsi=phonegroup_filterField.getValue();
			
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_sms&m=sms_save',
				params: {
					isms_nomer	: sms_nomer,
					isms_group	: sms_group,
					isms_isi	: sms_isi,
					isms_opsi	: sms_opsi,
					isms_task	: post2db
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','The sms was '+post2db+' successfully.');
							//sms_saveWindow.close();
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
	
	var phonegroup_filterField= new Ext.form.ComboBox({
		id: 'phonegroup_filterField',
		fieldLabel: '',
		store:new Ext.data.SimpleStore({
			fields:['pilih'],
			data:[['Number'],['Group']]
		}),
		mode: 'local',
		displayField: 'pilih',
		valueField: 'pilih',
		width: 94,
		triggerAction: 'all'		
	});
	

	
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
		anchor: '95%'
	});
	/* Identify  sms_detail Field */
	
	var sms_destnumField=new Ext.form.TextArea({
		id: 'sms_destnumField',
		fieldLabel: 'Nomer (pisahkan dengan koma [,])',
		maxLength: 250,
		anchor: '95%'
	});
	
	function is_sms_form_valid(){
		if(phonegroup_filterField.getValue()=='Group'){
			if(sms_destgroupField.getValue()=="")
				return false;
			else
				return true;
		}else{
			if(sms_destnumField.getValue()=="")
				return false;
			else
				return true;
		}
	}
	
	var sms_destinationField = new Ext.form.FieldSet({
		title: 'Tujuan',
		anchor: '95%',
		layout:'column',
		items:[{
				   layout: 'form',
				   labelWidth: 5,
				   columnWidth: 0.3,
				   border: false,
				   items:[phonegroup_filterField]
			   },{
				   layout: 'form',
				   columnWidth: 0.7,
				   border: false,
				   items:[sms_destgroupField,sms_destnumField]
			   }]
	});
		
	sms_detailField= new Ext.form.TextArea({
		id: 'sms_detailField',
		fieldLabel: 'Isi',
		maxLength: 500,
		anchor: '95%'
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
	phonegroup_filterField.setValue('Group');
	sms_destnumField.getEl().up('.x-form-item').setDisplayed(false);
	
	phonegroup_filterField.on('select',function(){
		if(phonegroup_filterField.getValue()=='Group'){
			sms_destgroupField.getEl().up('.x-form-item').setDisplayed(true);
			sms_destnumField.getEl().up('.x-form-item').setDisplayed(false);
		}else{
			sms_destgroupField.getEl().up('.x-form-item').setDisplayed(false);
			sms_destnumField.getEl().up('.x-form-item').setDisplayed(true);
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