<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shopper.shopper_by_group_list.php,v 1.2 2005/01/27 19:34:03 soeren_nb Exp $
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
?>

<h2>List User by Group</h2> 
<?php $q = "SELECT * from #__users ";
$q .= "WHERE #__users.address_type='BT'";
$q .= "order by #__users.username"; 
$db->query($q);  
?> 
<table width="100%" class="adminlist">
  <tr > 
    <th width="23%"><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_USERNAME ?></th>
    <th width="46%"><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_NAME ?></th>
    <th width="31%"><?php echo $PHPSHOP_LANG->_PHPSHOP_SHOPPER_LIST_GROUP ?></th>
  </tr>
  <tr> 
    <td colspan="3"> 
      <hr>
    </td>
  </tr>
  <?php
while ($db->next_record()) { ?> 
  <tr nowrap > 
    <td width="23%"><?php
$url = $PHP_SELF . "?page=admin.shopper_form&user_id=";
$url .= $db->f("id");
echo "<A HREF=" . $sess->url($url) . ">";
echo $db->f("username"); 
echo "</A>"; ?></td>
    <td width="46%"><?php echo $db->f("bill_first_name") . " ";
echo $db->f("bill_middle_name") . " ";
echo $db->f("bill_last_name"); ?></td>
    <td width="31%">&nbsp;</td>
  </tr>
  <?php } ?> 
</table>
