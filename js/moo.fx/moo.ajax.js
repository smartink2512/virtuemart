//based on prototype's ajax class
//to be used with prototype.lite, moofx.mad4milk.net.
//setForm added by soeren from yahoo! connection manager
ajax = Class.create();
ajax.prototype = {
	initialize: function(url, options){
		this.transport = this.getTransport();
		this.postBody = options.postBody || '';
		this.formName = options.formName || ''; //Added by soeren
		this.pseudoForm = $(options.pseudoForm) || ''; //Added by soeren
		this.method = options.method || 'post';
		this.onComplete = options.onComplete || null;
		if( $(options.update) ) {
			this.update = $(options.update);
		} else if( options.update ) {
			this.update = options.update;
		} else { this.update = null;}
		this.property =  options.property || 'innerHTML';//Added by soeren
		if( this.formName ) {
			this.setForm( this.formName );
		}
		if( this.pseudoForm ) {
			this.setPseudoForm( this.pseudoForm );
		}
		this.request(url);
	},

	request: function(url){
		this.transport.open(this.method, url, true);
		this.transport.onreadystatechange = this.onStateChange.bind(this);
		if (this.method == 'post') {
			this.transport.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			if (this.transport.overrideMimeType) this.transport.setRequestHeader('Connection', 'close');
		}
		this.transport.send(this.postBody);
	},

	onStateChange: function(){
		if (this.transport.readyState == 4 && this.transport.status == 200) {
			if (this.onComplete) 
				setTimeout(function(){this.onComplete(this.transport);}.bind(this), 10);
			if (this.update) {// changed!! Erased 'innerHTML' in the line below
				this.update.innerHTML = this.transport.responseText;
				setTimeout(function(){eval('this.update.' + this.property + ' = this.transport.responseText')}.bind(this), 10);
			}
			this.transport.onreadystatechange = function(){};
		}
	},
  /**
   * This method assembles the form label and value pairs and
   * constructs an encoded POST body. 
   * @author Yahoo! Inc. All rights reserved.
   * @copyright (c) 2006 Yahoo! Inc. All rights reserved.
   * @public
   * @param {string} formName value of form name attribute
   * @return void
   */
	setForm: function(formName)	{ // added by soeren
		this.postBody = '';
		var oForm = document.forms[formName];
		var oElement, elName, elValue;
		// iterate over the form elements collection to construct the
		// label-value pairs.
		for (var i=0; i<oForm.elements.length; i++){
			oElement = oForm.elements[i];
			elName = oForm.elements[i].name;
			elValue = oForm.elements[i].value;
			switch (oElement.type)
			{
				case 'select-multiple':
					for(var j=0; j<oElement.options.length; j++){
						if(oElement.options[j].selected){
							this.postBody += encodeURIComponent(elName) + '=' + encodeURIComponent(oElement.options[j].value) + '&';
						}
					}
					break;
				case 'radio':
				case 'checkbox':
					if(oElement.checked){
						this.postBody += encodeURIComponent(elName) + '=' + encodeURIComponent(elValue) + '&';
					}
					break;
				case 'file':
				// stub case as XMLHttpRequest will only send the file path as a string.
					break;
				case undefined:
				// stub case for fieldset element which returns undefined.
					break;
				default:
					this.postBody += encodeURIComponent(elName) + '=' + encodeURIComponent(elValue) + '&';
					break;
			}
		}
		this.postBody = this.postBody.substr(0, this.postBody.length - 1);
		this.method = 'post';
	},
	/**
	* This function is only needed because we have lists in Joomla
	* which are surrounded by a form. If we try to insert a form into
	* a table cell, Internet Explorer throws a JS runtime-error,
	* so we insert a <div><input .... /><input ... /></div> and simulate a form
	*/
	setPseudoForm: function( node ) {
		this.postBody = '';
		var oElements = new Array();
		if( node.childNodes ) {
			for (var i=0; i<node.childNodes.length; i++){
				if( node.childNodes[i].nodeName == 'INPUT' 
				 || node.childNodes[i].nodeName == 'SELECT' 
				 || node.childNodes[i].nodeName == 'TEXTAREA' 
				) {
					oElements.push( node.childNodes[i] );
				}
			}
		}
		
		for (var i=0; i<oElements.length; i++){
			oElement = oElements[i];
			elName = oElements[i].name;
			elValue = oElements[i].value;
			switch (oElement.type)
			{
				case 'select-multiple':
					for(var j=0; j<oElement.options.length; j++){
						if(oElement.options[j].selected){
							this.postBody += encodeURIComponent(elName) + '=' + encodeURIComponent(oElement.options[j].value) + '&';
						}
					}
					break;
				case 'radio':
				case 'checkbox':
					if(oElement.checked){
						this.postBody += encodeURIComponent(elName) + '=' + encodeURIComponent(elValue) + '&';
					}
					break;
				case 'file':
				// stub case as XMLHttpRequest will only send the file path as a string.
					break;
				case undefined:
				// stub case for fieldset element which returns undefined.
					break;
				default:
					this.postBody += encodeURIComponent(elName) + '=' + encodeURIComponent(elValue) + '&';
					break;
			}
		}
		this.postBody = this.postBody.substr(0, this.postBody.length - 1);
		this.method = 'post';
	},
	
	getTransport: function() {
		if (window.ActiveXObject) return new ActiveXObject('Microsoft.XMLHTTP');
		else if (window.XMLHttpRequest) return new XMLHttpRequest();
		else return false;
	}
};