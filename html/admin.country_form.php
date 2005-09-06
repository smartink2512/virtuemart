<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.country_form.php,v 1.5 2005/01/27 19:34:00 soeren_nb Exp $
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

require_once( CLASSPATH. 'ps_zone.php');
$ps_zone = new ps_zone;

?>
<h2><?php if (empty($_REQUEST['country_id'])) {
          echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_ADD ?>
<?php }
  else {
  $country_id = $_REQUEST['country_id']; 
  $q = "SELECT * from #__pshop_country where country_id='$country_id'";
  $db->query($q);
  $db->next_record();
}
?></h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="adminForm">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td width="24%" ALIGN="RIGHT"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_NAME ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="country_name" value="<?php $db->sp("country_name") ?>">
        <? if (isset($country_id)) { ?>
        <input type="hidden" name="country_id" value="<?php echo $country_id ?>">
        <? } ?>
        <input type="hidden" name="func" value="<?php if (isset($country_id)) echo "countryUpdate"; else echo "countryAdd"; ?>">
        <input type="hidden" name="page" value="admin.country_list">
        <input type="hidden" name="task" value="">
        <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
        <input type="hidden" name="option" value="com_phpshop">
      </td>
    </tr>
    <tr> 
      <td width="24%" ALIGN="RIGHT"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL ?>:</td>
      <td width="76%"><?
        $ps_zone->list_zones('zone_id',$db->f('zone_id'));
      ?></td>
    </tr>
    <tr> 
      <td width="24%" ALIGN="RIGHT"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_2_CODE ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="country_2_code" value="<?php $db->sp("country_2_code") ?>">
      </td>
    </tr>
        <tr> 
      <td width="24%" ALIGN="RIGHT"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_3_CODE ?>:</td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="country_3_code" value="<?php $db->sp("country_3_code") ?>">
      </td>
    </tr>
    
  </table>
</form>

