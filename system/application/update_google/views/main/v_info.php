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
/* declare function */		
var info_createForm;
var info_createWindow;

Ext.onReady(function(){
  Ext.QuickTips.init();
  	
   function is_infoFormValid(){
		return true;
	}
	
	info_idField= new Ext.form.NumberField({
		id: 'info_idField',
		name: 'info_id',
		hidden: true
	});
	
	 	
	/* Function for retrieve Add Window Panel*/
	info_createForm = new Ext.FormPanel({
		url: 'index.php?c=c_info&m=get_detail_info',
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 400,
		reader: new Ext.data.JsonReader({
			root: 'results',
			id: 'info_id'
		},[
			{name: 'info_id', type: 'int', mapping: 'info_id'},
			{name: 'info_nama', type: 'string', mapping: 'info_nama'},
			{name: 'info_alamat', type: 'string', mapping: 'info_alamat'},
			{name: 'info_notelp', type: 'string', mapping: 'info_notelp'},
			{name: 'info_nofax', type: 'string', mapping: 'info_nofax'},
			{name: 'info_email', type: 'string', mapping: 'info_email'},
			{name: 'info_website', type: 'string', mapping: 'info_website'},
			{name: 'info_slogan', type: 'string', mapping: 'info_slogan'},
			{name: 'info_logo', type: 'string', mapping: 'info_logo'},
			{name: 'info_icon', type: 'string', mapping: 'info_icon'},
			{name: 'info_background', type: 'string', mapping: 'info_background'},
			{name: 'info_theme', type: 'string', mapping: 'info_theme'}
		]),
		items: [{
			layout:'column',
			border:false,
			items:[{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [
				{
					xtype: 'textfield',
					readOnly: true,
					id: 'info_namaField',
					fieldLabel: 'Nama',
					name: 'info_nama',
					maxLength: 150,
					allowBlank: false,
					anchor: '95%'
				},
				{
					xtype: 'textfield',
					readOnly: true,
					id: 'info_alamatField',
					fieldLabel: 'Alamat',
					name: 'info_alamat',
					maxLength: 250,
					allowBlank: false,
					anchor: '95%'
				},
				{
					xtype: 'textfield',
					id: 'info_notelpField',
					fieldLabel: 'No.Telp',
					name: 'info_notelp',
					maxLength: 50,
					anchor: '95%'
				},
				{
					xtype: 'textfield',
					id: 'info_nofaxField',
					fieldLabel: 'No.Fax',
					name: 'info_nofax',
					maxLength: 50,
					anchor: '95%'
				},
				{
					xtype: 'textfield',
					id: 'info_emailField',
					fieldLabel: 'Email',
					name: 'info_email',
					maxLength: 65,
					anchor: '95%'
				},
				{
					xtype: 'textfield',
					id: 'info_websiteField',
					fieldLabel: 'Website',
					name: 'info_website',
					maxLength: 65,
					anchor: '95%'
				},
				{
					xtype: 'textfield',
					id: 'info_sloganField',
					fieldLabel: 'Slogan',
					name: 'info_slogan',
					maxLength: 250,
					anchor: '95%'
				},
				info_idField
				]
			}]
		}],
		buttons: [{
				text: 'Save and Close',
				handler: function(){
					if(info_createForm.getForm().isValid()){
					   info_createForm.getForm().submit({
							url: 'index.php?c=c_info&m=info_update',
							waitMsg: 'Info Updating...!',
							success: function(){
								Ext.Msg.show({
										title:'OK',
										msg: 'Update Info Sukses...!',
										buttons: Ext.Msg.OK,
										fn: function(btn, text){
											mainPanel.remove(mainPanel.getActiveTab().getId());
										}
									});
							},
							failure: function(){
								//var result=response.responseText;
								Ext.MessageBox.show({
											   title: 'Error',
											   msg: 'Could not connect to the database. retry later. Error: ',
											   buttons: Ext.MessageBox.OK,
											   animEl: 'database',
											   icon: Ext.MessageBox.ERROR
								});	
							}        
						});
					}
				}
			},{
				text: 'Cancel',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				info_createWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
	});
	/* End Function*/
	
	/* Function for retrieve Add Window Form */
	info_createWindow= new Ext.Window({
		id: 'info_createWindow',
		title: 'Update Info Setting',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_info_create',
		items: info_createForm
	});
	/* End Window ADD Data Baru */
	/* End Function Advanced Search */
	//info_idField.getEl().up('.x-form-item').setDisplayed(false);
	
	info_createForm.getForm().load();
  	info_createWindow.show();

});

	</script>
<body>
<div>
	<div class="col">
        <div id="fp_info"></div>
		<div id="elwindow_info_create"></div>
    </div>
</div>
</body>