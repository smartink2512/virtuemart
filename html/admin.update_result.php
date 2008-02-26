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

require_once( CLASSPATH.'update.class.php');
vmUpdate::stepBar(3);

if( !empty( $_SESSION['vmupdatemessage'] )) {
	echo '<div class="shop_info">'.shopMakeHtmlSafe($_SESSION['vmupdatemessage'])
			.'<br /><br /><br />Currently Installed Version:<br />';
	unset($_SESSION['vmupdatemessage']);
	require_once( ADMINPATH. 'version.php' );
	
	echo $myVersion;
	echo '</div>';
} 
else {
	vmRedirect($sess->url($_SERVER['PHP_SELF'].'?page=admin.update_check', false, false));
}
?>