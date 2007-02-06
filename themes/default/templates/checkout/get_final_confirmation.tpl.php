<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage templates
* @copyright Copyright (C) 2007 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
ps_checkout::show_checkout_bar();

echo $basket_html;

echo '<br />';

$varname = '_PHPSHOP_CHECKOUT_MSG_' . CHECK_OUT_GET_FINAL_CONFIRMATION;
echo '<h5>'. $VM_LANG->$varname . '</h5>';

ps_checkout::final_info();

?>
<br />
<div align="center">
    <?php echo $VM_LANG->_PHPSHOP_CHECKOUT_CUSTOMER_NOTE ?>:<br />
    <textarea title="<?php echo $VM_LANG->_PHPSHOP_CHECKOUT_CUSTOMER_NOTE ?>" cols="50" rows="5" name="customer_note"></textarea>
    <br />
    <?php
    if (PSHOP_AGREE_TO_TOS_ONORDER == '1') { ?>
        <br />
      	<input type="checkbox" name="agreed" value="1" class="inputbox" />&nbsp;&nbsp;
      	<?php 
      	$link = $mosConfig_live_site .'/index2.php?option=com_virtuemart&amp;page=shop.tos&amp;pop=1&amp;Itemid='. $Itemid;
		$text = $VM_LANG->_PHPSHOP_I_AGREE_TO_TOS;
		echo vmPopupLink( $link, $text );
        echo '<br />';
    }
    ?>
</div>
<?php
if( VM_ONCHECKOUT_SHOW_LEGALINFO == '1' ) {
	$link =  sefRelToAbs('index2.php?option=com_content&amp;task=view&amp;id='.VM_ONCHECKOUT_LEGALINFO_LINK );
	$jslink = "window.open('$link', 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no'); return false;";
		if( @VM_ONCHECKOUT_LEGALINFO_SHORTTEXT=='' || !defined('VM_ONCHECKOUT_LEGALINFO_SHORTTEXT')) {
		$text = $VM_LANG->_VM_LEGALINFO_SHORTTEXT;
	} else {
		$text = VM_ONCHECKOUT_LEGALINFO_SHORTTEXT;
	}
	?>
    <div class="legalinfo"><?php
    	echo sprintf( $text, $link, $jslink );
    	?>
    </div><br />
    <?php
	}
    ?>
<div align="center">
<input type="submit" onclick="return( submit_order( this.form ) );" class="button" name="submit" value="<?php echo $VM_LANG->_PHPSHOP_ORDER_CONFIRM_MNU ?>" />
</div>
<?php
if(  PSHOP_AGREE_TO_TOS_ONORDER == '1' ) {
	echo "<script type=\"text/javascript\"><!--
function submit_order( form ) {
    if (!form.agreed.checked) {
        alert( \"". $VM_LANG->_PHPSHOP_AGREE_TO_TOS ."\" );
        return false;
    }
    else {
        return true;
    }
}
--></script>";
}
?>