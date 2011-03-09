<?php
/* 	
	+ Module  		: perpanjang_paket View
	+ Description	: For record view
	+ Filename 		: v_perpanjang_paket.php
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
var perpanjang_paketListEditorGrid;
var perpanjang_paket_DataStore;
var perpanjang_paket_ColumnModel;
var perpanjang_paket_saveForm;
var perpanjang_paket_saveWindow;
var perpanjang_paket_idField;
var perpanjangan_hari_Field;
var perpanjang_paket_paketField;
var perpanjang_paket_tangalField;
var perpanjang_paket_keteranganField;


//declare konstant
var post2db = 'CREATE';
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
	function perpanjang_paket_save(){
	
		if(is_perpanjang_paket_form_valid()){	

			var perpanjang_paket_id_create_pk=null;
			var perpanjang_paket_djpaket_id_field = null;
			var perpanjang_paket_hari_field = null;
			var cust_point_field = null;
			var perpanjang_paket_tanggal_create="";
			var perpanjang_paket_keterangan_create=null;
			
			if(perpanjang_paket_idField.getValue()!== null){perpanjang_paket_id_create_pk = perpanjang_paket_idField.getValue();}
			if(perpanjangan_hari_Field.getValue()!==null){perpanjang_paket_hari_field=perpanjangan_hari_Field.getValue();}
			if(perpanjang_paket_paketField.getValue()!==null){perpanjang_paket_djpaket_id_field=perpanjang_paket_paketField.getValue();}
			if(perpanjang_paket_keteranganField.getValue()!== null){perpanjang_paket_keterangan_create = perpanjang_paket_keteranganField.getValue();}
			if(perpanjang_paket_tangalField.getValue()!== ""){perpanjang_paket_tanggal_create = perpanjang_paket_tangalField.getValue().format('Y-m-d');}				
										
			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_perpanjang_paket&m=get_action',
				params: {
	
					task: post2db,
					perpanjang_id			: perpanjang_paket_id_create_pk,		
					perpanjang_djpaket_id	: perpanjang_paket_djpaket_id_field,
					perpanjang_hari			: perpanjang_paket_hari_field,
					cust_point				: cust_point_field,
					perpanjang_tanggal		: perpanjang_paket_tanggal_create,					
					perpanjang_keterangan	: perpanjang_paket_keterangan_create
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					switch(result){
						case 1:
							Ext.MessageBox.alert(post2db+' OK','Perpanjangan Paket berhasil dilakukan.');
							perpanjang_paket_DataStore.reload();
							perpanjang_paket_saveWindow.hide();
							break;
						default:
							Ext.MessageBox.show({
							   title: 'Warning',
							   msg: 'Perpanjangan Paket tidak dapat dilakukan',
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
    
	
	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='CREATE')
			return perpanjang_paketListEditorGrid.getSelectionModel().getSelected().get('perpanjang_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function perpanjang_paket_reset_form(){
		perpanjang_paket_idField.reset();
		perpanjang_paket_idField.setValue(null);
		perpanjangan_hari_Field.reset();
		perpanjangan_hari_Field.setValue(null);
		perpanjang_paket_paketField.reset();
		perpanjang_paket_paketField.setValue(null);
		perpanjang_paket_keteranganField.reset();
		perpanjang_paket_keteranganField.setValue(null);
	}
 	/* End of Function */
	
	
	
	/* setValue to EDIT */
	function joincustomer_set_form(){
		perpanjang_paket_idField.setValue(perpanjang_paketListEditorGrid.getSelectionModel().getSelected().get('perpanjang_id'));
		perpanjangan_hari_Field.setValue(perpanjang_paketListEditorGrid.getSelectionModel().getSelected().get('perpanjang_hari'));
		perpanjang_paket_paketField.setValue(perpanjang_paketListEditorGrid.getSelectionModel().getSelected().get('perpanjang_djpaket_id'));
		perpanjang_paket_keteranganField.setValue(perpanjang_paketListEditorGrid.getSelectionModel().getSelected().get('perpanjang_keterangan'));
		perpanjang_paket_tangalField.setValue(perpanjang_paketListEditorGrid.getSelectionModel().getSelected().get('perpanjang_tanggal'));
	}
	/* End setValue to EDIT*/
	
	/* Function for Check if the form is valid */
	function is_perpanjang_paket_form_valid(){
		return (true &&  perpanjang_paket_paketField.isValid() && true);
	}
  	/* End of Function */
  
	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!perpanjang_paket_saveWindow.isVisible()){
			perpanjang_paket_reset_form();
			perpanjang_paket_saveWindow.show();
		} else {
			perpanjang_paket_saveWindow.toFront();
		}
	}
  	/* End Function */
  
	function perpanjang_paket_confirm_save(){
		Ext.MessageBox.confirm('Confirmation','Anda yakin untuk melakukan perpanjangan paket ini?', perpanjang_paket_button);
	}
	
	function perpanjang_paket_button(btn){
		if(btn=='yes'){
			perpanjang_paket_save();
		}
	
	}
	
	/* Combobox utk menampilkan paket2 yang sisanya tidak minus / tidak 0*/ 
	cbo_perpanjang_paket_listpaketDataStore = new Ext.data.Store({
		id: 'ambil_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perpanjang_paket&m=get_paket_list', 
			method: 'POST'
		}),
		baseParams:{start: 0, limit:pageS }, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'apaket_id'
		},[
			{name: 'jpaket_nobukti', type: 'string', mapping: 'jpaket_nobukti'}, 
			{name: 'jpaket_tanggal', type: 'date', dateFormat:'Y-m-d', mapping: 'jpaket_tanggal'},
			{name: 'dpaket_kadaluarsa', type: 'date', dateFormat:'Y-m-d', mapping: 'dpaket_kadaluarsa'}, 
			{name: 'cust_id', type: 'int', mapping: 'cust_id'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'}, 
			{name: 'paket_kode', type: 'string', mapping: 'paket_kode'},
			{name: 'paket_nama', type: 'string', mapping: 'paket_nama'},
			{name: 'dpaket_id', type: 'int', mapping: 'dpaket_id'},
			{name: 'dpaket_sisa_paket', type: 'int', mapping: 'dpaket_sisa_paket'},
			{name: 'dpaket_jumlah', type: 'int', mapping: 'dpaket_jumlah'},
			{name: 'dpaket_master', type: 'int', mapping: 'dpaket_master'},
			{name: 'dpaket_paket', type: 'int', mapping: 'dpaket_paket'}
		])
	});
	//Template yang akan tampil di ComboBox
	var perpanjang_listpaket_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{jpaket_nobukti} | Pemilik : {cust_nama} ({cust_no}) | <b>{paket_nama}</b> | Sisa : {dpaket_sisa_paket} | Kadaluarsa : {dpaket_kadaluarsa:date("j M Y")}',
		'</div></tpl>'
    );
	
	
	perpanjang_paket_DataStore = new Ext.data.Store({
		id: 'perpanjang_paket_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_perpanjang_paket&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start:0, limit: pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: ''
		},[
		/* dataIndex => insert intohpp_ColumnModel, Mapping => for initiate table column */ 
			{name: 'perpanjang_id', type: 'int', mapping: 'perpanjang_id'},
			{name: 'perpanjang_tanggal', type: 'date', mapping: 'perpanjang_tanggal'},
			{name: 'perpanjang_hari', type: 'int', mapping: 'perpanjang_hari'},
			{name: 'perpanjang_djpaket_id', type: 'int', mapping: 'perpanjang_djpaket_id'},
			{name: 'perpanjang_keterangan', type: 'string', mapping: 'perpanjang_keterangan'},
			{name: 'cust_nama', type: 'string', mapping: 'cust_nama'},
			{name: 'cust_no', type: 'string', mapping: 'cust_no'},
			{name: 'jpaket_nobukti', type: 'string', mapping: 'jpaket_nobukti'},
			{name: 'paket_nama', type: 'string', mapping: 'paket_nama'},
			{name: 'dpaket_kadaluarsa', type: 'date', dateFormat:'Y-m-d', mapping: 'dpaket_kadaluarsa'}
		]),
		sortInfo:{field: 'perpanjang_id', direction: "ASC"}
	});
	/* End of Function */
	
	perpanjang_paket_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">Tanggal</div>',
			dataIndex: 'perpanjang_tanggal',
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			width: 70,
			sortable: true
			
		}, 
		{
			header: '<div align="center">No Cust</div>',
			dataIndex: 'cust_no',
			width: 80,
			sortable: true
		
		}, 
		{
			header: '<div align="center">Customer</div>',
			dataIndex: 'cust_nama',
			width: 180,
			sortable: true
		
		}, 
		{
			header: '<div align="center">No Faktur</div>',
			dataIndex: 'jpaket_nobukti',
			width: 80,
			sortable: true
		
		}, 
		{
			header: '<div align="center">Paket</div>',
			dataIndex: 'paket_nama',
			width: 120,
			sortable: true
		
		}, 
		{
			header: '<div align="center">Tgl Kadaluarsa</div>',
			dataIndex: 'dpaket_kadaluarsa',
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			width: 100,
			sortable: true
			
		}, 
		
		{
			header: '<div align="center">Keterangan</div>',
			dataIndex: 'perpanjang_keterangan',
			width: 225,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 200
          	})
		
		}
		]
	);
	perpanjang_paket_ColumnModel.defaultSortable= true;
	/* End of Function */
	
	perpanjang_paketListEditorGrid = new Ext.grid.EditorGridPanel({
		id: 'perpanjang_paketListEditorGrid',
		el: 'fp_perpanjangan_paket',
		title: 'Daftar Paket yang di perpanjang',
		autoHeight: true,
		store: perpanjang_paket_DataStore, // DataStore
		cm: perpanjang_paket_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,
		autoHeight: true,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: perpanjang_paket_DataStore,
			displayInfo: true
		}),
		tbar: [
		{
			text: 'Add Perpanjangan Paket',
			tooltip: 'Add new record',
			iconCls:'icon-adds',
			handler: display_form_search_window 
		},'-', /*{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			iconCls:'icon-refresh',
			disabled : true
		}*/]
	});
	perpanjang_paketListEditorGrid.render();
	
	/* Event while selected row via context menu */
	function onjoincustomer_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		joincustomer_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		joincustomer_SelectedRow=rowIndex;
		joincustomer_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	perpanjang_paketListEditorGrid.addListener('rowcontextmenu', onjoincustomer_ListEditGridContextMenu);
	perpanjang_paket_DataStore.load({params: {start: 0, limit: pageS}});

	/* Identify  perpanjang_id Field */
	perpanjang_paket_idField= new Ext.form.NumberField({
		id: 'perpanjang_paket_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
		hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	
	perpanjang_paket_paketField = new Ext.form.ComboBox({
		fieldLabel: 'Paket yang akan di perpanjang',
		store: cbo_perpanjang_paket_listpaketDataStore,
		mode: 'remote',
		displayField:'paket_nama',
		valueField: 'dpaket_id',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: perpanjang_listpaket_tpl,
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		disabled:false,
		anchor: '90%'
	});
	
	perpanjangan_hari_Field =  new Ext.form.NumberField({
		fieldLabel : 'Hari (days)',
		allowDecimals: false,
		allowNegative: false,
		blankText: '0',
		maxLength: 11,
		maskRe: /([0-9]+)$/
	});
	
	
	perpanjang_paket_tangalField= new Ext.form.DateField({
		id: 'perpanjang_paket_tangalField',
		fieldLabel: 'Tanggal',
		format : 'd-m-Y',
		disabled : true,
		value : today
	});
	
	perpanjang_paket_keteranganField= new Ext.form.TextArea({
		id: 'perpanjang_paket_keteranganField',
		fieldLabel: 'Keterangan',
		maxLength: 200,
		anchor: '95%'
	});
		
	perpanjang_paket_infoketeranganField=new Ext.form.Label({ html: '<br><br> *Paket yang sudah diperpanjang tidak dapat diubah kembali, hanya dapat melakukan penambahan tanggal kadaluarsa, tidak bisa melakukan pengurangan tanggal kadaluarsa"'});

	/* Function for retrieve create Window Panel*/ 
	perpanjang_paket_saveForm = new Ext.FormPanel({
		labelAlign: 'left',
		labelWidth: 250,
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 800,        
		items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [perpanjang_paket_idField,perpanjang_paket_tangalField, perpanjang_paket_paketField, perpanjangan_hari_Field, perpanjang_paket_keteranganField, perpanjang_paket_infoketeranganField] 
			}
			],
		buttons: [{
				text: 'Perpanjang',
				handler : perpanjang_paket_confirm_save
			}
			,{
				text: 'Cancel',
				handler: function(){
					perpanjang_paket_saveWindow.hide();
					//mainPanel.remove(mainPanel.getActiveTab().getId());
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	perpanjang_paket_saveWindow= new Ext.Window({
		id: 'perpanjang_paket_saveWindow',
		title:'Perpanjangan Paket',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_perpanjangan_paket_save',
		items: perpanjang_paket_saveForm
	});
	/* End Window */
	
	//perpanjang_paket_saveWindow.show();


});
	</script>
<body>
<div>
	<div class="col">
		 <div id="fp_perpanjangan_paket"></div>
		<div id="elwindow_perpanjangan_paket_save"></div>
    </div>
</div>
</body>
</html>