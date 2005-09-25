<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: admin.country_form.php,v 1.5 2005/01/27 19:34:00 soeren_nb Exp $
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

require_once( CLASSPATH. 'ps_zone.php');
$ps_zone = new ps_zone;
$country_id = mosGetParam( $_REQUEST, 'country_id' );

if (!empty( $country_id )) {
  $q = "SELECT * from #__pshop_country WHERE country_id='$country_id'";
  $db->query($q);
  $db->next_record();
}

$funcname = !empty($country_id) ? "countryUpdate" : "countryAdd";

// Create the Form Control Object
$formObj = &new formFactory( $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_ADD );

// Start the the Form
$formObj->startForm();
// Add necessary hidden fields
$formObj->hiddenField( 'country_id', $country_id );
?>
<table class="adminform">
	<tr> 
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr> 
		<td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_NAME ?>:</td>
		<td width="76%"> 
			<input type="text" class="inputbox" name="country_name" value="<?php $db->sp("country_name") ?>" />
		</td>
	</tr>
	<tr> 
		<td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_ZONE_ASSIGN_CURRENT_LBL ?>:</td>
		<td width="76%"><?php echo $ps_zone->list_zones('zone_id',$db->f('zone_id'));  ?></td>
	</tr>
	<tr> 
		<td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_2_CODE ?>:</td>
		<td width="76%"> 
			<input type="text" class="inputbox" name="country_2_code" value="<?php $db->sp("country_2_code") ?>" />
		</td>
	</tr>
	<tr> 
		<td width="24%" align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_COUNTRY_LIST_3_CODE ?>:</td>
		<td width="76%"> 
			<input type="text" class="inputbox" name="country_3_code" value="<?php $db->sp("country_3_code") ?>" />
		</td>
	</tr>
</table>
<?php
// Write common hidden input fields
// and close the form
$formObj->finishForm( $funcname, 'admin.country_list', $option );
?>