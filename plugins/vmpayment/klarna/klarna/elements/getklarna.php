<?php

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();


/**
 * Renders a label element
 */
if (JVM_VERSION === 2) {
    require ( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'klarna' . DS . 'helpers' . DS . 'define.php');
    if (!class_exists('KlarnaHandler'))
    require ( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'klarna' . DS . 'helpers' . DS . 'klarnahandler.php');
} else {
    require ( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'helpers' . DS . 'define.php');
    if (!class_exists('KlarnaHandler'))
    require ( JPATH_ROOT . DS . 'plugins' . DS . 'vmpayment' . DS . 'klarna' . DS . 'helpers' . DS . 'klarnahandler.php');
}

class JElementGetKlarna extends JElement {

    /**
     * Element name
     *
     * @access	protected
     * @var		string
     */
    var $_name = 'getKlarna';

    function fetchElement($name, $value, &$node, $control_name) {
	$countriesData = KlarnaHandler::countriesData();
	$logo = '<a href="https://merchants.klarna.com/signup?locale=en&partner_id=7829355537eae268a17667c199e7c7662d3391f7&utm_campaign=Platform&utm_medium=Partners&utm_source=Virtuemart" target="_blank"><img src="' . JURI::root() . VMKLARNAPLUGINWEBROOT . '/klarna/assets/images/logo/get_klarna_now.png" /></a> ';
	return $logo  ;
    }

}