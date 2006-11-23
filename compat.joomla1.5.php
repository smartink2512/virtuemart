<?php 
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) {
	die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
}
/**
* This file provides compatibility for VirtueMart on Joomla! 1.0.x and Joomla! 1.5
*
*
* @version $Id$
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
if( class_exists('jconfig')) {
	
	$jconfig = new jconfig();
	$mosConfig_host = $jconfig->host;
	$mosConfig_user = $jconfig->user;
	$mosConfig_password = $jconfig->password;
	$mosConfig_db = $jconfig->db;
	$mosConfig_dbprefix = $jconfig->dbprefix;
	$mosConfig_mailer = $jconfig->mailer;
	$mosConfig_mailfrom = $jconfig->mailfrom;
	$mosConfig_fromname = $jconfig->fromname;
	$mosConfig_sendmail = $jconfig->sendmail;
	$mosConfig_smtpauth = $jconfig->smtpauth;
	$mosConfig_smtpuser = $jconfig->smtpuser;
	$mosConfig_smtppass = $jconfig->smtppass;
	$mosConfig_smtphost = $jconfig->smtphost;
	$mosConfig_debug = $jconfig->debug;
	$mosConfig_caching = $jconfig->caching;
	$mosConfig_cachepath = $jconfig->cachepath;
	$mosConfig_cachetime = $jconfig->cachetime;
	$mosConfig_secret = $jconfig->secret;
	$mosConfig_editor = $jconfig->editor;
	$mosConfig_offset = $jconfig->offset;
	$mosConfig_lifetime = $jconfig->lifetime;
	$mosConfig_sitename = $jconfig->sitename;
	$mosConfig_list_limit = $jconfig->list_limit;
	$mosConfig_gzip = $jconfig->gzip;
	$mosConfig_lang = $jconfig->lang;
	$mosConfig_allowUserRegistration = $jconfig->allowUserRegistration;
	$mosConfig_useractivation = $jconfig->useractivation;
	$mosConfig_sef = $jconfig->sef;
	$mosConfig_hidePdf = $jconfig->hidePdf;
	$mosConfig_hidePrint = $jconfig->hidePrint;
	$mosConfig_hideEmail = $jconfig->hideEmail;
	$mosConfig_icons = $jconfig->icons;
	$mosConfig_live_site = $jconfig->live_site;
	$mosConfig_absolute_path = $jconfig->absolute_path;
	if( class_exists( 'jversion' )) {
		$_VERSION = $GLOBALS['_VERSION'] = new JVersion();
	}
	
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
}
?>