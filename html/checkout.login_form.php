<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
* @version $Id: checkout.login_form.php,v 1.9 2005/06/22 19:50:40 soeren_nb Exp $
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
  <input type="hidden" name="return" value="<?php echo sefRelToAbs( $mm_action_url."index.php?".$_SERVER['QUERY_STRING'] ) ?>" />
</form>

