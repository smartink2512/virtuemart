<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: account.index.php,v 1.8 2005/06/23 18:59:16 soeren_nb Exp $
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

require_once(CLASSPATH.'ps_order.php');
$ps_order = new ps_order;

$view_all = mosGetParam( $_REQUEST, 'view_all', 0 );

/* Set Dynamic Page Title when applicable */
if(is_callable(array('mosMainFrame', 'setPageTitle'))) {
    $mainframe->setPageTitle( $PHPSHOP_LANG->_PHPSHOP_ACCOUNT_TITLE );
}
    
if ($perm->is_registered_customer($auth['user_id'])) { 

?>

  <strong><? echo $PHPSHOP_LANG->_PHPSHOP_ACC_CUSTOMER_ACCOUNT ?></strong>
  <?php  echo $auth["first_name"] . " " . $auth["last_name"] . "<br />";?>
  <br />
  <table border="0" cellspacing="0" cellpadding="10" width="100%" align="center">
    <tr>
      <td><strong><?php 
      echo "<img src=\"".IMAGEURL."ps_image/package.png\" align=\"middle\" height=\"32\" width=\"32\" border=\"0\" alt=\"".$PHPSHOP_LANG->_PHPSHOP_ACC_ORDER_INFO."\" />&nbsp;&nbsp;&nbsp;";
      echo $PHPSHOP_LANG->_PHPSHOP_ACC_ORDER_INFO ?></strong>
      <br />
      <br />

        <?php $ps_order->list_order("A", "1", $view_all); ?>
      </td>
    </tr>
          
    <tr>
      <td><hr />
      <strong><a href="<?php $sess->purl(SECUREURL . "index.php?page=account.billing") ?>">
          <?php 
          echo "<img src=\"".IMAGEURL."ps_image/identity.png\" align=\"middle\" height=\"48\" width=\"48\" border=\"0\" alt=\"".$PHPSHOP_LANG->_PHPSHOP_ACCOUNT_TITLE."\" />&nbsp;";
          echo $PHPSHOP_LANG->_PHPSHOP_ACC_ACCOUNT_INFO ?></a></strong>
          <br /><? echo $PHPSHOP_LANG->_PHPSHOP_ACC_UPD_BILL ?>
      </td>
    </tr>
    <tr>
      <td><hr />
      <strong><a href="<?php $sess->purl(SECUREURL . "index.php?page=account.shipping") ?>"><?php
      echo "<img src=\"".IMAGEURL."ps_image/web.png\" align=\"middle\" border=\"0\" height=\"32\" width=\"32\" alt=\"".$PHPSHOP_LANG->_PHPSHOP_ACC_SHIP_INFO."\" />&nbsp;&nbsp;&nbsp;";
      echo $PHPSHOP_LANG->_PHPSHOP_ACC_SHIP_INFO ?></a></strong>
        <br />
        <? echo $PHPSHOP_LANG->_PHPSHOP_ACC_UPD_SHIP ?>
      </td>
    </tr>
</table>
<!-- Body ends here -->
<? } 
else { 
    echo $PHPSHOP_LANG->_PHPSHOP_NO_CUSTOMER;
} ?>
