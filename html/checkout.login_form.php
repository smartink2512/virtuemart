<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: COPYRIGHT.php 70 2005-09-15 20:45:51Z spacemonkey $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_phpshop/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );

$registration_enabled = $mosConfig_allowUserRegistration;
$Itemid = mosgetparam($_REQUEST, "Itemid", null);
?>
<form action="index.php?option=login" method="post" name="login">
  <div style="width:98%;">
	<div style="float:left;width:30%;text-align:right;">
	  <label for="username_login"><?php echo _USERNAME; ?>:</label>
	</div>
    <div style="float:left;width:60%;">
	  <input type="text" id="username_login" name="username" class="inputbox" size="20" />
	</div>
	<br/><br/>
    <div style="float:left;width:30%;text-align:right;">
	  <label for="passwd_login"><?php echo _PASSWORD; ?>:</label>
	</div>
	<div style="float:left;width:30%;">
	  <input type="password" id="passwd_login" name="passwd" class="inputbox" size="20" />
	</div>
	<div style="float:left;width:30%;">
		<input type="submit" name="Submit" class="button" value="<?php echo _BUTTON_LOGIN; ?>" />
	</div>
  </div>
  
  <input type="hidden" name="op2" value="login" />
  <input type="hidden" name="remember" value="yes" />
  <input type="hidden" name="lang" value="<?php echo $mosConfig_lang; ?>" />
  <input type="hidden" name="return" value="<?php echo sefRelToAbs( $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ) ?>" />
</form>

