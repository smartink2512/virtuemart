<?php
defined('_JEXEC') or die();
/**
 *
 * @package	VirtueMart
 * @subpackage Plugins  - Elements
 * @author Val?rie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2011 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: $
 */
/*
 * This class is used by VirtueMart Payment or Shipping Plugins
 * which uses JParameter
 * So It should be an extension of JElement
 * Those plugins cannot be configured througth the Plugin Manager anyway.
 */
class JElementsofortproducts extends JElement {

    /**
     * Element name
     * @access	protected
     * @var		string
     */
    var $_name = 'sofortproducts';
    var $type = 'sofortproducts';

    function fetchElement($name, $value, &$node, $control_name) {
 $sofortproducts= array(
	 'banking' => JText::_('VMPAYMENT_SOFORT_PRODUCT_BANKING'),
	 'ideal' => JText::_('VMPAYMENT_SOFORT_PRODUCT_IDEAL'),
 );

	$class = 'multiple="true" size="10"';
	return JHTML::_('select.genericlist', $sofortproducts, $control_name . '[' . $name . '][]', $class, 'value', 'text', $value, $control_name . $name);
    }

}