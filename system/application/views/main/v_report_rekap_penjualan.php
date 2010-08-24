<?
/* 
	+ Module  		: Top Spender View
	+ Description	: For record view
	+ Filename 		: v_report_rekap_penjualan.php
 	+ Author  		: Isaac
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
Ext.namespace('Ext.ux.plugin');

Ext.ux.plugin.triggerfieldTooltip = function(config){
    Ext.apply(this, config);
};

Ext.extend(Ext.ux.plugin.triggerfieldTooltip, Ext.util.Observable,{
    init: function(component){
        this.component = component;
        this.component.on('render', this.onRender, this);
    },
    
    //private
    onRender: function(){
        if(this.component.tooltip){
            if(typeof this.component.tooltip == 'object'){
                Ext.QuickTips.register(Ext.apply({
                      target: this.component.trigger
                }, this.component.tooltip));
            } else {
                this.component.trigger.dom[this.component.tooltipType] = this.component.tooltip;
            }
        }
    }
}); 

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
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
    }
});
/* declare function */		
var rekap_penjualanDataStore;
//var sum_kreditDataStore;
var rekap_penjualanColumnModel;
//var sum_kreditColumnModel;
var rekap_penjualanListEditorGrid;
var rekap_penjualan_createForm;
var rekap_penjualan_createWindow;
var rekap_penjualan_searchForm;
var rekap_penjualan_searchWindow;
var rekap_penjualanSelectedRow;
var rekap_penjualanContextMenu;
var jenisField;
//var jumlahField;
//for detail data


var today=new Date().format('d-m-Y');

//declare konstant 
var post2db = '';
var msg = '';
var pageS=30;

/* declare variable here for Field*/
var trawat_medis_idField;
var trawat_medis_idSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='UPDATE')
			return rekap_penjualanListEditorGrid.getSelectionModel().getSelected().get('trawat_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	// cek valid
	function is_rekap_penjualan_searchForm_valid(){
		return (Ext.getCmp('rekap_penjualan_tglStartSearchField').isValid() );
		//&& jumlahField.getValue()!=null && jenisField.getValue()!=null);
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!rekap_penjualan_createWindow.isVisible()){
			//tindakan_medisreset_form();
			//post2db='CREATE';
			msg='created';
			rekap_penjualan_createWindow.show();
		} else {
			rekap_penjualan_createWindow.toFront();
		}
	}
  	/* End of Function */
  	
	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
  
	/* Function for Retrieve DataStore */
	//isc_datastore
	rekap_penjualanDataStore = new Ext.data.Store({
		id: 'rekap_penjualanDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_report_rekap_penjualan&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: ''
		},[
		/* dataIndex => insert into rekap_penjualanColumnModel, Mapping => for initiate table column */ 
			{name: 'kode', type: 'string', mapping: 'kode'},
			{name: 'nama', type: 'string', mapping: 'nama'},
			{name: 'total_jumlah', type: 'float', mapping: 'total_jumlah'},
			{name: 'subtotal', type: 'float', mapping: 'subtotal'},
			{name: 'diskon_tambahan', type: 'float', mapping: 'diskon_tambahan'},
			{name: 'grand_total', type: 'float', mapping: 'grand_total'},
		]),
		sortInfo:{field: 'grand_total', direction: "DESC"}
	});
	/* End of Function */
	

  	/* Function for Identify of Window Column Model */
	//Tampilkan di grid
	rekap_penjualanColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Kode' + '</div>',
			dataIndex: 'kode',
			width: 80,
			sortable: true,
			readOnly:true,
	
		}, 
		{
			header: '<div align="center">' + 'Nama Produk / Perawatan Satuan / Paket' + '</div>',
			dataIndex: 'nama',
			width: 210,//185,	//210,
			sortable: true,
			readOnly : true,
		}, 
		{
			align : 'Right',
			header: '<div align="center">' + 'Total Item' + '</div>',
			dataIndex: 'total_jumlah',
			width: 60,//185,	//210,
			sortable: true,
			readOnly : true,
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Sub Total (Rp)' + '</div>',
			dataIndex: 'subtotal',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			readOnly: true,
			width: 80,	//55,
			sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Tot Disk Tmbhn (Rp)' + '</div>',
			dataIndex: 'diskon_tambahan',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			readOnly: true,
			width: 100,	//55,
			sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Total (Rp)' + '</div>',
			dataIndex: 'grand_total',
			renderer: Ext.util.Format.numberRenderer('0,000'),
			readOnly: true,
			width: 80,	//55,
			sortable: true
		}
		/*,
		{	
			align : 'Right',
			header: '<div align="center">' + 'Kredit (Satuan)' + '</div>',
			dataIndex: 'dtrawat_skredit',
			width: 80,	//55,
			sortable: false
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Total Kredit' + '</div>',
			dataIndex: 'dtrawat_jkredit',
			width: 80,	//55,
			sortable: false
		},
		*/
	]);
	
	rekap_penjualanColumnModel.defaultSortable= true;
	/* End of Function */
	
	
	/* Declare DataStore and  show datagrid list */
	rekap_penjualanListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'rekap_penjualanListEditorGrid',
		el: 'fp_rekap_penjualan',
		title: 'Laporan Rekap Penjualan',
		autoHeight: true,
		store: rekap_penjualanDataStore, // DataStore
		cm: rekap_penjualanColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 970, //940,//1200,	//970,
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Adv Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}
		]
	});
	rekap_penjualanListEditorGrid.render();
	/* End of DataStore */
	

	/* Create Context Menu */
	rekap_penjualanContextMenu = new Ext.menu.Menu({
		id: 'rekap_penjualanListEditorGridContextMenu',
		items: [
		{
			text: 'Search Top Spender',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onrekap_penjualanListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		rekap_penjualanContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		rekap_penjualanSelectedRow=rowIndex;
		rekap_penjualanContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */

	rekap_penjualanListEditorGrid.addListener('rowcontextmenu', onrekap_penjualanListEditGridContextMenu);
	//top_spenderDataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	
	
	/* Identify  jenis Combo*/
	jenisField= new Ext.form.ComboBox({
		id: 'jenisField',
		fieldLabel: 'Jenis',
		store:new Ext.data.SimpleStore({
			fields:['jenis_value', 'jenis_display'],
			data:[['Perawatan','Perawatan Satuan'],['Produk','Produk'],['Paket','Paket']]
		}),
		mode: 'local',
		editable:false,
		emptyText: 'Produk',
		displayField: 'jenis_display',
		valueField: 'jenis_value',
		width: 120,
		triggerAction: 'all'	
	});

	/* Identify  jumlah Combo*/
	/*
	jumlahField= new Ext.form.ComboBox({
		id: 'jumlahField',
		fieldLabel: 'Top Rank',
		store:new Ext.data.SimpleStore({
			fields:['jumlah_value', 'jumlah_display'],
			data:[['5','5'],['10','10'],['15','15'],['20','20'],['25','25'],['30','30'],['35','35'],['40','40'],['45','45'],['50','50']]
		}),
		mode: 'local',
		editable:false,
		emptyText: '10',
		displayField: 'jumlah_display',
		valueField: 'jumlah_value',
		width: 50,
		triggerAction: 'all'	
	});
	*/
	
	/* Function for retrieve create Window Form */
	rekap_penjualan_createWindow= new Ext.Window({
		id: 'rekap_penjualan_createWindow',
		title: post2db+'Tindakan Medis',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_rekap_penjualan_create',
		items: rekap_penjualan_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function rekap_penjualan_search(){
		// render according to a SQL date format.
		// KIRIM
		if(is_rekap_penjualan_searchForm_valid())
		{
		//var trawat_id_search=null;
		var rekap_penjualan_tgl_start_app_search=null;
		var rekap_penjualan_tgl_end_app_search=null;
		//var trawat_dokter_search=null;
		var jenisField_search=null;
		//var jumlahField_search=null;

		//if(trawat_medis_idSearchField.getValue()!==null){trawat_id_search=trawat_medis_idSearchField.getValue();}
		if(Ext.getCmp('rekap_penjualan_tglStartSearchField').getValue()!==null){rekap_penjualan_tgl_start_app_search=Ext.getCmp('rekap_penjualan_tglStartSearchField').getValue();}
		if(Ext.getCmp('rekap_penjualan_tglEndSearchField').getValue()!==null){rekap_penjualan_tgl_end_app_search=Ext.getCmp('rekap_penjualan_tglEndSearchField').getValue();}
		if(jenisField.getValue()!==null){jenisField_search=jenisField.getValue();}
		//if(jumlahField.getValue()!==null){jumlahField_search=jumlahField.getValue();}
		// change the store parameters
		rekap_penjualanDataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			/*
			trawat_id	:	trawat_id_search, 
			trawat_tglapp_start	: 	trawat_tgl_start_app_search,
			trawat_tglapp_end	: 	trawat_tgl_end_app_search,
			trawat_dokter	:	trawat_dokter_search,
			*/
			//trawat_id	:	trawat_id_search, 
			rekap_penjualan_tglapp_start	: 	rekap_penjualan_tgl_start_app_search,
			rekap_penjualan_tglapp_end		: 	rekap_penjualan_tgl_end_app_search,
			rekap_penjualan_jenis			:	jenisField_search,
			//top_jumlah	:	jumlahField_search,
		};
		
		// Cause the datastore to do another query : 
		rekap_penjualanDataStore.reload({params: {start: 0, limit: pageS}});
		
		}
		
		else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Tanggal awal belum diisi',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}

		
	}
		
	/* Function for reset search result */
	function rekap_penjualan_reset_search(){
		// reset the store parameters
		rekap_penjualanDataStore.baseParams = { task: 'LIST',start:0,limit:pageS };
		// Cause the datastore to do another query : 
		rekap_penjualanDataStore.reload({params: {start: 0, limit: pageS}});
		rekap_penjualan_searchWindow.close();
	};
	/* End of Fuction */
	

	var dt = new Date(); 
	
	/* Function for retrieve search Form Panel */
	rekap_penjualan_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 640,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [
				        {
						layout:'column',
						border:false,
						items:[
				        {
							columnWidth:0.33,
							layout: 'form',
							border:false,
							defaultType: 'datefield',
							items: [
							    {
									//fieldLabel: 'Tanggal Tindakan',
									fieldLabel: 'Tanggal',
							        name: 'rekap_penjualan_tglStartSearchField',
							        id: 'rekap_penjualan_tglStartSearchField',
									vtype: 'daterange',
									allowBlank: false,
									format: 'd-m-Y',
							        endDateField: 'rekap_penjualan_tglEndSearchField' // id of the end date field Ext.getCmp('top_spender_tglStartSearchField').isValid()
							    }] 
						},
						{
							columnWidth:0.30,
							layout: 'form',
							labelWidth:20,
							border:false,
							defaultType: 'datefield',
							items: [
						      	{
									fieldLabel: 's/d',
							        name: 'rekap_penjualan_tglEndSearchField',
							        id: 'rekap_penjualan_tglEndSearchField',
							        vtype: 'daterange',
									allowBlank: false,
									format: 'd-m-Y',
									value : today,
							        startDateField: 'rekap_penjualan_tglStartSearchField' // id of the end date field
							    }] 
						}]},
						jenisField]
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				//handler: tindakan_medislist_search
				handler: rekap_penjualan_search
			},{
				text: 'Close',
				handler: function(){
					rekap_penjualan_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
    
	function rekap_penjualan_reset_formSearch(){
		jenisField.reset();
		jenisField.setValue(null);
		//jumlahField.reset();
		//jumlahField.setValue(null);
		Ext.getCmp('rekap_penjualan_tglStartSearchField').reset();
		Ext.getCmp('rekap_penjualan_tglStartSearchField').setValue(null);
		Ext.getCmp('rekap_penjualan_tglEndSearchField').reset();
		Ext.getCmp('rekap_penjualan_tglEndSearchField').setValue(today);
	}
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	rekap_penjualan_searchWindow = new Ext.Window({
		title: 'Pencarian Rekap Penjualan',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_rekap_penjualan_search',
		items: rekap_penjualan_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!rekap_penjualan_searchWindow.isVisible()){
			rekap_penjualan_reset_formSearch();
			jenisField.setValue('Produk');
			//jumlahField.setValue('10');
			rekap_penjualan_searchWindow.show();
		} else {
			rekap_penjualan_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function tindakan_medisprint(){
		var searchquery = "";
		var trawat_cust_print=null;
		var trawat_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(top_spenderDataStore.baseParams.query!==null){searchquery = top_spenderDataStore.baseParams.query;}
		if(top_spenderDataStore.baseParams.trawat_cust!==null){trawat_cust_print = top_spenderDataStore.baseParams.trawat_cust;}
		if(top_spenderDataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_print = top_spenderDataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_rekap_penjualan&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_print,
			trawat_keterangan : trawat_keterangan_print,
		  	currentlisting: top_spenderDataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./tindakanlist.html','tindakanlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
				win.print();
				break;
		  	default:
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Unable to print the grid!',
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
	
	/* Function for print Export to Excel Grid */
	function tindakan_medisexport_excel(){
		var searchquery = "";
		var tindakan_dokter_2excel=null;
		//var tindakan_perawatan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(top_spenderDataStore.baseParams.query!==null){searchquery = top_spenderDataStore.baseParams.query;}
		if(top_spenderDataStore.baseParams.trawat_dokter!==null){tindakan_dokter_2excel = top_spenderDataStore.baseParams.trawat_dokter;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_report_rekap_penjualan&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_dokter : tindakan_dokter_2excel,
		  	currentlisting: top_spenderDataStore.baseParams.task // this tells us if we are searching or not
		},
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.location=('./export2excel.php');
				break;
		  	default:
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Unable to convert excel the grid!',
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
	/*End of Function */
	rekap_penjualan_searchWindow.show();
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_rekap_penjualan"></div>
         <div id="fp_top_tindakan_medisdetail"></div>
		 <div id="fp_top_dtindakan_jual_nonmedis"></div>
		<div id="elwindow_rekap_penjualan_create"></div>
        <div id="elwindow_rekap_penjualan_search"></div>
    </div>
</div>
</body>