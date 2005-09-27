<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: COPYRIGHT.php 70 2005-09-15 20:45:51Z spacemonkey $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

class HTML_users {
	function showUsers( &$rows, $pageNav, $search, $option ) {
	global $mosConfig_offset, $db, $PHPSHOP_LANG;
    $order = mosGetParam( $_REQUEST, 'order', "asc" );
    $arg = mosGetParam( $_REQUEST, 'arg', "" );
?>
<form action="index2.php" method="post" name="adminForm">
  <table cellpadding="4" cellspacing="0" border="0" width="100%">
    <tr>
      <td width="100%" class="sectionname"><img src="images/user.png" align="middle"><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_LIST_LBL; ?></td> 
      <td nowrap="nowrap"><?php echo defined('_ADMIN_DISPLAY') ? _ADMIN_DISPLAY : "Display #";?></td>
      <td> <?php echo $pageNav->writeLimitBox(); ?> </td>
      <td><?php echo $PHPSHOP_LANG->_PHPSHOP_SEARCH_TITLE; ?></td>
      <td> <input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
      </td>
    </tr>
  </table>
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
    <tr>
      <th width="2%" class="title">#</td>
      <th width="3%" class="title"> <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($rows); ?>);" />
      </th>
      <th width="20%" class="title"><?php echo($PHPSHOP_LANG->_PHPSHOP_USER_LIST_FULL_NAME);?></th>
      <th width="10%" class="title">
        <a alt="order by username" href="index2.php?page=admin.user_list&option=com_phpshop&arg=a.username&order=<?php echo $order ?>">
        <?php echo $PHPSHOP_LANG->_PHPSHOP_USER_LIST_USERNAME;?></th>
      <th width="15%" class="title">
        <a href="index2.php?page=admin.user_list&option=com_phpshop&arg=a.perms&order=<?php echo $order ?>">
        <?php echo($PHPSHOP_LANG->_PHPSHOP_USER_LIST_GROUP);?></a></th>
      <th width="15%" class="title"><?php echo($PHPSHOP_LANG->_PHPSHOP_PRICE_FORM_GROUP);?></th>
      <th width="15%" class="title">
        <a href="index2.php?page=admin.user_list&option=com_phpshop&arg=a.email&order=<?php echo $order ?>">
        <?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_EMAIL;?></th>
      <th width="10%" class="title"><?php echo $PHPSHOP_LANG->_PHPSHOP_AFFILIATE_FORM_ACTIVE;?></th>
    </tr>
<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row =& $rows[$i];
			$img = $row->block ? 'publish_x.png' : 'tick.png';
			$task = $row->block ? 'unblock' : 'block';
      
      $q = "SELECT shopper_group_name FROM #__pshop_shopper_group, #__pshop_shopper_vendor_xref WHERE ";
      $q .= "#__pshop_shopper_vendor_xref.user_id='".$row->id."' AND #__pshop_shopper_vendor_xref.shopper_group_id=#__pshop_shopper_group.shopper_group_id";
      $db->query( $q );
      $db->next_record();
      $shopper_group_name = $db->f("shopper_group_name");
      
      $q = "SELECT first_name, last_name FROM #__users WHERE id='".$row->id."'";
      $db->query( $q );
      $db->next_record();
      $first_name = $db->f("first_name");
      $last_name = $db->f("last_name");
?>
    <tr class="<?php echo "row$k"; ?>">
      <td><?php echo $i+1+$pageNav->limitstart;?></td>
      <td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id; ?>" onClick="isChecked(this.checked);" /></td>
      <td><a href="#edit" onClick="return listItemTask('cb<?php echo $i;?>','edit')">
        <?php echo $first_name ." ".$last_name; ?> </a> </td>
      <td><a href="#edit" onClick="return listItemTask('cb<?php echo $i;?>','edit')">
        <?php echo $row->username; ?> </a> </td>
      <td><?php echo $row->perms; ?></td>
      <td><?php echo $shopper_group_name; ?></td>
      <td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
      <td width="10%"><a href="javascript: void(0);" onClick="return listItemTask('cb<?php echo $i;?>
','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a></td>
    </tr>
    <?php $k = 1 - $k; } ?>
    <tr align="right">
      <th colspan="3">&nbsp;</th>
      <th colspan="6"> <?php echo $pageNav->writePagesLinks(); ?></th>
    </tr>
    <tr>
      <td align="center" colspan="9"> <?php echo $pageNav->writePagesCounter(); ?></td>
    </tr>
  </table>
  <input type="hidden" name="option" value="<?php echo $option;?>" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="page" value="admin.user_list" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="order" value="<? echo $order ?>" />
  <input type="hidden" name="arg" value="<? echo $arg ?>" />
</form>
<?php }

	function edituser( &$row, &$lists, $option, $uid ) {
  
		global $my, $acl, $sess, $ps_user, $ps_html, $ps_product,
              $database, $db, $ps_shopper_group, $PHPSHOP_LANG;
    
    /* Get the Vendor id! */
    include_class( 'product' );
    $q = "SELECT * from #__users, #__pshop_auth_user_vendor ";
    $q .= "WHERE id='".$uid."' AND user_id='$uid'";
    $db->setQuery($q); $db->query(); $db->next_record();
		
    $canBlockUser = $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'user properties', 'block_user' );
		$canEmailEvents = $acl->acl_check( 'workflow', 'email_events', 'users', $acl->get_group_name( $row->gid, 'ARO' ) );
?>
	<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var r = new RegExp("[^0-9A-Za-z]", "i");

			// do field validation
			if (trim(form.name.value) == "") {
				alert( "<?php echo(_REGWARN_NAME);?>" );
			} else if (form.username.value == "") {
				alert( "<?php echo(_REGWARN_UNAME);?>" );
			} else if (r.exec(form.username.value)) {
				alert( "<?php printf(_VALID_AZ09, _USERNAME, 4 );?>" );
			} else if (trim(form.email.value) == "") {
				alert( "<?php echo(_REGWARN_MAIL);?>" );
			} else if (form.gid.value == "") {
				alert( "Please select a User Group!" );
			} else if (trim(form.password.value) != "" && form.password.value != form.password2.value){
				alert( "<?php echo(_REGWARN_VPASS2);?>" );
			} else {
				submitform( pressbutton );
			}
		}
	</script>
<span class="sectionname"><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_LBL ?></span>
<br /><br />
<?php
    $tabs = new mShopTabs(0, 1, "_main");
    $tabs->startPane("content-pane");
    $tabs->startTab( defined('_ADMIN_USER_MANAGER') ? _ADMIN_USER_MANAGER : "User Manager", "first-page");
  ?>
	<form action="index2.php" method="POST" name="adminForm">
	<table cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform">
		<tr>
			<td width="100"><?php echo $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_NAME;?>:</td>
			<td width="85%"><input type="text" name="name" class="inputbox" size="40" value="<?php echo $row->name; ?>" /></td>
		</tr>
		<tr>
			<td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_USERNAME;?>:</td>
			<td><input type="text" name="username" class="inputbox" size="40" value="<?php echo $row->username; ?>" /></td>
		<tr>
			<td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EMAIL;?>:</td>
			<td><input class="inputbox" type="text" name="email" size="40" value="<?php echo $row->email; ?>" /></td>
		</tr>
		<tr>
			<td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_PASSWORD_1;?>:</td>
			<td><input class="inputbox" type="password" name="password" size="40" value="" /></td>
		</tr>
		<tr>
			<td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_PASSWORD_2;?>:</td>
			<td><input class="inputbox" type="password" name="password2" size="40" value="" /></td>
		</tr>
		<tr>
		  <td valign="top"><?php echo defined('_ADMIN_USER_GROUP') ? _ADMIN_USER_GROUP : "Group";?>:</td>
		  <td><?php echo $lists['gid']; ?></td>
		</tr>
        <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_PERMS ?>:</td>
            <td > <?php $ps_user->list_perms("perms", $db->sf("perms")) ?> </td>
          </tr>
    <tr> 
      <td><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_FORM_VENDOR ?>:</td>
      <td><?php $ps_product->list_vendor($db->f("vendor_id"));  ?></td>
    </tr>
          <tr> 
            <td> <?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_GROUP ?>:</td>
            <td><?php
                include_class('shopper');
                $sg_id = $ps_shopper_group->get_shoppergroup_by_id($row->id);
                $ps_shopper_group->list_shopper_groups("shopper_group_id",$sg_id["shopper_group_id"]);?>
            </td>
          </tr>
<?php	if ($canBlockUser) { ?>
		<tr>
		  <td><?php echo defined('_ADMIN_USER_BLOCK') ? _ADMIN_USER_BLOCK : "Block User";?></td>
		  <td><?php echo $lists['block']; ?></td>
		</tr>
<?php	}
		if ($canEmailEvents) { ?>
		<tr>
		  <td><?php echo defined('_ADMIN_USER_SUBS') ? _ADMIN_USER_SUBS : "Receive Submission Emails";?></td>
		  <td><?php echo $lists['sendEmail']; ?></td>
		</tr>
<?php	} ?>
<?php if( $uid ) { ?>
		<tr>
		   <td><?php echo defined('_ADMIN_USER_REG_DATE') ? _ADMIN_USER_REG_DATE : "Register Date";?></td>
		   <td><?php echo $row->registerDate;?></td>
		</tr>
		<tr>
		   <td><?php echo defined('_ADMIN_USER_LAST_VISIT') ? _ADMIN_USER_LAST_VISIT : "Last Visit Date";?></td>
		   <td><?php echo $row->lastvisitDate;?></td>
		</tr>
<?php } ?>
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
  </table>
  
<?php
  $tabs->endTab();
  $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ORDER_PRINT_BILL_TO_LBL, "second-page");
      
   $q = "SELECT * from #__users WHERE #__users.id='".$uid."' ";
   $db->setQuery($q);
   $db->query();
   $db->next_record();
?>
    <table border="0" width="100%" cellpadding="4" cellspacing="1" class="adminform">
        <tr> 
            <td width="100"><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_FIRST_NAME ?>:</td>
            <td width="85%"> 
              <input type="text" class="inputbox" name="first_name" size="40" value="<?php echo $db->f("first_name") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_LAST_NAME ?>:</td>
            <td> 
              <input type="text" class="inputbox" name="last_name" size="40" value="<?php $db->sp("last_name") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_MIDDLE_NAME ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="middle_name" size="40" value="<?php $db->sp("middle_name") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_TITLE ?>:</td>
            <td > <?php $ps_html->list_user_title($db->sf("title")); ?></td>
          </tr>
          <tr> 
            <td><strong><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL ?></strong></td>
            <td>&nbsp; </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_CUSTOMER_NUMBER ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="customer_number" size="40" value="<?php echo $ps_shopper_group->get_customer_num($row->id) ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_COMPANY_NAME ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="company" size="40" value="<?php $db->sp("company") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_ADDRESS_1 ?>: 
            </td>
            <td > 
              <input type="text" class="inputbox" name="address_1" size="40" value="<?php $db->sp("address_1") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_ADDRESS_2 ?>: 
            </td>
            <td > 
              <input type="text" class="inputbox" name="address_2" size="40" value="<?php $db->sp("address_2") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_CITY ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="city" size="40" value="<?php $db->sp("city") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_ZIP ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="zip" size="10" value="<?php $db->sp("zip") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_COUNTRY ?>:</td>
            <td > 
              <?php $ps_html->list_country("country", $db->sf("country"), "id=\"country_field\" onchange=\"changeStateList();\"") ?>
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_STATE ?>:</td>
            <td ><?php
              echo $ps_html->dynamic_state_lists( "country", "state", $db->sf('country'), $db->sf('state') );
              ?>
            </td>
          </tr>
          <tr> 
            <td> <?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_PHONE ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="phone_1" size="40" value="<?php $db->sp("phone_1") ?>">
            </td>
          </tr>
          <tr> 
            <td> <?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_PHONE2 ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="phone_2" size="40" value="<?php $db->sp("phone_2") ?>">
            </td>
          </tr>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_FAX ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="fax" size="40" value="<?php $db->sp("fax") ?>">
            </td>
          </tr>
    <!-- If you do not wish show a EXTRA FIELD in this form add into condition "false && ".
         For example: if( false && $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_1 != "" ) -->
    <!-- EXTRA FIELD 1 - BEGIN - You can move this section into any other position of form. -->
        <?php if( $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_1 != "" ) { ?>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_1 ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="extra_field_1" size="40" value="<?php $db->sp("extra_field_1") ?>">
            </td>
          </tr>
        <?php } ?>
    <!-- EXTRA FIELD 1 - END -->
    <!-- EXTRA FIELD 2 - BEGIN - You can move this section into any other position of form. -->
        <?php if( $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_2 != "" ) { ?>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_2 ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="extra_field_2" size="40" value="<?php $db->sp("extra_field_2") ?>">
            </td>
          </tr>
        <?php } ?>
    <!-- EXTRA FIELD 2 - END -->
    <!-- EXTRA FIELD 3 - BEGIN - You can move this section into any other position of form. -->
        <?php if( $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_3 != "" ) { ?>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_3 ?>:</td>
            <td > 
              <input type="text" class="inputbox" name="extra_field_3" size="40" value="<?php $db->sp("extra_field_3") ?>">
            </td>
          </tr>
        <?php } ?>
    <!-- EXTRA FIELD 3 - END -->
    <!-- EXTRA FIELD 4 - BEGIN - You can move this section into any other position of form. -->
        <?php if( $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4 != "" ) { ?>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_4 ?>:</td>
            <td ><?php $ps_html->list_extra_field_4($db->sf("extra_field_4")); ?></td>
          </tr>
        <?php } ?>
    <!-- EXTRA FIELD 4 - END -->
    <!-- EXTRA FIELD 5 - BEGIN - You can move this section into any other position of form. -->
        <?php if( $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5 != "" ) { ?>
          <tr> 
            <td><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_FORM_EXTRA_FIELD_5 ?>:</td>
            <td ><?php $ps_html->list_extra_field_5($db->sf("extra_field_5")); ?></td>
          </tr>
        <?php } ?>
    <!-- EXTRA FIELD 5 - END -->
    
          <tr> 
            <td nowrap>&nbsp; </td>
            <td nowrap>&nbsp;</td>
          </tr>
          <tr> 
            <td><?php if (!empty($row->id)) { ?> 
              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr> 
                  <td ><b><?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_SHIPTO_LBL ?></b><a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?page=$modulename.user_address_form&user_id=".$row->id) ?>"><br>
                    </a><a href="<?php $sess->purl($_SERVER['PHP_SELF'] . "?page=admin.user_address_form&cid[0]=".$row->id."&user_id=".$row->id) ?>" >(<?php echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_ADD_SHIPTO_LBL ?>) 
                    </a></td>
                </tr>
                <tr> 
                  <td> </td>
                </tr>
                <tr> 
                  <td ><?php
                    $qt = "SELECT * from #__pshop_user_info where user_id='".$row->id."' ";
                    $qt .= "AND address_type='ST'"; 
                    $dbt = new ps_DB;
                    $dbt->query($qt);
                    if (!$dbt->num_rows()) {
                      echo $PHPSHOP_LANG->_PHPSHOP_USER_FORM_NO_SHIPPING_ADDRESSES;
                    }
                    else {
                      while ($dbt->next_record()) {
                        $url = $_SERVER['PHP_SELF'] . "?page=admin.user_address_form&cid[0]=".$row->id."&user_id=".$row->id."&user_info_id=" . $dbt->f("user_info_id");
                        echo "&raquo;<a href=" . $sess->url($url) . ">";
                        echo $dbt->f("address_type_name") . "</a><br />";
                      }
                    } ?>
                  </td>
                </tr>
              </table>
              <?php } ?>
              </td><td>&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>

<?php
  $tabs->endTab();
  $tabs->startTab( $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_BANK_TITLE, "third-page");

  $selected[0] = $db->sf('bank_account_type')=="Checking" ? 'selected="selected"' : '';
  $selected[1] = $db->sf('bank_account_type')=="Business Checking" ? 'selected="selected"' : '';
  $selected[2] = $db->sf('bank_account_type')=="Savings" ? 'selected="selected"' : '';
?>

    <table border="0" width="100%" cellpadding="4" cellspacing="1" class="adminform">
      <tr><td colspan="2" nowrap><b><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_BANK_TITLE ?> </b></td></tr>
        <tr><td><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_HOLDER ?>:</td>
        <td><input type="text" class="inputbox" name="bank_account_holder" size="40" value="<?php $db->sp("bank_account_holder") ?>"></td></tr>
        <tr><td width="100"><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_ACCOUNT_NR ?>:</td>
        <td width="85%" ><input type="text" class="inputbox" name="bank_account_nr" size="40" value="<?php $db->sp("bank_account_nr") ?>"></td></tr>
        <tr><td><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_SORT_CODE ?>:</td>
        <td><input type="text" class="inputbox" name="bank_sort_code" size="40" value="<?php $db->sp("bank_sort_code") ?>"></td></tr>
        <tr><td><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_NAME ?>:</td>
        <td><input type="text" class="inputbox" name="bank_name" size="40" value="<?php $db->sp("bank_name") ?>"></td></tr>
        <tr><td><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_BANK_IBAN ?>:</td>
        <td><input type="text" class="inputbox" name="bank_iban" size="40" value="<?php $db->sp("bank_iban") ?>"></td></tr>
        <tr><td width="27%" nowrap="nowrap" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE ?>:</td>
            <td width="73%" >
              <select class="inputbox" name="bank_account_type">
                <option <?php echo $selected[0] ?> value="Checking"><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_CHECKING ?></option>
                <option <?php echo $selected[1] ?> value="Business Checking"><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_BUSINESSCHECKING ?></option>
                <option <?php echo $selected[2] ?> value="Savings"><?php echo $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_LBL_ACCOUNT_TYPE_SAVINGS ?></option>
              </select>
            </td>
        </tr>
    </table>

<?php
$tabs->endTab();
$tabs->endPane();
?>  
  
  <input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<?php	if (!$canEmailEvents) { ?>
  <input type="hidden" name="sendEmail" value="0" />
<?php } ?>
  <input type="hidden" name="address_type" value="BT" />
  <input type="hidden" name="address_type_name" value="-default-" />
  <input type="hidden" name="option" value="com_phpshop" />
  <input type="hidden" name="page" value="admin.user_list" />
  <input type="hidden" name="task" value="" />
</form>

<?php }

}?>
