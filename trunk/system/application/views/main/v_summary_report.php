<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	
	+ Description	: For record view
	+ Filename 		: v_summary_report.php
 	+ Author  		: Freddy

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
var summary_reportDataStore;
//var lap_totalkunjungan_DataStore;
var lap_kunjunganColumnModel;
//var lap_totalkunjungan_nonColumnModel;
//var lap_averageColumnModel;
var lap_kunjunganListEditorGrid;
//var lap_kunjunganListEditorGrid2;
var lap_kunjungan_averageListEditorGrid;
var lap_kunjungan_searchForm;
var summary_report_searchWindow;
var lap_kunjunganSelectedRow;
var lap_kunjunganContextMenu;
//for detail data
var lap_kunjungan_detail_DataStore;
var lap_kunjungan_detail_proxy;
var lap_kunjungan_detail_writer;

var today=new Date().format('d-m-Y');
var thismonth=new Date().format('m');
var bulanlalu=new Date().add(Date.MONTH, -1).format('m');
var thisyear=new Date().format('Y');
var tahunlalu=new Date().add(Date.YEAR, -1).format('Y');

//declare konstant
var post2db = '';
var msg = '';
var pageS=31;

/* declare variable here for Field*/
//var lap_kunjungan_idSearchField;

<?
$tahun="[";
for($i=(date('Y')-4);$i<=date('Y');$i++){
	$tahun.="['$i'],";
}
$tahun=substr($tahun,0,strlen($tahun)-1);
$tahun.="]";
$bulan="";
?>

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */

	function is_summary_report_searchForm_valid(){
		//return (lap_kunjungan_tglStartSearchField.isValid()) && (lap_kunjungan_tglEndSearchField.isValid());
		return (summary_report_bulantujuanField.isValid()) && (summary_report_tahuntujuanField.isValid()
		&& summary_report_bulanpembanding1Field.isValid()) && (summary_report_tahunpembanding1Field.isValid());
	}

	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
  
	/* Function for Retrieve DataStore */
	summary_reportDataStore = new Ext.data.Store({
		id: 'summary_reportDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_summary_report&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:31}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			//id: 'dtrawat_id'
		},[
			{name: 'summary_jenis', type: 'string', mapping: 'jenis'},
			{name: 'summary_nilai_tujuan', type: 'int', mapping: 'nilai_tujuan'},
			{name: 'summary_nilai_target', type: 'int', mapping: 'target'},
			{name: 'summary_rata_rata', type: 'int', mapping: 'rata_rata'},
			{name: 'summary_pencapaian', type: 'float', mapping: 'pencapaian_target'},
			{name: 'summary_pembanding1', type: 'int', mapping: 'nilai_pembanding1'},
			{name: 'summary_naikturun1', type: 'int', mapping: 'naik_turun1'},
			{name: 'summary_prosentase1', type: 'float', mapping: 'prosentase_naik_turun1'},
			{name: 'summary_pembanding2', type: 'int', mapping: 'nilai_pembanding2'},
			{name: 'summary_naikturun2', type: 'int', mapping: 'naik_turun2'},
			{name: 'summary_prosentase2', type: 'float', mapping: 'prosentase_naik_turun2'}
		])
		//sortInfo:{field: 'tgl_tindakan', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for summary kredit data store */ 
	/*
	lap_totalkunjungan_DataStore = new Ext.data.Store({
		id: 'lap_totalkunjungan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_summary_report&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST2",start:0,limit:31}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			
		},[
		/* dataIndex => insert intolap_kunjunganColumnModel, Mapping => for initiate table column */ 
		/*
			{name: 'dtrawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_date_create'},
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'},
			{name: 'jum_total', type: 'int', mapping: 'sum(jum_total)'},
			{name: 'jum_cust_medis', type: 'int', mapping: 'sum(jum_cust_medis)'},
			{name: 'jum_cust_surgery', type: 'int', mapping: 'sum(jum_cust_surgery)'},
			{name: 'jum_cust_antiaging', type: 'int', mapping: 'sum(jum_cust_antiaging)'},
			{name: 'jum_cust_nonmedis', type: 'int', mapping: 'sum(jum_cust_nonmedis)'},
			{name: 'jum_cust_produk', type: 'int', mapping: 'sum(jum_cust_produk)'}
		])
		//sortInfo:{field: 'tindakan_dokter', direction: "DESC"}
	});
	/* End of Function */
	
	/* Function for average  data store */ 
	/*
	lap_average_kunjungan_DataStore = new Ext.data.Store({
		id: 'lap_average_kunjungan_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_summary_report&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST3",start:0,limit:31}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total'
			
		},[
		/* dataIndex => insert intolap_kunjunganColumnModel, Mapping => for initiate table column */ 
		/*
			{name: 'dtrawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_date_create'},
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'},
			{name: 'avg_jum_total', type: 'float', mapping: 'sum(jum_total)/count(distinct tgl_tindakan)'},
			{name: 'avg_jum_cust_medis', type: 'float', mapping: 'sum(jum_cust_medis)/count(distinct tgl_tindakan)'},
			{name: 'avg_jum_cust_surgery', type: 'float', mapping: 'sum(jum_cust_surgery)/count(distinct tgl_tindakan)'},
			{name: 'avg_jum_cust_antiaging', type: 'float', mapping: 'sum(jum_cust_antiaging)/count(distinct tgl_tindakan)'},
			{name: 'avg_jum_cust_nonmedis', type: 'float', mapping: 'sum(jum_cust_nonmedis)/count(distinct tgl_tindakan)'},
			{name: 'avg_jum_cust_produk', type: 'float', mapping: 'sum(jum_cust_produk)/count(distinct tgl_tindakan)'}
		])
		//sortInfo:{field: 'tindakan_dokter', direction: "DESC"}
	});
	/* End of Function */
	

  	/* Function for Identify of Window Column Model */
	lap_kunjunganColumnModel = new Ext.grid.ColumnModel(
		[
		{
			align : 'Left',
			header: '<div align="center">' + 'Target' + '</div>',
			dataIndex: 'summary_jenis',
			width: 100,	//55,
			sortable: true
		}, 
		{	
			align : 'Right',
			header: '<div align="center">' + 'Nilai Target' + '</div>',
			dataIndex: 'summary_nilai_target',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Mar 2011' + '</div>', //'<div align="center">' + 'Nilai Tujuan' + '</div>',
			dataIndex: 'summary_nilai_tujuan',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Rata-rata' + '</div>', //'<div align="center">' + 'Rata-rata Tujuan' + '</div>',
			dataIndex: 'summary_rata_rata',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Penc. Trgt (%)' + '</div>',
			dataIndex: 'summary_pencapaian',
			width: 50,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0.00')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Nilai Pemb. 1' + '</div>',
			dataIndex: 'summary_pembanding1',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Selisih Pemb. 1' + '</div>',
			dataIndex: 'summary_naikturun1',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Slsh. Pemb. 1 (%)' + '</div>',
			dataIndex: 'summary_prosentase1',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0.00')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Nilai Pemb. 2' + '</div>',
			dataIndex: 'summary_pembanding2',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Selisih Pemb. 2' + '</div>',
			dataIndex: 'summary_naikturun2',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0,000')+'</span>';
			}
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Slsh. Pemb. 2 (%)' + '</div>',
			dataIndex: 'summary_prosentase2',
			width: 60,	//55,
			sortable: true,
			renderer: function(val){
				return '<span>'+Ext.util.Format.number(val,'0.00')+'</span>';
			}
		}
		/*
		{	
			align : 'Right',
			header: '<div align="center">' + 'Total' + '</div>',
			tooltip: 'Jumlah ini TIDAK SELALU sama dengan Medis+nonMedis+Produk',
			dataIndex: 'jum_total',
			width: 80,	//55,
			sortable: true
		}
		*/
	]);
	
	lap_kunjunganColumnModel.defaultSortable= true;
	/* End of Function */
	/* 
	lap_totalkunjungan_nonColumnModel = new Ext.grid.ColumnModel(
		[
		{	
			align : 'Right',
			header: '<div align="center">' + '<span style="font-weight:bold">Grand Total</span>' + '</div>',
			dataIndex: '',
			//hidden : true,
			disabled : false,
			width: 100,	//55,
			//sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Medis' + '</div>',
			dataIndex: 'jum_cust_medis',
			width: 80,	//55,
			sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Surgery' + '</div>',
			dataIndex: 'jum_cust_surgery',
			width: 80,	//55,
			sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Anti Aging' + '</div>',
			dataIndex: 'jum_cust_antiaging',
			width: 80,	//55,
			sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Non Medis' + '</div>',
			dataIndex: 'jum_cust_nonmedis',
			width: 80,	//55,
			sortable: true
		},
		
		{	
			align : 'Right',
			header: '<div align="center">' + 'Produk' + '</div>',
			dataIndex: 'jum_cust_produk',
			width: 80,	//55,
			sortable: true
		},
		
		{	
			align : 'Right',
			header: '<div align="center">' + 'Grand Total' + '</div>',
			dataIndex: 'jum_total',
			width: 80,	//55,
			sortable: true
		},
		]);
	
	lap_totalkunjungan_nonColumnModel.defaultSortable= true;
	*/
	/*
	lap_averageColumnModel = new Ext.grid.ColumnModel(
		[
		{	
			align : 'Right',
			header: '<div align="center">' + '<span style="font-weight:bold">Average</span>' + '</div>',
			dataIndex: '',
			//hidden : true,
			disabled : false,
			width: 100,	//55,
			//sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Medis' + '</div>',
			dataIndex: 'avg_jum_cust_medis',
			width: 80,	//55,
			sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Surgery' + '</div>',
			dataIndex: 'avg_jum_cust_surgery',
			width: 80,	//55,
			sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Anti Aging' + '</div>',
			dataIndex: 'avg_jum_cust_antiaging',
			width: 80,	//55,
			sortable: true
		},
		{	
			align : 'Right',
			header: '<div align="center">' + 'Non Medis' + '</div>',
			dataIndex: 'avg_jum_cust_nonmedis',
			width: 80,	//55,
			sortable: true
		},
		
		{	
			align : 'Right',
			header: '<div align="center">' + 'Produk' + '</div>',
			dataIndex: 'avg_jum_cust_produk',
			width: 80,	//55,
			sortable: true
		},
		
		{	
			align : 'Right',
			header: '<div align="center">' + 'Average' + '</div>',
			dataIndex: 'avg_jum_total',
			width: 80,	//55,
			sortable: true
		},
		]);
	
	lap_averageColumnModel.defaultSortable= true;
	*/
	
	
	/* End of Function */

	/* Declare DataStore and  show datagrid list */
	lap_kunjunganListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'lap_kunjunganListEditorGrid',
		el: 'fp_lap_kunjungan',
		title: 'Summary Report',
		autoHeight: true,
		store: summary_reportDataStore, // DataStore
		cm: lap_kunjunganColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220, //940,//1200,	//970,
		/*
		bbar: new Ext.PagingToolbar({
			//pageSize: pageS,
			disabled:true,
			store: summary_reportDataStore,
			displayInfo: true
		}),
		*/
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Input Periode',
			tooltip: 'Tombol untuk memasukkan periode Summary Report',
			//iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			{
			text: 'Generate Summary Report',
			tooltip: 'Tombol untuk menampilkan Summary Report',
			//iconCls:'icon-xls',
			//disabled : true,
			handler: lap_lunjungan_export_excel
		}, '-', 
			{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			disabled : true,
			handler: lap_lunjungan_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			disabled : true,
			handler: lap_kunjungan_print  
		}
		]
	});
	lap_kunjunganListEditorGrid.render();
	/* End of DataStore */
	
	/*
	lap_kunjunganListEditorGrid2 =  new Ext.grid.EditorGridPanel({
		id: 'lap_kunjunganListEditorGrid2',
		el: 'fp_lap_kunjungan2',
		title: '',
		autoHeight: true,
		store: lap_totalkunjungan_DataStore, // DataStore
		cm: lap_totalkunjungan_nonColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 600,
	
		/* Add Control on ToolBar */
	/*
	});
	lap_kunjunganListEditorGrid2.render();
	/*
	
	lap_kunjungan_averageListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'lap_kunjungan_averageListEditorGrid',
		el: 'fp_lap_kunjungan_average',
		title: '',
		autoHeight: true,
		store: lap_average_kunjungan_DataStore, // DataStore
		cm: lap_averageColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 600, 

	});
	lap_kunjungan_averageListEditorGrid.render();
	
	
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
	summary_reportDataStore.load({params: {start: 0, limit: 31}});
	//lap_totalkunjungan_DataStore.load({params: {start: 0, limit: 31}});	// load DataStore
	//lap_average_kunjungan_DataStore.load({params: {start: 0, limit: 31}});	// load DataStore
	//lap_kunjunganListEditorGrid.on('afteredit', tindakan_medis_update); // inLine Editing Record
	
	/*Detail Declaration */	
	/* Function for Retrieve DataStore of detail*/
	lap_kunjungan_detail_DataStore = new Ext.data.Store({
		id: 'lap_kunjungan_detail_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_summary_report&m=detail_tindakan_detail_list', 
			method: 'POST'
		}),
		//reader: report_tindakan_detail_reader,
		//baseParams:{master_id: lap_kunjungan_idField.getValue()},
		sortInfo:{field: 'dtrawat_id', direction: "ASC"}
	});
	/* End of Function */

	/* Function for action list search */
	function summary_report_search(){
		// render according to a SQL date format.
		
		if(is_summary_report_searchForm_valid())
		{
		/*
		var lap_kunjungan_id_search=null;
		var lap_kunjungan_tgl_start_search=null;
		var lap_kunjungan_tgl_end_search=null;
		var lap_kunjungan_kelamin_search=null;
		var lap_kunjungan_member_search=null;
		var lap_kunjungan_cust_search=null;
		var lap_kunjungan_umurstart_search=null;
		var lap_kunjungan_umurend_search=null;
		var lap_kunjungan_tgllahir_search_date="";
		var lap_kunjungan_tgllahir_search_dateEnd="";
		*/
		var summary_report_bulantujuan_search=null;
		var summary_report_tahuntujuan_search=null;
		var summary_report_bulanpembanding1_search=null;
		var summary_report_tahunpembanding1_search=null;
		var summary_report_bulanpembanding2_search=null;
		var summary_report_tahunpembanding2_search=null;
		
		//var report_tindakan_dokter_search=null;
		//if(lap_kunjungan_memberSearchField.getValue()!==null){lap_kunjungan_member_search=lap_kunjungan_memberSearchField.getValue();}
		//if(lap_kunjungan_custSearchField.getValue()!==null){lap_kunjungan_cust_search=lap_kunjungan_custSearchField.getValue();}
		//if(lap_kunjungan_idSearchField.getValue()!==null){lap_kunjungan_id_search=lap_kunjungan_idSearchField.getValue();}
		//if(lap_kunjungan_kelaminSearchField.getValue()!==null){lap_kunjungan_kelamin_search=lap_kunjungan_kelaminSearchField.getValue();}
		//if(lap_kunjungan_tglStartSearchField.getValue()!==null){lap_kunjungan_tgl_start_search=lap_kunjungan_tglStartSearchField.getValue();}
		if(summary_report_bulantujuanField.getValue()!==null){summary_report_bulantujuan_search=summary_report_bulantujuanField.getValue();}
		if(summary_report_tahuntujuanField.getValue()!==null){summary_report_tahuntujuan_search=summary_report_tahuntujuanField.getValue();}
		if(summary_report_bulanpembanding1Field.getValue()!==null){summary_report_bulanpembanding1_search=summary_report_bulanpembanding1Field.getValue();}
		if(summary_report_tahunpembanding1Field.getValue()!==null){summary_report_tahunpembanding1_search=summary_report_tahunpembanding1Field.getValue();}
		if(summary_report_bulanpembanding2Field.getValue()!==null){summary_report_bulanpembanding2_search=summary_report_bulanpembanding2Field.getValue();}
		if(summary_report_tahunpembanding2Field.getValue()!==null){summary_report_tahunpembanding2_search=summary_report_tahunpembanding2Field.getValue();}
		
		//if(lap_kunjungan_tglEndSearchField.getValue()!==null){lap_kunjungan_tgl_end_search=lap_kunjungan_tglEndSearchField.getValue();}
		//if(lap_kunjungan_umurstartSearchField.getValue()!==null){lap_kunjungan_umurstart_search=lap_kunjungan_umurstartSearchField.getValue();}
		//if(lap_kunjungan_umurendSearchField.getValue()!==null){lap_kunjungan_umurend_search=lap_kunjungan_umurendSearchField.getValue();}	
		//if(lap_kunjungan_tgllahirSearchField.getValue()!==""){lap_kunjungan_tgllahir_search_date=lap_kunjungan_tgllahirSearchField.getValue().format('Y-m-d');}
		//if(lap_kunjungan_tgllahirSearchFieldEnd.getValue()!==""){lap_kunjungan_tgllahir_search_dateEnd=lap_kunjungan_tgllahirSearchFieldEnd.getValue().format('Y-m-d');}

		// change the store parameters
		summary_reportDataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			summary_report_bulantujuan 		: summary_report_bulantujuan_search,
			summary_report_tahuntujuan		: summary_report_tahuntujuan_search,
			summary_report_bulanpembanding1	: summary_report_bulanpembanding1_search,
			summary_report_tahunpembanding1	: summary_report_tahunpembanding1_search,
			summary_report_bulanpembanding2	: summary_report_bulanpembanding2_search,
			summary_report_tahunpembanding2	: summary_report_tahunpembanding2_search,
			/*
			lap_kunjungan_id	:	lap_kunjungan_id_search, 
			trawat_tglapp_start	: 	lap_kunjungan_tgl_start_search,
			trawat_tglapp_end	: 	lap_kunjungan_tgl_end_search,
			lap_kunjungan_kelamin : lap_kunjungan_kelamin_search,
			lap_kunjungan_member : lap_kunjungan_member_search,
			lap_kunjungan_cust : lap_kunjungan_cust_search,
			lap_kunjungan_umurstart : lap_kunjungan_umurstart_search,
			lap_kunjungan_umurend : lap_kunjungan_umurend_search,
			lap_kunjungan_tgllahir	:	lap_kunjungan_tgllahir_search_date, 
			lap_kunjungan_tgllahirend	:	lap_kunjungan_tgllahir_search_dateEnd 
			//trawat_dokter	:	report_tindakan_dokter_search,
			*/
		}
		/*
		lap_totalkunjungan_DataStore.baseParams = {
			task: 'SEARCH2',
			//variable here
			lap_kunjungan_id	:	lap_kunjungan_id_search, 
			trawat_tglapp_start	: 	lap_kunjungan_tgl_start_search,
			trawat_tglapp_end	: 	lap_kunjungan_tgl_end_search,
			lap_kunjungan_kelamin : lap_kunjungan_kelamin_search,
			lap_kunjungan_member : lap_kunjungan_member_search,
			lap_kunjungan_cust : lap_kunjungan_cust_search,
			lap_kunjungan_umurstart : lap_kunjungan_umurstart_search,
			lap_kunjungan_umurend : lap_kunjungan_umurend_search,
			lap_kunjungan_tgllahir	:	lap_kunjungan_tgllahir_search_date, 
			lap_kunjungan_tgllahirend	:	lap_kunjungan_tgllahir_search_dateEnd 
			//trawat_dokter	:	report_tindakan_dokter_search,
		};
		lap_average_kunjungan_DataStore.baseParams = {
			task: 'SEARCH3',
			//variable here
			lap_kunjungan_id	:	lap_kunjungan_id_search, 
			trawat_tglapp_start	: 	lap_kunjungan_tgl_start_search,
			trawat_tglapp_end	: 	lap_kunjungan_tgl_end_search,
			lap_kunjungan_kelamin : lap_kunjungan_kelamin_search,
			lap_kunjungan_member : lap_kunjungan_member_search,
			lap_kunjungan_cust : lap_kunjungan_cust_search,
			lap_kunjungan_umurstart : lap_kunjungan_umurstart_search,
			lap_kunjungan_umurend : lap_kunjungan_umurend_search,
			lap_kunjungan_tgllahir	:	lap_kunjungan_tgllahir_search_date, 
			lap_kunjungan_tgllahirend	:	lap_kunjungan_tgllahir_search_dateEnd 		
			//trawat_dokter	:	report_tindakan_dokter_search,
		};
		*/
		
		// Cause the datastore to do another query : 
		summary_reportDataStore.reload({params: {start: 0, limit: 31}});
		//lap_totalkunjungan_DataStore.reload({params: {start: 0, limit: 31}});
		//lap_average_kunjungan_DataStore.reload({params: {start: 0, limit: 31}});
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
	/*
	lap_kunjungan_idSearchField= new Ext.form.NumberField({
		id: 'lap_kunjungan_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	*/

	var dt = new Date(); 
	
	/* Identify  lap_kunjungan_kelamin Field */
	/*
	lap_kunjungan_kelaminSearchField= new Ext.form.ComboBox({
		id: 'lap_kunjungan_kelaminSearchField',
		fieldLabel: 'Jenis Kelamin',
		store:new Ext.data.SimpleStore({
			fields:['lap_kunjungan_kelamin_value', 'lap_kunjungan_kelamin_display'],
			data:[['L','Laki-laki'],['P','Perempuan'],['S','Semua']]
		}),
		mode: 'local',
		blankText:'Semua',
		displayField: 'lap_kunjungan_kelamin_display',
		valueField: 'lap_kunjungan_kelamin_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	*/
	
	/* Identify  lap_kunjungan_member Field */
	/*
	lap_kunjungan_memberSearchField= new Ext.form.ComboBox({
		id: 'lap_kunjungan_memberSearchField',
		fieldLabel: 'Member',
		maxLength: 50,
		store:new Ext.data.SimpleStore({
			fields:['lap_kunjungan_member_value', 'lap_kunjungan_member_display'],
			data: [['Lama','Lama'],['Baru','Baru'],['Non Member','Non Member'],['Semua','Semua']]
		}),
		mode: 'local',
		displayField: 'lap_kunjungan_member_display',
		valueField: 'lap_kunjungan_member_value',
		anchor: '95%',
		triggerAction: 'all'
	});
	*/
	
	/*
	lap_kunjungan_tgllahirSearchField= new Ext.form.DateField({
		id: 'lap_kunjungan_tgllahirSearchField',
		fieldLabel : 'Antara Tanggal',
		format: 'd-m-Y'
	});
	
	lap_kunjungan_tgllahirSearchFieldEnd= new Ext.form.DateField({
		fieldLabel: 's/d',
		id: 'lap_kunjungan_tgllahirSearchFieldEnd',
		format: 'd-m-Y'
	});
	*/
	
	/*
	lap_kunjungan_tanggal_opsiSearchField=new Ext.form.FieldSet({
		id:'lap_kunjungan_tanggal_opsiSearchField',
		title: 'Tanggal Lahir',
		layout: 'column',
		boduStyle: 'padding: 5px;',
		anchor: '95%',
		items:[{
				layout: 'column',
				border: false,
				items:[{
					   		layout: 'form',
							border: false,
							bodyStyle:'padding:3px',
							items:[lap_kunjungan_tgllahirSearchField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[lap_kunjungan_tgllahirSearchFieldEnd]
					   }]
			}]
	});
	*/
	
	/* Identify  umur Field */
	/*
	lap_kunjungan_umurstartSearchField= new Ext.form.TextField({
		id: 'lap_kunjungan_umurstartSearchField',
		fieldLabel: 'Umur',
		maxLength: 10,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	*/
	/* Identify  batas umur Field */
	/*
	lap_kunjungan_umurendSearchField= new Ext.form.TextField({
		id: 'lap_kunjungan_umurendSearchField',
		//fieldLabel: 'Telp. Rumah 2',
		hideLabel:true,
		maxLength: 10,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	*/
	/*
	lap_kunjungan_label_umurSearchField=new Ext.form.Label({ html: ' &nbsp; s/d  &nbsp;'});
	lap_kunjungan_label_thncustSearchField=new Ext.form.Label({ html: ' &nbsp; tahun'});
	lap_kunjungan_umur_groupSearch = new Ext.form.FieldSet({
		title: 'Umur',
		labelWidth: 100,
		anchor: '95%',
		layout:'column',
		items: [lap_kunjungan_umurstartSearchField, lap_kunjungan_label_umurSearchField, lap_kunjungan_umurendSearchField,lap_kunjungan_label_thncustSearchField]

	});
	*/
	
	/* Identify  lap_kunjungan_cust Field */
	/*
	lap_kunjungan_custSearchField= new Ext.form.ComboBox({
		id: 'lap_kunjungan_custSearchField',
		fieldLabel: 'Customer',
		maxLength: 50,
		store:new Ext.data.SimpleStore({
			fields:['lap_kunjungan_cust_value', 'lap_kunjungan_cust_display'],
			data: [['Lama','Lama'],['Baru','Baru'],['Semua','Semua']]
		}),
		mode: 'local',
		displayField: 'lap_kunjungan_cust_display',
		valueField: 'lap_kunjungan_cust_value',
		anchor: '95%',
		triggerAction: 'all'
	});
	*/
	
	////
	/*
	lap_kunjungan_tglStartSearchField= new Ext.form.DateField({
		id: 'lap_kunjungan_tglStartSearchField',
		fieldLabel : 'Antara Tanggal',
		format: 'd-m-Y'
	});
	*/
	/*
	lap_kunjungan_tglEndSearchField= new Ext.form.DateField({
		fieldLabel: 's/d',
		id: 'lap_kunjungan_tglEndSearchField',
		format: 'd-m-Y'
	});
	*/
	
	summary_report_bulantujuanField=new Ext.form.ComboBox({
		id:'summary_report_bulantujuanField',
		fieldLabel:'Bulan Tujuan',
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
	summary_report_tahuntujuanField=new Ext.form.ComboBox({
		id:'summary_report_tahuntujuanField',
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
	
	summary_report_bulanpembanding1Field=new Ext.form.ComboBox({
		id:'summary_report_bulanpembanding1Field',
		fieldLabel:'Bulan Pembanding 1',
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
	
	summary_report_tahunpembanding1Field=new Ext.form.ComboBox({
		id:'summary_report_tahunpembanding1Field',
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
	
	summary_report_bulanpembanding2Field=new Ext.form.ComboBox({
		id:'summary_report_bulanpembanding2Field',
		fieldLabel:'Bulan Pembanding 2',
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
	
	summary_report_tahunpembanding2Field=new Ext.form.ComboBox({
		id:'summary_report_tahunpembanding2Field',
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
	
	summary_report_bulanSearchField=new Ext.form.FieldSet({
		id:'summary_report_bulanSearchField',
		title: 'Bulan Summary Report',
		layout: 'form',
		boduStyle: 'padding: 5px;',
		anchor: '100%',
		items:[{
				layout: 'column',
				border: false,
				items:[{
					   		layout: 'form',
							border: false,
							labelWidth: 90,
							bodyStyle:'padding:3px',
							items:[summary_report_bulantujuanField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[summary_report_tahuntujuanField]
					   }]
				},{
				layout: 'column',
				border: false,
				items:[{
					   		layout: 'form',
							border: false,
							labelWidth: 90,
							bodyStyle:'padding:3px',
							items:[summary_report_bulanpembanding1Field]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[summary_report_tahunpembanding1Field]
					   }]
				},{
				layout: 'column',
				border: false,
				items:[{
					   		layout: 'form',
							border: false,
							labelWidth: 90,
							bodyStyle:'padding:3px',
							items:[summary_report_bulanpembanding2Field]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[summary_report_tahunpembanding2Field]
					   }]
				}
				/*
				layout: 'form',
				border: false,
				items:[ summary_report_bulantujuanField, summary_report_tahuntujuanField, summary_report_bulanpembanding1Field, summary_report_bulanpembanding2Field
					   
							layout: 'form',
							border: false,
							//labelWidth: 15,
							bodyStyle:'padding:3px',
							//items:[lap_kunjungan_tglStartSearchField summary_report_bulantujuanField]
							items:[summary_report_bulantujuanField, summary_report_bulanpembanding1Field]
					   }
					   ,{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							//items:[lap_kunjungan_tglEndSearchField summary_report_bulanpembanding1Field]
							items:[summary_report_bulanpembanding1Field]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							//items:[lap_kunjungan_tglEndSearchField summary_report_bulanpembanding2Field]
							items:[summary_report_bulanpembanding2Field]
					   }*/
					   
			]
	});
	
	//////
	
	/* Function for retrieve search Form Panel */
	lap_kunjungan_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 450,        
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
							columnWidth:1,
							layout: 'form',
							border:false,
							defaultType: 'datefield',
							items: [summary_report_bulanSearchField]
							/*lap_kunjungan_kelaminSearchField,lap_kunjungan_memberSearchField,lap_kunjungan_custSearchField, lap_kunjungan_tanggal_opsiSearchField,lap_kunjungan_umur_groupSearch] 
							*/
						}]}
						] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: summary_report_search
			},{
				text: 'Close',
				handler: function(){
					summary_report_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
    
	function summary_report_reset_formSearch(){
		//lap_kunjungan_idSearchField.reset();
		//lap_kunjungan_kelaminSearchField.reset();
		//lap_kunjungan_kelaminSearchField.setValue('S');
		//lap_kunjungan_memberSearchField.reset();
		//lap_kunjungan_memberSearchField.setValue('Semua');
		//lap_kunjungan_custSearchField.reset();
		//lap_kunjungan_custSearchField.setValue('Semua');
		//lap_kunjungan_idSearchField.setValue(null);
		//lap_kunjungan_tglStartSearchField.reset();
		//lap_kunjungan_tglStartSearchField.setValue(null);
		summary_report_bulantujuanField.reset();
		summary_report_bulantujuanField.setValue(null);
		summary_report_tahuntujuanField.reset();
		summary_report_tahuntujuanField.setValue(null);
		
		summary_report_bulanpembanding1Field.reset();
		summary_report_bulanpembanding1Field.setValue(null);
		summary_report_bulanpembanding1Field.reset();
		summary_report_bulanpembanding1Field.setValue(null);
		
		summary_report_bulanpembanding2Field.reset();
		summary_report_bulanpembanding2Field.setValue(null);
		summary_report_bulanpembanding2Field.reset();
		summary_report_bulanpembanding2Field.setValue(null);
		
		//lap_kunjungan_tglEndSearchField.reset();
		//lap_kunjungan_tglEndSearchField.setValue(today);
		//lap_kunjungan_umurstartSearchField.reset();
		//lap_kunjungan_umurendSearchField.reset();
		//lap_kunjungan_tgllahirSearchField.reset();
		//lap_kunjungan_tgllahirSearchFieldEnd.reset();
	}
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	summary_report_searchWindow = new Ext.Window({
		title: 'Input Periode Summary Report',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_summary_report_search',
		items: lap_kunjungan_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!summary_report_searchWindow.isVisible()){
			summary_report_reset_formSearch();
			summary_report_bulantujuanField.setValue(thismonth);
			summary_report_tahuntujuanField.setValue(thisyear);
			summary_report_bulanpembanding1Field.setValue(bulanlalu);
			summary_report_tahunpembanding1Field.setValue(thisyear);
			summary_report_bulanpembanding2Field.setValue(thismonth);
			summary_report_tahunpembanding2Field.setValue(tahunlalu);
			summary_report_searchWindow.show();
		} else {
			summary_report_searchWindow.toFront();
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
		if(summary_reportDataStore.baseParams.query!==null){searchquery = summary_reportDataStore.baseParams.query;}
		if(summary_reportDataStore.baseParams.trawat_cust!==null){trawat_cust_print = summary_reportDataStore.baseParams.trawat_cust;}
		if(summary_reportDataStore.baseParams.trawat_keterangan!==null){trawat_keterangan_print = summary_reportDataStore.baseParams.trawat_keterangan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_summary_report&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_cust : trawat_cust_print,
			trawat_keterangan : trawat_keterangan_print,
		  	currentlisting: summary_reportDataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./tindakanlist.html','tindakanlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
				
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
	function lap_lunjungan_export_excel(){
		//var searchquery = "";
		//var tindakan_dokter_2excel=null;
		//var win;              
		// check if we do have some search data...
		//if(summary_reportDataStore.baseParams.query!==null){searchquery = summary_reportDataStore.baseParams.query;}
		//if(summary_reportDataStore.baseParams.trawat_dokter!==null){tindakan_dokter_2excel = summary_reportDataStore.baseParams.trawat_dokter;}
		summary_reportDataStore.reload({params: {start: 0, limit: 31}});
		
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_summary_report&m=get_action',
		params: {
			task: "GENERATE",
		  	//query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_dokter : tindakan_dokter_2excel,
		  	currentlisting: summary_reportDataStore.baseParams.task // this tells us if we are searching or not
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
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_lap_kunjungan"></div>
		 <div id="fp_lap_kunjungan2"></div>
		 <div id="fp_lap_kunjungan_average"></div>
         <div id="fp_lap_kunjungan_detail"></div>
		 <div id="fp_dlap_kunjungan"></div>
		<div id="elwindow_lap_kunjungan_create"></div>
        <div id="elwindow_summary_report_search"></div>
    </div>
</div>
</body>