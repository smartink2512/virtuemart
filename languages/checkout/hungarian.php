<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @package VirtueMart
* @subpackage languages
* @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
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
	'CHARSET' => 'UTF-8',
	'PHPSHOP_NO_CUSTOMER' => 'Ön még nem nyilvántartott ügyfél. Adja meg a számlázási információit.',
	'PHPSHOP_THANKYOU' => 'Köszönjük a megrendelést!',
	'PHPSHOP_EMAIL_SENDTO' => 'A megerősítő e-mail elküldve az alábbi címre',
	'PHPSHOP_CHECKOUT_NEXT' => 'Következő',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Számlázási információ',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Cég',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Név',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Cím',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-mail',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Szállítási információ',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Cég',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Név',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Cím',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefon',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Kifizetési eljárás',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'kért információ amikor hitelkártyás kifizetés van kiválasztva',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Köszönjük a kifizetést. A tranzakció sikeres volt. A PayPal e-mailben fogja értesíteni a tranzakció részleteiről. Most folytathatja, vagy bejelentkezhet a <a href=http://www.paypal.com>www.paypal.com</a> -ra hogy megtekintse a tranzakció részleteit.',
	'PHPSHOP_PAYPAL_ERROR' => 'A tranzakció feldolgozása közben hiba történt. A megrendelése státusát nem lehet frissíteni.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'A megrendelése sikeresen megérkezett!',
	'VM_CHECKOUT_TITLE_TAG' => 'Rendelés lépései: %s / %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'Rendelés azonosító üres!',
	'VM_CHECKOUT_FAILURE' => 'Hiba',
	'VM_CHECKOUT_SUCCESS' => 'Sikeres',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'Az oldal az üzlet weboldalán található.',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'A gateway az üzlet oldalán hozza létre a lapot, amelynek tartalmát SSL-titkosítással jeleníti itt meg.',
	'VM_CHECKOUT_CCV_CODE' => 'Hitelkártya ellenőrző szám',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'Mi a hitelkártya ellenőrző szám?',
	'VM_CHECKOUT_MD5_FAILED' => 'MD5 azonosítási hiba',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'Rendelés nem található',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '                A PBS jóváhagyta a Paypal Tranzakciót. n
                A tranzakció a következő azonosítószámot kapta:nn
                Tranzakció száma: {transactionnumber}n',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => '                A PBS nem hagyta jóvá a Paypal Tranzakciót. n
                A tranzakció a következő azonosítószámot kapta:nn
                Tranzakció száma: {transactionnumber}n',
	'VM_CHECKOUT_DD_ERROR_0' => 'Merchant/forretningsnummer ugyldigt',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'Rendszerhiba',
	'VM_CHECKOUT_FP_ERROR_1' => 'Hiba: Tranzakció elutasítva',
	'VM_CHECKOUT_FP_ERROR_2' => 'Hiba: Tranzakció elutasítva',
	'VM_CHECKOUT_FP_ERROR_3' => 'Hiba: helytelen számformátum',
	'VM_CHECKOUT_FP_ERROR_4' => 'Hiba: helytelen tranzakció',
	'VM_CHECKOUT_FP_ERROR_5' => 'Hiba: nincs válasz',
	'VM_CHECKOUT_FP_ERROR_6' => 'Hiba: Rendszerhiba',
	'VM_CHECKOUT_FP_ERROR_7' => 'Hiba: Kártya lejárt',
	'VM_CHECKOUT_FP_ERROR_8' => 'Hiba: Kommunikációs hiba',
	'VM_CHECKOUT_FP_ERROR_9' => 'Hiba: Belső hiba',
	'VM_CHECKOUT_FP_ERROR_10' => 'Hiba: Kártya nincs regisztrálva',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Hiba: Ismeretlen Hiba',
	'VM_CHECKOUT_WF_ERROR_1' => 'Hiba: Tranzakció elutasítva',
	'VM_CHECKOUT_WF_ERROR_2' => 'Mulig snyd',
	'VM_CHECKOUT_WF_ERROR_3' => 'Kommunikációs hiba',
	'VM_CHECKOUT_WF_ERROR_4' => 'Kártya lejárt',
	'VM_CHECKOUT_WF_ERROR_5' => 'Belső hiba',
	'VM_CHECKOUT_WF_ERROR_6' => 'Helytelen tranzakció',
	'VM_CHECKOUT_WF_ERROR_7' => 'Rendszerhiba',
	'VM_CHECKOUT_WF_ERROR_8' => 'Helytelen számformátum',
	'VM_CHECKOUT_WF_ERROR_9' => 'Kártya nincs regisztrálva',
	'VM_CHECKOUT_WF_ERROR_10' => 'Kort l?ngen er for kort.',
	'VM_CHECKOUT_WF_ERROR_11' => 'Transaktion kan ikke gennemfores igennem denne terminal',
	'VM_CHECKOUT_WF_ERROR_12' => 'Kortejeren har ikke rettigheder til at gennemfore denne transaktion.',
	'VM_CHECKOUT_WF_ERROR_13' => 'Kártya nincs regisztrálva',
	'VM_CHECKOUT_WF_ERROR_14' => 'Ismeretlen hiba',
	'PHPSHOP_EPAY_PAYMENT_CARDTYPE' => 'The payment is
created by %s <img
src="/components/com_virtuemart/shop_image/ps_image/epay_images/%s"
border="0">'
); $VM_LANG->initModule( 'checkout', $langvars );
?>