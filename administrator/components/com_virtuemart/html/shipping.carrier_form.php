<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id: shipping.carrier_form.php 1760 2009-05-03 22:58:57Z Aravot $
* @package JMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_jmart/COPYRIGHT.php for copyright notices and details.
*
* http://joomlacode.org/gf/project/jmart/
*/
mm_showMyFileName( __FILE__ );

//First create the object and let it print a form heading
$formObj = &new formFactory( JText::_('JM_CARRIER_FORM_LBL') );
//Then Start the form
$formObj->startForm();

$shipping_carrier_id = JRequest::getVar(  'shipping_carrier_id');
$option = empty($option)?JRequest::getVar(  'option', 'com_jmart'):$option;

if (!empty($shipping_carrier_id)) {
  $q = "SELECT * FROM #__{vm}_shipping_carrier WHERE shipping_carrier_id='$shipping_carrier_id'";
  $db->query($q);
  $db->next_record();
}
?><br />
<table class="adminform">
	<tr>
		<td width="21%" ><div align="right"><?php echo JText::_('JM_CARRIER_FORM_NAME') ?>:</div></td>
		<td width="79%" ><input class="inputbox" type="text" name="shipping_carrier_name" size="32" maxlength="255" value="<?php $db->sp("shipping_carrier_name") ?>"></td>
	</tr>
	<tr>
		<td width="21%" ><div align="right"><?php echo JText::_('JM_CARRIER_FORM_LIST_ORDER') ?>:</div></td>
		<td width="79%" ><input class="inputbox" type="text" name="shipping_carrier_list_order" size="32" maxlength="255" value="<?php $db->sp("shipping_carrier_list_order") ?>"></td>
	</tr>
</table>
<?php

// Add necessary hidden fields
$formObj->hiddenField( 'shipping_carrier_id', $shipping_carrier_id );

$funcname = !empty($shipping_carrier_id) ? "carrierupdate" : "carrieradd";

// finally close the form:
$formObj->finishForm( $funcname, $modulename.'.carrier_list', $option );
?>