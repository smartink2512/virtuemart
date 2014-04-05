<?php
/**
 * @version $Id: getklikandpay.php 6369 2012-08-22 14:33:46Z alatak $
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


class JElementGetKlikandpay extends JElement {

	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	var $_name = 'getKlikandpay';

	function fetchElement ($name, $value, &$node, $control_name) {

		$js = '
//<![CDATA[
		jQuery(document).ready(function( $ ) {

		    jQuery("#klikandpay_getklikandpay_link").click( function() {
				 if ( $("#klikandpay_getklikandpay_show_hide").is(":visible") ) {
				  $("#klikandpay_getklikandpay_show_hide").hide("slow");
			        $("#klikandpay_getklikandpay_link").html("' . addslashes (JText::_ ('VMPAYMENT_KLIKANDPAY_ALREADY_ACCOUNT')) . '");
				} else {
				 $("#klikandpay_getklikandpay_show_hide").show("slow");
			       $("#klikandpay_getklikandpay_link").html("' . addslashes (JText::_ ('VMPAYMENT_KLIKANDPAY_GET_KLIKANDPAY_HIDE')) . '");
			    }
		    });
		});
//]]>
';

		$doc = JFactory::getDocument ();
		$doc->addScriptDeclaration ($js);

		$cid = jrequest::getvar ('cid', NULL, 'array');
		if (is_Array ($cid)) {
			$virtuemart_paymentmethod_id = $cid[0];
		} else {
			$virtuemart_paymentmethod_id = $cid;
		}

		$query = "SELECT * FROM `#__virtuemart_paymentmethods` WHERE  virtuemart_paymentmethod_id = '" . $virtuemart_paymentmethod_id . "'";
		$db = JFactory::getDBO ();
		$db->setQuery ($query);
		$params = $db->loadObject();

	if ($params->created_on==$params->modified_on ) {
		$id = "klikandpay_getklikandpay_link";
		$html = '<a href="#" id="' . $id . '">' . JText::_ ('VMPAYMENT_KLIKANDPAY_GET_KLIKANDPAY_HIDE') . '</a>';
		$display='';
		$html .= '<div id="klikandpay_getklikandpay_show_hide" align=""'.$display.' >';
	} else {
		$id = "klikandpay_getklikandpay_link";
		$html = '<a href="#" id="' . $id . '">' . JText::_ ('VMPAYMENT_KLIKANDPAY_ALREADY_ACCOUNT') . '</a>';
		$display=' style="display: none;"';
		$html .= '<div id="klikandpay_getklikandpay_show_hide" align=""'.$display.' >';
	}
		$id="";


		$lang = $this->getLang ();

	;
		if ($lang=='fr') {
			$url="http://www1.klikandpay.com/default.aspx?0.5187125992961228";
		} else {
			$url="http://www1.klikandpay.com/default.aspx?0.6721770374570042";
		}
		$html .= '<iframe src="' . $url . '" scrolling="yes" style="x-overflow: none;" frameborder="0" height="1400px" width="800px"></iframe>';
		$html .= "</div>";
		return $html;
	}

	protected function getLang () {


		$language =& JFactory::getLanguage ();
		$tag = strtolower (substr ($language->get ('tag'), 0, 2));
		return $tag;
	}


}