<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: tax.tax_form.php,v 1.5 2005/06/18 08:51:34 soeren_nb Exp $
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
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_TAX_FORM_LBL ?></H2>
<?php 
$tax_rate_id= mosgetparam( $_REQUEST, 'tax_rate_id');
if (!empty($tax_rate_id)) {
  $q = "SELECT * FROM #__pshop_tax_rate WHERE tax_rate_id='$tax_rate_id'"; 
  $db->query($q);  
  $db->next_record();
}
?><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" name="adminForm">
  <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td><b><?php echo $PHPSHOP_LANG->_PHPSHOP_TAX_FORM_LBL ?></b></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_TAX_FORM_COUNTRY ?>:</td>
      <td>
        <?php $ps_html->list_country("tax_country", $db->sf("tax_country"), "onchange=\"changeStateList();\"") ?> 
      </td>
    </tr>
    <tr align="center">
      <td colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_TAX_FORM_STATE ?>:</td>
      <td><?php 
        //$ps_html->list_states("tax_state", $db->sf("tax_state")); 
        echo $ps_html->dynamic_state_lists( "tax_country", "tax_state", $db->sf("tax_country"), $db->sf("tax_state") );
        ?>
      </td>
    </tr>
    <tr align="center">
      <td colspan="2" >&nbsp;</td>
    </tr>
    <tr> 
      <td align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_TAX_FORM_RATE ?>:</td>
      <td> 
        <input type="text" class="inputbox" name="tax_rate" value="<?php $db->sp("tax_rate") ?>" size="16">
      </td>
    </tr>
    <tr align="center">
      <td colspan="2" >&nbsp;</td>
    </tr>
    <tr align="center"> 
      <td colspan="2" > 
        <input type="hidden" name="tax_rate_id" value="<?php echo $tax_rate_id ?>" />
        <input type="hidden" name="func" value="<?php if (!empty($tax_rate_id)) echo "updatetaxrate"; else echo "addtaxrate"; ?>" />
        <input type="hidden" name="page" value="tax.tax_list" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="com_phpshop" />
        <?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
      </td>
    </tr>
  </table>
</form>
