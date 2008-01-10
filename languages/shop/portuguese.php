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
	'PHPSHOP_BROWSE_LBL' => 'Procurar Artigos',
	'PHPSHOP_FLYPAGE_LBL' => 'Detalhe do Produto',
	'PHPSHOP_ERROR' => 'ERRO',
	'PHPSHOP_PRODUCT_FORM_EDIT_PRODUCT' => 'Editar este Produto',
	'PHPSHOP_DOWNLOADS_START' => 'Iniciar Download',
	'PHPSHOP_DOWNLOADS_INFO' => 'Por favor escreva o Download-ID que recebeu no seu email e carregue em \'Iniciar Download\'.',
	'PHPSHOP_WAITING_LIST_MESSAGE' => 'Por favor introduza o seu e-mail, será avisado logo que o produto entre em stock. 
                                                                        O seu endereço de e-mail será apenas utilizado para este fim.<br /><br />Obrigado!',
	'PHPSHOP_WAITING_LIST_THANKS' => 'Obrigado por aguardar! <br />Será avisado logo que entre para stock.',
	'PHPSHOP_WAITING_LIST_NOTIFY_ME' => 'Avisar!',
	'PHPSHOP_SEARCH_ALL_CATEGORIES' => 'Procurar todas as categorias',
	'PHPSHOP_SEARCH_ALL_PRODINFO' => 'Procurar todos os detalhes produto',
	'PHPSHOP_SEARCH_PRODNAME' => 'Apenas Produto',
	'PHPSHOP_SEARCH_MANU_VENDOR' => 'Apenas Marca/vendedor',
	'PHPSHOP_SEARCH_DESCRIPTION' => 'Apenas Descrição Produto',
	'PHPSHOP_SEARCH_AND' => 'e',
	'PHPSHOP_SEARCH_NOT' => 'não',
	'PHPSHOP_SEARCH_TEXT1' => 'A primeira lista permite selecionar uma categoria a fim de limitar a procura. 
        A segunda lista permite limitar os detalhes do produto (ex. Nome). 
        Uma vez estas selecionadas (ou deixadas por defeito), introduza a palavras-chave. ',
	'PHPSHOP_SEARCH_TEXT2' => ' Pode adicionar mais palavras-chave e operadores como AND ou NOT. 
        Selecionando AND significa que ambas as palavras tem de estar presentes para o produto ser apresentado. 
        Selecionando NOT signitica que a primeira palavra tem de estar presente e a segunda não poderá existir para o produto ser apresentado.',
	'PHPSHOP_CONTINUE_SHOPPING' => 'Continue Shopping',
	'PHPSHOP_AVAILABLE_IMAGES' => 'Available Images for',
	'PHPSHOP_BACK_TO_DETAILS' => 'Back to Product Details',
	'PHPSHOP_IMAGE_NOT_FOUND' => 'Image not found!',
	'PHPSHOP_PARAMETER_SEARCH_TEXT1' => 'Do you will find products according to technical parametrs?<BR>You can used any prepared form:',
	'PHPSHOP_PARAMETER_SEARCH_NO_PRODUCT_TYPE' => 'I am sorry. There is no category for search.',
	'PHPSHOP_PARAMETER_SEARCH_BAD_PRODUCT_TYPE' => 'I am sorry. There is no published Product Type with this name.',
	'PHPSHOP_PARAMETER_SEARCH_IS_LIKE' => 'Is Like',
	'PHPSHOP_PARAMETER_SEARCH_IS_NOT_LIKE' => 'Is NOT Like',
	'PHPSHOP_PARAMETER_SEARCH_FULLTEXT' => 'Full-Text Search',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ALL' => 'All Selected',
	'PHPSHOP_PARAMETER_SEARCH_FIND_IN_SET_ANY' => 'Any Selected',
	'PHPSHOP_PARAMETER_SEARCH_RESET_FORM' => 'Reset Form',
	'PHPSHOP_PRODUCT_NOT_FOUND' => 'Sorry, but the Product you\'ve requested wasn\'t found!',
	'PHPSHOP_PRODUCT_PACKAGING1' => 'Number {unit}s in packaging:',
	'PHPSHOP_PRODUCT_PACKAGING2' => 'Number {unit}s in box:',
	'PHPSHOP_CART_PRICE_PER_UNIT' => 'Price per Unit',
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