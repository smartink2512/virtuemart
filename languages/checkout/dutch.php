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
* Dutch Translation for Dutchjoomla.org by Frans and Ton  
*
* http://virtuemart.net
*/
global $VM_LANG;
$langvars = array (
        'CHARSET' => 'ISO-8859-1',
        'PHPSHOP_NO_CUSTOMER' => 'Sorry, maar u bent geen geregistreerde klant. Registreert u zich eerst voordat u verder winkelt.',
        'PHPSHOP_THANKYOU' => 'Bedankt voor Uw bestelling.',
        'PHPSHOP_EMAIL_SENDTO' => 'Een bevestigingsemail is verzonden naar',
        'PHPSHOP_CHECKOUT_NEXT' => 'Volgende',
        'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Rekening informatie',
        'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Bedrijf',
        'PHPSHOP_CHECKOUT_CONF_NAME' => 'Naam',
        'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Adres',
        'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'E-mail',
        'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Verzendinformatie',
        'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Bedrijf',
        'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Naam',
        'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Adres',
        'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefoon',
        'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
        'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Betalingsmethode',
        'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Verplichte informatie wanneer men kiest voor betaling met creditcard',
        'PHPSHOP_PAYPAL_THANKYOU' => 'Bedankt voor de betaling. 
        De transactie was succesvol. U krijgt een bevestigingsemail voor deze transactie van PayPal. 
        U kunt doorgaan of u aanmelden op <a href=http://www.paypal.com>www.paypal.com</a> om de details van de transactie te bekijken.',
        'PHPSHOP_PAYPAL_ERROR' => 'Een fout is opgetreden bij de verwerking van Uw transactie. De status van de bestelling kan niet aangepast worden.',
        'PHPSHOP_THANKYOU_SUCCESS' => 'Uw bestelling is succesvol geplaatst',
        'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Stap %s van %s',
        'VM_CHECKOUT_ORDERIDNOTSET' => 'Order ID is niet geselecteerd of leeg gelaten!',
        'VM_CHECKOUT_FAILURE' => 'Mislukt',
        'VM_CHECKOUT_SUCCESS' => 'Succes',
        'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'Deze pagina bevindt zich op de website van de webwinkel.',
        'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'De gateway voert de pagina uit op de website en laat het resultaat zien in SSL Encryptie.',
        'VM_CHECKOUT_CCV_CODE' => 'Creditcard CVC code',
        'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'Wat is de CVC code?',
        'VM_CHECKOUT_MD5_FAILED' => 'MD5 controle mislukt',
        'VM_CHECKOUT_ORDERNOTFOUND' => 'Bestelling niet gevonden',
        'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '
                De betalingstransactie is goedgekeurd door PBS. \n
                De transactie heeft het volgende transactienummer gekregen:\n\n
                transactienummer: {transactionnumber}\n',
        'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => '
                De betalingstransactie is niet goedgekeurd door PBS. \n
                De transactie heeft het volgende transactienummer gekregen:\n\n
                transactienummer: {transactionnumber}\n',
        'VM_CHECKOUT_DD_ERROR_0' => 'Merchant/forretningsnummer ugyldigt',
        'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
        'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
        'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
        'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
        'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
        'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
        'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'Systeemfout',
        'VM_CHECKOUT_FP_ERROR_1' => 'Fout: Transactie afgewezen',
        'VM_CHECKOUT_FP_ERROR_2' => 'Fout: Transactie afgewezen',
        'VM_CHECKOUT_FP_ERROR_3' => 'Fout: Niet geldige nummerreeks',
        'VM_CHECKOUT_FP_ERROR_4' => 'Fout: Niet toegestane transactie',
        'VM_CHECKOUT_FP_ERROR_5' => 'Fout: Geen antwoord',
        'VM_CHECKOUT_FP_ERROR_6' => 'Fout: Systeemfout',
        'VM_CHECKOUT_FP_ERROR_7' => 'Fout: Kaart verlopen',
        'VM_CHECKOUT_FP_ERROR_8' => 'Fout: Communicatie fout',
        'VM_CHECKOUT_FP_ERROR_9' => 'Fout: Interne fout',
        'VM_CHECKOUT_FP_ERROR_10' => 'Fout: Kaart is niet geregistreerd',
        'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Fout: Onbekende fout',
        'VM_CHECKOUT_WF_ERROR_1' => 'Transaktionen blev ikke godkendt',
        'VM_CHECKOUT_WF_ERROR_2' => 'Mulig snyd',
        'VM_CHECKOUT_WF_ERROR_3' => 'Communicatiefout',
        'VM_CHECKOUT_WF_ERROR_4' => 'Kort udlobet',
        'VM_CHECKOUT_WF_ERROR_5' => 'Interne fout',
        'VM_CHECKOUT_WF_ERROR_6' => 'Ongeldige transactie',
        'VM_CHECKOUT_WF_ERROR_7' => 'Systeemfout',
        'VM_CHECKOUT_WF_ERROR_8' => 'Verkeerd rekeningnummer',
        'VM_CHECKOUT_WF_ERROR_9' => 'Kortet eksistere ikke',
        'VM_CHECKOUT_WF_ERROR_10' => 'Kort l?ngen er for kort.',
        'VM_CHECKOUT_WF_ERROR_11' => 'Transaktion kan ikke gennemfores igennem denne terminal',
        'VM_CHECKOUT_WF_ERROR_12' => 'Kortejeren har ikke rettigheder til at gennemfore denne transaktion.',
        'VM_CHECKOUT_WF_ERROR_13' => 'Kortnummeret eksistere ikke',
        'VM_CHECKOUT_WF_ERROR_14' => 'Fout onbekend'
); $VM_LANG->initModule( 'checkout', $langvars );
?>
