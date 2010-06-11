<?
/* 	These code was generated using phpCIGen v 0.1.b (24/06/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: usergroups View
	+ Description	: For record view
	+ Filename 		: v_usergroups.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 17/Jul/2009 11:36:16
	
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
var usergroups_DataStore;
var usergroups_ColumnModel;
var usergroupsListEditorGrid;
var usergroups_createForm;
var usergroups_createWindow;
var usergroups_searchForm;
var usergroups_searchWindow;
var usergroups_SelectedRow;
var usergroups_ContextMenu;
//declare konstant
var post2db = '';
var msg = '';
var pageS=15;

/* declare variable here */
var group_idField;
var group_nameField;
var group_descField;
var group_activeField;
var group_idSearchField;
var group_nameSearchField;
var group_descSearchField;
var group_activeSearchField;

/* on ready fuction */
Ext.onReady(function(){
  	Ext.QuickTips.init();	/* Initiate quick tips icon */
  
  	/* Function for Saving inLine Editing */
	function usergroups_update(oGrid_event){
	var group_id_update_pk="";
	var group_name_update=null;
	var group_desc_update=null;
	var group_active_update=null;

	group_id_update_pk = oGrid_event.record.data.group_id;
	if(oGrid_event.record.data.group_name!== null){group_name_update = oGrid_event.record.data.group_name;}
	if(oGrid_event.record.data.group_desc!== null){group_desc_update = oGrid_event.record.data.group_desc;}
	if(oGrid_event.record.data.group_active!== null){group_active_update = oGrid_event.record.data.group_active;}

		Ext.Ajax.request({  
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_usergroups&m=get_action',
			params: {
				task			: "UPDATE",
				group_id		: group_id_update_pk,				
				group_name		: group_name_update,		
				group_desc		: group_desc_update,		
				group_active	: group_active_update		
			}, 
			success: function(response){							
				var result=eval(response.responseText);
				if(result!==0){
						Ext.MessageBox.alert(post2db+' OK','Group dan Hak Akses sukses disimpan');
						usergroups_DataStore.commitChanges();
						usergroups_DataStore.reload();
				}else{
						Ext.MessageBox.show({
						   title: 'Warning',
						   //msg: 'We could\'t not '+msg+' the Master_order_beli.',
						   msg: 'Group dan Hak Akses tidak bisa disimpan',
						   buttons: Ext.MessageBox.OK,
						   animEl: 'save',
						   icon: Ext.MessageBox.WARNING
						});
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
	function usergroups_create(){
		if(is_usergroups_form_valid()){
		
		var group_id_create_pk=null;
		var group_name_create=null;
		var group_desc_create=null;
		var group_active_create=null;

		group_id_create_pk=get_pk_id();
		if(group_nameField.getValue()!== null){group_name_create = group_nameField.getValue();}
		if(group_descField.getValue()!== null){group_desc_create = group_descField.getValue();}
		if(group_activeField.getValue()!== null){group_active_create = group_activeField.getValue();}

			Ext.Ajax.request({  
				waitMsg: 'Please wait...',
				url: 'index.php?c=c_usergroups&m=get_action',
				params: {
					task			: post2db,
					group_id		: group_id_create_pk,	
					group_name		: group_name_create,	
					group_desc		: group_desc_create,	
					group_active	: group_active_create	
				}, 
				success: function(response){             
					var result=eval(response.responseText);
					if(result!==0){
						permission_purge(result);
						Ext.MessageBox.alert(post2db+' OK','Group dan Hak Akses sukses disimpan');
						usergroups_createWindow.hide();
					}else{
							Ext.MessageBox.show({
							   title: 'Warning',
							   //msg: 'We could\'t not '+msg+' the Master_order_beli.',
							   msg: 'Group dan Hak Akses tidak bisa disimpan',
							   buttons: Ext.MessageBox.OK,
							   animEl: 'save',
							   icon: Ext.MessageBox.WARNING
							});
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
			return usergroupsListEditorGrid.getSelectionModel().getSelected().get('group_id');
		else 
			return 0;
	}
	/* End of Function  */
	
	/* Reset form before loading */
	function usergroups_reset_form(){
		group_nameField.reset();
		group_descField.reset();
		group_activeField.setValue('Y');
		group_allprivField.setValue(false);
		group_allreadprivField.setValue(false);
		group_allcreateprivField.setValue(false);
		group_allupdateprivField.setValue(false);
		group_alldeleteprivField.setValue(false);
		
	}
 	/* End of Function */
  
	/* setValue to EDIT */
	function usergroups_set_form(){
		group_nameField.setValue(usergroupsListEditorGrid.getSelectionModel().getSelected().get('group_name'));
		group_descField.setValue(usergroupsListEditorGrid.getSelectionModel().getSelected().get('group_desc'));
		group_activeField.setValue(usergroupsListEditorGrid.getSelectionModel().getSelected().get('group_active'));
		group_allprivField.setValue(false);
		group_allreadprivField.setValue(false);
		group_allcreateprivField.setValue(false);
		group_allupdateprivField.setValue(false);
		group_alldeleteprivField.setValue(false);
		
	}
	/* End setValue to EDIT*/
  
	/* Function for Check if the form is valid */
	function is_usergroups_form_valid(){
		return (true &&  group_nameField.isValid() && group_activeField.isValid() );
	}
  	/* End of Function */
  
  	/* Function for Displaying  create Window Form */
	function display_form_window(){
		if(!usergroups_createWindow.isVisible()){
			post2db='CREATE';
			msg='created';
			usergroups_reset_form();
			group_activeField.setValue('Aktif');
			usergroups_createWindow.show();
			permission_DataStore.load({params:{group:0}});
			//permissionListEditorGrid.reconfigure(permission_DataStore,permission_ColumnModel);
		} else {
			usergroups_createWindow.toFront();
		}
	}
  	/* End of Function */
 
  	/* Function for Delete Confirm */
	function usergroups_confirm_delete(){
		// only one usergroups is selected here
		if(usergroupsListEditorGrid.selModel.getCount() == 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete this record?', usergroups_delete);
		} else if(usergroupsListEditorGrid.selModel.getCount() > 1){
			Ext.MessageBox.confirm('Confirmation','Are you sure to delete these records?', usergroups_delete);
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
	function usergroups_confirm_update(){
		/* only one record is selected here */
		if(usergroupsListEditorGrid.selModel.getCount() == 1) {
			post2db='UPDATE';
			msg='updated';
			usergroups_set_form();
			permission_DataStore.setBaseParam('group',get_pk_id());
			permission_DataStore.load();
			usergroups_createWindow.show();
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
	function usergroups_delete(btn){
		if(btn=='yes'){
			var selections = usergroupsListEditorGrid.selModel.getSelections();
			var prez = [];
			for(i = 0; i< usergroupsListEditorGrid.selModel.getCount(); i++){
				prez.push(selections[i].json.group_id);
			}
			var encoded_array = Ext.encode(prez);
			Ext.Ajax.request({ 
				waitMsg: 'Please Wait',
				url: 'index.php?c=c_usergroups&m=get_action', 
				params: { task: "DELETE", ids:  encoded_array }, 
				success: function(response){
					var result=eval(response.responseText);
					switch(result){
						case 1:  // Success : simply reload
							usergroups_DataStore.reload();
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
	usergroups_DataStore = new Ext.data.Store({
		id: 'usergroups_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_usergroups&m=get_action', 
			method: 'POST'
		}),
		baseParams:{task: "LIST"}, // parameter yang di $_POST ke Controller
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'group_id'
		},[
		/* dataIndex => insert intousergroups_ColumnModel, Mapping => for initiate table column */ 
			{name: 'group_id', type: 'int', mapping: 'group_id'},
			{name: 'group_name', type: 'string', mapping: 'group_name'},
			{name: 'group_desc', type: 'string', mapping: 'group_desc'},
			{name: 'group_active', type: 'string', mapping: 'group_active'}
		]),
		sortInfo:{field: 'group_id', direction: "ASC"}
	});
	/* End of Function */
    
  	/* Function for Identify of Window Column Model */
	usergroups_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'group_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: true
		},
		{
			header: 'Nama Group',
			dataIndex: 'group_name',
			width: 150,
			sortable: true,
			editor: new Ext.form.TextField({
				allowBlank: false,
				maxLength: 50
          	})
		},
		{
			header: 'Keterangan',
			dataIndex: 'group_desc',
			width: 200,
			sortable: true,
			editor: new Ext.form.TextField({
				maxLength: 250
          	})
		},
		{
			header: 'Status',
			dataIndex: 'group_active',
			width: 80,
			sortable: true,
			editor: new Ext.form.ComboBox({
				typeAhead: true,
				triggerAction: 'all',
				store:new Ext.data.SimpleStore({
					fields:['group_active_value', 'group_active_display'],
					data: [['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
					}),
				mode: 'local',
               	displayField: 'group_active_display',
               	valueField: 'group_active_value',
               	lazyRender:true,
               	listClass: 'x-combo-list-small'
            })
		}]
	);
	usergroups_ColumnModel.defaultSortable= true;
	/* End of Function */
    
	/* Declare DataStore and  show datagrid list */
	usergroupsListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'usergroupsListEditorGrid',
		el: 'fp_usergroups',
		title: 'Daftar Grup User',
		autoHeight: true,
		store: usergroups_DataStore, // DataStore
		cm: usergroups_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		clicksToEdit:2, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true },
	  	width: 700,
		bbar: new Ext.PagingToolbar({
			pageSize: pageS,
			store: usergroups_DataStore,
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
			handler: usergroups_confirm_update   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			disabled: true,
			handler: usergroups_confirm_delete   // Confirm before deleting
		}, '-', {
			text: 'Search',
			tooltip: 'Advanced Search',
			iconCls:'icon-search',
			handler: display_form_search_window 
		}, '-', 
			new Ext.app.SearchField({
			store: usergroups_DataStore,
			params: {start: 0, limit: pageS},
			width: 120
		}),'-',{
			text: 'Refresh',
			tooltip: 'Refresh datagrid',
			handler: usergroups_reset_search,
			iconCls:'icon-refresh'
		},'-',{
			text: 'Export Excel',
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: usergroups_export_excel
		}, '-',{
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: usergroups_print  
		}
		]
	});
	usergroupsListEditorGrid.render();
	/* End of DataStore */
     
	/* Create Context Menu */
	usergroups_ContextMenu = new Ext.menu.Menu({
		id: 'usergroups_ListEditorGridContextMenu',
		items: [
		{ 
			text: 'Edit', tooltip: 'Edit selected record', 
			iconCls:'icon-update',
			handler: usergroups_confirm_update 
		},
		{ 
			text: 'Delete', 
			tooltip: 'Delete selected record', 
			iconCls:'icon-delete',
			disabled: true,
			handler: usergroups_confirm_delete 
		},
		'-',
		{ 
			text: 'Print',
			tooltip: 'Print Document',
			iconCls:'icon-print',
			handler: usergroups_print 
		},
		{ 
			text: 'Export Excel', 
			tooltip: 'Export to Excel(.xls) Document',
			iconCls:'icon-xls',
			handler: usergroups_export_excel 
		}
		]
	}); 
	/* End of Declaration */
	
	/* Event while selected row via context menu */
	function onusergroups_ListEditGridContextMenu(grid, rowIndex, e) {
		e.stopEvent();
		var coords = e.getXY();
		usergroups_ContextMenu.rowRecord = grid.store.getAt(rowIndex);
		grid.selModel.selectRow(rowIndex);
		usergroups_SelectedRow=rowIndex;
		usergroups_ContextMenu.showAt([coords[0], coords[1]]);
  	}
  	/* End of Function */
	
	/* function for editing row via context menu */
	function usergroups_editContextMenu(){
      usergroupsListEditorGrid.startEditing(usergroups_SelectedRow,1);
  	}
	/* End of Function */
  	
	usergroupsListEditorGrid.addListener('rowcontextmenu', onusergroups_ListEditGridContextMenu);
	usergroups_DataStore.load({params: {start: 0, limit: pageS}});	// load DataStore
	usergroupsListEditorGrid.on('afteredit', usergroups_update); // inLine Editing Record
	
	/* Identify  group_name Field */
	group_nameField= new Ext.form.TextField({
		id: 'group_nameField',
		fieldLabel: 'Nama Group',
		maxLength: 50,
		allowBlank: false,
		anchor: '95%'
	});
	/* Identify  group_desc Field */
	group_descField= new Ext.form.TextArea({
		id: 'group_descField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	});
	/* Identify  group_active Field */
	group_activeField= new Ext.form.ComboBox({
		id: 'group_activeField',
		fieldLabel: 'Aktif',
		store:new Ext.data.SimpleStore({
			fields:['group_active_value', 'group_active_display'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		displayField: 'group_active_display',
		valueField: 'group_active_value',
		allowBlank: false,
		width: 80,
		triggerAction: 'all'	
	});
  	
	/* Identify  group_desc Field */
	group_allprivField= new Ext.form.Checkbox({
		id: 'group_allprivField',
		fieldLabel: 'All Privileges ?',
		maxLength: 250,
		anchor: '95%'
	});
	
	group_allreadprivField= new Ext.form.Checkbox({
		id: 'group_allreadprivField',
		fieldLabel: 'All Read?',
		maxLength: 250,
		anchor: '95%'
	});
	
	group_allcreateprivField= new Ext.form.Checkbox({
		id: 'group_allcreateprivField',
		fieldLabel: 'All Create?',
		maxLength: 250,
		anchor: '95%'
	});
	
	group_allupdateprivField= new Ext.form.Checkbox({
		id: 'group_allupdateprivField',
		fieldLabel: 'All Update?',
		maxLength: 250,
		anchor: '95%'
	});
	
	group_alldeleteprivField= new Ext.form.Checkbox({
		id: 'group_alldeleteprivField',
		fieldLabel: 'All Delete ?',
		maxLength: 250,
		anchor: '95%'
	});
	
	group_permissionField=new Ext.form.FieldSet({
		fieldLabel:'Permission',
		layout: 'column',
		labelAlign: 'left',
		anchor: '95%',
		border: false,
		items:[{
			   		layout: 'form',
					border: false,
					columnWidth: 0.5,
					labelAlign: 'left',
					items:[group_allprivField]
			   }
			   ,{
				   	layout: 'form',
					border: false,
					columnWidth: 0.5,
					labelWidth: 80,
					labelAlign: 'left',
					items:[group_allreadprivField,group_allcreateprivField,group_allupdateprivField,group_alldeleteprivField]
			   }]
	});
	//detail permission
	
	
	/* Function for Retrieve DataStore */
	permission_DataStore = new Ext.data.Store({
		id: 'permission_DataStore',
		proxy: new Ext.data.HttpProxy({
			url: 'index.php?c=c_usergroups&m=get_permission', 
			method: 'POST'
		}),
		reader: new Ext.data.JsonReader({
			root: 'results',
			totalProperty: 'total',
			id: 'menu_id'
		},[
		/* dataIndex => insert intousergroups_ColumnModel, Mapping => for initiate table column */ 
			{name: 'menu_id', type: 'int', mapping: 'menu_id'},
			{name: 'menu_parent', type: 'int', mapping: 'menu_parent'},
			{name: 'menu_position', type: 'int', mapping: 'menu_position'},
			{name: 'menu_title', type: 'string', mapping: 'menu_title'},
			{name: 'perm_create', type: 'int', mapping: 'perm_create'},
			{name: 'perm_update', type: 'int', mapping: 'perm_create'},
			{name: 'perm_read', type: 'int', mapping: 'perm_read'},
			{name: 'perm_delete', type: 'int', mapping: 'perm_delete'},
		])
	});
	
	
	var readColumn = new Ext.grid.CheckColumn({
		header: "Read", 
		dataIndex: 'perm_read', 
		width: 80, 
		sortable: false,
		renderer: function(v,params,record){
				if(record.data.menu_parent==0)
					return '';
				else{
				   params.css += ' x-grid3-check-col-td'; 
            		return '<div class="x-grid3-check-col'+(v?'-on':'')+' x-grid3-cc-'+this.id+'">&#160;</div>';
				}
			}
	});
	
	var createColumn = new Ext.grid.CheckColumn({
		header: "Create", 
		dataIndex: 'perm_create', 
		width: 80, 
		sortable: false,
		renderer: function(v,params,record){
				if(record.data.menu_parent==0)
					return '';
				else{
				   params.css += ' x-grid3-check-col-td'; 
            		return '<div class="x-grid3-check-col'+(v?'-on':'')+' x-grid3-cc-'+this.id+'">&#160;</div>';
				}
			}
	});
	
	var updateColumn = new Ext.grid.CheckColumn({
		header: "Update", 
		dataIndex: 'perm_update', 
		width: 80, 
		sortable: false,
		renderer: function(v,params,record){
				if(record.data.menu_parent==0)
					return '';
				else{
				   params.css += ' x-grid3-check-col-td'; 
            		return '<div class="x-grid3-check-col'+(v?'-on':'')+' x-grid3-cc-'+this.id+'">&#160;</div>';
				}
			}
	});
	
	var deleteColumn = new Ext.grid.CheckColumn({
		header: "Delete", 
		dataIndex: 'perm_delete', 
		width: 80, 
		sortable: false,
		renderer: function(v,params,record){
				if(record.data.menu_parent==0)
					return '';
				else{
				   	params.css += ' x-grid3-check-col-td'; 
            		return '<div class="x-grid3-check-col'+(v?'-on':'')+' x-grid3-cc-'+this.id+'">&#160;</div>';
				}
			}
	});
	
	//readchk.unlock();
	/* Function for Identify of Window Column Model */
	permission_ColumnModel = new Ext.grid.ColumnModel(
		[{
			header: '#',
			readOnly: true,
			dataIndex: 'menu_id',
			width: 40,
			renderer: function(value, cell){
				cell.css = "readonlycell"; // Mengambil Value dari Class di dalam CSS 
				return value;
				},
			hidden: false
		},
		{
			header: 'Nama Menu',
			dataIndex: 'menu_title',
			width: 200,
			readOnly: true,
			renderer: function(v,params,record){
				if(record.data.menu_parent==0)
					return '<b><font size=\'medium\'>'+record.data.menu_title+'</font></b>';
				else
					return record.data.menu_title;
			}
		},
		readColumn,
		createColumn,
		updateColumn,
		deleteColumn
		]
	);
	
	
	function permission_save(pkid){
		for(i=0;i<permission_DataStore.getCount();i++){
			var perm_priv="";
			var permission_record=permission_DataStore.getAt(i);
			if(permission_record.data.perm_read==1)
				perm_priv="R";
			if(permission_record.data.perm_create==1)
				perm_priv=perm_priv+"C";
			if(permission_record.data.perm_update==1)
				perm_priv=perm_priv+"U";
			if(permission_record.data.perm_delete==1)
				perm_priv=perm_priv+"D";
			
			if(perm_priv!==""){
				Ext.Ajax.request({
					waitMsg: 'Please wait...',
					url: 'index.php?c=c_usergroups&m=permission_save',
					params:{
						menu_id		: permission_record.data.menu_id,
						menu_group	: pkid,
						menu_priv	: perm_priv
					},
					timeout: 60000,
					success: function(response){							
						var result=eval(response.responseText);
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
		
		usergroups_DataStore.reload();
	}
	//eof
	
	//function for purge detail
	function permission_purge(pkid){
		Ext.Ajax.request({
			waitMsg: 'Please wait...',
			url: 'index.php?c=c_usergroups&m=permission_purge',
			params:{ menu_group: get_pk_id()},
			callback: function(opts, success, response){
				if(success){
					permission_save(pkid);
					usergroups_DataStore.reload();
				}
			}
		});
	}


	
	/* Declare DataStore and  show datagrid list */
	permissionListEditorGrid =  new Ext.grid.EditorGridPanel({
		id: 'permissionListEditorGrid',
		el: 'fp_permission',
		title: 'Daftar Hak Akses',
		autoHeight: true,
		store: permission_DataStore, // DataStore
		cm: permission_ColumnModel, // Nama-nama Columns
		enableColLock:false,
		frame: true,
		plugins: [readColumn,createColumn,updateColumn,deleteColumn],
		clicksToEdit:1, // 2xClick untuk bisa meng-Edit inLine Data
		selModel: new Ext.grid.RowSelectionModel({singleSelect:false}),
		viewConfig: { forceFit:true, markDirty: false },
		autoSave: true,
	  	width: 590/*,
		tbar: [
		{
			text: 'Add',
			tooltip: 'Add new record',
			iconCls:'icon-adds',    				// this is defined in our styles.css
			handler: ''
		}, '-',{
			text: 'Edit',
			tooltip: 'Edit selected record',
			iconCls:'icon-update',
			handler: ''   // Confirm before updating
		}, '-',{
			text: 'Delete',
			tooltip: 'Delete selected record',
			iconCls:'icon-delete',
			handler: usergroups_confirm_delete   // Confirm before deleting
		}
		]*/
	});
	//permissionListEditorGrid.render();
	/* End of DataStore */
     
	 
	
	/* Function for retrieve create Window Panel*/ 
	usergroups_createForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 600,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [group_nameField, group_descField, group_activeField,group_permissionField,permissionListEditorGrid] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Save and Close',
				handler: usergroups_create
			}
			,{
				text: 'Cancel',
				handler: function(){
					usergroups_createWindow.hide();
				}
			}
		]
	});
	/* End  of Function*/
	
	/* Function for retrieve create Window Form */
	usergroups_createWindow= new Ext.Window({
		id: 'usergroups_createWindow',
		title: post2db+' Group dan Hak Akses User',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		x:0,
		y:0,
		plain:true,
		layout: 'fit',
		modal: true,
		renderTo: 'elwindow_usergroups_create',
		items: usergroups_createForm
	});
	/* End Window */
	
	
	/* Function for action list search */
	function usergroups_list_search(){
		// render according to a SQL date format.
		var group_id_search=null;
		var group_name_search=null;
		var group_desc_search=null;
		var group_active_search=null;

		if(group_idSearchField.getValue()!==null){group_id_search=group_idSearchField.getValue();}
		if(group_nameSearchField.getValue()!==null){group_name_search=group_nameSearchField.getValue();}
		if(group_descSearchField.getValue()!==null){group_desc_search=group_descSearchField.getValue();}
		if(group_activeSearchField.getValue()!==null){group_active_search=group_activeSearchField.getValue();}
		// change the store parameters
		usergroups_DataStore.baseParams = {
			task: 'SEARCH',
			//variable here
			group_id	:	group_id_search, 
			group_name	:	group_name_search, 
			group_desc	:	group_desc_search, 
			group_active	:	group_active_search 
		};
		// Cause the datastore to do another query : 
		usergroups_DataStore.reload({params: {start: 0, limit: pageS}});
	}
		
	/* Function for reset search result */
	function usergroups_reset_search(){
		// reset the store parameters
		usergroups_DataStore.baseParams = { task: 'LIST' };
		// Cause the datastore to do another query : 
		usergroups_DataStore.reload({params: {start: 0, limit: pageS}});
		usergroups_searchWindow.close();
	};
	/* End of Fuction */
	
	/* Field for search */
	/* Identify  group_id Search Field */
	group_idSearchField= new Ext.form.NumberField({
		id: 'group_idSearchField',
		fieldLabel: 'Id',
		allowNegatife : false,
		blankText: '0',
		allowDecimals: false,
		anchor: '95%',
		maskRe: /([0-9]+)$/
	
	});
	/* Identify  group_name Search Field */
	group_nameSearchField= new Ext.form.TextField({
		id: 'group_nameSearchField',
		fieldLabel: 'Nama Group',
		maxLength: 50,
		anchor: '95%'
	
	});
	/* Identify  group_desc Search Field */
	group_descSearchField= new Ext.form.TextArea({
		id: 'group_descSearchField',
		fieldLabel: 'Keterangan',
		maxLength: 250,
		anchor: '95%'
	
	});
	/* Identify  group_active Search Field */
	group_activeSearchField= new Ext.form.ComboBox({
		id: 'group_activeSearchField',
		fieldLabel: 'Aktif',
		store:new Ext.data.SimpleStore({
			fields:['value', 'group_active'],
			data:[['Aktif','Aktif'],['Tidak Aktif','Tidak Aktif']]
		}),
		mode: 'local',
		displayField: 'group_active',
		valueField: 'value',
		width: 80,
		triggerAction: 'all'	 
	
	});
    
	/* Function for retrieve search Form Panel */
	usergroups_searchForm = new Ext.FormPanel({
		labelAlign: 'left',
		bodyStyle:'padding:5px',
		autoHeight:true,
		width: 300,        
		items: [{
			layout:'column',
			border:false,
			items:[
			{
				columnWidth:1,
				layout: 'form',
				border:false,
				items: [group_nameSearchField, group_descSearchField, group_activeSearchField] 
			}
			]
		}]
		,
		buttons: [{
				text: 'Search',
				handler: usergroups_list_search
			},{
				text: 'Close',
				handler: function(){
					usergroups_searchWindow.hide();
				}
			}
		]
	});
    /* End of Function */ 
	 
	/* Function for retrieve search Window Form, used for andvaced search */
	usergroups_searchWindow = new Ext.Window({
		title: 'Pencarian Group User',
		closable:true,
		closeAction: 'hide',
		autoWidth: true,
		autoHeight: true,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_usergroups_search',
		items: usergroups_searchForm
	});
    /* End of Function */ 
	 
  	/* Function for Displaying  Search Window Form */
	function display_form_search_window(){
		if(!usergroups_searchWindow.isVisible()){
			usergroups_searchWindow.show();
		} else {
			usergroups_searchWindow.toFront();
		}
	}
  	/* End Function */
	
	/* Function for print List Grid */
	function usergroups_print(){
		var searchquery = "";
		var group_name_print=null;
		var group_desc_print=null;
		var group_active_print=null;
		var win;              
		// check if we do have some search data...
		if(usergroups_DataStore.baseParams.query!==null){searchquery = usergroups_DataStore.baseParams.query;}
		if(usergroups_DataStore.baseParams.group_name!==null){group_name_print = usergroups_DataStore.baseParams.group_name;}
		if(usergroups_DataStore.baseParams.group_desc!==null){group_desc_print = usergroups_DataStore.baseParams.group_desc;}
		if(usergroups_DataStore.baseParams.group_active!==null){group_active_print = usergroups_DataStore.baseParams.group_active;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_usergroups&m=get_action',
		params: {
			task: "PRINT",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			group_name : group_name_print,
			group_desc : group_desc_print,
			group_active : group_active_print,
		  	currentlisting: usergroups_DataStore.baseParams.task // this tells us if we are searching or not
		}, 
		success: function(response){              
		  	var result=eval(response.responseText);
		  	switch(result){
		  	case 1:
				win = window.open('./usergroupslist.html','usergroupslist','height=400,width=600,resizable=1,scrollbars=1, menubar=1');
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
	function usergroups_export_excel(){
		var searchquery = "";
		var group_name_2excel=null;
		var group_desc_2excel=null;
		var group_active_2excel=null;
		var win;              
		// check if we do have some search data...
		if(usergroups_DataStore.baseParams.query!==null){searchquery = usergroups_DataStore.baseParams.query;}
		if(usergroups_DataStore.baseParams.group_name!==null){group_name_2excel = usergroups_DataStore.baseParams.group_name;}
		if(usergroups_DataStore.baseParams.group_desc!==null){group_desc_2excel = usergroups_DataStore.baseParams.group_desc;}
		if(usergroups_DataStore.baseParams.group_active!==null){group_active_2excel = usergroups_DataStore.baseParams.group_active;}

		Ext.Ajax.request({   
		waitMsg: 'Please Wait...',
		url: 'index.php?c=c_usergroups&m=get_action',
		params: {
			task: "EXCEL",
		  	query: searchquery,                    		// if we are doing a quicksearch, use this
			//if we are doing advanced search, use this
			group_name : group_name_2excel,
			group_desc : group_desc_2excel,
			group_active : group_active_2excel,
		  	currentlisting: usergroups_DataStore.baseParams.task // this tells us if we are searching or not
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
	
	group_allprivField.on('check',function(){
			if(group_allprivField.getValue()==1)
			{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_read=1;
					datapriv.data.perm_create=1;
					datapriv.data.perm_update=1;
					datapriv.data.perm_delete=1;
				}
			}else{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_read=0;
					datapriv.data.perm_create=0;
					datapriv.data.perm_update=0;
					datapriv.data.perm_delete=0;
				}
			}
			permission_DataStore.commitChanges();
			permissionListEditorGrid.reconfigure(permission_DataStore,permission_ColumnModel);
	});
	
	group_allreadprivField.on('check',function(){
			if(group_allreadprivField.getValue()==1)
			{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_read=1;
				}
			}else{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_read=0;
				}
			}
			permission_DataStore.commitChanges();
			permissionListEditorGrid.reconfigure(permission_DataStore,permission_ColumnModel);
	});
	
	group_allcreateprivField.on('check',function(){
			if(group_allcreateprivField.getValue()==1)
			{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_create=1;
				}
			}else{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_create=0;
				}
			}
			permission_DataStore.commitChanges();
			permissionListEditorGrid.reconfigure(permission_DataStore,permission_ColumnModel);
	});
	
	group_allupdateprivField.on('check',function(){
			if(group_allupdateprivField.getValue()==1)
			{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_update=1;
				}
			}else{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_update=0;
				}
			}
			permission_DataStore.commitChanges();
			permissionListEditorGrid.reconfigure(permission_DataStore,permission_ColumnModel);
	});
	
	group_alldeleteprivField.on('check',function(){
			if(group_alldeleteprivField.getValue()==1)
			{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_delete=1;
				}
			}else{
				for(i=0;i<permission_DataStore.getCount();i++){
					var datapriv=permission_DataStore.getAt(i);
					datapriv.data.perm_delete=0;
				}
			}
			permission_DataStore.commitChanges();
			permissionListEditorGrid.reconfigure(permission_DataStore,permission_ColumnModel);
	});
	
	
});
	</script>
<body>
<div>
	<div class="col">
        <div id="fp_permission"></div>
        <div id="fp_usergroups"></div>
		<div id="elwindow_usergroups_create"></div>
        <div id="elwindow_usergroups_search"></div>
    </div>
</div>
</body>