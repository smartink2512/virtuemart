<?php
/**
*
* Layout for the shopping cart, look in mailshopper for more details
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
/* TODO Chnage the footer place in helper or assets ???*/
if (empty($this->vendor)) {
		$vendorModel = $this->getModel('vendor');
		$this->vendor = $vendorModel->getVendor();
}

$uri    = JURI::getInstance();
$prefix = $uri->toString(array('scheme', 'host', 'port'));
$link = JRoute::_ ( 'index.php?option=com_virtuemart' );

echo '<br/><br/><b>'.JHTML::_('link',$prefix.$link, $this->vendor->vendor_name).'</b> :: ';

//	echo JText::_('COM_VIRTUEMART_CART_MAIL_VENDOR_TITLE').$this->vendor->vendor_name.'<br/>';
/* GENERAL FOOTER FOR ALL MAILS */
	echo JText::_('COM_VIRTUEMART_CART_MAIL_FOOTER');
        echo '<br/>';
	echo $this->vendor->vendor_name .'<br/>'.$this->vendor->vendor_phone .' '.$this->vendor->vendor_store_name .'<br/ > '.$this->vendor->vendor_store_desc;

	?>