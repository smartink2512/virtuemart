<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
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

$mainframe->setPageTitle( $VM_LANG->_PHPSHOP_ADD_SHIPTO_1 ." ".$VM_LANG->_PHPSHOP_ADD_SHIPTO_2 );
      
$Itemid = $sess->getShopItemid();
$next_page = mosGetParam( $_REQUEST, "next_page", "account.shipping" );
$user_info_id = mosGetParam( $_REQUEST, "user_info_id", "" );

$pathway = "<a class=\"pathway\" href=\"".$sess->url( SECUREURL ."index.php?page=account.index")."\" title=\"".$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."\">"
      .$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."</a> ".vmCommonHTML::pathway_separator().' '
      ."<a class=\"pathway\" href=\"".$sess->url( SECUREURL."index.php?page=$next_page")."\" title=\"".$VM_LANG->_PHPSHOP_USER_FORM_SHIPTO_LBL."\">"
      .$VM_LANG->_PHPSHOP_USER_FORM_SHIPTO_LBL."</a> ".vmCommonHTML::pathway_separator().' '
      .$VM_LANG->_PHPSHOP_SHOPPER_FORM_SHIPTO_LBL;
$mainframe->appendPathWay( $pathway );
echo "<div>$pathway</div><br/>";

$missing = mosGetParam( $vars, 'missing' );

if (!empty( $missing )) {
    echo "<script type=\"text/javascript\">alert('".html_entity_decode( $VM_LANG->_CONTACT_FORM_NC )."'); </script>\n";
}
$db = new ps_DB;
if (!empty($user_info_id)) {
  $q =  "SELECT * from #__{vm}_user_info WHERE user_info_id='".$database->getEscaped($user_info_id)."' ";
  $q .=  " AND user_id='".$auth['user_id']."'";
  $q .=  " AND address_type='ST'";
  $db->query($q);
  $db->next_record();
}

if( !$db->num_rows()) {
	$vars['country'] = mosGetParam($_REQUEST, 'country', $vendor_country);
}

$theme = vmTemplate::getInstance();
$theme->set_vars( array('next_page' => $next_page,
					'missing' => $missing,
					'vars' => $vars,
					'db' => $db,
					'user_info_id' => $user_info_id
					));
echo $theme->fetch('pages/'.$page.'.tpl.php');

?>