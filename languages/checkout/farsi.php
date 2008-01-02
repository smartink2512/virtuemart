<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : farsi.php 1071 2007-12-03 08:42:28Z thepisu $
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @translator soeren
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
global $VM_LANG;
$VM_LANG->initModule('checkout',array (
	'CHARSET' => 'UTF-8',
	'PHPSHOP_NO_CUSTOMER' => 'مهمان گرامی! شما هنوز در این سایت ثبت نام نکرده اید. لطفا اطلاعات خود را وارد نمائید',
	'PHPSHOP_THANKYOU' => 'با تشکر از خرید شما',
	'PHPSHOP_EMAIL_SENDTO' => 'A confirmation email has been sent to',
	'PHPSHOP_CHECKOUT_NEXT' => 'بعدی',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Billing Information',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Company',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Name',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Address',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Shipping Information',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Company',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Name',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Address',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Phone',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Payment Method',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'required infomation when Payment via Credit Card is selected',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Thanks for your payment. 
        The transaction was successful. You will get a confirmation e-mail for the transaction by PayPal. 
        You can now continue or log in at <a href=http://www.paypal.com>www.paypal.com</a> to see the transaction details.',
	'PHPSHOP_PAYPAL_ERROR' => 'An error occured while processing your transaction. The status of your order could not be updated.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Your order has been successfully placed!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>