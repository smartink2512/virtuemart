/**
 * AJAX FUNCTIONS 
 * 
 */


function loadNewPage( el, url ) {
	new mooajax( url, { update: el } );
}