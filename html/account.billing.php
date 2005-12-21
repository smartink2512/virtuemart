<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: account.billing.php,v 1.5 2005/10/12 18:13:11 soeren_nb Exp $
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

require_once( CLASSPATH . "ps_userfield.php" );
require_once( CLASSPATH . "htmlTools.class.php" );

$mainframe->setPageTitle( $VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL );
      
$next_page = mosGetParam( $_REQUEST, "next_page", "account.index");
$Itemid = mosGetParam( $_REQUEST, "Itemid", null);

$missing = mosGetParam( $vars, 'missing' );
if (!empty($missing)) {
	echo "<script type=\"text/javascript\"> alert('"._CONTACT_FORM_NC."'); </script>\n";
}
$q =  "SELECT * FROM #__users, #__{vm}_user_info 
		WHERE user_id='" . $auth["user_id"] . "' 
		AND user_id = id
		AND address_type='BT' ";
$db->query($q);
$db->next_record();

echo "<div><a href=\"".$sess->url( SECUREURL ."index.php?page=account.index")."\" title=\"".$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."\">"
      .$VM_LANG->_PHPSHOP_ACCOUNT_TITLE."</a> -&gt; "
      .$VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL."</div><br/>";

?>      
<div style="float:left;width:90%;text-align:right;"> 
    <span>
    	<a href="#" onclick="if( submitregistration() ) { document.adminForm.submit();}">
    		<img border="0" src="administrator/images/save_f2.png" name="submit" alt="<?php echo _E_SAVE ?>" />
    	</a>
    </span>
    <span style="margin-left:10px;">
    	<a href="<?php $sess->purl( SECUREURL."index.php?page=account.index") ?>">
    		<img src="administrator/images/back_f2.png" alt="<?php echo _BACK ?>" border="0" />
    	</a>
    </span>
</div>
<?php
$fields = ps_userfield::getUserFields( 'account' );
ps_userfield::listUserFields( $fields, array(), $db );
?>
<div align="center">	
	<input type="submit" value="<?php echo _CMN_SAVE ?>" class="button" onclick="return( submitregistration());" />
</div>
  <input type="hidden" name="option" value="<?php echo $option ?>" />
  <input type="hidden" name="page" value="<?php echo $next_page; ?>" />
  <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
  <input type="hidden" name="func" value="shopperupdate" />
  <input type="hidden" name="user_info_id" value="<?php $db->p("user_info_id"); ?>" />
  <input type="hidden" name="id" value="<?php echo $auth["user_id"] ?>" />
  <input type="hidden" name="user_id" value="<?php echo $auth["user_id"] ?>" />
  <input type="hidden" name="address_type" value="BT" />
</form>