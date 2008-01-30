<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : italian.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Vous n\'êtes pas encore client(e) enregistré(e). Veuillez fournir vos informations de facturation en vous enregistrant. Merci.',
	'PHPSHOP_THANKYOU' => 'Merci pour votre commande.',
	'PHPSHOP_EMAIL_SENDTO' => 'Un email de confirmation a été envoyé à ',
	'PHPSHOP_CHECKOUT_NEXT' => 'Suivant',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Information de facturation',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Société',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nom',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Information d\'expédition',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Société',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nom',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Téléphone',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Méthode de paiement',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Information obligatoire quand vous choisissez le paiement par carte bancaire',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Merci pour votre règlement. 
            L\'autorisation de paiement a été acceptée. Vous allez recevoir une confirmation de règlement de la part de Pay-Pal par email.
            Vous pouvez maintenant continuer ou vous connecter sur <a href=\'http://www.paypal.com\'>www.paypal.com</a> pour voir le détail de la transaction.',
	'PHPSHOP_PAYPAL_ERROR' => 'Une erreur est survenue durant le traitement de la transaction. Le statut de votre commande ne peut être mis à jour.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Votre commande a été prise en compte!',
	'VM_CHECKOUT_TITLE_TAG' => 'Validation de la commande: étape %s sur %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'ID de la commande n\'est pas précisé ou est vide',
	'VM_CHECKOUT_FAILURE' => 'Echec',
	'VM_CHECKOUT_SUCCESS' => 'Succès',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'Cette page se trouve sur le site Web de la boutique',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'La passerelle exécute la page sur le site, et montre le résultat chiffré en SSL.',
	'VM_CHECKOUT_CCV_CODE' => 'Cryptogramme visuel de la carte de crédit',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'Qu\'est ce que le cryptogramme visuel de la carte de crédit?',
	'VM_CHECKOUT_MD5_FAILED' => 'Echec de la vérification MD5',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'Commande non trouvée',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '                La transaction de paiement a été approuvée par PBS.
                 La transaction a reçu le numéro de transaction suivants: nn
                 Numéro de transaction: () n transactionnumber',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => 'La transaction n\'a pas été approuvée par PBS. N
                 La transaction a reçu le numéro de transaction suivants: nn
                 Numéro de transaction: () n transactionnumber',
	'VM_CHECKOUT_DD_ERROR_0' => 'Identification du Commerçant non valable',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'Erreur système',
	'VM_CHECKOUT_FP_ERROR_1' => 'Erreur: Transaction refusée',
	'VM_CHECKOUT_FP_ERROR_2' => 'Erreur: Transaction refusée',
	'VM_CHECKOUT_FP_ERROR_3' => 'Error: wrong number format',
	'VM_CHECKOUT_FP_ERROR_4' => 'Error: illegal transaction',
	'VM_CHECKOUT_FP_ERROR_5' => 'Erreur: pas de réponse',
	'VM_CHECKOUT_FP_ERROR_6' => 'Error_system_failure',
	'VM_CHECKOUT_FP_ERROR_7' => 'Erreur: La carte a expirée',
	'VM_CHECKOUT_FP_ERROR_8' => 'Erreur: Communication Failure',
	'VM_CHECKOUT_FP_ERROR_9' => 'Error: Internal Failure',
	'VM_CHECKOUT_FP_ERROR_10' => 'Error: Card not registered',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Error: unknown Error',
	'VM_CHECKOUT_WF_ERROR_1' => 'Transaktionen blev ikke godkendt',
	'VM_CHECKOUT_WF_ERROR_2' => 'Mulig snyd',
	'VM_CHECKOUT_WF_ERROR_3' => 'Kommunikations fejl',
	'VM_CHECKOUT_WF_ERROR_4' => 'Kort udlobet',
	'VM_CHECKOUT_WF_ERROR_5' => 'Internal error',
	'VM_CHECKOUT_WF_ERROR_6' => 'Transaction refusée',
	'VM_CHECKOUT_WF_ERROR_7' => 'Erreur système',
	'VM_CHECKOUT_WF_ERROR_8' => 'Forkert forretningsnummer',
	'VM_CHECKOUT_WF_ERROR_9' => 'La carte n\'existe pas',
	'VM_CHECKOUT_WF_ERROR_10' => 'Kort l?ngen er for kort.',
	'VM_CHECKOUT_WF_ERROR_11' => 'Transaktion kan ikke gennemfores igennem denne terminal',
	'VM_CHECKOUT_WF_ERROR_12' => 'Kortejeren har ikke rettigheder til at gennemfore denne transaktion.',
	'VM_CHECKOUT_WF_ERROR_13' => 'Ce numéro de carte n\'existe pas',
	'VM_CHECKOUT_WF_ERROR_14' => 'Erreur inconnue'
); $VM_LANG->initModule( 'checkout', $langvars );
?>