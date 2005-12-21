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

global $acl;
if (!$acl->acl_check( 'administration', 'manage', 'users', $my->usertype, 'components', 'com_users' )) {
	mosRedirect( $_SERVER['PHP_SELF'], _NOT_AUTH );
}
global $ps_shopper_group;
include_class( 'shopper' );

if( !isset($ps_shopper_group)) {
	$ps_shopper_group = new ps_shopper_group();
}

$user_id = intval( mosGetParam( $_REQUEST, 'user_id' ));

if( !empty($user_id) ) {
	$q = "SELECT * FROM #__users AS u LEFT JOIN #__{vm}_user_info AS ui ON id=user_id ";
	$q .= "WHERE id=$user_id ";
	$q .= "AND (address_type='BT' OR address_type IS NULL ) ";
	$q .= "AND gid <= ".$my->gid;
	$db->query($q);
	$db->next_record();
}

//First create the object and let it print a form heading
$formObj = &new formFactory( $VM_LANG->_PHPSHOP_USER_FORM_LBL );
//Then Start the form
$formObj->startForm();

$tabs = new mShopTabs(0, 1, "_userform");
$tabs->startPane("userform-pane");
$tabs->startTab( 'General User Information', "userform-page");

$_REQUEST['cid'][0] = $user_id;
$_REQUEST['task'] = 'edit';
$mainframe->_path->admin_html = $mosConfig_absolute_path.'/administrator/components/com_users/admin.users.html.php';
$mainframe->_path->class = $mosConfig_absolute_path.'/administrator/components/com_users/users.class.php';
ob_start();
require( $mosConfig_absolute_path.'/administrator/components/com_users/admin.users.php' );
$userform = ob_get_contents();
ob_end_clean();

$userform = str_replace( '<form action="index2.php" method="post" name="adminForm">', '', $userform );
$userform = str_replace( '</form>', '', $userform );

echo $userform;
$_REQUEST['option'] = 'com_virtuemart';

$tabs->endTab();
$tabs->startTab( $VM_LANG->_PHPSHOP_SHOPPER_FORM_LBL, "third-page");
?>
<table class="adminform">  
	<tr> 
		<td style="text-align:right;"><?php echo $VM_LANG->_PHPSHOP_PRODUCT_FORM_VENDOR ?>:</td>
		<td><?php $ps_product->list_vendor($db->f("vendor_id"));  ?></td>
	</tr>
	<tr> 
		<td nowrap="nowrap" style="text-align:right;" width="38%" ><?php echo $VM_LANG->_PHPSHOP_USER_FORM_PERMS ?>:</td> 
		<td width="62%" > 
			<?php
			$perm->list_perms("perms", $db->sf("perms"));
			?> 
		</td> 
	</tr>
	<tr> 
        <td style="text-align:right;"><?php echo $VM_LANG->_PHPSHOP_USER_FORM_CUSTOMER_NUMBER ?>:</td>
        <td > 
          <input type="text" class="inputbox" name="customer_number" size="40" value="<?php echo $ps_shopper_group->get_customer_num($db->f("user_id")) ?>" />
        </td>
      </tr>
      <tr> 
        <td style="text-align:right;"> <?php echo $VM_LANG->_PHPSHOP_SHOPPER_FORM_GROUP ?>:</td>
        <td><?php
			include_class('shopper');
			$sg_id = $ps_shopper_group->get_shoppergroup_by_id($db->f("user_id"));
			$ps_shopper_group->list_shopper_groups("shopper_group_id",$sg_id["shopper_group_id"]);?>
        </td>
      </tr>
</table> 

       
<?php 
if( $db->f("user_id") ) { 
?> 
     
         <h3><?php echo $VM_LANG->_PHPSHOP_USER_FORM_SHIPTO_LBL ?>

		<a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?page=$modulename.user_address_form&amp;user_id=$user_id") ?>" >
		(<?php echo $VM_LANG->_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL ?>)</a></h3> 
       
	<table class="adminlist"> 
		<tr> 
			<td > 
				  <?php
			$qt = "SELECT * from #__{vm}_user_info WHERE user_id='$user_id' AND address_type='ST'"; 
			$dbt = new ps_DB;
			$dbt->query($qt);
			if (!$dbt->num_rows()) {
			  echo "No shipping addresses.";
			}
			else {
			  while ($dbt->next_record()) {
				$url = SECUREURL . "?page=$modulename.user_address_form&user_id=$user_id&user_info_id=" . $dbt->f("user_info_id");
				echo '&raquo; <a href="' . $sess->url($url) . '">';
				echo $dbt->f("address_type_name") . "</a><br/>";
			  }
			} ?> 
			</td> 
		</tr> 
	</table> 
         <?php 
}

$tabs->endPane();
$tabs->startTab( $VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL, "billto-page");


require_once( CLASSPATH.'ps_userfield.php');
// Get only those fields that are NOT system fields
$userFields = ps_userfield::getUserFields( 'registration' );
$skipFields = array('username', 'email', 'password', 'password2', 'agreed');

echo '<table class="adminform"><tr><td>';
ps_userfield::listUserFields( $userFields, $skipFields, $db );
echo '</td></tr></table>';

$tabs->endTab();
$tabs->endPane();

// Add necessary hidden fields
$formObj->hiddenField( 'address_type', 'BT' );
$formObj->hiddenField( 'address_type_name', '-default-' );
$formObj->hiddenField( 'user_id', $user_id );

$funcname = $db->f("user_id") ? "userUpdate" : "userAdd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, 'admin.user_list', $option );

?>
<script type="text/javascript">
function submitbutton( button ) {
	if( submitregistration() ) {
		document.adminForm.submit();
	}
}
</script>