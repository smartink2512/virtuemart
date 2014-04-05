<?php

/**
 *
 * @package	VirtueMart
 * @subpackage Plugins  - Elements
 * @author Valérie Isaksen
 * @link http://www.alatak.net
 * @copyright Copyright (c) alatak;net. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: $
 */
// Check to ensure this file is within the rest of the framework
defined ('_JEXEC') or die('Direct Access to ' . basename (__FILE__) . 'is not allowed.');

/**
 * Renders a label element
 */

class JElementKlikandpaysystemLabel extends JElement
{
	/**
	* Element name
	*
	* @access	protected
	* @var		string
	*/
	var	$_name = 'KlikandpaysystemLabel';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$class = ( $node->attributes('class') ? 'class="'.$node->attributes('class').'"' : 'class="text_area"' );
		return '<label for="'.$name.'"'.$class.'>'.$value.'</label>';
	}
}