<div id="welcome">
	
	<style type="text/css">
	#all-shortcut {
        width:600px;
    }
    .shortcut {
        clear:both;
        font:normal 14px tahoma,arial,verdana,sans-serif;
    }
    .shortcut dt {
        float:left;
        width:100px;
        margin:5px 5px 15px;
        text-align:center;
        font:normal 14px tahoma,arial,verdana,sans-serif;
    }
    .shortcut dt img {
        margin-bottom:5px;
    }
	</style>
	
	<script>	
	WelcomePanel = Ext.extend(Ext.Panel, {
	    autoHeight: true,
	    frame:true,
	    collapsible: true,
	    cls:'shortcut',

	    afterRender : function(){
	        WelcomePanel.superclass.afterRender.call(this);
	        this.tpl.overwrite(this.body, this);
	    },

	    tpl : new Ext.XTemplate(
	        '<dl>',
	            '<tpl for="samples">',
	            '<dt><span style="cursor: pointer;" onclick="mainPanel.loadClass(\'{url}\', \'{idp}\');"><img src="assets/images/shortcut_button/{icon}"/></span><br/>',
	                '<span style="cursor: pointer; font-size: 12px;" onclick="mainPanel.loadClass(\'{url}\', \'{idp}\');">{text}</span>',
	            '</dt>',
	            '</tpl>',
	        '</dl><div style="clear:both"></div>'
	    )
	});
	
	Ext.onReady(function() {		
		var reminder = new Ext.Panel({
	        id: 'preminder',
			title: 'Reminder',
			renderTo : 'area_reminder',
			width:220,
			height:445,
            style: 'background: #fff;',
			iconCls: 'icon-reminder',
			animCollapse:true,
			collapsible:true,
			layout:'accordion',
			border:true,
			layoutConfig: {
				animate:false
			},

			items: [{
				title: 'News Event',
				bodyStyle: 'padding: 5px 10px;',
				<? if( true ) {	// Show the notification message when it raised. ?>					
					iconCls: 'icon-event-anim',						
					html :'<div style="font-size: 10.5px;">'+
						  '<p style="margin-bottom: 5px;">Below is the example notification '+
														 'for template text: </p>'+
						  '<p style="margin-left: 10px;">1. User Sample </p>'+
						  '<p style="margin-left: 10px;">2. Form Sample </p>'+
						  '<p style="margin-left: 10px;">3. Window Sample </p>'+
						  '<p style="margin-left: 10px;">4. CRUD Sample </p>'+
						  '<p style="margin-left: 10px;">5. About Sample </p>'+
						  '<p style="margin-left: 10px;">6. Menu Sample </p>'+
						  '<p style="margin-bottom: 5px; margin-left: 10px;">7. etc... </p>'+
						  '<p>[ File path: '+
							'<a href="<?=base_url().'system/application/views/V_welcome.php'?>">'+
							'V_welcome.php</a> ]</p>'							  
				<? } else {  		// Default message for  ?>					
					iconCls: 'icon-notes',						
					html :'<div style="font-size: 10.5px;">'+
						  '<p>You haven\'t any message.</p>'
						  
				<? }?>
			},{
				title: 'Legend', 
				bodyStyle: 'padding: 5px 10px;',
				iconCls: 'icon-config',
				html:'<div style="font-size: 10.5px;">'+
						 '<p style="margin-bottom: 5px;">Below is the explanation for Icon '+
														'Reminder notification: </p>'+
														
						 '<p style="margin-bottom: 5px; padding-left: 10px;">'+
							 '<img src="assets/modules/main/images/notes.png" style="margin-right:8px;" />'+
							 'Nothing happen.'+
						 '</p>'+
						 
						 '<p style="padding-left: 10px;">'+
							 '<img src="assets/modules/main/images/event-anim.gif" style="margin-right:8px;" />'+
							 'Event raised notification.'+
						 '</p>'+						 
					 '</div>',
				autoScroll:true
			}]
	    });	
	});
	</script>
	<div class="col">
		<div id="all-shortcut"></div>
    </div>
    <div id="area_reminder" class="col-last"></div>
</div>