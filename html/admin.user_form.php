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
$GLOBALS['option'] = 'com_users'; // Cheat Joomla 1.1
$mainframe->_path->admin_html = $mosConfig_absolute_path.'/administrator/components/com_users/admin.users.html.php';
require_once( $mainframe->_path->admin_html );
$mainframe->_path->class = $mosConfig_absolute_path.'/administrator/components/com_users/users.class.php';
ob_start();
require( $mosConfig_absolute_path.'/administrator/components/com_users/admin.users.php' );
$userform = ob_get_contents();
ob_end_clean();

$userform = str_replace( '<form action="index2.php" method="post" name="adminForm">', '', $userform );
$userform = str_replace( '</form>', '', $userform );
$userform = str_replace( '<div id="editcell">', '', $userform );
$userform = str_replace( '</table>
                </div>', '</table>', $userform );
echo $userform;

$_REQUEST['option'] = $GLOBALS['option'] = 'com_virtuemart';

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
                        if( !isset( $ps_perms)) { $ps_perms = new ps_perm(); }
                        $ps_perms->list_perms("perms", $db->sf("perms"));
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
            <td ><?php
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

$tabs->endTab();
$tabs->startTab( $VM_LANG->_PHPSHOP_USER_FORM_BILLTO_LBL, "billto-page");


require_once( CLASSPATH.'ps_userfield.php');
// Get only those fields that are NOT system fields
$userFields = ps_userfield::getUserFields( 'registration' );
$skipFields = array('username', 'email', 'password', 'password2', 'agreed');

echo '<table class="adminform"><tr><td>';
ps_userfield::listUserFields( $userFields, $skipFields, $db );
echo '</td></tr></table>';

$tabs->endTab();
$tabs->startTab( $VM_LANG->_PHPSHOP_ORDER_LIST_LBL, "order-list");
?>
        
<h3><?php echo $VM_LANG->_PHPSHOP_ORDER_LIST_LBL ?> </h3>

<?php
require_once( CLASSPATH . "pageNavigation.class.php" );
require_once( CLASSPATH . "htmlTools.class.php" );
require_once(CLASSPATH.'ps_order_status.php');
$ps_order_status = new ps_order_status;

$q = "";
$list  = "SELECT * FROM #__{vm}_orders ";
$count = "SELECT count(*) as num_rows FROM #__{vm}_orders ";
$q .= "WHERE  #__{vm}_orders.vendor_id='".$_SESSION['ps_vendor_id']."' AND #__{vm}_orders.user_id=".$user_id." ";
$q .= "ORDER BY #__{vm}_orders.cdate DESC ";
$count .= $q;

$db->query($count);
$db->next_record();
$num_rows = $db->f("num_rows");

// Create the Page Navigation
$pageNav = new vmPageNav( $num_rows, $limitstart, $limit );

// Create the List Object with page navigation
$listObj = new listFactory( $pageNav );

$listObj->startTable();

// these are the columns in the table
$columns = Array(  "#" => "width=\"20\"", 
                                        $VM_LANG->_PHPSHOP_ORDER_LIST_ID => '',
                                        $VM_LANG->_PHPSHOP_CHECK_OUT_THANK_YOU_PRINT_VIEW => '',
                                        $VM_LANG->_PHPSHOP_ORDER_LIST_CDATE => '',
                                        $VM_LANG->_PHPSHOP_ORDER_LIST_MDATE => '',
                                        $VM_LANG->_PHPSHOP_ORDER_LIST_STATUS => '',
                                        $VM_LANG->_PHPSHOP_ORDER_LIST_TOTAL => '',
                                        _E_REMOVE => "width=\"5%\""
                                );
$listObj->writeTableHeader( $columns );

$db->query($list);
$i = 0;
while ($db->next_record()) { 
    
        $listObj->newRow();
        
        // The row number
        $listObj->addCell( $pageNav->rowNumber( $i ) );
        
        $url = $_SERVER['PHP_SELF']."?page=order.order_print&limitstart=$limitstart&keyword=$keyword&order_id=". $db->f("order_id");
        $tmp_cell = "<a href=\"" . $sess->url($url) . "\">".sprintf("%08d", $db->f("order_id"))."</a><br />";
        $listObj->addCell( $tmp_cell );
        
        $details_url = $sess->url( $_SERVER['PHP_SELF']."?page=order.order_printdetails&amp;order_id=".$db->f("order_id")."&amp;no_menu=1");
    $details_url = stristr( $_SERVER['PHP_SELF'], "index2.php" ) ? str_replace( "index2.php", "index3.php", $details_url ) : str_replace( "index.php", "index2.php", $details_url );
        
    $details_link = "&nbsp;<a href=\"javascript:void window.open('$details_url', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');\">";
    $details_link .= "<img src=\"$mosConfig_live_site/images/M_images/printButton.png\" align=\"center\" height=\"16\" width=\"16\" border=\"0\" /></a>"; 
    $listObj->addCell( $details_link );

        $listObj->addCell( strftime("%d-%b-%y %H:%M", $db->f("cdate")));
    $listObj->addCell( strftime("%d-%b-%y %H:%M", $db->f("mdate")));

        $listObj->addCell( $CURRENCY_DISPLAY->getFullValue($db->f("order_total")));
        
        $listObj->addCell(  $ps_order_status->getOrderStatusName($db->f("order_status")));
        
    
        $listObj->addCell( $ps_html->deleteButton( "order_id", $db->f("order_id"), "orderDelete", $keyword, $limitstart ) );

        $i++; 
}

$listObj->writeTable();

$listObj->endTable();

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