<?php
defined('_JEXEC') or die('');

/**
 * Renders the email for the shoppers from the waiting list, or who bought this product
 * @package	VirtueMart
 * @subpackage product details
 * @author Seyi
 * @author Valérie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2012 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id$
 */

echo $this->vendorAddress;
echo "\n";
echo "\n";
echo JText::sprintf ('COM_VIRTUEMART_MAIL_SHOPPER_NAME', $this->user->name);
echo "\n";
echo "\n";
if(!empty($this->mailbody)) {
	echo $this->mailbody;
} else {
	echo str_replace( "<br />", "\n", JText::sprintf('COM_VIRTUEMART_CART_NOTIFY_MAIL_RAW', $this->productName,$this->link) );
}

echo "\n";
