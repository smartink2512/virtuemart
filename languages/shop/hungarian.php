<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : hungarian.php 1071 2007-12-03 08:42:28Z thepisu $
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
$VM_LANG->initModule('shop',array (
	'CHARSET' => 'UTF-8',
	'PHPSHOP_BROWSE_LBL' => 'Böngész',
	'PHPSHOP_FLYPAGE_LBL' => 'Termék részletek',
	'PHPSHOP_ERROR' => 'ERROR',
	'PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT' => 'Termék szerkesztése',
	'PHPSHOP_DOWNLOADS_START' => 'Letöltés megkezdése',
	'PHPSHOP_DOWNLOADS_INFO' => 'Kérem, adja meg az e-mailban kapott letöltési azonosítót (Download-ID) és kattintson  a  \'Letöltés megkezdése\'.',
	'PHPSHOP_WAITING_LIST_MESSAGE' => 'Kérjük, adja meg alább az e-mail címét, hogy értesíteni tudjuk, amint a keresett termék ismét készleten lesz. Az e-mail címét nem adjuk ki, nem adjuk el, nem használjuk más célra, mint kizárólag arra, hogy értesítsük önt,  amint a keresett termék ismét készleten lesz.<br /><br />Köszönjük!',
	'PHPSHOP_WAITING_LIST_THANKS' => 'Köszönjük, hogy vár ránk! <br />Rögtön értesítjük, amint összeáll a naprakész leltár.',
	'PHPSHOP_WAITING_LIST_NOTIFY_ME' => 'Értesíts!',
	'PHPSHOP_SEARCH_ALL_CATEGORIES' => 'Keres valamennyi kategóriában',
	'PHPSHOP_SEARCH_ALL_PRODINFO' => 'Keres valamennyi termék információban',
	'PHPSHOP_SEARCH_PRODNAME' => 'Csak termék neve',
	'PHPSHOP_SEARCH_MANU_VENDOR' => 'Csak gyártó/kiadó/forgalmazó',
	'PHPSHOP_SEARCH_DESCRIPTION' => 'Csak termék leírás',
	'PHPSHOP_SEARCH_AND' => 'és',
	'PHPSHOP_SEARCH_NOT' => 'nem',
	'PHPSHOP_SEARCH_TEXT1' => 'A elso lehulló-lista megengedi egy bizonyos kategória fastruktúra kiválasztását, hogy behatárolja a keresését. A második lehulló-lista megengedi a keresés behatárolását egy bizonyos termék-információ  (pl. Név) szerint. Miután ön kiválasztotta ezeket (vagy valamennyit alapértelmezett értéken hagyta), írja be a keresési kulcsszót. ',
	'PHPSHOP_SEARCH_TEXT2' => ' Ön tovább finomíthatja a keresést további kulcsszavak és az AND vagy NOT logikai operátorok használatával. Az AND használata azt jelenti, hogy mindkét szónak benne kell lennie a termék tulajdonságainak leírásában ahhoz, hogy a találati listán megjelenjen. A NOT használata azt jelenti, hogy az elso szónak benne kell lennie a termék tulajdonságainak leírásában, a másodiknak meg nem ahhoz, hogy a találati listán megjelenjen.',
	'PHPSHOP_CONTINUE_SHOPPING' => 'A bevásárlás folytatása',
	'PHPSHOP_AVAILABLE_IMAGES' => 'Rendelkezésre álló képek',
	'PHPSHOP_BACK_TO_DETAILS' => 'Vissza a termék részletekhez',
	'PHPSHOP_IMAGE_NOT_FOUND' => 'Kép nem található!',
	'PHPSHOP_PARAMETER_SEARCH_TEXT1' => 'A technikai paraméterek alapján akarsz keresni?<BR>Használhatod bármely elore elkészített urlapot:',
	'PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE' => 'Sajnálom. Itt nincs keresheto kategória.',
	'PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE' => 'Sajnálom. Nincs közzéttett termék típus ezen a néven.',
	'PHPSHOP_PARAMETER_SEARCH_IS_LIKE' => 'Hasonló',
	'PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE' => 'Nem nem hasonló',
	'PHPSHOP_PARAMETER_SEARCH_FULLTEXT' => 'Teljes szöveges keresés',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL' => 'Mind kiválasztva',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY' => 'Bármely kiválasztott',
	'PHPSHOP_PARAMETER_SEARCH_RESET_FORM' => 'Kérdoív törlése',
	'PHPSHOP_PRODUCT_NOT_FOUND' => 'Sajnálom, de a kért terméket nem találom!',
	'PHPSHOP_PRODUCT_PACKAGING1' => 'Csomagonkénti egységek száma {unit}:',
	'PHPSHOP_PRODUCT_PACKAGING2' => 'Comagonkénti termékszám {unit}:',
	'PHPSHOP_CART_PRICE_PER_UNIT' => 'Egységár',
	'VM_PRODUCT_ENQUIRY_LBL' => 'Ask a question about this product',
	'VM_RECOMMEND_FORM_LBL' => 'Recommend this product to a friend',
	'PHPSHOP_EMPTY_YOUR_CART' => 'Empty Cart',
	'VM_RETURN_TO_PRODUCT' => 'Return to product',
	'EMPTY_CATEGORY' => 'This Category is currently empty.',
	'ENQUIRY' => 'Enquiry',
	'NAME_PROMPT' => 'Enter your Name',
	'EMAIL_PROMPT' => 'E-mail Address',
	'MESSAGE_PROMPT' => 'Enter your Message',
	'SEND_BUTTON' => 'Send',
	'THANK_MESSAGE' => 'Thank you for your Enquiry. We will contact you as soon as possible.',
	'PROMPT_CLOSE' => 'Close',
	'VM_RECOVER_CART' => '',
	'VM_RECOVER_CART_REPLACE' => '',
	'VM_RECOVER_CART_MERGE' => '',
	'VM_RECOVER_CART_DELETE' => ''
	));
?>