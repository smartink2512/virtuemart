<?php
// Check to ensure this file is within the rest of the framework
defined ('_JEXEC') or die('Direct Access to ' . basename (__FILE__) . 'is not allowed.');


/**
 * Renders a label element
 */
if (JVM_VERSION === 2) {

    if (!defined('VMPAYBOXSYSPLUGINWEBASSETS'))
	define('VMPAYBOXSYSPLUGINWEBASSETS', JURI::root() . VMPAYBOXSYSPLUGINWEBROOT . '/payboxsystem/assets');
}

class JElementPayboxsystemLogo extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'PayboxsystemLogo';

	function fetchElement($name, $value, &$node, $control_name)
	{
		return '<p><a href="http://www1.paybox.com/" target="_blank"><img src="'. JURI::root() .   'plugins/vmpayment/alatak_payboxsystem/payboxsystem/assets/images/Paybox_100.jpg" /></a></p>';

	}
}