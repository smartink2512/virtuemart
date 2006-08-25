/*--------------------------------------------------------------------------*/
/*	Lightbox	
*	This is a script for creating modal dialog windows (like the ones your operating
*	system uses)
*	
*/

var LightboxGW = {
	/* hideAll - closes all open lightbox windows */
	hideAll: function(){
		lboxes = document.getElementsByClassName('lbox')
		lboxes.each(function(box){
				Element.hide(box)
			}
		)
		if ($('overlay')){
			Element.remove('overlay');
		}
		showSelectBoxes();
	}
}
LightboxGW.base = Class.create();
LightboxGW.base.prototype = {

	initialize: function(element, options){
		//start by hiding all lightboxes
		LightboxGW.hideAll();
	
		this.element = $(element);
		this.options = Object.extend({
			lightboxClassName : 'lightbox',
			closeOnOverlayClick : false,
			showOverlay : true,
			externalControl : false
		}, options || {} )

		//create the overlay
		new Insertion.Before(this.element, "<div id='overlay' style='display:none;visibility:hidden;'></div>");
		
		//Element.addClassName(this.element, this.options.lightboxClassName)
		//also add a default lbox class to the lightbox div so we can find and close all lightboxes if we need to
		Element.addClassName(this.element, 'lbox')
		
		this.addCloser();
		
		if (this.options.closeOnOverlayClick){
			Event.observe($('overlay'), 'click', this.hideBox.bindAsEventListener(this) );
		}
		if (this.options.externalControl){
			Event.observe($(this.options.externalControl), 'click', this.hideBox.bindAsEventListener(this) );
		}
		hideSelectBoxes();
		this.showBox();	
	},
	
	addCloser : function() {
		
		//Tip: make sure the path to the close.gif image below is correct for your setup
		closer = '<img id="close" src="' + lightboxurl + 'images/close.gif" alt="Close" title="Close this window" />'

		//insert the closer image into the div
		new Insertion.Top(this.element, closer);
		
		Event.observe($('close'), 'click', this.hideBox.bindAsEventListener(this) );
	},
	
	showBox : function() {

		//center the lightbox
	   this.center();
	   if( this.options.fadeIn ) {
			if( this.options.showOverlay ) {
				//show the overlay
		   		var faderOL = new fx.Opacity( 'overlay', { duration: 4200  } );
		   		faderOL.toggle();
			}
	   		var fader = new fx.Opacity( this.element.id, { 	transition: fx.cubic, 
	   														duration: 200,
	   														onComplete:function() {
	   															this.options.duration= 3500
															    this.toggle();
															    this.options.onComplete = '';
															  } } );
	
	   		Element.show( this.element.id );
	   		fader.hide();
	   		fader.toggle();
	   		
	   		
	   } else {
			if( this.options.showOverlay ) {
				//show the overlay
				Element.show('overlay');
			}
		   	//show the lightbox
		   Element.show(this.element);
	   }
	   return false;
	},
	
	hideBox : function(evt){	
		Element.removeClassName(this.element, this.options.lightboxClassName)

	   	Element.hide(this.element);
	   
		//remove the overlay element from the DOM completely
		Element.remove('overlay');
		showSelectBoxes();
		return false;
		
	},
		
	center : function(){
		var my_width  = 0;
		var my_height = 0;
		
		if ( typeof( window.innerWidth ) == 'number' ){
			my_width  = window.innerWidth;
			my_height = window.innerHeight;
		}else if ( document.documentElement && 
				 ( document.documentElement.clientWidth ||
				   document.documentElement.clientHeight ) ){
			my_width  = document.documentElement.clientWidth;
			my_height = document.documentElement.clientHeight;
		}
		else if ( document.body && 
				( document.body.clientWidth || document.body.clientHeight ) ){
			my_width  = document.body.clientWidth;
			my_height = document.body.clientHeight;
		}
		
		this.element.style.position = 'absolute';
		this.element.style.zIndex   = 99;
		
		var scrollY = 0;
		
		if ( document.documentElement && document.documentElement.scrollTop ){
			scrollY = document.documentElement.scrollTop;
		}else if ( document.body && document.body.scrollTop ){
			scrollY = document.body.scrollTop;
		}else if ( window.pageYOffset ){
			scrollY = window.pageYOffset;
		}else if ( window.scrollY ){
			scrollY = window.scrollY;
		}
		
		var elementDimensions = Element.getDimensions(this.element);
		
		var setX = ( my_width  - elementDimensions.width  ) / 2;
		var setY = ( my_height - elementDimensions.height ) / 2 + scrollY;
		
		setX = ( setX < 0 ) ? 0 : setX;
		setY = ( setY < 0 ) ? 0 : setY;
		
		this.element.style.left = setX + "px";
		this.element.style.top  = setY + "px";
		
	},
	
	setInnerHTML : function( html ) {
		this.element.innerHTML = html;
		this.addCloser();
	}
}

function lightBoxTimeout() {
	setTimeout( 'LightboxGW.hideAll()', 2000 );
}

function showSelectBoxes(){
	if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer") {
		selects = document.getElementsByTagName("select");
		for (i = 0; i != selects.length; i++) {
			selects[i].style.visibility = "visible";
		}
	}
}

// ---------------------------------------------------

function hideSelectBoxes(){
	if (navigator.platform == "Win32" && navigator.appName == "Microsoft Internet Explorer") {
		selects = document.getElementsByTagName("select");
		for (i = 0; i != selects.length; i++) {
			selects[i].style.visibility = "hidden";
		}
	}
}
function showLoadingLightbox() {
	var lb = new LightboxGW.base('statusBox', { showOverlay: false });
	lb.setInnerHTML( '<img src="'+lightboxurl+'images/loading.gif" border="0" align="middle" alt="Loading..." />' );	
}

function showMessagesinLightBox() {
	if( $('logContainer') ) {
		if( $('logContainer').innerHTML != '' ) {
		
			if( !lb ) {
				var lb = new LightboxGW.base('statusBox', { showOverlay: false, fadeIn: true });
			}
			lb.setInnerHTML( $('logContainer').innerHTML );
			//lightBoxTimeout();
		}
	}
}