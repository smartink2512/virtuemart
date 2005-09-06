<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.function_form.php,v 1.4 2005/01/27 19:34:00 soeren_nb Exp $
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
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_LBL ?></h2>
<?php 

if (!empty($_REQUEST['function_id'])) {
  $function_id = $_REQUEST['function_id'];
  $q = "SELECT * from #__pshop_function where function_id='$function_id'";
  $db->query($q);
  $db->next_record();
}
?> 
<form method="post" action="<? echo $_SERVER["PHP_SELF"] ?>" name="adminForm">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_NAME ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="function_name" value="<?php $db->sp("function_name") ?>" />
        <input type="hidden" name="function_id" value="<?php echo @$function_id ?>" />
        <input type="hidden" name="module_id" value="<?php echo $module_id ?>" />
        <input type="hidden" name="func" value="<?php if (!empty( $function_id )) echo "functionUpdate"; else echo "functionAdd"; ?>" />
        <input type="hidden" name="page" value="<?php echo $modulename ?>.function_list" />
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="com_phpshop" />
        <?php $limitstart = mosgetparam( $_REQUEST, 'limitstart'); ?>
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_CLASS ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="function_class" value="<?php $db->sp("function_class") ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_METHOD ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="function_method" value="<?php $db->sp("function_method") ?>" />
      </td>
    </tr>
    <tr> 
      <td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_PERMS ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="function_perms" value="<?php $db->sp("function_perms") ?>" />
      </td>
    </tr>
    <tr> 
      <td valign="top" colspan="2" align="right">&nbsp; </td>
    </tr>
    <tr> 
      <td valign="top" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_FUNCTION_FORM_DESCRIPTION ?>:</td>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr align="center"> 
      <td valign="top" colspan="2"> 
        <textarea name="function_description" wrap="VIRTUAL" cols="60" rows="10"><?php $db->sp("function_description") ?></textarea>
      </td>
    </tr>
   
  </table>
</form>

