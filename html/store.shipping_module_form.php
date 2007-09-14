<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id$
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
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

$shipping_module = mosgetparam($_REQUEST, 'shipping_module', null);

if( $shipping_module ) {
	if( !include( CLASSPATH."shipping/$shipping_module" )) {
		mosredirect( $_SERVER['PHP_SELF']."?option=com_virtuemart&page=store.shipping_modules", "Could not instantiate Class $shipping_module" );
	}
	else {
		eval( "\$_SHIPPING = new ".basename($shipping_module,".php")."();");
	}
	$ps_html->writableIndicator(CLASSPATH."shipping/".basename($shipping_module,".php").'.cfg.php');
	
  ?>
  <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
  <script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
	<table class="adminform">
	<tr>
	<td>
  
  &nbsp;&nbsp;<span class="sectionname">Shipping Module Configuration: <?php echo $shipping_module ?></span>
  <br /><br />
  
  <?php
	// Create the Form Control Object
	$formObj =& new formFactory( $VM_LANG->_PHPSHOP_COUNTRY_LIST_ADD );
	
	// Start the the Form
	$formObj->startForm();

  	$_SHIPPING->show_configuration();
  
  	// Write common hidden input fields
  	$formObj->hiddenField('shipping_class', basename($shipping_module,".php") );
	// and close the form
	$formObj->finishForm( 'shippingmethodSave', 'store.shipping_modules', $option );
	?>
	</td>
	</tr>
	</table>
	<?php
}
else {
	//TODO: Form for new shipping modules
}
?>