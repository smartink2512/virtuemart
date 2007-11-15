<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
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

if( isset($_VERSION)) {
	$mainframe->setPageTitle( $VM_LANG->_PHPSHOP_DOWNLOADS_TITLE );
}

if ($perm->check("admin,storeadmin,shopper")) { ?>

	<h3><?php echo $VM_LANG->_PHPSHOP_DOWNLOADS_TITLE ?></h3>
    <img src="<?php echo VM_THEMEURL ?>images/downloads.gif" alt="downloads" border="0" align="center" />
    <br/>
    <br/>
    <?php

  	if (ENABLE_DOWNLOADS == '1') { ?>
	  	<form method="get" action="<?php echo $mm_action_url ?>index.php" name="downloadForm">
		  	<p><?php echo $VM_LANG->_PHPSHOP_DOWNLOADS_INFO ?></p>
		  	<div align="center">
			    <input type="text" class="inputbox" value="<?php echo @$_GET['download_id'] ?>" size="32" name="download_id" />
			    <br /><br />
			    <input type="submit" onclick="if( document.downloadForm.download_id.value < 12) { alert('<?php echo $VM_LANG->_CONTACT_FORM_NC ?>');return false;} else return true;" class="button" value="<?php echo $VM_LANG->_PHPSHOP_DOWNLOADS_START ?>" />
			 </div>
		    <input type="hidden" name="func" value="downloadRequest" />
		    <input type="hidden" name="option" value="<?php echo VM_COMPONENT_NAME ?>" />
		    <input type="hidden" name="page" value="shop.downloads" />
		</form>
   		<?php
	}
}
else {
	$vmLogger->info( $VM_LANG->_NOT_AUTH."; ".$VM_LANG->_DO_LOGIN );
}

?>
