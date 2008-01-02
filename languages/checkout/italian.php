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
$VM_LANG->initModule('checkout',array (
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_NO_CUSTOMER' => 'Non hai mai acquistato. Inserisci le informazioni per la fatturazione.',
	'PHPSHOP_THANKYOU' => 'Grazie per l\'ordine.',
	'PHPSHOP_EMAIL_SENDTO' => 'Una email di conferma è stata spedita a',
	'PHPSHOP_CHECKOUT_NEXT' => 'Succ',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Dati Fattura',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Azienda',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nome',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Indirizzo',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Dati Spedizione',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Azienda',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nome',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Indirizzo',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefono',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Tipo di Pagamento',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'informazioni richieste per il Pagamento con Carta di Credito',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Grazie per il pagamento.
        La transazione ha avuto successo. Riceverai una e-mail di conferma della transazione da parte di PayPal.
        Ora puoi continuare nella navigazione o autenticarti in <a href=http://www.paypal.com>www.paypal.com</a> per controllare i dettagli della transazione.',
	'PHPSHOP_PAYPAL_ERROR' => 'C\'è stato un errore nell\'elaborazione della transazione. Lo stato del tuo ordine non può essere aggiornato.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Il tuo ordine è stato inviato con successo!',
	'VM_CHECKOUT_TITLE_TAG' => 'Cassa: Passaggio %s di %s'
	));
?>