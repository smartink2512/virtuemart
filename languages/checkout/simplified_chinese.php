<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : simplified_chinese.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'GB2312',
	'PHPSHOP_NO_CUSTOMER' => '����û��ע���Ϊ��Ա�����ṩ����֧����Ϣ��',
	'PHPSHOP_THANKYOU' => '��л���Ķ�����',
	'PHPSHOP_EMAIL_SENDTO' => 'ȷ���ʼ��ѷ���',
	'PHPSHOP_CHECKOUT_NEXT' => '��һ��',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => '������Ϣ',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => '��˾',
	'PHPSHOP_CHECKOUT_CONF_NAME' => '����',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => '��ַ',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => '�ͻ���Ϣ',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => '��˾',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => '����',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => '��ַ',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => '�绰',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => '����',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => '���ʽ',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => '��ѡ�����ÿ�����ʱ�ı�����Ϣ',
	'PHPSHOP_PAYPAL_THANKYOU' => 'лл��֧�������׳ɹ����㽫���յ�����PayPal��ȷ���ʼ�������Լ������½ <a href=http://www.paypal.com>www.paypal.com</a> �鿴������Ϣ',
	'PHPSHOP_PAYPAL_ERROR' => '������ʱ����������Ķ���״̬�޷�����.',
	'PHPSHOP_THANKYOU_SUCCESS' => '���Ķ����Ѿ��ɹ��ύ',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>