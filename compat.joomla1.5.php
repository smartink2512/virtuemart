<?php 
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) {
	die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
}
/**
* This file provides compatibility for VirtueMart on Joomla! 1.0.x and Joomla! 1.5
*
*
* @version $Id: toolbar.virtuemart.php 313 2006-06-24 03:22:59 +0200 (Sa, 24 Jun 2006) mdennerlein $
* @package VirtueMart
* @subpackage core
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
global $mainframe;

	$mosConfig_host = $mainframe->getCfg('host' );
	$mosConfig_user = $mainframe->getCfg('user' );
	$mosConfig_password = $mainframe->getCfg('password' );
	$mosConfig_db = $mainframe->getCfg('db' );
	$mosConfig_dbprefix = $mainframe->getCfg('dbprefix' );
	$mosConfig_mailer = $mainframe->getCfg('mailer' );
	$mosConfig_mailfrom = $mainframe->getCfg('mailfrom' );
	$mosConfig_fromname = $mainframe->getCfg('fromname' );
	$mosConfig_sendmail = $mainframe->getCfg('sendmail' );
	$mosConfig_smtpauth = $mainframe->getCfg('smtpauth' );
	$mosConfig_smtpuser = $mainframe->getCfg('smtpuser' );
	$mosConfig_smtppass = $mainframe->getCfg('smtppass' );
	$mosConfig_smtphost = $mainframe->getCfg('smtphost' );
	$mosConfig_debug = $mainframe->getCfg('debug' );
	$mosConfig_caching = $mainframe->getCfg('caching' );
	$mosConfig_cachetime = $mainframe->getCfg('cachetime' );
	$mosConfig_secret = $mainframe->getCfg('secret' );
	$mosConfig_editor = $mainframe->getCfg('editor' );
	$mosConfig_offset = $mainframe->getCfg('offset' );
	$mosConfig_lifetime = $mainframe->getCfg('lifetime' );
	$mosConfig_sitename = $mainframe->getCfg('sitename' );
	$mosConfig_list_limit = $mainframe->getCfg('list_limit' );
	$mosConfig_gzip = $mainframe->getCfg('gzip' );
	$mosConfig_lang = $mainframe->getCfg('lang' );
	$mosConfig_allowUserRegistration = $mainframe->getCfg('allowUserRegistration' );
	$mosConfig_useractivation = $mainframe->getCfg('useractivation' );
	$mosConfig_sef = $mainframe->getCfg('sef' );
	$mosConfig_hidePdf = $mainframe->getCfg('hidePdf' );
	$mosConfig_hidePrint = $mainframe->getCfg('hidePrint' );
	$mosConfig_hideEmail = $mainframe->getCfg('hideEmail' );
	$mosConfig_icons = $mainframe->getCfg('icons' );
	$mosConfig_live_site = $mainframe->getCfg('live_site' );
	$mosConfig_absolute_path = $mainframe->getCfg('absolute_path' );

	$_VERSION = $GLOBALS['_VERSION'] = new JVersion();
	
@DEFINE('_BUTTON_SEND_REG','Send Registration');
@DEFINE('_CONTACT_FORM_NC','Please make sure the form is complete and valid.');
@define( '_CMN_REQUIRED', 'Required' );
@define( "_MOS_NOTRIM", 0x0001 );
@define( "_MOS_ALLOWHTML", 0x0002 );
@define( "_MOS_ALLOWRAW", 0x0004 );
@define( '_CMN_NEW', 'New');
@define( '_E_SAVE', 'Save');
@define( '_CMN_SAVE', 'Save');
@define( '_E_APPLY', 'Apply');
@define( '_E_IMAGES', 'Images');
@DEFINE('_CMN_NEW_ITEM_LAST','New items default to the last place. Ordering can be changed after this item is saved.');
@DEFINE('_URL','URL:');
@DEFINE('_CMN_OPTIONAL','Optional');
@define('_SEL_CATEGORY', 'Select a category');
@define( '_E_REMOVE', 'Remove');
@DEFINE('_PN_LT','&lt;');
@DEFINE('_PN_RT','&gt;');
@DEFINE('_PN_PAGE','Page');
@DEFINE('_PN_OF','of');
@DEFINE('_PN_START','Start');
@DEFINE('_PN_PREVIOUS','Prev');
@DEFINE('_PN_NEXT','Next');
@DEFINE('_PN_END','End');
@DEFINE('_PN_DISPLAY_NR','Display #');
@DEFINE('_PN_RESULTS','Results');
@DEFINE('_CMN_PRINT','Print');
@DEFINE('_CMN_PDF','PDF');
@DEFINE('_CMN_EMAIL','E-mail');
@DEFINE('_BACK','Back');
@DEFINE('_USERNAME','Username');
@DEFINE('_PASSWORD','Password');
@DEFINE('_BUTTON_LOGIN','Login');
@DEFINE('_REGISTER_UNAME','Username');
@DEFINE('_REGISTER_EMAIL','Email');
@DEFINE('_REGWARN_NAME','Please enter your name.');
@DEFINE('_REGWARN_UNAME','Please enter a user name.');
@DEFINE('_REGWARN_MAIL','Please enter a valid e-mail address.');
@DEFINE('_SEND_SUB','Account details for %s at %s');
@DEFINE('_ASEND_MSG','Hello %s,

A new user has registered at %s.
This email contains their details:

Name - %s
e-mail - %s
Username - %s

Please do not respond to this message as it is automatically generated and is for information purposes only');
@DEFINE('_REG_COMPLETE', '<div class="componentheading">Registration Complete!</div><br />You may now login.');
@DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">Registration Complete!</div><br />Your account has been created and activation link has been sent to the e-mail address you entered. Note that you must activate the account by clicking on the activation link when you get the e-mail before you can login.');
@DEFINE('_DATE_FORMAT_LC',"%A, %d %B %Y");
?>