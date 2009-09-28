<?php
if( !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: coupon.coupon_form.php 1760 2009-05-03 22:58:57Z Aravot $
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

echo vmCommonHTML::scriptTag( $mosConfig_live_site .'/includes/js/calendar/calendar.js');
if( vmisjoomla('1.5') ) {
	// in Joomla 1.5, the name of calendar lang file is changed...
	echo vmCommonHTML::scriptTag( $mosConfig_live_site .'/includes/js/calendar/lang/calendar-en-GB.js');
} else {
	echo vmCommonHTML::scriptTag( $mosConfig_live_site .'/includes/js/calendar/lang/calendar-en.js');
}
echo vmCommonHTML::linkTag( $mosConfig_live_site .'/includes/js/calendar/calendar-mos.css');

$coupon_id = JRequest::getVar(  'coupon_id', null );
$option = empty($option)?JRequest::getVar(  'option', 'com_jmart'):$option;

if ( $coupon_id ) {
	$q = "SELECT * FROM #__{vm}_coupons WHERE coupon_id='$coupon_id'";
	$db->query($q);
	$db->next_record();
	if( $db->f("coupon_type")=="gift") {
		$selected[0] = "selected=\"selected\"";
		$selected[1] = "";
	}
	else {
		$selected[1] = "selected=\"selected\"";
		$selected[0] = "";
	}
	$title = JText::_('JM_COUPON_EDIT_HEADER');

}
else {
	$selected[0] = "selected=\"selected\"";
	$selected[1] = "";
	$title = JText::_('JM_COUPON_NEW_HEADER');
}

$coupon_code_eon = $db->sf("coupon_code");
if ($coupon_code_eon == "") {
	$coupon_code_eon = vmGenRandomPassword(10);
}

$coupon_start_date = $db->f("coupon_start_date");
if ($coupon_start_date =="") {
	$coupon_start_date = date("Y-m-d");  //G:i:s
}

$coupon_expiry_date = $db->f("coupon_expiry_date");
if ($coupon_expiry_date =="") {
	$coupon_expiry_date = mktime  (date("G"), date("i"), date("s"), date("m"), date("d"), date("Y")+1 );
	$coupon_expiry_date = date("Y-m-d",$coupon_expiry_date); // G:i:s
	}


//First create the object and let it print a form heading
$formObj = &new formFactory( $title );
//Then Start the form
$formObj->startForm();

?>

  <table class="adminform">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="24%"><div align="right"><?php echo JText::_('JM_COUPON_COUPON_HEADER') ?>:</div></td>
      <td width="76%">
        <input type="text" class="inputbox" name="coupon_code" value="<?php $db->sp("coupon_code") ?>" />
      </td>
    </tr>
    <tr>
      <td width="24%"><div align="right"><?php echo JText::_('JM_COUPON_PERCENT_TOTAL') ?>:</div></td>
      <td width="76%">
        <input type="radio" class="inputbox" name="percent_or_total" value="percent" <?php if($db->sf("percent_or_total")=='percent' || empty($coupon_id)) echo "checked=\"checked\""; ?> />
        <?php echo JText::_('JM_COUPON_PERCENT') ?>&nbsp;&nbsp;&nbsp;
        <?php echo mm_ToolTip( JText::_('JM_PRODUCT_DISCOUNT_ISPERCENT_TIP') ); ?><br />
        <input type="radio" class="inputbox" name="percent_or_total" value="total" <?php if($db->sf("percent_or_total")=='total') echo "checked=\"checked\""; ?> />
        <?php echo JText::_('JM_COUPON_TOTAL') ?>
      </td>
    </tr>
    <tr>
      <td width="24%"><div align="right"><?php echo JText::_('JM_COUPON_TYPE') ?>:</div></td>
      <td width="76%">
        <select class="inputbox" name="coupon_type">
          <option value="gift" <?php echo $selected[0] ?>>
            <?php echo JText::_('JM_COUPON_TYPE_GIFT') ?>
          </option>
          <option value="permanent" <?php echo $selected[1] ?>>
            <?php echo JText::_('JM_COUPON_TYPE_PERMANENT') ?>
          </option>
        </select>
        <?php echo mm_ToolTip( JText::_('JM_COUPON_TYPE_TOOLTIP') ); ?>
      </td>
    </tr>
    <tr>
      <td width="24%"><div align="right"><?php echo JText::_('JM_COUPON_VALUE') ?>:</div></td>
      <td width="76%">
        <input type="text" class="inputbox" name="coupon_value" value="<?php $db->sp("coupon_value"); ?>" />
      </td>
    </tr>

	<tr>
      <td width="24%"><div align="right"><?php echo JText::_('JM_COUPON_VALUE_VALID_AT') ?>:</div></td>
      <td width="76%">
        <input type="text" class="inputbox" name="coupon_value_valid" value="<?php $db->sp("coupon_value_valid"); ?>" />
      </td>
    </tr>

     <!-- AG add coupon start and expiry dates -->
    <tr>
      <td width="24%"><div align="right"><?php echo JText::_('JM_COUPON_START') ?>:</div></td>
      <td width="76%">
        <input type="text" class="inputbox" id="coupon_start_date" name="coupon_start_date" value="<?php echo $coupon_start_date; ?>" />
        <input name="reset" type="reset" class="button" onclick="return showCalendar('coupon_start_date', 'y-mm-dd');" value="..." />
      </td>
    </tr>
    <tr>
      <td width="24%"><div align="right"><?php echo JText::_('JM_COUPON_EXPIRY') ?>:</div></td>
      <td width="76%">
        <input type="text" class="inputbox" name="coupon_expiry_date" id="coupon_expiry_date" value="<?php echo $coupon_expiry_date; ?>" />
        <input name="reset" type="reset" class="button" onclick="return showCalendar('coupon_expiry_date', 'y-mm-dd');" value="..." />
      </td>
    </tr>
    <!-- End AG add coupon start and expiry dates -->


    <tr>
      <td valign="top" colspan="2" align="right">&nbsp; </td>
    </tr>
  </table>
<?php
$funcname = !empty( $coupon_id ) ? 'couponUpdate' : 'couponAdd';

// Add necessary hidden fields
$formObj->hiddenField( 'coupon_id', $coupon_id );

// Write your form with mixed tags and text fields
// and finally close the form:
$formObj->finishForm( $funcname, $modulename.'.coupon_list', $option );
?>