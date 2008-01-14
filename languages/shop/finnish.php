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
	'PHPSHOP_BROWSE_LBL' => 'Selaa',
	'PHPSHOP_FLYPAGE_LBL' => 'Tuote Kuvaus',
	'PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT' => 'Muokaa Tuotetta',
	'PHPSHOP_DOWNLOADS_START' => 'Aloita Lataus',
	'PHPSHOP_DOWNLOADS_INFO' => 'Syöta sähköpostissa saamasi Lataus-ID ja paina \'Aloita Lataus\'.',
	'PHPSHOP_WAITING_LIST_MESSAGE' => 'Syötä e-mail osoitteesi alle jos haluat tiedon tuotteen varstoon saapumisesta. 
                                                                        Emme jaa, vuokraa, myy tai käytä antaamasi osoitettasi mihinkään muuhun tarkoitukseen kuin 
                                                                        ilmoittaaksemme että tuote on saapunut varastoon.<br /><br />Kiitos!',
	'PHPSHOP_WAITING_LIST_THANKS' => 'Kiitoksia kärsivällisyydestä! <br />Ilmoitamme heti kun varastomme on täydentynyt.',
	'PHPSHOP_WAITING_LIST_NOTIFY_ME' => 'Ilmoita minulle!',
	'PHPSHOP_SEARCH_ALL_CATEGORIES' => 'Search All Categories',
	'PHPSHOP_SEARCH_ALL_PRODINFO' => 'Search all product info',
	'PHPSHOP_SEARCH_PRODNAME' => 'Product name only',
	'PHPSHOP_SEARCH_MANU_VENDOR' => 'Manufacturer/Vendor only',
	'PHPSHOP_SEARCH_DESCRIPTION' => 'Product description only',
	'PHPSHOP_SEARCH_AND' => 'and',
	'PHPSHOP_SEARCH_NOT' => 'not',
	'PHPSHOP_SEARCH_TEXT1' => 'The first drop-down-list allows you to select a category to limit your search to. 
        The second drop-down-list allows you to limit your search to a particular piece of product information (e.g. Name). 
        Once you have selected these (or left the default ALL), enter the keyword to search for. ',
	'PHPSHOP_SEARCH_TEXT2' => ' You can further refine your search by adding a second keyword and selecting the AND or NOT operator. 
        Selecting AND means both words must be present for the product to be displayed. 
        Selecting NOT means the product will be displayed only if the first keyword is present 
        and the second is not.',
	'PHPSHOP_CONTINUE_SHOPPING' => 'Continue Shopping',
	'PHPSHOP_AVAILABLE_IMAGES' => 'Saatavat kuvat kohteelle',
	'PHPSHOP_BACK_TO_DETAILS' => 'Takaisin Tuotetietoihin',
	'PHPSHOP_IMAGE_NOT_FOUND' => 'Kuvaa ei löydetty!',
	'PHPSHOP_PARAMETER_SEARCH_TEXT1' => 'Do you will find products according to technical parametrs?<BR>You can used any prepared form:',
	'PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE' => 'I am sorry. There is no category for search.',
	'PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE' => 'I am sorry. There is no published Product Type with this name.',
	'PHPSHOP_PARAMETER_SEARCH_IS_LIKE' => 'Is Like',
	'PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE' => 'Is NOT Like',
	'PHPSHOP_PARAMETER_SEARCH_FULLTEXT' => 'Full-Text Search',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL' => 'All Selected',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY' => 'Any Selected',
	'PHPSHOP_PARAMETER_SEARCH_RESET_FORM' => 'Reset Form',
	'PHPSHOP_PRODUCT_NOT_FOUND' => 'Sorry, but the Product you\'ve requested wasn\'t found!',
	'PHPSHOP_PRODUCT_PACKAGING1' => 'Number {unit}s in packaging:',
	'PHPSHOP_PRODUCT_PACKAGING2' => 'Number {unit}s in box:',
	'PHPSHOP_CART_PRICE_PER_UNIT' => 'Price per Unit',
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