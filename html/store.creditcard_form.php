<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: store.creditcard_form.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
* @package mambo-phpShop
* @subpackage HTML
* @copyright (C) 2004-2005 Soeren Eberhardt
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* mambo-phpShop is Free Software.
* mambo-phpShop comes with absolute no warranty.
*
* www.mambo-phpshop.net
*/
mm_showMyFileName( __FILE__ );

$creditcard_id = mosgetparam( $_REQUEST, 'creditcard_id', "");
?>
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_CREDITCARD_FORM_LBL ?></h2>
<?php 
  if (!empty($creditcard_id)) {
    $q = "SELECT * from #__pshop_creditcard where creditcard_id='$creditcard_id'";
    $db->query($q);
    $db->next_record();
}
?> 
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="adminForm">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CREDITCARD_NAME ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="creditcard_name" value="<?php $db->sp("creditcard_name") ?>" />
        <? if (!empty($creditcard_id)) { ?>
        <input type="hidden" name="creditcard_id" value="<?php echo $creditcard_id ?>" />
        <? } ?>
        <input type="hidden" name="func" value="<?php if (!empty($creditcard_id)) echo "creditcardUpdate"; else echo "creditcardAdd"; ?>" />
        <input type="hidden" name="page" value="store.creditcard_list" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="com_phpshop" />
        <?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CREDITCARD_CODE ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="creditcard_code" value="<?php $db->sp("creditcard_code") ?>">
      </td>
    </tr>
  </table>
</form>

