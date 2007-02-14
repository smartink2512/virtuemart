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

require_once( CLASSPATH . "ps_userfield.php" );
require_once( CLASSPATH . "htmlTools.class.php" );

$missing = mosGetParam( $_REQUEST, "missing", "" );

if (!empty( $missing )) {
	echo "<script type=\"text/javascript\">alert('".$VM_LANG->_CONTACT_FORM_NC."'); </script>\n";
}

if ($mosConfig_allowUserRegistration == "0") {
	mosNotAuth();
	return;
}
$fields = ps_userfield::getUserFields('registration', false, '', false );
$skip_fields = array();

if ( $my->id > 0 || (VM_REGISTRATION_TYPE != 'NORMAL_REGISTRATION' && VM_REGISTRATION_TYPE != 'OPTIONAL_REGISTRATION' && $page == 'checkout.index') ) {
	// A listing of fields that are NOT shown
	$skip_fields = array( 'username', 'password', 'password2' );
	if( $my->id ) {
		$skip_fields[] = 'email';
	}
}
// Does the customer have to agree to your Terms & Conditions?
if (MUST_AGREE_TO_TOS != '1') {
	$skip_fields[] = 'agreed';
}
// This is the part that prints out ALL registration fields!
ps_userfield::listUserFields( $fields, $skip_fields );

echo '
<div align="center">';
    
	if( !$mosConfig_useractivation && @VM_SHOW_REMEMBER_ME_BOX && VM_REGISTRATION_TYPE == 'NORMAL_REGISTRATION' ) {
		echo '<input type="checkbox" name="remember" value="yes" id="remember_login2" checked="checked" />
		<label for="remember_login2">'. $VM_LANG->_REMEMBER_ME .'</label><br /><br />';
	}
	else {
		if( VM_REGISTRATION_TYPE == 'NO_REGISTRATION' ) {
			$rmbr = '';
		} else {
			$rmbr = 'yes';
		}
		echo '<input type="hidden" name="remember" value="'.$rmbr.'" />';
	}
	echo '
		<input type="submit" value="'. $VM_LANG->_BUTTON_SEND_REG . '" class="button" onclick="return( submitregistration());" />
	</div>
	<input type="hidden" name="Itemid" value="'. $sess->getShopItemid() .'" />
	<input type="hidden" name="gid" value="'. $my->gid .'" />
	<input type="hidden" name="id" value="'. $my->id .'" />
	<input type="hidden" name="user_id" value="'. $my->id .'" />
	<input type="hidden" name="option" value="com_virtuemart" />
	
	<input type="hidden" name="useractivation" value="'. $mosConfig_useractivation .'" />
	<input type="hidden" name="func" value="shopperadd" />
	<input type="hidden" name="page" value="checkout.index" />
	</form>
</div>';
?>