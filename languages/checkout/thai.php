<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : thai.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_NO_CUSTOMER' => '��ҹ�ѧ�����ŧ����¹ ��س��к���������´�ͧ��ҹ',
	'PHPSHOP_THANKYOU' => '�ͺ�س�����觫����Թ���',
	'PHPSHOP_EMAIL_SENDTO' => '����׹�ѹ��¡����Ѵ�����ҧ����������',
	'PHPSHOP_CHECKOUT_NEXT' => '�Ѵ�',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => '���˹��',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => '����ѷ',
	'PHPSHOP_CHECKOUT_CONF_NAME' => '����',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => '�������',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => '������',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => '��������´��èѴ��',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => '����ѷ',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => '����',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => '�������',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => '���Ѿ��',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => '�����',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => '�Ըա�ê����Թ',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => '�к���������´��������͡��ê����Թ���ºѵ��ôԵ',
	'PHPSHOP_PAYPAL_THANKYOU' => '�ͺ�س����Ѻ��ê����Թ ��÷Ӹ�á����ͧ��ҹ���º���������<br />��ҹ�����Ѻ�������׹�ѹ��÷���¡�èҡ�ҧ PayPal ��觷�ҹ����ö��͡�Թ������价�� <a href=http://www.paypal.com>www.paypal.com</a> ���ʹ���������´��',
	'PHPSHOP_PAYPAL_ERROR' => '�Դ�����Դ��Ҵ�����ҧ��÷���¡�� ʶҹС����觫����ѧ���������¹�ŧ',
	'PHPSHOP_THANKYOU_SUCCESS' => '��¡����觫��ͧ͢��ҹ���Ѻ��ô��Թ������º��������!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>