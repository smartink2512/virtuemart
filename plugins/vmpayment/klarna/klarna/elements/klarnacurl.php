<?php
defined ('_JEXEC') or die('Restricted access');

/**
 * @version $Id$
 *
 * @author Valérie Isaksen
 * @package VirtueMart

 * @copyright Copyright (C) iStraxx - All rights reserved.
 * @license istraxx_license.txt Proprietary License. This code belongs to istraxx UG (haftungsbeschränkt)
 * You are not allowed to distribute or sell this code.
 * You are not allowed to modify this code
 */

class JElementKlarnaCurl extends JElement {

	var $_name = 'klarnacurl';

	function fetchElement ($name, $value, &$node, $control_name) {

		JPlugin::loadLanguage ('com_virtuemart', JPATH_ADMINISTRATOR);
		if (!function_exists ('curl_init') or !function_exists ('curl_exec')) {
			return JTExt::_ ('VMPAYMENT_KLARNA_CURL_LIBRARY_NOT_INSTALLED');
		}
		else {
			return JTExt::_ ('VMPAYMENT_KLARNA_CURL_LIBRARY_INSTALLED');
		}
	}

}