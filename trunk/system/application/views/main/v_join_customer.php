<?php
/* 	
	+ Module  		: join_customer View
	+ Description	: For record view
	+ Filename 		: v_join_customer.php
 	+ creator  		: Fred
	
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
var joincustomer_saveForm;
var joincustomer_saveWindow;
var joincustomer_customer_tujuan_Field;
var joincustomer_customer_awal_Field;


//declare konstant
var post2db = 'UPDATE';
var msg = '';
var pageS=15;

/* declare variable here for Field*/

var today=new Date().format('Y-m-d');
var yesterday=new Date().add(Date.DAY, -1).format('Y-m-d');
var thismonth=new Date().format('m');
var thisyear=new Date().format('Y');

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


/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  	/* Function for add and edit data form, open window form */
	function join_customer_save(){
	
		if(is_joincustomer_form_valid()){	
			var cust_asal_id_field = null;
			var cust_tujuan_id_field = null;
			//var iklantoday_id_field_pk=null;
			
			if(joincustomer_customer_tujuan_Field.getValue()!==null){cust_tujuan_id_field=joincustomer_customer_tujuan_Field.getValue();}
			if(joincustomer_customer_awal_Field.getValue()!==null){cust_asal_id_field=joincustomer_customer_awal_Field.getValue();}
							
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_join_customer&m=get_action',
				params: {
					//iklantoday_id				: iklantoday_id_field_pk,
					cust_asal_id				: cust_asal_id_field,
					cust_tujuan_id				: cust_tujuan_id_field,
					task						: post2db
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','Penggabungan Customer berhasil dilakukan.');
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'Penggabungan Customer tidak dapat dilakukan',
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
    
	/* Function for Check if the form is valid */
	function is_joincustomer_form_valid(){
		return (true &&  joincustomer_customer_awal_Field.isValid() && joincustomer_customer_tujuan_Field.isValid() && true);
	}
  	/* End of Function */
  
    
	//ComboBox ambil data Customer
	cbo_joincustomer_customerDataStore = new Ext.data.Store({
		id: 'cbo_joincustomer_customerDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_join_customer&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit:pageS }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'cust_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'cust_id', type: 'int', mapping: 'cust_id'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'cust_no', direction: "ASC"}
	});
	//Template yang akan tampil di ComboBox
	var joincustomer_customer_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	cbo_joincustomer_customerDataStore2 = new Ext.data.Store({
		id: 'cbo_joincustomer_customerDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_join_customer&m=get_customer_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit:pageS }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'cust_id'
		},[
		/* dataIndex => insert intocustomer_note_ColumnModel, Mapping => for initiate table column */ 
			{name: 'cust_id', type: 'int', mapping: 'cust_id'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_tgllahir', type: 'date', dateFormat: 'Y-m-d', mapping: 'cust_tgllahir'},
			{name: 'cust_alamat', type: 'string', mapping: 'cust_alamat'},
			{name: 'cust_telprumah', type: 'string', mapping: 'cust_telprumah'}
		]),
		sortInfo:{field: 'cust_no', direction: "ASC"}
	});
	//Template yang akan tampil di ComboBox
	var joincustomer_customer_tpl2 = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{cust_no} : {cust_nama}</b> | Tgl-Lahir:{cust_tgllahir:date("M j, Y")}<br /></span>',
            'Alamat: {cust_alamat}&nbsp;&nbsp;&nbsp;[Telp. {cust_telprumah}]',
        '</div></tpl>'
    );
	
	joincustomer_keteranganField=new Ext.form.Label({ html: '<br><br> *Customer asal yang telah digabungkan akan diubah menjadi "Tidak Aktif"'});
	
	joincustomer_customer_awal_Field = new Ext.form.ComboBox({
		fieldLabel: 'Customer yang akan digabungkan',
		store: cbo_joincustomer_customerDataStore,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: joincustomer_customer_tpl,
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		disabled:false,
		anchor: '90%'
	});
	
	
	joincustomer_customer_tujuan_Field = new Ext.form.ComboBox({
		fieldLabel: 'Customer tujuan',
		store: cbo_joincustomer_customerDataStore2,
		mode: 'remote',
		displayField:'cust_nama',
		valueField: 'cust_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: joincustomer_customer_tpl2,
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		disabled:false,
		anchor: '90%'
	});
	
	
	/* Function for retrieve create Window Panel*/ 
	joincustomer_saveForm = new Ext.FormPanel({
		url: 'index.php?c=c_join_customer&m=get_action',
		baseParams:{task: "LIST", start: 0, limit: 1},
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'iklantoday_id'
		},[
		/* dataIndex => insert intoiklan_today_ColumnModel, Mapping => for initiate table column */ 
			{name: 'iklantoday_id', type: 'int', mapping: 'iklantoday_id'}	
		]),
		labelAlign: 'left',
		labelWidth: 250,
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 500,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [joincustomer_customer_awal_Field, joincustomer_customer_tujuan_Field, joincustomer_keteranganField] 
			}
			],
		buttons: [{
				text: 'Gabungkan',
				handler : join_customer_confirm_save
				/*handler: function(){
					join_customer_save();
					mainPanel.remove(mainPanel.getActiveTab().getId());
				}*/
			}
			,{
				text: 'Cancel',
				handler: function(){
					joincustomer_saveWindow.hide();
					mainPanel.remove(mainPanel.getActiveTab().getId());
				}
			}
		]
	});
	/* End  of Function*/
	
	function join_customer_confirm_save(){
		Ext.MessageBox.confirm('Confirmation','Anda yakin untuk melakukan penggabungan customer ini?', join_customer_button);
	}
	
	
	function join_customer_button(btn){
		if(btn=='yes'){
			join_customer_save();
		}
	
	}
	
	/* Function for retrieve create Window Form */
	joincustomer_saveWindow= new Ext.Window({
		id: 'joincustomer_saveWindow',
		title:'Penggabungan Customer',
		closable:true,
		closeAction: 'hide',
		closable: false,
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_joincustomer_save',
		items: joincustomer_saveForm
	});
	/* End Window */
	//joincustomer_saveForm.getForm().load();
	joincustomer_saveWindow.show();
/*	joincustomer_saveWindow.on("hide",function(){
		mainPanel.remove(mainPanel.getActiveTab().getId());										
	});*/
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_join_customer"></div>
		<div id="elwindow_joincustomer_save"></div>
        <div id="elwindow_joincustomer_search"></div>
    </div>
</div>
</body>
</html>