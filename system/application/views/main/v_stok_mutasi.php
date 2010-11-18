<?php
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: stok_mutasi View
	+ Description	: For record view
	+ Filename 		: v_stok_mutasi.php
 	+ creator  		: 
 	+ Created on 09/Apr/2010 10:47:15
	
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
var stok_mutasi_DataStore;
var stok_mutasi_ColumnModel;
var stok_mutasiListEditorGrid;
var stok_mutasi_saveForm;
var stok_mutasi_saveWindow;
var stok_mutasi_searchForm;
var stok_mutasi_searchWindow;
var stok_mutasi_SelectedRow;
var stok_mutasi_ContextMenu;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;
var today=new Date().format('Y-m-d');
var firstday=(new Date().format('Y-m'))+'-01';
/* declare variable here for Field*/
var produk_idField;
var produk_namaField;
var satuan_idField;
var satuan_namaField;
var stok_saldoField;
var produk_idSearchField;
var produk_namaSearchField;
var satuan_idSearchField;
var satuan_namaSearchField;
var stok_saldoSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for get PK field */
	function get_pk_id(){
		if(post2db=='UPDATE')
			return stok_mutasiListEditorGrid.getSelectionModel().getSelected().get('produk_id');
		else 
			return 0;
	}
  	/* End of Function */
	
	/* Function for Retrieve DataStore */
	stok_mutasi_DataStore = new Ext.data.Store({
		id: 'stok_mutasi_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_stok_mutasi&m=get_action', 
			method: 'POST',
			timeout: 3600000
		}),
		baseParams:{task: "LIST", start:0, limit: pageS, produk_id:0, query: null}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'produk_id', type: 'int', mapping: 'produk_id'}, 
			{name: 'produk_nama', type: 'string', mapping: 'produk_nama'}, 
			{name: 'produk_kode', type: 'string', mapping: 'produk_kode'}, 
			{name: 'satuan_id', type: 'int', mapping: 'satuan_id'}, 
			{name: 'satuan_nama', type: 'string', mapping: 'satuan_nama'},
			{name: 'jumlah_awal', type: 'float', mapping: 'jumlah_awal'}, 
			{name: 'jumlah_in', type: 'float', mapping: 'jumlah_masuk'}, 
			{name: 'jumlah_out', type: 'float', mapping: 'jumlah_keluar'},
			{name: 'jumlah_koreksi', type: 'float', mapping: 'jumlah_koreksi'}, 
			{name: 'gudang_nama', type: 'string', mapping: 'gudang_nama'}, 
			{name: 'jumlah_stok', type: 'float', mapping: 'jumlah_stok'}
		]),
		sortInfo:{field: 'produk_id', direction: "ASC"}
	});
	/* End of Function */
	
	/* Function for Retrieve DataStore */
	stok_mutasi_group1_DataStore = new Ext.data.Store({
		id: 'stok_mutasi_group1_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_stok_mutasi&m=get_group1_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start: 0, limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'group_id'
		},[
			{name: 'group_id', type: 'int', mapping: 'group_id'}, 
			{name: 'group_kode', type: 'string', mapping: 'group_kode'}, 
			{name: 'group_nama', type: 'string', mapping: 'group_nama'}
		]),
		sortInfo:{field: 'group_id', direction: "DESC"}
	});
	
	/* Function for Retrieve DataStore */
	stok_mutasi_produk_DataStore = new Ext.data.Store({
		id: 'stok_mutasi_produk_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_hpp&m=get_produk_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start: 0, limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'produk_id'
		},[
			{name: 'produk_id', type: 'int', mapping: 'produk_id'}, 
			{name: 'produk_kode', type: 'string', mapping: 'produk_kode'}, 
			{name: 'produk_jenis', type: 'string', mapping: 'produk_jenis'}, 
			{name: 'produk_nama', type: 'string', mapping: 'produk_nama'}, 
			{name: 'satuan_id', type: 'int', mapping: 'satuan_id'}, 
			{name: 'satuan_kode', type: 'string', mapping: 'satuan_kode'}, 
			{name: 'satuan_nama', type: 'string', mapping: 'satuan_nama'}
		]),
		sortInfo:{field: 'produk_id', direction: "DESC"}
	});
	
	/* End of Function */
	var produk_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{produk_nama} ({produk_kode})</b><br /></span>',
            'Satuan: {satuan_nama}',
        '</div></tpl>'
    );
	
	var stok_mutasi_gudangField=new Ext.form.TextField({});
	var stok_mutasi_periodeField=new Ext.form.TextField({ width: 300 });
	
	stok_mutasi_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'produk_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: '<div align="center">Kode</div>',
			dataIndex: 'produk_kode',
			width: 150,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">Nama</div>',
			dataIndex: 'produk_nama',
			width: 350,
			sortable: true,
			readOnly: true
		}, 
		{
			header: '<div align="center">Satuan</div>',
			dataIndex: 'satuan_nama',
			width: 150,
			sortable: true,
			readOnly: true
		},
		{
			header: '<div align="center">Stok Awal</div>',
			dataIndex: 'jumlah_awal',
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000.00'),
			width: 150,
			sortable: true,
			readOnly: true
		},
		{
			header: '<div align="center">Masuk</div>',
			dataIndex: 'jumlah_in',
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000.00'),
			width: 150,
			sortable: true,
			readOnly: true
		},
		{
			header: '<div align="center">Keluar</div>',
			dataIndex: 'jumlah_out',
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000.00'),
			width: 150,
			sortable: true,
			readOnly: true
		}/*,{
			header: '<div align="center">Koreksi</div>',
			dataIndex: 'jumlah_koreksi',
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000.00'),
			width: 150,
			sortable: true,
			readOnly: true
		},*/
		,
		{
			header: '<div align="center">Stok Akhir</div>',
			dataIndex: 'jumlah_stok',
			align: 'right',
			renderer: Ext.util.Format.numberRenderer('0,000.00'),
			width: 150,
			sortable: true,
			readOnly: true
		}]);
	
	stok_mutasi_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!stok_mutasi_searchWindow.isVisible()){
			stok_mutasi_searchWindow.show();
		} else {
			stok_mutasi_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Declare DataStore and  show datagrid list */
	stok_mutasiListEditorGrid =  new Ext.grid.GridPanel({
		id: 'stok_mutasiListEditorGrid',
		el: 'fp_vu_stok_mutasi',
		title: 'Laporan Stok Mutasi',
		autoHeight: true,
		store: stok_mutasi_DataStore, // DataStore
		cm: stok_mutasi_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1200,
		autoHeight: true,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: stok_mutasi_DataStore,
			displayInfo: true
		}),tbar: [
		'<b>Gudang  : </b>',
		stok_mutasi_gudangField,
		'-',
		'<b>Periode : </b>',
		stok_mutasi_periodeField,
		'-',
		{
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		},'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: stok_mutasi_reset_search,
			iconCls:'icon-refresh'
		}/*,'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: stok_mutasi_export_excel
		}*/, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: stok_mutasi_print  
		}]
	});
	
	stok_mutasiListEditorGrid.render();
	stok_mutasiListEditorGrid.show();
	
	/* Function for action list search */
	function stok_mutasi_list_search(){
		// render according to a SQL date format.
		var produk_nama_search=null;
		var group1_search=null;
		var tanggal_start_search="";
		var tanggal_end_search="";
		var opsi_satuan_search='default';
		var opsi_produk_search='all';
		var gudang_search=null;
		
		
		mutasi_gudang_DataSore.load({
		 	callback: function(r,opt,success){
				if(success==true){
					//console.log('gudang : ' + stok_mutasi_gudangSearchField.getValue());
					var j=mutasi_gudang_DataSore.findExact('mutasi_gudang_value',stok_mutasi_gudangSearchField.getValue(),0);
					//console.log('gudang : ' + j);
					if(j>-1){
						var gudang_record=mutasi_gudang_DataSore.getAt(j);
						stok_mutasi_gudangField.setValue(gudang_record.data.mutasi_gudang_nama);
						//console.log('gudang : ' + gudang_record.data.gudang_nama);
					}
				}
			}
		});
		
		stok_mutasi_periodeField.setValue(stok_mutasi_tanggal_startSearchField.getValue().format('Y-m-d')+ ' s/d ' + stok_mutasi_tanggal_endSearchField.getValue().format('Y-m-d'));
						
		if(stok_mutasi_produk_namaSearchField.getValue()!==null){produk_nama_search=stok_mutasi_produk_namaSearchField.getValue();}
		if(stok_mutasi_group1SearchField.getValue()!==null){group1_search=stok_mutasi_group1SearchField.getValue();}
		
		if(stok_mutasi_produk_allField.getValue()==true){ 
			opsi_produk_search='all';
		}else if(stok_mutasi_produk_selectField.getValue()==true){
			opsi_produk_search='produk';
		}else if(stok_mutasi_group1_selectField.getValue()==true){
			opsi_produk_search='group1';
		}
		
		if(stok_mutasi_tanggal_startSearchField.getValue()!==null){tanggal_start_search=stok_mutasi_tanggal_startSearchField.getValue().format('Y-m-d');}
		if(stok_mutasi_tanggal_endSearchField.getValue()!==null){tanggal_end_search=stok_mutasi_tanggal_endSearchField.getValue().format('Y-m-d');}
		if(stok_mutasi_satuan_terkecilField.getValue()==true){ opsi_satuan_search='terkecil'; }else{ opsi_satuan_search='default'; }
		if(stok_mutasi_gudangSearchField.getValue()!==null){ gudang_search=stok_mutasi_gudangSearchField.getValue()}
		// change the store parameters
		stok_mutasi_DataStore.baseParams = {
			task			: 	'SEARCH',
			produk_id		:	produk_nama_search, 
			group1_id		:	group1_search,
			tanggal_start	:	tanggal_start_search, 
			tanggal_end		:	tanggal_end_search,
			opsi_satuan		: 	opsi_satuan_search,
			gudang			: 	gudang_search,
			opsi_produk		: 	opsi_produk_search
		};
		// Cause the datastore to do another query : 
		
		
		stok_mutasi_DataStore.reload({
			params: {start: 0, limit: pageS, query: null},
			callback: function(r,opt,success){
				if(success==true){
					Ext.MessageBox.hide();
				}					 
			}
		});
	}
		
	/* Function for reset search result */
	function stok_mutasi_reset_search(){
		// reset the store parameters
		stok_mutasi_DataStore.baseParams = { task: 'LIST', start: 0, limit: pageS };
		stok_mutasi_DataStore.reload({params: {start: 0, limit: pageS}});
		stok_mutasi_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  produk_id Search Field */
	stok_mutasi_produk_idSearchField= new Ext.form.NumberField({
		id: 'stok_mutasi_produk_idSearchField',
		fieldLabel: 'Produk Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  stok_produk_nama Search Field */
	stok_mutasi_produk_namaSearchField= new Ext.form.ComboBox({
		id: 'stok_mutasi_produk_namaSearchField',
		fieldLabel: '-',
		store: stok_mutasi_produk_DataStore,
		mode: 'remote',
		typeAhead: false,
		displayField: 'produk_nama',
		valueField: 'produk_id',
		triggerAction: 'query',
		lazyRender: true,
		loadingText: 'Loading...',
		pageSize: pageS,
		tpl: produk_tpl,
		itemSelector: 'div.search-item',
		//listClass: 'x-combo-list-small',
		width: 300
	
	});
	
	var group1_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{group_nama} ({group_kode})</b></span>',
        '</div></tpl>'
    );
	
	stok_mutasi_group1SearchField= new Ext.form.ComboBox({
		id: 'stok_mutasi_group1SearchField',
		fieldLabel: '-',
		store: stok_mutasi_group1_DataStore,
		mode: 'remote',
		typeAhead: false,
		displayField: 'group_nama',
		valueField: 'group_id',
		triggerAction: 'all',
		lazyRender: false,
		pageSize: pageS,
		enableKeyEvents: true,
		tpl: group1_tpl,
		itemSelector: 'div.search-item',
		triggerAction: 'all',
		listClass: 'x-combo-list-small',
		width: 300
	
	});
	
		/* Function for Retrieve Supplier DataStore */
	mutasi_gudang_DataSore = new Ext.data.Store({
		id: 'mutasi_gudang_DataSore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_master_mutasi&m=get_gudang_list', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'gudang_id'
		},[
			{name: 'mutasi_gudang_value', type: 'int', mapping: 'gudang_id'},
			{name: 'mutasi_gudang_nama', type: 'string', mapping: 'gudang_nama'}
		]),
		sortInfo:{field: 'mutasi_gudang_nama', direction: "ASC"}
	});
	
	stok_mutasi_gudangSearchField= new Ext.form.ComboBox({
		id: 'stok_mutasi_gudangSearchField',
		fieldLabel: 'Gudang',
		store: mutasi_gudang_DataSore,
		mode: 'remote',
		typeAhead: false,
		displayField: 'mutasi_gudang_nama',
		valueField: 'mutasi_gudang_value',
		triggerAction: 'all',
		lazyRender: false,
		pageSize: pageS,
		allowBlank: false,
		//itemSelector: 'div.search-item',
		triggerAction: 'all',
		//listClass: 'x-combo-list-small',
		width: 300
	
	});
	
	
	stok_mutasi_tanggal_startSearchField=new Ext.form.DateField({
		id: 'stok_mutasi_tanggal_startSearchField',
		fieldLabel: 'Tanggal',
		format: 'd-m-Y',		
		value: firstday
	});
    
	stok_mutasi_tanggal_endSearchField=new Ext.form.DateField({
		id: 'stok_mutasi_tanggal_endSearchField',
		fieldLabel: 's/d',
		format: 'd-m-Y',
		value: today
	});
	
	stok_mutasi_produk_allField=new Ext.form.Radio({
		name:'opsi_produk',
		boxLabel: 'Semua',
		width: 100
	});
	
	stok_mutasi_produk_selectField=new Ext.form.Radio({
		name:'opsi_produk',
		boxLabel: 'Produk',
		checked: true,
		width: 100
	});
	
	stok_mutasi_group1_selectField=new Ext.form.Radio({
		name:'opsi_produk',
		boxLabel: 'Group 1',
		width: 100
	});
	
	stok_mutasi_satuan_terkecilField=new Ext.form.Radio({
		name:'opsi_satuan',
		boxLabel: 'Satuan Terkecil',
		width: 100
	});
	
	stok_mutasi_satuan_defaultField=new Ext.form.Radio({
		name:'opsi_satuan',
		boxLabel: 'Satuan Default',
		checked: true,
		width: 100
	});
	
	stok_mutasi_label_tanggalField=new Ext.form.Label({ html: ' &nbsp; s/d  &nbsp;'});
	
	stok_mutasi_tanggal_opsiSearchField=new Ext.form.FieldSet({
		id:'stok_mutasi_tanggal_opsiSearchField',
		title: 'Opsi Tanggal',
		layout: 'column',
		bodyStyle: 'padding: 5px;',
		frame: false,
		items:[stok_mutasi_tanggal_startSearchField, stok_mutasi_label_tanggalField, stok_mutasi_tanggal_endSearchField]
	});
	
	stok_mutasi_produk_opsiSearchField=new Ext.form.FieldSet({
		id:'stok_mutasi_produk_opsiSearchField',
		title: 'Opsi Produk',
		layout: 'form',
		frame: false,
		bodyStyle: 'padding: 5px;',
		items:[{
			   		layout	: 'column',
					bodyStyle: 'padding-bottom: 5px;',
					border: false,
					items	: [stok_mutasi_produk_allField]
			   },
			   {
				   layout	: 'column',
				   bodyStyle: 'padding-bottom: 5px;',
				   border: false,
				   items	: [stok_mutasi_produk_selectField,stok_mutasi_produk_namaSearchField]
			   },{
				   layout	: 'column',
				   bodyStyle: 'padding-bottom: 5px;',
				   border: false,
				   items	: [stok_mutasi_group1_selectField,stok_mutasi_group1SearchField]
			   }
			
		]
	});
	
	stok_mutasi_satuan_opsiSearchField=new Ext.form.FieldSet({
		id:'stok_mutasi_satuan_opsiSearchField',
		title: 'Opsi Satuan',
		layout: 'form',
		frame: false,
		bodyStyle: 'padding: 5px;',
		items:[{
			   		layout	: 'column',
					border: false,
					items	: [stok_mutasi_satuan_defaultField]
			   },
			   {
				   layout	: 'column',
				   border: false,
				   items	: [stok_mutasi_satuan_terkecilField]
			   }
			
		]
	});
	
	/* Function for retrieve search Form Panel */
	stok_mutasi_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 450,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth: 1,
				layout: 'form',
				border:false,
				items: [stok_mutasi_gudangSearchField, stok_mutasi_produk_opsiSearchField,stok_mutasi_satuan_opsiSearchField, stok_mutasi_tanggal_opsiSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: stok_mutasi_list_search
			},{
				text: 'Close',
				handler: function(){
					stok_mutasi_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	stok_mutasi_searchWindow = new Ext.Window({
		title: 'Pencarian Stok Mutasi',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_stok_mutasi_search',
		items: stok_mutasi_searchForm
	});
    /* End of Function */ 
	 
	function reset_search_form(){
		stok_mutasi_gudangSearchField.reset();
		stok_mutasi_gudangSearchField.setValue(null);
		stok_mutasi_satuan_defaultField.setValue(true);
		stok_mutasi_produk_allField.setValue(true);
		stok_mutasi_produk_namaSearchField.reset();
		stok_mutasi_produk_namaSearchField.setValue(null);
		stok_mutasi_group1SearchField.reset();
		stok_mutasi_group1SearchField.setValue(null);
	}
	
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		reset_search_form();
		
		if(!stok_mutasi_searchWindow.isVisible()){
			stok_mutasi_searchWindow.show();
		} else {
			stok_mutasi_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function stok_mutasi_print(){
		var searchquery = "";
		var produk_id_print='';
		var group1_id_print='';
		var tanggal_start_print=null;
		var tanggal_end_print=null;
		var opsi_satuan_print=null;
		var opsi_produk_print=null;
		var gudang_print=null;
		var win;              

		if(stok_mutasi_DataStore.baseParams.query!==null){searchquery = stok_mutasi_DataStore.baseParams.query;}
		
		if(stok_mutasi_DataStore.baseParams.produk_id!==null){produk_id_print = stok_mutasi_DataStore.baseParams.produk_id;}
		if(stok_mutasi_DataStore.baseParams.group1_id!==null){group1_id_print = stok_mutasi_DataStore.baseParams.group1_id;}
		if(stok_mutasi_DataStore.baseParams.tanggal_start!==null){tanggal_start_print = stok_mutasi_DataStore.baseParams.tanggal_start;}
		if(stok_mutasi_DataStore.baseParams.tanggal_end!==null){tanggal_end_print = stok_mutasi_DataStore.baseParams.tanggal_end;}
		if(stok_mutasi_DataStore.baseParams.opsi_satuan!==null){opsi_satuan_print = stok_mutasi_DataStore.baseParams.opsi_satuan;}
		if(stok_mutasi_DataStore.baseParams.opsi_produk!==null){opsi_produk_print = stok_mutasi_DataStore.baseParams.opsi_produk;}
		if(stok_mutasi_DataStore.baseParams.gudang!==null){gudang_print = stok_mutasi_DataStore.baseParams.gudang;}
		
		
		Ext.MessageBox.show({
		   msg: 'Sedang memproses data, mohon tunggu...',
		   progressText: 'proses...',
		   width:350,
		   wait:true
		});
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_stok_mutasi&m=get_action',
		timeout: 3600000,
		params: {
			task			: "PRINT",
		  	query			: searchquery,                    		
			produk_id		: produk_id_print, 
			group1_id		: group1_id_print,
			tanggal_start	: tanggal_start_print, 
			tanggal_end		: tanggal_end_print,
			opsi_satuan		: opsi_satuan_print,
			gudang			: gudang_print,
			opsi_produk		: opsi_produk_print,
		  	currentlisting	: stok_mutasi_DataStore.baseParams.task 
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				Ext.MessageBox.hide();
				
				win = window.open('./print/stok_mutasi_printlist.html','stok_mutasilist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');

				break;
		  	default:
				Ext.MessageBox.show({
					title: 'Warning',
					msg: 'Tidak bisa mencetak data!',
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
			   msg: 'Tidak bisa terhubung dengan database server',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});		
		} 	                     
		});
	}
	/* Enf Function */
	
	/* Function for print Export to Excel Grid */
	function stok_mutasi_export_excel(){
		var searchquery = "";
		var produk_id_2excel=null;
		var produk_nama_2excel=null;
		var satuan_id_2excel=null;
		var satuan_nama_2excel=null;
		var stok_saldo_2excel=null;
		var win;              
		// check if we do have some search data...
		if(stok_mutasi_DataStore.baseParams.query!==null){searchquery = stok_mutasi_DataStore.baseParams.query;}
		if(stok_mutasi_DataStore.baseParams.produk_id!==null){produk_id_2excel = stok_mutasi_DataStore.baseParams.produk_id;}
		if(stok_mutasi_DataStore.baseParams.produk_nama!==null){produk_nama_2excel = stok_mutasi_DataStore.baseParams.produk_nama;}
		if(stok_mutasi_DataStore.baseParams.satuan_id!==null){satuan_id_2excel = stok_mutasi_DataStore.baseParams.satuan_id;}
		if(stok_mutasi_DataStore.baseParams.satuan_nama!==null){satuan_nama_2excel = stok_mutasi_DataStore.baseParams.satuan_nama;}
		if(stok_mutasi_DataStore.baseParams.stok_saldo!==null){stok_saldo_2excel = stok_mutasi_DataStore.baseParams.stok_saldo;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_stok_mutasi&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			produk_id : produk_id_2excel,
			produk_nama : produk_nama_2excel,
			satuan_id : satuan_id_2excel,
			satuan_nama : satuan_nama_2excel,
			stok_saldo : stok_saldo_2excel,
		  	currentlisting: stok_mutasi_DataStore.baseParams.task // this tells us if we are searching or not
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
					msg: 'Tidak bisa meng-export data ke dalam format excel!',
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
			   msg: 'Tidak bisa terhubung dengan database server',
			   buttons: Ext.MessageBox.OK,
			   animEl: 'database',
			   icon: Ext.MessageBox.ERROR
			});    
		} 	                     
		});
	}
	/*End of Function */
	stok_mutasi_DataStore.on('beforeload', function(){
		Ext.MessageBox.show({
		   msg: 'Sedang memproses data, mohon tunggu...',
		   progressText: 'proses...',
		   width:350,
		   wait:true
		});												
	});
	
	stok_mutasi_DataStore.on('load', function(){ Ext.MessageBox.hide(); });
	
	stok_mutasi_searchWindow.show();
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_stok_mutasi"></div>
         <div id="fp_vu_stok_mutasi"></div>
		<div id="elwindow_stok_mutasi_save"></div>
        <div id="elwindow_stok_mutasi_search"></div>
    </div>
</div>
</body>
</html>