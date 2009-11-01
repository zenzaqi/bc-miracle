<?
/* 	These code was generated using phpCIGen v 0.1.b (1/08/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: anamnesa View
	+ Description	: For record view
	+ Filename 		: v_anamnesa.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:37:33
	
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
var anamnesa_DataStore;
var anamnesa_ColumnModel;
var anamnesaListEditorGrid;
var anamnesa_createForm;
var anamnesa_createWindow;
var anamnesa_searchForm;
var anamnesa_searchWindow;
var anamnesa_SelectedRow;
var anamnesa_ContextMenu;
//for detail data
var anamnesa_problem_DataStor;
var anamnesa_problemListEditorGrid;
var anamnesa_problem_ColumnModel;
var anamnesa_problem_proxy;
var anamnesa_problem_writer;
var anamnesa_problem_reader;
var editor_anamnesa_problem;

//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here for Field*/
var anam_idField;
var anam_custField;
var anam_tanggalField;
var anam_petugasField;
var anam_pengobatanField;
var anam_perawatanField;
var anam_terapiField;
var anam_alergiField;
var anam_obatalergiField;
var anam_efekobatalergiField;
var anam_hamilField;
var anam_kbField;
var anam_harapanField;
var anam_idSearchField;
var anam_custSearchField;
var anam_tanggalSearchField;
var anam_petugasSearchField;
var anam_pengobatanSearchField;
var anam_perawatanSearchField;
var anam_terapiSearchField;
var anam_alergiSearchField;
var anam_obatalergiSearchField;
var anam_efekobatalergiSearchField;
var anam_hamilSearchField;
var anam_kbSearchField;
var anam_harapanSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function anamnesa_update(oGrid_event){
		var anam_id_update_pk="";
		var anam_cust_update=null;
		var anam_tanggal_update_date="";
		var anam_petugas_update=null;
		var anam_pengobatan_update=null;
		var anam_perawatan_update=null;
		var anam_terapi_update=null;
		var anam_alergi_update=null;
		var anam_obatalergi_update=null;
		var anam_efekobatalergi_update=null;
		var anam_hamil_update=null;
		var anam_kb_update=null;
		var anam_harapan_update=null;

		anam_id_update_pk = oGrid_event.record.data.anam_id;
		if(oGrid_event.record.data.anam_cust!== null){anam_cust_update = oGrid_event.record.data.anam_cust;}
	 	if(oGrid_event.record.data.anam_tanggal!== ""){anam_tanggal_update_date =oGrid_event.record.data.anam_tanggal.format('Y-m-d');}
		if(oGrid_event.record.data.anam_petugas!== null){anam_petugas_update = oGrid_event.record.data.anam_petugas;}
		if(oGrid_event.record.data.anam_pengobatan!== null){anam_pengobatan_update = oGrid_event.record.data.anam_pengobatan;}
		if(oGrid_event.record.data.anam_perawatan!== null){anam_perawatan_update = oGrid_event.record.data.anam_perawatan;}
		if(oGrid_event.record.data.anam_terapi!== null){anam_terapi_update = oGrid_event.record.data.anam_terapi;}
		if(oGrid_event.record.data.anam_alergi!== null){anam_alergi_update = oGrid_event.record.data.anam_alergi;}
		if(oGrid_event.record.data.anam_obatalergi!== null){anam_obatalergi_update = oGrid_event.record.data.anam_obatalergi;}
		if(oGrid_event.record.data.anam_efekobatalergi!== null){anam_efekobatalergi_update = oGrid_event.record.data.anam_efekobatalergi;}
		if(oGrid_event.record.data.anam_hamil!== null){anam_hamil_update = oGrid_event.record.data.anam_hamil;}
		if(oGrid_event.record.data.anam_kb!== null){anam_kb_update = oGrid_event.record.data.anam_kb;}
		if(oGrid_event.record.data.anam_harapan!== null){anam_harapan_update = oGrid_event.record.data.anam_harapan;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_anamnesa&m=get_action',
			params: {
				task: "UPDATE",
				anam_id	: anam_id_update_pk, 
				anam_cust	:anam_cust_update,  
				anam_tanggal	: anam_tanggal_update_date, 
				anam_petugas	:anam_petugas_update,  
				anam_pengobatan	:anam_pengobatan_update,  
				anam_perawatan	:anam_perawatan_update,  
				anam_terapi	:anam_terapi_update,  
				anam_alergi	:anam_alergi_update,  
				anam_obatalergi	:anam_obatalergi_update,  
				anam_efekobatalergi	:anam_efekobatalergi_update,  
				anam_hamil	:anam_hamil_update,  
				anam_kb	:anam_kb_update,  
				anam_harapan	:anam_harapan_update,  
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				switch(result){
					case 1:
						anamnesa_DataStore.commitChanges();
						anamnesa_DataStore.reload();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not save the anamnesa.',
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
  	/* End of Function */
  
  	/* Function for add data, open window create form */
	function anamnesa_create(){
	
		if(is_anamnesa_form_valid()){	
		var anam_id_create_pk=null; 
		var anam_cust_create=null; 
		var anam_tanggal_create_date=""; 
		var anam_petugas_create=null; 
		var anam_pengobatan_create=null; 
		var anam_perawatan_create=null; 
		var anam_terapi_create=null; 
		var anam_alergi_create=null; 
		var anam_obatalergi_create=null; 
		var anam_efekobatalergi_create=null; 
		var anam_hamil_create=null; 
		var anam_kb_create=null; 
		var anam_harapan_create=null; 

		if(anam_idField.getValue()!== null){anam_id_create_pk = anam_idField.getValue();}else{anam_id_create_pk=get_pk_id();} 
		if(anam_custField.getValue()!== null){anam_cust_create = anam_custField.getValue();} 
		if(anam_tanggalField.getValue()!== ""){anam_tanggal_create_date = anam_tanggalField.getValue().format('Y-m-d');} 
		if(anam_petugasField.getValue()!== null){anam_petugas_create = anam_petugasField.getValue();} 
		if(anam_pengobatanField.getValue()!== null){anam_pengobatan_create = anam_pengobatanField.getValue();} 
		if(anam_perawatanField.getValue()!== null){anam_perawatan_create = anam_perawatanField.getValue();} 
		if(anam_terapiField.getValue()!== null){anam_terapi_create = anam_terapiField.getValue();} 
		if(anam_alergiField.getValue()!== null){anam_alergi_create = anam_alergiField.getValue();} 
		if(anam_obatalergiField.getValue()!== null){anam_obatalergi_create = anam_obatalergiField.getValue();} 
		if(anam_efekobatalergiField.getValue()!== null){anam_efekobatalergi_create = anam_efekobatalergiField.getValue();} 
		if(anam_hamilField.getValue()!== null){anam_hamil_create = anam_hamilField.getValue();} 
		if(anam_kbField.getValue()!== null){anam_kb_create = anam_kbField.getValue();} 
		if(anam_harapanField.getValue()!== null){anam_harapan_create = anam_harapanField.getValue();} 

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_anamnesa&m=get_action',
			params: {
				task: post2db,
				anam_id	: anam_id_create_pk, 
				anam_cust	: anam_cust_create, 
				anam_tanggal	: anam_tanggal_create_date, 
				anam_petugas	: anam_petugas_create, 
				anam_pengobatan	: anam_pengobatan_create, 
				anam_perawatan	: anam_perawatan_create, 
				anam_terapi	: anam_terapi_create, 
				anam_alergi	: anam_alergi_create, 
				anam_obatalergi	: anam_obatalergi_create, 
				anam_efekobatalergi	: anam_efekobatalergi_create, 
				anam_hamil	: anam_hamil_create, 
				anam_kb	: anam_kb_create, 
				anam_harapan	: anam_harapan_create, 
			}, 
			success: function(response){             
				var result=eval(response.responseText);
				switch(result){
					case 1:
						anamnesa_problem_purge()
						anamnesa_problem_insert();
						Ext.MessageBox.alert(post2db+' OK','The Anamnesa was '+msg+' successfully.');
						anamnesa_DataStore.reload();
						anamnesa_createWindow.hide();
						break;
					default:
						Ext.MessageBox.show({
						   title: 'Warning',
						   msg: 'We could\'t not '+msg+' the Anamnesa.',
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
		if(post2db=='UPDATE')
			return anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function anamnesa_reset_form(){
		anam_idField.reset();
		anam_idField.setValue(null);
		anam_custField.reset();
		anam_custField.setValue(null);
		anam_tanggalField.reset();
		anam_tanggalField.setValue(null);
		anam_petugasField.reset();
		anam_petugasField.setValue(null);
		anam_pengobatanField.reset();
		anam_pengobatanField.setValue(null);
		anam_perawatanField.reset();
		anam_perawatanField.setValue(null);
		anam_terapiField.reset();
		anam_terapiField.setValue(null);
		anam_alergiField.reset();
		anam_alergiField.setValue(null);
		anam_obatalergiField.reset();
		anam_obatalergiField.setValue(null);
		anam_efekobatalergiField.reset();
		anam_efekobatalergiField.setValue(null);
		anam_hamilField.reset();
		anam_hamilField.setValue(null);
		anam_kbField.reset();
		anam_kbField.setValue(null);
		anam_harapanField.reset();
		anam_harapanField.setValue(null);
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function anamnesa_set_form(){
		anam_idField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_id'));
		anam_custField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_cust'));
		anam_tanggalField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_tanggal'));
		anam_petugasField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_petugas'));
		anam_pengobatanField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_pengobatan'));
		anam_perawatanField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_perawatan'));
		anam_terapiField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_terapi'));
		anam_alergiField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_alergi'));
		anam_obatalergiField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_obatalergi'));
		anam_efekobatalergiField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_efekobatalergi'));
		anam_hamilField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_hamil'));
		anam_kbField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_kb'));
		anam_harapanField.setValue(anamnesaListEditorGrid.getSelectionModel().getSelected().get('anam_harapan'));
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_anamnesa_form_valid(){
		return (true &&  anam_custField.isValid() && anam_tanggalField.isValid() && true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true &&  true  );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!anamnesa_createWindow.isVisible()){
			anamnesa_reset_form();
			post2db='CREATE';
			msg='created';
			anamnesa_createWindow.show();
		} else {
			anamnesa_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function anamnesa_confirm_delete(){
		// only one anamnesa is selected here
		if(anamnesaListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', anamnesa_delete);
		} else if(anamnesaListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', anamnesa_delete);
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
  	/* End of Function */
  
	/* Function for Update Confirm */
	function anamnesa_confirm_update(){
		/* only one record is selected here */
		if(anamnesaListEditorGrid.selModel.getCount() == 1) {
			anamnesa_set_form();
			post2db='UPDATE';
			anamnesa_problem_DataStore.load({params : {master_id : eval(get_pk_id()), start:0, limit:pageS}});
			msg='updated';
			anamnesa_createWindow.show();
		} else {
			Ext.MessageBox.show({
				title: 'Warning',
				msg: 'You can\'t really update something you haven\'t selected?',
				buttons: Ext.MessageBox.OK,
				animEl: 'save',
				icon: Ext.MessageBox.WARNING
			});
		}
	}
  	/* End of Function */
  
  	/* Function for Delete Record */
	function anamnesa_delete(btn){
		if(btn=='yes'){
			var selections = anamnesaListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< anamnesaListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.anam_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_anamnesa&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							anamnesa_DataStore.reload();
							break;
						default:
							Ext.MessageBox.show({
								title: 'Warning',
								msg: 'Could not delete the entire selection',
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
	}
  	/* End of Function */
  
	/* Function for Retrieve DataStore */
	anamnesa_DataStore = new Ext.data.Store({
		id: 'anamnesa_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_anamnesa&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'anam_id'
		},[
		/* dataIndex => insert intoanamnesa_ColumnModel, Mapping => for initiate table column */ 
			{name: 'anam_id', type: 'int', mapping: 'anam_id'}, 
			{name: 'anam_cust', type: 'int', mapping: 'anam_cust'}, 
			{name: 'anam_tanggal', type: 'date', dateFormat: 'Y-m-d', mapping: 'anam_tanggal'}, 
			{name: 'anam_petugas', type: 'int', mapping: 'anam_petugas'}, 
			{name: 'anam_pengobatan', type: 'string', mapping: 'anam_pengobatan'}, 
			{name: 'anam_perawatan', type: 'string', mapping: 'anam_perawatan'}, 
			{name: 'anam_terapi', type: 'string', mapping: 'anam_terapi'}, 
			{name: 'anam_alergi', type: 'string', mapping: 'anam_alergi'}, 
			{name: 'anam_obatalergi', type: 'string', mapping: 'anam_obatalergi'}, 
			{name: 'anam_efekobatalergi', type: 'string', mapping: 'anam_efekobatalergi'}, 
			{name: 'anam_hamil', type: 'string', mapping: 'anam_hamil'}, 
			{name: 'anam_kb', type: 'string', mapping: 'anam_kb'}, 
			{name: 'anam_harapan', type: 'string', mapping: 'anam_harapan'}, 
			{name: 'anam_creator', type: 'string', mapping: 'anam_creator'}, 
			{name: 'anam_date_create', type: 'date', dateFormat: 'Y-m-d', mapping: 'anam_date_create'}, 
			{name: 'anam_update', type: 'string', mapping: 'anam_update'}, 
			{name: 'anam_date_update', type: 'date', dateFormat: 'Y-m-d', mapping: 'anam_date_update'}, 
			{name: 'anam_revised', type: 'int', mapping: 'anam_revised'} 
		]),
		sortInfo:{field: 'anam_id', direction: "DESC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	anamnesa_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'anam_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Customer',
			dataIndex: 'anam_cust',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowBlank: false,
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Tanggal',
			dataIndex: 'anam_tanggal',
			width: 150,
			sortable: true,
			renderer: Ext.util.Format.dateRenderer('Y-m-d'),
			editor: new Ext.form.DateField({
				allowBlank: false,
				format: 'Y-m-d'
			})
		}, 
		{
			header: 'Petugas',
			dataIndex: 'anam_petugas',
			width: 150,
			sortable: true,
			editor: new Ext.form.NumberField({
				allowDecimals: false,
				allowNegative: false,
				blankText: '0',
				maxLength: 11,
				maskRe: /([0-9]+)$/
			})
		}, 
		{
			header: 'Alergi',
			dataIndex: 'anam_alergi',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		}, 
		{
			header: 'Alergi Obat',
			dataIndex: 'anam_obatalergi',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 500
          	})
		}, 
		{
			header: 'Hamil',
			dataIndex: 'anam_hamil',
			width: 150,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['anam_hamil_value', 'anam_hamil_display'],
					data: [['Y','Y'],['T','T']]
					}),
				mode: 'local',
               	displayField: 'anam_hamil_display',
               	valueField: 'anam_hamil_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}, 
		{
			header: 'Creator',
			dataIndex: 'anam_creator',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true,
		}, 
		{
			header: 'Create on',
			dataIndex: 'anam_date_create',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update by',
			dataIndex: 'anam_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Last Update on',
			dataIndex: 'anam_date_update',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}, 
		{
			header: 'Revised',
			dataIndex: 'anam_revised',
			width: 150,
			sortable: true,
			hidden: true,
			readOnly: true
		}	]);
	
	anamnesa_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	anamnesaListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'anamnesaListEditorGrid',
		el: 'fp_anamnesa',
		title: 'List Of Anamnesa',
		autoHeight: true,
		store: anamnesa_DataStore, // DataStore
		cm: anamnesa_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 800,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: anamnesa_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: display_form_window
		}, '-',{
			text: 'Edit',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: anamnesa_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: anamnesa_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: anamnesa_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: anamnesa_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: anamnesa_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: anamnesa_print  
		}
		]
	});
	anamnesaListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	anamnesa_ContextMenu = new Ext.menu.Menu({
		id: 'anamnesa_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: anamnesa_editContextMenu 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			handler: anamnesa_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: anamnesa_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: anamnesa_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onanamnesa_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		anamnesa_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		anamnesa_SelectedRow=rowIndex;
		anamnesa_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function anamnesa_editContextMenu(){
		anamnesaListEditorGrid.startEditing(anamnesa_SelectedRow,1);
  	}
	/* End of Function */
  	
	anamnesaListEditorGrid.addListener('rowcontextmenu', onanamnesa_ListEditGridContextMenu);
	anamnesa_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	anamnesaListEditorGrid.on('afteredit', anamnesa_update); // inLine Editing Record
	
	/* Identify  anam_id Field */
	anam_idField= new Ext.form.NumberField({
		id: 'anam_idField',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				hidden: true,
		readOnly: true,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  anam_cust Field */
	anam_custField= new Ext.form.NumberField({
		id: 'anam_custField',
		fieldLabel: 'Customer',
		allowNegatife : false,
		blankText: '0',
		allowBlank: false,
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  anam_tanggal Field */
	anam_tanggalField= new Ext.form.DateField({
		id: 'anam_tanggalField',
		fieldLabel: 'Tanggal',
		format : 'Y-m-d',
		allowBlank: false,
	});
	/* Identify  anam_petugas Field */
	anam_petugasField= new Ext.form.NumberField({
		id: 'anam_petugasField',
		fieldLabel: 'Petugas',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
				anchor: '95%',
		maskRe: /([0-9]+)$/
	});
	/* Identify  anam_pengobatan Field */
	anam_pengobatanField= new Ext.form.TextArea({
		id: 'anam_pengobatanField',
		fieldLabel: 'Pengobatan',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  anam_perawatan Field */
	anam_perawatanField= new Ext.form.TextArea({
		id: 'anam_perawatanField',
		fieldLabel: 'Perawatan',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  anam_terapi Field */
	anam_terapiField= new Ext.form.TextArea({
		id: 'anam_terapiField',
		fieldLabel: 'Terapi',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  anam_alergi Field */
	anam_alergiField= new Ext.form.TextArea({
		id: 'anam_alergiField',
		fieldLabel: 'Alergi',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  anam_obatalergi Field */
	anam_obatalergiField= new Ext.form.TextArea({
		id: 'anam_obatalergiField',
		fieldLabel: 'Alergi terhadap obat',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  anam_efekobatalergi Field */
	anam_efekobatalergiField= new Ext.form.TextArea({
		id: 'anam_efekobatalergiField',
		fieldLabel: 'Efek alergi terhadap obat',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  anam_hamil Field */
	anam_hamilField= new Ext.form.ComboBox({
		id: 'anam_hamilField',
		fieldLabel: 'Anam Hamil',
		store:new Ext.data.SimpleStore({
			fields:['anam_hamil_value', 'anam_hamil_display'],
			data:[['Y','Y'],['T','T']]
		}),
		mode: 'local',
		displayField: 'anam_hamil_display',
		valueField: 'anam_hamil_value',
		anchor: '95%',
		triggerAction: 'all'	
	});
	/* Identify  anam_kb Field */
	anam_kbField= new Ext.form.TextField({
		id: 'anam_kbField',
		fieldLabel: 'Alat KB yang digunakan',
		maxLength: 500,
		anchor: '95%'
	});
	/* Identify  anam_harapan Field */
	anam_harapanField= new Ext.form.TextArea({
		id: 'anam_harapanField',
		fieldLabel: 'Harapan',
		maxLength: 500,
		anchor: '95%'
	});
  	/*Fieldset Master*/
	anamnesa_masterGroup = new Ext.form.FieldSet({
		title: 'Master',
		autoHeight: true,
		collapsible: true,
		layout:'column',
		items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [anam_custField, anam_tanggalField, anam_petugasField, anam_pengobatanField, anam_perawatanField, anam_terapiField] 
			}
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [anam_alergiField, anam_obatalergiField, anam_efekobatalergiField, anam_hamilField,anam_kbField, anam_harapanField,anam_idField] 
			}
			]
	
	});
	
		
	/*Detail Declaration */
		
	// Function for json reader of detail
	var anamnesa_problem_reader=new Ext.data.JsonReader({
		root: 'results',
		totalProperty: 'total',
		id: ''
	},[
	/* dataIndex => insert intoperawatan_ColumnModel, Mapping => for initiate table column */ 
			{name: 'panam_id', type: 'int', mapping: 'panam_id'}, 
			{name: 'panam_master', type: 'int', mapping: 'panam_master'}, 
			{name: 'panam_problem', type: 'string', mapping: 'panam_problem'}, 
			{name: 'panam_lamaproblem', type: 'string', mapping: 'panam_lamaproblem'}, 
			{name: 'panam_aksiproblem', type: 'string', mapping: 'panam_aksiproblem'}, 
			{name: 'panam_aksiket', type: 'string', mapping: 'panam_aksiket'} 
	]);
	//eof
	
	//function for json writer of detail
	var anamnesa_problem_writer = new Ext.data.JsonWriter({
		encode: true,
		writeAllFields: false
	});
	//eof
	
	/* Function for Retrieve DataStore of detail*/
	anamnesa_problem_DataStore = new Ext.data.Store({
		id: 'anamnesa_problem_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_anamnesa&m=detail_anamnesa_problem_list', 
			method: 'POST'
		}),
		reader: anamnesa_problem_reader,
		baseParams:{master_id: anam_idField.getValue()},
		sortInfo:{field: 'panam_id', direction: "ASC"}
	});
	/* End of Function */
	
	//function for editor of detail
	var editor_anamnesa_problem= new Ext.ux.grid.RowEditor({
        saveText: 'Update'
    });
	//eof
	
	//declaration of detail coloumn model
	anamnesa_problem_ColumnModel = new Ext.grid.ColumnModel(
		[
		{
			header: 'Panam Problem',
			dataIndex: 'panam_problem',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 500
          	})
		},
		{
			header: 'Panam Lamaproblem',
			dataIndex: 'panam_lamaproblem',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 50
          	})
		},
		{
			header: 'Panam Aksiproblem',
			dataIndex: 'panam_aksiproblem',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Panam Aksiket',
			dataIndex: 'panam_aksiket',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		}]
	);
	anamnesa_problem_ColumnModel.defaultSortable= true;
	//eof
	
	
	
	//declaration of detail list editor grid
	anamnesa_problemListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'anamnesa_problemListEditorGrid',
		el: 'fp_anamnesa_problem',
		title: 'Detail anamnesa_problem',
		height: 250,
		width: 690,
		autoScroll: true,
		store: anamnesa_problem_DataStore, // DataStore
		colModel: anamnesa_problem_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		region: 'center',
        margins: '0 5 5 5',
		plugins: [editor_anamnesa_problem],
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true},
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: anamnesa_problem_DataStore,
			displayInfo: true
		}),
		/* Add Control on ToolBar */
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new detail record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: anamnesa_problem_add
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete detail selected record',
			iconCls:'icon-delete',
			handler: anamnesa_problem_confirm_delete
		}
		]
	});
	//eof
	
	
	//function of detail add
	function anamnesa_problem_add(){
		var edit_anamnesa_problem= new anamnesa_problemListEditorGrid.store.recordType({
			panam_id	:'',		
			panam_master	:'',		
			panam_problem	:'',		
			panam_lamaproblem	:'',		
			panam_aksiproblem	:'',		
			panam_aksiket	:''		
		});
		editor_anamnesa_problem.stopEditing();
		anamnesa_problem_DataStore.insert(0, edit_anamnesa_problem);
		anamnesa_problemListEditorGrid.getView().refresh();
		anamnesa_problemListEditorGrid.getSelectionModel().selectRow(0);
		editor_anamnesa_problem.startEditing(0);
	}
	
	//function for refresh detail
	function refresh_anamnesa_problem(){
		anamnesa_problem_DataStore.commitChanges();
		anamnesa_problemListEditorGrid.getView().refresh();
	}
	//eof
	
	//function for insert detail
	function anamnesa_problem_insert(){
		for(i=0;i<anamnesa_problem_DataStore.getCount();i++){
			anamnesa_problem_record=anamnesa_problem_DataStore.getAt(i);
			Ext.Ajax.request({
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_anamnesa&m=detail_anamnesa_problem_insert',
				params:{
				panam_id	: anamnesa_problem_record.data.panam_id, 
				panam_master	: eval(anam_idField.getValue()), 
				panam_problem	: anamnesa_problem_record.data.panam_problem, 
				panam_lamaproblem	: anamnesa_problem_record.data.panam_lamaproblem, 
				panam_aksiproblem	: anamnesa_problem_record.data.panam_aksiproblem, 
				panam_aksiket	: anamnesa_problem_record.data.panam_aksiket 
				
				}
			});
		}
	}
	//eof
	
	//function for purge detail
	function anamnesa_problem_purge(){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_anamnesa&m=detail_anamnesa_problem_purge',
			params:{ master_id: eval(anam_idField.getValue()) }
		});
	}
	//eof
	
	/* Function for Delete Confirm of detail */
	function anamnesa_problem_confirm_delete(){
		// only one record is selected here
		if(anamnesa_problemListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', anamnesa_problem_delete);
		} else if(anamnesa_problemListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', anamnesa_problem_delete);
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
	//eof
	
	//function for Delete of detail
	function anamnesa_problem_delete(btn){
		if(btn=='yes'){
			var s = anamnesa_problemListEditorGrid.getSelectionModel().getSelections();
			for(var i = 0, r; r = s[i]; i++){
				anamnesa_problem_DataStore.remove(r);
			}
		}  
	}
	//eof
	
	//event on update of detail data store
	anamnesa_problem_DataStore.on('update', refresh_anamnesa_problem);
	
	/* Function for retrieve create Window Panel*/ 
	anamnesa_createForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 700,        
		items: [anamnesa_masterGroup,anamnesa_problemListEditorGrid]
		,
		buttons: [{
				text: 'Save and Close',
				handler: anamnesa_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					anamnesa_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	anamnesa_createWindow= new Ext.Window({
		id: 'anamnesa_createWindow',
		title: post2db+'Anamnesa',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_anamnesa_create',
		items: anamnesa_createForm
	});
	/* End Window */
	
	/* Function for action list search */
	function anamnesa_list_search(){
		// render according to a SQL date format.
		var anam_id_search=null;
		var anam_cust_search=null;
		var anam_tanggal_search_date="";
		var anam_petugas_search=null;
		var anam_pengobatan_search=null;
		var anam_perawatan_search=null;
		var anam_terapi_search=null;
		var anam_alergi_search=null;
		var anam_obatalergi_search=null;
		var anam_efekobatalergi_search=null;
		var anam_hamil_search=null;
		var anam_kb_search=null;
		var anam_harapan_search=null;

		if(anam_idSearchField.getValue()!==null){anam_id_search=anam_idSearchField.getValue();}
		if(anam_custSearchField.getValue()!==null){anam_cust_search=anam_custSearchField.getValue();}
		if(anam_tanggalSearchField.getValue()!==""){anam_tanggal_search_date=anam_tanggalSearchField.getValue().format('Y-m-d');}
		if(anam_petugasSearchField.getValue()!==null){anam_petugas_search=anam_petugasSearchField.getValue();}
		if(anam_pengobatanSearchField.getValue()!==null){anam_pengobatan_search=anam_pengobatanSearchField.getValue();}
		if(anam_perawatanSearchField.getValue()!==null){anam_perawatan_search=anam_perawatanSearchField.getValue();}
		if(anam_terapiSearchField.getValue()!==null){anam_terapi_search=anam_terapiSearchField.getValue();}
		if(anam_alergiSearchField.getValue()!==null){anam_alergi_search=anam_alergiSearchField.getValue();}
		if(anam_obatalergiSearchField.getValue()!==null){anam_obatalergi_search=anam_obatalergiSearchField.getValue();}
		if(anam_efekobatalergiSearchField.getValue()!==null){anam_efekobatalergi_search=anam_efekobatalergiSearchField.getValue();}
		if(anam_hamilSearchField.getValue()!==null){anam_hamil_search=anam_hamilSearchField.getValue();}
		if(anam_kbSearchField.getValue()!==null){anam_kb_search=anam_kbSearchField.getValue();}
		if(anam_harapanSearchField.getValue()!==null){anam_harapan_search=anam_harapanSearchField.getValue();}
		// change the store parameters
		anamnesa_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			anam_id	:	anam_id_search, 
			anam_cust	:	anam_cust_search, 
			anam_tanggal	:	anam_tanggal_search_date, 
			anam_petugas	:	anam_petugas_search, 
			anam_pengobatan	:	anam_pengobatan_search, 
			anam_perawatan	:	anam_perawatan_search, 
			anam_terapi	:	anam_terapi_search, 
			anam_alergi	:	anam_alergi_search, 
			anam_obatalergi	:	anam_obatalergi_search, 
			anam_efekobatalergi	:	anam_efekobatalergi_search, 
			anam_hamil	:	anam_hamil_search, 
			anam_kb	:	anam_kb_search, 
			anam_harapan	:	anam_harapan_search, 
		};
		// Cause the datastore to do another query : 
		anamnesa_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function anamnesa_reset_search(){
		// reset the store parameters
		anamnesa_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		anamnesa_DataStore.reload({params: {start: 0, limit: pageS}});
		anamnesa_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  anam_id Search Field */
	anam_idSearchField= new Ext.form.NumberField({
		id: 'anam_idSearchField',
		fieldLabel: 'Anam Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  anam_cust Search Field */
	anam_custSearchField= new Ext.form.NumberField({
		id: 'anam_custSearchField',
		fieldLabel: 'Anam Cust',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  anam_tanggal Search Field */
	anam_tanggalSearchField= new Ext.form.DateField({
		id: 'anam_tanggalSearchField',
		fieldLabel: 'Anam Tanggal',
		format : 'Y-m-d',
	
	});
	/* Identify  anam_petugas Search Field */
	anam_petugasSearchField= new Ext.form.NumberField({
		id: 'anam_petugasSearchField',
		fieldLabel: 'Anam Petugas',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  anam_pengobatan Search Field */
	anam_pengobatanSearchField= new Ext.form.TextField({
		id: 'anam_pengobatanSearchField',
		fieldLabel: 'Anam Pengobatan',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  anam_perawatan Search Field */
	anam_perawatanSearchField= new Ext.form.TextField({
		id: 'anam_perawatanSearchField',
		fieldLabel: 'Anam Perawatan',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  anam_terapi Search Field */
	anam_terapiSearchField= new Ext.form.TextField({
		id: 'anam_terapiSearchField',
		fieldLabel: 'Anam Terapi',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  anam_alergi Search Field */
	anam_alergiSearchField= new Ext.form.TextField({
		id: 'anam_alergiSearchField',
		fieldLabel: 'Anam Alergi',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  anam_obatalergi Search Field */
	anam_obatalergiSearchField= new Ext.form.TextField({
		id: 'anam_obatalergiSearchField',
		fieldLabel: 'Anam Obatalergi',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  anam_efekobatalergi Search Field */
	anam_efekobatalergiSearchField= new Ext.form.TextField({
		id: 'anam_efekobatalergiSearchField',
		fieldLabel: 'Anam Efekobatalergi',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  anam_hamil Search Field */
	anam_hamilSearchField= new Ext.form.ComboBox({
		id: 'anam_hamilSearchField',
		fieldLabel: 'Anam Hamil',
		store:new Ext.data.SimpleStore({
			fields:['value', 'anam_hamil'],
			data:[['Y','Y'],['T','T']]
		}),
		mode: 'local',
		displayField: 'anam_hamil',
		valueField: 'value',
		anchor: '95%',
		triggerAction: 'all'	 
	
	});
	/* Identify  anam_kb Search Field */
	anam_kbSearchField= new Ext.form.TextField({
		id: 'anam_kbSearchField',
		fieldLabel: 'Anam Kb',
		maxLength: 500,
		anchor: '95%'
	
	});
	/* Identify  anam_harapan Search Field */
	anam_harapanSearchField= new Ext.form.TextField({
		id: 'anam_harapanSearchField',
		fieldLabel: 'Anam Harapan',
		maxLength: 500,
		anchor: '95%'
	
	});
    
	/* Function for retrieve search Form Panel */
	anamnesa_searchForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 600,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [anam_custSearchField, anam_tanggalSearchField, anam_petugasSearchField, anam_pengobatanSearchField, anam_perawatanSearchField, anam_terapiSearchField, anam_alergiSearchField, anam_obatalergiSearchField, anam_efekobatalergiSearchField, anam_hamilSearchField] 
			}
 
			,{
				columnWidth:0.5,
				layout: 'form',
				border:false,
				items: [anam_kbSearchField, anam_harapanSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: anamnesa_list_search
			},{
				text: 'Close',
				handler: function(){
					anamnesa_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	anamnesa_searchWindow = new Ext.Window({
		title: 'anamnesa Search',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_anamnesa_search',
		items: anamnesa_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!anamnesa_searchWindow.isVisible()){
			anamnesa_searchWindow.show();
		} else {
			anamnesa_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function anamnesa_print(){
		var searchquery = "";
		var anam_cust_print=null;
		var anam_tanggal_print_date="";
		var anam_petugas_print=null;
		var anam_pengobatan_print=null;
		var anam_perawatan_print=null;
		var anam_terapi_print=null;
		var anam_alergi_print=null;
		var anam_obatalergi_print=null;
		var anam_efekobatalergi_print=null;
		var anam_hamil_print=null;
		var anam_kb_print=null;
		var anam_harapan_print=null;
		var win;              
		// check if we do have some search data...
		if(anamnesa_DataStore.baseParams.query!==null){searchquery = anamnesa_DataStore.baseParams.query;}
		if(anamnesa_DataStore.baseParams.anam_cust!==null){anam_cust_print = anamnesa_DataStore.baseParams.anam_cust;}
		if(anamnesa_DataStore.baseParams.anam_tanggal!==""){anam_tanggal_print_date = anamnesa_DataStore.baseParams.anam_tanggal;}
		if(anamnesa_DataStore.baseParams.anam_petugas!==null){anam_petugas_print = anamnesa_DataStore.baseParams.anam_petugas;}
		if(anamnesa_DataStore.baseParams.anam_pengobatan!==null){anam_pengobatan_print = anamnesa_DataStore.baseParams.anam_pengobatan;}
		if(anamnesa_DataStore.baseParams.anam_perawatan!==null){anam_perawatan_print = anamnesa_DataStore.baseParams.anam_perawatan;}
		if(anamnesa_DataStore.baseParams.anam_terapi!==null){anam_terapi_print = anamnesa_DataStore.baseParams.anam_terapi;}
		if(anamnesa_DataStore.baseParams.anam_alergi!==null){anam_alergi_print = anamnesa_DataStore.baseParams.anam_alergi;}
		if(anamnesa_DataStore.baseParams.anam_obatalergi!==null){anam_obatalergi_print = anamnesa_DataStore.baseParams.anam_obatalergi;}
		if(anamnesa_DataStore.baseParams.anam_efekobatalergi!==null){anam_efekobatalergi_print = anamnesa_DataStore.baseParams.anam_efekobatalergi;}
		if(anamnesa_DataStore.baseParams.anam_hamil!==null){anam_hamil_print = anamnesa_DataStore.baseParams.anam_hamil;}
		if(anamnesa_DataStore.baseParams.anam_kb!==null){anam_kb_print = anamnesa_DataStore.baseParams.anam_kb;}
		if(anamnesa_DataStore.baseParams.anam_harapan!==null){anam_harapan_print = anamnesa_DataStore.baseParams.anam_harapan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_anamnesa&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			anam_cust : anam_cust_print,
		  	anam_tanggal : anam_tanggal_print_date, 
			anam_petugas : anam_petugas_print,
			anam_pengobatan : anam_pengobatan_print,
			anam_perawatan : anam_perawatan_print,
			anam_terapi : anam_terapi_print,
			anam_alergi : anam_alergi_print,
			anam_obatalergi : anam_obatalergi_print,
			anam_efekobatalergi : anam_efekobatalergi_print,
			anam_hamil : anam_hamil_print,
			anam_kb : anam_kb_print,
			anam_harapan : anam_harapan_print,
		  	currentlisting: anamnesa_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./anamnesalist.html','anamnesalist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function anamnesa_export_excel(){
		var searchquery = "";
		var anam_cust_2excel=null;
		var anam_tanggal_2excel_date="";
		var anam_petugas_2excel=null;
		var anam_pengobatan_2excel=null;
		var anam_perawatan_2excel=null;
		var anam_terapi_2excel=null;
		var anam_alergi_2excel=null;
		var anam_obatalergi_2excel=null;
		var anam_efekobatalergi_2excel=null;
		var anam_hamil_2excel=null;
		var anam_kb_2excel=null;
		var anam_harapan_2excel=null;
		var win;              
		// check if we do have some search data...
		if(anamnesa_DataStore.baseParams.query!==null){searchquery = anamnesa_DataStore.baseParams.query;}
		if(anamnesa_DataStore.baseParams.anam_cust!==null){anam_cust_2excel = anamnesa_DataStore.baseParams.anam_cust;}
		if(anamnesa_DataStore.baseParams.anam_tanggal!==""){anam_tanggal_2excel_date = anamnesa_DataStore.baseParams.anam_tanggal;}
		if(anamnesa_DataStore.baseParams.anam_petugas!==null){anam_petugas_2excel = anamnesa_DataStore.baseParams.anam_petugas;}
		if(anamnesa_DataStore.baseParams.anam_pengobatan!==null){anam_pengobatan_2excel = anamnesa_DataStore.baseParams.anam_pengobatan;}
		if(anamnesa_DataStore.baseParams.anam_perawatan!==null){anam_perawatan_2excel = anamnesa_DataStore.baseParams.anam_perawatan;}
		if(anamnesa_DataStore.baseParams.anam_terapi!==null){anam_terapi_2excel = anamnesa_DataStore.baseParams.anam_terapi;}
		if(anamnesa_DataStore.baseParams.anam_alergi!==null){anam_alergi_2excel = anamnesa_DataStore.baseParams.anam_alergi;}
		if(anamnesa_DataStore.baseParams.anam_obatalergi!==null){anam_obatalergi_2excel = anamnesa_DataStore.baseParams.anam_obatalergi;}
		if(anamnesa_DataStore.baseParams.anam_efekobatalergi!==null){anam_efekobatalergi_2excel = anamnesa_DataStore.baseParams.anam_efekobatalergi;}
		if(anamnesa_DataStore.baseParams.anam_hamil!==null){anam_hamil_2excel = anamnesa_DataStore.baseParams.anam_hamil;}
		if(anamnesa_DataStore.baseParams.anam_kb!==null){anam_kb_2excel = anamnesa_DataStore.baseParams.anam_kb;}
		if(anamnesa_DataStore.baseParams.anam_harapan!==null){anam_harapan_2excel = anamnesa_DataStore.baseParams.anam_harapan;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_anamnesa&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			anam_cust : anam_cust_2excel,
		  	anam_tanggal : anam_tanggal_2excel_date, 
			anam_petugas : anam_petugas_2excel,
			anam_pengobatan : anam_pengobatan_2excel,
			anam_perawatan : anam_perawatan_2excel,
			anam_terapi : anam_terapi_2excel,
			anam_alergi : anam_alergi_2excel,
			anam_obatalergi : anam_obatalergi_2excel,
			anam_efekobatalergi : anam_efekobatalergi_2excel,
			anam_hamil : anam_hamil_2excel,
			anam_kb : anam_kb_2excel,
			anam_harapan : anam_harapan_2excel,
		  	currentlisting: anamnesa_DataStore.baseParams.task // this tells us if we are searching or not
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
        <div id="fp_anamnesa"></div>
         <div id="fp_anamnesa_problem"></div>
		<div id="elwindow_anamnesa_create"></div>
        <div id="elwindow_anamnesa_search"></div>
    </div>
</div>
</body>