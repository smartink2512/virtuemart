/**
 * mediahandler.js: for VirtueMart Mediahandler
 *
 * @package    VirtueMart
 * @subpackage Javascript Library
 * @authors    Patrick Kohl, Max Milbers
 * @copyright  Copyright (c) 2011-2016 VirtueMart Team. All rights reserved.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

jQuery(document).ready(function($){

	var media = $('#searchMedia').data();
	var searchMedia = $('input#searchMedia');
	searchMedia.click(function () {
		if (media.start>0) media.start=0;
	});
	searchMedia.autocomplete({
		source: Virtuemart.medialink,
		select: function(event, ui){
			$('#ImagesContainer').append(ui.item.label);
			//$(this).autocomplete( 'option' , 'source' , '". JURI::root(false) ."administrator/index.php?option=com_virtuemart&view=product&task=getData&format=json&type=relatedcategories&row='+nextCustom )
		},
		minLength:1,
		html: true
	});
	$('.js-pages').click(function (e) {
		e.preventDefault();
		if (searchMedia.val() =='') {
			searchMedia.val(' ');
			media.start = 0;
		} else if ($(this).hasClass('js-next')) media.start = media.start+16 ;
		else if (media.start > 0) media.start = media.start-16 ;
		searchMedia.autocomplete( 'option' , 'source' , medialink+'&start='+media.start );
		searchMedia.autocomplete( 'search');
	});
	$('#ImagesContainer').sortable({
		update: function(event, ui) {
			$(this).find('.ordering').each(function(index,element) {
				$(element).val(index);
			});
		}
	});
	$('[name="upload"]').on ('change', function (){
		var rr = $(this).parent().find("[name='media[media_action]']:checked");
		if (typeof $(rr[0]).val() != 'undefined' && $(rr[0]).val() == 0) {
			var rs = $(this).parent().find("[id='media[media_action]upload']").attr('checked', true);
		}
	});
});