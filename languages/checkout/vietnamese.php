<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : vietnamese.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Bạn chưa đăng ký khách hàng. Hãy chuẩn bị các thông tin cần thiết cho việc đăng ký.',
	'PHPSHOP_THANKYOU' => 'Cảm ơn đã mua hàng.',
	'PHPSHOP_EMAIL_SENDTO' => 'Email xác nhận đã gửi cho',
	'PHPSHOP_CHECKOUT_NEXT' => 'Next',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Billing Thông tin',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Công ty',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Tên',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Địa chỉ',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Thông tin vận chuyển',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Công ty',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Tên',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Địa chỉ',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Điện thoại',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Cách thanh toán',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'yêu cầu thông tin khi chọn cách trả tiền bằng Credit Card',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Thanks cho your payment. 
        The transaction was successful. You will get a confirmation e-mail cho the transaction by PayPal. 
        You can now continue or log in at <a href=http://www.paypal.com>www.paypal.com</a> to see the transaction details.',
	'PHPSHOP_PAYPAL_ERROR' => 'An error occured while processing your transaction. The status of your order could not be updated.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Quá trình mua hàng đã hoàn tất!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>