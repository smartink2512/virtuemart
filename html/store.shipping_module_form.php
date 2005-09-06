<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: store.shipping_module_form.php,v 1.3 2005/01/27 19:34:03 soeren_nb Exp $
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

$shipping_module = mosgetparam($_REQUEST, 'shipping_module', null);

if( $shipping_module ) {
  if( !include( CLASSPATH."shipping/$shipping_module" ))
    mosredirect( $_SERVER['PHP_SELF']."?option=com_phpshop&page=store.shipping_modules", "Could not instantiate Class $shipping_module" );
  else
    eval( "\$_SHIPPING = new ".basename($shipping_module,".php")."();");
  
  ?>
  <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
  <script language="Javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
  <br />
  &nbsp;&nbsp;<span class="sectionname">Shipping Module Configuration: <?php echo $shipping_module ?></span>
  <br /><br />
  <form action="<?php echo $_SERVER['PHP_SELF']?>" name="adminForm" method="post">
  <?php
    $_SHIPPING->show_configuration();
  ?>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="option" value="com_phpshop" />
    <input type="hidden" name="func" value="shippingmethodSave" />
    <input type="hidden" name="page" value="store.shipping_modules" />
    <input type="hidden" name="shipping_class" value="<?php echo basename($shipping_module,".php"); ?>" />
  </form>
  <?php
}
else {

  // Form for new shipping modules
  
}

?>
