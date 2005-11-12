<?php 
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: ps_session.php,v 1.14 2005/11/08 19:21:01 soeren_nb Exp $
* @package VirtueMart
* @subpackage classes
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

/****************************************************************************
* CLASS DESCRIPTION
*
* ps_session
*
* The class is the former session class for virtuemart
*
*************************************************************************/
class ps_session {

	var $component_name = "option=com_virtuemart";
	var $_session_name = 'virtuemart';
	/**
     * Initialize the Session environment for VirtueMart
     *
     */
	function ps_session() {
		$this->initSession();
	}
	/**
     * Initiate the Session
     *
     */
	function initSession() {
		global $vmLogger, $mainframe;
		if( empty($_SESSION)) {
			// Session not yet started!";
			// Set the virtuemart cookie, using the md5 hash of the recent mambo/joomla session
			if( empty($_COOKIE[$this->_session_name])) {
				$_COOKIE[$this->_session_name] = md5($mainframe->_session->session_id);
			}
			// Set the sessioncookie if its missing
			// this is needed for joomla sites only
			$sessionCookieName = md5( 'site'.$GLOBALS['mosConfig_live_site'] );
			$sessioncookie 	= mosGetParam( $_COOKIE, $sessionCookieName, null );
			if( empty($_COOKIE['sessioncookie'])) {
				$_COOKIE['sessioncookie'] = $sessioncookie;
			}
			elseif( $_COOKIE['sessioncookie'] != $sessioncookie ) {			
				$_COOKIE['sessioncookie'] = $sessioncookie;
			}
			
			session_name( $this->_session_name );
			session_id( $_COOKIE[$this->_session_name] );
			
			session_start();
			
			if( !empty($_SESSION) && !empty($_COOKIE[$this->_session_name])) {
				$vmLogger->debug( 'A Session called '.$this->_session_name.' (ID: '.session_id().') was successfully started!' );
			}
			else {
				$vmLogger->debug( 'A Cookie had to be set to keep the session (there was none - does your Browser keep the Cookie?) although a Session already has been started! If you see this message on each page load, your browser doesn\'t accept Cookies from this site.' );
			}
		}
		elseif( !defined('_PSHOP_ADMIN')) {
			$vmLogger->debug( 'A Session had already been started...you seem to be using SMF, phpBB or another Sesson based Software.' );
		}	
	}
	
	function restartSession( $sid = '') {
		
		// Save the session data and close the session
		session_write_close();
		
		// Prepare the new session
		if( $sid != '' ) {
			session_id( $sid );
		}
		session_name( $this->_session_name );
		// Start the new Session.
		session_start();
		
	}
	function emptySession() {
		global $mainframe;
		$_SESSION = array();
		$_COOKIE[$this->_session_name] = md5($mainframe->_session->session_id);
	}
	/**
     * This is a solution for  the Shared SSL problem
     * We have to copy some cookies from the Main Mambo site domain into
     * the shared SSL domain (only when necessary!)
	 *
	 * The function is called on each page load.
	 */
	function prepare_SSL_Session() {
		global $my, $mosConfig_secret, $_VERSION;

		$ssl_redirect = mosGetParam( $_GET, "ssl_redirect", 0 );
		$martID = mosGetParam( $_GET, 'martID', null );
		$ssl_domain = "";
		
		/**
        * This is the first part of the Function:
        * We check if the function must be called at all
        * Usually this is only called once: Before we go to the checkout.
        * The variable ssl_redirect=1 is appended to the URL, just for this function knows
        * is must be active! This has nothing to do with SSL / Shared SSL or whatever
        */
		if( $ssl_redirect == 1 ) {
			// check_Shared_SSL compares the usual domain name
			// and the https Domain Name. If both do not match, we move on
			// else we leave this function.
			if( $this->check_Shared_SSL( $ssl_domain ) && $_SERVER['SERVER_PORT'] != 443) {
				if( $_VERSION->PRODUCT == 'Joomla!') {
					$sessionCookieName = md5( 'site'.$GLOBALS['mosConfig_live_site'] );
				}
				else {
					$sessionCookieName = 'sessioncookie';
				}
				if( !empty($my->id)) {
					// User is already logged in
					// We need to transfer the usercookie if present
					$martID = @base64_encode( $_COOKIE[$this->_session_name]."|".$_COOKIE[$sessionCookieName]."|".$_COOKIE['usercookie']['password']."|".$_COOKIE['usercookie']['username'] );

				}
				else {
					// User is not logged in, but has Cart Contents
					$martID = base64_encode( $_COOKIE[$this->_session_name]."|".$_COOKIE['sessioncookie'] );
				}
				$sessionFile = IMAGEPATH. md5( $martID ).'.sess';
				$session_contents = session_encode();
				if( file_exists( ADMINPATH.'install.copy.php')) {
					require_once( ADMINPATH.'install.copy.php');
				}
				file_put_contents( $sessionFile, $session_contents );

				// Redirect and send the Cookie Values within the variable martID
				mosRedirect( $this->url(SECUREURL . "index.php?page=checkout.index&martID=$martID") );
			}
			// do nothing but redirect
			else {
				mosRedirect( $this->url(SECUREURL . "index.php?page=checkout.index") );
			}
		}
		/**
        * This is part two of the function
        * If the redirect (see 4/5 lines above) was successful
        * and the Store uses Shared SSL, we have the variable martID
        * So let's copy the Cookie Values on the new domain and start the old session
        * othwerwise: do nothing.
        */
		if( !empty( $martID ) ) {
			if( $this->check_Shared_SSL( $ssl_domain ) ) {
	
				// We now need to copy the Mambo Cookies (which are only
				// valid for the "normal" Domain) to the SSL Domain
				if( $martID ) {
					$cookievals = base64_decode( $martID );
	
					$id_array = explode( "|", $cookievals );
	
					$virtuemartcookie = $id_array[0];
					$sessioncookie = $id_array[1];
					$usercookie["password"] = @$id_array[2];
					$usercookie["username"] = @$id_array[3];
	
					/** Mambo sets a Visitor Cookie (on each new page load) with a new Session Value
	                * This Cookie is useless, since the customer is no visitor at this point -
	                * so we can delete it. But Deleting Cookies is not trivial...we just set the
	                * Session Cookie again with an empty value. This erases the Cookie.
	                */
					if( $_VERSION->PRODUCT == 'Joomla!') {
						if( !empty($GLOBALS['real_mosConfig_live_site'])) {
							$sessionCookieName = md5( 'site'.$GLOBALS['real_mosConfig_live_site'] );
						}
						else {
							$sessionCookieName = md5( 'site'.$GLOBALS['mosConfig_live_site'] );
						}
					}
					else {
						$sessionCookieName = 'sessioncookie';
						
					}
					setcookie( $sessionCookieName, "", time() - 43200, "/" );
					// Set the "old" new Cookies now
					setcookie( $sessionCookieName, $sessioncookie, time() + 43200, "/", dirname($ssl_domain), true );
					// Get sure the cookie is set
					$_COOKIE[$sessionCookieName] = $sessioncookie;
	
					// Set the Cookie for VirtueMart
					$_COOKIE[$this->_session_name] = $virtuemartcookie;
					
					// Also log the user in when he was already logged in at the other domain
					if(!empty($usercookie["password"]) && !empty($usercookie["username"])) {
						$lifetime = time() + 365*24*60*60;
						setcookie( "usercookie[username]", $usercookie["username"], $lifetime, "/" );
						setcookie( "usercookie[password]", $usercookie["password"], $lifetime, "/" );
					}
					
					$this->restartSession( $virtuemartcookie );
					
					require_once( ADMINPATH.'install.copy.php');
					
					$sessionFile = IMAGEPATH. md5( $martID ).'.sess';
					
					// Read the contents of the session file
					$session_data = file_get_contents( $sessionFile );
					// Delete it for security and disk space reasons
					unlink( $sessionFile );

					// Read the session data into $_SESSION
					session_decode( $session_data );
					
					session_write_close();
					
					// Prevent the martID from being displayed in the URL
					if( !empty( $_GET['martID'] )) {
						mosRedirect( $this->url(SECUREURL . "index.php?page=checkout.index&cartReset=N") );
					}
	
				}
	
			}
		}
	}
	/**
	 * This function compares the store URL with the SECUREURL
	 * and returns the result
	 *
	 * @param string $ssl_domain The SSL domain (empty string to be filled here)
	 * @return boolean True when we have to do a SSL redirect (for Shared SSL)
	 */
	function check_Shared_SSL( &$ssl_domain ) {

		if( URL == SECUREURL ) {
			$ssl_domain = str_replace("http://", "", URL );
			$ssl_redirect = false;
			return $ssl_redirect;
		}
		// Extract the Domain Names without the Protocol
		$domain = str_replace("http://", "", URL );
		$ssl_domain = str_replace("https://", "", SECUREURL );
		// If SSL and normal Domain do not match,
		// we assume that you use Shared SSL

		if( $ssl_domain != $domain ) {
			$ssl_redirect = true;
		}
		else {
			$ssl_redirect = false;
		}

		return $ssl_redirect;
	}
	
	/**
     * Gets the Itemid for the com_virtuemart Component
     * and stores it in a global Variable
     *
     * @return int Itemid
     */
	function getShopItemid() {

		if( empty( $_REQUEST['shopItemid'] )) {
			$db = new ps_DB;
			$db->query( "SELECT id FROM #__menu WHERE link='index.php?option=com_virtuemart' AND published='1'");
			if( $db->next_record() ) {
				$_REQUEST['shopItemid'] = $db->f("id");
			}
			else {
				$_REQUEST['shopItemid'] = 1;
			}
		}

		return $_REQUEST['shopItemid'];

	}
	
	/**
	 * Prints a reformatted URL
	 *
	 * @param string $text
	 */
	function purl($text) {
		
		echo $this->url( $text );
		
	}
	
	/**
	 * This reformats an URL, appends "option=com_virtuemart" and "Itemid=XX"
	 * where XX is the Id of an entry in the table mos_menu with "link: option=com_virtuemart"
	 * It also calls sefRelToAbs to apply SEF formatting
	 * 
	 * @param strong $text THE URL
	 * @return string The reformatted URL
	 */
	function url($text) {
		global $mm_action_url;
		
		$Itemid = "&Itemid=".$this->getShopItemid();

		switch ($text) {
			case SECUREURL:
				$text =  SECUREURL.$_SERVER['PHP_SELF']."?".$this->component_name.$Itemid;
				break;
			case URL:
				$text =  URL.$_SERVER['PHP_SELF']."?".$this->component_name.$Itemid;
				break;
				
			default:
				$limiter = strpos($text, '?');

				$appendix = "";
				// now append "&option=com_virtuemart&Itemid=XX"
				if (!strstr($text, "option=")) {
					$appendix .= "&" . $this->component_name;
				}
				$appendix .= $Itemid;
	
				if (!defined( '_PSHOP_ADMIN' )) {
	
					// be sure that we have the correct PHP_SELF in front of the url
					if( stristr( $_SERVER['PHP_SELF'], "index2.php" )) {
						$prep = "index2.php";
					}
					else {
						$prep = "index.php";
					}
					if( stristr( $text, "index2.php" )) {
						$prep = "index2.php";
					}
	
					$appendix = $prep.substr($text, $limiter, strlen($text)-1).$appendix;
					$appendix = sefRelToAbs( str_replace( $prep.'&', $prep.'?', $appendix ) );
					if( !stristr( $appendix, $mm_action_url ) ) {
						$appendix = $mm_action_url . $appendix;
					}
				}
				elseif( $_SERVER['SERVER_PORT'] == 443 ) {
					$appendix = SECUREURL."administrator/index2.php".substr($text, $limiter, strlen($text)-1).$appendix;
				}
				else {
					$appendix = URL."administrator/index2.php".substr($text, $limiter, strlen($text)-1).$appendix;
				}
	
				if ( stristr($text, SECUREURL)) {
					$appendix = str_replace(URL, SECUREURL, $appendix);
				}
	
				$text = $appendix;
	
				break;
		}
		/**
	    ** This has to be redone, because it doesn't work with mosRedirect
	
	    if (!defined( '_PSHOP_ADMIN' ) && $pshop_mode != "admin") {
	        $text = str_replace( "&", "&amp;", $text );
	        $text = str_replace( "&amp;amp;", "&amp;", $text );
	    } 
	    */
		return $text;
	}

	/**
	 * Formerly printed the session id into a hidden field
	 * @deprecated 
	 * @return boolean
	 */
	function hidden_session() {
		return true;
	}


} // end of class session
?>
