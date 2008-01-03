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
$VM_LANG->initModule('checkout',array (
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_NO_CUSTOMER' => 'Vous n\'êtes pas encore client(e) enregistré(e). Veuillez fournir vos informations de facturation en vous enregistrant. Merci.',
	'PHPSHOP_THANKYOU' => 'Merci pour votre commande.',
	'PHPSHOP_EMAIL_SENDTO' => 'Un email de confirmation vous a été envoyé à ',
	'PHPSHOP_CHECKOUT_NEXT' => 'Suivant',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Information de Facturation',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Société',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nom',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Information d\'Expédition',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Société',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nom',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Téléphone',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Méthode de Paiement',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Information Requise quand vous choisissez le Paiement par Carte Bancaire',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Merci pour votre règlement. 
            La transaction a été traitée avec succès. Vous allez recevoir une confirmation de règlement de la part de Pay-Pal par email.
            Vous pouvez maintenant continuer ou vous connecter sur <a href=\'http://www.paypal.com\'>www.paypal.com</a> pour voir le détail de la transaction.',
	'PHPSHOP_PAYPAL_ERROR' => 'Une erreur est survenue durant le traitement de la transaction. Le statut de votre commande ne peut être mis à jour.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Votre commande a été prise en compte avec succès!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>