<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : brazilian_portuguese.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'PHPSHOP_NO_CUSTOMER' => 'Sentimos muito mas você não é um clinte registado.<BR>Por favor registar-se em nossa loja primeiro.<BR>Obrigado.',
	'PHPSHOP_THANKYOU' => 'Obrigado pelo seu pedido.',
	'PHPSHOP_EMAIL_SENDTO' => 'Um email de confirmação foi enviado para',
	'PHPSHOP_CHECKOUT_NEXT' => 'Próximo',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Informação de pagamento',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Empresa',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nome',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Endereço',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Informação de envio',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Empresa',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nome',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Endereço',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefone',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Método de pagamento',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Informação requerida quando Pagamento via cartão de crédito é selecionada',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Obrigado pelo seu pagamento. A transação foi um sucesso. Você receberá um e-mail de confirmação da transação pela PayPal. Você pode agora continuar ou entrar em <a href=http://www.paypal.com>www.paypal.com</a> para ver os detalhes da transação.',
	'PHPSHOP_PAYPAL_ERROR' => 'Um erro ocorreu enquanto processava sua transação. A situação de seu pedido não pode ser atualizada.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'Seu pedido foi encaminhado com sucesso!',
	'VM_CHECKOUT_TITLE_TAG' => 'Checkout: Step %s of %s'
	));
?>