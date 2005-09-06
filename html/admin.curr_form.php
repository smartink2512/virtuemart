<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.curr_form.php,v 1.4 2005/01/27 19:34:00 soeren_nb Exp $
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
?>
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_ADD ?></h2>
<?php 
  $limitstart = mosgetparam( $_REQUEST, 'limitstart');
  $currency_id = mosgetparam( $_REQUEST, 'currency_id');
  if ($currency_id) {
    $q = "SELECT * from #__pshop_currency where currency_id='$currency_id'";
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
      <td width="24%" ALIGN="RIGHT"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_NAME ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="currency_name" value="<?php $db->sp("currency_name") ?>" />
        <? if ($currency_id) { ?>
          <input type="hidden" name="currency_id" value="<?php echo $currency_id ?>" />
        <? } ?>
        <input type="hidden" name="func" value="<?php if (isset($currency_id)) echo "currencyUpdate"; else echo "currencyAdd"; ?>" />
        <input type="hidden" name="page" value="admin.curr_list" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="com_phpshop" />
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_CURRENCY_LIST_CODE ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="currency_code" value="<?php $db->sp("currency_code") ?>">
      </td>
    </tr>
    
    
  </table>
</form>

