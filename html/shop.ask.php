<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id:shop.ask.php 431 2006-10-17 21:55:46 +0200 (Di, 17 Okt 2006) soeren_nb $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

global $VM_LANG,$mm_action_url;

$product_id = intval( mosgetparam($_REQUEST, "product_id", null) );
$product_sku = $db->getEscaped( mosgetparam($_REQUEST, "sku", '' ) );
$category_id = mosgetparam($_REQUEST, "category_id", null);
$set = mosgetparam($_REQUEST, "set", 0 );
$Itemid = $sess->getShopItemid();
$flypage = mosgetparam($_REQUEST, "flypage", '' );
$subject = substr( urldecode( mosGetParam( $_REQUEST, 'subject')), 0, 150 );

$db_product = new ps_DB;
// Get the product info from the database
$q = "SELECT * FROM `#__{vm}_product` WHERE ";
if( !empty($product_id)) {
	$q .= "`product_id`=$product_id";
}
elseif( !empty($product_sku )) {
	$q .= "`product_sku`='$product_sku'";
}
else {
	mosRedirect( $_SERVER['PHP_SELF']."?option=com_virtuemart&keyword={$_SESSION['keyword']}&category_id={$_SESSION['category_id']}&limitstart={$_SESSION['limitstart']}", $VM_LANG->_PHPSHOP_PRODUCT_NOT_FOUND );
}
if( !$perm->check("admin,storeadmin") ) {
	$q .= " AND `product_publish`='Y'";
	if( CHECK_STOCK && PSHOP_SHOW_OUT_OF_STOCK_PRODUCTS != "1") {
		$q .= " AND `product_in_stock` > 0 ";
	}
}
$db_product->query( $q );
// Redirect back to Product Browse Page on Error
if( !$db_product->next_record() ) {
	mosRedirect( $_SERVER['PHP_SELF']."?option=com_virtuemart&keyword={$_SESSION['keyword']}&category_id={$_SESSION['category_id']}&limitstart={$_SESSION['limitstart']}", $VM_LANG->_PHPSHOP_PRODUCT_NOT_FOUND );
}


/* Set Dynamic Page Title */
$pagetitle = _ENQUIRY.' - '.substr($db_product->f('product_name'), 0, 60 );
$mainframe->setPageTitle(  );

// set up return to product link
$product_link = $sess->url( $mm_action_url.basename($_SERVER['PHP_SELF'])."?page=shop.product_details&flypage=$flypage&product_id=$product_id&category_id=$category_id" );
$return_seller = "<a class=\"button\" href=\"". $product_link ."\">";
$return_seller .= $VM_LANG->_VM_RETURN_TO_PRODUCT."</a>";
$name = "";
$email = "";

$mainframe->appendPathWay( vmCommonHTML::hyperLink( $product_link,$db_product->f('product_name') ) . vmCommonHTML::pathway_separator() . $pagetitle );

if ($my->id) {
	$theUser = new mosUser( $database );
	$theUser->load( $my->id );
	$name = $theUser->name;
	$email = $theUser->email;
}

// if set then display email form

// get current user name and email

// Set up form for email details
$send_mail = "<form action=\"".$mm_action_url."index.php\" method=\"post\" name=\"emailForm\" id=\"emailForm\">\n";
$send_mail .= "<label for=\"contact_name\">"._NAME_PROMPT."</label />\n";
$send_mail .= "<br><input type=\"text\" name=\"name\" id=\"contact_name\" size=\"80\" class=\"inputbox\" value=\"".$name."\"><br><br />\n";
$send_mail .= "<label for=\"contact_mail\">"._EMAIL_PROMPT."</label />\n";
$send_mail .= "<br><input type=\"text\" id=\"contact_mail\" name=\"email\" size=\"80\" label=\"Your email\" class=\"inputbox\" value=\"".$email."\"><br><br />\n";
$send_mail .= "<label for=\"contact_text\">"._MESSAGE_PROMPT."</label><br />\n";
$send_mail .= "<textarea rows=\"10\" cols=\"60\" name=\"text\" id=\"contact_text\" class=\"inputbox\">$subject</textarea><br />\n";
$send_mail .=  "<input type=\"button\" name=\"send\" value=\""._SEND_BUTTON."\" class=\"button\" onclick=\"validateForm()\" />\n";

// Set up product variables for product ask
$send_mail .= "<input type=\"hidden\" name=\"product_id\" value=\"". $db_product->f("product_id") ."\" />\n";
$send_mail .= "<input type=\"hidden\" name=\"product_sku\" value=\"". $db_product->f("product_sku") ."\" />\n";
$send_mail .= "<input type=\"hidden\" name=\"set\" value=\"1\" />\n";

// set up required fields for virtuemart function
$send_mail .= "<input type=\"hidden\" name=\"func\" value=\"productAsk\" />\n";
$send_mail .= "<input type=\"hidden\" name=\"page\" value=\"shop.ask\" />\n";
$send_mail .= "<input type=\"hidden\" name=\"option\" value=\"com_virtuemart\" />\n";
$send_mail .= "<input type=\"hidden\" name=\"flypage\" value=\"".$flypage."\" />\n";
$send_mail .= "<input type=\"hidden\" name=\"Itemid\" value=\"".$Itemid."\" />\n";
$validate = mosHash( $mainframe->getCfg( 'db' ) );
$send_mail .= "<input type=\"hidden\" name=\"".$validate."\" value=\"1\" />";
$send_mail .= "</form>";

//output javascript for form validation
vmViewContact();

if ( $set == 1 ) { // set not set so display confirmation
  ?>
   <img src="<?php echo VM_THEMEURL ?>images/button_ok.png" height="48" width="48" align="center" alt="Success" border="0" />
   <?php echo _THANK_MESSAGE ?>
  
  <br /><p>
  <?php echo $VM_LANG->_PHPSHOP_EMAIL_SENDTO .": <strong>". $vendor_mail .'</strong>'?><br />
  </p>
  <?php 
  echo "<br /><br />".$return_seller;
}
else {
	echo '<br />';
	echo $return_seller.'<br /><br />';
	echo $send_mail;
}


/*
Function to output javascript for simple form checking.
Saves doing it in main class
*/
function vmViewContact() {
	global $mosConfig_live_site;
	global $mainframe, $Itemid;

	?>
	<script language="JavaScript" type="text/javascript"><!--
	window.validateForm = function(){
		if ( ( document.emailForm.text.value == "" ) || ( document.emailForm.email.value.search("@") == -1 ) || ( document.emailForm.email.value.search("[.*]" ) == -1 ) ) {
			alert( "<?php echo _CONTACT_FORM_NC; ?>" );
		} else if ( ( document.emailForm.email.value.search(";") != -1 ) || ( document.emailForm.email.value.search(",") != -1 ) || ( document.emailForm.email.value.search(" ") != -1 ) ) {
			alert( "You cannot enter more than one email address" );
		} else {
			document.emailForm.action = "<?php echo sefRelToAbs("index.php"); ?>"
			document.emailForm.submit();
		}
	}
	--></script>
		
<?php
}
?>