<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.waiting_list.php,v 1.2 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* Contains code from PHPShop(tm):
* 	@copyright (C) 2000 - 2004 Edikon Corporation (www.edikon.com)
*	Community: www.phpshop.org, forums.phpshop.org
* Conversion to Mambo and the rest:
* 	@copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

require_once (CLASSPATH. 'ps_product.php' );
$ps_product = new ps_product;
?>


<form action="<?php echo URL ?>index.php" method="post" name="waiting">
<input type="hidden" name="option" value="com_phpshop" />
<input type="hidden" name="func" value="waitinglistadd" />
<?php echo $PHPSHOP_LANG->_PHPSHOP_WAITING_LIST_MESSAGE ?>
<br />
<br />

<?php
    if ($auth["user_id"]) {

    $q =  "SELECT * FROM #__users WHERE ";
    $q .= "id='" . $auth["user_id"] . "' ";
    $q .= "AND address_type='BT' ";
    $db->query($q);
    if(!$db->num_rows()) {
        $q =  "SELECT * FROM #__pshop_user_info WHERE ";
        $q .= "user_id='" . $auth["user_id"] . "' ";
        $q .= "AND address_type='BT' ";
        $db->query($q);
    }
    $db->next_record();
    $email = $db->f("user_email");
    if (!empty($email))
        $shopper_email = $db->f("user_email");
    else
        $shopper_email = $db->f("email");
?>
<input type="hidden" name="user_id" value="<?php echo $auth["user_id"]; ?>" />
<input type="text" class="inputbox" name="notify_email" value="<?php echo $shopper_email ?>" />
<br />
<?php
 } else {?> 

<input type="text" class="inputbox" name="notify_email"><br />
<?php
}
?>



<input type="submit" class="button" name="waitinglistadd" value="<?php echo $PHPSHOP_LANG->_PHPSHOP_WAITING_LIST_NOTIFY_ME ?>" />

<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
<input type="hidden" name="page" value="shop.waiting_thanks" />


</form>
