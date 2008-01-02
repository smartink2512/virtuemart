<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : greek.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Συγγνώμη, αλλά δεν είστε ακόμη Εγγεγραμμένος Χρήστης. Παρακαλούμε δώστε μας τις Πληροφορίες Χρέωσης.',
	'PHPSHOP_THANKYOU' => 'Σας ευχαριστούμε για την παραγγελία σας.',
	'PHPSHOP_EMAIL_SENDTO' => 'Ένα e-mail Επιβεβαίωσης, στάλθηκε προς',
	'PHPSHOP_CHECKOUT_NEXT' => 'Επόμενο',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Πληροφορίες Χρέωσης',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Εταιρεία',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Όνομα',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Διεύθυνση',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Πληροφορίες Αποστολής',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Εταιρεία',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Όνομα',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Διεύθυνση',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Τηλ.',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Μέθοδος Πληρωμής',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'απαραίτητες πληροφορίες όταν επιλεχθεί πληρωμή μέσω Πιστωτικής Κάρτας',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Ευχαριστούμε για την πληρωμή σας. 
        Η συναλαγή ήταν επιτυχής. Θα λάβετε ένα e-mail επιβεβαίωσης για την συναλλαγή σας από το PayPal. 
        Μπορείτε να συνεχίσετε ή να επισκευθείτε το <a href=http://www.paypal.com>www.paypal.com</a> για να δείτε τις λεπτομέρειες της συναλλαγής.',
	'PHPSHOP_PAYPAL_ERROR' => 'Συνέβει κάποιο σφάλμα ενώ γινόταν επεξεργασία της συναλλαγής σας. Η κατάσταση της παραγγελία σας δεν μπορεί να ενημερωθεί.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Your order has been successfully placed!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>