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
	'CHARSET' => 'ISO-8859-15',
	'PHPSHOP_NO_CUSTOMER' => 'Vous n\'�tes pas encore client(e) enregistr�(e). Veuillez fournir vos informations de facturation en vous enregistrant. Merci.',
	'PHPSHOP_THANKYOU' => 'Merci pour votre commande.',
	'PHPSHOP_EMAIL_SENDTO' => 'Un email de confirmation a �t� envoy� � ',
	'PHPSHOP_CHECKOUT_NEXT' => 'Suivant',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Information de facturation',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Soci�t�',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nom',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Information d\'exp�dition',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Soci�t�',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nom',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adresse',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'T�l�phone',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'M�thode de paiement',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Information obligatoire quand vous choisissez le paiement par carte bancaire',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Merci pour votre r�glement. 
            L\'autorisation de paiement a �t� accept�e. Vous allez recevoir une confirmation de r�glement de la part de Pay-Pal par email.
            Vous pouvez maintenant continuer ou vous connecter sur <a href=\'http://www.paypal.com\'>www.paypal.com</a> pour voir le d�tail de la transaction.',
	'PHPSHOP_PAYPAL_ERROR' => 'Une erreur est survenue durant le traitement de la transaction. Le statut de votre commande ne peut �tre mis � jour.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Votre commande a �t� prise en compte!',
	'VM_CHECKOUT_TITLE_TAG' => 'Validation de la commande: �tape %s sur %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'ID de la commande n\'est pas pr�cis� ou est vide',
	'VM_CHECKOUT_FAILURE' => 'Echec',
	'VM_CHECKOUT_SUCCESS' => 'Succ�s',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'Cette page se trouve sur le site Web de la boutique',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'La passerelle ex�cute la page sur le site, et montre le r�sultat chiffr� en SSL.',
	'VM_CHECKOUT_CCV_CODE' => 'Cryptogramme visuel de la carte de cr�dit',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'Qu\'est ce que le cryptogramme visuel de la carte de cr�dit?',
	'VM_CHECKOUT_MD5_FAILED' => 'Echec de la v�rification MD5',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'Commande non trouv�e',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '                La transaction de paiement a �t� approuv�e par PBS.
                 La transaction a re�u le num�ro de transaction suivants: nn
                 Num�ro de transaction: () n transactionnumber',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => 'La transaction n\'a pas �t� approuv�e par PBS. N
                 La transaction a re�u le num�ro de transaction suivants: nn
                 Num�ro de transaction: () n transactionnumber',
	'VM_CHECKOUT_DD_ERROR_0' => 'Identification du Commer�ant non valable',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'Erreur syst�me',
	'VM_CHECKOUT_FP_ERROR_1' => 'Erreur: Transaction refus�e',
	'VM_CHECKOUT_FP_ERROR_2' => 'Erreur: Transaction refus�e',
	'VM_CHECKOUT_FP_ERROR_3' => 'Error: wrong number format',
	'VM_CHECKOUT_FP_ERROR_4' => 'Error: illegal transaction',
	'VM_CHECKOUT_FP_ERROR_5' => 'Erreur: pas de r�ponse',
	'VM_CHECKOUT_FP_ERROR_6' => 'Error_system_failure',
	'VM_CHECKOUT_FP_ERROR_7' => 'Erreur: La carte a expir�e',
	'VM_CHECKOUT_FP_ERROR_8' => 'Erreur: Communication Failure',
	'VM_CHECKOUT_FP_ERROR_9' => 'Error: Internal Failure',
	'VM_CHECKOUT_FP_ERROR_10' => 'Error: Card not registered',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Error: unknown Error',
	'VM_CHECKOUT_WF_ERROR_1' => 'Transaktionen blev ikke godkendt',
	'VM_CHECKOUT_WF_ERROR_2' => 'Mulig snyd',
	'VM_CHECKOUT_WF_ERROR_3' => 'Kommunikations fejl',
	'VM_CHECKOUT_WF_ERROR_4' => 'Kort udlobet',
	'VM_CHECKOUT_WF_ERROR_5' => 'Internal error',
	'VM_CHECKOUT_WF_ERROR_6' => 'Transaction refus�e',
	'VM_CHECKOUT_WF_ERROR_7' => 'Erreur syst�me',
	'VM_CHECKOUT_WF_ERROR_8' => 'Forkert forretningsnummer',
	'VM_CHECKOUT_WF_ERROR_9' => 'La carte n\'existe pas',
	'VM_CHECKOUT_WF_ERROR_10' => 'Kort l?ngen er for kort.',
	'VM_CHECKOUT_WF_ERROR_11' => 'Transaktion kan ikke gennemfores igennem denne terminal',
	'VM_CHECKOUT_WF_ERROR_12' => 'Kortejeren har ikke rettigheder til at gennemfore denne transaktion.',
	'VM_CHECKOUT_WF_ERROR_13' => 'Ce num�ro de carte n\'existe pas',
	'VM_CHECKOUT_WF_ERROR_14' => 'Erreur inconnue',
	'PHPSHOP_EPAY_PAYMENT_CARDTYPE' => 'The payment is
created by %s <img
src="/components/com_virtuemart/shop_image/ps_image/epay_images/%s"
border="0">'
); $VM_LANG->initModule( 'checkout', $langvars );
?>