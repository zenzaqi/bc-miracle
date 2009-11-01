<html lang="en">
<head>
	<title>Auto2000 Sales Management</title>
	<?=css_asset('ext-all.css');?>
    <?=css_asset('xtheme-olive.css');?>
	<?=css_asset('MMCal.css');?>
	<?=css_asset('datepickerplus.css');?>
	<?=css_asset('docs.css','main');?>
	<?=css_asset('style.css','main');?>

	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="icon" href="favicon.ico" />
	<!-- GC -->
</head>
<body scroll="no">
	<div id="loading-mask" style=""></div>
	<div id="loading">
		<div class="loading-indicator">
			<img src="<?=image_asset_url('extanim32.gif','main');?>" width="32" height="32" style="margin-right:8px;" align="absmiddle"/>
			Loading...
		</div>
	</div>
    <!-- include everything after the loading indicator -->
	<?=js_asset('ext-base.js');?>
	<?=js_asset('ext-all.js');?>
	<?=js_asset('TabCloseMenu.js','main');?>
	<?=js_asset('searchfield.js');?>
	<?//=js_asset('ext.ux.datepickerplus-min.js');?>
	<?//=js_asset('ext.ux.datepickerplus.js');?>

	<?=js_asset('docs.js','main');?>	

    </script>
	  
	<div id="header">
		<div style="float:right; margin-right:10px; color:#ffffff;">
		<b>Admin</b>&nbsp;[ <a href="index.php?c=c_login&m=logout" style="color:ffffff">logout</a> ]
		</div>
		<div class="api-title">
			<h1>Auto2000 Sales Manejemen</h1>
		</div>
	</div>

	<!--<div id="classes"></div>-->

	<!--<div id="main"></div>-->
</body>
</html>