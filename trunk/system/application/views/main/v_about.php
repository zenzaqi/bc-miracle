<?
/* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: Ganti Password View
	+ Description	: For record view
	+ Filename 		: V_tbl_ganti_password.php
 	+ Author  		: 
 	+ abouteated on 01/May/2009 06:35:27
	
*/
?>
<div id="welcome">
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

var aboutWindow;
var aboutForm;
var id;

var about_labelField;

Ext.onReady(function(){
  Ext.QuickTips.init();
	
	about_labelField= new Ext.form.Label({
		id: 'about_labelField',
		readOnly: true,
		html: '<p><center><b>Sistem Informasi Klinik</b><br/><br/>' +
				'Digunakan untuk menyimpan dan mengolah data dan aktivitas transaksi klinik, dilengkapi pengingat aktivitas dan fitur cetak laporan' +
				'<br/>Jadikan aktivitas klinik Anda terkontrol, tertata rapi dan terdokumentasi secara lengkap dan cermat</center><br/><br/>'+
				'<b>Dikembangkan oleh CV. Trisula Solusindo <br/>Alamat : Jl. Saronojiwo No. 19 Surabaya<br/>'+
				'Telp. (031) 8413531, Email: info@ts.co.id <br/>Website: <a href="http://www.ts.co.id">http://www.ts.co.id</a></b><br/>'+
				'<br/>Develop Team: Zainal (zainal@ts.co.id), Mukhlison(mukhlison@ts.co.id)</p>'
	});
	
	
	aboutForm = new Ext.FormPanel({
		labelAlign: 'top',
		bodyStyle:'padding:5px',
		x:0,
		y:0,
		width: 300, 
		height: 300,
		items: [{
			layout:'column',
			border:false,
			items:[{
				columnWidth:0.99,
				layout: 'form',
				border:false,
				items: [about_labelField] 
			}]
		}],
		monitorValid:true,
		buttons: [{
				text: 'Close',
				handler: function(){
				// because of the global vars, we can only instantiate one window... so let's just hide it.
				aboutWindow.hide();
				mainPanel.remove(mainPanel.getActiveTab().getId());
			}
		}]
		
	});
	
	/* Form Advanced Search */
	aboutWindow = new Ext.Window({
		title: 'About Us',
		closable:false,
		closeAction: 'hide',
		resizable: false,
		plain:true,
		layout: 'fit',
		x: 0,
		y: 0,
		modal: true,
		renderTo: 'elwindow_about',
		items: aboutForm
	});
	aboutForm.getForm().load();
  	aboutWindow.show();
  	
});
	</script>
	<div class="col">
		<div id="elwindow_about"></div>
    </div>
</div>