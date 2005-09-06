<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: product.product_discount_form.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
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
<h2><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ADDEDIT ?></h2>
<?php 
$discount_id = mosGetParam( $_REQUEST, 'discount_id', null );
$limitstart = mosgetparam( $_REQUEST, 'limitstart');

if ( $discount_id ) {
  $q = "SELECT * FROM #__pshop_product_discount WHERE discount_id='$discount_id'";
  $db->query($q);
  $db->next_record();
}
?> 
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $mosConfig_live_site ?>/includes/js/calendar/calendar-mos.css" title="green" />
<!-- import the calendar script -->
<script type="text/javascript" src="<?php echo $mosConfig_live_site ?>/includes/js/calendar/calendar.js"></script>
<!-- import the language module -->
<script type="text/javascript" src="<?php echo $mosConfig_live_site ?>/includes/js/calendar/lang/calendar-en.js"></script>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
<script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
<form method="post" action="<? echo $_SERVER["PHP_SELF"] ?>" name="adminForm">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr> 
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td width="24%"><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT ?>:</div></td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="amount" value="<?php $db->sp("amount") ?>" />
        <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_AMOUNT_TIP ); ?>
      </td>
    </tr>
    <tr> 
      <td width="24%"><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_AMOUNTTYPE ?>:</div></td>
      <td width="76%"> 
        <input type="radio" class="inputbox" name="is_percent" value="1" <?php if($db->sf("is_percent")==1) echo "checked=\"checked\""; ?> />
        <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT ?>&nbsp;&nbsp;&nbsp;
        <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ISPERCENT_TIP ); ?><br />
        <input type="radio" class="inputbox" name="is_percent" value="0" <?php if($db->sf("is_percent")==0) echo "checked=\"checked\""; ?> />
        <?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ISTOTAL ?>
      </td>
    </tr>
    <tr> 
      <td width="24%"><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE ?>:</div></td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="start_date" id="start_date" value="<?php if($db->sf("start_date")) echo strftime("%Y-%m-%d", $db->sf("start_date")); ?>" />
        <input name="reset" type="reset" class="button" onclick="return showCalendar('start_date', 'y-mm-dd');" value="..." />&nbsp;&nbsp;&nbsp;
        <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_STARTDATE_TIP ); ?>
      </td>
    </tr>
    <tr> 
      <td width="24%"><div align="right"><?php echo $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE ?>:</div></td>
      <td width="76%"> 
        <input type="text" class="inputbox" name="end_date" id="end_date" value="<?php if($db->sf("end_date")) echo strftime("%Y-%m-%d", $db->sf("end_date")); ?>" />
        <input name="reset" type="reset" class="button" onclick="return showCalendar('end_date', 'y-mm-dd');" value="..." />&nbsp;&nbsp;&nbsp;
        <?php echo mosToolTip( $PHPSHOP_LANG->_PHPSHOP_PRODUCT_DISCOUNT_ENDDATE_TIP ); ?>
      </td>
    </tr>
    <tr> 
      <td valign="top" colspan="2" align="right">&nbsp; </td>
    </tr>   
  </table>
<?php 
if (!empty( $discount_id )) { ?>
  <input type="hidden" name="discount_id" value="<?php echo $discount_id ?>" />
  <input type="hidden" name="func" value="<?php echo "discountUpdate"; ?>" />
<?php 
}
else { ?>
  <input type="hidden" name="func" value="<?php echo "discountAdd"; ?>" />
<?php 
} ?>
  <input type="hidden" name="page" value="<?php echo $modulename ?>.product_discount_list" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="option" value="com_phpshop" />
  <input type="hidden" name="limitstart" value="<?php echo $limitstart ?>" />
</form>

