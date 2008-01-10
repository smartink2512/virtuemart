<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : finnish.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_CARRIER_LIST_LBL' => 'Huolitsija luettelo',
	'PHPSHOP_RATE_LIST_LBL' => 'Tariffi luettelo',
	'PHPSHOP_CARRIER_LIST_NAME_LBL' => 'Nimi',
	'PHPSHOP_CARRIER_LIST_ORDER_LBL' => 'Luettelojärjestys',
	'PHPSHOP_CARRIER_FORM_LBL' => 'Huolitsija muokkaa / luo',
	'PHPSHOP_RATE_FORM_LBL' => 'Tariffi muokkaa/luo',
	'PHPSHOP_RATE_FORM_NAME' => 'Tariffi kuvaus',
	'PHPSHOP_RATE_FORM_CARRIER' => 'Huolitsija',
	'PHPSHOP_RATE_FORM_COUNTRY' => 'Maa<br>Monivalitse käytä Ctrl-Nappia ja Hiirtä',
	'PHPSHOP_RATE_FORM_ZIP_START' => 'Postinumero alue alkaa',
	'PHPSHOP_RATE_FORM_ZIP_END' => ' Postinumero alue loppuu',
	'PHPSHOP_RATE_FORM_WEIGHT_START' => 'Alin Paino',
	'PHPSHOP_RATE_FORM_WEIGHT_END' => 'Korkein Paino',
	'PHPSHOP_RATE_FORM_PACKAGE_FEE' => 'Paketti maksusi',
	'PHPSHOP_RATE_FORM_CURRENCY' => 'Valuutta',
	'PHPSHOP_RATE_FORM_LIST_ORDER' => 'Luettelojärjestys',
	'PHPSHOP_SHIPPING_RATE_LIST_CARRIER_LBL' => 'Huolitsija',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_NAME' => 'Tariffi kuvaus',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WSTART' => 'Paino alkaen ...',
	'PHPSHOP_SHIPPING_RATE_LIST_RATE_WEND' => '... asti',
	'PHPSHOP_CARRIER_FORM_NAME' => 'Huolinta Yritys',
	'PHPSHOP_CARRIER_FORM_LIST_ORDER' => ' Luettelojärjestys '
); $VM_LANG->initModule( 'shipping', $langvars );
?>