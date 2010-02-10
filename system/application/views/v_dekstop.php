<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--	<title>Sistem Informasi Klinik - Miracle Aesthetic Clinic >> Experience the miracle touch !</title>-->
	<title>New Miracle Aesthetic Clinic Information System</title>
	<?=css_asset('ext-all.css');?>
    <?=css_asset('docs.css','main');?>
    <? //=css_asset('forms.css');?>
    <?=css_asset('mmcal.css');?>
   	<?=css_asset('xtheme-slate.css');?>
	<?=css_asset('file-upload.css');?>
	<?=css_asset('MultiSelect.css');?>
	
	
    <?=js_asset('ext-base.js');?>
    <?=js_asset('ext-all.js');?>
	<?=js_asset('ext-all-debug.js');?>
    <?=js_asset('App.js');?>
	<?=js_asset('TabCloseMenu.js');?>
	<?=js_asset('FileUploadField.js');?>
	<?=js_asset('SearchField.js');?>
	<?=js_asset('RowExpander.js');?>
    <?=js_asset('RowEditor.js');?>
	<?=js_asset('CheckColumn.js');?>
    <?=js_asset('MultiSelect.js');?>
    <?=js_asset('ItemSelector.js');?>
  	<link rel="shortcut icon" href="<?=base_url();?>favicon.ico" />

	<style type="text/css">
	html, body {
        font:normal 12px verdana;
        margin:0;
        padding:0;
        border:0 none;
        overflow:hidden;
        height:100%;
    }
	p {
	    margin:5px;
	}
    .style1 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 14px;
	}
    .style2 {
		font-size: large;
		font-family: "Courier New", Courier, monospace;
	}
	.style5 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: small;
		color: #AF4046;
	}
    </style>
   
	<?php $this->load->view('menus')?>
</head>
<body>
	<div id="loading-mask" style=""></div>
	<div id="loading">
		<div class="loading-indicator">
			<img src="<?=image_asset_url('extanim32.gif','main');?>" width="32" height="32" style="margin-right:8px;" align="absmiddle"/>
			Loading...
		</div>
	</div> 
  	<div id="north">
    	<div class="api-title style1 style2" style="float:left; margin-left:10px;">
			<p class="style5"><font style="font-weight:bold"><? $info=$this->m_public_function->get_info();echo $info->info_nama; ?></font>, <? echo $info->info_alamat; ?>&nbsp;&nbsp;
            </p>
		</div>
		<div style="float:right; margin-right:10px; margin-top:5px; color:#AF4046;"> 
<!--        Welcome --> 
        Selamat datang,
        <font style="font-weight:bold"><?=$_SESSION['userid']." (".$_SESSION["groupname"].")";?></font>&nbsp;
<!--        [ <a  onClick="return confirm('Are you sure to logout?'); " href="index.php?c=c_login&m=logout" style="color:#AF4046">Logout</a> ]-->
 		[<a  onClick="return confirm('Anda yakin untuk keluar?'); " href="index.php?c=c_login&m=logout" style="color:#AF4046">Keluar</a>]
        </div>
  	</div>
  	<div id="props-panel" style="width:200px;height:200px;overflow:hidden;"></div>
    <div id="main"></div>
 
</body>
</html>