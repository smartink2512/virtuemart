<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : dutch.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_BROWSE_LBL' => 'Overzicht',
	'PHPSHOP_FLYPAGE_LBL' => 'Product Details',
	'PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT' => 'Wijzig dit product',
	'PHPSHOP_DOWNLOADS_START' => 'Begin met de Download',
	'PHPSHOP_DOWNLOADS_INFO' => 'Vul Download-ID in die u heeft gekregen via e-mail en klik \'Begin met de Download\'.',
	'PHPSHOP_WAITING_LIST_MESSAGE' => 'Voer uw e-mail adres in om bericht te krijgen wanneer dit product weer beschikbaar is. Wij zullen niet uw e-mail adres delen, verhuren, verkopen of voor andere doeleinden gebruiken dan alleen u op de hoogte te stellen wanneer het product weer beschikbaar is.<br /><br />Hartelijk dank!',
	'PHPSHOP_WAITING_LIST_THANKS' => 'Bedankt voor het wachten! <br />We zullen u zo snel mogelijk op de hoogte stellen als het product binnen is.',
	'PHPSHOP_WAITING_LIST_NOTIFY_ME' => 'Verwittig me!',
	'PHPSHOP_SEARCH_ALL_CATEGORIES' => 'Doorzoek alle categorieën',
	'PHPSHOP_SEARCH_ALL_PRODINFO' => 'Doorzoek alle product informatie',
	'PHPSHOP_SEARCH_PRODNAME' => 'Alleen product naam',
	'PHPSHOP_SEARCH_MANU_VENDOR' => 'Alleen Fabrikant/Verkoper',
	'PHPSHOP_SEARCH_DESCRIPTION' => 'Alleen product omschrijving',
	'PHPSHOP_SEARCH_AND' => 'en',
	'PHPSHOP_SEARCH_NOT' => 'niet',
	'PHPSHOP_SEARCH_TEXT1' => 'De eerste drop-down-lijst geeft u de mogelijkheid om een categorie te selecteren waarin u wilt zoeken. 
        Met de tweede drop-down-lijst kunt u aangeven in welke product informatie u wilt zoeken (bv. Naam). 
        Wanneer u een keuze genaakt heeft (of het bij de standaard ALLES laat), vult u een zoekwoord in.',
	'PHPSHOP_SEARCH_TEXT2' => 'U kunt u zoek aktie nog verder verfijnen door een extra zoekwoord toe te voegen en een keuze te maken uit de EN of NIET operator. 
        Selecteren van EN houdt in dat beide woorden aanwezig moeten zijn voordat een product gevonden wordt. 
        Selecteren van NIET houdt in dat alleen producten getoont worden waar het eerste zoekwoord zich in bevind en het tweede zoekwoord niet.',
	'PHPSHOP_CONTINUE_SHOPPING' => 'Verder Winkelen',
	'PHPSHOP_AVAILABLE_IMAGES' => 'Beschikbare Afbeeldingen voor',
	'PHPSHOP_BACK_TO_DETAILS' => 'Terug naar Product Details',
	'PHPSHOP_IMAGE_NOT_FOUND' => 'Afbeedling niet gevonden!',
	'PHPSHOP_PARAMETER_SEARCH_TEXT1' => 'U kunt producten zoeken m.b.v. van technische parameters?<BR>U kunt elk gewenst formulier gebruiken:',
	'PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE' => 'Er is geen resultaat wat met u zoekopdracht overeen komt.',
	'PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE' => 'Er is geen gepubliseerd product type met deze naam.',
	'PHPSHOP_PARAMETER_SEARCH_IS_LIKE' => 'Zelfde als',
	'PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE' => 'Is niet zelfde als',
	'PHPSHOP_PARAMETER_SEARCH_FULLTEXT' => 'Volledige tekst doorzoeken',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL' => 'Alle geselecteerde',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY' => 'Enkel geselecteerde',
	'PHPSHOP_PARAMETER_SEARCH_RESET_FORM' => 'Reset Formulier',
	'PHPSHOP_PRODUCT_NOT_FOUND' => 'Sorry, maar het product wat u zoekt is niet gevonden!',
	'PHPSHOP_PRODUCT_PACKAGING1' => 'Aantal (eenheden) in verpakking:',
	'PHPSHOP_PRODUCT_PACKAGING2' => 'Aantal (eenheden) in doos:',
	'PHPSHOP_CART_PRICE_PER_UNIT' => 'Prijs per Eenheid',
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
	'VM_RECOVER_CART' => 'Recover Saved Cart',
	'VM_RECOVER_CART_REPLACE' => 'Replace Cart with Saved Cart',
	'VM_RECOVER_CART_MERGE' => 'Add Saved Cart to Current Cart',
	'VM_RECOVER_CART_DELETE' => 'Delete Saved Cart',
	'VM_EMPTY_YOUR_CART_TIP' => 'Clear the cart of all contents'
); $VM_LANG->initModule( 'shop', $langvars );
?>