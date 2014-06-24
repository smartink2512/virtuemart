<?php
/**
 * @version $Id$
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
defined('JPATH_BASE') or die();

/**
 * Renders a label element
 */


class JElementGetAmazon extends JElement {

	/**
	 * Element name
	 *
	 * @access    protected
	 * @var        string
	 */
	var $_name = 'getAmazon';

	function fetchElement ($name, $value, &$node, $control_name) {

		$jlang = JFactory::getLanguage();
		$lang = $jlang->getTag();
		$langArray = explode("-", $lang);
		$lang = strtolower($langArray[1]);
		if ($lang == 'de') {
			$domain = 'de';
		} else {
			$domain = 'co.uk';
		}

		$url = "https://payments.amazon." . $domain . "/business/api-integration?ld=SPEXUKAPAVirtueMart";

		$logo = '<img src="https://images-na.ssl-images-amazon.com/images/G/02/Iris3_UK/en_GB/inca/images/37x23-whitegrad-x2.png" />';
		$html = '<a target="_blank" href="' . $url . '"  ">' . $logo . '</a><br />';
		$html .= '<a target="_blank" href="' . $url . '"  ">' . vmText::_('VMPAYMENT_AMAZON_GETAMAZON') . '</a>';

		return $html;
	}

}