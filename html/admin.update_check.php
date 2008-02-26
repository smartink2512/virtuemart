<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/**
*
* @version $Id: template.class.php 1095 2007-12-19 20:19:16Z soeren_nb $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2008 soeren - All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*
*/
vmCommonHTML::loadMooTools();
require_once( CLASSPATH.'update.class.php');

$formObj = new formFactory('VirtueMart Update Check');
$formObj->startForm();

vmUpdate::stepBar(1);
?>
<table class="adminlist">
  <tr>
    <th class="title">VirtueMart Version installed here</th>
    <th class="title">Latest VirtueMart Version</th>
  </tr>
  <tr>
    <td style="color:grey;font-size:18pt;text-align:center;"><?php echo $VMVERSION->RELEASE ?></td>
    <td id="updateversioncontainer" >
    	<img src="<?php echo VM_THEMEURL ?>images/indicator.gif" align="left" alt="checking..." style="display:none;" id="checkingindicator" />
    	<input name="checkbutton" id="checkbutton" type="button" value="Check now!" onclick="performUpdateCheck();" style="font-weight:bold;" />
    	<input name="downloadbutton" id="downloadbutton" type="submit" value="Download Update" style="display:none;font-weight:bold;" />
    </td>
  </tr>
</table>
<?php
$formObj->finishForm('getupdatepackage', 'admin.update_preview');
 ?>
<script type="text/javascript">
//<!--
function performUpdateCheck() {
	form = document.adminForm;
	$("checkingindicator").setStyle("display", "inline");
	form.checkbutton.value="Checking...";
	var myAjax = new Ajax("<?php echo $_SERVER['PHP_SELF'] ?>?option=com_virtuemart&task=checkForUpdate&page=admin.ajax_tools&only_page=1&no_html=1", 
										{
											method: 'get',
											onComplete: handleUpdateCheckResult
											}).request();
}
function handleUpdateCheckResult( o ) {

	$("checkingindicator").setStyle("display", "none");
	$("checkbutton").setStyle("display", "none");
	if( typeof o != "undefined" ) {
		$("updateversioncontainer").appendText( o );		
		if( o == "<?php echo $VMVERSION->RELEASE ?>" ) {
			$("updateversioncontainer").setStyle( "color", "green" );
		} 
		else if( o > "<?php echo $VMVERSION->RELEASE ?>" ) {
			$("updateversioncontainer").setStyle( "color", "red" );
			$("downloadbutton").setStyle("display", "");
		} else {
			$("updateversioncontainer").setStyle( "color", "blue" );
		}
		$("updateversioncontainer").setStyle( "font-size", "18pt" );
	} else { 
		form.checkbutton.value="Check";
	}
}
//-->
</script>
