<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan View
	+ Description	: For record view
	+ Filename 		: v_tindakan.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 14:21:34
	
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
var lap_kunjunganDataStore;
var lap_totalkunjungan_DataStore;
var lap_kunjunganColumnModel;
var lap_totalkunjungan_nonColumnModel;
var lap_kunjunganListEditorGrid;
var lap_kunjunganListEditorGrid2;
var lap_kunjungan_searchForm;
var lap_kunjungan_searchWindow;
var lap_kunjunganSelectedRow;
var lap_kunjunganContextMenu;
//for detail data
var lap_kunjungan_detail_DataStore;
var lap_kunjungandetailListEditorGrid;
var lap_kunjungan_detail_proxy;
var lap_kunjungan_detail_writer;

var today=new Date().format('d-m-Y');

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
//var lap_kunjungan_idField;
var lap_kunjungan_idSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */

	function is_lap_kunjungan_searchForm_valid(){
		return (Ext.getCmp('lap_kunjungan_tglStartSearchField').isValid());
	}

	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
  
	/* Function for Retrieve DataStore */
	lap_kunjunganDataStore = new Ext.data.Store({
		id: 'lap_kunjunganDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_lap_kunjungan&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			//id: 'dtrawat_id'
		},[
		/* dataIndex => insert intolap_kunjunganColumnModel, Mapping => for initiate table column */ 
			{name: 'tgl_tindakan', type: 'date', dateFormat: 'Y-m-d', mapping: 'tgl_tindakan'},
			{name: 'tindakan_dokter', type: 'string', mapping: 'karyawan_username'}, 
			{name: 'tindakan_perawatan', type: 'string', mapping: 'rawat_nama'},
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'},
			{name: 'dtrawat_edit', type: 'string', mapping: 'Jumlah_rawat'},
			{name: 'dtrawat_skredit', type: 'string', mapping: 'rawat_kredit'},
			{name: 'jumlah_cust', type: 'int', mapping: 'count(distinct cust)'}
		]),
		sortInfo:{field: 'tindakan_dokter', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for summary kredit data store */ 
	lap_totalkunjungan_DataStore = new Ext.data.Store({
		id: 'lap_totalkunjungan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_lap_kunjungan&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST2",start:0,limit:pageS}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			
		},[
		/* dataIndex => insert intolap_kunjunganColumnModel, Mapping => for initiate table column */ 
			{name: 'dtrawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_date_create'},
			{name: 'tindakan_dokter', type: 'string', mapping: 'karyawan_username'}, 
			{name: 'tindakan_perawatan', type: 'string', mapping: 'rawat_nama'},
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'},
			{name: 'dtrawat_edit', type: 'string', mapping: 'Jumlah_rawat'},
			{name: 'dtrawat_skredit', type: 'string', mapping: 'rawat_kredit'},
			{name: 'jumlah_cust', type: 'int', mapping: 'count(distinct cust)'},
			{name: 'dtrawat_kredit', type: 'int', mapping: 'total_cust'},
		]),
		sortInfo:{field: 'tindakan_dokter', direction: "DESC"}
	});
	/* End of Function */
	
	/*cbo_dtindakan_dokterDataStore = new Ext.data.Store({
		id: 'cbo_dtindakan_dokterDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_lap_kunjungan&m=get_dokter_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
		},[
		/* dataIndex => insert intotbl_usersColumnModel, Mapping => for initiate table column 
			{name: 'karyawan_display', type: 'string', mapping: 'karyawan_nama'},
			{name: 'karyawan_username', type: 'string', mapping: 'karyawan_username'},
			{name: 'karyawan_value', type: 'int', mapping: 'karyawan_id'},
			{name: 'karyawan_jmltindakan', type: 'int', mapping: 'reportt_jmltindakan'}
		]),
		sortInfo:{field: 'karyawan_display', direction: "ASC"}
	});*/
	var dokter_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{karyawan_username}</b> | {karyawan_display} </span>',
        '</div></tpl>'
    );
    
  	/* Function for Identify of Window Column Model */
	lap_kunjunganColumnModel = new Ext.grid.ColumnModel(
		[
		/*{
			header: '<div align="center">' + 'Dokter' + '</div>',
			dataIndex: 'tindakan_dokter',
			width: 80,
			sortable: true
		}, */
		{
			align : 'Left',
			header: '<div align="center">' + 'Tanggal' + '</div>',
			dataIndex: 'tgl_tindakan',
			width: 80,
			renderer: Ext.util.Format.dateRenderer('d-m-Y'),
			sortable: true
		}, 
		{	
			align : 'Right',
			header: '<div align="center">' + 'Jumlah' + '</div>',
			dataIndex: 'jumlah_cust',
			width: 60,	//55,
			sortable: true
		},
	]);
	
	lap_kunjunganColumnModel.defaultSortable= true;
	/* End of Function */
	 
	lap_totalkunjungan_nonColumnModel = new Ext.grid.ColumnModel(
		[
		{	
			align : 'Right',
			header: '<div align="right">' + 'Total Kunjungan' + '</div>',
			dataIndex: 'jumlah_cust',
			width: 80,	//55,
			sortable: true
		},
		]);
	
	lap_totalkunjungan_nonColumnModel.defaultSortable= true;
	/* End of Function */

	/* Declare DataStore and  show datagrid list */
	lap_kunjunganListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'lap_kunjunganListEditorGrid',
		el: 'fp_lap_kunjungan',
		title: 'Laporan Jumlah Kunjungan',
		autoHeight: true,
		store: lap_kunjunganDataStore, // DataStore
		cm: lap_kunjunganColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 300, //940,//1200,	//970,
		/*bbar: new Ext.PagingToolbar({
			//pageSize: pageS,
			disabled:true,
			store: lap_kunjunganDataStore,
			displayInfo: true
		}),*/
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: lap_lunjungan_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: lap_kunjungan_print  
		}
		]
	});
	lap_kunjunganListEditorGrid.render();
	/* End of DataStore */
	
	lap_kunjunganListEditorGrid2 =  new Ext.grid.EditorGridPanel({
		id: 'lap_kunjunganListEditorGrid2',
		el: 'fp_lap_kunjungan2',
		title: '',
		autoHeight: true,
		store: lap_totalkunjungan_DataStore, // DataStore
		cm: lap_totalkunjungan_nonColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 300, //940,//1200,	//970,
	
		/* Add Control on ToolBar */
	
	});
	lap_kunjunganListEditorGrid2.render();
	
	/* Create Context Menu */
	lap_kunjunganContextMenu = new Ext.menu.Menu({
		id: '',
		items: [
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: lap_kunjungan_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: lap_lunjungan_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onlap_kunjungan_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		lap_kunjunganContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		lap_kunjunganSelectedRow=rowIndex;
		lap_kunjunganContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
		
	lap_kunjunganListEditorGrid.addListener('rowcontextmenu', onlap_kunjungan_ListEditGridContextMenu);
	lap_kunjunganDataStore.load({params: {start: 0, limit: pageS}});
	lap_totalkunjungan_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	//lap_kunjunganListEditorGrid.on('afteredit', tindakan_medis_update); // inLine Editing Record
	
	/*Detail Declaration */	
	/* Function for Retrieve DataStore of detail*/
	lap_kunjungan_detail_DataStore = new Ext.data.Store({
		id: 'lap_kunjungan_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_lap_kunjungan&m=detail_tindakan_detail_list', 
			method: 'POST'
		}),
		//reader: report_tindakan_detail_reader,
		//baseParams:{master_id: lap_kunjungan_idField.getValue()},
		sortInfo:{field: 'dtrawat_id', direction: "ASC"}
	});
	/* End of Function */

	cbo_trawat_rawatDataStore = new Ext.data.Store({
		id: 'cbo_trawat_rawatDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_lap_kunjungan&m=get_tindakan_medis_list', 
			method: 'POST'
		}),baseParams: {start: 0, limit: 15 },
			reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'rawat_id'
		},[
			{name: 'trawat_rawat_value', type: 'int', mapping: 'rawat_id'},
			{name: 'trawat_rawat_harga', type: 'float', mapping: 'rawat_harga'},
			{name: 'trawat_rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'trawat_rawat_group', type: 'string', mapping: 'group_nama'},
			{name: 'trawat_rawat_kategori', type: 'string', mapping: 'kategori_nama'},
			{name: 'trawat_rawat_du', type: 'float', mapping: 'rawat_du'},
			{name: 'trawat_rawat_dm', type: 'float', mapping: 'rawat_dm'},
			{name: 'trawat_rawat_display', type: 'string', mapping: 'rawat_nama'}
		]),
		sortInfo:{field: 'trawat_rawat_display', direction: "ASC"}
	});
	var cbo_trawat_rawat_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span>{trawat_rawat_kode}| <b>{trawat_rawat_display}</b>',
		'</div></tpl>'
    );
	
	var combo_trawat_rawat=new Ext.form.ComboBox({
			//store: trawat_medis_perawatanDataStore,
			mode: 'remote',
			typeAhead: false,
			displayField: 'perawatan_display',
			valueField: 'perawatan_value',
			loadingText: 'Searching...',
			pageSize:10,
			hideTrigger:false,
			//tpl: trawat_rawat_tpl,
			//applyTo: 'search',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			lazyRender:true,
	});
	
	/*var combo_dapp_dokter=new Ext.form.ComboBox({
			//store: cbo_dtindakan_dokterDataStore,
			mode: 'remote',
			displayField: 'karyawan_username',
			valueField: 'karyawan_value',
			tpl: dokter_tpl,
			loadingText: 'Searching...',
			itemSelector: 'div.search-item',
			triggerAction: 'all',
			anchor: '95%'
	});*/
	
	var checkColumn = new Ext.grid.CheckColumn({
		header: 'Ambil Paket',
		dataIndex: 'dtrawat_ambil_paket',
		hidden: true,
		width: 75
	});
	
	//declaration of detail coloumn model
	tindakan_medisdetail_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Status' + '</div>',
			dataIndex: 'dtrawat_status',
			width: 80,	//100,
			sortable: true,
			editable:false,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['dtrawat_status_value', 'dtrawat_status_display'],
					data: [['batal','batal'],['selesai','selesai'],['datang','datang']]
					}),
				mode: 'local',
               	displayField: 'dtrawat_status_display',
               	valueField: 'dtrawat_status_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		},
	checkColumn]
	);
	tindakan_medisdetail_ColumnModel.defaultSortable= true;
	//eof
	
	//declaration of detail list editor grid
	lap_kunjungandetailListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'lap_kunjungandetailListEditorGrid',
		el: 'fp_lap_kunjungan_detail',
		title: 'Detail Tindakan Medis',
		height: 200,
		width: 888,
		autoScroll: true,
		store: lap_kunjungan_detail_DataStore, // DataStore
		colModel: tindakan_medisdetail_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [checkColumn],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},

		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: tindakan_medisdetail_confirm_delete
		}
		]
	});
	//eof
	
	//function for refresh detail
	function refresh_tindakan_medisdetail(){

	}
	//eof

	/* Function for Delete Confirm of detail */
	function tindakan_medisdetail_confirm_delete(){
		// only one record is selected here
		if(lap_kunjungandetailListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', tindakan_medisdetail_delete);
		} else if(lap_kunjungandetailListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', tindakan_medisdetail_delete);
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'You can\'t really delete something you haven\'t selected?',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}

	/* START JUAL DETAIL_NON-MEDIS */
	/*Detail Declaration */
		
	// Function for json reader of detail
	var dtindakan_jual_nonmedis_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'}, 
			{name: 'dtrawat_master', type: 'int', mapping: 'dtrawat_master'}, 
			{name: 'dtrawat_perawatan', type: 'int', mapping: 'dtrawat_perawatan'}, 
			{name: 'dtrawat_petugas1', type: 'int', mapping: 'dtrawat_petugas1'}, 
			{name: 'dtrawat_petugas2', type: 'int', mapping: 'dtrawat_petugas2'}, 
			{name: 'dtrawat_jam', type: 'string', mapping: 'dtrawat_jam'}, 
			{name: 'dtrawat_kategori', type: 'string', mapping: 'dtrawat_kategori'}, 
			{name: 'dtrawat_status', type: 'string', mapping: 'dtrawat_status'},
			{name: 'dtrawat_keterangan', type: 'string', mapping: 'dtrawat_keterangan'} 
	]);
	//eof
	
	//function for json writer of detail
	var dtindakan_jual_nonmedis_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	dtindakan_jual_nonmedisDataStore = new Ext.data.Store({
		id: 'dtindakan_jual_nonmedisDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_lap_kunjungan&m=dtindakan_jual_nonmedis_list', 
			method: 'POST'
		}),
		reader: dtindakan_jual_nonmedis_reader,
		//baseParams:{master_id: lap_kunjungan_idField.getValue()},
		sortInfo:{field: 'dtrawat_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_dtindakan_jual_nonmedis= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	var terapis_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>{dtrawat_karyawan_username}</b> | {dtrawat_karyawan_display} | <b>{dtrawat_karyawan_jmltindakan}</b></span>',
        '</div></tpl>'
    );
	
	//declaration of detail coloumn model
	tindakan_nonmedis_detailColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'dtrawat_perawatan',
			width: 290,
			sortable: true
		},

		{
			header: '<div align="center">' + 'Detail Keterangan' + '</div>',
			dataIndex: 'dtrawat_keterangan',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250,
			})
		}]
	);
	tindakan_nonmedis_detailColumnModel.defaultSortable= true;
	//eof

	/* Function for action list search */
	function lap_kunjungan_search(){
		// render according to a SQL date format.
		
		if(is_lap_kunjungan_searchForm_valid())
		{
		var lap_kunjungan_id_search=null;
		var lap_kunjungan_tgl_start_search=null;
		var lap_kunjungan_tgl_end_search=null;
		//var report_tindakan_dokter_search=null;

		if(lap_kunjungan_idSearchField.getValue()!==null){lap_kunjungan_id_search=lap_kunjungan_idSearchField.getValue();}
		if(Ext.getCmp('lap_kunjungan_tglStartSearchField').getValue()!==null){lap_kunjungan_tgl_start_search=Ext.getCmp('lap_kunjungan_tglStartSearchField').getValue();}
		if(Ext.getCmp('lap_kunjungan_tglEndSearchField').getValue()!==null){lap_kunjungan_tgl_end_search=Ext.getCmp('lap_kunjungan_tglEndSearchField').getValue();}
		//if(report_tindakan_dokterSearchField.getValue()!==null){report_tindakan_dokter_search=report_tindakan_dokterSearchField.getValue();}
		// change the store parameters
		lap_kunjunganDataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			lap_kunjungan_id	:	lap_kunjungan_id_search, 
			trawat_tglapp_start	: 	lap_kunjungan_tgl_start_search,
			trawat_tglapp_end	: 	lap_kunjungan_tgl_end_search
			//trawat_dokter	:	report_tindakan_dokter_search,
		};
		lap_totalkunjungan_DataStore.baseParams = {
			task: 'SEARCH2',
			//variable here
			lap_kunjungan_id	:	lap_kunjungan_id_search, 
			trawat_tglapp_start	: 	lap_kunjungan_tgl_start_search,
			trawat_tglapp_end	: 	lap_kunjungan_tgl_end_search
			//trawat_dokter	:	report_tindakan_dokter_search,
		};
		// Cause the datastore to do another query : 
		lap_kunjunganDataStore.reload({params: {start: 0, limit: pageS}});
		lap_totalkunjungan_DataStore.reload({params: {start: 0, limit: pageS}});
		}
		else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Tanggal belum diisi',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
		
	/* Field for search */
	/* Identify  lap_kunjungan_id Search Field */
	lap_kunjungan_idSearchField= new Ext.form.NumberField({
		id: 'lap_kunjungan_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});

	/*report_tindakan_dokterSearchField= new Ext.form.ComboBox({
		fieldLabel: 'Dokter',
		//store: cbo_dtindakan_dokterDataStore,
		mode: 'remote',
		displayField:'karyawan_username',
		valueField: 'karyawan_username',
        typeAhead: false,
        loadingText: 'Searching...',
        pageSize:10,
        hideTrigger:false,
        tpl: dokter_tpl,
        //applyTo: 'search',
        itemSelector: 'div.search-item',
		triggerAction: 'all',
		lazyRender:true,
		listClass: 'x-combo-list-small',
		allowBlank: false,
		width: 214
	});*/

	var dt = new Date(); 
	
	/* Function for retrieve search Form Panel */
	lap_kunjungan_searchForm = new Ext.FormPanel({
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
									fieldLabel: 'Tanggal',
							        name: 'lap_kunjungan_tglStartSearchField',
							        id: 'lap_kunjungan_tglStartSearchField',
									vtype: 'daterange',
									allowBlank: false,
									format: 'd-m-Y',
							        endDateField: 'lap_kunjungan_tglEndSearchField' // id of the end date field Ext.getCmp('lap_kunjungan_tglStartSearchField').isValid()
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
							        name: 'lap_kunjungan_tglEndSearchField',
							        id: 'lap_kunjungan_tglEndSearchField',
							        vtype: 'daterange',
									allowBlank: false,
									format: 'd-m-Y',
							        startDateField: 'lap_kunjungan_tglStartSearchField' // id of the end date field
							    }] 
						}]}
						] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: lap_kunjungan_search
			},{
				text: 'Close',
				handler: function(){
					lap_kunjungan_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
    
	function lap_kunjungan_reset_formSearch(){
		lap_kunjungan_idSearchField.reset();
		lap_kunjungan_idSearchField.setValue(null);
		Ext.getCmp('lap_kunjungan_tglStartSearchField').reset();
		Ext.getCmp('lap_kunjungan_tglStartSearchField').setValue(null);
		Ext.getCmp('lap_kunjungan_tglEndSearchField').reset();
		Ext.getCmp('lap_kunjungan_tglEndSearchField').setValue(today);
	}
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	lap_kunjungan_searchWindow = new Ext.Window({
		title: 'Pencarian Jumlah Kunjungan',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_lap_kunjungan_search',
		items: lap_kunjungan_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!lap_kunjungan_searchWindow.isVisible()){
			lap_kunjungan_reset_formSearch();
			lap_kunjungan_searchWindow.show();
		} else {
			lap_kunjungan_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function lap_kunjungan_print(){
		var searchquery = "";
		var trawat_cust_print=null;
		var trawat_keterangan_print=null;
		var win;              
		// check if we do have some search data...
		if(lap_kunjunganDataStore.baseParams.query!==null){searchquery = lap_kunjunganDataStore.baseParams.query;}
		if(lap_kunjunganDataStore.baseParams.trawat_cust!==null){trawat_cust_print = lap_kunjunganDataStore.baseParams.trawat_cust;}
		if(lap_kunjunganDataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_print = lap_kunjunganDataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_lap_kunjungan&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_print,
			trawat_keterangan : trawat_keterangan_print,
		  	currentlisting: lap_kunjunganDataStore.baseParams.task // this tells us if we are searching or not
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
	function lap_lunjungan_export_excel(){
		var searchquery = "";
		var tindakan_dokter_2excel=null;
		var win;              
		// check if we do have some search data...
		if(lap_kunjunganDataStore.baseParams.query!==null){searchquery = lap_kunjunganDataStore.baseParams.query;}
		if(lap_kunjunganDataStore.baseParams.trawat_dokter!==null){tindakan_dokter_2excel = lap_kunjunganDataStore.baseParams.trawat_dokter;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_lap_kunjungan&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_dokter : tindakan_dokter_2excel,
		  	currentlisting: lap_kunjunganDataStore.baseParams.task // this tells us if we are searching or not
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
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_lap_kunjungan"></div>
		 <div id="fp_lap_kunjungan2"></div>
         <div id="fp_lap_kunjungan_detail"></div>
		 <div id="fp_dlap_kunjungan"></div>
		<div id="elwindow_lap_kunjungan_create"></div>
        <div id="elwindow_lap_kunjungan_search"></div>
    </div>
</div>
</body>