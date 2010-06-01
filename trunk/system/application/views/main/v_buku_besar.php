<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: buku_besar View
	+ Description	: For record view
	+ Filename 		: v_buku_besar.php
 	+ Author  		: 
 	+ Created on 21/Aug/2009 06:51:08
	
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
var buku_besar_DataStore;
var buku_besar_ColumnModel;
var buku_besarListEditorGrid;
var buku_besar_createForm;
var buku_besar_createWindow;
var buku_besar_searchForm;
var buku_besar_searchWindow;
var buku_besar_SelectedRow;
var buku_besar_ContextMenu;
//for detail data
var _DataStor;
var ListEditorGrid;
var _ColumnModel;
var _proxy;
var _writer;
var _reader;
var editor_;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var buku_idField;
var buku_tanggalField;
var buku_akunField;
var buku_debetField;
var buku_kreditField;
var buku_saldo_debetField;
var buku_saldo_kreditField;
var buku_idSearchField;
var buku_tanggalSearchField;
var buku_akunSearchField;
var buku_debetSearchField;
var buku_kreditSearchField;
var buku_saldo_debetSearchField;
var buku_saldo_kreditSearchField;
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
  
  
	/* Function for Retrieve DataStore */
	buku_besar_DataStore = new Ext.data.Store({
		id: 'buku_besar_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_buku_besar&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST", start: 0, limit: pageS, query: null}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'buku_tanggal'
		},[
	
			{name: 'buku_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'buku_tanggal'}, 
			{name: 'buku_akun', type: 'int', mapping: 'buku_akun'},
			{name: 'buku_akun_kode', type: 'string', mapping: 'buku_akun_kode'}, 
			{name: 'buku_akun_nama', type: 'string', mapping: 'buku_akun_nama'}, 
			{name: 'buku_debet', type: 'float', mapping: 'buku_debet'}, 
			{name: 'buku_kredit', type: 'float', mapping: 'buku_kredit'}, 
			{name: 'buku_saldo', type: 'float', mapping: 'buku_saldo'}
		]),
		sortInfo:{field: 'buku_tanggal', direction: "ASC"}
	});
	/* End of Function */
    
	/* Function for Retrieve DataStore */
	buku_akun_DataStore = new Ext.data.Store({
		id: 'buku_akun_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_akun&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'akun_id'
		},[
		/* dataIndex => insert intobuku_besar_ColumnModel, Mapping => for initiate table column */ 
			{name: 'akun_id', type: 'int', mapping: 'akun_id'}, 
			{name: 'akun_kode', type: 'string', mapping: 'akun_kode'}, 
			{name: 'akun_nama', type: 'string', mapping: 'akun_nama'}
		]),
		sortInfo:{field: 'akun_kode', direction: "ASC"}
	});
	/* End of Function */
	
  	/* Function for Identify of Window Column Model */
	buku_besar_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Tanggal',
			dataIndex: 'buku_tanggal',
			width: 150,
			sortable: false,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			readOnly: true
		}, 
		{
			header: 'Kode',
			dataIndex: 'buku_akun_kode',
			width: 100,
			sortable: false,
			readOnly: true
		}, 
		{
			header: 'Akun',
			dataIndex: 'buku_akun_nama',
			width: 250,
			sortable: false,
			readOnly: true
		}, 
		{
			header: 'Debet',
			dataIndex: 'buku_debet',
			width: 150,
			sortable: false,
			readOnly: true
		}, 
		{
			header: 'Kredit',
			dataIndex: 'buku_kredit',
			width: 150,
			sortable: false,
			readOnly: true
		}, 
		{
			header: 'Saldo',
			dataIndex: 'buku_saldo',
			width: 150,
			sortable: false,
			readOnly: true
		}
		]);
	
	buku_besar_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	buku_besarListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'buku_besarListEditorGrid',
		el: 'fp_buku_besar',
		title: 'Buku Besar',
		autoHeight: true,
		store: buku_besar_DataStore, // DataStore
		cm: buku_besar_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: buku_besar_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		},'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: buku_besar_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: buku_besar_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: buku_besar_print  
		}
		]
	});
	buku_besarListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	buku_besar_ContextMenu = new Ext.menu.Menu({
		id: 'buku_besar_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: buku_besar_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: buku_besar_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onbuku_besar_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		buku_besar_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		buku_besar_SelectedRow=rowIndex;
		buku_besar_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function buku_besar_editContextMenu(){
		buku_besarListEditorGrid.startEditing(buku_besar_SelectedRow,1);
  	}
	/* End of Function */
  	
	function buku_besar_update(){
	}
	
	buku_besarListEditorGrid.addListener('rowcontextmenu', onbuku_besar_ListEditGridContextMenu);
	buku_besarListEditorGrid.on('afteredit', buku_besar_update); // inLine Editing Record
	
	function is_valid_form(){
		if(buku_opsitgl_searchField.getValue()==true){
			buku_tglawal_searchField.allowBlank=false;
			buku_tglakhir_searchField.allowBlank=false;
			if(buku_tglawal_searchField.isValid() && buku_tglakhir_searchField.isValid())
				return true;
			else
				return false;
		}else{
			buku_tglawal_searchField.allowBlank=true;
			buku_tglakhir_searchField.allowBlank=true;
			return true;
		}
	}
	
	/* Function for action list search */
	function buku_besar_list_search(){
		// render according to a SQL date format.
		
		if(is_valid_form()){
			
			var buku_tglawal_search="";
			var buku_tglakhir_search="";
			var buku_opsi_search="";
			var buku_bulan_search="";
			var buku_tahun_search="";
			var buku_periode_search="";
			var buku_akun_search=null;
			
			if(buku_opsitgl_searchField.getValue()==true){
				buku_periode_search='tanggal';
			}else if(buku_opsibln_searchField.getValue()==true){
				buku_periode_search='bulan';
			}else{
				buku_periode_search='all';
			}
			
			if(buku_tglawal_searchField.getValue()!==""){order_tglawal_search = buku_tglawal_searchField.getValue().format('Y-m-d');}
			if(buku_tglakhir_searchField.getValue()!==""){order_tglakhir_search = buku_tglakhir_searchField.getValue().format('Y-m-d');}
			if(buku_bulan_searchField.getValue()!==""){order_bulan_search=buku_bulan_searchField.getValue(); }
			if(buku_tahun_searchField.getValue()!==""){order_tahun_search=buku_tahun_searchField.getValue(); }
		
			if(buku_akunSearchField.getValue()!==null){buku_akun_search=buku_akunSearchField.getValue();}
			
			// change the store parameters
			buku_besar_DataStore.baseParams = {
				task			: 'SEARCH',
				buku_periode	: 	buku_periode_search,
				buku_tglawal	:	buku_tglawal_search,
				buku_tglakhir	:	buku_tglakhir_search, 
				buku_bulan		: 	buku_bulan_search,
				buku_tahun		:	buku_tahun_search,
				buku_akun		:	buku_akun_search
			};
			
			buku_besar_DataStore.load({params: {start: 0, limit:pageS, query: null}});
			
		}else{
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'Isian tidak valid',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
		
	/* Function for reset search result */
	function buku_besar_reset_search(){
		// reset the store parameters
		buku_besar_DataStore.baseParams = { task: 'LIST' };
		buku_besar_searchWindow.close();
	};
	/* End of Fuction */
	
	var akun_tpl = new Ext.XTemplate(
        '<tpl for="."><div class="search-item">',
            '<span><b>[{akun_kode}] - {akun_nama}</b></span>',
        '</div></tpl>'
    );
	
	/* Identify  buku_akun Search Field */
	buku_akunSearchField= new Ext.form.ComboBox({
		id: 'buku_akunSearchField',
		fieldLabel: 'Akun',
		store: buku_akun_DataStore,
		mode: 'remote',
		typeAhead: false,
		displayField: 'akun_nama',
		valueField: 'akun_id',
		triggerAction: 'all',
		lazyRender: false,
		pageSize: pageS,
		enableKeyEvents: true,
		tpl: akun_tpl,
		itemSelector: 'div.search-item',
		listClass: 'x-combo-list-small',
		anchor: '95%'
	});
	 
	buku_bulan_searchField=new Ext.form.ComboBox({
		id:'buku_bulan_searchField',
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
	
	buku_tahun_searchField=new Ext.form.ComboBox({
		id:'buku_tahun_searchField',
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
	
	buku_opsitgl_searchField=new Ext.form.Radio({
		id:'buku_opsitgl_searchField',
		boxLabel:'Tanggal',
		width:100,
		name: 'filter_opsi'
	});
	
	buku_opsibln_searchField=new Ext.form.Radio({
		id:'buku_opsibln_searchField',
		boxLabel:'Bulan',
		width:100,
		name: 'filter_opsi'
	});
	
	buku_opsiall_searchField=new Ext.form.Radio({
		id:'buku_opsiall_searchField',
		boxLabel:'Semua',
		name: 'filter_opsi',
		checked: true
	});
	
	buku_tglawal_searchField= new Ext.form.DateField({
		id: 'buku_tglawal_searchField',
		fieldLabel: ' ',
		format : 'Y-m-d',
		name: 'buku_tglawal_searchField',
        vtype: 'daterange',
		allowBlank: true,
		width: 100,
        endDateField: 'buku_tglakhir_searchField'
	});
	
	buku_tglakhir_searchField= new Ext.form.DateField({
		id: 'buku_tglakhir_searchField',
		fieldLabel: 's/d',
		format : 'Y-m-d',
		name: 'buku_tglakhirField',
        vtype: 'daterange',
		allowBlank: true,
		width: 100,
        startDateField: 'buku_tglawal_searchField',
		value: today
	});
	
	
	
	
	var buku_periode_searchField=new Ext.form.FieldSet({
		id:'buku_periode_searchField',
		title : 'Periode',
		layout: 'form',
		bodyStyle:'padding: 0px 0px 0',
		frame: false,
		bolder: false,
		anchor: '98%',
		items:[{
				layout: 'column',
				border: false,
				items:[buku_opsiall_searchField]
			},{
				layout: 'column',
				border: false,
				items:[buku_opsitgl_searchField, {
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							items:[buku_tglawal_searchField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[buku_tglakhir_searchField]
					   }]
			},{
				layout: 'column',
				border: false,
				items:[buku_opsibln_searchField,{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							items:[buku_bulan_searchField]
					   },{
					   		layout: 'form',
							border: false,
							labelWidth: 15,
							bodyStyle:'padding:3px',
							labelSeparator: ' ', 
							items:[buku_tahun_searchField]
					   }]
			}]
	});
	
	
	
	/* Function for retrieve search Form Panel */
	buku_besar_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 400,        
		items: [buku_periode_searchField, buku_akunSearchField],
		buttons: [{
				text: 'Search',
				handler: buku_besar_list_search
			},{
				text: 'Close',
				handler: function(){
					buku_besar_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	buku_besar_searchWindow = new Ext.Window({
		title: 'Buku Besar',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_buku_besar_search',
		items: buku_besar_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!buku_besar_searchWindow.isVisible()){
			buku_besar_searchWindow.show();
		} else {
			buku_besar_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function buku_besar_print(){
		var searchquery = "";
		var win;              
		var buku_tglawal_search="";
		var buku_tglakhir_search="";
		var buku_opsi_search="";
		var buku_bulan_search="";
		var buku_tahun_search="";
		var buku_periode_search="";
		var buku_akun_search=null;
		
		if(buku_opsitgl_searchField.getValue()==true){
			buku_periode_search='tanggal';
		}else if(buku_opsibln_searchField.getValue()==true){
			buku_periode_search='bulan';
		}else{
			buku_periode_search='all';
		}
		
		if(buku_tglawal_searchField.getValue()!==""){order_tglawal_search = buku_tglawal_searchField.getValue().format('Y-m-d');}
		if(buku_tglakhir_searchField.getValue()!==""){order_tglakhir_search = buku_tglakhir_searchField.getValue().format('Y-m-d');}
		if(buku_bulan_searchField.getValue()!==""){order_bulan_search=buku_bulan_searchField.getValue(); }
		if(buku_tahun_searchField.getValue()!==""){order_tahun_search=buku_tahun_searchField.getValue(); }
	
		if(buku_akunSearchField.getValue()!==null){buku_akun_search=buku_akunSearchField.getValue();}
		
	
		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_buku_besar&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,    
			buku_periode		: 	buku_periode_search,
			buku_tglawal	:	buku_tglawal_search,
			buku_tglakhir	:	buku_tglakhir_search, 
			buku_bulan		: 	buku_bulan_search,
			buku_tahun		:	buku_tahun_search,
			buku_akun		:	buku_akun_search
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./buku_besarlist.html','buku_besarlist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function buku_besar_export_excel(){
		var searchquery = "";
		var win;              
		var buku_tglawal_search="";
		var buku_tglakhir_search="";
		var buku_opsi_search="";
		var buku_bulan_search="";
		var buku_tahun_search="";
		var buku_periode_search="";
		var buku_akun_search=null;
		
		if(buku_opsitgl_searchField.getValue()==true){
			buku_periode_search='tanggal';
		}else if(buku_opsibln_searchField.getValue()==true){
			buku_periode_search='bulan';
		}else{
			buku_periode_search='all';
		}
		
		if(buku_tglawal_searchField.getValue()!==""){order_tglawal_search = buku_tglawal_searchField.getValue().format('Y-m-d');}
		if(buku_tglakhir_searchField.getValue()!==""){order_tglakhir_search = buku_tglakhir_searchField.getValue().format('Y-m-d');}
		if(buku_bulan_searchField.getValue()!==""){order_bulan_search=buku_bulan_searchField.getValue(); }
		if(buku_tahun_searchField.getValue()!==""){order_tahun_search=buku_tahun_searchField.getValue(); }
	
		if(buku_akunSearchField.getValue()!==null){buku_akun_search=buku_akunSearchField.getValue();}
		

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_buku_besar&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		
		  	buku_tglawal	:	buku_tglawal_search,
			buku_tglakhir	:	buku_tglakhir_search, 
			buku_bulan		: 	buku_bulan_search,
			buku_tahun		:	buku_tahun_search,
			buku_akun		:	buku_akun_search,
		  	currentlisting: buku_besar_DataStore.baseParams.task 
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
	
	display_form_search_window();
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_buku_besar"></div>
		<div id="elwindow_buku_besar_create"></div>
        <div id="elwindow_buku_besar_search"></div>
    </div>
</div>
</body>