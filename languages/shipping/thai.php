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
$langvars = array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_CARRIER_LIST_LBL' => '��颹��',
	'PHPSHOP_RATE_LIST_LBL' => '�ѵ�Ҥ�Ң���',
	'PHPSHOP_CARRIER_LIST_NAME_LBL' => '����',
	'PHPSHOP_CARRIER_LIST_ORDER_LBL' => '���§�ӴѺ',
	'PHPSHOP_CARRIER_FORM_LBL' => '���ҧ / ��䢼�颹��',
	'PHPSHOP_RATE_FORM_LBL' => '���� / ����ѵ�Ҥ�Ң���',
	'PHPSHOP_RATE_FORM_NAME' => '��������´�ѵ�Ҥ�Ң���',
	'PHPSHOP_RATE_FORM_CARRIER' => '��颹��',
	'PHPSHOP_RATE_FORM_COUNTRY' => '�����:<br /><br /><i>���͡������¡��: ������ Shift ���� Ctrl ��Ф�����ҷ�</i>',
	'PHPSHOP_RATE_FORM_ZIP_START' => '��ǧ������ɳ���ҡ',
	'PHPSHOP_RATE_FORM_ZIP_END' => '�֧',
	'PHPSHOP_RATE_FORM_WEIGHT_START' => '���˹ѡ����ش',
	'PHPSHOP_RATE_FORM_WEIGHT_END' => '���˹ѡ�٧�ش',
	'PHPSHOP_RATE_FORM_PACKAGE_FEE' => '��Һ�è��պ���',
	'PHPSHOP_RATE_FORM_CURRENCY' => 'ʡ���Թ',
	'PHPSHOP_RATE_FORM_LIST_ORDER' => '���§�ӴѺ',
	'PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL' => '��颹��',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME' => '��������´�ѵ�Ҥ�Ң���',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART' => '���˹ѡ��鹵�� ...',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND' => '... �֧',
	'PHPSHOP_CARRIER_FORM_NAME' => '����ѷ��颹��',
	'PHPSHOP_CARRIER_FORM_LIST_ORDER' => '����§�ӴѺ'
); $VM_LANG->initModule( 'shipping', $langvars );
?>