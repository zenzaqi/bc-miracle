// JavaScript Document
Ext.ns('Ext.ux.form');

Ext.ux.form.CFTextField = Ext.extend(Ext.form.TextField,{
    valueRenderer: null,
    initComponent: function(config) {
        Ext.ux.form.CFTextField.superclass.initComponent.apply(this, arguments);
        //this.on('blur', this);
		//this.on('keyup', this._keyup);
    },
    /*onRender: function(){
        Ext.ux.form.CFTextField.superclass.onRender.apply(this, arguments);
        this.hiddenEl = this.el.insertSibling({
            tag: 'input', type: 'hidden', name: this.hiddenName
        });
    },*/
    
    /*setHidden: function(v){
        var regEx = new RegExp(/\s?[a-z]?/gi); 
        var myValue = Ext.ux.form.CFTextField.superclass.getValue.call(this);
            
            if(myValue.match(/\s?h/gi)){
                myValue = myValue.replace(regEx, '');
                myValue = myValue*60;
            }
            else if(myValue.match(/\s?k/gi)){
                myValue = myValue.replace(regEx, '');
                myValue = myValue*1000;
            }
            else if(myValue.match(regEx)){
                myValue = myValue.replace(regEx, '');
            }
            
        this.hiddenEl.dom.value = myValue;
    },*/
    setValue: function(v){
        switch(this.valueRenderer){
            case 'numberToCurrency': v = this.currencyFormat(v); break;
            default: break;
        }
        Ext.ux.form.CFTextField.superclass.setValue.apply(this, [v]); 
    },
    getValue: function(){
		//return this.value;
		if(this.value==""){
			return 0;
		}else if(this.value==undefined){
			return 0;
		}else if(this.value!==undefined && isNaN(this.value)){
			var to_number = this.convertToNumber(this.value);
			//return this.value;
			return to_number;
		}
    },
    /*getName: function() {
        return this.hiddenName;
    },*/
	
	/*_keyup: function() {
		console.log("thisss_value = "+this.oldvalue);
	},*/
    
    currencyFormat: function(v) {
		//-- allows clearing of field value (so that $0.00 only shows if you explicitly entered zero for a value).
		if (v == null||v == ''||isNaN(v)) {
			return '';
		} else if (v > 999999999999) {
			return '';
		} else {
			return Ext.util.Format.rpMoney(v);
		}
	},
	
	convertToNumber: function(v){
		v = v.replace(/,/g,"");
		if (isNaN(v)) 
			return "";
		else{
			var tonumber = new parseFloat(v);
			return tonumber;
		}
	}
});

Ext.reg('CFTextField', Ext.ux.form.CFTextField);

function CurrencyFormatted(number){
	var str = new String(number);
	str = str.replace(/,/g,"");
	if (isNaN(str)) {
		return "";
	}else{
		//var str = new String(number);
		//str = str.replace(",","");
		var result = "";
		var len = str.length;           
		for(var i=len-1;i>=0;i--)
		{           
			if ((i+1)%3 == 0 && i+1!= len) 
				result += ",";
			result += str.charAt(len-1-i);
		}       
		return result;
	}
}

function convertToNumber(str){
	str = str.replace(/,/g,"");
	if(isNaN(str)) {
		return "";
	}else{
		var tonumber = new parseFloat(str);
		return tonumber;
	}
}