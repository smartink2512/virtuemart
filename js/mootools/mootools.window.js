/*
Script: Window.js
	Window methods, as those to get the size or a better onload.
		
Dependencies:
	<Moo.js>, <Function.js>

Author:
	Valerio Proietti, <http://mad4milk.net>

License:
	MIT-style license.
*/

/*
Class: Window
	Cross browser methods to get the window size, onDomReady method.
*/

var Window = {

	extend: Object.extend,
	
	/*	
	Property: getWidth
		Returns an integer representing the width of the browser.
	*/

	getWidth: function(){
		return window.innerWidth || document.documentElement.clientWidth || 0;
	},
	
	/*
	Property: getHeight
		Returns an integer representing the height of the browser.
	*/

	getHeight: function(){
		return window.innerHeight || document.documentElement.clientHeight || 0;
	},

	/*
	Property: getScrollHeight
		Returns an integer representing the scrollHeight of the window.

	See Also:
		<http://developer.mozilla.org/en/docs/DOM:element.scrollHeight>
	*/

	getScrollHeight: function(){
		return document.documentElement.scrollHeight;
	},

	/*
	Property: getScrollWidth
		Returns an integer representing the scrollWidth of the window.
		
	See Also:
		<http://developer.mozilla.org/en/docs/DOM:element.scrollWidth>
	*/

	getScrollWidth: function(){
		return document.documentElement.scrollWidth;
	},

	/*	
	Property: getScrollTop
		Returns an integer representing the scrollTop of the window (the number of pixels the window has scrolled from the top).
		
	See Also:
		<http://developer.mozilla.org/en/docs/DOM:element.scrollTop>
	*/

	getScrollTop: function(){
		return document.documentElement.scrollTop || window.pageYOffset || 0;
	},

	/*
	Property: getScrollLeft
		Returns an integer representing the scrollLeft of the window (the number of pixels the window has scrolled from the left).
		
	See Also:
		<http://developer.mozilla.org/en/docs/DOM:element.scrollLeft>
	*/
	
	getScrollLeft: function(){
		return document.documentElement.scrollLeft || window.pageXOffset || 0;
	},
	
	/*
	Property: onDomReady
		Executes the passed in function when the DOM is ready (when the document tree has loaded, not waiting for images).
		
	Credits:
		(c) Dean Edwards/Matthias Miller/John Resig, remastered for mootools
		
	Arguments:
		init - the function to execute when the DOM is ready
		
	Example:
		> Window.onDomReady(function(){alert('the dom is ready');});
	*/

	onDomReady: function(init){
		var listen = document.addEventListener;
		var state = document.readyState;
		if (listen) document.addEventListener("DOMContentLoaded", init, false); //moz || opr9
		if (state) { //saf || ie
			document.write('<script id="_ie_load_" defer="true"></script>');
			var scr = $('_ie_load_');
			if (scr.readyState){ //ie
				scr.onreadystatechange = function() {
					if (this.readyState.test(/complete|loaded/)) init();
				};
			} else { //saf
				if (state.test(/complete|loaded/)) init();
				else return Window.onDomReady.pass(init).delay(10);
			}
		} else if (!listen || window.opera && navigator.appVersion.toInt() < 9) { //others
			window.addEvent('init', init);
		}
	}	
};