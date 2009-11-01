// JavaScript Document

Ext.BLANK_IMAGE_URL = 'assets/images/s.gif';

//validation vtype
Ext.apply(Ext.form.VTypes, {

	password : function(val, field) {
		if (field.initialPassField) {
			var login = Ext.getCmp(field.initialPassField);
			return (val == login.getValue());
		}
		return true;
	},
	passwordText : 'Passwords do not match' //alert if you enter a password that is not the same
});

var usernameField="";
var passwordField="";
var warningField="";
	
Ext.onReady(function(){
	Ext.QuickTips.init();
	
	function authenticate(oGrid_event){
				loginForm.getForm().submit({
					method:'POST',
					waitTitle:'Please wait.....',
					waitMsg:'Authenticate...',
					success:function(){
								var redirect = 'index.php?c=main';
								window.location = redirect;
					},
					failure:function(form, action){
						obj = Ext.util.JSON.decode(action.response.responseText);
						if(action.failureType == 'server'){
							Ext.Msg.alert('Server Failed!', 'Authentication server is unreachable : ' + obj.msg);
						} else {
							Ext.Msg.alert('Login Failed!', obj.msg );
						}
						loginForm.getForm().reset();
					}
				});
	}
	

	
	usernameField=new Ext.form.TextField({
		fieldLabel:'Username',
		name:'username',
		width:190,
		allowBlank:false
	});
	
	
	passwordField=new Ext.form.TextField({
			fieldLabel:'Password',
			name:'password',
			width:190,
			inputType:'password',
			id: 'pass',
			enableKeyEvents: true,
			allowBlank:false,
			listeners: {
                specialkey: function(field, e){
                    if (e.getKey() == e.ENTER) {
                      //  var form = field.ownerCt.getForm();
                        authenticate();
                    }
                }
            }

	});
	
	
	warningField=new Ext.form.Label({
			html: '<font color=red>Aplikasi ini dapat berjalan dengan baik di atas browser minimal <a href=\'http://www.mozilla.com\' target=\'_blank\'>Mozilla Firefox 2</a> atau Internet Explorer 7, dengan resolusi terbaik 1024x768 pixel</font>'
	});
	
	var loginForm = new Ext.FormPanel({
		labelWidth:90,
		url:'index.php?c=c_login&m=verify',
		frame:true,
		width:320,
		autoHeight:true,
/*		padding:200,*/
		defaultType:'textfield',
		items:[{
			xtype:'box', //create image
			autoEl:{
				tag:'img',
				src:'assets/images/login.png'
			}
		},usernameField
		,passwordField],
		buttons:[{
			text:'Login',
			handler: authenticate
		},{
			text: 'Reset',
			handler: function(){
				loginForm.getForm().reset();
			}
		}]
});
		
	var createwindow = new Ext.Window({
		frame:true,
		title:'<center>Login Authentication</center>',
		width:330,
		height:175,
		closable: false,
		items: loginForm
	});
	
	createwindow.show();
});
