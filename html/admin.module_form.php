<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.module_form.php,v 1.4 2005/01/27 19:34:00 soeren_nb Exp $
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
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_LBL ?></h2>
<?php
  if (!empty($_REQUEST['module_id'])) {
  $module_id = $_REQUEST['module_id'];
  $q = "SELECT * from #__pshop_module where module_id='$module_id'";
  $db->query($q);
  $db->next_record();
}

?> 
<form method="post" action="<?php echo $PHP_SELF ?>" name="adminForm">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td width="24%" ALIGN="RIGHT" ><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_NAME ?>:</td>
      <td width="76%" > 
        <input type="text" class="inputbox" name="module_name" value="<?php echo $db->sf("module_name") ?>" size="32">
        <input type="hidden" name="module_id" value="<?php echo $module_id ?>">
        <input type="hidden" name="func" value="<?php if ($module_id) echo "moduleUpdate"; else echo "moduleAdd"; ?>">
        <input type="hidden" name="page" value="<?php echo $modulename?>.module_list">
        <input type="hidden" name="option" value="com_phpshop">
        <input type="hidden" name="task" value="">
        <?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="righT" ><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_PERMS ?>:</td>
      <td width="76%" > 
        <input type="text" class="inputbox" name="module_perms" value="<?php $db->sp("module_perms") ?>">
      </td>
    </tr>
    <tr> 
      <td width="24%" ALIGN="RIGHT" ><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_HEADER ?>:</td>
      <td width="76%" > 
        <input type="text" class="inputbox" name="module_header" value="<?php $db->sp("module_header") ?>">
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_FOOTER ?>:</td>
      <td width="76%" > 
        <input type="text" class="inputbox" name="module_footer" value="<?php $db->sp("module_footer") ?>">
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right" ><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_MENU ?>:</td>
      <td width="76%" > 
        <select class="inputbox" NAME="module_publish">
          <option value="y" <?php if ($db->f("module_publish")=="y") echo "selected"?>>yes</option>
          <option value="n" <?php if ($db->f("module_publish")=="n") echo "selected"?>>no</option>
        </select>
      </td>
    </tr>
    <tr> 
      <td width="24%" ALIGN="RIGHT" ><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_ORDER ?>:</td>
      <td width="76%" > 
        <input type="text" class="inputbox" name="list_order" size="3" maxlength="2" value="<?php $db->sp("list_order") ?>">
      </td>
    </tr>
    <tr> 
      <td valign="top" colspan="2" >&nbsp; </td>
    </tr>
    <tr> 
      <td valign="top" ALIGN="RIGHT" ><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_DESCRIPTION ?>:</td>
      <td valign="top" >&nbsp;</td>
    </tr>
    <tr align="center"> 
      <td valign="top" colspan="2" > 
        <textarea name="module_description" wrap="virtual" cols="50" rows="10"><?php $db->sp("module_description") ?></textarea>
      </td>
    </tr>
    <tr> 
      <td width="24%" >&nbsp;</td>
      <td width="76%" >&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2" > 
        <table width="80%" border="0" cellspacing="0" cellpadding="1" align="center">
          <tr> 
            <td width="5%" nowrap align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_MODULE_FORM_MODULE_LABEL ?>:</td>
            <td width="37%"> 
              <input type="text" class="inputbox" size=12 name="module_label_1" value="<?php $db->sp("module_label_1") ?>">
            </td>
          </tr>
          <tr> 
            <td width="5%">&nbsp;</td>
            <td width="37%">&nbsp;</td>
          </tr>
          <tr> 
           <td width="5%">&nbsp;</td>
            <td width="37%">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr> 
      <td valign="top" colspan="2" align="center">&nbsp;</td>
    </tr>
    
  </table>
</form>
