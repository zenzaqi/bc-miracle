<?
/* 
	+ Module  		: Laporan Tindakan Dokter View
	+ Description	: For record view
	+ Filename 		: v_lap_jum_tindakan_all_dokter.php
 	+ Author  		: Fred
	
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
var report_tindakan_allDataStore;
var report_tindakan_allColumnModel;
var report_tindakan_allListEditorGrid;
var report_tindakan_all_searchForm;
var report_tindakan_all_searchWindow;
var report_tindakan_allSelectedRow;
var report_tindakan_allContextMenu;

var today=new Date().format('d-m-Y');
var yesterday=new Date().add(Date.DAY, -1).format('Y-m-d');
var thismonth=new Date().format('m');
var thisyear=new Date().format('Y');

//declare konstant
var post2db = '';
var msg = '';
var pageS_alldr=250;

/* declare variable here for Field*/
//var report_tindakan_idField;
var report_tindakan_all_idSearchField;
var report_tindakan_all_groupbyField;

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

	function is_report_tindakan_searchform_valid(){
		return (Ext.getCmp('report_tindakan_all_tglStartSearchField').isValid());
	}

	Ext.util.Format.comboRenderer = function(combo){
		return function(value){
			var record = combo.findRecord(combo.valueField, value);
			return record ? record.get(combo.displayField) : combo.valueNotFoundText;
		}
	}
  
	/* Function for Retrieve DataStore */
	report_tindakan_allDataStore = new Ext.data.Store({
		id: 'report_tindakan_allDataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_lap_jum_tindakan_all_dokter&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST",start:0,limit:pageS_alldr, trawat_dokter : 0}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'dtrawat_id'
		},[
		/* dataIndex => insert intoreport_tindakanColumnModel, Mapping => for initiate table column */ 
			{name: 'dtrawat_date_create', type: 'date', dateFormat: 'Y-m-d H:i:s', mapping: 'dtrawat_date_create'},
			{name: 'tindakan_dokter', type: 'string', mapping: 'karyawan_username'}, 
			{name: 'tindakan_perawatan', type: 'string', mapping: 'rawat_nama'},
			{name: 'rawat_kode', type: 'string', mapping: 'rawat_kode'},
			{name: 'dtrawat_id', type: 'int', mapping: 'dtrawat_id'},
			{name: 'dtrawat_edit', type: 'string', mapping: 'Jumlah_rawat'},
			{name: 'dtrawat_skredit', type: 'string', mapping: 'rawat_kredit'},
			{name: 'dtrawat_skreditrp', type: 'string', mapping: 'rawat_kreditrp'},
			{name: 'dtrawat_jkredit', type: 'string', mapping: 'Total_kredit'},
			{name: 'dtrawat_jkreditrp', type: 'string', mapping: 'Total_kreditrp'},
			{name: 'tjt_ref0', type: 'int', mapping: 'tjt_ref0'},
			{name: 'tjt_ref1', type: 'int', mapping: 'tjt_ref1'},
			{name: 'tjt_ref2', type: 'int', mapping: 'tjt_ref2'},
			{name: 'tjt_ref3', type: 'int', mapping: 'tjt_ref3'},
			{name: 'tjt_ref4', type: 'int', mapping: 'tjt_ref4'},
			{name: 'tjt_ref5', type: 'int', mapping: 'tjt_ref5'},
			{name: 'tjt_ref6', type: 'int', mapping: 'tjt_ref6'},
			{name: 'tjt_ref7', type: 'int', mapping: 'tjt_ref7'},
			{name: 'tjt_ref8', type: 'int', mapping: 'tjt_ref8'},
			{name: 'tjt_ref9', type: 'int', mapping: 'tjt_ref9'},
			{name: 'tjt_ref10', type: 'int', mapping: 'tjt_ref10'},
			{name: 'tjt_ref11', type: 'int', mapping: 'tjt_ref11'},
			{name: 'tjt_ref12', type: 'int', mapping: 'tjt_ref12'},
			{name: 'tjt_ref13', type: 'int', mapping: 'tjt_ref13'},
			{name: 'tjt_ref14', type: 'int', mapping: 'tjt_ref14'},
		]),
		sortInfo:{field: 'tindakan_dokter', direction: "DESC"}
	});
	/* End of Function */
	
   
	/* Function for Identify of Window Column Model */
	report_tindakan_allColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: '<div align="center">' + 'Kode' + '</div>',
			dataIndex: 'rawat_kode',
			width: 100,//185,	//210,
			sortable: true,
		}, 
		{
			header: '<div align="center">' + 'Perawatan' + '</div>',
			dataIndex: 'tindakan_perawatan',
			width: 260,//185,	//210,
			sortable: true,
		}, 
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 1' + '</div>',
			dataIndex: 'tjt_ref0',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 2' + '</div>',
			dataIndex: 'tjt_ref1',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 3' + '</div>',
			dataIndex: 'tjt_ref2',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 4' + '</div>',
			dataIndex: 'tjt_ref3',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 5' + '</div>',
			dataIndex: 'tjt_ref4',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 6' + '</div>',
			dataIndex: 'tjt_ref5',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 7' + '</div>',
			dataIndex: 'tjt_ref6',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 8' + '</div>',
			dataIndex: 'tjt_ref7',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 9' + '</div>',
			dataIndex: 'tjt_ref8',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 10' + '</div>',
			dataIndex: 'tjt_ref9',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 11' + '</div>',
			dataIndex: 'tjt_ref10',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 12' + '</div>',
			dataIndex: 'tjt_ref11',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 13' + '</div>',
			dataIndex: 'tjt_ref12',
			width: 70,	//55,
			sortable: false
		},
		{
			align : 'Right',
			header: '<div align="left">' + 'Dokter 14' + '</div>',
			dataIndex: 'tjt_ref13',
			width: 70,	//55,
			sortable: false
		},
		
	]);
	
	report_tindakan_allColumnModel.defaultSortable= true;
	/* End of Function */
	
	/* Declare DataStore and  show datagrid list */
	report_tindakan_allListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'report_tindakan_allListEditorGrid',
		el: 'fp_report_tindakan_all',
		title: 'Laporan Jumlah Tindakan Semua Dokter',
		autoHeight: true,
		store: report_tindakan_allDataStore, // DataStore
		cm: report_tindakan_allColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		//clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 1220, //940,//1200,	//970,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS_alldr,
			disabled:false,
			store: report_tindakan_allDataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Search',
			tooltip: 'Search',
			iconCls:'icon-search',
			handler: display_form_search_window_all
		}, '-', 
			{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			disabled: true,
			handler: report_tindakan_all_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			disabled: true,
			handler: report_tindakan_print  
		}
		]
	});
	report_tindakan_allListEditorGrid.render();
	/* End of DataStore */
	
	
	/* Create Context Menu */
	report_tindakan_allContextMenu = new Ext.menu.Menu({
		id: '',
		items: [
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: report_tindakan_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: report_tindakan_all_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onreport_tindakan_allListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		report_tindakan_allContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		report_tindakan_allSelectedRow=rowIndex;
		report_tindakan_allContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
		
	report_tindakan_allListEditorGrid.addListener('rowcontextmenu', onreport_tindakan_allListEditGridContextMenu);
	//report_tindakan_allDataStore.load({params: {start: 0, limit: pageS_alldr}});	// load DataStore
	//report_tindakan_allListEditorGrid.on('afteredit', tindakan_medis_update); // inLine Editing Record
	
	var checkColumn = new Ext.grid.CheckColumn({
		header: 'Ambil Paket',
		dataIndex: 'dtrawat_ambil_paket',
		hidden: true,
		width: 75
	});
	
	function headerSettingLabel(daftarNamaDokter){
	//alert('here');
	
		var i=2;
		daftarNamaDokter.each(function(nama){
		//alert(nama.get("karyawan_nama"));
			report_tindakan_allColumnModel.setColumnHeader(i, '<div align="left">' + nama.get("karyawan_username") + '</div>');
			i++;
		});
	}
	/* Function for action list search */
	function report_tindakan_search(){
		// render according to a SQL date format.
		if(is_report_tindakan_searchform_valid())
		{
		var report_tindakan_id_search=null;
		var report_tindakan_tgl_start_search=null;
		var report_tindakan_tgl_end_search=null;
		var report_tindakan_groupby_search=null;
		var report_tindakan_tmedis_bulan=null;
		var report_tindakan_tmedis_tahun=null;
		var report_tindakan_tmedis_periode=null;

		if(report_tindakan_all_idSearchField.getValue()!==null){report_tindakan_id_search=report_tindakan_all_idSearchField.getValue();}
		if(report_tindakan_all_bulanField.getValue()!==null){report_tindakan_tmedis_bulan=report_tindakan_all_bulanField.getValue();}
		if(report_tindakan_all_tahunField.getValue()!==null){report_tindakan_tmedis_tahun=report_tindakan_all_tahunField.getValue();}
		if(Ext.getCmp('report_tindakan_all_tglStartSearchField').getValue()!==null){report_tindakan_tgl_start_search=Ext.getCmp('report_tindakan_all_tglStartSearchField').getValue().format('Y-m-d');}
		if(Ext.getCmp('report_tindakan_all_tglEndSearchField').getValue()!==null){report_tindakan_tgl_end_search=Ext.getCmp('report_tindakan_all_tglEndSearchField').getValue().format('Y-m-d');}
		if(report_tindakan_all_groupbyField.getValue()!==null){report_tindakan_groupby_search=report_tindakan_all_groupbyField.getValue();}
		
		if(report_tindakan_all_opsitglField.getValue()==true){
			report_tindakan_tmedis_periode='tanggal';
		}else if(report_tindakan_all_opsiblnField.getValue()==true){
			report_tindakan_tmedis_periode='bulan';
		}else{
			report_tindakan_tmedis_periode='all';
		}
				
		// change the store parameters
		
		report_tindakan_allDataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			report_tindakan_id	:	report_tindakan_id_search, 
			trawat_tglapp_start	: 	report_tindakan_tgl_start_search,
			trawat_tglapp_end	: 	report_tindakan_tgl_end_search,
			report_groupby	:	report_tindakan_groupby_search,
			bulan		: report_tindakan_tmedis_bulan,
			tahun		: report_tindakan_tmedis_tahun,
			periode		: report_tindakan_tmedis_periode
		};
		
		Ext.MessageBox.show({
		   msg: 'Mohon tunggu...',
		   progressText: 'proses...',
		   width:350,
		   wait:true
		});
		
		report_tindakan_allDataStore.reload({
			params: {start: 0, limit: pageS_alldr},
			callback: function(opts, success, response){
				if(success){
					Ext.MessageBox.hide();
				}
			}
		});
			
		var daftarNamaDokter = new Ext.data.JsonStore({
				url: 'index.php?c=c_lap_jum_tindakan_all_dokter&m=get_action',
				baseParams:{
					task: 'LIST_DOKTER',
					method: 'POST',
					//variable here
					report_tindakan_id	: report_tindakan_id_search, 
					trawat_tglapp_start	: report_tindakan_tgl_start_search,
					trawat_tglapp_end	: report_tindakan_tgl_end_search,
					report_groupby		: report_tindakan_groupby_search,
					bulan				: report_tindakan_tmedis_bulan,
					tahun				: report_tindakan_tmedis_tahun,
					periode				: report_tindakan_tmedis_periode,
					start:0,
					limit:pageS_alldr
				},
				root: 'results',
				fields: [
					{name: 'dokter_id', mapping: 'dokter_id'},
					{name:'karyawan_nama', mapping:'karyawan_nama'},
					{name:'karyawan_username', mapping:'karyawan_username'}
				],
				listeners: {
				load: headerSettingLabel
				}	
			});
			daftarNamaDokter.load();
		
		
		
		}
		else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Tanggal atau Dokter belum diisi',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
		
	/* Field for search */
	/* Identify  report_tindakan_id Search Field */
	report_tindakan_all_idSearchField= new Ext.form.NumberField({
		id: 'report_tindakan_all_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});

	/* Identify  Group_byField*/
	report_tindakan_all_groupbyField= new Ext.form.ComboBox({
		id: 'report_tindakan_all_groupbyField',
		fieldLabel: 'Group By',
		store:new Ext.data.SimpleStore({
			fields:['group_value', 'group_display'],
			data:[['Perawatan','Penjualan Perawatan Satuan'],['Pengambilan_Paket','Pengambilan Paket'],['Semua','Semua']]
		}),
		mode: 'local',
		editable:false,
		emptyText: 'Semua',
		displayField: 'group_display',
		valueField: 'group_value',
		width: 200,
		triggerAction: 'all'	
	});
	

	/////tgl n bulan
	report_tindakan_all_opsitglField=new Ext.form.Radio({
		id:'report_tindakan_all_opsitglField',
		boxLabel:'Tanggal',
		width:100,
		name: 'filter_opsi',
		checked: true
	});
	
	report_tindakan_all_opsiblnField=new Ext.form.Radio({
		id:'report_tindakan_all_opsiblnField',
		boxLabel:'Bulan',
		width:100,
		name: 'filter_opsi'
	});
	
	report_tindakan_all_tglStartSearchField= new Ext.form.DateField({
		id: 'report_tindakan_all_tglStartSearchField',
		fieldLabel: ' ',
		format : 'Y-m-d',
		name: 'report_tindakan_all_tglStartSearchField',
        //vtype: 'daterange',
		allowBlank: true,
		width: 100,
        //endDateField: 'report_tindakan_tglakhirField'
		value: today
	});
	
	report_tindakan_all_tglEndSearchField= new Ext.form.DateField({
		id: 'report_tindakan_all_tglEndSearchField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'report_tindakan_all_tglEndSearchField',
        //vtype: 'daterange',
		allowBlank: true,
		width: 100,
        //startDateField: 'report_tindakan_tglawalField',
		value: today
	});
	
	report_tindakan_all_bulanField=new Ext.form.ComboBox({
		id:'report_tindakan_all_bulanField',
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
	
	report_tindakan_all_tahunField=new Ext.form.ComboBox({
		id:'report_tindakan_all_tahunField',
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
	
	var report_tindakan_all_periodeField=new Ext.form.FieldSet({
		id:'report_tindakan_all_periodeField',
		title : 'Periode',
		layout: 'form',
		bodyStyle:'padding: 0px 0px 0',
		frame: false,
		bolder: false,
		anchor: '98%',
		items:[/*{
				layout: 'column',
				border: false,
				items:[report_tindakan_opsiallField]
			},*/{
				layout: 'column',
				border: false,
				items:[report_tindakan_all_opsitglField, {
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							items:[report_tindakan_all_tglStartSearchField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[report_tindakan_all_tglEndSearchField]
					   }]
			},{
				layout: 'column',
				border: false,
				items:[report_tindakan_all_opsiblnField,{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							items:[report_tindakan_all_bulanField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[report_tindakan_all_tahunField]
					   }]
			}]
	});
	//// end of tgl n bulan
	var dt = new Date(); 
	
	/* Function for retrieve search Form Panel */
	report_tindakan_all_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 400,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [report_tindakan_all_periodeField, report_tindakan_all_groupbyField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: report_tindakan_search
			},{
				text: 'Close',
				handler: function(){
					report_tindakan_all_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
    
	function report_tindakan_reset_formSearch(){
		report_tindakan_all_idSearchField.reset();
		report_tindakan_all_idSearchField.setValue(null);
		report_tindakan_all_groupbyField.reset();
		report_tindakan_all_groupbyField.setValue('Semua');
		Ext.getCmp('report_tindakan_all_tglStartSearchField').reset();
		Ext.getCmp('report_tindakan_all_tglStartSearchField').setValue(today);
		Ext.getCmp('report_tindakan_all_tglEndSearchField').reset();
		Ext.getCmp('report_tindakan_all_tglEndSearchField').setValue(today);
	}
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	report_tindakan_all_searchWindow = new Ext.Window({
		title: 'Pencarian Jumlah Tindakan Semua Dokter',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_report_tindakan_all_search',
		items: report_tindakan_all_searchForm
	});
    /* End of Function */ 

	report_tindakan_all_searchWindow.show();
	
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window_all(){
		if(!report_tindakan_all_searchWindow.isVisible()){
			report_tindakan_reset_formSearch();
			report_tindakan_all_searchWindow.show();

		} else {
			report_tindakan_all_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	function is_valid_form(){
		if(report_tindakan_all_opsitglField.getValue()==true){
			report_tindakan_all_tglStartSearchField.allowBlank=false;
			report_tindakan_all_tglEndSearchField.allowBlank=false;
			if(report_tindakan_all_tglStartSearchField.isValid() && report_tindakan_all_tglEndSearchField.isValid())
				return true;
			else
				return false;
		}else{
			report_tindakan_all_tglStartSearchField.allowBlank=true;
			report_tindakan_all_tglEndSearchField.allowBlank=true;
			return true;
		}
	}

	/* Function for print List Grid */
	function report_tindakan_print(){
		var searchquery = "";
		var trawat_cust_print=null;
		var win;              
		var report_tindakan_tgl_start_print=null;
		var report_tindakan_tgl_end_print=null;
		var report_tindakan_dokter_print=null;
		var report_tindakan_groupby_print=null;
		var report_tindakan_tmedis_bulan=null;
		var report_tindakan_tmedis_tahun=null;
		var report_tindakan_tmedis_periode=null;
		
		// check if we do have some search data...
		if(report_tindakan_allDataStore.baseParams.query!==null){searchquery = report_tindakan_allDataStore.baseParams.query;}
		if(report_tindakan_allDataStore.baseParams.trawat_cust!==null){trawat_cust_print = report_tindakan_allDataStore.baseParams.trawat_cust;}
		if(Ext.getCmp('report_tindakan_all_tglStartSearchField').getValue()!==null){report_tindakan_tgl_start_print=Ext.getCmp('report_tindakan_all_tglStartSearchField').getValue();}
		if(Ext.getCmp('report_tindakan_all_tglEndSearchField').getValue()!==null){report_tindakan_tgl_end_print=Ext.getCmp('report_tindakan_all_tglEndSearchField').getValue();}
		if(report_tindakan_all_groupbyField.getValue()!==null){report_tindakan_groupby_print=report_tindakan_all_groupbyField.getValue();}
		if(report_tindakan_all_bulanField.getValue()!==null){report_tindakan_tmedis_bulan=report_tindakan_all_bulanField.getValue();}
		if(report_tindakan_all_tahunField.getValue()!==null){report_tindakan_tmedis_tahun=report_tindakan_all_tahunField.getValue();}
		
		if(report_tindakan_all_opsitglField.getValue()==true){
			report_tindakan_tmedis_periode='tanggal';
		}else if(report_tindakan_all_opsiblnField.getValue()==true){
			report_tindakan_tmedis_periode='bulan';
		}else{
			report_tindakan_tmedis_periode='all';
		}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_lap_jum_tindakan_all_dokter&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_tglapp_start	: 	report_tindakan_tgl_start_print,
			trawat_tglapp_end	: 	report_tindakan_tgl_end_print,
			trawat_dokter	:	report_tindakan_dokter_print,
			report_groupby	:	report_tindakan_groupby_print,
			bulan		: report_tindakan_tmedis_bulan,
			tahun		: report_tindakan_tmedis_tahun,
			periode		: report_tindakan_tmedis_periode,
		  	currentlisting: report_tindakan_allDataStore.baseParams.task // this tells us if we are searching or not
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
	function report_tindakan_all_export_excel(){
		var searchquery = "";
		var tindakan_dokter_2excel=null;
		var rawat_kode_2excel=null;
		var tindakan_perawatan_2excel=null;
		var dtrawat_edit_2excel=null;
		var dtrawat_skredit_2excel=null;
		var dtrawat_jkredit_2excel=null;
		//var dtrawat_kredit_2excel=null;
		
		var report_tindakan_tgl_start_search=null;
		var report_tindakan_tgl_end_search=null;
		var report_tindakan_groupby_search=null;
		var report_tindakan_tmedis_bulan=null;
		var report_tindakan_tmedis_tahun=null;
		var report_tindakan_tmedis_periode=null;
		
		var win;              
		// check if we do have some search data...
		if(report_tindakan_allDataStore.baseParams.query!==null){searchquery = report_tindakan_allDataStore.baseParams.query;}
		if(report_tindakan_all_bulanField.getValue()!==null){report_tindakan_tmedis_bulan=report_tindakan_all_bulanField.getValue();}
		if(report_tindakan_all_tahunField.getValue()!==null){report_tindakan_tmedis_tahun=report_tindakan_all_tahunField.getValue();}
		
		if(Ext.getCmp('report_tindakan_all_tglStartSearchField').getValue()!==null){report_tindakan_tgl_start_search=Ext.getCmp('report_tindakan_all_tglStartSearchField').getValue();}
		if(Ext.getCmp('report_tindakan_all_tglEndSearchField').getValue()!==null){report_tindakan_tgl_end_search=Ext.getCmp('report_tindakan_all_tglEndSearchField').getValue();}
		if(report_tindakan_all_groupbyField.getValue()!==null){report_tindakan_groupby_search=report_tindakan_all_groupbyField.getValue();}
		
		if(report_tindakan_all_opsitglField.getValue()==true){
			report_tindakan_tmedis_periode='tanggal';
		}else if(report_tindakan_all_opsiblnField.getValue()==true){
			report_tindakan_tmedis_periode='bulan';
		}else{
			report_tindakan_tmedis_periode='all';
		}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_lap_jum_tindakan_all_dokter&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			trawat_tglapp_start	: 	report_tindakan_tgl_start_search,
			trawat_tglapp_end	: 	report_tindakan_tgl_end_search,
			report_groupby	:	report_tindakan_groupby_search,
		  	currentlisting: report_tindakan_allDataStore.baseParams.task, // this tells us if we are searching or not
			bulan		: report_tindakan_tmedis_bulan,
			tahun		: report_tindakan_tmedis_tahun,
			periode		: report_tindakan_tmedis_periode
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
	
	report_tindakan_all_opsitglField.on("check",function(){
		if(report_tindakan_all_opsitglField.getValue()==true){
			report_tindakan_all_tglStartSearchField.allowBlank=false;
			report_tindakan_all_tglEndSearchField.allowBlank=false;
		}else{
			report_tindakan_all_tglStartSearchField.allowBlank=true;
			report_tindakan_all_tglEndSearchField.allowBlank=true;
		}
		
	});
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_report_tindakan_all"></div>
        <div id="elwindow_report_tindakan_all_search"></div>
    </div>
</div>
</body>