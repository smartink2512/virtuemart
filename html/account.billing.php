<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 Soeren Eberhardt. All rights reserved.
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

require_once( CLASSPATH . "ps_userfield.php" );
require_once( CLASSPATH . "htmlTools.class.php" );

$mainframe->setPageTitle( $VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL );
      
$next_page = mosGetParam( $_REQUEST, "next_page", "account.index");
$Itemid = $sess->getShopItemid();

$missing = mosGetParam( $vars, 'missing' );
if (!empty($missing)) {
	echo "<script type=\"text/javascript\"> alert('".$VM_LANG->_CONTACT_FORM_NC."'); </script>\n";
}
$q =  "SELECT * FROM #__users, #__{vm}_user_info 
		WHERE user_id='" . $auth["user_id"] . "' 
		AND user_id = id
		AND address_type='BT' ";
$db->query($q);
$db->next_record();

$pathway = "<a class=\"pathway\"  href=\"".$sess->url( SECUREURL ."index.php?page=account.index")."\" title=\"".$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."\">"
      .$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."</a> ".vmCommonHTML::pathway_separator().' '
      .$VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL;
echo "<div>$pathway</div><br/>";
$mainframe->appendPathWay( $pathway );

$fields = ps_userfield::getUserFields( 'account' );

$theme = vmTemplate::getInstance();
$theme->set_vars( array(
					'fields' => $fields,
					'db' => $db,
					'next_page' => $next_page,
					'missing' => $missing,
					'Itemid' => $Itemid
					));
echo $theme->fetch('pages/'.$page.'.tpl.php');
?>      
