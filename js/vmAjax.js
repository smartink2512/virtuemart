/**
 * AJAX FUNCTIONS 
 * 
 */


function loadNewPage( el, url ) {
	new ajax( url + '&only_page=1', { update: el } );
}