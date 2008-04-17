<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version : portuguese.php 1071 2007-12-03 08:42:28Z thepisu $
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
	'CHARSET' => 'ISO-8859-1',
	'PHPSHOP_NO_CUSTOMER' => 'Sentimos muito mas você ainda não é um clinte registado.<BR>Queira por favor registar-se na nossa loja primeiro.<BR>Obrigado.',
	'PHPSHOP_THANKYOU' => 'Obrigado pelo seu pedido.',
	'PHPSHOP_EMAIL_SENDTO' => 'Um email de confirmação foi enviado para',
	'PHPSHOP_CHECKOUT_NEXT' => 'Próximo',
	'PHPSHOP_CHECKOUT_CONF_BILLINFO' => 'Informação de Pagamento',
	'PHPSHOP_CHECKOUT_CONF_COMPANY' => 'Empresa',
	'PHPSHOP_CHECKOUT_CONF_NAME' => 'Nome',
	'PHPSHOP_CHECKOUT_CONF_ADDRESS' => 'Morada',
	'PHPSHOP_CHECKOUT_CONF_EMAIL' => 'Email',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO' => 'Informação de Envio',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_COMPANY' => 'Empresa',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_NAME' => 'Nome',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_ADDRESS' => 'Morada',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_PHONE' => 'Telefone',
	'PHPSHOP_CHECKOUT_CONF_SHIPINFO_FAX' => 'Fax',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_METHOD' => 'Método de Pagamento',
	'PHPSHOP_CHECKOUT_CONF_PAYINFO_REQINFO' => 'Informação requerida quando Pagamento via Cartão de Crédito é seleccionada',
	'PHPSHOP_PAYPAL_THANKYOU' => 'Agradecemos o seu pagamento. 
A transação foi efectuada com sucesso. Receberá uma confirmação por e-mail referente a esta transação de PayPal. 
Pode continuar ou fazer log in em <a href=http://www.paypal.com>www.paypal.com</a> para ver os detalhes da transação.',
	'PHPSHOP_PAYPAL_ERROR' => 'Ocorreu um erro ao processar a transação. O estado da sua encomenda não pode ser actualizado.',
	'PHPSHOP_THANKYOU_SUCCESS' => 'A sua encomenda foi efectuada com sucesso!',
	'VM_CHECKOUT_TITLE_TAG' => 'Finalizar: Passo %s de %s',
	'VM_CHECKOUT_ORDERIDNOTSET' => 'Código encomenda não defenido ou não informado!',
	'VM_CHECKOUT_FAILURE' => 'Incumprimento',
	'VM_CHECKOUT_SUCCESS' => 'Sucesso',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_1' => 'Esta página está localizada na loja virtual do site.',
	'VM_CHECKOUT_PAGE_GATEWAY_EXPLAIN_2' => 'The gateway execute the page on the website, and the shows the result SSL Encrypted.',
	'VM_CHECKOUT_CCV_CODE' => 'Código de validação do cartão de crédito',
	'VM_CHECKOUT_CCV_CODE_TIPTITLE' => 'O que é o código de validação do cartão de crédito?',
	'VM_CHECKOUT_MD5_FAILED' => 'Consulta MD5 falhou',
	'VM_CHECKOUT_ORDERNOTFOUND' => 'Encomenda não encontrada',
	'VM_CHECKOUT_PBS_APPROVED_ORDERCOMMENT' => '
                O pagamento foi aprovada pela PBS. \n
                A transação recebeu o seguinte número de transação:\n\n
                Número Transação: {transactionnumber}\n',
	'VM_CHECKOUT_PBS_NOTAPPROVED_ORDERCOMMENT' => '
                O pagamento não foi aprovado pela PBS. \n
                A transação recebeu o seguinte número de transação:\n\n
                Número Transação: {transactionnumber}\n',
	'VM_CHECKOUT_DD_ERROR_0' => 'Merchant/forretningsnummer ugyldigt',
	'VM_CHECKOUT_DD_ERROR_1' => 'Ugyldigt kreditkortnummer',
	'VM_CHECKOUT_DD_ERROR_2' => 'Ugyldigt belob',
	'VM_CHECKOUT_DD_ERROR_3' => 'OrderID mangler eller er ugyldig',
	'VM_CHECKOUT_DD_ERROR_4' => 'PBS afvisning - (Oftest - ugyldig kortdata, sp?rret kort osv...)',
	'VM_CHECKOUT_DD_ERROR_5' => 'Intern server fejl hos DanDomain eller PBS',
	'VM_CHECKOUT_DD_ERROR_6' => 'E-dankort ikke tilladt. Kontakt DanDomain',
	'VM_CHECKOUT_DD_ERROR_DEFAULT' => 'System fejl',
	'VM_CHECKOUT_FP_ERROR_1' => 'Erro: Transação recusada',
	'VM_CHECKOUT_FP_ERROR_2' => 'Erro: Transação recusada',
	'VM_CHECKOUT_FP_ERROR_3' => 'Erro: Formato errado no número',
	'VM_CHECKOUT_FP_ERROR_4' => 'Erro: Operação ilegal',
	'VM_CHECKOUT_FP_ERROR_5' => 'Erro: Sem resposta',
	'VM_CHECKOUT_FP_ERROR_6' => 'Error_system_failure',
	'VM_CHECKOUT_FP_ERROR_7' => 'Erro: Cartão vencido',
	'VM_CHECKOUT_FP_ERROR_8' => 'Erro: fracasso na Comunicação',
	'VM_CHECKOUT_FP_ERROR_9' => 'Erro: Fracasso Interno',
	'VM_CHECKOUT_FP_ERROR_10' => 'Erro: Card não registrado',
	'VM_CHECKOUT_FP_ERROR_DEFAULT' => 'Erro: Erro Desconhecido',
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
	'VM_CHECKOUT_WF_ERROR_14' => 'Error unknown'
); $VM_LANG->initModule( 'checkout', $langvars );
?>