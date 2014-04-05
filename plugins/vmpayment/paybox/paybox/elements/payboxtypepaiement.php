<?php
defined ('_JEXEC') or die('Direct Access to ' . basename (__FILE__) . 'is not allowed.');

/**
 *
 * @package	VirtueMart
 * @subpackage Plugins  - Elements
 * @author Valérie Isaksen
* @copyright Copyright (c) 2004 - ${PHING.VM.RELDATE} VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: $
 */
class JElementpayboxtypepaiement extends JElement {

    /**
     * Element name
     *
     * @access	protected
     * @var		string
     */
    var $_name = 'payboxtypepaiement';

    function fetchElement($name, $value, &$node, $control_name) {
	$paymentMeans = array(
	    'CARTE',
	    'PAYPAL',
	    'CREDIT',
	    'NETRESERVE',
	    'PREPAYEE',
	    'FINAREF',
	    'BUYSTER',
	    'LEETCHI',
	    'PAYBUTTONS',
	);



	$i = 0;
	foreach ($paymentMeans as $field) {
	    $paymentMeansArray[$i]['value'] = $field;
	    $paymentMeansArray[$i++]['text'] = JText::_('VMPAYMENT_ALATAK_'.$this->_name.'SYSTEM_TYPEPAIEMENT_' . strtoupper($field));
	}

	$class = 'multiple="true" size="10"';
	return JHTML::_('select.genericlist', $paymentMeansArray, $control_name . '[' . $name . '][]', $class, 'value', 'text', $value, $control_name . $name);
    }

}