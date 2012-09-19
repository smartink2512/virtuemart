<?php
/**
 * @version $Id: getheidelpay.php 6369 2012-08-22 14:33:46Z alatak $
 *
 * @author Valérie Isaksen
 * @package VirtueMart
 * @copyright Copyright (c) 2004 - 2012 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
defined ('JPATH_BASE') or die();

/**
 * Renders a label element
 */


class JElementGetHeidelpay extends JElement {

	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	var $_name = 'getHeidelpay';

	function fetchElement ($name, $value, &$node, $control_name) {
	$js = '
		jQuery(document).ready(function( $ ) {
			$("#heidelpay_getheidelpay_show_hide").hide();
			jQuery("#heidelpay_getheidelpay_link").click( function() {
				 if ( $("#heidelpay_getheidelpay_show_hide").is(":visible") ) {
				  $("#heidelpay_getheidelpay_show_hide").hide("slow");
			        $("#heidelpay_getheidelpay_link").html("' . addslashes (JText::_ ('VMPAYMENT_HEIDELPAY_GET_HEIDELPAY_SHOW')) . '");
				} else {
				 $("#heidelpay_getheidelpay_show_hide").show("slow");
			       $("#heidelpay_getheidelpay_link").html("' . addslashes (JText::_ ('VMPAYMENT_HEIDELPAY_GET_HEIDELPAY_HIDE')) . '");
			    }
		    });
		});
';

		$doc = JFactory::getDocument ();
		$doc->addScriptDeclaration ($js);
		
		
		$lang = $this->getLang();



			$html = '<a href="#" id="heidelpay_getheidelpay_link" ">' . JText::_ ('VMPAYMENT_HEIDELPAY_GET_HEIDELPAY_SHOW') . '</a>';

		$html .= '<div id="heidelpay_getheidelpay_show_hide" >';
		$url="http://demoshops.heidelpay.de/contactform/?campaign=vituemart&shop=vituemart&lang=".$lang;
$html .= '<iframe src="' .$url . '" scrolling="yes" style="x-overflow: none;" frameborder="0" height="600px" width="650px"></iframe>';
		$html .="</div>";
		return $html;
	}
	
	protected function getLang () {

		$language =& JFactory::getLanguage ();
		$tag = strtolower (substr ($language->get ('tag'), 0, 2));
		return $tag;
	}

}