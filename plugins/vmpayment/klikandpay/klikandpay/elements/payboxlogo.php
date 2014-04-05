<?php
// Check to ensure this file is within the rest of the framework
defined ('_JEXEC') or die('Direct Access to ' . basename (__FILE__) . 'is not allowed.');


/**
 * Renders a label element
 */
if (JVM_VERSION === 2) {

    if (!defined('VMKLIKANDPAYSYSPLUGINWEBASSETS'))
	define('VMKLIKANDPAYSYSPLUGINWEBASSETS', JURI::root() . VMKLIKANDPAYSYSPLUGINWEBROOT . '/klikandpaysystem/assets');
}

class JElementKlikandpaysystemLogo extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'KlikandpaysystemLogo';

	function fetchElement($name, $value, &$node, $control_name)
	{
		return '<p><a href="http://www1.klikandpay.com/" target="_blank"><img src="'. JURI::root() .   'plugins/vmpayment/alatak_klikandpaysystem/klikandpaysystem/assets/images/Klikandpay_100.jpg" /></a></p>';

	}
}