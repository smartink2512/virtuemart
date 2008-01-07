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
	'VM_CHECKOUT_TITLE_TAG' => 'Cassa: Passaggio %s di %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'ID Ordine non impostato o vuoto!',
	'VM_CHECKOUT_FAILURE' => 'Fallimento',
	'VM_CHECKOUT_SUCCESS' => 'Successo',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'Questa pagina è posizionata nel sito web del negozio.',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'Il gateway esegue la pagina sul sito web, e mostra il risultato crittografato SSL.',
	'VM_CHECKOUT_CCV_CODE' => 'Codice di Verifica Carta di Credito',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'Cosa è il Codice di Verifica Carta di Credito?',
	'VM_CHECKOUT_MD5_FAILED' => 'Controllo MD5 fallito',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'Ordine non trovato',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '
                La Transazione di pagamento è stata approvata da PBS. \n
                La Transazione ha ricevuto il seguente Numero di Transazione:\n\n
                Numero Transazione: {transactionnumber}\n',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => '
                La Transazione di Pagamento non è stata approvata da PBS. \n
                La transazione ha ricevuto il seguente Numero di Transazione:\n\n
                Numero Transazione: {transactionnumber}\n',
	'VM_CHECKOUT_DD_ERROR_0' => 'Merchant/forretningsnummer ugyldigt',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'System fejl',
	'VM_CHECKOUT_FP_ERROR_1' => 'Errore: transazione rifiutata',
	'VM_CHECKOUT_FP_ERROR_2' => 'Errore: transazione rifiutata',
	'VM_CHECKOUT_FP_ERROR_3' => 'Errore: formato numero errato',
	'VM_CHECKOUT_FP_ERROR_4' => 'Errore: transazione illegale',
	'VM_CHECKOUT_FP_ERROR_5' => 'Errore: nessuna risposta',
	'VM_CHECKOUT_FP_ERROR_6' => 'Errore: problema di sistema',
	'VM_CHECKOUT_FP_ERROR_7' => 'Errore: carta scaduta',
	'VM_CHECKOUT_FP_ERROR_8' => 'Errore: problema di comunicazione',
	'VM_CHECKOUT_FP_ERROR_9' => 'Errore: problema interno',
	'VM_CHECKOUT_FP_ERROR_10' => 'Errore: carta non registrata',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Errore: errore sconosciuto',
	'VM_CHECKOUT_WF_ERROR_1' => 'Transaktionen blev ikke godkendt',
	'VM_CHECKOUT_WF_ERROR_2' => 'Mulig snyd',
	'VM_CHECKOUT_WF_ERROR_3' => 'Kommunikations fejl',
	'VM_CHECKOUT_WF_ERROR_4' => 'Kort udlobet',
	'VM_CHECKOUT_WF_ERROR_5' => 'Intern fejl',
	'VM_CHECKOUT_WF_ERROR_6' => 'Invalid Transaktion',
	'VM_CHECKOUT_WF_ERROR_7' => 'System fejl',
	'VM_CHECKOUT_WF_ERROR_8' => 'Forkert forretningsnummer',
	'VM_CHECKOUT_WF_ERROR_9' => 'Kortet eksistere ikke',
	'VM_CHECKOUT_WF_ERROR_10' => 'Kort l?ngen er for kort.',
	'VM_CHECKOUT_WF_ERROR_11' => 'Transaktion kan ikke gennemfores igennem denne terminal',
	'VM_CHECKOUT_WF_ERROR_12' => 'Kortejeren har ikke rettigheder til at gennemfore denne transaktion.',
	'VM_CHECKOUT_WF_ERROR_13' => 'Kortnummeret eksistere ikke',
	'VM_CHECKOUT_WF_ERROR_14' => 'Errore sconosciuto'
	));
?>