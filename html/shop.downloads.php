<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: shop.downloads.php,v 1.5 2005/03/01 20:10:43 soeren_nb Exp $
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

if( isset($_VERSION)) {
 $mainframe->setPageTitle( $PHPSHOP_LANG->_PHPSHOP_DOWNLOADS_TITLE );
}

if ($perm->check("admin,storeadmin,shopper")) { ?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr valign="top">
    <td colspan="2" align="center">
      <h3><?php echo $PHPSHOP_LANG->_PHPSHOP_DOWNLOADS_TITLE ?></h3>
      <img src="<?php echo IMAGEURL ?>ps_image/downloads.gif" alt="downloads" border="0" align="center" />
    </td>
  </tr><?php

  if (ENABLE_DOWNLOADS == '1') { ?>
  <tr>
  <td width="20%">&nbsp;</td>
    <form method="post" action="<?php echo URL ?>index2.php">
      <td width="80%"><br /><br /><?php 
        echo $PHPSHOP_LANG->_PHPSHOP_DOWNLOADS_INFO ?><br /><br />
        <input type="text" class="inputbox" value="<?php echo @$_GET['download_id'] ?>" size="32" name="download_id" />
        <br /><br />
        <input type="submit" class="button" value="<?php echo $PHPSHOP_LANG->_PHPSHOP_DOWNLOADS_START ?>" />
        <br />
      </td>
      <input type="hidden" name="func" value="downloadRequest" />
      <input type="hidden" name="option" value="com_phpshop" />
      <input type="hidden" name="page" value="shop.downloads" />
    </form>
  </tr>
    <?php    
  }
?>
</table><?php
}
else {
      echo _NOT_AUTH."<br /><br />"._DO_LOGIN;
  }
  
  ?>
