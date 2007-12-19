<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2007 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );
include_class("vendor");
global $ps_vendor;
$shopper_group_id = vmGet( $_REQUEST, 'shopper_group_id', null );
$option = vmGet( $_REQUEST, 'option', 'com_virtuemart' );
//First create the object and let it print a form heading
$formObj = &new formFactory( $VM_LANG->_('PHPSHOP_SHOPPER_GROUP_FORM_LBL') );
//Then Start the form
$formObj->startForm();

if (!empty($shopper_group_id)) {
   $q = "SELECT * FROM #__{vm}_shopper_group ";
   $q .= "WHERE shopper_group_id='$shopper_group_id'";
   if( !$perm->check("admin")) {
     $q .= " AND vendor_id = '$ps_vendor_id'";
   }
   $db->query($q);
   $db->next_record();
}
?>
<table class="adminform">
    <tr>
      <td width="23%" nowrap>
        <strong><div align="right"><?php echo $VM_LANG->_('PHPSHOP_DEFAULT') ?> ?:</div></strong>
      </td>
      <td width="77%" >
		<?php 
			if($db->f("default")=="1") { ?>
				<img src="<?php echo $mosConfig_live_site ?>/administrator/images/tick.png" border="0" />
				<input type="hidden" name="default" value="1" />
			  <?php 
			}
			else { ?>
				<input type="checkbox" name="default" value="1"  />
				<?php 
			} 
		?>
      </td>
    </tr>
    <tr>
      <td width="23%" nowrap>
        <strong><div align="right"><?php echo $VM_LANG->_('PHPSHOP_SHOPPER_GROUP_FORM_NAME') ?>:</div></strong>
      </td>
      <td width="77%" > 
        <input type="text" class="inputbox" name="shopper_group_name" size="18" value="<?php $db->sp('shopper_group_name') ?>" />
        </td>
    </tr>
      <tr> 
        <td width="23%" class="labelcell">
          <?php echo $VM_LANG->_('PHPSHOP_PRODUCT_FORM_VENDOR') ?>:
        </td>
        <td width="77%" ><?php 
		if( $perm->check("admin")) { 
			$ps_vendor->list_vendor($db->sf("vendor_id"));  
		}
		else{ 
		  echo "$vendor_name<input type=\"hidden\" name=\"vendor_id\" value=\"$ps_vendor_id\" />";
		}
			?></td>
      </tr>
    <?php

    $selected[0] = $db->f('show_price_including_tax') == "0" ? "selected=\"selected\"" : "";
    $selected[1] = $db->f('show_price_including_tax') == "1" ? "selected=\"selected\"" : "";
?>
    <tr>
      <td width="23%" nowrap><strong><div align="right"><?php
      echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX').": "; ?></div></strong>
      </td>
      <td width="77%" > 
        <select class="inputbox" name="show_price_including_tax">
          <option <?php echo $selected[0] ?> value="0"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_NO') ?></option>
          <option <?php echo $selected[1] ?> value="1"><?php echo $VM_LANG->_('PHPSHOP_ADMIN_CFG_YES') ?></option>
        </select>&nbsp;
        <?php echo mm_ToolTip( $VM_LANG->_('PHPSHOP_ADMIN_CFG_PRICES_INCLUDE_TAX_EXPLAIN') ); ?>
      </td>
    </tr> 
    <tr>
      <td width="23%" nowrap><strong><div align="right"><?php
      echo $VM_LANG->_('PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT').": "; ?></div></strong>
      </td>
      <td width="77%" > 
        <input type="text" class="inputbox" name="shopper_group_discount" size="18" value="<?php $db->sp('shopper_group_discount') ?>" />
        <?php echo mm_ToolTip( $VM_LANG->_('PHPSHOP_SHOPPER_GROUP_FORM_DISCOUNT_TIP') ); ?>
      </td>
    </tr> 
    <tr> 
      <td width="23%" nowrap valign="top"><strong><div align="right">
      <?php echo $VM_LANG->_('PHPSHOP_SHOPPER_GROUP_FORM_DESC') ?>:</div></strong>
      </td>
      <td width="77%" valign="top" >
      <?php
	  editorArea( 'editor1', $db->f('shopper_group_desc'), 'shopper_group_desc', 500, 250, 75, 25 ) 
	  ?>
      </td>
    </tr>
    <tr> 
      <td width="23%" nowrap valign="top" >&nbsp;</td>
      <td width="77%" valign="top" >&nbsp;</td>
    </tr>
</table>

<?php
// Add necessary hidden fields
$formObj->hiddenField( 'shopper_group_id', $shopper_group_id );

$funcname = !empty($shopper_group_id) ? "shopperGroupUpdate" : "shopperGroupAdd";

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.shopper_group_list', $option );
?>