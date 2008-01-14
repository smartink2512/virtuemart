<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : french.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_BROWSE_LBL' => 'Parcourir',
	'PHPSHOP_FLYPAGE_LBL' => 'Détails du produit',
	'PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT' => 'Editer ce Produit',
	'PHPSHOP_DOWNLOADS_START' => 'Démarrer le Téléchargement',
	'PHPSHOP_DOWNLOADS_INFO' => 'Veuillez saisir le Numéro de téléchargement qui vous a été communiqué par email, puis cliquez sur "Démarrer le téléchargement".',
	'PHPSHOP_WAITING_LIST_MESSAGE' => 'Veuillez saisir votre adresse email pour être prévenu(e) dès que ce produit sera de nouveau disponible en stock. 
Votre adresse email ne sera en aucune manière cédée, vendue ou partagée de quelques manière que ce soit autre que pour vous avertir lors de nos rétablissements de stocks.<br /><br />Merci !',
	'PHPSHOP_WAITING_LIST_THANKS' => 'Merci pour votre patience! <br />Nous vous ferons savoir dès que ce produit sera à nouveau disponible en stock.',
	'PHPSHOP_WAITING_LIST_NOTIFY_ME' => 'M\'informer !',
	'PHPSHOP_SEARCH_ALL_CATEGORIES' => 'Chercher dans Toutes les Catégories',
	'PHPSHOP_SEARCH_ALL_PRODINFO' => 'Chercher dans Toutes les Informations Produits',
	'PHPSHOP_SEARCH_PRODNAME' => 'Seulement les Noms de Produits',
	'PHPSHOP_SEARCH_MANU_VENDOR' => 'Seulement les Fabricants/Vendeurs',
	'PHPSHOP_SEARCH_DESCRIPTION' => 'Seulement les Descriptions Produits',
	'PHPSHOP_SEARCH_AND' => 'ET',
	'PHPSHOP_SEARCH_NOT' => 'PAS',
	'PHPSHOP_SEARCH_TEXT1' => 'La première liste déroulante vous permet de sélectionner une catégorie pour limiter votre recherche. La seconde liste déroulante vous permet de limiter votre recherche à une information particulière du produit (ex. Nom). 
           Une fois sélectionnée (ou laissée par défaut sur \'TOUS\'), saisissez votre mot-clé pour lancer la recherche. ',
	'PHPSHOP_SEARCH_TEXT2' => ' Vous pourrez ensuite affiner votre recherche en ajoutant des mots-clés et les opérateurs ET, PAS. 
           Choisir ET permet d\'obtenir des résultats contenant TOUS les mots-clés. 
           Choisir PAS permet d\'obtenir des résultats contenant les mots-clés du premier champ SAUF (à l\'exception de) ceux du second champ.',
	'PHPSHOP_CONTINUE_SHOPPING' => 'Continuer Achats',
	'PHPSHOP_AVAILABLE_IMAGES' => 'Images disponibles pour',
	'PHPSHOP_BACK_TO_DETAILS' => 'Retour aux Détails Produit',
	'PHPSHOP_IMAGE_NOT_FOUND' => 'Image non trouvée !',
	'PHPSHOP_PARAMETER_SEARCH_TEXT1' => 'Voulez-vous trouver des produits en rapport avec leurs paramètres techniques ?<BR>Vous pouvez utiliser un formulaire adéquat :',
	'PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE' => 'Désolé. Il n\'y a pas de catégorie à chercher.',
	'PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE' => 'Désolé.Il n\'y a pas de Produits avec ce nom.
',
	'PHPSHOP_PARAMETER_SEARCH_IS_LIKE' => 'Contient',
	'PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE' => 'Ne Contient PAS',
	'PHPSHOP_PARAMETER_SEARCH_FULLTEXT' => 'Recherche Texte Entier',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL' => 'Tout Sélectionner',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY' => 'Quelques',
	'PHPSHOP_PARAMETER_SEARCH_RESET_FORM' => 'Effacer Formulaire',
	'PHPSHOP_PRODUCT_NOT_FOUND' => 'Désolé, mais le produit que vous avez demandé n\'a pas été trouvé !',
	'PHPSHOP_PRODUCT_PACKAGING1' => 'Nombre de {unit}s dans l\'emballage',
	'PHPSHOP_PRODUCT_PACKAGING2' => 'Nombre de {unit}s dans le lot',
	'PHPSHOP_CART_PRICE_PER_UNIT' => 'Prix à l\'Unité',
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